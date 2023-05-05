<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
//$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/appUsers.php';
    $appUsers = new appUsers();
    $appUsers->userToken  = $inputData->userToken;
    $appUsers->status     = $inputData->status;
    $obj->status_code = 201;
    $appUsers->blockUnblockUser();
    if($appUsers->status==1){
        $obj->message = "Unblocked Successfully";
    }else{
        $obj->message = "Blocked Successfully";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>