<?php
class Database {
    private $host ='localhost';
    private $db_name = 'airportzostage_stage';
    private $username = 'airportzostage_stage';
    private $password = '$cU3N=&IeiG_';
    public $table_name;
    public $conn;
    public $stmt;
    // get the database connection on construct
    public function __construct() {
        // $input = (parse_ini_file("../../myconfig.ini"));
        // $localhost =  $input['localhost'];
        // $database_name = $input['database_name'];
        // $database_username = $input['database_username'];
        // $database_password = $input['database_password'];

        // global $localhost;
        // global $database_name;
        // global $database_username;
        // global $database_password;

        // $this->host = $localhost;
        // $this->db_name = $database_name;
        // $this->username = $database_username;
        // $this->password = $database_password;
        // $this->conn = null;
        // echo $localhost.'/na';
        // echo $this->db_name.'/nb';
        // echo $this->username.'/nc';
        // echo $this->password.'/nd';
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>