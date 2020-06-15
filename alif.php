<?php
class Alif
{
    private $secretkey;
    public  $key; 
    public  $amount;
    public  $info; 
    public  $orderId;
    public  $callbackUrl;
    public  $returnUrl;
    public  $email;
    public  $phone;
    public  $status;
    public  $transactionId;

    public function __construct($key, $pass)
    {
        $this->key = $key;
        $this->secretkey = hash_hmac('sha256', $pass, $key);
    }

    function token(){
      $this->amount = number_format($this->amount, 2, '.', '');
      if($this->amount !== '' && $this->key !== '' && $this->orderId !== '' && $this->callbackUrl !== ''){
        return hash_hmac('sha256', $this->key.$this->orderId . $this->amount . $this->callbackUrl, $this->secretkey);
      }
    }

    function callback(){
        return hash_hmac('sha256', $this->orderId . $this->status . $this->transactionId, $this->secretkey);
    }

    function checkOrderToken(){
        return hash_hmac('sha256', $this->key.$this->orderId, $this->secretkey);
    }

    function tokenInfo($jsn){
        return hash_hmac('sha256', $jsn, $this->secretkey);
    }
}
?>