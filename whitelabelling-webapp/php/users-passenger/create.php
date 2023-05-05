<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $input_data = getInputs();

    include '../objects/users-passenger.php';
    $users_passenger = new UsersPassenger();
    $users_passenger->user_token = $_SESSION[$cookie_name];
    $users_passenger->token = genToken('users__passenger');
    $users_passenger->title = $input_data->title;
    $users_passenger->name = $input_data->name;
    $users_passenger->country_code = $input_data->country_code;
    $users_passenger->mobile_number = $input_data->mobile_number;
    $users_passenger->email_id = $input_data->email_id;
    $users_passenger->date_of_birth = date('Y-m-d', strtotime($input_data->date_of_birth));

    if ($users_passenger->create()) {
        $users_passenger->readOne();
        $users_passenger_detail = $users_passenger->makeView()[0];
        $users_passenger_detail->age = getTimeDifference( $users_passenger_detail->date_of_birth );

        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Passenger detail added successfully !";
        $obj->data = $users_passenger_detail;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Passenger couldn't added at the time !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found ! Please login again !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
