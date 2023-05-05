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
    `users`.`name` LIKE '%".$searchValue."%' OR
    `users`.`mobile_number` LIKE '%".$searchValue."%'
    )";
}
//
include '../../../../config/core.php';
$inputData = getInputs();
include_once '../objects/booking.php';
$obj = new stdClass;
$bookings = new Booking();
$stmt1 = $bookings->allBookingCheckCount();
$totalRecords = $stmt1->rowCount();
$bookings->searchQuery = $searchQuery;
$bookings->rowStart    = $rowStart;
$bookings->rowperpage  = $rowperpage;
switch ($columnName1) {    
    default:    $columnName = "`users`.`id`";
}
$bookings->columnName      = $columnName;
$bookings->columnSortOrder = $columnSortOrder;

$stmt = $bookings->bookingSearchFilter();
$totalRecordwithFilter = $stmt->rowCount();

$stmt1 = $bookings->allBookingCheck();
$data = $bookings->readAllBooking($stmt1);

## Response
$obj = array(
    "code" => 201,
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);
echo json_encode($obj);
?>