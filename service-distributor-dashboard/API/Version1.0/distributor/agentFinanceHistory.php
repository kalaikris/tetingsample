<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new booking();
$booking->userToken   = $inputData->userToken;
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
$finance->userToken  = $booking->userToken;
$finance->dateQuery  = $dateQuery;
$finance->creditDateQuery  = $creditDateQuery;
$stmt = $finance->agentFinanceHistoryCheck();
$obj->status_code= 201;
$data       = $finance->financeHistoryView($stmt);
usort($data, "compareByTimeStamp");
$obj->data  = $data;

echo json_encode($obj);
// function cmp($a, $b) {
//     return strcmp($a->createdDateTime, $b->createdDateTime);
// }

function compareByTimeStamp($element1, $element2)
{
    if (strtotime($element1->createdDateTime) < strtotime($element2->createdDateTime))
        return 1;
    else if (strtotime($element1->createdDateTime) > strtotime($element2->createdDateTime)) 
        return -1;
    else
        return 0;
}
?>