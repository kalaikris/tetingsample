<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$site_name = get_service_distributor();

include_once '../objects/service-distributor.php';
$service__distributor = new ServiceDistributor();
$service__distributor->site_name = $site_name;
$service__distributor->readDistributorDynamicDataBySitename();

$obj = new stdClass;
if ($service__distributor->stmt->rowCount() > 0) {
    $service__distributor_data = $service__distributor->makeView()[0];
    $service_distributor_token = $service__distributor_data->token;

    include_once '../objects/services.php';
    $services = new Services();
    $services->distributor_token = $service_distributor_token;
    $services->readServicesForDistributor();
    if ($services->stmt->rowCount() > 0) {
        $obj->status_code = 200;
        $obj->title = "Success";
        $obj->message = "Success";
        $obj->data = $services->makeView();
    } else {
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "No services found !";
        $obj->data = new stdClass;
    }
} else {
    $obj->status_code = 400;
	$obj->title = "Oops";
	$obj->message = "Distributor error !";
	$obj->data = new stdClass;
}
echo json_encode($obj);
?>