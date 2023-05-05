<?php
class ServiceLocation extends Database {
    // object properties
    public $airport_ttr_token; //3858074815
    public $business_type_token;
    public $service_token;
    public $tokens;
    public $stmt;

    public $column_list = "`service__location`.`token`,
        `service__location`.`service_token`,
        `service`.`service_provider_company_token` AS `sp_company_token`,
        `service`.`business_type_token` AS unique_business_token,
        `service__provider_company`.`name` AS `sp_company_name`,
        `service__provider_company`.`logo` AS `sp_company_logo`,
        `service__provider_company`.`image` AS `sp_company_image`,
        `service`.`type` AS `service_type`,
        `service`.`name` AS `service_name`,
        `service__location`.`price_adult`,
        `service__location`.`price_children`,
        `service__location`.`additional_price_adult`,
        `service__location`.`additional_price_children`,
        GROUP_CONCAT(DISTINCT `business_type`.`name`) AS `business_names`,
        GROUP_CONCAT(DISTINCT `business_type`.`token`) AS `business_token`,
        GROUP_CONCAT(DISTINCT `service__features`.`name` ORDER BY `service__features`.`id` SEPARATOR '|&|') AS `service_features`,
        `service__provider_company_location`.`token` AS `service_provider_company_location_token`,
        `service__provider_company_location`.`about` AS `service_provider_company_location_about`,
        `service__provider_company_location`.`terms_conditions`,
        `service__provider_company_location`.`privacy_policy`,
        `service__provider_company_location`.`cancellation_policy`,
        `service__provider_company_location`.`reschedule_policy`,
        COALESCE(GROUP_CONCAT(DISTINCT `service__provider_company_location_cancel_charge`.`id`, '||', `service__provider_company_location_cancel_charge`.`hours`, '||', `service__provider_company_location_cancel_charge`.`percentage` SEPARATOR '|&|'), '') AS `cancel_charges`";
    public $table_list = "`service__location`
        INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`token`=`service__location`.`airport_ttr_token`
        INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token`
        INNER JOIN `service__business_relation` ON `service__business_relation`.`service_token` = `service`.`token`
        INNER JOIN `business_type` ON `business_type`.`token` = `service__business_relation`.`business_type_token`
        INNER JOIN `service__provider_company` ON `service__provider_company`.`token` = `service`.`service_provider_company_token` AND `service__provider_company`.`status` = 2
        INNER JOIN `service__provider` ON `service__provider`.`token` = `service__provider_company`.`service_provider_token` AND `service__provider`.`status` = 0
        INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`company_token` = `service`.`service_provider_company_token` AND `service__provider_company_location`.`airport_token`=`airport__terminal_type_relation`.`airport_token` AND `service__provider_company_location`.`token`=`service`.`service_provider_company_location_token`
        LEFT JOIN `service__provider_company_location_cancel_charge` ON `service__provider_company_location_cancel_charge`.`service_provider_company_location_token` = `service__provider_company_location`.`token` AND `service__provider_company_location_cancel_charge`.`status` = 1
        LEFT JOIN `service__features` ON `service__features`.`service_location_token` = `service__location`.`token` AND `service__features`.`status`=1";

    // search Services For TTRToken
    public function searchServicesForTTRToken() {
        // $this->service_location_token = htmlspecialchars(strip_tags($this->service_location_token));

        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `service__location`.`airport_ttr_token`=:airport_ttr_token AND `service__location`.`status`=1 AND `service`.`status`=1
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":airport_ttr_token", $this->airport_ttr_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // search Services For TTRToken & ServiceToken
    public function searchServicesForTTRTokenAndServiceToken() {
        // $this->service_location_token = htmlspecialchars(strip_tags($this->service_location_token));

        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `service__location`.`airport_ttr_token`=:airport_ttr_token AND `service__location`.`service_token`=:service_token AND `service__location`.`status`=1
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":service_token", $this->service_token);
        $this->stmt->bindParam(":airport_ttr_token", $this->airport_ttr_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // search Services For TTRToken & businessToken
    public function searchServicesForTTRTokenAndBusinessToken() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `service__location`.`airport_ttr_token`=:airport_ttr_token AND `service__business_relation`.`business_type_token`=:business_type_token AND `service__location`.`status`=1
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);
        $this->stmt->bindParam(":airport_ttr_token", $this->airport_ttr_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // search Services For TTRToken & businessToken
    public function searchServicesForTokens() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `service__location`.`token` IN (" . $this->tokens . ") AND `service__location`.`status`=1
            GROUP BY
                `service__location`.`token`
            ORDER BY
                `service`.`type`,
                `service__location`.`price_adult`";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Service location' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
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

            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->service_token = trim($row['service_token']);
            $obj->sp_company_token = trim($row['sp_company_token']);
            $obj->unique_business_token = trim($row['unique_business_token']);
            $obj->sp_company_name = trim($row['sp_company_name']);
            $obj->sp_company_logo = trim($row['sp_company_logo']);
            $obj->sp_company_image = trim($row['sp_company_image']);
            $obj->service_type = trim($row['service_type']);
            $obj->service_name = trim($row['service_name']);
            $obj->price_adult = (int) trim($row['price_adult']);
            $obj->price_children = (int) trim($row['price_children']);
            $obj->additional_price_adult = (int) trim($row['additional_price_adult']);
            $obj->additional_price_children = (int) trim($row['additional_price_children']);
            $obj->business_names = explode(",", trim($row['business_names']));
            $obj->business_token = explode(",", trim($row['business_token']));
            $obj->service_features = explode("|&|", trim($row['service_features']));
            $obj->service_provider_company_location_token = trim($row['service_provider_company_location_token']);
            $obj->description = trim($row['service_provider_company_location_about']);
            $obj->terms_conditions = trim($row['terms_conditions']);
            $obj->privacy_policy = trim($row['privacy_policy']);
            $obj->cancellation_policy = trim($row['cancellation_policy']);
            $obj->reschedule_policy = trim($row['reschedule_policy']);
            $obj->cancellation_policy_detail = $cancel_charges_array;

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
    }
}
?>