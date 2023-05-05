<?php
include '../../../../config/core.php';
$input_data = getInputs();
    include_once '../objects/service-distributor.php';
    $obj = new stdClass;
    $service_distributor = new ServiceDistributor();
    $token = $service_distributor->tokenGenerate();
    $service_distributor->token = $token;
    $service_distributor->business_name = $input_data->business_name;
    $service_distributor->service_distributor_type = $input_data->business_type;
    $service_distributor->business_website = $input_data->business_website;
    $service_distributor->primary_country_code = $input_data->primary_country_code;
    $service_distributor->primary_mobile_number = $input_data->primary_mobile_number;
    $service_distributor->primary_emailId = $input_data->primary_emailId;
    $service_distributor->alternate_country_code = $input_data->alternate_country_code;
    $service_distributor->alternate_mobile_number = $input_data->alternate_mobile_number;
    $service_distributor->alternate_emailId = $input_data->alternate_emailId;
    $service_distributor->address = $input_data->address;
    $service_distributor->country_id = $input_data->country_id;
    $service_distributor->state_id = $input_data->state_id;
    $service_distributor->city_id = $input_data->city_id;
    $service_distributor->pincode = $input_data->pincode;
    $service_distributor->account_number = $input_data->account_number;
    $service_distributor->ifsc_code = $input_data->ifsc_code;
    $service_distributor->branch = $input_data->branch;
    $service_distributor->city = $input_data->city;
    $service_distributor->service_list = $input_data->service_list;  //get in array
    $service_distributor->selected_airport = $input_data->selected_airport; //get in array
    $service_distributor->pan_card = $input_data->pan_card;
    $service_distributor->gst_certificate = $input_data->gst_certificate;
    $service_distributor->msme_certificate = $input_data->msme_certificate;
    $service_distributor->certificate_incorporation = $input_data->certificate_incorporation;
    $service_distributor->void_cheque = $input_data->void_cheque;
    $service_distributor->contract_agreement = $input_data->contract_agreement;

    if ($service_distributor->addServiceDistributor($cur_date_time)) {
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Business Info Created Successfully";
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Unable to Create Business Info";
    }

echo json_encode($obj);
?>