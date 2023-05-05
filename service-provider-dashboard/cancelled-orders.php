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
        <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png" />

        <!-- datepicker style -->
        <link rel="stylesheet" href="./css/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/bootstrap-icons.css" />
        <link rel="stylesheet" href="./css/bootstrap-datetimepicker.css" />
        <!-- data table link -->
        <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
        <!--  data table CSS only -->
        <link rel="stylesheet" href="./js/data-table-css/bootstrap.css" />
        <!-- custm css -->
        <link rel="stylesheet" href="./css/commen.css?v=<?php echo $cur_date_time; ?>" />
        <!-- fonts famaly -->
        <link rel="stylesheet" href="./css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="./css/fonts.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="./css/cancelled-orders.css?v=<?php echo $cur_date_time; ?>" />
    </head>
    <body id="page">
     <div id="loading"></div>
        <header id="header"></header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar"></div>
                <div class="slider-desc-set">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">New Cancelled Orders</li>
                        <li class="tab-link" data-tab="tab-2">Cancelled Order History</li>
                    </ul>
                    <div class="underline"></div>
                    <div id="tab-1" class="tab-content current">
                        <h1 class="booking-text">Cancelled Orders</h1>
                        <table id="cancelledorder_Table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Booking ID</th>
                                    <th>Booked on</th>
                                    <th>Cancelled on</th>
                                    <th>Cancelled By</th>
                                    <th>Service avail on</th>
                                    <th>package</th>
                                    <th>Service Cost</th>
                                    <th>Cancelled before</th>
                                    <th>Cancellation Fee</th>
                                    <th>Payment Status</th>
                                    <th>Refund Amount</th>
                                    <th>Refund Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="tab-2" class="tab-content">
                        <div class="three-box-set">
                            <div class="box-1">
                                <div class="cont-set">
                                    <img src="./asset/img/ongoing.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="cancelled_orders_count"></h3>
                                    <p class="card-cont">Cancelled Orders</p>
                                </div>
                            </div>
                            <div class="box-2">
                                <div class="cont-set">
                                    <img src="./asset/img/onassin-book.png" alt="" class="inner-img" />
                                    <h3 class="card-number" id="lost_revenue_count"></h3>
                                    <p class="card-cont">Cancelled Revenue</p>
                                </div>
                            </div>
                        </div>
                        <div class="date-con-set">
                            <h1 class="booking2-text">Cancelled Orders</h1>
                            <div style="display:flex;gap:12px;">
                                <div class="arriving-input-set input-group" id="arrive_date1">
                                    <span class="input-group-addon bg-date"> </span>
                                    <div class="date-con">
                                        <label for="bookingcancel_fromdate">From Date</label><br />
                                        <input type="text" class="b-input datepicker" id="bookingcancel_fromdate" placeholder="DD-MM-YYYY" readonly />
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="ser_date_books">
                                        <span class="input-group-addon bg-date"></span>
                                        <div class="date-con">
                                            <label for="bookingcancel_todate">To Date</label><br/>
                                            <input type="text" class="b-input-book datepicker" id="bookingcancel_todate" placeholder="DD-MM-YYYY" readonly />
                                        </div>
                                </div>
                                <button type="button" class="cust-btn cust-btn-primary" onclick="date_filter()">Generate</button>
                            </div>
                        </div>
                        <table id="cancelledorderhistory_Table" class="" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Booking ID</th>
                                    <th>Booked on</th>
                                    <th>Cancelled on</th>
                                    <th>Cancelled By</th>
                                    <th>Service avail on</th>
                                    <th>package</th>
                                    <th>Service Cost</th>
                                    <th>Cancelled before</th>
                                    <th>Cancelled Fee</th>
                                    <th>Payment Status</th>
                                    <th>Refund Amount</th>
                                    <th>Refund Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        
        <div class="modal" id="refundmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="border:none;">
                        <h4 class="modal-title">Initiate Refund</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="input_box" style="width: 80%;margin:0 auto;">
                        <label class="form__label" for="refundreference">Refund Reference Id</label>
                        <input type="text" id="refundreference" placeholder="Reference id">
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" style="border:none;"> 
                        <button type="button" class="cust-btn-primary cancelbtn" id="updaterefund" data-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- date picker -->
        <script src="js/moment-with-locales.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <!-- data table js -->
        <script src="js/data-table-js/jquery.dataTables.min.js"></script>
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
        <script>
            $("#bookingcancel_fromdate").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
                maxDate: new Date()
            });
            $("#bookingcancel_todate").datetimepicker({
                date: new Date(),
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
                maxDate: new Date()
            });
            

        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            $("#cancelled-orders").addClass("actives");
            var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
            serviceprovider_sidemenu(staff_token);
        });

        fetch_data();
        var table1;
        function fetch_data(){
            var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            if(service_provider_companylocation_token == null){
                var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
            }else{
                var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            }
            table1 = $("#cancelledorder_Table").DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':apiPath+"/provider/newCancelledBookingList.php?serviceProviderLocationtoken="+companylocation_token,
                    'dataSrc': function(data) {
                        return data.aaData;
                    }
                },
                "order": [[0, "DESC" ]],
                'columns': [
                    { data: 'token' },
                    { data: 'bookingNumber' },
                    { data: 'dateTime' },
                    { data: 'cancelledDate' },
                    { data: 'cancelledBy'},
                    { data: 'serviceDateTime' },
                    { data: 'serviceName' },
                    { data: 'netAmount' },
                    { data: 'cancellation_hours' },
                    { data: 'cancellation_fee' },
                    { data: 'refundStatus' },
                    { data: 'refundedAmount' },
                    { data: 'refundedDate' },
                    { data: 'refundAction' }
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
            $('#cancelledorder_Table_wrapper').find('input[type=search]').val('');
            $('#cancelledorder_Table_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
        }

       data_fetch();
       var table;
       function data_fetch(){
            var from_date = $("#bookingcancel_fromdate").val();
            var to_date   = $("#bookingcancel_todate").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);
            if(d1>d2){
                $("#bookingcancel_todate").val(from_date);
            }
            var to_date   = $("#bookingcancel_todate").val();
           var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
           if(service_provider_companylocation_token == null){
               var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
           }else{
               var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
           }
           table = $("#cancelledorderhistory_Table").DataTable({
               'stateSave': true,
               'processing': true,
               'serverSide': true,
               'serverMethod': 'post',
               'ajax': {
                   'url':apiPath+"/provider/cancelledBookingHistory.php?serviceProviderLocationtoken="+companylocation_token+"&&from_date="+from_date+"&&to_date="+to_date,
                   'dataSrc': function(data) {
                       if(data.totalCount==''){
                           $('#cancelled_orders_count').html('0');
                       }else{
                           $('#cancelled_orders_count').html(data.totalCount);
                       }if(data.lostRevenue=='' || data.lostRevenue==null){
                           $('#lost_revenue_count').html('0');
                       }else{
                           $('#lost_revenue_count').html(data.lostRevenue);
                       }
                       return data.aaData;
                   }
               },
               "order": [[0, "DESC" ]],
               'columns': [
                   { data: 'token' },
                   { data: 'bookingNumber' },
                   { data: 'dateTime' },
                   { data: 'cancelledDate' },
                   { data: 'cancelledBy'},
                   { data: 'serviceDateTime' },
                   { data: 'serviceName' },
                   { data: 'netAmount' },
                   { data: 'cancellation_hours' },
                   { data: 'cancellation_fee' },
                   { data: 'refundStatus' },
                   { data: 'refundedAmount' },
                   { data: 'refundedDate' },
                   { data: 'refundAction' }
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
           $('#cancelledorderhistory_Table_wrapper').find('input[type=search]').val('');
           $('#cancelledorderhistory_Table_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
       }
        
    function date_filter(){
        var from_date = $("#bookingcancel_fromdate").val();
        var to_date   = $("#bookingcancel_todate").val();
        var d1 = Date.parse(from_date);
        var d2 = Date.parse(to_date);
        if(d1>d2){
            $("#bookingcancel_todate").val(from_date);
        }
        var to_date   = $("#bookingcancel_todate").val();
        if(from_date!="" && to_date!="" && from_date!=undefined && to_date!=undefined){
            table.clear();
            table.destroy();
            data_fetch();
        }
    }

    function service_provider_list(){
        table.clear();
        table.destroy();
        data_fetch();

        table1.clear();
        table1.destroy();
        fetch_data();
    }
        
    $('#cancelledorder_Table tbody').on( 'click', '.refundBtn', function(){
        $('#refundreference').val('');
        var td_div = $(this).parent();
        var table_data = table1.row( td_div ).data();
        token = table_data.token;
        console.log(token);
        $('#updaterefund').attr('data-token',token);
    });

    $('#cancelledorderhistory_Table tbody').on( 'click', '.refundBtn', function(){
        $('#refundreference').val('');
        var td_div = $(this).parent();
        var table_data = table.row( td_div ).data();
        token = table_data.token;
        console.log(token);
        $('#updaterefund').attr('data-token',token);
    });

    $('body').on('click','#updaterefund',function(){
        let bookingServiceToken = $(this).attr('data-token');
        let refundId = $('#refundreference').val();
        if(refundId == ''){
            swal('Enter Valid Reference ID')
        }else{
            refundUpdate(bookingServiceToken,refundId);
        }
    });

    function refundUpdate(bookingServiceToken,refundId){
        let datas = {
                        "bookingServiceToken":bookingServiceToken,
                        "refundId":refundId
                    }
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/provider/providerRefundInitiate.php",
            data: json1
        }).done(function(data1){
            if(data1.status_code == 201){
                location.reload();
            }else{
                swal(data1.message);
            }
        });
    }
        </script>
    </body>
</html>
<?php
}
?>