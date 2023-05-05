<?php
class reports extends Database {
    public function renvenueCheck(){
        $query = "SELECT COUNT(`id`) AS `count`,
        COALESCE(SUM(`users__booking_detail`.`net_amount`),0) AS `total`,
        COALESCE(SUM(`users__booking_detail`.`cancellation_fee`),0) AS `cancellation_fee`,
        COALESCE(SUM(`users__booking_detail`.`platform_fee`),0) AS `platform_fee`
        FROM `users__booking_detail`
        WHERE $this->filterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function thisMonthRevenueSummary(){
        if($this->filter == "MonthlyWiseFilter"){
             $this->filterQuery = " `date_time` LIKE '$this->thisMonth%'";
        }else{
             $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate'";
        }
       
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->totalCount  = $row["count"];
        $obj->totalAmount = $row["total"];
        
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` LIKE '$this->thisMonth%' AND `status`='cancelled'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate' AND `status`='cancelled'";
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->cancelledCount  = $row["count"];
        $obj->cancelledAmount = $row["total"];
        
        $obj->netCount        = $obj->totalCount-$obj->cancelledCount;
        $obj->netAmount       = $obj->totalAmount-$obj->cancelledAmount;
        
        return $obj;
    }
    function fromAprilRevenueSummary(){
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate'";
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->totalCount  = $row["count"];
        $obj->totalAmount = $row["total"];
        if($this->filter == "MonthlyWiseFilter"){
           $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate' AND `status`='cancelled'"; 
        }else{
          $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate' AND `status`='cancelled'";  
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->cancelledCount  = $row["count"];
        $obj->cancelledAmount = $row["total"];
        
        $obj->netCount        = $obj->totalCount-$obj->cancelledCount;
        $obj->netAmount       = $obj->totalAmount-$obj->cancelledAmount;
        
        return $obj;
    }
    function thisMonthCancellationSummary(){
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` LIKE '$this->thisMonth%'  AND `status`='cancelled'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate'  AND `status`='cancelled'";
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->cancelledCount  = $row["count"];
        $obj->cancelledAmount = $row["total"];
        
        if($this->filter == "MonthlyWiseFilter"){
             $this->filterQuery = " `date_time` LIKE '$this->thisMonth%' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }else{
             $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }
       
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->refundIssuedCount  = $row["count"];
        $obj->refundIssuedAmount = ceil(($row["total"]-($row["cancellation_fee"]+$row["platform_fee"]))/1.18);
        
        $obj->netCount        = $obj->cancelledCount-$obj->refundIssuedCount;
        $obj->netAmount       = $obj->cancelledAmount-$obj->refundIssuedAmount;
        return $obj;
    }
    function fromAprilCancellationSummary(){
        if($this->filter == "MonthlyWiseFilter"){
           $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate'  AND `status`='cancelled'"; 
        }else{
           $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate'  AND `status`='cancelled'";
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->cancelledCount  = $row["count"];
        $obj->cancelledAmount = $row["total"];
        
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->refundIssuedCount  = $row["count"];
        $obj->refundIssuedAmount = $row["total"];
        
        $obj->netCount        = $obj->cancelledCount-$obj->refundIssuedCount;
        $obj->netAmount       = $obj->cancelledAmount-$obj->refundIssuedAmount;
        return $obj;
    }
    
    public function transactionCheck(){ 
        $query = "SELECT
        `users`.`is_agent`,
        `users`.`is_approved`,
        `users__booking_detail`.`token`,
        `users`.`name` AS `customer_name`,
        COALESCE(`service__distributor_agent`.`name`,'') AS `agent_name`,
        COALESCE(`service__distributor_agent`.`gst_certificate`,'') AS `agent_gst_certificate`,
        (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token` = `users__booking`.`token`) AS `count_booking`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`markup_type`,
        `users__booking_detail`.`markup_percentage`,
        `users__booking_detail`.`discount_amount`,
        `users__booking`.`booking_number`,
        `service`.`name` AS `service_name`,
        COALESCE(`business_type`.`name`,'') AS `service_business_type`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`adult_service_amount`,
        `users__booking_detail`.`children_service_amount`,
        `users__booking_detail`.`additional_adult_service_amount`,
        `users__booking_detail`.`additional_children_service_amount`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`cancelled_by`,
         `users__booking`.`gstin_number`,
         `users__booking`.`token` AS `users__booking_token`,
         `users__booking`.`convenience_fee`,
         `users__booking`.`cf_tax`,
         `users__booking`.`total_service`,
         `users__booking`.`booking_type`,
         `users__booking`.`coupon_type`,
         `users__booking`.`cart_coupon_type`,
         `users__booking`.`discount_amount` AS `cart_dis_amt`,
         `service__provider_company`.`name` AS `assigned_to`,
         `users__booking`.`payment_id`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        LEFT JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        INNER JOIN `service__provider_company` ON `users__booking_detail`.`company_token` = `service__provider_company`.`token`
        WHERE `users__booking_detail`.`status` != 'Draft' $this->dateQuery ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function transactionView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $passenger_name = '';
            $obj = new stdClass();
            $obj->token        = $row["token"];

            $query = "SELECT
                        `users__booking_passenger`.`id`,
                        `users__booking_passenger`.`token`,
                        `users__booking_passenger`.`booking_token`,
                        `users__booking_passenger`.`passenger_type`,
                        `users__booking_passenger`.`user_passenger_token`,
                        `users__passenger`.`title`,
                        `users__passenger`.`name`,
                        `users__passenger`.`country_code`,
                        `users__passenger`.`mobile_number`,
                        `users__passenger`.`email_id`,
                        `users__passenger`.`date_of_birth`
                    FROM
                        `users__booking_passenger`
                    INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
                    WHERE
                        `users__booking_passenger`.`booking_token`=:booking_token AND `passenger_type` = 'Contact'";
                    $this->stmt = $this->conn->prepare( $query );
                
                    $this->stmt->bindParam(":booking_token", $row["users__booking_token"]);
                    $this->stmt->execute();
                    //$this->stmts1->debugDumpParams();
                    //$num_counts = $this->stmts1->rowCount();
                    while ($rows1 = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
                        $passenger_name = $rows1['name'];
                    }
            $obj->customerName = $passenger_name;
            // $obj->customerName = $row["customer_name"];
            $obj->agentName    = $row["agent_name"];
            $obj->gstNumber = $row["gstin_number"];
            $obj->bookedDate    = convertDate("d M Y",$row["date_time"]);
            $obj->serviceDate   = convertDate("d M Y",$row["service_date_time"]);
            $obj->status        = $row["status"];
            if($row["cancelled_by"] == '1'){
                $obj->status        = 'Cancelled';
            }else if($row["cancelled_by"] == '2'){
                $obj->status        = 'Rejected';
            }
            $obj->bookingNumber = $row["booking_number"];
            $obj->serviceName   = $row["service_name"];
            $obj->businessType  = $row["service_business_type"];
            if($row["total_adult"] <= 1){
                $obj->totalAdult    = (int)$row["total_adult"];
                $obj->additionalAdult       = 0;
            }else{
                $obj->totalAdult    = 1;
                $obj->additionalAdult       = (int)$row["total_adult"] - 1;
            }
            if($row["total_children"] <= 1){
                $obj->totalChildren    = (int)$row["total_children"];
                $obj->additionalChildren       = 0;
            }else{
                $obj->totalChildren    = 1;
                $obj->additionalChildren       = (int)$row["total_children"] - 1;
            }
            // $obj->totalAdult    = $row["total_adult"];
            // $obj->totalChildren = $row["total_children"];
            // $obj->additionalAdult       = 0;
            // $obj->additionalChildren    = 0;

            //Seperate the Service Value and Markup value
            if($row["markup_type"] == 'Percentage'){
                $markup_percent = ((int)$row["markup_percentage"]/100)+1;   //no round this value
                $obj->adultServiceAmount    = round((int)$row["adult_service_amount"] / (float)$markup_percent);
                $obj->adult_price_markup = (int)$row["adult_service_amount"] - $obj->adultServiceAmount;
                $obj->adult_price_after_markup = $row["adult_service_amount"];

                if ($obj->totalChildren > 0) {
                    $obj->childrenServiceAmount = round((int)$row["children_service_amount"] / (float)$markup_percent);
                    $obj->child_price_markup = (int)$row["children_service_amount"] - $obj->childrenServiceAmount;
                    $obj->child_price_after_markup = $row["children_service_amount"];
                }else{
                    $obj->childrenServiceAmount = 0;
                    $obj->child_price_markup = 0;
                    $obj->child_price_after_markup = 0;
                }

                if((int)$row["additional_adult_service_amount"] == 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount    = round((int)$row["adult_service_amount"] / (float)$markup_percent);
                    $obj->add_adult_price_markup = (int)$row["adult_service_amount"] - $obj->additionalAdultServiceAmount;
                    $obj->add_adult_price_after_markup = $row["adult_service_amount"];
                    
                }else if((int)$row["additional_adult_service_amount"] > 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount  = round((int)$row["additional_adult_service_amount"] / (float)$markup_percent);
                    $obj->add_adult_price_markup        = (int)$row["additional_adult_service_amount"] - $obj->additionalAdultServiceAmount;
                    $obj->add_adult_price_after_markup  = $row["additional_adult_service_amount"];
                }else{
                    $obj->additionalAdultServiceAmount    = 0;
                    $obj->add_adult_price_markup = 0;
                    $obj->add_adult_price_after_markup = 0;
                }

                if((int)$row["additional_children_service_amount"] == 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = round((int)$row["children_service_amount"] / (float)$markup_percent);
                    $obj->add_child_price_markup = (int)$row["children_service_amount"] - $obj->additionalXhildrenServiceAmount;
                    $obj->add_child_price_after_markup = $row["children_service_amount"];
                    
                }else if((int)$row["additional_children_service_amount"] > 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = round((int)$row["additional_children_service_amount"] / (float)$markup_percent);
                    $obj->add_child_price_markup = (int)$row["additional_children_service_amount"] - $obj->additionalXhildrenServiceAmount;;
                    $obj->add_child_price_after_markup = $row["additional_children_service_amount"];
                }else{
                    $obj->additionalXhildrenServiceAmount = 0;
                    $obj->add_child_price_markup = 0;
                    $obj->add_child_price_after_markup = 0;
                }
            }else if($row["markup_type"] == 'Flat'){
                $markup_percent = (int)$row["markup_percentage"];
                $obj->adultServiceAmount    = round((int)$row["adult_service_amount"] - $markup_percent);
                $obj->adult_price_markup = abs((int)$row["adult_service_amount"] - $obj->adultServiceAmount);
                $obj->adult_price_after_markup = $row["adult_service_amount"];

                if ($obj->totalChildren > 0) {
                    $obj->childrenServiceAmount = round((int)$row["children_service_amount"]  - $markup_percent);
                    $obj->child_price_markup = abs((int)$row["children_service_amount"] - $obj->childrenServiceAmount);
                    $obj->child_price_after_markup = $row["children_service_amount"];
                }else{
                    $obj->childrenServiceAmount = 0;
                    $obj->child_price_markup = 0;
                    $obj->child_price_after_markup = 0;
                }

                if((int)$row["additional_adult_service_amount"] == 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount    = round((int)$row["adult_service_amount"]  - $markup_percent);
                    $obj->add_adult_price_markup = abs((int)$row["adult_service_amount"] - $obj->additionalAdultServiceAmount);
                    $obj->add_adult_price_after_markup = $row["adult_service_amount"];
                    
                }else if((int)$row["additional_adult_service_amount"] > 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount  = round((int)$row["additional_adult_service_amount"]  - $markup_percent);
                    $obj->add_adult_price_markup        = abs((int)$row["additional_adult_service_amount"] - $obj->additionalAdultServiceAmount);
                    $obj->add_adult_price_after_markup  = $row["additional_adult_service_amount"];
                }else{
                    $obj->additionalAdultServiceAmount    = 0;
                    $obj->add_adult_price_markup = 0;
                    $obj->add_adult_price_after_markup = 0;
                }

                if((int)$row["additional_children_service_amount"] == 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = round((int)$row["children_service_amount"]  - $markup_percent);
                    $obj->add_child_price_markup = abs((int)$row["children_service_amount"] - $obj->additionalXhildrenServiceAmount);
                    $obj->add_child_price_after_markup = $row["children_service_amount"];
                    
                }else if((int)$row["additional_children_service_amount"] > 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = round((int)$row["additional_children_service_amount"]  - $markup_percent);
                    $obj->add_child_price_markup = abs((int)$row["additional_children_service_amount"] - $obj->additionalXhildrenServiceAmount);
                    $obj->add_child_price_after_markup = $row["additional_children_service_amount"];
                }else{
                    $obj->additionalXhildrenServiceAmount = 0;
                    $obj->add_child_price_markup = 0;
                    $obj->add_child_price_after_markup = 0;
                }
            }else{
                $obj->adultServiceAmount    = (int)$row["adult_service_amount"] - (int)$row["markup_amount"];
                $obj->adult_price_markup = $row["markup_amount"];
                $obj->adult_price_after_markup = $row["adult_service_amount"];
    
                if ($obj->totalChildren > 0) {
                    $obj->childrenServiceAmount = (int)$row["children_service_amount"] - (int)$row["markup_amount"];
                    $obj->child_price_markup = $row["markup_amount"];
                    $obj->child_price_after_markup = $row["children_service_amount"];
                }else{
                    $obj->childrenServiceAmount = 0;
                    $obj->child_price_markup = 0;
                    $obj->child_price_after_markup = 0;
                }
    
                if((int)$row["additional_adult_service_amount"] == 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount    = (int)$row["adult_service_amount"] - (int)$row["markup_amount"];
                    $obj->add_adult_price_markup = abs((int)$row["adult_service_amount"] - $obj->additionalAdultServiceAmount);
                    $obj->add_adult_price_after_markup = $row["adult_service_amount"];
                    
                }else if((int)$row["additional_adult_service_amount"] > 0 && $obj->additionalAdult > 0){
                    $obj->additionalAdultServiceAmount  = (int)$row["additional_adult_service_amount"] - (int)$row["markup_amount"];
                    $obj->add_adult_price_markup        = abs((int)$row["additional_adult_service_amount"] - $obj->additionalAdultServiceAmount);
                    $obj->add_adult_price_after_markup  = $row["additional_adult_service_amount"];
                }else{
                    $obj->additionalAdultServiceAmount    = 0;
                    $obj->add_adult_price_markup = 0;
                    $obj->add_adult_price_after_markup = 0;
                }

                if((int)$row["additional_children_service_amount"] == 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = (int)$row["children_service_amount"] - (int)$row["markup_amount"];
                    $obj->add_child_price_markup = abs((int)$row["children_service_amount"] - $obj->additionalXhildrenServiceAmount);
                    $obj->add_child_price_after_markup = $row["children_service_amount"];
                    
                }else if((int)$row["additional_children_service_amount"] > 0 && $obj->additionalChildren > 0){
                    $obj->additionalXhildrenServiceAmount = (int)$row["additional_children_service_amount"] - (int)$row["markup_amount"];
                    $obj->add_child_price_markup = abs((int)$row["additional_children_service_amount"] - $obj->additionalXhildrenServiceAmount);
                    $obj->add_child_price_after_markup = $row["additional_children_service_amount"];
                }else{
                    $obj->additionalXhildrenServiceAmount = 0;
                    $obj->add_child_price_markup = 0;
                    $obj->add_child_price_after_markup = 0;
                }
            }
            
            if($row["is_agent"]!='0' && $row["is_approved"]!='0'){
                $obj->agent_convin_fee = round($row["convenience_fee"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"]);
                $obj->convenienceFee = 0;
                $obj->convenienceFeeGst = round($row["cf_tax"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"]);
            } else {
                $obj->agent_convin_fee = 0;
                if((int)$row['coupon_type'] == 2){          //Category
                    $net_ex_gst = (((int)$row["net_amount"] * 100) / 118);
                    $convin_cal = round(abs($net_ex_gst - (int)$row['discount_amount']));
                    $obj->convenienceFee = round(number_format(($convin_cal + (float)$convin_cal*0.18)*0.03, 2, '.', ''));
                    $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));

                }else if((int)$row['coupon_type'] == 1){    //Cart 

                    $trade_discount = trim((int)$row['cart_dis_amt']/(int)$row['count_booking']);

                    if($row['cart_coupon_type'] == 'Incl Gst'){ 
                        $convin_cal = round(abs((float)$row["net_amount"] - $trade_discount));
                        $obj->convenienceFee = round(number_format($convin_cal*0.03, 2, '.', ''));
                        $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));

                    }else if($row['cart_coupon_type'] == 'Excl Gst'){
                        $net_ex_gst = (((int)$row["net_amount"] * 100) / 118);
                        $convin_cal = round(abs(($net_ex_gst) - $trade_discount));
                        $obj->convenienceFee = round(number_format(($convin_cal + (float)$convin_cal*0.18)*0.03, 2, '.', ''));
                        $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));
                    }
                }else{
                    $obj->convenienceFee = round(number_format((float)$row["net_amount"]*0.03, 2, '.', ''));
                    $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));
                }
                
            }
            // if($row["is_agent"]!='0' && $row["booking_type"] == 'Whitelabel'){
            //     $obj->agent_convin_fee = $row["convenience_fee"];
            // }else{
            //     $obj->agent_convin_fee = 0;
            // }
            $obj->netAmount = $row["net_amount"];
            // $totalInvoice           = $obj->netAmount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
            // $obj->totalInvoice      = round($totalInvoice); 
            $obj->markup_amount      = $row["markup_amount"];

            $add_adult = 0;
            $add_child = 0;
            if((float)$row["additional_adult_service_amount"] == 0){
                $add_adult = $obj->adultServiceAmount;
            }else{
                $add_adult = $obj->additionalAdultServiceAmount;
            }
            if((float)$row["additional_children_service_amount"] == 0){
                $add_child = $obj->childrenServiceAmount;
            }else{
                $add_child = $obj->additionalXhildrenServiceAmount;
            }
            $obj->service_value_before_markup = ($obj->totalAdult * $obj->adultServiceAmount)+($obj->totalChildren * $obj->childrenServiceAmount)+($obj->additionalAdult * $add_adult)+($obj->additionalChildren * $add_child);
            $obj->service_value_markup = ($obj->totalAdult * $obj->adult_price_markup)+($obj->totalChildren * $obj->child_price_markup)+($obj->additionalAdult * $obj->add_adult_price_markup)+($obj->additionalChildren * $obj->add_child_price_markup);
            $obj->assignedTo        = $row["assigned_to"];
            $obj->paymentId        = $row["payment_id"];

            if((int)$row['coupon_type'] == 2){          //Category
                $obj->trade_discount = trim((int)$row['discount_amount']);
                $net_ex_gst = (((int) $obj->netAmount * 100) / 118);

                //for highest value in discount amount
                if($net_ex_gst < (int)$row['discount_amount']){
                    $obj->serv_val_post_discount = round(abs($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round(-$totalInvoice); 
                }else{
                    $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round($totalInvoice); 
                }

                // $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                // $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                // // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                // $obj->totalInvoice      = round($totalInvoice); 

            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj->trade_discount = trim((int)$row['cart_dis_amt']/(int)$row['count_booking']);
                if($row['cart_coupon_type'] == 'Incl Gst'){ 
                    $obj->serv_val_post_discount = round(abs($obj->netAmount - $obj->trade_discount));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round($totalInvoice); 
                }else if($row['cart_coupon_type'] == 'Excl Gst'){
                    $net_ex_gst = (((int) $obj->netAmount * 100) / 118);
                    
                    //for highest value in discount amount
                    if($net_ex_gst < (int)$row['discount_amount']){
                        $obj->serv_val_post_discount = round(abs($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                        $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                        // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                        $obj->totalInvoice      = round(-$totalInvoice); 
                    }else{
                        $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                        $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                        // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                        $obj->totalInvoice      = round($totalInvoice); 
                    }

                    // $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                    // $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // $obj->totalInvoice      = round($totalInvoice); 

                    // $obj->serv_val_post_discount = round(abs((($obj->netAmount * 100)/118) - $obj->trade_discount));
                }
            }else{
                $obj->trade_discount = 0;
                $obj->serv_val_post_discount = round((int) $obj->netAmount - $obj->trade_discount);
                $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                // $obj->serv_val_post_discount = round(((int) $obj->netAmount / 1.18) - $obj->trade_discount);
                // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                $obj->totalInvoice      = round($totalInvoice); 
            }

            array_push($array, $obj);
        }
        return $array;
    }
    public function salesRegisterCheck(){
        $query = "SELECT 
        `users`.`is_agent`,
        `users`.`is_approved`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`discount_amount`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking`.`payment_id`,
        `service`.`name` AS `service_name`,
        COALESCE(`business_type`.`name`,'') AS `service_business_type`,
        COALESCE(`business_type`.`hsn`,'') AS `hsn_code`,
        (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token` = `users__booking`.`token`) AS `count_booking`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`gstin_number`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`total_service`,
        `users__booking`.`token`,
        `users__booking`.`token` AS `users__booking_token`,
        `users__booking`.`is_airportzo_user`,
        `users__booking`.`service_distributor_token`,
        `users__booking`.`airportzo_gst_no`,
        `users__booking`.`place_of_service`,
        `users__booking`.`coupon_type`,
        `users__booking`.`cart_coupon_type`,
        `users__booking`.`discount_amount` AS `cart_dis_amt`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        WHERE `users__booking_detail`.`status` != 'Draft'
        $this->dateQuery ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function salesRegisterView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $passenger_name = '';
            $query = "SELECT
                        `users__booking_passenger`.`id`,
                        `users__booking_passenger`.`token`,
                        `users__booking_passenger`.`booking_token`,
                        `users__booking_passenger`.`passenger_type`,
                        `users__booking_passenger`.`user_passenger_token`,
                        `users__passenger`.`title`,
                        `users__passenger`.`name`,
                        `users__passenger`.`country_code`,
                        `users__passenger`.`mobile_number`,
                        `users__passenger`.`email_id`,
                        `users__passenger`.`date_of_birth`
                    FROM
                        `users__booking_passenger`
                    INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
                    WHERE
                        `users__booking_passenger`.`booking_token`=:booking_token AND `passenger_type` = 'Contact'";
                    $this->stmts = $this->conn->prepare( $query );
                
                    $this->stmts->bindParam(":booking_token", $row["users__booking_token"]);
                    $this->stmts->execute();
                    //$this->stmts1->debugDumpParams();
                    //$num_counts = $this->stmts1->rowCount();
                    while ($rows1 = $this->stmts->fetch(PDO::FETCH_ASSOC)) {
                        $passenger_name = $rows1['name'];
                    }

            $obj = new stdClass();
            $obj->invoiceNumber = "Invoice No - ".$row["token"];
            $obj->nameOfInvoice = $passenger_name;
            $obj->bookedDate    = convertDate("d M Y",$row["date_time"]);
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->razorPayId    = $row["payment_id"];
            $obj->gstNumber = $row["gstin_number"];
            $obj->serviceDescription  = $row["service_business_type"];
            $obj->hsnCode       = $row["hsn_code"];
            if((int)$row['coupon_type'] == 2){          //Category
                $obj->discount = (int)$row['discount_amount'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj->discount = (int)$row['cart_dis_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"]);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"]);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                }else{
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"]);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
                }
                
            }else{
               
                if((int)$row['coupon_type'] == 2){
                    $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"] - $obj->discount);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){
                    $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
                }else{
                    $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);
                    
                    $obj->markup_discount = ($row["markup_amount"] - $obj->discount);
                    $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
                    
                }
            }
            //New Cmd the code
            // $obj->taxableValue  = round(($row["net_amount"] - (int)$row["markup_amount"])/1.18);
            // $obj->gst           = round(($row["net_amount"] - (int)$row["markup_amount"]) - $obj->taxableValue);
            // $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];

            // $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
            // $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
            // $obj->markup_discount = $row["markup_amount"];

            if($row["is_agent"]!='0' && $row["is_approved"]!='0'){
                $obj->convenienceFee = 0;
                $obj->convenienceFeeGst = 0;
                $obj->total_convenienceFeeGst = 0;

                $obj->agent_conv_fee = round($row["convenience_fee"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"]);
                $obj->agent_conv_fee_GST = round($row["cf_tax"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"]);
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            } else {
                $obj->convenienceFee = round(number_format((float)$row["net_amount"]*0.03, 2, '.', ''));
                $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));
                $obj->total_convenienceFeeGst = $obj->convenienceFee + $obj->convenienceFeeGst;

                $obj->agent_conv_fee = 0;
                $obj->agent_conv_fee_GST = 0;
                $obj->total_agent_conv_fee = 0;
            }
            // $obj->markupAmount = $row["markup_amount"];
            // $obj->markup_GST = ceil(((float)$row["markup_amount"]*18)/100);
            // $obj->markup_discount = ceil((float)$row["markup_amount"] + (((float)$row["markup_amount"]*18)/100));

            

            // if($row["is_agent"]!='0'){
            //     $obj->agent_conv_fee = $row["convenience_fee"];
            //     $obj->agent_conv_fee_GST = ceil(((float)$row["convenience_fee"]*18)/100);
            //     $obj->total_agent_conv_fee = ceil((float)$row["convenience_fee"] + (((float)$row["convenience_fee"]*18)/100));
            // }else{
            //     $obj->agent_conv_fee = 0;
            //     $obj->agent_conv_fee_GST = 0;
            //     $obj->total_agent_conv_fee = 0;
            // }
            $total_tax_value = $obj->taxableValue + + (int)$obj->markupAmount + (float)$obj->agent_conv_fee;
            $total_gst = $obj->gst + $obj->agent_conv_fee_GST + $obj->markup_GST;
            $total_invoice_value = $total_tax_value + $total_gst;

            $obj->airportzo_gstNo = $row["airportzo_gst_no"];
            $obj->place_of_service = $row["place_of_service"];
            $obj->total_tax_value = $total_tax_value;
            $obj->total_gst = $total_gst;
            $obj->total_invoice_value = $total_invoice_value;

            $totalInvoice           = $obj->total_invoice_value + $obj->convenienceFee + $obj->convenienceFeeGst;
            $obj->totalInvoice      = round($totalInvoice);
            array_push($array, $obj);
        }
        return $array;
    }
    public function creditRegisterCheck(){
        $query = "SELECT 
        `users`.`name` AS `customer_name`,
        `users__booking_detail`.`date_time`,
        `users__booking`.`booking_number`,
        `users__booking`.`airportzo_gst_no`,
        `users__booking`.`place_of_service`,
        `users__booking`.`token` AS `users__booking_token`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`refund_id`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`after_discount_net_amt`,
        `users__booking_detail`.`cancelled_invoice_token`,
        `users__booking`.`payment_id`,
        `service`.`name` AS `service_name`,
        COALESCE(`business_type`.`name`,'') AS `service_business_type`,
        COALESCE(`business_type`.`hsn`,'') AS `hsn_code`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`total_service`,
        `users__booking`.`gstin_number`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        WHERE `users__booking_detail`.`status`='cancelled'
        $this->dateQuery ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function creditRegisterView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->creditNumber  = $row["cancelled_invoice_token"];
            $obj->cnDate        = convertDate("d M Y",$row["cancelled_date"]);
            $obj->invoiceNumber = $row["users__booking_token"];
            $obj->airportzo_gst_no = $row["airportzo_gst_no"];
            $obj->place_of_service = $row["place_of_service"];
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->nameOfInvoice = $row["customer_name"];
            $obj->serviceType   = $row["service_business_type"];
            $obj->hsnCode       = $row["hsn_code"];
            // $obj->totalValue    = $row["net_amount"];
            $obj->totalValue    = $row["after_discount_net_amt"];
            $obj->cancellationFee  = $row["cancellation_fee"]+$row["platform_fee"];
            // $obj->refundableAmount = round((float)$row["net_amount"] -($obj->cancellationFee));
            $obj->refundableAmount = round((float)$row["refunded_amount"]);
            $obj->taxableValue = round($obj->refundableAmount/1.18);
            $obj->gstOnCancelledService = round($obj->refundableAmount*(18/118));
            $obj->razorPayId    = $row["payment_id"];
            $obj->refundId      = $row["refund_id"];
            $obj->gstin_number  = $row["gstin_number"];
            
            array_push($array, $obj);
        }
        return $array;
    }
    public function revenuePriceCheck(){
        $query = "SELECT `service__provider_company`.`name` AS `provider_company`,
        COALESCE(`business_type`.`name`,'') AS `service_business_type`,
        COALESCE(`business_type`.`hsn`,'') AS `hsn_code`,
        `service__provider_price_log`.`price_adult` AS `adult`,
        `service__provider_price_log`.`price_children` AS `child`,
        `service__provider_price_log`.`additional_price_adult` AS `add_adult`,
        `service__provider_price_log`.`additional_price_children` AS `add_child`
        FROM `service__provider_price_log`
        INNER JOIN `service__provider_company` ON 			
                `service__provider_company`.`token`=`service__provider_price_log`.`service_provider_company_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service__provider_price_log`.`business_type_token`
        WHERE 1
        $this->dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function revenuePriceView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->providerCompany = $row["provider_company"];
            $obj->businessType    = $row["service_business_type"];
            $obj->hsnCode         = $row["hsn_code"];
            $obj->GST             = "18%";
            
            $obj1 = new stdClass();
            $obj1->priceAdult      = $row["adult"];
            $obj1->priceChildren   = $row["child"];
            $obj1->addPriceAdult   = $row["add_adult"];
            $obj1->addPriceChildren= $row["add_child"]; 
            
            $obj2 = new stdClass();
            $obj2->priceAdult      = number_format((float)$row["adult"]-($row["adult"]*0.18), 2, '.', '');
            $obj2->priceChildren   = number_format((float)$row["child"]-($row["child"]*0.18), 2, '.', '');
            $obj2->addPriceAdult   = number_format((float)$row["add_adult"]-($row["add_adult"]*0.18), 2, '.', '');;
            $obj2->addPriceChildren= number_format((float)$row["add_child"]-($row["add_child"]*0.18), 2, '.', '');
            
            $obj->priceInclusiveGst = $obj1;
            $obj->priceExclusiveGst = $obj2;
            
            array_push($array, $obj);
        }
        return $array;
    }
    function distributorCommissionReport(){
        $distCom = "SELECT `users__passenger`.`name` AS `customerName`,
        `users`.`is_agent`,
        `users`.`is_approved`,
        `users__booking`.`date_time`,
        `users__booking`.`booking_number`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`total_service`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `service__distributor_agent`.`name` AS `agentName`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`markup_percentage`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `service__distributor`.`markup_type`
        FROM `users__booking_detail`
        INNER JOIN `users__booking_passenger` ON `users__booking_passenger`.`booking_token`=`users__booking_detail`.`booking_token` AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        LEFT JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        LEFT JOIN `service__distributor_agent` ON `users__booking`.`agent_token`=`service__distributor_agent`.`token`
        WHERE `users__booking_detail`.`status`='Completed' AND `users__booking`.`is_airportzo_user`='0' $this->dateQuery GROUP BY `users__booking_detail`.`token` ORDER BY `users__booking_detail`.`id` DESC";
        $distStmt = $this->conn->prepare( $distCom );
        $distStmt->execute();
        return $distStmt;
    }
    function viewDistributorCommissionReport($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->customerName  = $row["customerName"];
            $obj->dateTime        = convertDate("d M Y",$row["date_time"]);
            $obj->invoiceNumber = "-";
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->status = $row["status"];
            $obj->cancelledDate   = $row["cancelled_date"]=="0000-00-00 00:00:00"?'-':convertDate("d M Y",$row["cancelled_date"]);
            $obj->agentName       = $row["agentName"] == null ? '-' : $row["agentName"] ;
            $obj->gstValue    = number_format($row["net_amount"]*18/118, 2, '.', '');
            $obj->excludeGstValue    = number_format($row["net_amount"]*100/118, 2, '.', '');
            $obj->totalValue    = $row["net_amount"];
            if($row["markup_type"] == "Percentage"){
                $obj->markup_percentage    = $row["markup_percentage"]."%";
            }else if($row["markup_type"] == "Flat" || $row["markup_type"] == ""){
                $obj->markup_percentage    = $row["markup_percentage"];
            }
            
            $obj->markup_amount    = $row["markup_amount"];
            $obj->distPercentage = $row["az_sd_percentage"];
            $obj->distCommisionValue = number_format($obj->excludeGstValue*$row["az_sd_percentage"]/100, 2, '.', '');
            $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');
            $obj->totalCommissionValueIncGst = number_format($obj->distCommisionValue+$obj->gstDistCommisionValue, 2, '.', '');

            if($row["is_agent"]!='0' && $row["is_approved"]!='0'){
                $obj->agent_conv_fee = round($row["convenience_fee"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"]);
                $obj->agent_conv_fee_GST = round($row["cf_tax"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"]);
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            } else {
                $obj->agent_conv_fee = 0;
                $obj->agent_conv_fee_GST = 0;
                $obj->total_agent_conv_fee = 0;
            }
            $obj->taxable_value_comm_markup = round($obj->distCommisionValue + $obj->agent_conv_fee);
            $obj->gst_value_comm_markup = round($obj->gstDistCommisionValue + $obj->agent_conv_fee_GST);
            $obj->total_value_comm_markup = round($obj->taxable_value_comm_markup + $obj->gst_value_comm_markup);
            array_push($array, $obj);
        }
        return $array;
    }
    function spReport(){
        $query = "SELECT `users__booking`.`date_time`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `users__booking_detail`.`cancellation_hours`,
        `service__provider_company_location`.`token` AS `service__provider_company_location_token`,
        `service__provider`.`name` AS `provider_name`,
        `business_type`.`name` AS `business_type`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `service__location`.`additional_price_adult`,
        `service__location`.`additional_price_children`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`markup_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token` AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token`=`service__provider_company_location`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        INNER JOIN `service__location` ON `service__location`.`service_token`=`users__booking_detail`.`service_token`
        WHERE `users__booking_detail`.`status`='Completed' AND `service__provider_company_location_cancel_charge`.`status`='1' $this->dateQuery GROUP BY `users__booking_detail`.`token`";
        $spStmt = $this->conn->prepare( $query );
        $spStmt->execute();
        return $spStmt;
    }
    function serviceCancelledPercentage($cancelHours, $companyLocationToken){
        $queryHours = "SELECT `percentage` 
        FROM `service__provider_company_location_cancel_charge` 
        WHERE `service_provider_company_location_token`='$companyLocationToken' AND `hours`='$cancelHours'";
        $hoursStmt = $this->conn->prepare( $queryHours );
        $hoursStmt->execute();
        if($hoursStmt->rowCount() > 0){
             $row = $hoursStmt->fetch(PDO::FETCH_ASSOC);
             return $row["percentage"];
        }else{
            return '-';
        }
       
    }
    function viewSPReport($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->bookingDate  = convertDate("d M Y",$row["date_time"]);
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->status = $row["status"];
            $obj->cancelledDate   = $row["cancelled_date"]=="0000-00-00 00:00:00"?'-':convertDate("d M Y",$row["cancelled_date"]);
            $obj->cancellationHours = $row["cancellation_hours"]=='0'?'-':'before '.$row["cancellation_hours"].' hours';
            $cancellationPercentage = $this->serviceCancelledPercentage($row["cancellation_hours"],$row["service__provider_company_location_token"]);
            $obj->cancellationPercentage = $cancellationPercentage;
            $obj->providerName       = $row["provider_name"];
            $obj->businessType       = $row["business_type"];
            $obj->adult       = $row["total_adult"]>0?'1':'0';
            $obj->child       = $row["total_children"]>0?'1':'0';
            $obj->additionalAdult  = $row["total_adult"]>1?$row["total_adult"]-1:'0';
            $obj->additionalChild  = $row["total_children"]>1?$row["total_children"]-1:'0';
            $obj->priceAdult       = $row["price_adult"];
            $obj->priceChildren       = $row["price_children"];
            $obj->additionalPriceAdult = $row["additional_price_adult"];
            $obj->additionalPriceChildren = $row["additional_price_children"];
            $obj->gross = $row["net_amount"]-$row["markup_amount"];
            $obj->servicePayable = number_format($obj->gross/1.18, 2, '.', '');
            $obj->gstValue = number_format($obj->gross*18/118, 2, '.', '');
            array_push($array, $obj);
        }
        return $array;
    }
    function customerJourney(){
        $custQuery = "SELECT `users__passenger`.`name` AS `customerName`,
		`users__booking`.`date_time`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `business_type`.`name` AS `business_type`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`total_service`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        (`users__booking_detail`.`cancellation_fee`+`users__booking_detail`.`platform_fee`) AS `cancellation_value`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`
        FROM `users__booking_detail`
        INNER JOIN `users__booking_passenger` ON `users__booking_passenger`.`booking_token`=`users__booking_detail`.`booking_token` AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`

        WHERE `users__booking_detail`.`status` != 'Draft' $this->dateQuery
        GROUP BY `users__booking_detail`.`token`";
        $custStmt = $this->conn->prepare( $custQuery );
        $custStmt->execute();
        return $custStmt;
    }
    function viewCustomerJourney($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->customerName    = $row["customerName"];
            $obj->bookingDate  = convertDate("d M Y",$row["date_time"]);
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->status = $row["status"];
            $obj->cancelledDate   = $row["cancelled_date"]=="0000-00-00 00:00:00"?'-':convertDate("d M Y",$row["cancelled_date"]);
            $obj->businessType       = $row["business_type"];
            $obj->revenueBaseValue = number_format($row["net_amount"]/1.18, 2, '.', '');
            $obj->revenueGstValue = number_format($row["net_amount"]*18/118, 2, '.', '');
            $obj->revenueSaleValue = $row["net_amount"];
            $obj->convenienceFee = number_format($row["net_amount"]*0.03, 2, '.', ''); //number_format($row["total_service"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"],2,'.','');
            $obj->convenienceFeeGst = number_format( $obj->convenienceFee*0.18, 2, '.', ''); //number_format($row["total_service"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"],2,'.','');
            $obj->totalRevenue = number_format($row["net_amount"]+$obj->convenienceFee+$obj->convenienceFeeGst, 2, '.', '');
            $obj->cancelBaseValue = number_format($row["cancellation_value"]/1.18, 2, '.', '');
            $obj->cancelGstValue = number_format($row["cancellation_value"]*18/118, 2, '.', '');
            $obj->cancelSaleValue = $row["cancellation_value"];
            $obj->distCommissionExclGstValue = number_format($row["az_sd_commision_amount"]/1.18, 2, '.', '');
            $obj->distCommissionGstValue = number_format($row["az_sd_commision_amount"]*18/118, 2, '.', '');
            $obj->distCommissionTotalValue = $row["az_sd_commision_amount"];
            $amtPayToServiceProvider = ($row["net_amount"]-$row["az_sp_commision_amount"]);
            $obj->payToServiceProviderBaseVal = number_format($amtPayToServiceProvider/1.18, 2, '.', '');
            $obj->payToServiceProviderGstValue = number_format($amtPayToServiceProvider*18/118, 2, '.', '');
            $obj->payToServiceProviderTotalVal = number_format($amtPayToServiceProvider, 2, '.', '');
            $obj->profit = number_format($obj->revenueBaseValue+$obj->convenienceFee-($obj->cancelBaseValue+$obj->distCommissionExclGstValue+$obj->payToServiceProviderBaseVal), 2, '.', '');
            $obj->cashFlow = number_format($obj->totalRevenue-$obj->cancelSaleValue-$obj->distCommissionTotalValue-$obj->payToServiceProviderTotalVal, 2, '.', '');
            array_push($array, $obj);
        }
        return $array;
    }
    function misFinance(){
        $query = "SELECT
        COALESCE(SUM(`users__booking_detail`.`net_amount`),0) AS `net_amount`,
        `users__booking`.`service_amount` AS `service_amount`,
        `users__booking`.`convenience_fee` AS `convenience_fee`,
        COALESCE(SUM(`users__booking`.`cf_tax`),0) AS `cf_tax`,
        COALESCE(SUM(`users__booking_detail`.`cancellation_fee`),0) AS `cancellation_fee`,
        COALESCE(SUM(`users__booking_detail`.`platform_fee`),0) AS `platform_fee`,
        `users__booking_detail`.`az_sd_commision_amount` AS `distributor_commission`,
        `users__booking_detail`.`az_sd_percentage` AS `distributor_commission_percentage`,
        SUM(`users__booking_detail`.`net_amount` - `users__booking_detail`.`az_sp_commision_amount`) AS `az_sp_commision_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        WHERE $this->dateFilterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt; 
    }

    function distributortaxvalue(){
        $query = "SELECT COALESCE(SUM(service_amount + convenience_fee),0) AS distributortax_value FROM `users__booking`
        WHERE $this->dateFilterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt; 
    }

    function distributorTotalreport(){
        $query = "SELECT
        SUM(az_sd_commision_amount) AS `az_sdcommision_amount`,
        SUM(`users__booking_detail`.`net_amount` - `users__booking_detail`.`az_sp_commision_amount`) AS `az_sp_commision_amount`
        FROM `users__booking_detail` WHERE `users__booking_detail`.`status`='Completed' AND $this->dateFilterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        // $stmt->debugDumpParams();
        return $stmt;
    }

    function Service_distributor_commision(){
        $query = "SELECT COALESCE(SUM(az_sd_commision_amount),0) AS `az_sdcommision_amount`,
        COALESCE(SUM(`users__booking_detail`.`net_amount`),0) AS `net_amount`,
        `users__booking_detail`.`az_sd_percentage` AS `az_sd_percentage`
        FROM `users__booking_detail` WHERE `status`='Completed' AND $this->dateFilterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        // $stmt->debugDumpParams();
        return $stmt;
    }

    function misFinance1(){
        $query = "SELECT COALESCE(SUM(`users__booking_detail`.`net_amount` - `users__booking_detail`.`az_sp_commision_amount`),0) AS `azspcommision_amount` FROM `users__booking_detail` WHERE $this->dateFilterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        // $stmt->debugDumpParams();
        return $stmt;
    }

    function profitLossDateFilterAndYearWise(){
        //month filter for sales
        $this->dateFilterQuery = "`users__booking`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->distributortaxvalue();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->salesInMonth  = number_format($row["distributortax_value"], 2, '.', '');
        //year filter for sales
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->salesInYear  = number_format($row["net_amount"]/1.18+$row["convenience_fee"], 2, '.', '');
        //month filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $refundableAmount= $row["net_amount"]-$cancellationFee;
        $obj->creditNotesInMonth = number_format($refundableAmount/1.18, 2, '.', '');
        //Year filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $refundableAmount= $row["net_amount"]-$cancellationFee;
        $obj->creditNotesInYear = number_format($refundableAmount/1.18, 2, '.', '');
        //net sales
        $obj->netSalesInMonth = number_format($obj->salesInMonth-$obj->creditNotesInMonth, 2, '.', '');
        $obj->netSalesInYear = number_format($obj->salesInYear-$obj->creditNotesInYear, 2, '.', '');
        //month filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->Service_distributor_commision();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $serviceExcludeGstValue = $row["net_amount"]*100/118;
//        echo $serviceExcludeGstValue."<br>";
//        echo $row["net_amount"]."<br>";
//        echo $row["az_sdcommision_amount"]."<br>";
        $obj->distributorCommissionInMonth  = number_format(($row["net_amount"]-$serviceExcludeGstValue)*$row["az_sd_percentage"]/100, 2, '.', '');//$row["net_amount"] * ($row["distributor_commission_percentage"] / 100);//number_format($row["distributor_commission"], 2, '.', '');

        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $serviceProviderPayable = number_format($row["net_amount"]/1.18, 2, '.', '');
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $obj->serviceProviderPaymentInMonth = $row["az_sp_commision_amount"]==null ? '0' : number_format($row["az_sp_commision_amount"], 2, '.', '');//number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        //year filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->distributorCommissionInYear  = number_format($row["distributor_commission"], 2, '.', '');
        $serviceProviderPayable = number_format($row["net_amount"]/1.18, 2, '.', '');
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $obj->serviceProviderPaymentInYear = number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        //total Expenses
        $obj->totalExpensesInMonth = number_format($obj->distributorCommissionInMonth+$obj->serviceProviderPaymentInMonth, 2, '.', '');
        $obj->totalExpensesInYear = number_format($obj->distributorCommissionInYear+$obj->serviceProviderPaymentInYear, 2, '.', '');
        //gross Profit
        $obj->grossProfitInMonth = number_format($obj->netSalesInMonth-$obj->totalExpensesInMonth, 2, '.', '');
        $obj->grossProfitInYear = number_format($obj->netSalesInYear-$obj->totalExpensesInYear, 2, '.', '');
        return $obj;
    }
    function cashFlowDateFilterAndYearWise(){
        //month filter for sales
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $net_amount = $row["net_amount"];
        $convenienceFee = number_format((float)$row["net_amount"]*0.03, 2, '.', '');
        $convenienceFeeGst = number_format((float)$convenienceFee*0.18, 2, '.', '');
        $totalInvoice = $net_amount+$convenienceFee+$convenienceFeeGst;
        $obj->salesInMonth  = round($totalInvoice);//number_format($row["net_amount"]+$row["convenience_fee"]+$row["cf_tax"], 2, '.', '');
        //year filter for sales
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->salesInYear  = number_format($row["net_amount"]+$row["convenience_fee"]+$row["cf_tax"], 2, '.', '');
        //month filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cancellationFee = $row["cancellation_fee"]+$row["platform_fee"];
        $obj->creditNotesInMonth = $row["net_amount"]-$cancellationFee;
        //Year filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $obj->creditNotesInYear= $row["net_amount"]-$cancellationFee;
        //net sales
        $obj->netSalesInMonth = number_format($obj->salesInMonth-$obj->creditNotesInMonth, 2, '.', '');
        $obj->netSalesInYear = number_format($obj->salesInYear-$obj->creditNotesInYear, 2, '.', '');
        //month filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->distributorTotalreport();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $distributor_commission = $row["az_sdcommision_amount"];
        $gstDistCommisionValue = number_format($distributor_commission*18/100, 2, '.', '');
        $totalCommissionValueIncGst = number_format($distributor_commission+$gstDistCommisionValue, 2, '.', '');
        $obj->distributorCommissionInMonth  = round($totalCommissionValueIncGst);//number_format($row["distributor_commission"], 2, '.', '');
        
        // $serviceProviderPayable = number_format($row["net_amount"], 2, '.', '');
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->misFinance1();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->serviceProviderPaymentInMonth = number_format($row["azspcommision_amount"], 2, '.', '');//number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        //year filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->distributorCommissionInYear  = number_format($row["distributor_commission"], 2, '.', '');
        $serviceProviderPayable = number_format($row["net_amount"], 2, '.', '');
        $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        $obj->serviceProviderPaymentInYear = number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        //total Expenses
        $obj->totalExpensesInMonth = number_format($obj->distributorCommissionInMonth+$obj->serviceProviderPaymentInMonth, 2, '.', '');
        $obj->totalExpensesInYear = number_format($obj->distributorCommissionInYear+$obj->serviceProviderPaymentInYear, 2, '.', '');
        //gross Profit
        $obj->grossProfitInMonth = number_format($obj->netSalesInMonth-$obj->totalExpensesInMonth, 2, '.', '');
        $obj->grossProfitInYear = number_format($obj->netSalesInYear-$obj->totalExpensesInYear, 2, '.', '');
        return $obj;
    }
}