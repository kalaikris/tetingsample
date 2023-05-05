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
    <title>Service Partners</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/common.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/master_data.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="sweetalert-master/dist/sweetalert.css<?php echo $js_cache_string; ?>" rel="stylesheet">
</head>
<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">
    </header>
    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar4"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white full-height" id="toggle3">
            <div class="header-details">
                <h1 class="header_main">Cancellation Charge</h1>
            </div>
            <div class="table-box">
                <table class="custom-table cancelchargestable" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- EDIT NOW MODAL -->
        <div class="modal" id="editnow" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-center">Edit</h4>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="input-amety">
                            <h6>Amount</h6>
                            <input class="edit_amount" type="text" name="" placeholder="Enter Amount">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updatecancelcharge">Update</button>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <script src="js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js file -->
    <script src="js/header.js"></script>
    <script src="js/sidebar.js?v=999"></script>
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/function.js"></script>
    <script>
    var example = flatpickr('#flatpickr,#flatpickr2');
    /* Radion button box */
    $('.ratio-btn-selecter').on('click', function() {
        debugger
        var quickcheck = $(this).attr('data-value');
        if (quickcheck == "image") {
            $('input[name=radio_btn_option][value="image"]').attr('checked', 'checked');
            $('.popup-image-box').removeClass('hidden');
            $('.popup-video-box').addClass('hidden');
        } else {
            $('input[name=radio_btn_option][value="video"]').attr('checked', 'checked');
            $('.popup-image-box ').addClass('hidden');
            $('.popup-video-box').removeClass('hidden');
        }
    })
    var apiPath = "<?php echo $apiPath; ?>";
    $(document).ready(() => {
        fetchcancelcharges(); 
    });

    function fetchcancelcharges(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
        dataType: "JSON",
        type: "POST",
        url: apiPath+"/masterData/cancelChargeDetail.php",
        data: json1
        }).done(function(data1) {
            let cancellationchargeobject = data1.data;
            let cancellationchargelist = '';
                cancellationchargelist += `<tr>
                                        <td>1</td>
                                        <td>${cancellationchargeobject.cancelCharge}</td>
                                        <td><a href="#"  data-cancelcharge="${cancellationchargeobject.cancelCharge}" class="view_link editcancelcharges" data-toggle="modal" data-target="#editnow">Edit</a></td>
                                    </tr>`;
            $('.cancelchargestable tbody').html(cancellationchargelist);
            $(".cancelchargestable").DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                buttons: [
                        {
                            extend: 'csvHtml5',
                            title: 'Cancellation Charges List',
                            exportOptions: {
                                                columns: [0,1,2],
                                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Cancellation List',
                            exportOptions: {
                                                columns: [0,1,2],
                                            },
                        }
                    ],
                language: {
                    search: '<img src="./assets_new/main/Search.png">',
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<img style="width:18px;" src="assets_new/arrow-right.png?v=123">', // or '→'
                        previous: '<img style="width:18px;" src="assets_new/arrow-left.png?v=123">' // or '←'  <img src="path/to/arrow.png">'
                    }
                }
            });
            $("#loading").hide();
        });
    }

    $('body').on('click','.editcancelcharges',function(){
        let cancelCharge = $(this).attr('data-cancelcharge');
        $('.edit_amount').val(cancelCharge);
    });

    $('body').on('click','.updatecancelcharge',function(){
        let cancelCharge = $('.edit_amount').val();
        if(cancelCharge != ""){
            let datas = {
                            "adminToken":adminToken,
                            "cancelCharge":cancelCharge,
                        };
            let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/updateCancelCharge.php",
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
        }else{
            swal("Cancel Charges cannot be blank")
        }
    });

    function drpDownbtnClick (file){
        if(file == 'pdf'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-pdf.buttons-html5').click();
        }
        if(file == 'csv'){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
        }
    }

</script>
</body>
</html>
<?php
}
?>