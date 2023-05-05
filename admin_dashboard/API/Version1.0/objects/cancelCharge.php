<?php
class cancelCharge extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function cancelChargeCheck(){
        $query = "SELECT `amount` FROM `admin__cancel_charge`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function cancelChargeView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->cancelCharge = $row['amount'];
        return $obj;
    }
    public function cancelChargeUpdate(){
        $query = "UPDATE `admin__cancel_charge` SET 
        `amount`=:amount
        WHERE `id`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":amount", $this->cancelCharge);
        $stmt->execute();
        return $stmt;
    }
}
?>