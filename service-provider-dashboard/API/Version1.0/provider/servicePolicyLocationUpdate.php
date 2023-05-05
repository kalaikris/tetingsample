<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
include_once '../objects/service_policies.php';
$policies = new ServicePolicies();
include_once '../objects/csvUpload.php';
$csvUpload = new csvUpload();
$csvUpload->gmDateTime  = $gm_date_time;
$policies->serviceLocationToken= $inputData->serviceLocationToken;
$policies->costOfAdult         = $inputData->costOfAdult;
$policies->costOfChild         = $inputData->costOfChild;
$policies->costOfAdultAdditional = $inputData->costOfAdultAdditional;
$policies->costOfChildAdditional = $inputData->costOfChildAdditional;
$policies->categoryToken       = $inputData->categoryToken;
$policies->airportTypeToken    = $inputData->airportTypeToken;
$newFeaturesArray              = $inputData->newFeaturesArray;
$companylocation_token         = $inputData->companylocation_token;
$provider_company_token = $inputData->service_provider_company_token;
$businessTypeToken    = $inputData->businessTypeToken;
$serviceToken    = $inputData->serviceToken;
$policies->deleteFeatures();
foreach($newFeaturesArray as $value){
    $stmtCheck = $policies->featureCheck($value);
    if($stmtCheck->rowCount()==0){
        $featureToken  = $provider->tokenGenerate('service__features','token');
        $policies->addNewFeatures($value,$featureToken,$gm_date_time);
    }else{
        $policies->updateFeatures($value);
    }
}
$locationAirportTTRDetails   = $policies->locationAirportTTRDetails();
$policies->existAirportToken = $locationAirportTTRDetails->airportToken;
$policies->existTerminalToken= $locationAirportTTRDetails->terminalToken;
$policies->existTypeToken    = $locationAirportTTRDetails->typeToken;
$policies->existCategoryToken= $locationAirportTTRDetails->categoryToken;

if($policies->categoryToken!="1122334457"){
    $policies->airportTypeToken = $policies->existTypeToken;
}
$stmtATTR = $policies->airportTTRCheck();
if($stmtATTR->rowCount()==0){
    $policies->airportTTRToken = $provider->tokenGenerate('airport__terminal_type_relation','token');
    $policies->createAirportTTRToken($gm_date_time);
}else{
    $policies->airportTTRToken = $policies->getAirportTTRToken($stmtATTR);
}
$policies->updateServiceLocationDetails();
$csvUpload->serviceProviderPriceLog($serviceToken,$provider_company_token,$businessTypeToken,$companylocation_token,$policies->costOfAdult,$policies->costOfChild,$policies->costOfAdultAdditional,$policies->costOfChildAdditional);
$obj->status_code  = 201;
$obj->message      = "Updated Successfully";
//$obj->policies     = $policies;
echo json_encode($obj);
?>