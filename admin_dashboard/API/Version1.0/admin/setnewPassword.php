<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->emailAddress  = $inputData->emailAddress;
$admin->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $admin->userEmailCheckForgotPassword();
if($stmt->rowCount()==1){
     if($admin->updateAdminPassword()){
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Update New Password Successfully";
     }
}else{    
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Password Not Updated";
}
echo json_encode($obj);
?>