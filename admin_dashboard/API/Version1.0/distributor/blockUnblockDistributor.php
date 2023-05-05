<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/distributor.php';
$distributor = new distributor();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $distributor->distributorToken= $inputData->distributorToken;
    $distributor->status          = $inputData->status;//0-unblock,2-block
    $distributor->blockUnblockDistributor();
    $obj->status_code = 201;
    $obj->title       = "Success";
    if($distributor->status==2){
        $obj->message     = "Blocked successfully";
    }else{
        $obj->message     = "Unblocked successfully";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>