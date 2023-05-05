<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

//configuration files setup
include_once '../../../../security/service-provider-access-key.php';
$cloudfrontUrl = $s3_cloudfront;

$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingOrderToken = $inputData->bookingOrderToken;
$booking->booking_token     = $booking->bookingOrderToken;
include_once '../../../../config/distributor_invoice.php';
include_once '../../../../config/distributor_mail.php';
$booking->bookingStatus   = $inputData->bookingStatus;
$booking->approvedByToken = $inputData->approvedByToken;
$booking->gmDateTime      = $gm_date_time;
$travelStatus  = $inputData->bookingStatus;
$type_name     = $inputData->typeName;
$user_detail   = $booking->getUserDetailForMail();
$mail_funcion  = $booking->maildata($booking->bookingOrderToken);
$s3folder = 'invoices/Cancel-Invoice/';

include 'fetch-order-detail.php';
$users_booking->sp_rejection = true;
$users_booking->token = $user_detail->booking_token;
$json_response = fetchOrderDetail();
$response = json_decode($json_response);
$booking_detail = $response->data;

 $attachdata = '';
 $service_cost = 0;

 if($booking->bookingStatus == 'Cancelled'){
    //cancel invoice generation
    include '../objects/reject-cancel-invoice.php';
    $invoice = new InvoiceTemplateOrder();
    $invoice->invoice_obj = $booking_detail;
    $invoice->order_detail_token = $inputData->bookingOrderToken;
    $invoice->cancelled_date = date("d M Y", strtotime($gm_date));
    $invoice_token = genToken_invoice('users__booking_detail','cancelled_invoice_token');
    $invoice->invoice_token = $invoice_token;
    $booking->invoice_token    = $invoice_token;
    $booking->cancelled_order_invoice = $cloudfrontUrl . $s3folder . $invoice_token . '.pdf';
    
    $invoice_template = $invoice->genInvoiceForCancel();
    include '../../../../TCPDF-main/store-pdf-service-provider.php';
    $attachdata = savePdf($invoice_template, $invoice_token . '.pdf',$s3folder); //$source_path, $add_page
 }else{
    $attachdata = '';
 }

     foreach ($booking_detail->order_detail as $data_value) {
        foreach ($data_value->order_detail_array as $order_detail_value) {
          if ($order_detail_value->token == $inputData->bookingOrderToken) {
            $service_cost = ((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total + (int)$order_detail_value->add_child_sub_total + (int)$order_detail_value->agent_conv_fee_commi + (int)$order_detail_value->gst_agent_conv_fee_commi + (int)$order_detail_value->user_conv_fee_commi + (int)$order_detail_value->gst_user_conv_fee_commi);

                if($booking->bookingStatus == 'Cancelled'){
                    if($booking_detail->distributor_token != '1111111111'){
                        $booking->distributor_token = $booking_detail->distributor_token;
                        $distributor = $booking->getCreditAvailableForServiceDistributor();
                        if($order_detail_value->is_agent == '1'){
                            //whitelabel agent booking credit deduction flow
                            if($distributor->is_credit == '1'){
                                $distributor_cancelled_credits = round((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total + (int)$order_detail_value->agent_conv_fee_commi + (int)$order_detail_value->gst_agent_conv_fee_commi);
                                $booking->distributor_balance_credit = $distributor->credit_available + $distributor_cancelled_credits;
                                $booking->updateDistributorCreditAvailableAmount(); 
                            }
                        }else{
                            //whitelabel user booking credit deduction flow
                            if($distributor->is_credit == '1'){
                                $distributor_cancelled_credits = round((int)$order_detail_value->adult_sub_total + (int)$order_detail_value->child_sub_total + (int)$order_detail_value->add_adult_sub_total + (int)$order_detail_value->add_child_sub_total);
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
                        //$cancel_cost = $deduction_commission_amount_inservice*$cancellation_fee_perc/100;
                        //$cancelled_credits = $deduction_commission_amount_inservice-$cancel_cost;
                
                        $booking->balance_provider_credits = $commission_data->provider_credits+$deduction_commission_amount_inservice;
                        $booking->service_provider = $commission_data->service_provider;
                        $booking->updateCreditAvailableAmount();
                    }
                }
//                        $sp_arr = [];
//                        $sp_obj = new stdClass;
//                        $sp_obj->company_token = $order_detail_value->company_token;
//                        $sp_obj->company_name = $order_detail_value->company_name;
//                        $sp_obj->company_email = $order_detail_value->company_email;
//                        $sp_obj->service_array = [$service_obj];
//                        array_push($sp_arr, $sp_obj);

                        include '../../../../config/mailer-template.php';
                        $mail_order = new MailTemplateOrder;
                        $mail_order->mail_objs = $booking_detail;
                        $mail_order->mail_status = ($inputData->bookingStatus == 'Cancelled')? 'BOOKING REJECTED': 'BOOKING CONFIRMED';
                        $mail_order->order_detail_token = $inputData->bookingOrderToken;
                        $mail_order->order_airport_token = $order_detail_value->airport_token;
                        $mail_order->mail_obj = new stdClass;
                        $mail_order->mail_obj->footer = true;

                        include '../../../../config/mailer.php';
                        $mailerObj = new stdClass;

                        $done_email = [];
                        if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {                
                            $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
                            $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                            $mailerObj->subject = $inputData->bookingStatus;// - Service booked #' . $booking_detail->booking_number;
                            $mailerObj->e_ticket = ''; 
                            $mailerObj->invoice_pdf = $attachdata;
                            $mailerObj->invoice_name = 'Credit Note Invoice.pdf';
                            $mail_order->mail_for = "user";
                            $mail_order->service_costs = $service_cost;
                            $mailerObj->mail_template = $mail_order->getMailContent_serviceProvider_cancel_booking();
                            $mailerResponse = sendMail($mailerObj);
                            if ($mailerResponse) {
                                array_push($done_email, "user");
                            } else {
                                $mailer_err = $mailerResponse;
                            }

                            $mail_order->mail_obj->need_footer = false;
                            $mail_order->mail_for = "admin";
                            $mail_order->service_costs = $service_cost;
                            $mailerObj->mail_template = $mail_order->getMailContent_serviceProvider_cancel_booking();
                            $mailerObj->email_id = $admin_email;
                            $mailerObj->user_name = $admin_user_name;
                            $mailerObj->e_ticket = '';
                            $adminMailerResponse = sendMail($mailerObj);
                            if ($adminMailerResponse) {
                                array_push($done_email, "admin");
                            } else {
                                $mailer_err = $adminMailerResponse;
                            }
                            //distributor_mail
//                            if($user_detail->is_airportzo_user == 0){
//                                $mailerObj->email_id = $booking_detail->distributor_email;
//                                $mailerObj->user_name = $booking_detail->distributor_name;
//                                $mailerObj->e_ticket = '';
//                                $mailerObj->mail_template = $mail_order->getMailContent();
//                                $adminMailerResponse = sendMail($mailerObj);
//                                if ($adminMailerResponse) {
//                                    array_push($done_email, "distributor");
//                                } else {
//                                    $mailer_err = $adminMailerResponse;
//                                }
//                            }
                        }

//                        foreach ($sp_arr as $sp_key => $sp_value) {
//                            $mailerObj->mail_template = $mail_order->getMailContent();
//                            $mailerObj->email_id = $sp_value->company_email;
//                            $mailerObj->user_name = $sp_value->company_name;
//                            $mailerObj->e_ticket = '';
//                            $adminMailerResponse = sendMail($mailerObj);
//                            
//                            if ($adminMailerResponse) {
//                                array_push($done_email, "service-provider");
//                            } else {
//                                $mailer_err = $adminMailerResponse;
//                            }
//                        } unset($sp_value);
                   }
            }
            unset($order_detail_value);
        }
        unset($data_value);
//if($booking->bookingStatus == 'Confirmed'){
//    $message     = "This booking has been confirmed";
//    $header      = "Booking Confirmation";
//}else if($booking->bookingStatus == 'Rejected'){  
//    $message     = "We are sorry, the selected service is not available on the booked date(s). The booked amount will be refunded back to your account in 4/5 business days.";
//    $header      = "Booking Rejected";
//}else if($booking->bookingStatus == 'Cancelled'){  
//    $message     = "This booking has been cancelled. For refund details please login and refer to your account details.";
//    $header      = "Booking Cancelled";
//}
//$airportCode     = $mail_funcion[0]->airportCode;
//$terminalName    = $mail_funcion[0]->terminal_name;
//$serviceName     = $mail_funcion[0]->service_name;
//$serviceDateTime = $mail_funcion[0]->service_date_time_status;
//include_once '../objects/mail.php';
//$mailHtml    = new mailHtml();
//$description = "$airportCode $terminalName - $serviceName - $serviceDateTime";
//$htmlDetail  = $mailHtml->bookingHtml($domainUrl,$user_detail,$description,$message);
//
//if($booking->bookingStatus != 'Assign'){
//    $mailCheck = booking_status($user_detail,$htmlDetail,$header);
//}

if($booking->bookingStatus == 'Confirmed'){
    //$booking->approveBooking();
    $mail_token   = $mail_funcion[0]->token; 
    $htmlContent  = invoice_template($mail_funcion,$type_name,$travelStatus);
    $fileName     = store_invoice($htmlContent,$mail_token);
    $mailHtmlContent = booking_invoince_content($mail_funcion,$type_name,$travelStatus);
    //send_email($user_detail,$mailHtmlContent,$mail_token);//previous command
}else{
    $booking->cancelBooking();
}

// $booking->refundAmount  = $mail_funcion[0]->net_amount;
$booking->refundAmount  = $service_cost;
$obj->status_code = 201;
$obj->mailCheck   = $mail_funcion;
$booking->approveBookingOrder();
echo json_encode($obj);
?> 