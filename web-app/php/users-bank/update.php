<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$cookie_name = "airportzo-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $input_data = getInputs();

        include '../objects/users-bank.php';
        $users_bank = new UsersBank();
        $users_bank->user_token = $user_token;
        $users_bank->token = $input_data->token;
        $users_bank->account_number = $input_data->account_number;
        $users_bank->ifsc_code = $input_data->ifsc_code;
        $users_bank->branch_name = $input_data->branch_name;
        $users_bank->is_primary = $input_data->is_primary? 1: 0;

        $obj = new stdClass;
        if ($users_bank->update()) {
            $users_bank->readOne();
            $users_bank_detail = $users_bank->makeView()[0];

            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Bank detail updated successfully !";
            $obj->data = $users_bank_detail;
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Bank couldn't updated at the time !";
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
