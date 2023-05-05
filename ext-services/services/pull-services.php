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
            if ( validateInputs($input_data) ) {
                include '../objects/users-external-journey.php';
                $users_ext_journey = new UsersExtJourney();
                $users_ext_journey->token = $input_data->journey_token;
                $users_ext_journey->sd_token = $service_distributor_data->token;
                $users_ext_journey->getJourneyForToken();

                if ($users_ext_journey->stmt->rowCount() > 0) {
                    $journey_json = $users_ext_journey->makeView()[0]->journey;
                    $journey_array = json_decode($journey_json, true);
                    $journey_count = sizeof($journey_array);

                    include '../objects/airport.php';
                    $airport = new Airport();

                    include '../objects/service-location.php';
                    $service_location = new ServiceLocation();

                    $station_array = parseStations($airport, $journey_array, $journey_count);
                    if ($station_array !== false) {
                        $station_data = serviceCollectionForStation($station_array, $service_location, $input_data->service_collection, $service_distributor_data->token); //$airport_ttr, $airport_category, $airport_type, , $has_specific_service, $service_token
                        $markupval = '';
                        $markuptype = '';
                        $ismarkup = '';
                        $currency = trim($input_data->currency);
                        if ($currency != 'INR') {
                            include '../config/currency.php';
                            $currency_value = changeCurrency("INR", $currency);
                            
                            if($currency_value > 0) {
                                foreach ($station_data as $station_key => $station_value) {
                                    foreach ($station_value->service_collection as $sc_key => $sc_value) {
                                        $total_price_adult = $sc_value->price_adult * $currency_value;
                                        $total_price_adult = number_format((float)$total_price_adult, 2, '.', '');
                                        $station_data[$station_key]->service_collection[$sc_key]->price_adult = $total_price_adult;
                                        
                                        $total_price_children = $sc_value->price_children * $currency_value;
                                        $total_price_children = number_format((float)$total_price_children, 2, '.', '');
                                        $station_data[$station_key]->service_collection[$sc_key]->price_children = $total_price_children;
                                    }
                                    unset($sc_value);
                                }
                                unset($station_value);
                            }
                        }
                       
                        $service_count = 0;
                        foreach ($station_data as $station_value) {
                            foreach ($station_value->service_collection as $service_col_value) {
                                $service_count++;
                            }
                        }

                        if ($service_count > 0) {
                            // $station_data = partServices($station_data);
                            // $station_data = groupServices($station_data);
                            // $station_data = matchIndividualWithBundle($station_data);

                            include '../objects/sp-company-location-photos.php';
                            $sp_photos = new ServiceProviderCompanyLocationPhotos();

                            include '../objects/sp-company-location-amenities.php';
                            $sp_amenities = new ServiceProviderCompanyLocationAmenities();

                            foreach ($station_data as $station_key => $station_values) {
                                foreach ($station_values->service_collection as $sc_key => $sc_value) {
                                    
                                    if($station_data[$station_key]->service_collection[$sc_key]->markupType == 'Percentage'){
                                        $markupval = $station_data[$station_key]->service_collection[$sc_key]->markupPercentage.'%';
                                    }else{
                                        $markupval = $station_data[$station_key]->service_collection[$sc_key]->markupPercentage;
                                    }
                                    $markuptype = $station_data[$station_key]->service_collection[$sc_key]->markupType;
                                    $ismarkup = $station_data[$station_key]->service_collection[$sc_key]->is_markup;
                                    unset($station_data[$station_key]->service_collection[$sc_key]->markupPercentage);
                                    unset($station_data[$station_key]->service_collection[$sc_key]->markupType);
                                    unset($station_data[$station_key]->service_collection[$sc_key]->is_markup);
                                    unset($station_data[$station_key]->service_collection[$sc_key]->markupAmount);
                                }
                                unset($sc_value);
                            }
                            unset($station_value);

                            // foreach ($station_data as $station_key => $station_value) {
                            //     unset($station_value->airport_token);
                            //     foreach ($station_value->service_collection as $service_collection_value) {
                            //         foreach ($service_collection_value->service_group as $service_group_value) {
                            //             $sp_photos->service_provider_company_location_token = $service_group_value->service_provider_company_location_token;
                            //             $sp_photos->readForLocation();
                            //             $service_group_value->photos = ($sp_photos->stmt->rowCount() > 0)? $sp_photos->makeView(): [];

                            //             $sp_amenities->service_provider_company_location_token = $service_group_value->service_provider_company_location_token;
                            //             $sp_amenities->readForLocation();
                            //             $service_group_value->amenities = ($sp_amenities->stmt->rowCount() > 0)? $sp_amenities->makeView(): [];

                            //             unset($service_group_value->service_provider_company_location_token);
                            //             unset($service_group_value->business_tokens);
                            //             unset($service_group_value->business_name);
                            //             foreach ($service_group_value->service_array as $key => $service_value) {
                            //                 unset($service_value->token);
                            //                 unset($service_value->service_provider);
                            //                 // unset($service_value->sp_company_token);
                            //                 // unset($service_value->sp_company_name);
                            //                 // unset($service_value->sp_company_logo);
                            //                 // unset($service_value->sp_company_image);
                            //                 unset($service_value->business_tokens);
                            //                 unset($service_value->service_type);
                            //                 unset($service_value->service_provider_company_location_token);
                            //                 unset($service_value->about_description);
                            //                 unset($service_value->terms_conditions);
                            //                 unset($service_value->privacy_policy);
                            //                 unset($service_value->cancellation_policy);
                            //                 unset($service_value->reschedule_policy);
                            //                 unset($service_value->cancellation_policy_detail);
                            //                 // unset($service_value->reschedule_policy);
                            //             }
                            //             unset($service_value);
                            //         }
                            //         unset($service_group_value);
                            //     }
                            //     unset($service_collection_value);
                            // }
                            // unset($station_value);

                            $obj = new stdClass;
                            // $obj->status_code = 200;
                            // $obj->message = "Services list";
                            $obj->journey_token = $input_data->journey_token;
                            $obj->currency = $input_data->currency;
                            $obj->markup_type = $markuptype;
                            $obj->markup_value = strval($markupval);
                            // $obj->is_markup = $ismarkup;
                            $obj->station_data = $station_data;
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
                    ob_start();
                    header('HTTP/1.0 428 Precondition Required');
                    exit;
                }
            } else {
                initBadRequest();
            }
        } else {
            dropAccess();
            // $obj = new stdClass;
            // $obj->status_code = 400;
            // $obj->message = "Authorization error occured !";
            // $obj->data = [];
        }
    } else {
        dropAccess();
        // $obj = new stdClass;
        // $obj->status_code = 400;
        // $obj->message = "Authorization missing !";
        // $obj->data = [];
    }
} else {
    dropAccess();
    // $obj = new stdClass;
    // $obj->status_code = 400;
    // $obj->message = "Authorization missing !";
    // $obj->data = [];
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

function validateInputs($input_data) {
    $is_valid = true;
    if ( !property_exists($input_data, "journey_token") || trim($input_data->journey_token) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "currency") || trim($input_data->currency) == "" ) $is_valid = false;
    if ( !property_exists($input_data, "service_collection") || !is_array($input_data->service_collection) ) $is_valid = false;
    
    foreach ($input_data->service_collection as $service_value) {
        if ( !property_exists($service_value, "airport_code") || trim($service_value->airport_code) == "" ) $is_valid = false;
        if ( !property_exists($service_value, "category_name") || trim($service_value->category_name) == "" ) $is_valid = false;
        if ( !property_exists($service_value, "services") || !is_array($service_value->services) ) $is_valid = false;
    }
    unset($service_value);
    
    return $is_valid;
}

function parseStations($airport, $journey_array, $journey_count) {
    $station_array = [];
    $airport_error = false;
    foreach ($journey_array as $journey_key => $journey_value) {
        if ($journey_key == 0) {
            $airport->airport_code = $journey_value["departure_airport"];//->departure_airport;
            $airport->readOneByCode();
            if ($airport->stmt->rowCount() > 0) {
                $airport_detail = $airport->makeView()[0];

                $station_obj = new stdClass;
                $station_obj->airport_token = $airport_detail->token;
                $station_obj->airport_code = $journey_value["departure_airport"];//->departure_airport;
                $station_obj->airport_name = $airport_detail->name;
                $station_obj->category_name = "Departure";
                $station_obj->country_code = $airport_detail->country_code;
                $station_obj->terminal_name = $journey_value["departure_terminal"];//->departure_terminal;
                $station_obj->type_name = "";
                array_push($station_array, $station_obj);
            } else {
                $airport_error = true;
            }
        }

        $airport->airport_code = $journey_value["arrival_airport"];//->arrival_airport;
        $airport->readOneByCode();
        if ($airport->stmt->rowCount() > 0) {
            $airport_detail = $airport->makeView()[0];

            $station_obj = new stdClass;
            $station_obj->airport_token = $airport_detail->token;
            $station_obj->airport_code = $journey_value["arrival_airport"];//->departure_airport;
            $station_obj->airport_name = $airport_detail->name;
            $station_obj->category_name = ($journey_key < ($journey_count-1))? "Transit": "Arrival";
            $station_obj->country_code = $airport_detail->country_code;
            $station_obj->terminal_name = $journey_value["arrival_terminal"];//->arrival_terminal;
            $station_obj->type_name = "";
            array_push($station_array, $station_obj);
        } else {
            $airport_error = true;
        }
    }
    unset($journey_value);

    if ($airport_error) {
        return false;
    } else {
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
    }
}

// For collecting services for all stations based on airport-type[Domestic & International]
function serviceCollectionForStation($station_array, $service_location, $input_service_collection, $distributor_token) { //$airport_ttr, $airport_category, $airport_type, , $has_specific_service, $service_token
    $station_data = [];

    foreach ($station_array as $station_key => $station_value) {
        $index = -1;
        foreach ($input_service_collection as $isc_key => $isc_value) {
            if ($isc_value->airport_code == $station_value->airport_code) {
                $index = $isc_key;
            }
        }
        unset($isc_value);

        if ($index > -1) {
            $station_value->service_collection = [];

            $service_location->airport_code = $station_value->airport_code;
            $service_location->terminal_name = $station_value->terminal_name;
            $service_location->category_name = $station_value->category_name;
            $service_location->type_name = $station_value->type_name;
            $service_location->distributor_token = $distributor_token;
            $service_location->searchServicesForStation();
            if ($service_location->stmt->rowCount() > 0) {
                $service_collection = $service_location->makeView();
                $service_collection_filtered = [];

                $input_services = $input_service_collection[$index]->services;
                foreach ($service_collection as $sc_key => $sc_value) {
                    //  unset($sc_value->markupAmount);
                    //  unset($sc_value->markupPercentage);
                    $has_common_service = array_intersect($input_services, $sc_value->business_tokens);
                    // if (count($has_common_service) == 0) unset($service_collection[$sc_key]);
                    if (count($has_common_service) > 0) {
                        $sc_value->links->terms_conditions = $GLOBALS['doc_url'] . "terms.php?a=" . $station_value->airport_token . "&c=" . $sc_value->service_provider_token;
                        $sc_value->links->privacy_policy = $GLOBALS['doc_url'] . "privacy.php?a=" . $station_value->airport_token . "&c=" . $sc_value->service_provider_token;
                        $sc_value->links->cancellation_policy = $GLOBALS['doc_url'] . "cancellation.php?a=" . $station_value->airport_token . "&c=" . $sc_value->service_provider_token;

                        unset($sc_value->service_provider_token);
                        unset($sc_value->business_tokens);
                        array_push($service_collection_filtered, $sc_value);
                    }
                }
                unset($sc_value);

                $station_value->service_collection = $service_collection_filtered;
            }
            array_push($station_data, $station_value);
        }
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

// // For splitting services (Bundle & Individual)
// function partServices($station_data) {
//     foreach ($station_data as $station_value) {
//         $bundled_services = [];
//         $individual_services = [];

//         $service_array = $station_value->service_collection;
//         foreach ($service_array as $service_key => $service_value) {
//             if ($service_value->service_type == 'Bundle') array_push($bundled_services, $service_value);
//             else array_push($individual_services, $service_value);
//         }
//         unset($service_value);

//         $grouped_service_array = [];
//         if (sizeof($bundled_services) > 0) {
//             $grouped_obj = new stdClass;
//             $grouped_obj->service_type = 'Bundle';
//             $grouped_obj->title = '';
//             $grouped_obj->service_group = $bundled_services;
//             array_push($grouped_service_array, $grouped_obj);
//         }
//         if (sizeof($individual_services) > 0) {
//             $grouped_obj = new stdClass;
//             $grouped_obj->service_type = 'Individual';
//             $grouped_obj->title = '';
//             $grouped_obj->service_group = $individual_services;
//             array_push($grouped_service_array, $grouped_obj);
//         }
//         $station_value->service_collection = $grouped_service_array;
//     }
//     unset($station_value);

//     return $station_data;
// }

// // For grouping - 1.Bundle(by company), 2.Individual(by service)
// function groupServices($station_data) {
//     foreach ($station_data as $station_value) {
//         foreach ($station_value->service_collection as $collection_value) {
//             if ($collection_value->service_type == 'Bundle') {
//                 $company_grouped_services = [];
//                 $service_array = $collection_value->service_group;
//                 foreach ($service_array as $service_value) {
//                     $service_min_price = ($service_value->price_adult < $service_value->price_children)? $service_value->price_adult: $service_value->price_children;

//                     $index = -1;
//                     foreach ($company_grouped_services as $key => $company_grouped_value) {
//                         // if ($company_grouped_value->sp_company_token == $service_value->sp_company_token) {
//                         if ($company_grouped_value->service_provider == $service_value->service_provider) {
//                             $index = $key;
//                         }
//                     }
//                     unset($company_grouped_value);

//                     if ($index > -1) {
//                         $company_grouped_service_array = $company_grouped_services[$index]->service_array;
//                         array_push($company_grouped_service_array, $service_value);
//                         $company_grouped_services[$index]->service_array = $company_grouped_service_array;

//                         $minimum_price = $company_grouped_services[$index]->minimum_price;
//                         $company_grouped_services[$index]->minimum_price = ($minimum_price < $service_min_price)? $minimum_price: $service_min_price;

//                         $business_names = $company_grouped_services[$index]->business_names;
//                         foreach ($service_value->business_names as $business_name) {
//                             if ( !in_array($business_name, $business_names) ) {
//                                 array_push($business_names, $business_name);
//                             }
//                         }
//                         $company_grouped_services[$index]->business_names = $business_names;
//                     } else {
//                         $company_grouped_obj = new stdClass;
//                         $company_grouped_obj->service_provider_company_location_token = $service_value->service_provider_company_location_token;
//                         $company_grouped_obj->service_provider = $service_value->service_provider;
//                         // $company_grouped_obj->sp_company_token = $service_value->sp_company_token;

//                         // $company_grouped_obj->sp_company_name = $service_value->sp_company_name;
//                         // $company_grouped_obj->sp_company_logo = $service_value->sp_company_logo;
//                         // $company_grouped_obj->sp_company_image = $service_value->sp_company_image;
//                         $company_grouped_obj->minimum_price = $service_min_price;
//                         $company_grouped_obj->business_tokens = $service_value->business_tokens;
//                         $company_grouped_obj->business_names = $service_value->business_names;
//                         $company_grouped_obj->business_name = $service_value->business_names[0];
//                         $company_grouped_obj->terms_conditions = $GLOBALS['doc_url'] . "terms.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; // $service_value->sp_company_token; //$service_value->terms_conditions;
//                         $company_grouped_obj->privacy_policy = $GLOBALS['doc_url'] . "privacy.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; // $service_value->sp_company_token; //$service_value->privacy_policy;
//                         $company_grouped_obj->cancellation_policy = $GLOBALS['doc_url'] . "cancellation.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; // $service_value->sp_company_token; //$service_value->cancellation_policy;
//                         $company_grouped_obj->reschedule_policy = $service_value->reschedule_policy;
//                         $company_grouped_obj->about_description = $service_value->about_description;
//                         $company_grouped_obj->cancellation_policy_detail = $service_value->cancellation_policy_detail;
//                         $company_grouped_obj->photos = [];
//                         $company_grouped_obj->amenities = [];
//                         $company_grouped_obj->service_array = [$service_value];

//                         array_push($company_grouped_services, $company_grouped_obj);
//                     }
//                 }
//                 unset($service_value);

//                 $collection_value->service_group = $company_grouped_services;
//             } else {
//                 $service_grouped_services = [];
//                 $service_array = $collection_value->service_group;
//                 foreach ($service_array as $service_value) {
//                     $service_min_price = ($service_value->price_adult < $service_value->price_children)? $service_value->price_adult: $service_value->price_children;

//                     $index = -1;
//                     foreach ($service_grouped_services as $key => $service_grouped_value) {
//                         // if ($service_grouped_value->sp_company_token == $service_value->sp_company_token) {
//                         if ($service_grouped_value->service_provider->token == $service_value->service_provider->token) {
//                             $index = $key;
//                         }
//                     }
//                     unset($service_grouped_value);

//                     if ($index > -1) {
//                         $service_grouped_service_array = $service_grouped_services[$index]->service_array;
//                         array_push($service_grouped_service_array, $service_value);
//                         $service_grouped_services[$index]->service_array = $service_grouped_service_array;

//                         $minimum_price = $service_grouped_services[$index]->minimum_price;
//                         $service_grouped_services[$index]->minimum_price = ($minimum_price < $service_min_price)? $minimum_price: $service_min_price;
//                     } else {
//                         $service_grouped_obj = new stdClass;
//                         $service_grouped_obj->service_provider_company_location_token = $service_value->service_provider_company_location_token;
//                         $service_grouped_obj->service_provider = $service_value->service_provider;
//                         // $service_grouped_obj->sp_company_token = $service_value->sp_company_token;

//                         // $service_grouped_obj->sp_company_name = $service_value->sp_company_name;
//                         // $service_grouped_obj->sp_company_logo = $service_value->sp_company_logo;
//                         // $service_grouped_obj->sp_company_image = $service_value->sp_company_image;
//                         $service_grouped_obj->minimum_price = $service_min_price;
//                         $service_grouped_obj->business_tokens = $service_value->business_tokens;
//                         $service_grouped_obj->business_names = $service_value->business_names;
//                         $service_grouped_obj->business_name = $service_value->business_names[0];
//                         $service_grouped_obj->terms_conditions = $GLOBALS['doc_url'] . "terms.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; //sp_company_token; //$service_value->terms_conditions;
//                         $service_grouped_obj->privacy_policy = $GLOBALS['doc_url'] . "privacy.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; //sp_company_token; //$service_value->privacy_policy;
//                         $service_grouped_obj->cancellation_policy = $GLOBALS['doc_url'] . "cancellation.php?a=" . $station_value->airport_token . "&c=" . $service_value->service_provider->token; //sp_company_token; //$service_value->cancellation_policy;
//                         $service_grouped_obj->reschedule_policy = $service_value->reschedule_policy;
//                         $service_grouped_obj->about_description = $service_value->about_description;
//                         $service_grouped_obj->cancellation_policy_detail = $service_value->cancellation_policy_detail;
//                         $service_grouped_obj->photos = [];
//                         $service_grouped_obj->amenities = [];
//                         $service_grouped_obj->service_array = [$service_value];

//                         array_push($service_grouped_services, $service_grouped_obj);
//                     }
//                 }
//                 unset($service_value);

//                 $collection_value->service_group = $service_grouped_services;
//             }
//         }
//         unset($collection_value);
//     }
//     unset($station_value);  
//     return $station_data;
// }

// // For matching individual services as same template as Bundles
// function matchIndividualWithBundle($station_data) {
//     foreach ($station_data as $station_key => $station_value) {
//         foreach ($station_value->service_collection as $collection_value) {
//             if ($collection_value->service_type == 'Bundle') {
//                 // array_push($matched_array, $collection_value);
//             } else {
//                 foreach ($collection_value->service_group as $service_group_value) {
//                     $collection_value->title = $service_group_value->business_name;

//                     $service_group = [];
//                     foreach ($service_group_value->service_array as $service_value) {
//                         $group_index = -1;
//                         foreach ($service_group as $service_group_key => $service_group_value) {
//                             if ($service_group_value->sp_company_token == $service_value->service_provider->token) { //sp_company_token
//                                 $group_index = $service_group_key;
//                             }
//                         }
//                         unset($service_group_value);

//                         if ($group_index > -1) {
//                             $grouped_service_array = $service_group[$group_index]->service_array;
//                             array_push($grouped_service_array, $service_value);
//                             $service_group[$group_index]->service_array = $grouped_service_array;
//                         } else {
//                             $service_group_obj = new stdClass;
//                             $service_group_obj->sp_company_token = $service_value->service_provider->token; //sp_company_token;
//                             $service_group_obj->sp_company_name = $service_value->service_provider->name; //sp_company_name;
//                             $service_group_obj->sp_company_logo = $service_value->service_provider->logo; //sp_company_logo;
//                             $service_group_obj->sp_company_image = $service_value->service_provider->image; //sp_company_image;
//                             $service_group_obj->business_tokens = $service_value->business_tokens;
//                             $service_group_obj->business_names = $service_value->business_names;
//                             $service_group_obj->minimum_price = ($service_value->price_adult < $service_value->price_children)? $service_value->price_adult: $service_value->price_children;
//                             $service_group_obj->about_description = $service_value->about_description;
//                             $service_group_obj->service_array = [$service_value];
//                             $service_group_obj->service_provider_company_location_token = $service_value->service_provider_company_location_token;

//                             array_push($service_group, $service_group_obj);
//                         }
//                     }
                    
//                     // $matched_obj = new stdClass;
//                     // $matched_obj->service_type = $collection_value->service_type;
//                     // $matched_obj->title = $service_group_value->business_name;
//                     // $matched_obj->service_group = $service_group;

//                     // array_push($matched_array, $matched_obj);
//                 }
//             }
//         }
//         unset($collection_value);

//         // $station_data[$station_key]->service_collection = $matched_array;
//     }
//     unset($station_value);

//     return $station_data;
// }
?>