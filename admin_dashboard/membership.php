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
    <title>Booking Managament</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/booking-mng.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
    </style>
</head>
<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar3"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Membership Management</h1>
<!--                <p class="total_emp total">Total Memberships - 23</p>-->
            </div>
            <div class="header_btn-container">
                <div>
                    <div class="input__box">
                        <label class="form__label">Service Distributor</label>
                        <select class="form__select" id="loyal_distributor">
                        </select>
                    </div>
                    <div class="input__box input_datebox">
                        <input type='text' class="b-input datepicker form__input" id="from_date" placeholder="From date" readonly/>
                    </div>
                    <div class="input__box input_datebox">
                        <input type='text' class="b-input datepicker form__input" id="to_date" placeholder="To date" readonly/>
                    </div>
                    <div class="subit-cont">
                        <button class="primary-btn daterangefilter mt-1" onclick="loyaltyBookingList()">Generate</button>
                    </div>
                </div>
                <div class="dropdown">
                    <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="" />
                    <label for="filter-switch" onclick="downloadLoyaltyList()" class="dropdown__options-filter">
                        <ul class="dropdown__filter" role="listbox" tabindex="-1">
                            <li class="dropdown__filter-selected" aria-selected="true">
                                Download
                            </li>
                        </ul>
                    </label>
                </div>
            </div>
            <div class="table-box">
                <table class="custom-table booking-manage" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Booking Number</th>
                            <th>Member Number</th>
                            <th>Member Name</th>
                            <th>Service Date</th>
                            <th>Partner Code</th>
                            <th>Location</th>
                            <th>Base Points</th>
                            <th>Bonus Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ======== MODAL POPUPS ======== -->


    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!-- js file -->
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <!-- <script src="js/S3config_uploadfunc.js?v=<?php echo $js_cache_string; ?>"></script> -->
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/function.js"></script>
    <script>
        var example = flatpickr('#flatpickr,#flatpickr2');
        var apiPath = "<?php echo $apiPath; ?>";
        $("#from_date").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        $("#to_date").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            
            format: "DD-MM-YYYY",
        });
    
        $(document).ready(function(){  
            var datas = {
                "adminToken":adminToken,
                "type":'get_distributor_name'
            }
            var json = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: apiPath+"/distributor/membershipDetails.php",
                data:json,
            }).done(function(data){
                loyalDistributor = data.data;
                var loyalHtml;
                 loyalHtml = `<option value=''>Select Distributor</option>`;
                loyalDistributor.forEach(function(loyValue){
                     loyalHtml += `<option value='${loyValue.distributorToken}'>${loyValue.distributorName}</option>`;
                });
                $('#loyal_distributor').html(loyalHtml);
                $("#loading").hide(); //Main Loader Close
            });
        });
        function loyaltyBookingList(){
            let memberlist = '';
            var fromDate = $("#from_date").val();
            var toDate = $("#to_date").val();
            var distributorToken = $('#loyal_distributor').val();
            // if (fromDate > toDate && toDate != "" && toDate != undefined) {
            //         $("#to_date").val(fromDate);
            // }
            // var toDate = $("#to_date").val();
            if(fromDate != "" && toDate != "" && distributorToken != ""){
                var datas = {
                    "adminToken": adminToken,
                    "type":'get_membership_details',
                    "fromDate": fromDate,
                    "toDate": toDate,
                    "distributorToken": distributorToken
                }
                var json = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: apiPath+"/distributor/membershipDetails.php",
                    data: json,
                }).done(function(data){
                    if(data.status_code == 200){
                        var memberListData = data.data;
                        memberListData.forEach((member,index) => {
                            memberlist += `<tr>
                                            <td>${member.bookingNumber}</td>
                                            <td>${member.membershipNumber}</td>
                                            <td>${member.passengerFullName}</td>
                                            <td>${member.dateActivity}</td>
                                            <td>${member.partnerCode}</td>
                                            <td>${member.airportName}</td>
                                            <td>${member.basePoints}</td>
                                            <td>${member.bonusPoints}</td>
                                        </tr>`;
                        });
                        $("#dataTables_filter").DataTable().destroy();
                        $("#dataTables_filter tbody").html(memberlist);
                        $("#dataTables_filter").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Admin SP Reports'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A3',
                                    title: 'Admin SP Reports'
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
                        }).draw();
                    }
                });
            }
        }
        
        function downloadLoyaltyList(){
            var fromDate = $("#from_date").val();
            var toDate = $("#to_date").val();
            var distributorToken = $('#loyal_distributor').val();
            // if (fromDate > toDate && toDate != "" && toDate != undefined) {
            //         $("#to_date").val(fromDate);
            // }
            // var toDate = $("#to_date").val();
            
            if(fromDate != "" && toDate != "" && distributorToken != ""){
                 var datas = {
                        "adminToken": adminToken,
                        "type":'get_membership_details',
                        "fromDate": fromDate,
                        "toDate": toDate,
                        "distributorToken": distributorToken
                    }
                var json = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: apiPath+"/distributor/membershipDetails.php",
                    data: json,
                }).done(function(data){
                    if(data.status_code == 200 && data.row_count > 0){
                        window.location= apiPath+"/distributor/getMembershipTxtFile.php?adminToken="+adminToken+"&fromDate="+fromDate+"&toDate="+toDate+"&distributorToken="+distributorToken;
                    }else{
                       swal('No Record Found on these date'); 
                    }
                });
            }
        }
    </script>
</body>
</html>
<?php
}
?>