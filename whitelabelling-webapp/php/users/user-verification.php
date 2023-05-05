<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
session_set_cookie_params(60 * 60 * 24 * 30);
session_start();

include '../../../config/core.php';
$site_name = get_service_distributor();

include_once '../objects/service-distributor.php';
$service__distributor = new ServiceDistributor();
$service__distributor->site_name = $site_name;
$service__distributor->readDistributorDynamicDataBySitename();

$obj = new stdClass;
if ($service__distributor->stmt->rowCount() > 0) {
    $service__distributor_data = $service__distributor->makeView()[0];

    $input_data = getInputs();
    $login_device = property_exists($input_data, "login_device")? $input_data->login_device: "Web";
    $country_code = $input_data->country_code;
    $mobile_number = $input_data->mobile_number;
    $otp = $input_data->otp;

    include_once '../../../config/msg91.php';
    $msg91 = new Msg91();
    $msg91->country = $country_code;
    $msg91->otp = $otp;
    $msg91->mobile = $mobile_number;
    $msg91_res = $msg91->verifyOtp();

    if($msg91_res === true) {
        include_once '../objects/users.php';
        $users = new Users();
        $users->is_airportzo_user = 0;
        $users->distributor_token = $service__distributor_data->token;
        $users->country_code = $country_code;
        $users->mobile_number = $mobile_number;
        $users->login_device = $login_device;
        $users->getUser();
        if ($users->stmt->rowCount() > 0) {
            include_once '../objects/users-otp.php';
            $users_otp = new UsersOtp();
            $users_otp->distributor_token = $service__distributor_data->token;
            $users_otp->mobile_number = $mobile_number;
            $users_otp->otp_count = 0;
            $users_otp->otp_date_time = date('Y-m-d H:i:s');
            $users_otp->updateOTPCount();

            $user_data = $users->makeView()[0];

            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "OTP verified successfully!";
            $obj->data = $user_data;
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
    if ($obj->status_code == 200) {
        $cookie_name = $site_name . "-usr-token";
        $cookie_value = $obj->data->token;
        $_SESSION[$cookie_name] = $cookie_value;
    }
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "Distributor error !";
	$obj->data = new stdClass;
}

echo json_encode($obj);