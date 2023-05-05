<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/distributorType.php';
$distributorType = new distributorType();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $distributorType->typeToken   = $inputData->typeToken;
    $distributorType->name        = $inputData->name;
    $distributorType->isAgent     = $inputData->isAgent;//0,1
    $distributorType->gmDateTime  = $gm_date_time;
    $stmtCheck = $distributorType->distributorTypeUpdateAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $distributorType->updateType();
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