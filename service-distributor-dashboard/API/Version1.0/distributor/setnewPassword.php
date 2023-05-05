<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorLogin.php';
$login = new login();
$login->businessId  = $inputData->businessId;
$login->newPassword  = hash('sha512', $inputData->newPassword);                         
$stmt = $login->userBusinessIdCheck();
if($stmt->rowCount()==1){
     if($login->updateDistributorPassword()){
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