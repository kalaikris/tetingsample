<?php

class Msg91 {
    // Msg91 credentials
    private $auth_key = "352435ApBqacJ9Bu5d600a88ebP1";
    private $sender_id = "AIRPZO";
    private $otp_template = "62f61ff1d6fc055efe4f2502";
    private $cancelotp_template = "63918f62d6fc0570346bad82";

    public $country_code;
    public $mobile;
    public $otp;

    function sendOtp() {
        // sanitize
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->otp = htmlspecialchars(strip_tags($this->otp));
        $this->country_code = htmlspecialchars(strip_tags($this->country_code));
        // Collecting the variables to be sent in send otp server call

        $url = "https://api.msg91.com/api/v5/otp?authkey=" . $this->auth_key . "&country=" . $this->country_code . "&mobile=" . $this->mobile . "&otp=" . $this->otp . "&template_id=" . $this->otp_template;
        error_log(date("Y-m-d H:i:s") . " : " . $url . "\n", 3, "msgs.log");

        // Creating cURL to hit the url and get the response
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($err) {
            return false; // echo "cURL Error #:" . $err;
        } else {
            if ($result->type == "success") return true;
            else return false;
        }
    }

    function verifyOtp() {
        // sanitize
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->otp = htmlspecialchars(strip_tags($this->otp));
        $this->country_code = htmlspecialchars(strip_tags($this->country_code));
        // Collecting the variables to be sent in send otp server call
        $url = "https://api.msg91.com/api/v5/otp/verify?authkey=" . $this->auth_key . "&country=" . $this->country_code . "&mobile=" . $this->mobile . "&otp=" . $this->otp;
        error_log(date("Y-m-d H:i:s") . " : " . $url . "\n", 3, "msgs.log");

        // Creating cURL to hit the url and get the response
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($err) {
            return 'OTP verification failed'; // echo "cURL Error #:" . $err;
        } else {
            if ($result->type == "success") return true;
            else return $result->message;
        }
    }

    function cancelOtp() {
        // sanitize
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->otp = htmlspecialchars(strip_tags($this->otp));
        $this->country_code = htmlspecialchars(strip_tags($this->country_code));
        // Collecting the variables to be sent in send otp server call
        $url = "https://api.msg91.com/api/v5/otp?authkey=" . $this->auth_key . "&country=" . $this->country_code . "&mobile=" . $this->mobile . "&otp=" . $this->otp . "&template_id=" . $this->cancelotp_template;
        error_log(date("Y-m-d H:i:s") . " : " . $url . "\n", 3, "msgs.log");

        // Creating cURL to hit the url and get the response
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = json_decode($response);

        if ($err) {
            return false; // echo "cURL Error #:" . $err;
        } else {
            if ($result->type == "success") return true;
            else return false;
        }
    }
}
?>