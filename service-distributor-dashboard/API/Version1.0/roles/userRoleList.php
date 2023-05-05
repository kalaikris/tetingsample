<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/userRole.php';
$role = new userRole();
$role->serviceDistributorToken = $inputData->serviceDistributorToken;
$stmt =  $role->userRoleList();
$stmntModule = $role->distributorModules();
$obj->status_code = 201;
$obj->roleData = $role->userRoleListView($stmt);
$obj->moduleData = $role->distributorModuleView($stmntModule);
echo json_encode($obj);
?>