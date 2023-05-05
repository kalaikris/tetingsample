<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Home</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css<?php echo $cache_str; ?>"/>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/my-cart.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/index.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
    <style>
        .bookings__list {
            display: flex;
            justify-content: center;
            margin-top: 32px; 
        }
        /* .bookings__list .owl-carousel,
        .bookings__list .owl-carousel .owl-stage-outer,
        .bookings__list .owl-carousel .owl-stage {
            max-width: max-content;
        } */
        .booking-sec {
            padding: 50px 0px 16px;
        }
        .cart-header {
            text-align: center;
            margin: 24px 0;
        }
        .cart-header h2 {
            font: 32px/40px var(--font-primary);
            letter-spacing: -1px;
            color: rgba(0, 0, 0, 0.85);
            opacity: 1;
        }
        .link {
            float: right;
            margin-bottom: 12px;
        }
        .link::after {
            content: "\2192";
            position: relative;
            left: 5px;
            transition: .2s;
        }
        .link:hover::after{
            left: 10px;
        }
        .tab-box {
            margin-bottom: 24px;
            display: flex;
            justify-content: center;
        }
        .cart-lists {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 270px));
            gap:16px;
            justify-content: center;
            clear: right;
        }
        .cart-lists h4 {
            text-align: center;
        }
        .cart-list {
            width: 100%;
            margin-bottom: 0;
        }

        /*tab*/
        .ser-ab-review-tab{
            padding-left: 5%;
            padding-right: 5%;
        }
        .ser-ab-review-tab > li.active > a, 
        .ser-ab-review-tab > li.active > a:focus, 
        .ser-ab-review-tab > li.active > a:hover{
            font: 16px/20px var(--font-primary);
            letter-spacing: -0.5px;
            color: #000;
            opacity: .8;
            border: none;   
            border-bottom: 2px solid var(--color-primary);
        }

        .login-close {
            width: 28px;
            padding: 4px 8px;
            border-radius: 24px;
            background-color: var(--color-primary);
        }
    </style>
</head>
<body onload="loadDistributorDetail();">
    <div class="main">

        <div id="loading"></div>

        <header></header> <!-- HEADER -->
        <nav></nav>  <!-- NAV MENU -->
        
        <!-- BANNER SECTION -->
        <section class="banner-sec banner-bg" id="banner">
            <input type="hidden" id="gtag_id">
            <div class="container-fluid" id="booking-target">
                <div class="banner-set">
                    <div class="b-header-set" id="banner_description">
                        <h4>Get all the airport services you need from</h4>
                        <h1>Meet & greet to Visa assistance</h1>
                    </div>
                    <div class="airport-serv-filter">
                        <div class="filter-act-set">
                            <div class="jurney-opt-set">
                                <p>
                                    What's your travel plan?
                                </p>
                                <div>
                                    <input class="travel_plan-input direct__flight-radio" type="radio" name="travel-type" value="has_no_transit" id="travel-1" checked="checked">
                                    <label for="travel-1">Direct Flight</label>
                                </div>
                                <div>
                                    <input class="travel_plan-input" type="radio" name="travel-type" value="has_transit" id="travel-2" data-toggle="modal" data-target="#add_airport_modal">
                                    <label for="travel-2">I have transits</label>
                                </div>
                            </div>
                            <div class="filter-input-set">
                                <div class="arriving-input-set">
                                    <label for="arport_search">From</label>
                                    <input type="text" list="departure-terminal-list" class="b-input" id="departure-terminal" autocomplete="off" placeholder="Enter airport">
                                    <datalist class="data-terminal-list" id="departure-terminal-list"></datalist>
                                </div>
                                <div class="arriving-input-set">
                                    <label for="arport_search">To</label>
                                    <input type="text" list="arrival-terminal-list" class="b-input" id="arrival-terminal" autocomplete="off" placeholder="Enter airport">
                                    <datalist class="data-terminal-list" id="arrival-terminal-list"></datalist>
                                </div>
                                <div class='arriving-input-set input-group' id='arrive_date'>
                                    <label for="arrive_date">Flight Date</label>
                                    <input type='text' class="b-input datepicker" id="depart-date" placeholder="DD-MMM-YYYY">
                                </div>
                                <div class="arriving-input-set">
                                    <label for="arport_search">Flight Number*</label>
                                    <input type="text" class="b-input" id="depart-flight-number" placeholder="Enter Flight Number">
                                </div>
                            </div>
                        </div>
                        <div class="filter-btn-set">
                            <button class="cust-btn cust-btn-md" id="search_service" onclick="searchServices()">Search Service</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="achivement-sec">
            <div class="container-fluid">
                <ul class="achi-set">
                    <li>
                        <img src="asset/home/world.svg" class="achivement-icon" alt="">
                        <div class="achivement-desc-set">
                            <h2>150+</h2>
                            <p>Locations worldwide</p>
                        </div>
                    </li>
                    <li>
                        <img src="asset/home/airport.svg" class="achivement-icon" alt="">
                        <div class="achivement-desc-set">
                            <h2>3,200+</h2>
                            <p>Airport terminals</p>
                        </div>
                    </li>
                    <li>
                        <img src="asset/home/partner.svg" class="achivement-icon" alt="">
                        <div class="achivement-desc-set">
                            <h2>250+</h2>
                            <p>Partners worldwide</p>
                        </div>
                    </li>
                    <li>
                        <img src="asset/home/happycustomer.svg" class="achivement-icon" alt="">
                        <div class="achivement-desc-set">
                            <h2>25,000+</h2>
                            <p>Happy customers</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- ========== SECTION 3 ========== -->
        <section class="booking-sec">
            <div class="container">
                <div class="cart-header">
                    <h2>Upcoming Services</h2>
                </div>
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
                <a href="my-booking.php" class="link view-all">View all</a>
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

        <section class="service-sec">
            <div class="container-fluid">
                <div class="heading-set">
                    <h2>Services we offer</h2>
                    <p>Have The Smoothest Experience Every Time You Travel</p>
                </div>
                <div class="service-gallery">
                    <div class="gallaery-lists"></div>
                </div>
                <div class="overview-set">
                    <div class="overview-left">
                        <h1>Make every trip comfortable and easy with <span>AirportZo</span></h1>
                        <p>Airports Can Be Daunting. It Can Be Almost Impossible To Navigate All The Queues And Formalities Involved. With AirportZo, You Can Have A Hassle-Free Airport Experience From The Moment You Leave Your Home To The Moment You Reach Your Destination. Through Personal Assistance, Lounge And Baggage Porter Services, And So Much More, We Make Every Aspect Of Your Journey Comfortable, Convenient And Simple.</p>
                    </div>
                    <div class="overview-right">
                        <div class="overview-r-inner">
                            <ul class="overview-lists">
                                <li>
                                    <img src="asset/home/globegreen.svg" class="over-v-icon" alt="icon">
                                    <div class="overview-list-desc">
                                        <h5>Book From Anywhere</h5>
                                        <p>Plan a comfortable trip from anywhere to 600+ Airports, 0 lines.</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="asset/home/magic.svg" class="over-v-icon" alt="icon">
                                    <div class="overview-list-desc">
                                        <h5>Effortless Bookings</h5>
                                        <p>Make easy online bookings, 24/7 service, and all-inclusive prices confirmed in advance.</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="asset/home/24hrs.svg" class="over-v-icon" alt="icon">
                                    <div class="overview-list-desc">
                                        <h5>Gate to Gate Services</h5>
                                        <p>From the Airport gate to the Aircraft Gate & vice versa, we will be at your service.</p>
                                    </div>
                                </li>
                            </ul>
                            <a href="javascript:void(0)" class="know-about-link">Get to know about us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="happy-cust-sec avail-service">
            <div class="container-fluid">
                <div class="heading-set">
                    <h2>Serving 25,000+ happy customers</h2>
                    <p>We serve a wide range of people to make their day better and memorable</p>
                </div>
                <div class="service-ach-lists" id="avail-service"></div>
            </div>
        </section>

        <section class="reward-partner-sec">
            <div class="container-fluid">
                <div class="reward-set">
                    <div class="reward-inner-set">
                        <div class="reward-desc">
                            <h2>Exciting rewards on each purchase!!</h2>
                            <p>Our unmatched reward program lets you earn coins <br> each time you shop.</p>
                            <img src="asset/home/miletag.svg" class="cointag-img" alt="icon">
                        </div>
                    </div>
                </div>
            </div>
            <div class="rewar-underline our_partners"></div>
            <div class="container-fluid our_partners">
                <div class="heading-set">
                    <h2>Our partners</h2>
                    <p>We have partnered with 250+ vendors across the globe to serve you better</p>
                </div>
                <div class="partner-set">
                    <div class="owl-carousel owl-theme partner-owl" id="our_partners"></div>
                </div>
            </div>
        </section>
        
        <section class="hassle-free-trvl-sec">
            <div class="container-fluid">
                <div class="hasslefree-main-set">
                    <div class="hasslefree-setps-set">
                        <h2>4 Clicks For Hassle Free Travel</h2>
                        <ul class="hasslefree-step-lists">
                            <li>
                                <img src="asset/home/step1.svg" class="step-icon" alt="icon">
                                <p>Choose A Package That Suits You</p>
                            </li>
                            <li>
                                <img src="asset/home/step2.svg" class="step-icon" alt="icon">
                                <p>Confirm Your Booking</p>
                            </li>
                            <li>
                                <img src="asset/home/step3.svg" class="step-icon" alt="icon">
                                <p>Meet Us At The Airport</p>
                            </li>
                            <li>
                                <img src="asset/home/step4.svg" class="step-icon" alt="icon">
                                <p>Enjoy A Convenient &  <br>Comfortable Trip</p>
                            </li>
                        </ul>
                        <a class="cust-btn btn-darkblue" href="#booking-target">Let’s book a service</a>
                    </div>
                    <div class="hasslefree-img-set">
                        <img src="asset/home/happywoman.png" class="hasslefree-img" alt="hasslefree img">
                    </div>
                </div>
            </div>
        </section>

        <section class="aboutus-sec">
            <div class="container-fluid">
                <div class="heading-set">
                    <h2>What people say about us</h2>
                </div>
                <div class="owl-carousel owl-theme aboutus-owl" id="aboutus">
                    <div class="items">
                        <div class="aboutus-set">
                            <div class="aboutus-desc-set ">
                                <h4>Aishwarya Baskaran</h4>
                                <p>My Elderly Parents Were Travelling Alone To Canada Out Of Delhi Airport T3, My Mother Who Cannot Walk Much,Requested For Assistance. I Booked A Meet And Assist Service For Them Through Airportzo And These Guys Were Outstanding. Right After I Booked The Service, I Received Timely Updates And Follow Up Calls To Explain The Process And Coordinate The Arrival Time Etc On The Day Of Their Travel. At The Airport My Parents Were Received By Inderjeet Mishra, Who Accompanied Them From The Entrance Till The Boarding Gate, Expediting Their Movement Through SHA And Immigration, Answering All Their Queries With A Warm Smile. Thank You Guys For The Warm And Personalised Service.</p>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="aboutus-set">
                            <div class="aboutus-desc-set ">
                                <h4>Mohita Verma</h4>
                                <p>I would like to place my appreciationand very mant thanks to the excellent service I received recently at Delhi airport by Airportzo team. I was travelling with an infant and the Care and attention I received was commendable. I will always recommend Airportzo to any parent travelling with a child or to elderly parents as the value for money is exceptional. I commend your training and persons and personalities you employ. I look forward to returning in a few weeks tims and using Airportzo services once again.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="become-agent-sec">
            <div class="container">
                <div class="earn-more-card">
                    <div class="img-box">
                        <img src="asset/home/earn-more.svg" alt="vector">
                    </div>
                    <div class="content-box">
                        <h1>Want to earn more?</h1>
                        <p>Join us and become our agent to generate a hassle-free income.</p>
                        <a href="agent-application" class="know-more-btn">Know more</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="goto-app-sec glob-icon-bg">
            <div class="container-fluid">
                <div class="destination-set">
                    <div class="destination-left">
                        <div class="destination-left-inner-set">
                            <h2>
                                Make Your Journey As Enjoyable <br>
                                As The Destination
                            </h2>
                            <ul class="loca-ter-set">
                                <li>
                                    <img src="asset/home/pin.svg" class="dest-icon" alt="">
                                    <div class="dist-desc">
                                        <h1>150+</h1>
                                        <p>Locations Worldwide</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="asset/home/flight.svg" class="dest-icon" alt="">
                                    <div class="dist-desc">
                                        <h1>3,200+</h1>
                                        <p>Airport Terminals</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="dest-border"></div>
                            <div class="goto-store-set">
                                <h5>Coming Soon on</h5>
                                <div class="store-link">
                                    <a href="javascript:void(0)"><img src="asset/home/appstore.svg" class="destination-store-icon" alt="app store"></a>
                                    <a href="javascript:void(0)"><img src="asset/home/playstore.svg" class="destination-store-icon" alt="app store"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="destination-right">
                        <div class="glob-connect-set">
                            <!-- <img src="asset/home/globe.png" class="glob-icon" alt="glob"> -->
                            <img src="asset/home/phone.png" class="phone-icon" alt="phone">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer></footer> <!-- FOOTER SECTION --> 

        <div id="login_modal" class="modal fade" role="dialog"></div><!-- LOGIN MODAL -->
        
        <!-- Add Multiple airport MODAL -->
        <!-- <div id="add_airport_modal" class="modal fade" role="dialog">
            <div class="modal-dialog float-right top-edge custom-dialog">
                <div class="custom-content">
                    <button type="button" class="login-close" data-dismiss="modal">&times;</button>
                    <div class="cust-modal-body">
                        <div class="filter-multiple-airport">
                            <div class="mult-air-header">
                                <img src="asset/logo.png" class="side-bar-logo" alt="logo">
                                <h2>Where do you need our services ?</h2>
                            </div>
                            <div class="mult-air-divider"></div>
                            <div class="add-remove-mult-airport-set">
                                <ul class="airport-filter-lists">
                                    <li class="airport-filter-list">
                                        <div class="ariv-depart-set">
                                            <div class="ariv-depart-header-set">
                                                <h2>Airport1</h2>
                                                <div class="ariv-depart-option-switch">
                                                    <input type="checkbox" class="airport-switch-input" id="airport1">
                                                    <label for="airport1" class="switch-label">
                                                    </label>
                                                    <span class="arrive-departure-text">At Arrival</span>
                                                </div>
                                            </div>
                                            <div class="airport-details">
                                                <ul class="airport-details-lists">
                                                    <li class="airport-details-list">
                                                        <p>Arriving at</p>
                                                        <h2>Dubai Internatinal Airport, Terminal3</h2>
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Arriving on</p>
                                                        <h2>25 Jun, 2022</h2>
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Service Avail Time</p>
                                                        <h2>6:30 PM</h2>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="airport-filter-list">
                                        <div class="ariv-depart-set">
                                            <div class="ariv-depart-header-set">
                                                <h2>Airport2</h2>
                                                <div class="ariv-depart-option-switch">
                                                    <input type="checkbox" class="airport-switch-input" id="airport2">
                                                    <label for="airport2" class="switch-label">
                                                    </label>
                                                    <span class="arrive-departure-text">At Departure</span>
                                                </div>
                                            </div>
                                            <div class="airport-details">
                                                <ul class="airport-details-lists">
                                                    <li class="airport-details-list">
                                                        <p>Departing at</p>
                                                        <h2>Dubai Internatinal Airport, Terminal3</h2>
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Departing on</p>
                                                        <h2>25 Jun, 2022</h2>
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Service Avail Time</p>
                                                        <h2>6:30 PM</h2>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="javascript:void(0)" class="remov-airport" id="remove_transit">Remove Airport</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="add-airport-set add-transit-btn">Add airport</a>
                            <div class="service-filter-btn-set">
                                <button class="searc-btn">Search Service</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- TRANSIT MODAL -->
        <div id="add_airport_modal" class="modal fade" role="dialog">
            <div class="modal-dialog float-right top-edge custom-dialog">
                <div class="custom-content">
                    <!-- <img class="login-close" src="asset/choose-service/close.svg" alt="close icon" data-dismiss="modal"> -->
                    <img src="asset/choose-service/close-white.svg" class="close close-modal login-close" alt="close icon" data-dismiss="modal" aria-label="Close" style="transform: translate(-15px, 15px);">
                    <div class="cust-modal-body">
                        <div class="filter-multiple-airport">
                            <div class="mult-air-header">
                                <img src="asset/logo.png" class="side-bar-logo" id="header-logo1" alt="logo">
                                <h2>Transit Journey</h2>
                            </div>
                            <div class="mult-air-divider"></div>
                            <div class="add-remove-mult-airport-set">
                                <ul class="airport-filter-lists">
                                    <li class="airport-filter-list">
                                        <img class="transit-flight-icon" src="asset/home/flight-white.svg" alt="flight icon">
                                        <div class="ariv-depart-set">
                                            <div class="ariv-depart-header-set">
                                                <h2>Journey 1</h2>
                                            </div>
                                            <div class="airport-details">
                                                <ul class="airport-details-lists">
                                                    <li class="airport-details-list">
                                                        <p>From</p>
                                                        <input class="transit_airport_input" list="departure-terminal-list-1" name="terminals" autocomplete="off">
                                                        <datalist class="data-terminal-list" id="departure-terminal-list-1"></datalist>
                                                        <!-- <input class="transit_airport_input" type="text" value="Amsterdam Schipol International Airport"> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>To</p>
                                                        <input class="transit_airport_input arrival-changer" data-change-target="departure-terminal-list-2" list="arrival-terminal-list-1" name="terminals" autocomplete="off">
                                                        <datalist class="data-terminal-list" id="arrival-terminal-list-1"></datalist>
                                                        <!-- <input class="transit_airport_input" type="text" value="Amsterdam Schipol International Airport"> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Flight Date</p>
                                                        <input class="datepicker transit_airport_input depart-date-selector" data-target-id="depart-date-2" type="text" id="depart-date-1" placeholder="DD-MMM-YYYY" readonly>
                                                        <!-- <h2>25 Jun, 2022</h2> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Flight Number*</p>
                                                        <input class="transit_airport_input" type="text" id="depart-flight-number-1" placeholder="Enter Flight Number">
                                                        <!-- <input class="transit_airport_input" type="number" name="" value="234567"> -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="airport-filter-list">
                                        <img class="transit-flight-icon" src="asset/home/flight-white.svg" alt="flight icon">
                                        <div class="ariv-depart-set">
                                            <div class="ariv-depart-header-set">
                                                <h2>Journey 2</h2>
                                            </div>
                                            <div class="airport-details">
                                                <ul class="airport-details-lists">
                                                    <li class="airport-details-list">
                                                        <p>From</p>
                                                        <input class="transit_airport_input" list="departure-terminal-list-2" name="terminals" autocomplete="off" readonly aria-readonly="true">
                                                        <datalist class="data-terminal-list" id="departure-terminal-list-2"></datalist>
                                                        <!-- <input class="transit_airport_input" type="text" value="Amsterdam Schipol International Airport"> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>To</p>
                                                        <input class="transit_airport_input arrival-changer" data-change-target="departure-terminal-list-3" list="arrival-terminal-list-2" name="terminals" autocomplete="off">
                                                        <datalist class="data-terminal-list" id="arrival-terminal-list-2"></datalist>
                                                        <!-- <input class="transit_airport_input" type="text" value="Amsterdam Schipol International Airport"> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Flight Date</p>
                                                        <input class="datepicker transit_airport_input depart-date-selector" type="text" data-target-id="depart-date-3" id="depart-date-2" placeholder="DD-MMM-YYYY" readonly>
                                                        <!-- <h2>25 Jun, 2022</h2> -->
                                                    </li>
                                                    <li class="airport-details-list">
                                                        <p>Flight Number*</p>
                                                        <input class="transit_airport_input" type="text" id="depart-flight-number-2" placeholder="Enter Flight Number">
                                                        <!-- <input class="transit_airport_input" type="number" name="" value="234567"> -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <span class="remove-transit" id="remove_transit" style="display: none;">Remove Transit</span>
                            </div>
                            <span class="add-transit-btn add-airport-set"><svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="airplane" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M18,13.2 L18,11.6 L11.2631579,7.6 L11.2631579,3.2 C11.2631579,2.536 10.6989474,2 10,2 C9.30105263,2 8.73684211,2.536 8.73684211,3.2 L8.73684211,7.6 L2,11.6 L2,13.2 L8.73684211,11.2 L8.73684211,15.6 L7.05263158,16.8 L7.05263158,18 L10,17.2 L12.9473684,18 L12.9473684,16.8 L11.2631579,15.6 L11.2631579,11.2 L18,13.2 Z" id="flight_icon" fill="#29BDD8" fill-rule="nonzero"></path></g></svg>Add Transit</span>
                            <div class="service-filter-btn-box">
                                <button type="button" class="searc-btn" onclick="searchServices()">Search Service <i class="country-flg in"></i></button>
                            </div>
                        </div>
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
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/custom.js<?php echo $cache_str; ?>"></script>
    <script for="Front-end">
        var today = new Date();
        var nextDay = new Date(today);
        if (backendBooking != true) nextDay.setDate(today.getDate() + 1);
        // nextDay.setDate(today.getDate() + 1);
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var dd = String(nextDay.getDate()).padStart(2, '0');
        var mm = nextDay.getMonth();
        var yyyy = nextDay.getFullYear();
        nextDay = dd + '-' + monthNames[mm] + '-' + yyyy;
        var isAgent = false;

        $( document ).ready(function() {
            // Aboutus owl-carousel
            var owl = $('#aboutus');
            owl.owlCarousel({
                margin: 10,
                loop: true,
                center:true,
                nav:false,
                dots:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    },
                }
            });

            var userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                $('.booking-sec').css("display", "none");
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
                        } else {
                            $('.booking-sec').css("display", "none");
                        }
                    }
                });
                if ( !isAgent ) {
                    $('.tab-box').remove();
                }
            }

            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users-booking/read-history.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        if(responseData.length <= 3){
                            $('.view-all').css("display", "none");
                        } else {
                            $('.view-all').css("display", "block");
                        }
                        bookingsData = responseData.length = 4;
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
                        $('.cart-list').on('click', function() {
                            window.location.href = "my-booking.php";
                        });
                    } else {
                        $('.cart-lists').append(`<h2>${response.message}</h2>`);
                    }
                }
            });
            
            $('.current_year').text(currentYear);
            $('#depart-date, #depart-date-1, #depart-date-2').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MMM-YYYY'
            });
            $('#depart-date').val(nextDay);
            $('#depart-date').data("DateTimePicker").minDate(nextDay);
            $('#depart-date-1').val(nextDay);
            $('#depart-date-1').data("DateTimePicker").minDate(nextDay);
            $('#depart-date-2').val(nextDay);
            $('#depart-date-2').data("DateTimePicker").minDate(nextDay);

            initStationChanger();

            //Add Transit in popup
            const journeyList = document.querySelector('.airport-filter-lists');
            const journeyListItem = document.querySelectorAll('.airport-filter-list');
            const addTransitBtn = document.querySelector('.add-transit-btn');
            const removeTransitBtn = document.getElementById('remove_transit');

            let journeyListItemLength = journeyListItem.length;
            
            addTransitBtn.addEventListener('click', function() {
                const journeyListItem = document.querySelectorAll('.airport-filter-list');
                let journeyListItemLength = journeyListItem.length;
                if(journeyListItemLength < 3) {
                    let journeyFormHtml = `<li class="airport-filter-list">
                            <img class="transit-flight-icon" src="asset/home/flight-white.svg" alt="flight icon">
                            <div class="ariv-depart-set">
                                <div class="ariv-depart-header-set">
                                    <h2>Journey ${journeyListItemLength+1}</h2>
                                </div>
                                <div class="airport-details">
                                    <ul class="airport-details-lists">
                                        <li class="airport-details-list">
                                            <p>From</p>
                                            <input class="transit_airport_input" list="departure-terminal-list-${journeyListItemLength+1}" name="terminals" autocomplete="off" readonly>
                                        </li>
                                        <li class="airport-details-list">
                                            <p>To</p>
                                            <input class="transit_airport_input arrival-changer" data-change-target="departure-terminal-list-${journeyListItemLength+2}" list="arrival-terminal-list-${journeyListItemLength+1}" name="terminals" autocomplete="off">
                                            <datalist class="data-terminal-list" id="arrival-terminal-list-${journeyListItemLength+1}"></datalist>
                                        </li>
                                        <li class="airport-details-list">
                                            <p>Flight Date</p>
                                            <input class="datepicker transit_airport_input depart-date-selector" type="text" data-target-id="depart-date-${journeyListItemLength+2}" id="depart-date-${journeyListItemLength+1}" placeholder="DD-MMM-YYYY" readonly>
                                        </li>
                                        <li class="airport-details-list">
                                            <p>Flight Number*</p>
                                            <input class="transit_airport_input" type="text" id="depart-flight-number-${journeyListItemLength+1}" placeholder="Enter Flight Number">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>`;
                    journeyList.insertAdjacentHTML('beforeend', journeyFormHtml);

                    commonTerminals.forEach(function(terminal) {
                        $('#departure-terminal-list-' + (journeyListItemLength+1)).append(`<option value="${terminal.terminal_string}">`);
                        $('#arrival-terminal-list-' + (journeyListItemLength+1)).append(`<option value="${terminal.terminal_string}">`);
                    });
                    $('input[list="departure-terminal-list-' + (journeyListItemLength+1) + '"]').val($('input[list="arrival-terminal-list-' + journeyListItemLength + '"]').val());
                    removeTransitBtn.style.display = 'block';

                    $('#depart-date-' + (journeyListItemLength+1)).datetimepicker({
                        ignoreReadonly: true,
                        format: 'DD-MMM-YYYY'
                    });
                    $('#depart-date-' + (journeyListItemLength+1)).val(nextDay);
                    $('#depart-date-' + (journeyListItemLength+1)).data("DateTimePicker").minDate(nextDay);

                    // $('.datepicker').datetimepicker({
                    //     ignoreReadonly: true,
                    //     format: 'DD-MMM-YYYY'
                    // });
                    // $('.datepicker').data("DateTimePicker").minDate(nextDay);

                    initStationChanger();
                }

                updateTransitBtn();
            });

            removeTransitBtn.addEventListener('click', function() {
                const journeyListItem = document.querySelectorAll('.airport-filter-list');
                let journeyListItemLength = journeyListItem.length;
                
                journeyList.removeChild(journeyList.lastElementChild);
                
                updateTransitBtn();
            });
           // setTimeout(function() { $('#loading').fadeOut(); }, 500 );
        });

        function updateTransitBtn() {
            const journeyListItem = document.querySelectorAll('.airport-filter-list');
            let journeyListItemLength = journeyListItem.length;
            let minJourney = 2;
            let maxJourney = 3;
            
            if (journeyListItemLength > minJourney) {
                document.getElementById('remove_transit').style.display = 'block';
            } else {
                document.getElementById('remove_transit').style.display = 'none';
            }

            if (journeyListItemLength < maxJourney) {
                document.querySelector('.add-transit-btn').style.display = 'block';
            } else {
                document.querySelector('.add-transit-btn').style.display = 'none';
            }
        }

        function initStationChanger() {
            $('.arrival-changer').on('change', function() {
                var tempVal = $(this).val();
                var nxt_selector = $(this).attr('data-change-target');
                var input_target = 'input[list="' + nxt_selector + '"]';
                $(input_target).val(tempVal);
            });
        }
    </script>
    <script>
        var commonTerminals = [];
        var departureTerminals = [];
        var transitTerminals = [];
        var arrivalTerminals = [];
        $( document ).ready(function() {
            $('#our_partners').empty();
            $.ajax({
                async: false,
                url: 'php/our-partners/read.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        response.data.forEach(function(partnersData) {
                            $('#our_partners').append(`<div class="items">
                                <div class="partner-logo-set">
                                    <img src="${partnersData.image}" class="partner-logo" alt="partner logo">
                                </div>
                            </div>`);
                        });

                        // our partners owl-carousel
                        var owl = $('#our_partners');
                        owl.owlCarousel({
                            margin: 10,
                            loop: true,
                            center: true,
                            nav: false,
                            dots: false,
                            autoplay:true,
                            slideTransition: 'linear',
                            autoplayTimeout: 5000,
                            autoplaySpeed: 5000,
                            responsive: {
                                0: {
                                    items: 3
                                },
                                500: {
                                    items: 3
                                },
                                650: {
                                    items: 4
                                },
                                700: {
                                    items: 4
                                },
                                1024: {
                                    items: 5
                                },
                                1600: {
                                    items: 6
                                }
                            }
                        });
                    } else {
                        $('.our_partners').css("display", "none");
                    }
                }
            });

            $('#avail-service').empty();
            $.ajax({
                async: false,
                url: 'php/avail-service/read.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        response.data.forEach(function(availServiceData) {
                            $('#avail-service').append(`<div class="service-ach-list-items">
                                <img src="${availServiceData.image}" class="cust-service-poster" alt="poster img">
                                <div class="service-name">
                                    <h4>
                                        ${availServiceData.name}
                                    </h4>
                                </div>
                            </div>`);
                        });
                    } else {
                        $('.avail-service').css("display", "none");
                    }
                }
            });

            $('#arrival-terminal-list').empty();
            $('#departure-terminal-list').empty();
            $.ajax({
                async: false,
                url: 'php/terminals/read.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        commonTerminals = responseData.common;
                        // departureTerminals = responseData.departure;
                        // transitTerminals = responseData.transit;
                        // arrivalTerminals = responseData.arrival;

                        commonTerminals.forEach(function(terminal) {
                            $('.data-terminal-list').append(`<option value="${terminal.terminal_string}">`);
                            // $('.data-terminal-list_test').append(`<li><div>
                            //   <p class="city__country">${terminal.airport_city}</p>  
                            //   <p class="airport__name">${terminal.airport_name}</p> 
                            //   <p class="terminal__name">${terminal.terminal_string1}</p> 
                            // </div><div class="airport__code">${terminal.airport_code}</div></li>`);
                        });
                    }
                }
            });

            $('#gallery-list').empty();
            var inputData = {"currency": "INR"};
            inputData = JSON.stringify(inputData);
            $.ajax({
                async: false,
                url: 'php/services/read.php',
                data: inputData,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;

                        responseData.forEach(function(serviceObj) {
                            var serviceImage = (serviceObj.image!='')? serviceObj.image: 'asset/home/service1.png';
                            $('.gallaery-lists').append(`<div class="gallaery-list">
                                <img src="${serviceImage}" class="service-poster" alt="poster">
                                <div class="service-desc">
                                    <div class="service-price">
                                        <h4>${serviceObj.name}</h4>
                                        <p>From <img src="asset/home/rupee.svg" class="rupee-icon" alt="rupee icon"> ${serviceObj.price}</p>
                                    </div>
                                    <a href="service-details.php?id=${serviceObj.token}"><img src="asset/home/next.svg" class="next-icon" alt="icon"></a>
                                </div>
                            </div>`);
                        });
                    }
                }
            });
            // setTimeout(function(){$('#loading').fadeOut();},500);
        });

        function searchServices() {
            var travelType = $('input[name="travel-type"]:checked').val();
            var hasDataError = false;
            var hasFlightNumberError = false;
            var sameFlightError = false;
            var journeyArray = [];

            if (travelType == 'has_no_transit') {
                var departureTerminalStr = $('#departure-terminal').val().trim();
                var arrivalTerminalStr = $('#arrival-terminal').val().trim();
                var departFlightNumber = $('#depart-flight-number').val().trim();

                var departTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==departureTerminalStr);
                var arrivalTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==arrivalTerminalStr);

                if (departTerminalIndex > -1 && arrivalTerminalIndex > -1 && departFlightNumber != '' && departTerminalIndex != arrivalTerminalIndex) {
                    var journeyObj = {};
                    journeyObj.departure_ttr_token = commonTerminals[departTerminalIndex].ttr_token;
                    journeyObj.arrival_ttr_token = commonTerminals[arrivalTerminalIndex].ttr_token;
                    journeyObj.departure_date = $('#depart-date').val();
                    journeyObj.flight_number = departFlightNumber;
                    journeyArray.push(journeyObj);
                } else if (departTerminalIndex == arrivalTerminalIndex) {
                    sameFlightError = true;
                } else if (departFlightNumber == '') {
                    hasFlightNumberError = true;
                } else {
                    hasDataError = true;
                }
            } else {
                let journeyListItemLength = document.querySelectorAll('.airport-filter-list').length;

                for (let i = 1; i <= journeyListItemLength; i++) {
                    var departureTerminalStr = $('input[list="departure-terminal-list-' + i + '"]').val();
                    var arrivalTerminalStr = $('input[list="arrival-terminal-list-' + i + '"]').val();
                    var departFlightNumber = $('#depart-flight-number-' + i).val();

                    var departTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==departureTerminalStr);
                    var arrivalTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==arrivalTerminalStr);
                
                    if (departTerminalIndex > -1 && arrivalTerminalIndex > -1 && departFlightNumber != '' && departTerminalIndex != arrivalTerminalIndex) {
                        var journeyObj = {};
                        journeyObj.departure_ttr_token = commonTerminals[departTerminalIndex].ttr_token;
                        journeyObj.arrival_ttr_token = commonTerminals[arrivalTerminalIndex].ttr_token;
                        journeyObj.departure_date = $('#depart-date-' + i).val();
                        journeyObj.flight_number = departFlightNumber;
                        journeyArray.push(journeyObj);
                    } else if (departTerminalIndex == arrivalTerminalIndex) {
                        sameFlightError = true;
                    } else if (departFlightNumber == '') {
                        hasFlightNumberError = true;
                    } else {
                        hasDataError = true;
                    }
                }
            }

            var departDateErr = false;
            journeyArray.forEach(function (journeyObj, journeyKey) {
                if (journeyKey > 0) {
                    if (new Date(journeyArray[journeyKey-1].departure_date) > new Date(journeyObj.departure_date)) {
                        departDateErr = true;
                    }
                }
            });
            
            if (hasDataError) {
                swal('', 'Please select valid airport stations', 'warning');
            } else if (hasFlightNumberError) {
                swal('', 'Please check flight number', 'warning');
            } else if (departDateErr) {
                swal('', 'Please check flight dates', 'warning');
            } else if (sameFlightError) {
                swal('', 'Departure and arrival cannot be with same airport and terminal', 'warning');
            } else {
                var inputData = {"journey_array": journeyArray, "has_specific_service": false, "service_token": ""};
                inputData = JSON.stringify(inputData);
                $.ajax({
                    async: false,
                    url: 'php/services/read-for-journeys.php',
                    data: inputData,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status_code == 200) {
                            sessionStorage.setItem("jsonJourney", JSON.stringify(journeyArray));
                            sessionStorage.setItem("jsonInput", inputData);
                            sessionStorage.setItem("jsonServiceData", "");
                            window.location = "choose-service.php";
                        } else {
                            swal(response.message);
                        }
                    }
                });
            }
        }

        //Make the direct flight button checked after transit modal is closed
        const directFlightRadio = document.querySelector('.direct__flight-radio');
        const addAirportModal = document.querySelector('#add_airport_modal');
        addAirportModal.addEventListener('click', function(e){
            const target = e.target;
            if(e.target.classList.contains('modal') || e.target.classList.contains('login-close')){
                directFlightRadio.checked = true;
            }
        })
    </script>
</body>
</html>