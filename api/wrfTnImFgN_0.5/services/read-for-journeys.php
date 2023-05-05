<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();
$journey_array = $input_data->journey_array;
$has_specific_service = (isset($input_data->has_specific_service))? $input_data->has_specific_service: false;
$service_token = ($has_specific_service)? $input_data->service_token: 0;
$journey_count = sizeof($journey_array);

include '../objects/airport-ttr.php';
$airport_ttr = new AirportTTR();
include '../objects/airport-category.php';
$airport_category = new AirportCategory();
include '../objects/airport-type.php';
$airport_type = new AirportType();
include '../objects/service-location.php';
$service_location = new ServiceLocation();

$station_array = parseStationFromJourney($airport_ttr, $journey_array, $journey_count);
$station_data = serviceCollectionForStation($station_array, $airport_ttr, $airport_category, $airport_type, $service_location, $journey_count, $has_specific_service, $service_token);

$service_count = 0;
foreach ($station_data as $station_value) {
    foreach ($station_value->service_collection as $service_col_value) {
        $service_count++;
    }
}

if ($service_count > 0) {
    $station_data = partServices($station_data);
    $station_data = groupServices($station_data);

    include '../../../config/gmt.php';

    include '../objects/airport.php';
    $airport = new Airport();

    include '../objects/service-provider-company-location-photos.php';
    $ServiceProviderCompanyPhotos = new ServiceProviderCompanyLocationPhotos();

    include '../objects/service-provider-company-location-amenities.php';
    $ServiceProviderCompanyAmenities = new ServiceProviderCompanyLocationAmenities();

    include '../objects/users-booking-detail.php';
    $users_booking_detail = new UsersBookingDetail();

    foreach ($station_data as $station_key => $station_value) {
        $airport->token = $station_value->airport_token;
        $airport->readOne();
        //$station_value->gmt_view = ($airport->stmt->rowCount() > 0)? $airport->makeView()[0]->gmt: '';
        
        if ($airport->stmt->rowCount() > 0) {
            // $timezone = $airport->makeView()[0]->time_zone;
            // $gmt = getGMT($timezone);
            // $gmt = 'GMT ' . $gmt;
            $gmt = 'GMT ' . $airport->makeView()[0]->gmt;
        } else {
            $gmt = '';
        }
        $station_value->gmt_view = $gmt;

        foreach ($station_value->service_collection as $service_collection_value) {
            foreach ($service_collection_value->service_group as $service_group_value) {
                // echo json_encode($service_group_value);
                $ServiceProviderCompanyPhotos->service_provider_company_location_token = $service_group_value->service_provider_company_location_token;
                $ServiceProviderCompanyPhotos->readForLocation();

                if ($ServiceProviderCompanyPhotos->stmt->rowCount() > 0) {
                    $service_group_value->photos = $ServiceProviderCompanyPhotos->makeView();
                } else {
                    $service_group_value->photos = [];
                }

                $ServiceProviderCompanyAmenities->service_provider_company_location_token = $service_group_value->service_provider_company_location_token;
                $ServiceProviderCompanyAmenities->readForLocation();

                if ($ServiceProviderCompanyAmenities->stmt->rowCount() > 0) {
                    $service_group_value->amenities = $ServiceProviderCompanyAmenities->makeView();
                } else {
                    $service_group_value->amenities = [];
                }

                $users_booking_detail->airport_token = $station_value->airport_token;
                $users_booking_detail->company_token = $service_group_value->sp_company_token;
                $users_booking_detail->readReviews();

                if ($users_booking_detail->stmt->rowCount() > 0) {
                    $service_group_value->reviews = $users_booking_detail->makeReviewView();
                } else {
                    $service_group_value->reviews = [];
                }

                // unset($service_group_value->service_provider_company_location_token);
                foreach ($service_group_value->service_array as $key => $service_value) {
                    // unset($service_value->sp_company_token);
                    // unset($service_value->sp_company_name);
                    unset($service_value->sp_company_logo);
                    unset($service_value->sp_company_image);
                    unset($service_value->description);
                    unset($service_value->terms_conditions);
                    unset($service_value->privacy_policy);
                    unset($service_value->cancellation_policy);
                    unset($service_value->reschedule_policy);
                    unset($service_value->cancellation_policy_detail);
                    // unset($service_value->service_provider_company_location_token);
                }
                unset($service_value);
            }
            unset($service_group_value);
        }
        unset($service_collection_value);
    }
    unset($station_value);

    $data = new stdClass;
    $data->station_array = $station_data;
    // $data->journey_array = $journey_array;

    $obj = new stdClass;
    $obj->status_code = 200;
    $obj->message = "Services list";
    $obj->data = $data;
} else {
    $data = new stdClass;
    $data->service_count = $service_count;

    $obj = new stdClass;
    $obj->status_code = 400;
    $obj->message = "No services found at the time !";
    $obj->data = $data;
}
echo json_encode($obj);

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
            $airport_ttr->departure_date = $journey_value->departure_date;
            $airport_ttr->token = $journey_value->departure_ttr_token;
            $airport_ttr->readOneTerminal();
            $airport_ttr_detail = $airport_ttr->makeView()[0];

            $station_obj = getStationDetail($airport_ttr_detail, "Departure");
            $station_obj->journey_date = $airport_ttr_detail->airport_gmt_date;//$journey_value->departure_date;
            array_push($station_array, $station_obj);
        }

        $airport_ttr->token = $journey_value->arrival_ttr_token;
        $airport_ttr->readOneTerminal();
        $airport_ttr_detail = $airport_ttr->makeView()[0];
        
        if ($journey_key == ($journey_count-1)) {
            $station_obj = getStationDetail($airport_ttr_detail, "Arrival");
            $station_obj->journey_date = $airport_ttr_detail->airport_gmt_date;//$journey_value->departure_date;
            array_push($station_array, $station_obj);
        } else {
            $station_obj = getStationDetail($airport_ttr_detail, "Transit");
            $station_obj->journey_date = $airport_ttr_detail->airport_gmt_date;//$journey_value->departure_date;
            array_push($station_array, $station_obj);
        }
    }
    unset($journey_value);

    return $station_array;
}

// For collecting services for all stations based on airport-type[Domestic & International]
function serviceCollectionForStation($station_array, $airport_ttr, $airport_category, $airport_type, $service_location, $journey_count, $has_specific_service, $service_token) {
    $station_data = [];

    foreach ($station_array as $station_key => $station_value) {
        $res_station_obj = new stdClass;
        $res_station_obj->ttr_token = $station_value->ttr_token;
        $res_station_obj->category_name = $station_value->category_name;
        $res_station_obj->airport_token = $station_value->airport_token;
        $res_station_obj->airport_code = $station_value->airport_code;
        $res_station_obj->airport_name = $station_value->airport_name;
        $res_station_obj->terminal_name = $station_value->terminal_name;
        $res_station_obj->city_name = $station_value->city_name;
        $res_station_obj->journey_date = $station_value->journey_date;
        $res_station_obj->gmt_view = '';
        $res_station_obj->service_collection = [];

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
        
        $airport_category->name = $station_value->category_name;
        $airport_category->searchByName();
        $station_value->category_token = $airport_category->makeView()[0]->token;
        
        $airport_type->name = $station_value->type_name;
        $airport_type->searchByName();
        $station_value->type_token = $airport_type->makeView()[0]->token;
        
        $airport_ttr->airport_token = $station_value->airport_token;
        $airport_ttr->terminal_token = $station_value->terminal_token;
        $airport_ttr->type_token = $station_value->type_token;
        $airport_ttr->category_token = $station_value->category_token;
        $airport_ttr->searchTerminal();

        if ($airport_ttr->stmt->rowCount() > 0) {
            $ttr_token = $airport_ttr->makeView()[0]->ttr_token;
            $res_station_obj->ttr_token = $ttr_token;

            $service_location->airport_ttr_token = $ttr_token;
            if ($has_specific_service) {
                $service_location->business_type_token = $service_token;
                $service_location->searchServicesForTTRTokenAndBusinessToken();
                $filtered_service_array = $service_location->makeView();

                $service_location_tokens = [];
                foreach ($filtered_service_array as $filtered_service_value) {
                    $service_location_token = strval($filtered_service_value->token);
                    array_push($service_location_tokens, $service_location_token);
                }
                unset($filtered_service_value);

                $service_location->tokens = "'" . implode("','", $service_location_tokens) . "'";
                $service_location->searchServicesForTokens();
                if ($service_location->stmt->rowCount() > 0) {
                    $res_station_obj->service_collection = $service_location->makeView();
                }
            } else {
                $service_location->searchServicesForTTRToken();
                if ($service_location->stmt->rowCount() > 0) {
                    $res_station_obj->service_collection = $service_location->makeView();
                }
            }
        }

        array_push($station_data, $res_station_obj);
    }
    unset($station_value);

    return $station_data;
}

// For splitting services (Bundle & Individual)
function partServices($station_data) {
    foreach ($station_data as $station_value) {
        $bundled_services = [];
        $individual_services = [];

        $service_array = $station_value->service_collection;
        foreach ($service_array as $service_key => $service_value) {
            if ($service_value->service_type == 'Bundle') array_push($bundled_services, $service_value);
            else array_push($individual_services, $service_value);
        }
        unset($service_value);

        $grouped_service_array = [];
        if (sizeof($bundled_services) > 0) {
            $grouped_obj = new stdClass;
            $grouped_obj->service_type = 'Bundle';
            $grouped_obj->title = '';
            $grouped_obj->service_group = $bundled_services;
            array_push($grouped_service_array, $grouped_obj);
        }
        if (sizeof($individual_services) > 0) {
            $grouped_obj = new stdClass;
            $grouped_obj->service_type = 'Individual';
            $grouped_obj->title = '';
            $grouped_obj->service_group = $individual_services;
            array_push($grouped_service_array, $grouped_obj);
        }
        $station_value->service_collection = $grouped_service_array;
    }
    unset($station_value);

    return $station_data;
}

// For grouping - 1.Bundle(by company), 2.Individual(by company) #before 2.Individual(by service)#
function groupServices($station_data) {
    foreach ($station_data as $station_value) {
        $res_array = [];
        foreach ($station_value->service_collection as $collection_value) {
            if ($collection_value->service_type == 'Bundle') {
                $company_grouped_services = [];
                $service_array = $collection_value->service_group;
                foreach ($service_array as $service_value) {
                    $service_min_price = ($service_value->price_adult < $service_value->price_children)? $service_value->price_adult: $service_value->price_children;

                    $index = -1;
                    foreach ($company_grouped_services as $key => $company_grouped_value) {
                        if ($company_grouped_value->sp_company_token == $service_value->sp_company_token) {
                            $index = $key;
                        }
                    }
                    unset($company_grouped_value);

                    if ($index > -1) {
                        $company_grouped_service_array = $company_grouped_services[$index]->service_array;
                        array_push($company_grouped_service_array, $service_value);
                        $company_grouped_services[$index]->service_array = $company_grouped_service_array;

                        $minimum_price = $company_grouped_services[$index]->minimum_price;
                        $company_grouped_services[$index]->minimum_price = ($minimum_price < $service_min_price)? $minimum_price: $service_min_price;

                        $business_names = $company_grouped_services[$index]->business_names;
                        foreach ($service_value->business_names as $business_name) {
                            if ( !in_array($business_name, $business_names) ) {
                                array_push($business_names, $business_name);
                            }
                        }
                        $company_grouped_services[$index]->business_names = $business_names;
                    } else {
                        $company_grouped_obj = new stdClass;
                        $company_grouped_obj->sp_company_token = $service_value->sp_company_token;
                        $company_grouped_obj->sp_company_name = $service_value->sp_company_name;
                        $company_grouped_obj->sp_company_logo = $service_value->sp_company_logo;
                        $company_grouped_obj->sp_company_image = $service_value->sp_company_image;
                        $company_grouped_obj->minimum_price = $service_min_price;
                        $company_grouped_obj->business_names = $service_value->business_names;
                        $company_grouped_obj->description = $service_value->description;
                        $company_grouped_obj->terms_conditions = $GLOBALS['doc_url'] . "terms.php?a=" . $station_value->airport_token . "&c=" . $service_value->sp_company_token; //$service_value->terms_conditions;
                        $company_grouped_obj->privacy_policy = $GLOBALS['doc_url'] . "privacy.php?a=" . $station_value->airport_token . "&c=" . $service_value->sp_company_token; //$service_value->privacy_policy;
                        $company_grouped_obj->cancellation_policy = $GLOBALS['doc_url'] . "cancellation.php?a=" . $station_value->airport_token . "&c=" . $service_value->sp_company_token; //$service_value->cancellation_policy;
                        $company_grouped_obj->reschedule_policy = $service_value->reschedule_policy;
                        $company_grouped_obj->cancellation_policy_detail = $service_value->cancellation_policy_detail;
                        $company_grouped_obj->service_array = [$service_value];
                        $company_grouped_obj->service_provider_company_location_token = $service_value->service_provider_company_location_token;

                        array_push($company_grouped_services, $company_grouped_obj);
                    }
                }
                unset($service_value);

                $collection_value->service_group = $company_grouped_services;
                array_push($res_array, $collection_value);
            } else {
                foreach ($collection_value->service_group as $service_group_key => $service_group_value) {
                    $service_value = new stdClass;
                    $service_value->token = $service_group_value->token;
                    $service_value->service_token = $service_group_value->service_token;
                    $service_value->sp_company_token = $service_group_value->sp_company_token;
                    $service_value->sp_company_name = $service_group_value->sp_company_name;
                    $service_value->service_type = $service_group_value->service_type;
                    $service_value->service_name = $service_group_value->service_name;
                    $service_value->price_adult = $service_group_value->price_adult;
                    $service_value->price_children = $service_group_value->price_children;
                    $service_value->additional_price_adult = $service_group_value->additional_price_adult;
                    $service_value->additional_price_children = $service_group_value->additional_price_children;
                    $service_value->business_names = $service_group_value->business_names;
                    $service_value->business_token = $service_group_value->business_token;
                    $service_value->unique_business_token = $service_group_value->unique_business_token;
                    $service_value->service_features = $service_group_value->service_features;
                    $service_value->reschedule_policy = $service_group_value->reschedule_policy;
                    $service_value->cancellation_policy_detail = $service_group_value->cancellation_policy_detail;

                    $company_grouped_obj = new stdClass;
                    $company_grouped_obj->sp_company_token = $service_group_value->sp_company_token;
                    $company_grouped_obj->sp_company_name = $service_group_value->sp_company_name;
                    $company_grouped_obj->sp_company_logo = $service_group_value->sp_company_logo;
                    $company_grouped_obj->sp_company_image = $service_group_value->sp_company_image;
                    $company_grouped_obj->minimum_price = ($service_group_value->price_adult < $service_group_value->price_children)? $service_group_value->price_adult: $service_group_value->price_children;
                    $company_grouped_obj->business_names = $service_group_value->business_names;
                    $company_grouped_obj->description = $service_group_value->description;
                    $company_grouped_obj->terms_conditions = $GLOBALS['doc_url'] . "terms.php?a=" . $station_value->airport_token . "&c=" . $service_group_value->sp_company_token; //$service_value->terms_conditions;
                    $company_grouped_obj->privacy_policy = $GLOBALS['doc_url'] . "privacy.php?a=" . $station_value->airport_token . "&c=" . $service_group_value->sp_company_token; //$service_value->privacy_policy;
                    $company_grouped_obj->cancellation_policy = $GLOBALS['doc_url'] . "cancellation.php?a=" . $station_value->airport_token . "&c=" . $service_group_value->sp_company_token; //$service_value->cancellation_policy;
                    $company_grouped_obj->reschedule_policy = $service_group_value->reschedule_policy;
                    $company_grouped_obj->cancellation_policy_detail = $service_group_value->cancellation_policy_detail;
                    $company_grouped_obj->service_array = [$service_value];
                    $company_grouped_obj->service_provider_company_location_token = $service_group_value->service_provider_company_location_token;

                    $res_index = -1;
                    $group_index = -1;
                    foreach ($res_array as $res_key => $res_value) {
                        if ($res_value->service_type == 'Individual') {
                            if ($res_value->title == $service_group_value->business_names[0]) {
                                $res_index = $res_key;
                                
                                foreach ($res_array[$res_key]->service_group as $group_key => $group_value) {
                                    if ($group_value->sp_company_token == $service_group_value->sp_company_token) {
                                        $group_index = $group_key;
                                    }
                                }
                                unset($group_value);
                            }
                        }
                    }
                    unset($res_value);

                    if ($res_index > -1) {
                        if ($group_index > -1) {
                            $temp_service_array = $res_array[$res_index]->service_group[$group_index]->service_array;
                            array_push($temp_service_array, $service_value);
                            $res_array[$res_index]->service_group[$group_index]->service_array = $temp_service_array;
                        } else {
                            $temp_group_array = $res_array[$res_index]->service_group;
                            array_push($temp_group_array, $company_grouped_obj);
                            $res_array[$res_index]->service_group = $temp_group_array;
                        }
                    } else {
                        $res_obj = new stdClass;
                        $res_obj->service_type = 'Individual';
                        $res_obj->title = $service_group_value->business_names[0];
                        $res_obj->service_group = [$company_grouped_obj];

                        array_push($res_array, $res_obj);
                    }
                }
                unset($service_group_value);
            }
        }
        unset($collection_value);

        $station_value->service_collection = $res_array;
    }
    unset($station_value);

    return $station_data;
}
?>