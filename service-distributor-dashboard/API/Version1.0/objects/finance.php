<?php
class Finance extends Database{
    
    function financeHistoryCheck(){
        $dateQuery = $this->dateQuery;
        $query="SELECT `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`after_cal_discount_amt`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`sd_previous_credit`,
        `users__booking_detail`.`sd_balance_credit`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking`.`is_agent`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='0'
        $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function agentFinanceHistoryCheck(){
        $dateQuery = $this->dateQuery;
        $query="SELECT `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`after_cal_discount_amt`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`sd_previous_credit`,
        `users__booking_detail`.`sd_balance_credit`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`status`,
        `service__distributor_agent`.`name` AS `agent_name`,
        `users__booking`.`is_agent`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`!=''
        $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function financeHistoryView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token          = $row["token"];
            $obj->bookingNumber  = $row["booking_number"];
            if($row["is_agent"]){
                $obj->serviceCost    = ($row["net_amount"]+$row["agent_conv_fee_commi"]+$row["gst_agent_conv_fee_commi"])-$row["after_cal_discount_amt"];
            }else{
                $obj->serviceCost    = $row["net_amount"]-$row["after_cal_discount_amt"];
            }
            if($row["status"] == 'Cancelled'){
                $obj->commision      = '0';
                $obj->commisionCost  = '0';
            }else{
                $obj->commision      = $row["az_sd_percentage"];
                $obj->commisionCost  = $row["az_sd_commision_amount"];
            }
            
            $obj->totalCost      = $row["net_amount"]-$row["az_sd_commision_amount"];
            if($row['agent_name']){
                $obj->agentName      = $row['agent_name'];
            }
            $obj->previousCredit = $row["sd_previous_credit"];
            $obj->creditBalance  = $row["sd_balance_credit"];
            
            $obj->createdDateTime= convertDate("d M Y H:i",$row["date_time"]);
            $obj->serviceDateTime= $row["service_date_time"];
                
            if($row["cancelled_date"]=="0000-00-00 00:00:00"){
                $obj->cancellationFee= "-";
            }else{
                $obj->cancellationFee= $row["cancellation_fee"];
            }
            if($row["refunded_date"]=="0000-00-00 00:00:00"){
                $obj->refundedAmount= "-";
            }else{
                $obj->refundedAmount= $row["refunded_amount"];
            }
            $obj->givenCredit    = "-";
            array_push($array, $obj);
        }
        $array = $this->creditLogs($array);
        return $array;
    }
    function creditLogs($array){
        $creditDateQuery = $this->creditDateQuery;
        $query="
        SELECT `service__distributor_credit_logs`.`credit_available`,
        `service__distributor_credit_logs`.`given_credit`,
        `service__distributor_credit_logs`.`current_credit`,
        `service__distributor_credit_logs`.`reference_id`,
        `service__distributor_credit_logs`.`date_time`
        FROM `service__distributor_credit_logs`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`service__distributor_credit_logs`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        $creditDateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token          = "-";
            $obj->bookingNumber  = "-";
            $obj->serviceCost    = "0";
            $obj->commision      = "0";
            $obj->commisionCost  = "0";
            $obj->totalCost      = "-";
            $obj->agentName      = "-";
            $obj->previousCredit = $row["credit_available"];;
            $obj->creditBalance  = $row["current_credit"];
            $obj->createdDateTime= convertDate("Y-m-d H:i:s",$row["date_time"]);
            $obj->serviceDateTime= "-";
            $obj->cancellationFee= "-";
            $obj->refundedAmount = "-";
            $obj->givenCredit    = $row["given_credit"];
            array_push($array, $obj);
        }
        return $array;
    }
    function revenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`,
        COALESCE( SUM(`users__booking_detail`.`after_cal_discount_amt`),'0' ) AS `discount_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='0'
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $bookedRevenue = $row['total_amount']-$row['discount_amount'];
        return $bookedRevenue;
    }
    function agentRevenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`,
        COALESCE( SUM(`users__booking_detail`.`after_cal_discount_amt`),'0' ) AS `discount_amount`,
        COALESCE( SUM(`users__booking_detail`.`agent_conv_fee_commi`),'0' ) AS `agent_conv_fee_commi`,
        COALESCE( SUM(`users__booking_detail`.`gst_agent_conv_fee_commi`),'0' ) AS `gst_agent_conv_fee_commi`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`!=''
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($row['total_amount']+$row['agent_conv_fee_commi']+$row['gst_agent_conv_fee_commi'])-$row['discount_amount'];
    }
    function distributorCreditView(){
        $query = "SELECT
        `service__distributor`.`is_credit`,
        `service__distributor`.`credit_available`,
        COALESCE( SUM(`service__distributor_credit_logs`.`given_credit`),0) AS `total_credits`
        FROM `service__distributor`
        INNER JOIN `service__distributor_employee` ON 
            `service__distributor_employee`.`service_distributor_token`=`service__distributor`.`token`
        LEFT JOIN `service__distributor_credit_logs` ON
            `service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`
        WHERE `service__distributor_employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->is_credit   = $row['is_credit'];
        $obj->totalCredits   = $row['total_credits'];
        if($row['credit_available']<0){
            $obj->creditAvailable= 0;
            $value = $row['credit_available']*(-1);
            $obj->usedCredits    = number_format($value, 2, '.', ''); 
        }else{
            $obj->creditAvailable= number_format($row['credit_available'], 2, '.', '');
            $obj->usedCredits    = 0;
        }
        return $obj;
    }
}