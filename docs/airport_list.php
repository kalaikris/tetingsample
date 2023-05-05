<?php
    include '../config/core.php';
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
                <table class="custom-table agenttype" id="dataTables_filter">
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
                            <td>1</td>
                            <td>Chennai airport</td>
                            <td>adfadf</td>
                            <td>India</td>
                            <td>Tamilnadu</td>
                            <td>Chennai</td>
                            <td>chennai</td>
                            <td>+5.30</td>
                            <td><a href="#" class="view_link">Edit</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sub Agent</td>
                            <td>27 Apr 2022</td>
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
                            <input class="airportname" type="text" name="" placeholder="Enter Airport Name">
                        </div>
                        <div class="input-amety">
                            <h6>Airport Code</h6>
                            <input class="aiportcode" type="text" name="" placeholder="Enter Airport Code">
                        </div>
                        <div class="input-amety">
                            <h6>Country</h6>
                            <select name="" id="">
                                <option value="">Indian</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>State</h6>
                            <select name="" id="">
                                <option value="">Tamilnadu</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>City</h6>
                            <select name="" id="">
                                <option value="">Chennai</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>Timezone</h6>
                            <input class="timezone" type="text" name="" placeholder="Asia/Kolkata">
                        </div>
                        <div class="input-amety">
                            <h6>GMT</h6>
                            <input class="gmt" type="text" name="" placeholder="(+5.30)">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn createagenttype">Create</button>
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
                            <select name="" id="">
                                <option value="">Indian</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>State</h6>
                            <select name="" id="">
                                <option value="">Tamilnadu</option>
                            </select>
                        </div>
                        <div class="input-amety">
                            <h6>City</h6>
                            <select name="" id="">
                                <option value="">Chennai</option>
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
                        <button type="button" class="modal_btn creat_modal_btn updateagenttype">Update</button>
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

    // $(".custom-table").DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //         // {
    //         //     extend: 'csvHtml5',
    //         //     title: 'Project Management'
    //         // },
    //         // {
    //         //     extend: 'pdfHtml5',
    //         //     orientation: 'landscape',
    //         //     pageSize: 'LEGAL',
    //         //     title: 'Project Management'
    //         // }
    //     ],
    //     language: {
    //         search: '<img src="./assets_new/main/Search.png">',
    //         searchPlaceholder: "Search",
    //         paginate: {
    //             next: '<img style="width:18px;" src="assets_new/arrow-right.png?v=123">', // or '→'
    //             previous: '<img style="width:18px;" src="assets_new/arrow-left.png?v=123">' // or '←'  <img src="path/to/arrow.png">'
    //         }
    //     }
    // });
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
    </script>
    <script src="js/function.js"></script>
    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            fetchagenttype();
            
        });

        function fetchagenttype(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/agentTypeList.php",
                    data: json1
                    }).done(function(data1) {
                        let agenttypearray = data1.data;
                        let agenttypeList = '';

                        agenttypearray.forEach((list,index) => {

                            agenttypeList += `<tr>
                                                <td>${index + 1}</td>
                                                <td>${list.name}</td>
                                                <td>${list.createdDate}</td>
                                                <td><a data-token="${list.token}" data-name="${list.name}" href="#" class="view_link editagenttype" data-toggle="modal" data-target="#editnow">Edit</a><a data-token="${list.token}" href="#" class="view_link deleteagenttype">Delete</a></td>
                                            </tr>`;
                            
                        });


                        $('.total').text(`Total Airports - ${agenttypearray.length}`);
                        $('.agenttype tbody').html(agenttypeList);
                        $(".custom-table").DataTable({
                                                    dom: 'Bfrtip',
                                                    buttons: [
                                                            {
                                                                extend: 'csvHtml5',
                                                                title: 'Agent Type List',
                                                                exportOptions: {
                                                                                    columns: [0,1,2],
                                                                                },
                                                            },
                                                            {
                                                                extend: 'pdfHtml5',
                                                                orientation: 'landscape',
                                                                pageSize: 'LEGAL',
                                                                title: 'Agent Type List',
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
                                                    }
                                                });

                    })
        }

        $('body').on('click','.createagenttype',function(){
            let name = $('.agenttypename').val();
            if(name != ""){

                let datas = {
                                "adminToken":adminToken,
                                "name":name,
                            };
                let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/addAgentType.php",
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

            }else{

                swal("Agent Type Name cannot be blank")

            }
            
        })


        $('body').on('click','.editagenttype',function(){
            let typeToken = $(this).attr('data-token');
            let name = $(this).attr('data-name');
            $('.edit_agenttypename').val(name);
            $('.updateagenttype').attr('data-token',typeToken)


        });

        $('body').on('click','.updateagenttype',function(){
            let typeToken = $(this).attr('data-token');
            let name = $('.edit_agenttypename').val();

            if(name != ""){

                let datas = {
                                "adminToken":adminToken,
                                "typeToken":typeToken,
                                "name":name,
                            };
                let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/updateAgentType.php",
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

            }else{

                swal("Agent Type Name cannot be blank")

            }

        })

        $('body').on('click','.deleteagenttype',function(){

            let typeToken = $(this).attr('data-token');

            swal({
                    title: "Are you sure?",
                    text: "Do you want to delete the Agent Type?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete)=>{

                    if(willDelete){

                        let datas = {
                                    "adminToken":adminToken,
                                    "typeToken":typeToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/masterData/deleteAgentType.php",
                    data: json1
                    }).done(function(data1) {
                        console.log(data1);
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

        function drpDownbtnClick (file){
                if(file == 'pdf'){
                    $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
                }
                if(file == 'csv'){
                    $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
                }

            }

    </script>
</body>

</html>