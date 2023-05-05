<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingToken = $inputData->bookingToken;
$booking->notes        = $inputData->notes;
$obj->status_code= 201;
$obj->message    = "Updated SuccessFully";
$booking->updateNotes();
echo json_encode($obj);
?>