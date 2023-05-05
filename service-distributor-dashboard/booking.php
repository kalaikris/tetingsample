<?php
include_once '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>booking</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- datepicker style -->
    <link rel="stylesheet" href="./css/bootstrap.min.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/bootstrap-icons.css">
    <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>

    <!-- data table link -->
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <!--  data table CSS only -->
    <link rel="stylesheet" href="./js/data-table-css/bootstrap.css">
    <!-- custm css -->
    <link rel="stylesheet" href="./css/fonts.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="./css/header-sidemenu.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/booklist.css<?php echo $js_cache_string; ?>" />
    <link rel="stylesheet" href="./css/custom.css<?php echo $js_cache_string; ?>">
    <!-- fonts famaly -->
    
</head>
<style>
    .upcoming{
        cursor: pointer;
    }    
    .slider-desc-set .current .dt-buttons{
        float: right;
    }
    .slider-desc-set .current .dt-buttons .dt-button{
        padding: 1em 1.5em;
        border-radius: 5px;
        background-color:#4fc8e0;
        background-image: unset;
        border:1px solid #4fc8e0;
        color: #fff;
    }
    #arrive_date{
        height: unset;
        border:none;
        justify-content: flex-end;
    }
    .dt-buttons{
        display: none;
    }
    .text-time
    {
      display: block;
      color: #969696;
    }
    
        .detail-set{
        width: 100%;
        overflow-x: auto;
        background: #f9fafc;
        font-family: var(--font-regular);
        padding: 0px 30px;
        margin-right: auto;
        margin-left: auto;
        }
        .flex_detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        }
        .inlinetext{
        display: flex;
        align-items: center;
        }

        .inlinetext p{
        padding-right: 40px;
        color: #333;
        }
        .title_text{
        margin-bottom: 20px;
        }
        .bottom_text{
        background: #fff;
        padding: 24px 32px;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        margin-bottom: 20px;
        }
        .campaign_top_section {
        display: flex;
        width: 100%;
        padding: 0 30px;
        }
        .campaign_top_content_section {
        width: 100%;
        align-self: flex-end;
        }
        .details-top-section {
        /* margin-top: 30px; */
        display: flex;
        width: 100%;
        margin-bottom: 24px;
        }
        .details-top-section1 {
        margin-top: 30px;
        display: flex;
        width: 100%;
        padding-bottom: 26px;
        }
        .details-top-div {
        display: block;
        width: 100%; 
        font-family: var(--medium-font);
        /* margin: 20px 0; */
        margin-right: 10px;
        }
        .Business-cnt-text h1{
        color: #000;
        font-size: 16px;
        font-family: 'Rubik-Medium';
        margin-bottom: 12px;
        }
        .top_p_color {
        color: #8f8f8f;
        font-size: 14px;
        margin-bottom: 3px;
        }
        .details-top-div h5{
        font-size: 16px;
        color: #333;
        }
        .document-view{
        position: relative;
        }
        .dock-set{
        width: 200px;
        height: auto;
        }
        .document-file{
        object-fit: contain;
        object-position: left;
        width: 100%;
        height: 200px;
        }
        .price_tag{
        border: 1px solid #e5e5e5;
        padding: 16px 20px;
        max-width: 330px;
        display: block;
        margin-left: auto;
        border-radius: 12px;
        }
        .price_tag h4{
        font-size: 16px;
        font-family: 'Rubik-Medium';
        }
        .split_price{
        display: flex;
        justify-content: space-between;
        align-items: center;
        } 
        .total_price{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #e5e5e5;
        }
        .total_price h4:nth-child(2){
            font-size: 22px;
        }
        .tab_section{
        margin: 20px auto;
        position: relative;
        border-bottom: 1px solid #ccc;
        }
        .viewpage{
        display: block !important;
        background: #fff !important;
        }
        .nav-tabs {
        border-bottom: 2px solid #ccc;
        }
        .nav-tabs .nav-item {
        margin-bottom: 0;
        border: none !important;
        }
        .nav-link{
        color: #8E8F91;
        width: 150px;
        text-align: center;
        } 
        .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
        border: none;
        text-decoration: none;
        outline: none;
        }
        .nav-tabs .nav-link {
        border: none;
        }
        .nav-tabs .nav-link.active, 
        .nav-tabs .nav-item.show .nav-link {
        color: #000;
        border: none;
        border-bottom: 2px solid #03a9f4;
        }
        .head_airport > .detail_airport .airport_company { 
         max-height: 82px;
         max-width: 150px;
        }
        .detail_airport{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        width: 100%;
        }
        .set_airport{
        display: block;
        }
        .set_airport h4 {
        font-size: 22px;
        font-family: 'Rubik-Medium';
        }
        .detailsstatus span{
        margin-left: auto;
        margin-bottom: 5px;
        }
        .detailsstatus p{
        text-align: right;
        }
        .flexline{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px auto;
        width: 100%;
        }
        .airport_start {
        width: 40px;
        height: 40px;
        object-fit: contain;
        }
        .service_details{
        width: 70%;
        position: relative;
        margin: 0;
        }
    #booking_detail{
        display: none;
    }
    .back_btn img {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }
    </style>
<body id="page">
    <div id="loading"></div>
    <!-- page loader -->
 
    <header id="header">
    </header>
    <main>
       <div class="flex-main-set">

            <div class="slider-set" id="sidebar"> </div>
            <div class="slider-desc-set"  id="booking_view">

                <ul class="tabs">
                    <li class="tab-link websitetab current" data-tab="tab-1">Website
                        Bookings</li>
                    <li class="tab-link agenttab" data-tab="tab-2">Agent Bookings</li>
                </ul>
                <div class="underline"></div>

                <div id="tab-1" class="tab-content current">

                    <div class="three-box-set">
                        <div class="box-1">
                            <div class="cont-set">
                                <img src="./asset/img/ongoing.png" alt="" class="inner-img">
                                <h3 class="card-number ongoingcount">4</h3>
                                <p class="card-cont">Ongoing bookings</p>
                            </div>
                        </div>
                        <div class="box-3">
                            <div class="cont-set">
                                <img src="./asset/img/upcoming.png" alt="" class="inner-img">
                                <h3 class="card-number upcomingcount">2</h3>
                                <p class="card-cont">Upcoming bookings</p>
                            </div>
                        </div>
                        <div class="box-2">
                            <div class="cont-set">
                                <img src="./asset/img/acsspt.png" alt="" class="inner-img">
                                <h3 class="card-number completedcount">348</h3>
                                <p class="card-cont">Completed booking</p>
                            </div>
                        </div>
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/img/rejact.png" alt="" class="inner-img">
                                <h3 class="card-number cancelledcount">14</h3>
                                <p class="card-cont">Cancelled booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>

                            <div style="display: flex; gap:10px;">
                            <div class="inner-input-field">
                               <!--  <button type="button" class="btn-pr"> <img src="./asset/img/downlod.png" alt=""> <label for="Download">Download us</label>
                                    <select name="pdf" id="pdf">
                                        <option value="png"></option>
                                        <option value="pdf">pdf</option>
                                        <option value="csv">csv</option>
                                    </select></button> -->
                                        <div class="inner-input-field">
                         <div class="dropdown">
                          <button onclick="myFunction('myDropdown')" class="dropbtn">Download</button>
                          <div id="myDropdown" class="dropdown-content">
                            <a href="#" onclick="drpDownbtnClick('booking','csv')">CSV</a>
                            <a href="#" onclick="drpDownbtnClick('booking','pdf')">PDF</a>
                            <!-- <a href="#contact">Contact</a> -->
                          </div>
                        </div>
                        </div>

                            </div>


<!--
                            <div class='arriving-input-set input-group' id='arrive_date'>

                                 <span class="input-group-addon bg-date">
                                </span> 

                                <div class="date-con">
                                    <input type='text'  id="arrive_date_input1" placeholder="DD-MMM-YYYY"  />
                                    <label for="arrive_date_input1" class="input-group-addon bg-date">From Date</label>
                                </div>
                                
                            </div>
-->
                                <div class="inner-input-field">
                                  <div class="arriving-input-set input-group">
                                     <span class="input-group-addon bg-date"></span>
                                     <div class="date-con">
                                        <label for="from_date">From Date</label>
                                        <input type="text" class="b-input datepicker" id="from_date" placeholder="DD-MM-YYYY" readonly />
                                     </div>
                                  </div>
                               </div>
                               <div class="inner-input-field">
                                  <div class="arriving-input-set input-group">
                                     <span class="input-group-addon bg-date"></span>
                                     <div class="date-con">
                                        <label for="to_date">To Date</label>
                                        <input type="text" class="b-input datepicker" id="to_date" placeholder="DD-MM-YYYY" readonly />
                                     </div>
                                  </div>
                               </div>
                               <button type="button" class="btn btn-success" onclick="date_filter()">Generate</button>
                            </div>
                        </div>
                    </div>
                    <table id="booking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Booked on</th>
                                <th>Customer Name</th>
                                <th>Services Booked</th>
                                <th>Service Partners</th>
                                <th>Payment ID</th>
                                <th>Markup Type</th>
                                <th>Markup Value</th>
                                <th>Membership ID</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_id">
                        </tbody>
                    </table>
                </div>

                <div id="tab-2" class="tab-content">
                    <div class="three-box-set">
                        <div class="box-1">
                            <div class="cont-set">
                                <img src="./asset/img/ongoing.png" alt="" class="inner-img">
                                <h3 class="card-number agentongoingcount">4</h3>
                                <p class="card-cont">Ongoing bookings</p>
                            </div>
                        </div>
                        <div class="box-3">
                            <div class="cont-set">
                                <img src="./asset/img/upcoming.png" alt="" class="inner-img">
                                <h3 class="card-number agentupcomingcount">2</h3>
                                <p class="card-cont">Upcoming bookings</p>
                            </div>
                        </div>
                        <div class="box-2">
                            <div class="cont-set">
                                <img src="./asset/img/acsspt.png" alt="" class="inner-img">
                                <h3 class="card-number agentcompletedcount">348</h3>
                                <p class="card-cont">Completed booking</p>
                            </div>
                        </div>
                        <div class="box-4">
                            <div class="cont-set">
                                <img src="./asset/img/rejact.png" alt="" class="inner-img">
                                <h3 class="card-number agentcancelledcount">14</h3>
                                <p class="card-cont">Cancelled booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="date-con-set">
                        <div class="left-sid-set">
                            <h1 class="booking2-text">Bookings</h1>

                            <div style="display: flex; gap:10px;">
                            <div class="inner-input-field">
                               <!--  <button type="button" class="btn-pr"> <img src="./asset/img/downlod.png" alt=""> <label for="Download">Download us</label>
                                    <select name="pdf" id="pdf">
                                        <option value="png"></option>
                                        <option value="pdf">pdf</option>
                                        <option value="csv">csv</option>
                                    </select></button> -->
                                        <div class="inner-input-field">
                         <div class="dropdown">
                          <button onclick="myFunction('myDropdown2')" class="dropbtn">Download</button>
                          <div id="myDropdown2" class="dropdown-content">
                            <a href="#" onclick="drpDownbtnClick('agentbooking','csv')">CSV</a>
                            <a href="#" onclick="drpDownbtnClick('agentbooking','pdf')">PDF</a>
                            <!-- <a href="#contact">Contact</a> -->
                          </div>
                        </div>
                        </div>

                            </div>


<!--
                            <div class='arriving-input-set' id=''>

                                 <span class="input-group-addon bg-date">
                                </span> 

                                <div class="date-con">
                                    <input type='text'  id="arrive_date_input2" placeholder="DD-MMM-YYYY"  />
                                    <label for="arrive_date_input2" class="input-group-addon bg-date"></label>
                                </div>
                            </div>
-->
                            <div class="inner-input-field">
                              <div class="arriving-input-set input-group">
                                 <span class="input-group-addon bg-date"></span>
                                 <div class="date-con">
                                    <label for="from_date2">From Date</label>
                                    <input type="text" class="b-input datepicker" id="from_date2" placeholder="DD-MM-YYYY" readonly />
                                 </div>
                              </div>
                            </div>
                            <div class="inner-input-field">
                              <div class="arriving-input-set input-group">
                                 <span class="input-group-addon bg-date"></span>
                                 <div class="date-con">
                                    <label for="to_date2">To Date</label>
                                    <input type="text" class="b-input datepicker" id="to_date2" placeholder="DD-MM-YYYY" readonly />
                                 </div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-success" onclick="agent_date_filter()">Generate</button>
                            </div>
                        </div>
                    </div>
                    <table id="agentbooking" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Booked on</th>
                                <th>Agent Name</th>
                                <th>Customer Name</th>
                                <th>Services Booked</th>
                                <th>Service Partners</th>
                                <th>Payment ID</th>
                                <th>Markup Type</th>
                                <th>Markup Value</th>
                                <th>Membership ID</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>

            </div>
               <div class="detail-set" id="booking_detail" >
                   
               <div class="title_text">
                    <h1 class="booking2-text">
                        <span onclick="privouspage()" style="margin-right:12px;">
                            <svg class="back-btn" width="28" height="20" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 8H6.8L11.42 3.38C11.814 2.986 12 2.516 12 2C12 1.016 11.187 0 10 0C9.469 0 9.006 0.193 8.62 0.58L0.662 8.538C0.334 8.866 0 9.271 0 10C0 10.729 0.279 11.08 0.646 11.447L8.62 19.42C9.006 19.807 9.469 20 10 20C11.188 20 12 18.984 12 18C12 17.484 11.814 17.014 11.42 16.62L6.8 12H26C27.104 12 28 11.104 28 10C28 8.896 27.104 8 26 8Z" fill="black"></path></svg>
                        </span>
                        Booking Details 
                        <!-- <a onclick="privouspage()" class="back_btn"><img src="asset/img/flight-line.svg" alt="back"></a> -->
                    </h1>
                   <div class="flex_detail">
                   <div class="inlinetext">
                   <p>Booking ID :<span class="detailsbookingnumber">W8354</span></p>
                   <p>Booked On :<span class="detailsbookingdate">01 Jul 2022, 17:40(GMT+2)</span></p>
                   <!-- <p>Passengers :<span class="detailspassengercount">2 Adults,1 Child</span></p> -->
                   </div>
                   <p class="detailsstatus" hidden><span class="accepted"><img src="./asset/img/acp.png">Completed</span></p>

                   </div>
               </div>
                   
               <div class="bottom_text">
                    <div class="campaign_top_content_section">
                        <div class="Business-cnt-text contactheader">
                          <h1>Passenger details</h1>
                        </div>
                        <div class="contactpassenger">
                            <div class="details-top-section">
                                <div class="details-top-div">
                                    <p class="top_p_color">Contact Passenger Name</p>
                                    <h5>Mr.Jummy Garza</h5>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Contact Number</p>
                                    <h5>+91 7687469245</h5>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Contact Email Address</p>
                                    <h5>jimmy garza34@gmail.com</h5>
                                </div>
                                <div class="details-top-div">
                                    <p class="top_p_color">Age</p>
                                    <h5>45 Years</h5>
                                </div>
                            </div>
                        </div>
                        
                    <div class="Business-cnt-text othersheader">
                        <h1>Other Passenger details</h1>
                    </div>

                    <div class="otherpassenger">
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Passenger Name</p>
                                <h5>Mr.Anne Reynolds</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Contact Number</p>
                                <h5>+91 7687469235</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Contact Email Address</p>
                                <h5>jimmy garza34@gmail.com</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Age</p>
                                <h5>39 Years</h5>
                            </div>
                        </div>
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Passenger Name</p>
                                <h5>Mr.Rhoda Kennedy</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Contact Number</p>
                                <h5>+91 7687469245</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Contact Email Address</p>
                                <h5>jimmy garza34@gmail.com</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Age</p>
                                <h5>12 Years</h5>
                            </div>
                        </div>
                    </div>
                        
                    <div class="Business-cnt-text greeterheader">
                        <h1>Greeter / Family Contact Details</h1>
                    </div>

                    <div class="greeterpassenger">
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Contact Person Name</p>
                                <h5>Mrs.Celia Abbort</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Business Mobile Numer</p>
                                <h5>+91 86837 48834</h5>
                            </div>
                        <div class="details-top-div"></div>
                        <div class="details-top-div"></div>
                        </div>
                    </div> 

                    <div class="Business-cnt-text gstinheader">
                    <h1>GSTIN Details</h1>
                    </div>
                    <div class="details-top-section gstinbody">
                    <div class="details-top-div">
                    <p class="top_p_color">Company Name</p>
                    <h5 class="gstcompname">MacAppStudio</h5>
                    </div>
                    <div class="details-top-div">
                    <p class="top_p_color">GST Number</p>
                    <h5 class="detailsgstnumber">HSDF176986539</h5>
                    </div>
                      <div class="details-top-div"></div>
                      <div class="details-top-div"></div>
                    </div>  
                    
                    <div class="document-view">
                        <div class="Business-cnt-text ticketheader">
                        <h1>E-Ticket</h1>
                        </div>
                        <div class="document-items">
                        <div class="dock-set">
                            <!-- <img class="detailseticket" src="asset/images/document4.png" class="document-file"> -->
                            <iframe class="detailseticket" src="asset/images/document4.png"></iframe>
                        </div>
                        </div>
                    <div class="price_tag">
                    <h4>Price Details</h4>
                        <div class="split_price">
                            <p>Services Cost</p>
                            <p>₹ <span class="detailscost"> 5600</span></p>
                        </div>
                        <div class="split_price">
                            <p>GST</p>
                            <p>₹ <span class="detailsgst"> 480</span></p>
                        </div>
                        <div class="split_price">
                            <p>Convenience Fee</p>
                            <p>₹ <span class="convenienceFee"> 480</span></p>
                        </div>
                        <div class="split_price">
                            <p>Convenience GST</p>
                            <p>₹ <span class="convenienceFeeGst"> 480</span></p>
                        </div>
                        <div class="total_price">
                            <h4>Total</h4>
                            <h4>₹ <span class="detailstotalprice"> 5720</span></h4>
                        </div>
                    </div>
                    </div>
               </div>
                   
            <div class="tab_section">
                <ul class="nav nav-tabs tabheader" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#meetandgreet" role="tab">Meet and Greet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#lounge" role="tab">Lounge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#porter" role="tab">Porter</a>
                    </li>
                </ul><!-- Tab panes -->

            <div class="tab-content viewpage tabcontent">
                <div class="tab-pane active" id="meetandgreet" role="tabpanel">
                    <div class="head_airport">
                        <div class="detail_airport">
                        <img alt="" src="asset/images/product-logo.png" class="airport_company">
                            <div class="set_airport">
                                <h4>Pranaam</h4>
                                <p>Bangalore Airport | Order ID : 87689</p>
                            </div>
                        </div>
                        <div class="flexline">
                            <div class="detail_airport">
                            <img alt="" src="asset/img/landing.png" class="airport_start">
                                <div class="set_airport">
                                    <p>Service at</p>
                                    <h4>Arrival</h4>
                                </div>
                            </div>
                            <div class="detail_airport">
                            <img alt="" src="asset/img/calendar.svg" class="airport_start">
                                <div class="set_airport">
                                    <p>Service avail date</p>
                                    <h4>04 Jul, 2022</h4>
                                </div>
                            </div>
                            <div class="detail_airport">
                            <img alt="" src="asset/img/time.svg" class="airport_start">
                                <div class="set_airport">
                                    <p>Service avail time</p>
                                    <h4>15:00(GMT+2)</h4>
                                </div>
                            </div>
                            <div class="detail_airport">
                            <img alt="" src="asset/img/flight-line.svg" class="airport_start">
                                <div class="set_airport">
                                    <p>Arrival Flight Number </p>
                                    <h4>7687592</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service_details">
                        <div class="Business-cnt-text">
                            <h1>Service Details 1</h1>
                        </div>
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Package</p>
                                <h5>Silver</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Passengers</p>
                                <h5>1Adult</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Cost</p>
                                <h5>₹ 1200</h5>
                            </div>
                            <div class="details-top-div"></div>
                            <div class="details-top-div"></div>
                        </div> 
                        <div class="notes_det">
                            <h4>Notes</h4>
                            <p class="notepara">Hello Zachi welcome to india. we hope you have a great experience and memories during your stay here. with lots of love from team Bullshark.</p>
                        </div>
                    </div>
                </div>

            <div class="tab-pane" id="lounge" role="tabpanel">
                <div class="head_airport">
                    <div class="detail_airport">
                    <img alt="" src="asset/images/product-logo.png" class="airport_company">
                        <div class="set_airport">
                            <h4>Pranaam2</h4>
                            <p>Bangalore Airport | Order ID : 87689</p>
                        </div>
                    </div>
                    <div class="flexline">
                        <div class="detail_airport">
                        <img alt="" src="asset/img/landing.png" class="airport_start">
                            <div class="set_airport">
                                <p>Service at</p>
                                <h4>Arrival</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/calendar.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Service avail date</p>
                                <h4>04 Jul, 2022</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/time.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Service avail time</p>
                                <h4>15:00(GMT+2)</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/flight-line.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Arrival Flight Number </p>
                                <h4>7687592</h4>
                            </div>
                        </div>
                    </div>
                    <div class="service_details">
                        <div class="Business-cnt-text">
                            <h1>Service Details 2</h1>
                        </div>
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Package</p>
                                <h5>Silver</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Passengers</p>
                                <h5>1Adult</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Cost</p>
                                <h5>₹ 1200</h5>
                            </div>
                            <div class="details-top-div"></div>
                            <div class="details-top-div"></div>
                        </div> 
                        <div class="notes_det">
                            <h4>Notes</h4>
                            <p class="notepara">Hello Zachi welcome to india. we hope you have a great experience and memories during your stay here. with lots of love from team Bullshark.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="porter" role="tabpanel">
                <div class="head_airport">
                    <div class="detail_airport">
                        <img alt="" src="asset/images/product-logo.png" class="airport_company">
                        <div class="set_airport">
                            <h4>Pranaam3</h4>
                            <p>Bangalore Airport | Order ID : 87689</p>
                        </div>
                    </div>
                    <div class="flexline">
                        <div class="detail_airport">
                        <img alt="" src="asset/img/landing.png" class="airport_start">
                            <div class="set_airport">
                                <p>Service at</p>
                                <h4>Arrival</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/calendar.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Service avail date</p>
                                <h4>04 Jul, 2022</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/time.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Service avail time</p>
                                <h4>15:00(GMT+2)</h4>
                            </div>
                        </div>
                        <div class="detail_airport">
                        <img alt="" src="asset/img/flight-line.svg" class="airport_start">
                            <div class="set_airport">
                                <p>Arrival Flight Number </p>
                                <h4>7687592</h4>
                            </div>
                        </div>
                    </div>
                    <div class="service_details">
                        <div class="Business-cnt-text">
                            <h1>Service Details 3</h1>
                        </div>
                        <div class="details-top-section">
                            <div class="details-top-div">
                                <p class="top_p_color">Package</p>
                                <h5>Silver</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Passengers</p>
                                <h5>1Adult</h5>
                            </div>
                            <div class="details-top-div">
                                <p class="top_p_color">Cost</p>
                                <h5>₹ 1200</h5>
                            </div>
                            <div class="details-top-div"></div>
                            <div class="details-top-div"></div>
                        </div> 
                        <div class="notes_det">
                            <h4>Notes</h4>
                            <p class="notepara">Hello Zachi welcome to india. we hope you have a great experience and memories during your stay here. with lots of love from team Bullshark.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>  
            </div>         
                   
            <!-- <div class="service_details" >
                <div class="Business-cnt-text">
                    <h1>Service Details</h1>
                </div>
                <div class="details-top-section">
                    <div class="details-top-div">
                    <p class="top_p_color">Package</p>
                    <h5>Silver</h5>
                    </div>
                    <div class="details-top-div">
                    <p class="top_p_color">Passengers</p>
                    <h5>1Adult</h5>
                    </div>
                    <div class="details-top-div">
                    <p class="top_p_color">Cost</p>
                    <h5>₹ 1200</h5>
                    </div>
                      <div class="details-top-div"></div>
                      <div class="details-top-div"></div>
                </div> 
                <div class="notes_det">
                    <h4>Notes</h4>
                    <p class="notepara">Hello Zachi welcome to india. we hope you have a great experience and memories during your stay here. with lots of love from team Bullshark.</p>
                </div>
            </div> -->
                      
       </div>
                   
               </div>
       </div> 
        
    </main>
    <!-- jquery -->
    <!-- <script src="./js/jquery-3.6.0.js"></script> -->
    <script src='./js/jquery.min.js'></script>
    <script src="./js/bootstrap.min.js"></script>

    <!-- data table js -->

    <!-- <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>-->
    <!-- <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->


    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

        <!-- data table custm js -->
    
        <!-- JavaScript Bundle with Popper boostrap -->
    <!-- <script src="./js/data-table-js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script>-->
    <!-- sidebar-heder -->

    <!-- date picker -->
    <script src='./js/moment-with-locales.js'></script>
    <script src='./js/bootstrap-datetimepicker.js'></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/table.js"></script>
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
    <script>

        function privouspage() {
            $("#booking_view").show();
            $("#booking_detail").hide();
        }
        function nextpage() {
            $("#booking_detail").show();
            $("#booking_view").hide();
        }


        function myFunction(id) {
          document.getElementById(id).classList.toggle("show");
        }

        //dropdown pdf,csv file download
        function drpDownbtnClick (tableid,file){
            if(file == 'pdf'){
                $(`#${tableid}_wrapper`).find('.dt-button.buttons-pdf.buttons-html5').click();
            }
            if(file == 'csv'){
                $(`#${tableid}_wrapper`).find('.dt-button.buttons-csv.buttons-html5').click();
            }

        }
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <script>
            $(document).ready(() => {
                $('#booking_order').addClass('actives');

            });

//            $(function() {
//                $('#arrive_date_input1, #arrive_date_input2').datetimepicker({
//                    date: new Date(),
//                    ignoreReadonly: true,
//                    format: 'DD-MMM-YYYY',
//                    
//                });
//            });
        
        $("#from_date,#from_date2").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });
        $("#to_date,#to_date2").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "YYYY-MM-DD",
            maxDate: new Date()
        });
        
    </script>


    <!--
        <script>
        $(document).ready(function() {
            $("#booking").DataTable({
                language: {
                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                    searchPlaceholder: "Search...",
                },
                buttons: [{
                    extend: "searchBuilder",
                    config: {
                        depthLimit: 2,
                    },
                }, ],
                dom: "Bfrtip",
                columnDefs: [{
                    type: "unknownType",
                    targets: [3],
                }, ],
            });
        });
        </script>
    -->
    <script>
        var table;
        var agenttable;
        let apiPath = "<?php echo $apiPath;?>";
    
        $(document).ready(function() { 
            if(isAgent == 1){
               fetch_data();
               fetch_agentdata();
//               $('#arrive_date_input2').on('change dp.change', function(e){
//                    fetch_agentdata();
//               });
                $('.tabs').removeClass('hidden');
            }else{
                $('.tabs').addClass('hidden');
                fetch_data();
            }
        });
        
        function fetch_data(){
//            let date = $("#arrive_date_input1").val();
            var from_date = $("#from_date").val();
            var to_date   = $("#to_date").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);

            if(d1>d2){
                $("#to_date").val(from_date);
            }
            var to_date   = $("#to_date").val();
            from_date = formatDate(from_date);
            to_date = formatDate(to_date);
            var datas = {
                "userToken":userToken,
                "fromDate":from_date,
                "toDate":to_date
            }   
            var json_data = JSON.stringify(datas);
            $.ajax({
                async: false,
                type: "POST",
                dataType: "json",
                url : `${apiPath}/distributor/bookingHistory.php`,
                data: json_data,
                success: success,
                error:errorcheck,
            });
            //change added here to avoid re-initialize error
//            $('#arrive_date_input1').on('change dp.change', function(e){
//                datewisebooking_data();
//            }); 
        }
        
        function errorcheck(e,r,j){
        }

        function agent_date_filter(){
            fetch_agentdata();
        }
        function fetch_agentdata(){
//            let date = $("#arrive_date_input2").val();
//                date = formatDate(date);
            var from_date = $("#from_date2").val();
            var to_date   = $("#to_date2").val();
            var d1 = Date.parse(from_date);
            var d2 = Date.parse(to_date);
            if(d1>d2){
                $("#to_date2").val(from_date);
            }
            var to_date   = $("#to_date2").val();
                from_date = formatDate(from_date);
                to_date = formatDate(to_date);
            
            let datas = {
                            "userToken":userToken,
                            "fromDate":from_date,
                            "toDate":to_date
                        };
            let json1 = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/distributor/agentBooking.php",
                    data: json1
                    }).done(function(data1) {
                        let agentTableArray = data1.data;
                        let agentHeaderObject = data1.headerData;
                        $('.agentongoingcount').text(agentHeaderObject.ongoing);
                        $('.agentupcomingcount').text(agentHeaderObject.upcoming);
                        $('.agentcompletedcount').text(agentHeaderObject.completed);
                        $('.agentcancelledcount').text(agentHeaderObject.cancelled);

                        let agentbookingDetails = '';
                        agentTableArray.forEach((agentbookings,index) => {
                            let date = new Date(agentbookings.createdDate.replace(/-/g, "/"));
                            let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                            let datearray = formattedDate.split(',')
                            let timearray = datearray[2].split(" ");
                            let timeValue = timearray[1];
                            let timeZone = timearray[2];
                            let dateYearValue = datearray[0]+","+datearray[1];
                            let time_zoneValue = `${timeValue}`;

                            agentbookingDetails += `<tr> <td class="td-bule"><a data-token="${agentbookings.bookingToken}" data-bookingnumber="${agentbookings.bookingNumber}" data-date="${dateYearValue}" data-timezone="${time_zoneValue}" data-count="${agentbookings.memberCount}" data-status="${agentbookings.status}" class="bookingdetail-btn td-bule" onclick="nextpage()" href="#">${agentbookings.bookingNumber}</a></td>
                            <td>${dateYearValue}<span class="text-time">${time_zoneValue}</span></td>
                            <td>${agentbookings.agentName}</td>
                            <td>${agentbookings.customerName}<span class="text-time">${agentbookings.memberCount}</span></td>
                            <td>${agentbookings.servicesCount} services<span class="text-time">${agentbookings.typeName}</span></td>
                            <td>${agentbookings.companyName}</td>
                            <td>${agentbookings.paymentId}</td>
                            <td>${agentbookings.markupType}</td>
                            <td>${agentbookings.markupValue}</td>
                            <td>${agentbookings.loyaltyPoints}</td>
                            </tr> `;
                        });
                        $('#agentbooking tbody').html(agentbookingDetails);
                        $('#agentbooking').DataTable().destroy();
                        $('#agentbooking tbody').html(agentbookingDetails);

                        $('#agentbooking').DataTable({
                                language: {
                                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                                    searchPlaceholder: "Search...",
                                },
                                dom: '<Bfr<"table-container"t>ip>',
                                scrollX: "100%",
                                order: [[1, 'desc']],
                                buttons: [
                                                {
                                                extend: "pdf",
                                                footer: true,
                                                title: "Agent Booking Details",
                                                exportOptions: {
                                                    columns: [0,1,2,3,4],
                                                },
                                                },
                                                {
                                                extend: "csv",
                                                footer: true,
                                                title: "Agent Booking Details",
                                                exportOptions: {
                                                    columns: [0,1,2,3,4],
                                                },
                                                },
                                        ],
                                        order: [],
                                columnDefs: [{
                                    type: "unknownType",
                                    targets: [3],
                                },],
                        }).draw();
                    });    
        }

        //DB date Format
        function formatDate(date) {
            var d = new Date(date);
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();
                year = Math.abs(year)

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;
            return [year, month, day].join('-');

            // var monthArr = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
            // var dateArr = date.split("-");

            // var month = dateArr[1];
            // var monthView = (monthArr.indexOf(month) + 1).toString();
            // if (monthView.length < 2)  monthView = '0' + monthView;
            // return [dateArr[2], monthView, dateArr[0]].join("-");
        }
        
        function date_filter(){
            var from_date = $("#from_date").val();
            var to_date   = $("#to_date").val();
            
            //console.log("from_date",from_date);
            var d1 = Date.parse(from_date);
            
            //console.log("d1",d1);
            var d2 = Date.parse(to_date);
            if(d1>d2){
                $("#to_date").val(from_date);
            }
            var to_date   = $("#to_date").val();
            from_date = formatDate(from_date);
           // console.log("from_date1",from_date);
            to_date = formatDate(to_date);
            
            if(from_date!="" && to_date!="" && from_date!=undefined && to_date!=undefined){
                 var datas = {
                                "userToken":userToken,
                                "fromDate":from_date,
                                "toDate":to_date
                            };
                var json_data = JSON.stringify(datas);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/distributor/bookingHistory.php`,
                    data: json_data,
                    success: successClear,
                });
            }
             
        }
        
        function successClear(data){
            if (table instanceof $.fn.dataTable.Api) {
                table.clear();
                table.destroy();
            }
            success(data);
        }    
            
        function success(data) {
            //status Count
            let statusCancelledCount = 0;
            let statusPendingCount = 0;
            let statusUpcomingCount = 0;
            let statusOngoingCount = 0;
            let statusCompletdCount = 0;
            var table_main_data = data.data;
            let headerDataObj = data.headerData;

            var html_text = "";

            table_main_data.forEach((bookingDetails,index) => {
                let date = new Date(bookingDetails.createdDate.replace(/-/g, "/"));
                let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                let datearray = formattedDate.split(',')
                let timearray = datearray[2].split(" ");
                let timeValue = timearray[1];
                let timeZone = timearray[2];
                let dateYearValue = datearray[0]+","+datearray[1];
                let time_zoneValue = `${timeValue}`;
                
                let status = '';
                if(bookingDetails.status == 'Cancelled'){
                    status = `<td><span class="rejected"><img src="./asset/img/rej.png">${bookingDetails.status}</span></td>`;
                    statusCancelledCount += 1;

                } else if(bookingDetails.status == 'Pending'){
                    status = `<td><span class="upcoming"><img src="./asset/img/up.png">Upcoming</span></td>`;
                    statusUpcomingCount += 1;
                    // statusPendingCount += 1;

                }else if(bookingDetails.status == 'Upcoming'){
                    status = `<td><span class="upcoming"><img src="./asset/img/up.png">${bookingDetails.status}</span></td>`;
                    statusUpcomingCount += 1;
                    
                }else if(bookingDetails.status == 'Ongoing'){
                    status = `<td><span class="ongoing"><img src="./asset/img/ong.png">${bookingDetails.status}</span></td>`;
                    statusOngoingCount += 1;
                    
                }else if(bookingDetails.status == 'Completed'){
                    status = `<td><span class="accepted"><img src="./asset/img/acp.png">${bookingDetails.status}</span></td>`;
                    statusCompletdCount += 1;
                    
                }

                html_text += `<tr> <td class="td-bule"><a data-token="${bookingDetails.bookingToken}" data-bookingnumber="${bookingDetails.bookingNumber}" data-date="${dateYearValue}" data-timezone="${time_zoneValue}" data-count="${bookingDetails.memberCount}" data-status="${bookingDetails.status}" class="bookingdetail-btn td-bule" onclick="nextpage()" href="#">${bookingDetails.bookingNumber}</a></td>
                            <td>${dateYearValue}<span class="text-time">${time_zoneValue}</span></td>
                            <td>${bookingDetails.customerName}</td>
                            <td>${bookingDetails.servicesCount} services<span class="text-time">${bookingDetails.typeName}</span></td>
                            <td>${bookingDetails.companyName}</td>
                            <td>${bookingDetails.paymentId}</td>
                            <td>${bookingDetails.markupType}</td>
                            <td>${bookingDetails.markupValue}</td>
                            <td>${bookingDetails.loyaltyPoints}</td>
                            </tr> `;
                
            });

            // for (var key in table_main_data) {
            //         html_text += '<tr>';
            //             html_text += '<td class="td-bule"><a href="#">'+table_main_data[key].order_id+'</a></td>';
            //             html_text += '<td>'+table_main_data[key].bookedOn+'<br/></td>';
            //             html_text += '<td>'+table_main_data[key].name+'<br/><small></small></td>';
            //             html_text += '<td>'+table_main_data[key].mobile_number+'</td>';
            //             html_text += '<td>'+table_main_data[key].airport_name+'</td>';
            //             html_text += '<td>'+table_main_data[key].provider_name+'</td>';
            //             html_text += '<td>'+table_main_data[key].category_name+'</td>';
            //             if(table_main_data[key].service_date_time == "0000-00-00 00:00:00"){
            //                 html_text += '<td>-<br/></td>';
            //             }else{
            //                 html_text += '<td>'+table_main_data[key].service_date_time+'<br/></td>';
            //             }
            //             html_text += '<td><span>'+table_main_data[key].service_name+'</span></td>';
            //             html_text += '<td><span class="upcoming"><img src="./asset/img/up.png">'+table_main_data[key].status+'</span></td>';
            //             if(table_main_data[key].status == "Pending"){
                            
            //                 html_text += `<td><span class="upcoming" onclick="confirmBooking('${table_main_data[key].booking_token}','${table_main_data[key].type_name}','${table_main_data[key].category_name}')">Confirm</span></br><span class="upcoming" onclick="cancellationBooking('${table_main_data[key].booking_token}')">Cancel</span></td>`;    
            //             }else{
            //                 html_text += '<td><span class="upcoming">-</span></td>';    
            //             }
                        
            //         html_text += '</tr>';              
            // }
            $("#table_body_id").html(html_text);
            // $('.ongoingcount').text(statusOngoingCount);
            $('.ongoingcount').text(`${headerDataObj.ongoing}`);
            $('.upcomingcount').text(`${headerDataObj.upcoming}`);
            $('.completedcount').text(`${headerDataObj.completed}`);
            $('.cancelledcount').text(`${headerDataObj.cancelled}`);

            
            table = $("#booking").DataTable({
                language: {
                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                    searchPlaceholder: "Search...",
                },
                dom: '<Bfr<"table-container"t>ip>',
                scrollX: "100%",
                order: [[1, 'desc']],
                buttons: [
                                {
                                extend: "pdf",
                                footer: true,
                                title: "Booking Details",
                                exportOptions: {
                                    columns: [0,1,2,3,4],
                                },
                                },
                                {
                                extend: "csv",
                                footer: true,
                                title: "Booking Details",
                                exportOptions: {
                                    columns: [0,1,2,3,4],
                                },
                                },
                         ],
                        order: [],
                columnDefs: [{
                    type: "unknownType",
                    targets: [3],
                },],
            });
           
        }



        //Booking Details of individual booking
        $('body').on('click','.bookingdetail-btn',function(){
            let bookingToken = $(this).attr('data-token');
            $('.detailsbookingnumber').text($(this).attr('data-bookingnumber'));
            let bookingdate = $(this).attr('data-date');
            let bookingtime = $(this).attr('data-timezone');
            let passengercount = $(this).attr('data-count');
            let status = $(this).attr('data-status');
            
            let statushtml = '';
                if(status == 'Cancelled'){
                statushtml = `<span class="rejected"><img src="./asset/img/rej.png">${status}</span>`;
                    
                } else if(status == 'Pending'){
                    statushtml = `<span class="upcoming"><img src="./asset/img/up.png">Upcoming</span>`;
                    

                }else if(status == 'Upcoming'){
                    statushtml = `<span class="upcoming"><img src="./asset/img/up.png">${status}</span>`;
                    
                    
                }else if(status == 'Ongoing'){
                    statushtml = `<span class="ongoing"><img src="./asset/img/ong.png">${status}</span>`;
                   
                    
                }else if(status == 'Completed'){
                    statushtml = `<span class="accepted"><img src="./asset/img/acp.png">${status}</span>`;
                }


            $('.detailsbookingdate').text(`${bookingdate}, ${bookingtime}`);
            $('.detailspassengercount').text(`${passengercount}`);
            $('.detailsstatus').html(statushtml);

            let data = {
                            "userToken": userToken,
                            "bookingToken": bookingToken
                       }
            let json_data = JSON.stringify(data);
            $.ajax({
                type: "POST",
                dataType: "json",
                url : `${apiPath}/distributor/singleBookingDetail.php`,
                data: json_data,
                success: bookingdetails,
                error:errorcheck,
            });

        });

        function bookingdetails(data){
            let details = data.details;
            let contact = '';
            let greeter = '';
            let others = '';
            let tabheader = '';
            let tabcontent = '';
            let logo = data.logo;
            let greetCount = 0;
            let contactCount = 0;
            let othersCount = 0;
            let paymentId = details.paymentId;
            details.passengerDetails.forEach((passenger,index) => {
                
                // greetCount = passenger.passengerType == "Greeter" ? greetCount+=1 : greetCount+=0;
                // contactCount = passenger.passengerType == "Contact" ? contactCount+=1 : contactCount+=0;
                // othersCount = passenger.passengerType == "Others" ? othersCount+=1 : othersCount+=0;
                
                switch (passenger.passengerType) {
                    case "Contact":
                        
                        contact += `
                                    <div class="details-top-section">
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Passenger Name</p>
                                    <h5>${passenger.name}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Number</p>
                                    <h5>${passenger.countryCode} ${passenger.mobileNumber}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Email Address</p>
                                    <h5>${passenger.emailId}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    </div></div>`;
                                    contactCount++;
                        break;
                    case "Greeter":
                        greeter += `<div class="details-top-section">
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Person Name</p>
                                    <h5>${passenger.name}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    <p class="top_p_color">Business Mobile Numer</p>
                                    <h5>${passenger.countryCode} ${passenger.mobileNumber}</h5>
                                    </div>
                                    <div class="details-top-div"></div>
                                    <div class="details-top-div"></div>
                                    </div>`;
                                    greetCount++;

                        break;

                    case "Others":
                        others += `<div class="details-top-section">
                                    <div class="details-top-div">
                                    <p class="top_p_color">Passenger Name</p>
                                    <h5>${passenger.name}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Number</p>
                                    <h5>${passenger.countryCode} ${passenger.mobileNumber}</h5>
                                    </div>
                                    <div class="details-top-div">
                                    <p class="top_p_color">Contact Email Address</p>
                                    <h5>${passenger.emailId}</h5>
                                    </div>
                                    <div class="details-top-div">
                                   
                                    </div>
                                    </div>`;
                                    othersCount++

                        break;
                
                    default:
                        break;
                }

                $('.contactpassenger').html(contact);
                $('.otherpassenger').html(others);
                $('.greeterpassenger').html(greeter);
            });

                $('.gstcompname').text(`${details.gstComapany}`);
                $('.detailsgstnumber').text(`${details.gstinNumber}`);
                $('.detailseticket').attr('src',`${details.eTicket}`);
                if(greetCount <= 0){
                    $('.greeterheader').hide();

                }
                if(contactCount <= 0){
                    $('.contactheader').hide();

                }
                if(othersCount <= 0){
                    $('.othersheader').hide();

                }
                if(details.gstinNumber == "" || details.gstinNumber == undefined ){
                    $('.gstinheader').hide();
                    $('.gstinbody').hide();
                }

                if(details.eTicket == "" || details.eTicket == undefined ){
                    $('.ticketheader').hide();
                }
                
                $('.detailscost').text(`${details.serviceAmount}`);
                $('.detailsgst').text(`${details.serviceGst}`);
                $('.convenienceFee').text(`${details.convenienceFee}`);
                $('.convenienceFeeGst').text(`${details.cfTax}`);
                $('.detailstotalprice').text(Number(details.serviceAmount) + Number(details.serviceGst) + Number(details.convenienceFee) + Number(details.cfTax));

                let tabbookingNumber =  $('.detailsbookingnumber').text();

                details.bookingDetails.forEach((bookingdetails,index) => {
                    let serviceStatus = '';
                    let statusDisplay = '';
                    if(bookingdetails.status == 'Cancelled'){
                        statusDisplay = `<span class="rejected"><img src="./asset/img/rej.png">${bookingdetails.status}</span><p> on ${bookingdetails.cancelledDate}</p><p>PaymentId: ${paymentId}</p>`;
                    
                    } else if(bookingdetails.status == 'Pending'){
                        statusDisplay = `<span class="upcoming"><img src="./asset/img/up.png">Upcoming</span>`;
                        

                    }else if(bookingdetails.status == 'Ongoing'){
                        statusDisplay = `<span class="ongoing"><img src="./asset/img/ong.png">${bookingdetails.status}</span>`;
                    
                        
                    }else if(bookingdetails.status == 'Completed'){
                        statusDisplay = `<span class="accepted"><img src="./asset/img/acp.png">${bookingdetails.status}</span>`;
                    }
                    bookingdetails.workStatus.forEach((status,index) => {
                        if(status.ongoing == false){

                            serviceStatus += `<li class="completed">
                                                <p>${status.status}</p>
                                                <p>${status.statustime}</p>
                                            </li>`;
                        }else{
                            serviceStatus += `<li class="on-status">
                                                <p>${status.status}</p>
                                                <p>${status.statustime}</p>
                                            </li>`;
                        }

                        
                        
                    });
                    if(index == 0){
                        tabheader += `<li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#slot${index}" role="tab">${bookingdetails.name}</a>
                                    </li>`;

                        tabcontent += `<div class="tab-pane active" id="slot${index}" role="tabpanel">
                                        <div class="head_airport">
                                             
                                            <div class="detail_airport">
                                                <img src="${logo}" class="airport_company">
                                                <div class="set_airport">
                                                    <h4>${bookingdetails.companyName}</h4>
                                                    <p>${bookingdetails.airportName} | Order ID : ${bookingdetails.token}</p>
                                                </div>
                                                <div class="detailsstatus" style="margin-left:auto;">
                                                    ${statusDisplay}
                                                </div>
                                            </div>
                                            <div class="flexline">
                                                <div class="detail_airport">
                                                <img alt="" src="asset/img/landing.png" class="airport_start">
                                                    <div class="set_airport">
                                                        <p>Service at</p>
                                                        <h4>${bookingdetails.airportCategory} </h4>
                                                    </div>
                                                </div>
                                                <div class="detail_airport">
                                                <img alt="" src="asset/img/calendar.svg" class="airport_start">
                                                    <div class="set_airport">
                                                        <p>Service avail date</p>
                                                        <h4>${bookingdetails.serviceDate} </h4>
                                                    </div>
                                                </div>
                                                <div class="detail_airport">
                                                <img alt="" src="asset/img/time.svg" class="airport_start">
                                                    <div class="set_airport">
                                                        <p>Service avail time</p>
                                                        <h4>${bookingdetails.serviceTime}</h4>
                                                    </div>
                                                </div>
                                                <div class="detail_airport">
                                                <img alt="" src="asset/img/flight-line.svg" class="airport_start">
                                                    <div class="set_airport">
                                                        <p>Flight Number </p>
                                                        <h4>${bookingdetails.flightNumber}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="service_details">
                                          <div class="Business-cnt-text">
                                                <h1>Service Details </h1>
                                            </div>
                                            <div class="details-top-section">
                                                <div class="details-top-div">
                                                    <p class="top_p_color">Package</p>
                                                    <h5>${bookingdetails.serviceName}</h5>
                                                </div>
                                                <div class="details-top-div">
                                                    <p class="top_p_color">Passengers</p>
                                                    <h5>${bookingdetails.totalAdult} Adult | ${bookingdetails.totalChildren} Children</h5>
                                                </div>
                                                <div class="details-top-div">
                                                    <p class="top_p_color">Cost</p>
                                                    <h5>₹ ${bookingdetails.amount}</h5>
                                                </div>
                                            </div> 
                                            <div class="notes_det">
                                                <h4>Notes</h4>
                                                <p class="notepara">${bookingdetails.description}</p>
                                            </div>
                                            <div class="Business-cnt-text">
                                                <h1>Service Status</h1>
                                            </div>
                                            <ul class="service-status">
                                             ${serviceStatus}
                                            </ul>
                                            <div class="Business-cnt-text">
                                              <h1>Review</h1>
                                            </div>
                                            <div class="reveiw-container">
                                              <div class="review-box">
                                                <p>Review on service</p>
                                                <div class="rating-date">
                                                  <div class="rating-set">
                                                    <img src="asset/svg/rating-${bookingdetails.rating}.svg" alt="star">
                                                  </div>
                                                  <p>${bookingdetails.reviewDate}</p>
                                                </div><p class="comment">${bookingdetails.review}</p>
                                              </div>
                                            </div> 
                                        </div>
                                    </div>`;
                    }else{
                        tabheader += `<li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#slot${index}" role="tab">${bookingdetails.name}</a>
                                    </li>`;

                        tabcontent += `<div class="tab-pane" id="slot${index}" role="tabpanel">
                                            <div class="head_airport">
                                                <div class="detail_airport">
                                                <img alt="" src="${logo}" class="airport_company">
                                                    <div class="set_airport">
                                                        <h4>${bookingdetails.companyName}</h4>
                                                        <p>${bookingdetails.airportName} | Order ID : ${bookingdetails.token}</p>
                                                    </div>
                                                    <div class="detailsstatus" style="margin-left:auto;">
                                                        ${statusDisplay}
                                                    </div>
                                                </div>
                                                <div class="flexline">
                                                    <div class="detail_airport">
                                                    <img alt="" src="asset/img/landing.png" class="airport_start">
                                                        <div class="set_airport">
                                                            <p>Service at</p>
                                                            <h4>${bookingdetails.airportCategory}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="detail_airport">
                                                    <img alt="" src="asset/img/calendar.svg" class="airport_start">
                                                        <div class="set_airport">
                                                            <p>Service avail date</p>
                                                            <h4>${bookingdetails.serviceDate}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="detail_airport">
                                                    <img alt="" src="asset/img/time.svg" class="airport_start">
                                                        <div class="set_airport">
                                                            <p>Service avail time</p>
                                                            <h4>${bookingdetails.serviceTime}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="detail_airport">
                                                    <img alt="" src="asset/img/flight-line.svg" class="airport_start">
                                                        <div class="set_airport">
                                                            <p>Flight Number </p>
                                                            <h4>${bookingdetails.flightNumber}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="service_details">
                                                  <div>
                                                    <div class="Business-cnt-text">
                                                        <h1>Service Details</h1>
                                                    </div>
                                                    <div class="details-top-section">
                                                        <div class="details-top-div">
                                                            <p class="top_p_color">Package</p>
                                                            <h5>${bookingdetails.serviceName}</h5>
                                                        </div>
                                                        <div class="details-top-div">
                                                            <p class="top_p_color">Passengers</p>
                                                            <h5>${bookingdetails.totalAdult} Adult | ${bookingdetails.totalChildren} Children</h5>
                                                        </div>
                                                        <div class="details-top-div">
                                                            <p class="top_p_color">Cost</p>
                                                            <h5>₹ ${bookingdetails.amount}</h5>
                                                        </div>
                                                       
                                                        <div class="details-top-div"></div>
                                                        <div class="details-top-div"></div>
                                                       
                                                    </div> 
                                                    <div class="notes_det">
                                                            <h4>Notes</h4>
                                                            <p class="notepara">${bookingdetails.description}</p>
                                                        </div>
                                                    <div class="Business-cnt-text">
                                                        <h1>Service Status</h1>
                                                    </div>
                                                    <ul class="service-status">
                                                    ${serviceStatus}
                                                    </ul>
                                                  </div>
                                                  
                                                </div>
                                                <div class="Business-cnt-text">
                                                    <h1>Review</h1>
                                                </div>
                                                <div class="reveiw-container">
                                                    <div class="review-box">
                                                        <p>Review on service</p>
                                                        <div class="rating-date">
                                                        <div class="rating-set">
                                                            <img src="asset/svg/rating-${bookingdetails.rating}.svg" alt="star">
                                                        </div>
                                                        <p>${bookingdetails.reviewDate}</p>
                                                        </div><p class="comment">${bookingdetails.review}</p>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>`;
                    }

                    
                });

                $('.tabheader').html(tabheader);
                $('.tabcontent').html(tabcontent)

        }
            
        function confirmBooking(booking_token,type_name,travelStatus){
            swal({
            title: "Are you sure?",
            text: "You want to confirm the booking",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var datas = {
                            booking_token:booking_token,
                            status:"Ongoing",
                            type_name:type_name,
                            travelStatus:travelStatus
                        
                        }
                    var json_data = JSON.stringify(datas);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url :  `${apiPath}/service-distributor/update_booking_detail.php`,
                        data: json_data,
                    }).done(function(data){
                        swal("Booking Confirmed!", {icon: "success",}).then((value) => {
                                        location.reload();
                                    });
                    }); 
                }
            });
            
        }
        function cancellationBooking(booking_token){
            swal({
            title: "Are you sure?",
            text: "You want cancel the booking",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var datas = {
                        booking_token:booking_token,
                        status:"Cancelled"
                    }
                    var json_data = JSON.stringify(datas);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url :  `${apiPath}/service-distributor/update_booking_detail.php`,
                        data: json_data,
                    }).done(function(data){
                        swal("Booking Cancelled!", {icon: "success",}).then((value) => {
                                        location.reload();
                                    });
                    });
                }
            });
        }


    </script>
</body>

</html>