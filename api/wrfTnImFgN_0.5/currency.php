<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../config/core.php';
include '../../config/currency.php';

$input_data = getInputs();
$currency_from = $input_data->currency_from;
$currency_to = $input_data->currency_to;

$currency_output = currency($currency_from, $currency_to);

$obj = new stdClass;
if ($currency_output > 0) {
    $obj->status_code = 200;
    $obj->message = "Currency convertor extracted successfully !";
    $obj->data = $currency_output;
} else {
    $obj->status_code = 400;
    $obj->message = "Currency conversion error !";
    $obj->data = $currency_output;
}
echo json_encode($obj);
?>