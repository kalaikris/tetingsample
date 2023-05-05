<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | My History</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <!--LOADER-->
        <div id="loading"></div>
        
        <!-- NAV MENU -->
        <nav></nav>
        
        <section class="cart-sec">
            <div class="container">
                <div class="bookhisty-main-set">
                    <div class="bookhisty-left">
                        <div class="bookhisty-left-inner-set">
                            <input type="hidden" id="gtag_id">
                            <div class="bookhisty-header">
                                <h2>MAA - DXB - FRA</h2>
                                <p>25 Jul, 2022 (6:30 PM) to 05 Aug, 2022 (11:00 AM)</p>
                                <div class="header-division"></div>
                            </div>
                            <div class="history-lists">
                                <div class="history-list">
                                    <p>Booking ID</p>
                                    <h4>97698279</h4>
                                </div>
                                <div class="history-list">
                                    <p>Service Type</p>
                                    <h4>Multi Journey</h4>
                                </div>
                                <div class="history-list">
                                    <p>Passengers</p>
                                    <h4>2 Adults, 2 Children</h4>
                                </div>
                                <div class="history-list">
                                    <p>Total services</p>
                                    <h4>4 services</h4>
                                </div>
                                <div class="history-list">
                                    <span class="widget upcoming" data-bookingstatus="">
                                        <img src="asset/mybooking/upcoming.svg" class="completed-icon" alt="icon">
                                        <span>Upcoming</span>
                                    </span>
                                </div>
                            </div>
                            <div class="list-division"></div>
                            <div class="accordion">
                                <div class="accordion-item">
                                    <button id="accordion-button-1" aria-expanded="false">
                                        <span class="accordion-title">Services booked</span>
                                        <span class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <div class="booked-service-set">
                                            <div class="service-header">
                                                <h4>MAA</h4>
                                                <p>Chennai Internatinal Airport -Terminal 1</p>
                                                <h3>25 Jun, 2022 (6:30 PM)</h3>
                                            </div>
                                            <div class="product-desc-set">
                                                <div class="prod-log-set">
                                                    <img src="asset/mybooking/service-logo.png" class="prod-logo" alt="">
                                                </div>
                                                <div class="prod-price-desc">
                                                    <div class="prod-name-id-feedback-set">
                                                        <div class="prod-name-id-set">
                                                            <h2>Pranaam</h2>
                                                            <p>Order ID : 336757</p>
                                                        </div>
                                                        <div class="prod-feedback-set">
                                                            <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                                                            <div class="report-prblm-set">
                                                                <a data-toggle="modal" data-target="#report_modal">Report a Problem</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="prod-type-price-set">
                                                        <p>Silver package | 2 Adults</p>
                                                        <h6>₹ 1,000</h6>
                                                    </div>
                                                    <div class="star-rating-set">
                                                        <div class="star-rating">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="prod-hst-division"></div>
                                            <div class="product-desc-set">
                                                <div class="prod-log-set">
                                                    <img src="asset/mybooking/service-logo.png" class="prod-logo" alt="">
                                                </div>
                                                <div class="prod-price-desc">
                                                    <div class="prod-name-id-feedback-set">
                                                        <div class="prod-name-id-set">
                                                            <h2>Pranaam</h2>
                                                            <p>Order ID : 336757</p>
                                                        </div>
                                                        <div class="prod-feedback-set">
                                                            <img src="asset/choose-service/more.svg" class="more-icon"
                                                                alt="icon">
                                                            <div class="report-prblm-set">
                                                                <a data-toggle="modal" data-target="#report_modal">Report a Problem</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="prod-type-price-set">
                                                        <p>Silver package | 2 Adults</p>
                                                        <h6>₹ 1,000</h6>
                                                    </div>
                                                    <div class="star-rating-set">
                                                        <a href="javascript:void(0)" class="rateus-link" data-toggle="modal" data-target="#rateus_modal">Rate us</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="booked-service-set">
                                            <div class="service-header">
                                                <h4>MAA</h4>
                                                <p>Chennai Internatinal Airport -Terminal 1</p>
                                                <h3>25 Jun, 2022 (6:30 PM)</h3>
                                            </div>
                                            <div class="product-desc-set">
                                                <div class="prod-log-set">
                                                    <img src="asset/mybooking/service-logo.png" class="prod-logo" alt="">
                                                </div>
                                                <div class="prod-price-desc">
                                                    <div class="prod-name-id-feedback-set">
                                                        <div class="prod-name-id-set">
                                                            <h2>Pranaam</h2>
                                                            <p>Order ID : 336757</p>
                                                        </div>
                                                        <div class="prod-feedback-set">
                                                            <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                                                            <div class="report-prblm-set">
                                                                <a data-toggle="modal" data-target="#report_modal">Report a Problem</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="prod-type-price-set">
                                                        <p>Silver package | 2 Adults</p>
                                                        <h6>₹ 1,000</h6>
                                                    </div>
                                                    <div class="star-rating-set">
                                                        <div class="star-rating">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                            <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-2" aria-expanded="false">
                                        <span class="accordion-title">Passenger details</span>
                                        <span class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <div class="passenger-details-set">
                                            <div class="passenger-details-item">
                                                <p>Contact Passenger Name</p>
                                                <h4>Mr. Jimmy Garza</h4>
                                            </div>
                                            <div class="passenger-details-item">
                                                <p>Contact Number</p>
                                                <h4>+91 7687469245</h4>
                                            </div>
                                            <div class="passenger-details-item">
                                                <p>Other Passengers</p>
                                                <h4>Mr. Alvin Sanchez, Mrs. Genevieve Schneider</h4>
                                                <h4>Mr. Billy Roy</h4>
                                            </div>
                                        </div>
                                        <h4 class="sub-details-title">Emergency Contact Details</h4>
                                        <div class="passenger-details-set">
                                            <div class="passenger-details-item">
                                                <p>Contact Person Name</p>
                                                <h4>Mrs. Celia Abbott</h4>
                                            </div>
                                            <div class="passenger-details-item">
                                                <p>Contact Number</p>
                                                <h4>+91 8796287353</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-2" aria-expanded="false">
                                        <span class="accordion-title">Flight Details</span>
                                        <span class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>-</p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-2" aria-expanded="false">
                                        <span class="accordion-title">GSTIN Details</span>
                                        <span class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>-</p>
                                    </div>
                                </div>
                            </div>

                            <div class="cancel">
                                <button class="sec-btn cancel__booking-btn" data-toggle="modal" data-target="#success_modal">Cancel Booking</button>
                            </div>
                        </div>
                    </div>
                    <div class="bookhisty-right">
                        <div class="bookhisty-inner-set">
                            <div class="price-details-set">
                                <h4>Price Details</h4>
                                <div class="price-summary">
                                    <div class="price-summary-details">
                                        <p>Service Cost</p>
                                        <p>₹ 5,600</p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>GST</p>
                                        <p>₹ 480</p>
                                    </div>
                                </div>
                                <div class="summary-division"></div>
                                <div class="total-amt-set">
                                    <p>Total Amount</p>
                                    <p>₹ 5,520</p>
                                </div>
                                <div class="invoice-set">
                                    <button class="invoice-btn">Download Invoice</button>
                                </div>
                            </div>
                            <div class="cancellation_details hidden">
                                <div class="cancel-title">
                                    <div class="cancel-fee-text">
                                        <h4>Cancellation Fee</h4>
                                        <h2>-₹ 1,346</h2>
                                    </div>
                                    <div class="cancel-fee-text">
                                        <h4>Refundable Amount</h4>
                                        <h2 class="text-refund">-₹ 1,346</h2>
                                    </div>
                                </div>
                                <div class="refunded-cont">
                                    <button class="refunde-btn">Refunded</button>
                                </div>
                                <div class="text-right">
                                    <button class="sec-btn check__details-btn" data-toggle="modal" data-target="#cancellation-details-modal">Check details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer"></footer>
    </div>



    <!-- ========================= POPUPS ========================= -->

    <!-- Success Modal -->
    <div id="success_modal" class="modal fade" role="dialog">
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
                        <p>You have successfully cancelled the booking for ID <span>34567</span>. It will take 2-4 business days for the refundable amount to be deposited in your bank account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="modal fade" id="cancellation-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header title-model">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cancellation/Refund details</h5>
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="" style="padding: 0px 60px 20px;">
                        <div class="booked-cont_text">
                            <p>Booked on : 01 Jul 2022 17:40(GMT+2)</p>
                            <!--  <p>Cancelled on : 12 Jul 2022,17:40 (GMT+2)</p> -->
                        </div>
                        <div class="profile-box-cont1">
                            <div class="service-titles">
                                <div class="">
                                    <img src="asset/choose-service/service-logo.png" class="modal-header-logo" alt="logo">
                                </div>
                                <div class="">
                                    <h6>Pranaam</h6>
                                    <p>Bangalore Airport</p>
                                </div>
                            </div>
                            <div class="avail-text">
                                <p>service Avail Date</p>
                                <h6>15 Jul 2022</h6>
                                <h6>13:00(GMT+1)</h6>
                            </div>
                            <div class="cost-text avail-text">
                                <p>Service Cost</p>
                                <h6>₹ 1,200</h6>
                            </div>
                            <div class="cancel-text avail-text">
                                <p>Cancel before</p>
                                <h6>48 hrs</h6>
                            </div>
                            <div class="cancelfee-text avail-text">
                                <p>Cancellation fee</p>
                                <h6>₹ 200</h6>
                            </div>
                            <div class="refund-text avail-text">
                                <p>Refund Amount</p>
                                <h6>₹ 1,000</h6>
                            </div>
                            <!-- <div class="status-box">
                               <button class="status-btn">Refunded</button>
                            </div> -->
                        </div>
                        <div class="form-divider"></div>
                        <div class="profile-box-cont1">
                            <div class="service-titles">
                                <div class="">
                                    <img src="asset/choose-service/service-logo.png" class="modal-header-logo" alt="logo">
                                </div>
                                <div class="">
                                    <h6>Pranaam</h6>
                                    <p>Bangalore Airport</p>
                                </div>
                            </div>
                            <div class="avail-text">
                                <p>service Avail Date</p>
                                <h6>15 Jul 2022</h6>
                                <h6>13:00(GMT+1)</h6>
                            </div>
                            <div class="cost-text avail-text">
                                <p>Service Cost</p>
                                <h6>₹ 1,200</h6>
                            </div>
                            <div class="cancel-text avail-text">
                                <p>Cancel before</p>
                                <h6>48 hrs</h6>
                            </div>
                            <div class="cancelfee-text avail-text">
                                <p>Cancellation fee</p>
                                <h6>₹ 200</h6>
                            </div>
                            <div class="refund-text avail-text">
                                <p>Refund Amount</p>
                                <h6>₹ 3,200</h6>
                            </div>
                            <!-- <div class="pending-box">
                               <button class="pending-btn">Pending</button>
                            </div> -->
                        </div>
                        <div class="form-divider"></div>
                        <div class="profile-box-cont1">
                            <div class="cost-text avail-text">
                                <h6>Total Paid</h6>
                                <h6>₹ 5,720</h6>
                            </div>
                            <div class="cancel-text avail-text">
                                <h6>Cancellation fee</h6>
                                <h6 style="color: #d22e27;">-₹ 1,346</h6>
                            </div>
                            <div class="refund-text avail-text">
                                <h6>Refundable Amount</h6>
                                <h6>₹ 4,100</h6>
                            </div>
                            <!--  <div class="status-box">
                               <button class="status-btn">Refunded</button>
                            </div> -->
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hello">
                            <label class="form-check-label " for="hello">
                                I hereby declare that I am fully aware of the Cancellation Policy of the service providers and I wish to <br>Cancel the booking.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Proceed to Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN MODAL -->
    <div id="login_modal" class="modal fade" role="dialog"></div>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        const items = document.querySelectorAll(".accordion button");

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');

            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }

            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));

        // Cancel booking
        const cancelBtn = document.querySelector('.cancel__booking-btn');
        cancelBtn.addEventListener('click', function() {
            const bookingStatus = document.querySelector('.widget');
            const cancellationDetails = document.querySelector('.cancellation_details');
            let bookingStatusImg = bookingStatus.childNodes[1];
            //   console.log(bookingStatus.childNodes);

            cancellationDetails.classList.remove('hidden')
            this.classList.add('hidden');

            bookingStatus.classList.add('cancelled');
            bookingStatusImg.src = 'asset/mybooking/cancel.svg';
            bookingStatus.childNodes[3].innerHTML = 'Cancelled';
        });
        // setTimeout(function(){$('#loading').fadeOut();},500);
    </script>
</body>

</html>