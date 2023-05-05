<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $input_data = getInputs();

    include '../objects/users-gst.php';
    $users_gst = new UsersGst();
    $users_gst->user_token = $_SESSION[$cookie_name];
    $users_gst->token = $input_data->token;

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
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
