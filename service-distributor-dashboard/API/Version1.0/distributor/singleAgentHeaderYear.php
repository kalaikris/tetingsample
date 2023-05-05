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
    $dashboard->userToken  = $operations->userToken;
    $dashboard->agentToken = $inputData->agentToken;
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
    $bookedRevenue          = $dashboard->agentRevenue();
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed')";
    $realisedRevenue        = $dashboard->agentRevenue();
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Pending')";
    $unRealisedRevenue      = $dashboard->agentRevenue();
    
    $obj1=new stdClass();
    $obj1->bookedRevenue    = $bookedRevenue;
    $obj1->realisedRevenue  = $realisedRevenue;
    $obj1->unRealisedRevenue= $unRealisedRevenue;
    
    
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
    $bookingCount           = $dashboard->agentBookingCount();
    
    
    
    $newdate = date("Y-m", strtotime( $gm_date ) );
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $thisMonthBookingCount  = $dashboard->agentBookingCount();
    $thisMonthCollection    = $dashboard->agentRevenue();
    
    $newdate = date("Y-m", strtotime( "-1 months", strtotime ($gm_date) ));
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $lastMonthBookingCount  = $dashboard->agentBookingCount();
    $lastMonthCollection    = $dashboard->agentRevenue();
    
    $newdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime ($gm_date_time) ));
    $dashboard->revenueQuery  = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time`>='$newdate'";
    $lastSixMonthBookingCount = $dashboard->agentBookingCount();
    $lastSixMonthCollection   = $dashboard->agentRevenue();
    
    $newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
    $dashboard->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $lastOneYearBookingCount = $dashboard->agentBookingCount();
    $lastYearCollection      = $dashboard->agentRevenue();
    
    $newdate = date("Y", strtotime ($gm_date_time) );
    $dashboard->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $thisYearCollection      = $dashboard->agentRevenue();
    
    $obj2=new stdClass();
    $obj2->totalCount        = $bookingCount;
    $obj2->thisMonthCount    = $thisMonthBookingCount;
    $obj2->lastMonthCount    = $lastMonthBookingCount;
    $obj2->lastSixMonthCount = $lastSixMonthBookingCount;
    $obj2->lastOneYearCount  = $lastOneYearBookingCount;

    $obj3=new stdClass();
    $comissionDetails        = $dashboard->getComissionDetails();
    if($comissionDetails->commisionType==1 && $comissionDetails->yearlyTarget>0){
        $monthTarget             = round($comissionDetails->yearlyTarget/12);
        $sixMonthTarget          = round($comissionDetails->yearlyTarget/6);
        $yearlyTarget            = $comissionDetails->yearlyTarget;
        $obj3->commisionType = "Comission";
        $obj3->thisYearTarget    = "$thisYearCollection / $yearlyTarget";
        $obj3->thisMonthTarget   = "$thisMonthCollection / $monthTarget";
        $obj3->lastMonthTarget   = "$lastMonthCollection / $monthTarget";
        $obj3->lastSixMonthTarget= "$lastSixMonthCollection / $sixMonthTarget";
        $obj3->lastYearTarget    = "$lastYearCollection / $yearlyTarget";
    }else{
        $obj3->commisionType = "Incentive";
        $obj3->thisYearTarget    = $thisYearCollection;
        $obj3->thisMonthTarget   = $thisMonthCollection;
        $obj3->lastMonthTarget   = $lastMonthCollection;
        $obj3->lastSixMonthTarget= $lastSixMonthCollection;
        $obj3->lastYearTarget    = $lastYearCollection;
    }           

    
    $obj->status_code = 201;
    $obj->revenue     = $obj1;
    $obj->booking     = $obj2;
    $obj->yearlyTarget= $obj3;
    
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>