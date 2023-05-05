<?php
class Airport extends Database {
    // object properties
    public $token;

    // search By Name
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
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->code = trim($row['code']);
            $obj->city_id = trim($row['city_id']);
            $obj->time_zone = trim($row['time_zone']);
            $obj->gmt = trim($row['gmt']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
