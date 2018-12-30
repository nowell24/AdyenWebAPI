<?php

require '../model/Payment.php';
if (file_exists(__DIR__ . '/../config/authentication.ini')) {
    $authentication = parse_ini_file(__DIR__ . '/../config/authentication.ini', true);
}
$pmt = new Payment();
$payload = $_REQUEST['payload'];
$data = array('payload' => $payload);
$pmt->setData($data);
$pmt->setApiKey($authentication['checkoutAPIkey']);
echo $pmt->getPaymentResult();

