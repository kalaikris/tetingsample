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
    <title>Service Distributor Management</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/manage_volunteer_list.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
</head>
<style>
    .custom-table tbody .actioncol
    {
        display: inline-block;
        padding-right: 16px;
        padding-left: 16px;
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
    </style>
<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>

    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar3"></div>

    <!-- main-contents -->
    <main class="main-contents">


        <section class="bg-white full-height" id="employee">
            <div class="product_header_container">
                <div class="header-details">
                  <div>
                    <h1 class="header_main">Service Distributor</h1>
                    <p class="order-right-content total">Total Volunteers - 499</p>
                  </div>
                  <div>
                     <button class="primary-btn" data-toggle="modal" data-target="#givecredit">Give Credit Point</button>
                     <button class="primary-btn" data-toggle="modal" data-target="#createnow" onclick="valueclear()">Create New</button> 
                  </div>
                </div>
            </div>
            <!-- Nav tabs -->
            <div class="dropdown">
                <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="">
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

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table distributorslist" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Service Distributor Name</th>
                                <th>Email Address</th>
                                <th>SiteName</th>
                                <th>Commission Charges</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div id="payments" class="table-box w3-border city">
                        <table class="custom-table" id="dataTables_filter1">
                            <thead>
                                <tr>
                                    <th>SI.No</th>
                                    <th>Date & Time</th>
                                    <th>Mode</th>
                                    <th>Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white full-height twoback" id="employee_view" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hide_empView()" alt="" class="backword">
                <h1 class="header_main header_main_h1 viewdistributorname" >Roger Potter</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">Service Distributor Name</p>
                            <p class="viewdistributorname">Sterling</p>
                        </div>
                    </div>
                      <div class="details-top-section text-cont">
                        <div class="details-top-div date">
                            <p class="top_p_color">Email Address</p>
                            <p class="viewdistributoremail">contact@6eindigo.com</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Site Name</p>
                            <p class="viewsitename">Sterling</p>
                        </div>
                         <div class="details-top-div date">
                            <p class="top_p_color">Created Date</p>
                            <p class="viewcreateddate">20 Dec 2022</p>
                        </div>
                      
                    </div>
                </div>
            </div>

            <div class="distributor-details-container">
                <h3>Distributor Details</h3>
                <div class="over-all-tab">
                    <ul class="tabs-agent">
                        <li class="tab-link current-active" data-tab="tab-1-agent-list">Agent
                            Details
                        </li>
                        <li class="tab-link" data-tab="tab-2-agent-list">Business Details
                        </li>
                        <li class="tab-link-reviw" data-tab="tab-3-agent-list">Distributor Total Users
                        </li>
                        <li class="tab-link-reviw" data-tab="tab-4-agent-list">Credit Points History
                        </li>
                    </ul>

                    <div id="tab-1-agent-list" class="tab-content
                    current-active">
                      <div class="agent_table">
                        <p class="distributor-detail-count totaldistagents">Total Agents - <span class="count"></span></p>
                        <table class="custom-table distributoragentlist" id="dataTables_filter6">
                            <thead>
                                <tr>
                                    <th>SL.No</th>
                                    <th>Agent Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                      <div class="agent_view" style="display: none;">
                        <div class="back_arrow_img_Section">
                            <img src="assets_new/main/Back arrow.png" onclick="hide_agentView()" alt="" class="backword">
                        </div>
                        <div class="clement-common">
                            <div class="clement-jhon">
                                <img class="reviewprofimage" src="./asset/clement.png" alt="">
                            </div>
                            <div class="clement-jhon-inner">
                                <div class="clement-name">
                                    <h1 class="viewagentname"></h1>
                                </div>
                                <div class="clement-jhon-inner-over-all">
                                    <div class="date">
                                        <p>Date of Birth</p>
                                        <p class="dob"></p>
                                    </div>
                                    <div class="date">
                                        <p>Agent Type</p>
                                        <p class="agenttype"></p>
                                    </div>
                                    <div class="date">
                                        <p>Business Website</p>
                                        <p class="websitereview"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="primary">
                            <h1>
                                Primary Contact Details
                            </h1>
                            <div class="primary-inner">
                                <div class="date">
                                    <p>Mobile Number</p>
                                    <p class="reviewmob"></p>
                                </div>
                                <div class="date">
                                    <p>Email Address</p>
                                    <p class="reviewmail"></p>
                                </div>
                                <div class="date">
                                    <p>Alternative Mobile Number</p>
                                    <p class="alt-mob"></p>
                                </div>
                                <div class="date">
                                    <p>Alternative Email Address</p>
                                    <p class="alt-email"></p>
                                </div>
                            </div>
                        </div>
                        <div class="primary">
                            <h1>
                                Address
                            </h1>
                            <div class="address-inner">
                                <div class="date">
                                    <p>Address</p>
                                    <p class="reviewaddress"></p>
                                </div>
                                <div class="date">
                                    <p>Country</p>
                                    <p class="reviewcountry"></p>
                                </div>
                                <div class="date">
                                    <p>State</p>
                                    <p class="reviewstate"></p>
                                </div>

                            </div>
                            <div class="address-inner-another">
                                <div class="date">
                                    <p>City</p>
                                    <p class="reviewcity"></p>
                                </div>
                                <div class="date">
                                    <p>Pincode</p>
                                    <p class="reviewpin"></p>
                                </div>
                            </div>
                        </div>
                        <div class="primary">
                            <h1 class="commissiontype"></h1>
                            <ol class="incentive-list">
                            </ol>
                        </div>
                      </div>
                    </div>
                    <div id="tab-2-agent-list" class="tab-content" >
                        <div class="business-details-container">
                           <ul class="tabs-agent1">
                                <li class="tab-link current-active" data-tab="business-info-tab">Business Info
                                </li>
                                <li class="tab-link" data-tab="bank-details-tab">Bank Details
                                </li>
                                <li class="tab-link-reviw" data-tab="service-location-tab">Service and Locations
                                </li>
                                <li class="tab-link-reviw" data-tab="documents-tab">Documents
                                </li>
                            </ul>

                            <div id="business-info-tab" class="tab-content1
                            current-active"> 
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
                                                <h4 id="get_primary_business_mob"></h4>
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
                                </div>
                            </div>
                            <div id="bank-details-tab" class="tab-content1"> 
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
                            </div>
                            <div id="service-location-tab" class="tab-content1"> 
                                <div class="">
                                    <h4 class="primary_text">Services Chosen</h4>
                                    <div class="check_cont">
                                        <div class="form-check check-box-cont">
                                           
                                           <img src="asset/img/check.png">
                                            <label class="form-check-labels ">
                                                Meet & Assist
                                            </label>
                                        </div>
                                        <div class="form-check check-box-cont">
                                           
                                            <img src="asset/img/check.png">
                                            <label class="form-check-labels ">
                                                Baggage Porter
                                            </label>
                                        </div>
                                        <div class="form-check check-box-cont">
                                            
                                             <img src="asset/img/check.png">
                                            <label class="form-check-labels ">
                                                Translators
                                            </label>
                                        </div>
                                    </div>
                                    <div class="chosen_title">
                                        <h4>Airports Chosen</h4>
                                        <ul class="chosen-airport-lists">
                                           
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                            <div id="documents-tab" class="tab-content1"> 
                                <div class="document-view">
                                    <div class="document-items" id="view_uploaded_pancard" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" alt="document file" id="view_pancard" class="document-file">
                                            <iframe id="view_pancard_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Pan Card /Tax License Number<img class="doc-download pan-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_gst" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/33f6d690-db45-4e3c-9a58-9073fea7628c" id="view_gst" alt="document file" class="document-file">
                                            <iframe id="view_gst_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">GST/VAT<img class="doc-download gst-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_msme" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_msme" alt="document file" class="document-file">
                                            <iframe id="view_msme_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">MSME Certificate <img class="doc-download msme-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_incorporation" style="display:none;">
                                        <div class="doc-set">
                                            <img src="#" id="view_incorporation" alt="document file" class="document-file">
                                            <iframe id="view_incorporation_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Certificate of Incorporation <img class="doc-download incorporationCertificate-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_void_cheque" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_void_cheque" alt="document file" class="document-file">
                                            <iframe id="view_void_cheque_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Void Cheque <img class="doc-download cheque-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_ca_card" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_ca_card" alt="document file" class="document-file">
                                            <iframe id="view_ca_card_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Contract Agreement <img class="doc-download contract-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_other_document_one" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_other_document_one" alt="document file" class="document-file">
                                            <iframe id="view_other_document_one_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Other Document One<img class="doc-download otherDocumentOne-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                    <div class="document-items" id="view_uploaded_other_document_two" style="display:none;">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_other_document_two" alt="document file" class="document-file">
                                            <iframe id="view_other_document_two_pdf" class="document-file" alt="document file" src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" ></iframe>
                                        </div>
                                        <p class="file-name">Other Document Two<img class="doc-download otherDocumentTwo-download" src="assets_new/download.svg" alt=""></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3-agent-list" class="tab-content">
                        <p class="distributor-detail-count totaldistusers">Total Users - </p>
                        <table class="custom-table distributoruserlist" id="dataTables_filter3">
                            <thead>
                                <tr>
                                    <th>SL.No</th>
                                    <th>User Name</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-4-agent-list" class="tab-content">
                        <p class="distributor-detail-count totalcredithistory">Total History - <span class="count">3</span></p>
                        <div class="campaign_top_content_section credit-points-content">
                            <div class="details-top-section">
                                <div class="details-top-div date">
                                    <p >Total Credit Points</p>
                                    <p class="credit_value totalcreditpoints">30500</p>
                                </div>
                                <div class="details-top-div date">
                                    <p>Used Credit Points</p>
                                    <p class="credit_value usercurrentpoints">30500</p>
                                </div>
                                <div class="details-top-div date">
                                    <p>Current Credit Points</p>
                                    <p class="credit_value currentcreditpoints">30500</p>
                                </div>
                            </div>
                        </div>
                        <table class="custom-table distributorcredithistory" id="dataTables_filter5">
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
        </section>

        <section class="bg-white full-height twoback" id="order_view" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hide_orderView()" alt="" class="backword">
                <h1 class="header_main header_main_h1 viewdistusername" >Roger Potter</h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="top_p_color">User Name</p>
                            <p class="viewdistusername"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Email Address</p>
                            <p class="viewdistuseremail"></p>
                        </div>
                    </div>
                    <div class="details-top-section text-cont">
                        <div class="details-top-div date">
                            <p class="top_p_color">Mobile Number</p>
                            <p class="viewdistusermob"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="top_p_color">Created Date</p>
                            <p class="viewdistusercreatedate"></p>
                        </div>
                   </div>
                </div>
            </div>

            <div class="distributor-details-container">
                <h3>Order Details</h3>
                <div class="over-all-tab">
                    <p class="distributor-detail-count totaldistuserorders">Total Orders - <span class="count">300</span></p>
                        <table class="custom-table distuserorders" id="dataTables_filter4">
                            <thead>
                                <tr>
                                    <th>SL.No</th>
                                    <th>Booking Id</th>
                                    <th>Service Airport</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </section>


        <!-- ========== MODAL POPUPS ========== -->

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
                                <label class="form__label">Service Distributor</label>
                                <select name="" id="credit-distributor" class="form__select">
                                    <option value="sterling">Sterling</option>
                                    <option value="sleepzo">SleepZo</option>
                                </select>
                            </div>
                            <div class="input__box">
                                <label class="form__label">Reference Id</label>
                                <input type="text" name="" placeholder="1000000" id="credit-reference" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label">Credit Points</label>
                                <input type="text" name="" placeholder="1000000" id="credit-points" class="form__input" autocomplete="off">
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

        <!-- create modal -->
        <div class="modal" id="createnow">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Create New</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                       <div class="modal_input-container">
                            <div class="radio-box">
                                <div class="radio-set">
                                    <input type="radio" name="distributor-type" id="internal" class="distributortype-radio" value="internal" checked>
                                    <label for="internal">Internal</label>
                                </div>
                                <div class="radio-set">
                                    <input type="radio" name="distributor-type" id="external" class="distributortype-radio" value="external">
                                    <label for="external">External</label>
                                </div>
                            </div>
                            <div class="input__box">
                                <label class="form__label">Name</label>
                                <input type="text" name="" placeholder="AIRPORTZO#98" id="servicename" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label">Email</label>
                                <input type="text" name="" placeholder="AIRPORTZO#98" id="serviceemail" class="form__input">
                            </div> 
                            <div class="input__box">
                                <label class="form__label" for="commissioncharge">Commission charge</label>
                                <input type="number" name="" placeholder="%" id="commissioncharge" class="form__input">
                            </div>
                            <div class="input__box">
                                <label class="form__label">Sitename</label>
                                <input type="text" name="" onkeypress="return event.charCode != 32" placeholder="AIRPORTZO#98" id="servicewebsite" class="form__input">
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
                            <div class="radio-box">
                               <label>Markup:</label>
                                <div class="radio-set">
                                    <input type="radio" name="is_markup" id="markup_yes" value="Yes" checked>
                                    <label for="markup_yes">Yes</label>
                                </div>
                                <div class="radio-set">
                                    <input type="radio" name="is_markup" id="markup_no" value="No">
                                    <label for="markup_no">No</label>
                                </div>
                            </div>
                            <div id="markUp_Section">
                               <div class="radio-box">
                                   <label>Markup Type :</label>
                                    <div class="radio-set">
                                        <input type="radio" name="markup-type" id="markup_percentage" class="markup-radio" value="Percentage" checked>
                                        <label for="markup_percentage">Percentage</label>
                                    </div>
                                    <div class="radio-set">
                                        <input type="radio" name="markup-type" id="markup_flat" class="markup-radio" value="Flat">
                                        <label for="markup_flat">Flat</label>
                                    </div>
                                </div>
                                <div class="input__box">
                                    <label class="form__label">Markup Value</label>
                                    <input type="number" onKeyPress="if(this.value.length==8) return false;" name="" placeholder="" id="markup_value" class="form__input">
                                </div>
                            </div>
                           <div class="membership_section">
                                <div class="radio-box">
                                   <label>Loyalty :</label>
                                    <div class="radio-set">
                                        <input type="radio" name="loyalty-type" id="loyalty_yes" class="loyalty-radio" value="Yes" checked="checked">
                                        <label for="loyalty_yes">Yes</label>
                                    </div>
                                    <div class="radio-set">
                                        <input type="radio" name="loyalty-type" id="loyalty_no" class="loyalty-radio" value="No">
                                        <label for="loyalty_no">No</label>
                                    </div>
                                </div>
                               <div class="membership_list">
                                   <div class="input__box">
                                        <label class="form__label">Membership Name</label>
                                        <input type="text" name="" placeholder="" id="membership_name" class="form__input">
                                    </div>
                                    <div class="input__box">
                                        <label class="form__label">Membership Type</label>
                                        <select class="form__select" id="membership_type">
                                            <option value="">Select MemberShip Type</option>
                                            <option value="Numeric">Numeric</option>
                                            <option value="Alphanumeric">Alphanumeric</option>
                                        </select>
                                    </div>
                                   <div class="input__box">
                                        <label class="form__label">Membership Length</label>
                                        <input type="text" name="" placeholder="" id="membership_length" onkeypress="return isNumber(event)" class="form__input" maxlength="2">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Cost</label>
                                        <input type="text" name="" placeholder="" id="cost" onkeypress="return isNumber(event)" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Points</label>
                                        <input type="text" name="" placeholder="" id="points" onkeypress="return isNumber(event)" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Partner Code</label>
                                        <input type="text" name="" placeholder="" id="partner_code" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Terms and Conditions Link1</label>
                                        <input type="text" name="" placeholder="" id="terms_and_conditions1" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Terms and Conditions Link2</label>
                                        <input type="text" name="" placeholder="" id="terms_and_conditions2" class="form__input">
                                   </div>
                              </div>
                          </div>
                       </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn createdistributor">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit modal -->
        <div class="modal" id="editnow">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                       <div class="modal_input-container">
                            <div class="input__box">
                                <label class="form__label">Name</label>
                                <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_servicename" class="form__input" disabled>
                            </div>
                            <div class="input__box">
                                <label class="form__label">Email</label>
                                <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_serviceemail" class="form__input" disabled>
                            </div> 
                            <div class="input__box">
                                <label class="form__label" for="edit_commissioncharge">Commission charge</label>
                                <input type="number" name="" placeholder="%" id="edit_commissioncharge" class="form__input">
                            </div>
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
                            <div class="radio-box">
                               <label>Markup:</label>
                                <div class="radio-set">
                                    <input type="radio" name="edit_is_markup" id="edit_markup_yes" value="Yes" checked>
                                    <label for="edit_markup_yes">Yes</label>
                                </div>
                                <div class="radio-set">
                                    <input type="radio" name="edit_is_markup" id="edit_markup_no" value="No">
                                    <label for="edit_markup_no">No</label>
                                </div>
                            </div> 
                            <div id="edit_markUp_Section">
                                <div class="radio-box">
                                   <label>Markup Type :</label>
                                    <div class="radio-set">
                                        <input type="radio" name="edit-markup-type" id="edit_markup_percentage" class="edit-markup-radio" value="Percentage" checked>
                                        <label for="edit_markup_percentage">Percentage</label>
                                    </div>
                                    <div class="radio-set">
                                        <input type="radio" name="edit-markup-type" id="edit_markup_flat" class="edit-markup-radio" value="Flat">
                                        <label for="edit_markup_flat">Flat</label>
                                    </div>
                                </div>
                                <div class="input__box">
                                    <label class="form__label">Markup Value</label>
                                    <input type="number" onKeyPress="if(this.value.length==8) return false;" name="" placeholder="" id="edit_markup_value" onkeypress="return isNumber(event)" class="form__input">
                                </div>
                            </div>
                            <div class="membership_section">
                                <div class="radio-box">
                                   <label>Loyalty :</label>
                                    <div class="radio-set">
                                        <input type="radio" name="edit_loyalty-type" id="edit_loyalty_yes" class="edit_loyalty-radio" value="Yes">
                                        <label for="edit_loyalty_yes">Yes</label>
                                    </div>
                                    <div class="radio-set">
                                        <input type="radio" name="edit_loyalty-type" id="edit_loyalty_no" class="edit_loyalty-radio" value="No">
                                        <label for="edit_loyalty_no">No</label>
                                    </div>
                                </div>
                               <div class="membership_list">
                                   <div class="input__box">
                                        <label class="form__label">Membership Name</label>
                                        <input type="text" name="" placeholder="" id="edit_membership_name" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Membership Type</label>
                                        <select class="form__select" id="edit_membership_type">
                                            <option value="">Select MemberShip Type</option>
                                            <option value="Numeric">Numeric</option>
                                            <option value="Alphanumeric">Alphanumeric</option>
                                        </select>
                                    </div>
                                   <div class="input__box">
                                        <label class="form__label">Membership Length</label>
                                        <input type="text" name="" placeholder="" id="edit_membership_length" onkeypress="return isNumber(event)" class="form__input" maxlength="2">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Cost</label>
                                        <input type="text" name="" placeholder="" id="edit_cost" onkeypress="return isNumber(event)" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Points</label>
                                        <input type="text" name="" placeholder="" id="edit_points" onkeypress="return isNumber(event)" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Parnter Code</label>
                                        <input type="text" name="" placeholder="" id="edit_parnter_code" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Terms And Conditions Link1</label>
                                        <input type="text" name="" placeholder="" id="edit_terms_conditions1" class="form__input">
                                   </div>
                                   <div class="input__box">
                                        <label class="form__label">Terms And Conditions Link2</label>
                                        <input type="text" name="" placeholder="" id="edit_terms_conditions2" class="form__input">
                                   </div>
                              </div>
                          </div>
                       </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updatedistributor">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal Block User -->
        <div class="modal" id="manageVolunteer">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Block Reason</h4>
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
    </main>

    <script src="js/jquery.min.js"></script>
    <!--    datepicker-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $cur_date_time; ?>"></script>

    <script src="js/function.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
        });

        $('#datepicker1').datepicker({
            autoclose: true,
            todayHighlight: true,
        });

        function valueclear(){
            $('#servicename').val('')
            $('#serviceemail').val('')
            $('#servicewebsite').val('')
        }
    </script>
    <script>
        var distributorarray;
        var apiPath = "<?php echo $apiPath; ?>";

        $(document).ready(() => {
            fetchdistributors();
            creditdistributorlist(); 
        });

        function fetchdistributors(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/distributor/distributorList.php",
            data: json1
            }).done(function(data1) {
                distributorarray = data1.data;
                let distributorsCount = distributorarray.length;
                let distributorsList = '';

                distributorarray.forEach((distributor,index) => {
                    let blockstatus = '';
                    if (distributor.status == 0){
                        blockstatus = `<span class="actioncol"><a href="#" data-token="${distributor.distibutorToken}" class="blockdist" data-toggle="modal" data-target="#">Block</a></span>`;

                    }else{
                        blockstatus = `<span class="actioncol"><a href="#" data-token="${distributor.distibutorToken}" class="unblockdist" data-toggle="modal" data-target="#">UnBlock</a></span>`;
                    }

                    distributorsList += `<tr>
                                            <td>${index + 1}</td>
                                            <td>${distributor.distibutorName}</td>
                                            <td>${distributor.distibutorEmail}</td>
                                            <td>${distributor.distibutorSiteName}</td>
                                            <td>${distributor.commission}</td>
                                            <td><a href="#" data-token="${distributor.distibutorToken}" onclick="view_employee()" id="viewdistdetails">View Detail</a>
                                                <a href="#" onclick="distributorDetailEdit(${index})" id="edit_distdetails" data-toggle="modal" data-target="#editnow">Edit</a>
                                            ${blockstatus}
                                            <span class="actioncol"><a href="#" data-token="${distributor.distibutorToken}" id="deletedistributor">Delete</a></span>
                                            </td>
                                        </tr>`; 
                });

                $('.total').text(`Total Distributors - ${distributorsCount}`)
                $('.distributorslist tbody').html(distributorsList);
                $('.distributorslist').DataTable({
                    dom: 'Bfrtip',
                    initComplete: function() {
                        $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                    },
                    scrollX: true,
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            title: 'Distributor Management',
                            exportOptions: {
                                                columns: [0,1,2,3],
                                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Distributor Management',
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
                $("#loading").hide(); //Main Loader Close
            });
        }

    function creditdistributorlist(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/distributor/distributorDropDown.php",
                data: json1
                }).done(function(data1) {
                    let distributorlistarray = data1.data;
                    let distributordropdown = '<option value="0">Select Distributor</option>';
                    distributorlistarray.forEach((dropdown,index) => {
                        distributordropdown += `<option value="${dropdown.distibutorToken}">${dropdown.distibutorName}</option>`;
                    });
                    $('#credit-distributor').html(distributordropdown);
                });
    }

    $('body').on('click','.addcredits',function(){
        let distributorToken = $('#credit-distributor').val();
        let referenceId = $('#credit-reference').val();
        let givenCredits = $('#credit-points').val();
        if(distributorToken != 0 && referenceId != '' && givenCredits!= ''){
            let datas = {
                            "adminToken":adminToken,
                            "distributorToken":distributorToken,
                            "givenCredits":givenCredits,
                            "referenceId":referenceId
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/updateDistributorCredits.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                        swal({
                                title:data1.title,
                                text:"Credits added Successfully",
                                icon:"success",
                            }).then(()=>{
                                location.reload();
                            });

                        }else{
                            swal({
                                    title:data1.title,
                                    text:"Credits were not added",
                                    icon:"warning",
                                });
                        }
                    });
        }else{
            if(distributorToken == 0){
                swal('Select the Distributor');
            }else if(referenceId == ''){
                swal('Reference Id is mandatory');
            }else if(givenCredits == ''){
                swal('Credits cannot be empty');
            }
        }
    });

    function isEmail(email) {
                let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return mailFormat.test(email);
    }

    function isValidURL(string) {
        var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        return (res !== null)
    };
    
    const isValidUrlForHttp = urlString=> {
        let url;
        try { 
            url =new URL(urlString); 
        }
        catch(e){ 
            return false; 
        }
        return url.protocol === "https:";
    }

    $('body').on('click','.createdistributor',function(){
        let name = $('#servicename').val().trim();
        let email = $('#serviceemail').val().trim();
        let commissionPercentage = $('#commissioncharge').val();
        let markupValue = $('#markup_value').val();
        let website=$('#servicewebsite').val().trim(); //sitename should be only string and not the usual www. or https
        let distributorPartnershipType = $('.distributortype-radio:checked').val(); //internal or external;
        let membershipName = $('#membership_name').val();
        let membershipType = $('#membership_type').val();
        let membershipLength = $('#membership_length').val();
        let isCredit = $("input[name='is_credit']:checked").val();
        let markupType = $("input[name='markup-type']:checked").val();
        let isLoyalty = $("input[name='loyalty-type']:checked").val();
        let isMarkup = $("input[name='is_markup']:checked").val();
        let cost = $('#cost').val();
        let points = $('#points').val();
        let partner_code = $('#partner_code').val();
        let terms_and_conditions1 = $('#terms_and_conditions1').val();
        let terms_and_conditions2 = $('#terms_and_conditions2').val();
        if( name != "" && email != "" && isEmail(email)  && commissionPercentage != ''){
            if(distributorPartnershipType == 'internal'){
                if(website == "" || isValidURL(website)){
                    swal("Please ensure sitename doesn't start with www or https nor doesn't have '.' at the end")
                }else {
                    if(isMarkup == 'Yes' && ((markupType == 'Percentage' && markupValue > 100) || (markupType == 'Percentage' && (markupValue == '' || markupValue == '0')) || (markupType == 'Flat' && (markupValue == '' ||  markupValue == '0')))){
                        swal("Please Check Markup Value");
                    }else if(isLoyalty == 'Yes'){
                        if(membershipName == ""){
                            swal("Please Enter Membership Name");
                        }else if(membershipType == ""){
                            swal("Please Select Membership Type");    
                        }else if(membershipLength == ""){
                            swal("Please Enter Membership Length");
                        }else if(membershipLength < 8 || membershipLength > 10){
                                swal("Please Enter Limited Length");    
                        }else if(cost == ''){
                                swal("Please Enter Costs");    
                        }else if(points == ''){
                                swal("Please Enter Points");   
                        }else if(partner_code == ''){
                                swal("Please Enter Partner Code");   
                        }else if(terms_and_conditions1 == ''){
                                swal("Please Enter Terms and Conditions Link");   
                        }else if(terms_and_conditions2 == ''){
                                swal("Please Enter Terms and Conditions Link");   
                        }else if(terms_and_conditions1 != '' && isValidUrlForHttp(terms_and_conditions1) == false){
                                swal("Please Enter Https before link");   
                        }else if(terms_and_conditions2 != '' && isValidUrlForHttp(terms_and_conditions2) == false){
                                swal("Please Enter Https before link");   
                        }else{
                                distributorcreate(name,email,commissionPercentage,website,markupValue,membershipName,membershipType,membershipLength,isLoyalty,markupType,isMarkup,cost,points,partner_code,terms_and_conditions1,terms_and_conditions2,isCredit,distributorPartnershipType); 
                        } 
                    }else{
                        membershipLength = '0';
                        cost = '0';
                        points = '0';
                        distributorcreate(name,email,commissionPercentage,website,markupValue,membershipName,membershipType,membershipLength,isLoyalty,markupType,isMarkup,cost,points,partner_code,terms_and_conditions1,terms_and_conditions2,isCredit,distributorPartnershipType);
                    }
                }
            }else{
                if(isMarkup == 'Yes' && markupValue == ''){
                    swal("Please Enter Markup Value");
                }else{
                    isLoyalty = 'No';
                    membershipName = "";
                    membershipLength = '0'; 
                    cost = '0';
                    points = '0';
                    partner_code = '0';
                    terms_and_conditions = '';
                    distributorcreate(name,email,commissionPercentage,website,markupValue,membershipName,membershipType,membershipLength,isLoyalty,markupType,isMarkup,cost,points,partner_code,terms_and_conditions1,terms_and_conditions2,isCredit,distributorPartnershipType);
                }
            }
        }else{
            if(name == ""){
                swal("Please Enter Name")
            }else if(email == "" || !isEmail(email)){
                swal("Please Enter Valid Email")
            }else if(commissionPercentage == ""){
                swal("Please Enter Commission Charge");     
            }
        }
    });

        function distributorcreate(name,email,commissionPercentage,website,markupValue,membershipName,membershipType,membershipLength,isLoyalty,markupType,isMarkup,cost,points,partner_code,terms_and_conditions1,terms_and_conditions2,isCredit,distributorPartnershipType){
            let datas = {
                            "adminToken":adminToken,
                            "distributorTypeToken":"",
                            "name":name,
                            "email":email,
                            "commissionPercentage":commissionPercentage,
                            "siteName":website,
                            "markupValue":markupValue,
                            "membershipName":membershipName,
                            "membershipType":membershipType,
                            "membershipLength":membershipLength,
                            "isLoyalty":isLoyalty,
                            "markupType":markupType,
                            "isMarkup":isMarkup,
                            "cost":cost,
                            "points":points,
                            "partnerCode":partner_code,
                            "termsAndConditions1":terms_and_conditions1,
                            "termsAndConditions2":terms_and_conditions2,
                            "isCredit":isCredit,
                            "isExternal":distributorPartnershipType
                        };
            
                    let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/addDistributor.php",
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
                        });
        }

        // on click Edit
    function distributorDetailEdit(index){
        $('.updatedistributor').attr('data-token',distributorarray[index].distibutorToken);
        $('#edit_serviceemail').val(distributorarray[index].distibutorEmail);
        $('#edit_servicename').val(distributorarray[index].distibutorName);
        $('#edit_commissioncharge').val(distributorarray[index].commission);
            if($("#edit_markup_yes").val() == distributorarray[index].isMarkup){
                $("#edit_markup_yes").prop("checked", true);
                $('#edit_markUp_Section').removeClass('hidden'); 
            }else{
                $("#edit_markup_no").prop("checked", true);
                $('#edit_markUp_Section').addClass('hidden');
            }
            if($("#edit_markup_percentage").val() == distributorarray[index].markupType){
                $("#edit_markup_percentage").prop("checked", true);
            }else{
                $("#edit_markup_flat").prop("checked", true);
            }
            if($("#edit_credit_yes").val() == distributorarray[index].is_credit){
                $("#edit_credit_yes").prop("checked", true);
            }else{
                $("#edit_credit_no").prop("checked", true);
            }
        $('#edit_markup_value').val(distributorarray[index].markupValue);
            if($("#edit_loyalty_yes").val() == distributorarray[index].isLoyalty){
                $("#edit_loyalty_yes").prop("checked", true);
                $('.membership_list').removeClass('hidden'); 
            }else{
                $("#edit_loyalty_no").prop("checked", true);
                $('.membership_list').addClass('hidden');
            }
        $('#edit_membership_name').val(distributorarray[index].membershipName);
        $('#edit_membership_type').val(distributorarray[index].membershipType);
        $('#edit_membership_length').val(distributorarray[index].membershipLength);
        $('#edit_cost').val(distributorarray[index].milesCost);
        $('#edit_points').val(distributorarray[index].milesPoint);
        $('#edit_parnter_code').val(distributorarray[index].partnerCode);
        $('#edit_terms_conditions1').val(distributorarray[index].tcLink1);
        $('#edit_terms_conditions2').val(distributorarray[index].tcLink2);
    }
      
          //Update Commission charges
    $('body').on('click','.updatedistributor',function(){
        let distributorToken = $(this).attr('data-token');
        let commissionPercentage = $('#edit_commissioncharge').val();
        let markupValue = $('#edit_markup_value').val();
        let membershipName = $('#edit_membership_name').val();
        let membershipType = $('#edit_membership_type').val();
        let membershipLength = $('#edit_membership_length').val();
        let isCredit = $("input[name='edit_is_credit']:checked").val();
        let markupType = $("input[name='edit-markup-type']:checked").val();
        let edit_isLoyalty = $("input[name='edit_loyalty-type']:checked").val();
        let isMarkup = $("input[name='edit_is_markup']:checked").val();
        let edit_cost = $('#edit_cost').val();
        let edit_points = $('#edit_points').val();
        let edit_parnter_code = $('#edit_parnter_code').val();
        let edit_terms_conditions1 = $('#edit_terms_conditions1').val();
        let edit_terms_conditions2 = $('#edit_terms_conditions2').val();
        if(commissionPercentage != ''){
            if(isMarkup == 'Yes' && ((markupType == 'Percentage' && markupValue > 100) || (markupType == 'Percentage' && (markupValue == '' || markupValue == '0')) || (markupType == 'Flat' && (markupValue == '' || markupValue == '0')))){
                    swal("Please Check the Markup Value"); 
            }else if(edit_isLoyalty == 'Yes'){
                if(membershipName == ""){
                    var setAllValue = false; 
                    swal("Please Enter Membership Name");
                }else if(membershipType == ""){
                    var setAllValue = false; 
                    swal("Please Select Membership Type");    
                }else if(membershipLength == ""){
                    var setAllValue = false; 
                    swal("Please Enter Membership Length");
                }else if(membershipLength < 8 || membershipLength > 10){
                    var setAllValue = false; 
                    swal("Please Enter Limited Length");    
                }else if(edit_cost == ""){
                    var setAllValue = false; 
                    swal("Please Enter Cost");    
                }else if(edit_points == ""){
                    var setAllValue = false; 
                    swal("Please Enter Points");    
                }else if(edit_parnter_code == ""){
                    var setAllValue = false; 
                    swal("Please Enter Partner Code");    
                }else if(edit_terms_conditions1 == ""){
                    var setAllValue = false; 
                    swal("Please Enter Terms And Conditions");    
                }else if(edit_terms_conditions2 == ""){
                    var setAllValue = false; 
                    swal("Please Enter Terms And Conditions");    
                }else if(edit_terms_conditions1 != '' && isValidUrlForHttp(edit_terms_conditions1) == false){
                    var setAllValue = false; 
                    swal("Please Enter Https before link");   
                }else if(edit_terms_conditions2 != '' && isValidUrlForHttp(edit_terms_conditions2) == false){
                    var setAllValue = false; 
                    swal("Please Enter Https before link");   
                }else{
                    var setAllValue = true; 
                } 
            }else{
                membershipName = '';
                membershipLength = '0';
                var setAllValue = true; 
            }
            if(setAllValue == true){
                let datas = {
                                "adminToken":adminToken,
                                "distributorToken":distributorToken,
                                "commissionPercentage":commissionPercentage,
                                "markupType":markupType,
                                "markupValue":isMarkup=='No'?'':markupValue,
                                "membershipName":membershipName,
                                "membershipType":membershipType,
                                "membershipLength":membershipLength,
                                "isLoyalty":edit_isLoyalty,
                                "isMarkup":isMarkup,
                                "cost":edit_cost,
                                "points":edit_points,
                                "partnerCode":edit_parnter_code,
                                "termsAndConditions1":edit_terms_conditions1,
                                "termsAndConditions2":edit_terms_conditions2,
                                "isCredit":isCredit
                            };
                
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/distributor/updateDistributorCommission.php",
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
                        });
            }
        }else{ 
                swal("Please Enter Valid Commission Charge");
        }
    });


    $('body').on('click','#viewdistdetails',function(){
        let distributorToken = $(this).attr('data-token');
        $('#view_uploaded_pancard,#view_uploaded_gst,#view_uploaded_gst,#view_uploaded_msme,#view_uploaded_incorporation,#view_uploaded_void_cheque,#view_uploaded_ca_card,#view_uploaded_other_document_one,#view_uploaded_other_document_two').hide();
        let datas = {
                    "adminToken":adminToken,
                    "distributorToken": distributorToken
                };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            beforeSend: function () { $('#loading').show(); },
            type: "POST",
            url: apiPath+"/distributor/singleDistributorDetails.php",
            data: json1
        }).done(function(data1) {
            let distdetails = data1.distributorDetails;
            let distUserlistArray = data1.userDetails;
            let distagentdetaislArray = data1.agentDetails;
            let distributorOnboardObject = data1.onboardDetails;
            let businessInfo = distributorOnboardObject.bussinessInfo;
            let bankDetails = distributorOnboardObject.bankDetails;
            let serviceAndLocations = distributorOnboardObject.serviceAndLocations;
            let documents = distributorOnboardObject.documents;
            $('.viewdistributorname').text(`${distdetails.name}`);
            $('.viewdistributoremail').text(`${distdetails.email}`);
            $('.viewsitename').text(`${distdetails.siteName}`);
            $('.viewcreateddate').text(`${distdetails.createdDate}`);
            let distributoragentdetails = '';
            distagentdetaislArray.forEach((agents,index) => {
                distributoragentdetails += `<tr>
                                                <td>${index + 1}</td>
                                                <td>${agents.name}</td>
                                                <td>${agents.email}</td>
                                                <td>${agents.mobileNumber}</td>
                                                <td><a href="#" data-disttoken="${distributorToken}" data-token="${agents.agnetToken}" class="view_link viewagentdetail" onclick="viewAgent()">View Detail</a></td>
                                            </tr>`;
            });
            $('.totaldistagents').text(`Total Agents -${distagentdetaislArray.length}`);
            $('.distributoragentlist tbody').html(distributoragentdetails);
            $('.distributoragentlist').DataTable().destroy();
            $('.distributoragentlist tbody').html(distributoragentdetails);
            $('.distributoragentlist').DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                scrollX: true,
                buttons: [
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
            $('#get_business_type').text(businessInfo.distributorType);
            $('#get_business_website').text(businessInfo.siteName);
            $('#get_primary_business_mob').text(businessInfo.primaryMobileNumber);
            $('#get_primary_business_website').text(businessInfo.primaryEmail);
            $('#get_primary_alt_phone_number').text(businessInfo.alternateMobileNumber);
            $('#get_primary_alt_email').text(businessInfo.alternateEmail);
            $('#get_address_value').text(businessInfo.address);
            $('#get_country_value').text(businessInfo.country);
            $('#get_state_value').text(businessInfo.state);
            $('#get_city_value').text(businessInfo.city_name);
            $('#get_pincode').text(businessInfo.pincode);
            $('#get_acc_number').text(bankDetails.accountNumber);
            $('#get_ifsc_code').text(bankDetails.ifscCode);
            $('#get_branch_value').text(bankDetails.branch);
            $('#get_bank_city').text(bankDetails.city);

            let selectedServices = '';
            let selectedAirports = ''
            serviceAndLocations.serviceChosen.forEach((service,index) => {
                selectedServices += `<div class="form-check check-box-cont">
                            <img src="assets_new/check.png">
                            <label class="form-check-labels ">
                                ${service.name}
                            </label>
                        </div>`;
            });
            serviceAndLocations.airportsChosen.forEach((airports,index) => {
                selectedAirports += `<li>
                                <p>${index + 1}) (${airports.code}) ${airports.name}</p>
                            </li>`;
            });
            $('.check_cont').html(selectedServices);
            $('.chosen-airport-lists').html(selectedAirports);

            let panType = documents.panCard.split('.').pop();
            let gstType = documents.gstCertificate.split('.').pop();
            let msmeType = documents.msmeCertificate.split('.').pop();
            let incorpType = documents.incorporationCertificate.split('.').pop();
            let voidchequeType = documents.voide_cheque.split('.').pop();
            let caType = documents.contractAgreement.split('.').pop();
            let otherDocOneType = documents.otherDocumentOne.split('.').pop();
            let otherDocTwoType = documents.otherDocumentTwo.split('.').pop();
            
            if(documents.panCard != ''){
                if(panType == 'pdf' || panType == 'PDF'){
                    $('#view_pancard_pdf').attr('src',`${documents.panCard}`);
                    $('#view_pancard_pdf').show();
                    $('#view_pancard').hide();
                }else{
                    $('#view_pancard').attr('src',`${documents.panCard}`);
                    $('#view_pancard').show();
                    $('#view_pancard_pdf').hide();
                }
                $('.pan-download').attr('data-url',`${documents.panCard}`);
                $('#view_uploaded_pancard').show();
            }
            if(documents.gstCertificate != ''){
                if(gstType == 'pdf' || gstType == 'PDF'){
                    $('#view_gst_pdf').attr('src',`${documents.gstCertificate}`);
                    $('#view_gst_pdf').show();
                    $('#view_gst').hide();
                }else{
                    $('#view_gst').attr('src',`${documents.gstCertificate}`);
                    $('#view_gst').show();
                    $('#view_gst_pdf').hide();
                }
                $('.gst-download').attr('data-url',`${documents.gstCertificate}`);
                $('#view_uploaded_gst').show();
            }
            if(documents.msmeCertificate != ''){
                if(msmeType == 'pdf' || msmeType == 'PDF'){
                    $('#view_msme_pdf').attr('src',`${documents.msmeCertificate}`);
                    $('#view_msme_pdf').show();
                    $('#view_msme').hide();
                }else{
                    $('#view_msme').attr('src',`${documents.msmeCertificate}`);
                    $('#view_msme').show();
                    $('#view_msme_pdf').hide();
                }
                $('.msme-download').attr('data-url',`${documents.msmeCertificate}`);
                $('#view_uploaded_msme').show();
            }
            if(documents.incorporationCertificate != ''){
                if(incorpType == 'pdf' || incorpType == 'PDF'){
                    $('#view_incorporation_pdf').attr('src',`${documents.incorporationCertificate}`);
                    $('#view_incorporation_pdf').show();
                    $('#view_incorporation').hide();
                }else{
                    $('#view_incorporation').attr('src',`${documents.incorporationCertificate}`);
                    $('#view_incorporation').show();
                    $('#view_incorporation_pdf').hide();
                }
                $('.incorporationCertificate-download').attr('data-url',`${documents.incorporationCertificate}`);
                $('#view_uploaded_incorporation').show();
            }
            if(documents.voide_cheque != ''){
                if(voidchequeType == 'pdf' || voidchequeType == 'PDF'){
                    $('#view_void_cheque_pdf').attr('src',`${documents.voide_cheque}`);
                    $('#view_void_cheque_pdf').show();
                    $('#view_void_cheque').hide();
                }else{
                    $('#view_void_cheque').attr('src',`${documents.voide_cheque}`);
                    $('#view_void_cheque').show();
                    $('#view_void_cheque_pdf').hide();
                }
                $('.cheque-download').attr('data-url',`${documents.voide_cheque}`);
                $('#view_uploaded_void_cheque').show();
            }
            if(documents.contractAgreement != ''){
                if(caType == 'pdf' || caType == 'PDF'){
                    $('#view_ca_card_pdf').attr('src',`${documents.contractAgreement}`);
                    $('#view_ca_card_pdf').show();
                    $('#view_ca_card').hide();
                }else{
                    $('#view_ca_card').attr('src',`${documents.contractAgreement}`);
                    $('#view_ca_card').show();
                    $('#view_ca_card_pdf').hide();
                }
                $('.contract-download').attr('data-url',`${documents.contractAgreement}`);
                $('#view_uploaded_ca_card').show();
            }
            if(documents.otherDocumentOne != ''){
                if(otherDocOneType == 'pdf' || otherDocOneType == 'PDF'){
                    $('#view_other_document_one_pdf').attr('src',`${documents.otherDocumentOne}`);
                    $('#view_other_document_one_pdf').show();
                    $('#view_other_document_one').hide();
                }else{
                    $('#view_other_document_one').attr('src',`${documents.otherDocumentOne}`);
                    $('#view_other_document_one').show();
                    $('#view_other_document_one_pdf').hide();
                }
                $('.otherDocumentOne-download').attr('data-url',`${documents.otherDocumentOne}`);
                $('#view_uploaded_other_document_one').show();
            } 
            if(documents.otherDocumentTwo != ''){
                if(otherDocTwoType == 'pdf' || otherDocTwoType == 'PDF'){
                    $('#view_other_document_two_pdf').attr('src',`${documents.otherDocumentTwo}`);
                    $('#view_other_document_two_pdf').show();
                    $('#view_other_document_two').hide();
                }else{
                    $('#view_other_document_two').attr('src',`${documents.otherDocumentTwo}`);
                    $('#view_other_document_two').show();
                    $('#view_other_document_two_pdf').hide();
                }
                $('.otherDocumentTwo-download').attr('data-url',`${documents.otherDocumentTwo}`);
                $('#view_uploaded_other_document_two').show();
            }

            let distributoruserdetails = '';
            distUserlistArray.forEach((distributortotalusers,index) => {
                distributoruserdetails += `<tr>
                                            <td>${index + 1}</td>
                                            <td>${distributortotalusers.name}</td>
                                            <td>${distributortotalusers.email}</td>
                                            <td>${distributortotalusers.mobileNumber}</td>
                                            <td><a href="#" class="view_link vieworders" data-disttoken="${distributorToken}" data-token="${distributortotalusers.userToken}" onclick="viewOrder()">View Orders</a></td>
                                        </tr>`;  
            });

            $('.totaldistusers').text(`Total Users -${distUserlistArray.length}`);
            $('.distributoruserlist tbody').html(distributoruserdetails);
            $('.distributoruserlist').DataTable().destroy();
            $('.distributoruserlist tbody').html(distributoruserdetails);
            $('.distributoruserlist').DataTable({
                    dom: 'Bfrtip',
                    initComplete: function() {
                        $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                    },
                    scrollX: true,
                    buttons: [
                        
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
            let creditDetailsobject = data1.creditDetails;
            let creditDetailsarray = creditDetailsobject.data;
            let creditdetails = '';
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
            $('.distributorcredithistory tbody').html(creditdetails);
            $(".distributorcredithistory").DataTable().destroy();
            $('.distributorcredithistory tbody').html(creditdetails);
            
            $(".distributorcredithistory").DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                scrollX: true,
                searching: false,
                buttons: [                                                   
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
            $("#loading").hide(); //Main Loader Close
        });
    });

    $('body').on('click','.viewagentdetail',function(){
        let agentToken = $(this).attr('data-token');
        let distributorToken = $(this).attr('data-disttoken'); 
        let datas = {
                        "adminToken":adminToken,
                        "distributorToken": distributorToken,
                        "agentToken":agentToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            beforeSend: function () { $('#loading').show(); },
            type: "POST",
            url: apiPath+"/distributor/singleDistributorAgentDetails.php",
            data: json1
        }).done(function(data1) {
            let userDetails = data1.userDetails;
            $('.reviewprofimage').attr('src',userDetails.image)
            $('.viewagentname').text(userDetails.name);
            $('.dob').text(userDetails.dob);
            $('.agenttype').text(userDetails.agentType);
            $('.websitereview').text(userDetails.website);
            $('.reviewmob').text(userDetails.primaryNumber);
            $('.reviewmail').text(userDetails.primaryEmail);
            $('.alt-mob').text(userDetails.alteranteNumber);
            $('.alt-email').text(userDetails.alteranteEmail);
            $('.reviewaddress').text(userDetails.address);
            $('.reviewcountry').text(userDetails.country);
            $('.reviewstate').text(userDetails.state);
            $('.reviewcity').text(userDetails.city);
            $('.reviewpin').text(userDetails.pincode);
            let commissionlist = '';
            userDetails.commisionDetails.forEach((incent,index) => {
                if(incent.commisionType == "1"){
                    $('.commissiontype').text('Target');
                    commissionlist += `<li> ${incent.yearlyTarget} Bookings - ${incent.percent}%</li>`
                }else{
                    $('.commissiontype').text('Incentives');
                    commissionlist += `<li> ${incent.from_amount} To ${incent.to_amount} Bookings - ${incent.percent}%</li>`;
                }
            });
            $('.incentive-list').html(commissionlist);
            $("#loading").hide(); //Main Loader Close
        });
    });

    function blockunblock(distributorToken,status){
        let datas = {
                        "adminToken":adminToken,
                        "distributorToken": distributorToken,
                        "status":status
                    };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/distributor/blockUnblockDistributor.php",
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
            });
    }

    $('body').on('click','.blockdist',function(){
        let distributorToken = $(this).attr('data-token');
        let status = "2";
        swal({
                title: "Are you sure?",
                text: "Do you want to Block the Service Distributor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willBlock)=>{
                if(willBlock){
                    blockunblock(distributorToken,status);
                }else{
                    swal('Block cancelled');
                }
            });
        
    });

    $('body').on('click','.unblockdist',function(){
        let distributorToken = $(this).attr('data-token');
        let status = "0";
        swal({
            title: "Are you sure?",
            text: "Do you want to Unblock the Service Distributor?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willBlock)=>{

            if(willBlock){

                blockunblock(distributorToken,status);

            }else{
                swal('Unblock cancelled');
            }
        }); 
    });

    $('body').on('click','.vieworders',function(){
        let userToken = $(this).attr('data-token');
        let distributorToken = $(this).attr('data-disttoken');

        let datas = {
                        "adminToken":adminToken,
                        "distributorToken": distributorToken,
                        "userToken":userToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            beforeSend: function () { $('#loading').show(); },
            type: "POST",
            url: apiPath+"/distributor/singleDistributorUserDetails.php",
            data: json1
        }).done(function(data1) {
            let userDetails = data1.userDetails;
            let orderdetailArray = data1.orderDetails;
            $('.viewdistusername').text(userDetails.name);
            $('.viewdistuseremail').text(userDetails.email);
            $('.viewdistusermob').text(userDetails.mobileNumber);
            $('.viewdistusercreatedate').text(userDetails.createdDate);
            let orderlist = '';
            orderdetailArray.forEach((orders,index) => {
                orderlist += `<tr>
                                <td>${index + 1}</td>
                                <td>${orders.bookingNumber}</td>
                                <td>${orders.serviceAirport}</td>
                                <td><a href="#" data-token="${orders.token}" class="view_link distuserorderdetails">View Order</a></td>
                            </tr>`;
            });
            $('.totaldistuserorders').text(`Total Orders - ${orderdetailArray.length}`)
            $('.distuserorders tbody').html(orderlist);
            $('.distuserorders').DataTable().destroy();
            $('.distuserorders tbody').html(orderlist);
            $('.distuserorders').DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                srollX: true,
                buttons: [
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
            $("#loading").hide(); //Main Loader Close
        });
    });

    $('body').on('click','#deletedistributor',function(){
        let distributorToken = $(this).attr('data-token');
        swal({
                title: "Are you sure?",
                text: "Do you want to delete the Service Distributor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                    let datas = {
                                "adminToken":adminToken,
                                "distributorToken":distributorToken
                            };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/deleteDistributor.php",
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
            .catch(() => console.log('An error in downloadin gthe file sorry'));
    }

    $('body').on('click','.doc-download',function(){
        let url = $(this).attr('data-url');
        downloaddoc(url);
    })

    $("ul.tabs-agent li").click(function() {
        var tab_id = $(this).attr("data-tab");
        $("ul.tabs-agent li").removeClass("current-active");
        $(".tab-content").removeClass("current-active");
        $(this).addClass("current-active");
        $("#" + tab_id).addClass("current-active");
    });

    $("ul.tabs-agent1 li").click(function() {
        var tab_id = $(this).attr("data-tab");
        $("ul.tabs-agent1 li").removeClass("current-active");
        $(".tab-content1").removeClass("current-active");
        $(this).addClass("current-active");
        $("#" + tab_id).addClass("current-active");
    });

    function hide_empView(){
        $('#employee_view').hide();
        $('#order_view').hide();
        $('#employee').show();
    }
    function hide_orderView(){
        $('#employee').hide();
        $('#order_view').hide();
        $('#employee_view').show();
    }
    function viewAgent(){
        $('.agent_table').hide();
        $('.agent_view').show();
    }
    function hide_agentView(){
        $('.agent_table').show();
        $('.agent_view').hide();
    }
    function viewOrder(){
        $('#order_view').show();
        $('#employee_view').hide();
    }

    const radioBox = document.querySelector('.radio-box');
    const distributorTypeInputs = document.querySelectorAll('.distributortype-radio');
    const radioset = document.querySelectorAll('.radio-set');
    const siteNameInput = document.querySelector('#servicewebsite');

    distributorTypeInputs.forEach(function(radio){
        radio.addEventListener('click', function(){
            if(radio.value == 'external'){
                siteNameInput.value = "";
                siteNameInput.closest('div').classList.add('hidden');
                $('.membership_section').addClass('hidden');
            }else{
                siteNameInput.closest('div').classList.remove('hidden');
                $('.membership_section').removeClass('hidden'); 
            }
        })
    });
        
    $("input[name='loyalty-type'],input[name='edit_loyalty-type']").click(function() {
        var loyalty_val = $(this).val();
        if(loyalty_val == 'No'){
            $('.membership_list').addClass('hidden');
            $('#membership_name').val('');
            $('#membership_length').val('');
            $('#membership_type').val('');
            $('#cost').val('');
            $('#points').val('');
            $('#partner_code').val('');
            $('#terms_and_conditions').val('');
        }else{
            $('.membership_list').removeClass('hidden'); 
        }
    });
        
    $("input[name='is_markup'],input[name='edit_is_markup']").click(function() {
        var is_markup = $(this).val();
        if(is_markup == 'No'){
            $('#markUp_Section').addClass('hidden');
            $('#edit_markUp_Section').addClass('hidden');
            $('#markup_value').val('');
        }else{
            $('#markUp_Section').removeClass('hidden'); 
            $('#edit_markUp_Section').removeClass('hidden'); 
        }
    });

    function isNumber(evt,value) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
<?php
}
?>