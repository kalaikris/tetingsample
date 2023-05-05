<?php
class UsersBookingJourney extends Database {
    // object properties
    public $id;
    public $token;
    public $booking_token;
    public $depart_ttr_token;
    public $arrival_ttr_token;
    public $depart_date;
    public $flight_number;
    public $date_time;

    public $stmt;
    
    public function create() {
        $query ="INSERT INTO `users__booking_journey`
        SET
            `token`=:token,
            `booking_token`=:booking_token,
            `depart_ttr_token`=:depart_ttr_token,
            `arrival_ttr_token`=:arrival_ttr_token,
            `depart_date`=:depart_date,
            `flight_number`=:flight_number";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":booking_token", $this->booking_token);
        $this->stmt->bindParam(":depart_ttr_token", $this->depart_ttr_token);
        $this->stmt->bindParam(":arrival_ttr_token", $this->arrival_ttr_token);
        $this->stmt->bindParam(":depart_date", $this->depart_date);
        $this->stmt->bindParam(":flight_number", $this->flight_number);
        
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;

        return ($this->stmt->execute())? true: false;
    }

    //get journey list For Booking token
    public function readForBooking() {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            `users__booking_journey`.`id`,
            `users__booking_journey`.`token`,
            `users__booking_journey`.`booking_token`,
            `users__booking_journey`.`depart_ttr_token`,
            DA.`code` AS `depart_airport_code`,
            DA.`name` AS `depart_airport`,
            DT.`name` AS `depart_terminal`,
            AA.`code` AS `arrival_airport_code`,
            AA.`name` AS `arrival_airport`,
            A_T.`name` AS `arrival_terminal`,
            `users__booking_journey`.`arrival_ttr_token`,
            `users__booking_journey`.`depart_date`,
            `users__booking_journey`.`flight_number`
        FROM
            `users__booking_journey`
        INNER JOIN `airport__terminal_type_relation` D ON D.`token`=`users__booking_journey`.`depart_ttr_token`
        INNER JOIN `airport` DA ON DA.`token`=D.`airport_token`
        INNER JOIN `airport__terminal` DT ON DT.`token`=D.terminal_token
        INNER JOIN `airport__terminal_type_relation` A ON A.`token`=`users__booking_journey`.`arrival_ttr_token`
        INNER JOIN `airport` AA ON AA.`token`=A.`airport_token`
        INNER JOIN `airport__terminal` A_T ON A_T.`token`=A.terminal_token
        WHERE
            `users__booking_journey`.`booking_token`=:booking_token";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":booking_token", $this->booking_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Journey' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->booking_token = trim($row['booking_token']);
            $obj->depart_ttr_token = trim($row['depart_ttr_token']);
            $obj->depart_airport_code = trim($row['depart_airport_code']);
            $obj->depart_airport = trim($row['depart_airport']);
            $obj->depart_terminal = trim($row['depart_terminal']);
            $obj->arrival_airport_code = trim($row['arrival_airport_code']);
            $obj->arrival_airport = trim($row['arrival_airport']);
            $obj->arrival_terminal = trim($row['arrival_terminal']);
            $obj->arrival_ttr_token = trim($row['arrival_ttr_token']);
            $obj->depart_date = date('d M, Y', strtotime(trim($row['depart_date'])));
            $obj->flight_number = trim($row['flight_number']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

