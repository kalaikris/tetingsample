<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->serviceProviderLocationtoken = $inputData->serviceProviderLocationtoken;
$stmt = $booking->cancelBooking();
$obj->status_code = 201;
$obj->newdata     = $booking->cancelBookingView($stmt);
$stmt = $booking->cancelBooking();
$obj->historydata = $booking->cancelBookingView($stmt);
echo json_encode($obj);
?>