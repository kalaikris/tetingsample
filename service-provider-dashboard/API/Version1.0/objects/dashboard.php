<?php
class dashboard extends Database {
    //public $stmt;
    function revenue(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT COALESCE( SUM(`users__booking_detail`.`net_amount`),'0' ) AS `total_amount`,
        COALESCE( SUM(`users__booking_detail`.`markup_amount`),'0' ) AS `markup_total_amount`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        WHERE `service__provider_company_location`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_amount']-$row['markup_total_amount'];
    }
    function bookingCount(){
        $revenueQuery = $this->revenueQuery;
        $query="SELECT `users__booking_detail`.`id`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        WHERE `service__provider_company_location`.`token`=:token
        $revenueQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt->rowCount();
    }
    function ratingDetails(){
        $query="SELECT COUNT(`users__booking_detail`.`id`) AS `rated_users`,
        (SUM(`users__booking_detail`.`rating`)/ COUNT(`users__booking_detail`.`id`)) AS `avg_rating`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        WHERE `service__provider_company_location`.`token`=:token
        AND `review_date_time`!='0000-00-00 00:00:00'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        $obj->ratedUsers     = $row['rated_users'];
        if($row['rated_users']==0){
            $obj->averageRating  = 0;
        }else{
            $obj->averageRating  = $row['avg_rating'];
        }
        return $obj;
    }

    function starPercentage($star,$userCount){
        $query="SELECT COUNT(`users__booking_detail`.`id`) AS `rated_users`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        WHERE `service__provider_company_location`.`token`=:token
        AND `review_date_time`!='0000-00-00 00:00:00'
        AND `users__booking_detail`.`rating`='$star'";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj=new stdClass();
        if($userCount==0){
            $percentage     = 0;
        }else{
            $percentage     = round($row['rated_users']/$userCount*100);
        }
        return $percentage;
    }
//    
    function recentBooking(){
        $query="SELECT `users__booking_detail`.`token`,
        `users__booking_detail`.`date_time`,
        `users__booking`.`booking_number`,
        `users`.`name` AS `customer_name`,
        `airport`.`gmt`,
        CONCAT(
            `users__booking_detail`.`total_adult`,' Adult | ', `users__booking_detail`.`total_children` ,' Child'
        ) AS `member_count`,
        `users__booking_detail`.`net_amount`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`markup_amount`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        WHERE `service__provider_company_location`.`token`=:token
        ORDER BY `users__booking_detail`.`date_time` DESC
        LIMIT 0,10";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function recentBookingView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingDetailToken = $row['token'];
            $obj->bookingNumber      = $row['booking_number'];
            $obj->createdDate        = convertDate("d M, Y",$row['date_time']);
            $obj->createdTime        = convertDate("H:i",$row['date_time'])."(".$row['gmt'].")";
            $obj->customerName       = $row['customer_name'];
            $obj->memberCount        = $row['member_count'];
            $obj->amount             = $row['net_amount']-$row['markup_amount'];
            $obj->hours              = "";
            $obj->status             = $row['status'];
            array_push($array, $obj);
        }
        return $array;   
    }
    function recentReviews(){
        $limitQuery  = $this->limitQuery;
        $searchQuery = $this->searchQuery;
        $query="SELECT 
        `users__booking_detail`.`token`,
        `users`.`name` AS `customer_name`,
        `users`.`image`,
        `users__booking_detail`.`review_date_time`,
        `users__booking_detail`.`rating`,
        `users__booking_detail`.`review`
        FROM `users__booking_detail`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        WHERE `service__provider_company_location`.`token`=:token
        AND `users__booking_detail`.`review_date_time`!='0000-00-00 00:00:00'
        $searchQuery
        ORDER BY `users__booking_detail`.`token` DESC
        $limitQuery";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt;
    }
    function recentReviewsView($stmt){
        $array=[];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->bookingDetailToken = $row['token'];
            $obj->customerName       = $row['customer_name'];
            $obj->customerImage      = $row['image'];
            $obj->rating             = $row['rating'];
            $obj->review             = $row['review'];
            $obj->createdDate        = convertDate("d M, Y",$row['review_date_time']);
            
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
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON (
            `service__provider_company_location`.`company_token`=`service__provider_company`.`token`
            AND `service__provider_company_location`.`airport_token`=`users__booking_detail`.`airport_token`
        )
        WHERE `service__provider_company_location`.`token`=:token
        $searchQuery
        ";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->serviceProviderLocationtoken);
        $stmt->execute();
        return $stmt->rowCount();
    }

}
?>