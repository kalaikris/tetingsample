<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/location.php';
$location = new location();
if($inputData->countryId!="" && $inputData->countryId!=0){
    $location->countryId  = $inputData->countryId;
    $obj->status_code     = 201;
    $obj->states          = $location->regions();
}
echo json_encode($obj);
?>