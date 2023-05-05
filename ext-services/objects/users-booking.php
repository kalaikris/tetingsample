<?php
class UsersBooking extends Database {
    // object properties
    public $id;
    public $token;
    public $service_distributor_token = '1111111111';
    public $booking_number;
    public $user_token;
    public $for_others = "0";
    public $users__booking;
    public $service_amount;
    public $service_gst;
    public $convenience_fee;
    public $cf_tax;
    public $total_amount;
    public $currency;
    public $payment_view;
    public $total_service;
    public $total_adult;
    public $total_children;
    public $type;
    public $booking_type;
    public $date_time;
    public $e_ticket;
    public $status;
    public $pancard_number;
    public $gst_name;
    public $gst_number;
    public $description_one;
    public $description_two;
    public $payment_id;
    public $order_id;
    public $signature;
    public $invoice_pdf;

    public $distributor_token = '1111111111';
    public $is_airportzo_user = 1;
    public $login_device = 'Web';

    public $month_filter;

    public $stmt;

    public $table_name = "users__booking";
    
    // `users`.`name` AS `user_name`,
    // CONCAT(`users`.`country_code`, `users`.`mobile_number`) AS `user_mobile`,
    // `users`.`email` AS `user_email`,

    // LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
    // LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
    public $column_list = "
        `service__distributor`.`name` AS `distributor_name`,
        `service__distributor`.`primary_email` AS `distributor_email`,
        `service__distributor`.`header_logo`,
        `service__distributor`.`brand_colour`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`,
        `users__booking`.`id`,
        `users__booking`.`for_others`,
        `users__booking`.`token`,
        `users__booking`.`booking_number`,
        `users__booking`.`user_token`,
        `users__booking`.`journey`,
        `users__booking`.`service_amount`,
        `users__booking`.`service_gst`,
        `users__booking`.`convenience_fee`,
        `users__booking`.`cf_tax`,
        `users__booking`.`total_amount`,
        `users__booking`.`currency`,
        `users__booking`.`payment_view`,
        `users__booking`.`total_service`,
        MAX(`users__booking_detail`.`total_adult`) AS `total_adult`,
        MAX(`users__booking_detail`.`total_children`) AS `total_children`,
        GROUP_CONCAT(DISTINCT DATE(`users__booking_detail`.`service_date_time`)) AS `service_dates`, 
        `users__booking`.`type`,
        `users__booking`.`booking_type`,
        `users__booking`.`date_time`,
        `users__booking`.`status`,
        `users__booking`.`e_ticket`,
        `users__booking`.`pancard_number`,
        `users__booking`.`gst_name`,
        `users__booking`.`gstin_number`,
        `users__booking`.`description_one`,
        `users__booking`.`description_two`,
        `users__booking`.`payment_id`,
        `users__booking`.`invoice_pdf`,
        `users__booking_detail`.`cancellation_fee`,
        `users__booking_detail`.`platform_fee`,
        `users__booking_detail`.`refunded_amount`,
        SUM(`users__booking_detail`.`az_sd_commision_amount`) AS `az_sd_commision_amount`,
        `users__booking_detail`.`az_sd_percentage`,
        COALESCE(`admin__cancel_charge`.`amount`, 0) AS `airportzo_cancel_fee`";

        // `users__booking`.`total_adult`,
        // `users__booking`.`total_children`,

    public function readForUser() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`user_token`=:user_token
        GROUP BY `users__booking`.`id`
        ORDER BY `users__booking`.`id` DESC";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":user_token", $this->user_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
    // LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
    public function readMonthlyHistoryForUser() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`user_token`=:user_token AND `users__booking`.`date_time` LIKE :month_filter
        GROUP BY `users__booking`.`id`
        ORDER BY `users__booking`.`id` DESC";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":month_filter", $this->month_filter);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    public function checkDuplicateOrder() {
        $query = "SELECT
            1
        FROM `" . $this->table_name . "`
        WHERE `users__booking`.`order_id`=:order_id
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":order_id", $this->order_id);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
    // LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
    public function readForToken() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`token`=:token
        GROUP BY `users__booking`.`id`
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
    // LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
    public function readForBookingNumber() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        LEFT JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users`.`service_distributor_token`
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`booking_number`=:booking_number
        GROUP BY `users__booking`.`id`
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query ); 
        
        $this->stmt->bindParam(":booking_number", $this->booking_number);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    public function cancelForToken() {
        $query = "UPDATE `" . $this->table_name . "`
            SET
                `status`='Cancelled'
            WHERE
                `users__booking`.`token`=:token";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);

        return ($this->stmt->execute())? true: false;
        // $this->stmt->debugDumpParams();
    }

    public function makeBookingNumber($starter) {
        $query = "SELECT
            `booking_number`
        FROM `" . $this->table_name . "`
        WHERE
            `users__booking`.`booking_number` LIKE '$starter%'
        ORDER BY
            `users__booking`.`id` DESC
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
    }

    public function cancelBooking() {
        $query ="UPDATE `" . $this->table_name . "`
        SET
            `status`='Cancelled'
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function create() {
        $query ="INSERT INTO `" . $this->table_name . "`
        SET
            `token`=:token,
            `is_airportzo_user`=:is_airportzo_user,
            `service_distributor_token`=:service_distributor_token,
            `booking_number`=:booking_number,
            `user_token`=:user_token,
            `for_others`=:for_others,
            `journey`=:journey,
            `service_amount`=:service_amount,
            `service_gst`=:service_gst,
            `convenience_fee`=:convenience_fee,
            `cf_tax`=:cf_tax,
            `total_amount`=:total_amount,
            `currency`=:currency,
            `payment_view`=:payment_view,
            `total_service`=:total_service,
            `total_adult`=:total_adult,
            `total_children`=:total_children,
            `booking_type`=:booking_type,
            `pancard_number`=:pancard_number,
            `e_ticket`=:e_ticket,
            `gst_name`=:gst_name,
            `gstin_number`=:gst_number,
            `description_one`=:description_one,
            `description_two`=:description_two,
            `payment_id`=:payment_id,
            `order_id`=:order_id,
            `signature`=:signature,
            `date_time`=:date_time,
            `invoice_pdf`=:invoice_pdf,
            `cart_coupon_type`='No Coupon'";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":is_airportzo_user", $this->is_airportzo_user);
        $this->stmt->bindParam(":service_distributor_token", $this->service_distributor_token);
        $this->stmt->bindParam(":booking_number", $this->booking_number);
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":for_others", $this->for_others);
        $this->stmt->bindParam(":journey", $this->journey);
        $this->stmt->bindParam(":service_amount", $this->service_amount);
        $this->stmt->bindParam(":service_gst", $this->service_gst);
        $this->stmt->bindParam(":convenience_fee", $this->convenience_fee);
        $this->stmt->bindParam(":cf_tax", $this->cf_tax);
        $this->stmt->bindParam(":total_amount", $this->total_amount);
        $this->stmt->bindParam(":currency", $this->currency);
        $this->stmt->bindParam(":payment_view", $this->payment_view);
        $this->stmt->bindParam(":total_service", $this->total_service);
        $this->stmt->bindParam(":total_adult", $this->total_adult);
        $this->stmt->bindParam(":total_children", $this->total_children);
        $this->stmt->bindParam(":booking_type", $this->booking_type);
        $this->stmt->bindParam(":e_ticket", $this->e_ticket);
        $this->stmt->bindParam(":pancard_number", $this->pancard_number);
        $this->stmt->bindParam(":gst_name", $this->gst_name);
        $this->stmt->bindParam(":gst_number", $this->gst_number);
        $this->stmt->bindParam(":description_one", $this->description_one);
        $this->stmt->bindParam(":description_two", $this->description_two);
        $this->stmt->bindParam(":payment_id", $this->payment_id);
        $this->stmt->bindParam(":order_id", $this->order_id);
        $this->stmt->bindParam(":signature", $this->signature);
        $this->stmt->bindParam(":date_time", $this->date_time);
        $this->stmt->bindParam(":invoice_pdf", $this->invoice_pdf);
    
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return ($this->stmt->execute())? true: false;
    }

    // Users' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            // $service_dates = explode(",", trim($row['service_dates']));
            // foreach ($service_dates as $service_date_key => $service_date) {
            //     $service_dates[$service_date_key] = date('d M Y', strtotime($service_date));
            // }
            // unset($service_date);
            $price_detail = new stdClass;
            $price_detail->service_amount = trim($row['service_amount']);
            $price_detail->service_gst = trim($row['service_gst']);
            $price_detail->convenience_fee = trim($row['convenience_fee']);
            $price_detail->convenience_fee_gst = trim($row['cf_tax']);
            $price_detail->total_amount = trim($row['total_amount']);

            $obj = new stdClass;
            $obj->distributor_name = trim($row['distributor_name']);
            $obj->distributor_email = trim($row['distributor_email']);
            $obj->header_logo = trim($row['header_logo']);
            $obj->brand_colour = trim($row['brand_colour']);
            // $obj->id = trim($row['id']);
            // $obj->for_others = (trim($row['token']) == 1)? true: false;
            $commission_obj = new stdClass;
            $commission_obj->commission_percentage = trim($row['az_sd_percentage']);
            $commission_obj->total_commission_amount = trim($row['az_sd_commision_amount']);
            
            $obj->id = trim($row['token']);
            $obj->token = trim($row['token']);
            $obj->booking_number = trim($row['booking_number']);
            $obj->date_time = (trim($row['date_time'])!='')? date('d M Y', strtotime(trim($row['date_time']))): '';
            $obj->journey = trim($row['journey']);
            $obj->total_service = trim($row['total_service']);
            $obj->price_detail = $price_detail;
            $obj->status = $this->getBookingStatus($row['token']);
            $obj->commission = $commission_obj;
            $obj->notes = trim($row['description_one']);
            $obj->markup_type = trim($row['markup_type']);
            $obj->markup_value = trim($row['markup_value']);
            $obj->airportzo_cancel_fee = trim($row['airportzo_cancel_fee']);
            // $obj->service_amount = trim($row['service_amount']);
            // $obj->service_gst = trim($row['service_gst']);
            // $obj->convenience_fee = trim($row['convenience_fee']);
            // $obj->convenience_fee_gst = trim($row['cf_tax']);
            // $obj->total_amount = trim($row['total_amount']);
            // $obj->user_token = trim($row['user_token']);
            // $obj->user_name = trim($row['user_name']);
            // $obj->user_mobile = trim($row['user_mobile']);
            // $obj->user_email = trim($row['user_email']);
            $obj->currency = trim($row['currency']);
            // $obj->payment_view = trim($row['payment_view']);
            // $obj->total_adult = trim($row['total_adult']);
            // $obj->total_children = trim($row['total_children']);
            // $obj->service_dates = $service_dates;
            // $obj->type = trim($row['type']);
            // $obj->booking_type = trim($row['booking_type']);
            // $obj->e_ticket = trim($row['e_ticket']);
            // $obj->pancard_number = trim($row['pancard_number']);
            // $obj->gst_name = trim($row['gst_name']);
            // $obj->gst_number = trim($row['gstin_number']);
            // $obj->description_two = trim($row['description_two']);
            // $obj->payment_id = trim($row['payment_id']);
            // $obj->invoice_pdf = trim($row['invoice_pdf']);

            array_push($array, $obj);
        }
        return $array;
    }
    function getBookingStatus($booking_token){
        $query = "SELECT `users__booking_detail`.`token`,`users__booking_detail`.`booking_token`,
            (
                CASE 
                    WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Pending') > 0 THEN 'Pending'
                    WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Completed') > 0 THEN 'Completed'
                    WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Confirmed') > 0 THEN 'Confirmed'
                    WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Cancelled') > 0 THEN 'Cancelled'
                END) AS `status`
            FROM `users__booking_detail` INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token` WHERE `users__booking`.`token` = $booking_token GROUP BY `users__booking_detail`.`booking_token`";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->execute();
       // $this->stmt->debugDumpParams();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row["status"];
    }
}

?>