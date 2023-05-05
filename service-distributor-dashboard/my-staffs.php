<?php
include_once '../config/core.php';
include '../security/secure.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>airportzo</title>
        <link rel="shortcut icon" type="image/png" href="./asset/img/airportzo-icon.png" />

        <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css"/>
        <!-- data table link -->
        <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
        <!--  data table CSS only -->
        <link rel="stylesheet" href="./js/data-table-css/bootstrap.css" />
        <!-- custm css -->
        <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
        <link rel="stylesheet" href="./css/booklist.css<?php echo $js_cache_string; ?>" />
        <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>" />
        <link rel="stylesheet" href="./css/my-staffas1.css<?php echo $js_cache_string; ?>" />
        <link rel="stylesheet" href="./css/assigned-orders.css<?php echo $js_cache_string; ?>" />
        <link rel="stylesheet" href="./css/fonts.css<?php echo $js_cache_string; ?>" />
    </head>
    <style type="text/css">

        img.upload-icon {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            cursor: pointer;
        }
        .hidden{
            display:none;
        }
        input[type=number] {
    -moz-appearance:textfield;
}
    </style>

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
                                <p class="total-stafs">Total staffs - 14</p>
                            </div>

                            <div class="left-buttons">
                                <div class="employee">
                                    <!-- <input type="button" value="Add new employee" class="new-emp" class="btn btn-primary" /> -->
                                    <button class="cust-btn cust-btn-primary"
                                        data-toggle="modal"
                                        data-target="#exampleModal">Add new
                                        employee</button>
                                </div>
                                <div class="upload" hidden>
                                    <button class="cust-btn
                                        cust-btn-success-light">Upload CSV</button>
                                </div>
                            </div>
                        </div>

                        <table id="employeelist" class="dataTable no-footer" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Contact Number</th>
                                    <th>Email ID</th>
                                    <th>Joined on</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-bule"><a class="assignd-order assigned-orders-show">W9727</a></td>
                                    <td>
                                        <ul class="table-image">
                                            <li>
                                              <img src="./asset/user1.png" alt="andrew"/> <span class="employee-name">Alejandro Cain</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        +91748724682
                                    </td>
                                    <td>04 Jul,2022</td>
                                    <td>
                                        Admin
                                    </td>
                                    <td><span>-</span></td>
                                </tr>

                                <tr>
                                    <td class="td-bule">W8352</td>
                                    <td>
                                        <ul class="table-image">
                                            <li>
                                              <img src="./asset/user1.png" alt="andrew"/> <span class="employee-name">Alejandro Cain</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        +91927655276
                                    </td>
                                    <td>17 Jul,2022</td>
                                    <td>
                                        Assistant
                                    </td>
                                    <td><span>28</span></td>
                                </tr>

                                
                            </tbody>
                        </table>
                    </div>
                    <!-- assigned-order -->
                    <div id="assigned-orders-all1" class="hidden">

                        <div id="tab-1" class="tab-content current">
                            <div class="profile-tital">
                                <div class="profile-icon">
                                    <img src="./asset/img/darrell_brock@2x.png"
                                        class="darrell" alt="darrell">
                                </div>
                                <div class="name">
                                    <h3>Alejandro Cain</h3>
                                    <p>W9768</p>
                                </div>
                                <div class="cell-num">
                                    <p>Mobile Number</p>
                                    <num>+91962575772234</num>
                                </div>
                                <div class="ser-done">
                                    <p>Services done</p>
                                    <num>126</num>
                                </div>
                            </div>
                            <div class="single-line"></div>

                            <div class="assigned">
                                <h2>Assigned Orders</h2>
                            </div>

                            <table id="assigned-table" class="" style="width:
                                100%;">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>service avail on</th>
                                        <th>package</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="td-bule">W9768</td>
                                        <td>
                                            Alejandro Cain<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <td>
                                            04 Jul,2022<br />
                                            <small>05:00 PM</small>
                                        </td>
                                        <td><span>Silver</span></td>
                                        <td>-</td>
                                        <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W8352</td>
                                        <td>
                                            Susie Morton<br />
                                            <small>4Adults</small>
                                        </td>
                                        <td>
                                            17 Jul,2022<br />
                                            <small>02:30 PM</small>
                                        </td>
                                        <td><span>Platinum</span></td>
                                        <td>-</td>
                                        <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W7253</td>
                                        <td>
                                            Virgie Huff<br />
                                            <small>2Adults | 3 child</small>
                                        </td>
                                        <td>
                                            04 Jul,2022<br />
                                            <small>03:10 PM</small>
                                        </td>
                                        <td><span>silver</span></td>
                                        <td><img src="./asset/img/@5-stars.jpg"
                                                class="stars" alt="stars"></td>
                                        <td><span class="ongoing"><img src="./asset/img/ong.png">Ongoing</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W0927</td>

                                        <td>
                                            Douglas Ramos<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <td>
                                            03 Jul,2022<br />
                                            <small>02:30 PM</small>
                                        </td>
                                        <td><span>Eite</span></td>
                                        <td><img src="./asset/img/@5-stars.jpg"
                                                class="stars" srcset=""></td>
                                        <td><span class="accepted"><img src="./asset/img/acp.png">Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="td-bule">W8725</td>
                                        <td>
                                            Della Reed<br />
                                            <small>1Adults | 2 child</small>
                                        </td>
                                        <td>
                                            17 Jul,2022<br />
                                            <small>02:30 PM</small>
                                        </td>
                                        <td><span>Platinum</span></td>
                                        <td><img src="./asset/img/@2-stars.jpg"
                                                class="stars" alt="2-stars"></td>
                                        <td><span class="accepted"><img src="./asset/img/acp.png">Completed</span></td>
                                    </tr>

                                    <tr>
                                        <td class="td-bule">W0927</td>
                                        <td>
                                            Douglas Ramos<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <td>
                                            03 Jul,2022<br />
                                            <small>02:30 PM</small>
                                        </td>
                                        <td><span>silver</span></td>
                                        <td><span>-</span></td>
                                        <td><span class="accepted"><img src="./asset/img/acp.png">Completed</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W8725</td>
                                        <td>
                                            Della Reed<br />
                                            <small>1Adults | 2 child</small>
                                        </td>
                                        <td>
                                            17 Jul,2022<br />
                                            <small>02:30 PM</small>
                                        </td>
                                        <td><span>silver</span></td>
                                        <td><img src="./asset/img/@5-stars.jpg"
                                                class="stars" alt="@5-stars"></td>
                                        <td><span class="rejected"><img src="./asset/img/rej.png">Cancelled</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W9767</td>
                                        <!-- <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM</small>
                                </td> -->
                                        <td>
                                            Alejandro Cain<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <!-- <td>+91745434452</td> -->
                                        <td>
                                            04 Jul,2022<br />
                                            <small>05:00 PM</small>
                                        </td>
                                        <td><span>Platinum</span></td>
                                        <td>-</td>
                                        <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W9767</td>
                                        <!-- <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM</small>
                                </td> -->
                                        <td>
                                            Alejandro Cain<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <!-- <td>+91745434452</td> -->
                                        <td>
                                            04 Jul,2022<br />
                                            <small>05:00 PM</small>
                                        </td>
                                        <td><span>silver</span></td>
                                        <td>-</td>
                                        <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                                    </tr>


                                    <tr>
                                        <td class="td-bule">W9767</td>

                                        <td>
                                            Alejandro Cain<br />
                                            <small>2Adults | 1 child</small>
                                        </td>
                                        <td>
                                            04 Jul,2022<br />
                                            <small>05:00 PM</small>
                                        </td>
                                        <td><span>silver</span></td>
                                        <td><img src="./asset/img/@2-stars.jpg"
                                                class="stars" alt="2-stars"></td>
                                        <td><span class="accepted"><img src="./asset/img/acp.png">Completed</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- modal-popap -->

            <div class="modal fade" id="exampleModal" tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="profile_img" id="before_profile_pic" style="display: flex;justify-content: center;">
                                <input id="valid_profile_pic" type="hidden">
                                    <label class="uploadfile" for="profile_pic"><img src="./asset/img/uplod.png" class="upload-icon" id="display_profile_pic">
                                    <input type="file" name="" id="profile_pic" class="file-upload hidden" onchange="filevalidate('profile_pic');" ></label>
                                </div>

                                <div class="numer-acc alert-cont" style="display:none">
                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Employee Pic!</p>
                                </div>
                            </div>
                            <div class="input-form-group cust-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="emp_id">Employee ID</label>
                                        <input type="text" class="input-box" id="emp_id" placeholder="Enter ID" onkeypress="return isNumber(event)" onpaste="isNumber(this)">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="select-group">
                                        <select class="select-box cust-width">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Mrs">Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <label for="emp_name">Employee Name</label>
                                        <input type="text" class="input-box"
                                            id="emp_name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="login-input-action-set"
                                        id="mobile_alt_no">
                                        <div class="login-input-group phone">
                                            <label for="mobile_code">Mobile Number</label>
                                            <input type="tel"
                                                class="login-input-box"
                                                id="mobile_code" name="phone"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="emp_email">Email</label>
                                        <input type="text" class="input-box"
                                            id="emp_email" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12"> <!-- bg-arrow -->
                                    <div class="input-box-set">
                                        <label for="user_role">User Role</label>
                                        <select class="select-input"
                                            id="user_role">
                                            <option value="0">-select option-</option>
                                            <!-- <option value="1">-</option>
                                            <option value="2">-</option>
                                            <option value="3">-</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="add-emp-btn-set">
                                    <button type="button" class="cust-btn
                                        cust-btn-xl cust-btn-success col-12 addemployee"
                                        data-dismiss="modal">Add Employee</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal2" tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal_heder">
                                <h5 class="modal-title" id="exampleModalLabel">Edit employee</h5>
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
                            <div class="profile_img" id="edit_before_profile_pic" style="display: flex;justify-content: center;">
                                <input id="valid_edit_profile_pic" type="hidden">
                                    <label class="uploadfile" for="edit_profile_pic"><img src="./asset/img/uplod.png" class="upload-icon" id="display_edit_profile_pic">
                                    <input type="file" name="" id="edit_profile_pic" class="file-upload hidden" onchange="filevalidate('edit_profile_pic');" ></label>
                                </div>

                                <div class="numer-acc alert-cont" style="display:none">
                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Employee Pic!</p>
                                </div>
                            </div>
                            <div class="input-form-group cust-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="edit_emp_id">Employee ID</label>
                                        <input type="text" class="input-box" id="edit_emp_id" disabled placeholder="Enter ID" onkeypress="return isNumber(event)" onpaste="isNumber(this)">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="select-group">
                                        <select class="select-box cust-width edit_title">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Mrs">Mrs.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <label for="edit_emp_name">Employee Name</label>
                                        <input type="text" class="input-box"
                                            id="edit_emp_name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="login-input-action-set"
                                        id="mobile_alt_no">
                                        <div class="login-input-group phone">
                                            <label for="edit_mobile_code">Mobile Number</label>
                                            <input type="tel"
                                                class="login-input-box"
                                                id="edit_mobile_code" name="phone"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <label for="edit_emp_email">Email</label>
                                        <input type="text" class="input-box"
                                            id="edit_emp_email" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="input-form-group-item col-12"> <!-- bg-arrow -->
                                    <div class="input-box-set">
                                        <label for="user_role">User Role</label>
                                        <select class="select-input"
                                            id="edit_user_role">
                                            <option value="0">-select option-</option>
                                            <!-- <option value="1">-</option>
                                            <option value="2">-</option>
                                            <option value="3">-</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="add-emp-btn-set">
                                    <button type="button" class="cust-btn
                                        cust-btn-xl cust-btn-success col-12 updateemployee"
                                        data-dismiss="modal">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jquery -->
          
            <script src="./js/jquery-3.6.0.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
            <!-- data table js -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
            <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
            <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
            <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
            <!-- JavaScript Bundle with Popper boostrap -->
            <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <!-- data table custm js -->
            <script src="./js/table.js<?php echo $js_cache_string; ?>"></script>
            <!-- sidebar-heder -->
            <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
            <!-- sweetalert(swal) -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                $(document).ready(function (){
                    
                    $("#my-staffs").addClass("actives");
                    $("#assigned-table").DataTable({
                       "searching": false,
                        buttons: [
                            {
                                extend: "searchBuilder",
                                config: {
                                    depthLimit: 2,
                                },
                            },
                        ],
                        dom: '<Bfr<"table-container"t>ip>',
                        scrollX: true,
                        columnDefs: [
                            {
                                type: "unknownType",
                                targets: [3],
                            },
                        ],
                    });
                });
                // EmpId validation
                function isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if (( charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
                        return false;
                    }
                    return true;
                }

                $(".assigned-orders-show").click(function () {
                    $("#my-staffs-hide").hide();
                    $("#assigned-orders-all1").show();
                });

                // -----Country Code Selection
                $("#mobile_code,#edit_mobile_code").intlTelInput({
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    initialCountry: "in",
                    separateDialCode: false,
                });

                var mob_id = ["#mobile_code","#edit_mobile_code"];
        
                mob_id.forEach(function (value, i) {
                    var iti = '';
                    var mask = "";
                    var phoneInputID = value;
                    var input = document.querySelector(phoneInputID);
                    iti = window.intlTelInput(input, {
                        separateDialCode: false,
                        initialCountry: "in",
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                    });
                    
                    $(phoneInputID).on("countrychange", function(event) {
                        var selectedCountryData = iti.getSelectedCountryData();
                        newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                        newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                        newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
                        iti.setNumber("");
                        
                        $(this).val('');
                        $(this).attr('placeholder',newPlaceholder);
                        newPlaceholder = newPlaceholder.replace(/^0+/, '');
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


            </script>
            <script>
                let apiPath = "<?php echo $apiPath; ?>";
                //let userToken = localStorage.getItem("userToken");
                //let distributorToken = localStorage.getItem("distributorToken");
                
                 $(document).ready(function (){
                    fetch_staffs();
                    fetch_roles();
                 });

                 function fetch_staffs(){
                    // console.log('hi');
                    let data = {
                        
                        "serviceDistributorToken": distributorToken

                    }
                    let json_data = JSON.stringify(data);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url : `${apiPath}/employee/employeeList.php`,
                        data: json_data,
                        success: employeelist,
                        error:errorcheck,

                        
                    });

                    
                 }

                 function fetch_roles(){

                    let data = {
                        
                        "serviceDistributorToken": distributorToken

                    }
                    let json_data = JSON.stringify(data);

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url : `${apiPath}/roles/userRoleList.php`,
                        data: json_data,
                        success: rolelist,
                        error:errorcheck,

                        
                    });

                 }

                 function errorcheck(e,r,j){
                    // console.log(e.status);
                    // console.log(r);
                    // console.log(j);
                 }

                 function employeelist(data){
                    console.log(data);
                    let employeeListArray = data.data;
                    let employeeList = '';
                    employeeListArray.forEach((employee,index) => {
                        let editStatus = '';
                        if(employee.roleEditStatus == 0){
                            editStatus = '-';
                        }else{
                            editStatus = `<ul class="user-edit">
                                            <li class="editstaff" data-image="${employee.profileImage}" data-name="${employee.name}" data-email="${employee.email}" data-mob="${employee.number}" data-empid="${employee.employeeId}" data-role="${employee.userRoleToken}" data-token="${employee.employeeToken}" data-toggle="modal" data-target="#exampleModal2"><img src="./asset/edit.png" alt=""></li>
                                            <li class="deletestaff" data-token="${employee.employeeToken}"><img src="./asset/delete.png" alt=""></li>
                                         </ul>`;
                        }
                        employeeList += `<tr>
                                            <td class="td-bule" data-token="${employee.employeeToken}">${employee.employeeId}</td>
                                            <td>
                                                <ul class="table-image">
                                                    <li>
                                                    <img src="${employee.profileImage}" alt="andrew" onerror="this.onerror=null;this.src='asset/user1.png'";> <span class="employee-name">${employee.name}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                ${employee.number}
                                            </td>
                                            <td>${employee.email}</td>
                                            <td>${employee.createdDate}</td>
                                            <td>
                                            ${employee.userRole}
                                            </td>
                                            <td>
                                                ${editStatus}
                                            </td>
                                        </tr>`;
                        
                    });
                    $('#employeelist tbody').html(employeeList);
                    $("#employeelist").DataTable({
                    //    "searching": false,
                        language: {
                            search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                            searchPlaceholder: "Search...",
                        },
                    
                        buttons: [
                            {
                                extend: "searchBuilder",
                                config: {
                                    depthLimit: 2,
                                },
                            },
                        ],
                        dom: '<Bfr<"table-container"t>ip>',
                        scrollX: true,
                        columnDefs: [
                            {
                                type: "unknownType",
                                targets: [3],
                            },
                        ],
                    });
                    $('.total-stafs').text(`Total Staffs - ${employeeListArray.length}`);
                 }


                 function rolelist(roleDetails){

                    let roleArray = roleDetails.roleData;
                    // console.log(roleArray);
                    let userRole = `<option value="0">-select option-</option>`;

                    roleArray.forEach((roles,index) => {
                        userRole += `<option value="${roles.roleToken}">${roles.roleName}</option>`;
                    })

                    $('#user_role').html(userRole);
                    $('#edit_user_role').html(userRole);

                 }
                //  function filevalidate(id){

                //     var fuData = document.getElementById(id).files[0].name;

                //     var FileUploadPath = fuData.value;
                //     var FileUploadPath1 = fuData.split('.').pop().toLowerCase()

                //     //To check if user upload any file
                //     if (fuData == '') {
                //         swal("Please upload an image");

                //     } else {
                //         //The file uploaded is an image
                //         if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg") {
                //             // To Display
                            
                //             if(id == 'profile_pic'){
                //                 const [file_profile_pic] = profile_pic.files
                //                 if (file_profile_pic) {
                //                     display_profile_pic.src = URL.createObjectURL(file_profile_pic)
                //                     // view_profile_pic.src =  URL.createObjectURL(file_profile_pic)
                //                 }   
                                
                //             }
                            
                            
                //         }

                //         //The file upload is NOT an image
                //         else {
                //             swal("Only file types of  PNG, JPG and JPEG are allowed. ");

                //         }
                //     }

                // }

                $('body').on('change','.uploadfile input',function(){
                    let id = $(this).attr('id');
                    var fuData = document.getElementById(id).files[0].name;

                    var FileUploadPath = fuData.value;
                    var FileUploadPath1 = fuData.split('.').pop().toLowerCase();
                    let fileobjectname = `file_${id}`;
                    let displaysource = `display_${id}`

                    //To check if user upload any file
                    if (fuData == '') {
                        swal("Please upload an image");

                    } else {
                        //The file uploaded is an image
                        if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg") {
                        
                                const [fileobjectname] = $(this).prop('files')
                                if (fileobjectname) {
                                    //display_uploadimg.src = URL.createObjectURL(fileobjectname);
                                    let src = URL.createObjectURL(fileobjectname);
                                    $(`#display_${id}`).attr('src',src);
                                    //view_profile_pic.src =  URL.createObjectURL(file_profile_pic)
                                }   
                            
                            
                        }

                        //The file upload is NOT an image
                        else {
                            swal("Only file types of  PNG, JPG, and JPEG are allowed. ");

                        }
                    }
                    
                });

                // For S3 bucket
                var image_id = ['profile_pic'];
                var edit_image_id = ['edit_profile_pic'];
                function image_upload_loop(key, variable,action) {
                    var checkkey = key + 1;
                    if (checkkey > variable.length) {
                        switch (action) {
                            case "create":
                                on_submit_create();
                                break;
                        
                            case "update":
                                on_submit_update();
                                break;
                        }
                    
                    } else {
                    var fileUpload = document.getElementById(variable[key]);
                    var file = fileUpload.files[0];
                    // console.log(file);
                    s3_file_upload(file, key, variable,action);
                    }
                }
                
                function s3_file_upload(file, key,variable,action){
                    var seconds = new Date().getTime();
                    seconds = parseInt(seconds);
                    var extension = file.name.split('.').pop().toLowerCase();
                    var filename = seconds+key+'.'+extension;
                    let folderPath = 'employee/';
            //       console.log("filename:"+filename);
                    var folder = `service_distributor/${folderPath}`;
                    var objKey = folder + filename;
                    var params = {
                        Key: objKey,
                        ContentType: file.type,
                        Body: file
                    };
                    bucket.putObject(params, function (err, data) {
                        if (err) {
                            alert('ERROR: ' + err);
                            $('.addemployee').prop('disabled',false);
                        }else{
                            var image_fileurl = aws_cloudfront_url+folder+filename;
                            $("#valid_"+variable[key]).val(image_fileurl);
                            key++;
                            image_upload_loop(key,variable,action);
                        }
                    });
                }

                function isEmail(email) {
                    let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return mailFormat.test(email);
	            }

                function isValidPhone(id){
                    let result = $(`#${id}`).intlTelInput("isValidNumber");
                    return result;
                }

                function checknumber(sel){
                    let numbers = /^[-+]?[0-9]+$/;
                    sel.value = sel.value.match(numbers);
                }

                $('.addemployee').on('click',function(){
                    $('.addemployee').prop('disabled',true);
                    let empId = $('#emp_id').val().trim();
                    let empName = $('#emp_name').val().trim();
                    let mobile = $('#mobile_code').val().trim();
                    let email = $('#emp_email').val().trim();
                    let userRole = $('#user_role').val();
                    let profPic = $('#profile_pic').val();
                    if(empId != '' && empName != '' && mobile != '' && isValidPhone('mobile_code') && email != '' && isEmail(email) && userRole != 0  ){
                        if(profPic != ''){
                            image_upload_loop(0,image_id,'create');
                        }else{
                            swal("Upload your Profile Picture");
                            $('.addemployee').prop('disabled',false);
                        }
                    }else{
                        swal("Provide All Inputs");
                        $('.addemployee').prop('disabled',false);
                    }
                });

                function on_submit_create(){
                    let empId = $('#emp_id').val();
                    let empName = $('#emp_name').val();
                    let mobile = $('#mobile_code').val();
                    let email = $('#emp_email').val();
                    let userRoleToken = $('#user_role').val();
                    let profPic = $('#valid_profile_pic').val();
                    // let date = new Date();
                    // let createdDate = new Intl.DateTimeFormat("en-GB",{ day:"2-digit",month:"short",year:"numeric" }).format(date);

                    // console.log(createdDate);


                    let data = {
                        
                        "serviceDistributorToken": distributorToken,
                        "profilePic":profPic,
                        "employeeId":empId,
                        "name": empName,
                        "email": email,
                        "mobile":mobile,
                        "userRoleToken": userRoleToken
                        
                    }
                    let json_data = JSON.stringify(data);
                    // console.log(data);

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url : `${apiPath}/employee/createEmployee.php`,
                        data: json_data,
                    }).then(function(data){
                        if(data.status_code == 201){
                        swal({
                                title:"SUCCESS",
                                text:"Employee Created Successfully",
                                icon:"success",

                            }).then(()=>{
                                window.location = "my-staffs.php";

                            })

                        }else{
                            swal({
                                    title:"Warning!!",
                                    text:data.message,
                                    icon:"warning",
                            });
                            $('.addemployee').prop('disabled',false);
                        }

                    });

                }

                $('body').on('click','.editstaff',function(){

                    let image = $(this).attr('data-image');
                    let name = $(this).attr('data-name');
                    let role = $(this).attr('data-role');
                    let employeeToken = $(this).attr('data-token');
                    let email = $(this).attr('data-email');
                    let employeeId = $(this).attr('data-empid');
                    let mobile = $(this).attr('data-mob');
                    let data = {
                        
                        "serviceDistributorToken": distributorToken

                    }
                    let json_data = JSON.stringify(data);

                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url : `${apiPath}/roles/userRoleList.php`,
                    //     data: json_data,
                    // }).done(function(data) {
                    //     let roleArray = data.roleData;
                    // console.log(roleArray);
                    // let userRole = `<option value="0">-select option-</option>`;

                    // roleArray.forEach((roles,index) => {
                    //     userRole += `<option value="${roles.roleToken}">${roles.roleName}</option>`;
                    // })

                    // $('#edit_user_role').html(userRole);
                    // $('#edit_user_role').val(role);
                    // });
                    $('.updateemployee').attr('data-token',employeeToken);
                    $('#edit_emp_id').val(employeeId);
                    $('#edit_mobile_code').val(mobile);
                    $('#edit_emp_email').val(email);
                    $('#edit_user_role').val(role);

                    $(`#display_edit_profile_pic`).attr('src',image);
                    $('#edit_emp_name').val(name);
                    $('#valid_edit_profile_pic').val(`${image}`);

                })

                $('body').on('click','.updateemployee',function(){
                    let name = $('#edit_emp_name').val();
                    let editimage = $('#edit_profile_pic').val();
                    let email =  $('#edit_emp_email').val();
                    let mobile = $('#edit_mobile_code').val();
                    let role = $('#edit_user_role').val();

                    if(name != ""  && mobile != "" && isValidPhone('edit_mobile_code') && email != "" && isEmail(email) && role != 0 && editimage != undefined ){
                        if(editimage != ''){
                            image_upload_loop(0,edit_image_id,'update');
                        }else{
                            on_submit_update();
                        }

                    }else{
                        swal("Enter Valid inputs in all fields")
                    }
                });

                function on_submit_update(){

                    let name = $('#edit_emp_name').val();
                    let profilePic = $('#valid_edit_profile_pic').val();
                    let email =  $('#edit_emp_email').val();
                    let mobile = $('#edit_mobile_code').val();
                    let role = $('#edit_user_role').val();
                    let employeeToken = $('.updateemployee').attr('data-token')
                    // let servicestype = $('#servicestype').val();

                    let datas = {
                                    "serviceDistributorToken":distributorToken,
                                    "employeeToken":employeeToken,
                                    "profilePic": profilePic,
                                    "name": name,
                                    "email": email,
                                    "mobile": mobile,
                                    "userRoleToken": role
                                };
                                // console.log(datas);
                    let json1 = JSON.stringify(datas);
                            $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/employee/updateEmployee.php",
                            data: json1
                            }).done(function(data1) {
                                if(data1.status_code == 201){
                                    swal({
                                            title:data1.title,
                                            text:data1.message,
                                            icon:"success",

                                        }).then(()=>{
                                            location.reload();
                                        });

                                }else{
                                    swal({
                                            title:data1.title,
                                            text:data1.message,
                                            icon:"warning",

                                        });
                                }

                            });

                }

                $('body').on('click','.deletestaff',function(){
                    let employeeToken = $(this).attr('data-token');
                    swal({
                            title: "Are you sure?",
                            text: "You want to delete the Staff",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willDelete)=>{

                            if(willDelete){


                                let datas = {
                                        "serviceDistributorToken":distributorToken,
                                        "employeeToken":employeeToken
                                    };
                                let json1 = JSON.stringify(datas);
                                $.ajax({
                                    dataType: "JSON",
                                    type: "POST",
                                    url: apiPath+"/employee/deleteEmployee.php",
                                    data: json1
                                }).done(function(data1) {
                                    if(data1.status_code == 201){
                                    swal("Deleted!", {icon: "success",}).then((value) => {
                                            location.reload();
                                        });
                                    }else{

                                            swal({
                                                    title:data1.title,
                                                    text:data1.message,
                                                    icon:"warning",

                                                });

                                        }

                                });



                            }


                            

                        })

                })



            </script>
        </body>
    </html>
