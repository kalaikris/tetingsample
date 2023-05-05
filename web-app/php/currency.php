<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../config/core.php';
$input_data = getInputs();
$currency_from = $input_data->currency_from;
$currency_to = $input_data->currency_to;

include '../../config/currency.php';
$currency_output = currency($currency_from, $currency_to);
echo ($currency_output);
?>