<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$country_code = $input_data->country_code;
$mobile_number = $input_data->mobile_number;
$otp = $input_data->otp;
$login_device = $input_data->login_device;

include_once '../../../config/msg91.php';
$msg91 = new Msg91();
$msg91->country = $country_code;
$msg91->otp = $otp;
$msg91->mobile = $mobile_number;
$msg91_res = $msg91->verifyOtp();

$obj = new stdClass;
if($msg91_res === true) {
    include_once '../objects/users.php';
    $users = new Users();
    $users->country_code = $country_code;
    $users->mobile_number = $mobile_number;
    $users->login_device = $login_device;
    $users->getUser();
    if ($users->stmt->rowCount() > 0) {
        include_once '../objects/users-otp.php';
        $users_otp = new UsersOtp();
        $users_otp->mobile_number = $mobile_number;
        $users_otp->otp_count = 0;
        $users_otp->otp_date_time = date('Y-m-d H:i:s');
        $users_otp->updateOTPCount();
        
        $user_data = $users->makeView()[0];

        if ($user_data->status == 'Active') {
            $obj->status_code = 200;
            $obj->message = "OTP verified successfully!";
            $obj->data = $user_data;
        } else {
            $obj->status_code = 400;
            $obj->message = "User blocked ! Please contact support !";
            $obj->data = new stdClass;
        }
        // $obj->status_code = 200;
        // $obj->title = "Success";
        // $obj->message = "OTP verified successfully!";
        // $obj->data = $user_data;
    } else {
        $token = genToken('users');
        $users->token = $token;
        
        if ($users->create()) {
            $users->getUser();
            $user_data = $users->makeView()[0];

            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "OTP verified successfully!";
            $obj->data = $user_data;
        } else {
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "User signup error !";
            $obj->data = new stdClass;
        }
    }
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = $msg91_res;
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>