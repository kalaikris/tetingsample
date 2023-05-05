<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$cookie_name = "airportzo-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    include '../objects/users-passenger.php';
    $users_passenger = new UsersPassenger();
    $users_passenger->user_token = $_SESSION[$cookie_name];
    $users_passenger->getPassengerList();

    if ($users_passenger->stmt->rowCount() > 0) {
        $users_passenger_list = $users_passenger->makeView();
        foreach ($users_passenger_list as $users_passenger_value) {
            $users_passenger_value->age = getTimeDifference( $users_passenger_value->date_of_birth );
        }

        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Success";
        $obj->data = $users_passenger_list;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "No passenger list found !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
