<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airportzo | Contact Us</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/intlTelInput.css<?php echo $cache_str; ?>" />
    <link rel="stylesheet" href="css/fonts.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/contact-us.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>

    <style>
        .swal-text {
            text-align: center;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <div id="loading"></div>

    <!-- NAV MENU -->
    <nav></nav>

    <section class="contact-sec">
        <input type="hidden" id="gtag_id">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact_informations-box">
                        <div class="contact-us_header">
                            <img src="asset/contact-us/assist.svg" alt="assist illustration">
                            <div>
                                <h4>Get 24*7 assistance with AirportZo</h4>
                                <p>Need support or facing issues?</p>
                                <p>We are always happy to guide you</p>
                            </div>
                        </div>
                        <div class="contact__list-box contact-details" id="contact-details"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact__form-container">
                        <div class="page-header-set">
                            <h2>Get In Touch With Us</h2>
                        </div>
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <p>Full Name</p>
                                <input type="text" class="input-box" id="user-name" placeholder="Enter Full Name"
                                    onkeypress="return alpha(event)">
                                <p id="user-nameErr" style="color: red;">
                            </div>
                        </div>
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <p>Email Address</p>
                                <input type="text" class="input-box" id="user-email" placeholder="Enter Email Address">
                                <p id="user-emailErr" style="color: red;">
                            </div>
                        </div>
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <p>Subject</p>
                                <input type="text" class="input-box" id="passenger-subject" placeholder="Enter Subject" onkeypress="return alpha(event)">
                                <p id="passenger-subjectErr" style="color: red;">
                            </div>
                        </div>
                        <p>Message</p>
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <textarea class="input-box" id="user-message" cols="30" rows="7"
                                    placeholder="Your message...."></textarea>
                                <p id="user-messageErr" style="color: red;">
                            </div>
                        </div>
                        <button class="primary-butn" onclick="feedback_details()">Submit</button>
                    </div>
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
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
    <script>
        $(document).ready(function(){
            $('#contact-details').empty();
            $.ajax({
                async: false,
                url: 'php/contact-info/read.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status_code == 200) {
                        response.data.forEach(function(contactData) {
                            $('#contact-details').append(`
                            <p class="contact__list-head">Contact Us Via</p>
                            <ul class="contact__list">
                                <li>
                                    <img src="asset/contact-us/mail.svg" alt="mail icon">
                                    <div>
                                        <p class="contact_type-name">Mail Us</p>
                                        <p class="contact">${contactData.mail_us}</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="asset/contact-us/phone.svg" alt="call icon">
                                    <div>
                                        <p class="contact_type-name">Call Us</p>
                                        <p class="contact">${contactData.mobile_number}</p>
                                    </div>
                                </li>
                                <li>
                                    <img src="asset/contact-us/whatsapp.svg" alt="whatsapp icon">
                                    <div>
                                        <p class="contact_type-name">Whatsapp</p>
                                        <p class="contact">${contactData.whatsapp_number}</p>
                                    </div>
                                </li>
                            </ul>

                            <p class="contact__list-head">corporate office</p>
                            <ul class="contact__list location">
                                <li>
                                    <img src="asset/contact-us/pin.svg" alt="mail icon">
                                    <div>
                                        <p class="contact">${contactData.corporate_address}</p>
                                    </div>
                                </li>
                            </ul>`);
                        });
                    } else {
                        $('.contact-details').css("display", "none");
                    }
                }
            });
        });
        
        function feedback_details() {
            var pass = 0;
            if (document.getElementById("user-name").value == "") {
                document.getElementById("user-nameErr").innerHTML = "* Please Enter Your Name!";
            } else {
                document.getElementById("user-nameErr").innerHTML = "";
                pass++;
            }
            var checkemail = document.getElementById("user-email").value;
            mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (checkemail == "") {
                document.getElementById("user-emailErr").innerHTML = "* Please Enter Email Address!";
            } else if (checkemail.match(mailformat)) {
                document.getElementById("user-emailErr").innerHTML = "";
                pass++;
            } else {
                document.getElementById("user-emailErr").innerHTML = "* Please Enter Valid Email Address!";
            }
            if (document.getElementById("passenger-subject").value == "") {
                document.getElementById("passenger-subjectErr").innerHTML = "* Please Enter Subject!";
            } else {
                document.getElementById("passenger-subjectErr").innerHTML = "";
                pass++;
            } if (document.getElementById("user-message").value == "") {
                document.getElementById("user-messageErr").innerHTML = "* Please Enter Your Feedback!";
            } else {
                document.getElementById("user-messageErr").innerHTML = "";
                pass++;
            }
            if (pass == 4) {
                var user_name = $('#user-name').val().trim();
                var user_email = $("#user-email").val().trim();
                var user_subject = $("#passenger-subject").val().trim();
                var user_feedback = encodeURIComponent($("#user-message").val().trim());

                var inputData = {
                    'user_name': user_name,
                    'user_email': user_email,
                    'user_subject': user_subject,
                    'user_feedback': user_feedback
                }
                var inputJSONData = JSON.stringify(inputData);
                $.ajax({
                    async: false,
                    type: 'POST',
                    url: 'php/users/contact-info.php',
                    data: inputJSONData,
                    success: function (response) {
                        if (response.status_code == 200) {
                            swal("", response.message, "success")
                            .then(function(){
                                location.reload();
                            });
                        } else {
                            swal("", response.message, "error");
                        }
                    }
                });
            }
        }

        function alpha(e) {
            var k;
            document.all ? k = e.keyCode : k = e.which;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
        }
    </script>
</body>

</html>