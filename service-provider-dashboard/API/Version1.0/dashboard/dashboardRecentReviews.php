<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
    
include_once '../objects/dashboard.php';
$dashboard = new dashboard();
$dashboard->serviceProviderLocationtoken= $inputData->serviceProviderLocationtoken;
$dashboard->type  = $inputData->type;
if($dashboard->type==""){
    $dashboard->limitQuery  = "LIMIT 0,5";
    $dashboard->searchQuery = "";
}else if($dashboard->type=="show_all"){
    $dashboard->limitQuery  = "";
    $dashboard->searchQuery = "";
}else{
    $dashboard->limitQuery  = "";
    $dashboard->searchQuery = " AND `users__booking_detail`.`rating`='$dashboard->type'";
}
$stmt    = $dashboard->recentReviews();
$obj->status_code = 201;
$obj->reviews     = $dashboard->recentReviewsView($stmt);

echo json_encode($obj);
?>