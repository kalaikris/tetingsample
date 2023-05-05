<?php
class mailHtml extends Database{
    function bookingHtml($domainUrl,$user_detail,$description,$message){
        $htmlcontent = <<<EOD
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Agent reject mail</title>
        </head>
        <body style="margin: 0;font-family: sans-serif;text-align: left;">
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <tbody style="font-size: 18px;line-height: 28px;">
                    <tr>
                        <td>
                            <div style="max-width:600px;margin:0 auto;background-color:#f8f8f8;border-bottom:1px solid #e5e5e5;text-align: center;padding: 24px;box-sizing: border-box;">
                                <img src="$domainUrl/mail-template/Airportzo_logo@2x.png" alt="logo" style="width: 100%;max-width: 220px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;">
                                <p style="margin: 0 0 12px;">Hello 
                                <span style="font-weight: bold;">
                                    $user_detail->user_name</span>,
                                </p>
                                <p style="margin: 0 0 12px;">Description: <span>$description</span></p>
                                <p style="margin: 0 0 12px;">$message</p>
                                <p style="margin: 0 0 12px;">Thank You</p>
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
                                                    <img src="$domainUrl/mail-template/mail.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: 'Rubik', sans-serif;margin:0 0 5px;">Mail Us</p>
                                                    <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: 'Rubik', sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="$domainUrl/mail-template/call.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: 'Rubik', sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                    <p style="font-size:16px;font-family: 'Rubik', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="$domainUrl/mail-template/watsapp.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: 'Rubik', sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                    <p style="font-size:16px;font-family: 'Rubik', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
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
        </html>
        EOD;
        return $htmlcontent;
    }
}
?>