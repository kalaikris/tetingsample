<?php
class employee extends Database{
    function employeeIdCheck(){
        $query = "SELECT `token` FROM `service__distributor_employee` 
        WHERE `business_id`=:business_id 
        AND `status`!='3'
        AND `service_distributor_token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('business_id', $this->businessId);
        $stmt->execute();
        return $stmt;
    }
    function addEmployee(){
        $query = "INSERT INTO `service__distributor_employee` SET `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`=:name,
        `email`=:email,
        `number`=:number,
        `profile_image`=:profile_image,
        `business_id`=:business_id,
        `password`=:password,
        `user_role_token`=:user_role_token,
        `status`='1',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->employeeToken);
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('number', $this->mobile);
        $stmt->bindParam('profile_image', $this->profilePic);
        $stmt->bindParam('business_id', $this->businessId);
        $stmt->bindParam('password', $this->password);
        $stmt->bindParam('user_role_token', $this->userRoleToken);
        $stmt->bindParam('date_time', $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function distributorEmployee(){
        $query = "SELECT 
        `service__distributor_employee`.`token`,
        `service__distributor_employee`.`name`,
        `service__distributor_employee`.`email`,
        `service__distributor_employee`.`number`,
        `service__distributor_employee`.`profile_image`,
        `service__distributor_employee`.`business_id`,
        `service__distributor_employee`.`user_role_token`,
        `service__distributor_user_role`.`name` AS `user_role`,
        `service__distributor_user_role`.`editstatus`,
        `service__distributor_employee`.`date_time`
        FROM `service__distributor_employee`
        INNER JOIN `service__distributor_user_role` ON 
        `service__distributor_user_role`.`token`=`service__distributor_employee`.`user_role_token`
        WHERE `service__distributor_employee`.`status`='1'
        AND `service__distributor_employee`.`service_distributor_token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->execute();
        return $stmt;
    }
    function distributorEmployeeView($stmt) {
        $array = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->employeeToken= $row['token'];
            $obj->name         = $row['name'];
            $obj->email        = $row['email'];
            $obj->number       = $row['number'];
            $obj->profileImage = $row['profile_image'];
            $obj->userRoleToken= $row['user_role_token'];
            $obj->userRole     = $row['user_role'];
            $obj->employeeId   = $row['business_id'];
            $obj->roleEditStatus= $row['editstatus'];
            $obj->createdDate   = convertDate("d M Y",$row['date_time']);
            
            array_push($array, $obj);
        }
        return $array;
    }
    function deleteEmployee(){
        $query = "UPDATE `service__distributor_employee` SET `status`='3'
        WHERE `token`=:token
        AND `service_distributor_token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->employeeToken);
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->execute();
        return $stmt;
    }
    function updateEmployee(){
        $query = "UPDATE `service__distributor_employee` SET
        `service_distributor_token`=:service_distributor_token,
        `name`=:name,
        `email`=:email,
        `number`=:number,
        `profile_image`=:profile_image,
        `user_role_token`=:user_role_token
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('name', $this->name);
        $stmt->bindParam('email', $this->email);
        $stmt->bindParam('number', $this->mobile);
        $stmt->bindParam('profile_image', $this->profilePic);
        $stmt->bindParam('user_role_token', $this->userRoleToken);
        $stmt->bindParam('token', $this->employeeToken);
        $stmt->execute();
        return $stmt;
    }
    public function generatePassword(){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ/abcdefghijklmnopqrstuvwxyz';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        return $randstring;
    }
}
?>