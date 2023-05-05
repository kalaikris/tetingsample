<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $admin->userEmail = trim($inputData->userEmail);
    $admin->userToken = $inputData->userToken;
    $stmt = $admin->userEmailUpdateCheck();
    if($stmt->rowCount()==0){
        $admin->userName     = trim($inputData->userName);
        $admin->userRoleToken= $inputData->userRoleToken;
        $admin->updateUser();
        $obj->status_code = 201;
        $obj->message     = "User updated Successfully";
    }else{
        $obj->status_code = 503;
        $obj->message     = "User email already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>