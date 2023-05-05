<?php
class ServicePolicies extends Database{

    //selecting all service amentities
    function getserviceamentities(){
        $query = "SELECT
        token,
        name,
        image
        FROM amenities WHERE status='1'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function airportTokenCheck(){
        $query = "SELECT `id` FROM `airport` WHERE `token`=:token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $this->airportToken);
        $stmt->execute();
        return $stmt;
    }
    //fetching all amentities data
    function readServiceAmentities($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->amentities_token = $row["token"];
            $obj->amentities_name = $row["name"];
            $obj->amentities_image = $row["image"];
            array_push($array, $obj);
        }
        return $array;
    }

    //selecting service location related airport
    function getservicelocationairport($service__provider_companytoken){
        $query = "SELECT
        airport.token,
        airport.name
        FROM service__provider_company_location
        INNER JOIN airport ON (service__provider_company_location.airport_token=airport.token)
        WHERE service__provider_company_location.token = '$service__provider_companytoken'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //fetching airport data
    function readServiceLocationAirport($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->airport_token = $row["token"];
            $obj->airport_name = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
//    function addShopPhotos(){
//        $shopPhotos = $this->shopPhotos;
//        foreach ($shopPhotos as $photo) {
//            $query="INSERT INTO `service__provider_company_location_shop_photos` SET `service_provider_company_location_token`=:token,
//            `image`=:image";
//            $stmt = $this->conn->prepare( $query );
//            $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//            $stmt->bindParam(":image", $photo);
//            $stmt->execute();
//        }
//    }
    function imageExistCheck($photo){
        $query="SELECT `id` 
        FROM `service__provider_company_location_shop_photos`
        WHERE `service_provider_company_location_token`=:token
        AND `image`=:image";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":image", $photo);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }
    function updateShopPhotos(){
        $query="UPDATE `service__provider_company_location_shop_photos` SET 
        `status`='2'
        WHERE `service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $shopPhotos = $this->shopPhotos;
        foreach ($shopPhotos as $photo) {
            if( $this->imageExistCheck($photo) ){
                $this->insertPhotos($photo);
            }else{
                $this->photoUpdate($photo);
            }
        }
    }
    function insertPhotos($photo){
        $query="INSERT INTO `service__provider_company_location_shop_photos` SET `service_provider_company_location_token`=:token,
        `image`=:image";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":image", $photo);
        $stmt->execute();
    }
    function photoUpdate($photo){
        $query="UPDATE `service__provider_company_location_shop_photos` SET 
        `status`='1'
        WHERE `service_provider_company_location_token`=:token
        AND `image`=:image";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":image", $photo);
        $stmt->execute();
    }
//    function addAmentities(){
//        $array = $this->amentities;
//        foreach ($array as $amentity) {
//            $query="INSERT INTO `service__provider_company_location_amenities` SET `service_provider_company_location_token`=:token,
//            `amenities_token`=:amenities_token";
//            $stmt = $this->conn->prepare( $query );
//            $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//            $stmt->bindParam(":amenities_token", $amentity);
//            $stmt->execute();
//        }
//    }
    function amentityExistCheck($amentity){
        $query="SELECT `id` 
        FROM `service__provider_company_location_amenities`
        WHERE `service_provider_company_location_token`=:token
        AND `amenities_token`=:amenities_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":amenities_token", $amentity);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }
    function updateAmentities(){
        $query="UPDATE `service__provider_company_location_amenities` SET 
        `status`='2'
        WHERE `service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $array = $this->amentities;
        foreach ($array as $amentity) {
            if( $this->amentityExistCheck($amentity) ){
                $this->insertamentity($amentity);
            }else{
                $this->amentityUpdate($amentity);
            }
        }
    }
    function insertamentity($amentity){
        $query="INSERT INTO `service__provider_company_location_amenities` SET `service_provider_company_location_token`=:token,
        `amenities_token`=:amenities_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":amenities_token", $amentity);
        $stmt->execute();
    }
    function amentityUpdate($amentity){
        $query="UPDATE `service__provider_company_location_amenities` SET 
        `status`='1'
        WHERE `service_provider_company_location_token`=:token
        AND `amenities_token`=:amenities_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":amenities_token", $amentity);
        $stmt->execute();
    }
//    function addBusinessHours(){
//        $array = $this->businessHours;
//        foreach ($array as $value) {
//            if(!$value->isholiday){
//                $query="INSERT INTO `service__provider_company_location_hours` SET`service_provider_company_location_token`=:token,
//                `days`=:days,
//                `open_time`=:open_time,
//                `close_time`=:close_time";
//                $stmt = $this->conn->prepare( $query );
//                $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//                $stmt->bindParam(":days", $value->dayname);
//                $stmt->bindParam(":open_time", $value->opentime);
//                $stmt->bindParam(":close_time", $value->closetime);
//                $stmt->execute();
//            }
//        }
//    }
    function businessHoursExistCheck($value){
        $query="SELECT `id` 
        FROM `service__provider_company_location_hours`
        WHERE `service_provider_company_location_token`=:token
        AND `days`=:days";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":days", $value->dayname);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }
    function updateBusinessHours(){
        $query="UPDATE `service__provider_company_location_hours` SET
        `status`='2'
        WHERE `service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken );
        $stmt->execute();
        $array = $this->businessHours;
        foreach ($array as $value) {
            if( $this->businessHoursExistCheck($value) ){
                if(!$value->isholiday){
                    $this->insertBusinessHours($value);
                }
            }else{
                if(!$value->isholiday){
                    $this->businessHoursUpdate($value);
                }
            }
        }
    }
    function insertBusinessHours($value){
        $query="INSERT INTO `service__provider_company_location_hours` SET`service_provider_company_location_token`=:token,
        `days`=:days,
        `open_time`=:open_time,
        `close_time`=:close_time,
        `status`=:status";
        $stmt = $this->conn->prepare( $query );
        $openTime  = date("H:i:s",strtotime($value->opentime) );
        $closetime = date("H:i:s",strtotime($value->closetime) );
        $dayname   = $value->dayname;
        $staus     = "1";
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken );
        $stmt->bindParam(":days", $dayname );
        $stmt->bindParam(":open_time", $openTime );
        $stmt->bindParam(":close_time", $closetime );
        $stmt->bindParam(":status", $staus );
        $stmt->execute();
    }
    function businessHoursUpdate($value){
        $query="UPDATE `service__provider_company_location_hours` SET
        `open_time`=:open_time,
        `close_time`=:close_time,
        `status`=:status
        WHERE `service_provider_company_location_token`=:token
        AND `days`=:days";
        $stmt = $this->conn->prepare( $query );
        $openTime  = date("H:i:s",strtotime($value->opentime) );
        $closetime = date("H:i:s",strtotime($value->closetime) );
        $dayname   = $value->dayname;
        $staus     = "1";
        $stmt->bindParam(":open_time", $openTime);
        $stmt->bindParam(":close_time", $closetime);
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":days", $dayname);
        $stmt->bindParam(":status", $staus );
        $stmt->execute();
    }
    function updateLocationDetails(){
        $query="UPDATE `service__provider_company_location` SET `about`=:about,
        `terms_conditions`=:terms_conditions,
        `privacy_policy`=:privacy_policy,
        `cancellation_policy`=:cancellation_policy,
        `reschedule_policy`=:reschedule_policy,
        `latitude`=:latitude,
        `longitude`=:longitude,
        `is_filled`='1'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":about", $this->aboutShop);
        $stmt->bindParam(":terms_conditions", $this->terms);
        $stmt->bindParam(":privacy_policy", $this->privacypolicy);
        $stmt->bindParam(":cancellation_policy", $this->cancellationpolicy);
        $stmt->bindParam(":reschedule_policy", $this->reschedulepolicy);
        $stmt->bindParam(":latitude", $this->latitute);
        $stmt->bindParam(":longitude", $this->longitute);
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
    }
//    function addCancelCharges(){
//        $array = $this->cancellationCharges;
//        foreach ($array as $value) {
//            $query="INSERT INTO `service__provider_company_location_cancel_charge` SET `service_provider_company_location_token`=:token,
//            `hours`=:hours,
//            `percentage`=:percentage,
//            `date_time`=:date_time";
//            $stmt = $this->conn->prepare( $query );
//            $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//            $stmt->bindParam(":hours", $value->booking_hours);
//            $stmt->bindParam(":percentage", $value->bookingtotalamount);
//            $stmt->bindParam(":date_time", $this->gmDateTime);
//            $stmt->execute();
//        }
//    }
    function cancelChargesCheck($value){
        $query="SELECT `id` 
        FROM `service__provider_company_location_cancel_charge`
        WHERE `service_provider_company_location_token`=:token
        AND `hours`=:hours";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":hours", $value->booking_hours);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }
    function updateCancelCharges(){
        $query="UPDATE `service__provider_company_location_cancel_charge` SET
        `status`='2'
        WHERE `service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $array = $this->cancellationCharges;
        foreach ($array as $value) {
            if( $this->cancelChargesCheck($value) ){
                $this->insertCancelCharges($value);
            }else{
                $this->cancelChargesUpdate($value);
            }
        }
    }
    function insertCancelCharges($value){
        $query="INSERT INTO `service__provider_company_location_cancel_charge` SET `service_provider_company_location_token`=:token,
        `hours`=:hours,
        `percentage`=:percentage,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":hours", $value->booking_hours);
        $stmt->bindParam(":percentage", $value->bookingtotalamount);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
    }
    function cancelChargesUpdate($value){
        $query="UPDATE `service__provider_company_location_cancel_charge` SET
        `percentage`=:percentage,
        `status`='1'
        WHERE `service_provider_company_location_token`=:token
        AND `hours`=:hours";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":percentage", $value->bookingtotalamount);
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":hours", $value->booking_hours);
        $stmt->execute();
    }
    function serviceCompanyLocationDetails(){
        $query="SELECT 
        `service__provider_company_location`.`token`,
        `service__provider_company`.`name`,
        `service__provider_company`.`logo`,
        `business_type`.`name` AS businesstype,
        `service__provider_company`.`website_name`,
        `service__provider_company_location`.`airport_token`,
        `airport`.`name` AS `airport_name`,
        `service__provider_company_location`.`latitude`,
        `service__provider_company_location`.`longitude`,
        `service__provider_company_location`.`about`,
        `service__provider_company_location`.`terms_conditions`,
        `service__provider_company_location`.`privacy_policy`,
        `service__provider_company_location`.`cancellation_policy`,
        `service__provider_company_location`.`reschedule_policy`
        FROM `service__provider_company_location`
        INNER JOIN `service__provider_company` ON 
            `service__provider_company`.`token`=`service__provider_company_location`.`company_token`
        INNER JOIN `airport` ON `airport`.`token`=`service__provider_company_location`.`airport_token`
        INNER JOIN `business_type` ON `service__provider_company`.`business_type_token`=`business_type`.`token`
        WHERE `service__provider_company_location`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function companyDetailsView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->serviceProviderLocationtoken = $row["token"];
        $obj->companyName = $row["name"];
        $obj->companyLogo = $row["logo"];
        $obj->businessType= $row["businesstype"];
        $obj->websiteName = $row["website_name"];
        $obj->airportToken= $row["airport_token"];
        $obj->airportName = $row["airport_name"];
        $obj->latitude    = $row["latitude"];
        $obj->longitude   = $row["longitude"];
        $obj->aboutShop   = $row["about"];
        $obj->termsConditions = $row["terms_conditions"];
        $obj->privacyPolicy   = $row["privacy_policy"];
        $obj->cancellationPolicy = $row["cancellation_policy"];
        $obj->reschedulePolicy   = $row["reschedule_policy"];
        return $obj;
    }
    function serviceCompanyLocationPhotos(){
        $query="SELECT `image` 
        FROM `service__provider_company_location_shop_photos` 
        WHERE `status`='1' 
        AND `service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function companyPhotosView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->shopImage  = $row["image"];
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceCompanyLocationAmenities(){
        $query="SELECT  
        `service__provider_company_location_amenities`.`amenities_token`,
        `amenities`.`name`,
        `amenities`.`image`
        FROM `service__provider_company_location_amenities`
        INNER JOIN `amenities` ON `amenities`.`token`=`service__provider_company_location_amenities`.`amenities_token`
        WHERE `service__provider_company_location_amenities`.`status`='1'
        AND `service__provider_company_location_amenities`.`service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function companyAmenitiesView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->amenitiesToken = $row["amenities_token"];
            $obj->amenitiesName  = $row["name"];
            $obj->amenitiesImage  = $row["image"];
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceCompanyLocationHours(){
        $query="SELECT `days`,
        `open_time`,
        `close_time`
        FROM `service__provider_company_location_hours`
        WHERE `service_provider_company_location_token`=:token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function companyHoursView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->days      = $row["days"];
            $obj->openTime  = date("h:i A", strtotime($row["open_time"]) );
            $obj->closeTime = date("h:i A", strtotime($row["close_time"]) );
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceCompanyIndividualServices(){
        $query="SELECT 
        `service__location`.`token` AS `service_location_token`,
        `airport__category`.`token` AS `airport_category_token`,
        `airport__category`.`name` AS `airport_category`,
        `airport__type`.`token` AS `airport_type_token`,
        `airport__type`.`name` AS `airport_type`,
        `airport__terminal`.`name` AS `terminal_name`,
        `service`.`token`,
        `service`.`name`,
        `business_type`.`name` AS `business_type`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`
        FROM `service`
        INNER JOIN `service__provider_company_location` ON 
            `service__provider_company_location`.`company_token`=`service`.`service_provider_company_token`
        INNER JOIN `service__business_relation` ON 
            `service__business_relation`.`service_token`=`service`.`token`
        INNER JOIN `business_type` ON 			
            `business_type`.`token`=`service__business_relation`.`business_type_token`
        INNER JOIN `service__location` ON `service__location`.`service_token`=`service`.`token`
        INNER JOIN `airport__terminal_type_relation` ON
            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        INNER JOIN `airport__terminal` ON 
            `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`    
        INNER JOIN `airport__type` ON 
            `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`    
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`    
        WHERE `service`.`type`='Individual'
        AND `service__provider_company_location`.`token`=:token
        AND `airport__terminal_type_relation`.`airport_token`=:airport_token
        AND `service`.`status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->bindParam(":airport_token", $this->locationAirportToken);
        $stmt->execute();
        return $stmt;
    }
    function companyIndividualServicesView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->serviceLocationToken= $row["service_location_token"];
            $obj->categoryToken= $row["airport_category_token"];
            $obj->category     = $row["airport_category"];
            $obj->airportTypeToken = $row["airport_type_token"];
            $obj->airportType  = $row["airport_type"];
            $obj->terminal     = $row["terminal_name"];
            $obj->priceAdult  = $row["price_adult"];
            $obj->priceChild  = $row["price_children"];
            
            $obj->businessType= $row["business_type"];
            $obj->serviceToken= $row["token"];
            $obj->serviceName = $row["name"];
            
            array_push($array, $obj);
        }
        return $array;
    }
    function companyIndividualServicesViewbackupnew($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj1 = new stdClass();
            $obj1->serviceToken= $row["token"];
            $obj1->serviceName = $row["name"];
            $obj1->priceAdult  = $row["price_adult"];
            $obj1->priceChild  = $row["price_children"];
            $obj = new stdClass();
            $obj->businessType= $row["business_type"];
            $obj->details     = $obj1;
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceCompanyIndividualServicesNew(){
//        $query="SELECT `service`.`token`,
//        `service`.`name`
//        FROM `service`
//        INNER JOIN `service__provider_company_location` ON 
//            `service__provider_company_location`.`company_token`=`service`.`service_provider_company_token`
//        INNER JOIN `service__location` ON `service__location`.`service_token`=`service`.`token`
//        INNER JOIN `airport__terminal_type_relation` ON
//            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
//        WHERE `service`.`type`='Individual'
//        AND `service__provider_company_location`.`token`=:token
//        AND `airport__terminal_type_relation`.`airport_token`=:airport_token
//        AND `service`.`status`='1'
//        GROUP BY `service`.`token`";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//        $stmt->bindParam(":airport_token", $this->locationAirportToken);
//        $stmt->execute();
        
        
        $query="SELECT `service`.`token`,
        `service`.`business_type_token`,
        `service`.`name`
        FROM `service`
        WHERE `service`.`type`='Individual'
        AND `service`.`service_provider_company_location_token`=:service_provider_company_location_token
        AND `service`.`status`='1'
        GROUP BY `service`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_company_location_token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        
        return $stmt;
    } 
    function serviceCompanyBundleServices(){
//        $query="SELECT `service`.`token`,
//        `service`.`name`
//        FROM `service`
//        INNER JOIN `service__provider_company_location` ON 
//            `service__provider_company_location`.`company_token`=`service`.`service_provider_company_token`
//        INNER JOIN `service__location` ON `service__location`.`service_token`=`service`.`token`
//        INNER JOIN `airport__terminal_type_relation` ON
//            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
//        WHERE `service`.`type`='Bundle'
//        AND `service__provider_company_location`.`token`=:token
//        AND `airport__terminal_type_relation`.`airport_token`=:airport_token
//        AND `service`.`status`='1'
//        GROUP BY `service`.`token`";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
//        $stmt->bindParam(":airport_token", $this->locationAirportToken);
//        $stmt->execute();
        
        $query="SELECT `service`.`token`,
        `service`.`business_type_token`,
        `service`.`name`
        FROM `service`
        WHERE `service`.`type`='Bundle'
        AND `service`.`service_provider_company_location_token`=:service_provider_company_location_token
        AND `service`.`status`='1'
        GROUP BY `service`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_company_location_token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    } 

    

    function companyBundleServicesView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->serviceToken       = $row["token"];
            $obj->serviceName        = $row["name"];
            $obj->servicesIncluded = $this->sevicesIncluded($row["token"]);
            $obj->terminalDetails  = $this->terminalDetails($row["token"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function sevicesIncluded($token){
        $query="SELECT  
         `business_type`.`token`,
         `business_type`.`name`
        FROM `service__business_relation`
        INNER JOIN `business_type` ON 
            `business_type`.`token`=`service__business_relation`.`business_type_token`
        WHERE `service__business_relation`.`service_token`=:service_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $token);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token       = $row["token"];
            $obj->name        = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    } 
    function terminalDetails($token){
        $query="SELECT `airport__terminal_type_relation`.`terminal_token`,
        `airport__terminal`.`name`,
        `airport__type`.`name` AS `type_name`
        FROM `service__location` 
        INNER JOIN `airport__terminal_type_relation` ON 
            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`    
        INNER JOIN `airport__terminal` ON 
            `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
        WHERE `service__location`.`service_token`=:service_token
        AND `airport__terminal_type_relation`.`airport_token`=:airport_token
        GROUP BY `airport__terminal_type_relation`.`terminal_token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $token);
        $stmt->bindParam(":airport_token", $this->aiprotToken);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->terminalToken = $row["terminal_token"];
            $obj->terminalName  = $row["name"];
            $obj->typeName      = $row["type_name"];
            $obj->priceDetails  = $this->priceDetails($token,$row["terminal_token"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function companyBundleServicesViewNew($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->serviceToken       = $row["token"];
            $obj->serviceName        = $row["name"];
            $obj->unique_business_token = $row["business_type_token"];
            $obj->servicesIncluded   = $this->sevicesIncluded($row["token"]);
            $obj->serviceLocations   = $this->bundleServiceDetails($row["token"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function bundleServiceDetails($token){
        $query="SELECT 
        `service__location`.`token`,
        `airport__terminal`.`name` AS `terminal_name`,
        `airport__type`.`token` AS `airport_type_token`,
        `airport__type`.`name` AS `airport_type`,
        `airport__category`.`token` AS `airport_category_token`,
        `airport__category`.`name` AS `airport_category`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `service__location`.`additional_price_adult`,
        `service__location`.`additional_price_children`
        FROM `service__location`
        INNER JOIN `airport__terminal_type_relation` ON
            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        INNER JOIN `airport__terminal` ON 
            `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
        INNER JOIN `airport__type` ON 
            `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
        WHERE `service__location`.`service_token`=:token
        AND `airport__terminal_type_relation`.`airport_token`=:airport_token
        AND `service__location`.`status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":airport_token", $this->locationAirportToken);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->serviceLocationToken = $row["token"];
            $obj->categoryToken= $row["airport_category_token"];
            $obj->category     = $row["airport_category"];
            $obj->airportTypeToken = $row["airport_type_token"];
            $obj->airportType  = $row["airport_type"];
            $obj->terminal     = $row["terminal_name"];
            $obj->priceAdult   = $row["price_adult"];
            $obj->priceChild   = $row["price_children"];
            $obj->priceAdultAdditional = $row["additional_price_adult"];
            $obj->priceChildAdditional = $row["additional_price_children"];
            $obj->features     = $this->serviceLocationFeatures($row["token"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceLocationFeatures($token){
        $query="SELECT `token`,`name` FROM `service__features` WHERE `service_location_token`=:token AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->featureToken = $row["token"];
            $obj->featureText  = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
    function priceDetails($token,$terminalToken){
        $query="SELECT  `service__location`.`token`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `airport__terminal_type_relation`.`terminal_token`,
        `airport__type`.`name` AS `type_name`,
        `airport__category`.`name` AS `category_name`,
        `airport`.`name` AS `airport_name`
        FROM `service__location`
        INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        INNER JOIN `airport__category`  ON `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`
        INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
        WHERE `service__location`.`service_token`=:service_token
        AND `airport__terminal_type_relation`.`terminal_token`=:terminal_token
        AND `airport__terminal_type_relation`.`airport_token`=:airport_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $token);
        $stmt->bindParam(":terminal_token", $terminalToken);
        $stmt->bindParam(":airport_token", $this->aiprotToken);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->priceAdult  = $row["price_adult"];
            $obj->priceChild  = $row["price_children"];
            $obj->airportName = $row["airport_name"];
            //$obj->typeName    = $row["type_name"];
            $obj->categoryName= $row["category_name"];
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceCancelCharge(){
        $query="SELECT `hours`,
        `percentage` 
        FROM `service__provider_company_location_cancel_charge`
        WHERE `service_provider_company_location_token`=:token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function companyCancelChargeView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->hours       = $row["hours"];
            $obj->percentage  = $row["percentage"];
            array_push($array, $obj);
        }
        return $array;
    }
    function categoryDropdown(){
        $query="SELECT `token`,`name` FROM `airport__category` ";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token = $row["token"];
            $obj->name  = $row["name"];
            if($row["token"]=="1122334457"){
                $obj->airportTypes  = $this->airportTypeDropdown();
            }else{
                $obj->airportTypes  = [];
            }
            array_push($array, $obj);
        }
        return $array;
    }
    function airportTypeDropdown(){
        $query="SELECT `token`,`name` FROM `airport__type` WHERE `is_transit`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->typeToken = $row["token"];
            $obj->typeName  = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
    function deleteFeatures(){
        $query="UPDATE `service__features` SET `status`='2'
        WHERE `service_location_token`=:service_location_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_location_token", $this->serviceLocationToken);
        $stmt->execute();
        return $stmt;
    }
    function featureCheck($feature){
        $query="SELECT `token`
        FROM `service__features`
        WHERE `service_location_token`=:token 
        AND `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":name", $feature);
        $stmt->bindParam(":token", $this->serviceLocationToken);
        $stmt->execute();
        return $stmt;
    }
    function addNewFeatures($feature,$featureToken,$gm_date_time){
        $query="INSERT INTO `service__features` SET `token`=:token,
        `service_location_token`=:service_location_token,
        `name`=:name,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $featureToken);
        $stmt->bindParam(":service_location_token", $this->serviceLocationToken);
        $stmt->bindParam(":name", $feature);
        $stmt->bindParam(":date_time", $gm_date_time);
        $stmt->execute();
        return $stmt;
    }
    function updateFeatures($feature){
        $query="UPDATE `service__features` SET 
        `status`='1'
        WHERE `service_location_token`=:service_location_token
        AND `name`=:name";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_location_token", $this->serviceLocationToken);
        $stmt->bindParam(":name", $feature);
        $stmt->execute();
        return $stmt;
    }
    function locationAirportTTRDetails(){
        $query="SELECT `airport__terminal_type_relation`.`airport_token`,
        `airport__terminal_type_relation`.`terminal_token`,
        `airport__terminal_type_relation`.`type_token`,
        `airport__terminal_type_relation`.`category_token`
        FROM `service__location`
        INNER JOIN `airport__terminal_type_relation` ON 
            `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        WHERE `service__location`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceLocationToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->airportToken  = $row["airport_token"];
        $obj->terminalToken = $row["terminal_token"];
        $obj->typeToken     = $row["type_token"];
        $obj->categoryToken = $row["category_token"];
        return $obj;
    }
    function airportTTRCheck(){
        $query="SELECT `token` FROM `airport__terminal_type_relation`
        WHERE `airport_token`=:airport_token
        AND `terminal_token`=:terminal_token
        AND `type_token`=:type_token
        AND `category_token`=:category_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_token", $this->existAirportToken);
        $stmt->bindParam(":terminal_token", $this->existTerminalToken);
        $stmt->bindParam(":type_token", $this->airportTypeToken);
        $stmt->bindParam(":category_token", $this->categoryToken);
        $stmt->execute();
        return $stmt;
    }
    function getAirportTTRToken($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["token"];
    }
    function createAirportTTRToken($gm_date_time){
        $query="INSERT INTO `airport__terminal_type_relation` SET 
        `token`=:token,
        `airport_token`=:airport_token,
        `terminal_token`=:terminal_token,
        `type_token`=:type_token,
        `category_token`=:category_token,
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->airportTTRToken);
        $stmt->bindParam(":airport_token", $this->existAirportToken);
        $stmt->bindParam(":terminal_token", $this->existTerminalToken);
        $stmt->bindParam(":type_token", $this->airportTypeToken);
        $stmt->bindParam(":category_token", $this->categoryToken);
        $stmt->bindParam(":date_time", $gm_date_time);
        $stmt->execute();
        return $stmt;
    }
    function updateServiceLocationDetails(){
        $query="UPDATE `service__location` SET
        `airport_ttr_token`=:airport_ttr_token,
        `price_adult`=:price_adult,
        `price_children`=:price_children,
        `additional_price_adult`=:additional_price_adult,
        `additional_price_children`=:additional_price_children
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":airport_ttr_token", $this->airportTTRToken);
        $stmt->bindParam(":price_adult", $this->costOfAdult);
        $stmt->bindParam(":price_children", $this->costOfChild);
        $stmt->bindParam(":additional_price_adult", $this->costOfAdultAdditional);
        $stmt->bindParam(":additional_price_children", $this->costOfChildAdditional);
        $stmt->bindParam(":token", $this->serviceLocationToken);
        $stmt->execute();
        return $stmt;
    }
    function deleteServiceLocation(){
        $query="UPDATE `service__location` SET
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceLocationToken);
        $stmt->execute();
        return $stmt;
    }
    function deleteService(){
        $query="UPDATE `service` SET
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceToken);
        $stmt->execute();
        return $stmt;
    }
    function getLocationAirpotToken(){
        $query="SELECT `airport_token` FROM `service__provider_company_location` WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["airport_token"];
    }
    function getServiceToken(){
        $query="SELECT `service_token` FROM `service__location` WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceLocationToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["service_token"];
    }
    function getServiceLocations(){
        $query="SELECT `token` FROM `service__location` WHERE `service_token`=:service_token AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_token", $this->serviceToken);
        $stmt->execute();
        return $stmt;
    }
}
?>