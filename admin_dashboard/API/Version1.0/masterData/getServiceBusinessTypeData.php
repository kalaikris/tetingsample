<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/serviceBusinessType.php';
$serviceBusinessType = new serviceBusinessType();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $serviceBusinessType->serviceToken = $inputData->serviceToken;
    $obj->status_code = 201;
    $obj->data = $serviceBusinessType->serviceBusinessDetails();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>