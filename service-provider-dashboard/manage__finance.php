<?php
session_start();
include_once '../config/core.php';
if (isset($_COOKIE['service_token']) == "") {
    header("Location:login.php");
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Finance</title>
   <link rel="shortcut icon" href="asset/airportzo-icon.png">
   <!-- boostrap-popup-link-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
   <!-- datepicker style -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/bootstrap-icons.css">
   <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
   <!-- datepicker style-end -->
   <!-- boostrap-popup-link-->
   <link rel="stylesheet" href="js/data-table-css/jquery.dataTables.min.css"/>
   <link rel="stylesheet" href="js/data-table-css/searchBuilder.dataTables.min.css"/>
   <link rel="stylesheet" href="js/data-table-css/dataTables.dateTime.min.css"/>
   <link rel="stylesheet" href="css/fonts.css">
   <link rel="stylesheet" href="css/commen.css">
   <link rel="stylesheet" href="css/header-sidemenu.css"/>
   <link rel="stylesheet" href="css/managefinace.css">
</head>
<body id="page">
   <div id="loading"></div>
   <header id="header">
   </header>
   <main>
      <div class="flex-main-set">
         <div class="slider-set" id="sidebar">
         </div>
         <div class="slider-desc-set">
            <div class="header-common-down">
               <div class="Finance-header">
                  <h1>Manage Finance</h1>
               </div>
            </div>
            <div class="common-revenue">
               <div class="common-revenue-inner">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Booked Revenue</p>
                        <h1>₹ 1,62,367</h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/yellow-booked.png" alt="">
                     </div>
                  </div>
                  <div class="realized">
                     <p>Realized Revenue</p>
                     <h1>₹ 1,30,0000</h1>
                  </div>
                  <div class="unrealized">
                     <p>Unrealized Revenue</p>
                     <h1>₹ 1,30,0000</h1>
                  </div>
               </div>
               <div class="total-earings">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Total earings</p>
                        <h1>₹ 1,62,367</h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/green-booked.png" alt="">
                     </div>
                  </div>
                  <div class="total-common">
                     <div class="total-common-inner">
                        <h1>This Month</h1>
                        <p>₹ 34,826</p>
                     </div>
                     <div class="total-common-inner">
                        <h1>This Month</h1>
                        <p>₹ 34,826</p>
                     </div>
                     <div class="total-common-inner">
                        <h1>This Month</h1>
                        <p>₹ 34,826</p>
                     </div>
                     <div class="total-common-inner">
                        <h1>This Month</h1>
                        <p>₹ 34,826</p>
                     </div>
                  </div>
               </div>
               <div class="credit-available">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Credit Available</p>
                        <h1>₹ 2,74,863</h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/vilot-booked.png" alt="">
                     </div>
                  </div>
                  <div class="realized">
                     <p>Total Credit Given</p>
                     <h1>₹ 5,00,0000</h1>
                  </div>
                  <div class="unrealized">
                     <p>Balance From Airportzo Revenue</p>
                     <h1>₹ 28,386</h1>
                  </div>
               </div>
            </div>
            <div class="common-input-field">
               <div class="inner-input-field">
                  <div class='arriving-input-set input-group' id='from_date'>
                     <span class="input-group-addon bg-date">
                     </span>
                     <div class="date-con">
                        <label for="arrive_date">From Date</label><br>
                        <input type='text' class="b-input datepicker" id="arrive_date_input" placeholder="DD-MM-YYYY" readonly />
                     </div>
                  </div>
               </div>
               <div class="inner-input-field">
                  <div class='arriving-input-set input-group' id='to_date'>
                     <span class="input-group-addon bg-date">
                     </span>
                     <div class="date-con">
                        <label for="arrive_date">To Date</label><br>
                        <input type='text' class="b-input
                              datepicker" id="arrive_date_input" placeholder="DD-MM-YYYY" readonly />
                     </div>
                  </div>
               </div>
               <div class="inner-input-field">
                  <button type="button" class="btn-pr"> <img src="./asset/upload.png" alt=""> <label
                        for="Download">Download us</label>
                     <select name="pdf" id="pdf">
                        <option value="png"></option>
                        <option value="svg">svg</option>
                        <option value="gif">gif</option>
                     </select></button>
               </div>
              <!--     <div class="dropdown">
                    <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="">
                    <label for="filter-switch" class="dropdown__options-filter">
                        <ul class="dropdown__filter" role="listbox" tabindex="-1">
                            <li class="dropdown__filter-selected" aria-selected="true">
                                Download as
                            </li>
                            <li>
                                <ul class="dropdown__select">
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)">CSV</a>
                                    </li>
                                    <li class="dropdown__select-option" role="option">
                                        <a href="javascript:void(0)">PDF</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </label>
                </div> -->
            </div>
            <table id="example" class="" style="width: 100%;">
               <thead>
                  <tr>
                     <th>Order ID</th>
                     <th>Service Cost</th>
                     <th>Commision Cost</th>
                     <th>Total Cost</th>
                     <th>Credit Balance</th>
                     <th>Cancellation Change</th>
                     <th>Refund Amount</th>
                     <th>Payment Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="order-data">W9768</td>
                     <td>
                        <ul class="service-cost">
                           <li> ₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>849</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 3,950</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li> ₹ 3,72,375</li>
                        </ul>
                     </td>
                     <td>-</td>
                     <td>-</td>
                     <td> <span class="payment">complete</span> </td>
                     <td>-</td>
                  </tr>
                  <tr>
                     <td class="order-data">W8352</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>1,274</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 5,286</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>-</td>
                     <td>-</td>
                     <td><span class="payment">complete</span></td>
                     <td>-</td>
                  </tr>
                  <tr>
                     <td class="order-data">W7253</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>937</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 1,937</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 937</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 1,947</li>
                        </ul>
                     </td>
                     <td> <span class="Refund">Refunded</span> </td>
                     <td>-</td>
                  </tr>
                  <tr>
                     <td class="order-data">W0927</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 1,744</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>-</td>
                     <td>-</td>
                     <td> <span class="payment">complete</span> </td>
                     <td>-</td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li> ₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td><span class="Pending">Pending</span></td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
                  <tr>
                     <td class="order-data">W8725</td>
                     <td>
                        <ul class="service-cost">
                           <li>₹ 4,780 </li>
                        </ul>
                     </td>
                     <td>
                        <ul class="commission-cost">
                           <li>- ₹</li>
                           <li>60</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="credit-balance">
                           <li>- </li>
                           <li>₹ 3,68,376</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td>
                        <ul class="total">
                           <li>₹ 290</li>
                        </ul>
                     </td>
                     <td> <span class="Pending">Pending</span> </td>
                     <td><button type="button" class="initiate">initiate Refund</button></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      </div>
      </div>
   </main>
   <!-- boostrap-popup-link -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
   <!-- date picker -->
   <script src='./js/moment-with-locales.js'></script>
   <script src='./js/bootstrap-datetimepicker.js'></script>
   <script src="./js/bootstrap.min.js"></script>
   <!-- boostrap-popup-link -->
   <!-- <script src="./js/jquery-3.6.0.js"></script> -->
   <script src='./js/jquery.min.js'></script>
   <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
   <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
   <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
   <!-- sidebar-heder -->
   <script src="./js/heder-sidebar.js"></script>
   <script>
      $(document).ready(function () {
         $("#example").DataTable({
            language: {
               search: '<img class="b_img" src="./asset/svg/search@2x.png">',
               searchPlaceholder: "Search...",
            },
            buttons: [
               {
                  extend: "searchBuilder",
                  config: {
                     depthLimit: 2,
                  },
               },
            ],
            dom: "Bfrtip",
            columnDefs: [
               {
                  type: "unknownType",
                  targets: [3],
               },
            ],
         });
      });
   </script>
   <script>
      $(document).ready(() => {
         $('#Manage-finance').addClass('actives');
      });
   </script>
   <script>
      $(function () {
         $('#from_date').datetimepicker({
            ignoreReadonly: true,
            format: 'DD-MM-YYYY'
         });
         $('#to_date').datetimepicker({
            ignoreReadonly: true,
            format: 'DD-MM-YYYY'
         });

      });
   </script>
</body>
</html>
<?php
}
?>