<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $input_data = getInputs();
        $currency = property_exists($input_data, 'currency') ? $input_data->currency : "INR";
        $has_convenience = property_exists($input_data, 'has_convenience') ? $input_data->has_convenience : false;
        $custom_convenience_fee = property_exists($input_data, 'custom_convenience_fee') ? intval($input_data->custom_convenience_fee) : 0;

        $users_detail = $users->makeView()[0];

        include '../objects/service-location.php';
        $service_location = new ServiceLocation();

        $total_service_cost = 0;
        $service_coupon_arr = [];
        $new_array = [];
        $station_array = $input_data->station_array;
        foreach ($station_array as $key => $station_value) {
            $service_location->airport_ttr_token = $station_value->ttr_token;
            foreach ($station_value->service_array as $service_value) {
                $service_location->service_token = $service_value->service_token;

                $site_name = get_service_distributor(); // config/core.php 
                $service_location->searchServicesForTTRTokenAndServiceToken($site_name);
                $total_amount = 0;
                if ($service_location->stmt->rowCount() > 0) {
                    $service_location_value = $service_location->makeView()[0];
                    if ($service_location_value->additional_price_adult > 0 && $service_value->adult_count > 1) {
                        $total_service_cost += ($service_location_value->price_adult + (($service_value->adult_count - 1) * $service_location_value->additional_price_adult));
                        $total_amount += ($service_location_value->price_adult + (($service_value->adult_count - 1) * $service_location_value->additional_price_adult));
                    } else {
                        $total_service_cost += $service_value->adult_count * $service_location_value->price_adult;
                        $total_amount += $service_value->adult_count * $service_location_value->price_adult;
                    }
                    if ($service_location_value->additional_price_children > 0 && $service_value->children_count > 1) {
                        $total_service_cost += ($service_location_value->price_children + (($service_value->children_count - 1) * $service_location_value->additional_price_children));
                        $total_amount += ($service_location_value->price_children + (($service_value->children_count - 1) * $service_location_value->additional_price_children));
                    } else {
                        $total_service_cost += $service_value->children_count * $service_location_value->price_children;
                        $total_amount += $service_value->children_count * $service_location_value->price_children;
                    }
                    $service_coupon_detail = new stdClass();
                    $service_coupon_detail->business_token = $service_location_value->unique_business_token;
                    $service_coupon_detail->service_type = $service_location_value->service_type;
                    $service_coupon_detail->total_amount = $total_amount;
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
        $coupon_data->couponCode = $input_data->coupon_code;
        $coupon_data->site_name = $site_name;
        $check_type = '';
        if ($input_data->coupon_type == "Category") {
            // re-work
            $newarray = "'" . join("','", $new_array) . "'";
            $category_arr = $coupon_data->readCategoryCoupon($newarray);
            for ($i = 0; count($service_coupon_arr) > $i; $i++) {
                for($j = 0; count($category_arr) > $j; $j++){
                    if ($service_coupon_arr[$i]->business_token != '') {
                        if ($service_coupon_arr[$i]->business_token == $category_arr[$j]->business_type_token) {
                            $check_type = $category_arr[$j]->gst_type;
                            if($category_arr[$j]->gst_type == "Incl Gst"){
                                if ($category_arr[$j]->coupon_type == 'Percentage') {
                                    $coupon_discount_amt += (float) ($service_coupon_arr[$i]->total_amount) * $category_arr[$j]->discount_amount / 100;
                                } else if ($category_arr[$j]->coupon_type == 'Flat') {
                                    $coupon_discount_amt += (int) $category_arr[$j]->discount_amount;
                                }
                            } else {
                                if ($category_arr[$j]->coupon_type == 'Percentage') {
                                    $coupon_discount_amt += (float) ($service_coupon_arr[$i]->total_amount / 1.18) * $category_arr[$j]->discount_amount / 100;
                                } else if ($category_arr[$j]->coupon_type == 'Flat') {
                                    $coupon_discount_amt += (int) $category_arr[$j]->discount_amount;
                                }
                            }
                        } else {
                            $coupon_discount_amt += (int) 0;
                        }
                    }
                }
            }
            // re-work
        } else if ($input_data->coupon_type == "Cart") {
            $cart_arr = $coupon_data->readCartCoupon();
            foreach ($cart_arr as $cart_value) {
                $check_type = $cart_value->gst_type;
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
        }
        $total_price = 0;
        if ($has_convenience) {
            if ($custom_convenience_fee > 0) {
                if (($input_data->coupon_type == "Cart" && $check_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $check_type == "Incl Gst")) {
                    $total_service_costs = $total_service_cost - $coupon_discount_amt;
                    $rearrange_amount = ($total_service_costs / 1.18);
                    $total_price = round($rearrange_amount) + round($rearrange_amount * 0.18) + round($custom_convenience_fee) + ($custom_convenience_fee * 0.18);
                } else {
                    $rearrange_amount = ($total_service_cost / 1.18);
                    $total_service_costs = $rearrange_amount - $coupon_discount_amt;
                    $total_price = round($total_service_costs) + round($total_service_costs * 0.18) + round($custom_convenience_fee) + ($custom_convenience_fee * 0.18);
                }
            } else {
                if($users_detail->is_agent && $users_detail->is_approved == "Approved" && $users_detail->is_credit && $custom_convenience_fee==0){
                    if (($input_data->coupon_type == "Cart" && $check_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $check_type == "Incl Gst")) {
                        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
                        $service_cost_excl_gst = round($rearrange_amount / 1.18);
                        $service_cost_gst = round(($rearrange_amount / 1.18) * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        // $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        // $convenience_cost_gst = round($convenience_cost * 0.18);
                    } else {
                        $rearrange_amount = ($total_service_cost / 1.18);
                        $total_service_costs = $rearrange_amount - $coupon_discount_amt;
    
                        $service_cost_excl_gst = round($total_service_costs);
                        $service_cost_gst = round($total_service_costs * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        // $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        // $convenience_cost_gst = round($convenience_cost * 0.18);
                    }
                } else if($users_detail->is_agent && $users_detail->is_approved == "Approved" && $custom_convenience_fee==0){
                    if (($input_data->coupon_type == "Cart" && $check_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $check_type == "Incl Gst")) {
                        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
                        $service_cost_excl_gst = round($rearrange_amount / 1.18);
                        $service_cost_gst = round(($rearrange_amount / 1.18) * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        // $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        // $convenience_cost_gst = round($convenience_cost * 0.18);
                    } else {
                        $rearrange_amount = ($total_service_cost / 1.18);
                        $total_service_costs = $rearrange_amount - $coupon_discount_amt;
    
                        $service_cost_excl_gst = round($total_service_costs);
                        $service_cost_gst = round($total_service_costs * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        // $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        // $convenience_cost_gst = round($convenience_cost * 0.18);
                    }
                } else {
                    if (($input_data->coupon_type == "Cart" && $check_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $check_type == "Incl Gst")) {
                        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
                        $service_cost_excl_gst = round($rearrange_amount / 1.18);
                        $service_cost_gst = round(($rearrange_amount / 1.18) * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        $convenience_cost_gst = round($convenience_cost * 0.18);
                    } else {
                        $rearrange_amount = ($total_service_cost / 1.18);
                        $total_service_costs = $rearrange_amount - $coupon_discount_amt;
    
                        $service_cost_excl_gst = round($total_service_costs);
                        $service_cost_gst = round($total_service_costs * 0.18);
                        // $convenience_cost = round(($total_service_cost - $coupon_discount_amt) * 0.03);
                        $convenience_cost = round(($service_cost_excl_gst + $service_cost_gst) * 0.03);
                        $convenience_cost_gst = round($convenience_cost * 0.18);
                    }
                }
                
                $price_obj = new stdClass;
                // $price_obj->input = intval($total_service_cost);
                $price_obj->service_cost_excl_gst = intval($service_cost_excl_gst);
                $price_obj->service_cost_gst = intval($service_cost_gst);
                $price_obj->convenience_cost = intval($convenience_cost);
                $price_obj->convenience_cost_gst = intval($convenience_cost_gst);
                $price_obj->total_cost = intval($service_cost_excl_gst) + intval($service_cost_gst) + intval($convenience_cost) + intval($convenience_cost_gst);
                $price_obj->coupon_discount_amt = $coupon_discount_amt;
                $price_data = $price_obj;
                $total_price = $price_data->total_cost;
            }
        } else {
            $total_price = $total_service_cost;
        }

        if ($total_price > 0) {
            if ($currency != "INR") {
                include '../../../config/currency.php';
                $currency_value = currency("INR", $currency);
                if ($currency_value > 0) {
                    $total_price = $total_price * $currency_value;
                    $total_price = number_format((float) $total_price, 2, '.', '');
                }
            }
            include '../../../config/razor-pay.php';
            $razor_pay = new RazorPay();
            $razor_pay->user_id = $user_token;
            $razor_pay->price = $total_price;
            $razor_pay->currency = $currency;

            if ($users_detail->is_agent && $users_detail->is_approved == "Approved" && $users_detail->is_credit) {
                $obj = new stdClass;
                $obj->status_code = 200;
                $obj->message = "Order not initiated !";
                $obj->order_id = "Order by Credit";
                $obj->payment_amount = $total_price;
                $obj->receipt = "";
                $obj->rzp_authkey = "";
                $obj->is_credit = true;
            } else {
                $obj = $razor_pay->createOrder();
                $obj->is_credit = false;
            }

            $obj->users_detail = $users_detail;
            $obj->user_name = $users_detail->name;
            $obj->user_email = $users_detail->email;
            $obj->user_mobile = $users_detail->mobile_number;
        } else {
            $obj->status_code = 400;
            $obj->message = "Price error !";
            $obj->data = $station_array;
        }
    } else {
        $obj->status_code = 400;
        $obj->message = "User detail error !";
        $obj->data = $user_token;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>