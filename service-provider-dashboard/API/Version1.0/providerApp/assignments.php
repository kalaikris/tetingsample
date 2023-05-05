<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
$bookingApp->userToken = $inputData->userToken;
include_once '../objects/providerApp.php';
$providerApp = new providerApp();
$providerApp->userToken = $bookingApp->userToken;
$obj1=new stdClass();

$stmt = $providerApp->getUserImage();
$obj1->userImage   = $providerApp->readUserImage($stmt);

$stmt = $bookingApp->bookings('Ongoing');
$obj1->ongoing     = $bookingApp->bookingView($stmt);
$stmt = $bookingApp->bookings('Assign');
$obj1->upcoming    = $bookingApp->bookingView($stmt);

$obj->status_code = 201;
$obj->data        = $obj1;


echo json_encode($obj);
?>