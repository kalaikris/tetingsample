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
    $distributor->ranges     = $inputData->ranges;
    $serviceChartData    = [];
    $volumeChartData = [];

    foreach($distributor->ranges as $range){
        $distributor->likeMatch     = $range;
        $obj1=new stdClass();
        $obj1->dates = $distributor->likeMatch;
        $obj1->data  = $distributor->websiteData();
        array_push($volumeChartData, $obj1);
        
        $obj2=new stdClass();
        $obj2->dates = $distributor->likeMatch;
        $obj2->data  = $distributor->agentData();
        array_push($serviceChartData, $obj2);
        
    }
    $obj->status_code      = 201;
    $obj->volumeChartData  = $volumeChartData;
    $obj->serviceChartData = $serviceChartData;
    
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>