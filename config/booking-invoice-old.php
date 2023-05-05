<?php
$source_path='/home/airportzo/public_html/invoice_pdf/';
$add_page='A4';
$order_number=mt_rand(100,999);
$invoice_template=invoice_template();
store_invoice($invoice_template,$order_number,$source_path,$add_page);
function store_invoice($invoice_template,$order_number,$source_path,$add_page){
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
    $pdf->setAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php')) {
        require_once(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $fontname = TCPDF_FONTS::addTTFfont('../user-webapp/fonts/Rubik-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->setFontSubsetting(true);
    $pdf->SetMargins(2.175, 8, 2.175);
    $pdf->setFont($fontname, '', 14, '', false);
    $pdf->AddPage('P', $add_page);
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    // Custom code //
    $pdf->setCellHeightRatio(1.2);
    //Set some content to print

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $invoice_template, 0, 1, 0, true, '', true);
    $stort_time = strtotime(date("Y-m-d H:i:s"));
    //$stort_time = strtotime($GLOBAL['curDateTime']);
    $fileName   = "invoice_".$order_number.$stort_time.".pdf";

    $global_tcpdf_path = $source_path;
    //echo $global_tcpdf_path.$fileName;
    $target_path = ($global_tcpdf_path.$fileName); 
    $pdf->Output($target_path, 'I');//View [I],Download[F]
    return $fileName;
}
function invoice_template(){
    $htmlText='
    <style>
        table tr td{
            
        }
        .bg_color{
            background-color: #1d2546;
        }
    </style>
            <table cellspacing="0" cellpadding="0" border="0" style="width:100%;margin:auto;font-family: sans-serif;font-weight: 100;">
                <thead class="bg_color" style="background-color: #07b4d2;width:90%;">
                    <tr>
                        <th style="text-align: left;background-color: #07b4d2">
                            <img src="https://airportzo.net.in/invoince-template/airportzo_logo_white.png" alt="logo" style="width: 150px;">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <table style="width: 100%;text-align:center;"  bordercolor="#cac1c1" border="1" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th style="font-size:12px;" colspan="5"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="6">
                                            <table style="width: 100%;text-align:center;" border="0" cellspacing="0" cellpadding="5">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:12px;width:25%;border-right:1px solid #000;"><b>Confirmation No: XXXXXXX</b></th>
                                                        <th style="font-size:12px;width:50%;border-right:1px solid #000;"><b>SERVICE CONFIRMATION FOR : MEET AND ASSIST</b></th>
                                                        <th style="font-size:12px;width:25%"><b>Date:Sat, 09-Jul-2022</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;width:50%;text-align:left;" colspan="2">
                                            <span style="display:block;font-size:11px;">To: AIRPORTZO INDIA PRIVATE LIMITED</span><br>
                                            <span style="display:block;font-size:11px;">GST NO: 07AAGCB7822G1ZP</span><br>
                                            <span style="display:block;font-size:11px;">Contact: 98999 06806</span><br>
                                            <span style="display:block;font-size:11px;">Email: support@airportzo.com</span>
                                        </td>
                                        <td style="padding: 10px;width:50%;text-align:left;" colspan="3">
                                            <span style="display:flex;font-size:14px;line-height:22px;">
                                                <span>Address:</span><br>
                                                <span> XXXXX</span>
                                            </span> <br>
                                            <span style="display:block;font-size:14px;line-height:22px;">XXXXXX</span><br>
                                            <span style="display:block;font-size:14px;line-height:22px;">XXXXXX</span>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td colspan="6">
                                          <table style="width: 100%;text-align:center;"  bordercolor="#cac1c1" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>Confirmation No</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">S23228165</span>
                                                    </td>
                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>From Airport</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">Dubai International Airport</span>
                                                    </td>
                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                        <span style="font-size:13px;line-height:18px;"><b>To Airport</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">Jayprakash Narayan International Airport Patna</span>
                                                    </td>
                                                    <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000">
                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure Airline</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">Flydubai /VISTARA</span>
                                                    </td>
                                                    <td style="width: 20%;padding: 10px;text-align: center;">
                                                        <span style="font-size:13px;line-height:18px;"><b>Arrival/Departure Flight No.</b></span><br>
                                                        <span style="display:block;font-size:12px;line-height:16px;">FZ-431/UK-717</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table style="width: 100%;text-align:center;" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                            <span style="font-size:13px;"><b>Sector of Travel</b></span><br>
                                                            <span style="display:block;font-size:12px;">Domestic</span>
                                                        </td>
                                                        <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                            <span style="font-size:13px;"><b>Service Detail & Terminal</b></span><br>
                                                            <span style="display:block;font-size:12px;">Mon, 11-Jul-2022 / Welcome and Assist / Transit </span>
                                                        </td>
                                                        <td style="width: 20%;padding: 10px;text-align: center;border-right:1.5px solid #000;">
                                                            <span style="font-size:13px;"><b>Booking Date & Time(IST)</b></span><br>
                                                            <span style="display:block;font-size:12px;">Sat, 09-Jul-2022 00:43</span>
                                                        </td>
                                                        <td style="width: 40%;padding: 10px;text-align: center;border-right:1.5px solid #000;" colspan="2">
                                                            <span style="font-size:13px;"><b>Flight Date & Time(Local Time)</b></span><br>
                                                            <span style="display:block;font-size:12px;">Mon, 11-Jul-2022 03:20 Hrs (IST)</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="" style="width:50%;">
                                            <strong style="font-size:13px;">PAYMENT REFERENCE ID: ON_CREDIT</strong>
                                        </td>
                                        <td colspan="5" style="text-align: center;width:50%;">
                                            <strong style="font-size:13px;">Service Date & Time(Local Time)</strong><br>
                                            <span style="display:block;font-size:12px;">Mon, 11-Jul-2022 03:20 Hrs (IST)</span>
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
                                        <th style="font-size:13px;line-height:16px"><b>Class</b></th>
                                        <th style="font-size:13px;line-height:16px"><b>Age (yrs.)</b></th>
                                        <th style="font-size:13px;line-height:16px"><b>PNR No.</b></th>
                                        <th style="font-size:13px;line-height:16px"><b>Identity Proof</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;line-height:20px;">1</td>
                                        <td style="font-size:12px;line-height:20px;">XXXXXXX</td>
                                        <td style="font-size:12px;line-height:20px;">Economy</td>
                                        <td style="font-size:12px;line-height:20px;"> </td>
                                        <td style="font-size:12px;line-height:20px;">V6ZTB6</td>
                                        <td style="font-size:12px;line-height:20px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table style="width: 100%;text-align: center;" border="0" cellspacing="0" cellpadding="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:13px;text-align:left;border-right:none">
                                                            <b style="font-size:13px;">Name to be displayed on Placard : XXXXXXXX</b> 
                                                        </td>
                                                        <td>
                                                            <b style="font-size:13px;">Guest No.on Placard : 91-XXXXXXXXX</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
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
                                        <td style="font-size:13px;line-height:20px;" colspan="4">TRANSIT (INT-DOM) (Adult) 1 Qty [HSN/SAC: 996331]</td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">4067.8</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;" colspan="4">TRANSIT (INT-DOM) (Adult) 1 Qty [HSN/SAC: 996331]</td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">4067.8</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>Net Amount</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">$8135.6</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;" colspan="4"><b>SGST (9%)</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">732.20</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>CGST (9%)</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">732.20</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px;line-height:20px;text-align: right;font-weight: 700;" colspan="4"><b>Total</b></td>
                                        <td style="font-size:13px;line-height:20px;text-align: right;">$9600</td>
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
                                                <span style="display:block;font-size:14px;line-height:22px;"><b>XXXXXXXX</b></span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;">GST: XXXXXXXX</span><br>
                    
                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Place of Supply: XXXXXXXX</b></span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;"><b>Registered Address:</b> XXXXXXXX</span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;">Terms and Conditons of services as provided on <a href="mailto:www.encalm.com">www.encalm.com</a> shall apply</span><br>
                                                <span style="display:block;font-size:14px;line-height:22px;">For all booking queries please feel to write to us on <a href="mailto:guest.services@encalm.com">guest.services@encalm.com</a></span>
                    
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tfoot>

            </table>
    ';
return $htmlText;
}
?>