<?php
class BusinessType extends Database {
    // object properties
    public $token;
    public $business_type_token;
    public $stmt;

    // Read business
    public function readOne($site_name) {
        $query = "SELECT
        `business_type`.`token`,
        `business_type`.`name`,
        `business_type`.`image`,
        COALESCE(MIN(`service__location`.`price_adult`),0) AS `price_adult`,
        COALESCE(MIN(`service__location`.`price_children`),0) AS `price_children`,
        `business_type`.`description`,
        `service__distributor`.`is_markup`,
        `service__distributor`.`markup_type`,
        `service__distributor`.`markup_value`
    FROM
        `service__distributor`
    INNER JOIN `service__distributor_airport` ON `service__distributor`.`token` = `service__distributor_airport`.`service_distributor_token`
    INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`airport_token` = `service__distributor_airport`.`airport_token`
    INNER JOIN `service__location` ON `service__location`.`airport_ttr_token` = `airport__terminal_type_relation`.`token`
    INNER JOIN `service` ON `service`.`token` = `service__location`.`service_token` AND `service`.`business_type_token` =:token
    INNER JOIN `service__provider_company_location` ON `service__provider_company_location`.`airport_token` = `airport__terminal_type_relation`.`airport_token` AND `service__provider_company_location`.`token` = `service`.`service_provider_company_location_token`
    INNER JOIN `business_type` ON `business_type`.`token` = `service`.`business_type_token`
    WHERE
        `service__distributor`.`site_name` = '$site_name' AND `service`.`status` = '1' AND `service__location`.`status` = '1'
    GROUP BY
        `business_type`.`token`
    ORDER BY
        `business_type`.`id`";
        // SELECT
        //         `business_type`.`token`,
        //         `business_type`.`name`,
        //         `business_type`.`image`,
        //         COALESCE(MIN(`service__location`.`price_adult`), 0) AS `price_adult`,
        //         COALESCE(MIN(`service__location`.`price_children`), 0) AS `price_children`,
        //         `business_type`.`description`,
        //         `service__distributor`.`is_markup`,
        //         `service__distributor`.`markup_type`,
        //         `service__distributor`.`markup_value`
        //     FROM
        //         `service__distributor_airport`
        //     INNER JOIN `airport__terminal_type_relation` ON `airport__terminal_type_relation`.`airport_token`=`service__distributor_airport`.`airport_token`
        //     INNER JOIN `airport__category` ON `airport__category`.`token`=`airport__terminal_type_relation`.`category_token`
        //     INNER JOIN `service__location` ON `service__location`.`airport_ttr_token` = `airport__terminal_type_relation`.`token` AND (`service__location`.`price_adult`>0 OR `service__location`.`price_children`>0)
        //     INNER JOIN `service` ON `service`.`token`=`service__location`.`service_token` AND `service`.`status`=1
        //     INNER JOIN `service__provider_company` ON `service__provider_company`.`token`=`service`.`service_provider_company_token`
        //     INNER JOIN `service__business_relation` ON `service__business_relation`.`service_token`=`service`.`token`
        //     INNER JOIN `business_type` ON `business_type`.`token`=`service__business_relation`.`business_type_token`
        //     INNER JOIN `service__distributor` ON `service__distributor`.`token`=`service__distributor_airport`.`service_distributor_token`
        //     WHERE
        //         `business_type`.`token` = :token AND `service__distributor`.`site_name` = '$site_name'
        //     GROUP BY
        //         `business_type`.`token`
        //     ORDER BY
        //         `business_type`.`id`

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":token", $this->token);
        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Business' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->token = trim($row['token']);
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);
            if($row['is_markup']=='1'){
                if($row['markup_type'] == 'Percentage'){
                    $markup_value = ((100 + $row['markup_value']) / 100);
                    $obj->price = (intval($row['price_adult']) < intval($row['price_children']))? ceil(trim($row['price_adult'] * $markup_value)): ceil(trim($row['price_children'] * $markup_value));
                } else {
                    $markup_value = $row['markup_value'];
                    $obj->price = (intval($row['price_adult']) < intval($row['price_children']))? trim($row['price_adult'] + $markup_value): trim($row['price_children'] + $markup_value);
                }
            } else {
                $obj->price = (intval($row['price_adult']) < intval($row['price_children']))? trim($row['price_adult']): trim($row['price_children']);
            }
            $obj->description = trim($row['description']);
            // $obj->service__provider_company_location_token = explode(",", trim($row['service__provider_company_location_token']));

            array_push($array, $obj);
        }

        return $array;
    }

    function readAvailServiceForBusiness() {
        $query = "SELECT
                `avail_service`.`name`,
                `avail_service`.`image`
            FROM
                `avail_service`
            INNER JOIN `business_type__avail_service` ON `business_type__avail_service`.`avail_service_token` = `avail_service`.`token`
            WHERE
                `business_type__avail_service`.`business_type_token` = :business_type_token";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    function readImagesForBusiness() {
        $query = "SELECT
                `image` AS `description`
            FROM
                `business_type__images`
            WHERE
                `business_type_token` = :business_type_token AND `status` = 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    function readPartnersForBusiness() {
        $query = "SELECT
                `our_partners`.`name`,
                `our_partners`.`image`
            FROM
                `our_partners`
            INNER JOIN `business_type__partners` ON `business_type__partners`.`partner_token`=`our_partners`.`token`
            WHERE
                `business_type__partners`.`business_type_token`=:business_type_token";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    function readServiceForBusiness() {
        $query = "SELECT
                `description`
            FROM
                `business_type__service`
            WHERE
                `business_type_token`=:business_type_token";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":business_type_token", $this->business_type_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    function makeNameImageView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);

            array_push($array, $obj);
        }

        return $array;
    }

    function makeArray() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $description = trim($row['description']);

            if($description != '') array_push($array, $description);
        }

        return $array;
    }
}

?>