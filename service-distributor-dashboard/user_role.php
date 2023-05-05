<?php
include_once '../config/core.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user_role</title>
    <link rel="icon" type="image/png" href="./asset/img/airportzo-icon.png">
    <!-- boostrap-popup-link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!-- boostrap-popup-link-->
    <link rel="stylesheet" href="./js/data-table-css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/searchBuilder.dataTables.min.css" />
    <link rel="stylesheet" href="./js/data-table-css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="./css/fonts.css?v=<?php echo $cur_date_time; ?>" />
    <link rel="stylesheet" href="./css/header-sidemenu.css?v=<?php echo $cur_date_time; ?>" />
    <link rel="stylesheet" href="./css/custom.css?v=<?php echo $cur_date_time; ?>" />
    <link rel="stylesheet" href="./css/user_role.css?v=<?php echo $cur_date_time; ?>" />
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
    <!-- font -->
</head>

<body id="page">
    <div id="loading"></div>
    <header id="header">
    </header>
    <main>
        <div class="flex-main-set">
            <div class="slider-set" id="sidebar">
            </div>
            <div class="slider-desc-set">
                <!-- <div class="underline"></div> -->
                <div class="header-user-common">
                    <div class="inner-user">
                        <h1>User roles and access</h1>
                    </div>
                    <div class="create-common-btn">
                        <button tybe="button" class="user-button" data-toggle="modal" data-target="#exampleModalCenter">
                            <img src="./asset/menu_icons/user_roles_white.svg" alt="" width="22"> Create Role </button>
                    </div>
                </div>
                <table id="userrole" class="" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Access Permission</th>
                            <th>Created on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin</td>
                            <td>All modules</td>

                            <td>
                                01 Jul,2022<br />
                                <p>12:52PM</p>
                            </td>
                            <td>
                                <ul class="user-edit">
                                    <li><img src="./asset/edit.png" alt=""></li>
                                    <li><img src="./asset/delete.png" alt=""></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Inventory Manager</td>
                            <td>Inventory Module</td>

                            <td>
                                28 Jun,2022<br />
                                <p>10:26 AM</p>
                            </td>
                            <td>
                                <ul class="user-edit">
                                    <li><img src="./asset/edit.png" alt=""></li>
                                    <li><img src="./asset/delete.png" alt=""></li>
                                </ul>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>

            <!-- ========== MODAL POPUPS ========== -->

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered another-two-two" role="document">
                    <div class="modal-content another-two-one">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="role">
                                <p>Role Name</p>
                                <input type="text" name="firstname" id="firstname" placeholder="Admin">
                            </div>



                            <div class="check_box">
                                <!-- <form action="#" class="moduleform"> -->
                                    <div class="check-box-header">
                                        <p>Choose access permission for the role</p>
                                    </div>
                                    <div class="check-box-inner">
                                        <input class="checkbox-Access" type="checkbox" id="Access" name="Access"
                                            value="Access">
                                        <label class="checkbox-label" for="Access">Access to all</label><br>
                                    </div>
                                    <div class="create_check_box"></div>
                                <!-- </form> -->
                            </div>




                            <div class="role-button">
                                <button type="button" class="role-btn createrole">Create Role</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered another-two-two" role="document">
                    <div class="modal-content another-two-one">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="role">
                                <p>Role Name</p>
                                <input type="text" name="updatename" id="updatename" placeholder="Admin">
                            </div>



                            <div class="check_box">
                                <!-- <form action="#" class="moduleform"> -->
                                    <div class="check-box-header">
                                        <p>Choose access permission for the role</p>
                                    </div>
                                    <div class="check-box-inner">
                                        <input class="checkbox-Access" type="checkbox" id="edit_Access" name="Access"
                                            value="Access">
                                        <label class="checkbox-label" for="edit_Access">Access to all</label><br>
                                    </div>
                                    <div class="edit_check_box">
                                        <div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access" type="checkbox" id="Dashboard" name="Dashboard"
                                                value="Dashboard">
                                            <label class="checkbox-label" for="Dashboard"> Dashboard</label><br>
                                        </div>
                                        <div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access" type="checkbox" id="Booking" name="Booking"
                                                value="Booking">
                                            <label class="checkbox-label" for="Booking"> Booking Orders</label><br>
                                        </div>
                                        <div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access" type="checkbox" id="Staffs" name="Staffs"
                                                value="Staffs">
                                            <label class="checkbox-label" for="Staffs">My Staffs</label><br>
                                        </div>
                                        <div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access" type="checkbox" id="Manage" name="Manage"
                                                value="Manage">
                                            <label class="checkbox-label" for="Manage">Manage Inventory</label><br>
                                        </div>
                                        <div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access" type="checkbox" id="Reports" name="Reports"
                                                value="Reports">
                                            <label class="checkbox-label" for="Reports"> Reports and Analutics</label><br>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                            <div class="role-button">
                                <button type="button" class="role-btn updaterole">Update Role</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- boostrap-popup-link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- boostrap-popup-link -->
    <script src="./js/jquery-3.6.0.js"></script>
    <script src="./js/data-table-js/jquery.dataTables.min.js"></script>
    <script src="./js/data-table-js/dataTables.searchBuilder.min.js"></script>
    <script src="./js/data-table-js/searchBuilder.bootstrap4.min.js"></script>
    <script src="./js/data-table-js/dataTables.dateTime.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- sidebar-heder -->
    <script src="./js/heder-sidebar.js<?php echo $js_cache_string; ?>"></script>
    <script>
        $(document).ready(function () {
            $('#user-access').addClass('actives');
            // $("#userrole").DataTable({
            //     "searching": false,
            //     language: {
            //         search: '<img class="b_img" src="./asset/svg/search@2x.png">',
            //         searchPlaceholder: "Search...",
            //     },
            //     buttons: [
            //         {
            //             extend: "searchBuilder",
            //             config: {
            //                 depthLimit: 2,
            //             },
            //         },
            //     ],
            //     dom: "Bfrtip",
            //     columnDefs: [
            //         {
            //             type: "unknownType",
            //             targets: [3],
            //         },
            //     ],
            // });
        });




    </script>
    <script>
        let apiPath = "<?php echo $apiPath; ?>";
        
        $(document).ready(() => {
                fetch_roles();
        });

        
        // fetch Roles and modules
        function fetch_roles(){
            let data = {
                "serviceDistributorToken": distributorToken
            }
            let json_data = JSON.stringify(data);
            $.ajax({
                type: "POST",
                dataType: "json",
                url : `${apiPath}/roles/userRoleList.php`,
                data: json_data,
                success: rolelist,
                error:errorcheck,
            });

        }

        function errorcheck(e,r,j){
            console.log(e.status);
            console.log(r);
            console.log(j);
        }

        let moduleDataArray = [];
        let userRoleArray = [];

        function rolelist(data){
                moduleDataArray = data.moduleData;
                userRoleArray = data.roleData;
            let userRole = ``;
            let moduleList = ``;
            let moduleEditList = ``;
                userRoleArray.forEach((roledetails,index) => {

                    userRole += `<tr>
                                    <td>${roledetails.roleName}</td>
                                    <td>${roledetails.moduleName}</td>

                                    <td>
                                    ${roledetails.createdDate}<br/>
                                        
                                    </td>
                                    <td>
                                        <ul class="user-edit">
                                            <li data-roletoken="${roledetails.roleToken}" data-rolename="${roledetails.roleName}" data-modtoken="${roledetails.moduleToken}"  class="editrole" data-toggle="modal" data-target="#edit_modal"><img src="./asset/edit.png" alt=""></li>
                                            <li data-roletoken="${roledetails.roleToken}" class="deleterole"><img src="./asset/delete.png" alt=""></li>
                                        </ul>
                                    </td>
                                </tr>`;
                });

                moduleDataArray.forEach((moddetails,index) => {
                    if(moddetails.moduleToken == "3JNTL7CGGP" && isAgent == 0){
                        moduleList += `<div class="check-box-inner" hidden>
                                        <input class="checkbox-Access create_checkbox-access" type="checkbox" id="${moddetails.moduleToken}" name="${moddetails.moduleName}"
                                            value="${moddetails.moduleToken}">
                                        <label class="checkbox-label" for="${moddetails.moduleToken}">${moddetails.moduleName}</label><br>
                                   </div>`;

                        moduleEditList += `<div class="check-box-inner" hidden>
                                            <input class="checkbox-Access edit_checkbox-access ${moddetails.moduleToken}" type="checkbox" id="${moddetails.moduleName}" name="${moddetails.moduleName}"
                                                value="${moddetails.moduleToken}">
                                            <label class="checkbox-label" for="${moddetails.moduleName}">${moddetails.moduleName}</label><br>
                                       </div>`

                    }else{
                        moduleList += `<div class="check-box-inner">
                                        <input class="checkbox-Access create_checkbox-access" type="checkbox" id="${moddetails.moduleToken}" name="${moddetails.moduleName}"
                                            value="${moddetails.moduleToken}">
                                        <label class="checkbox-label" for="${moddetails.moduleToken}">${moddetails.moduleName}</label><br>
                                   </div>`;

                    moduleEditList += `<div class="check-box-inner">
                                            <input class="checkbox-Access edit_checkbox-access ${moddetails.moduleToken}" type="checkbox" id="${moddetails.moduleName}" name="${moddetails.moduleName}"
                                                value="${moddetails.moduleToken}">
                                            <label class="checkbox-label" for="${moddetails.moduleName}">${moddetails.moduleName}</label><br>
                                       </div>`;

                    }

                   
                    
                });


            $('.create_check_box').html(moduleList);
            $('.edit_check_box').html(moduleEditList);    
            $('#userrole tbody').html(userRole);
            $("#userrole").DataTable({
                
                language: {
                    search: '<img class="b_img" src="./asset/svg/search@2x.png">',
                    searchPlaceholder: "Search...",
                },
                buttons: [
                    {
                        extend: "searchBuilder",
                        config: {
                            depthLimit: 2,
                        },
                    },
                ],
                dom: '<Bfr<"table-container"t>ip>',
                scrollX: true,
                columnDefs: [
                    {
                        type: "unknownType",
                        targets: [3],
                    },
                ],
            });
            $('body').on('change','.create_checkbox-access',function(){
                if(!$(this).is(':checked')){
                    $("#Access").prop('checked',false);
                }else{
                    if(isAgent == 0){
                        if($(".create_check_box input[type=checkbox]:checked").length == ($(".create_checkbox-access").length - 1)){

                            $("#Access").prop('checked',true);

                        }

                    }else{
                        if($(".create_check_box input[type=checkbox]:checked").length == $(".create_checkbox-access").length){
                            $("#Access").prop('checked',true);
                        }
                    }
                    
                }
            })

            $('body').on('change','.edit_checkbox-access',function(){
                if(!$(this).is(':checked')){
                    $("#edit_Access").prop('checked',false);
                }else{
                    if(isAgent == 0){
                        if($(".edit_check_box input[type=checkbox]:checked").length == ($(".edit_checkbox-access").length - 1)){

                            $("#edit_Access").prop('checked',true);

                        }

                    }else{
                        if($(".edit_check_box input[type=checkbox]:checked").length == $(".edit_checkbox-access").length){
                            $("#edit_Access").prop('checked',true);
                        }
                    }
                    
                }
            })

        }

        $('body').on('change','#Access',function(){
            if(isAgent == 1){
                if($(this).is(':checked')){
                    $(".create_checkbox-access").prop('checked',true);
                }else{
                    $(".create_checkbox-access").prop('checked',false)
                }
            }else{
                if($(this).is(':checked')){
                    $(".create_checkbox-access").prop('checked',true);
                    $('#3JNTL7CGGP').prop('checked',false);
                }else{
                    $(".create_checkbox-access").prop('checked',false);
                    $('#3JNTL7CGGP').prop('checked',false);
                }
            }
        })

        $('body').on('change','#edit_Access',function(){
            if(isAgent == 1){
                if($(this).is(':checked')){
                    $(".edit_checkbox-access").prop('checked',true);
                }else{
                    $(".edit_checkbox-access").prop('checked',false)
                }
            }else{
                if($(this).is(':checked')){
                    $(".edit_checkbox-access").prop('checked',true);
                    $('.3JNTL7CGGP').prop('checked',false);
                }else{
                    $(".edit_checkbox-access").prop('checked',false);
                    $('.3JNTL7CGGP').prop('checked',false);
                }
            }
        })
        //Create a Role
        $('body').on('click','.createrole',function(){
            let userRoleName = $('#firstname').val();
            let modulesTokenArray = [];
            $(".create_check_box input[type=checkbox]:checked").each((index,selectedmodule)=>{
                let moduleToken = $(selectedmodule).val();
                modulesTokenArray.push(moduleToken);
            });
            if(userRoleName != '' && modulesTokenArray != [] ){

            let data = {
                            "serviceDistributorToken": distributorToken,
                            "userRoleName": userRoleName,
                            "modulesTokenArray":modulesTokenArray
                       }

            let json_data = JSON.stringify(data);
            $.ajax({
                type: "POST",
                dataType: "json",
                url : `${apiPath}/roles/addUserRole.php`,
                data: json_data,
                success: function(data){
                    if(data.status_code == 201){

                        swal({
                            title:"Success!!",
                            text:"Role Created Successfully",
                            icon:"success",

                        }).then(function(){
                            location.reload();
                        });


                    }else{

                        swal({
                            title:"Oops!!!",
                            text:data.message,
                            icon:"warning",

                        });

                    }
                    
                },
                error:errorcheck,

                
            });

            }else{
                swal("Give rolename and select atleast one access")
            }
            

        });

        //On edit click- Setting values for edit-modal for update
        $('body').on('click','.editrole',function(){
            let roleName = $(this).attr('data-rolename');
            let roleToken = $(this).attr('data-roletoken');
            let selectedModuletoken = $(this).attr('data-modtoken');
            let selectedModuleTokenArray = selectedModuletoken.split(','); //setting module token as array
            
            $('#updatename').val(roleName);                     // setting name in edit modal
            $('.updaterole').attr('data-roletoken',roleToken); //setting roletoken in update button
            $('.edit_checkbox-access').prop('checked',false);  // clearing checkboxes in edit modal
            $('#edit_Access').prop('checked',false);

            //setting checkboxes of already set modules
            selectedModuleTokenArray.forEach((selectedtoken,index) => {
                moduleDataArray.forEach((moduledata,index) => {

                    if (selectedtoken == moduledata.moduleToken) {
                        $(`.${selectedtoken}`).prop('checked',true);
                        
                    }

                    
                });
                
            });

        });

        
        //Update rolename and access
        $('body').on('click','.updaterole',function(){

            let userRoleToken = $(this).attr('data-roletoken');
            let userRoleName = $('#updatename').val();
            let modulesTokenArray = [];  

            $(".edit_check_box input[type=checkbox]:checked").each((index,selectedmodule)=>{
                let moduleToken = $(selectedmodule).val();
                modulesTokenArray.push(moduleToken);
            });

            if(userRoleName != '' && modulesTokenArray != [] ){


                let data = {
                            "serviceDistributorToken": distributorToken,
                            "userRoleToken": userRoleToken,
                            "userRoleName": userRoleName,
                            "modulesTokenArray":modulesTokenArray
                       }

                let json_data = JSON.stringify(data);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url : `${apiPath}/roles/updateUserRole.php`,
                    data: json_data,
                    success: function(data){
                        
                        if(data.status_code == 201){

                            swal({
                                title:"Success!!",
                                text:"Role Updated Successfully",
                                icon:"success",

                            }).then(function(){
                                location.reload();
                            });


                        }else{

                            swal({
                                title:"Oops!!!",
                                text:data.message,
                                icon:"warning",

                            });

                        }
                        
                    },
                    error:errorcheck,

                    
                });



            }else{
                swal("Give rolename and select atleast one access")
            }



        })

        //Delete a Role
        $('body').on('click','.deleterole',function(){
            let userRoleToken = $(this).attr("data-roletoken");
            swal({
                    title: "DELETE",
                    text: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        let data = {
                                        "serviceDistributorToken": distributorToken,
                                        "userRoleToken": userRoleToken
                                   }

                        let json_data = JSON.stringify(data);
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url : `${apiPath}/roles/deleteUserRole.php`,
                            data: json_data,
                            success: function(data){
                                console.log('data');
                                console.log(data);
                                if(data.status_code == 201){
                                    swal({
                                        title:"Success",
                                        text:data.message,
                                        icon:"success",

                                    }).then(function(){
                                        location.reload();
                                    });
                                }
                            },
                            error:errorcheck,
                        })
                                    
                    } else {
                        swal("Delete Cancelled!");
                    }
                });
        })
    </script>
</body>

</html>