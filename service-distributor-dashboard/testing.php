<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>booking</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- data table link -->
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    <!--  data table CSS only -->
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/bootstrap.css">
    <!-- custm css -->
    <link rel="stylesheet" href="./css/header-sidemenu.css" />
    <link rel="stylesheet" href="./css/booklist.css" />
    <link rel="stylesheet" href="./css/custom.css">
    <!-- fonts famaly -->
    <link rel="stylesheet" href="./css/fonts.css">
    <!-- datepicker style -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>
</head>
<style>
    .upcoming{
        cursor: pointer;
    }    
    </style>
<body id="page">
    <div id="loading"></div>
    <!-- page loader -->
 
    <header id="header">
    </header>
    <main>
<!--        <div class="flex-main-set">

            <div class="slider-set" id="sidebar">
            </div>
-->
            <div class="slider-desc-set">
<!--
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">Website
                        Bookings</li>
                    <li class="tab-link" data-tab="tab-2">Agent Bookings</li>
                </ul>
                <div class="underline"></div>
-->
                <div id="tab-1" class="tab-content current">
<!--
                    <div class="three-box-set">
                        <div class="box-1">
                            <div class="cont-set">
                                <img src="./asset/img/ongoing.png" alt="" class="inner-img">
                                <h3 class="card-number">4</h3>
                                <p class="card-cont">Ongoing bookings</p>
                            </div>
                        </div>
                        <div class="box-3">
                            <div class="cont-set">
                                <img src="./asset/img/upcoming.png" alt="" class="inner-img">
                                <h3 class="card-number">2</h3>
                                <p class="card-cont">Upcoming bookings</p>
                            </div>
                        </div>
                        <div class="box-2">
                            <div class="cont-set">
                                <img src="./asset/img/acsspt.png" alt="" class="inner-img">
                                <h3 class="card-number">348</h3>
                                <p class="card-cont">unassigned booking</p>
                            </div>
                        </div>
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/img/rejact.png" alt="" class="inner-img">
                                <h3 class="card-number">14</h3>
                                <p class="card-cont">unassigned booking</p>
                            </div>
                        </div>
                    </div>
-->
                    <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>
                        </div>
                    </div>
                    <table id="booking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Booked on</th>
                                <th>Customer Name</th>
                                <th>Contact Number</th>
                                <th>service avail on</th>
                                <th>package</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_id">
                        </tbody>
                    </table>
                </div>
<!--
                <div id="tab-2" class="tab-content">
                    <h1 class="booking2-text">Bookings</h1>
                    <table id="booking2" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Booked on</th>
                                <th>Customer Name</th>
                                <th>Contact Number</th>
                                <th>service avail on</th>
                                <th>package</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
-->
            </div>
<!--        </div>-->
    </main>
    <!-- jquery -->
    <!-- <script src="./js/jquery-3.6.0.js"></script> -->
    <script src='./js/jquery.min.js'></script>
    <!-- data table js -->

    <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

    <!-- data table custm js -->
    <script src="./js/table.js"></script>
    <!-- JavaScript Bundle with Popper boostrap -->
    <script src="./js/data-table-js/dataTables.bootstrap4.min.js"></script>
    <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script>
    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js"></script>
    <!-- date picker -->
    <script src='./js/moment-with-locales.js'></script>
    <script src='./js/bootstrap-datetimepicker.js'></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    $(document).ready(() => {
        $('#booking_order').addClass('actives');

    });
    </script>
    <script>
    $(function() {
        $('#arrive_date').datetimepicker({
            ignoreReadonly: true,
            format: 'DD-MM-YYYY'
        });
    });
    </script>

    <script>
    $(document).ready(function() {
         var datas = {
                distributor_token:"2736548475",
                get_date:"2022-08-05"
            }
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : "https://airportzo.net.in/service-distributor-dashboard/API/Version1.0/service-distributor/booking_details.php",
            data: json_data,
            success: success,
        });
    });
    var table; 
    function success(data){
                var table_main_data = data.data;
                var html_text = "";
                for (var key in table_main_data) {
                html_text += '<tr>';
                    html_text += '<td class="td-bule"><a href="#">'+table_main_data[key].order_id+'</a></td>';
                    html_text += '<td>'+table_main_data[key].bookedOn+'<br/></td>';
                    html_text += '<td>'+table_main_data[key].name+'<br/><small></small></td>';
                    html_text += '<td>'+table_main_data[key].mobile_number+'</td>';
                    if(table_main_data[key].service_date_time == "0000-00-00 00:00:00"){
                        html_text += '<td>-<br/></td>';
                    }else{
                        html_text += '<td>'+table_main_data[key].service_date_time+'<br/></td>';
                    }
                    html_text += '<td><span>'+table_main_data[key].service_name+'</span></td>';
                    html_text += '<td><span class="upcoming"><img src="./asset/img/up.png">'+table_main_data[key].status+'</span></td>';
                    if(table_main_data[key].status == "Pending"){
                        html_text += '<td><span class="upcoming" onclick="confirmBooking('+table_main_data[key].booking_token+')">Confirm</span></br><span class="upcoming" onclick="cancellationBooking('+table_main_data[key].booking_token+')">Cancelled</span></td>';    
                    }else{
                        html_text += '<td><span class="upcoming">-</span></td>';    
                    }
                    
                html_text += '</tr>';              
        }
                $("#table_body_id").html(html_text);
                table = $("#booking").DataTable({
                    language: {
                search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                searchPlaceholder: "Search...",
            },
                    'dom': 'Bfrtip',
                    buttons: [
           {
               extend: 'collection',
               text: 'Download as',
               autoClose: true,
               buttons: [
                           { text: 'Copy', extend: 'copyHtml5'},
                           { text: 'Excel', extend: 'excelHtml5'},
                           { text: 'CSV', extend: 'csvHtml5'},
                           { text: 'PDF', extend: 'pdfHtml5'},
                           { text: 'Print', extend: 'print' }

                        ],
                    fade: true,
           }
        ],
            columnDefs: [{
                type: "unknownType",
                targets: [3]
            }], 
                });
    }
          
    function confirmBooking(booking_token){
         var datas = {
                booking_token:booking_token,
                status:"Ongoing"
            }
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : "https://airportzo.net.in/service-distributor-dashboard/API/Version1.0/service-distributor/update_booking_detail.php",
            data: json_data,
        }).done(function(data){
             swal("Booking Confirmed!", {icon: "success",}).then((value) => {
                            location.reload();
                        });
        }); 
        
    }
    function cancellationBooking(booking_token){
         var datas = {
            booking_token:booking_token,
            status:"Cancelled"
        }
        var json_data = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url : "https://airportzo.net.in/service-distributor-dashboard/API/Version1.0/service-distributor/update_booking_detail.php",
            data: json_data,
        }).done(function(data){
             swal("Booking Cancelled!", {icon: "success",}).then((value) => {
                            location.reload();
                        });
        }); 
    }
    </script>
</body>

</html>