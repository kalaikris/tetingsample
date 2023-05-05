<?php
class onboard extends Database {
    // object properties
    public $name;
    public $siteName;
    //public $stmt;
    
    public function userCheck(){
        $query = "SELECT `service__distributor_employee`.`token`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE `service__distributor_employee`.`service_distributor_token`=:service_distributor_token
        AND `service__distributor_employee`.`token`=:token
        AND `service__distributor`.`is_business_info`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function generateToken($table,$column) {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        $query= "SELECT id FROM $table WHERE `$column` = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $randstring);
        $stmt->execute();
        $num  = $stmt->rowCount();
        return ($num==0) ? $randstring : generateToken();
    }
    public function generateTokenNumeric($table,$column) {
        $str_result = '0123456789';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        $query= "SELECT id FROM $table WHERE `$column` = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $randstring);
        $stmt->execute();
        $num  = $stmt->rowCount();
        return ($num==0) ? $randstring : generateToken();
    }
    function distributorTypes(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `service__distributor_type` WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token = $row['token'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function countries(){
        $array = [];
        $query = "SELECT `id`,`name`,`code` FROM `countries` WHERE `id` IN('2','96','231')";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId   = $row['id'];
            $obj->countryName = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function regions(){
        $array = [];
        $query = "SELECT `id`,
        `country_id`, 
        `name` 
        FROM `regions` 
        WHERE `name`!='' 
        AND country_id=:country_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId = $row['country_id'];
            $obj->stateId   = $row['id'];
            $obj->stateName = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function cities(){
        $array = [];
        $query = "SELECT `id`,
        `region_id`,
        `country_id`,
        `name` 
        FROM `cities` 
        WHERE `name`!=''
        AND `country_id`=:country_id
        AND `region_id`=:region_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->bindParam(":region_id", $this->stateId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId = $row['country_id'];
            $obj->stateId   = $row['region_id'];
            $obj->cityId    = $row['id'];
            $obj->cityName  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceLocations(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `business_type`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $businessTypeToken = $row['token'];
            $obj->token = $businessTypeToken;
            $obj->name  = $row['name'];
            $airportArray = [];
            $query1 = "SELECT `airport`.`token`,
            `airport`.`name`, 
            `airport`.`code` 
            FROM `service__provider_company_location` 
            INNER JOIN `airport` ON `airport`.`token`=`service__provider_company_location`.`airport_token` 
            INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`service__provider_company_location`.`company_token` 
            WHERE `service__provider_company`.`business_type_token`=:business_type_token 
            GROUP BY `airport`.`token`";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->bindParam(":business_type_token", $businessTypeToken);
            $stmt1->execute();
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
                $obj1 = new stdClass;
                $obj1->airportToken = $row1['token'];
                $obj1->airportName  = $row1['name'];
                $obj1->airportCode  = $row1['code'];
                array_push($airportArray, $obj1);
            }
            $obj->airports  = $airportArray;
            
            array_push($array, $obj);
        }
        return $array;
    }
    function bussinessTypeList(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `business_type` WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token = $row['token'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function airportsList(){
        $array = [];
        $query = "SELECT `airport`.`token`,
        `airport`.`name`, 
        `airport`.`code`,
        COALESCE(`service__provider_company`.`business_type_token`,'') AS `business_type_token`
        FROM `airport` 
        LEFT JOIN `service__provider_company_location` ON 
            `airport`.`token`=`service__provider_company_location`.`airport_token` 
        LEFT JOIN `service__provider_company` ON 
            `service__provider_company`.`token`=`service__provider_company_location`.`company_token` 
        WHERE 1 
        GROUP BY `airport`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportToken = $row['token'];
            $obj->airportName  = $row['name'];
            $obj->airportCode  = $row['code'];
            $obj->businessTypeToken  = $row['business_type_token'];
            array_push($array, $obj);
        }
        return $array;
    }
    function UpadteGstNumber(){
        $query = "UPDATE `regions` SET
                        `gst_no`=:gst_no,
                        `pancard_number`=:pancard,
                        `company_name`=:company_name,
                        `address`=:address
                  WHERE `country_id` =:country_id AND `id` =:stateId";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":gst_no", $this->gst_no);
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->bindParam(":stateId", $this->stateId);
        $stmt->bindParam(":pancard", $this->pancard);
        $stmt->bindParam(":company_name", $this->company_name);
        $stmt->bindParam(":address", $this->address);
        $stmt->execute();
        return $stmt;
    }
}
?>