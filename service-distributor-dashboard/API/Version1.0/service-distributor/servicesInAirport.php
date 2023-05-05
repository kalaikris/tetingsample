<?php
include '../../../../config/core.php';
//$input_data = getInputs();
//if($input_data->securedairportzo == 'chooseService'){
    $data = '[6767676767,9876543210]';
    $input = json_decode($data);
    include_once '../objects/service-distributor.php';
    $obj = new stdClass;
    $service_distributor = new ServiceDistributor();
    $serviceLists = implode(",",$input);
    //$serviceLists = implode(",",$input_data->selectedService);
    $stmt = $service_distributor->getServiceAvailableAirport();
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Airport List";
    $obj->data = $stmt;
    echo json_encode($obj);
//}
?>