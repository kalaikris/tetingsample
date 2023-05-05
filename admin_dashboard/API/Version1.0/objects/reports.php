<?php
class reports extends Database {

    public function renvenueChecks1(){
        $query = "SELECT 
        `users`.`is_agent`,
        `users`.`is_approved`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`discount_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`gstin_number`,
        `users__booking`.`is_agent` AS `booking_is_agent`,
        `users__booking`.`agent_token`,
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
        `users__booking`.`discount_amount` AS `cart_dis_amt`,
        `users__booking`.`invoice_token` AS `invoiceNumber`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed' AND 
        $this->filterQuery ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function renvenueCheck(){
        $query = "SELECT COUNT(`id`) AS `count`,
        COALESCE(SUM(`users__booking_detail`.`net_amount`),0) AS `total_net`,
        COALESCE(SUM(`users__booking_detail`.`after_discount_net_amt`),0) AS `total`,
        COALESCE(SUM(`users__booking_detail`.`cancellation_fee`),0) AS `cancellation_fee`,
        COALESCE(SUM(`users__booking_detail`.`platform_fee`),0) AS `platform_fee`,
        COALESCE(SUM(`users__booking_detail`.`refunded_amount`),0) AS `refunded_amount`
        FROM `users__booking_detail`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed' AND $this->filterQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function thisMonthRevenueSummary(){
        // if($this->filter == "MonthlyWiseFilter"){
        //     $this->filterQuery = " `date_time` LIKE '$this->thisMonth%'";
        // }else{
        //     $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate'";
        // }
        
        // $stmt = $this->renvenueCheck();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj = new stdClass();
        // $obj->totalCount  = $row["count"];
        // $obj->totalAmount = $row["total"];
        // $obj->totalConv = ceil(($row["total"] * 3)/100);
        // $obj->totalAmount_excl = ceil(($row["total"] * 100)/118);
        // $obj->totalAmount_excl_with_conv = $obj->totalAmount_excl + $obj->totalConv;
        
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `users__booking_detail`.`date_time` LIKE '$this->thisMonth%'";
        }else{
            $this->filterQuery = " `users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->endDate'";
        }
        $stmt = $this->renvenueChecks1();
        
        $totalInvoice = 0;
        $totalCount = $stmt->rowCount();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
               if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
               }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }

            if($row["booking_is_agent"]!='0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = round(number_format((float)$obj1->agent_conv_fee*0.18, 2, '.', ''));
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = round(number_format((float)$obj1->convenienceFee*0.18, 2, '.', ''));
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }
            
            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;//2119 + 636 + 0

            $totalInvoice  += ($total_tax_value + $obj1->convenienceFee);
        }
        $obj = new stdClass();
        $obj->totalCount  = $totalCount;
        $obj->totalAmount_excl_with_conv =  number_format((float)$totalInvoice, 2, '.', '');

        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` LIKE '$this->thisMonth%' AND `status`='cancelled'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate' AND `status`='cancelled'";
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->cancelledCount  = $row["count"];
        // $obj->cancelledAmount = $row["total"];
        // $obj->cancelledAmount = $row["cancellation_fee"] + $row["platform_fee"];
        // $obj->cancelledAmount_excl = ceil((($row["cancellation_fee"]  + $row["platform_fee"]) * 100) / 118);
        $obj->cancelledAmount = ceil($row["refunded_amount"]/1.18);
        
        $obj->netCount        = $obj->totalCount - $obj->cancelledCount;

        // $obj->netAmount_refund  = ceil((($obj->totalAmount - $obj->cancelledAmount) * 100)/118);
        // $obj->netAmount         = ceil($obj->totalAmount_excl_with_conv - $obj->netAmount_refund);

        $obj->netAmount       = $obj->totalAmount_excl_with_conv - $obj->cancelledAmount;
        
        return $obj;
    }
    function fromAprilRevenueSummary(){
        // if($this->filter == "MonthlyWiseFilter"){
        //     $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // }else{
        //     $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate'";
        // }
        
        // $stmt = $this->renvenueCheck();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj = new stdClass();
        // $obj->totalCount  = $row["count"];
        // $obj->totalAmount = $row["total"];
        // $obj->totalConv = ceil(($row["total"] * 3)/100);
        // $obj->totalAmount_excl = ceil(($row["total"] * 100)/118);
        // $obj->totalAmount_excl_with_conv = $obj->totalAmount_excl + $obj->totalConv;
        
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        }else{
            $this->filterQuery = " `users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->endDate'";
        }
        
        $stmt = $this->renvenueChecks1();
        $totalInvoice = 0;
        $totalCount = $stmt->rowCount();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
               if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
               }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }

            if($row["booking_is_agent"]!='0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = round(number_format((float)$obj1->agent_conv_fee*0.18, 2, '.', ''));
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = round(number_format((float)$obj1->convenienceFee*0.18, 2, '.', ''));
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }
            
            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;//2119 + 636 + 0

            $totalInvoice  += $total_tax_value + $obj1->convenienceFee;
        }
        $obj = new stdClass();
        $obj->totalCount  = $totalCount;
        $obj->totalAmount_excl_with_conv = number_format((float)$totalInvoice, 2, '.', '');

        if($this->filter == "MonthlyWiseFilter"){
           $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate' AND `status`='cancelled'"; 
        }else{
          $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate' AND `status`='cancelled'";  
        }
        
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->cancelledCount  = $row["count"];
        // $obj->cancelledAmount = $row["total"];
        // $obj->cancelledAmount = $row["cancellation_fee"] + $row["platform_fee"];
        // $obj->cancelledAmount_excl = ceil((($row["cancellation_fee"]  + $row["platform_fee"]) * 100) / 118);
        
        $obj->cancelledAmount = ceil($row["refunded_amount"]/1.18);

        $obj->netCount          = $obj->totalCount - $obj->cancelledCount;

        // $obj->netAmount_refund  = ceil((($obj->totalAmount - $obj->cancelledAmount) * 100)/118);
        // $obj->netAmount         = ceil($obj->totalAmount_excl_with_conv - $obj->netAmount_refund);
        
        $obj->netAmount       = $obj->totalAmount_excl_with_conv - $obj->cancelledAmount;
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
        // $obj->cancelledAmount = $row["total"];
        $obj->cancelledAmount = ceil($row["refunded_amount"]/1.18);

        // $obj->cancelledConv = ceil(($row["total"] * 3)/100);
        // $obj->cancelledAmount_excl = ceil(($row["total"] * 100)/118);
        // $obj->cancelledAmount_excl_with_conv = $obj->cancelledAmount_excl + $obj->cancelledConv;
        
        if($this->filter == "MonthlyWiseFilter"){
             $this->filterQuery = " `date_time` LIKE '$this->thisMonth%' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }else{
             $this->filterQuery = " `date_time` BETWEEN '$this->startDate' AND '$this->endDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }
       
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->refundIssuedCount  = $row["count"];
        // $obj->refundIssuedAmount = ceil(($row["total"]-($row["cancellation_fee"]+$row["platform_fee"]))/1.18);
        $obj->refundIssuedAmount = ceil($row["refunded_amount"]/1.18);
        
        $obj->netCount        = $obj->cancelledCount - $obj->refundIssuedCount;
        $obj->netAmount       = $obj->cancelledAmount - $obj->refundIssuedAmount;
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
        // $obj->cancelledAmount = $row["total"];
        $obj->cancelledAmount = ceil($row["refunded_amount"]/1.18);
        
        if($this->filter == "MonthlyWiseFilter"){
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->toDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }else{
            $this->filterQuery = " `date_time` BETWEEN '$this->fromDate' AND '$this->endDate' AND `status`='cancelled' AND `refund_status`='Refunded'";
        }
        $stmt = $this->renvenueCheck();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->refundIssuedCount  = $row["count"];
        // $obj->refundIssuedAmount = $row["total"];
        $obj->refundIssuedAmount = ceil($row["refunded_amount"]/1.18);
        
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
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`,
         `users__booking`.`gstin_number`,
         `users__booking`.`service_distributor_token`,
         `users__booking`.`is_airportzo_user`,
         `users__booking`.`token` AS `users__booking_token`,
         `users__booking`.`convenience_fee`,
         `users__booking`.`cf_tax`,
         `users__booking`.`total_service`,
         `users__booking`.`booking_type`,
         `users__booking`.`coupon_type`,
         `users__booking`.`cart_coupon_type`,
         `users__booking`.`discount_amount` AS `cart_dis_amt`,
         `users__booking`.`membership_number`,
         `users__booking`.`is_agent` AS `booking_is_agent`,
         `users__booking`.`agent_token`,
         `service__provider_company`.`name` AS `assigned_to`,
         `users__booking`.`payment_id`,
         `service__distributor`.`name` AS `service__distributor_name`,
         `service__provider`.`name` AS `service__provider_name`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        LEFT JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        INNER JOIN `service__provider_company` ON `users__booking_detail`.`company_token` = `service__provider_company`.`token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        INNER JOIN `service__provider` ON `service__provider`.`token` = `service__provider_company`.`service_provider_token`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed' $this->dateQuery ORDER BY `users__booking_detail`.`id` DESC";
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

            //Get Passenger Name from this query
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
            // $obj->customerName = $passenger_name;
            // $obj->customerName = $row["customer_name"];
            // $obj->gstNumber = $row["gstin_number"];

                if($row['service_distributor_token'] != '1111111111' && (int)$row['is_airportzo_user'] == 0 && (int)$row['is_agent'] == 1){
                    $querys = "SELECT `name`,`gst_number` FROM `service__distributor` WHERE `token` = :service_distributor_token AND `status`='0'";
                    $this->stmts1 = $this->conn->prepare($querys);
                    $this->stmts1->bindParam(":service_distributor_token", $row['service_distributor_token']);
                    $this->stmts1->execute();
                    // $this->stmt->debugDumpParams();
                    $checkrows = $this->stmts1->fetch(PDO::FETCH_ASSOC);
                    $obj->customerName = $checkrows["name"];
                    $obj->gstNumber = $checkrows["gst_number"] != '' ? $checkrows["gst_number"] : "-";
                }else{
                    $obj->customerName = $passenger_name;
                    $obj->gstNumber = $row["gstin_number"] != '' ? $row["gstin_number"] : "-";
                }

            $obj->serviceDistributorName    = $row["service__distributor_name"];
            $obj->serviceProviderName    = $row["service__provider_name"];
            $obj->membershipNumber    = $row["membership_number"];

            if($row["agent_name"] != ''){
                $obj->agentName    = $row["agent_name"];
            }else{
                $obj->agentName    = '-';
            }
            
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
            
            if($row["booking_is_agent"]!='0' && $row["agent_token"]!=''){
                $obj->agent_convin_fee = $row["agent_conv_fee_commi"];
                $obj->convenienceFee = 0;
                $obj->convenienceFeeGst = $row["gst_agent_conv_fee_commi"];
                // $obj->agent_convin_fee = round($row["convenience_fee"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"]);
                // $obj->convenienceFee = 0;
                // $obj->convenienceFeeGst = round($row["cf_tax"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"]);
            } else {
                $obj->agent_convin_fee = 0;
                if((int)$row['coupon_type'] == 2){          //Category
                    //-------Category Exclude Method--------//
                    // $net_ex_gst = (((int)$row["net_amount"] * 100) / 118);
                    // $convin_cal = round(abs($net_ex_gst - (int)$row['discount_amount']));
                    // $obj->convenienceFee = round(number_format(($convin_cal + (float)$convin_cal*0.18)*0.03, 2, '.', ''));
                    // $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));

                    //-------Category Include Method--------//
                    $obj->convenienceFee = $row["user_conv_fee_commi"];
                    $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));

                }else if((int)$row['coupon_type'] == 1){    //Cart 

                    // $trade_discount = trim((int)$row['cart_dis_amt']/(int)$row['count_booking']);
                    $trade_discount = (int)$row['cal_discount_amt'];

                    // if($row['cart_coupon_type'] == 'Incl Gst'){ 
                        $obj->convenienceFee = $row["user_conv_fee_commi"];
                        $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));

                    // }else if($row['cart_coupon_type'] == 'Excl Gst'){
                    //     $net_ex_gst = (((int)$row["net_amount"] * 100) / 118);
                    //     $convin_cal = round(abs(($net_ex_gst) - $trade_discount));
                    //     $obj->convenienceFee = round(number_format(($convin_cal + (float)$convin_cal*0.18)*0.03, 2, '.', ''));
                    //     $obj->convenienceFeeGst = round(number_format((float)$obj->convenienceFee*0.18, 2, '.', ''));
                    // }
                }else{
                    $obj->convenienceFee = $row["user_conv_fee_commi"];
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
                $obj->trade_discount = trim((int)$row['cal_discount_amt']);
                $net_ex_gst = (int)$obj->netAmount;

                //-------Category Include Method--------//
                //for highest value in discount amount
                if($net_ex_gst < (int)$row['discount_amount']){
                    $obj->serv_val_post_discount = round(abs($net_ex_gst - $obj->trade_discount));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round(-$totalInvoice); 
                }else{
                    $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round($totalInvoice); 
                }

                //-------Category Exclude Method--------//
                // $net_ex_gst = (((int) $obj->netAmount * 100) / 118);
                //for highest value in discount amount
                // if($net_ex_gst < (int)$row['discount_amount']){
                //     $obj->serv_val_post_discount = round(abs($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                //     $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     $obj->totalInvoice      = round(-$totalInvoice); 
                // }else{
                //     $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                //     $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     $obj->totalInvoice      = round($totalInvoice); 
                // }
                // $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                // $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                // // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                // $obj->totalInvoice      = round($totalInvoice); 

            }else if((int)$row['coupon_type'] == 1){    //Cart 

                // $obj->trade_discount = trim((int)$row['cart_dis_amt']/(int)$row['count_booking']);

                $obj->trade_discount = (int)$row['cal_discount_amt'];

                // if($row['cart_coupon_type'] == 'Incl Gst'){ 
                    $obj->serv_val_post_discount = round(abs($obj->netAmount - $obj->trade_discount));
                    $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                    $obj->totalInvoice      = round($totalInvoice); 
                // }else if($row['cart_coupon_type'] == 'Excl Gst'){
                //     $net_ex_gst = (((int) $obj->netAmount * 100) / 118);
                    
                //     //for highest value in discount amount
                //     if($net_ex_gst < (int)$row['discount_amount']){
                //         $obj->serv_val_post_discount = round(abs($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                //         $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //         // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //         $obj->totalInvoice      = round(-$totalInvoice); 
                //     }else{
                //         $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                //         $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //         // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //         $obj->totalInvoice      = round($totalInvoice); 
                //     }

                //     // $obj->serv_val_post_discount = round(($net_ex_gst - $obj->trade_discount) + abs(($net_ex_gst - $obj->trade_discount) * 0.18));
                //     // $totalInvoice           = $obj->serv_val_post_discount + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     // // $totalInvoice           = $obj->serv_val_post_discount + ($obj->serv_val_post_discount * 0.18) + $obj->convenienceFee + $obj->agent_convin_fee + $obj->convenienceFeeGst;
                //     // $obj->totalInvoice      = round($totalInvoice); 

                //     // $obj->serv_val_post_discount = round(abs((($obj->netAmount * 100)/118) - $obj->trade_discount));
                // }
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
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`discount_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`,
        `users__booking`.`payment_id`,
        `service`.`name` AS `service_name`,
        COALESCE(`business_type`.`name`,'') AS `service_business_type`,
        COALESCE(`business_type`.`hsn`,'') AS `hsn_code`,
        (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token` = `users__booking`.`token`) AS `count_booking`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`is_agent` AS `booking_is_agent`,
        `users__booking`.`agent_token`,
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
        `users__booking`.`discount_amount` AS `cart_dis_amt`,
        `users__booking`.`invoice_token` AS `invoiceNumber`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON 	`users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed'
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
            $obj->invoiceNumber = $row["invoiceNumber"];

            if($row['service_distributor_token'] != '1111111111' && (int)$row['is_airportzo_user'] == 0 && (int)$row['is_agent'] == 1){
                $querys = "SELECT `name`,`gst_number` FROM `service__distributor` WHERE `token` = :service_distributor_token AND `status`='0'";
                $this->stmts1 = $this->conn->prepare($querys);
                $this->stmts1->bindParam(":service_distributor_token", $row['service_distributor_token']);
                $this->stmts1->execute();
                // $this->stmt->debugDumpParams();
                $checkrows = $this->stmts1->fetch(PDO::FETCH_ASSOC);
                $obj->nameOfInvoice = $checkrows["name"];
                $obj->gstNumber = $checkrows["gst_number"];
            }else{
                $obj->nameOfInvoice = $passenger_name;
                $obj->gstNumber = $row["gstin_number"];
            }
            
            $obj->bookedDate    = convertDate("d M Y",$row["date_time"]);
            $obj->serviceDate    = convertDate("d M Y",$row["service_date_time"]);
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            $obj->razorPayId    = $row["payment_id"];
            $obj->serviceDescription  = $row["service_business_type"];
            $obj->hsnCode       = $row["hsn_code"];
            if((int)$row['coupon_type'] == 2){          //Category
                // $obj->discount = (int)$row['discount_amount'];
                $obj->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                // $obj->discount = (int)$row['cart_dis_amt'];
                $obj->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"]);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
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
               if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"] - $obj->discount);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj->markup_discount = ($row["markup_amount"] - (int)$obj->discount);
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
               }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else{
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
                    }
                }
            }
            //New Cmd the code
            // $obj->taxableValue  = round(($row["net_amount"] - (int)$row["markup_amount"])/1.18);
            // $obj->gst           = round(($row["net_amount"] - (int)$row["markup_amount"]) - $obj->taxableValue);
            // $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];

            // $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
            // $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
            // $obj->markup_discount = $row["markup_amount"];

            if($row["booking_is_agent"]!='0' && $row["agent_token"] != ''){
                $obj->convenienceFee = 0;
                $obj->convenienceFeeGst = 0;
                $obj->total_convenienceFeeGst = 0;

                $obj->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj->agent_conv_fee_GST = round(number_format((float)$obj->agent_conv_fee*0.18, 2, '.', ''));
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            } else {
                $obj->convenienceFee = $row["user_conv_fee_commi"];
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
            $total_tax_value = $obj->taxableValue + (int)$obj->markupAmount + (float)$obj->agent_conv_fee;//2119 + 636 + 0
            $total_gst = $obj->gst + $obj->agent_conv_fee_GST + $obj->markup_GST; //381 + 0 + 114
            $total_invoice_value = $total_tax_value + $total_gst; //2755 + 495 = 3250

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
        `users__booking`.`invoice_token`,
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
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`,
        `users__booking`.`payment_id`,
        `users__booking`.`is_agent`,
        `users__booking`.`is_airportzo_user`,
        `users__booking`.`service_distributor_token`,
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
            $obj->invoiceNumber = $row["invoice_token"];
            $obj->airportzo_gst_no = $row["airportzo_gst_no"];
            $obj->place_of_service = $row["place_of_service"];
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
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
                    while ($rows1 = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
                        $passenger_name = $rows1['name'];
                    }

                if($row['service_distributor_token'] != '1111111111' && (int)$row['is_airportzo_user'] == 0 && (int)$row['is_agent'] == 1){
                    $querys = "SELECT `name`,`gst_number` FROM `service__distributor` WHERE `token` = :service_distributor_token AND `status`='0'";
                    $this->stmts1 = $this->conn->prepare($querys);
                    $this->stmts1->bindParam(":service_distributor_token", $row['service_distributor_token']);
                    $this->stmts1->execute();
                    // $this->stmt->debugDumpParams();
                    $checkrows = $this->stmts1->fetch(PDO::FETCH_ASSOC);
                    $obj->nameOfInvoice = $checkrows["name"];
                    $obj->gstin_number = $checkrows["gst_number"];
                }else{
                    $obj->nameOfInvoice = $passenger_name;
                    $obj->gstin_number = $row["gstin_number"];
                }
                
            // $obj->nameOfInvoice = $row["customer_name"];
            // $obj->gstin_number  = $row["gstin_number"];

            $obj->serviceType   = $row["service_business_type"];
            $obj->hsnCode       = $row["hsn_code"];
            // $obj->totalValue    = $row["net_amount"];
            if((int)$row["cancelled_by"] == 2){
                $obj->totalValue    = (float)$row["after_discount_net_amt"]+ (float)$row["agent_conv_fee_commi"] + (float)$row["gst_agent_conv_fee_commi"] + (float)$row["user_conv_fee_commi"] + (float)$row["gst_user_conv_fee_commi"];

            }else if((int)$row["is_agent"] == 1 && (int)$row["is_airportzo_user"] == 0){
                $obj->totalValue    = (float)$row["after_discount_net_amt"]+ (float)$row["agent_conv_fee_commi"] + (float)$row["gst_agent_conv_fee_commi"] + (float)$row["user_conv_fee_commi"] + (float)$row["gst_user_conv_fee_commi"];
            }else{
                $obj->totalValue    = $row["after_discount_net_amt"];
            }
            
            $obj->cancellationFee  = $row["cancellation_fee"]+$row["platform_fee"];
            // $obj->refundableAmount = round((float)$row["net_amount"] -($obj->cancellationFee));
            $obj->refundableAmount = round((float)$row["refunded_amount"]);
            $obj->taxableValue = round($obj->refundableAmount/1.18);
            $obj->gstOnCancelledService = round($obj->refundableAmount*(18/118));
            $obj->razorPayId    = $row["payment_id"];
            $obj->refundId      = $row["refund_id"];
            
            array_push($array, $obj);
        }
        return $array;
    }
    public function revenuePriceCheck(){
        $query = "SELECT 
        `service__provider`.`name` AS `service_provider_name`,
        `airport`.`name` AS `airport_name`,
        `service`.`name` AS `service_name`,
        `business_type`.`name` AS `business_type_name`,
        `service__provider_company_location`.`commission_percentage`,
        `business_type`.`hsn` AS `hsn_code`,
        `service__provider_price_log`.`price_adult`,
        `service__provider_price_log`.`price_children`,
        `service__provider_price_log`.`additional_price_adult`,
        `service__provider_price_log`.`additional_price_children`
        FROM `service__provider`
        INNER JOIN `service__provider_company` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token`=`service__provider_company_location`.`company_token`
        INNER JOIN `airport` ON `airport`.`token` = `service__provider_company_location`.`airport_token`
        INNER JOIN `service` ON `service`.`service_provider_company_token` = `service__provider_company`.`token` AND `service`.`service_provider_company_location_token` = `service__provider_company_location`.`token`
        INNER JOIN `service__provider_price_log` ON `service__provider_price_log`.`service_token`=`service`.`token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service`.`business_type_token`
        WHERE 1
        $this->dateQuery GROUP BY `service__provider_price_log`.`token` ORDER BY `service__provider_price_log`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function revenuePriceView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->service_provider_name     = $row["service_provider_name"];
            $obj->airport_name              = $row["airport_name"];
            $obj->business_type_name        = $row["business_type_name"];
            $obj->service_name              = $row["service_name"];
            $obj->commission_percentage     = $row["commission_percentage"];
            $obj->hsn_code                  = $row["hsn_code"];
            $obj->price_adult               = $row["price_adult"]; 
            $obj->price_adult_commission    = number_format((float)$row["price_adult"]-($row["price_adult"]*($row["commission_percentage"]/100)), 2, '.', '');
            $obj->price_children            = $row["price_children"]; 
            $obj->price_children_commission = number_format((float)$row["price_children"]-($row["price_children"]*($row["commission_percentage"]/100)), 2, '.', '');
            $obj->additional_price_adult    = $row["additional_price_adult"]; 
            $obj->add_price_adult_commission= number_format((float)$row["additional_price_adult"]-($row["additional_price_adult"]*($row["commission_percentage"]/100)), 2, '.', '');
            $obj->additional_price_children = $row["additional_price_children"]; 
            $obj->add_price_children_commission = number_format((float)$row["additional_price_children"]-($row["additional_price_children"]*($row["commission_percentage"]/100)), 2, '.', '');
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
        `users__booking`.`coupon_type`,
        `users__booking`.`membership_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `service__distributor_agent`.`name` AS `agentName`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `users__booking_detail`.`markup_percentage`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`markup_type`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`service_completed_date_time`,
        `service__distributor`.`name` AS `service__distributor_name`
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
            $obj->agentName       = $row["agentName"] == null ? '-' : $row["agentName"];
            $obj->serviceDistributorName  = $row["service__distributor_name"];
            $obj->membershipId      = $row["membership_number"];
            $obj->serviceCompletedDate   = convertDate("d M Y",$row["service_completed_date_time"]);

            if($row["markup_type"] == "Percentage"){
                $obj->markup_percentage    = $row["markup_percentage"]."%";
            }else if($row["markup_type"] == "Flat" || $row["markup_type"] == "No Markup"){
                $obj->markup_percentage    = $row["markup_percentage"];
            }
            $obj->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup"){ //No coupon and No Markup
                $obj->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj->totalValue    = $row["discount_net_amt"];

                $obj->distPercentage = $row["az_sd_percentage"];
                // $obj->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');

                $obj->distCommisionValue = number_format((((int)$row["net_amount"] * $obj->distPercentage / 100) * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');
                $obj->totalCommissionValueIncGst = number_format($obj->distCommisionValue + $obj->gstDistCommisionValue, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = 0;
                $obj->gst_distributor_markup = 0;
                $obj->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup"){   //With Coupon and No Markup

                $obj->totalValue    = $row["discount_net_amt"];
                $obj->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = 0;
                $obj->gst_distributor_markup = 0;
                $obj->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup"){   //No Coupon and With Markup
                
                $obj->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj->gstValue    = number_format($obj->totalValue*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($obj->totalValue*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = $row["markup_amount"];
                $obj->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj->gst_distributor_markup = number_format($obj->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup"){   //With Coupon and With Markup
                
                $obj->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj->gstValue    = number_format($obj->totalValue*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($obj->totalValue*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = $row["cal_discount_amt"];
                $obj->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj->markup_discount;
                $obj->taxable_val_distributor_markup = number_format(((int)$obj->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj->gst_distributor_markup = number_format($obj->taxable_val_distributor_markup*18/100, 2, '.', '');
            }

            // $obj->gstValue    = number_format($row["net_amount"]*18/118, 2, '.', '');
            // $obj->excludeGstValue    = number_format($row["net_amount"]*100/118, 2, '.', '');
            // $obj->totalValue    = $row["net_amount"];
            
            // $obj->distPercentage = $row["az_sd_percentage"];
            // $obj->distCommisionValue = number_format($obj->excludeGstValue*$row["az_sd_percentage"]/100, 2, '.', '');
            // $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');
            // $obj->totalCommissionValueIncGst = number_format($obj->distCommisionValue+$obj->gstDistCommisionValue, 2, '.', '');

            if($row["is_agent"]!='0' && $row["is_approved"] == '1'){
                $obj->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
                // $obj->agent_conv_fee = round($row["convenience_fee"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"]);
                // $obj->agent_conv_fee_GST = round($row["cf_tax"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"]);
                // $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            } else {
                $obj->agent_conv_fee = 0;
                $obj->agent_conv_fee_GST = 0;
                $obj->total_agent_conv_fee = 0;
            }
            $obj->taxable_value_comm_markup = round($obj->distCommisionValue + $obj->agent_conv_fee + $obj->taxable_val_distributor_markup);
            $obj->gst_value_comm_markup = round($obj->gstDistCommisionValue + $obj->agent_conv_fee_GST + $obj->gst_distributor_markup);
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
        `users__booking_detail`.`cancelled_by`,
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
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`service_completed_date_time`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token` AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token`=`service__provider_company_location`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        INNER JOIN `service__location` ON `service__location`.`service_token`=`users__booking_detail`.`service_token`
        WHERE `users__booking_detail`.`status` IN ('Completed','Cancelled') AND `service__provider_company_location_cancel_charge`.`status`='1' $this->dateQuery GROUP BY `users__booking_detail`.`token`";
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
            if($row["cancelled_by"] == '1'){
                $obj->status        = 'Cancelled';
            }else if($row["cancelled_by"] == '2'){
                $obj->status        = 'Rejected';
            }else{
                $obj->status = $row["status"];
            }
            $obj->serviceCompletedDate = $row["service_completed_date_time"]=="0000-00-00 00:00:00"?"-":convertDate("d M Y",$row["service_completed_date_time"]);
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
            $obj->service_provider_B2C = $row["net_amount"] - $row["markup_amount"];
            $obj->AZ_commission = $row["az_sp_commision_amount"];
            $obj->after_commission = (int)$obj->service_provider_B2C - (int)$obj->AZ_commission;
            $obj->gross = $obj->after_commission;
            $obj->servicePayable = number_format($obj->gross/1.18, 2, '.', '');
            $obj->gstValue = number_format($obj->gross*18/118, 2, '.', '');
            array_push($array, $obj);
        }
        return $array;
    }
    function customerJourney(){
        $custQuery = "SELECT `users`.`is_agent`,
        `users`.`is_approved`,
		`users__booking`.`date_time`,
		`users__booking`.`is_agent` AS `booking_is_agent`,
        `users__booking`.`agent_token`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `users__booking_detail`.`cancellation_percentage`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`discount_amount`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `business_type`.`name` AS `business_type`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`total_service`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`token` AS `users__booking_token`,
        (`users__booking_detail`.`cancellation_fee`+`users__booking_detail`.`platform_fee`) AS `cancellation_value`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking`.`is_airportzo_user`,
        `users__booking`.`service_distributor_token`,
        `users__booking`.`coupon_type`,
        `users__booking`.`cart_coupon_type`,
        `users__booking`.`discount_amount` AS `cart_dis_amt`,
        `users__booking_detail`.`markup_percentage`,
        `users__booking_detail`.`markup_type`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`,
        `users__booking_detail`.`date_time` AS `booking_date`,
        `users__booking_detail`.`service_date_time`,
        `service__distributor`.`name` AS `service__distributor_name`,
        `service__provider`.`name` AS `service__provider_name`,
        `users__booking`.`membership_number`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service`.`business_type_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        INNER JOIN `service__provider_company` ON `users__booking_detail`.`company_token` = `service__provider_company`.`token`
        INNER JOIN `service__provider` ON `service__provider`.`token` = `service__provider_company`.`service_provider_token`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed' $this->dateQuery
        GROUP BY `users__booking_detail`.`token`";
        $custStmt = $this->conn->prepare( $custQuery );
        $custStmt->execute();
        return $custStmt;
    }
    function viewCustomerJourney($stmt){
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
            $obj->customerName    = $passenger_name;
            $obj->bookingDate  = convertDate("d M Y",$row["booking_date"]);
            $obj->serviceDate  = convertDate("d M Y",$row["service_date_time"]);
            $obj->bookingRef    = $row["booking_number"];
            $obj->serviceRef    = $row["token"];
            if($row["cancelled_by"] == '2'){
                $obj->status = 'Rejected';
            }else{
                $obj->status = $row["status"];
            }
            $obj->cancelledDate   = $row["cancelled_date"]=="0000-00-00 00:00:00"?'-':convertDate("d M Y",$row["cancelled_date"]);
            $obj->businessType       = $row["business_type"];
            $obj->is_airportzo_user       = $row["is_airportzo_user"];
            $obj->service_distributor_token       = $row["service_distributor_token"];
            $obj->serviceDistributorName       = $row["service__distributor_name"];
            $obj->serviceProviderName       = $row["service__provider_name"];
            $obj->membershipNumber       = $row["membership_number"];

            if((int)$row['coupon_type'] == 2){          //Category
                // $obj->discount = (int)$row['discount_amount'];
                $obj->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                // $obj->discount = (int)$row['cart_dis_amt'];
                $obj->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                    $obj->taxableValue  = round($obj->saleValue / 1.18);
                    $obj->gst           = round($obj->taxableValue * 0.18);

                    $obj->markup_discount = ($row["markup_amount"]);
                    $obj->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
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
               if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"] - $obj->discount);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj->markup_discount = ($row["markup_amount"] - (int)$obj->discount);
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
               }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);

                    }else{
                        $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj->discount);
                        $obj->taxableValue  = round($obj->saleValue / 1.18);
                        $obj->gst           = round($obj->taxableValue * 0.18);

                        $obj->markup_discount = ($row["markup_amount"]);
                        $obj->markupAmount = round(((float)$obj->markup_discount*100)/118);
                        $obj->markup_GST = round(($obj->markupAmount * 18) / 100);
                    }
                }
            }
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj->convenienceFee = 0;
                $obj->convenienceFeeGst = 0;
                $obj->total_convenienceFeeGst = 0;

                $obj->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj->convenienceFee = $row["user_conv_fee_commi"];
                $obj->convenienceFeeGst = $row["gst_user_conv_fee_commi"];
                $obj->total_convenienceFeeGst = $obj->convenienceFee + $obj->convenienceFeeGst;

                $obj->agent_conv_fee = 0;
                $obj->agent_conv_fee_GST = 0;
                $obj->total_agent_conv_fee = 0;
            }

            $total_tax_value = $obj->taxableValue + (int)$obj->markupAmount + (float)$obj->agent_conv_fee;
            $total_gst = $obj->gst + $obj->agent_conv_fee_GST + $obj->markup_GST;
            $total_invoice_value = $total_tax_value + $total_gst;
            
            $obj->revenueBaseValue = $total_tax_value;
            $obj->revenueGstValue = $total_gst;
            $obj->revenueSaleValue = $total_invoice_value;


            // $obj->revenueBaseValue = number_format($row["net_amount"]/1.18, 2, '.', '');
            // $obj->revenueGstValue = number_format($row["net_amount"]*18/118, 2, '.', '');
            // $obj->revenueSaleValue = $row["net_amount"];

            // $obj->convenienceFee = number_format($row["net_amount"]*0.03, 2, '.', ''); //number_format($row["total_service"]!='0'?$row["convenience_fee"]/$row["total_service"]:$row["convenience_fee"],2,'.','');
            // $obj->convenienceFeeGst = number_format( $obj->convenienceFee*0.18, 2, '.', ''); //number_format($row["total_service"]!='0'?$row["cf_tax"]/$row["total_service"]:$row["cf_tax"],2,'.','');
            $obj->totalRevenue = number_format($obj->revenueSaleValue + $obj->convenienceFee + $obj->convenienceFeeGst, 2, '.', '');
            // $obj->cancelBaseValue = number_format($row["cancellation_value"]/1.18, 2, '.', '');
            // $obj->cancelGstValue = number_format($row["cancellation_value"]*18/118, 2, '.', '');
            // $obj->cancelSaleValue = $row["cancellation_value"];
            $obj->cancelBaseValue = round($row["refunded_amount"]/1.18);
            $obj->cancelGstValue = round($row["refunded_amount"]*18/118);
            $obj->cancelSaleValue = $row["refunded_amount"];

            // $obj->distCommissionExclGstValue = number_format($row["az_sd_commision_amount"]/1.18, 2, '.', '');
            // $obj->distCommissionGstValue = number_format($row["az_sd_commision_amount"]*18/118, 2, '.', '');
            // $obj->distCommissionTotalValue = $row["az_sd_commision_amount"];

            if($row["markup_type"] == "Percentage"){
                $obj->markup_percentage    = $row["markup_percentage"]."%";
            }else if($row["markup_type"] == "Flat" || $row["markup_type"] == ""){
                $obj->markup_percentage    = $row["markup_percentage"];
            }
            $obj->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){ //No coupon and No Markup
                $obj->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj->totalValue    = $row["discount_net_amt"];

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                // $obj->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');
                $obj->distCommisionValue = number_format((((int)$row["net_amount"] * $commi_percentage / 100) * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');
                $obj->totalCommissionValueIncGst = number_format($obj->distCommisionValue + $obj->gstDistCommisionValue, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = 0;
                $obj->gst_distributor_markup = 0;
                $obj->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and No Markup

                $obj->totalValue    = $row["discount_net_amt"];
                $obj->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = 0;
                $obj->gst_distributor_markup = 0;
                $obj->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //No Coupon and With Markup
                
                $obj->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj->gstValue    = number_format($obj->totalValue*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($obj->totalValue*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = 0;
                $obj->net_markup_post_dis = $row["markup_amount"];
                $obj->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj->gst_distributor_markup = number_format($obj->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and With Markup
                
                $obj->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj->gstValue    = number_format($obj->totalValue*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($obj->totalValue*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj->distPercentage);

                $obj->totalCommissionValueIncGst = number_format(($obj->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj->distCommisionValue = number_format(((int)$obj->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj->gstDistCommisionValue = number_format($obj->distCommisionValue*18/100, 2, '.', '');

                $obj->markup_discount = $row["cal_discount_amt"];
                $obj->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj->markup_discount;
                $obj->taxable_val_distributor_markup = number_format(((int)$obj->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj->gst_distributor_markup = number_format($obj->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero

                $obj->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj->gstValue    = number_format($obj->totalValue*18/118, 2, '.', '');
                $obj->excludeGstValue    = number_format($obj->totalValue*100/118, 2, '.', '');

                $obj->distPercentage = $row["az_sd_percentage"];

                $obj->totalCommissionValueIncGst = 0;
                $obj->distCommisionValue = 0;
                $obj->gstDistCommisionValue = 0;

                $obj->markup_discount = $row["cal_discount_amt"];
                $obj->net_markup_post_dis = 0;
                $obj->taxable_val_distributor_markup = 0;
                $obj->gst_distributor_markup = 0;

                $obj->agent_conv_fee = 0;
                $obj->agent_conv_fee_GST = 0;
                $obj->total_agent_conv_fee = $obj->agent_conv_fee + $obj->agent_conv_fee_GST;
            }
            
            if($row["is_airportzo_user"] == '0' && $row["service_distributor_token"] != '1111111111'){  //Only for WhiteLabel Bookings for SD Commission
                $obj->distCommissionExclGstValue = round($obj->distCommisionValue + $obj->agent_conv_fee + $obj->taxable_val_distributor_markup);
                $obj->distCommissionGstValue = round($obj->gstDistCommisionValue + $obj->agent_conv_fee_GST + $obj->gst_distributor_markup);
                $obj->distCommissionTotalValue = round($obj->distCommissionExclGstValue + $obj->distCommissionGstValue);
            }else{
                $obj->distCommissionExclGstValue = 0;
                $obj->distCommissionGstValue = 0;
                $obj->distCommissionTotalValue = 0;
            }
            
            $amtPayToServiceProvider = ($row["net_amount"]- $row["markup_amount"] - $row["az_sp_commision_amount"]);

            if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero
                
                $obj->payToServiceProviderTotalVal = number_format(($amtPayToServiceProvider * ($row["cancellation_percentage"]/100)), 2, '.', '');
                $obj->payToServiceProviderBaseVal = number_format($obj->payToServiceProviderTotalVal/1.18, 2, '.', '');
                $obj->payToServiceProviderGstValue = number_format($obj->payToServiceProviderTotalVal*18/118, 2, '.', '');
            
            }else{
                $obj->payToServiceProviderBaseVal = number_format($amtPayToServiceProvider/1.18, 2, '.', '');
                $obj->payToServiceProviderGstValue = number_format($amtPayToServiceProvider*18/118, 2, '.', '');
                $obj->payToServiceProviderTotalVal = number_format($amtPayToServiceProvider, 2, '.', '');
            }

            $obj->profit = number_format(($obj->revenueBaseValue + $obj->convenienceFee - $obj->cancelBaseValue - $obj->distCommissionExclGstValue - $obj->payToServiceProviderBaseVal), 2, '.', '');
            $obj->cashFlow = number_format(($obj->totalRevenue - $obj->cancelSaleValue - $obj->distCommissionTotalValue - $obj->payToServiceProviderTotalVal), 2, '.', '');
            array_push($array, $obj);
        }
        return $array;
    }
    function misFinance(){
        $query = "SELECT
        COALESCE(SUM(`users__booking_detail`.`net_amount`),0) AS `net_amount`,
        COALESCE(SUM(`users__booking_detail`.`refunded_amount`),0) AS `refunded_amount`,
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

    function Service_distributor_commision1(){
        $custQuery = "SELECT `users`.`is_agent`,
        `users`.`is_approved`,
		`users__booking`.`date_time`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`cancelled_date` AS `cancelled_date`,
        `users__booking_detail`.`cancellation_percentage`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`discount_amount`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`after_cal_discount_amt` AS `cal_discount_amt`,
        `users__booking_detail`.`net_amount`,
        `users__booking`.`total_service`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`token` AS `users__booking_token`,
        (`users__booking_detail`.`cancellation_fee`+`users__booking_detail`.`platform_fee`) AS `cancellation_value`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking`.`is_airportzo_user`,
        `users__booking`.`is_agent` AS `booking_is_agent`,
        `users__booking`.`agent_token`,
        `users__booking`.`service_distributor_token`,
        `users__booking`.`coupon_type`,
        `users__booking`.`cart_coupon_type`,
        `users__booking`.`discount_amount` AS `cart_dis_amt`,
        `users__booking_detail`.`markup_percentage`,
        `users__booking_detail`.`markup_type`,
        `users__booking_detail`.`agent_conv_fee_commi`,
        `users__booking_detail`.`gst_agent_conv_fee_commi`,
        `users__booking_detail`.`user_conv_fee_commi`,
        `users__booking_detail`.`gst_user_conv_fee_commi`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        WHERE `users__booking_detail`.`status` != 'Draft' AND `users__booking_detail`.`status` != 'Removed' AND $this->dateFilterQuery
        GROUP BY `users__booking_detail`.`token`";
        $custStmt = $this->conn->prepare( $custQuery );
        $custStmt->execute();
        return $custStmt;
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
        // $this->dateFilterQuery = "`users__booking`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // $stmt = $this->distributortaxvalue();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        // $obj->salesInMonth  = number_format($row["distributortax_value"], 2, '.', '');
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        $stmt = $this->Service_distributor_commision1();

        $revenueBaseValue = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
                if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;
            
            $revenueBaseValue += $total_tax_value + $obj1->convenienceFee;
        }
        $obj->salesInMonth  = number_format($revenueBaseValue, 2, '.', '');

        //year filter for sales
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj->salesInYear  = number_format($row["net_amount"]/1.18+$row["convenience_fee"], 2, '.', '');

        $stmt = $this->Service_distributor_commision1();

        $revenueBaseValue = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
                if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;
            
            $revenueBaseValue += $total_tax_value + $obj1->convenienceFee;
        }
        $obj->salesInYear  = number_format($revenueBaseValue, 2, '.', '');

        //month filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='Cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $refundableAmount= $row["net_amount"]-$cancellationFee;
        $refundableAmount = $row["refunded_amount"];
        $obj->creditNotesInMonth = number_format($refundableAmount/1.18, 2, '.', '');
        //Year filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='Cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $refundableAmount= $row["net_amount"]-$cancellationFee;
        $refundableAmount = $row["refunded_amount"];
        $obj->creditNotesInYear = number_format($refundableAmount/1.18, 2, '.', '');
        //net sales
        $obj->netSalesInMonth = number_format($obj->salesInMonth-$obj->creditNotesInMonth, 2, '.', '');
        $obj->netSalesInYear = number_format($obj->salesInYear-$obj->creditNotesInYear, 2, '.', '');
        //month filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // $stmt = $this->Service_distributor_commision();
        $stmt = $this->Service_distributor_commision1();

        $distCommissionExclGstValue = 0;
        $payToServiceProviderBaseVal = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $obj1->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){ //No coupon and No Markup
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj1->totalValue    = $row["discount_net_amt"];

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);
                // $obj1->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');
                $obj1->distCommisionValue = number_format((((int)$row["net_amount"] * $commi_percentage / 100) * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');
                $obj1->totalCommissionValueIncGst = number_format($obj1->distCommisionValue + $obj1->gstDistCommisionValue, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and No Markup

                $obj1->totalValue    = $row["discount_net_amt"];
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //No Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = $row["markup_amount"];
                $obj1->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj1->markup_discount;
                $obj1->taxable_val_distributor_markup = number_format(((int)$obj1->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero

                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];

                $obj1->totalCommissionValueIncGst = 0;
                $obj1->distCommisionValue = 0;
                $obj1->gstDistCommisionValue = 0;

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = 0;
                $obj1->taxable_val_distributor_markup = 0;
                $obj1->gst_distributor_markup = 0;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            }
            
            if($row["is_airportzo_user"] == '0' && $row["service_distributor_token"] != '1111111111'){  //Only for WhiteLabel Bookings for SD Commission
                $distCommissionExclGstValue += round($obj1->distCommisionValue + $obj1->agent_conv_fee + $obj1->taxable_val_distributor_markup);
            }else{
                $distCommissionExclGstValue += 0;
            }
            $amtPayToServiceProvider = ($row["net_amount"]- $row["markup_amount"] - $row["az_sp_commision_amount"]);

            if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero
                
                $obj1->payToServiceProviderTotalVal = number_format(($amtPayToServiceProvider * ($row["cancellation_percentage"]/100)), 2, '.', '');
                $payToServiceProviderBaseVal += number_format($obj1->payToServiceProviderTotalVal/1.18, 2, '.', '');
            
            }else{
                $payToServiceProviderBaseVal += number_format($amtPayToServiceProvider/1.18, 2, '.', '');
            }
        }
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $serviceExcludeGstValue = $row["net_amount"]*100/118;
        // $obj->distributorCommissionInMonth  = number_format(($row["net_amount"]-$serviceExcludeGstValue)*$row["az_sd_percentage"]/100, 2, '.', '');//$row["net_amount"] * ($row["distributor_commission_percentage"] / 100);//number_format($row["distributor_commission"], 2, '.', '');
        $obj->distributorCommissionInMonth  =  number_format($distCommissionExclGstValue, 2, '.', '');

        // $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $serviceProviderPayable = number_format($row["net_amount"]/1.18, 2, '.', '');
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $obj->serviceProviderPaymentInMonth = $row["az_sp_commision_amount"]==null ? '0' : number_format($row["az_sp_commision_amount"], 2, '.', '');//number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        $obj->serviceProviderPaymentInMonth = number_format($payToServiceProviderBaseVal, 2, '.', '');

        //year filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        $stmt = $this->Service_distributor_commision1();

        $distCommissionExclGstValue = 0;
        $payToServiceProviderBaseVal = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $obj1->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){ //No coupon and No Markup
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj1->totalValue    = $row["discount_net_amt"];

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);
                // $obj1->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');
                $obj1->distCommisionValue = number_format((((int)$row["net_amount"] * $commi_percentage / 100) * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');
                $obj1->totalCommissionValueIncGst = number_format($obj1->distCommisionValue + $obj1->gstDistCommisionValue, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and No Markup

                $obj1->totalValue    = $row["discount_net_amt"];
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //No Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = $row["markup_amount"];
                $obj1->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj1->markup_discount;
                $obj1->taxable_val_distributor_markup = number_format(((int)$obj1->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero

                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];

                $obj1->totalCommissionValueIncGst = 0;
                $obj1->distCommisionValue = 0;
                $obj1->gstDistCommisionValue = 0;

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = 0;
                $obj1->taxable_val_distributor_markup = 0;
                $obj1->gst_distributor_markup = 0;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            }
            
            if($row["is_airportzo_user"] == '0' && $row["service_distributor_token"] != '1111111111'){  //Only for WhiteLabel Bookings for SD Commission
                $distCommissionExclGstValue += round($obj1->distCommisionValue + $obj1->agent_conv_fee + $obj1->taxable_val_distributor_markup);
            }else{
                $distCommissionExclGstValue += 0;
            }
            $amtPayToServiceProvider = ($row["net_amount"]- $row["markup_amount"] - $row["az_sp_commision_amount"]);

            if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero
                
                $obj1->payToServiceProviderTotalVal = number_format(($amtPayToServiceProvider * ($row["cancellation_percentage"]/100)), 2, '.', '');
                $payToServiceProviderBaseVal += number_format($obj1->payToServiceProviderTotalVal/1.18, 2, '.', '');
            
            }else{
                $payToServiceProviderBaseVal += number_format($amtPayToServiceProvider/1.18, 2, '.', '');
            }
        }

        $obj->distributorCommissionInYear  = number_format($distCommissionExclGstValue, 2, '.', '');
        $obj->serviceProviderPaymentInYear = number_format($payToServiceProviderBaseVal, 2, '.', '');

        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj->distributorCommissionInYear  = number_format($row["distributor_commission"], 2, '.', '');
        // $serviceProviderPayable = number_format($row["net_amount"]/1.18, 2, '.', '');
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $obj->serviceProviderPaymentInYear = number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
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
        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        // $net_amount = $row["net_amount"];
        // $convenienceFee = number_format((float)$row["net_amount"]*0.03, 2, '.', '');
        // $convenienceFeeGst = number_format((float)$convenienceFee*0.18, 2, '.', '');
        // $totalInvoice = $net_amount+$convenienceFee+$convenienceFeeGst;
        // $obj->salesInMonth  = round($totalInvoice);//number_format($row["net_amount"]+$row["convenience_fee"]+$row["cf_tax"], 2, '.', '');
        $stmt = $this->Service_distributor_commision1();

        $revenueSaleValue = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
                if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;
            $total_gst = $obj1->gst + $obj1->agent_conv_fee_GST + $obj1->markup_GST;
            $total_invoice_value = $total_tax_value + $total_gst;
            
            $revenueSaleValue += $total_invoice_value + $obj1->total_convenienceFeeGst;
        }
        $obj->salesInMonth  = number_format($revenueSaleValue, 2, '.', '');
        //year filter for sales
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj->salesInYear  = number_format($row["net_amount"]+$row["convenience_fee"]+$row["cf_tax"], 2, '.', '');
        $stmt = $this->Service_distributor_commision1();

        $revenueSaleValue = 0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if((int)$row['coupon_type'] == 2){          //Category
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj1->discount = (int)$row['cal_discount_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj1->discount = 0;
            }
            if($row["is_airportzo_user"] == '1' && $row["service_distributor_token"] == '1111111111'){
                
                if((int)$row['coupon_type'] == 2){  //Category
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else if((int)$row['coupon_type'] == 1){    //Cart
                    // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                }else{
                    $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                    $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                    $obj1->gst           = round($obj1->taxableValue * 0.18);

                    $obj1->markup_discount = ($row["markup_amount"]);
                    $obj1->markupAmount = round(((float)$row["markup_amount"]*100)/118);
                    $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                }
                
            }else{
                if((int)$row["markup_amount"] > 0){  //With Markup Value

                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        // $obj->markup_discount = ($row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->markup_discount = ($row["markup_amount"] - (int)$obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }else{
                        $obj1->saleValue     = (int)$row["net_amount"] - (int)$row["markup_amount"];
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);
                        
                        $obj1->markup_discount = ($row["markup_amount"] - $obj1->discount);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }else{  //Without Markup Value
                    if((int)$row['coupon_type'] == 2){  //Category
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else if((int)$row['coupon_type'] == 1){    //Cart
                        // $obj->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - ((int)$obj->discount / (int)$row['count_booking']));
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);

                    }else{
                        $obj1->saleValue     = round((int)$row["net_amount"] - (int)$row["markup_amount"] - (int)$obj1->discount);
                        $obj1->taxableValue  = round($obj1->saleValue / 1.18);
                        $obj1->gst           = round($obj1->taxableValue * 0.18);

                        $obj1->markup_discount = ($row["markup_amount"]);
                        $obj1->markupAmount = round(((float)$obj1->markup_discount*100)/118);
                        $obj1->markup_GST = round(($obj1->markupAmount * 18) / 100);
                    }
                }
            }
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $total_tax_value = $obj1->taxableValue + (int)$obj1->markupAmount + (float)$obj1->agent_conv_fee;
            $total_gst = $obj1->gst + $obj1->agent_conv_fee_GST + $obj1->markup_GST;
            $total_invoice_value = $total_tax_value + $total_gst;
            
            $revenueSaleValue += $total_invoice_value + $obj1->total_convenienceFeeGst;
        }
        $obj->salesInYear  = number_format($revenueSaleValue, 2, '.', '');
        //month filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='Cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $cancellationFee = $row["cancellation_fee"]+$row["platform_fee"];
        // $obj->creditNotesInMonth = $row["net_amount"]-$cancellationFee;

        $refundableAmount = $row["refunded_amount"];
        $obj->creditNotesInMonth = number_format($refundableAmount, 2, '.', '');

        //Year filter for credit notes
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'  AND `users__booking_detail`.`status`='Cancelled'";
        $stmt = $this->misFinance();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $obj->creditNotesInYear= $row["net_amount"]-$cancellationFee;

        $refundableAmount = $row["refunded_amount"];
        $obj->creditNotesInYear = number_format($refundableAmount, 2, '.', '');

        //net sales
        $obj->netSalesInMonth = number_format($obj->salesInMonth-$obj->creditNotesInMonth, 2, '.', '');
        $obj->netSalesInYear = number_format($obj->salesInYear-$obj->creditNotesInYear, 2, '.', '');
        //month filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // $stmt = $this->distributorTotalreport();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $distributor_commission = $row["az_sdcommision_amount"];
        // $gstDistCommisionValue = number_format($distributor_commission*18/100, 2, '.', '');
        // $totalCommissionValueIncGst = number_format($distributor_commission+$gstDistCommisionValue, 2, '.', '');
        // $obj->distributorCommissionInMonth  = round($totalCommissionValueIncGst);//number_format($row["distributor_commission"], 2, '.', '');

        $stmt = $this->Service_distributor_commision1();

        $distCommissionTotalValue = 0;
        $payToServiceProviderTotalVal = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $obj1->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){ //No coupon and No Markup
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj1->totalValue    = $row["discount_net_amt"];

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);
                // $obj1->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');
                $obj1->distCommisionValue = number_format((((int)$row["net_amount"] * $commi_percentage / 100) * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');
                $obj1->totalCommissionValueIncGst = number_format($obj1->distCommisionValue + $obj1->gstDistCommisionValue, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and No Markup

                $obj1->totalValue    = $row["discount_net_amt"];
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //No Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = $row["markup_amount"];
                $obj1->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj1->markup_discount;
                $obj1->taxable_val_distributor_markup = number_format(((int)$obj1->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero

                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];

                $obj1->totalCommissionValueIncGst = 0;
                $obj1->distCommisionValue = 0;
                $obj1->gstDistCommisionValue = 0;

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = 0;
                $obj1->taxable_val_distributor_markup = 0;
                $obj1->gst_distributor_markup = 0;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            }

            if($row["is_airportzo_user"] == '0' && $row["service_distributor_token"] != '1111111111'){  //Only for WhiteLabel Bookings for SD Commission
                $obj1->distCommissionExclGstValue = round($obj1->distCommisionValue + $obj1->agent_conv_fee + $obj1->taxable_val_distributor_markup);
                $obj1->distCommissionGstValue = round($obj1->gstDistCommisionValue + $obj1->agent_conv_fee_GST + $obj1->gst_distributor_markup);
                $distCommissionTotalValue += round($obj1->distCommissionExclGstValue + $obj1->distCommissionGstValue);
            }else{
                $obj->distCommissionExclGstValue = 0;
                $obj->distCommissionGstValue = 0;
                $distCommissionTotalValue += 0;
            }

            $amtPayToServiceProvider = ($row["net_amount"]- $row["markup_amount"] - $row["az_sp_commision_amount"]);

            if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero
                
                $payToServiceProviderTotalVal += number_format(($amtPayToServiceProvider * ($row["cancellation_percentage"]/100)), 2, '.', '');
            
            }else{
                $payToServiceProviderTotalVal += number_format($amtPayToServiceProvider, 2, '.', '');
            }
        }

        $obj->distributorCommissionInMonth  =  number_format($distCommissionTotalValue, 2, '.', '');
        
        // $serviceProviderPayable = number_format($row["net_amount"], 2, '.', '');
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->fromDate' AND '$this->toDate'";
        // $stmt = $this->misFinance1();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj->serviceProviderPaymentInMonth = number_format($row["azspcommision_amount"], 2, '.', '');//number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');
        $obj->serviceProviderPaymentInMonth = number_format($payToServiceProviderTotalVal, 2, '.', '');

        //year filter for Expenses
        $this->dateFilterQuery = "`users__booking_detail`.`date_time` BETWEEN '$this->startDate' AND '$this->toDate'";
        // $stmt = $this->misFinance();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // $obj->distributorCommissionInYear  = number_format($row["distributor_commission"], 2, '.', '');
        // $serviceProviderPayable = number_format($row["net_amount"], 2, '.', '');
        // $cancellationFee= $row["cancellation_fee"]+$row["platform_fee"];
        // $obj->serviceProviderPaymentInYear = number_format($serviceProviderPayable-$cancellationFee, 2, '.', '');

        $stmt = $this->Service_distributor_commision1();

        $distCommissionTotalValue = 0;
        $payToServiceProviderTotalVal = 0;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            if($row["booking_is_agent"] != '0' && $row["agent_token"] != ''){
                $obj1->convenienceFee = 0;
                $obj1->convenienceFeeGst = 0;
                $obj1->total_convenienceFeeGst = 0;

                $obj1->agent_conv_fee = $row["agent_conv_fee_commi"];
                $obj1->agent_conv_fee_GST = $row["gst_agent_conv_fee_commi"];
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            } else {
                // $obj->convenienceFee = round(number_format((float)$row["discount_net_amt"]*0.03, 2, '.', ''));
                $obj1->convenienceFee = $row["user_conv_fee_commi"];
                $obj1->convenienceFeeGst = number_format((float)$obj1->convenienceFee*0.18, 2, '.', '');
                $obj1->total_convenienceFeeGst = $obj1->convenienceFee + $obj1->convenienceFeeGst;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = 0;
            }

            $obj1->markup_amount    = $row["markup_amount"];

            if((int)$row["coupon_type"] == 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){ //No coupon and No Markup
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');
                $obj1->totalValue    = $row["discount_net_amt"];

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);
                // $obj1->distCommisionValue = number_format(((int)$row["az_sd_commision_amount"] * 100) / 118, 2, '.', '');
                $obj1->distCommisionValue = number_format((((int)$row["net_amount"] * $commi_percentage / 100) * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');
                $obj1->totalCommissionValueIncGst = number_format($obj1->distCommisionValue + $obj1->gstDistCommisionValue, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] == "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and No Markup

                $obj1->totalValue    = $row["discount_net_amt"];
                $obj1->gstValue    = number_format($row["discount_net_amt"]*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($row["discount_net_amt"]*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = 0;
                $obj1->gst_distributor_markup = 0;
                $obj1->taxable_val_distributor_markup = 0;

            }else if((int)$row["coupon_type"] == 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //No Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = 0;
                $obj1->net_markup_post_dis = $row["markup_amount"];
                $obj1->taxable_val_distributor_markup = number_format(((int)$row["markup_amount"] * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if((int)$row["coupon_type"] != 0 && $row["markup_type"] != "No Markup" && $row["status"] != 'Cancelled'){   //With Coupon and With Markup
                
                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];
                $commi_percentage = str_replace('%', '', $obj1->distPercentage);

                $obj1->totalCommissionValueIncGst = number_format(($obj1->totalValue * (int)$commi_percentage)/100, 2, '.', '');
                $obj1->distCommisionValue = number_format(((int)$obj1->totalCommissionValueIncGst * 100) / 118, 2, '.', '');
                $obj1->gstDistCommisionValue = number_format($obj1->distCommisionValue*18/100, 2, '.', '');

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = (int)$row["markup_amount"] - (int)$obj1->markup_discount;
                $obj1->taxable_val_distributor_markup = number_format(((int)$obj1->net_markup_post_dis * 100) / 118, 2, '.', '');
                $obj1->gst_distributor_markup = number_format($obj1->taxable_val_distributor_markup*18/100, 2, '.', '');

            }else if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero

                $obj1->totalValue    = (int)$row["net_amount"] - (int)$row["markup_amount"];
                $obj1->gstValue    = number_format($obj1->totalValue*18/118, 2, '.', '');
                $obj1->excludeGstValue    = number_format($obj1->totalValue*100/118, 2, '.', '');

                $obj1->distPercentage = $row["az_sd_percentage"];

                $obj1->totalCommissionValueIncGst = 0;
                $obj1->distCommisionValue = 0;
                $obj1->gstDistCommisionValue = 0;

                $obj1->markup_discount = $row["cal_discount_amt"];
                $obj1->net_markup_post_dis = 0;
                $obj1->taxable_val_distributor_markup = 0;
                $obj1->gst_distributor_markup = 0;

                $obj1->agent_conv_fee = 0;
                $obj1->agent_conv_fee_GST = 0;
                $obj1->total_agent_conv_fee = $obj1->agent_conv_fee + $obj1->agent_conv_fee_GST;
            }

            if($row["is_airportzo_user"] == '0' && $row["service_distributor_token"] != '1111111111'){  //Only for WhiteLabel Bookings for SD Commission
                $obj1->distCommissionExclGstValue = round($obj1->distCommisionValue + $obj1->agent_conv_fee + $obj1->taxable_val_distributor_markup);
                $obj1->distCommissionGstValue = round($obj1->gstDistCommisionValue + $obj1->agent_conv_fee_GST + $obj1->gst_distributor_markup);
                $distCommissionTotalValue += round($obj1->distCommissionExclGstValue + $obj1->distCommissionGstValue);
            }else{
                $obj->distCommissionExclGstValue = 0;
                $obj->distCommissionGstValue = 0;
                $distCommissionTotalValue += 0;
            }

            $amtPayToServiceProvider = ($row["net_amount"]- $row["markup_amount"] - $row["az_sp_commision_amount"]);

            if($row["status"] == 'Cancelled'){    //If it's cancelled booking distributor commission is zero
                
                $payToServiceProviderTotalVal += number_format(($amtPayToServiceProvider * ($row["cancellation_percentage"]/100)), 2, '.', '');
            
            }else{
                $payToServiceProviderTotalVal += number_format($amtPayToServiceProvider, 2, '.', '');
            }
        }

        $obj->distributorCommissionInYear  = number_format($distCommissionTotalValue, 2, '.', '');
        $obj->serviceProviderPaymentInYear = number_format($payToServiceProviderTotalVal, 2, '.', '');
        //total Expenses
        $obj->totalExpensesInMonth = number_format($obj->distributorCommissionInMonth+$obj->serviceProviderPaymentInMonth, 2, '.', '');
        $obj->totalExpensesInYear = number_format($obj->distributorCommissionInYear+$obj->serviceProviderPaymentInYear, 2, '.', '');
        //gross Profit
        $obj->grossProfitInMonth = number_format($obj->netSalesInMonth-$obj->totalExpensesInMonth, 2, '.', '');
        $obj->grossProfitInYear = number_format($obj->netSalesInYear-$obj->totalExpensesInYear, 2, '.', '');
        return $obj;
    }
}