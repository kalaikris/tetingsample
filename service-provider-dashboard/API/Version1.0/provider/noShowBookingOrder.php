<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingOrderToken = $inputData->bookingOrderToken;
$stmt_data = $booking->user_booking_detail();

    // $cancellation_hours = (strtotime($stmt_data->service_date_time) - strtotime($cur_date_time)) / 3600;
    // $cancellation_hours = ceil($cancellation_hours);
    // $cancellation_hours = ($cancellation_hours > 0)? $cancellation_hours: 0;

    // $cancellation_fee_perc = 100;
    // if ($cancellation_hours > 0 && sizeof($stmt_data->cancellation_policy_detail)) {
    //     foreach ($stmt_data->cancellation_policy_detail as $cancellation_policy_value) {
    //         $cur_cancel_perc = intval($cancellation_policy_value->percentage);
    //         if (intval($cancellation_policy_value->hours) < $cancellation_hours && $cancellation_fee_perc > $cur_cancel_perc) {
    //             $cancellation_fee_perc = $cur_cancel_perc;
    //         }
    //     }
    // }

    // if($stmt_data->is_airportzo_user == '0'){
    //     $airportzo_cancellation_charge = $booking->airportZoFee();
    //     $booking->distributor_token = $stmt_data->service_distributor_token;
    //     $commissionServiceDistData = $booking->getCreditAvailableForServiceDistributor();
    //     // $cancellation_cost =  $stmt_data->net_amount*$cancellation_fee_perc/100;
    //     // $distributor_cancelled_credits = $stmt_data->net_amount-($airportzo_cancellation_charge+$cancellation_cost);
    //     // $booking->distributor_balance_credit = $credit_available+$distributor_cancelled_credits;
    //     if($commissionServiceDistData->is_credit == '1'){
    //         $cancellation_cost =  round($stmt_data->discount_net_amt * $cancellation_fee_perc/100);
    //         $distributor_cancelled_credits = (($stmt_data->discount_net_amt) - $cancellation_cost - $airportzo_cancellation_charge);
    //         $booking->distributor_balance_credit = $commissionServiceDistData->credit_available + $distributor_cancelled_credits;
    //         $booking->updateDistributorCreditAvailableAmount();
    //     }
    // }

    // $booking->sp_company_token = $stmt_data->company_token;
    // $booking->airport_token = $stmt_data->airport_token;
    // $commission_data = $booking->getCommissionForServiceProvider();
    // if($commission_data->is_credit == '1'){
    //     $deduction_commission_amount_inservice =  ($stmt_data->net_amount-$stmt_data->markup_amount)-$stmt_data->az_sp_commision_amount;
    //     $cancel_cost = $deduction_commission_amount_inservice*$cancellation_fee_perc/100;
    //     $cancelled_credits = $deduction_commission_amount_inservice-$cancel_cost;
        
    //     $booking->balance_provider_credits = $commission_data->provider_credits+$cancelled_credits;
    //     $booking->service_provider = $commission_data->service_provider;
    //     $booking->updateCreditAvailableAmount();
    // }
    $booking->booking_service_token = $stmt_data->booking_service_token;
    if($booking->updateStatus()){
        $obj->status_code = 200;
        $obj->message = "No Show Updated Successfully!";
    }else{
        $obj->status_code = 400;
        $obj->message = "No Show Not Updated!";
    }
    echo json_encode($obj);
   
?>