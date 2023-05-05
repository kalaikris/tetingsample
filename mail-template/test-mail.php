<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$email_id='pravin@macappstudio.com';
$user_name='Sandy';

include 'mailer-template.php';
$MailTemplateOrder = new MailTemplateOrder();

$obj = new stdClass();
$obj->email_id = $email_id;
$obj->user_name = $user_name;
$obj->mail_template = $MailTemplateOrder->test_content();
// $obj->e_ticket = 'https://d1xqjehqvi7b4u.cloudfront.net/user/e_ticket/1666166014759.pdf';
 echo send_email($obj);

function send_email($obj) {
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    // $mail->clearAllRecipients();
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($obj->email_id,$obj->user_name);
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers

    
    // $mail->addStringAttachment(file_get_contents($file_to_attach),'invoice_4148154539.pdf', $encoding = 'base64', $type = 'application/pdf'); 
    $mail->Subject = 'Outlook mail Testing Purpose';//$obj->subject;
    $mail->Body    = $obj->mail_template;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;       
    $mail->isHTML(true);

    // if ($obj->e_ticket != '') {
    //     $file = $obj->e_ticket;

    //     $file_split = explode(".", $file);
    //     $ext = array_pop($file_split);
    //     $file_name = "E-ticket." . $ext;

    //     $file_to_attach = getUrlContent($file);
    //     $tempFile = tempnam(getcwd(), 'mailattachment');  
    //     file_put_contents($tempFile, $file_to_attach);

    //     $mail->AddAttachment($tempFile, $file_name);
    // }

    if(!$mail->Send()) {
        // unlink($tempFile);
        return $mail->ErrorInfo;
    } else {
        // unlink($tempFile);
        return true;
    }
}

function test_content() {
    $htmlText = '<table cellpadding="0" cellspacing="0" border="0" style="width: 100%;background-color: #fff;max-width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px;box-sizing: border-box;">
                           <div style="padding: 10px 0 32px;text-align: center;border-bottom:2px solid #eaeaea;">
                              <img style="max-width: 250px;width:100%;" src="https://airportzostage.in/mail-template/Airportzo_logo@2x.png" alt="">
                           </div>
                           <div>
                              <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;font-weight:600;">Dear Mr.Suresh,</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.200/-per order.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>
                           </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;background-color: #07b4d2;padding: 24px 40px;box-sizing: border-box;">
                          <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                            <div style="text-align: center;">
                                <span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CANCELLED</span>
                            </div>
                            <div style="text-align:center;">
	                            <h2 style="font-family:sans-serif;text-align: center;margin:16px 0 10px;">MAA - DXB - FRA</h2>
	                            <p style="font-size:16px;font-family:sans-serif;text-align: center;margin:10px 0;color: #4b4b4b;">22 Jul 2022, 16.30(GMT+1) to 05 Aug 2022, 11:00(GMT+2)</p>
                            </div>
                            <div style="text-align: center;border-bottom: 1px solid #eaeaea;margin-top:16px;margin-bottom: 24px;height:16px;">
                                <img src="https://airportzostage.in/mail-template/circle-plane.png" alt="" style="margin-bottom: -18px;">
                            </div>
                            <table style="width: 100%;" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking ID</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">97678298</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking Date</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">24 Jun 2022</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Passengers</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">2 Adults, 2 Children</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Total Services</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">4 services</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px 5px;box-sizing: border-box;">
                            <h3 style="font-size:18px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom: 12px;">Services cancelled</h3>
                            <div>
                                <div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <h3 style="font-size:20px;font-family:sans-serif;margin:0;"></h3>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;">Chennai International Airport - Terminal 1</p>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;">Chennai International Airport - Terminal 1</p>
                                    <p style="font-size: 14px;font-family:ans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">22 Jul 2022, 16.30(GMT+1)</p>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <img src="https://airportzostage.in/mail-template/pranaam.jpg" alt="" width="50" height="50" style="width:50px;height:50px;border-radius: 50%;margin-right: 5px;">
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <span style="font-size:18px;font-family:ans-serif;font-weight: 700;margin:2px 0 4px;">Pranaam</span>
                                                        <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:ans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;padding:0 0 0 25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                    <div style="max-width:500px;height: 1px;border-bottom: 1px solid #eaeaea;margin: 20px auto 20px;"></div>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <div style="width: 50px;height: 50px;border-radius: 50%;margin-right: 5px;">
                                                        <img src="https://airportzostage.in/mail-template/pranaam.jpg" alt="" width="50" height="50" style="border-radius: 50%;object-fit: contain;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <p style="font-family:ans-serif;font-weight: 500;margin:2px 0 4px;">Pranaam</p>
                                                        <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:ans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;background-color: #f6f6f6;">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0" style="background-color: #f6f6f6;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="background-color: #f6f6f6;">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <p style="font-size:20px;font-family:sans-serif;font-weight: 500;margin:0 0 5px;">MAA</p>
                                    <p style="font-size:16px;font-family:ans-serif;margin:0 0 5px;color: #4b4b4b">Chennai International Airport - Terminal 1</p>
                                    <p style="font-size: 14px;font-family:ans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">22 Jul 2022, 16.30(GMT+1)</p>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <div style="width: 50px;height: 50px;border-radius: 50%;margin-right: 5px;">
                                                        <img src="https://airportzostage.in/mail-template/primefly.jpg" alt="" width="50" height="50" style="border-radius: 50%;object-fit: contain;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <p style="font-family:ans-serif;font-weight: 500;margin:2px 0 4px;">Primefly</p>
                                                        <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:ans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:ans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="">
                                             <p style="font-size: 14px;font-family:ans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: ans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 20px;padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Contact Passenger details</p>
                                    <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">Mr. Gerard Nigel</p>
                                    <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                    <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                </div>
                                <div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Other Passenger details</p>
                                    <div style="margin-bottom: 12px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">1) Mr. Gerard Nigel</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                        <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                    </div>
                                    <div style="margin-bottom: 16px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">2) Mr. Gerard Nigel</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                        <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Flight Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">E-Ticket</p>
                                </div>
                            </div>
                            <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">GSTIN Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Company Name</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">GST Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #f6f6f6;border-top:2px solid #eaeaea;max-width: 650px;margin: 0 auto;padding: 24px 56px 24px;box-sizing: border-box;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:24px;">Customer Support</p>
                            <table style="width: 100%;" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/mail.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Mail Us</p>
                                                <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/call.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/watsapp.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>';
    return $htmlText;
}
?>