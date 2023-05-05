<?php
session_start();
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
// $_SESSION['usr_token'] = 9988776655;

include '../../../config/core.php';
// $cookie_name = "airportzo-usr-token";

$obj = new stdClass;
// if (isset($_SESSION[$cookie_name])) {
    $input_data = getInputs();

    include '../objects/contact-details.php';
    $contact_info = new ContactDetails();
    $contact_info->token = genToken('contact_us');
    // $contact_info->user_token = $_SESSION[$cookie_name];
    $contact_info->name = $input_data->user_name;
    $contact_info->email = $input_data->user_email;
    $contact_info->subject = $input_data->user_subject;
    $contact_info->message = xss_clean($input_data->user_feedback);
    $contact_info->platform_type = 'White-label';
    $contact_info->date_time = $gm_date_time;
    $checkcount = $contact_info->readOne();

    if ($checkcount->rowCount() == 0) {
        $contact_info->create();

        include_once '../../../config/contact-us-mail.php';
        ob_start();
        send_contact_mail($input_data->user_name,$input_data->user_email,$input_data->user_subject,$input_data->user_feedback);
        ob_clean();

        $checkcount = $contact_info->readOne();
        $contact_details = $contact_info->makeView($checkcount);
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Thank you for getting in touch with us. One of our executive will contact you shortly.";
        $obj->data = $contact_details;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Contact name and message exists!";
        $obj->data = new stdClass;
    }
// } else {
//     $obj->status_code = 400;
//     $obj->message = "No login found ! Please login again !";
//     $obj->data = new stdClass;
// }
echo json_encode($obj);
?>