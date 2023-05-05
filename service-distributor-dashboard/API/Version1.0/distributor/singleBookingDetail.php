<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new booking();
$booking->userToken = $inputData->userToken;
$stmt1 = $booking->userCheck();
if($stmt1->rowCount()==1){
    $booking->bookingToken = $inputData->bookingToken;
    $obj->status_code  = 201;
    $obj->logo         = $booking->getLogo();
    $obj->details      = $booking->singleBookingHistory($gm_date);
}else{
    $obj->status_code= 503;
    $obj->message    = "Error";
}
echo json_encode($obj);
?>