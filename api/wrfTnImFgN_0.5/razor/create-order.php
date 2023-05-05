<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include '../../../config/core.php';
$input_data = getInputs();
$user_token = $input_data->user_token;

include '../objects/users.php';
$users = new Users();
$users->token = $user_token;
$users->getUserDetail();

$currency = property_exists($input_data, 'currency') ? $input_data->currency : "INR";

include '../../../config/currency.php';
$currency_value = currency("INR", $currency);

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
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
            $service_location->searchServicesForTTRTokenAndServiceToken();
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
                // $total_service_cost += intval(($service_value->adult_count * $service_location_value->price_adult) + ($service_value->children_count * $service_location_value->price_children));

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
    $check_type = '';
    if ($input_data->coupon_type == "Category") {
        $newarray = "'" . join("','", $new_array) . "'";
        $category_arr = $coupon_data->readCategoryCoupon($newarray,$currency_value);
        for ($i = 0; count($service_coupon_arr) > $i; $i++) {
            for($j = 0; count($category_arr) > $j; $j++){
                if ($service_coupon_arr[$i]->business_token != '') {
                    if ($service_coupon_arr[$i]->business_token == $category_arr[$j]->business_type_token) {
                        $check_type = $category_arr[$j]->gst_type;
                        if($category_arr[$j]->gst_type == "Incl Gst"){
                            if ($category_arr[$j]->coupon_type == 'Percentage') {
                                $coupon_discount_amt1 = (float) ($service_coupon_arr[$i]->total_amount) * $category_arr[$j]->dis_amt / 100;
                                $coupon_discount_amt += $coupon_discount_amt1 * $category_arr[$j]->currency_value;
                            } else if ($category_arr[$j]->coupon_type == 'Flat') {
                                $coupon_discount_amt += (int) $category_arr[$j]->dis_amt* $category_arr[$j]->currency_value;
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
    }  else if ($input_data->coupon_type == "Cart") {
        $cart_arr = $coupon_data->readCartCoupon($currency_value);
        foreach ($cart_arr as $cart_value) {
            $check_type = $cart_value->gst_type;
            if ($cart_value->gst_type == "Incl Gst") {
                if ($cart_value->coupon_condition == "Greater Than Or Equal To") {
                    $sc_cost = $total_service_cost;
                    if ($sc_cost >= $cart_value->cart_dis_amt) {
                        if ($cart_value->coupon_type == "Percentage") {
                            $coupon_discount_amt1 = round($sc_cost * $cart_value->dis_amt / 100);
                            $coupon_discount_amt += $coupon_discount_amt1 * $cart_value->currency_value;
                        } else if ($cart_value->coupon_type == 'Flat') {
                            $coupon_discount_amt += (int) $cart_value->dis_amt * $cart_value->currency_value;
                        }
                    } else {
                        $coupon_discount_amt += 0;
                    }
                } else {
                    $sc_cost = $total_service_cost;
                    if ($sc_cost <= $cart_value->cart_dis_amt) {
                        if ($cart_value->coupon_type == "Percentage") {
                            $coupon_discount_amt1 = round($sc_cost * $cart_value->dis_amt / 100);
                            $coupon_discount_amt += $coupon_discount_amt1 * $cart_value->currency_value;
                        } else if ($cart_value->coupon_type == 'Flat') {
                            $coupon_discount_amt += (int) $cart_value->dis_amt * $cart_value->currency_value;
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
    $rearrange_amount = ($total_service_cost / 1.18);

    if (($input_data->coupon_type == "Cart" && $check_type == "Incl Gst") || ($input_data->coupon_type == "Category" && $check_type == "Incl Gst")) {
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
    $price_obj->coupon_discount_amt = $coupon_discount_amt;
    $price_data = $price_obj;

    if ($price_data->total_cost > 0) {
        $total_price = $price_data->total_cost;

        if ($currency != "INR") {
            // include '../../../config/currency.php';
            // $currency_value = currency("INR", $currency);
            if ($currency_value > 0) {
                $total_price = $total_price * (float) $currency_value;
                $total_price = number_format((float) $total_price, 2, '.', '');
            }
        }

        include '../../../config/razor-pay.php';
        $razor_pay = new RazorPay();
        $razor_pay->user_id = $user_token;
        $razor_pay->price = $total_price;
        $razor_pay->currency = $currency;

        $obj = $razor_pay->createOrder();
        $obj->price_data = $price_data;
        $obj->currency_value = $currency_value;
        $obj->user_name = $users_detail->name;
        $obj->user_email = $users_detail->email;
        $obj->user_mobile = $users_detail->mobile_number;
    } else {
        $obj->status_code = 400;
        $obj->message = "User detail error !";
        $obj->data = $station_array;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = $user_token;
}
echo json_encode($obj);
?>