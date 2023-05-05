<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whitelabeling | Agent dashboard</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/dashboard.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/agent-dashboard.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <!-- <div id="loading"></div> -->

    <nav></nav> <!-- NAV MENU -->

    <section class="agent-dashboard-body">
        <input type="hidden" id="gtag_id">
        <div class="agent-dashboard-container">
            <aside class="agent-dashboard-sidebar"></aside> <!-- SIDE MENU -->
            <main class="main-content">
                <div class="dashboard-content-box">
                    <ul class="nav nav-tabs ser-ab-review-tab hidden">
                        <li class="active">
                            <a data-toggle="tab" href="#alltime">All time</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#current-month" class="">This month</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="alltime" class="tab-pane fade in active">
                            <div class="dashboard-display-cards">
                                <div class="dashboard-box">
                                    <div class="dashboard-box-set">
                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Booked Revenue</h5>
                                                <h1 class="total-booking-count"><span id="overall-revenue">-</span></h1>
                                            </div>
                                            <img class="b-2" src="asset/dashboard/booked-revenue.svg" alt="">
                                        </div>
                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Realized Revenue</h5>
                                                <h1 class="total-booking-count"><span id="realized-revenue">-</span></h1>
                                            </div>
                                        </div>

                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Unrealized Revenue</h5>
                                                <h1 class="total-booking-count"><span id="unrealized-revenue">-</span></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboard-box total-booking-box">
                                    <div class="dashboard-box-set">
                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Total bookings</h5>
                                                <h1 class="total-booking-count"><span class="total-done-booking-count">-</span></h1>
                                            </div>
                                            <img class="b-1" src="asset/dashboard/total-booking.svg" alt="">
                                        </div>
                                        <div class="month-booking">
                                            <ul class="month-set">
                                                <li class="month-cap">This month</li>
                                                <li class="month-cap">last month</li>
                                                <li class="month-cap">past 6 months</li>
                                                <li class="month-cap">Last year</li>
                                            </ul>
                                            <ul class="month-booking-set">
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-this-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-6-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-year">0</span> booking(s)</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboard-box commission-box hidden">
                                    <div class="dashboard-box-set">
                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Yearly Target</h5>
                                                <p class="from-airport">(15% commission)</p>
                                                <p class="total-booking-count">
                                                    <span class="total-done-booking-count"> / 50,000
                                                </p>
                                            </div>
                                            <img class="b-2" src="asset/dashboard/commission.svg" alt="">
                                        </div>
                                        <div class="prograss-bar">
                                            <div class="prograss-inner"></div>
                                        </div>
                                        <div class="month-booking">
                                            <ul class="month-set">
                                                <li class="month-cap">This month</li>
                                                <li class="month-cap">last month</li>
                                                <li class="month-cap">past 6 months</li>
                                                <li class="month-cap">Last year</li>
                                            </ul>
                                            <ul class="month-booking-set">
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-this-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-6-month">0</span> booking(s)</span></li>
                                                <li class="booking-cap"><span class="month-booking-count"><span class="booking-last-year">0</span> booking(s)</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboard-box commission-box hidden">
                                    <div class="dashboard-box-set">
                                        <div class="booking-set">
                                            <div class="booking-inner">
                                                <h5 class="total-bookin-tital">Incentive</h5>
                                                <p class="from-airport">(2% commission)</p>
                                                <p class="total-booking-count">
                                                    <span class="total-done-booking-count">1,643</span> / 2,000
                                                </p>
                                            </div>
                                            <img class="b-2" src="asset/dashboard/commission.svg" alt="">
                                        </div>
                                        <div class="prograss-bar">
                                            <div class="prograss-inner"></div>
                                        </div>
                                        <div class="month-booking">
                                            <ul class="month-set">
                                                <li class="month-cap">0 - 1,000 (0.5%)</li>
                                                <li class="month-cap">1,001 - 2,000 (2%)</li>
                                                <li class="month-cap">2,001 - 3,000 (7%)</li>
                                                <li class="month-cap">3,001 - 4,000 (10%)</li>
                                            </ul>
                                            <ul class="month-booking-set">
                                                <li class="booking-cap">
                                                    <span class="month-booking-count">₹ 23,637</span>
                                                </li>
                                                <li class="booking-cap">
                                                    <span class="month-booking-count">₹ 4,637</span>
                                                </li>
                                                <li class="booking-cap">
                                                    <span class="month-booking-count">₹ 0</span>
                                                </li>
                                                <li class="booking-cap">
                                                    <span class="month-booking-count">₹ 0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- chart analytics section -->
                            <div class="dashboard-chart-container hidden">
                                <div class="booking-analytics-set">
                                    <div class="booking-overview">
                                        <div class="booking-head">
                                            <div class="">
                                                <h5 class="overview-cont">Booking Overview</h5>
                                                <div class="choose-chart-type">
                                                    <div class="">
                                                        <input id="byvolume" type="radio" name="chart-type" class="form_input-radio" checked="checked" onclick="changeChartView()" value="vol">
                                                        <label for="byvolume" class="form_radio-label">By Volume</label>
                                                    </div>
                                                    <div>
                                                        <input id="byservicetype" type="radio" name="chart-type" class="form_input-radio" onclick="changeChartView()" value="amount">
                                                        <label for="byservicetype" class="form_radio-label">By Revenue</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <select class="overview-left" onchange="changeChartView()" id="airlinebarchartyear">
                                                <option value="this">This year</option>
                                                <option value="last">Last year</option>
                                            </select>
                                        </div>
                                        <div>
                                            <canvas id="waveChart-this-vol" style="display: none;"></canvas>
                                            <canvas id="waveChart-this-amount" style="display: none;"></canvas>
                                            <canvas id="waveChart-last-vol" style="display: none;"></canvas>
                                            <canvas id="waveChart-last-amount" style="display: none;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="view-table-set">
                                <div class="view-table-lefet" style="width: 100%">
                                    <div class="viwe-cont-lefet">
                                        <h5 class="overview-cont">Recent Bookings</h5>
                                        <a href="agent-bookings" class="nav-link sec-color">View all ></a>
                                    </div>
                                    <div class="table-section-set" id="booking-history-table">
                                        <!-- <table class="td-style airportrecentbookings">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">
                                                        <div>
                                                            <span class="sec-color">W9767</span>
                                                            <span class="widget upcoming">
                                                                <img src="asset/mybooking/upcoming.svg">Upcoming
                                                            </span>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-body-set">
                                                <tr>
                                                    <td class="td-bule">
                                                        <span>Alejandro Cain</span><br />
                                                        <small>2Adults | 1 child</small>
                                                    </td>
                                                    <td>
                                                        <span>04 Jul,2022</span><br />
                                                        <small>05:00 PM</small>
                                                    </td>
                                                    <td>
                                                        <span>2 Services</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> -->
                                    </div>
                                </div>
                                <div class="view-table-rghit hidden">
                                    <div class="box1">
                                        <div class="viwe-cont">
                                            <h5 class="overview-cont">Total
                                                Loyal Customers</h5>
                                            <a href="#" class="nav-link sec-color">View all ></a>
                                        </div>
                                        <div>
                                            <div class="customer-detail-box">
                                                <div class="customer-detail">
                                                    <p>Mr.Alejandro Cain</p>
                                                    <span>+91 234567345</span> <span>|</span> <span>asdlka@gamil.com</span>
                                                </div>
                                                <p class="total-bookings"><span>465</span> bookings<br></p>
                                            </div>
                                            <div class="customer-detail-box">
                                                <div class="customer-detail">
                                                    <p>Mr.Alejandro Cain</p>
                                                    <span>+91 234567345</span> <span>|</span> <span>asdlka@gamil.com</span>
                                                </div>
                                                <p class="total-bookings"><span>465</span> bookings<br></p>
                                            </div>
                                            <div class="customer-detail-box">
                                                <div class="customer-detail">
                                                    <p>Mr.Alejandro Cain</p>
                                                    <span>+91 234567345</span> <span>|</span> <span>asdlka@gamil.com</span>
                                                </div>
                                                <p class="total-bookings"><span>465</span> bookings<br></p>
                                            </div>
                                            <div class="customer-detail-box">
                                                <div class="customer-detail">
                                                    <p>Mr.Alejandro Cain</p>
                                                    <span>+91 234567345</span> <span>|</span> <span>asdlka@gamil.com</span>
                                                </div>
                                                <p class="total-bookings"><span>465</span> bookings<br></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="current-month" class="tab-pane fade">
                            this month
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/custom.js<?php echo $cache_str; ?>"></script>

    <script>
        $('.nav-dash').text("Website");
        $('.nav-dash').attr("href", "index");
        // CHART JS
        //curve chart
        const labels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        $(document).ready(function() {
            var userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                window.location.href = "index.php";
            } else {
                // $.ajax({
                //     async: false,
                //     url: 'php/users-booking/read-revenue.php',
                //     type: 'GET',
                //     dataType: 'JSON',
                //     success: function(response) {
                //         if (response.status_code == 200) {
                //             var responseData = response.data;

                //             var revenueData = responseData.revenue_data;
                //             var graphData = responseData.graph_data;

                //             var thisVolData = genChartData(graphData.this__year, "total_service");
                //             const curveChart1 = new Chart(document.getElementById('waveChart-this-vol'), thisVolData);

                //             var thisRevData = genChartData(graphData.this__year, "total_amount");
                //             const curveChart2 = new Chart(document.getElementById('waveChart-this-amount'), thisRevData);

                //             var lastVolData = genChartData(graphData.last__year, "total_service");
                //             const curveChart3 = new Chart(document.getElementById('waveChart-last-vol'), lastVolData);

                //             var lastRevData = genChartData(graphData.last__year, "total_amount");
                //             const curveChart4 = new Chart(document.getElementById('waveChart-last-amount'), lastRevData);

                //             changeChartView();

                //             $('#overall-revenue').text("₹ " + revenueData.over_all.total_amount);
                //             $('.total-done-booking-count').text(revenueData.over_all.total_booking);

                //             $('.booking-this-month').text(revenueData.this_month.total_booking);
                //             $('.booking-last-month').text(revenueData.last_month.total_booking);
                //             $('.booking-last-6-month').text(revenueData.last_6_mon.total_booking);
                //             $('.booking-last-year').text(revenueData.last__year.total_booking);
                //         } else {
                //             swal("", response.message, "error");
                //         }
                //     },
                //     error: function(error) {
                //         console.log(error);
                //     }
                // });
                $.ajax({
                    async: false,
                    url: 'php/users-booking/read-revenue-new.php',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response;

                            var revenueData = responseData.revenue;
                            var bookingData = responseData.booking;

                            $('#overall-revenue').text("₹ " + revenueData.bookedRevenue);
                            $('#realized-revenue').text("₹ " + revenueData.realisedRevenue);
                            $('#unrealized-revenue').text("₹ " + revenueData.unRealisedRevenue);
                            $('.total-done-booking-count').text(bookingData.totalCount);

                            $('.booking-this-month').text(bookingData.thisMonthCount);
                            $('.booking-last-month').text(bookingData.lastMonthCount);
                            $('.booking-last-6-month').text(bookingData.lastSixMonthCount);
                            $('.booking-last-year').text(bookingData.lastOneYearCount);
                        } else {
                            swal("", response.message, "error");
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                $.ajax({
                    async: false,
                    type: 'GET',
                    url: 'php/users-booking/read-recent-history.php',
                    dataType: 'JSON',
                    success: function(response) {
                        refreshTable(response);
                    }
                });
            }
        });
        
        function refreshTable(response) {
            $('#booking-table > tbody').html();
            var ongoingBooking = 0;
            var upcomingBooking = 0;
            var completedBooking = 0;
            var cancelledBooking = 0;
            var totalBooking = 0;

            if (response.status_code == 200) {
                var responseData = response.data;

                responseData.forEach(function(orderData, orderKey) {
                    if (orderData.for_others) {
                        totalBooking++;

                        var passengerDetail = [];
                        var adultCount = parseInt(orderData.total_adult);
                        var childrenCount = parseInt(orderData.total_children);
                        if (adultCount) {
                            var pluralView = (adultCount > 1)? ` Adults`:` Adult`;
                            passengerDetail.push(adultCount + pluralView);
                        }
                        if (childrenCount) {
                            var pluralView = (adultCount > 1)? ` Children`:` Child`;
                            passengerDetail.push(childrenCount + pluralView);
                        }
                        var passengerView = passengerDetail.join(" | ");

                        var serviceArr = [];
                        orderData.services.forEach(function (serviceObj) {
                            serviceArr.push(`<span>${serviceObj}</span>`);
                        });
                        serviceArr = [];

                        $('#booking-history-table').append(`<table class="td-style airportrecentbookings">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <div>
                                            <span class="sec-color">${orderData.booking_number}</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-body-set">
                                <tr>
                                    <td class="td-bule">
                                        <span>${orderData.customer_name}</span><br />
                                        <small>${passengerView}</small>
                                    </td>
                                    <td>
                                        <span>${orderData.date_time}</span><br />
                                        <small>${orderData.booking_time}</small>
                                    </td>
                                    <td>
                                        <span>${orderData.total_service} Service(s)</span><br />
                                        <small>${serviceArr.join('<br/>')}</small>
                                    </td>
                                    <td>
                                        <span>${orderData.service_providers.join('<br/>')}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>`);
                    }
                    $('.ongoingcount').text(ongoingBooking);
                    $('.upcomingcount').text(upcomingBooking);
                    $('.completedcount').text(completedBooking);
                    $('.cancelledcount').text(cancelledBooking);
                });
                if (totalBooking == 0) {
                    $('#booking-table > tbody').append(`<tr><td colspan=6><center>No bookings found</center></td></tr>`);
                }
            } else {
                swal("", response.message, "error");
            }
            
        }

        function genChartData(graphValue, dataType) {
            var chartPointLabel = '';
            if (dataType == 'total_service') {
                chartPointLabel = 'Total Services';
            } else {
                chartPointLabel = 'Total Revenue';
            }
            var chartData = [];
            graphValue.forEach(graphElement => {
                chartData.push(graphElement[dataType]);
            });
            var data = {
                labels: labels,
                datasets: [{
                    label: chartPointLabel,
                    fill: 'origin',
                    backgroundColor: 'rgba(241, 237, 252, 0.5)',
                    borderColor: '#947bca',
                    data: chartData,//[10, 20, 30, 2, 46, 30, 6, 15, 12, 5, 3, 18],
                    tension: 0.4,
                }]
            };

            var configCurve = {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };

            return configCurve;
        }

        function changeChartView() {
            var yearType = $('#airlinebarchartyear').val();
            var dataType = $("input[type='radio'][name='chart-type']:checked").val();

            $('canvas').css('display', 'none');
            $('#waveChart-' + yearType + '-' + dataType).css('display', 'block');
        }
    </script>
</body>

</html>