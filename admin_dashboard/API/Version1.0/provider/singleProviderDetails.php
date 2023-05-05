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
    $provider->providerToken  = $inputData->providerToken;
    $obj->status_code = 201;
    $stmt             = $provider->singleProviderCheck();
    $obj->providerDetails= $provider->singleProviderView($stmt);
    $stmtCompany         = $provider->providerCompanyCheck();
    $obj->companyDetails = $provider->providerCompanyView($stmtCompany);
    
    $obj->creditDetails  = $provider->providerCreditView();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>