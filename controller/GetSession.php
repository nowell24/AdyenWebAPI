<?php

require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$pmt = new Payment();
$amount = $_REQUEST['amount'];
$shopperRef = $_REQUEST['shopperReference'];
$paymentRef = $_REQUEST['paymentReference'];
$data = array(
    'amount' => ['value' => $amount, 'currency' => "USD"],
    'channel' => 'WeB',
    'countryCode' => 'US',
    'shopperReference' => $shopperRef,
    'shopperLocale' => 'en_US',
    'reference' => $paymentRef,
    'sdkVersion' => $authentication['sdkVersion'],
    'enableOneClick' => 'false',
    'enableRecurring' => 'false',
    'origin' => sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],''
      ),
    'shopperIP' => $_SERVER['REMOTE_ADDR'],
    'returnUrl' => sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],''
      ),
    'merchantAccount' => $authentication['merchantAccount']
);
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->getSession();
