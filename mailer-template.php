<?php
class MailTemplateOrder {
    // object properties
    public $mail_obj;
    
    public function genMailContentForAdminAndUser() {
    	// $this->mail_obj->total_adult = 1;
    	// $this->mail_obj->total_children = 1;
    	// $this->mail_obj->journey_detail = [];
    	// $this->mail_obj->passenger_detail = [];

        $distributor_logo = 'https://airportzostage.in/service-distributor-dashboard/asset/img/logo.png';
        $brand_color = '#07B4D3';
        // $passenger_array = [];
        // if ($this->mail_obj->total_adult > 0) {
        //     $adult_view = ($this->mail_obj->total_adult > 1)? $this->mail_obj->total_adult . " Adults": "1 Adult";
        //     array_push($passenger_array, $adult_view);
        // }
        // if ($this->mail_obj->total_children > 0) {
        //     $child_view = ($this->mail_obj->total_children > 1)? $this->mail_obj->total_children . " Children": "1 Child";
        //     array_push($passenger_array, $child_view);
        // }

        // $departure_dates = [];
        // foreach ($this->mail_obj->journey_detail as $journey_key => $journey_value) {
        //     if (!in_array($journey_value->depart_date, $departure_dates)) {
        //         array_push($departure_dates, $journey_value->depart_date);
        //     }
        // }
        // unset($journey_value);
        // $journey_period = '';
        // if (sizeof($departure_dates)) {
        //     if (sizeof($departure_dates) == 1) {
        //         $journey_period = $departure_dates[0];
        //     } elseif (sizeof($departure_dates) == 2) {
        //         $journey_period = implode(", ", $departure_dates);
        //     } else {
        //         $journey_period = "From " . $departure_dates[0] . " to " . $departure_dates[sizeof($departure_dates) - 1];
        //     }
        // }

        // $contact_passenger = new stdClass;
        // $other_passenger_array = [];
        // $greet_passenger_array = [];
        // foreach ($this->mail_obj->passenger_detail as $passenger_value) {
        //     switch ($passenger_value->passenger_type) {
        //         case 'Contact':
        //             $contact_passenger = $passenger_value->passenger_array[0];
        //             // array_push($passenger_array, "1 Contact");
        //             break;
                
        //         case 'Others':
        //             $other_passenger_array = $passenger_value->passenger_array;
        //             // array_push($passenger_array, sizeof($passenger_value->passenger_array) . " Other");
        //             break;
                
        //         case 'Greeter':
        //             $greet_passenger_array = $passenger_value->passenger_array;
        //             break;
        //     }
        // }
        // unset($passenger_value);

        $mail_template = '<body>
                <table style="width:100%;max-width:800px;margin:auto;box-shadow: 1px 1px 20px 2px #00000029;border-radius: 12px;overflow: hidden;">
                    <thead>
                        <tr>
                            <th style="background-color:' . $brand_color . '">
                                <table style="width: 90%;background-color: #ffff;border-radius: 14px;margin: 30px auto;padding:30px">
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;">
                                                <img src="' . $distributor_logo . '" alt="logo" style="width: 144px;margin-bottom: 10px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                                <span style="display:block;font-size:26px;line-height:30px;font-family: sans-serif;font-weight: 700;color: #242424;padding-bottom: 5px;">MAA-BLR</span>
                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;">08 Nov 2022</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display: block;border-bottom: 1px solid #f2f2f2;position: relative;margin: 30px 0px;">
                                                    <img src="https://airportzostage.in/invoince-template/flight-icon.png" alt="flight icon" style="width: 38px;position: absolute;top: -19px;left: 50%;">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <ul style="with:100%;list-style-type: none;margin: 0px;padding: 0px;text-align:left;">
                                                    <li style="display:inline-block;margin-right:24px;margin-bottom:12px;">
                                                        <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking ID</span>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">A1234567</span>
                                                    </li>
                                                    <li style="display:inline-block;margin-right:24px;margin-bottom:12px;">
                                                        <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking Date</span>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">07 Nov 2022</span>
                                                    </li>
                                                    <li style="display:inline-block;margin-right:24px;margin-bottom:12px;">
                                                        <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Passengers</span>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">1 Adult 2 Children</span>
                                                    </li>
                                                    <li style="display:inline-block;margin-right:24px;margin-bottom:12px;">
                                                        <span style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Total Services</span>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">2</span>
                                                    </li>
                                                </ul>
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
                
                       
                        $company_logo ="https://airportzostage.in/invoince-template/product-logo.png";
                    

                    
                    $mail_template .= '<tr>
                                        <td>
                                            <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;margin-bottom: 15px;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <span style="display:block;font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">MAA</span>
                                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mumbai International Airport - Terminal 1</span>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">08 Nov, 2022 13:00 (GMT + 08:00)</span>
                                                            </span>
                                                            <ul style="display: flex;list-style-type: none;margin: 0px;padding: 0px;padding-top: 30px;width: 100%;">
                                <li>
                                    <div style="width: 100%;display: flex;">
                                        <span style="display: block;margin-right:10px;">
                                            <img src="' . $company_logo . '" alt="" style="width: 55px;">
                                        </span>
                                        <span style="width:100%">
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Pranaam</span>
                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Order ID : 12534646</span>
                                            <span style="display: flex;justify-content: space-between;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">International-Departure-Silver (Without Lounge) | 1 Adult</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;margin-left:auto;">INR 2000</span>
                                            </span>
                                        </span>
                                    </div>
                                    <div style="margin-top: 12px;border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                    <div style="margin-bottom: 16px;">
                                <p style="display: flex;">
                                    <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                    <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Cancellation Policy</span>    
                                </p>
                                <table style="width:100%;table-layout: fixed;" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                          <td>
                                            <ul style="margin:4px 0;">
                                               <li>48 hours before - 70% Refund</li>
                                            </ul>
                                          </td>
                                          <td>
                                            <ul style="margin:4px 0;">
                                               <li>48 hours before - 70% Refund</li>
                                            </ul>
                                          </td>
                                          <td>
                                            <ul style="margin:4px 0;">
                                               <li>48 hours before - 70% Refund</li>
                                            </ul>
                                          </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="">
                                    <p style="display: flex;">
                                        <img src="https://airportzostage.in/invoince-template/exclamation-mark-icon.png" alt="" style="width: 20px;margin-right: 8px;">
                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">Reschedule Policy</span>    
                                    </p>
                                    <p style="color:#4b4b4b;font-size: 14px;font-family: \'Rubik\',sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">
                                        If you wish to reschedule any of your booked service, please contact +91 8610725198 or write us to support@airportzo.com
                                    </p>
                                </div>
                                </div>
                                </li>
                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>';
                
              
            $mail_template .= '</table>
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
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Deepan Santhosh</span>
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+919876543210 | user@gmail.com</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';
                
                    $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Other Passenger details</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1.</span>
                                                    <span>    
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">qwerty</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">127637828 | usee2gmail.com</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1.</span>
                                                    <span>    
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">qwerty</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">127637828 | usee2gmail.com</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr></tbody>
                                </table>
                            </td>
                        </tr>';
               
                    $mail_template .= '<tr>
                            <td>
                                <table style="width: 100%;padding: 20px 30px;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Greeter details</span>
                                            </td>
                                        </tr>';
                
                    $mail_template .= '<tr>
                                            <td>
                                                <span style="display:flex;padding-bottom: 12px;">
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1.</span>
                                                    <span>
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Karthi</span>
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">8675767474 | user@gmail.com</span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>';
                
                $mail_template .= '</tbody>
                                </table>
                            </td>
                        </tr>';
                

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
               
                        $mail_template .= '<tr>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">MAA Flight Number</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">A112356</span>
                                            </td>';
                        
                        $mail_template .= '</tr>';
                        $mail_template .= '<tr>
                                            <td style="padding-bottom: 10px;">
                                                <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">MAA Flight Number</span>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">A112356</span>
                                            </td>';
                        
                        $mail_template .= '</tr>';
                  
                    
                $mail_template .= '</tbody>
                                </table>
                            </td>
                        </tr>';
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
                                                <span style="display:block;font-size: 22px;line-height: 20px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;">Santhoshh</span>
                                            </td>
                                            <td>
                                                <p style="color:#8f8b8b;font-size:16px;font-family: sans-serif;margin:0 0 7px;">GSTIN Number</p>
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">12345678</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>';
            
            
            $mail_template .= '</tbody>';
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
                                                <ul style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                        <img src="https://airportzostage.in/invoince-template/mail.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Mail Us</span>
                                                            <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;"><a href="mainto:support@airportzo.com" style="color: #0091ff;text-decoration: none;">support@airportzo.com</a></span>
                                                        </span>
                                                    </li>
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                        <img src="https://airportzostage.in/invoince-template/phone.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Call Us(Toll free)</span>
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 8610725198</a></span>
                                                        </span>
                                                    </li>
                                                    <li style="display: flex;align-items:center;padding: 20px 0px;">
                                                        <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" style="width: 50px;margin-right: 10px;">
                                                        <span style="">
                                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Watsapp</span>
                                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 8610725198</a></span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tfoot>';
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
                                            <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Order ID : ' . $this->mail_obj->booking_number . '</span>
                                            <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Booked on : ' . $this->mail_obj->date_time . '</span>
                                            <span style="display:block;font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: normal;">Passengers : ' . implode(" & ", $passenger_array) . '</span>
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
                                        <td>
                                            <span style="display: flex;align-items:center;margin: 10px auto;">
                                                <img src="https://airportzostage.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                <span>
                                                    <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Airport Name</span>
                                                    <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">' . $order_value->airport_name . '</span>
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <span style="display: flex;align-items:center;margin: 10px auto;">
                                                <img src="https://airportzostage.in/invoince-template/calender.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                <span>
                                                    <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Terminal Name</span>
                                                    <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">' . $order_value->terminal_name . ' (' . $order_value->airport_type . ')</span>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="display: flex;align-items:center;margin: 10px auto;">
                                                <img src="https://airportzostage.in/invoince-template/flight.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                <span>
                                                    <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">' . $order_value->airport_type . ' Flight number</span>
                                                    <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">' . $order_value->flight_number . '</span>
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <span style="display: flex;align-items:center;margin: 10px auto;">
                                                <img src="https://airportzostage.in/invoince-template/calender.png" alt="flight" style="margin-right: 5px;width: 70px;height: 70px;object-fit: contain;">
                                                <span>
                                                    <span style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;">Service Date</span>
                                                    <span style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;">' . $order_value->order_detail_array[0]->service_date_time . '</span>
                                                </span>
                                            </span>
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
                                                                <span style="display:none;font-size: 24px;line-height: 35px;font-family: sans-serif;color: #fff;text-align:left;font-weight:700;margin-left:auto;">INR ' . $service_value->net_amount . '</span>
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
                                            <span style="display:none;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(Age : ' . $contact_passenger->age . ')</span>
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
                                                    <span style="display:none;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $other_passenger_value->age . '</span>
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
                                            <ul style="list-style-type: none;padding-left:0px;margin: 0px;">
                                                <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                    <img src="https://airportzostage.in/invoince-template/mail.png" alt="" style="width: 50px;margin-right: 10px;">
                                                    <span style="">
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Mail Us</span>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;text-align: left;font-weight: 700;">
                                                            <a href="mainto:support@airportzo.com" style="color: #0091ff;text-decoration: none;">support@airportzo.com</a>
                                                        </span>
                                                    </span>
                                                </li>
                                                <li style="display: flex;align-items:center;padding: 20px 0px;border-bottom: 1px solid #e4e4e4;">
                                                    <img src="https://airportzostage.in/invoince-template/phone.png" alt="" style="width: 50px;margin-right: 10px;">
                                                    <span style="">
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Call Us(Toll free)</span>
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 8610725198</span>
                                                    </span>
                                                </li>
                                                <li style="display: flex;align-items:center;padding: 20px 0px;">
                                                    <img src="https://airportzostage.in/invoince-template/watsapp.png" alt="" style="width: 50px;margin-right: 10px;">
                                                    <span style="">
                                                        <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">Watsapp</span>
                                                        <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">+91 8610725198</span>
                                                    </span>
                                                </li>
                                            </ul>
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
}
###sample
?>

