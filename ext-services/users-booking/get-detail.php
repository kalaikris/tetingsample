<?php
//ini_set('display_errors', 1); // show error reporting
//error_reporting(E_ALL);

// $obj = new stdClass;
if (array_key_exists('REDIRECT_HTTP_AUTHORIZATION', $_SERVER)) {
    if ($_SERVER['REDIRECT_HTTP_AUTHORIZATION'] != '') {
        $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        $result = explode(" ", $authHeader, 2);
        $checkToken = $result[1];
        $auth_val = base64_decode($checkToken);
        $auth_array = explode(":", $auth_val);
        $auth_username = $auth_array[0];
        $auth_password = $auth_array[1];

        include '../config/core.php';
        $input_data = getInputs();

        $external_password = hashPassword($auth_password);

        include '../objects/service-distributor.php';
        $service_distributor = new ServiceDistributor();
        $service_distributor->external_user_name = $auth_username;
        $service_distributor->external_password = $external_password;
        $service_distributor->readDistributor();
        if ($service_distributor->stmt->rowCount() > 0) {
            if (isset($_GET['booking_number'])) {
                $booking_number = $_GET['booking_number'];

                include '../objects/users-booking.php';
                $users_booking = new UsersBooking();
                $users_booking->booking_number = $booking_number;
                $users_booking->readForBookingNumber();
                
                if ($users_booking->stmt->rowCount() > 0) {
                    $token = $users_booking->makeView()[0]->id;

                    include '../objects/users-booking-detail.php';
                    $users_booking_detail = new UsersBookingDetail();

                    include '../objects/users-booking-passenger.php';
                    $users_booking_passenger = new UsersBookingPassenger();

                    include '../objects/users-booking-journey.php';
                    $users_booking_journey = new UsersBookingJourney();

                    include '../objects/airport.php';
                    $airport = new Airport();

                    include 'fetch-order-detail.php';
                    $json_response = fetchOrderDetail($token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                    $booking_response = json_decode($json_response);
                    
                    if ($booking_response->status_code == 200) {
                        unset($booking_response->data->distributor_name);
                        unset($booking_response->data->distributor_email);
                        unset($booking_response->data->header_logo);
                        unset($booking_response->data->brand_colour);
                        unset($booking_response->data->markup_type);
                        unset($booking_response->data->markup_value);
                        foreach ($booking_response->data->station_array as $station_key => $station_value) {
                            unset($station_value->station_number);
                            foreach ($station_value->service_array as $service_key => $service_value) {
                                unset($service_value->user_token);
                                unset($service_value->service_date_time_raw);
                            }
                            unset($service_value);
                        }
                        unset($station_value);
                    }

                    $obj = new stdClass;
                    $obj = $booking_response->data;
                    echo json_encode($obj);
                } else {
                    initBadRequest();

                    // $obj = new stdClass;
                    // $obj->status_code = 400;
                    // $obj->message = "Booking number error !";
                    // $obj->data = [];
                }
            } else {
                initBadRequest();
                // $obj = new stdClass;
                // $obj->status_code = 400;
                // $obj->message = "Input error !";
                // $obj->data = [];
            }
        } else {
            dropAccess();
            // $obj = new stdClass;
            // $obj->status_code = 400;
            // $obj->message = "Authorization error occured !";
            // $obj->data = [];
        }
    } else {
        dropAccess();
        // $obj = new stdClass;
        // $obj->status_code = 400;
        // $obj->message = "Authorization missing !";
        // $obj->data = [];
    }
} else {
    dropAccess();
    // $obj = new stdClass;
    // $obj->status_code = 400;
    // $obj->message = "Authorization missing !";
    // $obj->data = [];
}
// echo json_encode($obj);

function dropAccess() {
    ob_start();
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

function initBadRequest() {
    ob_start();
    header('HTTP/1.0 400 BAD REQUEST');
    exit;
}
?>