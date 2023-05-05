<?php
$draw        = $_POST['draw'];
$rowStart    = $_POST['start'];
$rowperpage  = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName1 = $_POST['columns'][$columnIndex]['data']; // Column name
//$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$columnSortOrder = 'desc';
$searchValue = $_POST['search']['value'];
## oops conncetivity
$searchQuery = "";
if($searchValue != ''){
    $searchQuery = " AND ( 
    `users__booking`.`booking_number` LIKE '%".$searchValue."%' OR 
    `users__booking_detail`.`net_amount` LIKE '%".$searchValue."%' OR 
    `users__booking_detail`.`cancellation_fee` LIKE '%".$searchValue."%'
    ) ";
}
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/finance.php';
$finance = new Finance();
$finance->serviceProviderLocationtoken = $_GET['serviceProviderLocationtoken'];
$fromDate  = date("Y-m-d 00:00:00", strtotime($_GET['fromDate']) );
$toDate    = date("Y-m-d 23:59:59", strtotime($_GET['toDate']) );
$dateQuery = "";
$creditDateQuery = "";
if($_GET['fromDate'] != "" && $_GET['toDate']!=""){
    $dateQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
    $creditDateQuery = " AND `provider_logs`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
}
$stmtNew       = $finance->financeHistory($gm_date);
$totalRecords  = $stmtNew->rowCount();
$finance->searchQuery = $searchQuery;
$finance->dateQuery   = $dateQuery;
$finance->creditDateQuery  = $creditDateQuery;
$stmtDisplay   = $finance->financeHistory($gm_date);
$displayRecords= $stmtDisplay->rowCount();
$finance->rowStart    = $rowStart;
$finance->rowperpage  = $rowperpage;
switch ($columnName1) {   
    default:    $columnName = "`users__booking_detail`.`id`";
}
$finance->columnName     = $columnName;
$finance->columnSortOrder= $columnSortOrder;
$stmtDetails  = $finance->financeHistoryCheck($gm_date);
$data         = $finance->financeHistoryView($stmtDetails,$gm_date_time);
usort($data, "compareByTimeStamp");
## Response
$obj = array(
    "code" => 201,
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $displayRecords,
    "aaData" => $data
);
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