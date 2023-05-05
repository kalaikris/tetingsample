<?php
    include '../config/core.php';
    include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/booking-mng.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .table-box {
            border-bottom: 1px solid var(--dark-gray);
        }
        .table-container {
            padding-top: 32px;
            background-color: #f3f7fa;
        }
    </style>
</head>

<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar12"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">MIS Reports</h1>
                <!-- <p class="total_emp total">Total Bookings - 23</p> -->
            </div>
            <div class="header_btn-container">
                <div>
                    <div class="input__box input_datebox">
                        <input type='text' class="b-input datepicker form__input" id="from_date" placeholder="From date" readonly/>
                    </div>
                    <div class="input__box input_datebox">
                        <input type='text' class="b-input datepicker form__input" id="to_date" placeholder="To date" readonly/>
                    </div>
                    <div class="subit-cont">
                        <button class="primary-btn daterangefilter">Generate</button>
                    </div>
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
                                        <a href="#" onclick="drpDownbtnClick ('csv');">CSV</a>
                                    </li>
                                    <li class="dropdown__select-option" role="option">
                                        <a href="#" onclick="drpDownbtnClick ('pdf');">PDF</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </label>
                </div>
            </div>
            <div class="table-container">
                <div class="table-box" style="margin-bottom:16px;">
                    <h3 style="margin-left:10px;padding-top:30px;"><b>Profit/Loss</b></h3>
                    <table class="custom-table booking-manage" id="dataTables_filter1">
                        <thead>
                            <tr>
                                <th hidden>sorting serial</th>
                                <th>Particulars</th>
                                <th>Selected Date Range</th>
                                <th>YTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales (A) (Services Received)</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Credit Notes (B) (Cancelled Services)</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Net sales C=A-B</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td style="background-color:antiquewhite;"><b>Expenses</b></td>
                                <td style="background-color:antiquewhite;"></td>
                                <td style="background-color:antiquewhite;"></td>
                            </tr>
                            <tr>
                                <td>Distributor Commission</td>
                                <td> 637 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Service Provider Payments </td>
                                <td> 637 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td><b>Total Expenses D</b></td>
                                <td>50,805</td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td><b>Gross Profit E=C-D</b></td>
                                <td><b>50,805</b></td>
                                <td><b>xxx</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-box">
                    <h3 style="margin-left:10px;padding-top:30px;"><b>Cash Flow</b></h3>
                    <table class="custom-table booking-manage" id="dataTables_filter2">
                        <thead>
                            <tr>
                                <th hidden>sorting serial</th>
                                <th>Particulars</th>
                                <th>Selected Date Range</th>
                                <th>YTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sales (A) (Services Received)</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Credit Notes (B) (Cancelled Services)</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Net sales C=A-B</td>
                                <td> 50,805 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td style="background-color:antiquewhite;"><b>Expenses</b></td>
                                <td style="background-color:antiquewhite;"></td>
                                <td style="background-color:antiquewhite;"></td>
                            </tr>
                            <tr>
                                <td>Distributor Commission</td>
                                <td> 637 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td>Service Provider Payments </td>
                                <td> 637 </td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td><b>Total Expenses D</b></td>
                                <td>50,805</td>
                                <td>xxx</td>
                            </tr>
                            <tr>
                                <td><b>Net Cash Inflow/ (Outflow)</b></td>
                                <td><b>50,805</b></td>
                                <td><b>xxx</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ======== MODAL POPUPS ======== -->

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
        <!-- The Create Modal -->
        <div class="modal" id="createnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Create New</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                        <input id="valid_uploadimg" type="hidden">
                        <label class="uploadfile" for="uploadimg">
                            <input type="file" id="uploadimg" accept="image/jpeg,image/png">
                            <img id="display_uploadimg" src="assets_new/amenities/upload.png" alt="">
                            <p class="upladpara">Upload </p>
                        </label>
                        </div>
                        <div class="input-amety">
                        <h6>Amenity Name</h6>
                        <input type="text" id="amenityname" name="" placeholder="Smoke Area">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn createamenity">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Edit Modal -->
        <div class="modal" id="editnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                        <input id="valid_edit_uploadimg" type="hidden">
                        <label class="uploadfile" for="edit_uploadimg">
                            <input type="file" id="edit_uploadimg" accept="image/jpeg,image/png">
                            <img id="display_edit_uploadimg" src="assets_new/amenities/upload.png" alt="">
                            <p class="upladpara">Upload </p>
                        </label>
                        </div>
                        <div class="input-amety">
                        <h6>Amenity Name</h6>
                        <input type="text" id="edit_amenityname" name="" placeholder="Smoke Area">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updateamenity">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!-- js file -->
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="js/header.js"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <!-- <script src="js/S3config_uploadfunc.js?v=<?php echo $js_cache_string; ?>"></script> -->
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var example = flatpickr('#flatpickr,#flatpickr2');
    </script>
    <script src="js/function.js"></script>
    <script>
        $("#from_date").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        $("#to_date").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        function drpDownbtnClick (file){
            if(file == 'pdf'){
                $('#dataTables_filter1_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
                $('#dataTables_filter2_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
            }
            if(file == 'csv'){
                $('#dataTables_filter1_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
                $('#dataTables_filter2_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
            }

        }
        function formatDate(date) {
                    let [day,month,year] = date.split('-');
                    return [year, month, day].join('-');

        }
    </script>
    <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            let onloadfromDate = $('#from_date').val();
            let onloadtoDate = $('#to_date').val();
            fetchmisfinancereports(onloadfromDate,onloadtoDate);
        });
        function fetchmisfinancereports(fromdate,todate){
            let datas = {
                            "adminToken":adminToken,
                            "fromDate":fromdate,
                            "toDate":todate
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/reports/misFinance.php",
                    data: json1
                    }).done(function(data1) {
                        let profitLossObject = data1.ProfitLoss;
                        let cashFlowObject = data1.CashFlow;
                        let profitLossReport = '';
                        let cashFlowReport = '';
                        profitLossReport += `<tr>
                                                <td hidden valign="top">1</td>
                                                <td>Sales (Services Received)</td>
                                                <td> ${profitLossObject.salesInMonth} </td>
                                                <td>${profitLossObject.salesInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">2</td>
                                                <td>Credit Notes (Cancelled Services)</td>
                                                <td>${profitLossObject.creditNotesInMonth}</td>
                                                <td>${profitLossObject.creditNotesInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">3</td>
                                                <td>Net sales </td>
                                                <td>${profitLossObject.netSalesInMonth}</td>
                                                <td>${profitLossObject.netSalesInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">4</td>
                                                <td style="background-color:antiquewhite;"><b>Expenses</b></td>
                                                <td style="background-color:antiquewhite;"></td>
                                                <td style="background-color:antiquewhite;"></td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">5</td>
                                                <td>Distributor Commission</td>
                                                <td>${profitLossObject.distributorCommissionInMonth}</td>
                                                <td>${profitLossObject.distributorCommissionInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">6</td>
                                                <td>Service Provider Payments </td>
                                                <td> ${profitLossObject.serviceProviderPaymentInMonth} </td>
                                                <td>${profitLossObject.serviceProviderPaymentInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">7</td>
                                                <td><b>Total Expenses </b></td>
                                                <td>${profitLossObject.totalExpensesInMonth}</td>
                                                <td>${profitLossObject.totalExpensesInYear}</td>
                                            </tr>
                                            <tr>
                                            <td hidden valign="top">8</td>
                                                <td><b>Gross Profit</b></td>
                                                <td><b>${profitLossObject.grossProfitInMonth}</b></td>
                                                <td><b>${profitLossObject.grossProfitInYear}</b></td>
                                            </tr>`;

                        $("#dataTables_filter1 tbody").html(profitLossReport);
                        $("#dataTables_filter1").DataTable().destroy();
                        $("#dataTables_filter1 tbody").html(profitLossReport);
                        $("#dataTables_filter1").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            order: [[0, 'asc']],
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Profit Loss Reports',
                                    exportOptions: {
                                                        columns: [1,2,3],
                                                    },
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A3',
                                    exportOptions: {
                                                        columns: [1,2,3],
                                                    },
                                    title: 'Profit Loss Reports'
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
                        }).draw();
                        $("#loading").hide(); //Main Loader Close

                        cashFlowReport += `<tr>
                                            <td hidden valign="top">1</td>
                                            <td>Sales (Services Received)</td>
                                            <td>${cashFlowObject.salesInMonth}</td>
                                            <td>${cashFlowObject.salesInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">2</td>
                                            <td>Credit Notes (Cancelled Services)</td>
                                            <td>${cashFlowObject.creditNotesInMonth}</td>
                                            <td>${cashFlowObject.creditNotesInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">3</td>
                                            <td>Net sales </td>
                                            <td>${cashFlowObject.netSalesInMonth}</td>
                                            <td>${cashFlowObject.netSalesInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">4</td>
                                            <td style="background-color:antiquewhite;"><b>Expenses</b></td>
                                            <td style="background-color:antiquewhite;"></td>
                                            <td style="background-color:antiquewhite;"></td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">5</td>
                                            <td>Distributor Commission</td>
                                            <td> ${cashFlowObject.distributorCommissionInMonth}</td>
                                            <td>${cashFlowObject.distributorCommissionInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">6</td>
                                            <td>Service Provider Payments </td>
                                            <td> ${cashFlowObject.serviceProviderPaymentInMonth} </td>
                                            <td>${cashFlowObject.serviceProviderPaymentInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">7</td>
                                            <td><b>Total Expenses </b></td>
                                            <td>${cashFlowObject.totalExpensesInMonth}</td>
                                            <td>${cashFlowObject.totalExpensesInYear}</td>
                                        </tr>
                                        <tr>
                                        <td hidden valign="top">8</td>
                                            <td><b>Net Cash Flow</b></td>
                                            <td><b>${cashFlowObject.grossProfitInMonth}</b></td>
                                            <td><b>${cashFlowObject.grossProfitInYear}</b></td>
                                        </tr>`;
                        $("#dataTables_filter2 tbody").html(cashFlowReport);
                        $("#dataTables_filter2").DataTable().destroy();
                        $("#dataTables_filter2 tbody").html(cashFlowReport);
                        $("#dataTables_filter2").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            order: [[0, 'asc']],
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    exportOptions: {
                                                        columns: [1,2,3],
                                                    },
                                    title: 'Cash Flow Reports'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    exportOptions: {
                                                        columns: [1,2,3],
                                                    },
                                    orientation: 'landscape',
                                    pageSize: 'A3',
                                    title: 'Cash Flow Reports'
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
                        }).draw();
                        $("#loading").hide(); //Main Loader Close
                    });
        }

        $('body').on('click','.daterangefilter',function(){
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            let formattedFromDate = formatDate(fromDate);
            let formattedToDate = formatDate(toDate);
            let fromfullDate = new Date(formattedFromDate);//to get valid date format to compare dates
            let tofullDate = new Date(formattedToDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate && fromDate != '' && toDate != ''){
                
                fetchmisfinancereports(fromDate,toDate);
            }else{
                    swal("Enter Valid Date Range")
            }
        });
    </script>
</body>
</html>