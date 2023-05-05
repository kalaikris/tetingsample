<?php
// ini_set('display_errors', 1); // show error reporting
// error_reporting(E_ALL);

function fetchOrderDetail($users_booking_token, $users_booking, $users_booking_detail, $users_booking_passenger, $users_booking_journey, $airport) {
    $users_booking->token = $users_booking_token;
    $users_booking->readForToken();

    $obj = new stdClass;
    if ($users_booking->stmt->rowCount() > 0) {
        $users_booking_value = $users_booking->makeView()[0];
        $booking_token = $users_booking_value->id;

        $station_array = [];
        $passenger_detail = [];
        $journey_detail = [];

        $users_booking_journey->booking_token = $booking_token;
        $users_booking_journey->readForBooking();
        if ($users_booking_journey->stmt->rowCount() > 0) {
            $journey_detail = $users_booking_journey->makeView();
        }

        $users_booking_detail->booking_token = $booking_token;
        $users_booking_detail->readForBooking();
        if ($users_booking_detail->stmt->rowCount() > 0) {
            $users_booking_detail_array = $users_booking_detail->makeView();
            $users_booking_detail_array = splitBookingDetail($users_booking_detail_array);

            $station_array = $users_booking_detail_array;
        }
        foreach ($station_array as $station_value) {
            $order_airport_code = $station_value->airport_code;
            $index = -1;
            foreach ($journey_detail as $journey_key => $journey_value) {
                if ($order_airport_code == $journey_value->depart_airport_code) {
                    $index = $journey_key;
                }
            }
            unset($journey_value);

            if ($index == -1) {
                if ($journey_detail[sizeof($journey_detail) - 1]->arrival_airport_code == $order_airport_code) {
                    $station_value->airport_type = "Arrival";
                    // $station_value->flight_number = $journey_detail[sizeof($journey_detail) - 1]->flight_number;
                } else {
                    $station_value->airport_type = "";
                    // $station_value->flight_number = "-";
                }
            } else if ($index == 0) {
                $station_value->airport_type = "Departure";
                // $station_value->flight_number = $journey_detail[0]->flight_number;
            } else {
                $station_value->airport_type = "Transit";
                // $station_value->flight_number = $journey_detail[$index - 1]->flight_number . "," . $journey_detail[$index]->flight_number;
            }
        }
        unset($order_value);

        $users_booking_passenger->booking_token = $booking_token;
        $users_booking_passenger->getPassengerForBooking();
        if ($users_booking_passenger->stmt->rowCount() > 0) {
            $passenger_detail = $users_booking_passenger->makeView();
            foreach ($passenger_detail as $passenger_key => $passenger_value) {
                if ($passenger_value->date_of_birth > '1970-01-01') {
                    $passenger_value->age = getTimeDifference($passenger_value->date_of_birth);
                } else {
                    $passenger_value->age = "-";
                }
            }
            unset($passenger_value);

            $passenger_detail = splitPassengers($passenger_detail);
        }
    
        foreach ($station_array as $station_value) {
            $airport->airport_code = $station_value->airport_code;
            $airport->readOneByCode();
            $station_value->gmt_view = ($airport->stmt->rowCount() > 0)? $airport->makeView()[0]->gmt: '';
            
            // if ($airport->stmt->rowCount() > 0) {
            //     $timezone = $airport->makeView()[0]->time_zone;
            //     $gmt = getGMT($timezone);
            //     $gmt = 'GMT ' . $gmt;
            // } else {
            //     $gmt = '';
            // }
            // $station_value->gmt_view = $gmt;
        }
        unset($station_value);

        $users_booking_value->station_array = $station_array;
        $users_booking_value->passenger_detail = $passenger_detail;
        $users_booking_value->journey_array = $journey_detail;
        
        $obj->status_code = 200;
        $obj->message = "Orders listed successfully !";
        $obj->data = $users_booking_value;
    } else {
        $obj->status_code = 400;
        $obj->message = "No orders found !";
        $obj->data = new stdClass;
    }
    return json_encode($obj);
}

function splitBookingDetail($users_booking_detail_array) {
    $grouped_array = [];
    foreach ($users_booking_detail_array as $users_booking_detail_value) {
        $booking_detail_obj = new stdClass;
        $booking_detail_obj->user_token = $users_booking_detail_value->user_token;
        // $booking_detail_obj->id = $users_booking_detail_value->id;
        $booking_detail_obj->order_id = $users_booking_detail_value->id;
        // $booking_detail_obj->booking_token = $users_booking_detail_value->booking_token;
        // $booking_detail_obj->service_detail = $users_booking_detail_value->service_detail;
        $booking_detail_obj->service_date_time = $users_booking_detail_value->service_date_time;
        $booking_detail_obj->service_name = $users_booking_detail_value->service_name;
        $booking_detail_obj->service_type = $users_booking_detail_value->service_type;
        $booking_detail_obj->service_provider = $users_booking_detail_value->service_provider;
        $booking_detail_obj->price_detail = $users_booking_detail_value->price_detail;
        $booking_detail_obj->status = $users_booking_detail_value->status;
        $booking_detail_obj->notes = $users_booking_detail_value->notes;
        $booking_detail_obj->company_token = $users_booking_detail_value->company_token;
        $booking_detail_obj->airport_token = $users_booking_detail_value->airport_token;
        $booking_detail_obj->markup_amount = $users_booking_detail_value->markup_amount;
        // // $booking_detail_obj->company_name = $users_booking_detail_value->company_name;
        // // $booking_detail_obj->company_email = $users_booking_detail_value->company_email;
        // // $booking_detail_obj->company_logo = $users_booking_detail_value->company_logo;
        // // $booking_detail_obj->company_image = $users_booking_detail_value->company_image;
        $booking_detail_obj->service_date_time_raw = $users_booking_detail_value->service_date_time_raw;
        // // $booking_detail_obj->service_token = $users_booking_detail_value->service_token;
        // // $booking_detail_obj->service_location_token = $users_booking_detail_value->service_location_token;
        // $booking_detail_obj->journey_date = $users_booking_detail_value->journey_date;
        // $booking_detail_obj->date_time = $users_booking_detail_value->date_time;
        // $booking_detail_obj->flight_number = $users_booking_detail_value->flight_number;
        // $booking_detail_obj->adult_service_amount = $users_booking_detail_value->adult_service_amount;
        // $booking_detail_obj->total_adult = $users_booking_detail_value->total_adult;
        // $booking_detail_obj->children_service_amount = $users_booking_detail_value->children_service_amount;
        // $booking_detail_obj->total_children = $users_booking_detail_value->total_children;
        $booking_detail_obj->net_amount = $users_booking_detail_value->net_amount;
        // $booking_detail_obj->rating = $users_booking_detail_value->rating;
        // $booking_detail_obj->review = $users_booking_detail_value->review;
        // $booking_detail_obj->description = $users_booking_detail_value->description;
        // $booking_detail_obj->report_reason_token = $users_booking_detail_value->report_reason_token;
        // $booking_detail_obj->report_reason = $users_booking_detail_value->report_reason;
        // $booking_detail_obj->report_description = $users_booking_detail_value->report_description;
        // $booking_detail_obj->reported_date_time = $users_booking_detail_value->reported_date_time;
        $booking_detail_obj->cancellation_policy_detail = $users_booking_detail_value->cancellation_policy_detail;

        $airport_code = $users_booking_detail_value->airport_code;

        $index = -1;
        foreach ($grouped_array as $grouped_key => $grouped_value) {
            if ($grouped_value->airport_code == $airport_code) {
                $index = $grouped_key;
            }
        }
        unset($grouped_value);
        
        if ($index > -1) {
            $service_array = $grouped_array[$index]->service_array;
            array_push($service_array, $booking_detail_obj);
            $grouped_array[$index]->service_array = $service_array;
        } else {
            $station_detail_obj = new stdClass;
            // $station_detail_obj->station_detail = $users_booking_detail_value->station_detail;
            // // $station_detail_obj->airport_token = $airport_token;
            // $station_detail_obj->gmt_view = '';
            $station_detail_obj->airport_category = $users_booking_detail_value->airport_category;
            $station_detail_obj->airport_type = $users_booking_detail_value->airport_type;
            $station_detail_obj->airport_name = $users_booking_detail_value->airport_name;
            $station_detail_obj->airport_code = $users_booking_detail_value->airport_code;
            $station_detail_obj->terminal_token = $users_booking_detail_value->terminal_token;
            $station_detail_obj->terminal_name = $users_booking_detail_value->terminal_name;
            // $station_detail_obj->flight_number = "";
            $station_detail_obj->gmt_view = "";
            $station_detail_obj->station_number = $users_booking_detail_value->station_number;
            $station_detail_obj->service_array = [$booking_detail_obj];
            
            array_push($grouped_array, $station_detail_obj);
        }
    }

    return $grouped_array;
}

function splitPassengers($passenger_detail) {
    $grouped_array = [];

    foreach ($passenger_detail as $passenger_value) {
        $index = -1;
        foreach ($grouped_array as $grouped_key => $grouped_value) {
            if ($grouped_value->passenger_type == $passenger_value->passenger_type) {
                $index = $grouped_key;
            }
        }
        unset($grouped_value);

        if ($index > -1) {
            $passenger_array = $grouped_array[$index]->passenger_array;
            array_push($passenger_array, $passenger_value);
            $grouped_array[$index]->passenger_array = $passenger_array;
        } else {
            $grouped_obj = new stdClass;
            $grouped_obj->passenger_type = $passenger_value->passenger_type;
            $grouped_obj->passenger_array = [$passenger_value];
            array_push($grouped_array, $grouped_obj);
        }
    }
    unset($passenger_value);

    return $grouped_array;
}
?>