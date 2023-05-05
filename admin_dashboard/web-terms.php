<?php
    session_start();
    include_once '../config/core.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Branch Management</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/highlight.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/editor.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>"> 
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">

    <style>
.btn-group {
    display: block !important;
}
.bg-white{
    background : #fff !important;
}
</style>
</head>


<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar15"></div>

    <!-- main-contents -->
    <main class="main-contents">

        <section class="bg-white full-height" id="">
            <div class="header-details">
                <h1 class="header_main">Terms and Conditions</h1>
                <p class="total_emp total"></p>
            </div> 
            <div class="col-md-12">
                <div class="well" style="margin: 2rem 0;">
                    <div class="form-group">
                        <label class="control-label" for="editor">Message:</label>
                        <textarea id="editor" class="form-control"
                            value='<div class="heading-set" style="text-align: center; color: rgb(0, 0, 0); font-family: Rubik-Regular; font-size: 14px;">
                            <h2 style="color: rgba(0, 0, 0, 0.85); margin-bottom: 20px; font-size: 28px; letter-spacing: -1px; padding-bottom: 10px;">Terms And Conditions</h2>
                            </div>
                            <div class="terms__container" style="padding-right: 75px; padding-left: 75px; color: rgb(0, 0, 0); font-family: Rubik-Regular; font-size: 14px;">
                            <div class="sub__terms-container" style="margin-bottom: 32px;"><h4 style="font-family: var(--font-secondary); margin-bottom: 12px;">TERMS AND CONDITIONS OF USE OF MEET AND GREET SERVICE</h4>
                            <p style="margin-bottom: 14px;">This is an electronic contract in terms of Information Technology Act, 2000 and rules there under, as applicable. This electronic contract is generated by a computer system and does not require any physical or digital signatures.</p>
                            <p style="margin-bottom: 14px;">The Terms and Conditions for Acceptable Use of Website and Services (Terms and Conditions) sets out, inter alia, a list of acceptable and unacceptable conduct for use of the Services sold on www.AirportZo.com (Service). These Terms and Conditions create a binding legal agreement between a person using or accessing this Website or availing the Service through the Website (you or Passenger) and AirportZo Private Limited (AirportZo, we, our or us) Authorized Licensee of the online marketplace and consolidator portal www.AirportZo.com for Meet and Assist service providers, airport lounge, baggage porters and other similar ancillary service providers at Airports in India and abroad.</p>
                            <p style="margin-bottom: 14px;">If we believe a violation of these Terms and Conditions is deliberate, repeated or presents a credible risk of harm to other users, or the Services or any third parties, we may suspend or terminate your access.</p>
                            <p style="margin-bottom: 14px;">The Service shall be provided by various third-party operators at various airports (Service Providers). This website (www.AirportZo.com/) is solely, developed, operated and maintained by AirportZo.</p></div>
                            </div>'>
                        </textarea>
                    </div>
                </div>
            </div>
        </section>

    </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- jquery CDN -->
    <!-- <script src="js/bootstrap.min.js"></script> -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="js/editor.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/highlight.js?v=<?php echo $js_cache_string; ?>"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/aws-sdk.min.js"></script>


<script type="text/javascript">
    $(document).ready(() => {
    $("#loading").hide(); 
    });

    $(document).ready(function () {
        $('#editor').wysiwyg({
            highlight: true,
            debug: true
        });
    });
    </script>

</body>
</html>
<?php
}
?>