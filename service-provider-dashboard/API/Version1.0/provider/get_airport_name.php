<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/location.php';
$location = new location();
$location->airportToken = $inputData->airportToken;
$obj->status_code = 201;
$obj->names   = $location->airport_name();
echo json_encode($obj);
?>