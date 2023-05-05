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
    <title>Booking Managament</title>
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
    <div class="sidebar" id="sidebar13"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Internal Bookings</h1>
                <p class="total_emp total">Total Bookings - 23</p>
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
                            <th>Booking Number</th>
                            <th>Booking Channel</th>
                            <th>Journey Locations</th>
                            <th>Customer Name</th>
                            <th>Lead Passenger</th>
                            <th>Other Passenger</th>
                            <th>Greeter</th>
                            <th>No of Passengers</th>
                            <th>Booking Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment ID</th>
                            <th>Cancellation</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                               <p></p> 
                               <p></p>
                               <p></p>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <p></p>
                                <p></p>
                            </td>
                            <td>
                                <p></p>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
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
            //date: new Date(),
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
            fetchinternalbooking(onloadfromDate,onloadtoDate);
        });
        function fetchinternalbooking(fromdate,todate){
            let datas = {
                            "adminToken":adminToken,
                            "fromDate":fromdate,
                            "toDate":todate
                        };
                        console.log(datas);
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/booking/backendBookingManagement.php",
                    data: json1
                    }).done(function(data1) {
                        let internalBookingArray = data1.data;
                        $('.total').text(`Total Bookings - ${internalBookingArray.length}`);
                        let bookinglist = '';
                        internalBookingArray.forEach((bookings,index) => {
                            let contactdetails = '';
                            let otherContactDetails = '';
                            let greeterDetails = '';
                            let actionBtnContent = '';
                            if(bookings.status == 'Draft'){
                                actionBtnContent = `<a href="#" onclick="confirmdraftbooking(this,'${bookings.bookingToken}')">Confirm</a>`;
                            }
                                
                            // }else{
                            //     actionBtnContent = `<a href="#" onclick="">Resend Payment Link</a>`
                            // }
                            bookings.passengers.forEach((contact,index1) => {
                                if(contact.passengerType == "Contact"){
                                    contactdetails = `<div>
                                                        <p>${contact.passengerName}</p>
                                                        <p></p>
                                                                           <p>${contact.passengerNumber}</p>
                                                                 <p>${contact.passengerEmail}</p>
                                                     </div>`;
                                }
                                if(contact.passengerType == "Others"){
                                    otherContactDetails += `<div>
                                                                <p>${contact.passengerName}-</p> 
                                                                <p>${contact.passengerNumber};</p>
                                                            </div>`;
                                }
                                if(contact.passengerType == "Greeter"){
                                    greeterDetails = `<div>
                                                        <p>${contact.passengerName}-</p> 
                                                        <p>${contact.passengerNumber};</p>
                                                    </div>`;
                                }
                            });
                            bookinglist += ` <tr>
                                                <td>${index + 1}</td>
                                                <td>${bookings.bookingNumber}</td>
                                                <td>${bookings.bookingChannel}</td>
                                                <td>${bookings.journey}</td>
                                                <td>${bookings.customerName}</td>
                                                <td>${contactdetails}</td>
                                                <td>${otherContactDetails}</td>
                                                <td>${greeterDetails}</td>
                                                <td>${bookings.noOfPassenger}</td>
                                                <td>${bookings.bookingDateTime}</td>
                                                <td>${bookings.totalAmount}</td>
                                                <td>${bookings.status}</td>
                                                <td>${bookings.paymentId}</td>`;
                                                if(bookings.paymentId != '' && bookings.orderId != ''){
                                bookinglist +=      `<td><a href="javascript:void(0)">Payment Done</a></td>`;
                                                }else{
                                bookinglist +=      `<td><a href="#" onclick="cancelBooking('${bookings.bookingToken}','${bookings.plinkId}')">Cancel</a></td>`;  
                                                }
                            bookinglist +=      `<td>${actionBtnContent}</td>
                                            </tr>`;
                        });
                        $("#dataTables_filter tbody").html(bookinglist);
                        $("#dataTables_filter").DataTable().destroy();
                        $("#dataTables_filter tbody").html(bookinglist);
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
                                    title: 'Admin Internal Booking'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'A2',
                                    title: 'Admin Internal Booking'
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
            fromDate = formatDate(fromDate);
            toDate = formatDate(toDate);
            let fromfullDate = new Date(fromDate);//to get valid date format to compare dates
            let tofullDate = new Date(toDate); //to get valid date format to compare dates
            if(fromfullDate <= tofullDate && fromDate != '' && toDate != ''){
                
                fetchinternalbooking(fromDate,toDate);
            }else{
                    swal("Enter Valid Date Range")
            }
        });

        function confirmdraftbooking(clickedElement,bookingToken){
            let datas = {
                            "adminToken":adminToken,
                            "bookingToken":bookingToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/booking/confirmDraftBooking.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"success",

                                    }).then(()=>{
                                        location.reload();
                                    });
                        }else{
                                swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"warning",

                                    });
                        }
                    });
        }

        function cancelBooking(bookingToken,plinkId){
            let datas = {
                            "adminToken":adminToken,
                            "bookingToken":bookingToken,
                            "plinkId":plinkId
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/booking/cancelBackendBooking.php",
                    data: json1
                    }).done(function(data1) {
                        if(data1.status_code == 201){
                            swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"success",

                                    }).then(()=>{
                                        location.reload();
                                    });
                        }else{
                                swal({
                                        title:data1.title,
                                        text:data1.message,
                                        icon:"warning",

                                    });
                        }
                    });
        }
    </script>
</body>
</html>
<?php
}
?>