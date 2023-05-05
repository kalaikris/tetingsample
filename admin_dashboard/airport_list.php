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
    <title>Service Partners</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/common.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/master_data.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="sweetalert-master/dist/sweetalert.css<?php echo $js_cache_string; ?>" rel="stylesheet">
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
                <h1 class="header_main">Airport List</h1>
                <p class="total_emp total">Total Aiports - 2</p>
            </div>
            <div class="header_btn-container">
                <div class="dropdown" hidden>
                    <input type="checkbox" class="dropdown__switch" id="filter-switch"/>
                    <label for="filter-switch" class="dropdown__options-filter">
                        <ul class="dropdown__filter" role="listbox" tabindex="-1">
                            <li class="dropdown__filter-selected" aria-selected="true" >
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
                <div>
                   <button class="primary-btn mr-2" data-toggle="modal" data-target="#uploadcsv">Upload CSV</button> 
                   <a href="airportCsv.csv" download>
                      <button class="primary-btn">Download Sample CSV</button>
                   </a>
                </div>
                <div class="" data-toggle="modal" data-target="#createnow">
                    <button class="primary-btn">Create New</button>
                </div>
            </div>
            <div class="table-box">
                <table class="custom-table airportslisttable" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Airport Name</th>
                            <th>Airport Code</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Timezone</th>
                            <th>GMT</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="#" class="view_link" data-toggle="modal" data-target="#editnow">Edit</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

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
                            <p class="common-p">Filium morte multavit si sine dubio praeclara sunt,
                                fecerint, virtutem ils per se esse fugiendum itaque
                                aunt hanc quasi involuta aperiri, altera prompta et
                                impetus quo guaerimus, non emolumento aliquo
                                sed quia dolor sit extremum et benivole collegisti,
                                nec voluptas nulla pariatur? at vero eos.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CREATE NEW MODAL -->
        <div class="modal" id="createnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Create New</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input-amety">
                            <h6>Airport Name</h6>
                            <input class="airportname createairportname" type="text" name="" placeholder="Enter Airport Name">
                        </div>
                        <div class="input-amety">
                            <h6>Airport Code</h6>
                            <input class="aiportcode createairportcode" type="text" name="" placeholder="Enter Airport Code">
                        </div>
                        <div class="input-amety">
                            <h6>Country</h6>
                            <select name="" class="countries" id="createcountry">
                                <option value="">Indian</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>State</h6>
                            <select name="" class="states" id="createstate">
                            <option value="0">Select State</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>City</h6>
                            <select name="" id="createcity">
                            <option value="0">Select City</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>Timezone</h6>
                            <input class="timezone createtimezone"  type="text" name="" placeholder="Asia/Kolkata">
                        </div>
                        <div class="input-amety">
                            <h6>GMT</h6>
                            <input class="gmt creategmt" type="text" name="" placeholder="(+5.30)">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn addairport">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div class="modal" id="editnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input-amety">
                            <h6>Airport Name</h6>
                            <input class="edit_airportname" type="text" name="" placeholder="Enter Airport Name">
                        </div>
                        <div class="input-amety">
                            <h6>Airport Code</h6>
                            <input class="edit_aiportcode" type="text" name="" placeholder="Enter Airport Code">
                        </div>
                        <div class="input-amety">
                            <h6>Country</h6>
                            <select name="" class="countries" id="editcountry">
                                <option value="">Indian</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>State</h6>
                            <select name="" class="states" id="editstate">
                            <option value="0">Select State</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>City</h6>
                            <select name="" id="editcity">
                            <option value="0">Select City</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>Timezone</h6>
                            <input class="edit_timezone" type="text" name="" placeholder="Enter Timezone">
                        </div>
                        <div class="input-amety">
                            <h6>GMT</h6>
                            <input class="edit_gmt" type="text" name="" placeholder="GMT">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updateairport">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Upload CSV-->
        <div class="modal" id="uploadcsv">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Upload CSV File</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row cont-text-title" style="justify-content: center;">
                            <label class="upload_filed" for="csv_file_upload">
                                <input id="csv_file_valid" type="hidden">
                                <input id="csv_file_upload" onchange="file_upload_csv('csv_file','csv_view_url','assets_new/upload_csv_done.png')" type="file" accept=".csv" style="display:none;">
                                <img alt="" src="assets_new/csvfile.png" width="48" class="csvfile" id="csv_view_url" />
                                <p id="csv_file_name" class="mt-2">Upload Files</p>
                            </label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal" onclick="cancelcsvfile()">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn" id="csv_upload_button" onclick="upload_csv_file()">Upload</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js file -->
    <script src="js/header.js"></script>
    <script src="js/sidebar.js?v=999"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    var example = flatpickr('#flatpickr,#flatpickr2');
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
    </script>
    <script src="js/function.js"></script>
    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            fetchairports();
            fetchcountries();
        });

        function fetchairports(){
            let datas = {
                "adminToken":adminToken
            };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/airportList.php",
                data: json1
            }).done(function(data1) {
                let airportsarray = data1.data;
                let airportsList = '';
                airportsarray.forEach((list,index) => {
                    airportsList += `<tr>
                    <td>${index + 1}</td>
                    <td>${list.name}</td>
                    <td>${list.code}</td>
                    <td>${list.countryName}</td>
                    <td>${list.stateName}</td>
                    <td>${list.cityName}</td>
                    <td>${list.timeZone}</td>
                    <td>${list.gmt}</td>
                    <td><a data-token="${list.airportToken}" data-airportcode="${list.code}" data-country="${list.countryId}" data-state="${list.stateId}" data-city="${list.cityId}" data-timezone="${list.timeZone}" data-gmt="${list.gmt}" data-name="${list.name}" href="#" class="view_link editairport" data-toggle="modal" data-target="#editnow">Edit</a><a data-token="${list.airportToken}" href="#" class="view_link deleteairport">Delete</a></td>
                    </tr>`;
                });
                $('.total').text(`Total Airports - ${airportsarray.length}`);
                $('.airportslisttable tbody').html(airportsList);
                $(".airportslisttable").DataTable({
                    dom: 'Bfrtip',
                    initComplete: function() {
                        $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                    },
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            title: 'Airports List',
                            exportOptions: {
                                columns: [0,1,2],
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Airports List',
                            exportOptions: {
                                columns: [0,1,2],
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
                    },
                    scrollX: true,
                    dom: '<f<"table-container"t>ip>'
                });
                $("#loading").hide(); //Main Loader Close
            });
        }

        function fetchcountries(){
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "../service-distributor-dashboard/API/Version1.0/distributor/onboardDetails.php"
            }).done(function(data1) {
                let countriesarray = data1.countries;
                let countryList = '<option value="0">Select Country</option>';
                countriesarray.forEach((list,index) => {
                    countryList += `<option value="${list.countryId}">${list.countryName}</option>`;
                });
                $('.countries').html(countryList);
            });
        }

        $('body').on('change','.countries',function(){
            let countryId = $(this).val();
            let id = $(this).attr('id');
            let datas = {
                "countryId":countryId
            };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "../service-distributor-dashboard/API/Version1.0/distributor/statesOfCountry.php",
                data: json1
            }).done(function(data1) {
                let statesArray = data1.states;
                let stateslist = '<option value="0">Select State</option>';
                statesArray.forEach((list,index) => {
                    stateslist += `<option data-country="${list.countryId}" value="${list.stateId}">${list.stateName}</option>`;
                });
                if(id == 'createcountry'){
                    $('#createstate').html(stateslist);
                }else if(id == 'editcountry'){
                    $('#editstate').html(stateslist);
                }
            });
        });

        $('body').on('change','.states',function(){
            let stateId = $(this).val();
            let countryId = $(this).find('option:selected').attr('data-country');
            let id = $(this).attr('id');
            let datas = {
                "countryId":countryId,
                "stateId":stateId
            };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "../service-distributor-dashboard/API/Version1.0/distributor/citiesOfState.php",
                data: json1
            }).done(function(data1) {
                let cityArray = data1.cities;
                let citieslist = '<option value="0">Select City</option>';
                cityArray.forEach((list,index) => {
                    citieslist += `<option value="${list.cityId}">${list.cityName}</option>`;
                });
                if(id == 'createstate'){
                    $('#createcity').html(citieslist);
                }else if(id == 'editstate'){
                    $('#editcity').html(citieslist);
                }
            });
        });

        $('body').on('click','.addairport',function(){
            let name = $('.createairportname').val();
            let code = $('.createairportcode').val();
            let cityId = $('#createcity').val();
            let timeZone = $('.createtimezone').val();
            let gmt = $('.creategmt').val();
            if(name != "" && code != "" && cityId != 0 && timeZone != "" & gmt != ""){
                let datas = {
                    "adminToken": adminToken,
                    "name": name,
                    "code": code,
                    "cityId": cityId,
                    "timeZone": timeZone,
                    "gmt": gmt
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/addAirport.php",
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
                    } else {
                        swal({
                            title:data1.title,
                            text:data1.message,
                            icon:"warning",
                        });
                    }
                });
            } else {
                if(name == ""){
                    swal("Airport Name cannot be blank")
                }
                if(code == ""){
                    swal("Airport Code cannot be blank")
                }
                if(cityId == 0){
                    swal("City Must be selected,Select Country and state first")
                }
                if(timeZone == ""){
                    swal("TimeZone cannot be blank")
                }
                if( gmt == ""){
                    swal("GMT cannot be blank")
                }
            }
        });


        $('body').on('click','.editairport',function(){
            let airportToken = $(this).attr('data-token');
            let name = $(this).attr('data-name');
            let code = $(this).attr('data-airportcode');
            let countryId = $(this).attr('data-country');
            let stateID = $(this).attr('data-state')
            let cityId = $(this).attr('data-city');
            let timeZone = $(this).attr('data-timezone');
            let gmt = $(this).attr('data-gmt');

            $('.updateairport').attr('data-token',airportToken)
            $('.edit_airportname').val(name);
            $('.edit_aiportcode').val(code);
            $('#editcountry').val(countryId);
            let datas = {
                "countryId":countryId
            };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "https://airportzostage.in/service-distributor-dashboard/API/Version1.0/distributor/statesOfCountry.php",
                data: json1
            }).done(function(data1) {
                let statesArray = data1.states;
                let stateslist = '<option value="0">Select State</option>';
                statesArray.forEach((list,index) => {
                    stateslist += `<option data-country="${list.countryId}" value="${list.stateId}">${list.stateName}</option>`;
                });
                $('#editstate').html(stateslist);
                $('#editstate').val(stateID);
            });
            let datas1 = {
                "countryId":countryId,
                "stateId":stateID
            };
            let json11 = JSON.stringify(datas1);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "https://airportzostage.in/service-distributor-dashboard/API/Version1.0/distributor/citiesOfState.php",
                data: json11
            }).done(function(data1) {
                let cityArray = data1.cities;
                let citieslist = '<option value="0">Select City</option>';
                cityArray.forEach((list,index) => {
                    citieslist += `<option value="${list.cityId}">${list.cityName}</option>`;
                });
                $('#editcity').html(citieslist);
                $('#editcity').val(cityId);
            });
            $('.edit_timezone').val(timeZone);
            $('.edit_gmt').val(gmt);
        });

        $('body').on('click','.updateairport',function(){
            let airportToken = $(this).attr('data-token');
            let name = $('.edit_airportname').val();
            let code = $('.edit_aiportcode').val();
            let cityId = $('#editcity').val();
            let timeZone = $('.edit_timezone').val();
            let gmt = $('.edit_gmt').val();
            if(name != "" && code != "" && cityId != 0 && timeZone != "" & gmt != ""){
                let datas = {
                    "adminToken": adminToken,
                    "airportToken":airportToken,
                    "name": name,
                    "code": code,
                    "cityId": cityId,
                    "timeZone": timeZone,
                    "gmt": gmt
                }
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/updateAirport.php",
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
                    } else {
                        swal({
                            title:data1.title,
                            text:data1.message,
                            icon:"warning",
                        });
                    }
                });
            } else {
                if(name == ""){
                    swal("Airport Name cannot be blank")
                }
                if(code == ""){
                    swal("Airport Code cannot be blank")
                }
                if(cityId == 0){
                    swal("City Must be selected,Select Country and state first")
                }
                if(timeZone == ""){
                    swal("TimeZone cannot be blank")
                }
                if( gmt == ""){
                    swal("GMT cannot be blank")
                }
            }
        });

        $('body').on('click','.deleteairport',function(){
            let airportToken = $(this).attr('data-token');
            swal({
                title: "Are you sure?",
                text: "Do you want to delete the Airport?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                    let datas = {
                        "adminToken":adminToken,
                        "airportToken":airportToken
                    };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/masterData/deleteAirport.php",
                        data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal("Deleted!", {icon: "success",}).then((value) => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title:data1.title,
                                text:data1.message,
                                icon:"warning",
                            });
                        }
                    });
                }
            });
        });

        function drpDownbtnClick (file){
            if(file == 'pdf'){
                $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
            }
            if(file == 'csv'){
                $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
            }
        }

        // csv upload
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
            let csvInput = $('#csv_file_upload').val();
            if (csvInput !== "") {
                $('#csv_upload_button').prop('disabled', true);
                var myFormData = new FormData();
                myFormData.append('file_upload', csv_file_upload.files[0]);
                myFormData.append('adminToken', adminToken);
                $.ajax({
                    dataType: "json",
                    url: apiPath + "/masterData/addAirportCsvUpload.php",
                    type: 'POST',
                    processData: false, // important
                    contentType: false, // important
                    data: myFormData
                }).done(function(data1) {
                    if(data1.status_code == 201){
                        swal({
                            title:data1.title,
                            text:'CSV Uploaded Successfully',
                            icon:"success",
                        }).then(()=>{
                            location.reload();
                            $('#csv_upload_button').prop('disabled', false);
                        });
                    } else {
                        swal({
                            title:data1.title,
                            text:data1.message,
                            icon:"warning",
                        });
                        $('#csv_upload_button').prop('disabled', false);
                    }
                });
            } else {
                swal("Please select a csv file!");
                $('#csv_upload_button').prop('disabled', false);
            }
        }
    </script>
</body>
</html>
<?php
}
?>