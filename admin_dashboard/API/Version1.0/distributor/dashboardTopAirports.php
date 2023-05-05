<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributor.php';
$distributor = new distributor();
$distributor->distributorToken = $inputData->distributorToken;
$stmt = $distributor->singleDistributorDetail();
if($stmt->rowCount()==1){
    $distributor->from_date      = $inputData->from_date;
    $distributor->to_date      = $inputData->to_date;
    $distributor->totalCount= 0;
    $stmt = $distributor->topAirports();
    $obj->status_code = 201;
    $obj->topAirports = $distributor->topAirportsView($stmt);
    $obj->totalCount  = $distributor->totalCount;
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>