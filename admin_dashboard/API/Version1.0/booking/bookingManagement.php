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
        if($inputData->radioBtn == "1"){
            $dateQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        } else {
            $dateQuery = " AND `users__booking_detail`.`service_date_time` BETWEEN '$fromDate' AND '$toDate'";
        }
    }
    $booking->dateQuery  = $dateQuery;
    $stmt =  $booking->bookingHistory();
    $obj->status_code = 201;
    $obj->data        = $booking->bookingHistoryView($stmt);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>