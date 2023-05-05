<?php
$gm_date_time = gmdate('Y-m-d H:i:s');
date_default_timezone_set("Asia/Kolkata");
$cur_date_time = date('Y-m-d H:i:s');
$apiPath = "API/Version1.0";

$admin_email = "adhi@macappstudio.com";//"tech@airportzo.com";
$admin_user_name = "Airportzo";

include 'database.php';
$base_url = "https://airportzostage.in/";
$doc_url = $base_url . "docs/";

function getInputs() {
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	return json_decode(file_get_contents("php://input"));
}

// function currency($from_Currency, $to_Currency, $amount) {
//     $amount = urlencode($amount);
//     $from_Currency = urlencode($from_Currency);
//     $to_Currency = urlencode($to_Currency);
//     $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
//     $ch = curl_init();
//     $timeout = 0;
//     curl_setopt ($ch, CURLOPT_URL, $url);
//     curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
//     curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//     $rawdata = curl_exec($ch);
//     curl_close($ch);
//     $data = explode('"', $rawdata);
//     $data = explode('.', $data['3']);
//     $data[0] = str_replace(" ", "",preg_replace('/\D/', '',  $data[0]));
//     if(isset($data[1])) {
//         $data[1] = str_replace(" ", "",preg_replace('/\D/', '', $data[1]));
//         $var = $data[0].".".$data[1];        
//     } else {
//         $var = $data[0];
//     }
//     return round($var, 2);
// }

function xss_clean($data) {
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;','&apos;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
    
    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
    
    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
    
    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
    
    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
    
    $data = str_replace("="," ",$data);
    $data = str_replace(";"," ",$data);
    $data = str_replace("'"," ",$data);
    $data = str_replace('"'," ",$data);
    $data = str_replace('?'," ",$data);
    $data = str_replace('%'," ",$data);
    $data = str_replace('--'," ",$data);
    // $data = str_replace('-'," ",$data);
    $data = str_replace('('," ",$data);
    $data = str_replace(')'," ",$data);
    $data = str_replace(','," ",$data);
    $data = str_replace('<'," ",$data);
    $data = str_replace('>'," ",$data);
    $data = str_replace('+'," ",$data);
    $data = str_replace('|'," ",$data);
    $data = str_replace('*'," ",$data);
    $data = str_replace('!'," ",$data);
    $data = str_replace('/'," ",$data);
    // $data = mysqli_real_escape_string($GLOBALS['link'], $data);
    $data = addslashes($data);
    
    do {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);
    
    // we are done...
    return $data;
}

function split_price($total_service_cost) {
    $service_cost_excl_gst = ceil($total_service_cost / 1.18);
    $service_cost_gst = $total_service_cost - $service_cost_excl_gst;
    $convenience_cost = ceil($total_service_cost * 0.03);
    $convenience_cost_gst = ceil($convenience_cost * 0.18);

    $price_obj = new stdClass;
    // $price_obj->input = intval($total_service_cost);
    $price_obj->service_cost_excl_gst = intval($service_cost_excl_gst);
    $price_obj->service_cost_gst = intval($service_cost_gst);
    $price_obj->convenience_cost = intval($convenience_cost);
    $price_obj->convenience_cost_gst = intval($convenience_cost_gst);
    $price_obj->total_cost = intval($service_cost_excl_gst) + intval($service_cost_gst) + intval($convenience_cost) + intval($convenience_cost_gst);
    return $price_obj;
}

function get_service_distributor() {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_pieces = parse_url($actual_link);
    $host = $url_pieces['host'];
    $host_pieces = explode(".", $host);
    $service_distributor = $host_pieces[0];
    return $service_distributor;
    // return 'sterling-holidays';//$service_distributor;
}

function genOutputs($output) {
	return json_encode($output);
}

function hashPassword($password){
    return hash('sha512', $password);
}

function genToken($table_name) {
    $link = mysqli_connect("localhost", "airportzostage_stage", '$cU3N=&IeiG_', "airportzostage_stage");
    
    // include 'database.php';
    // $db = new Database();
    // $db_db_name = $db->db_name;
    // $db_username = $db->username;
    // $db_password = $db->password;
    // $link = $db->conn;
    
    $query = mysqli_query($link, "SELECT
            ROUND((RAND() * (9999999999-1000000000))+1000000000) AS `random_num`
        FROM
            `" . $table_name . "`
        WHERE
            \"random_num\" NOT IN (SELECT `token` FROM `" . $table_name . "`)
        LIMIT 1");

    if( mysqli_num_rows($query) ) {
        $row = mysqli_fetch_assoc($query);
        return $row['random_num'];
    } else {
        return rand(1000000000, 9999999999);
    }
}

function getTimeDifference( $date_time ) {
	$cur_date_time = $GLOBALS['cur_date_time'];
	$date1 = new DateTime($date_time);
	$date2 = $date1->diff(new DateTime($cur_date_time));
	if ($date2->y) {
		return ($date2->y > 1) ? $date2->y . " yrs" : $date2->y . " yr";
	} else if ($date2->m) {
		return ($date2->m > 1) ? $date2->m . " months" : $date2->m . " month";
	} else if ($date2->d) {
		return ($date2->d > 1) ? $date2->d . " days" : $date2->d . " day";
	} else if ($date2->H) {
		return ($date2->H > 1) ? $date2->H . " hrs" : $date2->H . " hr";
	} else if ($date2->i) {
		return ($date2->i > 1) ? $date2->i . " mins" : $date2->i . " min";
	} else if ($date2->s) {
		return ($date2->s > 1) ? $date2->s . " secs" : $date2->s . " sec";
	}
}

function extractMobileNumber( $mobile ) {
	return $mobile;
}

function moneyFormatIndia($cost) {
	$cost = number_format((float)$cost, 2, '.', '');
	$cost_value_array = explode(".", $cost);

	$num = $cost_value_array[0];

    $explrestunits = "";
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    if ( $cost_value_array[1] != "00") {
    	$thecash .= "." . $cost_value_array[1];
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}

function cmp_offered_price($a, $b) {
    return strcmp($a->offered_price, $b->offered_price);
}

// // home page url
// // $home_url = "http://localhost:8888/buzye_live/API/KPhbltH2Jh_0.3/";
// $home_url = "https://www.buzye.com/buzye_live/API/KPhbltH2Jh_0.3/";

// // page given in URL parameter, default page is one
// $page = isset($_GET['page']) ? $_GET['page'] : 1;

// // set number of records per page
// $records_per_page = 5;

// // calculate for the query LIMIT clause
// $from_record_num = ($records_per_page * $page) - $records_per_page;

// $category_limit = 10;
// $artist_limit = 10;
// $age_group_limit = 4;
?>
