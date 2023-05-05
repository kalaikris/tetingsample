<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/agentBooking.php';
$booking = new booking();
$booking->userToken   = $inputData->userToken;
$booking->fromDate = $inputData->fromDate;
$booking->toDate = $inputData->toDate;
$booking->agentToken = 'AllAgent';
$stmt = $booking->bookingHistory();
$obj1=new stdClass();
$obj->status_code= 201;
$obj1->ongoing    = $booking->bookingHeader('Ongoing');
$obj1->upcoming   = $booking->bookingHeader('Pending');
$obj1->completed  = $booking->bookingHeader('Completed');
$obj1->cancelled  = $booking->bookingHeader('Cancelled');
$obj->status_code = 201;
$obj->headerData  = $obj1;

$obj->data        = $booking->bookingHistoryView($stmt);
echo json_encode($obj);
?>