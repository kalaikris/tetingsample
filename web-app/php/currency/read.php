<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);
include '../../../config/core.php';

include_once '../objects/currency.php';
$currency = new Currency();
$currency->read();

$obj = new stdClass;
if($currency->stmt->rowCount() > 0){
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $currency->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Currency Currently Not Available !..";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>