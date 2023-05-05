<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/booking.php';
    $booking = new booking();
    $fromDate  = date("Y-m-d 00:00:00", strtotime($inputData->fromDate) );
    $toDate    = date("Y-m-d 23:59:59", strtotime($inputData->toDate) );
    $dateQuery = "";
    if($inputData->fromDate != "" && $inputData->toDate!=""){
        $dateQuery       = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
    }
    $booking->dateQuery  = $dateQuery;
    $stmt =  $booking->backendBookingHistory();
    $obj->status_code = 201;
    $obj->data        = $booking->backendBookingHistoryView($stmt);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>