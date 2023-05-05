<?php
session_start();

include '../whitelabelling-webapp/php/objects/invoice-order.php';
$invoice = new InvoiceTemplateOrder();
$invoice->invoice_obj = json_decode($_SESSION['order_detail']);
$invoice_template = $invoice->genInvoiceForOrder();

$source_path = '/home/airportzo/public_html/invoice_pdf/';
$add_page = 'A4';
$order_number = $invoice->invoice_obj->booking_number;
store_invoice($invoice_template, $order_number, $source_path, $add_page);

function store_invoice($invoice_template, $order_number, $source_path, $add_page) {
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
    $fileName = "invoice_" . $order_number . $stort_time . ".pdf";

    $global_tcpdf_path = $source_path;//"/home/merchifydev/public_html/development/invoice_pdf/";
    //echo $global_tcpdf_path.$fileName;
    $target_path = ($global_tcpdf_path.$fileName); 
    $pdf->Output($target_path, 'I');//View [I],Download[F]
    return $fileName;
}
?>