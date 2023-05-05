<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/reports.php';
$report = new reports();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($inputData->startDate == "" && $inputData->endDate == ""){
    $report->filter = "MonthlyWiseFilter";
    $report->thisMonth = date("Y-m", strtotime($gm_date));
    $report->toDate    = $gm_date_time;
    $month = date("m", strtotime($gm_date));
        if($month>=4){
            $year = date("Y", strtotime($gm_date));
        }else{
            $year = date("Y",strtotime("-1 year"));
        }
    $report->fromDate  = "$year-04-01 00:00:00";
}else{
    $report->filter = "DateWiseFilter";
    $month = date("m", strtotime($inputData->endDate));
        if($month>=4){
            $year = date("Y", strtotime($inputData->endDate));
        }else{
            $year = date("Y",strtotime("-1 year"));
        }
    $report->fromDate  = "$year-04-01 00:00:00";
    $report->startDate = date("Y-m-d 00:00:00", strtotime($inputData->startDate));
    $report->endDate = date("Y-m-d 23:59:59", strtotime($inputData->endDate));
}
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->thisMonthRevenue     = $report->thisMonthRevenueSummary();
    $obj->fromAprilRevenue     = $report->fromAprilRevenueSummary();
    $obj->thisMonthCancellation= $report->thisMonthCancellationSummary();
    $obj->fromAprilCancellation= $report->fromAprilCancellationSummary();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>