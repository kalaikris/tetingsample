<?php

$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/agent.php';
$agent = new agent();
$agent->profile_image = $inputData->profile_image;
$agent->agent_title = $inputData->agent_title;
$agent->agent_name = $inputData->agent_name;
$agent->country_code = $inputData->countryCode;
$agent->mobile_no = $inputData->mobile_no;
$agent->email_id = $inputData->email_address;
$agent->agentToken = $inputData->agentToken;
$stmtUser = $agent->agentCheck();
if($stmtUser->rowCount()==1){
    if($agent->updateAgentProfile()){
        $agent->updateAgentDetailsUserTb();
        $obj->status_code=200;
        $obj->title  = "Success";
        $obj->message="Agent Profile Updated Successfully";
    }else{
        $obj->status_code=400;
        $obj->title  = "Oops";
        $obj->message="Not Able to update agent profile";
    }
}else{
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message="Agent Already Deleted";
}
echo json_encode($obj);
?>