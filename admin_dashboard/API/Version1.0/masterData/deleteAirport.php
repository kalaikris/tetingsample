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
    $stmtCheck = $airport->deleteAirport();
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Deleted successfully";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>