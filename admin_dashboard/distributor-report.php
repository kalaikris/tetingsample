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
                <h1 class="header_main">Distributor Commision Reports</h1>
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
            <div class="table-box">
                <table class="custom-table booking-manage" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Customer Name</th>
                            <th>Distributor Name</th>
                            <th>Date of Booking</th>
                            <th>Booking Reference</th>
                            <th>Service Reference</th>
                            <th>Service Completion Status</th>
                            <th>Service Completion Date</th>
                            <th>Cancelled Date</th>
                            <th>Agent Name</th>
                            <th>Taxable value of Services Provided</th>
                            <th>GST</th>
                            <th>Total</th>
                            <th>Commission %</th>
                            <th>Commission Payable</th>
                            <th>Gst on Commission</th>
                            <th>Total Commission Payable including GST</th>
                            <th>Markup Type</th>
                            <th>Total Markup</th>
                            <th>Markup Discount</th>
                            <th>Net Markup Post Discount</th>
                            <th>GST On  Distributor Markup</th>
                            <th>Taxable value of Distributor Markup</th>
                            <th>Taxable Value of Agent Conv fee</th>
                            <th>GST</th>
                            <th>Total Agent Convinience Fee</th>
                            <th>Taxable value of commission & Markup Payable to Distributor</th>
                            <th>GST</th>
                            <th>Total Commission & Mark Up Payable</th>
                            <th>Membership Id</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
            }
            if(file == 'csv'){
                $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
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
            fetchdistributorcommissionreport(onloadfromDate,onloadtoDate);
        });

        function fetchdistributorcommissionreport(fromdate,todate){
            let datas = {
                            "adminToken":adminToken,
                            "fromDate":fromdate,
                            "toDate":todate
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/reports/distributorCommissionReport.php",
                    data: json1
                    }).done(function(data1) {
                        let distributorCommissionReportArray = data1.report;
                        let reportlist = '';
                        distributorCommissionReportArray.forEach((reports,index) => {
                            reportlist += `<tr>
                                            <td>${index + 1}</td>
                                            <td>${reports.customerName}</td>
                                            <td>${reports.serviceDistributorName}</td>
                                            <td>${reports.dateTime}</td>
                                            <td>${reports.bookingRef}</td>
                                            <td>${reports.serviceRef}</td>
                                            <td>${reports.status}</td>
                                            <td>${reports.serviceCompletedDate}</td>
                                            <td>${reports.cancelledDate}</td>
                                            <td>${reports.agentName}</td>
                                            <td>${reports.excludeGstValue}</td>
                                            <td>${reports.gstValue}</td>
                                            <td>${reports.totalValue}</td>
                                            <td>${reports.distPercentage}%</td>
                                            <td>${reports.distCommisionValue}</td>
                                            <td>${reports.gstDistCommisionValue}</td>
                                            <td>${reports.totalCommissionValueIncGst}</td>
                                            <td>${reports.markup_percentage}</td>
                                            <td>${reports.markup_amount}</td>
                                            <td>${reports.markup_discount}</td>
                                            <td>${reports.net_markup_post_dis}</td>
                                            <td>${reports.gst_distributor_markup}</td>
                                            <td>${reports.taxable_val_distributor_markup}</td>
                                            <td>${reports.agent_conv_fee}</td>
                                            <td>${reports.agent_conv_fee_GST}</td>
                                            <td>${reports.total_agent_conv_fee}</td>
                                            <td>${reports.taxable_value_comm_markup}</td>
                                            <td>${reports.gst_value_comm_markup}</td>
                                            <td>${reports.total_value_comm_markup}</td>
                                            <td>${reports.membershipId}</td>
                                        </tr>`;
                        });
                        $("#dataTables_filter").DataTable().destroy();
                        $("#dataTables_filter tbody").html(reportlist);
                        $("#dataTables_filter").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            processing:true,
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Distributor Commission Reports'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A1',
                                    title: 'Distributor Commission Reports'
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
                
                fetchdistributorcommissionreport(fromDate,toDate);
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