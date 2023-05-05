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
    <link rel="stylesheet" href="css/wysiwyg.css?v=<?php echo $js_cache_string; ?>">
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
                <h1 class="header_main">Privacy Policy</h1>
                <p class="total_emp total"></p>
            </div> 
            <div class="col-md-12">
                <div class="well" style="margin: 2rem 0;">
                    <div class="form-group">
                        <label class="control-label" for="editor">Message:</label>
                        <textarea id="editor" class="form-control">
                        
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

    <script src="js/wysiwyg.js?v=<?php echo $js_cache_string; ?>"></script>
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