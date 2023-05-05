<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../config/core.php';

include_once '../objects/airport-ttr.php';
$airport_ttr = new AirportTTR();
$airport_ttr->readAllTerminals();

$obj = new stdClass;
if ($airport_ttr->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $airport_ttr->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No terminals found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>