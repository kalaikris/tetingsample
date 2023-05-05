<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
    
include_once '../objects/dashboard.php';
$dashboard = new dashboard();
$dashboard->serviceProviderLocationtoken= $inputData->serviceProviderLocationtoken;
$stmt    = $dashboard->recentBooking();
$obj->status_code = 201;
$obj->bookings    = $dashboard->recentBookingView($stmt);

echo json_encode($obj);
?>