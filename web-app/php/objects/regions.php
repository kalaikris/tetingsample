<?php
class Regions extends Database {
    // object properties
    public $id;
    public $name;
    public $code;
    public $country_id;
    
    public $stmt;

    // read for country
    public function readForCountry() {
        $query = "SELECT
                `id`,
                `name`,
                `code`
            FROM
                `regions`
            WHERE
                `country_id` = :country_id AND `name` != '' AND `code` != ''
            ORDER BY
                `name`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":country_id", $this->country_id);

        $this->stmt->execute();
    }

    // regions' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->name = trim($row['name']);
            $obj->code = trim($row['code']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
