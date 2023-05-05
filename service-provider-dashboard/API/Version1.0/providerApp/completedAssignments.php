<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
$bookingApp->userToken = $inputData->userToken;
$obj->status_code = 201;
$stmt = $bookingApp->completedBookings();
$obj->data     = $bookingApp->bookingView($stmt);
echo json_encode($obj);
?>