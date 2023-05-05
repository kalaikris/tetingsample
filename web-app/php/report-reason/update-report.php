<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$booking_token = $input_data->token;

include '../objects/users-booking-detail.php';
$users_booking_detail = new UsersBookingDetail();
$users_booking_detail->token = $input_data->detail_token;
$users_booking_detail->report_reason_token = $input_data->report_token;
$users_booking_detail->report_description = $input_data->description;
$users_booking_detail->date_time = $gm_date_time;

$obj = new stdClass;
if($users_booking_detail->updateReport()) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Report updated succesfully !";
    $obj->data = new stdClass;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Reporting error occured ! Please try again after sometimes !";
    $obj->data = new stdClass;
}

echo json_encode($obj);
?>