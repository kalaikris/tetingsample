<?php
session_start();
include_once '../config/core.php';
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
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="css/master_data.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
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
                    <h1 class="header_main">Business Type List</h1>
                    <p class="total_emp listtotal">Total Business List - 19</p>
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
                    <table class="custom-table distributorbusinesstype" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Business Type</th>
                                <th>Created Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                            <td>1</td>
                            <td>Airline</td>
                            <td>24 Nov 2022</td>
                            <td><a href="#" class="view_link">Delete</a></td>
                        </tr> -->

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
                            <div class="input-amety">
                                <h6>Business Type Name</h6>
                                <input class="typename" type="text" name="" placeholder="Hospital">
                            </div>
                            <div class="toggle-btn-box">
                                <p>Is Agent</p>
                                <div>
                                    <input type="checkbox" class="toggle-input create_toggle" id="toggle-switch">
                                    <label for="toggle-switch" class="toggle-btn">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="modal_btn cancel_modal_btn" onclick="removecreatedata();"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="modal_btn creat_modal_btn createbusiness">Create</button>
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
                            <div class="input-amety">
                                <h6>Business Type Name</h6>
                                <input class="editbusinessname" type="text" name="" placeholder="Hospital">
                            </div>
                            <div class="toggle-btn-box">
                                <p>Is Agent</p>
                                <div>
                                    <input type="checkbox" class="toggle-input edit_toggle" id="toggle-switch1">
                                    <label for="toggle-switch1" class="toggle-btn">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                            <button type="button" class="modal_btn creat_modal_btn businessupdate">Update</button>
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
        <script src="js/aws-sdk.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            /* Radion button box */
            $('.ratio-btn-selecter').on('click', function () {
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
            //Empty create dialogue inputs
            function removecreatedata() {
                $('.typename').val('');
                $('.create_toggle').prop('checked', false);

            }
        </script>
        <script src="js/function.js"></script>
        <script>
            var apiPath = "<?php echo $apiPath; ?>";
            $(document).ready(() => {
                fetchdistributorbusinesstype();

            });

            function fetchdistributorbusinesstype() {
                let datas = {
                    "adminToken": adminToken
                };
                let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/masterData/distributorTypeList.php",
                    data: json1
                }).done(function (data1) {
                    console.log(data1);
                    let distbusinessType = ''
                    let distbusiType = data1.data;
                    distbusiType.forEach((businesstype, index) => {

                        distbusinessType += `<tr>
                                                                                <td>${index + 1}</td>
                                                                                <td>${businesstype.name}</td>
                                                                                <td>${businesstype.createdDate}</td>
                                                                                <td><a href="#" data-token="${businesstype.token}" data-name="${businesstype.name}" data-isagent="${businesstype.isAgent}" class="view_link businessedit" data-toggle="modal" data-target="#editnow">Edit</a><a href="#" data-token="${businesstype.token}" class="view_link businessdelete">Delete</a></td>
                                                                            </tr>`;


                    });

                    $('.listtotal').text(`Total Business List -  ${distbusiType.length}`);
                    $('.distributorbusinesstype tbody').html(distbusinessType);
                    $('.distributorbusinesstype').DataTable({
                        dom: 'Bfrtip',
                        initComplete: function () {
                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                        },
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'Business type List',
                                exportOptions: {
                                    columns: [0, 1, 2],
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'Business type List',
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
                        }
                    });
                    $("#loading").hide(); //Main Loader Close
                });
            }

            $('body').on('click', '.createbusiness', function () {
                let name = $('.typename').val();
                let isAgent = $('.create_toggle').is(':checked') ? "1" : "0"
                if (name != "") {
                    let datas = {
                        "adminToken": adminToken,
                        "name": name,
                        "isAgent": isAgent
                    };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath + "/masterData/addDistributorType.php",
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
                    swal("Business Type Name cannot be blank")
                }
            });

            $('body').on('click', '.businessedit', function () {
                let distributorTypeToken = $(this).attr('data-token');
                let name = $(this).attr('data-name');
                let isAgent = $(this).attr('data-isagent') == 1 ? true : false;
                $('.businessupdate').attr('data-token', distributorTypeToken);
                $('.editbusinessname').val(name);
                $('.edit_toggle').prop('checked', isAgent);
            });

            $('body').on('click', '.businessupdate', function () {
                let distributorTypeToken = $(this).attr('data-token');
                let name = $('.editbusinessname').val();
                let isAgent = $('.edit_toggle').is(':checked') ? "1" : "0"
                if (name != "") {
                    let datas = {
                        "adminToken": adminToken,
                        "typeToken": distributorTypeToken,
                        "name": name,
                        "isAgent": isAgent
                    };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath + "/masterData/updateDistributorType.php",
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
                    swal("Business Type Name cannot be blank")
                }
            });

            $('body').on('click', '.businessdelete', function () {
                let distributorTypeToken = $(this).attr('data-token');
                swal({
                    title: "Are you sure?",
                    text: "Do you want to delete the BusinessType?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        let datas = {
                            "adminToken": adminToken,
                            "distributorTypeToken": distributorTypeToken
                        };
                        let json1 = JSON.stringify(datas);
                        $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath + "/masterData/deleteDistributorType.php",
                            data: json1
                        }).done(function (data1) {
                            console.log(data1);
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
                })
            })

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