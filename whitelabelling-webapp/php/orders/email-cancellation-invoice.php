<?php
include '../../../config/core.php';

$input_data = getInputs();
$booking_detail = $input_data->booking_detail;

$obj = new stdClass;
if ($booking_detail->user_email != '' || $booking_detail->distributor_email != '') {
    include '../objects/mail-order.php';
    $mail_order = new MailTemplateOrder();

    include '../../../config/mailer.php';
    $mailerObj = new stdClass;

    $done_email = [];
    $mailer_err = "";
    if ($booking_detail->user_email != '') {
        $booking_detail->need_footer = true;

        $mail_order->mail_obj = $booking_detail;
        $mail_template = $mail_order->genMailContentForAdminAndUser();
        
        $mailerObj->email_id = $booking_detail->user_email;
        $mailerObj->user_name = $booking_detail->user_name;
        $mailerObj->subject = $booking_detail->distributor_name . ' - Service cancelled #' . $booking_detail->booking_number;
        $mailerObj->mail_template = $mail_template;

        $mailerResponse = sendMail($mailerObj);
        if ($mailerResponse) {
            array_push($done_email, "user");
        } else {
            $mailer_err = $mailerResponse;
        }
    }
    if ($booking_detail->distributor_email != '') {
        $booking_detail->need_footer = false;

        $mail_order->mail_obj = $booking_detail;
        $mail_template = $mail_order->genMailContentForAdminAndUser();

        $mailerObj->email_id = $booking_detail->distributor_email;
        $mailerObj->user_name = $booking_detail->distributor_name;
        $mailerObj->subject = 'Airportzo - Service cancelled #' . $booking_detail->booking_number;
        $mailerObj->mail_template = $mail_template;

        $mailerResponse = sendMail($mailerObj);
        if ($mailerResponse) {
            array_push($done_email, "admin");
        } else {
            $mailer_err = $mailerResponse;
        }
    }
    $service_provider_service_array = [];
    foreach ($booking_detail->order_detail as $order_key => $order_value) {
        if ($order_value->company_email != '') {
            $index = -1;
            foreach ($service_provider_service_array as $service_provider_service_key => $service_provider_service_value) {
                if ($service_provider_service_value->company_token == $order_value->company_token) {
                    $index = $service_provider_service_key;
                }
            }
            unset($service_provider_service_value);

            if ($index == -1) {
                $service_provider_service_obj = clone $booking_detail;
                $service_provider_service_obj->company_token = $order_value->company_token;
                $service_provider_service_obj->company_name = $order_value->company_name;
                $service_provider_service_obj->company_email = $order_value->company_email;
                $service_provider_service_obj->company_logo = $order_value->company_logo;
                $service_provider_service_obj->company_image = $order_value->company_image;
                $service_provider_service_obj->order_detail = [$order_value];
                array_push($service_provider_service_array, $service_provider_service_obj);
            } else {
                $order_array = $service_provider_service_array[$index]->order_detail;
                array_push($service_provider_service_array, $service_provider_service_obj);
                $service_provider_service_array[$index]->order_detail = $order_array;
            }
        }
    }
    unset($order_value);

    if (sizeof($service_provider_service_array) > 0) {
        foreach ($service_provider_service_array as $service_provider_service_key => $service_provider_service_value) {
            $mail_order->mail_obj = $service_provider_service_value;
            $mail_template = $mail_order->genMailContentForServiceProvider();

            $mailerObj->email_id = $service_provider_service_value->company_email;
            $mailerObj->user_name = $service_provider_service_value->company_name;
            $mailerObj->subject = 'Airportzo - Service cancelled #' . $booking_detail->booking_number;
            $mailerObj->mail_template = $mail_template;

            $mailerResponse = sendMail($mailerObj);
            if ($mailerResponse) {
                array_push($done_email, "service-provider");
            } else {
                $mailer_err = $mailerResponse;
            }
        }
    }

    if (sizeof($done_email)) {
        $booking_detail->done_email = $done_email;
        $booking_detail->service_provider_service_array = $service_provider_service_array;

        $obj->status_code = 200;
        $obj->message = "Email sent to " . implode(' & ', $done_email) . " successfully !";
        $obj->data = $booking_detail;
    } else {
        $obj->status_code = 400;
        $obj->message = ($mailer_err != '')? $mailer_err: 'Email error';
        $obj->data = new stdClass;
    }
} else {
    $data = new stdClass;
    $data->user_email = $booking_detail->user_email;
    $data->distributor_email = $booking_detail->distributor_email;

    $obj->status_code = 400;
    $obj->message = "Needs atleast an emai-id !";
    $obj->data = $booking_detail;
}
echo json_encode($obj);
?>