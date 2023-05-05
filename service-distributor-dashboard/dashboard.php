<?php
include_once '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>airportzo</title>
        <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
        <!-- modal-popap-css -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <!--  data table CSS only -->
        <link rel="stylesheet" href="./js/data-table-css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css"/>
        <!-- custm css -->
        <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
        <!-- <link rel="stylesheet" href="./css/booklist.css" /> -->
        <!-- fonts famaly -->
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/dashboard.css">
        <link rel="stylesheet" href="./css/custom.css">

    </head>
      <!-- page loader -->
 
    <body id="page">
        <div id="loading"></div>
        <header id="header">

        </header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar">
                </div>
                <div class="slider-desc-set">
                    <div class="dashboard-set">
                        <div class="dashboard-box">
                            <div class="dashboard-box-set">
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Realized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="realizedrevenue">₹1,74,863</span></h1>
                                    </div>
                                    <img class="b-2" src="./asset/img/b-4.png"
                                        alt=""
                                        srcset="">
                                </div>
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Unrealized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="unrealizedrevenue">₹2,74,863</span></h1>
                                    </div>
                                </div>

                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Booking
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="bookingrevenue">₹2,74,863</span></h1>
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
                                                class="month-booking-count thismonth">28
                                                bookings</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count lastmonth">53
                                                bookings</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count pastsixmonths">272
                                                bookings</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count lastyear">18
                                                bookings</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-box" id="airlineoutstanding">
                            <div class="dashboard-box-set">
                                <div class="booking-set-1">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Balance from Airportzo</h5>
                                        <h1 class="total-booking-count"> ₹<span class="airportzototalbalance">86,847</span></h1>
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
                                                class="month-booking-count airportzothismonth">₹2,748</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count airportzolastmonth">₹2,748</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count airportzosixmonths">₹2,748</span></li>
                                        <li class="booking-cap"><span
                                                class="month-booking-count airportzolastyear">₹2,748</span></li>
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
                                        <h1 class="total-booking-count"><span class="agentfromairportzo">+
                                                ₹2,74,863</span></h1>
                                    </div>
                                    <img class="b-2" src="./asset/img/hand.png"
                                        alt=""
                                        srcset="">
                                </div>
                                <div class="booking-set-2">
                                    <div class="booking-inner">
                                        <p class="from-airport">To agents</p>
                                        <h1 class="total-booking-count"><span class="agenttoagents">+
                                                ₹2,74,863</span></h1>
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
                                    <!--<select class="overview-left" name="" id="airlinebarchartyear">
                                        <option value="thisyear">This year</option>
                                        <option value="thisyear">Last year</option>
                                    </select>-->
                                    
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
                                <div class="airlineservice hidden">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="airlinevolume">
                                    <canvas id="curveChart"></canvas>
                                </div>
                                <!-- <div id="chartContainer" style="height: 360px;
                                    width: 100%;"></div> -->
                                <div class="hide"></div>
                            </div>
                        </div>

                        <div class="view-table-set">
                            <div class="view-table-lefet">
                                <div class="viwe-cont-lefet">
                                    <h5 class="overview-cont">Recent Bookings</h5>
                                    <a href="booking.php" class="nav-link bule-color">View all ></a>
                                </div>
                                <div class="table-section-set">
                                    <table class="td-style airportrecentbookings">
                                        <tbody class="table-body-set">
                                            <tr>
                                                <td class="td-bule">
                                                    <span class="bule-color">W9767</span><br>
                                                    <span>Alejandro Cain</span><br/>
                                                    <small>2Adults | 1 child</small>
                                                </td>
                                                <td>
                                                    04 Jul,2022<br />
                                                    <small>05:00 PM</small>
                                                </td>
                                                <td>
                                                    <div class="lable-alert">
                                                        <div class="controle-lable">
                                                            <span class="upcoming">
                                                                <img src="./asset/img/up.png">Upcoming
                                                            </span>
                                                        </div>
                                                        <span>2 Services</span>
                                                    </div>
                                                </td>
                                            </tr>
                                                <tr>
                                                    <td class="td-bule">
                                                        <span class="bule-color">W9767</span><br>
                                                        <span>Alejandro Cain</span><br/>
                                                        <small>2Adults | 1 child</small>
                                                    </td>
                                                    <td>
                                                        04 Jul,2022<br/>
                                                        <small>05:00 PM</small>
                                                    </td>
                                                    <td>
                                                        <div class="lable-alert">
                                                            <div class="controle-lable">
                                                                <span class="ongoing">
                                                                    <img src="./asset/img/ong.png">Ongoing</span>
                                                            </div>
                                                            <span>3 Services</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-bule">
                                                        <span class="bule-color">W9767</span><br>
                                                        <span>Alejandro Cain</span><br/>
                                                        <small>2Adults | 1 child</small>
                                                    </td>
                                                    <td>
                                                        04 Jul,2022<br />
                                                        <small>05:00 PM</small>
                                                    </td>
                                                    <td>
                                                        <div class="lable-alert">
                                                            <div class="controle-lable">
                                                                <span class="accepted">
                                                                    <img src="./asset/img/acp.png">completed</span>
                                                            </div>
                                                            <span>1 Services</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-bule">
                                                        <span class="bule-color">W9767</span><br>
                                                        <span>Alejandro Cain</span><br/>
                                                        <small>2Adults | 1 child</small>
                                                    </td>
                                                    <td>
                                                        04 Jul,2022<br/>
                                                        <small>05:00 PM</small>
                                                    </td>
                                                    <td>
                                                        <div class="lable-alert">
                                                            <div class="controle-lable">
                                                                <span class="rejected">
                                                                    <img src="./asset/img/rej.png">Rejected
                                                                </span>
                                                                <span>5 Services</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="view-table-rghit">
                                <div class="box1">
                                    <div class="over-head">
                                        <h5 class="overview-cont">Top Performing Airports</h5>
                                        <!--
                                        <select class="overview-left" name="" id="airlinedoughnutyear">
                                            <option value="thisyear">This year</option>
                                            <option value="thisyear">Last year</option>
                                        </select>-->

                                        <div style="display:flex;flex-wrap:wrap;margin-top:12px;gap:12px;">
                                            <div class="inner-input-field">
                                              <div class="arriving-input-set input-group">
                                                 <span class="input-group-addon bg-date"></span>
                                                 <div class="date-con">
                                                    <label for="from_date2">From Date</label>
                                                    <input type="text" class="b-input datepicker" id="from_date2" placeholder="YYYY-MM-DD" readonly>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="inner-input-field">
                                              <div class="arriving-input-set input-group">
                                                 <span class="input-group-addon bg-date"></span>
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

                    <div class="isagent-container hidden">
                        <!-- chart analytics section -->
                        <div class="booking-analytics-set">
                            <div class="booking-overview">
                                <div class="booking-head">
                                    <h5 class="overview-cont">Booking Overview</h5>

                                    <!--<select class="overview-left" name="" id="">
                                        <option value="thisyear">This year</option>
                                        <option value="thisyear">Last year</option>
                                    </select> -->

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
                                <!-- <div id="chartContainer" style="height: 360px;
                                    width: 100%;"></div> -->
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
                            <!--
                                        <select class="overview-left" name="" id="airlinedoughnutyear">
                                            <option value="thisyear">This year</option>
                                            <option value="thisyear">Last year</option>
                                        </select> -->

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

                        <div class="view-table-set">
                            <div class="view-table-lefet">
                                <div class="viwe-cont-lefet">
                                    <h5 class="overview-cont">Recent
                                        Bookings</h5>
                                    <a href="booking.php" class="nav-link bule-color">View all ></a>
                                </div>
                                <div class="table-section-set">
                                    <table class="td-style agentrecentbookings">
                                        <tbody class="table-body-set">
                                            <tr>
                                                <td class="td-bule">
                                                    <span class="bule-color">W9767</span><br>
                                                    <span>Alejandro Cain</span><br/>
                                                    <small>2Adults | 1 child</small>
                                                </td>
                                                <td>
                                                    04 Jul,2022<br />
                                                    <small>05:00 PM</small>
                                                </td>
                                                <td>
                                                    <div class="lable-alert">
                                                        <div class="controle-lable">
                                                            <span class="upcoming">
                                                              <img src="./asset/img/up.png">Upcoming</span>
                                                        </div>
                                                        <span>2 Services</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-bule">
                                                    <span class="bule-color">W9767</span><br>
                                                    <span>Alejandro Cain</span><br/>
                                                    <small>2Adults | 1 child</small>
                                                </td>
                                                <td>
                                                    04 Jul,2022<br/>
                                                    <small>05:00 PM</small>
                                                </td>
                                                <td>
                                                    <div class="lable-alert">
                                                        <div class="controle-lable">
                                                            <span class="ongoing">
                                                                <img src="./asset/img/ong.png">Ongoing</span>
                                                        </div>
                                                        <span>3 Services</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td-bule">
                                                    <span class="bule-color">W9767</span><br>
                                                    <span>Alejandro Cain</span><br/>
                                                    <small>2Adults | 1 child</small>
                                                </td>
                                                <td>
                                                    04 Jul,2022<br />
                                                    <small>05:00 PM</small>
                                                </td>
                                                    <td>
                                                        <div class="lable-alert">
                                                            <div class="controle-lable">
                                                                <span class="accepted">
                                                                    <img src="./asset/img/acp.png">completed
                                                                </span>
                                                            </div>
                                                            <span>1 Services</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td-bule">
                                                        <span class="bule-color">W9767</span><br>
                                                        <span>Alejandro
                                                            Cain</span><br/>
                                                        <small>2Adults | 1 child</small>
                                                    </td>
                                                    <td>
                                                        04 Jul,2022<br/>
                                                        <small>05:00 PM</small>
                                                    </td>
                                                    <td>
                                                        <div class="lable-alert">
                                                            <div class="controle-lable">
                                                                <span class="rejected">
                                                                    <img src="./asset/img/rej.png">Rejected
                                                                </span>
                                                                <span>5 Services</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="view-table-rghit hidden">
                                    <div class="box1">
                                        <div class="viwe-cont">
                                            <h5 class="overview-cont">Top
                                                performing agents</h5>
                                            <a href="#" class="nav-link bule-color">View all ></a>
                                        </div>
                                        <tbody>
                                            <div class="display-flex">
                                                <td class="td-bule">
                                                    <li>
                                                        <img src="./asset/nam1.png" alt="andrew">
                                                    </li>
                                                </td>
                                                <td>
                                                    <ul class="table-image">
                                                        <a href="javascript:void(0);" class="assignd-order">W9727</a>
                                                        <li>Alejandro Cain</li>
                                                    </ul>
                                                </td>

                                                <td>
                                                    <p>sevice booked<br><span>465</span></p>
                                                </td>
                                            </div>
                                            <div class="display-flex">
                                                <td class="td-bule">
                                                    <li>
                                                        <img src="./asset/nam1.png" alt="andrew">
                                                    </li>
                                                </td>
                                                <td>
                                                    <ul class="table-image">
                                                        <a href="javascript:void(0);" class="assignd-order">W9727</a>
                                                        <li>Alejandro Cain</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <p>sevice booked<br><span>465</span></p>
                                                </td>
                                            </div>
                                            <div class="display-flex">
                                                <td class="td-bule">
                                                    <li>
                                                        <img src="./asset/nam1.png" alt="andrew">
                                                    </li>
                                                </td>
                                                <td>
                                                    <ul class="table-image">
                                                        <a href="javascript:void(0);" class="assignd-order">W9727</a>
                                                        <li>Alejandro Cain</li>
                                                    </ul>
                                                </td>

                                                <td>
                                                    <p>sevice booked<br><span>465</span></p>
                                                </td>
                                            </div>
                                            <div class="display-flex">
                                                <td class="td-bule">
                                                    <li><img
                                                            src="./asset/nam1.png"
                                                            alt="andrew"></li></td>
                                                <td>
                                                    <ul
                                                        class="table-image">
                                                        <a
                                                            href="javascript:void(0);"
                                                            class="assignd-order">W9727</a>
                                                        <li>Alejandro
                                                            Cain</li>
                                                    </ul>
                                                </td>

                                                <td>
                                                    <p>sevice booked<br><span>465</span></p></td>
                                            </div>
                                            <div class="display-flex">
                                                <td class="td-bule">
                                                    <li><img
                                                            src="./asset/nam1.png"
                                                            alt="andrew"></li></td>
                                                <td>
                                                    <ul
                                                        class="table-image">
                                                        <a
                                                            href="javascript:void(0);"
                                                            class="assignd-order">W9727</a>
                                                        <li>Alejandro
                                                            Cain</li>
                                                    </ul>
                                                </td>

                                                <td>
                                                    <p>sevice booked<br><span>465</span></p></td>
                                            </div>
                                        </tbody>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    <!-- jquery -->
        <script src="./js/jquery-3.6.0.js"></script>
        <script src="js/moment-with-locales.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>

        <!-- sidebar-heder -->
        <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
        <!-- canvas -->
        <!-- <script src="./js/jquery.canvasjs.min.js"></script> -->
        <!-- <script src="./js/chart-style.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
        <script>

            $("#from_date").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "YYYY-MM-DD",
                maxDate: new Date()
            });
            $("#to_date").datetimepicker({
                date: new Date(),
                ignoreReadonly: true,
                format: "YYYY-MM-DD",
                maxDate: new Date()
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
                maxDate: new Date()
            });
            $("#to_date2").datetimepicker({
                date: new Date(),
                ignoreReadonly: true,
                format: "YYYY-MM-DD",
                maxDate: new Date()
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
            
                // bar chart (is airlines)
                // const dataBarAirline = {
                //     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                //         datasets: [{
                //         label: 'Meet and Greet',
                //         data: [18, 12, 8, 5, 12, 7, 9],
                //         borderRadius: 5,
                //         barPercentage: .6,
                //         backgroundColor: [
                //             '#a07deb'
                //         ],
                //         borderColor: [
                //             '#a07deb'
                //         ],
                //         borderWidth: 1
                //         },{
                //         label: 'Lounge',
                //         data: [4, 10, 16, 9, 24, 3, 15], 
                //         borderRadius: 5,
                //         barPercentage: .6,
                //         backgroundColor: [
                //             '#fe773b'
                //         ],
                //         borderColor: [
                //             '#fe773b'
                //         ],
                //         borderWidth: 1
                //         },{
                //         label: 'Translator',
                //         data: [9, 3, 13, 9, 12, 10, 4],
                //         borderRadius: 5,
                //         barPercentage: .6,
                //         backgroundColor: [
                //             '#53c881'
                //         ],
                //         borderColor: [
                //             '#53c881'
                //         ],
                //         borderWidth: 1
                //         }]
                // };

                // // config 
                // const configBarAirline = {
                //     type: 'bar',
                //     data: dataBarAirline,
                //     options: {
                //         scales: {
                //             y: {
                //                 beginAtZero: true
                //             }
                //         },
                //         plugins: {
                //             legend: {
                //                 position: 'top',
                //                 align: 'start',
                //                 labels: {
                //                     usePointStyle: true,
                //                     pointStyle: 'rectRounded',
                //                     padding: 25
                //                 }
                //             }
                //         }
                //     }
                // };
                
                // const myChart = new Chart(
                //     document.getElementById('myChart'),
                //     configBarAirline
                // );

                // Volume chart (Airlines)
                // const dataCurveChart = {
                //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                //         datasets: [{
                //         label: 'Booking History',
                //         fill: 'origin',
                //         backgroundColor: 'rgba(241, 237, 252, 0.5)',
                //         borderColor: '#947bca',
                //         data: [0,1,2,3,4,3,4,0],
                //         tension: 0.4,
                //         }]
                //     };
                //     const configCurve = {
                //         type: 'line',
                //         data: dataCurveChart,
                //         options: {
                //             scales: {
                //                 y: {
                //                     beginAtZero: true
                //                 }
                //             },
                //             plugins: {
                //                 legend:{
                //                     display: false
                //                 }
                //             }
                //         }
                //     };
                //     curveChart = new Chart(
                //         document.getElementById('curveChart'),
                //         configCurve
                //     );

                // bar chart (is agent)
//                const dataBarAgent = {
//                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
//                        datasets: [{
//                        label: 'Website',
//                        data: [18, 12, 8, 5, 12, 7, 9],
//                        borderRadius: 5,
//                        barPercentage: .6,
//                        backgroundColor: [
//                            '#a07deb'
//                        ],
//                        borderColor: [
//                            '#a07deb'
//                        ],
//                        borderWidth: 1
//                        },{
//                        label: 'Agent',
//                        data: [4, 10, 16, 9, 24, 3, 15], 
//                        borderRadius: 5,
//                        barPercentage: .6,
//                        backgroundColor: [
//                            '#fe773b'
//                        ],
//                        borderColor: [
//                            '#fe773b'
//                        ],
//                        borderWidth: 1
//                        }]
//                };
//
//                // config 
//                const configBarAgent = {
//                    type: 'bar',
//                    data: dataBarAgent,
//                    options: {
//                        scales: {
//                            y: {
//                                beginAtZero: true
//                            }
//                        },
//                        plugins: {
//                            legend: {
//                                position: 'top',
//                                align: 'end',
//                                labels: {
//                                    usePointStyle: true,
//                                    pointStyle: 'rectRounded',
//                                    padding: 25
//                                }
//                            }
//                        }
//                    }
//                };
//                
//                const myChartAgent = new Chart(
//                    document.getElementById('myChartAgent'),
//                    configBarAgent
//                );
            
            
                // doughnut chart (is agent)
                const dataAgentDoughnut = {
                            labels: ['Aiportzo Balance', 'Agent Balance'],
                            datasets: [{
                                label: 'Outstanding Balance',
                                data: [5, 7],
                                backgroundColor: [
                                '#53c0ee',
                                '#52c98f'
                                ],
                                borderColor: [
                                '#53c0ee',
                                '#52c98f'
                                ],
                                borderWidth: 1,
                                cutout: '80%',
                                borderRadius: 20,
                                offset: 30
                            }]
                        };

                        // config 
                        const configDoughnut = {
                        type: 'doughnut',
                        data: dataAgentDoughnut,
                        maintainAspectRatio: false,
                        options: {
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                        };
                        
                        const myAgentDoughnutChart = new Chart(
                            document.getElementById('myAgentDoughnutChart'),
                            configDoughnut
                        );

                // doughnut chart (is not agent)
                // let dataAirlineDoughnut = {
                //             labels: ['DXB', 'DAL', 'YLW', 'KTM', 'HNS', 'EBB'],
                //             datasets: [{
                //                 label: 'Meet and Greet',
                //                 data: [5, 5, 5, 5, 5, 5],
                //                 backgroundColor: [
                //                 '#57c78f',
                //                 '#ce5eaa',
                //                 '#fd7837',
                //                 '#fec629',
                //                 '#52c0ef',
                //                 '#a17deb'
                //                 ],
                //                 borderColor: [
                //                 '#57c78f',
                //                 '#ce5eaa',
                //                 '#fd7837',
                //                 '#fec629',
                //                 '#52c0ef',
                //                 '#a17deb'
                //                 ],
                //                 borderWidth: 1,
                //                 cutout: '80%',
                //                 borderRadius: 20,
                //                 offset: 30
                //             }]
                //         };

                //         let stackedText = {
                //             id: 'stackedText',
                //             afterDatasetsDraw(chart, args, options){
                //                 const {ctx, chartArea: {top, bottom, left, right, width, height}} = 
                //                 chart;

                //                 ctx.save();
                //                 ctx.font = 'bolder 22px sans-serif';
                //                 ctx.fillStyle =  '#000';
                //                 ctx.textAlign = 'center';
                //                 ctx.fillText('1247', width / 2, height / 2 + top);
                //                 ctx.restore();

                //                 ctx.font = '22px sans-serif';
                //                 ctx.fillStyle =  '#000';
                //                 ctx.textAlign = 'center';
                //                 ctx.fillText('Bookings', width / 2, height / 2 + top + 22);

                //             }
                //         };

                //         // config 
                //         let configDoughnut2 = {
                //         type: 'doughnut',
                //         data: dataAirlineDoughnut,
                //         maintainAspectRatio: false,
                //         options: {
                //             plugins: {
                //                 legend: {
                //                     position: 'bottom',
                //                     align: 'center',
                //                     labels: {
                //                         usePointStyle: true,
                //                         pointStyle: 'rectRounded',
                //                         boxWidth: 5,
                //                         padding: 25
                //                     }
                //                 }
                //             }
                //         },
                //         plugins: [stackedText]
                //         };
                        
                //         let airlineDoughnutChart = new Chart(
                //             document.getElementById('airlineDoughnutChart'),
                //             configDoughnut2
                //         );


                
                // $(document).ready(()=>{
                //     // setTimeout(() => {
                //     //     window.location = "under-construction.html";
                        
                //     // }, 400);
                //     $('#dashboard').addClass('actives');
                
                // });
        </script>
            
        <script>
                $(".box").click(function () {
                    $(".content").slideToggle("slow");
                });

                $(document).ready(()=>{
                $('#dashboard').addClass('actives');
            
            });
            
        </script>
        <script>
            console.log(isAgent);
             var apiPath = "<?php echo $apiPath; ?>";
            $(document).ready(()=>{
                let year = Math.abs(new Date().getFullYear());
                let yearList = ` <option value="${year}">This year</option>
                                <option value="${year - 1}">Last year</option>`;
                airportrecentbookings();
                if(isAgent == 0){
                   
                    $('#airlinebarchartyear').html(yearList);
//                    $('#airlinedoughnutyear').html(yearList); 
                    // $('#airlineoutstanding').removeClass('hidden');
                    // $('#agentoutstanding').addClass('hidden');
                    // $('.airlines-container').removeClass('hidden');
                    // $('.isagent-container').addClass('hidden');
                    airportheader();
                    fetchairlineservicevolumecharts();
                    fetchtopairports();
                        
                }else{
                    $('#airlineoutstanding').addClass('hidden');
                    $('#agentoutstanding').removeClass('hidden');
                    $('.airlines-container').addClass('hidden');
                    $('.isagent-container').removeClass('hidden');
                    agentheader();
                    agent_bar_chart();
                    fetchtopairports_agent();
                }
            
            });
            function airportheader(){
                let datas = {
                                "distributorToken": distributorToken,
                                "userToken": userToken
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
                                "distributorToken": distributorToken,
                                "userToken": userToken
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
                                                            src="./asset/img/up.png">Upcoming</span>
                                                 </div>`;
                                        break;
                                    case 'Ongoing':
                                        status = `<div class="controle-lable">
                                                    <span class="ongoing"><img
                                                            src="./asset/img/ong.png">Ongoing</span>
                                                 </div>`;
                                        break;
                                    case 'Completed':
                                        status = `<div class="controle-lable">
                                                    <span class="accepted"><img
                                                            src="./asset/img/acp.png">Completed</span>
                                                 </div>`;
                                        break;
                                    
                                    case 'Cancelled':
                                        status = `<div class="controle-lable">
                                                    <span class="rejected"><img
                                                            src="./asset/img/rej.png">Cancelled</span>
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
                                "userToken": userToken,
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
                                "userToken": userToken,
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
                                    "userToken": userToken,
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
                                "distributorToken": distributorToken,
                                "userToken": userToken
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
                                    "userToken": userToken,
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
