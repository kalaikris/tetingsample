<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/location.php';
$location = new location();
$obj->status_code = 201;
$obj->countries   = $location->countries();
echo json_encode($obj);
?>