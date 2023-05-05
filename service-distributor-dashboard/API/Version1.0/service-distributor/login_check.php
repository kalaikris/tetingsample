<?php
include '../../../../config/core.php';
$input_data = getInputs();
$distributor_token = $input_data->business_id;
$password = hashPassword($input_data->password);
include_once '../objects/service-distributor.php';
$obj = new stdClass;
 $service_distributor = new ServiceDistributor();
   $stmt = $service_distributor->login_detail($distributor_token,$password);
   if($stmt == true){
    $obj->status_code = 200;
   }
   else
   {
    $obj->status_code = 400;
   }
    // $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Airport List";
    $obj->data = $stmt;
    echo json_encode($obj);

?>