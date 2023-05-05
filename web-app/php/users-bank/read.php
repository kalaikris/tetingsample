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
        $users_bank->read();

        $obj = new stdClass;
        if ($users_bank->stmt->rowCount() > 0) {
            $users_bank_list = $users_bank->makeView();

            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Success";
            $obj->data = $users_bank_list;
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "No bank found !";
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
