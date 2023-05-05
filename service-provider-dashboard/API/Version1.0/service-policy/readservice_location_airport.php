<?php
include '../../../../config/core.php';
$inputData = getInputs();
$service__provider_companytoken = $inputData->service_provider_companytoken;
include_once '../objects/service_policies.php';
$obj = new stdClass;
$serviceprovider_companyairport = new ServicePolicies();
$stmt = $serviceprovider_companyairport->getservicelocationairport($service__provider_companytoken);
$num = $stmt->rowCount();
if($num > 0){
    $data = $serviceprovider_companyairport->readServiceLocationAirport($stmt);
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Service Location Related Airport";
    $obj->service_airportdata = $data;
}else{
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No Airport Found!";
}
echo json_encode($obj);
?>