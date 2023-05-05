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
    <title>User Management</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/user-role.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/user-mng.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">


</head>

<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">      
    </header>

    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar1"></div>
    
    <!-- main-contents -->
    <main class="main-contents">

        <section class="bg-white full-height" id="toggle">
            <div class="product_header_container">
                <div class="header-details ">
                    <h1 class="header_main">User List </h1>
                    <p class="total_emp total"></p>
                </div>
            </div>
           
            <!-- Nav tabs -->
            <div class="dropdown">
                <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="">
                <label for="filter-switch" class="dropdown__options-filter">
                    <ul class="dropdown__filter" role="listbox" tabindex="-1">
                        <li class="dropdown__filter-selected" aria-selected="true">
                            Download as
                        </li>
                        <li>
                            <ul class="dropdown__select">
                                <li class="dropdown__select-option" role="option">
                                    <a href="javascript:void(0)">CSV</a>
                                </li>
                                <li class="dropdown__select-option" role="option">
                                    <a href="javascript:void(0)">PDF</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </label>
            </div>

            <div class="tab-content" id="pills-tabContent" >
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table userlisttable" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>SI.NO</th>
                                <th>User Name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>Booking Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="bg-white full-height twoback" id="toggle1" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideModal()" alt="" class="backword">
                <h1 class="header_main header_main_h1 viewusername" ></h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Email Address</p>
                            <p class="useremail"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Contact Number</p>
                            <p class="usermob"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Booking Mode</p>
                            <p class="userbookingmode"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Total Miles Earned</p>
                            <p class="usertotalmiles"><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Available Miles</p>
                            <p class="useravailablemiles"><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="distributor-details-container">
                <div class="over-all-tab">
                        <table class="custom-table userdetailstable" id="dataTables_filter4">
                            <thead>
                                <tr>
                                    <th>SL.No</th>
                                    <th>Booking Id</th>
                                    <th>Miles Earned</th>
                                    <th>Miles Burned</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </section>
    </main>
    
    <!-- create now modal -->
    <div class="modal" id="createuser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add User</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="modal_input-container">
                        <div class="input__box">
                            <label class="form__label">Username</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="username" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Email Address</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="email" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Access Type</label>
                            <select name="" id="" class="form__select">
                                <option value="Admin">Admin</option>
                                <option value="Provider">Provider</option>
                            </select>
                        </div> 
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="creat_modal_btn createdistributor">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal" id="edituser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit User</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="modal_input-container">
                        <div class="input__box">
                            <label class="form__label">Username</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_username" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Email Address</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_email" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Access Type</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_access-type" class="form__input">
                        </div> 
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="creat_modal_btn createdistributor">Create</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <!--    datepicker-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> 
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/function.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            fetchusers();
        });

        function fetchusers(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/appUserList.php",
                data: json1
            }).done(function(data1) {
                let userlistarray = data1.data;
                let userlistdet = '';

                userlistarray.forEach((userlist,index) => {
                    let blockstatus = '';
                    if(userlist.status == 1){
                        blockstatus = `<a href="#" data-token="${userlist.token}" class="view_link blockuser">Block</a>`;
                    }else{
                        blockstatus = `<a href="#" data-token="${userlist.token}" class="view_link unblockuser">Unblock</a>`;
                    }
                    userlistdet += `<tr>
                                    <td>${index + 1}</td>
                                    <td>${userlist.name}</td>
                                    <td>${userlist.email}</td>
                                    <td>${userlist.mobileNumber}</td>
                                    <td>${userlist.bookedMode}</td>
                                    <td><a href="#" data-token="${userlist.token}" class="view_link viewuserdetails" onclick="showmodal()">View detail</a>${blockstatus}</td>
                                </tr>`;
                });
                
                $('.total').text(`Total Users -${userlistarray.length}`);
                $('.userlisttable tbody').html(userlistdet);
                $(".userlisttable").DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                buttons: [
                    // {
                    //     extend: 'csvHtml5',
                    //     title: 'Project Management'
                    // },
                    // {
                    //     extend: 'pdfHtml5',
                    //     orientation: 'landscape',
                    //     pageSize: 'LEGAL',
                    //     title: 'Project Management'
                    // }
                ],
                language: {
                    search: '<img src="./assets_new/main/Search.png">', searchPlaceholder: "Search" ,
                    paginate: {
                        next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                        previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                    }
                }
            });
            $("#loading").hide(); //Main Loader Close
            })
        }

        function blockunblock(userToken,status){
            let datas = {
                            "adminToken":adminToken,
                            "userToken":userToken,
                            "status": status
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/blockUnblock.php",
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
        }

        $('body').on('click','.blockuser',function(){
            let userToken = $(this).attr('data-token');
            let status = "2";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Block the User?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willblock)=>{
                    if(willblock){
                        blockunblock(userToken,status);
                    } else {
                        swal('Block cancelled');
                    }
                });
        });

        $('body').on('click','.unblockuser',function(){
            let userToken = $(this).attr('data-token');
            let status = "1";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Unblock the User?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willunblock)=>{
                    if(willunblock){
                        blockunblock(userToken,status);
                    } else {
                        swal('Unblock cancelled');
                    }
                });
        });

        $('body').on('click','.viewuserdetails',function(){
            let userToken = $(this).attr('data-token');
            let datas = {
                            "adminToken":adminToken,
                            "userToken":userToken
                            
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/singleAppUserDetails.php",
                data: json1
            }).done(function(data1) {
                let userdetails = data1.userDetails;
                let orderdetailsarray = data1.orderDetails;
                $('.viewusername').text(userdetails.name);
                $('.useremail').text(userdetails.email);
                $('.usermob').text(userdetails.mobileNumber);
                $('.userbookingmode').text(userdetails.bookedMode);
                $('.usertotalmiles').html(`<img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${userdetails.totalMilesEarned}`);
                $('.useravailablemiles').html(`<img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${userdetails.availableMiles}`);
                let orderslist = '';
                orderdetailsarray.forEach((orders,index) => {
                    orderslist += `<tr>
                                    <td>${index + 1}</td>
                                    <td><a data-token="${orders.token}" javascript:void(0)>${orders.bookingNumber}</a></td>
                                    <td><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${orders.MilesEarned}</td>
                                    <td><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${orders.MilesBurned}</td>
                                  </tr>`;
                });

                $('.userdetailstable tbody').html(orderslist);
                $('.userdetailstable').DataTable().destroy();
                $('.userdetailstable tbody').html(orderslist);
                $('.userdetailstable').DataTable({
                                                        dom: 'Bfrtip',
                                                        initComplete: function() {
                                                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                                                        },
                                                        buttons: [
                                                            // {
                                                            //     extend: 'csvHtml5',
                                                            //     title: 'Distributor Total Users',
                                                            //     exportOptions: {
                                                            //                         columns: [0,1,2,3],
                                                            //                     },
                                                            // },
                                                            // {
                                                            //     extend: 'pdfHtml5',
                                                            //     orientation: 'landscape',
                                                            //     pageSize: 'LEGAL',
                                                            //     title: 'Distributor Total Users',
                                                            //     exportOptions: {
                                                            //                         columns: [0,1,2,3],
                                                            //                     },
                                                            // }
                                                        ],
                                                        language: {
                                                            search: '<img src="./assets_new/main/Search.png">',
                                                            searchPlaceholder: "Search",
                                                            paginate: {
                                                                next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                            }
                                                        }
                                                    }).draw();
                                                    $("#loading").hide(); //Main Loader Close
            });
        });
    </script>
</body>
</html>
<?php
}
?>