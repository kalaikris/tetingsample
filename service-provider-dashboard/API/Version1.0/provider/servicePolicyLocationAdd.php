<?php
$obj=new stdClass();
//include_once '../../../../config/core.php';
//$inputData = getInputs();
//include_once '../../../../config/database.php';
//include_once '../objects/service-provider.php';
//$provider = new ServiceProvider();
//include_once '../objects/service_policies.php';
//$policies = new ServicePolicies();
//$policies->serviceToken        = $inputData->serviceToken;
//$policies->costOfAdult         = $inputData->costOfAdult;
//$policies->costOfChild         = $inputData->costOfChild;
//$policies->categoryToken       = $inputData->categoryToken;
//$policies->airportTypeToken    = $inputData->airportTypeToken;
//$policies->existAirportToken   = $inputData->airportToken;
//$policies->existTerminalToken  = $inputData->terminalToken;
//$policies->serviceLocationToken= $provider->tokenGenerate('service__location','token');
//$newFeaturesArray    = $inputData->newFeaturesArray;
//foreach($newFeaturesArray as $value){
//    $stmtCheck = $policies->featureCheck($value);
//    if($stmtCheck->rowCount()==0){
//        $featureToken  = $provider->tokenGenerate('service__features','token');
//        $policies->addNewFeatures($value,$featureToken,$gm_date_time);
//    }
//}
//$stmtATTR = $policies->airportTTRCheck();
//if($stmtATTR->rowCount()==0){
//    $policies->airportTTRToken = $provider->tokenGenerate('airport__terminal_type_relation','token');
//    $policies->createAirportTTRToken($gm_date_time);
//}else{
//    $policies->airportTTRToken = $policies->getAirportTTRToken($stmtATTR);
//}
////$policies->addServiceLocationDetails();
$obj->status_code= "not in working";
//$obj->data       = $policies;
echo json_encode($obj);
?>