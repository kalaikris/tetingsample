<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/distributor.php';
    $distributor = new distributor();
    $distributor->distributorToken  = $inputData->distributorToken;
    $stmt        =  $distributor->singleDistributorDetail();
    $stmtUser    =  $distributor->distriburtorUserDetail();
    $stmtAgent   =  $distributor->distriburtorAgentDetail();
    $stmtOnboard =  $distributor->distriburtorOnboard();
    $obj->status_code        = 201;
    $obj->distributorDetails = $distributor->singleDistributorDetailView($stmt);
    $obj->userDetails        = $distributor->distriburtorUserDetailView($stmtUser);
    $obj->agentDetails       = $distributor->distriburtorAgentDetailView($stmtAgent);
    $obj->onboardDetails     = $distributor->distriburtorOnboardView($stmtOnboard);
    $obj->creditDetails      = $distributor->distributorCreditView();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>