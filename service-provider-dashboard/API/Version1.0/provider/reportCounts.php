<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->serviceProviderLocationtoken = $inputData->serviceProviderLocationtoken;
$stmtNew            = $booking->newReportProblems($gm_date);
$stmtHistory        = $booking->reportProblemsHistory($gm_date);
$stmtCount          = $booking->reportCount();
$obj->status_code   = 201;
$obj->totalProblems = $stmtHistory->rowCount()+$stmtNew->rowCount();
$obj->reportCount   = $booking->reportCountView($stmtCount);
echo json_encode($obj);
?>