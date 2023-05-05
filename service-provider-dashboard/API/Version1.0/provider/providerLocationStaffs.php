<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
$provider->serviceProviderCompanyLocationToken = $inputData->serviceProviderCompanyLocationToken;
$stmt =  $provider->locationStaffs();
$obj->status_code= 201;
$obj->data   = $provider->locationStaffsView($stmt);
echo json_encode($obj);
?>