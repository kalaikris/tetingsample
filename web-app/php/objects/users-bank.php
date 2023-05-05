<?php
class UsersBank extends Database {
    // object properties
    public $user_token;
    public $token;
    public $account_number;
    public $ifsc_code;
    public $branch_name;
    public $is_primary;
    public $date_time;

    public $table_name = "`users__bank`";
    public $column_list = "`token`,
        `account_number`,
        `ifsc_code`,
        `branch_name`,
        `is_primary`,
        `date_time`";
    public $stmt;

    //Get all account details
    public function read() {
        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
            WHERE `user_token`=:user_token";
        $this->stmt = $this->conn->prepare( $query );
       
        $this->stmt->bindParam(":user_token", $this->user_token);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }

    //Get account detail by token
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
            `user_token`=:user_token,
            `token`=:token,
            `account_number`=:account_number,
            `ifsc_code`=:ifsc_code,
            `branch_name`=:branch_name,
            `is_primary`=:is_primary,
            `date_time`=:date_time";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":account_number", $this->account_number);
        $this->stmt->bindParam(":ifsc_code", $this->ifsc_code);
        $this->stmt->bindParam(":branch_name", $this->branch_name);
        $this->stmt->bindParam(":is_primary", $this->is_primary);
        $this->stmt->bindParam(":date_time", $this->date_time);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function update() {
        $query = "UPDATE " . $this->table_name . "
        SET
            `account_number`=:account_number,
            `ifsc_code`=:ifsc_code,
            `branch_name`=:branch_name
        WHERE
            `token`=:token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":account_number", $this->account_number);
        $this->stmt->bindParam(":ifsc_code", $this->ifsc_code);
        $this->stmt->bindParam(":branch_name", $this->branch_name);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function makeAllSecondary() {
        $this->is_primary = "0";
        $query = "UPDATE " . $this->table_name . "
        SET
            `is_primary`=:is_primary
        WHERE
            `user_token`=:user_token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":is_primary", $this->is_primary);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function makePrimary() {
        $this->is_primary = "1";
        $query = "UPDATE " . $this->table_name . "
        SET
            `is_primary`=:is_primary
        WHERE
            `token`=:token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":is_primary", $this->is_primary);
        
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

    // account' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->account_number = trim($row['account_number']);
            $obj->ifsc_code = trim($row['ifsc_code']);
            $obj->branch_name = trim($row['branch_name']);
            $obj->is_primary = (trim($row['is_primary']) == 1)? true: false;
            $obj->date_time = date("d,M Y", strtotime(trim($row['date_time'])));

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

