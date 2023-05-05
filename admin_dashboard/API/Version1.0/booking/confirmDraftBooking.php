<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//configuration files setup
include_once '../../../../security/service-provider-access-key.php';
$cloudfrontUrl = $s3_cloudfront;

$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once 'fetch-order-detail.php';
include_once '../objects/admin.php';
$admin = new admin();
$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$create_invoice_token = genToken_invoice('users__booking','invoice_token');
$s3folder = 'invoices/Booking-Invoice/';
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/booking.php';
    $booking = new booking();
    $booking->bookingToken = $inputData->bookingToken;
        $service_array = $booking->getBookingServiceDetails();
        foreach($service_array as $service_value){
            $booking->airport_token = $service_value->airport_token;
            $booking->sp_company_token = $service_value->sp_company_token;
            $commission_data = $booking->getCommissionForServiceProvider();
            $provider_commission_amount = $service_value->net_amount*$commission_data->commission_percentage/100;
            $total_cost = $service_value->net_amount-$provider_commission_amount;
            $booking->balance_provider_credits = $commission_data->provider_credits-$total_cost;
            $booking->service_provider = $commission_data->service_provider;
            $booking->updateCreditAvailableAmount();
            $booking->provider_commission_percentage = $commission_data->commission_percentage;
            $booking->provider_commission_amount = $provider_commission_amount;
            $booking->previous_provider_credits = $commission_data->provider_credits;
            $booking->booking_detail_token = $service_value->booking_detail_token;
            $booking->updateCommissionInUserBookingDetail();
        }

        $booking->invoice_token = $create_invoice_token;
        $booking->invoice_pdf = $cloudfrontUrl . $s3folder . $create_invoice_token . '.pdf';
        $booking->storeInvoiceurl();

         $users_booking->token = $inputData->bookingToken;
         $users_booking->sp_rejection = false;
         $fetch_json_order_detail = fetchOrderDetail();
         $fetch_order_detail = json_decode($fetch_json_order_detail);

         if ($fetch_order_detail->status_code == 200) {

            $booking_detail = $fetch_order_detail->data;
            // print_r(json_encode($booking_detail));
            // return;
            $e_ticket = $booking_detail->e_ticket;

            // include '../objects/mail-order.php';
            // $mail_order = new MailTemplateOrder();

            include_once '../objects/invoice-order.php';
            $invoice = new InvoiceTemplateOrder();
            $invoice->invoice_obj = $booking_detail;
            $invoice_template = $invoice->genInvoiceForOrder();

            include_once '../../../../TCPDF-main/store-pdf-backend-booking.php';
            $attachdata = savePdf($invoice_template, $create_invoice_token . '.pdf',$s3folder); //$source_path, $add_page
            

            include_once '../../../../config/mailer-template.php';
            $mail_order = new MailTemplateOrder;

            include_once '../../../../config/mailer.php';
            $mailerObj = new stdClass;

            $done_email = [];
            $mailer_err = "";
            if ($booking_detail->passenger_detail[0]->passenger_array[0]->email_id != '') {
                $booking_detail->need_footer = true;
                $mail_order->mail_obj = new stdClass;
                $mail_order->mail_obj = $booking_detail;
                $mailerObj->email_id = $booking_detail->passenger_detail[0]->passenger_array[0]->email_id;
                $mailerObj->user_name = $booking_detail->passenger_detail[0]->passenger_array[0]->name;
                $mailerObj->subject = 'Airportzo - Service booked #' . $booking_detail->booking_number;
                $mailerObj->e_ticket = '';
                $mailerObj->invoice_pdf = $attachdata;
                $mailerObj->invoice_name = 'Invoice.pdf';
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
                $mailerObj->invoice_pdf = '';
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

            // foreach ($sp_service_array as $sp_service_value) {
            //     $mail_order->mail_obj = $sp_service_value;

            //     $mailerObj->email_id = $sp_service_value->company_email;
            //     $mailerObj->user_name = $sp_service_value->company_name;
            //     $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
            //     $mailerObj->e_ticket = $e_ticket;
            //     $mailerObj->invoice_pdf = '';
            //     $mailerObj->mail_template = $mail_order->genMailContentForServiceProvider();

            //     $mailerResponse = sendMail($mailerObj);
            //     if ($mailerResponse) {
            //         array_push($done_email, "service-provider");
            //     } else {
            //         $mailer_err = $mailerResponse;
            //     }
            // }

            foreach ($sp_service_array as $sp_service_value) {
                $mail_order->mail_obj = $sp_service_value;
                $orderDetail = $sp_service_value->order_detail;
                foreach ($orderDetail as $detailarray) {
                    $orderDetailarray = $detailarray->order_detail_array;
                    foreach ($orderDetailarray as $orderDetail_array) {
                        $mailerObj->email_id = $orderDetail_array->company_email;
                        $mailerObj->user_name = $orderDetail_array->company_name;
                        $mailerObj->subject = 'Airportzo - New service booked #' . $booking_detail->booking_number;
                        $mailerObj->e_ticket = $e_ticket;
                        $mailerObj->invoice_pdf = '';
                        $mailerObj->mail_template = $mail_order->genMailContentForServiceProvider();

                        $mailerResponse = sendMail($mailerObj);
                        if ($mailerResponse) {
                            array_push($done_email, "service-provider");
                        } else {
                            $mailer_err = $mailerResponse;
                        }
                    }
                }
            }

        $obj->status_code = 201;
        $obj->title = "success";
        $obj->message = "Confirmed";
        }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>