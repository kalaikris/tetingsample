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
    
    
    $newdate = date("Y-m", strtotime( $gm_date ) );
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $bookedRevenue          = $dashboard->agentRevenue();
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed') AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $realisedRevenue        = $dashboard->agentRevenue();
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Pending') AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $unRealisedRevenue      = $dashboard->agentRevenue();
    
    $obj1=new stdClass();
    $obj1->bookedRevenue    = $bookedRevenue;
    $obj1->realisedRevenue  = $realisedRevenue;
    $obj1->unRealisedRevenue= $unRealisedRevenue;
    
    
  
    $newdate = date("Y-m", strtotime( $gm_date ) );
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $thisMonthCollection    = $dashboard->agentRevenue();
    
    $newdate = date("Y-m-d", strtotime( $gm_date ) );
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $todayCollection        = $dashboard->agentRevenue();
    
    $newdate = date("Y-m-d", strtotime( "-1 day", strtotime ($gm_date) ));
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $yesterDayCollection    = $dashboard->agentRevenue();
    
    $newdate = date("Y-m-d", strtotime( "-2 day", strtotime ($gm_date) ));
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $twoDayBackCollection    = $dashboard->agentRevenue();
    
    $newdate = date("Y-m-d", strtotime( "-7 day", strtotime ($gm_date) ));
    $dashboard->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
    $oneWeekBackCollection    = $dashboard->agentRevenue();
    

    $comissionDetails        = $dashboard->getComissionDetails();
    
    
    $obj2=new stdClass();
    if($comissionDetails->commisionType==1 && $comissionDetails->yearlyTarget>0){
        $obj2->commisionType = "Comission";
        $monthTarget         = round($comissionDetails->yearlyTarget/12);
        $obj2->thisMonthCollection= "$thisMonthCollection/$monthTarget";
    }else{
        $obj2->commisionType    = "Incentive";
        $obj2->thisMonthCollection= $thisMonthCollection;
    }   
    $obj2->todayCollection       = $todayCollection;
    $obj2->yesterDayCollection   = $yesterDayCollection;
    $obj2->twoDayBackCollection  = $twoDayBackCollection;
    $obj2->oneWeekBackCollection = $oneWeekBackCollection;
    
    $obj->status_code  = 201;
    $obj->revenue      = $obj1;
    $obj->monthlyTarget= $obj2;
    
}else{
    $obj->code      =503;
    $obj->status_code=503;
    $obj->title  = "Oops";
    $obj->message= "Not found";
}
echo json_encode($obj);
?>