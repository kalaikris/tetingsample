<?php
// ini_set('display_errors', 1); //show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/users.php';
$users = new Users();
$users->token = $input_data->user_token;
$users->getUserDetail();

$obj = new stdClass;
if ($users->stmt->rowCount() > 0) {
    $users->is_agent = 1;
    $users->title = $input_data->title;
    $users->name = $input_data->name;
    $users->image = $input_data->image;
    $users->country_code = $input_data->country_code;
    $users->mobile_number = $input_data->mobile_number;
    $users->email = $input_data->email;
    $users->dob = date("Y-m-d", strtotime($input_data->dob));
    $users->address = $input_data->address;
    $users->country_id = $input_data->country_id;
    $users->state_id = $input_data->state_id;
    $users->city_id = $input_data->city_id;
    $users->pincode = $input_data->pincode;
    $users->account_number = $input_data->account_number;
    $users->ifsc_code = $input_data->ifsc_code;
    $users->branch_name = $input_data->branch_name;
    $users->pan_card = $input_data->pan_card;
    $users->address_proof = $input_data->address_proof;

    if ($users->becomeAgent()) {
        $users->getUserDetail();

        include '../objects/users-bank.php';
        $users_bank = new UsersBank();
        $users_bank->user_token = $input_data->user_token;
        $users_bank->token = genToken('users__bank');
        $users_bank->account_number = $input_data->account_number;
        $users_bank->ifsc_code = $input_data->ifsc_code;
        $users_bank->branch_name = $input_data->branch_name;
        $users_bank->is_primary = 1;
        $users_bank->date_time = $cur_date_time;
        $users_bank->create();

        $obj->status_code = 200;
        $obj->message = "User detail updated successfully !";
        $obj->data = $users->makeView()[0];
    } else {
        $obj->status_code = 400;
        $obj->message = "User update error !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
    $obj->message = "User detail error !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>