<?php
$source_path='/home/airportzostage/public_html/invoice_pdf/';
$add_page='A4';
$order_number=mt_rand(100,999);
//$invoice_template=invoice_template();
//store_invoice($invoice_template,$order_number,$source_path,$add_page);
function store_invoice($invoice_template,$order_number,$source_path){
    require_once('TCPDF-main/examples/tcpdf_include.php');
    // create new PDF document

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setCreator(PDF_CREATOR);

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
    // set auto page breaks
    $pdf->setAutoPageBreak(true, 10);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php')) {
        require_once(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // $fontname = TCPDF_FONTS::addTTFfont('TCPDF-main/fonts/Rubik-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->setFontSubsetting(true);
    // $pdf->SetMargins(2.175, 8, 2.175);

    $pdf->SetMargins(6, 8, 6);

    // $pdf->setFont($fontname, '', 14, '', false);
    $pdf->setFont('dejavusans', '', 12, '', true);
    $pdf->AddPage('L', $add_page);
    $pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    // Custom code //
    $pdf->setCellHeightRatio(1.2);
    //Set some content to print

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $invoice_template, 0, 1, 0, true, '', true);

    // Delete page 1
    $pdf->deletePage(1);

    $stort_time = strtotime(date("Y-m-d H:i:s"));
    //$stort_time = strtotime($GLOBAL['curDateTime']);
    $fileName   = "invoice_".$order_number.$stort_time.".pdf";

    $global_tcpdf_path = $source_path;//"/home/merchifydev/public_html/development/invoice_pdf/";
    //echo $global_tcpdf_path.$fileName;
    $target_path = ($global_tcpdf_path.$fileName); 
    $pdf->Output($target_path, 'I');//View [I],Download[F]
    return $fileName;
} 
function invoice_template($invoice_obj){
    $gst_nos = '';
    $state_name = '';
    $ut_codes = '';
    foreach ($invoice_obj->order_detail as $order_values) {
        $check_cart_coupon_type = '';
        foreach ($order_values->order_detail_array as $services_keys1 => $services_values1) {
            $gst_nos = $services_values1->gst_no;
            $state_name = $services_values1->place_serv;
            $ut_codes = $services_values1->ut_code;
        }
    }
$invoice_html = '<table style="width:100%" cellspacing="0" cellpadding="0">
            <thead style="bgcolor: #fbfbfb;">
                <tr>
                    <th style="width:66%">
                        <img src="https://www.sterlingholidays.com/logos/sterling-logo.png" alt="logo" style="width:200px">
                    </th>
                    <th style="">
                        <span>
                            <strong style="font-size: 24px;font-weight:800;">Tax Invoice</strong>
                            <span style="color:#000000;font-size:14px;">(Original for Recipient)</span>
                        </span>
                        <br>
                        <span>
                            <span style="font-size:14px;">Invoice No : ' . $invoice_obj->token . ' | Date : ' . $invoice_obj->date_time . '</span>
                        </span>
                    </th>
                </tr>
                <tr>
                    <th style="width:72%">
                        <div>
                            <span style="">
                                <span style="font-size: 30px;width:100%;">' . $invoice_obj->passenger_detail[0]->passenger_array[0]->name_view . '</span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">' . $invoice_obj->passenger_detail[0]->passenger_array[0]->mobile_view . ' | ' . $invoice_obj->passenger_detail[0]->passenger_array[0]->email_id . '</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Pan No :</span>
                                    <span style="font-size:13px;">' . $invoice_obj->pancard_number . '</span>
                                </span>
                            </span>
                            <br>
                            <span style="">
                            <br>
                                <span style="">
                                    <b style="font-size: 16px;">Booking Details :</b>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Booking Reference No :</span>
                                    <span style="font-size:13px;">' . $invoice_obj->booking_number . '</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Booking Date :</span>
                                    <span style="font-size:13px;">' . $invoice_obj->date_time . '</span>
                                </span>
                                <br>
                                <span style="">
                                    <span style="font-size:13px;">Payment ID :</span>
                                    <span style="font-size:13px;">' . $invoice_obj->payment_id . '</span>
                                </span>
                            </span>
                        </div>
                    </th>
                    <th style="width:28%">
                        <div><span style=""><span style="font-size: 17px;">Sold by:</span><br><span style="font-size:13px;">Airportzo India PVT Limited,</span><br><span style="font-size:13px;">Midas Consulting,madipakkama ram nagar south Subramaniapuram, sundarajnagar, Trichy - 620020, P.O.Box 124465</span><br><span style="font-size:13px;">Shaarjah - U.A.E,</span><span style="font-size:13px;"><br><span style="font-size:13px;">PAN NO : JHGJ6968,</span></span><br><span style="font-size:13px;"><span style="font-size:13px;">GST Registration No : '.$gst_nos.'</span></span><br><span style="font-size:13px;"><span style="font-size:13px;">UT code : '.$ut_codes.'</span></span></span>
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
                                        <span style="text-align:left;">
                                            <span style="font-size:13px;width:100%;text-align:left;">Place of service : '.$state_name.' /UT code : '.$ut_codes.'</span>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
            </thead>
            <tbody style="width: 100%;">';
            foreach ($invoice_obj->order_detail as $order_value) {
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
                                            <b>SL.NO</b>
                                        </th>
                                        <th style="width:24%;font-size: 11px;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>DESCRIPTION</b>
                                        </th>
                                        <th style="width:12%;font-size: 11px;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>TYPE</b>
                                        </th>
                                        <th style="width:7%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>QTY</b>
                                        </th>
                                        <th style="width:9%;font-size: 11px;text-align:center;height:25px;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>UNIT PRICE</b>
                                        </th>';
                    if($check_cart_coupon_type != 'Incl Gst'){
                        $invoice_html .= '<th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                <br>
                                                <b>DISCOUNT</b>
                                            </th>
                                            <th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                <br>
                                                <b>NET AMT</b>
                                            </th>';
                    }
                                        
                    $invoice_html .= '<th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>TAX RATE</b>
                                        </th>
                                        <th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>TAX AMT</b>
                                        </th>';
                    if($check_cart_coupon_type == 'Incl Gst'){
                        $invoice_html .= '<th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                <br>
                                                <b>NET AMT</b>
                                            </th>
                                            <th style="width:8%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                                    <br>
                                                <b>DISCOUNT</b>
                                            </th>';
                    }
                    $invoice_html .= '<th style="width:9%;font-size: 11px;text-align:center;border-bottom:2px solid #f2f2f2;">
                                            <br>
                                            <b>SUB TOTAL</b>
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
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">Additional Adult</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">Child</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">Additional Child</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>
                                        <td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->totalAdult_pdf . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->total_additionalAdult_pdf . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->totalChildren_pdf . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->total_additionalChildren_pdf . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>
                                        <td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->adult_serv_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_service_amount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->child_serv_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_children_service_amount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>';
                if($service_value->cart_coupon_type != 'Incl Gst'){
                    $invoice_html .= '<td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->adult_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->add_adult_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->child_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->add_child_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>
                                        <td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->adult_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->child_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_child_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>';
                }
                $invoice_html .= '<td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->tax_rate2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                        </td>
                                        <td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->adult_tax_amt1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->adult_tax_amt2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_tax_amt1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_tax_amt2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->child_tax_amt1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->child_tax_amt2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_child_tax_amt1 . '</span>
                                                    <br>
                                                    <span style="font-size: 12px;">' . $service_value->add_child_tax_amt2 . '</span>
                                                    <br>
                                                </td>
                                            </tr>
                                        </td>';
                if($service_value->cart_coupon_type == 'Incl Gst'){
                    $invoice_html .= '<td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->adult_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->child_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_child_net_amt . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>
                                        <td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->adult_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->add_adult_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->child_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">- ' . $service_value->add_child_discount . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                        </td>';
                }
                $invoice_html .= '<td style="text-align:center;">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->adult_sub_total . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_adult_sub_total . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->child_sub_total . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px;">' . $service_value->add_child_sub_total . '</span>
                                                    <br><br>
                                                </td>
                                            </tr>
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
                                                    <td style="width:50%;line-height:25px;text-align:left;">
                                                        <span style="font-size: 12px;">Total Amount</span>
                                                    </td>
                                                    <td style="width:40%;text-align:right;line-height:25px;">
                                                        <span style="font-size: 12px;">₹ ' . ((int)$invoice_obj->service_amount +  (int)$invoice_obj->service_gst). '</span>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%;line-height:25px;text-align:left;">
                                                        <span style="font-size: 12px;">Convenience Fee</span>
                                                    </td>
                                                    <td style="width:40%;text-align:right;line-height:25px;">
                                                        <span style="font-size: 12px;">₹ ' . $invoice_obj->convenience_fee . '</span>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%;line-height:25px;text-align:left;">
                                                        <span style="font-size: 12px;">Convenience Gst</span>
                                                    </td>
                                                    <td style="width:40%;text-align:right;line-height:25px;">
                                                        <span style="font-size: 12px;">₹ ' . $invoice_obj->cf_tax . '</span>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:50%;line-height:25px;text-align:left;">
                                                        <b style="font-size: 18px;">Grand Total</b>
                                                    </td>
                                                    <td style="width:40%;text-align:right;line-height:25px;">
                                                        <b style="font-size: 18px;">₹ ' . $invoice_obj->total_amount . '</b>
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:left;">
                                                        <span style="font-size: 12px;line-height: 16px;">Total Amount in Words : Two thousand four hundred only</span>
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
?>