<?php
function send_contact_mail($name,$email,$subject,$message) {
    $userEmail = 'pravin@macappstudio.com';
    
    $html = contact_us_template($name,$email,$subject,$message);
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($userEmail, 'AirportZo');
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u';
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';
    $mail->Subject = "Contact US";
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

function contact_us_template($name,$email,$subject,$message) {
$htmlText2 = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
                        <p style="margin: 0 0 12px;">Hello <span style="font-weight: bold;">'.$name.'</span></p>
                        <p style="margin: 0 0 12px;">Email: <span style="font-weight: bold;">'.$email.'</span></p>
                        <p style="margin: 0 0 12px;">Subject: <span style="font-weight: bold;">'.$subject.'</span></p>
                        <p style="margin: 0 0 12px;">Message: '.$message.'</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;background-color:#f8f8f8;border-top:1px solid #e5e5e5;">
                        <table style="width: 100%;" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                        <div style="margin-right: 12px;">
                                            <img src="https://airportzostage.in/invoince-template/mail.png" alt="" width="36" style="">
                                        </div>
                                    </td>
                                    <td style="padding-bottom: 24px;">
                                        <div>
                                            <p style="color:#8E8F91;font-size:13px;font-family: "Rubik", sans-serif;margin:0 0 5px;">Mail Us</p>
                                            <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: "Rubik", sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                        <div style="margin-right: 12px;">
                                            <img src="https://airportzostage.in/invoince-template/phone.png" alt="" width="36" style="">
                                        </div>
                                    </td>
                                    <td style="padding-bottom: 24px;">
                                        <div>
                                            <p style="color:#8E8F91;font-size:13px;font-family: "Rubik", sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                            <p style="font-size:16px;font-family: "Rubik", sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="center" style="width: 36px;">
                                        <div style="margin-right: 12px;">
                                            <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" width="36" style="">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p style="color:#8E8F91;font-size:13px;font-family: "Rubik", sans-serif;margin:0 0 5px;">Whatsapp</p>
                                            <p style="font-size:16px;font-family: "Rubik", sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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