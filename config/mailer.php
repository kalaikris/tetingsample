<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
function sendMail( $obj ) {
    require_once '/home/airportzostage/public_html/config/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    // $mail->clearAllRecipients();
    $mail->isSMTP();                                                            // Set mailer to use SMTP
    $mail->setFrom('support@airportzostage.in', 'Airportzo');
    $mail->addReplyTo('support@airportzostage.in');
    $mail->addAddress($obj->email_id, $obj->user_name);
    // $mail->addBCC('edberg@macappstudio.com');
    // $mail->addCC('senthil@macappstudio.com');
    $mail->Username = 'AKIAV2R6DX63VVY4RKWB';                                   // SMTP username
    $mail->Password = 'BNtxUT/eWDk1iNMVi5hLHVFiZjwGyQRkXWx51vziHu/u';           // SMTP password
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';                        //'smtp.gmail.com';
                                                                                // Specify main and backup SMTP servers
    $mail->Subject = $obj->subject;
    $mail->Body = $obj->mail_template;
    $mail->SMTPAuth = true;                                                     // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;  
    // $mail->SMTPDebug = 2;
    $mail->isHTML(true);
    
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
    if ($obj->invoice_pdf != '') {

        $mail->addStringAttachment($obj->invoice_pdf,$obj->invoice_name, $encoding = 'base64', $type = 'application/pdf');
    }
    
    if(!$mail->Send()) {
        if ($obj->e_ticket != '') unlink($tempFile);

        return $mail->ErrorInfo;
    } else {
        if ($obj->e_ticket != '') unlink($tempFile);
        
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
?>