<?php
class UsersBooking extends Database {
    // object properties
    public $id;
    public $token;
    public $service_distributor_token = '1111111111';
    public $booking_number;
    public $user_token;
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

    public $table_name = "users__booking";
    public $column_list = "`service__distributor`.`name` AS `distributor_name`,
    `service__distributor`.`primary_email` AS `distributor_email`,
    `service__distributor`.`header_logo`,
    `service__distributor`.`brand_colour`,
    `users__booking`.`id`,
    `users__booking`.`token`,
    `users__booking`.`booking_number`,
    `users__booking`.`user_token`,
    `users`.`name` AS `user_name`,
    CONCAT(`users`.`country_code`, `users`.`mobile_number`) AS `user_mobile`,
    `users`.`image` AS `user_image`,
    `users`.`email` AS `user_email`,
    `users__booking`.`for_others`,
    `users__booking`.`journey`,
    `users__booking`.`service_amount`,
    `users__booking`.`service_gst`,
    `users__booking`.`convenience_fee`,
    `users__booking`.`cf_tax`,
    `users__booking`.`total_amount`,
    `users__booking`.`currency`,
    `users__booking`.`payment_view`,
    `users__booking`.`discount_type`,
    `users__booking`.`coupon_type`,
    `users__booking`.`discount_amount`,
    `users__booking`.`coupon_token`,
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
    `users__booking`.`invoice_token`,
    `users__booking`.`service_distributor_token`,
    `users__booking`.`cancel_booking_invoice_pdf`, 
     GROUP_CONCAT(`users__booking_detail`.`cancelled_order_invoice`) AS `servicecancel_pdf`,
     GROUP_CONCAT(DISTINCT `users__booking_detail`.`token`, '|', `users__booking_detail`.`status`) AS `service_details`,
     COALESCE(`admin__cancel_charge`.`amount`, 0) AS `airportzo_cancel_fee`";

    // `users__booking`.`total_adult`,
    // `users__booking`.`total_children`,
    public $stmt;
    
    public function readForUser() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token` AND `service__distributor`.`status`=0
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`user_token`=:user_token
        GROUP BY `users__booking`.`id`
        ORDER BY `users__booking`.`id` DESC";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":user_token", $this->user_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    public function readMonthlyHistoryForUser() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token` AND `service__distributor`.`status`=0
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

    public function readForToken() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
        INNER JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
        LEFT JOIN `service__distributor` ON `service__distributor`.`token`=`users__booking`.`service_distributor_token` AND `service__distributor`.`status`=0
        LEFT JOIN `admin__cancel_charge` ON `admin__cancel_charge`.`amount` > 1
        WHERE `users__booking`.`token`=:token
        GROUP BY `users__booking`.`id`
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    public function cancelForToken() {
        $query = "UPDATE `" . $this->table_name . "`
            SET
                `status`='Cancelled',
                `cancel_booking_invoice_pdf`=:cancel_booking_invoice_pdf
            WHERE
                `users__booking`.`token`=:token";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":cancel_booking_invoice_pdf", $this->cancel_booking_invoice_pdf);

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
            `discount_type`=:discount_type,
            `coupon_type`=:coupon_type,
            `cart_coupon_type`=:cart_coupon_type,
            `discount_amount`=:discount_amount,
            `coupon_token`=:coupon_token,
            `total_service`=:total_service,
            `total_adult`=:total_adult,
            `total_children`=:total_children,
            `booking_type`=:booking_type,
            `status`=:status,
            `pancard_number`=:pancard_number,
            `e_ticket`=:e_ticket,
            `gst_name`=:gst_name,
            `gstin_number`=:gst_number,
            `description_one`=:description_one,
            `description_two`=:description_two,
            `payment_id`=:payment_id,
            `order_id`=:order_id,
            `signature`=:signature,
            `plink_id`=:plink_id,
            `invoice_token`=:invoice_token,
            `date_time`=:date_time,
            `invoice_pdf`=:invoice_pdf,
            `paymentlink_name`=:paymentlink_name,
            `paymentlink_mobile`=:paymentlink_mobile,
            `paymentlink_email`=:paymentlink_email,
            `paymentlink_description`=:paymentlink_description";
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
        $this->stmt->bindParam(":discount_type", $this->discount_type);
        $this->stmt->bindParam(":coupon_type", $this->coupon_type);
        $this->stmt->bindParam(":cart_coupon_type", $this->cart_coupon_type);
        $this->stmt->bindParam(":discount_amount", $this->discount_amount);
        $this->stmt->bindParam(":coupon_token", $this->coupon_token);
        $this->stmt->bindParam(":total_service", $this->total_service);
        $this->stmt->bindParam(":total_adult", $this->total_adult);
        $this->stmt->bindParam(":total_children", $this->total_children);
        $this->stmt->bindParam(":booking_type", $this->booking_type);
        $this->stmt->bindParam(":status", $this->status);
        $this->stmt->bindParam(":e_ticket", $this->e_ticket);
        $this->stmt->bindParam(":pancard_number", $this->pancard_number);
        $this->stmt->bindParam(":gst_name", $this->gst_name);
        $this->stmt->bindParam(":gst_number", $this->gst_number);
        $this->stmt->bindParam(":description_one", $this->description_one);
        $this->stmt->bindParam(":description_two", $this->description_two);
        $this->stmt->bindParam(":payment_id", $this->payment_id);
        $this->stmt->bindParam(":order_id", $this->order_id);
        $this->stmt->bindParam(":signature", $this->signature);
        $this->stmt->bindParam(":plink_id", $this->plink_id);
        $this->stmt->bindParam(":invoice_token", $this->invoice_token);
        $this->stmt->bindParam(":date_time", $this->date_time);
        $this->stmt->bindParam(":invoice_pdf", $this->invoice_pdf);
        $this->stmt->bindParam(":paymentlink_name", $this->plink_name);
        $this->stmt->bindParam(":paymentlink_mobile", $this->plink_mobile);
        $this->stmt->bindParam(":paymentlink_email", $this->plink_email);
        $this->stmt->bindParam(":paymentlink_description", $this->plink_desc);
    
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
            $service_dates = explode(",", trim($row['service_dates']));
            foreach ($service_dates as $service_date_key => $service_date) {
                $service_dates[$service_date_key] = date('d M Y', strtotime($service_date));
            }
            unset($service_date);

            $service_status_arr = [];
            $service_details = explode(",", trim($row['service_details']));
            foreach ($service_details as $service_detail) {
                $service_status = explode("|", $service_detail)[1];
                array_push($service_status_arr, $service_status);
            }

            $query = "SELECT `users__booking_detail`.`token`,`users__booking_detail`.`booking_token`,
                (
                    CASE 
                        WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Pending') > 0 THEN 'Pending'
                        WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Completed') > 0 THEN 'Completed'
                        WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Confirmed') > 0 THEN 'Confirmed'
                        WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Cancelled') > 0 THEN 'Cancelled'
                        WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Assign') > 0 THEN 'Upcoming'
                    	WHEN (SELECT COUNT(*) FROM `users__booking_detail` WHERE `users__booking_detail`.`booking_token`=`users__booking`.`token` and `users__booking_detail`.`status` = 'Ongoing') > 0 THEN 'Ongoing'
                    END) AS `status`
                FROM `users__booking_detail` INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token` WHERE `users__booking`.`token` = '" . $row['token'] . "' GROUP BY `users__booking_detail`.`booking_token`";
            $this->stmts = $this->conn->prepare($query);
            $this->stmts->execute();
            // $this->stmt->debugDumpParams();
            $checkrow = $this->stmts->fetch(PDO::FETCH_ASSOC);
            $status = $checkrow["status"];

            $discount_query = "SELECT 
            CASE WHEN `users__booking`.`discount_type`='0' AND `users__booking`.`coupon_type`='0' THEN COALESCE(`users__booking`.`discount_amount`,0)
            WHEN `users__booking`.`discount_type`='2' AND `users__booking`.`coupon_type`='1' THEN `users__booking`.`discount_amount`
            WHEN `users__booking`.`discount_type`='2' AND `users__booking`.`coupon_type`='2' THEN SUM(`users__booking_detail`.`discount_amount`) END AS 'total_discount_amt'
            FROM `users__booking`
            INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token`=`users__booking`.`token`
            WHERE `users__booking`.`token` = '" . $row['token'] . "' GROUP BY `users__booking`.`token`";
            $this->stmt1 = $this->conn->prepare($discount_query);
            $this->stmt1->execute();
            $discountrow = $this->stmt1->fetch(PDO::FETCH_ASSOC);
            $total_discount_amount = $discountrow["total_discount_amt"];

            $obj = new stdClass;
            $obj->services_status = $service_status_arr;
            $obj->total_discount_amt = trim($total_discount_amount);
            $obj->distributor_name = trim($row['distributor_name']);
            $obj->distributor_email = trim($row['distributor_email']);
            $obj->header_logo = trim($row['header_logo']);
            $obj->brand_colour = trim($row['brand_colour']);
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->booking_number = trim($row['booking_number']);
            $obj->user_token = trim($row['user_token']);
            $obj->user_name = trim($row['user_name']);
            $obj->user_mobile = trim($row['user_mobile']);
            $obj->user_image = trim($row['user_image']);
            $obj->user_email = trim($row['user_email']);
            $obj->for_others = (trim($row['for_others']) == "1") ? true : false;
            $obj->journey = trim($row['journey']);
            $obj->service_amount = trim($row['service_amount']);
            $obj->service_gst = trim($row['service_gst']);
            $obj->convenience_fee = trim($row['convenience_fee']);
            $obj->cf_tax = trim($row['cf_tax']);
            $obj->total_amount = trim($row['total_amount']);
            $obj->currency = trim($row['currency']);
            $obj->payment_view = trim($row['payment_view']);
            $obj->discount_type = trim($row['discount_type']);
            $obj->coupon_type = trim($row['coupon_type']);
            $obj->discount_amount = trim($row['discount_amount']);
            $obj->coupon_token = trim($row['coupon_token']);
            $obj->total_service = trim($row['total_service']);
            $obj->total_adult = trim($row['total_adult']);
            $obj->total_children = trim($row['total_children']);
            $obj->service_dates = $service_dates;
            $obj->type = trim($row['type']);
            $obj->booking_type = trim($row['booking_type']);
            $obj->date_time = (trim($row['date_time']) != '') ? date('d M Y', strtotime(trim($row['date_time']))) : '';
            $obj->status = trim($status);
            $obj->e_ticket = trim($row['e_ticket']);
            $obj->pancard_number = trim($row['pancard_number']);
            $obj->gst_name = trim($row['gst_name']);
            $obj->gst_number = trim($row['gstin_number']);
            $obj->description_one = trim($row['description_one']);
            $obj->description_two = trim($row['description_two']);
            $obj->payment_id = trim($row['payment_id']);
            $obj->invoice_pdf = trim($row['invoice_pdf']);
            $obj->airportzo_cancel_fee = trim($row['airportzo_cancel_fee']);
            $obj->service_distributor_token = trim($row['service_distributor_token']);
            $obj->booking_invoice_token = trim($row['invoice_token']);
            $obj->agent_boolean = false;

            $serviceCancelledPDf = [];
            $servicecancel_pdf = explode(",", trim($row['servicecancel_pdf']));
            $cancel_booking_invoice_pdf = trim($row['cancel_booking_invoice_pdf']);
            foreach ($servicecancel_pdf as $servicecancelPDF) {
                if($servicecancelPDF!=''){
                    array_push($serviceCancelledPDf, $servicecancelPDF);
                }
            }
            if($cancel_booking_invoice_pdf!=''){
                array_push($serviceCancelledPDf, $cancel_booking_invoice_pdf);
            }
            $obj->serviceCancelledPDf = $serviceCancelledPDf;
            array_push($array, $obj);
        }
        return $array;
    }

    public function updatecouponbalance(){
        $query = "SELECT `users_per_coupon`,`balance_coupon_count` FROM `coupon` WHERE token=:coupon_token";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":coupon_token", $this->coupon_token);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if($row['balance_coupon_count'] < $row['users_per_coupon']){
            $row['balance_coupon_count'] += 1;
            $query ="UPDATE `coupon`
            SET
                `balance_coupon_count`=".$row['balance_coupon_count']."
            WHERE
                `token`=:coupon_token";
            $this->stmt = $this->conn->prepare( $query );
             // bind values
            $this->stmt->bindParam(":coupon_token", $this->coupon_token);
            // execute query
            // $this->stmt->debugDumpParams();
            return $this->stmt->execute() ? true : false;
        }
        
    }
}
?>