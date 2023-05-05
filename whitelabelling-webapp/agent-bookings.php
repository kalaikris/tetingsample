<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whitelabeling | Booking Orders</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/agent-bookings.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>

    <style>
        .left-sid-set,
        .left-sid-set>div:first-child {
            display: flex;
            justify-content: flex-start;
            align-items: unset;
        }

        .left-sid-set {
            column-gap: 16px;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <!-- <div id="loading"></div> -->
    <nav></nav> <!-- NAV MENU -->

    <section class="agent-dashboard-body">
        <input type="hidden" id="gtag_id">
        <div class="agent-dashboard-container">
            <aside class="agent-dashboard-sidebar"></aside> <!-- SIDE MENU -->
            <main class="main-content">
                <section class="bookings-container">
                    <div class="box-set">
                        <div class="box-1">
                            <div class="cont-set">
                                <img src="./asset/ongoing.svg" alt="" class="inner-img">
                                <h3 class="card-number ongoingcount">0</h3>
                                <p class="card-cont">Ongoing services</p>
                            </div>
                        </div>
                        <div class="box-3">
                            <div class="cont-set">
                                <img src="./asset/upcoming.svg" alt="" class="inner-img">
                                <h3 class="card-number upcomingcount">0</h3>
                                <p class="card-cont">Upcoming services</p>
                            </div>
                        </div>
                        <div class="box-2">
                            <div class="cont-set">
                                <img src="./asset/completed.svg" alt="" class="inner-img">
                                <h3 class="card-number completedcount">0</h3>
                                <p class="card-cont">Completed services</p>
                            </div>
                        </div>
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/cancelled.svg" alt="" class="inner-img">
                                <h3 class="card-number cancelledcount">0</h3>
                                <p class="card-cont">Cancelled services</p>
                            </div>
                        </div>
                    </div>
                    <div class="date-con-set">
                        <h1 class="booking2-text" style="margin-bottom:16px;">Bookings</h1>
                        <div class="left-sid-set">
                            <!-- <div> -->
                                <div class="arriving-input-set input-group" id="arrive_date">
                                    <label for="from_date" class="input-group-addon bg-date"></label>
                                    <div class="date_pickers">
                                        <label for="from_date">From Date</label>
                                        <input type="text" class="b-input datepicker" id="from_date" placeholder="DD-MMM-YYYY" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_date">
                                    <label for="to_date" class="input-group-addon bg-date"></label>
                                    <div class="date_pickers">
                                        <label for="to_date">To Date</label>
                                        <input type="text" class="b-input datepicker" id="to_date" placeholder="DD-MMM-YYYY" readonly="">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" onclick="agent_date_filter()">Generate</button>
                                <div class="inner-input-field hidden">
                                    <div class="inner-input-field">
                                        <div class="dropdown">
                                            <button onclick="myFunction()" class="dropbtn">
                                                <img src="asset/download-white.svg" alt="">Download as<img src="asset/down.svg" alt="">
                                            </button>
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="javascript:void(0)">CSV</a>
                                                <a href="javascript:void(0)">PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <h1 class="booking2-text">Bookings</h1> -->
                                <!-- <div class="inner-input-field hidden">
                                    <div class="inner-input-field">
                                        <div class="dropdown">
                                            <button onclick="myFunction()" class="dropbtn">
                                                <img src="asset/download-white.svg" alt="">Download as<img src="asset/down.svg" alt="">
                                            </button>
                                            <div id="myDropdown" class="dropdown-content">
                                                <a href="javascript:void(0)">CSV</a>
                                                <a href="javascript:void(0)">PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="booking-table" class="booking-table custom-table display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Booked on</th>
                                    <th>Customer Name</th>
                                    <th>Services Booked</th>
                                    <th>Service Partners</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>
                <section class="booking-details-container hidden">
                    <h1 class="booking2-text">
                        <svg class="back-btn" width="28" height="20" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26 8H6.8L11.42 3.38C11.814 2.986 12 2.516 12 2C12 1.016 11.187 0 10 0C9.469 0 9.006 0.193 8.62 0.58L0.662 8.538C0.334 8.866 0 9.271 0 10C0 10.729 0.279 11.08 0.646 11.447L8.62 19.42C9.006 19.807 9.469 20 10 20C11.188 20 12 18.984 12 18C12 17.484 11.814 17.014 11.42 16.62L6.8 12H26C27.104 12 28 11.104 28 10C28 8.896 27.104 8 26 8Z" fill="black" />
                        </svg>
                        Booking Details
                    </h1>
                    <div class="booking-detail-overview">
                        <div>
                            <p>Booking number: #<span id="booking-num"></span></p>
                            <p>Booked on: <span id="booked-on"></span></p>
                            <p>Passengers: <span id="passengers"></span></p>
                        </div>
                        <span class="hidden" id="booking-status">
                            <span class="widget upcoming"><img src="asset/mybooking/upcoming.svg" alt="">Upcoming</span>
                        </span>
                    </div>
                    <div class="booking-details">
                        <div id="booking-action" style="float: right;"></div>
                        <!-- <button class="sec-btn cancel-btn cancel__booking-btn" data-toggle="modal" data-target="#cancel_booking_modal" style="float: right;">Cancel Booking</button> -->
                        <div class="detail-set passenger-details">
                            <h4>Passenger details</h4>
                            <div id="contact-passenger-list"></div>
                        </div>
                        <div class="detail-set other-passenger-details">
                            <h4>Other Passenger details</h4>
                            <div id="other-passenger-list"></div>
                        </div>
                        <div class="detail-set greeter-details">
                            <h4>Greeter / Family Contact Details</h4>
                            <div id="greet-passenger-list"></div>
                        </div>
                        <div class="detail-set gst-details">
                            <h4>GSTIN Details</h4>
                            <div class="detail-list" id="gstin-list">
                                <div>
                                    <p>Company Name</p>
                                    <p>Mr. Jimmy Garza</p>
                                </div>
                                <div>
                                    <p>GST Number</p>
                                    <p>Mr. Jimmy Garza</p>
                                </div>
                            </div>
                        </div>
                        <div class="detail-set e-ticket" style="display: flex;">
                            <div>
                                <h4>E-Ticket</h4>
                                <div class="detail-list" id="e-ticket-src" style="cursor: pointer; display: block;">
                                    <i class="fa fa-file-pdf-o" style="font-size: 80px; color: red"></i>
                                    <p>Click to open</p>
                                </div>
                            </div>
                            <div class="price-details-set">
                                <h4>Price Details</h4>
                                <div class="price-summary">
                                    <div class="price-summary-details">
                                        <p>Service Cost</p>
                                        <p>₹ <span id="price-detail-service-cost"></span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>GST</p>
                                        <p>₹ <span id="price-detail-gst"></span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee</p>
                                        <p>₹ <span id="price-detail-convenience-fee"></span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee GST</p>
                                        <p>₹ <span id="price-detail-convenience-fee-gst"></span></p>
                                    </div>
                                </div>
                                <div class="summary-division"></div>
                                <div class="total-amt-set">
                                    <p>Total Amount</p>
                                    <p>₹ <span id="price-detail-total-amount"></span></p>
                                </div>
                                <div class="total-amt-set">
                                    <p>Payment Detail</p>
                                    <p><span id="price-detail-payment-detail"></span></p>
                                </div>

                                <div class="invoice-set hidden">
                                    <button class="invoice-btn" onclick="download_file()">
                                        <svg style="margin-right:10px;" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="download" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M19,16.1904762 L17.88,16.1904762 L17.88,18.984127 L6.12,18.984127 L6.12,16.1904762 L5,16.1904762 L5,20 L19,20 L19,16.1904762 Z M11.44,4 L11.44,13.3333333 L7.912,10.1206349 L7.114,10.8444444 L12,15.2761905 L16.886,10.8444444 L16.088,10.1206349 L12.56,13.3333333 L12.56,4 L11.44,4 Z" id="download-icon" stroke="#F04F38" stroke-width="0.984615385" fill="#F04F38" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        Download Invoice
                                    </button>
                                </div>
                            </div>
                        </div>

                        <section class="booked-service-details">
                            <ul class="nav nav-tabs ser-ab-review-tab" id="station-ul">
                                <li class="active">
                                    <a data-toggle="tab" href="#service1" aria-expanded="true">Lounge</a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#service2" class="" aria-expanded="false">Meet</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="service1" class="tab-pane fade active in">
                                    <div class="head_airport">
                                        <!-- <div class="detail_airport">
                                            <img src="asset/home/partner-logo1.png" class="partner_logo">
                                            <div class="set_airport">
                                                <h4>Pravin Test</h4>
                                                <p>Kannur International Airport | Order ID : 9967712916</p>
                                            </div>
                                            <button class="sec-btn cancel-btn cancel__booking-btn" style="margin-left: auto;">Cancel Order</button>
                                        </div> -->
                                        <!-- <div class="flexline">
                                            <div class="detail_airport">
                                                <img alt="" src="asset/dashboard/arrival.svg" class="airport_start">
                                                <div class="">
                                                    <p>Service at</p>
                                                    <h4>Arrival</h4>
                                                </div>
                                            </div>
                                            <div class="detail_airport">
                                                <img alt="" src="asset/dashboard/calender.svg" class="airport_start">
                                                <div class="">
                                                    <p>Service avail date</p>
                                                    <h4>07 Oct 2022 </h4>
                                                </div>
                                            </div>
                                            <div class="detail_airport">
                                                <img alt="" src="asset/dashboard/clock.svg" class="airport_start">
                                                <div class="">
                                                    <p>Service avail time</p>
                                                    <h4>00:00(+05:30)</h4>
                                                </div>
                                            </div>
                                            <div class="detail_airport">
                                                <img alt="" src="asset/dashboard/flight-num.svg" class="airport_start">
                                                <div class="">
                                                    <p>Arrival Flight Number </p>
                                                    <h4>765782</h4>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="detail-set">
                                            <h4>Service details</h4>
                                            <div class="detail-list">
                                                <div>
                                                    <p>Package</p>
                                                    <p>Mr. Jimmy Garza</p>
                                                </div>
                                                <div>
                                                    <p>Passengers</p>
                                                    <p>Mr. Jimmy Garza</p>
                                                </div>
                                                <div>
                                                    <p>Service cost</p>
                                                    <p>Mr. Jimmy Garza</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail-set">
                                            <h4>Note</h4>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, ut dolorem blanditiis commodi veritatis non, ducimus quae. Porro magni maxime perferendis corporis rerum ipsum repellendus, earum dolore placeat optio suscipit.</p>
                                        </div> -->
                                    </div>
                                </div>
                                <div id="service2" class="tab-pane fade">
                                    service 2
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </main>
        </div>
    </section>

    <!-- booking cancel modal -->
    <div id="cancel_booking_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header title-model">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to cancel the booking?</h5>
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="booked-service-details-container">
                        <div class="booked-cont_text">
                            <p>Booked on : <span id="booked-on"></span></p>
                            <!--  <p>Cancelled on : 12 Jul 2022,17:40 (GMT+2)</p> -->
                        </div>
                        <div id="order-service-detail-list">

                        </div>
                        <div class="profile-box-cont1 cost-box">
                            <div class="cost-text">
                                <h6>Total Service Cost</h6>
                                <h5>₹ <span id="total-service-cost">0</span></h5>
                            </div>
                            <div class="cancel-text">
                                <h6>Total Cancellation fee</h6>
                                <h5 style="color: #d22e27;">-₹ <span id="total-cancellation-fee">0</span></h5>
                            </div>
                            <div class="cancel-text">
                                <h6>Total Platform fee</h6>
                                <h5 style="color: #d22e27;">-₹ <span id="platform-fee">0</span></h5>
                            </div>
                            <div class="refund-text">
                                <h6>Total Refundable Amount</h6>
                                <h5>₹ <span id="total-refund">0</span></h5>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Policy">
                            <label class="form-check-label " for="Policy">
                                I hereby declare that I am fully aware of the Cancellation Policy of the service providers and I wish to <br>Cancel the booking.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="review-sub-btn-set">
                        <button type="button" class="primary-butn" onclick="confirmCancellation(0)">Proceed to Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Cancelled Modal -->
    <div id="cancelled_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close success-modal-close" data-dismiss="modal">&times;</button>
                <div class="success-content-set">
                    <svg width="174px" height="174px" viewBox="0 0 174 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="26-Download-App-Notification" transform="translate(-633.000000, -211.000000)">
                                <g id="Group-14" transform="translate(633.000000, 211.000000)">
                                    <path d="M167.100893,118.557663 L161.549829,121.88166 C159.786967,122.937084 158.790258,124.915425 158.98889,126.963039 L159.609617,133.409612 C159.857907,135.991865 158.212096,138.377669 155.715004,139.059023 L149.47582,140.759921 C147.493044,141.300243 145.999754,142.935421 145.63796,144.9603 L144.499371,151.33618 C144.045354,153.889658 141.817834,155.742599 139.22852,155.723416 L132.762328,155.675103 C130.708611,155.659828 128.828698,156.830705 127.934853,158.682936 L125.122077,164.51494 C123.994129,166.850655 121.351609,168.033255 118.861611,167.314956 L112.650803,165.520985 C110.675121,164.951532 108.550464,165.571429 107.191961,167.113534 L102.910725,171.969334 C101.197521,173.913928 98.335087,174.338442 96.1323963,172.973958 L90.6309899,169.567544 C88.8823159,168.485833 86.6689841,168.508569 84.9451392,169.626159 L79.5182199,173.14554 C77.3439052,174.554784 74.4708303,174.189596 72.7186093,172.280881 L68.3380569,167.514602 C66.9476305,166.000561 64.8123329,165.424715 62.8508385,166.035375 L56.675501,167.956878 C54.1996908,168.726332 51.5323422,167.598794 50.3582832,165.286881 L47.4249092,159.514201 C46.4955936,157.680798 44.5908514,156.548643 42.5406819,156.606547 L36.0744899,156.788076 C33.4851754,156.860545 31.2221856,155.05414 30.7149637,152.510609 L29.4451356,146.159596 C29.0407769,144.142533 27.5155643,142.538616 25.5221469,142.039146 L19.2474932,140.467201 C16.7362129,139.837713 15.040744,137.486367 15.2393763,134.899852 L15.7288632,128.441556 C15.8813844,126.390389 14.8456587,124.433362 13.0615146,123.414174 L7.44305703,120.205274 C5.1942552,118.920365 4.19399949,116.198502 5.080751,113.760833 L7.29053577,107.67412 C7.99284297,105.741249 7.52109117,103.575695 6.0774597,102.112454 L1.53374496,97.5046124 C-0.285869147,95.6594864 -0.512877534,92.7688838 0.994600037,90.6608789 L4.76506747,85.3972611 C5.9604085,83.7254931 6.08810072,81.5130471 5.09139202,79.7137474 L1.95938568,74.0490615 C0.703745541,71.7801321 1.26062549,68.9353557 3.28241894,67.3133216 L8.32980855,63.263565 C9.93305528,61.9772344 10.6530975,59.8813078 10.1777987,57.8798754 L8.68450915,51.5778857 C8.08861213,49.0538927 9.39391036,46.4659561 11.7774984,45.4503198 L17.7258276,42.9142485 C19.6163818,42.1085601 20.8755689,40.2847487 20.9571501,38.2296748 L21.2160815,31.7578796 C21.3224917,29.1660353 23.276892,27.0267692 25.8449244,26.6924866 L32.2579113,25.8583789 C34.2938928,25.5933685 35.9964557,24.1770194 36.6278228,22.2203475 L38.6212402,16.0590336 C39.4228636,13.591524 41.8809388,12.0593661 44.4418771,12.4316595 L50.844223,13.3613273 C52.8766575,13.6565333 54.894904,12.7527981 56.0334929,11.0398221 L59.612422,5.64547526 C61.0454124,3.48524983 63.8262652,2.67423278 66.1921182,3.72539329 L72.1049773,6.34991977 C73.9848905,7.18331705 76.1733932,6.85898128 77.7305289,5.51652249 L82.6289442,1.28985546 C84.5904386,-0.402871754 87.4883425,-0.432712065 89.4853069,1.21916234 L94.4688504,5.34387497 C96.0543621,6.65365151 98.2499589,6.93287157 100.10859,6.06075294 L105.964697,3.31473376 C108.312815,2.21526037 111.107856,2.968373 112.58341,5.09875812 L116.275844,10.4177937 C117.446356,12.1069685 119.485884,12.9691404 121.511225,12.6320159 L127.892288,11.5705534 C130.446133,11.1453289 132.936131,12.626332 133.783865,15.07679 L135.904975,21.1958301 C136.578906,23.1390028 138.309845,24.5198277 140.349374,24.7429196 L146.780096,25.4445222 C149.355222,25.7255184 151.352186,27.8239318 151.508255,30.4132893 L151.901972,36.8779797 C152.026118,38.9312774 153.324322,40.7288009 155.229064,41.4947023 L161.230598,43.9075046 C163.635468,44.8741176 164.990425,47.4347005 164.447733,49.9704166 L163.082135,56.3018913 C162.649401,58.3125599 163.412007,60.3932112 165.04363,61.6461491 L170.172601,65.5911093 C172.226317,67.1708696 172.843496,70.0035678 171.633967,72.2977194 L168.615465,78.0259936 C167.657773,79.8455421 167.831577,82.0547909 169.062388,83.7016919 L172.939265,88.8860909 C174.492854,90.9624792 174.322598,93.8569895 172.542001,95.7397711 L168.094055,100.440331 C166.6788,101.933057 166.253159,104.107492 166.994483,106.025798 L169.328413,112.065264 C170.264823,114.484105 169.324866,117.226217 167.100893,118.557663" id="success" fill="#84BC42"></path>
                                    <polyline id="Fill-26" fill="#FFFFFF" points="77.1594609 120.397815 47.8008919 91.0086607 57.0798597 81.7098511 76.8721534 101.519911 118.950286 56.7217871 128.509467 65.7296536 77.1594609 120.397815"></polyline>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <div class="confite-text">
                        <h2>Booking Cancelled</h2>
                    </div>
                    <div class="booking-info-set">
                        <p>You have successfully cancelled the booking for ID <span id="cancel-order-id">34567</span>. It will take 2-4 business days for the refundable amount to be deposited in your bank account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/custom.js<?php echo $cache_str; ?>"></script>

    <script>
        var curBookingDetail = {};
        var isCompleteBooking = false;
        var globalBookingToken = 0;
        var globalBookingNumber = 0;

        $('.nav-dash').text("Website");
        $('.nav-dash').attr("href", "index");

        $(document).ready(function() {
            $('#service_date_input').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MMM-YYYY'
            });
            $('#service_date_input').val("");

            $("#from_date").datetimepicker({
                date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
                maxDate: new Date()
            });
            $('#to_date').datetimepicker({
                date: new Date(),
                ignoreReadonly: true,
                format: 'DD-MM-YYYY',
                maxDate: new Date()
            });
        })

        // Dropdown action
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
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

        function getDetail(bookingToken, bookingNumber) {
            globalBookingToken = bookingToken;
            globalBookingNumber = bookingNumber;
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-booking/get-order-detail.php',
                data: JSON.stringify({'token': bookingToken}),
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var bookingDetailData = response.data;
                        curBookingDetail = bookingDetailData;

                        $('#booking-num').text(curBookingDetail.booking_number);
                        $('#booked-on').text(curBookingDetail.date_time);

                        var passengerDetail = [];
                        var adultCount = parseInt(curBookingDetail.total_adult);
                        var childrenCount = parseInt(curBookingDetail.total_children);
                        if (adultCount) {
                            var pluralView = (adultCount > 1)? ` Adults`:` Adult`;
                            passengerDetail.push(adultCount + pluralView);
                        }
                        if (childrenCount) {
                            var pluralView = (adultCount > 1)? ` Children`:` Child`;
                            passengerDetail.push(childrenCount + pluralView);
                        }
                        var passengerView = passengerDetail.join(" | ");
                        $('#passengers').text(passengerView);

                        $("#e-ticket-src").attr("onclick", `window.open('${curBookingDetail.e_ticket}')`);

                        $('#contact-passenger-list').empty();
                        $('#other-passenger-list').empty();
                        $('#greet-passenger-list').empty();
                        curBookingDetail.passenger_detail.forEach(function (passengerObj) {
                            switch (passengerObj.passenger_type) {
                                case 'Contact':
                                    passengerObj.passenger_array.forEach(function (passengerDetail) {
                                        $('#contact-passenger-list').append(`<div class="detail-list">
                                            <div>
                                                <p>Contact Passenger Name</p>
                                                <p>${passengerDetail.name_view}</p>
                                            </div>
                                            <div>
                                                <p>Contact Number</p>
                                                <p>${passengerDetail.mobile_view}</p>
                                            </div>
                                            <div>
                                                <p>Email Address</p>
                                                <p>${passengerDetail.email_id}</p>
                                            </div>
                                        </div>`);
                                            // <div>
                                            //     <p>Age</p>
                                            //     <p>${passengerDetail.age}</p>
                                            // </div>
                                    });
                                    break;

                                case 'Others':
                                    passengerObj.passenger_array.forEach(function (passengerDetail) {
                                        $('#other-passenger-list').append(`<div class="detail-list">
                                            <div>
                                                <p>Passenger Name</p>
                                                <p>${passengerDetail.name_view}</p>
                                            </div>
                                            <div>
                                                <p>Contact Number</p>
                                                <p>${passengerDetail.mobile_view}</p>
                                            </div>
                                            <div>
                                                <p>Email Address</p>
                                                <p>${passengerDetail.email_id}</p>
                                            </div>
                                        </div>`);
                                            // <div>
                                            //     <p>Age</p>
                                            //     <p>${passengerDetail.age}</p>
                                            // </div>
                                    });
                                    break;

                                    case 'Greeter':
                                        passengerObj.passenger_array.forEach(function (passengerDetail) {
                                            $('#greet-passenger-list').append(`<div class="detail-list">
                                                <div>
                                                    <p>Contact Person Name</p>
                                                    <p>${passengerDetail.name_view}</p>
                                                </div>
                                                <div>
                                                    <p>Contact Number</p>
                                                    <p>${passengerDetail.mobile_view}</p>
                                                </div>
                                            <div>`);
                                        });
                                        break;
                            
                                default:
                                    break;
                            }
                        });
                        if ($('#contact-passenger-list').html() === "") {
                            $('#contact-passenger-list').closest('.detail-set').css("display", "none");
                        } else {
                            $('#contact-passenger-list').closest('.detail-set').css("display", "block");
                        }
                        if ($('#other-passenger-list').html() === "") {
                            $('#other-passenger-list').closest('.detail-set').css("display", "none");
                        } else {
                            $('#other-passenger-list').closest('.detail-set').css("display", "block");
                        }
                        if ($('#greet-passenger-list').html() === "") {
                            $('#greet-passenger-list').closest('.detail-set').css("display", "none");
                        } else {
                            $('#greet-passenger-list').closest('.detail-set').css("display", "block");
                        }

                        $('#gstin-list').empty();
                        if (curBookingDetail.gst_name == "" && curBookingDetail.gst_number == "") {
                            $('#gstin-list').closest('.detail-set').css("display", "none");
                        } else {
                            $('#gstin-list').html(`<div class="detail-list">
                                <div>
                                    <p>Company Name</p>
                                    <p>${curBookingDetail.gst_name}</p>
                                </div>
                                <div>
                                    <p>GST Number</p>
                                    <p>${curBookingDetail.gst_number}</p>
                                </div>
                            <div>`);
                            $('#gstin-list').closest('.detail-set').css("display", "block");
                        }

                        $("#price-detail-service-cost").text(curBookingDetail.service_amount);
                        $("#price-detail-gst").text(curBookingDetail.service_gst);
                        $("#price-detail-convenience-fee").text(curBookingDetail.convenience_fee);
                        $("#price-detail-convenience-fee-gst").text(curBookingDetail.cf_tax);
                        if ($("#price-detail-convenience-fee").html() == "0") {
                            $("#price-detail-convenience-fee").closest(".price-summary-details").css("display", "none");
                        } else {
                            $("#price-detail-convenience-fee").closest(".price-summary-details").css("display", "flex");
                        }
                        if ($("#price-detail-convenience-fee-gst").html() == "0") {
                            $("#price-detail-convenience-fee-gst").closest(".price-summary-details").css("display", "none");
                        } else {
                            $("#price-detail-convenience-fee-gst").closest(".price-summary-details").css("display", "flex");
                        }
                        $("#price-detail-total-amount").text(curBookingDetail.total_amount);
                        if (curBookingDetail.currency != 'INR') {
                            $('#price-detail-payment-detail').text(curBookingDetail.currency + ' ' + curBookingDetail.payment_view);
                            $('#price-detail-payment-detail').closest(".total-amt-set").css("display", "flex");
                        } else {
                            $('#price-detail-payment-detail').closest(".total-amt-set").css("display", "none");
                        }

                        var orderStatus = bookingDetailData.status;

                        var cancellableOrders = 0;
                        var stationTypeArr = [];
                        curBookingDetail.order_detail.forEach(function (tempStationObj) {
                            if (stationTypeArr.indexOf(tempStationObj.airport_type) < 0) {
                                stationTypeArr.push(tempStationObj.airport_type);
                            }
                            tempStationObj.order_detail_array.forEach(function (tempServiceObj) {
                                if (tempServiceObj.can_be_cancelled) {
                                    cancellableOrders++;
                                }
                            });
                        });
                        
                        if (cancellableOrders) {
                            $('#booking-action').html(`<button class="sec-btn cancel-btn cancel__booking-btn" data-dismiss="modal" onclick="cancelBooking(true)">Cancel Booking</button>`);
                        } else {
                            $('#booking-action').html(`<button class="sec-btn cancel-btn cancel__booking-btn" data-dismiss="modal" onclick="cancelBooking(false)">Check Status</button>`);
                        }
                        
                        switch(bookingDetailData.status) {
                            case 'Pending':
                                status = `<span class="widget upcoming" style="visibility: hidden;">
                                    <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                    <span>Upcoming</span>
                                </span>`;
                                orderStatus = 'Upcoming';
                                break;

                            case 'Ongoing':
                                status = `<span class="widget completed" style="visibility: hidden;">
                                    <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                    <span>Ongoing</span>
                                </span>`;
                                break;
                                
                            case 'Completed':
                                status = `<span class="widget completed">
                                    <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                    <span>Completed</span>
                                </span>`;
                                break;
                                
                            case 'Cancelled':
                                status = `<span class="widget cancelled">
                                    <img src="asset/mybooking/cancel.svg" class="coint-icon" alt="icon">
                                    <span>Cancelled</span>
                                </span>`;
                                break;

                            default:
                                status = ``;
                                break;
                        }
                        
                        $('#station-ul').empty();
                        $('.tab-content').empty();
                        curBookingDetail.order_detail.forEach(function (stationDetail, stationKey) {
                            var ulActiveness = (stationKey > 0)? ``: `active`;
                            var tabActiveness = (stationKey > 0)? ``: `active in`;

                            var serviceViews = [];
                            stationDetail.order_detail_array.forEach(function (serviceObj) {
                                var serviceStatus = '';
                                switch(serviceObj.status) {
                                    case 'Pending':
                                    case 'Confirmed':
                                    case 'Assign':
                                        serviceStatus = `<span class="widget upcoming">
                                            <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                            <span>Upcoming</span>
                                        </span>`;
                                        break;

                                    case 'Ongoing':
                                        serviceStatus = `<span class="widget completed">
                                            <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                            <span>Ongoing</span>
                                        </span>`;
                                        break;
                                        
                                    case 'Completed':
                                        serviceStatus = `<span class="widget completed">
                                            <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                            <span>Completed</span>
                                        </span>`;
                                        break;
                                        
                                    case 'Cancelled':
                                        var tempStatus = "Cancelled";
                                        if (serviceObj.cancelled_by != 'User') {
                                            tempStatus += " by " + serviceObj.cancelled_by;
                                        }
                                        serviceStatus = `<span class="widget cancelled">
                                            <img src="asset/mybooking/cancel.svg" class="coint-icon" alt="icon">
                                            <span>${tempStatus}</span>
                                        </span>`;
                                        break;

                                    default:
                                        status = ``;
                                        break;
                                }
                                var notesView = (serviceObj.notes == '')? ``: `<div class="detail-set">
                                        <h4>Note</h4>
                                        <p>${serviceObj.notes}</p>
                                    </div>`;
                                serviceViews.push(`<div class="service-single">
                                    <div class="detail_airport">
                                        <img src="${serviceObj.company_logo}" class="partner_logo">
                                        <div class="set_airport">
                                            <h4>${serviceObj.company_name}</h4>
                                            <p>${serviceObj.service_name} | Order ID : ${serviceObj.token}</p>
                                        </div>
                                        <button class="sec-btn cancel-btn cancel__booking-btn" style="margin-left: auto; display: none" onclick="cancelOrder('${serviceObj.service_token}')">Cancel Order</button>
                                    </div>
                                    <div class="detail-set">
                                        <h4 style="display: none;">Service details</h4>
                                        <div class="detail-list">
                                            <div>
                                                <p>Package Type</p>
                                                <p>${serviceObj.service_type}</p>
                                            </div>
                                            <div>
                                                <p>Passengers</p>
                                                <p>${passengerView}</p>
                                            </div>
                                            <div>
                                                <p>Service Cost</p>
                                                <p>₹ ${serviceObj.net_amount}</p>
                                            </div>
                                            <div>
                                                <p>Service Status</p>
                                                ${serviceStatus}
                                            </div>
                                        </div>
                                    </div>
                                    ${notesView}
                                </div>`);
                            });
                            
                            var typeIcon = ``;
                            switch (stationDetail.airport_type) {
                                case 'Arrival':
                                    typeIcon = `asset/service-details/arrival-line.svg`;
                                    break;
                                case 'Departure':
                                    typeIcon = `asset/service-details/departure-line.svg`;
                                    break;
                                case 'Transit':
                                    typeIcon = `asset/service-details/transit-line.svg`;
                                    break;
                            
                                default:
                                    typeIcon = `asset/dashboard/arrival-line.svg`;
                                    break;
                            }
                            var stationView = ``;
                            stationView += `<div style="padding: 20px 0px;"><h3>${stationDetail.airport_name} (${stationDetail.airport_code}) - ${stationDetail.terminal_name}</h3></div>
                            <div class="flexline">
                                <div class="detail_airport">
                                    <img alt="" src="${typeIcon}" class="airport_start">
                                    <div class="">
                                        <p>Service At</p>
                                        <h4>${stationDetail.airport_type}</h4>
                                    </div>
                                </div>
                                <div class="detail_airport">
                                    <img alt="" src="asset/dashboard/calender.svg" class="airport_start">
                                    <div class="">
                                        <p>Service Avail Date</p>
                                        <h4>${stationDetail.order_detail_array[0].service_date}</h4>
                                    </div>
                                </div>
                                <div class="detail_airport">
                                    <img alt="" src="asset/dashboard/clock.svg" class="airport_start">
                                    <div class="">
                                        <p>Service Avail Time</p>
                                        <h4>${stationDetail.order_detail_array[0].service_time} (GMT ${stationDetail.gmt_view})</h4>
                                    </div>
                                </div>
                                <div class="detail_airport">
                                    <img alt="" src="asset/dashboard/flight-num.svg" class="airport_start">
                                    <div class="">
                                        <p>Flight Number </p>
                                        <h4>${stationDetail.flight_number}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="service-collection">
                                ${serviceViews.join(`<hr>`)}
                            </div>`;

                            $('#station-ul').append(`<li class="${ulActiveness}"><a data-toggle="tab" href="#service-tab-${stationKey}" aria-expanded="true">${stationDetail.airport_code}</a></li>`);
                            $('.tab-content').append(`<div id="service-tab-${stationKey}" class="tab-pane fade ${tabActiveness}">${stationView}</div>`);
                        });
                    } else {
                        swal("", response.message, "error");
                    }
                }
            });

            $(".bookings-container").addClass('hidden');
            $(".booking-details-container").removeClass('hidden');
        }

        $(".back-btn").click(function() {
            $(".bookings-container").removeClass('hidden');
            $(".booking-details-container").addClass('hidden');
        });

        function cancelOrder(serviceToken) {

        }

        function cancelBooking(hasCancellableService) {
            var totalServiceCost = 0;
            var totalCancellationFee = 0;
            var totalAirportzoCancellationFee = 0;
            var totalRefundAmount = 0;
            var cancelServiceCount = 0;

            $('#booked-on').text(curBookingDetail.date_time);

            var orderServiceCancellationDetail = ``;
            curBookingDetail.order_detail.forEach(function(stationObj) {
                stationObj.order_detail_array.forEach(function(serviceObj) {
                    var cancellationDetail = serviceObj.cancellation_detail;

                    var actionBtn = ``;
                    var maxPlatformFeeTitle = ``;
                    var maxPlatformFeeSup = ``;
                    if (serviceObj.can_be_cancelled) {
                        totalServiceCost += parseInt(serviceObj.net_amount);
                        cancelServiceCount++;
                        totalCancellationFee += parseInt(cancellationDetail.cancellation_fee);
                        totalAirportzoCancellationFee += parseInt(cancellationDetail.airportzo_fee);
                        totalRefundAmount += parseInt(cancellationDetail.refund_amount);

                        maxPlatformFeeTitle = `title="Max : ₹ ${cancellationDetail.max_airportzo_fee}"`;
                        maxPlatformFeeSup = `<sup>*</sup>`;
                        actionBtn = `<button class="sec-btn cancel__booking-btn" onclick="confirmCancellation('${serviceObj.token}')">Cancel Order</button>`;
                    } else if (serviceObj.status == "Cancelled" && parseInt(serviceObj.cancellation_detail.refund_amount) > 0) {
                        actionBtn = `<div class="cancel-text avail-text">
                            <p>Refund Status</p>
                            <button class="status-btn">${cancellationDetail.refund_status}</button>
                        </div>`;
                    } else {
                        actionBtn = `<div class="cancel-text avail-text">
                            <p>Service Status</p>
                            <button class="status-btn">${serviceObj.status}</button>
                        </div>`;
                    }
                    var cancellationHours = parseInt(cancellationDetail.cancellation_hours);
                    var cancelBefore = "";
                    if (cancellationHours > 0) {
                        cancelBefore = cancellationHours + ' hr(s)';
                    } else {
                        cancelBefore = "-";
                    }
                    
                    orderServiceCancellationDetail += `<div class="profile-box-cont1">
                        <div class="service-titles">
                            <div class="cancel-sp-img">
                                <img src="${serviceObj.company_logo}" class="modal-header-logo" alt="logo">
                            </div>
                            <div class="service-info">
                                <h6>${serviceObj.company_name}</h6>
                                <p>${stationObj.airport_name}</p>
                            </div>
                        </div>
                        <div class="avail-text">
                            <p>Service Avail Date</p>
                            <h6 class="service-time">${serviceObj.service_date}<br/>${serviceObj.service_time} ${stationObj.gmt_view}</h6>
                        </div>
                        <div class="cost-text avail-text">
                            <p>Service Cost</p>
                            <h6>₹ ${serviceObj.net_amount}</h6>
                        </div>
                        <div class="cancel-text avail-text">
                            <p>Cancel Before</p>
                            <h6>${cancelBefore}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Cancellation fee</p>
                            <h6>₹ ${cancellationDetail.cancellation_fee}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Platform fee</p>
                            <h6 style="cursor: pointer;" ${maxPlatformFeeTitle}>₹ ${cancellationDetail.airportzo_fee}${maxPlatformFeeSup}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Refund Amount</p>
                            <h6>₹ ${cancellationDetail.refund_amount}</h6>
                        </div>
                        ${actionBtn}
                        <!-- <div class="status-box">
                            <button class="status-btn">Refunded</button>
                        </div> -->
                    </div>
                    <div class="form-divider"></div>`;
                });
            });
            totalCancellationFee = Math.round(totalCancellationFee);
            var totalRefund = totalServiceCost - totalCancellationFee; // - (cancelServiceCount * airportzo_cancel_fee);
            $('#total-service-cost').text(totalServiceCost);
            $('#total-cancellation-fee').text(totalCancellationFee);
            $('#platform-fee').text(totalAirportzoCancellationFee);
            $('#total-refund').text(totalRefundAmount);
            $('#order-service-detail-list').html(orderServiceCancellationDetail);

            if (cancelServiceCount) {
                $('#cancel_booking_modal').find('.cost-box').css('display', 'flex');
                $('#cancel_booking_modal').find('.form-check').css('display', 'block');
                $('#cancel_booking_modal').find('.modal-footer').css('display', 'block');
            } else {
                $('#cancel_booking_modal').find('.cost-box').css('display', 'none');
                $('#cancel_booking_modal').find('.form-check').css('display', 'none');
                $('#cancel_booking_modal').find('.modal-footer').css('display', 'none');
            }
            $('#exampleModalLongTitle').text(hasCancellableService? 'Are you sure to cancel the booking?': 'Status of all services in booking');
            $('#cancel_booking_modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        function confirmCancellation(service_token) {
            if($('#Policy').is(":checked")) {
                var inputData = {};
                var serverCallUrl = "";
                var cancelType = "";
                if ( service_token == '0' ) {
                    cancelType = "booking";
                    inputData = {
                        'booking_token': globalBookingToken
                    };
                    serverCallUrl = 'php/users-booking/cancel-booking.php';
                } else {
                    cancelType = "service";
                    inputData = {
                        'booking_token': globalBookingToken,
                        'order_detail_token': service_token
                    };
                    serverCallUrl = 'php/users-booking/cancel-order.php';
                }
                swal({
                    title: "Are you sure?",
                    text: "Do you want to cancel the " + cancelType + " ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        inputJSONData = JSON.stringify(inputData);
                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: serverCallUrl,
                            data: inputJSONData,
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status_code == 200) {
                                    var tempBookingNumber = (isCompleteBooking)? globalBookingNumber: globalBookingNumber + '[' + service_token + ']';
                                    $('#cancel-order-id').text(tempBookingNumber);
                                    $('#cancel_booking_modal').modal('hide');
                                    $('#cancelled_modal').modal({backdrop: 'static', keyboard: false});
                                    $('#cancelled_modal').on('hidden.bs.modal', function () {
                                        location.reload();
                                    });
                                } else {
                                    swal(response.message);
                                }
                            }
                        });
                    } else {
                        swal("Your " + cancelType + " is safe!");
                    }
                });
            } else {
                swal({
                    text: "Please accept terms and conditions !",
                    icon: "warning",
                });
            }
        }
    </script>

    <script>
        var table;
        $(document).ready(function() {
            var userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                window.location.href = "index.php";
            } else {
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                fromDate = formatDate(fromDate);
                toDate = formatDate(toDate);
                let data = {
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "JSON",
                    data: json_data,
                    url: 'php/users-booking/read-history.php',
                    success: function(response) {
                        refreshTable(response);
                    }
                });
                // setTimeout(function(){$('#loading').fadeOut();}, 500);
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
                var tbody_html = '';
                responseData.forEach(function(orderData, orderKey) {
                    // if (orderData.for_others) {
                    if (orderData.is_agent) {
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

                        var serviceStatus = '';
                        orderData.services_status.forEach(ssElement => {
                        // switch(orderData.status) {
                            switch(ssElement) {
                                case 'Assign':
                                case 'Pending':
                                    serviceStatus = `<span class="widget upcoming" style="float: right;">
                                        <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                        <span>Upcoming</span>
                                    </span>`;
                                    upcomingBooking++;
                                    break;

                                case 'Ongoing':
                                    serviceStatus = `<span class="widget completed" style="float: right;">
                                        <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                        <span>Ongoing</span>
                                    </span>`;
                                    ongoingBooking++;
                                    break;
                                    
                                case 'Completed':
                                    serviceStatus = `<span class="widget completed" style="float: right;">
                                        <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                        <span>Completed</span>
                                    </span>`;
                                    completedBooking++;
                                    break;
                                    
                                case 'Cancelled':
                                    serviceStatus = `<span class="widget cancelled" style="float: right;">
                                        <img src="asset/mybooking/cancel.svg" class="coint-icon" alt="icon">
                                        <span>Cancelled</span>
                                    </span>`;
                                    cancelledBooking++;
                                    break;

                                default:
                                    status = ``;
                                    break;
                            }
                        });

                        var serviceArr = [];
                        orderData.services.forEach(function (serviceObj) {
                            serviceArr.push(`<span>${serviceObj}</span>`);
                        });

                        tbody_html += `<tr data-date="${orderData.date_time}">
                            <td class="table-data-link" onclick="getDetail('${orderData.token}', '${orderData.booking_number}')">${orderData.booking_number}</td>
                            <td>
                                <p>${orderData.date_time}</p>
                                <p>${orderData.booking_time}</p>
                            </td>
                            <td>
                                <p>${orderData.customer_name}</p>
                                <p>
                                    <span>${passengerView}</span>
                                </p>
                            </td>
                            <td>
                                <p>${orderData.total_service} Service(s)</p>
                                <p>
                                    ${serviceArr.join('<br/>')}
                                </p>
                            </td>
                            <td>
                                ${orderData.service_providers.join('<br/>')}
                            </td>
                        </tr>`;
                            // <td>
                            //     ${serviceStatus}
                            // </td>
                    }
                    $('.ongoingcount').text(ongoingBooking);
                    $('.upcomingcount').text(upcomingBooking);
                    $('.completedcount').text(completedBooking);
                    $('.cancelledcount').text(cancelledBooking);
                });
                $('#booking-table > tbody').html(tbody_html);
                if (totalBooking == 0) {
                    $('#booking-table > tbody').append(`<tr><td colspan=6><center>No bookings found</center></td></tr>`);
                }
                table = $('#booking-table').DataTable({
                    "aaSorting": [],
                    scrollX: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: 'Search',
                        lengthMenu: "Showing _MENU_ of 25 bookings",
                        paginate: {
                            previous: "<",
                            next: ">"
                        }
                    },
                    dom: '<f<"table-box"t>lp>',
                });
                // $('#from_date').on('dp.change', function(e) {
                //     var filterDate = $(this).val();
                //     filterDate = filterDate.replaceAll("-", " ");
                    
                //     $.fn.dataTable.ext.search.pop();
                //     $.fn.dataTable.ext.search.push(
                //         function(settings, data, dataIndex) {
                //             return $(table.row(dataIndex).node()).attr('data-date') == filterDate;
                //         }
                //     );
                //     table.draw();
                // });

                // $("#reset").click(function() {
                //     $.fn.dataTable.ext.search.pop();
                //     table.draw();
                // });
            } else {
                swal("", response.message, "error");
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
                let data = {
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "JSON",
                    data: json_data,
                    url: 'php/users-booking/read-history.php',
                    success: function(response) {
                        $("#booking-table").DataTable().destroy();
                        refreshTable(response);
                    }
                });
            }else{
                swal("Enter Valid Date Range");
            }
        }
        function formatDate(date) {
            let [day,month,year] = date.split('-');
            return [year, month, day].join('-');
        }
    </script>
</body>

</html>