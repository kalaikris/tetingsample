<?php
class userRole extends Database{
    function userRoleNameCheck(){
        $query = "SELECT `token` FROM `service__distributor_user_role` 
        WHERE `service_distributor_token`=:service_distributor_token
        AND `name`=:name 
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('name', $this->userRoleName);
        $stmt->execute();
        return $stmt;
    }
    function addUserRole(){
        $query = "INSERT INTO `service__distributor_user_role` SET 
        `token`=:token,
        `service_distributor_token`=:service_distributor_token,
        `name`=:name,
        `created_date`=:created_date,
        `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userRoleToken);
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('name', $this->userRoleName);
        $stmt->bindParam('created_date', $this->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function addUserModules(){
        $array = $this->modulesTokenArray;
        foreach($array as $value){
            $insertvalue[]="(
                '$this->userRoleToken',
                '$value',
                '1',
                '$this->gmDateTime'
            )";
        }
        $query = "INSERT INTO `service__distributor_user_role_modules`(
        `role_token`, 
        `module_token`, 
        `status`, 
        `created_date`
        ) VALUES ".implode(", ", $insertvalue);
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    }
    
    function userRoleNameUpdateCheck(){
        $query = "SELECT `token` FROM `service__distributor_user_role` WHERE `service_distributor_token`=:service_distributor_token
        AND `name`=:name 
        AND `token`!=:token
        AND `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->bindParam('name', $this->userRoleName);
        $stmt->bindParam('token', $this->userRoleToken);
        $stmt->execute();
        return $stmt;
    }
    function updateUserRole(){
        $query = "UPDATE `service__distributor_user_role` SET 
        `name`=:name
        WHERE `token`=:token
        AND `service_distributor_token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('name', $this->userRoleName);
        $stmt->bindParam('token', $this->userRoleToken);
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->execute();
        return $stmt;
    }
    function updateUserModules(){
        $query1 = "UPDATE `service__distributor_user_role_modules` SET 
        `status`='2'
        WHERE `role_token`=:user_role_token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam('user_role_token', $this->userRoleToken);
        $stmt1->execute();
        $array = $this->modulesTokenArray;
        foreach($array as $value){
            $checkStmt = $this->checkRoleModule($value);
            if($checkStmt->rowCount()==0){
                $query = "INSERT INTO `service__distributor_user_role_modules` SET
                `role_token`=:user_role_token,
                `module_token`=:module_token,
                `status`='1',
                `created_date`=:created_date";
                $stmt = $this->conn->prepare( $query );
                $stmt->bindParam('user_role_token', $this->userRoleToken);
                $stmt->bindParam('module_token', $value);
                $stmt->bindParam('created_date', $this->gmDateTime);
                $stmt->execute();
            }else{
                $query = "UPDATE `service__distributor_user_role_modules` SET 
                `status`='1'
                WHERE `role_token`=:user_role_token
                AND `module_token`=:module_token";
                $stmt = $this->conn->prepare( $query );
                $stmt->bindParam('user_role_token', $this->userRoleToken);
                $stmt->bindParam('module_token', $value);
                $stmt->execute();
            }
        }
    }
    function checkRoleModule($moduleToken){
        $query = "SELECT `id` 
        FROM `service__provider_company_location_user_role_module` WHERE `service__provider_company_location_user_role_token`=:user_role_token 
        AND `module_token`=:module_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('user_role_token', $this->userRoleToken);
        $stmt->bindParam('module_token', $moduleToken);
        $stmt->execute();
        return $stmt;
    }
    function deleteUserRole(){
        $query = "UPDATE `service__distributor_user_role` SET 
        `status`='2'
        WHERE `token`=:token
        AND `service_distributor_token`=:service_distributor_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userRoleToken);
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->execute();
        return $stmt;
    }
    function userRoleList(){
        $query = "SELECT `user_role`.`token`,
        `user_role`.`name`,
        `user_role`.`created_date`,
        `user_role`.`editstatus`,
        GROUP_CONCAT(`user_role_module`.`module_token`) AS `module_token`,
        COUNT(`modules`.`id`) AS `module_count`,
        GROUP_CONCAT(`modules`.`name`) AS `module_name`
        FROM `service__distributor_user_role`  AS `user_role`
        INNER JOIN `service__distributor_user_role_modules` AS `user_role_module` ON
        (
            `user_role_module`.`role_token`=`user_role`.`token`
            AND `user_role_module`.`status`='1'
        )
        INNER JOIN `service__distributor_modules` AS `modules` ON `modules`.`token`=`user_role_module`.`module_token` 
        WHERE `user_role`.`service_distributor_token`=:service_distributor_token
        AND `user_role`.`status`='1'
        AND `user_role`.`editstatus`='1'
        GROUP BY `user_role`.`token`
        ORDER BY `user_role`.`id` DESC";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('service_distributor_token', $this->serviceDistributorToken);
        $stmt->execute();
        return $stmt;
    }
    function userRoleListView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->roleToken  = $row["token"];
            $obj->roleName   = $row["name"];
            $obj->moduleToken= $row["module_token"];
            if($row['module_count']==11){
                $obj->moduleName = "All modules";
            }else{
                $obj->moduleName = $row["module_name"];
            }
            $obj->createdDate= convertDate("d M Y",$row["created_date"]);
            $obj->editstatus = $row["editstatus"];
            //$obj->roleModules  = $this->modules($row["token"]);
            array_push($array, $obj);
        }
        return $array;
    }
//    function modules($token){
//        $query = "SELECT 
//        `service__provider_company_location_user_role_module`.`module_token`,
//        `modules`.`module_name`
//        FROM `service__provider_company_location_user_role_module` 
//        INNER JOIN `modules` ON `modules`.`token`=`service__provider_company_location_user_role_module`.`module_token`
//        WHERE `service__provider_company_location_user_role_module`.`status`='1'
//        AND `service__provider_company_location_user_role_token`=:token";
//        $stmt = $this->conn->prepare( $query );
//        $stmt->bindParam('token', $token);
//        $stmt->execute();
//        $array=[];
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//            $obj = new stdClass();
//            $obj->moduleToken = $row["module_token"];
//            $obj->moduleName  = $row["module_name"];
//            array_push($array, $obj);
//        }
//        return $array;
//    }

    function distributorModules(){
        $query = "SELECT `token`,
        `name` 
        FROM `service__distributor_modules` 
        WHERE `status`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function distributorModuleView($stmt) {
        $array = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->moduleToken  = $row['token'];
            $obj->moduleName   = $row['name'];
            array_push($array, $obj);
        }
        return $array;
    }
}
?>