<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include_once '../objects/cities.php';
$cities = new Cities();
$cities->country_id = $input_data->country_id;
$cities->region_id = $input_data->region_id;
$cities->readForRegionAndCountry();

$obj = new stdClass;
if ($cities->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $cities->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No cities found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>