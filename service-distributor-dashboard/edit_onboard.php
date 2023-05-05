<?php
include_once '../config/core.php';
include '../security/secure.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Distributor onboarding</title>
    <link rel="shortcut icon" href="./asset/img/airportzo-icon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/onbord-css/common.css">
    <link rel="stylesheet" href="css/onbord-css/personal_info.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/onbord-css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href='css/onbord-css/bootstrap-datetimepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <!-- <link href="css/intlTelInput.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="css/personal_info.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->
</head>
<style type="text/css">

    .validation-text{
        visibility: hidden;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance:textfield;
    }

    .check-box-cont
        {
            display:flex ;
            justify-content: center;
            align-items: center;
            padding-left: 0px;
        }
    .check-box-cont img
    {
      width: 30px;
        height: 49px;
        object-fit: contain;
        padding-right: 10px;
    }
</style>

<body>
    <section>
        <div class="mani">
            <div class="side_menu">
                <div class="side_menu_inner_set">
                    <div class="main_content">
                        <div class="arirportzo_logo">
                            <img src="asset/images/logo.png" class="logo-icon">
                            <!-- <h2>airportZo</h2> -->
                        </div>
                        <div class="sub_text">
                            <p>Welcome</p>
                            <h1> We are happy and honored to onboard you as our service Distributor!</h1>
                        </div>
                    </div>
                    <ul class="sidebar_status">
                        <li class="side-menu-tab active" id="business_info_value" toggle-target="business_info">Business Info <span class="completed_tick"></span><span class="active_pointer"></span></li> <!-- completed, active -->
                        <li class="side-menu-tab" id="bank_detail_value" toggle-target="bank_detail">Bank Details <span class="completed_tick"></span><span class="active_pointer"></span></li>
                        <li class="side-menu-tab" id="service_location_Details_value" toggle-target="service_location_Details">Service and Locations <span class="completed_tick"></span><span class="active_pointer"></span></li>
                        <li class="side-menu-tab" id="doument_detail_value" toggle-target="doument_detail">Documents <span class="completed_tick"></span><span class="active_pointer"></span></li>
                        <li class="side-menu-tab" id="review_value" toggle-target="review">Review <span class="completed_tick"></span><span class="active_pointer"></span></li>
                    </ul>
                    <div class="onboard-logout" id="logout" hidden>
                       <p><img src="asset/svg/logout-white.svg" alt="logout icon">Logout</p>
                    </div>
                </div>
            </div>
            <div class="mani_menu">
                <section class="sec-tab business-sec active" id="business_info">
                    <div class="business-section-set">
                        <div class="header-title">
                            <h2>Business info</h2>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" class="input-box" id="business_name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="validation-text" id="business_name_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</span>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <!-- bg-arrow -->
                                    <div class="input-box-set">
                                        <label for="select_reason">Business Type</label>
                                        <select class="select-input" id="select_reason_business">
                                            <!--  <option value="0">-select option-</option>
                                        <option value="1">-</option>
                                        <option value="2">-</option>
                                        <option value="3">-</option> -->
                                        </select>
                                    </div>
                                    <!-- <div class="validation" id="select_reason_business_validate"></div> -->
                                </div>
                                <div class="validation-text" id="select_reason_business_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter Business Type</span>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <label for="business_website">Business Website</label>
                                        <input type="text" class="input-box" id="business_website_info" placeholder="Enter Website">
                                        
                                    </div>
                                </div>
                                <div class="validation-text" id="business_website_info_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter valid website</span>
                                </div>
                            </div>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="step-form-header">
                            <h3>Primary Contact Details</h3>
                            <p>Help us reach you and keep you posted</p>
                        </div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="login-input-action-set" id="phone_mobileno">
                                    <div class="login-input-group phone">
                                        <label for="mobile_no">Mobile Number</label>
                                        <input type="tel"  class="login-input-box num_mobiles" id="mobile_no" name="phone" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="input-form-group-item">
                                <div class="login-input-action-set" id="phone_mobileno">
                                    <div class="login-input-group phone">
                                        <label for="mobile_no">Mobile Number</label>
                                        <input type="" onKeyPress="if(this.value.length==15) return false;" class="login-input-box" id="mobile_no" name="phone" />
                                    </div>
                                </div>
                            </div> -->
                             <div class="validation-text" id="mobile_no_validate">
                                    <span><img src="asset/images/required-icon.png" class="required-icon">Enter valid mobile number</span>
                                </div>
                            </div>


                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="primary_email">Email Address</label>
                                    <input type="email" class="input-box" id="primary_email" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="validation-text" id="primary_email_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter valid email</span>
                                </div>
                            </div>

                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="login-input-action-set" id="mobile_alt_no">
                                    <div class="login-input-group phone">
                                        <label for="alt_mobile_no">Alternative Mobile Number</label>
                                        <input type="tel" class="login-input-box num_alter_mobiles" id="alt_mobile_no" name="phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="validation-text" id="alt_mobile_no_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter valid mobile number</span>
                                </div>
                            </div>

                             <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="alternative_email">Alternative Email Address</label>
                                    <input type="email" class="input-box" id="alternative_email" placeholder="Enter Alternate Email">
                                </div>
                            </div>
                             <div class="validation-text" id="alternative_email_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter valid email</span>
                                </div>
                        </div>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="step-form-header">
                            <h3>Address</h3>
                            <p>Tell us where your bussiness is located</p>
                        </div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="address">Address</label>
                                    <input type="text" class="input-box" id="address" placeholder="Enter Address">
                                </div>
                            </div>
                             <div class="validation-text" id="address_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter Address</span>
                                </div>
                                </div>
                            

                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <!-- bg-arrow -->
                                <div class="input-box-set">
                                    <label for="select_reason">Country</label>
                                    <select class="select-input" id="select_reason_country">
                                        <!-- <option value="0">-select option-</option>
                                        <option value="1">-</option>
                                        <option value="2">-</option>
                                        <option value="3">-</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="validation-text" id="select_reason_country_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Select Country</span>
                                </div>
                            </div>

                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <!-- bg-arrow -->
                                <div class="input-box-set">
                                    <label for="select_reason">State</label>
                                    <select class="select-input" id="select_reason_state">
                                        <option value="0">Select State</option>
                                        <!-- <option value="1">-</option>
                                        <option value="2">-</option>
                                        <option value="3">-</option> -->
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="validation-text" id="select_reason_state_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Select State</span>
                                </div>
                        </div>

                         <div class="text-box-group">
                            <div class="input-form-group-item">
                                <!-- bg-arrow -->
                                <div class="input-box-set">
                                    <label for="select_reason">City</label>
                                    <select class="select-input" id="select_reason_city">
                                        <option value="0">Select City</option>
                                        <!-- <option value="1">-</option>
                                        <option value="2">-</option>
                                        <option value="3">-</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="validation-text" id="city_validate">
                                    <span><img src="asset/images/required-icon.png" class="required-icon">Select City</span>
                                </div>
                        </div>

                            <div  class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="input-box" id="pincode" placeholder="Enter Pincode">
                                </div>
                            </div>
                            <div class="validation-text" id="pincode_validate">
                                     <span><img src="asset/images/required-icon.png" class="required-icon">Enter Pincode</span>
                                </div>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-2">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow" onclick="business_info()">
                        </a>
                    </div>
                </section>
                <section class="sec-tab bank_sec" id="bank_detail">
                    <div class="bank-section-set">
                        <div class="header-title">
                            <h2>Bank Details</h2>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="step-form-header">
                            <h3>Link your Bank</h3>
                            <p>This will help us to send payment in your bookings</p>
                        </div>
                        <div class="input-form-group">
                            <div class="input-form-group-required-item">
                                <!--required-->
                                <div class="input-form-group-item1">
                                    <div class="input-box-set">
                                        <label for="acc_number">Account number</label>
                                        <input type="text" class="input-box" id="acc_number" placeholder="Enter Account Number" value="">
                                    </div>
                                </div>
                                <span class="validation-text" id="acc_number_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid Account number</span>
                            </div>
                            <div class="input-form-group-required-item">
                                <!--required-->
                                <div class="input-form-group-item1">
                                    <div class="input-box-set">
                                        <label for="re_enter_ac_no">Re-enter account number</label>
                                        <input type="text" class="input-box" id="re_enter_ac_no" placeholder="Enter Account Number" value="">
                                    </div>
                                </div>
                                <span class="validation-text" id="re_enter_ac_no_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid Account number</span>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1">
                                    <div class="input-box-set">
                                        <label for="ifsc_code">IFSC Code</label>
                                        <input type="text" class="input-box" id="ifsc_code" placeholder="Enter IFSC" oninput="ifsc_function()">
                                    </div>
                                </div>
                                 <span class="validation-text" id = "ifsc_code_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid IFSC</span>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1 disabled">
                                    <div class="input-box-set">
                                        <label for="branch">Branch</label>
                                        <input type="text" class="input-box" id="bank_branch" placeholder="Enter Branch Name" disabled>
                                    </div>
                                </div>
                                 <span class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid Branch Name</span>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1 disabled">
                                    <div class="input-box-set">
                                        <label for="city">City</label>
                                        <input type="text" class="input-box" id="bank_city" placeholder="Enter Branch City" disabled>
                                    </div>
                                </div>
                                 <span class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid Branch City</span>
                            </div>
                        </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-2">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow" onclick="bank_detail()">
                        </a>
                   
                </section>
                <section class="sec-tab service_location_sec" id="service_location_Details">
                    <div class="service_location_set">
                        <div class="header-title">
                            <h2>Service and Location</h2>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="step-form-header">
                            <h3>Choose Service</h3>
                            <p>Choose the service which you whis to provide to users</p>
                        </div>
                        <div class="check-service-items">
                            <input type="checkbox" class="check-box selectall-input hidden" id="selectall">
                            <label for="selectall" class="checkbox-label selectall-btn">
                                <span class="cust-check-box"></span>
                                Select All
                            </label>
                        </div>
                        <div class="check-service-set">
                            <!-- <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="meet_assist" value="meet" data-name = "meet and assist">
                                <label for="meet_assist" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Meet & Assist
                                </label>
                            </div> -->
                            
                        </div>
                        <div class="step-form-header">
                            <h3>Choose Locations</h3>
                            <p>Add the airport locations where you wish to provide the service</p>
                        </div>
                        <div class="location-set">
                            <div class="location-filter-box">
                                <div class="filter-header">
                                    <div class="filter-title">
                                        <h4>Total Airports</h4>
                                        <a class="add-link" onclick="addRemoveAll('addAll');" href="javascript:void(0)">Add all</a>
                                    </div>
                                    <p class="airport-count addcount">>0 Airport</p>
                                    <div class="filter-input-box">
                                        <input type="text" class="search-box" placeholder="Search airports" value="" oninput="airportAddSearch(this.value)">
                                        <img src="asset/images/search-icon.png" alt="search icon" class="search-icon">
                                    </div>
                                </div>
                                <div class="filter-list-items addairport">
                                    <ul>
                                        <!-- <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="add-link" href="javascript:void()">Add</a>
                                        </li> -->
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="location-filter-box">
                                <div class="filter-header">
                                    <div class="filter-title">
                                        <h4>Total Airports</h4>
                                        <a class="remove-link" onclick="addRemoveAll('removeAll');" href="javascript:void(0)">Remove all</a>
                                    </div>
                                    <p class="airport-count selectedcount">0 Airport</p>
                                    <div class="filter-input-box">
                                        <input type="text" class="search-box" placeholder="Search airports"  oninput="airportRemoveSearch(this.value)">
                                        <img src="asset/images/search-icon.png" alt="search icon" class="search-icon">
                                    </div>
                                </div>
                                <div class="filter-list-items removeairport">
                                    <ul>
                                        <!-- <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="remove-link" href="javascript:void()">Remove</a>
                                        </li>
                                         -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-3">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow" onclick="service_locations()">
                        </a>
                    </div>
                </section>
                <section class="documents-sec sec-tab" id="doument_detail">
                    <div class="documents-set">
                        <div class="header-title">
                        <h2>Document</h2>
                        </div>
                        <div class="unserline-div"></div>
                        <div class="input-form-group">
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <label for="gst_number">GST Numbers</label>
                                        <input type="text" class="input-box" id="gst_number" placeholder="Enter GST Numbers">
                                    </div>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <label for="pan_number">PAN Numbers</label>
                                        <input type="text" class="input-box" id="pan_number" placeholder="Enter PAN Numbers">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Pan Card /Tax License Number</h4>
                                <p>Upload your Pan Card /Tax License Number for verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_pan_card" style="display: flex;">
                                    <input id="valid_pan_card" type="hidden">
                                    <input id="edit_pan_card" type="hidden" value="">
                                    <input type="file" id="pan_card" class="hidden" onchange="ValidateFileUpload('pan_card')">
                                    <label for="pan_card">Upload</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_pan_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('pan_card');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>GST/VAT</h4>
                                <p>Upload your GST Certificate for verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_gst_card" style="display: flex;">
                                    <input id="valid_gst_certificate" type="hidden">
                                    <input id="edit_gst_certificate" type="hidden" value="">
                                    <input type="file" id="gst_certificate" class="hidden" onchange="ValidateFileUpload('gst_certificate')">
                                    <label for="gst_certificate">Upload GST/VAT Certificate</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_gst_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="gst_id" class="tick-icon">
                                        <p>Uploaded</p>
                                        <img src="asset/images/close.svg" onclick="clearImageData('gst_certificate');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>MSME Certificate</h4>
                                <p>Upload your MSME Certificate for verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_msme_card" style="display: flex;">
                                    <input id="valid_file1" type="hidden">
                                    <input id="edit_file1" type="hidden" value="">
                                    <input type="file" id="file1" class="hidden" onchange="ValidateFileUpload('file1')">
                                    <label for="file1">Upload MSME Certificate</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_msme_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('file1');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Certificate of Incorporation</h4>
                                <p>Upload your Certificate of Incorporation for verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_incorporation_card" style="display: flex;">
                                    <input id="valid_file2" type="hidden">
                                    <input id="edit_file2" type="hidden" value="">
                                    <input type="file" id="file2" class="hidden" onchange="ValidateFileUpload('file2')">
                                    <label for="file2">Upload Certificate of Incorporation</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_incorporation_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('file2');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Void Cheque</h4>
                                <p>Upload your bank account cancelled cheque for verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_void_cheque" style="display: flex;">
                                    <input id="valid_void_cheque" type="hidden">
                                    <input id="edit_void_cheque" type="hidden" value="">
                                    <input type="file" id="void_cheque" class="hidden" onchange="ValidateFileUpload('void_cheque');">
                                    <label for="void_cheque">Upload Void Cheque</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_void_cheque" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('void_cheque');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Contract Agreement</h4>
                                <p>Upload your signed contract agreement for Verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_ca_card" style="display: flex;">
                                    <input id="valid_ca_card" type="hidden">
                                    <input id="edit_ca_card" type="hidden" value="">
                                    <input type="file" id="ca_card" class="hidden" onchange="ValidateFileUpload('ca_card');">
                                    <label for="ca_card">Upload Contract Agreement</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_ca_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('ca_card');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Other Document 1</h4>
                                <p>Upload your other document for Verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_other_doc1" style="display: flex;">
                                    <input id="valid_other_doc1" type="hidden">
                                    <input id="edit_other_doc1" type="hidden" value="">
                                    <input type="file" id="other_doc1" class="hidden" onchange="ValidateFileUpload('other_doc1');">
                                    <label for="other_doc1">Upload</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_other_doc1" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('other_doc1');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Other Document 2</h4>
                                <p>Upload your other document for Verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_other_doc2" style="display: flex;">
                                    <input id="valid_other_doc2" type="hidden">
                                    <input id="edit_other_doc2" type="hidden" value="">
                                    <input type="file" id="other_doc2" class="hidden" onchange="ValidateFileUpload('other_doc2');">
                                    <label for="other_doc2">Upload</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_other_doc2" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('other_doc2');" class="doc-close-icon">
                                    </div>
                                    <div>
                                        <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="declare">
                            <div class="form-check ">
                                <input class="form-check-input" type="checkbox" id="declare">
                                <label class="form-check-label " for="declare">
                                I hereby declare that the information provided is true and correct, I also understand that any <br>
                                Willful dishonesty may render for refusal of this applicaton or immediate termination of this application.
                                </label>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-4">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow" onclick="upload_image_page();">
                        </a>
                    </div>
                </section>
                <section class="sec-tab shopdetails_sec" id="review">
                    <div class="review_content">
                        <div class="review_text">
                            <h1>Review</h1>
                        </div>
                        <div class="wrapper">
                            <div class="tab-wrapper">
                                <ul class="tabs">
                                    <li class="tab-link active" data-tab="1">Business Info</li>
                                    <li class="tab-link" data-tab="2">Bank Details</li>
                                    <li class="tab-link" data-tab="3">Service and Locations</li>
                                    <li class="tab-link" data-tab="4">Documents</li>
                                </ul>
                            </div>
                            <div class="content-wrapper">
                                <div id="tab-1" class="tab-content active">
                                    <div class="business-info-set">
                                        <h2 id="get_business_name_value"></h2>
                                        <div class="info-empty-card">
                                            <div class="info-empty-card-items">
                                                <p>Business Type</p>
                                                <h4 id="get_business_type"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Business Website</p>
                                                <h4 id="get_business_website"></h4>
                                            </div>
                                        </div>
                                        <div class="primary_box">
                                            <h4 class="primary_text">Primary Contact Details</h4>
                                            <div class="info-empty-card">
                                                <div class="info-empty-card-items">
                                                    <p>Mobile Number</p>
                                                    <h4 id="get_primary_business_type"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Business Email</p>
                                                    <h4 id="get_primary_business_website"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Altemative Mobile Number</p>
                                                    <h4 id="get_primary_alt_phone_number"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Altemative Email Address</p>
                                                    <h4 id="get_primary_alt_email"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="primary_box">
                                            <h4 class="primary_text">Address</h4>
                                            <div class="info-empty-card">
                                                <div class="info-empty-card-items">
                                                    <p>Address</p>
                                                    <h4 id="get_address_value"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Country</p>
                                                    <h4 id="get_country_value"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>State</p>
                                                    <h4 id = "get_state_value"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>City</p>
                                                    <h4 id = "get_city_value"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Pincode</p>
                                                    <h4 id="get_pincode"></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form_btn text-center">
                                            <button class="submit_btn" onclick="go_to_dashboard()">Submit</button>
                                        </div> -->
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-content">
                                    <div class="primary_box4">
                                        <h4 class="primary_text">Bank</h4>
                                        <div class="info-empty-card">
                                            <div class="info-empty-card-items">
                                                <p>Account number</p>
                                                <h4 id="get_acc_number"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>IFSC Code</p>
                                                <h4 id= "get_ifsc_code"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>Branch</p>
                                                <h4 id="get_branch_value"></h4>
                                            </div>
                                            <div class="info-empty-card-items">
                                                <p>City</p>
                                                <h4 id="get_bank_city"></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form_btn text-center">
                                        <button class="submit_btn">Submit</button>
                                    </div> -->
                                </div>
                                <div id="tab-3" class="tab-content">
                                    <div class="">
                                        <h4 class="primary_text">Services Chosen</h4>
                                        <div class="check_cont">
                                            <div class="form-check check-box-cont">
                                               <!--  <input class="form-check-input" type="checkbox" id="all"> -->
                                               <img src="asset/img/check.png">
                                                <label class="form-check-labels ">
                                                    Meet & Assist
                                                </label>
                                            </div>
                                            <div class="form-check check-box-cont">
                                               <!--  <input class="form-check-input" type="checkbox" id="set"> -->
                                                <img src="asset/img/check.png">
                                                <label class="form-check-labels ">
                                                    Baggage Porter
                                                </label>
                                            </div>
                                            <div class="form-check check-box-cont">
                                                <!-- <input class="form-check-input" type="checkbox" id="send"> -->
                                                 <img src="asset/img/check.png">
                                                <label class="form-check-labels ">
                                                    Translators
                                                </label>
                                            </div>
                                        </div>
                                        <div class="chosen_title">
                                            <h4>Airports Chosen</h4>
                                            <ul class="chosen-airport-lists">
                                                <li>
                                                    <p>1) (AAL) Aalborg Airport</p>
                                                </li>
                                                <li>
                                                    <p>2) (DAL) Dallas Love Field</p>
                                                </li>
                                                <li>
                                                    <p>3) (DMM) King Fahd International Airport</p>
                                                </li>
                                                <li>
                                                    <p>4) (HNS) Haines Airport</p>
                                                </li>
                                                <li>
                                                    <p>5) (EBB) Entebbe International Airport</p>
                                                </li>
                                                <li>
                                                    <p>6) (KTM) Tribhuvan International Airport</p>
                                                </li>
                                                <li>
                                                    <p>7) (YLW) Kelowna International Airport</p>
                                                </li>
                                                <li>
                                                    <p>8) (CGN) Cologne Bonn Airport</p>
                                                </li>
                                                <li>
                                                    <p>9) (LBU) Labuan Airport</p>
                                                </li>
                                                <li>
                                                    <p>10) (LEY) Lelystad Airport</p>
                                                </li>
                                                <li>
                                                    <p>11) (NGS) Nagasaki Airport</p>
                                                </li>
                                                <li>
                                                    <p>12) (NAT) NAtal International Airport</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- <div class="form_btn text-center">
                                            <button class="submit_btn">Submit</button>
                                        </div> -->
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-content">
                                    <div class="info-empty-card">
                                        <div class="info-empty-card-items">
                                            <p>Gst Number</p>
                                            <h4 id="get_gstNumber"></h4>
                                        </div>
                                        <div class="info-empty-card-items">
                                            <p>Pan Number</p>
                                            <h4 id="get_panNumber"></h4>
                                        </div>
                                    </div>
                                    <div class="document-view">
                                        <div class="document-items" style="display:none;" id="pan_card_upload_file">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" alt="document file" id="view_pancard" class="document-file">
                                                <iframe id="view_pancard_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">Pan Card /Tax License Number</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="gst_certificate_upload_file">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/33f6d690-db45-4e3c-9a58-9073fea7628c" id="view_gst" alt="document file" class="document-file">
                                                <iframe id="view_gst_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">GST/VAT</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="msme_certificate_upload_file">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_msme" alt="document file" class="document-file">
                                                <iframe id="view_msme_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">MSME Certificate</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="incorporation_upload_file">
                                            <div class="doc-set">
                                                <img src="#" id="view_incorporation" alt="document file" class="document-file">
                                                <iframe id="view_incorporation_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">Certificate of Incorporation</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="void_cheque_upload_file">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_void_cheque" alt="document file" class="document-file">
                                                <iframe id="view_void_cheque_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">Void Cheque</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="contract_agreement_upload_file">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_ca_card" alt="document file" class="document-file">
                                                <iframe id="view_ca_card_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">Contract Agreement</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="other_document_upload_file1">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_other_doc1" alt="document file" class="document-file">
                                                <iframe id="view_other_doc1_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                            </div>
                                            <p class="file-name">Other Document 1</p>
                                        </div>
                                        <div class="document-items" style="display:none;" id="other_document_upload_file2">
                                            <div class="doc-set">
                                                <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_other_doc2" alt="document file" class="document-file">
                                                <iframe id="view_other_doc2_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79"></iframe>
                                            </div>
                                            <p class="file-name">Other Document 2</p>
                                        </div>
                                        <div id="document_not_uploaded" style="display:none;">
                                            <p>Document Not Uploaded</p>
                                        </div>
                                    </div>
                                    <div class="form_btn text-center">
                                            <button class="submit_btn onboardsubmit" onclick="onboard_submit()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sec-tab shop_sec" id="">
                    <div class="title_text">
                        <h1>Shop Details</h1>
                    </div>
                    <div class="details_list">
                        <ul>
                            <li class="completed">
                                <p class="shop_staus-name">Shop details</p><span class="tick"></span>
                            </li>
                            <li class="completed Service_detail">
                                <p class="shop_staus-name">Service details</p><span class="tick"></span>
                            </li>
                            <li class="active Policy_Setup_cont">
                                <p class="shop_staus-name">Policy details</p><span class="tick"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="Shop-details-1 ">
                        <div class="shop_textbox">
                            <div class="shop_detail_profile">
                                <input type="file" name="" class="file-upload">
                                <img src="asset/images/">
                                <p>Shop logo</p>
                            </div>
                            <div class="box_lext">
                                <div class="title_box">
                                    <div class="input_conts">
                                        <p>Shop Nmae</p>
                                        <input type="" name="" placeholder="Plaza Premium">
                                    </div>
                                </div>
                                <div class="shop-type-box">
                                    <div class="shop_title">
                                        <p>Shop Name</p>
                                        <select class="select-box">
                                            <option>Lounge</option>
                                            <option>All</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .....Location..... -->
                        <div class="location_box">
                            <h4>Location</h4>
                            <p>Tell us where your shop is Located</p>
                        </div>
                        <div class="location_title_cont">
                            <div class="title_box Location_cont">
                                <div class="input_conts">
                                    <p>Airport</p>
                                    <input type="" name="" placeholder="Bangalore (BLR)">
                                </div>
                            </div>
                            <div class="terminal_title">
                                <div class="shop_title">
                                    <p>Terminal</p>
                                    <select class="select-box">
                                        <option>Terminal 1</option>
                                        <option>Terminal 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="title_box Coordinates_title">
                                <div class="input_conts">
                                    <p>Coordinates</p>
                                    <input type="" name="" placeholder="5852426, 8790324">
                                    <img src="asset/images/">
                                </div>
                            </div>
                        </div>
                        <!-- ......Contanct information.... -->
                        <div class="contact_box">
                            <h4>Contact Information</h4>
                            <p>Help us identify and reach your Shop</p>
                        </div>
                        <div class="information_contect">
                            <div class="title_box information_text">
                                <div class="input_conts">
                                    <p>Website</p>
                                    <input type="" name="" placeholder="www.plazapremium.com">
                                </div>
                            </div>
                            <div class="title_box">
                                <div class="" data-aos="zoom-in-down">
                                    <input type="text" id="mobile_code" class="country_select" placeholder=" " name="">
                                </div>
                                <div class="input_cont">
                                    <p>Alternative Mobile Number</p>
                                    <input type="" name="" placeholder="9625575656">
                                </div>
                            </div>
                            <div class="title_box email_text">
                                <div class="input_conts">
                                    <p>Office Email Address</p>
                                    <input type="" name="" placeholder="contact@plazapremium.com">
                                </div>
                            </div>
                        </div>
                        <!-- ......Let people know more about your shop... -->
                        <div class="about-sho_title">
                            <h4>Let people know more about your shop</h4>
                            <p>Give a brief about your shop</p>
                        </div>
                        <div class="massage-box">
                            <textarea class="text_box">Type message</textarea>
                            <div class="massage_text">
                                <p>(500 characters more)</p>
                            </div>
                        </div>
                        <!-- ......Let's add your shop photos... -->
                        <div class="about-sho_title">
                            <h4>Let's add your shop photos</h4>
                            <p>Upload high-quality photos which would elevate your shop</p>
                        </div>
                        <div class="">
                        </div>
                        <!-- ......Add amenities... -->
                        <div class="about-sho_title">
                            <h4>Add amenities</h4>
                            <p>Upload high-quality photos which would elevate your shop</p>
                        </div>
                    </div>
                    <!-- .....Service details 2....... -->
                    <!-- .................................... -->
                    <div class="Service_details2">
                        <div class="service_title">
                            <h4>Shop service time</h4>
                            <p>Set the operating hours of your shop. only during these times you will receive bookings</p>
                        </div>
                        <div class="box-weekly">
                            <div class="weekly_date">
                                <h4>Monday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="assist">
                                    <label class="form-check-label " for="assist">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_times">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ......................Tuesday........................ -->
                        <div class="date-of-box-cont">
                            <div class="weekly_date">
                                <h4>Tuesday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="assists">
                                    <label class="form-check-label " for="assists">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .........Wendnesday....... -->
                        <div class="date-of-box-cont">
                            <div class="weekly_date">
                                <h4>Wendnesday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Wendnesday">
                                    <label class="form-check-label " for="Wendnesday">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .........Thursday....... -->
                        <div class="date-of-box-cont">
                            <div class="weekly_date">
                                <h4>Thursday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Thursday">
                                    <label class="form-check-label " for="Thursday">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .........Friday....... -->
                        <div class="date-of-box-cont">
                            <div class="weekly_date">
                                <h4>Friday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Friday">
                                    <label class="form-check-label " for="Friday">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .........Saturday....... -->
                        <div class="date-of-box-cont">
                            <div class="weekly_date">
                                <h4>Saturday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Saturday">
                                    <label class="form-check-label " for="Saturday">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .........Sunday....... -->
                        <div class="date-of-box-conts">
                            <div class="weekly_date">
                                <h4>Sunday</h4>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="Sunday">
                                    <label class="form-check-label " for="Sunday">
                                        Holiday
                                    </label>
                                </div>
                            </div>
                            <div class="timeing_cont">
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                                <div class="arriving-input-set input-group" id="arrive_time">
                                    <span class="input-group-addon bg-time">
                                    </span>
                                    <div class="arrive_times">
                                        <label for="arrive_time">Out Time</label>
                                        <input type="text" class="b-input datepicker" id="arrive_time_input" placeholder="00:00 AM" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ........Let people know what you offer....... -->
                        <div class="what_offer_box">
                            <div class="Let_people_text">
                                <h4>Let people know what you offer</h4>
                                <p>Set service slot time and pricing for adults/children</p>
                                <p>Adult - 12 years and above, Chid - 2 to 11 years</p>
                            </div>
                            <div class="slot_box check">
                                <div class="Set_service-title" id="slot_1">
                                    <div class="slot_time_box">
                                        <div class="slot_time_text">
                                            <p>Slot time</p>
                                            <select class="select-box">
                                                <option>1 hour</option>
                                                <option>2 hour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cost">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="1,200" class="price_tag">
                                        </div>
                                    </div>
                                    <div class="cost   cost_for_child">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="600" class="price_tag">
                                        </div>
                                    </div>
                                </div>
                                <div class="Set_service-title" id="slot_2">
                                    <div class="slot_time_box">
                                        <div class="slot_time_text">
                                            <p>Slot time</p>
                                            <select class="select-box">
                                                <option>2 hour</option>
                                                <option>3 hour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cost">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="1,200" class="price_tag">
                                        </div>
                                    </div>
                                    <div class="cost   cost_for_child">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="600" class="price_tag">
                                        </div>
                                    </div>
                                    <div class="close_box">
                                        <p>X</p>
                                    </div>
                                </div>
                                <div class="Set_service-title" id="slot_3">
                                    <div class="slot_time_box">
                                        <div class="slot_time_text">
                                            <p>Slot time</p>
                                            <select class="select-box">
                                                <option>3 hour</option>
                                                <option>1 hour</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cost">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="1,200" class="price_tag">
                                        </div>
                                    </div>
                                    <div class="cost   cost_for_child">
                                        <select>
                                            <option>₹</option>
                                            <option>$</option>
                                        </select>
                                        <div class="input_cont">
                                            <p>Cost for Aduit</p>
                                            <input type="" name="" placeholder="600" class="price_tag">
                                        </div>
                                    </div>
                                    <div class="close_box">
                                        <p>X</p>
                                    </div>
                                </div>
                                <div class="add_slot_text">
                                    <p>Add Slot</p>
                                </div>
                                <div class="bottom_btn">
                                    <div class="back-btn">
                                        <img src="images/">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ......policy details..... -->
                    <div class="Policy_Setup">
                        <div class="terms_text">
                            <h4>Terms and conditions</h4>
                            <p>Type your terms and conditions for this service</p>
                            <div class="conditions_text_box">
                                <textarea class="text_box1">Type message...</textarea>
                            </div>
                        </div>
                        <div class="terms_text">
                            <h4>Privacy policy</h4>
                            <p>Type your Privacy policy for this service</p>
                            <div class="conditions_text_box">
                                <textarea class="text_box1">Type message...</textarea>
                            </div>
                        </div>
                        <div class="bottom_btn">
                            <div class="back-btn">
                                <img src="images/">
                            </div>
                        </div>
                    </div>
                </section>
                 </div>
            </div>
    </section>
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <!-- <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- <script src="js/intlTelInput.js"></script> -->
    <script src="js/utils.js"></script>
    <!-- <script src="js/intlTelInput.min.js"></script>
    <script src="js/mask.js"></script> -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let apiPath = "<?php echo $apiPath;?>";
        let userToken = localStorage.getItem("userToken");
        let onboarded = JSON.parse(localStorage.getItem("onboarded"));
        var valid1 = true;
        var mask = "";
        var iti = '';
        var variable = "";
        var arr = [];
        let totalArray = [];
        let selectedAirportsArray = [];
        var image_id = [];
        // var id = ["mobile_no","alt_mobile_no","mobile_code"];
        var id = ["num_mobiles","num_alter_mobiles"];
        var edited_doc = [];
        console.log(apiPath);
    // -----Country Code Selection
    // $("#mobile_code,#mobile_no,#alt_mobile_no").intlTelInput({
    //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    //     initialCountry: "in",
    //     // separateDialCode: true,
    // });

        

        // id.forEach(function (value, i) {
        //     var iti = '';
        //     var mask = "";
        //     var phoneInputID = value;
        //     var input = document.querySelector(phoneInputID);
        //     iti = window.intlTelInput(input, {
        //         separateDialCode: false,
        //         initialCountry: "in",
        //         utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        //     });
            
        //     $(phoneInputID).on("countrychange", function(event) {
        //         var selectedCountryData = iti.getSelectedCountryData();
        //         newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
        //         newPlaceholder = newPlaceholder.replace(/[()]/g, '');
        //         newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
        //         iti.setNumber("");
                
        //         $(this).val('');
        //         $(this).attr('placeholder',newPlaceholder);
        //         newPlaceholder = newPlaceholder.replace(/^0+/, '');
        //         mask = newPlaceholder.replace(/[1-9]/g, "0");
        //         // Apply the new mask for the input
        //         $(this).mask(mask);
        //         var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
        //         check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
        //     });
            
        //     iti.promise.then(function() {
        //         $(phoneInputID).trigger("countrychange");
        //     });
        // });
    function isEmail(email) {
        let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return mailFormat.test(email);
	}

    function checknumber(sel){
        // sel.value = sel.value.replace(/[^0-9]/g, '');
        let numbers = /^[-+]?[0-9]+$/;
        sel.value = sel.value.match(numbers);
    }

    function isValidPhone(id){
        let result = $(`#${id}`).intlTelInput("isValidNumber");
        return result;
    }

    $('.side-menu-tab').on('click', function() {
        let sidemenu_target = $(this).attr('toggle-target');
        $(`.sec-tab,.side-menu-tab`).removeClass('active');
        $(this).addClass('active');
        $(`#${sidemenu_target}`).addClass('active');
    });

    $('.tab-link').click(function() {

        var tabID = $(this).attr('data-tab');

        $(this).addClass('active').siblings().removeClass('active');

        $('#tab-' + tabID).addClass('active').siblings().removeClass('active');
    });


    // dropdown
    $(document).ready(function() {
        if(userToken != "" && userToken != undefined){
            // if(onboarded == true){
            //     window.location.replace("booking.php");
            // }else{
                let datas = {
                        "distributorToken":localStorage.getItem('distributorToken'),
                        "userToken":userToken
                        }
                var json1 = JSON.stringify(datas);
                $.ajax({
                type: "POST",
                dataType: "json",
                url: apiPath+"/distributor/getonBoardDetails.php",
                data: json1,
                success: Business_Type,
                });
                // field_validation(); //add  
            //}
        }else{
            window.location = "login.php";
        }
    });
    let serviceLocationsArray = [];

    function Business_Type(data) {

        $('#business_name').val(data.get_details[0].name);
        $('#business_website_info').val(data.get_details[0].website_name);
        $('#primary_email').val(data.get_details[0].primary_email);  //Email
        $('#alternative_email').val(data.get_details[0].alternate_email);  //Alter Email
        let mobile_no = '+'+data.get_details[0].country_code + data.get_details[0].primary_mobile_number;
        $('#mobile_no').val(mobile_no);
        let alt_mobile_no = '+'+data.get_details[0].alternate_country_code+data.get_details[0].alternate_mobile_number;
        $('#alt_mobile_no').val(alt_mobile_no);
        $('#address').val(data.get_details[0].address); 
        $('#pincode').val(data.get_details[0].pincode); 
        $('#acc_number').val(data.get_details[0].account_number); 
        $('#re_enter_ac_no').val(data.get_details[0].account_number); 
        $('#ifsc_code').val(data.get_details[0].ifsc_code);
        $('#bank_branch').val(data.get_details[0].branch); 
        $('#bank_city').val(data.get_details[0].city);
        $('#gst_number').val(data.get_details[0].gst_number);
        $('#pan_number').val(data.get_details[0].pancard_number);

        // $('#select_reason_business').append($('<option>').text("Select Business Type").attr('value', "0"));
        // $.each(data.distributorTypes, function(i, value) {
        //     $('#select_reason_business').append($('<option>').text(value.name).attr('value', value.token));
        // });
        let distributorTypes_html = '<option value="0" selected disabled>Select Business Type</option>';
        let get_type = data.get_details[0].service_distributor_type_token;
        let distributorTypes = data.distributorTypes;
        for (let key in distributorTypes) {
            if (get_type == distributorTypes[key].token) {
                distributorTypes_html += '<option value="' + distributorTypes[key].token + '" selected>' + distributorTypes[key].name + '</option>';
            } else {
                distributorTypes_html += '<option value="' + distributorTypes[key].token + '">' + distributorTypes[key].name + '</option>';
            }
        }
        $('#select_reason_business').html(distributorTypes_html);
        $('#select_reason_business').prop('disabled', 'disabled');

        // country
        // $('#select_reason_country').append($('<option>').text("Select Country").attr('value', 0));
        // $.each(data.countries, function(i, value) {
        //     $('#select_reason_country').append($('<option>').text(value.countryName).attr('value', value.countryId));
        // });
        
        let country_html = '<option value="0" selected disabled>Select Country</option>';
        let country_id = data.get_details[0].country_id;
        let countries = data.countries;
        for (let keys in countries) {
            if (country_id == countries[keys].countryId) {
                country_html += '<option value="' + countries[keys].countryId + '" selected>' + countries[keys].countryName + '</option>';
            } else {
                country_html += '<option value="' + countries[keys].countryId + '">' + countries[keys].countryName + '</option>';
            }
        }
        $('#select_reason_country').html(country_html);

            let datas1 = {
                        "countryId":country_id
                       }
            let json_data = JSON.stringify(datas1);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: apiPath+"/distributor/statesOfCountry.php",
                data:json_data,
                success: function(res){

                    let state_html = '<option data-country="" value="0" selected disabled>Select State</option>';
                    let state_id = data.get_details[0].state_id;
                    let state = res.states;
                    for (let keys in state) {
                        if (state_id == state[keys].stateId) {
                            state_html += '<option data-country="'+state[keys].countryId+'" value="' + state[keys].stateId + '" selected>' + state[keys].stateName + '</option>';
                        } else {
                            state_html += '<option data-country="'+state[keys].countryId+'" value="' + state[keys].stateId + '">' + state[keys].stateName + '</option>';
                        }
                    }
                    $('#select_reason_state').html(state_html);
                },
            });

            let datas2 = {
                            "countryId":country_id,
                            "stateId":data.get_details[0].state_id
                    }
            let json_datas = JSON.stringify(datas2);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: apiPath+"/distributor/citiesOfState.php",
                data:json_datas,
                success: function(res){
                    let city_html = '<option data-state="" data-country="" value="0" selected disabled>Select City</option>';
                    let city_id = data.get_details[0].city_id;
                    let city = res.cities;
                    for (let keys in city) {
                        if (city_id == city[keys].cityId) {
                            city_html += '<option data-state="'+city[keys].stateId+'" data-country="'+city[keys].countryId+'" value="' + city[keys].cityId + '" selected>' + city[keys].cityName + '</option>';
                        } else {
                            city_html += '<option data-state="'+city[keys].stateId+'" data-country="'+city[keys].countryId+'" value="' + city[keys].cityId + '">' + city[keys].cityName + '</option>';
                        }
                    }
                    $('#select_reason_city').html(city_html);
                },
            });

            for (let i = 0; i < id.length; i++) {
       
                var input = document.querySelector('.'+id[i]);
            
                    iti = window.intlTelInput(input,({
                        initialCountry: "In", //change according to your own country.
                        separateDialCode: false,
                        utilsScript: "js/utils.js",
                    }));
                arr.push(iti);
                var mask1 = $("."+id[i]).attr('placeholder').replace(/[1-9]/g, "0"); 
                $("."+id[i]).mask(mask1);
            }

            variable = '"#mobile_no","#alt_mobile_no","#mobile_code"';

        for(let j = 0; j < id.length; j++){
    
            $("."+id[j]).on("countrychange", function(event) {

                // Get the selected country data to know which country is selected.
                var selectedCountryData = arr[j].getSelectedCountryData();

                // Get an example number for the selected country to use as placeholder.
                newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
            //    newPlaceholder = newPlaceholder.replaceFirst("0","");

                // Reset the phone number input.
                iti.setNumber("");
                
                $(this).val('');
                $(this).attr('placeholder',newPlaceholder);
                // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
                mask = newPlaceholder.replace(/[1-9]/g, "0");
                
                // Apply the new mask for the input
                $("."+id[j]).mask(mask);
                
            });
        }

        $.each(data.bussinessType, function(i, value) {
            let bussinessType_html = '';
            if(data.getbussinessType.includes(value.token)){
                bussinessType_html =`<div class="check-service-items">
                                        <input type="checkbox" class="check-box module-input hidden" id="${value.token}" value=${value.token} data-name="${value.name}" checked>
                                        <label for=${value.token} class="checkbox-label">
                                            <span class="cust-check-box"></span>
                                            ${value.name}
                                        </label>
                                    </div>`;
            }else{
                bussinessType_html =`<div class="check-service-items">
                                        <input type="checkbox" class="check-box module-input hidden" id="${value.token}" value=${value.token} data-name="${value.name}">
                                        <label for=${value.token} class="checkbox-label">
                                            <span class="cust-check-box"></span>
                                            ${value.name}
                                        </label>
                                    </div>`;
            }
            $('.check-service-set').append(bussinessType_html);
        });
        if(data.bussinessType.length == data.getbussinessType.length){
            $("#selectall").prop("checked", true);
        }else{
            $("#selectall").prop("checked", false);
        }

        // SELECT ALL IN ADD ROLE
        const selectAllInput = document.querySelector('.selectall-input');
        const moduleInputs = document.querySelectorAll('.module-input');
        selectAllInput.addEventListener('change', function(){
            if(selectAllInput.checked){
                console.log('all select')
                moduleInputs.forEach(input => input.checked = true);
            }else{
                moduleInputs.forEach(input => input.checked = false);
            }
        });

        moduleInputs.forEach(function(input, i){
            input.addEventListener('click', function(){
               if(!input.checked){
                  selectAllInput.checked = false;
               }
               let len = 0;
               for(var i = 0; i < moduleInputs.length; i++){
                  if(moduleInputs[i].checked) len++;
               }
               if(len == moduleInputs.length){
                  selectAllInput.checked = true;
               }
            });
        });

        // Amendment -- individually Listing Total airports
        totalArray = data.airports;

        let airportListView ='';
        totalArray.forEach((airport,index) => {
            airportListView += `<li>
                                <p>(${airport.airportCode}) ${airport.airportName} </p>
                                <a data-token="${airport.airportToken}" data-name="${airport.airportName}" data-code="${airport.airportCode}" data-servicetoken="${airport.businessTypeToken}" class="add-link" href="javascript:void(0);" onclick="addSelected(this)">Add</a>
                             </li>`;
        });
        $('.addairport ul').html(airportListView);
        
        const plural = totalArray.length > 1 ? 's' : "";
        $('.addcount').text(`${totalArray.length} Airport${plural}`);

        // Amendment -- individually Listing Selected Total airports
        let get_totalArray = data.get_airports;
        let get_airport_html = '';
        get_totalArray.forEach((airport,index) => {
            selectedAirportsArray.push({
                    airportToken: airport.airportToken,
                    airportName: airport.airportName,
                    airportCode: airport.airportCode,
                    businessTypeToken: airport.businessTypeToken
            });

            get_airport_html += `<li>
                                    <p>(${airport.airportCode}) ${airport.airportName}</p>
                                    <a data-token="${airport.airportToken}" data-name="${airport.airportName}" data-code="${airport.airportCode}" data-servicetoken="${airport.businessTypeToken}" class="remove-link" href="javascript:void(0);" onclick="removeSelected(this)">Remove</a>
                                </li>`;
        
        });
        $('.removeairport ul').html(get_airport_html);
        const plurals = selectedAirportsArray.length > 1 ? 's' : "";
        $('.selectedcount').text(`${selectedAirportsArray.length} Airport${plurals}`);

        if (data.get_details[0].pan_card != '') {
            $("#valid_pan_card").val(data.get_details[0].pan_card);
            $("#edit_pan_card").val('1');
            image_id.push("pan_card");
            let format = data.get_details[0].pan_card.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_pancard_pdf").attr('src', data.get_details[0].pan_card);
                $("#view_pancard_pdf").show();
                $('#view_pancard').hide();
            }else{
                $("#view_pancard").attr('src', data.get_details[0].pan_card);
                $("#view_pancard").show();
                $("#view_pancard_pdf").hide();
            }
            $('#pan_card_upload_file').show();
            edited_doc.push('pan_card');
        }
        if (data.get_details[0].gst_certificate != '') {
            $("#valid_gst_certificate").val(data.get_details[0].gst_certificate);
            $("#edit_gst_certificate").val('1');
            image_id.push("gst_certificate");
            let format = data.get_details[0].gst_certificate.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_gst_pdf").attr('src', data.get_details[0].gst_certificate);
                $("#view_gst_pdf").show();
                $("#view_gst").hide();
            }else{
                $("#view_gst").attr('src', data.get_details[0].gst_certificate);
                $("#view_gst").show();
                $("#view_gst_pdf").hide();
            }
            $('#gst_certificate_upload_file').show();
            edited_doc.push('gst_certificate');
        }
        if (data.get_details[0].msme_certificate != '') {
            $("#valid_file1").val(data.get_details[0].msme_certificate);
            $("#edit_file1").val('1');
            image_id.push("file1");
            let format = data.get_details[0].msme_certificate.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_msme_pdf").attr('src', data.get_details[0].msme_certificate);
                $("#view_msme_pdf").show();
                $("#view_msme").hide();
            }else{
                $("#view_msme").attr('src', data.get_details[0].msme_certificate);
                $("#view_msme").show();
                $("#view_msme_pdf").hide();
            }
            $('#msme_certificate_upload_file').show();
            edited_doc.push('file1');
        }
        if (data.get_details[0].incorporation_certificate != '') {
            $("#valid_file2").val(data.get_details[0].incorporation_certificate);
            $("#edit_file2").val('1');
            image_id.push("file2");
            let format = data.get_details[0].incorporation_certificate.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_incorporation_pdf").attr('src',data.get_details[0].incorporation_certificate);
                $("#view_incorporation_pdf").show();
                $("#view_incorporation").hide();
            }else{
                $("#view_incorporation").attr('src',data.get_details[0].incorporation_certificate);
                $("#view_incorporation").show();
                $("#view_incorporation_pdf").hide();
            }
            $('#incorporation_upload_file').show();
            edited_doc.push('file2');
        }
        if (data.get_details[0].voide_cheque != '') {
            $("#valid_void_cheque").val(data.get_details[0].voide_cheque);
            $("#edit_void_cheque").val('1');
            image_id.push("void_cheque");
            let format = data.get_details[0].voide_cheque.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_void_cheque_pdf").attr('src', data.get_details[0].voide_cheque);
                $("#view_void_cheque_pdf").show();
                $("#view_void_cheque").hide();
            }else{
                $("#view_void_cheque").attr('src', data.get_details[0].voide_cheque);
                $("#view_void_cheque").show();
                $("#view_void_cheque_pdf").hide();
            }
            $('#void_cheque_upload_file').show();
            edited_doc.push('void_cheque');
        }
        if (data.get_details[0].contract_agreement != '') {
            $("#valid_ca_card").val(data.get_details[0].contract_agreement);
            $("#edit_ca_card").val('1');
            image_id.push("ca_card");
            let format = data.get_details[0].contract_agreement.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_ca_card_pdf").attr('src',data.get_details[0].contract_agreement);
                $("#view_ca_card_pdf").show();
                $("#view_ca_card").hide();
            }else{
                $("#view_ca_card").attr('src',data.get_details[0].contract_agreement);
                $("#view_ca_card").show();
                $("#view_ca_card_pdf").hide();
            }
            $('#contract_agreement_upload_file').show();
            edited_doc.push('ca_card');
        }
        if (data.get_details[0].other_document_one != '') {
            $("#valid_other_doc1").val(data.get_details[0].other_document_one);
            $("#edit_other_doc1").val('1');
            image_id.push("other_doc1");
            let format = data.get_details[0].other_document_one.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_other_doc1_pdf").attr('src', data.get_details[0].other_document_one);
                $("#view_other_doc1_pdf").show();
                $("#view_other_doc1").hide();
            }else{
                $("#view_other_doc1").attr('src', data.get_details[0].other_document_one);
                $("#view_other_doc1").show();
                $("#view_other_doc1_pdf").hide();
            }
            $('#other_document_upload_file1').show();
            edited_doc.push('other_doc1');
        }
        if (data.get_details[0].other_document_two != '') {
            $("#valid_other_doc2").val(data.get_details[0].other_document_two);
            $("#edit_other_doc2").val('1');
            image_id.push("other_doc2");
            let format = data.get_details[0].other_document_two.split(/\.(?=[^\.]+$)/);
            if(format[1] == 'pdf'){
                $("#view_other_doc2_pdf").attr('src', data.get_details[0].other_document_two);
                $("#view_other_doc2_pdf").show();
                $("#view_other_doc2").hide();
            }else{
                $("#view_other_doc2").attr('src', data.get_details[0].other_document_two);
                $("#view_other_doc2").show();
                $("#view_other_doc2_pdf").hide();
            }
            $('#other_document_upload_file2').show();
            edited_doc.push('other_doc2');
        }
        field_validation(); //add  
    }
        
    //State Select dropdown on country change
    let selectedCountryId = "";
    $('#select_reason_country').on('change', function(e){
        console.log($(this).find("option:selected").text());
        let countryId = $(this).val();
        selectedCountryId = `${countryId}`;
        let data = {
                        "countryId":countryId
                   }
        let json_data = JSON.stringify(data);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: apiPath+"/distributor/statesOfCountry.php",
            data:json_data,
            success: function(res){
                let statename = `<option data-country="" value="0" selected disabled>Select State</option>`;
                console.log(res);
                $.each(res.states, function(i, value) {
                 statename += `<option data-country=${value.countryId} value=${value.stateId}>${value.stateName}</option>`;
                });
                $('#select_reason_state').html(statename);
                let city_html = '<option data-state="" data-country="" value="0" selected disabled>Select City</option>';
                $('#select_reason_city').html(city_html);
            },
        });
        
    });

    //City Select dropdown on country change
    $('#select_reason_state').on('change',function(e){
        console.log($(this).find("option:selected").text());
        let countryId= $(this).find("option:selected").attr('data-country');
        let stateId =  $(this).val();
        let data = {
                        "countryId":countryId,
                        "stateId":stateId
                   }
        let json_data = JSON.stringify(data);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: apiPath+"/distributor/citiesOfState.php",
            data:json_data,
            success: function(res){
                console.log(res);
                let cityname = `<option data-state="" data-country="" value="0" selected disabled>Select City</option>`;
                
                $.each(res.cities, function(i, value) {
                    cityname += `<option data-state=${value.stateId} data-country=${value.countryId} value=${value.cityId}>${value.cityName}</option>`;
                });
                $('#select_reason_city').html(cityname);
            },
        });
    })

    var is_set_business = false;
    var is_set_bank_info = false;
    //var is_set_document = false;   // add
    var is_set_servicelocations = false;

    // Business info
    function business_info() {
        var getInfoDetailsCount = 0;
        var business_name = document.getElementById("business_name").value;
        var business_typeSelect = document.getElementById("select_reason_business");
        var select_reason_business = business_typeSelect.value;
        var select_reason_business_text = business_typeSelect.options[business_typeSelect.selectedIndex].text;
        var business_website = document.getElementById("business_website_info").value;
        var mobile_no = document.getElementById("mobile_no").value;
        var business_website_primary = document.getElementById("primary_email").value;
        var alt_mobile_no = document.getElementById("alt_mobile_no").value;
        var primary_business_website = document.getElementById("alternative_email").value;
        var address = document.getElementById("address").value;
        var select_reason_country = document.getElementById("select_reason_country").value;
        var select_reason_state = document.getElementById("select_reason_state").value;
        var select_reason_city = document.getElementById("select_reason_city").value;
        var pincode = document.getElementById("pincode").value;
        valid1 = true;
        if (business_name != '') {
            valid1 = true;
            // $("#business_name_validate").text("");
             document.getElementById('business_name_validate').style.visibility = "hidden";
             getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('business_name_validate').style.visibility = "visible";
        }
        if (select_reason_business != 0) {
            valid1 = true;
             document.getElementById('select_reason_business_validate').style.visibility = "hidden";
             getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('select_reason_business_validate').style.visibility = "visible";
        }
        if (business_website != '') {
            valid1 = true;
             document.getElementById('business_website_info_validate').style.visibility = "hidden";
             getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('business_website_info_validate').style.visibility = "visible";
        }
         if (mobile_no != '' && isValidPhone("mobile_no")) {
            valid1 = true;
             document.getElementById('mobile_no_validate').style.visibility = "hidden";
             getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('mobile_no_validate').style.visibility = "visible";
        }
        if (business_website_primary != '' && isEmail(business_website_primary)) {
            valid1 = true;
            document.getElementById('primary_email_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('primary_email_validate').style.visibility = "visible";
        }
         if (alt_mobile_no != '' && isValidPhone("alt_mobile_no")) {
            valid1 = true;
            document.getElementById('alt_mobile_no_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('alt_mobile_no_validate').style.visibility = "visible";
        }
        if (primary_business_website != ''  && isEmail(primary_business_website)) {
            valid1 = true;
            document.getElementById('alternative_email_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('alternative_email_validate').style.visibility = "visible";
        }
        if (address != '') {
            valid1 = true;
            document.getElementById('address_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('address_validate').style.visibility = "visible";
        }
        if (select_reason_country != 0) {
            valid1 = true;
            document.getElementById('select_reason_country_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('select_reason_country_validate').style.visibility = "visible";
        }
        if (select_reason_state != 0) {
            valid1 = true;
            document.getElementById('select_reason_state_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('select_reason_state_validate').style.visibility = "visible";
        }
        if (select_reason_city != 0) {
            valid1 = true;
            document.getElementById('city_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('city_validate').style.visibility = "visible";
        }
        if (pincode != 0) {
            valid1 = true;
            document.getElementById('pincode_validate').style.visibility = "hidden";
            getInfoDetailsCount++;
        } else {
            valid1 = false;
            document.getElementById('pincode_validate').style.visibility = "visible";
        }
        if(getInfoDetailsCount == 12){
            $("#get_business_name_value").text(business_name);
            $("#get_business_website").text(business_website);
            $("#get_primary_business_website").text(business_website_primary);
            $("#get_primary_alt_phone_number").text(alt_mobile_no);
            $("#get_primary_alt_email").text(primary_business_website);
            $("#get_address_value").text(address);
            $("#get_pincode").text(pincode);
            //var value = select_reason_business_text.options[select_reason_business_text.selectedIndex].text;
            $("#get_business_type").html(select_reason_business_text);
            $("#get_primary_business_type").html(mobile_no);
            var select_reason_country = document.getElementById('select_reason_country');
            var country_value = select_reason_country.options[select_reason_country.selectedIndex].text;
            $("#get_country_value").html(country_value);
            var select_reason_state = document.getElementById('select_reason_state');
            var state_value = select_reason_state.options[select_reason_state.selectedIndex].text;
            $("#get_state_value").html(state_value);
            var select_reason_city = document.getElementById('select_reason_city');
            var city_value = select_reason_city.options[select_reason_city.selectedIndex].text;
            $("#get_city_value").html(city_value);
            is_set_business = true;    
            $('#business_info_value').addClass('completed');
            //Entire Section above add
            //add
            $('#bank_detail_value').click();
        }
    }

    // bank_detail
    function bank_detail() {
        var acc_number = document.getElementById("acc_number").value;
        var re_enter_ac_no = document.getElementById("re_enter_ac_no").value;
        var ifsc_code = document.getElementById("ifsc_code").value;

        var branch = document.getElementById("bank_branch").value;
        var city = document.getElementById("bank_city").value;   //add
        if (acc_number != '') {
            valid1 = true;
            // $("#business_name_validate").text("");
             document.getElementById('acc_number_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('acc_number_validate').style.visibility = "visible";
        }
        if (re_enter_ac_no != '') {
            valid2 = true;
            // $("#business_name_validate").text("");
             document.getElementById('re_enter_ac_no_validate').style.visibility = "hidden";
        } else {
            valid2 = false;
            document.getElementById('re_enter_ac_no_validate').style.visibility = "visible";
        }
        if (ifsc_code != '') {
            valid3 = true;
            // $("#business_name_validate").text("");
             document.getElementById('ifsc_code_validate').style.visibility = "hidden";
        } else {
            valid3 = false;
            document.getElementById('ifsc_code_validate').style.visibility = "visible";
        }

        if(acc_number == re_enter_ac_no  ){
            if((valid1 == true) && (valid3 == true) && (valid2 = true)){
                 $("#get_acc_number").text(acc_number);
                 $("#get_ifsc_code").text(ifsc_code);
                 $("#get_branch_value").text(branch);
                 $("#get_bank_city").text(city);
                 is_set_bank_info = true;

                 $('#service_location_Details_value').click();
                 $('#bank_detail_value').addClass('completed');
            }  
        } else {
            swal("Account Number Does Not Match");
        }  
    }

    function ifsc_function(){
        var ifsc_code = document.getElementById("ifsc_code").value;
        ifsc_code = ifsc_code.toUpperCase();
        document.getElementById("ifsc_code").value = ifsc_code;
        var length = ifsc_code.length;
        if(length == 11){
            $.getJSON('https://ifsc.razorpay.com/'+ifsc_code, function(data){
               $('#bank_branch').val(data.BRANCH);
               $('#bank_city').val(data.CITY);

            });
        }else{
            $('#bank_branch').val('');
            $('#bank_city').val('');
        }
    }

    function airportAddSearch(value){
        let filteredList ="";
        let airportsFilter =  totalArray.filter((fil)=>{
           return  fil.airportName.toLowerCase().indexOf(value.toLowerCase()) != -1
        })
        airportsFilter.forEach((item,index)=>{
            filteredList += ` <li>
                                <p>(${item.airportCode}) ${item.airportName}  </p>
                                <a data-token="${item.airportToken}" data-name="${item.airportName}" data-code="${item.airportCode}"  data-servicetoken="${item.businessTypeToken}" class="add-link" href="javascript:void(0);" onclick="addSelected(this)">Add</a>
                             </li>`;
        });
        $('.addairport ul').html(filteredList);
    }

    function addSelected(sel){
        let airporttoken = $(sel).attr('data-token');
        let airportname = $(sel).attr('data-name');
        let airportcode = $(sel).attr('data-code');
        let servicetoken = $(sel).attr('data-servicetoken');
        if (selectedAirportsArray.filter(function(e) { return e.airportToken == airporttoken; }).length === 0) {
            selectedAirportsArray.push({
                airportToken: airporttoken,
                airportName: airportname,
                airportCode: airportcode,
                businessTypeToken: servicetoken
            });
        }
        airportsRefresh();
    }

    function addRemoveAll(action){
        if(action == 'addAll'){
            selectedAirportsArray = totalArray;
        }
        if(action == 'removeAll'){
            selectedAirportsArray = [];  
        }
        airportsRefresh();
    }
    
    function airportsRefresh(){
        let selectedairportlist = '';
        selectedAirportsArray.forEach((item,index) => {
            selectedairportlist += `<li>
                                <p>(${item.airportCode}) ${item.airportName}</p>
                                <a data-token="${item.airportToken}" data-name="${item.airportName}" data-code="${item.airportCode}" data-servicetoken="${item.businessTypeToken}" class="remove-link" href="javascript:void(0);" onclick="removeSelected(this)">Remove</a>
                             </li>`;
        });
        $('.removeairport ul').html(selectedairportlist);
        const plural = selectedAirportsArray.length > 1 ? 's' : "";
        $('.selectedcount').text(`${selectedAirportsArray.length} Airport${plural}`);
    }

    function airportRemoveSearch(value){
        let filteredList ="";
        let airportsFilter =  selectedAirportsArray.filter((fil)=>{
           return  fil.airportName.toLowerCase().indexOf(value.toLowerCase()) != -1
        });
        airportsFilter.forEach((item,index)=>{
            filteredList += ` <li>
                                <p>(${item.airportCode}) ${item.airportName} </p>
                                <a data-token="${item.airportToken}" data-name="${item.airportName}" data-code="${item.airportCode}"  data-servicetoken="${item.businessTypeToken}" class="remove-link" href="javascript:void(0);" onclick="removeSelected(this)">Remove</a>
                             </li>`;
        });
        $('.removeairport ul').html(filteredList);
    }

    function removeSelected(sel){
        let airporttoken = $(sel).attr('data-token');
        let airportname = $(sel).attr('data-name');
        selectedAirportsArray = selectedAirportsArray.filter((fil)=>{
           return  fil.airportToken != airporttoken
        });
        airportsRefresh();
    }

    function service_locations(){
        $('.service-error').parent().remove();
        let isServiceSelected = false;
        let isAirportSelected = false;
        let selectedServiceElement = '';
        let selectedServiceElementLength = $(".check-service-set input[type='checkbox']:checked").length;
        let selectedAirportElement = '';
        let selectedAirportElementLength = selectedAirportsArray.length;
            if(selectedServiceElementLength > 0){
                $(".check-service-set input[type='checkbox']:checked").each(function (index,item){
                let serviceToken = item.value;
                    selectedServiceElement += `<div class="form-check check-box-cont">
                                                    <img src="asset/img/check.png">
                                                    <label data-token="${item.value}" class="form-check-labels ">
                                                     ${$(this).attr('data-name')}
                                                    </label>
                                                </div>`;
              });
                $('.check_cont').html(selectedServiceElement);
                isServiceSelected = true;
            }else{
                $('.check-service-set').after(`<div><span><img src="asset/images/required-icon.png" class="required-icon service-error">Select atleast one service </span></div>`);
            }
            if(selectedAirportElementLength > 0){
                selectedAirportsArray.forEach((item,index) => {
                    selectedAirportElement += `<li data-token = "${item.airportToken}">
                                                <p>${index+1}) (${item.airportCode}) ${item.airportName} </p>
                                            </li>`;

                });
                $('.chosen-airport-lists').html(selectedAirportElement); 
                isAirportSelected = true;
            }else{
                $('.location-set').after(`<div><span><img src="asset/images/required-icon.png" class="required-icon service-error">Select atleast one Airport </span></div>`);
            }

        if( isServiceSelected == true && isAirportSelected == true ){
            is_set_servicelocations = true;
            $('#service_location_Details_value').addClass('completed');
            $('#doument_detail_value').click();
        }
    }
        
    function distributor_airports(){
        $(".check-service-set input[type='checkbox']:checked").each(function (index,item){
            let serviceToken = item.value;
            let serviceObj = {
                                "businessTypeToken": serviceToken,
                                "airportToken":[]
                             }
            serviceLocationsArray.map((servicelocation,index)=>{
                if(serviceToken == servicelocation.token){
                    servicelocation.airports.map((airports,index)=>{
                        selectedAirportsArray.map((selectedairports,index)=>{
                            if(selectedairports.airport.airportToken == airports.airportToken){
                                serviceObj.airportToken.push(`${selectedairports.airport.airportToken}`)
                            }
                        })

                    });
                }
            });
            distributorAirports.push(serviceObj);
        });
    }
    
    // For S3 bucket
    var image_id = [];
    function image_upload_loop(key){
        console.log(image_id);
        var checkkey = key+1;
        
        if(checkkey>image_id.length){
           go_to_dashboard();
        }else{
            if(!edited_doc.includes(image_id[key])){
                var fileUpload = document.getElementById(image_id[key]);
                var file = fileUpload.files[0];
                s3_file_upload(file, key); 
            }else{
                key++;
                image_upload_loop(key);
            }
        }
    }    
     
    function s3_file_upload(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds+key+'.'+extension;
        var folder = 'service_distributor/documents/';
        var objKey = folder + filename;
        var params = {
            Key: objKey,
            ContentType: file.type,
            Body: file,
            
        };
        bucket.putObject(params, function (err, data) {
            if (err) {
                alert('ERROR: ' + err);
                $('.onboardsubmit').prop('disabled',false);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#valid_"+image_id[key]).val(image_fileurl);
                key++;
                image_upload_loop(key);
            }
        });
    }

    function ValidateFileUpload(id) {
        var fuData = document.getElementById(id).files[0].name;
        var fileUpload = document.getElementById(id);
        let file =  document.getElementById(id).files[0];
        var FileUploadPath1 = fuData.split('.').pop().toLowerCase();
        let fileReader = new FileReader(); 
            if (fuData == '') {
                    swal("Please upload an image");
            }else{
                if(FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg" || FileUploadPath1 == "pdf"){
                    if(id == 'pan_card'){
                        if (file.type != "application/pdf") {
                          const [file_pan_card] = pan_card.files
                          if (file_pan_card) {
                            view_pancard.src = URL.createObjectURL(file_pan_card);
                            $('#view_pancard_pdf').hide();
                            $('#view_pancard_pdf').attr("src", "");
                            $('#view_pancard').show();
                            $('#edit_pan_card').val('1');
                          }   
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_pancard').hide();
                                $('#view_pancard').attr("src","");
                                $('#view_pancard_pdf').attr("src", e.target.result);
                                $('#view_pancard_pdf').show();
                                $('#edit_pan_card').val('1');
                            };
                        }
                       $('#pan_card_upload_file').show(); 
                       image_id.push("pan_card");
                       if(edited_doc.includes("pan_card")){
                            index = edited_doc.indexOf('pan_card'); 
                            edited_doc.splice(index, 1); 
                       }
                    }
                    if(id == 'gst_certificate'){
                        if (file.type != "application/pdf") {
                          const [file_gst_certificate] = gst_certificate.files
                          if (file_gst_certificate) {
                            view_gst.src = URL.createObjectURL(file_gst_certificate);
                            $('#view_gst_pdf').hide();
                            $('#view_gst_pdf').attr("src", "");
                            $('#view_gst').show();
                            $("#edit_gst_certificate").val('1');
                          }   
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_gst').hide();
                                $('#view_gst').attr("src","");
                                $('#view_gst_pdf').attr("src", e.target.result);
                                $('#view_gst_pdf').show();
                                $("#edit_gst_certificate").val('1');
                            };
                        }
                        $('#gst_certificate_upload_file').show(); 
                        image_id.push("gst_certificate");
                        if(edited_doc.includes("gst_certificate")){
                            index = edited_doc.indexOf('gst_certificate'); 
                            edited_doc.splice(index, 1); 
                        }
                    }
                    if(id == 'file1'){
                        if (file.type != "application/pdf") {
                          const [file_msme] = file1.files
                          if (file_msme) {
                            view_msme.src = URL.createObjectURL(file_msme);
                            $('#view_msme_pdf').hide();
                            $('#view_msme_pdf').attr("src", "");
                            $('#view_msme').show();
                            $("#edit_file1").val('1');
                          }
                        } else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_msme').hide();
                                $('#view_msme').attr("src","");
                                $('#view_msme_pdf').attr("src", e.target.result);
                                $('#view_msme_pdf').show();
                                $("#edit_file1").val('1');
                            };
                        }
                       $('#msme_certificate_upload_file').show();  
                        image_id.push("file1");
                        if(edited_doc.includes("file1")){
                            index = edited_doc.indexOf('file1'); 
                            edited_doc.splice(index, 1); 
                        }
                    }
                    if(id == 'file2'){
                        if (file.type != "application/pdf") {
                          const [file_incorporation] = file2.files
                          if (file_incorporation) {
                            view_incorporation.src = URL.createObjectURL(file_incorporation);
                            $('#view_incorporation_pdf').hide();
                            $('#view_incorporation_pdf').attr("src", "");
                            $('#view_incorporation').show();
                            $("#edit_file2").val('1');
                          }
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_incorporation').hide();
                                $('#view_incorporation').attr("src","");
                                $('#view_incorporation_pdf').attr("src", e.target.result);
                                $('#view_incorporation_pdf').show();
                                $("#edit_file2").val('1');
                            };
                        }
                      $('#incorporation_upload_file').show(); 
                      image_id.push("file2");
                      if(edited_doc.includes("file2")){
                            index = edited_doc.indexOf('file2'); 
                            edited_doc.splice(index, 1); 
                       }
                    }
                    if(id == 'void_cheque'){
                        if (file.type != "application/pdf") {
                          const [file_void_cheque] = void_cheque.files
                          if (file_void_cheque) {
                            view_void_cheque.src = URL.createObjectURL(file_void_cheque);
                            $('#view_void_cheque_pdf').hide();
                            $('#view_void_cheque_pdf').attr("src", "");
                            $('#view_void_cheque').show();
                            $("#edit_void_cheque").val('1');
                          }
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_void_cheque').hide();
                                $('#view_void_cheque').attr("src","");
                                $('#view_void_cheque_pdf').attr("src", e.target.result);
                                $('#view_void_cheque_pdf').show();
                                $("#edit_void_cheque").val('1');
                            };
                        }
                        $('#void_cheque_upload_file').show(); 
                        image_id.push("void_cheque");
                        if(edited_doc.includes("void_cheque")){
                            index = edited_doc.indexOf('void_cheque'); 
                            edited_doc.splice(index, 1); 
                        } 
                    }
                    if(id == 'ca_card'){
                        if (file.type != "application/pdf") {
                          const [file_ca_card] = ca_card.files
                          if (file_ca_card) {
                            view_ca_card.src = URL.createObjectURL(file_ca_card);
                            $('#view_ca_card_pdf').hide();
                            $('#view_ca_card_pdf').attr("src", "");
                            $('#view_ca_card').show();
                            $("#edit_ca_card").val('1');
                          }
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_ca_card').hide();
                                $('#view_ca_card').attr("src","");
                                $('#view_ca_card_pdf').attr("src", e.target.result);
                                $('#view_ca_card_pdf').show();
                                $("#edit_ca_card").val('1');
                            };
                        }
                        $('#contract_agreement_upload_file').show();  
                        image_id.push("ca_card");
                        if(edited_doc.includes("ca_card")){
                            index = edited_doc.indexOf('ca_card'); 
                            edited_doc.splice(index, 1); 
                        }
                    }
                    if(id == 'other_doc1'){
                        if (file.type != "application/pdf") {
                          const [file_other_doc1] = other_doc1.files
                          if (file_other_doc1) {
                            view_other_doc1.src = URL.createObjectURL(file_other_doc1);
                            $('#view_other_doc1_pdf').hide();
                            $('#view_other_doc1_pdf').attr("src", "");
                            $('#view_other_doc1').show();
                            $("#edit_other_doc1").val('1');
                          }
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_other_doc1').hide();
                                $('#view_other_doc1').attr("src","");
                                $('#view_other_doc1_pdf').attr("src", e.target.result);
                                $('#view_other_doc1_pdf').show();
                                $("#edit_other_doc1").val('1');
                            };
                        }
                        $('#other_document_upload_file1').show(); 
                        image_id.push("other_doc1");
                        if(edited_doc.includes("other_doc1")){
                            index = edited_doc.indexOf('other_doc1'); 
                            edited_doc.splice(index, 1); 
                        }
                    }
                    if(id == 'other_doc2'){
                        if (file.type != "application/pdf") {
                          const [file_other_doc2] = other_doc2.files
                          if (file_other_doc2) {
                            view_other_doc2.src = URL.createObjectURL(file_other_doc2);
                            $('#view_other_doc2_pdf').hide();
                            $('#view_other_doc2_pdf').attr("src", "");
                            $('#view_other_doc2').show();
                            $("#edit_other_doc2").val('1');
                          }
                        }else if(file.type == "application/pdf"){
                            fileReader.readAsDataURL(fileUpload.files[0]);
                            fileReader.onload = function(e) {
                                $('#view_other_doc2').hide();
                                $('#view_other_doc2').attr("src","");
                                $('#view_other_doc2_pdf').attr("src", e.target.result);
                                $('#view_other_doc2_pdf').show();
                                $("#edit_other_doc2").val('1');
                            };
                        }
                        $('#other_document_upload_file2').show();  
                        image_id.push("other_doc2");
                        if(edited_doc.includes("other_doc2")){
                            index = edited_doc.indexOf('other_doc2'); 
                            edited_doc.splice(index, 1); 
                        }
                    }
                    $('#document_not_uploaded').hide();
                    field_validation();
                    //is_set_document = true;
                }else{
                    swal("Photo only allows file types of  PNG, JPG, JPEG and PDF. ");
                }
          }
    }

    function field_validation(){
        // debugger;
        var panImage = document.querySelector('#after_pan_card');
        var panImage1 = document.querySelector('#before_pan_card');
        var gstImage = document.querySelector('#after_gst_card');
        var gstImage1 = document.querySelector('#before_gst_card');
        var msmeImage = document.querySelector('#after_msme_card');
        var msmeImage1 = document.querySelector('#before_msme_card');
        var incorporationImage = document.querySelector('#after_incorporation_card');
        var incorporationImage1 = document.querySelector('#before_incorporation_card');
        var void_chequeImage1 =  document.getElementById('before_void_cheque');
        var void_chequeImage =  document.getElementById('after_void_cheque');
        var ca_cardImage1 = document.getElementById('before_ca_card');
        var ca_cardImage = document.getElementById('after_ca_card');
        var before_other_doc1 = document.getElementById('before_other_doc1');
        var after_other_doc1 = document.getElementById('after_other_doc1');
        var before_other_doc2 = document.getElementById('before_other_doc2');
        var after_other_doc2 = document.getElementById('after_other_doc2');

        var pan_card = document.getElementById('edit_pan_card').value;
        var gst_certificate = document.getElementById('edit_gst_certificate').value;
        var file1 = document.getElementById('edit_file1').value;
        var file2 = document.getElementById('edit_file2').value;
        var void_cheque =  document.getElementById('edit_void_cheque').value;
        var ca_card =  document.getElementById('edit_ca_card').value;
        var other_doc1 =  document.getElementById('edit_other_doc1').value;
        var other_doc2 =  document.getElementById('edit_other_doc2').value;

        if (pan_card != '') {
            panImage.style.display = 'flex'; 
            panImage1.style.display = 'none'; 
        }else{
             panImage.style.display = 'none'; 
             panImage1.style.display = 'flex';
        }
        if (gst_certificate != '') {
            gstImage.style.display = 'flex'; 
            gstImage1.style.display = 'none'; 
        } else {
            gstImage.style.display = 'none'; 
            gstImage1.style.display = 'flex';
        }
        if (file1 != '') {
            msmeImage.style.display = 'flex'; 
            msmeImage1.style.display = 'none';
        } else{
            msmeImage.style.display = 'none'; 
            msmeImage1.style.display = 'flex';
        }
        if (file2 != '') {
            incorporationImage.style.display = 'flex'; 
            incorporationImage1.style.display = 'none';
        }else{
            incorporationImage.style.display = 'none'; 
            incorporationImage1.style.display = 'flex';
        }
        if (void_cheque != '') {
            void_chequeImage.style.display = 'flex'; 
            void_chequeImage1.style.display = 'none';
        }else{
            void_chequeImage.style.display = 'none'; 
            void_chequeImage1.style.display = 'flex';
        }
        if (ca_card != '') {
            ca_cardImage.style.display = 'flex'; 
            ca_cardImage1.style.display = 'none';
        }else{
            ca_cardImage.style.display = 'none'; 
            ca_cardImage1.style.display = 'flex';
        }
        if(other_doc1 != ''){
            after_other_doc1.style.display = 'flex'; 
            before_other_doc1.style.display = 'none';
        }else{
            before_other_doc1.style.display = 'flex'; 
            after_other_doc1.style.display = 'none';
        }
        if(other_doc2 != ''){
            after_other_doc2.style.display = 'flex'; 
            before_other_doc2.style.display = 'none';
        }else{
            before_other_doc2.style.display = 'flex'; 
            after_other_doc2.style.display = 'none';
        }
    }

    // function field_validations(){
    //     // debugger;
    //     var panImage = document.querySelector('#after_pan_card');
    //     var panImage1 = document.querySelector('#before_pan_card');
    //     var gstImage = document.querySelector('#after_gst_card');
    //     var gstImage1 = document.querySelector('#before_gst_card');
    //     var msmeImage = document.querySelector('#after_msme_card');
    //     var msmeImage1 = document.querySelector('#before_msme_card');
    //     var incorporationImage = document.querySelector('#after_incorporation_card');
    //     var incorporationImage1 = document.querySelector('#before_incorporation_card');
    //     var void_chequeImage1 =  document.getElementById('before_void_cheque');
    //     var void_chequeImage =  document.getElementById('after_void_cheque');
    //     var ca_cardImage1 = document.getElementById('before_ca_card');
    //     var ca_cardImage = document.getElementById('after_ca_card');
    //     var before_other_doc1 = document.getElementById('before_other_doc1');
    //     var after_other_doc1 = document.getElementById('after_other_doc1');
    //     var before_other_doc2 = document.getElementById('before_other_doc2');
    //     var after_other_doc2 = document.getElementById('after_other_doc2');

    //     var pan_card = document.getElementById('pan_card').value;
    //     var gst_certificate = document.getElementById('gst_certificate').value;
    //     var file1 = document.getElementById('file1').value;
    //     var file2 = document.getElementById('file2').value;
    //     var void_cheque =  document.getElementById('void_cheque').value;
    //     var ca_card =  document.getElementById('ca_card').value;
    //     var other_doc1 =  document.getElementById('other_doc1').value;
    //     var other_doc2 =  document.getElementById('other_doc2').value;

    //     if (pan_card != '') {
    //         panImage.style.display = 'flex'; 
    //         panImage1.style.display = 'none'; 
    //     }else{
    //          panImage.style.display = 'none'; 
    //          panImage1.style.display = 'flex';
    //     }
    //     if (gst_certificate != '') {
    //         gstImage.style.display = 'flex'; 
    //         gstImage1.style.display = 'none'; 
    //     } else {
    //         gstImage.style.display = 'none'; 
    //         gstImage1.style.display = 'flex';
    //     }
    //     if (file1 != '') {
    //         msmeImage.style.display = 'flex'; 
    //         msmeImage1.style.display = 'none';
    //     } else{
    //         msmeImage.style.display = 'none'; 
    //         msmeImage1.style.display = 'flex';
    //     }
    //     if (file2 != '') {
    //         incorporationImage.style.display = 'flex'; 
    //         incorporationImage1.style.display = 'none';
    //     }else{
    //         incorporationImage.style.display = 'none'; 
    //         incorporationImage1.style.display = 'flex';
    //     }
    //     if (void_cheque != '') {
    //         void_chequeImage.style.display = 'flex'; 
    //         void_chequeImage1.style.display = 'none';
    //     }else{
    //         void_chequeImage.style.display = 'none'; 
    //         void_chequeImage1.style.display = 'flex';
    //     }
    //     if (ca_card != '') {
    //         ca_cardImage.style.display = 'flex'; 
    //         ca_cardImage1.style.display = 'none';
    //     }else{
    //         ca_cardImage.style.display = 'none'; 
    //         ca_cardImage1.style.display = 'flex';
    //     }
    //     if(other_doc1 != ''){
    //         after_other_doc1.style.display = 'flex'; 
    //         before_other_doc1.style.display = 'none';
    //     }else{
    //         before_other_doc1.style.display = 'flex'; 
    //         after_other_doc1.style.display = 'none';
    //     }
    //     if(other_doc2 != ''){
    //         after_other_doc2.style.display = 'flex'; 
    //         before_other_doc2.style.display = 'none';
    //     }else{
    //         before_other_doc2.style.display = 'flex'; 
    //         after_other_doc2.style.display = 'none';
    //     }
    // }
        
    function clearImageData(id){
        if(id == 'pan_card'){
            document.getElementById('before_pan_card').value = '';
            document.getElementById('valid_pan_card').value = '';
            document.getElementById('pan_card').value = '';
            document.getElementById('edit_pan_card').value = '';
            document.getElementById('after_pan_card').value = '';
            // document.getElementById('panImage').value = '';
            document.getElementById('view_pancard').value = '';
            document.getElementById("pan_card_upload_file").style.display = "none";
            if(image_id.includes("pan_card")){
               index = image_id.indexOf('pan_card'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("pan_card")){
               index = edited_doc.indexOf('pan_card'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'gst_certificate'){
            document.getElementById('before_gst_card').value = '';
            document.getElementById('valid_gst_certificate').value = '';
            document.getElementById('gst_certificate').value = '';
            document.getElementById('edit_gst_certificate').value = '';
            document.getElementById('after_gst_card').value = '';
            document.getElementById('view_gst').value = '';
            document.getElementById("gst_certificate_upload_file").style.display = "none";
            if(image_id.includes("gst_certificate")){
               index = image_id.indexOf('gst_certificate'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("gst_certificate")){
               index = edited_doc.indexOf('gst_certificate'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'file1'){
            document.getElementById('before_msme_card').value = '';
            document.getElementById('valid_file1').value = '';
            document.getElementById('file1').value = '';
            document.getElementById('edit_file1').value = '';
            document.getElementById('after_msme_card').value = '';
            document.getElementById('view_msme').value = '';
            document.getElementById("msme_certificate_upload_file").style.display = "none";
            if(image_id.includes("file1")){
               index = image_id.indexOf('file1'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("file1")){
               index = edited_doc.indexOf('file1'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'file2'){
            document.getElementById('before_incorporation_card').value = '';
            document.getElementById('valid_file2').value = '';
            document.getElementById('file2').value = '';
            document.getElementById('edit_file2').value = '';
            document.getElementById('after_incorporation_card').value = '';
            document.getElementById('view_incorporation').value = '';
            document.getElementById("incorporation_upload_file").style.display = "none";
            if(image_id.includes("file2")){
               index = image_id.indexOf('file2'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("file2")){
               index = edited_doc.indexOf('file2'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'void_cheque'){ 
            document.getElementById('before_void_cheque').value = '';
            document.getElementById('valid_void_cheque').value = '';
            document.getElementById('void_cheque').value = '';
            document.getElementById('edit_void_cheque').value = '';
            document.getElementById('after_void_cheque').value = '';
            document.getElementById('view_void_cheque').value = '';
            document.getElementById("void_cheque_upload_file").style.display = "none";
            if(image_id.includes("void_cheque")){
               index = image_id.indexOf('void_cheque'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("void_cheque")){
               index = edited_doc.indexOf('void_cheque'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'ca_card'){
            document.getElementById('before_ca_card').value = '';
            document.getElementById('valid_ca_card').value = '';
            document.getElementById('ca_card').value = '';
            document.getElementById('edit_ca_card').value = '';
            document.getElementById('after_ca_card').value = '';
            document.getElementById('view_ca_card').value = '';
            document.getElementById("contract_agreement_upload_file").style.display = "none";
            if(image_id.includes("ca_card")){
               index = image_id.indexOf('ca_card'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("ca_card")){
               index = edited_doc.indexOf('ca_card'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'other_doc1'){
            document.getElementById('before_other_doc1').value = '';
            document.getElementById('valid_other_doc1').value = '';
            document.getElementById('other_doc1').value = '';
            document.getElementById('edit_other_doc1').value = '';
            document.getElementById('after_other_doc1').value = '';
            document.getElementById('view_other_doc1').value = '';
            document.getElementById("other_document_upload_file1").style.display = "none";
            if(image_id.includes("other_doc1")){
               index = image_id.indexOf('other_doc1'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("other_doc1")){
               index = edited_doc.indexOf('other_doc1'); 
               edited_doc.splice(index, 1); 
            }
        }
        if(id == 'other_doc2'){
            document.getElementById('before_other_doc2').value = '';
            document.getElementById('valid_other_doc2').value = '';
            document.getElementById('other_doc2').value = '';
            document.getElementById('edit_other_doc2').value = '';
            document.getElementById('after_other_doc2').value = '';
            document.getElementById('view_other_doc2').value = '';
            document.getElementById("other_document_upload_file2").style.display = "none";
            if(image_id.includes("other_doc2")){
               index = image_id.indexOf('other_doc2'); 
               image_id.splice(index, 1); 
            }
            if(edited_doc.includes("other_doc2")){
               index = edited_doc.indexOf('other_doc2'); 
               edited_doc.splice(index, 1); 
            }
        }
        field_validation();
    }

    function upload_image_page(){
        var pan_card = document.getElementById('edit_pan_card').value;
        var gst_certificate = document.getElementById('edit_gst_certificate').value;
        var file1 = document.getElementById('edit_file1').value;
        var file2 = document.getElementById('edit_file2').value;
        var void_cheque = document.getElementById('edit_void_cheque').value;
        var ca_card = document.getElementById('edit_ca_card').value;
        var other_doc1 = document.getElementById('edit_other_doc1').value;
        var other_doc2 = document.getElementById('edit_other_doc2').value;
        var gst_number = document.getElementById('gst_number').value;
        var pan_number = document.getElementById('pan_number').value;
            if($('.declare input[type="checkbox"]').is(":checked")){
                $('#review_value').click();
                $('#doument_detail_value').addClass('completed');
                $("#get_gstNumber").text(gst_number);
                $("#get_panNumber").text(pan_number);
                if((pan_card == '' || pan_card == null) && (gst_certificate == '' || gst_certificate == null) && (file1 == '' || file1 == null) && (file2 == '' || file2 == null) && (void_cheque == '' || void_cheque == null) && (ca_card == '' || ca_card == null) && (other_doc1 == '' || other_doc1 == null) && (other_doc2 == '' || other_doc2 == null)){
                    $('#document_not_uploaded').show();
                }
            } else{
                swal('Click to agree');
            }
    }
    // function upload_image_pages(){
    //     var pan_card = document.getElementById('pan_card').value;
    //     var gst_certificate = document.getElementById('gst_certificate').value;
    //     var file1 = document.getElementById('file1').value;
    //     var file2 = document.getElementById('file2').value;
    //     var void_cheque = document.getElementById('void_cheque').value;
    //     var ca_card = document.getElementById('ca_card').value;
    //     var other_doc1 = document.getElementById('other_doc1').value;
    //     var other_doc2 = document.getElementById('other_doc2').value;
    //     var gst_number = document.getElementById('gst_number').value;
    //     var pan_number = document.getElementById('pan_number').value;
    //         if($('.declare input[type="checkbox"]').is(":checked")){
    //             $('#review_value').click();
    //             $('#doument_detail_value').addClass('completed');
    //             $("#get_gstNumber").text(gst_number);
    //             $("#get_panNumber").text(pan_number);
    //             if((pan_card == '' || pan_card == null) && (gst_certificate == '' || gst_certificate == null) && (file1 == '' || file1 == null) && (file2 == '' || file2 == null) && (void_cheque == '' || void_cheque == null) && (ca_card == '' || ca_card == null) && (other_doc1 == '' || other_doc1 == null) && (other_doc2 == '' || other_doc2 == null)){
    //                 $('#document_not_uploaded').show();
    //             }
    //         } else{
    //             swal('Click to agree')
    //         }
    // }
        
    function onboard_submit(){
        $('.onboardsubmit').prop('disabled',true);
            if((is_set_business ==true) && (is_set_bank_info == true) && (is_set_servicelocations == true)){
                image_upload_loop(0);
            }else{
                 swal("Complete All Sections");
                 $('.onboardsubmit').prop('disabled',false);
            }
    }
    let distributorAirports = [];
    // go to dashboard
    function go_to_dashboard() {
        if((is_set_business ==true) && (is_set_bank_info == true) && (is_set_servicelocations == true)){
            let countryText = $('#phone_mobileno .iti__selected-flag').attr("title").split(" ");
            let countryTextIndex = countryText.length -1;
            let countryCode = countryText[countryTextIndex];
            let altCountryText = $('#mobile_alt_no .iti__selected-flag').attr("title").split(" ");
            let altCountryTextIndex = altCountryText.length - 1;
            let altCountryCode = altCountryText[altCountryTextIndex];
            let distributor_id = localStorage.getItem('distributorToken'); 
            let userToken =  localStorage.getItem('userToken');
            var business_name = document.getElementById('get_business_name_value').innerHTML;
            var business_type = document.getElementById('get_business_type').innerHTML;
            var business_type_id = document.getElementById('select_reason_business').value;
            var business_info_website = document.getElementById('get_business_website').innerHTML;
            var primary_business_type = document.getElementById('get_primary_business_type').innerHTML;
            var primary_mobile_no = document.getElementById('mobile_no').value;
            var primary_business_website = document.getElementById('get_primary_business_website').innerHTML;
            var alternative_mobile_number = document.getElementById('get_primary_alt_phone_number').innerHTML;
           // var business_website_email = document.getElementById('business_website').value;
            var alternative_email = document.getElementById('get_primary_alt_email').innerHTML;
            var address = document.getElementById('get_address_value').innerHTML;
            var country = document.getElementById('get_country_value').innerHTML;
            var select_country_id = document.getElementById('select_reason_country').value;
            var state = document.getElementById('get_state_value').innerHTML;
            var select_state_id = document.getElementById('select_reason_state').value;
            var city = document.getElementById('get_city_value').innerHTML;
            var select_city_id = document.getElementById('select_reason_city').value;
            var pincode = document.getElementById('get_pincode').innerHTML;
            var account_number = document.getElementById('get_acc_number').innerHTML;
            var ifsc_code = document.getElementById('get_ifsc_code').innerHTML;
            var bank_branch = document.getElementById('get_branch_value').innerHTML;
            var bank_city = document.getElementById('get_bank_city').innerHTML;
            var pan_card_image =  document.getElementById('valid_pan_card').value;
            var gst_image =  document.getElementById('valid_gst_certificate').value;
            var gst_msme =  document.getElementById('valid_file1').value;
            var incorporation_image = document.getElementById('valid_file2').value;
            var void_chequeImage = document.getElementById('valid_void_cheque').value;
            var ca_cardImage = document.getElementById('valid_ca_card').value;
            var other_doc1 = document.getElementById('valid_other_doc1').value;
            var other_doc2 = document.getElementById('valid_other_doc2').value;
            var gst_number = document.getElementById('get_gstNumber').innerHTML;
             var pan_number = document.getElementById('get_panNumber').innerHTML;
            //amended datas
            let businessTypeTokens = [];
            let airportTokens = [];
            $(".check-service-set input[type='checkbox']:checked").each(function (index,item){
                businessTypeTokens.push(item.value);
            });
            selectedAirportsArray.forEach((item,index) => {
                airportTokens.push(`${item.airportToken}`);
            });


            var datas =  {
                            "distributorToken":distributor_id,
                            "userToken":userToken,
                            "name":business_name,
                            "siteName":business_info_website,
                            "distirbutorTypeToken":business_type_id,
                            "primaryEmail":primary_business_website,
                            "countryCode":countryCode,
                            "primaryMobileNumber": primary_mobile_no,
                            "alternateEmail": alternative_email,
                            "alternateCountryCode":altCountryCode,
                            "alternateMobileNumber":alternative_mobile_number,
                            "address":address,
                            "countryId":select_country_id,
                            "stateId": select_state_id,
                            "cityId":select_city_id,
                            "pincode":pincode,
                            "accountNumber":account_number,
                            "ifscCode":ifsc_code,
                            "branch":bank_branch,
                            "city":bank_city,
                            "panCard":pan_card_image,
                            "gstCertificate":gst_image,
                            "msmeCertificate":gst_msme,
                            "incorporationCertificate":incorporation_image,
                            "voideCheque":void_chequeImage,
                            "contractAgreement":ca_cardImage,
                            "businessTypeTokens":businessTypeTokens,
                            "airportTokens":airportTokens,
                            "otherDocumentOne":other_doc1,
                            "otherDocumentTwo":other_doc2,
                            "gstNumber":gst_number,
                            "panNumber":pan_number
                        };
                    var json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url:apiPath+"/distributor/updateDistributorOnboard.php",
                    data: json1
                    }).done(function(data1){
                        if(data1.status_code == 201){
                            localStorage.setItem("onboarded",true);
                            window.location = "booking.php";
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });
                                $('.onboardsubmit').prop('disabled',false);
                        }
                    });
        }else{
            swal("fill all detail");
        }
    }

    $('body').on('click','#logout',function(){
        localStorage.clear();
        window.location.replace('login.php');
    });
    
    </script>
</body>

</html>