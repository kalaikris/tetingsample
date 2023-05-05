<?php
    $input_data = json_decode(file_get_contents("php://input"));
    $input = (parse_ini_file("../../myconfig.ini"));
    $localhost = $input['localhost'];
    $database_username = $input['database_username'];
    $database_password = $input['database_password'];
    $database_name = $input['database_name'];
?>