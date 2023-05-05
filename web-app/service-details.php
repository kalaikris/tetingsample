<?php
include 'php/site-config.php';

$service_token = (isset($_GET['id']))? $_GET['id']: 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Service Details</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css"/>
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/service-details.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
    <style>
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
        <div id="loading"></div> <!--LOADER-->
        <header></header>
        <nav></nav> <!-- NAV MENU -->
        <section class="breadcrumbs-sec">
            <input type="hidden" id="gtag_id">
            <div class="container-fluid">
                <div class="breadcrumbs-set">
                    <ul class="breadcrumbs">
                        <li><a href="index.php">Home</a></li>
                        <li><a class="service-name-view" href="javascript:void(0)">Lounge</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="poster-sec">
            <div class="container">
                <div class="service-poster">
                    <ul class="service-poster-set">
                        <li>
                            <div class="poster-box">
                                <img src="asset/service-details/service2.png" class="ser-poster service-img" alt="poster img">
                            </div>
                        </li>
                        <li>
                            <h2 class="service-name-view">Lounge</h2>
                            <span class="amt-widget">
                                from ₹ <span class="amt-rupee service-price-view">1,499</span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="book-ser-sec">
            <div class="container">
                <div class="service-book-set">
                    <div class="service-book-inner-set">
                        <div class="des-desc-amt">
                            <p>Services Starting</p>
                            <h6>from ₹ <span class="service-price-view">1,499</span></h6>
                        </div>
                        <button class="bookser-btn" onclick="openSearchService()">book Service</button>
                    </div>
                </div>
                <div class="aboutus-service-set">
                    <div class="header-sec" id="business-description-div"> 
                        <h2>About <span class="service-name-view">Lounge</span></h2>
                        <p id="business-description">Our meet & assist service ensures that our representative will escort you, all the way from the airport curb, through security and immigration, to your gate before you board your flight. Upon arrival, you will be met with another representative who will guide you from the gate to your mode of transportation at your destination. Our meet & assist services are also available for transit flights. The perfect option for a senior citizen, VIP, or just anyone who needs personal attention while travelling.</p>
                    </div>
                    <div class="owl-carousel owl-theme aboutservice-carousel" id="service-images"></div>
                </div>
            </div>
        </section>
        <section class="avail-ser-sec" id="avail-services-div">
            <div class="container">
                <div class="avail-ser-set">
                    <div class="header-sec"> 
                        <h2 class="mobile-align">Who can avail this service</h2>
                    </div>
                    <div class="service-ach-lists" id="avail-services"></div>   
                </div>             
            </div>
        </section>
        <section class="where-the-service-sec">
            <div class="container">
                <div class="where-the-service-set">
                    <div class="header-sec"> 
                        <h2>Where the service is given</h2>
                    </div>
                    <div class="where-the-service-list-set">
                        <ul class="where-the-service-lists">
                            <li>
                                <img src="asset/service-details/arrival-gray.svg" class="out-ser-icon" alt="icon">
                                <h2>At Arrival</h2>
                            </li>
                            <li>
                                <img src="asset/service-details/departure-gray.svg" class="out-ser-icon" alt="icon">
                                <h2>At Departure</h2>
                            </li>
                            <li>
                                <img src="asset/service-details/transit.svg" class="out-ser-icon" alt="icon">
                                <h2>At Transit</h2>
                            </li>
                        </ul>
                    </div>
                    <div class="service-incl-desc-set" id="service-included-div">
                        <div class="header-sec cm-service-desc"> 
                            <h2>Services Included</h2>
                        </div>
                        <ul class="service-incl-desc-lists" id="service-included"></ul>
                    </div>
                    <div class="elit-partner-set" id="elite-partners-div">
                        <div class="header-sec cm-elit-partner"> 
                            <h2>Our elite partners</h2>
                        </div>
                        <ul class="elit-partner-lists" id="elite-partners"></ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="how-it-work-sec">
            <div class="container">
                <div class="how-it-work-set">
                    <div class="how-it-work-inner-set">
                        <div class="header-sec text-center"> 
                            <h2>How it Works?</h2>
                        </div>
                        <ul class="step-lists">
                            <li>
                                <img src="asset/service-details/step1.svg" class="step-icon" alt="icon">
                                <div class="step-desc-set">
                                    <h6>STEP 1</h6>
                                    <p>Book Meet & Assist quickly and easily online, at least 24 hours before your flight.</p>
                                </div>
                            </li>
                            <li>
                                <img src="asset/service-details/step2.svg" class="step-icon" alt="icon">
                                <div class="step-desc-set">
                                    <h6>STEP 2</h6>
                                    <p>Enter the airport you’re flying to, from or transiting through.</p>
                                </div>
                            </li>
                            <li>
                                <img src="asset/service-details/step3.svg" class="step-icon" alt="icon">
                                <div class="step-desc-set">
                                    <h6>STEP 3</h6>
                                    <p>Meet our representative and have a stress free journey.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="let-book-btn-set">
                    <button class="book-service-btn" onclick="openSearchService()">Let’s book a service</button>
                </div>
            </div>
        </section>
        <footer class="footer"></footer> <!-- FOOTER SECTION --> 
    </div>
    <div id="login_modal" class="modal fade" role="dialog"></div><!-- LOGIN MODAL -->

    <!-- CHOOSE TRAVEL MODAL -->
    <div id="book_service" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="banner_form">
                    <h4>What's your travel plan?</h4>
                    <form action="">
                        <div class="travel_types">
                            <div>
                                <input class="form_input-radio direct__flight-radio" type="radio" name="travel-type" value="has_no_transit" id="travel-1" onclick="setRadio('travel-1')" checked="checked">
                                <label class="form_radio-label" for="travel-1">Direct Flight</label>
                            </div>
                            <div>
                                <input class="form_input-radio" type="radio" name="travel-type" value="has_transit" id="travel-2" onclick="setRadio('travel-2')">
                                <label class="form_radio-label" for="travel-2">I have transits</label>
                            </div>
                        </div>
                        <div class="travel_details">
                            <div>
                                <label for="">From</label>
                                <input list="departure-terminal-list" id="departure-terminal" autocomplete="off">
                                <datalist class="data-terminal-list" id="departure-terminal-list"></datalist>
                                <!-- <div class="airport_list-dropbox">
                                    <ul class="airport_lists data-terminal-list_test" id="departure-terminal-list"></ul>
                                </div> -->
                                
                                <!-- <input type="text" value="Amsterdam Schipol International Airport"> -->
                            </div>
                            <div>
                                <label for="">To</label>
                                <input list="arrival-terminal-list" id="arrival-terminal" autocomplete="off">
                                <datalist class="data-terminal-list" id="arrival-terminal-list"></datalist>
                                <!-- <input type="text" value="Dubai International Airport"> -->
                            </div>
                            <div class="depart_details">
                                <div>
                                    <label for="">Flight Date</label>
                                    <input type="text" class="datepicker" id="depart-date" placeholder="DD-MMM-YYYY">
                                </div>
                                <div><span class="separator"></span></div>
                                <div>
                                    <label for="">Flight Number*</label>
                                    <input type="text" id="depart-flight-number" placeholder="Enter Flight Number">
                                </div>
                            </div>
                        </div>
                        <div class="btn_container">
                            <button type="button" class="primary-butn" onclick="searchServices()">Search service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <div class="service-filter-btn-set">
                            <button type="button" class="searc-btn" onclick="searchServices()">Search Service <i class="country-flg in"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/main.js<?php echo $cache_str; ?>" defer></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script for="Front-end">
        var today = new Date();
        var nextDay = new Date(today);
        nextDay.setDate(today.getDate() + 1);
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var dd = String(nextDay.getDate()).padStart(2, '0');
        var mm = nextDay.getMonth();
        var yyyy = nextDay.getFullYear();
        nextDay = dd + '-' + monthNames[mm] + '-' + yyyy;

        $( document ).ready(function() {
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

    <script for="Back-end">
        $( document ).ready(function() {
            var inputData = JSON.stringify({token: "<?php echo $service_token; ?>",currency: "INR"});
            $.ajax({
                async: false,
                url: 'php/services/read-one.php',
                data: inputData,
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;

                        $('.service-img').attr('src', responseData.image);
                        $('.service-name-view').text(responseData.name);
                        $('.service-price-view').text(responseData.price);

                        // For description
                        if (responseData.description != "") {
                            $('#business-description').text(responseData.description);
                            $('#business-description-div').css('display', 'block');
                        } else {
                            $('#business-description').text('');
                            $('#business-description-div').css('display', 'none');
                        }

                        // For service images
                        $('#service-images').empty();
                        if (responseData.images.length > 0) {
                            responseData.images.forEach(element => {
                                $('#service-images').append(`<div class="items">
                                    <div class="service-poster-img-set">
                                        <img src="${element}" class="about-poster-img" alt="poster">
                                    </div>
                                </div>`);
                            });

                            if (responseData.images.length > 3) {
                                // our partners owl-carousel
                                var owl = $('#service-images');
                                owl.owlCarousel({
                                    margin: 10,
                                    loop: true,
                                    center:true,
                                    nav:true,
                                    dots:false,
                                    navigation: true,
                                    navText: ["<img src='asset/service-details/left-arrow.svg' class='carousel-btn'>","<img src='asset/service-details/right-arrow.svg' class='carousel-btn'>"],
                                    responsive: {
                                        0: {
                                            items: 1
                                        },
                                        500: {
                                            items: 2
                                        },
                                        800: {
                                            items: 3
                                        },
                                        1600: {
                                            items: 4
                                        }
                                    }
                                });
                            }
                            
                            $('#service-images').css('display', 'block');
                        } else {
                            $('#service-images').css('display', 'none');
                        }

                        // For avail services
                        $('#avail-services').empty();
                        if (responseData.avail_services.length > 0) {
                            responseData.avail_services.forEach(element => {
                                $('#avail-services').append(`<div class="service-ach-list-items">
                                    <img src="${element.image}" alt="${element.name}" class="cust-service-poster" alt="poster img" />
                                    <div class="service-name">
                                        <h4>${element.name}</h4>
                                    </div>
                                </div>`);
                            });
                            
                            $('#avail-services-div').css('display', 'block');
                        } else {
                            $('#avail-services-div').css('display', 'none');
                        }

                        // For services includes
                        $('#service-included').empty();
                        if (responseData.services.length > 0) {
                            responseData.services.forEach(element => {
                                $('#service-included').append(`<li>
                                    <p>${element}</p>
                                </li>`);
                            });
                            
                            $('#service-included-div').css('display', 'block');
                        } else {
                            $('#service-included-div').css('display', 'none');
                        }

                        // For elite partners
                        $('#elite-partners').empty();
                        if (responseData.partners.length > 0) {
                            responseData.partners.forEach(element => {
                                $('#elite-partners').append(`<li>
                                    <img src="${element.image}" alt="${element.name}" class="elit-partner-logo" alt="icon">
                                </li>`);
                            });
                            
                            $('#elite-partners-div').css('display', 'block');
                        } else {
                            $('#elite-partners-div').css('display', 'none');
                        }
                    } else {
                        swal(response.message);
                    }
                }
            });
        });

        var commonTerminals = [];
        var departureTerminals = [];
        var transitTerminals = [];
        var arrivalTerminals = [];
        $( document ).ready(function() {
            $('#arrival-terminal-list').empty();
            $('#departure-terminal-list').empty();
            $('#gallery-list').empty();

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

            $.ajax({
                async: false,
                url: 'php/services/read.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        responseData.forEach(function(serviceObj) {
                            var serviceImage = (serviceObj.image!='')? serviceObj.image: 'asset/home/service1.png';
                            $('#gallery-list').append(`<div class="gallaery-list">
                                <img src="${serviceImage}" class="service-poster" alt="poster">
                                <div class="service-desc">
                                    <div class="service-price">
                                        <h4>${serviceObj.name}</h4>
                                        <p style="display: none;">From ₹ ${serviceObj.price}</p>
                                    </div>
                                    <a href="service-details.php?id=${serviceObj.token}" class=""><img src="asset/home/next.svg" class="next-icon" alt="icon"></a>
                                </div>
                            </div>`);
                        });
                    }
                }
            });
        });

        function openSearchService() {
            const directFlightRadio = document.querySelector('#travel-1');
            directFlightRadio.checked = true;
            
            // var travelType = $('input[name="travel-type"]:checked').val();
            // if (travelType == "has_transit") {
            //     $('#book_service').modal('hide');
            //     $('#add_airport_modal').modal('show');
            // } else {
                $('#book_service').modal('show');
            //     $('#add_airport_modal').modal('hide');
            // }
        }

        function setRadio(id) {
            document.getElementById(id).checked = true;
            var travelType = $('input[name="travel-type"]:checked').val();
            if (travelType == "has_transit") {
                $('#book_service').modal('hide');
                $('#add_airport_modal').modal('show');
            }
        }

        function searchServices1() {
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

        function searchServices() {
            var travelType = $('input[name="travel-type"]:checked').val();
            var hasDataError = false;
            var hasFlightNumberError = false;
            var journeyArray = [];

            if (travelType == 'has_no_transit') {
                var departureTerminalStr = $('#departure-terminal').val();
                var arrivalTerminalStr = $('#arrival-terminal').val();
                var departFlightNumber = $('#depart-flight-number').val().trim();

                var departTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==departureTerminalStr);
                var arrivalTerminalIndex = commonTerminals.findIndex(x => x.terminal_string==arrivalTerminalStr);
                
                if (departTerminalIndex > -1 && arrivalTerminalIndex > -1 && departFlightNumber != '') {
                    var journeyObj = {};
                    journeyObj.departure_ttr_token = commonTerminals[departTerminalIndex].ttr_token;
                    journeyObj.arrival_ttr_token = commonTerminals[arrivalTerminalIndex].ttr_token;
                    journeyObj.departure_date = $('#depart-date').val();
                    journeyObj.flight_number = departFlightNumber;
                    journeyArray.push(journeyObj);
                } else if(departFlightNumber == '') {
                    hasFlightNumberError = true;
                } else{
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
                
                    if (departTerminalIndex > -1 && arrivalTerminalIndex > -1 && departFlightNumber != '') {
                        var journeyObj = {};
                        journeyObj.departure_ttr_token = commonTerminals[departTerminalIndex].ttr_token;
                        journeyObj.arrival_ttr_token = commonTerminals[arrivalTerminalIndex].ttr_token;
                        journeyObj.departure_date = $('#depart-date-' + i).val();
                        journeyObj.flight_number = departFlightNumber;
                        journeyArray.push(journeyObj);
                    } else if(departFlightNumber == '') {
                        hasFlightNumberError = true;
                    } else{
                        hasDataError = true;
                    }
                }
            }
            
            if (hasDataError) {
                swal('Please select valid airport stations');
            } else if (hasFlightNumberError) {
                swal('Please check flight number');
            } else {
                var inputData = {"journey_array": journeyArray, "has_specific_service": true, "service_token": "<?php echo $service_token; ?>"};
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
    </script>
</body>
</html>