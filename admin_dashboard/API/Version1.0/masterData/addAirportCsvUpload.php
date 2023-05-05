<?php

$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/admin.php';
$admin = new admin();
include_once '../objects/airport.php';
$airport = new airport();
$admin->adminToken  = $_POST['adminToken'];
$stmt = $admin->userCheck();
if($stmt->rowCount()==1){
    if(is_array($_FILES)) {
        if(is_uploaded_file($_FILES['file_upload']['tmp_name'])) {
            $sourcePath = $_FILES['file_upload']['tmp_name'];
            if (($handle = fopen($sourcePath, "r")) !== FALSE) {
                $array     = [];
                $errorData = [];
                while (($line = fgetcsv($handle, 1000, ",",'"')) !== FALSE) {
                    $num = count($line);
                    for ($c=0; $c < $num; $c++) {
                        if($c==0){
                            if($row>0){
                                $obj1=new stdClass();
                                $obj1->airportToken = $admin->generateToken('airport','token');
                                $airport->ttrToken = $admin->generateToken('airport__terminal_type_relation','token');
                                $airport->airportToken = $obj1->airportToken;
                                $obj1->name        = trim($line[1]);
                                $obj1->code        = trim($line[2]);
                                $countryId         = $airport->getCountryId(trim($line[5]));
                                $stateId           = $airport->getStateId($countryId,trim($line[4]));
                                $obj1->cityName    = trim($line[3]);
                                $obj1->cityId      = $airport->getCityId($countryId,$stateId,$obj1->cityName);
                                $obj1->timeZone    = trim($line[6]);
                                $obj1->gmt         = trim($line[7]);
                                $obj1->gmDateTime  = $gm_date_time;
                                $airport->gmDateTime  = $gm_date_time;
                                
                                $stmtCheck = $airport->airportAvailableCheckCsv($obj1->code);
                                if($stmtCheck->rowCount()==0 && $obj1->cityId!=null){
                                    $airport->addAirportCsv($obj1);
                                    $airport->addTerminalRelationType();
                                    array_push($array,$obj1);
                                }else{
                                    array_push($errorData,$obj1);
                                }
                            }
                        }
                    }
                    $row++;
                }
                fclose($handle);
                $obj->status_code = 201;
                $obj->data        = $array;
                $obj->errorData   = $errorData;
            }
        }else{
            $obj->status_code = 503;
            $obj->message = "Error2";
        }
    }else{
        $obj->status_code = 503;
        $obj->message = "Error";
    }
    
}else{
    $obj->status_code = 503;
    $obj->title       = "Error";
    $obj->message     = "Error";
}
echo json_encode($obj);
?>