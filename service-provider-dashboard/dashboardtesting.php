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
        <title>airportzo</title>
        <!-- modal-popap-css -->
        <link rel="icon" type="image/png" href="asset/img/airportzo-icon.png" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-icons.css" />
        <!--  data table CSS only -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/commen.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/dashboard.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </head>
    <body id="page">
         <div id="loading"></div>
        <header id="header"></header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar"></div>
                <div class="slider-desc-set">
                    <div class="dashboard-set">
                        <div class="dashboard-box">
                            <div class="dashboard-box-set">
                                <div class="booking-set-1">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Booking Revenue</h5>
                                        <h1 class="total-booking-count" id="booking_revenue"></h1>
                                    </div>
                                    <img class="b-1" src="asset/img/d-1.png"/>
                                </div>
                                <div class="booking-set-1">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Realized Revenue</h5>
                                        <h1 class="total-booking-count" id="realized_revenue"></h1>
                                    </div>
                                </div>
                                <div class="booking-set-1">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Unrealized Revenue</h5>
                                        <h1 class="total-booking-count" id="unrealized_revenue"></h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="dashboard-box">
                            <div class="dashboard-box-set">
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Total bookings</h5>
                                        <h1 class="total-booking-count" id="total_booking"></h1>
                                    </div>
                                    <img class="b-2" src="asset/img/d-2.png">
                                </div>
                                <div class="month-booking">
                                    <ul class="month-set">
                                        <li class="month-cap">This month</li>
                                        <li class="month-cap">Last month</li>
                                        <li class="month-cap">Past 6 months</li>
                                        <li class="month-cap">Last year</li>
                                    </ul>
                                    <ul class="month-booking-set">
                                        <li class="booking-cap" id="current_month_earning"></li>
                                        <li class="booking-cap" id="last_month_earning"></li>
                                        <li class="booking-cap" id="past_six_month_earning"></li>
                                        <li class="booking-cap" id="last_year_month_earning"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-box">
                            <div class="dashboard-box-set">
                                <div class="rating-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Rating out of 5</h5>
                                        <h1 class="total-booking-count" id="total_ratings"></h1>
                                        <small class="rating-cust" id="customer_ratings"></small>
                                    </div>
                                    <img class="b-3" src="asset/img/b-3.png" alt="" srcset="" />
                                </div>
                                <div class="month-booking">
                                    <ul class="month-set">
                                        <li class="month-cap">5 star</li>
                                        <li class="month-cap">4 star</li>
                                        <li class="month-cap">3 star</li>
                                        <li class="month-cap">2 star</li>
                                        <li class="month-cap">1 star</li>
                                    </ul>
                                    <div class="prograss-set">
                                        <div class="prograss-bar"><div class="prograss-inner5"></div></div>
                                        <div class="prograss-bar"><div class="prograss-inner4"></div></div>
                                        <div class="prograss-bar"><div class="prograss-inner3"></div></div>
                                        <div class="prograss-bar"><div class="prograss-inner2"></div></div>
                                        <div class="prograss-bar"><div class="prograss-inner1"></div></div>
                                    </div>
                                    <ul class="month-booking-set">
                                        <li class="booking-cap"><span class="month-booking-count" id="five_star_review"></span></li>
                                        <li class="booking-cap"><span class="month-booking-count" id="four_star_review"></span></li>
                                        <li class="booking-cap"><span class="month-booking-count" id="triple_star_review"></span></li>
                                        <li class="booking-cap"><span class="month-booking-count" id="double_star_review"></span></li>
                                        <li class="booking-cap"><span class="month-booking-count" id="single_star_review"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- chart analytics section -->
                    <div class="booking-analytics-set">
                        <div class="booking-overview">
                            <div class="booking-head">
                                <h5 class="overview-cont">Booking Overview</h5>
                                <select class="overview-left" id="get_year" onchange="get_year_details()">
                                    <option id="current_year">This year</option>
                                    <option id="previous_year">Last year</option>
                                </select>
                            </div>
                            <div style="width: 100%;">
                              <canvas id="curveChart"></canvas>
                            </div>
                        </div>
                        <div class="popular-solt" style="display: none;">
                            <div class="over-head">
                                <h5 class="overview-cont">Popular Slot</h5>
                                <select class="overview-left" name="" id="">
                                    <option value="thisyear">This year</option>
                                    <option value="thisyear">Last year</option>
                                </select>
                            </div>
                            <div style="width:100%;max-width:300px;margin:0 auto;">
                              <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="view-table-set">
                        <div class="view-table-lefet">
                            <div class="viwe-cont-lefet">
                                <h5 class="overview-cont">Recent Bookings</h5>
                                <a href="booking.php" class="nav-link">View all ></a>
                            </div>
                            <div class="table-section-set">
                                <table class="td-style">
                                    <tbody class="table-body-set" id="recent_booking_list"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="view-table-rghit">
                            <div class="box1">
                                <div class="viwe-cont">
                                    <h5 class="overview-cont">Recent Reviews</h5>
                                    <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModalCenter" id="deafultshowall">View all ></a>
                                </div>
                                <div class="review-content-set">
                                    <table class="td-style">
                                        <tbody class="table-body-set" id="recent_review_list"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Recent Review Modal-->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="dashboard-pop-box">
                                <div class="dashboard-pop-set">
                                    <div class="right-side-pop">
                                        <div class="star-img">
                                            <img src="asset/img/b-3.png" class="star-icon" alt="" srcset="" />
                                        </div>
                                        <div class="rating-pop-set">
                                            <div class="booking-pop-inner">
                                                <h5 class="total-bookin-tital-pop">Rating out of 5</h5>
                                                <h1 class="total-booking-count-pop" id="total_ratings_full"></h1>
                                                <small class="rating-cust-pop" id="customer_ratings_full"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="month-booking-pop">
                                        <ul class="month-set">
                                            <li class="month-cap">5 star</li>
                                            <li class="month-cap">4 star</li>
                                            <li class="month-cap">3 star</li>
                                            <li class="month-cap">2 star</li>
                                            <li class="month-cap">1 star</li>
                                        </ul>
                                        <div class="prograss-set">
                                            <div class="prograss-bar">
                                                <div class="prograss-inner5"></div>
                                            </div>
                                            <div class="prograss-bar">
                                                <div class="prograss-inner4"></div>
                                            </div>
                                            <div class="prograss-bar">
                                                <div class="prograss-inner3"></div>
                                            </div>
                                            <div class="prograss-bar">
                                                <div class="prograss-inner2"></div>
                                            </div>
                                            <div class="prograss-bar">
                                                <div class="prograss-inner1"></div>
                                            </div>
                                        </div>
                                        <ul class="month-booking-set">
                                            <li class="booking-cap"><span class="month-booking-pop-count" id="five_star_review_full"></span></li>
                                            <li class="booking-cap"><span class="month-booking-pop-count" id="four_star_review_full"></span></li>
                                            <li class="booking-cap"><span class="month-booking-pop-count" id="triple_star_review_full"></span></li>
                                            <li class="booking-cap"><span class="month-booking-pop-count" id="double_star_review_full"></span></li>
                                            <li class="booking-cap"><span class="month-booking-pop-count" id="single_star_review_full"></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="close size" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="box">
                                <select class="header" id="reviewratings">
                                    <option value="show_all">Show All</option>
                                    <option value="5">5 Star</option>
                                    <option value="4">4 Star</option>
                                    <option value="3">3 Star</option>
                                    <option value="2">2 Star</option>
                                    <option value="1">1 Star</option>
                                </select>
                                <div class="line"></div>
                                <div class="center-single-line">
                                    <table class="td-style">
                                        <tbody class="table-body-set" id="full_review_list"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- jquery -->
        <script src='js/jquery.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- sidebar-heder -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
        <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
        <script>
            var apiPath = "<?php echo $apiPath; ?>";
            $(document).ready(() => {
                var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
                serviceprovider_sidemenu(staff_token);
                $("#dashboard").addClass("actives");
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderLocationtoken' : companylocation_token
                };
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: `${apiPath}/dashboard/dashboardHeader.php`,
                    data: jsonData,
                }).done(function (data){
                    if(data.status_code==201){
                        let IndianCurrency = Intl.NumberFormat("en-IN", {
                            style: "currency",
                            currency: "INR",
                        });
                        $('#booking_revenue').html(IndianCurrency.format(data.revenue.bookedRevenue));
                        $('#realized_revenue').html(IndianCurrency.format(data.revenue.realisedRevenue));
                        $('#unrealized_revenue').html(IndianCurrency.format(data.revenue.unRealisedRevenue));

                        $('#total_booking').html(data.booking.totalCount);
                        $('#current_month_earning').html(data.booking.thisMonthCount+' bookings');
                        $('#last_month_earning').html(data.booking.lastMonthCount+' bookings');
                        $('#past_six_month_earning').html(data.booking.lastSixMonthCount+' bookings');
                        $('#last_year_month_earning').html(data.booking.lastOneYearCount+' bookings');

                        $('#total_ratings,#total_ratings_full').html(data.rating.totalRatedUser+' Star');
                        $('#customer_ratings,#customer_ratings_full').html(data.rating.averageRating+' customer ratings');
                        $('#five_star_review,#five_star_review_full').html(data.rating.fiveStarPercentage+' %');
                        $('#four_star_review,#four_star_review_full').html(data.rating.fourStarPercentage+' %');
                        $('#triple_star_review,#triple_star_review_full').html(data.rating.threeStarPercentage+' %');
                        $('#double_star_review,#double_star_review_full').html(data.rating.twoStarPercentage+' %');
                        $('#single_star_review,#single_star_review_full').html(data.rating.oneStarPercentage+' %');
                    }else{
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok"
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: `${apiPath}/dashboard/dashboardRecentBooking.php`,
                    data: jsonData,
                    success: view_recent_booking
                });

                const currentYear = new Date().getFullYear();
                const previousYear = currentYear - 1;
                var graphdatas = {
                    'serviceProviderLocationtoken' : companylocation_token,
                    'year' : currentYear
                }
                var Json_datas = JSON.stringify(graphdatas);
                $.ajax({
                    type : "POST",
                    dataType: "json",
                    url: `${apiPath}/dashboard/dashboardChart.php`,
                    data: Json_datas,
                    success: view_graph_details
                });
                $('#current_year').val(currentYear);
                $('#previous_year').val(previousYear);
            });

            $("#reviewratings").change(function(){
                var ratingdropdown = $('#reviewratings').val();
                data_fetch(ratingdropdown);
            });

            data_fetch("");
            $('body').on('click','#deafultshowall',function(){
                data_fetch('show_all');
            });
            function data_fetch(type){
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var ratingdropdown = $('#reviewratings').val();
                var reviewdatas = {
                    'serviceProviderLocationtoken' : companylocation_token,
                    'type': type
                };
                var jsonData = JSON.stringify(reviewdatas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: `${apiPath}/dashboard/dashboardRecentReviews.php`,
                    data: jsonData,
                    success: view_recent_review
                });
            }

            let curveChart = null;
            function view_graph_details(datas){
                if(datas.status_code == "201"){
                    var graphdata = datas.reviews;
                    var monthNamearray = [];
                    var bookingcountarray = [];
                    for(var key in graphdata){
                        var today = new Date(graphdata[key].month);
                        var monthName = today.toLocaleString('default', { month: 'short' });
                        monthNamearray.push(monthName);
                        bookingcountarray.push(graphdata[key].data)
                    }
                    const data = {
                        labels: monthNamearray,
                        datasets: [{
                        label: 'Booking History',
                        fill: 'origin',
                        backgroundColor: 'rgba(241, 237, 252, 0.5)',
                        borderColor: '#947bca',
                        data: bookingcountarray,
                        tension: 0.4,
                        }]
                    };
                    const configCurve = {
                        type: 'line',
                        data: data,
                        options: {
                            scales: {
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
                }
            }

            function get_year_details(){
                if(curveChart != null){
                    curveChart.destroy();
                    var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    if(service_provider_companylocation_token == null){
                        var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                    }else{
                        var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    }
                    var get__year = $('#get_year').val();
                    var graphdatas = {
                        'serviceProviderLocationtoken' : companylocation_token,
                        'year' : get__year
                    }
                    var Json_datas = JSON.stringify(graphdatas);
                    $.ajax({
                        type : "POST",
                        dataType: "json",
                        url: `${apiPath}/dashboard/dashboardChart.php`,
                        data: Json_datas,
                        success: view_graph_details
                    });
                }
            }

            // doughnut chart
            const datHoursDoughnut = {
                labels: ['1hour slot', '2hour slot', '4hour slot', '6hour slot'],
                    datasets: [{
                    label: 'hourslot',
                    data: [5, 3, 4, 2],
                    backgroundColor: [
                        '#57c78f',
                        '#fd7837',
                        '#52c0ef',
                        '#a17deb'
                    ],
                    borderColor: [
                        '#57c78f',
                        '#fd7837',
                        '#52c0ef',
                        '#a17deb'
                    ],
                    borderWidth: 1,
                    cutout: '80%',
                    borderRadius: 20,
                    offset: 30
                    }]
            };

            const stackedText = {
                id: 'stackedText',
                afterDatasetsDraw(chart, args, options){
                    const {ctx, chartArea: {top, bottom, left, right, width, height}} = 
                    chart;

                    ctx.save();
                    ctx.font = 'bolder 22px sans-serif';
                    ctx.fillStyle =  '#000';
                    ctx.textAlign = 'center';
                    ctx.fillText('145 hrs', width / 2, height / 2 + top);
                    ctx.restore();

                }
            };

            // config 
            const configDoughnut = {
                type: 'doughnut',
                data: datHoursDoughnut,
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
                            padding: 30
                        }
                    }
                }
                },
                plugins: [stackedText]
            };
            
            const doughnutChart = new Chart(
                document.getElementById('doughnutChart'),
                configDoughnut
            );

            function view_recent_booking(data){
                if(data.status_code==201){
                    var recent_bookingdata = data.bookings;
                    var recentbooklist = "";
                    for(var key in recent_bookingdata){
                        recentbooklist+=`<tr>
                                            <td class="td-bule">
                                                <span class="bule-color">${recent_bookingdata[key].bookingNumber}</span><br>
                                                <span>${recent_bookingdata[key].customerName}</span><br/>
                                                <small>${recent_bookingdata[key].memberCount}</small>
                                            </td>
                                            <td>
                                                ${recent_bookingdata[key].createdDate}<br />
                                                <small>${recent_bookingdata[key].createdTime}</small>
                                            </td>
                                            <td>
                                                <div class="lable-alert">`;
                                                if(recent_bookingdata[key].status=="Pending"){
                                                    recentbooklist+=`<span class="upcoming"><img src="asset/img/up.png"/>Upcoming</span>`;
                                                }else if(recent_bookingdata[key].status=="Ongoing"){
                                                    recentbooklist+=`<span class="ongoing"><img src="asset/img/ong.png"/>Ongoing</span>`;
                                                }else if(recent_bookingdata[key].status=="Completed"){
                                                    recentbooklist+=`<span class="accepted"><img src="asset/img/acp.png"/>Completed</span>`;
                                                }else{
                                                    recentbooklist+=`<span class="rejected"><img src="asset/img/rej.png"/>Cancelled</span>`;
                                                }
                                                    recentbooklist+=`<span>₹ ${recent_bookingdata[key].amount}</span>
                                                </div>
                                            </td>
                                        </tr>`;
                    }
                    $('#recent_booking_list').html(recentbooklist);
                }
            }

            function view_recent_review(data){
                if(data.status_code == 201){
                    var recent_reviewdata = data.reviews;
                    var recentreviewlist = "";
                    for (var reviewkey in recent_reviewdata){
                        recentreviewlist+=` <div class="content1">
                                                <div class="center-point1">
                                                    <div class="warron-bio1">
                                                        <div class="warron-img">
                                                            <img src="${recent_reviewdata[reviewkey].customerImage}" style="height:75px" class="flower" alt="" />
                                                        </div>
                                                        <div class="clint-name">
                                                            <h5>${recent_reviewdata[reviewkey].customerName}</h5>`;
                                                            if(recent_reviewdata[reviewkey].rating=="0"){
                                                                recentreviewlist+=`<span">-</span>`;                
                                                            }else if(recent_reviewdata[reviewkey].rating=="1"){
                                                                recentreviewlist+=`<span class="fa fa-star checked"></span>`;                
                                                            }else if(recent_reviewdata[reviewkey].rating=="2"){
                                                                recentreviewlist+=`<span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>`;                
                                                            }else if(recent_reviewdata[reviewkey].rating=="3"){
                                                                recentreviewlist+=`<span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>`;                
                                                            }else if(recent_reviewdata[reviewkey].rating=="4"){
                                                                recentreviewlist+=`<span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>`;                
                                                            }else{
                                                                recentreviewlist+=`<span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>
                                                                                   <span class="fa fa-star checked"></span>`;
                                                            }
                                        recentreviewlist+=`</div>
                                                    </div>
                                                    <div class="joi-date1">${recent_reviewdata[reviewkey].createdDate}</div>
                                                </div>
                                                <div class="parag-warron">
                                                    <p class="font-letter1">${recent_reviewdata[reviewkey].review}</p>
                                                </div>
                                            </div>`;
                    }
                    $('#recent_review_list,#full_review_list').html(recentreviewlist);
                }
            }
            
            function service_provider_list(companylocation_token){
                var datas = {
                    'serviceProviderLocationtoken' : companylocation_token
                };
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: `${apiPath}/dashboard/dashboardHeader.php`,
                    data: jsonData,
                }).done(function (data){
                    if(data.status_code==201){
                        let IndianCurrency = Intl.NumberFormat("en-IN", {
                            style: "currency",
                            currency: "INR",
                        });
                        $('#booking_revenue').html(IndianCurrency.format(data.revenue.bookedRevenue));
                        $('#realized_revenue').html(IndianCurrency.format(data.revenue.realisedRevenue));
                        $('#unrealized_revenue').html(IndianCurrency.format(data.revenue.unRealisedRevenue));

                        $('#total_booking').html(data.booking.totalCount);
                        $('#current_month_earning').html(data.booking.thisMonthCount+' bookings');
                        $('#last_month_earning').html(data.booking.lastMonthCount+' bookings');
                        $('#past_six_month_earning').html(data.booking.lastSixMonthCount+' bookings');
                        $('#last_year_month_earning').html(data.booking.lastOneYearCount+' bookings');

                        $('#total_ratings,#total_ratings_full').html(data.rating.totalRatedUser+' Star');
                        $('#customer_ratings,#customer_ratings_full').html(data.rating.averageRating+' customer ratings');
                        $('#five_star_review,#five_star_review_full').html(data.rating.fiveStarPercentage+' %');
                        $('#four_star_review,#four_star_review_full').html(data.rating.fourStarPercentage+' %');
                        $('#triple_star_review,#triple_star_review_full').html(data.rating.threeStarPercentage+' %');
                        $('#double_star_review,#double_star_review_full').html(data.rating.twoStarPercentage+' %');
                        $('#single_star_review,#single_star_review_full').html(data.rating.oneStarPercentage+' %');
                    }else{
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok"
                        });
                    }
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: `${apiPath}/dashboard/dashboardRecentBooking.php`,
                    data: jsonData,
                    success: view_recent_booking
                });
            }
        </script>
    </body>
</html>
<?php
}
?>