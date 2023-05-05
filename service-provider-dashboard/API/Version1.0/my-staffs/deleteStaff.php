<?php
include '../../../../config/core.php';
$input_data = getInputs();
include_once '../objects/myStaffs.php';
$obj = new stdClass;
$my_staffs = new MyStaffs();
$my_staffs->employee_token = $input_data->staff_token; 
$my_staffs->deleteMyStaffs();
$obj->status_code = 200;
$obj->title   = "Success";
$obj->message = "Staff Deleted Successfully";
echo json_encode($obj);
?>