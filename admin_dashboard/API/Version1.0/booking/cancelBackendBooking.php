<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/booking.php';
    $booking = new booking();
    include_once '../../../../config/razor-pay.php';
    $razor_pay = new RazorPay();
    $booking->bookingToken = $inputData->bookingToken;
    $stmt =  $booking->cancelBackendBooking();
    $razor_pay->plink_id = xss_clean($inputData->plinkId);
    $payment_order = $razor_pay->CancelPaymentLink();
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Cancelled Booking";
    $obj->plink       = $payment_order->status;
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>