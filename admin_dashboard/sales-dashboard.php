<?php
    session_start(); 
    include_once '../config/core.php';
    include 'config.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .custom-table thead tr th{
            background-color: #E0EAF5;
        }
        .custom-table tbody tr td{
            background-color: #fff;
        }
        .table-container{
            padding-top: 32px;
            background-color: #f3f7fa;
        }
        .table-box:not(:last-child){
            margin-bottom: 32px;
        }
        .table-box{
            border-bottom: 1px solid var(--dark-gray);
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
                <h1 class="header_main">Reports</h1>
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
                <div class="table-box">
                    <table class="custom-table" cellspacing="5" id="dataTables_filter1">
                        <thead>
                            <tr>
                                 <!-- <th></th>
                                <th></th> -->
                                <th colspan="2"><span></span></th>
                                
                                <!-- <th></th> -->
                                <th colspan="2" style="text-align: center;background-color: antiquewhite;border-left: 1px solid #cbd3d9;border-right: 1px solid #cbd3d9;">For selected Date Range</th>
                                <!-- <th></th> -->
                                <th colspan="2"  style="text-align: center;background-color: antiquewhite;">YTD (Apr to till the selected end date of viewing reports)</th>
                            </tr>
                            <tr>
                                <th>Sl.No</th>
                                <th>Revenue Summary</th>
                                <th> Count ( Nos)</th>
                                <th>Amount (Rs.)</th>
                                <th>Count from Apr ( Nos)</th>
                                <th>Amount from Apr (Rs.)</th>
                            </tr>
                            <tr style="display:none;">
                                <th>Sl.No</th>
                                <th>Revenue Summary</th>
                                <th>Selected period Count ( Nos)</th>
                                <th>Selected period Amount (Rs.)</th>
                                <th>Count from Apr ( Nos)</th>
                                <th>Amount from Apr (Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                             <!-- <tr>
                                <td>Sl.No</td>
                                <td>Revenue Summary</td>
                                <td>Count ( Nos)</td>
                                <td>Amount (Rs.)</td>
                                <td>Count ( Nos)</td>
                                <td>Amount (Rs.)</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Total no of Services received (A)</td>
                                <td>9</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Total no of Services Cancelled (B)</td>
                                <td>3</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Net Revenue (C=A-B)</td>
                                <td>6</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="table-box">
                    <table class="custom-table" cellspacing="5" id="dataTables_filter2">
                        <thead>
                            <tr>
                                <!-- <th></th>
                                <th></th> -->
                                <th colspan="2"><span></span></th>
                                
                                <!-- <th></th> -->
                                <th colspan="2" style="text-align: center;background-color: antiquewhite;border-left: 1px solid #cbd3d9;border-right: 1px solid #cbd3d9;">For selected Date Range</th>
                                <!-- <th></th> -->
                                <th colspan="2"  style="text-align: center;background-color: antiquewhite;">YTD (Apr to till the selected end date of viewing reports)</th>
                            </tr>
                            <tr>
                                <th>Sl.No</th>
                                <th>Cancellation Summary</th>
                                <th>Count ( Nos)</th>
                                <th>Amount (Rs.) </th>
                                <th>Count from Apr ( Nos)</th>
                                <th>Amount from Apr (Rs.)</th>
                            </tr> 
                            <tr style="display:none;">
                                <th>Sl.No</th>
                                <th>Cancellation Summary</th>
                                <th>Selected period Count ( Nos)</th>
                                <th>Selected period Amount (Rs.)</th>
                                <th>Count from April ( Nos)</th>
                                <th>Amount from April (Rs.)</th>
                            </tr>             
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>Sl.No</td>
                                <td>Cancellation Summary</td>
                                <td>Count ( Nos)</td>
                                <td>Amount (Rs.) </td>
                                <td>Count ( Nos)</td>
                                <td>Amount (Rs.)</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Total no of Services Cancelled (B)</td>
                                <td>3</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Total number of Services towards which refund issued</td>
                                <td>9</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Amount to be refunded to Customer (1-2)</td>
                                <td>6</td>
                                <td>50,805</td>
                                <td>XXX</td>
                                <td>XXX</td>
                            </tr> -->
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
            fetchsalesreport(onloadfromDate,onloadtoDate);
        });
        function fetchsalesreport(startDate,endDate){
            let datas = {
                            "adminToken":adminToken,
                            "startDate":startDate,
                            "endDate":endDate
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/reports/salesDashboardReport.php",
                    data: json1
                    }).done(function(data1) {
                        let thisMonthRevenue = data1.thisMonthRevenue;
                        let fromAprilRevenue = data1.fromAprilRevenue;
                        let thisMonthCancellation = data1.thisMonthCancellation;
                        let fromAprilCancellation = data1.fromAprilCancellation;
                        // $('.total').text(`Total Distributor Reports - ${distributorReportArray.length}`);
                        let revenueSummary = ``;
                            revenueSummary += ` <tr>
                                                <td>1</td>
                                                <td>Total no of Services received (A)</td>
                                                <td>${thisMonthRevenue.totalCount}</td>
                                                <td>${thisMonthRevenue.totalAmount_excl_with_conv}</td>
                                                <td>${fromAprilRevenue.totalCount}</td>
                                                <td>${fromAprilRevenue.totalAmount_excl_with_conv}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Total no of Services Cancelled (B)</td>
                                                <td>${thisMonthRevenue.cancelledCount}</td>
                                                <td>${thisMonthRevenue.cancelledAmount}</td>
                                                <td>${fromAprilRevenue.cancelledCount}</td>
                                                <td>${fromAprilRevenue.cancelledAmount}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Net Revenue (C=A-B)</td>
                                                <td>${thisMonthRevenue.netCount}</td>
                                                <td>${thisMonthRevenue.netAmount}</td>
                                                <td>${fromAprilRevenue.netCount}</td>
                                                <td>${fromAprilRevenue.netAmount}</td>
                                            </tr>`;
                        let cancellationSummary = ``;
                            cancellationSummary += ` <tr>
                                                        <td>1</td>
                                                        <td>Total no of Services Cancelled</td>
                                                        <td>${thisMonthCancellation.cancelledCount}</td>
                                                        <td>${thisMonthCancellation.cancelledAmount}</td>
                                                        <td>${fromAprilCancellation.cancelledCount}</td>
                                                        <td>${fromAprilCancellation.cancelledAmount}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Total number of Services towards which refund issued</td>
                                                        <td>${thisMonthCancellation.refundIssuedCount}</td>
                                                        <td>${thisMonthCancellation.refundIssuedAmount}</td>
                                                        <td>${fromAprilCancellation.refundIssuedCount}</td>
                                                        <td>${fromAprilCancellation.refundIssuedAmount}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Amount to be refunded to Customer </td>
                                                        <td>${thisMonthCancellation.netCount}</td>
                                                        <td>${thisMonthCancellation.netAmount}</td>
                                                        <td>${fromAprilCancellation.netCount}</td>
                                                        <td>${fromAprilCancellation.netAmount}</td>
                                                    </tr>`;

                        $("#dataTables_filter1 tbody").html(revenueSummary);
                        $("#dataTables_filter2 tbody").html(cancellationSummary);
                        $("#dataTables_filter1").DataTable().destroy();
                        
                        $("#dataTables_filter2").DataTable().destroy();
                        $("#dataTables_filter1 tbody").html(revenueSummary);
                        $("#dataTables_filter2 tbody").html(cancellationSummary);
                        // $("#dataTables_filter tbody").html(reportlist);
                        $("#dataTables_filter1").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            searching:false,
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Admin Revenue Reports'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A3',
                                    title: 'Admin Revenue Reports'
                                }
                            ],
                            language: {
                                // search: '<img src="./assets_new/main/Search.png">',
                                // searchPlaceholder: "Search",
                                paginate: {
                                    next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                    previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                }
                            }
                        }).draw();
                        $("#dataTables_filter2").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            searching:false,
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Admin Cancellation Reports'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A3',
                                    title: 'Admin Cancellation Reports'
                                }
                            ],
                            language: {
                                // search: '<img src="./assets_new/main/Search.png">',
                                // searchPlaceholder: "Search",
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
                
                fetchsalesreport(fromDate,toDate);
            }else{
                    swal("Enter Valid Date Range")
            }
        });
    </script>
</body>
</html>
<?php
}
?>