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
    public $review_date_time;
    public $description;
    public $report_reason_token;
    public $report_reason_description;

    public $platform_fee = 0;

    public $distributor_token;

    public $table_name = "users__booking_detail";
    public $column_list = "`users__booking_detail`.`id`,
    `users__booking_detail`.`token`,
    `users__booking_detail`.`booking_token`,
    `users__booking_detail`.`airport_token`,
    `airport`.`name` AS `airport_name`,
    `airport`.`code` AS `airport_code`,
    `airport`.`gmt` AS `airport_gmt`,
    `users__booking_detail`.`terminal_token`,
    `airport__terminal`.`name` AS `terminal_name`,
    `users__booking_detail`.`company_token`,
    `service__provider_company`.`name` AS `company_name`,
    `service__provider_company_location`.`email_id` AS `company_email`,
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
    `users__booking_detail`.`sp_balance_credit`,
    `users__booking_detail`.`discount_amount`,
    `users__booking_detail`.`is_coupon_service`,
    `users__booking_detail`.`agent_conv_fee_commi`,
    `users__booking_detail`.`gst_agent_conv_fee_commi`,
    `users__booking_detail`.`user_conv_fee_commi`,
    `users__booking_detail`.`gst_user_conv_fee_commi`,
    COALESCE(`report_reason`.`reason`, '') AS `report_reason`,
    `users__booking_detail`.`report_description`,
    COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`,
    COALESCE(`service__provider_company_location`.`reschedule_policy`, '') AS `reschedule_policy`,
    `users__booking_detail`.`reported_date` AS `reported_date_time`,
    `users__booking`.`is_agent`,
    `users__booking`.`currency`,
    `users__booking`.`gst_name`,
    `users__booking`.`gstin_number`,
    `users__booking`.`coupon_type`,
    `users__booking`.`cart_coupon_type`,
    `users__booking`.`invoice_token`,
    `users__booking`.`discount_amount` AS `cart_dis_amt`,
    `users__booking_detail`.`markup_amount`";
    public $stmt;

    public function readForBooking() {
        $query = "SELECT
            " . $this->column_list . "
        FROM `" . $this->table_name . "`
        INNER JOIN `airport` ON `airport`.`token` = `users__booking_detail`.`airport_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`= `users__booking_detail`.`terminal_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`users__booking_detail`.`company_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token`=`users__booking_detail`.`company_token` AND `service__provider_company_location`.`airport_token`=`airport`.`token`
        INNER JOIN `users__booking` ON (`users__booking`.`token`=`users__booking_detail`.`booking_token`)
        LEFT JOIN `service__provider_company_location_staffs` ON `service__provider_company_location_staffs`.`token`=`users__booking_detail`.`assignee_token`
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
            `status`=:status,
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
            `is_coupon_service`=:is_coupon_service,
            `business_type_token`=:business_type_token,
            `coupon_percentage`=:coupon_percentage,
            `category_coupon_type`=:category_coupon_type,
            `discount_amount`=:discount_amount,
            `az_sp_percentage`=:az_sp_percentage,
            `az_sp_commision_amount`=:az_sp_commision_amount,
            `agent_conv_fee_commi`=:agent_conv_fee_commi,
            `gst_agent_conv_fee_commi`=:gst_agent_conv_fee_commi,
            `user_conv_fee_commi`=:user_conv_fee_commi,
            `gst_user_conv_fee_commi`=:gst_user_conv_fee_commi,
            `sp_previous_credit`=:sp_previous_credit,
            `sp_balance_credit`=:sp_balance_credit";
    
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":booking_token", $this->booking_token);
        $this->stmt->bindParam(":status", $this->status);
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
        $this->stmt->bindParam(":is_coupon_service", $this->is_coupon_service);
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);
        $this->stmt->bindParam(":coupon_percentage", $this->coupon_percentage);
        $this->stmt->bindParam(":category_coupon_type", $this->category_coupon_type);
        $this->stmt->bindParam(":discount_amount", $this->discount_amount);
        $this->stmt->bindParam(":az_sp_percentage", $this->provider_commission_percentage);
        $this->stmt->bindParam(":az_sp_commision_amount", $this->provider_commission_amount);
        $this->stmt->bindParam(":agent_conv_fee_commi", $this->agent_conv_fee_commi);
        $this->stmt->bindParam(":gst_agent_conv_fee_commi", $this->gst_agent_conv_fee_commi);
        $this->stmt->bindParam(":user_conv_fee_commi", $this->user_conv_fee_commi);
        $this->stmt->bindParam(":gst_user_conv_fee_commi", $this->gst_user_conv_fee_commi);
        $this->stmt->bindParam(":sp_previous_credit", $this->previous_provider_credits);
        $this->stmt->bindParam(":sp_balance_credit", $this->balance_provider_credits);
        
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
            `cancellation_percentage`=:cancellation_percentage,
            `cancellation_fee`=:cancellation_fee,
            `platform_fee`=:platform_fee,
            `cancelled_by`='1',
            `cancelled_user_token`=:user_token,
            `cancelled_date`=:date_time,
            `refund_status`='Pending',
            `cancelled_invoice_token`=:invoice_token,
            `cancelled_order_invoice`=:cancelled_order_invoice,
            `refunded_amount`=:refund_amount 
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":cancellation_hours", $this->cancellation_hours);
        $this->stmt->bindParam(":cancellation_fee", $this->cancellation_fee);
        $this->stmt->bindParam(":cancellation_percentage", $this->cancellation_percentage);
        $this->stmt->bindParam(":platform_fee", $this->platform_fee);
        $this->stmt->bindParam(":refund_amount", $this->refund_amount);
        $this->stmt->bindParam(":invoice_token", $this->invoice_token);
        $this->stmt->bindParam(":cancelled_order_invoice", $this->cancelled_order_invoice);
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":date_time", $this->date_time);
        
        // execute query
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

    public function updateComment(){
        $query = "UPDATE `" . $this->table_name . "`
        SET
            `comment`=:comment,
            `comment_date_time`=:comment_date_time
        WHERE
            `token`=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);

        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":comment", $this->comment);
        $this->stmt->bindParam(":comment_date_time", $this->comment_date_time);

        // execute query
        return $this->stmt->execute()? true: false;
    }

    public function readReviews() {
        $query = "SELECT
                `users`.`title`,
                `users`.`name`,
                `users`.`image`,
                `users__booking_detail`.`rating`,
                `users__booking_detail`.`review`,
                `users__booking_detail`.`review_date_time`,
                `users__booking_detail`.`comment`,
                `users__booking_detail`.`comment_date_time`
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
            $obj->comment = trim($row['comment']);
            $obj->comment_date_time = $row['comment_date_time']!='0000-00-00 00:00:00' ? date('d M, Y', strtotime(trim($row['comment_date_time']))) : '-';

            array_push($array, $obj);
        }
        return $array;
    }

    // Users' View
    function makeView() {
        $airport_location = [];
        $location_check = [];
        $gst_no = '';
        $place_serv = '';
        $ut_code = '';
        $pan_no = '';
        $company_names= '';
        $address = '';
        $gst_no_arry = [];
        $gst_pro = [];
        $net_amt = [];
        $place_serv_arr = [];
        $ut_code_arr = [];
        $pan_no_arr = [];
        $comp_nam_arr = [];
        $address_arr = [];
        $place_serv_pro = [];
        $ut_code_pro = [];
        $pan_no_pro = [];
        $comp_nam_pro = [];
        $address_pro = [];
        $tax_type = '';
        $single_loc = false;
        $ind_check = false;
        $tn_code = '';
        $tn_gstno = '';
        $tn_pan_no = '';
        $tn_address = '';
        $tn_company = '';
        $ext_gst_serv_amt = 0;
        $max = '';
        $index_val = '';
        $count_locations = 0;
        $count_services = 0;
        $query = "SELECT (SELECT COUNT(DISTINCT `users__booking_detail`.`airport_token`) FROM `users__booking_detail`
                        WHERE `users__booking_detail`.`booking_token`= `users__booking`.`token`) AS `count_location`,
                        COALESCE((SELECT COUNT(DISTINCT `cities`.`country_id`) FROM `cities`
                        WHERE `cities`.`id` = `airport`.`city_id` GROUP BY `cities`.`country_id` HAVING `cities`.`country_id` = '96'),0) AS `location_check`,
                        (SELECT CONCAT( `gst_no`, ',', `code`,',', `pancard_number`,',', `company_name`,',', `address`,',', `company_name` ) AS `gst_code` FROM `regions` WHERE `name` = 'Tamil Nadu' AND `country_id` = 96) AS `tn_gstno`,
                        `users__booking_detail`.`net_amount`,
                        `users__booking_detail`.`airport_token`,
                        `users__booking_detail`.`adult_service_amount`,
                        `users__booking_detail`.`total_adult`,
                        `users__booking_detail`.`children_service_amount`,
                        `users__booking_detail`.`total_children`,
                        `users__booking_detail`.`additional_adult_service_amount`,
                        `users__booking_detail`.`additional_children_service_amount`,
                        `users__booking`.`coupon_type`,
                        `users__booking`.`cart_coupon_type`,
                        `regions`.`gst_no`,
                        `regions`.`country_id`,
                        `regions`.`name`,
                        `regions`.`code`,
                        `regions`.`pancard_number`,
                        `regions`.`company_name`,
                        `regions`.`address`
                    FROM
                        `users__booking`
                    INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token` = `users__booking`.`token`
                    INNER JOIN `airport` ON `airport`.`token` = `users__booking_detail`.`airport_token`
                    INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
                    INNER JOIN `regions` ON `regions`.`id` = `cities`.`region_id`
                    WHERE `users__booking`.`token` =:booking_token
                    GROUP BY `users__booking_detail`.`token`
                    ORDER BY `users__booking_detail`.`id`";
        $this->stmts = $this->conn->prepare( $query );
        $this->stmts->bindParam(":booking_token", $this->booking_token);
        $this->stmts->execute();
        // $this->stmts->debugDumpParams();
        $num_count = $this->stmts->rowCount();
        while ($rows = $this->stmts->fetch(PDO::FETCH_ASSOC)) {
            $myString = $rows['tn_gstno'];
            $myArray = explode(',', $myString);
            $tn_gstno = $myArray[0];
            $tn_code = $myArray[1];
            $tn_pan_no = $myArray[2];
            $tn_address = $myArray[3];
            $tn_company = $myArray[4];
            $adult_serv_amt = 0;
            $child_serv_amt = 0;
            $add_adult_service_amount = 0;
            $add_children_service_amount = 0;
            // $count_locations = (int)$rows['count_location'];

            if((int)$rows['count_location'] == 1){  //Single Station and Single Location 
                $single_loc = true;
                if($rows['location_check'] == 1){   //Check in India
                    if($rows['gst_no'] != ''){
                        $tax_type = 2;
                        $gst_no = $rows['gst_no'];
                        $place_serv = $rows['name'];
                        $ut_code = $rows['code'];
                        $pan_no = $rows['pancard_number'];
                        $company_names = $rows['company_name'];
                        $address = $rows['address'];
                    }else{
                        $tax_type = 1;
                        $gst_no = $tn_gstno;
                        $place_serv = 'Tamil Nadu';
                        $ut_code = $tn_code;
                        $pan_no = $tn_pan_no;
                        $company_names = $tn_company;
                        $address = $tn_address;
                    }
                }else{                              //Check in Outside India
                    $tax_type = 1;
                    $gst_no = $tn_gstno;
                    $place_serv = 'Tamil Nadu';
                    $ut_code = $tn_code;
                    $pan_no = $tn_pan_no;
                    $company_names = $tn_company;
                    $address = $tn_address;
                }
            }else{                                 //Multiple Station and Multiple Location Check
                $single_loc = false;
                array_push($airport_location, $rows['country_id']);
                array_push($location_check, $rows['location_check']);
                array_push($gst_pro, $rows['gst_no']);
                array_push($place_serv_arr, $rows['name']);
                array_push($ut_code_arr, $rows['code']);
                array_push($pan_no_arr, $rows['pancard_number']);
                array_push($comp_nam_arr, $rows['company_name']);
                array_push($address_arr, $rows['address']);
                if($rows['gst_no'] != ''){
                    array_push($gst_no_arry, $rows['gst_no']);
                    array_push($net_amt, $rows['net_amount']);
                    array_push($place_serv_pro, $rows['name']);
                    array_push($ut_code_pro, $rows['code']);
                    array_push($pan_no_pro, $rows['pancard_number']);
                    array_push($comp_nam_pro, $rows['company_name']);
                    array_push($address_pro, $rows['address']);
                }
            }
            if((int)$rows['coupon_type'] == 1){

                // if($rows['cart_coupon_type'] == 'Excl Gst'){
                //     $tl_adult = 0;
                //     $tl_addadult = 0;
                //     $tl_child = 0;
                //     $tl_addchild = 0;
                //     if((int)$rows["total_adult"] <= 1){
                //         $tl_adult    = (int)$rows["total_adult"];
                //         $tl_addadult = 0;
                //     }else{
                //         $tl_adult    = 1;
                //         $tl_addadult = (int)$rows["total_adult"] - 1;
                //     }
                //     if($rows["total_children"] <= 1){
                //         $tl_child    = (int)$rows["total_children"];
                //         $tl_addchild = 0;
                //     }else{
                //         $tl_child    = 1;
                //         $tl_addchild = (int)$rows["total_children"] - 1;
                //     }
                //     $adult_serv_amt = round(((int)$rows['adult_service_amount']*100)/118);
                //     if($tl_child > 0){
                //         $child_serv_amt = round(((int)$rows['children_service_amount']*100)/118);
                //     }else{
                //         $child_serv_amt = 0;
                //     }

                //     if((float)$rows["additional_adult_service_amount"] == 0 && $tl_addadult > 0){
                //         $add_adult_service_amount = round($adult_serv_amt * $tl_addadult);
                //     }else{
                //         $add_adult_service_amount = round((((int)$rows["additional_adult_service_amount"]*100)/118) * $tl_addadult);
                //     }
                //     if((float)$rows["additional_children_service_amount"] == 0 && $tl_addchild > 0){
                //         $add_children_service_amount = round($child_serv_amt * $tl_addchild);
                //     }else{
                //         $add_children_service_amount = round((((int)$rows["additional_children_service_amount"]*100)/118) * $tl_addchild);
                //     }
                   
                // }else if($rows['cart_coupon_type'] == 'Incl Gst'){
                    $tl_adult = 0;
                    $tl_addadult = 0;
                    $tl_child = 0;
                    $tl_addchild = 0;
                    if((int)$rows["total_adult"] <= 1){
                        $tl_adult    = (int)$rows["total_adult"];
                        $tl_addadult = 0;
                    }else{
                        $tl_adult    = 1;
                        $tl_addadult = (int)$rows["total_adult"] - 1;
                    }
                    if($rows["total_children"] <= 1){
                        $tl_child    = (int)$rows["total_children"];
                        $tl_addchild = 0;
                    }else{
                        $tl_child    = 1;
                        $tl_addchild = (int)$rows["total_children"] - 1;
                    }
                    $adult_serv_amt = (int)$rows['adult_service_amount'];
                    if($tl_child > 0){
                        $child_serv_amt = (int)$rows['children_service_amount'];
                    }else{
                        $child_serv_amt = 0;
                    }

                    if((float)$rows["additional_adult_service_amount"] == 0 && $tl_addadult > 0){
                        $add_adult_service_amount = round($adult_serv_amt * $tl_addadult);
                    }else{
                        $add_adult_service_amount = round((int)$rows["additional_adult_service_amount"] * $tl_addadult);
                    }
                    if((float)$rows["additional_children_service_amount"] == 0 && $tl_addchild > 0){
                        $add_children_service_amount = round($child_serv_amt * $tl_addchild);
                    }else{
                        $add_children_service_amount = round((int)$rows["additional_children_service_amount"] * $tl_addchild);
                    }
                // }
                //common ext_gst_serv_amt for(Incl and Excl)
                $ext_gst_serv_amt += round($adult_serv_amt + $child_serv_amt + $add_adult_service_amount + $add_children_service_amount);
            }
        }
        
        if(count($net_amt) > 0){
            $max = max($net_amt);
            $index_val = array_keys($net_amt, $max)[0];
        }
        
        if($single_loc == false){        //multiple station and (Single and Different) location
            if(!in_array("0", $location_check)){   //Check for India -> India
                if($index_val !=  '' || $index_val == 0){
                    $tax_type = 2;
                    $gst_no = $gst_no_arry[$index_val];
                    $place_serv = $place_serv_pro[$index_val];
                    $ut_code = $ut_code_pro[$index_val];
                    $pan_no = $pan_no_pro[$index_val];
                    $company_names = $comp_nam_pro[$index_val];
                    $address = $address_pro[$index_val];
                }else{
                    $tax_type = 1;
                    $gst_no = $tn_gstno;
                    $place_serv = 'Tamil Nadu';
                    $ut_code = $tn_code;
                    $pan_no = $tn_pan_no;
                    $company_names = $tn_company;
                    $address = $tn_address;
                }
            }else if(!in_array("1", $location_check)){  //Check for Outside India -> Outside India
                $tax_type = 1;
                $gst_no = $tn_gstno;
                $place_serv = 'Tamil Nadu';
                $ut_code = $tn_code;
                $pan_no = $tn_pan_no;
                $company_names = $tn_company;
                $address = $tn_address;
            }else{                                      //Check for India -> Outside India also
                $select_country = [];
                $querys = "SELECT `users__booking_detail`.`airport_token`,
                                    `regions`.`gst_no`,
                                    `regions`.`country_id`,
                                    `regions`.`name`,
                                    `regions`.`code` AS `regions_code`,
                                    `countries`.`code` AS `countries_code`
                                FROM
                                    `users__booking`
                                INNER JOIN `users__booking_detail` ON `users__booking_detail`.`booking_token` = `users__booking`.`token`
                                INNER JOIN `airport` ON `airport`.`token` = `users__booking_detail`.`airport_token`
                                INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
                                INNER JOIN `regions` ON `regions`.`id` = `cities`.`region_id`
                                INNER JOIN `countries` ON `countries`.`id` = `cities`.`country_id`
                                WHERE `users__booking`.`token` =:booking_token
                                GROUP BY `users__booking_detail`.`airport_token`";
                $this->stmts1 = $this->conn->prepare( $querys );
                $this->stmts1->bindParam(":booking_token", $this->booking_token);
                $this->stmts1->execute();
                //$this->stmts1->debugDumpParams();
                //$num_counts = $this->stmts1->rowCount();
                while ($rows1 = $this->stmts1->fetch(PDO::FETCH_ASSOC)) {
                    array_push($select_country, $rows1['countries_code']);
                }
                $counts = array_count_values($select_country);
                $num_counts = $counts['in'];
                $other_cont = count($select_country) - $num_counts;
                
                if($num_counts == 1 && $other_cont >= 1){       //Single Location in India and (Single / Multiple) Location Outside India
                    $keys = array_keys($location_check, "1")[0];
                    $check_gst = $gst_pro[$keys];
                    if($check_gst != ''){
                        $tax_type = 2;
                        $gst_no = $check_gst;
                        $place_serv = $place_serv_arr[$keys];
                        $ut_code = $ut_code_arr[$keys];
                        $pan_no = $pan_no_arr[$keys];
                        $company_names = $comp_nam_arr[$keys];
                        $address = $address_arr[$keys];
                    }else{
                        $tax_type = 1;
                        $gst_no = $tn_gstno;
                        $place_serv = 'Tamil Nadu';
                        $ut_code = $tn_code;
                        $pan_no = $tn_pan_no;
                        $company_names = $tn_company;
                        $address = $tn_address;
                    }
                }else if($num_counts > 1 && $other_cont >= 1){   //Multiple Location in India and (Single / Multiple) Location Outside India
                    if($index_val != '' || $index_val == 0){
                        $tax_type = 2;
                        $gst_no = $gst_no_arry[$index_val];
                        $place_serv = $place_serv_pro[$index_val];
                        $ut_code = $ut_code_pro[$index_val];
                        $pan_no = $pan_no_pro[$index_val];
                        $company_names = $comp_nam_pro[$index_val];
                        $address = $address_pro[$index_val];
                    }else{
                        $tax_type = 1;
                        $gst_no = $tn_gstno;
                        $place_serv = 'Tamil Nadu';
                        $ut_code = $tn_code;
                        $pan_no = $tn_pan_no;
                        $company_names = $tn_company;
                        $address = $tn_address;
                    }
                } 
            }
        }
        $array = [];
        $count_services = $this->stmt->rowCount();
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $net_amount = strval(trim($row['net_amount']));
            $cancellation_fee = strval(trim($row['cancellation_fee']));
            $refund_amount = intval(trim($row['refunded_amount']));

            $service_date_time_raw = trim($row['service_date_time']);
            $status = trim($row['status']);
            $has_chat = false;
            if ($status == 'Assign' || $status == 'Ongoing') {
                $has_chat = true;

                if ($has_chat) {
                    $time_diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($service_date_time_raw)) / 60;
                    $has_chat = ($time_diff < 30)? true: false;
                }
            }
            $cancel_charges_detail = (trim($row['cancel_charges']) != '')? explode("|&|", trim($row['cancel_charges'])): [];
            $cancel_charges_array = [];

            foreach ($cancel_charges_detail as $cancel_charges_key => $cancel_charges_value) {
                $cancel_policy = explode("||", $cancel_charges_value);

                $cancel_obj = new stdClass;
                $cancel_obj->hours = $cancel_policy[1];
                $cancel_obj->percentage = $cancel_policy[2];
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

            $obj = new stdClass;
            $obj->has_chat = $has_chat;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->booking_token = trim($row['booking_token']);
            $obj->airport_token = trim($row['airport_token']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->airport_code = trim($row['airport_code']);
            $obj->airport_gmt = trim($row['airport_gmt']);
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
            $obj->agent_conv_fee = trim($row['agent_conv_fee_commi'] + $row['gst_agent_conv_fee_commi']);
            $obj->user_conv_fee = trim($row['user_conv_fee_commi'] + $row['gst_user_conv_fee_commi']);
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
            $obj->gst_name = trim($row['gst_name']);
            $obj->gstin_number = trim($row['gstin_number']);
            $obj->is_agent = trim($row['is_agent']);
            $obj->agent_conv_fee_commi = trim($row['agent_conv_fee_commi']);
            $obj->gst_agent_conv_fee_commi = trim($row['gst_agent_conv_fee_commi']);
            $obj->user_conv_fee_commi = trim($row['user_conv_fee_commi']);
            $obj->gst_user_conv_fee_commi = trim($row['gst_user_conv_fee_commi']);
            
            if((int)$row['coupon_type'] == 2){          //Category
                $obj->discount = (int)$row['discount_amount'];
            }else if((int)$row['coupon_type'] == 1){    //Cart 
                $obj->discount = (int)$row['cart_dis_amt'];
            }else if((int)$row['coupon_type'] == 0){    //NO Coupons Apply
                $obj->discount = 0;
            }
            
            if((int)$row['coupon_type'] == 2){  //Category

                //-------Category Exclude Method--------//
                // if($row["total_adult"] <= 1){
                //     $obj->totalAdult_pdf    = (int)$row["total_adult"];
                //     $obj->total_additionalAdult_pdf       = 0;
                // }else{
                //     $obj->totalAdult_pdf    = 1;
                //     $obj->total_additionalAdult_pdf       = (int)$row["total_adult"] - 1;
                // }
                // if($row["total_children"] <= 1){
                //     $obj->totalChildren_pdf   = (int)$row["total_children"];
                //     $obj->total_additionalChildren_pdf       = 0;
                // }else{
                //     $obj->totalChildren_pdf    = 1;
                //     $obj->total_additionalChildren_pdf       = (int)$row["total_children"] - 1;
                // }
    
                // $ext_gst_serv_amt = (int)$obj->totalAdult_pdf + (int)$obj->total_additionalAdult_pdf + (int)$obj->totalChildren_pdf + (int)$obj->total_additionalChildren_pdf;
        
                // $obj->adult_serv_amt = round(((int)$row['adult_service_amount']*100)/118);
                // if($obj->totalChildren_pdf > 0){
                //     $obj->child_serv_amt = round(((int)$row['children_service_amount']*100)/118);
                // }else{
                //     $obj->child_serv_amt = 0;
                // }
    
                // if((float)$row["additional_adult_service_amount"] == 0 && $obj->total_additionalAdult_pdf > 0){
                //     $obj->add_adult_service_amount = round($obj->adult_serv_amt * $obj->total_additionalAdult_pdf);
                // }else{
                //     $obj->add_adult_service_amount = round((((int)$row["additional_adult_service_amount"]*100)/118) * $obj->total_additionalAdult_pdf);
                // }
                // if((float)$row["additional_children_service_amount"] == 0 && $obj->total_additionalChildren_pdf > 0){
                //     $obj->add_children_service_amount = round($obj->child_serv_amt * $obj->total_additionalChildren_pdf);
                // }else{
                //     $obj->add_children_service_amount = round((((int)$row["additional_children_service_amount"]*100)/118) * $obj->total_additionalChildren_pdf);
                // }

                // $sum_amt_persons = round($obj->adult_serv_amt + $obj->child_serv_amt + $obj->add_adult_service_amount + $obj->add_children_service_amount);

                // //Calculate the Discount
                // $obj->adult_discount = round(($obj->discount * $obj->adult_serv_amt) / ($sum_amt_persons));
                // $obj->child_discount = round(($obj->discount * $obj->child_serv_amt) / ($sum_amt_persons));
                // $obj->add_adult_discount = round(($obj->discount * $obj->add_adult_service_amount) / ($sum_amt_persons));
                // $obj->add_child_discount = round(($obj->discount * $obj->add_children_service_amount) / ($sum_amt_persons));

                // // $obj->adult_discount = round($obj->discount / $ext_gst_serv_amt);
                // // $obj->child_discount = round($obj->discount / $ext_gst_serv_amt);
                // // $obj->add_adult_discount = round($obj->discount / $ext_gst_serv_amt);
                // // $obj->add_child_discount = round($obj->discount / $ext_gst_serv_amt);
                
                // //Calculate the Net Amount
                // $obj->adult_net_amt = $obj->adult_serv_amt - $obj->adult_discount;
                // $obj->child_net_amt = $obj->child_serv_amt - $obj->child_discount;

                // if((int)$obj->add_adult_service_amount != 0){
                //     $obj->add_adult_net_amt = $obj->add_adult_service_amount - $obj->add_adult_discount;
                // }else{
                //     $obj->add_adult_net_amt = 0;
                // }
                // if((int)$obj->add_children_service_amount != 0){
                //     $obj->add_child_net_amt = $obj->add_children_service_amount - $obj->add_child_discount;
                // }else{
                //     $obj->add_child_net_amt = 0;
                // }

                // $obj->adult_taxable_val = $obj->adult_net_amt;
                // $obj->child_taxable_val = $obj->child_net_amt;
                // $obj->add_adult_taxable_val = $obj->add_adult_net_amt;
                // $obj->add_child_taxable_val = $obj->add_child_net_amt;

                // //Calculate the Tax Amount
                // if($tax_type == 1){
                //     $obj->tax_rate1 = '18% IGST';
                //     $obj->tax_rate2 = '';
                //     $obj->adult_tax_amt1 = strval(round((int)$obj->adult_taxable_val * 0.18));
                //     $obj->adult_tax_amt2 = '';
                //     $obj->child_tax_amt1 = strval(round((int)$obj->child_taxable_val * 0.18));
                //     $obj->child_tax_amt2 = '';
                //     $obj->add_adult_tax_amt1 = strval(round((int)$obj->add_adult_taxable_val * 0.18));
                //     $obj->add_adult_tax_amt2 = '';
                //     $obj->add_child_tax_amt1 = strval(round((int)$obj->add_child_taxable_val * 0.18));
                //     $obj->add_child_tax_amt2 = '';
                // }else if($tax_type == 2){
                //     $obj->tax_rate1 = '9% CGST';
                //     $obj->tax_rate2 = '9% SGST';
                //     $obj->adult_tax_amt1 = strval(round((int)$obj->adult_taxable_val * 0.09));
                //     $obj->adult_tax_amt2 = strval(round((int)$obj->adult_taxable_val * 0.09));
                //     $obj->child_tax_amt1 = strval(round((int)$obj->child_taxable_val * 0.09));
                //     $obj->child_tax_amt2 = strval(round((int)$obj->child_taxable_val * 0.09));
                //     $obj->add_adult_tax_amt1 = strval(round((int)$obj->add_adult_taxable_val * 0.09));
                //     $obj->add_adult_tax_amt2 = strval(round((int)$obj->add_adult_taxable_val * 0.09));
                //     $obj->add_child_tax_amt1 = strval(round((int)$obj->add_child_taxable_val * 0.09));
                //     $obj->add_child_tax_amt2 = strval(round((int)$obj->add_child_taxable_val * 0.09));
                // }

                // //Calculate the Sub Total
                // $obj->adult_sub_total = round((int)$obj->adult_taxable_val + (int)$obj->adult_tax_amt1 + (int)$obj->adult_tax_amt2);
                // $obj->child_sub_total = round((int)$obj->child_taxable_val + (int)$obj->child_tax_amt1 + (int)$obj->child_tax_amt2);
                // $obj->add_adult_sub_total = round((int)$obj->add_adult_taxable_val + (int)$obj->add_adult_tax_amt1 + (int)$obj->add_adult_tax_amt2);
                // $obj->add_child_sub_total = round((int)$obj->add_child_taxable_val + (int)$obj->add_child_tax_amt1 + (int)$obj->add_child_tax_amt2);

                //-------Category Include Method--------//
                if($row["total_adult"] <= 1){
                    $obj->totalAdult_pdf    = (int)$row["total_adult"];
                    $obj->total_additionalAdult_pdf       = 0;
                }else{
                    $obj->totalAdult_pdf    = 1;
                    $obj->total_additionalAdult_pdf       = (int)$row["total_adult"] - 1;
                }
                if($row["total_children"] <= 1){
                    $obj->totalChildren_pdf   = (int)$row["total_children"];
                    $obj->total_additionalChildren_pdf       = 0;
                }else{
                    $obj->totalChildren_pdf    = 1;
                    $obj->total_additionalChildren_pdf       = (int)$row["total_children"] - 1;
                }
    
                $ext_gst_serv_amt = (int)$obj->totalAdult_pdf + (int)$obj->total_additionalAdult_pdf + (int)$obj->totalChildren_pdf + (int)$obj->total_additionalChildren_pdf;
        
                $obj->adult_serv_amt = round((int)$row['adult_service_amount']);
                if($obj->totalChildren_pdf > 0){
                    $obj->child_serv_amt = round((int)$row['children_service_amount']);
                }else{
                    $obj->child_serv_amt = 0;
                }
    
                if((float)$row["additional_adult_service_amount"] == 0 && $obj->total_additionalAdult_pdf > 0){
                    $obj->add_adult_service_amount = round($obj->adult_serv_amt * $obj->total_additionalAdult_pdf);
                }else{
                    $obj->add_adult_service_amount = round(((int)$row["additional_adult_service_amount"]) * $obj->total_additionalAdult_pdf);
                }
                if((float)$row["additional_children_service_amount"] == 0 && $obj->total_additionalChildren_pdf > 0){
                    $obj->add_children_service_amount = round($obj->child_serv_amt * $obj->total_additionalChildren_pdf);
                }else{
                    $obj->add_children_service_amount = round(((int)$row["additional_children_service_amount"]) * $obj->total_additionalChildren_pdf);
                }

                $sum_amt_persons = round($obj->adult_serv_amt + $obj->child_serv_amt + $obj->add_adult_service_amount + $obj->add_children_service_amount);

                //Calculate the Discount
                $obj->adult_discount = round(($obj->discount * $obj->adult_serv_amt) / ($sum_amt_persons));
                $obj->child_discount = round(($obj->discount * $obj->child_serv_amt) / ($sum_amt_persons));
                $obj->add_adult_discount = round(($obj->discount * $obj->add_adult_service_amount) / ($sum_amt_persons));
                $obj->add_child_discount = round(($obj->discount * $obj->add_children_service_amount) / ($sum_amt_persons));

                // $obj->adult_discount = round($obj->discount / $ext_gst_serv_amt);
                // $obj->child_discount = round($obj->discount / $ext_gst_serv_amt);
                // $obj->add_adult_discount = round($obj->discount / $ext_gst_serv_amt);
                // $obj->add_child_discount = round($obj->discount / $ext_gst_serv_amt);
                
                //Calculate the Net Amount
                $obj->adult_net_amt = $obj->adult_serv_amt - $obj->adult_discount;
                $obj->child_net_amt = $obj->child_serv_amt - $obj->child_discount;

                if((int)$obj->add_adult_service_amount != 0){
                    $obj->add_adult_net_amt = $obj->add_adult_service_amount - $obj->add_adult_discount;
                }else{
                    $obj->add_adult_net_amt = 0;
                }
                if((int)$obj->add_children_service_amount != 0){
                    $obj->add_child_net_amt = $obj->add_children_service_amount - $obj->add_child_discount;
                }else{
                    $obj->add_child_net_amt = 0;
                }

                $obj->adult_taxable_val = number_format((($obj->adult_net_amt * 100)/118), 2, '.', '');
                $obj->child_taxable_val = number_format((($obj->child_net_amt * 100)/118), 2, '.', '');
                $obj->add_adult_taxable_val = number_format((($obj->add_adult_net_amt * 100)/118), 2, '.', '');
                $obj->add_child_taxable_val = number_format((($obj->add_child_net_amt * 100)/118), 2, '.', '');

                //Calculate the Tax Amount
                if($tax_type == 1){
                    $obj->tax_rate1 = '18% IGST';
                    $obj->tax_rate2 = '';
                    $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.18), 2, '.', ''));
                    $obj->adult_tax_amt2 = '';
                    $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.18), 2, '.', ''));
                    $obj->child_tax_amt2 = '';
                    $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.18), 2, '.', ''));
                    $obj->add_adult_tax_amt2 = '';
                    $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.18), 2, '.', ''));
                    $obj->add_child_tax_amt2 = '';
                }else if($tax_type == 2){
                    $obj->tax_rate1 = '9% CGST';
                    $obj->tax_rate2 = '9% SGST';
                    $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->adult_tax_amt2 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                    $obj->child_tax_amt2 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_adult_tax_amt2 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_child_tax_amt2 =  strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                }

                //Calculate the Sub Total
                $obj->adult_sub_total = round((float)$obj->adult_taxable_val + (float)$obj->adult_tax_amt1 + (float)$obj->adult_tax_amt2);
                $obj->child_sub_total = round((float)$obj->child_taxable_val + (float)$obj->child_tax_amt1 + (float)$obj->child_tax_amt2);
                $obj->add_adult_sub_total = round((float)$obj->add_adult_taxable_val + (float)$obj->add_adult_tax_amt1 + (float)$obj->add_adult_tax_amt2);
                $obj->add_child_sub_total = round((float)$obj->add_child_taxable_val + (float)$obj->add_child_tax_amt1 + (float)$obj->add_child_tax_amt2);

            }else if((int)$row['coupon_type'] == 1){    //Cart 

                // if($row['cart_coupon_type'] == 'Excl Gst'){

                //     if($row["total_adult"] <= 1){
                //         $obj->totalAdult_pdf    = (int)$row["total_adult"];
                //         $obj->total_additionalAdult_pdf       = 0;
                //     }else{
                //         $obj->totalAdult_pdf    = 1;
                //         $obj->total_additionalAdult_pdf       = (int)$row["total_adult"] - 1;
                //     }
                //     if($row["total_children"] <= 1){
                //         $obj->totalChildren_pdf   = (int)$row["total_children"];
                //         $obj->total_additionalChildren_pdf       = 0;
                //     }else{
                //         $obj->totalChildren_pdf    = 1;
                //         $obj->total_additionalChildren_pdf       = (int)$row["total_children"] - 1;
                //     }

                //     // $ext_gst_serv_amt = (int)$obj->totalAdult_pdf + (int)$obj->total_additionalAdult_pdf + (int)$obj->totalChildren_pdf + (int)$obj->total_additionalChildren_pdf;
        
                //     $obj->adult_serv_amt = round(((int)$row['adult_service_amount']*100)/118);
                //     if($obj->totalChildren_pdf > 0){
                //         $obj->child_serv_amt = round(((int)$row['children_service_amount']*100)/118);
                //     }else{
                //         $obj->child_serv_amt = 0;
                //     }
        
                //     if((float)$row["additional_adult_service_amount"] == 0 && $obj->total_additionalAdult_pdf > 0){
                //         $obj->add_adult_service_amount = round($obj->adult_serv_amt * $obj->total_additionalAdult_pdf);
                //     }else if($obj->total_additionalAdult_pdf > 0){
                //         $obj->add_adult_service_amount = round((((int)$row["additional_adult_service_amount"]*100)/118) * $obj->total_additionalAdult_pdf);
                //     }else{
                //         $obj->add_adult_service_amount =  0;
                //     }
                //     if((float)$row["additional_children_service_amount"] == 0 && $obj->total_additionalChildren_pdf > 0){
                //         $obj->add_children_service_amount = round($obj->child_serv_amt * $obj->total_additionalChildren_pdf);
                //     }else if($obj->total_additionalChildren_pdf > 0){
                //         $obj->add_children_service_amount = round((((int)$row["additional_children_service_amount"]*100)/118) * $obj->total_additionalChildren_pdf);
                //     }else{
                //         $obj->add_children_service_amount =  0;
                //     }
    
                //     //Calculate the Discount
                //     $obj->adult_discount = round(($obj->discount * $obj->adult_serv_amt) / ($ext_gst_serv_amt));
                //     $obj->child_discount = round(($obj->discount * $obj->child_serv_amt) / ($ext_gst_serv_amt));
                //     $obj->add_adult_discount = round(($obj->discount * $obj->add_adult_service_amount) / ($ext_gst_serv_amt));
                //     $obj->add_child_discount = round(($obj->discount * $obj->add_children_service_amount) / ($ext_gst_serv_amt));
                //     // $obj->adult_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                //     // $obj->child_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                //     // $obj->add_adult_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                //     // $obj->add_child_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
    
                //     //Calculate the Net Amount
                //     $obj->adult_net_amt = $obj->adult_serv_amt - $obj->adult_discount;
                //     $obj->child_net_amt = $obj->child_serv_amt - $obj->child_discount;
    
                //     if((int)$obj->add_adult_service_amount != 0){
                //         $obj->add_adult_net_amt = $obj->add_adult_service_amount - $obj->add_adult_discount;
                //     }else{
                //         $obj->add_adult_net_amt = 0;
                //     }
                //     if((int)$obj->add_children_service_amount != 0){
                //         $obj->add_child_net_amt = $obj->add_children_service_amount - $obj->add_child_discount;
                //     }else{
                //         $obj->add_child_net_amt = 0;
                //     }

                //     $obj->adult_taxable_val = $obj->adult_net_amt;
                //     $obj->child_taxable_val = $obj->child_net_amt;
                //     $obj->add_adult_taxable_val = $obj->add_adult_net_amt;
                //     $obj->add_child_taxable_val = $obj->add_child_net_amt;

                //     //Calculate the Tax Amount
                //     if($tax_type == 1){
                //         $obj->tax_rate1 = '18% IGST';
                //         $obj->tax_rate2 = '';
                //         $obj->adult_tax_amt1 = strval(round((int)$obj->adult_taxable_val * 0.18));
                //         $obj->adult_tax_amt2 = '';
                //         $obj->child_tax_amt1 = strval(round((int)$obj->child_taxable_val * 0.18));
                //         $obj->child_tax_amt2 = '';
                //         $obj->add_adult_tax_amt1 = strval(round((int)$obj->add_adult_taxable_val * 0.18));
                //         $obj->add_adult_tax_amt2 = '';
                //         $obj->add_child_tax_amt1 = strval(round((int)$obj->add_child_taxable_val * 0.18));
                //         $obj->add_child_tax_amt2 = '';
                //     }else if($tax_type == 2){
                //         $obj->tax_rate1 = '9% CGST';
                //         $obj->tax_rate2 = '9% SGST';
                //         $obj->adult_tax_amt1 = strval(round((int)$obj->adult_taxable_val * 0.09));
                //         $obj->adult_tax_amt2 = strval(round((int)$obj->adult_taxable_val * 0.09));
                //         $obj->child_tax_amt1 = strval(round((int)$obj->child_taxable_val * 0.09));
                //         $obj->child_tax_amt2 = strval(round((int)$obj->child_taxable_val * 0.09));
                //         $obj->add_adult_tax_amt1 = strval(round((int)$obj->add_adult_taxable_val * 0.09));
                //         $obj->add_adult_tax_amt2 = strval(round((int)$obj->add_adult_taxable_val * 0.09));
                //         $obj->add_child_tax_amt1 = strval(round((int)$obj->add_child_taxable_val * 0.09));
                //         $obj->add_child_tax_amt2 = strval(round((int)$obj->add_child_taxable_val * 0.09));
                //     }
    
                //     //Calculate the Sub Total
                //     $obj->adult_sub_total = round((int)$obj->adult_taxable_val + (int)$obj->adult_tax_amt1 + (int)$obj->adult_tax_amt2);
                //     $obj->child_sub_total = round((int)$obj->child_taxable_val + (int)$obj->child_tax_amt1 + (int)$obj->child_tax_amt2);
                //     $obj->add_adult_sub_total = round((int)$obj->add_adult_taxable_val + (int)$obj->add_adult_tax_amt1 + (int)$obj->add_adult_tax_amt2);
                //     $obj->add_child_sub_total = round((int)$obj->add_child_taxable_val + (int)$obj->add_child_tax_amt1 + (int)$obj->add_child_tax_amt2);

                // }else if($row['cart_coupon_type'] == 'Incl Gst'){
                    if($row["total_adult"] <= 1){
                        $obj->totalAdult_pdf    = (int)$row["total_adult"];
                        $obj->total_additionalAdult_pdf       = 0;
                    }else{
                        $obj->totalAdult_pdf    = 1;
                        $obj->total_additionalAdult_pdf       = (int)$row["total_adult"] - 1;
                    }
                    if($row["total_children"] <= 1){
                        $obj->totalChildren_pdf   = (int)$row["total_children"];
                        $obj->total_additionalChildren_pdf       = 0;
                    }else{
                        $obj->totalChildren_pdf    = 1;
                        $obj->total_additionalChildren_pdf       = (int)$row["total_children"] - 1;
                    }
        
                    // $ext_gst_serv_amt = (int)$obj->totalAdult_pdf + (int)$obj->total_additionalAdult_pdf + (int)$obj->totalChildren_pdf + (int)$obj->total_additionalChildren_pdf;

                    $obj->adult_serv_amt = round((int)$row['adult_service_amount']);
                    if($obj->totalChildren_pdf > 0){
                        $obj->child_serv_amt = round((int)$row['children_service_amount']);
                    }else{
                        $obj->child_serv_amt = 0;
                    }
        
                    if((float)$row["additional_adult_service_amount"] == 0 && $obj->total_additionalAdult_pdf > 0){
                        $obj->add_adult_service_amount = round($obj->adult_serv_amt * $obj->total_additionalAdult_pdf);
                    }else{
                        $obj->add_adult_service_amount = round((int)$row["additional_adult_service_amount"] * $obj->total_additionalAdult_pdf);
                    }
                    if((float)$row["additional_children_service_amount"] == 0 && $obj->total_additionalChildren_pdf > 0){
                        $obj->add_children_service_amount = round($obj->child_serv_amt * $obj->total_additionalChildren_pdf);
                    }else{
                        $obj->add_children_service_amount = round((int)$row["additional_children_service_amount"] * $obj->total_additionalChildren_pdf);
                    }

                    //Calculate the Discount
                    $obj->adult_discount = round(($obj->discount * $obj->adult_serv_amt) / ($ext_gst_serv_amt));
                    $obj->child_discount = round(($obj->discount * $obj->child_serv_amt) / ($ext_gst_serv_amt));
                    $obj->add_adult_discount = round(($obj->discount * $obj->add_adult_service_amount) / ($ext_gst_serv_amt));
                    $obj->add_child_discount = round(($obj->discount * $obj->add_children_service_amount) / ($ext_gst_serv_amt));
                    // $obj->adult_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                    // $obj->child_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                    // $obj->add_adult_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);
                    // $obj->add_child_discount = round(($obj->discount / $count_services) / $ext_gst_serv_amt);

                    //Calculate the Net Amount
                    $obj->adult_net_amt = (int)$obj->adult_serv_amt - (int)$obj->adult_discount;
                    $obj->child_net_amt = (int)$obj->child_serv_amt  - (int)$obj->child_discount;
    
                    if((int)$obj->add_adult_service_amount != 0){
                        $obj->add_adult_net_amt = $obj->add_adult_service_amount  - (int)$obj->add_adult_discount;
                    }else{
                        $obj->add_adult_net_amt = 0;
                    }
                    if((int)$obj->add_children_service_amount != 0){
                        $obj->add_child_net_amt = $obj->add_children_service_amount  - (int)$obj->add_child_discount;
                    }else{
                        $obj->add_child_net_amt = 0;
                    }

                    $obj->adult_taxable_val = number_format((($obj->adult_net_amt * 100)/118), 2, '.', '');
                    $obj->child_taxable_val = number_format((($obj->child_net_amt * 100)/118), 2, '.', '');
                    $obj->add_adult_taxable_val = number_format((($obj->add_adult_net_amt * 100)/118), 2, '.', '');
                    $obj->add_child_taxable_val = number_format((($obj->add_child_net_amt * 100)/118), 2, '.', '');

                    //Calculate the Tax Amount
                    if($tax_type == 1){
                        $obj->tax_rate1 = '18% IGST';
                        $obj->tax_rate2 = '';
                        $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.18), 2, '.', ''));
                        $obj->adult_tax_amt2 = '';
                        $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.18), 2, '.', ''));
                        $obj->child_tax_amt2 = '';
                        $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.18), 2, '.', ''));
                        $obj->add_adult_tax_amt2 = '';
                        $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.18), 2, '.', ''));
                        $obj->add_child_tax_amt2 = '';
                    }else if($tax_type == 2){
                        $obj->tax_rate1 = '9% CGST';
                        $obj->tax_rate2 = '9% SGST';
                        $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                        $obj->adult_tax_amt2 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                        $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                        $obj->child_tax_amt2 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                        $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                        $obj->add_adult_tax_amt2 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                        $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                        $obj->add_child_tax_amt2 =  strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                    }
    
                    //Calculate the Sub Total
                    $obj->adult_sub_total = round((float)$obj->adult_taxable_val + (float)$obj->adult_tax_amt1 + (float)$obj->adult_tax_amt2);
                    $obj->child_sub_total = round((float)$obj->child_taxable_val + (float)$obj->child_tax_amt1 + (float)$obj->child_tax_amt2);
                    $obj->add_adult_sub_total = round((float)$obj->add_adult_taxable_val + (float)$obj->add_adult_tax_amt1 + (float)$obj->add_adult_tax_amt2);
                    $obj->add_child_sub_total = round((float)$obj->add_child_taxable_val + (float)$obj->add_child_tax_amt1 + (float)$obj->add_child_tax_amt2);
                // }
            }else if((int)$row['coupon_type'] == 0){      /////////////-------------------NO Coupons Apply----------------//////////////////
                if($row["total_adult"] <= 1){
                    $obj->totalAdult_pdf    = (int)$row["total_adult"];
                    $obj->total_additionalAdult_pdf       = 0;
                }else{
                    $obj->totalAdult_pdf    = 1;
                    $obj->total_additionalAdult_pdf       = (int)$row["total_adult"] - 1;
                }
                if($row["total_children"] <= 1){
                    $obj->totalChildren_pdf   = (int)$row["total_children"];
                    $obj->total_additionalChildren_pdf       = 0;
                }else{
                    $obj->totalChildren_pdf    = 1;
                    $obj->total_additionalChildren_pdf       = (int)$row["total_children"] - 1;
                }
    
                $obj->adult_serv_amt = round((int)$row['adult_service_amount']);
                if($obj->totalChildren_pdf > 0){
                    $obj->child_serv_amt = round((int)$row['children_service_amount']);
                }else{
                    $obj->child_serv_amt = 0;
                }
    
                if((float)$row["additional_adult_service_amount"] == 0 && $obj->total_additionalAdult_pdf > 0){
                    $obj->add_adult_service_amount = round($obj->adult_serv_amt * $obj->total_additionalAdult_pdf);
                }else{
                    $obj->add_adult_service_amount = round(((int)$row["additional_adult_service_amount"]) * $obj->total_additionalAdult_pdf);
                }
                if((float)$row["additional_children_service_amount"] == 0 && $obj->total_additionalChildren_pdf > 0){
                    $obj->add_children_service_amount = round($obj->child_serv_amt * $obj->total_additionalChildren_pdf);
                }else{
                    $obj->add_children_service_amount = round(((int)$row["additional_children_service_amount"]) * $obj->total_additionalChildren_pdf);
                }

                $sum_amt_persons = round($obj->adult_serv_amt + $obj->child_serv_amt + $obj->add_adult_service_amount + $obj->add_children_service_amount);

                //Calculate the Discount
                $obj->adult_discount = round(($obj->discount * $obj->adult_serv_amt) / ($sum_amt_persons));
                $obj->child_discount = round(($obj->discount * $obj->child_serv_amt) / ($sum_amt_persons));
                $obj->add_adult_discount = round(($obj->discount * $obj->add_adult_service_amount) / ($sum_amt_persons));
                $obj->add_child_discount = round(($obj->discount * $obj->add_children_service_amount) / ($sum_amt_persons));

                //Calculate the Net Amount
                $obj->adult_net_amt = $obj->adult_serv_amt - $obj->adult_discount;
                $obj->child_net_amt = $obj->child_serv_amt - $obj->child_discount;

                if((int)$obj->add_adult_service_amount != 0){
                    $obj->add_adult_net_amt = $obj->add_adult_service_amount - $obj->add_adult_discount;
                }else{
                    $obj->add_adult_net_amt = 0;
                }
                if((int)$obj->add_children_service_amount != 0){
                    $obj->add_child_net_amt = $obj->add_children_service_amount - $obj->add_child_discount;
                }else{
                    $obj->add_child_net_amt = 0;
                }

                $obj->adult_taxable_val = number_format((($obj->adult_net_amt * 100)/118), 2, '.', '');
                $obj->child_taxable_val = number_format((($obj->child_net_amt * 100)/118), 2, '.', '');
                $obj->add_adult_taxable_val = number_format((($obj->add_adult_net_amt * 100)/118), 2, '.', '');
                $obj->add_child_taxable_val = number_format((($obj->add_child_net_amt * 100)/118), 2, '.', '');

                //Calculate the Tax Amount
                if($tax_type == 1){
                    $obj->tax_rate1 = '18% IGST';
                    $obj->tax_rate2 = '';
                    $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.18), 2, '.', ''));
                    $obj->adult_tax_amt2 = '';
                    $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.18), 2, '.', ''));
                    $obj->child_tax_amt2 = '';
                    $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.18), 2, '.', ''));
                    $obj->add_adult_tax_amt2 = '';
                    $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.18), 2, '.', ''));
                    $obj->add_child_tax_amt2 = '';
                }else if($tax_type == 2){
                    $obj->tax_rate1 = '9% CGST';
                    $obj->tax_rate2 = '9% SGST';
                    $obj->adult_tax_amt1 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->adult_tax_amt2 = strval(number_format(((float)$obj->adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->child_tax_amt1 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                    $obj->child_tax_amt2 = strval(number_format(((float)$obj->child_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_adult_tax_amt1 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_adult_tax_amt2 = strval(number_format(((float)$obj->add_adult_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_child_tax_amt1 = strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                    $obj->add_child_tax_amt2 =  strval(number_format(((float)$obj->add_child_taxable_val * 0.09), 2, '.', ''));
                }

                //Calculate the Sub Total
                $obj->adult_sub_total = round((float)$obj->adult_taxable_val + (float)$obj->adult_tax_amt1 + (float)$obj->adult_tax_amt2);
                $obj->child_sub_total = round((float)$obj->child_taxable_val + (float)$obj->child_tax_amt1 + (float)$obj->child_tax_amt2);
                $obj->add_adult_sub_total = round((float)$obj->add_adult_taxable_val + (float)$obj->add_adult_tax_amt1 + (float)$obj->add_adult_tax_amt2);
                $obj->add_child_sub_total = round((float)$obj->add_child_taxable_val + (float)$obj->add_child_tax_amt1 + (float)$obj->add_child_tax_amt2);
            }

            // $obj->net_amt = strval(round(((int)$row['net_amount']*100)/118));
            $obj->tax_type = $tax_type;
            $obj->gst_no = $gst_no;
            $obj->place_serv = $place_serv;
            if($obj->gst_no != ''){
                $obj->ut_code = substr($gst_no,0,2);
            }else{
                $obj->ut_code = '';
            }
            // $obj->ut_code = $ut_code;
            $obj->pan_no = $pan_no;
            $obj->company_names = $company_names;
            $obj->address = $address;
            $obj->num_count = $num_count;
            $obj->max = $max;
            $obj->ext_gst_serv_amt = $ext_gst_serv_amt;
            $obj->count_services = $count_services;
            array_push($array, $obj);
            
            $after_cal_net_amt = (int)$obj->adult_sub_total + (int)$obj->child_sub_total + (int)$obj->add_adult_sub_total + (int)$obj->add_child_sub_total;
            $after_cal_dis = (int)$obj->adult_discount + (int)$obj->child_discount + (int)$obj->add_adult_discount + (int)$obj->add_child_discount;

            $query2 ="UPDATE `users__booking_detail`
                        SET
                            `after_discount_net_amt`=:after_cal_net_amt,
                            `after_cal_discount_amt`=:after_cal_dis
                        WHERE
                            `token`=:token AND `booking_token`=:booking_token";
            // prepare query
            $this->stmts1 = $this->conn->prepare($query2);
            
            // bind values
            $this->stmts1->bindParam(":token", $row['token']);
            $this->stmts1->bindParam(":booking_token",  $row['booking_token']);
            $this->stmts1->bindParam(":after_cal_net_amt",  $after_cal_net_amt);
            $this->stmts1->bindParam(":after_cal_dis",  $after_cal_dis);
            $this->stmts1->execute();
        }
        $query1 ="UPDATE `users__booking`
                    SET
                        `airportzo_gst_no`=:airportzo_gst_no,
                        `place_of_service`=:place_of_service
                    WHERE
                        `token`=:booking_token";
        // prepare query
        $this->stmts = $this->conn->prepare($query1);
        
        // bind values
        $this->stmts->bindParam(":booking_token", $this->booking_token);
        $this->stmts->bindParam(":airportzo_gst_no", $gst_no);
        $this->stmts->bindParam(":place_of_service", $place_serv);
        // execute query
        // return true;
        $this->stmts->execute();
        // $this->stmts->debugDumpParams();

        return $array;
    }
}

?>