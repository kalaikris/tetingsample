<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
    
include_once '../objects/dashboard.php';
$dashboard = new dashboard();
$dashboard->serviceProviderLocationtoken= $inputData->serviceProviderLocationtoken;

$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
$bookedRevenue          = $dashboard->revenue();
$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed')";
$realisedRevenue        = $dashboard->revenue();
$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Pending')";
$unRealisedRevenue      = $dashboard->revenue();
$obj1=new stdClass();
$obj1->bookedRevenue    = $bookedRevenue;
$obj1->realisedRevenue  = $realisedRevenue;
$obj1->unRealisedRevenue= $unRealisedRevenue;



$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
$bookingCount           = $dashboard->bookingCount();

$newdate = date("Y-m", strtotime( $gm_date ) );
$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
$thisMonthBookingCount  = $dashboard->bookingCount();

$newdate = date("Y-m", strtotime( "-1 months", strtotime ($gm_date) ));
$dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
$lastMonthBookingCount  = $dashboard->bookingCount();

$newdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime ($gm_date_time) ));
$dashboard->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` BETWEEN '$newdate' AND '$gm_date_time'";
$lastSixMonthBookingCount = $dashboard->bookingCount();

$newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
$dashboard->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";

$lastOneYearBookingCount = $dashboard->bookingCount();
$obj2=new stdClass();
$obj2->totalCount        = $bookingCount;
$obj2->thisMonthCount    = $thisMonthBookingCount;
$obj2->lastMonthCount    = $lastMonthBookingCount;
$obj2->lastSixMonthCount = $lastSixMonthBookingCount;
$obj2->lastOneYearCount  = $lastOneYearBookingCount;



$totalRatingDetails      = $dashboard->ratingDetails();
$fiveStarPercentage      = $dashboard->starPercentage(5,$totalRatingDetails->ratedUsers);
$fourStarPercentage      = $dashboard->starPercentage(4,$totalRatingDetails->ratedUsers);
$threeStarPercentage     = $dashboard->starPercentage(3,$totalRatingDetails->ratedUsers);
$twoStarPercentage       = $dashboard->starPercentage(2,$totalRatingDetails->ratedUsers);
$oneStarPercentage       = $dashboard->starPercentage(1,$totalRatingDetails->ratedUsers);

$obj3=new stdClass();
$obj3->totalRatedUser    = $totalRatingDetails->ratedUsers;
$obj3->averageRating     = $totalRatingDetails->averageRating;
$obj3->fiveStarPercentage= $fiveStarPercentage;
$obj3->fourStarPercentage= $fourStarPercentage;
$obj3->threeStarPercentage= $threeStarPercentage;
$obj3->twoStarPercentage = $twoStarPercentage;
$obj3->oneStarPercentage = $oneStarPercentage;


$obj->status_code = 201;
$obj->revenue     = $obj1;
$obj->booking     = $obj2;
$obj->rating      = $obj3;

echo json_encode($obj);
?>