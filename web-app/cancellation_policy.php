<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Cancellation Policy</title>
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
    <link rel="stylesheet" href="css/terms.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
    <div id="loading"></div>

    <!-- NAV MENU -->
    <nav></nav>
    <section class="terms-sec">
        <div class="container">
            <input type="hidden" id="gtag_id">
            <div class="heading-set">
                <h2>Cancellation Policy</h2>
            </div>
            <div class="terms__container">
                <div class="sub__terms-container">
                    <p>1.1. Once the Booking Process is completed, the ‘lead passenger’ will receive the booking
                        reference number. In case of any change of plans, the holder of the account from which the
                        booking was made can go to the Manage My Booking section of the Website and can cancel the
                        booking themselves.</p>
                    <p>1.2. Alternatively, Passenger(s) can also call on the (24x7) Passenger(s) service support numbers of
                        the AirportZo (provided on the booking confirmation email) and get their bookings
                        cancelled.</p>
                    <p>1.3. They can also write to us on our passenger support email address support@airportzo.com. Our
                        passenger support email will be operational between 0900 – 1800 Hrs. (Monday to Saturday). Any
                        email sent to our passenger support email address during non-operational hours will only be
                        actioned upon the next working day.</p>
                    <p>1.4. The turnaround time and the cancellation fees for all such requests received during
                        non-operational hours will be calculated from the start of operations the next working day only.</p>
                    <p>1.5. For all confirmed bookings, cancellation must be performed within the prescribed
                        deadline mentioned for respective Service Providers below, and is subject to payment of
                        surcharge, plus any applicable local fees and/ or taxes:</p>

                    <table>
                        <tbody>
                            <tr>
                              <td>From scheduled service time</td>
                              <td>Cancellation Charges</td>
                            </tr>
                            <tr>
                              <td>72 Hrs. or more in advance</td>
                              <td>3% of the Booking Amount</td>
                            </tr>
                            <tr>
                              <td>Between 72 to 48 Hrs.</td>
                              <td>10% of the Booking Amount</td>
                            </tr>
                            <tr>
                              <td>Between 48 to 24 Hrs.</td>
                              <td>50% of the Booking Amount</td>
                            </tr>
                            <tr>
                              <td>Less than 24 Hrs.</td>
                              <td>100% of the Booking Amount</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <p>1.6. In addition to the cancellation charges levied by the Service Providers as mentioned
                        above, AirportZo will charge a cancellation fee of Rs. 200/- per person for each confirmed
                        booking except when the cancellation charges are 100% of the booking amount.</p>
                    <p>1.7. For the purpose of calculating cancellation charges, Booking Amount shall mean the total
                        amount (Including taxes) paid at the time of booking the Service.</p>
                    <p>1.8. AirportZo shall endeavour to process refund (if applicable), within 15 days from the
                        date of cancellation of the Service and receipt of bank/credit card details.</p>
                    <p><span class="sub__head">1.9. No refund will be made in case of the following:</span></p>
                    <p>1.9.1 Service Provider is unable to contact the passenger due to wrong information provided at the
                        time of booking about travel details of the ‘lead passenger’ during the Booking Process.</p>
                    <p>1.9.2 No Shows. For the purpose of these Terms and Conditions a person will be considered to be a
                        ‘No Show’ if he/she fails to report on time at the meeting point or the time of Service as per the
                        Service confirmation voucher.</p>
                    <p>1.9.3 The Delayed/missed/cancelled flights.</p>
                    <p>1.9.4 Late arrival at the airport which results in denied check-in or boarding by the
                        airlines</p>
                    <p>1.9.5 In case of any misconduct or any unlawful or prohibited activity by any.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="footer"></footer>

    <!-- ================  MODALS ================ -->
    <!-- LOGIN MODAL -->
    <div id="login_modal" class="modal fade" role="dialog"></div>

    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
</body>

</html>