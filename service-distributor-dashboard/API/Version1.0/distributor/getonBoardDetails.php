<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/onboard.php';
$onboard = new onboard();
$onboard->userToken       = $inputData->userToken;
$onboard->distributorToken= $inputData->distributorToken;
$stmtUser = $onboard->editAgent_userCheck();
if ($stmtUser->rowCount() == 1) {

    $obj->status_code       = 201;
    $obj->get_details       = $onboard->getDistributorDetails();
    $obj->bussinessType     = $onboard->bussinessTypeList();
    $obj->getbussinessType  = $onboard->getbussinessTypeList();
    $obj->airports          = $onboard->airportsList();
    $obj->get_airports      = $onboard->get_airportsList();
    $obj->distributorTypes  = $onboard->distributorTypes();
    $obj->countries         = $onboard->countries();

}else{
    $obj->code          =   503;
    $obj->status_code   =   503;
    $obj->title         =   "Oops";
    $obj->message       =   "Bussiness info already updated";
}
echo json_encode($obj);
?>