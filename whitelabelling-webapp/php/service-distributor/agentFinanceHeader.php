<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$obj=new stdClass();
include_once '../../../config/core.php';
$inputData = getInputs();
include_once '../../../config/database.php';

$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";
$gmt_minutes = +330;

if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        include_once '../objects/finance.php';
        $finance = new Finance();
        $finance->userToken= $user_token;

        $finance->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
        $bookedRevenue            = $finance->agentRevenue();
        $obj->bookedRevenue       = $bookedRevenue;
        $finance->revenueQuery    = " AND `users__booking_detail`.`status`='Completed'";
        $obj->realizedRevenue     = $finance->agentRevenue();
        $finance->revenueQuery    = " AND `users__booking_detail`.`status`='Pending'";
        $obj->unRealizedRevenue   = $finance->agentRevenue();
        $obj->totalEarnings       = $bookedRevenue;

        $newdate = date("Y-m", strtotime( $gm_date ) );
        $finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
        $obj->thisMonthEarning    = $finance->agentRevenue();

        $newdate = date("Y-m", strtotime( "-1 months", strtotime ($gm_date) ));
        $finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
        $obj->lastMonthEarning    = $finance->agentRevenue();

        $newdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime ($gm_date_time) ));
        $finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` BETWEEN '$newdate' AND '$gm_date_time'";
        $obj->lastSixMonthEarning = $finance->agentRevenue();

        $newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
        $finance->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
        $obj->lastYearEarning     = $finance->agentRevenue();

        $creditDetails            = $finance->distributorCreditView_New();
        $obj->creditAvailable     = $creditDetails->creditAvailable;
        $obj->totalCreditGiven    = $creditDetails->totalCredits;
        $obj->balanceFromAirportzo = $creditDetails->usedCredits;
        $obj->service__distributor_name = $creditDetails->service__distributor_name;
        $obj->is_credit = $creditDetails->is_credit;
    }else{
        $obj->status_code= 503;
        $obj->message    = "Errors";
    }
}else{
$obj->status_code = 400;
$obj->message = "No login found !";
$obj->data = new stdClass;
}
echo json_encode($obj);
?>