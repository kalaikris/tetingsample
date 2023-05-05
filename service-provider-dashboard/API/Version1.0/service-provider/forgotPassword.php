<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$service_provider = new ServiceProvider();
include '../../../../config/mailer.php';
$mailerObj = new stdClass;
include '../../../../config/mailer-template.php';
$mail_order = new MailTemplateOrder;
$service_provider->businessId  = $inputData->businessId;
$stmt = $service_provider->userBusinessIdCheck();
if($stmt->rowCount()==1){
    $done_email = [];
    $provider_data = $service_provider->viewUserBusinessIdCheck($stmt);
    $otp = rand(1000,9999);
    $mail_order->otp = $otp;
    $mail_order->name = ucwords($provider_data->name);
    $service_provider->otp = $otp;
    $service_provider->updateOtp();
    $mailerObj->email_id = $provider_data->email_id;
    $mailerObj->user_name = ucwords($provider_data->name);
    $mailerObj->subject = 'Airportzo - Forgot Password OTP Generate';
    $mailerObj->e_ticket = '';
    $mailerObj->mail_template = $mail_order->sendOtp();
    $mailerResponse = sendMail($mailerObj);
    if ($mailerResponse) {
        array_push($done_email, "admin");
    } else {
        $mailer_err = $mailerResponse;
    }
    
    $obj->status_code = 201;
    $obj->title       = "Success";
    $obj->message     = "Otp send to mail successfully";
}else{    
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "User Not Registered";
}
echo json_encode($obj);
?>