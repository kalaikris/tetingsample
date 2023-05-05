<?php
class appUsers extends Database {
    function userList(){
        $query = "SELECT `users`.`token`,
        `users`.`name`,
        `users`.`email`,
        `users`.`mobile_number`,
        `users`.`is_airportzo_user`,
        `users`.`status`,
        `service__distributor`.`name` AS `bookedMode`
        FROM `users` 
        LEFT JOIN `service__distributor` ON 
        	`service__distributor`.`token`=`users`.`service_distributor_token`
        WHERE `users`.`is_agent`='0'
        AND `users`.`status`!='3' AND `service__distributor`.`token`!='1111111111' AND `service__distributor`.`status`='0'
        ORDER BY `users`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function userListView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token      = $row["token"];
            $obj->name       = $row["name"];
            $obj->email      = $row["email"];
            $obj->mobileNumber   = $row["mobile_number"];
            $obj->isAirportzoUser= $row["is_airportzo_user"];
            $obj->status     = $row["status"];
            if($row["is_airportzo_user"]=='1'){
                $obj->bookedMode = "Airportzo";
            }else{
                $obj->bookedMode = $row["bookedMode"];;
            }
            array_push($array, $obj);
        }
        return $array;
    }
    function agentUserList(){
        $query = "SELECT `users`.`token`,
        `users`.`name`,
        `users`.`email`,
        `users`.`mobile_number`,
        `users`.`is_approved`,
        `users`.`status`
        FROM `users` 
        WHERE `users`.`is_agent`='1'
        AND `users`.`status`!='3'
        ORDER BY `users`.`is_approved`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function agentUserListView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token      = $row["token"];
            $obj->name       = $row["name"];
            $obj->email      = $row["email"];
            $obj->mobileNumber= $row["mobile_number"];
            $obj->isApproved = $row["is_approved"];
            $obj->status     = $row["status"];
            array_push($array, $obj);
        }
        return $array;
    }
    function singleUserDetail(){
        $query = "SELECT 
        `users`.`name`,
        `users`.`email`,
        `users`.`mobile_number`,
        `users`.`is_airportzo_user`,
        `service__distributor`.`name` AS `bookedMode`
        FROM `users` 
        LEFT JOIN `service__distributor` ON 
        	`service__distributor`.`token`=`users`.`service_distributor_token`
        WHERE `users`.`token`=:token AND `service__distributor`.`token`!='1111111111' AND `service__distributor`.`status`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function singleUserDetailView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name       = $row["name"];
        $obj->email      = $row["email"];
        $obj->mobileNumber= $row["mobile_number"];
        if($row["is_airportzo_user"]=='1'){
            $obj->bookedMode = "Airportzo";
        }else{
            $obj->bookedMode = $row["bookedMode"];;
        }
        $obj->totalMilesEarned= "";
        $obj->availableMiles  = "";
        return $obj;
    }
    function singleUserOrderDetail(){
        $query = "SELECT `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `airport`.`name` AS `airport_name`,
        `airport__terminal`.`name` AS `airport__terminal`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON 
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__terminal` ON 
            `airport__terminal`.`token`=`users__booking_detail`.`terminal_token`
        WHERE `users__booking`.`user_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function singleUserOrderDetailView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token         = $row["token"];
            $obj->bookingNumber = $row["booking_number"];
            $obj->serviceAirport= $row["airport_name"]." - ".$row["airport__terminal"];
            $obj->MilesEarned   = "";
            $obj->MilesBurned   = "";
            array_push($array, $obj);
        }
        return $array;
    }
    function singleAgetUserDetail(){
        $query = "SELECT `users`.`name`,
        `users`.`email`,
        `users`.`mobile_number`,
        `users`.`dob`,
        `users`.`address`,
        `countries`.`name` AS `countries`,
        `regions`.`name` AS `state`,
        `cities`.`name` AS `city`,
        `users`.`pincode`,
        `users`.`account_number`,
        `users`.`ifsc_code`,
        `users`.`pan_card`,
        `users`.`address_proof`
        FROM `users`
        LEFT JOIN `countries` ON `countries`.`id`=`users`.`country_id`
        LEFT JOIN `regions`ON `regions`.`id`=`users`.`state_id`
        LEFT JOIN `cities` ON `cities`.`id`=`users`.`city_id`
        WHERE `users`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function singleAgentUserDetailView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name       = $row["name"];
        $obj->email      = $row["email"];
        $obj->mobileNumber= $row["mobile_number"];
        $obj->dob        = convertDate("d M Y", $row["dob"]);
        $obj->address    = $row["address"];
        $obj->country    = $row["countries"];
        $obj->state      = $row["state"];
        $obj->city       = $row["city"];
        $obj->pincode    = $row["pincode"];
        $obj->acNumber   = $row["account_number"];
        $obj->ifscCode   = $row["ifsc_code"];
        $obj->panCard    = $row["pan_card"];
        $obj->addressProof= $row["address_proof"];
        return $obj;
    }
    function approveRejectAgent(){
        $query = "UPDATE `users` SET `is_approved`=:is_approved WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->bindParam('is_approved', $this->status);
        $stmt->execute();
        return $stmt;
    }
    function blockUnblockUser(){
        $query = "UPDATE `users` SET `status`=:status WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->bindParam('status', $this->status);
        $stmt->execute();
        return $stmt;
    }
    function getUserMailDetails(){
        $query = "SELECT `name`,
        `email`
        FROM `users` 
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->user_mail_id  = $row["email"];
        $obj->user_name     = $row["name"];
        return $obj;
    }
}
?>