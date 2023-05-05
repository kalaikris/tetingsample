<?php
    $input_data = json_decode(file_get_contents("php://input"));
    $input = (parse_ini_file("../../../../myconfig.ini"));
    $s3_cloudfront = $input['s3_cloudfront'];
    $s3_bucket = $input['s3_bucket'];
    $s3_access_key = $input['s3_access_key'];
    $s3_secret_key = $input['s3_secret_key'];
?>