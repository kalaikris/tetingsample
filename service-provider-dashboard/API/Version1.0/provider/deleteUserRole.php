<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
include_once '../objects/userRole.php';
$role = new userRole();
$role->serviceProviderCompanyLocationToken = $inputData->serviceProviderCompanyLocationToken;
$role->userRoleToken     = $inputData->userRoleToken;
$role->deleteUserRole();
$obj->status_code = 201;
$obj->message     = "Deleted Successfully";
echo json_encode($obj);
?>