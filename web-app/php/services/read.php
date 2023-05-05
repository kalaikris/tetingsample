<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include_once '../objects/services.php';
$services = new Services();
$services->currency_code = $input_data->currency;
$services->read();

$obj = new stdClass;
if ($services->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $services->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No services found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>