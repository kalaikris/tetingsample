<?php
    session_start();
    include_once '../config/core.php';
    include '../security/secure.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Onboarding</title>
        <link rel="shortcut icon" href="asset/images/fav-icon.png">
        <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/onbord-css/common.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/onbord-css/index.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/select.css">
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
        <style>
            .uppercase {
                text-transform: uppercase;
            }
            .document-body {
                height: 75%;
                overflow-y:scroll;
            }
        </style>
    </head>
    <body id="page">
         <div id="loading"></div>

        <div class="mani">
            <div class="side_menu" id="after_login"></div>
            <div class="mani_menu">
                <section class="Business-info-sec sec-tab active" id="business_info">
                    <div class="Business-info-set">
                        <div class="header-title">
                            <h2>Business info</h2>
                        </div>
                        <div class="underline-div"></div>
                        <input id="companylogourl" type="hidden">
                        <label for="userImage">
                            <img src="asset/images/upload-icon.png" id="uploadedimage" style="width:150px; cursor: pointer;" alt="upload icon" class="upload-icon">
                        </label>
                        <input id="imgValidId" type="hidden" >
                        <input id="userImage" type="file" onchange="imageUpload('userImage','uploadedimage','imgValidId');" accept="image/x-png, image/gif, image/jpeg,image/jpg" style="display:none;">
                        <p id="userImageErr" style="color: red; font-size: 13px;"></p>

                        <input id="companyimageurl" type="hidden">
                        <label for="companyImage">
                            <img src="asset/images/company_Image.svg" id="companyuploadedimage" style="width:150px; cursor: pointer;" alt="upload icon" class="upload-icon">
                        </label>
                        <input id="companyimgvalid" type="hidden">
                        <input id="companyImage" type="file" onchange="imageUpload('companyImage','companyuploadedimage','companyimgvalid');" accept="image/x-png, image/gif, image/jpeg,image/jpg" style="display:none;">
                        <p id="companyImageErr" style="color: red; font-size: 13px;"></p>
                        <div class="input-form-group">
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Business Name</p>
                                        <input type="text" class="input-box" id="businessName" placeholder="Enter Business Name">
                                    </div>
                                </div>
                                <div>
                                    <p id="businessNameErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p for="select_reason">Business Type</p>
                                        <select class="select-input" id="businessType"></select>
                                    </div>
                                </div>
                                <div>
                                    <p id="businessTypeErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Business Website</p>
                                        <input type="text" class="input-box" id="businessWebsite" placeholder="Enter Business Website">
                                    </div>
                                </div>
                                <div>
                                    <p id="businessWebsiteErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>

                            <div class="text-box-group">
                                <div class='input-form-group-item arriving-input-set input-group' id='arrive_date1'>
                                    <div class="select-group">
                                        <label class="input-group-addon bg-date" for="yearOfInception"></label>
                                    </div>  
                                    <div class="input-box-set border-right">
                                        <p for="arrive_date">Year of Inception</p>
                                        <input type='text' class="b-input datepicker" id="yearOfInception" placeholder="Enter Year of Inception" readonly/>
                                    </div>
                                </div>
                                <div>
                                    <p id="yearOfInceptionErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Business Email Address</p>
                                        <input type="email" class="input-box" id="businessEmailAddress" placeholder="Enter Business Email Address" autocomplete="off">
                                    </div>
                                </div>
                                <div>
                                    <p id="businessEmailAddressErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="login-input-action-set" id="phone_mobileno">
                                        <div class="login-input-group phone">
                                            <p>Business Mobile Number</p>
                                            <input type="tel" class="login-input-box" id="business_mobile_number" name="phone"/>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p id="business_mobile_numberErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                        </div>
                        <div class="underline-div"></div>
                        <div class="step-form-header">
                            <h3>Primary Contact Details</h3>
                            <p>Help us reach you and keep you posted</p>
                        </div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="select-group">
                                        <select class="select-box" id="contacted_person">
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="input-box-set border-right">
                                        <p>Contact Name</p>
                                        <input type="text" class="input-box" id="contactName" placeholder="Enter Contact Name">
                                    </div>
                                </div>
                                <div>
                                    <p id="contactNameErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Designation</p>
                                        <input type="text" class="input-box" id="designation" placeholder="Enter Designation">
                                    </div>
                                </div>
                                <div>
                                    <p id="designationErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="login-input-action-set" id="phone_mobileno">
                                        <div class="login-input-group phone">
                                            <p>Mobile Number</p>
                                            <input type="tel" class="login-input-box" id="mobile_number" name="phone" />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p id="mobile_numberErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Email Address</p>
                                        <input type="email" class="input-box" id="emailAddress" placeholder="Enter Email Address" autocomplete="off">
                                    </div> 
                                </div>
                                <div>
                                    <p id="emailAddressErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="login-input-action-set" id="phone_mobileno">
                                        <div class="login-input-group phone">
                                            <p>Alternative Mobile Number</p>
                                            <input type="tel" class="login-input-box" id="alternative_mobile_no" name="phone" />
                                        </div>
                                    </div>
                                </div>
                                <p>(Optional)</p>
                                <div>
                                    <p id="alternative_mobile_noErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Alternative Email Address</p>
                                        <input type="email" class="input-box" id="alternativeEmailAddress" placeholder="Enter Alternative Email Address" autocomplete="off">
                                    </div>
                                </div>
                                <p>(Optional)</p>
                                <div>
                                    <p id="alternativeEmailAddressErr" style="color: red; font-size: 13px;"></p>  
                                </div>
                            </div>
                        </div>
                        <div class="underline-div"></div>
                        <div class="step-form-header">
                            <h3>Corporate Address</h3>
                            <p>Tell us where your business is located</p>
                        </div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Address</p>
                                        <input type="email" class="input-box" id="Address_Info" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div>
                                    <p id="Address_InfoErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p for="select_reason">Country</p>
                                        <select class="select-input" id="select_Country" onchange="country_relatedstate()"></select>
                                    </div>
                                </div>
                                <div>
                                    <p id="select_CountryErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p for="select_reason">State</p>
                                        <select class="select-input chzn-select" id="select_State" onchange="state_relatedcity()">
                                            <option value="">Select Your State</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <p id="select_StateErr" style="color: red; font-size: 13px;"></p> 
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p for="select_reason">City</p>
                                        <select class="select-input chzn-select" id="select_City">
                                            <option value="">Select Your City</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <p id="select_CityErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <p>Pincode</p>
                                        <input type="email" class="input-box" id="pincodedata" placeholder="Enter Pincode" autocomplete="off">
                                    </div>
                                </div>
                                <div>
                                    <p id="pincodedataErr" style="color: red; font-size: 13px;"></p>
                                </div>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#business_info" data-next="#service_location_Details" id="info_next">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        </a>
                    </div>
                </section>
                <section class="service-location-sec sec-tab" id="service_location_Details">
                    <div class="service-location-set">
                        <div class="header-title">
                            <h2>Service Locations</h2>
                        </div>
                        <div class="underline-div"></div>
                        <div class="service-input-group" id="ser_input_group">
                            <div class="ser-location-set">
                                <div class="step-form-header">
                                    <h3>Location 1</h3>
                                    <p>Choose the terminal where you provide the service and upload its necessary documents</p>
                                </div>
                                <div class="input-form-group">
                                    <div class="input-form-group-items">
                                        <div class="input-box-set">
                                            <p>Airport</p>
                                            <select class="select-input" id="AirportName1"></select>
                                        </div>
                                        <p id="AirportNameErr1" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="text-box-group">
                                    <div class="input-form-group-item">
                                        <div class="input-box-set">
                                            <p>Email Address</p>
                                            <input type="email" class="input-box" id="location_email_address1" placeholder="Enter Email Address" autocomplete="off">
                                        </div>
                                    </div>
                                    <div>
                                        <p id="location_email_addressErr1" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="upload-set">
                                    <div class="upload-items" id="divhiding51" >
                                        <label for="" class="upload-label" data-toggle="modal" onclick="multipleDocument(1)" data-target="#upload_document1">
                                            <input type="file" class="input-file" id="document_upload">
                                            <p><img src="asset/images/upload-sm-icon.svg" alt="upload icon" class="btn-icon">Upload documents</p>
                                        </label>
                                    </div>
                                    <div class="">
                                        <p id="add_document_label_name1" style="display: none;">Upload Documents</p>
                                        <div class="succes-icon-text" id="uploadedtext51" style="display: none;">
                                            <img src="asset/images/tick-icon.png" class="tick-icon">
                                            <p>Completed</p>
                                            <img src="asset/edit.png" onclick="Edit_document(`upload_document1`)">
                                        </div>
                                    </div>
                                    <div class="upload-items" id="divhiding61">
                                        <label for="" class="upload-label" data-toggle="modal" onclick="multipleBankDetail(1)" data-target="#upload_bank_account_document1">
                                            <input type="file" class="input-file" id="bank_account_document">
                                            <p><img src="asset/images/bank-sm-icon.svg" alt="upload icon" class="btn-icon">Add BankAccount</p>
                                        </label>
                                    </div>
                                    <div class="">
                                        <p id="add_bank_label_name1" style="display: none;">Add Bank Account</p>
                                        <div class="succes-icon-text" id="uploadedtext61" style="display: none;">
                                            <img src="asset/images/tick-icon.png" class="tick-icon">
                                            <p>Completed</p>
                                            <img src="asset/edit.png" onclick="Edit_bankaccount(`upload_bank_account_document1`)">
                                        </div>
                                    </div>
                                </div>
                                <div class="underline-div"></div>
                            </div>
                        </div>
                        <div class="upload-set cust-mt">
                            <div class="upload-items">
                                <label class="upload-label" id="add_new_location">
                                    <p>Add new location</p>
                                </label>
                            </div>
                        </div>
                        <div class="upload-set cust-mt" id="remove_location_btn"></div>
                        <a class="nex-arrow-set" data-current="#service_location_Details" data-next="#review" onclick="nextButton()">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        </a>
                    </div>
                </section>
                <section class="review-sec sec-tab" id="review">
                    <div class="review-set">
                        <div class="header-title">
                            <h2>Review</h2>
                        </div>
                        <div class="tab-wrapper">
                            <ul class="tabs">
                                <li class="tab-link active" data-tab="1">Business Info</li>
                                <li class="tab-link" data-tab="2">Service and Locations</li>
                            </ul>
                        </div>
                        <div class="content-wrapper">
                            <div id="tab-1" class="tab-content active">
                                <div class="business-info-set">
                                    <div class="company_logo-set">
                                        <img src="" id="get_companylogo" style="width:200px;" class="company-logo">
                                        <img src="" id="get_companyimage" style="width:200px;" class="company-image">
                                        <h2 id="get_companyname"></h2>
                                    </div>
                                    <div class="info-empty-card">
                                        <div class="info-empty-card-items">
                                            <p>Business Type</p>
                                            <h4 id="get_businesstype"></h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Business Website</p>
                                            <h4 id="get_businesswebsite"></h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Year Of Inception</p>
                                            <h4 id="get_yearofinception"></h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Business Email Address</p>
                                            <h4 id="get_businessaddress"></h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Business Mobile Number</p>
                                            <h4 id="get_businessmobile"></h4>
                                        </div>
                                    </div>
                                    <div class="primary_box">
                                        <h4 class="primary_text">Primary Contact Details</h4>
                                        <div class="info-empty-card">
                                            <div class="info-empty-card-items">
                                                <p>Contact Name</p>
                                                <h4 id="get_contactname"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Designation</p>
                                                <h4 id="get_designation"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Mobile Number</p>
                                                <h4 id="get_mobilenumber"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Email Address</p>
                                                <h4 id="get_emailaddress"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Altemative Mobile Number</p>
                                                <h4 id="get_alternativenumber"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Altemative Email Address</p>
                                                <h4 id="get_alternativeemail"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="primary_box">
                                        <h4 class="primary_text">Address</h4>
                                        <div class="info-empty-card
                                            remove-border">
                                            <div class="info-empty-card-items">
                                                <p>Address</p>
                                                <h4 id="get_address"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Country</p>
                                                <h4 id="get_country"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>State</p>
                                                <h4 id="get_state"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>City</p>
                                                <h4 id="get_city"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Pincode</p>
                                                <h4 id="get_pincode"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-content">
                                <div class="service-doc-set">
                                    <div id="totalarraydetails">
                                        <div class="step-form-header" id="airportarraydetails"></div>
                                        <div class="info-empty-card remove-border cust-margin" id="bankarraydetails"></div>
                                        <div class="document-view" id="documentarraydetails"></div>
                                        <div class="underline-div"></div> 
                                    </div>
                                </div>
                                <div class="form_btn text-center">
                                    <button class="submit_btn" onclick="go_to_dashboard()">Process</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <!-- Modal -->
    <div class="append_document_upload"></div>
    <div class="append_bank_details"></div>
      
    <script src='js/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src="js/intlTelInput.js"></script>
    <script src="js/intlTelInput.min.js"></script>
    <script src="js/s3upload.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/select.js"></script>
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="js/dropdowndata.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidemenu.js?v=<?php echo $cur_date_time; ?>"></script>
    <script>
    var airportdata='';
    var apiPath = "<?php echo $apiPath; ?>";
    $(function () {
        $('#yearOfInception').datetimepicker({
            ignoreReadonly: true,
            format: 'YYYY'
        });
    });
    
    var id = ["#business_mobile_number","#mobile_number","#alternative_mobile_no"];
    var dummyarray = [];
    id.forEach(function (value, i) {
        var iti = '';
        var mask = "";
        var phoneInputID = value;
        var input = document.querySelector(phoneInputID);
        iti = window.intlTelInput(input, {
            separateDialCode: false,
            utilsScript: "js/utils.js"
        });
        dummyarray.push(iti);
        $(phoneInputID).on("countrychange", function(event) {
            var selectedCountryData = iti.getSelectedCountryData();
            newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
            newPlaceholder = newPlaceholder.replace(/[()]/g, '');
            newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
            iti.setNumber("");
            
            $(this).val('');
            $(this).attr('placeholder',newPlaceholder);
            mask = newPlaceholder.replace(/[1-9]/g, "0");
            // Apply the new mask for the input
            $(this).mask(mask);
            var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
            check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
        });
        
        iti.promise.then(function() {
            $(phoneInputID).trigger("countrychange");
        });
    }); 

    // tab  js
    $('.tab-link').click(function() {
        var tabID = $(this).attr('data-tab');
        $(this).addClass('active').siblings().removeClass('active');
        $('#tab-' + tabID).addClass('active').siblings().removeClass('active');
    });

   // Create location
    var new_location_array = [1];
    var new_location_count = 1;
    
    
    $('#add_new_location').on('click',function(){
        new_location_count+=1;
        new_location_array.push(new_location_count);
        var addLocation = new_location_count;
        let location_design = '';
        location_design += `
                    <div class="ser-location-set" id="new_service_location`+addLocation+`">
                        <div class="step-form-header">
                            <h3>Location `+addLocation+`</h3>
                            <p>Choose the terminal where you provide the service and upload its necessary documents</p>
                        </div>
                        <div class="input-form-group">
                            <div class="input-form-group-items">
                                <div class="input-box-set">
                                    <p>Airport</p>
                                    <select class="select-input" id="AirportName`+addLocation+`"></select>
                                </div>
                            </div>
                            <p id="AirportNameErr`+addLocation+`" style="color: red; font-size: 13px;"></p>
                        </div>
                        <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <p>Email Address</p>
                                    <input type="email" class="input-box" id="location_email_address`+addLocation+`" placeholder="Enter Email Address" autocomplete="off">
                                </div>
                            </div>
                            <div>
                                <p id="location_email_addressErr`+addLocation+`" style="color: red; font-size: 13px;"></p>
                            </div>
                        </div>
                        <div class="upload-set">
                            <div class="upload-items" id="divhiding5`+addLocation+`" >
                                <label for="" class="upload-label" data-toggle="modal" onclick="multipleDocument(`+addLocation+`)" data-target="#upload_document`+addLocation+`">
                                    <input type="file" class="input-file" id="document_upload">
                                    <p><img src="asset/images/upload-sm-icon.svg" alt="upload icon" class="btn-icon"> Upload documents</p>
                                </label>
                            </div>
                            <div class="">
                                <p id="add_document_label_name`+addLocation+`" style="display: none;">Upload Documents</p>
                                <div class="succes-icon-text" id="uploadedtext5`+addLocation+`" style="display: none;">
                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                    <p>Completed</p>
                                    <img src="asset/edit.png" onclick="Edit_document('upload_document`+addLocation+`')">
                                </div>
                            </div>
                            <div class="upload-items" id="divhiding6`+addLocation+`" >
                                <label for="" class="upload-label" data-toggle="modal" onclick="multipleBankDetail(`+addLocation+`)" data-target="#upload_bank_account_document`+addLocation+`">
                                    <input type="file" class="input-file" id="bank_account_document">
                                    <p><img src="asset/images/bank-sm-icon.svg" alt="upload icon" class="btn-icon"> Add Bank Account</p>
                                </label>
                            </div>
                            <div class="">
                                <p id="add_bank_label_name`+addLocation+`" style="display: none;">Add Bank Account</p>
                                <div class="succes-icon-text" id="uploadedtext6`+addLocation+`" style="display: none;">
                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                    <p>Completed</p>
                                    <img src="asset/edit.png" onclick="Edit_bankaccount('upload_bank_account_document`+addLocation+`')">
                                </div>
                            </div>
                        </div>`;
                        location_design+=`  <div class="upload-items" id="remove_add_location">
                                                <label class="upload-label" id="remove_location">
                                                    <p onclick="removePreviousLocation('new_service_location`+addLocation+`',`+addLocation+`)">Remove location</p>
                                                </label>
                                            </div>`;
                        location_design+=`  <div class="underline-div"></div></div>`;
        $('#ser_input_group').append(location_design);
        newAirportDropDown(addLocation);
        new_location_array.forEach((id,index) => {
            let optionValue = $("#AirportName"+id).val();
            $(`#AirportName${addLocation} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
        });
    });

    function newAirportDropDown(id){
        $("#AirportName"+id).html(airportdata);
        $("#AirportName"+id).change(function() {
            //disable and enable airport on change
            new_location_array.forEach((idval,index) => {
                if(id != idval){
                    $(`#AirportName${idval} option`).prop('disabled', false).trigger("chosen:updated");
                    new_location_array.forEach((balanceid,index) => {
                        if(balanceid != id && balanceid != idval){
                            let otherSelectedValue = $("#AirportName"+balanceid).val();
                            $(`#AirportName${idval} option[value='${otherSelectedValue}']`).prop('disabled', true).trigger("chosen:updated");
                        }
                    });
                    let optionValue = $("#AirportName"+id).val();
                    $(`#AirportName${idval} option[value='${optionValue}']`).prop('disabled', true).trigger("chosen:updated");
                }
           
            });
        }).chosen({allow_single_deselect:true});({
            width: '100%', 
            filter: true
        });
    }

    function removePreviousLocation(id,key){
        let removedItemVal = $("#AirportName"+key).val();
        $("#"+id).remove();
        let idx1 = new_location_array.indexOf(key);   //Remove the key in the array
        if (idx1 != -1) new_location_array.splice(idx1, 1);

        //enable item selected in removed location in other locations
        new_location_array.forEach((otherlocationid,index) => {
            $(`#AirportName${otherlocationid} option[value='${removedItemVal}']`).prop('disabled', false).trigger("chosen:updated");
        });
    }

    function Edit_document(data1){
        $('#'+data1).modal('show');
    }

    function Edit_bankaccount(data1){
        $('#'+data1).modal('show');
    }
    
    $('#business_mobile_number').on('keypress', function(){
        reset();
    });
    $('#business_mobile_number').on('change', function(){
        reset();
    });
    function reset(){
        document.getElementById("business_mobile_numberErr").innerHTML = "";
    };

    $('#mobile_number').on('keypress', function(){
        reset();
    });
    $('#mobile_number').on('change', function(){
        reset();
    });
    function reset(){
        document.getElementById("mobile_numberErr").innerHTML = "";
    };
    $('#info_next').on('click',function(){
        var pass=0;
        if(document.getElementById("userImage").value == ""){
            document.getElementById("userImageErr").innerHTML = "* Please Upload Company Logo !";
        }else{
            document.getElementById("userImageErr").innerHTML = "";
            pass++;
        }if(document.getElementById("companyImage").value == ""){
            document.getElementById("companyImageErr").innerHTML = "* Please Upload Company Image !";
        }else{
            document.getElementById("companyImageErr").innerHTML = "";
            pass++;
        }if(document.getElementById("businessName").value.trim() == ""){
            document.getElementById("businessNameErr").innerHTML = "* Please Enter Business Name !";
        }else{
            document.getElementById("businessNameErr").innerHTML = "";
            pass++;
        }if(document.getElementById("businessType").value == ""){
            document.getElementById("businessTypeErr").innerHTML = "* Please Select Business Type !";
        }else{
            document.getElementById("businessTypeErr").innerHTML = "";
            pass++;
        }if(document.getElementById("businessWebsite").value.trim() == ""){
            document.getElementById("businessWebsiteErr").innerHTML = "* Please Enter Business Website !";
        }else{
            document.getElementById("businessWebsiteErr").innerHTML = "";
            pass++;
        }if(document.getElementById("yearOfInception").value == ""){
            document.getElementById("yearOfInceptionErr").innerHTML = "* Please Select Year Of Inception !";
        }else{
            document.getElementById("yearOfInceptionErr").innerHTML = "";
            pass++;
        }
        var email = document.getElementById("businessEmailAddress").value;
        mailformat1 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email==''){
            document.getElementById("businessEmailAddressErr").innerHTML = "* Please Enter Business Email Address !";
        }else if (email.match(mailformat1)) {
            document.getElementById("businessEmailAddressErr").innerHTML = "";
            pass++;
        }else{
            document.getElementById("businessEmailAddressErr").innerHTML = "* Enter Valid Mail-ID";
        }
        if(document.getElementById("business_mobile_number").value.trim() != ''){
            if (dummyarray[0].isValidNumber()) {
                document.getElementById("business_mobile_numberErr").innerHTML = "";
                pass++;
            }else{
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                var errorCode = dummyarray[0].getValidationError();
                document.getElementById("business_mobile_numberErr").innerHTML = errorMap[errorCode];
            }
        }else{
            document.getElementById("business_mobile_numberErr").innerHTML = "* Please Enter Business Mobile Number !";
        }
        if(document.getElementById("contactName").value.trim() == ""){
            document.getElementById("contactNameErr").innerHTML = "* Please Enter Contact Name !";
        }else{
            document.getElementById("contactNameErr").innerHTML = "";
            pass++;
        }if(document.getElementById("designation").value.trim() == ""){
            document.getElementById("designationErr").innerHTML = "* Please Enter Designation !";
        }else{
            document.getElementById("designationErr").innerHTML = "";
            pass++;
        }
        if(document.getElementById("mobile_number").value.trim() != ''){
            if (dummyarray[1].isValidNumber()) {
                document.getElementById("mobile_numberErr").innerHTML = "";
                pass++;
            }else{
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                var errorCode = dummyarray[1].getValidationError();
                document.getElementById("mobile_numberErr").innerHTML = errorMap[errorCode];
            }
        }else{
            document.getElementById("mobile_numberErr").innerHTML = "* Please Enter Mobile Number !";
        }
        var email1 = document.getElementById("emailAddress").value;
        mailformat12 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email1==''){
            document.getElementById("emailAddressErr").innerHTML = "* Please Enter Email Address !";
        }else if (email1.match(mailformat12)) {
            document.getElementById("emailAddressErr").innerHTML = "";
            pass++;
        }else{
            document.getElementById("emailAddressErr").innerHTML = "* Enter Valid Mail-ID";
        }
        if(document.getElementById("alternative_mobile_no").value==""){
            document.getElementById("alternative_mobile_noErr").innerHTML = "";
            pass++;
        }else if(document.getElementById("mobile_number").value == document.getElementById("alternative_mobile_no").value){
            document.getElementById("alternative_mobile_noErr").innerHTML = "* Mobile Number AND Alternative Mobile Number Must Not Be Same !";
        }else{
            if (dummyarray[2].isValidNumber()) {
                document.getElementById("alternative_mobile_noErr").innerHTML = "";
                pass++;
            }else{
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                var errorCode = dummyarray[2].getValidationError();
                document.getElementById("alternative_mobile_noErr").innerHTML = errorMap[errorCode];
            }
        }
        if(document.getElementById("alternativeEmailAddress").value == ""){
            document.getElementById("alternativeEmailAddressErr").innerHTML = "";
            pass++;
        }else if(document.getElementById("emailAddress").value == document.getElementById("alternativeEmailAddress").value){
            document.getElementById("alternativeEmailAddressErr").innerHTML = "* Email Address AND Alternative Email Address Must Not Be Same !";
        }else{
            var check = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(check.test(document.getElementById("alternativeEmailAddress").value)){
                document.getElementById("alternativeEmailAddressErr").innerHTML = '';
                pass++;
            }else{
                document.getElementById("alternativeEmailAddressErr").innerHTML = "* Please enter a valid email address!";
            }
        }
        if(document.getElementById("Address_Info").value.trim() == ""){
            document.getElementById("Address_InfoErr").innerHTML = "* Please Enter Address !";
        }else{
            document.getElementById("Address_InfoErr").innerHTML = "";
            pass++;
        }if(document.getElementById("select_Country").value == ""){
            document.getElementById("select_CountryErr").innerHTML = "* Please Select Country !";
        }else{
            document.getElementById("select_CountryErr").innerHTML = "";
            pass++;
        }if(document.getElementById("select_State").value == ""){
            document.getElementById("select_StateErr").innerHTML = "* Please Select State !";
        }else{
            document.getElementById("select_StateErr").innerHTML = "";
            pass++;
        }if(document.getElementById("select_City").value == ""){
            document.getElementById("select_CityErr").innerHTML = "* Please Select City !";
        }else{
            document.getElementById("select_CityErr").innerHTML = "";
            pass++;
        }if(document.getElementById("pincodedata").value.trim() == ""){
            document.getElementById("pincodedataErr").innerHTML = "* Please Enter Pincode !";
        }else{
            document.getElementById("pincodedataErr").innerHTML = "";
            pass++;
        }
        if(pass==19){
            var company_logo = $('#companylogourl').val();
            var company_image = $('#companyimageurl').val();
            var business_name = $('#businessName').val();
            var business_website = $('#businessWebsite').val();
            var year_of_inception = $('#yearOfInception').val();
            var business_email_address = $('#businessEmailAddress').val();
            var business_mobile_number = $('#business_mobile_number').val();
            var countryCode = $("#business_mobile_number").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
            countryCode = '+'+countryCode.replace(/[^0-9]/g,'');
            
            $("#get_companylogo").prop("src",company_logo);
            $("#get_companyimage").prop("src",company_image);
            $("#get_companyname").text(business_name);
            var selectedname = document.getElementById('businessType');
            var value = selectedname.options[selectedname.selectedIndex].text;
            $("#get_businesstype").html(value);
            $("#get_businesswebsite").text(business_website);
            $("#get_yearofinception").text(year_of_inception);
            $("#get_businessaddress").text(business_email_address);
            $("#get_businessmobile").text(countryCode+' '+business_mobile_number);
            
            
            var designation = $('#designation').val();
            var primary_mobilenumber = $('#mobile_number').val();
            var primarymobilecode = $("#mobile_number").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
            primarymobilecode = '+'+primarymobilecode.replace(/[^0-9]/g,'');
            var primary_emailaddress = $('#emailAddress').val();
            var alternative_mobilenumber = $('#alternative_mobile_no').val();
            var alternativemobilecode = $("#alternative_mobile_no").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
            alternativemobilecode = '+'+alternativemobilecode.replace(/[^0-9]/g,'');
            if(alternative_mobilenumber==''){
                $("#get_alternativenumber").text('');
            }else{
                $("#get_alternativenumber").text(alternativemobilecode+' '+alternative_mobilenumber);
            }
            var alternative_emailaddress = $('#alternativeEmailAddress').val();
            var primary_contactname = $('#contactName').val();
            var contactedperson = $('#contacted_person').val();
            $("#get_contactname").text(contactedperson+'.'+primary_contactname);
            $("#get_designation").text(designation);
            $("#get_mobilenumber").text(primarymobilecode+' '+primary_mobilenumber);
            $("#get_emailaddress").text(primary_emailaddress);
            $("#get_alternativeemail").text(alternative_emailaddress);
            
            var addressdetails = $('#Address_Info').val();
            var pincodedetails = $('#pincodedata').val();
        
            var selectedcountry = document.getElementById('select_Country');
            var countryvalue = selectedcountry.options[selectedcountry.selectedIndex].text;
            $("#get_country").html(countryvalue);
            
            var selectedstate = document.getElementById('select_State');
            var statevalue = selectedstate.options[selectedstate.selectedIndex].text;
            $("#get_state").html(statevalue);
            
            var selectedcity = document.getElementById('select_City');
            var cityvalue = selectedcity.options[selectedcity.selectedIndex].text;
            $("#get_city").html(cityvalue);
            
            $("#get_address").text(addressdetails);
            $("#get_pincode").text(pincodedetails);
            
            var servicenextpage = document.getElementById('service_sidemenu');
            servicenextpage.dataset.target = "true";
            
            $('#service_location_Details').show();
            $('#business_info').hide();
            $('#review').hide();
            $('#service_sidemenu').addClass('active');
            $('#business_sidemenu').removeClass('active');
            $('#business_sidemenu').addClass('completed');
        }
    });
    
    function bank_details(bankId) {
        var pass = 0;
        if (document.getElementById("account_number"+bankId).value.trim() == "") {
            document.getElementById("account_numberErr"+bankId).innerHTML = "*Enter Account Number !";
        }else{
            document.getElementById("account_numberErr"+bankId).innerHTML = "";
            pass++;
        }if (document.getElementById("reenter_account_number"+bankId).value == "") {
            document.getElementById("reenter_account_numberErr"+bankId).innerHTML = "*Enter Re-Enter Account Number !";
        }else{
            document.getElementById("reenter_account_numberErr"+bankId).innerHTML = "";
            pass++;
        }if (document.getElementById("ifsc_code"+bankId).value == "") {
            document.getElementById("ifsc_codeErr"+bankId).innerHTML = "*Enter IFSC Code !";
        }else{
            document.getElementById("ifsc_codeErr"+bankId).innerHTML = "";
            pass++;
        }
        if (pass == 3) {
            var accountnumber = $('#account_number'+bankId).val();
            var reenteraccountnumber = $('#reenter_account_number'+bankId).val();
            if(accountnumber==reenteraccountnumber){
                swal({
                title: "Done",
                text: "Details Added Successfully!..",
                type: "success",
                showSuccessButton: false,
                confirmButtonColor: "#26C177",
                confirmButtonText: "OK",
                closeOnConfirm: false,
                },
                function(){
                    swal.close();
                    $('#upload_bank_account_document'+bankId).modal('hide');
                    $('#uploadedtext6'+bankId).show();
                    $('#uploadedtext6'+bankId).attr('data-uploaded6'+bankId+'', 'true');
                    $('#divhiding6'+bankId).hide();
                    $('#add_bank_label_name'+bankId).show();
                });
            }else{
                swal("","Account Number and Re-Entered Account Number Does Not Match");
            }
        }
    }
    
    function isNumber(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) 
        {
            return false;
        }
        return true;
    }
    
    function upload_documents(idNo){
//        var pass=0;
//        if(document.getElementById("gstImage"+idNo).value.trim() == ""){
//            document.getElementById("gstImageErr"+idNo).innerHTML = "* Please Upload GST Certificate !";
//        }else{
//            document.getElementById("gstImageErr"+idNo).innerHTML = "";
//            pass++;
//        }if(document.getElementById("msmeImage"+idNo).value.trim() == ""){
//            document.getElementById("msmeImageErr"+idNo).innerHTML = "* Please Upload MSME Certificate !";
//        }else{
//            document.getElementById("msmeImageErr"+idNo).innerHTML = "";
//            pass++;
//        }if(document.getElementById("incorporationImage"+idNo).value.trim() == ""){
//            document.getElementById("incorporationImageErr"+idNo).innerHTML = "* Please Upload Incorporation Certificate !";
//        }else{
//            document.getElementById("incorporationImageErr"+idNo).innerHTML = "";
//            pass++;
//        }if(document.getElementById("chequeImage"+idNo).value.trim() == ""){
//            document.getElementById("chequeImageErr"+idNo).innerHTML = "* Please Upload Void Cheque !";
//        }else{
//            document.getElementById("chequeImageErr"+idNo).innerHTML = "";
//            pass++;
//        }if(document.getElementById("agreementImage"+idNo).value.trim() == ""){
//            document.getElementById("agreementImageErr"+idNo).innerHTML = "* Please Upload Contract Agreement !";
//        }else{
//            document.getElementById("agreementImageErr"+idNo).innerHTML = "";
//            pass++;
//        }
//        if (pass == 5) {
            swal({
                title: "Done",
                text: "Details Added Successfully!..",
                type: "success",
                showSuccessButton: false,
                confirmButtonColor: "#26C177",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            },
            function(){
                swal.close();
                $('#upload_document'+idNo).modal('hide');
                $('#uploadedtext5'+idNo).show();
                $('#uploadedtext5'+idNo).attr('data-uploaded5'+idNo+'', 'true');
                $('#divhiding5'+idNo).hide();
                $('#add_document_label_name'+idNo).show();
            });
//        }
    }
        
    function multipleDocument(doc){
    let newDocument;
         newDocument = `<div id="upload_document`+doc+`" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="document-body">
                                <div class="modal-header">
                                    <h2>Upload documents</h2>
                                     <img src="asset/images/close.svg" alt="close icon" class="close-icon" data-dismiss="modal">
                                </div>
                                <div class="modal-division"></div>
                                <div class="input-form-group">
                                    <div class="text-box-group">
                                        <div class="input-form-group-item">
                                            <div class="input-box-set">
                                                <label for="gst_number">Gst Number</label>
                                                <input type="text" class="input-box" id="gst_number`+doc+`" placeholder="Enter Gst Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box-group">
                                        <div class="input-form-group-item">
                                            <div class="input-box-set">
                                                <label for="pan_number">Pan Number</label>
                                                <input type="text" class="input-box" id="pan_number`+doc+`" placeholder="Enter Pan Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <div class="Upload-data-box-main-box">`;
                              if(doc == 1){
                                  newDocument += `<div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Pan Card /Tax License Number</h4>
                                            <p>Upload your Pan Card /Tax License Number for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                           <div class="pan_cont pan_cont1`+doc+`">
                                                <input id="panfile_url`+doc+`" type="hidden">
                                                <label for="panImage`+doc+`">Upload Pan Certificate</label>
                                                <input id="panValidId`+doc+`" type="hidden">
                                                <input id="panImage`+doc+`" type="file" onchange="imageUpload('panImage`+doc+`','panValidId`+doc+`','panfile_url`+doc+`','uploadedtext`+doc+`','pan_cont1`+doc+`','panImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="panImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext`+doc+`" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('panImage`+doc+`','uploadedtext`+doc+`','pan_cont1`+doc+`','panImageErr`+doc+`')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                                }
                                newDocument += `<div class="pan_uploaded_cont Upload_data_box">
                                    <div class="pan_car_box">
                                        <h4>GST/VAT</h4>
                                        <p>Upload Your GST Certificate For Verification</p>
                                    </div>
                                    <div class="texte-btton">
                                        <div class="pan_cont pan_cont2`+doc+`">
                                            <input id="gstfile_url`+doc+`" type="hidden">
                                            <label for="gstImage`+doc+`">Upload GST Certificate</label>
                                            <input id="gstValidId`+doc+`" type="hidden">
                                            <input id="gstImage`+doc+`" type="file" onchange="imageUpload('gstImage`+doc+`','gstValidId`+doc+`','gstfile_url`+doc+`','uploadedtext1`+doc+`','pan_cont2`+doc+`','gstImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                        </div>
                                        <p id="gstImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                        <div class="uploadedtext1`+doc+`" style="display:none;">
                                        <div class="succes-icon-text">
                                            <img src="asset/images/tick-icon.png" class="tick-icon">
                                            <p>Uploaded</p>
                                            <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('gstImage`+doc+`','uploadedtext1`+doc+`','pan_cont2`+doc+`','gstImageErr`+doc+`')">
                                        </div>
                                        </div>
                                    </div>
                                </div>`;
                                if(doc == 1){
                                    newDocument += `<div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>MSME Certificate</h4>
                                            <p>Upload your MSME Certificate For Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont3`+doc+`">
                                                <input id="msmefile_url`+doc+`" type="hidden">
                                                <label for="msmeImage`+doc+`">Upload MSME Certificate</label>
                                                <input id="msmeValidId`+doc+`" type="hidden">
                                                <input id="msmeImage`+doc+`" type="file" onchange="imageUpload('msmeImage`+doc+`','msmeValidId`+doc+`','msmefile_url`+doc+`','uploadedtext2`+doc+`','pan_cont3`+doc+`','msmeImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="msmeImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext2`+doc+`" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('msmeImage`+doc+`','uploadedtext2`+doc+`','pan_cont3`+doc+`','msmeImageErr`+doc+`')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Certificate of incorporation</h4>
                                            <p>Upload your certificate of incorporation for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont4`+doc+`">
                                                <input id="incorporationfile_url`+doc+`" type="hidden">
                                                <label for="incorporationImage`+doc+`">Upload certificate of incorporation</label>
                                                <input id="incorporationValidId`+doc+`" type="hidden">
                                                <input id="incorporationImage`+doc+`" type="file" onchange="imageUpload('incorporationImage`+doc+`','incorporationValidId`+doc+`','incorporationfile_url`+doc+`','uploadedtext3`+doc+`','pan_cont4`+doc+`','incorporationImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="incorporationImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext3`+doc+`" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('incorporationImage`+doc+`','uploadedtext3`+doc+`','pan_cont4`+doc+`','incorporationImageErr`+doc+`')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>`;
                                }

                                 newDocument += `<div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Void Cheque</h4>
                                            <p>Upload your bank account cancelled cheque for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont5`+doc+`">
                                                <input id="chequefile_url`+doc+`" type="hidden">
                                                <label for="chequeImage`+doc+`">Upload Void Cheque</label>
                                                <input id="chequeValidId`+doc+`" type="hidden">
                                                <input id="chequeImage`+doc+`" type="file" onchange="imageUpload('chequeImage`+doc+`','chequeValidId`+doc+`','chequefile_url`+doc+`','uploadedtext4`+doc+`','pan_cont5`+doc+`','chequeImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="chequeImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext4`+doc+`" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('chequeImage`+doc+`','uploadedtext4`+doc+`','pan_cont5`+doc+`','chequeImageErr`+doc+`')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Contract Agreement</h4>
                                            <p>Upload your signed contract agreement for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont6`+doc+`">
                                                <input id="agreementfile_url`+doc+`" type="hidden">
                                                <label for="agreementImage`+doc+`">Upload Contract Agreement</label>
                                                <input id="agreementValidId`+doc+`" type="hidden">
                                                <input id="agreementImage`+doc+`" type="file" onchange="imageUpload('agreementImage`+doc+`','agreementValidId`+doc+`','agreementfile_url`+doc+`','uploadedtext7`+doc+`','pan_cont6`+doc+`','agreementImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="agreementImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext7`+doc+`" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('agreementImage`+doc+`','uploadedtext7`+doc+`','pan_cont6`+doc+`','agreementImageErr`+doc+`')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Other Document 1</h4>
                                            <p>Upload your other document for Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont7`+doc+`">
                                                <input id="otherDocument1file_url`+doc+`" type="hidden">
                                                <label for="otherDocument1Image`+doc+`">Upload</label>
                                                <input id="otherDocument1ValidId`+doc+`" type="hidden">
                                                <input id="otherDocument1Image`+doc+`" type="file" onchange="imageUpload('otherDocument1Image`+doc+`','otherDocument1ValidId`+doc+`','otherDocument1file_url`+doc+`','uploadedtext8`+doc+`','pan_cont7`+doc+`','otherDocument1ImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="otherDocument1ImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext8`+doc+`" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon"  style="margin-left: 10px;width:15px;" onclick="clear_modalValue('otherDocument1Image`+doc+`','uploadedtext8`+doc+`','pan_cont7`+doc+`','otherDocument1ImageErr`+doc+`')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Other Document 2</h4>
                                            <p>Upload your other document for Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont8`+doc+`">
                                                <input id="otherDocument2file_url`+doc+`" type="hidden">
                                                <label for="otherDocument2Image`+doc+`">Upload</label>
                                                <input id="otherDocument2ValidId`+doc+`" type="hidden">
                                                <input id="otherDocument2Image`+doc+`" type="file" onchange="imageUpload('otherDocument2Image`+doc+`','otherDocument2ValidId`+doc+`','otherDocument2file_url`+doc+`','uploadedtext9`+doc+`','pan_cont8`+doc+`','otherDocument2ImageErr`+doc+`');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="otherDocument1ImageErr`+doc+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext9`+doc+`" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('otherDocument2Image`+doc+`','uploadedtext9`+doc+`','pan_cont8`+doc+`','otherDocument2ImageErr`+doc+`')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_btn text-center">
                                        <button class="submit_btn" onclick="upload_documents(`+doc+`)">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`; 
        $(".append_document_upload").append(newDocument);
    }
    
    function clear_modalValue(data1,data2,data3,data4){
        $('#'+data1).val('');
        $('.'+data2).hide();
        $('.'+data3).show();
        $('#'+data4).text('');
    }
            
    function multipleBankDetail(bank){
     let bankDetail;
     bankDetail = `<div id="upload_bank_account_document`+bank+`" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" data-dismiss="modal">
                            <div class="modal-body">
                                <div class="document-body">
                                    <div class="modal-header">
                                        <h2>Add Bank Account</h2>
                                    </div>
                                    <div class="input-form-group full-width">
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <div class="text-box-group"></div>
                                                    <div class="input-form-group-item">
                                                        <div class="input-box-set">
                                                            <p>Account number</p>
                                                            <input type="text" class="input-box" id="account_number`+bank+`" onkeypress="return isNumber(event)" placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                <p class="error-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                                </div>
                                            <div><p id="account_numberErr`+bank+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;""></p></div>
                                        </div>
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <div class="input-form-group-item">
                                                    <div class="input-box-set">
                                                        <p>Re-Enter Account Number</p>
                                                        <input type="text" class="input-box" id="reenter_account_number`+bank+`" onkeypress="return isNumber(event)" placeholder="Enter Re-Enter Account Number">
                                                    </div>
                                                </div>
                                                <p class="error-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                            </div>
                                            <div><p id="reenter_account_numberErr`+bank+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p></div>
                                        </div>
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <input id="ifsc_code`+bank+`" type="hidden">
                                                <div class="input-form-group-item">
                                                    <div id="container`+bank+`" class="">
                                                        <p>Enter the IFSC code:</p>
                                                        <input class="uppercase" placeholder="Enter IFSC Code" maxlength="11">
                                                        <a id="btn`+bank+`" onclick="getDetailsClick(`+bank+`)" class="">Get Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div><p id="ifsc_codeErr`+bank+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p></div>
                                        </div>
                                        <div class="input-form-group-required-item divhide`+bank+`" style="display:none;">
                                            <div class="input-form-group-item disabled">
                                                <div class="input-box-set">
                                                    <p>Branch</p>
                                                    <input type="text" class="input-box" id="branch_name`+bank+`" placeholder="Branch Name" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-form-group-required-item divhide`+bank+`" style="display:none;">
                                            <div class="input-form-group-item disabled">
                                                <div class="input-box-set">
                                                    <p>City</p>
                                                    <input type="text" class="input-box" id="cityname`+bank+`" placeholder="City Name" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_btn text-center">
                                        <button class="submit_btn" onclick="bank_details(`+bank+`)">Add Bank</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        $(".append_bank_details").append(bankDetail);
    }
        
    function goBack(id){
        var containerContent = `<p>Enter the IFSC code:</p>
                                <input class="uppercase" placeholder="Enter IFSC Code" maxlength="11">
                                <a id="btn`+id+`" onclick="getDetailsClick(`+id+`)" class="">Get Details</a>`;
        $('#ifsc_code'+id).val('');
        $('#container'+id).html(containerContent);
        $(".divhide"+id).hide();
    }
        
    function getDetailsClick(id){
        var ifscCode = $('#container'+id+' > input').val();
        if(ifscCode == ''){
            $("#ifsc_codeErr"+id).text("Please Enter IFSC Code");
        }else{
            var ifsc = String($('#container'+id+' > input').val());
            $.getJSON('https://ifsc.razorpay.com/'+ifsc, function(data){
                $("#ifsc_codeErr"+id).text("");
                $("#cityname"+id).val(data.CITY);
                $("#branch_name"+id).val(data.BRANCH);
                $("#ifsc_code"+id).val(data.IFSC);
                $(".divhide"+id).show();
                $("#container"+id).html('<a id="backBtn'+id+'" class="waves-effect waves-light btn light-green darken-2" onclick="goBack('+id+')">Go Back</a>'); 
            }).fail(function(){
                var msg = '<div id="errMsg">Invalid IFSC code</div>';
                $('#container'+id).html('');
                $("#container"+id).html('<a id="backBtn'+id+'" class="waves-effect waves-light btn light-green darken-2" onclick="goBack('+id+')">Go Back</a>');
                $('#container'+id).append(msg);
                $("#ifsc_codeErr"+id).text('');
                $("#cityname"+id).val('');
                $("#branch_name"+id).val('');
                $("#ifsc_code"+id).val('');
            });
        }
    }
    
    function clearbankdetails(id){
        var accountdata = $('#account_number'+id).val();
        var reaccountdata = $('#reenter_account_number'+id).val();
        var ifsccodedata = $('#ifsc_code'+id).val();
        
        $('#account_numberErr'+id).text('');
        $('#reenter_account_numberErr'+id).text('');
        $('#ifsc_codeErr'+id).text('');
        
        if(accountdata=='' && reaccountdata=='' && ifsccodedata=='')
        {
            $(".modal").hide(); 
        }else{
            swal({
                title: "Are you sure?",
                text: "The information you given will be deleted and you can't recover it.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function(){
                $("#account_number"+id).val('');
                $("#reenter_account_number"+id).val('');
                $("#ifsc_code"+id).val('');
                $(".divhide"+id).hide();
                var containerContent1 = `<p>Enter the IFSC code:</p>
                                <input class="uppercase" placeholder="Enter IFSC Code" maxlength="11">
                                <a id="btn`+id+`" onclick="getDetailsClick(`+id+`)" class="">Get Details</a>`;
                $("#container"+id).html(containerContent1); 
                $('#account_numberErr'+id).text('');
                $('#reenter_account_numberErr'+id).text('');
                $('#ifsc_codeErr'+id).text('');
                swal("Deleted!", "Information has been deleted.", "success");
            });
        }
    }
    
    var location_array = [];    
    function nextButton(){
        var bankDetail_array = [];
        var count = 0;
        var validForReview;
        new_location_array.forEach((i,index) =>{
            var email11234 = document.getElementById("location_email_address"+i).value;
            mailformat12345 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#uploadedtext6'+i).attr('data-uploaded6'+i) == "true" && $("#AirportName"+i).val() != '' && email11234.match(mailformat12345)){
                if(count==index){
                    validForReview = true;
                    var airportName=$("#AirportName"+i).val();
                    var selectedairport = document.getElementById('AirportName'+i);
                    var airportvalue = selectedairport.options[selectedairport.selectedIndex].text;
                    
                    var datas = {
                        airportToken:$("#AirportName"+i).val(),
                        locationemailaddress:$("#location_email_address"+i).val(),
                        airportNametext:airportvalue,
                        pan_certificate:$('#panfile_url'+i).val() === undefined?'':$('#panfile_url'+i).val(),
                        gst_certificate:$('#gstfile_url'+i).val() === undefined?'':$('#gstfile_url'+i).val(),
                        msme_certificate:$('#msmefile_url'+i).val() === undefined?'':$('#msmefile_url'+i).val(),
                        certificate_incorporation:$('#incorporationfile_url'+i).val() === undefined?'':$('#incorporationfile_url'+i).val(),
                        void_cheque:$('#chequefile_url'+i).val() === undefined?'':$('#chequefile_url'+i).val(),
                        certificate_agreement:$('#agreementfile_url'+i).val() === undefined?'':$('#agreementfile_url'+i).val(),
                        account_number:$('#account_number'+i).val(),
                        ifsc_code:$('#ifsc_code'+i).val(),
                        branch_name:$('#branch_name'+i).val(),
                        cityname:$('#cityname'+i).val(),
                        gst_number:$('#gst_number'+i).val() === undefined?'':$('#gst_number'+i).val(),
                        pan_number:$('#pan_number'+i).val() === undefined?'':$('#pan_number'+i).val(),
                        other_document1:$('#otherDocument1file_url'+i).val() === undefined?'':$('#otherDocument1file_url'+i).val(),
                        other_document2:$('#otherDocument2file_url'+i).val() === undefined?'':$('#otherDocument2file_url'+i).val()
                    }
                    location_array.push(datas);
                    var getText = '';
                    for (var key in location_array) {
                        getText += `<div class="step-form-header" id="airportarraydetails_${key}">
                                        <div><h3>${location_array[key].airportNametext}</h3></div>
                                        <div><h3>${location_array[key].locationemailaddress}</h3></div>
                                    </div>
                                    <div class="underline-div"></div>
                                    <div class="info-empty-card remove-border cust-margin" id="bankarraydetails_${key}">
                                        <div class="info-empty-card-items">
                                            <p>Account Number</p>
                                            <h4>${location_array[key].account_number}</h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>IFSC Code</p>
                                            <h4>${location_array[key].ifsc_code}</h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Branch</p>
                                            <h4>${location_array[key].branch_name}</h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>City</p>
                                            <h4>${location_array[key].cityname}</h4>
                                        </div>
                                    </div>
                                    <div class="info-empty-card">
                                        <div class="info-empty-card-items">
                                            <p>Gst Nummber</p>
                                            <h4>${location_array[key].gst_number}</h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Pan Number</p>
                                            <h4>${location_array[key].pan_number}</h4>
                                        </div>
                                    </div>
                                    <div class="document-view" id="documentarraydetails_${key}">`;
                                        if(location_array[key].pan_certificate != ''){
                                          getText += `<div class="document-items">`;
                                                var panURL = location_array[key].pan_certificate;
                                                var panextension = panURL.split(".").pop();
                                                if(panextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].pan_certificate}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].pan_certificate}" style="width:200px;">`;
                                                }
                                                    getText+=`<p class="file-name">Pan Card /Tax License Number</p>
                                            </div>`;
                                        }
                                        if(location_array[key].gst_certificate != ''){
                                          getText += `<div class="document-items">`;
                                                var gstURL = location_array[key].gst_certificate;
                                                var gstextension = gstURL.split(".").pop();
                                                if(gstextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].gst_certificate}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].gst_certificate}" style="width:200px;">`;
                                                }
                                                    getText+=`<p class="file-name">GST/VAT</p>
                                            </div>`;
                                        }
                                        if(location_array[key].msme_certificate != ''){
                                          getText += `<div class="document-items">`;
                                                var MsmeURL = location_array[key].msme_certificate;
                                                var Msmeextension = MsmeURL.split(".").pop();
                                                if(Msmeextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].msme_certificate}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].msme_certificate}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">MSME Certificate</p>
                                            </div>`;
                                        }
                                        if(location_array[key].certificate_incorporation != ''){
                                           getText += `<div class="document-items">`;
                                                var CorporationURL = location_array[key].certificate_incorporation;
                                                var Corporationextension = CorporationURL.split(".").pop();
                                                if(Corporationextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].certificate_incorporation}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].certificate_incorporation}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">Certificate of Incorporation</p>
                                            </div>`;
                                        }
                                        if(location_array[key].void_cheque != ''){
                                           getText += `<div class="document-items">`;
                                                var ChequeURL = location_array[key].void_cheque;
                                                var Chequeextension = ChequeURL.split(".").pop();
                                                if(Chequeextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].void_cheque}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].void_cheque}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">Void Cheque</p>
                                            </div>`;
                                        }
                                        if(location_array[key].certificate_agreement != ''){
                                           getText += `<div class="document-items">`;
                                                var AgreementURL = location_array[key].certificate_agreement;
                                                var Agreementextension = AgreementURL.split(".").pop();
                                                if(Agreementextension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].certificate_agreement}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].certificate_agreement}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">Contract Agreement</p>
                                            </div>`;
                                        }
                                        if(location_array[key].other_document1 != ''){
                                           getText += `<div class="document-items">`;
                                                var otherDocument1URL = location_array[key].other_document1;
                                                var otherDocument1Extension = otherDocument1URL.split(".").pop();
                                                if(otherDocument1Extension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].other_document1}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].other_document1}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">Other Documents</p>
                                            </div>`;
                                        }
                                        if(location_array[key].other_document2 != ''){
                                           getText += `<div class="document-items">`;
                                                var otherDocument2URL = location_array[key].other_document2;
                                                var otherDocument2Extension = otherDocument2URL.split(".").pop();
                                                if(otherDocument2Extension == 'pdf'){
                                                    getText+=`<iframe src="${location_array[key].other_document2}" width="100%" height="150px"></iframe>`;
                                                }else{
                                                    getText+=`<img src="${location_array[key].other_document2}" style="width:200px;">`;
                                                }
                                                getText+=`<p class="file-name">Other Documents</p>
                                            </div>`;
                                        }
                                    getText += `</div>`;
                    }
                    $("#totalarraydetails").html(getText);
                    $("#AirportNameErr"+i).text("");
                    $("#location_email_addressErr"+i).text("");
                    count++;
                }else if(count!=i){
                   location_array = [];   
                }
            }else{
                validForReview = false;
                location_array = [];
                if($("#AirportName"+i).val() == ''){
                    swal("Location"+i+"- Please Select Airport Name");
                }
//                else if($('#uploadedtext5'+i).attr('data-uploaded5'+i) != "true"){
//                    swal("Location"+i+"- Please upload all Documents");
//                }
                else if($('#uploadedtext6'+i).attr('data-uploaded6'+i) != "true"){
                    swal("Location"+i+"- Please Fill Bank details");
                }else if($("#location_email_address"+i).val() == ''){
                    swal("Location"+i+"- Please Enter Email Address");
                }else if($("#location_email_address"+i).val() != ''){
                    var email1123 = document.getElementById("location_email_address"+i).value;
                    mailformat1234 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (email1123.match(mailformat1234)) {
                    }else{
                        swal("Email"+i+"- Enter Valid Mail-ID");
                    }
                }
            }
        });
        if(validForReview == true){
            $('#review').show();
            $('#service_location_Details').hide();
            $('#business_info').hide();
            $('#review_sidemenu').addClass('active');
            $('#service_sidemenu').addClass('completed');
            $('#service_sidemenu').removeClass('active');
            $('#business_sidemenu').removeClass('active');
        }
    }
    
    function go_to_dashboard(){
        var service_provider_token = "<?php echo $_COOKIE['service_token'];?>";
        var company_logo = $('#companylogourl').val();
        var company_image = $('#companyimageurl').val();
        var business_name = $('#businessName').val();
        var business_typeid = $('#businessType').val();
        var business_website = $('#businessWebsite').val();
        var year_of_inception = $('#yearOfInception').val();
        var business_email_address = $('#businessEmailAddress').val();
        var business_mobile_number = $('#business_mobile_number').val();
        var countryCode = $("#business_mobile_number").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
        countryCode = '+'+countryCode.replace(/[^0-9]/g,'');
        
        var primary_contactname = $('#contactName').val();
        var contactedperson = $('#contacted_person').val();
        var designation = $('#designation').val();
        var primary_mobilenumber = $('#mobile_number').val();
        var primarymobilecode = $("#mobile_number").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
        primarymobilecode = '+'+primarymobilecode.replace(/[^0-9]/g,'');
        var primary_emailaddress = $('#emailAddress').val();
        var alternative_mobilenumber = $('#alternative_mobile_no').val();
        if($('#alternative_mobile_no').val()==""){
            var alternativemobilecode = "";
        }else{
            var alternativemobilecode = $("#alternative_mobile_no").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
            alternativemobilecode = '+'+alternativemobilecode.replace(/[^0-9]/g,'');
        }
        var alternative_emailaddress = $('#alternativeEmailAddress').val();
        var addressdetails = $('#Address_Info').val();
        var countryid = $('#select_Country').val();
        var stateid = $('#select_State').val();
        var cityid = $('#select_City').val();
        var pincodedetails = $('#pincodedata').val();
        
        // var servicenextpage = document.getElementById('service_sidemenu');
        // servicenextpage.dataset.target = "false";
        
        var datas = {
            'service_provider_token':service_provider_token,
            'company_logo':company_logo,
            'company_image':company_image,
            'business_name':business_name,
            'business_typeid':business_typeid,
            'business_website':business_website,
            'year_of_inception':year_of_inception,
            'business_email_address':business_email_address,
            'business_mobile_number':business_mobile_number,
            'countryCode':countryCode,
            'primary_contactname':primary_contactname,
            'contactedperson':contactedperson,
            'designation':designation,
            'primary_mobilenumber':primary_mobilenumber,
            'primarymobilecode':primarymobilecode,
            'primary_emailaddress':primary_emailaddress,
            'alternative_mobilenumber':alternative_mobilenumber,
            'alternativemobilecode':alternativemobilecode,
            'alternative_emailaddress':alternative_emailaddress,
            'addressdetails':addressdetails,
            'countryid':countryid,
            'stateid':stateid,
            'cityid':cityid,
            'pincodedetails':pincodedetails,
            'service_provider_array':location_array
        };
        var json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/service-provider/addBusinessInfo.php",
            data: json1
        }).done(function(data1){
            if(data1.status_code == 200){
                window.location = "create-new-service";
            }else{
                swal(data1.message);
            }
        });
    }
    </script>
    </body>
</html>
<?php
}
?>