<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$service_provider = new ServiceProvider();
$service_provider->token  = $inputData->token;
$service_provider->currentPassword  = hash('sha512', $inputData->currentPassword);                         
$service_provider->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $service_provider->userCheck();
if($stmt->rowCount()==1){
     $chCurStmt = $service_provider->checkCurrentPassword();
     if($chCurStmt->rowCount()==1){
           if($service_provider->updateProviderNewPassword()){
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