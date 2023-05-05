<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

if($input_data->payload->payment_link->entity->status == "paid"){
    include '../objects/users-booking.php';
    $users_booking = new UsersBooking();
    $users_booking->razorpay_plink_id = xss_clean($input_data->payload->payment_link->entity->id);
    $users_booking->razorpay_order_id = xss_clean($input_data->payload->payment_link->entity->order_id);
    $users_booking->razorpay_payment_id = xss_clean($input_data->payload->payment->entity->id);
    $users_booking->updaterazorpay_details();
}
?>