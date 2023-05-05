<?php
class UsersPassenger extends Database {
    // object properties
    public $id;
    public $user_token;
    public $token;
    public $title;
    public $name;
    public $country_code;
    public $mobile_number;
    public $email_id;
    public $date_of_birth;

    public $table_name = "users__passenger";
    public $column_list = "`token`,
        `title`,
        `name`,
        `country_code`,
        `mobile_number`,
        `email_id`,
        `date_of_birth`";
    public $stmt;

    //Check Mobile number exist and get passenger list
    public function read($name) {
        // $this->distributor_token = htmlspecialchars(strip_tags($this->distributor_token));

        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
            WHERE `user_token`=:user_token $name";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":user_token", $this->user_token);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    //Get passenger detail by token
    public function readOne() {
        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
            WHERE `token`=:token";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":token", $this->token);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            `token`=:token,
            `user_token`=:user_token,
            `title`=:title,
            `name`=:name,
            `country_code`=:country_code,
            `mobile_number`=:mobile_number,
            `email_id`=:email_id,
            `date_of_birth`=:date_of_birth";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":user_token", $this->user_token);
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
    
    public function update() {
        $query = "UPDATE " . $this->table_name . "
        SET
            `title`=:title,
            `name`=:name,
            `country_code`=:country_code,
            `mobile_number`=:mobile_number,
            `email_id`=:email_id,
            `date_of_birth`=:date_of_birth
        WHERE
            `token`=:token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
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
    
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE `token`=:token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    // Passengers' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->title = trim($row['title']);
            $obj->name = trim($row['name']);
            $obj->name_view = (trim($row['title']) != '') ? trim($row['title']) . '. ' . trim($row['name']): trim($row['name']);
            $obj->country_code = trim($row['country_code']);
            $obj->mobile_number = trim($row['mobile_number']);
            $obj->email_id = trim($row['email_id']);
            $obj->date_of_birth = (trim($row['date_of_birth']) != '' && trim($row['date_of_birth']) != '1970-01-01')? date('d-M-Y', strtotime(trim($row['date_of_birth']))): date('d-M-Y');

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

