<?php
class UsersExtJourney extends Database {
    // object properties
    public $token;
    public $sd_token;
    public $journey;
    public $is_active;

    public $column_list = "`id`,
    `token`,
    `journey`";
    public $stmt;
    
    public function create() {
        $query ="INSERT INTO `users__external_journey`
        SET
            `token`=:token,
            `sd_token`=:sd_token,
            `journey`=:journey";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":sd_token", $this->sd_token);
        $this->stmt->bindParam(":journey", $this->journey);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    //get Passenger list For Booking token
    public function getJourneyForToken() {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            " . $this->column_list . "
        FROM
            `users__external_journey`
        WHERE
            `token`=:token";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    //check Duplicate Journey
    public function checkDuplicateJourney() {
        $query = "SELECT
            " . $this->column_list . "
        FROM
            `users__external_journey`
        WHERE
            `sd_token`=:sd_token AND JSON_CONTAINS(`journey`, :journey)";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":sd_token", $this->sd_token);
        $this->stmt->bindParam(":journey", $this->journey);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Passengers' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->journey = trim($row['journey']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>