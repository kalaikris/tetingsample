<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

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
            // if (isset($_GET['booking_number'])) {
                $token = $input_data->booking_token;//$_GET['booking_number'];

                include '../objects/users-booking.php';
                $users_booking = new UsersBooking();
                $users_booking->token = $token;
                $users_booking->readForToken(); 
                
                $obj = new stdClass;
                if ($users_booking->stmt->rowCount() > 0) {
                    $users_booking_value = $users_booking->makeView()[0];
                    $booking_token = $users_booking_value->token;
                    $order_detail = [];
                    $passenger_detail = [];
                    $journey_detail = [];
                    
                    include '../objects/users-booking-detail.php';
                    $users_booking_detail = new UsersBookingDetail();

                    include '../objects/users-booking-passenger.php';
                    $users_booking_passenger = new UsersBookingPassenger();

                    include '../objects/users-booking-journey.php';
                    $users_booking_journey = new UsersBookingJourney();

                    include '../objects/airport.php'; 
                    $airport = new Airport();

                    include '../../config/cancel-detail.php';
                    $cancel_detail = new CancelDetails();

                    include '../config/currency.php';
            
                    $users_booking_journey->booking_token = $booking_token;
                    $users_booking_journey->readForBooking();
                    if ($users_booking_journey->stmt->rowCount() > 0) {
                        $journey_detail = $users_booking_journey->makeView();
                    }
            
                    $users_booking_detail->booking_token = $booking_token;
                    $users_booking_detail->readForBooking();
                    if ($users_booking_detail->stmt->rowCount() > 0) {
                        $users_booking_detail_array = $users_booking_detail->makeView1();
                        $users_booking_detail_array = splitBookingDetail($users_booking_detail_array);
                        $order_detail = $users_booking_detail_array;
                    }
                    foreach ($order_detail as $order_value) {
                        $order_airport_code = $order_value->airport_code;
                        $index = -1;
                        foreach ($journey_detail as $journey_key => $journey_value) {
                            if ($order_airport_code == $journey_value->depart_airport_code) {
                                $index = $journey_key;
                            }
                        }
                        unset($journey_value);
            
                        if ($index == -1) {
                            if ($journey_detail[sizeof($journey_detail) - 1]->arrival_airport_code == $order_airport_code) {
                                $order_value->airport_type = "Arrival";
                                $order_value->flight_number = $journey_detail[sizeof($journey_detail) - 1]->flight_number;
                            } else {
                                $order_value->airport_type = "";
                                $order_value->flight_number = "-";
                            }
                        } else if ($index == 0) {
                            $order_value->airport_type = "Departure";
                            $order_value->flight_number = $journey_detail[0]->flight_number;
                        } else {
                            $order_value->airport_type = "Transit";
                            $order_value->flight_number = $journey_detail[$index - 1]->flight_number . "," . $journey_detail[$index]->flight_number;
                        }
                    }
                    unset($order_value);
            
                    $users_booking_passenger->booking_token = $booking_token;
                    $users_booking_passenger->getPassengerForBooking();
                    if ($users_booking_passenger->stmt->rowCount() > 0) {
                        $passenger_detail = $users_booking_passenger->makeView();
                        foreach ($passenger_detail as $passenger_value) {
                            if ($passenger_value->date_of_birth != '1970-01-01') {
                                $passenger_value->age = getTimeDifference($passenger_value->date_of_birth);
                            } else {
                                $passenger_value->age = "-";
                            }
                        }
                        unset($passenger_value);
            
                        $passenger_detail = splitPassengers($passenger_detail);
                    }
            
                    $currency_from = 'INR';
                
                    $currency_to = $users_booking_value->currency;
                    $currency_output = changeCurrency($currency_from, $currency_to);
              
                    $airportzo_cancellation_fee = intval($users_booking_value->airportzo_cancel_fee);
                    $totalServiceCost = 0;
                    $totalCancellationFee = 0;
                    $totalAirportzoCancellationFee = 0;
                    $totalRefundAmount = 0;
                    $currency_symbol = '';
                    foreach ($order_detail as $order_value) {
                        $airport->token = $order_value->airport_token;
                        $airport->readOne();
                        $order_value->gmt_view = ($airport->stmt->rowCount() > 0)? $airport->makeView()[0]->gmt: ''; 
            
                        foreach ($order_value->order_detail_array as $service_detail) {

                            $cancel_detail->airportzo_cancellation_fee = $airportzo_cancellation_fee * $currency_output;
                            $cancel_detail->service_detail = $service_detail;
                            
                            if ($service_detail->status != 'Cancelled') {
                                $totalServiceCost += (float)($service_detail->net_amount);
                                $cancellation_detail = $cancel_detail->getCancelDetail_ext();
                            
                                if ($cancellation_detail !== false) {
                                    $service_detail->can_be_cancelled = true;
                                    $service_detail->cancellation_detail->service_cost = $cancellation_detail->service_cost;
                                    $service_detail->cancellation_detail->cancellation_hours = $cancellation_detail->cancellation_hours;
                                    $service_detail->cancellation_detail->cancellation_fee_perc = $cancellation_detail->cancellation_fee_perc;
                                    $service_detail->cancellation_detail->cancellation_fee = $cancellation_detail->cancellation_fee;
                                    $service_detail->cancellation_detail->airportzo_fee = $cancellation_detail->airportzo_fee;
                                    $service_detail->cancellation_detail->max_airportzo_fee = $cancellation_detail->max_airportzo_fee;
                                    $service_detail->cancellation_detail->refund_amount = $cancellation_detail->refund_amount;
                                }
                                $currency_symbol = $service_detail->currency=='INR' ? '₹' : '$';
                                $totalCancellationFee += (int)($service_detail->cancellation_detail->cancellation_fee);
                                $totalAirportzoCancellationFee += (int)($service_detail->cancellation_detail->airportzo_fee);
                                $totalRefundAmount += (int)($service_detail->cancellation_detail->refund_amount);
                            }
                        }
                        
                    }
                    unset($order_value);
            
                    $totalCancellationFee = round($totalCancellationFee);
                    $totalRefund = $totalServiceCost - $totalCancellationFee; // - (cancelServiceCount * airportzo_cancel_fee);

                    // $users_booking_value->order_detail = $order_detail;
                    // $users_booking_value->passenger_detail = $passenger_detail;
                    // $users_booking_value->journey_detail = $journey_detail;
                    $obj = new stdClass;
                    $obj->order_detail = $order_detail;
                    $obj->total_service_cost = $currency_symbol.number_format((float)$totalServiceCost, 2, '.', '');
                    $obj->total_cancellation_fee = '- '.$currency_symbol.$totalCancellationFee;
                    $obj->total_platform_fee = '- '.$currency_symbol.$totalAirportzoCancellationFee;
                    $obj->total_refundable_amount = $currency_symbol.$totalRefundAmount;
            
                    // $obj->status_code = 200;
                    // $obj->message = "Orders listed successfully !";
                    // $obj->data = $users_booking_cancel;
                    echo json_encode($obj);
                } else {
                    initBadRequest();
                    // $obj = new stdClass;
                    // $obj->status_code = 400;
                    // $obj->message = "Booking number error !";
                    // $obj->data = new stdClass;
                }
            // } else {
            //     $obj = new stdClass;
            //     $obj->status_code = 400;
            //     $obj->message = "Input error !";
            //     $obj->data = new stdClass;
            // }
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
function splitBookingDetail($users_booking_detail_array) {
    $grouped_array = [];
    foreach ($users_booking_detail_array as $users_booking_detail_value) {
        $booking_detail_obj = clone $users_booking_detail_value;
        // $booking_detail_obj = new stdClass;
        // $booking_detail_obj->id = $users_booking_detail_value->id;
        // $booking_detail_obj->token = $users_booking_detail_value->token;
        // $booking_detail_obj->booking_token = $users_booking_detail_value->booking_token;
        // $booking_detail_obj->company_token = $users_booking_detail_value->company_token;
        // $booking_detail_obj->company_name = $users_booking_detail_value->company_name;
        // $booking_detail_obj->company_email = $users_booking_detail_value->company_email;
        // $booking_detail_obj->company_logo = $users_booking_detail_value->company_logo;
        // $booking_detail_obj->company_image = $users_booking_detail_value->company_image;
        // $booking_detail_obj->service_date_time = $users_booking_detail_value->service_date_time;
        // $booking_detail_obj->service_date_time_raw = $users_booking_detail_value->service_date_time_raw;
        // $booking_detail_obj->service_token = $users_booking_detail_value->service_token;
        // $booking_detail_obj->service_name = $users_booking_detail_value->service_name;
        // $booking_detail_obj->service_type = $users_booking_detail_value->service_type;
        // $booking_detail_obj->service_location_token = $users_booking_detail_value->service_location_token;
        // $booking_detail_obj->journey_date = $users_booking_detail_value->journey_date;
        // $booking_detail_obj->date_time = $users_booking_detail_value->date_time;
        // $booking_detail_obj->flight_number = $users_booking_detail_value->flight_number;
        // $booking_detail_obj->status = $users_booking_detail_value->status;
        // $booking_detail_obj->adult_service_amount = $users_booking_detail_value->adult_service_amount;
        // $booking_detail_obj->total_adult = $users_booking_detail_value->total_adult;
        // $booking_detail_obj->children_service_amount = $users_booking_detail_value->children_service_amount;
        // $booking_detail_obj->total_children = $users_booking_detail_value->total_children;
        // $booking_detail_obj->net_amount = $users_booking_detail_value->net_amount;
        // $booking_detail_obj->rating = $users_booking_detail_value->rating;
        // $booking_detail_obj->review = $users_booking_detail_value->review;
        // $booking_detail_obj->notes = $users_booking_detail_value->notes;
        // $booking_detail_obj->description = $users_booking_detail_value->description;
        // $booking_detail_obj->report_reason_token = $users_booking_detail_value->report_reason_token;
        // $booking_detail_obj->report_description = $users_booking_detail_value->report_description;
        // $booking_detail_obj->cancellation_policy_detail = $users_booking_detail_value->cancellation_policy_detail;

        $airport_token = $users_booking_detail_value->airport_token;

        $index = -1;
        foreach ($grouped_array as $grouped_key => $grouped_value) {
            if ($grouped_value->airport_token == $airport_token) {
                $index = $grouped_key;
            }
        }
        unset($grouped_value);
        if ($index > -1) {
            $order_detail_array = $grouped_array[$index]->order_detail_array;
            array_push($order_detail_array, $booking_detail_obj);
            $grouped_array[$index]->order_detail_array = $order_detail_array;
        } else {
            $station_detail_obj = new stdClass;
            $station_detail_obj->airport_token = $airport_token;
            $station_detail_obj->gmt_view = '';
            $station_detail_obj->airport_name = $users_booking_detail_value->airport_name;
            $station_detail_obj->airport_code = $users_booking_detail_value->airport_code;
            $station_detail_obj->terminal_token = $users_booking_detail_value->terminal_token;
            $station_detail_obj->terminal_name = $users_booking_detail_value->terminal_name;
            $station_detail_obj->station_number = $users_booking_detail_value->station_number;
            $station_detail_obj->order_detail_array = [$booking_detail_obj];

            array_push($grouped_array, $station_detail_obj);
        }
    }

    return $grouped_array;
}
function splitPassengers($passenger_detail) {
    $grouped_array = [];

    foreach ($passenger_detail as $passenger_value) {
        $index = -1;
        foreach ($grouped_array as $grouped_key => $grouped_value) {
            if ($grouped_value->passenger_type == $passenger_value->passenger_type) {
                $index = $grouped_key;
            }
        }
        unset($grouped_value);

        if ($index > -1) {
            $passenger_array = $grouped_array[$index]->passenger_array;
            array_push($passenger_array, $passenger_value);
            $grouped_array[$index]->passenger_array = $passenger_array;
        } else {
            $grouped_obj = new stdClass;
            $grouped_obj->passenger_type = $passenger_value->passenger_type;
            $grouped_obj->passenger_array = [$passenger_value];
            array_push($grouped_array, $grouped_obj);
        }
    }
    unset($passenger_value);

    return $grouped_array;
}

?>