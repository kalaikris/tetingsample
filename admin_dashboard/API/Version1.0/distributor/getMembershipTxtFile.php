<?php
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributor.php';
$distributor = new distributor();
$fromDate = date("Y-m-d 00:00:00", strtotime($_GET["fromDate"]));
$toDate = date("Y-m-d 23:59:59", strtotime($_GET["toDate"]));
$distributorToken = $_GET["distributorToken"];
$dateQuery = "";
$dateQuery = " AND `users__booking`.`service_distributor_token` = '$distributorToken' AND `users__booking`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
$distributor->dateQuery  = $dateQuery;
$stmt  = $distributor->getLoyaltyBookingList();
$data  = $distributor->loyaltyBookingListView($stmt);
$currentDate = date('Ymd', strtotime($cur_date_time));

$file = "ACCRUAL.".$data[0]->partnerCode.".".$currentDate.".txt";
$txt = fopen($file, "w") or die("Unable to open file!");
$docData = 'H'.$currentDate.PHP_EOL;
foreach ($data as $value) {
     $docData .=  str_pad($value->membershipNumber,16," ").str_pad($value->userName,30," ").str_pad($value->userSurname,30," ").str_pad($value->dateActivity,8," ").str_pad($value->partnerCode,10," ").str_pad($value->serviceProviderName,10," ").str_pad($value->airportName,10," ").str_pad($value->bookingNumber,20," ").str_pad($value->tierPoints,10," ").str_pad($value->basePoints,10,"0",STR_PAD_LEFT).str_pad($value->bonusPoints,10,"0",STR_PAD_LEFT).PHP_EOL;
}
$num_row = $stmt->rowCount();
$docData .= 'F'.str_pad($num_row,8,"0",STR_PAD_LEFT);
fwrite($txt, $docData);
fclose($txt);

header('Content-Description: File Transfer');
header("Content-Type: text/plain; charset=utf-8");
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
unlink($file); 
?>