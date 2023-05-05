<?php
class booking extends Database {
    // object properties
    public $businessId;
    public $password;
    //public $stmt;
    public function bookingHistory(){
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $searchQuery = "";
        if($fromDate!="" && $toDate!=""){
            $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate) );
            $toDate = date("Y-m-d 23:59:59", strtotime($toDate) );
            $searchQuery = " AND `users__booking`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }else{
            $searchQuery = "";
        }
        $query = "SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking`.`date_time`,
        `users__booking`.`status`,
        `users__passenger`.`name` AS `customer_name`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        COUNT(`users__booking_detail`.`token`) AS `services_count`,
        GROUP_CONCAT(`service__provider_company`.`name`,'|&&&&&|') AS `company_name`,
        GROUP_CONCAT(`business_type`.`name`,'|&&&&&|') AS `type_name`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `users__booking`.`membership_number`
        FROM `users__booking`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        LEFT JOIN `users__booking_passenger` ON (
        	`users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        )
        LEFT JOIN `users__passenger` ON
        	`users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='0'
        $searchQuery
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute(); 
        return $stmt;
    }
    public function bookingHeader($status){
        $bookingDate = $this->bookingDate;
        $searchQuery = "";
        if($bookingDate!=""){
            $searchQuery = " AND `users__booking`.`date_time` LIKE '$bookingDate%'";
        }else{
            $searchQuery = "";
        }
        $query = "SELECT 
        `users__booking_detail`.`token`
        FROM `users__booking`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `users__booking_detail` ON
        	`users__booking_detail`.`booking_token`=`users__booking`.`token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='0'
        AND `users__booking_detail`.`status`='$status'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function bookingHistoryView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingToken = $row['token'];
            $obj->bookingNumber= $row['booking_number'];
            $obj->paymentId    = $row['payment_id'];
            $obj->createdDate  = convertDate("d M Y H:i",$row["date_time"]);
            $obj->customerName = $row['customer_name'];
            $obj->memberCount  = $row['member_count'];
            $obj->servicesCount= $row['services_count'];
            $obj->companyName  = str_replace('|&&&&&|,', ' | ', rtrim($row['company_name'],'|&&&&&|') );
            $obj->typeName     = str_replace('|&&&&&|,', ' | ', rtrim($row['type_name'],'|&&&&&|') );
            $obj->status       = $row['status'];
            $obj->markupType   = $row['markup_type'];
            $obj->markupValue  = $row['markup_value'];
            $obj->loyaltyPoints  = $row['membership_number'];
            array_push($array, $obj);
        }
        return $array;   
    }
    public function singleBookingHistory($gm_date){
        $obj = new stdClass;
        $query = "SELECT `users__booking`.`gstin_number`,
        `users__booking`.`e_ticket`,
        `users__booking`.`service_amount`,
        `users__booking`.`service_gst`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`total_amount`,
        `users__booking`.`gst_name`,
        `users__booking`.`payment_id`,
        `service__provider_company`.`name` AS `company_name`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        WHERE `users__booking`.`token`=:token
        GROUP BY `users__booking`.`token`"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj->companyName  = $row['company_name'];
        $obj->gstComapany  = $row['gst_name'];
        $obj->paymentId    = $row['payment_id'];
        $obj->gstinNumber  = $row['gstin_number'];
        $obj->eTicket      = $row['e_ticket'];
        $obj->serviceAmount= $row['service_amount'];
        $obj->serviceGst   = $row['service_gst'];
        $obj->convenienceFee= $row['convenience_fee'];
        $obj->cfTax        = $row['cf_tax'];
        $obj->totalAmount  = $row['total_amount'];
        $obj->passengerDetails = $this->passengerDetail($gm_date);
        $obj->bookingDetails   = $this->bookingDetails($gm_date,$row['payment_id']);
        return $obj;
    }
    public function passengerDetail($gm_date){
        $query = "SELECT `users__booking`.`token`,
        `users__booking_passenger`.`passenger_type`,
        `users__booking_passenger`.`user_passenger_token`,
        `users__passenger`.`title`,
        `users__passenger`.`name`,
        `users__passenger`.`country_code`,
        `users__passenger`.`mobile_number`,
        `users__passenger`.`email_id`,
        `users__passenger`.`date_of_birth`
        FROM `users__booking`
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        WHERE `users__booking`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->passengerType= $row['passenger_type'];
            $obj->name         = $row['title']." ".$row['name'];
            $obj->countryCode  = $row['country_code'];
            $obj->mobileNumber = $row['mobile_number'];
            $obj->emailId      = $row['email_id'];
            $obj->dateOfBirth  = $row['date_of_birth'];
            $diff = abs(strtotime($gm_date) - strtotime($row['date_of_birth']));
            $obj->age          = floor($diff / (365*60*60*24));
            array_push($array, $obj);
        }
        return $array;
    }
    public function bookingDetails($gm_date,$paymentId){
        $query = "SELECT `users__booking_detail`.`token`,
        `users__booking_detail`.`service_name` AS `name`,
        `service__provider_company`.`name` AS `company_name`,
        `airport`.`name` AS `airport_name`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_journey`.`flight_number`,
        `airport__type`.`name` AS `airport_type`,
        `airport__category`.`name` AS `airport_category`,
        `service`.`name` AS `service_name`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`description`,
        `users__booking_detail`.`notes`,
        `service`.`name` AS `service_name`,
        `service`.`type` AS `service_type`,
        `users__booking_detail`.`service_token`,
        
        `airport`.`gmt`,
        `users__booking_detail`.`service_provider_notes`,
        `users__booking_detail`.`rating`,
        `users__booking_detail`.`review`,
        `users__booking_detail`.`review_date_time`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`  
        
        LEFT JOIN `users__booking_journey` ON 
            `users__booking_journey`.`booking_token`=`users__booking_detail`.`booking_token`  
        
        WHERE `users__booking_detail`.`booking_token`=:token";
        //`users__booking_detail`.`flight_number`,
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token        = $row['token'];
            $obj->payment_id   = $paymentId;
            
            //$obj->name         = $row['name'];
            $obj->companyName  = $row['company_name'];
            $obj->airportName  = $row['airport_name'];
            //$obj->serviceDate  = convertDate("d M Y",$row['service_date_time']);
            //$obj->serviceTime  = convertDate("H:i",$row['service_date_time'])."(".$row['gmt'].")";
            $obj->serviceDate  = date("d M Y", strtotime($row['service_date_time']) );
            $obj->serviceTime  = date("H:i", strtotime($row['service_date_time']) )."(".$row['gmt'].")";
            //$row['cancelled_date']!="0000-00-00 00:00:00" &&
            if( $row['status']=="Cancelled"){
                $obj->cancelledDate  = date("d M Y H:i", strtotime($row['cancelled_date']) );
            }else{
                $obj->cancelledDate  = "-";
            }
            $obj->flightNumber = $row['flight_number'];
            $obj->airportType  = $row['airport_type'];
            $obj->airportCategory= $row['airport_category'];
            $obj->serviceName  = $row['service_name'];
            $obj->totalAdult   = $row['total_adult'];
            $obj->totalChildren= $row['total_children'];
            $obj->amount       = $row['net_amount'];
            $obj->status       = $row['status'];
            $obj->description  = $row['notes'];
            $obj->serviceName  = $row['service_name'];
            $obj->serviceType  = $row['service_type'];
            
            if($row['review_date_time']=="0000-00-00 00:00:00"){
                $obj->rating        = "0";
                $obj->review        = "-";
                $obj->reviewDate    = "-";
            }else{
                $obj->rating        = $row['rating'];
                $obj->review        = $row['review'];
                $obj->reviewDate    = convertDate("d M, Y",$row['review_date_time']);
            }
            
            
            if($row['service_type']=="Bundle"){
                $obj->name = "Meet & Greet";
            }else{
                $serviceToken = $row['service_token'];
                $query1 = "SELECT `business_type`.`name` 
                FROM `service__business_relation` 
                INNER JOIN `business_type` ON `business_type`.`token`=`service__business_relation`.`business_type_token`
                WHERE `service__business_relation`.`service_token`='$serviceToken'";
                $stmt1 = $this->conn->prepare( $query1 );
                $stmt1->execute();
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                $obj->name = $row1['name'];
            } 
            $obj->workStatus = $this->trackWork($row['token']);
            array_push($array, $obj);
        }
        return $array;
    }
    public function userCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_employee` 
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function getLogo(){
        $query = "SELECT `service__distributor`.`header_logo` FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON 
            `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE  `service__distributor_employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['header_logo'];
    }
    public function trackWork($token){
        $query = "SELECT `status`,
        `date_time` 
        FROM `users__booking_status` 
        WHERE `users_booking_detail_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array=[];
        $totalCount = $stmt->rowCount();
        $slno = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->status     = $row["status"];
            $obj->statusdate = convertDate("d M, Y",$row["date_time"]);
            $obj->statustime = convertDate("H:i",$row["date_time"]);
            if($totalCount==$slno && $row["status"]!="Completed"){
                $obj->ongoing = true; 
            }else{
                $obj->ongoing = false;
            }
            $slno++;
            array_push($array, $obj);
        }
        return $array;
    }
    public function cancelBookingHistoryCheck(){
        $dateQuery   = $this->dateQuery;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`token`,
        `users__booking`.`date_time`,
        `users__booking`.`user_token`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`cancellation_hours`,
        `users__booking_detail`.`status`,
        COALESCE(`users__booking_detail`.`cancellation_percentage`,'0') AS cancellation_percentage,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`service_date_time`,
        `service`.`name`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`refund_status`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`refund_id`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`az_sp_commision_amount`
        FROM `users__booking`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        LEFT JOIN `users__booking_passenger` ON (
        	`users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        )
        LEFT JOIN `users__passenger` ON
        	`users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='0' AND `users__booking_detail`.`status`='Cancelled' $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        // $stmt->debugDumpParams();
        $stmt->execute();
        return $stmt;
    }
    public function agent_cancelBookingHistoryCheck(){
        $dateQuery   = $this->dateQuery;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`token`,
        `users__booking`.`date_time`,
        `users__booking`.`user_token`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`cancellation_hours`,
        `users__booking_detail`.`status`,
        COALESCE(`users__booking_detail`.`cancellation_percentage`,'0') AS cancellation_percentage,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`service_date_time`,
        `service`.`name`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`refund_status`,
        `users__booking_detail`.`refunded_amount`,
        `users__booking_detail`.`refunded_date`,
        `users__booking_detail`.`cancelled_by`,
        `users__booking_detail`.`refund_id`,
        `users__booking_detail`.`markup_amount`,
        `users__booking_detail`.`az_sp_commision_amount`
        FROM `users__booking`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        LEFT JOIN `users__booking_passenger` ON (
        	`users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        )
        LEFT JOIN `users__passenger` ON
        	`users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor_employee`.`token`=:token AND `users__booking`.`is_agent`='1' AND `users__booking_detail`.`status`='Cancelled' $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        // $stmt->debugDumpParams();
        $stmt->execute();
        return $stmt;
    }
    public function cancelBookingView($stmt){
        $array=[];
        $sl_no=0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $sl_no++;
            $obj = new stdClass();
            $obj->sl_no          = $sl_no;
            $obj->token          = $row["token"];
            $obj->bookingNumber  = $row["booking_number"];
            $obj->dateTime       = convertDate("d M Y H:i",$row["date_time"]);
            $obj->cancelledDate  = convertDate("d M Y H:i",$row["cancelled_date"]);
            $obj->serviceDateTime= date("d M Y  H:i", strtotime($row['service_date_time']) );
            $obj->serviceName    = $row["name"];
            $obj->netAmount      = ($row["net_amount"]-$row["markup_amount"])-$row["az_sp_commision_amount"];
            $cancellation_hours  = round((strtotime($row['service_date_time']) - strtotime($row["cancelled_date"]))/3600, 1);
            $obj->cancellation_hours = $row["cancellation_hours"]." Hrs";
            if($row["cancellation_percentage"] > 0){
                $total_cost = ($row["net_amount"]-$row["markup_amount"])-$row["az_sp_commision_amount"];
                $cancel_percent_fee = $total_cost*$row["cancellation_percentage"]/100;
                $obj->cancellation_fee   = number_format($cancel_percent_fee+$row["platform_fee"],2,'.','');
            }else{
                $obj->cancellation_fee = '0';
            }
            if($row["refund_status"]=="Pending"){
                $obj->refundStatus = '<span class="rejected">Pending</span>';
            }else{
                $obj->refundStatus = '<span class="rejected">Refunded</span>';
            }
            $obj->refundedAmount = $obj->netAmount-($cancel_percent_fee + $row["platform_fee"]);
            $obj->status = $row["status"];
            if($row["refunded_date"]=="0000-00-00 00:00:00"){
                $obj->refundedDate   = "-";
            }else{
                $obj->refundedDate   = convertDate("d M Y H:i",$row["refunded_date"]);
            }
            if($row["cancelled_by"]=="1"){
                 $obj->cancelledBy   = "User";
            }else{
                 $obj->cancelledBy   = "Service Provider";
            }
            if($row["refund_status"] == "Pending"){
                $obj->refundAction = '<button class="cust-btn cust-btn-primary refundBtn" data-target="#refundmodal" data-toggle="modal">Initiate Refund</button>';
            }else if($row["refund_status"] == "Refunded"){
                $obj->refundAction = "Reference ID".": ".$row["refund_id"];
            }
            array_push($array, $obj);
        }
        return $array;
    }
}
?>