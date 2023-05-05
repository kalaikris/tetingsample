<?php
class UsersGst extends Database {
    // object properties
    public $user_token;
    public $token;
    public $name;
    public $gstin;

    public $table_name = "`users__gstin`";
    public $column_list = "`token`,
        `name`,
        `gstin`";
    public $stmt;

    //Get all gst details
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

    //Get gst detail by token
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
            `name`=:name,
            `gstin`=:gstin";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":user_token", $this->user_token);
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":gstin", $this->gstin);
        
        // // execute query
        // $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        // return true;
        return $this->stmt->execute()? true: false;
    }
    
    public function update() {
        $query = "UPDATE " . $this->table_name . "
        SET
            `name`=:name,
            `gstin`=:gstin
        WHERE
            `token`=:token";
        
        // prepare query
        $this->stmt = $this->conn->prepare($query);
        
        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":gstin", $this->gstin);
        
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

    // GST' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->gstin = trim($row['gstin']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

