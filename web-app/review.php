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
    <style>
        .own-logo {
            width: 250px;
            margin-bottom: 5px;
        }
        </style>
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
                <div class="cart-header">
                    <h2>My Rating</h2>
                </div>

                <div class="feedback-form">
                        <input type="hidden" id="order_token">
                        <div class="modal-header modal-rating-header">
                            <h2>Let us know how we are doing!</h2>
                        </div>
                        <div class="logo-product-set">
                            <img src="asset/logo.png" class="own-logo" alt="logo">
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
        </section>
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


    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script src="js/moment.min.js<?php echo $cache_str; ?>"></script>
    <script src="js/aws-sdk.min.js"></script>
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
                                                category_discountAmount += parseInt(serviceObj.discount_amount);
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
                                                        <img class="chat-btn hidden" src="asset/message.svg" alt="message icon" onclick="openChatBox()">`;
                                                }

                                                // Declare dates for Chat Options
                                                var chatAction = ``;
                                                var newdate1 = new Date(serviceObj.service_date_time_raw);
                                                var newdate2 = new Date();

                                                var diff = (newdate1 - newdate2);
                                                var mins = Math.round((diff/1000)/60);
                                                // if(mins <= 30 && mins >= 0){ //start before 30min and end in after 30min condition
                                                if(mins <= 30){
                                                    chatAction = `<img class="chat-btn" src="asset/message.svg" alt="message icon" onclick="openChatBox('${serviceObj.token}','${bookingDetailData.user_name}','${serviceObj.service_name}')">`;
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

    </script>

</body>

</html>