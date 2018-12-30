<?php

abstract class Connect {
    const ENDPOINT_CHECKOUT = "https://checkout-test.adyen.com/v40";
    const ENDPOINT_RECURRING = "https://pal-test.adyen.com/pal/servlet/Recurring/v25";
    const ENDPOINT_AUTHORISE = "https://pal-test.adyen.com/pal/servlet/Payment/v40";
    
    //const VERSION = "/v40"; 8525461656941626
    const PAYMENTSESSION = "/paymentSession";
    const PAYMENTSRESULT = "/payments/result";
    const LISTRECURRING = "/listRecurringDetails";
    const AUTHORISE = "/authorise";
    const CAPTURE = "/capture";
    
    protected static function getPaymentSessionUrl()
    {
        return self::ENDPOINT_CHECKOUT . self::PAYMENTSESSION;
    }
    
    protected static function getPaymentsResultUrl()
    {
        return self::ENDPOINT_CHECKOUT  . self::PAYMENTSRESULT;
    }
    
    protected static function getRecurringUrl()
    {
        return self::ENDPOINT_RECURRING . self::LISTRECURRING;
    }
    
    protected static function authRecurringUrl()
    {
        return self::ENDPOINT_AUTHORISE . self::AUTHORISE;
    }
    
    protected static function capturePaymentUrl()
    {
        return self::ENDPOINT_AUTHORISE . self::CAPTURE;
    }
    
    protected static function callCurl($url, $data, $apiKey)
    {
	try{
            $curlAPICall = curl_init();
            curl_setopt($curlAPICall, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curlAPICall, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlAPICall, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curlAPICall, CURLOPT_URL, $url);
            curl_setopt($curlAPICall, CURLOPT_HTTPHEADER,
                array(
                    "X-Api-Key: " . $apiKey,
                    "Content-Type: application/json",
                    "Content-Length: " . strlen($data)
                )
            );

            $result = curl_exec($curlAPICall);

            if ($result === false){
              throw new Exception(curl_error($curlAPICall), curl_errno($curlAPICall));
            }
            curl_close($curlAPICall);
        } catch (Exception $e) {
          trigger_error(sprintf(
                'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
                ), E_USER_ERROR);
        }

        return $result;
    }
}
