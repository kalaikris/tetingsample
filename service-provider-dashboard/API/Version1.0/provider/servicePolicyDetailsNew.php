<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service_policies.php';
$policies = new ServicePolicies();
$policies->serviceProviderLocationtoken = $inputData->serviceProviderLocationtoken;
$policies->locationAirportToken         = $policies->getLocationAirpotToken();

$policies->gmDateTime    = $gm_date_time;
$stmt          = $policies->serviceCompanyLocationDetails();
$stmtPhotos    = $policies->serviceCompanyLocationPhotos();
$stmtAmenities = $policies->serviceCompanyLocationAmenities();
$stmtHours     = $policies->serviceCompanyLocationHours();
//$stmtIndividual= $policies->serviceCompanyIndividualServices();
$stmtIndividual= $policies->serviceCompanyIndividualServicesNew();
$stmtBundle    = $policies->serviceCompanyBundleServices();
$stmtCharge    = $policies->serviceCancelCharge();
$obj->status_code      = 201;
$obj->locationDetails  = $policies->companyDetailsView($stmt);
$policies->aiprotToken = $obj->locationDetails->airportToken;
$obj->locationPhotos   = $policies->companyPhotosView($stmtPhotos);
$obj->locationAmenities= $policies->companyAmenitiesView($stmtAmenities);
$obj->locationHours    = $policies->companyHoursView($stmtHours);
//$obj->individualServices = $policies->companyIndividualServicesView($stmtIndividual);
$obj->individualServices = $policies->companyBundleServicesViewNew($stmtIndividual);
$obj->bundleServices     = $policies->companyBundleServicesViewNew($stmtBundle);
$obj->cancellationCharges= $policies->companyCancelChargeView($stmtCharge);
echo json_encode($obj);
?>