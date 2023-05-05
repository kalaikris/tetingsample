var usr_detail = ``;
var isSignedIn = false;
var login_modal = "";
var isOnCheckout = false;
var backendBooking = false;
var downloadTimer = null;
var timeleft = null;
$.ajax({
    async: false,
    type: "GET",
    url: "php/users/read-detail.php",
    dataType: "JSON",
    success: function (response) {
        if (response.status_code == 200) {
            isSignedIn = true;
            var responseData = response.data;
            $("body").attr("data-usr-token", responseData.token);
            if(responseData.token == '1212121212'){
                backendBooking = true;
            }
            $("body").attr("data-usr-country-code", responseData.country_code);
            $("body").attr("data-usr-mobile", responseData.mobile_number);
            var usr_name =
                responseData.name != ""
                    ? responseData.name
                    : responseData.mobile_number;
            usr_detail += `<div class="loged-set">
                <div class="name-point-box dropdown">
                    <a href="javascript:void(0)" class="profile-dropdown" data-value="settings">${usr_name}</a>
                    <div class="profile-settings hidden" id="settings">
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
                        <a href="logout.php" class="dropdown-item">
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
        } else {
            $("body").attr("data-usr-token", 0);
            usr_detail += `<button class="cust-btn btn-green" data-toggle="modal" data-target="#login_modal">Login</button>`;
            // usr_detail += `<a href="javascript:void(0)" class="nav-item" data-toggle="modal" data-target="#login_modal">Manage Bookings</a>`;

            login_modal = `<div class="modal-dialog float-right top-edge custom-dialog">
                <div class="custom-content">
                    <img src="asset/choose-service/close.svg" class="login-close" alt="close icon" data-dismiss="modal">
                    <div class="cust-modal-body">
                        <div class="login-set">
                            <div class="login-slied">
                                <img src="asset/login-poster1.jpg" class="login-poster" alt="poster slied">
                                <div class="login-poster-desc-set">
                                    <p>
                                        Book a comforting welcome service from assisting<br> 
                                        the elderly to receiving a VIP.
                                    </p>
                                </div>
                            </div>
                            <div class="login-form-set">
                                <div class="login-header">
                                    <img src="asset/logo.png" class="login-logo" alt="logo">
                                    <p>make Your Journey As Enjoyable As The Destination</p>
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
                                        <p id="login-phoneErr" style="color:red;">
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
                                <div class="login-btn-acton-set">
                                    <button class="login-btn" id="send_otp" onclick="sendOtp()">Send OTP</button>
                                    <button class="login-btn hidden" id="verify_otp" onclick="verifyOtp()">Verify OTP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }
    },
});

let header = `
<div class="container-fluid">
        <div class="header-set">
            <div class="header-left">
                <ul>
                    <li>
                        <p>For any assistance : <span>+91 8610725198</span> (24/7 Customer Support)</p>
                    </li>
                    <li>
                        <span class="vr-line">|</span>
                    </li>
                    <li>
                        <a href="mailto:support@airportzo.com">support@airportzo.com</a>
                    </li>
                </ul>
            </div>
            <div class="header-right">
                <div class="lang-countr-set">
                    <div class="language-set">
                        <img src="asset/home/lang-icon.svg" class="header-icon" alt="icon">
                        <div class="drop-down-set">
                            <p class="dropdown-toggle" data-value="laguage_option">English</p>
                            <div class="drop-down-list" id="laguage_option">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">English</a>
                                    </li>
                                    <li class="hidden">
                                        <a href="javascript:void(0)">Tamil</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="country-set hidden">
                        <img src="asset/home/country.svg" class="header-icon" alt="icon">
                        <div class="drop-down-set">
                            <p class="dropdown-toggle" data-value="choose_currency">INR [₹]</p>
                            <div class="drop-down-list currency-list" id="choose_currency">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">INR</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">USD</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;

// ========================= WHITELABEL NAVBAR ========================= //
// let nav = `<div class="container">
//         <div class="nav-lists">
//             <div class="nav-logo">
//                 <a href="index.php"><img id="header-logo" src="asset/home/logo.png" alt="logo" class="nav-logo"></a>
//             </div>
//             <div class="nav-list">
//                 <ul class="nav-list-items-set">
//                     <li class="dropdown hidden">
//                         <a href="javascript:void(0)" class="nav-item dropdown-toggle" data-value="service_list">Services we offer</a>
//                         <div class="drop-down-list nav-drop-down" id="service_list">
//                             <ul class="block-box">
//                                 <li><a>Meet And Assist</a></li>
//                                 <li><a>Lounge</a></li>
//                                 <li><a>Baggage Porter</a></li>
//                                 <li><a>Airport Transfer</a></li>
//                                 <li><a>Visa Assistance</a></li>
//                                 <li><a>Welcome Bouquet</a></li>
//                             </ul>
//                         </div>
//                     </li>
//                     <li>
//                         <a href="javascript:void(0)" class="nav-item">Contact Us</a>
//                     </li>
//                     <li>
//                         ${usr_detail}
//                     </li>
//                     <li>
//                         <a href="checkout.php" class="nav-item">
//                             <span class="cart-icon-set">
//                                 <svg class="cart-icon" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
//                                     <title>cart</title>
//                                     <g id="cart" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
//                                         <g transform="translate(11.800407, 11.800153) scale(-1, 1) translate(-11.800407, -11.800153) translate(1.000000, 1.000000)" fill="#fff" fill-rule="nonzero" id="cart-color" stroke="#fff" stroke-width="0.2">
//                                             <path d="M4.32081592,15.8403074 C2.73023597,15.8403074 1.44081616,17.1297272 1.44081616,18.7203071 C1.44081616,20.3108871 2.73023597,21.6003069 4.32081592,21.6003069 C5.91139586,21.6003069 7.20081567,20.3108871 7.20081567,18.7203071 C7.20081567,17.1297272 5.91139586,15.8403074 4.32081592,15.8403074 Z M4.32081592,20.160307 C3.52552594,20.160307 2.88081604,19.5155971 2.88081604,18.7203071 C2.88081604,17.9250172 3.52552594,17.2803073 4.32081592,17.2803073 C5.11610589,17.2803073 5.76081579,17.9250172 5.76081579,18.7203071 C5.76081579,19.5155971 5.11610589,20.160307 4.32081592,20.160307 Z M14.400815,15.8403074 C12.8102351,15.8403074 11.5208153,17.1297272 11.5208153,18.7203071 C11.5208153,20.3108871 12.8102351,21.6003069 14.400815,21.6003069 C15.991395,21.6003069 17.2808148,20.3108871 17.2808148,18.7203071 C17.2808148,17.1297272 15.991395,15.8403074 14.400815,15.8403074 Z M14.400815,20.160307 C13.6055251,20.160307 12.9608152,19.5155971 12.9608152,18.7203071 C12.9608152,17.9250172 13.6055251,17.2803073 14.400815,17.2803073 C15.196105,17.2803073 15.8408149,17.9250172 15.8408149,18.7203071 C15.8408149,19.5155971 15.196105,20.160307 14.400815,20.160307 Z M20.8808145,0.000308745801 L18.7208147,0.000308745801 C18.3819127,-0.00956506322 18.0820419,0.218336765 18.0008147,0.547508699 L17.4392148,2.8803085 L0.720816225,2.8803085 C0.511503474,2.87848717 0.311759994,2.96784609 0.173616272,3.12510848 C0.0373310309,3.2839185 -0.0231151559,3.49416611 0.0080162866,3.70110843 L1.44801616,13.7811076 C1.49822848,14.1362347 1.80215669,14.4003429 2.1608161,14.4003429 L16.5608149,14.4003429 C16.9222059,14.4038644 17.2302351,14.1389592 17.2808148,13.7811076 L18.7208147,3.73710842 L19.2824146,1.44030862 L20.8808145,1.44030862 C21.2784595,1.44030862 21.6008144,1.11795367 21.6008144,0.720308684 C21.6008144,0.322663698 21.2784595,0.000308745801 20.8808145,0.000308745801 Z M15.9344149,12.9603076 L2.78721605,12.9603076 L1.54881615,4.32030837 L17.1728148,4.32030837 L15.9344149,12.9603076 Z"></path>
//                                         </g>
//                                     </g>
//                                 </svg>
//                                 <span class="cart-count">0</span>
//                             </span>
//                         </a>
//                     </li>
//                 </ul>
//             </div>

//             <div class="mobile-nav-toggle">
//                 <span class=""></span>
//             </div>
//         </div>
//     </div>`;

let nav = `
    <div class="container-fluid">
        <div class="nav-lists">
            <div class="nav-logo">
                <a href="index"><img src="" id="header-logo" alt="logo" class="nav-logo"></a>
            </div>
            <div class="menubar-container">
                <div class="menubar-set">
                    <div class="nav-list">
                        <ul class="nav-list-items-set">
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="nav-item dropdown-toggle" data-value="service_list">Services we offer</a>
                                <div class="drop-down-list nav-drop-down" id="service_list">
                                    <ul class="block-box" id="service-dropdown"></ul>
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="nav-item hidden">About Us</a>
                            </li>
                            <li>
                                <a href="contact-us.php" target="_blank" class="nav-item">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-cart-login">
                        <div class="cart-set" onclick="gotocart()">
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
                            <p>My Cart</p>
                        </div>
                        <div class="login-btn-set hidden">
                            ${usr_detail}
                            <button class="cust-btn btn-green hidden" onclick=login()>Login</button>
                        </div>
                        <div class="loged-set hidden">
                            <img src="asset/profile-pic.png" class="profile-icon" alt="profile icon">
                            <div class="name-point-box dropdown">
                                <a href="javascript:void(0)" class="profile-dropdown" data-value="settings">Andrews Murey</a>
                                <span class="coin-widget"><img src="asset/point-coin.png" class="coin-icon" alt="coin"> <span class="coin-count">145 coins</span></span>
                                <div class="profile-settings" id="settings">
                                    <a href="profile.html" class="dropdown-item">
                                        <img src="asset/profile.svg" alt="dropdown icon" class="dropdown-icon">
                                        <p>My Profile</p>
                                    </a>
                                    <a href="my-booking.html" class="dropdown-item">
                                        <img src="asset/booking.svg" alt="dropdown icon" class="dropdown-icon">
                                        <p>My Bookings</p>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <img src="asset/help.svg" alt="dropdown icon" class="dropdown-icon">
                                        <p>Help</p>
                                    </a>
                                    <div class="divider dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">
                                        <img src="asset/logout.svg" alt="dropdown icon" class="dropdown-icon">
                                        <p>Logout</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            ${usr_detail}
                            <button class="cust-btn btn-green hidden" onclick=login()>Login</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-nav-toggle">
                <span class=""></span>
            </div>
        </div>
    </div>
`;

let footer = `
    <div class="container-fluid">
        <div class="ft-contact-set">
            <img src="" id="footer-logo" alt="logo" class="ft-logo">
            <div class="ft-lists">
                <div class="ft-list">
                    <div class="ft-list-inner">
                        <ul class="ft-cont-set">
                            <li>
                                <img src="asset/mail-white.svg" alt="icon" class="ft-icon">
                                <p>support@airportzo.com</p>
                            </li>
                            <li>
                                <img src="asset/call-white.svg" alt="icon" class="ft-icon">
                                <p>+91 8610725198 <span>(24/7 Customer Support)</span></p>
                            </li>
                        </ul>
                    </div>
                    <div class="ft-list-inner">
                        <h2>FOLLOW US</h2>
                        <ul class="ft-social-list-set">
                            <li>
                                <a href="https://www.facebook.com/airportzo.services" target="_blank">
                                    <img src="asset/fb.svg" alt="" class="social-med-icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/airportzoservices/" target="_blank">
                                    <img src="asset/instagram.svg" alt="" class="social-med-icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/AirportZo" target="_blank">
                                    <img src="asset/twitter.svg" alt="" class="social-med-icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/airportzo/?viewAsMember=true" target="_blank">
                                    <img src="asset/linkedin.svg" alt="" class="social-med-icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCy3DiuO_KYPNMVoMPf7-YxQ" target="_blank">
                                    <img src="asset/youtube.svg" alt="" class="social-med-icon">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ft-list-inner">
                        <h2>Coming soon on</h2>
                        <ul class="ft-store-set">
                            <li>
                                <img src="asset/appstore.svg" alt="" class="store-icon">
                            </li>
                            <li>
                                <img src="asset/playstore.svg" alt="" class="store-icon">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ft-list">
                    <ul>
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li class="hidden">
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            <a href="contact-us.php" target="_blank">Contact Us</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="becomeAnAgent()">Become an agent</a>
                        </li>
                    </ul>
                </div>
                <div class="ft-list">
                    <h2>SERVICES WE OFFER</h2>
                    <ul id="footer-service-list"></ul>
                </div>
                <div class="ft-list">
                    <div class="ft-list-inner">
                        <h2>CORPORATE OFFICE</h2>
                        <ul class="ft-cont-set">
                            <li>
                                <img src="asset/location.svg" alt="icon" class="ft-icon">
                                <p>
                                    P.O.Box 124465<br>
                                    Sharjah - U.A.E
                                </p>
                            </li>
                            <li>
                                <img src="asset/call-white.svg" alt="icon" class="ft-icon">
                                <p>+91 8610725198</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="ft-line">

        </div>
        <div class="container-fluid">
        <div class="ft-cpy-rights-set">
            <ul>
                <li>
                    <div class="ft-terms-cond-set">
                        <a href="terms" class="c" target="_blank">Terms and Conditions</a>
                        <span>|</span>
                        <a href="cancellation_policy" target="_blank" class="c">Cancellation Policy</a>
                    </div>
                </li>
                <li>
                    <p class="ft-c-r-set">© <span class="get-year">2022</span> Airportzo. All Rights Reserved</p>
                </li>
            </ul>
        </div>
    </div>
`;

$("header").html(header);
$("nav").html(nav);
$("footer").html(footer);
$("#login_modal").html(login_modal);

// go to checkout process page
function becomeAnAgent() {
    var usr_exist = $("body").attr("data-usr-token");
    if (usr_exist && usr_exist != 0) {
        window.location.href = "agent-application.php";
    } else {
        swal("Please login to proceed for agent application !");
    }
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
                $("#service-dropdown").append(`<li>
                    <a href="service-details.php?id=${serviceObj.token}">${serviceObj.name}</a>
                </li>`);
                $("#footer-service-list").append(`<li>
                    <a href="service-details.php?id=${serviceObj.token}">${serviceObj.name}</a>
                </li>`);
            });
        }
    },
});

// Header scroll class //
$(window).scroll(function () {
    if ($(this).scrollTop() > 30) {
        $("header").addClass("header-scrolled");
        $("nav").addClass("topbar-scrolled");
    } else {
        $("header").removeClass("header-scrolled");
        $("nav").removeClass("topbar-scrolled");
    }
});

//menu Profile dropdown
$(`.dropdown-toggle`).on("click", function (event) {
    $(`.drop-down-list`).removeClass("active");
    let result = $(this).attr("data-value");
    $(`#${result}`).toggleClass("active");
});
$(`.dropdown-toggle1`).on("click", function (event) {
    // $(`.drop-down-list`).removeClass("active");
    let result = $(this).attr("data-value");
    $(`#${result}`).toggleClass("active");
});
$(`.profile-dropdown`).on("click", function (event) {
    $(".profile-settings").toggleClass("hidden");
});

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    // if (event.target.matches('.dropdown-toggle')) {
    if (!event.target.matches(".dropdown-toggle")) {
        $(".drop-down-list").removeClass("active");
    }
    // }
};

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

function sendOtp() {
    var pass = 0;
    if (document.getElementById("login-phone").value.trim() != "") {
        if (iti.isValidNumber()) {
            document.getElementById("login-phoneErr").innerHTML = "";
            pass++;
        } else {
            var errorMap = [
                "Invalid number",
                "Invalid country code",
                "Too short",
                "Too long",
                "Invalid number",
            ];
            var errorCode = iti.getValidationError();
            document.getElementById("login-phoneErr").innerHTML = errorMap[errorCode];
        }
    } else {
        document.getElementById("login-phoneErr").innerHTML = "* Please Enter Mobile Number!";
    }
    if (pass == 1) {
        var mobileNumber = $("#login-phone").val().trim();
        mobileNumber = mobileNumber.replace(/\s/g,'');
        var country_code = $("#login-phone")
            .siblings(".iti__flag-container")
            .find(".iti__selected-flag")
            .attr("title");
        // country_code = "+" + country_code.replace(/[^0-9]/g, "");
        country_code = country_code.replace(/[^0-9]/g, "");
        var inputData = {
            country_code: country_code,
            mobile_number: mobileNumber,
        };
        inputData = JSON.stringify(inputData);
        $.ajax({
            url: "php/users/user-authentication.php",
            data: inputData,
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                if (response.status_code == 200) {
                    $("#phone-view").text(country_code + "-" + mobileNumber);

                    $("#login_with_mobileno").css("display", "none");
                    $("#send_otp").css("display", "none");
                    $(".otp-input").val("");
                    $("#login_otp").removeClass("hidden");
                    $(".heading-set-mob").addClass("hidden");
                    $(".heading-set-otp").removeClass("hidden");
                    $("#verify_otp").removeClass("hidden");
                    $("#login_otp").css("display", "block");
                    $("#verify_otp").css("display", "block");
                    $(".first-otp").focus();

                    generate_otp_timmer();
                }else {
                    swal("",response.message,"error");
                }
                // else if (response.status_code == 201){
                //     inputData = {mobile_number: mobileNumber};
                //     inputData = JSON.stringify(inputData);
                //     $.ajax({
                //         url: "php/users/user-verification.php",
                //         data: inputData,
                //         type: "POST",
                //         dataType: "JSON",
                //         success: function (response) {
                //             if (response.status_code == 200) {
                //                 if (isOnCheckout) {
                //                     window.location.href = "checkout-process.php";
                //                 } else {
                //                     window.location.reload();
                //                 }
                //             } else {
                //                 alert(response.message);
                //             }
                //         },
                //     });
                // }
            },
        });
    }
}

function verifyOtp() {
    var mobileNumber = $("#login-phone").val().trim();
    mobileNumber = mobileNumber.replace(/\s/g,'');
    var country_code = $("#login-phone")
        .siblings(".iti__flag-container")
        .find(".iti__selected-flag")
        .attr("title");
    // country_code = "+" + country_code.replace(/[^0-9]/g, "");
    country_code = country_code.replace(/[^0-9]/g, "");
    var otp = "";
    $(".otp-input").each(function () {
        otp += $(this).val();
    });
    var inputData = {
        country_code: country_code,
        mobile_number: mobileNumber,
        otp: otp,
    };
    inputData = JSON.stringify(inputData);
    $.ajax({
        url: "php/users/user-verification.php",
        data: inputData,
        type: "POST",
        dataType: "JSON",
        success: function (response) {
            if (response.status_code == 200) {
                if (isOnCheckout) {
                    window.location.href = "checkout-process.php";
                } else {
                    window.location.reload();
                }
            } else {
                swal("",response.message,"error");
            }
        },
    });
}

// open login modal
function login() {
    $("#login_modal").modal(true);
    $("body").removeClass("nav-avtive");
}

// telephone input
// const phoneInputField = document.querySelector("#phone");
// const phoneInput = window.intlTelInput(phoneInputField, {
//     utilsScript:
//     "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
// });
//OTP
$(".otp-group")
    .find("input")
    .each(function () {
        $(this).attr("maxlength", 1);
        $(this).on("keyup", function (e) {
            var parent = $($(this).parent());
            if (e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find("input#" + $(this).data("previous"));
                if (prev.length) {
                    $(prev).select();
                }
            } else if (
                (e.keyCode >= 48 && e.keyCode <= 57) ||
                (e.keyCode >= 65 && e.keyCode <= 90) ||
                (e.keyCode >= 96 && e.keyCode <= 105) ||
                e.keyCode === 39
            ) {
                var next = parent.find("input#" + $(this).data("next"));
                if (next.length) {
                    $(next).select();
                } else {
                    if (parent.data("autosubmit")) {
                        parent.submit();
                    }
                }
            }
        });
    });
// Login Option Emial || Phone no
$(".login-option").on("click", function () {
    let get_option = $(this).attr("data-value");
    if (get_option == "login-by-email") {
        $("#login_with_email").removeClass("hidden");
        $("#login_with_mobileno").addClass("hidden");
    } else if (get_option == "login-by-phonenumber") {
        $("#login_with_mobileno").removeClass("hidden");
        $("#login_with_email").addClass("hidden");
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
$(".resend-otp").on("click", function () {
    $(".resend-otp-note").addClass("hidden");
    $(".otp-timer").removeClass("hidden");
    generate_otp_timmer();
});

// Press Enter to login
const lastOtp = document.querySelector(".last-otp");
if (document.body.contains(lastOtp)) {
    lastOtp.addEventListener("keydown", function (e) {
        if (e.key == "Enter") {
            verifyOtp();
        }
    });
}

// Go to cart
var cartCount = 0;
function gotocart() {
    if (cartCount <= 0) {
        swal("","Cart is Empty!..","error");
    } else {
        window.location.href = "checkout.php"; //"my-cart.php";
    }
}

// copyright year
let currentYear = new Date().getFullYear();
$(".current_year").text(currentYear);

// Login telephone code
// telephone input
// const phoneInputField = document.querySelector("#login-phone");
// const phoneInput = window.intlTelInput(phoneInputField, {
//   separateDialCode: true,
//   preferredCountries: ["in"],
//   hiddenInput: "full",
//   geoIpLookup: function (callback) {
//     $.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
//       var countryCode = resp && resp.country ? resp.country : "";
//       callback(countryCode);
//     });
//   },
//   utilsScript:
//     "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js",
// });
// var phoneInputMask = $("#login-phone").attr('placeholder').replace(/[0-9]/g, 0);
// $('#login-phone').mask(phoneInputMask);
// $("#login-phone").on("countrychange", function (e, countryData) {
//     $("#login-phone").val('');
//     var mask1 = $("#login-phone").attr('placeholder').replace(/[0-9]/g, 0);
//     $('#login-phone').mask(mask1);
// });

// $("#login-phone").change(function() {
//     var full_number = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
// });

var iti = "";
var mask = "";
var id = ["#login-phone,#passengerMobile"];
id.forEach(function (value, i) {
    var phoneInputID = value;
    var input = document.querySelector(phoneInputID);
    iti = window.intlTelInput(input, {
        separateDialCode: false,
        initialCountry: "in",
        utilsScript:"js/utils.js",
    });

    $(phoneInputID).on("countrychange", function (event) {
        var selectedCountryData = iti.getSelectedCountryData();
        (newPlaceholder = intlTelInputUtils.getExampleNumber(
            selectedCountryData.iso2,
            true,
            intlTelInputUtils.numberFormat.INTERNATIONAL
        )),
            (newPlaceholder = newPlaceholder.replace(/[()]/g, ""));
        newPlaceholder = newPlaceholder.replace(/[-]/g, " ");
        iti.setNumber("");

        $(this).val("");
        $(this).attr("placeholder", newPlaceholder);
        mask = newPlaceholder.replace(/[1-9]/g, "0");
        // Apply the new mask for the input
        $(this).mask(mask);
        var check_mob_no_len = $(value).attr("placeholder").replace("0", "");
        check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g, "");
    });

    iti.promise.then(function () {
        $(phoneInputID).trigger("countrychange");
    });
});
