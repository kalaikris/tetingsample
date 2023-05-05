<?php
class services extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function serviceCheck(){
        $query = "SELECT `token`,
        `name`,
        `image`,
        `date_time`
        FROM `avail_service` 
        WHERE `status`='1'
        ORDER BY id DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function serviceView($stmt){
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
    public function serviceAvailableCheck(){
        $query = "SELECT `token` 
        FROM `avail_service` 
        WHERE `name`=:name
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function serviceUpdateAvailableCheck(){
        $query = "SELECT `token` 
        FROM `avail_service` 
        WHERE `name`=:name
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->execute();
        return $stmt;
    }
    
    public function addService(){
        $query = "INSERT INTO `avail_service` SET `token`=:token,
        `name`=:name,
        `image`=:image,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function updateService(){
        $query = "UPDATE `avail_service` SET
        `name`=:name,
        `image`=:image
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteAvailableServices(){
        $query = "UPDATE `avail_service` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->execute();
        return $stmt;
    }
}
?>