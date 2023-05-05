<?php
$link = mysqli_connect("localhost", "airportzo_development", '$cU3N=&IeiG_', "airportzo_airportz_testing");

$array = [];
$res = mysqli_query($link, "SELECT `id`, `name`, `code` FROM `countries`");
while($row = mysqli_fetch_array($res)) {
    $obj = new stdClass;
    $obj->id = $row['id'];
    $obj->code = $row['code'];
    array_push($array, $obj);
}

$gmt = "{\"AF\":4.3,\"AL\":2,\"DZ\":2,\"AS\":-11,\"AO\":1,\"AI\":-4,\"AG\":-4,\"AR\":-3,\"AM\":4,\"AW\":-4,\"AU\":10,\"AT\":1,\"AZ\":4,\"BS\":-5,\"BH\":3,\"BD\":6,\"BB\":-4,\"BY\":3,\"BE\":1,\"BZ\":-6,\"BJ\":1,\"BM\":-4,\"BT\":6,\"BO\":-4,\"BA\":1,\"BW\":2,\"BR\":-5,\"BG\":2,\"BF\":0,\"BI\":2,\"KH\":7,\"CM\":1,\"CA\":-6,\"CV\":-1,\"KY\":-5,\"CF\":1,\"TD\":1,\"CL\":-3,\"CN\":8,\"CX\":7,\"CC\":6.3,\"CO\":-5,\"KM\":3,\"CD\":1,\"CK\":-10,\"CR\":-6,\"CI\":0,\"HR\":1,\"CY\":2,\"CZ\":1,\"DK\":1,\"DJ\":3,\"DM\":-4,\"DO\":-4,\"EC\":-5,\"EG\":2,\"SV\":-6,\"GQ\":1,\"ER\":3,\"EE\":2,\"ET\":3,\"FK\":-3,\"FO\":0,\"FJ\":12,\"FI\":2,\"FR\":1,\"GF\":-3,\"PF\":-10,\"GA\":1,\"GM\":0,\"GE\":4,\"DE\":1,\"GH\":0,\"GI\":1,\"GR\":2,\"GL\":-3,\"GD\":-4,\"GP\":-4,\"GU\":10,\"GT\":-6,\"GG\":0,\"GN\":0,\"GW\":0,\"GY\":-4,\"HT\":-5,\"HM\":5,\"VA\":1,\"HN\":-6,\"HK\":8,\"HU\":1,\"IS\":0,\"IN\":5.3,\"ID\":7,\"IR\":3.3,\"IQ\":3,\"IE\":0,\"IM\":0,\"IL\":2,\"IT\":1,\"JM\":-5,\"JP\":9,\"JE\":0,\"JO\":2,\"KZ\":5,\"KE\":3,\"KI\":12,\"KP\":8.3,\"KR\":9,\"KW\":3,\"KG\":6,\"LA\":7,\"LV\":2,\"LB\":2,\"LS\":2,\"LR\":0,\"LI\":1,\"LT\":2,\"LU\":1,\"MK\":1,\"MG\":3,\"MW\":2,\"MY\":8,\"MV\":5,\"ML\":0,\"MT\":0,\"MH\":12,\"MQ\":-4,\"MR\":0,\"MU\":4,\"YT\":3,\"MX\":-6,\"FM\":10,\"MD\":2,\"MC\":1,\"MN\":8,\"MS\":-4,\"MA\":0,\"MZ\":2,\"MM\":6.3,\"NA\":1,\"NR\":12,\"NP\":5.45,\"NL\":1,\"AN\":-4,\"NZ\":12,\"NI\":-6,\"NE\":1,\"NG\":1,\"NU\":-11,\"NF\":11.3,\"MP\":10,\"NO\":1,\"OM\":4,\"PK\":5,\"PW\":9,\"PS\":2,\"PA\":-5,\"PG\":10,\"PY\":-4,\"PE\":-5,\"PH\":8,\"PL\":1,\"PT\":0,\"PR\":-4,\"QA\":3,\"RE\":4,\"RU\":0,\"RW\":2,\"SH\":0,\"KN\":-4,\"LC\":-4,\"PM\":-3,\"VC\":-4,\"WS\":13,\"SM\":1,\"ST\":0,\"SA\":3,\"SN\":0,\"SC\":4,\"SL\":0,\"SG\":8,\"SK\":1,\"SI\":1,\"SB\":11,\"SO\":3,\"ZA\":2,\"GS\":-2,\"ES\":1,\"LK\":5.3,\"SD\":3,\"SR\":-3,\"SJ\":1,\"SZ\":2,\"SE\":1,\"CH\":1,\"SY\":2,\"TW\":8,\"TJ\":5,\"TZ\":3,\"TH\":7,\"TG\":0,\"TK\":13,\"TO\":13,\"TT\":13,\"TN\":1,\"TR\":2,\"TM\":5,\"TV\":12,\"UG\":3,\"UA\":2,\"AE\":4,\"GB\":0,\"US\":-6,\"UY\":-3,\"UZ\":5,\"VU\":11,\"VE\":-4.3,\"VN\":7,\"VG\":-4,\"VI\":-4,\"WF\":12,\"EH\":1,\"YE\":3,\"ZM\":1,\"ZW\":2,\"AX\":2,\"AD\":1,\"AQ\":13,\"BV\":1,\"IO\":6,\"BN\":8,\"CG\":1,\"CU\":-5,\"TF\":5,\"XK\":1,\"LY\":2,\"MO\":8,\"NC\":11,\"PN\":-8,\"RO\":2,\"RS\":1,\"ME\":1,\"TL\":9,\"TC\":-5,\"UM\":-11}";
$gmt = json_decode($gmt);
foreach ($gmt as $gmt_key => $gmt_value) {
    foreach ($array as $key => $value) {
        if ($value->code == $gmt_key) {
            echo "UPDATE `countries` SET `gmt`='GMT " . formatNum($gmt_value) . "' WHERE `id`=" . $value->id . ";<br/>";
        }
    }
}
function formatNum($num) {
    return ($num >= 0)? '+' . $num: $num;
}
?>