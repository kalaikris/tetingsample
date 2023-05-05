<?php
include '../../../config/core.php';

$input_data = getInputs();

include '../objects/users-booking-detail.php';
$users_booking_detail = new UsersBookingDetail();
$users_booking_detail->token = $input_data->booking_detail_token;
$users_booking_detail->comment = $input_data->comment_desc;
$users_booking_detail->comment_date_time = $gm_date_time;

$obj = new stdClass;
if($users_booking_detail->updateComment()) {
    $obj->status_code = 200;
    $obj->message = "Order commented successfully !";
    $obj->data = new stdClass;
} else {
    $obj->status_code = 400;
    $obj->message = 'Order comment failed ! Please try again later !';
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>