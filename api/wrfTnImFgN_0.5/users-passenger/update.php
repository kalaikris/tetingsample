<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users-passenger.php';
$users_passenger = new UsersPassenger();
$users_passenger->user_token = $input_data->user_token;
$users_passenger->token = $input_data->token;
$users_passenger->title = $input_data->title;
$users_passenger->name = $input_data->name;
$users_passenger->country_code = $input_data->country_code;
$users_passenger->mobile_number = $input_data->mobile_number;
$users_passenger->email_id = $input_data->email_id;
$users_passenger->date_of_birth = date('Y-m-d', strtotime($input_data->date_of_birth));

$obj = new stdClass;
if ($users_passenger->update()) {
    $users_passenger->readOne();
    $users_passenger_detail = $users_passenger->makeView()[0];
    $users_passenger_detail->age = getTimeDifference( $users_passenger_detail->date_of_birth );

    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Passenger detail updated successfully !";
    $obj->data = $users_passenger_detail;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Passenger couldn't updated at the time !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
