<?php
include '../../../config/mailer-template.php';
$mail_order = new MailTemplateOrder;

include '../../../config/mailer.php';
$mailerObj = new stdClass;

$done_email = [];
$mailer_err = "";
if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {
    $booking_detail->need_footer = true;

    $mail_order->mail_obj = $booking_detail;
    
    $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
    $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
    $mailerObj->subject = 'Airportzo - Service booked #' . $booking_detail->booking_number;
    $mailerObj->e_ticket = '';
    $mailerObj->mail_template = $mail_order->genMailContentForAdminAndUser();
    $mailerResponse = sendMail($mailerObj);
    if ($mailerResponse) {
        array_push($done_email, "user");
    } else {
        $mailer_err = $mailerResponse;
    }

    $mail_order->mail_obj->need_footer = false;
    $mailerObj->email_id = $admin_email;
    $mailerObj->user_name = $admin_user_name;
    $mailerObj->e_ticket = $e_ticket;
    $mailerObj->mail_template = $mail_order->genMailContentForAdminAndUser();
    $adminMailerResponse = sendMail($mailerObj);
    if ($adminMailerResponse) {
        array_push($done_email, "admin");
    } else {
        $mailer_err = $adminMailerResponse;
    }
}

$sp_service_array = [];
foreach ($booking_detail->order_detail as $station_key => $station_value) {
    foreach ($station_value->order_detail_array as $service_key => $service_value) {
        if ($service_value->company_email != '') {
            $index = -1;
            foreach ($sp_service_array as $sp_service_key => $sp_service_value) {
                if ($sp_service_value->company_token == $service_value->company_token) {
                    $index = $sp_service_key;
                }
            }
            unset($sp_service_value);
            
            if ($index > -1) {
                $sp_service_obj = $sp_service_array[$index];

                $station_index = -1;
                foreach ($sp_service_obj->order_detail as $sp_station_key => $sp_station_value) {
                    if ($sp_station_value->station_number == $station_value->station_number) {
                        $station_index = $sp_station_key;
                    }
                }
                unset($sp_station_value);

                if ($station_index > -1) {
                    $service_array = $sp_service_array[$index]->order_detail[$station_index]->order_detail_array;
                    array_push($service_array, $service_value);
                    $sp_service_array[$index]->order_detail[$station_index]->order_detail_array = $service_array;
                } else {
                    $sp_station_obj = clone $station_value;
                    $sp_station_obj->order_detail_array = [$service_value];

                    $order_detail = $sp_service_array[$index]->order_detail;
                    array_push($order_detail, $sp_station_obj);
                    $sp_service_array[$index]->order_detail = $order_detail;
                }
            } else {
                $sp_station_obj = clone $station_value;
                $sp_station_obj->order_detail_array = [$service_value];

                $sp_service_obj = new stdClass;
                $sp_service_obj->company_token = $service_value->company_token;
                $sp_service_obj->company_name = $service_value->company_name;
                $sp_service_obj->company_email = $service_value->company_email;
                $sp_service_obj->company_logo = $service_value->company_logo;
                $sp_service_obj->company_image = $service_value->company_image;
                $sp_service_obj->total_adult = $booking_detail->total_adult;
                $sp_service_obj->total_children = $booking_detail->total_children;
                $sp_service_obj->booking_number = $booking_detail->booking_number;
                $sp_service_obj->date_time = $booking_detail->date_time;
                $sp_service_obj->description_one = $booking_detail->description_one;
                $sp_service_obj->description_two = $booking_detail->description_two;
                $sp_service_obj->passenger_detail = $booking_detail->passenger_detail;
                $sp_service_obj->journey_detail = $booking_detail->journey_detail;
                $sp_service_obj->order_detail = [$sp_station_obj];
                array_push($sp_service_array, $sp_service_obj);
            }
        }
    }
    unset($service_value);
}
unset($order_value);

foreach ($sp_service_array as $sp_service_value) {
    $mail_order->mail_obj = $sp_service_value;

    $mailerObj->email_id = $sp_service_value->company_email;
    $mailerObj->user_name = $sp_service_value->company_name;
    $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
    $mailerObj->e_ticket = $e_ticket;
    $mailerObj->mail_template = $mail_order->genMailContentForServiceProvider();

    $mailerResponse = sendMail($mailerObj);
    if ($mailerResponse) {
        array_push($done_email, "service-provider");
    } else {
        $mailer_err = $mailerResponse;
    }
}
?>