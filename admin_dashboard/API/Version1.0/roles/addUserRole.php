<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
$admin->adminToken  = $inputData->adminToken;
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    include_once '../objects/userRole.php';
    $role = new userRole();
    $role->userRoleName  = trim($inputData->userRoleName);
    $stmt = $role->userRoleNameCheck();
    if($stmt->rowCount()==0){
        $role->modulesTokenArray = $inputData->modulesTokenArray;
        $role->gmDateTime        = $gm_date_time;
        $role->userRoleToken     = $admin->generateToken('service__distributor_user_role','token');
        $role->addUserRole();
        $role->addUserModules();
        $obj->status_code = 201;
        $obj->message     = "Role created Successfully";
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