<?php
class partners extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function partnersCheck(){
        $query = "SELECT `token`,
        `name`,
        `image`,
        `date_time` 
        FROM `our_partners` 
        WHERE `status`='1'
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function partnersView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['token'];
            $obj->name     = $row['name'];
            $obj->image    = $row['image'];
            $obj->createdDate= convertDate("d M, Y",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;
    }
    public function partnerAvailableCheck(){
        $query = "SELECT `token` 
        FROM `our_partners` 
        WHERE `name`=:name
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function partnerUpdateAvailableCheck(){
        $query = "SELECT `token` 
        FROM `our_partners` 
        WHERE `name`=:name
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->partnerToken);
        $stmt->execute();
        return $stmt;
    }
    public function addPartner(){
        $query = "INSERT INTO `our_partners` SET `token`=:token,
        `name`=:name,
        `image`=:image,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->partnerToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function updatePartner(){
        $query = "UPDATE `our_partners` SET 
        `name`=:name,
        `image`=:image
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":token", $this->partnerToken);
        $stmt->execute();
        return $stmt;
    }
    public function deletePartner(){
        $query = "UPDATE `our_partners` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->partnerToken);
        $stmt->execute();
        return $stmt;
    }
}
?>