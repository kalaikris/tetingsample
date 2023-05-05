<?php
class ServiceDistributor extends Database {
    // object properties
    public $id;
    public $token;
    public $service_distributor_type_token;
    public $name;
    public $site_name;
    public $password;
    public $email;
    public $is_business_info;
    public $date_time;
    public $status;
    public $header_logo;
    public $footer_logo;
    public $banner_image;
    public $poster_image;
    public $header_colour;
    public $header_text_colour;
    public $brand_colour;
    public $secondary_colour;
    public $description;

    public $external_user_name;
    public $external_password;

    public $table_name = "service__distributor";
    public $column_list = "`service__distributor`.`id`,
    `service__distributor`.`token`,
    `service__distributor`.`service_distributor_type_token`,
    `service__distributor_type`.`name` AS `service__distributor_type`,
    `service__distributor`.`name`,
    `service__distributor`.`site_name`,
    `service__distributor`.`email`,
    `service__distributor`.`is_business_info`,
    `service__distributor`.`date_time`,
    `service__distributor`.`status`,
    `service__distributor`.`header_logo`,
    `service__distributor`.`footer_logo`,
    `service__distributor`.`banner_image`,
    `service__distributor`.`poster_image`,
    `service__distributor`.`header_colour`,
    `service__distributor`.`header_text_colour`,
    `service__distributor`.`brand_colour`,
    `service__distributor`.`secondary_colour`,
    `service__distributor`.`commission_percentage`,
    `service__distributor`.`description`";
    public $stmt;

    // Read distributor dynamic data by sitename
    public function readDistributor() {
        $this->external_user_name = htmlspecialchars(strip_tags($this->external_user_name));

        $query = "SELECT
                    " . $this->column_list . "
                FROM
                    `" . $this->table_name . "`
                LEFT JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
                WHERE
                    `service__distributor`.`external_user_name` = :external_user_name AND `service__distributor`.`external_password` = :external_password AND `service__distributor`.`status`='0' AND `service__distributor_type`.`status`='1'
                LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":external_user_name", $this->external_user_name);
        $this->stmt->bindParam(":external_password", $this->external_password);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Read distributor dynamic data by sitename
    public function readDistributorDynamicDataBySitename() {
        $this->site_name = htmlspecialchars(strip_tags($this->site_name));

        $query = "SELECT
                    " . $this->column_list . "
                FROM
                    `" . $this->table_name . "`
                INNER JOIN `service__distributor_type` ON `service__distributor_type`.`token`=`service__distributor`.`service_distributor_type_token`
                WHERE
                    `service__distributor`.`site_name` = :site_name
                LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":site_name", $this->site_name);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Distributors' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->service_distributor_type_token = trim($row['service_distributor_type_token']);
            $obj->service__distributor_type = trim($row['service__distributor_type']);
            $obj->name = trim($row['name']);
            $obj->site_name = trim($row['site_name']);
            $obj->email = trim($row['email']);
            $obj->is_business_info = trim($row['is_business_info']);
            $obj->date_time = trim($row['date_time']);
            $obj->status = trim($row['status']);
            $obj->header_logo = trim($row['header_logo']);
            $obj->footer_logo = trim($row['footer_logo']);
            $obj->banner_image = trim($row['banner_image']);
            $obj->poster_image = trim($row['poster_image']);
            $obj->header_colour = trim($row['header_colour']);
            $obj->header_text_colour = trim($row['header_text_colour']);
            $obj->brand_colour = trim($row['brand_colour']);
            $obj->secondary_colour = trim($row['secondary_colour']);
            $obj->description = trim($row['description']);
            $obj->commission_percentage = trim($row['commission_percentage']);

            array_push($array, $obj);
        }

        return $array;
    }
    
    function getCreditAvailableForServiceDistributor(){
        $query = "SELECT `credit_available`,`is_credit` FROM `service__distributor` WHERE `token`=:distributor_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->is_credit = $row["is_credit"];
        $obj->distributor_credits = $row["credit_available"];
        return $obj;
    }
    function updateDistributorCreditAvailableAmount(){
        $query = "UPDATE `service__distributor` SET `credit_available`=:balance_credit WHERE `token`=:distributor_token";
        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":balance_credit", $this->distributor_balance_credit);
        $this->stmt->bindParam(":distributor_token", $this->distributor_token);
        $this->stmt->execute();
    }
}

?>