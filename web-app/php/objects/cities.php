<?php
class Cities extends Database {
    // object properties
    public $id;
    public $latitude;
    public $longitude;
    public $name;

    public $country_id;
    public $region_id;

    public $stmt;

    // read for region and country
    public function readForRegionAndCountry() {
        $query = "SELECT
                `id`,
                `latitude`,
                `longitude`,
                `name`
            FROM
                `cities`
            WHERE
                `region_id` = :region_id AND `country_id` = :country_id
            ORDER BY
                `name`";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":region_id", $this->region_id);
        $this->stmt->bindParam(":country_id", $this->country_id);

        $this->stmt->execute();
    }

    // cities' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->latitude = trim($row['latitude']);
            $obj->longitude = trim($row['longitude']);
            $obj->name = trim($row['name']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
