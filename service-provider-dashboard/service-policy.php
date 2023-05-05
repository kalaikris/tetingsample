<?php
session_start();
include_once '../config/core.php';
include '../security/secure.php';
if (isset($_COOKIE['service_token']) == "") {
    header("Location:login.php");
}else{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Set a Service</title>
        <link rel="shortcut icon" type="image/png" href="asset/img/airportzo-icon.png"/>
        <!-- boostrap-Modal-popup-link-->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <!-- date-->
        <link rel="stylesheet" href="css/bootstrap-icons.css"/>
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css"/>
        <link rel="stylesheet" href="css/horizontal-bar.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/commen.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/service-info.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="css/service-policy.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css">
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
        <link href="css/sweet_alert.min.css" rel="stylesheet">
        <style>
            .a_button {
                color: #00b9f5 !important;
            }
            .reupload-text {
                width: 100%;
                text-align: end;
                color: #0EB4D4;
            }
            .reupload-text label {
                cursor: pointer;
            }
            .let-add
            {
                display: flex;
                gap: 10px;
            }
            /* custon sidemenu drop down */
            .sub-product{
            }
            .sub-product label{
                width: 100%;
            }
            .Service-items{
                padding-right: 15px;
                position:relative;
            }
            .Service-items:after{
                content: '';
                display: inline-block;
                width: 0;
                height: 0;
                margin-left: 0.255em;
                vertical-align: 0.255em;
                content: "";
                border-top: 0.3em solid;
                border-right: 0.3em solid transparent;
                border-bottom: 0;
                border-left: 0.3em solid transparent;
            }
            .Service-items-desc{
                width:100%;
            }
            .Service-sub-items{
                height: 0px;
                overflow: hidden;
                opacity: 0;
                visibility: hidden;
            }
            .Service-sub-items li:not(:last-child){
                border-bottom: 1px solid #dfdede;
            }
            .Service-item{
                font: 13px/15px var(--font-regular);
                display: block;
                padding: 5px 6px;
                color: #000000b3 !important;
            }
            .Service-item:hover{
                background-color: #dbe3e5;
                color: #000;
            }
            .accodiant-radio{
                display:none;
            }
            .accodiant-radio:checked ~ .Service-sub-items{
                height: auto;
                opacity: 1;
                visibility: visible;
                transition: .5s;
                border-radius: 4px;
                padding: 0px 0px;
                background: #eff3f4;
                box-shadow: 1px 1px 7px 0px #eff3f445;
                margin: 5px 0px;
            }
            .accodiant-radio:checked ~ .Service-items:after{
                transform: rotate(180deg);
                transition: .5s;
            }
            /* -=======- */
            .service-set{
                
            }
            .service-header-text{
                font: 20px/22px var(--font-semi-bold);
                padding-bottom: 10px;
                margin:0px;
            }
            .service-subheader-text{
                font: 16px/20px 'Rubik-Regular';
                padding-bottom: 5px;
                margin:0px;
                display: flex;
                align-items: center;
            }
            .tick-icon-sm{
                width: 18px;
                margin-right: 5px;
            }
            .service-desc-main-set{
                
            }
            .service-desc-submain-set{
                margin-bottom:30px;
            }
            .service-desc-set:not(:last-child){
                margin-bottom: 5px;
            }
            .service-desc-set h4{
                font: 18px/22px var(--font-semi-bold);
                padding-bottom: 5px;
                margin:0px;
            }
            .service-desc-list{
                display:flex;
                align-items:center;
                justify-content:flex-start;
                flex-wrap:wrap;
            }
            .service-desc-list li{
                position: relative;
                width:100%;
                display:flex;
                align-items:center;
                justify-content:flex-start;
            }
            .service-desc-list li:not(:last-child){
                padding-bottom: 15px;
            }
            .service-desc-list li p:not(:last-child):after{
                content: '';
                /* border-right: 1px solid #000;
                position: absolute;
                top:0px;
                right:15px;
                width:2px;
                height:100%; */
            }
            .service-desc-list li p{
                font: 16px/18px var(--font-rgular);
                color: var(--color-default);
                margin:0px;
                padding-right:50px;
            }
            .ser-incl-text{
                font-weight: 600;
                font-family: "Rubik-Regular";
            }
            .comen-set-box11 {
                background: var(--color-white);
                padding: 30px 50px 20px 50px;
                border-radius: 13px;
                border: 1px solid var(--color-seconday);
            }
        </style>
    </head>
    <body id="page">
        <div id="loading"></div>
        <header id="header"></header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar"></div>
                <div class="slider-desc-set">
                    <div class="top-head">
                        <div class="list-tital">
                            <h3 class="cont-name">Services and policies</h3>
                        </div>
                        <div class="edit-service">
                            <button class="click-serv" data-toggle="modal" data-target="#edit_service" onclick="edit_service()" id="edit_service_btn">Edit Service</button>
                        </div>
                    </div>
                    <div class="comen-set-box hidden">
                        <div class="vertical-pragarss">
                            <div class="details_list">
                                <ul>
                                    <li class="active business-Info" id="step1">
                                        <p class="shop_staus-name">Business Info</p>
                                        <span class="tick"></span>
                                    </li>
                                    <li class="service-details" id="step2">
                                        <p class="shop_staus-name">Service details</p>
                                        <span class="tick"></span>
                                    </li>
                                    <li class="policy-details" id="step3">
                                        <p class="shop_staus-name">Policydetails</p>
                                        <span class="tick"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <section class="step-content-items busines-info" id="busines_info">
                            <div class="sub-form-header">
                                <h3>Location</h3>
                                <p>Tell us where your business is located</p>
                            </div>
                            <div class="input-form-group">
                                <div class="input-form-group-item disabled">
                                    <div class="input-box-set">
                                        <label for="airport">Airport</label>
                                        <input id="airport_token" type="hidden">
                                        <input type="text" class="input-box" id="airportname" placeholder="Airport Name" disabled>
                                    </div>
                                </div>
                                <div class="text-cont-title">
                                    <div class="input-form-group-items">
                                        <div class="input-box-set">
                                            <label for="coordinates">Coordinates</label>
                                            <input type="text" class="input-box" id="coordinates_input" placeholder="Enter Coordinates">
                                        </div>
                                        <div class="possword-group">
                                            <img src="./asset/img/kanpoin.png" alt="view eye" id="coordinates_icon" class="eye-icon" onclick="getLocation()" data-value="#password" data-toggle="false">
                                        </div>
                                    </div>
                                    <div class="">
                                        <p id="coordinates_inputErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Let people know more about your business</h3>
                                <p>Give a brief about your business</p>
                            </div>
                            <div class="input-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <textarea name="message" style="width:100%; height:100px" id="shop_message" maxlength="500"></textarea>
                                    </div>
                                </div>
                                <p id="shop_messageErr" style="color:red; font-size: 13px;"></p>
                                <p>Maximum characters <span id="charttext"> 500</span></p>
                            </div>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Let's add your business photos</h3>
                                <p>Give a brief about your business</p>
                            </div>
                            <div class="img-upload-group">
                                <div class="img-upload-items">
                                    <label for="shopimage1" class="upload-label border">
                                        <img src="asset/img/upload-image@2x.png" id="view_shopimage1" class="upload-icon" alt="upload icon">
                                        <input id="valid_shopimage1" type="hidden">
                                    </label>
                                    <div class="reupload-text">
                                        <label for="shopimage1" id="shopimagename_hide1" style="display:none;">Reupload</label>
                                    </div>
                                    <input type="file" id="shopimage1" class="hidden" onchange="ValidateFileUpload('shopimage1')" style="display: none;cursor: pointer;">
                                    <p id="shopimage1Err" style="color:red; font-size: 13px;"></p>
                                </div>
                                <div class="img-upload-items">
                                    <label for="shopimage2" class="upload-label border">
                                        <img src="asset/img/upload-image@2x.png" id="view_shopimage2" class="upload-icon" alt="upload icon">
                                        <input id="valid_shopimage2" type="hidden">
                                    </label>
                                    <div class="reupload-text">
                                        <label for="shopimage2" id="shopimagename_hide2" style="display:none;">Reupload</label>
                                    </div>
                                    <input type="file" id="shopimage2" class="hidden" onchange="ValidateFileUpload('shopimage2')" style="display: none; cursor: pointer;">
                                    <p id="shopimage2Err" style="color:red; font-size: 13px;"></p>
                                </div>
                                <div class="img-upload-items">
                                    <label for="shopimage3" class="upload-label border">
                                        <img src="asset/img/upload-image@2x.png" id="view_shopimage3" class="upload-icon" alt="upload icon">
                                        <input id="valid_shopimage3" type="hidden">
                                    </label>
                                    <div class="reupload-text">
                                        <label for="shopimage3" id="shopimagename_hide3" style="display:none;">Reupload</label>
                                    </div>
                                    <input type="file" id="shopimage3" class="hidden" onchange="ValidateFileUpload('shopimage3')" style="display: none; cursor: pointer;">
                                    <p id="shopimage3Err" style="color:red; font-size: 13px;"></p>
                                </div>
                            </div>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Add amenities</h3>
                                <p>Choose the amenities which your business provides</p>
                            </div>
                            <div class="add-amenities-set">
                                <ul id="service_amentitiesList"></ul>
                            </div>
                            <p id="amentitiessErr" style="color:red; font-size: 13px;"></p>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Business hours</h3>
                                <p>Set the operating Hours for your Business. only during these times you will receive bookings</p>
                                <button type="button" class="btn btn-secondary" onclick="business_working_hours()">Apply to All Days</button>
                            </div>
                            <div class="week-group">
                                <ul class="day-items">
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Monday</h4>
                                                <label for="monday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="monday" value="monday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox1'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox1'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Tuesday</h4>
                                                <label for="tuesday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="tuesday" value="tuesday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox2'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox2'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Wednesday</h4>
                                                <label for="wednesday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="wednesday" value="wednesday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox3'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox3'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Thursday</h4>
                                                <label for="thursday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="thursday" value="thursday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox4'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox4'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Friday</h4>
                                                <label for="friday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="friday" value="friday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox5'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox5'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Saturday</h4>
                                                <label for="saturday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="saturday" value="saturday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox6'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right ">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox6'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="day-item">
                                        <div class="choose-day-input-group">
                                            <div class="holiday-group">
                                                <h4>Sunday</h4>
                                                <label for="sunday" class="holiday-label-group">
                                                    <input type="checkbox" class="day-check-box" id="sunday" value="sunday">
                                                    <p>Holiday</p>
                                                </label>
                                            </div>
                                            <div class="input-form-group cust-input-group open1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox7'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="open_time">Open time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-form-group cust-input-group close1">
                                                <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox7'>
                                                    <div class="select-group">
                                                        <span class="input-group-addon bg-time"></span>
                                                    </div>
                                                    <div class="input-box-set border-right">
                                                        <label for="close_time">Close time</label>
                                                        <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <p id="businesshoursErr" style="color:red; font-size: 13px;"></p>
                            <div class="aromark">
                                <button class="step-btn" current-step="#busines_info" next-step="#service_detail_sec" data-step="#step1" onclick="business_info()">
                                    <img src="./asset/img/aaro-icon.png" class="aaro-icon" alt="aaro" />
                                </button>
                            </div>
                        </section>
                        <section class="step-content-items service-detail-sec hide" id="service_detail_sec">
                            <div class="btn-set">
                                <button class="cust-btn cust-btn-primary cust-btn-sm" data-toggle="modal" data-target="#myModal">Upload CSV</button>
                                <a class="a_button " href="samplecsv/Sample_Individual_Bundled.csv" download><button class="File-btn" type="button">Sample CSV File</button></a>
                            </div>
                            <div class="aromark">
                                <button class="step-btn" current-step="#service_detail_sec" next-step="#policy_detail_sec" data-step="#step2" onclick="Nextpage()">
                                    <img src="./asset/img/aaro-icon.png" class="aaro-icon" alt="aaro">
                                </button>
                            </div>
                        </section>
                        <section class="step-content-items policy-detail-sec hide" id="policy_detail_sec">
                            <div class="total-box">
                                <div class="main-terms-condin">
                                    <div class="tac-box">
                                        <div class="rait-tital">
                                            <h3>Terms and conditions</h3>
                                            <p id="showterms">Let's add your terms and condition</p>
                                        </div>
                                        <div class="let-add">
                                            <button class="cust-btn cust-btn-primary cust-btn-sm terms-btn-hide" data-toggle="modal" data-target="#terms_condition">Let's Add</button>
                                            <img class="terms-edit-btn" src="asset/edit.png" data-toggle="modal" data-target="#terms_condition" style="display:none;">
                                            <img class="terms-delete-btn" src="asset/delete.png" onclick="deleteterms()" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="main-terms-condin">
                                    <div class="tac-box">
                                        <div class="rait-tital">
                                            <h3>Privacy Policy</h3>
                                            <p id="showprivacy">Let's add your privacy policy</p>
                                        </div>
                                        <div class="let-add">
                                            <button class="cust-btn cust-btn-primary cust-btn-sm privacy-btn-hide" data-toggle="modal" data-target="#privacy_policy">Let's Add</button>
                                            <img class="privacy-edit-btn" src="asset/edit.png" data-toggle="modal" data-target="#privacy_policy"  style="display:none;">
                                            <img class="btn-danger privacy-delete-btn" src="asset/delete.png" onclick="deleteprivacy()" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="main-terms-condin">
                                    <div class="tac-box">
                                        <div class="rait-tital">
                                            <h3>Cancellation Policy</h3>
                                            <p id="showcancellation">Let's add your Cancellation policy</p>
                                        </div>
                                        <div class="let-add">
                                            <button class="cust-btn cust-btn-primary cust-btn-sm cancel-btn-hide" data-toggle="modal" data-target="#cancel_policy">Let's Add</button>
                                            <img class="cancel-edit-btn" src="asset/edit.png" data-toggle="modal" data-target="#cancel_policy"  style="display:none;">
                                            <img class="btn-danger cancel-delete-btn" src="asset/delete.png" onclick="deletecancel()" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="main-terms-condin">
                                    <div class="tac-box">
                                        <div class="rait-tital">
                                            <h3>Re-Schedule Policy</h3>
                                            <p id="showreschedule">Let's add your Reschedule policy</p>
                                        </div>
                                        <div class="let-add">
                                            <button class="cust-btn cust-btn-primary cust-btn-sm reschedule-btn-hide" data-toggle="modal" data-target="#reschedule__policy">Let's Add</button>
                                            <img class="reschedule-edit-btn" src="asset/edit.png" data-toggle="modal" data-target="#reschedule__policy"  style="display:none;">
                                            <img class="btn-danger reschedule-delete-btn" src="asset/delete.png" onclick="deletereschedule()" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-set">
                                    <button class="cust-btn cust-btn-success cust-btn-xl" onclick="go_to_service_info()">Submit</button>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="main-tab-head">
                      <div class="con-tabs">
                        <div class="tabs">
                            <ul id="tabs-nav">
                                <li><a href="#tab1">Business Info</a></li>
                                <li><a href="#tab2">Service Details</a></li>
                                <li><a href="#tab3">Policies</a></li>
                            </ul>
                            <div class="single-line"></div>
                            <div id="tabs-content">
                            <!--business-info-->
                            <div id="tab1" class="tab-content">
                                <input type="hidden" id="ProviderLocationtoken">
                                <div class="main-pranaam">
                                    <div class="pranaam-img">
                                        <img id="company_image" src="asset/img/pranaam@img.png" width:100px; height:100px; class="pranaa-icon" alt="company_photo">
                                    </div>
                                    <div class="prana-sub-tital">
                                        <h2 class="business-pranaa" id="company_name"></h2>
                                        <p class="gray">Business Types</p>
                                        <h5 class="business-no-types" id="bussiness_type"></h5>
                                    </div>
                                    <div class="business-web">
                                        <p class="gray">Business Website</p>
                                        <h5 class="business-no-types" id="business_website"></h5>
                                    </div>
                                </div>
                                <div class="single-line"></div>
                                <div class="business-locat">
                                    <div class="locat-tital">
                                        <h3 class="business-pranaa">Location</h3>
                                        <p class="gray">Airport</p>
                                        <input id="airport__token" type="hidden">
                                        <h5 class="business-no-types" id="airport_name"></h5>
                                    </div>
                                    <div class="buss-co-ord">
                                        <p class="gray">Coordinates</p>
                                        <h5 class="business-no-types" id="coordinates_location"></h5>
                                    </div>
                                </div>
                                <div class="single-line"></div>
                                <div class="main-brief">
                                    <div class="buss-shop">
                                        <h3 class="business-pranaa">Brief about business</h3>
                                        <h5 class="business-no-types-pagar" id="briefly_about_shop"></h5>
                                        <div class="hotal-pic" id="service_shop_image"></div>
                                    </div>
                                </div>
                                <div class="main-amenities">
                                    <div class="buss-amen">
                                        <h3 class="business-pranaa">Amenities</h3>
                                    </div>
                                    <div class="head-opeations">
                                        <div class="add-amenities-set">
                                            <ul id="service_amentities_list"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-business-hours">
                                    <div class="buss-hours">
                                        <div class="fooder-head-tital">
                                            <h3 class="business-pranaa">Business hours</h3>
                                        </div>
                                        <div>
                                            <ul class="main-month" id="business_hours_list">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- service-details -->
                            <div id="tab2" class="tab-content">
                                <div class="serivce-detail-container">
                                    <ul id="tabs-nav2" class="box-tabs">
                                        <li><a href="#bundle-service-list-view">Bundled Services</a></li>
                                        <li><a href="#service_details_individualview">Individual Services</a></li>
                                    </ul>
                                    <button class="cust-btn cust-btn-primary" data-toggle="modal" data-target="#update_uploadcsv">Upload CSV</button>
                                    <div id="bundle-service-list-view" class="tab-content2 bundle-service-container"></div>
                                    <div id="service_details_individualview" class="tab-content2 individual-service-container">
                                    <!-- <div id="individual_package_list"></div> -->
                                    </div>
                                </div>
                            </div>

                          <!-- policies -->
                          <div id="tab3" class="tab-content">
                            <div class="main-policies">
                                <div class="main-silver">
                                    <div class="silver-tital">
                                        <div id="section">
                                            <div class="article">
                                                <h5>Terms and conditions</h5>
                                            </div>
                                            <div class="read-button">
                                                <a class="moreless-button2" id="terms_and_condition_list">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              <!-- policies-box2 -->
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Privacy Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <a class="moreless-button3" id="privacy_policy_list">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <!-- policies-box3 -->
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Cancellation Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <a class="moreless-button4" id="cancellation_policy">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="set_cancellation_charge_listview">
                                <div class="set-cancelled">
                                    <div class="main-changing">
                                        <div class="set-charage-tital">
                                            <h3>Set Cancellation charges :</h3>
                                        </div>
                                        <div class="show_charges_list">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Reschedule Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <a class="moreless-button5" id="reschedule_policylist"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </main>

        <!--Create Upload CSV-->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Upload CSV File</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row cont-text-title">
                            <label class="upload_filed" for="csv_file_upload">
                                <input id="csv_file_valid" type="hidden">
                                <input id="csv_file_upload" onchange="file_upload_csv('csv_file','csv_view_url','asset/upload_csv_done.png')" type="file" accept=".csv" style="display:none;">
                                <img alt="" src="asset/csvfile.png" class="csvfile" id="csv_view_url" />
                                <h2 id="csv_file_name">Upload Files</h2>
                            </label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="cancelbtn" data-dismiss="modal" onclick="cancelcsvfile()">Cancel</button>
                        <button type="button" class="savebtn" id="csv_upload_button">Upload</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Create Upload CSV-->

        <!------------------Terms and Condition------------------>
        <div class="modal fade" id="terms_condition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    <div class="modal-body-set">
                        <div class="modal-header-service border-none">
                            <h5 class="modal-title" id="exampleModalLongTitle-service">Terms and Conditions</h5>
                            <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-md-12 pad0">
                            <div id="terms_and_condition"></div>
                        </div>
                        <p id="terms_and_conditionErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                        <div class="popup-btn-set">
                            <button class="cust-btn cust-btn-xl cust-btn-success" onclick="termsandcondition()">Add Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Terms and Condition------------------>

        <!------------------Privacy Policy------------------>
        <div class="modal fade" id="privacy_policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    <div class="modal-body-set">
                        <div class="modal-header-service border-none">
                            <h5 class="modal-title" id="exampleModalLongTitle-service">Privacy Policy</h5>
                            <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-md-12 pad0">
                            <div id="privacy_and_policy"></div>
                        </div>
                        <p id="privacy_and_policyErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                        <div class="popup-btn-set">
                            <button class="cust-btn cust-btn-xl cust-btn-success" onclick="privacypolicy()">Add Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Privacy Policy------------------>

        <!------------------Cancellation Policy------------------>
        <div class="modal fade" id="cancel_policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    <div class="modal-body-set">
                        <div class="modal-header-service border-none">
                            <h5 class="modal-title" id="exampleModalLongTitle-service">Cancellation Policy</h5>
                            <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-md-12 pad0">
                            <div id="cancellattion_policy"></div>
                        </div>
                        <p id="cancellattion_policyErr" style="color: red;font-size: 13px; padding-top:8px; font-weight: 600;"></p>
                        <div class="col-md-12 set_cancellation_charge">
                            <div class="set-cancelled">
                                <div class="main-changing">
                                    <div class="set-charage-tital">
                                        <h3>Set Cancellation charges :</h3>
                                    </div>
                                    <div class="add-charage-clicker">
                                        <p onclick="multipleCancellationCharges()" class="mb-3">Add charges</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup-btn-set">
                            <button class="cust-btn cust-btn-xl cust-btn-success" onclick="cancelpolicy()">Add Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Cancellation Policy------------------>

        <!------------------Reschedule Policy------------------>
        <div class="modal fade" id="reschedule__policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    <div class="modal-body-set">
                        <div class="modal-header-service border-none">
                            <h5 class="modal-title" id="exampleModalLongTitle-service">Re-Schedule Policy</h5>
                            <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="col-md-12 pad0 text-center">
                            <textarea name="message" style="width:80%; height:100px;border:1px solid #eee;border-radius:8px;" id="reschedulepolicy" placeholder="Re-Schedule Policy" maxlength="500"></textarea>
                        </div>
                        <p id="reschedulepolicyErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                        <div class="popup-btn-set">
                            <button class="cust-btn cust-btn-xl cust-btn-success" onclick="reschedule_policy()">Add Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Reschedule Policy------------------>
        <!------------------Update Modal Start------------------->
        <div class="modal fade edit_service-modal" id="edit_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="comen-set-box12 comen-set-box11">
                        <div class="vertical-pragarss">
                            <div class="details_list">
                                <ul>
                                    <li class="active edit-business-Info" id="step1">
                                        <p class="shop_staus-name">Business Info</p>
                                        <span class="tick"></span>
                                    </li>
                                    <!-- <li class="edit-service-details" id="step2">
                                        <p class="shop_staus-name">Service details</p>
                                        <span class="tick"></span>
                                    </li> -->
                                    <li class="edit-policy-details" id="step3">
                                        <p class="shop_staus-name">Policydetails</p>
                                        <span class="tick"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <section class="step-content-items busines-info" id="edit_busines_info">
                            <div class="sub-form-header">
                                <h3>Location</h3>
                                <p>Tell us where your business is located</p>
                            </div>
                            <div class="input-form-group">
                                <div class="input-form-group-item disabled">
                                    <div class="input-box-set">
                                        <label for="airport">Airport</label>
                                        <input id="airport_token" type="hidden">
                                        <input type="text" class="input-box" id="edit_airportname" placeholder="Airport Name" disabled>
                                    </div>
                                    <p id="edit_airportnameErr" style="color: red; font-size: 13px;"></p>
                                </div>
                                <div class="text-cont-title">
                                    <div class="input-form-group-items">
                                        <div class="input-box-set">
                                            <label for="coordinates">Coordinates</label>
                                            <input type="text" class="input-box" id="edit_coordinates_input" placeholder="Enter Coordinates">
                                        </div>
                                        <div class="possword-group">
                                            <img src="asset/img/kanpoin.png" alt="view eye" id="edit_coordinates_icon" class="eye-icon" onclick="edit_getLocation()" data-value="#password" data-toggle="false">
                                        </div>
                                    </div>
                                    <div class="">
                                        <p id="edit_coordinates_inputErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Let people know more about your business</h3>
                                <p>Give a brief about your business</p>
                            </div>
                            <div class="input-form-group">
                                <div class="input-form-group-item col-12">
                                    <div class="input-box-set">
                                        <textarea name="message" style="width:100%; height:100px" id="edit_shop_message" maxlength="500"></textarea>
                                    </div>
                                </div>
                                <p id="edit_shop_messageErr" style="color:red; font-size: 13px;"></p>
                                <p>Maximum characters <span id="edit_charttext"> 500</span></p>
                            </div>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Let's add your business photos</h3>
                                <p>Give a brief about your business</p>
                            </div>
                            <div class="edit-img-upload-group">
                            </div> 
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Add amenities</h3>
                                <p>Choose the amenities which your business provides</p>
                            </div>
                            <div class="add-amenities-set">
                                <ul id="edit_service_amentitiesList"></ul>
                            </div>
                            <p id="edit_amentitiessErr" style="color:red; font-size: 13px;"></p>
                            <div class="form-divider"></div>
                            <div class="sub-form-header">
                                <h3>Business hours</h3>
                                <p>Set the operating Hours for your Business. only during these times you will receive bookings</p>
                            </div>
                            <div class="week-group">
                                <ul class="day-items edit_business_hours">
                                </ul>
                            </div>
                            <p id="edit_businesshoursErr" style="color:red; font-size: 13px;"></p>
                            <div class="aromark">
                                <button class="step-btn" current-step="#busines_info" next-step="#policy_detail_sec" data-step="#step3" onclick="edit_business_info()">
                                    <img src="asset/img/aaro-icon.png" class="aaro-icon" alt="aaro" />
                                </button>
                            </div>
                        </section>
                        <!-- <section class="step-content-items service-detail-sec hide" id="edit_service_detail_sec">
                            <div class="main-setvice-details">
                                <h2>Bundled packages</h2>
                            </div>
                            <div class="service-set" id="edit_service_details_listview"></div>
                            <div class="single-line"></div>
                            <div>
                                <h2 class="ind-service-main-head">Individual Services</h2>
                            </div>
                            <div class="service-set" id="edit_service_details_individualview"></div>
                             <div class="aromark">
                                <button class="step-btn" current-step="#service_detail_sec" next-step="#policy_detail_sec" data-step="#step2" onclick="edit_nextpage()">
                                    <img src="./asset/img/aaro-icon.png" class="aaro-icon" alt="aaro">
                                </button>
                            </div>
                        </section> -->
                        <section class="step-content-items policy-detail-sec hide" id="edit_policy_detail_sec">
                            <div class="total-box">
                                <div class="main-policies">
                                <div class="main-silver">
                                    <div class="silver-tital">
                                        <div id="section">
                                            <div class="article">
                                                <h5>Terms and conditions</h5>
                                            </div>
                                            <div class="read-button">
                                                <a class="moreless-button2" id="edit_terms_and_condition_list">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              <!-- policies-box2 -->
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Privacy Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <a class="moreless-button3" id="edit_privacy_policy_list">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <!-- policies-box3 -->
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Cancellation Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <a class="moreless-button4" id="edit_cancellation_policy">Read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="set_cancellation_charge">
                                <div class="set-cancelled">
                                    <div class="main-changing">
                                        <div class="set-charage-tital">
                                            <h3>Set Cancellation charges :</h3>
                                        </div>
                                        <div class="add-charage-clicker edit_show_charges_list">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-silver">
                                <div class="silver-tital">
                                    <div id="section">
                                        <div class="article">
                                            <h5>Reschedule Policy</h5>
                                        </div>
                                        <div class="read-button">
                                            <textarea name="message" style="width:100%; height:100px" id="edit_reschedule_policy" placeholder="Re-Schedule Policy" maxlength="500"></textarea>
                                        </div>
                                        <p id="edit_reschedule_policyErr" style="color:red; font-size: 13px;"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-set d-flex">
                                <button class="step-btn" current-step="#busines_info" next-step="#policy_detail_sec" data-step="#step1" onclick="goBackToEditBusiness()" style="transform: rotate(180deg);">
                                    <img src="asset/img/aaro-icon.png" class="aaro-icon" alt="aaro">
                                </button>
                                <button class="cust-btn cust-btn-success cust-btn-xl" onclick="update_service_details()">Sumbit</button>
                            </div>
                            </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Update Modal Stop------------------->

        <!------------------View More Bundled Package------------------>
        <div class="modal fade" id="view_service-package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="bundled_view_more_package">
                    <div class="modal-header justify-content-center mb-4">
                        <h4 class="modal-title" id="list_bundled_service_name"></h4>
                        <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body-set">
                      <div class="service-pacakge-container">
                        <div class="silver-table">
                            <div class="silver-table-header">
                                <h1 id="bundled_category"></h1>
                                <span id="bundled_airporttype"></span>
                            </div>
                            <div class="service-includ-set">
                                <div class="silver-adult-common">
                                    <div>
                                        <div class="silver-adult">
                                            <h1 id="bundled_adultrate"></h1>
                                        </div>
                                        <div class="silver-child">
                                            <h1 id="bundled_childrate"></h1>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="silver-adult">
                                            <h1 id="bundled_additional_adultrate"></h1>
                                        </div>
                                        <div class="silver-child">
                                            <h1 id="bundled_additional_childrate"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="service-features">
                                <div class="read-header">
                                   <h1>Features : </h1>
                                </div>
                                <div class="article" id="bundled_feature"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------View More Bundled Package------------------>

        <!------------------Edit Bundled Package------------------>
        <div class="modal fade" id="edit_service-package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center mb-4">
                        <h4 class="modal-title" id="edit_serviceName"></h4>
                        <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body-set">
                        <div class="service-pacakge-container">
                            <div class="silver-table">
                                <div class="service-includ-set mb-0">
                                    <div class="input-form-group mb-0">
                                        <div class="text-box-group">
                                            <div class="input-form-group-item">
                                                <div class="input-box-set">
                                                    <p>Choose Category</p>
                                                    <select id="edit_bundled_category" onchange="edit_airporttype()"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group" style="display:none;" id="choose_airport_type">
                                            <div class="input-form-group-item">
                                                <div class="input-box-set">
                                                    <p>Choose Airport Type</p>
                                                    <select id="edit_airport_type"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-price-inputs">
                                    <div class="input-form-group mt-0">
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for adult</p>
                                                    <input type="text" class="input-box" id="edit_adult_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for child</p>
                                                    <input type="text" class="input-box" id="edit_child_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for additional adult</p>
                                                    <input type="text" class="input-box" id="edit_additional_adult_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for additional child</p>
                                                    <input type="text" class="input-box" id="edit_additional_child_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p><img src="asset/info.svg" alt=""> Adult - 12years and above, Child - 2 to 11 years</p> -->
                                </div>
                                <div class="service-features">
                                    <div class="read-header">
                                        <h1>Features : </h1>
                                    </div>
                                    <div class="article" id="bundled_feature_list"></div>
                                    <input type="hidden" id="bundled_service_locationToken">
                                    <input type="hidden" id="bundled_service_Token">
                                </div>
                                <div class="btn-container text-center mt-5">
                                    <button class="cust-btn cust-btn-success" onclick="update_bundled_service()">Update service</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Edit Bundled Package------------------>

        <!------------------View More Individual Package------------------>
        <div class="modal fade" id="view_individual_service_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="individual_view_more_package">
                    <div class="modal-header justify-content-center mb-4">
                        <h4 class="modal-title" id="list_individual_service_name"></h4>
                        <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body-set">
                      <div class="service-pacakge-container">
                        <div class="silver-table">
                            <div class="silver-table-header">
                                <h1 id="individual_category"></h1>
                                <span id="individual_airporttype"></span>
                            </div>
                            <div class="service-includ-set">
                                <div class="silver-adult-common">
                                    <div>
                                        <div class="silver-adult">
                                            <h1 id="individual_adultrate"></h1>
                                        </div>
                                        <div class="silver-child">
                                            <h1 id="individual_childrate"></h1>
                                        </div>
                                    </div>
                                        <div>
                                        <div class="silver-adult">
                                            <h1 id="individual_additional_adultrate"></h1>
                                        </div>
                                        <div class="silver-child">
                                            <h1 id="individual_additional_childrate"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="service-features">
                                <div class="read-header">
                                   <h1>Features : </h1>
                                </div>
                                <div class="article" id="individual_feature"></div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------View More Individual Package------------------>

        <!------------------Edit Individual Package------------------>
        <div class="modal fade" id="edit_individual_service_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center mb-4">
                        <h4 class="modal-title" id="edit_individualserviceName"></h4>
                        <button type="button" class="close popup-close-icon" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body-set">
                        <div class="service-pacakge-container">
                            <div class="silver-table">
                                <div class="service-includ-set mb-0">
                                    <div class="input-form-group mb-0">
                                        <div class="text-box-group">
                                            <div class="input-form-group-item">
                                                <div class="input-box-set">
                                                    <p>Choose Category</p>
                                                    <select id="edit_individual_category" onchange="edit_individualairporttype()"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group" style="display:none;" id="choose_individualairport_type">
                                            <div class="input-form-group-item">
                                                <div class="input-box-set">
                                                    <p>Choose Airport Type</p>
                                                    <select id="edit_individual_airport_type"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-price-inputs">
                                    <div class="input-form-group mt-0">
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for adult</p>
                                                    <input type="text" class="input-box" id="edit_individual_adult_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for child</p>
                                                    <input type="text" class="input-box" id="edit_individual_child_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for additional adult</p>
                                                    <input type="text" class="input-box" id="edit_additional_individual_adult_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-box-group">
                                            <div class="input-form-group-item mb-0">
                                                <p class="rupee-symb">₹</p>
                                                <div class="input-box-set border-right">
                                                    <p>cost for additional child</p>
                                                    <input type="text" class="input-box" id="edit_additional_individual_child_rate" maxlength="5" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p><img src="asset/info.svg" alt=""> Adult - 12years and above, Child - 2 to 11 years</p> -->
                                </div>
                                <div class="service-features">
                                    <div class="read-header">
                                        <h1>Features : </h1>
                                    </div>
                                    <div class="article" id="individual_feature_list"></div>
                                    <input type="hidden" id="individual_service_locationToken">
                                    <input type="hidden" id="individual_service_token">
                                </div>
                                <div class="btn-container text-center mt-5">
                                    <button class="cust-btn cust-btn-success" onclick="update_individual_service()">Update service</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------Edit Individual Package------------------>

        <!---Update CSV--->
        <div class="modal" id="update_uploadcsv">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Upload CSV File</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row cont-text-title">
                            <label class="upload_filed" for="update_csv_file_upload">
                                <input id="update_csv_file_valid" type="hidden">
                                <input id="update_csv_file_upload" onchange="file_upload_csv('update_csv_file','update_csv_view_url','asset/upload_csv_done.png')" type="file" accept=".csv" style="display:none;">
                                <img alt="" src="asset/csvfile.png" class="csvfile" id="update_csv_view_url" />
                                <h2 id="update_csv_file_name">Upload Files</h2>
                            </label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="cancelbtn" data-dismiss="modal" onclick="updatecancelcsvfile()">Cancel</button>
                        <button type="button" class="savebtn" id="update_csv_upload_button" onclick="update_upload_csv_file()">Upload</button>
                    </div>
                </div>
            </div>
        </div>
        <!---Update CSV--->

        <script src="js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/moment-with-locales.js"></script>
        <script src="js/bootstrap-datetimepicker.js"></script>
        <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            var apiPath = "<?php echo $apiPath; ?>";
            var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
            }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            }
            var service_amentities;
            $(document).ready(() => {
                $('#edit_service_btn').hide();
                $("#service-policies").addClass("actives");
                multipleCancellationCharges();
                var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
                serviceprovider_sidemenu(staff_token);

                var secured = 'secured';
                var datas = {
                    'securedairportzo': secured
                };
                var JsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/service-policy/readAmentities.php",
                    data: JsonData,
                }).done(function(data) {
                    if (data.status_code == 200) {
                        service_amentities = data.service_amentitiesdata;
                        var htmlText = "";
                        for (var key in service_amentities) {
                            htmlText += ` <input type="checkbox" name="amentitiess"  class="aminities-check-box hide"  id="service_amentities${key}" value="${service_amentities[key].amentities_token}">
                                       <label for="service_amentities${key}" class="amenities-box">
                                        <div class="center">
                                            <img src="${service_amentities[key].amentities_image}"/>
                                            <p>${service_amentities[key].amentities_name}</p>
                                        </div>
                                </label>`;
                        }
                        $("#service_amentitiesList").html(htmlText);
                    }
                });
            });

            function service_provider_list(companylocation_token){
                var datas = {
                    'serviceProviderLocationtoken': companylocation_token
                };
                var JsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDetailsNew.php",
                    data: JsonData,
                }).done(function(data) {
                    if (data.status_code == 201) {
                        var serviceData = data.locationDetails;
                        $('#ProviderLocationtoken').val(serviceData.serviceProviderLocationtoken);
                        $('#company_name').html(serviceData.companyName);
                        $('#company_image').attr("src",serviceData.companyLogo);
                        $('#bussiness_type').html(serviceData.businessType);
                        $('#business_website').html(serviceData.websiteName);
                        $('#airport_name').html(serviceData.airportName);
                        var latitude_list = serviceData.latitude;
                        var longitude_list = serviceData.longitude;
                        var geo_location = latitude_list.concat(",",longitude_list);
                        $('#coordinates_location').html(geo_location);
                        $('#briefly_about_shop').html(serviceData.aboutShop);

                        var shopImages = "";
                        var serviceshopimage = data.locationPhotos;
                        for (var key in serviceshopimage) {
                            shopImages += `<img src="${serviceshopimage[key].shopImage}" class="htal-img" alt="shopphotos"">`;
                        }
                        $("#service_shop_image").html(shopImages);

                        var amentitiesText = "";
                        var service__amentities_list = data.locationAmenities;
                        for (var key in service__amentities_list) {
                            amentitiesText += `<label for="service_amentities${key}" class="amenities-box">
                                                    <div class="center">
                                                        <img src="${service__amentities_list[key].amenitiesImage}"/>
                                                        <p>${service__amentities_list[key].amenitiesName}</p>
                                                    </div>
                                                </label>`;
                        }
                        $("#service_amentities_list").html(amentitiesText);

                        var businesshoursText = "";
                        var service__business_hours = data.locationHours;
                        for (var key in service__business_hours) {
                            businesshoursText += `<li><span class="day-label">${service__business_hours[key].days}</span>
                                            <span class="dash">-</span>
                                            <span class="timming-label">${service__business_hours[key].openTime} to ${service__business_hours[key].closeTime}</span></li>`;
                        }
                        $("#business_hours_list").html(businesshoursText);

                        var service_bundled = data.bundleServices;
                        var service_bundled_list = "";
                       
                        for (var bundlekey in service_bundled){
                            var serviceincluded = service_bundled[bundlekey].servicesIncluded;
                            var servicelocation = service_bundled[bundlekey].serviceLocations;
                            service_bundled_list +=`<div class="service-package-box">
                                                    <h4>${service_bundled[bundlekey].serviceName}</h4>
                                                    <div class="service-included">
                                                        <div class="service-include-header">
                                                            <h1>Service Included :</h1>
                                                        </div>
                                                        <div class="service-include-common">`;
                                                            for(var includekey in serviceincluded){
                                                                service_bundled_list+=` <div class="service-include">
                                                                                            <img src="asset/includ.png" alt="">
                                                                                            <p>${serviceincluded[includekey].name}</p>
                                                                                        </div>`;
                                                            }
                                                        service_bundled_list+=`</div>
                                                    </div><ul>`;
                                                    for(var bundlelocation in servicelocation){
                                                        var bundled_features = servicelocation[bundlelocation].features;
                                                        var featuresbundled="";
                                                        for(var featurekey in bundled_features){
                                                            featuresbundled+=`<ul><li>${bundled_features[featurekey].featureText}</li></ul>`;
                                                        }
                                                        service_bundled_list +=`<li>
                                                        <div>
                                                            <p class="travel-type-name">${servicelocation[bundlelocation].category} (${servicelocation[bundlelocation].airportType})</p>
                                                            <div class="action-icons">
                                                                <img src="asset/edit.png" alt="edit" data-toggle="modal" data-target="#edit_service-package" onclick="edit_bundle_package('${serviceData.serviceProviderLocationtoken}','${service_bundled[bundlekey].serviceName}','${servicelocation[bundlelocation].categoryToken}','${servicelocation[bundlelocation].airportTypeToken}','${servicelocation[bundlelocation].priceAdult}','${servicelocation[bundlelocation].priceChild}','${servicelocation[bundlelocation].priceAdultAdditional}','${servicelocation[bundlelocation].priceChildAdditional}','${bundlekey}','${bundlelocation}','${service_bundled[bundlekey].unique_business_token}')">
                                                                <img src="asset/delete.png" alt="delete" onclick="delete_bundle_service('${servicelocation[bundlelocation].serviceLocationToken}')">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="terminal">${servicelocation[bundlelocation].terminal}</p>
                                                            <div class="service-cost">
                                                                <div>
                                                                    <span>₹ ${servicelocation[bundlelocation].priceAdult} per adult</span>
                                                                    <span class="cost-divider">|</span>
                                                                    <span>₹ ${servicelocation[bundlelocation].priceChild} per child</span>
                                                                </div>
                                                                <span>₹ ${servicelocation[bundlelocation].priceAdultAdditional} per additional adult</span>
                                                                <span class="cost-divider">|</span>
                                                                <span>₹ ${servicelocation[bundlelocation].priceChildAdditional} per additional child</span>
                                                            </div>
                                                            <p class="view-more" data-toggle="modal" data-target="#view_service-package" onclick="view_full_bundled_package('${service_bundled[bundlekey].serviceName}','${servicelocation[bundlelocation].category}','${servicelocation[bundlelocation].airportType}','${servicelocation[bundlelocation].priceAdult}','${servicelocation[bundlelocation].priceChild}','${servicelocation[bundlelocation].priceAdultAdditional}','${servicelocation[bundlelocation].priceChildAdditional}','${featuresbundled}')">View more</p>
                                                        </div>
                                                        </li>`;
                                                    }
                                                    service_bundled_list+=`</ul>
                                                    </div>`;
                        }
                        $('#bundle-service-list-view').html(service_bundled_list);
                        
                        var service__individualpackage = data.individualServices;
                        var serviceindividual = "";
                        for (var individualkey in service__individualpackage){
                            var serviceincluded = service__individualpackage[individualkey].servicesIncluded;
                            var servicelocation = service__individualpackage[individualkey].serviceLocations;
                            serviceindividual +=`<div class="service-package-box">
                                                    <h4>${service__individualpackage[individualkey].serviceName}</h4>
                                                    <div class="service-included">
                                                        <div class="service-include-header">
                                                            <h1>Service Included :</h1>
                                                        </div>
                                                        <div class="service-include-common">`;
                                                            for(var includekey in serviceincluded){
                                                                serviceindividual+=` <div class="service-include">
                                                                                            <img src="asset/includ.png" alt="">
                                                                                            <p>${serviceincluded[includekey].name}</p>
                                                                                        </div>`;
                                                            }
                                                            serviceindividual+=`</div>
                                                    </div><ul>`;
                                                    for(var individuallocation in servicelocation){
                                                        var bundled_features = servicelocation[individuallocation].features;
                                                        var featuresindividual="";
                                                        for(var featurekey in bundled_features){
                                                            featuresindividual+=`<ul><li>${bundled_features[featurekey].featureText}</li></ul>`;
                                                        }

                                                        serviceindividual +=`<li>
                                                        <div>
                                                            <p class="travel-type-name">${servicelocation[individuallocation].category} (${servicelocation[individuallocation].airportType})</p>
                                                            <div class="action-icons">
                                                                <img src="asset/edit.png" alt="edit" data-toggle="modal" data-target="#edit_individual_service_package" onclick="edit_individual_package('${serviceData.serviceProviderLocationtoken}','${service__individualpackage[individualkey].serviceName}','${servicelocation[individuallocation].categoryToken}','${servicelocation[individuallocation].airportTypeToken}','${servicelocation[individuallocation].priceAdult}','${servicelocation[individuallocation].priceChild}','${servicelocation[individuallocation].priceAdultAdditional}','${servicelocation[individuallocation].priceChildAdditional}','${individualkey}','${individuallocation}','${service__individualpackage[individualkey].unique_business_token}')">
                                                                <img src="asset/delete.png" alt="delete" onclick="delete_individual_service('${servicelocation[individuallocation].serviceLocationToken}')">
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="terminal">${servicelocation[individuallocation].terminal}</p>
                                                            <div class="service-cost">
                                                                <div>
                                                                    <span>₹ ${servicelocation[individuallocation].priceAdult} per adult</span>
                                                                    <span class="cost-divider">|</span>
                                                                    <span>₹ ${servicelocation[individuallocation].priceChild} per child</span>
                                                                </div>
                                                                <span>₹ ${servicelocation[individuallocation].priceAdultAdditional} per additional adult</span>
                                                                <span class="cost-divider">|</span>
                                                                <span>₹ ${servicelocation[individuallocation].priceChildAdditional} per additional child</span>
                                                            </div>
                                                            <p class="view-more" data-toggle="modal" data-target="#view_individual_service_package" onclick="view_full_individual_package('${service__individualpackage[individualkey].serviceName}','${servicelocation[individuallocation].category}','${servicelocation[individuallocation].airportType}','${servicelocation[individuallocation].priceAdult}','${servicelocation[individuallocation].priceChild}','${servicelocation[individuallocation].priceAdultAdditional}','${servicelocation[individuallocation].priceChildAdditional}','${featuresindividual}')">View more</p>
                                                        </div>
                                                        </li>`;
                                                    }
                                                    serviceindividual+=`</ul>
                                                    </div>`;
                        }
                        $('#service_details_individualview').html(serviceindividual);

                        $('#terms_and_condition_list').summernote("code",serviceData.termsConditions);
                        $('#privacy_policy_list').summernote("code",serviceData.privacyPolicy);
                        $('#cancellation_policy').summernote("code",serviceData.cancellationPolicy);
                        $('#reschedule_policylist').html(serviceData.reschedulePolicy);

                        // disable text editing in summernote
                        $("#terms_and_condition_list").summernote('disable');
                        $("#privacy_policy_list").summernote('disable');
                        $("#cancellation_policy").summernote('disable');
                        
                        var service_cancellation = "";
                        var service_cancellationCharges = data.cancellationCharges;
                        for (var keys1 in service_cancellationCharges){
                            service_cancellation += `<div class="set_cancellation_charge_listview">
                                <div class="type-changing">
                                    <div class="main-hours">
                                        <div class="timing">
                                            <input style="" type="text" value="${service_cancellationCharges[keys1].hours}" disabled>
                                        </div>
                                        <div class="location-hours">
                                            <h5>hours before,charge</h5>
                                        </div>
                                    </div>
                                    <div class="main-hours">
                                        <div class="timing">
                                            <input style="" type="text" value="${service_cancellationCharges[keys1].percentage}" disabled>
                                        </div>
                                        <div class="location-hours">
                                            <h5>% of total booking amount</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        $(".show_charges_list").html(service_cancellation);
                    }
                });
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

            function view_full_bundled_package(data1,data2,data3,data4,data5,data6,data7,data8){
                $('#list_bundled_service_name').html(data1);
                $('#bundled_category').html(data2);
                $('#bundled_airporttype').html(data3);
                $('#bundled_adultrate').html('₹ '+data4+' per adult');
                $('#bundled_childrate').html('₹ '+data5+ ' per child');
                $('#bundled_additional_adultrate').html('₹ '+data6+' per additional adult');
                $('#bundled_additional_childrate').html('₹ '+data7+' per additional child');
                $('#bundled_feature').html(data8);
            }
            var businessTypeToken = '';
            function edit_bundle_package(serviceProviderLocationtoken,serviceName,bundledcategory_token,bundledairporttype_token,adultRate,childRate,additional_adultRate,additional_childRate,bundlekey,bundlelocationkey,uniqueBusinessTypeToken){
                businessTypeToken = uniqueBusinessTypeToken;
                var datas = {
                    'serviceProviderLocationtoken': serviceProviderLocationtoken
                };
                var JsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDetailsNew.php",
                    data: JsonData,
                }).done(function(data) {
                    if (data.status_code == 201) {
                        var service_bundled = data.bundleServices;
                        var servicelocation = service_bundled[bundlekey].serviceLocations[bundlelocationkey].features;
                        var serviceLocationToken = service_bundled[bundlekey].serviceLocations[bundlelocationkey].serviceLocationToken;
                        var serviceToken = service_bundled[bundlekey].serviceToken;
                        var bundledfeatures = "";
                        bundledfeatures +=`<p onclick="edit_bundled_featureslist()">Add point</p>`;
                        removefeature_array = [];
                        serviceLocation_array = [];
                        for (var featurekey in servicelocation){
                            removefeature_array.push(parseFloat(featurekey));
                            serviceLocation_array.push(parseFloat(featurekey));
                            bundledfeatures +=` <div class="addpoint-input-container" id="remove_features`+featurekey+`">
                                                    <div>
                                                        <textarea class="add-point-input" id="edit_bundled_feature`+featurekey+`" cols="6" rows="4">${servicelocation[featurekey].featureText}</textarea>`;
                                                    if(featurekey > 0){
                                                        bundledfeatures+=`<div class="close_box cancelling-charges-sub">
                                                        <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="width:12px;" onclick="remove_bundled_features_modal('remove_features`+featurekey+`',`+featurekey+`)">
                                                        </div>`;
                                                    }
                                                    bundledfeatures+=`</div></div>`;
                        }
                        $('#bundled_feature_list').html(bundledfeatures);
                        $('#bundled_service_locationToken').val(serviceLocationToken);
                        $('#bundled_service_Token').val(serviceToken);
                    }
                });

                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDropdown.php",
                    data: "",
                }).done(function(data){
                    if(data.status_code == 201){
                        var edit_category_dropdown = data.data;
                        var category_dropdownHtmlText = "";
                        for(var categorykey in edit_category_dropdown){
                            category_dropdownHtmlText+=`<option value="${edit_category_dropdown[categorykey].token}">${edit_category_dropdown[categorykey].name}</option>`;
                        }
                        $('#edit_bundled_category').html(category_dropdownHtmlText);
                        $('#edit_bundled_category').val(bundledcategory_token);

                        $('#edit_serviceName').html(serviceName);
                        $('#edit_adult_rate').val(adultRate);
                        $('#edit_child_rate').val(childRate);
                        $('#edit_additional_adult_rate').val(additional_adultRate);
                        $('#edit_additional_child_rate').val(additional_childRate);

                        var bundled__category = $('#edit_bundled_category').val();
                        if(bundled__category=="1122334457"){
                            $('#choose_airport_type').show();
                            $.ajax({
                                dataType: "JSON",
                                type: "POST",
                                url: apiPath + "/provider/servicePolicyDropdown.php",
                                data: "",
                            }).done(function(data){
                                if(data.status_code == 201){
                                    var edit_category_dropdown = data.data;
                                    for(var categorykey in edit_category_dropdown){
                                        var edit_airport_dropdown = '<option value="">Select Your Airport Type</option>';
                                        var getairport_type = edit_category_dropdown[categorykey].airportTypes;
                                        for(var key in getairport_type){
                                            edit_airport_dropdown+=`<option value="${getairport_type[key].typeToken}">${getairport_type[key].typeName}</option>`;
                                        }
                                    }
                                    $('#edit_airport_type').html(edit_airport_dropdown);
                                    $('#edit_airport_type').val(bundledairporttype_token);
                                }
                            });
                        }else{
                            $('#choose_airport_type').hide(); 
                        }
                    }
                });
            }      

            var edit_extrafeatures = '';
            function edit_bundled_featureslist() {
            var edit_feature_count = serviceLocation_array.length;
            edit_extrafeatures = `<div class="addpoint-input-container" id="remove_features`+edit_feature_count+`">
                                                    <div>
                                                        <textarea class="add-point-input" id="edit_bundled_feature`+edit_feature_count+`" cols="6" rows="4"></textarea>
                                                        <div class="close_box cancelling-charges-sub">
                                                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="width: 12px;" onclick="remove_bundled_features_modal('remove_features`+edit_feature_count+`',`+edit_feature_count+`)">
                                                            </div>
                                                        </div>
                                                    </div>`;
            $("#bundled_feature_list").append(edit_extrafeatures);
            removefeature_array.push(edit_feature_count);
            serviceLocation_array.push(edit_feature_count++);
            }

            function remove_bundled_features_modal(id,key){
                $('#'+id).remove();
                let idx11 = removefeature_array.indexOf(key);   //Remove the token to the array
                if (idx11 != -1) removefeature_array.splice(idx11, 1);
            }

            function edit_airporttype(){
                var bundled__category = $('#edit_bundled_category').val();
                if(bundled__category=="1122334457"){
                    $('#choose_airport_type').show();
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath + "/provider/servicePolicyDropdown.php",
                        data: "",
                    }).done(function(data){
                        if(data.status_code == 201){
                            var edit_category_dropdown = data.data;
                            var edit_airport_dropdown = "";
                            for(var categorykey in edit_category_dropdown){
                                var getairport_type = edit_category_dropdown[categorykey].airportTypes;
                                for(var key in getairport_type){
                                    edit_airport_dropdown+=`<option value="${getairport_type[key].typeToken}">${getairport_type[key].typeName}</option>`;
                                }
                            }
                            $('#edit_airport_type').html(edit_airport_dropdown);
                        }
                    });
                }else{
                    $('#choose_airport_type').hide(); 
                }
            }

            function update_bundled_service(){
                var edit_bundledpass = 0;
                var bundled_feature_count = ((removefeature_array.length)+4);
                var serviceLocationToken = $('#bundled_service_locationToken').val();
                var serviceToken = $('#bundled_service_Token').val();
                var bundled__category = $('#edit_bundled_category').val();
                var airport__type = $('#edit_airport_type').val();

                var bundled__adultrate = $('#edit_adult_rate').val();
                if(bundled__adultrate == ""){
                    swal("Adult Rate Cant Be Empty!..");
                }else{
                    edit_bundledpass++;
                }

                var bundled__childrate = $('#edit_child_rate').val();
                if(bundled__childrate == ""){
                    swal("Child Rate Cant Be Empty!..");
                }else{
                    edit_bundledpass++;
                }

                var bundled__additional_adultrate = $('#edit_additional_adult_rate').val();
                if(bundled__additional_adultrate == ""){
                    swal("Additional Adult Rate Cant Be Empty!..");
                }else{
                    edit_bundledpass++;
                }

                var bundled__additional_childrate = $('#edit_additional_child_rate').val();
                if(bundled__additional_childrate == ""){
                    swal("Additional Child Rate Cant Be Empty!..");
                }else{
                    edit_bundledpass++;
                }

                var updatefeatures_array = [];
                removefeature_array.forEach(i => {
                    if($('#edit_bundled_feature' + i).val() != ''){
                        edit_bundledpass++;
                        var bundled__features = $('#edit_bundled_feature' + i).val();
                        updatefeatures_array.push(bundled__features);
                    }else{
                        swal("Features Cant Be Empty!..");
                    }
                });
                if(edit_bundledpass == bundled_feature_count){
                    var ServiceCompanyToken = localStorage.getItem('service_provider_company_token')
                    if(ServiceCompanyToken == null){
                        var Company_Token = localStorage.getItem('dummy_service_companytoken');
                    }else{
                        var Company_Token = localStorage.getItem('service_provider_company_token');
                    }

                    var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                    }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    }
                    var datas = {
                        serviceLocationToken : serviceLocationToken,
                        costOfAdult : bundled__adultrate,
                        costOfChild : bundled__childrate,
                        costOfAdultAdditional : bundled__additional_adultrate,
                        costOfChildAdditional : bundled__additional_childrate,
                        categoryToken : bundled__category,
                        airportTypeToken : airport__type,
                        newFeaturesArray : updatefeatures_array,
                        companylocation_token:companylocation_token,
                        service_provider_company_token:Company_Token,
                        businessTypeToken:businessTypeToken,
                        serviceToken:serviceToken
                    }
                    var json_data = JSON.stringify(datas);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url :  `${apiPath}/provider/servicePolicyLocationUpdate.php`,
                        data: json_data,
                    }).done(function(data){
                        swal("Updated Service Successfully!", {icon: "success",}).then((value) => {
                            location.reload();
                        });
                    });
                }
            }

            function delete_bundle_service(serviceLocationToken){
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this service?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var datas = {
                            serviceLocationToken:serviceLocationToken
                        }
                        var json_data = JSON.stringify(datas);
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url :  `${apiPath}/provider/servicePolicyLocationDelete.php`,
                            data: json_data,
                        }).done(function(data){
                            swal("Single Service Deleted!", {icon: "success",}).then((value) => {
                                location.reload();
                            });
                        });
                    }
                });
            }

            function view_full_individual_package(data1,data2,data3,data4,data5,data6,data7,data8){
                $('#list_individual_service_name').html(data1);
                $('#individual_category').html(data2);
                $('#individual_airporttype').html(data3);
                $('#individual_adultrate').html('₹ '+data4+' per adult');
                $('#individual_childrate').html('₹ '+data5+ ' per child');
                $('#individual_additional_adultrate').html('₹ '+data6+' per additional adult');
                $('#individual_additional_childrate').html('₹ '+data7+ ' per additional child');
                $('#individual_feature').html(data8);
            }

            function edit_individual_package(serviceProviderLocationtoken,individualserviceName,individualcategory_token,individualairporttype_token,adultRate,childRate,additional_adultRate,additional_childRate,individualkey,individuallocationkey,unquieBusinessTypeToken){
                businessTypeToken = unquieBusinessTypeToken;
                var datas = {
                    'serviceProviderLocationtoken': serviceProviderLocationtoken
                };
                var JsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDetailsNew.php",
                    data: JsonData,
                }).done(function(data) {
                    if (data.status_code == 201) {
                        var service__individualpackage = data.individualServices;
                        var servicelocation = service__individualpackage[individualkey].serviceLocations[individuallocationkey].features;
                        var serviceLocationToken = service__individualpackage[individualkey].serviceLocations[individuallocationkey].serviceLocationToken;
                        var serviceToken = service__individualpackage[individualkey].serviceToken;
                        var individualfeatures = "";
                        individualfeatures +=`<p onclick="edit_individual_featureslist()">Add point</p>`;
                        individualremovefeature_array = [];
                        individualserviceLocation_array = [];
                        for (var featurekey in servicelocation){
                            individualremovefeature_array.push(parseFloat(featurekey));
                            individualserviceLocation_array.push(parseFloat(featurekey));
                            individualfeatures +=` <div class="addpoint-input-container" id="individualremove_features`+featurekey+`">
                                                    <div>
                                                        <textarea class="add-point-input" id="edit_individual_feature`+featurekey+`" cols="6" rows="4">${servicelocation[featurekey].featureText}</textarea>`;
                                                    if(featurekey > 0){
                                                        individualfeatures+=`<div class="close_box cancelling-charges-sub">
                                                        <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="width:12px;" onclick="remove_individual_features_modal('individualremove_features`+featurekey+`',`+featurekey+`)">
                                                        </div>`;
                                                    }
                                                    individualfeatures+=`</div></div>`;
                        }
                        $('#individual_feature_list').html(individualfeatures);
                        $('#individual_service_locationToken').val(serviceLocationToken);
                        $('#individual_service_token').val(serviceToken);
                    }
                });
                
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDropdown.php",
                    data: "",
                }).done(function(data){
                    if(data.status_code == 201){
                        var edit_category_dropdown = data.data;
                        var category_dropdownHtmlText = "";
                        for(var categorykey in edit_category_dropdown){
                            category_dropdownHtmlText+=`<option value="${edit_category_dropdown[categorykey].token}">${edit_category_dropdown[categorykey].name}</option>`;
                        }
                        $('#edit_individual_category').html(category_dropdownHtmlText);
                        $('#edit_individual_category').val(individualcategory_token);

                        $('#edit_individualserviceName').html(individualserviceName);
                        $('#edit_individual_adult_rate').val(adultRate);
                        $('#edit_individual_child_rate').val(childRate);
                        $('#edit_additional_individual_adult_rate').val(additional_adultRate);
                        $('#edit_additional_individual_child_rate').val(additional_childRate);

                        var individual__category = $('#edit_individual_category').val();
                        if(individual__category=="1122334457"){
                            $('#choose_individualairport_type').show();
                            $.ajax({
                                dataType: "JSON",
                                type: "POST",
                                url: apiPath + "/provider/servicePolicyDropdown.php",
                                data: "",
                            }).done(function(data){
                                if(data.status_code == 201){
                                    var edit_category_dropdown = data.data;
                                    for(var categorykey in edit_category_dropdown){
                                        var edit_airport_dropdown = '<option value="">Select Your Airport Type</option>';
                                        var getairport_type = edit_category_dropdown[categorykey].airportTypes;
                                        for(var key in getairport_type){
                                            edit_airport_dropdown+=`<option value="${getairport_type[key].typeToken}">${getairport_type[key].typeName}</option>`;
                                        }
                                    }
                                    $('#edit_individual_airport_type').html(edit_airport_dropdown);
                                    $('#edit_individual_airport_type').val(individualairporttype_token);
                                }
                            });
                        }else{
                            $('#choose_individualairport_type').hide(); 
                        }
                    }
                });
            }

            function edit_individualairporttype(){
                var individual__category = $('#edit_individual_category').val();
                if(individual__category=="1122334457"){
                    $('#choose_individualairport_type').show();
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath + "/provider/servicePolicyDropdown.php",
                        data: "",
                    }).done(function(data){
                        if(data.status_code == 201){
                            var edit_category_dropdown = data.data;
                            var edit_airport_dropdown = "";
                            for(var categorykey in edit_category_dropdown){
                                var getairport_type = edit_category_dropdown[categorykey].airportTypes;
                                for(var key in getairport_type){
                                    edit_airport_dropdown+=`<option value="${getairport_type[key].typeToken}">${getairport_type[key].typeName}</option>`;
                                }
                            }
                            $('#edit_individual_airport_type').html(edit_airport_dropdown);
                        }
                    });
                }else{
                    $('#choose_individualairport_type').hide(); 
                }
            }

            var edit_individualextrafeatures = '';
            function edit_individual_featureslist() {
            var edit_individualfeature_count = individualserviceLocation_array.length;
            edit_individualextrafeatures = `<div class="addpoint-input-container" id="individualremove_features`+edit_individualfeature_count+`">
                                                    <div>
                                                        <textarea class="add-point-input" id="edit_individual_feature`+edit_individualfeature_count+`" cols="6" rows="4"></textarea>
                                                    
                                                    <div class="close_box cancelling-charges-sub">
                                                        <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="width: 12px;" onclick="remove_individual_features_modal('individualremove_features`+edit_individualfeature_count+`',`+edit_individualfeature_count+`)">
                                                        </div>
                                                    </div></div>`;
            $("#individual_feature_list").append(edit_individualextrafeatures);
            individualremovefeature_array.push(edit_individualfeature_count);
            individualserviceLocation_array.push(edit_individualfeature_count++);
            }

            function remove_individual_features_modal(id,key){
                $('#'+id).remove();
                let idx12 = individualremovefeature_array.indexOf(key);   //Remove the token to the array
                if (idx12 != -1) individualremovefeature_array.splice(idx12, 1);
            }

            function update_individual_service(){
                var edit_individualpass = 0;
                var individual_feature_count = ((individualremovefeature_array.length)+4);
                var serviceLocationToken = $('#individual_service_locationToken').val();
                var serviceToken = $('#individual_service_token').val();
                var individual__category = $('#edit_individual_category').val();
                var individualairport__type = $('#edit_individual_airport_type').val();

                var individual__adultrate = $('#edit_individual_adult_rate').val();
                if(individual__adultrate == ""){
                    swal("Adult Rate Cant Be Empty!..");
                }else{
                    edit_individualpass++;
                }

                var individual__childrate = $('#edit_individual_child_rate').val();
                if(individual__childrate == ""){
                    swal("Child Rate Cant Be Empty!..");
                }else{
                    edit_individualpass++;
                }

                var individual__additional_adultrate = $('#edit_additional_individual_adult_rate').val();
                if(individual__additional_adultrate == ""){
                    swal("Additional Adult Rate Cant Be Empty!..");
                }else{
                    edit_individualpass++;
                }

                var individual__additional_childrate = $('#edit_additional_individual_child_rate').val();
                if(individual__additional_childrate == ""){
                    swal("Additional Child Rate Cant Be Empty!..");
                }else{
                    edit_individualpass++;
                }

                var updateindividualfeatures_array = [];
                individualremovefeature_array.forEach(i => {
                    if($('#edit_individual_feature' + i).val() != ''){
                        edit_individualpass++;
                        var individual__features = $('#edit_individual_feature' + i).val();
                        updateindividualfeatures_array.push(individual__features);
                    }else{
                        swal("Features Cant Be Empty!..");
                    }
                });

                if(edit_individualpass == individual_feature_count){
                    var ServiceCompanyToken = localStorage.getItem('service_provider_company_token')
                    if(ServiceCompanyToken == null){
                        var Company_Token = localStorage.getItem('dummy_service_companytoken');
                    }else{
                        var Company_Token = localStorage.getItem('service_provider_company_token');
                    }

                    var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                    }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                    }
                    
                    var datas = {
                        serviceLocationToken : serviceLocationToken,
                        costOfAdult : individual__adultrate,
                        costOfChild : individual__childrate,
                        costOfAdultAdditional : individual__additional_adultrate,
                        costOfChildAdditional : individual__additional_childrate,
                        categoryToken:individual__category,
                        airportTypeToken:individualairport__type,
                        newFeaturesArray:updateindividualfeatures_array,
                        companylocation_token:companylocation_token,
                        service_provider_company_token:Company_Token,
                        businessTypeToken:businessTypeToken,
                        serviceToken:serviceToken
                    }
                    var json_data = JSON.stringify(datas);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url :  `${apiPath}/provider/servicePolicyLocationUpdate.php`,
                        data: json_data,
                    }).done(function(data){
                        swal("Updated Service Successfully!", {icon: "success",}).then((value) => {
                            location.reload();
                        });
                    });
                }
            }

            function delete_individual_service(serviceLocationToken){
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this service?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var datas = {
                            serviceLocationToken:serviceLocationToken
                        }
                        var json_data = JSON.stringify(datas);
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url :  `${apiPath}/provider/servicePolicyLocationDelete.php`,
                            data: json_data,
                        }).done(function(data){
                            swal("Single Service Deleted!", {icon: "success",}).then((value) => {
                                location.reload();
                            });
                        });
                    }
                });
            }
            
            function edit_service(){
                var companylocation_token = $('#ProviderLocationtoken').val();
                var datas = {
                    'serviceProviderLocationtoken': companylocation_token
                };
                var JsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath + "/provider/servicePolicyDetails.php",
                    data: JsonData,
                }).done(function(data) {
                    if (data.status_code == 201) {
                        var edit_serviceData = data.locationDetails;
                        $("#edit_airportname").val(edit_serviceData.airportName)
                        $("#edit_coordinates_input").val(edit_serviceData.latitude+', '+edit_serviceData.longitude);
                        $("#edit_shop_message").val(edit_serviceData.aboutShop);
                        var edit_shopImages = "";
                        var edit_serviceshopimage = data.locationPhotos;
                        for (var key in edit_serviceshopimage) {
                            edit_shopImages += `<div class="img-upload-items">
                                                    <label for="shopimageEdit${key}" class="upload-label border">
                                                        <img src="${edit_serviceshopimage[key].shopImage}" id="view_shopimageEdit${key}" class="upload-icon" alt="shopphotos" style="width:300px; height:200px;>
                                                    </label>
                                                    <div class="reupload-text">
                                                        <label for="shopimageEdit${key}" id="shopimagenameEdit_hide${key}">Reupload</label>
                                                    </div>
                                                    <input id="valid_shopimageEdit${key}" type="hidden" value="${edit_serviceshopimage[key].shopImage}">
                                                    <input type="file" id="shopimageEdit${key}" class="hidden" onchange="validateFileUploadForEdit('shopimageEdit${key}')" style="display: none;cursor: pointer;">
                                                </div>`;
                       }
                       $(".edit-img-upload-group").html(edit_shopImages);  
                        var service__amentities_list = data.locationAmenities;
                        var checked_amentites_token = [];
                        for(var key1 in service__amentities_list){
                           checked_amentites_token.push(service__amentities_list[key1].amenitiesToken);
                        }
                        var edit_amentities = "";
                        for (var key in service_amentities) {
                            if(checked_amentites_token.includes(service_amentities[key].amentities_token)){
                               edit_amentities += `<input type="checkbox" name="edit_amentitiess"  class="aminities-check-box hide"  id="edit_service_amentities${key}" value="${service_amentities[key].amentities_token}" checked>
                                       <label for="edit_service_amentities${key}" class="amenities-box">
                                        <div class="center">
                                            <img src="${service_amentities[key].amentities_image}"/>
                                            <p>${service_amentities[key].amentities_name}</p>
                                        </div>
                                </label>`; 
                            }else{
                                edit_amentities += `<input type="checkbox" name="edit_amentitiess"  class="aminities-check-box hide"  id="edit_service_amentities${key}" value="${service_amentities[key].amentities_token}">
                                       <label for="edit_service_amentities${key}" class="amenities-box">
                                        <div class="center">
                                            <img src="${service_amentities[key].amentities_image}"/>
                                            <p>${service_amentities[key].amentities_name}</p>
                                        </div>
                                </label>`; 
                            }  
                        }
                        $("#edit_service_amentitiesList").html(edit_amentities);
                        var edit_locationHours = "";
                        var location_detail = data.locationHours;
                        var location_active_hours = [];
                        for(var key2 in location_detail){
                           location_active_hours.push(location_detail[key2].days);
                        }
                        var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        var index = 0;
                        for(let i=0; i<7; i++){
                            if(location_active_hours.includes(days[i])){
                                  edit_locationHours += `<li class="day-item edit-day-item">
                                    <div class="choose-day-input-group">
                                        <div class="holiday-group">
                                            <h4>${location_detail[index].days}</h4>
                                            <label for="${location_detail[index].days}" class="holiday-label-group">
                                                <input type="checkbox" class="day-check-box" id="${location_detail[index].days}" value="${location_detail[index].days}">
                                                <p>Holiday</p>
                                            </label>
                                        </div>
                                        <div class="input-form-group cust-input-group open1">
                                            <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox${i}'>
                                                <div class="select-group">
                                                    <span class="input-group-addon bg-time"></span>
                                                </div>
                                                <div class="input-box-set border-right ">
                                                    <label for="open_time">Open time</label>
                                                    <input type='text' class="b-input datepicker" value="${location_detail[index].openTime}" placeholder="choose time" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-form-group cust-input-group close1">
                                            <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox${i}'>
                                                <div class="select-group">
                                                    <span class="input-group-addon bg-time"></span>
                                                </div>
                                                <div class="input-box-set border-right">
                                                    <label for="close_time">Close time</label>
                                                    <input type='text' class="b-input datepicker" value="${location_detail[index].closeTime}" placeholder="choose time" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>`;
                                index++;
                            }else{
                                 edit_locationHours += `<li class="day-item edit-day-item">
                                    <div class="choose-day-input-group">
                                        <div class="holiday-group">
                                            <h4>${days[i]}</h4>
                                            <label for="${days[i]}" class="holiday-label-group">
                                                <input type="checkbox" class="day-check-box" id="${days[i]}" value="${days[i]}" checked>
                                                <p>Holiday</p>
                                            </label>
                                        </div>
                                        <div class="input-form-group cust-input-group open1">
                                            <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox${i} disabled'>
                                                <div class="select-group">
                                                    <span class="input-group-addon bg-time"></span>
                                                </div>
                                                <div class="input-box-set border-right ">
                                                    <label for="open_time">Open time</label>
                                                    <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-form-group cust-input-group close1">
                                            <div class='input-group input-form-group-item arriving-input-set cust-input-group-item day-checkbox${i} disabled'>
                                                <div class="select-group">
                                                    <span class="input-group-addon bg-time"></span>
                                                </div>
                                                <div class="input-box-set border-right">
                                                    <label for="close_time">Close time</label>
                                                    <input type='text' class="b-input datepicker" placeholder="choose time" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>`;
                            }
                        }
                        $(".edit_business_hours").html(edit_locationHours);
                        $('#edit_terms_and_condition_list').summernote("code",edit_serviceData.termsConditions);
                        $('#edit_privacy_policy_list').summernote("code",edit_serviceData.privacyPolicy);
                        $('#edit_cancellation_policy').summernote("code",edit_serviceData.cancellationPolicy);
                        $('#edit_reschedule_policy').html(edit_serviceData.reschedulePolicy);
                        
                        var edit_service_cancellation = "";
                        var edit_cancellationcharge = data.cancellationCharges;
                        edit_service_cancellation += `<p onclick="edit_multipleCancellationCharges()" class="mb-3">Add charges</p>`;
                        edit_cancellation_array = [];
                        edit_cancellation_charge_array = [];
                        for(var keys1 in edit_cancellationcharge){
                        edit_cancellation_array.push(parseFloat(keys1));
                        edit_cancellation_charge_array.push(parseFloat(keys1));
                        edit_service_cancellation += `<div id="edit_removeCharges`+keys1+`">
                            <div class="type-changing" id="clearslot`+keys1+`">
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="" type="text" value="${edit_cancellationcharge[keys1].hours}" id="edit_bookinghours`+keys1+`" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>hours before,charge</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <p id="edit_bookinghoursErr`+keys1+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                    </div>
                                </div>
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="" type="text" value="${edit_cancellationcharge[keys1].percentage}" id="edit_totalbookingamount`+keys1+`" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>% of total booking amount</h5>
                                        </div>`;
                                        if(keys1 > 0){
                                   edit_service_cancellation += `<div class="close_box cancelling-charges-sub">
                                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="margin-top: 4px;" onclick="edit_clear_modalValue('edit_removeCharges`+keys1+`',`+keys1+`)">
                                        </div>`;
                                           }
                                   edit_service_cancellation += `</div>
                                <div>
                                    <p id="edit_totalbookingamountErr`+keys1+`" style="color: red;font-size: 13px; padding-top: 8px; font-weight:600;"></p>
                                </div>
                                </div>
                            </div>
                        </div>`;
                        }
                        $(".edit_show_charges_list").html(edit_service_cancellation);
                    }
                });
            }

            function updatecancelcsvfile() {
                var updatecsvfilename = update_csv_file_upload.files[0];
                if(updatecsvfilename == undefined) {
                    $("#update_uploadcsv").modal('hide');
                }else{
                    $('#update_csv_file_name').text('Upload Files');
                    document.getElementById('update_csv_view_url').src = 'https://airportzo.net.in/service-provider-dashboard/asset/csvfile.png';
                    $('#update_csv_file_upload').val('');
                }
            }

            function update_upload_csv_file() {
                var valid = update_csv_file_upload.files[0];
                if (valid != undefined) {
                    $('#update_csv_upload_button').prop('disabled', true);
                    var myFormData = new FormData();
                    myFormData.append('file_upload', update_csv_file_upload.files[0]);
                    var ServiceCompanyToken = localStorage.getItem('service_provider_company_token')
                    if(ServiceCompanyToken == null){
                        var Company_Token = localStorage.getItem('dummy_service_companytoken');
                    }else{
                        var Company_Token = localStorage.getItem('service_provider_company_token');
                    }
                    var ServiceAirportToken = localStorage.getItem('service_provider_airport_token')
                    if(ServiceAirportToken == null){
                        var Airport_Token = localStorage.getItem('dummy_service_airporttoken');
                    }else{
                        var Airport_Token = localStorage.getItem('service_provider_airport_token');
                    }
                    myFormData.append('serviceProviderCompanyToken', Company_Token);
                    myFormData.append('serviceProviderAirportToken', Airport_Token);
                    $.ajax({
                        dataType: "json",
                        url: apiPath + "/csvUpload/individual.php",
                        type: 'POST',
                        async: false,
                        processData: false, // important
                        contentType: false, // important
                        data: myFormData,
                        success: function(data) {
                            if (data.status_code == 503) {
                                $('#update_csv_upload_button').prop('disabled', false);
                                swal(data.message);
                            }else if(data.status_code == 201){
                                swal("Csv data uploaded successfully!", {icon: "success",}).then((value) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }else{
                    swal("Please select a csv file!");
                }
            }

            $(function() {
                $('.cust-input-group-item').datetimepicker({
                    ignoreReadonly: true,
                    format: 'LT'
                });
            });
            $(document).on('click', '.cust-input-group-item', function() {
                $('.cust-input-group-item').datetimepicker({
                    ignoreReadonly: true,
                    format: 'LT'
                });
            });

            $('body').on('click', '.close_box', function() {
                let slotId = $(this).parent().attr('id');
                $(`#${slotId}`).remove();
                //i = $(this).parent().attr('id').replace(/[^0-9]/g, '');
            });

            $('body').on('click', '.close_box', function() {
                let slotId = $(this).parent().attr('id');
                $(`#${slotId}`).remove();
                //i = $(this).parent().attr('id').replace(/[^0-9]/g, '');
            });

            // <!---Business Hours Holiday Insert---!>
            $(document).ready(() => {
                $('.day-item').each(function() {
                    var opentime = $(this).find(".choose-day-input-group").find(".open1").find(".border-right > input").val('8:00 AM');
                    var closetime = $(this).find(".choose-day-input-group").find(".close1").find(".border-right > input").val('8:00 AM');
                });
                $("#monday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox1').addClass("disabled");
                    } else {
                        $('.day-checkbox1').removeClass("disabled");
                    }
                });
                $("#tuesday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox2').addClass("disabled");
                    } else {
                        $('.day-checkbox2').removeClass("disabled");
                    }
                });

                $("#wednesday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox3').addClass("disabled");
                    } else {
                        $('.day-checkbox3').removeClass("disabled");
                    }
                });

                $("#thursday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox4').addClass("disabled");
                    } else {
                        $('.day-checkbox4').removeClass("disabled");
                    }
                });

                $("#friday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox5').addClass("disabled");
                    } else {
                        $('.day-checkbox5').removeClass("disabled");
                    }
                });

                $("#saturday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox6').addClass("disabled");
                    } else {
                        $('.day-checkbox6').removeClass("disabled");
                    }
                });

                $("#sunday").click(function() {
                    if ($(this).is(":checked")) {
                        $('.day-checkbox7').addClass("disabled");
                    } else {
                        $('.day-checkbox7').removeClass("disabled");
                    }
                });
            });
            // <!---Business Hours Holiday Insert---!>
            // <!---Business Hours Holiday Update---!>
            $(document).on('click', '#Monday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox0').addClass("disabled");
                    } else {
                        $('.day-checkbox0').removeClass("disabled");
                }
            });
            $(document).on('click', '#Tuesday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox1').addClass("disabled");
                    } else {
                        $('.day-checkbox1').removeClass("disabled");
                }
            });
            $(document).on('click', '#Wednesday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox2').addClass("disabled");
                    } else {
                        $('.day-checkbox2').removeClass("disabled");
                }
            });
            $(document).on('click', '#Thursday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox3').addClass("disabled");
                    } else {
                        $('.day-checkbox3').removeClass("disabled");
                }
            });
            $(document).on('click', '#Friday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox4').addClass("disabled");
                    } else {
                        $('.day-checkbox4').removeClass("disabled");
                }
            });
             $(document).on('click', '#Saturday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox5').addClass("disabled");
                    } else {
                        $('.day-checkbox5').removeClass("disabled");
                }
            });
             $(document).on('click', '#Sunday', function() {
                 if ($(this).is(":checked")) {
                        $('.day-checkbox6').addClass("disabled");
                    } else {
                        $('.day-checkbox6').removeClass("disabled");
                }
            });
            // <!---Business Hours Holiday Update---!>

            // <!----shop message count----!>
            $('#shop_message').keyup(updateCount);
            $('#shop_message').keydown(updateCount);
            function updateCount() {
                var cs = $(this).val().length;
                var ss = 500 - cs;
                $('#charttext').text(ss);
            }

            $('#edit_shop_message').keyup(edit_updateCount);
            $('#edit_shop_message').keydown(edit_updateCount);
            function edit_updateCount() {
                var css = $(this).val().length;
                var sss = 500 - css;
                $('#edit_charttext').text(sss);
            }
            // <!----shop message count----!>

            // Latitude Longitude range
            var x = document.getElementById("coordinates_icon");
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }else{
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                let latitude_longitude = `${position.coords.latitude},${position.coords.longitude}`
                $('#coordinates_input').val(`${latitude_longitude}`);
            }

            var xy = document.getElementById("edit_coordinates_icon");
            function edit_getLocation(){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition1);
                }else{
                    xy.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition1(position) {
                let latitude_longitude = `${position.coords.latitude},${position.coords.longitude}`
                $('#edit_coordinates_input').val(`${latitude_longitude}`);
            }
            // Latitude Longitude range

            //Insert booking hours value empty
            $('.choose-day-input-group > div > label > input[type=checkbox]').change(function(){
                 if(this.checked){
                     $(this).parent().parent().next(".open1").find(".input-form-group-item > .border-right > input").val('');
                     $(this).parent().parent().next().next(".close1").find(".input-form-group-item > .border-right > input").val('');
                 }
            });

            //Update booking hours value empty
            $(document).on('change','.choose-day-input-group > div > label > input[type=checkbox]',function(){
                if(this.checked){
                    $(this).parent().parent().next(".open1").find(".input-form-group-item > .border-right > input").val('');
                    $(this).parent().parent().next().next(".close1").find(".input-form-group-item > .border-right > input").val('');
                }
            });
            
            var addamentitiesarray = [];
            var Business_hoursarray = [];
            function business_info() {
                var pass = 0;
                var sampleamentities_array = [];
                if (document.getElementById("coordinates_input").value == "") {
                    document.getElementById("coordinates_inputErr").innerHTML = "* Please Enter The Coordinates !";
                }else{
                    document.getElementById("coordinates_inputErr").innerHTML = "";
                    pass++;
                }if (document.getElementById("shop_message").value.trim() == "") {
                    document.getElementById("shop_messageErr").innerHTML = "* Please Enter Your Business Description !";
                }else{
                    document.getElementById("shop_messageErr").innerHTML = "";
                    pass++;
                }if (document.getElementById("shopimage1").value == "") {
                    document.getElementById("shopimage1Err").innerHTML = "* Please Upload Business Image !";
                }else{
                    document.getElementById("shopimage1Err").innerHTML = "";
                    pass++;
                }if (document.getElementById("shopimage2").value == "") {
                    document.getElementById("shopimage2Err").innerHTML = "* Please Upload Business Image !";
                }else{
                    document.getElementById("shopimage2Err").innerHTML = "";
                    pass++;
                }if (document.getElementById("shopimage3").value == "") {
                    document.getElementById("shopimage3Err").innerHTML = "* Please Upload Business Image !";
                }else{
                    document.getElementById("shopimage3Err").innerHTML = "";
                    pass++;
                }
                $.each($("input[name='amentitiess']:checked"), function() {
                    sampleamentities_array.push($(this).val());
                });
                var addamentities = sampleamentities_array.length;
                if (addamentities == "0" || addamentities == undefined) {
                    document.getElementById("amentitiessErr").innerHTML = "* Please Choose Amenities !";
                }else if(addamentities <= 2) {
                    document.getElementById("amentitiessErr").innerHTML = "* Please Choose Atleast 3 Amenities !";
                }else{
                    document.getElementById("amentitiessErr").innerHTML = "";
                    pass++;
                }
                var sample_Business_hoursarray = [];
                var checkcount = 0;
                var businesscount = 0;
                $('.day-item').each(function() {
                    var isholiday = $(this).find(".choose-day-input-group > div > label > input").is(":checked");
                    var dayname = $(this).find(".choose-day-input-group > div > label > input:checkbox:not(:checked)").val();
                    var opentime = $(this).find(".choose-day-input-group").find(".open1").find(".border-right > input").val();
                    var closetime = $(this).find(".choose-day-input-group").find(".close1").find(".border-right > input").val();
                    var datas = {
                        isholiday: isholiday,
                        dayname: dayname,
                        opentime: opentime,
                        closetime: closetime
                    }
                    sample_Business_hoursarray.push(datas);
                    if (isholiday == true) {
                        checkcount++;
                    }else{
                        if (opentime != "" && closetime != "") {
                            businesscount++;
                        }
                    }
                });
                if(checkcount == 7){
                    document.getElementById("businesshoursErr").innerHTML = "* Please Choose Atleast One Working Day !";
                }else{
                    if(checkcount+businesscount == 7){
                        pass++;
                        document.getElementById("businesshoursErr").innerHTML = "";  
                    }else{
                        document.getElementById("businesshoursErr").innerHTML = "* Please Choose Working Hours !"; 
                    }
                }
                if(pass == 7) {
                    addamentitiesarray.push(sampleamentities_array);
                    Business_hoursarray.push(sample_Business_hoursarray);
                    $("#busines_info").hide();
                    $("#service_detail_sec").show();
                    $(".business-Info").addClass('completed');
                }
            }

            function business_working_hours() {
                var set_opentime = $('.day-item:first').find(".open1").find(".border-right > input").val();
                var set_closetime = $('.day-item:first').find(".close1").find(".border-right > input").val();
                $('.day-item').each(function() {
                    var dayView = $(this).find('.day-check-box').val();
                    var isholiday = $(this).find('.day-check-box').is(":checked");
                    if ( isholiday ) {
                        $(this).find(".open1").find(".border-right > input").val("");
                        $(this).find(".close1").find(".border-right > input").val("");
                    } else {
                        $(this).find(".open1").find(".border-right > input").val(set_opentime);
                        $(this).find(".close1").find(".border-right > input").val(set_closetime);
                    }
                });
            }
            //s3 file upload
            var image_id = ['shopimage1', 'shopimage2', 'shopimage3']
            function image_upload_loop(key) {
                var checkkey = key + 1;
                if(checkkey > image_id.length) {
                }else{
                    var fileUpload = document.getElementById(image_id[key]);
                    var file = fileUpload.files[0];
                    s3_file_upload(file, key);
                }
            }
            
            var edit_image_id = ['shopimageEdit0', 'shopimageEdit1', 'shopimageEdit2']
            function edit_image_upload_loop(key) {
                var checkkey = key + 1;
                if(checkkey > edit_image_id.length) {
                }else{
                    var fileUpload = document.getElementById(edit_image_id[key]);
                    var file = fileUpload.files[0];
                    if(file != undefined){
                        edit_s3_file_upload(file, key);
                    }else{
                        key++;
                        edit_image_upload_loop(key);
                    }     
                }
            }
            
            function edit_s3_file_upload(file, key) {
                var seconds = new Date().getTime();
                seconds = parseInt(seconds);
                var extension = file.name.split('.').pop().toLowerCase();
                var filename = seconds + '.' + extension;
                var folder = 'TestingBucket/';
                var objKey = folder + filename;
                var params = {
                    Key: objKey,
                    ContentType: file.type,
                    Body: file
                };
                bucket.putObject(params, function(err, data) {
                    if (err) {
                        alert('ERROR: ' + err);
                    }else{
                        var image_fileurl = aws_cloudfront_url + folder + filename;
                        $("#valid_" + edit_image_id[key]).val(image_fileurl);
                        key++;
                        edit_image_upload_loop(key);
                    }
                });
            }

            function s3_file_upload(file, key) {
                var seconds = new Date().getTime();
                seconds = parseInt(seconds);
                var extension = file.name.split('.').pop().toLowerCase();
                var filename = seconds + '.' + extension;
                var folder = 'TestingBucket/';
                var objKey = folder + filename;
                var params = {
                    Key: objKey,
                    ContentType: file.type,
                    Body: file
                };
                bucket.putObject(params, function(err, data) {
                    if (err) {
                        alert('ERROR: ' + err);
                    }else{
                        var image_fileurl = aws_cloudfront_url + folder + filename;
                        $("#valid_" + image_id[key]).val(image_fileurl);
                        key++;
                        image_upload_loop(key);
                    }
                });
            }

            function ValidateFileUpload(id) {
                var fuData = document.getElementById(id).files[0].name;
                var extension = fuData.split('.').pop().toLowerCase()
                if (extension == "png" || extension == "jpeg" || extension == "jpg") {
                    if (id == 'shopimage1') {
                        const [file_shopimage1] = shopimage1.files
                        if (file_shopimage1) {
                            view_shopimage1.src = URL.createObjectURL(file_shopimage1)
                            $('#shopimagename_hide1').show();
                            $('#view_shopimage1').addClass('uploaded');
                        }
                    }
                    if (id == 'shopimage2') {
                        const [file_shopimage2] = shopimage2.files
                        if (file_shopimage2) {
                            view_shopimage2.src = URL.createObjectURL(file_shopimage2)
                            $('#shopimagename_hide2').show();
                            $('#view_shopimage2').addClass('uploaded');
                        }
                    }
                    if (id == 'shopimage3') {
                        const [file_shopimage3] = shopimage3.files
                        if (file_shopimage3) {
                            view_shopimage3.src = URL.createObjectURL(file_shopimage3)
                            $('#shopimagename_hide3').show();
                            $('#view_shopimage3').addClass('uploaded');
                        }
                    }
                }else{
                    alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                }
            }

            function validateFileUploadForEdit(id){
               var fuData = document.getElementById(id).files[0].name;
                var extension = fuData.split('.').pop().toLowerCase()
                if (extension == "png" || extension == "jpeg" || extension == "jpg") {
                    if (id == 'shopimageEdit0') {
                        const [file_shopimageEdit0] = shopimageEdit0.files
                        if (file_shopimageEdit0) {
                            view_shopimageEdit0.src = URL.createObjectURL(file_shopimageEdit0)
                        }
                    }
                    if (id == 'shopimageEdit1') {
                        const [file_shopimageEdit1] = shopimageEdit1.files
                        if (file_shopimageEdit1) {
                            view_shopimageEdit1.src = URL.createObjectURL(file_shopimageEdit1)
                        }
                    }
                    if (id == 'shopimageEdit2') {
                        const [file_shopimageEdit2] = shopimageEdit2.files
                        if (file_shopimageEdit2) {
                            view_shopimageEdit2.src = URL.createObjectURL(file_shopimageEdit2)
                        }
                    }
                }else{
                    alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                } 
            }

            function file_upload_csv(file_id, view_id, replace_src) {
                var fileUpload = document.getElementById(file_id + "_upload");
                var files = !!fileUpload.files ? fileUpload.files : [];
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.csv|.CSV)$");
                if (regex.test(files[0].type)) {
                    if (typeof(fileUpload.files) != "undefined") {
                        var reader = new FileReader();
                        reader.readAsDataURL(fileUpload.files[0]);
                        reader.onload = function(e) {
                            $('#' + view_id).attr('src', replace_src);
                            $('#' + file_id + '_valid').val("true");
                            $("#" + file_id + '_name').html(files[0].name);
                        }
                    }
                }
            }

            $('#csv_upload_button').click(function() {
                var csvfilename = csv_file_upload.files[0];
                if (csvfilename != undefined) {
                    $("#myModal").modal('hide');
                }else{
                    $("#myModal").modal('show');
                    swal("Please select a csv file!");
                }
            });

            function cancelcsvfile() {
                var csvfilename = csv_file_upload.files[0];
                if(csvfilename == undefined) {
                    $("#myModal").modal('hide');
                }else{
                    $('#csv_file_name').text('Upload Files');
                    document.getElementById('csv_view_url').src = 'https://airportzo.net.in/service-provider-dashboard/asset/csvfile.png';
                    $('#csv_file_upload').val('');
                }
            }

            function upload_csv_file() {
                var valid = $('#csv_file_valid').val();
                if (valid == "true") {
                    $('#csv_upload_button').prop('disabled', true);
                    var myFormData = new FormData();
                    myFormData.append('file_upload', csv_file_upload.files[0]);
                    var ServiceCompanyToken = localStorage.getItem('service_provider_company_token')
                    if(ServiceCompanyToken == null){
                        var Company_Token = localStorage.getItem('dummy_service_companytoken');
                    }else{
                        var Company_Token = localStorage.getItem('service_provider_company_token');
                    }
                    var ServiceAirportToken = localStorage.getItem('service_provider_airport_token')
                    if(ServiceAirportToken == null){
                        var Airport_Token = localStorage.getItem('dummy_service_airporttoken');
                    }else{
                        var Airport_Token = localStorage.getItem('service_provider_airport_token');
                    }
                    myFormData.append('serviceProviderCompanyToken', Company_Token);
                    myFormData.append('serviceProviderAirportToken', Airport_Token);
                    $.ajax({
                        dataType: "json",
                        url: apiPath + "/csvUpload/individual.php",
                        type: 'POST',
                        async: false,
                        processData: false, // important
                        contentType: false, // important
                        data: myFormData,
                        success: function(data) {
                            if (data.status_code == 503) {
                                $('#csv_upload_button').prop('disabled', false);
                                swal(data.message);
                            }else if(data.status_code == 201){
                            }
                        }
                    });
                }
            }

            function Nextpage() {
                var csvfilename = csv_file_upload.files[0];
                if (csvfilename == undefined) {
                    swal("Please Upload CSV File For Creating Service !")
                }else{
                    $("#busines_info").hide();
                    $("#service_detail_sec").hide();
                    $("#policy_detail_sec").show();
                    $(".service-details").addClass('completed');
                    image_upload_loop(0);
                }
            }

            $('#terms_and_condition,#edit_terms_and_condition_list').summernote({
                placeholder: 'Terms & Conditions..',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'fontname', 'Open Sans']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', 'Verdana', 'Andale Mono1', 'Book Antiqua', 'Georgia', 'Helvetica', 'Impat', 'Symbol', 'Tahoma', 'Terminal', 'Times New Roman', 'Trebuchet Ms', 'Serif', 'Open Sans'],
                fontNamesIgnoreCheck: ['Open Sans'],
            });

            $('#privacy_and_policy,#edit_privacy_policy_list').summernote({
                placeholder: 'Privacy Policy..',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'fontname', 'Open Sans']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', 'Verdana', 'Andale Mono1', 'Book Antiqua', 'Georgia', 'Helvetica', 'Impat', 'Symbol', 'Tahoma', 'Terminal', 'Times New Roman', 'Trebuchet Ms', 'Serif', 'Open Sans'],
                fontNamesIgnoreCheck: ['Open Sans'],
            });

            $('#cancellattion_policy,#edit_cancellation_policy').summernote({
                placeholder: 'Cancellation Policy..',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'fontname', 'Open Sans']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', 'Verdana', 'Andale Mono1', 'Book Antiqua', 'Georgia', 'Helvetica', 'Impat', 'Symbol', 'Tahoma', 'Terminal', 'Times New Roman', 'Trebuchet Ms', 'Serif', 'Open Sans'],
                fontNamesIgnoreCheck: ['Open Sans'],
            });

            function termsandcondition() {
                var termsvalue = $('#terms_and_condition').summernote('code');
                if (termsvalue == '<p><br></p>') {
                    document.getElementById("terms_and_conditionErr").innerHTML = "* Please Enter Terms and Condition!";
                }else{
                    document.getElementById("terms_and_conditionErr").innerHTML = "";
                    swal({
                        title: "Success!",
                        text: "Terms and Condition Added Successfully!..",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        swal.close();
                        $('#terms_condition').modal('hide');
                        $('#showterms').html(termsvalue);
                        $('.terms-btn-hide').hide();
                        $('.terms-delete-btn').show();
                        $('.terms-edit-btn').show();
                    });
                }
            }

            function deleteterms() {
                var termsvalue = $('#terms_and_condition').summernote('code');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this terms?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#terms_and_condition').summernote('reset');
                        $('#showterms').empty(termsvalue);
                        $('.terms-btn-hide').show();
                        $('.terms-delete-btn').hide();
                        $('.terms-edit-btn').hide();
                    }
                });
            }

            function privacypolicy() {
                var privacypolicyvalue = $('#privacy_and_policy').summernote('code');
                if (privacypolicyvalue == '<p><br></p>') {
                    document.getElementById("privacy_and_policyErr").innerHTML = "* Please Enter Privacy Policy!";
                }else{
                    document.getElementById("privacy_and_policyErr").innerHTML = "";
                    swal({
                        title: "Success!",
                        text: "Privacy Policy Added Successfully!..",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        $('#privacy_policy').modal('hide');
                        $('#showprivacy').html(privacypolicyvalue);
                        $('.privacy-btn-hide').hide();
                        $('.privacy-delete-btn').show();
                        $('.privacy-edit-btn').show();
                    });
                }
            }

            function deleteprivacy() {
                var privacypolicyvalue = $('#privacy_and_policy').summernote('code');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this privacy?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#privacy_and_policy').summernote('reset');
                        $('#showprivacy').empty(privacypolicyvalue);
                        $('.privacy-btn-hide').show();
                        $('.privacy-delete-btn').hide();
                        $('.privacy-edit-btn').hide();
                    }
                });
            }
            
            function cancelpolicy() {
                var pass = 0;
                var cancelaationpolicy = $('#cancellattion_policy').summernote('code');
                if (cancelaationpolicy == '<p><br></p>') {
                    document.getElementById("cancellattion_policyErr").innerHTML = "* Please Enter Cancellation Policy!";
                }else{
                    document.getElementById("cancellattion_policyErr").innerHTML = "";
                    pass++;
                }
                for (i = 0; i < addCharge_arr.length; i++) {
                    if (document.getElementById("bookinghours" + addCharge_arr[i]).value == "") {
                        document.getElementById("bookinghoursErr" + addCharge_arr[i]).innerHTML = "*Enter The Hours!";
                    }else{
                        document.getElementById("bookinghoursErr" + addCharge_arr[i]).innerHTML = "";
                        pass++;
                    }
                    if (document.getElementById("totalbookingamount" + addCharge_arr[i]).value == "") {
                        document.getElementById("totalbookingamountErr" + addCharge_arr[i]).innerHTML = "*Enter The Percentage!";
                    }else{
                        document.getElementById("totalbookingamountErr" + addCharge_arr[i]).innerHTML = "";
                        pass++;
                    }
                    var Errorpass =(addCharge_arr.length*2)+1;
                    if (pass == Errorpass) {
                        swal({
                            title: "Success!",
                            text: "Cancellation Policy Added Successfully!..",
                            icon: "success",
                            button: "Ok",
                        }).then((value) => {
                            $('#cancel_policy').modal('hide');
                            $('#showcancellation').html(cancelaationpolicy);
                            $('.cancel-btn-hide').hide();
                            $('.cancel-delete-btn').show();
                            $('.cancel-edit-btn').show();
                        });
                    }
                }
            }

            function deletecancel() {
                var cancelaationpolicy = $('#cancellattion_policy').summernote('code');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Cancellation Policy?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#cancellattion_policy').summernote('reset');
                        $('#showcancellation').empty(cancelaationpolicy);
                        $('.cancel-btn-hide').show();
                        $('.cancel-delete-btn').hide();
                        $('.cancel-edit-btn').hide();
                        for (i = 0; i < addCharge_arr.length; i++) {
                            $("#removeCharges"+addCharge_arr[i]).remove();
                        }
                        addCharge_arr=[];
                        addCharge = 1;
                        multipleCancellationCharges();
                    }
                });
            }

            function reschedule_policy(){
                var pass=0;
                if(document.getElementById("reschedulepolicy").value == ""){
                    document.getElementById("reschedulepolicyErr").innerHTML = "* Please Enter Reschedule Policy!";
                }else{
                    document.getElementById("reschedulepolicyErr").innerHTML = "";
                    pass++;
                }
                if(pass==1){
                    var reschedulepolicyvalue = $('#reschedulepolicy').val();
                    swal({
                        title: "Success!",
                        text: "Reschedule Policy Added Successfully!..",
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        $('#reschedule__policy').modal('hide');
                        $('#showreschedule').html(reschedulepolicyvalue);
                        $('.reschedule-btn-hide').hide();
                        $('.reschedule-delete-btn').show();
                        $('.reschedule-edit-btn').show();
                    });
                }
            }

            function deletereschedule(){
                var reschedulepolicyvalue = $('#reschedulepolicy').val();
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Reschedule?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#reschedulepolicy').val('');
                        $('#showreschedule').empty(reschedulepolicyvalue);
                        $('.reschedule-btn-hide').show();
                        $('.reschedule-delete-btn').hide();
                        $('.reschedule-edit-btn').hide();
                    }
                });
            }

            function go_to_service_info() {
                var termsvalue = $('#terms_and_condition').summernote('code');
                var privacypolicyvalue = $('#privacy_and_policy').summernote('code');
                var cancelaationpolicy = $('#cancellattion_policy').summernote('code');
                var reschedulepolicyvalue = $('#reschedulepolicy').val();

                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var ServiceAirportToken = localStorage.getItem('service_provider_airport_token')
                if(ServiceAirportToken == null){
                    var Airport_Token = localStorage.getItem('dummy_service_airporttoken');
                }else{
                    var Airport_Token = localStorage.getItem('service_provider_airport_token');
                }
                var location_coordinates = $('#coordinates_input').val();
                var locationsplit = location_coordinates.split(',');
                var latitute = locationsplit[0];
                var longitute = locationsplit[1];
                var about_shop = $('#shop_message').val();

                var shopimagearray = [];
                var shop_photos1 = $('#valid_shopimage1').val();
                var shop_photos2 = $('#valid_shopimage2').val();
                var shop_photos3 = $('#valid_shopimage3').val();
                shopimagearray.push(shop_photos1);
                shopimagearray.push(shop_photos2);
                shopimagearray.push(shop_photos3);

                var cancellation_chargesarray = [];
                addCharge_arr.forEach(i => {
                        var canceldatas = {
                        booking_hours: $("#bookinghours" + i).val(),
                        bookingtotalamount: $("#totalbookingamount" + i).val()
                    }
                    cancellation_chargesarray.push(canceldatas);
                });
                
                var add_amentities = addamentitiesarray;
                var business_hours = Business_hoursarray;
                if (termsvalue != '<p><br></p>' && privacypolicyvalue != '<p><br></p>' && cancelaationpolicy != '<p><br></p>' && reschedulepolicyvalue!="") {
                    var datas = {
                        service_provider_locationtoken: companylocation_token,
                        airport_token: Airport_Token,
                        latitute: latitute,
                        longitute: longitute,
                        about_shop: about_shop,
                        shop_photos: shopimagearray,
                        add_amentities: add_amentities,
                        business_hours: business_hours,
                        termsandconditionsarray: $("#terms_and_condition").summernote('code'),
                        privacypolicyarray: $("#privacy_and_policy").summernote('code'),
                        cancellationpolicy: $("#cancellattion_policy").summernote('code'),
                        cancellation_chargesarray: cancellation_chargesarray,
                        reschedulePolicy: $('#reschedulepolicy').val()
                    }
                    upload_csv_file();
                    json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url : `${apiPath}/provider/updateServicePolicy.php`,
                        data: json1
                    }).done(function(data1){
                        if(data1.status_code == 201){
                            swal({
                                title: "Success!",
                                text: "Service Added Successfully!..",
                                icon: "success",
                                button: "Ok",
                            }).then((value) => {
                                window.location.href = "service-policy.php";
                            });
                        }
                        // else{
                        //     swal(data1.message);
                        // }
                    });
                }else{
                    swal({
                        title: "Error!",
                        text: "Please Fill All The Details!..",
                        icon: "error",
                        button: "Ok",
                    });
                }
            }

            var newCharge = '';
            var addCharge = 1,
            addCharge_arr = [];
            function multipleCancellationCharges() {
            addCharge_arr.push(addCharge);
            newCharge = `<div class="set_cancellation_charge" id="removeCharges` + addCharge + `">
                            <div class="type-changing" id="clearslot` + addCharge + `">
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="border: 1px solid #a9a9a9;text-align: center;" type="text" id="bookinghours` + addCharge + `" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>hours before,charge</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <p id="bookinghoursErr` + addCharge + `" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                    </div>
                                </div>
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="border: 1px solid #a9a9a9;text-align: center;" type="text" id="totalbookingamount` + addCharge + `" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>% of total booking amount</h5>
                                        </div>`;
                                        if(addCharge > 1){
                                            newCharge += `<div class="close_box cancelling-charges-sub">
                                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="margin-top: 4px;" onclick="clear_modalValue('removeCharges`+addCharge+`',`+addCharge+`)">
                                            </div>`; 
                                        }
                                    newCharge += `</div>
                                <div>
                                    <p id="totalbookingamountErr` + addCharge + `" style="color: red;font-size: 13px; padding-top: 8px; font-weight:600;"></p>
                                </div>
                                </div>
                            </div>
                        </div>`;
            if(addCharge != '1'){
                $('.cancelling-charges-sub').show();
            }else{
                $('.cancelling-charges-sub').hide();
            }
            $(".add-charage-clicker").append(newCharge);
            addCharge++;
            }

            var edit_Charge = '';
            function edit_multipleCancellationCharges() {
            var edit_count = edit_cancellation_charge_array.length;
            edit_Charge = `<div id="edit_removeCharges` + edit_count + `">
                            <div class="type-changing" id="clearslot` + edit_count + `">
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="" type="text" value="" id="edit_bookinghours` + edit_count + `" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>hours before,charge</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <p id="edit_bookinghoursErr` + edit_count + `" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                    </div>
                                </div>
                                <div>
                                    <div class="main-hours">
                                        <div class="timeing">
                                            <input style="" type="text" value="" id="edit_totalbookingamount` + edit_count + `" maxlength="2" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="location-hours">
                                            <h5>% of total booking amount</h5>
                                        </div>
                                        <div class="close_box cancelling-charges-sub">
                                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" style="margin-top: 4px;" onclick="edit_clear_modalValue('edit_removeCharges`+edit_count+`',`+edit_count+`)">
                                        </div>
                                    </div>
                                <div>
                                    <p id="edit_totalbookingamountErr` + edit_count + `" style="color: red;font-size: 13px; padding-top: 8px; font-weight:600;"></p>
                                </div>
                                </div>
                            </div>
                        </div>`;
            $(".edit_show_charges_list").append(edit_Charge);
            edit_cancellation_array.push(edit_count);
            edit_cancellation_charge_array.push(edit_count++);
            }

            function clear_modalValue(id,key) {
                $('#'+id).remove();
                let idx1 = addCharge_arr.indexOf(key);   //Remove the token to the array
                if (idx1 != -1) addCharge_arr.splice(idx1, 1);
            }
            
            function edit_clear_modalValue(id,key) {
                $('#'+id).remove();
                let idx13 = edit_cancellation_array.indexOf(key);   //Remove the token to the array
                if (idx13 != -1) edit_cancellation_array.splice(idx13, 1);
            }

            // Show the first tab and hide the rest
            $('#tabs-nav li:first-child').addClass('active');
            $('.tab-content').hide();
            $('.tab-content:first').show();

            // Click function
            $('#tabs-nav li').click(function () {
                $('#tabs-nav li').removeClass('active');
                $(this).addClass('active');
                $('.tab-content').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn();
                return false;
            });

            // Show the first tab and hide the rest
            $('#tabs-nav2 li:first-child').addClass('active');
            $('.tab-content2').hide();
            $('.tab-content2:first').show();

            // Click function
            $('#tabs-nav2 li').click(function () {
                $('#tabs-nav2 li').removeClass('active');
                $(this).addClass('active');
                $('.tab-content2').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn();
                return false;
            });

             function goBackToEditBusiness (){
                $("#edit_busines_info").show();
                $("#edit_policy_detail_sec").hide();
             }
            
             function edit_business_info() {
                var pass_edit = 0;
                var sampleamentities_array = [];
                if (document.getElementById("edit_coordinates_input").value == "") {
                    document.getElementById("edit_coordinates_inputErr").innerHTML = "* Please Enter The Coordinates !";
                }else{
                    document.getElementById("edit_coordinates_inputErr").innerHTML = "";
                    pass_edit++;
                }if (document.getElementById("edit_shop_message").value.trim() == "") {
                    document.getElementById("edit_shop_messageErr").innerHTML = "* Please Enter Your Business Description !";
                }else{
                    document.getElementById("edit_shop_messageErr").innerHTML = "";
                    pass_edit++;
                }
                $.each($("input[name='edit_amentitiess']:checked"), function() {
                    sampleamentities_array.push($(this).val());
                });
                var addamentities = sampleamentities_array.length;
                if (addamentities == "0" || addamentities == undefined) {
                    document.getElementById("edit_amentitiessErr").innerHTML = "* Please Choose The Amenities !";
                }else if(addamentities <= 2) {
                    document.getElementById("edit_amentitiessErr").innerHTML = "* Please Choose Atleast 3 Amenities !";
                }else{
                    document.getElementById("edit_amentitiessErr").innerHTML = "";
                    pass_edit++;
                }
                var sample_Business_hoursarray = [];
                var checkcount = 0;
                var businesscount = 0;
                $('.edit-day-item').each(function() {
                    var isholiday = $(this).find(".choose-day-input-group > div > label > input").is(":checked");
                    var dayname = $(this).find(".choose-day-input-group > div > label > input:checkbox:not(:checked)").val();
                    var opentime = $(this).find(".choose-day-input-group").find(".open1").find(".border-right > input").val();
                    var closetime = $(this).find(".choose-day-input-group").find(".close1").find(".border-right > input").val();
                    var datas = {
                        isholiday: isholiday,
                        dayname: dayname,
                        opentime: opentime,
                        closetime: closetime
                    }
                    sample_Business_hoursarray.push(datas);
                    if (isholiday == true) {
                        checkcount++;
                    }else{
                        if (opentime != "" && closetime != "") {
                            businesscount++;
                        }
                    }
                });
                if(checkcount == 7){
                    document.getElementById("edit_businesshoursErr").innerHTML = "* Please Choose Atleast One Working Day !";
                }else{
                    if(checkcount+businesscount == 7){
                        pass_edit++;
                        document.getElementById("edit_businesshoursErr").innerHTML = "";  
                    }else{
                        document.getElementById("edit_businesshoursErr").innerHTML = "* Please Choose Working Hours !"; 
                    }
                }
                if(pass_edit == 4) {
                    addamentitiesarray.push(sampleamentities_array);
                    Business_hoursarray.push(sample_Business_hoursarray);
                    $("#edit_busines_info").hide();
                    $("#edit_policy_detail_sec").show();
                    $(".edit-business-Info").addClass('completed');
                    $(".edit-policy-details").addClass('active');
                    edit_image_upload_loop(0);
                }
            }

            function edit_nextpage(){
                $("#edit_busines_info").hide();
                $("#edit_service_detail_sec").hide();
                $("#edit_policy_detail_sec").show();
                $(".edit-service-details").addClass('completed');
            }
            
            function update_service_details(){
               var char_contain = (edit_cancellation_array.length);
               var summerEditor = 4;
               var totalCountEditPass = (summerEditor+char_contain);
               var edit_pass = 0;
               if($("#edit_terms_and_condition_list").next(".note-editor").children(".note-editing-area").find(".note-editable").text() != ''){
                     var termsvalue = $('#edit_terms_and_condition_list').summernote('code');
                     edit_pass++;
               }else{
                     swal('Terms And Conditions Empty');
               }
               if($("#edit_privacy_policy_list").next(".note-editor").children(".note-editing-area").find(".note-editable").text() != ''){
                    var privacypolicyvalue = $('#edit_privacy_policy_list').summernote('code');
                    edit_pass++;
               }else{
                   swal('Privacy Policy Empty');
               }
               if($("#edit_cancellation_policy").next(".note-editor").children(".note-editing-area").find(".note-editable").text() != ''){
                    var cancelaationpolicy = $('#edit_cancellation_policy').summernote('code');
                    edit_pass++;
               }else{
                    swal('Cancellation Policy Empty');
               }
               var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
               if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
               }else{
                   var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
               }
               var ServiceAirportToken = localStorage.getItem('service_provider_airport_token')
               if(ServiceAirportToken == null){
                   var Airport_Token = localStorage.getItem('dummy_service_airporttoken');
               }else{
                   var Airport_Token = localStorage.getItem('service_provider_airport_token');
               }
               var location_coordinates = $('#edit_coordinates_input').val();
               var locationsplit = location_coordinates.split(',');
               var latitute = locationsplit[0];
               var longitute = locationsplit[1];
               var about_shop = $('#edit_shop_message').val();

                var shopimagearray = [];
                var shop_photos1 = $('#valid_shopimageEdit0').val();
                var shop_photos2 = $('#valid_shopimageEdit1').val();
                var shop_photos3 = $('#valid_shopimageEdit2').val();
                shopimagearray.push(shop_photos1);
                shopimagearray.push(shop_photos2);
                shopimagearray.push(shop_photos3);
                
                var cancellation_chargesarray = [];
                edit_cancellation_array.forEach(i =>{
                    if(($("#edit_bookinghours" + i).val() != '' && $("#edit_bookinghours" + i).val() != undefined) && ($("#edit_totalbookingamount" + i).val() != '' && $("#edit_totalbookingamount" + i).val() != undefined)){
                        edit_pass++;
                        var canceldatas = {
                            booking_hours: $("#edit_bookinghours" + i).val(),
                            bookingtotalamount: $("#edit_totalbookingamount" + i).val()
                        }
                        cancellation_chargesarray.push(canceldatas);
                    }else{
                        swal("Cancellation charges is Empty");
                    }
                });
                var updatereschedules = $('#edit_reschedule_policy').val();
                if(updatereschedules==""){
                    swal("Reschedule Policy is Empty");
                }else{
                    edit_pass++;
                    var updatereschedules = $('#edit_reschedule_policy').val();
                }
                var add_amentities = addamentitiesarray;
                var business_hours = Business_hoursarray;
                if (totalCountEditPass == edit_pass) {
                    var datas = {
                        service_provider_locationtoken: companylocation_token,
                        airport_token: Airport_Token,
                        latitute: latitute,
                        longitute: longitute,
                        about_shop: about_shop,
                        shop_photos: shopimagearray,
                        add_amentities: add_amentities,
                        business_hours: business_hours,
                        termsandconditionsarray: $("#edit_terms_and_condition_list").summernote('code'),
                        privacypolicyarray: $("#edit_privacy_policy_list").summernote('code'),
                        cancellationpolicy: $("#edit_cancellation_policy").summernote('code'),
                        cancellation_chargesarray: cancellation_chargesarray,
                        reschedulePolicy: $('#edit_reschedule_policy').val()
                    }
                    json1 = JSON.stringify(datas);
                  $.ajax({
                      dataType: "JSON",
                      type: "POST",
                      url : `${apiPath}/provider/updateServicePolicy.php`,
                      data: json1
                  }).done(function(data1){
                      if(data1.status_code == 201){
                          swal({
                              title: "Success!",
                              text: "Service Updated Successfully!..",
                              icon: "success",
                              button: "Ok",
                          }).then((value) => {
                              window.location.href = "service-policy.php";
                          });
                      }
                      else{
                          swal(data1.message);
                      }
                  });
                }
//                else{
//                    swal({
//                        title: "Error!",
//                        text: "Please Fill All The Details!..",
//                        icon: "error",
//                        button: "Ok",
//                    });
//                } 
            }
        </script>
    </body>
    </html>
<?php
}
?>