<?php
class Airport extends Database {
    // object properties
    public $token;
    public $airport_code;

    public $stmt;

    // search By Name
    public function readOneByCode() {
        $query = "SELECT
                `airport`.`id`,
                `airport`.`token`,
                `airport`.`name`,
                `airport`.`code`,
                `airport`.`gmt`,
                `cities`.`name` AS `city_name`,
                UPPER(`countries`.`code`) AS `country_code`,
                `countries`.`name` AS `country_name`
            FROM
                `airport`
            INNER JOIN `cities` ON `cities`.`id`=`airport`.`city_id`
            INNER JOIN `countries` ON `countries`.`id`=`cities`.`country_id`
            WHERE
                `airport`.`code` = :airport_code
            LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":airport_code", $this->airport_code);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }
    public function readOne() {
        $query = "SELECT
                `token`,
                `name`,
                `code`,
                `city_id`,
                `time_zone`,
                `gmt`
            FROM
                `airport`
            WHERE `token`=:token
            LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // airport' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->code = trim($row['code']);
            $obj->gmt = trim($row['gmt']);
            $obj->city_name = trim($row['city_name']);
            $obj->country_code = trim($row['country_code']);
            $obj->country_name = trim($row['country_name']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>