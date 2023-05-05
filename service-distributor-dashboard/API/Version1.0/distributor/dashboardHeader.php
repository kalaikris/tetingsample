<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/distributorOperations.php';
$operations = new operations();
$operations->distributorToken = $inputData->distributorToken;
$operations->userToken = $inputData->userToken;
$stmt = $operations->distributorDetailsCheck();
if($stmt->rowCount()==1){
    
    include_once '../objects/dashboard.php';
    $dashboard = new dashboard();
    $dashboard->userToken= $operations->userToken;
    
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
    $dashboard->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time`>='$newdate'";
    
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
    
    $obj3=new stdClass();
    $obj3->totalBalance       = 0;
    $obj3->thisMonthBalance   = 0;
    $obj3->lastMonthBalance   = 0;
    $obj3->lastSixMonthBalance= 0;
    $obj3->lastOneYearBalance = 0;
    
    
    $creditDetails             = $dashboard->distributorCreditView();
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