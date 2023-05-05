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
$stmt = $agent->userCheck();
if($stmt->rowCount()==1){
    $agent->distributorToken = $agent->userDistributorToken($stmt);
    $obj->status_code = 201;
    $stmtDetails      = $agent->agentDetails();
    $obj->data        = $agent->agentDetailsView($stmtDetails);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>