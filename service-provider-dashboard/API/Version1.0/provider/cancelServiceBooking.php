<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

//configuration files setup
include_once '../../../../security/service-provider-access-key.php';
$cloudfrontUrl = $s3_cloudfront;

include '../../../../config/core.php';
include_once '../objects/booking.php';
$booking = new Booking();
$obj = new stdClass;

$input_data = getInputs();

    include 'fetch-order-detail.php';
    $users_booking->sp_rejection = true;
    $users_booking->token = $input_data->booking_token;
    $json_response = fetchOrderDetail();
    $response = json_decode($json_response);
    $booking_detail = $response->data;
    $airportzo_cancellation_fee = property_exists($booking_detail, 'airportzo_cancel_fee')? intval($booking_detail->airportzo_cancel_fee): 0;
    //cancel invoice generation
    // include '../../../../web-app/php/objects/cancel-invoice.php';
    include '../objects/cancel-invoice.php';
    $invoice = new InvoiceTemplateOrder();
    $invoice->invoice_obj = $booking_detail;
    $invoice->order_detail_token = $input_data->order_detail_token;
    $invoice->cancelled_date = date("d M Y", strtotime($gm_date));
    $invoice_token = genToken_invoice('users__booking_detail','cancelled_invoice_token');
    $invoice->invoice_token = $invoice_token;
    // print_r(json_encode($booking_detail));
    $invoice_template = $invoice->genInvoiceForCancel();

    include '../../../../TCPDF-main/store-pdf-service-provider.php';
    $s3folder = 'invoices/Cancel-Invoice/';

    $attachdata = savePdf($invoice_template, $invoice_token . '.pdf',$s3folder); //$source_path, $add_page

    $cancelled_services_count = 0;
    foreach ($booking_detail->order_detail as $data_value) {
        foreach ($data_value->order_detail_array as $order_detail_value) {
            if ($order_detail_value->token == $input_data->order_detail_token && $order_detail_value->can_be_cancelled) {
                $cancellation_detail = $order_detail_value->cancellation_detail;

                $booking->token = $order_detail_value->token;
                $booking->cancellation_hours = $cancellation_detail->cancellation_hours;
                $booking->cancellation_fee = $cancellation_detail->cancellation_fee;
                $booking->platform_fee = $cancellation_detail->airportzo_fee;
                $cancellation_fee_perc = $cancellation_detail->cancellation_fee_perc;
                // $airportzo_cancellation_charge = $cancellation_detail->max_airportzo_fee;
                $airportzo_cancellation_charge = $cancellation_detail->airportzo_fee;
                $booking->cancellation_fee_perc = $cancellation_fee_perc;
                if($booking_detail->distributor_token != '1111111111'){
                    if($order_detail_value->is_agent == '1'){
                        $booking->refund_amount = $cancellation_detail->refund_amount;
                    }else{
                        $booking->refund_amount = $cancellation_detail->refund_amount;  
                    }
                }else{
                    $booking->refund_amount = $cancellation_detail->refund_amount;
                }
                $booking->date_time = $gm_date_time;
                $booking->user_token = $input_data->staff_token;
                $booking->invoice_token = $invoice_token;
                $booking->cancelled_order_invoice = $cloudfrontUrl . $s3folder . $invoice_token . '.pdf';

                if ($booking->cancelOrder()) {
                    $cancelled_services_count++;
                    
                    if($booking_detail->distributor_token != '1111111111'){
                        $booking->distributor_token = $booking_detail->distributor_token;
                        $distributor = $booking->getCreditAvailableForServiceDistributor();
                        if($order_detail_value->is_agent = '1'){
                            if($distributor->is_credit == '1'){
                                // $cancellation_cost =  $order_detail_value->net_amount*$cancellation_fee_perc/100;
                                // $distributor_cancelled_credits = $order_detail_value->net_amount-($airportzo_cancellation_charge+$cancellation_cost);
                                // $booking->distributor_balance_credit = $distributor->credit_available+$distributor_cancelled_credits;

                                $cancellation_cost =  round(((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total + (int)$order_detail_value->agent_conv_fee_commi + (int)$order_detail_value->gst_agent_conv_fee_commi) * $cancellation_fee_perc/100);
                                $distributor_cancelled_credits = (((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total + (int)$order_detail_value->agent_conv_fee_commi + (int)$order_detail_value->gst_agent_conv_fee_commi) - $cancellation_cost - $airportzo_cancellation_charge);
                                $booking->distributor_balance_credit = $distributor->credit_available + $distributor_cancelled_credits;
                                $booking->updateDistributorCreditAvailableAmount(); 
                            }
                        }else{
                            if($distributor->is_credit == '1'){
                                // $cancellation_cost =  $order_detail_value->net_amount*$cancellation_fee_perc/100;
                                // $distributor_cancelled_credits = $order_detail_value->net_amount-($airportzo_cancellation_charge+$cancellation_cost);
                                // $booking->distributor_balance_credit = $distributor->credit_available+$distributor_cancelled_credits;

                                $cancellation_cost =  round(((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total) * $cancellation_fee_perc/100);
                                $distributor_cancelled_credits = (((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total) - $cancellation_cost - $airportzo_cancellation_charge);
                                $booking->distributor_balance_credit = $distributor->credit_available + $distributor_cancelled_credits;
                                $booking->updateDistributorCreditAvailableAmount(); 
                            }
                        }
                    } 
   
                    $booking->sp_company_token = $order_detail_value->company_token;
                    $booking->airport_token = $order_detail_value->airport_token;
                    $commission_data = $booking->getCommissionForServiceProvider();
                    if($commission_data->is_credit == '1'){
                        $deduction_commission_amount_inservice = ($order_detail_value->net_amount-$order_detail_value->markup_amount)-$order_detail_value->az_sp_commision_amount;
                        $cancel_cost = $deduction_commission_amount_inservice*$cancellation_fee_perc/100;
                        $cancelled_credits = $deduction_commission_amount_inservice-$cancel_cost;

                        $booking->balance_provider_credits = $commission_data->provider_credits+$cancelled_credits;
                        $booking->service_provider = $commission_data->service_provider;
                        $booking->updateCreditAvailableAmount();
                    }
                    
                    $service_obj = new stdClass;
                    $service_obj->airport_code = $order_detail_value->airport_code;
                    $service_obj->airport_name = $order_detail_value->airport_name;
                    $service_obj->airport_type = $data_value->airport_type;
                    $service_obj->terminal_name = $order_detail_value->terminal_name;
                    $service_obj->service_name = $order_detail_value->service_name;
                    $service_obj->service_date = $order_detail_value->service_date;
                    $service_obj->service_time = $order_detail_value->service_time;

                    $template_obj = new stdClass;
                    $template_obj->distributor_name = $booking_detail->distributor_name;
                    $template_obj->distributor_email = $booking_detail->distributor_email;
                    $template_obj->header_logo = $booking_detail->header_logo;
                    $template_obj->brand_colour = $booking_detail->brand_colour;
                    $template_obj->booking_number = $booking_number;
                    $template_obj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                    $template_obj->cancelled_services = [$service_obj];

                    $sp_arr = [];
                    $sp_obj = new stdClass;
                    $sp_obj->company_token = $order_detail_value->company_token;
                    $sp_obj->company_name = $order_detail_value->company_name;
                    $sp_obj->company_email = $order_detail_value->company_email;
                    $sp_obj->service_array = [$service_obj];
                    array_push($sp_arr, $sp_obj);

                    include '../../../../config/mailer-template.php';
                    $mail_order = new MailTemplateOrder;
                    $mail_order->mail_obj = $template_obj;
                    $mail_order->mail_objs = $booking_detail;//RA
                    $mail_order->order_detail_token = $input_data->order_detail_token;
                    $mail_order->order_airport_token = $order_detail_value->airport_token;
                    $mail_order->mail_status = 'ORDER CANCELLED';//RA
                    $mail_order->mail_obj->need_footer = true;

                    include '../../../../config/mailer.php';
                    $mailerObj = new stdClass;

                    $done_email = [];
                    if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {                
                        $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
                        $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                        $mailerObj->subject = 'Cancellation';
                        $mailerObj->e_ticket = ''; 
                        $mailerObj->invoice_pdf = $attachdata;
                        $mailerObj->invoice_name = 'Credit Note Invoice.pdf';
                        $mail_order->mail_for = "user";
                        $mailerObj->mail_template = $mail_order->getMailContent();//RA
                        $mailerResponse = sendMail($mailerObj);
                        if ($mailerResponse) {
                            array_push($done_email, "user");
                        } else {
                            $mailer_err = $mailerResponse;
                        }

                        $mail_order->mail_obj->need_footer = false;
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
                }
            }
        }
        unset($order_detail_value);
    }
    unset($data_value);

    if ($cancelled_services_count > 0) {
//        $json_response = fetchOrderDetail($input_data->booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport);
//        $response = json_decode($json_response);
//        $booking_detail = $response->data;
//
//        $has_uncancelled_service = false;
//        foreach ($booking_detail->order_detail as $data_value) {
//            foreach ($data_value->order_detail_array as $order_detail_value) {
//                if ($order_detail_value->status != 'Cancelled') {
//                    $has_uncancelled_service = true;
//                }
//            }
//            unset($order_detail_value);
//        }
//        unset($data_value);
//        if (!$has_uncancelled_service) {
//            $users_booking->token = $input_data->booking_token;
//            $users_booking->cancelForToken();
//        }

        $obj->status_code = 200;
        $obj->message = 'Service cancelled successfully !';
        $obj->data = new stdClass;
    } else {
        $obj->status_code = 400;
        $obj->message = 'No services can be cancelled !';
        $obj->data = new stdClass;
    }
   
echo json_encode($obj);
?>