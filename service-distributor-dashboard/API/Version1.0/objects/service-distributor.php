<?php
class ServiceDistributor extends Database{
   public  $distributor_token;
    public $get_date;
    
    function getBusinessType(){
        $query = "SELECT `token`, `name` FROM `service__distributor_type`";
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
    
    function getCityList(){
      $query1 = "SELECT `id`, `name` FROM `cities` WHERE `name` != 'NULL' ORDER BY `id` LIMIT 10";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->execute();
        $city = [];
             while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $obj1 = new stdClass;
                $obj1->city_id = $row1['id'];
                $obj1->city_name = $row1['name'];
                array_push($city, $obj1);
            }
        return $city;
    }
    
    function getRegionsList(){
      $query2 = "SELECT `id`, `name`  FROM `regions` WHERE `name` !='' ORDER BY `id`";
        $stmt2 = $this->conn->prepare( $query2 );
        $stmt2->execute();
        $regions = [];
             while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $obj2 = new stdClass;
                $obj2->region_id = $row2['id'];
                $obj2->region_name = $row2['name'];
                array_push($regions, $obj2);
            }
        return $regions;
    }
    
    function getCountriesList(){
      $query3 = "SELECT `id`, `name` FROM `countries` ORDER BY `id`";
        $stmt3 = $this->conn->prepare( $query3 );
        $stmt3->execute();
        $country = [];
             while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $obj3 = new stdClass;
                $obj3->country_id = $row3['id'];
                $obj3->country_name = $row3['name'];
                array_push($country, $obj3);
            }
        return $country;
    }
    
    function getAirportList(){
      $query4 = "SELECT `token`, `name` FROM `airport` ORDER BY `id`";
        $stmt4 = $this->conn->prepare( $query4 );
        $stmt4->execute();
        $airport = [];
             while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                $obj4 = new stdClass;
                $obj4->airport_token = $row4['token'];
                $obj4->airport_name = $row4['name'];
                array_push($airport, $obj4);
            }
        return $airport;
    }
    
    function chooseServiceList(){
        $query5 = "SELECT `token`, `name` FROM `business_type` ORDER BY `id`";
        $stmt5 = $this->conn->prepare( $query5 );
        $stmt5->execute();
        $business_type = [];
             while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                $obj5 = new stdClass;
                $obj5->business_type_token = $row5['token'];
                $obj5->business_type_name = $row5['name'];
                array_push($business_type, $obj5);
            }
        return $business_type;
    }
        
    function getServiceAvailableAirport($serviceLists){
        $query5 = "SELECT
            `business_type`.`name` AS `business_type_name`, GROUP_CONCAT(DISTINCT`airport`.`token`,'***',`airport`.`name` ORDER BY `airport`.`id`) AS `airport_details`
        FROM
            `service__provider_company`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token` = `service__provider_company_location`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__provider_company`.`business_type_token`
        INNER JOIN `airport` ON `airport`.`token` = `service__provider_company_location`.`airport_token`
        WHERE `business_type`.`token` IN ($serviceLists) GROUP BY `business_type`.`token`";
        $stmt5 = $this->conn->prepare( $query5 );
        $stmt5->execute();
        $business_array = [];
        while($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)){
            $obj5 = new stdClass();
            $obj5->business_type = $row5["business_type_name"];
            $airport_details = $row5["airport_details"];
            $airport_array = [];
            $indiv_airport = explode(",",$airport_details);
                foreach($indiv_airport as $indiv_airport_data){
                    $obj6 = new stdClass();
                    $sep_airport = explode("***",$indiv_airport_data); 
                    $obj6->airport_token      = $sep_airport[0];
                    $obj6->airport_name     = $sep_airport[1];
                    array_push($airport_array, $obj6);
                }
           $obj5->airport_details = $airport_array;
        array_push($business_array, $obj5);
        }
        return $business_array;
    }
    
    function tokenGenerate(){
        $random = rand(1000000000,9999999999);
        $val=true;
        do{
            $query = "SELECT `id` FROM `service__provider_company` WHERE `token`=?";
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $random);
            $stmt->execute();
            if($stmt->rowCount()==0){
                $val = false;
            }else{
                $random = rand(1000000000,9999999999);
            }
        }while($val);
        return $random;
    }
    
    function addServiceDistributor($cur_date_time){
       $query = "INSERT INTO `service__distributor` SET
                `token`=:token,
                `service_distributor_type_token`=:service_distributor_type,
                `name`=:business_name,
                `site_name`=:business_website,
                `is_business_info`='0',
                `date_time`='$cur_date_time',
                `status`='0',
                `primary_email`=:primary_emailId,
                `country_code`=:primary_country_code,
                `primary_mobile_number`=:primary_mobile_number,
                `alternate_email`=:alternate_emailId,
                `alternate_country_code`=:alternate_country_code,
                `alternate_mobile_number`=:alternate_mobile_number,
                `address`=:address,
                `country_id`=:country_id,
                `state_id`=:state_id,
                `city_id`=:city_id,
                `pincode`=:pincode,
                `account_number`=:account_number,
                `ifsc_code`=:ifsc_code,
                `branch`=:branch,
                `city`=:city,
                `pan_card`=:pan_card,
                `gst_certificate`=:gst_certificate,
                `msme_certificate`=:msme_certificate,
                `incorporation_certificate`=:certificate_incorporation,
                `voide_cheque`=:void_cheque,
                `contract_agreement`=:contract_agreement";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->token);
        $stmt->bindParam('service_distributor_type', $this->service_distributor_type);
        $stmt->bindParam('business_name', $this->business_name);
        $stmt->bindParam('business_website', $this->business_website);
        $stmt->bindParam('primary_emailId', $this->primary_emailId);
        $stmt->bindParam('primary_country_code', $this->primary_country_code);
        $stmt->bindParam('primary_mobile_number', $this->primary_mobile_number);
        $stmt->bindParam('alternate_emailId', $this->alternate_emailId);
        $stmt->bindParam('alternate_country_code', $this->alternate_country_code);
        $stmt->bindParam('alternate_mobile_number', $this->alternate_mobile_number);
        $stmt->bindParam('address', $this->address);
        $stmt->bindParam('country_id', $this->country_id);
        $stmt->bindParam('state_id', $this->state_id);
        $stmt->bindParam('city_id', $this->city_id);
        $stmt->bindParam('pincode', $this->pincode);
        $stmt->bindParam('account_number', $this->account_number);
        $stmt->bindParam('ifsc_code', $this->ifsc_code);
        $stmt->bindParam('branch', $this->branch);
        $stmt->bindParam('city', $this->city);
        $stmt->bindParam('pan_card', $this->pan_card);
        $stmt->bindParam('gst_certificate', $this->gst_certificate);
        $stmt->bindParam('msme_certificate', $this->msme_certificate);
        $stmt->bindParam('certificate_incorporation', $this->certificate_incorporation);
        $stmt->bindParam('void_cheque', $this->void_cheque);
        $stmt->bindParam('contract_agreement', $this->contract_agreement);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


     function getDistributorBoooking($distributor_token,$get_date){
        $business_array = array();
         if($get_date == ''){
             $date = '';
         }else{
             $date = "AND `users__booking`.`date_time` LIKE '$get_date%'";
         }
          $query_booking = "SELECT
        `users__booking`.`order_id`,
        `users__booking_detail`.`service_date_time`,
        `users__booking`.`date_time` AS `bookedOn`,
        `users__passenger`.`name`,
        `users__passenger`.`mobile_number`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`service_name`,
        `users__booking_detail`.`token` as `booking_token`,
        `airport`.`name` AS `airport_name`,
        `airport`.`code` AS `airport_code`,
        `service__provider_company`.`name` AS `provider_name`,
        `airport__category`.`name` AS `category_name`,
        `airport__type`.`name` AS `type_name`
        FROM
            `users__booking_detail`
        INNER JOIN `users__booking` ON  `users__booking`.`token`= `users__booking_detail`.`booking_token` 
        INNER JOIN `service__distributor` ON `users__booking`.`service_distributor_token` = `service__distributor`.`token`
        INNER JOIN `airport` ON (`airport`.`token`=`users__booking_detail`.`airport_token`)
        INNER JOIN `service__provider_company` ON (`service__provider_company`.`token`=`users__booking_detail`.`company_token`)
        INNER JOIN `service__location` ON (`service__location`.`token`=`users__booking_detail`.`service_location_token`)
        INNER JOIN `airport__terminal_type_relation` ON (`airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`)
        INNER JOIN `airport__category` ON (`airport__category`.`token`=`airport__terminal_type_relation`.`category_token`)
        INNER JOIN `users__booking_passenger` ON (`users__booking_passenger`.`booking_token` = `users__booking`.`token` AND `users__booking_passenger`.`passenger_type`='Contact')
        INNER JOIN `users__passenger` ON `users__passenger`.`token` = `users__booking_passenger`.`user_passenger_token`
        INNER JOIN `airport__type` ON (`airport__type`.`token`=`airport__terminal_type_relation`.`type_token`)
        WHERE
            `service__distributor`.`token` = '$distributor_token'$date AND `users__booking`.`order_id` !=''  GROUP BY `users__booking_detail`.`token` ORDER BY `users__booking_detail`.`service_date_time` DESC";
             
        $stmt5 = $this->conn->prepare( $query_booking );
        $stmt5->execute();
        while($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)){
            $obj5 = new stdClass();
            $obj5->order_id = $row5["order_id"];
            $obj5->booking_token = $row5["booking_token"];
            $obj5->service_date_time = $row5["service_date_time"];
            $obj5->bookedOn = $row5["bookedOn"];
            $obj5->name = $row5["name"];
            $obj5->mobile_number = $row5["mobile_number"];
            $obj5->status = $row5["status"];
            $obj5->service_name = $row5["service_name"];
            $obj5->airport_name = $row5["airport_name"];
            $obj5->airport_code = $row5["airport_code"];
            $obj5->provider_name = $row5["provider_name"];
            $obj5->category_name = $row5["category_name"];
            $obj5->type_name = $row5["type_name"];
        array_push($business_array, $obj5);
        }
        return $business_array;

    }

     function update_Boooking_details($booking_token,$status){
        $update_query = "UPDATE `users__booking_detail` SET `status` ='$status'  WHERE `token` ='$booking_token' ";
         $stmt_update = $this->conn->prepare( $update_query );
        if($stmt_update->execute()){
            return true;
        }else{
            return false;
        }
     }

     function login_detail($distributor_token,$password){

        $login_query = "SELECT 1 FROM `service__distributor` WHERE `business_id` = '$distributor_token' AND `password` = '$password'";
         $stmt_login = $this->conn->prepare($login_query);
        $stmt_login->execute();
        if($stmt_login->rowCount() > 0){
            return true;
        }else{
            return false;
        }
     }

     function maildata($booking_token){
        $mail_array = array();
        $mail_conent = "SELECT
            `users__booking_detail`.`service_name`,
            `users__booking_detail`.`token`,
            `users__booking_detail`.`journey_date`,
            `users__booking`.`date_time` AS `bookedOn`,
            GROUP_CONCAT(
                `users__passenger`.`name`,
                '||',
                `users__passenger`.`date_of_birth`,
                '||', `users__booking_passenger`.`passenger_type` SEPARATOR '|&|'
            ) AS `passenger_details`,
            `users__booking`.`total_children`,
            `users__booking_detail`.`net_amount`,
            `users__booking`.`service_gst`,
            `users__booking`.`total_amount`,
            `users__booking_detail`.`journey`,
            `business_type`.`name` AS `business_name`,
            `users__booking`.`payment_id`,
            `users__booking_detail`.`service_date_time`,
            `users__booking_detail`.`flight_number`
        FROM
            `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `users__booking_detail`.`company_token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__provider_company`.`business_type_token`
        INNER JOIN `users__booking_passenger` ON `users__booking_passenger`.`booking_token` = `users__booking`.`token`
        INNER JOIN `users__passenger` ON `users__passenger`.`token` = `users__booking_passenger`.`user_passenger_token`
        WHERE
            `users__booking_detail`.`token` = '$booking_token'";

        $stmt_login = $this->conn->prepare($mail_conent);
        $stmt_login->execute();
         while($row5 = $stmt_login->fetch(PDO::FETCH_ASSOC))
         {
            $obj6 = new stdClass();
            $obj6->service_name = $row5['service_name'];
            $obj6->token = $row5['token'];
            $obj6->journey_date = date("d-M-Y", strtotime($row5['journey_date']) );
            $obj6->date_time =  date("d-M-Y", strtotime($row5['bookedOn']));
           // $obj6->service_date_time = date("d-M-Y", strtotime($row5['service_date_time']));
            $obj6->service_date_time = (trim($row5['service_date_time']) != '' && trim($row5['service_date_time']) != '0000-00-00 00:00:00' && trim($row5['service_date_time']) != '1970-01-01 05:30:00')? date('d M, Y H:i', strtotime(trim($row5['service_date_time']))): '-';
            $passenger_details = $row5['passenger_details'];
            $nameAndAge = explode("|&|",$passenger_details);
            $passanger_array = array();
            foreach ($nameAndAge as $key => $value) {
                $passanger_split = explode("||",$value);
                $passanger = new stdClass;
                if($passanger_split[2] != 'Greeter'){
                    $passanger->name =$passanger_split[0];
                    $passanger->age = (date('Y') - date('Y',strtotime($passanger_split[1])));
                    //$passanger->age =getTimeDifference($passanger_split[1]);
                    array_push($passanger_array,$passanger);
                }
            }
            $obj6->passanger_array = $passanger_array;

            $obj6->total_children = $row5['total_children'];
            $obj6->net_amount = $row5['net_amount'];
            $obj6->service_gst = $row5['service_gst'];
            $obj6->total_amount = $row5['total_amount'];
            $journey = $row5['journey'];
            $journey1 = $row5['journey'];
            // $firstElementNname1 = explode('-', $journey);
            $firstElementNname1 = explode('-', explode('&', $journey)[0]);
            $obj6->firstElementNname = $firstElementNname1[0];//array_shift($firstElementNname1);
            // $lastElementNname1 = explode('-', $journey1);
            $obj6->lastElementNname = $firstElementNname1[1];//end($lastElementNname1);
            $obj6->journey1 = $row5['journey'];
            $obj6->business_name = $row5['business_name'];
            $obj6->payment_id = $row5['payment_id'];
            $obj6->flight_number = $row5['flight_number'];

            array_push($mail_array, $obj6);
         }
         return $mail_array;

     }

     function getUserDetailForMail(){
//        $mailQuery = "SELECT `users__passenger`.`name` AS `user_name`,`users__passenger`.`email_id` AS `user_mail` FROM `users__booking_detail`
//        INNER JOIN `users__booking` ON `users__booking_detail`.`booking_token` = `users__booking`.`token`
//        INNER JOIN `users__passenger` ON `users__booking`.`user_token` = `users__passenger`.`user_token`
//        WHERE `users__booking_detail`.`token` =? limit 1";
         
         $mailQuery ="SELECT
            `users__passenger`.`name` AS `user_name`,
            `users__passenger`.`email_id` AS `user_mail`
        FROM
            `users__booking_detail`
        INNER JOIN `users__booking` ON `users__booking_detail`.`booking_token` = `users__booking`.`token`
        INNER JOIN `users__booking_passenger` ON (`users__booking`.`token` = `users__booking_passenger`.`booking_token`)

        INNER JOIN `users__passenger` ON `users__passenger`.`token` = `users__booking_passenger`.`user_passenger_token`

        WHERE
    `users__booking_detail`.`token` =? AND `users__booking_passenger`.`passenger_type`='Contact'";
        $stmt_mail = $this->conn->prepare( $mailQuery );
        $stmt_mail->bindParam(1, $this->booking_token);
        $stmt_mail->execute();
        $row5 = $stmt_mail->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->user_name = $row5["user_name"]; 
        $obj->user_mail_id = $row5["user_mail"];
        return $obj; 
     }

     function getBookingChannel(){
        $query = "SELECT `is_credit` FROM `service__distributor` WHERE `token`=:distributorToken";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":distributorToken", $this->distributorToken);
        $stmt->execute();
        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->is_credit = $row1["is_credit"]; 
        return $obj;  
     }




  

}
?>