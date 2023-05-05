<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
include_once '../objects/employee.php';
$employee = new employee();
$employee->serviceDistributorToken= $inputData->serviceDistributorToken;
$employee->employeeToken          = $inputData->employeeToken;
$employee->deleteEmployee();
$obj->status_code = 201;
$obj->title       = "Deleted";
$obj->message     = "Deleted Successfully";
echo json_encode($obj);
?>