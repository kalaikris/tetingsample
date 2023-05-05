<?php
class AirportTTR extends Database {
    // object properties
    public $token;
    public $airport_token;
    public $terminal_token;
    public $type_token;
    public $category_token;
    public $stmt;

    public $column_list = "`airport__terminal_type_relation`.`token` AS `ttr_token`,
        `airport__terminal_type_relation`.`airport_token`,
        `airport`.`name` AS `airport_name`,
        `airport`.`code` AS `airport_code`,
        `airport`.`gmt_date` AS `airport_gmt_date`,
        `airport`.`city_id`,
        `cities`.`name` AS `city_name`,
        `cities`.`country_id`,
        `countries`.`name` AS `country_name`,
        UPPER(`countries`.`code`) AS `country_code`,
        `countries`.`gmt` AS `country_gmt`,
        `airport__terminal_type_relation`.`terminal_token`,
        `airport__terminal`.`name` AS `terminal_name`,
        `airport__terminal_type_relation`.`type_token`,
        `airport__type`.`name` AS `type_name`,
        `airport__terminal_type_relation`.`category_token`,
        COALESCE((SELECT COUNT(DISTINCT `cities`.`country_id`) FROM `cities` WHERE `cities`.`id` = `airport`.`city_id` GROUP BY `cities`.`country_id` HAVING `cities`.`country_id` = '96'),0) AS `location_check`,
        `airport__category`.`name` AS `category_name`";

    // Read terminals
    public function readAllTerminals() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                `airport__terminal_type_relation`
            INNER JOIN `airport` ON `airport`.`token` = `airport__terminal_type_relation`.`airport_token`
            INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
            INNER JOIN `countries` ON `countries`.`id` = `cities`.`country_id`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token` = `airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `airport__type` ON `airport__type`.`token` = `airport__terminal_type_relation`.`type_token`
            INNER JOIN `airport__category` ON `airport__category`.`token` = `airport__terminal_type_relation`.`category_token`
            WHERE `airport`.`status`='1'
            ORDER BY `airport`.`name`, `airport__terminal`.`name`";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
    }

    // Read terminals
    public function readOneTerminal() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                `airport__terminal_type_relation`
            INNER JOIN `airport` ON `airport`.`token` = `airport__terminal_type_relation`.`airport_token`
            INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
            INNER JOIN `countries` ON `countries`.`id` = `cities`.`country_id`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token` = `airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `airport__type` ON `airport__type`.`token` = `airport__terminal_type_relation`.`type_token`
            INNER JOIN `airport__category` ON `airport__category`.`token` = `airport__terminal_type_relation`.`category_token`
            WHERE `airport__terminal_type_relation`.`token`=:token
            ORDER BY `airport`.`name`, `airport__terminal`.`name`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Search terminals
    public function searchTerminal() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                `airport__terminal_type_relation`
            INNER JOIN `airport` ON `airport`.`token` = `airport__terminal_type_relation`.`airport_token`
            INNER JOIN `cities` ON `cities`.`id` = `airport`.`city_id`
            INNER JOIN `countries` ON `countries`.`id` = `cities`.`country_id`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token` = `airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `airport__type` ON `airport__type`.`token` = `airport__terminal_type_relation`.`type_token`
            INNER JOIN `airport__category` ON `airport__category`.`token` = `airport__terminal_type_relation`.`category_token`
            WHERE `airport__terminal_type_relation`.`airport_token`=:airport_token
                AND `airport__terminal_type_relation`.`terminal_token`=:terminal_token
                AND `airport__terminal_type_relation`.`type_token`=:type_token
                AND `airport__terminal_type_relation`.`category_token`=:category_token
            ORDER BY `airport`.`name`, `airport__terminal`.`name`";

        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":airport_token", $this->airport_token);
        $this->stmt->bindParam(":terminal_token", $this->terminal_token);
        $this->stmt->bindParam(":type_token", $this->type_token);
        $this->stmt->bindParam(":category_token", $this->category_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // TTR' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $tommorrowDate = new DateTime('tomorrow');
            $obj = new stdClass;
            $obj->ttr_token = trim($row['ttr_token']);
            $obj->airport_token = trim($row['airport_token']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->airport_code = trim($row['airport_code']);
            $nextdate = $this->departure_date;
            if($this->login_token == '1212121212'){
                $obj->airport_gmt_date = date("d-M-Y", strtotime($row['airport_gmt_date']));
            }else if(strtotime($tommorrowDate->format("d-M-Y")) == strtotime($nextdate)){
                $obj->airport_gmt_date = date("d-M-Y", strtotime($row['airport_gmt_date'].'+1 day') ); 
            }else{
                $obj->airport_gmt_date = $this->departure_date;
            }
            $obj->city_id = trim($row['city_id']);
            $obj->city_name = trim($row['city_name']);
            $obj->country_id = trim($row['country_id']);
            $obj->country_name = trim($row['country_name']);
            $obj->country_code = trim($row['country_code']);
            $obj->country_gmt = trim($row['country_gmt']);
            $obj->terminal_token = trim($row['terminal_token']);
            $obj->terminal_name = trim($row['terminal_name']);
            $obj->type_token = trim($row['type_token']);
            $obj->type_name = trim($row['type_name']);
            $obj->category_token = trim($row['category_token']);
            $obj->location_check = trim($row['location_check']);
            $obj->category_name = trim($row['category_name']);
            $obj->terminal_string1 = trim($row['city_name']) . ' (' . trim($row['airport_code']) . ')';
            $obj->terminal_string2 = trim($row['airport_name']) . ' - ' . trim($row['terminal_name']);
            $obj->terminal_string = trim($row['airport_code']) . ' - ' . trim($row['city_name']) . ', ' . trim($row['country_code']) . ', ' . trim($row['airport_name']) . ' - ' . trim($row['terminal_name']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
