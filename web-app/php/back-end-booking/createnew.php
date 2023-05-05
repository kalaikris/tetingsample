<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$cookie_name =  "airportzo-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];
    
    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $input_data = getInputs();

        // include 'fetch-order-detail.php';

        include '../objects/users-booking.php';
        $users_booking = new UsersBooking();
        $users_booking->razorpay_plink_id = xss_clean($input_data->razorpay_plink_id);
        $users_booking->checkDuplicatePlink_id();

        if ($users_booking->stmt->rowCount() == 0) {
            $users_data = $users->makeView()[0];
            $is_agent = ($users_data->is_agent && $users_data->is_approved)? 1: 0;

            // include '../../../config/razor-pay.php';
            // $razor_pay = new RazorPay();
            // $razor_pay->order_id = xss_clean($input_data->razorpay_order_id);

            // $payment_order = $razor_pay->getOrder();
            // if (property_exists($payment_order, 'status')) {
            //     if ($payment_order->status == "paid") {
                    $currency = property_exists($input_data, 'currency')? $input_data->currency: 'INR';
                    // $paid_amount = $payment_order->amount / 100;

                    include '../objects/airport-ttr.php';
                    $airport_ttr = new AirportTTR();

                    include '../objects/service-location.php';
                    $service_location = new ServiceLocation();

                    $service_location->currency_code = 'INR';
                    $total_service_cost = 0;
                    $total_service_count = 0;
                    $total_adult_count = 0;
                    $total_children_count = 0;
                    $service_coupon_arr = [];
                    $new_array = [];
                    $station_array = $input_data->station_array;
                    $checkService_status = true;
                    $service_located = 0;
                    foreach ($station_array as $key => $station_value) {
                        $airport_ttr->token = $station_value->ttr_token;
                        $airport_ttr->readOneTerminal();
                        $airport_ttr_detail = $airport_ttr->makeView()[0];
                        $station_value->ttr_detail = $airport_ttr_detail;
                        // $station_value->ttr_detail->flight_number = $station_value->flight_number;
                        // $station_value->ttr_detail->journey = $station_value->journey;

                        //Outside Service Check
                        if($station_value->ttr_detail->location_check == '0' && $checkService_status == true){
                            if($currency!="INR"){
                                $service_located = '1';
                            } else {
                                $service_located = '0';
                            }
                        } else {
                            $checkService_status = false;
                            $service_located = '0';
                        }

                        $service_location->airport_ttr_token = $station_value->ttr_token;
                        foreach ($station_value->service_array as $service_value) {
                            $service_location->service_token = $service_value->service_token;
                            $service_location->searchServicesForTTRTokenAndServiceToken();

                            if ($service_location->stmt->rowCount() > 0) {
                                $total_service_count++;
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
                                $total_service_cost += $net_service_cost;
                                // $net_service_cost = intval(($service_value->adult_count * $service_location_value->price_adult) + ($service_value->children_count * $service_location_value->price_children));
                                // $total_service_cost += $net_service_cost;

                                $service_location_value->net_amount = $net_service_cost;

                                $service_value->ttr_detail = $service_location_value;

                                $service_coupon_detail = new stdClass();
                                $service_coupon_detail->business_token = $service_location_value->unique_business_token;
                                $service_coupon_detail->service_type = $service_location_value->service_type;
                                $service_coupon_detail->service_token = $service_location_value->service_token;
                                $service_coupon_detail->total_amount = $net_service_cost;
                                array_push($service_coupon_arr, $service_coupon_detail);
                                array_push($new_array, $service_location_value->unique_business_token);
                            }
                        }
                        unset($service_value);
                    }
                    unset($station_value);

                    include '../objects/coupon.php';
                    $coupon_data = new UserCoupon();
                    $coupon_discount_amt = 0;
                    $coupon_token = 0;
                    $cart_coupon_type = '';
                    $category_coupon_type = '';
                    $discount_amount = 0;
                    $discount_type = 0;
                    $coupon_type = 0;
                    $coupon_data->couponCode = $input_data->coupon_code;
                    if ($input_data->coupon_type == "Category") {
                        $coupon_array = [];
                        $newarray = "'" . join("','", $new_array) . "'";
                        $category_arr = $coupon_data->readCategoryCoupon($newarray);
                        for ($i = 0; count($service_coupon_arr) > $i; $i++) {
                            for($j = 0; count($category_arr) > $j; $j++){
                                if ($service_coupon_arr[$i]->business_token != '') {
                                    if ($service_coupon_arr[$i]->business_token == $category_arr[$j]->business_type_token) {
                                        $category_coupon_type = $category_arr[$j]->gst_type;
                                        if($category_arr[$j]->gst_type == "Incl Gst"){
                                            if ($category_arr[$j]->coupon_type == 'Percentage') {
                                                $discount_amt = (float) ($service_coupon_arr[$i]->total_amount) * $category_arr[$j]->discount_amount / 100;
                                                $coupon_discount_amt += (float) ($service_coupon_arr[$i]->total_amount) * $category_arr[$j]->discount_amount / 100;
                                            } else if ($category_arr[$j]->coupon_type == 'Flat') {
                                                $discount_amt = (int) $category_arr[$j]->discount_amount;
                                                $coupon_discount_amt += (int) $category_arr[$j]->discount_amount;
                                            }
                                        } else {
                                            if ($category_arr[$j]->coupon_type == 'Percentage') {
                                                $discount_amt = (float) ($service_coupon_arr[$i]->total_amount / 1.18) * $category_arr[$j]->discount_amount / 100;
                                                $coupon_discount_amt += (float) ($service_coupon_arr[$i]->total_amount / 1.18) * $category_arr[$j]->discount_amount / 100;
                                            } else if ($category_arr[$j]->coupon_type == 'Flat') {
                                                $discount_amt = (int) $category_arr[$j]->discount_amount;
                                                $coupon_discount_amt += (int) $category_arr[$j]->discount_amount;
                                            }
                                        }
                                        $coupon_detail = new stdClass();
                                        $coupon_detail->service_token = $service_coupon_arr[$i]->service_token;
                                        $coupon_detail->catdiscount_amt = $discount_amt;
                                        $coupon_detail->coupon_percentage = $category_arr[$j]->discount_amount;
                                        $coupon_detail->business_token = $category_arr[$j]->business_type_token;
                                        $coupon_detail->gst_type = $category_arr[$j]->gst_type;
                                        $coupon_detail->is_coupon_service = (int) '1';
                                        array_push($coupon_array, $coupon_detail);
                                    } else {
                                        $coupon_discount_amt += (int) 0;
                                    }
                                }
                            }
                        }
                        $discount_type = '2';
                        $coupon_type = '2';
                    } else if ($input_data->coupon_type == "Cart") {
                        $cart_arr = $coupon_data->readCartCoupon();
                        foreach ($cart_arr as $cart_value) {
                            $coupon_token = $cart_value->coupon_token;
                            $cart_coupon_type = $cart_value->gst_type;
                            if ($cart_value->gst_type == "Incl Gst") {
                                if ($cart_value->coupon_condition == "Greater Than Or Equal To") {
                                    $sc_cost = $total_service_cost;
                                    if ($sc_cost >= $cart_value->cart_dis_amt) {
                                        if ($cart_value->coupon_type == "Percentage") {
                                            $coupon_discount_amt += round($sc_cost * $cart_value->discount_amount / 100);
                                        } else if ($cart_value->coupon_type == 'Flat') {
                                            $coupon_discount_amt += (int) $cart_value->discount_amount;
                                        }
                                    } else {
                                        $coupon_discount_amt += 0;
                                    }
                                } else {
                                    $sc_cost = $total_service_cost;
                                    if ($sc_cost <= $cart_value->cart_dis_amt) {
                                        if ($cart_value->coupon_type == "Percentage") {
                                            $coupon_discount_amt += round($sc_cost * $cart_value->discount_amount / 100);
                                        } else if ($cart_value->coupon_type == 'Flat') {
                                            $coupon_discount_amt += (int) $cart_value->discount_amount;
                                        }
                                    } else {
                                        $coupon_discount_amt += 0;
                                    }
                                }
                            } else {
                                if ($cart_value->coupon_condition == "Greater Than Or Equal To") {
                                    $sc_cost = ($total_service_cost / 1.18);
                                    if ($sc_cost >= $cart_value->cart_dis_amt) {
                                        if ($cart_value->coupon_type == "Percentage") {
                                            $coupon_discount_amt += round($sc_cost * $cart_value->discount_amount / 100);
                                        } else if ($cart_value->coupon_type == 'Flat') {
                                            $coupon_discount_amt += (int) $cart_value->discount_amount;
                                        }
                                    } else {
                                        $coupon_discount_amt += 0;
                                    }
                                } else {
                                    $sc_cost = ($total_service_cost / 1.18);
                                    if ($sc_cost <= $cart_value->cart_dis_amt) {
                                        if ($cart_value->coupon_type == "Percentage") {
                                            $coupon_discount_amt += round($sc_cost * $cart_value->discount_amount / 100);
                                        } else if ($cart_value->coupon_type == 'Flat') {
                                            $coupon_discount_amt += (int) $cart_value->discount_amount;
                                        }
                                    } else {
                                        $coupon_discount_amt += 0;
                                    }
                                }
                            }
                        }
                        $discount_type = '2';
                        $coupon_type = '1';
                        $discount_amount = $coupon_discount_amt;
                    }
                    $currency_value = 0;
                    $rearrange_amount = ($total_service_cost / 1.18);
                    if (($input_data->coupon_type == "Cart" && $cart_coupon_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $category_coupon_type == "Incl Gst")) {
                        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
                        $service_cost_excl_gst = round($rearrange_amount / 1.18);
                        $service_cost_gst = round(($rearrange_amount / 1.18) * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        $convenience_cost_gst = round($convenience_cost * 0.18);
                    } else {
                        $total_service_costs = $rearrange_amount - $coupon_discount_amt;
                        $service_cost_excl_gst = round($total_service_costs);
                        $service_cost_gst = round($total_service_costs * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        $convenience_cost_gst = round($convenience_cost * 0.18);
                    }

                    $price_obj = new stdClass;
                    // $price_obj->input = intval($total_service_cost);
                    $price_obj->service_cost_excl_gst = intval($service_cost_excl_gst);
                    $price_obj->service_cost_gst = intval($service_cost_gst);
                    $price_obj->convenience_cost = intval($convenience_cost);
                    $price_obj->convenience_cost_gst = intval($convenience_cost_gst);
                    $price_obj->total_cost = intval($service_cost_excl_gst) + intval($service_cost_gst) + intval($convenience_cost) + intval($convenience_cost_gst);
                    $price_data = $price_obj;
                    $total_price = $price_data->total_cost;

                    $service_cost_excl_gst = $price_data->service_cost_excl_gst;
                    $service_cost_gst = $price_data->service_cost_gst;
                    $convenience_cost = $price_data->convenience_cost;
                    $convenience_cost_gst = $price_data->convenience_cost_gst;

                    //Store in INR amount will be in foreign exchange
                    $totalprice = $price_data->total_cost;
                    $servicecostexclgst = $price_data->service_cost_excl_gst;
                    $servicecostgst = $price_data->service_cost_gst;
                    $conveniencecost = $price_data->convenience_cost;
                    $conveniencecostgst = $price_data->convenience_cost_gst;
                    if ($currency != "INR") {
                        include '../../../config/currency.php';
                        $currency_value = currency("INR", $currency);
                        if ($currency_value > 0) {
                            $total_price = $total_price * (float) $currency_value;
                            $total_price = number_format((float) $total_price, 2, '.', '');

                            $service_cost_excl_gst = $service_cost_excl_gst * (float) $currency_value;
                            $service_cost_excl_gst = number_format((float) $service_cost_excl_gst, 2, '.', '');
                            $service_cost_gst = $service_cost_gst * (float) $currency_value;
                            $service_cost_gst = number_format((float) $service_cost_gst, 2, '.', '');
                            $convenience_cost = $convenience_cost * (float) $currency_value;
                            $convenience_cost = number_format((float) $convenience_cost, 2, '.', '');
                            $convenience_cost_gst = $convenience_cost_gst * (float) $currency_value;
                            $convenience_cost_gst = number_format((float) $convenience_cost_gst, 2, '.', '');
                        }
                    }
                    // $payment_view = $payment_order->amount / 100;

                    // if ($paid_amount == $payment_view) {
                        $contact_passenger = $input_data->contact_passenger;
                        $other_passenger_array = $input_data->other_passenger;
                        
                        // $total_adult_count = 1;
                        // foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                        //     $age = getTimeDifference( $other_passenger_value->date_of_birth );
                        //     if (strpos($age, 'yrs') !== false) {//str_contains($age, 'yrs')) {
                        //         $age = intval( rtrim($age, " yrs") );
                        //         if ($age >= 12) {
                        //             $total_adult_count++;
                        //         } else {
                        //             $total_children_count++;
                        //         }
                        //     }
                        // }
                        // unset($other_passenger_value);
                        
                        $journey_array = $input_data->journey_array;

                        $station_code_array = parseStationCodesFromJourney($airport_ttr, $journey_array);
                        $journey = implode(" - ", $station_code_array);

                        $booking_token = genToken('users__booking');
                        $booking_number = rand(111111111111, 999999999999);

                        $users_booking->date_time = $gm_date_time; 
                        $users_booking->token = $booking_token;
                        $users_booking->booking_number = $booking_number;
                        $users_booking->user_token = $user_token;
                        $users_booking->is_agent = $is_agent;
                        $users_booking->agent_token = $is_agent? $users_data->token: '';
                        $users_booking->journey = $journey;
                        $users_booking->for_others = ($users_data->mobile_number == $contact_passenger->mobile_number || !$is_agent)? "0": "1";//property_exists($input_data, "for_others")? ($input_data->for_others? "1": "0"): "0";
                        $users_booking->service_amount = $servicecostexclgst;
                        $users_booking->service_gst = $servicecostgst;
                        $users_booking->convenience_fee = $conveniencecost;
                        $users_booking->cf_tax = $convenience_cost_gst;
                        $users_booking->total_amount = $price_data->total_cost;
                        $users_booking->currency = $currency;
                        $users_booking->currency_value = ($currency_value == "0") ? "1" : $currency_value;
                        $users_booking->service_located = $service_located;
                        $users_booking->payment_view = $total_price;
                        $users_booking->discount_type = $discount_type;
                        $users_booking->coupon_type = $coupon_type;
                        $users_booking->cart_coupon_type = $cart_coupon_type;
                        $users_booking->discount_amount = $discount_amount;
                        $users_booking->coupon_token = $coupon_token;
                        $users_booking->total_service = $total_service_count;
                        $users_booking->total_adult = $total_adult_count;
                        $users_booking->total_children = $total_children_count;
                        $users_booking->booking_type = 'Web';
                        $users_booking->status = 'Pending';
                        $users_booking->e_ticket = property_exists($input_data, 'e_ticket')? $input_data->e_ticket: "";
                        $users_booking->pancard_number = xss_clean($input_data->panNumber);
                        $users_booking->gst_name = xss_clean($input_data->gst_name);
                        $users_booking->gst_number = xss_clean($input_data->gst_number);
                        $users_booking->description_one = xss_clean($input_data->greet);
                        $users_booking->description_two = '';//$input_data->bouqueteer;
                        $users_booking->plink_id = $input_data->razorpay_plink_id;
                        $users_booking->payment_id = $input_data->razorpay_payment_id;
                        $users_booking->order_id = $input_data->razorpay_order_id;
                        $users_booking->signature = $input_data->razorpay_signature;
                        $users_booking->invoice_token = '';
                        $users_booking->invoice_pdf = '';//$base_url . 'invoice_pdf/' . $booking_token . '.pdf';
                        $users_booking->plink_name = $input_data->paymentlink_name;
                        $users_booking->plink_mobile = $input_data->paymentlink_mobile;
                        $users_booking->plink_email = $input_data->paymentlink_email;
                        $users_booking->plink_desc = $input_data->paymentlink_description;
                        if($coupon_token!=0){
                            $users_booking->updatecouponbalance($coupon_token);
                        }
                        if( $users_booking->create() ) {
                            include '../objects/users-booking-detail.php';
                            $users_booking_detail = new UsersBookingDetail();
                            $users_booking_detail->booking_token = $booking_token;
                            $users_booking_detail->date_time = $gm_date_time;
                            $users_booking_detail->status = 'Draft';
                            $servic_key = 0;
                            foreach ($station_array as $station_key => $station_value) {
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
                                    $users_booking_detail->service_date_time = date('Y-m-d', strtotime($service_value->service_date)) . ' ' . date('H:i:s', strtotime($service_value->service_time));
                                    $users_booking_detail->service_token = $service_value->ttr_detail->service_token;
                                    $users_booking_detail->service_name = $service_value->ttr_detail->service_name;
                                    $users_booking_detail->service_type = $service_value->ttr_detail->service_type;
                                    $users_booking_detail->service_location_token = $service_value->ttr_detail->token;
                                    $users_booking_detail->company_token = $service_value->ttr_detail->sp_company_token;

                                    $price_adult = $service_value->ttr_detail->price_adult;
                                    $price_children = $service_value->ttr_detail->price_children;
                                    $additional_price_adult = $service_value->ttr_detail->additional_price_adult;
                                    $additional_price_children = $service_value->ttr_detail->additional_price_children;
                                    $net_amount = $service_value->ttr_detail->net_amount;
                                    if($currency_value > 0) {
                                        $price_adult = $price_adult * (float)$currency_value;
                                        $price_adult = number_format((float)$price_adult, 2, '.', '');
            
                                        $price_children = $price_children * (float)$currency_value;
                                        $price_children = number_format((float)$price_children, 2, '.', '');

                                        $additional_price_adult = $additional_price_adult * (float) $currency_value;
                                        $additional_price_adult = number_format((float) $additional_price_adult, 2, '.', '');

                                        $additional_price_children = $additional_price_children * (float) $currency_value;
                                        $additional_price_children = number_format((float) $additional_price_children, 2, '.', '');

                                        $net_amount = $net_amount * (float)$currency_value;
                                        $net_amount = number_format((float)$net_amount, 2, '.', '');
                                    }

                                    $users_booking_detail->adult_service_amount = $service_value->ttr_detail->price_adult;
                                    $users_booking_detail->additional_price_adult = $service_value->ttr_detail->additional_price_adult;
                                    $users_booking_detail->total_adult = $service_value->adult_count;
                                    $users_booking_detail->children_service_amount = $service_value->ttr_detail->price_children;
                                    $users_booking_detail->additional_price_children = $service_value->ttr_detail->additional_price_children;
                                    $users_booking_detail->total_children = $service_value->children_count;
                                    $users_booking_detail->net_amount = $service_value->ttr_detail->net_amount;
                                    $users_booking_detail->markup_type = 'No Markup';
                                    //commission_charge
                                    //$service_location->sp_company_token = $service_value->ttr_detail->sp_company_token;
                                    //$commission_data = $service_location->getCommissionForServiceProvider();
                                    // if ($commission_data->is_credit == '1') {
                                    //     $provider_commission_amount = $service_value->ttr_detail->net_amount * $commission_data->commission_percentage/100;
                                    //     $total_cost = $service_value->ttr_detail->net_amount-$provider_commission_amount;
                                    //     $service_location->balance_provider_credits = $commission_data->provider_credits-$total_cost;
                                    //     $service_location->service_provider = $commission_data->service_provider;
                                    //     $service_location->updateCreditAvailableAmount();
                                    //     $users_booking_detail->provider_commission_percentage = $commission_data->commission_percentage;
                                    //     $users_booking_detail->provider_commission_amount = $provider_commission_amount;
                                    //     $users_booking_detail->previous_provider_credits = $commission_data->provider_credits;
                                    //     $users_booking_detail->balance_provider_credits = $service_location->balance_provider_credits;
                                    // } else {
                                        $users_booking_detail->provider_commission_percentage = '0';
                                        $users_booking_detail->provider_commission_amount = '0';
                                        $users_booking_detail->previous_provider_credits = '0';
                                        $users_booking_detail->balance_provider_credits = '0';
                                   // }
                                    //commission_charge
                                    $users_booking_detail->notes = property_exists($service_value, 'notes')? $service_value->notes: '';
                                    //category_coupon_discount
                                    if ($input_data->coupon_type == "Category") {
                                        $cat_service_arr = array_column($coupon_array, 'service_token');
                                        if (in_array($service_value->ttr_detail->service_token, $cat_service_arr)) {
                                            $users_booking_detail->is_coupon_service = '1'; //$coupon_array[$servic_key]->is_coupon_service;
                                            $users_booking_detail->business_type_token = $coupon_array[$servic_key]->business_token;
                                            $users_booking_detail->coupon_percentage = $coupon_array[$servic_key]->coupon_percentage;
                                            $users_booking_detail->category_coupon_type = $coupon_array[$servic_key]->gst_type;
                                            $users_booking_detail->discount_amount = $coupon_array[$servic_key]->catdiscount_amt;
                                            $servic_key++;
                                        } else {
                                            $users_booking_detail->is_coupon_service = '0';
                                            $users_booking_detail->business_type_token = '0';
                                            $users_booking_detail->coupon_percentage = '0';
                                            $users_booking_detail->category_coupon_type = '0';
                                            $users_booking_detail->discount_amount = '0';
                                        }
                                    } else if($input_data->coupon_type == "Cart") {
                                        $users_booking_detail->is_coupon_service = '0';
                                        $users_booking_detail->business_type_token = '0';
                                        $users_booking_detail->coupon_percentage = '0';
                                        $users_booking_detail->category_coupon_type = '0';
                                        $users_booking_detail->discount_amount = round(($service_value->ttr_detail->net_amount * $users_booking->discount_amount ) / $total_service_cost);
                                    } else {
                                        $users_booking_detail->is_coupon_service = '0';
                                        $users_booking_detail->business_type_token = '0';
                                        $users_booking_detail->coupon_percentage = '0';
                                        $users_booking_detail->category_coupon_type = '0';
                                        $users_booking_detail->discount_amount = '0';
                                    }

                                    $agent_conv_fee_commi = 0;
                                    $gst_agent_conv_fee_commi = 0;
                                    $user_conv_fee_commi = 0;
                                    $gst_user_conv_fee_commi = 0;

                                    // if($users_data->is_agent && $users_data->is_approved == "Approved"){    //calculate agent booking conv fee for each serivce booking and calculate commision amount 
                                    //     $agent_conv_fee_commi = round(($convenience_cost * $service_value->ttr_detail->net_amount) / $total_service_cost);
                                    //     $gst_agent_conv_fee_commi = round($agent_conv_fee_commi * 0.18);

                                    // }else{                                 //calculate user booking conv fee for each serivce booking

                                        $user_conv_fee_commi = round($convenience_cost * ($service_value->ttr_detail->net_amount - $users_booking_detail->discount_amount) / ($users_booking->service_amount + $users_booking->service_gst));
                                        $gst_user_conv_fee_commi = round($user_conv_fee_commi * 0.18);
                                    // }

                                    $users_booking_detail->agent_conv_fee_commi = $agent_conv_fee_commi;
                                    $users_booking_detail->gst_agent_conv_fee_commi = $gst_agent_conv_fee_commi;
                                    $users_booking_detail->user_conv_fee_commi = $user_conv_fee_commi;
                                    $users_booking_detail->gst_user_conv_fee_commi = $gst_user_conv_fee_commi;

                                    //category_coupon_discount
                                    $users_booking_detail->create();
                                }
                                unset($service_value);
                            }
                            unset($station_value);

                            $journey_array = $input_data->journey_array;
                            if (sizeof($journey_array) > 0) {
                                include '../objects/users-booking-journey.php';
                                $users_booking_journey = new UsersBookingJourney();
                                foreach ($journey_array as $journey_value) {
                                    $users_booking_journey->token = genToken('users__booking_journey');
                                    $users_booking_journey->booking_token = $booking_token;
                                    $users_booking_journey->depart_ttr_token = $journey_value->departure_ttr_token;
                                    $users_booking_journey->arrival_ttr_token = $journey_value->arrival_ttr_token;
                                    $users_booking_journey->depart_date = date('Y-m-d', strtotime($journey_value->departure_date));
                                    $users_booking_journey->flight_number = property_exists($journey_value, 'flight_number')? $journey_value->flight_number: "";
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
                            $greet_passenger_array = $input_data->greet_passenger;
                            if (sizeof($greet_passenger_array) > 0) {
                                foreach ($greet_passenger_array as $greet_passenger_value) {
                                    makeBookingPassengerEntry($user_token, $booking_token, $greet_passenger_value, $users_booking_passenger, $users_passenger, 'Greeter');
                                }
                                unset($greet_passenger_value);
                            }

                            $users_booking_detail->readForBooking();
                            if ($users_booking_detail->stmt->rowCount() > 0) {
                                $users_booking_detail_array = $users_booking_detail->makeView();
                            }

                            // include '../objects/airport.php';
                            // $airport = new Airport();

                            // $fetch_json_order_detail = fetchOrderDetail();
                            // // $fetch_json_order_detail = fetchOrderDetail($booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
                            // $fetch_order_detail = json_decode($fetch_json_order_detail);
                            // if ($fetch_order_detail->status_code == 200) {
                            //     $booking_detail = $fetch_order_detail->data;
                            //     $e_ticket = $booking_detail->e_ticket;

                            //     // include '../objects/mail-order.php';
                            //     // $mail_order = new MailTemplateOrder();

                            //     include '../../../config/mailer-template.php';
                            //     $mail_order = new MailTemplateOrder;

                            //     include '../../../config/mailer.php';
                            //     $mailerObj = new stdClass;

                            //     $done_email = [];
                            //     $mailer_err = "";
                            //     if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {
                            //         $booking_detail->need_footer = true;

                            //         $mail_order->mail_obj = $booking_detail;
                                    
                            //         $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
                            //         $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                            //         $mailerObj->subject = 'Airportzo - Service booked #' . $booking_detail->booking_number;
                            //         $mailerObj->e_ticket = '';
                            //         $mailerObj->mail_template = $mail_order->genMailContentForAdminAndUser();
                            //         $mailerResponse = sendMail($mailerObj);
                            //         if ($mailerResponse) {
                            //             array_push($done_email, "user");
                            //         } else {
                            //             $mailer_err = $mailerResponse;
                            //         }

                            //         $mail_order->mail_obj->need_footer = false;
                            //         $mailerObj->email_id = $admin_email;
                            //         $mailerObj->user_name = $admin_user_name;
                            //         $mailerObj->e_ticket = $e_ticket;
                            //         $mailerObj->mail_template = $mail_order->genMailContentForAdminAndUser();
                            //         $adminMailerResponse = sendMail($mailerObj);
                            //         if ($adminMailerResponse) {
                            //             array_push($done_email, "admin");
                            //         } else {
                            //             $mailer_err = $adminMailerResponse;
                            //         }
                            //     }

                            //     $sp_service_array = [];
                            //     foreach ($booking_detail->order_detail as $station_key => $station_value) {
                            //         foreach ($station_value->order_detail_array as $service_key => $service_value) {
                            //             if ($service_value->company_email != '') {
                            //                 $index = -1;
                            //                 foreach ($sp_service_array as $sp_service_key => $sp_service_value) {
                            //                     if ($sp_service_value->company_token == $service_value->company_token) {
                            //                         $index = $sp_service_key;
                            //                     }
                            //                 }
                            //                 unset($sp_service_value);
                                            
                            //                 if ($index > -1) {
                            //                     $sp_service_obj = $sp_service_array[$index];

                            //                     $station_index = -1;
                            //                     foreach ($sp_service_obj->order_detail as $sp_station_key => $sp_station_value) {
                            //                         if ($sp_station_value->station_number == $station_value->station_number) {
                            //                             $station_index = $sp_station_key;
                            //                         }
                            //                     }
                            //                     unset($sp_station_value);

                            //                     if ($station_index > -1) {
                            //                         $service_array = $sp_service_array[$index]->order_detail[$station_index]->order_detail_array;
                            //                         array_push($service_array, $service_value);
                            //                         $sp_service_array[$index]->order_detail[$station_index]->order_detail_array = $service_array;
                            //                     } else {
                            //                         $sp_station_obj = clone $station_value;
                            //                         $sp_station_obj->order_detail_array = [$service_value];

                            //                         $order_detail = $sp_service_array[$index]->order_detail;
                            //                         array_push($order_detail, $sp_station_obj);
                            //                         $sp_service_array[$index]->order_detail = $order_detail;
                            //                     }
                            //                 } else {
                            //                     $sp_station_obj = clone $station_value;
                            //                     $sp_station_obj->order_detail_array = [$service_value];

                            //                     $sp_service_obj = new stdClass;
                            //                     $sp_service_obj->company_token = $service_value->company_token;
                            //                     $sp_service_obj->company_name = $service_value->company_name;
                            //                     $sp_service_obj->company_email = $service_value->company_email;
                            //                     $sp_service_obj->company_logo = $service_value->company_logo;
                            //                     $sp_service_obj->company_image = $service_value->company_image;
                            //                     $sp_service_obj->total_adult = $booking_detail->total_adult;
                            //                     $sp_service_obj->total_children = $booking_detail->total_children;
                            //                     $sp_service_obj->booking_number = $booking_detail->booking_number;
                            //                     $sp_service_obj->date_time = $booking_detail->date_time;
                            //                     $sp_service_obj->description_one = $booking_detail->description_one;
                            //                     $sp_service_obj->description_two = $booking_detail->description_two;
                            //                     $sp_service_obj->passenger_detail = $booking_detail->passenger_detail;
                            //                     $sp_service_obj->journey_detail = $booking_detail->journey_detail;
                            //                     $sp_service_obj->order_detail = [$sp_station_obj];
                            //                     array_push($sp_service_array, $sp_service_obj);
                            //                 }
                            //             }
                            //         }
                            //         unset($service_value);
                            //     }
                            //     unset($order_value);

                            //     foreach ($sp_service_array as $sp_service_value) {
                            //         $mail_order->mail_obj = $sp_service_value;

                            //         $mailerObj->email_id = $sp_service_value->company_email;
                            //         $mailerObj->user_name = $sp_service_value->company_name;
                            //         $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
                            //         $mailerObj->e_ticket = $e_ticket;
                            //         $mailerObj->mail_template = $mail_order->genMailContentForServiceProvider();

                            //         $mailerResponse = sendMail($mailerObj);
                            //         if ($mailerResponse) {
                            //             array_push($done_email, "service-provider");
                            //         } else {
                            //             $mailer_err = $mailerResponse;
                            //         }
                            //     }

                            //     include '../objects/invoice-order.php';
                            //     $invoice = new InvoiceTemplateOrder();
                            //     $invoice->invoice_obj = $booking_detail;
                            //     $invoice_template = $invoice->genInvoiceForOrder();

                            //     include '../../../TCPDF-main/store-pdf.php';
                            //     savePdf($invoice_template, $booking_token.'.pdf'); //$source_path, $add_page
                            // }
                            
                            $data = new stdClass;
                            $data->journey = $journey;
                            $data->token = $booking_token;
                            // $data->detail = $fetch_order_detail;

                            $obj->status_code = 200;
                            $obj->message = "Order placed successfuly !";
                            $obj->data = $data;
                        } else {
                            $obj->status_code = 400;
                            $obj->message = "Order creation error !";
                            $obj->data = new stdClass;
                        }
                    // } else {
                    //     $obj->status_code = 400;
                    //     $obj->message = "Payment mismatch error !";
                    //     $obj->data = new stdClass;
                    //     $obj->paid_amount = $paid_amount;
                    //     $obj->payment_amount = $payment_view;
                    //     $obj->payment_response = $payment_order;
                    // }
            //     } else if($payment_order->status == "created") {
            //         $obj->status_code = 400;
            //         $obj->message = "Payment created but incomplete ! Please initiate payment again !";
            //         $obj->data = new stdClass;
            //     } else if ($payment_order->status == "attempted") {
            //         $obj->status_code = 400;
            //         $obj->message = "Payment incomplete ! Please initiate payment again !";
            //         $obj->data = new stdClass;
            //     } else {
            //         $obj->status_code = 400;
            //         $obj->message = "Payment capture error ! Please try again after sometimes !";
            //         $obj->data = new stdClass;
            //     }
            // } else if (property_exists($payment_order, 'error')) {
            //     $obj->status_code = 400;
            //     $obj->message = $payment_order->error->description;
            //     $obj->data = new stdClass;
            // } else {
            //     $obj->status_code = 400;
            //     $obj->message = "Payment capture failed ! Contact support !";
            //     $obj->data = new stdClass;
            // }
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Duplicate order !";
            $obj->data = new stdClass;
        }
    } else {
        $obj->status_code = 400;
        $obj->message = "User detail error !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);

// For parsing stations' code from journeys
function parseStationCodesFromJourney($airport_ttr, $journey_array) {
    $station_code_array = [];
    foreach ($journey_array as $journey_key => $journey_value) {
        if ($journey_key == 0) {
            $airport_ttr->token = xss_clean($journey_value->departure_ttr_token);
            $airport_ttr->readOneTerminal();
            $airport_ttr_detail = $airport_ttr->makeView()[0];

            array_push($station_code_array, $airport_ttr_detail->airport_code);
        }

        $airport_ttr->token = xss_clean($journey_value->arrival_ttr_token);
        $airport_ttr->readOneTerminal();
        $airport_ttr_detail = $airport_ttr->makeView()[0];
        array_push($station_code_array, $airport_ttr_detail->airport_code);
    }
    unset($journey_value);

    return $station_code_array;
}

function makeBookingPassengerEntry($user_token, $booking_token, $input_passenger, $users_booking_passenger, $users_passenger, $passenger_type) {
    $users_passenger->token = xss_clean($input_passenger->token);
    $users_passenger->user_token = $user_token;
    $users_passenger->title = xss_clean($input_passenger->title);
    $users_passenger->name = xss_clean($input_passenger->name);
    $users_passenger->country_code = xss_clean($input_passenger->country_code);
    $users_passenger->mobile_number = xss_clean($input_passenger->mobile_number);
    $users_passenger->email_id = xss_clean($input_passenger->email_id);
    $users_passenger->date_of_birth = date('Y-m-d', strtotime(xss_clean($input_passenger->date_of_birth)));
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
?>