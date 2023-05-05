<?php
class ContactInfo extends Database {
    // object properties
    public $id;
    public $token;
    public $mail_us;
    public $country_code;
    public $mobile_number;
    public $whatsapp_country_code;
    public $whatsapp_number;
    public $corporate_address;
    public $stmt;

    // Read contact info
    public function readContactInfo() {
        $query = "SELECT
        `id`,
        `token`,
        `mail_us`,
        CONCAT('+',`country_code`,' ',`mobile_number`) AS `mobile_number`,
        CONCAT('+',`whatsapp_country_code`,' ',`whatsapp_number`) AS `whatsapp_number`,
        `corporate_address`
    FROM
        `contact_info`
    LIMIT 1";

        $this->stmt = $this->conn->prepare( $query );

        $this->stmt->execute();
        // $this->stmt->debugDumpParams();
        return $this->stmt;
    }

    // Contact Info View
    function makeView() {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->id = trim($row['id']);
            $obj->token = trim($row['token']);
            $obj->mail_us = trim($row['mail_us']);
            $obj->mobile_number = trim($row['mobile_number']);
            $obj->whatsapp_number = trim($row['whatsapp_number']);
            $obj->corporate_address = trim($row['corporate_address']);

            array_push($array, $obj);
        }
        return $array;
    }
}
?>