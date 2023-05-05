<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorOperations.php';
$operations = new operations();
$operations->distributorToken = $inputData->distributorToken;
$operations->userToken = $inputData->userToken;
$stmt = $operations->distributorDetailsCheck();
if($stmt->rowCount()==1){
    include_once '../objects/dashboard.php';
    $dashboard = new dashboard();
    $dashboard->userToken= $operations->userToken;
    $stmt = $dashboard->recentBooking();
    $obj->status_code    = 201;
    $obj->bookingDetails = $dashboard->recentBookingView($stmt);
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>