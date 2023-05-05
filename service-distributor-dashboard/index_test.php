

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>White labelling onboarding</title>
    <link rel="shortcut icon" href="./asset/img/airportzo-icon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/onbord-css/common.css">
    <link rel="stylesheet" href="css/onbord-css/personal_info.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css">
    <link rel="stylesheet" href="css/onbord-css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/onbord-css/bootstrap-datetimepicker.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/personal_info.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->
</head>

<style type="text/css">

    .validation-text{
            visibility: hidden;

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
                        <li class="side-menu-tab active" toggle-target="business_info">Business Info <span class="completed_tick"></span><span class="active_pointer"></span></li> <!-- completed, active -->
                        <li class="side-menu-tab" id="bank_detail_value" toggle-target="bank_detail">Bank Details <span class="completed_tick"></span><span class="active_pointer"></span></li>
                        <!-- <li class="side-menu-tab" toggle-target="service_location_Details">Service and Locations <span class="completed_tick"></span><span class="active_pointer"></span></li> -->
                        <li class="side-menu-tab" id="doument_detail_value" toggle-target="doument_detail">Documents <span class="completed_tick"></span><span class="active_pointer"></span></li>
                        <li class="side-menu-tab" id = "review_value" toggle-target="review">Review <span class="completed_tick"></span><span class="active_pointer"></span></li>
                    </ul>
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
                                        <input type="text" class="input-box" id="business_name" placeholder="Enter...">
                                    </div>
                                </div>
                                <div class="validation-text" id="business_name_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Name</p>
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
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter Business Type</p>
                                </div>
                            </div>
                            <div class="text-box-group">
                                <div class="input-form-group-item">
                                    <div class="input-box-set">
                                        <label for="business_website">Business Website</label>
                                        <input type="text" class="input-box" id="business_website_info" placeholder="Enter...">
                                        
                                    </div>
                                </div>
                                <div class="validation-text" id="business_website_info_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                                        <input type="tel" class="login-input-box" id="mobile_no" name="phone"  />
                                    </div>
                                </div>
                            </div>
                             <div class="validation-text" id="mobile_no_validate">
                                    <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                            </div>


                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="business_website">Email Address</label>
                                    <input type="email" class="input-box" id="business_website" placeholder="Enter...">
                                </div>
                            </div>
                            <div class="validation-text" id="business_website_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                            </div>

                            <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="login-input-action-set" id="mobile_alt_no">
                                    <div class="login-input-group phone">
                                        <label for="alt_mobile_no">Alternative Mobile Number</label>
                                        <input type="tel" class="login-input-box" id="alt_mobile_no" name="phone"  />
                                    </div>
                                </div>
                            </div>
                            <div class="validation-text" id="alt_mobile_no_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                            </div>

                             <div class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="business_website">Alternative Email Address</label>
                                    <input type="email" class="input-box" id="primary_business_website" placeholder="Enter...">
                                </div>
                            </div>
                             <div class="validation-text" id="primary_business_website_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                                    <input type="text" class="input-box" id="address" placeholder="Enter...">
                                </div>
                            </div>
                             <div class="validation-text" id="address_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                        </div>

                         <div class="text-box-group">
                            <div class="input-form-group-item">
                                <!-- bg-arrow -->
                                <div class="input-box-set">
                                    <label for="select_reason">City</label>
                                    <select class="select-input" id="select_reason_city">
                                        <option value="0">select option</option>
                                        <!-- <option value="1">-</option>
                                        <option value="2">-</option>
                                        <option value="3">-</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="validation-text" id="city_validate">
                                    <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                        </div>

                            <div  class="text-box-group">
                            <div class="input-form-group-item">
                                <div class="input-box-set">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="input-box" id="pincode" placeholder="Enter..." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                            </div>
                            <div class="validation-text" id="pincode_validate">
                                     <p><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                                        <input type="text" class="input-box" id="acc_number" placeholder="Enter...">
                                    </div>
                                </div>
                                <p class="validation-text" id="acc_number_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                            </div>
                            <div class="input-form-group-required-item">
                                <!--required-->
                                <div class="input-form-group-item1">
                                    <div class="input-box-set">
                                        <label for="re_enter_ac_no">Re-enter account number</label>
                                        <input type="text" class="input-box" id="re_enter_ac_no" placeholder="Enter...">
                                    </div>
                                </div>
                                <p class="validation-text" id="re_enter_ac_no_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1">
                                    <div class="input-box-set">
                                        <label for="ifsc_code">IFSC Code</label>
                                        <input type="text" class="input-box" id="ifsc_code" placeholder="Enter..." oninput="ifsc_function()" value="BKID0008225">
                                    </div>
                                </div>
                                 <p class="validation-text" id = "ifsc_code_validate"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1 disabled">
                                    <div class="input-box-set">
                                        <label for="branch">Branch</label>
                                        <input type="text" class="input-box" id="bank_branch" placeholder="Enter..." disabled>
                                    </div>
                                </div>
                                 <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                            </div>
                            <div class="input-form-group-required-item">
                                <div class="input-form-group-item1 disabled">
                                    <div class="input-box-set">
                                        <label for="city">City</label>
                                        <input type="text" class="input-box" id="bank_city" placeholder="Enter..." disabled>
                                    </div>
                                </div>
                                 <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
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
                        <div class="check-service-set">
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="meet_assist">
                                <label for="meet_assist" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Meet & Assist
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="Loung">
                                <label for="Loung" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Loung
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="food_service">
                                <label for="Loung" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Food Service
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="baggage_porter">
                                <label for="baggage_porter" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Baggage Porter
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="airport_transfer">
                                <label for="airport_transfer" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Airport Transfer
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="Ttranslaters">
                                <label for="Ttranslaters" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Translaters
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="chauffeur">
                                <label for="chauffeur" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Chauffeur
                                </label>
                            </div>
                            <div class="check-service-items">
                                <input type="checkbox" class="check-box hidden" id="visa_assistance">
                                <label for="visa_assistance" class="checkbox-label">
                                    <span class="cust-check-box"></span>
                                    Visa Assistance
                                </label>
                            </div>
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
                                        <a class="add-link" href="javascript:void(0)">Add all</a>
                                    </div>
                                    <p class="airport-count">562 Airports</p>
                                    <div class="filter-input-box">
                                        <input type="text" class="search-box" placeholder="Search airports">
                                        <img src="asset/images/search-icon.png" alt="search icon" class="search-icon">
                                    </div>
                                </div>
                                <div class="filter-list-items">
                                    <ul>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="add-link" href="javascript:void()">Add</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="add-link" href="javascript:void()">Add</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="add-link" href="javascript:void()">Add</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="add-link" href="javascript:void()">Add</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="location-filter-box">
                                <div class="filter-header">
                                    <div class="filter-title">
                                        <h4>Total Airports</h4>
                                        <a class="remove-link" href="javascript:void(0)">Remove all</a>
                                    </div>
                                    <p class="airport-count">562 Airports</p>
                                    <div class="filter-input-box">
                                        <input type="text" class="search-box" placeholder="Search airports">
                                        <img src="asset/images/search-icon.png" alt="search icon" class="search-icon">
                                    </div>
                                </div>
                                <div class="filter-list-items">
                                    <ul>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="remove-link" href="javascript:void()">Remove</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="remove-link" href="javascript:void()">Remove</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="remove-link" href="javascript:void()">Remove</a>
                                        </li>
                                        <li>
                                            <p>(AAL) Aalborg Airport</p>
                                            <a class="remove-link" href="javascript:void()">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-3">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        </a>
                    </div>
                </section>
                <section class="documents-sec sec-tab" id="doument_detail">
                    <div class="documents-set">
                        <div class="header-title">
                            <h2>Document</h2>
                        </div>
                        <div class="unserline-div"></div>


                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>PAN Card</h4>
                                <p>Upload your PAN card for verification</p>
                            </div>
                            <div class="pan_cont" id="before_pan_card">
                                <input id="valid_pan_card" type="hidden" >
                                <input type="file" id="pan_card" class="hidden"  onchange = "ValidateFileUpload('pan_card')">
                                <label for="pan_card">Uploaded PAN Card</label>
                            </div>


                            <div class="pan_uploaded_cont" id="after_pan_card" style="display: none !important;">
                                <div class="succes-icon-text">
                                    <img src="asset/images/tick-icon.png" id="panImage"  class="tick-icon">
                                    <p id="upload_pdf_image">Uploaded</p>
                                    <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('pan_card');" class="doc-close-icon">
                                    <!-- <label for="file1" id="uploaded_pdf_image1" class="pan_cont">Uploaded PAN Card Certificate</label> -->
                                </div>
                                <div>
                                    <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                            </div>
                        </div>



                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>GST Certificate</h4>
                                <p>Upload your GST Certificate for verification</p>
                            </div>

                            <div class="pan_cont" id="before_gst_card">
                                <input id="valid_gst_certificate" type="hidden" >
                                <input type="file" id="gst_certificate" class="hidden"  onchange = "ValidateFileUpload('gst_certificate')">
                                <label for="gst_certificate">Uploaded GST Certificate</label>
                            </div>


                            <div class="pan_uploaded_cont" id="after_gst_card" style="display: none !important;">
                                <div class="succes-icon-text">
                                    <img src="asset/images/tick-icon.png" id="gst_id" class="tick-icon">
                                    <p>Uploaded</p>
                                    <img src="asset/images/close.svg" onclick="clearImageData('gst_card');" class="doc-close-icon">
                                </div>
                                  <div>
                                <!--  <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p> -->
                            </div>
                        </div>

                        </div>




                            <div class="Upload_data_box">
                                <div class="pan_car_box">
                                    <h4>MSME Certificate</h4>
                                    <p>Upload your MSME Certificate for verification</p>
                                </div>
                            <div>
                            <div class="pan_cont" id="before_msme_card">
                                <input id="valid_file1" type="hidden" > 
                                <input type="file" id="file1" class="hidden"  onchange = "ValidateFileUpload('file1')">
                                <label for="file1">Uploaded MSME Certificate</label>
                            </div>
                            <div class="pan_uploaded_cont" id="after_msme_card" style="display: none !important;">
                                <div class="succes-icon-text">
                                    <img src="asset/images/tick-icon.png" id="panImage"  class="tick-icon">
                                    <p id="upload_pdf_image">Uploaded</p>
                                    <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('msme_card');" class="doc-close-icon">
                                    <!-- <label for="file1" id="uploaded_pdf_image1" class="pan_cont">Uploaded PAN Card Certificate</label> -->
                                </div>
                                <div>
                                    <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                </div>
                            </div>
                             <div>
                                 <!-- <p class="validation-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p> -->
                            </div>
                        </div>
                        </div>
                        <div class="Upload_data_box">
                            <div class="pan_car_box">
                                <h4>Certificate of Incorporation</h4>
                                <p>Upload your Certificate of Incorporation for verification</p>
                            </div>
                            <div class="">
                                <div class="pan_cont" id="before_incorporation_card">
                                    <input id="valid_file2" type="hidden" >
                                    <input type="file" id="file2" class="hidden" onchange = "ValidateFileUpload('file2')">
                                    <label for="file2">Uploaded Certificate of Incorporation</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_incorporation_card" style="display: none !important;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage"  class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('incorporation_card');"  class="doc-close-icon">
                                        <!-- <label for="file1" id="uploaded_pdf_image1" class="pan_cont">Uploaded PAN Card Certificate</label> -->
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
                                    I hereby declare that the information provided is true and corrent, I also understand that any <br>
                                    Willful dishonesty may render for refusal of this applicaton or immediate termination of this application.
                                </label>
                            </div>
                        </div>
                        <a class="nex-arrow-set" data-current="#step-1" data-next="#step-4">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow" onclick="upload_image_page();">
                        </a>
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
                                    <!-- <li class="tab-link" data-tab="3">Service and Locations</li> -->
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
                                                    <p>Business Type</p>
                                                    <h4 id="get_primary_business_type"></h4>
                                                </div>
                                                <div class="info-empty-card-items">
                                                    <p>Business Website</p>
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
                                            <button class="submit_btn" onclick="onboard_submit()">Submitt</button>
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
                                                <h4 id="get_branch_value">Velachery</h4>
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
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="all">
                                                <label class="form-check-labels " for="all">
                                                    Meet & Assist
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="set">
                                                <label class="form-check-labels " for="set">
                                                    Baggage Porter
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="send">
                                                <label class="form-check-labels " for="send">
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
                                      <!--   <div class="form_btn text-center">
                                            <button class="submit_btn" onclick="onboard_submit()">Submit</button>
                                        </div> -->
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-content">
                                    <div class="document-view">
                                        <div class="document-items">
                                            <div class="doc-set">
                                                <img src="#" alt="document file" id = "view_pancard" class="document-file">
                                            </div>
                                            <p class="file-name">PAN Card</p>
                                        </div>
                                        <div class="document-items">
                                            <div class="doc-set">
                                                <img src="#" id = "view_gst" alt="document file" class="document-file">
                                            </div>
                                            <p class="file-name">GST Certificate</p>
                                        </div>
                                        <div class="document-items">
                                            <div class="doc-set">
                                                <img src="#" id = "view_msme" alt="document file" class="document-file">
                                            </div>
                                            <p class="file-name">MSME Certificate</p>
                                        </div>
                                        <div class="document-items">
                                            <div class="doc-set">
                                                <img src="#" id = "view_incorporation" alt="document file" class="document-file">
                                            </div>
                                            <p class="file-name">Certificate of Incorporation</p>
                                        </div>
                                        <!-- <div class="document-items">
                                            <div class="doc-set">
                                                <img src="asset/images/document5.png" alt="document file" class="document-file">
                                            </div>
                                            <p class="file-name">PAN Card</p>
                                        </div> -->
                                        <!-- <div class="document-items">
                                            <div class="doc-set">
                                                <img src="asset/images/document6.png" alt="document file" class="document-file">
                                            </div>
                                            <p class="file-name">PAN Card</p>
                                        </div> -->
                                    </div>
                                      <div class="form_btn text-center">
                                            <button class="submit_btn" onclick="onboard_submit()">Submit</button>
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
        </div>
    </section>
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <!-- <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        var valid1 = true;
    // -----Country Code Selection
    // $("#mobile_code,#mobile_no,#alt_mobile_no").intlTelInput({
    //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    //     initialCountry: "in",
    //     // separateDialCode: true,
    // });



     var id = ["#mobile_code","#mobile_no","#alt_mobile_no"];
    id.forEach(function (value, i) {
        var mask = "";
        var iti = '';
        var phoneInputID = value;
        var input = document.querySelector(phoneInputID);
        iti = window.intlTelInput(input, {
            separateDialCode: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "in"
        });
        
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
        var datas = { 'securedairportzo': "secured" };
        var jsondata = JSON.stringify(datas);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "API/Version1.0/service-distributor/getBusinessInfoDropDown.php",
            data: jsondata,
            success: Business_Type
        });
        field_validation();

    });


    function Business_Type(data) {
        // console.log(data.business_type);
        $('#select_reason_business').append($('<option>').text("Select Business Type").attr('value', 0));
        $.each(data.business_type, function(i, value) {
            $('#select_reason_business').append($('<option>').text(value.business_name).attr('value', value.business_type_token));
        });
        // country
        $('#select_reason_country').append($('<option>').text("Select Country").attr('value', 0));
        $.each(data.country_list, function(i, value) {
            $('#select_reason_country').append($('<option>').text(value.country_name).attr('value', value.country_id));
        });
        // city
        // $('#select_reason_city').append($('<option>').text("Select Country").attr('value',0));
        $.each(data.city_list, function(i, value) {
            $('#select_reason_city').append($('<option>').text(value.city_name).attr('value', value.city_id));
        });
        // state
        $.each(data.region_list, function(i, value) {
            $('#select_reason_state').append($('<option>').text(value.region_name).attr('value', value.region_id));
        });

    }



var is_set_business = false;
var is_set_bank_info = false;
var is_set_document = false;
 
    // Business info
    function business_info() {
        debugger;
        var business_name = document.getElementById("business_name").value;
        var select_reason_business = document.getElementById("select_reason_business").value;
        var business_website = document.getElementById("business_website_info").value;
        var mobile_no = document.getElementById("mobile_no").value;
        var business_website_primary = document.getElementById("business_website").value;
        var alt_mobile_no = document.getElementById("alt_mobile_no").value;
        var primary_business_website = document.getElementById("primary_business_website").value;
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

        } else {
            valid1 = false;
            document.getElementById('business_name_validate').style.visibility = "visible";
        }
        if (select_reason_business != 0) {
            valid1 = true;
             document.getElementById('select_reason_business_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('select_reason_business_validate').style.visibility = "visible";
        }
        if (business_website != '') {
            valid1 = true;
             document.getElementById('business_website_info_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('business_website_info_validate').style.visibility = "visible";
        }
         if (mobile_no != '') {
            valid1 = true;
             document.getElementById('mobile_no_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('mobile_no_validate').style.visibility = "visible";
        }
        if (business_website_primary != '') {
            valid1 = true;
            document.getElementById('business_website_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('business_website_validate').style.visibility = "visible";
        }
         if (alt_mobile_no != '') {
            valid1 = true;
            document.getElementById('alt_mobile_no_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('alt_mobile_no_validate').style.visibility = "visible";
        }
        if (primary_business_website != '') {
            valid1 = true;
            document.getElementById('primary_business_website_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('primary_business_website_validate').style.visibility = "visible";
        }
        if (address != '') {
            valid1 = true;
            document.getElementById('address_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('address_validate').style.visibility = "visible";
        }
        if (select_reason_country != 0) {
            valid1 = true;
            document.getElementById('select_reason_country_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('select_reason_country_validate').style.visibility = "visible";
        }
        if (select_reason_state != 0) {
            valid1 = true;
            document.getElementById('select_reason_state_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('select_reason_state_validate').style.visibility = "visible";
        }
        if (select_reason_city != 0) {
            valid1 = true;
            document.getElementById('city_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('city_validate').style.visibility = "visible";
        }
        if (pincode != 0) {
            valid1 = true;
            document.getElementById('pincode_validate').style.visibility = "hidden";

        } else {
            valid1 = false;
            document.getElementById('pincode_validate').style.visibility = "visible";
        }

         // var selectedname = document.getElementById('businessType');
         //    var value = selectedname.options[selectedname.selectedIndex].text;
         //    $("#get_businesstype").html(value);

            // $("#get_businesstype").html(value);
            // $("#get_businesswebsite").text(business_website);
            // $("#get_yearofinception").text(year_of_inception);
            // $("#get_businessaddress").text(business_email_address);
            // $("#get_businessmobile").text(business_mobile_number);

            if(valid1 == true){
                $("#get_business_name_value").text(business_name);
                $("#get_business_website").text(business_website);
                $("#get_primary_business_website").text(business_website_primary);
                $("#get_primary_alt_phone_number").text(alt_mobile_no);
                $("#get_primary_alt_email").text(primary_business_website);
                $("#get_address_value").text(address);
                $("#get_pincode").text(pincode);
                var select_reason_business = document.getElementById('select_reason_business');
                var value = select_reason_business.options[select_reason_business.selectedIndex].text;
                $("#get_business_type").html(value);
                $("#get_primary_business_type").html(value);
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

                                
                $('#bank_detail_value').click();


                }


                // bank_detail


    }

    // bank_detail
    function bank_detail() {
        var acc_number = document.getElementById("acc_number").value;
        var re_enter_ac_no = document.getElementById("re_enter_ac_no").value;
        var ifsc_code = document.getElementById("ifsc_code").value;
        var branch = document.getElementById("bank_branch").value;
        var city = document.getElementById("bank_city").value;
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

             $('#doument_detail_value').click();
        }  
        } else {
            swal("Account Number Does Not Match");


        }      
    }

    function ifsc_function(){
        var ifsc_code = document.getElementById("ifsc_code").value;
        var length = ifsc_code.length;
        if(length == 11){
            $.getJSON('https://ifsc.razorpay.com/'+ifsc_code, function(data){
               // console.log(data.BRANCH);
               // console.log(data.CITY);
               $('#bank_branch').val(data.BRANCH);
               $('#bank_city').val(data.BRANCH);

            });
        }else{
                $('#bank_branch').val('');
               $('#bank_city').val('');
        }
       


    }

                function ValidateFileUpload(id) {
                    debugger;
                    var fuData = document.getElementById(id).files[0].name;
                    // var FileUploadPath = fuData.value;
                    var FileUploadPath1 = fuData.split('.').pop().toLowerCase()

            //To check if user upload any file
                    if (fuData == '') {
                        swal("Please upload an image");

                    } else {
                        // var Extension = FileUploadPath.split('.').pop()
                        // FileUploadPath.substring(
                        //         FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

            //The file uploaded is an image
            if ( FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg" || FileUploadPath1 == "pdf") {
            // To Display
            // alert(fuData);
            if(id == 'pan_card'){
                  const [file_pan_card] = pan_card.files
                  if (file_pan_card) {
                    view_pancard.src = URL.createObjectURL(file_pan_card)
                  }   
            }
            if(id == 'gst_certificate'){
                  const [file_gst_certificate] = gst_certificate.files
                  if (file_gst_certificate) {
                    view_gst.src = URL.createObjectURL(file_gst_certificate)
                  }   
            }
// file1 - msme
// file2 - incorporationImage
            if(id == 'file1'){
                  const [file_msme] = file1.files
                  if (file_msme) {
                    view_msme.src = URL.createObjectURL(file_msme)
                  }   
            }
            if(id == 'file2'){
                  const [file_incorporation] = file2.files
                  if (file_incorporation) {
                    view_incorporation.src = URL.createObjectURL(file_incorporation)
                  }   
            }
            field_validation();
            is_set_document = true;
            
                        } 

            //The file upload is NOT an image
            else {
                            swal("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

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
                    var pan_card = document.getElementById('pan_card').value;
                    var gst_certificate = document.getElementById('gst_certificate').value;
                    var file1 = document.getElementById('file1').value;
                    var file2 = document.getElementById('file2').value;
                   
                    
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

                }
                function clearImageData(id){
                    debugger;
                    if(id == 'pan_card'){
                        
                        document.getElementById('before_pan_card').value = '';
                        document.getElementById('pan_card').value = '';
                        document.getElementById('after_pan_card').value = '';
                        document.getElementById('panImage').value = '';

                        document.getElementById('view_pancard').value = '';

                    }
                    if(id == 'gst_card'){
                        
                        document.getElementById('before_gst_card').value = '';
                        document.getElementById('gst_certificate').value = '';
                        document.getElementById('after_gst_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('panImage').value = '';
                        document.getElementById('view_gst').value = '';
                    }
                    if(id == 'msme_card'){
                        
                        document.getElementById('before_msme_card').value = '';
                        document.getElementById('file1').value = '';
                        document.getElementById('after_msme_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_msme').value = '';
                    }
                    if(id == 'incorporation_card'){
                        
                        document.getElementById('before_incorporation_card').value = '';
                        document.getElementById('file2').value = '';
                        document.getElementById('after_incorporation_card').value = '';
                        // document.getElementById('panImage').value = '';
                         document.getElementById('view_incorporation').value = '';
                    }


                    field_validation();

                }

                function upload_image_page(){
                    var pan_card = document.getElementById('pan_card').value;
                    var gst_certificate = document.getElementById('gst_certificate').value;
                    var file1 = document.getElementById('file1').value;
                    var file2 = document.getElementById('file2').value;
                    if(pan_card != '' && gst_certificate!= '' && file1!= '' && file2 != '' ){
                         $('#review_value').click();
                        // var element = document.getElementById("review");
                        // element.classList.toggle('active');
                        // var element1 = document.getElementById("doument_detail");
                        // element1.classList.toggle('active');

                    }else{
                        swal("upload all images");
                    }
                }
        
                function onboard_submit(){
                if((is_set_business ==true) && (is_set_bank_info == true) && (is_set_document == true) ){
                    image_upload_loop(0);
                }else{
                     swal("fill all detail");
                }
                }

                // go to dashboard
                function go_to_dashboard() {
                    if((is_set_business ==true) && (is_set_bank_info == true) && (is_set_document == true) ){
                       
                        var business_name = document.getElementById('get_business_name_value').innerHTML;
                        var business_type = document.getElementById('get_business_type').innerHTML;
                         var business_type_id = document.getElementById('select_reason_business').value;
                        var business_info_website = document.getElementById('get_business_website').innerHTML;
                        var primary_business_type = document.getElementById('get_primary_business_type').innerHTML;
                        var primary_mobile_no = document.getElementById('mobile_no').value
                        var primary_business_website = document.getElementById('get_primary_business_website').innerHTML;
                        var alternative_mobile_number = document.getElementById('get_primary_alt_phone_number').innerHTML;
                        var business_website_email = document.getElementById('business_website').value
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
//                         console.log(pan_card_image);
//                         console.log(gst_image);
//                         console.log(gst_msme);
//                         console.log(incorporation_image);


                        var datas = {
                                    'token':distributor_id,
                                    'business_name':business_name,
                                    'business_type':business_type_id,
                                    'business_website':business_info_website,
                                    'primary_country_code':91,
                                    'primary_mobile_number':primary_mobile_no,
                                    'primary_emailId':business_website_email,
                                    'alternate_country_code':91,
                                    'alternate_mobile_number':alternative_mobile_number,
                                    'alternate_emailId':alternative_email,
                                    'address':address,
                                    'country_id':select_country_id,
                                    'state_id':select_state_id,
                                    'city_id':select_city_id,
                                    'pincode':pincode,
                                    'account_number':account_number,
                                    'ifsc_code':ifsc_code,
                                    'branch':bank_branch,
                                    'city':bank_city,
                                    'service_list':'',
                                    'selected_airport':'',
                                    'pan_card':pan_card_image,
                                    'gst_certificate':gst_image,
                                    'msme_certificate':gst_msme,
                                    'certificate_incorporation':incorporation_image,
                                    'void_cheque':'',
                                    'contract_agreemen':''
                                };

                                var json1 = JSON.stringify(datas);
//                                console.log(json1);
                                $.ajax({
                                dataType: "JSON",
                                type: "POST",
                                url: apiPath+"/service-distributor/addServiceDistributor.php",
                                data: json1
                                }).done(function(data1){
                                    if(data1.status_code == 200){
                                        window.location = "booking.php";
                                        // alert("booking");
                                    }else{
                                        // swal(data1.message);
                                    }
                                });




                    }else{
                        swal("fill all detail");
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
          

    var image_id = ['pan_card','gst_certificate','file1','file2']
    function image_upload_loop(key){
        var checkkey = key+1;
        if(checkkey>image_id.length){
           go_to_dashboard();
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
        var folder = 'service_distributor/documents/';
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

    </script>
</body>

</html>
