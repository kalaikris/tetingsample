<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/myStaffs.php';
$MyStaffs = new MyStaffs();
$MyStaffs->staffToken = $inputData->staffToken;

$obj->status_code = 201;
$stmt = $MyStaffs->bookings();
$MyStaffs->bookingCount = $stmt->rowCount();
$obj->bookings    = $MyStaffs->bookingView($stmt);
$obj->staffDetails= $MyStaffs->staffDetails();
echo json_encode($obj);
?>