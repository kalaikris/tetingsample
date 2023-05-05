<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service_policies.php';
$policies = new ServicePolicies();
$policies->serviceLocationToken= $inputData->serviceLocationToken;
$policies->deleteServiceLocation();
$policies->serviceToken= $policies->getServiceToken();
$stmtLocations    = $policies->getServiceLocations();
if($stmtLocations->rowCount()==0){
    $policies->deleteService();
}
$obj->status_code = 201;
$obj->data        = $policies;
echo json_encode($obj);
?>