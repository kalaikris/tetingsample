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
$stmt = $employee->distributorEmployee();
if($stmt->rowCount()!=0){
    $obj->status_code = 201;
    $obj->data        = $employee->distributorEmployeeView($stmt);
}else{
    $obj->status_code = 503;
    $obj->message     = "No data";
}
echo json_encode($obj);
?>