<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service_policies.php';
$policies = new ServicePolicies();
$policies->serviceProviderLocationtoken = $inputData->service_provider_locationtoken;
$policies->airportToken= $inputData->airport_token;
$stmt = $policies->airportTokenCheck();
if($stmt->rowCount()!=0){
    $policies->latitute    = $inputData->latitute;
    $policies->longitute   = $inputData->longitute;
    $policies->aboutShop   = $inputData->about_shop;
    $policies->shopPhotos  = $inputData->shop_photos;
    $policies->amentities  = $inputData->add_amentities;
    $policies->businessHours = $inputData->business_hours;
    $policies->terms         = $inputData->termsandconditionsarray;
    $policies->privacypolicy = $inputData->privacypolicyarray;
    $policies->cancellationpolicy = $inputData->cancellationpolicy;
    $policies->cancellationCharges= $inputData->cancellation_chargesarray;
    $policies->gmDateTime    = $gm_date_time;
    ////$policies->addShopPhotos();
    ////$policies->addAmentities();
    ////$policies->addBusinessHours();
    $policies->updateShopPhotos();
    $policies->updateAmentities();
    $policies->updateBusinessHours();
    $policies->updateLocationDetails();
//    $policies->addCancelCharges();
    $obj->status_code = 201;
}else{
    $obj->status_code = 503;
    $obj->message     = "Airport doesn't exists";
}
//$obj->data        = $policies->terms;
echo json_encode($obj);
?>