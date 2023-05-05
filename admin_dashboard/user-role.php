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
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
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
    <header id="main-dash-header" class="dash-header">      
    </header>

    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar9"></div>
    
    <!-- main-contents -->
    <main class="main-contents">
        

        <section class="bg-white brad-4 full-height" id="employee" >
            <div class="product_header_container">
                <div class="header-details ">
                   <h1 class="header_main">User Role </h1>
                   <p class="total_emp total">Total Roles -<span>12</span></p>
                </div>
            </div>
           
            <!-- Nav tabs -->
            <ul class="nav nav-pills product_list mb-3" id="pills-tab" role="tablist">
                <li class="nav-item " role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-toggle="modal" data-target="#add_role_popup"><span><img class="" src="assets/icons/add_employee.png" alt=""></span>Add Role</button>
                </li>
                <li class="nav-item">
                <button hidden class="nav-link" type="button">Download CSV</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent" >
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table userrole" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>SI.NO</th>
                                <th>User Role Name</th>
                                <th>Module</th>
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
                                <td><a href="javascript:void(0)" data-toggle="modal" data-target="#edit_role_popup">Edit</a><a href="javascript:void(0)">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </main>
    
    <div class="modal fade" id="add_role_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h2>Add Role</h2>
                </div>
                <div class="modal-body">
                    <div class="modal-inner-body">
                        <div class="dev-set">
                            <div class="info-set">
                                <div class="input__box">
                                    <input type="text" id="rolename" class="form__input" placeholder=" ">
                                    <label for="" class="form__label">User role name</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="module-op-set">
                            <p>Modules</p>
                            <div class="module-option mb-3">
                                <label for="select-all" class="selectall-btn">
                                    <input type="checkbox" id="select-all" class="modal-input selectall-input hidden">
                                    <span class="cust-checkbox"></span>
                                    Select All
                                </label>
                            </div>
                            <div class="module-op-filer-set">
                                <div class="module-option">
                                    <label for="user_mng">
                                        <input type="checkbox" id="user_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        User Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="service_prov_mng">
                                        <input type="checkbox" id="service_prov_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Service Provider Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="service_dist_mng">
                                        <input type="checkbox" id="service_dist_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Service Distributor Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="master_data_mng">
                                        <input type="checkbox" id="master_data_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Master Data Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="cat_prod_mang">
                                        <input type="checkbox" id="cat_prod_mang" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Finance Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="user_role_mng">
                                        <input type="checkbox" id="user_role_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        User Based Roles and Access
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="reports_mng">
                                        <input type="checkbox" id="reports_mng" class="modal-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Reports and Analytics
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button class="create-btn create-role">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_role_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Role</h2>
                </div>
                <div class="modal-body">
                    <div class="modal-inner-body">
                        <div class="dev-set">
                            <div class="info-set">
                                <div class="input__box">
                                    <input type="text" id="editrolename" class="form__input" placeholder=" ">
                                    <label for="" class="form__label">User role name</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="module-op-set">
                            <p>Modules</p>
                            <div class="module-option mb-3">
                                <label for="edit_select-all" class="edit-selectall-btn">
                                    <input type="checkbox" id="edit_select-all" class="modal-input edit-selectall-input hidden">
                                    <span class="cust-checkbox"></span>
                                    Select All
                                </label>
                            </div>
                            <div class="module-op-filer-set">
                                <div class="module-option">
                                    <label for="user_mng">
                                        <input type="checkbox" id="user_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        User Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="service_prov_mng">
                                        <input type="checkbox" id="service_prov_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Service Provider Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="service_dist_mng">
                                        <input type="checkbox" id="service_dist_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Service Distributor Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="master_data_mng">
                                        <input type="checkbox" id="master_data_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Master Data Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="cat_prod_mang">
                                        <input type="checkbox" id="cat_prod_mang" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Finance Management
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="user_role_mng">
                                        <input type="checkbox" id="user_role_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        User Based Roles and Access
                                    </label>
                                </div>
                                <div class="module-option">
                                    <label for="reports_mng">
                                        <input type="checkbox" id="reports_mng" class="modal-input edit-module-input hidden">
                                        <span class="cust-checkbox"></span>
                                        Reports and Analytics
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button class="create-btn update-role">Update</button>
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

    <script src="js/function.js?v=<?php echo $js_cache_string; ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let apiPath = "<?php echo $apiPath; ?>";
        let moduleDataArray = [];
        let userRoleArray = [];
       
        $(document).ready(() => {
           
                fetch_roles();
           
            
        });

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
                        console.log(data1);
                        moduleDataArray = data1.moduleData;
                        userRoleArray = data1.roleData;

                        let adminuserrole = '';
                        let modulelist = '';
                        let editmodulelist = '';
                        $('.total').text(`Total Roles - ${userRoleArray.length}`)

                        userRoleArray.forEach((rolelist,index) => {
                            let editstatus = `<td>-</td>`;
                            if(rolelist.editstatus == 1 ){

                                editstatus = `<td><a href="#" class="editrole" data-toggle="modal" data-target="#edit_role_popup" data-token="${rolelist.roleToken}" data-rolename="${rolelist.roleName}" data-modtoken="${rolelist.moduleToken}">Edit</a><a data-token="${rolelist.roleToken}" class="deleterole" href="#">Delete</a></td>`;

                            }
                            adminuserrole += `<tr>
                                                <td>${index + 1}</td>
                                                <td>${rolelist.roleName}</td>
                                                <td>${rolelist.moduleName}</td>
                                                <td>${rolelist.createdDate}</td>
                                                ${editstatus}
                                            </tr>`;
                        });

                        moduleDataArray.forEach((modules,index) => {

                            modulelist += `<div class="module-option">
                                                <label for="${modules.moduleToken}">
                                                    <input type="checkbox" id="${modules.moduleToken}" name ="${modules.moduleName}" class="modal-input module-input hidden" value="${modules.moduleToken}">
                                                    <span class="cust-checkbox"></span>
                                                    ${modules.moduleName}
                                                </label>
                                            </div>`;

                            editmodulelist += `<div class="module-option">
                                                <label for="${modules.moduleName}">
                                                    <input type="checkbox" id="${modules.moduleName}" name ="${modules.moduleName}" value="${modules.moduleToken}" class="modal-input edit-module-input hidden ${modules.moduleToken}">
                                                    <span class="cust-checkbox"></span>
                                                    ${modules.moduleName}
                                                </label>
                                            </div>`;

                            
                        });

                        $('#add_role_popup .module-op-filer-set').html(modulelist);
                        $('#edit_role_popup .module-op-filer-set').html(editmodulelist);

                        // SELECT ALL IN ADD ROLE
                        const selectAllBtn = document.querySelector('.selectall-btn')
                        const selectAllInput = document.querySelector('.selectall-input');
                        const moduleInputs = document.querySelectorAll('.module-input');
                        console.log(moduleInputs);
                        selectAllBtn.addEventListener('click', function(){
                            if(selectAllInput.checked){
                                moduleInputs.forEach(input => input.checked = true);
                            }else{
                                moduleInputs.forEach(input => input.checked = false);
                            }
                  
                        });

                        moduleInputs.forEach(function(input, i){

                            input.addEventListener('click', function(){
                               if(!input.checked){
                                  selectAllInput.checked = false;
                               }
                               let len = 0;
                               for(var i = 0; i < moduleInputs.length; i++){
                                  if(moduleInputs[i].checked) len++;
                               }
                               if(len == moduleInputs.length){
                                  selectAllInput.checked = true;
                               }
                            })
                        })

                        // SELECT ALL IN EDIT ROLE
                        const editSelectAllBtn = document.querySelector('.edit-selectall-btn')
                        const editSelectAllInput = document.querySelector('.edit-selectall-input');
                        const editModuleInputs = document.querySelectorAll('.edit-module-input');
                        editSelectAllBtn.addEventListener('click', function(){
                            if(editSelectAllInput.checked){
                                editModuleInputs.forEach(input => input.checked = true);
                            }else{
                                editModuleInputs.forEach(input => input.checked = false);
                            }
                  
                        });

                        editModuleInputs.forEach(function(input, i){

                            input.addEventListener('click', function(){
                               if(!input.checked){
                                  editSelectAllInput.checked = false;
                               }
                               let len = 0;
                               for(var i = 0; i < editModuleInputs.length; i++){
                                  if(editModuleInputs[i].checked) len++;
                               }
                               if(len == editModuleInputs.length){
                                  editSelectAllInput.checked = true;
                               }
                            })
                        })

                        $('.userrole tbody').html(adminuserrole);
                        $(".userrole").DataTable({
                            dom: '<Bfr<"table-container"t>ip>',
                            initComplete: function() {
                                $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                            },
                            scrollX: true,
                            buttons: [
                                {
                                    extend: 'csvHtml5',
                                    title: 'Admin Role Management'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'LEGAL',
                                    title: 'Admin Role Management'
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

        $('body').on('click','.create-role',function (){
            let userRoleName = $('#rolename').val();
            let modulesTokenArray = [];
            $('#add_role_popup .module-op-filer-set input[type=checkbox]:checked').each((index,selectedToken)=>{
                modulesTokenArray.push(selectedToken.value);
            })

            if(userRoleName != '' && modulesTokenArray != [] ){
                let datas = {
                                "adminToken":adminToken,
                                "userRoleName":userRoleName,
                                "modulesTokenArray":modulesTokenArray
                            };
                            console.log(datas);
                let json1 = JSON.stringify(datas);
                        $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/roles/addUserRole.php",
                        data: json1
                        }).done(function(data1) {

                            if(data1.status_code == 201){

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
                                    text:data1.message,
                                    icon:"warning",

                                });

                            }
                        })
            }else{
                swal("Give rolename and select atleast one access");
            }

        })

        $('body').on('click','.editrole',function (){
            let roletoken = $(this).attr('data-token');
            
            let moduletoken = $(this).attr('data-modtoken');
            let rolename = $(this).attr('data-rolename');
            let selectedTokenArray = moduletoken.split(',');


            $('.update-role').attr('data-roletoken',roletoken);
            $('.edit-module-input').prop('checked',false);
            $('#editrolename').val(rolename);

            selectedTokenArray.forEach((selectedtoken,index) => {

                $(`.${selectedtoken}`).prop('checked',true);
                
            });
        })

        $('body').on('click','.update-role',function (){
            let userRoleToken = $(this).attr('data-roletoken');
            let userRoleName = $('#editrolename').val();
            let modulesTokenArray = [];  
            $('#edit_role_popup .module-op-filer-set input[type=checkbox]:checked').each((index,selectedToken)=>{
                modulesTokenArray.push(selectedToken.value);
            });


            if(userRoleName != '' && modulesTokenArray != [] ){


                let data = {
                                "adminToken": adminToken,
                                "userRoleToken": userRoleToken,
                                "userRoleName": userRoleName,
                                "modulesTokenArray":modulesTokenArray
                            }

                let json_data = JSON.stringify(data);
                $.ajax({
                        type: "POST",
                        dataType: "json",
                        url : `${apiPath}/roles/updateUserRole.php`,
                        data: json_data 
                      }).done(function(data){
                        
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
                        
                    });



            }else{
                    swal("Give rolename and select atleast one access")
                } 

        })

        $('body').on('click','.deleterole',function(){
            let userRoleToken = $(this).attr("data-token");
            swal({
                    title: "DELETE",
                    text: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    console.log(willDelete);
                    if (willDelete) {
                        let data = {
                                        "adminToken": adminToken,
                                        "userRoleToken": userRoleToken
                                   }

                        let json_data = JSON.stringify(data);
                        $.ajax({
                                type: "POST",
                                dataType: "json",
                                url : `${apiPath}/roles/deleteUserRole.php`,
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
        });
    </script>
</body>
</html>
<?php
}
?>