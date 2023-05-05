<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);
// $obj = new stdClass;
if (array_key_exists('REDIRECT_HTTP_AUTHORIZATION', $_SERVER)) {
    if ($_SERVER['REDIRECT_HTTP_AUTHORIZATION'] != '') {
        $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        $result = explode(" ", $authHeader, 2);
        $checkToken = $result[1];
        $auth_val = base64_decode($checkToken);
        $auth_array = explode(":", $auth_val);
        $auth_username = $auth_array[0];
        $auth_password = $auth_array[1];

        include '../config/core.php';

        $external_password = hashPassword($auth_password);

        include '../objects/service-distributor.php';
        $service_distributor = new ServiceDistributor();
        $service_distributor->external_user_name = $auth_username;
        $service_distributor->external_password = $external_password;
        $service_distributor->readDistributor();
        if ($service_distributor->stmt->rowCount() > 0) {
            $service_distributor_data = $service_distributor->makeView()[0];

            $input_data = getInputs();
            $journey_array = $input_data->journey_array;
            $journey_count = sizeof($journey_array);

            if ( $journey_count > 0 && validateInputs($journey_array) ) {
                include '../objects/airport.php';
                $airport = new Airport();

                include '../objects/service-location.php';
                $service_location = new ServiceLocation();

                $station_array = parseStations($airport, $journey_array, $journey_count);
                if ($station_array !== false) {
                    $station_data = serviceCollectionForStation($station_array, $service_location, $journey_count); //$airport_ttr, $airport_category, $airport_type, , $has_specific_service, $service_token

                    $service_count = 0;
                    foreach ($station_data as $station_value) {
                        foreach ($station_value->service_collection as $service_col_value) {
                            $service_count++;
                        }
                    }

                    if ($service_count > 0) {
                        include '../objects/users-external-journey.php';
                        $users_ext_journey_token = genToken('users__external_journey');

                        $users_ext_journey = new UsersExtJourney();
                        $users_ext_journey->token = $users_ext_journey_token;
                        $users_ext_journey->sd_token = $service_distributor_data->token;
                        $users_ext_journey->journey = json_encode($journey_array, true);
                        $users_ext_journey->checkDuplicateJourney();

                        $journey_token = "";
                        if ($users_ext_journey->stmt->rowCount() > 0) {
                            $users_ext_journey_data = $users_ext_journey->makeView()[0];
                            $journey_token = $users_ext_journey_data->token;
                            
                            // $obj = new stdClass;
                            // $obj->status_code = 200;
                            // $obj->message = "Services list";
                            // $obj->data = $users_ext_journey_data->token;
                        } else {
                            $users_ext_journey->create();
                            $journey_token = strval($users_ext_journey_token);

                            // $obj = new stdClass;
                            // $obj->status_code = 200;
                            // $obj->message = "Services list";
                            // $obj->data = strval($users_ext_journey_token);
                        }

                        // $business_array = [];
                        // foreach ($station_data as $station_value) {
                        //     foreach ($station_value->service_collection as $service_value) {
                        //         $index = -1;
                        //         foreach ($business_array as $business_key => $business_value) {
                        //             if ($business_value->token == $service_value->token) {
                        //                 $index = $business_key;
                        //             }
                        //         }
                        //         unset($business_value);

                        //         if ($index == -1) {
                        //             array_push($business_array, $service_value);
                        //         }
                        //     }
                        //     unset($service_value);
                        // }
                        // unset($station_value);

                        $obj = new stdClass;
                        $obj->journey_token = $journey_token;
                        // $obj->data = $business_array;
                        $obj->data = $station_data;
                        echo json_encode($obj);
                    } else {
                        ob_start();
                        header('HTTP/1.0 204 NO CONTENT');
                        exit;

                        // $obj = new stdClass;
                        // $obj->status_code = 400;
                        // $obj->message = "No services found";
                        // $obj->data = [];
                    }
                } else {
                    initBadRequest();

                    // $obj = new stdClass;
                    // $obj->status_code = 400;
                    // $obj->message = "Airport error occured !";
                    // $obj->data = [];
                }
            } else {
                initBadRequest();
            }
        } else {
            dropAccess();
        }
    } else {
        dropAccess();
    }
} else {
    dropAccess();
}
// echo json_encode($obj);

function dropAccess() {
    ob_start();
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

function initBadRequest() {
    ob_start();
    header('HTTP/1.0 400 BAD REQUEST');
    exit;
}

function validateInputs($journey_array) {
    $is_valid = true;
    foreach ($journey_array as $journey_value) {
        if ( !property_exists($journey_value, "departure_airport") || trim($journey_value->departure_airport) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "departure_terminal") || trim($journey_value->departure_terminal) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "departure_datetime") || trim($journey_value->departure_datetime) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "arrival_airport") || trim($journey_value->arrival_airport) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "arrival_terminal") || trim($journey_value->arrival_terminal) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "arrival_datetime") || trim($journey_value->arrival_datetime) == "" ) $is_valid = false;
        if ( !property_exists($journey_value, "flight_number") || trim($journey_value->flight_number) == "" ) $is_valid = false;
    }
    unset($journey_value);
    return $is_valid;
}

function parseStations($airport, $journey_array, $journey_count) {
    $station_array = [];
    // $airport_error = false;
    foreach ($journey_array as $journey_key => $journey_value) {
        if ($journey_key == 0) {
            $airport->airport_code = $journey_value->departure_airport;
            $airport->readOneByCode();
            if ($airport->stmt->rowCount() > 0) {
                $airport_detail = $airport->makeView()[0];

                $station_obj = new stdClass;
                // $station_obj->airport_token = $airport_detail->token;
                $station_obj->airport_code = $journey_value->departure_airport;
                $station_obj->airport_name = $airport_detail->name;
                $station_obj->category_name = "Departure";
                $station_obj->country_code = $airport_detail->country_code;
                $station_obj->terminal_name = $journey_value->departure_terminal;
                $station_obj->type_name = "";
                array_push($station_array, $station_obj);
            } else {
                initBadRequest();
                // $airport_error = true;
            }
        }

        $airport->airport_code = $journey_value->arrival_airport;
        $airport->readOneByCode();
        if ($airport->stmt->rowCount() > 0) {
            $airport_detail = $airport->makeView()[0];

            $station_obj = new stdClass;
            // $station_obj->airport_token = $airport_detail->token;
            $station_obj->airport_code = $journey_value->arrival_airport;
            $station_obj->airport_name = $airport_detail->name;
            $station_obj->category_name = ($journey_key < ($journey_count-1))? "Transit": "Arrival";
            $station_obj->country_code = $airport_detail->country_code;
            $station_obj->terminal_name = $journey_value->arrival_terminal;
            $station_obj->type_name = "";
            array_push($station_array, $station_obj);
        } else {
            initBadRequest();
            // $airport_error = true;
        }
    }
    unset($journey_value);

    // if ($airport_error) {
    //     return false;
    // } else {
        foreach ($station_array as $station_key => $station_value) {
            $airport_type_array = [];
            if ($station_key > 0) {
                $arrival_type = ($station_array[$station_key]->country_code == $station_array[$station_key - 1]->country_code)? 'Domestic': 'International';
                array_push($airport_type_array, $arrival_type);
            }
            if ($station_key < $journey_count) {
                $departure_type = ($station_array[$station_key]->country_code == $station_array[$station_key + 1]->country_code)? 'Domestic': 'International';
                array_push($airport_type_array, $departure_type);
            }
            $station_value->type_name = implode("-", $airport_type_array);
        }
        unset($station_value);

        return $station_array;
    // }
}

// For collecting services for all stations based on airport-type[Domestic & International]
function serviceCollectionForStation($station_array, $service_location, $journey_count) { //$airport_ttr, $airport_category, $airport_type, , $has_specific_service, $service_token
    $station_data = [];

    foreach ($station_array as $station_value) {
        $station_value->service_collection = [];

        $service_location->airport_code = $station_value->airport_code;
        $service_location->terminal_name = $station_value->terminal_name;
        $service_location->category_name = $station_value->category_name;
        $service_location->type_name = $station_value->type_name;
        $service_location->getBusinessForStation();
        if ($service_location->stmt->rowCount() > 0) {
            $station_value->service_collection = $service_location->makeBusinessView();
        }
        array_push($station_data, $station_value);
    }
    unset($station_value);
    
    return $station_data;
}

function getStationDetail($airport_ttr_detail, $journey_type) {
    $station_obj = new stdClass;
    $station_obj->ttr_token = $airport_ttr_detail->ttr_token;

    $station_obj->category_name = $journey_type;
    $station_obj->airport_code = $airport_ttr_detail->airport_code;
    $station_obj->airport_name = $airport_ttr_detail->airport_name;
    $station_obj->terminal_name = $airport_ttr_detail->terminal_name;

    $station_obj->type_name = "";
    $station_obj->city_name = $airport_ttr_detail->city_name;
    $station_obj->country_code = $airport_ttr_detail->country_code;

    $station_obj->airport_token = $airport_ttr_detail->airport_token;
    $station_obj->terminal_token = $airport_ttr_detail->terminal_token;
    $station_obj->type_token = "";
    $station_obj->category_token = "";

    return $station_obj;
}

// For parsing stations from journeys
function parseStationFromJourney($airport_ttr, $journey_array, $journey_count) {
    $station_array = [];
    foreach ($journey_array as $journey_key => $journey_value) {
        if ($journey_key == 0) {
            $airport_ttr->token = $journey_value->departure_ttr_token;
            $airport_ttr->readOneTerminal();
            $airport_ttr_detail = $airport_ttr->makeView()[0];

            $station_obj = getStationDetail($airport_ttr_detail, "Departure");
            array_push($station_array, $station_obj);
        }

        $airport_ttr->token = $journey_value->arrival_ttr_token;
        $airport_ttr->readOneTerminal();
        $airport_ttr_detail = $airport_ttr->makeView()[0];
        
        if ($journey_key == ($journey_count-1)) {
            $station_obj = getStationDetail($airport_ttr_detail, "Arrival");
            array_push($station_array, $station_obj);
        } else {
            $station_obj = getStationDetail($airport_ttr_detail, "Transit");
            array_push($station_array, $station_obj);
        }
    }
    unset($journey_value);

    return $station_array;
}
?>