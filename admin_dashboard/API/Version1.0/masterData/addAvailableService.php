<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/availableServices.php';
$services = new services();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $services->serviceToken= $admin->generateToken('avail_service','token');
    $services->name        = $inputData->name;
    $services->image       = $inputData->image;
    $services->gmDateTime  = $gm_date_time;
    $stmtCheck = $services->serviceAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $services->addService();
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