<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | My Booking</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/my-cart.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <!--LOADER-->
        <div id="loading"></div>

        <header></header>

        <!-- NAV MENU -->
        <nav></nav>

        <section class="cart-sec">
            <input type="hidden" id="gtag_id">
            <div class="container">
                <div class="tab-box">
                    <ul class="nav nav-tabs ser-ab-review-tab">
                        <li class="active">
                            <a data-toggle="tab" href="#myself">For Myself</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#others" class="">For Others</a>
                        </li>
                    </ul>
                </div>
                <div class="cart-header">
                    <h2>My Bookings</h2>
                </div>
                <div class="tab-content">
                    <div id="myself" class="tab-pane fade in active">
                        <div class="cart-lists"></div>
                    </div>
                    <div id="others" class="tab-pane fade">
                        <div class="cart-lists"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- POPUPS -->
<div id="booking-detail-modal" class="modal fade" role="dialog">
        <div class="service-modal-body">
            <div class="text-right" style="margin-bottom: 16px; padding-right: 32px;">
                <img src="asset/choose-service/close-white.svg" class="close-modal" alt="close icon" data-dismiss="modal">
            </div>
            <div class="container" id="booking-detail-modal-container"></div>
            <div class="chat-box">
                <div class="chat-header">
                    <div>
                        <p id="user_name_chat">Mr.Brent Bridges</p>
                        <p id="chat_services_name">Meet and greet assistant</p>
                    </div>
                    <div class="close-chat" onclick="closeChatBox()">
                        <img src="asset/close-white.svg" alt="close icon">
                    </div>
                </div>

                <div class="chat-field">
                    <div class="chat-body">
                        <div class="chatting-area"> </div>
                    </div>
                    <div class="chat-footer">
                        <ul class="suggested_text_list" style="display: none;">
                            <li onclick="direct_msg(this)" style="cursor: pointer;">Hi !</li>
                            <li onclick="direct_msg(this)" style="cursor: pointer;">Reached Airport</li>
                            <li onclick="direct_msg(this)" style="cursor: pointer;">Flight Delayed</li>
                            <li onclick="direct_msg(this)" style="cursor: pointer;">Reached Airport</li>
                            <li onclick="direct_msg(this)" style="cursor: pointer;">Flight Delayed</li>
                        </ul>
                        <div class="messaging-container">
                            <div class="message-box">
                                <input type="text" placeholder="Type message..." id="msg_text_field">
                                <span class="attach-tool--camera">
                                    <input type="file" id="upload-photo" accept="image/*" style="display:none;" onchange="image_upload('upload-photo')">
                                    <label for="upload-photo" style="display:inline-block;">
                                        <img src="asset/camera.svg" alt="camera icon">
                                    </label>
                                </span>
                                <!-- <div class="message__attachments-container">
                                    <div class="message__attachments">
                                        <div class="attachments_img-box">
                                            <img src="asset/logo.png" alt="attached image 1" width="50" height="50">
                                            <span class="remove-attachment">&times;</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <button class="send-msg-btn" onclick="sendMsg()"><img src="asset/send.svg" alt="send icon" ></button>
                        </div>
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

    <!-- Rate us Modal -->
    <div id="rateus_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="feed-backmodal-close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                    <div class="feedback-form">
                        <input type="hidden" id="order_token">
                        <div class="modal-header modal-rating-header">
                            <h2>Let us know how we are doing!</h2>
                        </div>
                        <div class="logo-product-set">
                            <img src="asset/mybooking/service-logo.png" class="product-logo" alt="logo">
                            <h4 id="review-company"></h4>
                            <p id="review-station"></p>
                            <!-- <ul class="rate-area">
                                <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Amazing"></label>
                                <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Good"></label>
                                <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average"></label>
                                <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Not bad"></label>
                                <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Bad"></label>
                            </ul> -->
                            <div class="star-container">
                                <svg width="52" height="48" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="rate('1')">
                                    <path id="Star1" class="star rated" d="M15.0489 0.927048C15.3483 0.00573707 16.6517 0.00574017 16.9511 0.927051L20.0413 10.4377C20.1751 10.8497 20.5591 11.1287 20.9923 11.1287H30.9924C31.9611 11.1287 32.3639 12.3683 31.5802 12.9377L23.4899 18.8156C23.1395 19.0702 22.9928 19.5216 23.1267 19.9336L26.2169 29.4443C26.5162 30.3656 25.4617 31.1317 24.678 30.5623L16.5878 24.6844C16.2373 24.4298 15.7627 24.4298 15.4122 24.6844L7.32198 30.5623C6.53826 31.1317 5.48378 30.3656 5.78314 29.4443L8.87333 19.9336C9.00721 19.5216 8.86055 19.0702 8.51006 18.8156L0.419821 12.9377C-0.363892 12.3683 0.0388863 11.1287 1.00761 11.1287H11.0077C11.4409 11.1287 11.8249 10.8497 11.9587 10.4377L15.0489 0.927048Z" fill="#D4D4D8"></path>
                                </svg>
                                <svg width="52" height="48" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="rate('2')">
                                    <path id="Star2" class="star rated" d="M15.0489 0.927048C15.3483 0.00573707 16.6517 0.00574017 16.9511 0.927051L20.0413 10.4377C20.1751 10.8497 20.5591 11.1287 20.9923 11.1287H30.9924C31.9611 11.1287 32.3639 12.3683 31.5802 12.9377L23.4899 18.8156C23.1395 19.0702 22.9928 19.5216 23.1267 19.9336L26.2169 29.4443C26.5162 30.3656 25.4617 31.1317 24.678 30.5623L16.5878 24.6844C16.2373 24.4298 15.7627 24.4298 15.4122 24.6844L7.32198 30.5623C6.53826 31.1317 5.48378 30.3656 5.78314 29.4443L8.87333 19.9336C9.00721 19.5216 8.86055 19.0702 8.51006 18.8156L0.419821 12.9377C-0.363892 12.3683 0.0388863 11.1287 1.00761 11.1287H11.0077C11.4409 11.1287 11.8249 10.8497 11.9587 10.4377L15.0489 0.927048Z" fill="#D4D4D8"></path>
                                </svg>
                                <svg width="52" height="48" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="rate('3')">
                                    <path id="Star3" class="star rated" d="M15.0489 0.927048C15.3483 0.00573707 16.6517 0.00574017 16.9511 0.927051L20.0413 10.4377C20.1751 10.8497 20.5591 11.1287 20.9923 11.1287H30.9924C31.9611 11.1287 32.3639 12.3683 31.5802 12.9377L23.4899 18.8156C23.1395 19.0702 22.9928 19.5216 23.1267 19.9336L26.2169 29.4443C26.5162 30.3656 25.4617 31.1317 24.678 30.5623L16.5878 24.6844C16.2373 24.4298 15.7627 24.4298 15.4122 24.6844L7.32198 30.5623C6.53826 31.1317 5.48378 30.3656 5.78314 29.4443L8.87333 19.9336C9.00721 19.5216 8.86055 19.0702 8.51006 18.8156L0.419821 12.9377C-0.363892 12.3683 0.0388863 11.1287 1.00761 11.1287H11.0077C11.4409 11.1287 11.8249 10.8497 11.9587 10.4377L15.0489 0.927048Z" fill="#D4D4D8"></path>
                                </svg>
                                <svg width="52" height="48" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="rate('4')">
                                    <path id="Star4" class="star rated" d="M15.0489 0.927048C15.3483 0.00573707 16.6517 0.00574017 16.9511 0.927051L20.0413 10.4377C20.1751 10.8497 20.5591 11.1287 20.9923 11.1287H30.9924C31.9611 11.1287 32.3639 12.3683 31.5802 12.9377L23.4899 18.8156C23.1395 19.0702 22.9928 19.5216 23.1267 19.9336L26.2169 29.4443C26.5162 30.3656 25.4617 31.1317 24.678 30.5623L16.5878 24.6844C16.2373 24.4298 15.7627 24.4298 15.4122 24.6844L7.32198 30.5623C6.53826 31.1317 5.48378 30.3656 5.78314 29.4443L8.87333 19.9336C9.00721 19.5216 8.86055 19.0702 8.51006 18.8156L0.419821 12.9377C-0.363892 12.3683 0.0388863 11.1287 1.00761 11.1287H11.0077C11.4409 11.1287 11.8249 10.8497 11.9587 10.4377L15.0489 0.927048Z" fill="#D4D4D8"></path>
                                </svg>
                                <svg width="52" height="48" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="rate('5')">
                                    <path id="Star5" class="star rated" d="M15.0489 0.927048C15.3483 0.00573707 16.6517 0.00574017 16.9511 0.927051L20.0413 10.4377C20.1751 10.8497 20.5591 11.1287 20.9923 11.1287H30.9924C31.9611 11.1287 32.3639 12.3683 31.5802 12.9377L23.4899 18.8156C23.1395 19.0702 22.9928 19.5216 23.1267 19.9336L26.2169 29.4443C26.5162 30.3656 25.4617 31.1317 24.678 30.5623L16.5878 24.6844C16.2373 24.4298 15.7627 24.4298 15.4122 24.6844L7.32198 30.5623C6.53826 31.1317 5.48378 30.3656 5.78314 29.4443L8.87333 19.9336C9.00721 19.5216 8.86055 19.0702 8.51006 18.8156L0.419821 12.9377C-0.363892 12.3683 0.0388863 11.1287 1.00761 11.1287H11.0077C11.4409 11.1287 11.8249 10.8497 11.9587 10.4377L15.0489 0.927048Z" fill="#D4D4D8"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="review-form">
                            <h4>Review</h4>
                            <textarea class="input-box" id="review" rows="7" placeholder="Your message..."></textarea>
                        </div>
                        <div class="review-sub-btn-set">
                            <button class="review-sub-btn primary-butn" onclick="updateReview()">Submit Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div id="report_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="feed-backmodal-close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                    <div class="feedback-form">
                        <input type="hidden" id="report-order-detail-id">
                        <div class="modal-header modal-rating-header">
                            <h2>Let us know how we are doing !</h2>
                        </div>
                        <div class="logo-product-set">
                            <img src="asset/mybooking/service-logo.png" id="report-logo" class="product-logo" alt="logo">
                            <h4 id="report-name">Pranaam</h4>
                            <p id="report-station">MAA Airport - Terminal 1</p>
                        </div>
                        <div class="review-form">
                            <div class="reason-set">
                                <!-- bg-arrow -->
                                <label for="select_reason">Reason</label>
                                <select class="select-input" id="select_reason">
                                    <option value="0">Staff was not on time</option>
                                    <option value="1">-</option>
                                    <option value="2">-</option>
                                    <option value="3">-</option>
                                </select>
                            </div>
                            <div class="review-set">
                                <h4>Description</h4>
                                <textarea class="input-box" id="report_desc" rows="7" placeholder="Your message..."></textarea>
                            </div>
                        </div>
                        <div class="review-sub-btn-set">
                            <button class="review-sub-btn" onclick="updateReport()">Submit Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cancel booking modal -->
    <div id="cancel_booking_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header title-model">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to cancel the booking?</h5>
                    <div class="">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                        <img src="asset/choose-service/close-white.svg" class="close close-modal" alt="close icon" data-dismiss="modal">
                    </div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="service-token">
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
                                <h5 id="total-service-cost"></h5>
                            </div>
                            <div class="cost-text">
                                <h6>Total Discount Amount</h6>
                                <h5 id="total-discount-amount"></h5>
                            </div>
                            <div class="cancel-text">
                                <h6>Total Cancellation fee</h6>
                                <h5 style="color: #d22e27;">- <span id="total-cancellation-fee">0</span></h5>
                            </div>
                            <div class="cancel-text">
                                <h6>Total Platform fee</h6>
                                <h5 style="color: #d22e27;">- <span id="platform-fee">0</span></h5>
                            </div>
                            <div class="refund-text">
                                <h6>Total Refundable Amount</h6>
                                <h5 id="total-refund"></h5>
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

    <!-- Modal verify otp -->
    <div class="modal fade" id="otp_modal" tabindex="-1" role="dialog" aria-labelledby="examplesTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header title-model">
                    <h5 class="modal-title" id="exampleModalLongTitle">Verify OTP</h5>
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="login-input-action-set" id="login_otp">
                        <div class="otp-desc-set">
                            <p>Please enter the OTP to cancel the booking</p>
                            <p>OTP sent to <span id="user-mobile-number"></span></p>
                            <span class="resend-otp-note">Didn't receive the code? <a href="javascript:void(0)" class="resend-otp" onclick="send_Otp()">Resend OTP</a></span>
                            <div class="otp-timer">
                                <img src="asset/timer.svg" class="clock-icon" alt="clock icon">
                                <spam class="timer-set"><span class="timer-count" id="countdowntimer">10</span> s</spam>
                            </div>
                        </div>
                        <div class="otp-group">
                            <input class="otp-input first-otp" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1" placeholder="0" />
                            <input class="otp-input" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" placeholder="0" />
                            <input class="otp-input" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" placeholder="0" />
                            <input class="otp-input" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" placeholder="0" />
                            <input class="otp-input" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" maxlength="1" placeholder="0" />
                            <input class="otp-input last-otp" id="digit-6" name="digit-6" data-next="digit-7" data-previous="digit-5" maxlength="1" placeholder="0" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-butn" onclick="verify_Otp()">Verify OTP</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div id="view_review" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="feed-backmodal-close" data-dismiss="modal" onclick="close_review_modal()">&times;</button>
                <div class="modal-body">
                    <div class="feedback-form">
                        <input type="hidden" id="comment-order-detail-id">
                        <div class="modal-header modal-rating-header">
                            <h2>Your Review</h2>
                        </div>
                        <div class="review">
                            <div class="review__header">
                                <div class="review__user">
                                    <img src="asset/profile/user.jpg" id="view_review_user_image" alt="reviewer image" class="review__user-photo">
                                    <div>
                                        <p class="review__user-name" id="view_review_user_name">Douglas</p>
                                        <div class="star-rating" id="view_review_rating">
                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                            <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                        </div>
                                    </div>
                                </div>
                                <p class="review__date" id="view_review_date">18 Jan, 2022</p>
                            </div>
                            <p class="review__description" id="view_review_description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error culpa commodi nam, tempora voluptas eaque eligendi illo vitae id molestiae est beatae nemo harum mollitia quia expedita? Repudiandae, tempore ipsum!</p>
                        </div>
                        <p class="add-comment__button">Add new comment</p>
                        <div class="rating-form hidden">
                            <div class="review-set">
                                <h4>Comment</h4>
                                <textarea class="input-box" id="comment_desc" rows="7" placeholder="Your message..."></textarea>
                            </div>
                        </div>
                        <div class="comment-view hidden">
                            <h4>Comment</h4>
                            <p id="view_comment"></p>
                            <p id="view_comment_date">18 Jan, 2022</p>
                        </div>
                        <div class="rating-sub-btn-set hidden">
                            <button class="review-sub-btn" onclick="update_comment()">Post Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo View Modal -->
    <div class="imageViewer" style="display:none;">
        <img src="asset/choose-service/close.svg" class="viewer-close__icon" alt="close icon">
        <div class="image__container">
            <img src="" alt="chat image" id="chat-image">
        </div>
    </div>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script src="js/moment.min.js<?php echo $cache_str; ?>"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-firestore.js"></script>
    <script>
        var bookingsData = [];
        var curBookingDetail = {};
        var items;
        var isCompleteBooking = false;
        var globalBookingToken = 0;
        var globalBookingNumber = 0;
        var globalOrderToken = 0;
        var rating = 0
        var review = '';
        var previewID = '';
        var reportID = '';
        var reportArray = [];
        var isAgent = false;
        var currency_symbol = '';
        
        // For S3 bucket
        AWS.config.region = 'ap-south-1'; // 1. Enter your region
        AWS.config.credentials = new AWS.CognitoIdentityCredentials({
        IdentityPoolId: 'ap-south-1:0d3824be-4bcd-4ac8-8f34-b29baa427f00' // 2. Enter your identity pool
        });
        AWS.config.credentials.get(function (err) {
        if (err) alert(err);
        });
        var bucket = new AWS.S3({
        params: {Bucket: 'airportzoapp'}
        });
        var aws_cloudfront_url = 'https://d1xqjehqvi7b4u.cloudfront.net/';
        var globalInvoicePdf = [];
        $(document).ready(function() {
            var userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                window.location.href = "index.php";
            } else {
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'php/users/get-user-detail.php',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            isAgent = (responseData.is_agent && responseData.is_approved == "Approved")? true: false;
                        }
                    }
                });
                if ( !isAgent ) {
                    $('.tab-box').remove();
                }
            }

            $('#rateus_modal').on('hidden.bs.modal', function() {
                $('#booking-detail-modal').modal('show');
            })

            $('#select_reason').empty();
            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/report-reason/read.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        reportArray = response.data;
                        reportArray.forEach(function(reportData) {
                            $('#select_reason').append(`<option value="${reportData.token}">${reportData.reason}</option>`);
                        });
                    }
                }
            });

            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users-booking/read-history.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        bookingsData = responseData;

                        responseData.forEach(function(orderData, orderKey) {
                            var passengerArr = [];
                            if (orderData.total_adult > 0) {
                                passengerArr.push(`${orderData.total_adult} Adults`);
                            }
                            if (orderData.total_children > 0) {
                                passengerArr.push(`${orderData.total_children} Children`);
                            }
                            var status = '';
                            switch (orderData.status) {
                                case 'Pending':
                                    status = `<span class="widget upcoming">
                                        <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                        <span>Pending</span>
                                    </span>`;
                                    break;

                                case 'Confirmed':
                                    status = `<span class="widget completed">
                                        <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                        <span>Confirmed</span>
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
                            var bookingCard = `<div class="cart-list" data-index="${orderKey}">
                                <div class="location-time">
                                    <div class="cart-title-set">
                                        <h2>${orderData.journey}</h2>
                                        <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                                    </div>
                                    <p>${orderData.service_dates.join(", ")}</p>
                                </div>
                                <div class="cart-division"></div>
                                <div class="cart-desc">
                                    <div class="cart-type">
                                        <p>Passengers</p>
                                        <h4>${passengerArr.join(", ")}</h4>
                                    </div>
                                    <div class="service-type">
                                        <p>Total services</p>
                                        <h4>${orderData.total_service} services</h4>
                                    </div>
                                </div>
                                <div class="ponit-amt-set">
                                    ${status}
                                    <span class="price-set">
                                        <p>₹ ${orderData.total_amount}</p>
                                    </span>
                                </div>
                            </div>`;
                            if (isAgent && orderData.for_others) {
                                $('#others>.cart-lists').append(bookingCard);
                            } else {
                                $('#myself>.cart-lists').append(bookingCard);
                            }
                        });
                        if ($('#myself>.cart-lists').html() == '') {
                            $('#myself>.cart-lists').html(`<h4>No bookings found</h4>`);
                        }
                        if ($('#others>.cart-lists').html() == '') {
                            $('#others>.cart-lists').html(`<h4>No bookings found</h4>`);
                        }
                        var backendbookingStatus = '';
                        $('.cart-list').on('click', function() {
                            // $('#loading').fadeIn("slow");
                            var dataIndex = $(this).attr('data-index');
                            var bookingsDataDetail = bookingsData[dataIndex];
                            globalBookingToken = bookingsDataDetail.token;
                            globalBookingNumber = bookingsDataDetail.booking_number;
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: 'php/users-booking/get-order-detail.php',
                                data: JSON.stringify({'token': bookingsDataDetail.token}),
                                dataType: 'JSON',
                                success: function(response) {
                                    if (response.status_code == 200) {
                                        //console.log(response);
                                        var bookingDetailData = response.data;
                                        curBookingDetail = bookingDetailData;
                                        
                                        var journeyType = (bookingDetailData.journey.split("-").length > 2)? 'Multi Journey': 'Direct Flight';

                                        var passengersArr = [];
                                        var adultCount = parseInt(bookingDetailData.total_adult);
                                        var childCount = parseInt(bookingDetailData.total_children);
                                        if (adultCount > 0) {
                                            if(adultCount > 1) passengersArr.push(adultCount + ' Adults');
                                            else passengersArr.push('1 Adult');
                                        }
                                        if (childCount > 0) {
                                            if(childCount > 1) passengersArr.push(childCount + ' Children');
                                            else passengersArr.push('1 Child');
                                        }

                                        var orderStatus = bookingDetailData.status;

                                        var cancellableOrders = 0;
                                        var stationTypeArr = [];
                                        curBookingDetail.order_detail.forEach(function (tempStationObj) {
                                            if (stationTypeArr.indexOf(tempStationObj.airport_type) < 0) {
                                                stationTypeArr.push(tempStationObj.airport_type);
                                            }
                                            tempStationObj.order_detail_array.forEach(function (tempServiceObj) {
                                                backendbookingStatus = tempServiceObj.status;
                                                if (tempServiceObj.can_be_cancelled) {
                                                    cancellableOrders++;
                                                }
                                            });
                                        });

                                        var actionBtn = ``;
                                        if (cancellableOrders) {
                                            actionBtn = `<div class="cancel">
                                                <button class="sec-btn cancel__booking-btn" data-dismiss="modal" onclick="cancelBooking(true)">Cancel Booking</button>
                                            </div>`;
                                        } else {
                                            actionBtn = `<div class="cancel">
                                                <button class="sec-btn cancel__booking-btn" data-dismiss="modal" onclick="cancelBooking(false)">Check Status</button>
                                            </div>`;
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

                                        var servicesBooked = '';
                                        // bookingDetailData.order_detail.forEach(function(serviceDetail) {
                                        var category_discountAmount = 0;
                                        bookingDetailData.order_detail.forEach(function(stationDetail, stationKey) {
                                            var gmtView = stationDetail.gmt_view;
                                            gmtView = (gmtView && gmtView!='')? ' (GMT ' + gmtView + ')': '';

                                            var serviceDetailArr = [];
                                            stationDetail.order_detail_array.forEach(function(serviceObj, serviceKey) {
                                                category_discountAmount += parseFloat(serviceObj.discount_amount);
                                                var serviceStatus = '';
                                                switch(serviceObj.status) {
                                                    case 'Pending':
                                                    case 'Confirmed':
                                                    case 'Assign':
                                                        serviceStatus = `<span class="widget upcoming" style="float: right;">
                                                            <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                                            <span>Upcoming</span>
                                                        </span>`;
                                                        break;

                                                    case 'Ongoing':
                                                        serviceStatus = `<span class="widget completed" style="float: right;">
                                                            <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                                            <span>Ongoing</span>
                                                        </span>`;
                                                        break;
                                                        
                                                    case 'Completed':
                                                        serviceStatus = `<span class="widget completed" style="float: right;">
                                                            <img src="asset/mybooking/complete.svg" class="coint-icon" alt="icon">
                                                            <span>Completed</span>
                                                        </span>`;
                                                        break;
                                                        
                                                    case 'Cancelled':
                                                        var tempStatus = "Cancelled";
                                                        if (serviceObj.cancelled_by != 'User') {
                                                            tempStatus += " by " + serviceObj.cancelled_by;
                                                        }
                                                        serviceStatus = `<span class="widget cancelled" style="float: right;">
                                                            <img src="asset/mybooking/cancel.svg" class="coint-icon" alt="icon">
                                                            <span>${tempStatus}</span>
                                                        </span>`;
                                                        break;

                                                    default:
                                                        status = ``;
                                                        break;
                                                }

                                                var company_logo = (serviceObj.company_logo != '')? serviceObj.company_logo: 'asset/mybooking/service-logo.png';
                                                
                                                var servicePassengersArr = [];
                                                if (parseInt(serviceObj.total_adult) > 0) servicePassengersArr.push(serviceObj.total_adult + ' Adults');
                                                if (parseInt(serviceObj.total_children) > 0) servicePassengersArr.push(serviceObj.total_children + ' Children');

                                                var reportAccess = '';
                                                // if (serviceObj.status == 'Completed') {
                                                if (serviceObj.report_reason_token != '') {
                                                    var i = reportArray.findIndex(x => x.token == serviceObj.report_reason_token);

                                                    // reportAccess = `<i class="fa fa-exclamation-triangle" style="color: red;" title="${reportArray[i].reason} | ${serviceObj.report_description}" aria-hidden="true"></i>`;
                                                    reportAccess = `<a class="report-service" onclick="swal(\'${reportArray[i].reason}\', \'${serviceObj.report_description}\')">View Report</a>`;
                                                } else if (serviceObj.status == 'Completed') {
                                                    // reportAccess = `<img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                                                    //     <div class="report-prblm-set">
                                                    //         <a onclick="raiseReport('report-div-${stationKey}-${serviceKey}', '${serviceObj.token}', '${serviceObj.company_name}', '${company_logo}', '${stationDetail.airport_name} - ${stationDetail.terminal_name}')">Report a Problem</a>
                                                    //     </div>`;
                                                    reportAccess = `<a class="report-service" id="report-div-${stationKey}-${serviceKey}" onclick="raiseReport('report-div-${stationKey}-${serviceKey}', '${serviceObj.token}', '${serviceObj.company_name}', '${company_logo}', '${stationDetail.airport_name} - ${stationDetail.terminal_name}')">Report a Problem</a>`;
                                                }
                                                // }

                                                var ratingAction = ``;
                                                var notesView = ``;
                                                if (serviceObj.status == 'Completed' || serviceObj.status == 'Cancelled') {
                                                    if (serviceObj.rating > 0 || serviceObj.review != '') {
                                                        // ratingAction = `<div class="star-rating">`;
                                                        // for (let index = 1; index <= 5; index++) {
                                                        //     if (index <= serviceObj.rating) {
                                                        //         ratingAction += `<img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">`;
                                                        //     } else {
                                                        //         ratingAction += `<img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">`;
                                                        //     }
                                                        // }
                                                        // ratingAction += `</div>`;
                                                        ratingAction += `<a href="javascript:void(0)" onclick="viewRating('${serviceObj.token}', '${bookingDetailData.user_name}', '${bookingDetailData.user_image}', '${serviceObj.rating}', '${serviceObj.review}', '${serviceObj.review_date_time}', '${serviceObj.comment}', '${serviceObj.comment_date_time}')" data-dismiss="modal">View Rating</a>`;
                                                    } else {
                                                        if (serviceObj.status == 'Cancelled') {
                                                            ratingAction = ``;//serviceStatus;
                                                        } else {
                                                            ratingAction = `<a href="javascript:void(0)" class="rateus-link" onclick="rateUs('${serviceObj.token}', '${serviceObj.company_name}', '${stationDetail.airport_name} - ${stationDetail.terminal_name}', '${serviceObj.rating}', '${serviceObj.review}', 'rating-div-${stationKey}-${serviceKey}')" data-dismiss="modal">Rate us</a>`;
                                                        }
                                                    }
                                                } else if (serviceObj.notes != '' && (serviceObj.status == 'Pending' || serviceObj.status == 'Ongoing')) {
                                                    var notesView = `<a href="javascript:void(0)" class="rateus-link view-notes-link" onclick="viewNotes(${stationKey}, ${serviceKey})">View Notes</a>
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onclick="openChatBox()">
                                                            <title>message</title>
                                                            <g id="message" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <path d="M18.6666667,3.66666667 C19.5875,3.66666667 20.3333333,4.4125 20.3333333,5.33333333 L20.3333333,5.33333333 L20.3333333,15.3333333 C20.3333333,16.2541667 19.5875,17 18.6666667,17 L18.6666667,17 L7,17 L3.66666667,20.3333333 L3.675,5.33333333 C3.675,4.4125 4.4125,3.66666667 5.33333333,3.66666667 L5.33333333,3.66666667 Z M14,10.8666667 L7.33333333,10.8666667 L7.33333333,12.2 L14,12.2 L14,10.8666667 Z M17.3333333,6.93333333 L7.33333333,6.93333333 L7.33333333,8.26666667 L17.3333333,8.26666667 L17.3333333,6.93333333 Z" id="message_icon" fill="#07b3d2" fill-rule="nonzero"></path>
                                                            </g>
                                                        </svg>`;
                                                }

                                                // Declare dates for Chat Options
                                                var chatAction = ``;
                                                var newdate1 = new Date(serviceObj.service_date_time_raw);
                                                var newdate2 = new Date();

                                                var diff = (newdate1 - newdate2);
                                                var mins = Math.round((diff/1000)/60);
                                                // if(mins <= 30 && mins >= 0){ //start before 30min and end in after 30min condition
                                                // if(mins <= 30){
                                                //     chatAction = `<img class="chat-btn" src="asset/message.svg" alt="message icon" onclick="openChatBox('${serviceObj.token}','${bookingDetailData.user_name}','${serviceObj.service_name}')">`;
                                                // }

                                                if(mins <= 30){
                                                    chatAction = `<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onclick="openChatBox('${serviceObj.token}','${bookingDetailData.user_name}','${serviceObj.service_name}')">
                                                                    <title>message</title>
                                                                    <g id="message" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <path d="M18.6666667,3.66666667 C19.5875,3.66666667 20.3333333,4.4125 20.3333333,5.33333333 L20.3333333,5.33333333 L20.3333333,15.3333333 C20.3333333,16.2541667 19.5875,17 18.6666667,17 L18.6666667,17 L7,17 L3.66666667,20.3333333 L3.675,5.33333333 C3.675,4.4125 4.4125,3.66666667 5.33333333,3.66666667 L5.33333333,3.66666667 Z M14,10.8666667 L7.33333333,10.8666667 L7.33333333,12.2 L14,12.2 L14,10.8666667 Z M17.3333333,6.93333333 L7.33333333,6.93333333 L7.33333333,8.26666667 L17.3333333,8.26666667 L17.3333333,6.93333333 Z" id="message_icon" fill="#07b3d2" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg>`;
                                                }

                                               currency_symbol = serviceObj.currency=='INR' ? '₹' : '$';
                                                serviceDetailArr.push(`<div class="product-desc-set">
                                                    <div class="prod-log-set">
                                                        <img src="${company_logo}" class="prod-logo" alt="">
                                                    </div>
                                                    <div class="prod-price-desc">
                                                        <div class="prod-name-id-feedback-set">
                                                            <div class="prod-name-id-set">
                                                                <h2>${serviceObj.company_name} ${serviceStatus}</h2>
                                                                <p>Order ID : ${serviceObj.token} | ${serviceObj.service_date_time} ${gmtView}</p>
                                                            </div>
                                                        </div>
                                                        <div class="prod-type-price-set">
                                                            <p>${serviceObj.service_name} | ${servicePassengersArr.join(", ")}</p>
                                                            <h6>${currency_symbol} ${serviceObj.net_amount}</h6>
                                                        </div>
                                                        <div class="service-detail-footer">
                                                            <div class="star-rating-set" id="rating-div-${stationKey}-${serviceKey}">
                                                                ${notesView}
                                                                ${ratingAction}
                                                            </div>
                                                            ${chatAction}
                                                            ${reportAccess}
                                                        </div>
                                                    </div>
                                                </div>`);
                                                            // <div class="prod-feedback-set" id="report-div-${stationKey}-${serviceKey}">
                                                            //     ${reportAccess}
                                                            // </div>
                                                // data-toggle="modal" data-dismiss="modal" data-target="#report_modal"
                                            });

                                            servicesBooked += `<div class="booked-service-set">
                                                <div class="service-header">
                                                    <h4>${stationDetail.airport_code}</h4>
                                                    <p>${stationDetail.airport_name} - ${stationDetail.terminal_name}</p>
                                                    <h3>${stationDetail.order_detail_array[0].service_date_time} ${gmtView}</h3>
                                                </div>
                                                ${serviceDetailArr.join("<div class=\"prod-hst-division\"></div>")}
                                            </div>`;
                                            
                                        });

                                        var contactPersonArr = [];
                                        var otherPersonArr = [];
                                        var greetPersonArr = [];

                                        bookingDetailData.passenger_detail.forEach(function(passengerObj) {
                                            switch (passengerObj.passenger_type) {
                                                case 'Contact':
                                                    contactPersonArr = passengerObj.passenger_array;
                                                    break;
                                                case 'Others':
                                                    otherPersonArr = passengerObj.passenger_array;
                                                    break;
                                                case 'Greeter':
                                                    greetPersonArr = passengerObj.passenger_array;
                                                    break;
                                            }
                                        });

                                        var passengerView = ``;
                                        if (contactPersonArr.length > 0) {
                                            passengerView += `<div class="passenger-details-set">
                                                <div class="passenger-details-item">
                                                    <h4>${contactPersonArr[0].name_view}</h4>
                                                    <p>${contactPersonArr[0].mobile_view} | ${contactPersonArr[0].email_id}</p>
                                                </div>
                                            </div>`;
                                                    // <p class="age">(${contactPersonArr[0].age})</p>
                                        }

                                        var otherPassengerView = ``;
                                        if (otherPersonArr.length > 0) {
                                            otherPersonArr.forEach(function(otherPersonObj) {
                                                otherPassengerView += `<div class="passenger-details-set">
                                                    <div class="passenger-details-item">
                                                        <h4>${otherPersonObj.name_view}</h4>
                                                        <p>${otherPersonObj.mobile_view} | ${otherPersonObj.email_id}</p>
                                                    </div>
                                                </div>`;
                                                        // <p class="age">(${otherPersonObj.age})</p>
                                            });
                                        }

                                        var greetPassengerView = ``;
                                        if (greetPersonArr.length > 0) {
                                            greetPersonArr.forEach(function(greetPersonObj) {
                                                greetPassengerView += `<div class="passenger-details-set">
                                                    <div class="passenger-details-item">
                                                        <h4>${greetPersonObj.name_view}</h4>
                                                        <p>${greetPersonObj.mobile_view} | ${greetPersonObj.email_id}</p>
                                                    </div>
                                                </div>`;
                                                        // <p class="age">(${greetPersonObj.age})</p>
                                            });
                                        }

                                        if (passengerView != '') {
                                            passengerView = `<span class="accordion-title">Passenger details</span>` + passengerView;
                                        }
                                        if (otherPassengerView != '') {
                                            otherPassengerView = `<span class="accordion-title">Other Passengers</span>` + otherPassengerView;
                                        }
                                        if (greetPassengerView != '') {
                                            greetPassengerView = `<span class="accordion-title">Greet Person </span>` + greetPassengerView;
                                        }

                                        var journeyArr = [];
                                        bookingDetailData.journey_detail.forEach(function(journeyData) {
                                            journeyArr.push(`<div class="flight__details">
                                                <div class="passenger-details-set">
                                                    <div class="passenger-details-item">
                                                        <p>From</p>
                                                        <h4>${journeyData.depart_airport + ' - ' + journeyData.depart_terminal}</h4>
                                                    </div>
                                                    <div class="passenger-details-item">
                                                        <p>Date</p>
                                                        <h4>${journeyData.depart_date}</h4>
                                                    </div>
                                                </div>
                                                <div class="passenger-details-set">
                                                    <div class="passenger-details-item">
                                                        <p>To</p>
                                                        <h4>${journeyData.arrival_airport + ' - ' + journeyData.arrival_terminal}</h4>
                                                    </div>
                                                    <div class="passenger-details-item">
                                                        <p>Flight Number</p>
                                                        <h4>${journeyData.flight_number}</h4>
                                                    </div>
                                                </div>
                                            </div>`);
                                        });

                                        var paymentCurrency = ``;
                                        if (bookingDetailData.currency != 'INR') {
                                            paymentCurrency = `<div class="total-amt-set">
                                                <p>Payment Done In</p>
                                                <p>${bookingDetailData.currency} ${bookingDetailData.payment_view}</p>
                                            </div>`;
                                        }
                                        var discount_amount = '';
                                        if(bookingDetailData.discount_type=='2' && bookingDetailData.coupon_type=='1'){
                                            discount_amount += `<div class="price-summary-details">
                                                                    <p>Discount Amount</p>
                                                                    <p> - ${currency_symbol} ${bookingDetailData.discount_amount}</p>
                                                                </div>`;
                                        } 
                                        else if(bookingDetailData.discount_type=='2' && bookingDetailData.coupon_type=='2') {
                                            discount_amount += `<div class="price-summary-details">
                                                                    <p>Discount Amount</p>
                                                                    <p> - ${currency_symbol} ${category_discountAmount}</p>
                                                                </div>`;
                                        }
                                        
                                        var gstinDetail = (bookingDetailData.gst_name != '' || bookingDetailData.gst_number != '')? `<div class="accordion-item">
                                            <button id="accordion-button-2" aria-expanded="false">
                                                <span class="accordion-title">GSTIN Details</span>
                                                <span class="icon" aria-hidden="true"></span>
                                            </button>
                                            <div class="accordion-content gst-desc">
                                                <div>
                                                  <p>Company Name</p>
                                                  <p>${bookingDetailData.gst_name}</p>
                                                </div>
                                                <div>
                                                  <p>GSTIN Number</p>
                                                  <p>${bookingDetailData.gst_number}</p>
                                                </div>
                                            </div>
                                        </div>`: ``;

                                        globalInvoicePdf = bookingDetailData.serviceCancelledPDf; 
                                        if (bookingDetailData.cancel_booking_invoice_pdf!=""){
                                            globalInvoicePdf.push(bookingDetailData.cancel_booking_invoice_pdf);
                                        }
                                        var downloadInvoice = '';
                                        downloadInvoice += `<div class="invoice-set">
                                        <button class="dropdown-toggle invoice-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg style="margin-right:10px;" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="download" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <path d="M19,16.1904762 L17.88,16.1904762 L17.88,18.984127 L6.12,18.984127 L6.12,16.1904762 L5,16.1904762 L5,20 L19,20 L19,16.1904762 Z M11.44,4 L11.44,13.3333333 L7.912,10.1206349 L7.114,10.8444444 L12,15.2761905 L16.886,10.8444444 L16.088,10.1206349 L12.56,13.3333333 L12.56,4 L11.44,4 Z" id="download-icon" stroke="#F04F38" stroke-width="0.984615385" fill="#F04F38" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            Download Invoice
                                            <svg style="float:right;" width="24px" height="24px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="down" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="down-arrow" transform="translate(4.000000, 5.000000)" fill="#000" fill-rule="nonzero" stroke="#000" stroke-width="0.3">
                                                        <polyline id="Fill-35" points="0 0.636942675 0.583941606 0 4 3.75796178 7.41605839 0 8 0.636942675 4 5 0 0.636942675"></polyline>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu invoice__dropdown-menu">`;
                                        let serviceStatusCheck = bookingDetailData.services_status.includes('Cancelled');
                                        if(serviceStatusCheck==false){
                                            downloadInvoice+= `<li><a onclick="download_invoice()" style="cursor: pointer;">Download Booking Invoice</a></li>`;
                                        } else {
                                            downloadInvoice+= `<li><a onclick="download_invoice()" style="cursor: pointer;">Download Booking Invoice</a></li>
                                            <li><a onclick="download_cancel_invoice()" style="cursor: pointer;">Download Credit Invoice</a></li>`;
                                        }
                                        downloadInvoice+=`</ul></div>`;

                                        currency_symbol = bookingDetailData.currency=='INR' ? '₹' : '$';
                                        
                                        var bookingDetail = `<div class="bookhisty-main-set">
                                            <div class="bookhisty-left">
                                                <div class="bookhisty-left-inner-set">
                                                    <div class="bookhisty-header">
                                                        <h2>${bookingDetailData.journey}</h2>
                                                        <p>${bookingDetailData.service_dates.join(", ")}</p>
                                                        <div class="header-division"></div>
                                                    </div>
                                                    <div class="history-lists">
                                                        <div class="history-list">
                                                            <p>Booking ID</p>
                                                            <h4>${bookingDetailData.booking_number}</h4>
                                                        </div>
                                                        <div class="history-list">
                                                            <p>Service Type</p>
                                                            <h4>${stationTypeArr.join(", ")}</h4>
                                                        </div>
                                                        <div class="history-list">
                                                            <p>Passengers</p>
                                                            <h4>${passengersArr.join(", ")}</h4>
                                                        </div>
                                                        <div class="history-list">
                                                            <p>Booking Date</p>
                                                            <h4>${bookingDetailData.date_time}</h4>
                                                        </div>
                                                        <div class="history-list">
                                                            <p>Total services</p>
                                                            <h4>${bookingDetailData.total_service} services</h4>
                                                        </div>
                                                        <div class="history-list">
                                                            ${status}
                                                        </div>
                                                    </div>
                                                    <div class="list-division"></div>
                                                    <div class="accordion">
                                                        <div class="accordion-item">
                                                            <button id="accordion-button-1" aria-expanded="true">
                                                                <span class="accordion-title">Services booked</span>
                                                                <span class="icon" aria-hidden="true"></span>
                                                            </button>
                                                            <div class="accordion-content">
                                                                ${servicesBooked}
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <button id="accordion-button-2" aria-expanded="false">
                                                                <span class="accordion-title">Passenger details</span>
                                                                <span class="icon" aria-hidden="true"></span>
                                                            </button>
                                                            <div class="accordion-content">
                                                                ${passengerView}
                                                                ${otherPassengerView}
                                                                ${greetPassengerView}
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <button id="accordion-button-2" aria-expanded="false">
                                                                <span class="accordion-title">Flight Details</span>
                                                                <span class="icon" aria-hidden="true"></span>
                                                            </button>
                                                            <div class="accordion-content">
                                                                ${journeyArr.join("")}
                                                            </div>
                                                        </div>
                                                        ${gstinDetail}
                                                    </div>
                                                    ${actionBtn}
                                                </div>
                                            </div>
                                            <div class="bookhisty-right">
                                                <div class="bookhisty-inner-set">
                                                    <div class="price-details-set">
                                                        <h4>Price Details</h4>
                                                        <div class="price-summary">
                                                            <div class="price-summary-details">
                                                                <p>Service Cost</p>
                                                                <p>${currency_symbol} ${bookingDetailData.service_amount}</p>
                                                            </div>
                                                            ${discount_amount}
                                                            <div class="price-summary-details">
                                                                <p>GST</p>
                                                                <p>${currency_symbol} ${bookingDetailData.service_gst}</p>
                                                            </div>
                                                            <div class="price-summary-details">
                                                                <p>Convenience Fee</p>
                                                                <p>${currency_symbol} ${bookingDetailData.convenience_fee}</p>
                                                            </div>
                                                            <div class="price-summary-details">
                                                                <p>Convenience Fee GST</p>
                                                                <p>${currency_symbol} ${bookingDetailData.cf_tax}</p>
                                                            </div>
                                                        </div>
                                                        <div class="summary-division"></div>
                                                        <div class="total-amt-set">
                                                            <p>Total Amount</p>
                                                            <p>₹ ${bookingDetailData.total_amount}</p>
                                                        </div>
                                                        ${paymentCurrency}
                                                        ${downloadInvoice}
                                                    </div>`;
                                                    
                                    bookingDetail+=`<div class="cancellation_details hidden">
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
                                        </div>`;
                                        $('#booking-detail-modal-container').html(bookingDetail);
                                        if(backendbookingStatus=='Draft'){
                                            $('.invoice-set').addClass('hidden');
                                        } else {
                                            $('.invoice-set').removeClass('hidden');
                                        }
                                        items = document.querySelectorAll(".accordion button");
                                        items.forEach(item => item.addEventListener('click', toggleAccordion));

                                        $('#booking-detail-modal').modal('show');
                                        // window.location.href = 'booking-history.php';
                                    }
                                    // setTimeout(function() { $('#loading').fadeOut("slow"); }, 500 );
                                }
                            });
                        });
                    } else {
                        $('.cart-lists').append(`<h2>${response.message}</h2>`);
                    }
                }
            });
            // setTimeout(function(){$('#loading').fadeOut();},500);
        });

        function viewNotes(stationKey, serviceKey) {
            var serviceNotes = curBookingDetail.order_detail[stationKey].order_detail_array[serviceKey].notes;
            if (serviceNotes != '') swal("", serviceNotes);
            else swal("", "No notes found", "warning");
        }

        function raiseReport(id, order_detail_id, company_name, company_logo, station_detail) {
            reportID = id;
            $('#report-order-detail-id').val(order_detail_id);
            $('#report-logo').attr('src', company_logo);
            $('#report-name').text(company_name);
            $('#report-station').text(station_detail);

            $("textarea#report_desc").val('');

            $('#report_modal').modal('show');
            $('#booking-detail-modal').modal('hide');
        }

        function viewRating(rating_order_detail_token, user_name, user_image, rating, review, review_date, comment, comment_date){
            $('#comment-order-detail-id').val(rating_order_detail_token);
            $('#view_review_user_name').text(user_name);
            if(user_image==''){
                $('#view_review_user_image').attr('src', 'https://placeimg.com/200/300/animals');
            } else {
                $('#view_review_user_image').attr('src', user_image);
            }
            
            
            var preview_rating = '';
            for (let index = 1; index <= 5; index++) {
                if (index <= rating) {
                    preview_rating += `<img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">`;
                } else {
                    preview_rating += `<img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">`;
                }
            }
            
            $('#view_review_rating').html(preview_rating);
            $('#view_review_description').text(review);
            $('#view_review_date').text(review_date);
            $('#view_review').modal('show');
            $('#booking-detail-modal').modal('hide');
            if(comment != ''){
               $('.add-comment__button').addClass('hidden');
               $('.comment-view').removeClass('hidden');
               $('#view_comment').html(comment);
               $('#view_comment_date').text(comment_date);
            } else {
                $('.comment-view').addClass('hidden');
            }
        }

        function update_comment(){
            var booking_detail_token = $('#comment-order-detail-id').val();
            var comment_desc = $("#comment_desc").val();
           
            var inputData = {
                'booking_detail_token': booking_detail_token,
                'comment_desc': comment_desc
            }
            var inputJSONData = JSON.stringify(inputData);
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-booking/update-comment.php',
                data: inputJSONData,
                success: function (response){
                    if(response.status_code == 200) {
                        swal("", response.message, "success")
                        .then(function(){
                            close_review_modal();
                            window.location.reload();
                        });
                    }
                }
            });
        }

        function close_review_modal(){
            $("#comment_desc").val('');
            $('.rating-form').addClass('hidden');
            $('.rating-sub-btn-set').addClass('hidden');
            $('.add-comment__button').removeClass('hidden');
            $('#view_review').modal('hide');
            $('#booking-detail-modal').modal('show');
        }

        function updateReport() {
            var detail_token = $('#report-order-detail-id').val();
            var report_token = $('#select_reason').val();
            var report_title = $('#select_reason option:selected').text();
            var description = $("textarea#report_desc").val();

            var inputData = {
                'token': curBookingDetail.token,
                'detail_token': detail_token,
                'report_token': report_token,
                'description': description
            };
            var inputJSONData = JSON.stringify(inputData);
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/report-reason/update-report.php',
                data: inputJSONData,
                success: function(response) {
                    if (response.status_code == 200) {
                        swal("", response.message, "success")
                            .then(function() {
                                var reportView = `<i class="fa fa-exclamation-triangle" style="color: red;" title="${report_title} | ${description}" aria-hidden="true"></i>`;
                                $('#' + reportID).text('View Report');
                                $('#' + reportID).attr('onclick', `swal('${report_title}', '${description}')`);

                                $('#report_modal').modal('hide');
                                $('#booking-detail-modal').modal('show');
                            });
                    } else {
                        swal("", response.message, "error")
                    }
                }
            });
        }

        function rateUs(order_token, company_name, station_view, rating, review, previewId) {
            $('#order_token').val(order_token);
            $('#review-company').text(company_name);
            $('#review-station').text(station_view);
            // $('#rating').
            $("textarea#review").val(review);
            previewID = previewId;

            $('#rateus_modal').modal('show');
        }

        function updateReview() {
            var rating = 0;
            $('.star-container').find('svg').each(function() {
                if ($(this).find('path').hasClass('rated')) {
                    rating++;
                }
            });
            var order_token = $('#order_token').val();
            var review = $("textarea#review").val();

            var inputData = {
                'order_token': order_token,
                'rating': rating,
                'review': review
            };
            var inputJSONData = JSON.stringify(inputData);
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-booking/update-review.php',
                data: inputJSONData,
                success: function(response) {
                    if (response.status_code == 200) {
                        swal("", response.message, "success")
                            .then(function() {
                                var ratingPreview = `<div class="star-rating">`;
                                for (let index = 1; index <= 5; index++) {
                                    if (index <= rating) {
                                        ratingPreview += `<img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">`;
                                    } else {
                                        ratingPreview += `<img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">`;
                                    }
                                }
                                ratingPreview += `</div>`;
                                $('#' + previewID).html(ratingPreview);
                                window.location.reload();

                                $('#rateus_modal').modal('hide');
                                $('#booking-detail-modal').modal('show');
                            });
                    }
                }
            });
        }

        function download_invoice() {
            var fileURL = curBookingDetail.invoice_pdf;
            url = fileURL;
            fetch(url)
            .then(resp => resp.blob())
            .then(blobobject => {
                const blob = window.URL.createObjectURL(blobobject);
                const anchor = document.createElement('a');
                anchor.style.display = 'none';
                anchor.href = blob;
                anchor.download = url.replace(/^.*[\\\/]/, '');
                document.body.appendChild(anchor);
                anchor.click();
                window.URL.revokeObjectURL(blob);
            })
            .catch(() => console.log('An error in downloadin gthe file sorry'));
        }

        function download_cancel_invoice() {
            globalInvoicePdf.forEach(function(item) {
                var fileURL = item;
                url = fileURL;
                fetch(url)
                .then(resp => resp.blob())
                .then(blobobject => {
                    const blob = window.URL.createObjectURL(blobobject);
                    const anchor = document.createElement('a');
                    anchor.style.display = 'none';
                    anchor.href = blob;
                    anchor.download = fileURL.replace(/^.*[\\\/]/, '');
                    document.body.appendChild(anchor);
                    anchor.click();
                    window.URL.revokeObjectURL(blob);
                })
                .catch(() => console.log('An error in downloadin gthe file sorry'));
            });
        }

        function cancelBooking(hasCancellableService) {
            var totalServiceCost = 0;
            var totalDiscountAmount = 0;
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
                        totalServiceCost += parseFloat(serviceObj.net_amount);
                        totalDiscountAmount += parseFloat(`${serviceObj.adult_discount + serviceObj.child_discount + serviceObj.add_adult_discount + serviceObj.add_child_discount}`);
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

                    var dis__amt = '';
                    dis__amt += `<div class="discount-text avail-text">
                                        <p>Discount Amount</p>
                                        <h6>${currency_symbol} ${serviceObj.adult_discount + serviceObj.child_discount + serviceObj.add_adult_discount + serviceObj.add_child_discount}</h6>
                                </div>`
                    
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
                            <h6>${currency_symbol} ${serviceObj.net_amount}</h6>
                        </div>`;
                        if(serviceObj.cancelled_by=='Service Provider'){
                            orderServiceCancellationDetail+=`<div class="cost-text avail-text">
                                                                <p>Convenience Fee Incl Gst</p>
                                                                <h6>${currency_symbol} ${serviceObj.user_conv_fee}</h6>
                                                            </div>`;
                        }
                        orderServiceCancellationDetail+=`${dis__amt}
                        <div class="cancel-text avail-text">
                            <p>Cancel Before</p>
                            <h6>${cancelBefore}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Cancellation fee</p>
                            <h6>${currency_symbol} ${cancellationDetail.cancellation_fee}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Platform fee</p>
                            <h6 style="cursor: pointer;" ${maxPlatformFeeTitle}>${currency_symbol} ${cancellationDetail.airportzo_fee}${maxPlatformFeeSup}</h6>
                        </div>
                        <div class="cancelfee-text avail-text">
                            <p>Refund Amount</p>
                            <h6>${currency_symbol} ${cancellationDetail.refund_amount}</h6>
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
            $('#total-service-cost').text(`${currency_symbol} ${totalServiceCost.toFixed(2)}`);
            $('#total-discount-amount').text(`${currency_symbol} ${totalDiscountAmount}`);
            $('#total-cancellation-fee').text(`${currency_symbol} ${totalCancellationFee}`);
            $('#platform-fee').text(`${currency_symbol} ${totalAirportzoCancellationFee}`);
            $('#total-refund').text(`${currency_symbol} ${totalRefundAmount}`);
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
            $('#service-token').val(service_token);
            if($('#Policy').is(":checked")) {
                $('#otp_modal').modal('show');
                // $('#cancel_booking_modal').modal('hide');
                $('.resend-otp-note').addClass('hidden');
                var user_country_code = $("body").attr('data-usr-country-code');
                var user_mobile = $('body').attr('data-usr-mobile');
                
                var inputData = {
                    country_code: user_country_code,
                    mobile_number: user_mobile
                };
                inputData = JSON.stringify(inputData);
                $.ajax({
                    url: "php/users/user-service-cancel.php",
                    data: inputData,
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status_code == 200){
                            $("#user-mobile-number").text(user_country_code + "-" + user_mobile);
                            $(".otp-input").val("");
                            $(".first-otp").focus();
                            generate_otp_timmer();
                            $('#cancel_booking_modal').modal('hide');
                        } else {
                            swal ("", response.message,"error");
                            $('#otp_modal').modal('hide');
                            // $('#cancel_booking_modal').modal('show');
                        }
                    },
                });
            } else {
                swal({
                    text: "Please accept terms and conditions !",
                    icon: "warning",
                });
            }
        }

        function send_Otp() {
            var user_country_code = $("body").attr('data-usr-country-code');
            var user_mobile = $('body').attr('data-usr-mobile');
            
            var inputData = {
                country_code: user_country_code,
                mobile_number: user_mobile,
            };
            inputData = JSON.stringify(inputData);
            $.ajax({
                url: "php/users/user-service-cancel.php",
                data: inputData,
                type: "POST",
                dataType: "JSON",
                success: function (response) {
                    if (response.status_code == 200) {
                    } else {
                        swal("",response.message,"error");
                    }
                },
            });
        }

        function verify_Otp() {
            var user_country_code = $("body").attr('data-usr-country-code');
            var user_mobile = $('body').attr('data-usr-mobile');
            var otp = "";
            $(".otp-input").each(function () {
                otp += $(this).val();
            });
            var inputData = {
                country_code: user_country_code,
                mobile_number: user_mobile,
                otp: otp,
            };
            inputData = JSON.stringify(inputData);
            //console.log(inputData);
            $.ajax({
                url: "php/users/user-verification.php",
                data: inputData,
                type: "POST",
                dataType: "JSON",
                success: function (response) {
                    if (response.status_code == 200) {
                        $('#otp_modal').modal('hide');
                        $('#cancel_booking_modal').modal('show');
                        var inputData = {};
                        var serverCallUrl = "";
                        var cancelType = "";
                        var service_token = $('#service-token').val();
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
                        swal("",response.message,"error");
                    }
                },
            });
        }

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');

            // for (i = 0; i < items.length; i++) {
            //     items[i].setAttribute('aria-expanded', 'false');
            // }

            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            } else {
                this.setAttribute('aria-expanded', 'false');
            }
        }

        // star rating
        const stars = document.querySelectorAll('.star');
        function rate(rating) { //2
            $("#feedback_rating_add").val(rating);
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) { // 0 <= 2
                    $('#Star' + i).addClass('rated');
                } else {
                    $('#Star' + i).removeClass('rated');
                }
            }
        }

        $('.add-comment__button').on('click', function(){
            $('.rating-form').removeClass('hidden');
            $('.rating-sub-btn-set').removeClass('hidden');
            $('.add-comment__button').addClass('hidden');
        });

        function image_upload(file_id) {
            
            var fileUpload = document.getElementById(file_id);
            var fuData = document.getElementById(file_id).files[0].name;
            var files = !!fileUpload.files ? fileUpload.files : [];
            var FileUploadPath1 = fuData.split('.').pop().toLowerCase();
            // var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.pdf|.PDF)$");
            if(FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg"){
                if (typeof (fileUpload.files) != "undefined") {
                    var reader = new FileReader();
                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function (e) { 
                        // $('#' + file_id + '_valid').val("true");
                    }
                }
            }else{
                swal("Photo only allows file types of  PNG, JPG and JPEG");
            }
            var str_type = fileUpload.files[0].type;

            var result_type = str_type.split(/[.\-=/_]/);
            var type_len = result_type[1].length+1;
                
            var file = fileUpload.files[0];
            s3_file_upload(file,type_len);
        }

        function s3_file_upload(file,type_len){
            var seconds = new Date();
                seconds = seconds.getFullYear()+(seconds.getMonth() + 1).toString().padStart(2, "0")+seconds.getDate().toString().padStart(2, "0")+seconds.getHours()+seconds.getMinutes()+seconds.getSeconds();
            
                seconds = parseInt(seconds);
            var filename = seconds + file.name.substr(file.name.length - type_len);
            var folder = 'firebase_image/';
            var objKey = folder + filename;
            var params = {
                Key: objKey,
                ContentType: file.type,
                Body: file,
            };

            bucket.putObject(params, function (err, data) {
                if (err) {
                    alert('ERROR: ' + err);
                }else{
                    var image_fileurl = aws_cloudfront_url+folder+filename;
                    img_sendMsg(image_fileurl);
                }
            });
        }

        ///////////////////////////////////////////////////
        // Chat box
        const chatBox = document.querySelector('.chat-box');
        const chatBody = document.querySelector('.chat-body');
        const chattingArea = document.querySelector('.chatting-area');
        const userToken =  "user-"+$('body').attr('data-usr-token');
        var serviceToken = ""
        var chats = [];
        var unsubscribe = ""
        var collectionPath = ""
        function openChatBox(token,username,service_name) {
            chatBox.classList.add('show');
            if(unsubscribe != "" && serviceToken != token){
                unsubscribe();
            }
            if(serviceToken != token){
                chats = [];
                chattingArea.innerHTML = '';
                serviceToken = token
                collectionPath = "service/"+serviceToken+"/chat"
                const date = new Date();
                fetchMessage(date);
                addMsgListener(date);
                $("#user_name_chat").text(username);
                $("#chat_services_name").text(service_name);
            }
        }

        function closeChatBox() {
            chatBox.classList.remove('show');
        }

        const firebaseConfig = {
            apiKey: "AIzaSyC6VlZe6aISWHba7Mg5TciAJoz_yixu7R0",
            authDomain: "airportzo-dev.firebaseapp.com",
            databaseURL: "https://airportzo-dev-default-rtdb.firebaseio.com",
            projectId: "airportzo-dev",
            storageBucket: "airportzo-dev.appspot.com",
            messagingSenderId: "1050700848789",
            appId: "1:1050700848789:web:a2184d1c65568d80b5459c",
            measurementId: "G-ZGW4SN33ZP"
        };
        firebase.initializeApp(firebaseConfig);
        const db = firebase.firestore();

        function fetchMessage(date){
            db.collection(collectionPath)
                .orderBy("date_time", "desc")
                .where("date_time", "<", date)
                .get()
                .then((querySnapshot) => {
                    querySnapshot.forEach((doc) => {
                        const data = doc.data();
                        chats.push(data);
                        addMsgCell(data, true);
                    });
                    scrollToNewMsg();
            }).catch((error) => {
                console.log("Error getting documents: ", error);
            });
        }

        function addMsgListener(date){
            unsubscribe = db.collection(collectionPath)
                .orderBy("date_time", "asc")
                .where("date_time", ">=", date)
                .onSnapshot((snapshot) => {
                    snapshot.docChanges().forEach((change) => {
                        if (change.type === "added") {
                            const data = change.doc.data();
                            chats.push(data);
                            addMsgCell(data, false);
                        }
                        if (change.type === "modified") {
                            console.log("Modified msg: ", change.doc.data());
                        }
                        if (change.type === "removed") {
                            console.log("Removed msg: ", change.doc.data());
                        }
                    });
            });
        }
    function addMsgCell(dic, atFirst){
        const i = chats.findIndex(x => x == dic);
        if(dic.sender_id == userToken){
            var div = `<div class='msg-textbox sent-msg-textbox' id=${i}>`;
                            
                            if(dic.message_type == 'text'){
                                div += `<div class='msg sent-msg'>
                                            <p>${dic.message}</p>
                                            <p class='chat-time'>${dic.date_time.toDate().toDateString()}  ${moment(dic.date_time.toDate().toString()).format('h:mm a')}</p>
                                        </div>`;
                            }else if(dic.message_type == 'image'){
                                div += `<div class="message__attachments-container">
                                            <div class="message__attachments">
                                                <div class="attachments_img-box">
                                                    <img src="${dic.message}" alt="attached image 1" width="50" height="50">
                                                </div>
                                            </div>
                                            <p class='chat-time'>${dic.date_time.toDate().toDateString()}  ${moment(dic.date_time.toDate().toString()).format('h:mm a')}</p>
                                        </div>`;
                            }
                            
                div += `</div>`;
            atFirst == true ? $('.chatting-area').prepend(div) : $('.chatting-area').append(div);
        }else{
            var div = `<div class='msg-textbox received-msg-textbox' id=${i}>`;
                            
                            if(dic.message_type == 'text'){
                                div += `<div class='msg received-msg'>
                                            <p>${dic.message}</p>
                                            <p class='chat-time'>${dic.date_time.toDate().toDateString()}  ${moment(dic.date_time.toDate().toString()).format('h:mm a')}</p>
                                        </div>`;
                            }else if(dic.message_type == 'image'){
                                div += `<div class="message__attachments-container">
                                            <div class="message__attachments">
                                                <div class="attachments_img-box">
                                                    <img src="${dic.message}" alt="attached image 1" width="50" height="50">
                                                </div>
                                            </div>
                                            <p class='chat-time'>${dic.date_time.toDate().toDateString()}  ${moment(dic.date_time.toDate().toString()).format('h:mm a')}</p>
                                        </div>`;
                            }

                    div += `</div>`;
            atFirst == true ? $('.chatting-area').prepend(div) : $('.chatting-area').append(div);
        }
        scrollToNewMsg();
    }
    $('#msg_text_field').keypress(function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            sendMsg();
        }
    });

    function sendMsg(){
        var element = document.getElementById("msg_text_field");
        const msg = element.value.trim();
        if(msg != ""){
            db.collection(collectionPath).add({
                message: msg,
                message_type: 'text',
                sender_id: userToken,
                date_time: new Date()
            })
            .then((docRef) => {
                element.value = "";
                console.log("Document successfully written! ", msg);
                scrollToNewMsg();
            })
            .catch((error) => {
                console.error("Error writing document: ", error);
            });
        }
    }
    function img_sendMsg(url){
        const msg = url.trim();
        if(msg != ""){
            db.collection(collectionPath).add({
                message: msg,
                message_type: 'image',
                sender_id: userToken,
                date_time: new Date()
            })
            .then((docRef) => {
                console.log("Document successfully written! ", msg);
                scrollToNewMsg();
            })
            .catch((error) => {
                console.error("Error writing document: ", error);
            });
        }
    }
    function direct_msg(thiss){
        var element = $(thiss).text();
        const msg = element.trim();
        if(msg != ""){
            db.collection(collectionPath).add({
                message: msg,
                message_type: 'text',
                sender_id: userToken,
                date_time: new Date()
            })
            .then((docRef) => {
                element.value = "";
                console.log("Document successfully written! ", msg);
                scrollToNewMsg();
            })
            .catch((error) => {
                console.error("Error writing document: ", error);
            });
        }
    }
    function scrollToNewMsg(){
        chatBody.scrollTop = chatBody.scrollHeight;
    }
    </script>

    <script for="old scripts">
        // function cancelBooking(order_token) {
        //     isCompleteBooking = (order_token == 0)? true: false;
        //     globalOrderToken = order_token;

        //     var orderServiceCancellationDetail = ``;

        //     var totalServiceCost = 0;//parseInt(curBookingDetail.service_amount);
        //     var totalCancellationFee = 0;
        //     // var airportzo_cancel_fee = parseInt(curBookingDetail.airportzo_cancel_fee);
        //     var airportzo_cancel_fee = curBookingDetail.hasOwnProperty("airportzo_cancel_fee")? parseInt(curBookingDetail.airportzo_cancel_fee): 0;
        //     var cancelServiceCount = 0;

        //     $('#booked-on').text(curBookingDetail.date_time);
        //     curBookingDetail.order_detail.forEach(function(stationObj) {
        //         stationObj.order_detail_array.forEach(function(serviceObj) {
        //             if ((order_token == serviceObj.token || order_token == 0) && serviceObj.status != 'Completed' && serviceObj.status != 'Cancelled') {
        //                 totalServiceCost += parseInt(serviceObj.net_amount);
        //                 cancelServiceCount++;

        //                 var timeDiff = 0;
        //                 var diffCheck = new Date() < new Date(serviceObj.service_date_time_raw);
        //                 if (diffCheck) {
        //                     timeDiff = getHoursDiff(
        //                         new Date(),
        //                         new Date(serviceObj.service_date_time_raw),
        //                     );
        //                 }
                        
        //                 var cancelBefore = 0;
        //                 var cancelFeePerc = 100;
        //                 if (serviceObj.cancellation_policy_detail.length > 0 && timeDiff > 0) {
        //                     serviceObj.cancellation_policy_detail.forEach(function(cancelPolicy) {
        //                         if (timeDiff >= parseInt(cancelPolicy.hours) && cancelBefore < parseInt(cancelPolicy.hours) && cancelFeePerc > parseInt(cancelPolicy.percentage)) {
        //                             cancelBefore = parseInt(cancelPolicy.hours);
        //                             cancelFeePerc = parseInt(cancelPolicy.percentage);
        //                         }
        //                     });
        //                 } else {
        //                     cancelBefore = "-";
        //                 }
        //                 if (cancelBefore != "-") {
        //                     cancelBefore = cancelBefore + " hrs";
        //                 }

        //                 var cancellationFee = cancelFeePerc * (serviceObj.net_amount / 100);
        //                 cancellationFee += airportzo_cancel_fee;
        //                 cancellationFee = (cancellationFee > serviceObj.net_amount)? serviceObj.net_amount: cancellationFee;
        //                 cancellationFee = Math.round(cancellationFee);
        //                 totalCancellationFee += cancellationFee;

        //                 // onclick="cancelBooking('${serviceObj.token}')"
        //                 orderServiceCancellationDetail += `<div class="profile-box-cont1">
        //                     <div class="service-titles">
        //                         <div class="cancel-sp-img">
        //                             <img src="${serviceObj.company_logo}" class="modal-header-logo" alt="logo">
        //                         </div>
        //                         <div class="service-info">
        //                             <h6>${serviceObj.company_name}</h6>
        //                             <p>${stationObj.airport_name}</p>
        //                         </div>
        //                     </div>
        //                     <div class="avail-text">
        //                         <p>Service Avail Date</p>
        //                         <h6 class="service-time">${serviceObj.service_date_time} ${stationObj.gmt_view}</h6>
        //                     </div>
        //                     <div class="cost-text avail-text">
        //                         <p>Service Cost</p>
        //                         <h6>₹ ${serviceObj.net_amount}</h6>
        //                     </div>
        //                     <div class="cancel-text avail-text">
        //                         <p>Cancel Before</p>
        //                         <h6>${cancelBefore}</h6>
        //                     </div>
        //                     <div class="cancelfee-text avail-text">
        //                         <p>Cancellation fee</p>
        //                         <h6>₹ ${cancellationFee}<sup style="cursor: pointer;" title="Incl. of AirportZo cancellation fee of ₹${airportzo_cancel_fee}">*</sup></h6>
        //                     </div>
        //                     <button class="sec-btn cancel__booking-btn" onclick="confirmCancellation('${serviceObj.token}')">Cancel Order
        //                     </button>
        //                     <!-- <div class="status-box">
        //                         <button class="status-btn">Refunded</button>
        //                     </div> -->
        //                 </div>
        //                 <div class="form-divider"></div>`;
        //             }
        //         });
        //     });
        //     totalCancellationFee = Math.round(totalCancellationFee);
        //     var totalRefund = totalServiceCost - totalCancellationFee; // - (cancelServiceCount * airportzo_cancel_fee);
        //     $('#total-service-cost').text(totalServiceCost);
        //     $('#total-cancellation-fee').text(totalCancellationFee);
        //     // $('#airportzo-cancellation-fee').text(airportzo_cancel_fee + "*" + cancelServiceCount);
        //     $('#total-refund').text(totalRefund);
        //     $('#order-service-detail-list').html(orderServiceCancellationDetail);

        //     $('#cancel_booking_modal').modal({
        //         backdrop: 'static',
        //         keyboard: false
        //     });
        // }

        // function getHoursDiff(startDate, endDate) {
        //     const msInHour = 1000 * 60 * 60;

        //     return Math.round(Math.abs(endDate - startDate) / msInHour);
        // }

        // function confirmCancellation(service_token) {
        //     if($('#Policy').is(":checked")) {
        //         var inputData = {};
        //         var serverCallUrl = "";
        //         if ( service_token == '0' ) {
        //             inputData = {
        //                 'booking_token': globalBookingToken
        //             };
        //             serverCallUrl = 'php/users-booking/cancel-booking.php';
        //         } else {
        //             inputData = {
        //                 'booking_token': globalBookingToken,
        //                 'order_detail_token': service_token
        //             };
        //             serverCallUrl = 'php/users-booking/cancel-order.php';
        //         }
        //         // if ( isCompleteBooking ) {
        //         //     inputData = {
        //         //         'booking_token': globalBookingToken
        //         //     };
        //         //     serverCallUrl = 'php/users-booking/cancel-booking.php';
        //         // } else {
        //         //     inputData = {
        //         //         'booking_token': globalBookingToken,
        //         //         'order_detail_token': globalOrderToken
        //         //     };
        //         //     serverCallUrl = 'php/users-booking/cancel-order.php';
        //         // }
        //         inputJSONData = JSON.stringify(inputData);
        //         $.ajax({
        //             async: false,
        //             type: 'POST',
        //             url: serverCallUrl,
        //             data: inputJSONData,
        //             dataType: "JSON",
        //             success: function(response) {
        //                 if (response.status_code == 200) {
        //                     var tempBookingNumber = (isCompleteBooking)? globalBookingNumber: globalBookingNumber + '[' + globalOrderToken + ']';
        //                     $('#cancel-order-id').text(tempBookingNumber);
        //                     $('#cancel_booking_modal').modal('hide');
        //                     $('#cancelled_modal').modal({backdrop: 'static', keyboard: false});
        //                     $('#cancelled_modal').on('hidden.bs.modal', function () {
        //                         location.reload();
        //                     });
        //                 } else {
        //                     swal(response.message);
        //                 }
        //             }
        //         });
        //     } else {
        //         swal({
        //             text: "Please accept terms and conditions !",
        //             icon: "warning",
        //         });
        //     }
        // }

        // Image Viewer from Chat Box
        const imageViewer = document.querySelector('.imageViewer');
        const imageViewerClose = document.querySelector('.viewer-close__icon');
        let uploadedChatImage;
        chatBody.addEventListener('click', function(e) {
            const clickedImgBox = e.target.closest('.attachments_img-box');
            if(clickedImgBox) {
                const chatImage = document.getElementById('chat-image');
                uploadedChatImage = e.srcElement;

                chatImage.src = uploadedChatImage.src;
                imageViewer.style.display = "flex";
            }
        });
        imageViewerClose.addEventListener('click', function() {
            imageViewer.style.display = "none";
        });
    </script>
</body>

</html>