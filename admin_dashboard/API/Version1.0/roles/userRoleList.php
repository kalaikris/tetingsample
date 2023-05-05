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
    $stmt =  $role->userRoleList();
    $stmntModule = $role->adminModules();
    $obj->status_code = 201;
    $obj->roleData = $role->userRoleListView($stmt);
    $obj->moduleData = $role->adminModuleView($stmntModule);
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>