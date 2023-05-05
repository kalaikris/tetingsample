<?php
class ServiceProvider extends Database{
    function adminCheck(){
        $query = "SELECT 
        `is_admin`
        FROM `service__provider_company_location_staffs` 
        WHERE `token`=?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['is_admin'];
    }
    function checkIsValidCredentials(){
        $query = "SELECT 
        `staffs`.`token` AS `staff_token`,
        `staffs`.`image`,
        `staffs`.`service_provider_company_location_token` AS `service_provider_token`,
        `staffs`.`name`, 
        `staffs`.`user_role_token`,
        `staffs`.`is_admin`,
        COALESCE(`provider`.`status`,'') AS `provider_status`,
        COALESCE(`company_provider`.`status`,'') AS `status`
        FROM `service__provider_company_location_staffs` AS `staffs`
        LEFT JOIN `service__provider` AS `provider` ON (
           `provider`.`token`=`staffs`.`service_provider_company_location_token`
           AND `staffs`.`is_admin`='1'
        )
        LEFT JOIN `service__provider_company_location` AS `location` ON (
        `location`.`token`=`staffs`.`service_provider_company_location_token`
            AND `staffs`.`is_admin`='0'
        )
        LEFT JOIN `service__provider_company` ON
        	`service__provider_company`.`token`=`location`.`company_token`
        LEFT JOIN `service__provider` AS `company_provider` ON
        	`company_provider`.`token`=`service__provider_company`.`service_provider_token`
        WHERE `staffs`.`business_id`=?
        AND `staffs`.`password`=?
        AND ( `provider`.`status`='0' OR `company_provider`.`status`='0' ) ";    
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->business_id);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        return $stmt;
    }
    
    function readIsAdmin($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        if($row["is_admin"] == 1){
          $obj->service_provider_company_token = $row["service_provider_token"];  
        }else{
          $obj->service_provider_location_token = $row["service_provider_token"]; 
        }
        $obj->is_admin = $row["is_admin"];
        $obj->user_role_token = $row["user_role_token"];
        $obj->name  = $row["name"];
        $obj->image = $row["image"];
        $obj->staff_token = $row["staff_token"];
        return $obj;
    }
    
    function checkServiceProviderStatus($service_provider_token){
        $query ="SELECT
        `token`,
        `status`
        FROM
            `service__provider_company`
        WHERE
        `service_provider_token` = '$service_provider_token'
        AND `status`!=3
        AND `status`!=4
        AND `status`!=5
        GROUP BY `status`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    } 
    function checkProceedForReview(){
        $query ="SELECT `token`
        FROM `service__provider_company`
        WHERE `service_provider_token` = :service_provider_token
        AND `status`=0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('service_provider_token', $this->service_provider_token);
        $stmt->execute();
        return $stmt;
    } 
    function checkApproved(){
        $query ="SELECT `token`
        FROM `service__provider_company`
        WHERE `service_provider_token` = :service_provider_token
        AND `status`=2";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('service_provider_token', $this->service_provider_token);
        $stmt->execute();
        return $stmt;
    }
    function readServiceProviderStatus($stmth){
         $row = $stmth->fetch(PDO::FETCH_ASSOC); 
         $status = $row['status'];
         return $status;
    }
    
    function checkBusinessId(){
        $query = "SELECT
            `token`,
            `name`,
            `business_id`
        FROM
            `service__provider_company_location_staffs`
        WHERE
            `business_id`=?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->business_id);
        $stmt->execute();
        return $stmt;
    }
    
    function checkIsServiceProviderExists(){
        $query = "SELECT `token`, `name` 
        FROM `service__provider_company_location_staffs` 
        WHERE `service_provider_company_location_token`=? AND `is_admin`=1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->service_provider_token);
        $stmt->execute();
        return $stmt;
    }
    
    function getBusinessType(){
        $query = "SELECT `token`, `name` FROM `business_type` WHERE status='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $business_type = [];
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $obj = new stdClass;
                $obj->business_type_token = $row['token'];
                $obj->business_name = $row['name'];
                array_push($business_type, $obj);
            }
        return $business_type;
    }
    
    function getCityList(){
      $query1 = "SELECT `id`, `name` FROM `cities` WHERE `name` != 'NULL' ORDER BY `id` LIMIT 41000";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
        $city = [];
             while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $obj1 = new stdClass;
                $obj1->city_id = $row1['id'];
                $obj1->city_name = addslashes($row1['name']);
                array_push($city, $obj1);
            }
        return $city;
    }
    
    function getRegionsList(){
      $query2 = "SELECT `id`, `name`  FROM `regions` WHERE `name` !='' ORDER BY `id`";
        $stmt2 = $this->conn->prepare( $query2 );
        $stmt2->execute();
        $regions = [];
             while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $obj2 = new stdClass;
                $obj2->region_id = $row2['id'];
                $obj2->region_name = $row2['name'];
                array_push($regions, $obj2);
            }
        return $regions;
    }
    
    function getCountriesList(){
      $query3 = "SELECT `id`, `name` FROM `countries` ORDER BY `id`";
        $stmt3 = $this->conn->prepare( $query3 );
        $stmt3->execute();
        $country = [];
             while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $obj3 = new stdClass;
                $obj3->country_id = $row3['id'];
                $obj3->country_name = $row3['name'];
                array_push($country, $obj3);
            }
        return $country;
    }
    
    function getAirportList(){
      $query4 = "SELECT `token`, `name` FROM `airport` ORDER BY `id`";
        $stmt4 = $this->conn->prepare( $query4 );
        $stmt4->execute();
        $airport = [];
             while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                $obj4 = new stdClass;
                $obj4->airport_token = $row4['token'];
                $obj4->airport_name = $row4['name'];
                array_push($airport, $obj4);
            }
        return $airport;
    }
    
    function tokenGenerate($table_name,$column_name){
        $random = rand(1000000000,9999999999);
        $val=true;
        do{
            $query = "SELECT `$column_name` FROM `$table_name`  WHERE `$column_name`='$random'";
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            
            $count = $stmt->rowCount();
            if($count==0){
                $val = false;
            }else{
                $random = rand(1000000000,9999999999);
            }
        }while($val);
        return $random;
    }
    
    function addBusinessInfo($gm_date_time){
         $query = "INSERT INTO `service__provider_company` SET
        `token`=:company_token,
        `service_provider_token`=:service_provider_token,
        `business_type_token`=:business_type,
        `name`=:name,
        `logo`=:logo,
        `image`=:image,
        `website_name`=:website_name,
        `business_email`=:business_email,
        `business_country_code`=:business_country_code,
        `business_mobile_number`=:business_mobile_number,
        `year_inception`=:year_inception,
        `primary_title`=:primary_title,
        `primary_name`=:primary_name,
        `primary_email`=:primary_email,
        `primary_country_code`=:primary_country_code,
        `primary_mobile_number`=:primary_mobile_number,
        `designation`=:designation,
        `alternate_email_id`=:alternate_email_id,
        `alternate_country_code`=:alternate_country_code,
        `alternate_mobile_number`=:alternate_mobile_number,
        `address`=:address,
        `country_id`=:country_id,
        `state_id`=:state_id,
        `city_id`=:city_id,
        `pin_code`=:pin_code,
        `total_service_location`=:total_service_location,
        `date_time`='$gm_date_time',
        `status`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('company_token', $this->company_token);
        $stmt->bindParam('service_provider_token', $this->service_provider_token);
        $stmt->bindParam('business_type', $this->business_type);
        $stmt->bindParam('name', $this->business_name);
        $stmt->bindParam('logo', $this->company_logo);
        $stmt->bindParam('image', $this->company_image);
        $stmt->bindParam('website_name', $this->business_website);
        $stmt->bindParam('business_email', $this->business_emailId);
        $stmt->bindParam('business_country_code', $this->business_country_code);
        $stmt->bindParam('business_mobile_number', $this->business_mobile_no);
        $stmt->bindParam('year_inception', $this->year_inception);
        $stmt->bindParam('primary_title', $this->primary_contact_title);
        $stmt->bindParam('primary_name', $this->primary_contact_name);
        $stmt->bindParam('primary_email', $this->primary_emailId);
        $stmt->bindParam('primary_country_code', $this->primary_country_code);
        $stmt->bindParam('primary_mobile_number', $this->primary_mobile_number);
        $stmt->bindParam('designation', $this->designation);
        $stmt->bindParam('alternate_email_id', $this->alternate_emailId);
        $stmt->bindParam('alternate_country_code', $this->alternate_country_code);
        $stmt->bindParam('alternate_mobile_number', $this->alternate_mobile_number);
        $stmt->bindParam('address', $this->address);
        $stmt->bindParam('country_id', $this->country_id);
        $stmt->bindParam('state_id', $this->state_id);
        $stmt->bindParam('city_id', $this->city_id);
        $stmt->bindParam('pin_code', $this->pincode);
        $stmt->bindParam('total_service_location', $this->total_service_location);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function updateBusinessInfo(){
         $query = "UPDATE `service__provider_company` SET
        `business_type_token`=:business_type,
        `name`=:name,
        `logo`=:logo,
        `image`=:image,
        `website_name`=:website_name,
        `business_email`=:business_email,
        `business_country_code`=:business_country_code,
        `business_mobile_number`=:business_mobile_number,
        `year_inception`=:year_inception,
        `primary_title`=:primary_title,
        `primary_name`=:primary_name,
        `primary_email`=:primary_email,
        `primary_country_code`=:primary_country_code,
        `primary_mobile_number`=:primary_mobile_number,
        `designation`=:designation,
        `alternate_email_id`=:alternate_email_id,
        `alternate_country_code`=:alternate_country_code,
        `alternate_mobile_number`=:alternate_mobile_number,
        `address`=:address,
        `country_id`=:country_id,
        `state_id`=:state_id,
        `city_id`=:city_id,
        `pin_code`=:pin_code,
        `total_service_location`=:total_service_location
        WHERE `token`=:company_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('business_type', $this->business_type);
        $stmt->bindParam('name', $this->business_name);
        $stmt->bindParam('logo', $this->company_logo);
        $stmt->bindParam('image', $this->company_image);
        $stmt->bindParam('website_name', $this->business_website);
        $stmt->bindParam('business_email', $this->business_emailId);
        $stmt->bindParam('business_country_code', $this->business_country_code);
        $stmt->bindParam('business_mobile_number', $this->business_mobile_no);
        $stmt->bindParam('year_inception', $this->year_inception);
        $stmt->bindParam('primary_title', $this->primary_contact_title);
        $stmt->bindParam('primary_name', $this->primary_contact_name);
        $stmt->bindParam('primary_email', $this->primary_emailId);
        $stmt->bindParam('primary_country_code', $this->primary_country_code);
        $stmt->bindParam('primary_mobile_number', $this->primary_mobile_number);
        $stmt->bindParam('designation', $this->designation);
        $stmt->bindParam('alternate_email_id', $this->alternate_emailId);
        $stmt->bindParam('alternate_country_code', $this->alternate_country_code);
        $stmt->bindParam('alternate_mobile_number', $this->alternate_mobile_number);
        $stmt->bindParam('address', $this->address);
        $stmt->bindParam('country_id', $this->country_id);
        $stmt->bindParam('state_id', $this->state_id);
        $stmt->bindParam('city_id', $this->city_id);
        $stmt->bindParam('pin_code', $this->pincode);
        $stmt->bindParam('total_service_location', $this->total_service_location);
        $stmt->bindParam('company_token', $this->company_token);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    function businessList(){
        $isAdmin = $this->isAdmin;
        $seachQuery = "";
        if($isAdmin==1){
            $seachQuery = "`service__provider_company`.`service_provider_token` =?";
        }else{
            $seachQuery = "`service__provider_company_location`.`token` =?";
        }
        $query1 = "SELECT
        `service__provider_company`.`logo`,
        `service__provider_company`.`name` AS `company_name`,
        `service__provider_company`.`website_name`,
        `business_type`.`name` AS `business_type_name`,
        `service__provider_company`.`total_service_location`,
        `service__provider_company`.`token`,
        `service__provider_company`.`status` AS companystatus
        FROM
        `service__provider_company`
        LEFT JOIN `business_type` ON `service__provider_company`.`business_type_token`=`business_type`.`token`
        LEFT JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
        WHERE `service__provider_company`.`status` != '4' AND 
        $seachQuery
        GROUP BY `service__provider_company`.`token` ORDER BY `service__provider_company`.`status` DESC";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(1, $this->service_token);
        $stmt->execute();
        return $stmt;
    }
    function readBusinessList($stmt){
        $businessList = [];
        while($row1 = $stmt->fetch(PDO::FETCH_ASSOC)){
          $obj =  new stdClass();
          $obj->company_logo = $row1["logo"];
          $obj->company_name = $row1["company_name"];
          $obj->website_name = $row1["website_name"];
          $obj->business_type = $row1["business_type_name"];
          $obj->total_service_location = $row1["total_service_location"];
          $obj->service_provider_companytoken = $row1["token"];
          $obj->service_provider_companystatus = $row1["companystatus"];
            array_push($businessList, $obj);
        }
        return $businessList;
    }
    
    function service_provider_company_location($gm_date_time){
        $query21 = "INSERT INTO `service__provider_company_location` SET
        `token`=:token,
        `company_token`=:company_token,
        `airport_token`=:airport_token,
        `email_id`=:email_id,
        `pan_certificate`=:pan_certificate,
        `gst_certificate`=:gst_certificate,
        `msme_certificate`=:msme_certificate,
        `incorporation_certificate`=:incorporation_certificate,
        `voide_check`=:voide_check,
        `agreement`=:agreement,
        `other_document_one`=:other_document1,
        `other_document_two`=:other_document2,
        `gst_number`=:gst_number,
        `pancard_number`=:pan_number,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `branch`=:branch,
        `city`=:city,
        `date_time`='$gm_date_time'";
        $stmt21 = $this->conn->prepare( $query21 );
        $stmt21->bindParam('token', $this->token);
        $stmt21->bindParam('company_token', $this->company_token);
        $stmt21->bindParam('airport_token', $this->airport_token);
        $stmt21->bindParam('email_id', $this->locationemailaddress);
        $stmt21->bindParam('gst_certificate', $this->gst_certificate);
        $stmt21->bindParam('msme_certificate', $this->msme_certificate);
        $stmt21->bindParam('incorporation_certificate', $this->certificate_incorporation);
        $stmt21->bindParam('voide_check', $this->voice_cheque);
        $stmt21->bindParam('agreement', $this->certificate_agreement);
        $stmt21->bindParam('other_document2', $this->other_document2);
        $stmt21->bindParam('other_document1', $this->other_document1);
        $stmt21->bindParam('pan_number', $this->pan_number);
        $stmt21->bindParam('gst_number', $this->gst_number);
        $stmt21->bindParam('account_number', $this->account_number);
        $stmt21->bindParam('ifsc_code', $this->ifsc_code);
        $stmt21->bindParam('branch', $this->branch_name);
        $stmt21->bindParam('city', $this->cityname);
        $stmt21->bindParam('pan_certificate', $this->pan_certificate);
        if($stmt21->execute()){
            return true;
        }else{
            return false;    
        }
    }
    function update_service_provider_company_location(){
        $query21 = "UPDATE `service__provider_company_location` SET
        `airport_token`=:airport_token,
        `email_id`=:email_id,
        `gst_certificate`=:gst_certificate,
        `msme_certificate`=:msme_certificate,
        `incorporation_certificate`=:incorporation_certificate,
        `voide_check`=:voide_check,
        `agreement`=:agreement,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `branch`=:branch,
        `city`=:city
        WHERE `token`=:token
        AND `company_token`=:company_token";
        $stmt21 = $this->conn->prepare( $query21 );
        $stmt21->bindParam('airport_token', $this->airport_token);
        $stmt21->bindParam('email_id', $this->locationemailaddress);
        $stmt21->bindParam('gst_certificate', $this->gst_certificate);
        $stmt21->bindParam('msme_certificate', $this->msme_certificate);
        $stmt21->bindParam('incorporation_certificate', $this->certificate_incorporation);
        $stmt21->bindParam('voide_check', $this->voice_cheque);
        $stmt21->bindParam('agreement', $this->certificate_agreement);
        $stmt21->bindParam('account_number', $this->account_number);
        $stmt21->bindParam('ifsc_code', $this->ifsc_code);
        $stmt21->bindParam('branch', $this->branch_name);
        $stmt21->bindParam('city', $this->cityname);
        $stmt21->bindParam('token', $this->token);
        $stmt21->bindParam('company_token', $this->company_token);
        if($stmt21->execute()){
            return true;
        }else{
            return false;    
        }
    }
    function deleteServiceProviderCompany(){
        $query = "UPDATE `service__provider_company`
        SET `status`='4' 
        WHERE `token`=?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->service_providercompanytoken);
        if($stmt->execute()){
            return true;
        }else{
           return false; 
        }  
    }
    function updateCompanyStatus(){
        $query1 = "UPDATE `service__provider_company` SET `status`='1' WHERE `token`=? AND `status`='0'";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(1, $this->uniquecompanytoken);
        if($stmt1->execute()){
            return true;
        }else{
           return false; 
        }  
    }
    function locationStaffs(){
        $query = "SELECT `staff`.`token`,
        `staff`.`name`,
        `staff`.`staff_id`,
        `staff`.`business_id`,
        `staff`.`is_available`
        FROM `service__provider_company_location_staffs` AS `staff`
        INNER JOIN `service__provider_company_location_user_role` AS `user_role` ON `user_role`.`token`=`staff`.`user_role_token`
        WHERE 1
        AND `staff`.`status` = '1' AND `staff`.`is_available`='0'
        AND `staff`.`service_provider_company_location_token`=?";
        //`user_role`.`is_mobile_app`='0'
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->serviceProviderCompanyLocationToken);
        $stmt->execute(); 
        return $stmt;
    }
    function locationStaffsView($stmt){
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token      = $row["token"];
            $obj->name       = $row["name"];
            $obj->staffId    = $row["staff_id"];
            $obj->businessId = $row["business_id"];
            $obj->isAvailable= $row["is_available"];
            array_push($array, $obj);
        }
        return $array;
    }
    function getBussinessInfo(){
        $query = "SELECT `service__provider_company`.`token`,
        `service__provider_company`.`business_type_token`,
        `service__provider_company`.`business_id`,
        `service__provider_company`.`name`,
        `service__provider_company`.`logo`,
        `service__provider_company`.`image`,
        `service__provider_company`.`website_name`,
        `service__provider_company`.`business_email`,
        `service__provider_company`.`business_country_code`,
        `service__provider_company`.`business_mobile_number`,
        `service__provider_company`.`year_inception`,
        `service__provider_company`.`primary_title`,
        `service__provider_company`.`primary_name`,
        `service__provider_company`.`primary_country_code`,
        `service__provider_company`.`primary_mobile_number`,
        `service__provider_company`.`primary_email`,
        `service__provider_company`.`designation`,
        `service__provider_company`.`alternate_email_id`,
        `service__provider_company`.`alternate_country_code`,
        `service__provider_company`.`alternate_mobile_number`,
        `service__provider_company`.`address`,
        `service__provider_company`.`country_id`,
        `service__provider_company`.`state_id`,
        `service__provider_company`.`city_id`,
        `service__provider_company`.`pin_code`
        FROM `service__provider_company` 
        WHERE `service__provider_company`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->companyToken);
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj =  new stdClass();
        $obj->companyToken      = $row["token"];
        $obj->businessTypeToken = $row["business_type_token"];
        $obj->businessId        = $row["business_id"];
        $obj->companyName       = $row["name"];
        $obj->companyLogo       = $row["logo"];
        $obj->companyImage      = $row["image"];
        $obj->businessWebsite   = $row["website_name"];
        $obj->businessEmail     = $row["business_email"];
        $obj->countryCode       = $row["business_country_code"];
        $obj->businessMobile    = $row["business_mobile_number"];
        $obj->yearOfInception   = $row["year_inception"];
        $obj->contactedPerson   = $row["primary_title"];
        $obj->primaryContactName= $row["primary_name"];
        $obj->primaryMobileCode = $row["primary_country_code"];
        $obj->primaryMobileNumber    = $row["primary_mobile_number"];
        $obj->primaryEmail    = $row["primary_email"];
        $obj->designation            = $row["designation"];
        $obj->alternativeEmailAddress= $row["alternate_email_id"];
        $obj->alternativeMobileCode  = $row["alternate_country_code"];
        $obj->alternativeMobile      = $row["alternate_mobile_number"];
        $obj->addressdetails    = $row["address"];
        $obj->countryId         = $row["country_id"];
        $obj->stateId           = $row["state_id"];
        $obj->cityId            = $row["city_id"];
        $obj->pincodeDetails    = $row["pin_code"];
        $obj->serviceLocations  = $this->getLocationDetails();
        return $obj;
    }
    function getLocationDetails(){
        $query = "SELECT `token`,
        `company_token`,
        `airport_token`,
        `email_id`,
        `gst_certificate`,
        `msme_certificate`,
        `incorporation_certificate`,
        `voide_check`,
        `agreement`,
        `account_number`,
        `ifsc_code`,
        `branch`,
        `city`,
        `pancard_number`,
        `gst_number`,
        `pan_certificate`,
        `other_document_one`,
        `other_document_two`
        FROM `service__provider_company_location` 
        WHERE `company_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->companyToken);
        $stmt->execute(); 
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj =  new stdClass();
            $obj->locationToken  = $row["token"];
            $obj->companyToken   = $row["company_token"];
            $obj->airportToken   = $row["airport_token"];
            $obj->emailId        = $row["email_id"];
            $obj->gstCertificate = $row["gst_certificate"];
            $obj->msmeCertificate= $row["msme_certificate"];
            $obj->incorporationCertificate= $row["incorporation_certificate"];
            $obj->voideCheck     = $row["voide_check"];
            $obj->agreement      = $row["agreement"];
            $obj->accountNumber  = $row["account_number"];
            $obj->ifscCode       = $row["ifsc_code"];
            $obj->branch         = $row["branch"];
            $obj->city           = $row["city"];
            $obj->pancard_number       = $row["pancard_number"];
            $obj->gst_number           = $row["gst_number"];
            $obj->pan_certificate      = $row["pan_certificate"];
            $obj->other_document_one   = $row["other_document_one"];
            $obj->other_document_two   = $row["other_document_two"];
            array_push($array, $obj);
        }
        return $array;
    }
    function getLastCompanyToken(){
        $query = "SELECT `token` 
        FROM `service__provider_company`
        WHERE `service_provider_token`=:token
        ORDER BY `id` DESC
        LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->providerToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["token"];
    }
    function userBusinessIdCheck(){
        $query = "SELECT `business_id`, `name`, `email` FROM `service__provider_company_location_staffs` 
        WHERE `business_id`=:businessId 
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('businessId', $this->businessId);
        $stmt->execute();
        return $stmt;
    }
    function viewUserBusinessIdCheck($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->business_id = $row["business_id"];
        $obj->name = $row["name"];
        $obj->email_id = $row["email"];
        return $obj;
    }
    function updateOtp(){
        $updateOtpQuery = "UPDATE `service__provider_company_location_staffs` SET `otp`=:otp WHERE `business_id`=:businessId AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('otp', $this->otp);
        $updateStmt->bindParam('businessId', $this->businessId);
        $updateStmt->execute();
        return $updateStmt;
    }
    function verifyOtp(){
        $verifyOtp = "SELECT `token` FROM `service__provider_company_location_staffs` WHERE `otp`=:otp AND `business_id`=:businessId AND `status`='1'";
        $verifyStmt = $this->conn->prepare( $verifyOtp );
        $verifyStmt->bindParam('otp', $this->otp);
        $verifyStmt->bindParam('businessId', $this->businessId);
        $verifyStmt->execute();
        return $verifyStmt;
    }
    function updateProviderPassword(){
        $updateOtpQuery = "UPDATE `service__provider_company_location_staffs` SET `password`=:newPassword WHERE `business_id`=:businessId AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('newPassword', $this->newPassword);
        $updateStmt->bindParam('businessId', $this->businessId);
        if($updateStmt->execute()){
           return true; 
        }else{
           return false; 
        }
    }
    function userCheck(){
        $checkQuery = "SELECT `token` FROM `service__provider_company_location_staffs` WHERE `service_provider_company_location_token`=:token AND `status`='1'";
        $checkStmt = $this->conn->prepare( $checkQuery );
        $checkStmt->bindParam('token', $this->token);
        $checkStmt->execute();
        return $checkStmt; 
    }
    function checkCurrentPassword(){
        $checkCurQuery = "SELECT `token` FROM `service__provider_company_location_staffs` WHERE `service_provider_company_location_token`=:token AND `password`=:currentPassword AND `status`='1'";
        $checkCurStmt = $this->conn->prepare( $checkCurQuery );
        $checkCurStmt->bindParam('token', $this->token);
        $checkCurStmt->bindParam('currentPassword', $this->currentPassword);
        $checkCurStmt->execute();
        return $checkCurStmt; 
    }
    function updateProviderNewPassword(){
        $updateOtpQuery = "UPDATE `service__provider_company_location_staffs` SET `password`=:newPassword WHERE `service_provider_company_location_token`=:token AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('newPassword', $this->newPassword);
        $updateStmt->bindParam('token', $this->token);
        if($updateStmt->execute()){
           return true; 
        }else{
           return false; 
        }
    }
    function update_service_provider_location(){
        $query21 = "UPDATE `service__provider_company_location` SET
        `email_id`=:email_id,
        `pancard_number`=:pan_number,
        `gst_number`=:gst_number,
        `pan_certificate`=:pan_certificate,
        `gst_certificate`=:gst_certificate,
        `msme_certificate`=:msme_certificate,
        `incorporation_certificate`=:incorporation_certificate,
        `voide_check`=:voide_check,
        `agreement`=:agreement,
        `other_document_one`=:other_document1,
        `other_document_two`=:other_document2,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `branch`=:branch,
        `city`=:city
        WHERE `company_token`=:company_token
        AND `airport_token`=:airport_token";
        $stmt21 = $this->conn->prepare( $query21 );
        $stmt21->bindParam('email_id', $this->locationemailaddress);
        $stmt21->bindParam('pan_number', $this->pan_number);
        $stmt21->bindParam('gst_number', $this->gst_number);
        $stmt21->bindParam('pan_certificate', $this->pan_certificate);
        $stmt21->bindParam('gst_certificate', $this->gst_certificate);
        $stmt21->bindParam('msme_certificate', $this->msme_certificate);
        $stmt21->bindParam('incorporation_certificate', $this->certificate_incorporation);
        $stmt21->bindParam('voide_check', $this->voice_cheque);
        $stmt21->bindParam('agreement', $this->certificate_agreement);
        $stmt21->bindParam('other_document1', $this->other_document1);
        $stmt21->bindParam('other_document2', $this->other_document2);
        $stmt21->bindParam('account_number', $this->account_number);
        $stmt21->bindParam('ifsc_code', $this->ifsc_code);
        $stmt21->bindParam('branch', $this->branch_name);
        $stmt21->bindParam('city', $this->cityname);
        $stmt21->bindParam('company_token', $this->serviceProviderCompanyToken);
        $stmt21->bindParam('airport_token', $this->airportToken);
        if($stmt21->execute()){
            return true;
        }else{
            return false;    
        }
    }
}
?>