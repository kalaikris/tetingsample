<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/airport.php';
$airport = new airport();
// $admin->adminToken  = $_POST['adminToken'];
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $airport->airportToken = $admin->generateToken('airport','token');
    $airport->ttrToken = $admin->generateToken('airport__terminal_type_relation','token');
    $airport->name        = $inputData->name;
    $airport->code        = $inputData->code;
    $airport->cityId      = $inputData->cityId;
    $airport->timeZone    = $inputData->timeZone;
    $airport->gmt         = $inputData->gmt;
    $airport->gmDateTime  = $gm_date_time;
    $stmtCheck = $airport->airportAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $airport->addAirport();
        $airport->addTerminalRelationType();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Added successfully";
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