<?php
class ServiceProviderCompanyLocationPhotos extends Database {
    // object properties
    public $service_provider_company_location_token;

    public $stmt;

    // Read service
    public function readForLocation() {
        $query = "SELECT
                `image`
            FROM
                `service__provider_company_location_shop_photos`
            WHERE
                `service_provider_company_location_token` = :service_provider_company_location_token AND `status` = 1";

        $this->stmt = $this->conn->prepare( $query );
        $this->stmt->bindParam(":service_provider_company_location_token", $this->service_provider_company_location_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
    }

    // Services' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            if(trim($row['image']) != '') array_push($array, trim($row['image']));
        }

        return $array;
    }
}
?>