<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->securedairportzo == 'secured'){
    include_once '../objects/myStaffs.php';
    $obj = new stdClass;
    $my_staffs = new MyStaffs();
    $my_staffs->serviceProviderCompanyLocationToken = $input_data->serviceProviderCompanyLocationToken;
    
    $stmt = $my_staffs->getUserRoles();
    $stmntModule = $my_staffs->ProviderModules();
    $num = $stmt->rowCount();
    if ($num > 0) {
        $data = $my_staffs->readUserRoles($stmt);
        $Moduledata = $my_staffs->ProviderModuleView($stmntModule);
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "User Roles List";
        $obj->userrole_data = $data;
        $obj->module_data = $Moduledata;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "User Roles not found!"; 
    }
echo json_encode($obj);
}
?>