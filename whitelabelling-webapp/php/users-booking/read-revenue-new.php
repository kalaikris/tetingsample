<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
$site_name = get_service_distributor();
$cookie_name = $site_name . "-usr-token";

$gmt_minutes = +330;

$obj = new stdClass;
if (isset($_SESSION[$cookie_name])) {
    $user_token = $_SESSION[$cookie_name];

    include '../objects/users.php';
    $users = new Users();
    $users->token = $user_token;
    $users->getUserDetail();

    if ($users->stmt->rowCount() > 0) {
        $users_data = $users->makeView()[0];

        if ($users_data->is_agent == true && $users_data->is_approved == 'Approved') {
            include '../objects/users-booking.php';
            $users_booking = new UsersBooking();

            $users_booking->user_token = $user_token;
            $users_booking->agent_token = $users_data->agent_token;

            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
            $bookedRevenue          = $users_booking->agentRevenue();
            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Completed')";
            $realisedRevenue        = $users_booking->agentRevenue();
            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Pending')";
            $unRealisedRevenue      = $users_booking->agentRevenue();
            
            $obj1=new stdClass();
            $obj1->bookedRevenue    = $bookedRevenue;
            $obj1->realisedRevenue  = $realisedRevenue;
            $obj1->unRealisedRevenue= $unRealisedRevenue;
            
            
            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' )";
            $bookingCount           = $users_booking->agentBookingCount();

            $newdate = date("Y-m", strtotime( $gm_date ) );
            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
            $thisMonthBookingCount  = $users_booking->agentBookingCount();
            
            $newdate = date("Y-m", strtotime( "-1 months", strtotime ($gm_date) ));
            $users_booking->revenueQuery= " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
            $lastMonthBookingCount  = $users_booking->agentBookingCount();
            
            $newdate = date("Y-m-d 00:00:00", strtotime( "-6 months", strtotime ($gm_date_time) ));
            $users_booking->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time`>='$newdate'";
            $lastSixMonthBookingCount = $users_booking->agentBookingCount();
            
            $newdate = date("Y", strtotime( "-12 months", strtotime ($gm_date_time) ));
            $users_booking->revenueQuery    = " AND (`users__booking_detail`.`status`='Completed' || `users__booking_detail`.`status`='Pending' ) AND `users__booking_detail`.`date_time` LIKE '$newdate%'";
            $lastOneYearBookingCount = $users_booking->agentBookingCount();
            
            
            $obj2=new stdClass();
            $obj2->totalCount        = $bookingCount;
            $obj2->thisMonthCount    = $thisMonthBookingCount;
            $obj2->lastMonthCount    = $lastMonthBookingCount;
            $obj2->lastSixMonthCount = $lastSixMonthBookingCount;
            $obj2->lastOneYearCount  = $lastOneYearBookingCount;

                $obj->status_code = 200;
                $obj->message = "Orders listed successfully !";
                $obj->revenue     = $obj1;
                $obj->booking     = $obj2;
            // } else {
            //     $obj->status_code = 400;
            //     $obj->message = "No orders found !";
            //     $obj->data = [];
            // }
        } else {
            $obj->status_code = 400;
            $obj->message = "User not an agent !";
            $obj->data = new stdClass;
        }
    } else {
        $obj->status_code = 400;
        $obj->message = "User detail error !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "No login found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);

function makeRevenueView($month_arr) {
    $month_filters = [];
    print_r(json_encode($month_arr).'/n');
    foreach ($month_arr as $month_value) {
        $year_month = $month_value->year_month[0];
        array_push($month_filters, $year_month);
    }
    unset($month_value);

    $revenue_obj = new stdClass;
    $revenue_obj->total_booking = 0;
    $revenue_obj->total_service = 0;
    $revenue_obj->total_amount = 0;
    $revenue_obj->month_filters = $month_filters;

    return $revenue_obj;
}

function makeDetailView($i, $has_yr) {
    $detail_view = new stdClass;
    if ($has_yr) {
        $detail_view->year__view = date('Y', strtotime("$has_yr-$i"));
        $detail_view->month_view = date('M', strtotime("$has_yr-$i"));
        $detail_view->year_month = [date('Y-m', strtotime("$has_yr-$i"))];
    } else {
        $detail_view->year__view = date('Y', strtotime("-$i month"));
        $detail_view->month_view = date('M', strtotime("-$i month"));
        $detail_view->year_month = [date('Y-m', strtotime("-$i month"))];
    }
    $detail_view->total_booking = 0;
    $detail_view->total_service = 0;
    $detail_view->total_amount = 0;

    if (!in_array($detail_view->year_month[0], $GLOBALS['month_filters'])) {
        array_push($GLOBALS['month_filters'], $detail_view->year_month[0]);
    }

    return $detail_view;
}

function check_match($month_arr, $revenue_value) {
    $has_match = false;
    foreach ($month_arr as $month_val) {
        if (str_contains($revenue_value->revenue_month, $month_val)) { 
        // if (strpos($revenue_value->revenue_month, $month_val)) { 
            $has_match = true;
        }
    }
    return $has_match;
}
?>