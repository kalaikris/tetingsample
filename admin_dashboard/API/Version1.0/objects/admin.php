<?php
class admin extends Database {
    // object properties
    //public $distributorToken;
    //public $stmt;
    public function userCheck(){
        $query = "SELECT `token` 
        FROM `admin__user`
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->adminToken);
        $stmt->execute();
        return $stmt;
    }
    public function loginCheck(){
        $query = "SELECT `token`, `name` 
        FROM `admin__user`
        WHERE `email_id`=:email_id
        AND `password`=:password AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":email_id", $this->emailAddress);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        return $stmt;
    }
    public function readToken($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->username = $row['name'];
        $obj->token = $row['token'];
        return $obj;
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
    function userEmailCheck(){
        $query = "SELECT `token` FROM `admin__user` 
        WHERE `email_id`=:email_id 
        AND `status`!='3'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('email_id', $this->userEmail);
        $stmt->execute();
        return $stmt;
    }
    function userEmailCheckForgotPassword(){
        $query = "SELECT `name`, `email_id` FROM `admin__user` 
        WHERE `email_id`=:email_id 
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('email_id', $this->emailAddress);
        $stmt->execute();
        return $stmt;
    }
    function viewUserEmailCheckForgotPassword($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->name = $row["name"];
        $obj->email_id = $row["email_id"];
        return $obj;
    }
    function userEmailUpdateCheck(){
        $query = "SELECT `token` FROM `admin__user` 
        WHERE `email_id`=:email_id 
        AND `status`!='3'
        AND `token`!=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('email_id', $this->userEmail);
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function addUser(){
        $query = "INSERT INTO `admin__user` SET 
        `token`=:token,
        `name`=:name,
        `email_id`=:email_id,
        `password`=:password,
        `user_role_token`=:user_role_token,
        `date_time`=:date_time,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->bindParam('name', $this->userName);
        $stmt->bindParam('email_id', $this->userEmail);
        $stmt->bindParam('password', $this->password);
        $stmt->bindParam('user_role_token', $this->userRoleToken);
        $stmt->bindParam('date_time', $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function updateUser(){
        $query = "UPDATE `admin__user` SET
        `name`=:name,
        `email_id`=:email_id,
        `user_role_token`=:user_role_token
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('name', $this->userName);
        $stmt->bindParam('email_id', $this->userEmail);
        $stmt->bindParam('user_role_token', $this->userRoleToken);
         $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function userList(){
        $query = "SELECT `admin__user`.`token`,
        `admin__user`.`name`,
        `admin__user`.`email_id`,
        `admin__user`.`user_role_token`,
        `admin__user_roles`.`name` AS `role_name`,
        `admin__user`.`date_time`,
        `admin__user`.`status`
        FROM `admin__user`
        INNER JOIN `admin__user_roles` ON `admin__user_roles`.`token`=`admin__user`.`user_role_token`
        WHERE `admin__user`.`status`!='3'
        AND `admin__user`.`is_viewable`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function userListView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->userToken  = $row["token"];
            $obj->userName   = $row["name"];
            $obj->emailId    = $row["email_id"];
            $obj->roleToken  = $row["user_role_token"];
            $obj->roleName   = $row["role_name"];
            $obj->createdDate= convertDate("d M Y",$row["date_time"]);
            $obj->status     = $row["status"];
            array_push($array, $obj);
        }
        return $array;
    }
    function userModules(){
        $query = "SELECT `admin__modules`.`token`,
        `admin__modules`.`name`
        FROM `admin__user_roles_modules` 
        INNER JOIN `admin__modules` ON `admin__modules`.`token`=`admin__user_roles_modules`.`module_token`
        INNER JOIN `admin__user_roles` ON `admin__user_roles`.`token`=`admin__user_roles_modules`.`role_token`
        INNER JOIN `admin__user` ON `admin__user`.`user_role_token`=`admin__user_roles`.`token`
        WHERE `admin__user`.`token`=:token
        AND `admin__user_roles_modules`.`status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->adminToken);
        $stmt->execute();
        return $stmt;
    }
    function userModulesView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->userToken  = $row["token"];
            $obj->userName   = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
    function blockDeleteUser(){
        $query = "UPDATE `admin__user` SET 
        `status`=:status
        WHERE `token`=:token
        AND `is_viewable`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('status', $this->status);
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function userModuleCheck(){
        $query = "SELECT `admin__user`.`token` FROM `admin__user`
        INNER JOIN `admin__user_roles` ON (
            `admin__user_roles`.`token`=`admin__user`.`user_role_token`
            AND `admin__user_roles`.`status`='1'
        )
        INNER JOIN `admin__user_roles_modules` ON (
            `admin__user_roles_modules`.`role_token`=`admin__user_roles`.`token`
            AND `admin__user_roles_modules`.`status`='1'
        )
        WHERE `admin__user`.`token`=:token
        AND `admin__user_roles_modules`.`module_token`=:module_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->adminToken);
        $stmt->bindParam('module_token', $this->moduleToken);
        $stmt->execute();
        return $stmt;
    }
    function updateOtp(){
        $updateOtpQuery = "UPDATE `admin__user` SET `otp`=:otp WHERE `email_id`=:emailId AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('otp', $this->otp);
        $updateStmt->bindParam('emailId', $this->emailAddress);
        $updateStmt->execute();
        return $updateStmt;
    }
    function verifyOtp(){
        $verifyOtp = "SELECT `token` FROM `admin__user` WHERE `otp`=:otp AND `email_id`=:emailId AND `status`='1'";
        $verifyStmt = $this->conn->prepare( $verifyOtp );
        $verifyStmt->bindParam('otp', $this->otp);
        $verifyStmt->bindParam('emailId', $this->emailAddress);
        $verifyStmt->execute();
        return $verifyStmt;
    }
    function updateAdminPassword(){
        $updateOtpQuery = "UPDATE `admin__user` SET `password`=:newPassword WHERE `email_id`=:emailId AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('newPassword', $this->newPassword);
        $updateStmt->bindParam('emailId', $this->emailAddress);
        if($updateStmt->execute()){
           return true; 
        }else{
           return false; 
        }
    }
    function checkCurrentPassword(){
        $chQuery = "SELECT `token` FROM `admin__user` WHERE `token`=:adminToken AND `password`=:currentPassword";
        $chStmt = $this->conn->prepare( $chQuery );
        $chStmt->bindParam('adminToken', $this->adminToken);
        $chStmt->bindParam('currentPassword', $this->currentPassword);
        $chStmt->execute();
        return $chStmt; 
    }
    function updateAdminNewPassword(){
        $updateOtpQuery = "UPDATE `admin__user` SET `password`=:newPassword WHERE `token`=:adminToken AND `status`='1'";
        $updateStmt = $this->conn->prepare( $updateOtpQuery );
        $updateStmt->bindParam('newPassword', $this->newPassword);
        $updateStmt->bindParam('adminToken', $this->adminToken);
        if($updateStmt->execute()){
           return true; 
        }else{
           return false; 
        }
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
    function getServiceDistributorName(){
        $query = "SELECT `token`, `name` FROM `service__distributor` WHERE status='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $distributor_name = [];
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $obj = new stdClass;
                $obj->distributor_type_token = $row['token'];
                $obj->distributor_name = $row['name'];
                array_push($distributor_name, $obj);
            }
        return $distributor_name;
    }
    public function generatePassword(){
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ/0123456789abcdefghijklmnopqrstuvwxyz';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        return $randstring;
    }
}
?>