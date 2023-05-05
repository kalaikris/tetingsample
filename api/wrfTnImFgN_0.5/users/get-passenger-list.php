<?php
include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users-passenger.php';
$users_passenger = new UsersPassenger();
$users_passenger->token = $input_data->user_token;
$users_passenger->getPassengerList();

$obj = new stdClass;
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
echo json_encode($obj);
?>