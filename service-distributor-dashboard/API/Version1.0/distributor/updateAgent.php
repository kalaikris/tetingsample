<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
include_once '../objects/agent.php';
$agent = new agent();
$agent->userToken  = $inputData->userToken;
$stmt = $agent->userCheck();
if($stmt->rowCount()==1){
//    $agent->title          = $inputData->title;
//    $agent->agentName      = $inputData->agentName;
//    $agent->profileImage   = $inputData->profileImage;
//    $agent->dateOfBirth    = $inputData->dateOfBirth;
//    $agent->businessTypeId = $inputData->businessTypeId;
//    $agent->websiteName    = $inputData->websiteName;
//    $agent->primaryNumber  = $inputData->primaryNumber;
//    $agent->primaryEmail   = $inputData->primaryEmail;
//    $agent->alternateNumber= $inputData->alternateNumber;
//    $agent->alternateEmail = $inputData->alternateEmail;
//    $agent->address        = $inputData->address;
//    $agent->countryId      = $inputData->countryId;
//    $agent->stateId        = $inputData->stateId;
//    $agent->cityId         = $inputData->cityId;
//    $agent->pincode        = $inputData->pincode;
//    $agent->commissionType = $inputData->commissionType;
//    //set comision target
//    $agent->commissionRatePerBooking  = $inputData->commissionRatePerBooking;
//    $agent->yearlyTarget   = $inputData->yearlyTarget;
    //////set incentives
//    $agent->incentiveArray = $inputData->incentiveArray;
//    $agent->accountNumber  = $inputData->accountNumber;
//    $agent->ifscCode       = $inputData->ifscCode;
//    $agent->branch         = $inputData->branch;
//    $agent->bankCity       = $inputData->bankCity;
//    $agent->panCard        = $inputData->panCard;
//    $agent->gstCertificate = $inputData->gstCertificate;
//    $agent->msmeCertificate= $inputData->msmeCertificate;
//    $agent->incorporationCertificate  = $inputData->incorporationCertificate;
//    $agent->voidCheque     = $inputData->voidCheque;
//    $agent->contractAgreement= $inputData->contractAgreement;
//    $agent->gmDateTime     = $gm_date_time;
//    $agent->agentToken     = $onboard->generateToken('service__distributor_agent','token');
//    $agent->agentId        = $onboard->generateToken('service__distributor_agent','agent_id');
//    $agent->distributorToken = $agent->userDistributorToken($stmt);
//    $agent->addAgent();
//    if($agent->commissionType==1){
//        $agent->commisionToken        = $onboard->generateToken('service__distributor_agent_commision','token');
//        $agent->addCommission();
//    }else{
//        $array = $agent->incentiveArray;
//        foreach($array as $value){
//            $token = $onboard->generateToken('service__distributor_agent_commision','token');
//            $agent->addIncentive(
//                $token, $value->bookingRangeFrom, $value->bookingRangeTo, $value->incentivePercentage
//            );
//        }
//    }
    $obj->status_code = 201;
    //$obj->data = $agent;
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>