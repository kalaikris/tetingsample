<?php
include '../../../../config/core.php';
$input_data = getInputs();
if($input_data->business_id != '' && $input_data->password != ''){
    $business_id = $input_data->business_id;
    $password = hash('sha512',$input_data->password);

    include_once '../objects/service-provider.php';
    $obj = new stdClass;
    $service_provider = new ServiceProvider();
    $service_provider->business_id = $business_id;
    $service_provider->password = $password;
    $stmt = $service_provider->checkIsValidCredentials();

    if ($stmt->rowCount() == 1) {
        $service_data = $service_provider->readIsAdmin($stmt);
        if($service_data->is_admin == '1'){
            $stmth = $service_provider->checkServiceProviderStatus($service_data->service_provider_company_token);
            if($stmth->rowCount() > 0){
                $service_provider->service_provider_token = $service_data->service_provider_company_token;
                $stmtProceed  = $service_provider->checkProceedForReview();
                $stmtApproved = $service_provider->checkApproved();
                if($stmtProceed->rowCount()>0){
                    $service_status = 'Proceed For Review';
                    $obj->relocator = "create-new-service.php"; 
                }else if($stmtApproved->rowCount()>0){
                    $service_status = 'Approved'; 
                    $obj->relocator = "service-policy.php";
                }else{
                    $service_status = 'Under Review';
                    $obj->relocator = "create-new-service.php"; 
                }
                
                $obj->status_code= 200;
                $obj->title      = "Success";
                $obj->message    = "Logged In Successfully1";
                $obj->name       = $service_data->name;
                $obj->image      = $service_data->image;
                $obj->service_token = $service_data->service_provider_company_token;
                //$obj->relocator  = "index.php";
                setcookie('service_token', $service_data->service_provider_company_token, time() + 3600 * 24 * 365, '/');
                $obj->service_status = $service_status;
            }else{
                $obj->status_code= 200;
                $obj->title      = "Success2";
                $obj->message    = "Logged In Sucessfully";
                $obj->name       = $service_data->name;
                $obj->image      = $service_data->image;
                $obj->service_token = $service_data->service_provider_company_token;
                $obj->relocator  = "index.php";
                setcookie('service_token', $service_data->service_provider_company_token, time() + 3600 * 24 * 365, '/');
            }
        }else{
            if($service_data->user_role_token == '4231616728'){
                $obj->status_code = 400;
                $obj->title = "Error";
                $obj->message = "Assistant should Login Only Through App !";
            }else{
                $obj->status_code = 400;
                $obj->title = "Error";
                $obj->message = "Staff can't logged In";
            }
        }
        setcookie('staff_token', $service_data->staff_token, time() + 3600 * 24 * 365, '/');
    } else {
        $stmt1 = $service_provider->checkBusinessId();
        $obj->status_code = 400;
        $obj->title = "Oops";
        if($stmt1->rowCount() == 0){
             $obj->message = "Please Enter Valid Business Id"; 
        }else{
             $obj->message = "Please Enter Valid Password";
        } 
    }
}else{
    $obj->status_code = 400;
    $obj->title = "Oops";
    $obj->message = "Please Enter Login Details"; 
}
echo json_encode($obj);
?>