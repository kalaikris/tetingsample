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
            $service__distributor_data = $service_distributor->makeView()[0];
            // if (isset($_GET['booking_number'])) {
                $booking_number = $input_data->booking_number;//$_GET['booking_number'];

                include '../objects/users-booking.php';
                $users_booking = new UsersBooking();
                $users_booking->booking_number = $booking_number;
                $users_booking->readForBookingNumber();
                
                if ($users_booking->stmt->rowCount() > 0) {
                    $booking_token = $users_booking->makeView()[0]->id;

                    include '../objects/users-booking-detail.php';
                    $users_booking_detail = new UsersBookingDetail();

                    include '../objects/users-booking-passenger.php';
                    $users_booking_passenger = new UsersBookingPassenger();

                    include '../objects/users-booking-journey.php';
                    $users_booking_journey = new UsersBookingJourney();

                    include '../objects/airport.php';
                    $airport = new Airport();

                    include '../objects/service-location.php';
                    $service_location = new ServiceLocation();

                    include '../../config/cancel-detail.php';
                    $cancel_detail = new CancelDetails();

                    include '../config/currency.php';

                    include 'fetch-order-detail.php';
                    $json_response = fetchOrderDetail($booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                    $response = json_decode($json_response);
                    $booking_order_detail = $response->data;

                    $cancelled_services_count = 0;
                    $airportzo_cancel_fees = $booking_order_detail->airportzo_cancel_fee;
                    foreach ($booking_order_detail->station_array as $station_value) {
                        foreach ($station_value->service_array as $service_value) {
                            
                            // if ($service_value->status != 'Cancelled') { // && sizeof($service_value->cancellation_policy_detail) > 0
                            //     // if ($service_value->service_date_time_raw > $cur_date_time) {
                            //         $cancellation_hours = (strtotime($service_value->service_date_time_raw) - strtotime($cur_date_time)) / 3600;

                            //         $cancellation_fee = 100;
                            //         $refund_amount = 0;
                            //         foreach ($service_value->cancellation_policy_detail as $cancellation_policy_value) {
                            //             if (intval($cancellation_policy_value->hours_before_cancelling) < $cancellation_hours) {
                            //                 $temp_cancellation_fee = ((intval($cancellation_policy_value->cancellation_fee_percentage) / 100) * intval($service_value->price_detail->net_amount));
                            //                 if ($temp_cancellation_fee <= $cancellation_fee) { //($temp_cancellation_fee > 0 && ($cancellation_fee > $temp_cancellation_fee || $cancellation_fee == 0))
                            //                     $cancellation_fee = $temp_cancellation_fee;
                            //                     $refund_amount = intval($service_value->price_detail->net_amount) - $cancellation_fee;
                            //                 }
                            //             }
                            //         }
                            //         $users_booking_detail->token = $service_value->order_id;
                            //         $users_booking_detail->cancellation_hours = $cancellation_hours;
                            //         $users_booking_detail->cancellation_fee = $cancellation_fee;
                            //         $users_booking_detail->refund_amount = $refund_amount;
                            //         $users_booking_detail->user_token = $service_value->user_token;
                            //         $users_booking_detail->date_time = $cur_date_time;
                            //         if ($users_booking_detail->cancelOrder()) {
                            //             $cancelled_services_count++;
                            //         }
                            //     // }
                            // }

                            $currency_from = 'INR';
                
                            $currency_to = $booking_order_detail->currency;
                            $currency_output = changeCurrency($currency_from, $currency_to);

                            $cancel_detail->airportzo_cancellation_fee = $airportzo_cancel_fees * $currency_output;
                            $cancel_detail->service_detail = $service_value;
                            if ($service_value->status != 'Cancelled') {
                                    
                                $cancellation_detail = $cancel_detail->getCancelDetail_ext();
        
                                if ($cancellation_detail !== false) {
                                    $users_booking_detail->token = $service_value->order_id;
                                    $users_booking_detail->cancellation_hours = $cancellation_detail->cancellation_hours;
                                    $users_booking_detail->cancellation_fee = $cancellation_detail->cancellation_fee;
                                    $users_booking_detail->cancellation_percentage = $cancellation_detail->cancellation_fee_perc;
                                    $users_booking_detail->refund_amount = $cancellation_detail->refund_amount;
                                    $users_booking_detail->user_token = $service_value->user_token;
                                    $users_booking_detail->airportzo_cancellation_fee = intval($airportzo_cancel_fees);
                                    $users_booking_detail->date_time = $cur_date_time;
                                    $airportzo_cancellation_charge = $cancellation_detail->airportzo_fee;

                                    //distributor Cancel Booking Order
                                    $service_distributor->distributor_token = $service__distributor_data->token;
                                    $dist = $service_distributor->getCreditAvailableForServiceDistributor();
                                    if($dist->is_credit == '1'){
                                        $cancellation_cost =  (float)$service_value->net_amount * ($cancellation_detail->cancellation_fee_perc/100);
                                        $distributor_cancelled_credits = (((float)$service_value->net_amount) - ($cancellation_cost + $airportzo_cancellation_charge));
                                        $service_distributor->distributor_balance_credit = $dist->distributor_credits + $distributor_cancelled_credits;
                                        $service_distributor->updateDistributorCreditAvailableAmount();
                                    }
                                    //provider Cancel Booking Order
                                    $service_location->sp_company_token = $service_value->company_token;
                                    $service_location->airport_token = $service_value->airport_token;
                                    $commission_data = $service_location->getCommissionForServiceProvider();
                                    if($commission_data->is_credit == '1'){
                                        $netAmount = $service_value->net_amount-$service_value->markup_amount;
                                        $deduction_commission_amount_inservice =  $netAmount-$order_detail_value->az_sp_commision_amount;
                                        $cancel_cost = $deduction_commission_amount_inservice*$cancellation_detail->cancellation_fee_perc/100;
                                        $cancelled_credits = $deduction_commission_amount_inservice-$cancel_cost;
                                        $service_location->balance_provider_credits = $commission_data->provider_credits+$cancelled_credits;
                                        $service_location->service_provider = $commission_data->service_provider;
                                        $service_location->updateCreditAvailableAmount();
                                    }
                                    //Cancel Booking Order
                                    if ($users_booking_detail->cancelOrder()) {
                                        $cancelled_services_count++;
                                    }
                                }
                            }

                        }
                        unset($service_value);
                    }
                    unset($station_value);

                    if ($cancelled_services_count > 0) {
                        $json_response = fetchOrderDetail($booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                        $response = json_decode($json_response);
                        $booking_order_detail = $response->data;

                        $has_uncancelled_service = false;
                        foreach ($booking_order_detail->station_array as $station_value) {
                            foreach ($station_value->service_array as $service_value) {
                                if ($service_value->status != 'Cancelled') {
                                    $has_uncancelled_service = true;
                                }
                            }
                            unset($service_value);
                        }
                        unset($station_value);
                        if (!$has_uncancelled_service) {
                            $users_booking->token = $booking_token;
                            $users_booking->cancelBooking();
                        }

                        $json_response = fetchOrderDetail($booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                        $response = json_decode($json_response);
                        unset($response->data->markup_type);
                        unset($response->data->markup_value);
                        $booking_order_detail = $response->data;
                        foreach ($booking_order_detail->station_array as $station_value) {
                            foreach ($station_value->service_array as $service_value) {
                                unset($service_value->net_amount);
                            }
                            unset($service_value);
                        }

                        // $obj = new stdClass;
                        // $obj->status_code = 200;
                        // $obj->message = 'Service cancelled successfully !';
                        // $obj->data = new stdClass;
                        echo json_encode($booking_order_detail);
                    } else {
                        // $obj->status_code = 400;
                        // $obj->message = 'No services can be cancelled !';
                        // $obj->data = new stdClass;
                    }
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
?>