<?php
$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/booking.php';
$booking = new Booking();
$booking->bookingServiceToken = $inputData->bookingServiceToken;
$booking->refundId = $inputData->refundId;
$stmt = $booking->bookingServiceTokenCheck();
if($stmt->rowCount()==1){
    $booking->gmDateTime    = $gm_date_time;
    if($booking->updateRefundIdForCancelBooking()){
        $obj->status_code = 201;
        $obj->message     = "Updated Successfully";
    }
}else{
    $obj->status_code = 503;
    $obj->message     = "Already Refunded For this booking service";
}
echo json_encode($obj);
?>