<?php
include '../../../../config/core.php';
$input_data = getInputs();
include_once '../objects/service-provider.php';
$obj = new stdClass;
$service_provider = new ServiceProvider();
$service_provider->companyToken = $input_data->company_token;
$obj->status_code = 201;
$obj->title       = "Success";
$obj->data        = $service_provider->getBussinessInfo();
echo json_encode($obj);
?>