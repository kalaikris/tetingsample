<?php
class MailTemplateOrder {
    // object properties
    public $mail_obj;
    
    public function genMailContentForAdminAndUser() {
        $distributor_logo = ($this->mail_obj->header_logo != '')? $this->mail_obj->header_logo: 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = ($this->mail_obj->brand_colour != '')? $this->mail_obj->brand_colour: '#07B4D3';
        $passenger_array = [];
        if ($this->mail_obj->total_adult > 0) {
            $adult_view = ($this->mail_obj->total_adult > 1)? $this->mail_obj->total_adult . " Adults": "1 Adult";
            array_push($passenger_array, $adult_view);
        }
        if ($this->mail_obj->total_children > 0) {
            $child_view = ($this->mail_obj->total_children > 1)? $this->mail_obj->total_children . " Children": "1 Child";
            array_push($passenger_array, $child_view);
        }

        $departure_dates = [];
        foreach ($this->mail_obj->journey_detail as $journey_key => $journey_value) {
            if (!in_array($journey_value->depart_date, $departure_dates)) {
                array_push($departure_dates, $journey_value->depart_date);
            }
        }
        unset($journey_value);
        $journey_period = '';
        if (sizeof($departure_dates)) {
            if (sizeof($departure_dates) == 1) {
                $journey_period = $departure_dates[0];
            } elseif (sizeof($departure_dates) == 2) {
                $journey_period = implode(", ", $departure_dates);
            } else {
                $journey_period = "From " . $departure_dates[0] . " to " . $departure_dates[sizeof($departure_dates) - 1];
            }
        }

        $contact_passenger = new stdClass;
        $other_passenger_array = [];
        $greet_passenger_array = [];
        foreach ($this->mail_obj->passenger_detail as $passenger_value) {
            switch ($passenger_value->passenger_type) {
                case 'Contact':
                    $contact_passenger = $passenger_value->passenger_array[0];
                    // array_push($passenger_array, "1 Contact");
                    break;
                
                case 'Others':
                    $other_passenger_array = $passenger_value->passenger_array;
                    // array_push($passenger_array, sizeof($passenger_value->passenger_array) . " Other");
                    break;
                
                case 'Greeter':
                    $greet_passenger_array = $passenger_value->passenger_array;
                    break;
            }
        }
        unset($passenger_value);

        $mail_template = '<body>
                <table style="width:100%;max-width:800px;margin:auto;box-shadow: 1px 1px 20px 2px #00000029;border-radius: 12px;overflow: hidden;">
                    <thead>
                        <tr>
                            <th>
                                <table style="width:100%;" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td style="">
                                            <div style="margin:0px auto;padding:20px 40px;background-color:' . $brand_color . ';"> 
                                                <table cellspacing="0" style="width:100%;background-color: #ffff;border-radius:12px;padding:16px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align:center;" colspan="4">
                                                                <img src="' . $distributor_logo . '" alt="logo" style="width: 144px;margin-bottom: 10px;">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;" colspan="4">
                                                                <p style="display:block;font-size:26px;line-height:30px;font-family: sans-serif;font-weight: 700;color: #242424;padding-bottom: 5px;margin:5px 0;">' . $this->mail_obj->journey . '</p>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;">' . $journey_period . '</span>
                                                            </td>
                                                        </tr>
                                                
                                                        <tr>
                                                            <td colspan="4">
                                                              <div style="text-align:center;border-bottom: 1px solid #f2f2f2;margin: 30px 0px;height:16px;">
                                                                <img src="https://airportzostage.in/invoince-template/flight-icon.png" alt="flight icon" style="width: 38px;">
                                                              </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="">
                                                                <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</p>
                                                                <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">' . $this->mail_obj->booking_number . '</p>
                                                            </td>
                                                            <td>
                                                                <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking Date</p>
                                                                <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">' . $this->mail_obj->date_time . '</p>
                                                            </td>
                                                            <td>
                                                                <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Passengers</p>
                                                                <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">' . implode("+ ", $passenger_array) . '</p>
                                                            </td>
                                                            <td>
                                                                <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Total Services</p>
                                                                <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">' . $this->mail_obj->total_service . '</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 20px;line-height: 24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: 700;">Services booked</span>
                                        </td>
                                    </tr>';
                $sub_total_amt = '<span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding: 4px 30px 16px;font-weight: 700;">Total Amount Paid : ' . $this->mail_obj->total_amount .'</span>';
                foreach ($this->mail_obj->order_detail as $station_value) {
                    $service_view_array = [];
                    foreach ($station_value->order_detail_array as $order_detail_value) {
                        $service_passenger_array = [];
                        if ($order_detail_value->total_adult > 0) {
                            $adult_view = ($order_detail_value->total_adult > 1)? $order_detail_value->total_adult . " Adults": "1 Adult";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_adult . " Adults");
                        }
                        if ($order_detail_value->total_children > 0) {
                            $adult_view = ($order_detail_value->total_children > 1)? $order_detail_value->total_children . " Children": "1 Child";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_children . " Children");
                        }

                        $cancellation_view = [];
                        $cancellation_count = sizeof($order_detail_value->cancellation_policy_detail);
                        $cancel_policy_array = $order_detail_value->cancellation_policy_detail;
                        $min_hr = 0;
                        foreach ($cancel_policy_array as $cp_value) {
                            if ($cp_value->percentage == 0) {
                                $cp_value->refund = "Full";
                            } else if ($cp_value->percentage == 100) {
                                $cp_value->refund = "No";
                            } else {
                                $cp_value->refund = (100 - (int) $cp_value->percentage) . "%";
                            }
                            $cp_value->is_before = true;
                            if ($min_hr == 0 || $min_hr > $cp_value->hours) {
                                $min_hr = $cp_value->hours;
                            }
                        } unset($cp_value);
                        if ($min_hr > 0) {
                            $cancel_obj = new stdClass;
                            $cancel_obj->hours = $min_hr;
                            $cancel_obj->percentage = 100;
                            $cancel_obj->refund = "No";
                            $cancel_obj->is_before = false;
                            array_push($cancel_policy_array, $cancel_obj);
                        }
                        foreach ($cancel_policy_array as $cp_key => $cp_value) {
                            if ($cp_key % 2 == 0) {
                                $temp_td_arr = [];
                                $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                if ($cp_key < $cancellation_count) {
                                    $cp_value = $cancel_policy_array[$cp_key + 1];

                                    $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                    array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                }
                                $tr = '<tr>' . implode("", $temp_td_arr) . '</tr>';
                                array_push($cancellation_view, $tr);
                            }
                            // if ($cp_key % 2 == 0) {
                            //     $temp_td_arr = [];
                            //     $refund = "";
                            //     if ($cp_value->percentage >= 100) {
                            //         $refund = "No";
                            //     } else if ($cp_value->percentage == 0) {
                            //         $refund = "Full";
                            //     } else {
                            //         $refund = (100 - (int) $cp_value->percentage) . "%";
                            //     }
                            //     array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family: \'Rubik\',sans-serif;">' . $cp_value->hours . ' hours before - ' . $refund . ' Refund</li></ul></td>');
                            //     if ($cp_key < $cancellation_count) {
                            //         $cp_value = $cancel_policy_array[$cp_key + 1];

                            //         $refund = "";
                            //         if ($cp_value->percentage >= 100) {
                            //             $refund = "No";
                            //         } else if ($cp_value->percentage == 0) {
                            //             $refund = "Full";
                            //         } else {
                            //             $refund = (100 - (int) $cp_value->percentage) . "%";
                            //         }
                            //         array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family: \'Rubik\',sans-serif;">' . $cp_value->hours . ' hours before - ' . $refund . ' Refund</li></ul></td>');
                            //     }
                            //     $tr = '<tr>' . implode("", $temp_td_arr) . '</tr>';
                            //     array_push($cancellation_view, $tr);
                            // }
                        } unset($cp_value);

                        $service_footer = "";
                        if (sizeof($cancellation_view) > 0) {
                            $service_footer .= '<div style="margin-bottom: 16px;">
                                                        <p style="display: flex;">
                                                            <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Cancellation Policy</span>    
                                                        </p>
                                                        <table style="width:100%;table-layout: fixed;" cellspacing="0" cellpadding="0">
                                                            <tbody><tr>' . implode("", $cancellation_view) . '</tr></tbody>
                                                        </table>
                                                </div>';
                        }
                        if (property_exists($order_detail_value, 'reschedule_policy')) {
                            if ($order_detail_value->reschedule_policy != '') {
                                $service_footer .= '<div style="">
                                                        <p style="display: flex;">
                                                            <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Reschedule Policy</span>    
                                                        </p>
                                                        <p style="color:#4b4b4b;font-size: 14px;font-family: "Rubik",sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">' . $order_detail_value->reschedule_policy . '
                                                        </p>
                                                    </div>';
                            }
                        }
                        // if ($service_footer != '') {
                        //     $service_footer = '<div style="margin-top: 12px;border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">' . $service_footer . '</div>';
                        // }

                        $company_logo = ($order_detail_value->company_logo != '')? $order_detail_value->company_logo: "https://airportzostage.in/invoince-template/product-logo.png";
                        $cal_dis_amt =  (float) (($order_detail_value->adult_discount + $order_detail_value->child_discount + $order_detail_value->add_adult_discount + $order_detail_value->add_child_discount) * (float) $this->mail_obj->currency_value);
                        $discount_amount = '<span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">Discount Amount : ' . ($cal_dis_amt) .'</span>';
                        array_push($service_view_array, '<table cellspacing="0" style="padding-top: 30px;width: 100%;">
                                                            <tr>
                                                                <td style="width:55px;">
                                                                    <div style="margin-bottom:12px;margin-right:12px;">
                                                                          <img src="' . $company_logo . '" alt="" style="width: 55px;" width="55">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="margin-bottom:12px;">
                                                                        <p style="font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;margin:0 0 5px;font-weight: 700;">' . $order_detail_value->company_name . '</p>
                                                                        <p style="font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;margin:0 0 5px;">Order ID : ' . $order_detail_value->token . '</p>
                                                                        <span style="display:flex">
                                                                            <span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">' . $order_detail_value->service_name . ' | ' . implode(" & ", $service_passenger_array) . '</span>
                                                                            <span style="display:block;font-size:22px;line-height:24px;font-family:sans-serif;color:#242424;text-align:left;margin-left:auto">' . $order_detail_value->currency . ' ' . $order_detail_value->net_amount . '</span>
                                                                        </span>
                                                                        <span>' . $discount_amount . '</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="background-color: #f6f6f6;border-radius: 8px;border:1px solid #eaeaea;padding:12px;margin:12px 0 0;">
                                                                    <div style="padding: 16px;box-sizing: border-box;">
                                                                    ' . $service_footer . '
                                                                    </div></td></tr></table>');
                    }
                    unset($order_detail_value);

                    $gmt_view = "";
                    if (property_exists($station_value, 'gmt_view')) {
                        if ($station_value->gmt_view != '') {
                            $gmt_view = ' (GMT ' . $station_value->gmt_view . ')';
                        }
                    }
                    $mail_template .= '<tr>
                                        <td>
                                            <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;margin-bottom: 15px;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <p style="font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;margin:5px 0;">' . $station_value->airport_code . '</p>
                                                                <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;margin:5px 0;">' . $station_value->airport_name . ' - ' . $station_value->terminal_name . '</p>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view . '</span>
                                                            </span>
                                                            ' . implode('<hr style="border-top: 1px solid #f2f2f2;">', $service_view_array) . '
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>';
                }
                unset($station_value);
            $mail_template .= '</table>
                            ' . $sub_total_amt . '
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Contact Passenger details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 20px;">
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $contact_passenger->name_view . '</span>
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $contact_passenger->mobile_view . ' | ' . $contact_passenger->email_id . '</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';
                if (sizeof($other_passenger_array)) {
                    $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Other Passenger details</span>
                                            </td>
                                        </tr>';
                }
                foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                    $mail_template .= '<tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">' . ($other_passenger_key + 1) . ')</span>
                                                    <span>    
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $other_passenger_value->name_view . '</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $other_passenger_value->mobile_view . ' | ' . $other_passenger_value->email_id . '</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>';
                } unset($other_passenger_value);
                if (sizeof($other_passenger_array)) {
                $mail_template .= '</tbody>
                                </table>
                            </td>
                        </tr>';
                }
                
                if (sizeof($greet_passenger_array)) {
                    $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Greeter details</span>
                                            </td>
                                        </tr>';
                }
                foreach ($greet_passenger_array as $greet_passenger_key => $greet_passenger_value) {
                    $mail_template .= '<tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">' . ($greet_passenger_key + 1) . ')</span>
                                                    <span>
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $greet_passenger_value->name_view . '</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $greet_passenger_value->mobile_view . ' | ' . $greet_passenger_value->email_id . '</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>';
                } unset($greet_passenger_value);
                if (sizeof($greet_passenger_array)) {
                $mail_template .= '</tbody>
                                </table>
                            </td>
                        </tr>';
                }
                // <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(Age : ' . $greet_passenger_value->age . ')</span>

                $mail_template .= '<tr>
                            <td>
                                <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Flight Details</span>
                                            </td>
                                        </tr>';
                foreach ($this->mail_obj->journey_detail as $journey_key => $journey_value) {
                    if ($journey_key%2 == 0) {
                        $flight_number = ($journey_value->flight_number != '')? $journey_value->flight_number: '-'; // . '[' . $journey_value->depart_date . ']'
                        $mail_template .= '<tr>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $journey_value->depart_airport_code . ' Flight Number</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $flight_number . '</span>
                                            </td>';
                        if ($journey_key < sizeof($this->mail_obj->journey_detail)-1) {
                            $flight_number = ($this->mail_obj->journey_detail[$journey_key + 1]->flight_number != '')? $this->mail_obj->journey_detail[$journey_key + 1]->flight_number: '-'; // . '[' . $this->mail_obj->journey_detail[$journey_key + 1]->depart_date . ']'
                            $mail_template .= '<td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $this->mail_obj->journey_detail[$journey_key + 1]->depart_airport_code . ' Flight Number</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $flight_number . '</span>
                                            </td>';
                        }
                        $mail_template .= '</tr>';
                    }
                } unset($journey_value);
                    
                $mail_template .= '</tbody>
                                </table>
                            </td>
                        </tr>';
            if ($this->mail_obj->gst_name != '' || $this->mail_obj->gst_number != '') {
                $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">GST Details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-bottom: 10px;">
                                                <p style="color:#8f8b8b;font-size:16px;font-family: sans-serif;margin:0 0 7px;">Company Name</p>
                                                <span style="display:block;font-size: 22px;line-height: 20px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;">' . $this->mail_obj->gst_name . '</span>
                                            </td>
                                            <td>
                                                <p style="color:#8f8b8b;font-size:16px;font-family: sans-serif;margin:0 0 7px;">GSTIN Number</p>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $this->mail_obj->gst_number . '</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';
            }
            if ($this->mail_obj->description_one != '' || $this->mail_obj->description_two != '') {
                    $mail_template .= '<tr>
                    <td>
                        <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                    </td>
                </tr>';
                if ($this->mail_obj->description_one != '') {
                    $mail_template .= '<tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Notes : </span>
                                            <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $this->mail_obj->description_one . '</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>';  
                }
                if ($this->mail_obj->description_two != '') {
                    $mail_template .= '<tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Flower and Bouquet details</span>
                                            <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $this->mail_obj->description_two . '</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>';  
                }
            }
            $mail_template .= '</tbody>';
            if ($this->mail_obj->need_footer == true) {
                // <tr>
                //             <td>
                //                 <table style="width: 100%;background-color:#fbfbfb;padding: 20px 30px;">
                //                     <tbody>
                //                         <tr>
                //                             <td>
                //                                 <span style="display: flex;">
                //                                     <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                //                                     <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Cancellation Policy</span>    
                //                                 </span>
                //                                 <ul style="padding-left: 20px;width: 50%;">
                //                                     <li style="padding-bottom: 5px;">
                //                                         <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                //                                             <span style="width: 180px;">48 hours before</span>                                                    
                //                                             <span style="width:40px;text-align:left">-</span>                                                    
                //                                             <span>Full Refund</span>
                //                                         </span>
                //                                     </li>
                //                                     <li style="padding-bottom: 5px;">
                //                                         <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                //                                             <span style="width: 180px;">24 hours before</span>                                                    
                //                                             <span style="width:40px;text-align:left">-</span>                                                    
                //                                             <span>25% of fare</span>
                //                                         </span>
                //                                     </li>
                //                                     <li style="padding-bottom: 5px;">
                //                                         <span style="display:flex;justify-content: flex-start;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                //                                             <span style="width: 180px;">After 12hours</span>                                                    
                //                                             <span style="width:40px;text-align:left">-</span>                                                    
                //                                             <span>No Refund</span>
                //                                         </span>
                //                                     </li>
                //                                 </ul>
                //                             </td>
                //                         </tr>
                //                         <tr>
                //                             <td>
                //                                 <span style="display: flex;">
                //                                     <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                //                                     <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Reschedule Policy</span>    
                //                                 </span>
                //                                 <ul style="padding-left: 20px;width: 100%;list-style-type: none;">
                //                                     <li>
                //                                         <span style="justify-content: flex-start;font-size:22px;line-height:35px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">
                //                                             If you wish to reschedule any of the booked service, please contact +91 8610725198 or write us to support@airportzo.com
                //                                         </span>
                //                                     </li>
                //                                 </ul>
                //                             </td>
                //                         </tr>
                //                     </tbody>
                //                 </table>
                //             </td>
                //         </tr>
                //         <tr>
                //             <td>
                //                 <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                //             </td>
                //         </tr>
                $mail_template .= '<tfoot>
                        <tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px 0px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">Customer Support</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                           <img src="https://airportzostage.in/invoince-template/mail.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                           <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Mail Us</p>
                                                            <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;margin:0;"><a href="mainto:support@airportzo.com" style="color: #0091ff;text-decoration: none;">support@airportzo.com</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                           <img src="https://airportzostage.in/invoince-template/phone.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                           <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Call Us(Toll free)</p>
                                                           <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin:0;">+91 8610725198</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                            <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                            <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Whatsapp</p>
                                                            <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin:0;">+91 8610725198</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tfoot>';
            }
        $mail_template .= '</table>
        </body>';
        return $mail_template;
    }

    public function genMailContentForServiceProvider() {
        $this->mail_obj;
        $passenger_array = [];
        if ($this->mail_obj->total_adult > 0) {
            $adult_view = ($this->mail_obj->total_adult > 1)? $this->mail_obj->total_adult . " Adults": "1 Adult";
            array_push($passenger_array, $adult_view);
        }
        if ($this->mail_obj->total_children > 0) {
            $child_view = ($this->mail_obj->total_children > 1)? $this->mail_obj->total_children . " Children": "1 Child";
            array_push($passenger_array, $child_view);
        }

        $contact_passenger = new stdClass;
        $other_passenger_array = [];
        $greet_passenger_array = [];
        foreach ($this->mail_obj->passenger_detail as $passenger_value) {
            switch ($passenger_value->passenger_type) {
                case 'Contact':
                    $contact_passenger = $passenger_value->passenger_array[0];
                    // array_push($passenger_array, "1 Contact");
                    break;
                
                case 'Others':
                    $other_passenger_array = $passenger_value->passenger_array;
                    // array_push($passenger_array, sizeof($passenger_value->passenger_array) . " Other");
                    break;
                
                case 'Greeter':
                    $greet_passenger_array = $passenger_value->passenger_array;
                    break;
            }
        }
        unset($passenger_value);

        $mail_template = '<table style="width:800px;margin:auto;box-shadow: 1px 1px 20px 2px #00000029;border-radius: 12px;overflow: hidden;background: #fbfbfb;">
                <thead>
                    <tr>
                        <th>
                            <img src="https://airportzostage.in/invoince-template/airportzo-logo.png" alt="logo" style="width:308px;margin: 20px auto;">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <table style="width: 90%;margin: auto;padding: 30px 0px 0px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;margin-bottom:10px">Order ID : ' . $this->mail_obj->booking_number . '</p>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;margin-bottom:10px">Booked on : ' . $this->mail_obj->date_time . '</p>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: normal;margin:0;margin-bottom:10px">Passengers : ' . implode(" & ", $passenger_array) . '</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>';
        foreach ($this->mail_obj->order_detail as $order_value) {
            $mail_template .= '<tr>
                        <th>
                            <table style="width: 90%;background-color: #ffff;border-radius: 14px;margin: 20px auto 30px;padding:20px;border: 1px solid #eae2e2;">
                                <tbody>
                                    <tr>
                                        <td style="padding-bottom:12px;">
                                        	<table cellspacing="0" cellpadding="0">
                                                <tr>
                                                   <td>
                                                       <img src="https://airportzostage.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;">
                                                   </td>
                                                   <td>
                                                       <p style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;">Airport Name</p>
                                                       <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">' . $order_value->airport_name . '</p>
                                                   </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="padding-bottom:12px;">
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                   <td>
                                                       <img src="https://airportzostage.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;">
                                                   </td>
                                                   <td>
                                                       <p style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;">Terminal Name</p>
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">' . $order_value->terminal_name . ' (' . $order_value->airport_type . ')</p>
                                                   </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                   <td>
                                                       <img src="https://airportzostage.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;">
                                                   </td>
                                                   <td>
                                                       <p style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;">' . $order_value->airport_type . ' Flight number</p>
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">' . $order_value->flight_number . '</p>
                                                   </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                   <td>
                                                       <img src="https://airportzostage.in/invoince-template/calender.png" alt="flight" style="margin-right: 5px;">
                                                   </td>
                                                   <td>
                                                       <p style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;">Service Date</p>
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">' . $order_value->order_detail_array[0]->service_date_time . '</p>
                                                   </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table style="width: 100%;background-color:#22c482;">
                                                <tbody>';
                                foreach ($order_value->order_detail_array as $service_value) {
                                    $service_passengers = [];
                                    if ($service_value->total_adult > 0) {
                                        array_push($service_passengers, 'Adult - ' . $service_value->total_adult);
                                    }
                                    if ($service_value->total_children > 0) {
                                        array_push($service_passengers, 'Children - ' . $service_value->total_adult);
                                    }
                                    $servable_persons = (sizeof($service_passengers) > 0)? '(' . implode(" & ", $service_passengers) . ')': '';
                                    $mail_template .= '<tr>
	                                                        <td>
	                                                            <span style="display: flex;align-items:center;justify-content:space-between;width: 90%;margin: 30px auto;">
	                                                                <span style="display:block;font-size: 30px;line-height: 35px;font-family: sans-serif;color: #fff;text-align: left;font-weight: 700;">' . $service_value->service_name . $servable_persons . '</span>
	                                                            </span>
	                                                        </td>
	                                                    </tr>';
                                }
                                unset($service_value);
                                $mail_template .= '</tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>';

                    // <tr>
                    //     <th>
                    //         <table style="width: 90%;margin: auto;padding: 0px 0px 30px;">
                    //             <tbody>
                    //                 <tr>
                    //                     <td>
                    //                         <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">State/UT code  : 786435</span>
                    //                         <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Place of service  : Tamilnadu</span>
                    //                         <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: normal;">Whether tax is payable under reverse charge - No </span>
                    //                     </td>
                    //                 </tr>
                    //             </tbody>
                    //         </table>
                    //     </th>
                    // </tr>
        }
        unset($order_value);
            
        $mail_template .= '</thead>
                <tbody style="background-color: #fff;">
                    <tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px 0px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Contact Passenger details</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="">
                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $contact_passenger->name_view . '</span>
                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $contact_passenger->mobile_view . ' | ' . $contact_passenger->email_id . '</span>
                                       </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>';
                    if (sizeof($other_passenger_array)) {
        $mail_template .= '<tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Other Passenger details</span>
                                        </td>
                                    </tr>';
                        foreach ($other_passenger_array as $other_passenger_value) {
                            $mail_template .= '<tr>
                                        <td>
                                            <span style="display:flex;padding-bottom: 12px;">
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                <span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $other_passenger_value->name_view . '</span>
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $other_passenger_value->mobile_view . ' | ' . $other_passenger_value->email_id . '</span>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>';
                        }
                        unset($other_passenger_value);
            $mail_template .= '</tbody>
                            </table>
                        </td>
                    </tr>';
                    }
                    if (sizeof($greet_passenger_array)) {
        $mail_template .= '<tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Greeter details</span>
                                        </td>
                                    </tr>';
                        foreach ($greet_passenger_array as $greet_passenger_value) {
                            $mail_template .= '<tr>
                                        <td>
                                            <span style="display:flex;padding-bottom: 12px;">
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                <span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $greet_passenger_value->name_view . '</span>
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $greet_passenger_value->mobile_view . ' | ' . $greet_passenger_value->email_id . '</span>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>';
                        }
                        unset($greet_passenger_value);
            $mail_template .= '</tbody>
                            </table>
                        </td>
                    </tr>';
                    }
                    // <span style="display:block;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $greet_passenger_value->age . '</span>
            // $mail_template .= '<tr>
            //             <td>
            //                 <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
            //             </td>
            //         </tr>';
                    // <tr>
                    //     <td>
                    //         <table style="width: 100%;padding: 20px 30px;">
                    //             <tbody>
                    //                 <tr>
                    //                     <td style="padding-bottom: 10px;">
                    //                         <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">E-Ticket</span>
                    //                         <img src="https://airportzostage.in/invoince-template/e-ticket.png" alt="ticket cpy" style="width: 150px;">
                    //                     </td>
                    //                 </tr>
                    //             </tbody>
                    //         </table>
                    //     </td>
                    // </tr>
                if ($this->mail_obj->description_one != '' || $this->mail_obj->description_two != '') {
                        $mail_template .= '<tr>
                        <td>
                            <hr style="border-top: 1px solid #f2f2f2;width: 90%;margin: auto;">
                        </td>
                    </tr>';
                    if ($this->mail_obj->description_one != '') {
                        $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Notes : </span>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $this->mail_obj->description_one . '</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';  
                    }
                    if ($this->mail_obj->description_two != '') {
                        $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Flower and Bouquet details</span>
                                                <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">' . $this->mail_obj->description_two . '</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';  
                    }
                }
            $mail_template .= '</tbody>
                <tfoot>
                    <tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px 0px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">Customer Support</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                           <img src="https://airportzostage.in/invoince-template/mail.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                           <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Mail Us</p>
                                                            <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;margin:0;"><a href="mainto:support@airportzo.com" style="color: #0091ff;text-decoration: none;">support@airportzo.com</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                           <img src="https://airportzostage.in/invoince-template/phone.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                           <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Call Us(Toll free)</p>
                                                           <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin:0;">+91 8610725198</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                  <div style="border-bottom:1px solid #f2f2f2;margin-bottom:15px;">
                                                    <table cellpadding="0" cellspacing="0" style="padding-bottom:16px;">
                                                       <tr>
                                                         <td style="width:50px;padding:0 10px 0 0;">
                                                            <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" style="width: 50px;">
                                                         </td>
                                                         <td>
                                                            <p style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;margin:0;">Whatsapp</p>
                                                            <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin:0;">+91 8610725198</a></p>
                                                         </td>
                                                       </tr>
                                                    </table>
                                                  </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>';
        return $mail_template;
    }

    public function genCancelMailContentForUser() {
        $distributor_logo = ($this->mail_obj->header_logo != '')? $this->mail_obj->header_logo: 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = ($this->mail_obj->brand_colour != '')? $this->mail_obj->brand_colour: '#07B4D3';

        $service_view = '';
        foreach ($this->mail_obj->cancelled_services as $cs_key => $cs_value) {
            $service_view .= '<br><span>' . ($cs_key+1) . '. ' . $cs_value->airport_code . ' ' . $cs_value->terminal_name . ' - ' . $cs_value->airport_type . ' - ' . $cs_value->service_name . ' - ' . $cs_value->service_date . ' ' . $cs_value->service_time . '</span>';
        }
        unset($cs_value);

        return '<body style="margin: 0;font-family: sans-serif;text-align: left;">
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <tbody style="font-size: 18px;line-height: 28px;">
                    <tr>
                        <td>
                            <div style="max-width:600px;margin:0 auto;background-color:#f8f8f8;border-bottom:1px solid #e5e5e5;text-align: center;padding: 24px;box-sizing: border-box;">
                                <img src="' . $distributor_logo . '" alt="logo" style="width: 100%;max-width: 220px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;">
                                <p style="margin: 0 0 12px;">Hello <span style="font-weight: bold;">' . $this->mail_obj->user_name . '</span>,</p>
                                <p style="margin: 0 0 12px;">Description: #' . $this->mail_obj->booking_number . '
                                    ' . $service_view . '
                                </p>
                                <p style="margin: 0 0 12px;">This booking has been cancelled. For refund details please login and refer to your account details.</p>
                                <p style="margin: 0 0 12px;">Thank You</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;background-color:#f8f8f8;border-top:1px solid #e5e5e5;">
                                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/mail.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Mail Us</p>
                                                    <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/phone.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                    <p style="font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                    <p style="font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>';
    }

    public function genCancelMailContentForAdminAndSP() {
        $distributor_logo = ($this->mail_obj->header_logo != '')? $this->mail_obj->header_logo: 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = ($this->mail_obj->brand_colour != '')? $this->mail_obj->brand_colour: '#07B4D3';

        $service_view = '';
        foreach ($this->mail_obj->cancelled_services as $cs_key => $cs_value) {
            $service_view .= '<br><span>' . ($cs_key+1) . '. ' . $cs_value->airport_code . ' ' . $cs_value->terminal_name . ' - ' . $cs_value->airport_type . ' - ' . $cs_value->service_name . ' - ' . $cs_value->service_date . ' ' . $cs_value->service_time . '</span>';
        }
        unset($cs_value);

        return '<body style="margin: 0;font-family: sans-serif;text-align: left;">
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <tbody style="font-size: 18px;line-height: 28px;">
                    <tr>
                        <td>
                            <div style="max-width:600px;margin:0 auto;background-color:#f8f8f8;border-bottom:1px solid #e5e5e5;text-align: center;padding: 24px;box-sizing: border-box;">
                                <img src="' . $distributor_logo . '" alt="logo" style="width: 100%;max-width: 220px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;">
                                <p style="margin: 0 0 12px;">Hello <span style="font-weight: bold;">' . $this->mail_obj->user_name . '</span>,</p>
                                <p style="margin: 0 0 12px;">Description: #' . $this->mail_obj->booking_number . '
                                    ' . $service_view . '
                                </p>
                                <p style="margin: 0 0 12px;">This booking has been cancelled.</p>
                                <p style="margin: 0 0 12px;">Thank You</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="max-width:600px;margin: 0 auto;box-sizing: border-box;padding: 24px;background-color:#f8f8f8;border-top:1px solid #e5e5e5;">
                                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/mail.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Mail Us</p>
                                                    <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;padding-bottom: 24px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/phone.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td style="padding-bottom: 24px;">
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                    <p style="font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="center" style="width: 36px;">
                                                <div style="margin-right: 12px;">
                                                    <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" width="36" style="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <p style="color:#8E8F91;font-size:13px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                    <p style="font-size:16px;font-family: \'Rubik\', sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>';
    }
    
   public function getMailContent(){
      $distributor_logo = ($this->mail_objs->header_logo != '')? $this->mail_objs->header_logo: 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = ($this->mail_objs->brand_colour != '')? $this->mail_objs->brand_colour: '#07B4D3';
        $passenger_array = [];
        if ($this->mail_objs->total_adult > 0) {
            $adult_view = ($this->mail_objs->total_adult > 1)? $this->mail_objs->total_adult . " Adults": "1 Adult";
            array_push($passenger_array, $adult_view);
        }
        if ($this->mail_objs->total_children > 0) {
            $child_view = ($this->mail_objs->total_children > 1)? $this->mail_objs->total_children . " Children": "1 Child";
            array_push($passenger_array, $child_view);
        }

        $departure_dates = [];
        foreach ($this->mail_objs->journey_detail as $journey_key => $journey_value) {
            if (!in_array($journey_value->depart_date, $departure_dates)) {
                array_push($departure_dates, $journey_value->depart_date);
            }
        }
        unset($journey_value);
        $journey_period = '';
        if (sizeof($departure_dates)) {
            if (sizeof($departure_dates) == 1) {
                $journey_period = $departure_dates[0];
            } elseif (sizeof($departure_dates) == 2) {
                $journey_period = implode(", ", $departure_dates);
            } else {
                $journey_period = "From " . $departure_dates[0] . " to " . $departure_dates[sizeof($departure_dates) - 1];
            }
        }

        $contact_passenger = new stdClass;
        $other_passenger_array = [];
        $greet_passenger_array = [];
        foreach ($this->mail_objs->passenger_detail as $passenger_value) {
            switch ($passenger_value->passenger_type) {
                case 'Contact':
                    $contact_passenger = $passenger_value->passenger_array[0];
                    // array_push($passenger_array, "1 Contact");
                    break;
                
                case 'Others':
                    $other_passenger_array = $passenger_value->passenger_array;
                    // array_push($passenger_array, sizeof($passenger_value->passenger_array) . " Other");
                    break;
                
                case 'Greeter':
                    $greet_passenger_array = $passenger_value->passenger_array;
                    break;
            }
        }
        unset($passenger_value);
       $mailHeaderContent = '';
       $mailStatus = '';
         $service_date_array = [];
        foreach ($this->mail_objs->order_detail as $station_value) {
             if(($station_value->airport_token == $this->order_airport_token) || $this->order_airport_token == ''){
                foreach ($station_value->order_detail_array as $order_detail_value) {
                    if(($order_detail_value->token == $this->order_detail_token) || $this->order_detail_token == ''){
                       $service_date = $order_detail_value->service_date;
                        if(!in_array($service_date, $service_date_array)){
                            array_push($service_date_array, $service_date); 
                        }
                    }
                }
             }
         }
       switch($this->mail_status){
           case 'ORDER CANCELLED':
               if($this->mail_for != "service-provider"){
                  $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.150/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you '.$this->mail_objs->passenger_detail[0]->passenger_array[0]->name_view.' has cancelled his service dated '.implode(" ,", $service_date_array).'.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-861-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }
                   $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">ORDER CANCELLED</span>';
                   $mailService = 'Order Cancelled';
            break;
           case 'BOOKING CANCELLED': 
               if($this->mail_for != "service-provider"){
                    $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.150/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you '.$this->mail_objs->passenger_detail[0]->passenger_array[0]->name_view.' has cancelled his service dated '.implode(" ,", $service_date_array).'.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-861-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>'; 
               }
                   $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CANCELLED</span>';
                   $mailService = 'Booking Cancelled';
            break; 
           case 'BOOKING REJECTED':
          $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that the service provider has cancelled your booking request due to the non-availability of service slots on the selected date and time.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">AirportZo works with different Service partners for each airport, and the service partner will render the final service at airports. Unfortunately, the service provider does not have the slot available on your travel date.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please accept our sincere apologies for not serving you this time. We have processed the refund of your total amount paid, and you should expect to see the same credited to your account in the next 5-6 working days.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">If you have any further questions, please contact us at <br><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #00b9f5;cursor: pointer;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Thank You for understanding.</p>';
                 $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family:sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING REJECTED</span>';
                 $mailService = 'Booking Rejected';
            break;
             case 'BOOKING CONFIRMED': 
          $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 20px;">Thank you for choosing AirportZo. We are pleased to inform you that your booking request has been confirmed.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please note that the Service Provider will contact you on the below-mentioned mobile number on your travel date.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon with our best services!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Thank you, and have a stress-free travel experience.</p>';
            $mailStatus = '<span style="background-color: #22c482;color:#fff;padding:7px 10px;border-radius:6px;font-family:sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CONFIRMED</span>';
            $mailService = 'Booking Confirmed';
            break;
       }
       if($this->mail_for != "service-provider"){
          $respectName = $contact_passenger->name_view;
       }else{
          $respectName = 'Team'; 
       }

        $mail_content = '<body>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;background-color: #fff;max-width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px;box-sizing: border-box;">
                           <div style="padding: 10px 0 32px;text-align: center;border-bottom:2px solid #eaeaea;">
                              <img style="max-width: 250px;width:100%;" src="'.$distributor_logo.'" alt="">
                           </div>
                           <div>
                              <p style="font-size:18px;font-family:sans-serif;font-weight:600;">Dear '.$respectName.',</p>'.$mailHeaderContent.'
                           </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;background-color:' . $brand_color . ';padding: 24px 40px;box-sizing: border-box;">
                          <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                            <div style="text-align: center;">
                                '.$mailStatus.'
                            </div>
                            <div style="text-align:center;">
	                            <h2 style="font-family:sans-serif;text-align: center;margin:16px 0 10px;">' . $this->mail_objs->journey . '</h2>
	                            <p style="font-size:16px;font-family:sans-serif;text-align: center;margin:10px 0;color: #4b4b4b;">' . $journey_period . '</p>
                            </div>
                            <div style="text-align: center;border-bottom: 1px solid #eaeaea;margin-top:16px;margin-bottom: 24px;height:16px;">
                                <img src="https://airportzostage.in/mail-template/circle-plane.png" alt="" style="margin-bottom: -18px;">
                            </div>
                            <table style="width: 100%;" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking ID</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->booking_number . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking Date</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->date_time . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Passengers</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . implode("+ ", $passenger_array) . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Total Services</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->total_service . ' services</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px 5px;box-sizing: border-box;">
                            <h3 style="font-size:18px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom: 12px;">'.$mailService.'</h3>
                        <div>';
                         foreach ($this->mail_objs->order_detail as $station_value) {
                    $service_view_array = [];
                             if(($station_value->airport_token == $this->order_airport_token) || $this->order_airport_token == ''){
                    foreach ($station_value->order_detail_array as $order_detail_value) {
                        if(($order_detail_value->token == $this->order_detail_token) || $this->order_detail_token == ''){
                        $service_passenger_array = [];
                        if ($order_detail_value->total_adult > 0) {
                            $adult_view = ($order_detail_value->total_adult > 1)? $order_detail_value->total_adult . " Adults": "1 Adult";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_adult . " Adults");
                        }
                        if ($order_detail_value->total_children > 0) {
                            $adult_view = ($order_detail_value->total_children > 1)? $order_detail_value->total_children . " Children": "1 Child";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_children . " Children");
                        }

                        $cancellation_view = [];
                        $cancellation_count = sizeof($order_detail_value->cancellation_policy_detail);
                        $cancel_policy_array = $order_detail_value->cancellation_policy_detail;
                        $min_hr = 0;
                        foreach ($cancel_policy_array as $cp_value) {
                            if ($cp_value->percentage == 0) {
                                $cp_value->refund = "Full";
                            } else if ($cp_value->percentage == 100) {
                                $cp_value->refund = "No";
                            } else {
                                $cp_value->refund = (100 - (int) $cp_value->percentage) . "%";
                            }
                            $cp_value->is_before = true;
                            if ($min_hr == 0 || $min_hr > $cp_value->hours) {
                                $min_hr = $cp_value->hours;
                            }
                        } unset($cp_value);
                        if ($min_hr > 0) {
                            $cancel_obj = new stdClass;
                            $cancel_obj->hours = $min_hr;
                            $cancel_obj->percentage = 100;
                            $cancel_obj->refund = "No";
                            $cancel_obj->is_before = false;
                            array_push($cancel_policy_array, $cancel_obj);
                        }
                        foreach ($cancel_policy_array as $cp_key => $cp_value) {
                            if ($cp_key % 2 == 0) {
                                $temp_td_arr = [];
                                $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                if ($cp_key < $cancellation_count) {
                                    $cp_value = $cancel_policy_array[$cp_key + 1];

                                    $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                    array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                }
                                $tr = '<tr>' . implode("", $temp_td_arr) . '</tr>';
                                array_push($cancellation_view, $tr);
                            }
                        } 
                        unset($cp_value);
                         $service_footer = "";
                        if (sizeof($cancellation_view) > 0) {
                            $service_footer .= '<div style="margin-bottom: 16px;">
                                                     <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                        <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                        Cancellation Policy
                                                     </p>
                                                     <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>' . implode("", $cancellation_view) . '</tr>
                                                        </tbody>
                                                     </table>
                                                </div>';
                        }
                        if (property_exists($order_detail_value, 'reschedule_policy')) {
                            if ($order_detail_value->reschedule_policy != '') {
                                $service_footer .= ' <div style="">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding:0 0 0 25px;margin:0 0 8px;line-height: 20px;">' . $order_detail_value->reschedule_policy . '</p>
                                          </div>';
                            }
                        }
                        $gmt_view = "";
                        if (property_exists($station_value, 'gmt_view')) {
                            if ($station_value->gmt_view != '') {
                                $gmt_view = ' (GMT ' . $station_value->gmt_view . ')';
                            }
                        }
                         $company_logo = ($order_detail_value->company_logo != '')? $order_detail_value->company_logo: "https://airportzostage.in/invoince-template/product-logo.png"; 
                            if($this->mail_for != "service-provider"){
                               $service_net_amount = '<td>
                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">' . $order_detail_value->currency . ' ' . $order_detail_value->net_amount. '</p>
                                </td>';  
                            }
                        array_push($service_view_array, '<div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <img src="' . $company_logo . '" alt="" width="50" height="50" style="width:50px;height:50px;border-radius: 50%;margin-right: 5px;">
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <span style="font-size:18px;font-family:sans-serif;font-weight: 700;margin:2px 0 4px;">' . $order_detail_value->company_name . '</span>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : ' . $order_detail_value->token . '<span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">' . $order_detail_value->service_name . '  
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . implode(" & ", $service_passenger_array) . '</span>
                                                                    </p>
                                                                </td>'.
                                                               $service_net_amount.'
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          ' . $service_footer . '
                                        </div>
                                    </div>');
                    }
                    }
                        unset($order_detail_value);
                        
                        $mail_content .= '<div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <h3 style="font-size:20px;font-family:sans-serif;margin:0;"></h3>
                                    <p style="font-size:20px;font-family:sans-serif;font-weight: 500;margin:0 0 5px;">' . $station_value->airport_code . '</p>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;">' . $station_value->airport_name . ' - ' . $station_value->terminal_name . '</p>
                                    <p style="font-size: 14px;font-family:sans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</p>
                                    ' . implode('<div style="max-width:500px;height: 1px;border-bottom: 1px solid #eaeaea;margin: 20px auto 20px;"></div>', $service_view_array) . '
                            </div>';
                    }
                    }
                    unset($station_value);
                        $mail_content .= '<div style="margin-top: 20px;padding: 20px 16px;border-top: 1px solid #eaeaea;">
                        <div style="margin-bottom: 22px;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Contact Passenger details</p>
                            <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->name_view . '</p>
                            <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->mobile_view . ' | ' . $contact_passenger->email_id . '</p>
                        </div>';
                 if (sizeof($other_passenger_array)) {
                            $mail_content .= '<div>
                                        <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Other Passenger details</p>';
                 }
                 foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                    $mail_content .= '<div style="margin-bottom: 12px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . ($other_passenger_key + 1) . ')' . $other_passenger_value->name_view .'</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $other_passenger_value->mobile_view . ' | ' . $other_passenger_value->email_id . '</p>
                                    </div>';
                }unset($other_passenger_value);
                if (sizeof($other_passenger_array)) {
                    $mail_content .= '</div>';
                }
                 if (sizeof($greet_passenger_array)) {
                     $mail_content .= '<div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Greeter Passenger details</p>';
                 }
                foreach ($greet_passenger_array as $greet_passenger_key => $greet_passenger_value) {
                 $mail_content .= '<div style="margin-bottom: 12px;">
                                            <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . ($greet_passenger_key + 1) . ')' . $greet_passenger_value->name_view .'</p>
                                            <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $greet_passenger_value->mobile_view . ' | ' . $greet_passenger_value->email_id . '</p>
                                        </div>';
                }unset($greet_passenger_value);
            if (sizeof($greet_passenger_array)) {
                $mail_content .= '</div>';
             }  
           $mail_content .='</div>
                        <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Flight Details</p>
                                    <table style="width: 100%;table-layout: fixed;">';
                    foreach ($this->mail_objs->journey_detail as $journey_key => $journey_value) {
                    if ($journey_key%2 == 0) {
                        $flight_number = ($journey_value->flight_number != '')? $journey_value->flight_number: '-';
                        $mail_content .='<tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>' . $journey_value->depart_airport_code . '</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $flight_number . '</p>
                                            </td>';
                        if ($journey_key < sizeof($this->mail_objs->journey_detail)-1) {
                            $flight_number = ($this->mail_objs->journey_detail[$journey_key + 1]->flight_number != '')? $this->mail_objs->journey_detail[$journey_key + 1]->flight_number: '-';
                            $mail_content .='<td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>' . $this->mail_objs->journey_detail[$journey_key + 1]->depart_airport_code . '</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $flight_number . '</p>
                                            </td>';
                       }
                       $mail_content .='</tr>';
                    }
                    } unset($journey_value);
                                        
                        $mail_content .='</table>
                                </div>
                            </div>';
            if ($this->mail_objs->gst_name != '' || $this->mail_objs->gst_number != '') {
               $mail_content .='<div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">GSTIN Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Company Name</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $this->mail_objs->gst_name . '</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">GST Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $this->mail_objs->gst_number . '</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>';
                        }
            $mail_content .='</div>
                        <div style="background-color: #f6f6f6;border-top:2px solid #eaeaea;max-width: 650px;margin: 0 auto;padding: 24px 56px 24px;box-sizing: border-box;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:24px;">Customer Support</p>
                            <table style="width: 100%;" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/mail.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Mail Us</p>
                                                <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/call.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/watsapp.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </body>';
     return $mail_content;
    } 
   public function getMailContent_serviceProvider_cancel_booking(){
      $distributor_logo = ($this->mail_objs->header_logo != '')? $this->mail_objs->header_logo: 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = ($this->mail_objs->brand_colour != '')? $this->mail_objs->brand_colour: '#07B4D3';
        $passenger_array = [];
        if ($this->mail_objs->total_adult > 0) {
            $adult_view = ($this->mail_objs->total_adult > 1)? $this->mail_objs->total_adult . " Adults": "1 Adult";
            array_push($passenger_array, $adult_view);
        }
        if ($this->mail_objs->total_children > 0) {
            $child_view = ($this->mail_objs->total_children > 1)? $this->mail_objs->total_children . " Children": "1 Child";
            array_push($passenger_array, $child_view);
        }

        $departure_dates = [];
        foreach ($this->mail_objs->journey_detail as $journey_key => $journey_value) {
            if (!in_array($journey_value->depart_date, $departure_dates)) {
                array_push($departure_dates, $journey_value->depart_date);
            }
        }
        unset($journey_value);
        $journey_period = '';
        if (sizeof($departure_dates)) {
            if (sizeof($departure_dates) == 1) {
                $journey_period = $departure_dates[0];
            } elseif (sizeof($departure_dates) == 2) {
                $journey_period = implode(", ", $departure_dates);
            } else {
                $journey_period = "From " . $departure_dates[0] . " to " . $departure_dates[sizeof($departure_dates) - 1];
            }
        }

        $contact_passenger = new stdClass;
        $other_passenger_array = [];
        $greet_passenger_array = [];
        foreach ($this->mail_objs->passenger_detail as $passenger_value) {
            switch ($passenger_value->passenger_type) {
                case 'Contact':
                    $contact_passenger = $passenger_value->passenger_array[0];
                    // array_push($passenger_array, "1 Contact");
                    break;
                
                case 'Others':
                    $other_passenger_array = $passenger_value->passenger_array;
                    // array_push($passenger_array, sizeof($passenger_value->passenger_array) . " Other");
                    break;
                
                case 'Greeter':
                    $greet_passenger_array = $passenger_value->passenger_array;
                    break;
            }
        }
        unset($passenger_value);
       $mailHeaderContent = '';
       $mailStatus = '';
         $service_date_array = [];
        foreach ($this->mail_objs->order_detail as $station_value) {
             if(($station_value->airport_token == $this->order_airport_token) || $this->order_airport_token == ''){
                foreach ($station_value->order_detail_array as $order_detail_value) {
                    if(($order_detail_value->token == $this->order_detail_token) || $this->order_detail_token == ''){
                       $service_date = $order_detail_value->service_date;
                        if(!in_array($service_date, $service_date_array)){
                            array_push($service_date_array, $service_date); 
                        }
                    }
                }
             }
         }
       switch($this->mail_status){
           case 'ORDER CANCELLED':
               if($this->mail_for != "service-provider"){
                  $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.150/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you '.$this->mail_objs->passenger_detail[0]->passenger_array[0]->name_view.' has cancelled his service dated '.implode(" ,", $service_date_array).'.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-861-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }
                   $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">ORDER CANCELLED</span>';
                   $mailService = 'Order Cancelled';
            break;
           case 'BOOKING CANCELLED': 
               if($this->mail_for != "service-provider"){
                    $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.150/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you '.$this->mail_objs->passenger_detail[0]->passenger_array[0]->name_view.' has cancelled his service dated '.implode(" ,", $service_date_array).'.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-861-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>'; 
               }
                   $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CANCELLED</span>';
                   $mailService = 'Booking Cancelled';
            break; 
           case 'BOOKING REJECTED':
          $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that the service provider has cancelled your booking request due to the non-availability of service slots on the selected date and time.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">AirportZo works with different Service partners for each airport, and the service partner will render the final service at airports. Unfortunately, the service provider does not have the slot available on your travel date.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please accept our sincere apologies for not serving you this time. We have processed the refund of your total amount paid, and you should expect to see the same credited to your account in the next 5-6 working days.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">If you have any further questions, please contact us at <br><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #00b9f5;cursor: pointer;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Thank You for understanding.</p>';
                 $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family:sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING REJECTED</span>';
                 $mailService = 'Booking Rejected';
            break;
             case 'BOOKING CONFIRMED': 
          $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 20px;">Thank you for choosing AirportZo. We are pleased to inform you that your booking request has been confirmed.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please note that the Service Provider will contact you on the below-mentioned mobile number on your travel date.</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon with our best services!</p>
                                <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Thank you, and have a stress-free travel experience.</p>';
            $mailStatus = '<span style="background-color: #22c482;color:#fff;padding:7px 10px;border-radius:6px;font-family:sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CONFIRMED</span>';
            $mailService = 'Booking Confirmed';
            break;
       }
       if($this->mail_for != "service-provider"){
          $respectName = $contact_passenger->name_view;
       }else{
          $respectName = 'Team'; 
       }

        $mail_content = '<body>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;background-color: #fff;max-width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px;box-sizing: border-box;">
                           <div style="padding: 10px 0 32px;text-align: center;border-bottom:2px solid #eaeaea;">
                              <img style="max-width: 250px;width:100%;" src="'.$distributor_logo.'" alt="">
                           </div>
                           <div>
                              <p style="font-size:18px;font-family:sans-serif;font-weight:600;">Dear '.$respectName.',</p>'.$mailHeaderContent.'
                           </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;background-color:' . $brand_color . ';padding: 24px 40px;box-sizing: border-box;">
                          <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                            <div style="text-align: center;">
                                '.$mailStatus.'
                            </div>
                            <div style="text-align:center;">
	                            <h2 style="font-family:sans-serif;text-align: center;margin:16px 0 10px;">' . $this->mail_objs->journey . '</h2>
	                            <p style="font-size:16px;font-family:sans-serif;text-align: center;margin:10px 0;color: #4b4b4b;">' . $journey_period . '</p>
                            </div>
                            <div style="text-align: center;border-bottom: 1px solid #eaeaea;margin-top:16px;margin-bottom: 24px;height:16px;">
                                <img src="https://airportzostage.in/mail-template/circle-plane.png" alt="" style="margin-bottom: -18px;">
                            </div>
                            <table style="width: 100%;" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking ID</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->booking_number . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking Date</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->date_time . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Passengers</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . implode("+ ", $passenger_array) . '</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Total Services</p>
                                            <p style="font-size: 16px;font-family:sans-serif;margin: 0;">' . $this->mail_objs->total_service . ' services</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px 5px;box-sizing: border-box;">
                            <h3 style="font-size:18px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom: 12px;">'.$mailService.'</h3>
                        <div>';
                         foreach ($this->mail_objs->order_detail as $station_value) {
                    $service_view_array = [];
                             if(($station_value->airport_token == $this->order_airport_token) || $this->order_airport_token == ''){
                    foreach ($station_value->order_detail_array as $order_detail_value) {
                        if(($order_detail_value->token == $this->order_detail_token) || $this->order_detail_token == ''){
                        $service_passenger_array = [];
                        if ($order_detail_value->total_adult > 0) {
                            $adult_view = ($order_detail_value->total_adult > 1)? $order_detail_value->total_adult . " Adults": "1 Adult";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_adult . " Adults");
                        }
                        if ($order_detail_value->total_children > 0) {
                            $adult_view = ($order_detail_value->total_children > 1)? $order_detail_value->total_children . " Children": "1 Child";
                            array_push($service_passenger_array, $adult_view);
                            // array_push($service_passenger_array, $order_detail_value->total_children . " Children");
                        }

                        $cancellation_view = [];
                        $cancellation_count = sizeof($order_detail_value->cancellation_policy_detail);
                        $cancel_policy_array = $order_detail_value->cancellation_policy_detail;
                        $min_hr = 0;
                        foreach ($cancel_policy_array as $cp_value) {
                            if ($cp_value->percentage == 0) {
                                $cp_value->refund = "Full";
                            } else if ($cp_value->percentage == 100) {
                                $cp_value->refund = "No";
                            } else {
                                $cp_value->refund = (100 - (int) $cp_value->percentage) . "%";
                            }
                            $cp_value->is_before = true;
                            if ($min_hr == 0 || $min_hr > $cp_value->hours) {
                                $min_hr = $cp_value->hours;
                            }
                        } unset($cp_value);
                        if ($min_hr > 0) {
                            $cancel_obj = new stdClass;
                            $cancel_obj->hours = $min_hr;
                            $cancel_obj->percentage = 100;
                            $cancel_obj->refund = "No";
                            $cancel_obj->is_before = false;
                            array_push($cancel_policy_array, $cancel_obj);
                        }
                        foreach ($cancel_policy_array as $cp_key => $cp_value) {
                            if ($cp_key % 2 == 0) {
                                $temp_td_arr = [];
                                $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                if ($cp_key < $cancellation_count) {
                                    $cp_value = $cancel_policy_array[$cp_key + 1];

                                    $hour_view = ($cp_value->is_before)? $cp_value->hours . ' hours before': 'After ' . $cp_value->hours . ' hours';
                                    array_push($temp_td_arr, '<td><ul style="margin:4px 0;"><li style="color:#4b4b4b;font-size: 14px;font-family:sans-serif;">' . $hour_view . ' - ' . $cp_value->refund . ' Refund</li></ul></td>');
                                }
                                $tr = '<tr>' . implode("", $temp_td_arr) . '</tr>';
                                array_push($cancellation_view, $tr);
                            }
                        } 
                        unset($cp_value);
                         $service_footer = "";
                        if (sizeof($cancellation_view) > 0) {
                            $service_footer .= '<div style="margin-bottom: 16px;">
                                                     <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                        <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                        Cancellation Policy
                                                     </p>
                                                     <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>' . implode("", $cancellation_view) . '</tr>
                                                        </tbody>
                                                     </table>
                                                </div>';
                        }
                        if (property_exists($order_detail_value, 'reschedule_policy')) {
                            if ($order_detail_value->reschedule_policy != '') {
                                $service_footer .= ' <div style="">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding:0 0 0 25px;margin:0 0 8px;line-height: 20px;">' . $order_detail_value->reschedule_policy . '</p>
                                          </div>';
                            }
                        }
                        $gmt_view = "";
                        if (property_exists($station_value, 'gmt_view')) {
                            if ($station_value->gmt_view != '') {
                                $gmt_view = ' (GMT ' . $station_value->gmt_view . ')';
                            }
                        }
                         $company_logo = ($order_detail_value->company_logo != '')? $order_detail_value->company_logo: "https://airportzostage.in/invoince-template/product-logo.png"; 
                            if($this->mail_for != "service-provider"){
                               $service_net_amount = '<td>
                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">' . $order_detail_value->currency . ' ' . $this->service_costs. '</p>
                                </td>';  
                            }
                        array_push($service_view_array, '<div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <img src="' . $company_logo . '" alt="" width="50" height="50" style="width:50px;height:50px;border-radius: 50%;margin-right: 5px;">
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <span style="font-size:18px;font-family:sans-serif;font-weight: 700;margin:2px 0 4px;">' . $order_detail_value->company_name . '</span>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : ' . $order_detail_value->token . '<span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">' . $order_detail_value->service_name . '  
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . implode(" & ", $service_passenger_array) . '</span>
                                                                    </p>
                                                                </td>'.
                                                               $service_net_amount.'
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          ' . $service_footer . '
                                        </div>
                                    </div>');
                    }
                    }
                        unset($order_detail_value);
                        
                        $mail_content .= '<div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <h3 style="font-size:20px;font-family:sans-serif;margin:0;"></h3>
                                    <p style="font-size:20px;font-family:sans-serif;font-weight: 500;margin:0 0 5px;">' . $station_value->airport_code . '</p>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;">' . $station_value->airport_name . ' - ' . $station_value->terminal_name . '</p>
                                    <p style="font-size: 14px;font-family:sans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</p>
                                    ' . implode('<div style="max-width:500px;height: 1px;border-bottom: 1px solid #eaeaea;margin: 20px auto 20px;"></div>', $service_view_array) . '
                            </div>';
                    }
                    }
                    unset($station_value);
                        $mail_content .= '<div style="margin-top: 20px;padding: 20px 16px;border-top: 1px solid #eaeaea;">
                        <div style="margin-bottom: 22px;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Contact Passenger details</p>
                            <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->name_view . '</p>
                            <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->mobile_view . ' | ' . $contact_passenger->email_id . '</p>
                        </div>';
                 if (sizeof($other_passenger_array)) {
                            $mail_content .= '<div>
                                        <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Other Passenger details</p>';
                 }
                 foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                    $mail_content .= '<div style="margin-bottom: 12px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . ($other_passenger_key + 1) . ')' . $other_passenger_value->name_view .'</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $other_passenger_value->mobile_view . ' | ' . $other_passenger_value->email_id . '</p>
                                    </div>';
                }unset($other_passenger_value);
                if (sizeof($other_passenger_array)) {
                    $mail_content .= '</div>';
                }
                 if (sizeof($greet_passenger_array)) {
                     $mail_content .= '<div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Greeter Passenger details</p>';
                 }
                foreach ($greet_passenger_array as $greet_passenger_key => $greet_passenger_value) {
                 $mail_content .= '<div style="margin-bottom: 12px;">
                                            <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . ($greet_passenger_key + 1) . ')' . $greet_passenger_value->name_view .'</p>
                                            <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $greet_passenger_value->mobile_view . ' | ' . $greet_passenger_value->email_id . '</p>
                                        </div>';
                }unset($greet_passenger_value);
            if (sizeof($greet_passenger_array)) {
                $mail_content .= '</div>';
             }  
           $mail_content .='</div>
                        <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Flight Details</p>
                                    <table style="width: 100%;table-layout: fixed;">';
                    foreach ($this->mail_objs->journey_detail as $journey_key => $journey_value) {
                    if ($journey_key%2 == 0) {
                        $flight_number = ($journey_value->flight_number != '')? $journey_value->flight_number: '-';
                        $mail_content .='<tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>' . $journey_value->depart_airport_code . '</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $flight_number . '</p>
                                            </td>';
                        if ($journey_key < sizeof($this->mail_objs->journey_detail)-1) {
                            $flight_number = ($this->mail_objs->journey_detail[$journey_key + 1]->flight_number != '')? $this->mail_objs->journey_detail[$journey_key + 1]->flight_number: '-';
                            $mail_content .='<td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;"><span>' . $this->mail_objs->journey_detail[$journey_key + 1]->depart_airport_code . '</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $flight_number . '</p>
                                            </td>';
                       }
                       $mail_content .='</tr>';
                    }
                    } unset($journey_value);
                                        
                        $mail_content .='</table>
                                </div>
                            </div>';
            if ($this->mail_objs->gst_name != '' || $this->mail_objs->gst_number != '') {
               $mail_content .='<div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div>
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">GSTIN Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Company Name</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $this->mail_objs->gst_name . '</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">GST Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $this->mail_objs->gst_number . '</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>';
                        }
            $mail_content .='</div>
                        <div style="background-color: #f6f6f6;border-top:2px solid #eaeaea;max-width: 650px;margin: 0 auto;padding: 24px 56px 24px;box-sizing: border-box;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom:24px;">Customer Support</p>
                            <table style="width: 100%;" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/mail.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Mail Us</p>
                                                <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;padding-bottom: 32px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/call.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td style="padding-bottom: 32px;">
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" style="width: 36px;">
                                            <div style="margin-right: 12px;">
                                                <img src="https://airportzostage.in/mail-template/watsapp.png" alt="" width="36" style="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                <p style="font-size:16px;font-family: sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </body>';
     return $mail_content;
    } 
    
    public function bookingCompletedTemplate(){
    $brand_color = ($this->user_detail->brand_colour != '')? $this->user_detail->brand_colour: '#07B4D3';
    $mailTemplate = '<body>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;background-color: #fff;">
                    <tbody>
                        <tr>
                            <td>
                                <div style="max-width: 650px;margin: 0 auto;padding: 10px 0 32px;text-align: center;">
                                  <img style="max-width: 250px;width:100%;" src="https://airportzostage.in/mail-template/Airportzo_logo@2x.png" alt="">
                                </div>
                                <div style="max-width: 650px;margin: 0 auto;background-color: '.$brand_color.';padding: 24px 40px;box-sizing: border-box;">
                                  <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                                    <div style="text-align: center;">
                                        <span style="background-color: #fb6500;color:#fff;padding:7px 10px;border-radius:6px;font-family:sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING COMPLETED</span>
                                    </div>
                                    <h2 style="font-family:sans-serif;text-align: center;margin:16px 0 10px;">'.$this->mail_data[0]->journey1.'</h2>
                                    <p style="font-size:16px;font-family:sans-serif;text-align: center;margin:10px 0;color: #4b4b4b;">'.$this->mail_data[0]->depart_date.'</p>
                                    <div style="text-align: center;border-bottom: 1px solid #eaeaea;margin-top:16px;margin-bottom: 24px;">
                                        <img src="https://airportzostage.in/mail-template/circle-plane.png" alt="" style="margin-bottom: -18px;">
                                    </div>
                                    <table style="width: 100%;" cellpadding="2">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking ID</p>
                                                    <p style="font-size: 16px;font-family:sans-serif;margin: 0;">'.$this->mail_data[0]->booking_number.'</p>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking Date</p>
                                                    <p style="font-size: 16px;font-family:sans-serif;margin: 0;">'.$this->mail_data[0]->date_time.'</p>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Passengers</p>
                                                    <p style="font-size: 16px;font-family:sans-serif;margin: 0;">'.$this->mail_data[0]->total_adult.' Adults, '.$this->mail_data[0]->total_children.' Children</p>
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <p style="font-size: 13px;font-family:sans-serif;color:#8E8F91;margin: 0 0 5px;">Total Services</p>
                                                    <p style="font-size: 16px;font-family:sans-serif;margin: 0;">'.$this->mail_data[0]->total_service.' services</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px;box-sizing: border-box;">
                                   <div>
                                      <p style="font-size:18px;font-family:sans-serif;font-weight: 500;">Dear '.$this->user_detail->user_name.',</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 20px;">Thank you for choosing AirportZo to book your Airport Services. It was a pleasure serving you.</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We hope you enjoyed the services rendered by the service partner and they have met your expectations.</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">As a valued customer, we would love to know about your booking and the service experience. Please leave us an email at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a>.</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you again in future.</p>
                                      <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Thank you, and Have a wonderful day.</p>
                                   </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>';
        return $mailTemplate;
    }
    
    public function sendOtp(){
        $otpTemplate = '<body style="margin: 0; font-family: sans-serif; text-align: left">
        <table
          style="
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background-color: #f8f8f8;
          "
        >
          <thead>
            <tr>
              <th
                style="
                  display: block;
                  width: 82%;
                  margin: 0 auto;
                  padding: 24px 0;
                  text-align: center;
                  border-bottom: 1px solid #e3e3e3;
                "
              >
                <img
                  src="https://airportzostage.in/mail-template/Airportzo_logo@2x.png"
                  alt="logo"
                  style="width: 100%; max-width: 220px"
                />
              </th>
            </tr>
          </thead>
          <tbody style="font-size: 18px; line-height: 28px">
            <tr>
              <td style="padding-bottom: 32px; border-bottom: 2px solid #e3e3e3">
                <div style="width: 82%; margin: 0 auto">
                  <p>
                    Hello <span style="font-weight: bold">'.$this->name.'</span>,
                  </p>
                  <p>The OTP for resetting your password is <b>'.$this->otp.'</b> </p>
                </div>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td
                style="padding: 32px 0; display: block; width: 82%; margin: 0 auto"
              >
                <div
                  style="
                    width: 70%;
                    display: flex;
                    align-items: center;
                    margin-bottom: 24px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #e5e5e5;
                  "
                >
                  <img
                    src="https://airportzostage.in/mail-template/mail.png"
                    alt=""
                  />
                  <div style="margin-left: 20px">
                    <p style="font-size: 15px; margin-bottom: 4px; margin-top: 0">
                      Mail Us
                    </p>
                    <a
                      style="
                        font-size: 20px;
                        color: #0091ff;
                        text-decoration: none;
                        letter-spacing: 0.6px;
                      "
                      >support@airportzo.com</a
                    >
                  </div>
                </div>
                <div
                  style="
                    width: 70%;
                    display: flex;
                    align-items: center;
                    margin-bottom: 24px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #e5e5e5;
                  "
                >
                  <img
                    src="https://airportzostage.in/mail-template/call.png"
                    alt=""
                  />
                  <div style="margin-left: 20px">
                    <p style="font-size: 15px; margin-bottom: 4px; margin-top: 0">
                      Call Us (Toll Free)
                    </p>
                    <p style="font-size: 20px; margin: 0; letter-spacing: 0.6px">
                      +91 8610725198
                    </p>
                  </div>
                </div>
                <div
                  style="
                    width: 70%;
                    display: flex;
                    align-items: center;
                    margin-bottom: 24px;
                  "
                >
                  <img
                    src="https://airportzostage.in/mail-template/watsapp.png"
                    alt=""
                  />
                  <div style="margin-left: 20px">
                    <p style="font-size: 15px; margin-bottom: 4px; margin-top: 0">
                      Whatsapp
                    </p>
                    <p style="font-size: 20px; margin: 0; letter-spacing: 0.6px">
                      +91 8610725198
                    </p>
                  </div>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </body>';
    return $otpTemplate;
    }
}
?>