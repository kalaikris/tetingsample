<?php
include '../../../../config/core.php';
$input_data = getInputs();
include_once '../objects/myStaffs.php';
$obj = new stdClass;
$my_staffs = new MyStaffs();
    if($input_data->type == 'update_staff'){
        $my_staffs->employee_token = $input_data->staff_token; 
        $my_staffs->employee_id    = $input_data->employee_id;
        $stmt = $my_staffs->checkEmployeeIdUpdateExist();
        $num = $stmt->rowCount();
        if($num==0){
            $my_staffs->employee_image = $input_data->employee_image;
            $my_staffs->employee_primary_title = $input_data->employee_primary_title;
            $my_staffs->employee_name  = $input_data->employee_name;
            $my_staffs->employee_email = $input_data->employee_email;
            $my_staffs->employee_country_code = $input_data->employee_country_code;
            $my_staffs->employee_mobile_number= $input_data->employee_mobile_number;
            $my_staffs->employee_user_role    = $input_data->employee_user_role;
            if($my_staffs->updateMyStaffs()){
                $obj->status_code = 200;
                $obj->title = "Success";
                $obj->message = "Staff Updated Successfully";
            }else {
                $obj->status_code = 400;
                $obj->title = "Oops";
                $obj->message = "Not able to add staff!"; 
            }
        }else{
             $obj->status_code = 400;
             $obj->title = "Oops";
             $obj->message = "Employee Id Already Exists!"; 
        }    
    }else{
         $obj->status_code = 400;
         $obj->title = "Oops";
         if($input_data->type != 'insert_staff'){
            $obj->message = "Please check the type!";  
         }else{
            $obj->message = "Please provide employee id!";   
         }
    }
echo json_encode($obj);
?>