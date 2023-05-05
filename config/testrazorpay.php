<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.razorpay.com/v1/payment_links',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "amount": 1000,
  "currency": "INR",
  "accept_partial": false,
  "reference_id": "' . date('YmdHis') . '",
  "description": "Payment for policy no #23456",
  "customer": {
    "name": "Senthil",
    "contact": "+918124683303",
    "email": "senthil@macppappstudio.com"
  },
  "notify": {
    "sms": true,
    "email": true
  },
  "reminder_enable": true,
  "notes": {
    "policy_name": "Payment Testing"
  },
  "callback_url": "https://airportzostage.in/web-app",
  "callback_method": "get"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic cnpwX3Rlc3RfSElSenQ4VzFtb2ZCSTg6SFNBU3lMYnNsS2lxNDd1aUFhYWJqU21E',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>