<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorOperations.php';
$operations = new operations();
$operations->distributorToken = $inputData->distributorToken;
$operations->userToken        = $inputData->userToken;
$operations->deviceToken      = $inputData->deviceToken;
$stmt = $operations->distributorUserCheck();
if($stmt->rowCount()==1){
    $operations->logo              = $inputData->logo;
    $operations->favicon           = $inputData->favicon;
    $operations->bannerImage       = $inputData->BannerImage;
    //$operations->landingBannerImage= $inputData->BannerImage;
    //$operations->sideBannerImage   = $inputData->BannerImage;
    $operations->posterImage       = $inputData->posterImage;
    $operations->footerLogo        = $inputData->footerLogo;
    $operations->headerColor       = $inputData->headerColor;
    $operations->headerTextColor   = $inputData->headerTextColor;//////
    $operations->brandColor        = $inputData->brandColor;
    $operations->secondaryColor    = $inputData->secondaryColor;
    $operations->description       = $inputData->description;
    if ( $operations->updateBrandingItems() ) {
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Success";
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error1";
        $obj->message     = "Error1";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>