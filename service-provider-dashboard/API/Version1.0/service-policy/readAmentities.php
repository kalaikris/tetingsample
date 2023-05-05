<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->securedairportzo == 'secured'){
    include_once '../objects/service_policies.php';
    $obj = new stdClass;
    $my_amentities = new ServicePolicies();
    $stmt = $my_amentities->getserviceamentities();
    $num = $stmt->rowCount();
    if($num > 0){
        $data = $my_amentities->readServiceAmentities($stmt);
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Service Amentities List";
        $obj->service_amentitiesdata = $data;
    }else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Service Amentities Not Found!";
    }
echo json_encode($obj);
}
?>