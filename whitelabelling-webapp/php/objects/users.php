<?php
class Users extends Database {
    // object properties
    public $title;
    public $name;
    public $image;
    public $country_code;
    public $mobile_number;
    public $email;

    public $token;
    public $distributor_token;

    public $table_name = "`users`";
    public $column_list = "`users`.`agent_token`,
        `users`.`token`,
        `users`.`is_agent`,
        `users`.`is_approved`,
        COALESCE(`service__distributor_agent`.`is_credit`, 0) AS `is_credit`,
        `users`.`title`,
        `users`.`name`,
        `users`.`image`,
        `users`.`email`,
        `users`.`country_code`,
        `users`.`mobile_number`,
        `users`.`dob`,
        `users`.`address`,
        `users`.`country_id`,
        `users`.`state_id`,
        `users`.`city_id`,
        `users`.`pincode`,
        `users`.`account_number`,
        `users`.`ifsc_code`,
        `users`.`pan_card`,
        `users`.`address_proof`";
    public $stmt;
    
    public $is_airportzo_user = 0;
    public $login_device = 'Web';

    public function getUserDetail() {
        // $this->token = htmlspecialchars(strip_tags($this->token));

        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
        LEFT JOIN `service__distributor_agent` ON `service__distributor_agent`.`token` = `users`.`agent_token`
        WHERE
            `users`.`token`=:token
        LIMIT 1";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    //Check Mobile number exist and get passenger list
    public function getUser() {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
        LEFT JOIN `service__distributor_agent` ON `service__distributor_agent`.`token` = `users`.`agent_token`
        WHERE `users`.`service_distributor_token`=:distributor_token
            AND `users`.`mobile_number`=:mobile_number";
        $this->stmt = $this->conn->prepare( $query );
        
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        //$this->stmt->bindParam(":country_code", $this->country_code);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        //AND `users`.`country_code`=:country_code
    }
    
    public function create() {
        $query = "INSERT INTO `users`
        SET
            token=:token,
            is_airportzo_user=:is_airportzo_user,
            service_distributor_token=:distributor_token,
            country_code=:country_code,
            mobile_number=:mobile_number";
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
        $this->stmt->bindParam(":country_code", $this->country_code);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function update() {
        $query = "UPDATE `users`
        SET
            title=:title,
            name=:name,
            image=:image,
            country_code=:country_code,
            mobile_number=:mobile_number,
            email=:email
        WHERE
            token=:token";
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->image = htmlspecialchars(strip_tags($this->image));
        $this->country_code = htmlspecialchars(strip_tags($this->country_code));
        $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":title", $this->title);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":image", $this->image);
        $this->stmt->bindParam(":country_code", $this->country_code);
        $this->stmt->bindParam(":mobile_number", $this->mobile_number);
        $this->stmt->bindParam(":email", $this->email);
        
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
            $is_approved = trim($row['is_approved']);
            switch ($is_approved) {
                case '0':
                    $is_approved_status = "Pending";
                    break;

                case '1':
                    $is_approved_status = "Approved";
                    break;

                case '2':
                    $is_approved_status = "Rejected";
                    break;
                
                default:
                    $is_approved_status = "";
                    break;
            }

            $obj = new stdClass;
            $obj->agent_token = trim($row['agent_token']);
            $obj->token = trim($row['token']);
            $obj->is_agent = (trim($row['is_agent']) == 1)? true: false;
            $obj->is_approved = $is_approved_status; //(trim($row['is_approved']) == 1)? true: false;
            $obj->is_credit = (trim($row['is_credit']) == 1)? true: false;
            $obj->title = trim($row['title']);
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);
            $obj->email = trim($row['email']);
            $obj->country_code = str_replace("+", "", $row['country_code']);
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
}

?>

