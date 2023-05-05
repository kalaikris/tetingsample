<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
$onboard->countryId = $inputData->countryId;
$onboard->stateId   = $inputData->stateId;
$obj->status_code   = 201;
$obj->cities        = $onboard->cities();
echo json_encode($obj);
?>