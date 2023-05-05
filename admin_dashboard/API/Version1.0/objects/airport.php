<?php
class airport extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function airportCheck(){
        $query = "SELECT `airport`.`token`,
        `airport`.`name`,
        `airport`.`code`,
        `airport`.`time_zone`,
        `airport`.`gmt`,
        `airport`.`city_id`,
        `cities`.`name` AS `city_name`,
        `cities`.`region_id`,
        `regions`.`name` AS `region_name`,
        `cities`.`country_id`,
        `countries`.`name` AS `country_name`
        FROM `airport`
        INNER JOIN `cities` ON `cities`.`id`=`airport`.`city_id`
        INNER JOIN `regions` ON `regions`.`id`=`cities`.`region_id`
        INNER JOIN `countries` ON `countries`.`id`=`cities`.`country_id`
        WHERE `airport`.`status`='1'
        ORDER BY `airport`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function airportView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->airportToken= $row['token'];
            $obj->name     = $row['name'];
            $obj->code     = $row['code'];
            $obj->timeZone = $row['time_zone'];
            $obj->gmt      = $row['gmt'];
            $obj->cityId   = $row['city_id'];
            $obj->cityName = $row['city_name'];
            $obj->stateId  = $row['region_id'];
            $obj->stateName= $row['region_name'];
            $obj->countryId= $row['country_id'];
            $obj->countryName = $row['country_name'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function countryCheck(){
        $query = "SELECT `countries`.`name` AS `country_name`,
                         `countries`.`id` AS `country_id`,
                         `regions`.`name` AS `region_name`,
                        `regions`.`id` AS `region_id`,
                        `regions`.`gst_no`,
                        `regions`.`pancard_number`,
                        `regions`.`company_name`,
                        `regions`.`address`
                        FROM `regions`
                        INNER JOIN `countries` ON `countries`.`id`=`regions`.`country_id`
                        WHERE 1";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function countryView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->countryName = $row['country_name'];
            $obj->stateName= $row['region_name'];
            $obj->countryId= $row['country_id'];
            $obj->stateId  = $row['region_id'];
            $obj->gst_no   = $row['gst_no'];
            $obj->pancard_number   = $row['pancard_number'];
            $obj->company_name   = $row['company_name'];
            $obj->address   = $row['address'];
            
            array_push($array, $obj);
        }
        return $array;
    }
    public function airportAvailableCheck(){
        $query = "SELECT `token` 
        FROM `airport` 
        WHERE `code`=:code
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":code", $this->code);
        $stmt->execute();
        return $stmt;
    }
    public function airportAvailableCheckCsv($code){
        $query = "SELECT `token` 
        FROM `airport` 
        WHERE `code`=:code
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":code", $code);
        $stmt->execute();
        return $stmt;
    }
    public function airportUpadteAvailableCheck(){
        $query = "SELECT `token` 
        FROM `airport` 
        WHERE `code`=:code
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":code", $this->code);
        $stmt->bindParam(":token", $this->airportToken);
        $stmt->execute();
        return $stmt;
    }  
    public function addAirport(){
        $query = "INSERT INTO `airport` SET `token`=:token,
        `name`=:name,
        `code`=:code,
        `city_id`=:city_id,
        `time_zone`=:time_zone,
        `gmt`=:gmt,
        `date_time`=:date_time,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->airportToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":code", $this->code);
        $stmt->bindParam(":city_id", $this->cityId);
        $stmt->bindParam(":time_zone", $this->timeZone);
        $stmt->bindParam(":gmt", $this->gmt);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function addTerminalRelationType(){
        $query = "INSERT INTO `airport__terminal_type_relation` SET `token`=:ttrToken,
        `airport_token`=:airportToken,
        `terminal_token`='9876543210',
        `type_token`='7424792131',
        `category_token`='1122334456',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":ttrToken", $this->ttrToken);
        $stmt->bindParam(":airportToken", $this->airportToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function addAirportCsv($obj){
        $query = "INSERT INTO `airport` SET `token`=:token,
        `name`=:name,
        `code`=:code,
        `city_id`=:city_id,
        `time_zone`=:time_zone,
        `gmt`=:gmt,
        `date_time`=:date_time,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $obj->airportToken);
        $stmt->bindParam(":name", $obj->name);
        $stmt->bindParam(":code", $obj->code);
        $stmt->bindParam(":city_id", $obj->cityId);
        $stmt->bindParam(":time_zone", $obj->timeZone);
        $stmt->bindParam(":gmt", $obj->gmt);
        $stmt->bindParam(":date_time", $obj->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    
    public function updateAirport(){
        $query = "UPDATE `airport` SET
        `name`=:name,
        `code`=:code,
        `city_id`=:city_id,
        `time_zone`=:time_zone,
        `gmt`=:gmt
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":code", $this->code);
        $stmt->bindParam(":city_id", $this->cityId);
        $stmt->bindParam(":time_zone", $this->timeZone);
        $stmt->bindParam(":gmt", $this->gmt);
        $stmt->bindParam(":token", $this->airportToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteAirport(){
        $query = "UPDATE `airport` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->airportToken);
        $stmt->execute();
        return $stmt;
    }
    function getCountryId($countryName){
        $query = "SELECT `id` FROM `countries` WHERE `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $countryName);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }
    function getStateId($countryId,$stateName){
        $query = "SELECT `id` FROM `regions` WHERE `name`=:name AND `country_id`=:country_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $stateName);
        $stmt->bindParam(":country_id", $countryId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }
    function getCityId($countryId,$stateId,$cityName){
        $query = "SELECT `id` FROM `cities` WHERE `country_id`=:country_id AND `region_id`=:region_id AND `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country_id", $countryId);
        $stmt->bindParam(":region_id", $stateId);
        $stmt->bindParam(":name", $cityName);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    }
}
?>