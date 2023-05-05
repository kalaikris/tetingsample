<?php
class miles extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function milesCheck(){
        $query = "SELECT `id`,
        `user_type`,
        `miles_type`,
        `amount`,
        `miles`,
        `maximum_earn` 
        FROM `miles`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function milesView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->id         = $row['id'];
            $obj->userType   = $row['user_type'];
            $obj->milesType  = $row['miles_type'];
            $obj->amount     = $row['amount'];
            $obj->miles      = $row['miles'];
            $obj->maximumEarn= $row['maximum_earn'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function milesUpdate(){
        $query = "UPDATE `miles` 
        SET `amount`=:amount,
        `miles`=:miles 
        WHERE `id`=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":miles", $this->miles);
        $stmt->execute();
        return $stmt;
    }
}
?>