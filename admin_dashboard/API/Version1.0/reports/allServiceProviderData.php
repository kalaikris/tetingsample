<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/provider.php';
$provider = new provider();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
            $fromDate  = date("Y-m-d 00:00:00", strtotime($inputData->fromDate));
            $toDate    = date("Y-m-d 23:59:59", strtotime($inputData->toDate));
            $dateQuery = "";
            if($inputData->fromDate != "" && $inputData->toDate!=""){
                $dateQuery = " AND `service__provider`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
            }
            $provider->dateQuery  = $dateQuery;
        $obj->status_code = 201;
        $stmt      = $provider->allServiceProviderData();
        $obj->data = $provider->allServiceProviderDataView($stmt);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>