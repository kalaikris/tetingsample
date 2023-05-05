<?php
    session_start();
    include_once '../config/core.php';
    if(isset($_COOKIE['azAdmin_Token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelled Bookings</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css?v=<?php echo $js_cache_string; ?>" />
    <!-- data table link -->
    <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/booking-mng.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css?v=<?php echo $js_cache_string; ?>" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_filter input{
            border: none;
        }
    </style>
</head>

<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar13"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Cancelled Bookings</h1>
                <p class="total_emp total">Total Bookings - <span id="totalBookingCount"></span></p>
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
                            <th>Order ID</th>
                            <th>Booking ID</th>
                            <th>Booked on</th>
                            <th>Cancelled on</th>
                            <th>Cancelled By</th>
                            <th>Service avail on</th>
                            <th>package</th>
                            <th>Service Cost</th>
                            <th>Cancelled before</th>
                            <th>Cancelled Fee</th>
                            <th>Payment Status</th>
                            <th>Refund Amount</th>
                            <th>Refund Date</th>
                            <th>Initiate Refund</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
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
        <!-- The Modal Verify User -->
        <div class="modal" id="verifyModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Feedback</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="rating">
                            <h6>Reating</h6>
                            <img src="assets_new/">
                        </div>
                        <div class="rating1">
                            <h6>Review</h6>
                            <p class="common-p">Filium morte multavit si sine dubio praeclara sunt,
                                fecerint, virtutem ils per se esse fugiendum itaque
                                aunt hanc quasi involuta aperiri, altera prompta et
                                impetus quo guaerimus, non emolumento aliquo
                                sed quia dolor sit extremum et benivole collegisti,
                                nec voluptas nulla pariatur? at vero eos.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Okay</button>
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

        <div class="modal" id="refundmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="border:none;">
                        <h4 class="modal-title">Initiate Refund</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input__box" style="width: 80%;margin:0 auto;">
                            <label class="form__label" for="refundreference">Refund Reference Id</label>
                            <input type="text" id="refundreference" placeholder="Reference id" class="form__input">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" style="border:none;"> 
                        <button type="button" class="cust-btn-primary primary-btn" id="updaterefund" data-dismiss="modal">Submit</button>
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
    <!-- <script src="js/datatables.min.js"></script> -->
    <!-- data table js -->
    <script src="js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="js/data-table-js/dataTables.dateTime.min.js"></script>
   <script src="js/data-table-js/dataTables.buttons.min.js"></script>
   <script src="js/data-table-js/pdfmake.min.js"></script>
   <script src="js/data-table-js/vfs_fonts.js"></script>
   <script src="js/data-table-js/buttons.html5.min.js"></script>
    <!-- js file -->
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <!-- <script src="js/S3config_uploadfunc.js?v=<?php echo $js_cache_string; ?>"></script> -->
    <script src="js/aws-sdk.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/function.js"></script>
    <script>
        var example = flatpickr('#flatpickr,#flatpickr2');
        var table;
        $("#from_date").datetimepicker({
            date: `${new Date().getMonth() + 1}-01-${Math.abs(new Date().getFullYear())}`,
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        $("#to_date").datetimepicker({
            date: new Date(),
            ignoreReadonly: true,
            format: "DD-MM-YYYY",
        });
        function drpDownbtnClick (file){
            if(file == 'csv'){
                $('#dataTables_filter_wrapper').find('.dt-button.buttons-csv.buttons-html5.btn-info.buttonprint').click();
            }
            if(file == 'pdf'){
                $('#dataTables_filter_wrapper').find('.dt-button.buttons-pdf.buttons-html5.btn-primary.buttonprint').click();
            }
        }

        function formatDate(date) {
            let [day,month,year] = date.split('-');
            return [year, month, day].join('-');
        }

        var apiPath = "<?php echo $apiPath; ?>";

        $(document).ready(() => {
            let onloadfromDate = $('#from_date').val();
            let onloadtoDate = $('#to_date').val();
            fetchbookinghistory(onloadfromDate,onloadtoDate);
        });
        function fetchbookinghistory(fromdate,todate){
            table = $("#dataTables_filter").DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':apiPath+"/provider/cancelledBookingHistory.php?adminToken="+adminToken+"&&from_date="+fromdate+"&&to_date="+todate,
                    'dataSrc': function(data) {
                        $("#totalBookingCount").html(data.iTotalDisplayRecords);
                        return data.aaData;
                    }
                },
                pageLength: 25,
                lengthMenu: [25,100,500,1000,5000],
                'order': [[0, "DESC" ]],
                'columns': [
                    { data: 'sl_no' },
                    { data: 'token' },
                    { data: 'bookingNumber' },
                    { data: 'dateTime' },
                    { data: 'cancelledDate' },
                    { data: 'cancelledBy'},
                    { data: 'serviceDateTime' },
                    { data: 'serviceName' },
                    { data: 'netAmount' },
                    { data: 'cancellation_hours' },
                    { data: 'cancellation_fee' },
                    { data: 'refundStatus' },
                    { data: 'refundedAmount' },
                    { data: 'refundedDate' },
                    { data: 'refundAction' }
                ],
                dom: 'Bfrltip',
                scrollX: true,
                buttons: [{
                    extend: 'pdfHtml5',
                    className: 'btn-primary buttonprint',
                    orientation: 'landscape',
                    title: 'Cancelled Bookings',
                    pageSize: 'LEGAL'
                },{
                    extend: 'csv',
                    className: 'btn-info buttonprint',
                    orientation: 'landscape',
                    title: 'Cancelled Bookings',
                    pageSize: 'LEGAL'
                }],
                language: {
                    search: '<img src="./assets_new/main/Search.png">', searchPlaceholder: "Search" ,
                    infoFiltered: "",
                    lengthMenu: "Display _MENU_ records per page",
                    paginate: {
                        next: '<img src="assets_new/arrow-right.png">', // or '→'
                        previous: '<img src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                    }
                }
            }).draw();
           $('#dataTables_filter_wrapper').find('.dt-button.buttons-csv.buttons-html5.btn-info.buttonprint').hide();
           $('#dataTables_filter_wrapper').find('.dt-button.buttons-pdf.buttons-html5.btn-primary.buttonprint').hide();
           $('#dataTables_filter_wrapper').find('input[type=search]').val('');
           $('#dataTables_filter_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
           $("#loading").hide(); //Main Loader Close
        }
        
        $('body').on('click','.daterangefilter',function(){
            let fromDate = $('#from_date').val();
            let toDate = $('#to_date').val();
            fromDate = formatDate(fromDate);
            toDate = formatDate(toDate);
            let fromfullDate = new Date(fromDate);//to get valid date format to compare dates
            let tofullDate = new Date(toDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate && fromDate != '' && toDate != ''){
                table.clear();
                table.destroy();
                fetchbookinghistory(fromDate,toDate);
            }else{
                swal("Enter Valid Date Range")
            }
        });

        $('#dataTables_filter tbody').on( 'click', '.refundBtn', function(){
            $('#refundreference').val('');
            var td_div = $(this).parent();
            var table_data = table.row( td_div ).data();
            token = table_data.token;
            $('#updaterefund').attr('data-token',token);
        });

        $('body').on('click','#updaterefund',function(){
            let bookingServiceToken = $(this).attr('data-token');
            let refundId = $('#refundreference').val();
            if(refundId == ''){
                swal('Enter Valid Reference ID')
            }else{
                refundUpdate(bookingServiceToken,refundId);
            }
        });

        function refundUpdate(bookingServiceToken,refundId){
        let datas = {
                        "bookingServiceToken":bookingServiceToken,
                        "refundId":refundId
                    }
        let json1 = JSON.stringify(datas);
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: apiPath+"/provider/providerRefundInitiate.php",
            data: json1
        }).done(function(data1){
            if(data1.status_code == 201){
                location.reload();
            }else{
                swal(data1.message);
            }
        });
    }
    </script>
</body>

</html>
<?php
}
?>