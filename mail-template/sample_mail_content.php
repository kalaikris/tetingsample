<?php
class MailTemplate {
    // object properties
    public $mail_objs;

 public function getCommonMailContent(){
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
                              <p style="font-size:18px;font-family:sans-serif;font-weight:600;">Dear Mr.Suresh,</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.200/-per order.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>
                           </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;background-color:' . $brand_color . ';padding: 24px 40px;box-sizing: border-box;">
                          <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                            <div style="text-align: center;">
                                <span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CANCELLED</span>
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
                            <h3 style="font-size:18px;font-family: sans-serif;font-weight: 500;margin-top:0;margin-bottom: 12px;">Services cancelled</h3>
                        <div>';
                         foreach ($this->mail_objs->order_detail as $station_value) {
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
                        array_push($service_view_array, '<div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top">
                                                    <img src="https://airportzostage.in/mail-template/pranaam.jpg" alt="" width="50" height="50" style="width:50px;height:50px;border-radius: 50%;margin-right: 5px;">
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <span style="font-size:18px;font-family:sans-serif;font-weight: 700;margin:2px 0 4px;">Pranaam</span>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : ' . $order_detail_value->token . '<span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">' . $order_detail_value->service_name . '  
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">' . implode(" & ", $service_passenger_array) . '</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">₹' . $order_detail_value->net_amount . '</p>
                                                                </td>
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
                        unset($order_detail_value);
                        
                        $mail_content .= '<div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <h3 style="font-size:20px;font-family:sans-serif;margin:0;"></h3>
                                    <p style="font-size:20px;font-family:sans-serif;font-weight: 500;margin:0 0 5px;">' . $station_value->airport_code . '</p>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b;">' . $station_value->airport_name . ' - ' . $station_value->terminal_name . '</p>
                                    <p style="font-size: 14px;font-family:sans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">' . $station_value->order_detail_array[0]->service_date_time . $gmt_view .'</p>
                                    ' . implode('<div style="max-width:500px;height: 1px;border-bottom: 1px solid #eaeaea;margin: 20px auto 20px;"></div>', $service_view_array) . '
                            </div>';
                    }
                    unset($station_value);
                        $mail_content .= '<div style="margin-top: 20px;padding: 20px 16px;border-top: 1px solid #eaeaea;">
                        <div style="margin-bottom: 22px;">
                            <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Contact Passenger details</p>
                            <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->name_view . '</p>
                            <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $contact_passenger->mobile_view . ' | ' . $contact_passenger->email_id . '</p>
                            <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Age : ' . $contact_passenger->age . '</p>
                        </div>';
                 if (sizeof($other_passenger_array)) {
                            $mail_content .= '<div>
                                        <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">Other Passenger details</p>';
                 }
                 foreach ($other_passenger_array as $other_passenger_key => $other_passenger_value) {
                    $mail_content .= '<div style="margin-bottom: 12px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . ($other_passenger_key + 1) . ')' . $other_passenger_value->name_view .'</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family: sans-serif;margin:0 0 5px;">' . $other_passenger_value->mobile_view . ' | ' . $other_passenger_value->email_id . '</p>
                                        <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Age : ' . $other_passenger_value->age . '</p>
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
                                            <p style="color:#8E8F91;font-size:13px;font-family: sans-serif;margin:0 0 5px;">Age : ' . $greet_passenger_value->age . '</p>
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
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family: sans-serif;font-weight: 600;margin-top:0;margin-bottom:8px;">E-Ticket</p>
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
                            //print_r($service_date_array);
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
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.200/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                  print_r($service_date_array);
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you Mr/Mrs/ Ms. Passenger Name has cancelled his service dated '.implode(" ,",$service_date_array).'.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-867-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }
                   $mailStatus = '<span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family: sans-serif;font-weight: 500;letter-spacing: 1.5px;">ORDER CANCELLED</span>';
                   $mailService = 'Order Cancelled';
            break;
           case 'BOOKING CANCELLED': 
               if($this->mail_for != "service-provider"){
                    $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.200/-per order.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>';
               }else{
                   $mailHeaderContent = '<p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to inform you Mr/Mrs/ Ms. Passenger Name has cancelled his service dated 25-Nov-2022.</p>
                                  <p style="color:#4b4b4b;font-size:18px;font-family:sans-serif;margin: 0px 0 20px;">Please cancel the service in your system and initiate the refund process. If you have any further questions, please contact us at <span style="color: #000;font-weight: 500; ">+91-867-072-5198 </span>or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>'; 
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
                              <p style="font-size:18px;font-family:sans-serif;font-weight:600;">Dear '.$contact_passenger->name_view.',</p>'.$mailHeaderContent.'
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
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">&#8377;' . $order_detail_value->net_amount . '</p>
                                                                </td>
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
}
?>