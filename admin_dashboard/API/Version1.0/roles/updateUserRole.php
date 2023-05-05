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
    include_once '../objects/userRole.php';
    $role = new userRole();
    $role->userRoleToken     = $inputData->userRoleToken;
    $role->userRoleName      = trim($inputData->userRoleName);
    $stmt = $role->userRoleNameUpdateCheck();
    if($stmt->rowCount()==0){
        $role->modulesTokenArray = $inputData->modulesTokenArray;
        $role->gmDateTime        = $gm_date_time;
        $role->updateUserRole();
        $role->updateUserModules();
        $obj->status_code = 201;
        $obj->message     = "User role has been updated Successfully!";
    }else{
        $obj->status_code = 503;
        $obj->message     = "User role name already exists";
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);




?>