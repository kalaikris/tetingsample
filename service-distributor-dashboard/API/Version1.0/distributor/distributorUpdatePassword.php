<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorLogin.php';
$login = new login();
$login->userToken  = $inputData->userToken;
$login->distributorToken  = $inputData->distributorToken;
$login->currentPassword  = hash('sha512', $inputData->currentPassword);                         
$login->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $login->userCheck();
if($stmt->rowCount()==1){
     $chCurStmt = $login->checkCurrentPassword();
     if($chCurStmt->rowCount()==1){
           if($login->updateDistributorNewPassword()){
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
    $obj->message     = "Invalid User Token";
}
echo json_encode($obj);
?>