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
    <title>Airportzo | Profile</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/profile.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <div class="main">
        <!--LOADER-->
        <div id="loading"></div>

        <header></header>

        <!-- NAV MENU -->
        <nav></nav>

        <section class="profile-sec">
            <input type="hidden" id="gtag_id">
            <div class="container">
                <div class="verification-msg-box hidden">
                    <p><span type="button" class="btn step-btn btn-circle status-completed" style="margin-right: 6px;"></span> Your details for AirportZo agent has been submitted successfully and it is under verfication. Verification may take upto 2 days.</p>
                </div>
                <div class="profile-set">
                    <div class="box_1">
                        <div class="profileleft-set">
                            <div class="profile-card">
                                <div class="profile-desc-set">
                                    <div class="profile-pic-set">
                                        <img src="" class="profile-img profile-small" alt="icon" style="display: none;">
                                        <!-- asset/profile/user.jpg -->
                                        <svg class="user-svg user-svg-small" width="100" height="100" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="user-icon">
                                                <g id="circles">
                                                    <mask id="mask0_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="86" height="86">
                                                        <g id="mask-2">
                                                            <path id="Vector" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="white" />
                                                        </g>
                                                    </mask>
                                                    <g mask="url(#mask0_104_13)">
                                                        <path id="user-circle2-sm" opacity="0.1" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="#F04F38" />
                                                    </g>
                                                    <mask id="mask1_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="6" width="74" height="74">
                                                        <g id="mask-4">
                                                            <path id="Vector_2" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="white" />
                                                        </g>
                                                    </mask>
                                                    <g mask="url(#mask1_104_13)">
                                                        <path id="user-circle1-sm" opacity="0.14" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="#F04F38" />
                                                    </g>
                                                </g>
                                                <g id="">
                                                    <path id="user-icon-sm" fill-rule="evenodd" clip-rule="evenodd" d="M42.7472 43.7403C48.164 43.7403 52.5553 39.3213 52.5553 33.8701C52.5553 28.419 48.164 24 42.7472 24C37.3303 24 32.9391 28.419 32.9391 33.8701C32.9391 39.3213 37.3303 43.7403 42.7472 43.7403ZM26 51.9232C29.9016 58.6411 35.4839 62 42.7472 62C50.0104 62 55.7613 58.6411 60 51.9232C57.3035 46.9087 53.9351 44.4014 49.8946 44.4014C48.8343 44.4014 48.243 46.4057 43 46.4057C37.757 46.4057 36.7574 44.4014 35.9238 44.4014C31.8177 44.5735 28.5097 47.0808 26 51.9232Z" fill="#F04F38" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="profile-info-set">
                                        <h3 id="usr-name-view"></h3>
                                        <p id="usr-mobile"></p>
                                        <p id="usr-email"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Setting-title">
                            <ul class="nav nav-tabs list-content">
                                <li class="agent-content">
                                    <a class="" data-toggle="tab" href="#agent_dashboard" role="tab">
                                        <svg class="list-of-images" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="290102_control-panel_dashboard_gauge_measure_meter_icon-copy" transform="translate(1.000000, 4.000000)" fill="#07B3D2" fill-rule="nonzero" stroke="#07B3D2" stroke-width="0.5">
                                        <path d="M21.947619,12.3069399 C21.947619,12.3128333 21.9507619,12.3171194 21.9507619,12.322477 C21.9507619,12.3251558 21.9491905,12.3278346 21.9491905,12.3310491 C21.9497143,12.3337279 21.9507619,12.3364067 21.9507619,12.3396213 C21.9507619,12.6353607 21.716619,12.8753812 21.4269524,12.8753812 C21.4348095,12.8748454 16.7619048,12.8582368 16.7619048,12.8582368 C16.4722381,12.8582368 16.2380952,12.6182164 16.2380952,12.322477 C16.2380952,12.0262018 16.4722381,11.7867171 16.7619048,11.7867171 L20.9240952,11.7867171 C20.9340476,11.6077733 20.952381,11.4320441 20.952381,11.2509572 C20.952381,5.62922894 16.4963333,1.07151974 11,1.07151974 C5.50366667,1.07151974 1.04761905,5.62922894 1.04761905,11.2509572 C1.04761905,11.4320441 1.06595238,11.6077733 1.07538095,11.7867171 L5.23809524,11.7867171 C5.5277619,11.7867171 5.76190476,12.0262018 5.76190476,12.322477 C5.76190476,12.6182164 5.5277619,12.8582368 5.23809524,12.8582368 C5.23809524,12.8582368 0.565714286,12.8748454 0.573047619,12.8748454 C0.283380952,12.8748454 0.0492380952,12.634825 0.0492380952,12.3390855 C0.0492380952,12.335871 0.0502857143,12.3331922 0.0508095238,12.3305134 C0.0508095238,12.3272988 0.0492380952,12.32462 0.0492380952,12.3219412 C0.0492380952,12.3160479 0.0523809524,12.3117618 0.0523809524,12.3069399 C0.0204285714,11.958696 0,11.6072376 0,11.2509572 C0,5.03667853 4.92485714,0 11,0 C17.0751429,0 22,5.03667853 22,11.2509572 C22,11.6072376 21.9795714,11.958696 21.947619,12.3069399 Z M7.60728571,5.96193582 C7.81314286,5.84621169 8.06038095,5.8847864 8.23009524,6.03319188 L8.20390476,5.98872381 C12.7998095,9.42830217 13.7442381,11.0104011 13.7615238,11.0398679 C14.5121429,12.3026539 14.0658571,13.9174341 12.7668095,14.6460675 C11.4677619,15.374701 9.80571429,14.9423427 9.05561905,13.6795567 C9.03728571,13.6511615 8.10019048,12.0647765 7.3317619,6.47787257 L7.35847619,6.52180488 C7.31185714,6.30535789 7.40195238,6.07712419 7.60728571,5.96193582 Z M9.99742857,13.152369 C10.2881429,13.6404463 10.8297619,13.9442221 11.4111905,13.9442221 C11.6950952,13.9442221 11.976381,13.870823 12.2241429,13.7315254 C12.6012857,13.5199003 12.8710476,13.179157 12.9836667,12.7703722 C13.0968095,12.3610517 13.0386667,11.9345868 12.8249524,11.5745562 C12.8160476,11.5611622 12.0015238,10.2962332 8.602,7.63779269 C9.273,11.8247561 9.99166667,13.1416538 9.99742857,13.152369 Z" id="agent-dash"></path></g></g></svg>Agent Dashboard
                                    </a>
                                </li>
                                <li class="">
                                    <a class="" data-toggle="tab" href="#update_profile" role="tab">
                                        <svg class="list-of-images" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>edit</title>
                                            <g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M4.56741184,20 L8.41899408,20 C8.43815618,20 8.45696343,19.9989259 8.47577068,19.9971358 C8.48960997,19.9957037 8.50344927,19.9931975 8.51728856,19.9910493 C8.52190166,19.9903332 8.52651476,19.9899752 8.53112786,19.9889011 C8.54745113,19.9856789 8.56341955,19.9813825 8.57938796,19.9767282 C8.58116223,19.9763702 8.5829365,19.9760121 8.58471077,19.9752961 C8.60067919,19.9702837 8.6166476,19.9645552 8.63190631,19.9581107 C8.63332573,19.9573947 8.6351,19.9570366 8.63687427,19.9563206 C8.65177812,19.9502341 8.66597227,19.9430736 8.67981157,19.935913 C8.68229554,19.9348389 8.68477952,19.9337648 8.68690864,19.9323327 C8.70003823,19.9251722 8.71245811,19.9176536 8.72487799,19.9094189 C8.72807167,19.9072708 8.73162021,19.9054806 8.73481389,19.9033325 C8.74652406,19.8954558 8.75787938,19.8865051 8.76887985,19.8779125 C8.77242839,19.8750482 8.77597692,19.8729001 8.77917061,19.8700359 C8.79371961,19.8582209 8.8075589,19.8453319 8.82068849,19.8320849 L17.5848656,10.9895109 C17.5855753,10.9887948 17.586285,10.9880788 17.5873496,10.9873627 C17.5884141,10.9866467 17.588769,10.9859306 17.5894787,10.9848565 L19.6802768,8.87535593 L19.6802768,8.87535593 C19.8864468,8.6673417 20.0000004,8.39094413 20.0000004,8.09664517 C20.0000004,7.80270423 19.8864468,7.52594863 19.6802768,7.31829243 L16.7101512,4.32195662 C16.2846816,3.89268113 15.592362,3.89268113 15.1668924,4.32195662 L13.0746749,6.43288934 C13.07432,6.43324737 13.0739651,6.43324737 13.0739651,6.4336054 C13.0739651,6.43396343 13.0736103,6.43432145 13.0732554,6.43432145 L4.16607228,15.4208227 C4.15294269,15.4340697 4.14052281,15.4480328 4.12881264,15.4623539 C4.12561896,15.4659342 4.12313498,15.4702305 4.12029615,15.4738108 C4.11177966,15.4849097 4.10326317,15.4956505 4.09581125,15.5074654 C4.09332727,15.5110457 4.091553,15.514626 4.08942388,15.5182063 C4.0816171,15.5303792 4.07416517,15.5429102 4.06706809,15.5557992 C4.06564868,15.5583054 4.06458412,15.5611696 4.06351956,15.5636758 C4.05642248,15.5776389 4.04932541,15.59196 4.0432929,15.6066392 C4.04258319,15.6084293 4.04187348,15.6102195 4.04116377,15.6120096 C4.03513126,15.6274048 4.02909875,15.643158 4.02448565,15.6592693 C4.02377594,15.6610594 4.02342109,15.6632076 4.02306623,15.6649977 C4.01845314,15.680751 4.01419489,15.6968622 4.01100121,15.7133315 C4.00993665,15.7179859 4.00958179,15.7229983 4.00887208,15.7276526 C4.00638811,15.7412577 4.00425899,15.7548627 4.00283957,15.7688258 C4.0010653,15.7878013 4.00000037,15.8067768 4.00000037,15.8261103 L4.00000037,19.4271553 C3.99964589,19.743652 4.25372115,20 4.56741184,20 Z M5.13517778,18.8543106 L5.13517778,16.0634828 L13.4753047,7.64911024 L16.3826212,10.5824331 L8.18372607,18.8543106 L5.13517778,18.8543106 Z M15.9383444,5.16403833 L18.8456609,8.09700319 L17.1853003,9.77221591 L14.2779838,6.83889302 L15.9383444,5.16403833 Z" id="edit-icon" stroke="#F04F38" stroke-width="0.5" fill="#F04F38" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>Update profile
                                    </a>
                                </li>
                                <li>
                                    <a class="" data-toggle="tab" href="#saved_gst_num" role="tab">
                                        <svg class="list-of-images" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>gst</title>
                                            <g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M8.57142857,4.22222222 L6.28571429,4.22222222 C5.02334857,4.22222222 4,5.21714444 4,6.44444444 L4,19.7777778 C4,21.0051111 5.02334857,22 6.28571429,22 L17.7142857,22 C18.9766857,22 20,21.0051111 20,19.7777778 L20,6.44444444 C20,5.21714444 18.9766857,4.22222222 17.7142857,4.22222222 L15.4285714,4.22222222 M8.57142857,4.22222222 C8.57142857,5.44952222 9.59477714,6.44444444 10.8571429,6.44444444 L13.1428571,6.44444444 C14.4052571,6.44444444 15.4285714,5.44952222 15.4285714,4.22222222 M8.57142857,4.22222222 C8.57142857,2.99492222 9.59477714,2 10.8571429,2 L13.1428571,2 C14.4052571,2 15.4285714,2.99492222 15.4285714,4.22222222 M12,12 L15.4285714,12 M12,16.4444444 L15.4285714,16.4444444" id="gst-icon" stroke="#F04F38" stroke-width="1.6"></path>
                                            </g>
                                        </svg>Saved GST numbers
                                    </a>
                                </li>
                                <li>
                                    <a class="" data-toggle="tab" href="#saved_passenger_list" role="tab">
                                        <svg class="list-of-images" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>Saved passenger list</title>
                                            <g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <path d="M15.3058851,2 L15.3058851,5.89423077 L21.0282392,5.89423077 C22.1539482,5.89423077 23.0451345,6.80769231 22.9982299,7.96153846 L22.9982299,19.9326923 C22.9982299,21.0865385 22.1070436,22 20.9813346,22 L3.01689528,22 C1.89118629,22 1,21.0865385 1,19.9326923 L1,7.96153846 C1,6.80769231 1.89118629,5.89423077 3.01689528,5.89423077 L8.73924934,5.89423077 L8.73924934,2 L15.3058851,2 Z M8.73924934,7.33653846 L3.01689528,7.33653846 C2.68856349,7.33653846 2.40713624,7.625 2.40713624,7.96153846 L2.40713624,19.9326923 C2.40713624,20.2692308 2.68856349,20.5576923 3.01689528,20.5576923 L21.0282392,20.5576923 C21.356571,20.5576923 21.6379982,20.2692308 21.6379982,19.9326923 L21.6379982,7.96153846 C21.6379982,7.625 21.356571,7.33653846 21.0282392,7.33653846 L15.3058851,7.33653846 L15.3058851,9.59615385 L8.73924934,9.59615385 L8.73924934,7.33653846 Z M8.1294903,10.4615385 C9.58353108,10.4615385 10.7561446,11.6634615 10.7561446,13.1538462 C10.7561446,13.8269231 10.4747174,14.4519231 10.099481,14.9326923 C11.5535218,15.7019231 12.5854217,17.2403846 12.5854217,19.0673077 L11.1782855,19.0673077 C11.1782855,17.2884615 9.81805379,15.8942308 8.08258576,15.8942308 C6.34711772,15.8942308 4.98688602,17.3365385 4.98688602,19.0673077 L3.57974978,19.0673077 C3.57974978,17.2403846 4.61164969,15.7019231 6.11259502,14.9807692 C5.69045414,14.5 5.45593144,13.875 5.45593144,13.2019231 C5.45593144,11.7115385 6.67544951,10.4615385 8.1294903,10.4615385 Z M19.9963393,16.9038462 L19.9963393,18.3461538 L14.602317,18.3461538 L14.602317,16.9038462 L19.9963393,16.9038462 Z M19.9963393,13.875 L19.9963393,15.3173077 L14.602317,15.3173077 L14.602317,13.875 L19.9963393,13.875 Z M8.08258576,11.9519231 C7.42592218,11.9519231 6.86306768,12.4807692 6.86306768,13.2019231 C6.86306768,13.875 7.42592218,14.4519231 8.08258576,14.4519231 C8.73924934,14.4519231 9.30210383,13.875 9.30210383,13.2019231 C9.30210383,12.5288462 8.73924934,11.9519231 8.08258576,11.9519231 Z M13.8987489,3.44230769 L10.1463856,3.44230769 L10.1463856,8.15384615 L13.8987489,8.15384615 L13.8987489,3.44230769 Z" id="saved-passenger-icon" fill="#F04F38" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>Saved passenger list
                                    </a>
                                </li>
                                <li class="agent-content">
                                    <a class="" data-toggle="tab" href="#saved_bank" role="tab">
                                        <img class="list-of-images" src="asset/profile/bank.svg" alt="">Saved bank account
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box_2">
                        <div class="tab-content">
                            <div class="tab-pane fade in active agent-content" id="agent_dashboard">
                                <div class="gst-set">
                                    <div class="gst-header-set">
                                        <h2>Agent Dashboard</h2>
                                    </div>
                                    <div class="agent-dashboard-container">
                                        <div class="agent-dashboard-cards">
                                            <!-- <div class="col-md-4 padz">
                                                <div class="agent-dash-card-sm">
                                                    <p>Total Booked</p>
                                                    <h3 class="dashboard-card-count">458</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-2 padz">
                                            </div>
                                            <div class="col-md-4 padz">
                                                <div class="agent-dash-card-sm">
                                                    <p>Total Booked Amount</p>
                                                    <h3 class="dashboard-card-count booking-amount">2,245</h3>
                                                </div>
                                            </div> -->
                                            <div class="col-md-3 padz">
                                                <div class="agent-dash-card-sm">
                                                    <p>Total Booked</p>
                                                    <h3 class="dashboard-card-count booking-count">0</h3>
                                                </div>
                                                <div class="agent-dash-card-sm hidden">
                                                    <p>Total Booked Amount</p>
                                                    <h3 class="dashboard-card-count">0</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-7 padz">
                                                <div class="agent-dash-card-lg">
                                                    <div class="d-flex">
                                                        <div>
                                                            <p>Total Booked Amount</p>
                                                            <h3 class="dashboard-card-count">₹ <span class="booking-amount">0</span></h3>
                                                        </div>
                                                        <img src="" alt="">
                                                    </div>
                                                    <button class="cust-btn cust-btn-md btn-green hidden">Encash Miles</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="agent-dashboard-details">
                                            <select name="" id="month-filter" class="select_month" onchange="monthFilter()"></select>
                                            <div class="targets">
                                                <div class="booking-target">
                                                    <p>Monthly Target</p>
                                                    <h4><span class="booking-count">0</span>/40 bookings</h4>
                                                </div>
                                                <span class="divider hidden"></span>
                                                <div class="earned-miles hidden">
                                                    <p>Earned Miles</p>
                                                    <h4>1,846</h4>
                                                </div>
                                            </div>
                                            <div class="bookings_earnings" id="booking-history"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="update_profile">
                                <div class="gst-set">
                                    <div class="gst-header-set">
                                        <h2>Update profile</h2>
                                        <!-- <a href="javascript:void(0)">Add new GST </a> -->
                                    </div>
                                    <div class="cont-file">
                                        <div class="gst-input-group">
                                            <div class="content">
                                                <img src="" class="profile-img profile-big" id="user-img" alt="icon" style="display: none;">
                                                <!-- asset/profile/user.jpg -->
                                                <input type="file" name="" class="update-profile hidden" id="update-img" accept="image/png, image/jpg, image/jpeg" onchange="image_upload()">
                                                <svg class="user-svg user-svg-big" width="100" height="100" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="user-icon">
                                                        <g id="circles">
                                                            <mask id="mask0_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="86" height="86">
                                                                <g id="mask-2">
                                                                    <path id="Vector" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="white" />
                                                                </g>
                                                            </mask>
                                                            <g mask="url(#mask0_104_13)">
                                                                <path id="user-circle2" opacity="0.1" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="#F04F38" />
                                                            </g>
                                                            <mask id="mask1_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="6" width="74" height="74">
                                                                <g id="mask-4">
                                                                    <path id="Vector_2" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="white" />
                                                                </g>
                                                            </mask>
                                                            <g mask="url(#mask1_104_13)">
                                                                <path id="user-circle1" opacity="0.14" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="#F04F38" />
                                                            </g>
                                                        </g>
                                                        <g id="">
                                                            <path id="user-icon" fill-rule="evenodd" clip-rule="evenodd" d="M42.7472 43.7403C48.164 43.7403 52.5553 39.3213 52.5553 33.8701C52.5553 28.419 48.164 24 42.7472 24C37.3303 24 32.9391 28.419 32.9391 33.8701C32.9391 39.3213 37.3303 43.7403 42.7472 43.7403ZM26 51.9232C29.9016 58.6411 35.4839 62 42.7472 62C50.0104 62 55.7613 58.6411 60 51.9232C57.3035 46.9087 53.9351 44.4014 49.8946 44.4014C48.8343 44.4014 48.243 46.4057 43 46.4057C37.757 46.4057 36.7574 44.4014 35.9238 44.4014C31.8177 44.5735 28.5097 47.0808 26 51.9232Z" fill="#F04F38" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                <label for="update-img">Update Image</label>
                                            </div>
                                            <div class="input-form-group-item">
                                                <div class="select-group">
                                                    <select class="select-box" id="user-title">
                                                        <option value="NULL">NULL</option>
                                                        <option value="Mr">Mr.</option>
                                                        <option value="Mrs">Mrs.</option>
                                                        <option value="Ms">Ms.</option>
                                                    </select>
                                                </div>
                                                <div class="input-box-sets border-right">
                                                    <p>Your Name</p>
                                                    <input type="text" class="input-box" id="user-name" placeholder="Enter your name">
                                                </div>
                                            </div>
                                            <div class="login-input-action-set">
                                                <div class="login-input-group phone">
                                                    <p>Mobile Number</p>
                                                    <input type="tel" class="login-input-box" id="user-mobile_number" name="phone" />
                                                </div>
                                            </div>
                                            <div class="input-form-group-item">
                                                <div class="input-box-sets">
                                                    <p>Email Address</p>
                                                    <input type="text" class="input-box" id="user-email" placeholder="example@gmail.com">
                                                </div>
                                            </div>
                                            <div>
                                                <button class="update-btn">Update profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="saved_gst_num">
                                <div class="gst-set">
                                    <div class="gst-header-set">
                                        <h2>Saved GST numbers</h2>
                                        <!--  <a href="javascript:void(0)">Add new GST </a> -->
                                        <!-- <input type="search" name="" class="serarch-cont" placeholder="Search"> -->
                                    </div>
                                    <div class="gst-group" id="gst-list-view"></div>
                                    <div class="gst-contct">
                                        <button class="btn-gst sec-btn" data-toggle="modal" data-target="#add_gst_modal">Add GSTIN</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="saved_passenger_list">
                                <div class="gst-set">
                                    <div class="gst-header-set">
                                        <h2>Saved Pasengers</h2>
                                        <!--  <a href="javascript:void(0)">Add new GST </a> -->
                                        <!-- <input type="search" name="" class="serarch-cont" placeholder="Search"> -->
                                    </div>
                                    <div class="gst-group" id="passenger-list-view"></div>
                                    <div class="gst-contct">
                                        <button class="add_btn sec-btn" data-toggle="modal" data-target="#add_passenger_modal">Add Passenger</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade agent-content" id="saved_bank">
                                <div class="gst-set">
                                    <div class="gst-header-set">
                                        <h2>Saved bank account</h2>
                                        <!--  <a href="javascript:void(0)">Add new GST </a> -->
                                        <!-- <input type="search" name="" class="serarch-cont" placeholder="Search"> -->
                                    </div>
                                    <div class="gst-group" id="bank-accounts"></div>
                                    <div class="gst-contct hidden">
                                        <button class="add_btn sec-btn" data-toggle="modal" data-target="#add_passenger_modal">Add new Bank</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer"></footer>
    </div>

    <!-- ADD GST MODAL -->
    <div id="add_gst_modal" class="modal fade add_details_modal" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <button type="button" class="login-close" data-dismiss="modal">&times;</button>
                <div class="cust-modal-body">
                    <div class="add__passenger-container">
                        <div class="page-header-set">
                            <h2>Add GST details</h2>
                        </div>
                        <div class="add__passenger-form">
                            <form action="">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Company Name</p>
                                        <input type="text" class="input-box" id="gst-name" placeholder="Enter company name">
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>GST Number</p>
                                        <input type="text" class="input-box" id="gst-number" placeholder="Enter gst number">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="butn-container">
                            <button class="primary-butn add__passenger-btn" onclick="addGst()">Add GST</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit GST MODAL -->
    <div id="edit_gst_modal" class="modal fade add_details_modal" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <button type="button" class="login-close" data-dismiss="modal">&times;</button>
                <div class="cust-modal-body">
                    <div class="add__passenger-container">
                        <input type="hidden" id="gst-token-update">
                        <div class="page-header-set">
                            <h2>Add GST details</h2>
                        </div>
                        <div class="add__passenger-form">
                            <form action="">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Company Name</p>
                                        <input type="text" class="input-box" id="gst-name-update" placeholder="Enter company name">
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>GST Number</p>
                                        <input type="text" class="input-box" id="gst-number-update" placeholder="Enter gst number">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="butn-container">
                            <button class="primary-butn add__passenger-btn" onclick="updateGst()">Add GST</button>
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
                <button type="button" class="login-close" data-dismiss="modal">&times;</button>
                <div class="cust-modal-body">
                    <div class="add__passenger-container">
                        <div class="page-header-set">
                            <h2>Add new passenger</h2>
                            <p>Please enter the new passenger details</p>
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
                                        <p>Passenger Name</p>
                                        <input type="text" class="input-box" id="passenger-name" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="login-input-action-set">
                                    <div class="login-input-group phone">
                                        <p>Mobile Number</p>
                                        <input type="tel" class="login-input-box" id="passenger-mobile" name="phone" />
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Email Address</p>
                                        <input type="text" class="input-box" id="passenger-email" placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="dob-input input-group hidden" id="arrive_date">
                                    <span class="input-group-addon bg-date"></span>
                                    <label for="arrive_date">Date of birth</label>
                                    <input type="text" class="b-input datepicker" id="passenger-dob" placeholder="DD/MMM/YYYY" readonly="">
                                </div>
                            </form>
                        </div>
                        <div class="butn-container">
                            <button class="primary-butn add__passenger-btn" onclick="addPassenger()">Add Passenger</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit PASSENGER MODAL -->
    <div id="edit_passenger_modal" class="modal fade" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <button type="button" class="login-close" data-dismiss="modal">&times;</button>
                <div class="cust-modal-body">
                    <div class="add__passenger-container">
                        <input type="hidden" id="passenger-token-update">
                        <div class="page-header-set">
                            <h2>Edit passenger</h2>
                            <p>Please edit the passenger details</p>
                        </div>
                        <div class="add__passenger-form">
                            <form action="">
                                <div class="input-form-group-item">
                                    <div class="select-group">
                                        <select class="select-box" id="passenger-title-update">
                                            <option value=NULL>NULL</option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <p>Passenger Name</p>
                                        <input type="text" class="input-box" id="passenger-name-update" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="login-input-action-set">
                                    <div class="login-input-group phone">
                                        <p>Mobile Number</p>
                                        <input type="tel" class="login-input-box" id="passenger-mobile-update" name="phone" />
                                    </div>
                                </div>
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Email Address</p>
                                        <input type="text" class="input-box" id="passenger-email-update" placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="dob-input input-group hidden" id="arrive_date">
                                    <span class="input-group-addon bg-date"></span>
                                    <label for="arrive_date">Date of birth</label>
                                    <input type="text" class="b-input datepicker" id="passenger-dob-update" placeholder="DD/MMM/YYYY" readonly="">
                                </div>
                            </form>
                        </div>
                        <div class="butn-container">
                            <button class="primary-butn add__passenger-btn" onclick="updatePassenger()">Update Passenger</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script>
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

        var passengerList = [];
        var gstList = [];

        // -----Country Code Selection
        const input = document.querySelector("#user-mobile_number");
        const userMobileNumber = window.intlTelInput(input, {
            separateDialCode: true,
            preferredCountries:["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        // -----Country Code Selection
        const addInput = document.querySelector("#passenger-mobile");
        const passengerMobile = window.intlTelInput(addInput, {
            separateDialCode: true,
            preferredCountries:["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        // -----Country Code Selection
        const updateInput = document.querySelector("#passenger-mobile-update");
        const passengerMobileUpdate = window.intlTelInput(updateInput, {
            separateDialCode: true,
            preferredCountries:["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        $(document).ready(function() {
            if ($('body').attr('data-usr-token') == 0) {
                window.location.href = "index.php";
            }

            $('#bank-accounts').empty();
            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users/read-detail.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;

                        var usrTitle = (responseData.title != '') ? responseData.title : "NULL";
                        var usrTitleView = (usrTitle != '' && usrTitle != 'NULL') ? usrTitle : "";
                        var usrName = (responseData.name != '') ? responseData.name : "";
                        var usrNameView = (usrName != '') ? ((usrTitleView != '') ? usrTitleView + ". " : "") + usrName : "User Name";
                        var mobileNumber = (responseData.mobile_number != '') ? responseData.mobile_number : "";
                        var countryCode = responseData.country_code;
                        var mobileNumberView = (mobileNumber != '') ? countryCode + '-' + mobileNumber : "User Mobile";
                        var usrEmail = (responseData.email != '') ? responseData.email : "";
                        var usrEmailView = (usrEmail != '') ? usrEmail : "User Email";

                        $('#user-title').val(usrTitle);
                        $('#user-name').val(usrName);
                        $('#usr-name-view').text(usrNameView);
                        $('#user-mobile_number').val(mobileNumber);
                        $('#usr-mobile').text(mobileNumberView);
                        // if(mobileNumber != '') userMobileNumber.getNumber(intlTelInputUtils.numberFormat.E164) = mobileNumberView;//userMobileNumber.options.initialCountry
                        $('#user-email').val(usrEmail);
                        $('#usr-email').text(usrEmailView);

                        var isAgent = false;
                        var applicationPending = false;

                        if (responseData.is_agent && responseData.is_approved == 'Pending') {
                            applicationPending = true;
                        } else if (responseData.is_agent && responseData.is_approved == 'Approved') {
                            isAgent = true;
                        }

                        if ( applicationPending ) {
                            if ($('.verification-msg-box').hasClass('hidden')) $('.verification-msg-box').removeClass('hidden')
                        }
                        if ( !isAgent ) {
                            $('.agent-content').remove();
                        } else {
                            $.ajax({
                                async: false,
                                type: 'GET',
                                url: 'php/users-booking/read-history.php',
                                dataType: 'JSON',
                                success: function(response) {
                                    if (response.status_code == 200) {
                                        var responseData = response.data;

                                        var monthFilterArray = [];
                                        responseData.forEach(function(bookingData) {
                                            var monthFilterSplit = bookingData.date_time.split(" ");
                                            monthFilterSplit.splice(0, 1);
                                            var monthFilter = monthFilterSplit.join(" ");
                                            if ( !monthFilterArray.includes(monthFilter) ) {
                                                monthFilterArray.push(monthFilter);
                                            }
                                        });
                                        $('#month-filter').empty();
                                        monthFilterArray.forEach(function(monthFilterObj) {
                                            $('#month-filter').append(`<option value="${monthFilterObj}">${monthFilterObj}</option>`);
                                        });

                                        makeBookingHistory(responseData);
                                    }
                                }
                            });
                            $.ajax({
                                async: false,
                                type: 'GET',
                                url: 'php/users-bank/read.php',
                                dataType: 'JSON',
                                success: function(response) {
                                    response.data.forEach(function (accData) {
                                        var primayTag = (accData.is_primary)? `<div class="primary-account-label">
                                                    <p>Primary Bank</p>
                                                </div>`: ``;
                                        $('#bank-accounts').append(`<div class="input-form-group-item bank-account">
                                            <div class="input-box-sets">
                                                <div>
                                                    <img src="asset/profile/bank-circle.svg" alt="">
                                                </div>
                                                <div class="account-details">
                                                    <h4>${accData.ifsc_code}</h4>
                                                    <p>${accData.account_number}</p>
                                                    <p>${accData.branch_name}</p>
                                                </div>
                                                ${primayTag}
                                            </div>
                                        </div>`);
                                    });
                                }
                            });
                        }
                        $('.nav-tabs li:first').addClass('active');
                        $('.tab-content').find(".tab-pane:first").addClass('in active');

                        if (responseData.image != '') {
                            $('.profile-img').attr('src', responseData.image);

                            $('.profile-img').css('display', 'block');
                            $('.user-svg').css('display', 'none');
                        } else {
                            $('.profile-img').css('display', 'none');
                            $('.user-svg').css('display', 'block');
                        }
                    } else {
                        swal("", response.message, "error");
                    }
                }
            });

            $('#passenger-list-view').empty();
            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users-passenger/read.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        passengerList = responseData;

                        responseData.forEach(function(passengerData, passengerKey) {
                            $('#passenger-list-view').append(`<div class="input-form-group-item">
                                <div class="input-box-sets">
                                    <div class="input-lable">
                                        <p>${passengerData.name_view}</p>
                                        <div class="edit-cancel-set">
                                            <img src="asset/profile/edit-icon-gray.svg" class="input-edit-icon passenger-edit" data-index="${passengerKey}" alt="icon">
                                            <img src="asset/profile/close-gray.svg" class="input-cancel-icon passenger-delete" data-index="${passengerKey}" alt="icon">
                                        </div>
                                    </div>
                                    <p><img src="asset/call.svg" alt="Mobile"> ${passengerData.country_code}-${passengerData.mobile_number}</p>
                                    <p><img src="asset/mail.svg" alt="Email"> ${passengerData.email_id}</p>
                                </div>
                            </div>`);
                                    // <p>(${passengerData.age})</p>
                        });

                        $('.passenger-edit').on('click', function() {
                            var index = $(this).attr('data-index');
                            var passengerData = passengerList[index];

                            $('#passenger-token-update').val(passengerData.token);
                            $('#passenger-title-update').val(passengerData.title);
                            $('#passenger-name-update').val(passengerData.name);
                            $('#passenger-mobile-update').val(passengerData.mobile_number);
                            $('#passenger-email-update').val(passengerData.email_id);
                            $('#passenger-dob-update').val(passengerData.date_of_birth);

                            $('#edit_passenger_modal').modal('show');
                        });

                        $('.passenger-delete').on('click', function() {
                            var index = $(this).attr('data-index');
                            var userPassengerToken = passengerList[index].token;

                            swal({
                                title: "Are you sure?",
                                text: "You will not be able to recover this passenger detail!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'php/users-passenger/delete.php',
                                        dataType: 'JSON',
                                        data: JSON.stringify({
                                            token: userPassengerToken
                                        }),
                                        success: function(response) {
                                            if (response.status_code == 200) {
                                                swal("", response.message, "success")
                                                    .then(function() {
                                                        location.reload();
                                                    });
                                            } else {
                                                swal("", response.message, "error");
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    }
                }
            });

            $('#gst-list-view').empty();
            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users-gst/read.php',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;
                        gstList = responseData;

                        responseData.forEach(function(gstData, gstKey) {
                            $('#gst-list-view').append(`<div class="input-form-group-item">
                                <div class="input-box-sets">
                                    <div class="input-lable">
                                        <p>${gstData.name}</p>
                                        <div class="edit-cancel-set">
                                            <img src="asset/profile/edit-icon-gray.svg" class="input-edit-icon gst-edit" data-index="${gstKey}" alt="icon">
                                            <img src="asset/profile/close-gray.svg" class="input-cancel-icon gst-delete" data-index="${gstKey}" alt="icon">
                                        </div>
                                    </div>
                                    <p class="input-data">${gstData.gstin}</p>
                                </div>
                            </div>`);
                        });

                        $('.gst-edit').on('click', function() {
                            var index = $(this).attr('data-index');
                            var gstData = gstList[index];

                            $('#gst-token-update').val(gstData.token);
                            $('#gst-name-update').val(gstData.name);
                            $('#gst-number-update').val(gstData.gstin);

                            $('#edit_gst_modal').modal('show');
                        });

                        $('.gst-delete').on('click', function() {
                            var index = $(this).attr('data-index');
                            var gstToken = gstList[index].token;

                            swal({
                                title: "Are you sure?",
                                text: "You will not be able to recover this GST detail!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((willDelete) => {
                                if (willDelete) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'php/users-gst/delete.php',
                                        dataType: 'JSON',
                                        data: JSON.stringify({
                                            token: gstToken
                                        }),
                                        success: function(response) {
                                            if (response.status_code == 200) {
                                                swal("", response.message, "success")
                                                    .then(function() {
                                                        location.reload();
                                                    });
                                            } else {
                                                swal("", response.message, "error");
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    }
                }
            });

            $('.update-btn').on('click', function() {
                var usrTitle = $('#user-title').val().trim();
                var usrName = $('#user-name').val().trim();
                var usrImage = $('#user-img').attr('src').trim();
                var full_number = userMobileNumber.getNumber(intlTelInputUtils.numberFormat.E164);
                var mobile_number = $('#user-mobile_number').val().trim().replaceAll(" ", "");
                var country_code = full_number.replace(mobile_number, "");
                var usrEmail = $('#user-email').val().trim();

                if (usrTitle != '' && usrName != '' && mobile_number != '' && usrEmail != '') {
                    var isEmail = String(usrEmail).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
                    if (isEmail) {
                        var datas = {
                            title: usrTitle,
                            name: usrName,
                            image: usrImage,
                            country_code: country_code,
                            mobile_number: mobile_number,
                            email: usrEmail
                        };
                        datas = JSON.stringify(datas);
                        $.ajax({
                            async: false,
                            type: 'POST',
                            url: 'php/users/update.php',
                            dataType: 'JSON',
                            data: datas,
                            success: function(response) {
                                if (response.status_code == 200) {
                                    swal(response.message).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swal("", response.message, "error");
                                }
                            },
                            error: function() {
                                swal("", "Something went wrong !", "warning");
                            }
                        });
                    } else {
                        swal("", "Please check email-id !", "warning");
                    }
                } else {
                    swal("", "Please fill all the fields !", "error");
                }
            });
        });

        function monthFilter() {
            var monthFilter = $('#month-filter').val();
            var datas = {'month_filter': monthFilter};
            datas = JSON.stringify(datas);
            $.ajax({
                async: false,
                type: 'POST',
                url: 'php/users-booking/read-monthly-history.php',
                dataType: 'JSON',
                data: datas,
                success: function(response) {
                    if (response.status_code == 200) {
                        var responseData = response.data;

                        makeBookingHistory(responseData);
                    }
                }
            });
        }

        function makeBookingHistory(responseData) {
            $('#booking-history').empty();
            var totalBooking = 0;
            var totalBookingCost = 0;
            responseData.forEach(function(bookingDetail) {
                if (bookingDetail.for_others) {
                    totalBooking++;
                    totalBookingCost += parseInt(bookingDetail.total_amount);
                    $('#booking-history').append(`<div class="input-form-group-item">
                        <div class="input-box-sets">
                            <div>
                                <div class="input-lable">
                                    <p>${bookingDetail.user_name}</p>
                                </div>
                                <div>
                                    <p>Booking ID : <span>${bookingDetail.booking_number}</span> | <span>₹${bookingDetail.total_amount}</span></p>
                                </div>
                            </div>
                            <div class="earned-spent-miles hidden">
                                <p class="earned"><span>+ 510</span> <br> miles earned</p>
                            </div>
                        </div>
                    </div>`);
                }
            });
            $('.booking-count').text(totalBooking);
            $('.booking-amount').text(totalBookingCost);
        }

        function addPassenger() {
            var title = $('#passenger-title').val().trim();
            var name = $('#passenger-name').val().trim();
            var full_number = passengerMobile.getNumber(intlTelInputUtils.numberFormat.E164);
            var mobile_number = $('#passenger-mobile').val().trim().replaceAll(" ", "");
            var country_code = full_number.replace(mobile_number, "");
            var email_id = $('#passenger-email').val().trim();
            var date_of_birth = $('#passenger-dob').val().trim();

            var isEmail = String(email_id).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

            if (title != '' && name != '' && mobile_number != '' && email_id != '' && (date_of_birth != '' || passenger_type == 'greet') && isEmail) {
                var passengerData = {
                    'title': title,
                    'name': name,
                    'country_code': country_code,
                    'mobile_number': mobile_number,
                    'email_id': email_id,
                    'date_of_birth': date_of_birth
                };
                passengerData = JSON.stringify(passengerData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-passenger/create.php',
                    dataType: 'JSON',
                    data: passengerData,
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function() {
                                    location.reload();
                                });
                        } else {
                            swal("", response.message, "error");
                        }
                    }
                });
            } else if (!isEmail) {
                swal({
                    text: "Please check email address !",
                    icon: "warning",
                });
            } else {
                swal({
                    text: "Please fill all fields !",
                    icon: "warning",
                });
            }
        }

        function updatePassenger() {
            var token = $('#passenger-token-update').val().trim();
            var title = $('#passenger-title-update').val().trim();
            var name = $('#passenger-name-update').val().trim();
            var full_number = passengerMobileUpdate.getNumber(intlTelInputUtils.numberFormat.E164);
            var mobile_number = $('#passenger-mobile-update').val().trim().replaceAll(" ", "");
            var country_code = full_number.replace(mobile_number, "");
            var email_id = $('#passenger-email-update').val().trim();
            var date_of_birth = $('#passenger-dob-update').val().trim();

            var isEmail = String(email_id).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

            if (title != '' && name != '' && mobile_number != '' && email_id != '' && isEmail) { // && (date_of_birth != '' || passenger_type == 'greet')
                var passengerData = {
                    'token': token,
                    'title': title,
                    'name': name,
                    'country_code': country_code,
                    'mobile_number': mobile_number,
                    'email_id': email_id,
                    'date_of_birth': date_of_birth
                };
                passengerData = JSON.stringify(passengerData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-passenger/update.php',
                    dataType: 'JSON',
                    data: passengerData,
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function() {
                                    location.reload();
                                });
                        } else {
                            swal("", response.message, "error");
                        }
                    }
                });
            } else if (!isEmail) {
                swal({
                    text: "Please check email address !",
                    icon: "warning",
                });
            } else {
                swal({
                    text: "Please fill all fields !",
                    icon: "warning",
                });
            }
        }

        function addGst() {
            var name = $('#gst-name').val().trim();
            var gstin = $('#gst-number').val().trim();

            if (name != '' && gstin != '') {
                var gstData = {
                    'name': name,
                    'gstin': gstin
                };
                gstData = JSON.stringify(gstData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-gst/create.php',
                    dataType: 'JSON',
                    data: gstData,
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function() {
                                    location.reload();
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

        function updateGst() {
            var token = $('#gst-token-update').val().trim();
            var name = $('#gst-name-update').val().trim();
            var gstin = $('#gst-number-update').val().trim();

            if (name != '' && gstin != '') {
                var gstData = {
                    'token': token,
                    'name': name,
                    'gstin': gstin
                };
                gstData = JSON.stringify(gstData);
                $.ajax({
                    type: 'POST',
                    url: 'php/users-gst/update.php',
                    dataType: 'JSON',
                    data: gstData,
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            swal("", response.message, "success")
                                .then(function() {
                                    location.reload();
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
    </script>
    <script src="js/s3upload.js?v=<?php echo date('YmdHis'); ?>"></script>
    <script>
        function image_upload() {
            var fileUpload = document.getElementById('update-img');
            var file = fileUpload.files[0];
            s3_file_profile(file);
        }

        function s3_file_profile(file) {
            waitingDialog.show("Image is Uploading", {
                dialogSize: "sm",
                progressType: "warning"
            });
            let seconds = new Date().getTime();

            var extension = file.name.split('.').pop().toLowerCase();
            var filename = seconds + '.' + extension;
            var filePath = 'user/profile/' + filename;
            var params = {
                Key: filePath,
                ContentType: file.type,
                Body: file
            };
            bucket.putObject(params, function(err, data) {
                if (err) {
                    alert('ERROR: ' + err);
                } else {
                    var image_fileurl = aws_cloudfront_url + filePath;
                    $('.profile-img').attr('src', image_fileurl);

                    $('.profile-img').css('display', 'block');
                    $('.user-svg').css('display', 'none');
                }
                waitingDialog.hide();
            });
        }
    </script>
</body>

</html>