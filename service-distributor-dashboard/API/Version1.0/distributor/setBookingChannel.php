<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-distributor.php';
$serviceDistributor = new ServiceDistributor();
$serviceDistributor->distributorToken   = $inputData->distributorToken;
$stmt_value = $serviceDistributor->getBookingChannel();
    $obj->status_code=200;
    $obj->title  = "Success";
    $obj->data = $stmt_value->is_credit;
echo json_encode($obj);
?>