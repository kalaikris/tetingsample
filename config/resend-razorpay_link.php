<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'core.php';
$input_data = getInputs();

include 'razor-pay.php';
$medium = ["email", "sms"];
$razor_pay = new RazorPay();
$razor_pay->plink_id = xss_clean($input_data->plink_id);
for($i=0; $i<sizeof($medium); $i++){
    $payment_order = $razor_pay->getLinkDetail($medium[$i]);
}
echo json_encode($payment_order);
?>