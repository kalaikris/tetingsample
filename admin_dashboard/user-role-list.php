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
    <title>Role and Access</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/user-roles.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
</head>
<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header"></header>
    <!-- sidebar -->

    <div class="sidebar" id="sidebar9"></div>
    <!-- main-contents -->
    <main class="main-contents">
        <section class="bg-white brad-4 full-height" id="employee" >
            <div class="product_header_container">
                <div class="header-details ">
                   <h1 class="header_main">User List </h1>
                   <p class="total_emp total">Total Users -<span>12</span></p>
                </div>
            </div>
           
            <!-- Nav tabs -->
            <ul class="nav nav-pills product_list mb-3" id="pills-tab" role="tablist">
                <li class="nav-item " role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-toggle="modal" data-target="#createuser"><span><img class="" src="assets/icons/add_employee.png" alt=""></span>Add User</button>
                </li>
                <li class="nav-item">
                <button class="nav-link csvbutton" type="button">Download CSV</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent" >
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table userlist" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>User Name</th>
                                <th>Email Address</th>
                                <th>Access Type</th>
                                <th>Created on</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#" class="edituser" data-toggle="modal" data-target="#edituser">Edit</a><a class="deleteuser" href="#">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>
    
    <!-- create now modal -->
    <div class="modal" id="createuser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add User</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="modal_input-container">
                        <div class="input__box">
                            <label class="form__label">Username</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="username" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Email Address</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="email" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Access Type</label>
                            <select name="" id="userrole" class="form__select">
                                <option value="Admin">Admin</option>
                                <option value="Provider">Provider</option>
                            </select>
                        </div> 
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
                    <button type="button" class="modal_btn creat_modal_btn createuser">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div class="modal" id="edituser">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit User</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="modal_input-container">
                        <div class="input__box">
                            <label class="form__label">Username</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_username" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Email Address</label>
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_email" class="form__input">
                        </div>
                        <div class="input__box">
                            <label class="form__label">Access Type</label>
                            <select name="" id="editrole" class="form__select">
                                <option value="Admin">Admin</option>
                                <option value="Provider">Provider</option>
                            </select>
                        </div>  
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Close</button>
                    <button type="button" class="modal_btn creat_modal_btn updateuser">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <!--    datepicker-->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> 
    <!-- jquery CDN -->
    <script src="js/bootstrap.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
    <!-- datatable -->
    <script src="js/datatables.min.js"></script>
    <!-- js file -->
    <script src="js/header.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="js/sidebar.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/function.js?v=<?php echo $js_cache_string; ?>"></script>
    <script>
        let apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            fetch_users();
            fetch_roles();
            $('#username').attr("autocomplete","off");
        });

        setTimeout(clearSearchValue, 1000);

        function clearSearchValue() {
            $('#username').val('');
        }

        function fetch_users(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/admin/userList.php",
                            data: json1
                          }).done(function(data1) {
                                let userListArray = data1.data;
                                $('.total').text(`Total Users - ${userListArray.length}`)
                                let userlist = '';
                                userListArray.forEach((user,index) => {
                                    userlist += `<tr>
                                                    <td>${index + 1}</td>
                                                    <td>${user.userName}</td>
                                                    <td>${user.emailId}</td>
                                                    <td>${user.roleName}</td>
                                                    <td>${user.createdDate}</td>
                                                    <td><a href="#" data-token="${user.userToken}" data-email="${user.emailId}" data-name="${user.userName}" data-roletoken="${user.roleToken}" class="edituser" data-toggle="modal" data-target="#edituser">Edit</a><a data-token="${user.userToken}" class="deleteuser" href="#">Delete</a></td>
                                                </tr>`;
                                    
                                });
                                $('.userlist tbody').html(userlist);
                                $('.userlist').DataTable({
                                                            dom: 'Bfrtip',
                                                            initComplete: function() {
                                                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                                                            },
                                                            buttons: [
                                                                {
                                                                    extend: 'csvHtml5',
                                                                    title: 'Admin UserList',
                                                                    exportOptions: {
                                                                                    columns: [0,1,2,3,4],
                                                                                },
                                                                },
                                                                {
                                                                    extend: 'pdfHtml5',
                                                                    orientation: 'landscape',
                                                                    pageSize: 'LEGAL',
                                                                    title: 'Admin UserList',
                                                                    exportOptions: {
                                                                                    columns: [0,1,2,3,4],
                                                                                },
                                                                }
                                                            ],
                                                            language: {
                                                                search: '<img src="./assets_new/main/Search.png">', searchPlaceholder: "Search" ,
                                                                paginate: {
                                                                    next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                                                    previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                                                                }
                                                            }
                                                        });
                                                        $("#loading").hide(); //Main Loader Close
                          });
        }

        function fetch_roles(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
                    $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/roles/userRoleList.php",
                            data: json1
                          }).done(function(data1) {
                                    let userRoleArray = data1.roleData;
                                    let adminuserrole = '<option value="0">Select Role</option>';

                                    userRoleArray.forEach((rolelist,index) => {
                                        
                                        adminuserrole += `<option value="${rolelist.roleToken}">${rolelist.roleName}</option>`;
                                    });

                                    $('#userrole').html(adminuserrole);
                                    $('#editrole').html(adminuserrole);

                                    
                                })
        }

        function isEmail(email) {
                    let mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return mailFormat.test(email);
	    }

        $('body').on('click','.createuser',function(){
            let userName = $('#username').val();
            let userEmail = $('#email').val();
            let userRoleToken = $('#userrole').val();

            if(userName != '' && userEmail != '' && isEmail(userEmail)  && userRoleToken != 0 ){

                    let datas = {
                                    "adminToken":adminToken,
                                    "userName": userName,
                                    "userEmail": userEmail,
                                    "userRoleToken": userRoleToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/admin/addUser.php",
                            data: json1
                            }).done(function(data1) {

                                if(data1.status_code == 201){

                                    swal({
                                        title:"Success!!",
                                        text:data1.message,
                                        icon:"success",

                                    }).then(function(){
                                        location.reload();
                                    });


                                }else{

                                    swal({
                                        title:"Oops!!!",
                                        text:data1.message,
                                        icon:"warning",

                                    });

                                }

                            })

                }else{
                    swal("Enter Valid inputs in all Fields");
                }


        });


        $('body').on('click','.edituser',function(){
            let usertoken = $(this).attr('data-token');
            let name = $(this).attr('data-name');
            let email = $(this).attr('data-email');
            let roletoken = $(this).attr('data-roletoken');

            $('.updateuser').attr('data-token',usertoken);
            $('#edit_username').val(name);
            $('#edit_email').val(email);
            $('#editrole').val(roletoken);

            
            
        });

        $('body').on('click','.updateuser',function(){

            let userToken =  $(this).attr('data-token');
            let userName = $('#edit_username').val();
            let userEmail = $('#edit_email').val();
            let userRoleToken = $('#editrole').val();

            if(userName != '' && userEmail != '' && isEmail(userEmail)  && userRoleToken != 0 ){

                    let datas = {
                                    "adminToken":adminToken,
                                    "userToken": userToken,
                                    "userName": userName,
                                    "userEmail": userEmail,
                                    "userRoleToken": userRoleToken
                                };
                    let json1 = JSON.stringify(datas);
                    $.ajax({
                            dataType: "JSON",
                            type: "POST",
                            url: apiPath+"/admin/updateUser.php",
                            data: json1
                            }).done(function(data1) {

                                if(data1.status_code == 201){

                                    swal({
                                        title:"Success!!",
                                        text:data1.message,
                                        icon:"success",

                                    }).then(function(){
                                        location.reload();
                                    });


                                }else{

                                    swal({
                                        title:"Oops!!!",
                                        text:data1.message,
                                        icon:"warning",

                                    });

                                }

                            })

                }else{
                    swal("Enter Valid inputs in all Fields");
                }



        })


        $('body').on('click','.deleteuser',function(){

            let userToken = $(this).attr('data-token');
            let status = "3"

            swal({
                    title: "DELETE",
                    text: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        let data = {
                                        "adminToken": adminToken,
                                        "userToken": userToken,
                                        "status":status
                                   }

                        let json_data = JSON.stringify(data);
                        $.ajax({
                                type: "POST",
                                dataType: "json",
                                url : `${apiPath}/admin/blockDeleteUser.php`,
                                data: json_data,
            
                              }).done(function(data){
                                if(data.status_code == 201){
                                    swal({
                                        title:"Success",
                                        text:data.message,
                                        icon:"success",

                                    }).then(function(){
                                        location.reload();
                                    });
                                }
                            })
                                    
                    } else {
                        swal("Delete Cancelled!");
                    }
                });

        })

        $('body').on('click','.csvbutton',function(){
            $('#dataTables_filter_wrapper').find('.btn.btn-secondary.buttons-csv.buttons-html5').click();
        });
    </script>

</body>
</html>
<?php
}
?>