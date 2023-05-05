<?php
$user_detail = new stdClass();
$user_detail->user_mail_id = 'premkumar@macappstudio.com'; 
$user_detail->user_name = 'Prem kumar';
$mailHtmlContent = '<h1>234567</h1>';
$mail_token = '1234';
send_email($user_detail,$mailHtmlContent,$mail_token);
function send_email($user_detail,$mailHtmlContent,$mail_token){
  require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
 // $mail->clearAllRecipients();
  $mail->isSMTP();                             // Set mailer to use SMTP
  $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
  $mail->addReplyTo('support@airportzostage.in');
  $mail->addAddress($user_detail->user_mail_id,$user_detail->user_name);
  $mail->Username = 'AKIAV2R6DX63ZQIJ4BOH';         // SMTP username
  $mail->Password = 'BFVfvRimImpUPviLikk1JBkW0UsCFVsXjyMfNS2O01s7'; // SMTP password
  $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
  $file_name =  'invoice_2621999510.pdf'; 
  $file_to_attach = '../../../../booking_pdf/invoice_2621999510.pdf';
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
      echo $file_name;
    return true;
  }
}
?>
<!--<iframe src="../../../../booking_pdf/invoice_2621999510.pdf" title="W3Schools Free Online Web Tutorials"></iframe>-->