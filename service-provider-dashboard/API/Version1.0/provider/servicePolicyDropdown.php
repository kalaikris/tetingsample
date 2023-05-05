<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service_policies.php';
$policies = new ServicePolicies();
$obj->status_code = 201;
$obj->data        = $policies->categoryDropdown();
echo json_encode($obj);
?>