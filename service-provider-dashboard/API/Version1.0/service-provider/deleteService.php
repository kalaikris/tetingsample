<?php
include '../../../../config/core.php';
$inputData = getInputs();
$service__provider_companytoken = $inputData->service_provider_companytoken;
include_once '../objects/service-provider.php';
$obj = new stdClass;
$service_providercompany = new ServiceProvider();
$service_providercompany->service_providercompanytoken = $service__provider_companytoken;
    if($service_providercompany->deleteServiceProviderCompany()){
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Company Deleted Succesfully!..";
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Company has not been deleted!.."; 
    }
echo json_encode($obj);
?>