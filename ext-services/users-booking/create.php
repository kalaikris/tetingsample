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

        $external_password = hashPassword($auth_password);

        include '../objects/service-distributor.php';
        $service_distributor = new ServiceDistributor();
        $service_distributor->external_user_name = $auth_username;
        $service_distributor->external_password = $external_password;
        $service_distributor->readDistributor();
        if ($service_distributor->stmt->rowCount() > 0) {
            $service__distributor_data = $service_distributor->makeView()[0];
            $user_token = '';
            // $user_token = $input_data->user_token;

            $input_data = getInputs();
            if ( validateInputs($input_data) ) {
                $e_ticket = (property_exists($input_data, 'e_ticket'))? $input_data->e_ticket: "";
                $contact_passenger = new stdClass;
                $other_passenger_array = [];
                $greet_passenger_array = [];

                $passenger_list = $input_data->passenger_list;
                foreach ($passenger_list as $pass_value) {
                    switch ($pass_value->passenger_type) {
                        case 'Primary':
                            $contact_passenger = $pass_value;
                            break;

                        case 'Others':
                            array_push($other_passenger_array, $pass_value);
                            break;

                        case 'Emergency':
                            array_push($greet_passenger_array, $pass_value);
                            break;
                    }
                }
                unset($pass_value);
                // $contact_passenger = $input_data->contact_passenger;

                include '../objects/users.php';
                $users = new Users();
                $users->distributor_token = $service__distributor_data->token;
                $users->title = $contact_passenger->title;
                $users->name = $contact_passenger->name;
                $users->country_code = $contact_passenger->country_code;
                $users->mobile_number = $contact_passenger->mobile_number;
                $users->email_id = $contact_passenger->email_id;
                $users->date_of_birth = $contact_passenger->date_of_birth;
                
                $users->getUser();
                if ($users->stmt->rowCount() > 0) {
                    $users_data = $users->makeView()[0];
                    $user_token = $users_data->token;
                    $users->token = $users_data->token;
                } else {
                    $user_token = genToken('users');
                    $users->token = $user_token;
                    $users->create();
                }
                if($input_data->gst_name != '' && $input_data->gst_number != ''){
                    $user_gstin_token = genToken('users__gstin');
                    $users->date_time = $cur_date_time;
                    $users->user_gstin_token = $user_gstin_token;
                    $users->gst_name = $input_data->gst_name;
                    $users->gst_number = $input_data->gst_number;
                    $users->user_gstin_create();
                }

                // if ($users->stmt->rowCount() > 0) {
                    include '../objects/users-booking.php';
                    $users_booking = new UsersBooking();
                    // $users_booking->order_id = xss_clean($input_data->razorpay_order_id);
                    // $users_booking->checkDuplicateOrder();
                    
                    // if ($users_booking->stmt->rowCount() == 0) {
                        // $users_data = $users->makeView()[0];

                        // include '../config/razor-pay.php';
                        // $razor_pay = new RazorPay();
                        // $razor_pay->order_id = xss_clean($input_data->razorpay_order_id);

                        // $payment_order = $razor_pay->getOrder();
                        // if (property_exists($payment_order, 'status')) {
                            // $paid_amount = 0;
                            // if ($payment_order->status == "paid") {
                                $currency = property_exists($input_data, 'currency')? $input_data->currency: 'INR';
                                // $paid_amount = $payment_order->amount / 100;
                                $paid_amount = $input_data->paid_amount;

                                include '../objects/airport-ttr.php';
                                $airport_ttr = new AirportTTR();

                                include '../objects/airport.php';
                                $airport = new Airport();

                                include '../objects/service-location.php';
                                $service_location = new ServiceLocation();

                                $total_service_cost = 0;
                                $total_service_count = 0;
                                $total_adult_count = 0;
                                $total_children_count = 0;

                                $station_array = $input_data->station_array;
                                foreach ($station_array as $key => $station_value) {
                                    $airport_ttr->airport_code = $station_value->airport_code;
                                    $airport_ttr->category_name = $station_value->category_name;
                                    $airport_ttr->terminal_name = $station_value->terminal_name;
                                    $airport_ttr->type_name = $station_value->type_name;
                                    $airport_ttr->getTerminalTTRDetail();
                                    if( $airport_ttr->stmt->rowCount()) {
                                        $station_value->ttr_detail = $airport_ttr->makeViewTTRDetail()[0];
                                        // $station_value->ttr_detail->flight_number = $station_value->flight_number;
                                        // $station_value->ttr_detail->journey = $station_value->journey;
                                        
                                        $service_location->airport_code = $station_value->airport_code;
                                        $service_location->terminal_name = $station_value->terminal_name;
                                        $service_location->category_name = $station_value->category_name;
                                        $service_location->type_name = $station_value->type_name;
                                        $service_location->distributor_token = $service__distributor_data->token;
                                        foreach ($station_value->service_array as $service_value) {
                                            // echo json_encode($service_value);
                                            $service_location->service_token = $service_value->service_token;
                                            $service_location->searchServicesForStationAndServiceToken();
                                            if ($service_location->stmt->rowCount() > 0) {
                                                $total_service_count++;
                                                // $total_adult_count = ($total_adult_count < $service_value->adult_count)? $total_adult_count: $service_value->adult_count;
                                                // $total_children_count = ($total_children_count < $service_value->children_count)? $total_children_count: $service_value->children_count;
                                    
                                                
                                                $total_adult_count = ($total_adult_count < $service_value->adult_count)? $total_adult_count: $service_value->adult_count;
                                                $total_children_count = ($total_children_count < $service_value->children_count)? $total_children_count: $service_value->children_count;

                                                $service_location_value = $service_location->makeView()[0];

                                                $net_service_cost = 0;
                                                if ($service_location_value->additional_price_adult > 0 && $service_value->adult_count > 1) {
                                                    $net_service_cost += ($service_location_value->price_adult + (($service_value->adult_count-1) * $service_location_value->additional_price_adult));
                                                } else {
                                                    $net_service_cost += $service_value->adult_count * $service_location_value->price_adult;
                                                }
                                                if ($service_location_value->additional_price_children > 0 && $service_value->children_count > 1) {
                                                    $net_service_cost += ($service_location_value->price_children + (($service_value->children_count-1) * $service_location_value->additional_price_children));
                                                } else {
                                                    $net_service_cost += $service_value->children_count * $service_location_value->price_children;
                                                }
    
//                                                $service_location_value = $service_location->makeView()[0]; 
//                                                $net_service_cost = intval(($service_value->adult_count * $service_location_value->price_adult) + ($service_value->children_count * $service_location_value->price_children));
                                                $total_service_cost += $net_service_cost;
                                                $service_location_value->net_amount = $net_service_cost;
                                                $service_value->ttr_detail = $service_location_value;
                                            }
                                        }
                                        unset($service_value);
                                    } else {
                                        initBadRequest();
                                    }
                                }
                                unset($station_value);
                
                                $price_data = split_price_wo_convenience($total_service_cost);
                                $total_price = $price_data->total_cost;
                                if ($currency != 'INR') {
                                    include '../config/currency.php';
                                    $currency_value = changeCurrency("INR", $currency);
                                    if($currency_value > 0) {
                                        $total_price = $total_price * $currency_value;
                                        $total_price = number_format((float)$total_price, 2, '.', '');
                                    }
                                }
                                //  echo $paid_amount.'\n';
                                //  echo $total_price;
                                if ($paid_amount == $total_price) {
                                    // $other_passenger_array = $input_data->other_passenger;
                                    
                                    $total_adult_count = 1;
                                    foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                                        $age = getTimeDifference( $other_passenger_value->date_of_birth );
                                        if (strpos($age, 'yrs') !== false) {//str_contains($age, 'yrs')) {
                                            $age = intval( rtrim($age, " yrs") );
                                            if ($age >= 12) {
                                                $total_adult_count++;
                                            } else {
                                                $total_children_count++;
                                            }
                                        }
                                    }
                                    unset($other_passenger_value);

                                    include '../objects/users-external-journey.php';
                                    $users_ext_journey = new UsersExtJourney();
                                    $users_ext_journey->token = $input_data->journey_token;
                                    $users_ext_journey->sd_token = $service__distributor_data->token;
                                    $users_ext_journey->getJourneyForToken();
                    
                                    if ($users_ext_journey->stmt->rowCount() > 0) {
                                        $journey_json = $users_ext_journey->makeView()[0]->journey;
                                        $journey_array = json_decode($journey_json, true);
                                        // $journey_array = $input_data->journey_array;

                                        $journey_count = sizeof($journey_array);
                                        $journey_array = parseJourney($airport, $airport_ttr, $journey_array, $journey_count);

                                        $station_code_array = parseStationCodesFromJourney($journey_array);
                                        $journey = implode(" - ", $station_code_array);

                                        $booking_token = genToken('users__booking');
                                        $booking_number = rand(111111111111, 999999999999);

                                        $notes = property_exists($input_data, 'notes')? $input_data->notes: "";

                                        $users_booking->date_time = $cur_date_time;
                                        $users_booking->token = $booking_token;
                                        $users_booking->is_airportzo_user = 0;
                                        $users_booking->service_distributor_token = $service__distributor_data->token;
                                        $users_booking->booking_number = $booking_number;
                                        $users_booking->user_token = $user_token;
                                        $users_booking->for_others = property_exists($input_data, "for_others")? ($input_data->for_others? "1": "0"): "0";
                                        $users_booking->journey = $journey;
                                        $users_booking->service_amount = $price_data->service_cost_excl_gst;
                                        $users_booking->service_gst = $price_data->service_cost_gst;
                                        $users_booking->convenience_fee = $price_data->convenience_cost;
                                        $users_booking->cf_tax = $price_data->convenience_cost_gst;
                                        $users_booking->total_amount = $price_data->total_cost;
                                        $users_booking->currency = $currency; //"INR";
                                        $users_booking->payment_view = $paid_amount;
                                        $users_booking->total_service = $total_service_count;
                                        $users_booking->total_adult = $total_adult_count;
                                        $users_booking->total_children = $total_children_count;
                                        $users_booking->booking_type = 'External Api';
                                        $users_booking->e_ticket = $e_ticket;
                                        $users_booking->pancard_number = xss_clean($input_data->panNumber);
                                        $users_booking->gst_name = xss_clean($input_data->gst_name);
                                        $users_booking->gst_number = xss_clean($input_data->gst_number);
                                        $users_booking->description_one = xss_clean($notes);
                                        $users_booking->description_two = '';//$input_data->bouqueteer;
                                        $users_booking->payment_id = ""; //$input_data->razorpay_payment_id;
                                        $users_booking->order_id = ""; //$input_data->razorpay_order_id;
                                        $users_booking->signature = ""; //$input_data->razorpay_signature;
                                        $users_booking->invoice_pdf = $base_url . 'invoice_pdf/' . $booking_token . '.pdf';
                                        if( $users_booking->create() ) {
                                            include '../objects/users-booking-detail.php';
                                            $users_booking_detail = new UsersBookingDetail();
                                            $users_booking_detail->booking_token = $booking_token;
                                            $users_booking_detail->date_time = $cur_date_time;
                                            // print_r(json_encode($station_array));
                                            $total_commission_amount = 0;
                                            $commission_percent = 0;
                                            $commission_obj = new stdClass;
                                            foreach ($station_array as $station_key => $station_value) {
                                                // echo json_encode($station_value->ttr_detail);
                                                $users_booking_detail->airport_type = $station_value->ttr_detail->type_token;
                                                $users_booking_detail->airport_category = $station_value->ttr_detail->category_token;
                                                $users_booking_detail->airport_token = $station_value->ttr_detail->airport_token;
                                                $service_location->airport_token = $station_value->ttr_detail->airport_token;//added airport token
                                                $users_booking_detail->terminal_token = $station_value->ttr_detail->terminal_token;
                                                $users_booking_detail->station_number = $station_key + 1;
                                                $users_booking_detail->journey_date = '0000-00-00';
                                                $users_booking_detail->journey = ""; //$station_value->ttr_detail->journey;
                                                $users_booking_detail->flight_number = ""; //$station_value->ttr_detail->flight_number;
                                                foreach ($station_value->service_array as $service_value) {
                                                    $users_booking_detail->token = genToken('users__booking_detail');
                                                    $users_booking_detail->service_date_time = $service_value->service_date_time; //date('Y-m-d', strtotime($service_value->service_date)) . ' ' . date('H:i:s', strtotime($service_value->service_time));
                                                    $users_booking_detail->service_token = $service_value->ttr_detail->service_token;
                                                    $users_booking_detail->service_name = $service_value->ttr_detail->service_name;
                                                    $users_booking_detail->service_type = $service_value->ttr_detail->package_type;
                                                    $users_booking_detail->service_location_token = $service_value->ttr_detail->service__location_token;
                                                    $users_booking_detail->company_token = $service_value->ttr_detail->service_provider_token;
                                                    $users_booking_detail->adult_service_amount = $service_value->ttr_detail->price_adult;
                                                    $users_booking_detail->additional_price_adult = $service_value->ttr_detail->additional_price_adult;
                                                    $users_booking_detail->total_adult = $service_value->adult_count;
                                                    $users_booking_detail->children_service_amount = $service_value->ttr_detail->price_children;
                                                    $users_booking_detail->additional_price_children = $service_value->ttr_detail->additional_price_children;
                                                    $users_booking_detail->total_children = $service_value->children_count;
                                                    $users_booking_detail->net_amount = $service_value->ttr_detail->net_amount;
                                                    $users_booking_detail->markup_type = $service_value->ttr_detail->markupType;
                                                    $users_booking_detail->is_markup = $service_value->ttr_detail->is_markup;
                                                    $users_booking_detail->markupPercentage = $service_location_value->markupPercentage;
                                                    // $users_booking_detail->markup_value = $service_value->ttr_detail->markup_value;
                                                    //markup Calculation
                                    // print_r(json_encode($service_value->ttr_detail));
                                    $markupAmount = 0;
                                    $oringalAmount = 0;
                                    if ((int) $service_value->ttr_detail->is_markup == 1) {
                                        
                                        $adult_ct = 0;
                                        $add_adult_ct = 0;
                                        $child_ct = 0;
                                        $add_child_ct = 0;
                                        if ($service_value->ttr_detail->markupType == 'Percentage') {
                                            $markupValue = (($service_value->ttr_detail->markupPercentage) / 100) + 1;
                                            if ($service_value->adult_count <= 1) {
                                                $adult_ct = $service_value->adult_count;
                                                $add_adult_ct = 0;
                                            } else {
                                                $adult_ct = 1;
                                                $add_adult_ct = (int) $service_value->adult_count - 1;
                                            }
                                            if ($service_value->children_count <= 1) {
                                                $child_ct = $service_value->children_count;
                                                $add_child_ct = 0;
                                            } else {
                                                $child_ct = 1;
                                                $add_child_ct = (int) $service_value->children_count - 1;
                                            }

                                            //Adult
                                            $markupAmount += ($adult_ct * $service_value->ttr_detail->price_adult) / $markupValue;
                                            $oringalAmount += ($adult_ct * $service_value->ttr_detail->price_adult);
                                            
                                            //Children
                                            $markupAmount += ($child_ct * $service_value->ttr_detail->price_children) / $markupValue;
                                            $oringalAmount += ($child_ct * $service_value->ttr_detail->price_children);
                                           
                                            //Additional Adult
                                            if ($service_value->ttr_detail->additional_price_adult == 0 && $add_adult_ct > 0) {
                                                $markupAmount += ($add_adult_ct * $service_value->ttr_detail->price_adult) / $markupValue;
                                                $oringalAmount += ($add_adult_ct * $service_value->ttr_detail->price_adult);
                                            } else {
                                                $markupAmount += ($add_adult_ct * $service_value->ttr_detail->additional_price_adult) / $markupValue;
                                                $oringalAmount += ($add_adult_ct * $service_value->ttr_detail->additional_price_adult);
                                            }
                                           
                                            //Additional Children
                                            if ($service_value->ttr_detail->price_children == 0 && $add_child_ct > 0) {
                                                $markupAmount += ($add_child_ct * $service_value->ttr_detail->price_children) / $markupValue;
                                                $oringalAmount += ($add_child_ct * $service_value->ttr_detail->price_children);
                                            } else {
                                                $markupAmount += ($add_child_ct * $service_value->ttr_detail->additional_price_children) / $markupValue;
                                                $oringalAmount += ($add_child_ct * $service_value->ttr_detail->additional_price_children);
                                            }
                                           
                                        } else {
                                            $markupValue = (int)$service_value->ttr_detail->markupPercentage;
                                            if ($service_value->adult_count <= 1) {
                                                $adult_ct = $service_value->adult_count;
                                                $add_adult_ct = 0;
                                            } else {
                                                $adult_ct = 1;
                                                $add_adult_ct = (int) $service_value->adult_count - 1;
                                            }
                                            if ($service_value->children_count <= 1) {
                                                $child_ct = $service_value->children_count;
                                                $add_child_ct = 0;
                                            } else {
                                                $child_ct = 1;
                                                $add_child_ct = (int) $service_value->children_count - 1;
                                            }

                                            //Adult
                                            $markupAmount += ($adult_ct * $service_value->ttr_detail->price_adult) - $markupValue;
                                            $oringalAmount += ($adult_ct * $service_value->ttr_detail->price_adult);

                                            //Children
                                            if ($child_ct > 0) {
                                                $markupAmount += ($child_ct * $service_value->ttr_detail->price_children) - $markupValue;
                                                $oringalAmount += ($child_ct * $service_value->ttr_detail->price_children);
                                            }

                                            //Additional Adult
                                            if ($add_adult_ct > 0) {

                                                if ($service_value->ttr_detail->additional_price_adult == 0 && $add_adult_ct > 0) {
                                                    $markupAmount += ($add_adult_ct * $service_value->ttr_detail->price_adult) - ($markupValue * $add_adult_ct);
                                                    $oringalAmount += ($add_adult_ct * $service_value->ttr_detail->price_adult);
                                                } else {
                                                    $markupAmount += ($add_adult_ct * $service_value->ttr_detail->additional_price_adult) - ($markupValue * $add_adult_ct);
                                                    $oringalAmount += ($add_adult_ct * $service_value->ttr_detail->additional_price_adult);
                                                }
                                            }

                                            //Additional Children
                                            if ($add_child_ct > 0) {
                                                if ($service_value->ttr_detail->price_children == 0 && $add_child_ct > 0) {
                                                    $markupAmount += ($add_child_ct * $service_value->ttr_detail->price_children) - ($markupValue * $add_child_ct);
                                                    $oringalAmount += ($add_child_ct * $service_value->ttr_detail->price_children);
                                                } else {
                                                    $markupAmount += ($add_child_ct * $service_value->ttr_detail->additional_price_children) - ($markupValue * $add_child_ct);
                                                    $oringalAmount += ($add_child_ct * $service_value->ttr_detail->additional_price_children);
                                                }
                                            }
                                        }
                                    }
                                    $markupAmount = abs(round($oringalAmount - $markupAmount));
                                    //markup calculation

                                                    //commission_charge
                                                    //distributor_commission_charge
                                                    $service_distributor->distributor_token = $service__distributor_data->token;
                                                    $distributor = $service_distributor->getCreditAvailableForServiceDistributor();
                                                    if($distributor->is_credit == '1'){
                                                        if ((int) $service_value->ttr_detail->is_markup != 1) { //no markup 
                                                            $commission_amount = round($service_value->ttr_detail->net_amount * $service__distributor_data->commission_percentage / 100);
                                                        } else if ((int) $service_value->ttr_detail->is_markup == 1) { //With Markup 
                                                            $calculate_commission = round(($service_value->ttr_detail->net_amount - $markupAmount) * $service__distributor_data->commission_percentage / 100);
                                                            $commission_amount = $calculate_commission + $markupAmount;
                                                        }
                                                        $commission_obj->commission_percentage = $service__distributor_data->commission_percentage;
                                                        $commission_obj->total_commission_amount += $commission_amount;
                                                        $balance_credit = $distributor->distributor_credits-$service_value->ttr_detail->net_amount;
                                                        $users_booking_detail->distributor_commission_percentage = $service__distributor_data->commission_percentage;
                                                        $users_booking_detail->distributor_commission_amount = $commission_amount;
                                                        $users_booking_detail->distributor_previous_credit = $distributor->distributor_credits;
                                                        $users_booking_detail->distributor_balance_credit = $balance_credit;
                                                    }else{
                                                        $users_booking_detail->distributor_commission_percentage = '0';
                                                        $users_booking_detail->distributor_commission_amount = '0';
                                                        $users_booking_detail->distributor_previous_credit = '0';
                                                        $users_booking_detail->distributor_balance_credit = '0';
                                                    }
                                                    //provider_commission_chare
                                                    $service_location->sp_company_token = $service_value->ttr_detail->service_provider_token;
                                                    $commission_data = $service_location->getCommissionForServiceProvider();
                                                    if($commission_data->is_credit == '1'){
                                                        $serviceCost = $service_value->ttr_detail->net_amount-$service_location_value->markupAmount;
                                                        $provider_commission_amount = $serviceCost*$commission_data->commission_percentage/100;
                                                        $total_cost = $serviceCost-$provider_commission_amount;
                                                        $service_location->balance_provider_credits = $commission_data->provider_credits-$total_cost;
                                                        $service_location->service_provider = $commission_data->service_provider;
                                                        $service_location->updateCreditAvailableAmount();
                                                        $users_booking_detail->provider_commission_percentage = $commission_data->commission_percentage;
                                                        $users_booking_detail->provider_commission_amount = $provider_commission_amount;
                                                        $users_booking_detail->previous_provider_credits = $commission_data->provider_credits;
                                                        $users_booking_detail->balance_provider_credits = $service_location->balance_provider_credits;
                                                        $service_distributor->distributor_balance_credit = $balance_credit;
                                                        $service_distributor->updateDistributorCreditAvailableAmount();
                                                    }else{
                                                        $users_booking_detail->provider_commission_percentage = '0';
                                                        $users_booking_detail->provider_commission_amount = '0';
                                                        $users_booking_detail->previous_provider_credits = '0';
                                                        $users_booking_detail->balance_provider_credits = '0';
                                                    }
                                                    //commission_charge
                                                    $users_booking_detail->notes = property_exists($service_value, 'notes')? $service_value->notes: '';
                                                    //markup
                                                    
                                                    // $users_booking_detail->markupAmount = ($service_value->adult_count + $service_value->children_count) * $service_location_value->markupAmount;
                                                    $users_booking_detail->markupAmount = $markupAmount;
                                                    $users_booking_detail->create();
                                                }
                                                unset($service_value);
                                            }
                                            unset($station_value);

                                            if (sizeof($journey_array) > 0) {
                                                include '../objects/users-booking-journey.php';
                                                $users_booking_journey = new UsersBookingJourney();
                                                foreach ($journey_array as $journey_key => $journey_value) {
                                                    $users_booking_journey->token = genToken('users__booking_journey');
                                                    $users_booking_journey->booking_token = $booking_token;
                                                    $users_booking_journey->depart_ttr_token = $journey_value->depart_station->ttr_token;
                                                    $users_booking_journey->arrival_ttr_token = $journey_value->arrival_station->ttr_token;
                                                    $users_booking_journey->depart_date = date('Y-m-d', strtotime($journey_value->departure_date));
                                                    $users_booking_journey->flight_number = $journey_value->flight_number;
                                                    $users_booking_journey->create();
                                                }
                                                unset($journey_value);
                                            }

                                            include '../objects/users-passenger.php';
                                            $users_passenger = new UsersPassenger();

                                            include '../objects/users-booking-passenger.php';
                                            $users_booking_passenger = new UsersBookingPassenger();

                                            // For contact passenger
                                            makeBookingPassengerEntry($user_token, $booking_token, $contact_passenger, $users_booking_passenger, $users_passenger, 'Contact');

                                            // For other passengers
                                            if (sizeof($other_passenger_array) > 0) {
                                                foreach ($other_passenger_array as $other_passenger_value) {
                                                    makeBookingPassengerEntry($user_token, $booking_token, $other_passenger_value, $users_booking_passenger, $users_passenger, 'Others');
                                                }
                                                unset($other_passenger_value);
                                            }

                                            // For greet passengers
                                            // $greet_passenger_array = $input_data->greet_passenger;
                                            if (sizeof($greet_passenger_array) > 0) {
                                                foreach ($greet_passenger_array as $greet_passenger_value) {
                                                    makeBookingPassengerEntry($user_token, $booking_token, $greet_passenger_value, $users_booking_passenger, $users_passenger, 'Greeter');
                                                }
                                                unset($greet_passenger_value);
                                            }

                                            include 'fetch-order-detail.php';
                                            $json_booking_response = fetchOrderDetail($booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                                            $booking_response = json_decode($json_booking_response);
                                            if ($booking_response->status_code == 200) {
                                                $booking_detail = $booking_response->data;

                                                include '../objects/mail-order.php';
                                                $mail_order = new MailTemplateOrder();

                                                include '../../config/mailer.php';
                                                $mailerObj = new stdClass;
                                                $mailerObj->e_ticket = $e_ticket;

                                                $done_email = [];
                                                $mailer_err = "";
                                                $distributor_name = (property_exists($booking_detail, 'distributor_name'))? (($booking_detail->distributor_name && $booking_detail->distributor_name != '')? $booking_detail->distributor_name:$admin_user_name):$admin_user_name;
                                                $distributor_email = (property_exists($booking_detail, 'distributor_email'))? (($booking_detail->distributor_email && $booking_detail->distributor_email != '')? $booking_detail->distributor_email: $admin_email): $admin_email;
                                                if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {
                                                    $booking_detail->need_footer = true;

                                                    $mail_order->mail_obj = $booking_detail;
                                                    $mail_template = $mail_order->genMailContentForAdminAndUser();
                                                    
                                                    $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
                                                    $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                                                    $mailerObj->subject = $distributor_name . ' - Service booked #' . $booking_detail->booking_number;
                                                    $mailerObj->mail_template = $mail_template;

                                                    $mailerResponse = sendMail($mailerObj);
                                                    if ($mailerResponse) {
                                                        $mailerObj->email_id = $admin_email;
                                                        $mailerObj->user_name = $admin_user_name;
                                                        $mailerObj->subject = $distributor_name . ' - Service booked #' . $booking_detail->booking_number;
                                                        $adminMailerResponse = sendMail($mailerObj);
                                                        if ($adminMailerResponse) {
                                                            array_push($done_email, "admin");
                                                        }

                                                        array_push($done_email, "user");
                                                    } else {
                                                        $mailer_err = $mailerResponse;
                                                    }
                                                }
                                                if ($service__distributor_data->email != '') {
                                                    $booking_detail->need_footer = false;

                                                    $mail_order->mail_obj = $booking_detail;
                                                    $mail_template = $mail_order->genMailContentForAdminAndUser();

                                                    $mailerObj->email_id = $service__distributor_data->email;
                                                    $mailerObj->user_name = $service__distributor_data->name;
                                                    $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
                                                    $mailerObj->mail_template = $mail_template;

                                                    $mailerResponse = sendMail($mailerObj);
                                                    if ($mailerResponse) {
                                                        array_push($done_email, "admin");
                                                    } else {
                                                        $mailer_err = $mailerResponse;
                                                    }
                                                }

                                                $sp_service_array = [];
                                                foreach ($booking_detail->station_array as $station_key => $station_value) {
                                                    foreach ($station_value->service_array as $service_key => $service_value) {
                                                        if ($service_value->service_provider->email != '') {
                                                            $index = -1;
                                                            foreach ($sp_service_array as $sp_service_key => $sp_service_value) {
                                                                if ($sp_service_value->company_name == $service_value->service_provider->name) {
                                                                    $index = $sp_service_key;
                                                                }
                                                            }
                                                            unset($sp_service_value);

                                                            if ($index > -1) {
                                                                $sp_service_obj = $sp_service_array[$index];

                                                                $station_index = -1;
                                                                foreach ($sp_service_obj->station_array as $sp_station_key => $sp_station_value) {
                                                                    if ($sp_station_value->station_number == $station_value->station_number) {
                                                                        $station_index = $sp_station_key;
                                                                    }
                                                                }
                                                                unset($sp_station_value);

                                                                if ($station_index > -1) {
                                                                    $temp_sp_service_array = $sp_service_array[$index]->station_array[$station_index]->service_array;
                                                                    array_push($temp_sp_service_array, $service_value);
                                                                    $sp_service_array[$index]->station_array[$station_index]->service_array = $temp_sp_service_array;
                                                                } else {
                                                                    $sp_station_obj = clone $station_value;
                                                                    $sp_station_obj->service_array = [$service_value];

                                                                    $temp_station_array = $sp_service_array[$index]->station_array;
                                                                    array_push($temp_station_array, $sp_station_obj);
                                                                    $sp_service_array[$index]->station_array = $temp_station_array;
                                                                }
                                                            } else {
                                                                $sp_station_obj = clone $station_value;
                                                                $sp_station_obj->service_array = [$service_value];

                                                                $sp_service_obj = new stdClass;
                                                                // $sp_service_obj->company_token = $service_value->company_token;
                                                                $sp_service_obj->company_name = $service_value->service_provider->name;
                                                                $sp_service_obj->company_email = $service_value->service_provider->email;
                                                                $sp_service_obj->company_logo = $service_value->service_provider->logo;
                                                                $sp_service_obj->company_image = $service_value->service_provider->image;
                                                                $sp_service_obj->total_adult = $service_value->price_detail->total_adult;
                                                                $sp_service_obj->total_children = $service_value->price_detail->total_children;
                                                                $sp_service_obj->booking_number = $booking_detail->booking_number;
                                                                $sp_service_obj->date_time = $booking_detail->date_time;
                                                                $sp_service_obj->description_one = $booking_detail->notes;
                                                                // $sp_service_obj->description_two = $booking_detail->description_two;
                                                                $sp_service_obj->passenger_detail = $booking_detail->passenger_detail;
                                                                $sp_service_obj->journey_detail = $booking_detail->journey_array;
                                                                $sp_service_obj->station_array = [$sp_station_obj];
                                                                array_push($sp_service_array, $sp_service_obj);
                                                            }
                                                        }
                                                    }
                                                    unset($service_value);
                                                }
                                                unset($order_value);

                                                foreach ($sp_service_array as $sp_service_value) {
                                                    $mail_order->mail_obj = $sp_service_value;
                                                    $mail_template = $mail_order->genMailContentForServiceProvider();

                                                    $mailerObj->email_id = $sp_service_value->company_email;
                                                    $mailerObj->user_name = $sp_service_value->company_name;
                                                    $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
                                                    $mailerObj->mail_template = $mail_template;

                                                    $mailerResponse = sendMail($mailerObj);
                                                    if ($mailerResponse) {
                                                        array_push($done_email, "service-provider");
                                                    } else {
                                                        $mailer_err = $mailerResponse;
                                                    }
                                                }

                                                include '../objects/invoice-order.php';
                                                $invoice = new InvoiceTemplateOrder();
                                                $invoice->invoice_obj = $booking_detail;
                                                $invoice_template = $invoice->genInvoiceForOrder();

                                                // include '../../TCPDF-main/store-pdf.php';
                                                savePdf($invoice_template, $booking_token.'.pdf'); //$source_path, $add_page
                                            }
                                            
                                            $data = new stdClass;
                                            $data->journey = $journey;
                                            $data->booking_number = $booking_number;
                                            $data->markup_type = $service_location_value->markupType;
                                            $data->markup_amount = $service_location_value->markupPercentage;
                                            $data->commission = $commission_obj;
                                            $data->station_array = $booking_detail->station_array;

                                            header('HTTP/1.0 201 Created');
                                            echo json_encode($data);

                                            // $obj->status_code = 200;
                                            // $obj->message = "Order placed successfuly !";
                                            // $obj->data = $data;
                                        } else {
                                            ob_start();
                                            header('HTTP/1.0 417 Expectation Failed');
                                            exit;
                                            
                                            // $obj->status_code = 400;
                                            // $obj->message = "Order creation error !";
                                            // $obj->data = new stdClass;
                                        }
                                    } else {
                                        ob_start();
                                        header('HTTP/1.0 428 Precondition Required');
                                        exit;
                                    }
                                } else {
                                    ob_start();
                                    header('HTTP/1.0 502 Bad Gateway');
                                    exit;

                                    // $obj->status_code = 400;
                                    // $obj->message = "Payment mismatch error !";
                                    // $obj->data = new stdClass;
                                    // $obj->paid_amount = $paid_amount;
                                    // $obj->total_price = $total_price;
                                }
                            // } else if($payment_order->status == "created") {
                            //     $obj->status_code = 400;
                            //     $obj->message = "Payment created but incomplete ! Please initiate payment again !";
                            //     $obj->data = new stdClass;
                            // } else if ($payment_order->status == "attempted") {
                            //     $obj->status_code = 400;
                            //     $obj->message = "Payment incomplete ! Please initiate payment again !";
                            //     $obj->data = new stdClass;
                            // } else {
                            //     $obj->status_code = 400;
                            //     $obj->message = "Payment capture error ! Please try again after sometimes !";
                            //     $obj->data = new stdClass;
                            // }
                        // } else if (property_exists($payment_order, 'error')) {
                        //     $obj->status_code = 400;
                        //     $obj->message = $payment_order->error->description;
                        //     $obj->data = new stdClass;
                        // } else {
                        //     $obj->status_code = 400;
                        //     $obj->message = "Payment capture failed ! Contact support !";
                        //     $obj->data = new stdClass;
                        // }
                    // } else {
                    //     $obj->status_code = 400;
                    //     $obj->title = "Oops";
                    //     $obj->message = "Duplicate order !";
                    //     $obj->data = new stdClass;
                    // }
                // } else {
                //     $obj->status_code = 400;
                //     $obj->message = "User detail error !";
                //     $obj->data = new stdClass;
                // }
            } else {
                // echo validateInputs($input_data);
                initBadRequest();
            }
        } else {
            dropAccess();
        }
    } else {
        dropAccess();
    }
} else {
    dropAccess();
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

function validateInputs($input_data) {
    $is_valid = true;
    if ( !property_exists($input_data, "journey_token") || trim($input_data->journey_token) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "currency") || trim($input_data->currency) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "paid_amount") || trim($input_data->paid_amount) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "e_ticket") || trim($input_data->e_ticket) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "passenger_list") || !is_array($input_data->passenger_list) ) $is_valid = false;
    if ( !property_exists($input_data, "station_array") || !is_array($input_data->station_array) ) $is_valid = false;
    
    foreach ($input_data->passenger_list as $passenger_data) {
        if ( !property_exists($passenger_data, "passenger_type") || trim($passenger_data->passenger_type) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "title") || trim($passenger_data->title) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "name") || trim($passenger_data->name) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "country_code") || trim($passenger_data->country_code) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "mobile_number") || trim($passenger_data->mobile_number) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "email_id") || trim($passenger_data->email_id) == "" ) $is_valid = false;
        if ( !property_exists($passenger_data, "date_of_birth") || trim($passenger_data->date_of_birth) == "" ) $is_valid = false;
    }
    unset($passenger_data);
    
    foreach ($input_data->station_array as $station_data) {
        if ( !property_exists($station_data, "airport_code") || trim($station_data->airport_code) == "" ) $is_valid = false;
        if ( !property_exists($station_data, "category_name") || trim($station_data->category_name) == "" ) $is_valid = false;
        if ( !property_exists($station_data, "terminal_name") || trim($station_data->terminal_name) == "" ) $is_valid = false;
        if ( !property_exists($station_data, "type_name") || trim($station_data->type_name) == "" ) $is_valid = false;
        if ( !property_exists($station_data, "service_array") || !is_array($station_data->service_array) ) $is_valid = false;

        if (is_array($station_data->service_array)) {
            foreach ($station_data->service_array as $service_data) {
                if ( !property_exists($service_data, "service_token") || trim($service_data->service_token) == "" ) $is_valid = false;
                if ( !property_exists($service_data, "adult_count") || trim($service_data->adult_count) == "" ) $is_valid = false;
                if ( !property_exists($service_data, "children_count") || trim($service_data->children_count) == "" ) $is_valid = false;
                if ( !property_exists($service_data, "service_date_time") || trim($service_data->service_date_time) == "" ) $is_valid = false;
                if ( !property_exists($service_data, "notes") || trim($service_data->notes) == "" ) $is_valid = false;
            }
            unset($service_data);
        }
    }
    unset($station_data);
    
    return $is_valid;
}

function parseJourney($airport, $airport_ttr, $journey_array, $journey_count) {
    // $station_array = [];
    $airport_error = false;
    foreach ($journey_array as $journey_key => $journey_value) {
        $depart_station_obj = new stdClass;
        $airport->airport_code = $journey_value['departure_airport'];
        $airport->readOneByCode();
        if ($airport->stmt->rowCount() > 0) {
            $depart_station_obj->airport_code = $journey_value['departure_airport'];
            $depart_station_obj->terminal_name = $journey_value['departure_terminal'];
            $depart_station_obj->type_name = "";
            $depart_station_obj->category_name = ($journey_key == 0)? "Departure": "Transit";
            $depart_station_obj->country_code = $airport->makeView()[0]->country_code;
        } else {
            $airport_error = true;
        }

        $arrival_station_obj = new stdClass;
        $airport->airport_code = $journey_value['arrival_airport'];
        $airport->readOneByCode();
        if ($airport->stmt->rowCount() > 0) {
            $arrival_station_obj->airport_code = $journey_value['arrival_airport'];
            $arrival_station_obj->terminal_name = $journey_value['arrival_terminal'];
            $arrival_station_obj->type_name = "";
            $arrival_station_obj->category_name = ($journey_key == $journey_count-1)? "Arrival": "Transit";
            $arrival_station_obj->country_code = $airport->makeView()[0]->country_code;
        } else {
            $airport_error = true;
        }

        $journey_obj = new stdClass;
        $journey_obj->depart_station = $depart_station_obj;
        $journey_obj->arrival_station = $arrival_station_obj;
        $journey_obj->departure_date = $journey_value['departure_datetime'];
        $journey_obj->flight_number = $journey_value['flight_number'];

        $journey_array[$journey_key] = $journey_obj;
    }
    unset($journey_value);

    foreach ($journey_array as $journey_key => $journey_value) {
        $depart_type = "";
        if ($journey_key == 0) {
            $depart_type = ($journey_value->depart_station->country_code == $journey_value->arrival_station->country_code)? "Domestic": "International";
        } else {
            $type_array = [];
            array_push($type_array, (($journey_array[$journey_key-1]->depart_station->country_code == $journey_array[$journey_key-1]->arrival_station->country_code)? "Domestic": "International"));
            array_push($type_array, (($journey_value->depart_station->country_code == $journey_value->arrival_station->country_code)? "Domestic": "International"));
            $depart_type = implode("-", $type_array);
        }
        $journey_value->depart_station->type_name = $depart_type;

        $arrival_type = "";
        if ($journey_key == $journey_count-1) {
            $arrival_type = ($journey_value->depart_station->country_code == $journey_value->arrival_station->country_code)? "Domestic": "International";
        } else {
            $type_array = [];
            array_push($type_array, (($journey_value->arrival_station->country_code == $journey_value->arrival_station->country_code)? "Domestic": "International"));
            array_push($type_array, (($journey_array[$journey_key+1]->arrival_station->country_code == $journey_array[$journey_key+1]->arrival_station->country_code)? "Domestic": "International"));
            $arrival_type = implode("-", $type_array);
        }
        $journey_value->arrival_station->type_name = $arrival_type;
    }
    unset($journey_value);

    foreach ($journey_array as $journey_key => $journey_value) {
        $depart_station = $journey_value->depart_station;
        $airport_ttr->airport_code = $depart_station->airport_code;
        $airport_ttr->category_name = $depart_station->category_name;
        $airport_ttr->terminal_name = $depart_station->terminal_name;
        $airport_ttr->type_name = $depart_station->type_name;
        $airport_ttr->getTerminalTTRDetail();
        if ($airport_ttr->stmt->rowCount() > 0) {
            $journey_value->depart_station->ttr_token = $airport_ttr->makeViewTTRDetail()[0]->ttr_token;
        } else {
            $journey_value->depart_station->ttr_token = "";
        }
        
        $arrival_station = $journey_value->arrival_station;
        $airport_ttr->airport_code = $arrival_station->airport_code;
        $airport_ttr->category_name = $arrival_station->category_name;
        $airport_ttr->terminal_name = $arrival_station->terminal_name;
        $airport_ttr->type_name = $arrival_station->type_name;
        $airport_ttr->getTerminalTTRDetail();
        if ($airport_ttr->stmt->rowCount() > 0) {
            $journey_value->arrival_station->ttr_token = $airport_ttr->makeViewTTRDetail()[0]->ttr_token;
        } else {
            $journey_value->arrival_station->ttr_token = "";
        }
    }
    unset($journey_value);
    
    return $journey_array;
}

// For parsing stations' code from journeys
function parseStationCodesFromJourney($journey_array) {
    $station_code_array = [];
    foreach ($journey_array as $journey_key => $journey_value) {
        if ($journey_key == 0) array_push($station_code_array, $journey_value->depart_station->airport_code);
        array_push($station_code_array, $journey_value->arrival_station->airport_code);
    }
    unset($journey_value);

    return $station_code_array;
}

function makeBookingPassengerEntry($user_token, $booking_token, $input_passenger, $users_booking_passenger, $users_passenger, $passenger_type) {
    $users_passenger->token = property_exists($input_passenger, "token")? $input_passenger->token: '';
    $users_passenger->user_token = $user_token;
    $users_passenger->title = $input_passenger->title;
    $users_passenger->name = $input_passenger->name;
    $users_passenger->country_code = $input_passenger->country_code;
    $users_passenger->mobile_number = $input_passenger->mobile_number;
    $users_passenger->email_id = $input_passenger->email_id;
    $users_passenger->date_of_birth = date('Y-m-d', strtotime($input_passenger->date_of_birth));
    if ($users_passenger->token == '') {
        $passenger_token = genToken('users__passenger');
        $users_passenger->token = $passenger_token;
        $users_passenger->create();
    } else {
        $passenger_token = $users_passenger->token;
    }
    $users_booking_passenger->token = genToken('users__booking_passenger');
    $users_booking_passenger->booking_token = $booking_token;
    $users_booking_passenger->user_passenger_token = $passenger_token;
    $users_booking_passenger->passenger_type = $passenger_type;
    $users_booking_passenger->create();
}

function savePdf($invoice_content, $fileName) { //, $source_path, $add_page
    require_once('../../TCPDF-main/examples/tcpdf_include.php');
    // create new PDF document

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setCreator(PDF_CREATOR);

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set auto page breaks
    $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php')) {
        require_once(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $fontname = TCPDF_FONTS::addTTFfont('../../TCPDF-main/fonts/Rubik-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->setFontSubsetting(true);
    $pdf->SetMargins(1, 0, 1);
    $pdf->setFont($fontname, '', 14, '', false);
    $pdf->AddPage('P', 'A4');
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    
    // Custom code //
    $pdf->setCellHeightRatio(1.2);
    
    //Set some content to print
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $invoice_content, 0, 1, 0, true, '', true);

    $target_path = '/home/airportzostage/public_html/invoice_pdf/' . $fileName;
    // ob_end_clean();
    $pdf->Output($target_path, 'F');//View [I],Download[F]
    return $fileName;
}

function split_price_wo_convenience($total_service_cost) {
    $service_cost_excl_gst = ceil($total_service_cost / 1.18);
    $service_cost_gst = $total_service_cost - $service_cost_excl_gst;
    $convenience_cost = 0;//ceil($total_service_cost * 0.03);
    $convenience_cost_gst = 0;//ceil($convenience_cost * 0.18);

    $price_obj = new stdClass;
    // $price_obj->input = intval($total_service_cost);
    $price_obj->service_cost_excl_gst = intval($service_cost_excl_gst);
    $price_obj->service_cost_gst = intval($service_cost_gst);
    $price_obj->convenience_cost = intval($convenience_cost);
    $price_obj->convenience_cost_gst = intval($convenience_cost_gst);
    $price_obj->total_cost = intval($service_cost_excl_gst) + intval($service_cost_gst);// + intval($convenience_cost) + intval($convenience_cost_gst);
    return $price_obj;
}
?>