<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

// include '../objects/users-booking.php';
// $users_booking = new UsersBooking();

// include '../objects/users-booking-detail.php';
// $users_booking_detail = new UsersBookingDetail();

// include '../objects/users-booking-passenger.php';
// $users_booking_passenger = new UsersBookingPassenger();

// include '../objects/users-booking-journey.php';
// $users_booking_journey = new UsersBookingJourney();

// include '../objects/airport.php';
// $airport = new Airport();

include 'fetch-order-detail.php';
$users_booking->token = $input_data->token;
echo fetchOrderDetail();
// echo fetchOrderDetail($input_data->token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
?>