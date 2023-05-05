<?php
class Finance extends Database{
    function financeHistory($gm_date){
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $query="SELECT
        `users__booking`.`token`
        FROM `users__booking_detail` 
        LEFT JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        LEFT JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        LEFT JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  (
            1
        )
        AND `service__provider_company_location`.`token`=:token
        $searchQuery
        $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function financeHistoryCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`cancellation_percentage`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`az_sp_percentage`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`status`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        LEFT JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status` != 'Draft' AND `service__provider_company_location`.`token`=:token
        $searchQuery
        $dateQuery
        GROUP BY `users__booking_detail`.`id` 
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        //$stmt->debugDumpParams();
        return $stmt;
    }
    function financeHistoryView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->createdDateTime= convertDate("d M Y",$row["date_time"]);
            $obj->token          = $row["token"];
            $obj->bookingNumber  = '<p class="table_link">'.$row["booking_number"].'</p>';
            $obj->serviceCost    = $row["net_amount"]-$row["markup_amount"];
            if($row["status"] != 'Cancelled'){
                $obj->percentage     = $row["az_sp_percentage"];
            }else{
                $obj->percentage     = '0'; 
            }
            if($row["status"] != 'Cancelled'){
                $obj->commision      = (($row["net_amount"]-$row["markup_amount"])*$row["az_sp_percentage"]/100);
            }else{
                $obj->commision      = '0';
            }
            $commission = (($row["net_amount"]-$row["markup_amount"])*$row["az_sp_percentage"]/100);
            $totalCost           = $obj->serviceCost-$commission;
            $obj->totalCost      = number_format((float)$totalCost, 2, '.', '');
            if($row["cancelled_date"]=="0000-00-00 00:00:00"){
                $obj->cancellationFee = "-";
            }else{
                $cancel_percent_fee = $totalCost*$row["cancellation_percentage"]/100;
                $obj->cancellationFee   = number_format($cancel_percent_fee,2,'.','');
            }
            if($row["cancellation_fee"]=="0"){
                $obj->receivable =number_format((float)$totalCost, 2, '.', '');
            }else{
                $obj->receivable   = number_format($cancel_percent_fee,2,'.','');
            }
            if($row["refunded_amount"]=="0"){
                $obj->refundedAmount = "-";
            }else{
                $obj->refundedAmount = number_format($totalCost-$cancel_percent_fee,2,'.','');
            }
            array_push($array, $obj);
        }
        $array = $this->creditLogs($array);
        return $array;
    }
    function creditLogs($array){
        $creditDateQuery = $this->creditDateQuery;
        $query="SELECT 
        `provider_logs`.`credit_available`,
        `provider_logs`.`given_credit`,
        `provider_logs`.`current_credit`,
        `provider_logs`.`reference_id`,
        `provider_logs`.`date_time`
        FROM `service__provider_credit_logs` AS `provider_logs`
        INNER JOIN `service__provider_company` AS `company` ON
        	`company`.`service_provider_token`=`provider_logs`.`service_provider_token`
        INNER JOIN `service__provider_company_location` AS `location` ON
        	`location`.`company_token`=`company`.`token`
        WHERE `location`.`token`=:token
        $creditDateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $obj = new stdClass();
            $obj->createdDateTime= $row["date_time"];
            $obj->token          = "-";
            $obj->bookingNumber  = "-";
            $obj->serviceCost    = $row["credit_available"];
            $obj->percentage     = "-";
            $obj->commision      = $row["given_credit"];;
            $obj->totalCost      = $row["current_credit"];
            $obj->cancellationFee= "-";
            $obj->receivable = "-";
            $obj->refundedAmount = "-";
            $obj->givenCredit    = $row["given_credit"];
            array_push($array, $obj);
        }
        return $array;
    }
    function revenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`,
        COALESCE( SUM(`users__booking_detail`.`markup_amount`),'0' ) AS `markup_total_amount`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE `service__provider_company_location`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        //$stmt->debugDumpParams();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount']-$row['markup_total_amount'];
    }
    function providerCreditView(){
        $query = "SELECT
        `service__provider`.`is_credit`,
        `service__provider`.`credit_available`,
        COALESCE( SUM(`service__provider_credit_logs`.`given_credit`),0) AS `total_credits`
        FROM `service__provider`
        LEFT JOIN `service__provider_credit_logs` ON 
            `service__provider_credit_logs`.`service_provider_token`=`service__provider`.`token`
        INNER JOIN `service__provider_company` ON 
        	`service__provider_company`.`service_provider_token`=`service__provider`.`token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`service__provider_company`.`token`
        WHERE `service__provider_company_location`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->totalCredits = $row['total_credits'];
        $obj->is_credit = $row['is_credit'];
        if($row['credit_available']<0){
            $obj->creditAvailable= 0;
            $value = $row['credit_available']*(-1);
            $obj->usedCredits    = number_format($value, 2, '.', ''); 
        }else{
            $obj->creditAvailable= $row['credit_available'];
            $obj->usedCredits    = 0;
        }
        return $obj;
    }
}