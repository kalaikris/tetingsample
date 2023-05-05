<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Whitelabeling | Manage Finance</title>
	<link rel="shortcut icon" href="asset/fav-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="css/intlTelInput.css"/>
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/agent-bookings.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>
<body>

	<!-- <div id="loading"></div> -->

    <nav></nav>  <!-- NAV MENU -->

    <section class="agent-dashboard-body">
      <div class="agent-dashboard-container">
        <aside class="agent-dashboard-sidebar"></aside> <!-- SIDE MENU -->
        <main class="main-content">
            <section class="bookings-container">
                  <div class="box-set">
                        <div class="box-1">
                            <div class="cont-set">
                                <h3 class="card-number ongoingcount">₹ 34,456</h3>
                                <p class="card-cont">Booked Revenue</p>
                            </div>
                        </div>
                        <div class="box-3">
                            <div class="cont-set">
                                <h3 class="card-number upcomingcount">₹ 34,456</h3>
                                <p class="card-cont">Realized Revenue</p>
                            </div>
                        </div>
                        <div class="box-2">
                            <div class="cont-set">
                                <h3 class="card-number completedcount">₹ 34,456</h3>
                                <p class="card-cont">Unrealized Revenue</p>
                            </div>
                        </div>
                        <div class="box-4">
                            <div class="cont-set">
                                <h3 class="card-number cancelledcount">₹ 34,456</h3>
                                <p class="card-cont">Balance from</p>
                            </div>
                        </div>
                  </div>
                  <div class="date-con-set">
                    <div class="left-sid-set">
                        <div class="arriving-input-set input-group">
                            <label for="from_date" class="input-group-addon bg-date">
                            </label>
                            <div class="date_pickers">
                                <label for="from_date">From Date</label>
                                <input type="text" class="b-input datepicker" id="from_date" placeholder="DD-MMM-YYYY" readonly="">
                            </div>
                        </div>
                        <div class="arriving-input-set input-group">
                            <label for="to_date" class="input-group-addon bg-date">
                            </label>
                            <div class="date_pickers">
                                <label for="to_date">To Date</label>
                                <input type="text" class="b-input datepicker" id="to_date" placeholder="DD-MMM-YYYY" readonly="">
                            </div>
                        </div>
                        <div>
                            <div class="inner-input-field">
                                <div class="inner-input-field">
                                     <div class="dropdown">
                                      <button onclick="myFunction()" class="dropbtn">
                                        <img src="asset/download-white.svg" alt="">
                                       Download as
                                       <img src="asset/down.svg" alt="">
                                      </button>
                                      <div id="myDropdown" class="dropdown-content">
                                        <a href="javascript:void(0)">CSV</a>
                                        <a href="javascript:void(0)">PDF</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="table-container">
                    <table id="example" class="booking-table custom-table display nowrap" style="width:100%">
                         <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Booked Cost</th>
                                <th>Commission Cost</th>
                                <th>Covenience Charge</th>
                                <th>Cancellation Charge</th>
                                <th>Refound Amount</th>
                                <th>Payment Status</th>
                            </tr>
                         </thead>
                         <tbody>
                            <tr>
                                <td class="table-data-link">W9768</td>
                                <td>
                                   <p>₹ 4,780</p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                   <p> 
                                      0.5% commission
                                   </p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                </td>
                                <td>+₹ 780</td>
                                <td>+₹ 80</td>
                                <td>
                                    <span class="widget ongoing">
                                        Refunded
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-data-link">W9768</td>
                                <td>
                                   <p>₹ 4,780</p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                   <p> 
                                      0.5% commission
                                   </p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <span class="widget completed">
                                        Completed
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-data-link">W9768</td>
                                <td>
                                   <p>₹ 4,780</p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                   <p> 
                                      0.5% commission
                                   </p> 
                                </td>
                                <td>
                                   <p class="positive-amount">+₹ 780</p> 
                                </td>
                                <td>+₹ 78</td>
                                <td>-</td>
                                <td>
                                    <span class="widget cancelled">
                                        Pending
                                    </span>
                                </td>
                            </tr>
                         </tbody>
                    </table>
                  </div>
            </section>
        </main>
      </div>
    </section>

    </div>

    <script src='js/jquery.min.js'></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/custom.js<?php echo $cache_str; ?>"></script>

    <script>


        $(document).ready(function(){
            $('#from_date').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MMM-YYYY'
            });
            $('#to_date').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MMM-YYYY'
            });
    
            $('#example').DataTable({
                scrollX: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: 'Search',
                    lengthMenu: "Showing _MENU_ of 25 bookings",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                    
                },
                dom: '<f<"table-box"t>lp>',
            });

        })
        

        // Dropdown action
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
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
</body>
</html>


