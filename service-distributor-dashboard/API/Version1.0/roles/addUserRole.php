<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
include_once '../objects/userRole.php';
$role = new userRole();
$role->serviceDistributorToken = $inputData->serviceDistributorToken;
$role->userRoleName      = trim($inputData->userRoleName);
$stmt = $role->userRoleNameCheck();
if($stmt->rowCount()==0){
    $role->modulesTokenArray = $inputData->modulesTokenArray;
    $role->gmDateTime        = $gm_date_time;
    $role->userRoleToken     = $onboard->generateToken('service__distributor_user_role','token');
    $role->addUserRole();
    $role->addUserModules();
    $obj->status_code = 201;
    $obj->message     = "Role created Successfully";
}else{
    $obj->status_code = 503;
    $obj->message     = "User role name already exists";
}
echo json_encode($obj);
?>