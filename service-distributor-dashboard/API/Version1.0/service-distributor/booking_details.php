<?php
include '../../../../config/core.php';
$input_data = getInputs();
$distributor_token = $input_data->distributor_token;
$get_date = $input_data->get_date;
include_once '../objects/service-distributor.php';
$obj = new stdClass;
 $service_distributor = new ServiceDistributor();
   $stmt = $service_distributor->getDistributorBoooking($distributor_token,$get_date);
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Airport List";
    $obj->data = $stmt;
    echo json_encode($obj);

?>