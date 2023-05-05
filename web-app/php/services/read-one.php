<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

$obj = new stdClass;
include_once '../objects/business-type.php';
$business_type = new BusinessType();
$business_type->token = $business_type->business_type_token = $input_data->token;
$business_type->currency_code = $input_data->currency;
$business_type->readOne();
if ($business_type->stmt->rowCount() > 0) {
    $data = $business_type->makeView()[0];

    $business_type->readImagesForBusiness();
    $images = $business_type->makeArray();
    $data->images = $images;

    $business_type->readAvailServiceForBusiness();
    $avail_services = $business_type->makeNameImageView();
    $data->avail_services = $avail_services;

    $business_type->readServiceForBusiness();
    $services = $business_type->makeArray();
    $data->services = $services;

    $business_type->readPartnersForBusiness();
    $partners = $business_type->makeNameImageView();
    $data->partners = $partners;
    
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $data;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No service found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>