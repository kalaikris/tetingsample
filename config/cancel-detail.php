<?php
class CancelDetails {
    public $airportzo_cancellation_fee;
    public $sp_rejection;
    public $is_agent_user;
    public $service_detail;
    public $stmt;
    public function getCancelDetail() {
        $service_cost = 0;
        $cur_date_time = date("Y-m-d H:i:s");
        $service_detail = $this->service_detail;
        $airportzo_cancellation_fee = $this->airportzo_cancellation_fee;
        $is_agent_user = $this->is_agent_user;
        $sp_rejection = $this->sp_rejection;
        if ($service_detail->status != 'Cancelled' && $service_detail->status != 'Completed') { // && sizeof($service_detail->cancellation_policy_detail) > 0 //if ($service_detail->service_date_time_raw > $cur_date_time) {
            $cancellation_hours = (strtotime($service_detail->service_date_time_raw) - strtotime($cur_date_time)) / 3600;
            $cancellation_hours = ceil($cancellation_hours);
            $cancellation_hours = ($cancellation_hours > 0)? $cancellation_hours: 0;
            $applicable_cancellation_hours = 0;

            $cancellation_fee_perc = 100;
            if ($cancellation_hours > 0 && sizeof($service_detail->cancellation_policy_detail)) {
                foreach ($service_detail->cancellation_policy_detail as $cancellation_policy_value) {
                    $cur_cancel_perc = intval($cancellation_policy_value->percentage);
                    if (intval($cancellation_policy_value->hours) < $cancellation_hours && $cancellation_fee_perc > $cur_cancel_perc) {
                        $cancellation_fee_perc = $cur_cancel_perc;
                        $applicable_cancellation_hours = intval($cancellation_policy_value->hours);
                    }
                }
            }
            // $service_cost = intval($service_detail->net_amount);
            if($is_agent_user || $sp_rejection){
                $service_cost = ((int)$service_detail->adult_sub_total + (int)$service_detail->child_sub_total + (int)$service_detail->add_adult_sub_total + (int)$service_detail->add_child_sub_total) + (int)$service_detail->agent_conv_fee + (int)$service_detail->user_conv_fee;
            } else {
                $service_cost = ((int)$service_detail->adult_sub_total + (int)$service_detail->child_sub_total + (int)$service_detail->add_adult_sub_total + (int)$service_detail->add_child_sub_total);
            }
            $cancellation_fee = number_format($cancellation_fee_perc * $service_cost / 100, 2, '.', '');//(3*110/100)
            $total_cancellation_fee = $cancellation_fee + $airportzo_cancellation_fee; //3.3 + 150
            $total_cancellation_fee = ceil($total_cancellation_fee);    //153
            $total_cancellation_fee = ($total_cancellation_fee > $service_cost)? $service_cost: $total_cancellation_fee;    //153 > 110 ? 110 : 153

            $obj = new stdClass;
            $obj->time_difference = $cancellation_hours . " hrs";
            $obj->service_cost = strval($service_cost);
            $obj->cancellation_hours = strval($applicable_cancellation_hours);
            $obj->cancellation_fee = strval($cancellation_fee);
            $obj->cancellation_fee_perc = strval($cancellation_fee_perc);
            $obj->airportzo_fee = strval($total_cancellation_fee - ceil($cancellation_fee));
            $obj->max_airportzo_fee = strval($airportzo_cancellation_fee);
            $obj->refund_amount = strval($service_cost - $total_cancellation_fee);

            return $obj;
        } else {
            return false;
        }
    }

    //For External API 
    public function getCancelDetail_ext() {
        $cur_date_time = date("Y-m-d H:i:s");
        $service_detail = $this->service_detail;
        $airportzo_cancellation_fee = $this->airportzo_cancellation_fee;
        if ($service_detail->status != 'Cancelled' && $service_detail->status != 'Completed') { // && sizeof($service_detail->cancellation_policy_detail) > 0 //if ($service_detail->service_date_time_raw > $cur_date_time) {
            $cancellation_hours = (strtotime($service_detail->service_date_time_raw) - strtotime($cur_date_time)) / 3600;
            $cancellation_hours = ceil($cancellation_hours);
            $cancellation_hours = ($cancellation_hours > 0)? $cancellation_hours: 0;
            $applicable_cancellation_hours = 0;

            $cancellation_fee_perc = 100;
            if ($cancellation_hours > 0 && sizeof($service_detail->cancellation_policy_detail)) {
                foreach ($service_detail->cancellation_policy_detail as $cancellation_policy_value) {
                    $cur_cancel_perc = intval($cancellation_policy_value->cancellation_fee_percentage);
                    if (intval($cancellation_policy_value->hours_before_cancelling) < $cancellation_hours && $cancellation_fee_perc > $cur_cancel_perc) {
                        $cancellation_fee_perc = $cur_cancel_perc;
                        $applicable_cancellation_hours = intval($cancellation_policy_value->hours_before_cancelling);
                    }
                }
            }
            $service_cost = intval($service_detail->net_amount);
            $cancellation_fee = number_format($cancellation_fee_perc * $service_cost / 100, 2, '.', '');
            $total_cancellation_fee = $cancellation_fee + $airportzo_cancellation_fee;
            $total_cancellation_fee = ceil($total_cancellation_fee);
            $total_cancellation_fee = ($total_cancellation_fee > $service_cost)? $service_cost: $total_cancellation_fee;

            $obj = new stdClass;
            $obj->time_difference = $cancellation_hours . " hrs";
            $obj->service_cost = strval($service_cost);
            $obj->cancellation_hours = strval($applicable_cancellation_hours);
            $obj->cancellation_fee = strval($cancellation_fee);
            $obj->cancellation_fee_perc = strval($cancellation_fee_perc);
            $obj->airportzo_fee = strval($total_cancellation_fee - ceil($cancellation_fee));
            $obj->max_airportzo_fee = strval($airportzo_cancellation_fee);
            $obj->refund_amount = strval($service_cost - $total_cancellation_fee);

            return $obj;
        } else {
            return false;
        }
    }
}
?>