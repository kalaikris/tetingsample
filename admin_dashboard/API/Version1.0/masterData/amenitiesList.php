<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/amenities.php';
$amenities = new amenities();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $stmt      = $amenities->amenitiesCheck();
    $obj->data = $amenities->amenitiesView($stmt);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>