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
    <link rel="stylesheet" href="css/select.css<?php echo $js_cache_string; ?>">
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
                <h1 class="header_main">GST Number</h1>
                <p class="total_emp total">Total GST Number - 2</p>
            </div>
            <div class="header_btn-container">
            </div>
            <div class="table-box">
                <table class="custom-table airportslisttable" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>GST No</th>
                            <th>Pancard Number</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
        <!-- EDIT MODAL -->
        <div class="modal" id="editnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit GST Number</h4>
                    </div>
                    <!-- Modal body -->
                    <input id="editcountrys" type="hidden" value="">
                    <input id="editstates" type="hidden" value="">
                    <div class="modal-body">
                        <div class="input-amety">
                            <h6>GST Number</h6>
                            <input id="editgst" type="text" name="" placeholder="Enter GST no" value="">
                        </div>
                        <div class="input-amety">
                            <h6>Pancard Number</h6>
                            <input id="editpancard" type="text" name="" placeholder="Enter Pancard Number" value="">
                        </div>
                        <div class="input-amety">
                            <h6>Company Name</h6>
                            <input id="editcompany" type="text" name="" placeholder="Enter Company Name" value="">
                        </div>
                        <div class="input-amety">
                            <h6>Address</h6>
                            <!-- <input id="editaddress" type="text" name="" placeholder="Enter Address" value=""> -->
                            <textarea id="editaddress" placeholder="Enter Address" value=""></textarea>
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
                                <input id="csv_file_upload"
                                    onchange="file_upload_csv('csv_file','csv_view_url','assets_new/upload_csv_done.png')"
                                    type="file" accept=".csv" style="display:none;">
                                <img alt="" src="assets_new/csvfile.png" width="48" class="csvfile" id="csv_view_url" />
                                <p id="csv_file_name" class="mt-2">Upload Files</p>
                            </label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal"
                            onclick="cancelcsvfile()">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn" id="csv_upload_button"
                            onclick="upload_csv_file()">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="js/select.js"></script>
    <!-- js file -->
    <script src="js/header.js"></script>
    <script src="js/sidebar.js?v=999"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/function.js"></script>
    <script>
    var apiPath = "<?php echo $apiPath; ?>";
    $(document).ready(() => {
        fetchairports();
    });

    function fetchairports() {
        let datas = {
            "adminToken": adminToken
        };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath + "/masterData/gst_no_country.php",
            data: json1
        }).done(function (data1) {
            let gst_list_array = data1.data;
            let gstList = '';
            gst_list_array.forEach((list, index) => {
            gstList += `<tr>
                            <td>${index + 1}</td>
                            <td>${list.countryName}</td>
                            <td>${list.stateName}</td>
                            <td>${list.gst_no}</td>
                            <td>${list.pancard_number}</td>
                            <td>${list.company_name}</td>
                            <td>${list.address}</td>
                            <td><a data-country="${list.countryId}" data-state="${list.stateId}" data-gst="${list.gst_no}" data-pancard_number="${list.pancard_number}" data-company-name="${list.company_name}" data-address="${list.address}" href="javascript:void(0);" class="view_link editairport" data-toggle="modal" data-target="#editnow">Edit GST</a></td>
                        </tr>`;
            });
            $('.total').text(`Total - ${gst_list_array.length}`);
            $('.airportslisttable tbody').html(gstList);
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
                            columns: [0, 1, 2],
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: 'Airports List',
                        exportOptions: {
                            columns: [0, 1, 2],
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

    function fetchcountries() {
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath + "/distributor/onboardDetails.php"
        }).done(function (data1) {
            let countriesarray = data1.countries;
            let countryList = '<option value="" selected disabled>Select Country</option>';
            countriesarray.forEach((list, index) => {
                countryList += `<option value="${list.countryId}">${list.countryName}</option>`;
            });
            $('#editcountry').html(countryList);
            $("#editcountry").change(function () {
            }).chosen({ allow_single_deselect: true }); ({
                width: '100%',
                filter: true
            });
        });
    }

    $('body').on('change', '.countries', function () {
        let countryId = $(this).val();
        let id = $(this).attr('id');
        let datas = {
            "countryId": countryId
        };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath + "/distributor/statesOfCountry.php",
            data: json1
        }).done(function (data1) {
            let statesArray = data1.states;
            let stateslist = '<option value="" selected disabled>Select State</option>';

            statesArray.forEach((list, index) => {
                stateslist += `<option data-country="${list.countryId}" value="${list.stateId}">${list.stateName}</option>`;
            });

            $('#editstate').html(stateslist);
            $('#editstate').trigger('chosen:updated');

            let citieslist = '<option value="" selected disabled>Select City</option>';
            $('#editcity').html(citieslist);
            $('#editcity').trigger('chosen:updated');
            $('#editgst').val('');
            $('#editpancard').val('');
            $('#editcompany').val('');
            $('#editaddress').val('');
        })
    })

    $('body').on('change', '.states', function () {
        let stateId = $(this).val();
        let countryId = $(this).find('option:selected').attr('data-country');
        let id = $(this).attr('id');
        let datas = {
            "countryId": countryId,
            "stateId": stateId
        };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath + "/distributor/citiesOfState.php",
            data: json1
        }).done(function (data1) {
            let cityArray = data1.cities;
            let citieslist = '<option value="" selected disabled>Select City</option>';
            cityArray.forEach((list, index) => {
                citieslist += `<option value="${list.cityId}">${list.cityName}</option>`;
            });
            $('#editcity').html(citieslist);
            $('#editcity').trigger('chosen:updated');
            $('#editgst').val('');
            $('#editpancard').val('');
            $('#editcompany').val('');
            $('#editaddress').val('');
        });
    });

    $('body').on('change', '.city', function () {
        $('#editgst').val('');
        $('#editpancard').val('');
        $('#editcompany').val('');
        $('#editaddress').val('');
    });

    $('body').on('click', '.editairport', function () {
        let countryId = $(this).attr('data-country');
        let stateId = $(this).attr('data-state');
        let gst_no = $(this).attr('data-gst');
        let pancard = $(this).attr('data-pancard_number');
        let company_names = $(this).attr('data-company-name');
        let address = $(this).attr('data-address');
        $('#editcountrys').val(countryId);
        $('#editstates').val(stateId);
        $('#editgst').val(gst_no);
        $('#editpancard').val(pancard);
        $('#editcompany').val(company_names);
        $('#editaddress').val(address);
    });

    $('body').on('click', '.updateairport', function () {
        let countryId = $('#editcountrys').val();
        let stateId = $('#editstates').val();
        let gst_no = $('#editgst').val();
        let pancard = $('#editpancard').val();
        let company_name = $('#editcompany').val();
        let address = $('#editaddress').val();
        if (gst_no != "" && pancard!="" && company_name!="" && address!="") {
            let datas = {
                "adminToken": adminToken,
                "countryId": countryId,
                "stateId": stateId,
                "gst_no": gst_no,
                "pancard": pancard,
                "company_name": company_name,
                "address": address
            };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath + "/masterData/update_gst_number.php",
                data: json1
            }).done(function (data1) {
                if (data1.status_code == 201) {
                    swal({
                        title: data1.title,
                        text: data1.message,
                        icon: "success",
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    swal({
                        title: data1.title,
                        text: data1.message,
                        icon: "warning",
                    });
                }
            });
        } else {
            if (gst_no == "") {
                swal("GST cannot be blank");
            } else if(pancard == ""){
                swal("Pancard cannot be blank");
            } else {
                swal("Address cannot be blank");
            }
        }
    });

    $('body').on('click', '.deleteairport', function () {
        let airportToken = $(this).attr('data-token');
        swal({
            title: "Are you sure?",
            text: "Do you want to delete the Airport?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let datas = {
                    "adminToken": adminToken,
                    "airportToken": airportToken
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/masterData/deleteAirport.php",
                    data: json1
                }).done(function (data1) {
                    if (data1.status_code == 201) {
                        swal("Deleted!", { icon: "success", }).then((value) => {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: data1.title,
                            text: data1.message,
                            icon: "warning",
                        });
                    }
                });
            }
        });
    });

    function drpDownbtnClick(file) {
        if (file == 'pdf') {
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
        }
        if (file == 'csv') {
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
        }
    }

    // csv upload
    function file_upload_csv(file_id, view_id, replace_src) {
        var fileUpload = document.getElementById(file_id + "_upload");
        var files = !!fileUpload.files ? fileUpload.files : [];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.csv|.CSV)$");
        if (regex.test(files[0].type)) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    $('#' + view_id).attr('src', replace_src);
                    $('#' + file_id + '_valid').val("true");
                    $("#" + file_id + '_name').html(files[0].name);
                }
            }
        }
    }

    function cancelcsvfile() {
        var csvfilename = csv_file_upload.files[0];
        if (csvfilename == undefined) {
            $("#myModal").modal('hide');
        } else {
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
            }).done(function (data1){
                if (data1.status_code == 201) {
                    swal({
                        title: data1.title,
                        text: 'CSV Uploaded Successfully',
                        icon: "success",
                    }).then(() => {
                        location.reload();
                        $('#csv_upload_button').prop('disabled', false);
                    });
                } else {
                    swal({
                        title: data1.title,
                        text: data1.message,
                        icon: "warning",
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