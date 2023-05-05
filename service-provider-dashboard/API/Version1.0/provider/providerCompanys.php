<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/company.php';
$company = new company();
$company->userToken = $inputData->userToken;
$stmtApproved = $company->userCompanyApproved();
$stmt = $company->userCompany();
$obj->status_code = 201;
$obj->companys    = $company->userCompanyView($stmt,$stmtApproved);
echo json_encode($obj);
?>