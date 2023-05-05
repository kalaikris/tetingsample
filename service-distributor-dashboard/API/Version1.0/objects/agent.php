<?php
class agent extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function userCheck(){
        $query = "SELECT `service_distributor_token` 
        FROM `service__distributor_employee`
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function userDistributorToken($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['service_distributor_token'];
    }
    public function checkAgentNumberExists(){
        $query21 = "SELECT `token` FROM `service__distributor_agent` WHERE `service_distributor_tokenIndex`=:service_distributor_token AND `mobile_number`=:mobile_number AND `status` IN ('1','3')";
        $stmt21 = $this->conn->prepare( $query21 );
        $stmt21->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt21->bindParam(":mobile_number", $this->primaryNumber);
        $stmt21->execute();
        return $stmt21;
    }
    public function addAgent(){
        $query = "INSERT INTO `service__distributor_agent` SET 
        `token`=:token,
        `service_distributor_tokenIndex`=:service_distributor_token,
        `agent_id`=:agent_id,
        `title`=:title,
        `name`=:name,
        `profile_image`=:profile_image,
        `date_of_birth`=:date_of_birth,
        `type_id`=:type_id,
        `website`=:website,
        `mobile_number`=:mobile_number,
        `email_id`=:email_id,
        `alter_mobile_number`=:alter_mobile_number,
        `alter_email_id`=:alter_email_id,
        `address`=:address,
        `country_id`=:country_id,
        `state_id`=:state_id,
        `city_id`=:city_id,
        `pin_code`=:pin_code,
        `commision_type`=:commision_type,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `branch`=:branch,
        `city`=:city,
        `pan_card`=:pan_card,
        `gst_certificate`=:gst_certificate,
        `msme_certificate`=:msme_certificate,
        `incorporation_certificate`=:incorporation_certificate,
        `void_cheque`=:void_cheque,
        `contract_agreement`=:contract_agreement,
        `other_document_one`=:other_document_one,
        `other_document_two`=:other_document_two,
        `date_time`=:date_time,
        `is_credit`=:is_credit";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->agentToken);
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":agent_id", $this->agentId);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":name", $this->agentName);
        $stmt->bindParam(":profile_image", $this->profileImage);
        $stmt->bindParam(":date_of_birth", $this->dateOfBirth);
        $stmt->bindParam(":type_id", $this->businessTypeId);
        $stmt->bindParam(":website", $this->websiteName);
        $stmt->bindParam(":mobile_number", $this->primaryNumber);
        $stmt->bindParam(":email_id", $this->primaryEmail);
        $stmt->bindParam(":alter_mobile_number", $this->alternateNumber);
        $stmt->bindParam(":alter_email_id", $this->alternateEmail);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":country_id", $this->countryId);
        $stmt->bindParam(":state_id", $this->stateId);
        $stmt->bindParam(":city_id", $this->cityId);
        $stmt->bindParam(":pin_code", $this->pincode);
        $stmt->bindParam(":commision_type", $this->commissionType);
        $stmt->bindParam(":account_number", $this->accountNumber);
        $stmt->bindParam(":ifsc_code", $this->ifscCode);
        $stmt->bindParam(":branch", $this->branch);
        $stmt->bindParam(":city", $this->bankCity);
        $stmt->bindParam(":pan_card", $this->panCard);
        $stmt->bindParam(":gst_certificate", $this->gstCertificate);
        $stmt->bindParam(":msme_certificate", $this->msmeCertificate);
        $stmt->bindParam(":incorporation_certificate", $this->incorporationCertificate);
        $stmt->bindParam(":void_cheque", $this->voidCheque);
        $stmt->bindParam(":contract_agreement", $this->contractAgreement);
        $stmt->bindParam(":other_document_one", $this->other_doc1);
        $stmt->bindParam(":other_document_two", $this->other_doc2);
        $stmt->bindParam(":date_time", $this->gmDateTime);
        $stmt->bindParam(":is_credit", $this->isCredit);
        $stmt->execute();
        return $stmt;
    } 
    public function checkAgentNumberExistsInUserTb(){
        $query2 = "SELECT `token` FROM `users` WHERE `service_distributor_token`=:service_distributor_token AND `mobile_number`=:mobile_number";
        $stmt2 = $this->conn->prepare( $query2 );
        $stmt2->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt2->bindParam(":mobile_number", $this->primaryNumber);
        $stmt2->execute();
        return $stmt2;
    }
    public function addAgentDetailsInUserTb(){    
            $query1 = "INSERT INTO `users` SET `token`=:token,
            `is_airportzo_user`='0',
            `service_distributor_token`=:service_distributor_token,
            `is_agent`='1',
            `is_approved`='1',
            `agent_token`=:agent_token,
            `title`=:title,
            `name`=:name,
            `image`=:image,
            `email`=:email,
            `country_code`=:primaryCountryCode,
            `mobile_number`=:mobile_number,
            `dob`=:dob,
            `address`=:address,
            `country_id`=:country_id,
            `state_id`=:state_id,
            `city_id`=:city_id,
            `pincode`=:pincode,
            `account_number`=:account_number,
            `ifsc_code`=:ifsc_code,
            `pan_card`=:pan_card,
            `address_proof`='',
            `date_time`=:date_time,
            `status`='1'";
            $stmt1 = $this->conn->prepare( $query1 );
            $stmt1->bindParam(":token", $this->agentUserToken);
            $stmt1->bindParam(":service_distributor_token", $this->distributorToken);
            $stmt1->bindParam(":agent_token", $this->agentToken);
            $stmt1->bindParam(":title", $this->title);
            $stmt1->bindParam(":name", $this->agentName);
            $stmt1->bindParam(":image", $this->profileImage);
            $stmt1->bindParam(":email", $this->primaryEmail);
            $stmt1->bindParam(":primaryCountryCode", $this->primaryCountryCode);
            $stmt1->bindParam(":mobile_number", $this->primaryNumber);
            $stmt1->bindParam(":dob", $this->dateOfBirth);
            $stmt1->bindParam(":address", $this->address);
            $stmt1->bindParam(":country_id", $this->countryId);
            $stmt1->bindParam(":state_id", $this->stateId);
            $stmt1->bindParam(":city_id", $this->cityId);
            $stmt1->bindParam(":pincode", $this->pincode);
            $stmt1->bindParam(":account_number", $this->accountNumber);
            $stmt1->bindParam(":ifsc_code", $this->ifscCode);
            $stmt1->bindParam(":pan_card", $this->panCard);
            $stmt1->bindParam(":date_time", $this->gmDateTime);
            $stmt1->execute();
       return $stmt1;
    }
    public function updateAgentDetailsInUserTb(){
        $updateQuery = "UPDATE `users` SET 
        `is_agent`='1', 
        `is_approved`='1', 
        `agent_token`=:agent_token,
        `title`=:title,
        `name`=:name,
        `image`=:image,
        `email`=:email,
        `country_code`=:primaryCountryCode,
        `dob`=:dob,
        `address`=:address,
        `country_id`=:country_id,
        `state_id`=:state_id,
        `city_id`=:city_id,
        `pincode`=:pincode,
        `account_number`=:account_number,
        `ifsc_code`=:ifsc_code,
        `pan_card`=:pan_card,
        `address_proof`='',
        `date_time`=:date_time,
        `status`='1'
        WHERE `service_distributor_token`=:service_distributor_token AND `mobile_number`=:mobile_number";
        $updateStmt = $this->conn->prepare( $updateQuery );
        $updateStmt->bindParam(":agent_token", $this->agentToken);
        $updateStmt->bindParam(":service_distributor_token", $this->distributorToken);
        $updateStmt->bindParam(":primaryCountryCode", $this->primaryCountryCode);
        $updateStmt->bindParam(":mobile_number", $this->primaryNumber);
        $updateStmt->bindParam(":title", $this->title);
        $updateStmt->bindParam(":name", $this->agentName);
        $updateStmt->bindParam(":image", $this->profileImage);
        $updateStmt->bindParam(":email", $this->primaryEmail);
        $updateStmt->bindParam(":dob", $this->dateOfBirth);
        $updateStmt->bindParam(":address", $this->address);
        $updateStmt->bindParam(":country_id", $this->countryId);
        $updateStmt->bindParam(":state_id", $this->stateId);
        $updateStmt->bindParam(":city_id", $this->cityId);
        $updateStmt->bindParam(":pincode", $this->pincode);
        $updateStmt->bindParam(":account_number", $this->accountNumber);
        $updateStmt->bindParam(":ifsc_code", $this->ifscCode);
        $updateStmt->bindParam(":pan_card", $this->panCard);
        $updateStmt->bindParam(":date_time", $this->gmDateTime);
        $updateStmt->execute();
        return $updateStmt; 
    }
    public function addCommission(){
        $query = "INSERT INTO `service__distributor_agent_commision` SET
        `token`=:token,
        `sd_agent_token`=:sd_agent_token,
        `percent`=:percent,
        `yearly_target`=:yearly_target,
        `commision_type`='1',
        `date_time`=:date_time,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->commisionToken);
        $stmt->bindParam(":sd_agent_token", $this->agentToken);
        $stmt->bindParam(":percent", $this->commissionRatePerBooking);
        $stmt->bindParam(":yearly_target", $this->yearlyTarget); 
        $stmt->bindParam(":date_time", $this->gmDateTime); 
        $stmt->execute();
        return $stmt;
    }
    public function addIncentive($token, $from, $to, $percent){
        $query = "INSERT INTO `service__distributor_agent_commision` SET
        `token`=:token,
        `sd_agent_token`=:sd_agent_token,
        `from_amount`=:from_amount,
        `to_amount`=:to_amount,
        `percent`=:percent,
        `commision_type`='2',
        `date_time`=:date_time,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":sd_agent_token", $this->agentToken);
        $stmt->bindParam(":from_amount", $from);
        $stmt->bindParam(":to_amount", $to); 
        $stmt->bindParam(":percent", $percent); 
        $stmt->bindParam(":date_time", $this->gmDateTime); 
        $stmt->execute();
        return $stmt;
    }
    public function agentDetails(){
        $query = "SELECT `service__distributor_agent`.`agent_id`,
        `service__distributor_agent`.`token`,
        `service__distributor_agent`.`title`,
        `service__distributor_agent`.`name`,
        `service__distributor_agent`.`profile_image`,
        `service__distributor_agent`.`date_time`,
        `service__distributor_agent`.`mobile_number`,
        `service__distributor_agent`.`email_id`,
        COUNT(`users__booking`.`token`) AS `service_count`,
        `service__distributor_agent`.`status`,
        `service__distributor_agent`.`is_credit` AS `booking_made`
        FROM `service__distributor_agent`
        LEFT JOIN `users__booking` ON `users__booking`.`agent_token`=`service__distributor_agent`.`token`
        WHERE `service_distributor_tokenIndex`=:service_distributor_token
        AND `service__distributor_agent`.`status`!='2' 
         GROUP BY `service__distributor_agent`.`token`
         ORDER BY `service__distributor_agent`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    public function agentDetailsView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->agentToken   = $row['token'];
            $obj->agentId      = $row['agent_id'];
            $obj->agentTitle    = $row['title'];
            $obj->name         = $row['name'];
            $obj->profileImage = $row['profile_image'];
            $obj->joinedDate   = convertDate("d M, 2022",$row['date_time']);
            $obj->mobileNumber = $row['mobile_number'];
            $obj->emailId      = $row['email_id'];
            $obj->servicesBooked= $row['service_count'];
            $obj->status = $row['status'];
            $obj->bookingMade  = $row['booking_made']=='1' ? 'Credits Booking' : 'Online Booking';
            array_push($array, $obj);
        }
        return $array;
    }
    public function agentTypeDetails(){
        $query = "SELECT `token`,
        `name`
        FROM `service__distributor_agent_type` 
        WHERE `is_active`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    public function agentTypeDetailsView($stmt){
        $array = [];
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token   = $row['token'];
            $obj->type    = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function singleAgentDetails(){
        $query = "SELECT 
        `service__distributor_agent`.`date_time`,
        `service__distributor_agent`.`profile_image`,
        `service__distributor_agent`.`title`,
        `service__distributor_agent`.`name`,
        `service__distributor_agent`.`date_of_birth`,
        `business_type`.`name` AS `business_type`,
        `service__distributor_agent`.`website`,
        `service__distributor_agent`.`mobile_number`,
        `service__distributor_agent`.`email_id`,
        `service__distributor_agent`.`alter_mobile_number`,
        `service__distributor_agent`.`alter_email_id`,
        `service__distributor_agent`.`address`,
        `countries`.`name` AS `country_name`,
        `regions`.`name` AS `state_name`,
        `cities`.`name` AS `city_name`,
        `service__distributor_agent`.`pin_code`,

        `service__distributor_agent`.`account_number`,
        `service__distributor_agent`.`ifsc_code`,
        `service__distributor_agent`.`branch`,
        `service__distributor_agent`.`city`,

        `service__distributor_agent`.`pan_card`,
        `service__distributor_agent`.`gst_certificate`,
        `service__distributor_agent`.`msme_certificate`,
        `service__distributor_agent`.`incorporation_certificate`,
        `service__distributor_agent`.`void_cheque`,
        `service__distributor_agent`.`contract_agreement`,
        `service__distributor_agent`.`commision_type`
        FROM `service__distributor_agent`
        LEFT JOIN `service__distributor_agent_type` AS `business_type` ON `business_type`.`token`=`service__distributor_agent`.`type_id`
        INNER JOIN `countries` ON `countries`.`id`=`service__distributor_agent`.`country_id`
        INNER JOIN `regions` ON `regions`.`id`=`service__distributor_agent`.`state_id`
        INNER JOIN `cities` ON `cities`.`id`=`service__distributor_agent`.`city_id`
        WHERE `service__distributor_agent`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->agentToken);
        $stmt->execute();
        return $stmt;
    }
    public function singleAgentDetailsView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->title        = $row['title'];
        $obj->name         = $row['name'];
        $obj->profileImage = $row['profile_image'];
        $obj->joinedDate   = convertDate("d M Y",$row['date_time']);
        $obj->dateOfBirth  = $row['date_of_birth'];
        $obj->businessType = $row['business_type'];
        $obj->website      = $row['website'];
        $obj->priMaryNumber= $row['mobile_number'];
        $obj->priMaryEmail = $row['email_id'];
        $obj->alternateNumber= $row['alter_mobile_number'];
        $obj->alternateEmail= $row['alter_email_id'];
        $obj->address      = $row['address'];
        $obj->countryName  = $row['country_name'];
        $obj->stateName    = $row['state_name'];
        $obj->cityName     = $row['city_name'];
        $obj->pinCode      = $row['pin_code'];
        $obj->accountNumber= $row['account_number'];
        $obj->ifscCode     = $row['ifsc_code'];
        $obj->bankBranch   = $row['branch'];
        $obj->bankCity     = $row['city'];
        $obj->panCard      = $row['pan_card'];
        $obj->gstCertificate   = $row['gst_certificate'];
        $obj->msmeCertificate  = $row['msme_certificate'];
        $obj->incorporationCertificate = $row['incorporation_certificate'];
        $obj->voidCheque       = $row['void_cheque'];
        $obj->contractAgreement= $row['contract_agreement'];
        $obj->commisionType    = $row['commision_type'];
        if($row['commision_type']==1){
            $obj->commisionDetails = $this->commissionDetails();
        }else{
            $obj->commisionDetails = $this->incentiveDetails();
        }
        $obj->serviceDetails = $this->serviceDetails();
        return $obj;
    }
    public function commissionDetails(){
        $array = [];
        $query = "SELECT `token`,
        `percent`,
        `yearly_target` 
        FROM `service__distributor_agent_commision` 
        WHERE `commision_type`='1' 
        AND `sd_agent_token`=:sd_agent_token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":sd_agent_token", $this->agentToken);
        $stmt->execute();
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token        = $row['token'];
            $obj->percent      = $row['percent'];
            $obj->yearlyTarget = $row['yearly_target'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function incentiveDetails(){
        $array = [];
        $query = "SELECT `token`,
        `from_amount`,
        `to_amount`,
        `percent` 
        FROM `service__distributor_agent_commision` 
        WHERE `commision_type`='2' 
        AND `sd_agent_token`=:sd_agent_token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":sd_agent_token", $this->agentToken);
        $stmt->execute();
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $obj=new stdClass();
            $obj->token      = $row['token'];
            $obj->fromAmount = $row['from_amount'];
            $obj->toAmount   = $row['to_amount'];
            $obj->percent    = $row['percent'];
            array_push($array, $obj);
        }
        return $array;
    }
    public function serviceDetails(){
        $array = [];
//        $query = "SELECT `token`,
//        `from_amount`,
//        `to_amount`,
//        `percent` 
//        FROM `service__distributor_agent_commision` 
//        WHERE `commision_type`='2' 
//        AND `sd_agent_token`=:sd_agent_token
//        AND `status`='1'";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam(":sd_agent_token", $this->agentToken);
//        $stmt->execute();
//        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
//            $obj=new stdClass();
//            $obj->token      = $row['token'];
//            $obj->fromAmount = $row['from_amount'];
//            $obj->toAmount   = $row['to_amount'];
//            $obj->percent    = $row['percent'];
//            array_push($array, $obj);
//        }
        return $array;
    }
    public function deleteAgent(){
        $query = "UPDATE `service__distributor_agent` SET 
        `status`='2' 
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->agentToken);
        $stmt->execute();
        return $stmt;
    }
    public function mobileNoExistForAgent(){
        $query = "SELECT `service__distributor_agent`.`token` FROM `service__distributor_employee`
        INNER JOIN `service__distributor_agent` ON `service__distributor_employee`.`service_distributor_token`=`service__distributor_agent`.`service_distributor_tokenIndex`
        WHERE `service__distributor_employee`.`token`=:userToken AND `service__distributor_agent`.`mobile_number`=:mobileNumber AND `service__distributor_agent`.`service_distributor_tokenIndex`=:distributorToken AND `service__distributor_agent`.`status` IN ('1','3')";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":userToken", $this->userToken);
        $stmt->bindParam(":mobileNumber", $this->mobileNumber);
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    public function agentCheck(){
        $query1 = "SELECT `agent_id`, `status` FROM `service__distributor_agent` WHERE `status`!='2' AND `token`=:agentToken";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(":agentToken", $this->agentToken);
        $stmt->execute();
        return $stmt;
    }
    public function updateAgentStatus(){
        $query1 = "UPDATE `service__distributor_agent` SET `status`=:agentStatus WHERE `token`=:agentToken";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(":agentStatus", $this->agentStatus);
        $stmt->bindParam(":agentToken", $this->agentToken);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateAgentProfile(){
        $query1 = "UPDATE `service__distributor_agent` SET
        `title`=:title,
        `name`=:name,
        `profile_image`=:profile_image,
        `mobile_number`=:mobile_number,
        `email_id`=:email_id
        WHERE `token`=:agentToken";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(":title", $this->agent_title);
        $stmt->bindParam(":name", $this->agent_name);
        $stmt->bindParam(":profile_image", $this->profile_image);
        $stmt->bindParam(":mobile_number", $this->mobile_no);
        $stmt->bindParam(":email_id", $this->email_id);
        $stmt->bindParam(":agentToken", $this->agentToken);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateAgentDetailsUserTb(){
        $query1 = "UPDATE `users` SET
        `title`=:title,
        `name`=:name,
        `image`=:profile_image,
        `country_code`=:country_code,
        `mobile_number`=:mobile_number,
        `email`=:email_id
        WHERE `agent_token`=:agentToken";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(":title", $this->agent_title);
        $stmt->bindParam(":name", $this->agent_name);
        $stmt->bindParam(":profile_image", $this->profile_image);
        $stmt->bindParam(":country_code", $this->country_code);
        $stmt->bindParam(":mobile_number", $this->mobile_no);
        $stmt->bindParam(":email_id", $this->email_id);
        $stmt->bindParam(":agentToken", $this->agentToken);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateAgentStatusUserTb(){
        $query1 = "UPDATE `users` SET
        `status`=:agentStatus
        WHERE `agent_token`=:agentToken";
        $stmt = $this->conn->prepare( $query1 );
        $stmt->bindParam(":agentToken", $this->agentToken);
        if($this->agentStatus=='3'){
            $this->agentStatus='2';
            $stmt->bindParam(":agentStatus", $this->agentStatus);
        } else if($this->agentStatus=='2') {
            $this->agentStatus='3';
            $stmt->bindParam(":agentStatus", $this->agentStatus);
        } else {
            $this->agentStatus='1';
            $stmt->bindParam(":agentStatus", $this->agentStatus);
        }
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>