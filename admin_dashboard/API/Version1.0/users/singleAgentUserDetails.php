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
    include_once '../objects/appUsers.php';
    $appUsers = new appUsers();
    $appUsers->userToken  = $inputData->userToken;
    $stmt      =  $appUsers->singleAgetUserDetail();
    $stmtOrder =  $appUsers->singleUserOrderDetail();
    $obj->status_code = 201;
    $obj->userDetails = $appUsers->singleAgentUserDetailView($stmt);
    $obj->orderDetails= $appUsers->singleUserOrderDetailView($stmtOrder);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>