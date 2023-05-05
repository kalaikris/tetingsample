<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);
session_start();

include '../../../config/core.php';
$cookie_name = "airportzo-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    include '../objects/users.php';
    $users = new Users();
    $users->token = $_SESSION[$cookie_name];
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $input_data = getInputs();

        $users->title = $input_data->title;
        $users->name = $input_data->name;
        $users->image = $input_data->image;
        $users->country_code = $input_data->country_code;
        $users->mobile_number = $input_data->mobile_number;
        $users->email = $input_data->email;

        if ($users->update()) {
            $users->getUserDetail();

            $obj->status_code = 200;
            $obj->message = "User detail updated successfully !";
            $obj->data = $users->makeView()[0];
        } else {
            $obj->status_code = 400;
            $obj->message = "User update error !";
            $obj->data = new stdClass;
        }
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