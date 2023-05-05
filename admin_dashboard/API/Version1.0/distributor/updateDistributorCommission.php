<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
    $distributor->commission      = $inputData->commissionPercentage;
    $distributor->isMarkup      = $inputData->isMarkup=='Yes'?'1':'0';
    $distributor->markupType      = $inputData->markupType;
    $distributor->markupValue      = $inputData->markupValue;
    $distributor->membershipName      = $inputData->membershipName;
    $distributor->membershipType      = $inputData->membershipType;
    $distributor->membershipLength      = $inputData->membershipLength;
    $distributor->isLoyalty      = $inputData->isLoyalty=='Yes'?'1':'0';
    $distributor->cost      = $inputData->cost;
    $distributor->points      = $inputData->points;
    $distributor->partnerCode      = $inputData->partnerCode;
    $distributor->termsAndConditions1      = $inputData->termsAndConditions1;
    $distributor->termsAndConditions2      = $inputData->termsAndConditions2;
    $distributor->isCredit      = $inputData->isCredit=='Yes'?'1':'0';
    if($inputData->isCredit == 'No'){
        $num = $distributor->isCreditAvailableForDistributor();
        if($num->rowCount() == 0){
            $condition = true;
        }else{
            $condition = false;
        }
    }else{
        $condition = true;
    }
    if($condition){
        $distributor->updateDistributorCommissionPercentage();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully"; 
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Credits Available for the distributor!"; 
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
} 
echo json_encode($obj);
?>