<?php
    include '../config/core.php';
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
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar13"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Membership Management</h1>
                <p class="total_emp total">Total Memberships - 23</p>
            </div>
            <div class="header_btn-container">
                <div>
                    <div class="input__box">
                        <label class="form__label">Service Distributor</label>
                        <select class="form__select" name="" id="">
                            <option value="">name</option>
                            <option value="">name</option>
                            <option value="">name</option>
                        </select>
                    </div>
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
                            <th>Date</th>
                            <th>Member Number</th>
                            <th>Member Name</th>
                            <th>Member Surname</th>
                            <th>Date of Activity</th>
                            <th>Partner Code</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ======== MODAL POPUPS ======== -->


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

    // $("#dataTables_filter").DataTable({
    //     dom: '<Bfr<"table-container"t>ip>',
    //     scrollX: true,
    //     buttons: [
    //         {
    //             extend: 'csvHtml5',
    //             title: 'Admin Booking Management'
    //         },
    //         {
    //             extend: 'pdfHtml5',
    //             orientation: 'landscape',
    //             pageSize: 'LEGAL',
    //             title: 'Admin Booking Management'
    //         }
    //     ],
    //     language: {
    //         search: '<img src="./assets_new/main/Search.png">',
    //         searchPlaceholder: "Search",
    //         paginate: {
    //             next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
    //             previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
    //         }
    //     }
    // });

    </script>
    <script src="js/function.js"></script>
    <script>    

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
</body>

</html>