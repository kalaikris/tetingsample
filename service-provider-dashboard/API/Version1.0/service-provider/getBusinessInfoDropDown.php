<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->securedairportzo == 'secured'){
    include_once '../objects/service-provider.php';
    $obj = new stdClass;
    $service_provider = new ServiceProvider();
    $business_data = $service_provider->getBusinessType();
    $city = $service_provider->getCityList();
    $region = $service_provider->getRegionsList();
    $country = $service_provider->getCountriesList();
    $airport = $service_provider->getAirportList();

        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Business Info Drop Down Values";
        $obj->business_type = $business_data;
        $obj->city_list = $city;
        $obj->region_list = $region;
        $obj->country_list = $country;
        $obj->airport_list = $airport;

echo json_encode($obj);
}
?>