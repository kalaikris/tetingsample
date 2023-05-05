<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <!-- Primary Meta Tags -->
    <title>Login | mypeople</title>
    <!-- ===== css ===== -->
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" />
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/login-mediaquery.css">
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
                <input type="text" id="user_email" class="form__input email-icon" placeholder=" ">
                <label for="" class="form__label">Enter Email Address</label>
            </div>
            <div class="form__detail">
                <input type="password" id="user_password" class="form__input pass-icon" placeholder=" " maxlength="20">
                <label for="" class="form__label">Enter Password</label>
                <a href="javascript:void(0)" class="forgot" onclick="got_to_forgotPage()">Forgot Password?</a>
                <div class="eye_icon">
                    <p><i class=" user_password fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="form-group forgot_button">
                <button type="button" class="form__button" id="login_button" onclick="get_login()">Login</button>
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
            <p class="sub__title">Please enter register mobile number. We will send a verification code to your register
                email address.</p>
            <div class="form__detail">
                <input type="text" id="user_email" class="form__input email-icon" placeholder=" ">
                <label for="" class="form__label">Enter Email Address</label>
            </div>

            <div class="form-group">
                <button type="button" class="form__button" id="login_button" onclick="go_to_otp()">Sumbit</button>
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
            <p class="sub__title">Enter the verification code. We just sent on your register email address
                admin@mypeople.com.</p>
            <p class="sub__title">Change email address? <a href="javascript:void(0)" class="blue_color">Change email</a>
            </p>

            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1>
            <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(4)' maxlength=1>
            <div class="form-group forgot_button">
                <p>Didn't receive a code? <span id="countdowntimer">30 </span></p>
                <button type="button" class="form__button otp-btn" id="login_button" onclick="go_to_newPass()">verify</button>
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
                <input type="text" id="user_email" class="form__input email-icon" placeholder=" ">
                <label for="" class="form__label">Enter New Password</label>
            </div>
            <div class="form__detail">
                <input type="password" id="user_password" class="form__input pass-icon" placeholder=" " maxlength="20">
                <label for="" class="form__label">Re-Enter New Password</label>

                <div class="eye_icon">
                    <p><i class=" user_password fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="form-group forgot_button">
                <button type="button" class="form__button" id="login_button" onclick="go_to_save_pass()">Save</button>
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
                <button type="button" class="form__button" id="login_button" onclick="login()">Login</button>
            </div>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/function.js"></script>
    <script>
        $(".toggle-password").click(function () {
            var id = this.classList[0];
            $(this).toggleClass("fa-eye-slash fa-eye");
            if ($('#' + id).attr("type") == "password") {
                $('#' + id).attr("type", "text");
            } else {
                $('#' + id).attr("type", "password");
            }
        });
        /*=========== Go to OTP =============*/
        function login() {
            window.open("home.html", "_self");
        }

        function get_login(){
        var email = $("#email").val();
        var password = $("#password").val();
        if(email=='' && password==''){
            swal("","Please Enter The Valid Email ID and Password !");
        }
        else if(email == ''){
            document.getElementById("emailErr").innerHTML = "* Please Enter Valid Email ID!";   
        }else if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)==0){
            document.getElementById("emailErr").innerHTML = "* Please Enter Valid Email ID!";
        }else if(password == ''){
            document.getElementById("emailErr").innerHTML = "";
            document.getElementById("passwordErr").innerHTML = "* Please enter the Password!";
        } else {
            $('.email').css('border', 'solid 1px #D0D1D5');
            $('.password').css('border', 'solid 1px #D0D1D5');
            var datas = {'email':email,'password':password};
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: "php/check_login.php",
                data: datas
            }).done(function(data) {
                if(data.success_code == 200){
                    document.getElementById("emailErr").innerHTML = "";
                    document.getElementById("passwordErr").innerHTML = "";
                    window.location = data.relocator;
                } else {
                    swal(data.success_msg);
                }
            });
        }
    }
    </script>
</body>

</html>