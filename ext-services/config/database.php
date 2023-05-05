<?php
class Database {
    private $host = "localhost";

    // private $db_name = 'airportzo_development';
    private $db_name = 'airportzostage_stage';
    private $username = 'airportzostage_stage';
    private $password = '$cU3N=&IeiG_';
    public $table_name;
    public $conn;
    public $stmt;

    // get the database connection on construct
    public function __construct() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    // public function genToken(){
        
    //     $query = "SELECT ROUND((RAND() * (9999999999-1000000000))+1000000000) AS `random_num`
    //     FROM `" . $this->table_name . "` 
    //     WHERE `random_num` NOT IN (SELECT my_number FROM `" . $this->table_name . "` )
    //     LIMIT 1";
    //      $this->stmt = $this->conn->prepare( $query );
    //      $this->stmt->execute();
    //     $this->stmt->debugDumpParams();
    // }
    // function readToken(){
    //     $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
    //     return $row['random_num'];
    // }
}
?>
