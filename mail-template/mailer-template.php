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
                            <th>
                                <table style="width:100%;" cellspacing="0">
                                    <div style="margin: 30px auto;padding:30px 40px;background-color:' . $brand_color . ';"> 
                                        <table cellspacing="0" style="width:100%;background-color: #ffff;border-radius:12px;padding:16px;">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:center;" colspan="4">
                                                        <img src="' . $distributor_logo . '" alt="logo" style="width: 144px;margin-bottom: 10px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:center;" colspan="4">
                                                        <p style="display:block;font-size:26px;line-height:30px;font-family: sans-serif;font-weight: 700;color: #242424;padding-bottom: 5px;margin:5px 0;">MAA-BLR</p>
                                                        <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;">08 Nov 2022</span>
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
                                                        <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">A1234567</p>
                                                    </td>
                                                    <td>
                                                        <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Booking Date</p>
                                                        <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">07 Nov 2022</p>
                                                    </td>
                                                    <td>
                                                        <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Passengers</p>
                                                        <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">1 Adult 2 Children</p>
                                                    </td>
                                                    <td>
                                                        <p style="display:block;font-size:14px;line-height:20px;font-family: sans-serif;color: #808080;text-align: left;padding-bottom: 3px;">Total Services</p>
                                                        <p style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #242424;text-align: left;">2</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                
                       
                    $company_logo ="https://d1xqjehqvi7b4u.cloudfront.net/service_provider_company/documents/1667543526124.png";
                    

                    
                    $mail_template .= '<tr>
                                        <td style="padding:0 0 15px;">
                                            <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <p style="font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;margin:5px 0;">MAA</p>
                                                                <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;margin:5px 0;">Mumbai International Airport - Terminal 1</p>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">08 Nov, 2022 13:00 (GMT + 08:00)</span>
                                                            </span>
                                                            <table cellspacing="0" style="padding-top: 30px;width: 100%;">
                                                                <tr>
                                                                  <td style="width:55px;">
                                                                    <div style="margin-bottom:12px;">
                                                                          <img src="' . $company_logo . '" alt="" style="width: 55px;" width="55">
                                                                    </div>
                                                                  </td>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                        <p style="font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;margin:0 0 5px;font-weight: 700;">Pranaam</p>
                                                                        <p style="font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;margin:0 0 5px;">Order ID : 12534646</p>
                                                                        <span style="display:flex">
                                                                        <span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">International(Without Lounge) | 1 Adult</span>
                                                                        <span style="display:block;font-size:22px;line-height:24px;font-family:sans-serif;color:#242424;text-align:left;margin-left:auto">INR 2000</span>
                                                                        </span>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2" style="background-color: #f6f6f6;border-radius: 8px;border:1px solid #eaeaea;padding:12px;margin:12px 0 0;">
                                                                    <div style="padding: 16px;box-sizing: border-box;">
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
                                                                            <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">
                                                                                If you wish to reschedule any of your booked service, please contact +91 8610725198 or write us to support@airportzo.com
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                            </table>
                                                            <table cellspacing="0" style="padding-top: 30px;width: 100%;">
                                                                <tr>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                          <img src="' . $company_logo . '" alt="" style="width: 55px;">
                                                                    </div>
                                                                  </td>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                        <p style="font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;margin:0 0 5px;font-weight: 700;">Pranaam</p>
                                                                        <p style="font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;margin:0 0 5px;">Order ID : 12534646</p>
                                                                        <span style="display:flex">
                                                                        <span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">International(Without Lounge) | 1 Adult</span>
                                                                        <span style="display:block;font-size:22px;line-height:24px;font-family:sans-serif;color:#242424;text-align:left;margin-left:auto">INR 2000</span>
                                                                        </span>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2" style="background-color: #f6f6f6;border-radius: 8px;border:1px solid #eaeaea;padding:12px;margin:12px 0 0;">
                                                                    <div style="padding: 16px;box-sizing: border-box;">
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
                                                                            <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">
                                                                                If you wish to reschedule any of your booked service, please contact +91 8610725198 or write us to support@airportzo.com
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 0 15px;">
                                            <table style="width: 100%;border: 1px solid #d1cccc;padding: 15px 20px;border-radius: 14px;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <p style="font-size: 26px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;margin:5px 0;">MAA</p>
                                                                <p style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;margin:5px 0;">Mumbai International Airport - Terminal 1</p>
                                                                <span style="display:block;font-size:18px;line-height:20px;font-family: sans-serif;color: #8f8b8b;text-align: left;font-weight: 700;">08 Nov, 2022 13:00 (GMT + 08:00)</span>
                                                            </span>
                                                            <table cellspacing="0" style="padding-top: 30px;width: 100%;">
                                                                <tr>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                          <img src="' . $company_logo . '" alt="" style="width: 55px;">
                                                                    </div>
                                                                  </td>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                        <p style="font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;margin:0 0 5px;font-weight: 700;">Pranaam</p>
                                                                        <p style="font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;margin:0 0 5px;">Order ID : 12534646</p>
                                                                        <span style="display:flex">
                                                                        <span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">International(Without Lounge) | 1 Adult</span>
                                                                        <span style="display:block;font-size:22px;line-height:24px;font-family:sans-serif;color:#242424;text-align:left;margin-left:auto">INR 2000</span>
                                                                        </span>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2" style="background-color: #f6f6f6;border-radius: 8px;border:1px solid #eaeaea;padding:12px;margin:12px 0 0;">
                                                                    <div style="padding: 16px;box-sizing: border-box;">
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
                                                                            <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">
                                                                                If you wish to reschedule any of your booked service, please contact +91 8610725198 or write us to support@airportzo.com
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                            </table>
                                                            <table cellspacing="0" style="padding-top: 30px;width: 100%;">
                                                                <tr>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                          <img src="' . $company_logo . '" alt="" style="width: 55px;">
                                                                    </div>
                                                                  </td>
                                                                  <td>
                                                                    <div style="margin-bottom:12px;">
                                                                        <p style="font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;margin:0 0 5px;font-weight: 700;">Pranaam</p>
                                                                        <p style="font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;margin:0 0 5px;">Order ID : 12534646</p>
                                                                        <span style="display:flex">
                                                                        <span style="display:block;font-size:18px;line-height:20px;font-family:sans-serif;color:#8f8b8b;text-align:left;padding-bottom:5px">International(Without Lounge) | 1 Adult</span>
                                                                        <span style="display:block;font-size:22px;line-height:24px;font-family:sans-serif;color:#242424;text-align:left;margin-left:auto">INR 2000</span>
                                                                        </span>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2" style="background-color: #f6f6f6;border-radius: 8px;border:1px solid #eaeaea;padding:12px;margin:12px 0 0;">
                                                                    <div style="padding: 16px;box-sizing: border-box;">
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
                                                                            <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">
                                                                                If you wish to reschedule any of your booked service, please contact +91 8610725198 or write us to support@airportzo.com
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                  </td>
                                                                </tr>
                                                            </table>
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
                            <div style="border-top: 1px solid #f2f2f2;width: 90%;margin:0 auto;"></div>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <table style="width: 90%;margin: auto;padding: 30px 0px 0px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;margin-bottom:10px">Order ID : 1234567</p>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;margin-bottom:10px">Booked on : 07 Nov 2022</p>
                                            <p style="font-size:22px;line-height:30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: normal;margin:0;margin-bottom:10px">Passengers : 1 Adult</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>';
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
                                                       <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">Chennai International Airport</p>
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
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">Terminal 1 (Departure)</p>
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
                                                       <p style="display:block;font-size:18px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;font-weight: normal;margin:0;">Departure Flight number</p>
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">123456</p>
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
                                                        <p style="display:block;font-size: 24px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;font-weight: 700;margin:0;">07 Nov 2022 13:00</p>
                                                   </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table style="width: 100%;background-color:#22c482;">
                                                <tbody>';
                                    $mail_template .= '<tr>
                                                        <td>
                                                            <span style="display: flex;align-items:center;justify-content:space-between;width: 90%;margin: 30px auto;">
                                                                <span style="display:block;font-size: 30px;line-height: 35px;font-family: sans-serif;color: #fff;text-align: left;font-weight: 700;">International-Departure-Silver (Adult -1)(Children - 1)</span>
                                                                <span style="display:none;font-size: 24px;line-height: 35px;font-family: sans-serif;color: #fff;text-align:left;font-weight:700;margin-left:auto;">INR 1234</span>
                                                            </span>
                                                        </td>
                                                    </tr>';
                                $mail_template .= '</tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </th>
                    </tr>';

        
            
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
                                            <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Pravin</span>
                                            <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 383747883 | pras@gmail.com</span>
                                            <span style="display:none;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">(Age : ' . $contact_passenger->age . ')</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
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
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                <span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Pravin</span>
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 383747883 | pras@gmail.com</span>
                                                    <span style="display:none;font-size: 14px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">' . $other_passenger_value->age . '</span>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;padding: 20px 30px;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="display:block;font-size: 22px;line-height: 30px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 5px;font-weight: 700;">Greeter details</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="display:flex;padding-bottom: 12px;">
                                                <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;margin-right: 6px;">1)</span>
                                                <span>
                                                    <span style="display:block;font-size:22px;line-height:24px;font-family: sans-serif;color: #242424;text-align: left;padding-bottom: 3px;">Mr. Pravin</span>
                                                    <span style="display:block;font-size: 18px;line-height: 20px;font-family: sans-serif;color: #8f8b8b;text-align: left;padding-bottom: 5px;">+91 383747883 | pras@gmail.com</span>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>';
 
                
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

    public function test_content() {
        $mail_template = '<table cellpadding="0" cellspacing="0" border="0" style="width: 100%;background-color: #fff;max-width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px;box-sizing: border-box;">
                           <div style="padding: 10px 0 32px;text-align: center;border-bottom:2px solid #eaeaea;">
                              <img style="max-width: 250px;width:100%;" src="https://airportzostage.in/mail-template/Airportzo_logo@2x.png" alt="">
                           </div>
                           <div>
                              <p style="font-size:18px;font-family: sans-serif;font-weight: 500;">Dear Mr.Suresh,</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 10px;">Greetings from AirportZo!!</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0 0 20px;">We are sorry to know that you have cancelled your booking.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0px 0 20px;">We regret to inform you that there will be cancellation charges levied on your booking by service providers (as mentioned per the cancellation charge below), plus an AirportZo cancellation fee of Rs.200/-per order.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0px 0 20px;">We will cancel your booking and process the refund as requested. The refunded amount will reflect in your account in 5-6 business days.</p>
                              <p style="color:#4b4b4b;font-size:18px;font-family: sans-serif;margin: 0px 0 20px;">We look forward to serving you soon. Meanwhile, if you have any further questions, please contact us at <br/><span style="color: #000;font-weight: 500; "> +91-861-072-5198</span> or mail us at <a style="color: #0091ff;" href="mailto:support@airportzo.com">support@airportzo.com</a></p>
                           </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;background-color: #07b4d2;padding: 24px 40px;box-sizing: border-box;">
                          <div style="background-color: #fff;border-radius: 12px;padding: 22px 28px 16px;">
                            <div style="text-align: center;">
                                <span style="background-color: #f36464;color:#fff;padding:7px 10px;border-radius:6px;font-family:  sans-serif;font-weight: 500;letter-spacing: 1.5px;">BOOKING CANCELLED</span>
                            </div>
                            <div style="text-align:center;">
                                <h2 style="font-family: sans-serif;text-align: center;margin:16px 0 10px;">MAA - DXB - FRA</h2>
                                <p style="font-size:16px;font-family: sans-serif;text-align: center;margin:10px 0;color: #4b4b4b;">22 Jul 2022, 16.30(GMT+1) to 05 Aug 2022, 11:00(GMT+2)</p>
                            </div>
                            <div style="text-align: center;border-bottom: 1px solid #eaeaea;margin-top:16px;margin-bottom: 24px;height:16px;">
                                <img src="https://airportzostage.in/mail-template/circle-plane.png" alt="" style="margin-bottom: -18px;">
                            </div>
                            <table style="width: 100%;" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family: sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking ID</p>
                                            <p style="font-size: 16px;font-family: sans-serif;margin: 0;">97678298</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family: sans-serif;color:#8E8F91;margin: 0 0 5px;">Booking Date</p>
                                            <p style="font-size: 16px;font-family: sans-serif;margin: 0;">24 Jun 2022</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family: sans-serif;color:#8E8F91;margin: 0 0 5px;">Passengers</p>
                                            <p style="font-size: 16px;font-family: sans-serif;margin: 0;">2 Adults, 2 Children</p>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <p style="font-size: 13px;font-family: sans-serif;color:#8E8F91;margin: 0 0 5px;">Total Services</p>
                                            <p style="font-size: 16px;font-family: sans-serif;margin: 0;">4 services</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                        <div style="max-width: 650px;margin: 0 auto;padding: 24px 40px 5px;box-sizing: border-box;">
                            <h3 style="font-size:18px;font-family:  sans-serif;margin-top:0;margin-bottom: 12px;">Services cancelled</h3>
                            <div>
                                <div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <h3 style="font-size:20px;font-family: sans-serif;font-weight: 500;margin:0;">MAA</h3>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b">Chennai International Airport - Terminal 1</p>
                                    <p style="font-size: 14px;font-family:sans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">22 Jul 2022, 16.30(GMT+1)</p>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top" style="width:50px;">
                                                    <img src="https://airportzostage.in/mail-template/pranaam.jpg" alt="" width="50" height="50" style="width:50px;height:50px;border-radius: 50%;margin-right: 5px;">
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <span style="font-size:18px;font-family:sans-serif;font-weight: 700;margin:2px 0 4px;">Pranaam</span>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding:0 0 0 25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                    <div style="max-width:500px;height: 1px;border-bottom: 1px solid #eaeaea;margin: 20px auto 20px;"></div>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top" style="width:50px;">
                                                    <div style="width: 50px;height: 50px;border-radius: 50%;margin-right: 5px;">
                                                        <img src="https://airportzostage.in/mail-template/pranaam.jpg" alt="" width="50" height="50" style="border-radius: 50%;object-fit: contain;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <p style="font-family:sans-serif;font-weight: 500;margin:2px 0 4px;">Pranaam</p>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;background-color: #f6f6f6;">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0" style="background-color: #f6f6f6;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="background-color: #f6f6f6;">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-radius: 12px;border:1px solid #eaeaea;padding:16px;margin-bottom: 12px;">
                                    <p style="font-size:20px;font-family: sans-serif;font-weight: 500;margin:0 0 5px;">MAA</p>
                                    <p style="font-size:16px;font-family:sans-serif;margin:0 0 5px;color: #4b4b4b">Chennai International Airport - Terminal 1</p>
                                    <p style="font-size: 14px;font-family:sans-serif;font-weight: 500;color:#8E8F91;margin: 0 0 16px;">22 Jul 2022, 16.30(GMT+1)</p>
                                    <div>
                                        <div style="margin-bottom: 12px;">
                                          <table style="width:100%;">
                                             <tr>
                                                <td valign="top" style="width:50px;">
                                                    <div style="width: 50px;height: 50px;border-radius: 50%;margin-right: 5px;">
                                                        <img src="https://airportzostage.in/mail-template/primefly.jpg" alt="" width="50" height="50" style="border-radius: 50%;object-fit: contain;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="">
                                                        <p style="font-family:sans-serif;font-weight: 500;margin:2px 0 4px;">Primefly</p>
                                                        <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">Order ID : 865823 <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">16:45(GMT+1)</span></p>
                                                        <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 16px;font-family:sans-serif;color:#8E8F91;margin: 0 0 4px;">    Silver Package : 
                                                                        <span style="padding-left: 8px;margin-left: 8px;border-left: 1px solid #8E8F91">2 Adults</span>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <p style="color: #4b4b4b;font-size: 16px;font-family:sans-serif;margin: 0;text-align: right;margin-right: 16px;">₹,1000</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                             </tr>
                                          </table>
                                        </div>
                                        <div style="border-radius: 8px;border:1px solid #eaeaea;background-color: #f6f6f6;padding: 16px;box-sizing: border-box;">
                                          <div style="margin-bottom: 16px;">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Cancellation Policy
                                             </p>
                                             <table style="width:100%;table-layout: fixed;" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">48 hours before - Full Refund</li>
                                                             </ul>
                                                        </td>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">24 hours before - 25% of fare</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul style="margin:4px 0;">
                                                                <li style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;">After 12 hours - No Refund</li>
                                                             </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                          <div style="">
                                             <p style="font-size: 14px;font-family:sans-serif;color:#8E8F91;font-weight: 500;margin: 0 0 8px;">
                                                <img src="https://airportzostage.in/mail-template/info.png" alt="" valign="top" style="margin-right: 5px;">
                                                Reschedule Policy
                                             </p>
                                             <p style="color:#4b4b4b;font-size: 14px;font-family: sans-serif;padding-left:25px;margin:0 0 8px;line-height: 20px;">If you wish to reschedule any of your booked service, please contact <br/><span>+91 8610725198</span> or write us to support@airportzo.com</p>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 20px;padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Contact Passenger details</p>
                                    <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">Mr. Gerard Nigel</p>
                                    <p style="color:#8E8F91;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                    <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                </div>
                                <div>
                                    <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Other Passenger details</p>
                                    <div style="margin-bottom: 12px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">1) Mr. Gerard Nigel</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                        <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                    </div>
                                    <div style="margin-bottom: 16px;">
                                        <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">2) Mr. Gerard Nigel</p>
                                        <p style="color:#8E8F91;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">+ 91 734648778</p>
                                        <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">(32 yrs)</p>
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">Flight Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;"><span>MAA</span> Flight Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="margin-bottom: 22px;">
                                    <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">E-Ticket</p>
                                </div>
                            </div>
                            <div style="padding: 20px 16px;border-top: 1px solid #eaeaea;">
                                <div>
                                    <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:8px;">GSTIN Details</p>
                                    <table style="width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">Company Name</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                            <td>
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">GST Number</p>
                                                <p style="color:#4b4b4b;font-size:16px;font-family:  sans-serif;margin:0 0 5px;">IE76576</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #f6f6f6;border-top:2px solid #eaeaea;max-width: 650px;margin: 0 auto;padding: 24px 56px 24px;box-sizing: border-box;">
                            <p style="font-size:16px;font-family:  sans-serif;font-weight: 500;margin-top:0;margin-bottom:24px;">Customer Support</p>
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
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">Mail Us</p>
                                                <a href="mailto:support@airportzo.com"style="color:#00b9f5;font-size:16px;font-family:  sans-serif;margin:0 0 5px;text-decoration: none;">support@airportzo.com</a>
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
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">Call Us (Toll Free)</p>
                                                <p style="font-size:16px;font-family:  sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
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
                                                <p style="color:#8E8F91;font-size:13px;font-family:  sans-serif;margin:0 0 5px;">Whatsapp</p>
                                                <p style="font-size:16px;font-family:  sans-serif;margin:0 0 5px;text-decoration: none;">+91 8610725198</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>';
        return $mail_template;
    }
}

?>

