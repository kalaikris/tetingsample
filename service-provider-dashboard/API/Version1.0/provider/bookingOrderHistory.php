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
        `users__booking`.`payment_id` LIKE '%".$searchValue."%' OR 
        `users__booking`.`user_token` LIKE '%".$searchValue."%' OR
        `users__passenger`.`name` LIKE '%".$searchValue."%' OR
        `service`.`name` LIKE '%".$searchValue."%' OR 
        `users__booking_detail`.`total_adult` LIKE '%".$searchValue."%' OR
        `users__booking_detail`.`total_children` LIKE '%".$searchValue."%' OR
        `users__booking_detail`.`token` LIKE '%".$searchValue."%' OR
        `users__booking_detail`.`status` LIKE '%".$searchValue."%'
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
    $radioBtn = $_GET['radioBtn'];
    if($radioBtn == "1"){
        $dateQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$from_date' AND '$to_date'";
    } else {
        $dateQuery = " AND `users__booking_detail`.`service_date_time` BETWEEN '$from_date' AND '$to_date'";
    }
}

$stmtNew       = $booking->bookingHistory($gm_date);
$totalRecords  = $stmtNew->rowCount();

$booking->searchQuery = $searchQuery;
$booking->dateQuery   = $dateQuery;

$stmtDisplay   = $booking->bookingHistory($gm_date);
$displayRecords= $stmtDisplay->rowCount();
$booking->rowStart    = $rowStart;
$booking->rowperpage  = $rowperpage;
switch ($columnName1) {   
    default:    $columnName = "`users__booking_detail`.`id`";
}
$booking->columnName     = $columnName;
$booking->columnSortOrder= $columnSortOrder;
$stmtDetails  = $booking->bookingHistoryCheck($gm_date);


include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
$provider->serviceProviderCompanyLocationToken = $booking->serviceProviderLocationtoken;
$stmt =  $provider->locationStaffs();
$booking->assigneeList   = $provider->locationStaffsView($stmt);


$data         = $booking->bookingHistoryView($stmtDetails,$cur_date_time);

$stmt = $booking->bookingStatus($gm_date);
$bookingStatusDetails = $booking->bookingStatusView($stmt);

$stmtUpcoming = $booking->bookingStatusCount('Pending',$gm_date);
$upcomingCount = $stmtUpcoming->rowCount();
$stmtUnassigned = $booking->bookingStatusCount('Confirmed',$gm_date);
$unassignedCount= $stmtUnassigned->rowCount();
$stmtAssigned   = $booking->bookingStatusCount('Assign',$gm_date);
$assignedCount  = $stmtAssigned->rowCount();
$stmtOngoing    = $booking->bookingStatusCount('Ongoing',$gm_date);
$ongoingCount   = $stmtOngoing->rowCount();
$stmtCompleted  = $booking->bookingStatusCount('Completed',$gm_date);
$completedCount = $stmtCompleted->rowCount();
$stmtNoshow  = $booking->bookingStatusCount('NoShow',$gm_date);
$noshowCount = $stmtNoshow->rowCount();
## Response
$obj = array(
    "code" => 201,
    "draw" => intval($draw),
    "upcomingCount" => $upcomingCount,
    "unassignedCount" => $unassignedCount,
    "assignedCount" => $assignedCount,
    "ongoingCount" => $ongoingCount,
    "completedCount" => $completedCount,
    "noShowCount" => $noshowCount,
    
    "totalCount" => $totalRecords,
    //"counts" => $bookingStatusDetails,
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $displayRecords,
    "aaData" => $data
);
echo json_encode($obj);
?>