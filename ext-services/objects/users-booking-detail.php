<?php
class UsersBookingDetail extends Database {
    // object properties
    public $id;
    public $token;
    public $booking_token;
    public $airport_token;
    public $terminal_token;
    public $company_token;
    public $station_number;
    public $flight_number;
    public $airport_type;
    public $airport_category;
    public $service_date_time;
    public $service_token;
    public $service_name;
    public $service_type;
    public $service_location_tokenIndex;
    public $journey_date;
    public $journey;
    public $status;
    public $adult_service_amount;
    public $total_adult;
    public $children_service_amount;
    public $total_children;
    public $net_amount;
    public $date_time;
    public $notes;
    public $rating;
    public $review;
    public $refund_amount;
    public $review_date_time;
    public $description;
    public $report_reason_token;
    public $report_reason_description;

    public $distributor_token;

    public $table_name = "users__booking_detail";
    public $column_list = "
    `users__booking`.`user_token`,
    `users__booking_detail`.`id`,
    `users__booking_detail`.`token`,
    `users__booking_detail`.`booking_token`,
    `users__booking_detail`.`airport_token`,
    `airport`.`name` AS `airport_name`,
    `airport`.`code` AS `airport_code`,
    `users__booking_detail`.`terminal_token`,
    `airport__terminal`.`name` AS `terminal_name`,
    `users__booking_detail`.`company_token`,
    `service__provider_company`.`name` AS `company_name`,
    `service__provider_company`.`primary_email` AS `company_email`,
    `service__provider_company`.`logo` AS `company_logo`,
    `service__provider_company`.`image` AS `company_image`,
    `users__booking_detail`.`station_number`,
    `users__booking_detail`.`flight_number`,
    `users__booking_detail`.`airport_type`,
    `users__booking_detail`.`airport_category`,
    `users__booking_detail`.`service_date_time`,
    `users__booking_detail`.`service_token`,
    `users__booking_detail`.`service_name`,
    `users__booking_detail`.`service_type`,
    `users__booking_detail`.`service_location_token`,
    `users__booking_detail`.`journey_date`,
    `users__booking_detail`.`journey`,
    `users__booking_detail`.`status`,
    `users__booking_detail`.`adult_service_amount`,
    `users__booking_detail`.`additional_adult_service_amount`,
    `users__booking_detail`.`total_adult`,
    `users__booking_detail`.`children_service_amount`,
    `users__booking_detail`.`additional_children_service_amount`,
    `users__booking_detail`.`total_children`,
    `users__booking_detail`.`net_amount`,
    `users__booking_detail`.`notes`,
    `users__booking_detail`.`date_time`,
    `users__booking_detail`.`rating`,
    `users__booking_detail`.`review`,
    `users__booking_detail`.`review_date_time`,
    `users__booking_detail`.`comment`,
    `users__booking_detail`.`comment_date_time`,
    `users__booking_detail`.`description`,
    `users__booking_detail`.`report_reason_token`,
    `users__booking_detail`.`cancellation_hours`,
    `users__booking_detail`.`cancellation_fee`,
    `users__booking_detail`.`platform_fee`,
    `users__booking_detail`.`cancelled_date`,
    `users__booking_detail`.`cancelled_by`,
    `users__booking_detail`.`refunded_amount`,
    `users__booking_detail`.`refund_status`,
    `users__booking_detail`.`refunded_date`,
    `users__booking_detail`.`az_sp_commision_amount`,
    `users__booking_detail`.`az_sd_commision_amount`,
    `users__booking_detail`.`sp_balance_credit`,	
    `users__booking_detail`.`discount_amount`,	
    `users__booking_detail`.`is_coupon_service`,
    `users__booking_detail`.`az_sd_commision_amount`,
    `users__booking_detail`.`markup_amount`,
    COALESCE(`report_reason`.`reason`, '') AS `report_reason`,
    `users__booking_detail`.`report_description`,
    COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`,
    `users__booking_detail`.`reported_date` AS `reported_date_time`,
    COALESCE(`service__provider_company_location`.`reschedule_policy`, '') AS `reschedule_policy`,	
    `users__booking_detail`.`reported_date` AS `reported_date_time`,	
    `users__booking`.`currency`,	
    `users__booking`.`coupon_type`,	
    `users__booking`.`cart_coupon_type`,	
    `users__booking`.`discount_amount` AS `cart_dis_amt`,	
    `users__booking_detail`.`markup_amount`";
    public $stmt;

    public function readForBooking() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token`
        INNER JOIN `airport` ON `airport`.`token` = `users__booking_detail`.`airport_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`= `users__booking_detail`.`terminal_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token` AND `service__provider_company_location`.`airport_token`=`airport`.`token`
        LEFT JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token`=`service__provider_company_location`.`token` AND `service__provider_company_location_cancel_charge`.`status` = '1'
        LEFT JOIN `report_reason` ON `report_reason`.`token`=`users__booking_detail`.`report_reason_token`
        WHERE `users__booking_detail`.`booking_token`=:booking_token
        GROUP BY `users__booking_detail`.`id`
        ORDER BY `users__booking_detail`.`id`";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":booking_token", $this->booking_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }
    
    public function create() {
        $query ="INSERT INTO `" . $this->table_name . "`
        SET
            `token`=:token,
            `booking_token`=:booking_token,
            `airport_token`=:airport_token,
            `terminal_token`=:terminal_token,
            `company_token`=:company_token,
            `station_number`=:station_number,
            `flight_number`=:flight_number,
            `airport_type`=:airport_type,
            `airport_category`=:airport_category,
            `service_date_time`=:service_date_time,
            `service_token`=:service_token,
            `service_name`=:service_name,
            `service_type`=:service_type,
            `service_location_token`=:service_location_token,
            `journey_date`=:journey_date,
            `journey`=:journey,
            `adult_service_amount`=:adult_service_amount,
            `additional_adult_service_amount`=:additional_adult_service_amount,
            `total_adult`=:total_adult,
            `children_service_amount`=:children_service_amount,
            `additional_children_service_amount`=:additional_children_service_amount,
            `total_children`=:total_children,
            `date_time`=:date_time,
            `notes`=:notes,
            `net_amount`=:net_amount,
            `markup_type`=:markup_type,
            `markup_percentage`=:markupPercentage,
            `markup_amount`=:markupAmount,
            `az_sp_percentage`=:az_sp_percentage,
            `az_sp_commision_amount`=:az_sp_commision_amount,
            `sp_previous_credit`=:sp_previous_credit,
            `sp_balance_credit`=:sp_balance_credit,
            `az_sd_percentage`=:az_sd_percentage,
            `az_sd_commision_amount`=:az_sd_commision_amount,
            `sd_previous_credit`=:sd_previous_credit,
            `sd_balance_credit`=:sd_balance_credit";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":booking_token", $this->booking_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);
        $this->stmt->bindParam(":terminal_token", $this->terminal_token);
        $this->stmt->bindParam(":company_token", $this->company_token);
        $this->stmt->bindParam(":station_number", $this->station_number);
        $this->stmt->bindParam(":flight_number", $this->flight_number);
        $this->stmt->bindParam(":airport_type", $this->airport_type);
        $this->stmt->bindParam(":airport_category", $this->airport_category);
        $this->stmt->bindParam(":service_date_time", $this->service_date_time);
        $this->stmt->bindParam(":service_token", $this->service_token);
        $this->stmt->bindParam(":service_name", $this->service_name);
        $this->stmt->bindParam(":service_type", $this->service_type);
        $this->stmt->bindParam(":service_location_token", $this->service_location_token);
        $this->stmt->bindParam(":journey_date", $this->journey_date);
        $this->stmt->bindParam(":journey", $this->journey);
        $this->stmt->bindParam(":adult_service_amount", $this->adult_service_amount);
        $this->stmt->bindParam(":additional_adult_service_amount", $this->additional_price_adult);
        $this->stmt->bindParam(":total_adult", $this->total_adult);
        $this->stmt->bindParam(":children_service_amount", $this->children_service_amount);
        $this->stmt->bindParam(":additional_children_service_amount", $this->additional_price_children);
        $this->stmt->bindParam(":total_children", $this->total_children);
        $this->stmt->bindParam(":date_time", $this->date_time);
        $this->stmt->bindParam(":notes", $this->notes);
        $this->stmt->bindParam(":net_amount", $this->net_amount);
        $this->stmt->bindParam(":markup_type", $this->markup_type);
        $this->stmt->bindParam(":markupPercentage", $this->markupPercentage);
        $this->stmt->bindParam(":markupAmount", $this->markupAmount);
        $this->stmt->bindParam(":az_sp_percentage", $this->provider_commission_percentage);
        $this->stmt->bindParam(":az_sp_commision_amount", $this->provider_commission_amount);
        $this->stmt->bindParam(":sp_previous_credit", $this->previous_provider_credits);
        $this->stmt->bindParam(":sp_balance_credit", $this->balance_provider_credits);
        $this->stmt->bindParam(":az_sd_percentage", $this->distributor_commission_percentage);
        $this->stmt->bindParam(":az_sd_commision_amount", $this->distributor_commission_amount);
        $this->stmt->bindParam(":sd_previous_credit", $this->distributor_previous_credit);
        $this->stmt->bindParam(":sd_balance_credit", $this->distributor_balance_credit);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    public function updateReport() {
        $query ="UPDATE `" . $this->table_name . "`
        SET
            `report_reason_token`=:report_reason_token,
            `report_description`=:report_description,
            `reported_date`=:date_time
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":report_reason_token", $this->report_reason_token);
        $this->stmt->bindParam(":report_description", $this->report_description);
        $this->stmt->bindParam(":date_time", $this->date_time);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    public function updateReview() {
        $query ="UPDATE `" . $this->table_name . "`
        SET
            `rating`=:rating,
            `review`=:review,
            `review_date_time`=:review_date_time 
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":rating", $this->rating);
        $this->stmt->bindParam(":review", $this->review);
        $this->stmt->bindParam(":review_date_time", $this->review_date_time);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    public function cancelOrder() {
        $query ="UPDATE `" . $this->table_name . "`
        SET
            `status`='Cancelled',
            `cancellation_hours`=:cancellation_hours,
            `cancellation_fee`=:cancellation_fee,
            `cancellation_percentage`=:cancellation_percentage,
            `cancelled_by`='1',
            `cancelled_user_token`=:user_token,
            `cancelled_date`=:date_time,
            `refund_status`='Pending',
            `refunded_amount`=:refund_amount,
            `platform_fee`=:airportzo_cancellation_fee
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":cancellation_hours", $this->cancellation_hours);
        $this->stmt->bindParam(":cancellation_fee", $this->cancellation_fee);
        $this->stmt->bindParam(":cancellation_percentage", $this->cancellation_percentage);
        $this->stmt->bindParam(":refund_amount", $this->refund_amount);
        $this->stmt->bindParam(":airportzo_cancellation_fee", $this->airportzo_cancellation_fee);
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":date_time", $this->date_time);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    public function readReviews() {
        $query = "SELECT
                `users`.`title`,
                `users`.`name`,
                `users`.`image`,
                `users__booking_detail`.`rating`,
                `users__booking_detail`.`review`,
                `users__booking_detail`.`review_date_time`
            FROM
                `users__booking_detail`
            INNER JOIN `users__booking` ON `users__booking`.`token` = `users__booking_detail`.`booking_token`
            INNER JOIN `users` ON `users`.`token` = `users__booking`.`user_token`
            WHERE
                `users__booking_detail`.`airport_token` = :airport_token AND `users__booking_detail`.`company_token` = :company_token AND (`users__booking_detail`.`rating` > 0 OR `users__booking_detail`.`review` != '')
            GROUP BY
                `users__booking_detail`.`token`";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":airport_token", $this->airport_token);
        $this->stmt->bindParam(":company_token", $this->company_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    function makeReviewView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $title = trim($row['title']);
            $name = trim($row['name']);
            $name_view = 'Anonymous';
            if ($name != '') {
                $name_view = $name;
                // if ($title && $title!='' && $title!=NULL) {
                //     $name_view = $title . '.' . $name_view;
                // }
            }

            $obj = new stdClass;
            $obj->title = $title;
            $obj->name = $name;
            $obj->name_view = $name_view;
            $obj->image = trim($row['image']);
            $obj->rating = trim($row['rating']);
            $obj->review = trim($row['review']);
            $obj->review_date_time = date('d M, Y', strtotime(trim($row['review_date_time'])));

            array_push($array, $obj);
        }
        return $array;
    }

    // Users' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $cancel_charges_detail = (trim($row['cancel_charges']) != '')? explode("|&|", trim($row['cancel_charges'])): [];
            $cancel_charges_array = [];

            foreach ($cancel_charges_detail as $cancel_charges_key => $cancel_charges_value) {
                $cancel_policy = explode("||", $cancel_charges_value);

                $cancel_obj = new stdClass;
                $cancel_obj->hours_before_cancelling = $cancel_policy[1];
                $cancel_obj->cancellation_fee_percentage = $cancel_policy[2];
                array_push($cancel_charges_array, $cancel_obj);
            }
            unset($cancel_charges_value);

            // $station_detail = new stdClass;
            // $station_detail->airport_token = trim($row['airport_token']);
            // $station_detail->airport_name = trim($row['airport_name']);
            // $station_detail->airport_code = trim($row['airport_code']);
            // $station_detail->terminal_token = trim($row['terminal_token']);
            // $station_detail->terminal_name = trim($row['terminal_name']);

            $service_provider = new stdClass;
            // $service_provider->company_token = trim($row['company_token']);
            $service_provider->name = trim($row['company_name']);
            $service_provider->email = trim($row['company_email']);
            $service_provider->logo = trim($row['company_logo']);
            $service_provider->image = trim($row['company_image']);

            // $service_detail = new stdClass;
            // $service_detail->date_time = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['service_date_time']))): '-';
            // // $service_detail->token = trim($row['service_token']);
            // $service_detail->name = trim($row['service_name']);
            // $service_detail->type = trim($row['service_type']);

            $price_detail = new stdClass;
            $price_detail->adult_service_amount = trim($row['adult_service_amount']);
            $price_detail->total_adult = trim($row['total_adult']);
            $price_detail->children_service_amount = trim($row['children_service_amount']);
            $price_detail->total_children = trim($row['total_children']);
            $price_detail->net_amount = trim($row['net_amount']);
            $price_detail->cancellation_fee = trim($row['cancellation_fee']);
            $price_detail->platform_fee = trim($row['platform_fee']);
            $price_detail->refunded_amount = trim($row['refunded_amount']);

            $obj = new stdClass;
            $obj->user_token = trim($row['user_token']);
            // $obj->id = trim($row['id']);
            $obj->id = trim($row['token']);
            $obj->date_time = trim($row['date_time']);
            $obj->booking_token = trim($row['booking_token']);
            $obj->airport_token = trim($row['airport_token']);
            $obj->airport_category = trim($row['airport_category']);
            $obj->airport_type = trim($row['airport_type']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->airport_code = trim($row['airport_code']);
            $obj->terminal_token = trim($row['terminal_token']);
            $obj->terminal_name = trim($row['terminal_name']);
            $obj->service_name = trim($row['service_name']);
            $obj->service_type = trim($row['service_type']);
            $obj->service_date_time = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['service_date_time']))): '-';
            $obj->service_provider = $service_provider;
            $obj->price_detail = $price_detail;
            $obj->status = trim($row['status']);
            $obj->notes = trim($row['notes']);
            // $obj->service_detail = $service_detail;
            // $obj->station_detail = $station_detail;
            $obj->company_token = trim($row['company_token']);
            // $obj->company_name = trim($row['company_name']);
            // $obj->company_email = trim($row['company_email']);
            // $obj->company_logo = trim($row['company_logo']);
            // $obj->company_image = trim($row['company_image']);
            $obj->station_number = (int) trim($row['station_number']);
            // $obj->flight_number = trim($row['flight_number']);
            $obj->service_date_time_raw = trim($row['service_date_time']);
            // $obj->service_token = trim($row['service_token']);
            // $obj->service_location_token = trim($row['service_location_token']);
            // $obj->journey_date = (trim($row['journey_date']) != '' && trim($row['journey_date']) != '0000-00-00' && trim($row['journey_date']) != '1970-01-01')? date('d M, Y', strtotime(trim($row['journey_date']))): '-';
            // $obj->journey = trim($row['journey']);
            // $obj->adult_service_amount = trim($row['adult_service_amount']);
            // $obj->total_adult = trim($row['total_adult']);
            // $obj->children_service_amount = trim($row['children_service_amount']);
            // $obj->total_children = trim($row['total_children']);
            $obj->net_amount = trim($row['net_amount']);
            // $obj->rating = trim($row['rating']);
            // $obj->review = trim($row['review']);
            // $obj->description = trim($row['description']);
            // $obj->report_reason_token = trim($row['report_reason_token']);
            // $obj->report_reason = trim($row['report_reason']);
            // $obj->report_description = trim($row['report_description']);
            // $obj->reported_date_time = (trim($row['reported_date_time']) != '' && trim($row['reported_date_time']) != '0000-00-00' && trim($row['reported_date_time']) != '1970-01-01')? date('d M,Y h:i A', strtotime(trim($row['reported_date_time']))): '-';
            $obj->cancellation_policy_detail = $cancel_charges_array;
            $obj->az_sp_commision_amount = trim($row['az_sp_commision_amount']);
            $obj->az_sd_commision_amount = trim($row['az_sd_commision_amount']);
            $obj->currency = trim($row['currency']);
            $obj->markup_amount = trim($row['markup_amount']);

            array_push($array, $obj);
        }
        return $array;
    }
    function makeView1() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $net_amount = strval(trim($row['net_amount']));
            $cancellation_fee = intval(trim($row['cancellation_fee']));
            $cancel_charges_detail = (trim($row['cancel_charges']) != '')? explode("|&|", trim($row['cancel_charges'])): [];
            $cancel_charges_array = [];

            foreach ($cancel_charges_detail as $cancel_charges_key => $cancel_charges_value) {
                $cancel_policy = explode("||", $cancel_charges_value);

                $cancel_obj = new stdClass;
                $cancel_obj->hours_before_cancelling = $cancel_policy[1];
                $cancel_obj->cancellation_fee_percentage = $cancel_policy[2];
                array_push($cancel_charges_array, $cancel_obj);
            }
            unset($cancel_charges_value);

            $cancel_detail = new stdClass;
            $cancel_detail->cancellation_hours = trim($row['cancellation_hours']);
            $cancel_detail->cancellation_fee = $cancellation_fee;
            $cancel_detail->cancellation_fee_perc = "0";
            $cancel_detail->airportzo_fee = trim($row['platform_fee']);//$net_amount - $cancellation_fee - $refund_amount;
            $cancel_detail->max_airportzo_fee = "0";
            $cancel_detail->cancelled_date = (trim($row['cancelled_date']) != '' && trim($row['cancelled_date']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['cancelled_date']))): '-';
            $cancel_detail->refund_amount = trim($row['refunded_amount']);
            $cancel_detail->refund_status = trim($row['refund_status']);
            $cancel_detail->refunded_date = (trim($row['refunded_date']) != '' && trim($row['refunded_date']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['refunded_date']))): '-';

            // $station_detail = new stdClass;
            // $station_detail->airport_token = trim($row['airport_token']);
            // $station_detail->airport_name = trim($row['airport_name']);
            // $station_detail->airport_code = trim($row['airport_code']);
            // $station_detail->terminal_token = trim($row['terminal_token']);
            // $station_detail->terminal_name = trim($row['terminal_name']);

            $service_provider = new stdClass;
            // $service_provider->company_token = trim($row['company_token']);
            $service_provider->name = trim($row['company_name']);
            $service_provider->email = trim($row['company_email']);
            $service_provider->logo = trim($row['company_logo']);
            $service_provider->image = trim($row['company_image']);

            // $service_detail = new stdClass;
            // $service_detail->date_time = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['service_date_time']))): '-';
            // // $service_detail->token = trim($row['service_token']);
            // $service_detail->name = trim($row['service_name']);
            // $service_detail->type = trim($row['service_type']);

            $price_detail = new stdClass;
            $price_detail->adult_service_amount = trim($row['adult_service_amount']);
            $price_detail->total_adult = trim($row['total_adult']);
            $price_detail->children_service_amount = trim($row['children_service_amount']);
            $price_detail->total_children = trim($row['total_children']);
            $price_detail->net_amount = trim($row['net_amount']);
            $price_detail->cancellation_fee = trim($row['cancellation_fee']);
            $price_detail->platform_fee = trim($row['platform_fee']);
            $price_detail->refunded_amount = trim($row['refunded_amount']);

            $obj = new stdClass;
            $obj->user_token = trim($row['user_token']);
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->booking_token = trim($row['booking_token']);
            $obj->airport_token = trim($row['airport_token']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->airport_code = trim($row['airport_code']);
            $obj->terminal_token = trim($row['terminal_token']);
            $obj->terminal_name = trim($row['terminal_name']);
            $obj->company_token = trim($row['company_token']);
            $obj->company_name = trim($row['company_name']);
            $obj->company_email = trim($row['company_email']);
            $obj->company_logo = trim($row['company_logo']);
            $obj->company_image = trim($row['company_image']);
            $obj->station_number = (int) trim($row['station_number']);
            $obj->flight_number = trim($row['flight_number']);
            $obj->airport_type = trim($row['airport_type']);
            $obj->airport_category = trim($row['airport_category']);
            $obj->service_date_time = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('d M, Y H:i', strtotime(trim($row['service_date_time']))): '-';
            $obj->service_date = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('d M, Y', strtotime(trim($row['service_date_time']))): '-';
            $obj->service_time = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? date('h:i A', strtotime(trim($row['service_date_time']))): '-';
            $obj->service_date_time_raw = (trim($row['service_date_time']) != '' && trim($row['service_date_time']) != '0000-00-00 00:00:00')? trim($row['service_date_time']): '-';
            $obj->service_token = trim($row['service_token']);
            $obj->service_name = trim($row['service_name']);
            $obj->service_type = trim($row['service_type']);
            $obj->service_location_token = trim($row['service_location_token']);
            $obj->journey_date = (trim($row['journey_date']) != '' && trim($row['journey_date']) != '0000-00-00' && trim($row['journey_date']) != '1970-01-01')? date('d M, Y', strtotime(trim($row['journey_date']))): '-';
            $obj->journey = trim($row['journey']);
            $obj->date_time = trim($row['date_time']);
            $obj->status = trim($row['status']);
            $obj->adult_service_amount = trim($row['adult_service_amount']);
            $obj->total_adult = trim($row['total_adult']);
            $obj->children_service_amount = trim($row['children_service_amount']);
            $obj->total_children = trim($row['total_children']);
            $obj->net_amount = $net_amount;
            $obj->date_time = trim($row['date_time']);
            $obj->notes = trim($row['notes']);
            $obj->rating = trim($row['rating']);
            $obj->review = trim($row['review']);
            $obj->review_date_time = date('d M, Y', strtotime(trim($row['review_date_time'])));
            $obj->comment = trim($row['comment']);
            $obj->comment_date_time = $row['comment_date_time']!='0000-00-00 00:00:00' ? date('d M, Y', strtotime(trim($row['comment_date_time']))) : '-';
            $obj->description = trim($row['description']);
            $obj->report_reason_token = trim($row['report_reason_token']);
            $obj->report_reason = trim($row['report_reason']);
            $obj->report_description = trim($row['report_description']);
            $obj->reported_date_time = (trim($row['reported_date_time']) != '' && trim($row['reported_date_time']) != '0000-00-00' && trim($row['reported_date_time']) != '1970-01-01')? date('d M,Y h:i A', strtotime(trim($row['reported_date_time']))): '-';
            $obj->cancellation_policy_detail = $cancel_charges_array;
            $obj->reschedule_policy = trim($row['reschedule_policy']);
            $obj->can_be_cancelled = false;
            $obj->cancelled_by = ($status == "Cancelled")? ((trim($row['cancelled_by']) == 1)? 'User': 'Service Provider') : "";
            $obj->cancellation_detail = $cancel_detail;
            $obj->az_sp_commision_amount = trim($row['az_sp_commision_amount']);
            $obj->sp_balance_credit = trim($row['sp_balance_credit']);
            $obj->currency = trim($row['currency']);
            $obj->markup_amount = trim($row['markup_amount']);
            $obj->discount_amount = trim($row['discount_amount']);
            $obj->is_coupon_service = trim($row['is_coupon_service']);
            $obj->cart_coupon_type = trim($row['cart_coupon_type']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>