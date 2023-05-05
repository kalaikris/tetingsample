<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/bookingApp.php';
$bookingApp = new bookingApp();
$bookingApp->bookingToken = $inputData->bookingToken;
///////////'Reached service location','Met the client','Guide the client','Completed'
$bookingApp->workStatus   = $inputData->workStatus;
$stmt = $bookingApp->workStatusCheck();
if($stmt->rowCount()==0){
    if($bookingApp->workStatus!=""){
        if($bookingApp->workStatus=="Reached service location"){
            $bookingApp->updateStatus('Ongoing');
        }else if($bookingApp->workStatus=="Completed"){
            // $providerDetails       = $bookingApp->getProviderDetails();
            // $bookingApp->providertoken         = $providerDetails->providertoken;
            // $bookingApp->providerCredits       = $providerDetails->providerCredits;
            // $bookingApp->providerPercentage    = $providerDetails->commission;
            // $bookingApp->bookingNetAmount      = $bookingApp->getBookingNetAmount();
            // $bookingApp->providerCommission    = $bookingApp->bookingNetAmount*($bookingApp->providerPercentage/100);
            // $bookingApp->providerPreviousCredit= $bookingApp->providerCredits;
            // $bookingApp->providerBalanceCredit = $bookingApp->providerCredits-($bookingApp->bookingNetAmount -$bookingApp->providerCommission);
            
            // $distributorDetails    = $bookingApp->getDistributorDetails();
            // $bookingApp->distributorToken      = $distributorDetails->distributorToken;
            // $bookingApp->distributorCredits    = $distributorDetails->distributorCredits;
            // $bookingApp->distributorPercentage = $distributorDetails->commission;
            // $bookingApp->distributorCommission = $bookingApp->bookingNetAmount*($bookingApp->distributorPercentage/100);
            // $bookingApp->distributorPreviousCredit= $bookingApp->distributorCredits;
            // $bookingApp->distributorBalanceCredit = $bookingApp->distributorCredits-$bookingApp->bookingNetAmount;
            
            $bookingApp->updateStatus('Completed');
            // $bookingApp->updateCommisionDetails();
            // $bookingApp->updateProviderCredits();
            // $bookingApp->updateDistributorCredits();
        }
        $obj->status_code = 201;
        $obj->message     = "Updated successfully";//$bookingApp;//
        $bookingApp->addWorkStatus($gm_date_time);
    }else{
        $obj->status_code = 503;
        $obj->message     = "Error";
    }
}else{
    $obj->status_code = 503;
    $obj->message     = "This status already updated";
}
echo json_encode($obj);
?>