<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorOperations.php';
$operations = new operations();
$operations->distributorToken = $inputData->distributorToken;
//$operations->userToken        = $inputData->userToken;
$stmt = $operations->distributorUserCheck();
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->message     = "Success";
    $obj->data        = $operations->getBrandingDetails();
}else{
    $obj->status_code = 503;
    $obj->message     = "Error";
}
echo json_encode($obj);
?>