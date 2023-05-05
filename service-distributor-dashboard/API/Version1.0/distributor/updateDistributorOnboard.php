<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
$onboard->userToken       = $inputData->userToken;
$onboard->distributorToken= $inputData->distributorToken;
$stmtUser = $onboard->updateUserCheck();
if($stmtUser->rowCount()==1){
    $onboard->siteName = $inputData->siteName;
    $stmt = $onboard->siteNameCheck();
    if($stmt->rowCount()==0){
        $onboard->distirbutorTypeToken = $inputData->distirbutorTypeToken;
        $stmtType = $onboard->distirbutorTypeCheck();
        if($stmtType->rowCount()!=0){
            $onboard->name        = $inputData->name;
            $onboard->primaryEmail= $inputData->primaryEmail;
            $onboard->countryCode = $inputData->countryCode;
            $onboard->primaryMobileNumber = $inputData->primaryMobileNumber;
            $onboard->alternateEmail      = $inputData->alternateEmail;
            $onboard->alternateCountryCode= $inputData->alternateCountryCode;
            $onboard->alternateMobileNumber= $inputData->alternateMobileNumber;
            $onboard->address             = $inputData->address;
            $onboard->countryId           = $inputData->countryId;
            $onboard->stateId             = $inputData->stateId;
            $onboard->cityId              = $inputData->cityId;
            $onboard->pincode             = $inputData->pincode;
            $onboard->accountNumber       = $inputData->accountNumber;
            $onboard->ifscCode            = $inputData->ifscCode;
            $onboard->branch              = $inputData->branch;
            $onboard->city                = $inputData->city;
            $onboard->panCard             = $inputData->panCard;
            $onboard->gstCertificate      = $inputData->gstCertificate;
            $onboard->msmeCertificate     = $inputData->msmeCertificate;
            $onboard->incorporationCertificate  = $inputData->incorporationCertificate;
            $onboard->voideCheque         = $inputData->voideCheque;
            $onboard->contractAgreement   = $inputData->contractAgreement;
            $onboard->businessTypeTokens  = $inputData->businessTypeTokens;
            $onboard->airportTokens       = $inputData->airportTokens;
            $onboard->otherDocumentOne    = $inputData->otherDocumentOne;
            $onboard->otherDocumentTwo    = $inputData->otherDocumentTwo;
            $onboard->gstNumber           = $inputData->gstNumber;
            $onboard->panNumber           = $inputData->panNumber;
            $onboard->gmDateTime          = $gm_date_time;
            if ( $onboard->updateDistributor() ) {
                $onboard->updateDistributorBusinessType();
                $onboard->updateDistributorAirportsNew();
                $obj->status_code = 201;
                $obj->title       = "Success";
                $obj->message     = "Business Info Updated Successfully";
            } else {
                $obj->status_code = 503;
                $obj->title       = "Error";
                $obj->message     = "Unable to update Business Info";
            }
        }else{
            $obj->code       = 503;
            $obj->status_code=503;
            $obj->title  = "Error";
            $obj->message= "Invalid distributor type";
        }
    }else{
        $obj->code       =503;
        $obj->status_code=503;
        $obj->title  = "Oops";
        $obj->message="Sitename already exist";
    }
}else{
    $obj->code       =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message="Bussiness info already updated";
}
echo json_encode($obj);
?>