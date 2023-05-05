<?php
    session_start();
    include_once '../config/core.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>user_role</title>
       <link rel="shortcut icon" href="./asset/airportzo-icon.png">
        <!-- boostrap-popup-link-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
        <!-- boostrap-popup-link-->
        <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
        <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
        <link rel="stylesheet" href="./css/commen.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="./css/fonts.css?v=<?php echo $cur_date_time; ?>" />
        <link rel="stylesheet" href="./css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>"/>
        <link rel="stylesheet" href="./css/user_role.css?v=<?php echo $cur_date_time; ?>"/>
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
        <link href="css/sweet_alert.min.css" rel="stylesheet">
        <!-- font -->
        <style>
        /* custon sidemenu drop down */
        .sub-product{
        }
        .sub-product label{
            width: 100%;
        }
        .Service-items{
            padding-right: 15px;
            position:relative;
        }
        .Service-items:after{
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        .Service-items-desc{
            width:100%;
        }
        .Service-sub-items{
            height: 0px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
        }
        .Service-sub-items li:not(:last-child){
            border-bottom: 1px solid #dfdede;
        }
        .Service-item{
            font: 13px/15px var(--font-regular);
            display: block;
            padding: 5px 6px;
            color: #000000b3 !important;
        }
        .Service-item:hover{
            background-color: #dbe3e5;
            color: #000;
        }
        .accodiant-radio{
            display:none;
        }
        .accodiant-radio:checked ~ .Service-sub-items{
            height: auto;
            opacity: 1;
            visibility: visible;
            transition: .5s;
            border-radius: 4px;
            padding: 0px 0px;
            background: #eff3f4;
            box-shadow: 1px 1px 7px 0px #eff3f445;
            margin: 5px 0px;
        }
        .accodiant-radio:checked ~ .Service-items:after{
            transform: rotate(180deg);
            transition: .5s;
        }
        /* -=======- */
        </style>
    </head>
    <body id="page">
         <div id="loading"></div>
        <header id="header"></header>
        <main>
            <div class="flex-main-set">
                <div class="slider-set" id="sidebar"></div>
                <div class="slider-desc-set">
                    <!-- <div class="underline"></div> -->
                    <div class="header-user-common">
                        <div class="inner-user">
                            <h1>User roles and access</h1>
                        </div>
                        <div class="create-common-btn">
                            <button tybe="button" class="user-button" data-toggle="modal" data-target="#exampleModalCenter"><img src="asset/svg/user_roles_white.svg" alt=""/>Create Role</button>
                        </div>
                    </div>
                    <table id="UserRoleList" class="" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Role Token</th>
                                <th>Role Name</th>
                                <th>Module Token</th>
                                <th>Access Permission</th>
                                <th>Created On</th>
                                <th>Edit Status</th>
                                <th>Logged Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="UserRoleBody"></tbody>
                    </table>
                </div>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered another-two-two" role="document">
                        <div class="modal-content another-two-one">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Create Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-form-group-item user-role-input">
                                    <div class="input-box-set">
                                        <label for="roleName" class="roleName">Role Name</label>
                                        <input type="text" id="roleName" placeholder="Role Name"/>
                                    </div>
                                </div>
                                <div class="user-access-list">
                                    <h4>User Access</h4>
                                    <ul id="moduleListId"></ul>
                                </div>
                                <div class="choose-dash-app">
                                    <div>
                                        <input type="radio" name="type" value="0" checked onchange="module_access()">
                                        <label>Dashboard</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="type" value="1" id="resetradio"  onchange="module_access()">
                                        <label>App</label>
                                    </div>
                                </div>
                                <div class="role-button">
                                    <button class="role-btn" id="createRoleButton" onclick="createRole()">Create Role</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="edit_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Edit Role</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-inner-body">
                                    <input id="roleTokenEdit" type="hidden">
                                    <input id="loggedtype" type="hidden">
                                    <div class="input-form-group-item">
                                        <div class="input-box-set">
                                            <label class="roleNameEdit" for="roleNameEdit">User Role Name</label>
                                            <input type="text" id="roleNameEdit" placeholder="Role Name">
                                        </div>
                                    </div>
                                    <div class="underline"></div>
                                    <div id="access_modal">
                                        <h4>User Access</h4>
                                        <ul id="moduleListIdEdit"></ul>
                                    </div>
                                </div>
                                <div class="role-button">
                                    <button class="role-btn" id="updateRoleButton" onclick="updateRole()">Update Role</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- boostrap-popup-link -->
        <script src="js/jquery-3.6.0.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
        <!-- boostrap-popup-link -->
        <script src="js/data-table-js/jquery.dataTables.min.js"></script>
        <script src="js/data-table-js/dataTables.searchBuilder.min.js"></script>
        <script src="js/data-table-js/dataTables.dateTime.min.js"></script>
        <!-- sidebar-heder -->
        <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time?>"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        var apiPath = "<?php echo $apiPath; ?>";
        $(document).ready(() => {
            $("#user-access").addClass("actives");
            var staff_token = "<?php echo $_COOKIE['staff_token']; ?>";
            serviceprovider_sidemenu(staff_token);
        });
        
        var table;
        data_fetch();
        function data_fetch(){
            var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            if(service_provider_companylocation_token == null){
            var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
            }else{
            var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
            }
            var datas = {'serviceProviderCompanyLocationToken':companylocation_token};
            var JsonData = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/provider/userRoleList.php",
                data: JsonData,
            }).done(function (data) {
                if(data.status_code==201){
                    var modules = data.moduleData;
                    var htmlText = "";
                    var htmlTextEdit = "";
                    for (var key in modules) {
                        htmlText += '<li>';
                        htmlText += '<label for="module'+key+'">';
                        htmlText += '<input type="checkbox" name="modules" id="module'+key+'" value="'+modules[key].moduleToken+'" />';
                        htmlText += '<p>'+modules[key].moduleName+'</p>';
                        htmlText += '</label>';
                        htmlText += '</li>';
                        htmlTextEdit += '<li>';
                        htmlTextEdit += '<label for="moduleEdit'+key+'">';
                        htmlTextEdit += '<input type="checkbox" name="modulesEdit" id="moduleEdit'+key+'" value="'+modules[key].moduleToken+'" />';
                        htmlTextEdit += '<p>'+modules[key].moduleName+'</p>';
                        htmlTextEdit += '</label>';
                        htmlTextEdit += '</li>';
                    }
                    $("#moduleListId").html(htmlText);
                    $("#moduleListIdEdit").html(htmlTextEdit);

                    var userroledata = data.roleData;
                    var htmlText = "";
                    for (var key in userroledata) {
                        htmlText += '<tr>';
                        htmlText += '<td>'+userroledata[key].roleToken+'</td>';
                        htmlText += '<td>'+userroledata[key].roleName+'</td>';
                        htmlText += '<td>'+userroledata[key].moduleToken+'</td>';
                        htmlText += '<td>'+userroledata[key].moduleName+'</td>';
                        htmlText += '<td>'+userroledata[key].createdDate+'</td>';
                        htmlText += '<td>'+userroledata[key].editstatus+'</td>';
                        if(userroledata[key].isMobileApp=="0"){
                            htmlText += '<td>'+'Dashboard'+'</td>';
                        }else{
                            htmlText += '<td>'+'App'+'</td>';
                        }
                        htmlText += '<td>';
                        htmlText += '<div class="">';
                        htmlText += '<a href="javascript:void(0)" class="edit_userRole"><img src="asset/edit.png" alt=""></a>';
                        htmlText += '<a href="javascript:void(0)" class="delete_userRole"><img src="asset/delete.png" alt=""></a>';   
                        htmlText += '</div>';
                        htmlText += '</td>';
                        htmlText += '</tr>';
                    }
                    $("#UserRoleBody").html(htmlText);
                    table = $("#UserRoleList").DataTable({
                        'dom': 'Bfrtip',
                        'order': [[1, "asc" ]],
                        'language': {
                            search: '<img src="asset/svg/Search_icon.svg">', searchPlaceholder: "Search" ,
                            paginate: {
                                next: '<img src="asset/svg/Right_arrow_icon.svg">',
                                previous: '<img src="asset/svg/Left_arrow_icon.svg">'
                            }
                        }
                    });
                    table.column(0).visible(false);
                    table.column(2).visible(false);
                    table.column(5).visible(false);
                }else{
                    swal({
                        title: "Error!",
                        text: data.message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            });
        }

        function createRole(){
            $('#createRoleButton').prop('disabled', true);
            var roleName = $("#roleName").val();
            if(roleName!=''){
                var val1 = true;
                $("#roleName").css("border","1px solid #E5E5E5");
                $(".roleName").css("color","#9ca9bb");
            }else{
                var val1 = false;
                $(".user-role-input").css("border","1px solid #ff0000");
                $(".roleName").css("color","#ff0000");
            }
            var modules = [];
            $('input[name="modules"]:checked').each(function(){
                modules.push(this.value);
            });
            var type = $("input[name='type']:checked").val();
            if(val1 && modules.length!=0 && type=="0"){
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderCompanyLocationToken' : companylocation_token,
                    'userRoleName': roleName,
                    'isMobileApp':'0',
                    'modulesTokenArray': modules
                };
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/addUserRole.php",
                    data: jsonData,
                }).done(function (data){
                    if(data.status_code==201){
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        }).then((value)=>{
                            location.reload();
                        });
                        // $('#resetradio').prop("checked", true);
                    }else{
                        $('#createRoleButton').prop('disabled', false);
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            }else if(val1 && type=="1"){
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderCompanyLocationToken' : companylocation_token,
                    'userRoleName': roleName,
                    'isMobileApp':'1',
                    'modulesTokenArray': modules
                };
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/addUserRole.php",
                    data: jsonData,
                }).done(function (data){
                    if(data.status_code==201){
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        }).then((value)=>{
                            location.reload();
                        });
                        $('#resetradio').prop("checked", true);
                    }else{
                        $('#createRoleButton').prop('disabled', false);
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            }else{
                $('#createRoleButton').prop('disabled', false);
                if(!val1){
                    var message = "Please Enter Role Name!";
                    swal({
                        title: "Error!",
                        text: message,
                        icon: "error",
                        button: "Ok",
                    });
                }else if(type=="0"){
                    var message = "Please Select Modules!";
                    swal({
                        title: "Error!",
                        text: message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            }
        }

        function module_access(){
            var type = $("input[name='type']:checked").val();
            if(type=="0"){
                $('#moduleListId').show();
                $('.user-access-list').show();
            }else{
                var checkboxes = document.getElementsByName('modules');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
                $('#moduleListId').hide();
                $('.user-access-list').hide();
            }
        }

        function updateRole(){
            $('#updateRoleButton').prop('disabled', true);
            var userRoleToken  = $("#roleTokenEdit").val();
            var userRoleName   = $("#roleNameEdit").val();
            var userloggedtype = $("#loggedtype").val();
            if(userRoleName!=""){
                var val1 = true;
                $("#roleNameEdit").css("border","1px solid #E5E5E5");
                $(".roleNameEdit").css("color","#9ca9bb");
            }else{
                var val1 = false;
                $("#roleNameEdit").css("border","1px solid #ff0000");
                $(".roleNameEdit").css("color","#ff0000");
            }
            var modules = [];
            $('input[name="modulesEdit"]:checked').each(function() {
                modules.push(this.value);
            });
            if(val1 && modules.length!=0 && userloggedtype=="0"){
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderCompanyLocationToken':companylocation_token,
                    'userRoleToken': userRoleToken,
                    'userRoleName': userRoleName,
                    'isMobileApp': userloggedtype,
                    'modulesTokenArray': modules
                };
                console.log(datas);
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/updateUserRole.php",
                    data: jsonData,
                }).done(function (data) {
                    if(data.status_code==201){
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        }).then((value) => {
                            location.reload();
                        });
                    }else{
                        $('#updateRoleButton').prop('disabled', false);
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            }else if(val1 && userloggedtype=="1"){
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderCompanyLocationToken':companylocation_token,
                    'userRoleToken': userRoleToken,
                    'userRoleName': userRoleName,
                    'isMobileApp': userloggedtype,
                    'modulesTokenArray': modules
                };
                console.log(datas);
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/updateUserRole.php",
                    data: jsonData,
                }).done(function (data) {
                    if(data.status_code==201){
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        }).then((value) => {
                            location.reload();
                        });
                    }else{
                        $('#updateRoleButton').prop('disabled', false);
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            }
            else{
                $('#updateRoleButton').prop('disabled', false);
                if(!val1){
                    var message = "Please Enter Role Name!";
                    swal({
                        title: "Error!",
                        text: message,
                        icon: "error",
                        button: "Ok",
                    });
                }else if(userloggedtype=="0"){
                    var message = "Please Select Modules!";
                    swal({
                        title: "Error!",
                        text: message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            }
        }

        $('#UserRoleList tbody').on('click', '.delete_userRole', function () {
        var td_div = $(this).parent().parent();
        var table_data = table.row(td_div).data();
        var userRoleToken  = table_data[0];
        var editStatus = table_data[5];
        if(editStatus==1){
        swal({
            title: "Are you sure?",
            text: "You want to delete this role?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var service_provider_companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                if(service_provider_companylocation_token == null){
                    var companylocation_token = localStorage.getItem('dummy_service_provider_company_locationToken');
                }else{
                    var companylocation_token = localStorage.getItem('service_provider_company_locationToken');
                }
                var datas = {
                    'serviceProviderCompanyLocationToken':companylocation_token,
                    'userRoleToken': userRoleToken
                };
                var jsonData = JSON.stringify(datas);
                $.ajax({
                    dataType: "JSON",
                    type: "POST",
                    url: apiPath+"/provider/deleteUserRole.php",
                    data: jsonData,
                }).done(function (data) {
                    if(data.status_code==201){
                    swal({
                        title: "Success!",
                        text: data.message,
                        icon: "success",
                        button: "Ok",
                    }).then((value) => {
                        location.reload();
                    });
                    }else{
                        swal({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                });
            }
        });
        }else{
            swal({
                title: "Error!",
                text: "You Can't Delete Super Admin",
                icon: "error",
                button: "Ok",
            });
        }
        });

        $('#UserRoleList tbody').on( 'click', '.edit_userRole', function () {
            var td_div = $(this).parent().parent();
            var table_data = table.row( td_div ).data();
            var roleToken  = table_data[0];
            var editStatus = table_data[5];
            var loggedtype = table_data[6];
            if(loggedtype=="App"){
                var logged_type = "1";
                $('#moduleListIdEdit').hide();
                $('#access_modal').hide();
            }else{
                var logged_type = "0";
                $('#moduleListIdEdit').show();
                $('#access_modal').show();
            }
            if(editStatus==1){
                var moduleToken= table_data[2];
                var roleName   = table_data[1];
                var moduleTokens = moduleToken.split(",");
                $("#roleTokenEdit").val(roleToken);
                $("#roleNameEdit").val(roleName);
                $("#loggedtype").val(logged_type);
                $('input[name="modulesEdit"]').each(function() {
                    var value = this.value;
                    if(jQuery.inArray(value, moduleTokens) !== -1){
                        $(this).prop( "checked", true );
                    }else{
                        $(this).prop( "checked", false );
                    }
                });
                $("#edit_role").modal('show');
            }else{
                swal({
                    title: "Error!",
                    text: "You can't edit Super admin",
                    icon: "error",
                    button: "Ok",
                });
            }
        });

        function service_provider_list(){
            table.clear();
            table.destroy();
            data_fetch();
        }
        </script>
    </body>
</html>
<?php
}
?>