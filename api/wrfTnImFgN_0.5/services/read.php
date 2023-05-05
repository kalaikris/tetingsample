<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$user_token = $input_data->user_token;

include_once '../objects/services.php';
$services = new Services();
$services->read();

include_once '../objects/avail-service.php';
$avail_service = new AvailService();
$avail_service->read();

include_once '../objects/our-partners.php';
$our_partners = new OurPartners();
$our_partners->readOurPartners();

include '../objects/users.php';
$users = new Users();
$users->token = $user_token;
$users->getUserDetail();

include '../objects/users-booking.php';
$users_booking = new UsersBooking();
$users_booking->user_token = $user_token;
$users_booking->readForUser();

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
    $user_detail = $users->makeView()[0];

    if ($user_detail->status == 'Active' || $users_booking->stmt->rowCount() > 0) {
        $obj->status_code = 200;
        $obj->message = "User detail found !";
        $obj->data = $services->makeView();
        $obj->user_data = $user_detail;
        $obj->avail_service = $avail_service->makeView();
        $obj->our_partners = $our_partners->makeView();
        $obj->booking_data = array_slice($users_booking->makeView(),0, 4);
    } else {
        $obj->status_code = 400;
        $obj->message = "User blocked ! Please contact support !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 200;
    $obj->message = "Data Found !";
    $obj->data = $services->makeView();
    $obj->avail_service = $avail_service->makeView();
    $obj->our_partners = $our_partners->makeView();
}
echo json_encode($obj);
?>