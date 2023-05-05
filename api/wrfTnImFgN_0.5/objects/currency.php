<?php
class Currency extends Database {
// object properties
public $id;
public $token;
public $currency_code;
public $currency_symbol;
public $flag;
public $stmt;

    // Read currency
    public function read(){
        $query = "SELECT
            `id`,
            `token`,
            `currency_code`,
            `currency_symbol`,
            `flag`
        FROM
            `currency`";
        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
        //$this->stmt->debugDumpParams();

        return $this->stmt;
    }

    //Currency View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->currency_code = trim($row['currency_code']);
            $obj->currency_symbol = trim($row['currency_symbol']);
            $obj->flag = trim($row['flag']);

            array_push($array, $obj);
        }
        return $array;
    }
}
?>