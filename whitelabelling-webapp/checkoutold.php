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
    <link rel="shortcut icon" href="asset/fav-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css"/>
    <link rel="stylesheet" href="css/fonts.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout.css<?php echo $cache_str; ?>">

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
                <a href="choose-service.php" class="back-arrow"><img src="asset/choose-service/back-arrow.png" class="back-arrow-icon" alt="back arrow"> back</a>
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
                                    <div class="price-summary-details">
                                        <p>GST</p>
                                        <p><span id="gst-amount">0</span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee</p>
                                        <p><span id="convenience-fee">0</span></p>
                                    </div>
                                    <div class="price-summary-details">
                                        <p>Convenience Fee GST</p>
                                        <p><span id="convenience-fee-gst">0</span></p>
                                    </div>
                                    <div class="checkout-set">
                                        <a style="display: none; float: right; cursor: pointer; color: var(--secondary-color)" id="add-convenience">+ Add Convenience Fee</a>
                                        <button class="convenience-btn" id="remove-convenience">Remove Convenience Fee</button>
                                    </div>
                                    <div id="markup-label" style="display: none;">
                                        <p>MarkUp Percentage</p>
                                        <p><span id="markup-percentage">0</span></p>
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
                                    <li class="currency__drop-item" data-flag="in" onclick="changeCurrency('INR', 'in')">INR</li>
                                    <li class="currency__drop-item" data-flag="usa" onclick="changeCurrency('USD', 'usa')">USD</li>
                                </ul>
                            </div>
                            <div class="amount__details">
                                <h3>Total Amount</h3>
                                <h1><span class="currency_symbol" id="currency-amount">₹ 10000</span></h1>
                                <p><img src="asset/choose-service/info.svg" alt=""> The display currency is tentative</p>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                        <input type="number" id="custom-convenience" placeholder="Enter convenience fee for the booking.." autocomplete="off"/>
                        <div class="text-center">
                            <button class="cust-btn btn-green" onclick="saveConvenience()">Add Convenience Fee</button>
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
        var adultCount = 0;
        var childrenCount = 0;
        var addedServiceCount = 0;
        var globalStationData;
        var selectedCartArr = [];

        var hasConvenience = true;
        var customConvenienceFee = 0;

        var tempStationKey = 0;
        var tempServiceKey = 0;
        var tempCollectionKey = 0;
        var tempCollectionServiceKey = 0;

        var tempNotesSelectorBtn = false;

        var currencySelected = "INR";
        $(document).ready(function () {
            if (isAgent) {
                if (localStorage.getItem("hasConvenience") !== null) {
                    hasConvenience = localStorage.getItem("hasConvenience") == "false"? false: true;
                    customConvenienceFee = parseInt(localStorage.getItem("customConvenienceFee"));
                }
            } else {
                $('#add-convenience').remove();
                $('#remove-convenience').remove();
            }

            var jsonServiceData = sessionStorage.getItem("jsonServiceData");
            if (jsonServiceData && jsonServiceData!='') {
                globalStationData = JSON.parse(jsonServiceData);

                globalStationData.forEach(function(stationObj, stationKey) {
                    var selectedServiceArr = [];
                    stationObj.service_collection.forEach(function(serviceColObj, serviceColKey) {
                        serviceColObj.service_group.forEach(function(serviceGrpObj, serviceGrpKey) {
                            serviceGrpObj.service_array.forEach(function(serviceObj, serviceKey) {
                                if(serviceObj.isSelected) {
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
                selectedCartArr.forEach(function(selectedCartObj, selectedCartKey) {
                    headerTitles.push(selectedCartObj.airport_code);
                    if (headerDates.indexOf(selectedCartObj.service_collection[0].service_date) < 0 && selectedCartObj.service_collection[0].service_date != '') {
                        headerDates.push(selectedCartObj.service_collection[0].service_date);
                    }
                    var hasServices = false;

                    var gmtView = selectedCartObj.gmt_view;
                    gmtView = (gmtView && gmtView!='')? ' (GMT ' + gmtView + ')': '';

                    var selectedItems = `<div class="booked-service-set">
                        <div class="service-header">
                            <h4>${selectedCartObj.airport_code}</h4>
                            <p>${selectedCartObj.airport_name} - ${selectedCartObj.terminal_name}</p>
                            <h3>${selectedCartObj.service_collection[0].service_date} ${selectedCartObj.service_collection[0].service_time}${gmtView}</h3>
                        </div>`;
                            // <h3>${stationObj.service_date} ${stationObj.service_time}</h3>
                        selectedCartObj.service_collection.forEach(function(serviceObj, serviceKey) {
                            if(serviceObj.isSelected) {
                                addedServiceCount++;

                                var companyLogo = (serviceObj.sp_company_logo != '')? serviceObj.sp_company_logo: 'asset/mybooking/service-logo.png';
                                adultCount = (adultCount > serviceObj.adult_count)? adultCount: serviceObj.adult_count;
                                childrenCount = (childrenCount > serviceObj.children_count)? childrenCount: serviceObj.children_count;
                                var total_amount = 0;
                                if (serviceObj.additional_price_adult > 0 && serviceObj.adult_count > 1) {
                                    total_amount += (serviceObj.price_adult + ((serviceObj.adult_count-1) * serviceObj.additional_price_adult));
                                }else{
                                    total_amount += serviceObj.adult_count * serviceObj.price_adult;
                                }
                                if (serviceObj.additional_price_children > 0 && serviceObj.children_count > 1) {
                                    total_amount += (serviceObj.price_children + ((serviceObj.children_count-1) * serviceObj.additional_price_children));
                                }else{
                                    total_amount += serviceObj.children_count * serviceObj.price_children;
                                }
                                // if (total_amount) {
                                //     totalServiceCost += total_amount;
                                // }
                                var countView = [];
                                if (serviceObj.adult_count > 0) {
                                    countView.push(serviceObj.adult_count + ' Adults');
                                }
                                if (serviceObj.children_count > 0) {
                                    countView.push(serviceObj.children_count + ' Children');
                                }
                                var notesEditor = (serviceObj.notes && serviceObj.notes != '')? `Edit Notes`: `Add Notes`;

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
                    if(hasServices) $('#cart-list').append(selectedItems);
                });
                calcTotalCost();
                $('.bookhisty-header>h2').html(headerTitles.join(" - "));
                var journeyPeriod = '';
                if (headerDates.length > 1) {
                    journeyPeriod = 'From ' + headerDates[0] + ' to ' + headerDates[headerDates.length - 1];
                } else {
                    journeyPeriod = headerDates[0];
                }
                $('.bookhisty-header>p').html(journeyPeriod);

                $('.close-icon').on('click', function() {
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
                        if($('#my_cart')) $('#my_cart').attr('onclick', 'location.href="checkout.php"');
                            
                        calcTotalCost();
                    } else {
                        // alert('Service cannot be empty !');
                        swal({
                            title : "",
                            text: "Service cannot be empty !",
                            icon: "warning",
                        });
                    }
                });

                $('.notes-icon').on('click', function() {
                    tempStationKey = $(this).attr('data-station-key');
                    tempServiceKey = $(this).attr('data-service-key');
                    tempCollectionKey = $(this).attr('data-collection-key');
                    tempCollectionServiceKey = $(this).attr('data-collection-service-key');

                    tempNotesSelectorBtn = $(this).attr('id');
                    
                    var prevNotes = globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].hasOwnProperty('notes')? globalStationData[tempStationKey].service_collection[tempServiceKey].service_group[tempCollectionKey].service_array[tempCollectionServiceKey].notes: "";
                    document.getElementById("notes").value = prevNotes;
                    $('#add_note').modal("show");
                });
            } else {
                // alert("Cannot find the added services ! Please add again !");
                swal({
                  title: "",
                    text: "Cannot find the added services ! Please add again !",
                    icon: "info",
                });
            }
            // go to checkout process page
            $('.checkout-btn').on('click', function () {
                var usr_exist = $('body').attr('data-usr-token');
                if ( usr_exist!='' && usr_exist!=0 ) {
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
            });

            $('#add-convenience').on('click', function () {
                $('#add-convenience-modal').modal({
                    backdrop: false
                });
            });
        });

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

            var notesLabel = (notes != '')? 'Edit Notes': 'Add Notes';
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

        function calcTotalCost() {
            var totalServiceCost = 0;
            var gstAmount = 0;
            var convenienceFee = 0;
            var convenienceFeeGst = 0;
            var totalAmount = 0;
            var is_royalty = sessionStorage.getItem("distributor-royalty");
            var markupAmount = sessionStorage.getItem("distributor-royalty-amount");
            var markupType = sessionStorage.getItem("distributor-type");
            var totalmarkupValue = "";

            globalStationData.forEach(function(stationObj) {
                stationObj.service_collection.forEach(function(serviceColObj) {
                    serviceColObj.service_group.forEach(function(serviceGrpObj) {
                        serviceGrpObj.service_array.forEach(function(serviceObj) {
                            if(serviceObj.isSelected) {
                                var adultCount = serviceObj.adult_count;
                                var childrenCount = serviceObj.children_count;
                                var adultPrice = serviceObj.price_adult;
                                var childrenPrice = serviceObj.price_children;
                                var addtionalAdultPrice = serviceObj.additional_price_adult;
                                var additionalChildrenPrice = serviceObj.additional_price_children;

                                var serviceCostInclGst = 0;
                                if (addtionalAdultPrice > 0 && adultCount > 1) {
                                    serviceCostInclGst += (adultPrice + ((adultCount-1) * addtionalAdultPrice));
                                } else {
                                    serviceCostInclGst += adultCount * adultPrice;
                                }
                                if (additionalChildrenPrice > 0 && childrenCount > 1) {
                                    serviceCostInclGst += (childrenPrice + ((childrenCount-1) * additionalChildrenPrice));
                                } else {
                                    serviceCostInclGst += childrenCount * childrenPrice;
                                }
                                // var serviceCostInclGst = (serviceGrpObj.adult_count * serviceObj.price_adult) + (serviceGrpObj.children_count * serviceObj.price_children);
                                if (serviceCostInclGst) {
                                    if (isAgent) {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                        var gstValue = serviceCostInclGst - serviceCost;
                                        gstAmount += gstValue;

                                        var tempConvenienceFee = 0;
                                        if (hasConvenience) {
                                            tempConvenienceFee = (tempConvenienceFee == 0) ? serviceCostInclGst * 0.0354: tempConvenienceFee;
                                        }
                                        convenienceFee += tempConvenienceFee;

                                        var tempConvenienceFeeGst = 0;
                                        $('#convenience-fee-gst').closest('.price-summary-details').remove();
                                    } else {
                                        var serviceCost = (serviceCostInclGst * 100) / 118;
                                        totalServiceCost += serviceCost;
                                        var gstValue = serviceCostInclGst - serviceCost;
                                        gstAmount += gstValue;
                                        var tempConvenienceFee = serviceCostInclGst * 0.03;
                                        convenienceFee += tempConvenienceFee;
                                        var tempConvenienceFeeGst = tempConvenienceFee * 0.18;
                                        convenienceFeeGst += tempConvenienceFeeGst;
                                    }
                                    var netAmount = serviceCostInclGst + tempConvenienceFee + tempConvenienceFeeGst;
                                    totalAmount += netAmount;
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
            if(is_royalty!='0'){
                if(markupType == 'Percentage'){
                    totalmarkupValue = totalServiceCost * (markupAmount / 100);
                    totalmarkupValue = Math.round((totalmarkupValue + Number.EPSILON) * 100) / 100;
                } else {
                    totalmarkupValue = totalServiceCost + markupAmount;
                    totalmarkupValue = Math.round((totalmarkupValue + Number.EPSILON) * 100) / 100;
                }
            } else {
                totalmarkupValue = 0;
            }

            totalServiceCost = Math.round(totalServiceCost);
            gstAmount = Math.round(gstAmount);
            
            convenienceFeeGst = Math.round(convenienceFeeGst);
            if (customConvenienceFee > 0) {
                convenienceFeeGst = 0;

                convenienceFee = customConvenienceFee;
                totalAmount = totalServiceCost + gstAmount + convenienceFee + convenienceFeeGst;
            } else {
                convenienceFee = Math.round(convenienceFee);
            }
            totalAmount = Math.round(totalAmount);
            
            var currencyAmount = "";
            var servicecost_value = "";
            var gstamountValue = "";
            var convenienceFeeValue = "";
            var convenienceFeeGSTValue = "";
            var markupValue = "";
            currencyAmount = "₹ " + totalAmount;
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
                    dataType: 'JSON',
                    success: function(response) {
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

                        var markupFee = response * totalmarkupValue;
                        markupFee = Math.round((markupFee + Number.EPSILON) * 100) / 100;
                        switch (currencySelected) {
                            case "USD":
                                currencyAmount = "$ " + foreignCurrencyValue;
                                servicecost_value = "$ " + service_cost;
                                gstamountValue = "$ " + gst_amount;
                                convenienceFeeValue = "$ " + convenienceFeeAmount;
                                convenienceFeeGSTValue = "$ " + convenienceFeeGSTAmount;
                                markupValue = "$ " + markupFee;
                                $('#currency-view').text("USD ($)");
                                break;
                        
                            default:
                                currencyAmount = "₹ " + totalAmount;
                                servicecost_value = "₹ " + service_cost;
                                gstamountValue = "₹ " + gst_amount;
                                convenienceFeeValue = "₹ " + convenienceFeeAmount;
                                convenienceFeeGSTValue = "₹ " + convenienceFeeGSTAmount;
                                markupValue = "₹ " + markupFee;
                                $('#currency-view').text("INR (₹)");
                                break;
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            // }

            $('#service-cost').text(servicecost_value);
            $('#gst-amount').text(gstamountValue);
            $('#convenience-fee').text(convenienceFeeValue);
            $('#convenience-fee-gst').text(convenienceFeeGSTValue);
            $('#markup-percentage').text(markupValue);
            if (isAgent) {
                if (hasConvenience) {
                    $('#add-convenience').css('display', 'none');
                    $('#remove-convenience').css('display', 'block');
                    $('#convenience-fee').closest('.price-summary-details').css('display', 'flex');
                    if(convenienceFeeGst > 0) {
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
            // $('.price-view').text(totalServiceCost);
            sessionStorage.setItem("jsonServiceData", JSON.stringify(globalStationData));
            sessionStorage.setItem("currencySelected", currencySelected);
        }

        const currencyDropdownBox = document.querySelector('.currency__dropdown-box');
        const currencyDropdown = document.querySelector('.currency__drop-list');
        const currencies = document.querySelectorAll('.currency__drop-item');
        let currencyName = document.querySelector('.currency_name');

        currencyDropdownBox.addEventListener('click', function() {
            currencyDropdown.classList.toggle('hidden');
        });
        currencies.forEach(cur => {
            cur.addEventListener('click', function() {
                currencyName.textContent = cur.textContent;
            });
        });

    </script>
</body>
</html>