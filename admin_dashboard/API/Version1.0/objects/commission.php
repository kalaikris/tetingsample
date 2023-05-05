<?php
class commission extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function commissionCheck(){
        $query = "SELECT `id`,
        `type`,
        `percentage` 
        FROM `admin__commission_percentage`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function commissionView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->id        = $row['id'];
            $obj->type      = $row['type'];
            $obj->percentage= $row['percentage'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function commissionUpdate(){
        $query = "UPDATE `admin__commission_percentage` SET 
        `percentage`=:percentage
        WHERE `id`=:id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":percentage", $this->percentage);
        $stmt->execute();
        return $stmt;
    }
}
?>