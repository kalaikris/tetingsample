<?php
class Finance extends Database{
    
    function financeHistoryCheck(){
        $dateQuery = $this->dateQuery;
        $query="SELECT `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`sd_previous_credit`,
        `users__booking_detail`.`sd_balance_credit`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='0'
        $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function agentFinanceHistoryCheck(){
        $dateQuery = $this->dateQuery;
        $query="SELECT `users__booking`.`booking_number`,`users__booking`.`convenience_fee`,`users__booking`.`cf_tax`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`after_discount_net_amt`,
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
        `users__booking_detail`.`refund_status`,
        `users__booking_detail`.`cancellation_percentage`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `service__distributor_agent`.`name` AS `agent_name`,
        `service__distributor_agent_commision`.`percent`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        INNER JOIN `service__distributor_agent_commision` ON `service__distributor_agent_commision`.`sd_agent_token`=`users__booking`.`agent_token`
        WHERE `users__booking`.`user_token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`!=''
        $dateQuery  GROUP BY `users__booking_detail`.`token` ORDER BY `users__booking_detail`.`id`";
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
            $obj->serviceCost    = $row["net_amount"];
            // $obj->commision      = $row["az_sd_percentage"];
            // $obj->commisionCost  = $row["az_sd_commision_amount"];
            $obj->totalCost      = $row["net_amount"]-$row["az_sd_commision_amount"];
            $obj->netAmount      = $row["net_amount"];
            // $obj->convenience_fee = (int)$row["convenience_fee"]+(int)$row["cf_tax"];
            $obj->convenience_fee = (int)$row["agent_conv_fee_commi"]+(int)$row["gst_agent_conv_fee_commi"];
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
            if($row["refund_status"]=="Pending"){
                $obj->refundStatus = '<span class="widget cancelled">Pending</span>';
            }else{
                $obj->refundStatus = '<span class="widget completed">Refunded</span>';
            }
            $percent = 
            // $cancel_percent_fee = round($row["net_amount"]*$row["percent"]/100);
            $cancel_percent_fee = round($row["after_discount_net_amt"]*$row["percent"]/100);
            $obj->commision      = $row["percent"];
            $obj->commisionCost  = $cancel_percent_fee;
            // $obj->refundedAmount = $obj->totalCost-($cancel_percent_fee + $row["platform_fee"]);
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
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='0'
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount'];
    }
    function agentRevenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        WHERE `users__booking`.`user_token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`!=''
        $revenueQuery";
        // INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        // $stmt->debugDumpParams();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount'];
    }
    function distributorCreditView_New(){
        $query="SELECT 
        `service__distributor`.`is_credit`,
                `service__distributor`.`credit_available`,
                `service__distributor`.`name`,
                COALESCE( SUM(`service__distributor_credit_logs`.`given_credit`),0) AS `total_credits`
        
        FROM `users`
        INNER JOIN `service__distributor_agent` ON (`users`.`agent_token`=`service__distributor_agent`.`token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`service__distributor_agent`.`service_distributor_tokenIndex`)
        INNER JOIN `service__distributor_credit_logs` ON (`service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`)
        WHERE `users`.`token`=:token AND `users`.`is_agent`='1' AND `users`.`is_approved`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        // $stmt->debugDumpParams();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->is_credit   = $row['is_credit'];
        $obj->totalCredits   = $row['total_credits'];
        $obj->service__distributor_name   = $row['name'];
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
    function distributorCreditView(){
        $query = "SELECT
        `service__distributor`.`is_credit`,
        `service__distributor`.`credit_available`,
        `service__distributor`.`name`,
        COALESCE( SUM(`service__distributor_credit_logs`.`given_credit`),0) AS `total_credits`
        FROM `service__distributor`
        INNER JOIN `service__distributor_employee` ON 
            `service__distributor_employee`.`service_distributor_token`=`service__distributor`.`token`
        LEFT JOIN `service__distributor_credit_logs` ON
            `service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`
        WHERE `service__distributor_employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->service_distributor_employee);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->is_credit   = $row['is_credit'];
        $obj->totalCredits   = $row['total_credits'];
        $obj->service__distributor_name   = $row['name'];
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