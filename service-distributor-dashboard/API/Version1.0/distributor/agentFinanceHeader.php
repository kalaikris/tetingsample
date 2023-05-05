<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';

include_once '../objects/booking.php';
$booking = new booking();
$booking->userToken   = $inputData->userToken;
$fromDate  = date("Y-m-d 00:00:00", strtotime($inputData->fromDate) );
$toDate    = date("Y-m-d 23:59:59", strtotime($inputData->toDate) );
include_once '../objects/finance.php';
$finance = new Finance();
$finance->userToken= $booking->userToken;
$obj->status_code = 201;

$finance->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending') AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
$bookedRevenue            = $finance->agentRevenue();
$obj->bookedRevenue       = $bookedRevenue;
$finance->revenueQuery    = " AND `users__booking_detail`.`status`='Completed' AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
$obj->realizedRevenue     = $finance->agentRevenue();
$finance->revenueQuery    = " AND `users__booking_detail`.`status`='Pending' AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
$obj->unRealizedRevenue   = $finance->agentRevenue();
$obj->totalEarnings       = $bookedRevenue;

$newdate = date("Y-m", strtotime( $toDate ) );
$finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending') AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
$obj->thisMonthEarning    = $finance->agentRevenue();

//$newdate = date("Y-m", strtotime( "-1 months", strtotime ($toDate) ));
$newdate = date("Y-m-d", strtotime( $toDate ) );
$date = date_create($newdate);
$year = $date->format("Y");
$month = $date->format("m");
$d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
$pre_date = date_create("$year-$month-$d");
date_sub($pre_date,date_interval_create_from_date_string($d." days"));
$previous_month = date_format($pre_date,"Y-m");
$last_month = date_format($pre_date,"Y-m-d 23:59:59");
$finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$previous_month%'";
$obj->lastMonthEarning    = $finance->agentRevenue();

$startdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime (date("Y-m", strtotime($inputData->toDate)))));
$finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` BETWEEN '$startdate' AND '$last_month'";
$obj->lastSixMonthEarning = $finance->agentRevenue();

//$newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
$year = date("Y");
$previousyear = $year -1;
$finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$previousyear%'";
$obj->lastYearEarning     = $finance->agentRevenue();

$creditDetails            = $finance->distributorCreditView();
$obj->creditAvailable     = $creditDetails->creditAvailable;
$obj->totalCreditGiven    = $creditDetails->totalCredits;
$obj->balanceFromAirportzo= $creditDetails->usedCredits;
$obj->is_credit = $creditDetails->is_credit;

echo json_encode($obj);
?>