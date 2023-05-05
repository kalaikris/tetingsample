<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/agent.php';
$agent = new agent();
$agent->userToken   = $inputData->userToken;
$agent->mobileNumber = $inputData->mobileNumber;
$agent->distributorToken = $inputData->distributorToken;
$stmt1 = $agent->userCheck();
if($stmt1->rowCount()==1){
    $stmt = $agent->mobileNoExistForAgent();
    if($stmt->rowCount() == '1'){
         $obj->status_code = 503;
         $obj->message = "Mobile Number Already Exists";
    }else{
         $obj->status_code = 201;
         $obj->message = "New Mobile Number"; 
    }
}else{
    $obj->status_code = 503;
    $obj->message    = "Error";
}
echo json_encode($obj);
?>