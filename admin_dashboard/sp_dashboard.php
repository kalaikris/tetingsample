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
    <link rel="stylesheet" href="css/sp_dashboard.css?v=<?php echo $cur_date_time; ?>">
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
    <div class="sidebar" id="sidebar2"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="">
            <div class="slider-desc-set">
                <select class="overview-left mb-3" id="service_provider_company_location" onchange="getUpdatedLocationToken()">
                </select> 
                <div class="dashboard-set">
                    <div class="dashboard-box">
                        <div class="dashboard-box-set">
                            <div class="booking-set-1">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Booking Revenue</h5>
                                    <h1 class="total-booking-count" id="booking_revenue"></h1>
                                </div>
                                <img class="b-1" src="https://airportzostage.in/service-provider-dashboard/asset/img/d-1.png"/>
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
                                <img class="b-2" src="https://airportzostage.in/service-provider-dashboard/asset/img/d-2.png">
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
                                <img class="b-3" src="https://airportzostage.in/service-provider-dashboard/asset/img/b-3.png" alt="" srcset="" />
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
                                    <div class="prograss-bar"><div class="prograss-inner5" id="five_star_prograssbar"></div></div>
                                    <div class="prograss-bar"><div class="prograss-inner4" id="four_star_prograssbar"></div></div>
                                    <div class="prograss-bar"><div class="prograss-inner3" id="three_star_prograssbar"></div></div>
                                    <div class="prograss-bar"><div class="prograss-inner2" id="two_star_prograssbar"></div></div>
                                    <div class="prograss-bar"><div class="prograss-inner1" id="single_star_prograssbar"></div></div>
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

                            <div style="display:flex;gap:12px;">
                                <div class="inner-input-field">
                                    <div class="arriving-input-set input-group">
                                        <span class="input-group-addon bg-date"></span>
                                        <div class="date-con">
                                            <label for="from_date">From Date</label>
                                            <input type="text" class="b-input datepicker" id="from_date" placeholder="YYYY-MM-DD" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="inner-input-field">
                                    <div class="arriving-input-set input-group">
                                        <span class="input-group-addon bg-date"></span>
                                        <div class="date-con">
                                            <label for="to_date">To Date</label>
                                            <input type="text" class="b-input datepicker" id="to_date" placeholder="YYYY-MM-DD" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        var apiPath = "<?php echo $apiPath; ?>";
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: apiPath + "/provider/dashboardCompanyLocation.php",
            data: json1,
        }).done(function (data) {
            $("#service_provider_company_location").empty();
            var providerLocation = data.data;
            console.log(providerLocation);
            var providerCompanyLocationdata = '<option value="">Select Your Location</option>';
            for (var key in providerLocation) {
                providerCompanyLocationdata +='<option value="' +providerLocation[key].service__provider_company_location_token +'">' +
                providerLocation[key].service_provider_company_location +
                "</option>";
            }
            $("#service_provider_company_location").html(providerCompanyLocationdata);
            $("#service_provider_company_location")
            .change(function () {})
            .chosen({ allow_single_deselect: true });
            ({
            width: "100%",
            filter: true,
            });
        });

        function getUpdatedLocationToken() {
            var locationToken = $("#service_provider_company_location").val();
            getDashboardEdtails();
            data_fetch("");
        }

        $(document).ready(() => {
            getDashboardEdtails();
            $("#loading").hide();
        });

       function getDashboardEdtails(){
            var datas = {
                'serviceProviderLocationtoken' : $("#service_provider_company_location").val()
            };
            var jsonData = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardHeader.php`,
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
                    $('#five_star_prograssbar,#five_star_prograssbar_full').css('width', `${data.rating.fiveStarPercentage}%`);
                    $('#four_star_review,#four_star_review_full').html(data.rating.fourStarPercentage+' %');
                    $('#four_star_prograssbar,#four_star_prograssbar_full').css('width', `${data.rating.fourStarPercentage}%`);
                    $('#triple_star_review,#triple_star_review_full').html(data.rating.threeStarPercentage+' %');
                    $('#three_star_prograssbar,#three_star_prograssbar_full').css('width', `${data.rating.threeStarPercentage}%`);
                    $('#double_star_review,#double_star_review_full').html(data.rating.twoStarPercentage+' %');
                    $('#two_star_prograssbar,#two_star_prograssbar_full').css('width', `${data.rating.twoStarPercentage}%`);
                    $('#single_star_review,#single_star_review_full').html(data.rating.oneStarPercentage+' %');
                    $('#single_star_prograssbar,#single_star_prograssbar_full').css('width', `${data.rating.oneStarPercentage}%`);
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
                url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardRecentBooking.php`,
                data: jsonData,
                success: view_recent_booking
            });
            let x = $("#from_date").val();
            let y = $("#to_date").val();
            
            let range = dateRange(new Date(x), new Date(y));
          
            range = range.map(date => date.toISOString().slice(0, 10));
            
            const currentYear = new Date().getFullYear();
            const previousYear = currentYear - 1;
            var graphdatas = {
                'serviceProviderLocationtoken' : $("#service_provider_company_location").val(),
                'ranges' : range
            };
            var Json_datas = JSON.stringify(graphdatas);
            $.ajax({
                type : "POST",
                beforeSend: function () { $('#loading').show(); },
                dataType: "json",
                url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardChart.php`,
                data: Json_datas,
                success: view_graph_details
            });
            $('#current_year').val(currentYear);
            $('#previous_year').val(previousYear);
        }

            data_fetch("");
            function data_fetch(type){
                var reviewdatas = {
                    'serviceProviderLocationtoken' : $("#service_provider_company_location").val(),
                    'type': type
                };
                var jsonData = JSON.stringify(reviewdatas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardRecentReviews.php`,
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
                        var today = new Date(graphdata[key].dates);
                        var monthName = today.toLocaleString('default', { month: 'short' });
                        monthNamearray.push(graphdata[key].dates);
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
                        },
                    };
                    if(curveChart != null){
                        curveChart.destroy();
                    }
                    
                    curveChart = new Chart(
                        document.getElementById('curveChart'),
                        configCurve
                    );
                }
                $("#loading").hide();
            }

            function get_year_details(){
                let x = $("#from_date").val();
                let y = $("#to_date").val();

                let range = dateRange(new Date(x), new Date(y));

                range = range.map(date => date.toISOString().slice(0, 10));
                if(range.length > 0){
                   if(curveChart != null){
                        curveChart.destroy();
                        var get__year = $('#get_year').val();
                        var graphdatas = {
                            'serviceProviderLocationtoken' : $("#service_provider_company_location").val(),
                            'ranges' : range
                        }
                        var Json_datas = JSON.stringify(graphdatas);
                        $.ajax({
                            type : "POST",
                            beforeSend: function () { $('#loading').show(); },
                            dataType: "json",
                            url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardChart.php`,
                            data: Json_datas,
                            success: view_graph_details
                        });
                    }
                }else{
                   swal("Enter Valid Date Range"); 
                }
            }
            $('#from_date, #to_date').on('change dp.change', function(e){
                get_year_details();
            });

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
                                                    recentbooklist+=`<span class="upcoming"><img src="../service-provider-dashboard/asset/img/up.png"/>Upcoming</span>`;
                                                }else if(recent_bookingdata[key].status=="Ongoing"){
                                                    recentbooklist+=`<span class="ongoing"><img src="../service-provider-dashboard/asset/img/ong.png"/>Ongoing</span>`;
                                                }else if(recent_bookingdata[key].status=="Completed"){
                                                    recentbooklist+=`<span class="accepted"><img src="../service-provider-dashboard/asset/img/acp.png"/>Completed</span>`;
                                                }else{
                                                    recentbooklist+=`<span class="rejected"><img src="../service-provider-dashboard/asset/img/rej.png"/>Cancelled</span>`;
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
                                                            <img src="${recent_reviewdata[reviewkey].customerImage}" class="flower" alt="" />
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
                    $('#recent_review_list').html(recentreviewlist);
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
                    url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardHeader.php`,
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
                        $('#five_star_prograssbar,#five_star_prograssbar_full').css('width', `${data.rating.fiveStarPercentage}%`);
                        $('#four_star_review,#four_star_review_full').html(data.rating.fourStarPercentage+' %');
                        $('#four_star_prograssbar,#four_star_prograssbar_full').css('width', `${data.rating.fourStarPercentage}%`);
                        $('#triple_star_review,#triple_star_review_full').html(data.rating.threeStarPercentage+' %');
                        $('#three_star_prograssbar,#three_star_prograssbar_full').css('width', `${data.rating.threeStarPercentage}%`);
                        $('#double_star_review,#double_star_review_full').html(data.rating.twoStarPercentage+' %');
                        $('#two_star_prograssbar,#two_star_prograssbar_full').css('width', `${data.rating.twoStarPercentage}%`);
                        $('#single_star_review,#single_star_review_full').html(data.rating.oneStarPercentage+' %');
                        $('#single_star_prograssbar,#single_star_prograssbar_full').css('width', `${data.rating.oneStarPercentage}%`);
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
                    url: `../service-provider-dashboard/${apiPath}/dashboard/dashboardRecentBooking.php`,
                    data: jsonData,
                    success: view_recent_booking
                });
                
                $("#from_date").data("DateTimePicker").date(`${Math.abs(new Date().getFullYear())}-${new Date().getMonth() + 1}-01`);
                $('#to_date').data("DateTimePicker").date(moment(new Date ).format('YYYY-MM-DD'));
                data_fetch("");

                get_year_details();
            }
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