<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/location.php';
$location = new location();
if($inputData->countryId!="" && $inputData->countryId!=0 && $inputData->stateId!="" && $inputData->stateId!=0){
    $location->countryId = $inputData->countryId;
    $location->stateId   = $inputData->stateId;
    $obj->status_code    = 201;
    $obj->cities         = $location->cities();
}
echo json_encode($obj);
?>