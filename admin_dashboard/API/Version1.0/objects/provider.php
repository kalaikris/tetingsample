<?php
class provider extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function providerListCheck(){
        $query = "SELECT `token`,
        `business_id`,
        `name`,
        `email`,
        `commission_percentage`,
        `status`,
        `is_credit`
        FROM `service__provider` WHERE `status`='0'
        OR  `status`='2'
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function providerListView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->providerToken = $row['token'];
            $obj->providerId    = $row['business_id'];
            $obj->providerName  = $row['name'];
            $obj->providerEmail = $row['email'];
            $obj->commission    = $row['commission_percentage'];
            $obj->providerstatus= $row['status'];
            $obj->is_credit = $row['is_credit'] == '1'?'Yes':'No';
            array_push($array, $obj);
        }
        return $array;
    }
    public function providerAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__provider` 
        WHERE (
            `business_id`=:business_id
            OR `name`=:name
        )
        AND `status`!=3";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->business_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    public function providerStaffAvailableCheck(){
        $query = "SELECT `token` 
        FROM `service__provider_company_location_staffs` 
        WHERE `business_id`=:business_id
        AND `status`!='4'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->business_id);
        $stmt->execute();
        return $stmt;
    }
    
    public function addProvider(){
        $query = "INSERT INTO `service__provider` SET `token`=:token,
        `name`=:name,
        `business_id`=:business_id,
        `email`=:email,
        `password`=:password,
        `status`='0',
        `is_credit`=:is_credit,
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":business_id", $this->business_id);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->bindParam(":is_credit", $this->is_credit);
        $stmt->execute();
        return $stmt;
    }
    function addProviderUserRole(){
        $query = "INSERT INTO `service__provider_company_location_user_role` SET 
        `token`=:token,
        `service_provider_company_location_token`=:service_provider_company_location_token,
        `is_admin`='1',
        `name`='Super Admin',
        `created_datetime`=:created_datetime,
        `status`='1',
        `editstatus`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userRoleToken);
        $stmt->bindParam(":service_provider_company_location_token", $this->providerToken);
        $stmt->bindParam(":created_datetime", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addModulesForUserRole(){
        $query1 = "SELECT `token` FROM `modules` WHERE `type`='1'";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
        while( $row = $stmt1->fetch(PDO::FETCH_ASSOC) ){
            $moduleToken = $row['token'];
            $query = "INSERT INTO `service__provider_company_location_user_role_module` SET `service__provider_company_location_user_role_token`=:user_role_token,
            `module_token`=:module_token,
            `status`='1',
            `created_datetime`=:created_datetime";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":user_role_token", $this->userRoleToken);
            $stmt->bindParam(":module_token", $moduleToken);
            $stmt->bindParam(":created_datetime", $this->gmDateTime);
            $stmt->execute();
        }
    }
    function addProviderStaff(){
        $query = "INSERT INTO `service__provider_company_location_staffs` SET 
        `token`=:token,
        `service_provider_company_location_token`=:service_provider_company_location_token,
        `is_admin`='1',
        `business_id`=:business_id,
        `password`=:password,
        `staff_id`=:staff_id,
        `title`='',
        `name`=:name,
        `email`=:email,
        `image`='',
        `country_code`='',
        `mobile_number`='',
        `join_date`=:join_date,
        `user_role_token`=:user_role_token,
        `status`='1',
        `is_available`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->staffToken);
        $stmt->bindParam(":service_provider_company_location_token", $this->providerToken);
        $stmt->bindParam(":business_id", $this->business_id);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":staff_id", $this->staffId);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":join_date", $this->gmDateTime);
        $stmt->bindParam(":user_role_token", $this->userRoleToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    
    public function singleProviderCheck(){
        $query = "SELECT `token`,
        `business_id`,
        `name`,
        `email`,
        `date_time`
        FROM `service__provider` WHERE `status`='0'
        AND `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        return $stmt;
    }
    public function singleProviderView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->providerId    = $row['business_id'];
        $obj->providerName  = $row['name'];
        $obj->providerEmail = $row['email'];
        $obj->createdDate   = convertDate("d M Y",$row['date_time']);
        return $obj;
    }
    public function providerCompanyCheck(){
        $query = "SELECT `service__provider_company`.`token`,
        `service__provider_company`.`name`,
        `service__provider`.`name` AS `service__provider_name`,
        `service__provider`.`token` AS `service__provider_token`,
        `service__provider`.`business_id` AS `service__provider_id`,
        `business_type`.`type` AS `business_type`,
        `business_type`.`name` AS `category`,
        `service__provider_company`.`website_name`,
        `service__provider_company`.`total_service_location`,
        `service__provider_company`.`date_time`,
        `service__provider_company`.`status`,
        `service__provider`.`is_credit`
        FROM `service__provider_company`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        INNER JOIN `service__provider` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        WHERE `service__provider_company`.`service_provider_token`=:service_provider_token
        AND `service__provider_company`.`status`!='4'
        ORDER BY `service__provider_company`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_token", $this->providerToken);
        $stmt->execute();
        return $stmt;
    }
    public function newProviderCompanyCheck(){
        $query = "SELECT 
        `service__provider_company`.`token`,
        `service__provider_company`.`business_id`,
        `service__provider_company`.`name`,
        `service__provider`.`name` AS `service__provider_name`,
        `service__provider`.`token` AS `service__provider_token`,
        `service__provider`.`business_id` AS `service__provider_id`,
        `business_type`.`type` AS `business_type`,
        `business_type`.`name` AS `category`,
        `service__provider_company`.`website_name`,
        `service__provider_company`.`total_service_location`,
        `service__provider_company`.`date_time`,
        `service__provider_company`.`status`
        FROM `service__provider_company`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        INNER JOIN `service__provider` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        WHERE `service__provider_company`.`status`='0'
        OR `service__provider_company`.`status`='1'
        ORDER BY `service__provider_company`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function providerCompanyView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->companyToken   = $row['token'];
            $obj->companyId      = $row['business_id'];
            $obj->companyName    = $row['name'];
            $obj->providerName   = $row['service__provider_name'];
            $obj->providerToken  = $row['service__provider_token'];
            $obj->providerId     = $row['service__provider_id'];
            $obj->companyWebsite = $row['website_name'];
            $obj->category       = $row['category'];
            $obj->businessType   = $row['business_type'];
            $obj->totalLocations = $row['total_service_location'];
            $obj->onboardedDate  = convertDate("d M Y",$row['date_time']);
            $obj->status         = $row['status'];
            $obj->is_credit         = $row['is_credit'];
            $obj->statusString   = $this->statusString($row['status']);
            array_push($array, $obj);
        }
        return $array;
    }
    //0	0-Proceed For Review,1-Under Review,2-Approved,3-Cancelled,4-Deleted,5-Blocked
    function statusString($status){
        switch($status){
            case 0 : $value = "Pending"; break;
            case 1 : $value = "Under Review"; break;
            case 2 : $value = "Active"; break;
            case 3 : $value = "Cancelled"; break;
            case 4 : $value = "Deleted"; break;
            case 5 : $value = "Blocked"; break;
        }
        return $value;
    }
    public function singleProviderCompanyCheck(){
        $query = "SELECT `service__provider_company`.`token`,
        `service__provider_company`.`name`,
        `service__provider_company`.`website_name`,
        `business_type`.`type` AS `business_type`,
        `business_type`.`name` AS `category`,
        `service__provider_company`.`total_service_location`,
        `service__provider_company`.`date_time`,
        `service__provider_company`.`status`,
        `service__provider_company`.`business_email`,
        `service__provider_company`.`business_country_code`,
        `service__provider_company`.`business_mobile_number`,
        `service__provider_company`.`year_inception`,
        `service__provider_company`.`primary_name`,
        `service__provider_company`.`designation`,
        `service__provider_company`.`primary_email`,
        `service__provider_company`.`primary_country_code`,
        `service__provider_company`.`primary_mobile_number`,
        `service__provider_company`.`alternate_email_id`,
        `service__provider_company`.`alternate_country_code`,
        `service__provider_company`.`alternate_mobile_number`,
        `service__provider_company`.`address`,
        COALESCE(`countries`.`name`,'') AS `country_name`,
        COALESCE(`regions`.`name`,'') AS `state_name`,
        COALESCE(`cities`.`name`,'') AS `city`,
        `service__provider_company`.`pin_code`,
        `service__provider`.`is_credit`
        FROM `service__provider_company`
        INNER JOIN `service__provider` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        LEFT JOIN `countries` ON `countries`.`id`=`service__provider_company`.`country_id`
        LEFT JOIN `regions` ON `regions`.`id`=`service__provider_company`.`state_id`
        LEFT JOIN `cities` ON `cities`.`id`=`service__provider_company`.`city_id`
        WHERE `service__provider_company`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function singleProviderCompanyView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->is_credit   = $row['is_credit'];
        $obj->companyToken   = $row['token'];
        $obj->companyName    = $row['name'];
        $obj->companyWebsite = $row['website_name'];
        $obj->category       = $row['category'];
        $obj->businessType   = $row['business_type'];
        $obj->totalLocations = $row['total_service_location'];
        $obj->onboardedDate  = convertDate("d M Y",$row['date_time']);
        $obj->status         = $row['status'];
        $obj->statusString   = $this->statusString($row['status']);
        $obj->businessEmail  = $row['business_email'];
        $obj->businessMobileNumber= $row['business_country_code']." ".$row['business_mobile_number'];
        $obj->yearInception  = $row['year_inception'];
        $obj->primaryName    = $row['primary_name'];
        $obj->designation    = $row['designation'];
        $obj->primaryEmail   = $row['primary_email'];
        $obj->primaryMobileNumber  = $row['primary_country_code']." ".$row['primary_mobile_number'];
        if($row['alternate_email_id']==""){
            $obj->alternateEmailId= "-";
        }else{
            $obj->alternateEmailId= $row['alternate_email_id'];
        }
        if($row['alternate_mobile_number']==""){
            $obj->alternateMobileNumber= "-";
        }else{
            $obj->alternateMobileNumber= $row['alternate_country_code']." ".$row['alternate_mobile_number'];
        }
        $obj->address        = $row['address'];
        $obj->country_name   = $row['country_name'];
        $obj->state_name     = $row['state_name'];
        $obj->city           = $row['city'];
        $obj->pin_code       = $row['pin_code'];
        return $obj;
    }
    function providerCompanyLocationCheck(){
        $query = "SELECT `service__provider_company_location`.`token`,
        `airport`.`name` AS `airport`,
        `service__provider_company_location`.`account_number`,
        `service__provider_company_location`.`ifsc_code`,
        `service__provider_company_location`.`branch`,
        `service__provider_company_location`.`city`,
        `service__provider_company_location`.`gst_certificate`,
        `service__provider_company_location`.`msme_certificate`,
        `service__provider_company_location`.`incorporation_certificate`,
        `service__provider_company_location`.`agreement`,
        `service__provider_company_location`.`voide_check`,
        COALESCE(`service__provider_company_location`.`commission_percentage`,'0') AS `commission_percent`,
        `service__provider_company_location`.`gst_number`,
        `service__provider_company_location`.`pancard_number`,
        `service__provider_company_location`.`pan_certificate`,
        `service__provider_company_location`.`other_document_one`,
        `service__provider_company_location`.`other_document_two`,
        `service__provider_company_location`.`status`
        FROM `service__provider_company_location` 
        INNER JOIN `airport` ON
            `airport`.`token`=`service__provider_company_location`.`airport_token`
        WHERE `service__provider_company_location`.`company_token`=:company_token AND `service__provider_company_location`.`status`!='2'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    public function providerCompanyLocationView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->locationToken= $row['token'];
            $obj->airport      = $row['airport'];
            $obj->accountNumber= $row['account_number'];
            $obj->ifsc_code    = $row['ifsc_code'];
            $obj->branch       = $row['branch'];
            $obj->city         = $row['city'];
            $obj->gstCertificate   = $row['gst_certificate'];
            $obj->msmeCertificate  = $row['msme_certificate'];
            $obj->incorporationCertificate = $row['incorporation_certificate'];
            $obj->contractAgreement        = $row['agreement'];
            $obj->voideCheck       = $row['voide_check'];
            $obj->commission_percentage   = $row['commission_percent'];
            $obj->gstNumber   = $row['gst_number'];
            $obj->pancardNumber   = $row['pancard_number'];
            $obj->panCertificate   = $row['pan_certificate'];
            $obj->otherDocumentOne   = $row['other_document_one'];
            $obj->otherDocumentTwo   = $row['other_document_two'];
            if($row['status'] == '0'){
                $obj->status   = '1';
                $obj->locationStatus = 'Block';
            }else if($row['status'] == '1'){
                $obj->status   = '0';
                $obj->locationStatus = 'Unblock';
            }
            array_push($array, $obj);
        }
        return $array;
    }
    public function approveProviderCompany(){
        //2 - for approved, 3 - for cancelled
        $query = "UPDATE `service__provider_company` SET 
        `status`=:status,`reject_reason`=:rejectReason
        WHERE `token`=:company_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->bindParam(":rejectReason", $this->rejectReason);
        $stmt->bindParam(":status", $this->status);
        $stmt->execute();
        return $stmt;
    }
    public function deleteProviderCompany(){
        $query = "UPDATE `service__provider_company` SET 
        `status`='4'
        WHERE `token`=:company_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":company_token", $this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    public function deleteProvider(){
        $query = "UPDATE `service__provider` SET 
        `status`='3'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        
        $query = "UPDATE `service__provider_company_location_staffs` SET 
        `status`='4'
        WHERE `service_provider_company_location_token`=:token
        AND is_admin='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        
        return $stmt;
    }
    public function blockProvider(){
        $query = "UPDATE `service__provider` SET 
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        return $stmt;
    }
    public function unBlockProvider(){
        $query = "UPDATE `service__provider` SET 
        `status`='0'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        return $stmt;
    }
    public function updateProviderCredit(){
        $query = "INSERT INTO `service__provider_credit_logs` SET  `service_provider_token`=:service_provider_token,
        `credit_available`=:credit_available,
        `given_credit`=:given_credit,
        `current_credit`=:current_credit,
        `reference_id`=:reference_id,
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_token", $this->providerToken);
        $stmt->bindParam(":credit_available", $this->creditAvailable);
        $stmt->bindParam(":given_credit", $this->givenCredits);
        $stmt->bindParam(":current_credit", $this->currentCredit);
        $stmt->bindParam(":reference_id", $this->referenceId);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        $query1 = "UPDATE `service__provider` SET `credit_available`=:credit_available WHERE `token`=:service_provider_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":service_provider_token", $this->providerToken);
        $stmt1->bindParam(":credit_available", $this->currentCredit);
        $stmt1->execute();
        return $stmt;
    }
    function updateServiceLocationCommissionPercentage(){
        $query = "UPDATE `service__provider_company_location` SET 
        `commission_percentage`=:commission_percentage
        WHERE `company_token`=:companyToken AND `airport_token`=:locationToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":commission_percentage", $this->commission);
        $stmt->bindParam(":companyToken", $this->companyToken);
        $stmt->bindParam(":locationToken", $this->locationToken);
        $stmt->execute();
        return $stmt;
    }
    function getProviderCredit(){
        $query = "SELECT `credit_available` 
        FROM `service__provider`
        WHERE `token`=:token AND `is_credit`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['credit_available'];
    }
    function providerCreditView(){
        $query = "SELECT `service__provider`.`credit_available`,
        SUM(`service__provider_credit_logs`.`given_credit`) AS `total_credits`
        FROM `service__provider`
        INNER JOIN `service__provider_credit_logs` ON 
            `service__provider_credit_logs`.`service_provider_token`=`service__provider`.`token`
        WHERE `service__provider`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->creditAvailable= $row['credit_available'];
        $obj->totalCredits   = $row['total_credits'];
        $obj->usedCredits    = $row['total_credits']-$row['credit_available'];
        $obj->data           = $this->creditLog();
        return $obj;
    }
    public function creditLog(){
        $query = "SELECT `credit_available`,
        `given_credit`,
        `current_credit`,
        `reference_id`,
        `date_time`
        FROM `service__provider_credit_logs`
        WHERE `service_provider_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->providerToken);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->creditAvailable= $row['credit_available'];
            $obj->givenCredit    = $row['given_credit'];
            $obj->currentCredit  = $row['current_credit'];
            $obj->referenceId    = $row['reference_id'];
            $obj->createDate     = convertDate("d M Y",$row['date_time']);
            array_push($array, $obj);
        }
        return $array;
    }
    function dropDownProviderCheck(){
        $query = "SELECT `token`,
        `name`
        FROM `service__provider` WHERE `status`='0' AND `is_credit`='1'
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function dropDownProviderView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->providerToken = $row['token'];
            $obj->providerName  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function allServiceProviderData(){
        $dateQuery = $this->dateQuery;
        $provquery = "SELECT `service__provider`.`name` AS `provider_name`,
        `service__provider`.`status`,
        `service__provider_company`.`name` AS `provider_company_name`,
        `airport`.`name` AS `location_name`,
        `service__provider_company`.`address`, 
        `service__provider_company`.`alternate_email_id`,
        CONCAT(`service__provider_company`.`alternate_country_code`,'-',`service__provider_company`.`alternate_mobile_number`) AS `alternate_mobile`,
        `service__provider_company`.`alternate_mobile_number`,
        `service__provider_company`.`primary_email`,
        CONCAT(`service__provider_company`.`primary_country_code`,'-',`service__provider_company`.`primary_mobile_number`) AS `primary_mobile_number`,
        `service__provider_company_location`.`commission_percentage`,
        `service__provider_company_location`.`gst_certificate`,
        `service__provider_company_location`.`msme_certificate`,
        `service__provider_company_location`.`incorporation_certificate`,
        `service__provider_company_location`.`pancard_number`,
        `service__provider_company_location`.`gst_number`
        FROM `service__provider`
        INNER JOIN `service__provider_company` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token`=`service__provider_company_location`.`company_token`
        INNER JOIN `airport` ON `airport`.`token`=`service__provider_company_location`.`airport_token`
        WHERE `service__provider`.`status` IN ('0','1') AND `service__provider_company`.`status`='2' $dateQuery
        ORDER BY `service__provider`.`id` DESC";
        $provstmt = $this->conn->prepare($provquery);
        $provstmt->execute();
        return $provstmt;
    }
    function allServiceProviderDataView($stmt){
        $allProvArray = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->provider_name = $row["provider_name"];
            if($row["status"] == '0'){
              $obj->status = 'Active';  
            }else{
              $obj->status = 'Inactive';   
            }
            $obj->provider_company_name = $row["provider_company_name"];
            $obj->address = $row["address"];
            $obj->alternate_email = $row["alternate_email_id"];
            $obj->alternate_mobile = $row["alternate_mobile_number"]==""?"":$row["alternate_mobile"];
            $obj->primary_email = $row["primary_email"];
            $obj->primary_mobile_number = $row["primary_mobile_number"];
            $obj->commission_percentage = $row["commission_percentage"];
            $obj->location_name = $row["location_name"];
            $obj->gst_certificate = $row["gst_certificate"];
            $obj->msme_certificate = $row["msme_certificate"];
            $obj->incorporation_certificate = $row["incorporation_certificate"];
            $obj->pancard_number = $row["pancard_number"];
            $obj->gst_number = $row["gst_number"];
            array_push($allProvArray, $obj);
        }
        return $allProvArray;
    }
    function providerCompanyLocationCommissionPercentage(){
        $query = "SELECT `service__provider_company_location`.`airport_token`,
        `airport`.`name` AS `airport_name`,
        `service__provider_company_location`.`commission_percentage`
        FROM `service__provider_company_location` 
        INNER JOIN `airport` ON `service__provider_company_location`.`airport_token` = `airport`.`token`
        WHERE `service__provider_company_location`.`company_token`=:companyToken";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":companyToken",$this->companyToken);
        $stmt->execute();
        return $stmt;
    }
    function providerCompanyLocationCommissionPercentageView($stmt){
        $commissionArray = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->locationToken = $row["airport_token"];
            $obj->airport = $row["airport_name"];
            $obj->commissionPercentage = $row["commission_percentage"];
            array_push($commissionArray,$obj);
        }
        return $commissionArray;
    }
    function updateCommissionForLocation(){
        $comQuery = "UPDATE `service__provider_company_location` 
        SET `commission_percentage`=:commission 
        WHERE `company_token`=:companyToken AND `airport_token`=:locationToken";
        $comStmt = $this->conn->prepare($comQuery);
        $comStmt->bindParam(':companyToken',$this->companyToken);
        $comStmt->bindParam(':locationToken',$this->locationToken);
        $comStmt->bindParam(':commission',$this->commissionPercentage);
        $comStmt->execute();
    }
    function providerCompanyLocation(){
        $query = "SELECT 
        `service__provider_company_location`.`token` AS `service__provider_company_location_token`,
        concat(`service__provider_company`.`name`,'-',`airport`.`code`) AS `service_provider_company_location`
        FROM `service__provider_company`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token`=`service__provider_company_location`.`company_token`
        INNER JOIN `airport` ON `service__provider_company_location`.`airport_token` = `airport`.`token`
        WHERE `airport`.`status` = '1' AND `service__provider_company`.`status`='2'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $serviceProviderCompanyArray = [];
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $obj = new stdClass();
                $obj->service__provider_company_location_token = $row["service__provider_company_location_token"];
                $obj->service_provider_company_location = $row["service_provider_company_location"];
                array_push($serviceProviderCompanyArray,$obj);
            }
            return $serviceProviderCompanyArray;
        }else{
           return $serviceProviderCompanyArray; 
        } 
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
        return $obj;
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
       `pin_code`=:pin_code
       WHERE `token`=:service_provider_company_token";
       $stmt = $this->conn->prepare( $query );
       $stmt->bindParam('service_provider_company_token', $this->service_provider_company_token);
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
       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
   }
    function updateProviderLocationStatus(){
        $query = "UPDATE `service__provider_company_location` set `status`=:status WHERE `token`=:locationToken";
        $stmt = $this->conn->prepare( $query ); 
        $stmt->bindParam('locationToken', $this->locationToken);
        $stmt->bindParam('status', $this->status);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
    function updateProviderDetails(){
        $query = "UPDATE `service__provider` SET
        `is_credit`=:isCredit WHERE `token`=:providerToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":providerToken", $this->providerToken);
        $stmt->bindParam(":isCredit", $this->isCredit);
        $stmt->execute();
        // $stmt->debugDumpParams();
        return $stmt;
    }
    function isCreditAvailableForProvider(){
        $query = "SELECT * FROM `service__provider` WHERE `credit_available` > 0 AND `token` = :providerToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":providerToken", $this->providerToken);
        $stmt->execute();
        //$stmt->debugDumpParams();
        return $stmt;
    }
}
?>