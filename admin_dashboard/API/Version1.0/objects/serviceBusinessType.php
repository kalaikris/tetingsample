<?php
class serviceBusinessType extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function businessTypeCheck(){
        $query = "SELECT `token`,
        `name`,
        `image`,
        `hsn`,
        `date_time` 
        FROM `business_type` 
        WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function businessTypeView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['token'];
            $obj->name     = $row['name'];
            $obj->hsn      = $row['hsn'];
            $obj->image    = $row['image'];
            $obj->createdDate= convertDate("d M, Y",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;
    }
    public function businessTypeAvailableCheck(){
        $query = "SELECT `token` 
        FROM `business_type` 
        WHERE `name`=:name
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function addBusinessType(){
        $query = "INSERT INTO `business_type` SET
        `token`=:token,
        `type`=:type,
        `name`=:name,
        `image`=:image,
        `description`=:description,
        `hsn`=:hsn,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->businessTypeToken);
        $stmt->bindParam(":type", $this->serviceType);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":hsn", $this->hsn);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addBusinessTypeAvailService(){
        $array = $this->availServiceTokens;
        foreach($array as $token){
            $this->insertBusinessTypeAvailService($token);
        }   
    }
    function insertBusinessTypeAvailService($availableServiceToken){
        $query = "INSERT INTO `business_type__avail_service` SET
        `business_type_token`=:business_type_token,
        `avail_service_token`=:avail_service_token,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt->bindParam(":avail_service_token", $availableServiceToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addBusinessTypeImages(){
        $array = $this->photosArray;
        foreach($array as $image){
            $this->insertBusinessTypeImages($image);
        }   
    }
    function insertBusinessTypeImages($image){
        $query = "INSERT INTO `business_type__images` SET
        `business_type_token`=:business_type_token,
        `image`=:image,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addBusinessTypePartners(){
        $array = $this->availPartnerTokens;
        foreach($array as $partnerToken){
            $this->insertBusinessTypePartners($partnerToken);
        }
    }
    function insertBusinessTypePartners($partnerToken){
        $query = "INSERT INTO `business_type__partners` SET
        `business_type_token`=:business_type_token,
        `partner_token`=:partner_token,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt->bindParam(":partner_token", $partnerToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    
    public function deleteBusinessType(){
        $query = "UPDATE `business_type` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->businessTypeToken);
        $stmt->execute();
        return $stmt;
    }
    function serviceBusinessDetails(){
        $query = "SELECT `token`,
        `name`,
        `type`,
        `image`,
        `description`,
        `hsn`,
        `date_time` 
        FROM `business_type` 
        WHERE `status`='1'
        AND `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->token        = $row['token'];
        $obj->serviceType  = $row['type'];
        $obj->image        = $row['image'];
        $obj->name         = $row['name'];
        $obj->description  = $row['description'];
        $obj->hsn          = $row['hsn'];
        $obj->photosArray  = $this->businessTypePhotos($row['token']);
        $obj->availServices= $this->businessAvailServices($row['token']);
        $obj->availPartners= $this->businessAvailPartners($row['token']);
        $obj->serviceIncluded= $this->businessServiceIncluded($row['token']);
        return $obj;
    }
    function businessTypePhotos($token){
        $query = "SELECT `image` 
        FROM `business_type__images`
        WHERE `business_type_token`=:token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            array_push($array, $row['image']);
        }
        return $array;
    }
    function businessAvailServices($token){
        $query = "SELECT `business_type__avail_service`.`avail_service_token`,
        `avail_service`.`name`,
        `avail_service`.`image`
        FROM `business_type__avail_service`
        INNER JOIN `avail_service` ON `avail_service`.`token`=`business_type__avail_service`.`avail_service_token`
        WHERE  `business_type__avail_service`.`business_type_token`=:token
        AND  `business_type__avail_service`.`status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['avail_service_token'];
            $obj->name     = $row['name'];
            $obj->image    = $row['image'];
            array_push($array, $obj);
        }
        return $array;
    }
    function businessAvailPartners($token){
        $query = "SELECT `business_type__partners`.`partner_token`,
        `our_partners`.`name`,
        `our_partners`.`image`
        FROM `business_type__partners`
        INNER JOIN `our_partners` ON `our_partners`.`token`=`business_type__partners`.`partner_token`
        WHERE `business_type__partners`.`business_type_token`=:token
        AND `business_type__partners`.`status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token    = $row['partner_token'];
            $obj->name     = $row['name'];
            $obj->image    = $row['image'];
            array_push($array, $obj);
        }
        return $array;
    }
    function businessServiceIncluded($token){
        $query = "SELECT `description` 
        FROM `business_type__service` 
        WHERE `business_type_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            array_push($array, $row['description']);
        }
        return $array;
    }
    public function updateBusinessTypeAvailableCheck(){
        $query = "SELECT `token` 
        FROM `business_type` 
        WHERE `name`=:name
        AND `status`='1'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":token", $this->businessTypeToken);
        $stmt->execute();
        return $stmt;
    }
    public function updateBusinessType(){
        $query = "UPDATE `business_type` SET
        `type`=:type,
        `name`=:name,
        `image`=:image,
        `description`=:description,
        `hsn`=:hsn
        WHERE `token`=:token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":type", $this->serviceType);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":hsn", $this->hsn);
        $stmt->bindParam(":token", $this->businessTypeToken);
        $stmt->execute();
        return $stmt;
    }
    function updateBusinessTypeAvailService(){
        $query1 = "UPDATE `business_type__avail_service` SET
        `status`='2'
        WHERE `business_type_token`=:business_type_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt1->execute();
        $array = $this->availServiceTokens;
        foreach($array as $token){
            $query = "SELECT `id`
            FROM `business_type__avail_service` 
            WHERE `business_type_token`=:business_type_token
            AND `avail_service_token`=:avail_service_token";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":business_type_token", $this->businessTypeToken);
            $stmt->bindParam(":avail_service_token", $token);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $this->insertBusinessTypeAvailService($token);
            }else{
                $query2 = "UPDATE `business_type__avail_service` SET
                `status`='1'
                WHERE `business_type_token`=:business_type_token
                AND `avail_service_token`=:avail_service_token";
                $stmt2 = $this->conn->prepare( $query2 );
                $stmt2->bindParam(":business_type_token", $this->businessTypeToken);
                $stmt2->bindParam(":avail_service_token", $token);
                $stmt2->execute();  
            }
        }  
    }
    function updateBusinessTypeImages(){
        $query1 = "UPDATE `business_type__images` SET
        `status`='2'
        WHERE `business_type_token`=:business_type_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt1->execute();
        $array = $this->photosArray;
        foreach($array as $image){
            $query = "SELECT `id`
            FROM `business_type__images` 
            WHERE `business_type_token`=:business_type_token
            AND `image`=:image";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":business_type_token", $this->businessTypeToken);
            $stmt->bindParam(":image", $image);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $this->insertBusinessTypeImages($image);
            }else{
                $query2 = "UPDATE `business_type__images` SET
                `status`='1'
                WHERE `business_type_token`=:business_type_token
                AND `image`=:image";
                $stmt2 = $this->conn->prepare( $query2 );
                $stmt2->bindParam(":business_type_token", $this->businessTypeToken);
                $stmt2->bindParam(":image", $image);
                $stmt2->execute();  
            }
        }  
    }
    function updateBusinessTypePartners(){
        $query1 = "UPDATE `business_type__partners` SET
        `status`='2'
        WHERE `business_type_token`=:business_type_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt1->execute();
        $array = $this->availPartnerTokens;
        foreach($array as $partnerToken){
            $query = "SELECT `id`
            FROM `business_type__partners` 
            WHERE `business_type_token`=:business_type_token
            AND `partner_token`=:partner_token";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":business_type_token", $this->businessTypeToken);
            $stmt->bindParam(":partner_token", $partnerToken);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $this->insertBusinessTypePartners($partnerToken);
            }else{
                $query2 = "UPDATE `business_type__partners` SET
                `status`='1'
                WHERE `business_type_token`=:business_type_token
                AND `partner_token`=:partner_token";
                $stmt2 = $this->conn->prepare( $query2 );
                $stmt2->bindParam(":business_type_token", $this->businessTypeToken);
                $stmt2->bindParam(":partner_token", $partnerToken);
                $stmt2->execute();  
            }
        }  
    }
    function updateBusinessTypeService(){
        $serviceIncludedArray = $this->serviceIncluded;
        foreach($serviceIncludedArray as $value){
            $query1 = "SELECT `id`
            FROM `business_type__service` 
            WHERE `business_type_token`=:business_type_token
            AND `description`=:description";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->bindParam(":business_type_token", $this->businessTypeToken);
            $stmt1->bindParam(":description", $value);
            $stmt1->execute();
            if($stmt1->rowCount()==0){
                $this->insertBusinessTypeService($value);
            }
//            else{
//                $query = "UPDATE `business_type__service` SET 
//                `description`=:description
//                WHERE `business_type_token`=:business_type_token";
//                $stmt = $this->conn->prepare( $query );
//                $stmt->bindParam(":description", $this->serviceIncluded);
//                $stmt->bindParam(":business_type_token", $this->businessTypeToken);
//                $stmt->execute();
//            }
        }
    }
    function addBusinessTypeService(){
        $array = $this->serviceIncluded;
        foreach($array as $description){
            $this->insertBusinessTypeService($description);
        }
    }
    function insertBusinessTypeService($description){
        $query = "INSERT INTO `business_type__service` SET 
        `business_type_token`=:business_type_token,
        `description`=:description,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_type_token", $this->businessTypeToken);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    
}
?>