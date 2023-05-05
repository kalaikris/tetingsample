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
    $stmt = $dashboard->servicesData();
    $serviceChartData = $dashboard->servicesDataView($stmt);

    $arrayMonths = ["01","02","03","04","05","06","07","08","09","10","11","12"];
    $volumeChartData = [];
//    foreach($arrayMonths as $month){
    foreach($dashboard->ranges as $range){
//        $monthData= array();
//        $year     = $dashboard->year;
        $dashboard->likeMatch     = $range;
        $obj1=new stdClass();
        $obj1->dates = $dashboard->likeMatch;
        $obj1->data  = $dashboard->volumeData();
        array_push($volumeChartData, $obj1);
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