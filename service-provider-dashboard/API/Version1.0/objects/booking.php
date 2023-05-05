<?php
class Booking extends Database{
   
    function allBookingCheckCount(){
        $query = "SELECT users__booking.order_id,
        users__booking.date_time,
        users.name,
        CONCAT('+',users.country_code,users.mobile_number) AS usersmobileNumber,
        users__booking_detail.service_date_time,
        users__booking_detail.service_type,
        users__booking_detail.status
        FROM users
        INNER JOIN users__booking ON (users.token=users__booking.user_token)
        INNER JOIN users__booking_detail ON (users__booking.token=users__booking_detail.booking_token)";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
  
    function bookingSearchFilter(){
        $searchQuery = $this->searchQuery;
        $query = "SELECT users__booking.order_id
        FROM users
        INNER JOIN users__booking ON (users.token=users__booking.user_token)
        INNER JOIN users__booking_detail ON (users__booking.token=users__booking_detail.booking_token)
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    
    function allBookingCheck(){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query = "SELECT users__booking.order_id,
        users__booking.date_time,
        users.name,
        CONCAT('+',users.country_code,users.mobile_number) AS usersmobileNumber,
        users__booking_detail.service_date_time,
        users__booking_detail.service_type,
        users__booking_detail.status
        FROM users
        INNER JOIN users__booking ON (users.token=users__booking.user_token)
        INNER JOIN users__booking_detail ON (users__booking.token=users__booking_detail.booking_token)
        $searchQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function readAllBooking($stmt1){
        $data = array();
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array(
                "order_id"=>'<p class="bluebtn">'.$row['order_id'].'</p>',
                "date_time"=> $row['date_time'],
                "name"=>$row['name'],
                "usersmobileNumber"=>$row['usersmobileNumber'],
                "service_date_time"=>$row['service_date_time'],
                "service_type"=>$row['service_type'],
                "status"=>$row['status']
            );
        }
        return $data;
    }
    function newCancelBooking($gm_date){
        $searchQuery = $this->searchQuery;
        $query="SELECT 
        `users__booking`.`booking_number`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`cancelled_date` LIKE '$gm_date%'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function newCancelBookingCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `users__booking_detail`.`date_time`,
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
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`status`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`cancelled_date` LIKE '$gm_date%'
        $searchQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        //$stmt->debugDumpParams();
        return $stmt;
    }
    function cancelBookingHistory($gm_date){
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
        AND `service__provider_company_location`.`token`=:token
        $searchQuery
        $dateQuery";
        //AND `users__booking_detail`.`cancelled_date` NOT LIKE '$gm_date%'
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function cancelBookingHistoryLostRevenue($gm_date){
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
        AND `service__provider_company_location`.`token`=:token
        $searchQuery
        $dateQuery";
        //AND `users__booking_detail`.`cancelled_date` NOT LIKE '$gm_date%'
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['cancel_fee'];
    }
    function cancelBookingHistoryCheck($gm_date){
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
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`status`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`='Cancelled'
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`cancelled_date` NOT LIKE '$gm_date%'
        $searchQuery
        $dateQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function cancelBookingView($stmt,$gm_date_time){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
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
                //$total_cost = ($row["net_amount"]-$row["markup_amount"])-$row["az_sp_commision_amount"];
                $cancel_percent_fee =  $obj->netAmount*$row["cancellation_percentage"]/100;
                $obj->cancellation_fee   = number_format($cancel_percent_fee,2,'.','');
            }else{
                $obj->cancellation_fee = '0';
            }
            if($row["refund_status"]=="Pending"){
                $obj->refundStatus = '<span class="rejected">Pending</span>';
            }else{
                $obj->refundStatus = '<span class="rejected">Refunded</span>';
            }
            $obj->refundedAmount = $obj->netAmount-$obj->cancellation_fee;
            //$obj->refundedAmount = $row["refunded_amount"];
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
                $obj->refundAction = "-";//'<button class="cust-btn cust-btn-primary refundBtn" data-target="#refundmodal" data-toggle="modal">Initiate Refund</button>';
            }else if($row["refund_status"] == "Refunded"){
                $obj->refundAction = "Reference ID".": ".$row["refund_id"];
            }
            array_push($array, $obj);
        }
        return $array;
    }
    function newReportProblems($gm_date){
        $searchQuery = $this->searchQuery;
        $query="SELECT `users__booking`.`booking_number`
        FROM `users__booking_detail`
        LEFT JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        LEFT JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`    
        WHERE `users__booking_detail`.`report_description`!=''
        AND `users__booking_detail`.`airport_token`=:airport_token
        AND `users__booking_detail`.`company_token`=:company_token
        AND `users__booking_detail`.`reported_date` LIKE '$gm_date%'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $this->airportToken);
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function newReportProblemsCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT `users__booking`.`booking_number`,
        `report_reason`.`reason`,
        `users__booking_detail`.`report_description`,
        `users__booking_detail`.`reported_date`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        WHERE `users__booking_detail`.`report_description`!=''
        AND `users__booking_detail`.`airport_token`=:airport_token
        AND `users__booking_detail`.`company_token`=:company_token
        AND `users__booking_detail`.`reported_date` LIKE '$gm_date%'
        $searchQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $this->airportToken);
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function reportProblemsHistory($gm_date){
        $searchQuery = $this->searchQuery;
        $query="SELECT `users__booking`.`booking_number`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`    
        WHERE `users__booking_detail`.`report_description`!=''
        AND `users__booking_detail`.`airport_token`=:airport_token
        AND `users__booking_detail`.`company_token`=:company_token
        AND `users__booking_detail`.`reported_date` NOT LIKE '$gm_date%'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $this->airportToken);
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function reportProblemsHistoryCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT `users__booking`.`booking_number`,
        `report_reason`.`reason`,
        `users__booking_detail`.`report_description`,
        `users__booking_detail`.`reported_date`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        WHERE `users__booking_detail`.`report_description`!=''
        AND `users__booking_detail`.`airport_token`=:airport_token
        AND `users__booking_detail`.`company_token`=:company_token
        AND `users__booking_detail`.`reported_date` NOT LIKE '$gm_date%'
        $searchQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $this->airportToken);
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function reportProblemsView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->booking_number = $row["booking_number"];
            $obj->reason         = $row["reason"];
            $obj->description    = $row["report_description"];
            $obj->reportedDate   = convertDate("d M Y H:i",$row["reported_date"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function reportCount(){
        $query="SELECT COUNT(`users__booking`.`id`) AS report_count,
        `report_reason`.`reason`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON
            `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        INNER JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        WHERE `users__booking_detail`.`description`!=''
        AND `service__provider_company_location`.`token`=:token
        GROUP BY `report_reason`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function reportCount2($reasonToken){
        $query="SELECT COUNT(`users__booking`.`id`) AS `report_count`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        WHERE `users__booking_detail`.`report_reason_token`!=''
        AND `users__booking_detail`.`airport_token`=:airport_token
        AND `users__booking_detail`.`company_token`=:company_token
        AND `report_reason`.`token`=:reason_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->bindParam(":airport_token", $this->airportToken);
        $stmt->bindParam(":reason_token", $reasonToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["report_count"];
    }
    function reportCountView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->reportCount = $row["report_count"];
            $obj->reason      = $row["reason"];
            array_push($array, $obj);
        }
        return $array;
    }
    function newBookingHistory($gm_date){
        $searchQuery = $this->searchQuery;
        $query="SELECT
        `users__booking`.`token`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `service__provider_company_location_staffs` AS `staffs` ON           
            `staffs`.`token`=`users__booking_detail`.`assignee_token`      
        WHERE  `users__booking_detail`.`status` NOT IN ('Cancelled','Draft')
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`date_time` LIKE '$gm_date%'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function newBookingHistoryCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`token`,
        `users__booking`.`date_time`,
        `users__booking`.`user_token`,
        `users__passenger`.`name` AS `user_name`,
        `users__passenger`.`mobile_number`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`reported_date`,
        `service`.`name`,
        `users__booking_detail`.`status`,
        COALESCE(`staffs`.`token`,'') AS `assignee_token`,
        COALESCE(`staffs`.`name`,'') AS `assignee_name`,
        `users__booking`.`token` AS `booking_token`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `service__provider_company_location_staffs` AS `staffs` ON           
            `staffs`.`token`=`users__booking_detail`.`assignee_token`      
        WHERE  `users__booking_detail`.`status` NOT IN ('Cancelled','Draft')
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`date_time` LIKE '$gm_date%'
        $searchQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        //$stmt->debugDumpParams();
        return $stmt;
    }
    function bookingHistory($gm_date){
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $query="SELECT
        `users__booking`.`token`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `service__provider_company_location_staffs` AS `staffs` ON           
            `staffs`.`token`=`users__booking_detail`.`assignee_token`    
        WHERE  `users__booking_detail`.`status` NOT IN ('Cancelled','Draft') 
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`date_time` NOT LIKE '$gm_date%'
        $searchQuery
        $dateQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function bookingHistoryCheck($gm_date){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $dateQuery   = $this->dateQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query="SELECT 
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking_detail`.`token`,
        `users__booking`.`date_time`,
        `users__booking`.`user_token`,
        `users__passenger`.`name` AS `user_name`,
        `users__passenger`.`mobile_number`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`reported_date`,
        `service`.`name`,
        `users__booking_detail`.`status`,
         COALESCE(`staffs`.`token`,'') AS `assignee_token`,
         COALESCE(`staffs`.`name`,'') AS `assignee_name`,
        `users__booking`.`token` AS `booking_token`
        FROM `users__booking_detail` 
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `service__provider_company_location_staffs` AS `staffs` ON           
            `staffs`.`token`=`users__booking_detail`.`assignee_token`    
        WHERE  `users__booking_detail`.`status` NOT IN ('Cancelled','Draft') 
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`date_time` NOT LIKE '$gm_date%'
        $searchQuery
        $dateQuery
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function bookingHistoryView($stmt,$cur_date_time){
        $array=[];
        $slNo = 1;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->bookingNumber  = $row["booking_number"];
            $obj->paymentId      = $row["payment_id"];
            $obj->dateTime       = convertDate("d M Y H:i",$row["date_time"]);
            $obj->userName       = $row["user_name"];
            $obj->mobileNumber   = $row["mobile_number"];
            $obj->totalAdult     = $row["total_adult"];
            $obj->totalChildren  = $row["total_children"];
            //$obj->serviceDateTime= convertDate("d M Y H:i",$row["service_date_time"]);
            $obj->serviceDateTime= date("d M Y H:i" , strtotime($row['service_date_time']) );
            $obj->serviceName    = $row["name"];
 
            if($row["status"] == 'Pending'){
                $obj->status = '<button class="accept" onclick="confirmBooking(\''.$row["token"].'\')"> Accept</button><button class="reject" onclick="cancellationBooking(\''.$row["token"].'\',\''.$row["status"].'\')"> Reject</button>';
            }else if($row["status"] == 'Pending' || $row["status"]== 'Assign' || $row["status"] == 'Accept'){
                $obj->status = '<span class="upcoming">Upcoming</span>';
            }else if($row["status"] == 'Ongoing'){
                $obj->status = '<span class="ongoing">Ongoing</span>';
            }else if($row["status"] == 'NoShow'){
                $obj->status = '<span class="accepted">No Show</span>';
            }else if($row["status"] == 'Completed'){
                $obj->status = '<span class="accepted">Completed</span>';
            }else if($row["status"] == 'Confirmed'){
                $obj->status = '<button class="accept" onclick="unusedServices(\''.$row["token"].'\')">No Show</button><button data-target="#booking_cancellation" data-toggle="modal" class="reject" onclick="cancelService(\''.$row["token"].'\',\''.$row["booking_token"].'\')">Cancel</button>';
            }else{
                $obj->status = '<span class="rejected">Cancelled</span>';
            }
            $obj->assigneeToken = $row["assignee_token"];

            if($row["assignee_name"]!=""){
                $obj->assigneeName  = $row["assignee_name"];
            }else if($row["status"] == 'Pending'){
                $obj->assigneeName  = 'Accept the Service to Assign';
            }else if($row["status"] == 'Confirmed'){
                $assigneeArray = $this->assigneeList;
                $assigneId     = "assigning_name_".$slNo;
                $html = '<select id="'.$assigneId.'" name="select" onchange="get_assigned(\''.$row["token"].'\',\''.$assigneId.'\',\''.$row["user_token"].'\')">';
                    $html .= '<option value="">Select Your Assignee</option>';
                    foreach($assigneeArray as $value){
                        $html .= '<option value="'.$value->token.'">'.$value->name.'</option>';
                    }
                $html .= '</select>';
                $obj->assigneeName  = $html;
            }else{
                $obj->assigneeName  = '-';
            } 

            if($row["assignee_name"]!="" && $row["status"] != 'Completed'){
                $obj->overall_status = '<button type="button" class="btn btn-success" onclick="dashboard_completedstatus(\''.$row["token"].'\')">Complete Service</button>';
            }else if($row["status"] == 'NoShow'){
                $obj->overall_status = 'Service Status Completed';
            }else if($row["status"] == 'Completed' && $row["assignee_name"]!=""){
                $obj->overall_status = 'Service Status Completed';
            }else{
                $obj->overall_status = 'Assign a Person to Complete Service';
            }
            if($row["reported_date"]=="0000-00-00 00:00:00"){
                $obj->isReported  = 0;
                $obj->token = '<div class="table_link" onclick="booking_details(\''.$row["token"].'\')">'.$row['token'].'</div>';
            }else{
                $obj->isReported  = 1;
                $obj->token = '<div class="table_link" onclick="booking_details(\''.$row["token"].'\')"><img src="asset/img/alert-red.png">'.$row['token'].'</div>';
            }
            $obj->bookingToken = $row["booking_token"];
            array_push($array, $obj);
            $slNo++;
        }
        return $array;
    }
    function approveBookingOrder(){
        if($this->bookingStatus=="Cancelled"){
            $refundAmount = $this->refundAmount;
        }else{
            $refundAmount = 0;
        }
        $query="UPDATE `users__booking_detail` SET 
        `status`=:status,
        `refunded_amount`=:refunded_amount
        WHERE `token`=:booking_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":booking_token", $this->bookingOrderToken);
        $stmt->bindParam(":status", $this->bookingStatus);
        $stmt->bindParam(":refunded_amount", $refundAmount);
        $stmt->execute();
        return $stmt;
    }
    function approveBooking(){
        $query="UPDATE `users__booking_detail` SET 
        `status`='Assign'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingOrderToken);
        $stmt->execute();
        return $stmt;
    }
    function bookingStatus($gm_date){
        $query="SELECT 
         `users__booking_detail`.`status`,
         COUNT(`users__booking_detail`.`id`) AS `status_count`
        FROM `users__booking_detail` 
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE  `users__booking_detail`.`status`!='Cancelled'
        AND `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`date_time` NOT LIKE '$gm_date%'
        GROUP BY `users__booking_detail`.`status`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function bookingStatusView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->status      = $row["status"];
            $obj->statusCount = $row["status_count"];
            array_push($array, $obj);
        }
        return $array;
    }
    public function singleBookingHistory($gm_date){
        
        $query = "SELECT 
        `users__booking`.`booking_number`,
        `users__booking_detail`.`date_time`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`description`,
        `users__booking_detail`.`notes`,
        `users__booking_detail`.`service_provider_notes`,
        
        `users__booking`.`gst_name`,
        `users__booking`.`gstin_number`,
        `users__booking`.`e_ticket`,
        `users__booking`.`service_amount`,
        `users__booking`.`service_gst`,
        `users__booking`.`total_amount`,
        
        `service__provider_company`.`name` AS `company_name`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        WHERE `users__booking_detail`.`token`=:token
        GROUP BY `users__booking`.`token`"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj1 = new stdClass;
        $obj1->bookingNumber= $row['booking_number'];
        $obj1->bookedOn     = convertDate("d M, Y H:i", $row['date_time']);
        $obj1->totalAdults  = $row['total_adult'];
        $obj1->totalChildren= $row['total_children'];
        $obj1->notes        = $row['notes'];
        $obj1->description  = $row['description'];
        $obj1->providerNotes= $row['service_provider_notes'];
        
        $obj = new stdClass;
        $obj->orderDetail  = $obj1;
        $obj->companyName  = $row['company_name'];
        $obj->gstCompany   = $row['gst_name'];
        $obj->gstinNumber  = $row['gstin_number'];
        $obj->eTicket      = $row['e_ticket'];
        $obj->serviceAmount= $row['service_amount'];
        $obj->serviceGst   = $row['service_gst'];
        $obj->totalAmount  = $row['total_amount'];
        
        $obj->flightNumber = $this->flightNumber();
        
        $obj->passengerDetails = $this->passengerDetail($gm_date);
        $obj->bookingDetails   = $this->bookingDetails($gm_date);
        return $obj;
    }
    function flightNumber(){
        $query = "SELECT `users__booking_journey`.`flight_number`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users__booking_journey` ON `users__booking_journey`.`booking_token`=`users__booking`.`token`
        WHERE `users__booking_detail`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['flight_number'];
        
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
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `users__booking_passenger` ON 
            `users__booking_passenger`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        WHERE `users__booking_detail`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->user_passengerToken= $row['user_passenger_token'];
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
    public function bookingDetails($gm_date){
        $query = "SELECT `users__booking_detail`.`token`, 
        COALESCE(`service__provider_company_location_staffs`.`name`,'') AS `staff_name`,
        `users__booking_detail`.`service_provider_notes`,
        `users__booking_detail`.`rating`,
        `users__booking_detail`.`review`,
        `users__booking_detail`.`review_date_time`,
        COALESCE(`report_reason`.`reason`,'') AS `report_reason`,
        `users__booking_detail`.`report_description`,
        `users__booking_detail`.`reported_date`,
        `users__booking_detail`.`service_name` AS `name`,
        `service__provider_company`.`name` AS `company_name`,
        `airport`.`name` AS `airport_name`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`flight_number`,
        `airport__type`.`name` AS `airport_type`,
        `airport__category`.`name` AS `airport_category`,
        `service`.`name` AS `service_name`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`description`,
        `service`.`name` AS `service_name`,
        `service`.`type` AS `service_type`,
        `users__booking_detail`.`service_token`,
        `users__booking_detail`.`markup_amount`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        INNER JOIN `service` ON `service`.`token`= `users__booking_detail`.`service_token`
        
        LEFT JOIN `service__provider_company_location_staffs` ON 
            `service__provider_company_location_staffs`.`token`=`users__booking_detail`.`assignee_token`
        LEFT JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        
        WHERE `users__booking_detail`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $array=[];
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->token        = $row['token'];
        //$obj->name         = $row['name'];
        $obj->companyName  = $row['company_name'];
        $obj->airportName  = $row['airport_name'];
        //$obj->serviceDate  = convertDate("d M Y",$row['service_date_time']);
        //$obj->serviceTime  = convertDate("H:i",$row['service_date_time']);
        $obj->serviceDate  = date("d M Y", strtotime($row['service_date_time']) );
        $obj->serviceTime  = date("H:i", strtotime($row['service_date_time']) );
        $obj->serviceAvailableTime  = date("d M Y H:i", strtotime($row['service_date_time']) );
        $obj->flightNumber = $row['flight_number'];
        $obj->airportType  = $row['airport_type'];
        $obj->airportCategory= $row['airport_category'];
        $obj->serviceName  = $row['service_name'];
        $obj->totalAdult   = $row['total_adult'];
        $obj->totalChildren= $row['total_children'];
        $obj->amount       = $row['net_amount']-$row['markup_amount'];
        $obj->status       = $row['status'];
        $obj->description  = $row['description'];
        $obj->serviceName  = $row['service_name'];
        $obj->serviceType  = $row['service_type'];
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
        
        $obj->staffName = $row['staff_name'];
        $obj->serviceProviderNotes= $row['service_provider_notes'];
        
        if($row['review_date_time']=="0000-00-00 00:00:00"){
            $obj->reviewStatus     = 0;
            $obj->rating    = "-";
            $obj->reviewDateTime     = "-";
        }else{
            $obj->reviewStatus     = 1;
            $obj->rating    = $row['rating'];
            $obj->reviewDateTime     = convertDate("d M, Y H:i", $row['review_date_time']);
        }
        $obj->review    = $row['review'];
        
        if($row['reported_date']=="0000-00-00 00:00:00"){
            $obj->reportStatus     = 0;
            $obj->reportedDate     = "-";
        }else{
            $obj->reportStatus     = 1;
            $obj->reportedDate     = convertDate("d M, Y H:i", $row['reported_date']);
        }
        $obj->reportReason     = $row['report_reason'];
        $obj->reportDescription= $row['report_description'];
        $trackWork    = $this->trackWork($row['token']);
        if(count($trackWork)==0){
            $obj->trackWorkStatus = 0;
        }else{
            $obj->trackWorkStatus = 1;
        }
        $obj->trackWork = $trackWork;
        return $obj;
    }
    function maildata($booking_token) {
        $mail_array = [];
        $mail_conent = "SELECT
            `airport`.`code`,
            `airport__terminal`.`name` AS `terminal_name`,
            `users__booking_detail`.`service_name`,
            `users__booking_detail`.`token`,
            `users__booking_detail`.`journey_date`,
            `users__booking`.`date_time` AS `bookedOn`,
            GROUP_CONCAT(
                `users__passenger`.`name`,
                '||',
                `users__passenger`.`date_of_birth`,
                '||', `users__booking_passenger`.`passenger_type` SEPARATOR '|&|'
            ) AS `passenger_details`,
            `users__booking`.`total_children`,
            `users__booking_detail`.`net_amount`,
            `users__booking`.`service_gst`,
            `users__booking`.`total_amount`,
            `users__booking`.`journey`,
            `business_type`.`name` AS `business_name`,
            `users__booking`.`payment_id`,
            `users__booking_detail`.`service_date_time`,
            `users__booking_detail`.`flight_number`,
            `users__booking_journey`.`depart_date`,
            `users__booking`.`booking_number`,
            `users__booking`.`total_service`,
        	MAX(`users__booking_detail`.`total_adult`) AS `total_adult`,
       		MAX(`users__booking_detail`.`total_children`) AS `total_children`
        FROM
            `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__provider_company`.`business_type_token`
        INNER JOIN `users__booking_passenger` ON `users__booking_passenger`.`booking_token` = `users__booking`.`token`
        INNER JOIN `users__passenger` ON `users__passenger`.`token` = `users__booking_passenger`.`user_passenger_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`users__booking_detail`.`terminal_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `users__booking_journey` ON `users__booking_journey`.`booking_token`=`users__booking_detail`.`booking_token`
        WHERE
            `users__booking_detail`.`token` = '$booking_token'";
        $stmt_login = $this->conn->prepare($mail_conent);
        $stmt_login->execute();
        $firstElementNname1 = [];
        while($row5 = $stmt_login->fetch(PDO::FETCH_ASSOC)){
            $obj6 = new stdClass();
            $obj6->airportCode   = $row5['code'];
            $obj6->service_name  = $row5['service_name'];
            $obj6->terminal_name = $row5['terminal_name'];
            $obj6->token = $row5['token'];
            $obj6->journey_date = date("d-M-Y", strtotime($row5['journey_date']) );
            $obj6->date_time =  date("d M Y", strtotime($row5['bookedOn']));
           // $obj6->service_date_time = date("d-M-Y", strtotime($row5['service_date_time']));
            $obj6->service_date_time = (trim($row5['service_date_time']) != '' && trim($row5['service_date_time']) != '0000-00-00 00:00:00' && trim($row5['service_date_time']) != '1970-01-01 05:30:00')? date('d M, Y H:i', strtotime(trim($row5['service_date_time']))): '-';
            $passenger_details = $row5['passenger_details'];
            $nameAndAge = explode("|&|",$passenger_details);
            $passanger_array = array();
            foreach ($nameAndAge as $key => $value) {
                $passanger_split = explode("||",$value);
                $passanger = new stdClass;
                if($passanger_split[2] != 'Greeter'){
                    $passanger->name =$passanger_split[0];
                    $passanger->age = (date('Y') - date('Y',strtotime($passanger_split[1])));
                    //$passanger->age =getTimeDifference($passanger_split[1]);
                    array_push($passanger_array,$passanger);
                }
            }
            $obj6->service_date_time_status = date("d M Y h:i A",strtotime($row5['service_date_time']));
            $obj6->passanger_array = $passanger_array;

            $obj6->total_children = $row5['total_children'];
            $obj6->net_amount = $row5['net_amount'];
            $obj6->service_gst = $row5['service_gst'];
            $obj6->total_amount = $row5['total_amount'];
            $journey = $row5['journey'] == ''?'-':$row5['journey'];
            $journey1 = $row5['journey'];
            // $firstElementNname1 = explode('-', $journey);
            $firstElementNname1 = explode('-', explode('&', $journey)[0]);
            $obj6->firstElementNname = $firstElementNname1[0];//array_shift($firstElementNname1);
            // $lastElementNname1 = explode('-', $journey1);
            $obj6->lastElementNname = $firstElementNname1[1];//end($lastElementNname1);
            $obj6->journey1 = $row5['journey'];
            $obj6->business_name = $row5['business_name'];
            $obj6->payment_id = $row5['payment_id'];
            $obj6->flight_number = $row5['flight_number'];
            $obj6->depart_date = date('d M Y', strtotime(trim($row5['depart_date'])));
            $obj6->booking_number = $row5['booking_number'];
            $obj6->total_service = $row5['total_service'];
            $obj6->total_adult = $row5['total_adult'];
            $obj6->total_children = $row5['total_children'];

            array_push($mail_array, $obj6);
         }
         return $mail_array;
     }
    function getUserDetailForMail(){
         $mailQuery ="SELECT
         `users__passenger`.`name` AS `user_name`,
         `users__passenger`.`email_id` AS `user_mail`,
         `users__booking`.`is_airportzo_user`,
         `users__booking`.`token` AS `booking_token`,
         `service__distributor`.`name` AS `distributor_name`,
         `service__distributor`.`primary_email` AS `distributor_email`,
         `service__distributor`.`brand_colour`
     FROM
         `users__booking_detail`
     INNER JOIN `users__booking` ON `users__booking_detail`.`booking_token` = `users__booking`.`token`
     INNER JOIN `users__booking_passenger` ON(
             `users__booking`.`token` = `users__booking_passenger`.`booking_token`
         )
     INNER JOIN `users__passenger` ON `users__passenger`.`token` = `users__booking_passenger`.`user_passenger_token`
     LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token`
     WHERE
         `users__booking_detail`.`token` = ? AND `users__booking_passenger`.`passenger_type` = 'Contact'";
        $stmt_mail = $this->conn->prepare( $mailQuery );
        $stmt_mail->bindParam(1, $this->bookingOrderToken);
        $stmt_mail->execute();
        $row5 = $stmt_mail->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->user_name = ucwords($row5["user_name"]); 
        $obj->user_mail_id = $row5["user_mail"];
        $obj->is_airportzo_user = $row5["is_airportzo_user"]; 
        $obj->booking_token = $row5["booking_token"]; 
        $obj->distributor_name = $row5["distributor_name"];
        $obj->distributor_email = $row5["distributor_email"];
        $obj->brand_colour = $row5["brand_colour"];
        return $obj; 
    }
    function bookingStatusCount($status,$gm_date){
        $query="SELECT 
         `users__booking_detail`.`status`
        FROM `users__booking_detail` 
        INNER JOIN `service__provider_company_location` ON
        	`service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        WHERE `users__booking_detail`.`status`!='Cancelled'
        AND `users__booking_detail`.`status`='$status'
        AND `service__provider_company_location`.`token`=:token";
        //AND `users__booking_detail`.`date_time` NOT LIKE '$gm_date%'
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function assignStaff(){
        $query="UPDATE `users__booking_detail` SET 
        `assignee_token`=:assignee_token,
        `assignee_by`=:assignee_by,
        `assign_date_time`=:assign_date_time,
        `status`='Assign'
        WHERE `token`=:token";
        //
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":assignee_token", $this->assigneeToken);
        $stmt->bindParam(":assignee_by", $this->assigneeByToken);
        $stmt->bindParam(":assign_date_time", $this->gmDateTime);
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        
        $query1="UPDATE `service__provider_company_location_staffs` SET 
        `is_available`='1'
        AND `token`=:token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":token", $this->assigneeToken);
        $stmt1->execute();
        return $stmt;
    }
    
    function cancelBooking(){
        $query="UPDATE `users__booking_detail` SET 
        `status`='Cancelled',
        `cancelled_by`='2',
        `cancelled_user_token`=:cancelled_user_token,
        `cancelled_invoice_token`=:invoice_token,
        `cancelled_order_invoice`=:cancelled_order_invoice,
        `cancelled_date`=:cancelled_date
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":cancelled_user_token", $this->approvedByToken);
        $stmt->bindParam(":cancelled_date", $this->gmDateTime);
        $stmt->bindParam(":invoice_token", $this->invoice_token);
        $stmt->bindParam(":cancelled_order_invoice", $this->cancelled_order_invoice);
        $stmt->bindParam(":token", $this->bookingOrderToken);
        $stmt->execute();
        return $stmt;
    }
    function updateNotes(){
        $query="UPDATE `users__booking_detail` SET 
        `service_provider_notes`=:service_provider_notes
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_notes", $this->notes);
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        return $stmt;
    }
    
    function trackWork($token){
        $query = "SELECT `status`,
        `date_time` 
        FROM `users__booking_status` 
        WHERE `users_booking_detail_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->status     = $row["status"];
            $obj->statusdate = convertDate("d M, Y",$row["date_time"]);
            $obj->statustime = convertDate("H:i",$row["date_time"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function assignEmployeeCheck(){
        $query = "SELECT `token` 
        FROM `service__provider_company_location_staffs` 
        WHERE `token`=:token 
        AND `is_available`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->assigneeToken);
        $stmt->execute();
        return $stmt;
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
    function noShowBooking(){
        $query="UPDATE `users__booking_detail` SET 
        `status`='Cancelled',
        `cancelled_by`='2',
        `cancelled_user_token`=:cancelled_user_token,
        `cancelled_date`=:cancelled_date,
        `cancellation_fee`=:cancellation_fee
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":cancelled_user_token", $this->approvedByToken);
        $stmt->bindParam(":cancelled_date", $this->gmDateTime);
        $stmt->bindParam(":token", $this->bookingOrderToken);
        $stmt->bindParam(":cancellation_fee", $this->cancellation_fee);
        $stmt->execute();
        return $stmt;
    }
    
    public function cancelOrder() {
        $query ="UPDATE `users__booking_detail`
        SET
            `status`='Cancelled',
            `cancellation_hours`=:cancellation_hours,
            `cancellation_fee`=:cancellation_fee,
            `cancellation_percentage`=:cancellation_fee_perc,
            `platform_fee`=:platform_fee,
            `cancelled_by`='2',
            `cancelled_user_token`=:user_token,
            `cancelled_invoice_token`=:invoice_token,
            `cancelled_order_invoice`=:cancelled_order_invoice,
            `cancelled_date`=:date_time,
            `refund_status`='Pending',
            `refunded_amount`=:refund_amount
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":cancellation_hours", $this->cancellation_hours);
        $this->stmt->bindParam(":cancellation_fee", $this->cancellation_fee);
        $this->stmt->bindParam(":cancellation_fee_perc", $this->cancellation_fee_perc);
        $this->stmt->bindParam(":platform_fee", $this->platform_fee);
        $this->stmt->bindParam(":refund_amount", $this->refund_amount);
        $this->stmt->bindParam(":invoice_token", $this->invoice_token);
        $this->stmt->bindParam(":cancelled_order_invoice", $this->cancelled_order_invoice);
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":date_time", $this->date_time);
        
        // execute query
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function user_booking_detail(){
        $query = "SELECT `users__booking`.`is_airportzo_user`,
        `users__booking`.`service_distributor_token`,
        `users__booking_detail`.`booking_token`,
        `users__booking_detail`.`token` AS `booking_service_token`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`after_discount_net_amt` AS `discount_net_amt`,
        `users__booking_detail`.`az_sp_percentage`,
        `users__booking_detail`.`az_sp_commision_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        `users__booking_detail`.`az_sd_commision_amount`,
        `users__booking_detail`.`company_token`,
        `users__booking_detail`.`airport_token`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_detail`.`markup_amount`,
         COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token` AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        LEFT JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token`=`service__provider_company_location`.`token`
        WHERE `users__booking_detail`.`token`=:bookingOrderToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":bookingOrderToken", $this->bookingOrderToken);
        $stmt->execute();
        $array=[];
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->is_airportzo_user = $row["is_airportzo_user"];
        $obj->service_distributor_token = $row["service_distributor_token"];
        $obj->booking_token = $row["booking_token"];
        $obj->booking_service_token = $row["booking_service_token"];
        $obj->net_amount = $row["net_amount"];
        $obj->az_sp_percentage = $row["az_sp_percentage"];
        $obj->az_sp_commision_amount = $row["az_sp_commision_amount"];
        $obj->az_sd_percentage = $row["az_sd_percentage"];
        $obj->az_sd_commision_amount = $row["az_sd_commision_amount"];
        $obj->company_token = $row["company_token"];
        $obj->airport_token = $row["airport_token"];
        $obj->service_date_time = $row["service_date_time"];
        $cancel_charges_detail = (trim($row['cancel_charges']) != '')? explode("|&|", trim($row['cancel_charges'])): [];
        $cancel_charges_array = [];
            foreach ($cancel_charges_detail as $cancel_charges_key => $cancel_charges_value) {
                $cancel_policy = explode("||", $cancel_charges_value);

                $cancel_obj = new stdClass;
                $cancel_obj->hours = $cancel_policy[1];
                $cancel_obj->percentage = $cancel_policy[2];
                array_push($cancel_charges_array, $cancel_obj);
            }
        $obj->cancellation_policy_detail = $cancel_charges_array;
        $obj->discount_net_amt = $row['discount_net_amt'];
        $obj->markup_amount = $row['markup_amount'];
        return $obj;
    }
    
    public function airportZoFee(){
        $query = "SELECT `amount` FROM `admin__cancel_charge`";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row["amount"];
    }
    
     function getCreditAvailableForServiceDistributor(){
        $query = "SELECT `is_credit`, `credit_available` FROM `service__distributor` WHERE `token`=:distributor_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->is_credit = $row["is_credit"];
        $obj->credit_available = $row["credit_available"];
        return $obj;
    }
    function updateDistributorCreditAvailableAmount(){
        $query = "UPDATE `service__distributor` SET `credit_available`=:balance_credit WHERE `token`=:distributor_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":balance_credit", $this->distributor_balance_credit);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->execute();
    }
    
     function getCommissionForServiceProvider(){
        $query = "SELECT `service__provider`.`credit_available`,
        `service__provider`.`token` AS `service_provider`,
        `service__provider`.`is_credit`,
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
        $obj->is_credit = $row["is_credit"];
        return $obj;
    }
    function updateCreditAvailableAmount(){
        $query = "UPDATE `service__provider` SET `credit_available`=:credit_available WHERE `token`=:service_provider";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":credit_available", $this->balance_provider_credits);
        $this->stmt->bindParam(":service_provider", $this->service_provider);
        $this->stmt->execute();
    }
    function updateStatus(){
        $query = "UPDATE `users__booking_detail` SET `status`='NoShow' WHERE `token`=:booking_service_token";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":booking_service_token", $this->booking_service_token);
        if($this->stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>