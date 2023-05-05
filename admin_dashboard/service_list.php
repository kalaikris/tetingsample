<?php
    session_start();
    include_once '../config/core.php';
    include '../security/secure.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Partners</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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

</head>


<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar4"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Service List</h1>
                <p class="total_emp total"></p>
            </div>
            <div class="header_btn-container">
                <div class="dropdown">
                    <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="" />
                    <label for="filter-switch" class="dropdown__options-filter">
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
                <table class="custom-table serviceslist" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>SI.No</th>
                            <th>Service image</th>
                            <th>Service Name</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="create_service-list bg-white full-height twoback hides" id="toggle11">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideCreateNew()" alt="" class="backword">
                <h1 class="header_main header_main_h1" style="color:#0abdf6;padding-bottom:0;">Create New</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div>
                            <input id="valid_uploadimg" type="hidden">
                            <label class="uploadfile" for="uploadimg">
                                <input type="file" id="uploadimg"  accept="image/jpeg,image/png">
                                <img id="display_uploadimg" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                                <p class="error imageerror">Please upload an image!</p>
                            </label>
                        </div>
                        <div>
                            <div class="input-amety">
                                <h6>Service Type</h6>
                                <select class="servicetype">
                                    <option value="0">Select Service type</option>
                                    <option value="Service">Service</option>
                                    <option value="Time">Time</option>
                                    <option value="Inventory">Inventory</option>
                                </select>
                                
                            </div>
                            <span class="error servicetypeerr">* Please Select a service type</span>

                            <div class="input-amety">
                                <h6>Service Name</h6>
                                <input class="servicename" type="text" name="" placeholder="Enter service name">
                            </div>
                            <span class="error servicenameerr">* Enter a Service name</span>
                        </div>
                    </div>
                    <div class="about_lounge-desc">
                        <div class="input-amety">
                            <h6>Amenity Name</h6>
                            <textarea class="servicedescription" placeholder="Write something..." rows="10"></textarea>
                        </div>
                        <span class="error servicedesc">* Describe the service</span>
                    </div>

                    <h5 class="side-heading">Photos</h5>
                    <div class="multiupload_box">
                        <div>
                            <input id="valid_uploadimg1" type="hidden">
                            <label class="uploadfile" for="uploadimg1">
                                <input type="file" id="uploadimg1" accept="image/jpeg,image/png">
                                <img id="display_uploadimg1" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div> 
                        <div>
                            <input id="valid_uploadimg2" type="hidden">
                            <label class="uploadfile" for="uploadimg2">
                                <input type="file" id="uploadimg2" accept="image/jpeg,image/png">
                                <img id="display_uploadimg2" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <div>
                            <input id="valid_uploadimg3" type="hidden">
                            <label class="uploadfile" for="uploadimg3">
                                <input type="file" id="uploadimg3" accept="image/jpeg,image/png">
                                <img id="display_uploadimg3" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <div>
                            <input id="valid_uploadimg4" type="hidden">
                            <label class="uploadfile" for="uploadimg4">
                                <input type="file" id="uploadimg4" accept="image/jpeg,image/png">
                                <img id="display_uploadimg4" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <p class="error photoerror">Please upload an image!</p>
                    </div>
                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">Who can avail this service</h5>
                        <div class="input-amety">
                            <h6>Select user type</h6>
                            <select multiple="multiple" placeholder="Select User Type" class="serviceusertype multiplecommon">
                            </select>
                            <span class="error usertypeerror">*Select who can avail the service</span>
                        </div>
                      </div>
                    </div>
                    <div class="add_inputs-container">
                        <div class="input-box-list">
                            <div class="input-amety">
                                <h6>Service Includes</h6>
                                <input type="text" class="serviceincludes" name="" placeholder="Smoke Area">
                            </div>
                        </div>
                        <p class="error serviceincludeserror">*Service includes field, if available cannot be empty</p>
                        <span class="add_input">+ Add Service</span>     
                    </div>

                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">HSN</h5>
                        <div class="input-amety">
                            <h6>HSN code</h6>
                            <input type="text" class="hsncode" name="" placeholder="Enter code">
                        </div>
                        <span class="error hsnerr">* Enter HSN Value</span>
                      </div>
                    </div>
                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">Our Elite Partners</h5>
                        <div class="input-amety">
                            <h6>Select Partner</h6>
                            <select multiple="multiple" placeholder="Select Partners" class="servicepartnertype multiplecommon">  
                            </select>
                            <span class="error eliteusererr">* Provide Partners</span>
                        </div>
                      </div>
                    </div>

                    <div class="button-container">
                        <button class="primary-btn" id="createservice">Create</button>
                        <button id="cancelcreate" class="transparent-btn" onclick="hideCreateNew()">cancel</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="create_service-list bg-white full-height twoback hides" id="toggle11_1">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideEditNew()" alt="" class="backword">
                <h1 class="header_main header_main_h1" style="color:#0abdf6;padding-bottom:0;">Edit Service</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div>
                            <input id="valid_edit_uploadimg" type="hidden">
                            <label class="uploadfile" for="edit_uploadimg">
                                <input type="file" id="edit_uploadimg"  accept="image/jpeg,image/png">
                                <img id="display_edit_uploadimg" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                                <p class="error imageerror">Please upload an image!</p>
                            </label>
                        </div>
                        <div>
                            <div class="input-amety">
                                <h6>Service Type</h6>
                                <select class="edit_servicetype">
                                    <option value="0">Select Service type</option>
                                    <option value="Service">Service</option>
                                    <option value="Time">Time</option>
                                    <option value="Inventory">Inventory</option>
                                </select>
                            </div>
                            <span class="error edit_servicetypeerr">* Please Select a service type</span>

                            <div class="input-amety">
                                <h6>Service Name</h6>
                                <input class="edit_servicename" type="text" name="" placeholder="Enter service name">
                            </div>
                            <span class="error edit_servicenameerr">* Enter a Service name</span>
                        </div>
                    </div>
                    <div class="about_lounge-desc">
                        <div class="input-amety">
                            <h6>Amenity Name</h6>
                            <textarea class="edit_servicedescription" placeholder="Write something..." rows="10"></textarea>
                        </div>
                        <span class="error edit_servicedescerr">* Describe the service</span>
                    </div>

                    <h5 class="side-heading">Photos</h5>
                    <div class="multiupload_box">
                        <div>
                            <input id="valid_edit_uploadimg1" type="hidden">
                            <label class="uploadfile" for="edit_uploadimg1">
                                <input type="file" id="edit_uploadimg1" accept="image/jpeg,image/png">
                                <img id="display_edit_uploadimg1" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div> 
                        <div>
                            <input id="valid_edit_uploadimg2" type="hidden">
                            <label class="uploadfile" for="edit_uploadimg2">
                                <input type="file" id="edit_uploadimg2" accept="image/jpeg,image/png">
                                <img id="display_edit_uploadimg2" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <div>
                            <input id="valid_edit_uploadimg3" type="hidden">
                            <label class="uploadfile" for="edit_uploadimg3">
                                <input type="file" id="edit_uploadimg3" accept="image/jpeg,image/png">
                                <img id="display_edit_uploadimg3" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <div>
                            <input id="valid_edit_uploadimg4" type="hidden">
                            <label class="uploadfile" for="edit_uploadimg4">
                                <input type="file" id="edit_uploadimg4" accept="image/jpeg,image/png">
                                <img id="display_edit_uploadimg4" class="upload-icon" src="assets_new/amenities/upload.png" alt="">
                                <p class="upladpara">Upload </p>
                            </label>
                        </div>
                        <p class="error photoerror">Please upload an image!</p>
                    </div>
                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">Who can avail this service</h5>
                        <div class="input-amety">
                            <h6>Select user type</h6>
                            <select multiple="multiple" placeholder="Select User Type" class="edit_serviceusertype multiplecommon">
                            </select>
                            <span class="error edit_usertypeerror">*Select who can avail the service</span>
                        </div>
                      </div>
                      <div hidden>
                        <h5 class="side-heading">Where the service is given</h5>
                        <div class="input-amety">
                            <h6>Select Amenities</h6>
                            <input type="text" name="" placeholder="Smoke Area">
                        </div>
                      </div>
                    </div>
                    <div class="add_inputs-container">
                        <div class="edit_input-box-list">
                            <div class="input-amety">
                                <h6>Service Includes</h6>
                                <input type="text" class="editServiceIncludes" name="" placeholder="Smoke Area">
                            </div>
                        </div>
                        <p class="error edit_serviceincludeserror">*Service includes field, if available cannot be empty</p>
                        <span class="edit_add_input">+ Add Service</span>    
                    </div>

                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">HSN</h5>
                        <div class="input-amety">
                            <h6>HSN code</h6>
                            <input type="text" class="edit_hsncode" name="" placeholder="Enter code">
                        </div>
                        <span class="error edit_hsnerr">* Enter HSN Value</span>
                      </div>
                    </div>

                    <div class="add_options-container">
                      <div>
                        <h5 class="side-heading">Our Elite Partners</h5>
                        <div class="input-amety">
                            <h6>Select Partner</h6>
                            <select multiple="multiple" placeholder="Select Partners" class="edit_servicepartnertype multiplecommon">
                            </select>
                            <span class="error edit_eliteusererr">* Provide Partners</span>
                        </div>
                      </div>
                    </div>

                    <div class="button-container">
                        <button class="primary-btn" id="updateservice">Update</button>
                        <button id="cancelcreate" class="transparent-btn" onclick="hideEditNew()">cancel</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ POPUPS ============ -->

        <!-- The Modal Block User -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Block Reason</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <textarea name="" id="" placeholder="Enter block reason…"></textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="" data-dismiss="modal">Cancel</a>
                        <button type="button" class="btn btn-danger">Block</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal Verify User -->
        <div class="modal" id="verifyModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Feedback</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="rating">
                            <h6>Reating</h6>
                            <img src="assets_new/">
                        </div>
                        <div class="rating1">
                            <h6>Review</h6>
                            <p class="common-p"></p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="createnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Create New</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="reject-text-box">
                            <h6>Reject Reason</h6>
                            <input type="text" name="" placeholder="AIRPORTZO#98">
                        </div>
                        <div class="input-cont2">
                            <h6>Name</h6>
                            <input type="text" name="" placeholder="Alan Weber">
                        </div>
                        <div class="input-conts3">
                            <h6>Email Address</h6>
                            <input type="text" name="" placeholder="Alan Weber">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="creat_modal_btn">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

    <script>
    var example = flatpickr('#flatpickr,#flatpickr2');
    /* Radion button box */
    $('.ratio-btn-selecter').on('click', function() {
        debugger
        var quickcheck = $(this).attr('data-value');
        if (quickcheck == "image") {
            $('input[name=radio_btn_option][value="image"]').attr('checked', 'checked');
            $('.popup-image-box').removeClass('hidden');
            $('.popup-video-box').addClass('hidden');
        } else {
            $('input[name=radio_btn_option][value="video"]').attr('checked', 'checked');
            $('.popup-image-box ').addClass('hidden');
            $('.popup-video-box').removeClass('hidden');
        }
    })

    function createNew() {
        $("#toggle11").show();
        $("#toggle3").hide();
        $(`#display_uploadimg`).attr('src',"assets_new/amenities/upload.png");
        $(`#display_uploadimg1`).attr('src',"assets_new/amenities/upload.png");
        $(`#display_uploadimg2`).attr('src',"assets_new/amenities/upload.png");
        $(`#display_uploadimg3`).attr('src',"assets_new/amenities/upload.png");
        $(`#display_uploadimg4`).attr('src',"assets_new/amenities/upload.png");
        $('.servicetype').val('0');
        $('.servicename').val('');
        $('.servicedescription').val('');
        $('.serviceusertype').val('');
        $('.servicepartnertype').val('');
        $('.serviceincludes').val('')
        $('.serviceincludes').each((index,item)=>{
                if(index > 0){
                    $(item).parent().remove();
                }  
            })
    }
    function editNew() {
        $("#toggle11_1").show();
        $("#toggle11").hide();
        $("#toggle3").hide();
    }
    function hideEditNew() {
        $("#toggle11_1").hide();
        $("#toggle3").show();
    }
    function hideCreateNew(){
        $("#toggle11").hide();
        $("#toggle3").show();
    }

    document.querySelector('.add_input').addEventListener('click', function(){
          const inputContainer = document.querySelector('.input-box-list');
          const insertInput = `<div class="input-amety">
                                    <h6>Select Amenities</h6>
                                    <input class="serviceincludes" type="text" name="" placeholder="Smoke Area">
                                    <span class="del-input">x</span></div>`;

          inputContainer.insertAdjacentHTML('beforeend',insertInput);
          const delInput = document.querySelectorAll('.del-input');
          delInput.forEach(function(d){
            d.addEventListener('click', function(){
              this.closest('div').remove();
            })
          })
    });

    document.querySelector('.edit_add_input').addEventListener('click', function(){
        const inputContainer = document.querySelector('.edit_input-box-list');
        const insertInput = `<div class="input-amety">
                            <h6>Select Amenities</h6>
                            <input class="editServiceIncludes" type="text" name="" placeholder="Smoke Area">
                            <span class="edit_del-input">x</span></div>`;
        inputContainer.insertAdjacentHTML('beforeend',insertInput);
        let delInput = document.querySelectorAll('.edit_del-input');
        delInput.forEach(function(d){
            d.addEventListener('click', function(){
                this.closest('div').remove();
            })
        })
    });

    var apiPath = "<?php echo $apiPath; ?>";

    $(document).ready(() => {
        fetchservices();
        serviceusers();
        elitepartners();
        $("#loading").hide(); 
    });

    function fetchservices(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/serviceBusinessTypeList.php",
                data: json1
                }).done(function(data1) {
                    let servicelistarray = data1.data;
                    let servicelist = '';
                    servicelistarray.forEach((list,index) => {
                        servicelist += `<tr>
                                            <td>${index + 1}</td>
                                            <td><div class="image_view"><img alt="" src="${list.image}"></div></td>
                                            <td>${list.name}</td>
                                            <td>${list.createdDate}</td>
                                            <td><a href="#" data-token="${list.token}" data-image="${list.image}" data-name="${list.name}" class="view_link editservice" onclick="editNew()">Edit</a><a href="#" class="view_link deleteservice" data-token="${list.token}">Delete</a></td>
                                        </tr>`;
                    });
                    $('.total').text(`Total Services - ${servicelistarray.length}`);
                    $('.serviceslist tbody').html(servicelist);
                    $(".serviceslist").DataTable({
                        dom: 'Bfrtip',
                        initComplete: function() {
                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                        },
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'Services List',
                                exportOptions: {
                                                    columns: [0,2,3],
                                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'Services List',
                                exportOptions: {
                                                    columns: [0,2,3],
                                                },
                            }
                        ],
                        language: {
                            search: '<img src="./assets_new/main/Search.png">',
                            searchPlaceholder: "Search",
                            paginate: {
                                next: '<img style="width:18px;" src="assets_new/arrow-right.png?v=123">', // or '→'
                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png?v=123">' // or '←'  <img src="path/to/arrow.png">'
                            }
                        }
                    });
                })
    }

    function serviceusers(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
        dataType: "JSON",
        type: "POST",
        url: apiPath+"/masterData/availableServiceList.php",
        data: json1
        }).done(function(data1) {
            let usergrouplistData = data1.data;
            let usergroupList = '';
            usergrouplistData.forEach((list,index) => {
                usergroupList += `<option value="${list.token}">${list.name}</option>`;
            });
            $('.serviceusertype').html(usergroupList);
            $('.edit_serviceusertype').html(usergroupList);
            $('.serviceusertype').multipleSelect();
            $('.edit_serviceusertype').multipleSelect();
        })
    }

    function elitepartners(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/partnersList.php",
                data: json1
                }).done(function(data1) {
                    let partnerlistData = data1.data;
                    let partnerList = '';
                    partnerlistData.forEach((list,index) => {
                        partnerList += `<option value="${list.token}">${list.name}</option>`;
                    });
                    $('.servicepartnertype').html(partnerList);
                    $('.servicepartnertype').multipleSelect();
                    $('.edit_servicepartnertype').html(partnerList);
                    $('.edit_servicepartnertype').multipleSelect();

        });
    }      

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

    var image_id = ['uploadimg','uploadimg1','uploadimg2','uploadimg3','uploadimg4'];
    var edit_image_id = [];
    function image_upload_loop(key,variable,action){
        var checkkey = key+1;
        if(checkkey>variable.length){
            switch (action) {
                case "create":
                    on_submit_create();
                    break;
            
                case "update":
                    on_submit_update();
                    break;
            }
        }else{
            var fileUpload = document.getElementById(variable[key]);
            var file = fileUpload.files[0];
            s3_file_upload(file,key,variable,action);
        }
    }    

    function s3_file_upload(file, key,variable,action){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds+key+'.'+extension;
        let folderPath = '';
        if(variable[key] == 'uploadimg' || variable[key] == 'edit_uploadimg' ){
            folderPath = 'business_type/';

        }else{
            folderPath = 'business_type/images/';
        }
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
                
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#valid_"+variable[key]).val(image_fileurl);
                key++;
                image_upload_loop(key,variable,action);
            }
        });
    }
        
    $('body').on('click','#createservice',function(){
        let image = $('#uploadimg').val();
        let photo1 = $('#uploadimg1').val();
        let photo2 = $('#uploadimg2').val();
        let photo3 = $('#uploadimg3').val();
        let photo4 = $('#uploadimg4').val();
        let servicetype = $('.servicetype').val();
        let servicename = $('.servicename').val();
        let description = $('.servicedescription').val();
        let servicetoken = $('.serviceusertype').val();
        let partnertoken = $('.servicepartnertype').val();
        let serviceincludearray = [];
        $('.serviceincludes').each((index,item)=>{
            serviceincludearray.push(item.value);
        })
        let hsn = $('.hsncode').val();
        let validdata = 0;
        if(image == '' || image == undefined ){
            $('.imageerror').show();
        }else{
            $('.imageerror').hide();
            validdata++;
        }
        if(servicetype == 0){
            $('.servicetypeerr').show();
        }else{
            validdata++;
            $('.servicetypeerr').hide();
        }
        if(servicename == ''){
            $('.servicenameerr').show();
        }else{
            $('.servicenameerr').hide();
            validdata++;
        }

        if(description == ''){
            $('.servicedesc').show();
        }else{
            $('.servicedesc').hide();
            validdata++;
        }

        if(photo1 == '' || photo1 == undefined || photo2 == '' || photo2 == undefined || photo3 == '' || photo3 == undefined || photo4 == '' || photo4 == undefined){
            $('.photoerror').show();
        }else{
            $('.photoerror').hide();
            validdata++;

        }
        if(serviceincludearray.includes('')){
            $('.serviceincludeserror').show();
        }else{
            $('.serviceincludeserror').hide();
            validdata++;
        }

        if(servicetoken == ""){
            $('.usertypeerror').show();
        }else{
            $('.usertypeerror').hide();
            validdata++; 
        }
        if(partnertoken == ""){
            $('.eliteusererr').show();
        }else{
            $('.eliteusererr').hide();
            validdata++;
        }
        if(hsn == ""){
            $('.hsnerr').show();
        }else{
            $('.hsnerr').hide();
            validdata++;
        }
        if(validdata == 9){
            image_upload_loop(0,image_id,'create');
        }
    });


        function on_submit_create(){
            let image = $('#valid_uploadimg').val();
            let servicetype = $('.servicetype').val();
            let servicename = $('.servicename').val();
            let description = $('.servicedescription').val();
            let photo1 = $('#valid_uploadimg1').val();
            let photo2 = $('#valid_uploadimg2').val();
            let photo3 = $('#valid_uploadimg3').val();
            let photo4 = $('#valid_uploadimg4').val();
            let servicetoken = $('.serviceusertype').val();
            let partnertoken = $('.servicepartnertype').val();
            let photoArray = [];
            photoArray.push(photo1);
            photoArray.push(photo2);
            photoArray.push(photo3);
            photoArray.push(photo4);
            let serviceIncluded = [];
            $('.serviceincludes').each((index,item)=>{
                serviceIncluded.push(item.value);
            })
            let hsn = $('.hsncode').val();
            let datas = {
                            "adminToken":adminToken,
                            "image":image,
                            "serviceType":servicetype,
                            "name":servicename,
                            "description":description,
                            "photosArray":photoArray,
                            "availServiceTokens":servicetoken,
                            "availPartnerTokens":partnertoken,
                            "serviceIncluded": serviceIncluded,
                            "hsn":hsn
                        }
            let json1 = JSON.stringify(datas);
                $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/masterData/addServiceBusinessType.php",
                        data: json1
                      }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal("Created Service!", {icon: "success",}).then((value) => {
                              location.reload();
                            });
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });
                        }
                      })

        }

        //on click Edit button
        $('body').on('click','.editservice',function(){
            let serviceToken = $(this).attr('data-token');
            let availServices =[];
            let availPartners = [];
            $('#display_edit_uploadimg').attr('src','assets_new/amenities/upload.png');
            $('#display_edit_uploadimg1').attr('src','assets_new/amenities/upload.png');
            $('#display_edit_uploadimg2').attr('src','assets_new/amenities/upload.png');
            $('#display_edit_uploadimg3').attr('src','assets_new/amenities/upload.png');
            $('#display_edit_uploadimg4').attr('src','assets_new/amenities/upload.png');

            let datas = {
                            "adminToken":adminToken,
                            "serviceToken":serviceToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                    dataType: "JSON",
                    beforeSend: function () { $('#loading').show(); },
                    type: "POST",
                    url: apiPath+"/masterData/getServiceBusinessTypeData.php",
                    data: json1
                    }).done(function(data1) {
                        let businesstypedataarray = data1.data;
                        $('.edit_servicetype').val(`${businesstypedataarray.serviceType}`);
                        $('.edit_servicedescription').val(businesstypedataarray.description);
                        $('.edit_servicename').val(businesstypedataarray.name);
                        $('#display_edit_uploadimg').attr('src',businesstypedataarray.image);
                        $('.edit_hsncode').val(businesstypedataarray.hsn); 
                        businesstypedataarray.availServices.map((services,index) => {
                            availServices.push(services.token);
                        });
                        $('.edit_serviceusertype').multipleSelect('destroy')
                        $('.edit_serviceusertype').multipleSelect().multipleSelect('setSelects',availServices);
                       businesstypedataarray.availPartners.map((services,index) => {
                        availPartners.push(services.token);
                        });
                        $('.edit_servicepartnertype').multipleSelect('destroy')
                        $('.edit_servicepartnertype').multipleSelect().multipleSelect('setSelects',availPartners);
                        businesstypedataarray.photosArray.forEach((photos,index) => {
                            $(`#display_edit_uploadimg${index + 1}`).attr(
                                'src',photos
                            )
                        });
                        let editserviceinclude = '';
                        if( businesstypedataarray.serviceIncluded == ''){

                            editserviceinclude = `<div class="input-amety">
                                                            <h6>Service Includes</h6>
                                                            <input type="text" class="editServiceIncludes" name="" placeholder="Smoke Area">
                                                 </div>`

                        }
                        businesstypedataarray.serviceIncluded.forEach((service,index) => {
                            if(index == 0){
                                editserviceinclude += `<div class="input-amety">
                                                            <h6>Service Includes</h6>
                                                            <input type="text" class="editServiceIncludes" name="" placeholder="Smoke Area" value="${service}">
                                                     </div>`;
                            }else{
                                editserviceinclude += `<div class="input-amety">
                                                            <h6>Select Amenities</h6>
                                                            <input class="editServiceIncludes" type="text" name="" placeholder="Smoke Area" value="${service}">
                                                            <span class="edit_del-input">x</span>
                                                        </div>`
                            }
                        });
                        $('.edit_input-box-list').html(editserviceinclude)
                        $('#updateservice').attr('data-token',businesstypedataarray.token);

                        //delete extra service include text input
                        let delInput = document.querySelectorAll('.edit_del-input');

                            delInput.forEach(function(d){
                                d.addEventListener('click', function(){
                                this.closest('div').remove();
                                })
                            })
                            $("#loading").hide();
                    })
        })


    function on_submit_update(){
        let businessTypeToken = $('#updateservice').attr('data-token');
        let image = $('#valid_edit_uploadimg').val();
        let servicetype = $('.edit_servicetype').val();
        let servicename = $('.edit_servicename').val();
        let description = $('.edit_servicedescription').val();
        let photo1 = $('#valid_edit_uploadimg1').val();
        let photo2 = $('#valid_edit_uploadimg2').val();
        let photo3 = $('#valid_edit_uploadimg3').val();
        let photo4 = $('#valid_edit_uploadimg4').val();
        let servicetoken = $('.edit_serviceusertype').val();
        let partnertoken = $('.edit_servicepartnertype').val();
        let photoArray = [];
        photoArray.push(photo1);
        photoArray.push(photo2);
        photoArray.push(photo3);
        photoArray.push(photo4);
        let serviceIncluded = [];
        $('.editServiceIncludes').each((index,item)=>{
            serviceIncluded.push(item.value);
        })
        let hsn = $('.edit_hsncode').val();
        let datas = {
                        "adminToken":adminToken,
                        "businessTypeToken":businessTypeToken,
                        "image":image,
                        "serviceType":servicetype,
                        "name":servicename,
                        "description":description,
                        "photosArray":photoArray,
                        "availServiceTokens":servicetoken,
                        "availPartnerTokens":partnertoken,
                        "serviceIncluded": serviceIncluded,
                        "hsn":hsn
                    }
        let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/updateServiceBusinessType.php",
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
                })
    }
        
    $('body').on('click','#updateservice',function(){
        let edit_image = $('#edit_uploadimg').val();
        let edit_imagesrc = $('#display_edit_uploadimg').attr('src');
        let edit_photo1 = $('#edit_uploadimg1').val();
        let edit_photo1src = $('#display_edit_uploadimg1').attr('src');
        let edit_photo2 = $('#edit_uploadimg2').val();
        let edit_photo2src = $('#display_edit_uploadimg2').attr('src');
        let edit_photo3 = $('#edit_uploadimg3').val();
        let edit_photo3src = $('#display_edit_uploadimg3').attr('src');
        let edit_photo4 = $('#edit_uploadimg4').val();
        let edit_photo4src = $('#display_edit_uploadimg4').attr('src');
        let edit_servicetype = $('.edit_servicetype').val();
        let edit_servicename = $('.edit_servicename').val();
        let edit_description = $('.edit_servicedescription').val();
        let edit_servicetoken = $('.edit_serviceusertype').val();
        let edit_partnertoken = $('.edit_servicepartnertype').val();
        let edit_serviceincludearray = [];
        $('.editServiceIncludes').each((index,item)=>{
            edit_serviceincludearray.push(item.value);
        });
        let edit_hsn = $('.edit_hsncode').val();

        let editdata = 0;
        if(edit_image == '' || edit_image == undefined){
            $('#valid_edit_uploadimg').val(edit_imagesrc);

        }else{
            edit_image_id.push('edit_uploadimg');
            
        }
        if(edit_photo1 == '' || edit_photo1 == undefined){
            $('#valid_edit_uploadimg1').val(edit_photo1src);

        }else{
            edit_image_id.push('edit_uploadimg1');
        }
        if(edit_photo2 == '' || edit_photo2 == undefined){
            $('#valid_edit_uploadimg2').val(edit_photo2src);

        }else{
            edit_image_id.push('edit_uploadimg2');
        }
        if(edit_photo3 == '' || edit_photo3 == undefined){
            $('#valid_edit_uploadimg3').val(edit_photo3src);

        }else{
            edit_image_id.push('edit_uploadimg3');
        }
        if(edit_photo4 == '' || edit_photo4 == undefined){
            $('#valid_edit_uploadimg4').val(edit_photo4src);

        }else{
            edit_image_id.push('edit_uploadimg4');
        }
        

        if(edit_servicetype != 0){
            $('.edit_servicetypeerr').hide();
            editdata++;
        }else{
            $('.edit_servicetypeerr').show();
        }

        if(edit_servicename == ''){
            $('.edit_servicenameerr').show();
        }else{
            $('.edit_servicenameerr').hide();
            editdata++;
        }
        if(edit_description == ''){
            $('.edit_servicedescerr').show();

        }else{
            $('.edit_servicedescerr').hide();
            editdata++;

        }
        if(edit_servicetoken == ''){
            $('.edit_usertypeerror').show();

        }else{
            $('.edit_usertypeerror').hide();
            editdata++;
        }
        if(edit_serviceincludearray.includes('')){
            $('.edit_serviceincludeserror').show();

        }else{
            $('.edit_serviceincludeserror').hide();
            editdata++;
        }
        if(edit_partnertoken == ''){
            $('.edit_eliteusererr').show();
        }else{
            $('.edit_eliteusererr').hide();
            editdata++;
        }
        if(edit_hsn == ''){
            $('.edit_hsnerr').show();
        }else{
            $('.edit_hsnerr').hide();
            editdata++;
        }
        if(editdata == 7){
            image_upload_loop(0,edit_image_id,'update')
        }
    })

    //delete service
    $('body').on('click','.deleteservice',function(){
        let serviceBusinessTypeToken = $(this).attr('data-token');
        swal({
                title: "Are you sure?",
                text: "You want to delete the Service",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
            if(willDelete){
                let datas = {
                                "adminToken":adminToken,
                                "serviceBusinessTypeToken":serviceBusinessTypeToken
                            };
            let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/deleteServiceBusinessType.php",
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

    //dropdown pdf,csv file download
    function drpDownbtnClick (file){
        if(file == 'pdf'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
        }
        if(file == 'csv'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
        }
    }
    // Display the selected options 
    const selectedOptionList = document.querySelector('.selected-options-list');
    const msInputs = document.querySelectorAll('.ms-drop');
    </script>
</body>
</html>
<?php
}
?>