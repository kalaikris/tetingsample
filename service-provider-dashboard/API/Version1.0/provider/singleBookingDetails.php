<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingToken = $inputData->bookingToken;
$obj->status_code      = 201;
$obj->details          = $booking->singleBookingHistory($gm_date);
echo json_encode($obj);
?>