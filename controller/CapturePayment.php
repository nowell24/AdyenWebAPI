<?php

require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$amount = $_REQUEST['amount'];
$paymentRef = $_REQUEST['paymentReference'];
$origPaymentRef = $_REQUEST['origPaymentReference'];
$pmt = new Payment();
$data = array(
    'originalReference' => $origPaymentRef,
    'modificationAmount' => ['value' => $amount, 'currency' => "USD"],
    'reference' => $paymentRef,
    'merchantAccount' => $authentication['merchantAccount']
    );
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->capturePayment();
