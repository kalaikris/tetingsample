<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/provider.php';
$provider = new provider();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $provider->providerToken= $inputData->providerToken;
    $provider->givenCredits = $inputData->givenCredits;
    $provider->gmDateTime   = $gm_date_time;
    $provider->referenceId  = $inputData->referenceId;
    $provider->creditAvailable  = $provider->getProviderCredit();
    $currentCredit          = $provider->givenCredits+$provider->creditAvailable;
    $provider->currentCredit= number_format((float)$currentCredit, 2, '.', '');;
    $provider->updateProviderCredit();
    
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Updated successfully";//$provider;//
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>