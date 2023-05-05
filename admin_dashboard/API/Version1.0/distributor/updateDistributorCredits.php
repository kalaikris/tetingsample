<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/distributor.php';
$distributor = new distributor();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $distributor->distributorToken= $inputData->distributorToken;
    $distributor->givenCredits = $inputData->givenCredits;
    $distributor->gmDateTime   = $gm_date_time;
    $distributor->referenceId  = $inputData->referenceId;
    $distributor->creditAvailable  = $distributor->getdistributorCredit();
    $currentCredit          = $distributor->givenCredits+$distributor->creditAvailable;
    $distributor->currentCredit= number_format((float)$currentCredit, 2, '.', '');;
    $distributor->updateDistributorCredit();
    
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = $distributor;//"Updated successfully";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>