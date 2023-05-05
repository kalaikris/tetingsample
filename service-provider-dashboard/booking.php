<?php
session_start();
include_once '../config/core.php';
if (isset($_COOKIE['service_token']) == "") {
    header("Location:login.php");
}else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>booking</title>
        <link rel="icon" type="image/png" href="asset/img/airportzo-icon.png" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-icons.css" />
        <!-- data table link -->
        <link rel="stylesheet" href="js/data-table-css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="js/data-table-css/searchBuilder.dataTables.min.css" />
        <link rel="stylesheet" href="js/data-table-css/dataTables.dateTime.min.css" />
        <!-- datepicker style -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css" />
        <!--  data table CSS only -->
        <link rel="stylesheet" href="js/data-table-css/bootstrap.css" />
        <!-- fonts famaly -->
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>" />
        <!-- custm css -->
        <link rel="stylesheet" href="css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="css/commen.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="css/booklist.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="css/order-details.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="css/upcoming.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/ongoing.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <style>
        .bluebtn{
            color: var(--clr-neutral-900)
        }
        .msg-rghit{
            display: block;
        }
        .msg-rghit span{
            display: inline-block;
        }
        .cancel-info{
            font-size: 13px;
            color: #6a6a6a; 
        }
        .cancel-info img{
            vertical-align:top;
        }
        /* -=======- */
        </style>
    </head>
    <body id="page">
    <div id="loading"></div>
    <header id="header"></header>
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar"></div>
            <div class="slider-desc-set">
                <div class="show-booking-list">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">New booking request</li>
                        <li class="tab-link" data-tab="tab-2">Booking History</li>
                    </ul>
                    <div class="underline"></div>
                    <div id="tab-1" class="tab-content current">
                        <h1 class="booking-text">Bookings</h1>
                        <table id="bookingTable" class="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Booking ID</th>
                                    <th>Payment ID</th>
                                    <th>Booked On</th>
                                    <th>Customer Name</th>
                                    <th>Contact Number</th>
                                    <th>Adult</th>
                                    <th>Children</th>
                                    <th>Service Availed On</th>
                                    <th>Package</th>
                                    <th>Assigned Token</th>
                                    <th>Assigned Person</th>
                                    <th>Complete Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!--------------------------------------------------Booking History---------------------------------------------------------------------->
                    <div id="tab-2" class="tab-content">
                        <div class="three-box-set">
                            <div class="box-3">
                                <div class="cont-set">
                                    <img src="asset/img/upcoming.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="upcoming_booking_count"></h3>
                                    <p class="card-cont">Upcoming bookings</p>
                                </div>
                            </div>
                            <div class="box-2">
                                <div class="cont-set">
                                    <img src="asset/img/onassin-book.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="unassisgned_booking_count"></h3>
                                    <p class="card-cont">Unassigned booking</p>
                                </div>
                            </div>
                            <div class="box-2">
                                <div class="cont-set">
                                    <img src="asset/img/onassin-book.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="assisgned_booking_count"></h3>
                                    <p class="card-cont">Assigned booking</p>
                                </div>
                            </div>
                            <div class="box-1">
                                <div class="cont-set">
                                    <img src="asset/img/ongoing.png" alt="" class="inner-img"/>
                                    <h3 class="card-number" id="ongoing_booking_count"></h3>
                                    <p class="card-cont">Ongoing bookings</p>
                                </div>
                            </div>
                            <div class="box-4">
                                <div class="cont-set">
                                    <img src="asset/img/tick@icon.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="completed_booking_count"></h3>
                                    <p class="card-cont">Completed bookings</p>
                                </div>
                            </div>
                            <div class="box-4">
                                <div class="cont-set">
                                    <img src="asset/img/tick@icon.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="noShow_count"></h3>
                                    <p class="card-cont">No Show</p>
                                </div>
                            </div>
                        </div>
                        <div class="date-con-set">
                            <div class="comn-align">
                                <h1 class="booking2-text">Bookings</h1>
                                <div style="display:flex;gap:12px;">
                                    <label><input type="radio" name="date_filter" value="1" checked>Booking Date</label>
                                    <label><input type="radio" name="date_filter" value="2">Service Date</label>
                                    <div class="arriving-input-set input-group-book" id="ser_date_books">
                                        <span class="input-group-addon bg-date-book"></span>
                                        <div class="date-con">
                                            <label for="arrive_date">From Date</label><br/>
                                            <input type="text" class="b-input-book datepicker" id="bookinghistory_fromdate" placeholder="DD-MM-YYYY" readonly />
                                        </div>
                                    </div>
                                    <div class="arriving-input-set input-group-book" id="ser_date_books">
                                        <span class="input-group-addon bg-date-book"></span>
                                        <div class="date-con">
                                            <label for="arrive_date">To Date</label><br/>
                                            <input type="text" class="b-input-book datepicker" id="bookinghistory_todate" placeholder="DD-MM-YYYY" readonly />
                                        </div>
                                    </div>
                                    <button type="button" class="cust-btn cust-btn-primary" onclick="date_filter()">Generate</button>
                                </div>
                            </div>
                        </div>
                        <table id="bookinghistoryTable" class="" style="width: 100%:">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Booking ID</th>
                                    <th>Payment ID</th>
                                    <th>Booked On</th>
                                    <th>Customer Name</th>
                                    <th>Contact Number</th>
                                    <th>Adult</th>
                                    <th>Children</th>
                                    <th>Service Availed on</th>
                                    <th>Package</th>
                                    <th>Assigned Token</th>
                                    <th>Assigned Person</th>
                                    <th>Complete Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!--========================================orderdetails======================================================-->
                <div class="show-orders-detailes hide">
                    <div id="order-detail-id"></div>
                    <div class="order-contant-set" id="assign_dropdown">
                        <div class="button-groub2">
                            <div class="form">
                                <select id="assign_person" name="assign-to" required>
                                    <option value="">Select Your Assign Person</option>
                                </select>
                                <label for="assign-to">Assign to</label>
                            </div>
                            <button class="cust-btn cust-btn-success assing-btn" onclick="add_assign()">Assign</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Notes Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content cancellation">
                    <div class="modal-header-cancellation">
                        <h5 class="modal-title" id="exampleModalLongTitle">Notes</h5>
                        <button type="button" class="close rong" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="cancellation-massage-box">
                            <textarea class="cancellation-text_box" id="update_notes" placeholder="Type message"></textarea>
                            <div class="massage_text"></div>
                        </div>
                        <div class="modal-footer-charage">
                            <button type="button" class="btn-charage btn-primary" onclick="add_notes()">Add notes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- booking cancellation Modal -->
        <div class="modal fade" id="booking_cancellation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content cancellation">
                    <div class="modal-header-cancellation">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cancellation</h5>
                        <button type="button" class="close rong" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="booking_token">
                        <input type="hidden" id="bookingService_token">
                        <div class="radio_input-box">
                            <input type="radio" id="cancel_with_charges" name="cancel_charges" value="1">
                            <label for="cancel_with_charges">Cancellation With Charges</label>
                        </div>
                        <div class="radio_input-box">
                            <input type="radio" id="cancel_without_charges" name="cancel_charges" value="2">
                            <label for="cancel_without_charges">Cancellation Without Charges</label>
                        </div>
                        <div class="modal-footer-charage">
                            <button type="button" class="btn-charage btn-primary" onclick="cancelServiceBooking()">cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- date picker -->
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <!-- data table js -->
    
    <script src="js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="js/data-table-js/dataTables.dateTime.min.js"></script>
    <!-- JavaScript Bundle with Popper boostrap -->
    <script src="js/data-table-js/dataTables.bootstrap4.min.js"></script>
    <script src="js/data-table-js/searchBuilder.bootstrap4.min.js"></script>
    <!-- data table custm js -->
    <script src="js/table.js"></script>
    <!-- sidebar-heder -->
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-firestore.js"></script>
    <script>
        $("#bookinghistory_fromdate").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
            maxDate: new Date()
        });
        $("#bookinghistory_todate").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
            maxDate: new Date()
        });
        
    var apiPath = "<?php echo $apiPath; ?>";
    $(document).ready(function(){
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        serviceprovider_sidemenu(staff_token);
        $("#booking_order").addClass("actives");
        fetch_data();
        data_fetch();
    });
    
    var table1;
    function fetch_data(){
        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');

        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }
        table1 = $("#bookingTable").DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':apiPath+"/provider/newBookingOrder.php?serviceProviderLocationtoken="+companylocation_token,
                'dataSrc': function(data) {
                        return data.aaData;
                    }
                },
            "order": [[0, "DESC" ]],
            'columns': [
                { data: 'token' },
                { data: 'bookingNumber' },
                { data: 'paymentId' },
                { data: 'dateTime' },
                { data: 'userName' },
                { data: 'mobileNumber' },
                { data: 'totalAdult' },
                { data: 'totalChildren' },
                { data: 'serviceDateTime' },
                { data: 'serviceName' },
                { data: 'assigneeToken' },
                { data: 'assigneeName' },
                { data: 'overall_status'},
                { data: 'status' }
            ],
            dom: 'Bfrtip',
            language: {
                search: '<img src="asset/svg/search@2x.png">', searchPlaceholder: "Search" ,
                paginate: {
                    next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
                    previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
                }
            }
        });
        table1.column(10).visible(false);
        $('#bookingTable_wrapper').find('input[type=search]').val('');
        $('#bookingTable_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
    }
   
    var table;
    function data_fetch(){
        var from_date = $("#bookinghistory_fromdate").val();
        var to_date   = $("#bookinghistory_todate").val();
        var d1 = Date.parse(from_date);
        var d2 = Date.parse(to_date);
        
        if(d1>d2){
            $("#bookinghistory_todate").val(from_date);
        }
        var to_date   = $("#bookinghistory_todate").val();
        
        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }

        var radioBtn = $("input[name='date_filter']:checked").val();
        table = $("#bookinghistoryTable").DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':apiPath+"/provider/bookingOrderHistory.php?serviceProviderLocationtoken="+companylocation_token+"&&from_date="+from_date+"&&to_date="+to_date+"&&radioBtn="+radioBtn,
                'dataSrc': function(data) {
                    console.log(data);
                        $('#upcoming_booking_count').html(data.upcomingCount);
                        $('#unassisgned_booking_count').html(data.unassignedCount);
                        $('#assisgned_booking_count').html(data.assignedCount);
                        $('#ongoing_booking_count').html(data.ongoingCount);
                        $('#completed_booking_count').html(data.completedCount);
                        $('#noShow_count').html(data.noShowCount);
                        return data.aaData;
                    }
                },
            "order": [[0, "DESC" ]],
            'columns': [
                { data: 'token' },
                { data: 'bookingNumber' },
                { data: 'paymentId' },
                { data: 'dateTime' },
                { data: 'userName' },
                { data: 'mobileNumber' },
                { data: 'totalAdult' },
                { data: 'totalChildren' },
                { data: 'serviceDateTime' },
                { data: 'serviceName' },
                { data: 'assigneeToken' },
                { data: 'assigneeName' },
                { data: 'overall_status'},
                { data: 'status' }
            ],
            dom: 'Bfrtip',
            language: {
                search: '<img src="asset/svg/search@2x.png">', searchPlaceholder: "Search" ,
                paginate: {
                    next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
                    previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
                }
            }
        });
        table.column(10).visible(false);
        $('#bookinghistoryTable_wrapper').find('input[type=search]').val('');
        $('#bookinghistoryTable_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');

        var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
        }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
        }
        var datas = {
            "serviceProviderCompanyLocationToken": companylocation_token
        }
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: `${apiPath}/provider/providerLocationStaffs.php`,
            data: json_data,
        }).done(function(data){
            var assign_data = data.data;
            if(data.status_code=="201"){
                $('#assign_person').empty();
                var assigndata='<option value="">Select Your Assign Person</option>'
                for(var key in assign_data)
                {
                    assigndata +='<option value="'+assign_data[key].token+'">'+assign_data[key].name+'</option>'
                }
                $("#assign_person").html(assigndata);
            }
        });
    }
    
    function date_filter() {
        var from_date = $("#bookinghistory_fromdate").val();
        var to_date   = $("#bookinghistory_todate").val();
        var d1 = Date.parse(from_date);
        var d2 = Date.parse(to_date);
        if(d1>d2) {
            $("#bookinghistory_todate").val(from_date);
        }
        var to_date   = $("#bookinghistory_todate").val();
        if(from_date!="" && to_date!="" && from_date!=undefined && to_date!=undefined) {
            table.clear();
            table.destroy();
            data_fetch();
        }
    }

    const firebaseConfig = {
        apiKey: "AIzaSyC6VlZe6aISWHba7Mg5TciAJoz_yixu7R0",
        authDomain: "airportzo-dev.firebaseapp.com",
        databaseURL: "https://airportzo-dev-default-rtdb.firebaseio.com",
        projectId: "airportzo-dev",
        storageBucket: "airportzo-dev.appspot.com",
        messagingSenderId: "1050700848789",
        appId: "1:1050700848789:web:a2184d1c65568d80b5459c",
        measurementId: "G-ZGW4SN33ZP"
    };

    function get_assigned(booking__token,assignee_id,userpassenger_Token){
        var booking__token = booking__token;
        var assigned_token = $('#'+`${assignee_id}`).val();
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        var datas = {
            "bookingToken":booking__token,
            "assigneeToken":assigned_token,
            "assigneeByToken":staff_token
        }
        firebase.initializeApp(firebaseConfig);
        const db=firebase.firestore();
        db.collection("service").doc(booking__token).set({
            participants: [`user-${userpassenger_Token}`, `provider-${assigned_token}`]
        }).then(() => {
            var Json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType:"json",
                url: `${apiPath}/provider/assignStaff.php`,
                data: Json_data,
            }).then(()=>{
                location.reload();
            });
        });
    }

    function booking_details(bookingToken){
        var datas = {
            "bookingToken": bookingToken
        }
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : `${apiPath}/provider/singleBookingDetails.php`,
            data: json_data,
            success: view_bookingdetails
        });
    }

    function view_bookingdetails(data){
        $('#assign_dropdown').hide();
        $(".show-orders-detailes").show();
        $(".show-booking-list").hide();
        if(data.status_code == 201){
            var booking_details = data.details;
            localStorage.setItem('BookingsToken',booking_details.bookingDetails.token);
            var htmlText = "";
                htmlText +=`<div class="order-details-set">
                            <h2 class="order-titel">Order Details</h2>
                            <div class="order-titel-header">
                                <div class="p-set">
                                    <p>Order:<span>${booking_details.bookingDetails.token}</span></p>
                                    <p>Booked on : ${booking_details.orderDetail.bookedOn}</p>
                                    <p>Passenger: ${booking_details.orderDetail.totalAdults} Adults, ${booking_details.orderDetail.totalChildren} Child</p>
                                </div>
                                <div class="msg-rghit">`;
                                if(booking_details.bookingDetails.status=="Pending" || booking_details.bookingDetails.status=="Assign"){
                                    htmlText+=`<span class="upcoming"><img src="asset/img/up.png">Upcoming</span>`;
                                }else if(booking_details.bookingDetails.status=="Ongoing"){
                                    htmlText+=`<span class="ongoing"><img src="asset/img/ong.png">Ongoing</span>`;
                                }else if(booking_details.bookingDetails.status=="Completed" || booking_details.bookingDetails.status=="NoShow"){
                                    htmlText+=`<span class="accepted"><img src="asset/img/acp.png">Completed</span>`;
                                }else if(booking_details.bookingDetails.status=="Confirmed"){
                                    htmlText+=`<span class="accepted"><img src="asset/img/acp.png">Confirmed</span>`;
                                }else{
                                    htmlText+=`<span class="cancelled"><img src="">Cancelled</span>`;
                                }
                                htmlText+=`</div>
                            </div>
                        </div>
                        <div class="order-contant-all">
                            <div class="order-contant-set">`;
                            if(booking_details.bookingDetails.reportStatus=="1"){
                                htmlText+=`<div class="alert">
                                                <img src="./asset/img/alert-red-1.png" alt=""/>
                                                <div class="warning-alert">
                                                    <strong>${booking_details.bookingDetails.reportReason}</strong>
                                                    <p class="report-aler">Reported on ${booking_details.bookingDetails.reportedDate}</p>
                                                </div>
                                                <p class="fill-cont">${booking_details.bookingDetails.reportDescription}</p>
                                            </div>`;
                            }
                        htmlText+=` <div class="cont-head-row">
                                        <div class="rows">
                                            <img class="img-at" src="asset/img/Screenshot (30).png" alt=""/>
                                            <div class="service-at">
                                                <p>Service at</p>
                                                <h3 class="bold-tex">${booking_details.bookingDetails.airportCategory}</h3>
                                            </div>
                                        </div>
                                        <div class="rows">
                                            <div class="arriving-input-set input-group">
                                                <span class="input-group-addon bg-date"></span>
                                                <div class="service-at">
                                                    <p>Service avail date</p>
                                                    <h3 class="bold-tex">${booking_details.bookingDetails.serviceDate}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rows">
                                            <div class="arriving-input-set input-group">
                                                <span class="input-group-addon bg-time"></span>
                                                <div class="service-at">
                                                    <p>Service avail Time</p>
                                                    <h3 class="bold-tex">${booking_details.bookingDetails.serviceTime}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rows">
                                            <img class="imge-h2" src="./asset/img/air.png" alt="" />
                                            <div class="service-at">
                                                <p>Flight Number</p>
                                                <h3 class="bold-tex">${booking_details.flightNumber}</h3>
                                            </div>
                                        </div>
                                    </div>
                                <div class="main-cont-set">`;
                                htmlText+=`<div class="passenger-details">`
                                var passengerdetails = booking_details.passengerDetails;
                                for (var key in passengerdetails){
                                    if(passengerdetails[key].passengerType=="Contact"){
                                        htmlText+=`<p class="p-titel-set">Passenger details</p>
                                            <div class="flex-set">
                                                <div class="set-cont">
                                                    <p>Contact Passenger Name</p>
                                                    <p class="name-pass">${passengerdetails[key].name}</p>
                                                    <input type="hidden" id="userpassengerToken" value="${passengerdetails[key].user_passengerToken}">
                                                </div>
                                                <div class="set-cont">
                                                    <p>Contact Number</p>
                                                    <p class="name-pass">${passengerdetails[key].countryCode+passengerdetails[key].mobileNumber}</p>
                                                </div>
                                                <div class="set-cont">
                                                    <p>Contact Email Address</p>
                                                    <p class="name-pass">${passengerdetails[key].emailId}</p>
                                                </div>
                                            </div>
                                        </div>`;
                                    }else if(passengerdetails[key].passengerType=="Others"){
                                        htmlText+=`<div class="passenger-details">
                                                        <p class="p-titel-set">Other Passenger Details</p>
                                                        <div class="flex-set">
                                                            <div class="set-cont">
                                                                <p>Person Name</p>
                                                                <p class="name-pass">${passengerdetails[key].name}</p>
                                                            </div>
                                                            <div class="set-cont">
                                                                <p>Contact Number</p>
                                                                <p class="name-pass">${passengerdetails[key].countryCode+passengerdetails[key].mobileNumber}</p>
                                                            </div>
                                                            <div class="set-cont">
                                                                <p>Email Address</p>
                                                                <p class="name-pass">${passengerdetails[key].emailId}</p>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    }else{
                                        htmlText+=`<div class="passenger-details">
                                                        <p class="p-titel-set">Greeter / Family Contact Details</p>
                                                        <div class="flex-set2">
                                                            <div class="set-cont">
                                                                <p>Contact Person Name</p>
                                                                <p class="name-pass">${passengerdetails[key].name}</p>
                                                            </div>
                                                            <div class="set-cont">
                                                                <p>Contact Number</p>
                                                                <p class="name-pass">${passengerdetails[key].countryCode+passengerdetails[key].mobileNumber}</p>
                                                            </div>
                                                            <div class="set-cont">
                                                                <p>Email Address</p>
                                                                <p class="name-pass">${passengerdetails[key].emailId}</p>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    }
                                }
                                htmlText+=`<div class="passenger-details">
                                    <p class="p-titel-set">Service details</p>
                                    <div class="flex-set2">
                                        <div class="set-cont">
                                            <p>Package</p>
                                            <p class="name-pass">${booking_details.bookingDetails.serviceName}</p>
                                        </div>
                                        <div class="set-cont">
                                            <p>Cost</p>
                                            <p class="name-pass">₹ ${booking_details.bookingDetails.amount}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="passenger-details">
                                    <p class="p-titel-set">GSTIN details</p>
                                    <div class="flex-set2">
                                        <div class="set-cont">
                                            <p>Company Name</p>
                                            <p class="name-pass">${booking_details.gstCompany}</p>
                                        </div>`;
                                        if(booking_details.gstinNumber!=''){
                                            htmlText+=` <div class="set-cont">
                                                            <p>GST Number</p>
                                                            <p class="name-pass">${booking_details.gstinNumber}</p>
                                                        </div>`;
                                        }
                                        htmlText+=`</div>
                                </div>`;
                                if(booking_details.eTicket!=""){
                                    htmlText+=`<p class="p-titel-set" onclick="load_eticket_new_tab('${booking_details.eTicket}')">E-Ticket</p><iframe src="${booking_details.eTicket}" alt="e-ticket" width="150" height="150"></iframe>`;
                                }
                                if(booking_details.orderDetail.notes!=""){
                                    htmlText+=` <div class="passenger-details mt-4">
                                                    <p class="p-titel-set">Notes</p>
                                                    <div class="notes-width">
                                                        <p class="last-cont-note">${booking_details.orderDetail.notes}</p>
                                                    </div>
                                                </div>`;
                                }
                                if(booking_details.bookingDetails.status=="Pending"){
                                    $('#hidenotes_modal').hide();
                                    htmlText+=`<div class="line"></div>
                                                <div class="button-groub">
                                                    <button class="accept" onclick="booking_status('accept','${booking_details.bookingDetails.token}')">Accept</button>
                                                    <button class="reject" onclick="booking_status('reject','${booking_details.bookingDetails.token}')">Reject</button>
                                                </div>`;
                                }else if(booking_details.bookingDetails.status=="Assign" || booking_details.bookingDetails.status=="Confirmed"){
                                    if(booking_details.bookingDetails.staffName==""){
                                                $('#assign_dropdown').show();
                                                $('#service_staus').hide();
                                    }else{
                                        $('#service_staus').show();
                                        htmlText+=` <div class="side-name-box">
                                                        <p>Assigned to</p>
                                                        <p class="name-pass" id="assignee_name">${booking_details.bookingDetails.staffName}</p>
                                                    </div></div>`;
                                                    if(booking_details.bookingDetails.trackWorkStatus =="0"){
                                                        htmlText+=`<button type="button" class="btn btn-success" onclick="complete_status('${booking_details.bookingDetails.token}')">Complete Service</button>`;
                                                    }
                                    }
                                    if(booking_details.bookingDetails.reviewStatus=="1"){
                                                    htmlText+=` <p class="p-titel-set">Review</p>
                                                                <div class="msg-box1">
                                                                <div class="msg-box-set">
                                                                <div class="reviw-msg-set">
                                                                <p>Review on service</p>`;
                                                                if(booking_details.bookingDetails.rating=="1"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="2"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="3"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="4"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else{
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>`;
                                                                }
                                                                htmlText+=`</div>
                                                                <p>${booking_details.bookingDetails.reviewDateTime}</p>
                                                                </div>
                                                                <p class="view-cont-msg">${booking_details.bookingDetails.review}</p>
                                                                </div>`;
                                    }
                                    if(booking_details.bookingDetails.serviceProviderNotes=="" && booking_details.bookingDetails.staffName!=""){
                                                    htmlText+=`<div class="order-contant-set" id="service_staus">
                                                                <button class="write-notes" data-toggle="modal" data-target="#exampleModalCenter" id="hidenotes_modal">Write notes</button>
                                                                </div>`;
                                                }else if(booking_details.bookingDetails.staffName!=""){
                                                    htmlText+=` <div class="order-contant-set" id="service_staus">
                                                                    <div class="your-not-set" id="shownotes_modal">
                                                                        <div>
                                                                            <p class="p-titel-set">Your Notes</p>
                                                                            <div class="icon-right-set">
                                                                                <img src="asset/edit.png" data-toggle="modal" data-target="#exampleModalCenter" onclick="updatednotes('${booking_details.bookingDetails.serviceProviderNotes}')">
                                                                                <img src="asset/delete.png" onclick="deletenotes()">
                                                                            </div>
                                                                        </div>
                                                                        <div class="left-con-laset-set">
                                                                            <p id="view_notes">${booking_details.bookingDetails.serviceProviderNotes}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>`;
                                                }
                                }else if(booking_details.bookingDetails.status=="Completed" || booking_details.bookingDetails.status=="Ongoing"){
                                    if(booking_details.bookingDetails.staffName==""){
                                                $('#assign_dropdown').show();
                                                $('#service_staus').hide();
                                    }else{
                                        $('#service_staus').show();
                                    }
                                    if(booking_details.bookingDetails.trackWorkStatus=="1"){
                                        var booking_service_status = booking_details.bookingDetails.trackWork;
                                        htmlText+=`<p class="p-titel-set">Service Status</p>
                                                    <div class="flex-staus-bar service-status-container">
                                                    <ul class="sidebar_status">`;
                                        for(var key in booking_service_status){
                                            htmlText+=`<li class="completed Reached-service-location">${booking_service_status[key].status}<br/>
                                                            <p>${booking_service_status[key].statustime}(GMT+1)</p>
                                                            <span class="completed_tick"></span>
                                                            <span class="active_pointer"></span>
                                                        </li>`;
                                        }
                                        htmlText+=`</ul>
                                                    <div class="set-cont side-name-box">
                                                        <p>Assigned to</p>
                                                        <p class="name-pass" id="assignee_name">${booking_details.bookingDetails.staffName}</p>
                                                    </div></div>`;
                                                    if(booking_details.bookingDetails.trackWorkStatus == "0"){
                                                        htmlText+=`<button type="button" class="btn btn-success" onclick="complete_status('${booking_details.bookingDetails.token}')">Complete Service</button></div>`;
                                                    }   
                                    }
                                    if(booking_details.bookingDetails.reviewStatus=="1"){
                                                    htmlText+=`<p class="p-titel-set">Review</p>
                                                                <div class="msg-box1">
                                                                <div class="msg-box-set">
                                                                <div class="reviw-msg-set">
                                                                <p>Review on service</p>`;
                                                                if(booking_details.bookingDetails.rating=="1"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="2"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="3"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else if(booking_details.bookingDetails.rating=="4"){
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star"></span>`;
                                                                }else{
                                                                    htmlText+=`<span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>
                                                                                <span class="fa fa-star checked"></span>`;
                                                                }
                                                                htmlText+=`</div>
                                                                <p>${booking_details.bookingDetails.reviewDateTime}</p>
                                                                </div>
                                                                <p class="view-cont-msg">${booking_details.bookingDetails.review}</p>
                                                                </div>`;
                                                }
                                    if(booking_details.bookingDetails.serviceProviderNotes==""){
                                                    htmlText+=` <div class="order-contant-set" id="service_staus">
                                                                    <button class="write-notes" data-toggle="modal" data-target="#exampleModalCenter" id="hidenotes_modal">Write notes</button>
                                                                </div>`;
                                                }else{
                                                    htmlText+=` <div class="order-contant-set" id="service_staus">
                                                                    <div class="your-not-set" id="shownotes_modal">
                                                                        <div>
                                                                            <p class="p-titel-set">Your Notes</p>
                                                                            <div class="icon-right-set">
                                                                                <img src="asset/edit.png" data-toggle="modal" data-target="#exampleModalCenter" onclick="updatednotes('${booking_details.bookingDetails.serviceProviderNotes}')">
                                                                                <img src="asset/delete.png" onclick="deletenotes()">
                                                                            </div>
                                                                        </div>
                                                                        <div class="left-con-laset-set">
                                                                            <p id="view_notes">${booking_details.bookingDetails.serviceProviderNotes}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>`;
                                                }
                                }
                                htmlText+=`</div>
                                </div>
                            </div>`;
            $('#order-detail-id').html(htmlText);
        }
    }

    function load_eticket_new_tab(url){
        window.open(url, "_blank");
    }

    function updatednotes(notelist){
        $('#update_notes').val(notelist);
    }

    function booking_status(data,bookingToken){
        if(data=="accept"){
            var datas = {
                "bookingOrderToken":bookingToken,
                "typeName":"",
                "approvedByToken":"",
                "bookingStatus":"Confirmed"
            }
            var Json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType:"json",
                url: `${apiPath}/provider/approveBookingOrder.php`,
                data: Json_data,
            });
            var bookstatus = "";
            bookstatus+=`<span class="accepted"><img src="asset/img/acp.png">Confirmed</span>`;
            $('.msg-rghit').html(bookstatus);
            $('#assign_dropdown').show();
            $('.button-groub').hide();
        }else{
            var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
            var datas = {
                "bookingOrderToken":bookingToken,
                "typeName":"",
                "bookingStatus":"Cancelled",
                "approvedByToken":staff_token
            }
            var Json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType:"json",
                url: `${apiPath}/provider/approveBookingOrder.php`,
                data: Json_data,
            });
            var bookstatus = "";
            bookstatus+=`<span class="rejected"><img src="asset/img/rej.png">Cancelled</span>`;
            bookstatus+=`<p class="cancel-info"><img src="asset/info.svg"> Cancelled By Service Provider</p>`;
            $('.msg-rghit').html(bookstatus);
            $('.button-groub').hide();
        }
        $('.msg-rghit').show();
    }

    function complete_status(booking__token){
        var datas = {
            "bookingDetailToken" : booking__token
        }
        var Json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: `${apiPath}/providerApp/completeWorkStatusUpdate.php`,
            data: Json_data
        }).then(()=>{
            booking_details(booking__token);
        });
    }

    function dashboard_completedstatus(booking__token){
        var datas = {
            "bookingDetailToken" : booking__token
        }
        var Json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: `${apiPath}/providerApp/completeWorkStatusUpdate.php`,
            data: Json_data
        }).then(()=>{
            location.reload();
        });
    }

    function add_assign(){
        var booking__token = localStorage.getItem('BookingsToken');
        var assigned_name = $('#assign_person').val();
        var selectedname = document.getElementById('assign_person');
        var assignvalue = selectedname.options[selectedname.selectedIndex].text;
        $("#assignee_name").html(assignvalue);
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        var userpassengerToken = $('#userpassengerToken').val();////firebase chat

        if(assigned_name!=""){
            var datas = {
                "bookingToken":booking__token,
                "assigneeToken":assigned_name,
                "assigneeByToken":staff_token
            }
            firebase.initializeApp(firebaseConfig);
            const db=firebase.firestore();

            db.collection("service").doc(booking__token).set({
                participants: [`user-${userpassengerToken}`, `provider-${assigned_name}`]
            }).then(() => {
                var Json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    url: `${apiPath}/provider/assignStaff.php`,
                    data: Json_data,
                }).then(()=>{
                    booking_details(booking__token);
                });
            });
            $('#order-detail-id').show();
            $('#service_staus').show();
            $('#assign_dropdown').hide();
        }else{
            swal("Please assign!");
        }
    }

    function add_notes(){
        var booking__token = localStorage.getItem('BookingsToken');
        var bookingnotes = $('#update_notes').val();
        if(bookingnotes!=""){
            var datas = {
                "bookingToken":booking__token,
                "notes":bookingnotes
            }
            var Json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType:"json",
                url: `${apiPath}/provider/updateServiceProviderNotes.php`,
                data: Json_data,
            }).then(()=>{
                booking_details(booking__token);
            });
            $('#exampleModalCenter').modal('hide');
            $('.met-the-client').addClass('completed');
            $('.guide-the-client').addClass('completed');
            $('.complete-service').addClass('completed');
            $('#view_notes').text(bookingnotes);
            $('#hidenotes_modal').hide();
            $('#shownotes_modal').show();
            
        }else{
            swal("Please add notes!");
        }
    }

    function deletenotes(){
        var booking__token = localStorage.getItem('BookingsToken');
        var bookingnotes = $('#update_notes').val();
        var datas = {
            "bookingToken":booking__token,
            "notes":''
        }
        var Json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType:"json",
            url: `${apiPath}/provider/updateServiceProviderNotes.php`,
            data: Json_data,
        }).then(()=>{
            booking_details(booking__token);
            $('#update_notes').val('');
        });
        
        // $('#view_notes').val('');
        $('#shownotes_modal').hide();
        $('#hidenotes_modal').show();
    }

    $(function () {
        $("#ser_date").datetimepicker({
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        $("#arrive_time").datetimepicker({
            ignoreReadonly: true,
            format: "LT",
        });
    });

    function confirmBooking(booking_token){
        swal({
            title: "Are you sure?",
            text: "You want to confirm the service",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datas = {
                    bookingOrderToken:booking_token,
                    bookingStatus:"Confirmed",
                    typeName:"",
                    approvedByToken:"",
                }
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url :  `${apiPath}/provider/approveBookingOrder.php`,
                    data: json_data,
                }).done(function(data){
                    swal("Service Confirmed!", {icon: "success",}).then((value) => {
                        location.reload();
                    });
                });
            }
        });
    }

    function cancellationBooking(booking_token){
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        swal({
            title: "Are you sure?",
            text: "You want cancel the service",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datas = {
                    bookingOrderToken:booking_token,
                    bookingStatus:"Cancelled",
                    typeName:"",
                    approvedByToken:staff_token
                }
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url :  `${apiPath}/provider/approveBookingOrder.php`,
                    data: json_data,
                }).done(function(data){
                    swal("Service Cancelled!", {icon: "success",}).then((value) => {
                        location.reload();
                    });
                });
            }
        });
    }

    function service_provider_list(){
        table.clear();
        table.destroy();
        data_fetch();

        table1.clear();
        table1.destroy();
        fetch_data();
    }
        
    function unusedServices(booking_token){
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        swal({
            title: "Are you sure?",
            text: "You want cancel the service",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datas = {
                    "bookingOrderToken":booking_token
                }
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/provider/noShowBookingOrder.php`,
                    data: json_data,
                }).done(function(data){
                    if(data.status_code == 200){
                        swal("No Show Successfully!", {icon: "success",}).then((value) => {
                        location.reload();
                         }); 
                    }else{
                        swal("No Show not updated")
                    }
                });
            }
        });
    } 
       
    function cancelService(bookingServicetoken,bookingToken){
        $("#booking_token").val(bookingToken);
        $("#bookingService_token").val(bookingServicetoken);
    }

    function cancelServiceBooking(){
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        var bookingToken = $("#booking_token").val();
        var bookingServiceToken = $("#bookingService_token").val();
        var cancelType = $("input[name='cancel_charges']:checked").val();
        $('#booking_cancellation').modal('hide');
        if(cancelType == '1'){
            var inputData = {
                booking_token: bookingToken,
                order_detail_token: bookingServiceToken,
                staff_token: staff_token
            };
           
            inputData = JSON.stringify(inputData);
            $.ajax({
                url: `${apiPath}/provider/cancelServiceBooking.php`,
                data: inputData,
                type: "POST",
                dataType: "JSON",
                success: function (response){
                     if (response.status_code == 200) {
                        swal("Service Cancelled!", {icon: "success",}).then((value) => {
                        location.reload(); });
                        } else {
                            swal(response.message);
                        }
                 }
            }); 
        }else{
            var datas = {
                    bookingOrderToken:bookingServiceToken,
                    bookingStatus:"Cancelled",
                    typeName:"",
                    approvedByToken:staff_token
                }
            var json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType: "json",
                url :  `${apiPath}/provider/approveBookingOrder.php`,
                data: json_data,
            }).done(function(data){
                swal("Service Cancelled!", {icon: "success",}).then((value) => {
                    location.reload();
                });
            });
        }
    }
    </script>
    </body>
</html>
<?php
}
?>