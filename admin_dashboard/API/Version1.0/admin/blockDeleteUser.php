<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/provider.php';
$provider = new provider();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $admin->userToken= $inputData->userToken;
    $admin->status   = $inputData->status;//1-unblock,2-block,3-delete
    $admin->blockDeleteUser();
    $obj->status_code = 201;
    $obj->title       = "Success";
    if($admin->status==1){
        $obj->message     = "Unblocked successfully";
    }else if($admin->status==2){
        $obj->message     = "Blocked successfully";
    }else{
        $obj->message     = "Deleted successfully";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>