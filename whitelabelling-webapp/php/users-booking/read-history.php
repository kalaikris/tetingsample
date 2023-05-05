<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$inputData = getInputs();
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$gmt_minutes = +330;

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $users_data = $users->makeView()[0];

        include '../objects/users-booking.php';
        $users_booking = new UsersBooking();
        $users_booking->gmt_minutes = $gmt_minutes;
        $users_booking->user_token = $user_token;
        $is_agent = false;
        $fromDate  = date("Y-m-d 00:00:00", strtotime($inputData->fromDate) );
        $toDate    = date("Y-m-d 23:59:59", strtotime($inputData->toDate) );

        if($inputData->fromDate != "" && $inputData->toDate != ""){
            $dateQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }

        if ($users_data->is_agent == true && $users_data->is_approved == 'Approved') {
            $users_booking->dateQuery  = $dateQuery;
            $users_booking->readForAgent();
        } else {
            $users_booking->dateQuery  = $dateQuery;
            $users_booking->readForUser();
        }
        
        if ($users_booking->stmt->rowCount() > 0) {
            $obj->status_code = 200;
            $obj->message = "Orders listed successfully !";
            $obj->data = $users_booking->makeView();
        } else {
            $obj->status_code = 400;
            $obj->message = "No orders found !";
            $obj->data = [];
        }
        $obj->users_data = $users_data;
        $obj->is_agent = $is_agent;
    } else {
        $obj->status_code = 400;
        $obj->message = "User detail error !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>