<?php
include_once '../config/core.php';
include '../security/secure.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>set commission And Target</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png" />

    <!-- country-flag -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
    <!-- datepicker style -->
    <!-- boostrap-popup-link-->
    <link rel="stylesheet" href="./css/bootstrap.min.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/bootstrap-icons.css" />
    <link rel="stylesheet" href="./css/bootstrap-datetimepicker.css" />
    <!-- header-sidemenu-css -->
    <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />

    <!-- horizontal-bar-css -->
    <link rel="stylesheet" href="./css/horizontal-bar.css<?php echo $js_cache_string; ?>" />

    <!-- set commission And Target-css  -->
    <link rel="stylesheet" href="./css/set commission And Target.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/bank-detial.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/review.css<?php echo $js_cache_string; ?>">
    <!-- <link rel="stylesheet" href="./css/my-staffas.css"> -->
    <link rel="stylesheet" href="./css/agent-detailes-1.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/fonts.css" />
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">


</head>
<style type="text/css">

    
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
    -moz-appearance:textfield;
}
.succes-icon-text{
   display: flex;
}
.succes-icon-text img:last-of-type{
    width: 16px;
    margin-left: 10px;
    cursor: pointer;
}
.sub-text1
{
    font-size: 16px;
    font-weight: bold;
    color: #000;
}
.input__box--dob {
    background: url(asset/img/calendar.svg) no-repeat right;
}
</style>

<body>
    <!-- page loader -->

    <header id="header"></header>
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar"></div>
            <!-- over-cont-head -->
            <div class="over-all-heading">
                <!-- header -->
                <div class="top-head">
                    <div class="list-tital">
                        <h3 class="cont-name">Add new agent</h3>
                    </div>
                </div>

                <!-- header-2-tital -->
                <div class="paragaras-bar">
                    <div class="details_list">
                        <ul>
                            <li class="active agent-details">
                                <p class="shop_staus-name">Agent details</p>
                                <span class="tick"></span>
                            </li>
                            <li class="bank_detail">
                                <p class="shop_staus-name">Bank details</p>
                                <span class="tick"></span>
                            </li>
                            <li class="document">
                                <p class="shop_staus-name">Documents</p>
                                <span class="tick"></span>
                            </li>
                        </ul>
                    </div>

                    <div class="all-set-hide">

                        <!-- profil-upload -->
                        <div class="main-profil-upd">
                            <div class="photo-up">
                                <div class="profile_img" id="before_profile_pic" style="display: flex;">
                                <input id="valid_profile_pic" type="hidden">
                                    <label for="profile_pic"><img src="./asset/img/uplod.png" class="upload-icon" id="display_profile_pic">
                                    <input type="file" name="" id="profile_pic" class="file-upload" onchange="imagevalidate('profile_pic');"></label>
                                </div>

                                <div class="numer-acc alert-cont">
                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Company Logo!</p>
                                </div>
                            </div>
                        </div>
                        <!--profil- end -->

                        <!-- profil-edit-typebox -->
                        <!-- name -->
                        <div class="main-form-box">
                            <div class="type-detials">
                                <div>
                                    <div class="user_name">
                                        <select class="option-set salutation">
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                        <div class="input_cont">
                                            <label for="agent_name">Agent Name</label>
                                            <input type="text" name="" id="agent_name" class="border-none">
                                        </div>
                                    </div>
                                    <div class="numer-acc alert-cont nameerror">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Enter Agent Name</p>
                                    </div>
                                </div>
                                <!-- vate-of-birth -->
                                <div>
                                    <div class="user_name">
                                        <!-- <div class='arriving-input-set
                                            input-group' >
                                            <div class="date-con">
                                                <label for="dob_value">Date of birth</label>
                                                <input type='text' class="b-input datepicker" id="dob_value" placeholder="DD-MM-YYYY" readonly/>
                                            </div>
                                            <label for="dob_value" class="input-group-addon
                                                bg-date">
                                            </label>
                                        </div> -->
                                        <div class="input_cont input__box--dob">
                                            <label for="dob_value">Date of birth</label>
                                            <input type='text' class="b-input datepicker" id="dob_value" placeholder="DD-MM-YYYY" readonly/>
                                        </div>
                                    </div>
                                    <div class="numer-acc doberror alert-cont">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Select DOB</p>
                                    </div>
                                </div>
                                <!-- type-of-agent -->
                                <div>
                                    <div class="user_name">
                                        <div class="shop_title">
                                            <p>Agent type</p>
                                            <select class="input_cont business_type">
                                                <option value="0">Select Type</option>
                                                <option val="Customer agent">Customer agent</option>
                                                <option val="Sub-Agent">Sub-Agent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="numer-acc alert-cont bus_type_error">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Select Agent type!</p>
                                    </div>
                                </div>
                                <!-- email -->
                                <div>
                                    <div class="user_name">
                                        <div class="input_cont">
                                            <label for="business_website">Business Website</label>
                                            <input type="text" name="business_website" id="business_website">
                                        </div>
                                    </div>
                                    <div class="numer-acc alert-cont websiteerror">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Enter Website!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- profil-edit-typebox-end -->

                        <!-- line -->
                        <div class="single-line"></div>

                        <!-- primary-contact -->
                        <div class="primary-contact">
                            <div class="contact-status">
                                <div class="contact-detials">
                                    <h4>Primary Contact Details</h4>
                                    <p>Sub agents primary mode of contact</p>
                                </div>
                                <div class="-main-contact-type-box">
                                    <div class="contact-list">
                                        <div class="information_contect">
                                            <div>
                                                <!-- <div class="title_box" id="primary_cc">
                                                    <div class="" data-aos="zoom-in-down" >
                                                        <input type="text" id="mobile_code" class="country_select" placeholder="" name="">
                                                    </div>
                                                    <div class="input_cont">
                                                        <p>Mobile Number</p>
                                                        <input type="number" onKeyPress="if(this.value.length==10) return false;" name="" class="primary-mob">
                                                    </div>
                                                </div> -->
                                                <div class="input-form-group-item">
                                                    <div class="login-input-action-set" id="phone_mobileno">
                                                        <div class="login-input-group phone">
                                                            <label for="mobile_no">Mobile Number</label>
                                                            <input type="tel" class="login-input-box" id="mobile_no" name="phone" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont moberror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please enter valid mobile Number!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="title_box
                                                    information_text">
                                                    <div class="input_cont">
                                                        <label for="primary-mail">Email Address</label>
                                                        <input id="primary-mail" type="email" name="" class="primary-email" placeholder="clementjohn62@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont emailerror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please enter valid email!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <!-- <div class="title_box" id="alternative_cc">
                                                    <div class="" data-aos="zoom-in-down">
                                                        <input type="text" id="mobile_code2" class="country_select" placeholder="" name="">
                                                    </div>
                                                    <div class="input_cont">
                                                        <p>Alternative
                                                            Mobile Number</p>
                                                        <input type="number" onKeyPress="if(this.value.length==10) return false;" name="" class="alter-mob" placeholder="73576571234">
                                                    </div>
                                                </div> -->
                                                <div class="input-form-group-item">
                                                    <div class="login-input-action-set" id="phone_mobileno">
                                                        <div class="login-input-group phone">
                                                            <label for="alt-mobile_no">Alternate Mobile Number</label>
                                                            <input type="tel" class="login-input-box" id="alt-mobile_no" name="phone" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="text-end">(Optional)</p>
                                                <div class="numer-acc alert-cont">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Company Logo!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="title_box
                                                        email_text">
                                                    <div class="input_cont">
                                                        <label for="alt-email">Alternative Email
                                                            Address</label>
                                                        <input type="email" id="alt-email" name="" class="alter-email" placeholder="linzjohn@gmail.com">
                                                    </div>
                                                </div>
                                                <p class="text-end">(Optional)</p>
                                                <div class="numer-acc alert-cont">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Upload Company Logo!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- primary-contact-end -->

                        <!-- line -->
                        <div class="single-line"></div>
                        <!-- primary-contact-2 -->
                        <div class="primary-contact">
                            <div class="contact-status">
                                <div class="contact-detials">
                                    <h4>Address</h4>
                                    <p>Business location of the sub agent</p>
                                </div>
                                <div class="-main-contact-type-box">
                                    <div class="contact-list">
                                        <div class="information_contect">
                                            <div>
                                                <div class="title_box
                                                    information_text">
                                                    <div class="input_cont">
                                                        <label for="business-address">Address</label>
                                                        <input id="business-address" type="" name="" class="address" placeholder="56  B,Indigo  Airlines,Velachery">
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont addresserror">
                                                    <p class="account_mactched "><img src="./asset/img/alert-icon.png" /> Please fill address!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="user_name">
                                                    <div class="shop_title">
                                                        <p>Country</p>
                                                        <select class="input_cont country">
                                                        <!-- <option value="0">Select Country</option>
                                                            <option value = 1>India</option>
                                                            <option>Terminal 2</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont countryerror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please select country!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="user_name">
                                                    <div class="shop_title">
                                                        <p>State</p>
                                                        <select class="input_cont state">
                                                        <option value="0">Select State</option>
                                                            <!-- <option>Tamilnadu</option>
                                                            <option>Terminal 2</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont stateerror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" />Please Select state!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="user_name">
                                                    <div class="shop_title">
                                                        <p>City</p>
                                                        <select class="input_cont city">
                                                        <option value="0">Select City</option>
                                                            <!-- <option>Chennai</option>
                                                            <option>Terminal 2</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont cityerror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please select city!</p>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="title_box
                                                    information_text">
                                                    <div class="input_cont">
                                                        <label for="business-pincode">Pincode</p>
                                                        <input id="business-pincode" type="text" name="" class="pincode" placeholder="641114">
                                                    </div>
                                                </div>
                                                <div class="numer-acc alert-cont pinerror">
                                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please enter pincode!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- primary-contact-end-2 -->

                        <!-- line -->
                        <div class="single-line"></div>

                        <div class="primary-contact">
                            <div class="contact-status">
                                <div class="contact-detials" id="beforeBookingChannel">
                                    <h4>Booking Channel</h4>
                                    <p>Booking access via</p>
                                </div>
                                <!-- <div class="checkbox">
                                    <div class="channel-radio">
                                        <div class="" id="">
                                            <input class="is_credit" type="radio" id="online" name="booking-channel" value="0" checked>
                                            <label for="online">online</label>
                                        </div>
                                        <div class="" id="">
                                            <input class="is_credit" type="radio" id="credit" name="booking-channel" value="1">
                                            <label for="credit">credit</label>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <!-- primary-contact-3 -->
                        <div class="primary-contact">
                            <div class="contact-status">
                                <div class="contact-detials">
                                    <h4>Commissions and target</h4>
                                    <p>Set the commission charge, monthly
                                        targets or incentives for sub agent</p>
                                </div>
                                <div class="checkbox hidden">
                                    <div class="main-radio">
                                        <div class="set-target" id="commission">
                                            <input type="radio" id="input_commision" name="drone" value="1">
                                            <label for="input_commision">Set commission and target</label>
                                        </div>
                                        <div class="set-incen" id="incentives">
                                            <input type="radio" id="input_incent" name="drone" value="2" checked>
                                            <label for="input_incent">Set Incentives</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="commi-rate-book" id="commission-type-box">
                                    <div>
                                        <div class="user_name">
                                            <div class='arriving-input-set input-percentage'>
                                                <span class="input-group-addon
                                                        bg-percentage">%
                                                </span>
                                                <div class="date-percen">
                                                    <label for="comm-percent" class="comm-per-booking">Commission Rate per booking</label>
                                                    <input type='number' class="b-input datepicker commpercent" id="comm-percent" value=15 placeholder="15" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="title_box
                                                information_text">
                                            <div class="input_cont">
                                                <label for="yearly-tar">Yearly Target</label>
                                                <input id="yearly-tar" type="number" name="" class="yearlytarget" placeholder="50,000">
                                            </div>
                                        </div>
                                        <!-- <p class="text-start">(4,167 booking per month)</p> -->
                                    </div>
                                </div>

                                <div class="main-slide-radios" id="Incentives-type-box">
                                    <div class="Set_service-title" id="slot_0">
                                        <div class="title_fooder_box
                                                information_text">
                                            <div class="input_cont">
                                                <label for="book-range-from">Booking Amount from</label>
                                                <input id="book-range-from" type="number" name="" class="percemt-text bookfrom" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="title_fooder_box
                                                information_text">
                                            <div class="input_cont">
                                                <label for="book-range-to">Booking Amount to</label>
                                                <input id="book-range-to" type="number" name="" class="percemt-text bookto" placeholder="1000">
                                            </div>
                                        </div>

                                        <div class="title_fooder_box">
                                            <div class="pasint">
                                                <h2>%</h2>
                                            </div>
                                            <div class="input_percent">
                                                <label for="incent-percent">Incentive percentage</label>
                                                <input id="incent-percent" type="number" name="" class="percemt-text incent" placeholder="0.5">
                                            </div>
                                        </div>


                                        <!-- <div class="close_box">
                                            <p>X</p>
                                        </div> -->
                                    </div>
                                    <!-- <div class="Set_service-title" id="slot_2">
                                        <div class="title_fooder_box
                                                information_text">
                                            <div class="input_conts">
                                                <p>Book range from</p>
                                                <input type="" name="" class="percemt-text" placeholder="1001">
                                            </div>
                                        </div>
                                        <div class="title_fooder_box
                                                information_text">
                                            <div class="input_conts">
                                                <p>Book range to</p>
                                                <input type="" name="" class="percemt-text" placeholder="2000">
                                            </div>
                                        </div>

                                        <div class="title_fooder_box">
                                            <div class="pasint">
                                                <h2>%</h2>
                                            </div>
                                            <div class="input_percent">
                                                <p>Incentive percentage</p>
                                                <input type="" name="" class="percemt-text" placeholder="1">
                                            </div>
                                        </div>

                                        <div class="close_box">
                                            <p>X</p>
                                        </div>
                                    </div> -->
                                  

                                </div>
                                    <div class="numer-acc alert-cont commerror">
                                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Please Fill the required fields</p>
                                    </div>
                                    <div class="add_slot_text" style="">
                                            <p>+ Add booking range</p>
                                    </div>
                            </div>
                        </div>

                        <div class="aromark">
                            <button class="button button5">
                                <img src="./asset/img/aaro-icon.png" id="arrow_id1" class="aaro-icon" alt="aaro" onclick="agent_detail()" />
                            </button>
                        </div>

                    </div>


                    <!-- ..........3 Bank Details-form.......... -->
                    <div class="bank_detail_fullbox hide">
                        <div class="your_bank_title">
                            <h4>Link Your bank</h4>
                            <p>This will help us to send payments on
                                your bookings</p>
                        </div>
                        <div class="Contact_boxs3">
                            <div>
                                <div class="account_info">
                                    <div class="account_conts">
                                        <p>Account Number</p>
                                        <input type="text" name="" placeholder="962557565634567" class="number_text accountno" />
                                    </div>
                                </div>
                                <!--  <div class="numer-acc alert-cont">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Account number not  mactched</p>
                                </div> -->
                            </div>
                            <div>
                                <!-- <div class="account_info"> -->
                                <div class="account_info accountreenter  ">
                                    <div class="account_conts reject_conts">
                                        <p>Re-enter Account Number</p>
                                        <input type="text" name="" placeholder="962557565634567" class="alert_text reaccountno" />
                                    </div>
                                </div>
                                <!-- </div> -->
                                <div class="numer-acc alert-cont accnoerror">
                                    <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Account number does not match</p>
                                </div>
                            </div>
                        </div>
                        <div class="Contact_boxs4">
                            <div>
                                <div class="account_info">
                                    <div class="account_conts">
                                        <p>IFSC Code</p>
                                        <input type="text" name="" placeholder="ABCD0001234" id="ifsc_code" oninput="ifsc_function()" class="number_text" />
                                    </div>
                                </div>
                                 <div class="numer-acc alert-cont ifscerror">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Enter IFSC</p>
                                </div>
                            </div>
                            <div>
                            <div class="account_info-branch">
                                <div>
                                    <div class="account_conts">
                                        <p>Branch</p>
                                        <input type="text" name="" placeholder="Velachery" id="bank_branch" class="number_branch_text branch" readonly/>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="numer-acc alert-cont brancherror">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Enter Branch</p>
                                    </div>
                            </div>
                        </div>
                        <div class="Contact_boxs5">
                            <div>
                                <div class="account_info-branch">
                                    <div class="account_conts">
                                        <p>City</p>
                                        <input type="text" name="" placeholder="Chennai" id="bank_city" class="number_branch_text" readonly/>
                                    </div>
                                </div>
                                <!-- <div class="numer-acc alert-cont">
                                        <p class="account_mactched"><img src="./asset/img/alert-icon.png" /> Account number not  mactched</p>
                                </div> -->
                            </div>
                        </div>
                        <div class="aromark">
                            <button class="button button5" onclick="bankinfo();">
                                <a href="#"><img src="./asset/img/aaro-icon.png" id="arrow_id2" class="aaro-icon" alt="aaro" /></a>
                            </button>
                        </div>
                    </div>

                    <!-- doument style -->
                    <div class="main-pan-card-detial hide">
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Pan Card/Tax License Number</h4>
                                <p>Upload your PAN card for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_pan_card" style="display: flex;">
                                    <input id="valid_pan_card" type="hidden">
                                    <input type="file" id="pan_card" class="hidden" onchange="filevalidate('pan_card')">
                                    <label for="pan_card" class="msme-cert">Upload PAN Card</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_pan_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('pan_card');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- gst-certificaton -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>GST/VAT</h4>
                                <p>Upload your GST Certificate for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_gst_card" style="display: flex;">
                                    <input id="valid_gst_certificate" type="hidden">
                                    <input type="file" id="gst_certificate" class="hidden" onchange="filevalidate('gst_certificate')">
                                    <label for="gst_certificate" class="msme-cert">Upload GST Certificate</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_gst_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('gst_card');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MSME Certificate -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>MSME Certificate</h4>
                                <p>Upload your MSME Certificate for
                                    Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_msme_card" style="display: flex;">
                                    <input id="valid_file1" type="hidden">
                                    <input type="file" id="file1" class="hidden" onchange="filevalidate('file1');">
                                    <label for="file1" class="msme-cert">Upload MSME Certificate</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_msme_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('msme_card');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate of Incorporation -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Certificate of Incorporation</h4>
                                <p>Upload your Certificate of Incorporation
                                    for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_incorporation_card" style="display: flex;">
                                    <input id="valid_file2" type="hidden">
                                    <input type="file" id="file2" class="hidden" onchange="filevalidate('file2')">
                                    <label for="file2" class="msme-cert">Upload Incorporation Certificate</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_incorporation_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('incorporation_card');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Void Cheque -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Void Cheque</h4>
                                <p>Upload your bank account cancelled cheque
                                    for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_void_cheque" style="display: flex;">
                                    <input id="valid_void_cheque" type="hidden">
                                    <input type="file" id="void_cheque" class="hidden" onchange="filevalidate('void_cheque');">
                                    <label for="void_cheque" class="msme-cert">Upload Void Cheque</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_void_cheque" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('void_cheque');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contract Agreement -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Contract Agreement</h4>
                                <p>Upload your signed Contract agreement for
                                    Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_ca_card">
                                    <input id="valid_ca_card" type="hidden">
                                    <input type="file" id="ca_card" class="hidden" onchange="filevalidate('ca_card')">
                                    <label for="ca_card" class="msme-cert">Upload Contract Agreement</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_ca_card" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('ca_card');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- upload document one -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Other Document 1</h4>
                                <p>Upload your other document for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_other_doc1" style="display: flex;">
                                    <input id="valid_other_doc1" type="hidden">
                                    <input type="file" id="other_doc1" class="hidden" onchange="filevalidate('other_doc1');">
                                    <label for="other_doc1" class="msme-cert">Upload</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_other_doc1" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('other_doc1');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- upload document two -->
                        <div class="main-tital">
                            <div class="rait-side-tital">
                                <h4>Other Document 2</h4>
                                <p>Upload your other document for Verification</p>
                            </div>
                            <div>
                                <div class="pan_cont" id="before_other_doc2" style="display: flex;">
                                    <input id="valid_other_doc2" type="hidden">
                                    <input type="file" id="other_doc2" class="hidden" onchange="filevalidate('other_doc2');">
                                    <label for="other_doc2" class="msme-cert">Upload</label>
                                </div>
                                <div class="pan_uploaded_cont" id="after_other_doc2" style="display: none;">
                                    <div class="succes-icon-text">
                                        <img src="asset/images/tick-icon.png" id="panImage" class="tick-icon">
                                        <p id="upload_pdf_image">Uploaded</p>
                                        <img src="asset/images/close.svg" id="upload_pdf_image" onclick="clearImageData('other_doc2');" class="doc-close-icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- check-box -->
                        <div class="agreey-infor">
                            <input type="checkbox" id="scales" name="scales">
                            <label for="scales">I hereby declare that the information provided is true and corrent, I also understand that any <br>
                    Willful dishonesty may render for refusal of this applicaton or immediate termination of this application.
                            </label>
                        </div>

                        <div class="aromark">
                            <button class="button button5 buttons" onclick="documents_info();">
                                <a href="#"><img src="./asset/img/aaro-icon.png" id="arrow_id3" class="aaro-icon" alt="aaro" /></a>
                            </button>
                        </div>
                    </div>
                    <!-- doument end -->

                    <!--   <div class="aromark">
                            <button class="button button5">
                                <a href="review.html"><img  src="./asset/img/aaro-icon.png" id= "arrow_id" class="aaro-icon" alt="aaro" /></a>
                            </button>
                        </div> -->


                    <!-- fiest hide -->

                    <!-- primary-contact-end-3 -->
                </div>
                <div class="review-set-hold hide">
                    <div class="side-table">
                        <div class="header-services">
                            <h1>Review</h1>
                        </div>
                             <div class="over-all-tab">
                                    <ul class="tabs-agent">
                                        <li class="tab-link current-active" data-tab="tab-1-agent-list">Agent
                                            Details
                                        </li>
                                        <li class="tab-link" data-tab="tab-2-agent-list">Bank Details
                                        </li>
                                        <li class="tab-link-reviw" data-tab="tab-3-agent-list">Documents
                                        </li>
                                    </ul>

                                    <div id="tab-1-agent-list" class="tab-content
                                    current-active">
                                        <div class="clement-common">
                                            <div class="clement-jhon">
                                                <img id="view_profile_pic"  class="upload-icon" src="./asset/clement.png" alt="">
                                            </div>
                                            <div class="clement-jhon-inner">
                                                <div class="clement-name">
                                                    <h1 class="reviewname">Mr.Clement Jhon</h1>
                                                </div>
                                                <div class="clement-jhon-inner-over-all">
                                                    <div class="date">
                                                        <p>Date of Birth</p>
                                                        <p class="reviewdob">27may,1968</p>
                                                    </div>
                                                    <div class="date">
                                                        <p>Agent Type</p>
                                                        <p class="reviewbusitype">Business</p>
                                                    </div>
                                                    <div class="date">
                                                        <p>Business Website</p>
                                                        <p class="reviewweb">WWW.indigoairlines.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="primary">
                                            <h1>
                                                primary contact details
                                            </h1>
                                            <div class="primary-inner">
                                                <div class="date">
                                                    <p>Mobile Number</p>
                                                    <p class="reviewmob">962575772234</p>
                                                </div>
                                                <div class="date">
                                                    <p>Email Address</p>
                                                    <p class="reviewemail">clementjhon68@gmail.com</p>
                                                </div>
                                                <div class="date">
                                                    <p>Alternative Mobile Number</p>
                                                    <p class="reviewaltmob">7357671254r</p>
                                                </div>
                                                <div class="date">
                                                    <p>Alternative Email Address</p>
                                                    <p class="reviewaltemail">linzjhon@gmail.com.com</p>
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
                                                    <p class="reviewaddress">56B, Indigo Airlines,velachery</p>
                                                </div>
                                                <div class="date">
                                                    <p>Country</p>
                                                    <p class="reviewcountry">india</p>
                                                </div>
                                                <div class="date">
                                                    <p>State</p>
                                                    <p class="reviewstate">Tamil nadu</p>
                                                </div>

                                            </div>
                                            <div class="address-inner-another">
                                                <div class="date">
                                                    <p>City</p>
                                                    <p class="reviewcity">Chennai</p>
                                                </div>
                                                <div class="date">
                                                    <p>Pincode</p>
                                                    <p class="reviewpin">641114</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="incentives">
                                            <h1>Incentives</h1>
                                            1) 0 To 1000 Bookings - 0.5%<br><br>
                                            2) 1001 To 2000 Bookings - 1%
                                        </div>
                                        <div class="agent-button">
                                            <button type="button" class="createagent agent-btn">Okay</button>
                                        </div>

                                    </div>
                                    <div id="tab-2-agent-list" class="tab-content">
                                          <div class="primary">
                                            <h1>
                                                Bank details
                                            </h1>
                                            <div class="primary-inner">
                                                <div class="date">
                                                    <p>Account Number</p>
                                                    <p class="reviewaccount">962575772234</p>
                                                </div>
                                                <div class="date">
                                                    <p>IFSC Code</p>
                                                    <p class="reviewifsc">clementjhon68@gmail.com</p>
                                                </div>
                                                <div class="date">
                                                    <p>Branch</p>
                                                    <p class="reviewbranch">7357671254</p>
                                                </div>
                                                <div class="date">
                                                    <p>City</p>
                                                    <p class="reviewbankcity">linzjhon@gmail.com.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3-agent-list" class="tab-content">
                                 <div class="document-view">
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79" alt="document file" id="view_pancard" class="document-file" />
                                        </div>
                                        <p class="file-name">PAN Card</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/33f6d690-db45-4e3c-9a58-9073fea7628c" id="view_gst" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">GST Certificate</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="blob:https://airportzo.net.in/843d30e4-bc85-4892-ace3-dc56d3283acc" id="view_msme" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">MSME Certificate</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="#" id="view_incorporation" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">Certificate of Incorporation</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="#" id="view_void_cheque" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">Void Cheque</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="#" id="view_ca_card" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">Contract Agreement</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="#" id="view_other_doc1" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">Other Document 1</p>
                                    </div>
                                    <div class="document-items hide">
                                        <div class="doc-set">
                                            <img src="#" id="view_other_doc2" alt="document file" class="document-file" />
                                        </div>
                                        <p class="file-name">Other Document 2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </main>


    <!-- jquery -->
    <script src="./js/jquery.min.js"></script>

    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>

    <!-- country-flag -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- date picker -->
    <script src="./js/moment-with-locales.js"></script>
    <script src="./js/bootstrap-datetimepicker.js"></script>
    <!-- <script src="./js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- sweetalert(swal) -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        // -----Country Code Selection
        $("#mobile_no,#alt-mobile_no").intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            initialCountry: "in",
            // separateDialCode: true,
        });

        var mob_id = ["#mobile_no","#alt-mobile_no"];
        
        mob_id.forEach(function (value, i) {
            var iti = '';
            var mask = "";
            var phoneInputID = value;
            var input = document.querySelector(phoneInputID);
            iti = window.intlTelInput(input, {
                separateDialCode: false,
                initialCountry: "in",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });
            
            $(phoneInputID).on("countrychange", function(event) {
                var selectedCountryData = iti.getSelectedCountryData();
                newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                newPlaceholder = newPlaceholder.replace(/[()]/g, '');
                newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
                iti.setNumber("");
                
                $(this).val('');
                $(this).attr('placeholder',newPlaceholder);
                newPlaceholder = newPlaceholder.replace(/^0+/, '');
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
        $(function() {
            $("#dob_value").datetimepicker({
                ignoreReadonly: true,
                format: "DD-MM-YYYY",
            });
        });
    </script>
    <script>
        $(document).ready(() => {
            //var bookingChannel = '';
            $("#my-agents").addClass("actives");
        });
    </script>
    <!-- slide-box -->
    <script>
        $(document).ready(function() {
            $("#commission-type-box").hide();
            $("#commission").click(function() {
                $("#commission-type-box").show();
                $("#Incentives-type-box").hide();
            });
            $("#incentives").click(function() {
                $("#commission-type-box").hide();
                $("#Incentives-type-box").show();
            });
            
            let datas = {
                            "distributorToken": localStorage.getItem("distributorToken")
                        };
                let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/setBookingChannel.php",
                    data: json1
                    }).done(function(data1) {
                       var bookingChannel = `<div class="checkbox">
                            <div class="channel-radio">`;
                        if(data1.data == '0'){
                            bookingChannel += `<div class="" id="">
                                <input class="is_credit" type="radio" id="online" name="booking-channel" value="0" checked="">
                                <label for="online">online</label>
                            </div>`;
                         } else if(data1.data == '1'){
                            bookingChannel += `<div class="" id="">
                                <input class="is_credit" type="radio" id="credit" name="booking-channel" value="1" checked="">
                                <label for="credit">credit</label>
                            </div>`;
                        } 
                        bookingChannel += `</div>
                        </div>`;
                        $("#beforeBookingChannel").after(bookingChannel);
                    });
        });
        </script>
    <script>
        //......Add_slot........
        let i = $('.Set_service-title').length + 1;
        $('body').on('click', '.add_slot_text', function() {
            let box = `<div class="Set_service-title" id="slot_${i}">
            <div class="title_fooder_box information_text">
                                <div class="input_conts">
                                    <p>Booking Amount from</p>
                                    <input type="number" name="" class="percemt-text bookfrom"placeholder="0">
                                </div>
                            </div>
                            <div class="title_fooder_box information_text">
                                <div class="input_conts">
                                    <p>Booking Amount to</p>
                                    <input type="number" name="" class="percemt-text bookto"placeholder="1001">
                                </div>
                            </div>
                            <div class="title_fooder_box">
                                <div class="pasint">
                                    <h2>%</h2>
                                </div>
                                <div class="input_percent">
                                    <p>Incentive percentage</p>
                                    <input type="number" name="" class="percemt-text incent" placeholder="0.5">
                                </div>
                            </div>
                                    

                                    <div class="close_box">
                                        <p>X</p>
                                    </div>
                                </div>`

            $('#Incentives-type-box').append(box);
            i++;
        });
        $('body').on('click', '.close_box', function() {
            let slotId = $(this).parent().attr('id');
            $(`#${slotId}`).remove();
            //i = $(this).parent().attr('id').replace(/[^0-9]/g, '');

        })
    </script>
    <!-- flag -->
    <!-- <script>
        $(".primary-mob").intlTelInput({
            initialCountry: "in",
            separateDialCode: false,
             utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
        });
        $("#mobile_code2").intlTelInput({
            initialCountry: "in",
            separateDialCode: false,
        });
    </script> -->
    <script>
        let apiPath = "<?php echo $apiPath; ?>";
        //let userToken = localStorage.getItem("userToken");
        function isValidPhone(id){
            let result = $(`#${id}`).intlTelInput("isValidNumber");
            return result;
        }

        function checknumber(sel){

            let numbers = /^[-+]?[0-9]+$/;

            sel.value = sel.value.match(numbers);
            //replace(/[^0-9]/g, '');


        }

        $(".agent-details").click(function() {
            $(".all-set-hide").show();
            $(".bank_detail_fullbox").hide();
            $(".main-pan-card-detial").hide();
            $('.details_list li').removeClass('active');
            $('.details_list li.agent-details').addClass('active') ;


        });

        $(".bank_detail").click(function() {
            $(".bank_detail_fullbox").show();
            $(".all-set-hide").hide();
            $(".main-pan-card-detial").hide();
            $('.details_list li').removeClass('active');
            $('.details_list li.bank_detail').addClass('active') ;


        });

        $(".document").click(function() {
            $(".all-set-hide").hide();
            $(".bank_detail_fullbox").hide();
            $(".main-pan-card-detial").show();
            $('.details_list li').removeClass('active');
            $('.details_list li.document').addClass('active') ;
        });

        // add text show and yearly target reset on radio change
        let commissionDetails = '<h1>Incentives</h1><br>';
        $('.main-radio input[type="radio"]').on('change',function(){
            if($(this).val() == 1){
                $('.add_slot_text').hide();
                commissionDetails = `<h1>Commission</h1><br>`;
            }else{
                $('.add_slot_text').show();
                $('.yearlytarget').val('');
                
                commissionDetails = `<h1>Incentives</h1><br>`;
            };
        })

        $(document).ready(function() {
        // var datas = { 'securedairportzo': "secured" };
        // var jsondata = JSON.stringify(datas);
        let apiPath = "<?php echo $apiPath; ?>";
        //let userToken = localStorage.getItem("userToken");
        // if(userToken == "" || userToken == undefined ){
        //         window.location = 'login.php'
        //     } else{

            

            $.ajax({
                type: "GET",
                dataType: "json",
                url: `${apiPath}/distributor/onboardDetails.php`,
                success: location_details,
            });
            getagenttype();


        // }
        
    });
        function location_details(location){
            let countrylist = `<option value="0">Select Country</option>`;
            location.countries.forEach((country,index) => {
                countrylist += `<option value="${country.countryId}">${country.countryName}</option>`;
            });
            // $('.business_type').html(businesstype);
            $('.country').html(countrylist)
        }

        function getagenttype(){
            let datas = {
                            "userToken": userToken
                        };
                let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/distributor/agentTypeList.php",
                data: json1
                }).done(function(data1) {
                    let agenttypearray = data1.data;
                    let agenttypelist = `<option value="0">Select Type</option>`;
                    agenttypearray.forEach((list,index) => {
                        agenttypelist += `<option value="${list.token}">${list.type}</option>`;       
                    });
                    $('.business_type').html(agenttypelist);
                });
        }

    $('.country').on('change', function(e){
        let countryId = $(this).val();
        //selectedCountryId = `${countryId}`;
        let data = {
                        "countryId":countryId
                   }
        let json_data = JSON.stringify(data);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: `${apiPath}/distributor/statesOfCountry.php`,
            data:json_data,
            success: function(res){
                let statename = `<option data-country="" value="0">Select State</option>`;
                $.each(res.states, function(i, value) {
                 statename += `<option data-country="${value.countryId}" value="${value.stateId}">${value.stateName}</option>`;
                });
                $('.state').html(statename);
            },
        });
    });

    $('.state').on('change',function(e){
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
            url: `${apiPath}/distributor//citiesOfState.php`,
            data:json_data,
            success: function(res){
                let cityname = `<option data-state="" data-country="" value="0">Select City</option>`;
                
                $.each(res.cities, function(i, value) {
                    cityname += `<option data-state="${value.stateId}" data-country="${value.countryId}" value="${value.cityId}">${value.cityName}</option>`;
                });
                $('.city').html(cityname);
            },
        });

    })

    // For S3 bucket
    var image_id = [];
    function image_upload_loop(key){
        var checkkey = key+1;
        if(checkkey>image_id.length){
            on_submit_create();
        }else{
            var fileUpload = document.getElementById(image_id[key]);
            var file = fileUpload.files[0];
            s3_file_upload(file, key);
        }
    }   
    
    $('body').on('change','#mobile_no',function(){
        let mobileNumber = $('#mobile_no').val().trim();
        mobileNumber = mobileNumber.replace(' ','');
        if(mobileNumber != ''){
            let data = {
                            "userToken":userToken,
                            "mobileNumber":mobileNumber,
                            "distributorToken": localStorage.getItem("distributorToken")
                    }
            let jsonData = JSON.stringify(data);
            $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url:`${apiPath}/distributor/ExistNumberCheckAgent.php`,
                    data: jsonData
                    }).done(function(data1){
                        if(data1.status_code == 503){
                            swal({
                                    title:"Warning",
                                    text:data1.message,
                                    icon:"warning",

                                }).then(()=>{
                                    $('#mobile_no').val('');
                                })
                        }
                    });
        }
    });
     
    function s3_file_upload(file, key){
        var seconds = new Date().getTime();
        seconds = parseInt(seconds);
        var extension = file.name.split('.').pop().toLowerCase();
        var filename = seconds+key+'.'+extension;
        let folderPath = '';
        if(image_id[key] == 'profile_pic'){
            folderPath = 'agent_profile/';

        }else{
            folderPath = 'agent_documents/';
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
                $('.createagent').prop('disabled',false);
            }else{
                var image_fileurl = aws_cloudfront_url+folder+filename;
                $("#valid_"+image_id[key]).val(image_fileurl);
                key++;
                image_upload_loop(key);
            }
        });
    } 

        let gotAgentDetails = false;
        let gotBankDetails = false;
        let gotDocDetails = false;
        function agent_detail() {
            var title = $('.salutation').val();
            var agent_name = document.getElementById('agent_name').value;
            var business_website = document.getElementById('business_website').value;
            var dob_value = document.getElementById('dob_value').value;
            [day,month,year] = dob_value.split('-');
            var formatted_dob = [year,month,day].join('-');
            var profile_pic = $('#profile_pic').val();
            var mobile = $('#mobile_no').val();
            var email = $('.primary-email').val();
            var alt_mobile = $('#alt-mobile_no').val();
            var alt_email = $('.alter-email').val();
            var address = $('.address').val();
            var country = $('.country').val();
            let country_name = $('.country option:selected').text();
            var state = $('.state').val();
            let state_name = $('.state option:selected').text();
            var city = $('.city').val();
            let city_name = $('.city option:selected').text();
            var pincode = $('.pincode').val()
            let radiovalue = $('.main-radio input[type="radio"]:checked').val();
            let business_type = $('.business_type').val();
            let business_type_name = $('.business_type option:selected').text()
            let yearlytarget = $('.yearlytarget').val();
            let commission_percent = $('.commpercent').val();
            let incentiveArray =[];
            let incentiveSelector = $('#Incentives-type-box .Set_service-title');
            let validdata = 0;
            let isEmpty = false;

            if(agent_name != ""){
                $('.nameerror').hide()
                validdata++;
            } else{
                $('.nameerror').show()
            }
            if(business_website != ""){
                $('.websiteerror').hide();
                validdata++;
            } else{
                $('.websiteerror').show()
            }
            if(dob_value != ""){
                $('.doberror').hide()
                validdata++;
            } else{
                $('.doberror').show()
            }
            if(address != ""){
                $('.addresserror').hide()
                validdata++;
            } else{
                $('.addresserror').show()
            }
            if(business_type != 0){
                $('.bus_type_error').hide();
                validdata++;
            } else{
                $('.bus_type_error').show()
            }
            if(country != 0){
                $('.countryerror').hide();
                validdata++;
            } else{
                $('.countryerror').show()
            }
            if(state != 0){
                $('.stateerror').hide();
                validdata++;
            } else{
                $('.stateerror').show()
            }
            if(city != 0){
                $('.cityerror').hide();
                validdata++;
            } else{
                $('.cityerror').show()
            }
            if(pincode != ""){
                $('.pinerror').hide();
                validdata++;
            } else{
                $('.pinerror').show()
            }
            if(mobile != "" && isValidPhone("mobile_no")){
                $('.moberror').hide();
                validdata++;
            } else{
                $('.moberror').show(); 
            }
            if(email != "" && isEmail(email)){
                $('.emailerror').hide();
                validdata++;
            } else{
                $('.emailerror').show();   
            }
            if(radiovalue == 1){
                if(yearlytarget != ""){
                    $('.commerror').hide()
                    validdata++;
                }else{
                    $('.commerror').show()
                }
            }else if(radiovalue == 2){
                $('#Incentives-type-box .Set_service-title input').each((index,item)=>{
                    if(item.value == ''){
                        isEmpty = true;
                    }
                });
                if(isEmpty == false){
                    $('.commerror').hide();
                    incentiveSelector.each((index,item)=>{
                        let bookfrom = $(item).find('.bookfrom').val();
                        let bookto = $(item).find('.bookto').val();
                        let incentPercent = $(item).find('.incent').val();
                        incentiveArray.push({
                            bookingRangeFrom: bookfrom,
                            bookingRangeTo: bookto,
                            incentivePercentage: incentPercent
                        });
                    })
                    validdata++;
                }else{
                    $('.commerror').show()
                }
            }
            if(validdata == 12){
                if(profile_pic != ''){
                    $('.reviewname').text(`${title}. ${agent_name}`);
                    $('.reviewdob').text(dob_value);
                    $('.reviewbusitype').text(business_type_name);
                    $('.reviewweb').text(business_website);
                    $('.reviewmob').text(mobile);
                    $('.reviewemail').text(email);
                    $('.reviewaltmob').text(alt_mobile);
                    $('.reviewaltemail').text(alt_email);
                    $('.reviewaddress').text(address);
                    $('.reviewcountry').text(country_name);
                    $('.reviewstate').text(state_name);
                    $('.reviewcity').text(city_name);
                    $('.reviewpin').text(pincode);
                    if(radiovalue == 1){
                        commissionDetails += `<p> 1) YearlyTarget: ${yearlytarget} - ${commission_percent}% </br></p>`
                    }else if(radiovalue == 2){
                        
                        incentiveArray.forEach((Incentive,index) => {
                            let no = index + 1;
                            commissionDetails += `<p>${no}) ${Incentive.bookingRangeFrom} to ${Incentive.bookingRangeTo} bookings- ${Incentive.incentivePercentage}%</br></p>`;      
                        });
                    }
                    $('.incentives').html(commissionDetails);
                    gotAgentDetails = true;
                    $(".agent-details").addClass("completed");
                    $(".bank_detail").click();
                }else{
                    swal('Please Upload a Profile Pic');
                }       
            }
        }

        function bankinfo(){
            let accountno = $('.accountno').val() ;
            let confirmno = $('.reaccountno').val() ;
            let ifsc_code = $('#ifsc_code').val();
            let branch = $('#bank_branch').val();
            let city =   $('#bank_city').val();
            let bankval = 0;
            if(accountno == "" || accountno != confirmno ){
                $('.accountreenter').addClass('reject');
                $('.accnoerror').show();
            }else{
                $('.accountreenter').removeClass('reject');
                $('.accnoerror').hide();
                bankval++;
            }
            if(ifsc_code != ""){
                $('.ifscerror').hide();
                bankval++
            }else{
                $('.ifscerror').show();
            }
            if(branch != ""){
                $('.brancherror').hide();
                bankval++
            }else{
                $('.brancherror').show();
            }
            if(gotAgentDetails == true){
                if(bankval == 3){
                    $('.reviewaccount').text(accountno);
                    $('.reviewifsc').text(ifsc_code);
                    $('.reviewbranch').text(branch);
                    $('.reviewbankcity').text(city);
                    gotBankDetails = true;
                    $(".bank_detail").addClass('completed');
                    $('.document').click();
                }
            } else{
                swal("Please Ensure that you have completed previous section(s)");
            }
        }

        function imagevalidate(id){
            var fuData = document.getElementById(id).files[0].name;
            var FileUploadPath = fuData.value;
            var FileUploadPath1 = fuData.split('.').pop().toLowerCase();
            //To check if user upload any file
            if (fuData == '') {
                swal("Please upload an image");
            } else {
                //The file uploaded is an image
                if (FileUploadPath1 == "png" || FileUploadPath1 == "jpeg" || FileUploadPath1 == "jpg") {
                    // To Display
                    //alert(fuData);
                    if(id == 'profile_pic'){
                        const [file_profile_pic] = profile_pic.files
                        if (file_profile_pic) {
                            display_profile_pic.src = URL.createObjectURL(file_profile_pic);
                            view_profile_pic.src =  URL.createObjectURL(file_profile_pic);
                            image_id.push("profile_pic");
                        }      
                    }
                    field_validation();  
                }
                //The file upload is NOT an image
                else {
                    swal("Only file types of  PNG, JPG, and JPEG are allowed. ");
                }
            }
        }

        function filevalidate(id){

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
                    if(id == 'pan_card' && $("#pan_card").val() != ''){
                        const [file_pan_card] = pan_card.files
                        if (file_pan_card) {
                            view_pancard.src = URL.createObjectURL(file_pan_card)
                            $('#view_pancard').parents(".document-items").removeClass('hide');
                            image_id.push("pan_card");
                        }   
                    }
                    if(id == 'gst_certificate' && $("#gst_certificate").val() != ''){
                        const [file_gst_certificate] = gst_certificate.files
                        if (file_gst_certificate) {
                            view_gst.src = URL.createObjectURL(file_gst_certificate);
                            $('#view_gst').parents(".document-items").removeClass('hide');
                            image_id.push("gst_certificate");
                        }   
                    }
                    // file1 - msme
                    // file2 - incorporationImage
                    if(id == 'file1' && $("#file1").val() != ''){
                        const [file_msme] = file1.files
                        if (file_msme) {
                            view_msme.src = URL.createObjectURL(file_msme);
                            $('#view_msme').parents(".document-items").removeClass('hide');
                            image_id.push("file1");
                        }   
                    }
                    if(id == 'file2' && $("#file2").val() != ''){
                        const [file_incorporation] = file2.files
                        if (file_incorporation) {
                            view_incorporation.src = URL.createObjectURL(file_incorporation);
                            $('#view_incorporation').parents(".document-items").removeClass('hide');
                            image_id.push("file2");
                        }   
                    }
                    if(id == 'void_cheque' && $("#void_cheque").val() != ''){
                        const [file_void_cheque] = void_cheque.files
                        if (file_void_cheque) {
                            view_void_cheque.src = URL.createObjectURL(file_void_cheque);
                            $('#view_void_cheque').parents(".document-items").removeClass('hide');
                            image_id.push("void_cheque");
                        }   
                    }
                    if(id == 'ca_card' && $("#ca_card").val() != ''){
                        const [file_ca_card] = ca_card.files
                        if (file_ca_card) {
                            view_ca_card.src = URL.createObjectURL(file_ca_card);
                            $('#view_ca_card').parents(".document-items").removeClass('hide');
                            image_id.push("ca_card");
                        }   
                    }
                    if(id == 'other_doc1' && $("#other_doc1").val() != ''){
                        const [file_ca_card] = other_doc1.files
                        if (file_ca_card) {
                            view_other_doc1.src = URL.createObjectURL(file_ca_card);
                            $('#view_other_doc1').parents(".document-items").removeClass('hide');
                            image_id.push("other_doc1");
                        }   
                    }
                    if(id == 'other_doc2' && $("#other_doc2").val() != ''){
                        const [file_ca_card] = other_doc2.files
                        if (file_ca_card) {
                            view_other_doc2.src = URL.createObjectURL(file_ca_card);
                            $('#view_other_doc2').parents(".document-items").removeClass('hide');
                            image_id.push("other_doc2");
                        }   
                    }
                    field_validation();  
                }
                //The file upload is NOT an image
                else {
                    swal("Only file types of GIF, PNG, JPG, JPEG and PDF are allowed. ");
                }
            }
        }

        function field_validation(){
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
                    var void_cheque =  document.getElementById('void_cheque').value;
                    var void_chequeImage1 =  document.getElementById('before_void_cheque');
                    var void_chequeImage =  document.getElementById('after_void_cheque');
                    var ca_card =  document.getElementById('ca_card').value;
                    var ca_cardImage1 = document.getElementById('before_ca_card');
                    var ca_cardImage = document.getElementById('after_ca_card');
                    var other_doc1 =  document.getElementById('other_doc1').value;
                    var other_doc1Image1 = document.getElementById('before_other_doc1');
                    var other_doc1Image = document.getElementById('after_other_doc1');
                    var other_doc2 =  document.getElementById('other_doc2').value;
                    var other_doc2Image1 = document.getElementById('before_other_doc2');
                    var other_doc2Image = document.getElementById('after_other_doc2');
                    
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
                    if (other_doc1 != '') {
                        other_doc1Image.style.display = 'flex'; 
                        other_doc1Image1.style.display = 'none';
                    }else{
                        other_doc1Image.style.display = 'none'; 
                        other_doc1Image1.style.display = 'flex';
                    }
                    if (other_doc2 != '') {
                        other_doc2Image.style.display = 'flex'; 
                        other_doc2Image1.style.display = 'none';
                    }else{
                        other_doc2Image.style.display = 'none'; 
                        other_doc2Image1.style.display = 'flex';
                    }
                }

        function clearImageData(id){
                    
                    if(id == 'pan_card'){  
                        document.getElementById('before_pan_card').value = '';
                        document.getElementById('pan_card').value = '';
                        document.getElementById('after_pan_card').value = '';
                        document.getElementById('panImage').value = '';
                        document.getElementById('view_pancard').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_pancard').parents(".document-items").addClass('hide');
                    }

                    if(id == 'gst_card'){     
                        document.getElementById('before_gst_card').value = '';
                        document.getElementById('gst_certificate').value = '';
                        document.getElementById('after_gst_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_gst').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_gst').parents(".document-items").addClass('hide');
                    }

                    if(id == 'msme_card'){
                        document.getElementById('before_msme_card').value = '';
                        document.getElementById('file1').value = '';
                        document.getElementById('after_msme_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_msme').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_msme').parents(".document-items").addClass('hide');
                    }

                    if(id == 'incorporation_card'){ 
                        document.getElementById('before_incorporation_card').value = '';
                        document.getElementById('file2').value = '';
                        document.getElementById('after_incorporation_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_incorporation').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_incorporation').parents(".document-items").addClass('hide');
                    }

                    if(id == 'void_cheque'){
                        document.getElementById('before_void_cheque').value = '';
                        document.getElementById('void_cheque').value = '';
                        document.getElementById('after_void_cheque').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_void_cheque').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_void_cheque').parents(".document-items").addClass('hide');
                    }

                    if(id == 'ca_card'){   
                        document.getElementById('before_ca_card').value = '';
                        document.getElementById('ca_card').value = '';
                        document.getElementById('after_ca_card').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_ca_card').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_ca_card').parents(".document-items").addClass('hide');
                    }

                    if(id == 'other_doc1'){
                        document.getElementById('before_other_doc1').value = '';
                        document.getElementById('other_doc1').value = '';
                        document.getElementById('after_other_doc1').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_other_doc1').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_other_doc1').parents(".document-items").addClass('hide');
                    }

                    if(id == 'other_doc2'){
                        document.getElementById('before_other_doc2').value = '';
                        document.getElementById('other_doc2').value = '';
                        document.getElementById('after_other_doc2').value = '';
                        // document.getElementById('panImage').value = '';
                        document.getElementById('view_other_doc2').src = "blob:https://airportzo.net.in/d25223d2-d7c8-48d7-b6cd-8bd4f4500c79";
                        $('#view_other_doc2').parents(".document-items").addClass('hide');
                    }
                    field_validation();
                }

        function documents_info(){
            var pan_card = document.getElementById('pan_card').value;
            var gst_certificate = document.getElementById('gst_certificate').value;
            var file1 = document.getElementById('file1').value;
            var file2 = document.getElementById('file2').value;
            var void_cheque = document.getElementById('void_cheque').value;
            var ca_card = document.getElementById('ca_card').value;
            var other_doc1 = document.getElementById('other_doc1').value;
            var other_doc2 = document.getElementById('other_doc2').value;
            if(gotAgentDetails == true && gotBankDetails == true){
                //if(pan_card != '' && gst_certificate!= '' && file1!= '' && file2 != '' && void_cheque != '' && ca_card != '' ){
                    if($('.agreey-infor input[type="checkbox"]').is(":checked")){
                        gotDocDetails = true;
                        $(".paragaras-bar").hide();
                        $(".review-set-hold").show();    
                    } else{
                        swal('Click to agree')
                    }
                // }else{
                //     swal("Upload All Documents");
                // }
            }else{
                swal("Please Ensure that you have completed previous section(s)");
            }
        }

        $('body').on('click','.createagent',function(){ 
            $('.createagent').prop('disabled',true);
            if(gotAgentDetails == true && gotBankDetails == true && gotDocDetails ==true ){
                image_upload_loop(0);
            }else {
                swal("Ensure you completed all sections");
                $('.createagent').prop('disabled',false);
            }
        });

        function on_submit_create(){
            if(gotAgentDetails == true && gotBankDetails == true && gotDocDetails ==true ){
                //Agent Details
                let title = $('.salutation').val();
                let agentName = $('#agent_name').val();
                let dob = $('.reviewdob').text();
                [day,month,year] = dob.split('-');
                let formatted_dob = [year,month,day].join('-');
                let profileImage = $('#valid_profile_pic').val();
                let businessTypeId = $('.business_type').val();
                let websiteName = $('.reviewweb').text();
                let primaryCountryCode = $("#mobile_no").siblings(".iti__flag-container").find(".iti__selected-flag").attr("title");
                primaryCountryCode = '+'+primaryCountryCode.replace(/[^0-9]/g,'');
                let primaryNumber = $('.reviewmob').text();
                primaryNumber = primaryNumber.replace(" ","");
                let primaryEmail = $('.reviewemail').text();
                let alternateNumber = $('.reviewaltmob').text();
                alternateNumber = alternateNumber.replace(" ","");
                let alternateEmail = $('.reviewaltemail').text();
                let address = $('.reviewaddress').text();
                let countryId = $('.country').val();
                let stateId = $('.state').val();
                let cityId = $('.city').val();
                let pincode = $('.reviewpin').text();
                let commissionType = $('.main-radio input[type="radio"]:checked').val();
                let commissionRatePerBooking = $('.commpercent').val();
                let yearlyTarget = $('.yearlytarget').val();
                let incentiveArray =[];
                let incentiveSelector = $('#Incentives-type-box .Set_service-title');
                let isCredit = $('.is_credit:checked').val();
                if(commissionType == 2){
                    incentiveSelector.each((index,item)=>{
                        let bookfrom = $(item).find('.bookfrom').val();
                        let bookto = $(item).find('.bookto').val();
                        let incentPercent = $(item).find('.incent').val();
                        incentiveArray.push({
                            bookingRangeFrom: bookfrom,
                            bookingRangeTo: bookto,
                            incentivePercentage: incentPercent
                        });
                    })
                }
                //Bank details
                let accountNumber = $('.reviewaccount').text();
                let ifscCode = $('.reviewifsc').text();
                let branch = $('.reviewbranch').text();
                let bankCity = $('.reviewbankcity').text();

                //Document Details
                let panCard = $('#valid_pan_card').val();
                let gstCertificate = $('#valid_gst_certificate').val();
                let msmeCertificate = $('#valid_file1').val();
                let incorporationCertificate = $('#valid_file2').val();
                let voidCheque = $('#valid_void_cheque').val();
                let contractAgreement = $('#valid_ca_card').val();
                let other_doc1 = $('#valid_other_doc1').val();
                let other_doc2 = $('#valid_other_doc2').val();

                let data = {
                    "title": title,
                    "userToken": userToken,
                    "agentName": agentName,
                    "profileImage": profileImage,
                    "dateOfBirth": formatted_dob,
                    "businessTypeId": businessTypeId,
                    "websiteName": websiteName,
                    "primaryCountryCode": primaryCountryCode,
                    "primaryNumber": primaryNumber,
                    "primaryEmail": primaryEmail,
                    "alternateNumber": alternateNumber,
                    "alternateEmail": alternateEmail,
                    "address": address,
                    "countryId": countryId,
                    "stateId": stateId,
                    "cityId": cityId,
                    "pincode": pincode,
                    "commissionType": commissionType,
                    "commissionRatePerBooking": commissionRatePerBooking,
                    "yearlyTarget": yearlyTarget,
                    "incentiveArray": incentiveArray,
                    "accountNumber": accountNumber,
                    "ifscCode": ifscCode,
                    "branch": branch,
                    "bankCity": bankCity,
                    "panCard": panCard,
                    "gstCertificate": gstCertificate,
                    "msmeCertificate": msmeCertificate,
                    "incorporationCertificate": incorporationCertificate,
                    "voidCheque": voidCheque,
                    "contractAgreement": contractAgreement,
                    "other_doc1": other_doc1,
                    "other_doc2": other_doc2,
                    "isCredit":isCredit
                }
                let jsonData = JSON.stringify(data);
                $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url:`${apiPath}/distributor/createAgent.php`,
                        data: jsonData
                    }).done(function(data1){
                                    if(data1.status_code == 201){
                                        swal({
                                                title:"SUCCESS",
                                                text:"Agent Created Successfully",
                                                icon:"success"
                                            }).then(()=>{
                                                window.location = "my-agents.php";
                                            })
                                    }else{
                                        $('.createagent').prop('disabled',false);
                                        swal({
                                                title:data1.title,
                                                text:data1.message,
                                                icon:"warning"
                                            });
                                    }
                                });
                }else {
                    swal("Ensure you completed all sections");
                }
        }

        
        function isEmail(email) {
                let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return mailFormat.test(email);
        }

        function ifsc_function() {
            var ifsc_code = document.getElementById("ifsc_code").value;
            ifsc_code = ifsc_code.toUpperCase();
            document.getElementById("ifsc_code").value = ifsc_code;
            var length = ifsc_code.length;
            if (length == 11) {
                $.getJSON('https://ifsc.razorpay.com/' + ifsc_code, function(data) {
                    $('#bank_branch').val(data.BRANCH);
                    $('#bank_city').val(data.CITY);
                });
            } else {
                $('#bank_branch').val('');
                $('#bank_city').val('');
            }
        }
        
        $("ul.tabs-agent li").click(function() {
            var tab_id = $(this).attr("data-tab");
            $("ul.tabs-agent li").removeClass("current-active");
            $(".tab-content").removeClass("current-active");
            $(this).addClass("current-active");
            $("#" + tab_id).addClass("current-active");
        });
</script>
</body>
</html>