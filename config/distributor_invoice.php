<?php
function store_invoice($invoice_template,$mail_token){
    require_once('/home/airportzostage/public_html/config/TCPDF-main/examples/tcpdf_include.php');
    // create new PDF document

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setCreator(PDF_CREATOR);

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set auto page breaks
    $pdf->setAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php')) {
        require_once(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    //$fontname = TCPDF_FONTS::addTTFfont('../user-webapp/fonts/Rubik-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->setFontSubsetting(true);
    $pdf->SetMargins(2.175, 8, 2.175);
    $pdf->setFont('dejavusans', '', 14, '', false);
    $pdf->AddPage('P', 'A4');
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    // Custom code //
    $pdf->setCellHeightRatio(1.2);
    //Set some content to print

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $invoice_template, 0, 1, 0, true, '', true);
    $stort_time = strtotime(date("Y-m-d H:i:s"));
    //$stort_time = strtotime($GLOBAL['curDateTime']);
    $fileName   = "invoice_".$mail_token.".pdf";

    $global_tcpdf_path = "/home/airportzostage/public_html/booking_pdf/";
    //echo $global_tcpdf_path.$fileName;
    $target_path = ($global_tcpdf_path.$fileName); 
    $pdf->Output($target_path, 'F');//View [I],Download[F]
    return $fileName;
}


//function invoice_template($mail_funcion,$type_name){
//    $mail_data = $mail_funcion;
//    $net_amount = round($mail_funcion[0]->net_amount/1.18,2);
//    $gst_amount = $mail_funcion[0]->net_amount-$net_amount;
//    $cgst = round($gst_amount/2,2);
//    $htmlText='';
//    $htmlText.='<table cellspacing="0" cellpadding="0" border="0" style="width:100%;margin:auto;font-family: sans-serif;font-weight: 100;">
//                <thead class="bg_color" style="background-color: #07b4d2;width:90%;">
//                    <tr>
//                        <th style="text-align: left;background-color: #07b4d2">
//                            <img src="https://airportzo.net.in/invoince-template/airportzo_logo_white.png" alt="logo" style="width: 150px;">
//                        </th>
//                    </tr>
//                </thead>
//                <tbody>
//                    <tr>
//                        <td>
//                            <table style="width: 100%;text-align:center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
//                                <thead>
//                                    <tr>
//                                        <th style="font-size:12px;" colspan="5"></th>
//                                    </tr>
//                                    <tr>
//                                        <th colspan="6">
//                                            <table style="width: 100%;text-align:center;" border="0" cellspacing="0" cellpadding="5">
//                                                <thead>
//                                                    <tr>
//                                                        <th style="font-size:12px;width:25%;border-right:1px solid #000;"><b>Confirmation No: '.$mail_data[0]->token.'</b></th>
//                                                        <th style="font-size:12px;width:50%;border-right:1px solid #000;"><b>SERVICE CONFIRMATION FOR : '.$mail_data[0]->service_name.'</b></th>
//                                                        <th style="font-size:12px;width:25%"><b>Date: '.$mail_data[0]->date_time.'</b></th>
//                                                    </tr>
//                                                </thead>
//                                            </table>
//                                        </th>
//                                    </tr>
//                                </thead>
//                                <tbody>
//                                    <tr>
//                                        <td style="padding: 10px;width:50%;text-align:left;" colspan="2">
//                                            <span style="display:block;font-size:11px;">AIRPORTZO INDIA PRIVATE LIMITED</span><br>
//                                            <span style="display:block;font-size:11px;">GST NO: 33AAGCB7822G2ZT</span><br>
//                                            <span style="display:block;font-size:11px;">Contact: +91 8610725198</span><br>
//                                            <span style="display:block;font-size:11px;">Email: support@airportzo.com</span>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                       <td colspan="6">
//                                          <table style="width: 100%;text-align:center;"  bordercolor="#cac1c1" border="0" cellspacing="0" cellpadding="0">
//                                            <tbody>
//                                                <tr>
//                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
//                                                        <span style="font-size:13px;line-height:18px;"><b>Confirmation No</b></span><br>
//                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->token.'</span>
//                                                    </td>
//                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
//                                                        <span style="font-size:13px;line-height:18px;"><b>From Airport</b></span><br>
//                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->firstElementNname.'</span>
//                                                    </td>
//                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
//                                                        <span style="font-size:13px;line-height:18px;"><b>To Airport</b></span><br>
//                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->lastElementNname.'</span>
//                                                    </td>
//                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000">
//                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure Airline</b></span><br>
//                                                        <span style="display:block;font-size:12px;line-height:16px;">-</span>
//                                                    </td>
//                                                    <td style="width: 20%;padding: 10px;text-align: center;">
//                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure Flight No.</b></span><br>
//                                                        <span style="display:block;font-size:12px;line-height:16px;">-</span>
//                                                    </td>
//                                                </tr>
//                                            </tbody>
//                                          </table>
//                                       </td>
//                                    </tr>
//                                    <tr>
//                                        <td style="width:50%;text-align: center;border-right:1.5px solid #000;">
//                                            <span style="font-size:13px;"><b>Sector of Travel</b></span><br>
//                                            <span style="display:block;font-size:12px;">'.$type_name.'</span>
//                                        </td>
//                                        <td style="width:50%;text-align: center;border-right:1.5px solid #000;">
//                                            <span style="font-size:13px;"><b>Service Detail & Terminal</b></span><br>
//                                            <span style="display:block;font-size:12px;">'.$mail_data[0]->journey_date.'/'.$mail_data[0]->business_name.'</span>
//                                        </td>
//                                    </tr>
//                                    <tr>
//                                        <td colspan="" style="width:50%;">
//                                            <strong style="font-size:13px;">PAYMENT REFERENCE ID: '.$mail_data[0]->payment_id.'</strong>
//                                        </td>
//                                        <td colspan="5" style="text-align: center;width:50%;">
//                                            <strong style="font-size:13px;">Service Date & Time(Local Time)</strong><br>
//                                            <span style="display:block;font-size:12px;">'.$mail_data[0]->service_date_time.'</span>
//                                        </td>
//                                    </tr>
//                                </tbody>
//                            </table>
//                        </td>
//                    </tr>
//                    <tr>
//                        <td>
//                            <table style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
//                                <thead>
//                                    <tr>
//                                        <th style="font-size:13px;line-height:16px"><b>Guests</b></th>
//                                        <th style="font-size:13px;line-height:16px"><b>Name</b></th>
//                                        <th style="font-size:13px;line-height:16px"><b>Age (yrs.)</b></th>
//                                    </tr>
//                                </thead>
//                                <tbody>';
//                    $passengers_array = $mail_funcion[0]->passanger_array;
//                    foreach($passengers_array as $key => $arrays_val){
//                         $slno = $key+1; 
//                      $htmlText.='<tr>
//                                        <td style="font-size:12px;line-height:20px;">'.$slno.'</td>
//                                        <td style="font-size:12px;line-height:20px;">'.$arrays_val->name.'</td>
//                                        <td style="font-size:12px;line-height:20px;">'.$arrays_val->age.'</td>
//                                    </tr>';
//                                }
//                        $htmlText.=' <tr>
//                                        <td colspan="6" style="background-color: #07b4d2;">
//                                            <table style="width: 100%;text-align: center;" border="0" cellspacing="0" cellpadding="3">
//                                                <tbody>
//                                                    <tr>
//                                                        <td style="font-size:14px;color: #fff;text-align:left;">
//                                                            <b style="font-size:13px;">Details of Services:</b>
//                                                        </td>
//                                                    </tr>
//                                                </tbody>
//                                            </table>
//                                        </td>
//                                    </tr>
//                                </tbody>
//                            </table>
//                        </td>
//                    </tr>
//                    <tr>
//                        <td>
//                            <table style="width: 100%;text-align: left;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="5">
//                                <thead>
//                                    <tr>
//                                        <th colspan="4" style="font-size:13px;line-height:20px;text-align: left;"><b>Description</b></th>
//                                        <th style="text-align: right;font-size:13px;line-height:20px;text-align: right;"><b>Amount (Rs.)</b></th>
//                                    </tr>
//                                </thead>
//                                <tbody>
//                                    <tr>
//                                        <td style="font-size:13px;line-height:20px;" colspan="4">'.$mail_data[0]->business_name.'/'.$mail_funcion[0]->service_name.'</td>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$net_amount.'</td>
//                                    </tr>
//                                    <tr>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>Net Amount</b></td>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$net_amount.'</td>
//                                    </tr>
//                                    <tr>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>SGST (9%)</b></td>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$cgst.'</td>
//                                    </tr>
//                                    <tr>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>CGST (9%)</b></td>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$cgst.'</td>
//                                    </tr>
//                                    <tr>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>Total</b></td>
//                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$mail_data[0]->net_amount.'</td>
//                                    </tr>
//                                </tbody>
//                            </table>
//                        </td>
//                    </tr>
//                </tbody>
//                <tfoot>
//                    <tr>
//                        <td>
//                            <table  style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
//                                <tbody>
//                                    <tr>
//                                        <td style="padding: 15px;">
//                                            <span style="display: block;">
//                                               
//                                                <span style="display:block;font-size:14px;line-height:22px;">GST: 33AAGCB7822G2ZT</span><br>
//                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Place of Supply: India</b></span><br>
//                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Registered Address:</b> AIRPORTZO INDIA PVT LTD</span><br>
//                                                <span style="display:block;font-size:14px;line-height:22px;">Terms and Conditons of services as provided on <a href="mailto:www.airportzo.com">www.airportzo.com</a> shall apply</span><br>
//                                                <span style="display:block;font-size:14px;line-height:22px;">For all booking queries please feel to write to us on <a href="mailto:support@airprtzo.com">support@airprtzo.com</a></span>
//                    
//                                            </span>
//                                        </td>
//                                    </tr>
//                                </tbody>
//                            </table>
//                        </td>
//                    </tr>
//                </tfoot>
//
//            </table>';
//return $htmlText;
//} 

function invoice_template($mail_funcion,$type_name,$travelStatus){
    $mail_data = $mail_funcion;
    $net_amount = round($mail_funcion[0]->net_amount/1.18,2);
    $gst_amount = $mail_funcion[0]->net_amount-$net_amount;
    $cgst = round($gst_amount/2,2);
    $htmlText='';
    $htmlText.='<table cellspacing="0" cellpadding="0" border="0" style="width:100%;margin:auto;font-family: sans-serif;font-weight: 100;">
                <thead class="bg_color" style="background-color: #07b4d2;width:100%;">
                    <tr>
                        <th style="text-align: left;background-color: #07b4d2">
                            <img src="https://airportzo.net.in/invoince-template/airportzo_logo_white.png" alt="logo" style="width: 150px;">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table style="width: 100%;text-align:center;" bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th style="font-size:12px;" colspan="5"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6">
                                            <table style="width: 100%;text-align:center;" border="0" cellspacing="0" cellpadding="5">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:12px;width:25%;border-right:1px solid #000;"><b>Confirmation No: '.$mail_data[0]->token.'</b></th>
                                                        <th style="font-size:12px;width:50%;border-right:1px solid #000;"><b>SERVICE CONFIRMATION FOR : '.$mail_data[0]->service_name.'</b></th>
                                                        <th style="font-size:12px;width:25%"><b>Date: '.$mail_data[0]->date_time.'</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;width:100%;text-align:left;" colspan="2">
                                            <span style="display:block;font-size:11px;">AIRPORTZO INDIA PRIVATE LIMITED</span><br>
                                            <span style="display:block;font-size:11px;">GST NO: 33AAGCB7822G2ZT</span><br>
                                            <span style="display:block;font-size:11px;">Contact: +91 8610725198</span><br>
                                            <span style="display:block;font-size:11px;">Email: support@airportzo.com</span>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td style="width:100%;">
                                          <table style="width:100%;text-align:center;"  bordercolor="#cac1c1" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>Confirmation No</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->token.'</span>
                                                    </td>
                                                    <td style="padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>From Airport</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->firstElementNname.'</span>
                                                    </td>
                                                    <td style="padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>To Airport</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->lastElementNname.'</span>
                                                    </td>
                                                    <td style="padding: 10px;text-align: center;border-right:1.5px solid #000">
                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$travelStatus.'</span>
                                                    </td>
                                                    <td style="padding: 10px;text-align: center;">
                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure Flight No.</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">'.$mail_data[0]->flight_number.'</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;text-align: center;border-right:1.5px solid #000;">
                                            <span style="font-size:13px;"><b>Sector of Travel</b></span><br>
                                            <span style="display:block;font-size:12px;">'.$type_name.'</span>
                                        </td>
                                        <td style="width:50%;text-align: center;border-right:1.5px solid #000;">
                                            <span style="font-size:13px;"><b>Service Detail & Terminal</b></span><br>
                                            <span style="display:block;font-size:12px;">'.$mail_data[0]->service_date_time.'/'.$mail_data[0]->business_name.'</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="" style="width:50%;">
                                            <strong style="font-size:13px;">PAYMENT REFERENCE ID: '.$mail_data[0]->payment_id.'</strong>
                                        </td>
                                        <td colspan="" style="text-align: center;width:50%;">
                                            <strong style="font-size:13px;">Service Date & Time(Local Time)</strong><br>
                                            <span style="display:block;font-size:12px;">'.$mail_data[0]->service_date_time.'</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th style="font-size:13px;line-height:16px"><b>Guests</b></th>
                                        <th style="font-size:13px;line-height:16px"><b>Name</b></th>
                                        <th style="font-size:13px;line-height:16px"><b>Age (yrs.)</b></th>
                                    </tr>
                                </thead>
                                <tbody>';
                    $passengers_array = $mail_funcion[0]->passanger_array;
                    foreach($passengers_array as $key => $arrays_val){
                         $slno = $key+1; 
                      $htmlText.='<tr>
                                        <td style="font-size:12px;line-height:20px;">'.$slno.'</td>
                                        <td style="font-size:12px;line-height:20px;">'.$arrays_val->name.'</td>
                                        <td style="font-size:12px;line-height:20px;">'.$arrays_val->age.'</td>
                                    </tr>';
                                }
                        $htmlText.=' <tr>
                                        <td colspan="6" style="background-color: #07b4d2;">
                                            <table style="width: 100%;text-align: center;" border="0" cellspacing="0" cellpadding="3">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:14px;color: #fff;text-align:left;">
                                                            <b style="font-size:13px;">Details of Services:</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;text-align: left;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th colspan="4" style="font-size:13px;line-height:20px;text-align: left;"><b>Description</b></th>
                                        <th style="text-align: right;font-size:13px;line-height:20px;text-align: right;"><b>Amount (Rs.)</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;" colspan="4">'.$mail_data[0]->business_name.'/'.$mail_funcion[0]->service_name.'</td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$net_amount.'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>Net Amount</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$net_amount.'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>SGST (9%)</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$cgst.'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>CGST (9%)</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$cgst.'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>Total</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">'.$mail_data[0]->net_amount.'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <table  style="width: 100%;text-align: center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td style="padding: 15px;">
                                            <span style="display: block;">
                                               
                                                <span style="display:block;font-size:14px;line-height:22px;">GST: 33AAGCB7822G2ZT</span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Place of Supply: India</b></span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Registered Address:</b> AIRPORTZO INDIA PVT LTD</span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;">Terms and Conditons of services as provided on <a href="mailto:www.airportzo.com">www.airportzo.com</a> shall apply</span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;">For all booking queries please feel to write to us on <a href="mailto:support@airportzo.com">support@airportzo.com</a></span>
                    
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>';
return $htmlText;
} 
?>