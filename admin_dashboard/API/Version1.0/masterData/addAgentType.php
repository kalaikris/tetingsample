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
    $agentType->typeToken   = $admin->generateToken('service__distributor_agent_type','token');
    $agentType->name        = $inputData->name;
    $agentType->gmDateTime  = $gm_date_time;
    $stmtCheck = $agentType->typeAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $agentType->addType();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Added successfully";
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