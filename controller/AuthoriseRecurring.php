<?php

require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$amount = $_REQUEST['amount'];
$email = $_REQUEST['email'];
$shopperRef = $_REQUEST['shopperReference'];
$paymentRef = $_REQUEST['paymentReference'];
$selPaymentRef = $_REQUEST['selPaymentReference'];
$pmt = new Payment();
$data = array(
    'amount' => ['value' => $amount, 'currency' => "USD"],
    "shopperEmail" => $email,
    'shopperIP' => $_SERVER['REMOTE_ADDR'],
    'shopperReference' => $shopperRef,
    'selectedRecurringDetailReference' => $selPaymentRef,
    "recurring" => ["contract" => "RECURRING"],
    "shopperInteraction" => "ContAuth",
    'reference' => $paymentRef,
    'email' => $email,
    'merchantAccount' => $authentication['merchantAccount']
    );
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->authoriseRecurring();
