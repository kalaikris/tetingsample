<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Choose Service</title>
    <link rel="shortcut icon" id="favicon-logo">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/my-cart.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <div id="loading"></div>
        <!--LOADER-->
        <nav></nav> <!-- NAV MENU -->
        <section class="breadcrumbs-sec">
            <div class="container-fluid">
                <div class="breadcrumbs-set">
                    <ul class="breadcrumbs">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="javascript:void(0)">Choose Service</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="choose-service-sec">
            <div class="container">
                <div class="multiple-terminal-set">
                    <a href="index.php" class="back-arrow"><img src="asset/choose-service/back-arrow.png" class="back-arrow-icon" alt="back arrow"> back</a>
                    <ul class="nav nav-tabs airport_terminal_tabs"></ul>
                </div>
                <div class="tab-content" id="service-content"></div>
            </div>
        </section>
        <div class="container" id="card_alert">
            <div class="cart-added-alert-set">
                <div class="trolley-desc">
                    <img src="asset/choose-service/cart-trolley-white.svg" class="cart-white-icon" alt="icon">
                    <p><span class="service-id">3 Services</span> in cart</p>
                </div>
                <div class="close-set">
                    <button class="go-to-cart-btn" id="my_cart">Go to cart</button>
                    <img src="asset/choose-service/close-white.svg" class="close-alert hidden" alt="icon">
                </div>
            </div>
        </div>

        <!-- FOOTER SECTION -->
        <footer class="footer"></footer>
    </div>

    <!-- LOGIN MODAL -->
    <div id="login_modal" class="modal fade" role="dialog"></div>

    <div class="modal fade" role="dialog" id="service_desc_cart_popup">
        <div class="service-modal-body">
            <div class="container">
                <div class="service-modal-cust-header">
                    <ul class="product-header-set">
                        <li>
                            <img src="asset/choose-service/service-logo.png" id="modal-company-logo" class="modal-header-logo" alt="logo">
                        </li>
                        <li>
                            <div class="prod-name-rating">
                                <h2 class="modal-company-name">Pranaam</h2>
                                <div class="rating-box hidden">
                                    <img src="asset/choose-service/star-icon.svg" class="star-icon" alt="start icon">
                                    <span class="rating-count">5</span>
                                </div>
                            </div>
                            <p id="modal-station-name">MAA Airport - Terminal 1</p>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="asset/choose-service/close-white.svg" class="close-modal" alt="close icon" data-dismiss="modal">
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="nav nav-tabs ser-ab-review-tab">
                    <li class="active"><a data-toggle="tab" href="#services">Services</a></li>
                    <li><a data-toggle="tab" href="#about" class="">About</a></li>
                    <li><a data-toggle="tab" href="#reviews" class="">Reviews</a></li>
                </ul>
                <div class="tab-content ser-ab-review-tab-container">
                    <div id="services" class="tab-pane fade in active">
                        <div class="service-main-content" id="services1">
                            <div class="overal-box_cont">
                                <div class="portal-cont">
                                    <div class="header-detail-set">
                                        <h2>Passengers</h2>
                                    </div>
                                    <ul class="cart-desc-set">
                                        <li>
                                            <div class="cart-desc-set">
                                                <h2>Adults</h2>
                                                <p>12 years and above</p>
                                            </div>
                                            <div class="cart-add-set">
                                                <button class="cart-btn minus">-</button>
                                                <input type="text" class="cart-input-box" min-value="1" value="1" id="adult-price" readonly>
                                                <button class="cart-btn plus">+</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="cart-desc-set">
                                                <h2>Children</h2>
                                                <p>2-11 years</p>
                                            </div>
                                            <div class="cart-add-set">
                                                <button class="cart-btn minus">-</button>
                                                <input type="text" class="cart-input-box" min-value="0" value="0" id="children-price" readonly>
                                                <button class="cart-btn plus">+</button>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="">
                                        <h4>When do you need the service?</h4>
                                        <p><img src="asset/choose-service/info.svg" alt="">The displayed date and time are on the local timezone of the Airport
                                            location.</p>
                                        <div class="data_time">
                                            <div class="arriving-input-set input-group" id="arrive_date">
                                                <label for="service_date_input" class="input-group-addon bg-date">
                                                </label>
                                                <div class="date_pickers">
                                                    <label for="service_date_input">Flight Date</label>
                                                    <input type="text" class="b-input datepicker" id="service_date_input" placeholder="DD-MMM-YYYY" readonly="">
                                                </div>
                                            </div>
                                            <div class="arriving-input-set input-group" id="arrive_time">
                                                <label for="service_time_input" class="input-group-addon bg-time">
                                                </label>
                                                <div class="arrive_times">
                                                    <label for="arrive_time">Flight Time</label>
                                                    <div>
                                                        <input type="text" class="b-input datepicker" id="service_time_input" placeholder="12:00 AM" readonly=""><label for="service_time_input" class="gmt-view"></label><!-- (GMT+4) -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cancell-card">
                                    <div class="">
                                        <div class="poliec-titles">
                                            <img src="asset/choose-service/info.svg">
                                            <p>Cancellation Policy</p>
                                        </div>
                                        <div class="before-hours-text cancellation-policy-detail"></div>
                                        <div class="poliec-titles1">
                                            <img src="asset/choose-service/info.svg">
                                            <p>Reschedule Policy</p>
                                        </div>
                                        <div class="wish-content">
                                            <p class="reschedule-policy">If you wish to reschedule any of your booked
                                                service, please contact +918610725198 or write
                                                us to support@airportzo.com
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-detail-set">
                                <h2>Packages</h2>
                            </div>
                            <div id="service-package-show"></div>
                            <div id="service-cart-and-next-button"></div>
                            <!-- <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Policy">
                                    <label class="form-check-label " for="Policy">
                                        I agree to <a id="tnc-link" target="_blank">Terms and Conditions</a>, <a id="privacy-policy-link" target="_blank">Privacy Policy</a> and <a id="cancellation-policy-link" target="_blank">Cancellation Policy</a> of <span class="modal-company-name">Parnaam</span>.
                                    </label>
                                </div>
                            </div> -->
                            <!-- <div class="package-added-alert-set ">
                                <button class="pak-add-alert-btn addcart-btn" id="add-to-cart" onclick="addServicesToCart()">Add to cart</button>
                            </div> -->
                        </div>
                        <div class="service-main-content hidden" id="services2">
                            <div class="header-detail-set">
                                <h2>Flowers</h2>
                            </div>
                            <div class="services-product-lists">
                                <div class="services-product-list">
                                    <div class="prod-set">
                                        <img src="asset/choose-service/flower1.jpg" class="product-img" alt="">
                                    </div>
                                    <div class="product-desc-cart">
                                        <p class="product-name">Mixed Tulip Bouquet</p>
                                        <div class="amt-earning">
                                            <span class="product-amt">₹ 350</span>
                                            <span class="h-line">|</span>
                                            <span class="earn-coin-set">
                                                <img src="asset/choose-service/flight-coin.png" class="flight-coin" alt="coin"> Earn <span>2 coins</span>
                                            </span>
                                        </div>
                                        <div class="add-sub-cart-set">
                                            <button class="cart-btn minus">-</button>
                                            <input type="text" class="cart-input-box" id="" value="1" readonly="">
                                            <button class="cart-btn plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="services-product-list">
                                    <div class="prod-set">
                                        <img src="asset/choose-service/flower2.jpg" class="product-img" alt="">
                                    </div>
                                    <div class="product-desc-cart">
                                        <p class="product-name">Red Rose Bouquet</p>
                                        <div class="amt-earning">
                                            <span class="product-amt">₹ 350</span>
                                            <span class="h-line">|</span>
                                            <span class="earn-coin-set">
                                                <img src="asset/choose-service/flight-coin.png" class="flight-coin" alt="coin"> Earn <span>2 coins</span>
                                            </span>
                                        </div>
                                        <div class="add-sub-cart-set">
                                            <button class="cart-btn minus">-</button>
                                            <input type="text" class="cart-input-box" id="" value="1" readonly="">
                                            <button class="cart-btn plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="services-product-list">
                                    <div class="prod-set">
                                        <img src="asset/choose-service/flower3.jpg" class="product-img" alt="">
                                    </div>
                                    <div class="product-desc-cart">
                                        <p class="product-name">Yellow Rose Bouquet</p>
                                        <div class="amt-earning">
                                            <span class="product-amt">₹ 350</span>
                                            <span class="h-line">|</span>
                                            <span class="earn-coin-set">
                                                <img src="asset/choose-service/flight-coin.png" class="flight-coin" alt="coin"> Earn <span>2 coins</span>
                                            </span>
                                        </div>
                                        <div class="add-sub-cart-set">
                                            <button class="cart-btn minus">-</button>
                                            <input type="text" class="cart-input-box" id="" value="1" readonly="">
                                            <button class="cart-btn plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="services-product-list">
                                    <div class="prod-set">
                                        <img src="asset/choose-service/flower4.jpg" class="product-img" alt="">
                                    </div>
                                    <div class="product-desc-cart">
                                        <p class="product-name">Purple Orchid Bouquet</p>
                                        <div class="amt-earning">
                                            <span class="product-amt">₹ 350</span>
                                            <!-- <span class="h-line">|</span>
                                            <span class="earn-coin-set">
                                                <img src="asset/choose-service/flight-coin.png" class="flight-coin" alt="coin"> Earn <span>2 coins</span>
                                            </span> -->
                                        </div>
                                        <div class="add-sub-cart-set">
                                            <button class="cart-btn minus">-</button>
                                            <input type="text" class="cart-input-box" id="" value="1" readonly="">
                                            <button class="cart-btn plus">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="check-t-c-set">
                                <input type="checkbox" class="input-check-t-c">
                                <p>I agree to the <a href="javascript:void(0)">Terms and Conditions</a>, <a href="javascript:void(0)">Privacy Policy</a> of the service provider</p>
                            </div>
                            <div class="add-cart-btn-set">
                                <button class="addcart-btn-bg addcart-btn">Add to Cart</button>
                            </div> -->
                        </div>
                    </div>
                    <div id="about" class="tab-pane fade">
                        <div class="about-main-content">
                            <p class="about-desc-text" id="service-description">With a mission of “making travel better”, Plaza Premium Group is
                                a pioneer and the market leader in airport hospitality services with an international
                                footprint of over 180 locations across 49 airports in 25 countries and regions, serving
                                20 million travellers annually.</p>

                            <div class="header-detail-set" id="service-about-photos-div">
                                <h2>Photos</h2>
                                <div class="sample-img-set" id="service-about-photos"></div>
                            </div>
                            
                            <div class="header-detail-set" id="service-about-amenities-div">
                                <h2>Amenities</h2>
                                <div class="amenities-lists" id="service-about-amenities"></div>
                            </div>
                            
                            <div class="cancell-card">
                                <div class="">
                                    <div class="poliec-titles">
                                        <img src="asset/choose-service/info.svg">
                                        <p>Cancellation Policy</p>
                                    </div>
                                    <div class="before-hours-text cancellation-policy-detail">
                                        <ul class="refer-text">
                                            <li>48 hours before</li>
                                            <li>24 hours before</li>
                                            <li>After 12 hours</li>
                                        </ul>
                                        <ul class="refund-list">
                                            <li>- Full Refund</li>
                                            <li>- 25% of fare</li>
                                            <li>- No Refund</li>
                                        </ul>
                                    </div>
                                    <div class="poliec-titles1">
                                        <img src="asset/choose-service/info.svg">
                                        <p>Reschedule Policy</p>
                                    </div>
                                    <div class="wish-content">
                                        <p class="reschedule-policy">If you wish to reschedule any of your booked
                                            service, please contact +918610725198 or write
                                            us to support@airportzo.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="reviews" class="tab-pane fade">
                        <div class="reviews-main-content" id="service-review-list">
                            <div class="feedback-set">
                                <div class="review-header">
                                    <ul>
                                        <li>
                                            <div class="profile-img-set">
                                                <img src="asset/choose-service/profile-pic.png" class="profile-img" alt="">
                                            </div>
                                            <div class="profile-name-star">
                                                <h2>Douglas Warren</h2>
                                                <div class="star-rating">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="msg-date-set">
                                                <p>18 Jun, 2022</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="feedback-text">
                                    <p>I am writing this after my second booking experience with Pranaam. The staffas
                                        are so polite and make us more comfortable. Highly qualified professionals with
                                        great respect towards the passengers. I highly recommend this service.</p>
                                </div>
                            </div>
                            <div class="feedback-set">
                                <div class="review-header">
                                    <ul>
                                        <li>
                                            <div class="profile-img-set">
                                                <img src="asset/choose-service/profile-pic.png" class="profile-img" alt="">
                                            </div>
                                            <div class="profile-name-star">
                                                <h2>Eula Watts</h2>
                                                <div class="star-rating">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="msg-date-set">
                                                <p>17 Jun, 2022</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="feedback-text">
                                    <p>My parents had a transit via Dubai and we booked Marhaba transfer service. The
                                        Agent was really helpful and the transfer process went really smooth. would
                                        recommend them :)</p>
                                </div>
                            </div>
                            <div class="feedback-set">
                                <div class="review-header">
                                    <ul>
                                        <li>
                                            <div class="profile-img-set">
                                                <img src="asset/choose-service/profile-pic.png" class="profile-img" alt="">
                                            </div>
                                            <div class="profile-name-star">
                                                <h2>John Gordon</h2>
                                                <div class="star-rating">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="msg-date-set">
                                                <p>18 Jun, 2022</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="feedback-text">
                                    <p>Because of the late arrival of my flight I had booked the silver service to avoid
                                        long queues at immigration in Terminal 1. When I arrived during the evening rush
                                        hour from Amsterdam, a representative from Marhaba was waiting for me at the
                                        gate. He brought me and another passenger from the same flight with a buggy car
                                        to the sky train and escorted us further to the fast track immigration and the
                                        baggage belt. The transport with the buggy car was a godsend because it would
                                        have been a long walk from the gate to the sky train. </p>
                                </div>
                            </div>
                            <div class="feedback-set">
                                <div class="review-header">
                                    <ul>
                                        <li>
                                            <div class="profile-img-set">
                                                <img src="asset/choose-service/profile-pic.png" class="profile-img" alt="">
                                            </div>
                                            <div class="profile-name-star">
                                                <h2>Eunice Brooks</h2>
                                                <div class="star-rating">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">
                                                    <img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="msg-date-set">
                                                <p>18 Jun, 2022</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="feedback-text">
                                    <p>My parents had a transit via Dubai and we booked Marhaba transfer service. The Agent was really helpful and the transfer process went really smooth. would recommend them :)</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    
    <script>
        var today = new Date();
        var nextDay = new Date(today);
        if (backendBooking != true) nextDay.setDate(today.getDate() + 1);
        // nextDay.setDate(today.getDate() + 1);
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var dd = String(nextDay.getDate()).padStart(2, '0');
        var mm = nextDay.getMonth();
        var yyyy = nextDay.getFullYear();
        nextDay = dd + '-' + monthNames[mm] + '-' + yyyy;

        var current = new Date();
        var currentHours = (current.getHours() == 24)? current.getHours(): (current.getHours() + 1);
        // var calHours = currentHours + ':00 '; // add GMT time to local time
        var AMPM = "AM";
        if (currentHours > 12) {
            AMPM = "PM";
            currentHours = currentHours - 12;
        }
        currentHours = (currentHours > 9)? currentHours: '0' + currentHours;
        var timeNow = currentHours + ':00 ' + AMPM;


        // //stat--->adding normal time with gmt time
        // // Convert a time in hh:mm format to minutes
        // function timeToMins(time) {
        //     var b = time.split(':');
        //     return b[0]*60 + +b[1];
        // }

        // // Convert minutes to a time in format hh:mm
        // // Returned value is in range 00  to 24 hrs
        // function timeFromMins(mins) {
        //     function z(n){return (n<10? '0':'') + n;}
        //     var h = (mins/60 |0) % 24;
        //     var m = mins % 60;
        //     return z(h) + ':' + z(m);
        // }

        // function addTimes(t0, t1) {
        //     return timeFromMins(timeToMins(t0) + timeToMins(t1));
        // }
        // function subTimes(t0, t1) {
        //     return timeFromMins(timeToMins(t0) - timeToMins(t1));
        // }
        //  //end--->adding normal time with gmt time

        var globalStationData = [];
        var journeyArray = [];
        var selectedDataIndex = -1;
        var selectedDataServiceIndex = -1;
        var selectedDataCollectionIndex = -1;
        
        //DATEPICKER
        $(function () {
            $('#service_date_input').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MMM-YYYY'
            });
            $('#service_date_input').val(nextDay);
            $('#service_date_input').data("DateTimePicker").minDate(nextDay);
            $('#service_time_input').datetimepicker({
                ignoreReadonly: true,
                format: 'LT'
            });
            
            $('.multiple-terminal-nav-lit').on('click', function () {
                $('.multiple-terminal-nav-lit').removeClass('completed arriving');
                $(this).addClass('completed');
                $(this).next().addClass('arriving')
            });
        });
        
        $(document).ready(function () {
            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var minValue = parseInt($input.attr("min-value"));
                var count = parseInt($input.val()) - 1;
                count = count <= minValue ? minValue : count;
                $input.val(count);
                $input.change();
                evalPrice();
                if ($('#add-to-cart').text() == 'Remove from cart') {
                    removeFromCart();
                    addServicesToCart();
                }
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                evalPrice();
                if ($('#add-to-cart').text() == 'Remove from cart') {
                    removeFromCart();
                    addServicesToCart();
                }
                return false;
            });
            
            $('.airport_terminal_tabs').empty();
            $('#service-content').empty();

            journeyArray = JSON.parse(sessionStorage.getItem("jsonJourney"));
            
            // console.log(sessionStorage.getItem("jsonInput"));
            var jsonServiceData = sessionStorage.getItem("jsonServiceData");
            if (jsonServiceData && jsonServiceData!='') {
                globalStationData = JSON.parse(jsonServiceData);
                populateData();
            } else {
                var inputData = JSON.parse(sessionStorage.getItem("jsonInput"));
                if (inputData && inputData != '') {
                    inputData = JSON.stringify(inputData);
                    $.ajax({
                        async: false,
                        url: 'php/services/read-for-journeys.php',
                        data: inputData,
                        type: 'POST',
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.status_code == 200) {
                                var responseData = response.data;
                                globalStationData = responseData.station_array;
                                populateData();
                            } else {
                                swal("", response.message, "warning")
                                .then(function() {
                                    window.location.href = "index.php";
                                });
                            }
                        }
                    });
                } else {
                    swal("", "No search found !", "warning")
                    .then(function() {
                        window.location.href = "index.php";
                    });
                }
            }
        });

        function populateData() {
            // var gmtTime=''; // add GMT time to local time
            globalStationData.forEach(function(stationData, stationKey) {
                var activeness = (stationKey == 0)? 'active': '';
                var service_data_activeness = (stationKey == 0)? 'in active': '';

                var journeyTime = "";
                if (stationData.hasOwnProperty('journey_time')) {
                    journeyTime = stationData.journey_time;
                } else {
                    // gmtTime =  stationData.gmt_view.substr(5);
                    // gmtTimeOperator =  stationData.gmt_view.substr(4, 1);
                    // if(gmtTimeOperator == '+'){
                    //     travelTime = addTimes(calHours, gmtTime);
                    //     var amrpm = "AM";
                    //     var hou = travelTime.split(':');
                    //     if (hou[0] > 12) {
                    //         amrpm = "PM";
                    //         var hour = hou[0] - 12;
                    //     }
                    //     hour = (hour > 9)? hour: hou[0];
                    //     var newTravelTime = hour +':'+ hou[1] + amrpm;
                    // }else{
                    //     travelTime = subTimes(calHours, gmtTime);
                    //     var amrpm = "AM";
                    //     var hou = travelTime.split(':');
                    //     if (hou[0] > 12) {
                    //         amrpm = "PM";
                    //        var hour = hou[0] - 12;
                    //     }
                    //     hour = (hour > 9)? hour: hou[0];
                    //     var newTravelTime = hour +':'+ hou[1] + amrpm;
                    // }
                   
                    stationData.journey_time = (stationData.journey_date == nextDay)? timeNow: "12:00 AM";
                    // stationData.journey_time = (stationData.journey_date == nextDay)? newTravelTime: "12:00 AM"; // add GMT time to local time
                }

                var journeyTime = (stationData.serviceCount > 0)? stationData.journey_time: "";
                var gmtView = stationData.gmt_view;
                gmtView = (gmtView && gmtView!='')? '(GMT ' + gmtView + ')': ''; //, 16:30 PM ${gmtView} //${stationData.journey_date}

                var bundleView = '';
                var serviceView = '';
                stationData.service_collection.forEach(function(serviceColData, serviceColKey) {
                    if (serviceColData.service_type == "Bundle") {
                        bundleView += `<div class="bundled_packages">
                            <div class="packages-boxs">
                                <div class="services_text">
                                    <h4>Bundled packages at your convenience</h4>
                                    <p>Book multiple services bundled at an affordable cost.</p>
                                </div>
                            </div>
                            <div class="cards-contents">`;
                        serviceColData.service_group.forEach(function(serviceGrpData, serviceGrpKey) {
                            var packageServiceList = '';
                            serviceGrpData.business_names.forEach(function(tempService, tempServiceKey) {
                                if(tempServiceKey < 2 || serviceGrpData.business_names.length == 3) packageServiceList += `<li>${tempService}</li>`;
                            });
                            if (serviceGrpData.business_names.length > 3) {
                                packageServiceList += `<li>+ ${(serviceGrpData.business_names.length - 2)} services</li>`;
                            }

                            let company_logo = (serviceGrpData.sp_company_logo != '')? serviceGrpData.sp_company_logo: 'asset/choose-service/service-logo.png';
                            var hasService = ``;
                            serviceGrpData.service_array.forEach(function (tempServ) {
                                if (tempServ.isSelected) hasService = `has-service`;
                            });
                            bundleView += `<div class="card-boxs ${hasService}" id="service-${stationKey}-${serviceColKey}-${serviceGrpKey}">
                                    <div class="text_conts">
                                        <div class="left-service-logo">
                                            <img src="${company_logo}">
                                        </div>
                                        <div class="services-desc-set">
                                            <p>${serviceGrpData.sp_company_name}</p>
                                            <div class="rating-box" style="display: none;">
                                                <img src="asset/choose-service/star-icon.svg" class="star-icon" alt="start icon">
                                                <span class="rating-count">5</span>
                                            </div>
                                        </div>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="tick-solid" d="M8 0C3.58125 0 0 3.58125 0 8C0 12.4187 3.58125 16 8 16C12.4187 16 16 12.4187 16 8C16 3.58125 12.4187 0 8 0ZM11.6187 6.61875L7.61875 10.6187C7.44688 10.7906 7.225 10.875 7 10.875C6.775 10.875 6.55188 10.79 6.38094 10.6191L4.38094 8.61913C4.04 8.27725 4.04 7.72256 4.38094 7.38069C4.72281 7.03881 5.2775 7.03881 5.61938 7.38069L7 8.7625L10.3813 5.38125C10.7231 5.03937 11.2778 5.03937 11.6197 5.38125C11.9594 5.72187 11.9594 6.27813 11.6187 6.61875Z" fill="black"/></svg>
                                    </div>
                                    <div class="list_content">
                                        <ul>
                                            ${packageServiceList}
                                        </ul>
                                    </div>
                                    <div class="price_text">
                                        <div class="starts_text">
                                            <p>Package starts at</p>
                                            <h4>₹${serviceGrpData.minimum_price}</h4>
                                        </div>
                                        <div class="package_title">
                                            <h4 class="view-service-detail" data-index="${stationKey}" data-service-index="${serviceColKey}" data-collection-index="${serviceGrpKey}" style="cursor: pointer;">VIEW PACKAGE</h4>
                                        </div>
                                    </div>
                                </div>`;
                        });
                        bundleView += `</div>
                        </div>`;
                    } else {
                        serviceView += `<div class="available-service">
                                <div class="services-box">
                                    <h2>${serviceColData.title}</h2>
                                    <ul class="service-lists">`;
                                serviceColData.service_group.forEach(function(serviceGrpObj, serviceGrpKey) {
                                    var hasService = ``;
                                    serviceGrpObj.service_array.forEach(function (tempServ) {
                                        if (tempServ.isSelected) hasService = `has-service`;
                                    });
                                    
                                    let company_logo = (serviceGrpObj.sp_company_logo != '')? serviceGrpObj.sp_company_logo: 'asset/choose-service/service-logo.png';
                                    let company_image = (serviceGrpObj.sp_company_image != '')? serviceGrpObj.sp_company_image: 'asset/choose-service/service-poster1.jpg';
                                    serviceView += `<li class="service-list view-service-detail ${hasService}" data-index="${stationKey}" data-service-index="${serviceColKey}" data-collection-index="${serviceGrpKey}"  id="service-${stationKey}-${serviceColKey}-${serviceGrpKey}">
                                        <div class="service-poster-set">
                                            <img src="${company_image}" class="ser-poster-img" alt="service poster">
                                            <img src="${company_logo}" class="company-logo" alt="logo">
                                        </div>
                                        <div class="service-desc-set">
                                            <p class="package-name-set"><span>${serviceGrpObj.sp_company_name}</span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="tick-solid " d="M8 0C3.58125 0 0 3.58125 0 8C0 12.4187 3.58125 16 8 16C12.4187 16 16 12.4187 16 8C16 3.58125 12.4187 0 8 0ZM11.6187 6.61875L7.61875 10.6187C7.44688 10.7906 7.225 10.875 7 10.875C6.775 10.875 6.55188 10.79 6.38094 10.6191L4.38094 8.61913C4.04 8.27725 4.04 7.72256 4.38094 7.38069C4.72281 7.03881 5.2775 7.03881 5.61938 7.38069L7 8.7625L10.3813 5.38125C10.7231 5.03937 11.2778 5.03937 11.6197 5.38125C11.9594 5.72187 11.9594 6.27813 11.6187 6.61875Z" fill="black"/></svg></p>
                                            <div class="rating-box" style="display: none;">
                                                <img src="asset/choose-service/star-icon.svg" class="star-icon" alt="start icon">
                                                <span class="rating-count">5</span>
                                            </div>
                                        </div>
                                    </li>`;
                                });
                        serviceView += `</ul>
                            </div>`;
                        // serviceView += `<div class="nex-arrow-sticky">
                        //         <a class="nex-arrow-set">
                        //             <img src="asset/choose-service/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        //         </a>
                        //     </div>`;
                        serviceView += `</div>`;
                    }
                });
                
                // var gmtView = (stationData.gmt_view!='')? ' (GMT ' + stationData.gmt_view + ')': '';
                // var serviceTime = (stationKey < journeyArray.length)? `<p>Services available on <span>${journeyArray[stationKey].departure_date}${gmtView}</span> at </p>`: `<p>Services available after <span>${journeyArray[stationKey-1].departure_date}${gmtView}</span> at </p>`;

                $('.airport_terminal_tabs').append(`<li id="tab-station-${stationKey}" class="${activeness}">
                    <div class="cart-list" data-toggle="tab" href="#terminal${stationKey}">
                        <div class="cart-title-set">
                            <h2>${stationData.airport_code}</h2>
                            <img class="card-flight-icon" src="asset/home/flight-white.svg" alt="flight icon">
                        </div>
                        <p class="terminal_name">${stationData.airport_name} - ${stationData.terminal_name}</p>
                        <p class="service_date_time"><span class="flight-date-${stationKey}">${stationData.journey_date}</span> <span class="flight-time-${stationKey}">${journeyTime}</span><br/>(${stationData.gmt_view})</p>
                    </div>
                </li>`);
                $('#service-content').append(`<div id="terminal${stationKey}" class="tab-pane fade ${service_data_activeness}">
                    <div class="choose-ser-header">
                        <p>Services available on <span class="flight-date-${stationKey}">${stationData.journey_date}</span> <span class="flight-time-${stationKey}">${journeyTime}</span>(${stationData.gmt_view}) at </p>
                        <h2>
                            ${stationData.airport_code}
                            <span>(${stationData.city_name})</span>
                            <img src="asset/choose-service/edit-icon.svg" class="edit-icon hidden" alt="edit icon">
                        </h2>
                        <p class="terminal_name">${stationData.airport_name} - ${stationData.terminal_name}</p>
                    </div>
                    ${bundleView}
                    ${serviceView}
                </div>`); //- ${stationData.terminal_name}
            });
            
            $('.airport_terminal_tabs:first-child').trigger('click');
            $('.view-service-detail').on('click', function () {
                var selectedServiceCount = 0;

                var dataIndex = $(this).attr('data-index');
                var dataServiceIndex = $(this).attr('data-service-index');
                var dataCollectionIndex = $(this).attr('data-collection-index');
                selectedDataIndex = dataIndex;
                selectedDataServiceIndex = dataServiceIndex;
                selectedDataCollectionIndex = dataCollectionIndex;

                var journeyDate = globalStationData[dataIndex].journey_date;
                var journeyTime = globalStationData[dataIndex].journey_time;

                $('#service_date_input').val(journeyDate);
                $('#service_time_input').val(journeyTime);
                
                var gmtView = globalStationData[dataIndex].gmt_view;
                gmtView = (gmtView && gmtView!='')? '(' + gmtView + ')': '';
                document.querySelector('.gmt-view').textContent = gmtView;

                var serviceType = globalStationData[dataIndex].service_collection[dataServiceIndex].service_type;
                var serviceHeader = (serviceType == 'Bundle')? 'Packages': 'Services';
                $('#services1>.header-detail-set>h2').html(serviceHeader);

                $('#service-package-show').empty();
                var serviceGrpData = globalStationData[dataIndex].service_collection[dataServiceIndex].service_group[dataCollectionIndex];
                var selectedAdultCount = (serviceGrpData.adult_count)? serviceGrpData.adult_count: 1;
                var selectedChildrenCount = (serviceGrpData.children_count)? serviceGrpData.children_count: 0;
                $('#adult-price').val(selectedAdultCount);
                $('#children-price').val(selectedChildrenCount);

                var company_name = serviceGrpData.sp_company_name;
                var company_logo = (serviceGrpData.sp_company_logo != '')? serviceGrpData.sp_company_logo: 'asset/choose-service/service-logo.png';
                var station_name = globalStationData[dataIndex].airport_name + ' - ' + globalStationData[dataIndex].terminal_name;
                $('.modal-company-name').text(company_name);
                $('#modal-company-logo').attr('src', company_logo);
                $('#modal-station-name').text(station_name);
                
                var reschedulePolicy = serviceGrpData.reschedule_policy;
                reschedulePolicy = (reschedulePolicy != '' && reschedulePolicy)? reschedulePolicy: '-';
                $('.reschedule-policy').text(reschedulePolicy);
                
                serviceGrpData.service_array.forEach(function(serviceObj, serviceKey) {
                    var tempAdultCount = (serviceObj.adult_count)? serviceObj.adult_count: 1;
                    var tempChildCount = (serviceObj.children_count)? serviceObj.children_count: 0;
                    $('#adult-price').val(tempAdultCount);
                    $('#children-price').val(tempChildCount);

                    var cartStatus = '';
                    var cartAdder = '';
                    var serviceType = (serviceObj.service_type == 'Bundle')? 'Package': 'Service';
                    var isSelected = (serviceObj.hasOwnProperty)? serviceObj.isSelected: false;
                    if (isSelected) {
                        selectedServiceCount++;
                        cartStatus = 'sec-btn';
                        cartAdder = 'Remove ' + serviceType;
                    } else {
                        var serviceTime = (nextDay == journeyDate)? timeNow: "12:00 AM";
                        serviceObj.service_date = journeyDate;
                        serviceObj.service_time = serviceTime;
                        // $('#service_date_input').val(journeyDate);
                        // $('#service_time_input').val(serviceTime);
                        cartStatus = 'addcart';
                        cartAdder = 'Choose ' + serviceType;
                    }

                    var adultPricing = ``;
                    var childPricing = ``;
                    if (serviceObj.additional_price_adult > 0) {
                        adultPricing = `<p>₹ ${serviceObj.price_adult} for 1st adult and ${serviceObj.additional_price_adult} for each additional adult(s)</p>`;
                    } else {
                        adultPricing = `<p>₹ ${serviceObj.price_adult} per adult</p>`;
                    }
                    if (serviceObj.additional_price_children > 0) {
                        childPricing = `<p>₹ ${serviceObj.price_children} for 1st child and ${serviceObj.additional_price_children} for each additional child(ren)</p>`;
                    } else {
                        childPricing = `<p>₹ ${serviceObj.price_children} per child</p>`;
                    }
                    
                    // $('#service_date_input').val(serviceObj.service_date);
                    // $('#service_time_input').val(serviceObj.service_time);
                    
                    var packageBoxView = `<div class="packages-box">
                        <div class="package-header">
                            <div class="service-contnts">
                                <h2>${serviceObj.service_name}</h2>
                                
                            </div>
                            <div class="package-type-set">
                                <div class="package-price-coin-set">
                                    ${adultPricing}
                                    <span class="division">|</span>
                                    ${childPricing}
                                </div>
                                <div class="price-set">
                                    <p>₹ <span class="net-price" data-price-adult="${serviceObj.price_adult}" data-price-children="${serviceObj.price_children}" data-price-add-on-adult="${serviceObj.additional_price_adult}" data-price-add-on-children="${serviceObj.additional_price_children}">${serviceObj.price_adult}</p>
                                </div>
                            </div>
                            <div class="note-underline"></div>`;
                        // if (serviceObj.service_type == 'Bundle') {
                            packageBoxView += `<p class="package__sub-head">Service(s) included :</p>
                            <div class="box-check">`;
                            serviceObj.business_names.forEach(function(serviceItem) {
                                packageBoxView += `<div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked readonly>
                                    <label class="form-check-label">
                                        ${serviceItem}
                                    </label>
                                </div>`;
                            });
                            packageBoxView += `</div>`;
                        // }
                            packageBoxView += `<p class="package__sub-head">Features:</p>
                            <ul class="pak-note-lists">`;
                            serviceObj.service_features.forEach(function(featureData) {
                                packageBoxView += `<li class="pak-note-list">
                                    <p>${featureData}</p>
                                </li>`;
                            });
                            packageBoxView += `</ul>
                            <div class="view-add-cart-set">
                                <a href="javascript:void(0)" style="visibility: hidden;">View more</a>
                                <button class="package-chooser ${cartStatus}" id="package-toggler-${serviceKey}" onclick="choosePackage(${serviceKey})">${cartAdder}</button>
                            </div>
                        </div>
                    </div>`;
                    $('#service-package-show').append(packageBoxView);
                    
                    

                    var cancellationPolicyTime = '';
                    var cancellationPolicyRefund = '';
                    var minHours = 0;
                    serviceGrpData.cancellation_policy_detail.forEach(function(cancelObj) {
                        minHours = (cancelObj.hours < minHours || minHours == 0)? cancelObj.hours: minHours;
                        cancellationPolicyTime += ` <li>${cancelObj.hours} hours before</li>`;
                        if (cancelObj.percentage == 100) {
                            cancellationPolicyRefund += `<li>- No Refund</li>`;
                        } else if (cancelObj.percentage == 0) {
                            cancellationPolicyRefund += `<li>- Full Refund</li>`;
                        } else {
                            cancellationPolicyRefund += `<li>- ${(100 - parseInt(cancelObj.percentage))}% Refund</li>`;
                        }
                    });
                    if (minHours > 0) {
                        cancellationPolicyTime += ` <li>After ${minHours} hours</li>`;
                        cancellationPolicyRefund += `<li>- No Refund</li>`;
                    }

                    var cancellationPolicyDetail = '';
                    if (cancellationPolicyTime != '') {
                        cancellationPolicyDetail = `<ul class="refer-text">
                            ${cancellationPolicyTime}
                        </ul>
                        <ul class="refund-list">
                            ${cancellationPolicyRefund}
                        </ul>`;
                    } else {
                        cancellationPolicyDetail = `-`;
                    }
                    $('.cancellation-policy-detail').html(cancellationPolicyDetail);
                    
                });
                $('#service-cart-and-next-button').html("");
                 var addCartNNextButton = `<div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Policy">
                            <label class="form-check-label " for="Policy">
                                I agree to <a id="tnc-link" target="_blank">Terms and Conditions</a>, <a id="privacy-policy-link" target="_blank">Privacy Policy</a> and <a id="cancellation-policy-link" target="_blank">Cancellation Policy</a> of <span>${company_name}</span>.
                            </label>
                        </div>
                    </div>
                    <div class="package-added-alert-set">
                        <button class="pak-add-alert-btn addcart-btn" id="add-to-cart" onclick="addServicesToCart()">Add to cart</button>
                        <button class="checkout-btn sec-btn hidden" id="checkout_btn">Go To Checkout</button>
                        <button class="go-to-next-station-${dataIndex} pak-add-alert-btn" onclick="goToNextSTation(${dataIndex})">Go To Next Station</button>
                    </div>`;
                    $('#service-cart-and-next-button').append(addCartNNextButton);
                    
                    
                    // terms,privacy,cancellation link
                    $('#tnc-link').attr('href', serviceGrpData.terms_conditions);
                    $('#privacy-policy-link').attr('href', serviceGrpData.privacy_policy);
                    $('#cancellation-policy-link').attr('href', serviceGrpData.cancellation_policy);
                    if(globalStationData[dataIndex].category_name=='Arrival'){
                        $('.go-to-next-station-'+dataIndex).addClass('hidden');
                    }
                    
                    evalPrice(); 
                

                var previousServicekey;
                for(i=0;i< globalStationData.length;i++){
                    if(globalStationData[i].service_collection.length > 0){
                        if(i > previousServicekey){
                            $('.go-to-next-station-'+previousServicekey).removeClass('hidden');
                        }
                        previousServicekey = i;
                    }else{
                        if(i > previousServicekey){
                             $('.go-to-next-station-'+previousServicekey).addClass('hidden');
                        }
                    }
                }

                if (selectedServiceCount > 0) {
                    $('#Policy').prop('checked', true);
                    $('#add-to-cart').removeClass('pak-add-alert-btn');
                    $('#add-to-cart').addClass('sec-btn');
                    $('#add-to-cart').text('Remove from cart');
                    $('#add-to-cart').attr('onclick', 'removeFromCart()');
                } else {
                    $('#Policy').prop('checked', false);
                    $('#add-to-cart').addClass('pak-add-alert-btn');
                    $('#add-to-cart').removeClass('sec-btn');
                    $('#add-to-cart').text('Add to cart');
                    $('#add-to-cart').attr('onclick', 'addServicesToCart()');
                }

                // For about tab
                $('#service-description').text(serviceGrpData.description);

                $('#service-about-photos').empty();
                if (serviceGrpData.photos.length > 0) {
                    serviceGrpData.photos.forEach(photosElement => {
                        $('#service-about-photos').append(`<div class="sample-img-innerset">
                            <img src="${photosElement}" class="sample-img" alt="img">
                        </div>`);
                    });
                    $('#service-about-photos-div').css('display', 'block');
                } else {
                    $('#service-about-photos-div').css('display', 'none');
                }

                $('#service-about-amenities').empty();
                if (serviceGrpData.amenities.length > 0) {
                    serviceGrpData.amenities.forEach(amenitiesElement => {
                        $('#service-about-amenities').append(`<div class="amenities-list">
                            <img src="${amenitiesElement.image}" alt="${amenitiesElement.name}" class="amenity-icon" alt="icon">
                            <p>${amenitiesElement.name}</p>
                        </div>`);
                    });
                    $('#service-about-amenities-div').css('display', 'block');
                } else {
                    $('#service-about-amenities-div').css('display', 'none');
                }

                // For reviews tab
                $('#service-review-list').empty();
                if (serviceGrpData.reviews.length > 0) {
                    serviceGrpData.reviews.forEach((reviewElement,index) => {
                        var reviewContent = "";
                        reviewContent+=`<div class="feedback-set">
                            <div class="review-header">
                                <ul>
                                    <li>
                                        <div class="profile-img-set">
                                            <img src="${reviewElement.image}" class="profile-img" alt="" onerror="this.onerror=null;this.src='https://placeimg.com/200/300/animals';">
                                        </div>
                                        <div class="profile-name-star">
                                            <h2>${reviewElement.name}</h2>
                                            <div class="star-rating">`;
                                            for(let index = 1; index<=5; index++) {
                                                if(index <= reviewElement.rating){
                                                    reviewContent+=`<img src="asset/choose-service/star-icon-yellow.svg" class="star-icon" alt="star">`;
                                                } else {
                                                    reviewContent+=`<img src="asset/choose-service/star-icon-gray.svg" class="star-icon" alt="star">`;
                                                }
                                            }
                                            reviewContent+=`</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="msg-date-set">
                                            <p>${reviewElement.review_date_time}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="feedback-text">
                                <p>${reviewElement.review}</p>
                            </div>`;
                            if(reviewElement.comment!=''){
                                reviewContent+=`<div class="comment-box${index} hidden">
                                    <p class="comment-date">${reviewElement.comment_date_time}</p>
                                    <p>${reviewElement.comment}</p>
                                </div><p class="comment-btn" id="${index}" data-open="true">1 comment</p></div>`;
                            }
                        $('#service-review-list').append(reviewContent);
                    });
                    $('p.comment-btn').click(function(){
                        var idName = this.id;
                        if ($(this).attr("data-open") == "true") {
                            $(this).attr("data-open", "false");
                            this.textContent = "Hide comment";
                        } else {
                            $(this).attr("data-open", "true");
                            this.textContent = "1 comment";
                        }
                        $('.comment-box'+idName).toggleClass('hidden');
                    });
                } else {
                    $('#service-review-list').append(`<div class="feedback-set">
                            <div class="feedback-text">
                                <p>No review found yet !</p>
                            </div>
                        </div>`);
                }

                
                $('#service_desc_cart_popup').modal('show');
                setTimeout(() => {
                    $('.ser-ab-review-tab-container').scrollTop(0);
                }, 200)
                $('.ser-ab-review-tab > li:first-child a').click();
                
            });
            refreshStationClass();
        }

        function goToNextSTation(stationKey){
            nextStation = stationKey+1;
            for(i=nextStation;i<= globalStationData.length;i++){
                if(globalStationData[i].service_collection.length > 0){ 
                    $('#tab-station-' + stationKey).removeClass('active');
                    $('#tab-station-' + i).addClass('active');
                    $('#terminal'+stationKey).removeClass('active in');
                    $('#terminal'+i).addClass('active in');
                    $('#service_desc_cart_popup').modal('hide');
                    return;
                }
            }
        }

        function choosePackage(key) {
            var collectionData = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key];
            var serviceType = (collectionData.service_type == 'Bundle')? 'Package': 'Service';
            if($('#package-toggler-' + key).hasClass('addcart')) {
                var serviceDate = $('#service_date_input').val();
                var serviceTime = $('#service_time_input').val();

                if (serviceDate && serviceDate != '' && serviceTime && serviceTime != '') {
                    var adultCount = parseInt($('#adult-price').val());
                    var childrenCount = parseInt($('#children-price').val());

                    if (adultCount > 0 || childrenCount > 0) {
                        $('#package-toggler-' + key).addClass('sec-btn');
                        $('#package-toggler-' + key).removeClass('addcart');
                        $('#package-toggler-' + key).html('Remove ' + serviceType);

                        globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].hadChosen = true;
                    } else {
                        swal({
                            text: "Service should have atleast 1 person !",
                            icon: "warning",
                        });
                    }
                } else {
                    swal({
                        text: "Please select flight date & time !",
                        icon: "info",
                    });
                }
            } else {
                $('#package-toggler-' + key).removeClass('sec-btn');
                $('#package-toggler-' + key).addClass('addcart');
                $('#package-toggler-' + key).html('Choose ' + serviceType);
                globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].hadChosen = false;
            }
        }

        function addServicesToCart() {
            var collectionData = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex];//.service_array[key];
            var serviceType = (collectionData.service_type == 'Bundle')? 'Package': 'Service';
            var serviceDate = $('#service_date_input').val();
            var serviceTime = $('#service_time_input').val();
            if (serviceDate && serviceDate != '' && serviceTime && serviceTime != '') {
                var serviceFullDate = (serviceDate + ' ' + serviceTime).replaceAll('-', '/');
                var parsedServiceTime = new Date(serviceFullDate);
                var parsedCurrentTime = new Date();
                var timeDiff = (parsedServiceTime.getTime() - parsedCurrentTime.getTime()) / 3600000;
                if (Math.floor(timeDiff) >= 24 || backendBooking == true) {
                    var isAfterPrev = false;
                    if (selectedDataIndex == 0) {
                        isAfterPrev = true;
                    } else {
                        var prevDate = (globalStationData[selectedDataIndex-1].journey_date).replaceAll('-', '/');
                        prevDate = globalStationData[selectedDataIndex-1].hasOwnProperty('journey_time')? prevDate + ' ' + globalStationData[selectedDataIndex-1].journey_time : prevDate + ' 12:00 AM';
                        var parsedPrevTime = new Date(prevDate);
                        isAfterPrev = (parsedServiceTime.getTime() > parsedPrevTime.getTime())? true: false;
                    }
                    if (isAfterPrev) {
                        var choseServices = 0;
                        collectionData.service_array.forEach(function(val, key) {
                            var tileSelector = '#service-' + selectedDataIndex + '-' + selectedDataServiceIndex + '-' + selectedDataCollectionIndex;
                            if(globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].hadChosen) {
                                var adultCount = parseInt($('#adult-price').val());
                                var childrenCount = parseInt($('#children-price').val());

                                if (adultCount > 0 || childrenCount > 0) {
                                    choseServices++;

                                    $('#package-toggler-' + key).addClass('sec-btn');
                                    $('#package-toggler-' + key).removeClass('addcart');
                                    $('#package-toggler-' + key).html('Remove ' + serviceType);

                                    globalStationData[selectedDataIndex].journey_date = serviceDate;
                                    globalStationData[selectedDataIndex].journey_time = serviceTime;
                                    globalStationData[selectedDataIndex].service_collection.forEach(function(servColObj, servColKey) {
                                        servColObj.service_group.forEach(function (servGrpObj, servGrpKey) {
                                            servGrpObj.service_array.forEach(function (servObj, servKey) {
                                                // globalStationData[selectedDataIndex].service_collection[servColKey].service_group[servGrpKey].service_array[servKey].adult_count = adultCount;
                                                // globalStationData[selectedDataIndex].service_collection[servColKey].service_group[servGrpKey].service_array[servKey].children_count = childrenCount;
                                                globalStationData[selectedDataIndex].service_collection[servColKey].service_group[servGrpKey].service_array[servKey].service_date = serviceDate;
                                                globalStationData[selectedDataIndex].service_collection[servColKey].service_group[servGrpKey].service_array[servKey].service_time = serviceTime;
                                            });
                                        });
                                    });

                                    globalStationData.forEach(function (statObj, statKey) {
                                        statObj.service_collection.forEach(function (statServColObj, statServColKey) {
                                            statServColObj.service_group.forEach(function (statServGrpObj, statServGrpKey) {
                                                statServGrpObj.service_array.forEach(function (statServObj, statServKey) {
                                                    globalStationData[statKey].service_collection[statServColKey].service_group[statServGrpKey].service_array[statServKey].adult_count = adultCount;
                                                    globalStationData[statKey].service_collection[statServColKey].service_group[statServGrpKey].service_array[statServKey].children_count = childrenCount;
                                                });
                                            });
                                        });
                                    });
                                    
                                    $('.flight-date-' + selectedDataIndex).text(serviceDate);
                                    $('.flight-time-' + selectedDataIndex).text(serviceTime);

                                    globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].sp_company_logo = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].sp_company_logo;
                                    globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].sp_company_name = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].sp_company_name;
                                    // globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].adult_count = adultCount;
                                    // globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].children_count = childrenCount;
                                    // globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].service_date = serviceDate;
                                    // globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].service_time = serviceTime;
                                    globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].isSelected = true;
                                    
                                    if(!$(tileSelector).hasClass('has-service')) $(tileSelector).addClass('has-service');
                                } else {
                                    swal({
                                        text: "Service should have atleast 1 person !",
                                        icon: "warning",
                                    });
                                }
                            } else {
                                $('#package-toggler-' + key).removeClass('sec-btn');
                                $('#package-toggler-' + key).addClass('addcart');
                                $('#package-toggler-' + key).html('Choose ' + serviceType);
                                globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].isSelected = false;

                                if($(tileSelector).hasClass('has-service')) $(tileSelector).removeClass('has-service');
                            }
                        });

                        if (choseServices > 0) {
                            if($('#Policy').is(":checked")) {
                                $('#add-to-cart').removeClass('pak-add-alert-btn');
                                $('#add-to-cart').addClass('sec-btn');
                                $('#add-to-cart').text('Remove from cart');
                                $('#add-to-cart').attr('onclick', 'removeFromCart()');
                            
                                var jsonServiceData = JSON.stringify(globalStationData);
                                sessionStorage.setItem("jsonServiceData", jsonServiceData);
                                evalPrice();
                            } else {
                                swal({
                                    text: "Please accept terms and conditions !",
                                    icon: "warning",
                                });
                            }
                        } else {
                            swal({
                                text: "Please choose atleast one service !",
                                icon: "warning",
                            });
                        }
                    } else {
                        swal({
                            text: "Please check previous flight date & time !",
                            icon: "warning",
                        });
                    }
                } else {
                    swal({
                        text: "Service should be booked atleast 24 hours in prior !",
                        icon: "warning",
                    });
                }
            } else {
                swal({
                    text: "Please select service date & time !",
                    icon: "info",
                });
            }
        }

        function removeFromCart() {
            var collectionData = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex];//.service_array[key];
            var serviceType = (collectionData.service_type == 'Bundle')? 'Package': 'Service';
            var choseServices = 0;
            collectionData.service_array.forEach(function(val, key) {
                $('#package-toggler-' + key).removeClass('sec-btn');
                $('#package-toggler-' + key).addClass('addcart');
                $('#package-toggler-' + key).html('Choose ' + serviceType);
                globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex].service_array[key].isSelected = false;
            });

            if($('#service-' + selectedDataIndex + '-' + selectedDataServiceIndex + '-' + selectedDataCollectionIndex).hasClass('has-service'))
                $('#service-' + selectedDataIndex + '-' + selectedDataServiceIndex + '-' + selectedDataCollectionIndex).removeClass('has-service');

            $('#add-to-cart').addClass('pak-add-alert-btn');
            $('#add-to-cart').removeClass('sec-btn');
            $('#add-to-cart').text('Add to cart');
            $('#add-to-cart').attr('onclick', 'addServicesToCart()');
            
            var jsonServiceData = JSON.stringify(globalStationData);
            sessionStorage.setItem("jsonServiceData", jsonServiceData);
            evalPrice();
        }

        function refreshStationClass() {
            globalStationData.forEach(function(masterServiceObj, masterServiceKey) {
                var isCompleted = false;
                $('#tab-station-' + masterServiceKey).removeClass('completed');
                masterServiceObj.service_collection.forEach(function(serviceCollectionObj) {
                    serviceCollectionObj.service_group.forEach(function(serviceGrpObj) {
                        serviceGrpObj.service_array.forEach(function(serviceObj) {
                            if (serviceObj.isSelected) {
                                isCompleted = true;
                            }
                        });
                    });
                });
                if (isCompleted) {
                    $('#tab-station-' + masterServiceKey).addClass('completed');
                }
            });
        }

        function evalPrice() {
            var adultCount = parseInt($('#adult-price').val());
            var childrenCount = parseInt($('#children-price').val());
            var collectionData = globalStationData[selectedDataIndex].service_collection[selectedDataServiceIndex].service_group[selectedDataCollectionIndex];
            collectionData.adult_count = adultCount;
            collectionData.children_count = childrenCount;
            $('.net-price').each(function() {
                var adultPrice = parseInt($(this).attr('data-price-adult'));
                var childrenPrice = parseInt($(this).attr('data-price-children'));

                var additionalAdultPrice = parseInt($(this).attr('data-price-add-on-adult'));
                var additionalChildrenPrice = parseInt($(this).attr('data-price-add-on-children'));
                var total_amount = 0;
                if (additionalAdultPrice > 0 && adultCount > 1) {
                    total_amount += (adultPrice + ((adultCount-1) * additionalAdultPrice));
                } else {
                    total_amount += adultCount * adultPrice;
                }
                if (additionalChildrenPrice > 0 && childrenCount > 1) {
                    total_amount += (childrenPrice + ((childrenCount-1) * additionalChildrenPrice));
                } else {
                    total_amount += childrenCount * childrenPrice;
                }

                // var total_amount = (adultCount * adultPrice) + (childrenCount * childrenPrice);
                $(this).html(total_amount);
            });

            cartCount = 0;
            globalStationData.forEach(function(masterServiceObj, masterServiceKey) {
                var isCompleted = false;
                $('#tab-station-' + masterServiceKey).removeClass('completed');
                masterServiceObj.service_collection.forEach(function(serviceCollectionObj) {
                    serviceCollectionObj.service_group.forEach(function(serviceGrpObj) {
                        serviceGrpObj.service_array.forEach(function(serviceObj) {
                            if (serviceObj.isSelected) {
                                isCompleted = true;
                                cartCount++;
                            }
                        });
                    });
                });
                if (isCompleted) {
                    $('#tab-station-' + masterServiceKey).addClass('completed');
                }
                masterServiceObj.adult_count = adultCount;
                masterServiceObj.children_count = childrenCount;
            });
            $('.cart-count').text(cartCount);

            var jsonServiceData = JSON.stringify(globalStationData);
            sessionStorage.setItem("jsonServiceData", jsonServiceData);

            if (cartCount > 0) {
                $('.service-id').text(cartCount + ' Service');
                $('#my_cart').attr('onclick', 'location.href="checkout.php"');
                $('#cart-nav').attr('onclick', 'location.href="checkout.php"');

                $('#checkout_btn').attr('onclick', "window.location.href = 'checkout.php'");
                $('.checkout-btn').removeClass('hidden');
            } else {
                $('.service-id').text('No Service');
                $('#my_cart').attr('onclick', "swal('Add atleast 1 service !')");
                $('#cart-nav').attr('onclick', "swal('Add atleast 1 service !')");

                //remove attribute on checkout button
                document.getElementById("checkout_btn").removeAttribute("onclick");
                //enable checkout button
                $('.checkout-btn').addClass('hidden');
            }
            refreshStationClass();
        }

        // // add cart popup
        // $('.addcart-btn').on('click', function () {
        //     $('#service_desc_cart_popup').modal('hide');
        //     login();
        //     // $("#card_alert").show();
        //     // setTimeout(function(){
        //     //     $("#card_alert").hide(); 
        //     // }, 2000);
        // });
        // $('.close-alert').on('click', function () {
        //     // $("#card_alert").hide();
        // });
    </script>
</body>

</html>