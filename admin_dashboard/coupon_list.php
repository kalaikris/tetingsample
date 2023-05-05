<?php
    session_start(); 
    include_once '../config/core.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupon Code</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/master_data.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    <style>
        .input-amety {
            margin: 10px 0 18px;
        }
        .radio-btn-form {
            margin-bottom: 32px;
        }
        .radio-btn-form > div{
            margin-right: 16px;
            display: flex;
            align-items: center;
            column-gap: 10px;
        }
        .coupon-name_state {
            display: flex;
            align-items: center;
            column-gap: 24px;
        }
        :is(.coupon-name_state, .flex-input-boxes) > .input-amety {
            flex: 1;
        }
        .add_options-container .input-amety, .add_inputs-container .input-amety {
            max-width: 400px;
        }
        .date-group, .flex-input-boxes {
            display: flex;
            align-items: center;
            column-gap: 24px;
        }
        .date-group > .input_datebox {
            max-width: unset;
            padding: 15px 0 15px 18px;
            flex: 1;
        }
        .grid-auto-fit {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-column-gap: 24px;
        }
        .del-input-group {
            color: #F51212;
            cursor: pointer;
        }
        .edit_del-input-group{
            color: #F51212;
            cursor: pointer;
        }
        .checkbox-label {
            display: flex;
            column-gap: 10px;
            margin-bottom: 16px;
            font-size: 18px;
            cursor: pointer;
        }
        .checkbox-label input {
            width: 20px;
            height: 20px;
            accent-color: #199fcb;
        }
        .conditions:not(:last-child) {
            padding-bottom: 24px;
            border-bottom: 1px solid #d7d7d7;
        }
        .campaign_top_content_section {
            display: table;
            table-layout: fixed;
        }
        .create_service-list .details-top-section {
            display: table-row;
        }
        .details-top-div {
            display: table-cell;
            padding-bottom: 32px;
        }
    </style>
</head>


<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar14"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Coupon List</h1>
                <p class="total_emp total">Coupon List - 10</p>
            </div>
            <div class="header_btn-container">
                <div class="dropdown">
                    <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="" />
                    <label for="filter-switch" class="dropdown__options-filter" style="display:none;">
                        <ul class="dropdown__filter" role="listbox" tabindex="-1">
                            <li class="dropdown__filter-selected" aria-selected="true">
                                Download as
                            </li>
                            <li>
                                <ul class="dropdown__select">
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)" onclick="drpDownbtnClick ('csv');">CSV</a>
                                    </li>
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)" onclick="drpDownbtnClick ('pdf');">PDF</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </label>
                </div>
                <div class="subit-cont">
                    <button class="primary-btn" onclick="createNew()">Create New</button>
                </div>
            </div>
            <div class="table-box">
                <table class="custom-table couponList" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>SI.No</th>
                            <th>Coupon Code</th>
                            <th>Coupon Name</th>
                            <th>Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Create -->
        <section class="create_service-list bg-white full-height twoback hides" id="toggle11">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideCreateNew()" alt="" class="backword">
                <h1 class="header_main header_main_h1" style="color:#0abdf6;padding-bottom:0;">Create New</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <h5 class="side-heading">Coupon Type</h5>
                    <div class="add_inputs-container">
                        <div>
                            <div class="radio-btn-form">
                                <div>
                                    <input type="radio" id="category" class="radio-btn" name="coupontype" value="Category">
                                    <label for="category" class="ratio-btn-selecter"></label>
                                    <label for="category" class="radio-label">Category</label>
                                </div>
                                <div>
                                    <input type="radio" id="cart" class="radio-btn" name="coupontype" value="Cart">
                                    <label for="cart" class="ratio-btn-selecter"></label>
                                    <label for="cart" class="radio-label">Cart</label>
                                </div>
                            </div>

                            <div class="coupon-name_state">
                                <div class="input-amety">
                                    <h6>Coupon Name</h6>
                                    <input class="couponname" id="coupon_name" type="text" name="" placeholder="Enter coupon name">
                                </div>
                            </div>
                            <span class="error couponnameerr"></span>
                        </div>
                    </div>

                    <div class="about_lounge-desc">
                        <div class="input-amety">
                            <h6>Description</h6>
                            <textarea class="servicedescription" id="service_description" placeholder="Write something..." rows="10"></textarea>
                        </div>
                        <span class="error coupondescerr"></span>
                    </div>

                    <div class="date-group add_inputs-container">
                        <div class="input-amety input_datebox">
                            <h6>From date</h6>
                            <input type="text" class="b-input datepicker form__input" id="from_date" placeholder="" readonly="">
                        </div>
                        <div class="input-amety input_datebox">
                            <h6>To date</h6>
                            <input type="text" class="b-input datepicker form__input" id="to_date" placeholder="" readonly="">
                        </div>
                    </div>

                    <div class="add_inputs-container">
                        <div class="input-amety">
                            <h6>Website</h6>
                            <select multiple="multiple" placeholder="Select Website" class="servicetype multiplecommon" id='website'>
                                <option value="0">Web App</option>
                                <option value="1">Whitelabel</option>
                                <option value="2">MobileApp</option>
                            </select>
                        </div>
                        <span class="error websiteerr"></span>
                    </div>

                    <div class="add_inputs-container" id="add_customer_group">
                        
                    </div>

                    <div class="add_inputs-container" id="coupon_code_field">
                        <div class="input-amety">
                            <h6>Coupon Code</h6>
                            <input class="couponcode" id="coupon_code" type="text" name="" placeholder="Enter coupon code">
                        </div>
                        <span class="error couponcodeerr"></span>
                    </div>
                    <div id="cart-auto-generate">
                    </div>

                    <div class="add_inputs-container flex-input-boxes" id="add_uses_per_field">   
                    </div>

                    <h5 class="side-heading">Conditions & Actions</h5>
                    <div class="add_inputs-container">
                        <div class="input-box-list">
                            <div class="conditions mb-4 condition_Action">
                                
                            </div>
                        </div>
                        <span class="add_input" id="add_new_select">+ Add New</span>
                    </div>

                    
                    <div class="button-container">
                        <button class="primary-btn" id="createservice">Create</button>
                        <button id="cancelcreate" class="transparent-btn" onclick="hideCreateNew()">cancel</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Edit -->
        <section class="create_service-list bg-white full-height twoback hides" id="toggle11_1">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideEditNew()" alt="" class="backword">
                <h1 class="header_main header_main_h1" style="color:#0abdf6;padding-bottom:0;">Edit</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                <input type="hidden" id="edit_couponToken">
                    <h5 class="side-heading">Coupon Type</h5>
                    <div class="add_inputs-container">
                        <div>
                            <div class="radio-btn-form">
                                <div class="category_block">
                                    <input type="radio" id="edit_category" class="radio-btn" name="edit_coupontype" value="Category" style="display:none;">
                                    <label for="edit_category" class="ratio-btn-selecter" style="display:none;"></label>
                                    <label for="edit_category" class="radio-label">Category</label>
                                </div>
                                <div class="cart_block">
                                    <input type="radio" id="edit_cart" class="radio-btn" name="edit_coupontype" value="Cart" style="display:none;">
                                    <label for="edit_cart" class="ratio-btn-selecter" style="display:none;"></label>
                                    <label for="edit_cart" class="radio-label">Cart</label>
                                </div>
                            </div>
                            <div class="coupon-name_state">
                                <div class="input-amety">
                                    <h6>Coupon Name</h6>
                                    <input class="couponname" type="text" name="" placeholder="Enter coupon name" id="edit_couponname">
                                </div>
                                <div class="toggle-btn-box">
                                    <div style="margin:0;margin-right:10px;">
                                        <input type="checkbox" id="edit_couponStatus" class="toggle-input create_toggle" value="Active">
                                        <label for="edit_couponStatus" class="toggle-btn">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <p>Is Active</p>
                                </div>
                            </div>
                            <span class="error edit_servicenameerr"></span>
                        </div>
                    </div>
                    <div class="about_lounge-desc">
                        <div class="input-amety">
                            <h6>Description</h6>
                            <textarea class="servicedescription" id="edit_couponDesc" placeholder="Write something..." rows="10"></textarea>
                        </div>
                        <span class="error edit_servicedesc">* Describe the service</span>
                    </div>
                    <div class="date-group add_inputs-container">
                        <div class="input-amety input_datebox">
                            <h6>From date</h6>
                            <input type="text" class="b-input datepicker form__input" id="edit_from_date" placeholder="" readonly="">
                        </div>
                        <div class="input-amety input_datebox">
                            <h6>To date</h6>
                            <input type="text" class="b-input datepicker form__input" id="edit_to_date" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="add_inputs-container">
                        <div class="input-amety">
                            <h6>Website</h6>
                            <select  multiple="multiple" placeholder="Select Website" class="servicetype edit_website_multiplecommon" id="edit_website">
                                <option value="0">Web App</option>
                                <option value="1">Whitelabel</option>
                                <option value="2">MobileApp</option>
                            </select>
                        </div>
                        <span class="error edit_websiteerr">* Please Select a website</span>
                    </div>
                    <div class="add_inputs-container" id="edit_customer_group">  
                    </div>
                    <div class="add_inputs-container" id="edit_coupon_code_field">
                        <div class="input-amety">
                            <h6>Coupon Code</h6>
                            <input class="couponcode" type="text" id="edit_couponcode" name="" placeholder="Enter coupon code">
                        </div>
                        <span class="error edit_couponcodeerr">* Please Enter Coupon Code</span>
                    </div>               
                    <div id="edit_cart-auto-generate">
                    </div>
                    <div class="add_inputs-container flex-input-boxes" id="edit_uses_per_field">   
                    </div>
                    <h5 class="side-heading">Conditions & Actions</h5>
                    <div class="add_inputs-container">
                        <div class="edit_input-box-list">
                        </div>
                        <span class="edit_add_input" id="edit_add_new_select">+ Add New</span>
                    </div>
                    <div class="button-container">
                        <button class="primary-btn" id="updateCoupon">Update</button>
                        <button id="" class="transparent-btn" onclick="hideEditNew()">cancel</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- View Detail -->
        <section class="create_service-list bg-white full-height twoback hides" id="view_detail">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideViewDetail()" alt="" class="backword">
                <h1 class="header_main header_main_h1" style="color:#0abdf6;padding-bottom:0;">APZCON</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <h5 class="side-heading">Coupon Details</h5>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Type</p>
                            <p class="" id="viewCouponType"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Name</p>
                            <p class="" id="viewCouponName"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Status</p>
                            <p class="" id="viewCouponStatus"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="date" style="width: 210%;padding-bottom:32px;">
                            <p class="top_p_color">Description</p>
                            <p class="" id="viewDescription"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">From Date</p>
                            <p class="" id="viewFromDate"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">To Date</p>
                            <p class="" id="viewToDate"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Website</p>
                            <p class="" id="viewWebsite"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Customer Groups</p>
                            <p class="" id="viewCustomerGroups"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Code</p>
                            <p class="" id="viewCouponCode"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Quantity</p>
                            <p class="" id="viewCouponQuantity"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Length</p>
                            <p class="" id="viewCouponLength"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Format</p>
                            <p class="" id="viewCouponFormat"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Prefix</p>
                            <p class="" id="viewCouponPrefix"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Coupon Suffix</p>
                            <p class="" id="viewCouponSuffix"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Uses Per Coupon</p>
                            <p class="" id="viewUsesPerCoupon"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Uses Per Customer</p>
                            <p class="" id="viewUsesPerCustomer"></p>
                        </div>
                    </div>

                    <h5 class="side-heading">Conditions & Actions</h5>
                    <div id="condition_data"></div>
                </div>
            </div>
        </section>

        <!-- ============ POPUPS ============ -->

    </main>
    <script src="js/jquery.min.js"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <!-- js file -->
    <script src="js/needed_jquery.js<?php echo $js_cache_string; ?>"></script>
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
    var serviceList = '';
    var token;
    var apiPath = "<?php echo $apiPath; ?>";
    $("#from_date").datetimepicker({
        date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
        ignoreReadonly: true,
        format: "DD-MM-YYYY"
    });
    $("#to_date").datetimepicker({
        date: new Date(),
        ignoreReadonly: true,
        format: "DD-MM-YYYY"
    });
    $("#edit_from_date").datetimepicker({
        format: "DD-MM-YYYY",
        ignoreReadonly: true,
        date: new Date()
    });
    $("#edit_to_date").datetimepicker({
        format: "DD-MM-YYYY",
        ignoreReadonly: true,
        date: new Date()
    });
    $('.multiplecommon').multipleSelect();
    $('.edit_website_multiplecommon').multipleSelect();

    function createNew() {
        $("#toggle11").show();
        couponType();
        $("#toggle3").hide();
    }
    function editNew(token) {
        editDetail(token);
        $("#toggle11").hide();
        $("#toggle3").hide();
    }
    function hideEditNew() {
        $("#toggle11_1").hide();
        $("#toggle3").show();
    }
    //Go Back Button
    function hideCreateNew(){
        $("#coupon_name,#service_description,#website,#distributorName,#coupon_code,#coupon_qunaity,#coupon_length,#coupon_format,#coupon_prefix,#coupon_suffix,#usesper_coupon,#usesper_customer,#cartDiscontAmount").val('');
        $(".multiplecommon").multipleSelect('destroy');
        $('.multiplecommon').multipleSelect();          
        $("#add_customer_group").html("<span></span>");
        $(".input-box-list").children().not(':first').remove();
        $("#toggle11").hide();
        $("#toggle3").show();
    }
    function hideViewDetail(){
        $("#view_detail").hide();
        $("#toggle3").show();
    }
    
    //dropdown pdf,csv file download
    function drpDownbtnClick (file){
        if(file == 'pdf'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
        }
        if(file == 'csv'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
        }
    }

    $(document).ready(function(){
        $("#category").prop('checked',true);
        var datas = {
            "adminToken":adminToken,
            "type":'service_type'
        }
        json_data = JSON.stringify(datas);
           $.ajax({
                type: "POST",
                dataType: "json",
                url : apiPath+"/admin/getCouponDropdown.php",
                data: json_data,
            }).done(function(data){
                if(data.status_code == "200"){
                    serviceList = `<option value="">Select Service</option>`;
                    data.data.forEach(function(serviceType, index){
                      serviceList += `<option value=${serviceType.business_type_token}>${serviceType.business_name}</option>`;  
                    });
                }
            }); 

        let datas1 = {
                    "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas1);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/admin/getCouponList.php",
                data: json1
            }).done(function(data1){
                couponarray = data1.data;
                let couponCount = couponarray.length;
                let couponList = '';
                couponarray.forEach((coupon,index) => {
                    couponList += `<tr>
                                        <td>${index + 1}</td>
                                        <td>${coupon.code}</td>
                                        <td>${coupon.name}</td>
                                        <td>${coupon.coupon_type}</td>
                                        <td>${coupon.from_date}</td>
                                        <td>${coupon.to_date}</td>
                                        <td>${coupon.date_time}</td>
                                        <td><a href="#" class="view_link" onclick="viewDetail('${coupon.token}')" id="viewcoupondetails">View Detail</a>
                                            <a href="#" class="view_link" onclick="editNew('${coupon.token}')" id="edit_coupondetails">Edit</a>
                                            <a href="#" class="view_link" onclick="deleteCoupon('${coupon.token}')" id="deleteCoupon">Delete</a>
                                        </td>
                                    </tr>`;
                });

                $('.total').text(`Total Coupon - ${couponCount}`);
                $('.couponList tbody').html(couponList);
                $('.couponList').DataTable({
                                                dom: 'Bfrtip',
                                                initComplete: function() {
                                                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                                                },
                                                scrollX: true,
                                                buttons: [
                                                    {
                                                        extend: 'csvHtml5',
                                                        title: 'Distributor Management',
                                                        exportOptions: {
                                                                            columns: [0,1,2,3],
                                                                        },
                                                    },
                                                    {
                                                        extend: 'pdfHtml5',
                                                        orientation: 'landscape',
                                                        pageSize: 'LEGAL',
                                                        title: 'Distributor Management',
                                                        exportOptions: {
                                                                            columns: [0,1,2,3],
                                                                        },
                                                    }
                                                ],
                                                language: {
                                                    search: '<img src="./assets_new/main/Search.png">',
                                                    searchPlaceholder: "Search",
                                                    paginate: {
                                                        next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                        previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                    }
                                                }
                                            });
                                            $("#loading").hide(); //Main Loader Close
            });
    });
    
    //while click create button additional category or cart field are added
    function couponType(){
       if($('input[name="coupontype"]:checked').val() == 'Category' && $('input[name="coupontype"]').is(":checked")){
           $("#add_uses_per_field").html('');
           $("#cart-auto-generate").html('');
            var serviceData = `<div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Select Type</h6>
                                        <select class="servicetype" id="ServiceType1">
                                            '${serviceList}'
                                        </select>
                                    </div>
                                    <span class="error servicetypeerr1"></span>
                                    <div class="input-amety">
                                        <h6>Select Gst Type</h6>
                                        <select class="servicetype" id="ServiceGstType1">
                                            <option value="Incl Gst">Include Gst</option>
                                        </select>
                                    </div>
                               </div>
                              <div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="amountType1">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <span class="error amounttypeerr1"></span>
                                <div class="input-amety">
                                    <h6>Discount Amount</h6>
                                    <input type="number" class="serviceincludes" id="amount1" placeholder="Enter discount amount">
                                </div>
                                <span class="error amounterr1"></span>
                            </div>`; 
           $(".condition_Action").html(serviceData);
        }else{
           var usesPerCustomer = `<div class="input-amety">
                            <h6>Uses Per Coupon</h6>
                            <input type="number" class="serviceincludes" id="usesper_coupon" placeholder="Enter number of uses">
                        </div>
                        <span class="error usespercouponerr"></span>
                        <div class="input-amety">
                            <h6>Uses Per Customer</h6>
                            <input type="number" class="serviceincludes" id="usesper_customer" placeholder="Enter number of customer">
                        </div>
                        <span class="error usespercusterr"></span>`;
            $("#add_uses_per_field").html(usesPerCustomer);
           var autoGenerate = `<div class="checkbox-label">
                        <input type="checkbox" class="check-input" id="auto-generated">
                        <label for="auto-generate">Auto-Generate</label>
                    </div>
                    <div class="add_inputs-container auto-generate-col" style="display:none;">
                        <h5 class="side-heading">Auto-Generate</h5>
                        <div class="grid-auto-fit">
                            <div class="input-amety">
                                <h6>Coupon Quantity</h6>
                                <input type="number" class="serviceincludes" id="coupon_qunaity" placeholder="Enter coupon quantity">
                            </div>
                            <span class="error couponqtyerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Length</h6>
                                <input type="text" class="serviceincludes" id="coupon_length" placeholder="Enter coupon length">
                            </div>
                            <span class="error couponlengerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Format</h6>
                                <select class="servicetype" id="coupon_format">
                                    <option value="alphanumeric">Alphanumeric</option>
                                    <option value="numeric">Numeric</option>
                                    <option value="character">Character</option>
                                </select>
                            </div>
                            <span class="error couponformaterr"></span>
                            <div class="input-amety">
                                <h6>Coupon Prefix</h6>
                                <input type="text" class="serviceincludes" id="coupon_prefix" placeholder="Enter coupon prefix">
                            </div>
                            <span class="error couponprefixerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Suffix</h6>
                                <input type="text" class="serviceincludes" id="coupon_suffix" placeholder="Enter coupon suffix">
                            </div>
                            <span class="error couponsuffixerr"></span>
                        </div>   
                    </div>`;
            $("#cart-auto-generate").html(autoGenerate);       
            var serviceData = `<div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="gstType1">
                                        <option value="Incl Gst">Include GST</option>
                                    </select>
                                </div>
                                <span class="error gsttypeerr1"></span>
                                 <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="serviceAmt1">
                                        <option value="">Select Condition</option>
                                        <option value="Greater Than Or Equal To">Greater Than or Equal to</option>
                                        <option value="Lesser Than Or Equal To">Lesser Than or Equal to</option>
                                    </select>
                                </div>
                                <span class="error serviceamterr1"></span>
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Cart Value</h6>
                                        <input type="text" class="serviceincludes" id="cartDiscontAmount" placeholder="Enter cart value">
                                    </div>
                                    <span class="error cartDiscontAmounterr"></span>
                                </div>
                             </div>
                              <div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="amountType1">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <span class="error amounttypeerr1"></span>
                                <div class="input-amety">
                                    <h6>Discount Amount</h6>
                                    <input type="number" class="serviceincludes" id="amount1" placeholder="Enter discount amount">
                                </div>
                                <span class="error amounterr1"></span>
                            </div>`; 
           $(".condition_Action").html(serviceData); 
        } 
    }
    //on change click category or cart 
    $('body').on('change','input[type=radio][name=coupontype]', function() { 
        $(".input-box-list").children().not(':first').remove();
        if($(this).val() == 'Cart'){
            $("#add_new_select").css('display','none');
        }else{
            $("#add_new_select").css('display','block');
        }
        couponType();
    });
    //while adding whitelabel the customer groups field will be created
    $("#website").change(function(){
        var distributorNameList;
        var appType = $("#website").val();
            var datas = {
                "adminToken":adminToken,
                "type":'service_distributor_name',
                "appType":appType
            }
            json_data = JSON.stringify(datas);
               $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : apiPath+"/admin/getCouponDropdown.php",
                    data: json_data,
                }).done(function(data){
                   distributorNameList = "";
                    if(data.status_code == "201"){
                        distributorNameList = `<div class="input-amety">
                                <h6>Customer groups</h6>
                                <select multiple="multiple" placeholder="Select Customer Groups" class="multiplecommon_cutomer" id="distributorName">
                                    <option value="">Select Distributor</option>`;
                        data.data.forEach(function(distributorName, index){
                          distributorNameList += `<option value=${distributorName.distributor_type_token}>${distributorName.distributor_name}</option>`;           
                        });
                         distributorNameList += `</select>
                                </div>
                            <span class="error distributornameerr"></span>`;
                        
                    }else if(data.status_code == "200"){
                        distributorNameList += "<span></span>";
                    }
                   $("#add_customer_group").html(distributorNameList);
                   $('.multiplecommon_cutomer').multipleSelect();
                });
    });

    //add new element in conditions and actions in create
    var serviceCountArray = [1];
    document.querySelector('.add_input').addEventListener('click', function(){
          const inputContainer = document.querySelector('.input-box-list');
          var conditionCount = document.querySelectorAll(".condition_Action").length;
          let insertInput = '';
          conditionCount += 1; 
          insertInput += `<div class="conditions mb-4 condition_Action">`;
          if($('input[name="coupontype"]:checked').val() == 'Category' && $('input[name="coupontype"]').is(":checked")){     
            serviceCountArray.push(conditionCount);
            insertInput += `<div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Select Type</h6>
                                    <select class="servicetype" id="ServiceType${conditionCount}">
                                        '${serviceList}'
                                    </select>
                                </div>
                                <span class="error servicetypeerr${conditionCount}"></span>
                                <div class="input-amety">
                                    <h6>Select Gst Type</h6>
                                    <select class="servicetype" id="ServiceGstType${conditionCount}">
                                        <option value="Incl Gst">Include Gst</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="amountType${conditionCount}">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <span class="error amounttypeerr${conditionCount}"></span>
                                <div class="input-amety">
                                    <h6>Discount Amount</h6>
                                    <input type="number" class="serviceincludes" id="amount${conditionCount}" placeholder="Enter discount amount">
                                </div>
                                <span class="error amounterr${conditionCount}"></span>
                            </div>
                                <p class="del-input-group text-right">Remove</p>
                            </div>`;
            inputContainer.insertAdjacentHTML('beforeend',insertInput);
            newServiceDropDown(conditionCount);
            serviceCountArray.forEach((id,index) => {
                let optionValue = $("#ServiceType"+id).val();
                $(`#ServiceType${conditionCount} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
            });
        }else{
            insertInput += `<div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="gstType${conditionCount}">
                                        <option value="Incl Gst">Include GST</option>
                                    </select>
                                </div>
                                <span class="error gsttypeerr${conditionCount}"></span>
                                 <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="serviceAmt${conditionCount}">       
                                        <option value="">Select Condition</option>
                                        <option value="Greater Than Or Equal To">Greater Than or Equal to</option>
                                        <option value="Lesser Than Or Equal To">Lesser Than or Equal to</option>
                                    </select>
                                </div>
                                <span class="error serviceamterr${conditionCount}"></span>
                             </div>
                              <div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="amountType${conditionCount}">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <span class="error amounttypeerr${conditionCount}"></span>
                                <div class="input-amety">
                                    <h6>Discount Amount</h6>
                                    <input type="number" class="serviceincludes" id="amount${conditionCount}" placeholder="Enter discount amount">
                                </div>
                                <span class="error amounterr${conditionCount}"></span>
                            </div>
                                <p class="del-input-group text-right">Remove</p>
                            </div>`;  
            inputContainer.insertAdjacentHTML('beforeend',insertInput);
        }

      const delInput = document.querySelectorAll('.del-input-group');
      delInput.forEach(function(d){
        d.addEventListener('click', function(){
          this.closest('.conditions').remove();
        })
      });
    });
    //on change (auto-generate) elements are hide or show in Create Site
    $('body').on('change','#auto-generated',function(){ 
       if($(this).is(':checked')){
          $("#coupon_code_field").css('display', 'none');
          $("#coupon_code").val('');
          $(".auto-generate-col").css('display','block');
          $("#coupon_qunaity,#coupon_length,#coupon_format,#coupon_prefix,#coupon_suffix").val('');
        }else{
          $("#coupon_code_field").css('display', 'block');
          $("#coupon_code").val('');
          $(".auto-generate-col").css('display','none');
          $("#coupon_qunaity,#coupon_length,#coupon_format,#coupon_prefix,#coupon_suffix").val('');
        }
    });
    //select service in category for disable for selected items
    function newServiceDropDown(id){
        $("#ServiceType"+id).html(serviceList);
        $("#ServiceType"+id).change(function() {
            //disable and enable airport on change
            serviceCountArray.forEach((idval,index) => {
                if(id != idval){
                    $(`#ServiceType${idval} option`).prop('disabled', false).trigger("chosen:updated");
                    serviceCountArray.forEach((balanceid,index) => {
                        if(balanceid != id && balanceid != idval){
                            let otherSelectedValue = $("#ServiceType"+balanceid).val();
                            $(`#ServiceType${idval} option[value='${otherSelectedValue}']`).prop('disabled', true).trigger("chosen:updated");
                        }
                    });
                    let optionValue = $("#ServiceType"+id).val();
                    $(`#ServiceType${idval} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
                }
            });
        });
    }
    //select service in category for disable for selected items for first
    $("body").on("change","#ServiceType1",function() {
        //disable and enable airport on change
        serviceCountArray.forEach((idval,index) => {
            if(1 != idval){
                $(`#ServiceType${idval} option`).prop('disabled', false).trigger("chosen:updated");
                serviceCountArray.forEach((balanceid,index) => {
                    if(balanceid != 1 && balanceid != idval){
                        let otherSelectedValue = $("#ServiceType"+balanceid).val();
                        $(`#ServiceType${idval} option[value='${otherSelectedValue}']`).prop('disabled', true).trigger("chosen:updated");
                    }
                });
                let optionValue = $("#ServiceType1").val();
                $(`#ServiceType${idval} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
            }
        }); 
    });
     //create coupon btn   
    $("#createservice").click(function(){
        var coupon_qunaity = '';
        var coupon_length = '';
        var coupon_format = '';
        var coupon_prefix = '';
        var coupon_suffix = '';
        var usesper_coupon = '';
        var usesper_customer = '';
        var cartDiscontAmount = '';
        var autoGenerateCoupon = '';
        var distributor_name = '';
        var coupon_type = $("input[name='coupontype']:checked").val();
        var name = $("#coupon_name").val();
        var val1 = value_check(name,'couponnameerr','Please Enter Name','text-box');
        var description = $("#service_description").val();
        var val2 = value_check(description,'coupondescerr','Please Enter Description','text-box');
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var website = $("#website").val();
        var val3 = value_check(website,'websiteerr','Please select website name','drop-down');
        if($('#add_customer_group').find('#distributorName').length > 0){
            distributor_name = $("#distributorName").val();
            var val4 = value_check(distributor_name,'distributornameerr','Please select distributor name','drop-down');
        }
        var coupon_code = $("#coupon_code").val();
        var val5 = value_check(coupon_code,'couponcodeerr','Please enter coupon code','text-box');
        
        if($("input[name='coupontype']:checked").val() == 'Cart'){
            if($('#auto-generated').is(":checked")){
                coupon_qunaity = $('#coupon_qunaity').val();
                var val6 = value_check(coupon_qunaity,'couponqtyerr','Please enter Coupon Quantity','text-box');
                coupon_length = $('#coupon_length').val();
                var val7 = value_check(coupon_length,'couponlengerr','Please enter Coupon Length','text-box');
                coupon_format = $('#coupon_format').val();
                var val8 = value_check(coupon_format,'couponformaterr','Please enter Coupon Format','text-box');
                coupon_prefix = $('#coupon_prefix').val();
                var val9 = value_check(coupon_prefix,'couponprefixerr','Please enter Coupon Prefix','text-box');
                coupon_suffix = $('#coupon_suffix').val();
                var val10 = value_check(coupon_suffix,'couponsuffixerr','Please enter Coupon Suffix','text-box');
                var preCoupon = coupon_prefix+coupon_suffix;
                if(preCoupon.length > coupon_length){
                    value_check(coupon_prefix,'couponprefixerr','Please coupon length is exceed','text-box');
                    value_check(coupon_suffix,'couponsuffixerr','Please coupon length is exceed','text-box');
                }
                if(preCoupon.length < coupon_length){
                    var leftCouponSpace = coupon_length-preCoupon.length;
                    var char_str = '';
                    if(coupon_format == 'numeric'){
                        char_str = '0123456789'; 
                    }else if(coupon_format == 'character'){
                        char_str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    }else if(coupon_format == 'alphanumeric'){
                        char_str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    }
                    var formatAdded = generateRandomString(leftCouponSpace,char_str);
                    autoGenerateCoupon = coupon_prefix+formatAdded+coupon_suffix;
                }
                val5 = true;
            }else{
               var coupon_code = $("#coupon_code").val();
               var val5 = value_check(coupon_code,'couponcodeerr','Please enter coupon code','text-box'); 
            }
                usesper_coupon =  $('#usesper_coupon').val();
                var val11 = value_check(usesper_coupon,'usespercouponerr','Please enter usesper coupon','text-box');
                usesper_customer =  $('#usesper_customer').val();
                var val12 = value_check(usesper_customer,'usespercusterr','Please enter usesper customer','text-box');
                cartDiscontAmount =  $('#cartDiscontAmount').val();
                var val13 = value_check(cartDiscontAmount,'cartDiscontAmounterr','Please enter cart value','text-box');
        }
        
        var conditions = [];
        var valCondition = false;
        var conditionCount = document.querySelectorAll(".condition_Action").length;
            if($("input[name='coupontype']:checked").val() == 'Category'){
                for(i=1; i<=conditionCount; i++){
                    if($("#ServiceType"+i).val() != '' && $("#amountType"+i).val() != '' && $("#amount"+i).val() != ''){
                        value_check($("#ServiceType"+i).val(),'servicetypeerr'+i,'Please select service type','text-box'); 
                        value_check($("#amountType"+i).val(),'amounttypeerr'+i,'Please select amount type','text-box');
                        value_check($("#amount"+i).val(),'amounterr'+i,'Please enter value','text-box'); 
                        var serviceCondition = {
                           "serviceType":$("#ServiceType"+i).val(),
                           "serviceGstType":$("#ServiceGstType"+i).val(),
                           "serviceCondition":$("#amountType"+i).val(),
                           "discountAmount":$("#amount"+i).val()
                        }
                        conditions.push(serviceCondition);
                        valCondition = true;
                    }else{
                        if($("#ServiceType"+i).val() == ''){
                            value_check($("#ServiceType"+i).val(),'servicetypeerr'+i,'Please select service type','text-box'); 
                        }
                        if($("#amountType"+i).val() == ''){
                            value_check($("#amountType"+i).val(),'amounttypeerr'+i,'Please select amount type','text-box');  
                        }
                        if($("#amount"+i).val() == ''){
                            value_check($("#amount"+i).val(),'amounterr'+i,'Please enter value','text-box'); 
                        }
                        valCondition = false;
                    }
                }
            }else{
                for(i=1; i<=conditionCount; i++){
                    if($("#gstType"+i).val() != '' && $("#serviceAmt"+i).val() != '' && $("#amountType"+i).val() != '' && $("#amount"+i).val() != ''){
                        value_check($("#gstType"+i).val(),'gsttypeerr'+i,'Please select gst type','text-box');
                        value_check($("#serviceAmt"+i).val(),'serviceamterr'+i,'Please select service type','text-box');
                        value_check($("#amountType"+i).val(),'amounttypeerr'+i,'Please select amount type','text-box'); 
                        value_check($("#amount"+i).val(),'amounterr'+i,'Please enter value','text-box');
                        var serviceCondition = {
                           "gstType":$("#gstType"+i).val(),
                           "serviceAmt":$("#serviceAmt"+i).val(),
                           "serviceCondition":$("#amountType"+i).val(),
                           "discountAmount":$("#amount"+i).val()
                        }
                        conditions.push(serviceCondition);
                        valCondition = true;
                    }else{
                        if($("#gstType"+i).val() == ''){
                            value_check($("#gstType"+i).val(),'gsttypeerr'+i,'Please select gst type','text-box');
                        }
                        if($("#serviceAmt"+i).val() == ''){
                            value_check($("#serviceAmt"+i).val(),'serviceamterr'+i,'Please select service type','text-box');
                        }
                        if($("#amountType"+i).val() == ''){
                            value_check($("#amountType"+i).val(),'amounttypeerr'+i,'Please select amount type','text-box'); 
                        }
                        if($("#amount"+i).val() == ''){
                            value_check($("#amount"+i).val(),'amounterr'+i,'Please enter value','text-box'); 
                        }
                        valCondition = false;
                    }
                }
            }
            var autoGen = false;
            var isCart = false;
            var updateApproval = false;
            if(val1 == true && val2 == true && val3 == true && valCondition == true && val5 == true){
                if($("input[name='coupontype']:checked").val() == 'Cart'){
                    if($('#auto-generated').is(":checked")){
                        if(val6 == true && val7 == true && val8 == true && val9 == true && val10 == true){
                            autoGen = true;   
                        }else{
                            autoGen = false;  
                        }
                    }else{
                        autoGen = true;   
                    }
                    if(val11 == true && val12 == true && val13 == true){
                        isCart = true;
                    }
                    if(autoGen == true && isCart == true){
                        updateApproval = true;
                    }
                }else if($("input[name='coupontype']:checked").val() == 'Category'){
                    updateApproval = true;
                }
                
               if(updateApproval == true){
                    let datas = {
                                "adminToken":adminToken,
                                "coupon_type":coupon_type,
                                "name":name,
                                "description":description,
                                "from_date":from_date,
                                "to_date":to_date,
                                "website":website,
                                "distributor_name":distributor_name,
                                "coupon_code":coupon_code,
                                "coupon_qunaity":coupon_qunaity,
                                "coupon_length":coupon_length,
                                "coupon_format":coupon_format,
                                "coupon_prefix":coupon_prefix,
                                "coupon_suffix":coupon_suffix,
                                "auto_generate":autoGenerateCoupon,
                                "usesper_coupon":usesper_coupon,
                                "usesper_customer":usesper_customer,
                                "cartDiscontAmount":cartDiscontAmount,
                                "conditions":conditions
                            };
                          //  console.log(datas);
                    let json = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/addCoupon.php",
                        data: json
                    }).done(function(data){
                        if(data.status_code == 200){
                            swal({
                                    title:data.title,
                                    text:"Added Coupon Successfully",
                                    icon:"success",
                                }).then(()=>{
                                    location.reload();
                                }); 
                        }    
                    });
                }
            }
    }); 
    // view coupon details
    function viewDetail(token){
        $("#toggle3").hide();
        coupon_token = token;
        var datas = {
            "adminToken":adminToken,
            "type": "view_coupon",
            "token": coupon_token
        };
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : apiPath+"/admin/getSingleCouponDetails.php",
            data: json_data,
        }).done(function(data) {
            var coupon = data.data;
            $("#viewCouponType").text(coupon.coupon_type);
            $("#viewCouponName").text(coupon.name);
            $("#viewCouponStatus").text(coupon.status);
            $("#viewDescription").text(coupon.description);
            $("#viewFromDate").html(coupon.from_date);
            $("#viewToDate").html(coupon.to_date);
            $("#viewWebsite").html(coupon.website);
            $("#viewCustomerGroups").html(coupon.distributor_name);
            $("#viewCouponCode").html(coupon.code);
            $("#viewCouponQuantity").html(coupon.quantity);
            $("#viewCouponLength").html(coupon.coupon_length);
            $("#viewCouponFormat").html(coupon.coupon_format);
            $("#viewCouponPrefix").html(coupon.coupon_prefix);
            $("#viewCouponSuffix").html(coupon.coupon_suffix);
            $("#viewUsesPerCoupon").html(coupon.users_per_coupon);
            $("#viewUsesPerCustomer").html(coupon.users_per_customer);
            var conditionList = '';
            if(coupon.coupon_type == 'Category'){
                coupon.condition_apply.forEach(function(condValue, index){
                    conditionList += `<div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Service Name</p>
                            <p class="" id="viewBusinessName${index}">${condValue.business_name}</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Gst Type</p>
                            <p class="" id="viewGstValue${index}">${condValue.gst_type}</p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Discount Type</p>
                            <p class="" id="viewDiscountCondition${index}">${condValue.coupon_type}</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Discount Amount</p>
                            <p class="" id="viewDiscountAmount${index}">${condValue.discount_amount}</p>
                        </div>
                    </div>`;
                });
                $("#condition_data").html(conditionList);
            }else if(coupon.coupon_type == 'Cart'){
                coupon.condition_apply.forEach(function(condValue, index){
                    conditionList += `<div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Gst Type</p>
                            <p class="" id="viewGst${index}">${condValue.gst_type}</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Discount Type</p>
                            <p class="" id="viewCondition${index}">${condValue.coupon_condition}</p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Discount Amount</p>
                            <p class="" id="viewDiscountCondition${index}">${condValue.coupon_type}</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Discount Amount</p>
                            <p class="" id="viewDiscountAmount${index}">${condValue.discount_amount}</p>
                        </div>
                    </div>`;
                });
                $("#condition_data").html(conditionList);
            }
            $("#view_detail").show();
        });
    }  
     //validation  
    function value_check(value,errorClass,errormsg,type){
        var valid_value;
        if(type == 'text-box'){
            if(value==""){
                $("."+errorClass).text(errormsg);
                $("."+errorClass).css("display","block");
                valid_value = false;
            }else{
                $("."+errorClass).text("");
                $("."+errorClass).css("display","none");
                valid_value = true;
            }
        }else if(type == 'drop-down'){
            if(value.length == 0){
                $("."+errorClass).text(errormsg);
                $("."+errorClass).css("display","block");
                valid_value = false;
            }else{
                $("."+errorClass).text("");
                $("."+errorClass).css("display","none");
                valid_value = true;
            }
        }
        return valid_value;
    } 
    //coupon generate 
    function generateRandomString(n,coupon_format) {
            let randomString = '';
                for ( let i = 0; i < n; i++ ) {
                    randomString += coupon_format.charAt(Math.floor(Math.random()*coupon_format.length));
                }
                console.log(randomString);
            return randomString;
    }
    //edit
    ///add new element in conditions and actions in edit site
    var editServiceCountArray = [];
    document.querySelector('.edit_add_input').addEventListener('click', function(){
        let editInputContainer = document.querySelector('.edit_input-box-list');
        var editConditionCount = document.querySelectorAll(".edit_condition_action").length;
        let editInsertInput = '';
        editConditionCount += 1;
        editInsertInput += `<div class="conditions mb-4 edit_condition_action">`;
        if($('input[name="edit_coupontype"]:checked').val() == 'Category' && $('input[name="edit_coupontype"]').is(":checked")){     
            editServiceCountArray.push(editConditionCount);
        editInsertInput += `<div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Select Type</h6>
                                    <select class="servicetype" id="editServiceType${editConditionCount}">
                                        '${serviceList}'
                                    </select>
                                </div>
                                <span class="error edit_servicetypeerr${editConditionCount}"></span>
                                <div class="input-amety">
                                    <h6>Select Gst Type</h6>
                                    <select class="servicetype" id="editGstType${editConditionCount}">
                                        <option value="Incl Gst">Include Gst</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-input-boxes">
                                <div class="input-amety">
                                    <h6>Conditon</h6>
                                    <select class="servicetype" id="editAmountType${editConditionCount}">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                                <span class="error edit_amounttypeerr${editConditionCount}"></span>
                                <div class="input-amety">
                                    <h6>Discount Amount</h6>
                                    <input type="number" class="serviceincludes" id="editAmount${editConditionCount}" name="" placeholder="Enter discount amount">
                                </div>
                                <span class="error edit_amounterr${editConditionCount}"></span>
                            </div>
                            <p class="del-input-group edit_del-input-group text-right">Remove</p>
                        </div>`;
            editInputContainer.insertAdjacentHTML('beforeend',editInsertInput);
            editNewServiceDropDown(editConditionCount);
            editServiceCountArray.forEach((id,index) => {
                let editOptionValue = $("#editServiceType"+id).val();
                $(`#editServiceType${editConditionCount} option[value='${editOptionValue}']`).prop('disabled', true).trigger("chosen:updated");
            });
        }else{
            editInsertInput  += `<div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Condition</h6>
                                        <select class="servicetype" id="edit_gstType${editConditionCount}">
                                            <option value="Incl Gst">Include GST</option>
                                        </select>
                                    </div>
                                    <span class="error edit_gsttypeerr${editConditionCount}"></span>
                                    <div class="input-amety">
                                        <h6>Action</h6>
                                        <select class="servicetype" id="edit_serviceAmt${editConditionCount}">
                                            <option value="">Select Condition</option>
                                            <option value="Greater Than Or Equal To">Greater Than or Equal to</option>
                                            <option value="Lesser Than Or Equal To">Lesser Than or Equal to</option>
                                        </select>
                                    </div>
                                    <span class="error edit_serviceamterr${editConditionCount}"></span>
                                </div>
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Conditon</h6>
                                        <select class="servicetype" id="edit_amountType${editConditionCount}">
                                            <option value="">Select Type</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="flat">Flat</option>
                                        </select>
                                    </div>
                                    <span class="error edit_amounttypeerr${editConditionCount}"></span>
                                    <div class="input-amety">
                                        <h6>Discount Amount</h6>
                                        <input type="number" class="serviceincludes" id="edit_amount${editConditionCount}" name="" placeholder="Enter discount amount">
                                    </div>
                                    <span class="error edit_amounterr${editConditionCount}"></span>
                                </div>
                                <p class="edit_del-input-group text-right">Remove</p>
                            </div>`; 
            editInputContainer.insertAdjacentHTML('beforeend',editInsertInput);
            let delInput = document.querySelectorAll('.edit_del-input-group');
            delInput.forEach(function(d){
                d.addEventListener('click', function(){
                    this.closest('.conditions').remove();
                })
            });
        }
    });
    //on select whitelabel website the customer groups will be visible
    var gl_website_arr = [];
    var gl_website_bool = false;
    function distributorNameList(token){
        var editDistributorNameList;
        var appType = $("#edit_website").val();
            var datas = {
                "adminToken":adminToken,
                "type":'service_distributor_name',
                "appType":appType
            }
            json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType: "json",
                url : apiPath+"/admin/getCouponDropdown.php",
                data: json_data,
            }).done(function(data){
                editDistributorNameList = "";
                if(data.status_code == "201"){
                    editDistributorNameList = `<div class="input-amety">
                            <h6>Customer groups</h6>
                            <select multiple="multiple" placeholder="Select Customer Groups" class="edit_multiplecommon_cutomer" id="editDistributorName">
                                <option value="">Select Distributor</option>`;
                    data.data.forEach(function(distributorName, index){
                        editDistributorNameList += `<option value=${distributorName.distributor_type_token}>${distributorName.distributor_name}</option>`;           
                    });
                    editDistributorNameList += `</select>
                            </div>
                        <span class="error edit_distributornameerr"></span>`;

                    $("#edit_customer_group").html(editDistributorNameList);
                    $(".edit_multiplecommon_cutomer").multipleSelect();

                    let x = token;
                    $(".edit_multiplecommon_cutomer").multipleSelect('destroy');
                    $(".edit_multiplecommon_cutomer").multipleSelect().multipleSelect('setSelects',x);
                    gl_website_bool = true;
                }else if(data.status_code == "200"){
                    gl_website_bool = false;
                    editDistributorNameList += "<span></span>";
                    $("#edit_customer_group").html(editDistributorNameList);
                }   
            });    
    }
    //adding value in edit site input fields
    var editCoupon = '';
    function editDetail(token){
        coupon_token = token;
        var datas = {
            "adminToken":adminToken,
            "type": "view_coupon",
            "token": coupon_token
        };
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : apiPath+"/admin/getSingleCouponDetails.php",
            data: json_data,
        }).done(function(data) {
            console.log(data);
             editCoupon = data.data;
            $("#edit_couponToken").val(editCoupon.token);
            if($("#edit_category").val() == editCoupon.coupon_type){    //Category
                  $(".category_block").css("display","block");
                  $("#edit_category").prop("checked", true);
                  $(".cart_block").css("display","none");
                  $("#edit_add_new_select").css("display","block");
            }else{                                                      //Cart
                  $(".cart_block").css("display","block");
                  $("#edit_cart").prop("checked", true);
                  $(".category_block").css("display","none");
                  $("#edit_add_new_select").css("display","none");
            }
            $("#edit_couponname").val(editCoupon.name);
            if($("#edit_couponStatus").val() == editCoupon.status){
                $("#edit_couponStatus").prop("checked", true);
            }else{
                $("#edit_couponStatus").prop("checked", false);
            }
            $("#edit_couponStatus").val(editCoupon.status);
            $("#edit_couponDesc").val(editCoupon.description);
            $("#edit_from_date").val(editCoupon.from_date);
            $("#edit_to_date").val(editCoupon.to_date);
            $(".edit_website_multiplecommon").multipleSelect('destroy');
            $(".edit_website_multiplecommon").multipleSelect().multipleSelect('setSelects',editCoupon.website_array);
            if(editCoupon.website_array.includes("1")){
                gl_website_arr = editCoupon.distributor_name_array;
                gl_website_bool = true;
                distributorNameList(gl_website_arr);
                $("#edit_customer_group").css("display","block");
            }else{
                gl_website_arr = editCoupon.distributor_name_array;
                gl_website_bool = false;
                distributorNameList(gl_website_arr);
            }
            $("#edit_website").change(function(){
                let appTypes = $("#edit_website").val();
                if(Object.values(appTypes).some(s => s.includes("1")) && gl_website_bool == true){
                    let edit_dist_name = $("#editDistributorName").val();
                    gl_website_arr = Object.values(edit_dist_name);
                    distributorNameList(gl_website_arr); 
                }else{
                    gl_website_arr = [];
                    distributorNameList(gl_website_arr);
                }
            }); 
            var conditionList = '';    
            if($('input[name="edit_coupontype"]:checked').val() == 'Cart'){ 
                edit_coupontype(editCoupon);           
                if($('#edit_auto-generated').is(":checked")){
                    $("#edit_couponquantity").val(editCoupon.quantity);
                    $("#edit_couponlength").val(editCoupon.coupon_length);
                    $("#edit_couponlengerr").val(editCoupon.coupon_format);
                    $("#edit_coupon_prefix").val(editCoupon.coupon_prefix);
                    $("#edit_coupon_suffix").val(editCoupon.coupon_suffix);
                }else{
                    $("#edit_couponcode").val(editCoupon.code);
                }
                $("#edit_usesper_coupon").val(editCoupon.users_per_coupon);
                $("#edit_usesper_customer").val(editCoupon.users_per_customer);
                $("#editCartDiscontAmount").val(editCoupon.cart_discount_amount);
                editCoupon.condition_apply.forEach(function(condValue, index){
                    index += 1;
                  $("#edit_gstType"+index).val(condValue.gst_type);
                  $("#edit_serviceAmt"+index).val(condValue.coupon_condition);
                  $("#edit_amountType"+index).val(condValue.coupon_type);
                  $("#edit_amount"+index).val(condValue.discount_amount);
                });
            }else{
                edit_coupontype(editCoupon);
                $("#edit_couponcode").val(editCoupon.code);
                editCoupon.condition_apply.forEach(function(condValue, index){
                    index += 1;
                  $("#editServiceType"+index).val(condValue.business_token);
                  $("#editAmountType"+index).val(condValue.coupon_type);
                  $("#editAmount"+index).val(condValue.discount_amount);
                });
            }
            $("#toggle11_1").show();
        });
    } 

    //In edit site adding HTML element before appending values
    function edit_coupontype(editCoupon){
        var serviceData = '';
       if($('input[name="edit_coupontype"]:checked').val() == 'Category' && $('input[name="edit_coupontype"]').is(":checked")){
           $("#edit_uses_per_field").html('');
           $("#edit_cart-auto-generate").html('');
           editCoupon.condition_apply.forEach(function(condValue,index){
            index += 1;         
            serviceData  += `<div class="conditions mb-4 edit_condition_action"> 
                                <input type="hidden" id="conditionToken${index}" value="${condValue.condition_token}">
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Select Type</h6>
                                        <select class="servicetype" id="editServiceType${index}">
                                            '${serviceList}'
                                        </select>
                                        <span class="error edit_servicetypeerr${index}"></span>
                                    </div>
                                    <div class="input-amety">
                                        <h6>Select Gst Type</h6>
                                        <select class="servicetype" id="editGstType${index}">
                                            <option value="Incl Gst">Include Gst</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Conditon</h6>
                                        <select class="servicetype" id="editAmountType${index}">
                                            <option value="">Select Type</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Flat">Flat</option>
                                        </select>
                                    </div>
                                    <span class="error edit_amounttypeerr${index}"></span>
                                    <div class="input-amety">
                                        <h6>Discount Amount</h6>
                                        <input type="number" class="serviceincludes" id="editAmount${index}" name="" placeholder="Enter discount amount">
                                    </div>
                                    <span class="error edit_amounterr${index}"></span>
                                </div>`;
                                if(index != 1){
                                   serviceData += `<p class="edit_del-input-group text-right">Remove</p>`
                                }
                    serviceData += `</div>`;
                    editServiceCountArray.push(index);
                }); 
           $(".edit_input-box-list").html(serviceData);
           editServiceCountArray.forEach((id,index1) => {
                editNewServiceDropDown(index1);
                let optionValue = $("#editServiceType"+id).val();
                $(`#editServiceType${index1} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
            });
        }else{
           var usesPerCustomer = `<div class="input-amety">
                                    <h6>Uses Per Coupon</h6>
                                    <input type="number" class="serviceincludes" id="edit_usesper_coupon" name="" placeholder="Enter number of uses">
                                </div>
                                <span class="error edit_usespercouponerr"></span>
                                <div class="input-amety">
                                    <h6>Uses Per Customer</h6>
                                    <input type="number" class="serviceincludes" id="edit_usesper_customer" name="" placeholder="Enter number of uses">
                                </div>
                                <span class="error edit_usespercusterr"></span>`;
                    $("#edit_uses_per_field").html(usesPerCustomer);
           var autoGenerate = `<div class="checkbox-label">
                        <input type="checkbox" class="check-input" id="edit_autogenerate">
                        <label for="auto-generate">Auto-Generate</label>
                    </div>
                    <div class="add_inputs-container edit-auto-generate-col" style="display:none;">
                        <h5 class="side-heading">Auto-Generate</h5>
                        <div class="grid-auto-fit">
                            <div class="input-amety">
                                <h6>Coupon Quantity</h6>
                                <input type="number" class="serviceincludes" id="edit_couponquantity" name="" placeholder="Enter coupon quantity">
                            </div>
                            <span class="error edit_couponqtyerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Length</h6>
                                <input type="text" class="serviceincludes" id="edit_couponlength" name="" placeholder="Enter coupon length">
                            </div>
                            <span class="error edit_couponlengerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Format</h6>
                                <select class="servicetype" id="edit_coupon_format">
                                    <option value="alphanumeric">Alphanumeric</option>
                                    <option value="numeric">Numeric</option>
                                    <option value="character">Character</option>
                                </select>
                            </div>
                            <span class="error edit_couponformaterr"></span>
                            <div class="input-amety">
                                <h6>Coupon Prefix</h6>
                                <input type="text" class="serviceincludes" id="edit_coupon_prefix" name="" placeholder="Enter coupon prefix">
                            </div>
                            <span class="error edit_couponprefixerr"></span>
                            <div class="input-amety">
                                <h6>Coupon Suffix</h6>
                                <input type="text" class="serviceincludes" id="edit_coupon_suffix" name="" placeholder="Enter coupon suffix">
                            </div>
                            <span class="error edit_couponsuffixerr"></span>
                        </div>   
                    </div>`;
            $("#edit_cart-auto-generate").html(autoGenerate); 
            editCoupon.condition_apply.forEach(function(condValue,index){
              index += 1;     
            serviceData  += `<div class="conditions mb-4 edit_condition_action"> 
                                <input type="hidden" id="conditionToken${index}" value="${condValue.condition_token}">
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Condition</h6>
                                        <select class="servicetype" id="edit_gstType${index}">
                                            <option value="Incl Gst">Include GST</option>
                                        </select>
                                    </div>
                                    <span class="error edit_gsttypeerr${index}"></span>
                                    <div class="input-amety">
                                        <h6>Action</h6>
                                        <select class="servicetype" id="edit_serviceAmt${index}">
                                            <option value="">Select Condition</option>
                                            <option value="Greater Than Or Equal To">Greater Than or Equal to</option>
                                            <option value="Lesser Than Or Equal To">Lesser Than or Equal to</option>
                                        </select>
                                    </div>
                                    <span class="error edit_serviceamterr${index}"></span>
                                    <div class="flex-input-boxes">
                                        <div class="input-amety">
                                            <h6>Cart Value</h6>
                                            <input type="text" class="serviceincludes" id="editCartDiscontAmount" placeholder="Enter cart value">
                                        </div>
                                        <span class="error editCartDiscontAmounterr"></span>
                                    </div>
                                </div>
                                <div class="flex-input-boxes">
                                    <div class="input-amety">
                                        <h6>Condition</h6>
                                        <select class="servicetype" id="edit_amountType${index}">
                                            <option value="">Select Type</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Flat">Flat</option>
                                        </select>
                                    </div>
                                    <span class="error edit_amounttypeerr${index}"></span>
                                    <div class="input-amety">
                                        <h6>Discount Amount</h6>
                                        <input type="number" class="serviceincludes" id="edit_amount${index}" name="" placeholder="Enter discount amount">
                                    </div>
                                    <span class="error edit_amounterr${index}"></span>
                                </div>`;
                                if(index != 1){
                                   serviceData += `<p class="edit_del-input-group text-right">Remove</p>`
                                }
                    serviceData += `</div>`; 
            });
            $(".edit_input-box-list").html(serviceData); 
        }
        let delInput = document.querySelectorAll('.edit_del-input-group');
            delInput.forEach(function(d){
                d.addEventListener('click', function(){
                    this.closest('.conditions').remove();
                })
            }); 
    }

    //select service in category for disable for selected items
    function editNewServiceDropDown(id){
        $("#editServiceType"+id).html(serviceList);
        $("#editServiceType"+id).change(function() {
            //disable and enable airport on change
            editServiceCountArray.forEach((idval,index) => {
                if(id != idval){
                    $(`#editServiceType${idval} option`).prop('disabled', false).trigger("chosen:updated");
                    editServiceCountArray.forEach((balanceid,index) => {
                        if(balanceid != id && balanceid != idval){
                            let otherSelectedValue = $("#editServiceType"+balanceid).val();
                            $(`#editServiceType${idval} option[value='${otherSelectedValue}']`).prop('disabled', true).trigger("chosen:updated");
                        }
                    });
                    let optionValue = $("#editServiceType"+id).val();
                    $(`#editServiceType${idval} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
                }
            });
        });
    }
//on change (auto-generate) elements are hide or show in Edit Site
    $('body').on('change','#edit_autogenerate',function(){ 
       if($(this).is(':checked')){
          $("#edit_coupon_code_field").css('display', 'none');
          $("#edit_couponcode").val('');
          $(".edit-auto-generate-col").css('display','block');
          $("#edit_couponquantity,#edit_couponlength,#edit_coupon_format,#edit_coupon_prefix,#edit_coupon_suffix").val('');
        }else{
          $("#coupon_code_field").css('display', 'block');
          $("#coupon_code").val('');
          $(".edit-auto-generate-col").css('display','none');
          $("#edit_couponquantity,#edit_couponlength,#edit_coupon_format,#edit_coupon_prefix,#edit_coupon_suffix").val('');
        }
    });

    //Update Btn
    $("#updateCoupon").click(function(){
        var edit_couponquantity = '';
        var edit_couponlength = '';
        var edit_coupon_format = '';
        var edit_coupon_prefix = '';
        var edit_coupon_suffix = '';
        var edit_usesper_coupon = '';
        var edit_usesper_customer = '';
        var autoGenerateCoupon = '';
        var status;
        var edit_coupon_token = $("#edit_couponToken").val();
        var edit_coupon_type = $('input[name="edit_coupontype"]:checked').val();
        var edit_name = $("#edit_couponname").val();
        var val1 = value_check(edit_name,'edit_servicenameerr','Please Enter Name','text-box');
        if($('input[id="edit_couponStatus"]').is(":checked")){
            status = '0';
        }else{
            status = '1';
        }
        var edit_desc = $("#edit_couponDesc").val();
        var val2 = value_check(edit_desc,'edit_servicedesc','Please Enter Description','text-box');
        var edit_from_date = $("#edit_from_date").val();
        var edit_to_date = $("#edit_to_date").val();
        var edit_website = $("#edit_website").val();
        var val3 = value_check(edit_website,'edit_websiteerr','Please Enter Name','drop-down');
        if($('input[id="edit_autogenerate"]').is(":checked")){
            var val4 = true;
        }else{
            var edit_couponcode = $("#edit_couponcode").val();
            var val4 = value_check(edit_couponcode,'edit_couponcodeerr','Please Enter Coupon Code','text-box');
        }
        
        if($('#edit_customer_group').find('#editDistributorName').length > 0){
            var edit_distributorName = $("#editDistributorName").val();
            var val5 = value_check(edit_distributorName,'edit_distributornameerr','Please Select Distributor Name','drop-down');
        }
        if($("input[name='edit_coupontype']:checked").val() == 'Cart'){
            if($('input[id="edit_autogenerate"]').is(":checked")){
                var edit_couponlength = $("#edit_couponlength").val();
                var val6 = value_check(edit_couponlength,'edit_couponlengerr','Please Enter Length','text-box');
                var edit_couponquantity = $("#edit_couponquantity").val();
                var val7 = value_check(edit_couponquantity,'edit_couponqtyerr','Please Enter Uses Per Coupon','text-box');
                var edit_coupon_format = $("#edit_coupon_format").val();
                var val8 = value_check(edit_coupon_format,'edit_couponformaterr','Please Enter Uses Per Coupon','text-box');
                var edit_coupon_prefix = $("#edit_coupon_prefix").val();
                var val9 = value_check(edit_coupon_prefix,'edit_couponprefixerr','Please Enter Uses Per Coupon','text-box');
                var edit_coupon_suffix = $("#edit_coupon_suffix").val();
                var val10 = value_check(edit_coupon_suffix,'edit_couponsuffixerr','Please Enter Uses Per Coupon','text-box');
                var edit_preCoupon = edit_coupon_prefix+edit_coupon_suffix;
                if(edit_preCoupon.length > edit_couponlength){
                    value_check(edit_coupon_prefix,'edit_couponprefixerr','Please coupon length is exceed','text-box');
                    value_check(edit_coupon_suffix,'edit_couponsuffixerr','Please coupon length is exceed','text-box');
                }
                if(edit_preCoupon.length < edit_couponlength){
                    var leftCouponSpace = edit_couponlength-edit_preCoupon.length;
                    var char_str = '';
                    if(edit_coupon_format == 'numeric'){
                        char_str = '0123456789'; 
                    }else if(edit_coupon_format == 'character'){
                        char_str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    }else if(edit_coupon_format == 'alphanumeric'){
                        char_str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    }
                    var formatAdded = generateRandomString(leftCouponSpace,char_str);
                    autoGenerateCoupon = edit_coupon_prefix+formatAdded+edit_coupon_suffix;
                }
            }
            var edit_usesper_coupon = $("#edit_usesper_coupon").val();
            var val11 = value_check(edit_usesper_coupon,'edit_usespercouponerr','Please Enter Uses Per Coupon','text-box');
            var edit_usesper_customer = $("#edit_usesper_customer").val();
            var val12 = value_check(edit_usesper_customer,'edit_usespercusterr','Please Enter Uses Per Coupon','text-box');
            var editCartDiscontAmount = $("#editCartDiscontAmount").val();
            var val13 = value_check(editCartDiscontAmount,'editCartDiscontAmounterr','Please Enter Cart Value','text-box');
        }
        
        var edit_Conditions = [];
        var edit_ValCondition = false;
        var editConditionCount = document.querySelectorAll(".edit_condition_action").length;
            if($("input[name='edit_coupontype']:checked").val() == 'Category'){
                for(i=1; i<=editConditionCount; i++){
                    if($("#editServiceType"+i).val() != '' && $("#editAmountType"+i).val() != '' && $("#editAmount"+i).val() != ''){
                        value_check($("#editServiceType"+i).val(),'edit_servicetypeerr'+i,'Please select service type','text-box'); 
                        value_check($("#editAmountType"+i).val(),'edit_amounttypeerr'+i,'Please select amount type','text-box');
                        value_check($("#editAmount"+i).val(),'edit_amounterr'+i,'Please enter value','text-box'); 
                        var serviceCondition = {
                           "conditionToken":($("#conditionToken"+i).val() == 'undefined' || $("#conditionToken"+i).val() == '')?'':$("#conditionToken"+i).val(),
                           "serviceType":$("#editServiceType"+i).val(),
                           "gstType":$("#editGstType"+i).val(),
                           "serviceAmt":"",
                           "serviceCondition":$("#editAmountType"+i).val(),
                           "discountAmount":$("#editAmount"+i).val()
                        }
                        edit_Conditions.push(serviceCondition);
                        edit_ValCondition = true;
                    }else{
                        if($("#editServiceType"+i).val() == ''){
                            value_check($("#editServiceType"+i).val(),'edit_servicetypeerr'+i,'Please select service type','text-box'); 
                        }
                        if($("#editAmountType"+i).val() == ''){
                            value_check($("#editAmountType"+i).val(),'edit_amounttypeerr'+i,'Please select amount type','text-box');  
                        }
                        if($("#editAmount"+i).val() == ''){
                            value_check($("#editAmount"+i).val(),'edit_amounterr'+i,'Please enter value','text-box'); 
                        }
                        edit_ValCondition = false;
                    }
                }
            }else{
                for(i=1; i<=editConditionCount; i++){
                    if($("#edit_gstType"+i).val() != '' && $("#edit_serviceAmt"+i).val() != '' && $("#edit_amountType"+i).val() != '' && $("#edit_amount"+i).val() != ''){
                        value_check($("#edit_gstType"+i).val(),'edit_gsttypeerr'+i,'Please select gst type','text-box');
                        value_check($("#edit_serviceAmt"+i).val(),'edit_serviceamterr'+i,'Please select service type','text-box');
                        value_check($("#edit_amountType"+i).val(),'edit_amounttypeerr'+i,'Please select amount type','text-box'); 
                        value_check($("#edit_amount"+i).val(),'edit_amounterr'+i,'Please enter value','text-box');
                        var serviceCondition = {
                           "conditionToken":($("#conditionToken"+i).val() == 'undefined' || $("#conditionToken"+i).val() == '')?'':$("#conditionToken"+i).val(),
                           "serviceType":"",
                           "gstType":$("#edit_gstType"+i).val(),
                           "serviceAmt":$("#edit_serviceAmt"+i).val(),
                           "serviceCondition":$("#edit_amountType"+i).val(),
                           "discountAmount":$("#edit_amount"+i).val()
                        }
                        edit_Conditions.push(serviceCondition);
                        edit_ValCondition = true;
                    }else{
                        if($("#edit_gstType"+i).val() == ''){
                            value_check($("#edit_gstType"+i).val(),'edit_gsttypeerr'+i,'Please select gst type','text-box');
                        }
                        if($("#edit_serviceAmt"+i).val() == ''){
                            value_check($("#edit_serviceAmt"+i).val(),'edit_serviceamterr'+i,'Please select service type','text-box');
                        }
                        if($("#edit_amountType"+i).val() == ''){
                            value_check($("#edit_amountType"+i).val(),'edit_amounttypeerr'+i,'Please select amount type','text-box'); 
                        }
                        if($("#edit_amount"+i).val() == ''){
                            value_check($("#edit_amount"+i).val(),'edit_amounterr'+i,'Please enter value','text-box'); 
                        }
                        edit_ValCondition = false;
                    }
                }
            }
            var autoGen = false;
            var isCart = false;
            var updateApproval = false;
            if(val1 == true && val2 == true && val3 == true && val4 == true && edit_ValCondition == true){
                if($("input[name='edit_coupontype']:checked").val() == 'Cart'){
                    if($('#edit_auto-generated').is(":checked")){
                        if(val6 == true && val7 == true && val8 == true && val9 == true && val10 == true){
                            autoGen = true;   
                        }
                    }
                    if(val11 == true && val12 == true && val13 == true){
                        isCart = true;
                    }
                    if(autoGen == true || isCart == true){
                        updateApproval = true;
                    }
                }else if($("input[name='edit_coupontype']:checked").val() == 'Category'){
                    updateApproval = true;
                }
                if(updateApproval == true){ 
                    let datas = {
                                "adminToken":adminToken,
                                "coupon_token":edit_coupon_token,
                                "coupon_status":status,
                                "coupon_type":edit_coupon_type,
                                "name":edit_name,
                                "description":edit_desc,
                                "from_date":edit_from_date,
                                "to_date":edit_to_date,
                                "website":edit_website,
                                "distributor_name":edit_distributorName,
                                "coupon_code":edit_couponcode,
                                "coupon_qunaity":edit_couponquantity,
                                "coupon_length":edit_couponlength,
                                "coupon_format":edit_coupon_format,
                                "coupon_prefix":edit_coupon_prefix,
                                "coupon_suffix":edit_coupon_suffix,
                                "auto_generate":autoGenerateCoupon,
                                "usesper_coupon":edit_usesper_coupon,
                                "usesper_customer":edit_usesper_customer,
                                "cartDiscontAmount":editCartDiscontAmount,
                                "conditions":edit_Conditions
                            };
                    let json = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/updateCoupon.php",
                        data: json
                    }).done(function(data){
                        if(data.status_code == 200){
                            swal({
                                    title:data.title,
                                    text:"Updated Coupon Successfully",
                                    icon:"success",
                                }).then(()=>{
                                    location.reload();
                                }); 
                        }    
                    });
                }else{
                    swal("","failed","error");
                }
            }else{
                swal("","failed","error");
            }
    }); 
//Delete Btn
    function deleteCoupon(token){
        coupon_token = token;
        var datas = {
            "adminToken":adminToken,
            "type": "delete_coupon",
            "token": coupon_token
        };
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : apiPath+"/admin/getSingleCouponDetails.php",
            data: json_data,
        }).done(function(data) {
                if(data.status_code == 200){
                    swal({
                            title:data.title,
                            text:"Deleted Coupon Successfully",
                            icon:"success",
                        }).then(()=>{
                            location.reload();
                        }); 
                }   
            });
    }
</script>
</body>
</html>
<?php
}
?>