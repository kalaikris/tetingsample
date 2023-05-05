<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributor.php';
$distributor = new distributor();
$distributor->distributorToken = $inputData->distributorToken;
$stmt = $distributor->singleDistributorDetail();
if($stmt->rowCount()==1){
    
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
    $bookedRevenue          = $distributor->revenue();
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Completed')";
    $realisedRevenue        = $distributor->revenue();
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Pending')";
    $unRealisedRevenue      = $distributor->revenue();
    
    $obj1=new stdClass();
    $obj1->bookedRevenue    = $bookedRevenue;
    $obj1->realisedRevenue  = $realisedRevenue;
    $obj1->unRealisedRevenue= $unRealisedRevenue;
    
    
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
    $bookingCount           = $distributor->bookingCount();

    $newdate = date("Y-m", strtotime( $gm_date ) );
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $thisMonthBookingCount  = $distributor->bookingCount();
    
    $newdate = date("Y-m", strtotime( "-1 months", strtotime ($gm_date) ));
    $distributor->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $lastMonthBookingCount  = $distributor->bookingCount();
    
    $newdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime ($gm_date_time) ));
    $distributor->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time`>='$newdate'";
    $lastSixMonthBookingCount = $distributor->bookingCount();
    
    $newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
    $distributor->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $lastOneYearBookingCount = $distributor->bookingCount();
    
    
    $obj2=new stdClass();
    $obj2->totalCount        = $bookingCount;
    $obj2->thisMonthCount    = $thisMonthBookingCount;
    $obj2->lastMonthCount    = $lastMonthBookingCount;
    $obj2->lastSixMonthCount = $lastSixMonthBookingCount;
    $obj2->lastOneYearCount  = $lastOneYearBookingCount;
    
    $obj3=new stdClass();
    $obj3->fromAirportzo     = 0;
    $obj3->toAgents          = 0;
    
    $creditDetails             = $distributor->distributorCreditViewAdmin();
    $obj3->creditAvailable     = $creditDetails->creditAvailable;
    $obj3->totalCreditGiven    = $creditDetails->totalCredits;
    $obj3->balanceFromAirportzo= $creditDetails->usedCredits;
    
    $obj->status_code = 201;
    $obj->revenue     = $obj1;
    $obj->booking     = $obj2;
    $obj->airportzo   = $obj3;
    
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>