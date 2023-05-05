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
    $agentType->typeToken   = $inputData->typeToken;
    $agentType->name        = $inputData->name;
    $agentType->gmDateTime  = $gm_date_time;
    $stmtCheck = $agentType->typeUpdateAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $agentType->updateType();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully";
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Name already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>