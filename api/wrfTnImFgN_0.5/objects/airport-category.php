<?php
class AirportCategory extends Database {
    // object properties
    public $token;
    public $name;
    public $stmt;

    // search By Name
    public function searchByName() {
        $query = "SELECT
                `token`,
                `name`
            FROM
                `airport__category`
            WHERE `name`=:name
            LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":name", $this->name);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // airport__category' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
