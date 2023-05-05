<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/coupon.php';
    $coupon = new coupon();
    $coupon->token    = $inputData->coupon_token;
    $coupon->coupon_type = $inputData->coupon_type;
    $coupon->coupon_status = $inputData->coupon_status;
    $coupon->name = $inputData->name;
    $coupon->description = $inputData->description;
    $coupon->from_date = date("Y-m-d", strtotime($inputData->from_date));
    $coupon->to_date = date("Y-m-d", strtotime($inputData->to_date));
    $coupon->coupon_qunaity = $inputData->coupon_qunaity;
    $coupon->coupon_length = $inputData->coupon_length;
    $coupon->coupon_format = $inputData->coupon_format;
    $coupon->coupon_prefix = $inputData->coupon_prefix;
    $coupon->coupon_suffix = $inputData->coupon_suffix;
    if($inputData->auto_generate != ''){
        $coupon->coupon_code = $inputData->auto_generate;
        $coupon->auto_generate = '1'; 
    }else{
        $coupon->coupon_code = $inputData->coupon_code;
        $coupon->auto_generate = '0';
    }
    $coupon->usesper_coupon = $inputData->usesper_coupon;
    $coupon->usesper_customer = $inputData->usesper_customer;
    $coupon->cartDiscontAmount = $inputData->cartDiscontAmount;
    $coupon->updateCoupon();
    $coupon->websiteValue = $inputData->website;
    $coupon->distributor_token = $inputData->distributor_name;
    $coupon->updateApplicableWebsite();
    $coupon->conditionValue = $inputData->conditions;
    $coupon->updateCouponCondition(); 
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Updated Coupon Successfully";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>