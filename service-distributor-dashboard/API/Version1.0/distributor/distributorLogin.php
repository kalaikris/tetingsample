<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorLogin.php';
$login = new login();
$login->businessId = $inputData->businessId;
$login->password   = hash('sha512', $inputData->password);
$is_organization = $login->checkorganization();
if($is_organization->rowCount()!=0){
    $stmt = $login->loginCheck();
    if($stmt->rowCount()==1){     
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->userDetails = $login->loginView($stmt);
    }else{
        $obj->code       =503;
        $obj->status_code=503;
    if($login->businessIdCheck()){
        $message = "Incorrect Password";
    }else{
        $message = "Invalid business id";
    }
        $obj->title  = "Oops";
        $obj->message= $message;
    }
} else {
    $obj->message = "You dont have permission to login!.."; 
}

echo json_encode($obj);
?>