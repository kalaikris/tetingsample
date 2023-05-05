<?php
class amenities extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function amenitiesCheck(){
        $query = "SELECT `token`,
        `name`,
        `image`,
        `date_time` 
        FROM `amenities` 
        WHERE `status`='1'
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function amenitiesView($stmt){
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
    public function amenityAvailableCheck(){
        $query = "SELECT `token` 
        FROM `amenities` 
        WHERE `name`=:name
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function amenityUpadteAvailableCheck(){
        $query = "SELECT `token` 
        FROM `amenities` 
        WHERE `name`=:name
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->amenityToken);
        $stmt->execute();
        return $stmt;
    }
    
    public function addAmenity(){
        $query = "INSERT INTO `amenities` SET `token`=:token,
        `name`=:name,
        `image`=:image,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->amenityToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    public function updateAmenity(){
        $query = "UPDATE `amenities` SET 
        `name`=:name,
        `image`=:image
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":token", $this->amenityToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteAmenity(){
        $query = "UPDATE `amenities` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->amenityToken);
        $stmt->execute();
        return $stmt;
    }
}
?>