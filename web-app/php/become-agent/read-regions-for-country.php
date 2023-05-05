<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include_once '../objects/regions.php';
$regions = new Regions();
$regions->country_id = $input_data->country_id;
$regions->readForCountry();

$obj = new stdClass;
if ($regions->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $regions->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No regions found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>