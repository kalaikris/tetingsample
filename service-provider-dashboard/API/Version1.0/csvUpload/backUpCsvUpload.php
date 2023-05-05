<?php

$obj=new stdClass();
include_once '../../../../config/core.php';
$inputData = getInputs();
include_once '../../../../config/database.php';
include_once '../objects/csvUpload.php';
$csvUpload = new csvUpload();
$csvUpload->gmDateTime  = $gm_date_time;
$row=1;
if(is_array($_FILES)) { 
    if(is_uploaded_file($_FILES['file_upload']['tmp_name'])) {
        $sourcePath = $_FILES['file_upload']['tmp_name'];
        if (($handle = fopen($sourcePath, "r")) !== FALSE) {
            $array = [];
            while (($line = fgetcsv($handle, 1000, ",",'"')) !== FALSE) {
                $num = count($line);
                for ($c=0; $c < $num; $c++) {
                    if($c==0){
                        if($row>1){
                            $country = trim($line[0]);
                            $city    = trim($line[1]);
                            $airport = trim($line[2]);
                            $code    = trim($line[3]);
                            $terminal= trim($line[4]);
                            $business_type  = trim($line[10]);
                            $airport_type   = trim($line[6]);
                            $category       = trim($line[7]);
                            $service_company= trim($line[5]);
                            $packageType    = trim($line[8]);
                            $package_name   = trim($line[9]);
                            $adult_amount   = trim($line[14]);
                            $children_amount= trim($line[15]);
                            $get_city_id   = $csvUpload->getCity($country,$city);
                            $check_airport = $csvUpload->checkAirport($get_city_id,$code,$airport);
                            $airport_id    = $check_airport->token;
                            $token = $csvUpload->distributorAirport('2736548475','9876543210',$airport_id);
                            $distributor_airport_token = $token;
                            $terminal_id         = $csvUpload->getTerminal($terminal);
                            $business_type_id    = $csvUpload->getBussinessType($business_type);
                            $airport_type_id     = $csvUpload->getAirportType($airport_type);
                            $airport_category_id = $csvUpload->getCategoryId($category);
                            $airport_relation_id = $csvUpload->airportTerminalTypeRelation(
                                $airport_id,$terminal_id,$airport_type_id,$airport_category_id
                            );
                            $service_provider_id = 9876543210;
                            
                            $provider_company_id = $csvUpload->providerCompany(
                                $service_company,$service_provider_id,$business_type_id
                            );
                            $provider_location_id= $csvUpload->providerLocation(
                                $provider_company_id,$airport_id
                            );
                            if($packageType=="Individual"){
                                $service_id          = $csvUpload->serviceId(
                                    $provider_company_id,"Individual",$package_name
                                );
                                $bussiness_relation_id= $csvUpload->serviceBussinessRelation(
                                    $service_id,$business_type_id
                                ); 
                            }else{
                                $service_id          = $csvUpload->serviceId(
                                    $provider_company_id,"Bundle",$package_name
                                );
                                $business_type_Array =  explode("\n", str_replace(["\r","\t"], '', $line[12]));
                                $bussiness_relation_id= $csvUpload->serviceBussinessRelationBundle(
                                    $service_id,$business_type_Array
                                );
                            }
                            $service_location_id = $csvUpload->serviceLocationId(
                                $service_id,$airport_relation_id,$adult_amount,$children_amount
                            );
                            $array_description   = explode("\n", str_replace(["\r","\t"], '', $line[11]));
                            $description_ids     = $csvUpload->description(
                                $service_location_id,$array_description
                            );
                            $objNew = new stdClass();
//                            $objNew->country      = $country;
//                            $objNew->city_name    = $city;
//                            $objNew->city_id      = $get_city_id;
//                            $objNew->check_airport= $check_airport;
//                            $objNew->distributor_airport_token  = $distributor_airport_token;
//                            $objNew->terminal     = $terminal;
//                            $objNew->terminal_id  = $terminal_id;
//                            $objNew->business_type   = $business_type;
//                            $objNew->business_type_id= $business_type_id;
//                            $objNew->airport_type    = $airport_type;
//                            $objNew->airport_type_id = $airport_type_id;
//                            $objNew->category        = $category;
//                            $objNew->category_id     = $airport_category_id;
//                            $objNew->airport_relation_id = $airport_relation_id;
//                            $objNew->provider_company_id = $provider_company_id;
//                            $objNew->provider_location_id= $provider_location_id;
//                            $objNew->packageType     = $packageType;
//                            $objNew->package_name    = $package_name;
//                            $objNew->service_id      = $service_id;
//                            $objNew->bussiness_relation_id= $bussiness_relation_id;
//                            $objNew->service_location_id  = $service_location_id;
//                            $objNew->adult_amount    = $adult_amount;
//                            $objNew->children_amount = $children_amount;
//                            $objNew->description_ids = $description_ids;
                            array_push($array,$objNew);
                        }
                    }
                }
                $row++;
            }
            fclose($handle);
            $obj->status_code = 201;
            $obj->message = $array;
        }
    }else{
        $obj->status_code = 503;
        $obj->message = "Error2";
    }
}else{
    $obj->status_code = 503;
    $obj->message = "Error";
}
echo json_encode($obj);