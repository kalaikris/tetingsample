<?php
$link = mysqli_connect("localhost", "airportzostage_stage", '$cU3N=&IeiG_', "airportzostage_stage");
date_default_timezone_set('Asia/Kolkata');

$current_time = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")));

$checkquery = mysqli_query($link, "SELECT `id`, `time_zone`,`token` FROM `airport` WHERE status!='2'");
if(mysqli_num_rows($checkquery)!=0) {
    while($checkrow = mysqli_fetch_array($checkquery)){
        $timeZone = $checkrow['time_zone'];
        $get_timeZone = getUTCOffset($timeZone);
        $row_token = $checkrow['token'];
        $get_gmt_date = gmt_date($timeZone);
        $query = mysqli_query($link, "UPDATE `airport` SET `gmt`='$get_timeZone',`gmt_date`='$get_gmt_date' WHERE `token`='$row_token' AND `time_zone`='$timeZone'");
        if(mysqli_affected_rows($link)>0){
            mysqli_query($link, "UPDATE `airport` SET `status`='1' WHERE `token`='$row_token'");
        }
    }
}

function getUTCOffset($timezone)
{
    $current   = timezone_open($timezone);
    $utcTime  = new \DateTime('now', new \DateTimeZone('UTC'));
    $offsetInSecs =  timezone_offset_get( $current, $utcTime);
    $hoursAndSec = gmdate('H:i', abs($offsetInSecs));
    return stripos($offsetInSecs, '-') === false ? "+{$hoursAndSec}" : "-{$hoursAndSec}";
}

function gmt_date($timezone){
    $timezone = new DateTimeZone($timezone);
    $date = new DateTime();
    $date->setTimezone($timezone);
    return $dtobj = $date->format('Y-m-d');
}

error_log("cron run: $current_time \n", 3, "/home/airportzostage/public_html/crontest.txt");
mysqli_close($link);
?>