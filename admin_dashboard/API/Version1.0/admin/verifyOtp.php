<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->emailAddress  = $inputData->emailAddress;
$admin->otp  = $inputData->otp;
$stmt = $admin->verifyOtp();
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Otp verified successfully";
}else{    
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Invalid Otp";
}
echo json_encode($obj);
?>