<?php
class distributorType extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function distributorTypeCheck(){
        $query = "SELECT `token`,
        `name`,
        `is_agent`,
        `date_time` 
        FROM `service__distributor_type` 
        WHERE `status`='1'
        ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function distributorTypeView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['token'];
            $obj->name     = $row['name'];
            $obj->isAgent  = $row['is_agent'];
            $obj->createdDate= convertDate("d M, Y",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;
    }
    public function distributorTypeAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_type` 
        WHERE `name`=:name
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function distributorTypeUpdateAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_type` 
        WHERE `name`=:name
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
    public function addType(){
        $query = "INSERT INTO `service__distributor_type` SET `token`=:token,
        `name`=:name,
        `is_agent`=:is_agent,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":is_agent", $this->isAgent);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function updateType(){
        $query = "UPDATE `service__distributor_type` SET
        `name`=:name,
        `is_agent`=:is_agent
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":is_agent", $this->isAgent);
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteType(){
        $query = "UPDATE `service__distributor_type` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
}
?>