<?php
class InvoiceTemplateOrder {
    public $invoice_obj;
    
    public function genInvoiceForOrder() {
        $gst_nos = '';
        $state_name = '';
        $ut_codes = '';
        $company_names = '';
        $tax_types = '';
        foreach ($this->invoice_obj->order_detail as $order_values) {
            $check_cart_coupon_type = '';
            foreach ($order_values->order_detail_array as $services_keys1 => $services_values1) {
                $gst_nos = $services_values1->gst_no;
                $state_name = $services_values1->place_serv;
                $ut_codes = $services_values1->ut_code;
                $pan_no = $services_values1->pan_no;
                $company_names = $services_values1->company_names;
                $address = $services_values1->address;
                $tax_types = $services_values1->tax_type;
            }
        }
        $invoice_html = '<table style="width:100%" cellspacing="0" cellpadding="0">
                    <thead style="bgcolor: #fbfbfb;">
                        <tr>
                            <th style="width:66%">
                                <img src="https://airportzo.net.in/invoince-template/airportzo-logo.png" alt="logo" style="width:200px">
                            </th>
                            <th style="">
                                <span>
                                    <strong style="font-size: 24px;font-weight:800;">Tax Invoice</strong>
                                    <span style="color:#000000;font-size:14px;">(Original for Recipient)</span>
                                </span>
                                <br>
                                <span>
                                    <span style="font-size:14px;">Invoice No : ' . $this->invoice_obj->booking_invoice_token . '</span>
                                </span>
                                <br>
                                <span>
                                    <span style="font-size:14px;">Date : ' . $this->invoice_obj->date_time . '</span>
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <th style="width:72%">
                                <div>
                                    <span style="">
                                        <span style="font-size: 30px;width:100%;">' . ucwords($this->invoice_obj->passenger_detail[0]->passenger_array[0]->name_view) . '</span>
                                        <br>
                                        <span style="">
                                            <span style="font-size:13px;">' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->mobile_view . ' | ' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->email_id . '</span>
                                        </span>';
                                        if($this->invoice_obj->pancard_number != ''){
                                            $invoice_html .= '<br>
                                                            <span style="">
                                                                <span style="font-size:13px;">Pan No :</span>
                                                                <span style="font-size:13px;">' . $this->invoice_obj->pancard_number . '</span>
                                                            </span>';
                                        }
                                        if($this->invoice_obj->gst_name != ''){
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
                                                    <span style="font-size:13px;width:100%;text-align:left;">Place of service : '.$state_name.' State /UT code : '.$ut_codes.'</span>
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
                        $check_cart_coupon_type = '';
                        foreach ($order_value->order_detail_array as $services_keys => $services_values) {
                            $check_cart_coupon_type = $services_values->cart_coupon_type;
                        }
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
                                                <th style="width:6%;font-size: 11px;border-bottom:2px solid #f2f2f2;" >
                                                    <b>Sl.No</b>
                                                </th>
                                                <th style="width:23%;font-size: 11px;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Description</b>
                                                </th>
                                                <th style="width:11%;font-size: 11px;height:25px;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Type</b>
                                                </th>
                                                <th style="width:5%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Qty</b>
                                                </th>
                                                <th style="width:7%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Service Price</b>
                                                </th>';
                            // if($check_cart_coupon_type != 'Incl Gst'){
                                $invoice_html .= '<th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Discount</b>
                                                    </th>
                                                    <th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Net Service Price</b>
                                                    </th>
                                                    <th style="width:9%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                                        <br>
                                                        <b>Taxable Value</b>
                                                    </th>';
                            // }
                                                
                            $invoice_html .= '<th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Tax Rate</b>
                                                </th>
                                                <th style="width:7%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Tax Amount</b>
                                                </th>';
                            // if($check_cart_coupon_type == 'Incl Gst'){
                            //     $invoice_html .= '<th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                            //                             <br>
                            //                             <b>NET AMT</b>
                            //                         </th>
                            //                         <th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                            //                                 <br>
                            //                             <b>DISCOUNT</b>
                            //                         </th>';
                            // }
                            $invoice_html .= '<th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                    <b>Total Amount</b>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                        foreach ($order_value->order_detail_array as $service_key => $service_value) {
                            $invoice_html .= '
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . ($service_key+1) . '</span>
                                                </td>
                                                <td>
                                                    <strong style="font-size:14px;width:100%;">' . $service_value->service_name . '</strong>
                                                    <br>
                                                    <span style="font-size: 10px;">' . $service_value->company_name . '</span>
                                                    <br>
                                                    <span style="font-size: 10px;">HSN Code: 996761</span>
                                                </td>
                                                <td>
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">Adult</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                                    if($service_value->total_additionalAdult_pdf != 0){
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">Additional Adult</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                    }
                                    if ($service_value->totalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">Child</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                    }
                                    if ($service_value->total_additionalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">Additional Child</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                    }
                                    $invoice_html .= '</td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . $service_value->totalAdult_pdf . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>';
                                    if ($service_value->total_additionalAdult_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->total_additionalAdult_pdf . '</span>
                                                                <br><br>
                                                            </td>
                                                          </tr>';
                                    }
                                    if ($service_value->totalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->totalChildren_pdf . '</span>
                                                                <br><br>
                                                            </td>
                                                          </tr>';
                                    }
                                    if ($service_value->total_additionalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->total_additionalChildren_pdf . '</span>
                                                                <br><br>
                                                            </td>
                                                          </tr>';
                                    }
                                    $invoice_html .= '</td>
                                                        <td style="text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . $service_value->adult_serv_amt . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>';
                                    if ($service_value->total_additionalAdult_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . $service_value->add_adult_service_amount . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>';
                                    }
                                    if ($service_value->totalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . $service_value->child_serv_amt . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>';
                                    }
                                    if ($service_value->total_additionalChildren_pdf != 0) {
                                        $invoice_html .= '<tr>
                                                                <td>
                                                                    <span style="font-size: 12px;">' . $service_value->add_children_service_amount . '</span>
                                                                    <br><br>
                                                                </td>
                                                            </tr>';
                                    }
                                        $invoice_html .= '</td>';
                        // if($service_value->cart_coupon_type != 'Incl Gst'){
                            $invoice_html .= '<td style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->adult_discount . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            if ($service_value->total_additionalAdult_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_adult_discount . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                            if ($service_value->totalChildren_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->child_discount . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                            if ($service_value->total_additionalChildren_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_child_discount . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                                $invoice_html .= '</td>
                                                <td style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->adult_net_amt . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            if ($service_value->total_additionalAdult_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_adult_net_amt . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                            if ($service_value->totalChildren_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->child_net_amt . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                            if ($service_value->total_additionalChildren_pdf != 0) {
                                $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_child_net_amt . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                            }
                            $invoice_html .= '</td>
                                              <td style="text-align:center;">
                                                        <tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->adult_taxable_val . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                if ($service_value->total_additionalAdult_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->add_adult_taxable_val . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                }
                                if ($service_value->totalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->child_taxable_val . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                }
                                if ($service_value->total_additionalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                            <td>
                                                                <span style="font-size: 12px;">' . $service_value->add_child_taxable_val . '</span>
                                                                <br><br>
                                                            </td>
                                                        </tr>';
                                }
                                $invoice_html .= '</td>';
                        // }
                        $invoice_html .= '<td style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        if ($service_value->total_additionalAdult_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->totalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->total_additionalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                        $invoice_html .= '</td>
                                                <td style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->adult_tax_amt1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->adult_tax_amt2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        if ($service_value->total_additionalAdult_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_adult_tax_amt1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->add_adult_tax_amt2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->totalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->child_tax_amt1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->child_tax_amt2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->total_additionalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_child_tax_amt1 . '</span>
                                                            <br>
                                                            <span style="font-size: 12px;">' . $service_value->add_child_tax_amt2 . '</span>
                                                            <br>
                                                        </td>
                                                    </tr>';
                        }
                            $invoice_html .= '</td>';
                        // if($service_value->cart_coupon_type == 'Incl Gst'){
                        //     $invoice_html .= '<td style="text-align:center;">
                        //                             <tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->adult_net_amt . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     if ($service_value->total_additionalAdult_pdf != 0) {
                        //         $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->add_adult_net_amt . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     if ($service_value->totalChildren_pdf != 0) {
                        //         $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->child_net_amt . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     if ($service_value->total_additionalChildren_pdf != 0) {
                        //         $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->add_child_net_amt . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     $invoice_html .= '</td>
                        //                         <td style="text-align:center;">
                        //                             <tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->adult_discount . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     if ($service_value->total_additionalAdult_pdf != 0) {
                        //             $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->add_adult_discount . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     if ($service_value->totalChildren_pdf != 0) {
                        //             $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->child_discount . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     if ($service_value->total_additionalChildren_pdf != 0) {
                        //             $invoice_html .= '<tr>
                        //                                 <td>
                        //                                     <span style="font-size: 12px;">' . $service_value->add_child_discount . '</span>
                        //                                     <br><br>
                        //                                 </td>
                        //                             </tr>';
                        //     }
                        //     $invoice_html .= '</td>';
                        // }
                        $invoice_html .= '<td style="text-align:center;">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->adult_sub_total . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                        if ($service_value->total_additionalAdult_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_adult_sub_total . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->totalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->child_sub_total . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                        }
                        if ($service_value->total_additionalChildren_pdf != 0) {
                                    $invoice_html .= '<tr>
                                                        <td>
                                                            <span style="font-size: 12px;">' . $service_value->add_child_sub_total . '</span>
                                                            <br><br>
                                                        </td>
                                                    </tr>';
                        }
                            $invoice_html .= '</td>
                                            </tr>';
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
                                                                <span style="font-size: 12px;">Total Amount</span>
                                                            </td>
                                                            <td style="width:40%;text-align:right;line-height:25px;">
                                                                <span style="font-size: 12px;">₹ ' . ((float)$this->invoice_obj->service_amount +  (float)$this->invoice_obj->service_gst). '</span>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:50%;line-height:25px;text-align:left;">
                                                                <span style="font-size: 12px;">Convenience Fee</span>
                                                            </td>
                                                            <td style="width:40%;text-align:right;line-height:25px;">
                                                                <span style="font-size: 12px;">₹ ' . $this->invoice_obj->convenience_fee . '</span>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>';
                                                        if($tax_types == '2'){
                                                            $invoice_html .= '<tr>
                                                                                <td style="width:50%;line-height:25px;text-align:left;">
                                                                                    <span style="font-size: 12px;">9% CGST on convenience fee</span>
                                                                                </td>
                                                                                <td style="width:40%;text-align:right;line-height:25px;">
                                                                                    <span style="font-size: 12px;">₹ ' . ($this->invoice_obj->convenience_fee * 0.09) . '</span>
                                                                                </td>
                                                                                <td>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width:50%;line-height:25px;text-align:left;">
                                                                                    <span style="font-size: 12px;">9% SGST on convenience fee</span>
                                                                                </td>
                                                                                <td style="width:40%;text-align:right;line-height:25px;">
                                                                                    <span style="font-size: 12px;">₹ ' . ($this->invoice_obj->convenience_fee * 0.09) . '</span>
                                                                                </td>
                                                                                <td>
                                                                                </td>
                                                                            </tr>';
                                                        }else{
                                                            $invoice_html .= '<tr>
                                                                                <td style="width:50%;line-height:25px;text-align:left;">
                                                                                    <span style="font-size: 12px;">9% IGST on convenience fee</span>
                                                                                </td>
                                                                                <td style="width:40%;text-align:right;line-height:25px;">
                                                                                    <span style="font-size: 12px;">₹ ' . $this->invoice_obj->cf_tax . '</span>
                                                                                </td>
                                                                                <td>
                                                                                </td>
                                                                            </tr>';
                                                        }
                                                        
                                        $invoice_html .= '<tr>
                                                            <td style="width:50%;line-height:25px;text-align:left;">
                                                                <b style="font-size: 18px;">Grand Total</b>
                                                            </td>
                                                            <td style="width:40%;text-align:right;line-height:25px;">
                                                                <b style="font-size: 18px;">₹ ' . $this->invoice_obj->total_amount . '</b>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="text-align:left;">
                                                                <span style="font-size: 12px;line-height: 16px;">Total Amount in Words : '.$this->amount_inWords($this->invoice_obj->total_amount).'</span>
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
        return ucfirst($result . "only");
    }
}
