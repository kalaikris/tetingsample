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
    <title>Service Distributor Management</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />

    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/manage_volunteer_list.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/sd_dashboard.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <link rel="stylesheet" href="css/select.css">
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


        <section class="bg-white full-height" id="">
            <div class="slider-desc-set">
            <select class="overview-left mb-3" id="service_distributor_list" onchange="getUpdatedDistributor()">
                </select> 
                <div class="dashboard-set">
                    <div class="dashboard-box">
                        <div class="dashboard-box-set">
                            <div class="booking-set">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Realized
                                        revenue</h5>
                                    <h1 class="total-booking-count"><span class="realizedrevenue"></span></h1>
                                </div>
                                <img class="b-2" src="../service-distributor-dashboard/asset/img/b-4.png"
                                    alt=""
                                    srcset="">
                            </div>
                            <div class="booking-set">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Unrealized
                                        revenue</h5>
                                    <h1 class="total-booking-count"><span class="unrealizedrevenue"></span></h1>
                                </div>
                            </div>

                            <div class="booking-set">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Booking
                                        revenue</h5>
                                    <h1 class="total-booking-count"><span class="bookingrevenue"></span></h1>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="dashboard-box">
                        <div class="dashboard-box-set">
                            <div class="booking-set-f">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Total
                                        bookings</h5>
                                    <h1 class="total-booking-count"><span class="totalbooking">348</span></h1>
                                </div>
                                <img class="b-1" src="./asset/img/b-1.png"
                                    alt=""
                                    srcset="">
                            </div>
                            <div class="month-booking">
                                <ul class="month-set">
                                    <li class="month-cap">This month</li>
                                    <li class="month-cap">last month</li>
                                    <li class="month-cap">past 6 months</li>
                                    <li class="month-cap">Last year</li>
                                </ul>
                                <ul class="month-booking-set">
                                    <li class="booking-cap"><span
                                            class="month-booking-count thismonth"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count lastmonth"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count pastsixmonths"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count lastyear"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-box" id="airlineoutstanding">
                        <div class="dashboard-box-set">
                            <div class="booking-set-1">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Balance from Airportzo</h5>
                                    <h1 class="total-booking-count"> ₹<span class="airportzototalbalance"></span></h1>
                                </div>
                                <img class="b-2" src="./asset/img/hand.png"
                                    alt=""
                                    srcset="">
                            </div>
                            <div class="month-booking">
                                <ul class="month-set">
                                    <li class="month-cap">This month</li>
                                    <li class="month-cap">last month</li>
                                    <li class="month-cap">past 6 months</li>
                                    <li class="month-cap">Last year</li>
                                </ul>
                                <ul class="month-booking-set">
                                    <li class="booking-cap"><span
                                            class="month-booking-count airportzothismonth"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count airportzolastmonth"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count airportzosixmonths"></span></li>
                                    <li class="booking-cap"><span
                                            class="month-booking-count airportzolastyear"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-box hidden" id="agentoutstanding">
                        <div class="dashboard-box-set">
                            <div class="booking-set-1">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Total
                                        Outstanding</h5>
                                    <p class="from-airport">From Airportzo</p>
                                    <h1 class="total-booking-count"><span class="agentfromairportzo"></span></h1>
                                </div>
                                <img class="b-2" src="./asset/img/hand.png"
                                    alt=""
                                    srcset="">
                            </div>
                            <div class="booking-set-2">
                                <div class="booking-inner">
                                    <p class="from-airport">To agents</p>
                                    <h1 class="total-booking-count"><span class="agenttoagents"></span></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="airlines-container">
                    <!-- chart analytics section -->
                    <div class="booking-analytics-set">
                        <div class="booking-overview">
                            <div class="booking-head">
                                <div class="d-flex align-center">
                                    <h5 class="overview-cont">Booking Overview</h5>
                                    <div class="choose-chart-type d-flex ml-3">
                                        <div class="mr-2">
                                        <input id="byvolume" class="chart-type" value="volume" type="radio" name="chart-type" checked>
                                        <label for="byvolume">By Volume</label>
                                        </div>
                                        <div>
                                        <input id="byservicetype" class="chart-type" value="service" type="radio" name="chart-type">
                                        <label for="byservicetype">By Service Type</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="display:flex;gap:12px;">
                                    <div class="inner-input-field">
                                        <div class="arriving-input-set input-group">
                                            <label for="from_date" class="input-group-addon bg-date"></label>
                                            <div class="date-con">
                                            <label for="from_date">From Date</label>
                                            <input type="text" class="b-input datepicker" id="from_date" placeholder="YYYY-MM-DD" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-input-field">
                                        <div class="arriving-input-set input-group">
                                            <label for="to_date" class="input-group-addon bg-date"></label>
                                            <div class="date-con">
                                            <label for="to_date">To Date</label>
                                            <input type="text" class="b-input datepicker" id="to_date" placeholder="YYYY-MM-DD" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="airlineservice hidden">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="airlinevolume">
                                <canvas id="curveChart"></canvas>
                            </div>
                            <div class="hide"></div>
                        </div>
                    </div>

                    <div class="view-table-set">
                        <div class="view-table-rghit">
                            <div class="box1">
                                <div class="over-head">
                                    <h5 class="overview-cont">Top Performing Airports</h5>
                                    <div style="display:flex;flex-wrap:wrap;margin-top:12px;gap:12px;">
                                        <div class="inner-input-field">
                                            <div class="arriving-input-set input-group">
                                                <label for="from_date2" class="input-group-addon bg-date"></label>
                                                <div class="date-con">
                                                <label for="from_date2">From Date</label>
                                                <input type="text" class="b-input datepicker" id="from_date2" placeholder="YYYY-MM-DD" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inner-input-field">
                                            <div class="arriving-input-set input-group">
                                                <label for="to_date2" class="input-group-addon bg-date"></label>
                                                <div class="date-con">
                                                <label for="to_date2">To Date</label>
                                                <input type="text" class="b-input datepicker" id="to_date2" placeholder="YYYY-MM-DD" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="doughnut-chart-container">
                                    <div class="outstanding-balance-chart">
                                        <canvas id="airlineDoughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                </div>

                <div class="isagent-container">
                    <!-- chart analytics section -->
                    <div class="booking-analytics-set">
                        <div class="booking-overview">
                            <div class="booking-head">
                                <h5 class="overview-cont">Booking Overview</h5>

                                <div style="display:flex;gap:12px;">
                                    <div class="inner-input-field">
                                        <div class="arriving-input-set input-group">
                                            <span class="input-group-addon bg-date"></span>
                                            <div class="date-con">
                                            <label for="from_date1">From Date</label>
                                            <input type="text" class="b-input datepicker" id="from_date1" placeholder="YYYY-MM-DD" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-input-field">
                                        <div class="arriving-input-set input-group">
                                            <span class="input-group-addon bg-date"></span>
                                            <div class="date-con">
                                            <label for="to_date1">To Date</label>
                                            <input type="text" class="b-input datepicker" id="to_date1" placeholder="YYYY-MM-DD" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <canvas id="myChartAgent"></canvas>
                            </div>
                            <div class="hide"></div>
                        </div>
                        <div class="popular-solt hidden">
                            <div class="over-head">
                                <h5 class="overview-cont">Outstanding Balance</h5>
                                <select class="overview-left" name="" id="">
                                    <option value="thisyear">This year</option>
                                    <option value="thisyear">Last year</option>
                                </select>
                            </div>
                            <div class="doughnut-chart-container">
                                <div class="outstanding-balance-chart">
                                    <canvas id="myAgentDoughnutChart"></canvas>
                                </div>
                            </div>
                            <div class="hide2"></div>
                        </div>
                        <div class="view-table-rghit">
                            <div class="box1">
                                <div class="over-head">
                                    <h5 class="overview-cont">Top Performing Airports</h5>

                                    <div style="display:flex;flex-wrap:wrap;margin-top:12px;gap:12px;">
                                        <div class="inner-input-field">
                                            <div class="arriving-input-set input-group">
                                                <span class="input-group-addon bg-date"></span>
                                                <div class="date-con">
                                                <label for="from_date3">From Date</label>
                                                <input type="text" class="b-input datepicker" id="from_date3" placeholder="YYYY-MM-DD" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inner-input-field">
                                            <div class="arriving-input-set input-group">
                                                <span class="input-group-addon bg-date"></span>
                                                <div class="date-con">
                                                <label for="to_date3">To Date</label>
                                                <input type="text" class="b-input datepicker" id="to_date3" placeholder="YYYY-MM-DD" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="doughnut-chart-container">
                                    <div class="outstanding-balance-chart">
                                        <canvas id="agentDoughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script src="js/jquery.min.js"></script>
    <!--    datepicker-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/select.js"></script>
    <script src="js/function.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $("#from_date").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
        });
        $("#to_date").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
        });
        $("#from_date1").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "YYYY-MM-DD",
                maxDate: new Date()
        });
        $("#to_date1").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });
        $("#from_date2").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
        });
        $("#to_date2").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
        });
        $("#from_date3").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "YYYY-MM-DD",
                maxDate: new Date()
        });
        $("#to_date3").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });

        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: apiPath + "/distributor/getDistributorList.php",
            data: json1,
        }).done(function (data) {
            $("#service_distributor_list").empty();
            var distributor = data.data;
            console.log(distributor);
            var distributorData = '<option value="">Select Your Distributor</option>';
            for (var key in distributor) {
                distributorData +='<option value="' +distributor[key].distributorToken +'" data-agent="'+distributor[key].is_agent +'">' +
                distributor[key].distributorName +
                "</option>";
            }
            $("#service_distributor_list").html(distributorData);
            $("#service_distributor_list")
            .change(function () {})
            .chosen({ allow_single_deselect: true });
            ({
            width: "100%",
            filter: true,
            });
            distributorToken = $('#service_distributor_list option:eq(1)').attr("selected",true).val();
            fetchDashboardData();
            $("#loading").hide(); //Main Loader Close
        });
        var isAgent = '';
        var distributorToken = '';
        function getUpdatedDistributor(){
            distributorToken = $("#service_distributor_list").val();
            isAgent = $('#service_distributor_list option:selected').attr('data-agent');
            fetchDashboardData();
        }

          // doughnut chart (is agent)
        //   const dataAgentDoughnut = {
        //                     labels: ['Aiportzo Balance', 'Agent Balance'],
        //                     datasets: [{
        //                         label: 'Outstanding Balance',
        //                         data: [5, 7],
        //                         backgroundColor: [
        //                         '#53c0ee',
        //                         '#52c98f'
        //                         ],
        //                         borderColor: [
        //                         '#53c0ee',
        //                         '#52c98f'
        //                         ],
        //                         borderWidth: 1,
        //                         cutout: '80%',
        //                         borderRadius: 20,
        //                         offset: 30
        //                     }]
        //                 };

        //                 // config 
        //                 const configDoughnut = {
        //                 type: 'doughnut',
        //                 data: dataAgentDoughnut,
        //                 maintainAspectRatio: false,
        //                 options: {
        //                     plugins: {
        //                         legend: {
        //                             position: 'bottom'
        //                         }
        //                     }
        //                 }
        //                 };
                        
        //                 const myAgentDoughnutChart = new Chart(
        //                     document.getElementById('myAgentDoughnutChart'),
        //                     configDoughnut
        //                 );

            // $(".box").click(function () {
            //     $(".content").slideToggle("slow");
            // });

            // $(document).ready(()=>{
            //     $('#dashboard').addClass('actives');
            
            // });


           
            // $(document).ready(()=>{
               
            // });

            function fetchDashboardData(){
                // let year = Math.abs(new Date().getFullYear());
                // let yearList = `<option value="${year}">This year</option>
                //                 <option value="${year - 1}">Last year</option>`;
                airportrecentbookings();
                if(isAgent == 0){
                    // console.log('No-agent');
                  // $('#airlinebarchartyear').html(yearList);
//                    $('#airlinedoughnutyear').html(yearList); 
                     $('#airlineoutstanding').removeClass('hidden');
                    $('#agentoutstanding').addClass('hidden');
                    $('.airlines-container').removeClass('hidden');
                    $('.isagent-container').addClass('hidden');
                    airportheader();
                    if(curveChart != null || myChart != null){
                        curveChart.destroy();
                        myChart.destroy();
                        fetchairlineservicevolumecharts();
                    }else{
                        fetchairlineservicevolumecharts();
                    }
                    if(airlineDoughnutChart != null){
                        airlineDoughnutChart.destroy();
                        fetchtopairports();
                    }else{
                        fetchtopairports();
                    }
                        
                }else{
                    // console.log('agent');
                    $('#airlineoutstanding').addClass('hidden');
                    $('#agentoutstanding').removeClass('hidden');
                    $('.airlines-container').addClass('hidden');
                    $('.isagent-container').removeClass('hidden');
                    agentheader();
                    if(myChartAgent != null){
                        myChartAgent.destroy();
                        agent_bar_chart();
                    }else{
                        agent_bar_chart();
                    }
                    if(agentDoughnutChart != null){
                        agentDoughnutChart.destroy();
                        fetchtopairports_agent();
                    }else{
                        fetchtopairports_agent();

                    }
                }
            
            }

            function airportheader(){
                let datas = {
                                "distributorToken": distributorToken
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/dashboardHeader.php",
                        data: json1
                        }).done(function(data) {
                            let revenueObject = data.revenue;
                            
                            $('.realizedrevenue').text(`₹${revenueObject.realisedRevenue}`);
                            $('.unrealizedrevenue').text(`₹${revenueObject.unRealisedRevenue}`);
                            $('.bookingrevenue').text(`₹${revenueObject.bookedRevenue}`);

                            let bookingObject = data.booking;
                            $('.totalbooking').text(`${bookingObject.totalCount}`)
                            $('.thismonth').text(`${bookingObject.thisMonthCount} bookings`);
                            $('.lastmonth').text(`${bookingObject.lastMonthCount} bookings`);
                            $('.pastsixmonths').text(`${bookingObject.lastSixMonthCount} bookings`);
                            $('.lastyear').text(`${bookingObject.lastOneYearCount} bookings`);

                            let airportzoObject = data.airportzo;
                            $('.airportzototalbalance').text(`${airportzoObject.totalBalance}`);
                            $('.airportzothismonth').text(`₹${airportzoObject.thisMonthBalance}`);
                            $('.airportzolastmonth').text(`₹${airportzoObject.lastMonthBalance}`);
                            $('.airportzosixmonths').text(`₹${airportzoObject.lastSixMonthBalance}`);
                            $('.airportzolastyear').text(`₹${airportzoObject.lastOneYearBalance}`);

                        });
            }

            function airportrecentbookings(){

                let datas = {
                                "distributorToken": distributorToken
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/dashboardRecentBooking.php",
                        data: json1
                        }).done(function(data) {
                            let airportbookingarray = data.bookingDetails;
                            let recentbooking = '';
                            airportbookingarray.forEach((bookingdetails,index) => {
                                let status = '';
                                switch (bookingdetails.status) {
                                    case 'Pending':
                                        status = `<div class="controle-lable">
                                                    <span class="upcoming"><img
                                                            src="../service-distributor-dashboard/asset/img/up.png">Upcoming</span>
                                                 </div>`;
                                        break;
                                    case 'Ongoing':
                                        status = `<div class="controle-lable">
                                                    <span class="ongoing"><img
                                                            src="../service-distributor-dashboard/asset/img/ong.png">Ongoing</span>
                                                 </div>`;
                                        break;
                                    case 'Completed':
                                        status = `<div class="controle-lable">
                                                    <span class="accepted"><img
                                                            src="../service-distributor-dashboard/asset/img/acp.png">Completed</span>
                                                 </div>`;
                                        break;
                                    
                                    case 'Cancelled':
                                        status = `<div class="controle-lable">
                                                    <span class="rejected"><img
                                                            src="../service-distributor-dashboard/asset/img/rej.png">Cancelled</span>
                                                 </div>`;
                                        break;
                                    default:
                                        break;

                                }
                                if(index < 5){
                                    recentbooking += `<tr>
                                                    <td class="td-bule"><span
                                                        class="bule-color">${bookingdetails.bookingNumber}</span><br>
                                                    <span>${bookingdetails.customerName}</span><br/>
                                                        <small>${bookingdetails.memberCount}</small>
                                                    </td>
                                                    <td>
                                                    ${bookingdetails.createdDate}
                                                    </td>

                                                    <td><div class="lable-alert">
                                                            <span>${bookingdetails.servicesCount} Services</span>
                                                        </div>
                                                    </td>
                                                </tr>`;
                                }
                                
                            });
                            $('.airportrecentbookings tbody').html(recentbooking);
                            $('.agentrecentbookings tbody').html(recentbooking);

                        })
            }
            let airlineDoughnutChart = null;
            function fetchtopairports(){
//                let year = $('#airlinedoughnutyear').val();
                let from_date = $('#from_date2').val();
                let to_date = $('#to_date2').val();
                var d1 = Date.parse(from_date);
                var d2 = Date.parse(to_date);
                if(d1>d2){
                    $("#to_date2").val(from_date);
                }
                to_date = $('#to_date2').val();
                let datas = {
                                "distributorToken": distributorToken,
                                "from_date":from_date,
                                "to_date":to_date
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/dashboardTopAirports.php",
                        data: json1
                        }).done(function(data) {
                            let totalbookingcount = data.totalCount;
                            let topairportArray = data.topAirports;
                            let datalable =  [];
                            let lablebookingcount = [];
                            topairportArray.forEach((topairports,index) => {
                                if(index < 6 ){
                                    datalable.push(`${topairports.airportCode}-${topairports.bookingCount}`);
                                    lablebookingcount.push(topairports.bookingCount);
                                }
                            });

                                let dataAirlineDoughnut = {
                                    labels: datalable,
                                    datasets: [{
                                        label: 'Top Airports',
                                        data: lablebookingcount,
                                        backgroundColor: [
                                        '#57c78f',
                                        '#ce5eaa',
                                        '#fd7837',
                                        '#fec629',
                                        '#52c0ef',
                                        '#a17deb'
                                        ],
                                        borderColor: [
                                        '#57c78f',
                                        '#ce5eaa',
                                        '#fd7837',
                                        '#fec629',
                                        '#52c0ef',
                                        '#a17deb'
                                        ],
                                        borderWidth: 1,
                                        cutout: '80%',
                                        borderRadius: 20,
                                        offset: 30
                                    }]
                                };

                               let stackedText = {
                                    id: 'stackedText',
                                    afterDatasetsDraw(chart, args, options){
                                        const {ctx, chartArea: {top, bottom, left, right, width, height}} = 
                                        chart;

                                        ctx.save();
                                        ctx.font = 'bolder 22px sans-serif';
                                        ctx.fillStyle =  '#000';
                                        ctx.textAlign = 'center';
                                        ctx.fillText(`${totalbookingcount}`, width / 2, height / 2 + top);
                                        ctx.restore();

                                        ctx.font = '22px sans-serif';
                                        ctx.fillStyle =  '#000';
                                        ctx.textAlign = 'center';
                                        ctx.fillText('Bookings', width / 2, height / 2 + top + 22);

                                    }
                                };

                                let configDoughnut2 = {
                                    type: 'doughnut',
                                    data: dataAirlineDoughnut,
                                    maintainAspectRatio: false,
                                    options: {
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                                align: 'center',
                                                labels: {
                                                    usePointStyle: true,
                                                    pointStyle: 'rectRounded',
                                                    boxWidth: 5,
                                                    padding: 25
                                                }
                                            }
                                        }
                                    },
                                    plugins: [stackedText]
                                };

                                airlineDoughnutChart = new Chart(
                                    document.getElementById('airlineDoughnutChart'),
                                    configDoughnut2
                                );
                              
                        })

            }            
            $('#from_date2, #to_date2').on('change dp.change', function(e){
                if(airlineDoughnutChart != null){
                    airlineDoughnutChart.destroy();
                    fetchtopairports();
                }else{
                    fetchtopairports();
                }
            });
            
            let agentDoughnutChart = null;
            function fetchtopairports_agent(){
//                let year = $('#airlinedoughnutyear').val();
                let from_date = $('#from_date3').val();
                let to_date = $('#to_date3').val();
                var d1 = Date.parse(from_date);
                var d2 = Date.parse(to_date);
                if(d1>d2){
                    $("#to_dat3").val(from_date);
                }
                to_date = $('#to_date3').val();
                let datas = {
                                "distributorToken": distributorToken,
                                "from_date":from_date,
                                "to_date":to_date
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/dashboardTopAirports.php",
                        data: json1
                        }).done(function(data) {
                            let totalbookingcount = data.totalCount;
                            let topairportArray = data.topAirports;
                            let datalable =  [];
                            let lablebookingcount = [];
                            topairportArray.forEach((topairports,index) => {
                                if(index < 6 ){
                                    datalable.push(`${topairports.airportCode}-${topairports.bookingCount}`);
                                    lablebookingcount.push(topairports.bookingCount);
                                }
                            });

                                let dataAirlineDoughnut = {
                                    labels: datalable,
                                    datasets: [{
                                        label: 'Top Airports',
                                        data: lablebookingcount,
                                        backgroundColor: [
                                        '#57c78f',
                                        '#ce5eaa',
                                        '#fd7837',
                                        '#fec629',
                                        '#52c0ef',
                                        '#a17deb'
                                        ],
                                        borderColor: [
                                        '#57c78f',
                                        '#ce5eaa',
                                        '#fd7837',
                                        '#fec629',
                                        '#52c0ef',
                                        '#a17deb'
                                        ],
                                        borderWidth: 1,
                                        cutout: '80%',
                                        borderRadius: 20,
                                        offset: 30
                                    }]
                                };

                               let stackedText = {
                                    id: 'stackedText',
                                    afterDatasetsDraw(chart, args, options){
                                        const {ctx, chartArea: {top, bottom, left, right, width, height}} = 
                                        chart;

                                        ctx.save();
                                        ctx.font = 'bolder 22px sans-serif';
                                        ctx.fillStyle =  '#000';
                                        ctx.textAlign = 'center';
                                        ctx.fillText(`${totalbookingcount}`, width / 2, height / 2 + top);
                                        ctx.restore();

                                        ctx.font = '22px sans-serif';
                                        ctx.fillStyle =  '#000';
                                        ctx.textAlign = 'center';
                                        ctx.fillText('Bookings', width / 2, height / 2 + top + 22);

                                    }
                                };

                                let configDoughnut2 = {
                                    type: 'doughnut',
                                    data: dataAirlineDoughnut,
                                    maintainAspectRatio: false,
                                    options: {
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                                align: 'center',
                                                labels: {
                                                    usePointStyle: true,
                                                    pointStyle: 'rectRounded',
                                                    boxWidth: 5,
                                                    padding: 25
                                                }
                                            }
                                        }
                                    },
                                    plugins: [stackedText]
                                };

                                agentDoughnutChart = new Chart(
                                    document.getElementById('agentDoughnutChart'),
                                    configDoughnut2
                                );
                              
                        })

            }
            $('#from_date3, #to_date3').on('change dp.change', function(e){
                if(agentDoughnutChart != null){
                    agentDoughnutChart.destroy();
                    fetchtopairports_agent();
                }else{
                    fetchtopairports_agent();

                }
            });
            
//            $('body').on('change','#airlinedoughnutyear',function(){
//                if(airlineDoughnutChart != null){
//                    airlineDoughnutChart.destroy();
//                    fetchtopairports();
//                }else{
//                    fetchtopairports();
//
//                }
//            });
            
            
            $('#from_date, #to_date').on('change dp.change', function(e){
                if(curveChart != null || myChart != null){
                    curveChart.destroy();
                    myChart.destroy();
                    fetchairlineservicevolumecharts();
                }else{
                    fetchairlineservicevolumecharts();
                }
            });
            
                let curveChart = null;
                let myChart = null;
            function fetchairlineservicevolumecharts(){

//                let year = $('#airlinebarchartyear').val();
                let x = $("#from_date").val();
                let y = $("#to_date").val();

                let range = dateRange(new Date(x), new Date(y));

                range = range.map(date => date.toISOString().slice(0, 10));
                if(range.length > 0){
                    let datas = {
                                    "distributorToken": distributorToken,
                                    'ranges' : range
                                };
                    let json1 = JSON.stringify(datas);
                            $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/distributor/dashboardChartDetails.php",
                            data: json1
                            }).done(function(data) {
                                let volumeArray = data.volumeChartData;
                                let serviceArray = data.serviceChartData;
                                let volumewisedata = [];
                                let volumewise_label = [];
                                volumeArray.forEach((vol,index) => {

                                    volumewisedata.push(vol.data);
                                    volumewise_label.push(vol.dates);

                                });
                                //Volume Chart Details
                                let dataCurveChart = {
                                    labels: volumewise_label,
                                    datasets: [{
                                    label: 'Booking Overview',
                                    fill: 'origin',
                                    backgroundColor: 'rgba(241, 237, 252, 0.5)',
                                    borderColor: '#947bca',
                                    data: volumewisedata,
                                    tension: 0.4,
                                    }]
                                };
                                let configCurve = {
                                    type: 'line',
                                    data: dataCurveChart,
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                },
                                                beginAtZero: true
                                            },
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            legend:{
                                                display: false
                                            }
                                        }
                                    }
                                };
                                curveChart = new Chart(
                                    document.getElementById('curveChart'),
                                    configCurve
                                );

                                let serviceDataset = [];
                                let bookingCount_label = [];
                                serviceArray.forEach((service,index) => {
                                    let serviceName = service.serviceType;
                                    let bookingCountData = [];
                                    
                                    service.counts.forEach((count,index1) => {
                                        bookingCountData.push(count.bookingcount);
                                        bookingCount_label.push(count.dates);
                                    });
                                    if(index == 0){
                                        serviceDataset.push({
                                            label: serviceName,
                                            data: bookingCountData,
                                            borderRadius: 5,
                                            barPercentage: .6,
                                            backgroundColor: [
                                                '#a07deb'
                                            ],
                                            borderColor: [
                                                '#a07deb'
                                            ],
                                            borderWidth: 1
                                            });
                                    }else if(index == 1){
                                        serviceDataset.push({
                                            label: serviceName,
                                            data: bookingCountData, 
                                            borderRadius: 5,
                                            barPercentage: .6,
                                            backgroundColor: [
                                                '#fe773b'
                                            ],
                                            borderColor: [
                                                '#fe773b'
                                            ],
                                            borderWidth: 1
                                            });
                                    }else if(index == 2){
                                        serviceDataset.push({
                                            label: serviceName,
                                            data: bookingCountData,
                                            borderRadius: 5,
                                            barPercentage: .6,
                                            backgroundColor: [
                                                '#53c881'
                                            ],
                                            borderColor: [
                                                '#53c881'
                                            ],
                                            borderWidth: 1
                                            });
                                    }else{

                                        serviceDataset.push({
                                            label: serviceName,
                                            data: bookingCountData,
                                            borderRadius: 5,
                                            barPercentage: .6,
                                            backgroundColor: [
                                                '#53c881'
                                            ],
                                            borderColor: [
                                                '#53c881'
                                            ],
                                            borderWidth: 1
                                            });

                                    }
                                });
                                //Service Chart Details
                                let dataBarAirline = {
                                        labels: bookingCount_label,
                                        datasets: serviceDataset
                                };

                                // config 
                                let configBarAirline = {
                                    type: 'bar',
                                    data: dataBarAirline,
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                },
                                                beginAtZero: true
                                            },
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                                align: 'start',
                                                labels: {
                                                    usePointStyle: true,
                                                    pointStyle: 'rectRounded',
                                                    padding: 25
                                                }
                                            }
                                        }
                                    }
                                };

                                myChart = new Chart(
                                    document.getElementById('myChart'),
                                    configBarAirline
                                );
                            });
                }else{
                   swal("Enter Valid Date Range"); 
                }

            }

//            $('body').on('change','#airlinebarchartyear',function(){
//                if(curveChart != null || myChart != null){
//                    curveChart.destroy();
//                    myChart.destroy();
//                    fetchairlineservicevolumecharts();
//                }else{
//                    fetchairlineservicevolumecharts();
//                }
//                
//            });

            function agentheader(){

                let datas = {
                                "distributorToken": distributorToken
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/dashboardAgentHeader.php",
                        data: json1
                        }).done(function(data) {
                            let revenueObject = data.revenue;
                            
                            $('.realizedrevenue').text(`₹${revenueObject.realisedRevenue}`);
                            $('.unrealizedrevenue').text(`₹${revenueObject.unRealisedRevenue}`);
                            $('.bookingrevenue').text(`₹${revenueObject.bookedRevenue}`);

                            let bookingObject = data.booking;
                            $('.totalbooking').text(`${bookingObject.totalCount}`)
                            $('.thismonth').text(`${bookingObject.thisMonthCount} bookings`);
                            $('.lastmonth').text(`${bookingObject.lastMonthCount} bookings`);
                            $('.pastsixmonths').text(`${bookingObject.lastSixMonthCount} bookings`);
                            $('.lastyear').text(`${bookingObject.lastOneYearCount} bookings`);

                            let airportzoObject = data.airportzo;
                            $('.agentfromairportzo').text(`₹${airportzoObject.balanceFromAirportzo}`);
                            $('.agenttoagents').text(`₹${airportzoObject.toAgents}`);

                        })

            }
            
            let myChartAgent = null;
            function agent_bar_chart(){
                let x = $("#from_date1").val();
                let y = $("#to_date1").val();

                let range = dateRange(new Date(x), new Date(y));

                range = range.map(date => date.toISOString().slice(0, 10));
                if(range.length > 0){
                    let datas = {
                                    "distributorToken": distributorToken,
                                    'ranges' : range
                                };
                    let json1 = JSON.stringify(datas);
                            $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/distributor/dashboardChartDetails_agent.php",
                            data: json1
                            }).done(function(data) {
                                let website_array = data.volumeChartData;
                                let agentwiseArray = data.serviceChartData;
                                let websitewisedata = [];
                                let agentwisedata = [];
                                let overall_label = [];
                                website_array.forEach((web,index) => {
                                    websitewisedata.push(web.data);
                                    overall_label.push(web.dates);
                                });
                                agentwiseArray.forEach((vol,index) => {
                                    agentwisedata.push(vol.data);
                                });
                                
                                const dataBarAgent = {
                                    labels: overall_label,
                                        datasets: [{
                                                    label: 'Website',
                                                    data: websitewisedata,
                                                    borderRadius: 5,
                                                    barPercentage: .6,
                                                    backgroundColor: [
                                                        '#a07deb'
                                                    ],
                                                    borderColor: [
                                                        '#a07deb'
                                                    ],
                                                    borderWidth: 1
                                                 },{
                                                    label: 'Agent',
                                                    data: agentwisedata, 
                                                    borderRadius: 5,
                                                    barPercentage: .6,
                                                    backgroundColor: [
                                                        '#fe773b'
                                                    ],
                                                    borderColor: [
                                                        '#fe773b'
                                                    ],
                                                    borderWidth: 1
                                                 }
                                                ]
                                };

                                // config 
                                const configBarAgent = {
                                    type: 'bar',
                                    data: dataBarAgent,
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                },
                                                beginAtZero: true
                                            },
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                                align: 'end',
                                                labels: {
                                                    usePointStyle: true,
                                                    pointStyle: 'rectRounded',
                                                    padding: 25
                                                }
                                            }
                                        }
                                    }
                                };

                                myChartAgent = new Chart(
                                    document.getElementById('myChartAgent'),
                                    configBarAgent
                                );
                            });
                }else{
                   swal("Enter Valid Date Range"); 
                }
            }
            $('#from_date1, #to_date1').on('change dp.change', function(e){
                if(myChartAgent != null){
                    myChartAgent.destroy();
                    agent_bar_chart();
                }else{
                    agent_bar_chart();
                }
            });
            
            //toggle airline service and volume type chart
            $('body').on('change','.chart-type',function(){
                let airlineChartSelected = $('.chart-type:checked').val();
                if(airlineChartSelected == 'volume'){
                    $('.airlineservice').addClass('hidden');
                    $('.airlinevolume').removeClass('hidden');
                }else{
                    $('.airlinevolume').addClass('hidden');
                    $('.airlineservice').removeClass('hidden');
                }
            });
            const addDays = (date, days = 1) => {
            const result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
              };

            const dateRange = (start, end, range = []) => {
              if (start > end) return range;
              const next = addDays(start, 1);
              return dateRange(next, end, [...range, start]);
            };

    </script>
</body>

</html>
<?php
}
?>