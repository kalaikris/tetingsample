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
    include '../objects/users-gst.php';
    $users_gst = new UsersGst();
    $users_gst->user_token = $_SESSION[$cookie_name];
    $users_gst->read();

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
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
