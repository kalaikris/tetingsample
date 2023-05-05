<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users-gst.php';
$users_gst = new UsersGst();
$users_gst->user_token = $input_data->user_token;
$users_gst->token = $input_data->token;

$obj = new stdClass;
if ($users_gst->delete()) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "GST deleted successfully !";
    $obj->data = new stdClass;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "GST delete error ! Please try again after sometimes !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
