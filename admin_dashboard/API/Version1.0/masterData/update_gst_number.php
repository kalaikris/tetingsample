<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/onboard.php';
$onboard = new onboard();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $onboard->countryId = $inputData->countryId;
    $onboard->stateId = $inputData->stateId;
    $onboard->gst_no = $inputData->gst_no;
    $onboard->pancard = $inputData->pancard;
    $onboard->company_name = $inputData->company_name;
    $onboard->address = $inputData->address;
    $stmtCheck = $onboard->UpadteGstNumber();
    if($stmtCheck == true){
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully";
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Error";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>