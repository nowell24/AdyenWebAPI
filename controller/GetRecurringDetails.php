<?php

require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$pmt = new Payment();
$shopperRef = $_REQUEST['shopperReference'];
$data = array(
    "recurring" => ["contract" => "RECURRING"],
    'shopperReference' => $shopperRef,
    'merchantAccount' => $authentication['merchantAccount']
    );
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->getRecurring();
