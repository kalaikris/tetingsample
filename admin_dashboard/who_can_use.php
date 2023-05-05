<?php
session_start();
include_once '../config/core.php';
include_once '../security/secure.php';
if (isset($_COOKIE['azAdmin_Token']) == "") {
    header("Location:login.php");
} else {
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
        <style>
        </style>
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
                    <h1 class="header_main">Who Can Use</h1>
                    <p class="total_emp total">Total List - 5</p>
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
                    <div class="" data-toggle="modal" data-target="#createnow">
                        <button class="primary-btn">Create New</button>
                    </div>
                </div>
                <div class="table-box">
                    <table class="custom-table usergrouptable" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>SI.No</th>
                                <th>Service image</th>
                                <th>User Type</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/1.png"></div>
                                </td>
                                <td>Bussiness Vip</td>
                                <td>27 Nov 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/2.png"></div>
                                </td>
                                <td>Elserly Travels</td>
                                <td>19 Apr 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/3.png"></div>
                                </td>
                                <td>Corporate Delegations</td>
                                <td>19 Oct 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/4.png"></div>
                                </td>
                                <td>Families</td>
                                <td>19 Jun 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/5.png"></div>
                                </td>
                                <td>Unaccompained Mirrors</td>
                                <td>19 Apr 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>
                                    <div class="image_view"><img alt="" src="assets_new/whouse/6.png"></div>
                                </td>
                                <td>people with Reduced Mobility</td>
                                <td>10 Apr 2022</td>
                                <td><a href="#" class="view_link">Delete</a></td>
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
            <div class="modal" id="createnow" data-backdrop="static">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Create New</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div>
                                <input id="valid_uploadimg" type="hidden">
                                <label class="uploadfile" for="uploadimg">
                                    <input type="file" id="uploadimg" accept="image/jpeg,image/png">
                                    <img id="display_uploadimg" src="assets_new/amenities/upload.png" alt="">
                                    <p class="upladpara">Upload</p>
                                </label>
                            </div>
                            <div class="input-amety">
                                <h6>User Type</h6>
                                <input type="text" id="groupname" name="" placeholder="Corporate Delegations">
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="modal_btn creat_modal_btn createusertype">Create</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EDIT NOW MODAL -->
            <div class="modal" id="editnow" data-backdrop="static">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Edit</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div>
                                <input id="valid_edit_uploadimg" type="hidden">
                                <label class="uploadfile" for="edit_uploadimg">
                                    <input type="file" id="edit_uploadimg" accept="image/jpeg,image/png">
                                    <img id="display_edit_uploadimg" src="assets_new/amenities/upload.png" alt="">
                                    <p class="upladpara">Upload </p>
                                </label>
                            </div>
                            <div class="input-amety">
                                <h6>User Type</h6>
                                <input type="text" id="edit_groupname" name="" placeholder="Corporate Delegations">
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="modal_btn creat_modal_btn updateusertype">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!-- jquery CDN -->
        <script src="js/bootstrap.min.js"></script>
        <!-- datatable -->
        <script src="js/datatables.min.js"></script>
        <!-- js file -->
        <script src="js/header.js"></script>
        <script src="js/sidebar.js?v=999"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            var example = flatpickr('#flatpickr,#flatpickr2');
            $('.ratio-btn-selecter').on('click', function () {
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
                fetchusergroup();

            });
            function fetchusergroup() {
                let datas = {
                    "adminToken": adminToken
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/masterData/availableServiceList.php",
                    data: json1
                }).done(function (data1) {
                    let usergrouplistData = data1.data;
                    $('.total').text(`Total usergroup  - ${usergrouplistData.length}`)
                    let usergroupList = '';
                    usergrouplistData.forEach((list, index) => {
                        usergroupList += `<tr>
                                                <td>${index + 1}</td>
                                                <td><div class="image_view"><img alt="" src="${list.image}"></div></td>
                                                <td>${list.name}</td>
                                                <td>${list.createdDate}</td>
                                                <td><a href="#" data-token="${list.token}" data-image="${list.image}" data-name="${list.name}" class="view_link editusertype" data-toggle="modal" data-target="#editnow">Edit</a><a href="#" data-token="${list.token}" class="view_link deleteusertype">Delete</a></td>
                                            </tr>`;

                    });

                    $('.usergrouptable tbody').html(usergroupList);
                    $('.usergrouptable').DataTable({
                        dom: 'Bfrtip',
                        initComplete: function() {
                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                        },
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'Who can use List',
                                exportOptions: {
                                    columns: [0, 2, 3],
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'Who can use List',
                                exportOptions: {
                                    columns: [0, 2, 3],
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
            }

            $('body').on('change', '.uploadfile input', function () {
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
                    if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg") {
                        const [fileobjectname] = $(this).prop('files')
                        if (fileobjectname) {
                            let src = URL.createObjectURL(fileobjectname);
                            $(`#display_${id}`).attr('src', src);
                        }
                    }
                    //The file upload is NOT an image
                    else {
                        swal("Only file types of  PNG, JPG, and JPEG are allowed. ");
                    }
                }
            });

            var image_id = ['uploadimg'];
            var edit_image_id = ['edit_uploadimg'];
            function image_upload_loop(key, variable, action) {
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
                    console.log(file);
                    s3_file_upload(file, key, variable, action);
                }
            }

            function s3_file_upload(file, key, variable, action) {
                var seconds = new Date().getTime();
                seconds = parseInt(seconds);
                var extension = file.name.split('.').pop().toLowerCase();
                var filename = seconds + key + '.' + extension;
                var folder = `business_type/avail_services/`;
                var objKey = folder + filename;
                var params = {
                    Key: objKey,
                    ContentType: file.type,
                    Body: file
                };
                bucket.putObject(params, function (err, data) {
                    if (err) {
                        alert('ERROR: ' + err);
                    } else {
                        var image_fileurl = aws_cloudfront_url + folder + filename;
                        $("#valid_" + variable[key]).val(image_fileurl);
                        key++;
                        image_upload_loop(key, variable, action);
                    }
                });
            }

            $('body').on('click', '.createusertype', function () {
                let usergroupname = $('#groupname').val();
                let usergroupimageUrl = $('#uploadimg').val();
                if (usergroupname != "" && usergroupimageUrl != "" && usergroupimageUrl != undefined) {

                    image_upload_loop(0, image_id, 'create');
                } else {
                    swal("Please Enter Valid input in all Fields")
                }
            });

            function on_submit_create() {
                let name = $('#groupname').val();
                let image = $('#valid_uploadimg').val();

                let datas = {
                    "adminToken": adminToken,
                    "name": name,
                    "image": image
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/masterData/addAvailableService.php",
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
            }

            $('body').on('click', '.editusertype', function () {
                let image = $(this).attr('data-image');
                let name = $(this).attr('data-name');
                let serviceToken = $(this).attr('data-token');
                $('.updateusertype').attr('data-token', serviceToken)

                $(`#display_edit_uploadimg`).attr('src', image);
                $('#edit_groupname').val(name);
                $('#valid_edit_uploadimg').val(`${image}`);
            });

            $('body').on('click', '.updateusertype', function () {
                let usergroupname = $('#edit_groupname').val();
                let usergroupimageUrl = $('#edit_uploadimg').val();
                if (usergroupname != "" && usergroupimageUrl != "" && usergroupimageUrl != undefined) {
                    image_upload_loop(0, edit_image_id, 'update');
                } else if (usergroupimageUrl == "") {
                    on_submit_update();
                } else {
                    swal("Please Enter Valid input in all Fields")
                }
            });

            function on_submit_update() {
                let name = $('#edit_groupname').val();
                let image = $('#valid_edit_uploadimg').val();
                let serviceToken = $('.updateusertype').attr('data-token')
                
                let datas = {
                    "adminToken": adminToken,
                    "serviceToken": serviceToken,
                    "name": name,
                    "image": image
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/masterData/updateAvailableService.php",
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
            }

            $('body').on('click', '.deleteusertype', function () {
                let serviceToken = $(this).attr('data-token');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete the Usergroup",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        let datas = {
                            "adminToken": adminToken,
                            "serviceToken": serviceToken
                        };
                        let json1 = JSON.stringify(datas);
                        $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath + "/masterData/deleteAvailableService.php",
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

        </script>
    </body>
    </html>
    <?php
}
?>