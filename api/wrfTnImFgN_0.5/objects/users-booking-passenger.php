<?php
class UsersBookingPassenger extends Database {
    // object properties
    public $id;
    public $token;
    public $booking_token;
    public $user_passenger_token;
    public $passenger_type;
    public $date_time;

    public $column_list = "";
    public $stmt;
    
    public function create() {
        $query ="INSERT INTO `users__booking_passenger`
        SET
            `token`=:token,
            `booking_token`=:booking_token,
            `user_passenger_token`=:user_passenger_token,
            `passenger_type`=:passenger_type";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":booking_token", $this->booking_token);
        $this->stmt->bindParam(":user_passenger_token", $this->user_passenger_token);
        $this->stmt->bindParam(":passenger_type", $this->passenger_type);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    //get Passenger list For Booking token
    public function getPassengerForBooking() {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            `users__booking_passenger`.`id`,
            `users__booking_passenger`.`token`,
            `users__booking_passenger`.`booking_token`,
            `users__booking_passenger`.`passenger_type`,
            `users__booking_passenger`.`user_passenger_token`,
            `users__passenger`.`title`,
            `users__passenger`.`name`,
            `users__passenger`.`country_code`,
            `users__passenger`.`mobile_number`,
            `users__passenger`.`email_id`,
            `users__passenger`.`date_of_birth`
        FROM
            `users__booking_passenger`
        INNER JOIN `users__passenger` ON `users__passenger`.`token`=`users__booking_passenger`.`user_passenger_token`
        WHERE
            `users__booking_passenger`.`booking_token`=:booking_token";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":booking_token", $this->booking_token);

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
            $obj->booking_token = trim($row['booking_token']);
            $obj->passenger_type = trim($row['passenger_type']);
            $obj->user_passenger_token = trim($row['user_passenger_token']);
            $obj->title = trim($row['title']);
            $obj->name = trim($row['name']);
            $obj->name_view = (trim($row['title']) != '') ? trim($row['title']) . '. ' . trim($row['name']): trim($row['name']);
            $obj->country_code = trim($row['country_code']);
            $obj->mobile_number = trim($row['mobile_number']);
            $obj->mobile_view = trim($row['country_code']) . trim($row['mobile_number']);
            $obj->email_id = trim($row['email_id']);
            $obj->date_of_birth = trim($row['date_of_birth']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

