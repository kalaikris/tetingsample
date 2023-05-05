<?php
class agentType extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function typeCheck(){
        $query = "SELECT `token`,
        `name`,
        `date_time` 
        FROM `service__distributor_agent_type` 
        WHERE `is_active`='1'
        ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function typeView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['token'];
            $obj->name     = $row['name'];
            $obj->createdDate= convertDate("d M, Y",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;
    }
    public function typeAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_agent_type` 
        WHERE `name`=:name
        AND `is_active`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function typeUpdateAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_agent_type` 
        WHERE `name`=:name
        AND `is_active`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
    public function addType(){
        $query = "INSERT INTO `service__distributor_agent_type` SET `token`=:token,
        `name`=:name,
        `is_active`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function updateType(){
        $query = "UPDATE `service__distributor_agent_type` SET
        `name`=:name
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteType(){
        $query = "UPDATE `service__distributor_agent_type` SET 
        `is_active`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->typeToken);
        $stmt->execute();
        return $stmt;
    }
}
?>