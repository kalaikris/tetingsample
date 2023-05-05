<?php
## Read value
$draw        = $_POST['draw'];
$rowStart    = $_POST['start'];
$rowperpage  = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName1 = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value'];
## oops conncetivity
$obj=new stdClass();
include '../../../../config/core.php';
$inputData = getInputs();
include_once '../objects/myStaffs.php';
$my_staffs = new MyStaffs();
$my_staffs->service_location = $_GET["service_provider_companylocation_token"];
    # Search 
    $searchQuery = " ";
    if($searchValue != ''){
        $searchQuery = " AND ( 
        `service__provider_company_location_staffs`.`staff_id` LIKE '%$searchValue%' OR
        `service__provider_company_location_staffs`.`name` LIKE '%$searchValue%' OR
        `service__provider_company_location_staffs`.`mobile_number` LIKE '%$searchValue%' OR
        `service__provider_company_location_staffs`.`join_date` LIKE '%$searchValue%' OR
        `service__provider_company_location_user_role`.`name` LIKE '%$searchValue%'
        )";
    }
    ## Total number of records without filtering
    $stmt=$my_staffs->readTotalMyStaffCount();
    $totalRecords = $stmt->rowCount();
    ## filet query values
    $my_staffs->searchQuery    = $searchQuery;
    $my_staffs->rowStart       = $rowStart;
    $my_staffs->rowperpage     = $rowperpage;
    switch ($columnName1) {
        case "employee_id":
            $columnName = "`service__provider_company_location_staffs`.`staff_id`";
        break;
        case "employee_name":
            $columnName = "`service__provider_company_location_staffs`.`name`";
        break;
        case "contact_number":
            $columnName = "`service__provider_company_location_staffs`.`mobile_number`";
        break;
        case "joined_on":
            $columnName = "`service__provider_company_location_staffs`.`join_date`";
        break;
        case "user_role":
            $columnName = "`service__provider_company_location_user_role`.`name`";
        break;
        default:$columnName = "`service__provider_company_location_staffs`.`id`";
    }
    $my_staffs->columnName     = $columnName;
    $my_staffs->columnSortOrder= $columnSortOrder;
    ## filer count check
    $stmt = $my_staffs->serverMyStaffFilter();
    $totalRecordwithFilter = $stmt->rowCount();
    ## pick limit datas
    $stmt = $my_staffs->serverMyStaff();
    $data = $my_staffs->serverReadMyStaff($stmt);
    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    echo json_encode($response);
?>