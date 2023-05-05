<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->service_provider_token != ''){
    include_once '../objects/service-provider.php';
    $obj = new stdClass;
    $service_provider = new ServiceProvider();
    $service_provider->service_provider_token = $input_data->service_provider_token;
    $stmts = $service_provider->checkIsServiceProviderExists();
    $nums = $stmts->rowCount();
    if($nums > 0){
        $company_token = $service_provider->tokenGenerate('service__provider_company','token');
        $service_provider->company_token = $company_token;
        $service_provider->business_type = $input_data->business_typeid;
        $service_provider->business_name = $input_data->business_name;
        $service_provider->company_logo = $input_data->company_logo;
        $service_provider->company_image = $input_data->company_image;
        $service_provider->business_website = $input_data->business_website;
        $service_provider->business_emailId = $input_data->business_email_address;
        $service_provider->business_country_code = $input_data->countryCode;
        $service_provider->business_mobile_no = $input_data->business_mobile_number;
        $service_provider->year_inception = $input_data->year_of_inception;
        $service_provider->primary_contact_title = $input_data->contactedperson;
        $service_provider->primary_contact_name = $input_data->primary_contactname;
        $service_provider->primary_emailId = $input_data->primary_emailaddress;
        $service_provider->primary_country_code = $input_data->primarymobilecode;
        $service_provider->primary_mobile_number = $input_data->primary_mobilenumber;
        $service_provider->designation = $input_data->designation;
        $service_provider->alternate_emailId = $input_data->alternative_emailaddress;
        $service_provider->alternate_country_code = $input_data->alternativemobilecode;
        $service_provider->alternate_mobile_number = $input_data->alternative_mobilenumber;
        $service_provider->address = $input_data->addressdetails;
        $service_provider->country_id = $input_data->countryid;
        $service_provider->state_id = $input_data->stateid;
        $service_provider->city_id = $input_data->cityid;
        $service_provider->pincode = $input_data->pincodedetails;
        $service_provider->total_service_location = count($input_data->service_provider_array);
        if ($service_provider->addBusinessInfo($gm_date_time)) {
            foreach($input_data->service_provider_array as $service_data){
                $token = $service_provider->tokenGenerate('service__provider_company_location','token');
                $service_provider->token = $token;
                $service_provider->company_token = $company_token;
                $service_provider->airport_token = $service_data->airportToken;
                $service_provider->locationemailaddress = $service_data->locationemailaddress;
                $service_provider->pan_certificate = $service_data->pan_certificate;
                $service_provider->gst_certificate = $service_data->gst_certificate;
                $service_provider->msme_certificate = $service_data->msme_certificate;
                $service_provider->certificate_incorporation = $service_data->certificate_incorporation;
                $service_provider->voice_cheque = $service_data->void_cheque;
                $service_provider->certificate_agreement = $service_data->certificate_agreement;
                $service_provider->gst_number = $service_data->gst_number;
                $service_provider->pan_number = $service_data->pan_number;
                $service_provider->other_document1 = $service_data->other_document1;
                $service_provider->other_document2 = $service_data->other_document2;
                $service_provider->account_number = $service_data->account_number;
                $service_provider->ifsc_code = $service_data->ifsc_code;
                $service_provider->branch_name = $service_data->branch_name;
                $service_provider->cityname = $service_data->cityname;
                $stmt = $service_provider->service_provider_company_location($gm_date_time);
            }
            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = $service_provider;//"Business Info Created Successfully";
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Unable to Create Business Info";
        }
    }else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Please provide valid service provider token";  
    }
}else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Please provide all details";
}

echo json_encode($obj);
?>