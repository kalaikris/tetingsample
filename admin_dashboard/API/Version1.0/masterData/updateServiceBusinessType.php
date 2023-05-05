<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/serviceBusinessType.php';
$serviceBusinessType = new serviceBusinessType();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $serviceBusinessType->businessTypeToken = $inputData->businessTypeToken;
    $serviceBusinessType->image             = $inputData->image;
    $serviceBusinessType->serviceType       = $inputData->serviceType;//'Service','Time','Inventory'
    $serviceBusinessType->name              = $inputData->name;
    $serviceBusinessType->description       = $inputData->description;
    //[]//to business_type__images
    $serviceBusinessType->photosArray       = $inputData->photosArray;//[]
    //[]//from - avail_service to business_type__avail_service
    $serviceBusinessType->availServiceTokens= $inputData->availServiceTokens;
    //[]//from - our_partners to business_type__partners
    $serviceBusinessType->availPartnerTokens= $inputData->availPartnerTokens;
    //to - business_type__service
    $serviceBusinessType->serviceIncluded   = $inputData->serviceIncluded;
    $serviceBusinessType->hsn               = $inputData->hsn;
    $serviceBusinessType->gmDateTime        = $gm_date_time;
    $stmtCheck = $serviceBusinessType->updateBusinessTypeAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $serviceBusinessType->updateBusinessType();
        $serviceBusinessType->updateBusinessTypeAvailService();
        $serviceBusinessType->updateBusinessTypeImages();
        $serviceBusinessType->updateBusinessTypePartners();
        $serviceBusinessType->updateBusinessTypeService();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Updated successfully";
        //$obj->data        = $serviceBusinessType;
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Name already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>