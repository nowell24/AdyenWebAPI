<?php
require 'Connect.php';
class Payment extends Connect{
 
    public $data;
    public $apiKey;
    function getData() {
        return $this->data;
    }

    function getApiKey() {
        return $this->apiKey;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getSession()
    {
        return $this->callCurl($this->getPaymentSessionUrl(), json_encode($this->getData()), $this->getApiKey());
    }
    
    public function getPaymentResult()
    {
        return $this->callCurl($this->getPaymentsResultUrl(), json_encode($this->getData()), $this->getApiKey());
    }
    
    public function getRecurring()
    {
        return $this->callCurl($this->getRecurringUrl(), json_encode($this->getData()), $this->getApiKey());
    }
    
    public function authoriseRecurring()
    {
        return $this->callCurl($this->authRecurringUrl(), json_encode($this->getData()), $this->getApiKey());
    }
    
    public function capturePayment()
    {
        return $this->callCurl($this->capturePaymentUrl(), json_encode($this->getData()), $this->getApiKey());
    }
}
