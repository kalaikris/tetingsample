<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
include_once '../objects/agent.php';
$agent = new agent();
$agent->userToken  = $inputData->userToken;
$agent->agentToken = $inputData->agentToken;
$stmt = $agent->userCheck();
if($stmt->rowCount()==1){
    $agent->distributorToken = $agent->userDistributorToken($stmt);
    $stmtDetails = $agent->singleAgentDetails();
    if($stmtDetails->rowCount()==1){
        $obj->status_code = 201;
        $obj->data        = $agent->singleAgentDetailsView($stmtDetails);
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Agent token doesn't token";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>