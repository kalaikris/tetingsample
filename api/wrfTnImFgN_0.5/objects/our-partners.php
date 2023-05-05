<?php
class OurPartners extends Database {
    // object properties
    public $id;
    public $token;
    public $name;
    public $image;
    public $status;
    public $date_time;

    public $stmt;

    // Read our partners
    public function readOurPartners() {
        $query = "SELECT
                `id`,
                `token`,
                `name`,
                `image`,
                `status`,
                `date_time`
            FROM
                `our_partners`
            WHERE
                `status` = 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Partners' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);
            $obj->status = trim($row['status']);
            $obj->date_time = date("d M,Y h:i A", strtotime(trim($row['date_time'])));

            array_push($array, $obj);
        }

        return $array;
    }
}

?>