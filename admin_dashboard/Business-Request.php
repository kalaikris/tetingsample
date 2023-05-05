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
    <title>New Service Request </title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/service_provider.css?v=<?php echo $cur_date_time; ?>">
    <link rel="stylesheet" href="css/campaign_request.css?v=<?php echo $cur_date_time; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <style>
        .dropdown {
            position: relative;
            left: 30px;
        }
    </style>
</head>

<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar2"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle4">
            <div class="product_header_container">
                <div class="header-details ">
                    <h1 class="header_main">Business Request List</h1>
                    <p class="total_emp total"></p>
                </div>
                <div class="dropdown">
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
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table businessrequests" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Service Provider ID</th>
                                <th>Service Provider Name</th>
                                <th>Business Name</th>
                                <th>Business Category</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="bg-white full-height twoback" id="toggle6" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hidemodal1()" alt="" class="backword">
                <h1 class="header_main header_main_h1"></h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">

                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Service Partner Name</p>
                            <p></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Owner Name</p>
                            <p></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Airport Code</p>
                            <p></p>
                        </div>
                         <div class="details-top-div">
                            <p class="top_p_color">Airport</p>
                            <p></p>
                        </div>
                    </div>

                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Email Address</p>
                            <p></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Contact Number</p>
                            <p></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Location</p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="manage_campaign_content">
                <div class="describtion_section">
                    <h1 class="header_main_sm">Request Message</h1>
                    <p></p>
                </div>
            </div>
            <div class="campaign_bottom_btn_section">
                <button class="verify_btn">Accept</button>
                <button class="verify_btn1" data-toggle="modal" data-target="#myModalVerify">Reject</button>
            </div>
        </section>

        <section class="bg-white full-height twoback hides" id="toggle11" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hidemodal11()" alt="" class="backword">
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
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Category</p>
                            <p class="compbusinesscat"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Total Service Locations</p>
                            <p class="compservicelocations"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Created Date</p>
                            <p class="compcreateddate"></p>
                        </div>
                    </div>
                    <div class="Business-cnt-text">
                        <h1>Business Info</h1>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Type</p>
                            <p class="compbusinesstype"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Business Website</p>
                            <p class="compbusinesswebsite"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Business Email Address</p>
                            <p class="compbusinessemail"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Business Mobile Numer</p>
                            <p class="compbusinessmobile"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1 border-bottom">
                        <div class="details-top-div">
                            <p class="top_p_color">Year of Inception</p>
                            <p class="compinception"></p>
                        </div>
                    </div>
                    <div class="Business-cnt-text">
                        <h1>Primary Contact Details</h1>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Contact Name</p>
                            <p class="compcontactname"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Designation</p>
                            <p class="compdesignation"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
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
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">Address</p>
                            <p class="compaddress"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">Country</p>
                            <p class="compcountry"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div">
                            <p class="top_p_color">state</p>
                            <p class="compstate"></p>
                        </div>
                        <div class="details-top-div">
                            <p class="top_p_color">city</p>
                            <p class="compcity"></p>
                        </div>
                    </div>
                    <div class="details-top-section details-top-section1 border-bottom">
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
                    <div class="btn-container" style="margin-top:16px;">
                        <button class="primary-btn detailverify">Verify Now</button>
                        <button class="sec-btn detailreject" data-target="#rejectModal" data-toggle="modal">Reject</button>
                    </div>
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

        <div class="modal" id="rejectModal" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Reject Reason</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="modal_input-container">
                            <div class="input__box">
                                <label class="form__label" for="rejectReason">Reject Reason</label>
                                <input type="text" name="" id="rejectReason" class="form__input" value="">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn delete_modal_btn rejectReasonButton">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!--    datepicker-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/function.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
            function hidemodal11(){
                $("#toggle4").show();
                $("#toggle11").hide();
            }
            /* Radion button box */
            $('.ratio-btn-selecter').on('click', function() {
                debugger
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
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            fetchbusinessrequests();
            $("#loading").hide();
        });

        function fetchbusinessrequests(){

            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/newBusinessList.php",
                    data: json1
                    }).done(function(data1) {
                    let requestDetailArray = data1.companyDetails;
                    $('.total').text(`Total Business Request(s) - ${requestDetailArray.length}`)
                    let requestlist = '';

                    requestDetailArray.forEach((list,index) => {

                        requestlist += `<tr>
                                            <td>${index + 1}</td>
                                            <td>${list.providerId}</td>
                                            <td>${list.providerName}</td>
                                            <td>${list.companyName}</td>
                                            <td>${list.category}</td>
                                            <td>${list.onboardedDate}</td>
                                            <td><a href="javascript:void(0)" data-token="${list.companyToken}" data-name="${list.companyName}" class="view_link" id="companydetails" onclick="showmodal3()">View Detail</a></td>
                                        </tr>`;
                        
                    });


                    $('.businessrequests tbody').html(requestlist);
                    $(".businessrequests").DataTable({
                        dom: 'Bfrtip',
                        initComplete: function() {
                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                        },
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'Business Requests',
                                exportOptions: {
                                                    columns: [0,1,2,3,4,5],
                                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'Business Requests',
                                exportOptions: {
                                                    columns: [0,1,2,3,4,5],
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

        $('body').on('click','#companydetails',function(){
            let companyToken = $(this).attr('data-token');
            let companyName = $(this).attr('data-name');
            $('.companyname').text(companyName);
            $('.detailverify').attr('data-token',`${companyToken}`);
            $('.detailreject').attr('data-token',`${companyToken}`);
            setTimeout(() => {
                $('.commission-charges').prop('disabled',false);
            }, 400);
            
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
                        let companyDetails = data1.companyDetails;
                        let locationDetailsarray = data1.locationDetails;
                        let commissionDetails = data1.commissionDetails;
                        let companyToken = companyDetails.companyToken;
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
                            let OtherDocOneType = list.otherDocumentOne.split('.').pop();
                            let OtherDocOneDisplay = '';
                            let OtherDocTwoType = list.otherDocumentTwo.split('.').pop();
                            let OtherDocTwoDisplay = '';

                            location_set += `<div class="location__set">
                            <div class="details-top-section details-top-section1 border-bottom">
                                <div class="details-top-div">
                                    <p class="top_p_color data-token="${list.locationToken}" compairport">${list.airport}</p>
                                    <p>Terminal </p>
                                </div>
                            </div>
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
                                      location_set += `<div class="document-items">
                                            <div class="doc-set">
                                                ${panDisplay}
                                            </div>
                                            <p class="file-name">Pan Card /Tax License Number<img class="doc-download gst-download" data-url="${list.panCertificate}" src="assets_new/download.svg" alt=""></p>
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
                                      location_set += `<div class="document-items">
                                            <div class="doc-set">
                                                ${gstDisplay}
                                            </div>
                                            <p class="file-name">GST/VAT<img class="doc-download gst-download" data-url="${list.gstCertificate}" src="assets_new/download.svg" alt=""></p>
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
                                        
                                        location_set += `<div class="document-items">
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
                                       
                                       location_set += `<div class="document-items">
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
                                       location_set += `<div class="document-items">
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
                                        location_set += `<div class="document-items">
                                            <div class="doc-set">
                                                ${voideDisplay}
                                            </div>
                                            <p class="file-name">Void Cheque <img class="doc-download voide-download" data-url="${list.voideCheck}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                  }
                                  if(list.otherDocumentOne != ''){
                                        if(OtherDocOneType == 'pdf' || OtherDocOneType == 'PDF'){
                                            OtherDocOneDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                            <iframe class="document-file" src="${list.otherDocumentOne}" frameborder="0"></iframe>`
                                        }else{
                                            OtherDocOneDisplay =  `<img  src="${list.otherDocumentOne}" class="document-file">
                                            <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                        }

                                       location_set += `<div class="document-items">
                                            <div class="doc-set">
                                                ${OtherDocOneDisplay}
                                            </div>
                                            <p class="file-name">Other Documents One<img class="doc-download voide-download" data-url="${list.otherDocumentOne}" src="assets_new/download.svg" alt=""></p>
                                        </div>`;
                                    
                                }
                                if(list.otherDocumentTwo != ''){
                                    if(OtherDocTwoType == 'pdf' || OtherDocTwoType == 'PDF'){
                                        OtherDocTwoDisplay =  `<img  src="assets_new/main/Image 3@2x.png" class="document-file" hidden>
                                        <iframe class="document-file" src="${list.otherDocumentTwo}" frameborder="0"></iframe>`
                                    }else{
                                        OtherDocTwoDisplay =  `<img  src="${list.otherDocumentTwo}" class="document-file">
                                        <iframe class="document-file" src="assets_new/main/Image 3@2x.png" frameborder="0" hidden></iframe>`
                                    }
                                    location_set += `<div class="document-items">
                                        <div class="doc-set">
                                            ${OtherDocTwoDisplay}
                                        </div>
                                        <p class="file-name">Other Documents Two<img class="doc-download voide-download" data-url="${list.otherDocumentTwo}" src="assets_new/download.svg" alt=""></p>
                                    </div>`;
                                }    
                             location_set += `</div>
                            </div>
                          </div>`;
                        });
                        if(companyDetails.is_credit!='0'){
                            location_set +=`<div class="Business-cnt-text">
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
                        }
                        $('.location__set-container').html(location_set);
                        $("#loading").hide();
                    });
        });

        function approve(companyToken,status,type,commissionDetails,rejectReason){
            let datas = {};
            if(type == 'detail'){
                datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken,
                            "status":status,
                            "type":type,
                            "commissionDetails":commissionDetails,
                            "rejectReason":rejectReason
                            
                        }
            }else{
                datas = {
                            "adminToken":adminToken,
                            "companyToken":companyToken,
                            "status":status,
                            "type":type,
                            "rejectReason":rejectReason
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

        $('body').on('click','.detailverify',function(){
            let commissionDetails = [];
            let companyToken = $(this).attr('data-token');
            let status = "2";
            let type = 'detail';
            var rejectReason = "";
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
                approve(companyToken,status,type,commissionDetails,rejectReason);
            }else{
                swal('Commission fields cannot be empty');
            }
            

        });

        // $('body').on('click','.detailreject',function(){
        //     let companyToken = $(this).attr('data-token');
        //     let status = "3";
        //     let type = 'reject'
        //    // approve(companyToken,status,type);

        // });
        
         $('body').on('click','.rejectReasonButton',function(){
            let companyToken = $(".detailreject").attr('data-token');
            let commissionDetails = [];
            var rejectReason = $("#rejectReason").val();
            let status = "3";
            let type = 'reject'
            approve(companyToken,status,type,commissionDetails,rejectReason);

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
                    .catch(() => console.log('An error in downloading the file sorry'));
            }

            $('body').on('click','.doc-download',function(){
                let url = $(this).attr('data-url');
                downloaddoc(url);

            })

    </script>
</body>

</html>
<?php
}
?>