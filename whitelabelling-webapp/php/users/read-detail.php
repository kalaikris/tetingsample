<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);
session_start();

include '../../../config/core.php';
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    include '../objects/users.php';
    $users = new Users();
    $users->token = $_SESSION[$cookie_name];
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $obj->status_code = 200;
        $obj->message = "User detail found !";
        $obj->data = $users->makeView()[0];
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