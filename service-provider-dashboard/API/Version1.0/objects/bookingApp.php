<?php
class bookingApp extends Database{
    function completedBookings(){
        $query = "SELECT `users__booking_detail`.`token`,
        `users__booking`.`booking_number`,
        `users`.`name` AS `user_name`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`service_date_time`,
        `airport__category`.`name` AS `airport_category`,
        `users__booking_detail`.`status`,
        `users__booking_status`.`date_time`
        FROM `users__booking_detail`  
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        INNER JOIN `users__booking_status` ON 		
        	`users__booking_status`.`users_booking_detail_token`=`users__booking_detail`.`token`
            AND `users__booking_status`.`status`='Completed'
        WHERE `users__booking_detail`.`assignee_token`=:token
        AND `users__booking_detail`.`status`='Completed'
        ORDER BY `users__booking_status`.`date_time` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function bookings($status){
        $query = "SELECT `users__booking_detail`.`token`,
        `users__booking`.`booking_number`,
        `users`.`name` AS `user_name`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`service_date_time`,
        `airport__category`.`name` AS `airport_category`,
        `users__booking_detail`.`status`
        FROM `users__booking_detail`  
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        WHERE `users__booking_detail`.`assignee_token`=:token
        AND `users__booking_detail`.`status`='$status'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function bookingView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->bookingToken = $row["token"];
            $obj->bookingNumber= $row["booking_number"];
            $obj->userName     = $row["user_name"];
            $obj->totalAdult   = $row["total_adult"];
            $obj->totalChildren= $row["total_children"];
            //$obj->serviceDate  = convertDate("d M, Y",$row["service_date_time"]);
            //$obj->serviceTime  = convertDate("H:i",$row["service_date_time"]);
            $obj->serviceDate  = date("d M, Y", strtotime($row['service_date_time']) );
            $obj->serviceTime  = date("H:i", strtotime($row['service_date_time']) );
            $obj->travelType   = $row["airport_category"];
            if($row['status']=="Assign"){
                $obj->status= "Upcoming";
            }else{
                $obj->status= $row['status'];
            }
            array_push($array, $obj);
        }
        return $array;
    }
    function singleBookingHistory($gm_date){
        $query = "SELECT 
        `users__booking_detail`.`token`,
        `users__booking`.`booking_number`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`date_time`,
        `airport__type`.`name` AS `airport_type`,
        `airport__category`.`name` AS `airport_category`,
        `users__booking_detail`.`service_date_time`,
        `users__booking_journey`.`flight_number`,
        `contact_passenger`.`title` AS `contact_title`,
        `contact_passenger`.`name` AS `contact_name`,
        `contact_passenger`.`country_code` AS `contact_country_code`,
        `contact_passenger`.`mobile_number` AS `contact_mobile_number`,
        `contact_passenger`.`date_of_birth` AS `contact_date_of_birth`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        COALESCE(`greeter_passenger`.`title`,'') AS `greeter_title`,
        COALESCE(`greeter_passenger`.`name`,'') AS `greeter_name`,
        COALESCE(`greeter_passenger`.`country_code`,'') AS `greeter_country_code`,
        COALESCE(`greeter_passenger`.`mobile_number`,'') AS `greeter_mobile_number`,
        `service`.`name` AS `service_name`,
        `users__booking_detail`.`description`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `users__booking_journey` ON `users__booking_journey`.`booking_token`=`users__booking`.`token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        LEFT JOIN `users__booking_passenger` AS `booking_contact_passenger` ON (
            `booking_contact_passenger`.`booking_token`=`users__booking`.`token`
            AND `booking_contact_passenger`.`passenger_type`='Contact'
        )
        LEFT JOIN `users__passenger` AS `contact_passenger` ON 
        	`contact_passenger`.`token`=`booking_contact_passenger`.`user_passenger_token`
        LEFT JOIN `users__booking_passenger` AS `booking_greeter_passenger` ON (
            `booking_greeter_passenger`.`booking_token`=`users__booking`.`token`
            AND `booking_greeter_passenger`.`passenger_type`='Greeter'
        )
        LEFT JOIN `users__passenger` AS `greeter_passenger` ON 
        	`greeter_passenger`.`token`=`booking_greeter_passenger`.`user_passenger_token`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`    
        WHERE `users__booking_detail`.`token`=:token"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $obj = new stdClass;
        $obj->bookingNumber= $row['booking_number'];
        if($row['status']=="Assign"){
            $obj->bookingStatus= "Upcoming";
        }else{
            $obj->bookingStatus= $row['status'];
        }
        $obj->bookedOn     = convertDate("d M Y, H:i", $row['date_time']);
        $obj->serviceAt    = $row['airport_category'];
        $obj->serviceDate  = date("d M, Y", strtotime($row['service_date_time']) );
        $obj->serviceTime  = date("H:i", strtotime($row['service_date_time']) );
        $obj->flightNumber = $row['flight_number'];
        $obj->contactPassengerName   = $row['contact_title'].".".$row['contact_name'];
        $obj->contactPassengerNumber = "+".$row['contact_country_code']." ".$row['contact_mobile_number'];
        $diff = abs(strtotime($gm_date) - strtotime($row['contact_date_of_birth']));
        $obj->contactPassengerAge    = floor($diff / (365*60*60*24));;
        $obj->totalAdults  = $row['total_adult'];
        $obj->totalChildren= $row['total_children'];
        if($row['greeter_name']!=""){
            $obj->greeterPassengerName   = $row['greeter_title'].".".$row['greeter_name'];
            $obj->greeterPassengerNumber = "+".$row['greeter_country_code']." ".$row['greeter_mobile_number'];
        }else{
            $obj->greeterPassengerName   = "";
            $obj->greeterPassengerNumber = "";
        }
        $obj->service_name = $row['service_name'];
        $obj->notes        = $row['description'];
        $serviceTime       = date("Y-m-d H:i:s", strtotime($row['service_date_time']));
        $checkTime         = date("Y-m-d H:i:s", strtotime('+30 minutes', strtotime($this->checkTime) ));

        if($serviceTime<=$checkTime && $row['status']!="Completed"){
            $obj->chartBoolean        = true;
        }else{
            $obj->chartBoolean        = false;
        }
        $obj->trackWork    = $this->trackWork($row['token']);
        return $obj;
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
    function workStatusCheck(){
        $query = "SELECT `id`
        FROM `users__booking_status` 
        WHERE `users_booking_detail_token`=:token
        AND `status`=:status";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->bindParam(":status", $this->workStatus);
        $stmt->execute();
        return $stmt;
    }
    function updateStatus($status,$gm_date_time){
        $query="UPDATE `users__booking_detail` SET `status`=:status,`service_completed_date_time`=:service_completed_date_time WHERE `token`=:bookingToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":bookingToken", $this->bookingToken);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":service_completed_date_time", $gm_date_time);
        $stmt->execute();
        if($status=="Completed"){
            $query1 = "SELECT `assignee_token`
            FROM `users__booking_detail` 
            WHERE `token`=:token";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->bindParam(":token", $this->bookingToken);
            $stmt1->execute();
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);
            $assigneeToken = $row["assignee_token"];
            $query2="UPDATE `service__provider_company_location_staffs` SET 
            `is_available`='0'
            WHERE `token`=:token";
            $stmt2 = $this->conn->prepare( $query2 );
            $stmt2->bindParam(":token", $assigneeToken);
            $stmt2->execute();
        }
        return $stmt;
    }
    function addWorkStatus($gm_date_time){
        $query = "INSERT INTO `users__booking_status` SET 
        `users_booking_detail_token`=:token,
        `status`=:status,
        `date_time`='$gm_date_time'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->bindParam(":status", $this->workStatus);
        $stmt->execute();
        return $stmt;
    }
    function privacyPolicy(){
        $query = "SELECT `service__provider_company_location`.`terms_conditions`,
        `service__provider_company_location`.`privacy_policy`,
        `service__provider_company_location`.`about`
        FROM `service__provider_company_location_staffs` AS `staffs`
        LEFT JOIN `service__provider_company_location` ON 
            `service__provider_company_location`.`token`=`staffs`.`service_provider_company_location_token`
        WHERE `staffs`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->termsConditions = $row["terms_conditions"];
        $obj->privacyPolicy   = $row["privacy_policy"];
        $obj->aboutUs         = $row["about"];
        return $obj;
    }
    function getProviderDetails(){
        $query = "SELECT 
        `service__provider`.`token`,
        `service__provider`.`credit_available`,
        `service__provider`.`commission_percentage`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON 
            `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider` ON 		
            `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        WHERE `users__booking_detail`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->providertoken   = $row["token"];
        $obj->providerCredits = $row["credit_available"];
        $obj->commission      = $row["commission_percentage"];
        return $obj;
    }
    function getProviderPercentage(){
        $query = "SELECT `percentage` 
        FROM `admin__commission_percentage` 
        WHERE `type`='Service Provider'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["percentage"];
    }
    function getBookingNetAmount(){
        $query = "SELECT `net_amount` 
        FROM `users__booking_detail`
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["net_amount"];
    }
    function getDistributorDetails(){
        $query = "SELECT `service__distributor`.`token`,
        `service__distributor`.`credit_available`,
        `service__distributor`.`commission_percentage`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON
            `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor` ON 
            `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        WHERE `users__booking_detail`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->bookingToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->distributorToken   = $row["token"];
        $obj->distributorCredits = $row["credit_available"];
        $obj->commission         = $row["commission_percentage"];
        return $obj;
    }
    function getDistributorPercentage(){
        $query = "SELECT `percentage` 
        FROM `admin__commission_percentage` 
        WHERE `type`='Service Distributor'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["percentage"];
    }
//    function updateCommisionDetails(){
//        $query = "UPDATE `users__booking_detail` SET
//        `az_sp_percentage`=:az_sp_percentage,
//        `az_sp_commision_amount`=:az_sp_commision_amount,
//        `sp_amount`='',
//        `sp_previous_credit`=:sp_previous_credit,
//        `sp_balance_credit`=:sp_balance_credit,
//        `az_sd_percentage`=:az_sd_percentage,
//        `az_sd_commision_amount`=:az_sd_commision_amount,
//        `sd_previous_credit`=:sd_previous_credit,
//        `sd_balance_credit`=:sd_balance_credit 
//        WHERE `token`=:token";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":az_sp_percentage", $this->providerPercentage);
//        $stmt->bindParam(":az_sp_commision_amount", $this->providerCommission);
//        /////$stmt->bindParam(":sp_amount", $this->bookingToken);
//        $stmt->bindParam(":sp_previous_credit", $this->providerPreviousCredit);
//        $stmt->bindParam(":sp_balance_credit", $this->providerBalanceCredit);
//        $stmt->bindParam(":az_sd_percentage", $this->distributorPercentage);
//        $stmt->bindParam(":az_sd_commision_amount", $this->distributorCommission);
//        $stmt->bindParam(":sd_previous_credit", $this->distributorPreviousCredit);
//        $stmt->bindParam(":sd_balance_credit", $this->distributorBalanceCredit);
//        $stmt->bindParam(":token", $this->bookingToken);
//        $stmt->execute();
//    }
//    function updateProviderCredits(){
//        $query = "UPDATE `service__provider`
//        SET `credit_available`=:credit_available 
//        WHERE `token`=:token";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":credit_available", $this->providerBalanceCredit);
//        $stmt->bindParam(":token", $this->providertoken);
//        $stmt->execute();
//    }
//    function updateDistributorCredits(){
//        $query = "UPDATE `service__distributor` 
//        SET `credit_available`=:credit_available 
//        WHERE `token`=:token";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":credit_available", $this->distributorBalanceCredit);
//        $stmt->bindParam(":token", $this->distributorToken);
//        $stmt->execute();
//    }
}
?>