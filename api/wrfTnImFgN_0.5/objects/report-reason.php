<?php
class ReportReason extends Database {
    // object properties
    public $id;
    public $token;
    public $reason;

    public $table_name = "`report_reason`";
    public $column_list = "`token`,
        `reason`";
    public $stmt;

    //Get all report-reason
    public function read() {
        $query = "SELECT
            " . $this->column_list . "
        FROM " . $this->table_name;
        $this->stmt = $this->conn->prepare( $query );
        
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
            $obj->reason = trim($row['reason']);

            array_push($array, $obj);
        }
        return $array;
    }
}

?>

