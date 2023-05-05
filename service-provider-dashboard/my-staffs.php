<?php
    session_start();
    include_once '../config/core.php';
    include '../security/secure.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>airportzo</title>
        <link rel="shortcut icon" type="image/png" href="./asset/img/airportzo-icon.png"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"/>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
        <!-- data table link -->
        <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css"/>
        <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css"/>
        <!--  data table CSS only -->
        <link rel="stylesheet" href="../js/data-table-css/bootstrap.css"/>
        <!-- custm css -->
        <link rel="stylesheet" href="./css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/booklist.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/fonts.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/commen.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/my-staffas.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/assigned-orders.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/select.css">
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
        <link href="css/sweet_alert.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
        /* custon sidemenu drop down */
        .sub-product{
        }
        .sub-product label{
            width: 100%;
        }
        .Service-items{
            padding-right: 15px;
            position:relative;
        }
        .Service-items:after{
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        .Service-items-desc{
            width:100%;
        }
        .Service-sub-items{
            height: 0px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
        }
        .Service-sub-items li:not(:last-child){
            border-bottom: 1px solid #dfdede;
        }
        .Service-item{
            font: 13px/15px var(--font-regular);
            display: block;
            padding: 5px 6px;
            color: #000000b3 !important;
        }
        .Service-item:hover{
            background-color: #dbe3e5;
            color: #000;
        }
        .accodiant-radio{
            display:none;
        }
        .accodiant-radio:checked ~ .Service-sub-items{
            height: auto;
            opacity: 1;
            visibility: visible;
            transition: .5s;
            border-radius: 4px;
            padding: 0px 0px;
            background: #eff3f4;
            box-shadow: 1px 1px 7px 0px #eff3f445;
            margin: 5px 0px;
        }
        .accodiant-radio:checked ~ .Service-items:after{
            transform: rotate(180deg);
            transition: .5s;
        }
        .a_button {
        	display: inline-block;
        }
        .left-buttons{
        	align-items: center;
        }
        .File-btn{
        	padding:12px 20px;
        	font: 16px/21px var(--font-medium);
        }
        img.avatar{
        	width: 192px;
			height: 180px;
			object-fit: contain;
        }
        /* -=======- */
        </style>
    </head>
    <body id="page">
        <div id="loading"></div>
        <header id="header"></header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar"></div>
                <div class="slider-desc-set">
                    <div id="my-staffs-hide">
                        <div class="top-set">
                            <div class="rghit-cont">
                                <h1 class="mystaff-text">My Staffs</h1>
                                <span class="total-stafs">Total staffs - <span id="total_mystaff"></span></span>    
                            </div>
                            <div class="left-buttons">
                                <div class="employee">
                                    <button class="cust-btn cust-btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Employee</button>
                                </div>
                                <div class="upload">
                                    <button class="cust-btn cust-btn-primary" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">Upload CSV</button>
                                    <a class="a_button " href="samplecsv/mystaffs.csv" download><button class="File-btn" type="button">Sample CSV File</button></a>
                                </div>
                            </div>
                        </div>
                        <table id="mystaffList" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Employee Token</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Employee Email</th>
                                    <th>Contact Number</th>
                                    <th>Joined on</th>
                                    <th>User Role</th>
                                    <th>Service done</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- assigned-order -->
                    <div id="assigned-orders-all" class="hide">
                        <div id="tab-1" class="tab-content current">
                            <div class="profile-tital">
                                <div class="profile-icon">
                                    <img src="" id="staff__image" class="darrell" alt="darrell">
                                </div>
                                <div class="name">
                                    <h3 id="staff__name"></h3>
                                    <p id="unique_staff_token"></p>
                                </div>
                                <div class="cell-num">
                                    <p>Mobile Number</p>
                                    <num id="staff_mobilenumber"></num>
                                </div>
                                <div class="ser-done">
                                    <p>Services done</p>
                                    <num id="total_servicedone"></num>
                                </div>
                            </div>
                            <div class="single-line"></div>
                            <div class="assigned">
                                <h2>Assigned Orders</h2>
                            </div>
                            <table id="assigned-table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Booking Token</th>
                                        <th>Booking Number</th>
                                        <th>Customer Name</th>
                                        <th>Service Avail On</th>
                                        <th>Package</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="assigned_ordersdetails"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </main>

            <!-- modal-popap -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal_heder">
                                <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
                            </div>
                            <div class="close_icon">
                                <button type="button" class="close"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="file">
                                <label for="mystaffimage" class="uplode-img">
                                    <img src="./asset/img/uplod.png" id="view_mystaff" class="avatar" alt="" />
                                </label>
                                <input id="valid_mystaffimage" type="hidden">
                                <input type="file" id="mystaffimage" onchange = "ValidateFileUpload('mystaffimage')" hidden>
                                <p id="mystaffimageErr" style="color: red; font-size: 13px;"></p>
                            </div>
                            <div class="input-form-group cust-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="emp_id">Employee ID</label>
                                        <input type="text" class="input-box" id="emp_id" placeholder="Enter Employee ID" onkeypress="return isNumber(event)" onpaste="isNumber(this)">
                                    </div>
                                    <p id="emp_idErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="select-group">
                                        <select class="select-box cust-width" id="contacted_person">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <label for="emp_name">Employee Name</label>
                                        <input type="text" class="input-box" id="emp_name" placeholder="Enter Employee Name">
                                    </div>
                                    <p id="emp_nameErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <div>
                                            <p>Email Address</p>
                                            <input type="email" class="input-box" id="emailAddress" placeholder="Enter Email Address" autocomplete="off">
                                        </div> 
                                    </div>
                                    <div>
                                        <p id="emailAddressErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="login-input-action-set" id="mobile_alt_no">
                                        <div class="login-input-group phone">
                                            <label for="mobile_code">Mobile Number</label>
                                            <input type="tel" class="login-input-box" id="mobile_code" name="phone" />
                                        </div>
                                    </div>
                                    <p id="mobile_codeErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12"> <!-- bg-arrow -->
                                    <div class="input-box-set">
                                        <label for="user_role">User Role</label>
                                        <select class="select-input" id="user_role"></select>
                                    </div>
                                </div>
                                <p id="user_roleErr" style="color: red; font-size: 13px;"></p>
                                <div class="add-emp-btn-set">
                                    <button type="button" class="cust-btn cust-btn-xl cust-btn-success col-12" onclick="add_employee()">Add Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal_heder">
                                <h5 class="modal-title">Update Employee</h5>
                            </div>
                            <div class="close_icon">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="update_staff_token">
                            <div class="col-md-12 text-center mb-4">
                                <label class="upload_label" for="edit_product_image_upload">
                                    <div class="upload_file">
                                        <img class="uploadimg" alt="" id="edit_product_image_url" style="max-width:300px;height: 180px;object-fit: contain;" src="assets/icons/upload.png">
                                        <input id="edit_product_image_valid" type="hidden">
                                        <input id="edit_product_image_upload" onchange="file_upload('edit_product_image','edit_product_image_url','assets/icons/upload.png')" type="file" accept="image/x-png, image/gif, image/jpeg, image/jpg" style="display:none;">
                                    </div>
                                    <p id="edit_product_image_uploadErr" style="color: red; font-size: 13px;"></p>
                                </label>
                            </div>
                            <div class="input-form-group cust-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="emp_id">Employee ID</label>
                                        <input type="text" class="input-box" id="update_emp_id" placeholder="Enter Employee ID" onkeypress="return isNumber(event)" onpaste="isNumber(this)">
                                    </div>
                                    <p id="update_emp_idErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="select-group">
                                        <select class="select-box cust-width" id="update_contacted_person">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <label for="emp_name">Employee Name</label>
                                        <input type="text" class="input-box" id="update_emp_name" placeholder="Enter Employee Name">
                                    </div>
                                    <p id="update_emp_nameErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <div>
                                            <p>Email Address</p>
                                            <input type="email" class="input-box" id="update_emailAddress" placeholder="Enter Email Address" autocomplete="off">
                                        </div> 
                                    </div>
                                    <div>
                                        <p id="update_emailAddressErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="login-input-action-set" id="update_mobile_alt_no">
                                        <div class="login-input-group phone">
                                            <label for="mobile_code">Mobile Number</label>
                                            <input type="tel" class="login-input-box" id="update_mobile_code" name="phone" />
                                        </div>
                                    </div>
                                    <p id="update_mobile_codeErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="user_role">User Role</label>
                                        <select class="select-input" id="update_user_role"></select>
                                    </div>
                                </div>
                                <p id="update_user_roleErr" style="color: red; font-size: 13px;"></p>
                                <div class="add-emp-btn-set">
                                    <button type="button" class="cust-btn cust-btn-xl cust-btn-success col-12" onclick="update_employee()">Update Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Upload CSV-->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Upload CSV File</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row cont-text-title">
                                <label class="upload_filed" for="csv_file_upload">
                                    <input id="csv_file_valid" type="hidden">
                                    <input id="csv_file_upload" onchange="file_upload_csv('csv_file','csv_view_url','asset/upload_csv_done.png')" type="file" accept=".csv" style="display:none;">
                                    <img alt="" src="asset/csvfile.png" class="csvfile" id="csv_view_url" />
                                    <h2 id="csv_file_name">Upload Files</h2>
                                </label>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="cancelbtn" data-dismiss="modal" onclick="cancelcsvfile()">Cancel</button>
                            <button type="button" class="savebtn" id="csv_upload_button" onclick="upload_csv_file()">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Upload CSV-->

    <!-- jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <!-- data table js -->
    <script src="js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="js/data-table-js/dataTables.dateTime.min.js"></script>
    <!-- JavaScript Bundle with Popper boostrap -->
    <script src="js/data-table-js/dataTables.bootstrap4.min.js"></script>
    <script src="js/data-table-js/searchBuilder.bootstrap4.min.js"></script>
    <script src="js/intlTelInput.js"></script>
    <script src="js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- data table custm js -->
    <script src="js/table.js"></script>
    <!-- sidebar-heder -->
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/select.js"></script>
    <script src="js/dropdowndata.js?v=<?php echo $cur_date_time; ?>"></script>
    <script>
    var apiPath = "<?php echo $apiPath; ?>";
    $(document).ready(() => {
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        serviceprovider_sidemenu(staff_token);
        $("#my-staffs").addClass("actives");

        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }
        var datas = {
            "securedairportzo":"secured",
            "serviceProviderCompanyLocationToken":companylocation_token
        }
        var jsondata1 = JSON.stringify(datas);
        $.ajax({
            type:'POST',
            dataType:'json',
            url: apiPath+"/my-staffs/readUserRoles.php",
            data: jsondata1,
        }).done(function(data){
            $('#user_role').empty();
            $('#update_user_role').empty();
            var data = data.userrole_data;
            var userroledata='<option value="">Select Your Role</option>';
            for(var key in data)
            {
                userroledata +='<option value="'+data[key].user_role_token+'">'+data[key].user_role_name+'</option>';
            }
            $("#user_role").html(userroledata);
            $("#update_user_role").html(userroledata);
            $("#user_role,#update_user_role").change(function() {
            }).chosen({allow_single_deselect:true});({
                width: '100%', 
                filter: true
            });
        });
    });

    fetch_data();
    var table;
    function fetch_data(){
        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }
        table = $("#mystaffList").DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':apiPath+"/my-staffs/readMyStaffs.php?service_provider_companylocation_token="+companylocation_token,
                'dataSrc': function(data) {
                    $("#total_mystaff").html(data.iTotalDisplayRecords);
                    return data.aaData;
                    
                }
            },
            "order": [[0, "DESC" ]],
            'columns': [
                { data: 'token' },
                { data: 'employee_id' },
                { data: 'employee_imageid' },
                { data: 'employee_email' },
                { data: 'contact_number' },
                { data: 'joined_on' },
                { data: 'user_role' },
                { data: 'total_service_done' },
                { data: 'edit_action' }
            ],
            dom: 'Bfrtip',
            initComplete: function() {
                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            },
            language: {
                search: '<img src="asset/svg/Search_icon.svg">', searchPlaceholder: "Search" ,
                paginate: {
                    next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
                    previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
                }
            }
        });
    }

    setTimeout(clearSearchValue, 1700);
    function clearSearchValue() {
        $("#emailAddress").val('');   
    }

    function assigned_orders(staffToken){
        var datas = {
            "staffToken":staffToken
        }
        var Json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: `${apiPath}/my-staffs/singleStaffOrders.php`,
            data: Json_data,
            success: view_assigned_orders
        });
    }

    function view_assigned_orders(data){
        $("#my-staffs-hide").hide();
        $("#assigned-orders-all").show();
        if(data.status_code == 201){
            var staffdata = data.staffDetails;
            if(staffdata.image==""){
                $('#staff__image').attr("src",'asset/addcapture.png');
            }else{
                $('#staff__image').attr("src",staffdata.image);
            }
            $('#staff__name').html(staffdata.name);
            $('#unique_staff_token').html(staffdata.token);
            $('#staff_mobilenumber').html(staffdata.mobileNumber);
            $('#total_servicedone').html(staffdata.servicesCount);

            var staffbookingdata = data.bookings;
            var stafflist = "";
            for(var key in staffbookingdata){
            stafflist+=`<tr>
                        <td class="td-bule">${staffbookingdata[key].bookingToken}</td>
                        <td class="td-bule">${staffbookingdata[key].bookingNumber}</td>
                        <td>
                        ${staffbookingdata[key].userName}<br />
                        <small>${staffbookingdata[key].totalAdult} Adults | ${staffbookingdata[key].totalChildren} child</small>
                        </td>
                        <td>
                        ${staffbookingdata[key].serviceDate}<br />
                        <small>${staffbookingdata[key].serviceTime}</small>
                        </td>
                        <td><span>${staffbookingdata[key].service_name}</span></td>`;
                        if(staffbookingdata[key].rating=="0"){
                            stafflist+=`<td>-</td>`;
                        }else if(staffbookingdata[key].rating=="1"){
                            stafflist+=`<td><span class="fa fa-star checked"></span>`;
                        }else if(staffbookingdata[key].rating=="2"){
                            stafflist+=`<td><span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span></td>`;
                        }else if(staffbookingdata[key].rating=="3"){
                            stafflist+=`<td><span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span></td>`;
                        }else if(staffbookingdata[key].rating=="4"){
                            stafflist+=`<td><span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span></td>`;
                        }else{
                            stafflist+=`<td><span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span></td>`;
                        }
                        if(staffbookingdata[key].status=="Pending" || staffbookingdata[key].status=="Assign"){
                            stafflist+=`<td><span class="upcoming">Upcoming</span></td>`;
                        }else if(staffbookingdata[key].status=="Ongoing"){
                            stafflist+=`<td><span class="ongoing">Ongoing</span></td>`;
                        }else if(staffbookingdata[key].status=="Completed"){
                            stafflist+=`<td><span class="accepted">Completed</span></td>`;
                        }else if(staffbookingdata[key].status=="Cancelled"){
                            stafflist+=`<td><span class="rejected">Cancelled</span></td>`;
                        }
                        stafflist+=`</tr>`;
            }
        }
        $('#assigned_ordersdetails').html(stafflist);
        $("#assigned-table").DataTable({
            language: {
                search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                searchPlaceholder: "Search...",
            },
            buttons: [{
                extend: "searchBuilder",
                config: {
                depthLimit: 2,
                },
            },],
            dom: "Bfrtip",
            initComplete: function() {
                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            },
            columnDefs: [{
                type: "unknownType",
                targets: [3],
            },],
        });
    }

    var iti = '';
    var mask = "";
    var id = ["#mobile_code"];
    id.forEach(function (value, i) {
        var phoneInputID = value;
        var input = document.querySelector(phoneInputID);
        iti = window.intlTelInput(input, {  
            separateDialCode: false,
            utilsScript: "js/utils.js"
        });
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();
            newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
            newPlaceholder = newPlaceholder.replace(/[()]/g, '');
            newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
            iti.setNumber("");
            
            $(this).val('');
            $(this).attr('placeholder',newPlaceholder);
            mask = newPlaceholder.replace(/[1-9]/g, "0");
            // Apply the new mask for the input
            $(this).mask(mask);
            var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
            check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
        });
        iti.promise.then(function() {
            $(phoneInputID).trigger("countrychange");
        });
    });

    // For S3 bucket
    var image_id = ['mystaffimage']
    function image_upload_loop(key){
        var checkkey = key+1;
        if(checkkey>image_id.length){
              add_new_employee();
        }else{
            var fileUpload = document.getElementById(image_id[key]);
            var file = fileUpload.files[0];
            s3_file_upload(file, key);
        }
    }
     
    function s3_file_upload(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds + '.' + extension;
        var folder = 'Testing/';
        var objKey = folder + filename;
        var params = {
            Key: objKey,
            ContentType: file.type,
            Body: file
        };
        bucket.putObject(params, function (err, data) {
            if (err) {
                alert('ERROR: ' + err);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#valid_"+image_id[key]).val(image_fileurl);
                key++;
                image_upload_loop(key);
            }
        });
    }

    function ValidateFileUpload(id) {
        var fuData = document.getElementById(id).files[0].name;
        var FileExtension = fuData.split('.').pop().toLowerCase()
        if (FileExtension == "png" || FileExtension == "jpeg" || FileExtension == "jpg" || FileExtension == "pdf") {
            if(id == 'mystaffimage'){
                const [file_mystaff] = mystaffimage.files
                if (file_mystaff) {
                    view_mystaff.src = URL.createObjectURL(file_mystaff)
                }
            }
        }
        else {
            alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
        }
    }

    $('#mobile_code').on('keypress', function(){
        reset();
    });
    $('#mobile_code').on('change', function(){
        reset();
    });
    function reset(){
        document.getElementById("mobile_codeErr").innerHTML = "";
    };
    function add_employee(){
        var pass=0;
        if(document.getElementById("mystaffimage").value == ""){
            document.getElementById("mystaffimageErr").innerHTML = "* Please Upload Employee Image!";
        }else{
            document.getElementById("mystaffimageErr").innerHTML = "";
            pass++;
        }if(document.getElementById("emp_id").value.trim() == ""){
            document.getElementById("emp_idErr").innerHTML = "* Please Enter Employee ID!";
        }else{
            document.getElementById("emp_idErr").innerHTML = "";
            pass++;
        }
        var email = document.getElementById("emailAddress").value;
        mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email==''){
            document.getElementById("emailAddressErr").innerHTML = "* Please Enter Email Address !";
        }else if (email.match(mailformat)) {
            document.getElementById("emailAddressErr").innerHTML = "";
            pass++;
        }else{
            document.getElementById("emailAddressErr").innerHTML = "* Enter Valid Mail-ID";
        }if(document.getElementById("emp_name").value.trim() == ""){
            document.getElementById("emp_nameErr").innerHTML = "* Please Enter Employee Name!";
        }else{
            document.getElementById("emp_nameErr").innerHTML = "";
            pass++;
        }
        if(document.getElementById("mobile_code").value.trim() != ''){
            if (iti.isValidNumber()) {
                document.getElementById("mobile_codeErr").innerHTML = "";
                pass++;
            }else{
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                var errorCode = iti.getValidationError();
                document.getElementById("mobile_codeErr").innerHTML = errorMap[errorCode];
            }
        }else{
            document.getElementById("mobile_codeErr").innerHTML = "* Please Enter Mobile Number!";
        }
        if(document.getElementById("user_role").value.trim() == ""){
            document.getElementById("user_roleErr").innerHTML = "* Please Select User Role!";
        }else{
            document.getElementById("user_roleErr").innerHTML = "";
            pass++;
        }
        if(pass==6){
            image_upload_loop(0);
        }
    }

    function add_new_employee(){
        var employeeid = $('#emp_id').val();
        var mystaff_image = $('#valid_mystaffimage').val();
        var persons = $('#contacted_person').val();
        var employeename = $('#emp_name').val();
        var email_address = $('#emailAddress').val();
        var countryCode = $("#mobile_code").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
        countryCode = '+'+countryCode.replace(/[^0-9]/g,'');
        var employee_mobile = $('#mobile_code').val();
        var userroletoken = $('#user_role').val();
        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }

        var datas = {'employee_id':employeeid,'employee_image':mystaff_image,'employee_primary_title':persons,'employee_name':employeename,'employee_email':email_address,'employee_country_code':countryCode,'employee_mobile_number':employee_mobile,'employee_user_role':userroletoken,'service_provider_companylocation_token':companylocation_token,'type':'insert_staff'};
        var JsonData = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/my-staffs/addMyStaffs.php",
            data: JsonData
        }).done(function(data1) {
            if(data1.status_code == 200){
                swal({
                    title: "Success!",
                    text: data1.message,
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    location.reload();
                });
            }else{
                swal({
                    title: "Error!",
                    text: data1.message,
                    icon: "error",
                    button: "Ok",
                });
            }
        });
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (( charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
            return false;
        }
        return true;
    }

    function file_upload_csv(file_id, view_id, replace_src) {
        var fileUpload = document.getElementById(file_id + "_upload");
        var files = !!fileUpload.files ? fileUpload.files : [];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.csv|.CSV)$");
        if (regex.test(files[0].type)) {
            if (typeof(fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function(e) {
                    $('#' + view_id).attr('src', replace_src);
                    $('#' + file_id + '_valid').val("true");
                    $("#" + file_id + '_name').html(files[0].name);
                }
            }
        }
    }

    function cancelcsvfile() {
        var csvfilename = csv_file_upload.files[0];
        if(csvfilename == undefined) {
            $("#myModal").modal('hide');
        }else{
            $('#csv_file_name').text('Upload Files');
            document.getElementById('csv_view_url').src = 'https://airportzo.net.in/service-provider-dashboard/asset/csvfile.png';
            $('#csv_file_upload').val('');
        }
    }

    function upload_csv_file() {
        var valid = $('#csv_file_valid').val();
        if (valid == "true") {
            $('#csv_upload_button').prop('disabled', true);
            var myFormData = new FormData();
            myFormData.append('file_upload', csv_file_upload.files[0]);
            var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
            }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            }
            myFormData.append('service_provider_company_location_token', companylocation_token);
            $.ajax({
                dataType: "json",
                url: apiPath + "/csvUpload/staffCsvUpload.php",
                type: 'POST',
                async: false,
                processData: false, // important
                contentType: false, // important
                data: myFormData,
                success: function(data) {
                    if (data.status_code == 503) {
                        $('#csv_upload_button').prop('disabled', false);
                        swal(data.message);
                    }else if(data.status_code == 201){
                        swal("Csv data uploaded successfully!", {icon: "success",}).then((value) => {
                            location.reload();
                        });
                    }
                }
            });
        }else{
            swal("Please select a csv file!");
        }
    }

    function staff_edit(uniquestaff_token,staff_image,staff_id,staff_name,staff_email,staff_mobile,staff_userrole) {
        $("#UpdateModal").modal("show");
        $("#update_staff_token").val(uniquestaff_token);
        if(staff_image == ""){
            $("#edit_product_image_url").attr("src", "asset/img/uplod.png");
        }else{
            $("#edit_product_image_url").attr("src", staff_image);
        }
        $("#edit_product_image_valid").val(staff_image);
        $("#update_emp_id").val(staff_id);
        $("#update_emp_name").val(staff_name);
        $("#update_emailAddress").val(staff_email);
        $("#update_mobile_code").val(staff_mobile);
        $("#update_user_role").val(staff_userrole).trigger("chosen:updated");
        append_mobile();
    }

    var iti1 = '';
    var mask1 = "";
    function append_mobile(){
        var id = ["#update_mobile_code"];
        id.forEach(function (value, i) {
            var phoneInputID = value;
            var input = document.querySelector(phoneInputID);
            iti1 = window.intlTelInput(input, {  
                separateDialCode: false,
                utilsScript: "js/utils.js"
            });
            $(phoneInputID).on("countrychange", function(event) {
                var selectedCountryData = iti1.getSelectedCountryData();
                newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
                iti1.setNumber("");
                
                $(this).val('');
                $(this).attr('placeholder',newPlaceholder);
                mask1 = newPlaceholder.replace(/[1-9]/g, "0");
                // Apply the new mask for the input
                $(this).mask(mask1);
                var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
                check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
            });
        });
    }
    
    $('#update_mobile_code').on('keypress', function(){
        updatereset();
    });
    $('#update_mobile_code').on('change', function(){
        updatereset();
    });
    function updatereset(){
        document.getElementById("update_mobile_codeErr").innerHTML = "";
    };
    function update_employee(){
        var pass=0;
        if(document.getElementById("edit_product_image_valid").value == ""){
            document.getElementById("edit_product_image_uploadErr").innerHTML = "* Please Upload Employee Image!";
        }else{
            document.getElementById("edit_product_image_uploadErr").innerHTML = "";
            pass++;
        }if(document.getElementById("update_emp_id").value.trim() == ""){
            document.getElementById("update_emp_idErr").innerHTML = "* Please Enter Employee ID!";
        }else{
            document.getElementById("update_emp_idErr").innerHTML = "";
            pass++;
        }if(document.getElementById("update_emp_name").value.trim() == ""){
            document.getElementById("update_emp_nameErr").innerHTML = "* Please Enter Employee Name!";
        }else{
            document.getElementById("update_emp_nameErr").innerHTML = "";
            pass++;
        }
        var updateemail = document.getElementById("update_emailAddress").value;
        updatemailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (updateemail==''){
            document.getElementById("update_emailAddressErr").innerHTML = "* Please Enter Email Address !";
        }else if (updateemail.match(updatemailformat)) {
            document.getElementById("update_emailAddressErr").innerHTML = "";
            pass++;
        }else{
            document.getElementById("update_emailAddressErr").innerHTML = "* Enter Valid Mail-ID";
        }
        if(document.getElementById("update_mobile_code").value.trim() != ''){
            if (iti1.isValidNumber()) {
                document.getElementById("update_mobile_codeErr").innerHTML = "";
                pass++;
            }else{
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                var errorCode = iti1.getValidationError();
                document.getElementById("update_mobile_codeErr").innerHTML = errorMap[errorCode];
            }
        }else{
            document.getElementById("update_mobile_codeErr").innerHTML = "* Please Enter Mobile Number!";
        }if(document.getElementById("update_user_role").value.trim() == ""){
            document.getElementById("update_user_roleErr").innerHTML = "* Please Select User Role!";
        }else{
            document.getElementById("update_user_roleErr").innerHTML = "";
            pass++;
        }
        if(pass==6){
            var product_image_valid = $("#edit_product_image_valid").val();
            if(product_image_valid == "true"){
                edit_image_upload_loop(0);
            }else{
                update_staff();
            }
        }
    }

    var edit_image_id = ['edit_product_image'];
    function edit_image_upload_loop(key) {
        var valid = $("#" + edit_image_id[key] + "_valid").val();
        var checkkey = key + 1;
        if (valid == "true") {
            if (checkkey > edit_image_id.length) {
                update_staff();
            } else {
                var fileUpload = document.getElementById(edit_image_id[key] + "_upload");
                var file = fileUpload.files[0];
                s3_file_update(file, key);
            }
        } else {
            if (valid != undefined) {
                $("#" + edit_image_id[key] + "_valid").val(valid);
                key++;
                edit_image_upload_loop(key);
            } else {
                update_staff();
            }
        }
    }

    function update_staff() {
        var updatestaff_token = $('#update_staff_token').val();
        var update_empid = $('#update_emp_id').val();
        var staff_image_valid = $("#edit_product_image_valid").val();
        var update_persons = $('#update_contacted_person').val();
        var update_employeename = $('#update_emp_name').val();
        var update_email_address = $('#update_emailAddress').val();
        var updatecountryCode = $("#update_mobile_code").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
        updatecountryCode = '+'+updatecountryCode.replace(/[^0-9]/g,'');
        var update_employee_mobile = $('#update_mobile_code').val();
        var update_userroletoken = $('#update_user_role').val();
        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }
        var datas = {'staff_token':updatestaff_token,'employee_id':update_empid,'employee_image':staff_image_valid,'employee_primary_title':update_persons,'employee_name':update_employeename,'employee_email':update_email_address,'employee_country_code':updatecountryCode,'employee_mobile_number':update_employee_mobile,'employee_user_role':update_userroletoken,'service_provider_companylocation_token':companylocation_token,'type':'update_staff'};
        var JsonData = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/my-staffs/updateStaff.php",
            data: JsonData
        }).done(function(data1) {
            if(data1.status_code == 200){
                swal({
                    title: "Success!",
                    text: data1.message,
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    location.reload();
                });
            }else{
                swal({
                    title: "Error!",
                    text: data1.message,
                    icon: "error",
                    button: "Ok",
                });
            }
        });
    }

    function s3_file_update(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds + '.' + extension;
        var folder = 'Testing/';
        var objKey = folder + filename;
        var params = {
            Key: objKey,
            ContentType: file.type,
            Body: file
        };
        bucket.putObject(params, function (err, data) {
            if (err) {
                alert('ERROR: ' + err);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#update_valid"+image_id[key]).val(image_fileurl);
                key++;
                edit_image_upload_loop(key);
            }
        });
    }

    function s3_file_update(file,key){
        var seconds  = parseInt(new Date().getTime()/1000);
        var string   = makeid(8);
        var filetype = (file.type).split("/");
        var filename = "IMG_"+string+"_"+seconds+"."+filetype[1];
        var folder = 'Testing/';
        var objKey   =  folder + filename;
        var params   = {
            Key: objKey,
            ContentType: file.type,
            Body: file
        };
        bucket.putObject(params, function(err, data) {
            if (err) {
                alert('ERROR: ' + err);
            } else {
                var url = aws_cloudfront_url+folder+filename;
                $("#"+edit_image_id[key]+"_valid").val(url);
                key++;
                edit_image_upload_loop(key);
            }
        });
    }

    function makeid(length) {
        var result           = '';
        var characters       = '0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function file_upload(file_id,view_id,exist_image){
        var fileUpload = document.getElementById(file_id+"_upload");
        var files = !!fileUpload.files ? fileUpload.files : [];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif|.jpeg)$");
        if (regex.test(files[0].type)) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        // if(this.width==200 && this.height==200){
                        $('#'+view_id).attr('src', e.target.result);
                        $('#'+file_id+'_valid').val("true");
                        // }else{
                        // $('#'+view_id).attr('src', exist_image);
                        // $('#'+file_id+'_valid').val("false");
                        // swal("", "Upload square photo or photo size 200*200.", "error");
                        // }
                    };
                } 
            }
        }    
    }

    function delete_staff(staff__token){
        swal({
            title: "Are you sure?",
            text: "You want to delete this staff?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datas = {
                    staff_token:staff__token
                }
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url :  `${apiPath}/my-staffs/deleteStaff.php`,
                    data: json_data,
                }).done(function(data){
                    swal("Staff Deleted!", {icon: "success",}).then((value) => {
                        location.reload();
                    });
                });
            }
        });
    }

    function service_provider_list(){
        table.clear();
        table.destroy();
        fetch_data();
    }
</script>
</body>
</html>
<?php
}
?>