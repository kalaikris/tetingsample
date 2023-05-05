<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include '../../../../config/core.php';
$input_data = getInputs();
$booking_token = $input_data->booking_token;
$type_name = $input_data->type_name;
$status = $input_data->status;
$travelStatus = $input_data->travelStatus;
include_once '../objects/service-distributor.php';
include_once '../../../../config/distributor_invoice.php';
include_once '../../../../config/distributor_mail.php';
$obj = new stdClass;
   $service_distributor = new ServiceDistributor();
   $service_distributor->booking_token = $booking_token;
   $stmt = $service_distributor->update_Boooking_details($booking_token,$status);
   if($status == 'Ongoing'){
        $mail_funcion = $service_distributor->maildata($booking_token);
        $mail_token = $mail_funcion[0]->token; 
        $htmlContent = invoice_template($mail_funcion,$type_name,$travelStatus);
        $fileName = store_invoice($htmlContent,$mail_token);
        $mailHtmlContent = booking_invoince_content($mail_funcion,$type_name,$travelStatus);
        $user_detail = $service_distributor->getUserDetailForMail();
        send_email($user_detail,$mailHtmlContent,$mail_token);
   }
$obj1 = new stdClass;
$obj1->arra1=$stmt;
$obj1->mail_array = $mail_funcion;
$obj1->mail_token = $mail_token;

$obj->status_code = 200;
$obj->title = "Success";
$obj->message = "Airport List"; 
$obj->data = $obj1;
echo json_encode($obj);

?>