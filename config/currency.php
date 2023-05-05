<?php
function currency($from_Currency, $to_Currency) {
    $currency_from = urlencode($from_Currency);
    $currency_to = urlencode($to_Currency);

    $url = "https://api.exchangerate-api.com/v4/latest/$currency_from";

    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
    $rawdata = curl_exec($ch);
    curl_close($ch);

    $rawdata = json_decode($rawdata, true);
    $rate = $rawdata['rates'];
    $currency_value = $rate[$currency_to];

    return number_format((float)$currency_value, 4, '.', '');//$currency_value;
}
?>