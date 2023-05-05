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
        <title>problem_report</title>
        <link rel="shortcut icon" href="./asset/airportzo-icon.png">

        <!-- datepicker style -->
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/bootstrap-icons.css">
        <link rel="stylesheet" href='./css/bootstrap-datetimepicker.css'>
        <!-- datepicker style-end -->
        <!-- boostrap-popup-link-->
        <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
        <link rel="stylesheet" href="./css/fonts.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="./css/commen.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="./css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="./css/problem_report.css?v=<?php echo $cur_date_time; ?>">
</head>
<body id="page">
    <div id="loading"></div>
    <header id="header"></header>
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar"></div>
            <div class="slider-desc-set">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">New problem reports</li>
                    <li class="tab-link" data-tab="tab-2">Problem report history</li>
                </ul>
                <div class="underline"></div>
                <div id="tab-1" class="tab-content current">
                    <div class="new-problem">
                        <h1>New problem reports</h1>
                    </div>
                    <table id="new_problem_reportTable" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Report on </th>
                                <th>Reason</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="tab-2" class="tab-content">
                    <div class="staf-common">
                        <div class="problem-report">
                            <div class="problem-report-inner">
                                <img src="./asset/triangle.png" alt="">
                            </div>
                            <div class="problem-header">
                                <h1 id="total_problem_report"></h1>
                                <p>problem report</p>
                            </div>
                        </div>
                        <div class="reported-common">
                            <div class="on-time">
                                <ul class="on-time-inner">
                                    <li class="staf-time">Staff was not on time</li>
                                    <li class="staf-time">Quality of service was poor</li>
                                    <li class="staf-time">Others</li>
                                </ul>
                            </div>
                            <div class="on-time">
                                <ul class="on-time-inner">
                                    <li>-</li>
                                    <li>-</li>
                                    <li>-</li>
                                </ul>
                            </div>
                            <div class="on-time">
                                <ul class="on-time-inner">
                                    <li class="on-time-inner-list" id="staff_report_count">reported</li>
                                    <li class="on-time-inner-list" id="quality_of_service">reported</li>
                                    <li class="on-time-inner-list" id="totalpayment_count">reported</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="new-problem-inner">
                        <h1>Problem report history</h1>
                    </div>
                    <table id="problem_report_historyTable" class="" style="width: 100%;">
                        <thead>
                            <tr>
                            <th>Order ID</th>
                            <th>Reported on</th>
                            <th>Reason </th>
                            <th>Description</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <script src='js/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <!-- boostrap-popup-link -->
    <script src="js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="js/data-table-js/dataTables.dateTime.min.js"></script>
    <!-- date picker -->
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <!-- sidebar-heder -->
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    var apiPath = "<?php echo $apiPath; ?>";
    $(document).ready(function () {
        $('#problems-peported').addClass('actives');
        var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
        serviceprovider_sidemenu(staff_token);
    });
    
    fetch_data();
    var table;
    var table1;
    function fetch_data(){
        var ServiceCompanyToken = localStorage.getItem('service_provider_company_token')
        if(ServiceCompanyToken == null){
            var Company_Token = localStorage.getItem('dummy_service_companytoken');
        }else{
            var Company_Token = localStorage.getItem('service_provider_company_token');
        }
        var ServiceAirportToken = localStorage.getItem('service_provider_airport_token')
        if(ServiceAirportToken == null){
            var Airport_Token = localStorage.getItem('dummy_service_airporttoken');
        }else{
            var Airport_Token = localStorage.getItem('service_provider_airport_token');
        }
        table = $("#new_problem_reportTable").DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':apiPath+"/provider/newReportedProblems.php?airportToken="+Airport_Token+"&&companyToken="+Company_Token,
                'dataSrc': function(data) {
                        return data.aaData;
                    }
                },
            "order": [[0, "DESC" ]],
            'columns': [
                { data: 'booking_number' },
                { data: 'reportedDate' },
                { data: 'reason' },
                { data: 'description' }
            ],
            dom: 'Bfrtip',
            language: {
                search: '<img src="asset/svg/search@2x.png">', searchPlaceholder: "Search" ,
                paginate: {
                    next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
                    previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
                }
            }
        });
        $('#new_problem_reportTable_wrapper').find('input[type=search]').val('');
        $('#new_problem_reportTable_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');

        table1 = $("#problem_report_historyTable").DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':apiPath+"/provider/reportHistory.php?airportToken="+Airport_Token+"&&companyToken="+Company_Token,
                'dataSrc': function(data) {
                        $("#total_problem_report").html(data.totalProblems);
                        $("#staff_report_count").html(data.reportCount1);
                        $("#quality_of_service").html(data.reportCount2);
                        $("#totalpayment_count").html(data.reportCount3);
                        return data.aaData;
                    }
                },
            "order": [[0, "DESC" ]],
            'columns': [
                { data: 'booking_number' },
                { data: 'reportedDate' },
                { data: 'reason' },
                { data: 'description' }
            ],
            dom: 'Bfrtip',
            language: {
                search: '<img src="asset/svg/search@2x.png">', searchPlaceholder: "Search" ,
                paginate: {
                    next: '<img src="asset/svg/Right_arrow_icon.svg">', // or '→'
                    previous: '<img src="asset/svg/Left_arrow_icon.svg">' // or '←'  <img src="path/to/arrow.png">'
                }
            }
        });
        $('#problem_report_historyTable_wrapper').find('input[type=search]').val('');
        $('#problem_report_historyTable_wrapper').find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
    }

    $(document).ready(function () {
        $("ul.tabs li").click(function () {
            var tab_id = $(this).attr("data-tab");

            $("ul.tabs li").removeClass("current");
            $(".tab-content").removeClass("current");

            $(this).addClass("current");
            $("#" + tab_id).addClass("current");
        });
    });

    function service_provider_list(){
        table.clear();
        table.destroy();

        table1.clear();
        table1.destroy();
        fetch_data();
    }
    </script>
</body>
</html>
<?php
}
?>