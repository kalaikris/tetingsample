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

$stmtNew       = $booking->newCancelBooking($gm_date);
$totalRecords  = $stmtNew->rowCount();

$booking->searchQuery = $searchQuery;

$stmtDisplay   = $booking->newCancelBooking($gm_date);
$displayRecords= $stmtDisplay->rowCount();

$booking->rowStart    = $rowStart;
$booking->rowperpage  = $rowperpage;
switch ($columnName1) {   
    default:    $columnName = "`users__booking_detail`.`id`";
}
$booking->columnName     = $columnName;
$booking->columnSortOrder= $columnSortOrder;
$stmtDetails  = $booking->newCancelBookingCheck($gm_date);
$data         = $booking->cancelBookingView($stmtDetails,$gm_date_time);
## Response
$obj = array(
    "code" => 201,
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $displayRecords,
    "aaData" => $data
);
echo json_encode($obj);
?>