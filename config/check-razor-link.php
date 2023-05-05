<?php
include 'core.php';
$input_data = getInputs();

// re-send payment link
// include 'razor-pay.php';
// $medium = ["email", "sms"];
// $razor_pay = new RazorPay();
// $razor_pay->plink_id = xss_clean($input_data->plink_id);
// for($i=0; $i<sizeof($medium); $i++){
//     $payment_order = $razor_pay->getLinkDetail($medium[$i]);
// }

include 'razor-pay.php';
$razor_pay = new RazorPay();
$razor_pay->plink_id = xss_clean($input_data->plink_id);

$payment_order = $razor_pay->CancelPaymentLink();
echo json_encode($payment_order);
?>