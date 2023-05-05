<?php
class Users extends Database {
    // object properties
    public $token;
    public $title;
    public $name;
    public $image;
    public $country_code;
    public $mobile_number;
    public $email;
    
    public $is_airportzo_user = 0;
    public $distributor_token = '1111111111';
    public $login_device = 'Web';

    public $table_name = "`users`";
    public $column_list = "`token`,
        `is_agent`,
        `is_approved`,
        `title`,
        `name`,
        `image`,
        `email`,
        `country_code`,
        `mobile_number`,
        `dob`,
        `address`,
        `country_id`,
        `state_id`,
        `city_id`,
        `pincode`,
        `account_number`,
        `ifsc_code`,
        `pan_card`,
        `address_proof`";
    public $stmt;
    
    public function create() {
        $query = "INSERT INTO `users`
        SET
            token=:token,
            is_airportzo_user=:is_airportzo_user,
            service_distributor_token=:distributor_token,
            title=:title,
            name=:name,
            country_code=:country_code,
            mobile_number=:mobile_number,
            email=:email_id,
            dob=:date_of_birth,
            device_type='External',
            login_device='External'";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));
        $this->country_code = htmlspecialchars(strip_tags($this->country_code));
        $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":is_airportzo_user", $this->is_airportzo_user);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->bindParam(":title", $this->title);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":country_code", $this->country_code);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);
        $this->stmt->bindParam(":email_id", $this->email_id);
        $this->stmt->bindParam(":date_of_birth", $this->date_of_birth);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    public function getUserDetail() {
        // $this->token = htmlspecialchars(strip_tags($this->token));

        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
        WHERE
            `users`.`token`=:token
            AND `users`.`service_distributor_token`=:distributor_token
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    //Check Mobile number exist and get passenger list
    public function getUser() {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
        WHERE `users`.`service_distributor_token`=:distributor_token
            AND `users`.`name`=:name
            AND `users`.`email`=:email_id
            AND `users`.`mobile_number`=:mobile_number";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":email_id", $this->email_id);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Users' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->is_agent = (trim($row['is_agent']) == 1)? true: false;
            $obj->is_approved = (trim($row['is_approved']) == 1)? true: false;
            $obj->title = trim($row['title']);
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);
            $obj->email = trim($row['email']);
            $obj->country_code = trim($row['country_code']);
            $obj->mobile_number = trim($row['mobile_number']);
            $obj->dob = trim($row['dob']);
            // $obj->address = trim($row['address']);
            // $obj->country_id = trim($row['country_id']);
            // $obj->state_id = trim($row['state_id']);
            // $obj->city_id = trim($row['city_id']);
            // $obj->pincode = trim($row['pincode']);
            // $obj->account_number = trim($row['account_number']);
            // $obj->ifsc_code = trim($row['ifsc_code']);
            $obj->pan_card = trim($row['pan_card']);
            $obj->address_proof = trim($row['address_proof']);

            array_push($array, $obj);
        }
        return $array;
    }

    function user_gstin_create(){
        $query = "INSERT INTO `users__gstin`
        SET
            date_time=:date_time,
            user_token=:user_token,
            token=:user_gstin_token,
            name=:gst_name,
            gstin=:gst_number";
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":date_time", $this->date_time);
        $this->stmt->bindParam(":user_token", $this->token);
        $this->stmt->bindParam(":user_gstin_token", $this->user_gstin_token);
        $this->stmt->bindParam(":gst_name", $this->gst_name);
        $this->stmt->bindParam(":gst_number", $this->gst_number);
        $this->stmt->execute();
    }
}

?>