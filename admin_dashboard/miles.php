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
                <h1 class="header_main">Miles</h1>
            </div>
            <div class="table-box">
                <table class="custom-table mileslisttable" id="dataTables_filter">
                    <thead>
                        <tr>
                            <th>Sl.No</th>
                            <th>User type</th>
                            <th>Miles type</th>
                            <th>Amount</th>
                            <th>Miles</th>
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
                        <div class="input-amety">
                            <h6>Miles</h6>
                            <input class="edit_miles" type="text" name="" placeholder="Enter Miles">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                        <button type="button" class="modal_btn creat_modal_btn updatemiles">Update</button>
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
        fetchmileslist(); 
    });

    function fetchmileslist(){
        let datas = {
                        "adminToken":adminToken
                    };
        let json1 = JSON.stringify(datas);
        $.ajax({
        dataType: "JSON",
        type: "POST",
        url: apiPath+"/masterData/milesList.php",
        data: json1
        }).done(function(data1) {
            let milesarray = data1.data;
            let milesList = '';
            milesarray.forEach((list,index) => {
            milesList += `<tr>
                                <td>${index + 1}</td>
                                <td>${list.userType}</td>
                                <td>${list.milesType}</td>
                                <td>${list.amount}</td>
                                <td>${list.miles}</td>
                                <td><a data-id="${list.id}" data-amount="${list.amount}" data-miles="${list.miles}" href="#" class="view_link editmiles" data-toggle="modal" data-target="#editnow">Edit</a></td>
                            </tr>`;
            });
            $('.mileslisttable tbody').html(milesList);
            $(".mileslisttable").DataTable({
                dom: 'Bfrtip',
                initComplete: function() {
                    $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                },
                buttons: [
                        {
                            extend: 'csvHtml5',
                            title: 'Miles List',
                            exportOptions: {
                                                columns: [0,1,2,3,4],
                                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Miles List',
                            exportOptions: {
                                                columns: [0,1,2,3,4],
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

    $('body').on('click','.editmiles',function(){
        let id = $(this).attr('data-id');
        let amount = $(this).attr('data-amount');
        let miles = $(this).attr('data-miles');
        $('.edit_amount').val(amount);
        $('.edit_miles').val(miles);
        $('.updatemiles').attr('data-id',id)
    });

    $('body').on('click','.updatemiles',function(){
        let id = $(this).attr('data-id');
        let amount = $('.edit_amount').val();
        let miles = $('.edit_miles').val();
        if(amount != "" && miles != "" ){
            let datas = {
                            "adminToken":adminToken,
                            "id":id,
                            "amount":amount,
                            "miles":miles
                        };
            let json1 = JSON.stringify(datas);
                $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/updateMiles.php",
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
            if(amount == ""){
                swal("Amount cannot be blank")
            }
            if(miles == ""){
                swal("Miles cannot be blank")
            }
        }
    });

    $('body').on('click','.deleteagenttype',function(){
        let typeToken = $(this).attr('data-token');
        swal({
                title: "Are you sure?",
                text: "Do you want to delete the Agent Type?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
        }).then((willDelete)=>{
            if(willDelete){
                let datas = {
                            "adminToken":adminToken,
                            "typeToken":typeToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/masterData/deleteAgentType.php",
                data: json1
                }).done(function(data1) {
                    if(data1.status_code == 201){
                        swal("Deleted!", {icon: "success",}).then((value) => {
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
        });
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