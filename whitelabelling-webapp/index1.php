<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Home</title>
    <link rel="shortcut icon" href="asset/fav-icon.png">
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
    <link rel="stylesheet" href="css/my-cart.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">

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
            padding: 0px 0 70px;
        }
        .cart-header {
            text-align: center;
            margin-bottom: 24px;
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
        .cart-lists {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 270px));
            gap:16px;
            justify-content: center;
            clear: right;
        }
        .cart-list {
            width: 100%;
            margin-bottom: 0;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <div id="loading"></div>

    <!-- NAV MENU -->
    <nav></nav>

    <!-- ========== BANNER SECTION ========== -->
    <section class="banner" id="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="banner_description" id="banner_description">
                        <h3>Get all the airport services you need from</h3>
                        <h1>Meet & greet to Visa assistance</h1>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner_form">
                        <h4>What's your travel plan?</h4>
                        <form action="">
                            <div class="travel_types">
                                <div>
                                    <input class="form_input-radio direct__flight-radio" type="radio" name="travel-type" value="has_no_transit" id="travel-1" checked="checked">
                                    <label class="form_radio-label" for="travel-1">Direct Flight</label>
                                </div>
                                <div>
                                    <input class="form_input-radio" type="radio" name="travel-type" value="has_transit" id="travel-2" data-toggle="modal" data-target="#add_airport_modal">
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
                                        <input type="text" id="depart-flight-number" placeholder="Enter flight number">
                                    </div>
                                </div>
                            </div>
                            <div class="btn_container">
                                <button type="button" class="cust-btn primary-butn" onclick="searchServices()">Search service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 2 ========== -->
    <section class="sec__2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="user_experience-desc">
                        <svg width="100px" height="100px" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>Elevate Your Experience</title>
                            <g id="Elevate-Your-Experience" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M84.5140166,25.301703 C87.4342855,25.2736625 89.9377601,25.6313755 91.9160258,26.4783635 C93.5245996,27.1670903 94.8072004,27.9944969 95.575171,28.8585188 C95.6889804,28.9865624 95.7778598,29.1347463 95.8372329,29.2954404 C97.3971616,33.5174074 95.8455453,39.0040637 91.0893185,40.2959004 L91.0893185,40.2959004 L67.894,46.398 L51.3125838,70.1021263 L51.2391203,70.1978961 C47.0852796,75.1470509 43.6701977,77.3841182 40.808381,77.3750833 C38.6716377,77.3681441 37.2842594,76.2164537 36.5155256,74.7552089 L36.5155256,74.7552089 L36.4327068,74.5842701 L36.3781979,74.4398265 C36.2856329,74.1474859 36.291749,73.8368334 36.3959239,73.5512163 L36.3959239,73.5512163 L44.164,52.252 L40.4476692,53.1560684 L39.3694799,53.3733472 L38.2724745,53.5774146 C37.1125555,53.7859807 35.8416324,53.9926677 34.4811026,54.1873616 C29.2045174,54.9424489 23.8783782,55.342522 18.8902331,55.1980008 C14.4208678,55.06851 10.4582218,54.5018267 7.12978195,53.4197346 C6.69675697,53.2789561 6.36150723,52.9329377 6.23448503,52.4956797 L6.23448503,52.4956797 L5.55155778,50.1447882 C5.33632382,49.4038723 5.77271986,48.6309233 6.5183066,48.4324732 L6.5183066,48.4324732 L13.14,46.669 L3.9499194,35.7979375 C3.49107504,35.2551409 3.52528604,34.4601757 4.00747604,33.9585277 L4.00747604,33.9585277 L4.10987374,33.8622706 L5.15857594,32.9715464 C5.54529998,32.643079 6.08148747,32.5542813 6.5534552,32.7405413 L6.5534552,32.7405413 L23.498,39.428 L73.6191693,26.7736984 L74.3989359,26.5861663 L75.0671015,26.4382254 C75.7082554,26.3008118 76.4009851,26.1650329 77.1343461,26.0366357 C79.6458912,25.596913 82.1546847,25.3243574 84.5140166,25.301703 Z M84.9900022,28.0506697 L84.540421,28.0515762 C82.3492665,28.0726158 79.9835206,28.3296307 77.6086037,28.7454324 C76.736553,28.8981115 75.9255713,29.0616266 75.1979426,29.2248321 C74.9506825,29.280292 74.7448996,29.3284039 74.5847139,29.3670808 L74.5847139,29.3670808 L23.7424759,42.2026454 C23.463275,42.2731368 23.1689888,42.2541918 22.901131,42.1484829 L22.901131,42.1484829 L7.922,36.237 L16.6420833,46.5525638 C17.2651313,47.2896075 16.95117,48.407078 16.0693951,48.7299749 L16.0693951,48.7299749 L15.9456683,48.7689709 L8.584,50.727 L8.668,51.015 L9.02066789,51.1178855 C11.6828088,51.8591709 14.7949312,52.2849111 18.2700396,52.4249475 L18.2700396,52.4249475 L18.9698753,52.4491542 C23.7812491,52.5885539 28.9581352,52.199692 34.0915419,51.4650937 C35.1970753,51.3068902 36.2413287,51.1406658 37.2116863,50.9722458 L37.2116863,50.9722458 L38.339838,50.7694606 C38.5175066,50.736389 38.6869284,50.7042851 38.8478275,50.673277 L38.8478275,50.673277 L39.8581568,50.4702697 L46.0116342,48.972545 C47.0790328,48.7125925 48.005189,49.7475596 47.6287488,50.7796487 L47.6287488,50.7796487 L39.205,73.873 L39.28417,73.9666383 C39.6020918,74.3211262 40.0456698,74.5733802 40.6357344,74.6179513 L40.6357344,74.6179513 L40.8171692,74.6250158 C42.6807517,74.6309422 45.4516131,72.8158748 49.1327091,68.4299787 L49.098,68.47 L65.9302008,44.4097229 C66.0901767,44.1810469 66.3152588,44.0073896 66.5745908,43.9102633 L66.5745908,43.9102633 L66.706968,43.8681774 L90.3789993,37.6392431 C92.9107238,36.9515787 94.0321596,34.0222214 93.5596516,31.366343 L85.2072847,33.4908717 C84.4713421,33.6781257 83.7229435,33.2333257 83.5356895,32.4973831 C83.3594505,31.8047313 83.7430932,31.1010457 84.4023976,30.864541 L84.5291781,30.825788 L91.1409715,29.1425382 L91.1004788,29.1237888 L90.8336408,29.0063949 C89.4482146,28.4132292 87.6110177,28.1042234 85.4306246,28.0566956 L85.4306246,28.0566956 L84.9900022,28.0506697 Z M55.5910654,25.7602363 C56.3125381,25.997202 56.7053085,26.7741697 56.4683429,27.4956424 C56.2313772,28.217115 55.4544094,28.6098855 54.7329367,28.3729198 C47.9399898,26.1417951 41.1730483,24.9651052 35.2989354,25.4795998 L34.958,25.512 L41.7362015,29.4385277 C42.352261,29.7953392 42.5877916,30.557016 42.3012225,31.1922903 L42.2369055,31.3175023 C41.8800939,31.9335618 41.1184172,32.1690924 40.4831429,31.8825233 L40.3579308,31.8182063 L30.2908317,25.9875079 C29.2213216,25.3680652 29.4484996,23.7619112 30.6478498,23.4633811 C37.9448223,21.6470926 46.7502945,22.8565094 55.5910654,25.7602363 Z" id="flight" fill="#892680" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <p class="title">Elevate Your Experience</p>
                        <p>Elevate your <span id="desc-distributor"></span> experience with our Meet & Assist, Lounge service and much more</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="user_experience-desc">
                        <svg width="100px" height="100px" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Effortless-Booking" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M59.1242476,22 C59.699865,22 60.2689414,22.2237049 60.6993463,22.6514914 L60.6993463,22.6514914 L65.8877528,27.8398744 L73.3184509,23.9126112 C73.6468145,23.7386185 74.003959,23.6548927 74.3571788,23.6548927 C74.9341045,23.6548927 75.5031809,23.8785976 75.9309693,24.3063841 C76.6217102,24.9971219 76.7813133,26.0567766 76.324744,26.9188906 L76.324744,26.9188906 L72.3961548,34.3495552 L77.3490814,39.3024594 C78.0515963,40.0049712 78.2020418,41.0881737 77.7193081,41.9568289 C77.3203005,42.6724228 76.5706896,43.0989011 75.7765991,43.0989011 C75.6078386,43.0989011 75.4377698,43.0792779 75.267701,43.0400314 L75.267701,43.0400314 L68.94245,41.5552067 L65.2676558,49.433281 C64.8987373,50.2260597 64.1059551,50.7179487 63.2529946,50.7179487 C63.1378712,50.7179487 63.0227477,50.7087912 62.9063159,50.6904762 C61.926458,50.5361068 61.1676896,49.7524856 61.0447167,48.7687075 L61.0447167,48.7687075 L60.16,41.69 L25.2334612,76.6166928 C24.978358,76.8717949 24.6434533,77 24.3085486,77 C23.9736439,77 23.6387392,76.8717949 23.383636,76.6166928 C22.8721213,76.1051805 22.8721213,75.2783883 23.383636,74.766876 L58.129,40.021 L51.4646106,39.1886447 C50.5399289,39.0729061 49.7913908,38.3939739 49.5778277,37.4986804 L49.5441415,37.3283621 C49.3897713,36.3498168 49.9025942,35.385662 50.8000341,34.967033 L50.8000341,34.967033 L58.6441303,31.3053375 L56.970915,24.7760335 C56.7223529,23.8053375 57.154066,22.7875458 58.0240333,22.2917321 C58.3680955,22.0954997 58.7474798,22 59.1242476,22 Z M59.1242476,24.2239665 L61.252724,32.5416013 L51.7380289,36.9843014 L61.9709376,38.2637363 L63.24907,48.4952904 L67.6878656,38.978022 L75.7726745,40.8749346 L69.6580472,34.7603349 L74.3545624,25.8788592 L65.4730465,30.5727368 L59.1242476,24.2239665 Z" id="flying-star" stroke="#892680" stroke-width="0.4" fill="#892680" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <p class="title">Effortless Booking</p>
                        <p>Keep it simple with easy online bookings, 24/7 service, and all-inclusive prices confirmed in advance</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="user_experience-desc">
                        <svg width="100px" height="100px" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Gate-to-Gate-Service" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M55.0443096,55.5457639 C57.1367418,55.5457639 58.792261,56.1297543 60.0111069,57.287658 C61.2352314,58.4506002 61.8446544,59.8880227 61.8446544,61.6044841 C61.8446544,62.4780704 61.666866,63.3363011 61.3062507,64.1791763 C60.950674,65.0222914 60.3566066,65.9109932 59.528847,66.8404833 C58.7008475,67.7747719 57.3246073,69.0545602 55.3998863,70.6798481 C53.7949925,72.0306557 52.7642519,72.9447902 52.3071846,73.42729 C51.8501174,73.9047514 51.4741466,74.3870113 51.1744736,74.8745497 L61.8751255,74.8745497 L61.8751255,77.4494818 L47.4569934,77.4494818 C47.4368393,76.8045491 47.5383298,76.1848091 47.7669834,75.5907416 C48.1326372,74.6055878 48.7216661,73.6405881 49.5290316,72.6859054 C50.3416755,71.7360213 51.5096563,70.6340214 53.0332137,69.3847043 C55.4049248,67.4395892 57.0098187,65.9009162 57.8426168,64.7634066 C58.6756548,63.6306956 59.0919339,62.5541283 59.0919339,61.5435418 C59.0919339,60.4820901 58.7111645,59.5883497 57.9544243,58.8570421 C57.1926456,58.1307731 56.2022133,57.7651193 54.9833673,57.7651193 C53.6935019,57.7651193 52.6625214,58.1511672 51.8906656,58.9280615 C51.1135313,59.6999173 50.7226849,60.771686 50.7123679,62.1376093 L47.9598873,61.8583304 C48.1477528,59.8016478 48.8586663,58.2373021 50.0878293,57.1607349 C51.3167523,56.0841676 52.9722714,55.5457639 55.0443096,55.5457639 Z M74.4851428,55.6371774 L74.4851428,69.7707521 L77.4307672,69.7707521 L77.4307672,72.2288381 L74.4851428,72.2288381 L74.4851428,77.4494818 L71.8036816,77.4494818 L71.8036816,72.2288381 L62.3425097,72.2288381 L62.3425097,69.7707521 L72.2962586,55.6371774 L74.4851428,55.6371774 Z M48.9932672,20.0502783 C64.9651357,20.0502783 77.9173016,33.0024442 77.9173016,48.9743127 C77.9173016,49.8027398 77.2457287,50.4743127 76.4173016,50.4743127 C75.5888744,50.4743127 74.9173016,49.8027398 74.9173016,48.9743127 C74.9173016,34.6592984 63.3082815,23.0502783 48.9932672,23.0502783 C34.6782529,23.0502783 23.0692328,34.6592984 23.0692328,48.9743127 C23.0692328,60.284677 30.4078582,70.2928738 41.1949754,73.6954759 C41.9850302,73.9446844 42.4234727,74.7871739 42.1742641,75.5772287 C41.9250555,76.3672835 41.0825661,76.805726 40.2925113,76.5565174 C28.2569297,72.7601097 20.0692328,61.5939746 20.0692328,48.9743127 C20.0692328,33.0024442 33.0213986,20.0502783 48.9932672,20.0502783 Z M71.8036816,59.938648 L64.9781442,69.7707521 L71.8036816,69.7707521 L71.8036816,59.938648 Z M67.0715361,35.8508446 C67.4002407,36.3021535 67.3006696,36.9348497 66.8493607,37.2635542 L51.9128476,48.1367539 C51.9959568,48.4140708 52.040622,48.7079672 52.040622,49.0122217 C52.040622,49.8529375 51.6992012,50.6151961 51.1478414,51.1665559 C50.5964815,51.7179158 49.8342229,52.0593366 48.9935071,52.0593366 C48.1523115,52.0593366 47.3902928,51.7179158 46.8389329,51.1665559 C46.2875731,50.6151961 45.9461523,49.8534173 45.9461523,49.0122217 C45.9461523,48.8633035 45.9568524,48.7168668 45.9775233,48.573641 L35.3462711,43.1476051 C34.8467362,42.8935189 34.647834,42.2824164 34.9019202,41.7828815 C35.1560064,41.2833466 35.7671089,41.0844444 36.2666438,41.3385306 L46.9232328,46.7772783 L46.9810855,46.7242574 C47.5178457,46.2517552 48.2224111,45.9648668 48.9935071,45.9648668 C49.6349849,45.9648668 50.2302797,46.163412 50.7212975,46.5021954 L65.6588265,35.6286691 C66.1101354,35.2999646 66.7428316,35.3995356 67.0715361,35.8508446 Z M25.8173189,48.009193 C26.4798682,48.009193 27.0169705,48.5462953 27.0169705,49.2088446 C27.0169705,49.8713938 26.4798682,50.4084961 25.8173189,50.4084961 C25.1547697,50.4084961 24.6176674,49.8713938 24.6176674,49.2088446 C24.6176674,48.5462953 25.1547697,48.009193 25.8173189,48.009193 Z M49.1771738,24.6248653 C49.839723,24.6248653 50.3768253,25.1619676 50.3768253,25.8245168 C50.3768253,26.4870661 49.839723,27.0241684 49.1771738,27.0241684 C48.5146245,27.0241684 47.9775222,26.4870661 47.9775222,25.8245168 C47.9775222,25.1619676 48.5146245,24.6248653 49.1771738,24.6248653 Z" id="Clock" fill="#892680" fill-rule="nonzero"></path></g></svg>
                        <p class="title">Gate-to-Gate Service</p>
                        <p>Enjoy hassle free travel, from airport gate to boarding gate and arrival gate to airport exit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 3 ========== -->
    <section class="booking-sec">
        <div class="container">
            <div class="tab-box">
                <ul class="nav nav-tabs ser-ab-review-tab">
                    <li class="">
                        <a data-toggle="tab" href="#myself">Website Services</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#others" class="">Agent Services</a>
                    </li>
                </ul>
            </div>
            <div class="cart-header">
                <h2>Upcoming Services</h2>
            </div>
            <a href="my-booking.php" class="link view-all">View all</a>
            <div class="tab-content">
                <div id="myself" class="tab-pane fade">
                    <div class="cart-lists"></div>
                </div>
                <div id="others" class="tab-pane fade">
                    <div class="cart-lists"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 4 ========== -->
    <section class="service-sec">
        <div class="container-fluid">
            <div class="heading-set">
                <h2>Services we offer</h2>
                <p>Have The Smoothest Experience Every Time You Travel</p>
            </div>
            <div class="service-gallery">
                <div class="gallaery-lists" id="gallery-list"></div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 5 ========== -->
    <section class="happy-cust-sec">
        <div class="container-fluid">
            <div class="heading-set">
                <h2>Serving 25,000+ happy customers</h2>
                <p>We serve a wide range of people to make their day better and memorable</p>
            </div>
            <div class="service-ach-lists" id="avail-service"></div>
        </div>
    </section>

    <!-- ========== SECTION 6 ========== -->
    <section class="sec__5">
        <div class="container">
            <div class="heading-set">
                <h2>Our partners</h2>
                <p>We have partnered with 250+ vendors across the globe to serve you better</p>
            </div>
            <div class="partner-set">
                <div class="owl-carousel owl-theme partner-owl" id="our_partners"></div>
            </div>
        </div>
    </section>

    <!-- ========== SECTION 7 ========== -->
    <section class="sec__6">
        <div class="container">
            <div class="heading-set">
                <h2>How it Works?</h2>
                <p>Book your airport services as easy with <span id="menu-distributor"></span>!</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <ul class="how_it_works-list">
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/booking-confirmation.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Booking Confirmation</p>
                                <p class="how_it_works_desc">Once booking is confirmed, you will receive a confirmation on your registered email and mobile.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/stay-informed.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Stay Updated</p>
                                <p class="how_it_works_desc">Our service partner's staff will contact you at least 6-12 hours prior to your flight & will provide you with all necessary details.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/pick-up-point.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Pick Up / Drop Off Point</p>
                                <p class="how_it_works_desc">Our service partner's staff will meet you at the designated spot in the respective airport.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/airport-assistance.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Airport Assistance</p>
                                <p class="how_it_works_desc">Our service partner's staff will assist you with further formalities at the airport and guide you along the process.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/service-completion.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Service Completion</p>
                                <p class="how_it_works_desc">Once the service is delivered, our service partner's staff will initiate a closure and wish you have a wonderful journey.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon_outer">
                                <img src="asset/home/feedback.svg" alt="">
                            </div>
                            <div class="how_it_works_desc-box">
                                <p class="title">Feedback</p>
                                <p class="how_it_works_desc">Once the service is delivered, you will receive an SMS & Emailer to rate & review the service.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img class="partner_poster-img" id="poster-img" src="asset/home/partner-poster.png" alt="partner poster image">
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer"></footer>

    <!-- ================  MODALS ================ -->
    <!-- LOGIN MODAL -->
    <div id="login_modal" class="modal fade" role="dialog"></div>

    <!-- TRANSIT MODAL -->
    <div id="add_airport_modal" class="modal fade" role="dialog">
        <div class="modal-dialog float-right top-edge custom-dialog">
            <div class="custom-content">
                <img class="login-close" src="asset/choose-service/close.svg" alt="close icon" data-dismiss="modal">
                <div class="cust-modal-body">
                    <div class="filter-multiple-airport">
                        <div class="mult-air-header">
                            <img src="" class="side-bar-logo" id="header-logo1" alt="logo">
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
                                                    <input class="transit_airport_input" type="text" id="depart-flight-number-1" placeholder="Enter flight number">
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
                                                    <input class="transit_airport_input" type="text" id="depart-flight-number-2" placeholder="Enter flight number">
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

    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
        var isAgent = false;

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
                                            <input class="transit_airport_input" type="text" id="depart-flight-number-${journeyListItemLength+1}" placeholder="Enter flight number">
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


            var userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                $('.booking-sec').css("display", "none");
            } else {
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'php/users/read-detail.php',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status_code == 200) {
                            var responseData = response.data;
                            isAgent = (responseData.is_agent && responseData.is_approved == "Approved")? true: false;

                            //$('.tab-box').remove();
                            if ( isAgent ) {
                                $('a[href="#myself"]').text("Website Booking");
                                $('a[href="#others"]').text("Agent Booking");
                                $('#others').addClass("in active");
                                $('a[href="#others"]').parent().addClass("active");
                            } else {
                                $('a[href="#myself"]').text("For Myself");
                                $('a[href="#others"]').text("For Others");
                                $('#myself').addClass("in active");
                                $('a[href="#myself"]').parent().addClass("active");
                            }
                        } else {
                            $('.booking-sec').css("display", "none");
                        }
                    }
                });
            }

            $.ajax({
                async: false,
                type: 'GET',
                url: 'php/users-booking/read-all-history.php',
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
                                    status = `<span class="widget upcoming" style="visibility: hidden">
                                        <img src="asset/mybooking/upcoming.svg" class="coint-icon" alt="icon">
                                        <span>Upcoming</span>
                                    </span>`;
                                    break;

                                case 'Ongoing':
                                    status = `<span class="widget completed" style="visibility: hidden">
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
                            if (isAgent) {
                                if (orderData.is_agent) {
                                    $('#others>.cart-lists').append(bookingCard);
                                } else {
                                    $('#myself>.cart-lists').append(bookingCard);
                                }
                            } else {
                                if (orderData.for_others) {
                                    $('#others>.cart-lists').append(bookingCard);
                                } else {
                                    $('#myself>.cart-lists').append(bookingCard);
                                }
                            }
                        });

                        if (isAgent) {
                            if ($('#myself>.cart-lists').html() == '') {
                                $('.tab-box').remove();
                            }
                        } else {
                            if ($('#others>.cart-lists').html() == '') {
                                $('.tab-box').remove();
                            }
                        }
                        
                        if ($('#myself>.cart-lists').html() == '') {
                            $('#myself>.cart-lists').html(`<h4>No bookings found</h4>`);
                        }
                        if ($('#others>.cart-lists').html() == '') {
                            $('#others>.cart-lists').html(`<h4>No bookings found</h4>`);
                        }

                        $('.cart-list').on('click', function(){
                            window.location.href = 'my-booking.php';
                        });
                    } else {
                        $('.cart-lists').append(`<h2>${response.message}</h2>`);
                    }

                }
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
                        $('.sec__5').css("display", "none");
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
                        $('.happy-cust-sec').css("display", "none");
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
                        commonTerminals.forEach(function(terminal) {
                            $('.data-terminal-list').append(`<option value="${terminal.terminal_string}">`);
                        });
                    }
                }
            });

            $('#gallery-list').empty();
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

        function searchServices1() {
            var travelType = $('input[name="travel-type"]:checked').val();
            var hasDataError = false;
            var hasFlightNumberError = false;
            var sameFlightError = false;
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
                alert('Please select valid airport stations');
            } else if (hasFlightNumberError) {
                alert('Please check flight number');
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
        });
    </script>
</body>
</html>