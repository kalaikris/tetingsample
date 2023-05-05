<?php
include_once '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cancelled Order</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- datepicker style -->
    <link rel="stylesheet" href="./css/bootstrap.min.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>

    <!-- data table link -->
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <!--  data table CSS only -->
    <link rel="stylesheet" href="./js/data-table-css/bootstrap.css">
    <!-- custm css -->
    <link rel="stylesheet" href="./css/fonts.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/booklist.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>">
    <!-- fonts famaly -->
    
</head>
<style>
    .upcoming{
        cursor: pointer;
    }    
    .slider-desc-set .current .dt-buttons{
        float: right;
    }
    .slider-desc-set .current .dt-buttons .dt-button{
        padding: 1em 1.5em;
        border-radius: 5px;
        background-color:#4fc8e0;
        background-image: unset;
        border:1px solid #4fc8e0;
        color: #fff;
    }
    #arrive_date{
        height: unset;
        border:none;
        justify-content: flex-end;
    }
    .dt-buttons{
        display: none;
    }
    .text-time
    {
      display: block;
      color: #969696;
    }
    
        .detail-set{
        width: 100%;
        overflow-x: auto;
        background: #f9fafc;
        font-family: var(--font-regular);
        padding: 0px 30px;
        margin-right: auto;
        margin-left: auto;
        }
        .flex_detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        }
        .inlinetext{
        display: flex;
        align-items: center;
        }

        .inlinetext p{
        padding-right: 40px;
        color: #333;
        }
        .title_text{
        margin-bottom: 20px;
        }
        .bottom_text{
        background: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 7px;
        box-shadow: 1px 2px 10px #f2f2f2;
        margin-bottom: 20px;
        }
        .campaign_top_section {
        display: flex;
        width: 100%;
        padding: 0 30px;
        }
        .campaign_top_content_section {
        width: 100%;
        align-self: flex-end;
        }
        .details-top-section {
        /* margin-top: 30px; */
        display: flex;
        width: 100%;
        }
        .details-top-section1 {
        margin-top: 30px;
        display: flex;
        width: 100%;
        padding-bottom: 26px;
        }
        .details-top-div {
        display: block;
        width: 100%; 
        font-family: var(--medium-font);
        margin: 20px 0;
        margin-right: 10px;
        }
        .Business-cnt-text h1{
        color: #000;
        font-size: 22px;
        line-height: 32px;
        }
        .top_p_color {
        color: #6C7A86;
        font: 14px/20px var(--bold-font);
        }
        .details-top-div h5{
        font-size: 18px;
        color: #333;
        }
        .price_tag{
        border: 1px solid #ccc;
        padding: 20px;
        width: 400px;
        display: inline-block;
        }
        .document-view{
        position: relative;
        }
        .dock-set{
        width: 200px;
        height: auto;
        }
        .document-file{
        object-fit: contain;
        object-position: left;
        width: 100%;
        height: 200px;
        }
        .price_tag{
        border: 2px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        width: 400px;
        display: block;
        margin-left: auto;
        }
        .price_tag h4{
        font-size: 18px;
        }
        .split_price{
        display: flex;
        justify-content: space-between;
        align-items: center;
        } 
        .total_price{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #ccc;
        }
        .tab_section{
        margin: 20px auto;
        position: relative;
        border-bottom: 1px solid #ccc;
        }
        .viewpage{
        display: block !important;
        background: #fff !important;
        }
        .nav-tabs {
        border-bottom: 2px solid #ccc;
        }
        .nav-tabs .nav-item {
        margin-bottom: 0;
        border: none !important;
        }
        .nav-link{
        color: #8E8F91;
        width: 150px;
        text-align: center;
        } 
        .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
        border: none;
        text-decoration: none;
        outline: none;
        }
        .nav-tabs .nav-link {
        border: none;
        }
        .nav-tabs .nav-link.active, 
        .nav-tabs .nav-item.show .nav-link {
        color: #000;
        border: none;
        border-bottom: 2px solid #03a9f4;
        }
        .head_airport > .detail_airport .airport_company { 
         max-height: 82px;
         max-width: 150px;
        }
        .detail_airport{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        width: 100%;
        }
        .set_airport{
        display: block;
        }
        .detailsstatus span{
        margin-left: auto;
        margin-bottom: 5px;
        }
        .detailsstatus p{
        text-align: right;
        }
        .flexline{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px auto;
        width: 100%;
        }
        .airport_start {
        width: 40px;
        height: 40px;
        object-fit: contain;
        }
        .service_details{
        width: 70%;
        position: relative;
        margin: 0;
        }
    #booking_detail{
        display: none;
    }
    .back_btn img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }
    </style>
<body id="page">
    <div id="loading"></div>
    <!-- page loader -->
 
    <header id="header">
    </header>
    <main>
       <div class="flex-main-set">

            <div class="slider-set" id="sidebar"> </div>
            <div class="slider-desc-set"  id="booking_view">

                <ul class="tabs">
                    <li class="tab-link websitetab current" data-tab="tab-1">Website
                        Bookings</li>
                    <li class="tab-link agenttab" data-tab="tab-2">Agent Bookings</li>
                </ul>
                <div class="underline"></div>

                <div id="tab-1" class="tab-content current">

                    <div class="three-box-set">
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/img/rejact.png" alt="" class="inner-img">
                                <h3 class="card-number cancelledcount">14</h3>
                                <p class="card-cont">Cancelled booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>

                            <div style="display: flex; gap:10px;">
                            <div class="inner-input-field">
                                <div class="inner-input-field">
                                    <div class="dropdown">
                                        <button onclick="myFunction('myDropdown')" class="dropbtn">Download</button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="#" onclick="drpDownbtnClick('booking','csv')">CSV</a>
                                            <a href="#" onclick="drpDownbtnClick('booking','pdf')">PDF</a>
                                            <!-- <a href="#contact">Contact</a> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                                <div class="inner-input-field">
                                  <div class="arriving-input-set input-group">
                                     <span class="input-group-addon bg-date"></span>
                                     <div class="date-con">
                                        <label for="from_date">From Date</label>
                                        <input type="text" class="b-input datepicker" id="from_date" placeholder="DD-MM-YYYY" readonly />
                                     </div>
                                  </div>
                               </div>
                               <div class="inner-input-field">
                                  <div class="arriving-input-set input-group">
                                     <span class="input-group-addon bg-date"></span>
                                     <div class="date-con">
                                        <label for="to_date">To Date</label>
                                        <input type="text" class="b-input datepicker" id="to_date" placeholder="DD-MM-YYYY" readonly />
                                     </div>
                                  </div>
                               </div>
                               <button type="button" class="btn btn-success" onclick="date_filter()">Generate</button>
                            </div>
                        </div>
                    </div>
                    <table id="booking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
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
                            </tr>
                        </thead>
                        <tbody id="table_body_id">
                        </tbody>
                    </table>
                </div>

                <div id="tab-2" class="tab-content">
                    <div class="three-box-set">
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/img/rejact.png" alt="" class="inner-img">
                                <h3 class="card-number agentcancelledcount">14</h3>
                                <p class="card-cont">Cancelled booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>

                        <div style="display: flex; gap:10px;">
                        <div class="inner-input-field">

                            <div class="inner-input-field">
                                <div class="dropdown">
                                <button onclick="myFunction('myDropdown2')" class="dropbtn">Download</button>
                                <div id="myDropdown2" class="dropdown-content">
                                    <a href="#" onclick="drpDownbtnClick('agentbooking','csv')">CSV</a>
                                    <a href="#" onclick="drpDownbtnClick('agentbooking','pdf')">PDF</a>
                                    <!-- <a href="#contact">Contact</a> -->
                                </div>
                                </div>
                            </div>

                        </div>
                            <div class="inner-input-field">
                              <div class="arriving-input-set input-group">
                                 <span class="input-group-addon bg-date"></span>
                                 <div class="date-con">
                                    <label for="from_date2">From Date</label>
                                    <input type="text" class="b-input datepicker" id="from_date2" placeholder="DD-MM-YYYY" readonly />
                                 </div>
                              </div>
                            </div>
                            <div class="inner-input-field">
                              <div class="arriving-input-set input-group">
                                 <span class="input-group-addon bg-date"></span>
                                 <div class="date-con">
                                    <label for="to_date2">To Date</label>
                                    <input type="text" class="b-input datepicker" id="to_date2" placeholder="DD-MM-YYYY" readonly />
                                 </div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-success" onclick="agent_date_filter()">Generate</button>
                            </div>
                        </div>
                    </div>
                    <table id="agentbooking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
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
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
       </div> 
        
    </main>
    <!-- jquery -->
    <!-- <script src="./js/jquery-3.6.0.js"></script> -->
    <script src='./js/jquery.min.js'></script>
    <script src="./js/bootstrap.min.js"></script>

    <!-- data table js -->
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

        <!-- data table custm js -->
    
        <!-- JavaScript Bundle with Popper boostrap -->
    <!-- <script src="./js/data-table-js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script>-->
    <!-- sidebar-heder -->

    <!-- date picker -->
    <script src='./js/moment-with-locales.js'></script>
    <script src='./js/bootstrap-datetimepicker.js'></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/table.js"></script>
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
    <script>

        $(document).ready(() => {
            $('#cancelled_order').addClass('actives');
        });

        function myFunction(id) {
          document.getElementById(id).classList.toggle("show");
        }

        //dropdown pdf,csv file download
        function drpDownbtnClick (tableid,file){
            if(file == 'pdf'){
                $(`#${tableid}_wrapper`).find('.dt-button.buttons-pdf.buttons-html5').click();
            }
            if(file == 'csv'){
                $(`#${tableid}_wrapper`).find('.dt-button.buttons-csv.buttons-html5').click();
            }

        }
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        
        $("#from_date,#from_date2").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });
        $("#to_date,#to_date2").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });

        var table;
        var agenttable;
        let apiPath = "<?php echo $apiPath;?>";
    
        $(document).ready(function() { 
            if(isAgent == 1){
               fetch_data();
               fetch_agentdata();
                $('.tabs').removeClass('hidden');
            }else{
                $('.tabs').addClass('hidden');
                fetch_data();
            }
        });
        
        function fetch_data(){
            var from_date = $("#from_date").val();
            var to_date   = $("#to_date").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);

            if(d1>d2){
                $("#to_date").val(from_date);
            }
            var to_date   = $("#to_date").val();
            from_date = formatDate(from_date);
            to_date = formatDate(to_date);
            var datas = {
                "userToken":userToken,
                "fromDate":from_date,
                "toDate":to_date
            }   
            var json_data = JSON.stringify(datas);
            $.ajax({
                async: false,
                type: "POST",
                dataType: "json",
                url : `${apiPath}/distributor/cancelledBookingHistory.php`,
                data: json_data,
                success: success,
                error:errorcheck,
            });
        }
        
        function errorcheck(e,r,j){
        }

        function agent_date_filter(){
            fetch_agentdata();
        }
        function fetch_agentdata(){
            var from_date = $("#from_date2").val();
            var to_date   = $("#to_date2").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);
            if(d1>d2){
                $("#to_date2").val(from_date);
            }
            var to_date   = $("#to_date2").val();
                from_date = formatDate(from_date);
                to_date = formatDate(to_date);
            
            let datas = {
                            "userToken":userToken,
                            "fromDate":from_date,
                            "toDate":to_date
                        };
            let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/agentcancelledBookingHistory.php",
                    data: json1
                    }).done(function(data1) {
                        let agentTableArray = data1.data;
                        let agent_statusCancelledCount = 0;
                        
                        let agentbookingDetails = '';
                        agentTableArray.forEach((agentbookings,index) => {

                            if(agentbookings.status == 'Cancelled'){
                                agent_statusCancelledCount += 1;
                            }
                            agentbookingDetails += `<tr> <td>${index+1}</td>
                                                    <td>${agentbookings.token}</td>
                                                    <td>${agentbookings.bookingNumber}</td>
                                                    <td>${agentbookings.dateTime}</td>
                                                    <td>${agentbookings.cancelledDate}</td>
                                                    <td>${agentbookings.cancelledBy}</td>
                                                    <td>${agentbookings.serviceDateTime}</td>
                                                    <td>${agentbookings.serviceName}</td>
                                                    <td>${agentbookings.netAmount}</td>
                                                    <td>${agentbookings.cancellation_hours}</td>
                                                    <td>${agentbookings.cancellation_fee}</td>
                                                    <td>${agentbookings.refundStatus}</td>
                                                    <td>${agentbookings.refundedAmount}</td>
                                                    <td>${agentbookings.refundedDate}</td>
                                                </tr>`;
                        });
                        $('#agentbooking tbody').html(agentbookingDetails);
                        $('#agentbooking').DataTable().destroy();
                        $('#agentbooking tbody').html(agentbookingDetails);
                        $('.agentcancelledcount').text(agent_statusCancelledCount);
                        $('#agentbooking').DataTable({
                                language: {
                                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                                    searchPlaceholder: "Search...",
                                },
                                dom: '<Bfr<"table-container"t>ip>',
                                scrollX: "100%",
                                order: [[1, 'desc']],
                                buttons: [
                                                {
                                                extend: "pdf",
                                                footer: true,
                                                title: "Agent Booking Details",
                                                orientation: 'landscape'
                                                },
                                                {
                                                extend: "csv",
                                                footer: true,
                                                title: "Agent Booking Details",
                                                orientation: 'landscape'
                                                },
                                        ],
                                        order: [],
                                columnDefs: [{
                                    type: "unknownType",
                                    targets: [3],
                                },],
                        }).columns.adjust().draw();
                    });    
        }

        //DB date Format
        function formatDate(date) {
            var d = new Date(date);
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
                year = Math.abs(year)

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;
            return [year, month, day].join('-');

            // var monthArr = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
            // var dateArr = date.split("-");

            // var month = dateArr[1];
            // var monthView = (monthArr.indexOf(month) + 1).toString();
            // if (monthView.length < 2)  monthView = '0' + monthView;
            // return [dateArr[2], monthView, dateArr[0]].join("-");
        }
        
        function date_filter(){
            var from_date = $("#from_date").val();
            var to_date   = $("#to_date").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);
            if(d1>d2){
                $("#to_date").val(from_date);
            }
            var to_date   = $("#to_date").val();
            from_date = formatDate(from_date);
            to_date = formatDate(to_date);
            
            if(from_date!="" && to_date!="" && from_date!=undefined && to_date!=undefined){
                 var datas = {
                                "userToken":userToken,
                                "fromDate":from_date,
                                "toDate":to_date
                            };
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/cancelledBookingHistory.php`,
                    data: json_data,
                    success: successClear,
                });
            }
             
        }
        
        function successClear(data){
            if (table instanceof $.fn.dataTable.Api) {
                table.clear();
                table.destroy();
            }
            success(data);
        }    
            
        function success(data) {
            //status Count
            let statusCancelledCount = 0;
            var table_main_data = data.data;

            var html_text = "";

            table_main_data.forEach((bookingDetails,index) => {

                if(bookingDetails.status == 'Cancelled'){
                    statusCancelledCount += 1;
                }

                html_text += `<tr> <td>${index+1}</td>
                                <td>${bookingDetails.token}</td>
                                <td>${bookingDetails.bookingNumber}</td>
                                <td>${bookingDetails.dateTime}</td>
                                <td>${bookingDetails.cancelledDate}</td>
                                <td>${bookingDetails.cancelledBy}</td>
                                <td>${bookingDetails.serviceDateTime}</td>
                                <td>${bookingDetails.serviceName}</td>
                                <td>${bookingDetails.netAmount}</td>
                                <td>${bookingDetails.cancellation_hours}</td>
                                <td>${bookingDetails.cancellation_fee}</td>
                                <td>${bookingDetails.refundStatus}</td>
                                <td>${bookingDetails.refundedAmount}</td>
                                <td>${bookingDetails.refundedDate}</td>
                            </tr>`;
                
            });


            $("#table_body_id").html(html_text);
            $('.cancelledcount').text(`${statusCancelledCount}`);

            
            table = $("#booking").DataTable({
                language: {
                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                    searchPlaceholder: "Search...",
                },
                dom: '<Bfr<"table-container"t>ip>',
                scrollX: "100%",
                order: [[1, 'desc']],
                buttons: [
                                {
                                extend: "pdf",
                                footer: true,
                                title: "Cancelled Orders",
                                },
                                {
                                extend: "csv",
                                footer: true,
                                title: "Cancelled Orders",
                                },
                         ],
                        order: [],
                columnDefs: [{
                    type: "unknownType",
                    targets: [3],
                },],
            });
        }


    </script>
</body>

</html>