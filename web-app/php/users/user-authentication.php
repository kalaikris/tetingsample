<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
include_once '../../../config/otp-backend.php';
$obj = new stdClass;
$input_data = getInputs();
$country_code = $input_data->country_code;
$mobile_number = $input_data->mobile_number;
$bb_mobile = '7708379835'; 
include_once '../../../config/msg91.php';
$msg91 = new Msg91();
$msg91->otp = rand(100000, 999999);
$msg91->country_code = $country_code;
$msg91->mobile = $mobile_number;

include_once '../objects/users-otp.php';
$users_otp = new UsersOtp();
$users_otp->mobile_number = $mobile_number;

// if($bb_mobile != $mobile_number){
    $users_otp->getUser();

    $can_send = false;
    $is_new = false;
    $time_diff = '';
    $otp_count = 0;
    if ($users_otp->stmt->rowCount() == 0) {
        $can_send = true;
        $is_new = true;
    } else {
        $users_otp_data = $users_otp->makeView()[0];
        $otp_count = $users_otp_data->otp_count;
        if ($otp_count < 5) {
            $can_send = true;
        } else {
            $cur_date_time = $GLOBALS['cur_date_time'];
            $date1 = new DateTime($users_otp_data->otp_date_time);
            $date2 = $date1->diff(new DateTime($cur_date_time));
            if ($date2->y) {
                $can_send = true;
            } else if ($date2->m) {
                $can_send = true;
            } else if ($date2->d) {
                $can_send = true;
            } else if ($date2->H) {
                $can_send = true;
            } else if ($date2->i) {
                $can_send = ($date2->i > 30)? true: false;
                $time_diff = ($date2->i > 1) ? (30 - $date2->i) . " mins" : (30 - $date2->i) . " min";
            } else if ($date2->s) {
                $can_send = false;
                $time_diff = ($date2->s > 1) ? "29 mins " . (60 - $date2->s) . " secs" : "29 mins " . (60 - $date2->s) . " sec";
            }
        }
    }

    if ($can_send) {
        if($msg91->sendOtp()) {
            $otp_count++;

            $users_otp->otp_count = $otp_count;
            $users_otp->otp_date_time = date('Y-m-d H:i:s');
            if ($is_new) {
                $users_otp->create();
            } else {
                $users_otp->updateOTPCount();
            }

            $data = new stdClass;
            $data->remaining_otp = 5 - $otp_count;
            //$data->otp_number = $msg91->otp;
            if($bb_mobile==$mobile_number){
                ob_start();
                sendBB_Mail($msg91->otp);
                ob_clean();
            }
            $obj->status_code = 200;
            
            $obj->title = "Success";
            $obj->message = "OTP send your mobile number successfully!";
            $obj->data = $data;
            
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Try again later";
            $obj->data = new stdClass;
        }
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Please try again after " . $time_diff;
        $obj->data = new stdClass;
    }
// } else {
//     $obj->status_code = 201;
//     $obj->title = "Success";
//     $obj->message = "Logged for Backend Booking!..";
// }
echo json_encode($obj);
?>