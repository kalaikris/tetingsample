<?php
include '../../../../config/core.php';
$input_data = getInputs();
$distributor_token = $input_data->distributor_id;
include_once '../objects/service-distributor.php';
$service_distributor = new ServiceDistributor;
$service_distributor->distributor_token = $distributor_token;
$obj = new stdClass;
    if($service_distributor->isServiceDistributor()){
        if($input_data->type == 'select_manage_brand'){


        }else if($input_data->type == 'update_manage_brand'){
           $service_distributor->header_logo = $input_data->logo_image; 
           $service_distributor->footer_logo = $input_data->footer_logo; 
           $service_distributor->banner_image = $input_data->banner_image; 
           $service_distributor->poster_image = $input_data->poster_image; 
           $service_distributor->header_color = $input_data->header_color; 
           $service_distributor->header_text_colour = $input_data->header_text_colour; 
           $service_distributor->brand_color = $input_data->brand_color; 
           $service_distributor->secondary_color = $input_data->secondary_color; 
           $service_distributor->description = $input_data->text_area_value;
           if($service_distributor->updateManageBrandForDistributor()){
                $obj->status_code = 200;
                $obj->title = "Success";
                $obj->message = "Updated Manage Brand Successfully";
           }else{
                $obj->status_code = 400;
                $obj->title = "Error";
                $obj->message = "Not able to update manage brand!";
           }    
        }
    }else{
        $obj->status_code = 400;
        $obj->title = "Oops";
        $obj->message = "Provided Distributor token is incorrect";
    }

echo json_encode($obj);
?>