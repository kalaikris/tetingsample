<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
$bookingApp->bookingToken = $inputData->bookingDetailToken;
$statusArray = ['Reached service location','Met the client','Guide the client','Completed'];
foreach($statusArray as $value){
    $bookingApp->workStatus   = $value;
    $stmt = $bookingApp->workStatusCheck();
    if($stmt->rowCount()==0){
        if($bookingApp->workStatus!=""){
            if($bookingApp->workStatus=="Reached service location"){
                $bookingApp->updateStatus('Ongoing','0000-00-00 00:00:00');
            }else if($bookingApp->workStatus=="Completed"){
//                $providerDetails                   = $bookingApp->getProviderDetails();
//                $bookingApp->providertoken         = $providerDetails->providertoken;
//                $bookingApp->providerCredits       = $providerDetails->providerCredits;
//                $bookingApp->providerPercentage    = $providerDetails->commission;
//                $bookingApp->bookingNetAmount      = $bookingApp->getBookingNetAmount();
//                $bookingApp->providerCommission    = $bookingApp->bookingNetAmount*($bookingApp->providerPercentage/100);
//                $bookingApp->providerPreviousCredit= $bookingApp->providerCredits;
//                $bookingApp->providerBalanceCredit = $bookingApp->providerCredits-($bookingApp->bookingNetAmount -$bookingApp->providerCommission);
//
//                $distributorDetails    = $bookingApp->getDistributorDetails();
//                $bookingApp->distributorToken      = $distributorDetails->distributorToken;
//                $bookingApp->distributorCredits    = $distributorDetails->distributorCredits;
//                $bookingApp->distributorPercentage = $distributorDetails->commission;
//                $bookingApp->distributorCommission = $bookingApp->bookingNetAmount*($bookingApp->distributorPercentage/100);
//                $bookingApp->distributorPreviousCredit= $bookingApp->distributorCredits;
//                $bookingApp->distributorBalanceCredit = $bookingApp->distributorCredits-$bookingApp->bookingNetAmount;

                  $bookingApp->updateStatus('Completed',$gm_date_time);
//                $bookingApp->updateCommisionDetails();
//                $bookingApp->updateProviderCredits();
//                $bookingApp->updateDistributorCredits();

                //Mail
                include_once '../objects/booking.php';
                $booking = new Booking();
                $booking->bookingOrderToken = $inputData->bookingDetailToken;
                $user_detail   = $booking->getUserDetailForMail();
                $mail_funcion  = $booking->maildata($booking->bookingOrderToken);
                include '../../../../config/mailer-template.php';
                $mail_order = new MailTemplateOrder;
                $mail_order->user_detail = $user_detail;
                $mail_order->mail_data = $mail_funcion;
                
                 include '../../../../config/mailer.php';
                    $mailerObj = new stdClass;

                    $done_email = [];
                    if ($user_detail->user_mail_id != '') {                
                        $mailerObj->email_id = $user_detail->user_mail_id;
                        $mailerObj->user_name = $user_detail->user_name;
                        $mailerObj->subject = 'Completed Service';
                        $mailerObj->e_ticket = '';
                        $mailerObj->mail_template = $mail_order->bookingCompletedTemplate();
                        $mailerResponse = sendMail($mailerObj);
                        if ($mailerResponse) {
                            array_push($done_email, "user");
                        } else {
                            $mailer_err = $mailerResponse;
                        }

                        $mailerObj->mail_template = $mail_order->bookingCompletedTemplate();
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


//                $message     = "This booking has been successfully completed.";
//                $header      = "Booking Completed";
//                $airportCode     = $mail_funcion[0]->airportCode;
//                $terminalName    = $mail_funcion[0]->terminal_name;
//                $serviceName     = $mail_funcion[0]->service_name;
//                $serviceDateTime = $mail_funcion[0]->service_date_time_status;
//                include_once '../objects/mail.php';
//                include_once '../../../../config/distributor_mail.php';
//                $mailHtml    = new mailHtml();
//                $description = "$airportCode $terminalName - $serviceName - $serviceDateTime";
//                $htmlDetail  = $mailHtml->bookingHtml($domainUrl,$user_detail,$description,$message);
//                $mailCheck = booking_status($user_detail,$htmlDetail,$header);
            }
            $bookingApp->addWorkStatus($gm_date_time);
        }
    }
}
$obj->status_code = 201;
$obj->message     = "Updated successfully";
echo json_encode($obj);
?>