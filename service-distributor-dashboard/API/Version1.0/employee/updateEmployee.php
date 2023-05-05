<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
include_once '../objects/employee.php';
$employee = new employee();
$employee->serviceDistributorToken = $inputData->serviceDistributorToken;
$employee->employeeToken= $inputData->employeeToken;
$employee->name         = $inputData->name;
$employee->email        = $inputData->email;
$employee->profilePic   = $inputData->profilePic;
$employee->mobile       = $inputData->mobile;
$employee->userRoleToken= $inputData->userRoleToken;
$employee->updateEmployee();
$obj->status_code = 201;
$obj->message = "Employee Details Updated Successfully";
$obj->data        = $employee;
echo json_encode($obj);
?>