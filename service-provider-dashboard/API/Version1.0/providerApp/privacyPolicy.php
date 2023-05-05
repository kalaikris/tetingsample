<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
include_once '../objects/providerApp.php';
$providerApp = new providerApp();
$bookingApp->userToken = $inputData->userToken;
$obj1=new stdClass();
$stmt = $bookingApp->bookings('Completed');
$providerApp->completedCount = $stmt->rowCount();
$providerApp->userToken      = $inputData->userToken;
$obj->status_code = 201;
$obj->data        = $providerApp->privacyPolicy();
echo json_encode($obj);
?>