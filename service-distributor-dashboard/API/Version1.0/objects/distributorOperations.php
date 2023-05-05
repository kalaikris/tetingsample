<?php
class operations extends Database {
    // object properties
    public $distributorToken;
    //public $stmt;
    public function distributorUserCheck(){
        $query = "SELECT `token` 
        FROM `service__distributor_employee` 
        WHERE `service_distributor_token`=:service_distributor_token ";
        //AND `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        //$stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    public function updateBrandingItems(){
        $query = "UPDATE `service__distributor` SET 
        `favicon_logo`=:favicon,
        `header_logo`=:header_logo,
        `footer_logo`=:footer_logo,
        `banner_image`=:banner_image,
        `poster_image`=:poster_image,
        `header_colour`=:header_colour,
        `header_text_colour`=:header_text_colour,
        `brand_colour`=:brand_colour,
        `secondary_colour`=:secondary_colour,
        `description`=:description
        WHERE `token`=:token";
        //`landing_banner_image`=:landing_banner_image,
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":favicon", $this->favicon);
        $stmt->bindParam(":header_logo", $this->logo);
        $stmt->bindParam(":footer_logo", $this->footerLogo);
        $stmt->bindParam(":banner_image", $this->bannerImage);
        //$stmt->bindParam(":landing_banner_image", $this->landingBannerImage);
        $stmt->bindParam(":poster_image", $this->posterImage);
        $stmt->bindParam(":header_colour", $this->headerColor);
        $stmt->bindParam(":header_text_colour", $this->headerTextColor);
        $stmt->bindParam(":brand_colour", $this->brandColor);
        $stmt->bindParam(":secondary_colour", $this->secondaryColor);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        return $stmt;
    }
    
    
    function getBrandingDetails(){
        $query = "SELECT `service__distributor`.`favicon_logo`,
        `service__distributor`.`header_logo`,
        `service__distributor`.`footer_logo`,
        `service__distributor`.`banner_image`,
        `service__distributor`.`poster_image`,
        `service__distributor`.`header_colour`,
        `service__distributor`.`header_text_colour`,
        `service__distributor`.`brand_colour`,
        `service__distributor`.`secondary_colour`,
        `service__distributor`.`description`
        FROM `service__distributor`
        WHERE `service__distributor`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->distributorToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->faviconLogo    = $row["favicon_logo"];
        $obj->headerLogo    = $row["header_logo"];
        $obj->footerLogo    = $row["footer_logo"];
        $obj->bannerImage   = $row["banner_image"];
        $obj->posterImage   = $row["poster_image"];
        $obj->headerColour  = $row["header_colour"];
        $obj->headerTextColour= $row["header_text_colour"];
        $obj->brandColour     = $row["brand_colour"];
        $obj->secondaryColour = $row["secondary_colour"];
        $obj->description   = $row["description"];
        return $obj;
    }
    
    function distributorDetailsCheck(){
        $query = "SELECT `service__distributor`.`favicon_logo`,
        `service__distributor`.`header_logo`,
        `service__distributor`.`footer_logo`,
        `service__distributor`.`name` AS `distributor_name`,
        `service__distributor_employee`.`name` AS `user_name`,
        `service__distributor_employee`.`profile_image`,
        GROUP_CONCAT(`business_type`.`name`) AS `business_type`,
        `service__distributor_employee`.`user_role_token`,
        `service__distributor_type`.`name` AS `distributor_type`,
        `service__distributor_type`.`is_agent`
        FROM `service__distributor_employee`
        LEFT JOIN `service__distributor` ON 
            `service__distributor`.`token`=`service__distributor_employee`.`service_distributor_token`
        LEFT JOIN `service__distributor_business` ON 
            `service__distributor_business`.`service_distributor_token`=`service__distributor`.`token`
        LEFT JOIN `business_type` ON `business_type`.`token`=`service__distributor_business`.`business_type_token`
        LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
        WHERE `service__distributor_employee`.`token`=:token
        AND `service__distributor_employee`.`service_distributor_token`=:service_distributor_token
        GROUP BY `service__distributor_employee`.`token`";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":service_distributor_token", $this->distributorToken);
        $stmt->bindParam(":token", $this->userToken);
        $stmt->execute();
        return $stmt;
    }
    function distributorDetailsView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->favicon_logo    = $row["favicon_logo"];
            $obj->headerLogo    = $row["header_logo"];
            $obj->footerLogo    = $row["footer_logo"];
            $obj->distributorName= $row["distributor_name"];
            $obj->userName      = $row["user_name"];
            $obj->profileImage  = $row["profile_image"];
            $obj->businessType  = $row["business_type"];
            $obj->distributorType= $row["distributor_type"];
            $obj->isAgent       = $row["is_agent"];
            $userRoleToken      = $row["user_role_token"];
            $obj->userRoleToken = $userRoleToken;
            $obj->roleModules   = $this->modules($row["user_role_token"]);
            array_push($array, $obj);
        }
        return $array;
    }
    function modules($token){
        $query = "SELECT 
        `service__distributor_user_role_modules`.`module_token`,
        `service__distributor_modules`.`name`
        FROM `service__distributor_user_role_modules` 
        INNER JOIN `service__distributor_modules` ON `service__distributor_modules`.`token`=`service__distributor_user_role_modules`.`module_token`
        WHERE `service__distributor_user_role_modules`.`status`='1'
        AND `service__distributor_user_role_modules`.`role_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $token);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->moduleToken = $row["module_token"];
            $obj->moduleName  = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
    function distributorModules(){
        $query = "SELECT 
        `role_modules`.`module_token`,
        `modules`.`name`
        FROM `service__distributor_user_role_modules` AS `role_modules`
        INNER JOIN `service__distributor_modules` AS `modules` ON `modules`.`token`=`role_modules`.`module_token`
        INNER JOIN `service__distributor_employee` AS `employee` ON `employee`.`user_role_token`=`role_modules`.`role_token`
        WHERE `role_modules`.`status`='1'
        AND `employee`.`token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->userToken);
        $stmt->execute();
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->moduleToken = $row["module_token"];
            $obj->moduleName  = $row["name"];
            array_push($array, $obj);
        }
        return $array;
    }
    
}
?>