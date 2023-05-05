<?php
class providerApp extends Database{
    function privacyPolicy(){
        $query = "SELECT `service__provider_company_location`.`terms_conditions`,
        `service__provider_company_location`.`airport_token`,
        `service__provider_company_location`.`company_token`,
        
        `service__provider_company_location`.`privacy_policy`,
        `service__provider_company_location`.`about`,
        
        `staffs`.`name`,
        `staffs`.`country_code`,
        `staffs`.`mobile_number`,
        `staffs`.`image`,
        `service__provider_company_location_user_role`.`name` AS `user_role`
        FROM `service__provider_company_location_staffs` AS `staffs`
        LEFT JOIN `service__provider_company_location` ON 
            `service__provider_company_location`.`token`=`staffs`.`service_provider_company_location_token`
        INNER JOIN `service__provider_company_location_user_role` ON `staffs`.`user_role_token`=   `service__provider_company_location_user_role`.`token` 
        WHERE `staffs`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $domainUrl    = "https://airportzo.net.in";
        $airportToken = $row["airport_token"];
        $companyToken = $row["company_token"];
        $obj->completedCount  = $this->completedCount;
        $obj->termsConditions = "$domainUrl/docs/terms.php?a=$airportToken&c=$companyToken";
        $obj->privacyPolicy   = "$domainUrl/docs/privacy.php?a=$airportToken&c=$companyToken";
        $obj->aboutUs         = "$domainUrl/docs/cancellation.php?a=$airportToken&c=$companyToken";
        $obj->name            = $row["name"];
        $obj->mobileNumber    = $row["country_code"]." ".$row["mobile_number"];
        $obj->image           = $row["image"];
        $obj->userRole        = $row["user_role"];
        return $obj;
    }
    function loginCheck(){
        $query = "SELECT `staff`.`token`
        FROM `service__provider_company_location_staffs` AS `staff`
        INNER JOIN `service__provider_company_location_user_role` AS `user_role` ON
            `user_role`.`token`=`staff`.`user_role_token`
        WHERE `user_role`.`is_mobile_app`='1'
        AND `staff`.`business_id`=:business_id
        AND `staff`.`password`=:password";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":business_id", $this->businessId);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();
        return $stmt;
    }
    function getToken($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['token'];
    }
    function getUserImage(){
        $query = "SELECT `image` FROM `service__provider_company_location_staffs` WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function readUserImage($stmt){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['image'];
    }
}
?>