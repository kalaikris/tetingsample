<?php
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
    $coupon->token    = $admin->generateToken('coupon','token');
    $coupon->coupon_type = $inputData->coupon_type;
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
    $coupon->addCoupon($cur_date_time);
    $applicable_website = [];
    foreach($inputData->website as $websiteValue){
        if($websiteValue == '1'){
           foreach($inputData->distributor_name as $distributorValue){
             $applicable_token = $admin->generateToken('coupon__applicable','token');
             $applicable_website[] = "('$applicable_token','$coupon->token','$websiteValue','$distributorValue')"; 
           }
        }else{
            $applicable_token = $admin->generateToken('coupon__applicable','token');
            $applicable_website[] = "('$applicable_token','$coupon->token','$websiteValue','0')"; 
        }
    }
    $coupon->addCouponApplicableWebsite($applicable_website);
    $coupon_condition = []; 
    foreach($inputData->conditions as $conditionValue){
        $condition_token = $admin->generateToken('coupon__condition','token');
        if($inputData->coupon_type == 'Category'){
            $coupon_condition[] = "('$condition_token','$coupon->token','$conditionValue->serviceType','$conditionValue->serviceCondition','$conditionValue->discountAmount','$conditionValue->serviceGstType','')"; 
        }else{ 
            $coupon_condition[] = "('$condition_token','$coupon->token','','$conditionValue->serviceCondition','$conditionValue->discountAmount','$conditionValue->gstType','$conditionValue->serviceAmt')"; 
        }
    }

    $coupon->addCouponCondition($coupon_condition); 
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Added Coupon Successfully";
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>