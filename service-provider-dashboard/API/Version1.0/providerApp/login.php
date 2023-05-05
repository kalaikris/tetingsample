<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/providerApp.php';
$providerApp = new providerApp();
$providerApp->businessId = $inputData->business_id;
$providerApp->password   = hash('sha512', $inputData->password);
$stmt = $providerApp->loginCheck();
if($stmt->rowCount()==1){
    
    $obj1=new stdClass();
    $obj1->userToken   = $providerApp->getToken($stmt);
    
    $obj->status_code = 201;  
    $obj->message     = "Login Succesfully";
    $obj->data        = $obj1;
}else{
    $obj->status_code = 503;  
    $obj->message     = "Invalid Credentials";
}
echo json_encode($obj);
?>