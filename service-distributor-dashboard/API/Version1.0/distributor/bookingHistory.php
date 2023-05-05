<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new booking();
$booking->userToken   = $inputData->userToken;
$booking->fromDate = $inputData->fromDate;
$booking->toDate = $inputData->toDate;
$stmt1 = $booking->userCheck();
if($stmt1->rowCount()==1){
    $stmt = $booking->bookingHistory();
    $obj1=new stdClass();
    $obj1->ongoing    = $booking->bookingHeader('Ongoing');
    $obj1->upcoming   = $booking->bookingHeader('Pending');
    $obj1->completed  = $booking->bookingHeader('Completed');
    $obj1->cancelled  = $booking->bookingHeader('Cancelled');
    $obj->status_code= 201;
    $obj->headerData = $obj1;
    $obj->data       = $booking->bookingHistoryView($stmt);
}else{
    $obj->status_code= 503;
    $obj->message    = "Error";
}
echo json_encode($obj);
?>