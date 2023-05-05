<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorOperations.php';
$operations = new operations();
$operations->distributorToken = $inputData->distributorToken;
$operations->userToken = $inputData->userToken;
$stmt = $operations->distributorDetailsCheck();
if($stmt->rowCount()==1){
    include_once '../objects/dashboard.php';
    $dashboard = new dashboard();
    $dashboard->userToken= $operations->userToken;
//    $dashboard->year     = $inputData->year;
    $dashboard->ranges     = $inputData->ranges;
    $serviceChartData    = [];

    $volumeChartData = [];

    foreach($dashboard->ranges as $range){
        $dashboard->likeMatch     = $range;
        $obj1=new stdClass();
        $obj1->dates = $dashboard->likeMatch;
        $obj1->data  = $dashboard->websiteData();
        array_push($volumeChartData, $obj1);
        
        $obj2=new stdClass();
        $obj2->dates = $dashboard->likeMatch;
        $obj2->data  = $dashboard->agentData();
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