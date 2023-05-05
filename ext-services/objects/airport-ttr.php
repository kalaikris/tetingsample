<?php
class AirportTTR extends Database {
    // object properties
    public $token;
    public $airport_token;
    public $terminal_token;
    public $type_token;
    public $category_token;
    public $stmt;

    public $column_list = "`airport`.`token` AS `airport_token`,
        UPPER(`airport`.`code`) AS `airport_code`,
        `airport`.`name` AS `airport_name`,
        `airport__terminal`.`token` AS `terminal_token`,
        `airport__terminal`.`name` AS `terminal_name`,
        `cities`.`name` AS `city`,
        `regions`.`name` AS `region`,
        `countries`.`name` AS `country`,
        UPPER(`countries`.`code`) AS `country_code`,
        `airport__type`.`token` AS `type_token`,
        `airport__type`.`name` AS `type_name`,
        `airport__category`.`token` AS `category_token`,
        `airport__category`.`name` AS `category_name`";

    public $table_list = "`airport__terminal_type_relation`
        INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
        INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
        INNER JOIN `cities` ON `cities`.`id`=`airport`.`city_id`
        INNER JOIN `regions` ON `regions`.`id`=`cities`.`region_id`
        INNER JOIN `countries` ON `countries`.`id`=`cities`.`country_id`";

    // Read terminals
    public function readAllTerminals() {
        $query = "SELECT
                UPPER(`airport`.`code`) AS `airport_code`,
                `airport`.`name` AS `airport_name`,
                `airport__terminal`.`name` AS `terminal_name`,
                `cities`.`name` AS `city`,
                `regions`.`name` AS `region`,
                `countries`.`name` AS `country`,
                UPPER(`countries`.`code`) AS `country_code`
            FROM
                `airport__terminal_type_relation`
            INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `cities` ON `cities`.`id`=`airport`.`city_id`
            INNER JOIN `regions` ON `regions`.`id`=`cities`.`region_id`
            INNER JOIN `countries` ON `countries`.`id`=`cities`.`country_id`
            GROUP BY
                CONCAT(`airport`.`token`, `airport__terminal`.`token`)
            ORDER BY
                `airport`.`code`, `airport`.`name`, `airport__terminal`.`name`";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
    }

    // TTR' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->airport_code = trim($row['airport_code']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->country = trim($row['country']);
            $obj->country_code = trim($row['country_code']);
            $obj->city = trim($row['city']);
            $obj->region = trim($row['region']);
            $obj->terminal_name = trim($row['terminal_name']);

            array_push($array, $obj);
        }

        return $array;
    }

    // Search terminals
    public function getTerminalTTRDetail() {
        $query = "SELECT
                `airport__terminal_type_relation`.`token` AS `ttr_token`,
                `airport__type`.`name` AS `type_name`,
                `airport__type`.`token` AS `type_token`,
                `airport__category`.`name` AS `category_name`,
                `airport__category`.`token` AS `category_token`,
                `airport`.`token` AS `airport_token`,
                UPPER(`airport`.`code`) AS `airport_code`,
                `airport`.`name` AS `airport_name`,
                `airport__terminal`.`token` AS `terminal_token`,
                `airport__terminal`.`name` AS `terminal_name`
            FROM
                `airport__terminal_type_relation`
            INNER JOIN `airport` ON `airport`.`token`=`airport__terminal_type_relation`.`airport_token`
            INNER JOIN `airport__terminal` ON `airport__terminal`.`token`=`airport__terminal_type_relation`.`terminal_token`
            INNER JOIN `airport__type` ON `airport__type`.`token`=`airport__terminal_type_relation`.`type_token`
            INNER JOIN `airport__category` ON `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
            WHERE `airport`.`code`=:airport_code
                AND `airport__terminal`.`name`=:terminal_name
                AND `airport__type`.`name`=:type_name
                AND `airport__category`.`name`=:category_name
            ORDER BY `airport`.`name`, `airport__terminal`.`name`";

        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":airport_code", $this->airport_code);
        $this->stmt->bindParam(":terminal_name", $this->terminal_name);
        $this->stmt->bindParam(":type_name", $this->type_name);
        $this->stmt->bindParam(":category_name", $this->category_name);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // TTR' View
    function makeViewTTRDetail() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->ttr_token = trim($row['ttr_token']);
            $obj->type_name = trim($row['type_name']);
            $obj->type_token = trim($row['type_token']);
            $obj->category_name = trim($row['category_name']);
            $obj->category_token = trim($row['category_token']);
            $obj->airport_token = trim($row['airport_token']);
            $obj->airport_code = trim($row['airport_code']);
            $obj->airport_name = trim($row['airport_name']);
            $obj->terminal_token = trim($row['terminal_token']);
            $obj->terminal_name = trim($row['terminal_name']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>