<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';

include_once '../objects/airport-ttr.php';
$airport_ttr = new AirportTTR();
$airport_ttr->readAllTerminals();

$obj = new stdClass;
if ($airport_ttr->stmt->rowCount() > 0) {
    $terminal_array = $airport_ttr->makeView();

    $common_terminals = [];
    $arrival_terminals = [];
    $departure_terminals = [];
    $transit_terminals = [];
    foreach ($terminal_array as $key => $value) {
        $temp_index = -1;
        foreach ($common_terminals as $common_key => $common_value) {
            if ($common_value->airport_token == $value->airport_token && $common_value->terminal_token == $value->terminal_token) {
                $temp_index = $common_key;
            }
        }
        unset($common_value);

        if ($temp_index == -1) array_push($common_terminals, $value);
    }
    unset($value);

    $terminal_data = new stdClass;
    $terminal_data->common = $common_terminals;
    $terminal_data->arrival = $arrival_terminals;
    $terminal_data->departure = $departure_terminals;
    $terminal_data->transit = $transit_terminals;

    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $terminal_data;
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No terminals found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);

// if ($temp_index == -1) {
//     $common_obj = clone $value;
//     $common_obj = new stdClass;
//     $common_obj->ttr_token = $value->ttr_token;
//     $common_obj->airport_token = $value->airport_token;
//     $common_obj->airport_name = $value->airport_name;
//     $common_obj->airport_code = $value->airport_code;
//     $common_obj->terminal_token = $value->terminal_token;
//     $common_obj->terminal_name = $value->terminal_name;
//     $common_obj->terminal_string = $value->terminal_string;
//     array_push($common_terminals, $common_obj);
// }

// if ($value->category_name == 'Arrival') {
//     array_push($arrival_terminals, $value);
// } else if ($value->category_name == 'Departure') {
//     array_push($departure_terminals, $value);
// } else if ($value->category_name == 'Transit') {
//     array_push($transit_terminals, $value);
// }
?>