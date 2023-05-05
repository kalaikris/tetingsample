<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();

$dateQuery = " ";
$data = [];
$obj=new stdClass();

$booking->userToken   = $inputData->userToken;
$fromDate = $inputData->fromDate;
$toDate = $inputData->toDate;

if($fromDate!="" && $toDate!=""){
    $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate));
    $toDate = date("Y-m-d 23:59:59", strtotime($toDate));
    $dateQuery = " AND `users__booking_detail`.`cancelled_date` BETWEEN '$fromDate' AND '$toDate'";
}
$booking->dateQuery   = $dateQuery;

$stmt = $booking->userCheck();

if($stmt->rowCount()==1){
    
    // $lostRevenue   = $booking->cancelBookingHistoryLostRevenue($gm_date);

    $stmtDetails  = $booking->agent_cancelBookingHistoryCheck();
    $displayRecords= $stmtDetails->rowCount();
    $data         = $booking->cancelBookingView($stmtDetails);
    ## Response
    $obj->status_code= 201;
    $obj->data       = $data;
}else{
    ## Response
    $obj->status_code= 503;
    $obj->message    = "Error";
}

echo json_encode($obj);
?>