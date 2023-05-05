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
    $month = date("m", strtotime($inputData->toDate));
        if($month>=4){
            $year = date("Y", strtotime($inputData->toDate));
        }else{
            $year = date("Y",strtotime("-1 year"));
        }
    $report->startDate  = "$year-04-01 00:00:00";
    $report->fromDate = date("Y-m-d 00:00:00", strtotime($inputData->fromDate));
    $report->toDate = date("Y-m-d 23:59:59", strtotime($inputData->toDate));
if($stmt->rowCount()==1){
    $obj->status_code = 201;
    $obj->ProfitLoss     = $report->profitLossDateFilterAndYearWise();
    $obj->CashFlow     = $report->cashFlowDateFilterAndYearWise();
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>