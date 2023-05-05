<?php

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users.php';
$users = new Users();
$users->token = $input_data->user_token;
$users->getUserDetail();

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->message = "User detail found !";
    $obj->data = $users->makeView()[0];
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>