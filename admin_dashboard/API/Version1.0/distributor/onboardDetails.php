<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
$obj->status_code     = 201;
$obj->bussinessType   = $onboard->bussinessTypeList();
$obj->airports        = $onboard->airportsList();
$obj->distributorTypes= $onboard->distributorTypes();
$obj->countries       = $onboard->countries();
//$obj->serviceLocations= $onboard->serviceLocations();
echo json_encode($obj);
?>