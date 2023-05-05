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
   <!-- datepicker style -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/bootstrap-icons.css">
   <link rel="stylesheet" href="css/bootstrap-datetimepicker.css"/>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
   <link rel="stylesheet" href="css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
   <link rel="stylesheet" href="css/commen.css?v=<?php echo $cur_date_time; ?>" />
   <link rel="stylesheet" href="css/managefinace.css?v=<?php echo $cur_date_time; ?>">
</head>
<style>
.dt-buttons{
   display: none;
}
</style>
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
            <div class="common-input-field">
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
               <div class="inner-input-field">
                  <div class="dropdown">
                     <button onclick="myFunction()" class="dropbtn cust-btn cust-btn-primary"><img src="asset/svg/download-white.svg" alt="" class="download-icon">Download as <img src="asset/svg/down.svg" alt="" class="downarrow-icon"></button>
                     <div id="myDropdown" class="dropdown-content">
                        <a href="#" onclick="drpDownbtnClick('csv')">CSV</a>
                        <a href="#" onclick="drpDownbtnClick('pdf')">PDF</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="common-revenue">
               <div class="common-revenue-inner">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Booked Revenue</p>
                        <h1 id="booked_revenue"></h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/yellow-booked.png" alt="">
                     </div>
                  </div>
                  <div class="realized">
                     <p>Realized Revenue</p>
                     <h1 id="realized_revenue"></h1>
                  </div>
                  <div class="unrealized">
                     <p>Unrealized Revenue</p>
                     <h1 id="unrealized_revenue"></h1>
                  </div>
               </div>
               <div class="total-earings">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Total earings</p>
                        <h1 id="total_earnings"></h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/green-booked.png" alt="">
                     </div>
                  </div>
                  <div class="total-common">
                     <div class="total-common-inner">
                        <h1>This Month</h1>
                        <p id="month_earning"></p>
                     </div>
                     <div class="total-common-inner">
                        <h1>Last Month</h1>
                        <p id="last_month_earning"></p>
                     </div>
                     <div class="total-common-inner">
                        <h1>Last Six Month</h1>
                        <p id="last_six_month_earning"></p>
                     </div>
                     <div class="total-common-inner">
                        <h1>Last Year</h1>
                        <p id="last_year_earning"></p>
                     </div>
                  </div>
               </div>
               <div class="credit-available">
                  <div class="common-booked">
                     <div class="booked">
                        <p>Credit Available</p>
                        <h1 id="credit_available"></h1>
                     </div>
                     <div class="book-home">
                        <img src="asset/vilot-booked.png" alt="">
                     </div>
                  </div>
                  <div class="realized">
                     <p>Total Credit Given</p>
                     <h1 id="total_credit_given"></h1>
                  </div>
                  <div class="unrealized">
                     <p>Balance From Airportzo Revenue</p>
                     <h1 id="airport_team_revenue"></h1>
                  </div>
               </div>
            </div>
            <table id="ManageFinance_table" style="width: 100%;">
               <thead>
                  <tr>
                     <th>Token</th>
                     <th>Booking Number</th>
                     <th>Service Cost</th>
                     <th>Commission Cost</th>
                     <th>Total Cost</th>
                     <th>Commission Percentage</th>
                     <th>Cancellation Charge</th>
                     <th>Receivable</th>
                     <th>Refunded Amount</th>
                     <th>Created Date</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </main>
   <script src='js/jquery.min.js'></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
   <!-- date picker -->
   <script src="js/moment-with-locales.js"></script>
   <script src="js/bootstrap-datetimepicker.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
   <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script>
   var apiPath = "<?php echo $apiPath; ?>";
   $(document).ready(function () {
      $('#Manage-finance').addClass('actives');
      var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
      serviceprovider_sidemenu(staff_token);
   });

   $("#from_date").datetimepicker({
      date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
      ignoreReadonly: true,
      format: "DD-MM-YYYY",
      maxDate: new Date()
   });

   $("#to_date").datetimepicker({
      date: new Date(),
      ignoreReadonly: true,
      format: "DD-MM-YYYY",
      maxDate: new Date()
   });

   function date_filter(){
      var from_date = $("#from_date").val();
      var to_date   = $("#to_date").val();
      var d1 = Date.parse(from_date);
      var d2 = Date.parse(to_date);
      if(d1>d2){
         $("#to_date").val(from_date);
      }
      var to_date   = $("#to_date").val();
      if(from_date!="" && to_date!="" && from_date!=undefined && to_date!=undefined){
         table.clear();
         table.destroy();
         data_fetch();
      }
   }

   data_fetch();
   var table;
   function data_fetch(){  
      var from_date = $("#from_date").val();
      var to_date   = $("#to_date").val();
      var d1 = Date.parse(from_date);
      var d2 = Date.parse(to_date);
      if(d1>d2){
         $("#to_date").val(from_date);
      }
      var to_date   = $("#to_date").val();
      var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
      if(service_provider_companylocation_token == null){
         var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
      } else {
         var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
      }
      table = $("#ManageFinance_table").DataTable({
         'stateSave': true,
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url':apiPath+"/provider/finaceHistory.php?serviceProviderLocationtoken="+companylocation_token+"&&fromDate="+from_date+"&&toDate="+to_date,
            'dataSrc': function(data) {
               return data.aaData;
            }
         },
         pageLength: 25,
         lengthMenu: [25,100,500,1000,5000],
         //"order": [[0, "DESC" ]],
         'columns': [
            { data: 'token' },
            { data: 'bookingNumber' },
            { data: 'serviceCost' },
            { data: 'commision' },
            { data: 'totalCost' },
            { data: 'percentage' },
            { data: 'cancellationFee' },
            { data: 'receivable' },
            { data: 'refundedAmount' },
            { data: 'createdDateTime'}
         ],
         
         dom: 'Bfrltip',
         initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
         },
         buttons: [{
            extend: 'pdfHtml5',
            className: 'btn-primary buttonprint',
            exportOptions: {
               columns: [0,1,2,3,4,5,6,7,8,9]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL'
         },{
            extend: 'csv',
            className: 'btn-info buttonprint',
            exportOptions: {
               columns: [0,1,2,3,4,5,6,7,8,9]
            },
            orientation: 'landscape',
            pageSize: 'LEGAL'
         }],
         language: {
            search: '<img src="asset/svg/search@2x.png">', searchPlaceholder: "Search" ,
            paginate: {
               next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
               previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
            }
         }
      });
      $('#ManageFinance_table_wrapper').find('input[type=search]').val('');
      $('#ManageFinance_table_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');

      var datas = {
         'serviceProviderLocationtoken' : companylocation_token,
         'fromDate':from_date,
         'toDate':to_date
      };
      var jsonData = JSON.stringify(datas);
      $.ajax({
         dataType: "JSON",
         type: "POST",
         url: apiPath+"/provider/financeHeader.php",
         data: jsonData,
      }).done(function (data) {
         if(data.status_code==201){
            let IndianCurrency = Intl.NumberFormat("en-IN", {
               style: "currency",
               currency: "INR",
            });
            $("#booked_revenue").html(IndianCurrency.format(data.bookedRevenue));
            $("#realized_revenue").html(IndianCurrency.format(data.realizedRevenue));
            $("#unrealized_revenue").html(IndianCurrency.format(data.unRealizedRevenue));
            $("#total_earnings").html(IndianCurrency.format(data.totalEarnings));
            $("#month_earning").html(IndianCurrency.format(data.thisMonthEarning));
            $("#last_month_earning").html(IndianCurrency.format(data.lastMonthEarning));
            $("#last_six_month_earning").html(IndianCurrency.format(data.lastSixMonthEarning));
            $("#last_year_earning").html(IndianCurrency.format(data.lastYearEarning));
            if(data.is_credit=='0'){
               $('.credit-available').css("display", "none");
            } else {
               $("#credit_available").html(IndianCurrency.format(data.creditAvailable));
               $("#total_credit_given").html(IndianCurrency.format(data.totalCreditGiven));
               $("#airport_team_revenue").html(IndianCurrency.format(data.balanceFromAirportzo));
            }
         } else {
               swal({
                  title: "Error!",
                  text: data.message,
                  icon: "error",
                  button: "Ok",
               });
         }
      });
   }

   function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
   }

   //dropdown pdf,csv file download
   function drpDownbtnClick (file){
      if(file == 'pdf'){
         $('#ManageFinance_table_wrapper').find('.dt-button.buttons-pdf.buttons-html5').click();
      }
      if(file == 'csv'){
         $('#ManageFinance_table_wrapper').find('.dt-button.buttons-csv.buttons-html5').click();
      }
   }

   // Close the dropdown if the user clicks outside of it
   window.onclick = function(event) {
      if (!event.target.matches('.dropbtn') && 
            !event.target.matches('.download-icon') &&
            !event.target.matches('.downarrow-icon')) {
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
   
   function service_provider_list(){
      table.clear();
      table.destroy();
      data_fetch();
   }
   </script>
</body>
</html>
<?php
}
?>