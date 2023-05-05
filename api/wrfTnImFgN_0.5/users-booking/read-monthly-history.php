<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$user_token = $input_data->user_token;

include '../objects/users.php';
$users = new Users();
$users->token = $user_token;
$users->getUserDetail();

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
    include '../objects/users-booking.php';
    $users_booking = new UsersBooking();
    $users_booking->user_token = $user_token;
    $users_booking->month_filter = date("Y-m", strtotime($input_data->month_filter)) . "%";
    $users_booking->readMonthlyHistoryForUser();
    if ($users_booking->stmt->rowCount() > 0) {
        $obj->status_code = 200;
        $obj->message = "Orders listed successfully !";
        $obj->data = $users_booking->makeView();
    } else {
        $obj->status_code = 400;
        $obj->message = "No orders found !";
        $obj->data = [];
    }
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>