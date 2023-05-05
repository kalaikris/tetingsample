<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/airport.php';
$airport = new airport();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $airport->airportToken= $inputData->airportToken;
    $airport->name        = $inputData->name;
    $airport->code        = $inputData->code;
    $airport->cityId      = $inputData->cityId;
    $airport->timeZone    = $inputData->timeZone;
    $airport->gmt         = $inputData->gmt;
    $stmtCheck = $airport->airportUpadteAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $airport->updateAirport();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully";
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Airport code already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>