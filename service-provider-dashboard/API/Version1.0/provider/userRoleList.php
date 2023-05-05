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
$stmt =  $role->userRoleList();
$stmntModule = $role->providerModules();
$obj->status_code = 201;
$obj->roleData = $role->userRoleListView($stmt);
$obj->moduleData = $role->providerModuleView($stmntModule);
echo json_encode($obj);
?>