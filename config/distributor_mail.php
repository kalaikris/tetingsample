<?php
$domainUrl = "https://airportzostage.in";
function send_email($user_detail,$mailHtmlContent,$mail_token){
  require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
 // $mail->clearAllRecipients();
  $mail->isSMTP();                             // Set mailer to use SMTP
  $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
  $mail->addReplyTo('support@airportzostage.in');
  $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
  $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
  $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
  $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
  $file_name =  'invoice_'.$mail_token.'.pdf'; 
  $file_to_attach = '/home/airportzostage/public_html/booking_pdf/'.$file_name;
  $mail->AddAttachment( $file_to_attach , $file_name ); 
  $mail->Subject = "Booking Confirmation";
  $mail->Body    = $mailHtmlContent;
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;       
  $mail->isHTML(true);
  if(!$mail->Send()){
      return $mail->ErrorInfo;
  }else{
      return true;
  }
}
function send_distributor_credentials($user_detail,$mailHtmlContent){
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    // $mail->clearAllRecipients();
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->Subject = "Distibutor Credentials";
    $mail->Body    = $mailHtmlContent;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    //$mail->SMTPDebug = 2 ;   
    $mail->Port = 587;       
    $mail->isHTML(true);
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}
function send_provider_credentials($user_detail,$mailHtmlContent){
  require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
 // $mail->clearAllRecipients();
  $mail->isSMTP();                             // Set mailer to use SMTP
  $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
  $mail->addReplyTo('support@airportzostage.in');
  $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
  $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
  $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
  $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
  $mail->Subject = "Provider Credentials";
  $mail->Body    = $mailHtmlContent;
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
  //$mail->SMTPDebug = 2 ;   
  $mail->Port = 587;       
  $mail->isHTML(true);
  if(!$mail->Send()){
      return $mail->ErrorInfo;
  }else{
      return true;
  }
}
function send_staff_credentials($user_detail,$mailHtmlContent){
  require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
 // $mail->clearAllRecipients();
  $mail->isSMTP();                             // Set mailer to use SMTP
  $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
  $mail->addReplyTo('support@airportzostage.in');
  $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
  $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
  $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
  $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
  $mail->Subject = "Staff Credentials";
  $mail->Body    = $mailHtmlContent;
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
  //$mail->SMTPDebug = 2 ;   
  $mail->Port = 587;       
  $mail->isHTML(true);
  if(!$mail->Send()){
      return $mail->ErrorInfo;
  }else{
      return true;
  }
}
function approve_agent($user_detail,$mailHtmlContent,$header){
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    // $mail->clearAllRecipients();
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->Subject = $header;
    $mail->Body    = $mailHtmlContent;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    //$mail->SMTPDebug = 2 ;   
    $mail->Port = 587;       
    $mail->isHTML(true);
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}
function booking_status($user_detail,$mailHtmlContent,$header){
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $is_airportzo_user=$user_detail->is_airportzo_user;
    $mail = new PHPMailer;
    $mail->clearAllRecipients();
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
    $mail->addAddress('pravin@macappstudio.com','Pravin');
    if(!$is_airportzo_user)$mail->addAddress($user_detail->distributor_email,$user_detail->distributor_name);
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->Subject = $header;
    $mail->Body    = $mailHtmlContent;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    //$mail->SMTPDebug = 2 ;   
    $mail->Port = 587;       
    $mail->isHTML(true);
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}
function booking_invoince_content($mail_funcion,$type_name,$travelStatus) {
    $net_amount = round($mail_funcion[0]->net_amount/1.18,2);
    $gst_amount = $mail_funcion[0]->net_amount-$net_amount;
    $cgst = round($gst_amount/2,2);
    
    $htmlText2 = '';
    $htmlText2 .='<table cellspacing="0" cellpadding="0" border="0" style="width:800px;margin:auto;font-family: sans-serif;font-weight: 100;-moz-osx-font-smoothing: grayscale;-webkit-font-smoothing: antialiased;">
    <thead style="background-color: #07b4d2;">
        <tr>
            <th style="text-align: left;height: 90px;">
                <img src="https://airportzo.net.in/invoince-template/airportzo_logo_white.png" alt="logo" style="width: 154px;margin-left: 20px;">
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table style="width: 100%;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th style="font-size:16px;line-height:20px;font-weight:700;padding: 20px 5px;" colspan="5"></th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                <table  style="width: 100%;"  bordercolor="#cac1c1" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 25%;border-right: 2px solid #cac1c1;">Confirmation No: '.$mail_funcion[0]->token.'</th>
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 50%;border-right: 2px solid #cac1c1;">SERVICE CONFIRMATION VOUCHER FOR: '.$mail_funcion[0]->service_name.'</th>
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 25%;">Date: '.$mail_funcion[0]->date_time.'</th>
                                        </tr>
                                    </thead>
                                </table>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5">
                                <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td style="width:50%;padding: 10px;border-right: 2px solid #cac1c1;">
                                                <span style="display:block;font-size:16px;line-height:22px;">AIRPORTZO INDIA PRIVATE LIMITED</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">GST NO: 33AAGCB7822G2ZT</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Contact: +91 8610725198</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Email: support@airportzo.com</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Confirmation No</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$mail_funcion[0]->token.'</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">From Airport</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$mail_funcion[0]->firstElementNname.'</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">To Airport</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$mail_funcion[0]->lastElementNname.'</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Arrival/Departure</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$travelStatus.'</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Arrival/Departure Flight No.</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$mail_funcion[0]->flight_number.'</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Sector of Travel</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'.$type_name.'</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Service Detail & Terminal</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">'
                                                    .$mail_funcion[0]->service_date_time.'/'.$mail_funcion[0]->business_name.' & '.$mail_funcion[0]->terminal_name.
                                                '</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="width:50%;">
                                <strong style="font-size:16px;line-height:22px;font-weight:700;padding: 10px;">PAYMENT REFERENCE ID: '.$mail_funcion[0]->payment_id.'</strong>
                            </td>
                            <td colspan="2" style="text-align: center;width:50%;">
                                <strong style="font-size:16px;line-height:22px;font-weight:700;">Service Date & Time(Local Time)</strong>
                                <span style="display:block;font-size:16px;line-height:22px;">'.$mail_funcion[0]->service_date_time.'</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th style="padding: 10px;">Guests</th>
                            <th style="padding: 10px;">Name</th>
                        </tr>
                    </thead>
                    <tbody>';
                          $passengers_array = $mail_funcion[0]->passanger_array;
                    foreach($passengers_array as $key => $arrays_val){
                      $slno = $key+1; 
          $htmlText2 .= '<tr>
                            <td style="padding: 10px;">'.$slno.'</td>
                            <td style="padding: 10px;">'.$arrays_val->name.'</td>
                        </tr>';
                    }
         $htmlText2 .= '</tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;text-align: left;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th colspan="4" style="padding: 10px;">Description</th>
                            <th style="text-align: right;padding: 10px;">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 5px 10px;" colspan="4">'.$mail_funcion[0]->business_name.'</td>
                            <td style="padding: 5px 10px;text-align: right;">'.$net_amount.'</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">Net Amount</td>
                            <td style="padding: 5px 10px;text-align: right;">'.$net_amount.'</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">SGST (9%)</td>
                            <td style="padding: 5px 10px;text-align: right;">'.$cgst.'</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">CGST (9%)</td>
                            <td style="padding: 5px 10px;text-align: right;">'.$cgst.'</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">Total</td>
                            <td style="padding: 5px 10px;text-align: right;">'.$mail_funcion[0]->net_amount.'</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <table  style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td style="padding: 15px;">
                                <span style="display: block;">
                                    
                                    <span style="display:block;font-size:16px;line-height:22px;">GST: 33AAGCB7822G2ZT</span>
        
                                    <span style="display:block;font-size:16px;line-height:22px;font-weight:700;">Place of Supply: India</span>
                                    <span style="display:block;font-size:16px;line-height:22px;"><b>Registered Address:</b> AIRPORTZO INDIA PVT LTD</span>
                                    <span style="display:block;font-size:16px;line-height:22px;">Terms and Conditons of services as provided on <a href="mailto:www.airportzo.com" style="color: #07b4d2;">www.airportzo.com</a> shall apply</span>
                                    <span style="display:block;font-size:16px;line-height:22px;">For all booking queries please feel to write to us on <a href="mailto:support@airportzo.com" style="color: #07b4d2;">support@airportzo.com</a></span>
        
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tfoot>

</table>';
    return $htmlText2;
}
?>