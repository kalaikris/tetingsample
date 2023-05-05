<?php
class booking extends Database {
    public function bookingHistory(){
        $query = "SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`booking_type`,
        `users__booking`.`token` AS `booking_token`,
        `users__booking_detail`.`token`,
        `users__booking`.`payment_id`,
        `service`.`token` AS `service_token`,
        `service`.`name`,
        `airport`.`name` AS  `airport`,
        `airport`.`code` AS  `airport_code`,
        `users__booking_detail`.`status`,
        `service__provider`.`name` AS `service_provider`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`date_time`,
        `users`.`name` AS `customer_name`,
        `users`.`email` AS `customer_email`,
        `users`.`is_agent`,
        `users`.`is_approved`,
        `users`.`mobile_number` AS `customer_mobile_number`,
        `service__distributor`.`name` AS `distributor_name`,
        `users__booking`.`membership_number`,
        `users__booking`.`service_amount`,
        `users__booking`.`service_gst`,
        `users__booking_detail`.`discount_amount`,
        `users__booking`.`convenience_fee`,
        (SELECT SUM(`users__booking_detail`.`net_amount`) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token`) AS `total_service_cost`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__provider_company` ON 
            `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider` ON 
            `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON (`service__distributor`.`token`=`users__booking`.`service_distributor_token` AND `users__booking`.`is_airportzo_user`='0')
        WHERE `users__booking_detail`.`status` != 'Draft'
        $this->dateQuery
        ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function bookingHistoryView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingDetailToken= $row['token'];
            $obj->bookingToken    = $row['booking_token'];
            $obj->bookingNumber   = $row['booking_number'];
            if($row['booking_type']=='Whitelabel'){
                $obj->bookingType = $row['booking_type'].' - '.$row['distributor_name'];
            }else{
                $obj->bookingType = $row['booking_type'];
            }
            $obj->serviceToken    = $row['service_token'];
            $obj->bookingNumber   = $row['booking_number'];
            $obj->bookingNumber   = $row['booking_number'];
            $obj->airportName     = $row['airport'];
            $obj->airportCode     = $row['airport_code'];
            $obj->customerName    = $row['customer_name'];
            $obj->customerEmail   = $row['customer_email'];
            $obj->customerNumber  = $row['customer_mobile_number'];
            $stmtPassenger        = $this->bookingPassenger($row['booking_token']);
            $stmtPassengerContactNothers = $this->bookingPassengerContactAndOther($row['booking_token']);
            $obj->noOfPassenger   = $stmtPassengerContactNothers->rowCount();
            $obj->passengers      = $this->passengerView($stmtPassenger);
            $obj->serviceTypes    = $this->serviceTypes($row['service_token']);
            $obj->flightNumber    = $this->flightNumber($row['booking_token']);
            if($row['is_agent'] == '1' && $row['is_approved'] == '1'){
                $agent_conv_fee_commi = round($row['convenience_fee'] * $row['net_amount'] / $row['total_service_cost']);
                $gst_agent_conv_fee_commi = round($agent_conv_fee_commi * 0.18);
                $obj->amount = ($row['net_amount'] + $agent_conv_fee_commi + $gst_agent_conv_fee_commi)-$row['discount_amount'];
            }else{
                $user_conv_fee_commi = round($row['convenience_fee'] * ($row['net_amount'] - $row['discount_amount']) / ($row['service_amount'] + $row['service_gst']));
                $gst_user_conv_fee_commi = round($user_conv_fee_commi * 0.18);
                $obj->amount = ($row['net_amount'] + $user_conv_fee_commi + $gst_user_conv_fee_commi) - $row['discount_amount'];
            }
            $obj->bookingDateTime = convertDate("d M Y H:i",$row['date_time']);
            $obj->serviceDateTime = date("d M Y H:i",strtotime($row['service_date_time']));
            $obj->status          = $row['status'];
            $obj->serviceProvider = $row['service_provider'];
            $obj->package         = $row['name'];
            $obj->paymentId       = $row['payment_id'];
            $obj->loyaltyPoints   = $row['membership_number'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function bookingPassengerContactAndOther($bookingToken){
        $query = "SELECT `users__passenger`.`name`,
        `users__passenger`.`country_code`,
        `users__passenger`.`mobile_number`,
        `users__passenger`.`email_id`,
        `users__booking_passenger`.`passenger_type`
        FROM `users__booking_passenger`
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        WHERE `users__booking_passenger`.`booking_token`=:token AND (`users__booking_passenger`.`passenger_type`='Contact' OR `users__booking_passenger`.`passenger_type`='Others')";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $bookingToken);
        $stmt->execute();
        return $stmt;
    }
    function bookingPassenger($bookingToken){
        $query = "SELECT `users__passenger`.`name`,
        `users__passenger`.`country_code`,
        `users__passenger`.`mobile_number`,
        `users__passenger`.`email_id`,
        `users__booking_passenger`.`passenger_type`
        FROM `users__booking_passenger`
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        WHERE `users__booking_passenger`.`booking_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $bookingToken);
        $stmt->execute();
        return $stmt;
    }
    public function passengerView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->passengerName   = $row['name'];
            $obj->passengerNumber = $row['country_code']." ".$row['mobile_number'];
            $obj->passengerEmail  = $row['email_id'];
            $obj->passengerType   = $row['passenger_type'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function serviceTypes($serviceToken){
        $query = "SELECT GROUP_CONCAT(`business_type`.`name`) AS `business_type`
        FROM `service__business_relation`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__business_relation`.`business_type_token`
        WHERE `service__business_relation`.`service_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $serviceToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['business_type'];
    }
    function flightNumber($bookingToken){
        $query = "SELECT GROUP_CONCAT(`flight_number`) AS `flight_number` FROM `users__booking_journey` WHERE `booking_token`=:booking_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":booking_token", $bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['flight_number'];
    }
    public function backendBookingHistory(){
        $query = "SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`booking_type`,
        `users__booking`.`token` AS `booking_token`,
        `users__booking_detail`.`token`,
        `users__booking`.`payment_id`,
        `users__booking`.`order_id`,
        `users__booking`.`plink_id`,
        `users__booking`.`journey`,
        `users__booking`.`total_amount`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`date_time`,
        `users`.`name` AS `customer_name`,
        `users`.`email` AS `customer_email`,
        `users`.`mobile_number` AS `customer_mobile_number`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
    	INNER JOIN `users` ON `users__booking`.`user_token`=`users`.`token`
        WHERE 1
        $this->dateQuery AND `users__booking_detail`.`status`='Draft' GROUP BY `users__booking_detail`.`booking_token`
        ORDER BY `users__booking_detail`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
        
    }
    public function backendBookingHistoryView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingDetailToken= $row['token'];
            $obj->bookingToken    = $row['booking_token'];
            $obj->bookingChannel    = $row['booking_type'];
            $obj->bookingNumber   = $row['booking_number'];
            $obj->paymentId   = $row['payment_id'];
            $obj->orderId   = $row['order_id'];
            $obj->plinkId   = $row['plink_id'];
            $obj->journey   = $row['journey'];
            $obj->totalAmount   = $row['total_amount'];
            $obj->status   = $row['status'];
            $obj->customerName    = $row['customer_name'];
            $obj->customerEmail   = $row['customer_email'];
            $obj->customerNumber  = $row['customer_mobile_number'];
            $stmtPassenger        = $this->bookingPassenger($row['booking_token']);
            $stmtPassengerContactNothers = $this->bookingPassengerContactAndOther($row['booking_token']);
            $obj->noOfPassenger   = $stmtPassengerContactNothers->rowCount();
            $obj->passengers      = $this->passengerView($stmtPassenger);
            $obj->bookingDateTime = convertDate("d M Y H:i",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;   
    }
    public function getBookingServiceDetails(){
        $serviceQuery = "SELECT `token`, `net_amount`, `airport_token`, `company_token` FROM `users__booking_detail` WHERE `booking_token`=:bookingToken AND `status`='Draft'";
        $serviceStmt = $this->conn->prepare( $serviceQuery );
        $serviceStmt->bindParam(":bookingToken", $this->bookingToken);
        $serviceStmt->execute();
        $serviceDetails = [];
        while($row1 = $serviceStmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->airport_token = $row1["airport_token"];
            $obj->sp_company_token = $row1["company_token"];
            $obj->net_amount = $row1["net_amount"];
            $obj->booking_detail_token = $row1["token"];
            array_push($serviceDetails, $obj);
        }
      return $serviceDetails;
    }
    public function storeInvoiceurl(){
        $serviceQuery = "UPDATE `users__booking` SET `invoice_pdf`=:invoice_pdf,`invoice_token`=:invoice_token WHERE `token`=:bookingToken";
        $serviceStmt = $this->conn->prepare( $serviceQuery );
        $serviceStmt->bindParam(":invoice_token", $this->invoice_token);
        $serviceStmt->bindParam(":invoice_pdf", $this->invoice_pdf);
        $serviceStmt->bindParam(":bookingToken", $this->bookingToken);
        $serviceStmt->execute();
       return $serviceStmt;
    }
    public function getCommissionForServiceProvider(){
        $query = "SELECT `service__provider`.`credit_available`,
        `service__provider`.`token` AS `service_provider`,
        `service__provider_company_location`.`commission_percentage` 
        FROM `service__provider` 
        INNER JOIN `service__provider_company` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token` = `service__provider_company_location`.`company_token`
        WHERE `service__provider_company_location`.`company_token`=:sp_company_token AND `service__provider_company_location`.`airport_token`=:airport_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":sp_company_token", $this->sp_company_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->provider_credits = $row["credit_available"];
        $obj->commission_percentage = $row["commission_percentage"];
        $obj->service_provider = $row["service_provider"];
        return $obj;
    }
    public function updateCreditAvailableAmount(){
        $query = "UPDATE `service__provider` SET `credit_available`=:credit_available WHERE `token`=:service_provider";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":credit_available", $this->balance_provider_credits);
        $this->stmt->bindParam(":service_provider", $this->service_provider);
        $this->stmt->execute();
    }
    public function updateCommissionInUserBookingDetail(){
        $bookingDetail = "UPDATE `users__booking_detail` SET `az_sp_percentage`=:az_sp_percentage,
        `az_sp_commision_amount`=:az_sp_commision_amount,
        `sp_previous_credit`=:sp_previous_credit,
        `sp_balance_credit`=:sp_balance_credit,
        `status`='Pending'
        WHERE `token`=:booking_detail_token";
        $stmt1 = $this->conn->prepare( $bookingDetail );
        $stmt1->bindParam(":az_sp_percentage", $this->provider_commission_percentage);
        $stmt1->bindParam(":az_sp_commision_amount", $this->provider_commission_amount);
        $stmt1->bindParam(":sp_previous_credit", $this->previous_provider_credits);
        $stmt1->bindParam(":sp_balance_credit", $this->balance_provider_credits);
        $stmt1->bindParam(":booking_detail_token", $this->booking_detail_token);
        $stmt1->execute();
    }
    public function cancelBookingHistory($gm_date){
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $query="SELECT 
        `users__booking`.`booking_number`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        $searchQuery
        $dateQuery";
        //AND `users__booking_detail`.`cancelled_date` NOT LIKE '$gm_date%'
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function cancelBookingHistoryLostRevenue($gm_date){
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $query="SELECT 
        SUM(`users__booking_detail`.`net_amount`) AS `net_amount`,
        SUM(`users__booking_detail`.`cancellation_fee`) AS `cancel_fee`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        $searchQuery
        $dateQuery";
        //AND `users__booking_detail`.`cancelled_date` NOT LIKE '$gm_date%'
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['cancel_fee'];
    }
    public function cancelBookingHistoryCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $dateQuery   = $this->dateQuery;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`token`,
        `users__booking`.`date_time`,
        `users__booking`.`user_token`,
        `users__booking_detail`.`cancelled_date`,
        `users__booking_detail`.`cancellation_hours`,
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
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        $searchQuery
        $dateQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function cancelBookingView($stmt,$gm_date_time){
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
                $obj->refundStatus = '<span class="status rejected">Pending</span>';
            }else{
                $obj->refundStatus = '<span class="status refunded">Refunded</span>';
            }
            $obj->refundedAmount = number_format($obj->netAmount-($cancel_percent_fee + $row["platform_fee"]),2,'.','');
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
    function cancelBackendBooking(){
        $query = "UPDATE `users__booking_detail` SET `status`='Removed' WHERE `booking_token`=:bookingToken";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":bookingToken", $this->bookingToken);
        $this->stmt->execute();
    }
    function bookingServiceTokenCheck(){
        $query = "SELECT `token` FROM `users__booking_detail` 
        WHERE `refund_status`='Pending' 
        AND `refund_id`='' AND `token`=:bookingServiceToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":bookingServiceToken", $this->bookingServiceToken);
        $stmt->execute();
        return $stmt;
    }
    function updateRefundIdForCancelBooking(){
        $query = "UPDATE `users__booking_detail` SET 
        `refund_status`='Refunded', 
        `refund_id`=:refundId,`refunded_date`=:gmDateTime 
        WHERE `token`=:bookingServiceToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":refundId", $this->refundId);
        $stmt->bindParam(":gmDateTime", $this->gmDateTime);
        $stmt->bindParam(":bookingServiceToken", $this->bookingServiceToken);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>