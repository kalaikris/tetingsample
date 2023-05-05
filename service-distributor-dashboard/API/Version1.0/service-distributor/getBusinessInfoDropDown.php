<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->securedairportzo == 'secured'){
    include_once '../objects/service-distributor.php';
    $obj = new stdClass;
    $service_distributor = new ServiceDistributor();
    $business_data = $service_distributor->getBusinessType();
    $city = $service_distributor->getCityList();
    $region = $service_distributor->getRegionsList();
    $country = $service_distributor->getCountriesList();
    $airport = $service_distributor->getAirportList();
    $serviceList = $service_distributor->chooseServiceList();

    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Business Info Drop Down Values";
    $obj->business_type = $business_data;
    $obj->city_list = $city;
    $obj->region_list = $region;
    $obj->country_list = $country;
    $obj->airport_list = $airport;
    $obj->services_avail_airport = $serviceList;

    echo json_encode($obj);
}
?>