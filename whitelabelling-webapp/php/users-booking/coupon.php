<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);
include '../../../config/core.php';
$site_name = get_service_distributor();
$input_data = getInputs();

include '../objects/coupon.php';
$coupon = new UserCoupon();
$coupon->serviceToken = $input_data->serviceToken;
$coupon->couponCode = $input_data->couponCode;
$coupon->site_name = $site_name;

$obj = new stdClass;
$coupon_data = $coupon->checkActiveCoupon();
if ($coupon->stmt->rowCount() > 0) {
    // $coupon->checkValidity();
    // if ($coupon->stmt->rowCount() > 0) {
        if ($coupon_data->type == "Category") {
            $getbusiness_token = $coupon->getbusinessToken();
            $businessToken = "'" . join("','", $getbusiness_token) . "'";
            $categorydata = $coupon->readCategoryCoupon($businessToken);
            if (sizeof($categorydata) > 0) {
                $obj->status_code = 200;
                $obj->message = $input_data->couponCode . " Coupon Code Applied !";
                $obj->categoryData = $categorydata;
                $obj->data = $coupon_data;
            } else {
                $obj->status_code = 400;
                $obj->message = 'Coupon Code is not Available for choosed Service !';
            }
        } else {
            $checkcartcoupon = $coupon->checkBalanceCartCoupon();
            if ($checkcartcoupon->availableCoupon != 0) {
                $coupon->userToken = $input_data->user_token;
                $checkavailable_user_coupon = $coupon->checkAvailableUserCoupon();
                if ($checkavailable_user_coupon->available_user_coupon == -1 || $checkavailable_user_coupon->available_user_coupon != 0) {
                    $cartdata = $coupon->readCartCoupon();
                    if (sizeof($cartdata) > 0) {
                        $obj->status_code = 200;
                        $obj->message = $input_data->couponCode . " Coupon Code Applied !";
                        $obj->cartData = $cartdata;
                        $obj->data = $coupon_data;
                    } else {
                        $obj->status_code = 400;
                        $obj->message = 'Coupon Code is not Available for choosed Service !';
                    }
                } else {
                    $obj->status_code = 400;
                    $obj->message = 'Coupon code exceed for current user !';
                }
            } else {
                $obj->status_code = 400;
                $obj->message = 'Coupon code exceed';
            }
        }
    // } else {
    //     $obj->status_code = 400;
    //     $obj->message = 'Coupon Validity Expired !';
    // }
} else {
    $obj->status_code = 400;
    $obj->message = 'Please Enter Active Coupons !';
}

echo json_encode($obj);
?>