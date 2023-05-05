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
    <link rel="stylesheet" href="./css/header-sidemenu.css" />
    <link rel="stylesheet" href="./css/booklist.css" />
    <style type="text/css">
        span.error {
            color: red;
            padding-bottom: 14px;
        }
        .eye-icon {
            width: 24px;
        }
        .input-form-group-item {
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <header id="header"></header>
    <div class="mani">
        <div class="side_menu" id="before_login">
           
        </div>
        <div class="mani_menu">
            <div class="login-header-set">
                <img src="asset/images/color-logo.png" alt="logo" class="logo-image">
                <h2>Make Your Journey As Enjoyable As The Destination</h2>
            </div>
            <div class="underline-div"></div>
            <section class="login-sec" id="login_page">
                <div class="login-sub-header">
                    <h2>Change Password</h2>
                    <!-- <p>Kindly use your Business ID and password to login</p> -->
                </div>
                <div class="input-form-group">
                    <div class="input-form-group-item">
                        <div class="input-box-set">
                            <label for="current-pass">Current Password</label>
                            <input type="password" class="input-box" id="current-pass" placeholder="Enter current password">
                        </div>
                        <div class="possword-group">
                            <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#current-pass" data-toggle="false">
                        </div>
                    </div>
                    <div class="input-form-group-item">
                        <div class="input-box-set">
                            <label for="new-pass">New Password </label>
                            <input type="password" class="input-box" id="new-pass" placeholder="Enter new password">
                        </div>
                        <div class="possword-group">
                            <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#new-pass" data-toggle="false">
                        </div>
                    </div>
                    <div class="input-form-group-item">
                        <div class="input-box-set">
                            <label for="confirm-pass">Confirm Password</label>
                            <input type="password" class="input-box" id="confirm-pass" placeholder="Enter current password">
                        </div>
                        <div class="possword-group">
                            <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#confirm-pass" data-toggle="false">
                        </div>
                    </div>
                </div>
                <div class="form_btn">
                    <button class="submit_btn" onclick="passwordchange()">Submit</button>
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
    <script src="js/heder-sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
            var apiPath = "<?php echo $apiPath; ?>";


            $(document).ready(() => {
                    if(userToken == "" || userToken == undefined ){
                        window.location = 'login.php'
                    }
            })

                

                // password eye script
                $('.eye-icon').on('click',function(){
                    let __changetoggle_state = $(this);
                    __changetoggle_state.attr('data-toggle',__changetoggle_state.attr('data-toggle')=='false' ? 'true' : 'false');
                    let __get_current_pass_id = $(this).attr('data-value');
                    let __get_toggle_state = $(this).attr('data-toggle');

                    if(__get_toggle_state == "true"){
                        $(`${__get_current_pass_id}`).attr('type','text');
                        $(this).attr('src','asset/images/open-eye.png');
                    }
                    else{
                        $(`${__get_current_pass_id}`).attr('type','password');
                        $(this).attr('src','asset/images/hide-eye.svg');
                    }
                });

                

                //change password
                function passwordchange() {
                let currentPassword = $("#current-pass").val();
                let newPassword = $("#new-pass").val();
                let confirmPassword = $("#confirm-pass").val();
                if (currentPassword == "" || newPassword == "") {
                    swal("Current and new password fields cannot be empty");
                } else if (newPassword != confirmPassword) {
                    swal("Entered new password and confirmed password field does not match");
                } else {
                    let datas = {
                        "userToken":userToken,
                        "distributorToken":distributorToken,
                    "currentPassword": currentPassword,
                    "newPassword": newPassword,
                    };
                    let json1 = JSON.stringify(datas);
                    console.log(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/distributor/distributorUpdatePassword.php",
                    data: json1,
                    }).done(function (data1) {
                    console.log(data1);
                    if (data1.status_code == 201) {
                        swal({
                        title: data1.title,
                        text: data1.message,
                        icon: "success",
                        }).then(() => {
                        $('.logout').click();
                        });
                    } else {
                        swal({
                        title: data1.title,
                        text: data1.message,
                        icon: "warning",
                        }).then(() => {
                        $("#current-pass").val("");
                        $("#new-pass").val("");
                        $("#confirm-pass").val("");
                        });
                    }
                    });
                }
                }

    </script>
</body>
</html>