<?php
class Services extends Database {
    // object properties
    public $token;
    public $distributor_token;

    public $column_list = "`business_type`.`token`,
    `business_type`.`name`,
    `business_type`.`image`,
    `business_type`.`description`,
    COALESCE(MIN(`service__location`.`price_adult`),0) AS `price_adult`,
    COALESCE(MIN(`service__location`.`price_children`),0) AS `price_children`";
    public $table_list = "`service__distributor`
    INNER JOIN `service__distributor_airport` ON `service__distributor`.`token` = `service__distributor_airport`.`service_distributor_token`
    INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`airport_token` = `service__distributor_airport`.`airport_token`
    INNER JOIN `service__location` ON `service__location`.`airport_ttr_token` = `airport__terminal_type_relation`.`token`
    INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token`
    INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`airport_token` = `airport__terminal_type_relation`.`airport_token` AND `service__provider_company_location`.`token` = `service`.`service_provider_company_location_token`
    INNER JOIN `business_type` ON `business_type`.`token` = `service`.`business_type_token`
    INNER JOIN `service__distributor_business` ON `service__distributor_business`.`service_distributor_token` = `service__distributor`.`token` AND `service__distributor_business`.`business_type_token` = `service`.`business_type_token` AND `service__distributor_business`.`is_active`='1'";
    public $stmt;

    // Read service
    public function readOne() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `business_type`.`status` = 1 AND `business_type`.`token`=:token
            GROUP BY
                `business_type`.`token`
            ORDER BY
                `business_type`.`id`
            LIMIT
                1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":token", $this->token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Read services for Distributor
    public function readServicesForDistributor() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
            `service__distributor`.`token` = :distributor_token AND `service`.`status` = '1' AND `service__location`.`status` = '1' AND `business_type`.`status` = 1
            GROUP BY
                `business_type`.`token`
            ORDER BY
                `business_type`.`id`";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":distributor_token", $this->distributor_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Services' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $price_adult = intval(trim($row['price_adult']));
            $price_children = intval(trim($row['price_children']));

            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);
            $obj->description = trim($row['description']);
            $obj->price = ($price_adult < $price_children)? $price_adult: $price_children;

            array_push($array, $obj);
        }

        return $array;
    }
}
?>