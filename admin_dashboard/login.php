<?php
    include '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <!-- Primary Meta Tags -->
    <title>Login | Airportzo</title>
    <!-- ===== css ===== -->
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/login.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/login-mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <title>Admin Login</title>
    <style>

    </style>
</head>

<body> 
    <div class="login-form" id="login_page">
        <form action="" class="form">
            <div class="login-logo">
                <img class="logo_big" src="assets_new/header/logo 2.png" alt="logo">
            </div>
            <h2 class="form__title">Admin Login</h2>
            <p class="sub__title">Please enter your credentials to login</p>
            <div class="form__detail">
                <label for="" class="login_icon"><img src="assets_new/main/Email.png" alt=""></label>
                <input type="text" id="user_email1" class="form__input" placeholder=" ">
                <label for="" class="form__label">Enter Email Address</label>
            </div>
            <div class="form__detail">
                <label for="" class="login_icon"><img src="assets_new/main/lock.png" alt=""></label>
                <input type="password" id="user_password1" class="form__input" placeholder=" " maxlength="20">
                <label for="" class="form__label">Enter Password</label>
                <a href="javascript:void(0)" class="forgot" onclick="got_to_forgotPage()">Forgot Password?</a>
                <div class="eye_icon">
                    <p><i class=" user_password1 fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="form-group forgot_button">
                <button type="button" class="form__button" id="login_button" onclick="login()">Login</button>
            </div>
        </form>
    </div>
    <!-- forgot page -->
    <div class="login-form" id="forgot_page" style="display: none;">
        <form action="" class="form">
            <div class="login-logo">
                <img class="logo_big" src="assets_new/header/logo 2.png" alt="logo">
            </div>
            <h2 class="form__title">Forgot Password</h2>
            <p class="sub__title">Please enter your registered email address. We will send a verification code to that
                email address.</p>
            <div class="form__detail">
                <input type="text" id="gotootpemail" class="form__input email-icon" placeholder=" ">
                <label for="gotootpemail" class="form__label">Enter Email Address</label>
            </div>

            <div class="form-group">
                <button type="button" class="form__button" id="gotootp-submitbtn">Sumbit</button>
            </div>
        </form>
    </div>
    <!-- otp page -->
    <div class="login-form" id="otp_page" style="display: none;">
        <form action="" class="form">
            <div class="login-logo">
                <img class="logo_big" src="assets_new/header/logo 2.png" alt="logo">
            </div>
            <h2 class="form__title">Enter Code</h2>
            <p class="sub__title otpemailcontent">Enter the verification code. We just sent on your register email address
                admin@mypeople.com.</p>
            <p class="sub__title">Change email address? <b><a href="#forgot_page" class="blue_color" onclick="got_to_forgotPage();">Change email</a></b>
            </p>

            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1,this)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2,this)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3,this)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(4,this)' maxlength=1>
            <div class="form-group forgot_button">
                <p>Didn't receive a code? <span id="countdowntimer">30 </span></p>
                <button type="button" class="form__button otp-btn" id="verifyOtp">verify</button>
            </div>
        </form>
    </div>
    <!-- new pass page -->
    <div class="login-form" id="new_pass_page" style="display: none;">
        <form action="" class="form">
            <div class="login-logo">
                <img class="logo_big" src="assets_new/header/logo 2.png" alt="logo">
            </div>
            <h2 class="form__title">New Password</h2>
            <p class="sub__title">Please enter new password</p>
            <div class="form__detail">
                <input type="text" id="new_password" class="form__input email-icon" placeholder=" ">
                <label for="new_password" class="form__label">Enter New Password</label>
            </div>
            <div class="form__detail">
                <input type="password" id="confirm_new_password" class="form__input pass-icon" placeholder=" " maxlength="20">
                <label for="confirm_new_password" class="form__label">Re-Enter New Password</label>

                <div class="eye_icon">
                    <p><i class="confirm_new_password fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="form-group forgot_button">
                <button type="button" class="form__button" id="savePasswordBtn" onclick="savepassword();">Save</button>
            </div>
        </form>
    </div>
    <!-- save password -->
    <div class="login-form" id="pass_changed" style="display: none;">
        <form action="" class="form">
            <div class="login-logo">
                <img class="logo_big" src="assets_new/header/logo 2.png" alt="logo">
            </div>
           <h2 class="form__title">New Password</h2>
            <p class="sub__title">Your password changed successfully!</p>
            
            <div class="form-group forgot_button">
                <button type="button" class="form__button" onclick="go_to_login()">Login</button>
            </div>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/function.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(".toggle-password").click(function () {
            var id = this.classList[0];
            if ($('#' + id).attr("type") == "password") {
                $('#' + id).attr("type", "text");
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                $('#' + id).attr("type", "password");
                this.classList.add('fa-eye-slash');
                this.classList.remove('fa-eye');
            }
        });


        function isEmail(email) {
                    let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return mailFormat.test(email);
	    }

        $('#user_password1').keypress(function(event) {
                    if (event.keyCode === 13) {
                        login();
                    }
        });
        /*=========== Login =============*/
        function login() {
            let email = $('#user_email1').val();
            let password = $('#user_password1').val();
            if(email == '' || !isEmail(email) ){
                swal("Enter Valid Email");

            }else if(password==''){
                swal("Enter Password")

            }else{
                
                    var datas = {
                                    "emailAddress": email,
                                    "password": password
                                };
                    var json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/login.php",
                        data: json1
                    }).done(function(data1) {
                        console.log(data1);
                        if(data1.status_code == 201){
                            let adminToken =  data1.userToken;
                            let adminName =  data1.adminName;
                            localStorage.setItem("adminToken",adminToken);
                            localStorage.setItem("adminName",adminName);

                            // document.getElementById("confirm_passwordErr").innerHTML = "";
                            window.location = 'home.php';
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }
                    });
            }

            
            
        }

        let downloadTimer;
        /*=========== Go to OTP =============*/
        $('body').on('click','#gotootp-submitbtn',function(){
            let otpEmail = $('#gotootpemail').val();
            
            let timerTime = 30;
            if(downloadTimer != "" || downloadTimer != undefined){
                clearInterval(downloadTimer); 
                document.getElementById("countdowntimer").textContent = timerTime + 's';
            }

            if(otpEmail == '' || !isEmail(otpEmail) ){
                swal("Enter Valid Email");

            }else{
            //    go_to_otp();

            //    $('.otpemailcontent').text(`Enter the verification code, We just sent on your register email address ${otpEmail}`)
                // Timer
                
                //   downloadTimer = setInterval(function () {
                //     timerTime --;
                //     document.getElementById("countdowntimer").textContent = timerTime + 's';
                //     if (timerTime <= 0) {
                //         clearInterval(downloadTimer);
                //         $('#countdowntimer').html(`<a href="#" onclick="">Resend</a>`);
                //     }
                //   }, 1000);
                sendotp(otpEmail,timerTime,"send");
            }

        });

        function sendotp(email,timerTime,otpType){
                    let datas = {
                                    "emailAddress": email
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/forgotPassword.php",
                        data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            if(otpType == 'send'){
                                go_to_otp();
                                $('.otpemailcontent').text(`Enter the verification code, We just sent on your register email address ${email}`);
                                downloadTimer = setInterval(function () {
                                    timerTime --;
                                    document.getElementById("countdowntimer").textContent = timerTime + 's';
                                    if (timerTime <= 0) {
                                        clearInterval(downloadTimer);
                                        $('#countdowntimer').html(`<a href="#" onclick="sendotp('${email}',0,'resend')">Resend</a>`);
                                    }
                                }, 1000);
                            }
                            
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }
                    })
        }

        $('body').on('click','#verifyOtp',function(){
            let emailAddress = $('#gotootpemail').val();
            let otp = '';
            $('.otp').each((index,item)=>{
                if(item.value == ''){
                    otp += '-';
                }else{
                    otp += item.value;
                }
            });
            if(otp.trim().includes('-')){
                swal('Please ensure that correct OTP is entered')
            }else{
                let datas = {
                                "emailAddress": emailAddress,
                                "otp":otp
                            };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/verifyOtp.php",
                        data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            go_to_newPass();
                            $('#new_password').val('');
                            $('#confirm_new_password').val('');
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }
                    })

            }
        })

        function savepassword(){
            let emailAddress = $('#gotootpemail').val();
            let newPassword = $('#new_password').val().trim();
            let confirmPassword = $('#confirm_new_password').val();
            if(newPassword == ''){
                swal("Password Field cannot be blank");
            }else if(newPassword != confirmPassword ){
                swal("Entered Password does not match with confirmed password");
            }else{
                let datas = {
                                "emailAddress": emailAddress,
                                "newPassword":newPassword
                            };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/admin/setnewPassword.php",
                        data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            $('#gotootpemail').val('');
                            $('.otp').val('');
                            go_to_save_pass();
                            $('#new_password').val('');
                            $('#confirm_new_password').val('');

                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                }).then(()=>{
                                    $('#new_password').val('');
                                $('#confirm_new_password').val('');

                                });
                        }
                    })
            }
        }
    </script>
</body>

</html>