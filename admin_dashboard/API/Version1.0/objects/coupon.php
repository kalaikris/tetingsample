<?php
class coupon extends Database {
   
    public function addCoupon($cur_date_time){
        $query = "INSERT INTO `coupon` SET
            `token`=:token,
            `coupon_type`=:coupon_type,
            `name`=:name,
            `status`='0',
            `description`=:description,
            `from_date`=:from_date,
            `to_date`=:to_date,
            `code`=:coupon_code,
            `generate`=:auto_generate,
            `quantity`=:coupon_qunaity,
            `coupon_length`=:coupon_length,
            `coupon_format`=:coupon_format,
            `coupon_prefix`=:coupon_prefix,
            `coupon_suffix`=:coupon_suffix,
            `users_per_coupon`=:usesper_coupon,
            `users_per_customer`=:usesper_customer,
            `discount_amount`=:cartDiscontAmount,
            `date_time`='$cur_date_time'";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":token", $this->token);
            $stmt->bindParam(":coupon_type", $this->coupon_type);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":from_date", $this->from_date);
            $stmt->bindParam(":to_date", $this->to_date);
            $stmt->bindParam(":coupon_code", $this->coupon_code);
            $stmt->bindParam(":auto_generate", $this->auto_generate);
            $stmt->bindParam(":coupon_qunaity", $this->coupon_qunaity);
            $stmt->bindParam(":coupon_length", $this->coupon_length);
            $stmt->bindParam(":coupon_format", $this->coupon_format);
            $stmt->bindParam(":coupon_prefix", $this->coupon_prefix);
            $stmt->bindParam(":coupon_suffix", $this->coupon_suffix);
            $stmt->bindParam(":usesper_coupon", $this->usesper_coupon);
            $stmt->bindParam(":usesper_customer", $this->usesper_customer);
            $stmt->bindParam(":cartDiscontAmount", $this->cartDiscontAmount);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function addCouponApplicableWebsite($applicable_website){
        $query = "INSERT INTO `coupon__applicable`(`token`, `coupon_token`, `website`, `distributor_token`) VALUES ".implode(", ", $applicable_website);
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    } 

    public function addCouponCondition($coupon_condition){
        $query = "INSERT INTO `coupon__condition`(`token`, `coupon_token`, `business_type_token`, `coupon_type`, `discount_amount`, `gst_type`, `coupon_condition`) VALUES".implode(", ", $coupon_condition);
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    }
     
   public function getCouponDetails(){
        $query = "SELECT
        `coupon`.`token`,
        `coupon`.`coupon_type`,
        `coupon`.`name`,
        `coupon`.`status`,
        `coupon`.`description`,
        `coupon`.`from_date`,
        `coupon`.`to_date`,
        `coupon`.`code`,
        `coupon`.`generate`,
        `coupon`.`quantity`,
        `coupon`.`coupon_length`,
        `coupon`.`coupon_format`,
        `coupon`.`coupon_prefix`,
        `coupon`.`coupon_suffix`,
        `coupon`.`users_per_coupon`,
        `coupon`.`users_per_customer`,
        `coupon`.`discount_amount`,
        `coupon`.`date_time`,
        GROUP_CONCAT(DISTINCT(CASE WHEN `coupon__applicable`.`website` = '0' THEN 'Website' 
                                   WHEN `coupon__applicable`.`website` = '1' THEN 'Whitelabel' END)) AS `website`,
        GROUP_CONCAT(DISTINCT(`coupon__applicable`.`website`)) AS `website_token`,                                
        GROUP_CONCAT(DISTINCT(`service__distributor`.`name`)) AS `distributor_name`,
        GROUP_CONCAT(DISTINCT(CASE WHEN `coupon__applicable`.`distributor_token` <> '0' THEN `coupon__applicable`.`distributor_token` END)) AS `distributor_token`, 
        CASE WHEN `coupon`.`coupon_type`='Category' THEN GROUP_CONCAT(DISTINCT CONCAT(`business_type`.`token`,'&&&&',`business_type`.`name`,'&&&&',`coupon__condition`.`coupon_type`,'&&&&',`coupon__condition`.`discount_amount`,'&&&&',`coupon__condition`.`token`,'&&&&',`coupon__condition`.`gst_type`),'****') WHEN `coupon`.`coupon_type`='Cart' THEN GROUP_CONCAT(DISTINCT CONCAT(`coupon__condition`.`coupon_type`,'&&&&',`coupon__condition`.`discount_amount`,'&&&&',`coupon__condition`.`gst_type`,'&&&&',`coupon__condition`.`coupon_condition`,'&&&&',`coupon__condition`.`token`),'****') END AS `coupon_condition`
        FROM `coupon`
        INNER JOIN `coupon__applicable` ON `coupon`.`token`=`coupon__applicable`.`coupon_token` AND `coupon__applicable`.`is_active_application`='0'
        LEFT JOIN `service__distributor` ON `coupon__applicable`.`distributor_token` = `service__distributor`.`token`
        INNER JOIN `coupon__condition` ON `coupon`.`token`=`coupon__condition`.`coupon_token` AND `coupon__condition`.`is_active_condition`='0'
        LEFT JOIN `business_type` ON `coupon__condition`.`business_type_token` = `business_type`.`token`
        WHERE `coupon`.`token`=:token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->token   = $row['token'];
        $obj->coupon_type  = $row['coupon_type'];
        $obj->name =  $row['name'];
        $obj->status =  $row['status']=='0'?'Active':'Inactive';
        $obj->description =  $row['description'];
        $obj->from_date =  date("d-m-Y",strtotime($row['from_date']));
        $obj->to_date =  date("d-m-Y",strtotime($row['to_date']));
        $obj->code =  $row['code'];
        $obj->generate =  $row['generate'];
        $obj->quantity =  $row['quantity'];
        $obj->coupon_length =  $row['coupon_length'];
        $obj->coupon_format =  $row['coupon_format'];
        $obj->coupon_prefix =  $row['coupon_prefix'];
        $obj->coupon_suffix =  $row['coupon_suffix'];
        $obj->users_per_coupon =  $row['users_per_coupon'];
        $obj->users_per_customer =  $row['users_per_customer'];
        $obj->cart_discount_amount =  $row['discount_amount'];
        $obj->date_time =  $row['date_time'];
        $obj->website =  $row['website'];
        $obj->website_array =  explode(",",$row['website_token']);
        $obj->distributor_name =  $row['distributor_name'];
        $rightTrim = rtrim($row["distributor_token"],',');
        $leftTrim = ltrim($rightTrim,',');
        $obj->distributor_name_array =  explode(",",$leftTrim);
        $coupon_string  = rtrim($row["coupon_condition"],'****');
        $coupon_condition_details = explode("****,",$coupon_string);
        $couponCondition    = [];
        foreach($coupon_condition_details as $couponData){
            $coupon_data = explode("&&&&",$couponData);
            $obj2 = new stdClass();
            if($row['coupon_type'] == 'Category'){
                $obj2->business_token   = $coupon_data[0];
                $obj2->business_name   = $coupon_data[1];
                $obj2->coupon_type     = $coupon_data[2];
                $obj2->discount_amount = $coupon_data[3];
                $obj2->condition_token = $coupon_data[4];
                $obj2->gst_type        = $coupon_data[5];
            }else if($row['coupon_type'] == 'Cart'){
                $obj2->coupon_type      = $coupon_data[0];
                $obj2->discount_amount  = $coupon_data[1];
                $obj2->gst_type         = $coupon_data[2];
                $obj2->coupon_condition = $coupon_data[3];
                $obj2->condition_token = $coupon_data[4];
            }
            array_push($couponCondition, $obj2); 
        }
        $obj->condition_apply = $couponCondition;
        return $obj;
    }
    
    public function getAllCouponList(){
        $query = "SELECT `token`, `coupon_type`, `name`, `from_date`, `to_date`, `code`, `date_time` FROM `coupon` WHERE `status`!='2'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $array = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj=new stdClass();
            $obj->token   = $row['token'];
            $obj->coupon_type  = $row['coupon_type'];
            $obj->name =  $row['name'];
            $obj->from_date =  $row['from_date'];
            $obj->to_date =  $row['to_date'];
            $obj->code =  $row['code'];
            $obj->date_time =  $row['date_time'];
            array_push($array, $obj);
        }
        return $array;
    }

    public function updateApplicableWebsite(){
        $query="UPDATE `coupon__applicable` SET
        `is_active_application`='1'
        WHERE `coupon_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        $array = $this->websiteValue;
        foreach ($array as $websiteValue) {
            if($websiteValue == '0' || $websiteValue == '2'){
                if( $this->applicableWebsiteCheck($websiteValue)){
                    $this->insertApplicableWebsite($websiteValue,'0');
                }else{
                    $this->applicableWebsiteUpdate($websiteValue);
                }
            }else if($websiteValue == '1'){
                if( $this->applicableWebsiteCheck($websiteValue)){
                    foreach($this->distributor_token as $distToken){
                        $this->insertApplicableWebsite($websiteValue,$distToken);
                    }
                }else{
                    foreach($this->distributor_token as $distToken){
                        if($this->applicableDistributorCheck($websiteValue,$distToken)){
                            $this->insertApplicableWebsite($websiteValue,$distToken);
                        }else{
                            $this->applicableDistributorUpdate($websiteValue,$distToken);  
                        } 
                    }
                } 
            }
            
        }
    }

    public function applicableWebsiteCheck($websiteValue){
        $query="SELECT `id` 
        FROM `coupon__applicable`
        WHERE `coupon_token`=:token
        AND `website`='$websiteValue'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }

    public function insertApplicableWebsite($websiteValue,$distValue){
        $aplica_token = $this->generateToken('coupon__applicable','token'); 
        $query="INSERT INTO `coupon__applicable` SET 
        `token`='$aplica_token',
        `coupon_token`=:token,
        `website`='$websiteValue',
        `distributor_token`='$distValue',
        `is_active_application`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
    }

    public function applicableWebsiteUpdate($websiteValue){
        $query="UPDATE `coupon__applicable` SET
        `is_active_application`='0'
        WHERE `coupon_token`=:token
        AND `website`='$websiteValue'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
    }

    public function applicableDistributorCheck($websiteValue, $distToken){
        $query="SELECT `id` 
        FROM `coupon__applicable`
        WHERE `coupon_token`=:token
        AND `website`='$websiteValue' AND `distributor_token`='$distToken'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }

    public function applicableDistributorUpdate($websiteValue,$distToken){
        $query="UPDATE `coupon__applicable` SET
        `is_active_application`='0'
        WHERE `coupon_token`=:token
        AND `website`='$websiteValue' AND `distributor_token`='$distToken'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
    }

    public function updateCouponCondition(){
        $query="UPDATE `coupon__condition` SET
        `is_active_condition`='1'
        WHERE `coupon_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        $con_array = $this->conditionValue;
        foreach ($con_array as $con_value) {
            if( $this->couponConditionCheck($con_value)){
                $this->insertCouponCondition($con_value);
            }else{
                $this->couponConditioneUpdate($con_value);
            } 
        }
    }

    public function couponConditionCheck($con_value){
        $query="SELECT `id` 
        FROM `coupon__condition`
        WHERE `token`=:conditionToken AND `coupon_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":conditionToken", $con_value->conditionToken);
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
        if($stmt->rowCount()==0){
            return true;
        }else{
            return false;
        }
    }

    public function insertCouponCondition($con_value){
        $con_token = $this->generateToken('coupon__condition','token'); 
        $query="INSERT INTO `coupon__condition` SET 
        `token`='$con_token',
        `coupon_token`=:token,
        `business_type_token`=:serviceType,
        `coupon_type`=:serviceCondition,
        `discount_amount`=:discountAmount,
        `gst_type`=:gstType,
        `coupon_condition`=:serviceAmt,
        `is_active_condition`='0'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":serviceType", $con_value->serviceType);
        $stmt->bindParam(":gstType", $con_value->gstType);
        $stmt->bindParam(":serviceAmt", $con_value->serviceAmt);
        $stmt->bindParam(":serviceCondition", $con_value->serviceCondition);
        $stmt->bindParam(":discountAmount", $con_value->discountAmount);
        $stmt->execute();
    }

    public function couponConditioneUpdate($con_value){
        $query="UPDATE `coupon__condition` SET
        `business_type_token`=:serviceType,
        `coupon_type`=:serviceCondition,
        `discount_amount`=:discountAmount,
        `gst_type`=:gstType,
        `coupon_condition`=:serviceAmt,
        `is_active_condition`='0'
        WHERE `token`=:conditionToken AND `coupon_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":serviceType", $con_value->serviceType);
        $stmt->bindParam(":gstType", $con_value->gstType);
        $stmt->bindParam(":serviceAmt", $con_value->serviceAmt);
        $stmt->bindParam(":serviceCondition", $con_value->serviceCondition);
        $stmt->bindParam(":discountAmount", $con_value->discountAmount);
        $stmt->bindParam(":conditionToken", $con_value->conditionToken);
        $stmt->bindParam(":token", $this->token);
        $stmt->execute();
    }

    public function generateToken($table,$column) {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        $query= "SELECT `id` FROM ".$table." WHERE ".$column." = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $randstring);
        $stmt->execute();
        $num  = $stmt->rowCount();
        return ($num==0) ? $randstring : generateToken();
    }

    public function updateCoupon(){
        $query = "UPDATE `coupon` SET 
        `name`=:name,
        `status`=:status,
        `description`=:description,
        `from_date`=:from_date,
        `to_date`=:to_date,
        `code`=:coupon_code,
        `generate`=:auto_generate,
        `quantity`=:coupon_qunaity,
        `coupon_length`=:coupon_length,
        `coupon_format`=:coupon_format,
        `coupon_prefix`=:coupon_prefix,
        `coupon_suffix`=:coupon_suffix,
        `users_per_coupon`=:usesper_coupon,
        `users_per_customer`=:usesper_customer,
        `discount_amount`=:cartDiscontAmount 
        WHERE `token`=:token";
         $stmt = $this->conn->prepare( $query );
         $stmt->bindParam(":name", $this->name);
         $stmt->bindParam(":status", $this->coupon_status);
         $stmt->bindParam(":description", $this->description);
         $stmt->bindParam(":from_date", $this->from_date);
         $stmt->bindParam(":to_date", $this->to_date);
         $stmt->bindParam(":coupon_code", $this->coupon_code);
         $stmt->bindParam(":auto_generate", $this->auto_generate);
         $stmt->bindParam(":coupon_qunaity", $this->coupon_qunaity);
         $stmt->bindParam(":coupon_length", $this->coupon_length);
         $stmt->bindParam(":coupon_format", $this->coupon_format);
         $stmt->bindParam(":coupon_prefix", $this->coupon_prefix);
         $stmt->bindParam(":coupon_suffix", $this->coupon_suffix);
         $stmt->bindParam(":usesper_coupon", $this->usesper_coupon);
         $stmt->bindParam(":usesper_customer", $this->usesper_customer);
         $stmt->bindParam(":cartDiscontAmount", $this->cartDiscontAmount);
         $stmt->bindParam(":token", $this->token);
         if($stmt->execute()){
             return true;
         }else{
             return false;
         }
    }

    function deleteCoupon(){
        $query="UPDATE `coupon` SET
        `status`='2'
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->token);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>