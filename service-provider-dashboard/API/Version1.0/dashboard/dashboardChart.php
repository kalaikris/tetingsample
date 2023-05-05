<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
    
include_once '../objects/dashboard.php';
$dashboard = new dashboard();
$dashboard->serviceProviderLocationtoken= $inputData->serviceProviderLocationtoken;
$dashboard->ranges     = $inputData->ranges;

$arrayMonths = ["01","02","03","04","05","06","07","08","09","10","11","12"];
$chartData = [];
//foreach($arrayMonths as $month){
foreach($dashboard->ranges as $range){
   
//    $monthData= array();
//    $year     = $dashboard->year;
    $dashboard->days     = $range;
    $dashboard->likeMatch = $dashboard->days;
//    for($d=1; $d<=31; $d++){
//        $time=mktime(12, 0, 0, $month, $d, $year);          
//        if (date('m', $time)==$month){
//            $dashboard->likeMatch     = date('Y-m-d', $time);
//            $obj2=new stdClass();
//            $obj2->month       = $dashboard->likeMatch;
//            $obj2->bookingCount= $dashboard->volumeData();
//            array_push($monthData, $obj2);
//        }      
//    }
    $obj1=new stdClass();
    $obj1->dates       = $dashboard->days;
    //$obj1->data        = $monthData;
    $obj1->data        = $dashboard->volumeData();
    array_push($chartData, $obj1);
}
$obj->status_code = 201;
$obj->reviews     = $chartData;
echo json_encode($obj);
?>