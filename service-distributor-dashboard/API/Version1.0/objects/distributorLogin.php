<?php
class login extends Database {
    // object properties
    public $businessId;
    public $password;
    //public $stmt;
    public function loginCheck(){
        $query = "SELECT `service__distributor_employee`.`token`,
        `service__distributor_employee`.`service_distributor_token`,
        `service__distributor`.`is_business_info`,
        `service__distributor_type`.`is_agent`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor_employee`.`business_id`=:business_id
        AND `service__distributor_employee`.`password`=:password AND `service__distributor`.`status`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->businessId);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        return $stmt;
    }
    public function businessIdCheck(){
        $query = "SELECT `service__distributor_employee`.`token`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        WHERE `service__distributor_employee`.`business_id`=:business_id AND `service__distributor`.`status`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->businessId);
        $stmt->execute();
        if($stmt->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }
    function loginView($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->distributorToken = $row['service_distributor_token'];
        $obj->userToken        = $row['token'];
        $obj->is_business_info = $row['is_business_info'];
        $obj->isAgent          = $row['is_agent'];
        return $obj;
    }
    
    function userBusinessIdCheck(){
        $query = "SELECT `business_id`, `name`, `email` FROM `service__distributor_employee` 
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
        $updateOtpQuery = "UPDATE `service__distributor_employee` SET `otp`=:otp WHERE `business_id`=:businessId AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('otp', $this->otp);
        $updateStmt->bindParam('businessId', $this->businessId);
        $updateStmt->execute();
        return $updateStmt;
    }
    function verifyOtp(){
        $verifyOtp = "SELECT `token` FROM `service__distributor_employee` WHERE `otp`=:otp AND `business_id`=:businessId AND `status`='1'";
        $verifyStmt = $this->conn->prepare( $verifyOtp );
        $verifyStmt->bindParam('otp', $this->otp);
        $verifyStmt->bindParam('businessId', $this->businessId);
        $verifyStmt->execute();
        return $verifyStmt;
    }
    function updateDistributorPassword(){
        $updateOtpQuery = "UPDATE `service__distributor_employee` SET `password`=:newPassword WHERE `business_id`=:businessId AND `status`='1'";
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
        $checkQuery = "SELECT `token` FROM `service__distributor_employee` WHERE `service_distributor_token`=:distributorToken AND `token`=:userToken AND `status`='1'";
        $checkStmt = $this->conn->prepare( $checkQuery );
        $checkStmt->bindParam('distributorToken', $this->distributorToken);
        $checkStmt->bindParam('userToken', $this->userToken);
        $checkStmt->execute();
        return $checkStmt; 
    }
    function checkCurrentPassword(){
        $checkCurQuery = "SELECT `token` FROM `service__distributor_employee` WHERE `service_distributor_token`=:distributorToken AND `token`=:userToken AND `password`=:currentPassword AND `status`='1'";
        $checkCurStmt = $this->conn->prepare( $checkCurQuery );
        $checkCurStmt->bindParam('distributorToken', $this->distributorToken);
        $checkCurStmt->bindParam('userToken', $this->userToken);
        $checkCurStmt->bindParam('currentPassword', $this->currentPassword);
        $checkCurStmt->execute();
        return $checkCurStmt; 
    }
    function updateDistributorNewPassword(){
        $updateOtpQuery = "UPDATE `service__distributor_employee` SET `password`=:newPassword WHERE `service_distributor_token`=:distributorToken AND `token`=:userToken AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('newPassword', $this->newPassword);
        $updateStmt->bindParam('distributorToken', $this->distributorToken);
        $updateStmt->bindParam('userToken', $this->userToken);
        if($updateStmt->execute()){
           return true; 
        }else{
           return false; 
        }
    }
    public function checkorganization(){
        $query = "SELECT
        `service__distributor`.`is_external`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor_employee`.`business_id`=:business_id
        AND `service__distributor`.`is_external`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->businessId);
        $stmt->execute();
        return $stmt;
    }
}
?>