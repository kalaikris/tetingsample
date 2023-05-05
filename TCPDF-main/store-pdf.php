<?php
function savePdf($invoice_content, $fileName,$s3folder) { //, $source_path, $add_page
    require_once('../../../TCPDF-main/examples/tcpdf_include.php');
    // create new PDF document

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setCreator(PDF_CREATOR);

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set auto page breaks
    $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php')) {
        require_once(dirname(__FILE__).'TCPDF-main/examples/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $fontname = TCPDF_FONTS::addTTFfont('../../../TCPDF-main/fonts/Rubik-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $pdf->setFontSubsetting(true);
    $pdf->SetMargins(8, 10, 8);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setFont($fontname, '', 14, '', false);
    $pdf->AddPage('L', 'A4');
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    
    // Custom code //
    $pdf->setCellHeightRatio(1.2);
    
    //Set some content to print
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $invoice_content, 0, 1, 0, true, '', true);

    // Delete page 1
    $pdf->deletePage(1);
    
    $target_path = '/home/airportzostage/public_html/invoice_pdf/' . $fileName;
    $pdf->Output($target_path, 'F');//View [I],Download[F]
    $attachdata = $pdf->Output($target_path, 'S');//View [I],Download[F]
    upload_to_s3($s3folder,$target_path);
    return $attachdata;
}
require '../../../../vendor/autoload.php';
use Aws\S3\S3Client;
$s3Client = new S3Client([
    'region' => 'ap-south-1',
    'version' => 'latest',
    'credentials' => [
        'key' => $s3_access_key,
        'secret' => $s3_secret_key]
]);
$bucket = $s3_bucket;

function upload_to_s3($s3folder,$global_tcpdf_path)
{
    $bucket = $GLOBALS['bucket'];
    $file_Path = $global_tcpdf_path;
    $key = basename($file_Path);
    $sddpe = $GLOBALS['s3Client'];
    try 
    {
        $result = $sddpe->putObject([
            'Bucket' => $bucket,
            'Key'    => $s3folder.$key,
            'Body'   => fopen($file_Path, 'r'),
            // 'ACL'    => 'public-read', // make file 'public'
        ]);
        unlink($file_Path);
        
    } 
    catch (Aws\S3\Exception\S3Exception $e) 
    {
        echo "There was an error uploading the file.<br><br>";
        echo $e->getMessage();
    }
}
?>