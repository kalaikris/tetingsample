<?php
class InvoiceTemplateOrder {
    public $invoice_obj;
    
    public function genInvoiceForOrder() {
        $invoice_html = '<table style="width:100%" cellspacing="0" cellpadding="0">
            <thead style="bgcolor: #fbfbfb;">
                <tr>
                    <th style="">
                        <img src="https://www.sterlingholidays.com/logos/sterling-logo.png" alt="logo" style="width:200px">
                    </th>
                    <th style="">
                        <span>
                            <strong style="font-size: 24px;font-weight:800;">Tax Invoice</strong>
                            <span style="color:#000000;font-size:14px;">(Original for Recipient)</span>
                        </span>
                        <br>
                        <span>
                            <span style="font-size:14px;">Invoice No : ' . $this->invoice_obj->token . ' | Date : ' . $this->invoice_obj->date_time . '</span>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th style="width:60%">
                        <div>
                            <span style="">
                                <span style="font-size: 30px;width:100%;">' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->name_view . '</span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->mobile_view . ' | ' . $this->invoice_obj->passenger_detail[0]->passenger_array[0]->email_id . '</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Pan No :</span>
                                    <span style="font-size:13px;">' . $this->invoice_obj->pancard_number . '</span>
                                </span>
                            </span>
                            <br>
                            <span style="">
                            <br>
                                <span style="">
                                    <b style="font-size: 18px;">Booking Details</b>
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
                    <th style="width:40%">
                        <div>
                            <span style="">
                                <span style="font-size: 18px;font-weight:800;">Sold by:</span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Airportzo India PVT Limited,</span>
                                </span>
                                    <br>
                                <span style="">
                                    <span style="font-size:13px;">Midas Cinsulting, P.O.Box 124465,</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Sharjah - U.A.E,</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">PAN NO : JHGJ6968,</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">GST Registration No : JHGJ6968</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">UT code : 245</span>
                                </span>
                            </span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <table style="width:100%;text-align:right;" cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td>
                                        <span style="width:100%;">
                                            <span style="font-size:13px;width:100%;">Place of service : Tamilnadu State /UT code : 33</span>
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
                $invoice_html .= '<tr>
                    <td width="100%">
                        <div>
                            <table style="width:100%;" border="0" cellspacing="0" cellpadding="4">
                                <thead>
                                    <tr>
                                        <th colspan="5">
                                            <strong style="width:100%;font-size: 22px;">' . $order_value->airport_code . ' - ' . $order_value->terminal_name . '</strong>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:7%;font-size: 11px;border-bottom:2px solid #f2f2f2;" >
                                            <b>SL.NO</b>
                                        </th>
                                        <th style="width:25%;font-size: 11px;border-bottom:2px solid #f2f2f2;">
                                            <b>DESCRIPTION</b>
                                        </th>
                                        <th style="width:15%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <b>ADULT PRICE</b>
                                        </th>
                                        <th style="width:12%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <b>ADULT QTY</b>
                                        </th>
                                        <th style="width:15%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <b>CHILDREN PRICE</b>
                                        </th>
                                        <th style="width:12%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <b>CHILDREN QTY</b>
                                        </th>
                                        <th style="width:12%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                            <b>NET AMOUNT</b>
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
                                            <span style="font-size: 12px;">' . $service_value->adult_service_amount . '</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span style="font-size: 12px;">' . $service_value->total_adult . '</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span style="font-size: 12px;">' . $service_value->children_service_amount . '</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span style="font-size: 12px;">' . $service_value->total_children . '</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span style="font-size: 12px;">' . $service_value->net_amount . '</span>
                                        </td>
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
                                                    <td colspan="3" style="text-align:left;">
                                                        <span style="font-size: 12px;line-height: 16px;">Total Qty: ' . $this->invoice_obj->total_service . '</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%;line-height:35px;text-align:left;">
                                                        <b style="font-size: 18px;">Grand Total</b>
                                                    </td>
                                                    <td style="width:40%;text-align:right;line-height:35px;">
                                                        <b style="font-size: 18px;">₹ ' . $this->invoice_obj->total_amount . '</b>
                                                    </td>
                                                    <td>
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
}
