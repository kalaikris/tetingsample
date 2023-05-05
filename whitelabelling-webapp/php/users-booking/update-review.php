<?php
include '../../../config/core.php';

$input_data = getInputs();

include '../objects/users-booking-detail.php';
$users_booking_detail = new UsersBookingDetail();
$users_booking_detail->token = $input_data->order_token;
$users_booking_detail->rating = $input_data->rating;
$users_booking_detail->review = $input_data->review;
$users_booking_detail->review_date_time = $gm_date_time;

$obj = new stdClass;
if ($users_booking_detail->updateReview()) {
    $obj->status_code = 200;
    $obj->message = "Order reviewed successfully !";
    $obj->data = new stdClass;
} else {
    $obj->status_code = 400;
    $obj->message = 'Order review failed ! Please try again later !';
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>