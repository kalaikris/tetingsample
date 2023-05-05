<?php
$draw        = $_POST['draw'];
$rowStart    = $_POST['start'];
$rowperpage  = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName1 = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value'];
## oops conncetivity
$searchQuery = "";
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
$date = $_GET['date'];

$dateQuery = " ";
if($date != ""){
    $dateQuery = " AND `users__booking_detail`.`service_date_time` LIKE '".$date."%'";
}
$stmtNew       = $booking->newBookingHistory($gm_date);
$totalRecords  = $stmtNew->rowCount();
$booking->searchQuery = $searchQuery;
$booking->dateQuery   = $dateQuery;

$stmtDisplay   = $booking->newBookingHistory($gm_date);
$displayRecords= $stmtDisplay->rowCount();
$booking->rowStart    = $rowStart;
$booking->rowperpage  = $rowperpage;
switch ($columnName1) {   
    default:    $columnName = "`users__booking_detail`.`id`";
}
$booking->columnName     = $columnName;
$booking->columnSortOrder= $columnSortOrder;
$stmtDetails  = $booking->newBookingHistoryCheck($gm_date);


include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
$provider->serviceProviderCompanyLocationToken = $booking->serviceProviderLocationtoken;
$stmt =  $provider->locationStaffs();
$booking->assigneeList   = $provider->locationStaffsView($stmt);



$data         = $booking->bookingHistoryView($stmtDetails,$cur_date_time);



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