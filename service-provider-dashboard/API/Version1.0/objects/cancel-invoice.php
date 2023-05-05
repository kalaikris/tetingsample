<?php
class InvoiceTemplateOrder {
    public $invoice_obj;
    public $order_detail_token;
    public $invoice_token;
    public $cancelled_date;
    
    public function genInvoiceForCancel() {
        $gst_nos = '';
        $state_name = '';
        $ut_codes = '';
        $company_names = '';
        $tax_types = '';
        $grand_total = 0;
        foreach ($this->invoice_obj->order_detail as $order_values) {
            $check_cart_coupon_type = '';
            foreach ($order_values->order_detail_array as $services_keys1 => $services_values1) {
                $gst_nos = $services_values1->gst_no;
                $state_name = $services_values1->place_serv;
                $ut_codes = $services_values1->ut_code;
                $pan_no = $services_values1->pan_no;
                $address = $services_values1->address;
                $company_names = $services_values1->company_names;
                $tax_types = $services_values1->tax_type;
            }
        }
        $invoice_html = '<table style="width:100%" cellspacing="0" cellpadding="0">
                            <thead style="bgcolor: #fbfbfb;">
                                <tr>
                                    <th style="width:66%">';
                                    if($this->invoice_obj->booking_type != 'Whitelabel' && $this->invoice_obj->booking_type != 'External Api'){
                                        $invoice_html .= '<img src="https://airportzo.net.in/invoince-template/airportzo-logo.png" alt="logo" style="width:200px">';
                                    }else{
                                        $invoice_html .= '<img src="' . $this->invoice_obj->header_logo . '" alt="logo" style="width:200px">';
                                    }
                                        
                $invoice_html .= '</th>
                                    <th style="">
                                        <span>
                                        <strong style="font-size: 20px;font-weight:800;">Credit Note</strong><span style="color:#000000;font-size:14px;">(Original for Recipient)</span>
                                        </span>
                                        <br>
                                        <span>
                                            <span style="font-size:14px;">Credit Note Number : ' . $this->invoice_token . '</span>
                                        </span>
                                        <br>
                                        <span>
                                            <span style="font-size:14px;">Original Invoice No : ' . $this->invoice_obj->booking_invoice_token . '</span>
                                        </span>
                                        <br>
                                        <span>
                                            <span style="font-size:14px;">Cancelled Date : ' . $this->cancelled_date . '</span>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:72%">
                                        <div>
                                            <span style="">';
                                            if($this->invoice_obj->agent_boolean == true){

                                                $invoice_html .= '<span style="font-size: 30px;width:100%;">' . ucwords($this->invoice_obj->agent_name) . '</span>
                                                                    <br>
                                                                    <span style="">
                                                                        <span style="font-size:13px;">' . $this->invoice_obj->agent_mobile . ' | ' . $this->invoice_obj->agent_email . '</span>
                                                                    </span>';
                                            }else{
                                                $invoice_html .= '<span style="font-size: 30px;width:100%;">' . ucwords($this->invoice_obj->passenger_detail[0]->passenger_array[0]->name_view) . '</span>
                                                                    <br>
                                                                    <span style="">
                                                                        <span style="font-size:13px;">' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->mobile_view . ' | ' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->email_id . '</span>
                                                                    </span>';
                                            }
                                                
                                            if($this->invoice_obj->pancard_number != ''){
                                                $invoice_html .= '<br>
                                                                <span style="">
                                                                    <span style="font-size:13px;">Pan No :</span>
                                                                    <span style="font-size:13px;">' . $this->invoice_obj->pancard_number . '</span>
                                                                </span>';
                                            }
                                            if($this->invoice_obj->gst_name != '' && $this->invoice_obj->agent_boolean == false){
                                                $invoice_html .= '<br>
                                                                <span style="">
                                                                    <span style="font-size:13px;">Company Name :</span>
                                                                    <span style="font-size:13px;">' . $this->invoice_obj->gst_name . '</span>
                                                                </span>';
                                            }
                                            if($this->invoice_obj->gst_number != ''){
                                                $invoice_html .= '<br>
                                                                <span style="">
                                                                    <span style="font-size:13px;">GST No :</span>
                                                                    <span style="font-size:13px;">' . $this->invoice_obj->gst_number . '</span>
                                                                </span>';
                                            }
                    $invoice_html .= '</span>
                                        <br>
                                        <span style="">
                                        <br>
                                            <span style="">
                                                <b style="font-size: 16px;">Booking Details :</b>
                                            </span>
                                            <br>
                                            <span style="">
                                                <span style="font-size:13px;">Booking Reference No :</span>
                                                <span style="font-size:13px;">' . $this->invoice_obj->booking_number . '</span>
                                            </span>
                                            <br>
                                            <span style="">
                                                <span style="font-size:13px;">Booking Date :</span>
                                                <span style="font-size:13px;">' . $this->invoice_obj->date_time . '</span>
                                            </span>
                                            <br>
                                            <span style="">
                                                <span style="font-size:13px;">Payment ID :</span>
                                                <span style="font-size:13px;">' . $this->invoice_obj->payment_id . '</span>
                                            </span>
                                        </span>
                                    </div>
                                </th>
                                <th style="width:28%">
                                    <div><span style="text-align:left;"><span style="font-size: 17px;">Sold by:</span><br><span style="font-size:13px;">' . $company_names . '</span><br><span><span style="font-size:13px;">' . $address . '</span></span><br><span style=""><span style="font-size:13px;">PAN NO : ' . $pan_no . ',</span></span><br><span style=""><span style="font-size:13px;">GST Registration No : '.$gst_nos.'</span></span><br><span style=""><span style="font-size:13px;">UT code : '.$ut_codes.'</span></span>
                                        </span>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:64%"></th>
                                <th style="width:36%">
                                    <table style="width:100%;text-align:left;" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span style="width:100%;">
                                                        <span style="font-size:13px;width:100%;">Place of service : '.$state_name.' State /UT code : '.$ut_codes.'</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                        </thead>
                    <tbody style="width: 100%;">';
                    foreach ($this->invoice_obj->order_detail as $order_value) {

                        $cancel_type = false;
                        foreach ($order_value->order_detail_array as $services_keys => $services_values) {
                            if ($services_values->token == $this->order_detail_token && $services_values->can_be_cancelled){
                                $cancel_type = true;
                                $grand_total += $services_values->cancellation_detail->refund_amount;
                                break;
                            }
                        }
                        if($cancel_type == true){
                            $invoice_html .= '<tr>
                            <td width="100%">
                                <div>
                                    <table style="width:100%;" border="0" cellspacing="0" cellpadding="4">
                                        <thead>
                                            <tr>
                                                <th colspan="5">
                                                    <strong style="width:100%;font-size: 22px;">' . $order_value->airport_code . ' - ' . $order_value->terminal_name . '</strong>
                                                    <br>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:5%;font-size: 11px;border-bottom:2px solid #f2f2f2;" >
                                                        <b>Sl.No</b>
                                                    </th>
                                                    <th style="width:20%;font-size: 11px;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Description</b>
                                                    </th>
                                                    <th style="width:6%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Service Price</b>
                                                    </th>
                                                    <th style="width:7%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Discount Offered</b>
                                                    </th>
                                                    <th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Net Service Price Collected</b>
                                                    </th>
                                                    <th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;vertical-align:top;" valign="top">
                                                        <br>
                                                        <b>Convenience Fee Incl GST</b>
                                                    </th>
                                                    <th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Cancellation Charges</b>
                                                    </th>
                                                    <th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Amount to be refunded to customer</b>
                                                    </th>
                                                    <th style="width:7%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Taxable Value</b>
                                                    </th>
                                                    <th style="width:7%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Tax Rate</b>
                                                    </th>
                                                    <th style="width:7%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Tax Amount</b>
                                                    </th>
                                                    <th style="width:6%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Total Amount</b>
                                                    </th>
                                                </tr>
                                        </thead>
                                    <tbody>';
                        }
                        $service_val = 0;
                            foreach ($order_value->order_detail_array as $service_key => $service_value) {
                                if ($service_value->token == $this->order_detail_token && $service_value->can_be_cancelled){
                                    $service_cost = 0;
                                    $service_discount = 0;
                                    $service_collectamount = 0;
                                    $service_val++;

                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . ($service_val) . '</span>
                                                        </td>
                                                        <td>
                                                            <strong style="font-size:14px;width:100%;">' . $service_value->service_name . '</strong>
                                                            <br>
                                                            <span style="font-size: 10px;">' . $service_value->company_name . '</span>
                                                            <br>
                                                            <span style="font-size: 10px;">HSN Code: 996761</span>
                                                        </td>';
                                        
                                        $service_cost = $service_value->adult_serv_amt;
                                        if ($service_value->total_additionalAdult_pdf != 0) {
                                            $service_cost += $service_value->add_adult_service_amount;
                                        }
                                        if ($service_value->totalChildren_pdf != 0) {
                                            $service_cost += $service_value->child_serv_amt;
                                        }
                                        if ($service_value->total_additionalChildren_pdf != 0) {
                                            $service_cost += $service_value->add_children_service_amount;
                                        }
                                    $invoice_html .= '<td style="text-align:center;">
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_cost . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>
                                                        </td>';
                                        $service_discount = $service_value->adult_discount;
                                        
                                        if ($service_value->total_additionalAdult_pdf != 0) {
                                            $service_discount += $service_value->add_adult_discount;
                                        }
                                        if ($service_value->totalChildren_pdf != 0) {
                                            $service_discount += $service_value->child_discount;
                                        }
                                        if ($service_value->total_additionalChildren_pdf != 0) {
                                            $service_discount += $service_value->add_child_discount;
                                        }
                                    $invoice_html .= '<td style="text-align:center;">
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_discount . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>
                                                    </td>';
                                    $service_collectamount = $service_value->adult_sub_total;
                                    if ($service_value->total_additionalAdult_pdf != 0) {
                                        $service_collectamount += $service_value->add_adult_sub_total;
                                    }
                                    if ($service_value->totalChildren_pdf != 0) {
                                        $service_collectamount += $service_value->child_sub_total;
                                    }
                                    if ($service_value->total_additionalChildren_pdf != 0) {
                                        $service_collectamount += $service_value->add_child_sub_total;
                                    }
                                    $invoice_html .= '<td style="text-align:center;">
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_collectamount . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>
                                                    </td>';
                                // if($this->invoice_obj->agent_boolean == true){
                                    $conv_collectamount = $service_value->agent_conv_fee_commi + $service_value->gst_agent_conv_fee_commi + $service_value->user_conv_fee_commi + $service_value->gst_user_conv_fee_commi;
                                    $invoice_html .= '<td style="text-align:center;">
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $conv_collectamount . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>
                                                    </td>';
                                // }
                                    $invoice_html .= '<td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format(($service_value->cancellation_detail->cancellation_fee + $service_value->cancellation_detail->airportzo_fee), 2, '.', '') . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format($service_value->cancellation_detail->refund_amount, 2, '.', '') . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format(($service_value->cancellation_detail->refund_amount * 100)/118, 2, '.', '') . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>
                                                        </td>';
                                    if($service_value->tax_type == 2){
                                        $invoice_html .= '<td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">9% CGST</span>
                                                                    <br>
                                                                    <span style="font-size: 12px;">9% SGST</span>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format((($service_value->cancellation_detail->refund_amount * 100)/118)*0.09, 2, '.', '') . '</span>
                                                                    <br>
                                                                    <span style="font-size: 12px;">' . number_format((($service_value->cancellation_detail->refund_amount * 100)/118)*0.09, 2, '.', '') . '</span>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                        </td>';
                                    }else{
                                        $invoice_html .= '<td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">18% IGST</span>
                                                                    <br>
                                                                    <span style="font-size: 12px;"></span>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format((($service_value->cancellation_detail->refund_amount * 100)/118)*0.18, 2, '.', '') . '</span>
                                                                    <br>
                                                                    <span style="font-size: 12px;"></span>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                        </td>';
                                    }
    
                                    $invoice_html .= '<td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . number_format($service_value->cancellation_detail->refund_amount, 2, '.', '') . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>
                                                        </td>
                                                    </tr>';
                                }
                            }
                        unset($service_value);
                        $invoice_html .= '</tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>';
                    }
                    unset($order_value);
                    $invoice_html .= '<tr>
                            <td>
                                <div style="width:100%;">
                                    <table style="width:100%;margin:auto" border="0" cellpadding="4">
                                        <tbody>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:50%;line-height:25px;text-align:left;">
                                                                <b style="font-size: 18px;">Grand Total</b>
                                                            </td>
                                                            <td style="width:40%;text-align:right;line-height:25px;">
                                                                <b style="font-size: 18px;">₹ ' . $grand_total . '</b>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="text-align:left;">
                                                                <span style="font-size: 12px;line-height: 16px;">Total Amount in Words : '.$this->amount_inWords($grand_total).'</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width:100%;" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td style="line-height: 32px;">
                                                <span style="font-size: 18px;">Powered by:</span>
                                            </td>
                                            <td style="line-height: 32px;text-align:right;">
                                                <span style="font-size: 18px;">
                                                    <b>For Airportzo India PVT Limited</b>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <img src="https://airportzo.net.in/invoince-template/airportzo-logo.png" alt="logo" style="width:180px;">
                                            </td>
                                            <td style="text-align:right;">
                                            <img src="https://airportzo.net.in/invoince-template/signature.png" alt="logo" style="width:150px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="font-size: 14px;">Whether tax is payable under reverse charge - No </span>
                                            </td>
                                            <td style="text-align:right">
                                                <span style="font-size: 14px;">Authorized Signatory</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                <table>';
                return $invoice_html;
    }
    public function amount_inWords($numbers){
        $number = (int)$numbers;
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
         '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
         '7' => 'seven', '8' => 'eight', '9' => 'nine',
         '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
         '13' => 'thirteen', '14' => 'fourteen',
         '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
         '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
         '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
         '60' => 'sixty', '70' => 'seventy',
         '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
          $divider = ($i == 2) ? 10 : 100;
          $number = floor($no % $divider);
          $no = floor($no / $divider);
          $i += ($divider == 10) ? 1 : 2;
          if ($number) {
             $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
             $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
             $str [] = ($number < 21) ? $words[$number] .
                 " " . $digits[$counter] . $plural . " " . $hundred
                 :
                 $words[floor($number / 10) * 10]
                 . " " . $words[$number % 10] . " "
                 . $digits[$counter] . $plural . " " . $hundred;
          } else $str[] = null;
       }
       $str = array_reverse($str);
       $result = implode('', $str);
       $points = ($point) ?
         "." . $words[$point / 10] . " " . 
               $words[$point = $point % 10] : '';
    //    echo $result . "Rupees  " . $points . " Paise";
        if($result == ''){
            $result = 'Zero ';
        }
        return ucfirst($result . "only");
    }
}
?>