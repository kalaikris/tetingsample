<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';

include_once '../objects/avail-service.php';
$avail_service = new AvailService();
$avail_service->read();

$obj = new stdClass;
if ($avail_service->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $avail_service->makeView();
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "No partners found !";
	$obj->data = new stdClass;
}
echo json_encode($obj);
?>