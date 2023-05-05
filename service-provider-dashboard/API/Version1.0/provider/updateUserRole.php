<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/service-provider.php';
$provider = new ServiceProvider();
include_once '../objects/userRole.php';
$role = new userRole();
$role->serviceProviderCompanyLocationToken = $inputData->serviceProviderCompanyLocationToken;
$role->userRoleToken     = $inputData->userRoleToken;
$role->userRoleName      = trim($inputData->userRoleName);
$role->isMobileApp       = $inputData->isMobileApp;//0,1
$stmt = $role->userRoleNameUpdateCheck();
if($stmt->rowCount()==0){
    $role->modulesTokenArray = $inputData->modulesTokenArray;
    $role->gmDateTime        = $gm_date_time;
    $role->updateUserRole();
    if(count($role->modulesTokenArray)!=0){
        $role->updateUserModules();
    }
    $obj->status_code = 201;
    $obj->message     = "User role has been updated Successfully!";
}else{
    $obj->status_code = 503;
    $obj->message     = "User role name already exists";
}
echo json_encode($obj);
?>