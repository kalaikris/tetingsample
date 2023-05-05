<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingToken   = $inputData->bookingToken;
$booking->assigneeToken  = $inputData->assigneeToken;
$booking->assigneeByToken= $inputData->assigneeByToken;
$booking->gmDateTime     = $gm_date_time;
$stmt = $booking->assignEmployeeCheck();
if($stmt->rowCount()==1){
    $obj->status_code= 201;
    $obj->message    = "Assigned SuccessFully";
    $booking->assignStaff();
}else{
    $obj->status_code= 503;
    $obj->message    = "Staff not available";
}
echo json_encode($obj);
?>