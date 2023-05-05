
var globalDistributorData = {};

var downloadTimer = null;
var timeleft = null;
var otpPhoneInput = false;
var usr_detail = ``;
var isSignedIn = false;
var isOnCheckout = false;
var isAgent = false;
var agentDash = ``;
var header_logo = sessionStorage.getItem("header_logo");
header_logo = (header_logo && header_logo!='')? header_logo: "asset/logo.png";

var login_modal = '';
$.ajax({
    async: false,
    type: 'GET',
    url: 'php/users/read-detail.php',
    dataType: 'JSON',
    success: function(response) {
        var footerManager = ``;
        if (response.status_code == 200) {
            isSignedIn = true;
            var responseData = response.data;
            if (responseData.is_agent && responseData.is_approved == 'Approved') {
                isAgent = true;
                agentDash = `<li>
                <a class="nav-item nav-link-btn nav-dash" href="agent-dashboard">Dashboard</a>
            </li>`;
            }
            $("body").attr("data-usr-country-code", responseData.country_code);
            $("body").attr("data-usr-mobile", responseData.mobile_number);
            $('body').attr('data-usr-token', responseData.token);
            var usr_name = (responseData.name != '')? responseData.name: responseData.mobile_number;
            usr_detail += `<div class="loged-set desktop-view">
                <div class="name-point-box dropdown">
                    <a href="javascript:void(0)" class="profile-dropdown dropdown-toggle" data-value="settings">${usr_name}</a>
                    <div class="drop-down-list profile-settings" id="settings">
                        <a href="profile.php" class="dropdown-item">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>profile</title>
                                <g id="profile" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="4781818_account_avatar_face_man_people_icon" transform="translate(3.000000, 3.000000)">
                                        <g id="profile_icon" transform="translate(1.687500, 1.687500)" fill="#0FB3D4" fill-rule="nonzero">
                                            <path d="M7.3125,14.625 C3.27391777,14.625 0,11.3510822 0,7.3125 C0,3.27391777 3.27391777,0 7.3125,0 C11.3510822,0 14.625,3.27391777 14.625,7.3125 C14.625,9.25189558 13.8545781,11.1118586 12.4832183,12.4832183 C11.1118586,13.8545781 9.25189558,14.625 7.3125,14.625 Z M7.3125,1.125 C3.89523811,1.125 1.125,3.89523811 1.125,7.3125 C1.125,10.7297619 3.89523811,13.5 7.3125,13.5 C10.7297619,13.5 13.5,10.7297619 13.5,7.3125 C13.5,5.67147297 12.8481046,4.09765813 11.6877232,2.93727679 C10.5273419,1.77689545 8.95352703,1.125 7.3125,1.125 Z" id="Shape"></path>
                                            <path d="M7.3125,7.875 C5.75919914,7.875 4.5,6.61580086 4.5,5.0625 C4.5,3.50919914 5.75919914,2.25 7.3125,2.25 C8.86580086,2.25 10.125,3.50919914 10.125,5.0625 C10.125,6.61580086 8.86580086,7.875 7.3125,7.875 Z M7.3125,3.375 C6.38051948,3.375 5.625,4.13051948 5.625,5.0625 C5.625,5.99448052 6.38051948,6.75 7.3125,6.75 C8.24448052,6.75 9,5.99448052 9,5.0625 C9,4.13051948 8.24448052,3.375 7.3125,3.375 Z" id="Shape"></path>
                                            <path d="M12.684375,11.8125129 C12.5265139,11.8135682 12.3754694,11.7482517 12.268125,11.6325 C11.0610192,10.3158196 9.35751569,9.56505404 7.57125,9.5625 L7.05375,9.5625 C5.40686561,9.55894572 3.82323771,10.1964316 2.638125,11.34 C2.41099136,11.5274214 2.07775011,11.5079418 1.87400018,11.2953332 C1.67025025,11.0827245 1.66496236,10.7489563 1.861875,10.53 C3.25455617,9.18390643 5.11686813,8.43333216 7.05375,8.43748273 L7.57125,8.43748273 C9.67070094,8.44224613 11.6728942,9.32304805 13.095,10.8675 C13.2468695,11.0312514 13.2874768,11.2693401 13.1984716,11.474174 C13.1094664,11.679008 12.9077096,11.8117837 12.684375,11.8125129 Z" id="Path"></path>
                                        </g>
                                        <g id="frame">
                                            <rect id="Rectangle" x="0" y="0" width="18" height="18"></rect>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <p>My Profile</p>
                        </a>
                        <a href="my-booking.php" class="dropdown-item">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>booking</title>
                                <g id="booking" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="mybooking_icon" transform="translate(6.000000, 6.000000)" stroke="#07B3D2" stroke-width="1.2">
                                        <line x1="5.12121212" y1="1.2" x2="13" y2="1.2" id="Path-Copy"></line>
                                        <line x1="5.12121212" y1="6" x2="13" y2="6" id="Path-Copy-2"></line>
                                        <line x1="5.12121212" y1="10.8" x2="13" y2="10.8" id="Path-Copy-3"></line>
                                        <ellipse id="Oval-Copy-4" cx="1.18181818" cy="1.2" rx="1.18181818" ry="1.2"></ellipse>
                                        <ellipse id="Oval-Copy-5" cx="1.18181818" cy="6" rx="1.18181818" ry="1.2"></ellipse>
                                        <ellipse id="Oval-Copy-6" cx="1.18181818" cy="10.8" rx="1.18181818" ry="1.2"></ellipse>
                                    </g>
                                </g>
                            </svg>
                            <p>My Bookings</p>
                        </a>
                        <div class="divider dropdown-divider"></div>
                        <a onclick="logout_session()" class="dropdown-item">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>logout</title>
                                <g id="logout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="9044574_logout_icon" transform="translate(4.000000, 4.000000)">
                                        <path d="M3,15 L9,15 C9.55202204,14.9993663 9.99936627,14.552022 10,14 L10,12.5 L9,12.5 L9,14 L3,14 L3,2 L9,2 L9,3.5 L10,3.5 L10,2 C9.99936627,1.44797796 9.55202204,1.00063373 9,1 L3,1 C2.44797796,1.00063373 2.00063373,1.44797796 2,2 L2,14 C2.00063373,14.552022 2.44797796,14.9993663 3,15 Z" id="logout_outline" stroke="#E84B4B" stroke-width="0.2" fill="#E84B4B" fill-rule="nonzero"></path>
                                        <polygon id="logout_icon" stroke="#E84B4B" stroke-width="0.2" fill="#E84B4B" fill-rule="nonzero" points="10.293 10.293 12.086 8.5 5 8.5 5 7.5 12.086 7.5 10.293 5.707 11 5 14 8 11 11"></polygon>
                                        <rect id="_Transparent_Rectangle_" x="0" y="0" width="16" height="16"></rect>
                                    </g>
                                </g>
                            </svg>
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>`;
            footerManager =`<li><a href="my-booking.php">My Bookings</a></li>`;
        } else {
            $('body').attr('data-usr-token', 0);
            usr_detail += `<a href="javascript:void(0)" class="nav-item manage-item" data-toggle="modal" data-target="#login_modal">Manage Bookings</a>`;

            login_modal = `<div class="modal-dialog float-right top-edge custom-dialog">
                <div class="custom-content">
                    <img src="asset/choose-service/close.svg" class="login-close" alt="close icon" data-dismiss="modal">
                    <div class="cust-modal-body">
                        <div class="login-set">
                            <div class="login-form-set">
                                <div class="login-header">
                                    <img src="${header_logo}" class="login-logo" alt="logo">
                                </div>
                                <div class="heading-set heading-set-mob">
                                    <h2>Log in to your booking</h2>
                                </div>
                                <div class="heading-set heading-set-otp hidden">
                                    <h2>Verify OTP</h2>
                                    <p>Enter the OTP code sent to your mobile number</p>
                                </div>
                                <div class="login-input-action-set" id="login_with_mobileno">
                                    <div class="login-input-group phone">
                                        <p>Mobile Number</p>
                                        <input class="login-input-box" type="text" id="login-phone" />
                                    </div>
                                    <a href="javascript:void(0)" class="login-email login-option hidden" data-value="login-by-email">Use Email Address</a>
                                </div>
                                <div class="login-input-action-set hidden" id="login_with_email">
                                    <div class="login-input-group">
                                        <p>Email Address</p>
                                        <input type="tel" class="login-input-box" id="login" name="phone" placeholder="Enter Email Address"/>
                                    </div>
                                    <a href="javascript:void(0)" class="login-email login-option" data-value="login-by-phonenumber">Use Mobile Number</a>
                                </div>
                                <div class="login-input-action-set hidden" id="login_otp">
                                    <div class="otp-desc-set">
                                        <p>OTP sent to <span id="phone-view">your mobile number</span> <a href="javascript:void(0)" class="resend-otp" onclick="editMobile()">Edit</a></p>
                                        <span class="resend-otp-note hidden">Didn't receive the code? <a href="javascript:void(0)" class="resend-otp" onclick="sendOtp()">Resend OTP</a></span>
                                        <div class="otp-timer">
                                            <img src="asset/timer.svg" class="clock-icon" alt="clock icon">
                                            <spam class="timer-set"><span class="timer-count" id="countdowntimer">30</span> s</spam>
                                        </div>
                                    </div>
                                    <div class="otp-group">
                                        <input class="otp-input first-otp" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1" placeholder="0" autocomplete="off"/>
                                        <input class="otp-input" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1" placeholder="0" autocomplete="off"/>
                                        <input class="otp-input" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1" placeholder="0" autocomplete="off"/>
                                        <input class="otp-input" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1" placeholder="0" autocomplete="off"/>
                                        <input class="otp-input" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" maxlength="1" placeholder="0" autocomplete="off"/>
                                        <input class="otp-input last-otp" id="digit-6" name="digit-6" data-next="digit-7" data-previous="digit-5" maxlength="1" placeholder="0" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="login-btn-acton-set">
                                    <button class="login-btn" id="send_otp" onclick="sendOtp()">Send OTP</button>
                                    <button class="login-btn hidden" id="verify_otp" onclick="verifyOtp()">Verify OTP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            footerManager =`<li><a href="javascript:void(0)" data-toggle="modal" data-target="#login_modal">Manage Bookings</a></li>`;
        }
        $('#login_modal').html(login_modal);

        if (login_modal != '') {
            // Login telephone code
            // telephone input
            if ($('#login-phone').length > 0) {
                const otpPhoneInputField = document.querySelector("#login-phone");
                otpPhoneInput = window.intlTelInput(otpPhoneInputField, {
                    separateDialCode: true,
                    preferredCountries:["in"],
                    hiddenInput: "full",
                    utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
                });
            }
        }

        let nav = `<div class="container">
            <div class="nav-lists">
                <div class="nav-logo">
                    <a href="index.php"><img id="header-logo" src="asset/home/logo.png" alt="logo" class="nav-logo"></a>
                </div>
                <div class="nav-list">
                    <ul class="nav-list-items-set">
                        <li class="dropdown hidden">
                            <a href="javascript:void(0)" class="nav-item dropdown-toggle" data-value="service_list">Services we offer</a>
                            <div class="drop-down-list nav-drop-down" id="service_list">
                                <ul class="block-box">
                                    <li><a>Meet And Assist</a></li>
                                    <li><a>Lounge</a></li>
                                    <li><a>Baggage Porter</a></li>
                                    <li><a>Airport Transfer</a></li>
                                    <li><a>Visa Assistance</a></li>
                                    <li><a>Welcome Bouquet</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="contact-us.php" target="_blank" class="nav-item">Contact Us</a>
                        </li>
                        <li>
                            ${usr_detail}
                        </li>
                        <li>
                            <a class="nav-item" id="cart-nav">
                                <span class="cart-icon-set">
                                    <svg class="cart-icon" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>cart</title>
                                        <g id="cart" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(11.800407, 11.800153) scale(-1, 1) translate(-11.800407, -11.800153) translate(1.000000, 1.000000)" fill="#fff" fill-rule="nonzero" id="cart-color" stroke="#fff" stroke-width="0.2">
                                                <path d="M4.32081592,15.8403074 C2.73023597,15.8403074 1.44081616,17.1297272 1.44081616,18.7203071 C1.44081616,20.3108871 2.73023597,21.6003069 4.32081592,21.6003069 C5.91139586,21.6003069 7.20081567,20.3108871 7.20081567,18.7203071 C7.20081567,17.1297272 5.91139586,15.8403074 4.32081592,15.8403074 Z M4.32081592,20.160307 C3.52552594,20.160307 2.88081604,19.5155971 2.88081604,18.7203071 C2.88081604,17.9250172 3.52552594,17.2803073 4.32081592,17.2803073 C5.11610589,17.2803073 5.76081579,17.9250172 5.76081579,18.7203071 C5.76081579,19.5155971 5.11610589,20.160307 4.32081592,20.160307 Z M14.400815,15.8403074 C12.8102351,15.8403074 11.5208153,17.1297272 11.5208153,18.7203071 C11.5208153,20.3108871 12.8102351,21.6003069 14.400815,21.6003069 C15.991395,21.6003069 17.2808148,20.3108871 17.2808148,18.7203071 C17.2808148,17.1297272 15.991395,15.8403074 14.400815,15.8403074 Z M14.400815,20.160307 C13.6055251,20.160307 12.9608152,19.5155971 12.9608152,18.7203071 C12.9608152,17.9250172 13.6055251,17.2803073 14.400815,17.2803073 C15.196105,17.2803073 15.8408149,17.9250172 15.8408149,18.7203071 C15.8408149,19.5155971 15.196105,20.160307 14.400815,20.160307 Z M20.8808145,0.000308745801 L18.7208147,0.000308745801 C18.3819127,-0.00956506322 18.0820419,0.218336765 18.0008147,0.547508699 L17.4392148,2.8803085 L0.720816225,2.8803085 C0.511503474,2.87848717 0.311759994,2.96784609 0.173616272,3.12510848 C0.0373310309,3.2839185 -0.0231151559,3.49416611 0.0080162866,3.70110843 L1.44801616,13.7811076 C1.49822848,14.1362347 1.80215669,14.4003429 2.1608161,14.4003429 L16.5608149,14.4003429 C16.9222059,14.4038644 17.2302351,14.1389592 17.2808148,13.7811076 L18.7208147,3.73710842 L19.2824146,1.44030862 L20.8808145,1.44030862 C21.2784595,1.44030862 21.6008144,1.11795367 21.6008144,0.720308684 C21.6008144,0.322663698 21.2784595,0.000308745801 20.8808145,0.000308745801 Z M15.9344149,12.9603076 L2.78721605,12.9603076 L1.54881615,4.32030837 L17.1728148,4.32030837 L15.9344149,12.9603076 Z"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="cart-count">0</span>
                                </span>
                            </a>
                        </li>
                        ${agentDash}
                    </ul>
                </div>
                
                <div class="mobile-nav-toggle">
                    <span class=""></span>
                </div>
            </div>
        </div>`;
        $('nav').html(nav);
        
        let footer = `<div class="container">
            <div class="row">
                <div class="col-md-6 footer_logo">
                    <img id="footer-logo" src="asset/home/footer-logo.png" alt="footer logo">
                </div>
                <div class="col-md-3">
                    <ul class="footer_list footer_links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="contact-us.php" target="_blank">Contact Us</a></li>
                        ${footerManager}
                        <li><a href="terms.php" target="_blank">Terms and Conditions</a></li>
                        <li><a href="cancellation_policy.php" target="_blank">Cancellation Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>SERVICES WE OFFER</h5>
                    <ul class="footer_list" id="footer-service-list"></ul>
                </div>
            </div>
            <div class="copyright_column">
                <p>&copy; <span class="current_year"></span> <span class="partner_name" id="footer-distributor"></span>. All Rights Reserved</p>
                <p>Powered by <img src="asset/logo.png" alt="airportzo logo"></p>
            </div>
        </div>`;
        $('footer').html(footer);
    }
});

// Agent dashboard sidebar
let agentSidemenu = `<ul class="sidemenu-list">
    <li class="active">
        <a href="agent-dashboard" class="sidemenu-link">
            <svg version="1.1" width="26px" height="26px" viewBox="0 0 26.0 26.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <clipPath id="i0">
                        <path d="M26,0 L26,26 L0,26 L0,0 L26,0 Z"></path>
                    </clipPath>
                </defs>
                <g clip-path="url(#i0)">
                    <g transform="translate(4.0 3.0)">
                        <path id="dashboard-icon" d="M6.65721519,18.7714023 L6.65721519,15.70467 C6.65719744,14.9246392 7.29311743,14.2908272 8.08101266,14.2855921 L10.9670886,14.2855921 C11.7587434,14.2855921 12.4005063,14.9209349 12.4005063,15.70467 L12.4005063,15.70467 L12.4005063,18.7809263 C12.4003226,19.4432001 12.9342557,19.984478 13.603038,20 L15.5270886,20 C17.4451246,20 19,18.4606794 19,16.5618312 L19,16.5618312 L19,7.8378351 C18.9897577,7.09082692 18.6354747,6.38934919 18.0379747,5.93303245 L11.4577215,0.685301154 C10.3049347,-0.228433718 8.66620456,-0.228433718 7.51341772,0.685301154 L0.962025316,5.94255646 C0.362258604,6.39702249 0.00738668938,7.09966612 0,7.84735911 L0,16.5618312 C0,18.4606794 1.55487539,20 3.47291139,20 L5.39696203,20 C6.08235439,20 6.63797468,19.4499381 6.63797468,18.7714023 L6.63797468,18.7714023" stroke="#0FB3D4" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </g>
            </svg>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="agent-bookings" class="sidemenu-link">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="booking-icon" fill-rule="evenodd" clip-rule="evenodd" d="M4.79999 3.15C3.33644 3.15 2.14999 4.33645 2.14999 5.8C2.14999 7.26356 3.33644 8.45 4.79999 8.45C6.26355 8.45 7.44999 7.26356 7.44999 5.8C7.44999 4.33645 6.26355 3.15 4.79999 3.15ZM3.84999 5.8C3.84999 5.27533 4.27532 4.85 4.79999 4.85C5.32466 4.85 5.74999 5.27533 5.74999 5.8C5.74999 6.32467 5.32466 6.75 4.79999 6.75C4.27532 6.75 3.84999 6.32467 3.84999 5.8ZM10.8 4.95C10.3306 4.95 9.95 5.33056 9.95 5.8C9.95 6.26945 10.3306 6.65 10.8 6.65H22.8C23.2694 6.65 23.65 6.26945 23.65 5.8C23.65 5.33056 23.2694 4.95 22.8 4.95H10.8ZM10.8 12.15C10.3306 12.15 9.95 12.5306 9.95 13C9.95 13.4694 10.3306 13.85 10.8 13.85H22.8C23.2694 13.85 23.65 13.4694 23.65 13C23.65 12.5306 23.2694 12.15 22.8 12.15H10.8ZM9.95 20.2C9.95 19.7306 10.3306 19.35 10.8 19.35H22.8C23.2694 19.35 23.65 19.7306 23.65 20.2C23.65 20.6694 23.2694 21.05 22.8 21.05H10.8C10.3306 21.05 9.95 20.6694 9.95 20.2ZM2.14999 13C2.14999 11.5364 3.33644 10.35 4.79999 10.35C6.26355 10.35 7.44999 11.5364 7.44999 13C7.44999 14.4636 6.26355 15.65 4.79999 15.65C3.33644 15.65 2.14999 14.4636 2.14999 13ZM4.79999 12.05C4.27532 12.05 3.84999 12.4753 3.84999 13C3.84999 13.5247 4.27532 13.95 4.79999 13.95C5.32466 13.95 5.74999 13.5247 5.74999 13C5.74999 12.4753 5.32466 12.05 4.79999 12.05ZM4.79999 17.55C3.33644 17.55 2.14999 18.7364 2.14999 20.2C2.14999 21.6636 3.33644 22.85 4.79999 22.85C6.26355 22.85 7.44999 21.6636 7.44999 20.2C7.44999 18.7364 6.26355 17.55 4.79999 17.55ZM3.84999 20.2C3.84999 19.6753 4.27532 19.25 4.79999 19.25C5.32466 19.25 5.74999 19.6753 5.74999 20.2C5.74999 20.7247 5.32466 21.15 4.79999 21.15C4.27532 21.15 3.84999 20.7247 3.84999 20.2Z" fill="#0FB3D4" />
            </svg>
            <span>Booking Orders</span>
        </a>
    </li>
    <li>
        <a href="manage-finance" class="sidemenu-link">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="wallet-icon" fill-rule="evenodd" clip-rule="evenodd" d="M19.875 4.34375V5.96338C19.5891 5.90502 19.2961 5.875 19 5.875H2.7826C2.86645 5.82206 2.95932 5.78336 3.0575 5.76125L17.7312 2.4275C17.9801 2.36015 18.241 2.35036 18.4942 2.39888C18.7474 2.44739 18.9862 2.55294 19.1925 2.7075C19.4221 2.91126 19.6027 3.16423 19.7209 3.44756C19.8391 3.73088 19.8918 4.03723 19.875 4.34375ZM0.624998 6.63625C0.624998 6.65527 0.625617 6.67423 0.626845 6.6931C0.625615 6.71199 0.624994 6.73096 0.624994 6.75V19C0.624994 20.1603 1.08593 21.2731 1.9064 22.0936C2.72687 22.9141 3.83967 23.375 4.99999 23.375H19C20.1603 23.375 21.2731 22.9141 22.0936 22.0936C22.9141 21.2731 23.375 20.1603 23.375 19V17.2518C23.375 17.2512 23.375 17.2506 23.375 17.25V12C23.375 11.9994 23.375 11.9988 23.375 11.9982V10.25C23.375 9.08968 22.9141 7.97688 22.0936 7.15641C21.9463 7.00916 21.7897 6.87349 21.625 6.74998V4.34375C21.6409 3.77517 21.5288 3.21028 21.2971 2.69081C21.0654 2.17134 20.7199 1.71056 20.2862 1.3425C19.8761 1.02145 19.3979 0.798538 18.8883 0.690853C18.3787 0.583169 17.8512 0.593567 17.3462 0.721251L2.66375 4.055C2.08067 4.18857 1.5607 4.51728 1.18994 4.9867C0.819179 5.45612 0.619864 6.03809 0.624998 6.63625ZM21.625 11.125V10.25C21.625 9.55381 21.3484 8.88613 20.8562 8.39385C20.3639 7.90156 19.6962 7.625 19 7.625H2.37499V19C2.37499 19.6962 2.65156 20.3639 3.14384 20.8562C3.63612 21.3484 4.3038 21.625 4.99999 21.625H19C19.6962 21.625 20.3639 21.3484 20.8562 20.8562C21.3484 20.3639 21.625 19.6962 21.625 19V18.125H16.375C15.4467 18.125 14.5565 17.7563 13.9001 17.0999C13.2437 16.4435 12.875 15.5533 12.875 14.625C12.875 13.6967 13.2437 12.8065 13.9001 12.1501C14.5565 11.4938 15.4467 11.125 16.375 11.125H21.625ZM21.625 16.375V12.875H16.375C15.9109 12.875 15.4657 13.0594 15.1376 13.3876C14.8094 13.7158 14.625 14.1609 14.625 14.625C14.625 15.0891 14.8094 15.5343 15.1376 15.8624C15.4657 16.1906 15.9109 16.375 16.375 16.375H21.625Z" fill="#0FB3D4" />
            </svg>
            <span>Manage Finance</span>
        </a>
    </li>
</ul>`;
    // <li>
    //     <a href="javascript:void(0)" class="sidemenu-link">
    //         <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    //             <path id="reports-icon" fill-rule="evenodd" clip-rule="evenodd" d="M13.87 1.46C13.87 1.45445 13.8745 1.45 13.88 1.45L13.89 1.45001V1.92V10.66V11.11H14.34H23.08H23.55L23.55 11.12C23.55 11.1222 23.5496 11.1232 23.5494 11.1238C23.549 11.1246 23.5483 11.1258 23.5471 11.1271L23.5456 11.1283L23.5438 11.1294L23.5425 11.1298L23.54 11.13H13.88C13.8744 11.13 13.87 11.1256 13.87 11.12V1.46ZM14.362 1.47054L13.9463 1.45023C19.2343 1.48571 23.5143 5.76577 23.5498 11.0538L23.5295 10.638C23.2872 5.67882 19.3212 1.71288 14.362 1.47054ZM13.88 0.550003C13.3773 0.550003 12.97 0.957457 12.97 1.46V11.12C12.97 11.6226 13.3774 12.03 13.88 12.03H23.54C24.0425 12.03 24.45 11.6227 24.45 11.12C24.45 5.28235 19.7176 0.550003 13.88 0.550003ZM14.79 10.21V2.40517C18.9079 2.82777 22.1723 6.09212 22.5948 10.21H14.79ZM1.45 13.88C1.45 8.56956 5.73064 4.25893 11.0296 4.2104L10.6369 4.23058C5.44274 4.49749 1.39454 8.8328 1.48354 14.033C1.57254 19.2333 5.76673 23.4275 10.967 23.5164C16.1672 23.6055 20.5025 19.5572 20.7694 14.3631L20.7896 13.9705C20.741 19.2694 16.4304 23.55 11.12 23.55C5.77941 23.55 1.45 19.2206 1.45 13.88ZM11.11 4.67999V4.21L11.12 4.20999C11.1255 4.20999 11.13 4.21444 11.13 4.21999V13.42V13.87H11.58H20.78C20.7856 13.87 20.79 13.8744 20.79 13.88L20.79 13.89H20.32H11.12C11.1178 13.89 11.1168 13.8896 11.1162 13.8894C11.1154 13.889 11.1142 13.8883 11.1129 13.8871C11.1117 13.8858 11.111 13.8846 11.1106 13.8838C11.1104 13.8832 11.11 13.8822 11.11 13.88V4.67999ZM11.12 3.30999C5.28235 3.30999 0.550003 8.04234 0.550003 13.88C0.550003 19.7176 5.28235 24.45 11.12 24.45C16.9576 24.45 21.69 19.7176 21.69 13.88C21.69 13.3774 21.2826 12.97 20.78 12.97H12.03V4.21999C12.03 3.71744 11.6227 3.30999 11.12 3.30999ZM2.38341 14.0176C2.30543 9.4615 5.72992 5.63758 10.21 5.16638V13.88C10.21 14.3825 10.6173 14.79 11.12 14.79H19.8336C19.3624 19.27 15.5385 22.6946 10.9824 22.6166C6.26713 22.5359 2.46411 18.7329 2.38341 14.0176Z" fill="#0EB4D4" />
    //         </svg>
    //         <span>Reports and Analytics</span>
    //     </a>
    // </li>

const dashboardSidebar = document.querySelector('.agent-dashboard-sidebar');
if (document.body.contains(dashboardSidebar)){
    $('.agent-dashboard-sidebar').html(agentSidemenu);
}

// sidebar active
const currentLocation = location.href;
const menuItems = document.querySelectorAll('.sidemenu-link');
const menuLength = menuItems.length;
for (let i = 0; i < menuLength; i++){
    menuItems[i].closest('li').classList.remove("active");
    if(menuItems[i].href === currentLocation) {
        menuItems[i].closest('li').classList.add("active");
    }
} 

// Header scroll class //
$(window).scroll(function() {
    if ($(this).scrollTop() > 30) {
        $('header').addClass('header-scrolled');
        $('nav').addClass('topbar-scrolled');
    } else {
        $('header').removeClass('header-scrolled');
        $('nav').removeClass('topbar-scrolled');
    }
});

 // Page Loader
// setTimeout(function(){$('#loading').fadeOut();},500);
// Tab action
$('.jurney-items').on('click',function(){
    $('.jurney-items').removeClass('active');
    $(this).addClass('active')
});

$('.mobile-nav-toggle').on('click',function(){
    $(`body`).toggleClass('nav-avtive');
})
$('.manage-item').on('click',function(){
    $(`body`).removeClass('nav-avtive');
})
window.onclick = function(event) {
    if (!event.target.matches('.nav-list')) {
        $('body').removeClass('nav-avtive');
    }
}
$('.nav-list').on('click',function(e){
    if (e.target.matches('.nav-list')) {
        $('body').removeClass('nav-avtive');
    }
});

//menu Profile dropdown
$(`.dropdown-toggle`).on('click',function(event) {
    $(`.drop-down-list`).removeClass("active");
    let result = $(this).attr('data-value');
    $(`#${result}`).toggleClass("active");
});
$(`.dropdown-toggle1`).on('click',function(event) {
    // $(`.drop-down-list`).removeClass("active");
    let result = $(this).attr('data-value');
    $(`#${result}`).toggleClass("active");
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    // if (event.target.matches('.dropdown-toggle')) {
        if (!event.target.matches('.dropdown-toggle')) {
            $('.drop-down-list').removeClass('active');
        }
    // }
}

function sendOtp() {
    var mobileNumber = $('#login-phone').val().trim().replace(/\s/g,'');
    var full_number = otpPhoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
    var countryCode = full_number.replace(mobileNumber, "");
    countryCode = countryCode.replace(/\+/g, '');
    var inputData = {
        "country_code": countryCode,
        "mobile_number": mobileNumber
    };
    inputData = JSON.stringify(inputData);
    $.ajax({
        url: 'php/users/user-authentication.php',
        data: inputData,
        type: 'POST',
        dataType: 'JSON',
        success: function(response) {
            if (response.status_code == 200) {
                $('#phone-view').text(countryCode + " " + mobileNumber);

                $('#login_with_mobileno').css('display', 'none');
                $('#send_otp').css('display', 'none');
                $('.otp-input').val('');
                $('#login_otp').removeClass('hidden');
                $('.heading-set-mob').addClass('hidden');
                $('.heading-set-otp').removeClass('hidden');
                $('#verify_otp').removeClass('hidden');
                $('#login_otp').css('display', 'block');
                $('#verify_otp').css('display', 'block');
                $('.first-otp').focus();

                generate_otp_timmer();
            } else {
                swal(response.message);
            }
        }
    });
}

function editMobile() {
    clearInterval(downloadTimer);
    downloadTimer = null;
    timeleft = null;

    $('#login_with_mobileno').css('display', 'block');
    $('#send_otp').css('display', 'block');
    $('#login_otp').addClass('hidden');
    $('.heading-set-mob').removeClass('hidden');
    $('.heading-set-otp').addClass('hidden');
    $('#verify_otp').addClass('hidden');
    $('#login_otp').css('display', 'none');
    $('#verify_otp').css('display', 'none');
}

// Press Enter to login
const lastOtp = document.querySelector('.last-otp');
if (document.body.contains(lastOtp)){
	lastOtp.addEventListener('keydown', function(e){
		if(e.key == 'Enter') {
			verifyOtp();
		};
	})
}

function verifyOtp() {
    var mobileNumber = $('#login-phone').val().trim().replace(/\s/g,'');
    var full_number = otpPhoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
    var countryCode = full_number.replace(mobileNumber, "");
    countryCode = countryCode.replace(/\+/g, '');
    var otp = '';
    $('.otp-input').each(function() {
        otp += $(this).val();
    });
    var inputData = {
        "country_code": countryCode,
        "mobile_number": mobileNumber,
        "otp": otp
    };
    inputData = JSON.stringify(inputData);
    $.ajax({
        url: 'php/users/user-verification.php',
        data: inputData,
        type: 'POST',
        dataType: 'JSON',
        success: function(response) {
            if (response.status_code == 200) {
                if (isOnCheckout) {
                    window.location.href = 'checkout-process.php';
                } else {
                    window.location.reload();
                }
            } else {
                swal(response.message);
            }
        }
    });
}

// open login modal
function login() {
    $('#login_modal').modal(true);
    $('body').removeClass('nav-avtive');
}

// telephone input
// const phoneInputField = document.querySelector("#phone");
// const phoneInput = window.intlTelInput(phoneInputField, {
//     utilsScript:
//     "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
// });
//OTP
$('.otp-group').find('input').each(function() {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function(e) {
        var parent = $($(this).parent());
        if(e.keyCode === 8 || e.keyCode === 37) {
            var prev = parent.find('input#' + $(this).data('previous'));
            if(prev.length) {
                $(prev).select();
            }
        } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));
            if(next.length) {
                $(next).select();
            } else {
                if(parent.data('autosubmit')) {
                    parent.submit();
                }
            }
        }
    });
});
// Login Option Emial || Phone no
$('.login-option').on('click',function(){
    let get_option = $(this).attr('data-value');
    if(get_option == "login-by-email"){
        $('#login_with_email').removeClass('hidden');
        $('#login_with_mobileno').addClass('hidden');
    }
    else if(get_option == "login-by-phonenumber"){
        $('#login_with_mobileno').removeClass('hidden');
        $('#login_with_email').addClass('hidden');
    }
});
// $('.addcart-btn').on('click',function(){
//     $('#login_with_email').addClass('hidden');
//     $('#login_with_mobileno').addClass('hidden');
//     $('#login_otp').removeClass('hidden');
//     $('#send_otp').addClass('hidden');
//     $('#verify_otp').removeClass('hidden');
//     generate_otp_timmer();
// });
// timmer run out
function generate_otp_timmer() {
    timeleft = 30;
    if (!downloadTimer) {
        downloadTimer = setInterval(function() {
            timeleft--;
            document.getElementById("countdowntimer").textContent = timeleft;
            if(timeleft <= 0) {
                clearInterval(downloadTimer);
                downloadTimer = null;
                timeleft = null;

                $('.resend-otp-note').removeClass('hidden');
                $('.otp-timer').addClass('hidden');
                $('#countdowntimer').text(30);
            }
        }, 1000);
    } else {
        clearInterval(downloadTimer);
        document.getElementById("countdowntimer").textContent = timeleft;

        downloadTimer = setInterval(function() {
            timeleft--;
            document.getElementById("countdowntimer").textContent = timeleft;
            if(timeleft <= 0) {
                clearInterval(downloadTimer);
                downloadTimer = null;
                timeleft = null;

                $('.resend-otp-note').removeClass('hidden');
                $('.otp-timer').addClass('hidden');
                $('#countdowntimer').text(30);
            }
        }, 1000);
    }
}
$('.resend-otp').on('click',function(){
    $('.resend-otp-note').addClass('hidden');
    $('.otp-timer').removeClass('hidden');
    generate_otp_timmer();
});
// Go to cart
function gotocart() {
    window.location.href = "my-cart.php";
}

// copyright year
let currentYear = new Date().getFullYear();
if(currentYear) $('.current_year').text(currentYear);

// $("#login-phone").change(function() {
//     var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
// });

function logout_session() {
    sessionStorage.clear();
    window.location.href = "logout.php";
}

$("#footer-service-list").empty();
$.ajax({
    async: false,
    url: "php/services/read.php",
    type: "GET",
    dataType: "JSON",
    success: function (response) {
        if (response.status_code == 200) {
            var responseData = response.data;
            responseData.forEach(function (serviceObj) {
                $("#footer-service-list").append(`<li>
                    <a href="service-details.php?id=${serviceObj.token}">${serviceObj.name}</a>
                </li>`);
            });
        }
    }
});