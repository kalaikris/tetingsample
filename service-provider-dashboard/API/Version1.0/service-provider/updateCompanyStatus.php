<?php
include '../../../../config/core.php';
$inputData = getInputs();
include_once '../objects/service-provider.php';
$obj = new stdClass;
$service_providercompany = new ServiceProvider();
    if(count($inputData->finalcompanystatusarray) > 0){
        $checkIsUpdated = false;
        foreach($inputData->finalcompanystatusarray as $companies){
            if($companies->uniquecompanystatus == '0'){
                $service_providercompany->uniquecompanytoken = $companies->uniquecompanytoken;
                $service_providercompany->uniquecompanystatus = $companies->uniquecompanystatus;
                if($service_providercompany->updateCompanyStatus()){
                    $checkIsUpdated = true; 
                }
            }
        }
        if($checkIsUpdated){
            $obj->status_code = 200;
            $obj->title = "Success";
            $obj->message = "Updated Company Status";  
        }else{
            $obj->status_code = 400;
            $obj->title = "Oops";
            $obj->message = "Not Updated Company Status"; 
        }
    }else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Please Wait Admin Will Approve Your Company!.."; 
    }
    
echo json_encode($obj);
?>