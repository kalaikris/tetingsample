<?php
class dashboard extends Database {
    //public $stmt;
    function revenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
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
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`=:agent_token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->bindParam(":agent_token", $this->agentToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount'];
    }
    
    
    function bookingCount(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT `users__booking_detail`.`id`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function agentBookingCount(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT `users__booking_detail`.`id`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `users__booking`.`is_agent`='1'
        AND `users__booking`.`agent_token`=:agent_token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->bindParam(":agent_token", $this->agentToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    function recentBooking(){
        $query="SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`date_time`,
        `airport`.`gmt`,
        `users__booking`.`status`,
        `users`.`name` AS `customer_name`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        COUNT(`users__booking_detail`.`token`) AS `services_count`,
        GROUP_CONCAT(`service__provider_company`.`name`,'|&&&&&|') AS `company_name`,
        GROUP_CONCAT(`business_type`.`name`,'|&&&&&|') AS `type_name`
        FROM `users__booking`
        INNER JOIN `service__distributor_employee` ON `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor_employee`.`token`=:token
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`date_time` DESC
        LIMIT 0,10";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function recentBookingView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingToken = $row['token'];
            $obj->bookingNumber= $row['booking_number'];
            $obj->createdDate  = convertDate("d M, Y H:i",$row['date_time'])."(".$row['gmt'].")";
            $obj->customerName = $row['customer_name'];
            $obj->memberCount  = $row['member_count'];
            $obj->status       = $row['status'];
            $obj->servicesCount= $row['services_count'];
            /////$obj->companyName  = str_replace('|&&&&&|,', ' | ', rtrim($row['company_name'],'|&&&&&|') );
            /////$obj->typeName     = str_replace('|&&&&&|,', ' | ', rtrim($row['type_name'],'|&&&&&|') );
            array_push($array, $obj);
        }
        return $array;   
    }
    function totalBookingCount(){
        $searchQuery = "";
        if($this->year!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$this->year%' ";
        }
        $query="SELECT 
        `users__booking_detail`.`id`
        FROM `users__booking` 
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
            $searchQuery
        )
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `service__distributor_employee` ON  `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`

        WHERE `service__distributor_employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function topAirports(){
        $fromDate = $this->from_date;
        $toDate = $this->to_date;
        $searchQuery = "";
//        if($this->year!=""){
//            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$this->year%' ";
//        }
        if($fromDate!="" && $toDate!=""){
            $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate) );
            $toDate = date("Y-m-d 23:59:59", strtotime($toDate) );
            $searchQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }else{
            $searchQuery = "";
        }
        $query="SELECT `airport`.`name`,
        `airport`.`code`,
        COUNT(`users__booking_detail`.`token`) AS `booking_count`
        FROM `service__distributor_airport`
        INNER JOIN `service__distributor_employee` ON 
        `service__distributor_employee`.`service_distributor_token`=`service__distributor_airport`.`service_distributor_token`
        INNER JOIN `airport` ON `airport`.`token`=`service__distributor_airport`.`airport_token`
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`airport_token`=`airport`.`token`
            $searchQuery
        )
        INNER JOIN `users__booking` ON (
        	`users__booking`.`token`=`users__booking_detail`.`booking_token`
            AND `users__booking`.`service_distributor_token`=`service__distributor_airport`.`service_distributor_token`
        )
        WHERE `service__distributor_employee`.`token`=:token
        GROUP BY `airport`.`token`
        ORDER BY `booking_count` DESC
        LIMIT 0,6
        ";
        //LIMIT 0,20
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function topAirportsView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportName = $row['name'];
            $obj->airportCode = $row['code'];
            $obj->bookingCount= $row['booking_count'];
            $this->totalCount+= $row['booking_count'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function serviceChartData(){
        $searchQuery = "";
        if($this->year!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT 
        `business_type`.`name`,
        COUNT(`users__booking_detail`.`token`) AS `booking_count`
        FROM `users__booking` 
        INNER JOIN `service__distributor_employee` ON (
            `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
            $searchQuery
        )
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_airport`.`business_type_token`
        WHERE `service__distributor_employee`.`token`=:token
        GROUP BY `business_type`.`token` 
        ORDER BY `booking_count` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function servicesData(){
        $query="SELECT 
        `business_type`.`token`,
        `business_type`.`name`
        FROM `users__booking` 
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
        )
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_airport`.`business_type_token`
        INNER JOIN `service__distributor_employee` ON (
            `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        WHERE `service__distributor_employee`.`token`=:token
        GROUP BY `business_type`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function serviceChartDataView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->serviceType = $row['name'];
            $obj->bookingCount= $row['booking_count'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function servicesDataView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $array_range = $this->ranges;
            $obj = new stdClass;
            $obj->serviceType = $row['name'];
            $arrayMonths = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            $monthData   = [];
//            foreach($arrayMonths as $month){
            foreach($array_range as $range){
                $likeMatch     = $range;
                $obj1=new stdClass();
                $obj1->dates        = $likeMatch;
                $obj1->bookingcount = $this->serviceBookingCount($likeMatch,$row['token']);
                array_push($monthData, $obj1);
            }
            $obj->counts = $monthData;
            array_push($array, $obj);
        }
        return $array;  
    }
    function serviceBookingCount($likeMatch,$businessTypeToken){
        $searchQuery = "";
        if($likeMatch!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$likeMatch%' ";
        }
        $query="SELECT 
        `business_type`.`name`
        FROM `users__booking` 
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
            $searchQuery
        )
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_airport`.`business_type_token`
        INNER JOIN `service__distributor_employee` ON (
            `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        WHERE `service__distributor_employee`.`token`=:token
        AND `business_type`.`token`=:business_type_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->bindParam(":business_type_token", $businessTypeToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function volumeData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT `users__booking_detail`.`id` 
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor_employee` ON 
        `service__distributor_employee`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor_employee`.`token`=:token
        $searchQuery
        ";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function distributorCreditView(){
        $query = "SELECT 
        `service__distributor`.`credit_available`,
        COALESCE( SUM(`service__distributor_credit_logs`.`given_credit`),0) AS `total_credits`
        FROM `service__distributor`
        INNER JOIN `service__distributor_employee` ON 
            `service__distributor_employee`.`service_distributor_token`=`service__distributor`.`token`
        LEFT JOIN `service__distributor_credit_logs` ON
            `service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`
        WHERE `service__distributor_employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->totalCredits   = $row['total_credits'];
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
    function getComissionDetails(){
        $query = "SELECT `yearly_target`,
        `percent`,
        `commision_type`
        FROM `service__distributor_agent_commision` 
        WHERE `sd_agent_token`=:agent_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":agent_token", $this->agentToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->yearlyTarget = $row['yearly_target'];
        $obj->percent      = $row['percent'];
        $obj->commisionType= $row['commision_type'];
        return $obj;
    }
    
    function websiteData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = "  AND `users__booking`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT 
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
        return $stmt->rowCount();
    }
    
    function agentData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = "  AND `users__booking`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT 
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
        AND `users__booking`.`is_agent`='1' AND `users__booking`.`agent_token`!=''
        $searchQuery
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`id` DESC";
        
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>