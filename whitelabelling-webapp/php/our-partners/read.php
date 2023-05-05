<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';

include_once '../objects/our-partners.php';
$our_partners = new OurPartners();
$our_partners->readOurPartners();

$obj = new stdClass;
if ($our_partners->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $our_partners->makeView();
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "No partners found !";
	$obj->data = new stdClass;
}
echo json_encode($obj);
?>