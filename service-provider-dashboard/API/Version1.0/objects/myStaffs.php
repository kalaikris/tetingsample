<?php
class MyStaffs extends Database{
    
    //selecting all user roles
    function getUserRoles(){
        $query ="SELECT
        `user_role`.`token`,
        `service__provider_company`.`name` AS `CompanyName`,
        `user_role`.`name` AS `UserRoleName`,
        `user_role`.`created_datetime`
        FROM
        `service__provider_company_location_user_role` AS `user_role`
        LEFT JOIN `service__provider_company_location` AS `location` ON (`user_role`.`service_provider_company_location_token`=`location`.`token`)
        LEFT JOIN `service__provider_company` ON (`location`.`company_token`=`service__provider_company`.`token`)
        WHERE `user_role`.`status`='1'
        AND `user_role`.`service_provider_company_location_token`=:token";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('token', $this->serviceProviderCompanyLocationToken);
        $stmt->execute();
        return $stmt;
    }
    //Fetching all user role data
    function readUserRoles($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->user_role_token = $row["token"];
            $obj->company_name = $row["CompanyName"];
            $obj->user_role_name = $row["UserRoleName"];
            $obj->user_role_created = nl2br(date("d M, Y \n h:i A",strtotime($row['created_datetime'])));
            $obj->action = '<div class="">
                                <a href="javascript:void(0)" class="edit_userRole">Edit</a>
                                <a href="javascript:void(0)" class="delete_userRole">Delete</a>
                            </div>';
            array_push($array, $obj);
        }
        return $array;
    }
    //total records of the my staffs
    function readTotalMyStaffCount(){
        $query = "SELECT `service__provider_company_location_staffs`.`id` FROM `service__provider_company_location_staffs`
        INNER JOIN `service__provider_company_location_user_role` ON `service__provider_company_location_staffs`.`user_role_token`=`service__provider_company_location_user_role`.`token`
        LEFT JOIN `users__booking_detail` ON `users__booking_detail`.`assignee_token`=`service__provider_company_location_staffs`.`token`
        WHERE `service__provider_company_location_staffs`.`service_provider_company_location_token`=? AND `service__provider_company_location_staffs`.`status`='1' AND `service__provider_company_location_staffs`.`is_admin`='0' GROUP BY `service__provider_company_location_staffs`.`token`";
        $stmt1 = $this->conn->prepare( $query );
        $stmt1->bindParam(1, $this->service_location);
        $stmt1->execute();
        return $stmt1;
    }
    //count of the searched letter or word from my staff table
    function serverMyStaffFilter(){
        $searchQuery = $this->searchQuery;
        $query = "SELECT `service__provider_company_location_staffs`.`id` 
        FROM `service__provider_company_location_staffs` 
        INNER JOIN `service__provider_company_location_user_role` ON `service__provider_company_location_staffs`.`user_role_token`=`service__provider_company_location_user_role`.`token`
        LEFT JOIN `users__booking_detail` ON `users__booking_detail`.`assignee_token`=`service__provider_company_location_staffs`.`token` 
        WHERE `service__provider_company_location_staffs`.`service_provider_company_location_token`=? AND `service__provider_company_location_staffs`.`status`='1' AND `service__provider_company_location_staffs`.`is_admin`='0' $searchQuery GROUP BY `service__provider_company_location_staffs`.`token`";
        $stmt1 = $this->conn->prepare( $query );
        $stmt1->bindParam(1, $this->service_location);
        $stmt1->execute();
        return $stmt1;
    }
    //selecting all my staffs data
    function serverMyStaff(){
        $rowStart    = $this->rowStart;
        $rowperpage  = $this->rowperpage;
        $searchQuery = $this->searchQuery;
        $columnName  = $this->columnName;
        $columnSortOrder = $this->columnSortOrder;
        $query1="SELECT
        `service__provider_company_location_staffs`.`token`,
        `service__provider_company_location_staffs`.`staff_id`,
        `service__provider_company_location_staffs`.`image`,
        
        `service__provider_company_location_staffs`.`title`,
        `service__provider_company_location_staffs`.`user_role_token`,
        `service__provider_company_location_staffs`.`country_code`,
        `service__provider_company_location_staffs`.`mobile_number`,
        
        `service__provider_company_location_staffs`.`name` AS `employeeName`,
        `service__provider_company_location_staffs`.`email` AS `employeeEmail`,
        CONCAT('+',`service__provider_company_location_staffs`.`country_code`,' ',`service__provider_company_location_staffs`.`mobile_number`) AS `contactNumber`,
        DATE_FORMAT(`service__provider_company_location_staffs`.`join_date`,'%e, %b %Y') AS `joined_on`,
        `service__provider_company_location_user_role`.`name` AS `user_role_name`,
        COUNT(`users__booking_detail`.`assignee_token`) AS `total_service_done`
        FROM `service__provider_company_location_staffs`
        INNER JOIN `service__provider_company_location_user_role` ON `service__provider_company_location_staffs`.`user_role_token`=`service__provider_company_location_user_role`.`token`
        LEFT JOIN `users__booking_detail` ON `users__booking_detail`.`assignee_token`=`service__provider_company_location_staffs`.`token`
        WHERE `service__provider_company_location_staffs`.`service_provider_company_location_token`=? AND `service__provider_company_location_staffs`.`status`='1' AND `service__provider_company_location_staffs`.`is_admin`='0'
        $searchQuery GROUP BY `service__provider_company_location_staffs`.`token`
        ORDER BY $columnName $columnSortOrder
        LIMIT $rowStart,$rowperpage";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bindParam(1, $this->service_location);
        $stmt1->execute();
        return $stmt1;
    }
    
    function serverReadMyStaff($stmt1){
        $array = [];
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->employee_id  = $row["total_service_done"]=='0' ? $row["staff_id"] : '<span class="table_link" onclick="assigned_orders('.$row["token"].')">'.$row["staff_id"].'</span>';
            $url = "'https://airportzo.net.in/service-provider-dashboard/asset/addcapture.png'";
            $obj->employee_imageid = '<div class="cont-common-box">
                <ul class="cont_control">
                    <li><img src="'.$row['image'].'" alt="darrell" class="darrell" style="width: 50px;" onerror="this.onerror=null;this.src='.$url.'"></li>
                    <li>'.$row['employeeName'].'</li>
                </ul>
            </div>';
            $obj->contact_number    = $row['contactNumber'];
            
            $obj->joined_on         = $row['joined_on'];
            $obj->user_role         = $row['user_role_name'];
            $obj->total_service_done= $row["total_service_done"]=='0' ? '-' : $row["total_service_done"];
            $obj->edit_action            = '<i class="fa fa-pencil-square-o blue-link" onclick="staff_edit('.$row["token"].',\''.$row["image"].'\',\''.$row["staff_id"].'\',\''.$row["employeeName"].'\',\''.$row["employeeEmail"].'\',\''.$row["contactNumber"].'\',\''.$row["user_role_token"].'\')">Edit</i><i class="fa fa-trash-o deletebtn" onclick="delete_staff('.$row["token"].')">Delete</i>';
            
            $obj->token             = $row['token'];
            $obj->staff_id          = $row['staff_id'];
            $obj->employee_image    = $row['image'];
            $obj->employee_primary_title= $row['title'];
            $obj->employee_email    = $row['employeeEmail'];
            $obj->employee_name     = $row['employeeName'];
            $obj->country_code      = $row['country_code'];
            $obj->employee_mobile   = $row['mobile_number'];
            $obj->user_role_token   = $row['user_role_token'];
            array_push($array, $obj);
        }
        return $array;
    }
        
    //Fetching all my staffs data
    function serverReadMyStaffOld($stmt1){
//        while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
//            $url = "'https://airportzo.net.in/service-provider-dashboard/asset/addcapture.png'";
//            $data[] = array(
//            "token"=>$row1["token"],
//            "employee_id"=>$row1["total_service_done"]=='0' ? $row1["staff_id"] : '<a onclick="assigned_orders('.$row1["token"].')">'.$row1["staff_id"].'</a>',
//            "employee_image"=>'<div class="cont-common-box">
//                                    <ul class="cont_control">
//                                        <li><img src="'.$row1['image'].'" alt="staff-image" style="width: 100px;" onerror="this.onerror=null;this.src='.$url.'"></li>
//                                        <li>'.$row1['employeeName'].'</li>
//                                    </ul>
//                                </div>',
//            "employee_email"=>$row1["employeeEmail"],
//            "contact_number"=>$row1["mobileNumber"],
//            "joined_on"=>$row1["joined_on"],
//            "user_role"=>$row1["user_role_name"],
//            "total_service_done"=>$row1["total_service_done"]=='0' ? '-' : $row1["total_service_done"],
//            "action"=>'<i class="fa fa-pencil-square-o blue-link" onclick="staff_edit('.$row1["token"].',\''.$row1["image"].'\',\''.$row1["staff_id"].'\',\''.$row1["employeeName"].'\',\''.$row1["employeeEmail"].'\',\''.$row1["mobileNumber"].'\',\''.$row1["user_role_name"].'\')">Edit</i>',
//            );  
//        }
//        return $data;
    }
    //Checking is employee id exist in my_staff table
    function checkEmployeeIdExist(){
        $query = "SELECT `staff_id` FROM `service__provider_company_location_staffs` WHERE `staff_id`=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->employee_id);
        $stmt->execute();
        return $stmt;
    }
    function checkEmployeeIdUpdateExist(){
        $query = "SELECT `staff_id` FROM `service__provider_company_location_staffs` WHERE `staff_id`=?
        AND `token`!=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->employee_id);
        $stmt->bindParam(2,$this->employee_token);
        $stmt->execute();
        return $stmt;
    }
    
    //generating new token
     function tokenGenerate($table_name,$column_name){
        $random = rand(1000000000,9999999999);
        $val=true;
        do{
            $query = "SELECT `$column_name` FROM `$table_name`  WHERE `$column_name`='$random'";
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
            
            $count = $stmt->rowCount();
            if($count==0){
                $val = false;
            }else{
                $random = rand(1000000000,9999999999);
            }
        }while($val);
        return $random;
    }
    //creating new my staff data
    function insertMyStaffs($cur_date){
        $query1 = "INSERT INTO `service__provider_company_location_staffs` SET
        `token`=:token,
        `staff_id`=:employee_id,
        `service_provider_company_location_token`=:location_token,
        `business_id`=:business_id,
        `password`=:password,
        `image`=:employee_image,
        `title`=:employee_primary_title,
        `name`=:employee_name,
        `email`=:employee_email,
        `country_code`=:employee_country_code,
        `mobile_number`=:employee_mobile_number,
        `join_date`='$cur_date',
        `user_role_token`=:employee_user_role,
        `status`='1',
        `is_available`='0'";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam('token', $this->employee_token);
        $stmt1->bindParam('location_token', $this->location_token);
        $stmt1->bindParam('business_id', $this->businessId);
        $stmt1->bindParam('password', $this->password);
        $stmt1->bindParam('employee_id', $this->employee_id);
        $stmt1->bindParam('employee_image', $this->employee_image);
        $stmt1->bindParam('employee_primary_title', $this->employee_primary_title);
        $stmt1->bindParam('employee_name', $this->employee_name);
        $stmt1->bindParam('employee_email', $this->employee_email);
        $stmt1->bindParam('employee_country_code', $this->employee_country_code);
        $stmt1->bindParam('employee_mobile_number', $this->employee_mobile_number);
        $stmt1->bindParam('employee_user_role', $this->employee_user_role);
        if($stmt1->execute()){
            return true;
        }else{
            return false;
        }       
    }
    //Update my staff data
    function updateMyStaffs(){
        $query1 = "UPDATE `service__provider_company_location_staffs` SET
        `staff_id`=:employee_id,
        `image`=:employee_image,
        `title`=:employee_primary_title,
        `name`=:employee_name,
        `email`=:employee_email,
        `country_code`=:employee_country_code,
        `mobile_number`=:employee_mobile_number,
        `user_role_token`=:employee_user_role
        WHERE `token`=:token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam('employee_id', $this->employee_id);
        $stmt1->bindParam('employee_image', $this->employee_image);
        $stmt1->bindParam('employee_primary_title', $this->employee_primary_title);
        $stmt1->bindParam('employee_name', $this->employee_name);
        $stmt1->bindParam('employee_email', $this->employee_email);
        $stmt1->bindParam('employee_country_code', $this->employee_country_code);
        $stmt1->bindParam('employee_mobile_number', $this->employee_mobile_number);
        $stmt1->bindParam('employee_user_role', $this->employee_user_role);
        $stmt1->bindParam('token', $this->employee_token);
        if($stmt1->execute()){
            return true;
        }else{
            return false;
        }       
    }
    function deleteMyStaffs(){
        $query1 = "UPDATE `service__provider_company_location_staffs` SET
        `status`='4'
        WHERE `token`=:token";
        $stmt1 = $this->conn->prepare( $query1 );
        $stmt1->bindParam('token', $this->employee_token);
        if($stmt1->execute()){
            return true;
        }else{
            return false;
        }       
    }
    //list provider modules
    function ProviderModules(){
        $query = "SELECT `token`,
        `module_name` 
        FROM `modules` 
        WHERE `type`='1'";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    //view provider modules
    function ProviderModuleView($stmt) {
        $array = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass;
            $obj->moduleToken  = $row['token'];
            $obj->moduleName   = $row['module_name'];
            array_push($array, $obj);
        }
        return $array;
    }
    //create user_role
    function createRole(){
        $query = "INSERT INTO `service__provider_company_location_user_role` SET 
        `token`=:token,
        `service_provider_company_location_token`=:service_provider_company_location_token,
        `name`=:name,
        `created_datetime`=:created_datetime";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $this->roleToken);
        $stmt->bindParam('service_provider_company_location_token', $this->service_provider_company_location_token);
        $stmt->bindParam('name', $this->roleName);
        $stmt->execute();
        return $stmt;
    }
    function staffIdCheck($staffId){
        $query = "SELECT `token` FROM `service__provider_company_location_staffs` WHERE `staff_id`=:staff_id";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('staff_id', $staffId);
        $stmt->execute();
        return $stmt;
    }
    function getRoleToken($userRole){
        $query = "SELECT `token` FROM `service__provider_company_location_user_role` 
        WHERE `name`=:name
        AND `service_provider_company_location_token`=:company_location_token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('name', $userRole);
        $stmt->bindParam('company_location_token', $this->companyLocationToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['token'];
    }
    function addStaffCsv($obj){
        $query = "INSERT INTO `service__provider_company_location_staffs` SET 
        `token`=:token,
        `service_provider_company_location_token`=:company_location_token,
        `is_admin`='0',
        `business_id`=:business_id,
        `password`=:password,
        `staff_id`=:staff_id,
        `title`=:title,
        `name`=:name,
        `email`=:email,
        `country_code`=:country_code,
        `mobile_number`=:mobile_number,
        `join_date`=:join_date,
        `user_role_token`=:user_role_token,
        `status`='1',
        `is_available`='0',
        `date_time`=:date_time";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam('token', $obj->token);
        $stmt->bindParam('company_location_token', $this->companyLocationToken);
        $stmt->bindParam('business_id', $obj->businessId);
        $stmt->bindParam('password', $obj->password);
        $stmt->bindParam('staff_id', $obj->staffId);
        $stmt->bindParam('title', $obj->title);
        $stmt->bindParam('name', $obj->name);
        $stmt->bindParam('email', $obj->email);
        $stmt->bindParam('country_code', $obj->code);
        $stmt->bindParam('mobile_number', $obj->number);
        $stmt->bindParam('join_date', $this->gmDate);
        $stmt->bindParam('user_role_token', $obj->userRoleToken);
        $stmt->bindParam('date_time', $obj->gmDateTime);
        $stmt->execute();
        return $stmt;
    }
    function bookings(){
        $query = "SELECT `users__booking_detail`.`token`,
        `users__booking`.`booking_number`,
        `users`.`name` AS `user_name`,
        `users__booking_detail`.`total_adult`,
        `users__booking_detail`.`total_children`,
        `users__booking_detail`.`service_date_time`,
        `airport__category`.`name` AS `airport_category`,
        `service`.`name` AS `service_name`,
        `users__booking_detail`.`status`,
        `users__booking_detail`.`rating`
        FROM `users__booking_detail`  
        INNER JOIN `users__booking` ON `users__booking`.`token`=`users__booking_detail`.`booking_token`
        INNER JOIN `users` ON `users`.`token`=`users__booking`.`user_token`
        INNER JOIN `airport` ON `airport`.`token`=`users__booking_detail`.`airport_token`
        INNER JOIN `airport__type` ON `airport__type`.`token`=`users__booking_detail`.`airport_type`
        INNER JOIN `airport__category` ON 
            `airport__category`.`token`=`users__booking_detail`.`airport_category`
        INNER JOIN `service` ON `service`.`token`=`users__booking_detail`.`service_token`
        WHERE `users__booking_detail`.`assignee_token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->staffToken);
        $stmt->execute();
        return $stmt;
    }
    function bookingView($stmt){
        $array=[];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $obj = new stdClass();
            $obj->bookingToken = $row["token"];
            $obj->bookingNumber= $row["booking_number"];
            $obj->userName     = $row["user_name"];
            $obj->totalAdult   = $row["total_adult"];
            $obj->totalChildren= $row["total_children"];
            $obj->serviceDate  = convertDate("d M, Y",$row["service_date_time"]);
            $obj->serviceTime  = convertDate("H:i",$row["service_date_time"]);
            $obj->travelType   = $row["airport_category"];
            $obj->service_name = $row["service_name"];
            $obj->rating       = $row["rating"];
            $obj->status       = $row["status"];
            array_push($array, $obj);
        }
        return $array;
    }
    function staffDetails(){
        $query = "SELECT `token`,`name`,
        `country_code`,
        `mobile_number`,
        `image`
        FROM `service__provider_company_location_staffs` 
        WHERE `token`=:token";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(":token", $this->staffToken);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->token        = $row["token"];
        $obj->name        = $row["name"];
        $obj->mobileNumber= '+'.$row["country_code"]." ".$row["mobile_number"];
        $obj->image       = $row["image"];
        $obj->servicesCount= $this->bookingCount;
        return $obj;
    }
    public function generatePassword(){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ/abcdefghijklmnopqrstuvwxyz';
        $randstring = substr(str_shuffle($str_result), 0, 10);
        return $randstring;
    }
}
?>