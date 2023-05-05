<?php
include '../../../config/core.php';
$site_name = get_service_distributor();

include '../objects/coupon.php';
$avaiable_coupon = new UserCoupon();
$avaiable_coupon->site_name = $site_name;

$avaiable_coupon->read();

$obj = new stdClass;
if ($avaiable_coupon->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $avaiable_coupon->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No Coupon Found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>