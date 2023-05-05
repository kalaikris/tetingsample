<?php
    include '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="asset/images/fav-icon.png">
    <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/onbord-css/common.css">
    <link rel="stylesheet" href="css/onbord-css/login.css">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link href="css/sweet_alert.min.css" rel="stylesheet">
</head>
<body id="page">
    <div id="loading"></div>

    <div class="mani">
        <div class="side_menu" id="before_login"></div>
        <div class="mani_menu">
            <div class="login-header-set">
                <img src="asset/images/color-logo.png" alt="logo" class="logo-image">
                <h2>Make Your Journey As Enjoyable As The Destination</h2>
            </div>
            <div class="underline-div"></div>
            <section class="login-sec" id="login_page">
                <div class="login-sub-header">
                    <h2>Login</h2>
                    <p>Kindly use your Business ID and password to login</p>
                </div>
                <div class="">
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="business_id">Business ID</label>
                                <input type="text" class="input-box" id="business_id" placeholder="Enter Business ID">
                            </div>
                        </div>
                        <div>
                            <p id="business_idErr" class="error text-danger"></p>
                        </div>
                    </div>
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="password">Password</label>
                                <input type="password" class="input-box" id="password" placeholder="Enter Password">
                            </div>
                            <div class="possword-group">
                                <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#password" data-toggle="false">
                            </div>
                        </div>
                        <p id="passwordErr" class="error text-danger"></p>
                    </div>

                    <!-- <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="input-box password-input" id="confirm_password" placeholder="Enter Confirm Password">
                            </div>
                            <div class="possword-group">
                                <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon password-input" data-value="#confirm_password" data-toggle="false">
                            </div>
                        </div>
                        <p id="confirm_passwordErr" class="error text-danger"></p>
                    </div> -->
                    <div class="forgot-form-group-item">
                        <a class="forgot-password" href="javascript:void(0)" onclick="got_to_forgotPage()">Forgot Password?</a>
                    </div>
                </div>
                <div class="form_btn">
                    <button class="submit_btn" onclick="logindetails()">Login</button>
                </div>
            </section>
            <section class="forgot-sec" id="forgot_page" style="display:none;">
                <div class="login-sub-header">
                    <h2>Forgot Password</h2>
                    <p>Please enter your registered email address. We will send a verification code to that email address.</p>
                </div>
                <div class="input-form-group">
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="gotootpemail">Business Id</label>
                                <input type="text" class="input-box" id="gotootpemail" placeholder="Enter your Business Id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form_btn">
                    <button class="submit_btn" id="gotootp-submitbtn" onclick="">Send OTP</button>
                </div>
            </section>
            <section class="otp-sec" id="otp_page" style="display:none;">
                <div class="login-sub-header">
                    <h2>Enter Code</h2>
                    <p class="otpemailcontent">Enter the verification code, We just sent on your registered email address deepan@macappstudio.com</p>
                    <p class="sub__title">Not your Business ID? <a href="#forgot_page" class="blue_color" onclick="got_to_forgotPage();">Change Business Id</a>
                    </p>
                </div>
                <div class="input-otp-group">
                    <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1,this)' maxlength=1>
                    <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2,this)' maxlength=1>
                    <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3,this)' maxlength=1>
                    <input class="otp" type="text" oninput='digitValidate(this)' onkeyup='tabChange(4,this)' maxlength=1>
                </div>
                <div class="mb-2 mt-2">
                    <p>Didn't receive a code? <span id="countdowntimer">30 </span></p>
                </div>
                <div class="form_btn">
                    <button class="submit_btn otp-btn" id="verifyOtp" onclick="">Verify</button>
                </div>
            </section>
            <section class="new-pass-sec" id="new_pass_page" style="display:none;">
                <div class="login-sub-header">
                    <h2>New Password</h2>
                    <p>Please enter new password</p>
                </div>
                <div class="">
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="new_password">Password</label>
                                <input type="password" class="input-box" id="new_password" placeholder="Enter New Password">
                            </div>
                            
                            <div class="possword-group">
                                <img width="24" src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#new_password" data-toggle="false">
                            </div>
                        </div>
                    </div>
                    <span id="" class="error text-danger"></span>
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="confirm_new_password">Re-Enter New Password</label>
                                <input type="password" class="input-box" id="confirm_new_password" placeholder="Enter Password">
                            </div>
                            
                            <div class="possword-group">
                                <img width="24" src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#confirm_new_password" data-toggle="false">
                            </div>
                        </div>
                    </div>
                    <span id="passwordErr" class="error text-danger"></span>
                </div>
                <div class="form_btn">
                    <button class="submit_btn" id="savePasswordBtn" onclick="savepassword()">Save</button>
                </div>
            </section>
            <section class="pass-changed-sec" id="pass_changed" style="display:none;">
                <div class="login-sub-header">
                    <h2>New Password</h2>
                    <p>Your password changed successfully!</p>
                </div>
                <div class="form_btn">
                    <button class="submit_btn" onclick="go_to_login()">Login</button>
                </div>
            </section>
        </div>
    </div>

    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
     var apiPath = "<?php echo $apiPath; ?>";
        // password eye script
        $('.eye-icon').on('click',function(){
            let __changetoggle_state = $(this);
            __changetoggle_state.attr('data-toggle',__changetoggle_state.attr('data-toggle')=='false' ? 'true' : 'false');
            let __get_current_pass_id = $(this).attr('data-value');
            let __get_toggle_state = $(this).attr('data-toggle');
            
            if(__get_toggle_state == "true"){
                $(`${__get_current_pass_id}`).attr('type','text');
                $(this).attr('src','asset/images/password_open@2x.png');
            }
            else{
                $(`${__get_current_pass_id}`).attr('type','password');
                $(this).attr('src','asset/images/hide-eye.svg');
                
            }
        });

        function got_to_forgotPage() {
            $("#login_page").hide();
            $("#forgot_page").show();
            $("#otp_page").hide();
        }
        function go_to_otp() {
            $("#login_page").hide();
            $("#forgot_page").hide();
            $("#otp_page").show();
        }
        function go_to_newPass() {
            $("#login_page").hide();
            $("#forgot_page").hide();
            $("#otp_page").hide();
            $("#new_pass_page").show();
        }
        function go_to_save_pass() {
            $("#login_page").hide();
            $("#forgot_page").hide();
            $("#otp_page").hide();
            $("#new_pass_page").hide();
            $("#pass_changed").show();
        }

        function go_to_login() {
            $("#login_page").show();
            $("#forgot_page").hide();
            $("#otp_page").hide();
            $("#new_pass_page").hide();
            $("#pass_changed").hide();
        }

            // OTP
            let digitValidate = function (ele) {
                console.log(ele.value);
                ele.value = ele.value.replace(/[^0-9]/g, "");
                };

                let tabChange = function (val, ele) {
                let otpclass = ele.className;
                let otpElem = document.querySelectorAll(`.${otpclass}`);
                if (otpElem[val - 1].value != "") {
                    if (val < otpElem.length ) {
                    // check if last box is currently in focus
                    otpElem[val].focus();
                    } else {
                    otpElem[val - 1].focus();
                    }
                } else if (otpElem[val - 1].value == "") {
                    if (val - 1 > 0) {
                    // change focus except on box 1
                    otpElem[val - 2].focus();
                    }
                }
                };
        
        function logindetails(){
            var pass=0;
            if(document.getElementById("business_id").value.trim() == ""){
                document.getElementById("business_idErr").innerHTML = "* Please Enter Business ID!";
            }else{
                document.getElementById("business_idErr").innerHTML = "";
                pass++;
            }if(document.getElementById("password").value.trim() == ""){
                document.getElementById("passwordErr").innerHTML = "* Please Enter Password!";
            }else{
                document.getElementById("passwordErr").innerHTML = "";
                pass++;
            }
            // if(document.getElementById("confirm_password").value.trim() == ""){
            //     document.getElementById("confirm_passwordErr").innerHTML = "* Please Enter Confirm Password!";
            // }else{
            //     document.getElementById("confirm_passwordErr").innerHTML = "";
            //     pass++;
            // }
            if(pass==2){
                var businessID = $("#business_id").val().trim();
                var password = $("#password").val().trim();
                // var confirm_password = $("#confirm_password").val();
                // if(password==confirm_password){
                    var datas = {'business_id':businessID,'password':password};
                    var json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/service-provider/login.php",
                    data: json1
                    }).done(function(data1) {
                        console.log(data1);
//                        return;
                        if(data1.status_code == 200){
                            document.getElementById("business_idErr").innerHTML = "";
                            document.getElementById("passwordErr").innerHTML = "";
                            // document.getElementById("confirm_passwordErr").innerHTML = "";
                            // swal({
                            //     title: "Success!",
                            //     text: data1.message,
                            //     icon: "success",
                            //     button: "Ok",
                            // }).then((value) => {
                                window.location = data1.relocator;
                                localStorage.setItem('logged_name',data1.name);
                                localStorage.setItem('logged_pic',data1.image);
                                localStorage.setItem('loginToken',data1.service_token);
                                console.log(data1.service_token);
                            // });
                        }else{
                            swal({
                                title: "Error!",
                                text: data1.message,
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    });
                // }else{
                //     swal({
                //         title: "Error!",
                //         text: "Password and Confirm Password Does Not Match",
                //         icon: "error",
                //         button: "Ok",
                //     });
                // }
            }
        
        }

        let downloadTimer;
        /*=========== Go to OTP =============*/
        $('body').on('click','#gotootp-submitbtn',function(){
            let businessId = $('#gotootpemail').val();
            
            let timerTime = 30;
            if(downloadTimer != "" || downloadTimer != undefined){
                clearInterval(downloadTimer); 
                document.getElementById("countdowntimer").textContent = timerTime + 's';
            }

            if(businessId == ''){
                swal("Business Id cannot be blank");

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
                sendotp(businessId,timerTime,"send");
            }

        });

        function sendotp(email,timerTime,otpType){
                    let datas = {
                                    "businessId": email
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/service-provider/forgotPassword.php",
                        data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            if(otpType == 'send'){
                                go_to_otp();
                                $('.otpemailcontent').text(`Enter the verification code, We just sent on your registered email address linked with the business Id, ${email}`);
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
            let businessId = $('#gotootpemail').val();
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
                                "businessId": businessId,
                                "otp":otp
                            };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/service-provider/verifyOtp.php",
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
            let businessId = $('#gotootpemail').val();
            let newPassword = $('#new_password').val().trim();
            let confirmPassword = $('#confirm_new_password').val();
            if(newPassword == ''){
                swal("Password Field cannot be blank");
            }else if(newPassword != confirmPassword ){
                swal("Entered Password does not match with confirmed password");
            }else{
                let datas = {
                                "businessId": businessId,
                                "newPassword":newPassword
                            };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/service-provider/setnewPassword.php",
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