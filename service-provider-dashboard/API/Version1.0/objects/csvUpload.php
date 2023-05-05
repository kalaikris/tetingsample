<?php
class csvUpload extends Database {
    // object properties
    public $name;
    public $siteName;
    //public $stmt;
    public function siteNameCheck(){
        $query = "SELECT `token`
        FROM `service__distributor` 
        WHERE `site_name`=:site_name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":site_name", $this->siteName);
        $stmt->execute();
        return $stmt;
    }
    public function getCity($country,$city){
        $query = "SELECT `cities`.`id` AS `city_id`
        FROM `countries` 
        INNER JOIN `cities` ON (`countries`.`id`=`cities`.`country_id`) 
        WHERE `countries`.`name`=:country
        AND `cities`.`name`=:city";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country", $country);
        $stmt->bindParam(":city", $city);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['city_id'];
    }
    public function checkAirport($city_id,$code,$name){
        $obj=new stdClass();
        $query = "SELECT `name`,
        `token` 
        FROM `airport` 
        WHERE `code`=:code 
        AND `city_id`=:city_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":code", $code);
        $stmt->bindParam(":city_id", $city_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('airport','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `airport` SET `token`='$token',
            `name`='$name',
            `code`='$code',
            `city_id`='$city_id',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            $obj->code = 201;
            $obj->name = $name;
            $obj->token= $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $obj->code = 202;
            $obj->name = $row['name'];
            $obj->token= $row['token'];
        }
        return  $obj;  
    }
    public function distributorAirport($distributorToken,$bussinessTypeToken,$airportToken){
        $query="SELECT 
        `token` 
        FROM `service__distributor_airport` 
        WHERE `service_distributor_token`=:service_distributor_token 
        AND `business_type_token`=:business_type_token
        AND `airport_token`=:airport_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $distributorToken);
        $stmt->bindParam(":business_type_token", $bussinessTypeToken);
        $stmt->bindParam(":airport_token", $airportToken);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('service__distributor_airport','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service__distributor_airport` SET `token`='$token',
            `service_distributor_token`='$distributorToken',
            `business_type_token`='$bussinessTypeToken',
            `airport_token`='$airportToken',
            `created_date`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function getTerminal($name){
        $query= "SELECT `token` FROM `airport__terminal` WHERE `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('airport__terminal','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `airport__terminal` SET 
            `token`='$token',
            `name`='$name',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function getBussinessType($business_type){
        if($business_type=="Meet & Assist" || $business_type=="MAAS"){
            $business_type = "Meet and Greet";
        }
        $query="SELECT `token` FROM `business_type` WHERE `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $business_type);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['token'];
    }
    public function getAirportType($airport_type){
        $query= "SELECT `token` FROM `airport__type` WHERE `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $airport_type);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('airport__type','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `airport__type` 
            SET `token`='$token',
            `name`='$airport_type',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function getCategoryId($category){
        $query="SELECT `token` FROM `airport__category` WHERE `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $category);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['token'];
    }
    public function airportTerminalTypeRelation($airport_id,$terminal_id,$airport_type_id,$airport_category_id){
        $query= "SELECT `token` 
        FROM `airport__terminal_type_relation` 
        WHERE `airport_token`=:airport_token 
        AND `terminal_token`=:terminal_token 
        AND `type_token`=:type_token
        AND `category_token`=:category_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $airport_id);
        $stmt->bindParam(":terminal_token", $terminal_id);
        $stmt->bindParam(":type_token", $airport_type_id);
        $stmt->bindParam(":category_token", $airport_category_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('airport__terminal_type_relation','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `airport__terminal_type_relation`
            SET `token`='$token',
            `airport_token`='$airport_id',
            `terminal_token`='$terminal_id',
            `type_token`='$airport_type_id',
            `category_token`='$airport_category_id',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function providerCompany($service_company,$service_provider_id,$business_type_id){
        $query= "SELECT `token` 
        FROM `service__provider_company` 
        WHERE `service_provider_token`=:service_provider_token 
        AND `business_type_token`=:business_type_token 
        AND `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_token", $service_provider_id);
        $stmt->bindParam(":business_type_token", $business_type_id);
        $stmt->bindParam(":name", $service_company);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('service__provider_company','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service__provider_company` SET 
            `token`='$token',
            `service_provider_token`='$service_provider_id',
            `business_type_token`='$business_type_id',
            `name`='$service_company',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    
    function providerLocation($provider_company_id,$airport_id){
        $query="SELECT `token` 
        FROM `service__provider_company_location` 
        WHERE `company_token`=:company_token 
        AND `airport_token`=:airport_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $provider_company_id);
        $stmt->bindParam(":airport_token", $airport_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('service__provider_company_location','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service__provider_company_location` SET 
            `token`='$token',
            `company_token`='$provider_company_id',
            `airport_token`='$airport_id',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function serviceId($provider_company_id,$type,$package_name,$business_type_token,$airport_id,$location_id){
        $query= "SELECT `service`.`token`
        FROM `service`
        INNER JOIN `service__location` ON(
            `service`.`token` = `service__location`.`service_token`
        )
        INNER JOIN `airport__terminal_type_relation` ON(
            `service__location`.`airport_ttr_token` = `airport__terminal_type_relation`.`token`
        )
        WHERE `service`.`type` = :type 
        AND  `service`.`service_provider_company_token` = :service_provider_company_token 
        AND `airport__terminal_type_relation`.`airport_token` = :airport_token 
        AND `service`.`name` = :name 
        AND `service`.`service_provider_company_location_token`=:location_token
        AND `service`.`status` = '1'";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_company_token", $provider_company_id);
        $stmt->bindParam(":airport_token", $airport_id);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":name", $package_name);
        $stmt->bindParam(":location_token", $location_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('service','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service` SET `token`='$token',
            `service_provider_company_token`='$provider_company_id',
            `type`='$type',
            `business_type_token`='$business_type_token',
            `name`='$package_name',
            `service_provider_company_location_token`='$location_id',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function serviceBussinessRelation($service_id,$business_type_id){
        $query= "SELECT `id` 
        FROM `service__business_relation` 
        WHERE `service_token`=:service_token 
        AND `business_type_token`=:business_type_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $service_id);
        $stmt->bindParam(":business_type_token", $business_type_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service__business_relation` SET 
            `service_token`='$service_id',
            `business_type_token`='$business_type_id',
            `date_time`='$datetime'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        }
    }
    function serviceBussinessRelationBundle($service_id,$business_type_array){
        $bussiness_relation_id_array = [];
        foreach($business_type_array as $business_type){
            $business_type       = ltrim($business_type,'-');
            $business_type       = rtrim($business_type,' ');
            $business_type_id    = $this->getBussinessType($business_type);

            $query="SELECT `id` 
            FROM `service__business_relation` 
            WHERE `service_token`=:service_token 
            AND `business_type_token`=:business_type_token";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":service_token", $service_id);
            $stmt->bindParam(":business_type_token", $business_type_id);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $datetime = $this->gmDateTime;
                $query1 = "INSERT INTO `service__business_relation` SET 
                `service_token`='$service_id',
                `business_type_token`='$business_type_id',
                `date_time`='$datetime'";
                $stmt1 = $this->conn->prepare( $query1 );
                $stmt1->execute();
                $final_id =  $this->conn->lastInsertId();
            }else{
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $final_id =  $row['id'];
            }
            array_push($bussiness_relation_id_array,$final_id);
        }
        return $bussiness_relation_id_array;
    }
    public function serviceLocationId($service_id,$airport_relation_id,$adult_amount,$children_amount, $ad_adult_amount,$ad_children_amount){
        $query= "SELECT `token` 
        FROM `service__location` 
        WHERE `service_token`=:service_token 
        AND `airport_ttr_token`=:airport_ttr_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $service_id);
        $stmt->bindParam(":airport_ttr_token", $airport_relation_id);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $token    = $this->generateToken('service__location','token');
            $datetime = $this->gmDateTime;
            $query1 = "INSERT INTO `service__location` SET 
            `token`='$token',
            `service_token`='$service_id',
            `airport_ttr_token`='$airport_relation_id',
            `price_adult`='$adult_amount',
            `price_children`='$children_amount',
            `additional_price_adult`='$ad_adult_amount',
            `additional_price_children`='$ad_children_amount'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->execute();
            return $token;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['token'];
        }
    }
    public function description($service_location_id,$array_description){
        $array = [];
        foreach($array_description as $value){
            $value = preg_replace('/\s+/', ' ', $value);
            $value       = ltrim($value,' ');
            $value       = ltrim($value,'-');
            $value       = rtrim($value,' ');
            $value = str_replace("'", "\'", $value);
            if($value!=""){
                $attr = new stdClass();
                $attr->text   = $value;
                $query= "SELECT `token` 
                FROM `service__features` 
                WHERE `service_location_token`=:service_location_token 
                AND `name`=:name";
                $stmt = $this->conn->prepare( $query );
                $stmt->bindParam(":service_location_token", $service_location_id);
                $stmt->bindParam(":name", $value);
                $stmt->execute();
                if($stmt->rowCount()==0){
                    $token    = $this->generateToken('service__features','token');
                    $datetime = $this->gmDateTime;
                    $query1 = "INSERT INTO `service__features` SET 
                    `token`='$token',
                    `service_location_token`='$service_location_id',
                    `name`='$value',
                    `date_time`='$datetime'";
                    $stmt1 = $this->conn->prepare( $query1 );
                    $stmt1->execute();
                    $attr->token =  $token;
                }else{
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $attr->token =  $row['token'];
                }
                array_push($array,$attr);
            }
        }
        return $array;
    }
    public function generateToken($table,$column) {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        $query= "SELECT id FROM $table WHERE `$column` = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $randstring);
        $stmt->execute();
        $num  = $stmt->rowCount();
        return ($num==0) ? $randstring : generateToken();
    }
    function getProviderLocationId($provider_company_id,$airport_id){
        $query="SELECT `token` FROM `service__provider_company_location` 
        WHERE `company_token`=:company_token
        AND `airport_token`=:airport_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $provider_company_id);
        $stmt->bindParam(":airport_token", $airport_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['token'];
    }
    function serviceProviderPriceLog($service_id,$provider_company_id,$business_type_token,$location_id,$adult_amount,$children_amount,$ad_adult_amount,$ad_children_amount){
        $token    = $this->generateToken('service__provider_price_log','token');
        $datetime = $this->gmDateTime;
        $query1 = "INSERT INTO `service__provider_price_log` SET `token`='$token',
        `service_token`='$service_id',
        `service_provider_company_token`='$provider_company_id',
        `service_provider_company_location_token`='$location_id',
        `business_type_token`='$business_type_token',
        `price_adult`='$adult_amount',
        `price_children`='$children_amount',
        `additional_price_adult`='$ad_adult_amount',
        `additional_price_children`='$ad_children_amount',
        `date_time`='$datetime'";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
        return $token;
    }
}
?>