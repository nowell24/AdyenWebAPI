<?php
require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$pmt = new Payment();
$amount = $_POST['amount'];
$shopperRef = $_POST['shopperReference'];
$paymentRef = $_POST['paymentReference'];
$data = array(
    'amount' => ['value' => $amount, 'currency' => "USD"],
    'channel' => 'WeB',
    'countryCode' => 'US',
    'shopperReference' => $shopperRef,
    'shopperLocale' => 'en-US',
    'reference' => $paymentRef,
    'sdkVersion' => $authentication['sdkVersion'],
    'enableOneClick' => 'false',
    'enableRecurring' => 'false',
    'origin' => sprintf(
        "%s://%s%s",
        'https',
        $_SERVER['SERVER_NAME'],''
      ),
    'shopperIP' => $_SERVER['REMOTE_ADDR'],
    'returnUrl' => sprintf(
        "%s://%s%s",
        'https',
        $_SERVER['SERVER_NAME'],''
      ),
    'merchantAccount' => $authentication['merchantAccount']
);
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->getSession();
