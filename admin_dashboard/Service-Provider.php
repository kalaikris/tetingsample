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
    <title>Service Partners</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/manage_volunteer_list.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/service_provider.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="css/select.css">
</head>
<style> 
    .custom-table tbody .actioncol
    {
        display: inline-block;
        padding-right: 16px;
        padding-left: 16px;
    }
    .custom-table tbody span {
        display: inline-block;
    }
    .radio-box{
        margin-bottom: 20px;
        gap: 16px;
    }
    .radio-box,.radio-box > div{
        display: flex;
        align-items: center;
    }
    .radio-box input{
        margin-right: 10px;
    }
    .check-box-cont img {
        width: 30px;
        height: 49px;
        object-fit: contain;
        padding-right: 10px;
    }
    .business-view-container {
        padding: 20px;
    }
    .img-upload-container label{
        margin-bottom: 16px;
    }
</style>
<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar2"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
              <div>
                  <h1 class="header_main">Service Provider</h1>
                  <p class="total_emp total ml-0"></p>
              </div>
              <div class="subit-cont">
                    <button class="creat-btn" data-toggle="modal" data-target="#givecredit">Give Credit Point</button>
                    <button class="creat-btn" data-toggle="modal"  onclick="valueclear()" data-target="#createnow">Create New</button>
              </div>
            </div>
            <div class="header_btn-container">
                <div class="dropdown ml-0">
                    <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="" />
                    <label for="filter-switch" class="dropdown__options-filter">
                        <ul class="dropdown__filter" role="listbox" tabindex="-1">
                            <li class="dropdown__filter-selected" aria-selected="true">
                                Download as
                            </li>
                            <li>
                                <ul class="dropdown__select">
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)" onclick="drpDownbtnClick ('csv');">CSV</a>
                                    </li>
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)" onclick="drpDownbtnClick ('pdf');">PDF</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </label>
                </div>
            </div>
            
            <div class="table-box">
                <table class="custom-table providerlist" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Service Provider ID</th>
                            <th>Service Provider Name</th>
                            <th>Email Address</th>
                            <th>Is Credit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="bg-white full-height twoback hides" id="toggle4">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hidemodal()" alt="" class="backword">
                <h1 class="header_main header_main_h1 viewprovidername" ></h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Service Provider ID</p>
                            <p id="viewproviderid"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Service Provider Name</p>
                            <p class="viewprovidername"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Email Address</p>
                            <p id="viewprovideremail"></p>
                        </div>
                        <div class="details-top-div" hidden>
                            <p class="top_p_color">Mobile Number</p>
                            <p></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Created Date</p>
                            <p id="viewprovidercreateddate"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-box">
                <div class="distributor-details-container">
                    <h3>Provider Details</h3>
                    <div class="over-all-tab">
                        <ul class="tabs-agent">
                            <li class="tab-link current-active" data-tab="tab-1-agent-list">Business
                                Details
                            </li>
                            <li class="tab-link-reviw" data-tab="tab-4-agent-list">Credit Points History
                            </li>
                        </ul>

                        <div id="tab-1-agent-list" class="tab-content current-active">
                            <div class="agent_table">
                                <p class="distributor-detail-count totaldistagents">Total Businesses - <span class="count">0</span></p>
                                <table class="custom-table viewproviderdetails" id="dataTables_filter">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Business Name</th>
                                            <th>Business website</th>
                                            <th>Business Category</th>
                                            <th>Total Service Locations</th>
                                            <th>Onboarded Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="tab-4-agent-list" class="tab-content">
                            <p class="distributor-detail-count totalcredithistory"><span class="count"></span></p>
                            <div class="campaign_top_content_section credit-points-content">
                                <div class="details-top-section">
                                    <div class="details-top-div date">
                                        <p >Total Credit Points</p>
                                        <p class="credit_value totalcreditpoints"></p>
                                    </div>
                                    <div class="details-top-div date">
                                        <p>Used Credit Points</p>
                                        <p class="credit_value usercurrentpoints"></p>
                                    </div>
                                    <div class="details-top-div date">
                                        <p>Current Credit Points</p>
                                        <p class="credit_value currentcreditpoints"></p>
                                    </div>
                                </div>
                            </div>
                            <table class="custom-table providercredithistory" id="dataTables_filter5">
                                <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Credit Points</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white full-height twoback hides" id="toggle11">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="showmodal2()" alt="" class="backword">
                <h1 class="header_main header_main_h1 companyname"></h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Name</p>
                            <p class="compbusinessname" ></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Business Website</p>
                            <p class="compwebsite"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Category</p>
                            <p class="compbusinesscat"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Total Service Locations</p>
                            <p class="compservicelocations"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Created Date</p>
                            <p class="compcreateddate"></p>
                        </div>
                    </div>
                    <div class="Business-cnt-text">
                        <h1>Business Info</h1>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Type</p>
                            <p class="compbusinesstype"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Business Website</p>
                            <p class="compbusinesswebsite"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Year of Inception</p>
                            <p class="compinception"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1 border-bottom">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Email Address</p>
                            <p class="compbusinessemail"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Business Mobile Numer</p>
                            <p class="compbusinessmobile"></p>
                        </div>
                    </div>
                    <div class="Business-cnt-text">
                        <h1>Primary Contact Details</h1>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Contact Name</p>
                            <p class="compcontactname"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Designation</p>
                            <p class="compdesignation"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Mobile Number</p>
                            <p class="compmob"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Email Address</p>
                            <p class="compemail"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1 border-bottom">
                        <div class="details-top-div">
                            <p class="top_p_color">Alternative Mobile Number</p>
                            <p class="compaltno"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Alternative Email Address</p>
                            <p class="compaltemail"></p>
                        </div>
                    </div>
                    <div class="Business-cnt-text">
                        <h1>Address</h1>
                    </div>
                    <div class="details-top-section details-top-section1">
                        <div class="details-top-div">
                            <p class="top_p_color">Address</p>
                            <p class="compaddress"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Country</p>
                            <p class="compcountry"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">state</p>
                            <p class="compstate"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1 border-bottom">
                        <div class="details-top-div">
                            <p class="top_p_color">city</p>
                            <p class="compcity"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Pincode</p>
                            <p class="comppin"></p>
                        </div>
                    </div>
                    <div class="service__location-container">
                        <div class="Business-cnt-text">
                            <h1>Service Locations</h1>
                        </div>
                        <div class="location__set-container">
                          <div class="location__set">
                            <div class="details-top-section details-top-section1 border-bottom">
                                <div class="details-top-div">
                                    <p class="top_p_color compairport"></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="details-top-section details-top-section1">
                                <div class="details-top-div">
                                    <p class="top_p_color">Account number</p>
                                    <p class="compacc"></p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">IFSC Code</p>
                                    <p class="compifsc"></p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Branch</p>
                                    <p class="compbankbranch"></p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">City</p>
                                    <p class="compbankcity"></p>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-content active">
                                <div class="document-view">
                                    <div class="document-items">
                                        <div class="doc-set">
                                            <img id="compgst" src="assets_new/main/Document image@2x.png" class="document-file">
                                        </div>
                                        <p class="file-name">GST Certificate</p>
                                    </div>
                                    <div class="document-items">
                                        <div class="doc-set">
                                            <img id="commsme" src="assets_new/main/Document image@2x.png" class="document-file">
                                        </div>
                                        <p class="file-name">MSME Certificate</p>
                                    </div>
                                    <div class="document-items">
                                        <div class="doc-set">
                                            <img id="compincorp" src="assets_new/main/Document image@2x.png"  class="document-file">
                                        </div>
                                        <p class="file-name">Certificate of Incorporation</p>
                                    </div>
                                    <div class="document-items">
                                        <div class="doc-set">
                                            <img id="compvoid" src="assets_new/main/Document image@2x.png"  class="document-file">
                                        </div>
                                        <p class="file-name">Void Cheque</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center" style="margin: 20px 30px;">
                        <div class="edit-commision-btn mr-3" style="cursor:pointer;">
                            <span>Edit commission</span>
                            <img src="assets_new/edit.svg" alt="">
                        </div>
                        <button class="primary-btn commission-submit-btn hidden" >Submit</button>
                    </div>
                    <div class="btn-container">
                        <button class="primary-btn detailverify">Verify Now</button>
                        <button class="sec-btn detailreject">Reject</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white full-height twoback hides" id="viewBusinessinfo">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideBusinessDetails()" alt="" class="backword">
                <h1 class="header_main header_main_h1">Business info</h1>
            </div>
            <div class="business-view-container">
                <div class="img-upload-container">
                    <input id="companylogourl" type="hidden">
                    <label for="userImage">
                        <img src="assets_new/upload-icon.png" id="uploadedimage" style="width:150px; cursor: pointer;" alt="upload icon" class="upload-icon">
                    </label>
                    <input id="imgValidId" type="hidden" >
                    <input id="userImage" type="file" onchange="imageUpload('userImage','uploadedimage','imgValidId');" accept="image/x-png, image/gif, image/jpeg,image/jpg" style="display:none;">
                    <p id="userImageErr" style="color: red; font-size: 13px;"></p>

                    <input id="companyimageurl" type="hidden">
                    <label for="companyImage">
                        <img src="assets_new/company_Image.svg" id="companyuploadedimage" style="width:150px; cursor: pointer;" alt="upload icon" class="upload-icon">
                    </label>
                    <input id="companyimgvalid" type="hidden">
                    <input id="companyImage" type="file" onchange="imageUpload('companyImage','companyuploadedimage','companyimgvalid');" accept="image/x-png, image/gif, image/jpeg,image/jpg" style="display:none;">
                    <p id="companyImageErr" style="color: red; font-size: 13px;"></p>
                </div>

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
                        <div class='input-form-group-item arriving-input-set' id='arrive_date1'>
                            <div class="select-group">
                                <label class="input-group-addon bg-date" for="yearOfInception"></label>
                            </div>  
                            <div class="input-box-set border-R">
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
                            <div class="input-box-set border-R">
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
                <div class="form_btn text-center">
                        <button class="submit_btn" onclick="updateBusinessInfo()">Submit</button>
                </div>
            </div>
        </section>


        <!-- The Modal Block User -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Block Reason</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <textarea name="" id="" placeholder="Enter block reason…"></textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="" data-dismiss="modal">Cancel</a>
                        <button type="button" class="btn btn-danger">Block</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal Verify User -->
        <div class="modal" id="verifyModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Feedback</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="rating">
                            <h6>Reating</h6>
                            <img src="assets_new/">
                        </div>
                        <div class="rating1">
                            <h6>Review</h6>
                            <p class="common-p"></p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="createnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Create New</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="modal_input-container">
                            <div class="input__box">
                                <label class="form__label" for="providerid">Service Provider Id</label>
                                <input type="text" name="" placeholder="AIRPORTZO#98" id="providerid" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label" for="providername">Name</label>
                                <input type="text" name="" placeholder="Alan Weber" id="providername" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label" for="provideremail">Email Address</label>
                                <input type="text" name="" placeholder="Alan Weber" id="provideremail" class="form__input">
                            </div>
                            <div class="radio-box">
                               <label>Is Credit:</label>
                                <div class="radio-set">
                                    <input type="radio" name="is_credit" id="credit_yes" value="Yes" checked>
                                    <label for="credit_yes">Yes</label>
                                </div>
                                <div class="radio-set">
                                    <input type="radio" name="is_credit" id="credit_no" value="No">
                                    <label for="credit_no">No</label>
                                </div>
                            </div>
                            <!-- <div class="input__box">
                                <label class="form__label" for="commissioncharge">Commission charge</label>
                                <input type="number" name="" placeholder="%" id="commissioncharge" class="form__input">
                            </div> -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn createprovider">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="editnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="modal_input-container">
                            <div class="radio-box">
                                <label>Is Credit:</label>
                                <div class="radio-set">
                                    <input type="radio" name="edit_is_credit" id="edit_credit_yes" value="Yes" checked>
                                    <label for="edit_credit_yes">Yes</label>
                                </div>
                                <div class="radio-set">
                                    <input type="radio" name="edit_is_credit" id="edit_credit_no" value="No">
                                    <label for="edit_credit_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updateprovider">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Give credit modal -->
        <div class="modal" id="givecredit">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Give Credit Point</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                       <div class="modal_input-container">
                            <div class="input__box">
                                <label class="form__label">Service Provider</label>
                                <select name="" id="credit-provider" class="form__select">
                                </select>
                            </div>
                            <div class="input__box">
                                <label class="form__label">Reference Id</label>
                                <input type="text" name="" placeholder="1000000" id="credit-reference" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label">Credit Points</label>
                                <input type="text" name="" placeholder="1000000" id="credit-points" class="form__input">
                            </div> 
                       </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn addcredits">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="../service-provider-dashboard/js/aws-sdk.min.js"></script>
    <script src="../service-provider-dashboard/js/s3upload.js?v=<?php echo $cur_date_time; ?>"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/select.js"></script>
    <script src="js/intlTelInput.js"></script>
    <script src="js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="js/datatables.min.js"></script>
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>  
         var apiPath = "<?php echo $apiPath; ?>";
            var example = flatpickr('#flatpickr,#flatpickr2');
            /* Radion button box */
            $('.ratio-btn-selecter').on('click', function() {
                var quickcheck = $(this).attr('data-value');
                if (quickcheck == "image") {
                    $('input[name=radio_btn_option][value="image"]').attr('checked', 'checked');
                    $('.popup-image-box').removeClass('hidden');
                    $('.popup-video-box').addClass('hidden');
                } else {
                    $('input[name=radio_btn_option][value="video"]').attr('checked', 'checked');
                    $('.popup-image-box ').addClass('hidden');
                    $('.popup-video-box').removeClass('hidden');
                }
            })

            function valueclear(){
                $('#providerid').val('');
                $('#providername').val('');
                $('#provideremail').val('');
            }

            function hideBusinessDetails() {
                $('#toggle4').show();
                $('#viewBusinessinfo').hide();
            }
    </script>
    <script src="js/function.js"></script>
    <script src="js/dropdowndata.js"></script>
    <script>
         var state_val=false;
        var city_val=false;
        var dummyarray = [];
        $(document).ready(() => {
            //business type
            $(".chzn-select").chosen({ allow_single_deselect: true });
            var secured = "secured";
            var datas = { securedairportzo: secured };
            var jsondata1 = JSON.stringify(datas);
            $.ajax({
            type: "POST",
            dataType: "json",
            url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
            data: jsondata1,
            }).done(function (data) {
            $("#businessType").empty();
            var businessTypeData = data.business_type;
            var businesstypedata =
                '<option value="">Select Your Business Type</option>';
            for (var key in businessTypeData) {
                businesstypedata +=
                '<option value="' +
                businessTypeData[key].business_type_token +
                '">' +
                businessTypeData[key].business_name +
                "</option>";
            }
            $("#businessType").html(businesstypedata);
            $("#businessType")
                .change(function () {})
                .chosen({ allow_single_deselect: true });
            ({
                width: "100%",
                filter: true,
            });
            });

            //country
            $.ajax({
            type: "POST",
            dataType: "json",
            url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
            data: jsondata1,
            }).done(function (data) {
            $("#select_Country").empty();
            var countrytypedata = data.country_list;
            var countrydata = '<option value="">Select Your Country</option>';
            for (var key in countrytypedata) {
                countrydata +=
                '<option value="' +
                countrytypedata[key].country_id +
                '">' +
                countrytypedata[key].country_name +
                "</option>";
            }
            $("#select_Country").html(countrydata);
            $("#select_Country")
                .change(function () {})
                .chosen({ allow_single_deselect: true });
            ({
                width: "100%",
                filter: true,
            });
            });

            //states
            $.ajax({
            type: "POST",
            dataType: "json",
            url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
            data: jsondata1,
            }).done(function (data) {
            $("#select_State").empty();
            var regionList = data.region_list;
            var regionData = '<option value="">Select Your State</option>';
            for (var key in regionList) {
                regionData += '<option value="' +regionList[key].region_id +'">' +regionList[key].region_name +"</option>";
            }
            $("#select_State").html(regionData);
            $("#select_State")
                .change(function () {})
                .chosen({ allow_single_deselect: true });
            ({
                width: "100%",
                filter: true,
            });
            });

            //city
            $.ajax({
            type: "POST",
            dataType: "json",
            url: "../service-provider-dashboard/"+apiPath + "/service-provider/getBusinessInfoDropDown.php",
            data: jsondata1,
            }).done(function (data) {
            $("#select_City").empty();
            var cityList = data.city_list;
            var cityData = '<option value="">Select Your City</option>';
            for (var key in cityList) {
                cityData += '<option value="' +cityList[key].city_id +'">' +cityList[key].city_name +"</option>";
            }
            $("#select_City").html(cityData);
            $("#select_City")
                .change(function () {})
                .chosen({ allow_single_deselect: true });
            ({
                width: "100%",
                filter: true,
            });
            });

                // index-page functions
            var id = ["#business_mobile_number","#mobile_number","#alternative_mobile_no"];
            
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
  
            fetchproviders();
            creditproviderlist();
            $("#loading").hide(); //Main Loader Close
        });

        setTimeout(clearSearchValue, 1000);

        function clearSearchValue() {
            $('#credit-points').val('');
        }
        var providerArray;
        function  fetchproviders(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/providerList.php",
                    data: json1
                    }).done(function(data1) {
                        providerArray = data1.data;
                        let providerscount = providerArray.length;
                        let providerslist = '';

                        providerArray.forEach((list,index) => {
                            let blockstatus ='';
                            if (list.providerstatus == 0) {
                                blockstatus = `<span class="actioncal"><a data-token="${list.providerToken}" href="#" class="view_link providerblock">Block</a></span>`;
                                
                            }else{
                                blockstatus = `<span class="actioncal"><a data-token="${list.providerToken}" href="#" class="view_link providerunblock">Unblock</a></span>`;
                            }

                            providerslist += `<tr>
                                                <td>${index + 1}</td>
                                                <td>${list.providerId}</td>
                                                <td>${list.providerName}</td>
                                                <td>${list.providerEmail}</td>
                                                <td>${list.is_credit}</td>
                                                <td><a href="#" data-token="${list.providerToken}" class="view_link" id="providerdetails" onclick="showmodal2()">View</a>
                                                    <a href="#"  onclick="providerDetailEdit(${index})" id="edit_providerdetails" data-toggle="modal" data-target="#editnow">Edit</a>
                                                ${blockstatus}
                                                <span class="actioncal"><a data-token="${list.providerToken}" href="#" class="view_link deleteprovider">Delete</a</span>
                                                </td>
                                                
                                              </tr>`;
                            
                        });

                        $('.total').text(`Total Providers - ${providerscount}`);
                        $('.providerlist tbody').html(providerslist);
                        $(".providerlist").DataTable({
                                                        dom: 'Bfrtip',
                                                        initComplete: function() {
                                                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                                                        },
                                                        buttons: [
                                                            {
                                                                extend: 'csvHtml5',
                                                                title: 'Provider Management',
                                                                exportOptions: {
                                                                                    columns: [0,1,2,3],
                                                                                },
                                                            },
                                                            {
                                                                extend: 'pdfHtml5',
                                                                orientation: 'landscape',
                                                                pageSize: 'LEGAL',
                                                                title: 'Provider Management',
                                                                exportOptions: {
                                                                                    columns: [0,1,2,3],
                                                                                },
                                                            }
                                                        ],
                                                        language: {
                                                            search: '<img src="./assets_new/main/Search.png">',
                                                            searchPlaceholder: "Search",
                                                            paginate: {
                                                                next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                            }
                                                        }
                                                    });
                        
                    })
        }

    // on click Edit
    function providerDetailEdit(index){
        $('.updateprovider').attr('data-token',providerArray[index].providerToken);   
        if($("#edit_credit_yes").val() == providerArray[index].is_credit){
            $("#edit_credit_yes").prop("checked", true);
        }else{
            $("#edit_credit_no").prop("checked", true);
        }
    }

    //Update Provider details
    $('body').on('click','.updateprovider',function(){
        let ProviderToken = $(this).attr('data-token');
        let isCredit = $("input[name='edit_is_credit']:checked").val();
        let datas = {
            "adminToken":adminToken,
            "ProviderToken":ProviderToken,
            "isCredit":isCredit
        };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/provider/updateProviderDetails.php",
            data: json1
        }).done(function(data1) {
            if(data1.status_code == 201){
            swal({
                title:data1.title,
                text:data1.message,
                icon:"success",
            }).then(()=>{
                location.reload();
            });
            } else {
                swal({
                    title:data1.title,
                    text:data1.message,
                    icon:"warning",
                });
            }
        });
    });

        function creditproviderlist(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/providerDropDown.php",
                    data: json1
                    }).done(function(data1) {
                        let providerlistarray = data1.providerDetails;
                        let providerdropdown = '<option value="0">Select Provider</option>';
                        providerlistarray.forEach((dropdown,index) => {

                            providerdropdown += `<option value="${dropdown.providerToken}">${dropdown.providerName}</option>`;
                        });

                        $('#credit-provider').html(providerdropdown);

                    })

        }

        $('body').on('click','.addcredits',function(){

            let providerToken = $('#credit-provider').val();
            let referenceId = $('#credit-reference').val();
            let givenCredits = $('#credit-points').val();
            if(providerToken != 0 && referenceId != '' && givenCredits!= ''){
                let datas = {
                                "adminToken":adminToken,
                                "providerToken":providerToken,
                                "givenCredits":givenCredits,
                                "referenceId":referenceId
                            };
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/provider/updateProviderCredits.php",
                        data: json1
                        }).done(function(data1) {
                            if(data1.status_code == 201){
                                swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"success",

                                    }).then(()=>{
                                        location.reload();
                                    });

                            }else{
                                swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"warning",

                                    });
                            }

                        })
            }else{
                if(providerToken == 0){
                    swal('Select the Provider');
                }else if(referenceId == ''){
                    swal('Reference Id is mandatory');
                }else if(givenCredits == ''){
                    swal('Credits cannot be empty');
                }

            }
        })


        function isEmail(email) {
                    let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return mailFormat.test(email);
	    }


        $('body').on('click','.createprovider',function(){
            let providerId = $('#providerid').val();
            let name = $('#providername').val();
            let email = $('#provideremail').val();
            let isCredit = $("input[name='is_credit']:checked").val();
            // let commissionPercentage = $('#commissioncharge').val();

            if(providerId != "" && name != "" && email != "" && isEmail(email)){
                let datas = {
                                "adminToken":adminToken,
                                "name":name,
                                "email":email,
                                "providerId":providerId,
                                "isCredit":isCredit
                            };
                let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/addProvider.php",
                    data: json1
                    }).done(function(data1) {

                        if(data1.status_code == 201){
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"success",

                                }).then(()=>{
                                    location.reload();
                                });

                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }
                    })
                        

            }else{
                swal("Please enter valid inputs in all fields")
            }

        })

        //single provider details view
        $('body').on('click','#providerdetails',function(){
            let providerToken = $(this).attr('data-token');
            let datas = {
                            "adminToken":adminToken,
                            "providerToken":providerToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    beforeSend: function () { $('#loading').show(); },
                    type: "POST",
                    url: apiPath+"/provider/singleProviderDetails.php",
                    data: json1
                    }).done(function(data1) {
                        let providerDetailslist = data1.providerDetails;
                        let companyDetailsarray = data1.companyDetails;
                        let creditDetailsobject= data1.creditDetails;
                        let creditDetailsarray = creditDetailsobject.data;
                        let creditdetails = '';
                        let companydetails = '';
                        $('#viewproviderid').text(providerDetailslist.providerId);
                        $('.viewprovidername').text(providerDetailslist.providerName);
                        $('#viewprovideremail').text(providerDetailslist.providerEmail);
                        $('#viewprovidercreateddate').text(providerDetailslist.createdDate);

                        $('.totaldistagents').text(`Total Businesses - ${companyDetailsarray.length}`)

                        companyDetailsarray.forEach((details,index) => {
                            let status = '';
                            let website = ''
                            if(details.status == 1){

                                status = `<td><button class="pending">PENDING</button><a href="#" data-token="${details.companyToken}" class="verify_link verifyinstant" style="padding-left:12px;">Verify now</a></td>
                                          <td><span class="view_link" >-</span></td>`;
                                
                            }else if (details.status == 2){

                                status = `<td><button class="active">ACTIVE</button></td>
                                          <td><a href="javascript:void(0)" class="view_link" onclick="appendfirstcompanyDetails(${details.companyToken})">Edit</a></td>`;

                            }else if (details.status == 3){
                                status = `<td><button class="rejected">REJECTED</button></td>
                                <td><span class="view_link" >-</span></td>`;
                            } else {
                                status = `<td><button class="pending">Under Review</button></td>
                                <td><span class="view_link" >-</span></td>`;
                            }
                            if(details.companyWebsite == ""){

                                website = `<td>-</td>`;

                            }else{

                                website = `<td>${details.companyWebsite}</td>`;

                            }

                            companydetails += `<tr>
                                                    <td>${index + 1}</td>
                                                    <td><a href="#" data-token="${details.companyToken}" data-name="${details.companyName}" data-status="${details.status}" data-credit="${details.is_credit}" class="view_link" id="companydetails" onclick="showmodal3()">${details.companyName}</a></td>
                                                    ${website}
                                                    <td>${details.businessType}</td>
                                                    <td>${details.totalLocations}</td>
                                                    <td>${details.onboardedDate}</td>
                                                    ${status}
                                                </tr>`;
                            
                        });
                        $('.viewproviderdetails tbody').html(companydetails);
                        $(".viewproviderdetails").DataTable().destroy();
                        $('.viewproviderdetails tbody').html(companydetails);
                        
                        $(".viewproviderdetails").DataTable({
                                                        dom: 'Bfrtip',
                                                        scrollX: true,
                                                        searching: false,
                                                        buttons: [
                                                            // {
                                                            //     extend: 'csvHtml5',
                                                            //     title: 'Project Management'
                                                            // },
                                                            // {
                                                            //     extend: 'pdfHtml5',
                                                            //     orientation: 'landscape',
                                                            //     pageSize: 'LEGAL',
                                                            //     title: 'Project Management'
                                                            // }
                                                        ],
                                                        language: {

                                                            search: '<img src="./assets_new/main/Search.png">',
                                                            searchPlaceholder: "Search",
                                                            paginate: {
                                                                next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                            }
                                                        }
                                                    }).draw();

                        $('.totalcredithistory').text(`Total History - ${creditDetailsarray.length}`)
                        $('.totalcreditpoints').text(creditDetailsobject.totalCredits);
                        $('.usercurrentpoints').text(creditDetailsobject.usedCredits);
                        $('.currentcreditpoints').text(creditDetailsobject.creditAvailable);
                        creditDetailsarray.forEach((list1,index1) => {

                            creditdetails += `<tr>
                                                <td>${index1 + 1}</td>
                                                <td>${list1.givenCredit}</td>
                                                <td>${list1.createDate}</td>
                                            </tr>`;
                            
                        });
                        $('.providercredithistory tbody').html(creditdetails);
                        $(".providercredithistory").DataTable().destroy();
                        $('.providercredithistory tbody').html(creditdetails);
                        
                        $(".providercredithistory").DataTable({
                                                        dom: 'Bfrtip',
                                                        searching: false,
                                                        buttons: [
                                                            // {
                                                            //     extend: 'csvHtml5',
                                                            //     title: 'Project Management'
                                                            // },
                                                            // {
                                                            //     extend: 'pdfHtml5',
                                                            //     orientation: 'landscape',
                                                            //     pageSize: 'LEGAL',
                                                            //     title: 'Project Management'
                                                            // }
                                                        ],
                                                        language: {

                                                            search: '<img src="./assets_new/main/Search.png">',
                                                            searchPlaceholder: "Search",
                                                            paginate: {
                                                                next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                            }
                                                        }
                                                    }).draw();
                                                    $("#loading").hide();                        
                    })
                    
        });

        function approve(companyToken,status,type,commissionDetails){

            let datas = {};
            if(type == 'detail'){
                datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken,
                            "status":status,
                            "type":type,
                            "commissionDetails":commissionDetails
                        }
            }else{
                datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken,
                            "status":status,
                            "type":type
                        }
            }
                            
                        
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/approveProviderCompany.php",
                    data: json1
                    }).done(function(data1) {

                        if(data1.status_code == 201){
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"success",

                                }).then(()=>{
                                    location.reload();
                                });

                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }

                    })


        }

        //Verify instant without viewing details
        $('body').on('click','.verifyinstant',function(){
            let companyToken = $(this).attr('data-token');
            let status = "2";
            let type = 'instant';
            approve(companyToken,status,type);

        });

        $('body').on('click','#companydetails',function(){
            let companyToken = $(this).attr('data-token');
            let companyName = $(this).attr('data-name');
            let status = $(this).attr('data-status');
            let isCredit = $(this).attr('data-credit');
            $('.companyname').text(companyName);
            if(status == 1){
                $('.detailverify').attr('data-token',`${companyToken}`);
                $('.detailreject').attr('data-token',`${companyToken}`);
                $('.detailverify').attr('style','display:inline-block;');
                $('.detailreject').attr('style','display:inline-block;');
                $('.edit-commision-btn').addClass('hidden');
                $('.commission-submit-btn').addClass('hidden');
                setTimeout(() => {
                    $('.commission-charges').prop('disabled',false);
                }, 400);
            }else{
                $('.commission-submit-btn').addClass('hidden');
                $('.detailverify').attr('style','display:none;');
                $('.detailreject').attr('style','display:none;');
                if(isCredit == '1'){
                    $('.edit-commision-btn').removeClass('hidden');
                }else{
                    $('.edit-commision-btn').addClass('hidden'); 
                }
            }

            let datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    beforeSend: function () { $('#loading').show(); },
                    type: "POST",
                    url: apiPath+"/provider/singleProviderCompanyDetails.php",
                    data: json1
                    }).done(function(data1) {
                        console.log(data1);
                        let companyDetails = data1.companyDetails;
                        let companyToken = companyDetails.companyToken;
                        let locationDetailsarray = data1.locationDetails;
                        let commissionDetails = data1.commissionDetails;
                        $('.compbusinessname').text(companyDetails.companyName);
                        $('.compwebsite').text(companyDetails.companyWebsite);
                        $('.compbusinesscat').text(companyDetails.businessType);
                        $('.compservicelocations').text(companyDetails.totalLocations);
                        $('.compcreateddate').text(companyDetails.onboardedDate);
                        $('.compbusinesstype').text(companyDetails.category);
                        $('.compbusinesswebsite').text(companyDetails.companyWebsite);
                        $('.compinception').text(companyDetails.yearInception);
                        $('.compbusinessemail').text(companyDetails.businessEmail);
                        $('.compbusinessmobile').text(companyDetails.businessMobileNumber);
                        $('.compcontactname').text(companyDetails.primaryName);
                        $('.compdesignation').text(companyDetails.designation);
                        $('.compmob').text(companyDetails.primaryMobileNumber);
                        $('.compemail').text(companyDetails.primaryEmail);
                        $('.compaltno').text(companyDetails.alternateMobileNumber);
                        $('.compaltemail').text(companyDetails.alternateEmailId);
                        $('.compaddress').text(companyDetails.address);
                        $('.compcountry').text(companyDetails.country_name);
                        $('.compstate').text(companyDetails.state_name);
                        $('.compcity').text(companyDetails.city);
                        $('.comppin').text(companyDetails.pin_code);
                        let location_set = '';
                        
                        locationDetailsarray.forEach((list,index) => {

                            let panType = list.panCertificate.split('.').pop();
                            let panDisplay = '';
                            let gstType = list.gstCertificate.split('.').pop();
                            let gstDisplay = '';
                            let msmeType = list.msmeCertificate.split('.').pop();
                            let msmeDisplay = '';
                            let incorpType = list.incorporationCertificate.split('.').pop();
                            let incorpDisplay = '';
                            let caType = list.contractAgreement.split('.').pop();
                            let caDisplay = '';
                            let voideType = list.voideCheck.split('.').pop();
                            let voideDisplay = '';
                            let otherDocumentOneType = list.otherDocumentOne.split('.').pop();
                            let otherDocumentOneDisplay = '';
                            let otherDocumentTwoType = list.otherDocumentTwo.split('.').pop();
                            let otherDocumentTwoDisplay = '';

                            location_set += `<div class="location__set">
                            <div class="details-top-section details-top-section1 border-bottom">
                                <div class="details-top-div">
                                    <p class="top_p_color data-token="${list.locationToken}" compairport">${list.airport}</p>
                                    <p>Terminal </p>
                                </div>`;
                                if(companyDetails.status=='2'){
                                    location_set+=`<button class="creat-btn" onclick="blockLocation(${list.locationToken},${list.status})">${list.locationStatus}</button>
                                    <button class="danger-btn" onclick="blockLocation(${list.locationToken},2)">Delete</button>`;
                                }
                                location_set+=`</div>
                            <div class="details-top-section details-top-section1">
                                <div class="details-top-div">
                                    <p class="top_p_color">Account number</p>
                                    <p class="compacc">${list.accountNumber}</p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">IFSC Code</p>
                                    <p class="compifsc">${list.ifsc_code}</p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Branch</p>
                                    <p class="compbankbranch">${list.branch}</p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">City</p>
                                    <p class="compbankcity">${list.city}</p>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-content active">
                                <div class="document-view">`;
                                    if(list.panCertificate != ''){
                                        if(panType == 'pdf' || panType == 'PDF'){
                                            panDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.panCertificate}" frameborder="0"></iframe>`
                                        }else{
                                            panDisplay =  `<img  src="${list.panCertificate}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                        location_set += `<div class="document-items" id="view_panCertificate">
                                            <div class="doc-set">
                                                ${panDisplay}
                                            </div>
                                            <p class="file-name">Pan Card /Tax License Number<img class="doc-download gst-download" data-url="${list.gstCertificate}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.gstCertificate != ''){
                                        if(gstType == 'pdf' || gstType == 'PDF'){
                                            gstDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.gstCertificate}" frameborder="0"></iframe>`
                                        }else{
                                            gstDisplay =  `<img  src="${list.gstCertificate}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                       location_set += `<div class="document-items" id="view_gstCertificate">
                                            <div class="doc-set">
                                                ${gstDisplay}
                                            </div>
                                            <p class="file-name">GST/VAT <img class="doc-download gst-download" data-url="${list.gstCertificate}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.msmeCertificate != ''){
                                        if(msmeType == 'pdf' || msmeType == 'PDF'){
                                            msmeDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.msmeCertificate}" frameborder="0"></iframe>`
                                        }else{
                                            msmeDisplay =  `<img  src="${list.msmeCertificate}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                       location_set += `<div class="document-items" id="view_msmeCertificate">
                                            <div class="doc-set">
                                                ${msmeDisplay}
                                            </div>
                                            <p class="file-name">MSME Certificate <img class="doc-download msme-download" data-url="${list.msmeCertificate}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.incorporationCertificate != ''){
                                        if(incorpType == 'pdf' || incorpType == 'PDF'){
                                            incorpDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.incorporationCertificate}" frameborder="0"></iframe>`
                                        }else{
                                            incorpDisplay =  `<img  src="${list.incorporationCertificate}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                        location_set += `<div class="document-items" id="view_incorporationCertificate">
                                            <div class="doc-set">
                                                ${incorpDisplay}
                                            </div>
                                            <p class="file-name">Certificate of Incorporation <img class="doc-download incorp-download" data-url="${list.incorporationCertificate}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.contractAgreement != ''){
                                        if(caType == 'pdf' || caType == 'PDF'){
                                            caDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.contractAgreement}" frameborder="0"></iframe>`
                                        }else{
                                            caDisplay =  `<img  src="${list.contractAgreement}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                        location_set += `<div class="document-items" id="view_contractAgreement">
                                            <div class="doc-set">
                                                ${caDisplay}
                                            </div>
                                            <p class="file-name">Contract Agreement <img class="doc-download ca-download" data-url="${list.contractAgreement}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.voideCheck != ''){
                                        if(voideType == 'pdf' || voideType == 'PDF'){
                                            voideDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.voideCheck}" frameborder="0"></iframe>`
                                        }else{
                                            voideDisplay =  `<img  src="${list.voideCheck}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        
                                        location_set += `<div class="document-items" id="view_voideCheck">
                                            <div class="doc-set">
                                                ${voideDisplay}
                                            </div>
                                            <p class="file-name">Void Cheque <img class="doc-download voide-download" data-url="${list.voideCheck}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.otherDocumentOne != ''){
                                        if(otherDocumentOneType == 'pdf' || otherDocumentOneType == 'PDF'){
                                            otherDocumentOneDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.otherDocumentOne}" frameborder="0"></iframe>`
                                        }else{
                                            otherDocumentOneDisplay =  `<img  src="${list.otherDocumentOne}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                       
                                        location_set += `<div class="document-items" id="view_otherDocumentOne">
                                            <div class="doc-set">
                                                ${otherDocumentOneDisplay}
                                            </div>
                                            <p class="file-name">Other Documents One <img class="doc-download voide-download" data-url="${list.otherDocumentOne}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                                    if(list.otherDocumentTwo != ''){
                                        if(otherDocumentTwoType == 'pdf' || otherDocumentTwoType == 'PDF'){
                                            otherDocumentTwoDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.otherDocumentTwo}" frameborder="0"></iframe>`
                                        }else{
                                            otherDocumentTwoDisplay =  `<img  src="${list.otherDocumentTwo}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }
                                        location_set += `<div class="document-items" id="view_otherDocumentTwo">
                                            <div class="doc-set">
                                                ${otherDocumentTwoDisplay}
                                            </div>
                                            <p class="file-name">Other Documents Two <img class="doc-download voide-download" data-url="${list.otherDocumentTwo}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    }
                               location_set += `</div>
                            </div>
                          </div>`
                        });
                        location_set +=  `<div class="Business-cnt-text">
                                            <h1>Commission Charges</h1>
                                        </div>`
                        commissionDetails.forEach((details,index1) => {
                            location_set += `<div class="details-top-section details-top-section1 border-bottom">
                                <div class="details-top-div">
                                    <p class="top_p_color">Location</p>
                                    <p>${details.airport}</p>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Commission Charge</p>
                                    <input type="number" min="0" class="commission-charges" data-locationName="${details.airport}" data-locationToken="${details.locationToken}" disabled="true" value="${details.commissionPercentage}">
                                </div>
                            </div>`
                            
                        });
                        
                        $('.location__set-container').html(location_set);
                        $('.commission-submit-btn').attr('data-companyToken',companyToken);
                        $("#loading").hide();
                    });     
        });

        //edit commission once verified
        $('body').on('click','.edit-commision-btn',function(){
            $('.edit-commision-btn').addClass('hidden');
            $('.commission-submit-btn').removeClass('hidden');
            $('.commission-charges').prop('disabled',false);
        });

        //update commission once verified
        $('body').on('click','.commission-submit-btn',function(){
            $('.commission-charges').prop('disabled',true);
            $('.commission-submit-btn').prop('disabled',true);
            let companyToken = $(this).attr('data-companyToken');
            let commissionDetails = [];
            let commissionPercentageArray = [];
            $('.commission-charges').each((index,commissions)=>{
                let locationToken = $(commissions).attr('data-locationToken');
                let commissionPercentage = $(commissions).val();
                commissionDetails.push({
                    "locationToken":locationToken,
                    "commissionPercentage":commissionPercentage
                })
                commissionPercentageArray.push(commissionPercentage)
            })
            if(!commissionPercentageArray.includes('')){

            
            let datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken,
                            "commissionDetails":commissionDetails
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/updateServiceLocationCommission.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"success",

                                }).then(()=>{
                                    // location.reload();
                                    // $(commissionParaSelector).text(commissionPercentage);
                                    $('.edit-commision-btn').removeClass('hidden');
                                    $('.commission-submit-btn').addClass('hidden');
                                    $('.commission-submit-btn').prop('disabled',false);
                                });

                        }else{
                            $('.commission-submit-btn').prop('disabled',false);
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",

                                });
                        }
                    })
            }else{
                swal('Please enter a valid Commission Charge');
                $('.commission-submit-btn').prop('disabled',false);
            }

        })
        
        $('body').on('click','.detailverify',function(){
            let commissionDetails = [];
            let companyToken = $(this).attr('data-token');
            let status = "2";
            let type = 'detail';
            let commissionDetailArray =[]
            $('.commission-charges').each((index,commissions)=>{
                let locationToken = $(commissions).attr('data-locationToken');
                let commissionPercentage = $(commissions).val();
                commissionDetails.push({
                    "locationToken":locationToken,
                    "commissionPercentage":commissionPercentage
                })
                commissionDetailArray.push(commissionPercentage)
            })
            if(!commissionDetailArray.includes('')){
                approve(companyToken,status,type,commissionDetails);
            }else{
                swal('Commission fields cannot be empty');
            }
            

        });
        $('body').on('click','.detailreject',function(){
            let companyToken = $(this).attr('data-token');
            let status = "3";
            let type = 'reject'
            approve(companyToken,status,type);

        });

        //Block Provider
        $('body').on('click','.providerblock',function(){
            let providerToken = $(this).attr('data-token');
            swal({
                    title: "Are you sure?",
                    text: "Do you want to block the Service Provider?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willBlock)=>{
                    if(willBlock){
                        let datas = {
                                    "adminToken":adminToken,
                                    "providerToken":providerToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/blockProvider.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal("Blocked!", {icon: "success",}).then((value) => {
                                            location.reload();
                                        });
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });
                        }
                    });
                    } 
                });
        });

        // Unblock Provider
        $('body').on('click','.providerunblock',function(){
            let providerToken = $(this).attr('data-token');
            swal({
                    title: "Are you sure?",
                    text: "Do you want to unblock the Service Provider?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willBlock)=>{
                    if(willBlock){
                        let datas = {
                                    "adminToken":adminToken,
                                    "providerToken":providerToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/unBlockProvider.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal("Unblocked!", {icon: "success",}).then((value) => {
                                            location.reload();
                                        });
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });
                        }
                    });
                    }
                })
        });

        $('body').on('click','.deleteprovider',function(){
            let providerToken = $(this).attr('data-token');
            swal({
                    title: "Are you sure?",
                    text: "Do you want to delete the Service Provider?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete)=>{
                    if(willDelete){
                        let datas = {
                                    "adminToken":adminToken,
                                    "providerToken":providerToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/deleteProvider.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal("Deleted!", {icon: "success",}).then((value) => {
                                            location.reload();
                                        });
                        }else{
                            swal({
                                    title:data1.title,
                                    text:data1.message,
                                    icon:"warning",
                                });
                        }
                    });
                    }
                });
        });

        function drpDownbtnClick (file){
                if(file == 'pdf'){
                    $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
                }
                if(file == 'csv'){
                    $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
                }
        }

        function downloaddoc(url){
                fetch(url)
                    .then(resp => resp.blob())
                    .then(blobobject => {
                        const blob = window.URL.createObjectURL(blobobject);
                        const anchor = document.createElement('a');
                        anchor.style.display = 'none';
                        anchor.href = blob;
                        anchor.download = url.replace(/^.*[\\\/]/, '');
                        document.body.appendChild(anchor);
                        anchor.click();
                        window.URL.revokeObjectURL(blob);
                    })
                    .catch(() => console.log('An error in downloading the file, sorry'));
        }

        $('body').on('click','.doc-download',function(){
            let url = $(this).attr('data-url');
            downloaddoc(url);
        });
        
        $("ul.tabs-agent li").click(function() {
            var tab_id = $(this).attr("data-tab");

            $("ul.tabs-agent li").removeClass("current-active");
            $(".tab-content").removeClass("current-active");

            $(this).addClass("current-active");
            $("#" + tab_id).addClass("current-active");
        });

        var service_provider_company_token;
        function appendfirstcompanyDetails(token){
            service_provider_company_token = token;
            let datas = {
                             "adminToken":adminToken,
                            'company_token':token
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                beforeSend: function () { $('#loading').show(); },
                type: "POST",
                url: apiPath+"/provider/getBusinessInfo.php",
                data: json1
            }).done(function(data){
                let firstCompanyDetailsObject = data.data;

                //setting dropdown
               $('#businessType').val(firstCompanyDetailsObject.businessTypeToken);
               $("#businessType").trigger("chosen:updated");
                $('#select_Country').val(firstCompanyDetailsObject.countryId);
                $("#select_Country").trigger("chosen:updated").change();
                
                setTimeout(() => {
                    $('#select_State').val(firstCompanyDetailsObject.stateId);
                    $("#select_State").trigger("chosen:updated").change();
                }, 200);
                setTimeout(() => {
                    $('#select_City').val(firstCompanyDetailsObject.cityId);
                    $("#select_City").trigger("chosen:updated").change();
                }, 400);

                //setting mobile number Fields
                let businessMobile = '+'+firstCompanyDetailsObject.countryCode.replace(/[^0-9]/g,'');
                businessMobile = businessMobile +" "+firstCompanyDetailsObject.businessMobile;

                let primaryMobile = '+'+firstCompanyDetailsObject.primaryMobileCode.replace(/[^0-9]/g,'');
                primaryMobile = primaryMobile +" "+firstCompanyDetailsObject.primaryMobileNumber;

                let alternativeMobile = '+'+firstCompanyDetailsObject.alternativeMobileCode.replace(/[^0-9]/g,'');
                alternativeMobile = alternativeMobile +" "+firstCompanyDetailsObject.alternativeMobile;

                $('#business_mobile_number').val(businessMobile);
                $('#mobile_number').val(primaryMobile);
                if(firstCompanyDetailsObject.alternativeMobile != ''){
                   $('#alternative_mobile_no').val(alternativeMobile);
                }else{
                   $('#alternative_mobile_no').val(''); 
                }
                
                append_mobile(); // reinitialise to set country code and value

                //setting company image and logo
                $("#uploadedimage").attr("src", firstCompanyDetailsObject.companyLogo);
                $("#companylogourl").val(firstCompanyDetailsObject.companyLogo);
                $("#companyuploadedimage").attr("src", firstCompanyDetailsObject.companyImage);
                $("#companyimageurl").val(firstCompanyDetailsObject.companyImage);

                //setting input fields
                // $('#businessName').val('');
               $('#businessName').val(firstCompanyDetailsObject.companyName);
                $('#businessWebsite').val(firstCompanyDetailsObject.businessWebsite);
                $('#businessEmailAddress').val(firstCompanyDetailsObject.businessEmail);
                $('#yearOfInception').val(firstCompanyDetailsObject.yearOfInception);
                $('#contacted_person').val(firstCompanyDetailsObject.contactedPerson);
                $('#contactName').val(firstCompanyDetailsObject.primaryContactName);
                $('#designation').val(firstCompanyDetailsObject.designation);
                $('#emailAddress').val(firstCompanyDetailsObject.primaryEmail);
                $('#alternativeEmailAddress').val(firstCompanyDetailsObject.alternativeEmailAddress);
                $('#Address_Info').val(firstCompanyDetailsObject.addressdetails);
                $('#pincodedata').val(firstCompanyDetailsObject.pincodeDetails);
                $('#toggle4').hide();
                $('#viewBusinessinfo').show();
                $("#loading").hide();
            });
            
        }

        var iti1 = '';
        var mask1 = "";
        function append_mobile(){
            var id = ["#business_mobile_number","#mobile_number","#alternative_mobile_no"];
            id.forEach(function (value, i) {
                var phoneInputID = value;
                var input = document.querySelector(phoneInputID);
                iti1 = window.intlTelInput(input, {  
                    separateDialCode: false,
                    utilsScript: "js/utils.js"
                });
                $(phoneInputID).on("countrychange", function(event) {
                    var selectedCountryData = iti1.getSelectedCountryData();
                    newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                    newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                    newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
                    iti1.setNumber("");
                    
                    $(this).val('');
                    $(this).attr('placeholder',newPlaceholder);
                    mask1 = newPlaceholder.replace(/[1-9]/g, "0");
                    // Apply the new mask for the input
                    $(this).mask(mask1);
                    var check_mob_no_len = $(value).attr("placeholder").replace('0', '');
                    check_mob_no_len = check_mob_no_len.replace(/[^0-9]/g,'');
                });
            });
        }

    function updateBusinessInfo(){
        var pass=0;
        if(document.getElementById("companylogourl").value == ""){
            document.getElementById("userImageErr").innerHTML = "* Please Upload Company Logo !";
        }else{
            document.getElementById("userImageErr").innerHTML = "";
            pass++;
        }if(document.getElementById("companyimageurl").value == ""){
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
            var business_typeid = $('#businessType').val();
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
            var addressdetails = $('#Address_Info').val();
            var pincodedetails = $('#pincodedata').val();
            var countryid = $('#select_Country').val();
            var stateid = $('#select_State').val();
            var cityid = $('#select_City').val();

            var datas = {
                'service_provider_company_token':service_provider_company_token,
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
                'pincodedetails':pincodedetails
            };
            var json1 = JSON.stringify(datas);
        
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/provider/updateBusinessInfo.php",
                data: json1
            }).done(function(data1){
                if(data1.status_code == 200){
                    swal({
                            title:data1.title,
                            text:data1.message,
                            icon:"success",
                        }).then(()=>{
                            location.reload();
                        });
                }else{
                    swal({
                            title:data1.title,
                            text:data1.message,
                            icon:"warning",
                        });
                }
            });
        }
    }
    
    function blockLocation(locationToken, status){
        var datas = {
            'adminToken':adminToken,
            'locationToken':locationToken,
            'locationStatus':status
        }
        var json1 = JSON.stringify(datas);
        
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/provider/updateLocationStatus.php",
            data: json1
        }).done(function(data1){
            if(data1.status_code == 201){
                swal({
                        title:data1.title,
                        text:data1.message,
                        icon:"success",
                    }).then(()=>{
                        location.reload();
                    });
            }else{
                swal({
                        title:data1.title,
                        text:data1.message,
                        icon:"warning",
                    });
            }
        });
    }
    </script>
</body>

</html>
<?php
}
?>