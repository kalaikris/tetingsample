<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$service_provider = new ServiceProvider();
$service_provider->businessId  = $inputData->businessId;
$service_provider->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $service_provider->userBusinessIdCheck();
if($stmt->rowCount()==1){
     if($service_provider->updateProviderPassword()){
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