<?php
class UsersOtp extends Database {
    // object properties
    public $distributor_token;
    public $mobile_number;
    public $otp_count;
    public $otp_date_time;

    public $table_name = "`users__otp`";
    public $column_list = "`mobile_number`,
        `otp_count`,
        `otp_date_time`";
    public $stmt;

    public function getUser() {
        // $this->token = htmlspecialchars(strip_tags($this->token));

        $query = "SELECT
                " . $this->column_list . "
            FROM " . $this->table_name . "
            WHERE
                `distributor_token`=:distributor_token AND `mobile_number`=:mobile_number
            LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    //update OTP Count
    public function updateOTPCount() {
        $query = "UPDATE " . $this->table_name . " SET `otp_count`=:otp_count, `otp_date_time`=:otp_date_time WHERE `distributor_token`=:distributor_token AND `mobile_number`=:mobile_number";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":otp_count", $this->otp_count);
        $this->stmt->bindParam(":otp_date_time", $this->otp_date_time);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                distributor_token=:distributor_token,
                mobile_number=:mobile_number,
                otp_count=:otp_count,
                otp_date_time=:otp_date_time";

        // prepare query
        $this->stmt = $this->conn->prepare($query);
      
        // bind values
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);
        $this->stmt->bindParam(":otp_count", $this->otp_count);
        $this->stmt->bindParam(":otp_date_time", $this->otp_date_time);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    // Users' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->mobile_number = trim($row['mobile_number']);
            $obj->otp_count = (int) trim($row['otp_count']);
            $obj->otp_date_time = trim($row['otp_date_time']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

