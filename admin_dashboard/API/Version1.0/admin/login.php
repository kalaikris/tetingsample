<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->emailAddress  = $inputData->emailAddress;
$admin->password   = hash('sha512', $inputData->password);
$stmt = $admin->loginCheck();
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Login successfully";
    $admin_data   = $admin->readToken($stmt);
    $obj->userToken = $admin_data->token;
    $obj->adminName = ucwords($admin_data->username);
    setcookie('azAdmin_Token', $admin_data->token, time() + 3600 * 24 * 365, '/');
}else{    
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Invalid Credentials";
}
echo json_encode($obj);
?>