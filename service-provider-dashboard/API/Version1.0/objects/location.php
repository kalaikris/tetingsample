<?php
class location extends Database {
    // object properties
    //public $stmt;
    
    function countries(){
        $array = [];
        $query = "SELECT `id`,`name`,`code` FROM `countries`";
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
    function airport_name(){
        $array = [];
        $query = "SELECT `name` FROM `airport` WHERE `token`=:airportToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airportToken", $this->airportToken);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportName  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
}
?>