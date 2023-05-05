
<?php
    session_start();
    include_once '../config/core.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>manage-Branding</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- headeer-sidemenu-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/header-sidemenu.css" />
    <link rel="stylesheet" href="css/manage-branding.css">

</head>

<body id="page">
    <div id="loading"></div>
    <header id="header">
    </header>
    <!-- <div class="slider-set" id="sidebar"></div> -->
    <!-- main content box -->
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar">
            </div>
            <!-- manage-Branding -->
            <div class="over-manage-Branding">
                <div class="top-manage-Branding">
                    <div class="list-tital">
                        <h3 class="manage-name">Add new agent</h3>
                    </div>
                    <div class="preview">
                        <button class="preview-click"><img src="asset/img/iee-icon.png"> Preview</button>
                    </div>
                </div>
                <!-- manage-Branding-2-tital -->
                <div class="manage-Branding-main-bar" id="manage1">
                    <!-- main-document-file -->
                    <div class="main-document">
                        <!-- logo -->
                        <div class="main-logo-detial">
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Logo</h4>
                                    <p>Upload your logo so that it would be visible to your audience</p>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_logo" style="display: flex;">
                                        <input id="valid_logo_image" type="hidden">
                                        <input type="file" id="logo_image" class="hidden" onchange="image_validation('logo_image')">
                                        <label for="logo_image">Uploaded Logoo</label>
                                    </div>

                                    <div class="left-logo-tital hidden" id="after_logo">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Landing Banner Image -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Landing Banner Image</h4>
                                    <p>Upload a banner image whitch would elevate your landing page</p>
                                    <small>(Resolution : 1400*540)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_Banner" style="display: flex;">
                                        <input id="valid_banner_image" type="hidden">
                                        <input type="file"  class="hidden" id="banner_image" onchange="image_validation('banner_image')" >
                                        <label for="banner_image">Uploaded Banner Image</label>
                                    </div>

                                    <div class="left-logo-tital hidden" id="after_Banner">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Side Banner Image -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Side Banner Image</h4>
                                    <p>Upload a banner image which would elevate your branding</p>
                                    <small>(Resolution : 1400*540)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_side_banner" style="display: flex;">
                                        <input id="valid_side_banner" type="hidden">
                                        <input type="file"  class="hidden" id="side_banner" onchange="image_validation('side_banner')" >
                                        <label for="side_banner">Uploaded Side Banner</label>
                                    </div>

                                    <div class="left-logo-tital hidden" id="after_side_banner">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Header Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Header Colour</h4>
                                    <p>Choose the header colour which goes well with your logo</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="colorPicker">
                                            <input type="color" value="#FF0000"  id="header_color">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- Brand Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Brand Colour</h4>
                                    <p>Choose your brand colour and all the icons and bitton will match it</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="colormakar">
                                            <input type="color" value="#FF0000"  id="brand_color">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- Landing Page Description -->
                            <div class="Landing-tital">
                                <div class="rait-logo-tital">
                                    <h4>Landing Page Description</h4>
                                    <p class="landing-page">Get all the airport services you need from Meet & greet to
                                        Vise assistance</p>
                                </div>
                                <div class="left-logo-tital">
                                    <!-- <label for="msme" class="msme-cert"><input type="file" id="msme"
                                            class="hide-file">Contract Agreement</label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edit" id="go-next-page">
                        <button class="button edit"><a href="#">Edit</a></button>
                    </div>
                </div>
                <!--no2  -->
                <!-- manage-Branding-2-tital -->
                <div class="manage-Branding-main-bar" id="edit-page">
                    <!-- main-document-file -->
                    <div class="main-document">
                        <!-- logo -->
                        <div class="main-logo-detial">
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Logo</h4>
                                    <p>Upload your logo so that it would be visible to your audience</p>
                                </div>
                                <div class="left-logo-tital">
                                    <img src="./asset/img/blue-tick.png" alt="" class="bluetick">
                                    <h5>Uploaded</h5>
                                    <div class="cancel">
                                        <p>x</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Landing Banner Image -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Landing Banner Image</h4>
                                    <p>Upload a banner image whitch would elevate your landing page</p>
                                    <small>(Resolution : 1400*540)</small>
                                </div>
                                <div class="left-logo-tital">
                                    <img src="./asset/img/blue-tick.png" alt="" class="bluetick">
                                    <h5>Uploaded</h5>
                                    <div class="cancel">
                                        <p>x</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Side Banner Image -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Side Banner Image</h4>
                                    <p>Upload a banner image which would elevate your branding</p>
                                    <small>(Resolution : 1400*540)</small>
                                </div>
                                <div class="left-logo-tital">
                                    <label for="Banner" class="Banner-Image"><input type="file" id="Banner" class="hide-file">Upload Side Banner Image</label>
                                </div>
                            </div>
                            <!-- Header Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Header Colour</h4>
                                    <p>Choose the header colour which goes well with your logo</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="colorselector">
                                            <input type="color"  id="colorselector">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- Brand Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Brand Colour</h4>
                                    <p>Choose your brand colour and all the icons and bitton will match it</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="colorchoose">
                                            <input type="color" value="#023f92" id="colorchoose">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- Landing Page Description -->
                            <div class="Landing-tital">
                                <div class="rait-logo-tital">
                                    <h4>Landing Page Description</h4>
                                    <div class="massage-box">
                                        <textarea class="text_box">Type message....</textarea>
                                        <div class="massage_text">
                                            <p>500 characters left</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="publish" id="go-to-previous">
                        <button class="button-publish" onclick="publish_validation()">Publish</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jquery -->
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js"></script>
    <!-- convas -->
    <script src="./js/jquery.canvasjs.min.js"></script>
    <script src="./js/chart-style.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <!-- color-piker -->
    <script>
        document.querySelectorAll('input[type=color]').forEach(function(picker) {

            var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
                codeArea = document.createElement('span');

            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);

            picker.addEventListener('change', function() {
                codeArea.innerHTML = picker.value;
                targetLabel.appendChild(codeArea);
            });
        });
        $(document).ready(function() {
            $("#edit-page").hide();
            $("#manage1").show();
            $("#go-next-page").click(function() {
                $("#manage1").hide();
                $("#edit-page").show();
            });
            $("#go-to-previous").click(function() {
                $("#manage1").show();
                $("#edit-page").hide();
            });
        });
        $(document).ready(() => {
            $('#manage-branding').addClass('actives');

        });

        function image_validation(id) {
            debugger;
            // alert(id);
            var fuData = document.getElementById(id).files[0].name;
            
            var FileUploadPath = fuData.value;
            var FileUploadPath1 = fuData.split('.').pop().toLowerCase()

            //To check if user upload any file
            if (fuData == '') {
                swal("Please upload an image");

            } else {
                //The file uploaded is an image
                if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg" || FileUploadPath1 == "pdf") {
                    // To Display
                    alert(fuData);
                    field_validation();
                }

                //The file upload is NOT an image
                else {
                    swal("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

                }
            }
        }

        function field_validation(){
            debugger;
            var logoImage = document.querySelector('#after_logo');
            var logoImage1 = document.querySelector('#before_logo');
            var logo_value = document.getElementById('logo_image').value;

            var bannerImage = document.querySelector('#after_Banner');
            var bannerImage1 = document.querySelector('#before_Banner');
            var banner_value = document.getElementById('banner_image').value;

            var side_bannerImage = document.querySelector('#after_side_banner');
            var side_bannerImage1 = document.querySelector('#before_side_banner');
            var side_banner_value = document.getElementById('side_banner').value
            
            if (logo_value != '') {
                logoImage.style.display = 'flex'; 
                logoImage1.style.display = 'none'; 
                
            }else{
                 logoImage.style.display = 'none'; 
                 logoImage1.style.display = 'flex';

            }
            if (banner_value != '') {
                bannerImage.style.display = 'flex'; 
                bannerImage1.style.display = 'none'; 
                
            }else{
                 bannerImage.style.display = 'none'; 
                 bannerImage1.style.display = 'flex';

            }
            if (side_banner_value != '') {
                side_bannerImage.style.display = 'flex'; 
                side_bannerImage1.style.display = 'none'; 
                
            }else{
                 side_bannerImage.style.display = 'none'; 
                 side_bannerImage1.style.display = 'flex';

            }

        }



        function publish_validation(){
            var logo_value = document.getElementById('logo_image').value;
            var banner_value = document.getElementById('banner_image').value;
            var side_banner_value = document.getElementById('side_banner').value
            if((logo_value !='') && (banner_value !='') && (side_banner_value !='')){
            image_upload_loop(0);
        }else{
            swal("upload all Image");
            
        }
        }







        // For S3 bucket
    AWS.config.region = 'ap-south-1'; // 1. Enter your region
    AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    IdentityPoolId: 'ap-south-1:0d3824be-4bcd-4ac8-8f34-b29baa427f00' // 2. Enter your identity pool
    });
    AWS.config.credentials.get(function (err) {
    if (err) alert(err);
    });
    var bucket = new AWS.S3({
    params: {Bucket: 'airportzoapp'}
    });
    var aws_cloudfront_url = 'https://d1xqjehqvi7b4u.cloudfront.net/';         
          

    var image_id = ['logo_image','banner_image','side_banner'];
    function image_upload_loop(key){
        var checkkey = key+1;
        if(checkkey>image_id.length){
           on_sumbit_value();
        }else{
            var fileUpload = document.getElementById(image_id[key]);
            var file = fileUpload.files[0];
//            console.log(file);
            s3_file_upload(file, key);
        }
    }    
     
    function s3_file_upload(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds+key+'.'+extension;
//       console.log("filename:"+filename);
        var folder = 'service_distributor/documents/distnew/';
        var objKey = folder + filename;
        var params = {
            Key: objKey,
            ContentType: file.type,
            Body: file
        };
        bucket.putObject(params, function (err, data) {
            if (err) {
                alert('ERROR: ' + err);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                // console.log(image_fileurl);
                $("#valid_"+image_id[key]).val(image_fileurl);
                key++;
                image_upload_loop(key);
            }
        });
    }  

    function on_sumbit_value(){

        var get_logo_image = document.getElementById('valid_logo_image').value;
        var get_banner_image = document.getElementById('valid_banner_image').value;
        var get_side_banner = document.getElementById('valid_side_banner').value;
        var header_color = document.getElementById('header_color').value;
        var brand_color = document.getElementById('brand_color').value;
        var datas = {
                        'logo_image':get_logo_image,
                        'banner_image':get_banner_image,
                        'side_banner':get_side_banner,
                        'header_color':header_color,
                        'brand_color':brand_color
                    };
        console.log(get_logo_image);
        console.log(get_banner_image);
        console.log(get_side_banner);
    }


    </script>
</body>
</html>
<?php
}
?>