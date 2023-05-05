<?php
class Countries extends Database {
    // object properties
    public $id;
    public $name;
    public $code;
    public $gmt;
    
    public $stmt;

    // read all countries
    public function read() {
        $query = "SELECT
                `id`,
                `name`,
                `code`,
                `gmt`
            FROM
                `countries`
            WHERE
                `name` != '' AND `code` != ''
            ORDER BY
                `name`";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
    }

    // countries' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->name = trim($row['name']);
            $obj->code = trim($row['code']);
            $obj->gmt = trim($row['gmt']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
