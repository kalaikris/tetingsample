<?php
include '../../../config/core.php';

include_once '../objects/avail-service.php';
$avail_service = new AvailService();
$avail_service->read();

include_once '../objects/our-partners.php';
$our_partners = new OurPartners();
$our_partners->readOurPartners();

$obj = new stdClass;
if ($avail_service->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->avail_service = $avail_service->makeView();
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "No partners found !";
	$obj->avail_service = new stdClass;
}

if ($our_partners->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->our_partners = $our_partners->makeView();
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "No partners found !";
	$obj->our_partners = new stdClass;
}
echo json_encode($obj);
?>