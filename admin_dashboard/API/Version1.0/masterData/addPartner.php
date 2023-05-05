<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/partners.php';
$partners = new partners();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    $partners->partnerToken= $admin->generateToken('our_partners','token');
    $partners->name        = $inputData->name;
    $partners->image       = $inputData->image;
    $partners->gmDateTime  = $gm_date_time;
    $stmtCheck = $partners->partnerAvailableCheck();
    if($stmtCheck->rowCount()==0){
        $partners->addPartner();
        $obj->status_code = 201;
        $obj->title       = "Success";
        $obj->message     = "Added successfully";
    }else{
        $obj->status_code = 503;
        $obj->title       = "Error";
        $obj->message     = "Name already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>