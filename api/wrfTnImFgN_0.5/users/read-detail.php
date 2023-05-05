<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users.php';
$users = new Users();
$users->token = $input_data->user_token;
$users->getUserDetail();

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
    $user_detail = $users->makeView()[0];

    if ($user_detail->status == 'Active') {
        $obj->status_code = 200;
        $obj->message = "User detail found !";
        $obj->data = $user_detail;
    } else {
        $obj->status_code = 400;
        $obj->message = "User blocked ! Please contact support !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>