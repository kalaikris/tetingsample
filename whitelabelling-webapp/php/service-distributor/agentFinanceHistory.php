<?php
session_start();
$obj=new stdClass();
include_once '../../../config/core.php';
$inputData = getInputs();
include_once '../../../config/database.php';

$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";
$gmt_minutes = +330;

if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $fromDate  = date("Y-m-d 00:00:00", strtotime($inputData->fromDate) );
        $toDate    = date("Y-m-d 23:59:59", strtotime($inputData->toDate) );

        include_once '../objects/finance.php';
        $finance = new Finance();
        $dateQuery = "";
        $creditDateQuery = "";
        if($inputData->fromDate != "" && $inputData->toDate!=""){
            $dateQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
            $creditDateQuery = " AND `service__distributor_credit_logs`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }

        $finance->userToken  = $user_token;
        $finance->dateQuery  = $dateQuery;
        $finance->creditDateQuery  = $creditDateQuery;
        $stmt = $finance->agentFinanceHistoryCheck();
        $obj->status_code= 201;
        $data       = $finance->financeHistoryView($stmt);
        usort($data, "cmp");
        $obj->data  = $data;
    }else{
        $obj->status_code= 503;
        $obj->message    = "Errors";
    }
}else{
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}

echo json_encode($obj);
function cmp($a, $b) {
    return strcmp($a->createdDateTime, $b->createdDateTime);
}
?>