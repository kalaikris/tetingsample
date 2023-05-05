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
$role->userRoleName      = trim($inputData->userRoleName);
$role->isMobileApp       = $inputData->isMobileApp;//0,1
$stmt = $role->userRoleNameCheck();
if($stmt->rowCount()==0){
    $role->modulesTokenArray = $inputData->modulesTokenArray;
    $role->gmDateTime        = $gm_date_time;
    $role->userRoleToken     = $provider->tokenGenerate('service__provider_company_location_user_role','token');
    $role->addUserRole();
    if(count($role->modulesTokenArray)!=0){
        $role->addUserModules();
    }
    $obj->status_code = 201;
    $obj->message     = "Role created Successfully";
}else{
    $obj->status_code = 503;
    $obj->message     = "User role name already exists";
}
echo json_encode($obj);
?>