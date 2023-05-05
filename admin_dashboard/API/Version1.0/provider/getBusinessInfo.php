<?php
include '../../../../config/core.php';
$input_data = getInputs();
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/provider.php';
$obj = new stdClass;
$provider = new provider();
$admin->adminToken  = $input_data->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $provider->companyToken = $input_data->company_token;
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->data        = $provider->getBussinessInfo();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>