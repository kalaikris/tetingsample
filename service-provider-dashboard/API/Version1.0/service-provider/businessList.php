<?php
include '../../../../config/core.php';
$input_data = getInputs();
    include_once '../objects/service-provider.php';
    $obj = new stdClass;
    $service_provider = new ServiceProvider();
    $service_provider->service_token = $input_data->service_token;
    $service_provider->userToken     = $input_data->userToken;
    $service_provider->isAdmin = $service_provider->adminCheck();
    $stmt = $service_provider->businessList();
    $num = $stmt->rowCount();
    if ($num > 0) {
        $data = $service_provider->readBusinessList($stmt);
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Company List";
        $obj->company_list = $data;
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Company is not available at this service token"; 
    }
echo json_encode($obj);
?>