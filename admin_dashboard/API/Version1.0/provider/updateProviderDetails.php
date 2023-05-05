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
    $provider->providerToken = $inputData->ProviderToken;
    $provider->isCredit = $inputData->isCredit=='Yes'?'1':'0';
    if($inputData->isCredit == 'No'){
        $num = $provider->isCreditAvailableForProvider();
        if($num->rowCount() == 0){
            $condition = true;
        }else{
            $condition = false;
        }
    } else {
        $condition = true;
    }
    if($condition){
        $provider->updateProviderDetails();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully";
    } else {
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Credits Available for the provider!"; 
    }
} else {
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>