<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Checkout</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
    <style>
        .remove-coupon {
            min-width: unset;
            padding: 4px 8px;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <!--LOADER-->
        <div id="loading"></div>

        <!-- NAV MENU -->
        <nav></nav>

        <section class="cart-sec">
            <input type="hidden" id="gtag_id">
            <div class="container">
                <a href="choose-service.php" class="back-arrow">&larr; back</a>
                <div class="bookhisty-main-set">
                    <div class="bookhisty-left">
                        <div class="bookhisty-left-inner-set">
                            <div class="bookhisty-header">
                                <h2>MAA - DXB - FRA</h2>
                                <p>25 Jul, 2022 (6:30 PM) to 05 Aug, 2022 (11:00 AM)</p>
                                <div class="header-division"></div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-content" id="cart-list"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bookhisty-right">
                        <div class="bookhisty-inner-set">
                            <p>pay using:
                                <span class="payment__currency-type" data-toggle="modal" data-target="#currency_modal">
                                    <img id="currency-flag" src="asset/flag/in.png" alt="flag icon">
                                    <span id="currency-view">INR (₹)</span>
                                </span>
                            </p>
                            <div class="price-details-set">
                                <h4>Price Details</h4>
                                <div class="price-summary">
                                    <div class="price-summary-details">
                                        <p>Service Cost</p>
                                        <p><span id="service-cost">0</span></p>
                                    </div>
                                    <div class="price-summary-details discount_amount hidden">
                                        <p>Discount Amount</p>
                                        <p><span id="discount-amount">0</span></p>
                                        <button class="remove-coupon sec-btn">Remove</button>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>GST</p>
                                        <p><span id="gst-amount"></span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee</p>
                                        <p><span id="convenience-fee"></span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee GST</p>
                                        <p><span id="convenience-fee-gst"></span></p>
                                    </div>
                                    <div class="checkout-set">
                                        <a style="display: none; float: right; cursor: pointer; color: var(--secondary-color)"
                                            id="add-convenience">+ Add Convenience Fee</a>
                                        <button class="convenience-btn" id="remove-convenience">Remove Convenience
                                            Fee</button>
                                    </div>
                                </div>
                                <div class="summary-division"></div>
                                <div class="total-amt-set">
                                    <p>Total Amount</p>
                                    <p id="total-amount"></p>
                                </div>
                                <div class="checkout-set">
                                    <button class="checkout-btn">Checkout</button>
                                </div>
                            </div>
                            <!-- <div class="earning-widget-set">
                                <img src="asset/choose-service/flight-coin.png" class="flight-icon" alt="icon">
                                <p>You have earned <span>65 coins</span> with this order</p>
                            </div> -->
                            <!-- <div class="point-redeem-set">
                                <img src="asset/checkout/redeem.svg" class="redeem-icon" alt="icon">
                                <div class="redeem-note-set">
                                    <h2>Redeem</h2>
                                    <p>You can save <span>₹ 540</span> with this order by <br> redeeming <span>540 coins</span></p>
                                    <a href="javascript:void(0)">Redeem Now</a>
                                </div>
                            </div> -->
                            <!------Coupon Modal------>
                            <div class="redeem-coupon">
                                <div class="point-redeem-set">
                                    <img src="asset/checkout/redeem.svg" class="redeem-icon" alt="icon">
                                    <div class="redeem-note-set">
                                        <h2>Redeem Coupon</h2>
                                    </div>
                                </div>

                                <div style="margin:auto;width:90%;">
                                    <div class="input-form-group-item">
                                        <div class="input-box-set">
                                            <p>Enter Coupon code <span></span></p>
                                            <input type="text" class="input-box" id="coupon_code"
                                                placeholder="AA1220099">
                                        </div>
                                    </div>

                                    <div class="flex fl-align-center" style="justify-content:space-between;">
                                        <p class="btn-text" data-target="#coupon_modal" data-toggle="modal">View all
                                            coupon</p>
                                        <button class="sec-btn coupon_btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <!------Coupon Modal------>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer"></footer>

        <!-- LOGIN MODAL -->
        <div id="login_modal" class="modal fade" role="dialog"></div>

        <!-- CURRENCY Modal -->
        <div id="currency_modal" class="modal fade currency-popup" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div> -->
                    <div class="modal-body">
                        <div class="currency__container">
                            <div class="currency__dropdown-box">
                                <div class="currency_flag">
                                    <img class="flag-icon" src="asset/flag/in.png" alt="flag icon">
                                </div>
                                <div class="currency_detail">
                                    <label>currency</label>
                                    <p class="currency_name">INR <span class="currency_symbol"></span></p>
                                </div>
                                <ul class="currency__drop-list hidden" id="currency">
                                    <li class="currency__drop-item" data-flag="in"
                                        onclick="changeCurrency('INR', 'in')">INR</li>
                                    <li class="currency__drop-item" data-flag="usa"
                                        onclick="changeCurrency('USD', 'usa')">USD</li>
                                </ul>
                            </div>
                            <div class="amount__details">
                                <h3>Total Amount</h3>
                                <h1><span class="currency_symbol" id="currency-amount">₹ 10000</span></h1>
                                <p><img src="asset/choose-service/info.svg" alt=""> The display currency is tentative
                                </p>
                            </div>
                            <div>
                                <button class="primary-butn" data-dismiss="modal">Okay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Modal -->
        <div id="add_note" class="modal fade add-note-popup" role="dialog">
            <div class="modal-dialog top-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center">Add Notes</h3>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                        <img src="asset/choose-service/close-white.svg" class="close close-modal" alt="close icon" data-dismiss="modal" aria-label="Close">
                    </div>
                    <div class="modal-body">
                        <textarea name="" id="notes" cols="30" rows="10" placeholder="Your message..."></textarea>
                        <div class="text-center">
                            <button class="cust-btn btn-green" onclick="saveNotes()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Convenience Fee Modal -->
        <div id="add-convenience-modal" class="modal fade add-note-popup" role="dialog">
            <div class="modal-dialog top-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center">Convenience Fee</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="number" id="custom-convenience"
                            placeholder="Enter convenience fee for the booking.." autocomplete="off" />
                        <div class="text-center">
                            <button class="cust-btn btn-green" onclick="saveConvenience()">Add Convenience Fee</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List Coupon Modal -->
        <div id="coupon_modal" class="modal fade add-note-popup" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-lg top-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center">Coupons</h3>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="couponModalClose()">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                        <img src="asset/choose-service/close-white.svg" class="close close-modal" alt="close icon" data-dismiss="modal" aria-label="Close" onclick="couponModalClose()">
                    </div>
                    <div class="modal-body">
                        <div class="coupon">
                            <ul class="coupon__list" id="available-coupon"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------List Coupon------>
    </div>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script for="Front-end">
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
    </script>
    <script for="Back-end">
        var availCouponIndex = 0;
        var adultCount = 0;
        var childrenCount = 0;
        var addedServiceCount = 0;
        var globalStationData;
        var selectedCartArr = [];

        var hasConvenience = false;
        var customConvenienceFee = 0;

        var tempStationKey = 0;
        var tempServiceKey = 0;
        var tempCollectionKey = 0;
        var tempCollectionServiceKey = 0;

        var tempNotesSelectorBtn = false;
        new_array = [];
        service_coupon_detail = [];
        var reedeem_code = false;
        var checkService_status = true;
        var checkService_location = false;
        
        var currencySelected = "INR";
        $(document).ready(function () {
            if (isAgent) {
                if (localStorage.getItem("hasConvenience") !== null) {
                    hasConvenience = localStorage.getItem("hasConvenience") == "false" ? false : true;
                    customConvenienceFee = parseInt(localStorage.getItem("customConvenienceFee"));
                }
            } else {
                $('#add-convenience').remove();
                $('#remove-convenience').remove();
            }

            var jsonServiceData = sessionStorage.getItem("jsonServiceData");
            if (jsonServiceData && jsonServiceData != '') {
                globalStationData = JSON.parse(jsonServiceData);

                globalStationData.forEach(function (stationObj, stationKey) {
                    var selectedServiceArr = [];
                    stationObj.service_collection.forEach(function (serviceColObj, serviceColKey) {
                        serviceColObj.service_group.forEach(function (serviceGrpObj, serviceGrpKey) {
                            serviceGrpObj.service_array.forEach(function (serviceObj, serviceKey) {
                                if (serviceObj.isSelected) {
                                    serviceObj.stationKey = stationKey;
                                    serviceObj.serviceColKey = serviceColKey;
                                    serviceObj.serviceGrpKey = serviceGrpKey;
                                    serviceObj.serviceKey = serviceKey;
                                    selectedServiceArr.push(serviceObj);
                                }
                            });
                        });
                    });
                    if (selectedServiceArr.length > 0) {
                        var selectedServiceStation = JSON.parse(JSON.stringify(stationObj));
                        selectedServiceStation.selected_service_count = selectedServiceArr.length;
                        selectedServiceStation.service_collection = selectedServiceArr;

                        selectedCartArr.push(selectedServiceStation);
                    }
                });

                var headerTitles = [];
                var headerDates = [];
                $('#cart-list').empty();
                // var totalServiceCost = 0;
                selectedCartArr.forEach(function (selectedCartObj, selectedCartKey) {
                    if(selectedCartObj.location_check == '0' && checkService_status == true){
                        checkService_location = true;
                    }else if(selectedCartObj.location_check == '1'){
                        checkService_status = false;
                        checkService_location = false;
                    }
                    headerTitles.push(selectedCartObj.airport_code);
                    if (headerDates.indexOf(selectedCartObj.service_collection[0].service_date) < 0 && selectedCartObj.service_collection[0].service_date != '') {
                        headerDates.push(selectedCartObj.service_collection[0].service_date);
                    }
                    var hasServices = false;

                    var gmtView = selectedCartObj.gmt_view;
                    gmtView = (gmtView && gmtView != '') ? ' (GMT ' + gmtView + ')' : '';

                    var selectedItems = `<div class="booked-service-set">
                        <div class="service-header">
                            <h4>${selectedCartObj.airport_code}</h4>
                            <p>${selectedCartObj.airport_name} - ${selectedCartObj.terminal_name}</p>
                            <h3>${selectedCartObj.service_collection[0].service_date} ${selectedCartObj.service_collection[0].service_time}${gmtView}</h3>
                        </div>`;
                    // <h3>${stationObj.service_date} ${stationObj.service_time}</h3>
                    selectedCartObj.service_collection.forEach(function (serviceObj, serviceKey) {
                        new_array.push(serviceObj.service_token);
                        if (serviceObj.isSelected) {
                            addedServiceCount++;

                            var companyLogo = (serviceObj.sp_company_logo != '') ? serviceObj.sp_company_logo : 'asset/mybooking/service-logo.png';
                            adultCount = (adultCount > serviceObj.adult_count) ? adultCount : serviceObj.adult_count;
                            childrenCount = (childrenCount > serviceObj.children_count) ? childrenCount : serviceObj.children_count;
                            var total_amount = 0;
                            if (serviceObj.additional_price_adult > 0 && serviceObj.adult_count > 1) {
                                total_amount += (serviceObj.price_adult + ((serviceObj.adult_count - 1) * serviceObj.additional_price_adult));
                            } else {
                                total_amount += serviceObj.adult_count * serviceObj.price_adult;
                            }
                            if (serviceObj.additional_price_children > 0 && serviceObj.children_count > 1) {
                                total_amount += (serviceObj.price_children + ((serviceObj.children_count - 1) * serviceObj.additional_price_children));
                            } else {
                                total_amount += serviceObj.children_count * serviceObj.price_children;
                            }
                            // if (total_amount) {
                            //     totalServiceCost += total_amount;
                            // }
                            let category_discount = {
                                "business_token": serviceObj.unique_business_token,
                                "service_type": serviceObj.service_type,
                                "total_amount": total_amount
                            };
                            service_coupon_detail.push(category_discount);
                            var countView = [];
                            if (serviceObj.adult_count > 0) {
                                countView.push(serviceObj.adult_count + ' Adults');
                            }
                            if (serviceObj.children_count > 0) {
                                countView.push(serviceObj.children_count + ' Children');
                            }
                            var notesEditor = (serviceObj.notes && serviceObj.notes != '') ? `Edit Notes` : `Add Notes`;

                            hasServices = true;
                            selectedItems += `<div class="product-desc-set">
                                    <div class="product-desc-inner-set">
                                        <div class="prod-log-set">
                                            <img src="${companyLogo}" class="prod-logo" alt="">
                                        </div>
                                        <div class="prod-price-desc">
                                            <div class="prod-name-id-feedback-set">
                                                <div class="prod-name-id-set">
                                                    <h2>${serviceObj.sp_company_name}</h2>
                                                    <p>${serviceObj.service_name} | ${serviceObj.service_time}${gmtView}</p>
                                                </div>
                                                <div class="prod-feedback-set">
                                                    <img src="asset/checkout/edit-icon.svg" class="edit-icon hidden" alt="icon">
                                                    <img src="asset/checkout/close-gray.svg" class="close-icon" data-station-key="${serviceObj.stationKey}" data-service-key="${serviceObj.serviceColKey}" data-collection-key="${serviceObj.serviceGrpKey}" data-collection-service-key="${serviceObj.serviceKey}" data-selected-cart-key="${selectedCartKey}" alt="icon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="prodtype-price-count-earnings-set">
                                        <div class="prod-type-price-set">
                                            <p>${serviceObj.business_names.join(", ")}</p>
                                            <h6>₹ ${total_amount}</h6>
                                        </div>
                                        <div class="ser-count-earnings">
                                            <p>${countView.join(" & ")}</p>
                                        </div>
                                        <p style="cursor: pointer; color: var(--color-primary);" class="notes-icon" id="notes-${serviceObj.stationKey}-${serviceObj.serviceColKey}-${serviceObj.serviceGrpKey}-${serviceObj.serviceKey}-${selectedCartKey}" data-station-key="${serviceObj.stationKey}" data-service-key="${serviceObj.serviceColKey}" data-collection-key="${serviceObj.serviceGrpKey}" data-collection-service-key="${serviceObj.serviceKey}">${notesEditor}</p>
                                    </div>
                                </div>`;
                        }
                    });
                    // <p style="cursor: pointer; color: var(--color-primary);" id="notes-${selectedCartKey}-${serviceKey}" onclick="makeNotes(${selectedCartKey}, ${serviceKey})">Add Notes</p>
                    selectedItems += `</div>`;
                    if (hasServices) $('#cart-list').append(selectedItems);
                });
                console.log(checkService_location);
                calcTotalCost();
                $('.bookhisty-header>h2').html(headerTitles.join(" - "));
                var journeyPeriod = '';
                if (headerDates.length > 1) {
                    journeyPeriod = 'From ' + headerDates[0] + ' to ' + headerDates[headerDates.length - 1];
                } else {
                    journeyPeriod = headerDates[0];
                }
                $('.bookhisty-header>p').html(journeyPeriod);

                $('.close-icon').on('click', function () {
                    if (addedServiceCount > 1) {
                        tempStationKey = $(this).attr('data-station-key');
                        tempServiceKey = $(this).attr('data-service-key');
                        tempCollectionKey = $(this).attr('data-collection-key');
                        tempCollectionServiceKey = $(this).attr('data-collection-service-key');

                        var tempSelectedCartKey = $(this).attr('data-selected-cart-key');

                        var parentSelector = $(this).closest('.booked-service-set');

                        globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].isSelected = false;
                        $(this).closest('.product-desc-set').remove();

                        selectedCartArr[tempSelectedCartKey].selected_service_count--;
                        if (selectedCartArr[tempSelectedCartKey].selected_service_count < 1) {
                            parentSelector.remove();
                        }
                        addedServiceCount--;

                        $('.cart-count').text(addedServiceCount);

                        // $('.service-id').text(addedServiceCount + ' Service');
                        if ($('#my_cart')) $('#my_cart').attr('onclick', 'location.href="checkout.php"');

                        calcTotalCost();
                    } else {
                        // alert('Service cannot be empty !');
                        swal({
                            text: "Service cannot be empty !",
                            icon: "warning",
                        });
                    }
                });

                $('.notes-icon').on('click', function () {
                    tempStationKey = $(this).attr('data-station-key');
                    tempServiceKey = $(this).attr('data-service-key');
                    tempCollectionKey = $(this).attr('data-collection-key');
                    tempCollectionServiceKey = $(this).attr('data-collection-service-key');

                    tempNotesSelectorBtn = $(this).attr('id');

                    var prevNotes = globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].hasOwnProperty('notes') ? globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].notes : "";
                    document.getElementById("notes").value = prevNotes;
                    $('#add_note').modal("show");
                });
            } else {
                // alert("Cannot find the added services ! Please add again !");
                swal({
                    // title: "Good job!",
                    text: "Cannot find the added services ! Please add again !",
                    icon: "info",
                }).then(function () {
                    window.location.href = 'index.php';
                });
            }
            // go to checkout process page
            $('.checkout-btn').on('click', function () {
                var usr_exist = $('body').attr('data-usr-token');
                if (usr_exist != '' && usr_exist != 0) {
                    calcTotalCost();
                    window.location.href = 'checkout-process.php';
                } else {
                    isOnCheckout = true;
                    $('#login_modal').modal({
                        show: 'false'
                    });
                }
                // window.location.href = 'checkout-process.html';
            });
            // setTimeout(function() { $('#loading').fadeOut(); }, 500 );

            $('#remove-convenience').on('click', function () {
                hasConvenience = false;
                customConvenienceFee = 0;

                localStorage.setItem("hasConvenience", false);
                localStorage.setItem("customConvenienceFee", 0);

                calcTotalCost();
                $(this).css('display', 'none');
                $('#add-convenience').css('display', 'block');
                $('#custom-convenience').val('');
            });

            $('#add-convenience').on('click', function () {
                $('#add-convenience-modal').modal({
                    backdrop: false
                });
            });

            $('#available-coupon').empty();
            $.ajax({
                async: false,
                url: 'php/users-booking/available-coupon.php',
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if (response.status_code == 200) {
                        response.data.forEach(function (availCouponData, index) {
                            availCouponIndex = index;
                            $('#available-coupon').append(`<li class="coupon__box">
                                <div class="coupon__content">
                                    <h4 class="coupon__header">${availCouponData.name}</h4>
                                    <p class="coupon__description">${availCouponData.description}</p>
                                    <div class="coupon__validity">
                                        <p>Valid till</p>
                                        <p class="coupon__date">${availCouponData.to_date}</p>
                                    </div>
                                </div>
                                    <div class="coupon__code-box">
                                        <h3 class="coupon__code">${availCouponData.code}</h3>
                                        <span class="coupon__icon-box" onclick="copyText('${availCouponData.code}','replaceimage${index}')" id="replaceimage${index}">
                                            <svg width="21px" height="24px" viewBox="0 0 21 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>copy paste</title>
                                                <g id="copy-paste" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <path d="M15,1 L3,1 C1.895,1 1,1.895 1,3 L1,17 L3,17 L3,3 L15,3 L15,1 Z M18,5 L7,5 C5.895,5 5,5.895 5,7 L5,21 C5,22.105 5.895,23 7,23 L18,23 C19.105,23 20,22.105 20,21 L20,7 C20,5.895 19.105,5 18,5 Z M18,21 L7,21 L7,7 L18,7 L18,21 Z" id="copy-icon" fill="#84BC42" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                            </li>`);
                        });
                    } else {
                        $('.redeem-coupon').css("display", "none");
                    }

                    const couponContainer = document.querySelector('.coupon');
                    const couponIconsBox = document.querySelectorAll('.coupon__icon-box');
                    couponContainer.addEventListener('click', function (e) {
                        const clicked = e.target.closest('.coupon__code-box');
                        if (!clicked) return;

                        const couponCode = clicked.querySelector('.coupon__code').textContent
                        navigator.clipboard.writeText(couponCode); // copy the clicked code to clipboard

                        couponIconsBox.forEach(icon => icon.innerHTML = `<svg width="21px" height="24px" viewBox="0 0 21 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <title>copy paste</title>
                                                                            <g id="copy-paste" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <path d="M15,1 L3,1 C1.895,1 1,1.895 1,3 L1,17 L3,17 L3,3 L15,3 L15,1 Z M18,5 L7,5 C5.895,5 5,5.895 5,7 L5,21 C5,22.105 5.895,23 7,23 L18,23 C19.105,23 20,22.105 20,21 L20,7 C20,5.895 19.105,5 18,5 Z M18,21 L7,21 L7,7 L18,7 L18,21 Z" id="copy-icon" fill="#84BC42" fill-rule="nonzero"></path>
                                                                            </g>
                                                                        </svg>`);
                        clicked.querySelector('.coupon__icon-box').innerHTML = `<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                    <title>tick</title>
                                                                                    <g id="tick" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <g id="tick-icon" transform="translate(1.000000, 1.000000)" fill="#84BC42" fill-rule="nonzero">
                                                                                            <path d="M11,0 C4.92486775,0 0,4.92486775 0,11 C0,17.0751322 4.92486775,22 11,22 C17.0751322,22 22,17.0751322 22,11 C22,8.08261861 20.8410748,5.28472557 18.7781746,3.22182541 C16.7152744,1.15892524 13.9173814,0 11,0 L11,0 Z M16.707,8.707 L9.707,15.707 C9.31650015,16.0973819 8.68349985,16.0973819 8.293,15.707 L5.293,12.707 C4.91402779,12.3146211 4.91944763,11.6909152 5.30518142,11.3051814 C5.69091522,10.9194476 6.31462111,10.9140278 6.707,11.293 L9,13.586 L15.293,7.293 C15.6853789,6.91402779 16.3090848,6.91944763 16.6948186,7.30518142 C17.0805524,7.69091522 17.0859722,8.31462111 16.707,8.707 Z" id="Shape"></path>
                                                                                        </g>
                                                                                    </g>
                                                                                </svg>`;
                    });
                }
            });
        });

        // function copyText(couponCode, id) {
        //     navigator.clipboard.writeText(couponCode);
        //     document.getElementById(id).innerHTML = `<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        //                                                                     <title>tick</title>
        //                                                                     <g id="tick" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        //                                                                         <g id="tick-icon" transform="translate(1.000000, 1.000000)" fill="#84BC42" fill-rule="nonzero">
        //                                                                             <path d="M11,0 C4.92486775,0 0,4.92486775 0,11 C0,17.0751322 4.92486775,22 11,22 C17.0751322,22 22,17.0751322 22,11 C22,8.08261861 20.8410748,5.28472557 18.7781746,3.22182541 C16.7152744,1.15892524 13.9173814,0 11,0 L11,0 Z M16.707,8.707 L9.707,15.707 C9.31650015,16.0973819 8.68349985,16.0973819 8.293,15.707 L5.293,12.707 C4.91402779,12.3146211 4.91944763,11.6909152 5.30518142,11.3051814 C5.69091522,10.9194476 6.31462111,10.9140278 6.707,11.293 L9,13.586 L15.293,7.293 C15.6853789,6.91402779 16.3090848,6.91944763 16.6948186,7.30518142 C17.0805524,7.69091522 17.0859722,8.31462111 16.707,8.707 Z" id="Shape"></path>
        //                                                                         </g>
        //                                                                     </g>
        //                                                                 </svg>`;
        // }

        function couponModalClose() {
            for (i = 0; i <= availCouponIndex; i++) {
                document.getElementById("replaceimage" + i).innerHTML = `<svg width="21px" height="24px" viewBox="0 0 21 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <title>copy paste</title>
                                                                            <g id="copy-paste" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <path d="M15,1 L3,1 C1.895,1 1,1.895 1,3 L1,17 L3,17 L3,3 L15,3 L15,1 Z M18,5 L7,5 C5.895,5 5,5.895 5,7 L5,21 C5,22.105 5.895,23 7,23 L18,23 C19.105,23 20,22.105 20,21 L20,7 C20,5.895 19.105,5 18,5 Z M18,21 L7,21 L7,7 L18,7 L18,21 Z" id="copy-icon" fill="#84BC42" fill-rule="nonzero"></path>
                                                                            </g>
                                                                        </svg>`;
            }
        }

        function saveConvenience() {
            hasConvenience = true;
            customConvenienceFee = parseInt($('#custom-convenience').val().trim());

            localStorage.setItem("hasConvenience", true);
            localStorage.setItem("customConvenienceFee", customConvenienceFee);

            calcTotalCost();
            $('#add-convenience-modal').modal('hide');
        }

        function saveNotes() {
            var notes = document.getElementById("notes").value.trim();
            globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].notes = notes;

            var notesLabel = (notes != '') ? 'Edit Notes' : 'Add Notes';
            $('#' + tempNotesSelectorBtn).text(notesLabel);
            $('#add_note').modal("hide");

            document.getElementById("notes").value = "";
            sessionStorage.setItem("jsonServiceData", JSON.stringify(globalStationData));
        }

        function changeCurrency(currencyValue, countryCode) {
            currencySelected = currencyValue;
            let countryFlag = document.querySelector('.flag-icon');
            let displayCountryFlag = document.getElementById('currency-flag');
            countryFlag.src = displayCountryFlag.src = `asset/flag/${countryCode}.png`;
            calcTotalCost();
        }

        var discountAmount = 0;
        var sc_excl_gst = 0;
        var check_coupon_type = '';
        var check_type = '';
        function calcTotalCost() {
            var totalServiceCost = 0;
            var gstAmount = 0;
            var convenienceFee = 0;
            var convenienceFeeGst = 0;
            var totalAmount = 0;

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
                                // var serviceCostInclGst = (serviceGrpObj.adult_count * serviceObj.price_adult) + (serviceGrpObj.children_count * serviceObj.price_children);
                                if (serviceCostInclGst) {
                                    if (isAgent) {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                        var gstValue = (serviceCostInclGst * 100) / 118;
                                        gstAmount += gstValue;

                                        var tempConvenienceFee = 0;
                                        if (hasConvenience) {
                                            tempConvenienceFee = (tempConvenienceFee == 0) ? serviceCostInclGst * 0.0354 : tempConvenienceFee;
                                        }
                                        convenienceFee += tempConvenienceFee;

                                        var tempConvenienceFeeGst = 0;
                                        // $('#convenience-fee-gst').closest('.price-summary-details').remove();
                                    } else {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                        var gstValue = (serviceCostInclGst * 100) / 118;
                                        gstAmount += gstValue;
                                        var tempConvenienceFee = serviceCostInclGst;
                                        convenienceFee += tempConvenienceFee;
                                        var tempConvenienceFeeGst = tempConvenienceFee;
                                        convenienceFeeGst += tempConvenienceFeeGst;
                                    }
                                    // var netAmount = ((serviceCostInclGst * 100) / 118) - discountAmount + ((((serviceCostInclGst * 100) / 118) - discountAmount) * 0.18) + Math.round(tempConvenienceFee) + Math.round(tempConvenienceFeeGst);
                                    // console.log(netAmount);
                                    // totalAmount += netAmount;
                                }
                            }
                        });
                    });
                });
            });
            // gstAmount = Math.round(totalServiceCost * 0.18);
            // convenienceFee = Math.round((totalServiceCost + gstAmount) * 0.03);
            // convenienceFeeGst = Math.round(convenienceFee * 0.18);
            // totalAmount = Math.round(totalServiceCost + gstAmount + convenienceFee + convenienceFeeGst);
            if ((check_coupon_type == "Cart" && check_type == "Incl Gst") || (check_coupon_type == "Category" && check_type == "Incl Gst")) {
                totalServiceCost = Math.round(totalServiceCost) + Math.round(totalServiceCost * 0.18);
                totalServiceCost = Math.round((totalServiceCost - discountAmount) * 100 / 118);
                gstAmount = Math.round((totalServiceCost) * 0.18);
                if (customConvenienceFee > 0) {
                    convenienceFeeGst = 0;

                    convenienceFee = customConvenienceFee;
                    totalAmount = totalServiceCost + gstAmount + convenienceFee + Math.round(convenienceFeeGst);
                } else {
                    if(isAgent){
                        convenienceFee = 0;//Math.round((convenienceFee - discountAmount) * 0.03);
                    } else {
                        // convenienceFee = Math.round((convenienceFee - discountAmount) * 0.03);
                        convenienceFee = Math.round((totalServiceCost + gstAmount) * 0.03);
                    }
                }
                convenienceFeeGst = Math.round(convenienceFee * 0.18);
                totalAmount = totalServiceCost + gstAmount + convenienceFee + convenienceFeeGst;
            } else {
                totalServiceCost = Math.round(totalServiceCost - discountAmount);
                sc_excl_gst = totalServiceCost;
                gstAmount = Math.round((gstAmount - discountAmount) * 0.18);

                if (customConvenienceFee > 0) {
                    convenienceFeeGst = 0;

                    convenienceFee = customConvenienceFee;
                    totalAmount = totalServiceCost + gstAmount + convenienceFee + convenienceFeeGst;
                } else {
                    if(isAgent){
                        convenienceFee = 0;//Math.round((convenienceFee - discountAmount) * 0.03);
                    } else {
                        // convenienceFee = Math.round((convenienceFee - discountAmount) * 0.03);
                        convenienceFee = Math.round((totalServiceCost + gstAmount) * 0.03);
                    }
                }
                convenienceFeeGst = Math.round(convenienceFee * 0.18);
                totalAmount = totalServiceCost + gstAmount + convenienceFee + convenienceFeeGst;
            }

            var currencyAmount = "";
            var servicecost_value = "";
            var gstamountValue = "";
            var convenienceFeeValue = "";
            var convenienceFeeGSTValue = "";
            currencyAmount = "₹ " + totalAmount;
            var DiscountValue = "";
            $('#currency-view').text("INR (₹)");
            // if (currencySelected != "INR") {
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
                    var foreignCurrencyValue = "";

                    var foreignCurrencyValue = response * totalAmount;
                    foreignCurrencyValue = Math.round((foreignCurrencyValue + Number.EPSILON) * 100) / 100;

                    var service_cost = response * totalServiceCost;
                    service_cost = Math.round((service_cost + Number.EPSILON) * 100) / 100;

                    var gst_amount = response * gstAmount;
                    gst_amount = Math.round((gst_amount + Number.EPSILON) * 100) / 100;

                    var convenienceFeeAmount = response * convenienceFee;
                    convenienceFeeAmount = Math.round((convenienceFeeAmount + Number.EPSILON) * 100) / 100;

                    var convenienceFeeGSTAmount = response * convenienceFeeGst;
                    convenienceFeeGSTAmount = Math.round((convenienceFeeGSTAmount + Number.EPSILON) * 100) / 100;

                    var discountFeeAmount = response * discountAmount;
                    discountFeeAmount = Math.round((discountFeeAmount + Number.EPSILON) * 100) / 100;

                    switch (currencySelected) {
                        case "USD":
                            currencyAmount = "$ " + foreignCurrencyValue;
                            servicecost_value = "$ " + service_cost;
                            gstamountValue = "$ " + gst_amount;
                            convenienceFeeValue = "$ " + convenienceFeeAmount;
                            convenienceFeeGSTValue = "$ " + convenienceFeeGSTAmount;
                            DiscountValue = "$ " + discountFeeAmount;
                            $('#currency-view').text("USD ($)");
                            break;

                        default:
                            currencyAmount = "₹ " + totalAmount;
                            servicecost_value = "₹ " + service_cost;
                            gstamountValue = "₹ " + gst_amount;
                            convenienceFeeValue = "₹ " + convenienceFeeAmount;
                            convenienceFeeGSTValue = "₹ " + convenienceFeeGSTAmount;
                            DiscountValue = "₹ " + discountFeeAmount;
                            $('#currency-view').text("INR (₹)");
                            break;
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
            // }

            $('#service-cost').text(servicecost_value);
            $('#gst-amount').text(gstamountValue);
            $('#convenience-fee').text(convenienceFeeValue);
            $('#convenience-fee-gst').text(convenienceFeeGSTValue);

            if (isAgent) {
                if (hasConvenience) {

                    $('#add-convenience').css('display', 'none');
                    $('#remove-convenience').css('display', 'block');
                    $('#convenience-fee').closest('.price-summary-details').css('display', 'flex');
                    if (convenienceFeeGst > 0) {
                        $('#convenience-fee-gst').closest('.price-summary-details').css('display', 'flex');
                    } else {
                        $('#convenience-fee-gst').closest('.price-summary-details').css('display', 'none');
                    }
                } else {
                    $('#add-convenience').css('display', 'block');
                    $('#remove-convenience').css('display', 'none');
                    $('#convenience-fee').closest('.price-summary-details').css('display', 'none');
                    $('#convenience-fee-gst').closest('.price-summary-details').css('display', 'none');
                }
            }

            $('#total-amount').text(currencyAmount);
            $('#currency-amount').text(currencyAmount);
            $('#discount-amount').text(' - ' + DiscountValue);
            // $('.price-view').text(totalServiceCost);
            sessionStorage.setItem("jsonServiceData", JSON.stringify(globalStationData));
            sessionStorage.setItem("currencySelected", currencySelected);
            if (reedeem_code == false) {
                var JsonData = JSON.stringify([{ 'coupon__Code': "", 'coupon__type': "", 'coupon_status': 'false' }]);
                sessionStorage.setItem("couponData", JsonData);
            }
        }

        const removecoupon = document.querySelector('.remove-coupon');
        removecoupon.addEventListener('click', function () {
            discountAmount = 0;
            calcTotalCost();
            $('.discount_amount').addClass('hidden');
            $('.redeem-coupon').css("display", "block");

            var JsonData = JSON.stringify([{ 'coupon__Code': "", 'coupon__type': "", 'coupon_status': 'false' }]);
            sessionStorage.setItem("couponData", JsonData);
        });

        const currencyDropdownBox = document.querySelector('.currency__dropdown-box');
        const currencyDropdown = document.querySelector('.currency__drop-list');
        const currencies = document.querySelectorAll('.currency__drop-item');
        let currencyName = document.querySelector('.currency_name');

        currencyDropdownBox.addEventListener('click', function () {
            currencyDropdown.classList.toggle('hidden');
        });
        currencies.forEach(cur => {
            cur.addEventListener('click', function () {
                currencyName.textContent = cur.textContent;
            });
        });

        const couponButton = document.querySelector('.coupon_btn');
        couponButton.addEventListener('click', function () {
            var userexist = $('body').attr('data-usr-token');
            if (userexist && userexist != 0) {
                var couponCode = document.getElementById('coupon_code').value;
                if (couponCode != '') {
                    let newarray = new_array.join("','");
                    let serviceToken = 'IN(' + "'" + newarray + "'" + ')';
                    var inputJSONData = JSON.stringify({ 'couponCode': couponCode, 'serviceToken': serviceToken, 'user_token': userexist });
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: 'php/users-booking/coupon.php',
                        data: inputJSONData,
                        success: function (response) {
                            if (response.status_code == 200) {
                                console.log(response);
                                let coupon_Data = response.data;
                                check_coupon_type = coupon_Data.type;
                                var JsonData = JSON.stringify([{ 'coupon__Code': coupon_Data.code, 'coupon__type': coupon_Data.type, 'coupon_status': 'true' }]);
                                sessionStorage.setItem("couponData", JsonData);
                                reedeem_code = true;
                                coupon_discount_amt = 0;
                                if (coupon_Data.type == "Category") {
                                    service_coupon_detail.forEach(function (serviceValue, serviceKey) {
                                        response.categoryData.forEach(function (cat_value, index) {
                                            check_type = cat_value.gst_type;
                                            if(cat_value.gst_type == 'Incl Gst'){
                                                if (serviceValue.business_token.includes(cat_value.business_type_token)) {
                                                    if (cat_value.coupon_type == 'Percentage') {
                                                        coupon_discount_amt += parseInt((serviceValue.total_amount) * cat_value.discount_amount / 100);
                                                    } else if (cat_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cat_value.discount_amount);
                                                    }
                                                }
                                            } else {
                                                if (serviceValue.business_token.includes(cat_value.business_type_token)) {
                                                    if (cat_value.coupon_type == 'Percentage') {
                                                        coupon_discount_amt += parseInt((serviceValue.total_amount/1.18) * cat_value.discount_amount / 100);
                                                    } else if (cat_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cat_value.discount_amount);
                                                    }
                                                }
                                            }
                                        });
                                    });
                                } else {
                                    response.cartData.forEach(function (cart_value, index) {
                                        check_type = cart_value.gst_type;
                                        if (cart_value.gst_type == "Incl Gst") {
                                            if (cart_value.coupon_condition == "Greater Than Or Equal To") {
                                                var sc_cost = sc_excl_gst + Math.round(sc_excl_gst * 0.18);
                                                if (sc_cost >= cart_value.cart_dis_amt) {
                                                    if (cart_value.coupon_type == "Percentage") {
                                                        coupon_discount_amt += Math.round(sc_cost * cart_value.discount_amount / 100);
                                                    } else if (cart_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cart_value.discount_amount);
                                                    }
                                                } else {
                                                    coupon_discount_amt += 0;
                                                }
                                            } else {
                                                var sc_cost = sc_excl_gst + Math.round(sc_excl_gst * 0.18);
                                                if (sc_cost <= cart_value.cart_dis_amt) {
                                                    if (cart_value.coupon_type == "Percentage") {
                                                        coupon_discount_amt += Math.round(sc_cost * cart_value.discount_amount / 100);
                                                    } else if (cart_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cart_value.discount_amount);
                                                    }
                                                } else {
                                                    coupon_discount_amt += 0;
                                                }
                                            }
                                        } else {
                                            if (cart_value.coupon_condition == "Greater Than Or Equal To") {
                                                var sc_cost = sc_excl_gst;
                                                if (sc_cost >= cart_value.cart_dis_amt) {
                                                    if (cart_value.coupon_type == "Percentage") {
                                                        coupon_discount_amt += Math.round(sc_cost * cart_value.discount_amount / 100);
                                                    } else if (cart_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cart_value.discount_amount);
                                                    }
                                                } else {
                                                    coupon_discount_amt += 0;
                                                }
                                            } else {
                                                var sc_cost = sc_excl_gst;
                                                if (sc_cost <= cart_value.cart_dis_amt) {
                                                    if (cart_value.coupon_type == "Percentage") {
                                                        coupon_discount_amt += Math.round(sc_cost * cart_value.discount_amount / 100);
                                                    } else if (cart_value.coupon_type == 'Flat') {
                                                        coupon_discount_amt += parseInt(cart_value.discount_amount);
                                                    }
                                                } else {
                                                    coupon_discount_amt += 0;
                                                }
                                            }
                                        }
                                    });
                                }
                                discountAmount = coupon_discount_amt;
                                swal("", response.message, "success").then(function () {
                                    $('#coupon_code').val('');
                                    $('.discount_amount').removeClass('hidden');
                                    $('.redeem-coupon').css("display", "none");
                                    calcTotalCost();
                                });
                            } else {
                                swal("", response.message, "error");
                            }
                        }
                    });
                } else {
                    swal("", "Coupon Code Cant Be Empty!..", "error");
                }
            } else {
                isOnCheckout = false;
                $('#login_modal').modal({
                    show: 'false'
                });
            }
        });
    </script>
</body>

</html>