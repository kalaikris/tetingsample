<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 006');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set header border to transparent
$pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255) );

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
// $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set cell padding zero
$pdf->SetCellPadding(0);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('dejavusans', '', 10);


// add a page
$pdf->AddPage();

// create some HTML content
$html = <<<EOF

    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
        <tr>
          <td>
            <img width="150" src="https://www.sterlingholidays.com/logos/sterling-logo.png">
          </td>
          <td valign="top" style="text-align:right;font-size:medium;">
            <b>Tax Invoice</b> (Original for Recipient)<br><span style="font-size:small;">Invoice No : JHGJ6987 | Date : 24 Jun 2022</span>
          </td>
        </tr>
        <tr>
          <td style="width:50%;">
            <h1 style="font-weight:medium;">Martha Pearson</h1>
            <span style="font-size:small;">+91 846628635 | fojopgep@omomubed.edu</span>
            <br><span style="font-size:small;">PAN No : JHGJ6987</span>
            <br>
            <br><span style="font-size:small;">Booking Details :</span>
      			<br><span style="font-size:small;">Booking Reference No : 76928SDJH</span>
      			<br><span style="font-size:small;">Booking Date : 24 Jun 2022</span>
      			<br><span style="font-size:small;">Payment ID : 76928SDJH</span>
          </td>
          <td style="width:50%;">
            <table style="width:100%;" cellspacing="0">
              <tr>
                <td style="width:43%;"></td>
                <td style="width:57%;">
                  <div>
                    <br><br><span style="font-size:small;">Sold by :</span>
                    <br><span style="font-size:small;">Airportzo India Pvt Limited</span>
                    <br><span style="font-size:small;">Midas Consulting, P.O.Box 124465</span>
                    <br><span style="font-size:small;">Sharjah - U.A.E</span>
                    <br><span style="font-size:small;">PAN No : JHGJ6987</span>
                    <br><span style="font-size:small;">GST Registration No : 76928SDJH</span>
                    <br><span style="font-size:small;">UT code : 245</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="right">
                  <br><br><span style="font-size:small;">Place of service  :  Tamilnadu State/UT code  :  33</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td width="100%">
            <h4 style="font-weight:light;">MAA - TERMINAL 1</h4>
            <table cellspacing="1" cellpadding="2">
              <tr style="border-bottom:2px solid #eee;">
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="30">SL.NO</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="110">DESCRIPTION</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">NET AMOUNT</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">TAX RATE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">SUB TOTAL</th>
              </tr>
              <tr>
                <td width="30"><br><span style="font-size:small;">1</span></td>
                <td width="110">
                  <br><span style="font-size:small;font-weight:bold;">Silver Package</span>
                  <br><span style="font-size:x-small;">Pranaam</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 1,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 10,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
                <td>
                  <br><span style="font-size:small;">2% CGST</span>
                  <br><span style="font-size:small;">5% SCGST</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
              </tr>
              <tr>
                <td width="30"><br><span style="font-size:small;">2</span></td>
                <td width="110">
                  <br><span style="font-size:small;font-weight:bold;">Blue Orchid </span>
                  <br><span style="font-size:x-small;">Care by BLR (MAA - Terminal 1)</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 1,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 10,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
                <td>
                  <br><span style="font-size:small;">2% CGST</span>
                  <br><span style="font-size:small;">5% SCGST</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="100%">
            <h4 style="font-weight:light;">DXB - TERMINAL 3</h4>
            <table cellspacing="1" cellpadding="2">
              <tr style="border-bottom:2px solid #eee;">
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="30">SL.NO</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="110">DESCRIPTION</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">NET AMOUNT</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">TAX RATE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">SUB TOTAL</th>
              </tr>
              <tr>
                <td width="30"><br><span style="font-size:small;">1</span></td>
                <td width="110">
                  <br><span style="font-size:small;font-weight:bold;">Lounge (4 hours)</span>
                  <br><span style="font-size:x-small;">Plaza Premium</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 1,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 10,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
                <td>
                  <br><span style="font-size:small;">2% CGST</span>
                  <br><span style="font-size:small;">5% SCGST</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="100%">
            <h4 style="font-weight:light;">FRA - TERMINAL 2</h4>
            <table cellspacing="1" cellpadding="2">
              <tr style="border-bottom:2px solid #eee;">
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="30">SL.NO</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;" width="110">DESCRIPTION</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL ADULT QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN PRICE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">ADDITIONAL CHILDREN QTY</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">NET AMOUNT</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">TAX RATE</th>
                <th style="font-size:xx-small;font-weight:bold;border-bottom:2px solid #eee;">SUB TOTAL</th>
              </tr>
              <tr>
                <td width="30"><br><span style="font-size:small;">1</span></td>
                <td width="110">
                  <br><span style="font-size:small;font-weight:bold;">Porter (5 bags)</span>
                  <br><span style="font-size:x-small;">Travmitr</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 1,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 10,000</span>
                </td>
                <td style="font-size:small;">1</td>
                <td style="font-size:small;">1</td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
                <td>
                  <br><span style="font-size:small;">2% CGST</span>
                  <br><span style="font-size:small;">5% SCGST</span>
                </td>
                <td>
                  <br><span style="font-size:small;">₹ 11,000</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td width="100%">
            <table cellspacing="1" cellpadding="2">
              <tr>
                <br><br><br>
                <td style="width:30%;"></td>
                <td style="width:70%;">
                  <table>
                    <tr>
                      <td colspan="2">
                        <br><span style="font-size:small;">Total Qty : 6</span>
                        <br><span style="font-size:small;">Total Tax Amount : ₹ 100</span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <br><br><span style="font-size:medium;font-weight:bold;">Grand Total</span>
                      </td>
                      <td align="right">
                        <br><br><span style="font-size:medium;font-weight:bold;">₹ 2,400</span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <br><span style="font-size:small;">Total Amount in Words : Two thousand four hundred only </span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <br><br>
          <td style="width:100%;">
            <table cellspacing="3" cellpadding="2">
              <tr>
                <td style="font-size:small;">Powered by</td>
                <td style="text-align:right;font-size:small;">
                  For Airportzo India Pvt Limited
                </td>
              </tr>
              <tr>
                <td>
                  <img width="120" src="https://airportzo.net.in/web-app/asset/logo.png">
                </td>
                <td style="text-align:right;">
                  <img width="120" src="https://airportzo.net.in/invoince-template/signature.png">
                </td>
              </tr>
              <tr>
                <td style="font-size:small;">Whether tax is payable under reverse charge - No</td>
                <td style="text-align:right;font-size:small;">
                  Authorized Signatory
                </td>
              </tr>
            </table>
          </td>
        </tr>

    </table>

    <div>

    </div>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------




//Close and output PDF document
$pdf->Output('invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
