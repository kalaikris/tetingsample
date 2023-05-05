<?php
include_once '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>manage_Finance</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- boostrap-popup-link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- boostrap-popup-link-->
    <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />

    <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/managefinace.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/fonts.css<?php echo $js_cache_string; ?>">
    <!-- datepicker style -->
<!--     <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>
    <!-- datepicker style-end -->
</head>
<style>
    .dt-buttons{
        display: none;
    }
</style>

<body id="page">
    <div id="loading"></div>
    <!-- page loader -->
    <header id="header">
    </header>
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar">
            </div>
            <div class="slider-desc-set">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">Website Bookings</li>
                    <li class="tab-link" data-tab="tab-2">Agent Bookings</li>
                </ul>
                <div id="tab-1" class="tab-content current">
                <div class="common-input-field">
                        <div class="inner-input-field">
                            <div class='arriving-input-set input-group'>
                                <label for="from_date1" class="input-group-addon bg-date">
                                </label>
                                <div class="date-con">
                                    <label for="from_date1">From Date</label><br>
                                    <input type='text' class="b-input datepicker" id="from_date1" placeholder="DD-MM-YYYY" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="inner-input-field">
                            <div class='arriving-input-set input-group'>
                                <label for="to_date1" class="input-group-addon bg-date">
                                </label>
                                <div class="date-con">
                                    <label for="to_date1">To Date</label><br>
                                    <input type='text' class="b-input datepicker" id="to_date1" placeholder="DD-MM-YYYY" readonly />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="date_filter()">Generate</button>
                        <div class="inner-input-field">
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Download As
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" onclick="dropdownclick('example','csv');" href="#">CSV</a>
                                    <a class="dropdown-item" onclick="dropdownclick('example','pdf');" href="#">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="common-revenue">
                       <div class="common-revenue-inner">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Booked Revenue</p>
                                <h1 id="booked_revenue"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/yellow-booked.png" alt="">
                             </div>
                          </div>
                          <div class="realized">
                             <p>Realized Revenue</p>
                             <h1 id="realized_revenue"></h1>
                          </div>
                          <div class="unrealized">
                             <p>Unrealized Revenue</p>
                             <h1 id="unrealized_revenue"></h1>
                          </div>
                       </div>
                       <div class="total-earings">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Total Earnings</p>
                                <h1 id="total_earnings"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/green-booked.png" alt="">
                             </div>
                          </div>
                          <div class="total-common">
                             <div class="total-common-inner">
                                <h1>This Month</h1>
                                <p id="month_earning"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Month</h1>
                                <p id="last_month_earning"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Six Months</h1>
                                <p id="last_six_month_earning"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Year</h1>
                                <p id="last_year_earning"></p>
                             </div>
                          </div>
                       </div>
                       <div class="credit-available">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Credit Available</p>
                                <h1 id="credit_available"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/vilot-booked.png" alt="">
                             </div>
                          </div>
                          <div class="realized">
                             <p>Total Credit Given</p>
                             <h1 id="total_credit_given"></h1>
                          </div>
                          <div class="unrealized">
                             <p>Balance From Airportzo Revenue</p>
                             <h1 id="airport_team_revenue"></h1>
                          </div>
                       </div>
                    </div>
                    <table id="example" class="websitetable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Service Cost</th>
                                <th>Credit Topup</th>
                                <th>Credit Balance</th>
                                <th>commission%</th>
                                <th>Commision Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tab-2" class="tab-content">
                    <div class="common-input-field-tab-next">
                        <div class="inner-input-field">
                            <div class='arriving-input-set input-group'>
                                <label for="from_date" class="input-group-addon bg-date">
                                </label>
                                <div class="date-con">
                                    <label for="from_date">From Date</label><br>
                                    <input type='text' class="b-input
                                 datepicker" id="from_date" placeholder="DD-MM-YYYY" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="inner-input-field">
                            <div class='arriving-input-set input-group'>
                                <label for="to_date" class="input-group-addon bg-date">
                                </label>
                                <div class="date-con">
                                    <label for="to_date">To Date</label><br>
                                    <input type='text' class="b-input
                                 datepicker" id="to_date" placeholder="DD-MM-YYYY" readonly />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="agent_date_filter()">Generate</button>
                        <div class="inner-input-field">
                               <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Download As
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <a class="dropdown-item" onclick="dropdownclick('agentfinance','csv');" href="#">CSV</a>
                                    <a class="dropdown-item" onclick="dropdownclick('agentfinance','pdf');" href="#">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="common-revenue">
                       <div class="common-revenue-inner">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Booked Revenue</p>
                                <h1 id="booked_revenue1"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/yellow-booked.png" alt="">
                             </div>
                          </div>
                          <div class="realized">
                             <p>Realized Revenue</p>
                             <h1 id="realized_revenue1"></h1>
                          </div>
                          <div class="unrealized">
                             <p>Unrealized Revenue</p>
                             <h1 id="unrealized_revenue1"></h1>
                          </div>
                       </div>
                       <div class="total-earings">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Total Earnings</p>
                                <h1 id="total_earnings1"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/green-booked.png" alt="">
                             </div>
                          </div>
                          <div class="total-common">
                             <div class="total-common-inner">
                                <h1>This Month</h1>
                                <p id="month_earning1"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Month</h1>
                                <p id="last_month_earning1"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Six Month</h1>
                                <p id="last_six_month_earning1"></p>
                             </div>
                             <div class="total-common-inner">
                                <h1>Last Year</h1>
                                <p id="last_year_earning1"></p>
                             </div>
                          </div>
                       </div>
                       <div class="credit-available">
                          <div class="common-booked">
                             <div class="booked">
                                <p>Credit Available</p>
                                <h1 id="credit_available1"></h1>
                             </div>
                             <div class="book-home">
                                <img src="asset/vilot-booked.png" alt="">
                             </div>
                          </div>
                          <div class="realized">
                             <p>Total Credit Given</p>
                             <h1 id="total_credit_given1"></h1>
                          </div>
                          <div class="unrealized">
                             <p>Balance From Airportzo Revenue</p>
                             <h1 id="airport_team_revenue1"></h1>
                          </div>
                       </div>
                    </div>
                    <table id="agentfinance" class="agenttable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Agent Name</th>
                                <th>Service Cost</th>
                                <th>Credit Topup</th>
                                <th>Credit Balance</th>
                                <th>commission%</th>
                                <th>Commision Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    
    <script src='./js/jquery.min.js'></script>
    <!-- boostrap-popup-link -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- boostrap-popup-link -->
    <!-- <script src="./js/jquery-3.6.0.js"></script> -->
    <!-- <script src='./js/jquery.min.js'></script> -->
    <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
    <!-- date picker -->
    <script src='./js/moment-with-locales.js'></script>
    <script src='./js/bootstrap-datetimepicker.js'></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <script src="./js/bootstrap.min.js"></script> -->
    <script>
    
    $(document).ready(function() {
        $('#Manage-finance').addClass('actives');
            //Tab Switch
            $("ul.tabs li").click(function() {
                var tab_id = $(this).attr("data-tab");

                $("ul.tabs li").removeClass("current");
                $(".tab-content").removeClass("current");

                $(this).addClass("current");
                $("#" + tab_id).addClass("current");
            });
    });

    $("ul.tabs li").click(function () {
        setTimeout(() => {
            // adjust table width on clicking tabs
            $( $.fn.dataTable.tables( true ) ).DataTable().columns.adjust();
        }, 300);
    });
    //Date Picker
        $("#from_date,#from_date1").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
            maxDate: new Date()
        });
        $('#to_date,#to_date1').datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: 'DD-MM-YYYY',
            maxDate: new Date()
        });
        
        let apiPath = "<?php echo $apiPath;?>";
        $(document).ready(function(){
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            fromDate = formatDate(fromDate);
            toDate = formatDate(toDate);
            let fromDate1 = $('#from_date1').val();
            let toDate1= $('#to_date1').val();
            fromDate1 = formatDate(fromDate1);
            toDate1 = formatDate(toDate1);
            if(isAgent == 1){
                fetch_websiteheader(fromDate1,toDate1);
                fetch_websitebooking(fromDate1,toDate1);
                fetch_agentheader(fromDate,toDate);  
                fetch_agentbooking(fromDate,toDate); 
                $('.tabs').removeClass('hidden'); 
            }else{
                $('.tabs').addClass('hidden');
                fetch_websiteheader(fromDate1,toDate1);
                fetch_websitebooking(fromDate1,toDate1);
            }
        });


        function date_filter(){
            let fromDate = $('#from_date1').val();
            let toDate = $('#to_date1').val();
            fromDate = formatDate(fromDate);
            toDate = formatDate(toDate);
            let fromfullDate = new Date(fromDate);//to get valid date format to compare dates
            let tofullDate = new Date(toDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate){
                
                fetch_websiteheader(fromDate,toDate)
                fetch_websitebooking(fromDate,toDate);
            }else{
                swal("Enter Valid Date Range");
            }
        }

        function agent_date_filter(){
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            fromDate = formatDate(fromDate);
            toDate = formatDate(toDate);
            let fromfullDate = new Date(fromDate);//to get valid date format to compare dates
            let tofullDate = new Date(toDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate){
                
                fetch_agentheader(fromDate,toDate)
                fetch_agentbooking(fromDate,toDate);
            }else{
                swal("Enter Valid Date Range");
            }
        }

        function fetch_websiteheader(fromDate,toDate){
 
            let data = {
                    "userToken":userToken,
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/financeHeader.php`,
                    data: json_data
                }).done(function(data1){
                    let headerObject = data1;
                    let IndianCurrency = Intl.NumberFormat("en-IN", {
                        style: "currency",
                        currency: "INR",
                    });
                    
                    $('#booked_revenue').text(IndianCurrency.format(headerObject.bookedRevenue));
                    $('#realized_revenue').text(IndianCurrency.format(headerObject.realizedRevenue));
                    $('#unrealized_revenue').text(IndianCurrency.format(headerObject.unRealizedRevenue));
                    $('#total_earnings').text(IndianCurrency.format(headerObject.totalEarnings));
                    $('#month_earning').text(IndianCurrency.format(headerObject.thisMonthEarning));
                    $('#last_month_earning').text(IndianCurrency.format(headerObject.lastMonthEarning));
                    $('#last_six_month_earning').text(IndianCurrency.format(headerObject.lastSixMonthEarning));
                    $('#last_year_earning').text(IndianCurrency.format(headerObject.lastYearEarning));
                    if(headerObject.is_credit=='0'){
                        $('.credit-available').css("display", "none");
                    } else{
                        $('#credit_available').text(IndianCurrency.format(headerObject.creditAvailable));
                        $('#total_credit_given').text(IndianCurrency.format(headerObject.totalCreditGiven));
                        $('#airport_team_revenue').text(IndianCurrency.format(headerObject.balanceFromAirportzo));
                    }
                });
        }

        function fetch_websitebooking(fromDate,toDate){
                let data = {
                    "userToken":userToken,
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/financeHistory.php`,
                    data: json_data
                }).done(function(data1){
                    let webbooking = '';
                    let webbookingarray = data1.data;
                    var symbol = '';
                    var commisionCostVal = '';
                    webbookingarray.forEach((webdetails,index) => {
                            let date = new Date(webdetails.createdDateTime.replace(/-/g, "/"));
                            let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                            let datearray = formattedDate.split(',')
                            let timearray = datearray[2].split(" ");
                            let timeValue = timearray[1];
                            let timeZone = timearray[2];
                            let dateYearValue = datearray[0]+","+datearray[1];
                            let time_zoneValue = `${timeValue}`;
                            if(webdetails.commisionCost.substr(0, 1) == '-'){
                                symbol = '-';
                                commisionCostVal = webdetails.commisionCost.substr(1);
                            }else{
                                symbol = '+';
                                commisionCostVal = webdetails.commisionCost;
                            }
                        webbooking += `<tr>
                                            <td>${index + 1}</td>
                                            <td class="order-data"><a class="" data-token="${webdetails.token}" href="#">${webdetails.bookingNumber}</a> </td>
                                            <td>${dateYearValue} </br><span>${time_zoneValue}</span></td>
                                            <td>
                                                <ul class="service-cost">
                                                    <li>${webdetails.serviceCost}</li>
                                                </ul>
                                            </td>
                                            <td>${webdetails.givenCredit}</td>
                                            <td>${webdetails.creditBalance}</td>
                                            <td>
                                                <ul class="commission-cost">
                                                    <li>${webdetails.commision}%</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="total-commision">
                                                    <li>${symbol}</li>
                                                    <li>${commisionCostVal}</li>
                                                </ul>
                                            </td>
                                        </tr>`;
                        
                    });
                    $('.websitetable tbody').html(webbooking);
                    $('.websitetable').DataTable().destroy();
                    $('.websitetable tbody').html(webbooking);
                    $(".websitetable").DataTable({
                        language: {
                            search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                            searchPlaceholder: "Search...",
                        },
                       // order: [[0, 'desc']],
                        buttons: [
                                    {
                                        extend: "searchBuilder",
                                        config: {
                                            depthLimit: 2,
                                        },
                                    },
                                    {
                                        extend: "pdf",
                                        footer: true,
                                        title: "Manage Finance-Website",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6,7],
                                        },
                                    },
                                    {
                                        extend: "csv",
                                        footer: true,
                                        title: "Manage Finance-Website",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6,7],
                                        },
                                    }, 
                                ],
                        dom: '<Bfr<"table-container"t>ip>',
                        scrollX: true,
                        columnDefs: [{
                            "targets": [ 0 ],
                            "visible": false,
                            // type: "unknownType",
                            // targets: [3],
                        }],
                    }).draw();

                })

        }

        function fetch_agentheader(fromDate,toDate){

            let data = {
                    "userToken":userToken,
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/agentFinanceHeader.php`,
                    data: json_data
                }).done(function(data1){
                    let headerObject = data1;
                    let Indian_Currency = Intl.NumberFormat("en-IN", {
                        style: "currency",
                        currency: "INR",
                    });
                    $('#booked_revenue1').text(Indian_Currency.format(headerObject.bookedRevenue));
                    $('#realized_revenue1').text(Indian_Currency.format(headerObject.realizedRevenue));
                    $('#unrealized_revenue1').text(Indian_Currency.format(headerObject.unRealizedRevenue));
                    $('#total_earnings1').text(Indian_Currency.format(headerObject.totalEarnings));
                    $('#month_earning1').text(Indian_Currency.format(headerObject.thisMonthEarning));
                    $('#last_month_earning1').text(Indian_Currency.format(headerObject.lastMonthEarning));
                    $('#last_six_month_earning1').text(Indian_Currency.format(headerObject.lastSixMonthEarning));
                    $('#last_year_earning1').text(Indian_Currency.format(headerObject.lastYearEarning));
                    if(headerObject.is_credit=='0'){
                        $('.credit-available').css("display", "none");
                    } else{
                        $('#credit_available1').text(Indian_Currency.format(headerObject.creditAvailable));
                        $('#total_credit_given1').text(Indian_Currency.format(headerObject.totalCreditGiven));
                        $('#airport_team_revenue1').text(Indian_Currency.format(headerObject.balanceFromAirportzo));
                    }
                })
        }

        function fetch_agentbooking(fromDate,toDate){
                let data = {
                    "userToken":userToken,
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/agentFinanceHistory.php`,
                    data: json_data
                }).done(function(data1){
                    let agentbooking = '';
                    let agentbookingarray = data1.data;
                    var symbol = '';
                    var commisionCostVal = '';
                    agentbookingarray.forEach((agentdetails,index) => {
                        
                            let date = new Date(agentdetails.createdDateTime.replace(/-/g, "/"));
                            let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                            let datearray = formattedDate.split(',')
                            let timearray = datearray[2].split(" ");
                            let timeValue = timearray[1];
                            let timeZone = timearray[2];
                            let dateYearValue = datearray[0]+","+datearray[1];
                            let time_zoneValue = `${timeValue}`;
                            
                            if(agentdetails.commisionCost.substr(0, 1) == '-'){
                                symbol = '-';
                                commisionCostVal = agentdetails.commisionCost.substr(1);
                            }else{
                                symbol = '+';
                                commisionCostVal = agentdetails.commisionCost;
                            }
                        agentbooking += `<tr>
                                            <td>${index + 1}</td>
                                            <td class="order-data"><a class="" data-token="${agentdetails.token}" href="#">${agentdetails.bookingNumber}</a> </td>
                                            <td>${dateYearValue} </br><span>${time_zoneValue}</span></td>
                                            <td>${agentdetails.agentName}</td>
                                            <td>
                                                <ul class="service-cost">
                                                    <li>${agentdetails.serviceCost}</li>
                                                </ul>
                                            </td>
                                            <td>${agentdetails.givenCredit}</td>
                                            <td>${agentdetails.creditBalance}</td>
                                            <td>
                                                <ul class="commission-cost">
                                                    <li>${agentdetails.commision}%</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="total-commision">
                                                    <li>${symbol} ${commisionCostVal}</li>
                                                </ul>
                                            </td>
                                        </tr>`;
                        
                    });
                    $('.agenttable tbody').html(agentbooking);
                    $('.agenttable').DataTable().destroy();
                    $('.agenttable tbody').html(agentbooking);
                    $(".agenttable").DataTable({
                        language: {
                            search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                            searchPlaceholder: "Search...",
                        },
                        //order: [[0, 'desc']],
                        buttons: [
                                    {
                                        extend: "searchBuilder",
                                        config: {
                                            depthLimit: 2,
                                        },
                                    },
                                    {
                                        extend: "pdf",
                                        footer: true,
                                        title: "Manage Finance-Agent",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6,7,8],
                                        },
                                    },
                                    {
                                        extend: "csv",
                                        footer: true,
                                        title: "Manage Finance-Agent",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6,7,8],
                                        },
                                    }, 
                                ],
                        dom: '<Bfr<"table-container"t>ip>',
                        scrollX: true,
                        columnDefs: [{
                            // type: "unknownType",
                            // targets: [3],
                            "targets": [ 0 ],
                            "visible": false,
                        }],
                    }).draw();

                })

        }


        function formatDate(date) {
                    let [day,month,year] = date.split('-');
                    return [year, month, day].join('-');

        }

        //dropdown pdf,csv file download
        function dropdownclick(tableid,file){
                if(file == 'pdf'){
                    $(`#${tableid}_wrapper`).find('.dt-button.buttons-pdf.buttons-html5').click();
                }
                if(file == 'csv'){
                    $(`#${tableid}_wrapper`).find('.dt-button.buttons-csv.buttons-html5').click();
                }

        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    
    </script>
    

</body>

</html>