<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

//configuration files setup
include_once '../../../security/aws-invoice-key.php';
$cloudfrontUrl = $s3_cloudfront;

include '../../../config/core.php';
$input_data = getInputs();
$s3folder = 'invoices/Cancel-Invoice/';

$obj = new stdClass;
$user_token = $input_data->user_token;
    
include '../objects/service-location.php';
$service_location = new ServiceLocation();
include '../objects/users.php'; 
$users = new Users();
$users->token = $user_token;
$users->getUserDetail();

if ($users->stmt->rowCount() > 0) {
    include 'fetch-order-detail.php';
    $users_booking->token = $input_data->booking_token;
    $json_response = fetchOrderDetail();
    $response = json_decode($json_response);
    $booking_detail = $response->data;
    $airportzo_cancellation_fee = property_exists($booking_detail, 'airportzo_cancel_fee')? intval($booking_detail->airportzo_cancel_fee): 0;

    //cancel invoice generation
    include '../objects/allbooking-cancel-invoice.php';
    $invoice = new InvoiceTemplateOrder();
    $invoice->invoice_obj = $booking_detail;
    $invoice->cancelled_date = date("d M Y", strtotime($gm_date));
    $invoice_token = genToken_invoice('users__booking_detail','cancelled_invoice_token');
    $invoice->invoice_token = $invoice_token;
    $invoice_template = $invoice->genInvoiceForCancel();

    include '../../../TCPDF-main/store-pdf.php';
    $attachdata = savePdf($invoice_template, $invoice_token . '.pdf',$s3folder); //$source_path, $add_page

    $cancelled_services_count = 0;

    $sp_arr = [];
    $cancelled_services = [];

    foreach ($booking_detail->order_detail as $data_value) {
        foreach ($data_value->order_detail_array as $order_detail_value) {
            if ($order_detail_value->can_be_cancelled) {
                $cancellation_detail = $order_detail_value->cancellation_detail;
                    
                $users_booking_detail->token = $order_detail_value->token;
                $users_booking_detail->cancellation_hours = $cancellation_detail->cancellation_hours;
                $users_booking_detail->cancellation_fee = $cancellation_detail->cancellation_fee;
                $users_booking_detail->platform_fee = $cancellation_detail->airportzo_fee;
                $cancellation_fee_perc = $cancellation_detail->cancellation_fee_perc;//added for cancel booking
                $users_booking_detail->cancellation_percentage = $cancellation_fee_perc;
                $users_booking_detail->refund_amount = $cancellation_detail->refund_amount;
                $users_booking_detail->user_token = $user_token;
                $users_booking_detail->date_time = $gm_date_time;
                $users_booking_detail->invoice_token = $invoice_token;
                if ($users_booking_detail->cancelOrder()) {
                    //provider Cancel Booking Order
                    $service_location->sp_company_token = $order_detail_value->company_token;
                    $service_location->airport_token = $order_detail_value->airport_token;
                    $commission_data = $service_location->getCommissionForServiceProvider();
                    if($commission_data->is_credit == '1'){
                        $deduction_commission_amount_inservice =  $order_detail_value->net_amount-$order_detail_value->az_sp_commision_amount;
                        $cancel_cost = $deduction_commission_amount_inservice*$cancellation_fee_perc/100;
                        $cancelled_credits = $deduction_commission_amount_inservice-$cancel_cost;
                        $service_location->balance_provider_credits = $commission_data->provider_credits+$cancelled_credits;
                        $service_location->service_provider = $commission_data->service_provider;
                        $service_location->updateCreditAvailableAmount();
                    }
                    //provider Cancel Booking Order
                    $service_obj = new stdClass;
                    $service_obj->airport_code = $order_detail_value->airport_code;
                    $service_obj->airport_name = $order_detail_value->airport_name;
                    $service_obj->airport_type = $data_value->airport_type;
                    $service_obj->terminal_name = $order_detail_value->terminal_name;
                    $service_obj->service_name = $order_detail_value->service_name;
                    $service_obj->service_date = $order_detail_value->service_date;
                    $service_obj->service_time = $order_detail_value->service_time;
                    array_push($cancelled_services, $service_obj);

                    $index = -1;
                    foreach ($sp_arr as $sp_key => $sp_value) {
                        if ($sp_value->company_token == $order_detail_value->company_token) {
                            $index = $sp_key;
                        }
                    }
                    unset($sp_value);

                    if ($index > -1) {
                        $service_array = $sp_arr[$index]->service_array;
                        array_push($service_array, $service_obj);
                        $sp_arr[$index]->service_array = $service_array;
                    } else {
                        $sp_obj = new stdClass;
                        $sp_obj->company_token = $order_detail_value->company_token;
                        $sp_obj->company_name = $order_detail_value->company_name;
                        $sp_obj->company_email = $order_detail_value->company_email;
                        $sp_obj->service_array = [$service_obj];
                        array_push($sp_arr, $sp_obj);
                    }

                    $cancelled_services_count++;
                }
            }
        }
        unset($order_detail_value);
    }
    unset($data_value);

    if ($cancelled_services_count > 0) {
        $json_response = fetchOrderDetail();
        $response = json_decode($json_response);
        $booking_detail = $response->data;
        $booking_number = $booking_detail->booking_number;

        $has_uncancelled_service = false;
        foreach ($booking_detail->order_detail as $data_value) {
            foreach ($data_value->order_detail_array as $order_detail_value) {
                if ($order_detail_value->status != 'Cancelled') {
                    $has_uncancelled_service = true;
                }else{
                    $has_uncancelled_service = false;
                    break 2;
                }
            }
            unset($order_detail_value);
        }
        unset($data_value);
        if (!$has_uncancelled_service) {
            $users_booking->token = $input_data->booking_token;
            $users_booking->cancel_booking_invoice_pdf = $cloudfrontUrl . $s3folder . $invoice_token . '.pdf';
            $users_booking->cancelForToken();
        }

        $template_obj = new stdClass;
        $template_obj->distributor_name = $booking_detail->distributor_name;
        $template_obj->distributor_email = $booking_detail->distributor_email;
        $template_obj->header_logo = $booking_detail->header_logo;
        $template_obj->brand_colour = $booking_detail->brand_colour;
        $template_obj->booking_number = $booking_number;
        $template_obj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
        $template_obj->cancelled_services = $cancelled_services;

        include '../../../config/mailer-template.php';
        $mail_order = new MailTemplateOrder;
        $mail_order->mail_obj = $template_obj;
        $mail_order->mail_objs = $booking_detail;//RA
        $mail_order->order_detail_token = "";
        $mail_order->order_airport_token = "";
        $mail_order->mail_status = 'BOOKING CANCELLED';//RA
        $mail_order->mail_obj->need_footer = true;

        include '../../../config/mailer.php';
        $mailerObj = new stdClass;

        $done_email = [];
        if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {                
            $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
            $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
            $mailerObj->subject = 'Cancellation';// - Service booked #' . $booking_detail->booking_number;
            $mailerObj->e_ticket = '';
            $mailerObj->invoice_pdf = $attachdata;
            $mailerObj->invoice_name = 'Credit Note Invoice.pdf';
            //$mailerObj->mail_template = $mail_order->genCancelMailContentForUser();
            $mail_order->mail_for = "user";
            $mailerObj->mail_template = $mail_order->getMailContent();//RA
            $mailerResponse = sendMail($mailerObj);
            if ($mailerResponse) {
                array_push($done_email, "user");
            } else {
                $mailer_err = $mailerResponse;
            }

            $mail_order->mail_obj->need_footer = false;
            //$mailerObj->mail_template = $mail_order->genCancelMailContentForAdminAndSP();
            $mail_order->mail_for = "admin";
            $mailerObj->mail_template = $mail_order->getMailContent();//RA
            $mailerObj->email_id = $admin_email;
            $mailerObj->user_name = $admin_user_name;
            $mailerObj->e_ticket = '';
            $adminMailerResponse = sendMail($mailerObj);
            if ($adminMailerResponse) {
                array_push($done_email, "admin");
            } else {
                $mailer_err = $adminMailerResponse;
            }
        }
        foreach ($sp_arr as $sp_key => $sp_value) {
            //$mailerObj->mail_template = $mail_order->genCancelMailContentForAdminAndSP();
            $mail_order->mail_for = "service-provider";
            $mailerObj->mail_template = $mail_order->getMailContent();//RA
            $mailerObj->email_id = $sp_value->company_email;
            $mailerObj->user_name = $sp_value->company_name;
            $mailerObj->e_ticket = '';
            $adminMailerResponse = sendMail($mailerObj);
            
            if ($adminMailerResponse) {
                array_push($done_email, "service-provider");
            } else {
                $mailer_err = $adminMailerResponse;
            }
        } unset($sp_value);

        $obj->status_code = 200;
        $obj->message = 'Service cancelled successfully !';
        $obj->data = new stdClass;
        // $obj->data = $booking_detail;
    } else {
        $obj->status_code = 400;
        $obj->message = 'No services can be cancelled !';
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>