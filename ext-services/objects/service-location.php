<?php
class ServiceLocation extends Database {
    // object properties
    public $airport_ttr_token; //3858074815
    public $business_type_token;
    public $service_token;
    public $tokens;
    public $stmt;

    public $column_list = "`service__location`.`token` AS `service__location_token`,
        `service__location`.`service_token`,
        `service`.`service_provider_company_token` AS `sp_company_token`,
        `service__provider_company`.`name` AS `sp_company_name`,
        `service__provider_company`.`logo` AS `sp_company_logo`,
        `service__provider_company`.`image` AS `sp_company_image`,
        `service`.`type` AS `service_type`,
        `service`.`name` AS `service_name`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `service__location`.`additional_price_adult`,
        `service__location`.`additional_price_children`,
        GROUP_CONCAT(DISTINCT `business_type`.`token`, '|=|', `business_type`.`name` SEPARATOR '|&|') AS `businesses`,
        GROUP_CONCAT(DISTINCT `service__features`.`name` SEPARATOR '|&|') AS `service_features`,
        `service__provider_company_location`.`token` AS `service_provider_company_location_token`,
        `service__provider_company_location`.`about` AS `about_description`,
        COALESCE(`service__provider_company_location`.`reschedule_policy`, '') AS `reschedule_policy`,
        COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`,
        `service__distributor`.`name` AS `distributor_name`,
        `service__distributor`.`markup_type`";
        // GROUP_CONCAT(DISTINCT `business_type`.`name`) AS `business_names`,
    public $table_list = "`service__location`
        INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`token` = `service__location`.`airport_ttr_token`
        INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`
        INNER JOIN `airport__category` ON `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
        INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token`
        INNER JOIN `service__business_relation` ON `service__business_relation`.`service_token` = `service`.`token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__business_relation`.`business_type_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `service`.`service_provider_company_token` AND `service__provider_company`.`status` = 2
        INNER JOIN `service__provider` ON `service__provider`.`token` = `service__provider_company`.`service_provider_token` AND `service__provider`.`status` = 0
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token` = `service`.`service_provider_company_token` AND `service__provider_company_location`.`airport_token` = `airport__terminal_type_relation`.`airport_token`
        INNER JOIN `service__distributor` ON `service__distributor`.`token` = :distributor_token
        LEFT JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token` = `service__provider_company_location`.`token` AND `service__provider_company_location_cancel_charge`.`status` = 1
        LEFT JOIN `service__features` ON `service__features`.`service_location_token` = `service__location`.`token` AND `service__features`.`status`=1";

    public function searchServicesForStation() {
        $query = "SELECT
                `service__location`.`token` AS `service__location_token`,
        `service__location`.`service_token`,
        `service`.`service_provider_company_token` AS `sp_company_token`,
        `service__provider_company`.`name` AS `sp_company_name`,
        `service__provider_company`.`logo` AS `sp_company_logo`,
        `service__provider_company`.`image` AS `sp_company_image`,
        `service`.`type` AS `service_type`,
        `service`.`name` AS `service_name`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `service__location`.`additional_price_adult`,
        `service__location`.`additional_price_children`,
        GROUP_CONCAT(DISTINCT `business_type`.`token`, '|=|', `business_type`.`name` SEPARATOR '|&|') AS `businesses`,
        GROUP_CONCAT(DISTINCT `service__features`.`name` ORDER BY `service__features`.`id` SEPARATOR '|&|') AS `service_features`,
        `service__provider_company_location`.`token` AS `service_provider_company_location_token`,
        `service__provider_company_location`.`about` AS `about_description`,
        COALESCE(`service__provider_company_location`.`reschedule_policy`, '') AS `reschedule_policy`,
        COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`,
        `service__distributor`.`name` AS `distributor_name`,
        `service__distributor`.`is_markup`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`
            FROM
                `service__location`
        INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`token` = `service__location`.`airport_ttr_token`
        INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`
        INNER JOIN `airport__category` ON `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
        INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token`
        INNER JOIN `service__business_relation` ON `service__business_relation`.`service_token` = `service`.`token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__business_relation`.`business_type_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `service`.`service_provider_company_token` AND `service__provider_company`.`status` = 2
        INNER JOIN `service__provider` ON `service__provider`.`token` = `service__provider_company`.`service_provider_token` AND `service__provider`.`status` = 0
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token` = `service`.`service_provider_company_token` AND `service__provider_company_location`.`airport_token` = `airport__terminal_type_relation`.`airport_token`
		INNER JOIN `service__distributor` ON `service__distributor`.`token` = :distributor_token
        LEFT JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token` = `service__provider_company_location`.`token` AND `service__provider_company_location_cancel_charge`.`status` = 1
        LEFT JOIN `service__features` ON `service__features`.`service_location_token` = `service__location`.`token` AND `service__features`.`status`=1
            WHERE
                `airport`.`code`=:airport_code AND `airport__terminal`.`name`=:terminal_name AND `airport__category`.`name`=:category_name AND `airport__type`.`name`=:type_name AND `service__distributor`.`token`=:distributor_token AND `service__location`.`status` = 1
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";
        
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":airport_code", $this->airport_code);
        $this->stmt->bindParam(":terminal_name", $this->terminal_name);
        $this->stmt->bindParam(":category_name", $this->category_name);
        $this->stmt->bindParam(":type_name", $this->type_name);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);

        $this->stmt->execute();
        //$this->stmt->debugDumpParams();
    }

    public function searchServicesForStationAndServiceToken() {
        $query = "SELECT
                " . $this->column_list . ",
        `service__distributor`.`is_markup`,
        `service__distributor`.`markup_value`
            FROM
                " . $this->table_list . "
            WHERE
                `airport`.`code`=:airport_code AND `airport__terminal`.`name`=:terminal_name AND `airport__category`.`name`=:category_name AND `airport__type`.`name`=:type_name AND `service__location`.`service_token`=:service_token AND `service__distributor`.`token`=:distributor_token
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";
        
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":airport_code", $this->airport_code);
        $this->stmt->bindParam(":terminal_name", $this->terminal_name);
        $this->stmt->bindParam(":category_name", $this->category_name);
        $this->stmt->bindParam(":type_name", $this->type_name);
        $this->stmt->bindParam(":service_token", $this->service_token);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Service location' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $businesses = (trim($row['businesses']) != '')? explode("|&|", trim($row['businesses'])): [];
            $business_tokens = [];
            $business_names = [];
            foreach ($businesses as $business_value) {
                $business_detail = explode("|=|", $business_value);
                array_push($business_tokens, $business_detail[0]);
                array_push($business_names, $business_detail[1]);
            }
            unset($business_value);

            $service_features = explode("|&|", trim($row['service_features']));
            foreach ($service_features as $sf_key => $sf_value) {
                $service_features[$sf_key] = trim($sf_value);
            }
            unset($sf_value);

            $cancel_charges_detail = (trim($row['cancel_charges']) != '')? explode("|&|", trim($row['cancel_charges'])): [];
            $cancel_charges_array = [];

            foreach ($cancel_charges_detail as $cancel_charges_key => $cancel_charges_value) {
                $cancel_policy = explode("||", $cancel_charges_value);

                $cancel_obj = new stdClass;
                $cancel_obj->cancellation_hours_before = intval($cancel_policy[1]);
                $cancel_obj->cancellation_fee_percentage = intval($cancel_policy[2]);
                array_push($cancel_charges_array, $cancel_obj);
            }
            unset($cancel_charges_value);

            // $sp_obj = new stdClass;
            // $sp_obj->token = trim($row['sp_company_token']);
            // $sp_obj->name = trim($row['sp_company_name']);
            // $sp_obj->image = trim($row['sp_company_image']);
            // $sp_obj->logo = trim($row['sp_company_logo']);

            $obj = new stdClass;
            $obj->service__location_token = trim($row['service__location_token']);
            $obj->package_type = trim($row['service_type']);
            $obj->service_provider_token = trim($row['sp_company_token']);
            $obj->service_provider_name = trim($row['sp_company_name']);
            $obj->service_provider_logo = trim($row['sp_company_logo']);
            $obj->service_token = trim($row['service_token']);
            $obj->service_name = trim($row['service_name']);
            $obj->gst_percentage = '18%';
            $obj->links = new stdClass;
            $obj->business_tokens = $business_tokens;
            $obj->business_names = $business_names;
            $obj->service_features = $service_features;

             if($row["is_markup"] == '1'){
                if($row['markup_type'] == 'Percentage'){
                    $obj->adult_amount = (int) trim(($row['price_adult']*100)/118);
                    $obj->adult_markup_amount = (int) trim(($obj->adult_amount * $row['markup_value'])/100);
                    $obj->adult_gst_amount = (int)round((($obj->adult_amount + $obj->adult_markup_amount)*18)/100);
                    $obj->price_adult = (int)($obj->adult_amount + $obj->adult_markup_amount + $obj->adult_gst_amount);

                    
                    $obj->children_amount = (int) trim(($row['price_children']*100)/118);
                    $obj->children_markup_amount = (int) trim(($obj->children_amount * $row['markup_value'])/100);
                    $obj->children_gst_amount = (int)round((($obj->children_amount + $obj->children_markup_amount)*18)/100);
                    $obj->price_children = (int)round($obj->children_amount + $obj->children_markup_amount + $obj->children_gst_amount);


                    $obj->additional_adult_amount = (int) trim(($row['additional_price_adult']*100)/118);
                    $obj->additional_adult_markup_amount = (int) trim(($obj->additional_adult_amount * $row['markup_value'])/100);
                    $obj->additional_adult_gst_amount = (int)round((($obj->additional_adult_amount + $obj->additional_adult_markup_amount)*18)/100);
                    $obj->additional_price_adult = (int) round($obj->additional_adult_amount + $obj->additional_adult_markup_amount + $obj->additional_adult_gst_amount);


                    $obj->additional_children_amount = (int) trim(($row['additional_price_children']*100)/118);
                    $obj->additional_children_markup_amount = (int) trim(($obj->additional_children_amount * $row['markup_value'])/100);
                    $obj->additional_children_gst_amount = (int)round((($obj->additional_children_amount + $obj->additional_children_markup_amount)*18)/100);
                    $obj->additional_price_children = (int)round($obj->additional_children_amount + $obj->additional_children_markup_amount + $obj->additional_children_gst_amount);

                    // $gst_adult = ceil((float) trim($row['price_adult'] * ((100 + $row['markup_value']) / 100))*18/100);
                    // $price_adult = ceil((float) trim($row['price_adult'] * ((100 + $row['markup_value']) / 100)));
                    // $obj->adult_amount = $price_adult-$gst_adult;
                    // $obj->adult_gst_amount = $gst_adult;
                    // $obj->price_adult = $price_adult;
                    
                    // $gst_children = ceil((float) trim($row['price_children'] * ((100 + $row['markup_value']) / 100))*18/100);
                    // $price_children = ceil((float) trim($row['price_children'] * ((100 + $row['markup_value']) / 100)));
                    // $obj->children_amount = $price_children-$gst_children;
                    // $obj->children_gst_amount = $gst_children;
                    // $obj->price_children = $price_children;
                    
                    // $gst_additional_adult = ceil((float) trim($row['additional_price_adult'] * ((100 + $row['markup_value']) / 100))*18/100);
                    // $price_additional_adult = ceil((float) trim($row['additional_price_adult'] * ((100 + $row['markup_value']) / 100)));
                    // $obj->additional_adult_amount = $price_additional_adult-$gst_additional_adult;
                    // $obj->additional_adult_gst_amount = $gst_additional_adult;
                    // $obj->additional_price_adult = $price_additional_adult;
                    
                    // $gst_additional_children = ceil((float) trim($row['additional_price_children'] * ((100 + $row['markup_value']) / 100))*18/100);
                    // $price_additional_children = ceil((float) trim($row['additional_price_children'] * ((100 + $row['markup_value']) / 100)));
                    // $obj->additional_children_amount = $price_additional_children-$gst_additional_children;
                    // $obj->additional_children_gst_amount = $gst_additional_children;
                    // $obj->additional_price_children = $price_additional_children;
                    
                    $obj->markupAmount = ceil($row['price_adult'] * ($row['markup_value']) / 100);
                    $obj->markupType = $row['markup_type'];
                    $obj->is_markup = $row["is_markup"];
                    $obj->markupPercentage = trim($row['markup_value']);
                    
                } else {

                    $obj->adult_amount = (int) trim(($row['price_adult']*100)/118);
                    $obj->adult_markup_amount = (float)$row['markup_value'];
                    $obj->adult_gst_amount = (int)round((($obj->adult_amount + $obj->adult_markup_amount)*18)/100);
                    $obj->price_adult = (int)($obj->adult_amount + $obj->adult_markup_amount + $obj->adult_gst_amount);
                    
                    $obj->children_amount = (int) trim(($row['price_children']*100)/118);
                    $obj->children_markup_amount = (float)$row['markup_value'];
                    $obj->children_gst_amount = (int)round((($obj->children_amount + $obj->children_markup_amount)*18)/100);
                    $obj->price_children = (int)round($obj->children_amount + $obj->children_markup_amount + $obj->children_gst_amount);

                    $obj->additional_adult_amount = (int) trim(($row['additional_price_adult']*100)/118);
                    $obj->additional_adult_markup_amount = (float)$row['markup_value'];
                    $obj->additional_adult_gst_amount = (int)round((($obj->additional_adult_amount + $obj->additional_adult_markup_amount)*18)/100);
                    $obj->additional_price_adult = (int) round($obj->additional_adult_amount + $obj->additional_adult_markup_amount + $obj->additional_adult_gst_amount);

                    $obj->additional_children_amount = (int) trim(($row['additional_price_children']*100)/118);
                    $obj->additional_children_markup_amount = (float) $row['markup_value'];
                    $obj->additional_children_gst_amount = (int)round((($obj->additional_children_amount + $obj->additional_children_markup_amount)*18)/100);
                    $obj->additional_price_children = (int)round($obj->additional_children_amount + $obj->additional_children_markup_amount + $obj->additional_children_gst_amount);

                    // $gst_adult = ceil(trim($row['price_adult'] + $row['markup_value'])*18/100);
                    // $price_adult = ceil(trim($row['price_adult'] + $row['markup_value']));
                    // $obj->adult_amount = $price_adult-$gst_adult;
                    // $obj->adult_gst_amount = $gst_adult;
                    // $obj->price_adult = $price_adult;
                    
                    // $gst_children = ceil(trim($row['price_children'] + $row['markup_value'])*18/100);
                    // $price_children = ceil(trim($row['price_children'] + $row['markup_value']));
                    // $obj->children_amount = $price_children-$gst_children;
                    // $obj->children_gst_amount = $gst_children;
                    // $obj->price_children = $price_children;
                     
                    // $gst_additional_adult = ceil(trim($row['additional_price_adult'] + $row['markup_value'])*18/100);
                    // $price_additional_adult = ceil(trim($row['additional_price_adult'] + $row['markup_value']));
                    // $obj->additional_adult_amount = $price_additional_adult-$gst_additional_adult;
                    // $obj->additional_adult_gst_amount = $gst_additional_adult;
                    // $obj->additional_price_adult = $price_additional_adult;
                    
                    // $gst_additional_children = ceil(trim($row['additional_price_children'] + $row['markup_value'])*18/100);
                    // $price_additional_children = ceil(trim($row['additional_price_children'] + $row['markup_value']));
                    // $obj->additional_children_amount = $price_additional_children-$gst_additional_children;
                    // $obj->additional_children_gst_amount = $gst_additional_children;
                    // $obj->additional_price_children = $price_additional_children;
                    
                    $obj->markupAmount = (int) trim($row['markup_value']);
                    $obj->markupType = $row['markup_type'];
                    $obj->is_markup = $row["is_markup"];
                    $obj->markupPercentage = trim($row['markup_value']);
                }
            } else { 
                    $obj->adult_amount = (int) trim(($row['price_adult']*100)/118);
                    $obj->adult_markup_amount = 0;
                    $obj->adult_gst_amount = (int)round((($obj->adult_amount + $obj->adult_markup_amount)*18)/100);
                    $obj->price_adult = (int)($obj->adult_amount + $obj->adult_markup_amount + $obj->adult_gst_amount);
                    
                    $obj->children_amount = (int) trim(($row['price_children']*100)/118);
                    $obj->children_markup_amount = 0;
                    $obj->children_gst_amount = (int)round((($obj->children_amount + $obj->children_markup_amount)*18)/100);
                    $obj->price_children = (int)round($obj->children_amount + $obj->children_markup_amount + $obj->children_gst_amount);

                    $obj->additional_adult_amount = (int) trim(($row['additional_price_adult']*100)/118);
                    $obj->additional_adult_markup_amount = 0;
                    $obj->additional_adult_gst_amount = (int)round((($obj->additional_adult_amount + $obj->additional_adult_markup_amount)*18)/100);
                    $obj->additional_price_adult = (int) round($obj->additional_adult_amount + $obj->additional_adult_markup_amount + $obj->additional_adult_gst_amount);

                    $obj->additional_children_amount = (int) trim(($row['additional_price_children']*100)/118);
                    $obj->additional_children_markup_amount = 0;
                    $obj->additional_children_gst_amount = (int)round((($obj->additional_children_amount + $obj->additional_children_markup_amount)*18)/100);
                    $obj->additional_price_children = (int)round($obj->additional_children_amount + $obj->additional_children_markup_amount + $obj->additional_children_gst_amount);

                    // $gst_adult = ceil(trim($row['price_adult']*18/100));
                    // $obj->adult_amount = ceil(trim($row['price_adult']-$gst_adult));
                    // $obj->adult_gst_amount = $gst_adult;
                    // $obj->price_adult = (int) trim($row['price_adult']);

                    // $gst_children = ceil($row['price_children']*18/100);
                    // $obj->children_amount = ceil(trim($row['price_children']-$gst_children));
                    // $obj->children_gst_amount = $gst_children;
                    // $obj->price_children = (int) trim($row['price_children']);
                 
                    // $gst_additional_adult = ceil(trim($row['additional_price_adult']*18/100));
                    // $price_additional_adult = trim($row['additional_price_adult']);
                    // $obj->additional_adult_amount = ceil($price_additional_adult-$gst_additional_adult);
                    // $obj->additional_adult_gst_amount = $gst_additional_adult;
                    // $obj->additional_price_adult = $price_additional_adult;
                    
                    // $gst_additional_children = ceil(trim($row['additional_price_children']*18/100));
                    // $price_additional_children = trim($row['additional_price_children']);
                    // $obj->additional_children_amount = $price_additional_children-$gst_additional_children;
                    // $obj->additional_children_gst_amount = $gst_additional_children;
                    // $obj->additional_price_children = $price_additional_children;
                 
                    $obj->markupAmount = "0";//(int) trim($row['markup_value']);
                    $obj->markupType = "";
                    $obj->is_markup = $row["is_markup"];
                    $obj->markupPercentage = 0;
            }
            

            // $obj->token = trim($row['service__location_token']);
            // $obj->service_token = trim($row['service_token']);
            // $obj->service_provider = $sp_obj;
            // // $obj->sp_company_token = trim($row['sp_company_token']);
            // // $obj->sp_company_name = trim($row['sp_company_name']);
            // // $obj->sp_company_logo = trim($row['sp_company_logo']);
            // // $obj->sp_company_image = trim($row['sp_company_image']);
            // $obj->service_type = trim($row['service_type']);
            // $obj->service_name = trim($row['service_name']);
            // $obj->price_adult = (int) trim($row['price_adult']);
            // $obj->price_children = (int) trim($row['price_children']);
            // $obj->business_tokens = $business_tokens;
            // $obj->business_names = $business_names; //explode(",", trim($row['business_names']));
            // $obj->service_features = explode("|&|", trim($row['service_features']));
            // $obj->service_provider_company_location_token = trim($row['service_provider_company_location_token']);
            // $obj->about_description = trim($row['about_description']);
             $obj->reschedule_policy = trim($row['reschedule_policy']);
             $obj->cancellation_policy_detail = $cancel_charges_array;

            array_push($array, $obj);
        }
        return $array;
    }

    public function getBusinessForStation() {
        $query = "SELECT DISTINCT
                `business_type`.`token`,
                `business_type`.`name`
            FROM
                `service__location`
            INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`token` = `service__location`.`airport_ttr_token`
            INNER JOIN `airport` ON `airport`.`token` = `airport__terminal_type_relation`.`airport_token`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token` = `airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `airport__type` ON `airport__type`.`token` = `airport__terminal_type_relation`.`type_token`
            INNER JOIN `airport__category` ON `airport__category`.`token` = `airport__terminal_type_relation`.`category_token`
            INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token`
            INNER JOIN `service__business_relation` ON `service__business_relation`.`service_token` = `service`.`token`
            INNER JOIN `business_type` ON `business_type`.`token` = `service__business_relation`.`business_type_token`
            WHERE
                `airport`.`code` = :airport_code AND `airport__terminal`.`name` = :terminal_name AND `airport__category`.`name` = :category_name AND `airport__type`.`name` = :type_name
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";
        
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":airport_code", $this->airport_code);
        $this->stmt->bindParam(":terminal_name", $this->terminal_name);
        $this->stmt->bindParam(":category_name", $this->category_name);
        $this->stmt->bindParam(":type_name", $this->type_name);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Business' View
    function makeBusinessView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);

            array_push($array, $obj);
        }
        return $array;
    }
    
    function getCommissionForServiceProvider(){
        $query = "SELECT
        `service__provider`.`is_credit`,
        `service__provider`.`credit_available`,
        `service__provider`.`token` AS `service_provider`,
        `service__provider_company_location`.`commission_percentage` 
        FROM `service__provider` 
        INNER JOIN `service__provider_company` ON `service__provider`.`token`=`service__provider_company`.`service_provider_token`
        INNER JOIN `service__provider_company_location` ON `service__provider_company`.`token` = `service__provider_company_location`.`company_token`
        WHERE `service__provider_company_location`.`company_token`=:sp_company_token AND `service__provider_company_location`.`airport_token`=:airport_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":sp_company_token", $this->sp_company_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->is_credit = $row["is_credit"];
        $obj->provider_credits = $row["credit_available"];
        $obj->commission_percentage = $row["commission_percentage"];
        $obj->service_provider = $row["service_provider"];
        return $obj;
    }
    
    function updateCreditAvailableAmount(){
        $query = "UPDATE `service__provider` SET `credit_available`=:credit_available WHERE `token`=:service_provider";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":credit_available", $this->balance_provider_credits);
        $this->stmt->bindParam(":service_provider", $this->service_provider);
        $this->stmt->execute();
        //$this->stmt->debugDumpParams();
    }
}

?>