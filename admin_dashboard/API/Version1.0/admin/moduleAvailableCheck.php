<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$admin->moduleToken = $inputData->moduleToken;
$stmt = $admin->userModuleCheck();
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->message     = "Success";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>