<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';

include_once '../objects/countries.php';
$countries = new Countries();
$countries->read();

$obj = new stdClass;
if ($countries->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $countries->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No countries found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>