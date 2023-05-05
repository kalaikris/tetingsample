<?php
class Services extends Database {
    // object properties
    public $token;
    public $distributor_token;

    public $column_list = "`business_type`.`token`,
        `business_type`.`name`,
        `business_type`.`image`,
        `business_type`.`description`,
        MIN(`service__location`.`price_adult`) AS `price_adult`,
        MIN(`service__location`.`price_children`) AS `price_children`,
        MIN(`service__location`.`additional_price_adult`) AS `additional_price_adult`,
        MIN(`service__location`.`additional_price_children`) AS `additional_price_children`";
    public $table_list = "`business_type`
        INNER JOIN `service__business_relation` ON `service__business_relation`.`business_type_token` = `business_type`.`token`
        INNER JOIN `service__location` ON `service__location`.`service_token` = `service__business_relation`.`service_token` AND `service__location`.`status` = 1 AND `service__location`.`price_adult` > 0 AND `service__location`.`price_children` > 0
        INNER JOIN `service__distributor_business` ON `service__distributor_business`.`business_type_token` = `business_type`.`token`";
    public $stmt;

    // Read service
    public function readOne() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `business_type`.`status` = 1
                AND `business_type`.`token`=:token
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

    // Read services
    public function read() {
        $query = "SELECT
                " . $this->column_list . "
            FROM
                " . $this->table_list . "
            WHERE
                `business_type`.`status` = 1
            GROUP BY
                `business_type`.`token`
            ORDER BY
                `business_type`.`id`";

        $this->stmt = $this->conn->prepare( $query );

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
            $obj->price = strval(($price_adult < $price_children)? $price_adult: $price_children);

            array_push($array, $obj);
        }

        return $array;
    }
}

?>
