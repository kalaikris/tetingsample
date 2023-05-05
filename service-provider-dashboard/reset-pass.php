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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
    <link rel="stylesheet" href="css/onbord-css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/onbord-css/login.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link href="css/sweet_alert.min.css" rel="stylesheet">
</head>
<style>
    .mani {
        height:calc(100vh - 90px);
        position: relative;
        top: 90px;
    }
</style>
<body id="page">
    <div id="loading"></div>
    <header id="header"></header>

    <div class="mani" >
        <div class="side_menu" id="before_login"></div>
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
                <div class="">
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="current-pass">Current Password</label>
                                <input type="password" class="input-box" id="current-pass" placeholder="Enter current password">
                            </div>
                            <div class="possword-group">
                                <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#current-pass" data-toggle="false">
                            </div>
                        </div>
                        <p id="passwordErr" class="error text-danger"></p>
                    </div>
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="new-pass">New Password </label>
                                <input type="password" class="input-box" id="new-pass" placeholder="Enter new password">
                            </div>
                            <div class="possword-group">
                                <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#new-pass" data-toggle="false">
                            </div>
                        </div>
                        <p id="passwordErr" class="error text-danger"></p>
                    </div>
                    <div class="text-box-group">
                        <div class="input-form-group-item">
                            <div class="input-box-set">
                                <label for="confirm-pass">Confirm Password</label>
                                <input type="password" class="input-box" id="confirm-pass" placeholder="Enter current password">
                            </div>
                            <div class="possword-group">
                                <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#confirm-pass" data-toggle="false">
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
                </div>
                <div class="form_btn">
                    <button class="submit_btn" onclick="passwordchange();">Submit</button>
                </div>
            </section>
        </div>
    </div>

    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sidemenu.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
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

        

            
    </script>
</body>
</html>