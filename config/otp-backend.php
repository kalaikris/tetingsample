<?php
function sendBB_Mail($otp) {
    $userEmail = 'pravin@macappstudio.com';
    
    $html = backend_booking_otp($otp);
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($userEmail, 'AirportZo');
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u';
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';
    $mail->Subject = "BackEnd Booking OTP";
    $mail->Body = $html;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);
    $mail->SMTPDebug = 1;                           
    if(!$mail->send())
    {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}

function backend_booking_otp($otp) {
        $htmlText2 = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Backend Booking Mail</title>
            </head>
            <body style="margin: 0;font-family: sans-serif;text-align: left;">
                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                    <tbody style="font-size: 18px;line-height: 28px;">
                        <tr>
                            <td>
                                <div style="max-width:600px;margin:0 auto;background-color:#f8f8f8;border-bottom:1px solid #e5e5e5;text-align: center;padding: 24px;box-sizing: border-box;">
                                    <img src="https://airportzo.net.in/mail-template/Airportzo_logo@2x.png" alt="logo" style="width: 100%;max-width: 220px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;">
                                    <p style="margin: 0 0 12px;">Dear <span style="font-weight: bold;">Team</span>,</p>
                                    <p style="margin: 0 0 12px;"><span>'.$otp.'</span> is your OTP to manage the backend bookings.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>';
    return $htmlText2;
}
?>