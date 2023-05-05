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
    if($inputData->type == 'service_type'){
        $stmt = $admin->getBusinessType();
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Business Info Drop Down Values";
        $obj->data = $stmt;
    }else if($inputData->type == 'service_distributor_name'){
        $sitename = '';
        foreach($inputData->appType as $appValue){ 
            if($appValue == '1'){
                $sitename = $admin->getServiceDistributorName();
            }
        }
        if($sitename == ''){
            $obj->status_code = 200;
        }else{
            $obj->status_code = 201;
        } 
        $obj->title = "Success";
        $obj->message = "Distributor Name";
        $obj->data = $sitename;
    }
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>