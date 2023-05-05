<?php
class company extends Database {
    // object properties
    //public $name;
    //public $siteName;
    //public $stmt;
    public function userCompanyApproved(){
        $query = "SELECT `service__provider_company`.`name`,
        `service__provider_company`.`token`,
        `service__provider_company`.`logo`,
        `service__provider_company`.`image`,
        `service__provider_company`.`status` As `companystatus`,
        `business_type`.`name` AS `business_type`,
        `service__provider_company_location`.`token` AS `service_provider_company_locationToken`
        FROM `service__provider_company` 
        INNER JOIN `business_type` ON `service__provider_company`.`business_type_token`=`business_type`.`token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
        INNER JOIN `service__provider_company_location_staffs` ON `service__provider_company_location_staffs`.`service_provider_company_location_token`=`service__provider_company`.`service_provider_token`
        WHERE `service__provider_company_location_staffs`.`token`=:token
        AND `service__provider_company`.`status`='2'
        GROUP BY `service__provider_company`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function userCompany(){
        $query = "SELECT `service__provider_company`.`name`,
        `service__provider_company`.`token`,
        `service__provider_company`.`logo`,
        `service__provider_company`.`image`,
        `service__provider_company`.`status` As `companystatus`,
        `business_type`.`name` AS `business_type`,
        `service__provider_company_location`.`token` AS `service_provider_company_locationToken`
        FROM `service__provider_company` 
        INNER JOIN `business_type` ON `service__provider_company`.`business_type_token`=`business_type`.`token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
        INNER JOIN `service__provider_company_location_staffs` ON `service__provider_company_location_staffs`.`service_provider_company_location_token`=`service__provider_company`.`service_provider_token`
        WHERE `service__provider_company_location_staffs`.`token`=:token
        AND `service__provider_company`.`status`!='4'
        AND `service__provider_company`.`status`!='2'
        GROUP BY `service__provider_company`.`token` ORDER BY `service__provider_company`.`status` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function userCompanyView($stmt, $stmtApproved){
        $array = [];
        while ($row = $stmtApproved->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token  = $row['token'];
            $obj->name   = $row['name'];
            $obj->logo   = $row['logo'];
            $obj->image  = $row['image'];
            $obj->companystatus = $row['companystatus'];
            $obj->business_type = $row['business_type'];
            $obj->airports      = $this->companyAirports($row['token']); 
            array_push($array, $obj);
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token  = $row['token'];
            $obj->name   = $row['name'];
            $obj->logo   = $row['logo'];
            $obj->image  = $row['image'];
            $obj->companystatus = $row['companystatus'];
            $obj->business_type = $row['business_type'];
            $obj->airports      = $this->companyAirports($row['token']); 
            array_push($array, $obj);
        }
        return $array;
    }
    public function companyAirports($token){
        $array = [];
        $query = "SELECT `airport`.`token`,
        `airport`.`name`,
        `service__provider_company_location`.`token` AS `location_token`,
        `service__provider_company_location`.`is_filled`,
        `service__provider_company_location`.`status`
        FROM `service__provider_company_location` 
        INNER JOIN `airport` ON `airport`.`token`=`service__provider_company_location`.`airport_token`
        WHERE `company_token`=:company_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $token);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->service_provider_company_locationToken = $row['location_token'];
            $obj->airportToken = $row['token'];
            $obj->airportName  = $row['name'];
            $obj->isFilled     = $row['is_filled'];
            $obj->status     = $row['status'];
            array_push($array, $obj);
        }
        return $array;
    }
}
?>