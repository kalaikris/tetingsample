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
    include_once '../objects/distributor.php';
    $distributor = new distributor();
    $distributor->distributorToken  = $inputData->distributorToken;
    $distributor->userToken         = $inputData->userToken;
    $stmt      =  $distributor->singleDistributorUserDetail();
    $stmtOrder =  $distributor->distriburtorUserOrderDetail();
    $obj->status_code  = 201;
    $obj->userDetails  = $distributor->singleDistributorUserDetailView($stmt);
    $obj->orderDetails = $distributor->distriburtorUserOrderDetailView($stmtOrder);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>