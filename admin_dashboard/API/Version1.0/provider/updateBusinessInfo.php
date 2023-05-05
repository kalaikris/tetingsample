<?php
include '../../../../config/core.php';
$input_data = getInputs();
$obj = new stdClass;
if($input_data->service_provider_company_token != ''){
    include_once '../objects/provider.php';
    $service_provider = new provider();
        $service_provider->service_provider_company_token = $input_data->service_provider_company_token;
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
        if ($service_provider->updateBusinessInfo()) {
            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Updated Business Info";//"Business Info Created Successfully";
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