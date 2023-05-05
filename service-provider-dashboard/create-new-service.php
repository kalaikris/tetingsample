<?php
    session_start();
    include '../config/core.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Service</title>
    <link rel="shortcut icon" href="asset/images/fav-icon.png">
    <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/onbord-css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/onbord-css/index.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/onbord-css/login.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/commen.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <link href="css/sweet_alert.min.css" rel="stylesheet">
    <style>
        .uppercase {
            text-transform: uppercase;
        }
    </style>
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
            <section class="added-business-sec">
                <div class="business-set">
                    <h4><span id="total_service_business"></span> Business Added</h4>
                    <div class="business-card-set">
                        <div class="button-set" id="business_card"></div>
<!--                        <a href="index.php"><button class="cust-border-btn">Add new business</button></a>-->
                        <button class="cust-border-btn" onclick="redirectpage()">Add new business</button>
                    </div>
                    <div class="form_btn text-center">
                        <button class="submit_btns" onclick="changestatus()">Submit</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="mani index-content hidden">
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src="js/intlTelInput.js"></script>
    <script src="js/intlTelInput.min.js"></script>
    <script src="js/s3upload.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="js/dropdowndata.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidemenu.js?v=<?php echo $cur_date_time; ?>"></script>
     <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    var apiPath = "<?php echo $apiPath; ?>";
    var serviceproviderstatusarray = [];
    let firstCompanyToken;
    $(document).ready(function(){
        var service_provider_token = "<?php echo $_COOKIE['service_token'];?>";
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        var datas = {
            'service_token': service_provider_token,
            'userToken':staff_token
        }
        var jsondata = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/service-provider/businessList.php",
            data: jsondata,
            success: function(data) {
                var html_text = '';
                var companyarray = data.company_list;
                $('#total_service_business').text(companyarray.length);
                firstCompanyToken = companyarray[0].service_provider_companytoken;
                
                for (var key in companyarray)
                {
                    var uniqueservicetoken = companyarray[key].service_provider_companytoken;
                    var uniqueservicestatus = companyarray[key].service_provider_companystatus;
                    var datas = {
                        servicecompanytoken:uniqueservicetoken,
                        servicecompanystatus:uniqueservicestatus
                    }
                    serviceproviderstatusarray.push(datas);
                    
                    html_text += `<ul class="business-card-item">
                    <li>
                        <div class="service-prov-logo-set">
                            <img src="${companyarray[key].company_logo}" alt="" class="serv-prov-logo">
                            <div class="serv-prov-name-ser-option">
                                <h3>${companyarray[key].company_name}</h3>
                                <p>${companyarray[key].business_type}</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="ser-desc-set">
                            <h2>Business Website</h2>
                            <p>${companyarray[key].website_name}</p>
                        </div>
                    </li>
                    <li>
                        <div class="ser-desc-set">
                            <h2>Service Locations</h2>
                            <p>${companyarray[key].total_service_location}</p>
                        </div>
                    </li>
                    <li>
                    <div class="action-set"> 
                        ${uniqueservicestatus == '1' ? `<div class="review-widget under-review"><img src="asset/images/pending-icon.svg" alt="icon" class="status-sm-icon"><p>Under Review</p></div>` : uniqueservicestatus=='2' ? `<div class="review-widget under-completed"><img src="asset/images/verified-tick.svg" alt="icon" class="status-sm-icon"><p>Approved</p></div>` : uniqueservicestatus=='3' ? `<div class="review-widget rejected"><img src="asset/img/rej.png" alt="icon" class="status-sm-icon"><p>Rejected</p></div>` : `<div><img style="cursor: pointer;" onclick="deletebusiness('${companyarray[key].service_provider_companytoken}')" src="asset/delete.png"></div>`}
                    </div>
                    </li>
                    </ul>`
                }
                $("#business_card").html(html_text);
            }
        });    
    });

    function refreshPage(){
        window.location = window.location.href;
    }
    setInterval('refreshPage()', 100000);///1minute

    function redirectpage(){
        if(firstCompanyToken == null || firstCompanyToken == '' || firstCompanyToken == undefined){
            window.location = "index";
        }else{
            // clearInterval(refreshtimer);
            // $('.main-content').addClass('hidden');
            // $('.index-content').removeClass('hidden');

            // appendfirstcompanyDetails(firstCompanyToken);
            let form = `<form id="tokenform" method="post" action="new-service.php">
                            <input hidden type="text" value=${firstCompanyToken} name="firstCompanyToken">
                        </form>`
                $('body').append(form);
                $('#tokenform').submit();
        }
        
    }
    
    function deletebusiness(str)
    {
        var serviceproviderid=str;
        swal({
            title: "Are you sure?",
            text: "You want to block this Company?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var datas = {'service_provider_companytoken':serviceproviderid}
                var jsondata = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/service-provider/deleteService.php",
                    data: jsondata,
                }).done(function (data) {
                    if(data.status_code==200){
                        swal({
                          title: "Success!",
                          text: data.message,
                          icon: "success",
                          button: "Ok",
                        }).then((value) => {
                            location.reload();
                        });
                    }else{
                        swal({
                          title: "Error!",
                          text: data.message,
                          icon: "error",
                          button: "Ok",
                        });
                    }
                });
            }
        });
    }
    
    function changestatus(){
        var finalcompanystatusarray = [];
        var approvedstatusarray = [];
        var reviewstatusarray = [];
        for (var key_1 in serviceproviderstatusarray){
            var unique_companytoken = serviceproviderstatusarray[key_1].servicecompanytoken;
            var company_status = serviceproviderstatusarray[key_1].servicecompanystatus;
            if(company_status==0){
                var datas = {
                    uniquecompanytoken:unique_companytoken,
                    uniquecompanystatus:company_status
                }
                finalcompanystatusarray.push(datas);
            }else if(company_status==2){
                var datas = {
                    uniquecompanytoken:unique_companytoken,
                    uniquecompanystatus:company_status
                }
                approvedstatusarray.push(datas);
            }else if(company_status==1){
                var datas = {
                    uniquecompanytoken:unique_companytoken,
                    uniquecompanystatus:company_status    
                }
                reviewstatusarray.push(datas);
            }
        }
        var totalservicecompany = serviceproviderstatusarray.length;
        var totalapprovedcompany = approvedstatusarray.length;
        var underreviewarray = reviewstatusarray.length;
        var editdeletestatus = finalcompanystatusarray.length;
        
        if(editdeletestatus!=0){
            var datas1 = {finalcompanystatusarray:finalcompanystatusarray}
            var jsondata = JSON.stringify(datas1);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/service-provider/updateCompanyStatus.php",
                data: jsondata
            }).done(function(data1) {
                if(data1.status_code == 200){
                    swal({
                        title: "Success!",
                        text: data1.message,
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        location.reload();
                    });
                }else{
                    swal({
                        title: "Error!",
                        text: data1.message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            });
        }else if(editdeletestatus=='0' && totalapprovedcompany>0){
            window.location = 'service-policy';
        }else{
            var datas1 = {finalcompanystatusarray:finalcompanystatusarray}
            var jsondata = JSON.stringify(datas1);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/service-provider/updateCompanyStatus.php",
                data: jsondata
            }).done(function(data1) {
                if(data1.status_code == 200){
                    swal({
                        title: "Success!",
                        text: data1.message,
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        location.reload();
                    });
                }else{
                    swal({
                        title: "Error!",
                        text: data1.message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            });
        }
    }
    </script>
</body>
</html>
<?php
}
?>