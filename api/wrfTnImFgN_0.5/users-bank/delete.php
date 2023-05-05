<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users-bank.php';
$users_bank = new UsersBank();
$users_bank->user_token = $input_data->user_token;
$users_bank->token = $input_data->token;

$obj = new stdClass;
if ($users_bank->delete()) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Bank deleted successfully !";
    $obj->data = new stdClass;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Bank delete error ! Please try again after sometimes !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
