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
$booking->agentToken = $inputData->agentToken;
$stmt = $booking->bookingHistory();
$obj->status_code= 201;
$obj->data = $booking->bookingHistoryView($stmt);
echo json_encode($obj);
?>