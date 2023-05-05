<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whitelabeling | Manage Finance</title>
    <link rel="shortcut icon" id="favicon-logo">
    <link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    
    <link rel="stylesheet" href="css/intlTelInput.css" />
    <link rel="stylesheet" href="css/fonts.css">

    <link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/home.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/choose-service.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/booking-history.css<?php echo $cache_str; ?>">
    <link rel="stylesheet" href="css/agent-bookings.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>

    <style>
        .left-sid-set,
        .left-sid-set>div:first-child {
            display: flex;
            justify-content: flex-start;
            align-items: unset;
        }

        .left-sid-set {
            column-gap: 16px;
        }

        .inner-input-field {
            margin-left: 10px;
        }
        .dt-buttons {
            display: none;
        }
    </style>
</head>

<body onload="loadDistributorDetail();">
    <!-- <div id="loading"></div> -->
    <nav></nav> <!-- NAV MENU -->

    <section class="agent-dashboard-body">
        <input type="hidden" id="gtag_id">
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
                        <div class="box-4" style="display:none;">
                            <div class="cont-set">
                                <h3 class="card-number cancelledcount">₹ 34,456</h3>
                                <p class="card-cont" id="distributor_name">Balance from</p>
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
                            <button type="button" class="btn btn-success" onclick="agent_date_filter()">Generate</button>
                            <div>
                                <div class="inner-input-field">
                                    <div class="dropdown">
                                        <button onclick="myFunction()" class="dropbtn">
                                            <img src="asset/download-white.svg" alt="">
                                            Download as
                                            <img src="asset/down.svg" alt="">
                                        </button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a class="dropdown-item" onclick="dropdownclick('example','csv');" href="#">CSV</a>
                                            <a class="dropdown-item" onclick="dropdownclick('example','pdf');" href="#">PDF</a>
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
                                    <th>Refund Amount</th>
                                    <th>Refund Status</th>
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
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> -->
    <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/custom.js<?php echo $cache_str; ?>"></script>

    <script>
        $('.nav-dash').text("Website");
        $('.nav-dash').attr("href", "index");
        var userToken = '';
        $(document).ready(function() {
            userToken = $('body').attr('data-usr-token');
            if ( !userToken || userToken == 0) {
                window.location.href = "index.php";
            } else {
                $("#from_date").datetimepicker({
                    date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
                    ignoreReadonly: true,
                    format: "DD-MM-YYYY",
                    maxDate: new Date()
                });
                $('#to_date').datetimepicker({
                    date: new Date(),
                    ignoreReadonly: true,
                    format: 'DD-MM-YYYY',
                    maxDate: new Date()
                });
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                
                fromDate = formatDate(fromDate);
                toDate = formatDate(toDate);
                
                fetch_websitebooking(fromDate,toDate);
                fetch_agentheader(fromDate,toDate);

                // $('#example').DataTable({
                //     scrollX: true,
                //     language: {
                //         search: "_INPUT_",
                //         searchPlaceholder: 'Search',
                //         lengthMenu: "Showing _MENU_ of 25 bookings",
                //         paginate: {
                //             previous: "<",
                //             next: ">"
                //         }

                //     },
                //     dom: '<f<"table-box"t>lp>',
                // });
            }
        });


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

        function agent_date_filter(){
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
                fromDate = formatDate(fromDate);
                toDate = formatDate(toDate);
            let fromfullDate = new Date(fromDate);//to get valid date format to compare dates
            let tofullDate = new Date(toDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate){
                fetch_websitebooking(fromDate,toDate);
                fetch_agentheader(fromDate,toDate);
            }else{
                swal("Enter Valid Date Range");
            }
        }

        function fetch_websitebooking(fromDate,toDate){
                let data = {
                    "userToken":userToken,
                    "fromDate":fromDate,
                    "toDate":toDate
                }
                let json_data = JSON.stringify(data);
                $.ajax({
                    async: false,
                    type: "POST",
                    dataType: "json",
                    url : `php/service-distributor/agentFinanceHistory.php`,
                    data: json_data
                }).done(function(data1){
                    let webbooking = '';
                    let webbookingarray = data1.data;
                    
                    webbookingarray.forEach((webdetails,index) => {
                            // let date = new Date(webdetails.createdDateTime.replace(/-/g, "/"));
                            // let formattedDate = new Intl.DateTimeFormat("en",{hour:"2-digit",minute:"2-digit",day:"2-digit",month:"short",year:"numeric",hour12:false,timeZoneName:"shortOffset"}).format(date);
                            // let datearray = formattedDate.split(',')
                            // let timearray = datearray[2].split(" ");
                            // let timeValue = timearray[1];
                            // let timeZone = timearray[2];
                            // let dateYearValue = datearray[0]+","+datearray[1];
                            // let time_zoneValue = `${timeValue}`;

                        webbooking += `<tr>
                                            <td class="order-data"><a class="" data-token="${webdetails.token}" href="#">${webdetails.bookingNumber}</a> </td>
                                            <td>
                                                <ul class="service-cost">
                                                    <li>${webdetails.netAmount}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="total-commision">
                                                    <li class="positive-amount">+${webdetails.commisionCost}</li>
                                                    <li style="color: #919191;">${webdetails.commision} % commission</li>
                                                </ul>
                                            </td>
                                            <td>${webdetails.convenience_fee}</td>
                                            <td>${webdetails.cancellationFee}</td>
                                            <td>${webdetails.refundedAmount}</td>
                                            <td>${webdetails.refundStatus}</td>
                                        </tr>`;
                        
                    });
                    $('#example tbody').html(webbooking);
                    $('#example').DataTable().destroy();
                    $('#example tbody').html(webbooking);
                    $("#example").DataTable({
                        language: {
                            search: '',
                            searchPlaceholder: "Search...",
                        },
                        order: [[1, 'desc']],
                        dom: 'Bfrtip',
                        buttons: [
                                    {
                                        extend: "pdfHtml5",
                                        footer: true,
                                        title: "Manage Finance-Website",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6],
                                        },
                                        orientation: 'landscape',
                                        pageSize: 'LEGAL'
                                    },
                                    {
                                        extend: "csv",
                                        footer: true,
                                        title: "Manage Finance-Website",
                                        exportOptions: {
                                            columns: [0,1,2,3,4,5,6],
                                        },
                                        orientation: 'landscape',
                                        pageSize: 'LEGAL'
                                    }, 
                                ],
                        scrollX: true,
                        columnDefs: [{
                            type: "unknownType",
                            targets: [3],
                        }, ],
                    }).draw();

                })
            }
            function fetch_agentheader(fromDate,toDate){

                let data = {
                        "userToken":userToken,
                        "fromDate":fromDate,
                        "toDate":toDate
                    }
                    let json_data = JSON.stringify(data);
                    $.ajax({
                        async: false,
                        type: "POST",
                        dataType: "json",
                        url : `php/service-distributor/agentFinanceHeader.php`,
                        data: json_data
                    }).done(function(data1){
                        let headerObject = data1;
                        let Indian_Currency = Intl.NumberFormat("en-IN", {
                            style: "currency",
                            currency: "INR",
                        });
                        $('.ongoingcount').text(Indian_Currency.format(headerObject.bookedRevenue));
                        $('.upcomingcount').text(Indian_Currency.format(headerObject.realizedRevenue));
                        $('.completedcount').text(Indian_Currency.format(headerObject.unRealizedRevenue));
                        // if(headerObject.is_credit=='0'){
                        //     $('.box-4').css("display", "none");
                        // } else{
                        //     $('.cancelledcount').text(Indian_Currency.format(headerObject.balanceFromAirportzo));
                        //     $("#distributor_name").text('Balance from '+headerObject.service__distributor_name);
                        //     $('.box-4').css("display", "block");
                        // }
                    })
            }

        function formatDate(date) {
            let [day,month,year] = date.split('-');
            return [year, month, day].join('-');
        }
        //dropdown pdf,csv file download
        function dropdownclick (tableid,file){
                if(file == 'pdf'){
                    $(`#${tableid}_wrapper`).find('.dt-button.buttons-pdf.buttons-html5').click();
                }
                if(file == 'csv'){
                    $(`#${tableid}_wrapper`).find('.dt-button.buttons-csv.buttons-html5').click();
                }

        }
    </script>
</body>

</html>