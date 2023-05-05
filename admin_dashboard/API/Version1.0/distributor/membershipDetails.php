<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/distributor.php';
    $distributor = new distributor();
    if($inputData->type == 'get_distributor_name'){
        $data = $distributor->isLoyaltyDistributorName();
        $obj->status_code = 200;
        $obj->title       = "Success";
        $obj->message     = "Distributor Name List";
        $obj->data        = $data;
    }else if($inputData->type == 'get_membership_details'){
        $fromDate = date("Y-m-d 00:00:00", strtotime($inputData->fromDate));
        $toDate = date("Y-m-d 23:59:59", strtotime($inputData->toDate));
        $distributorToken = $inputData->distributorToken;
        $dateQuery = "";
        $dateQuery = " AND `users__booking`.`service_distributor_token` = '$distributorToken' AND `users__booking`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        $distributor->dateQuery  = $dateQuery;
        if($fromDate != '' && $toDate != '' && $distributorToken != ''){
            $stmt1 = $distributor->getLoyaltyBookingList();
            $data = $distributor->loyaltyBookingListView($stmt1);
            $obj->status_code = 200;
            $obj->title       = "Success";
            $obj->message     = "Membership List";
            $obj->data        = $data;
            $obj->row_count   = $stmt1->rowCount();
        }else{
            $obj->status_code = 400;
            $obj->title       = "Error";
            $obj->message     = "No Membership List";
            $obj->data        = [];
        }
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>