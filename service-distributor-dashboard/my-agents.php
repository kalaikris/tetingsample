<?php
include_once '../config/core.php';
include_once '../security/secure.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>airportzo</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- <link rel="stylesheet" href="./css/bootstrap.min.css<?php echo $js_cache_string; ?>"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <!-- <link rel="stylesheet" href="./css/bootstrap-icons.css<?php echo $js_cache_string; ?>"> -->
    <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>

    <!-- data table link -->
    <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />

    <!--  data table CSS only -->
    <!-- <link rel="stylesheet" href="../js/data-table-css/bootstrap.css<?php echo $js_cache_string; ?>"> -->
    <!-- custm css -->
    <link rel="stylesheet" href="./css/fonts.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/booklist.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/my-staffas.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/agent-detailes-1.css<?php echo $js_cache_string; ?>">
</head>
<style>
    
    .text-time {
        display: block;
        color: #969696;
    }
    .profile__inputs > div {
        max-width: 435px;
        margin: 0 auto 24px;
    }
    .profile__inputs input {
        width: 100%;
    }
    .dispflex {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }
    .uploaded-img{
        width: 200px;
    height: 200px;
    object-fit: contain;
    }
    .genbtn {
        padding: 20px 0px !important;
        width: 140px !important;
        line-height: 5px !important;
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
            <div class="slider-desc-set my-agent-hide">
                <div class="top-set">
                    <div class="rghit-cont">

                        <h3 class="mystaff-text">My Agents</h3>
                        <p class="total-stafs">Total staffs - 14</p>
                    </div>

                    <div class="left-buttons">
                        <div class="employee">
                            <!-- <input type="button" value="Add new employee" class="new-emp"> -->
                            <button class="new-emp"><a class="nav-link" href="set-commission-and-target.php">Add new Agent</a></button>

                        </div>
                        <div class="upload" hidden>
                            <input type="button" value="Upload CSV" class="upl-csv">
                        </div>
                    </div>
                </div>
                <table id="my-agent" class="">
                    <thead>
                        <tr>
                            <th>Agent ID</th>
                            <th>Agent Name</th>
                            <th>Joined on</th>
                            <th>Contact Number</th>
                            <th>Email Address</th>
                            <th>Service booked</th>
                            <th>Booking Made</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-bule"><a href="#" class="assignd-order">W9727</a></td>
                            <td>
                                <ul class="table-image">
                                    <li><img src="./asset/nam1.png" alt="andrew"></li>
                                    <li>Alejandro Cain</li>
                                </ul>
                            </td>
                            <td>
                                04 Jul,2022
                            </td>
                            <td>+91748724682</td>
                            <td>
                                wegbo@maguvupi.com
                            </td>
                            <td><span>465</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>



            <div class="slider-desc-set agent-detail-hide" style="display: none;">
                <div class="header-common-down">
                    <div class="alejan">
                        <span onclick="privouspage()" style="margin-right:12px;">
                            <svg class="back-btn" width="28" height="20" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 8H6.8L11.42 3.38C11.814 2.986 12 2.516 12 2C12 1.016 11.187 0 10 0C9.469 0 9.006 0.193 8.62 0.58L0.662 8.538C0.334 8.866 0 9.271 0 10C0 10.729 0.279 11.08 0.646 11.447L8.62 19.42C9.006 19.807 9.469 20 10 20C11.188 20 12 18.984 12 18C12 17.484 11.814 17.014 11.42 16.62L6.8 12H26C27.104 12 28 11.104 28 10C28 8.896 27.104 8 26 8Z" fill="black"></path></svg>
                        </span>
                        <img class="profimage" src="./asset/alegan.png" alt="">
                        <div class="alenjandro">
                            <h1>Alejandro Cain</h1>
                            <p>W9768</p>
                        </div>

                    </div>
                    <div class="pay-button" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="./asset/img/tip-icon.png" alt=""> <a class="clor viewinfo" href="#">View info</a>
                    </div>

                </div>
                <div class="join-email-common">
                    <div class="join joindate">
                        <p> Joined on </p>
                        <h1>o4 Jul,20222</h1>
                    </div>
                    <div class="join agentemail">
                        <p> Email Address </p>
                        <h1>Wegho@maguvupi.com</h1>
                    </div>
                    <div class="join agentmob">
                        <p> Mobile Number </p>
                        <h1>+962575772234</h1>
                    </div>
                    <div class="join agentcommission">
                        <p> Commission Type </p>
                        <h1></h1>
                    </div>


                </div>

                <div class="underline"></div>
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">All Time</li>
                    <li class="tab-link" data-tab="tab-2">This month</li>
                </ul>
                <div class="underline"></div>

                <div id="tab-1" class="tab-content current">
                    <div class="dashboard-set">
                        <div class="dashboard-box">
                            <div class="dashboard-box-set">
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Realized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="alltimerealized">₹1,74,863</span></h1>
                                    </div>
                                    <img class="b-2" src="./asset/img/b-4.png" alt="" srcset="">
                                </div>
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Unrealized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="alltimeunrealized">₹2,74,863</span></h1>
                                    </div>
                                </div>

                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Booking
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="alltimebooking">₹2,74,863</span></h1>
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
                                        <h1 class="total-booking-count"><span class="alltimebookingtotal">348</span></h1>
                                    </div>
                                    <img class="b-1" src="./asset/img/b-6.png" alt="" srcset="">
                                </div>
                                <div class="month-booking">
                                    <ul class="month-set">
                                        <li class="month-cap">This month</li>
                                        <li class="month-cap">last month</li>
                                        <li class="month-cap">past 6 months</li>
                                        <li class="month-cap">Last year</li>
                                    </ul>
                                    <ul class="month-booking-set">
                                        <li class="booking-cap"><span class="month-booking-count alltimethismonth">50</span></li>
                                        <li class="booking-cap"><span class="month-booking-count alltimelastmonth">556</span></li>
                                        <li class="booking-cap"><span class="month-booking-count alltimepastsix">627</span></li>
                                        <li class="booking-cap"><span class="month-booking-count alltimelastyear">8991</span></li>
                                    </ul>


                                </div>
                            </div>
                        </div>

                        <div class="dashboard-box hidden">
                            <div class="dashboard-box-set">
                                <div class="booking-set-1">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Yearly
                                            Target</h5>

                                        <h1 class="total-booking-count"><span class="alltimetotaltarget">+
                                                ₹2,74,863</span></h1>
                                    </div>
                                    <img class="b-2" src="./asset/img/b-5.png" alt="" srcset="">
                                </div>
                                <div class="prograss-bar">
                                    <div class="prograss-inner"></div>
                                </div>
                                <div class="booking-set-2">
                                    <div class="month-booking">
                                        <ul class="month-set">
                                            <li class="month-cap">This month</li>
                                            <li class="month-cap">last month</li>
                                            <li class="month-cap">past 6
                                                months</li>
                                            <li class="month-cap">Last year</li>
                                        </ul>
                                        <ul class="month-booking-set">
                                            <li class="booking-cap"><span class="month-booking-count alltimethismonthcomm">28
                                                    bookings</span></li>
                                            <li class="booking-cap"><span class="month-booking-count alltimelastmonthcomm">53
                                                    bookings</span></li>
                                            <li class="booking-cap"><span class="month-booking-count alltimepastsixcomm">272
                                                    bookings</span></li>
                                            <li class="booking-cap"><span class="month-booking-count alltimelastyearcomm">18
                                                    bookings</span></li>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           

                <div id="tab-2" class="tab-content">
                    <div class="dashboard-set1">
                        <div class="dashboard-box1">
                            <div class="dashboard-box-set">
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Realized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="thismonthrealized">₹1,74,863</span></h1>
                                    </div>
                                    <img class="b-2" src="./asset/img/b-4.png" alt="" srcset="">
                                </div>
                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Unrealized
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="thismonthunrealized">₹2,74,863</span></h1>
                                    </div>
                                </div>

                                <div class="booking-set">
                                    <div class="booking-inner">
                                        <h5 class="total-bookin-tital">Booking
                                            revenue</h5>
                                        <h1 class="total-booking-count"><span class="thismonthbooking">₹2,74,863</span></h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-box1 hidden">
                        <div class="dashboard-box-set">
                            <div class="booking-set-1">
                                <div class="booking-inner">
                                    <h5 class="total-bookin-tital">Monthly
                                        Target</h5>

                                    <h1 class="total-booking-count"><span class="thismonthtotaltarget">+
                                            ₹2,74,863</span></h1>
                                </div>
                                <img class="b-2" src="./asset/img/b-5.png" alt="" srcset="">
                            </div>
                            <div class="prograss-bar">
                                <div class="prograss-inner"></div>
                            </div>
                            <div class="booking-set-2">
                                <div class="month-booking">
                                    <ul class="month-set">
                                        <li class="month-cap">Today</li>
                                        <li class="month-cap">Yesterday</li>
                                        <li class="month-cap">2 days back
                                            </li>
                                        <li class="month-cap">1 week back</li>
                                    </ul>
                                    <ul class="month-booking-set">
                                        <li class="booking-cap"><span class="month-booking-count thismonthtodaycomm">28
                                                bookings</span></li>
                                        <li class="booking-cap"><span class="month-booking-count thismonthyesterdaycomm">53
                                                bookings</span></li>
                                        <li class="booking-cap"><span class="month-booking-count thismonthtwodayscomm">272
                                                bookings</span></li>
                                        <li class="booking-cap"><span class="month-booking-count thismonthoneweekcomm">18
                                                bookings</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>
                            <div class="dispflex">
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

                                <button type="button" class="btn btn-success genbtn">Generate</button>
                            </div>
                        </div>
                    </div>
                <table id="agentbooking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Booked on</th>
                                <th>Services Booked</th>
                                <th>Service Partners</th>
                                <th>Commission</th>
                                <th>Earnings</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td-bule"><a href="#">W9768</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>

                                <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                            </tr>

                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W9768</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="ongoing"><img src="./asset/img/ong.png">Ongoing</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W976</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="ongoing"><img src="./asset/img/ong.png">Ongoing</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W9768</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W9765</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W9767</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule"><a href="#">W9768</a></td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="rejected"><img src="./asset/img/rej.png">Rejected</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                            <tr>
                                <td class="td-bule">W9767</td>
                                <td>
                                    01 Jul,2022<br />
                                    <small>12:52PM(GMT+2)</small>
                                </td>
                                <td>4 services <br><small>Meet and
                                        Greet|Lounge|porter..</small></td>
                                <td>
                                    Prannamm,premium plaza..
                                </td>
                                <td>7%</td>

                                <td><span>₹ 590</span></td>
                                <td><span class="accepted"><img src="./asset/img/acp.png">completed</span></td>
                            </tr>
                        </tbody>
                </table>

            </div>
            
            
        </div>
    </main>
    
    <!-- Modal popup -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered agent-popup" role="document">
            <div class="modal-content agent-popup-inner">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body">
                    <div class="over-all-tab">
                        <ul class="tabs-agent">
                            <li class="tab-link current-active" data-tab="tab-1-agent-list">Agent
                                Details
                            </li>
                            <li class="tab-link" data-tab="tab-2-agent-list">Bank Details
                            </li>
                            <li class="tab-link-reviw" data-tab="tab-3-agent-list">Documents
                            </li>
                        </ul>

                        <div id="tab-1-agent-list" class="tab-content
                        current-active">
                            <div class="clement-common">
                                <div class="clement-jhon">
                                    <img class="reviewprofimage" src="./asset/clement.png" alt="">
                                </div>
                                <div class="clement-jhon-inner">
                                    <div class="clement-name">
                                        <h1>Mr.Clement Jhon</h1>
                                    </div>
                                    <div class="clement-jhon-inner-over-all">
                                        <div class="date">
                                            <p>Date of Birth</p>
                                            <p class="dob">27may,1968</p>
                                        </div>
                                        <div class="date">
                                            <p>Agent Type</p>
                                            <p class="agenttype">Business</p>
                                        </div>
                                        <div class="date">
                                            <p>Business Website</p>
                                            <p class="websitereview">WWW.indigoairlines.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="primary">
                                <h1>
                                    primary contact details
                                </h1>
                                <div class="primary-inner">
                                    <div class="date">
                                        <p>Mobile Number</p>
                                        <p class="reviewmob">962575772234</p>
                                    </div>
                                    <div class="date">
                                        <p>Email Address</p>
                                        <p class="reviewmail">clementjhon68@gmail.com</p>
                                    </div>
                                    <div class="date">
                                        <p>Alternative Mobile Number</p>
                                        <p class="alt-mob">7357671254r</p>
                                    </div>
                                    <div class="date">
                                        <p>Alternative Email Address</p>
                                        <p class="alt-email">linzjhon@gmail.com.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="primary">
                                <h1>
                                    Address
                                </h1>
                                <div class="address-inner">
                                    <div class="date">
                                        <p>Address</p>
                                        <p class="reviewaddress">56B, Indigo Airlines,velachery</p>
                                    </div>
                                    <div class="date">
                                        <p>Country</p>
                                        <p class="reviewcountry">india</p>
                                    </div>
                                    <div class="date">
                                        <p>State</p>
                                        <p class="reviewstate">Tamil nadu</p>
                                    </div>

                                </div>
                                <div class="address-inner-another">
                                    <div class="date">
                                        <p>City</p>
                                        <p class="reviewcity">Chennai</p>
                                    </div>
                                    <div class="date">
                                        <p>Pincode</p>
                                        <p class="reviewpin">641114</p>
                                    </div>
                                </div>

                            </div>

                            <div class="incentives">
                                <h1>Incentives</h1>
                                <!-- 1) 0 To 1000 Bookings - 0.5%<br><br>
                                2) 1001 To 2000 Bookings - 1% -->
                            </div>
                            <div class="agent-button">
                                <a href="" class="nav-link"><button type="button" class="agent-btn">Okay</button></a>
                            </div>

                        </div>
                        <div id="tab-2-agent-list" class="tab-content" >
                              <div class="primary">
                                <h1>
                                    Bank details
                                </h1>
                                <div class="primary-inner">
                                    <div class="date">
                                        <p>Account Number</p>
                                        <p class="reviewaccount">962575772234</p>
                                    </div>
                                    <div class="date">
                                        <p>IFSC Code</p>
                                        <p class="reviewifsc">clementjhon68@gmail.com</p>
                                    </div>
                                    <div class="date">
                                        <p>Branch</p>
                                        <p class="reviewbranch">7357671254</p>
                                    </div>
                                    <div class="date">
                                        <p>City </p>
                                        <p class="reviewbankcity">linzjhon@gmail.com.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3-agent-list" class="tab-content">
                             <div class="document-view">
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" alt="document file" id="view_pancard" class="document-file" />
                                    </div>
                                    <p class="file-name">PAN Card</p>
                                </div>
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="blob:https://airportzo.net.in/33f6d690-db45-4e3c-9a58-9073fea7628c" id="view_gst" alt="document file" class="document-file" />
                                    </div>
                                    <p class="file-name">GST Certificate</p>
                                </div>
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_msme" alt="document file" class="document-file" />
                                    </div>
                                    <p class="file-name">MSME Certificate</p>
                                </div>
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="#" id="view_incorporation" alt="document file" class="document-file" />
                                    </div>
                                    <p class="file-name">Certificate of Incorporation</p>
                                </div>
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="#" id="view_void_cheque" alt="document file" class="document-file" />
                                    </div>
                                    <p class="file-name">Void Cheque</p>
                                </div>
                                <div class="document-items">
                                    <div class="doc-set">
                                        <img src="#" id="view_ca_card" alt="document file" class="document-file" />
                                    </div>
                                    <p class="file-name">Contract Agreement</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal popup -->
    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-center" style="margin-bottom: 16px;">
                    <h5 class="modal-title" id="">Edit profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="profile__inputs">
                        <div>
                            <input id="edit_agent_token" type="hidden">
                            <div class="upload__profile-pic text-center">
                                <div class="profile_img" id="before_profile_pic">
                                    <input id="valid_profile_pic" type="hidden">
                                    <label for="profile_pic">
                                        <img src="asset/img/uplod.png" id="display_profile_pic" class="uploaded-img" alt="upload icon">
                                        <input type="file" id="profile_pic" class="file-upload" onchange="imagevalidate('profile_pic');" style="display:none;">
                                    </label>
                                </div>
                                <div class="numer-acc alert-cont edit_agent_image_error" style="display:none;">
                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Company Logo!</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="user_name">
                                <select class="option-set salutation" id="edit_agent_title">
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                </select>
                                <div class="input_cont">
                                    <label for="agent_name">Agent Name</label>
                                    <input type="text" name="" id="edit_agent_name" class="border-none">
                                </div>
                            </div>
                            <div class="numer-acc alert-cont edit_agent_name_error" style="display:none;">
                                <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Enter Agent Name</p>
                            </div>
                        </div>
                        <div>            
                            <div class="input-form-group-item">
                                <div class="login-input-action-set">
                                    <div class="login-input-group phone">
                                        <label for="mobile_no">Mobile Number</label>
                                        <input type="tel" class="login-input-box" id="edit_mobile_no" name="phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="numer-acc alert-cont edit_mobile_error" style="display:none;">
                                <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please enter valid mobile Number!</p>
                            </div>
                        </div>
                        <div>
                            <div class="user_name">
                                <div class="input_cont">
                                    <label for="edit_email_address" style="opacity:.5;">Email Address</label>
                                    <input type="text" name="edit_email_address" id="edit_email_address">
                                </div>
                            </div>
                            <div class="numer-acc alert-cont edit_email_error" style="display:none;">
                                <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Enter Email!</p>
                            </div>
                        </div>
                        <!-- <div class="employee">
                            <button class="new-emp" onclick="updateAgent()"><a class="nav-link">Update</a></button>
                        </div> -->
                        <!-- <div class="left-buttons">
                            <a class="nav-link" href="javascript:void(0)" onclick="updateAgent()"></a>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer" style="width:100%;justify-content:flex-end;">
                    <div class="employee" style="margin-right:32px;">
                        <button class="new-emp" onclick="updateAgent()"><a class="nav-link" style="color:#fff;">Update</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- jquery -->
    <script src='./js/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- data table js -->
    <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- date picker -->
    <script src='./js/moment-with-locales.js'></script>
    <script src='./js/bootstrap-datetimepicker.js'></script>

    <!-- JavaScript Bundle with Popper boostrap -->
    <!-- <script src="./js/data-table-js/dataTables.bootstrap4.min.js"></script>
    <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script> -->
    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
    <!-- data table custm js -->
    <script src="./js/table.js"></script>
   


    <script>
         // -----Country Code Selection
         $("#edit_mobile_no").intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "in",
            // separateDialCode: true,
        });

        // For S3 bucket
        var mob_id = ["#edit_mobile_no"];
        mob_id.forEach(function (value, i) {
            var iti = '';
            var mask = "";
            var phoneInputID = value;
            var input = document.querySelector(phoneInputID);
            iti = window.intlTelInput(input, {
                separateDialCode: false,
                initialCountry: "in",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });
            
            $(phoneInputID).on("countrychange", function(event) {
                var selectedCountryData = iti.getSelectedCountryData();
                newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
                iti.setNumber("");
                
                $(this).val('');
                $(this).attr('placeholder',newPlaceholder);
                newPlaceholder = newPlaceholder.replace(/^0+/, '');
                mask = newPlaceholder.replace(/[1-9]/g, "0");
                // Apply the new mask for the input
                $(this).mask(mask);
                var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
                check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
            });
            
            iti.promise.then(function() {
                $(phoneInputID).trigger("countrychange");
            });
        });

        $(document).ready(() => {     
            $('#my-agents').addClass('actives');
            $("ul.tabs-agent li").click(function() {
                var tab_id = $(this).attr("data-tab");

                $("ul.tabs-agent li").removeClass("current-active");
                $(".tab-content").removeClass("current-active");

                $(this).addClass("current-active");
                $("#" + tab_id).addClass("current-active");

                // column width resize properly
                // $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        function privouspage() {
            $(".my-agent-hide").show();
            $(".agent-detail-hide").hide();
        }

    </script>
     <script>
        // -----Country Code Selection
        $("#mobile_code").intlTelInput({
            initialCountry: "in",
            separateDialCode: false,
        });

        $(function() {
            $("#from_date").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
                maxDate: new Date()
            });
            $("#to_date").datetimepicker({
                date: new Date(),
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
                maxDate: new Date()
            });   
        });
    </script>

    <!-- <script>
      $(document).ready(function () {
                $("#my-agent").DataTable({
                    language: {
                        search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                        searchPlaceholder: "Search...",
                    },
                    buttons: [
                        {
                            extend: "searchBuilder",
                            config: {
                                depthLimit: 2,
                            },
                        },
                    ],
                    dom: "Bfrtip",
                    columnDefs: [
                        {
                            type: "unknownType",
                            targets: [3],
                        },
                    ],
                });
     });

    </script> -->


    <script>
        let apiPath = "<?php echo $apiPath; ?>";
        if(isAgent == 0){
            swal("You are not authorized to access this section, Contact Admin").then((value)=>{
                localStorage.clear();
                window.location = "login.php";
            })
        }
        $(document).ready(function() {
            fetch_data();
            setTimeout(() => {
                $("body").on('click','.assignd-order',function(e) {
                    e.preventDefault();
                    let agentId = $(this).attr('data-id');
                    let agentToken = $(this).attr('data-token');
                    $('.alenjandro p').text(`${agentId}`)
                    agentheaderalltime(agentToken);
                    agentheaderthistime(agentToken);
                    getSingleAgentBookings(agentToken);
                    $('.genbtn').attr('onclick',`getSingleAgentBookings('${agentToken}')`);
                    var datas = {
                                    "userToken": userToken,
                                    "agentToken": agentToken
                                }
                    var json_data = JSON.stringify(datas);
                    $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: `${apiPath}/distributor/singleAgentDetails.php`,
                    data: json_data,
                    success: agentdetails,
                    error: errorcheck,
                    });
                    $(".my-agent-hide").hide();
                    $(".agent-detail-hide").show();
                });
            }, 400);
        });

        function fetch_data() {
            var datas = {
                "userToken": userToken
            }
            var json_data = JSON.stringify(datas);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: `${apiPath}/distributor/agentList.php`,
                data: json_data,
                success: success,
                error: errorcheck,
            });
        }

        function agentdetails(data){
            let agentdetails = data.data;
            $('.alenjandro h1').text(`${agentdetails.name}`);
            $('.joindate h1').text(`${agentdetails.joinedDate}`);
            // $('.agent-detail-hide.agentemail h1').text(`${agentdetails.priMaryEmail}`);
            // $('.agent-detail-hide.agentmob h1').text(`${agentdetails.priMaryNumber}`);
            $('.agentemail h1').text(`${agentdetails.priMaryEmail}`);
            $('.agentmob h1').text(`${agentdetails.priMaryNumber}`);
            $('#exampleModalCenter .clement-name h1').text(`${agentdetails.name}`);
            $('.dob').text(`${agentdetails.dateOfBirth}`);
            $('.agenttype').text(`${agentdetails.businessType}`);
            $('.websitereview').text(`${agentdetails.website}`);
            $('.reviewmob').text(`${agentdetails.priMaryNumber}`);
            $('.reviewmail').text(`${agentdetails.priMaryEmail}`);
            $('.alt-mob').text(`${agentdetails.alternateNumber}`);
            $('.alt-email').text(`${agentdetails.alternateEmail}`);
            $('.reviewaddress').text(`${agentdetails.address}`);
            $('.reviewcountry').text(`${agentdetails.countryName}`);
            $('.reviewstate').text(`${agentdetails.stateName}`);
            $('.reviewcity').text(`${agentdetails.cityName}`);
            $('.reviewpin').text(`${agentdetails.pinCode}`);
            $('.reviewaccount').text(`${agentdetails.accountNumber}`);
            $('.reviewifsc').text(`${agentdetails.ifscCode}`);
            $('.reviewbranch').text(`${agentdetails.bankBranch}`);
            $('.reviewbankcity').text(`${agentdetails.bankCity}`);
            $('#view_pancard').attr("src",`${agentdetails.panCard}`);
            $('#view_gst').attr("src",`${agentdetails.gstCertificate}`);
            $('#view_msme').attr("src",`${agentdetails.msmeCertificate}`);
            $('#view_incorporation').attr("src",`${agentdetails.incorporationCertificate}`);
            $('#view_void_cheque').attr("src",`${agentdetails.voidCheque}`);
            $('#view_ca_card').attr("src",`${agentdetails.contractAgreement}`);
            $('.profimage').attr("src",`${agentdetails.profileImage}`);
            $('.reviewprofimage').attr("src",`${agentdetails.profileImage}`);

            let commissionType = ``;
            let incentive = '';
            if(`${agentdetails.commisionType}` == 1){
                commissionType = 'Commission';
                $('.agentcommission h1').text("Target");
                incentive = `<h1>${commissionType}</h1><br>`;
                agentdetails.commisionDetails.forEach((Incentive,index) => {
                let no = index + 1;
                incentive += `<p>${no}) YearlyTarget: ${Incentive.yearlyTarget} - ${Incentive.percent}% </br></p>`;
                
            });
            }else if(`${agentdetails.commisionType}` == 2){
                commissionType = 'Incentives';
                $('.agentcommission h1').text("Incentive");
                incentive = `<h1>${commissionType}</h1><br>`;
                agentdetails.commisionDetails.forEach((Incentive,index) => {
                let no = index + 1;
                incentive += `<p>${no}) ${Incentive.fromAmount} to ${Incentive.toAmount} bookings- ${Incentive.percent}%</br></p>`;
                
            });
            }
            $('.incentives').html(incentive);
        }

        function agentheaderalltime(agentToken){
            let datas = {
                            "distributorToken": distributorToken,
                            "userToken": userToken,
                            "agentToken": agentToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/singleAgentHeaderYear.php",
                    data: json1
                    }).done(function(data1) {
                        let revenueObject = data1.revenue;
                        let bookingObject = data1.booking;
                        let commissionObject = data1.yearlyTarget;
                        $('.alltimerealized').text(`₹${revenueObject.realisedRevenue}`);
                        $('.alltimeunrealized').text(`₹${revenueObject.unRealisedRevenue}`);
                        $('.alltimebooking').text(`₹${revenueObject.bookedRevenue}`);

                        $('.alltimebookingtotal').text(bookingObject.totalCount);
                        $('.alltimethismonth').text(bookingObject.thisMonthCount);
                        $('.alltimelastmonth').text(bookingObject.lastMonthCount);
                        $('.alltimepastsix').text(bookingObject.lastSixMonthCount);
                        $('.alltimelastyear').text(bookingObject.lastOneYearCount);

                        $('.alltimetotaltarget').text(commissionObject.thisYearTarget);
                        $('.alltimethismonthcomm').text(commissionObject.thisMonthTarget);
                        $('.alltimelastmonthcomm').text(commissionObject.lastMonthTarget);
                        $('.alltimepastsixcomm').text(commissionObject.lastSixMonthTarget);
                        $('.alltimelastyearcomm').text(commissionObject.lastYearTarget);
                    })
        }

        function agentheaderthistime(agentToken){

            let datas = {
                            "distributorToken": distributorToken,
                            "userToken": userToken,
                            "agentToken": agentToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/singleAgentHeaderThisMonth.php",
                    data: json1
                    }).done(function(data1) {
                        let revenueObject = data1.revenue;
                        let monthlyTargetObject = data1.monthlyTarget;

                        $('.thismonthrealized').text(`₹${revenueObject.realisedRevenue}`);
                        $('.thismonthunrealized').text(`₹${revenueObject.unRealisedRevenue}`);
                        $('.thismonthbooking').text(`₹${revenueObject.bookedRevenue}`);

                        $('.thismonthtotaltarget').text(monthlyTargetObject.thisMonthCollection);
                        $('.thismonthtodaycomm').text(monthlyTargetObject.todayCollection);
                        $('.thismonthyesterdaycomm').text(monthlyTargetObject.yesterDayCollection);
                        $('.thismonthtwodayscomm').text(monthlyTargetObject.twoDayBackCollection);
                        $('.thismonthoneweekcomm').text(monthlyTargetObject.oneWeekBackCollection);
                    })

        }

        function formatDate(date) {
                    // var d = new Date(date);
                    // console.log(d);
                    //     month = '' + (d.getMonth() + 1),
                    //     day = '' + d.getDate(),
                    //     year = d.getFullYear();
                    //     year = Math.abs(year)

                    // if (month.length < 2) 
                    //     month = '0' + month;
                    // if (day.length < 2) 
                    //     day = '0' + day;

                    //     console.log([year, month, day].join('-'));
                        
                    // return [year, month, day].join('-');
                    let [day,month,year] = date.split('-');
                    return [year, month, day].join('-');
                }

        function getSingleAgentBookings(agentToken){
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
                let datas = {
                                "userToken":userToken,
                                "agentToken":agentToken,
                                "fromDate":from_date,
                                "toDate":to_date
                            }
                let json1 = JSON.stringify(datas);
                console.log(json1);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/singleAgentBookings.php",
                        data: json1
                        }).done(function(data1) {
                            let agentTableArray = data1.data;
                            let agentHeaderObject = data1.headerData;

                            let agentbookingDetails = '';
                            agentTableArray.forEach((agentbookings,index) => {
                                let date = new Date(agentbookings.createdDate.replace(/-/g, "/"));
                                let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                                let datearray = formattedDate.split(',')
                                let timearray = datearray[2].split(" ");
                                let timeValue = timearray[1];
                                let timeZone = timearray[2];
                                let dateYearValue = datearray[0]+","+datearray[1];
                                let time_zoneValue = `${timeValue}`;

                                agentbookingDetails += `<tr> <td class="td-bule"><a data-token="${agentbookings.bookingToken}" data-bookingnumber="${agentbookings.bookingNumber}" data-date="${dateYearValue}" data-timezone="${time_zoneValue}" data-count="${agentbookings.memberCount}" data-status="${agentbookings.status}" class="bookingdetail-btn td-bule"  href="#">${agentbookings.bookingNumber}</a></td>
                                <td>${dateYearValue}<span class="text-time">${time_zoneValue}</span></td>
                                <td>${agentbookings.servicesCount} services<span class="text-time">${agentbookings.typeName}</span></td>
                                <td>${agentbookings.companyName}</td>
                                <td></td>
                                <td></td>
                                <td>${agentbookings.status}</td>
                                </tr> `;
                            });
                            $('#agentbooking tbody').html(agentbookingDetails);
                            $('#agentbooking').DataTable().destroy();
                            $('#agentbooking tbody').html(agentbookingDetails);

                            $('#agentbooking').DataTable({
                                    language: {
                                        search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                                        searchPlaceholder: "Search...",
                                        // oPaginate: {
                                        //     sNext: '<i class="fa fa-forward"></i>',
                                        //     sPrevious: '<i class="fa fa-backward"></i>',
                                        //     sFirst: '<i class="fa fa-step-backward"></i>',
                                        //     sLast: '<i class="fa fa-step-forward"></i>'
                                        // }
                                    },
                                    // pagingType: 'input',
                                    // pageLength: 5,
                                    dom: '<Bfr<"table-container"t>ip>',
                                    scrollX: true,
                                    order: [[1, 'desc']],
                                    buttons: [
                                                    {
                                                    extend: "pdf",
                                                    footer: true,
                                                    title: "Agent Booking Details",
                                                    exportOptions: {
                                                        columns: [0,1,2,3,4],
                                                    },
                                                    },
                                                    {
                                                    extend: "csv",
                                                    footer: true,
                                                    title: "Agent Booking Details",
                                                    exportOptions: {
                                                        columns: [0,1,2,3,4],
                                                    },
                                                    },
                                            ],
                                            order: [],
                                    columnDefs: [{
                                        type: "unknownType",
                                        targets: [3],
                                    },],
                            }).draw();
                        });
            }
        }
        var agentsArray;
        function success(data) {
            console.log(data);
            agentsArray = data.data;
            let agentsList = '';
            agentsArray.forEach((agentdetails, index) => {

                agentsList += `<tr>
                                        <td class="td-bule"><a href="#" class="assignd-order" data-id="${agentdetails.agentId}" data-token="${agentdetails.agentToken}">${agentdetails.agentId}</a></td>
                                        <td>
                                            <ul class="table-image">
                                                <li><img src="${agentdetails.profileImage}" alt="andrew"></li>
                                                <li>${agentdetails.name}</li>
                                            </ul>
                                        </td>
                                        <td>
                                        ${agentdetails.joinedDate}
                                        </td>
                                        <td>${agentdetails.mobileNumber}</td>
                                        <td>
                                        ${agentdetails.emailId}
                                        </td>
                                        <td><span>${agentdetails.servicesBooked}</span></td>
                                        <td>${agentdetails.bookingMade}</td>`;
                                        if(agentdetails.status == '1'){
                agentsList +=          `<td><a href="#"><span class="td-bule" onclick="updateAgentStatus('Block','3','${agentdetails.agentToken}')">Block</span></a></td>`;
                                        }else if(agentdetails.status == '3'){
                agentsList +=          `<td><a href="#"><span class="td-bule" onclick="updateAgentStatus('Unblock','1','${agentdetails.agentToken}')">Unblock</span></a></td>`;
                                        }
                agentsList +=          `<td><a href="#"><span class="td-bule" onclick="updateAgentStatus('Delete','2','${agentdetails.agentToken}')">Delete</span><span class="td-bule" onclick="editAgentDetails(${index})" data-target="#edit-profile" data-toggle="modal" style="margin-left: 10px;">Edit</span></a></td>
                                   </tr>`;

            });
            $('#my-agent tbody').html(agentsList);
            $("#my-agent").DataTable({
                language: {
                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                    searchPlaceholder: "Search...",
                    // oPaginate: {
                    //     sNext: '<i class="fa fa-forward"></i>',
                    //     sPrevious: '<i class="fa fa-backward"></i>',
                    //     sFirst: '<i class="fa fa-step-backward"></i>',
                    //     sLast: '<i class="fa fa-step-forward"></i>'
                    // }
                },
                // pagingType: 'input',
                // pageLength: 5,
                buttons: [{
                    extend: "searchBuilder",
                    config: {
                        depthLimit: 2,
                    },
                }, ],
                dom: '<Bfr<"table-container"t>ip>',
                scrollX: true,
                columnDefs: [{
                    type: "unknownType",
                    targets: [3],
                }, ],
            })

            $('.total-stafs').text(`Total Agent(s) - ${agentsArray.length}`);

        }

        function errorcheck(e, r, j) {
            console.log(e.status);
            console.log(r);
            console.log(j);
        }
        // var agentStatus;
        // var agentToken;
        function updateAgentStatus(swalStatus,agentStatus,agentToken){
            swal({
                title: "Are you sure?",
                text: "Do you want to "+swalStatus+" the Agent?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willBlock)=>{
                if(willBlock){
                    let datas = {
                            "agentStatus":agentStatus,
                            "agentToken":agentToken,
                            "swalStatus":swalStatus
                        }
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/updateAgentStatus.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 200){
                            swal(data1.message, {icon: "success",}).then((value) => {
                                    location.reload();
                                });
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });

                        }
                    });
                }
            });



            
        }
        function imagevalidate(id){
            var fuData = document.getElementById(id).files[0].name;
            var FileUploadPath = fuData.value;
            var FileUploadPath1 = fuData.split('.').pop().toLowerCase();

            //To check if user upload any file
            if (fuData == '') {
                swal("Please upload an image");
            } else {
                //The file uploaded is an image
                if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg") {
                    // To Display
                    //alert(fuData);
                    if(id == 'profile_pic'){
                        const [file_profile_pic] = profile_pic.files
                        if (file_profile_pic) {
                            display_profile_pic.src = URL.createObjectURL(file_profile_pic)
                        }                          
                    }                   
                   // field_validation();                   
                }
                //The file upload is NOT an image
                else {
                    swal("Only file types of  PNG, JPG, and JPEG are allowed. ");
                }
            }
        }
        function editAgentDetails(index){
            $("#display_profile_pic").attr("src", agentsArray[index].profileImage);
            $("#edit_agent_title").val(agentsArray[index].agentTitle);
            $("#edit_agent_name").val(agentsArray[index].name);
            $("#edit_mobile_no").val(agentsArray[index].mobileNumber);
            $("#edit_email_address").val(agentsArray[index].emailId);
            $("#edit_agent_token").val(agentsArray[index].agentToken);
        }
        function updateAgent(){
            var validdata = 0;
            $('.employee').prop('disabled',true);
            var agent_title = $("#edit_agent_title").val();
            var agent_name = $("#edit_agent_name").val();
            var mobile_no = $("#edit_mobile_no").val();
            var email_id = $("#edit_email_address").val();
            var profile_image = $("#display_profile_pic").attr("src");

            if(agent_name == ''){
                $(".edit_agent_name_error").css("display","block");
            }else{
                validdata++;
                $(".edit_agent_name_error").css("display","none");
            }
            if(mobile_no == ''){
                $(".edit_mobile_error").css("display","block");
            }else{
                validdata++;
                $(".edit_mobile_error").css("display","none");
            }
            if(email_id == ''){
                $(".edit_email_error").css("display","block");
            }else{
                validdata++;
                $(".edit_email_error").css("display","none");
            }

            if(validdata == 3){
                if($("#profile_pic").val() != ''){
                    image_upload_loop(0);
                }else{
                    $("#valid_profile_pic").val($("#display_profile_pic").attr("src"));
                    on_submit_agent(); 
                }
            }
        }
        function on_submit_agent(){
            var profile_image;
            let countryCode = $("#edit_mobile_no").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
                countryCode = '+'+countryCode.replace(/[^0-9]/g,'');
                if($("#profile_pic").val() != ''){
                    profile_image = $("#valid_profile_pic").val();
                }else{
                    profile_image = $("#display_profile_pic").attr("src"); 
                }
            var inputData = {
                profile_image:profile_image,
                agent_title:$("#edit_agent_title").val(),
                agent_name:$("#edit_agent_name").val(),
                countryCode:countryCode,
                mobile_no:$("#edit_mobile_no").val(),
                email_address:$("#edit_email_address").val(),
                agentToken:$("#edit_agent_token").val()
            }
            var inputJSONData = JSON.stringify(inputData);
            console.log(inputData);
            $.ajax({
                async: false,
                type: 'POST',
                url: apiPath+"/distributor/updateAgentProfile.php",
                data: inputJSONData,
                success: function(response) {
                    if (response.status_code == 200) {
                        swal("", response.message, "success")
                        .then(function() {
                            window.location.reload();
                        });
                    }
                }
            });
        }

        var image_id = ['profile_pic'];
        function image_upload_loop(key){
            var checkkey = key+1;
            if(checkkey>image_id.length){
                on_submit_agent();
            }else{
                var fileUpload = document.getElementById(image_id[key]);
                var file = fileUpload.files[0];
                s3_file_upload(file, key);
            }
        }
        function s3_file_upload(file, key){
            var seconds = new Date().getTime();
            seconds = parseInt(seconds);
            var extension = file.name.split('.').pop().toLowerCase();
            var filename = seconds+key+'.'+extension;
            folderPath = 'agent_profile/';
            var folder = `service_distributor/${folderPath}`;
            var objKey = folder + filename;
            var params = {
                Key: objKey,
                ContentType: file.type,
                Body: file
            };
            bucket.putObject(params, function (err, data) {
                if (err) {
                    alert('ERROR: ' + err);
                }else{
                    var image_fileurl = aws_cloudfront_url+folder+filename;
                    $("#valid_"+image_id[key]).val(image_fileurl);
                    key++;
                    image_upload_loop(key);
                }
            });
        }   
    </script>
</body>

</html>