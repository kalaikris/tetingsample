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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/master_data.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/web-banner.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

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

         <!-- manage-Branding -->
        <div class="over-manage-Branding">
                <div class="top-manage-Branding">
                    <div class="list-tital">
                        <h3 class="manage-name">Manage Branding</h3>
                    </div>
                    <div class="preview" hidden>
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
                                    <small>(Resolution : Height is 200px, width can be dynamic)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_logo" style="display: flex;">
                                        <input id="valid_logo_image" type="hidden">
                                        <input type="file" accept="image/png" id="logo_image" class="hidden" onchange="image_validation('logo_image')">
                                        <label for="logo_image">Upload Logo</label>
                                    </div>
                                    <label for="logo_image" id="logo_show" style="display:none;"><img src="" alt="" id="view_logo_image" class="uploaded-img"></label>

                                    <div class="left-logo-tital" id="after_logo" onclick="clearImageData('logo_image')" style="display: none;">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Favicon -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Favicon</h4>
                                    <p>Upload your favicon so that it would be visible to your audience</p>
                                    <small>(Resolution : Height is 16px, width is 16px)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_favicon" style="display: flex;">
                                        <input id="valid_favicon_image" type="hidden">
                                        <input type="file" accept="image/png" id="favicon_image" class="hidden" onchange="image_validation('favicon_image')">
                                        <label for="favicon_image">Upload Logo</label>
                                    </div>
                                    <label for="favicon_image" id="favicon_show" style="display:none;"><img src="" alt="" id="view_favicon_image" class="uploaded-img"></label>

                                    <div class="left-favicon-tital" id="after_favicon" onclick="clearImageData('favicon_image')" style="display: none;">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Landing Banner Image -->
                            <div class="logo-tital" hidden>
                                <div class="rait-logo-tital">
                                    <h4>Landing Banner Image</h4>
                                    <p>Upload a banner image whitch would elevate your landing page</p>
                                    <small>(Resolution : 1400px * 540px)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_Banner" style="display: flex;">
                                        <input id="valid_banner_image" type="hidden">
                                        <input type="file" accept="image/png"  class="hidden" id="banner_image" onchange="image_validation('banner_image')" >
                                        <label for="banner_image">Upload Banner Image</label>
                                    </div>

                                    <div class="left-logo-tital" id="after_Banner" onclick="clearImageData('banner_image')" style="display: none;">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Side Banner Image -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Banner Image</h4>
                                    <p>Upload a banner image which would elevate your branding</p>
                                    <small>(Resolution : 1400px * 540px)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_side_banner" style="display: flex;">
                                        <input id="valid_side_banner" type="hidden">
                                        <input type="file" accept="image/png" class="hidden" id="side_banner" onchange="image_validation('side_banner')" >
                                        <label for="side_banner">Upload Banner</label>
                                    </div>
                                    <label for="side_banner" id="banner_show" style="display:none;"><img src="" alt="" id="view_side_banner" class="uploaded-img"></label>

                                    <div class="left-logo-tital" style="display: none;" id="after_side_banner" onclick="clearImageData('side_banner')">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div>
                            <!-- poster image -->
                              <!-- <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Poster Image</h4>
                                    <p>Upload a Poster image which would elevate your branding</p>
                                    <small>(Resolution : 450px * 700px)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_poster_image" style="display: flex;">
                                        <input id="valid_poster_image" type="hidden">
                                        <input type="file" accept="image/png" class="hidden" id="poster_image" onchange="image_validation('poster_image')" >
                                        <label for="poster_image">Upload Poster Image</label>
                                    </div>
                                    <label for="poster_image" id="poster_show" style="display:none;"><img src="" alt="" id="view_poster_image" class="uploaded-img"></label>

                                    <div class="left-logo-tital" style="display: none;" id="after_poster" onclick="clearImageData('poster_image')">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
                                    </div>
                                    <div class="validation-text hide" id="business_name_validate" style="visibility: visible;">
                                        <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Footer logo -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Footer logo</h4>
                                    <p>Upload a Footer image which your Audience would see</p>
                                    <small>(Resolution : Height is 200px, width can be dynamic)</small>
                                </div>
                                <div>
                                    <div class="pan_cont" id="before_footer_logo" style="display: flex;">
                                        <input id="valid_footer_logo" type="hidden">
                                        <input type="file" accept="image/png"  class="hidden" id="footer_logo" onchange="image_validation('footer_logo')" >
                                        <label for="footer_logo">Upload Footer logo</label>
                                    </div>
                                    <label for="footer_logo" id="footer_show" style="display:none;"><img src="" alt="" id="view_footer_logo" class="uploaded-img"></label>

                                    <div class="left-logo-tital" style="display: none;" id="after_footer_logo" onclick="clearImageData('footer_logo')">
                                        <img src="asset/img/blue-tick.png" alt="" class="bluetick"  >
                                        <h5>Uploaded</h5>
                                        <div class="cancel">
                                            <p>x</p>
                                        </div>
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
                                        <label for="header_color">
                                            <input type="color" value="#FF0000"  id="header_color">
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <!-- Header text Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Header Text Colour</h4>
                                    <p>Choose the header text colour which goes well with your logo</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="header_text_color">
                                            <input type="color" value="#FF0000"  id="header_text_color">
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <!-- Brand Colour -->
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Brand Colour</h4>
                                    <p>Choose your brand colour and all the icons and button will match it</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="brand_color">
                                            <input type="color" value="#FF0000"  id="brand_color">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- secondary color -->
                             <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Secondary Colour</h4>
                                    <p>Choose your brand colour and all the icons and button will match it</p>
                                </div>
                                <div class="left-logo-tital">
                                    <div class="color">
                                        <p><code>input[type=color]</code>.</p>
                                        <p style="margin-bottom:50px">You can see the HEX code of picked color.</p>
                                    </div>
                                    <span class="color-picker">
                                        <label for="secondary_color">
                                            <input type="color" value="#FF0000"  id="secondary_color">
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <!-- Landing Page Description -->
                            <div class="Landing-tital">
                                <div class="rait-logo-tital">
                                    <h4>Landing Page Description</h4>
                                    <p class="landing-page">Get all the airport services you need from Meet & greet to Vise assistance</p>
                                    <!-- <div class="massage-box" style="display:none;"> -->
                                        <div class="massage-box"   id = "show_text_area">
                                        <textarea class="text_box" placeholder="Type message...." id = "text_area_value" ></textarea>
                                            <div class="massage_text">
                                            <p>500 characters left</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="left-logo-tital">
                                    <!-- <label for="msme" class="msme-cert"><input type="file" id="msme"
                                            class="hide-file">Contract Agreement</label> -->
                                </div>
                            </div>
                            <div class="edit-publish-set">
                                <div class="edit-set">
                                    <button class="edit-button" id="edit-agent">Edit</button>
                                </div>
                                <div class="publish-set hidden">
                                    <button class="button-publish" id="publish-agent" onclick="publish_validation()">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--no2  -->
                <!-- <div class="manage-Branding-main-bar" id="edit-page">
                    <div class="main-document">
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
                            <div class="logo-tital">
                                <div class="rait-logo-tital">
                                    <h4>Brand Colour</h4>
                                    <p>Choose your brand colour and all the icons and button will match it</p>
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
                </div> -->
            </div>


    </main>
    <script src="js/jquery.min.js"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

    <script>
    $(document).ready(() => {
        $("#loading").hide(); 
    });

    $("#edit-agent").click(function() {
                $(".edit-set").addClass('hidden');
                $(".publish-set").removeClass('hidden');
                var text_area = document.getElementById('show_text_area');
                console.log(text_area);
                text_area.style.visibility='visible';
        });
        // ----- end -----  //
        // Color picker
        document.querySelectorAll('input[type=color]').forEach(function(picker) {
            var targetLabel = document.querySelector('label[for="' + picker.id + '"]'),
            codeArea = document.createElement('span');
            codeArea.classList.add('primary-color');

            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);

            picker.addEventListener('change', function() {
            codeArea.innerHTML = picker.value;
            targetLabel.appendChild(codeArea);
            });
        });
          
        $(document).ready(() => {
            //var userToken = localStorage.getItem('userToken');
            // if(userToken == "" || userToken == undefined ){
            //     window.location = 'login.php'
            // }
            $('#manage-branding').addClass('actives');
                var text_area = document.getElementById('show_text_area');
                text_area.style.visibility='hidden';
                fetch_branddetails();
        });

        function fetch_branddetails(){
            var distributorToken = "1111111111";
            let datas = {
                "distributorToken":distributorToken,
                //"userToken":userToken
            };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/getBrandingDetails.php",
                    data: json1
                    }).done(function(data1) {
                        let brandingdetails = data1.data;
                        if(brandingdetails.headerLogo != ''){
                            $('#view_logo_image').attr('src',`${brandingdetails.headerLogo}`)
                            $("#logo_show").attr('style', 'display:flex;')
                             $('#before_logo').attr('style','display:none;'); 

                        }
                        if(brandingdetails.faviconLogo != ''){
                            $('#view_favicon_image').attr('src',`${brandingdetails.faviconLogo}`)
                            $("#favicon_show").attr('style', 'display:flex;')
                             $('#before_favicon').attr('style','display:none;'); 

                        }
                         if(brandingdetails.footerLogo != ''){
                            $('#view_footer_logo').attr('src',`${brandingdetails.footerLogo}`);
                            $("#footer_show").attr('style', 'display:flex;')
                             $('#before_footer_logo').attr('style','display:none;'); 
                            

                        }
                         if(brandingdetails.bannerImage != ''){
                            $('#view_side_banner').attr('src',`${brandingdetails.bannerImage}`);
                            $("#banner_show").attr('style', 'display:flex;')
                             $('#before_side_banner').attr('style','display:none;'); 

                        }
                         if(brandingdetails.posterImage != ''){
                            $('#view_poster_image').attr('src',`${brandingdetails.posterImage}`);
                            $("#poster_show").attr('style', 'display:flex;')
                             $('#before_poster_image').attr('style','display:none;'); 

                        }
                        $('#text_area_value').val(brandingdetails.description);
                        $('#header_color').val(brandingdetails.headerColour);
                        $('#header_color').siblings('span').text(brandingdetails.headerColour);
                        $('#header_text_color').val(brandingdetails.headerTextColour);
                        $('#header_text_color').siblings('span').text(brandingdetails.headerTextColour);
                        $('#brand_color').val(brandingdetails.brandColour);
                        $('#brand_color').siblings('span').text(brandingdetails.brandColour);
                        $('#secondary_color').val(brandingdetails.secondaryColour);
                        $('#secondary_color').siblings('span').text(brandingdetails.secondaryColour);

                    })
        }

        function image_validation(id) {
        
            // alert(id);
            var fuData = document.getElementById(id).files[0].name;
            
            var FileUploadPath = fuData.value;
            var FileUploadPath1 = fuData.split('.').pop().toLowerCase()

            //To check if user upload any file
            if (fuData == '') {
                swal("Please upload an image");

            } else {
                //The file uploaded is an image
                if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg" ) {

                    if(id == 'logo_image'){
                        const [file_logo_image] = logo_image.files
                        if (file_logo_image) {
                            view_logo_image.src = URL.createObjectURL(file_logo_image);
                            $("#logo_show").attr('style', 'display:flex;')
                             $('#before_logo').attr('style','display:none;'); 
                            
                        }   
                    }
                    if(id == 'favicon_image'){
                        const [file_favicon_image] = favicon_image.files
                        if (file_favicon_image) {
                            view_favicon_image.src = URL.createObjectURL(file_favicon_image);
                            $("#favicon_show").attr('style', 'display:flex;')
                             $('#before_favicon').attr('style','display:none;'); 
                            
                        }   
                    }
                    if(id == 'side_banner'){
                        const [file_side_banner] = side_banner.files
                        if (file_side_banner) {
                            view_side_banner.src = URL.createObjectURL(file_side_banner);
                             $("#banner_show").attr('style', 'display:flex;')
                             $('#before_side_banner').attr('style','display:none;'); 
                        }   
                    }
                    if(id == 'poster_image'){
                        const [file_poster_image] = poster_image.files
                        if (file_poster_image) {
                            view_poster_image.src = URL.createObjectURL(file_poster_image)

                            $("#poster_show").attr('style', 'display:flex;')
                             $('#before_poster_image').attr('style','display:none;'); 
                        }   
                    }
        // file1 - msme
        // file2 - incorporationImage
                    if(id == 'footer_logo'){
                        const [file_footer_logo] = footer_logo.files
                        if (file_footer_logo) {
                            view_footer_logo.src = URL.createObjectURL(file_footer_logo);
                            $("#footer_show").attr('style', 'display:flex;')
                             $('#before_footer_logo').attr('style','display:none;'); 
                        }   
                    }
                    // To Display
                    //alert(fuData);
                    //field_validation();
                }

                //The file upload is NOT an image
                else {
                    swal("Photo only allows file types of GIF, PNG, JPG, and JPEG ");

                }
            }
        }

        function field_validation(){
            
            var logoImage = document.querySelector('#after_logo');
            var logoImage1 = document.querySelector('#before_logo');
            var logo_value = document.getElementById('logo_image').value;

            var faviconImage = document.querySelector('#after_favicon');
            var faviconImage1 = document.querySelector('#before_favicon');
            var favicon_value = document.getElementById('favicon_image').value;

            var bannerImage = document.querySelector('#after_Banner');
            var bannerImage1 = document.querySelector('#before_Banner');
            var banner_value = document.getElementById('banner_image').value;

            var side_bannerImage = document.querySelector('#after_side_banner');
            var side_bannerImage1 = document.querySelector('#before_side_banner');
            var side_banner_value = document.getElementById('side_banner').value

            var posterImage = document.querySelector('#after_poster');
            var posterImage1 = document.querySelector('#before_poster_image');
            var poster_value = document.getElementById('poster_image').value

            var footerImage = document.querySelector('#after_footer_logo');
            var footerImage1 = document.querySelector('#before_footer_logo');
            var footer_value = document.getElementById('footer_logo').value
            
            if (logo_value != '') {
                // logoImage.style.display = 'flex'; 
                $("#logo_show").attr('style', 'display:flex;')
                logoImage1.style.display = 'none'; 
                
            }else{
                 //logoImage.style.display = 'none'; 
                 logoImage1.style.display = 'flex';
                 $("#logo_show").attr('style', 'display:none;')

            }
            if (favicon_value != '') {
                // logoImage.style.display = 'flex'; 
                $("#favicon_show").attr('style', 'display:flex;')
                faviconImage1.style.display = 'none'; 
                
            }else{
                 //logoImage.style.display = 'none'; 
                 faviconImage1.style.display = 'flex';
                 $("#favicon_show").attr('style', 'display:none;')

            }
            if (banner_value != '') {
                bannerImage.style.display = 'flex'; 
                bannerImage1.style.display = 'none'; 
                
            }else{
                 bannerImage.style.display = 'none'; 
                 bannerImage1.style.display = 'flex';

            }
            if (side_banner_value != '') {
               //side_bannerImage.style.display = 'flex'; 
               $("#banner_show").attr('style', 'display:flex;')
                side_bannerImage1.style.display = 'none'; 
                
            }else{
                //side_bannerImage.style.display = 'none'; 
                $("#banner_show").attr('style', 'display:none;')
                 side_bannerImage1.style.display = 'flex';

            }
            if (poster_value != '') {
                //posterImage.style.display = 'flex'; 
                $("#poster_show").attr('style', 'display:flex;')
                posterImage1.style.display = 'none'; 
                
            }else{
                 //posterImage.style.display = 'none'; 
                 $("#poster_show").attr('style', 'display:none;')
                 posterImage1.style.display = 'flex';

            }

             if (footer_value != '') {
                //footerImage.style.display = 'flex'; 
                $("#footer_show").attr('style', 'display:flex;')
                footerImage1.style.display = 'none'; 
                
            }else{
                 //footerImage.style.display = 'none'; 
                 $("#footer_show").attr('style', 'display:none;')
                 footerImage1.style.display = 'flex';

            }

        }

        function clearImageData(id){
           

            if(id == "logo_image" ){
                $('#logo_image').val("");
            }
            if(id == "favicon_image" ){
                $('#favicon_image').val("");
            }
            if(id == "banner_image" ){
                $('#banner_image').val("");
            }
            if(id == "side_banner" ){
                $('#side_banner').val("");
            }
            if(id == "poster_image" ){
                $('#poster_image').val("");
            }
            if(id == "footer_logo" ){
                $('#footer_logo').val("");
            }
            field_validation();
        }



        function publish_validation(){
            $('#publish-agent').prop('disabled',true);
            var logo_value = document.getElementById('logo_image').value;
            let logo_src = $('#view_logo_image').attr('src');
            var favicon_value = document.getElementById('favicon_image').value;
            let favicon_src = $('#view_favicon_image').attr('src');
            //var banner_value = document.getElementById('banner_image').value;
            var side_banner_value = document.getElementById('side_banner').value;
            let banner_src =  $('#view_side_banner').attr('src');
            var poster_image = document.getElementById('poster_image').value;
            console.log(poster_image);
            let poster_src =  $('#view_poster_image').attr('src');
            var footer_logo = document.getElementById('footer_logo').value;
            let footer_src = $('#view_footer_logo').attr('src');
            if((logo_src !='')  && (banner_src !='') && (poster_src !='') && (footer_src !='')){

                if(logo_value == '' || logo_value == undefined){
                    $('#valid_logo_image').val(logo_src);

                }else{
                    image_id.push('logo_image');
                }
                if(favicon_value == '' || favicon_value == undefined){
                    $('#valid_favicon_image').val(favicon_src);

                }else{
                    image_id.push('favicon_image');
                }
                if(side_banner_value == '' || side_banner_value == undefined){
                    $('#valid_side_banner').val(banner_src);
                }else{
                    image_id.push('side_banner');
                }
                if(poster_image == '' || poster_image == undefined){
                    $('#valid_poster_image').val(poster_src);
                }else{
                    image_id.push('poster_image');
                }
                if(footer_logo == '' || footer_logo == undefined){
                    $('#valid_footer_logo').val(footer_src);
                }else{
                    image_id.push('footer_logo');
                }
                if(image_id.length == 0){
                    on_sumbit_value();
                }else{
                    image_upload_loop(0);

                }
                
            }else{
                swal("upload all Image");
                $('#publish-agent').prop('disabled',false);
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
          

    //var image_id = ['logo_image','side_banner','poster_image','footer_logo'];
    var image_id = [];
    function image_upload_loop(key){
        var checkkey = key+1;
        if(checkkey>image_id.length){
           on_sumbit_value();
        }else{
            var fileUpload = document.getElementById(image_id[key]);
            var file = fileUpload.files[0];
            s3_file_upload(file, key);
        }
    }    
     
    function s3_file_upload(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds+key+'.'+extension;
        let folderPath = '';
        if(image_id[key] == 'logo_image' || image_id[key] == 'footer_logo'){
            folderPath = 'manage_brand/logo/';

        }else if(image_id[key] == 'banner_image' || image_id[key] == 'side_banner'){
            folderPath = 'manage_brand/banner_image/';
        } else if(image_id[key] == 'poster_image'){
            folderPath = 'manage_brand/poster_image/';

        }else{
            folderPath = 'manage_brand/';
        }
        var folder = `service_distributor/${folderPath}`;
        var objKey = folder + filename;
        var params = {
            Key: objKey,
            ContentType: file.type,
            Body: file
        };
        bucket.putObject(params, function (err, data) {
            if (err) {
                alert('ERROR: ' + err);
                $('#publish-agent').prop('disabled',false);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#valid_"+image_id[key]).val(image_fileurl);
                key++;
                image_upload_loop(key);
            }
        });
    }  

    // echo $_COOKIE['service_token'];
    function on_sumbit_value(){

        var get_logo_image = document.getElementById('valid_logo_image').value;
        var get_favicon_image = document.getElementById('valid_favicon_image').value;
        //var get_banner_image = document.getElementById('valid_banner_image').value;
        var get_side_banner = document.getElementById('valid_side_banner').value;
        var get_poster_image = document.getElementById('valid_poster_image').value;
        var get_footer_logo = document.getElementById('valid_footer_logo').value;
        var header_color = document.getElementById('header_color').value;
        var header_text_color = document.getElementById('header_text_color').value;
        var brand_color = document.getElementById('brand_color').value;
        var secondary_color = document.getElementById('secondary_color').value;
        var text_area_value = document.getElementById('text_area_value').value;
        var distributorToken =  localStorage.getItem('distributorToken') ;
        var userToken = localStorage.getItem('userToken');

        var datas = {
                        "distributorToken":distributorToken,
                        "userToken":userToken,
                        "deviceToken":"test",
                        "logo":get_logo_image,
                        "favicon":get_favicon_image,
                        "BannerImage":get_side_banner,
                        "posterImage":get_poster_image,
                        "footerLogo":get_footer_logo,
                        "headerColor":header_color,
                        "headerTextColor":header_text_color,
                        "brandColor":brand_color,
                        "secondaryColor":secondary_color,
                        "description":text_area_value
                    };        
         var json1 = JSON.stringify(datas);

                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/distributor/mangageBranding.php",
                data: json1
                }).done(function(data1){
                    if(data1.status_code == 201){
                        // window.location = "booking.php";
                        // alert("booking");
                        swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"success",

                                }).then(function(){
                                    location.reload();
                                });
                    }else{
                        // swal(data1.message);
                        swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                                $('#publish-agent').prop('disabled',false);
                    }
                    });
    }

    </script>
</body>
</html>
<?php
}
?>