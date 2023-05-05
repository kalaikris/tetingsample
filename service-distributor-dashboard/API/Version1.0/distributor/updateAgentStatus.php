<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/agent.php';
$agent = new agent();
$agent->agentStatus = $inputData->agentStatus;
$agent->agentToken = $inputData->agentToken;
$swalStatus = $inputData->swalStatus == 'Block'?'Blocked':($inputData->swalStatus == 'Unblock'?'Unblocked':'Deleted');
$stmtUser = $agent->agentCheck();
if($stmtUser->rowCount()==1){
    if($agent->updateAgentStatus()){
        $agent->updateAgentStatusUserTb();
        $obj->status_code=200;
        $obj->title  = "Success";
        $obj->message="Agent $swalStatus Successfully";
    }else{
        $obj->status_code=400;
        $obj->title  = "Oops";
        $obj->message="Not Able to update agent status";
    }
}else{
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message="Agent Already Deleted";
}
echo json_encode($obj);
?>