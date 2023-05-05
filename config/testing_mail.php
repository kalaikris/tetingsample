<?php
$domainUrl = "https://airportzostage.in";
$htmlcontent = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Distributor mail</title>
            </head>
            <body style="margin: 0;font-family: sans-serif;text-align: left;">
                <table style="max-width: 700px;width: 100%;margin: 0 auto;background-color:#f8f8f8;">
                    <thead>
                      <tr>
                        <th style="display:block;width:82%;margin: 0 auto;padding:24px 0;text-align: center;border-bottom: 1px solid #e3e3e3;">
                          <img src="'.$domainUrl.'/mail-template/Airportzo_logo@2x.png" alt="logo" style="width: 100%;max-width: 220px;">
                        </th>
                      </tr>
                    </thead>
                    <tbody style="display:block;font-size: 18px;line-height: 28px;">
                      <tr>
                        <td style="padding-bottom: 105px;border-bottom: 2px solid #e3e3e3;">
                          <div style="width: 82%;margin: 0 auto;">
                            <p>Created on : <span>'.$date.'</span></p>
                            <p>Hello <span style="font-weight: bold;">Prem kumar</span>,</p>
                            <p>Congratulations! For partnering with us. Here some important credentials for your bussiness login. Please save this email so you can refer to it later also.</p>
                            <p>Your login credentials are here</p>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="background-color: #fff;padding-bottom: 40px;border-bottom: 2px solid #e3e3e3;">
                            <div style="width:72%;background-color: #fff;border-radius: 12px;border:2px solid #e3e3e3;padding: 32px;margin: 0 auto;transform: translateY(-50%);">
                              <div style="display: flex;align-items: center;margin-bottom: 24px;">
                                <img src="'.$domainUrl.'/mail-template/username.svg" alt="">
                                <div style="margin-left: 20px;">
                                  <p style="font-size:15px;margin-bottom: 0;margin-top: 0;">User Name</p>
                                  <p style="font-size:22px;font-weight: bold;margin: 0;letter-spacing: 0.6px;">Prem kumar</p>
                                </div>
                              </div>
                              <div style="display: flex;align-items: center;">
                                <img src="'.$domainUrl.'/mail-template/password.svg" alt="">
                                <div style="margin-left: 20px;">
                                  <p style="font-size:15px;margin-bottom: 0;margin-top: 0;">Password</p>
                                  <p style="font-size:22px;font-weight: bold;margin: 0;letter-spacing: 0.8px;">paswv3ve3v</p>
                                </div>
                              </div>
                            </div>
                            <div style="width:82%;margin: -75px auto 0;">
                                <p style="font-size:22px;font-weight: bold;margin: 0;letter-spacing: 0.8px;margin: 16px 0;">Ready to service?</p>
                                <a href="'.$domainUrl.'/service-distributor-dashboard/login.php" style="display: inline-block;width: 100%;max-width: 235px;background-color: #84BE40;text-decoration: none;text-align: center;border-radius: 12px;color: white;padding: 16px;font-weight: bold;">Login now</a>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td style="padding:32px 0;display: block;width: 82%;margin: 0 auto;">
                          <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;padding-bottom: 20px;border-bottom:1px solid #e5e5e5;">
                            <img src="'.$domainUrl.'/mail-template/mail.svg" alt="">
                            <div style="margin-left: 20px;">
                              <p style="font-size:15px;margin-bottom: 4px;margin-top: 0;">Mail Us</p>
                              <a style="font-size:20px;color:#0091ff;text-decoration:none;letter-spacing: 0.6px;">support@airportzo.com</a>
                            </div>
                          </div>
                          <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;padding-bottom: 20px;border-bottom:1px solid #e5e5e5;">
                            <img src="'.$domainUrl.'/mail-template/call.svg" alt="">
                            <div style="margin-left: 20px;">
                              <p style="font-size:15px;margin-bottom: 4px;margin-top: 0;">Call Us (Toll Free)</p>
                              <p style="font-size:20px;margin: 0;letter-spacing: 0.6px;">+91 8610725198</p>
                            </div>
                          </div>
                          <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;">
                            <img src="'.$domainUrl.'/mail-template/watsapp.svg" alt="">
                            <div style="margin-left: 20px;">
                              <p style="font-size:15px;margin-bottom: 4px;margin-top: 0;">Whatsapp</p>
                              <p style="font-size:20px;margin: 0;letter-spacing: 0.6px;">+91 8610725198</p>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tfoot>
                </table>
            </body>
            </html>';
           // echo $htmlcontent;
send_distributor_credentials($htmlcontent);

function send_distributor_credentials($htmlcontent){
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    // $mail->clearAllRecipients();
    $mail->isSMTP();                             // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo Admin');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress('premkumar@macappstudio.com','Prem kumar');
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';         // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u'; // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';//'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->Subject = "Distibutor Credentials";
    $mail->Body    = $htmlcontent;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    //$mail->SMTPDebug = 2 ; 
    //Attachments
    //$mail->addAttachment('/home/airportzostage/public_html/config/extAPI.json','extAPI.json');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name 
    $file_split = explode(".", $file);
        $ext = array_pop($file_split);
        $file_name = "E-ticket." . $ext;

        $file_to_attach = getUrlContent($file);
        $tempFile = tempnam(getcwd(), 'mailattachment');  
        file_put_contents($tempFile, $file_to_attach);

        $mail->AddAttachment($tempFile, $file_name);
    

    $mail->Port = 587;       
    $mail->isHTML(true);
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    }else{
        return true;
    }
}
?>