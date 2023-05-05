<?php
class onboard extends Database {
    // object properties
    public $name;
    public $siteName;
    //public $stmt;
    
    public function userCheck(){
        $query = "SELECT `service__distributor_employee`.`token`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE `service__distributor_employee`.`service_distributor_token`=:service_distributor_token
        AND `service__distributor_employee`.`token`=:token
        AND `service__distributor`.`is_business_info`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function editAgent_userCheck(){
        $query = "SELECT `service__distributor_employee`.`token`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE `service__distributor_employee`.`service_distributor_token`=:service_distributor_token
        AND `service__distributor_employee`.`token`=:token
        AND `service__distributor`.`is_business_info`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    
    public function siteNameCheck(){
        $query = "SELECT `token`
        FROM `service__distributor` 
        WHERE `site_name`=:site_name
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":site_name", $this->siteName);
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    public function distirbutorTypeCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_type` 
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distirbutorTypeToken);
        $stmt->execute();
        return $stmt;
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
    public function generateTokenNumeric($table,$column) {
        $str_result = '0123456789';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        $query= "SELECT id FROM $table WHERE `$column` = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $randstring);
        $stmt->execute();
        $num  = $stmt->rowCount();
        return ($num==0) ? $randstring : generateToken();
    }
    function getDistributorDetails(){
        $array = [];
        $query = "SELECT `name`,`service_distributor_type_token`,
                        `website_name`,`country_code`,
                        `primary_mobile_number`,
                        `alternate_country_code`,
                        `alternate_mobile_number`,
                        `primary_email`,`alternate_email`,
                        `address`,`country_id`,
                        `state_id`,`city_id`,
                        `pincode`,`account_number`,
                        `ifsc_code`,`branch`,
                        `city`,`pancard_number`,
                        `gst_number`,`pan_card`,
                        `gst_certificate`,
                        `msme_certificate`,
                        `incorporation_certificate`,
                        `voide_cheque`,
                        `contract_agreement`,
                        `other_document_one`,
                        `other_document_two`
         FROM `service__distributor` WHERE `token` = :service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->name  = $row['name'];
            $obj->service_distributor_type_token  = $row['service_distributor_type_token'];
            $obj->website_name  = $row['website_name'];
            $obj->country_code  = $row['country_code'];
            $obj->primary_mobile_number  = $row['primary_mobile_number'];
            $obj->alternate_country_code  = $row['alternate_country_code'];
            $obj->alternate_mobile_number  = $row['alternate_mobile_number'];
            $obj->primary_email  = $row['primary_email'];
            $obj->alternate_email  = $row['alternate_email'];
            $obj->address  = $row['address'];
            $obj->country_id  = $row['country_id'];
            $obj->state_id  = $row['state_id'];
            $obj->city_id  = $row['city_id'];
            $obj->pincode  = $row['pincode'];
            $obj->account_number  = $row['account_number'];
            $obj->ifsc_code  = $row['ifsc_code'];
            $obj->branch  = $row['branch'];
            $obj->city  = $row['city'];
            $obj->pancard_number  = $row['pancard_number'];
            $obj->gst_number  = $row['gst_number'];
            $obj->pan_card  = $row['pan_card'];
            $obj->gst_certificate  = $row['gst_certificate'];
            $obj->msme_certificate  = $row['msme_certificate'];
            $obj->incorporation_certificate  = $row['incorporation_certificate'];
            $obj->voide_cheque  = $row['voide_cheque'];
            $obj->contract_agreement  = $row['contract_agreement'];
            $obj->other_document_one  = $row['other_document_one'];
            $obj->other_document_two  = $row['other_document_two'];
            array_push($array, $obj);
        }
        return $array;
    }
    
    public function updateDistributor(){
        $query = "UPDATE `service__distributor` SET 
        `service_distributor_type_token`=:service_distributor_type_token,
        `name`=:name,
        `website_name`=:website_name,
        `is_business_info`='1',
        `date_time`=:date_time,
        `primary_email`=:primary_email,
        `country_code`=:country_code,
        `primary_mobile_number`=:primary_mobile_number,
        `alternate_email`=:alternate_email,
        `alternate_country_code`=:alternate_country_code,
        `alternate_mobile_number`=:alternate_mobile_number,
        `address`=:address,
        `country_id`=:country_id,
        `state_id`=:state_id,
        `city_id`=:city_id,
        `pincode`=:pincode,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `branch`=:branch,
        `city`=:city,
        `pan_card`=:pan_card,
        `gst_certificate`=:gst_certificate,
        `msme_certificate`=:msme_certificate,
        `incorporation_certificate`=:incorporation_certificate,
        `voide_cheque`=:voide_cheque,
        `contract_agreement`=:contract_agreement,
        `other_document_one`=:otherDocumentOne,
        `other_document_two`=:otherDocumentTwo,
        `pancard_number`=:panNumber,
        `gst_number`=:gstNumber
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_type_token", $this->distirbutorTypeToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":website_name", $this->siteName);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->bindParam(":primary_email", $this->primaryEmail);
        $stmt->bindParam(":country_code", $this->countryCode);
        $stmt->bindParam(":primary_mobile_number", $this->primaryMobileNumber);
        $stmt->bindParam(":alternate_email", $this->alternateEmail);
        $stmt->bindParam(":alternate_country_code", $this->alternateCountryCode);
        $stmt->bindParam(":alternate_mobile_number", $this->alternateMobileNumber);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->bindParam(":state_id", $this->stateId);
        $stmt->bindParam(":city_id", $this->cityId);
        $stmt->bindParam(":pincode", $this->pincode);
        $stmt->bindParam(":account_number", $this->accountNumber);
        $stmt->bindParam(":ifsc_code", $this->ifscCode);
        $stmt->bindParam(":branch", $this->branch);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":pan_card", $this->panCard);
        $stmt->bindParam(":gst_certificate", $this->gstCertificate);
        $stmt->bindParam(":msme_certificate", $this->msmeCertificate);
        $stmt->bindParam(":incorporation_certificate", $this->incorporationCertificate);
        $stmt->bindParam(":voide_cheque", $this->voideCheque);
        $stmt->bindParam(":contract_agreement", $this->contractAgreement);
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->bindParam(":otherDocumentOne", $this->otherDocumentOne);
        $stmt->bindParam(":otherDocumentTwo", $this->otherDocumentTwo);
        $stmt->bindParam(":gstNumber", $this->gstNumber);
        $stmt->bindParam(":panNumber", $this->panNumber);
        $stmt->execute();
        return $stmt;
    }
    function addDistributorAirports(){
        $distributorAirports = $this->distributorAirports;
        foreach($distributorAirports as $value){
//            $businessTypeToken = $value->businessTypeToken;
//            $airportTokenArray = $value->airportToken;
//            foreach($airportTokenArray as $airportToken){
//                $serviceDistributorAirportToken = $this->generateToken('service__distributor_airport','token');
//                $query = "INSERT INTO `service__distributor_airport` SET
//                `token`=:token,
//                `service_distributor_token`=:service_distributor_token,
//                `business_type_token`=:business_type_token,
//                `airport_token`=:airport_token,
//                `created_date`=:created_date,
//                `status`='1'";
//                $stmt = $this->conn->prepare( $query );
//                $stmt->bindParam(":token", $serviceDistributorAirportToken);
//                $stmt->bindParam(":service_distributor_token", $this->distributorToken);
//                $stmt->bindParam(":business_type_token", $businessTypeToken);
//                $stmt->bindParam(":airport_token", $airportToken);
//                $stmt->bindParam(":created_date", $this->gmDateTime);
//                ////$stmt->execute();
//            }
        }
    }
    function addDistributorBusinessType(){
        $businessTypeTokens = $this->businessTypeTokens;
        foreach($businessTypeTokens as $value){
            $query = "INSERT INTO `service__distributor_business` SET 
            `service_distributor_token`=:service_distributor_token,
            `business_type_token`=:business_type_token,
            `created_date`=:created_date,
            `is_active`='1'";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":service_distributor_token", $this->distributorToken);
            $stmt->bindParam(":business_type_token", $value);
            $stmt->bindParam(":created_date", $this->gmDateTime);
            $stmt->execute();
        }
    }
    function addDistributorAirportsNew(){
        $airportTokens = $this->airportTokens;
        foreach($airportTokens as $value){
            $serviceDistributorAirportToken = $this->generateToken('service__distributor_airport','token');
            $query = "INSERT INTO `service__distributor_airport` SET 
            `token`=:token,
            `service_distributor_token`=:service_distributor_token,
            `airport_token`=:airport_token,
            `created_date`=:created_date,
            `status`='1'"; 
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":token", $serviceDistributorAirportToken);
            $stmt->bindParam(":service_distributor_token", $this->distributorToken);
            $stmt->bindParam(":airport_token", $value);
            $stmt->bindParam(":created_date", $this->gmDateTime);
            $stmt->execute();
        }
    }
    function addDistributorRole(){
        $query = "INSERT INTO `service__distributor_user_role` SET `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`='Super Admin',
        `created_date`=:created_date,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->roleToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":created_date", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addDistributorRoleModules(){
        $array = [];
        $query = "SELECT `token` FROM `service__distributor_modules` WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $moduleToken =  $row['token'];
            $array[] = "(
                '$this->roleToken',
                '$moduleToken',
                '$this->gmDateTime',
                '1'
            )";
        }
        $query1 = "INSERT INTO `service__distributor_user_role_modules`(`role_token`,
        `module_token`,
        `created_date`, 
        `status`) VALUES".implode(", ", $array);    
        $stmt1 = $this->conn->prepare( $query1 ); 
        $stmt1->execute();
        return $query1;
    }
    function addEmployee(){
        $query = "INSERT INTO  `service__distributor_employee` SET `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`=:name,
        `email`=:email,
        `business_id`=:business_id,
        `password`=:password,
        `user_role_token`=:user_role_token,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->employeToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":business_id", $this->businessId);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":user_role_token", $this->roleToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function distributorTypes(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `service__distributor_type` WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token = $row['token'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    
    function countries(){
        $array = [];
        $query = "SELECT `id`,`name`,`code` FROM `countries`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId   = $row['id'];
            $obj->countryName = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function regions(){
        $array = [];
        $query = "SELECT `id`,
        `country_id`, 
        `name` 
        FROM `regions` 
        WHERE `name`!='' 
        AND country_id=:country_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId = $row['country_id'];
            $obj->stateId   = $row['id'];
            $obj->stateName = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function cities(){
        $array = [];
        $query = "SELECT `id`,
        `region_id`,
        `country_id`,
        `name` 
        FROM `cities` 
        WHERE `name`!=''
        AND `country_id`=:country_id
        AND `region_id`=:region_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->bindParam(":region_id", $this->stateId);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->countryId = $row['country_id'];
            $obj->stateId   = $row['region_id'];
            $obj->cityId    = $row['id'];
            $obj->cityName  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function serviceLocations(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `business_type`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $businessTypeToken = $row['token'];
            $obj->token = $businessTypeToken;
            $obj->name  = $row['name'];
            $airportArray = [];
            $query1 = "SELECT `airport`.`token`,
            `airport`.`name`, 
            `airport`.`code` 
            FROM `service__provider_company_location` 
            INNER JOIN `airport` ON `airport`.`token`=`service__provider_company_location`.`airport_token` 
            INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`service__provider_company_location`.`company_token` 
            WHERE `service__provider_company`.`business_type_token`=:business_type_token 
            GROUP BY `airport`.`token`";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->bindParam(":business_type_token", $businessTypeToken);
            $stmt1->execute();
            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
                $obj1 = new stdClass;
                $obj1->airportToken = $row1['token'];
                $obj1->airportName  = $row1['name'];
                $obj1->airportCode  = $row1['code'];
                array_push($airportArray, $obj1);
            }
            $obj->airports  = $airportArray;
            
            array_push($array, $obj);
        }
        return $array;
    }
    function bussinessTypeList(){
        $array = [];
        $query = "SELECT `token`,`name` FROM `business_type` WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token = $row['token'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function getbussinessTypeList(){
        $array = [];
        $query = "SELECT `business_type_token` FROM `service__distributor_business` WHERE `service_distributor_token` = :service_distributor_token AND `is_active`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->token = $row['business_type_token'];
            array_push($array, $row['business_type_token']);
        }
        return $array;
    }
    function airportsList(){
        $array = [];
        $query = "SELECT `airport`.`token`,
        `airport`.`name`, 
        `airport`.`code`,
        COALESCE(`service__provider_company`.`business_type_token`,'') AS `business_type_token`
        FROM `airport` 
        LEFT JOIN `service__provider_company_location` ON 
            `airport`.`token`=`service__provider_company_location`.`airport_token` 
        LEFT JOIN `service__provider_company` ON 
            `service__provider_company`.`token`=`service__provider_company_location`.`company_token` 
        WHERE `airport`.`status` = '1'
        GROUP BY `airport`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportToken = $row['token'];
            $obj->airportName  = $row['name'];
            $obj->airportCode  = $row['code'];
            $obj->businessTypeToken  = $row['business_type_token'];
            array_push($array, $obj);
        }
        return $array;
    }
    function get_airportsList(){
        $array = [];
        $query = "SELECT `airport`.`token`,
                `airport`.`name`, 
                `airport`.`code`,
                COALESCE(`service__provider_company`.`business_type_token`,'') AS `business_type_token`
                FROM `airport`
                INNER JOIN `service__distributor_airport` ON `service__distributor_airport`.`airport_token` = `airport`.`token` AND `service__distributor_airport`.`status`='1'
                LEFT JOIN `service__provider_company_location` ON 
                    `airport`.`token`=`service__provider_company_location`.`airport_token` 
                LEFT JOIN `service__provider_company` ON 
                    `service__provider_company`.`token`=`service__provider_company_location`.`company_token` 
                WHERE `airport`.`status` = '1' AND `service__distributor_airport`.`service_distributor_token`=:service_distributor_token
                GROUP BY `airport`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportToken = $row['token'];
            $obj->airportName  = $row['name'];
            $obj->airportCode  = $row['code'];
            $obj->businessTypeToken  = $row['business_type_token'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function updateUserCheck(){
        $query = "SELECT `service__distributor_employee`.`token`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE `service__distributor_employee`.`service_distributor_token`=:service_distributor_token
        AND `service__distributor_employee`.`token`=:token
        AND `service__distributor`.`is_business_info`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }

    public function updateDistributorBusinessType(){
        $query="UPDATE `service__distributor_business` SET
        `is_active`='2'
        WHERE `service_distributor_token`=:distributorToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        $array = $this->businessTypeTokens;
        foreach ($array as $businessTypeTokensValue) {
            if($this->distributorBusinessTypeCheck($businessTypeTokensValue)){
                $this->insertDistributorBusinessType($businessTypeTokensValue);
            }else{
                $this->updateDistributorBusiness($businessTypeTokensValue);
            }
        }
    }

    public function distributorBusinessTypeCheck($businessTypeTokensValue){
        $query="SELECT `id` 
        FROM `service__distributor_business`
        WHERE `service_distributor_token`=:distributorToken
        AND `business_type_token`='$businessTypeTokensValue'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }

    public function insertDistributorBusinessType($businessTypeTokensValue){
        $query = "INSERT INTO `service__distributor_business` SET 
        `service_distributor_token`=:service_distributor_token,
        `business_type_token`=:business_type_token,
        `created_date`=:created_date,
        `is_active`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":business_type_token", $businessTypeTokensValue);
        $stmt->bindParam(":created_date", $this->gmDateTime);
        $stmt->execute();
    }

    public function updateDistributorBusiness($businessTypeTokensValue){
        $query="UPDATE `service__distributor_business` SET
        `is_active`='1'
        WHERE `service_distributor_token`=:distributorToken
        AND `business_type_token`='$businessTypeTokensValue'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
    }

    //airport
    public function updateDistributorAirportsNew(){
        $query="UPDATE `service__distributor_airport` SET
        `status`='2'
        WHERE `service_distributor_token`=:distributorToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        $airportTokens = $this->airportTokens;
        foreach($airportTokens as $value){
            if($this->distributorAirportsNewCheck($value)){
                $this->insertDistributorAirportsNew($value);
            }else{
                $this->updateDistributorAirports($value);
            }
        }
    }

    public function distributorAirportsNewCheck($airportToken){
        $query="SELECT `id` 
        FROM `service__distributor_airport`
        WHERE `service_distributor_token`=:distributorToken
        AND `airport_token`='$airportToken'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }

    public function insertDistributorAirportsNew($airportToken){
        $serviceDistributorAirportToken = $this->generateToken('service__distributor_airport','token');
        $query = "INSERT INTO `service__distributor_airport` SET 
        `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `airport_token`=:airport_token,
        `created_date`=:created_date,
        `status`='1'"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $serviceDistributorAirportToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":airport_token", $airportToken);
        $stmt->bindParam(":created_date", $this->gmDateTime);
        $stmt->execute();
    }

    public function updateDistributorAirports($airportToken){
        $query="UPDATE `service__distributor_airport` SET
        `status`='1'
        WHERE `service_distributor_token`=:distributorToken
        AND `airport_token`='$airportToken'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
    } 
}
?>