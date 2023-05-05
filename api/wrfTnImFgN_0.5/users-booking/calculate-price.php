<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

$total_service_cost = $input_data->total_service_cost;
$coupon_discount_amt = $input_data->discount_amount;
$currency = property_exists($input_data, 'currency') ? $input_data->currency : 'INR';

$obj = new stdClass;
$currency_value = 0;
if ($currency != "INR") {
    include '../../../config/currency.php';
    $currency_value = currency("INR", $currency);
    if ($currency_value > 0) {
        // $rearrange_amount = $total_service_cost - $coupon_discount_amt;
        // $service_cost_excl_gst = round($rearrange_amount / 1.18) * (float) $currency_value;
        // $service_cost_excl_gst = number_format((float) $service_cost_excl_gst, 2, '.', '');
        // $obj->service_cost_excl_gst = $service_cost_excl_gst;
        // $service_cost_gst = round(($rearrange_amount / 1.18) * 0.18) * (float) $currency_value;
        // $service_cost_gst = number_format((float) $service_cost_gst, 2, '.', '');
        // $obj->service_cost_gst = $service_cost_gst;
        // $convenience_cost = round($service_cost_excl_gst + $service_cost_gst) * 0.03;
        // $convenience_cost = number_format((float) $convenience_cost, 2, '.', '');
        // $obj->convenience_cost = $convenience_cost;
        // $convenience_cost_gst = $convenience_cost * 0.18;
        // $convenience_cost_gst = number_format((float) $convenience_cost_gst, 2, '.', '');
        // $obj->convenience_cost_gst = $convenience_cost_gst;
        // $totalAmt = $service_cost_excl_gst + $service_cost_gst + $convenience_cost + $convenience_cost_gst;
        // $obj->total_amount = number_format((float) $totalAmt,2,'.','');


        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
        $service_cost_excl_gst = $rearrange_amount / 1.18;
        $service_cost_excl_gst = number_format((float) $service_cost_excl_gst, 2, '.', '');
        $obj->service_cost_excl_gst = $service_cost_excl_gst;
        $service_cost_gst = ($rearrange_amount / 1.18) * 0.18;
        $service_cost_gst = number_format((float) $service_cost_gst, 2, '.', '');
        $obj->service_cost_gst = $service_cost_gst;
        $convenience_cost = ($service_cost_excl_gst + $service_cost_gst) * 0.03;
        $convenience_cost = number_format((float) $convenience_cost, 2, '.', '');
        $obj->convenience_cost = $convenience_cost;
        $convenience_cost_gst = $convenience_cost * 0.18;
        $convenience_cost_gst = number_format((float) $convenience_cost_gst, 2, '.', '');
        $obj->convenience_cost_gst = $convenience_cost_gst;
        $totalAmt = $service_cost_excl_gst + $service_cost_gst + $convenience_cost + $convenience_cost_gst;
        $obj->total_amount = number_format((float) $totalAmt,2,'.','');
    }
} else {
        $rearrange_amount = $total_service_cost - $coupon_discount_amt;
        $obj->service_cost_excl_gst = strval(round($rearrange_amount / 1.18));
        $obj->service_cost_gst = strval(round(($rearrange_amount / 1.18) * 0.18));
        $obj->convenience_cost = strval(round(($obj->service_cost_excl_gst + $obj->service_cost_gst) * 0.03));
        $obj->convenience_cost_gst = strval(round($obj->convenience_cost * 0.18));
        $obj->total_amount = strval(round($obj->service_cost_excl_gst + $obj->service_cost_gst + $obj->convenience_cost + $obj->convenience_cost_gst));
}
echo json_encode($obj);
?>