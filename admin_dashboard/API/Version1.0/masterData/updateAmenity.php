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
    $amenities->amenityToken= $inputData->amenityToken;
    $amenities->name        = $inputData->name;
    $amenities->image       = $inputData->image;
    $stmtCheck = $amenities->amenityUpadteAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $amenities->updateAmenity();
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