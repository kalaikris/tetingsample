<?php
class ServiceProviderCompany extends Database {
    // object properties
    public $airport_token;
    public $company_token;

    public $stmt;

    // Read TermsAndConditions
    public function readTermsAndConditions() {
        $query = "SELECT
            `terms_conditions` AS `doc_content`
        FROM
            `service__provider_company_location`
        WHERE
            `company_token` = :company_token AND `airport_token` = :airport_token
        LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":company_token", $this->company_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Read PrivacyPolicy
    public function readPrivacyPolicy() {
        $query = "SELECT
            `privacy_policy` AS `doc_content`
        FROM
            `service__provider_company_location`
        WHERE
            `company_token` = :company_token AND `airport_token` = :airport_token
        LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":company_token", $this->company_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Read CancellationPolicy
    public function readCancellationPolicy() {
        $query = "SELECT
            `cancellation_policy` AS `doc_content`
        FROM
            `service__provider_company_location`
        WHERE
            `company_token` = :company_token AND `airport_token` = :airport_token
        LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->bindParam(":company_token", $this->company_token);
        $this->stmt->bindParam(":airport_token", $this->airport_token);

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();

        return $this->stmt;
    }

    // Docs' View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->doc_content = trim($row['doc_content']);
            array_push($array, $obj);
        }

        return $array;
    }
}

?>
