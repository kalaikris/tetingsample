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
    $coupon->token = $inputData->token;
    if($inputData->type == 'view_coupon'){
        $stmt = $coupon->getCouponDetails();
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Single Coupon List Successfully";
        $obj->data = $stmt;
    }else if($inputData->type == 'delete_coupon'){
        if($coupon->deleteCoupon()){
            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Coupon Deleted Successfully";
        }else{
            $obj->status_code = 400;
            $obj->title = "Error";
            $obj->message = "Not able to Delete Coupon";
        } 
    } 
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>