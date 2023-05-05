<?php
class RazorPay {
    private $authkey = "rzp_test_HIRzt8W1mofBI8";
    private $secretkey = "HSASyLbslKiq47uiAaabjSmD";

    public $medium;

    public $payment_amount;
    public $order_id = 'order_DaaS6LOUAASb7Y';
    public $price;
    public $currency = "INR";
    public $receipt;
    public $url;
    public $customer;
    public $linkdescription;

    public function createOrder() {
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/orders";
        $receipt = "receipt#" . mt_rand(100,999);

        $curl_input = new stdClass();
        $curl_input->amount = intval($this->price * 100);
        $curl_input->currency = $this->currency;
        $curl_input->receipt = $receipt;
        $curl_input->payment_capture = 1;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($curl_input),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $responseObj = json_decode($response, false);
        $order_id = $responseObj->id;

        $obj = new stdClass;
        $obj->status_code = 200;
        $obj->message = "Order created successfully !";
        $obj->order_id = $order_id;
        $obj->payment_amount = intval($this->price * 100);
        $obj->rzp_authkey = $this->authkey;
        $obj->receipt = $receipt;

        return $obj;
    }

    public function getOrder() {
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/orders/" . $this->order_id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => json_encode($curl_input),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response, false);
    }

    public function generateLink() {
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/payment_links";
        $reference = "reference#" . date('YmdHis').mt_rand(100,999);

        $notify = new stdClass();
        $notify->sms = true;
        $notify->email = true;

        $curl_input = new stdClass();
        $curl_input->amount = intval($this->price * 100);
        $curl_input->currency = $this->currency;
        $curl_input->accept_partial = false;
        $curl_input->reference_id = $reference;
        $curl_input->description = $this->linkdescription;
        $curl_input->customer = $this->customer;
        $curl_input->notify = $notify;
        $curl_input->reminder_enable = true;
        $curl_input->notes = "";
        $curl_input->callback_url = "https://airportzostage.in/web-app";
        $curl_input->callback_method = "get";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($curl_input),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cnpwX3Rlc3RfSElSenQ4VzFtb2ZCSTg6SFNBU3lMYnNsS2lxNDd1aUFhYWJqU21E',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $responseObj = json_decode($response, false);

        $obj = new stdClass;
        if ($responseObj->error) {
            $obj->status_code = 400;
            $obj->message = $responseObj->error->description;
            $obj->plink_id = $this->plink_id;
            $obj->payment_amount = intval($this->price * 100);
            $obj->receipt = $reference;
            $obj->responseObj = $responseObj;
            $obj->curl_input = $curl_input;
        } else {
            $obj = new stdClass;
            $obj->status_code = 200;
            $obj->message = "Order generated successfully !";
            $obj->plink_id = $responseObj->id;
            $obj->payment_amount = intval($this->price * 100);
            $obj->receipt = $reference;
            $obj->responseObj = $responseObj;
        }
        
        return $obj;
    }

    public function getLinkDetail() {
        // $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/payment_links/" . $this->plink_id ."/notify_by/".$medium;
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/payment_links/" . $this->plink_id;
        error_log($this->url,3,"123.txt");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cnpwX3Rlc3RfSElSenQ4VzFtb2ZCSTg6SFNBU3lMYnNsS2lxNDd1aUFhYWJqU21E',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode($response, false);
    }

    public function CancelPaymentLink() {
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/payment_links/" . $this->plink_id . "/cancel";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cnpwX3Rlc3RfSElSenQ4VzFtb2ZCSTg6SFNBU3lMYnNsS2lxNDd1aUFhYWJqU21E',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode($response, false);
    }

    public function checkDomesticOrInternational() {
        $this->url = "https://" . $this->authkey . ":" . $this->secretkey . "@api.razorpay.com/v1/orders/" . $this->order_id ."/payments";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => json_encode($curl_input),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $responseObj = json_decode($response, false);
        $items = $responseObj->items;
        foreach ($items as $value) {
            $international = $value->international; 
            $order_id = $value->order_id;
            $currency = $value->currency;
            $status = $value->status;
        }
        $obj = new stdClass;
        $obj->status_code = 200;
        $obj->message = "Get Details Successfully!";
        $obj->international = $international;
        $obj->order_id = $order_id;
        $obj->currency = $currency;
        $obj->status = $status;
        return $obj;
    }
}
?>