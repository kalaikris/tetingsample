<?php
$draw        = $_POST['draw'];
$rowStart    = $_POST['start'];
$rowperpage  = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName1 = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value'];
## oops conncetivity
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " AND ( 
    `users__booking`.`booking_number` LIKE '%".$searchValue."%' OR 
    `service`.`name` LIKE '%".$searchValue."%' OR 
    `users__booking_detail`.`net_amount` LIKE '%".$searchValue."%' OR 
    `users__booking_detail`.`refund_status` LIKE '%".$searchValue."%' OR 
    `users__booking_detail`.`refunded_amount` LIKE '%".$searchValue."%'
    ) ";
}
$obj=new stdClass();

include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->serviceProviderLocationtoken = $_GET['serviceProviderLocationtoken'];
$dateQuery = " ";
if($_GET['from_date']!="" && $_GET['to_date']!=""){
    $from_date = date("Y-m-d 00:00:00", strtotime($_GET['from_date']));
    $to_date = date("Y-m-d 23:59:59", strtotime($_GET['to_date']));
    $dateQuery = " AND `users__booking_detail`.`cancelled_date` BETWEEN '$from_date' AND '$to_date'";
}
$stmtNew       = $booking->cancelBookingHistory($gm_date);
$totalRecords  = $stmtNew->rowCount();

$lostRevenue   = $booking->cancelBookingHistoryLostRevenue($gm_date);

$booking->searchQuery = $searchQuery;
$booking->dateQuery   = $dateQuery;

$stmtDisplay   = $booking->cancelBookingHistory($gm_date);
$displayRecords= $stmtDisplay->rowCount();
$booking->rowStart    = $rowStart;
$booking->rowperpage  = $rowperpage;
switch ($columnName1) {   
    default:    $columnName = "`users__booking_detail`.`id`";
}
$booking->columnName     = $columnName;
$booking->columnSortOrder= $columnSortOrder;
$stmtDetails  = $booking->cancelBookingHistoryCheck($gm_date);
$data         = $booking->cancelBookingView($stmtDetails,$gm_date_time);
## Response
$obj = array(
    "code" => 201,
    "draw" => intval($draw),
    "totalCount" => $totalRecords,
    "lostRevenue" => $lostRevenue,
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $displayRecords,
    "aaData" => $data
);
echo json_encode($obj);
?>