<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users-gst.php';
$users_gst = new UsersGst();
$users_gst->user_token = $input_data->user_token;
$users_gst->read();

$obj = new stdClass;
if ($users_gst->stmt->rowCount() > 0) {
    $users_gst_list = $users_gst->makeView();

    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $users_gst_list;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No gst found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
