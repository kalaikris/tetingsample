<?php
include 'php/site-config.php';
$distributor_name = get_service_distributor();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Home</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/my-cart.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="getDistributorDetail('<?php echo $distributor_name; ?>');" data-distributor="<?php echo $distributor_name; ?>">
    <div id="loading"></div>

    <!-- NAV MENU -->
    <nav></nav>

    <!-- ========== SECTION 2 ========== -->
    <section class="cart-sec">
        <div class="container">
            <div class="cart-header">
                <h2>3 service in cart</h2>
            </div>
            <div class="cart-lists">
                <div class="cart-list">
                    <div class="location-time">
                        <div class="cart-title-set">
                            <h2>MAA - DXB - FRA</h2>
                            <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                        </div>
                        <p>25 Jul, 2022 (6:30 PM) to 05 Aug, 2022 (11:00 AM)</p>
                    </div>
                    <div class="cart-division"></div>
                    <div class="cart-desc">
                        <div class="cart-type">
                            <p>Passengers</p>
                            <h4>2 Adults, 2 Children</h4>
                        </div>
                        <div class="service-type">
                            <p>Total services</p>
                            <h4>4 services</h4>
                        </div>
                    </div>
                    <div class="ponit-amt-set">
                        <span class="coin-set">
                            <img src="asset/choose-service/flight-coin.png" class="coint-icon" alt="icon"> 
                            <p>You will earn <span>65 coins</span></p>
                        </span>
                        <span class="price-set">
                            <p>₹ 5,520</p>
                        </span>
                    </div>
                </div>
                <div class="cart-list">
                    <div class="location-time">                            
                        <div class="cart-title-set">
                            <h2>MAA - DXB - FRA</h2>
                            <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                        </div>
                        <p>25 Jul, 2022 (6:30 PM) to 05 Aug, 2022 (11:00 AM)</p>
                    </div>
                    <div class="cart-division"></div>
                    <div class="cart-desc">
                        <div class="cart-type">
                            <p>Passengers</p>
                            <h4>2 Adults, 2 Children</h4>
                        </div>
                        <div class="service-type">
                            <p>Total services</p>
                            <h4>4 services</h4>
                        </div>
                    </div>
                    <div class="ponit-amt-set">
                        <span class="coin-set">
                            <img src="asset/choose-service/flight-coin.png" class="coint-icon" alt="icon"> 
                            <p>You will earn <span>65 coins</span></p>
                        </span>
                        <span class="price-set">
                            <p>₹ 5,520</p>
                        </span>
                    </div>
                </div>
                <div class="cart-list">
                    <div class="location-time">                            
                        <div class="cart-title-set">
                            <h2>MAA - DXB - FRA</h2>
                            <img src="asset/choose-service/more.svg" class="more-icon" alt="icon">
                        </div>
                        <p>25 Jul, 2022 (6:30 PM) to 05 Aug, 2022 (11:00 AM)</p>
                    </div>
                    <div class="cart-division"></div>
                    <div class="cart-desc">
                        <div class="cart-type">
                            <p>Passengers</p>
                            <h4>2 Adults, 2 Children</h4>
                        </div>
                        <div class="service-type">
                            <p>Total services</p>
                            <h4>4 services</h4>
                        </div>
                    </div>
                    <div class="ponit-amt-set">
                        <span class="coin-set">
                            <img src="asset/choose-service/flight-coin.png" class="coint-icon" alt="icon"> 
                            <p>You will earn <span>65 coins</span></p>
                        </span>
                        <span class="price-set">
                            <p>₹ 5,520</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- LOGIN MODAL -->
    <div id="login_modal" class="modal fade" role="dialog"></div>

    <!-- ========== FOOTER ========== -->
    <!-- <footer class="footer"></footer> -->

    <script src='js/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src="js/main.js"></script>
    <script>
        $( document ).ready(function() {
            if ($('body').attr('data-usr-token') == 0) {
                window.location.href = "index.php";
            }
            // setTimeout(function(){$('#loading').fadeOut();},500);
        });        
    </script>
</body>

</html>