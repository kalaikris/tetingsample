<?php
include 'php/site-config.php';
include '../security/secure.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Checkout Process</title>
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
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
    <style>
        .bullet-points li {
            margin-bottom: 16px;
        }

        .brand-link:link,
        .brand-link:visited {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .modal-header,
        .modal-body {
            padding: 24px;
        }
        sup {
            color: red;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <!--LOADER-->
        <div id="loading"></div>

        <!-- <header></header> -->

        <!-- NAV MENU -->
        <nav></nav>

        <section class="checkou-step-sec">
            <input type="hidden" id="gtag_id">
            <div class="container">
                <div class="page-header-set">
                    <h2>Passenger Details</h2>
                </div>
                <!-- <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <span type="button" class="btn step-btn btn-circle on-status"></span>
                            <p>Passenger details</p>
                        </div>
                        <div class="stepwizard-step">
                            <span type="button" class="btn step-btn btn-circle" disabled></span>
                            <p>Other details</p>
                        </div>
                    </div>
                </div> -->
                <div class="main-form">
                    <div class="setup-content active" id="step-1">
                        <div class="step-form-header">
                            <h3>Lead Passenger Details <sup>*</sup></h3>
                            <p>All calls and message will be delivered to this passenger</p>
                        </div>
                        <!-- Added lead passenger -->
                        <div class="input_boxs" id="contact-passenger-box"></div>
                        <div class="passenger-contact">
                            <button class="sec-btn add-contact-btn" id="add-contact-passenger">Add Lead
                                Passenger</button>
                        </div>

                        <div class="step-form-header">
                            <h3>Other Passenger Details <sup>*</sup></h3>
                            <p>Enter the details of other passengers</p>
                        </div>
                        <!-- Added passengers -->
                        <div class="input_boxs" id="other-passenger-box"></div>
                        <div class="passenger-other">
                            <button class="sec-btn add-other-btn" id="add-other-passenger">Add Other Passengers</button>
                        </div>

                        <div class="form-divider"></div>

                        <div class="step-form-header">
                            <h3>Alternate Contact Details (Optional)</h3>
                            <p>Help us reach your dear ones and keep them informed</p>
                        </div>
                        <div class="input_boxs" id="greet-passenger-box"></div>
                        <div class="note-set">
                            <p><img src="asset/choose-service/info.svg" alt="" class="ex-symbal"> Alternate contact
                                should not be in your passenger list</p>
                        </div>
                        <div class="passenger-contact">
                            <button class="sec-btn add-contact-btn" id="add-greet-passenger">Alternate
                                contact</button>
                        </div>

                        <div class="form-divider"></div>

                        <div class="d-flex" style="display:flex;justify-content: space-between;flex-wrap:wrap;row-gap: 12px">
                            <div class="">
                                <div class="step-form-header">
                                    <h3>Upload E-Ticket <sup>*</sup></h3>
                                    <p>Upload your flight ticket in PDF format</p>
                                </div>
                                <div class="passenger-contact">
                                    <input type="file" name="" class="update-profile hidden" id="e-ticket"
                                        accept="image/x-png, image/jpeg, image/jpg, application/pdf"
                                        onchange="file_upload()">
                                    <!-- , application/vnd.ms-excel -->
                                    <p class="hidden" id="e-ticket-success"><img src="asset/uploaded.svg"
                                            alt="uploaded icon"></p>
                                    <label class="sec-btn add-contact-btn" id="e-ticket-uploader" for="e-ticket"
                                        style="display: inline-block; font-weight: normal;">Upload E-Ticket</label>
                                </div>
                            </div>

                            <div>
                                <div class="step-form-header">
                                    <h3>PAN Details (Optional)</h3>
                                    <p>Add PAN number to claim tax</p>
                                    <!-- <div class="note-set sub_cont"> </div> -->
                                </div>
                                <div class="input-form-group-item" style="width: 100%;">
                                    <div class="input-box-set">
                                        <p>PAN Number</p>
                                        <input type="text" class="input-box" id="pan-number" placeholder="Enter PAN Number">
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <!-- <div class="form-divider"></div> -->
                                <div class="step-form-header">
                                    <h3>GSTIN for this booking (Optional)</h3>
                                    <p>Add GST number to avail its bene</p>
                                    <!-- <div class="note-set sub_cont"></div> -->
                                </div>
                                <div id="gst-div"></div>
                                <div class="passenger-other">
                                    <button class="sec-btn add-other-btn" id="add-gst">Add GSTIN</button>
                                </div>
                            </div>
                        </div>

                        <!-- <a class="nex-arrow-set" data-current="#step-1" data-next="#step-2">
                            <img src="asset/choose-service/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        </a> -->

                        <!-- Step 2 content  -->
                        <!-- <div class="form-divider"></div> -->
                        <!-- <div>
                            <div class="step-form-header">
                                <h3>PAN Details <span>(Optional)</span></h3>
                                <p>Add PAN number to claim tax</p>
                                <div class="note-set sub_cont">
                                </div>
                            </div>
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <p>PAN Number</p>
                                    <input type="text" class="input-box" id="pan-number" placeholder="Enter PAN Number">
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class=""> -->
                            <!-- <div class="form-divider"></div> -->
                            <!-- <div class="step-form-header">
                                <h3>GSTIN for this booking <span>(Optional)</span></h3>
                                <p>Add GST number to avail its bene</p> -->
                                <!-- <div class="note-set sub_cont"></div> -->
                            <!-- </div>
                            <div id="gst-div"></div>
                            <div class="passenger-other">
                                <button class="sec-btn add-other-btn" id="add-gst">Add GSTIN</button>
                            </div> -->
                        <!-- </div> -->

                        <div class="form-divider"></div>

                        <div class="step-form-header">
                            <h3>Placard Message (Optional)</h3>
                            <p>Enter the message to display in Placard</p>
                            <!-- <div class="note-set sub_cont"></div> -->
                        </div>
                        <div class="text-contect">
                            <div class="input-box-set">
                                <textarea id="greet" placeholder="Eg: Hello Zach! Welcome to India."></textarea>
                            </div>
                        </div>

                        <div id="flower-textbox">
                            <div class="form-divider"></div>
                            <div class="step-form-header">
                                <h3>Flower and Bouquet details <span>(Optional)</span></h3>
                                <p>Send a personalized note for your loved ones</p>
                                <div class="note-set sub_cont"></div>
                                <div class="text-contect">
                                    <div class="input-box-set">
                                        <textarea id="bouqueteer"
                                            placeholder="Eg. I am fortunate to have you in my life and I wish you have a great day!"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-form-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkout-agreement">
                                <label class="form-check-label" for="checkout-agreement">
                                    I agree to the <a href="terms" target="_blank">Terms and Conditions</a> & <a
                                        href="cancellation_policy" target="_blank">Cancellation Policy</a> of AirportZo India PVT LTD.
                                </label>
                            </div>
                            <div class="proceed-checkbtn">
                                <!-- <span class="nex-arrow-set" data-current="#step-2" data-next="#step-1">
                                    <img src="asset/choose-service/next-arrow.svg" class="next-arrow" alt="nex arrow">
                                </span> -->
                                <button class="proceed-btn" id="pay-btn" onclick="proceedToPay()">Proceed to
                                    Pay</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="setup-content" id="step-2">
                        <div class="step-form-header">
                            <h3>PAN Details <span>(Optional)</span></h3>
                            <p>Add PAN number to claim tax</p>
                            <div class="note-set sub_cont">
                            </div>
                        </div>
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <p>PAN Number</p>
                                <input type="text" class="input-box" id="pan-number" placeholder="Enter PAN Number">
                            </div>
                        </div>

                        <div class="">
                            <div class="form-divider"></div>
                            <div class="step-form-header">
                                <h3>GSTIN for this booking <span>(Optional)</span></h3>
                                <p>Add GST number to avail its bene</p>
                                <div class="note-set sub_cont"></div>
                            </div>
                            <div id="gst-div"></div>
                            <div class="passenger-other">
                                <button class="sec-btn add-other-btn" id="add-gst">Add GSTIN</button>
                            </div>
                        </div>

                        <div class="form-divider"></div>

                        <div class="step-form-header">
                            <h3>Meet and greet card details <span>(Optional)</span></h3>
                            <p>Welcome your guests in the way you want</p>
                            <div class="note-set sub_cont"></div>
                        </div>
                        <div class="text-contect">
                            <div class="input-box-set">
                                <textarea id="greet" placeholder="Eg: Hello Zach! Welcome to India."></textarea>
                            </div>
                        </div>

                        <div id="flower-textbox">
                            <div class="form-divider"></div>
                            <div class="step-form-header">
                                <h3>Flower and Bouquet details <span>(Optional)</span></h3>
                                <p>Send a personalized note for your loved ones</p>
                                <div class="note-set sub_cont"></div>
                                <div class="text-contect">
                                    <div class="input-box-set">
                                        <textarea id="bouqueteer"
                                            placeholder="Eg. I am fortunate to have you in my life and I wish you have a great day!"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-form-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkout-agreement">
                                <label class="form-check-label" for="checkout-agreement">
                                    I agree to the <a href="terms" target="_blank">Terms and Conditions</a> & <a
                                        href="cancellation_policy" target="_blank">Cancellation Policy</a> of AirportZo
                                    Ltd
                                </label>
                            </div>
                            <div class="proceed-checkbtn">
                                <span class="nex-arrow-set" data-current="#step-2" data-next="#step-1">
                                    <img src="asset/choose-service/next-arrow.svg" class="next-arrow" alt="nex arrow">
                                </span>
                                <button class="proceed-btn" onclick="proceedToPay()">Proceed to Pay</button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </div>

    <!-- Success Modal -->
    <div id="success_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <button type="button" class="close success-modal-close" data-dismiss="modal">&times;</button> -->
                <div class="success-content-set">
                    <svg class="tick-img" width="174px" height="174px" viewBox="0 0 174 174" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="26-Download-App-Notification" transform="translate(-633.000000, -211.000000)">
                                <g id="Group-14" transform="translate(633.000000, 211.000000)">
                                    <path
                                        d="M167.100893,118.557663 L161.549829,121.88166 C159.786967,122.937084 158.790258,124.915425 158.98889,126.963039 L159.609617,133.409612 C159.857907,135.991865 158.212096,138.377669 155.715004,139.059023 L149.47582,140.759921 C147.493044,141.300243 145.999754,142.935421 145.63796,144.9603 L144.499371,151.33618 C144.045354,153.889658 141.817834,155.742599 139.22852,155.723416 L132.762328,155.675103 C130.708611,155.659828 128.828698,156.830705 127.934853,158.682936 L125.122077,164.51494 C123.994129,166.850655 121.351609,168.033255 118.861611,167.314956 L112.650803,165.520985 C110.675121,164.951532 108.550464,165.571429 107.191961,167.113534 L102.910725,171.969334 C101.197521,173.913928 98.335087,174.338442 96.1323963,172.973958 L90.6309899,169.567544 C88.8823159,168.485833 86.6689841,168.508569 84.9451392,169.626159 L79.5182199,173.14554 C77.3439052,174.554784 74.4708303,174.189596 72.7186093,172.280881 L68.3380569,167.514602 C66.9476305,166.000561 64.8123329,165.424715 62.8508385,166.035375 L56.675501,167.956878 C54.1996908,168.726332 51.5323422,167.598794 50.3582832,165.286881 L47.4249092,159.514201 C46.4955936,157.680798 44.5908514,156.548643 42.5406819,156.606547 L36.0744899,156.788076 C33.4851754,156.860545 31.2221856,155.05414 30.7149637,152.510609 L29.4451356,146.159596 C29.0407769,144.142533 27.5155643,142.538616 25.5221469,142.039146 L19.2474932,140.467201 C16.7362129,139.837713 15.040744,137.486367 15.2393763,134.899852 L15.7288632,128.441556 C15.8813844,126.390389 14.8456587,124.433362 13.0615146,123.414174 L7.44305703,120.205274 C5.1942552,118.920365 4.19399949,116.198502 5.080751,113.760833 L7.29053577,107.67412 C7.99284297,105.741249 7.52109117,103.575695 6.0774597,102.112454 L1.53374496,97.5046124 C-0.285869147,95.6594864 -0.512877534,92.7688838 0.994600037,90.6608789 L4.76506747,85.3972611 C5.9604085,83.7254931 6.08810072,81.5130471 5.09139202,79.7137474 L1.95938568,74.0490615 C0.703745541,71.7801321 1.26062549,68.9353557 3.28241894,67.3133216 L8.32980855,63.263565 C9.93305528,61.9772344 10.6530975,59.8813078 10.1777987,57.8798754 L8.68450915,51.5778857 C8.08861213,49.0538927 9.39391036,46.4659561 11.7774984,45.4503198 L17.7258276,42.9142485 C19.6163818,42.1085601 20.8755689,40.2847487 20.9571501,38.2296748 L21.2160815,31.7578796 C21.3224917,29.1660353 23.276892,27.0267692 25.8449244,26.6924866 L32.2579113,25.8583789 C34.2938928,25.5933685 35.9964557,24.1770194 36.6278228,22.2203475 L38.6212402,16.0590336 C39.4228636,13.591524 41.8809388,12.0593661 44.4418771,12.4316595 L50.844223,13.3613273 C52.8766575,13.6565333 54.894904,12.7527981 56.0334929,11.0398221 L59.612422,5.64547526 C61.0454124,3.48524983 63.8262652,2.67423278 66.1921182,3.72539329 L72.1049773,6.34991977 C73.9848905,7.18331705 76.1733932,6.85898128 77.7305289,5.51652249 L82.6289442,1.28985546 C84.5904386,-0.402871754 87.4883425,-0.432712065 89.4853069,1.21916234 L94.4688504,5.34387497 C96.0543621,6.65365151 98.2499589,6.93287157 100.10859,6.06075294 L105.964697,3.31473376 C108.312815,2.21526037 111.107856,2.968373 112.58341,5.09875812 L116.275844,10.4177937 C117.446356,12.1069685 119.485884,12.9691404 121.511225,12.6320159 L127.892288,11.5705534 C130.446133,11.1453289 132.936131,12.626332 133.783865,15.07679 L135.904975,21.1958301 C136.578906,23.1390028 138.309845,24.5198277 140.349374,24.7429196 L146.780096,25.4445222 C149.355222,25.7255184 151.352186,27.8239318 151.508255,30.4132893 L151.901972,36.8779797 C152.026118,38.9312774 153.324322,40.7288009 155.229064,41.4947023 L161.230598,43.9075046 C163.635468,44.8741176 164.990425,47.4347005 164.447733,49.9704166 L163.082135,56.3018913 C162.649401,58.3125599 163.412007,60.3932112 165.04363,61.6461491 L170.172601,65.5911093 C172.226317,67.1708696 172.843496,70.0035678 171.633967,72.2977194 L168.615465,78.0259936 C167.657773,79.8455421 167.831577,82.0547909 169.062388,83.7016919 L172.939265,88.8860909 C174.492854,90.9624792 174.322598,93.8569895 172.542001,95.7397711 L168.094055,100.440331 C166.6788,101.933057 166.253159,104.107492 166.994483,106.025798 L169.328413,112.065264 C170.264823,114.484105 169.324866,117.226217 167.100893,118.557663"
                                        id="success" fill="#84BC42"></path>
                                    <polyline id="Fill-26" fill="#FFFFFF"
                                        points="77.1594609 120.397815 47.8008919 91.0086607 57.0798597 81.7098511 76.8721534 101.519911 118.950286 56.7217871 128.509467 65.7296536 77.1594609 120.397815">
                                    </polyline>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <div class="confite-text">
                        <h2>Congratulations, <span id="confetti-usr-name">Andrews</span> !</h2>
                        <img src="asset/checkout/confetti.svg" class="confite-icon" alt="confite">
                    </div>
                    <div class="booking-info-set">
                        <p>
                            You have successfully booked the services at<br>
                            <span id="confetti-station-view">MAA - DXB - FRA</span> on <span
                                id="confetti-journey-date"></span>
                        </p>
                    </div>
                    <div class="success-popup-division hidden"></div>
                    <div class="store-set hidden">
                        <img src="asset/checkout/phone-icon.svg" class="phone-icon" alt="icon">
                        <div class="store-info-set">
                            <p>As a part of your next step we request you to download and install <span>Airportzo Mobile
                                    App</span> to contact your service providers and
                                experience awesome features.</p>
                            <div class="app-play-store-set">
                                <h4>Download Airportzo App from :</h4>
                                <div class="store-link-set">
                                    <img src="asset/appstore.svg" class="store-icon cust-rm" alt="app store">
                                    <img src="asset/playstore.svg" class="store-icon" alt="app store">
                                </div>
                            </div>
                            <ul class="note-info-set">
                                <li>
                                    <img src="asset/checkout/info.svg" class="info-icon" alt="">
                                </li>
                                <li>
                                    <p><span>Use the same mobile number</span> which you used to book the
                                        service, to login into the Airportzo mobile App.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="proceed-btn" onclick="window.location.href='index.php'">Home</button>
                    <button type="button" class="proceed-btn" onclick="window.location.href='my-booking.php'">My
                        Bookings</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer"></footer>

    <!-- ADD GST MODAL -->
    <div id="add_gst_modal" class="modal fade add_details_modal" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <!-- <button type="button" class="login-close" data-dismiss="modal">&times;</button> -->
                <img src="asset/choose-service/close-white.svg" class="close close-modal" alt="close icon"
                    data-dismiss="modal" aria-label="Close" style="transform: translate(-15px, 15px);">
                <div class="cust-modal-body">
                    <div class="add__gst-container">
                        <div class="page-header-set">
                            <h2>Add GST details</h2>
                        </div>
                        <div class="add__gst-form">
                            <form action="">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Company Name</p>
                                        <input type="text" class="input-box" id="gst-name"
                                            placeholder="Enter company name">
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>GST Number</p>
                                        <input type="text" class="input-box" id="gst-number"
                                            placeholder="Enter gst number">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="butn-container">
                            <button class="primary-butn add__gst-btn" onclick="addGst()">Add GST</button>
                        </div>
                        <div class="butn-container">
                            <button class="sec-btn saved__gst-btn">Pick from saved GST list</button>
                        </div>
                    </div>

                    <div class="saved__gst-container hidden">
                        <div class="page-header-set">
                            <h2>Select GST details</h2>
                        </div>
                        <div class="existing__gsts-list-box">
                            <ul class="existing__gsts-list" id="gst-history"></ul>
                        </div>
                        <div class="butn-container">
                            <button class="sec-btn add__new-gst-btn">Add New GST</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD PASSENGER MODAL -->
    <div id="add_passenger_modal" class="modal fade" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <!-- <button type="button" class="login-close" data-dismiss="modal">&times;</button> -->
                <img src="asset/choose-service/close-white.svg" class="close close-modal" alt="close icon"
                    data-dismiss="modal" aria-label="Close" style="transform: translate(-15px, 15px);">
                <div class="cust-modal-body">
                    <div class="add__passenger-container">
                        <div class="page-header-set">
                            <h2 id="add_title">Add new passenger</h2>
                            <p id="add_title_name">Please enter the new passenger details</p>
                        </div>
                        <div class="add__passenger-form">
                            <form action="">
                                <div class="input-form-group-item">
                                    <div class="select-group">
                                        <select class="select-box" id="passenger-title">
                                            <option value=NULL>NULL</option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <p>Passenger Name <span>*</span></p>
                                        <input type="text" class="input-box" id="passenger-name"
                                            placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="login-input-action-set" id="login_with_mobileno">
                                    <div class="login-input-group phone">
                                        <p>Mobile Number <span id="add-pass-mobile-cond"></span></p>
                                        <input type="tel" class="login-input-box" id="passenger-mobile" name="phone" />
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Email Address <span id="add-pass-email-cond"></span></p>
                                        <input type="text" class="input-box" id="passenger-email"
                                            placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="dob-input input-group hidden" id="arrive_date">
                                    <span class="input-group-addon bg-date"></span>
                                    <label for="arrive_date">Date of birth</label>
                                    <input type="text" class="b-input datepicker" id="passenger-dob"
                                        placeholder="DD-MMM-YYYY" readonly="">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="saved__passenger-container hidden">
                        <div class="search__box">
                            <input type="search" placeholder="Search passengers" id="search-passenger"
                                onkeyup="searchByName()">
                            <label for="search-passenger"><img src="asset/search.svg" alt="search icon"></label>
                        </div>
                        <div class="existing__passengers__list-box">
                            <ul class="existing__passengers-list" id="passenger-history"></ul>
                        </div>
                    </div>

                    <div class="age-check-input input-group" style="margin-bottom: 20px;">
                        <div class="input-group loyalty-checkbox" style="margin-bottom: 20px;">
                            <div class="form-check">
                                <input class="form-check-input loyalty-input-radio" type="checkbox" id="loyalty">
                                <label class="form-check-label" for="loyalty" id="loyalty_label"></label>
                            </div>
                        </div>

                        <div class="input-form-group-item loyalty-input-box hidden"
                            style="margin-left:20px;width:75%;border-radius:6px;">
                            <div class="input-box-set">
                                <input type="text" class="input-box loyalty-input" id="loyaltyId" autocomplete="off">
                                <input type="hidden" id="membershipType">
                                <input type="hidden" id="tcLink1">
                                <input type="hidden" id="tcLink2">
                                <input type="hidden" id="dc_percentage">
                                <input type="hidden" id="miles_cost">
                                <input type="hidden" id="miles_point">
                                <input type="hidden" id="distributorName">
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is-adult">
                            <label class="form-check-label" for="is-adult">
                                I agree to that the passenger is above 12 years of age.
                            </label>
                        </div>
                    </div>

                    <div class="add__passenger-container">
                        <div class="butn-container">
                            <button class="primary-butn add__passenger-btn" onclick="addPassenger()"
                                id="passenger_btn">Add Passenger</button>
                        </div>
                        <div class="butn-container">
                            <button class="sec-btn saved__passenger-btn">Pick from saved passenger list</button>
                        </div>
                    </div>
                    <div class="saved__passenger-container hidden">
                        <div class="existing__passengers__list-box">
                            <div class="butn-container">
                                <button class="primary-butn add__passenger-btn" onclick="addFromHistory()">Add <span
                                        class="selected__passenger-count"></span> Passenger</button>
                            </div>
                            <div class="butn-container">
                                <button class="sec-btn add__new-passenger-btn">Add new passenger</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loyalty Modal -->
    <div id="loyalty-points_modal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog top-center">
            <div class="modal-content loyalty-modal">
                <div class="modal-header" style="border-bottom:none;padding-bottom:0;">
                    <h3 class="modal-title" style="display:inline-block;max-width:90%;">By entering your <span
                            class="membership-name"></span> details, you agree to the Terms and Conditions of the
                        program.</h3>
                    <!-- <button type="button" class="close loyalty-btn" data-dismiss="modal" aria-label="Close"
                        style="font-size:32px;">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                    <img src="asset/choose-service/close-white.svg" class="close close-modal loyalty-btn"
                        alt="close icon" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <ul class="bullet-points" style="list-style-type: disc;    margin-bottom: 24px;padding-left: 20px;">
                        <li>Earn <span id="service_cv"></span> CV point Per <span id="service_cost_spent"></span>
                            (Excluding GST) Spent</li>
                        <li>Kindly provide the CV ID to earn CV Points.</li>
                        <li>Your <span class="membership-name"></span> Points will be awarded by <span
                                class="distributor-name"></span> within 30 days after completing the transaction.</li>
                        <li>All <span id="append_tc_link"></span> terms and conditions will be applicable.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>

    <script for="Front-end">
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        today = dd + '-' + monthNames[mm] + '-' + yyyy;
        $('.datepicker').datetimepicker({
            ignoreReadonly: true,
            format: 'DD-MMM-YYYY'
        });
        $('.datepicker').val(today);
        $('.datepicker').data("DateTimePicker").maxDate(today);

        const passengerMobField = document.querySelector("#passenger-mobile");
        const passengerPhoneInput = window.intlTelInput(passengerMobField, {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        // Click next btn
        $('.nex-arrow-set').on('click', function () {
            var journeyArray = JSON.parse(sessionStorage.getItem("jsonJourney"));
            journeyDate = journeyArray[0].departure_date;

            var jsonServiceData = sessionStorage.getItem("jsonServiceData");
            var serviceData = JSON.parse(jsonServiceData);

            var stationArray = [];
            var totalAdultCount = parseInt(serviceData[0].adult_count);
            var totalChildCount = parseInt(serviceData[0].children_count);
            var totalPassengerCount = totalAdultCount + totalChildCount;
            var totalPassengersAdded = 1 + otherPassengers.length;// + greetPassengers.length;

            if (contactPassenger.mobile_number && eTicket != '' && totalPassengerCount == totalPassengersAdded) {
                let __step_current = $(this).attr('data-current');
                let __step_next = $(this).attr('data-next');
                $('.setup-content').removeClass('active');
                $('.on-status').addClass('status-completed');
                $('.status-completed').removeClass('on-status');
                $(`${__step_next}`).addClass('active');
                $(`a[href='${__step_next}']`).addClass('on-status');
                $(`a[href='${__step_current}']`).addClass('status-completed');
                $(`a[href='${__step_next}']`).attr('disabled', false);
                $('.stepwizard-step:nth-child(2) .btn').addClass('on-status');
                $('html, body').animate({ scrollTop: '0px' }, 200);
            } else if (!contactPassenger.hasOwnProperty('mobile_number')) {
                swal({
                    text: "Lead passenger cannot be empty !",
                    icon: "warning",
                });
            } else if (totalPassengerCount != totalPassengersAdded) {
                swal({
                    text: "Please add 1 Lead passenger and " + (totalPassengerCount - 1) + " other passengers to continue booking !",
                    icon: "warning",
                });
            } else {
                swal({
                    text: "Please upload e-ticket !",
                    icon: "warning",
                });
            }
        });

        // // Click next btn
        // $('.nex-arrow-set').on('click', function() {
        //     if (contactPassenger.mobile_number && eTicket != '') {
        //         let __step_current = $(this).attr('data-current');
        //         let __step_next = $(this).attr('data-next');
        //         $('.setup-content').removeClass('active');
        //         $('.on-status').addClass('status-completed');
        //         $('.status-completed').removeClass('on-status');
        //         $(`${__step_next}`).addClass('active');
        //         $(`a[href='${__step_next}']`).addClass('on-status');
        //         $(`a[href='${__step_current}']`).addClass('status-completed');
        //         $(`a[href='${__step_next}']`).attr('disabled', false);
        //         $('.stepwizard-step:nth-child(2) .btn').addClass('on-status');
        //         ('html, body').animate({scrollTop: '0px'}, 200);
        //     } else if (!contactPassenger.hasOwnProperty('mobile_number')) {
        //         swal({
        //             text: "Lead passenger cannot be empty !",
        //             icon: "warning",
        //         });
        //     } else {
        //         swal({
        //             text: "Please upload e-ticket !",
        //             icon: "warning",
        //         });
        //     }
        // });

        $('.saved__passenger-btn').on('click', function () {
            $('.add__passenger-container').addClass('hidden');
            $('.saved__passenger-container').removeClass('hidden');
            $('.loyalty-input-box').addClass('hidden');
            $('.loyalty-checkbox').addClass('hidden');
        });
        $('.add__new-passenger-btn').on('click', function () {
            $('.add__passenger-container').removeClass('hidden');
            $('.saved__passenger-container').addClass('hidden');
            $('.loyalty-checkbox').removeClass('hidden');
            document.getElementById("loyalty").checked = false;
            $('#loyaltyId').val('');
        });

        $('.saved__gst-btn').on('click', function () {
            $('.add__gst-container').addClass('hidden');
            $('.saved__gst-container').removeClass('hidden');
        });
        $('.add__new-gst-btn').on('click', function () {
            $('.add__gst-container').removeClass('hidden');
            $('.saved__gst-container').addClass('hidden');
        });

        // submit info
        $('.payment-btn').on('click', function () {
            $('#success_modal').modal('show');
        });
    </script>

    <script for="Back-end">
        var passenger_type;
        var isMultiplePassenger;

        var passengerHistory = [];
        var gstHistory = [];

        var hasAgeCheck = false;
        var isMobileMandatory = false;
        var isEmailMandatory = false;
        var userMobile = "";
        var contactPassenger = {};
        var otherPassengers = [];
        var greetPassengers = [];
        var gstDetail = {};
        var eTicket = "";
        var journeyDate;

        var hasConvenience = true;
        var customConvenienceFee = 0;

        $(document).ready(function () {
            if (isAgent) {
                if (localStorage.getItem("hasConvenience") !== null) {
                    hasConvenience = localStorage.getItem("hasConvenience") == "false" ? false : true;
                    customConvenienceFee = parseInt(localStorage.getItem("customConvenienceFee"));
                }
            }

            $('#flower-textbox').css('display', 'none');
            // if ($('body').attr('data-usr-token') == 0) {
            //     window.location.href = "checkout.php";
            // }

            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users/read-detail.php',
                dataType: 'JSON',
                success: function (response) {
                    if (response.status_code == 200) {
                        userMobile = response.data.mobile_number;
                    } else {
                        swal({
                            text: "Please login again to continue !",
                            icon: "error",
                        })
                            .then(() => {
                                window.location.href = "checkout.php";
                            });
                    }
                }
            });

            var checkJsonServiceData = sessionStorage.getItem("jsonServiceData");
            if (checkJsonServiceData && checkJsonServiceData != '') {
                var searchpassenger_name = $('#search-passenger').val();
                var passengerInputJSON = { 'name': searchpassenger_name };
                $('#passenger-history').empty();
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'php/users-passenger/read.php',
                    dataType: 'JSON',
                    data: JSON.stringify(passengerInputJSON),
                    success: function (response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;

                            responseData.forEach(function (passengerObj, passengerKey) {
                                passengerHistory.push(passengerObj);
                                $('#passenger-history').append(makePassengerHistoryCard(passengerObj, passengerKey));
                            });

                            initPassengerSelector();
                        }
                    }
                });

                $('#gst-history').empty();
                $.ajax({
                    async: false,
                    type: 'GET',
                    url: 'php/users-gst/read.php',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;

                            responseData.forEach(function (gstObj, gstKey) {
                                gstHistory.push(gstObj);
                                $('#gst-history').append(`<li class="gst-selector" data-index="${gstKey}">
                                    <div class="input-box-sets">
                                        <div class="input-lable">
                                            <p>${gstObj.name}</p>
                                            <p class="input-data">${gstObj.gstin}</p>
                                        </div>
                                    </div>
                                </li>`);
                            });

                            $('.gst-selector').on('click', function () {
                                var index = $(this).attr('data-index');
                                gstDetail = gstHistory[index];
                                makeGstCard();
                            });
                        }
                    }
                });
            } else {
                // alert("Cannot find the added services ! Please add again !");
                swal({
                    text: "Cannot find the added services ! Please add again !",
                    icon: "info",
                });
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            }
            $('#add-contact-passenger').on('click', function () {
                isMultiplePassenger = false;
                passenger_type = "contact";
                hasAgeCheck = true;
                getClearForm(false);

                $('#add_title').text('Add Lead Passenger');
                $('#add_title_name').text('Please Enter Lead Passenger Details');
                $('#passenger_btn').text('Add Lead Passenger');
                $('.loyalty-checkbox').removeClass('hidden');
            });
            $('#add-other-passenger').on('click', function () {
                isMultiplePassenger = true;
                passenger_type = "other";
                hasAgeCheck = false;
                getClearForm(false);

                $('#add_title').text('Add Other Passenger Details');
                $('#add_title_name').text('Please Enter Other Passenger Details');
                $('#passenger_btn').text('Add Other Passenger Details');
            });
            $('#add-greet-passenger').on('click', function () {
                isMultiplePassenger = false;
                passenger_type = "greet";
                hasAgeCheck = false;
                getClearForm(false);

                $('#add_title').text('Add Alternate Contact Details');
                $('#add_title_name').text('Please Enter Alternate Contact Details');
                $('#passenger_btn').text('Add Alternate Contact Details');
            });

            $('#add-gst').on('click', function () {
                $('#gst-name').val('');
                $('#gst-number').val('');

                $('#gst-history>li').removeClass('selected');
                $('.add__gst-container').removeClass('hidden');
                $('.saved__gst-container').addClass('hidden');

                $('#add_gst_modal').modal('show');
            });
        });

        function searchByName() {
            var searchpassenger_name = $('#search-passenger').val();
            var passengerInputJSON = { 'name': searchpassenger_name };
            $('#passenger-history').empty();
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-passenger/read.php',
                dataType: 'JSON',
                data: JSON.stringify(passengerInputJSON),
                success: function (response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        responseData.forEach(function (passengerObj, passengerKey) {
                            passengerHistory.push(passengerObj);
                            $('#passenger-history').append(makePassengerHistoryCard(passengerObj, passengerKey));
                        });

                        initPassengerSelector();
                    }
                }
            });
        }

        var service_cost = '';
        var dc_percet = '';
        var milesCost = '';
        var milesPoint = '';
        var currencySelected = (sessionStorage.getItem("currencySelected") === null) ? "INR" : sessionStorage.getItem("currencySelected");
        function calcTotalCost() {
            var totalServiceCost = 0;
            var dc__percentage = $('#dc_percentage').val();
            var miles__cost = $('#miles_cost').val();
            var miles__point = $('#miles_point').val();
            var ServiceData = sessionStorage.getItem("jsonServiceData");
            globalStationData = JSON.parse(ServiceData);

            globalStationData.forEach(function (stationObj) {
                stationObj.service_collection.forEach(function (serviceColObj) {
                    serviceColObj.service_group.forEach(function (serviceGrpObj) {
                        serviceGrpObj.service_array.forEach(function (serviceObj) {
                            if (serviceObj.isSelected) {
                                var adultCount = serviceObj.adult_count;
                                var childrenCount = serviceObj.children_count;
                                var adultPrice = serviceObj.price_adult;
                                var childrenPrice = serviceObj.price_children;
                                var addtionalAdultPrice = serviceObj.additional_price_adult;
                                var additionalChildrenPrice = serviceObj.additional_price_children;

                                var serviceCostInclGst = 0;
                                if (addtionalAdultPrice > 0 && adultCount > 1) {
                                    serviceCostInclGst += (adultPrice + ((adultCount - 1) * addtionalAdultPrice));
                                } else {
                                    serviceCostInclGst += adultCount * adultPrice;
                                }
                                if (additionalChildrenPrice > 0 && childrenCount > 1) {
                                    serviceCostInclGst += (childrenPrice + ((childrenCount - 1) * additionalChildrenPrice));
                                } else {
                                    serviceCostInclGst += childrenCount * childrenPrice;
                                }

                                if (serviceCostInclGst) {
                                    if (isAgent) {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                    } else {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                    }
                                }
                            }
                        });
                    });
                });
            });

            totalServiceCost = Math.round(totalServiceCost);

            var inputData = {
                "currency_from": "INR",
                "currency_to": currencySelected
            };
            inputData = JSON.stringify(inputData);
            $.ajax({
                async: false,
                url: 'php/currency.php',
                data: inputData,
                type: 'POST',
                // dataType: 'JSON',
                success: function (response) {
                    service_cost = response * totalServiceCost;
                    service_cost = Math.round((service_cost + Number.EPSILON) * 100) / 100;

                    dc_percet = response * dc__percentage;
                    dc_percet = Math.round((dc_percet + Number.EPSILON) * 100) / 100;

                    milesCost = response * miles__cost;
                    milesCost = Math.round((milesCost + Number.EPSILON) * 100) / 100;

                    milesPoint = response * miles__point;
                    milesPoint = Math.round((milesPoint + Number.EPSILON) * 100) / 100;
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function makeGstCard() {
            $('#gst-div').html(`<div class="input-form-group-item" style="width:100%;">
                <div class="input-box-set">
                    <h4>${gstDetail.name}</h4>
                    <p>${gstDetail.gstin}</p>
                </div>
                <div>
                    <p style="cursor: pointer;" class="gst-remover">X</p>
                </div>
            </div>`);
            $('#add-gst').text("Change GSTIN");
            $('#add_gst_modal').modal('hide');

            $('.gst-remover').on('click', function () {
                $('#gst-div').empty();
                gstDetail = {};
                $('#add-gst').text("Add GSTIN");
            });
        }

        function makePassengerHistoryCard(passengerObj, passengerKey) {
            return `<li data-index="${passengerKey}" data-hasEvent="0">
                <p class="passenger__name">${passengerObj.name_view}</p>
                <p class="passenger__contact">
                    <span>${passengerObj.country_code}-${passengerObj.mobile_number}</span> 
                    <span>${passengerObj.email_id}</span> 
                </p>
            </li>`;
            // <p class="age">(${passengerObj.age})</p>
        }

        function addFromHistory() {
            var isAdult = document.getElementById("is-adult").checked;
            if (hasAgeCheck && !isAdult) {
                swal({
                    text: "Please agree to that the passenger is above 12 years of age !",
                    icon: "warning",
                });
            } else {
                var selectedPassengers = 0;
                $('#passenger-history>li').each(function () {
                    if ($(this).hasClass('selected')) {
                        var index = $(this).attr('data-index');
                        var mobileErr = (isMobileMandatory && passengerHistory[index].mobile_number == '') ? true : false;
                        var emailErr = (isEmailMandatory && passengerHistory[index].email_id == '') ? true : false;

                        if (mobileErr) {
                            swal({
                                text: "Please check mobile number of person !",
                                icon: "info",
                            });
                        } else if (emailErr) {
                            swal({
                                text: "Please check email id of person !",
                                icon: "info",
                            });
                        } else {
                            var passengerData = passengerHistory[index];
                            let other_Passengers = false;
                            let contact__Passenger = false;
                            for (let i = 0; i < otherPassengers.length; i++) {
                                if (otherPassengers[i].token == passengerData.token) {
                                    other_Passengers = true;
                                    break;
                                }
                            }
                            if (contactPassenger.token == passengerData.token) {
                                contact__Passenger = true;
                            }
                            if (other_Passengers == false && contact__Passenger == false) {
                                addPassengerCard(passengerData);
                                selectedPassengers++;
                            } else {
                                selectedPassengers++;
                                swal({
                                    text: "Lead Passenger Cannot be added in Other Passenger!..",
                                    icon: "info",
                                });
                            }
                        }
                    }
                });
                if (selectedPassengers == 0) {
                    swal({
                        text: "Please select atleast 1 person !",
                        icon: "info",
                    });
                } else {
                    $('#add_passenger_modal').modal('hide');
                }
            }
        }

        function getClearForm(hasDOB) {
            $('#passenger-title').val('Mr');
            $('#passenger-name').val('');
            $('#passenger-mobile').val(userMobile);
            $('#passenger-email').val('');
            $('#passenger-dob').val('');
            $('.loyalty-input-box').addClass('hidden');
            $('#loyaltyId').val('');
            $('#search-passenger').val('');
            searchByName();
            document.getElementById("is-adult").checked = false;
            document.getElementById("loyalty").checked = false;
            document.querySelector('.selected__passenger-count').innerHTML = '';

            $('#passenger-history>li').removeClass('selected');

            $('.add__passenger-container').removeClass('hidden');
            $('.saved__passenger-container').addClass('hidden');

            if (hasDOB) {
                $('.dob-input').css('display', 'block');
            } else {
                $('.dob-input').css('display', 'none');
            }
            if (hasAgeCheck) {
                $('.age-check-input').css('display', 'block');
            } else {
                $('.age-check-input').css('display', 'none');
            }

            var addPassNameCond = "<sup>*</sup>";
            var addPassMobileCond = "(Optional)";
            var addPassEmailCond = "(Optional)";

            isMobileMandatory = false;
            isEmailMandatory = false;
            if (passenger_type == "contact") {
                addPassMobileCond = "*";
                addPassEmailCond = "*";

                isMobileMandatory = true;
                isEmailMandatory = true;
            } else if (passenger_type == "greet") {
                addPassMobileCond = "*";

                isMobileMandatory = true;
            }

            $('#add-pass-name-cond').text(addPassNameCond);
            $('#add-pass-mobile-cond').text(addPassMobileCond);
            $('#add-pass-email-cond').text(addPassEmailCond);

            $('#add_passenger_modal').modal('show');
        }

        var loyalty_number;
        var isLoyalty;
        function addPassenger() {
            $('#append_tc_link').empty();
            var title = $('#passenger-title').val().trim();
            var name = $('#passenger-name').val().trim();
            // var country_code = "+91";
            var full_number = passengerPhoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
            var mobile_number = $('#passenger-mobile').val().trim().replaceAll(" ", "");
            var country_code = full_number.replace(mobile_number, "");
            var email_id = $('#passenger-email').val().trim();
            var date_of_birth = $('#passenger-dob').val().trim();
            var isAdult = document.getElementById("is-adult").checked;
            var programName = document.getElementById('loyaltyId').placeholder;
            isLoyalty = document.getElementById("loyalty").checked;
            loyalty_number = $('#loyaltyId').val().trim();

            var isEmail = String(email_id).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

            if (title != '' && name != '' && (!isMobileMandatory || mobile_number != '') && (!isEmailMandatory || (email_id != '' && isEmail)) && (!hasAgeCheck || isAdult)) { //(date_of_birth!='' || passenger_type == 'greet')
                var name_view = '';
                if (title == 'NULL') {
                    title = '';
                    name_view = name;
                } else {
                    name_view = title + '. ' + name;
                }
                var index = -1;
                passengerHistory.forEach(function (passengerData, passengerKey) {
                    if (passengerData.date_of_birth == date_of_birth && passengerData.email_id == email_id && passengerData.mobile_number == mobile_number && passengerData.name == name && passengerData.title == title) {
                        index = passengerKey;
                    }
                });
                if (isLoyalty == true && loyalty_number == '') {
                    swal({
                        text: `Kindly enter your ${programName} Id`,
                        icon: "warning",
                    });
                } else if (isLoyalty == false && loyalty_number == '') {
                    var passengerData = {};
                    if (index > 0) {
                        passengerData = passengerHistory[index];
                        addPassengerCard(passengerData);
                    } else {
                        var passengerInputData = {
                            'title': title,
                            'name': name,
                            'country_code': country_code,
                            'mobile_number': mobile_number,
                            'email_id': email_id,
                            'date_of_birth': date_of_birth
                        };
                        passengerInputData = JSON.stringify(passengerInputData);
                        $.ajax({
                            type: 'POST',
                            url: 'php/users-passenger/create.php',
                            dataType: 'JSON',
                            data: passengerInputData,
                            success: function (response) {
                                if (response.status_code == 200) {
                                    var responseData = response.data;
                                    swal("", response.message, "success")
                                        .then(function () {
                                            passengerData = response.data;

                                            passengerHistory.push(passengerData);
                                            $('#passenger-history').append(makePassengerHistoryCard(passengerData, (passengerHistory.length - 1)));

                                            addPassengerCard(passengerData);

                                            initPassengerSelector();
                                        });
                                } else {
                                    swal("", response.message, "error");
                                }
                            }
                        });
                    }
                } else {
                    // var sc_exclusivegst = Math.round(service_cost * (dc_percet/100));
                    // var sc_exclusivegst = service_cost;
                    // var totalcvpoint = Math.round((sc_exclusivegst / milesCost) * milesPoint);
                    $('#service_cv').text(milesPoint);
                    $('#service_cost_spent').text(currencySelected.concat(' ', JSON.stringify(milesCost)));
                    var distributorName = $('#distributorName').val();
                    $('.distributor-name').text(distributorName);
                    $('.membership-name').text(programName);

                    var membershipType = $('#membershipType').val();
                    var loyaltyid = $('#loyaltyId').val().trim();

                    // Distributor Terms and Condition Link
                    var tclink1 = $('#tcLink1').val();
                    var mydiv1 = document.getElementById("append_tc_link");
                    var aTag1 = document.createElement('a');
                    aTag1.setAttribute('href', tclink1);
                    aTag1.setAttribute('target', '_blank');
                    aTag1.setAttribute('class', 'brand-link');
                    aTag1.innerText = `${distributorName} and `;
                    mydiv1.appendChild(aTag1);

                    var tclink2 = $('#tcLink2').val();
                    var mydiv2 = document.getElementById("append_tc_link");
                    var aTag2 = document.createElement('a');
                    aTag2.setAttribute('href', tclink2);
                    aTag2.setAttribute('target', '_blank');
                    aTag2.setAttribute('class', 'brand-link');
                    aTag2.innerText = ` ${programName}`;
                    mydiv2.appendChild(aTag2);

                    if (membershipType == 'Numeric') {
                        var removelastdigit = loyaltyid.substring(0, loyaltyid.length - 1);
                        var checkloyaltynumber = checkloyalty(loyaltyid);
                        var ismembershipId = removelastdigit + checkloyaltynumber;
                    } else {
                        var ismembershipId = $('#loyaltyId').val().trim();
                    }
                    var loyaltyLength = document.getElementById('loyaltyId').maxLength;
                    if (loyaltyid.length != loyaltyLength) {
                        swal({
                            text: `${programName} length does not match !`,
                            icon: "warning",
                        });
                        var remove_tc_link = document.getElementById("append_tc_link");
                        remove_tc_link.removeChild(remove_tc_link.firstElementChild);
                    } else if (loyaltyid != ismembershipId && isLoyalty == true && loyalty_number != '') {
                        swal({
                            text: `Kindly enter your correct ${programName} Id as the given Id is incorrect`,
                            icon: "warning",
                        });
                        $('.loyalty-input-box').addClass('hidden');
                        document.getElementById("loyalty").checked = false;
                        $('#loyaltyId').val('');
                        var remove_tc_link = document.getElementById("append_tc_link");
                        remove_tc_link.removeChild(remove_tc_link.firstElementChild);
                    } else {
                        $('#loyalty-points_modal').modal('show');
                        $('.loyalty-btn').on('click', function () {
                            loyalty_success(index, passengerHistory, title, name, country_code, mobile_number, email_id, date_of_birth);
                        });
                    }
                }
            } else if (title == '' || name == '') {
                swal({
                    text: "Please check the name !",
                    icon: "warning",
                });
            } else if (isMobileMandatory && mobile_number == '') {
                swal({
                    text: "Please check mobile number !",
                    icon: "warning",
                });
            } else if (isEmailMandatory && (email_id == '' || !isEmail)) {
                swal({
                    text: "Please check email address !",
                    icon: "warning",
                });
            } else if (hasAgeCheck && !isAdult) {
                swal({
                    text: "Please agree to that the passenger is above 12 years of age !",
                    icon: "warning",
                });
            } else {
                swal({
                    text: "Please fill all fields !",
                    icon: "warning",
                });
            }
        }

        function loyalty_success(index, passengerHistory, title, name, country_code, mobile_number, email_id, date_of_birth) {
            var passengerData = {};
            if (index > 0) {
                passengerData = passengerHistory[index];
                addPassengerCard(passengerData);
            } else {
                var passengerInputData = {
                    'title': title,
                    'name': name,
                    'country_code': country_code,
                    'mobile_number': mobile_number,
                    'email_id': email_id,
                    'date_of_birth': date_of_birth
                };
                passengerInputData = JSON.stringify(passengerInputData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-passenger/create.php',
                    dataType: 'JSON',
                    data: passengerInputData,
                    success: function (response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function () {
                                    passengerData = response.data;

                                    passengerHistory.push(passengerData);
                                    $('#passenger-history').append(makePassengerHistoryCard(passengerData, (passengerHistory.length - 1)));

                                    addPassengerCard(passengerData);

                                    initPassengerSelector();
                                    $('#loyalty-points_modal').modal('hide');
                                });
                        } else {
                            swal("", response.message, "error");
                        }
                    }
                });
            }
        }

        function initPassengerSelector() {
            //Add existing passengers
            const existingPassengersList = document.querySelector('.existing__passengers-list');
            const existingPassengers = document.querySelector('.existing__passengers-list').childNodes;

            existingPassengers.forEach(passenger => {
                if (passenger.getAttribute("data-hasEvent") == "0") {
                    passenger.addEventListener('click', function () {
                        if (!isMultiplePassenger) $('#passenger-history>li').removeClass('selected');

                        this.classList.toggle('selected');
                        const selectedPassengerCount = existingPassengersList.querySelectorAll('.selected').length;
                        if (selectedPassengerCount !== 0) {
                            document.querySelector('.selected__passenger-count').innerHTML = selectedPassengerCount;
                        } else {
                            document.querySelector('.selected__passenger-count').innerHTML = '';
                        }
                    });
                    passenger.setAttribute("data-hasEvent", 1);
                }
            });
        }

        function addGst() {
            var name = $('#gst-name').val().trim();
            var gstin = $('#gst-number').val().trim();

            if (name != '' && gstin != '') {
                var gstData = { 'name': name, 'gstin': gstin };
                gstData = JSON.stringify(gstData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-gst/create.php',
                    dataType: 'JSON',
                    data: gstData,
                    success: function (response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function () {
                                    gstObj = responseData;
                                    gstHistory.push(gstObj);
                                    $('#gst-history').append(`<li class="gst-selector" data-index="${gstHistory.length}">
                                    <div class="input-box-sets">
                                        <div class="input-lable">
                                            <p>${gstObj.name}</p>
                                            <p class="input-data">${gstObj.gstin}</p>
                                        </div>
                                    </div>
                                </li>`);
                                    gstDetail = responseData;
                                    makeGstCard();
                                });
                        } else {
                            swal("", response.message, "error");
                        }
                    }
                });
            } else {
                swal({
                    text: "Please fill all fields !",
                    icon: "warning",
                });
            }
        }

        function makePassengerCard(passengerObj, tempType) {
            // var ageView = (tempType == 'greet')? ``: `<p>(${passengerObj.age})</p>`;
            var contactArr = [];
            if (passengerObj.mobile_number != '') {
                contactArr.push(`${passengerObj.country_code}-${passengerObj.mobile_number}`);
            }
            if (passengerObj.email_id != '') {
                contactArr.push(`${passengerObj.email_id}`);
            }
            return `<div class="input-form-group-item">
                <div class="input-box-set">
                    <h4>${passengerObj.name_view}</h4>
                    <p>${contactArr.join(" | ")}</p>
                </div>
                <div>
                    <p style="cursor: pointer;" class="passenger-remover" data-type="${tempType}">X</p>
                </div>
            </div>`;
            // ${ageView}
        }

        function addPassengerCard(passengerData) {
            switch (passenger_type) {
                case 'contact':
                    var passengerCard = makePassengerCard(passengerData, 'contact');
                    contactPassenger = passengerData;
                    $('#contact-passenger-box').html(passengerCard);
                    $('#add-contact-passenger').text('Change Lead Passenger');
                    $('#add_passenger_modal').modal('hide');
                    break;

                case 'other':
                    var passengerCard = makePassengerCard(passengerData, 'other');
                    if (otherPassengers.indexOf(passengerData) < 0) {
                        otherPassengers.push(passengerData);
                        $('#other-passenger-box').append(passengerCard);
                        $('#add-other-passenger').text('Change Other Passenger');
                    }
                    $('#add_passenger_modal').modal('hide');
                    break;

                case 'greet':
                    var passengerCard = makePassengerCard(passengerData, 'greet');
                    if (greetPassengers.indexOf(passengerData) < 0) {
                        greetPassengers = [passengerData];
                        $('#greet-passenger-box').html(passengerCard);
                        $('#add-greet-passenger').text('Change Alternate Contact Details');
                        // greetPassengers.push(passengerData);
                        // $('#greet-passenger-box').append(passengerCard);
                    }
                    $('#add_passenger_modal').modal('hide');
                    break;

                default:
                    break;
            }
            $('.passenger-remover').on('click', function () {
                $(this).attr('disabled', true);
                var tempPasIndex = -1;
                switch ($(this).attr('data-type')) {
                    case 'contact':
                        contactPassenger = {};
                        $('#contact-passenger-box').empty();
                        $('#add-contact-passenger').text('Add Lead Passenger');
                        break;

                    case 'other':
                        tempPasIndex = $("#other-passenger-box .passenger-remover").index(this);
                        if (tempPasIndex > -1) otherPassengers.splice(tempPasIndex, 1);
                        $('#add-other-passenger').text('Add Other Passenger');
                        break;

                    case 'greet':
                        greetPassengers = [];
                        $('#greet-passenger-box').empty();
                        $('#add-greet-passenger').text('Add Alternate Contact Details');
                        // tempPasIndex = $("#greet-passenger-box .passenger-remover").index(this);
                        // if(tempPasIndex > -1) greetPassengers.splice(tempPasIndex, 1);
                        break;

                    default:
                        break;
                }
                if (tempPasIndex > -1) $(this).closest('.input-form-group-item').remove();
            });
            var remove_tc_link = document.getElementById("append_tc_link");
            if (!remove_tc_link) {
                remove_tc_link.removeChild(remove_tc_link.firstElementChild);
            }
        }

        function proceedToPay() {
            setTimeout(function () { $('#loading').fadeIn(); }, 500);
            $("#pay-btn").prop( "disabled", true );
            if (document.getElementById('checkout-agreement').checked) {
                if (contactPassenger.hasOwnProperty('mobile_number') && eTicket != '') {
                    var panNumber = $("#pan-number").val().trim();
                    var greet = $("textarea#greet").val().trim();
                    var bouqueteer = $("textarea#bouqueteer").val().trim();

                    if (isLoyalty == true) {
                        loyalty_number = $('#loyaltyId').val().trim();
                        var totalcv_earned = Math.round(service_cost / milesCost) * milesPoint;
                    } else {
                        loyalty_number = '';
                    }

                    var journeyArray = JSON.parse(sessionStorage.getItem("jsonJourney"));
                    journeyDate = journeyArray[0].departure_date;

                    var jsonServiceData = sessionStorage.getItem("jsonServiceData");
                    var serviceData = JSON.parse(jsonServiceData);
                    var stationArray = [];
                    var totalAdultCount = parseInt(serviceData[0].adult_count);
                    var totalChildCount = parseInt(serviceData[0].children_count);
                    var totalPassengerCount = totalAdultCount + totalChildCount;
                    var totalPassengersAdded = 1 + otherPassengers.length;// + greetPassengers.length;

                    if (totalPassengerCount == totalPassengersAdded) {
                        serviceData.forEach(function (stationObj) {
                            var selectedServiceArr = [];
                            stationObj.service_collection.forEach(function (serviceColObj) {
                                serviceColObj.service_group.forEach(function (serviceGrpObj) {
                                    serviceGrpObj.service_array.forEach(function (serviceObj) {
                                        if (serviceObj.isSelected) {
                                            var selectedServiceObj = {
                                                "service_token": serviceObj.service_token,
                                                "adult_count": serviceObj.adult_count,
                                                "children_count": serviceObj.children_count,
                                                "service_date": serviceObj.service_date,
                                                "service_time": serviceObj.service_time,
                                                "notes": serviceObj.notes
                                            };
                                            selectedServiceArr.push(selectedServiceObj);
                                        }
                                    });
                                });
                            });
                            if (selectedServiceArr.length > 0) {
                                var selectedStationObj = {
                                    "ttr_token": stationObj.ttr_token,
                                    "type_token": stationObj.type_token,
                                    "category_token": stationObj.category_token,
                                    "flight_number": stationObj.flight_number,
                                    "journey": stationObj.journey,
                                    "service_array": selectedServiceArr
                                };
                                stationArray.push(selectedStationObj);
                            }
                        });

                        var jsonCouponData = sessionStorage.getItem("couponData");
                        var couponData = JSON.parse(jsonCouponData);
                        var coupon__code;
                        var coupon__type;
                        var coupon_status;
                        couponData.forEach(function (couponObj) {
                            if (couponObj.coupon_status == "true") {
                                coupon__code = couponObj.coupon__Code;
                                coupon__type = couponObj.coupon__type;
                                coupon_status = couponObj.coupon_status;
                            } else {
                                coupon__code = '';
                                coupon__type = '';
                                coupon_status = '';
                            }
                        });

                        // sessionStorage.setItem("currencySelected", "INR");
                        //var currencySelected = (sessionStorage.getItem("currencySelected") === null)? "INR": sessionStorage.getItem("currencySelected");
                        var orderInput = { 'station_array': stationArray, "currency": currencySelected, "has_convenience": hasConvenience, "custom_convenience_fee": customConvenienceFee, "coupon_code": coupon__code, "coupon_status": coupon_status, "coupon_type": coupon__type };
                        orderInput = JSON.stringify(orderInput);
                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: 'php/razor/create-order.php',
                            data: orderInput,
                            dataType: 'JSON',
                            success: function (orderResponse) {
                                if (orderResponse.status_code == 200) {
                                    $("#pay-btn").prop( "disabled", true ); 
                                    var inputData = {};
                                    inputData.contact_passenger = contactPassenger;
                                    inputData.other_passenger = otherPassengers;
                                    inputData.greet_passenger = greetPassengers;
                                    inputData.e_ticket = eTicket;
                                    inputData.panNumber = panNumber;
                                    inputData.gst_name = (gstDetail.hasOwnProperty('name')) ? gstDetail.name : "";
                                    inputData.gst_number = (gstDetail.hasOwnProperty('gstin')) ? gstDetail.gstin : "";
                                    inputData.greet = greet;
                                    inputData.station_array = stationArray;
                                    inputData.journey_array = journeyArray;
                                    inputData.razorpay_payment_id = "Credit order";
                                    inputData.razorpay_order_id = "Credit order";
                                    inputData.razorpay_signature = "Credit order";
                                    inputData.currency = currencySelected;
                                    inputData.has_convenience = hasConvenience;
                                    inputData.custom_convenience_fee = customConvenienceFee;
                                    inputData.loyalty_number = loyalty_number;
                                    inputData.totalcv_earned = totalcv_earned;
                                    inputData.coupon_code = coupon__code;
                                    inputData.coupon_status = coupon_status;
                                    inputData.coupon_type = coupon__type;

                                    if (orderResponse.is_credit) {
                                        var inputJSONData = JSON.stringify(inputData);
                                        createBooking(inputJSONData);
                                    } else {
                                        var order_id = orderResponse.order_id;
                                        var total_amount = orderResponse.total_amount;
                                        var receipt = orderResponse.receipt;

                                        var prefills = {};
                                        if (orderResponse.user_name != '') {
                                            prefills.name = orderResponse.user_name;
                                        }
                                        if (orderResponse.user_email != '') {
                                            prefills.email = orderResponse.user_email;
                                        }
                                        if (orderResponse.user_mobile != '') {
                                            prefills.contact = orderResponse.user_mobile;
                                        }

                                        var options = {
                                            "key": orderResponse.rzp_authkey, // Enter the Key ID generated from the Dashboard
                                            // "amount": orderResponse.payment_amount, // Amount is in currency subunits.currency is INR. Hence, 50000 refers to 50000 paise
                                            // "currency" : "INR",
                                            "name": orderResponse.user_name,
                                            "description": "Choose Payment Mode",
                                            "image": orderResponse.header_logo,
                                            "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                            "handler": function (response) {
                                                inputData.razorpay_payment_id = response.razorpay_payment_id;
                                                inputData.razorpay_order_id = response.razorpay_order_id;
                                                inputData.razorpay_signature = response.razorpay_signature;

                                                var inputJSONData = JSON.stringify(inputData);
                                                createBooking(inputJSONData);
                                            },
                                            "prefill": prefills,
                                            "notes": {
                                                "address": "Razorpay Corporate Office"
                                            },
                                            "theme": {
                                                "color": orderResponse.primary_color
                                            },
                                            "modal": {
                                                "ondismiss": function () {
                                                    $('#loading').fadeOut();
                                                }
                                            }
                                        };
                                        var rzp1 = new Razorpay(options);
                                        rzp1.open();
                                    }
                                } else {
                                    $("#pay-btn").prop( "disabled", false );
                                    swal({
                                        text: orderResponse.message,
                                        icon: "warning",
                                    }).then(function () {
                                        setTimeout(function () { $('#loading').fadeOut(); }, 500);
                                    })
                                }
                            }
                        });
                    } else {
                        $("#pay-btn").prop( "disabled", false );
                        swal({
                            text: "Please add 1 Lead passenger and " + (totalPassengerCount - 1) + " other passengers to continue booking !",
                            icon: "warning",
                        }).then(function () {
                            setTimeout(function () { $('#loading').fadeOut(); }, 500);
                        });
                    }
                } else if (!contactPassenger.hasOwnProperty('mobile_number')) {
                    $("#pay-btn").prop( "disabled", false );
                    swal({
                        text: "Lead passenger cannot be empty",
                        icon: "warning",
                    }).then(function () {
                        setTimeout(function () { $('#loading').fadeOut(); }, 500);
                    });
                } else {
                    $("#pay-btn").prop( "disabled", false );
                    swal({
                        text: "Please upload e-ticket",
                        icon: "warning",
                    }).then(function () {
                        setTimeout(function () { $('#loading').fadeOut(); }, 500);
                    });
                }
            } else {
                $("#pay-btn").prop( "disabled", false );
                swal({
                    text: "Please accept terms and conditions",
                    icon: "warning",
                }).then(function () {
                    setTimeout(function () { $('#loading').fadeOut(); }, 500);
                });
            }
        }

        function createBooking(inputJSONData) {
            var inputData = JSON.parse(inputJSONData);
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-booking/create.php',
                data: inputJSONData,
                dataType: 'JSON',
                success: function (bookingResponse) {
                    if (bookingResponse.status_code == 200) {
                        $('#confetti-usr-name').text(inputData.contact_passenger.name);
                        $('#confetti-station-view').text(bookingResponse.data.journey);
                        $('#confetti-journey-date').text(journeyDate);
                        $('#success_modal').modal({ backdrop: 'static', keyboard: false });

                        sessionStorage.removeItem("jsonInput");
                        sessionStorage.removeItem("jsonServiceData");
                        sessionStorage.removeItem("couponData");
                    } else {
                        alert(bookingResponse.message);
                    }
                    setTimeout(function () { $('#loading').fadeOut(); }, 500);
                }
            });
        }

        function dateDiff(dob) {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            var dobSplit = dob.split('-');
            var dd2 = parseInt(dobSplit[0]);
            var mm2 = monthNames.indexOf(dobSplit[1]) + 1;
            var yyyy2 = parseInt(dobSplit[2]);

            if (yyyy > yyyy2) {
                return (yyyy - yyyy2) + ' yrs';
            } else if (mm > mm2) {
                return (mm - mm2) + ' months';
            } else if (dd > dd2) {
                return (dd - dd2) + ' days';
            } else {
                return '-';
            }
        }

        function checkloyalty(loyaltyNum) {
            loyaltyNum = loyaltyNum.substring(0, loyaltyNum.length - 1);
            getloyalty = loyaltyNum / 7;
            getNumber = getloyalty.toFixed(1);
            data = getDecimalPart(getNumber) * 7;
            return Math.round(data);
        }

        function getDecimalPart(num) {
            if (Number.isInteger(num)) {
                return 0;
            }
            const decimalStr = num.toString().split('.')[1];
            return Number(decimalStr / 10);
        }
    </script>
    <script src="js/s3upload.js?v=<?php echo date('YmdHis'); ?>"></script>
    <script>
        $('.loyalty-input-radio').on('click', function () {
            if ($('.loyalty-input-radio').is(":checked")) {
                $('.loyalty-input-box').removeClass('hidden');
            } else {
                $('.loyalty-input-box').addClass('hidden');
                $('#loyaltyId').val('');
            }
        });

        // Allow only numbers
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function alpha(evt) {
            var k = (evt.which) ? evt.which : event.keyCode
            if ((k < 48 || k > 57) && (k < 65 || k > 90) && (k < 97 || k > 122))
                return false;
            return true;
        }
    </script>
</body>

</html>