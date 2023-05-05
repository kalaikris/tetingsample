<?php
class ContactDetails extends Database
{
    // object properties
    public $table_name = "`contact_us`";
    public $column_list = "`token`, `name`, `email`, `subject`, `message`";
    public $stmt;

    //Get contact detail by name
    public function readOne()
    {
        $query1 = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name . "
            WHERE `name`=:name AND `message`=:message";
        $stmt = $this->conn->prepare($query1);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":message", $this->message);

        // // execute query
        $stmt->execute();
        // $this->stmt->debugDumpParams();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            `token`=:token,
            `name`=:name,
            `email`=:email,
            `subject`=:subject,
            `message`=:message,
            `platform_type`=:platform_type,
            `date_time`=:date_time";
        // prepare query
        $this->stmt = $this->conn->prepare($query);

        // bind values
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->bindParam(":name", $this->name);
        $this->stmt->bindParam(":email", $this->email);
        $this->stmt->bindParam(":subject", $this->subject);
        $this->stmt->bindParam(":message", $this->message);
        $this->stmt->bindParam(":platform_type", $this->platform_type);
        $this->stmt->bindParam(":date_time", $this->date_time);

        return $this->stmt->execute() ? true : false;
    }

    // contact info view
    function makeView($stmt) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->token = trim($row['token']);
        $obj->name = trim($row['name']);
        $obj->email = trim($row['email']);
        $obj->subject = trim($row['subject']);
        $obj->message = trim($row['message']);
        return $obj;
    }
}
?>