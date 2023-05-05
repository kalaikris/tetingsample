<?php
class distributor extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function distributorListCheck(){
        $query = "SELECT `service__distributor`.`token`,
        `service__distributor`.`name`,
        `service__distributor`.`email`,
        `service__distributor`.`site_name`,
        `service__distributor`.`status`,
        `service__distributor`.`commission_percentage`,
        `service__distributor`.`is_royalty`,
        `service__distributor`.`membership_name`,
        `service__distributor`.`membership_type`,
        `service__distributor`.`membership_length`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `service__distributor`.`is_markup`,
        `service__distributor`.`is_credit`,
        `service__distributor`.`miles_cost`,
        `service__distributor`.`miles_point`,
        `service__distributor`.`partner_code`,
        `service__distributor`.`tc_link1`,
        `service__distributor`.`tc_link2`,
        `service__distributor_type`.`is_agent`
        FROM `service__distributor`
        LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor`.`status`!='3' AND `service__distributor`.`token`!='1111111111'
        ORDER BY `service__distributor`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function distributorListView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->distibutorToken = $row['token'];
            $obj->distibutorName  = $row['name'];
            $obj->distibutorEmail = $row['email'];
            $obj->distibutorSiteName = $row['site_name'];
            $obj->isAgent  = $row['is_agent'];
            $obj->commission  = $row['commission_percentage'];
            $obj->isLoyalty  = $row['is_royalty'] == '1'?'Yes':'No';
            $obj->membershipName = $row['membership_name'];
            $obj->membershipType = $row['membership_type'];
            $obj->membershipLength = $row['membership_length'];
            $obj->isMarkup = $row['is_markup'] == '1'?'Yes':'No';
            $obj->is_credit = $row['is_credit'] == '1'?'Yes':'No';
            $obj->markupType = $row['markup_type'];
            $obj->markupValue = $row['markup_value'];
            $obj->milesCost = $row['miles_cost'];
            $obj->milesPoint = $row['miles_point'];
            $obj->partnerCode = $row['partner_code'];
            $obj->tcLink1 = $row['tc_link1'];
            $obj->tcLink2 = $row['tc_link2'];
            $obj->status = $row['status'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function distributorSiteNameCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor` 
        WHERE `site_name`=:site_name AND `site_name`!='' AND `status`!='3'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":site_name", $this->siteName);
        $stmt->execute();
        return $stmt;
    }
    public function addDistributor(){
        $query = "INSERT INTO `service__distributor` SET `token`=:token,
        `service_distributor_type_token`=:service_distributor_type_token,
        `name`=:name,
        `site_name`=:site_name,
        `email`=:email,
        `commission_percentage`=:commission_percentage,
        `is_business_info`='0',
        `date_time`=:date_time,
        `status`='0',
        `is_credit`=:is_credit,
        `is_external`=:is_external,
        `external_user_name`=:externalName,
        `external_password`=:externalPassword,
        `is_royalty`=:is_royalty,
        `membership_name`=:membership_name,
        `membership_type`=:membership_type,
        `membership_length`=:membership_length,
        `is_markup`=:isMarkup,
        `markup_type`=:markup_type,
        `markup_value`=:markup_value,
        `miles_cost`=:cost,
        `miles_point`=:points,
        `partner_code`=:partnerCode,
        `tc_link1`=:termsAndConditions1,
        `tc_link2`=:termsAndConditions2"; 
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->bindParam(":service_distributor_type_token", $this->distributorTypeToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":site_name", $this->siteName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":commission_percentage", $this->commission);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->bindParam(":markup_value", $this->markupValue);
        $stmt->bindParam(":membership_name", $this->membershipName);
        $stmt->bindParam(":membership_type", $this->membershipType);
        $stmt->bindParam(":membership_length", $this->membershipLength);
        $stmt->bindParam(":is_royalty", $this->isLoyalty);
        $stmt->bindParam(":isMarkup", $this->isMarkup);
        $stmt->bindParam(":markup_type", $this->markupType);
        $stmt->bindParam(":cost", $this->cost);
        $stmt->bindParam(":points", $this->points);
        $stmt->bindParam(":partnerCode", $this->partnerCode);
        $stmt->bindParam(":termsAndConditions1", $this->termsAndConditions1);
        $stmt->bindParam(":termsAndConditions2", $this->termsAndConditions2);
        $stmt->bindParam(":is_credit", $this->isCredit);
        $stmt->bindParam(":is_external", $this->isExternal);
        $stmt->bindParam(":externalName", $this->externalName);
        $stmt->bindParam(":externalPassword", $this->externalPassword);
        $stmt->execute();
        return $stmt;
    }
    function addDistributorUserRole(){
        $query = "INSERT INTO `service__distributor_user_role` SET
        `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`='Super Admin',
        `created_date`=:created_date,
        `status`='1',
        `editstatus`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userRoleToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":created_date", $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addModulesForUserRole(){
        $query1 = "SELECT `token` FROM `service__distributor_modules` WHERE `status`='1'";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
        while( $row = $stmt1->fetch(PDO::FETCH_ASSOC) ){
            $moduleToken = $row['token'];
            $query = "INSERT INTO `service__distributor_user_role_modules` SET 
            `role_token`=:role_token,
            `module_token`=:module_token,
            `status`='1',
            `created_date`=:created_date";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":role_token", $this->userRoleToken);
            $stmt->bindParam(":module_token", $moduleToken);
            $stmt->bindParam(":created_date", $this->gmDateTime);
            $stmt->execute();
        }
    }
    function addDistributorEmployee(){
        $query = "INSERT INTO `service__distributor_employee` SET
        `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`=:name,
        `email`=:email,
        `number`='',
        `profile_image`='',
        `business_id`=:business_id,
        `password`=:password,
        `user_role_token`=:user_role_token,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->employeeToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":business_id", $this->employeeBusinessId);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":user_role_token", $this->userRoleToken);
        $stmt->bindParam(":date_time", $this->gmDateTime);
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
        `business_type`.`name` AS `business_type`,
        `service__provider_company`.`website_name`,
        `service__provider_company`.`total_service_location`,
        `service__provider_company`.`date_time`,
        `service__provider_company`.`status`
        FROM `service__provider_company`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__provider_company`.`service_provider_token`=:service_provider_token
        AND `service__provider_company`.`status`!='4'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_provider_token", $this->providerToken);
        $stmt->execute();
        return $stmt;
    }
    public function providerCompanyView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->companyToken   = $row['token'];
            $obj->companyName    = $row['name'];
            $obj->companyWebsite = $row['website_name'];
            $obj->category       = $row['business_type'];
            $obj->totalLocations = $row['total_service_location'];
            $obj->onboardedDate  = convertDate("d M Y",$row['date_time']);
            $obj->status         = $row['status'];
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
        $query = "SELECT `service__provider_company`.`name`,
        `service__provider_company`.`website_name`,
        `business_type`.`type` AS `business_type`,
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
        `countries`.`name` AS `country_name`,
        `regions`.`name` AS `state_name`,
        COALESCE(`cities`.`name`,'') AS `city`,
        `service__provider_company`.`pin_code`
        FROM `service__provider_company`
        INNER JOIN `business_type` ON 
            `business_type`.`token`=`service__provider_company`.`business_type_token`
        INNER JOIN `countries` ON `countries`.`id`=`service__provider_company`.`country_id`
        INNER JOIN `regions` ON `regions`.`id`=`service__provider_company`.`state_id`
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
        $obj->companyName    = $row['name'];
        $obj->companyWebsite = $row['website_name'];
        $obj->category       = $row['business_type'];
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
        $obj->alternateEmailId     = $row['alternate_email_id'];
        $obj->alternateMobileNumber= $row['alternate_country_code']." ".$row['alternate_mobile_number'];
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
        `service__provider_company_location`.`agreement`
        FROM `service__provider_company_location` 
        INNER JOIN `airport` ON
            `airport`.`token`=`service__provider_company_location`.`airport_token`
        WHERE `service__provider_company_location`.`company_token`=:company_token";
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
            array_push($array, $obj);
        }
        return $array;
    }
    function deleteDistributor(){
        $query = "UPDATE `service__distributor` SET `status`='3' WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function singleDistributorDetail(){
        $query = "SELECT 
        `name`,
        `business_id`,
        `site_name`,
        `email`,
        `website_name`,
        `date_time`
        FROM `service__distributor`
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function singleDistributorDetailView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name       = $row["name"];
        $obj->businessId = $row["business_id"];
        $obj->siteName   = $row["site_name"];
        $obj->email      = $row["email"];
        $obj->websiteName= $row["website_name"];
        $obj->createdDate= convertDate("d M Y", $row["date_time"]);
        return $obj;
    }
    function distriburtorUserDetail(){
        $query = "SELECT `token`,
        `name`,
        `email`,
        `mobile_number` 
        FROM `users` 
        WHERE `service_distributor_token`=:service_distributor_token
        AND `is_agent`='0'
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function distriburtorUserDetailView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->userToken = $row['token'];
            $obj->name      = $row['name'];
            $obj->email     = $row['email'];
            $obj->mobileNumber= $row['mobile_number'];
            array_push($array, $obj);
        }
        return $array;
    }
    function distriburtorAgentDetail(){
        $query = "SELECT `token`,
        `name`,
        `email_id`,
        `mobile_number` 
        FROM `service__distributor_agent` WHERE `service_distributor_tokenIndex`=:service_distributor_token
        ORDER BY `id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function distriburtorAgentDetailView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->agnetToken  = $row['token'];
            $obj->name        = $row['name'];
            $obj->email       = $row['email_id'];
            $obj->mobileNumber= $row['mobile_number'];
            array_push($array, $obj);
        }
        return $array;
    }
    function singleDistributorUserDetail(){
        $query = "SELECT `name`,
        `email`,
        `mobile_number`,
        `date_time` 
        FROM `users` WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function singleDistributorUserDetailView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name       = $row["name"];
        $obj->email      = $row["email"];
        $obj->mobileNumber= $row["mobile_number"];
        $obj->createdDate= convertDate("d M Y", $row["date_time"]);
        return $obj;
    }
    function distriburtorUserOrderDetail(){
        $query = "SELECT `users__booking`.`booking_number`,
        `users__booking_detail`.`token`,
        `airport`.`name` AS `airport_name`,
        `airport__terminal`.`name` AS `airport__terminal`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON 
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__terminal` ON 
            `airport__terminal`.`token`=`users__booking_detail`.`terminal_token`
        WHERE `users__booking`.`user_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function distriburtorUserOrderDetailView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->token         = $row["token"];
            $obj->bookingNumber = $row["booking_number"];
            $obj->serviceAirport= $row["airport_name"]." - ".$row["airport__terminal"];
            array_push($array, $obj);
        }
        return $array;
    }
    function singleDistributorAgentDetail(){
        $query = "SELECT `service__distributor_agent`.`title`,
        `service__distributor_agent`.`name`,
        `service__distributor_agent`.`profile_image`,
        `service__distributor_agent`.`date_of_birth`,
        `service__distributor_agent_type`.`name` AS `agent_type`,
        `service__distributor_agent`.`website`,
        `service__distributor_agent`.`email_id`,
        `service__distributor_agent`.`mobile_number`,
        `service__distributor_agent`.`alter_mobile_number`,
        `service__distributor_agent`.`alter_email_id`,
        `service__distributor_agent`.`address`,
        `countries`.`name` AS `countries`,
        `regions`.`name` AS `state`,
        `cities`.`name` AS `city`,
        `service__distributor_agent`.`pin_code`
        FROM `service__distributor_agent`
        INNER JOIN `service__distributor_agent_type` ON 
            `service__distributor_agent_type`.`token`=`service__distributor_agent`.`type_id`
        LEFT JOIN `countries` ON `countries`.`id`=`service__distributor_agent`.`country_id`
        LEFT JOIN `regions`ON `regions`.`id`=`service__distributor_agent`.`state_id`
        LEFT JOIN `cities` ON `cities`.`id`=`service__distributor_agent`.`city_id`   
        WHERE `service__distributor_agent`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->agentToken);
        $stmt->execute();
        return $stmt;
    }
    function singleDistributorAgentDetailView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name       = $row["title"]." ".$row["name"];
        $obj->image      = $row["profile_image"];
        $obj->dob        = convertDate("d M Y", $row["date_of_birth"]);
        $obj->agentType  = $row["agent_type"];
        $obj->website    = $row["website"];
        $obj->primaryEmail   = $row["email_id"];
        $obj->primaryNumber  = $row["mobile_number"];
        $obj->alteranteEmail = $row["alter_email_id"];
        $obj->alteranteNumber= $row["alter_mobile_number"];
        $obj->address    = $row["address"];
        $obj->country    = $row["countries"];
        $obj->state      = $row["state"];
        $obj->city       = $row["city"];
        $obj->pincode    = $row["pin_code"];
        $obj->commisionDetails = $this->agentCommision();
        return $obj;
    }
    function agentCommision(){
        $query = "SELECT `token`,
        `from_amount`,
        `yearly_target`,
        `to_amount`,
        `commision_type`,
        `percent` 
        FROM `service__distributor_agent_commision` 
        WHERE `status`='1'
        AND `sd_agent_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->agentToken);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token      = $row['token'];
            $obj->percent     = $row['percent'];
            if($row['commision_type']==1){
                $obj->type         = "target";
                $obj->yearlyTarget = $row['yearly_target'];
            }else{
                $obj->type        = "incentive";
                $obj->from_amount = $row['from_amount'];
                $obj->to_amount   = $row['to_amount'];
            }
            $obj->commisionType     = $row['commision_type'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function blockUnblockDistributor(){
        $query = "UPDATE `service__distributor` SET 
        `status`=:status
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function getdistributorCredit(){
        $query = "SELECT `credit_available` 
        FROM `service__distributor`
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['credit_available'];
    }
    public function updateDistributorCredit(){
        $query = "INSERT INTO `service__distributor_credit_logs` SET  
        `service_distributor_token`=:service_distributor_token,
        `credit_available`=:credit_available,
        `given_credit`=:given_credit,
        `current_credit`=:current_credit,
        `reference_id`=:reference_id,
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":credit_available", $this->creditAvailable);
        $stmt->bindParam(":given_credit", $this->givenCredits);
        $stmt->bindParam(":current_credit", $this->currentCredit);
        $stmt->bindParam(":reference_id", $this->referenceId);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->execute();
        $query1 = "UPDATE `service__distributor` SET `credit_available`=:credit_available WHERE `token`=:service_distributor_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt1->bindParam(":credit_available", $this->currentCredit);
        $stmt1->execute();
        return $stmt;
    }
    function updateDistributorCommissionPercentage(){
        $query = "UPDATE `service__distributor` SET 
        `commission_percentage`=:commission_percentage,
        `is_royalty`=:is_royalty,
        `membership_name`=:membership_name,
        `membership_type`=:membership_type,
        `membership_length`=:membership_length,
        `is_markup`=:is_markup,
        `is_credit`=:is_credit,
        `markup_type`=:markup_type,
        `markup_value`=:markup_value,
        `miles_cost`=:cost,
        `miles_point`=:points,
        `partner_code`=:partnerCode,
        `tc_link1`=:termsAndConditions1,
        `tc_link2`=:termsAndConditions2
        WHERE `token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":commission_percentage", $this->commission);
        $stmt->bindParam(":is_markup", $this->isMarkup);
        $stmt->bindParam(":is_credit", $this->isCredit);
        $stmt->bindParam(":markup_type", $this->markupType);
        $stmt->bindParam(":markup_value", $this->markupValue);
        $stmt->bindParam(":membership_name", $this->membershipName);
        $stmt->bindParam(":membership_type", $this->membershipType);
        $stmt->bindParam(":membership_length", $this->membershipLength);
        $stmt->bindParam(":is_royalty", $this->isLoyalty);
        $stmt->bindParam(":cost", $this->cost);
        $stmt->bindParam(":points", $this->points);
        $stmt->bindParam(":partnerCode", $this->partnerCode);
        $stmt->bindParam(":termsAndConditions1", $this->termsAndConditions1);
        $stmt->bindParam(":termsAndConditions2", $this->termsAndConditions2);
        $stmt->execute();
        return $stmt;
    }
    function dropDownDistributorCheck(){
        $query = "SELECT `service__distributor`.`token`,
        `service__distributor`.`name`
        FROM `service__distributor`
        LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor`.`status`!='3' AND `service__distributor`.`token`!='1111111111'
        ORDER BY `service__distributor`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function dropDownDistributorView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->distibutorToken = $row['token'];
            $obj->distibutorName  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function distributorCreditView(){
        $query = "SELECT `service__distributor`.`credit_available`,
        SUM(`service__distributor_credit_logs`.`given_credit`) AS `total_credits`
        FROM `service__distributor`
        INNER JOIN `service__distributor_credit_logs` ON 
            `service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`
        WHERE `service__distributor`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
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
        FROM `service__distributor_credit_logs`
        WHERE `service_distributor_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
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
    function distriburtorOnboard(){
        $query = "SELECT 
        `service__distributor`.`name`,
        `service__distributor`.`site_name`,
        `service__distributor_type`.`name` AS `distributor_type`,
        `service__distributor`.`primary_email`,
        `service__distributor`.`country_code`,
        `service__distributor`.`primary_mobile_number`,
        `service__distributor`.`alternate_email`,
        `service__distributor`.`alternate_country_code`,
        `service__distributor`.`alternate_mobile_number`,
        `countries`.`name` AS `country`,
        `regions`.`name` AS `state`,
        `cities`.`name` AS `city_name`,
        `service__distributor`.`address`,
        `service__distributor`.`pincode`,
        `service__distributor`.`account_number`,
        `service__distributor`.`ifsc_code`,
        `service__distributor`.`branch`,
        `service__distributor`.`city`,
        `service__distributor`.`pan_card`,
        `service__distributor`.`gst_certificate`,
        `service__distributor`.`msme_certificate`,
        `service__distributor`.`incorporation_certificate`,
        `service__distributor`.`voide_cheque`,
        `service__distributor`.`contract_agreement`,
        `service__distributor`.`other_document_one`,
        `service__distributor`.`other_document_two`,
        `service__distributor`.`pancard_number`,
        `service__distributor`.`gst_number`
        FROM `service__distributor`
        INNER JOIN `service__distributor_type` ON 
        	`service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        INNER JOIN `countries` ON `countries`.`id`=`service__distributor`.`country_id`
        INNER JOIN `regions` ON  `regions`.`id`=`service__distributor`.`state_id`
        INNER JOIN `cities` ON `cities`.`id`=`service__distributor`.`city_id`
        WHERE `service__distributor`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function distriburtorOnboardView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj1 = new stdClass();
        $obj1->name            = $row["name"];
        $obj1->siteName        = $row["site_name"];
        $obj1->distributorType = $row["distributor_type"];
        $obj1->primaryEmail       = $row["primary_email"];
        $obj1->countryCode        = $row["country_code"];
        $obj1->primaryMobileNumber= $row["primary_mobile_number"];
        $obj1->alternateEmail     = $row["alternate_email"];
        $obj1->alternateCuntryCode= $row["alternate_country_code"];
        $obj1->alternateMobileNumber= $row["alternate_mobile_number"];
        $obj1->country  = $row["country"];
        $obj1->state    = $row["state"];
        $obj1->city_name     = $row["city_name"];
        $obj1->address  = $row["address"];
        $obj1->pincode  = $row["pincode"];
        
        $obj2 = new stdClass();
        $obj2->accountNumber = $row["account_number"];
        $obj2->ifscCode      = $row["ifsc_code"];
        $obj2->branch        = $row["branch"];
        $obj2->city          = $row["city"];
        
        
        $obj3 = new stdClass();
        $obj3->serviceChosen  = $this->distributorServices();
        $obj3->airportsChosen = $this->distributorAirports();
        
        $obj4 = new stdClass();
        $obj4->panCard         = strval($row["pan_card"]);
        $obj4->gstCertificate  = strval($row["gst_certificate"]);
        $obj4->msmeCertificate = strval($row["msme_certificate"]);
        $obj4->incorporationCertificate = strval($row["incorporation_certificate"]);
        $obj4->voide_cheque      = strval($row["voide_cheque"]);
        $obj4->contractAgreement = strval($row["contract_agreement"]);
        $obj4->otherDocumentOne = strval($row["other_document_one"]);
        $obj4->otherDocumentTwo = strval($row["other_document_two"]);
        $obj4->panNumber = strval($row["pancard_number"]);
        $obj4->gstNumber = strval($row["gst_number"]);
        
        $obj = new stdClass();
        $obj->bussinessInfo = $obj1;
        $obj->bankDetails   = $obj2;
        $obj->serviceAndLocations= $obj3;
        $obj->documents     = $obj4;
        return $obj;
    }
    function distributorServices(){
        $query = "SELECT 
        `business_type`.`token`,
        `business_type`.`name`
        FROM `service__distributor_business`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_business`.`business_type_token`
        WHERE `service__distributor_business`.`is_active`='1'
        AND `service__distributor_business`.`service_distributor_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token = $row['token'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function distributorAirports(){
        $query = "SELECT `airport`.`token`,
        `airport`.`code`,
        `airport`.`name`
        FROM `service__distributor_airport`
        INNER JOIN `airport` ON `airport`.`token`=`service__distributor_airport`.`airport_token`
        WHERE `service__distributor_airport`.`status`='1'
        AND `service__distributor_airport`.`service_distributor_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token = $row['token'];
            $obj->code  = $row['code'];
            $obj->name  = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    function allServiceDistributorData(){
        $dateQuery = $this->dateQuery;
        $allDist = "SELECT `service__distributor`.`name`,
        `service__distributor`.`status`,
        `service__distributor`.`address`,
        `service__distributor`.`email`,
        CONCAT(`service__distributor`.`country_code`,'-',`service__distributor`.`primary_mobile_number`) AS `business_mobile_number`,
        `service__distributor`.`primary_email`,
        CONCAT(`service__distributor`.`alternate_country_code`,'-',`service__distributor`.`alternate_mobile_number`) AS `alternate_mobile_number`,
        `service__distributor`.`account_number`,
        `service__distributor`.`ifsc_code`,
        `service__distributor`.`branch`,
        `service__distributor`.`commission_percentage`,
        `service__distributor`.`pan_card`,
        `service__distributor`.`gst_certificate`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `service__distributor`.`gst_number`,
        `service__distributor`.`pancard_number`
        FROM `service__distributor` WHERE `service__distributor`.`status` IN ('0','1') $dateQuery
        ORDER BY `service__distributor`.`id` DESC";
        $allDistStmt = $this->conn->prepare($allDist);
        $allDistStmt->execute();
        return $allDistStmt;
    }
    function allServiceDistributorDataView($stmt){
        $allDistArray = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->name = $row["name"];
            if($row["status"] == '0'){
              $obj->status = 'Active';  
            }else{
              $obj->status = 'Inactive';   
            }
            $obj->address = $row["address"];
            $obj->email = $row["email"];
            $obj->mobile_number = $row["business_mobile_number"];
            $obj->primary_email = $row["primary_email"];
            $obj->alternate_mobile_number = $row["alternate_mobile_number"];
            $obj->account_number = $row["account_number"];
            $obj->ifsc_code = $row["ifsc_code"];
            $obj->branch = $row["branch"];
            $obj->commission_percentage = $row["commission_percentage"];
            $obj->pan_card = $row["pan_card"]!='' ? $row["pan_card"] : '-';
            $obj->gst_certificate = $row["gst_certificate"]!='' ? $row["gst_certificate"] : '-';
            $obj->markup_type = $row["markup_type"];
            $obj->markup_value = $row["markup_value"];
            $obj->gst_number = $row["gst_number"];
            $obj->pancard_number = $row["pancard_number"];
            array_push($allDistArray, $obj);
        }
        return $allDistArray;
    }
    function getLoyaltyBookingList(){
        $dateQuery = $this->dateQuery;
        $query = "SELECT `users__booking`.`booking_number`,
		`users__booking`.`token`,
        `users__booking`.`date_time` AS `booked_on`,
        `users__booking`.`membership_number`,
        `users__booking`.`service_amount`,
        `users__booking`.`cv_earned`,
        `users__booking_detail`.`service_date_time`,
        `users__passenger`.`name` AS `passenger_name`,
        `service__distributor`.`partner_code`,
        `service__distributor`.`commission_percentage`,
        `service__distributor`.`miles_cost`,
        `service__distributor`.`miles_point`,
        `service__provider_company`.`name` AS `service_provider_name`,
        `airport`.`name` AS `airport_name`,
        `cities`.`name` AS `location_name`,
        SUM(`users__booking_detail`.`net_amount`) AS `net_amount`
        FROM `users__booking`
        INNER JOIN `users__booking_detail` ON `users__booking`.`token` = `users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor` ON `users__booking`.`service_distributor_token` = `service__distributor`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `users__booking_detail`.`company_token`
        INNER JOIN `airport` ON `airport`.`token` = `users__booking_detail`.`airport_token`
        INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
        INNER JOIN `users__booking_passenger` ON `users__booking`.`token` = `users__booking_passenger`.`booking_token` AND `users__booking_passenger`.`passenger_type` = 'Contact'
        INNER JOIN `users__passenger` ON `users__booking_passenger`.`user_passenger_token` = `users__passenger`.`token`
        WHERE `service__distributor`.`is_royalty` = '1' AND `users__booking`.`membership_number` <> '' $dateQuery AND 
        0 = (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`status` IN ('Ongoing','Pending','Assign','Confirmed','Draft') AND `users__booking_detail`.`booking_token`=`users__booking`.`token`) AND `users__booking_detail`.`status` = 'Completed' GROUP BY `users__booking`.`booking_number`";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
       // $stmt->debugDumpParams();
        return $stmt; 
    }
    function loyaltyBookingListView($stmt){
        $loyaltyArray = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $surname = '';
            $obj->bookingNumber = $row["booking_number"];
            $obj->bookedDate = $row["booked_on"];
            $obj->membershipNumber = $row["membership_number"];
            $obj->serviceDate = $row["service_date_time"];
            $obj->passengerFullName = $row["passenger_name"];
            $nameArray = explode(" ", $row["passenger_name"]);
            $obj->userName = $nameArray[0];
            if(sizeof($nameArray) > 1){
               for($i = 1; $i<sizeof($nameArray); $i++){
                    $surname .= $nameArray[$i];
               }
               $obj->userSurname = $surname;  
            }else{
               $obj->userSurname = '-';   
            }
            $obj->dateActivity = date('Ymd', strtotime($row["service_date_time"]));
            $obj->partnerCode = $row["partner_code"];
            $obj->serviceProviderName = 'ARPRTZOERN';
            $obj->airportName = $row["location_name"];
            $obj->tierPoints = '0000000000';
            if($row["miles_cost"] != 0 && $row["miles_point"] != 0){
                // $excluServiceAmt = $row["net_amount"]*100/118;
                // $commissionAmtFromService = $excluServiceAmt*$row["commission_percentage"]/100;
                // $pointValue = round($commissionAmtFromService/$row["miles_cost"]*$row["miles_point"]);
                $obj->basePoints = $row["cv_earned"];
                $obj->bonusPoints = $row["cv_earned"];
            }else{
                $obj->basePoints = '0000000000';
                $obj->bonusPoints = '0000000000';
            }
            array_push($loyaltyArray, $obj); 
        }
        return $loyaltyArray;
    }
    function isLoyaltyDistributorName(){
        $query = "SELECT `token`, `name` FROM `service__distributor` WHERE `is_royalty`='1' AND `status`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $distName = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $obj = new stdClass(); 
          $obj->distributorToken = $row["token"];  
          $obj->distributorName = $row["name"];
            array_push($distName, $obj);
        }
        return $distName;
    }
    function isCreditAvailableForDistributor(){
        $query = "SELECT * FROM `service__distributor` WHERE `credit_available` > 0 AND `token` = :token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    public function getDistributorList(){
        $query = "SELECT `service__distributor`.`token`,
        `service__distributor`.`name`,
        `service__distributor_type`.`is_agent`
        FROM `service__distributor`
        INNER JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor`.`status`!='3' AND `service__distributor`.`token`!='1111111111'
        ORDER BY `service__distributor`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $distName = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $obj = new stdClass(); 
          $obj->distributorToken = $row["token"];  
          $obj->distributorName = $row["name"];
          $obj->is_agent = $row["is_agent"];
            array_push($distName, $obj);
        }
        return $distName;
    }
    function revenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor` ON
        `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount'];
    }
    function bookingCount(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT `users__booking_detail`.`id`
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor` ON
        `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function recentBooking(){
        $query="SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`date_time`,
        `airport`.`gmt`,
        `users__booking`.`status`,
        `users`.`name` AS `customer_name`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        COUNT(`users__booking_detail`.`token`) AS `services_count`,
        GROUP_CONCAT(`service__provider_company`.`name`,'|&&&&&|') AS `company_name`,
        GROUP_CONCAT(`business_type`.`name`,'|&&&&&|') AS `type_name`
        FROM `users__booking`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor`.`token`=:token
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`date_time` DESC
        LIMIT 0,10";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function recentBookingView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingToken = $row['token'];
            $obj->bookingNumber= $row['booking_number'];
            $obj->createdDate  = convertDate("d M, Y H:i",$row['date_time'])."(".$row['gmt'].")";
            $obj->customerName = $row['customer_name'];
            $obj->memberCount  = $row['member_count'];
            $obj->status       = $row['status'];
            $obj->servicesCount= $row['services_count'];
            /////$obj->companyName  = str_replace('|&&&&&|,', ' | ', rtrim($row['company_name'],'|&&&&&|') );
            /////$obj->typeName     = str_replace('|&&&&&|,', ' | ', rtrim($row['type_name'],'|&&&&&|') );
            array_push($array, $obj);
        }
        return $array;   
    }
    function topAirports(){
        $fromDate = $this->from_date;
        $toDate = $this->to_date;
        $searchQuery = "";
        if($fromDate!="" && $toDate!=""){
            $fromDate = date("Y-m-d 00:00:00", strtotime($fromDate) );
            $toDate = date("Y-m-d 23:59:59", strtotime($toDate) );
            $searchQuery = " AND `users__booking_detail`.`date_time` BETWEEN '$fromDate' AND '$toDate'";
        }else{
            $searchQuery = "";
        }
        $query="SELECT `airport`.`name`,
        `airport`.`code`,
        COUNT(`users__booking_detail`.`token`) AS `booking_count`
        FROM `service__distributor_airport`
        INNER JOIN `service__distributor` ON 
        `service__distributor`.`token`=`service__distributor_airport`.`service_distributor_token`
        INNER JOIN `airport` ON `airport`.`token`=`service__distributor_airport`.`airport_token`
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`airport_token`=`airport`.`token`
            $searchQuery
        )
        INNER JOIN `users__booking` ON (
        	`users__booking`.`token`=`users__booking_detail`.`booking_token`
            AND `users__booking`.`service_distributor_token`=`service__distributor_airport`.`service_distributor_token`
        )
        WHERE `service__distributor`.`token`=:token
        GROUP BY `airport`.`token`
        ORDER BY `booking_count` DESC
        LIMIT 0,6";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function topAirportsView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->airportName = $row['name'];
            $obj->airportCode = $row['code'];
            $obj->bookingCount= $row['booking_count'];
            $this->totalCount+= $row['booking_count'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function servicesData(){
        $query="SELECT 
        `business_type`.`token`,
        `business_type`.`name`
        FROM `users__booking` 
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
        )
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_airport`.`business_type_token`
        INNER JOIN `service__distributor` ON (
            `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        )
        WHERE `service__distributor`.`token`=:token
        GROUP BY `business_type`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    function serviceBookingCount($likeMatch,$businessTypeToken){
        $searchQuery = "";
        if($likeMatch!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$likeMatch%' ";
        }
        $query="SELECT 
        `business_type`.`name`
        FROM `users__booking` 
        INNER JOIN `users__booking_detail` ON (
            `users__booking_detail`.`booking_token`=`users__booking`.`token`
            $searchQuery
        )
        INNER JOIN `service__distributor_airport` ON (
        `service__distributor_airport`.`airport_token`=`users__booking_detail`.`airport_token`
         AND `service__distributor_airport`.`service_distributor_token`=`users__booking`.`service_distributor_token`
        )
        INNER JOIN `business_type` ON `business_type`.`token`=`service__distributor_airport`.`business_type_token`
        INNER JOIN `service__distributor` ON (
            `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        )
        WHERE `service__distributor`.`token`=:token
        AND `business_type`.`token`=:business_type_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->bindParam(":business_type_token", $businessTypeToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function servicesDataView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $array_range = $this->ranges;
            $obj = new stdClass;
            $obj->serviceType = $row['name'];
            $arrayMonths = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            $monthData   = [];
//            foreach($arrayMonths as $month){
            foreach($array_range as $range){
                $likeMatch     = $range;
                $obj1=new stdClass();
                $obj1->dates        = $likeMatch;
                $obj1->bookingcount = $this->serviceBookingCount($likeMatch,$row['token']);
                array_push($monthData, $obj1);
            }
            $obj->counts = $monthData;
            array_push($array, $obj);
        }
        return $array;  
    }
    function volumeData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = " AND `users__booking_detail`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT `users__booking_detail`.`id` 
        FROM `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `service__distributor` ON 
        `service__distributor`.`token`=`users__booking`.`service_distributor_token`
        WHERE `service__distributor`.`token`=:token
        $searchQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function distributorCreditViewAdmin(){
        $query = "SELECT 
        `service__distributor`.`credit_available`,
        COALESCE( SUM(`service__distributor_credit_logs`.`given_credit`),0) AS `total_credits`
        FROM `service__distributor`
        LEFT JOIN `service__distributor_credit_logs` ON
            `service__distributor_credit_logs`.`service_distributor_token`=`service__distributor`.`token`
        WHERE `service__distributor`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->totalCredits   = $row['total_credits'];
        if($row['credit_available']<0){
            $obj->creditAvailable= 0;
            $value = $row['credit_available']*(-1);
            $obj->usedCredits    = number_format($value, 2, '.', ''); 
        }else{
            $obj->creditAvailable= $row['credit_available'];
            $obj->usedCredits    = 0;
        }
        return $obj;
    }
    function websiteData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = "  AND `users__booking`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking`.`date_time`,
        `users__booking`.`status`,
        `users__passenger`.`name` AS `customer_name`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        COUNT(`users__booking_detail`.`token`) AS `services_count`,
        GROUP_CONCAT(`service__provider_company`.`name`,'|&&&&&|') AS `company_name`,
        GROUP_CONCAT(`business_type`.`name`,'|&&&&&|') AS `type_name`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `users__booking`.`membership_number`
        FROM `users__booking`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        LEFT JOIN `users__booking_passenger` ON (
        	`users__booking_passenger`.`booking_token`=`users__booking`.`token`
            AND `users__booking_passenger`.`passenger_type`='Contact'
        )
        LEFT JOIN `users__passenger` ON
        	`users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        WHERE `service__distributor`.`token`=:token AND `users__booking`.`is_agent`='0'
        $searchQuery
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`id` DESC";
        
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    function agentData(){
        $searchQuery = "";
        if($this->ranges!=""){
            $searchQuery = "  AND `users__booking`.`date_time` LIKE '$this->likeMatch%' ";
        }
        $query="SELECT 
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`payment_id`,
        `users__booking`.`date_time`,
        `users__booking`.`status`,
        `users`.`name` AS `customer_name`,
        `service__distributor_agent`.`name` AS `agent_name`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        COUNT(`users__booking_detail`.`token`) AS `services_count`,
        GROUP_CONCAT(`service__provider_company`.`name`,'|&&&&&|') AS `company_name`,
        GROUP_CONCAT(`business_type`.`name`,'|&&&&&|') AS `type_name`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `users__booking`.`membership_number`
        FROM `users__booking`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = `users__booking`.`service_distributor_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token`=`service__provider_company`.`business_type_token`
        INNER JOIN `service__distributor_agent` ON `service__distributor_agent`.`token`=`users__booking`.`agent_token`
        WHERE `service__distributor`.`token`=:token
        AND `users__booking`.`is_agent`='1' AND `users__booking`.`agent_token`!=''
        $searchQuery
        GROUP BY `users__booking`.`token`
        ORDER BY `users__booking`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>