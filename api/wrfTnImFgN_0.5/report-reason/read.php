<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);

include '../../../config/core.php';
$input_data = getInputs();

include '../objects/report-reason.php';
$report_reason = new ReportReason();
$report_reason->read();

$obj = new stdClass;
if ($report_reason->stmt->rowCount() > 0) {
    $obj->status_code = 200;
    $obj->title = "Success";
    $obj->message = "Success";
    $obj->data = $report_reason->makeView();
} else {
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "No report reason found !";
    $obj->data = new stdClass;
}
echo json_encode($obj);
?>
