<?php
$email_id='classrecording@teachze.com';
$user_name='karthick';

$obj = new stdClass();
$obj->email_id = $email_id;
$obj->user_name = $user_name;
$obj->mail_template = booking_invoince_content();
$obj->e_ticket = 'https://d1xqjehqvi7b4u.cloudfront.net/user/e_ticket/1666166014759.pdf';
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
    $mail->Subject = 'sdfgdfg';//$obj->subject;
    $mail->Body    = $obj->mail_template;
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;       
    $mail->isHTML(true);
    $mail->SMTPDebug = true;
    if ($obj->e_ticket != '') {
        $file = $obj->e_ticket;

        $file_split = explode(".", $file);
        $ext = array_pop($file_split);
        $file_name = "E-ticket." . $ext;

        $file_to_attach = getUrlContent($file);
        $tempFile = tempnam(getcwd(), 'mailattachment');  
        file_put_contents($tempFile, $file_to_attach);

        $mail->AddAttachment($tempFile, $file_name);
    }

    if(!$mail->Send()) {
        unlink($tempFile);

        return $mail->ErrorInfo;
    } else {
        unlink($tempFile);

        return true;
    }
}
function getUrlContent($url) {
    fopen("cookies.txt", "w");
    $parts = parse_url($url);
    $host = $parts['host'];
    $ch = curl_init();
    $header = array('GET /1575051 HTTP/1.1',
        "Host: {$host}",
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language:en-US,en;q=0.8',
        'Cache-Control:max-age=0',
        'Connection:keep-alive',
        'Host:adfoc.us',
        'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36',
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);

    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function admin_and_user_content() {
    $htmlText = '  <body>
                <main style="width: 80;margin:auto;margin-top: 50px;">
                    <table style="width:800px;margin:auto;box-shadow: 1px 1px 20px 2px #00000029;border-radius: 12px;overflow: hidden;">
                        <thead style="background-color:#07b4d2">
                            <tr>
                                <th>
                                    <table style="width: 90%;background-color: #ffff;border-radius: 14px;margin: 30px auto;padding:30px">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="https://airportzo.net.in/invoince-template/sterling-logo.webp" alt="logo" style="width: 144px;margin-bottom: 10px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size:26px;line-height:30px;font-family: sans-serif;font-weight: 700;color: #242424;padding-bottom: 5px;">MAA-DXB-FRA</span>
                                                    <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;">25 Jul 2022, 16:30(GMT +1) to 05 Aug 2022, 11:00(GMT +2)</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="display: block;border-bottom: 1px solid #f2f2f2;position: relative;margin: 30px 0px;">
                                                        <img src="https://airportzo.net.in/invoince-template/flight-icon.png" alt="flight icon" style="width: 38px;position: absolute;top: -19px;left: 50%;">
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <ul style="list-style-type: none;margin: 0px;padding: 0px;display: flex;align-items: center;justify-content: space-between;">
                                                        <li>
                                                            <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">7632548</span>
                                                        </li>
                                                        <li>
                                                            <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">7632548</span>
                                                        </li>
                                                        <li>
                                                            <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">7632548</span>
                                                        </li>
                                                        <li>
                                                            <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">7632548</span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px;">
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 20px;line-height: 24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: 700;">Services booked</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;margin-bottom: 15px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span>
                                                                    <span style="display:block;font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">MAA</span>
                                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Chennai international Airport - Terminal1</span>
                                                                    <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">25 Jun 2022, 16:30(GMT +1)</span>
                                                                </span>
                                                                <ul style="display: flex;list-style-type: none;margin: 0px;padding: 0px;padding-top: 30px;width: 100%;">
                                                                    <li style="width: 100%;display: flex;">
                                                                        <span style="display: block;margin-right:10px;">
                                                                            <img src="https://airportzo.net.in/invoince-template/product-logo.png" alt="" style="width: 55px;">
                                                                        </span>
                                                                        <span style="width:100%">
                                                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Pranaam</span>
                                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Order ID : 76435 | 16:45(GMT +1)</span>
                                                                            <span style="display: flex;justify-content: space-between;">
                                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Silver pack | 2 Adults</span>
                                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;">$1000</span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                <hr style="border-top: 1px solid #f2f2f2;">
                                                                <ul style="display: flex;list-style-type: none;margin: 0px;padding: 0px;padding-top: 30px;width: 100%;">
                                                                    <li style="width: 100%;display: flex;">
                                                                        <span style="display: block;margin-right:10px;">
                                                                            <img src="https://airportzo.net.in/invoince-template/product-logo.png" alt="" style="width: 55px;">
                                                                        </span>
                                                                        <span style="width:100%">
                                                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Pranaam</span>
                                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Order ID : 76435 | 16:45(GMT +1)</span>
                                                                            <span style="display: flex;justify-content: space-between;">
                                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Silver pack | 2 Adults</span>
                                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;">$1000</span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;margin-bottom: 15px;">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span>
                                                                    <span style="display:block;font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">DXB</span>
                                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Chennai international Airport - Terminal1</span>
                                                                </span>
                                                                <ul style="display: flex;list-style-type: none;margin: 0px;padding: 0px;padding-top: 30px;width: 100%;">
                                                                    <li style="width: 100%;display: flex;">
                                                                        <span style="display: block;margin-right:10px;">
                                                                            <img src="https://airportzo.net.in/invoince-template/product-logo.png" alt="" style="width: 55px;">
                                                                        </span>
                                                                        <span style="width:100%">
                                                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Pranaam</span>
                                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Order ID : 76435 | 16:45(GMT +1)</span>
                                                                            <span style="display: flex;justify-content: space-between;">
                                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Silver pack | 2 Adults</span>
                                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;">$1000</span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                                <hr style="border-top: 1px solid #f2f2f2;">
                                                                <ul style="display: flex;list-style-type: none;margin: 0px;padding: 0px;padding-top: 30px;width: 100%;">
                                                                    <li style="width: 100%;display: flex;">
                                                                        <span style="display: block;margin-right:10px;">
                                                                            <img src="https://airportzo.net.in/invoince-template/product-logo.png" alt="" style="width: 55px;">
                                                                        </span>
                                                                        <span style="width:100%">
                                                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Pranaam</span>
                                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Order ID : 76435 | 16:45(GMT +1)</span>
                                                                            <span style="display: flex;justify-content: space-between;">
                                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Silver pack | 2 Adults</span>
                                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;">$1000</span>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Contact Passenger details</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 20px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Gerard Nigel</span>
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                    <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(32 Years)</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Other Passenger details</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="display:flex;padding-bottom: 12px;">
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                        <span>    
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Jimmay Garza</span>
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                            <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(56 Years)</span>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="display:flex">
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">2)</span>
                                                        <span>    
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Jimmay Garza</span>
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                            <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(56 Years)</span>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Flight Details</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">MAA Flight Number</span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">IE98745</span>
                                                </td>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">GST Number</span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">HSDFI63458</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">FRA Flight Number</span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">ISR7843652</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">E-Ticket</span>
                                                    <img src="https://airportzo.net.in/invoince-template/e-ticket.png" alt="ticket cpy" style="width: 150px;">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">GSTIN Details</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Compeny Name</span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Macappstuduio</span>
                                                </td>
                                                <td style="padding-bottom: 10px;">
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">GST Number</span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">HSDFI63453458</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <table style="width: 100%;background-color:#fbfbfb;padding: 20px 30px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display: flex;">
                                                        <img src="https://airportzo.net.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Cancellation Policy</span>    
                                                    </span>
                                                    <ul style="padding-left: 20px;width: 50%;">
                                                        <li style="padding-bottom: 5px;">
                                                            <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                                                                <span style="width: 180px;">48 hours before</span>                                                    
                                                                <span style="width:40px;text-align:left">-</span>                                                    
                                                                <span>Full Refused</span>
                                                            </span>
                                                        </li>
                                                        <li style="padding-bottom: 5px;">
                                                            <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                                                                <span style="width: 180px;">24 hours before</span>                                                    
                                                                <span style="width:40px;text-align:left">-</span>                                                    
                                                                <span>25% of fare</span>
                                                            </span>
                                                        </li>
                                                        <li style="padding-bottom: 5px;">
                                                            <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                                                                <span style="width: 180px;">After 12hours</span>                                                    
                                                                <span style="width:40px;text-align:left">-</span>                                                    
                                                                <span>No Refused</span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="display: flex;">
                                                        <img src="exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Reshedule Policy</span>    
                                                    </span>
                                                    <ul style="padding-left: 20px;width: 100%;list-style-type: none;">
                                                        <li>
                                                            <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:35px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                                                                If you wish to reschedule any of the booked service, please contact +8764534345 or write us to support@airportzo.com
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;padding: 20px 30px 0px;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">Customer Support</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <ul style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                        <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                            <img src="https://airportzo.net.in/invoince-template/mail.png" alt="" style="width: 50px;margin-right: 10px;">
                                                            <span style="">
                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Mail Us</span>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;"><a href="mainto:Support@airportzo.com" style="color: #0091ff;text-decoration: none;">Support@airportzo.com</a></span>
                                                            </span>
                                                        </li>
                                                        <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                            <img src="https://airportzo.net.in/invoince-template/phone.png" alt="" style="width: 50px;margin-right: 10px;">
                                                            <span style="">
                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Call Us(Toll free)</span>
                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 24358734534</a></span>
                                                            </span>
                                                        </li>
                                                        <li style="display: flex;align-items:center;padding: 20px 0px;">
                                                            <img src="https://airportzo.net.in/invoince-template/watsapp.png" alt="" style="width: 50px;margin-right: 10px;">
                                                            <span style="">
                                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Watsapp</span>
                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 24358734534</a></span>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </main>
            </body>';
    return $htmlText;
}
function invoince_template_content() {
    $htmlText1 = '
            <table style="width:800px;margin:auto;box-shadow: 1px 1px 20px 2px #00000029;border-radius: 12px;overflow: hidden;background: #fbfbfb;">
                    <thead>
                        <tr>
                            <th>
                                <img src="https://airportzo.net.in/invoince-template/airportzo-logo.png" alt="logo" style="width:308px;margin: 20px auto;">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <table style="width: 90%;margin: auto;padding: 30px 0px 0px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Order ID : W7354</span>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Booked on : 01 Jun, 2022, 17:30(GMT +4)</span>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: normal;">Passengers : 2 Adults, 1 Child</span>                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <table style="width: 90%;background-color: #ffff;border-radius: 14px;margin: 20px auto 30px;padding:20px;border: 1px solid #eae2e2;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display: flex;align-items:center;margin: 10px auto;">
                                                    <img src="https://airportzo.net.in/invoince-template/flight-arrival.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                    <span>
                                                        <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Service at</span>
                                                        <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">Arrival</span>
                                                    </span>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="display: flex;align-items:center;margin: 10px auto;">
                                                    <img src="https://airportzo.net.in/invoince-template/calender.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                    <span>
                                                        <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Service avail date</span>
                                                        <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">04 Jul, 2022</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display: flex;align-items:center;margin: 10px auto;">
                                                    <img src="https://airportzo.net.in/invoince-template/clock.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                    <span>
                                                        <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Service avail time</span>
                                                        <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">16:00 (GMT +4)</span>
                                                    </span>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="display: flex;align-items:center;margin: 10px auto;">
                                                    <img src="https://airportzo.net.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                    <span>
                                                        <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Arrival Flight number</span>
                                                        <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">74863583</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #fff;">
                        <tr>
                            <td>
                                <table style="width: 100%;background-color:#22c482;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display: flex;align-items:center;justify-content:space-between;width: 90%;margin: 30px auto;">
                                                    <span style="display:block;font-size: 30px;line-height: 35px;font-family: sans-serif;color: #fff;text-align: left;font-weight: 700;">Silver</span>
                                                    <span style="display:block;font-size: 30px;line-height: 35px;font-family: sans-serif;color: #fff;text-align: left;font-weight: 700;">$ 1,200</span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px 0px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Contact Passenger details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="">
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Gerard Nigel</span>
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(32 Years)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Other Passenger details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                    <span>    
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Jimmay Garza</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                        <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(56 Years)</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display:flex">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">2)</span>
                                                    <span>    
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Jimmay Garza</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 67453654 | ra@ga.edu</span>
                                                        <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(56 Years)</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">E-Ticket</span>
                                                <img src="https://airportzo.net.in/invoince-template/e-ticket.png" alt="ticket cpy" style="width: 150px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">GSTIN Details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Compeny Name</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Macappstuduio</span>
                                            </td>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">GST Number</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">HSDFI63453458</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Notes</span>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Helo Zach! Welcome to India. We hope you have a greate experience and memories during your stay here. with lots of love from team Bullshark.</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px 0px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">Customer Support</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                        <img src="https://airportzo.net.in/invoince-template/mail.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Mail Us</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;"><a href="mainto:Support@airportzo.com" style="color: #0091ff;text-decoration: none;">Support@airportzo.com</a></span>
                                                        </span>
                                                    </li>
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                        <img src="https://airportzo.net.in/invoince-template/phone.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Call Us(Toll free)</span>
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 24358734534</span>
                                                        </span>
                                                    </li>
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;">
                                                        <img src="https://airportzo.net.in/invoince-template/watsapp.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Watsapp</span>
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 24358734534</span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tfoot>
                </table>';
    return $htmlText1;
}
function booking_invoince_content() {
    $htmlText2 = '
    <table cellspacing="0" cellpadding="0" border="0" style="width:800px;margin:auto;font-family: sans-serif;font-weight: 100;-moz-osx-font-smoothing: grayscale;-webkit-font-smoothing: antialiased;">
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
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 25%;border-right: 2px solid #cac1c1;">Confirmation No: XXXXXXX</th>
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 50%;border-right: 2px solid #cac1c1;">SERVICE CONFIRMATION VOUCHER FOR : WELCOME AND ASSIST</th>
                                            <th style="font-size:16px;line-height:22px;font-weight:700;padding: 5px;width: 25%;">Date:Sat, 09-Jul-2022</th>
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
                                                <span style="display:block;font-size:16px;line-height:22px;">To: AIRPORTZO INDIA PRIVATE LIMITED</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">GST NO: 07AAGCB7822G1ZP</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Contact: 98999 06806</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Email: support@airportzo.com</span>
                                            </td>
                                            <td style="width:50%;padding: 10px;">
                                                <span style="display:flex;font-size:16px;line-height:22px;">
                                                    <span>Address: </span>
                                                    <span style="margin-left: 10px;">
                                                        <span> XXXXXX</span>
                                                        <span style="display:block;font-size:16px;line-height:22px;">XXXXXX</span>
                                                        <span style="display:block;font-size:16px;line-height:22px;">XXXXXX</span>
                                                    </span>
                                                </span>
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
                                                <span style="display:block;font-size:16px;line-height:22px;">S23228165</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">From Airport</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Dubai International Airport</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">To Airport</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Jayprakash Narayan International Airport Patna</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Arrival/Departure Airline</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Flydubai /VISTARA</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Arrival/Departure Flight No.</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">FZ-431/UK-717</span>
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
                                                <span style="display:block;font-size:16px;line-height:22px;">Domestic</span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Service Detail & Terminal</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Mon, 11-Jul-2022 / Welcome and Assist / Transit </span>
                                            </td>
                                            <td style="width: 20%;padding: 10px;text-align: center;border-right: 2px solid #cac1c1;">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Booking Date & Time(IST)</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Sat, 09-Jul-2022 00:43</span>
                                            </td>
                                            <td style="width: 40%;padding: 10px;text-align: center;" colspan="2">
                                                <span style="font-size:16px;line-height:22px;font-weight:700;">Flight Date & Time(Local Time)</span>
                                                <span style="display:block;font-size:16px;line-height:22px;">Mon, 11-Jul-2022 03:20 Hrs (IST)</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong style="font-size:16px;line-height:22px;font-weight:700;padding: 10px;">PAYMENT REFERENCE ID: 6EXX 89 XX</strong>
                            </td>
                            <td colspan="2" style="text-align: center;">
                                <strong style="font-size:16px;line-height:22px;font-weight:700;">Service Date & Time(Local Time)</strong>
                                <span style="display:block;font-size:16px;line-height:22px;">Mon, 11-Jul-2022 03:20 Hrs (IST)</span>
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
                            <th style="padding: 10px;">Class</th>
                            <th style="padding: 10px;">Age (yrs.)</th>
                            <th style="padding: 10px;">PNR No.</th>
                            <th style="padding: 10px;">Identity Proof</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px;">1</td>
                            <td style="padding: 10px;">Meenakshi Rani</td>
                            <td style="padding: 10px;">Economy</td>
                            <td style="padding: 10px;"> </td>
                            <td style="padding: 10px;">V6ZTB6</td>
                            <td style="padding: 10px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;">
                                <span style="display: flex;justify-content:space-between">
                                    <strong>Name to be displayed on Placard : Ms. Meenakshi Rani</strong> 
                                    <strong>Placard Guest No : 971-545243474</strong>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;background-color: #07b4d2;color: #fff;">
                                <span style="display: flex;justify-content:space-between">
                                    <strong>Details of Atithya Services:</strong>
                                </span>
                            </td>
                        </tr>
                    </tbody>
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
                            <td style="padding: 5px 10px;" colspan="4">TRANSIT (INT-DOM) (Adult) 1 Qty        [HSN/SAC: 996331]</td>
                            <td style="padding: 5px 10px;text-align: right;">4067.8</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;" colspan="4">TRANSIT (INT-DOM) (Adult) 1 Qty        [HSN/SAC: 996331]</td>
                            <td style="padding: 5px 10px;text-align: right;">4067.8</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">Net Amount</td>
                            <td style="padding: 5px 10px;text-align: right;">₹8135.6</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">SGST (9%)</td>
                            <td style="padding: 5px 10px;text-align: right;">732.20</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">CGST (9%)</td>
                            <td style="padding: 5px 10px;text-align: right;">732.20</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;text-align: right;font-weight: 700;" colspan="4">Total</td>
                            <td style="padding: 5px 10px;text-align: right;">₹9600</td>
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
                                    <span style="display:block;font-size:16px;line-height:22px;font-weight:700;">XXXXX</span>
                                    <span style="display:block;font-size:16px;line-height:22px;">GST: XXXXX</span>
        
                                    <span style="display:block;font-size:16px;line-height:22px;font-weight:700;">Place of Supply: XXXXXXX</span>
                                    <span style="display:block;font-size:16px;line-height:22px;"><b>Registered Address:</b> XXXXXXXXXX</span>
                                    <span style="display:block;font-size:16px;line-height:22px;">Terms and Conditons of services as provided on <a href="mailto:www.encalm.com" style="color: #07b4d2;">www.encalm.com</a> shall apply</span>
                                    <span style="display:block;font-size:16px;line-height:22px;">For all booking queries please feel to write to us on <a href="mailto:guest.services@encalm.com" style="color: #07b4d2;">guest.services@encalm.com</a></span>
        
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tfoot>

</table>
    ';
    return $htmlText2;
}
?>