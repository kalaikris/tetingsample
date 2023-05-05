<?php
class ServiceProviderCompanyLocationAmenities extends Database {
    // object properties
    public $service_provider_company_location_token;

    public $stmt;

    // Read service
    public function readForLocation() {
        $query = "SELECT
                `amenities`.`name`,
                `amenities`.`image`
            FROM
                `service__provider_company_location_amenities`
            INNER JOIN
                `amenities` ON `amenities`.`token`=`service__provider_company_location_amenities`.`amenities_token`
            WHERE
                `service__provider_company_location_amenities`.`service_provider_company_location_token` = :service_provider_company_location_token AND `service__provider_company_location_amenities`.`status` = 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":service_provider_company_location_token", $this->service_provider_company_location_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Services' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->name = trim($row['name']);
            $obj->image = trim($row['image']);

            array_push($array, $obj);
        }

        return $array;
    }
}
?>