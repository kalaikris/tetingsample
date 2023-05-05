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
            $month_filters = [];
            
            $this_month = [makeDetailView(0, false)];
            $last_month = [makeDetailView(1, false)];
            $last_6_mon = [];
            for ($i = 1; $i <= 6; $i++) {
                $curDetail = makeDetailView($i, false);
                array_push($last_6_mon, $curDetail);
            }

            $curr_year_y = date("Y");
            $this__year = [];
            for ($i = 1; $i <= 12; $i++) {
                $curDetail = makeDetailView($i, $curr_year_y);
                array_push($this__year, $curDetail);
            }
            $last__year_y = strval(intval(date("Y")) - 1);
            $last__year = [];
            for ($i = 1; $i <= 12; $i++) {
                $curDetail = makeDetailView($i, $last__year_y);
                array_push($last__year, $curDetail);
            }

            include '../objects/users-booking.php';
            $users_booking = new UsersBooking();
            $users_booking->user_token = $user_token;
            $users_booking->agent_token = $users_data->agent_token;
            $users_booking->gmt_minutes = $gmt_minutes;
            $users_booking->month_filter = implode("|", $month_filters);

            $users_booking->readAllTimeRevenue();

            $over_all = new stdClass;
            $over_all->total_booking = 0;
            $over_all->total_service = 0;
            $over_all->total_amount = 0;
            if ($users_booking->stmt->rowCount() > 0) {
                $over_all_revenue_data = $users_booking->makeRevenueView();
                foreach ($over_all_revenue_data as $over_all_value) {
                    $over_all->total_booking += $over_all_value->total_booking;
                    $over_all->total_service += $over_all_value->total_service;
                    $over_all->total_amount += $over_all_value->total_amount;
                }
            }

            $users_booking->readRevenue();
            if ($users_booking->stmt->rowCount() > 0) {
                $revenue_data = $users_booking->makeRevenueView();

                $revenue_obj = new stdClass;
                $revenue_obj->this_month = makeRevenueView($this_month);
                $revenue_obj->last_month = makeRevenueView($last_month);
                $revenue_obj->last_6_mon = makeRevenueView($last_6_mon);
                $revenue_obj->last__year = makeRevenueView($last__year);
                
                $graph_obj = new stdClass;
                $graph_obj->this__year = $this__year;
                $graph_obj->last__year = $last__year;

                foreach ($revenue_data as $revenue_value) {
                    foreach ($revenue_obj as $revenue_detail) {
                        if (check_match($revenue_detail->month_filters, $revenue_value)) {
                            $revenue_detail->total_booking += $revenue_value->total_booking;
                            $revenue_detail->total_service += $revenue_value->total_service;
                            $revenue_detail->total_amount += $revenue_value->total_amount;
                        }
                    }
                    unset($revenue_detail);

                    foreach ($graph_obj as $graph_data) {
                        foreach ($graph_data as $graph_detail) {
                            if (check_match($graph_detail->year_month, $revenue_value)) {
                                $graph_detail->total_booking += $revenue_value->total_booking;
                                $graph_detail->total_service += $revenue_value->total_service;
                                $graph_detail->total_amount += $revenue_value->total_amount;
                            }
                        }
                    }
                    unset($graph_data);
                }
                unset($revenue_value);

                foreach ($revenue_data as $revenue_value) {
                    foreach ($revenue_obj as $revenue_detail) {
                        unset($revenue_detail->month_filters);
                    }
                    unset($revenue_detail);

                    foreach ($graph_obj as $graph_data) {
                        foreach ($graph_data as $graph_detail) {
                            unset($graph_detail->year_month);
                        }
                    }
                    unset($graph_data);
                }
                unset($revenue_value);

                $revenue_obj->over_all = $over_all;

                $data = new stdClass;
                $data->revenue_data = $revenue_obj;
                $data->graph_data = $graph_obj;

                $obj->status_code = 200;
                $obj->message = "Orders listed successfully !";
                // $obj->month_filter = $month_filter;
                $obj->data = $data;
            } else {
                $obj->status_code = 400;
                $obj->message = "No orders found !";
                $obj->data = [];
            }
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
    // print_r(json_encode($month_arr).'/n');
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