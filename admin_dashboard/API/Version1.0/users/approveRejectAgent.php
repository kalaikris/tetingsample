<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$stmt = $admin->userCheck();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/appUsers.php';
    $appUsers = new appUsers();
    $appUsers->userToken  = $inputData->userToken;
    $appUsers->status     = $inputData->status;
    $obj->status_code = 201;
    $appUsers->approveRejectAgent();
    include_once '../../../../config/distributor_mail.php';
    $user_detail = $appUsers->getUserMailDetails();
    if($appUsers->status==1){
        $obj->message = "Approved Successfully";
        $imageUrl     = "$domainUrl/mail-template/accept-mail.png";
        $header       = "Agent accept mail";
        $htmlText     = <<<EOD
            <p>Hello <span style="font-weight: bold;">$user_detail->user_name</span>,</p>
            <p>Congratulations! For partnering as agent with us. Here's some important credentials for your bussiness login. Please save this email so you can refer to it later also.</p>
        EOD;
    }else{
        $obj->message = "Rejected Successfully";
        $imageUrl     = "$domainUrl/mail-template/reject-mail.png";
        $header       = "Agent reject mail";
        $htmlText     = <<<EOD
            <p>Hello <span style="font-weight: bold;">$user_detail->user_name</span>,</p>
            <p>We are sorry to say that your Agent request has been rejected. For further details Contact us.</p>
        EOD;
    }
    $htmlcontent = <<<EOD
    <!DOCTYPE html>
        <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Agent accept mail</title>
        </head>
        <body style="margin: 0;font-family: sans-serif;text-align: left;">
            <table style="max-width: 700px;width: 100%;margin: 0 auto;background-color:#f8f8f8;">
            <thead>
                <tr>
                    <th style="display:block;width:82%;margin: 0 auto;padding:24px 0;text-align: center;border-bottom: 1px solid #e3e3e3;">
                        <img src="$domainUrl/mail-template/Airportzo_logo@2x.png" alt="logo" style="width: 100%;max-width: 220px;">
                    </th>
                </tr>
            </thead>
            <tbody style="display:block;font-size: 18px;line-height: 28px;">
                <tr>
                    <td style="padding-bottom: 32px;border-bottom: 2px solid #e3e3e3;">
                        <div style="width: 82%;margin: 0 auto;">
                            $htmlText
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #fff;padding-top:32px;padding-bottom: 32px;border-bottom: 2px solid #e3e3e3;">
                        <div style="text-align: center;">
                            <img src="$imageUrl" alt="" style="width:100%;">
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="padding:32px 0;display: block;width: 82%;margin: 0 auto;">
                        <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;padding-bottom: 20px;border-bottom:1px solid #e5e5e5;">
                            <img src="$domainUrl/mail-template/mail.png" alt="">
                            <div style="margin-left: 20px;">
                                <p style="font-size:15px;margin-bottom: 4px;margin-top: 0;">Mail Us</p>
                                <a style="font-size:20px;color:#0091ff;text-decoration:none;letter-spacing: 0.6px;">support@airportzo.com</a>
                            </div>
                        </div>
                        <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;padding-bottom: 20px;border-bottom:1px solid #e5e5e5;">
                            <img src="$domainUrl/mail-template/call.png" alt="">
                            <div style="margin-left: 20px;">
                                <p style="font-size:15px;margin-bottom: 4px;margin-top: 0;">Call Us (Toll Free)</p>
                                <p style="font-size:20px;margin: 0;letter-spacing: 0.6px;">+91 8610725198</p>
                            </div>
                        </div>
                        <div style="width: 70%;display: flex;align-items: center;margin-bottom: 24px;">
                            <img src="$domainUrl/mail-template/watsapp.png" alt="">
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
        </html>
    EOD;
    approve_agent($user_detail,$htmlcontent,$header);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>