<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$cookie_name = "airportzo-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $input_data = getInputs();

    include '../objects/users-gst.php';
    $users_gst = new UsersGst();
    $users_gst->user_token = $_SESSION[$cookie_name];
    $users_gst->token = genToken('users__gstin');
    $users_gst->name = $input_data->name;
    $users_gst->gstin = $input_data->gstin;

    if ($users_gst->create()) {
        $users_gst->readOne();
        $users_gst_detail = $users_gst->makeView()[0];

        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "GST detail added successfully !";
        $obj->data = $users_gst_detail;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "GST couldn't added at the time !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found ! Please login again !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
