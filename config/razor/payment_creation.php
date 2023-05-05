<?php
session_start();
$rzp_payment_authkey   = "rzp_test_HIRzt8W1mofBI8";
$rzp_payment_secretkey = "HSASyLbslKiq47uiAaabjSmD";

    $obj1 = new stdClass();
    $payment_folder='';
    $url="https://".$rzp_payment_authkey.":".$rzp_payment_secretkey."@api.razorpay.com/v1/orders";
    $price     = 1000;
    $price     = 100 * $price;
    $obj = new stdClass();
    $obj->amount  = $price;
    $obj->currency= "INR";
    $receipt = "receipt#".mt_rand(100,999);
    $obj->receipt = $receipt;
    $obj->payment_capture = 1;
    $curl= curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($obj),
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 67d92778-3ca8-ffb4-9680-c384d115f95a"
        ),
    ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $responseObj= json_decode($response, false);
        $order_id   = $responseObj->id;
        $obj1->status     = 200;
        $obj1->order_id     = $order_id;
        $obj1->total_amount = $price;
        $obj1->rzp_authkey  = $rzp_payment_authkey;
        $obj1->receipt      = $receipt;
    echo json_encode($obj1);
?>