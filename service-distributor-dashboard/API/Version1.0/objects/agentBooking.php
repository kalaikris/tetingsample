<?php
class booking extends Database {
    // object properties
    public $businessId;
    public $password;
    //public $stmt;
    
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
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`!=''
        AND `users__booking_detail`.`status`='$status'
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    
    public function bookingHistory(){
        $fromDate = $this->fromDate;
        $toDate = $this->toDate;
        $searchQuery = "";
        if($fromDate != "" && $toDate != ""){
            $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate) );
            $toDate = date("Y-m-d 23:59:59", strtotime($toDate) );
            $searchQuery = " AND `users__booking`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }else{
            $searchQuery = "";
        }
        if($this->agentToken == "AllAgent"){
            $agentQuery = "AND `users__booking`.`agent_token`!=''";
        }else{
            $agentQuery = "AND `users__booking`.`agent_token`='$this->agentToken'";
        }
        $query = "SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking`.`date_time`,
        `users__booking`.`status`,
        `users`.`name` AS `customer_name`,
        `service__distributor_agent`.`name` AS `agent_name`,
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
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        INNER JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        $agentQuery
        $searchQuery
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function bookingHistoryView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingToken = $row['token'];
            $obj->bookingNumber= $row['booking_number'];
            $obj->paymentId    = $row['payment_id'];
            $obj->createdDate  = convertDate("d M Y H:i", $row['date_time']);
            $obj->customerName = $row['customer_name'];
            $obj->agentName    = $row['agent_name'];
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
}
?>