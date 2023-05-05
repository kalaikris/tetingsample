<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$admin->currentPassword  = hash('sha512', $inputData->currentPassword);                         
$admin->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $chStmt = $admin->checkCurrentPassword();
    if($chStmt->rowCount()==1){
        if($admin->updateAdminNewPassword()){
            $obj->status_code = 201;
            $obj->title       = "Success";
            $obj->message     = "New Password Updated Successfully";
        }else{
            $obj->status_code = 503;
            $obj->title       = "Error";
            $obj->message     = "Password is not updated";
        }
     }else{
         $obj->status_code = 503;
         $obj->title       = "Error";
         $obj->message     = "Entered Current password is wrong";
    }
}else{    
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Invalid Admin Token";
}
echo json_encode($obj);
?>