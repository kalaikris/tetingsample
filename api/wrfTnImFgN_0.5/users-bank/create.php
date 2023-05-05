<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$is_primary = $input_data->is_primary;

include '../objects/users-bank.php';
$users_bank = new UsersBank();
$users_bank->user_token = $input_data->user_token;
$users_bank->token = genToken('users__bank');
$users_bank->account_number = $input_data->account_number;
$users_bank->ifsc_code = $input_data->ifsc_code;
$users_bank->branch_name = $input_data->branch_name;
$users_bank->is_primary = ($is_primary)? 1: 0;
$users_bank->date_time = $cur_date_time;

$obj = new stdClass;
if ($users_bank->create()) {
    $users_bank->readOne();
    $users_bank_detail = $users_bank->makeView()[0];

    if ($is_primary) {
        $users_bank->makeAllSecondary();
        $users_bank->makePrimary();
    }

    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Bank detail added successfully !";
    $obj->data = $users_bank_detail;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Bank couldn't added at the time !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
