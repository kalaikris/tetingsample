<?php
session_start();
include '../../../config/core.php';
$input_data = getInputs();
$booking_detail = json_encode($input_data->booking_detail);
$_SESSION['order_detail'] = $booking_detail;
echo $booking_detail;
?>