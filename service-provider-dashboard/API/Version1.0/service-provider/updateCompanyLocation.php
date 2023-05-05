<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->serviceProviderCompanyToken != ''){
    include_once '../objects/service-provider.php';
    $obj = new stdClass;
    $service_provider = new ServiceProvider();
                $service_provider->serviceProviderCompanyToken = $input_data->serviceProviderCompanyToken;
                $service_provider->airportToken = $input_data->airportToken;
                $service_provider->locationemailaddress = $input_data->locationemailaddress;
                $service_provider->pan_certificate = $input_data->pan_certificate;
                $service_provider->gst_certificate = $input_data->gst_certificate;
                $service_provider->msme_certificate = $input_data->msme_certificate;
                $service_provider->certificate_incorporation = $input_data->certificate_incorporation;
                $service_provider->voice_cheque = $input_data->void_cheque;
                $service_provider->certificate_agreement = $input_data->certificate_agreement;
                $service_provider->gst_number = $input_data->gst_number;
                $service_provider->pan_number = $input_data->pan_number;
                $service_provider->other_document1 = $input_data->other_document1;
                $service_provider->other_document2 = $input_data->other_document2;
                $service_provider->account_number = $input_data->account_number;
                $service_provider->ifsc_code = $input_data->ifsc_code;
                $service_provider->branch_name = $input_data->branch_name;
                $service_provider->cityname = $input_data->cityname;
        if ($service_provider->update_service_provider_location()) {   
            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Updated Location";//"Business Info Created Successfully";
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Unable to Create Business Info";
        }
}else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Please provide all details";
}

echo json_encode($obj);
?>