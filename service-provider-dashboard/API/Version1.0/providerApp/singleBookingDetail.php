<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
$bookingApp->checkTime    = $cur_date_time;//$gm_date_time;
$bookingApp->bookingToken = $inputData->bookingToken;
$obj->status_code = 201;
$obj->data        = $bookingApp->singleBookingHistory($gm_date);
echo json_encode($obj);
?>