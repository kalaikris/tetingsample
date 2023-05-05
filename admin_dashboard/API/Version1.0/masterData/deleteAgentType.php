<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/agentType.php';
$agentType = new agentType();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $agentType->typeToken= $inputData->typeToken;
    $stmtCheck = $agentType->deleteType();
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Deleted successfully";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>