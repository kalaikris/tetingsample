<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';

include_once '../objects/contact-info.php';
$contact_info = new ContactInfo();
$contact_info->readContactInfo();

$obj = new stdClass;
if ($contact_info->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $contact_info->makeView();
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "No contact found !";
	$obj->data = new stdClass;
}
echo json_encode($obj);
?>