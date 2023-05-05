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
    <title>User Management</title>
    <link rel="shortcut icon" href="assets_new/header/fav-icon.png">
    
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <!-- css files -->
    <link rel="stylesheet" href="css/fonts.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/common.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/custom-table.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/header.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/user-role.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/user-mng.css?v=<?php echo $js_cache_string; ?>">
    <link rel="stylesheet" href="css/mediaquery.css?v=<?php echo $js_cache_string; ?>">
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">


</head>

<body>
    <div id="loading" style="display: block;"></div>
    <header id="main-dash-header" class="dash-header">      
    </header>

    <!-- sidebar -->
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar" id="sidebar1"></div>
    
    <!-- main-contents -->
    <main class="main-contents">

        <section class="bg-white full-height" id="toggle">
            <div class="product_header_container">
                <div class="header-details ">
                    <h1 class="header_main">Agent List </h1>
                    <p class="total_emp total"></p>
                </div>
            </div>
           
            <!-- Nav tabs -->
            <div class="dropdown">
                <input type="checkbox" class="dropdown__switch" id="filter-switch" hidden="">
                <label for="filter-switch" class="dropdown__options-filter">
                    <ul class="dropdown__filter" role="listbox" tabindex="-1">
                        <li class="dropdown__filter-selected" aria-selected="true">
                            Download as
                        </li>
                        <li>
                            <ul class="dropdown__select">
                                <li class="dropdown__select-option" role="option">
                                    <a href="#">CSV</a>
                                </li>
                                <li class="dropdown__select-option" role="option">
                                    <a href="#">PDF</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </label>
            </div>

            <div class="tab-content" id="pills-tabContent" >
                <div class="tab-pane active fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="custom-table agentlisttable" id="dataTables_filter">
                        <thead>
                            <tr>
                                <th>SL.NO</th>
                                <th>Agent Name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="bg-white full-height twoback agent_list-sec" id="toggle1" style="display: none;">
            <div class="back_arrow_img_Section">
                <img src="assets_new/main/Back arrow.png" onclick="hideModal()" alt="" class="backword">
                <h1 class="header_main header_main_h1 viewagentname" ></h1>
            </div>
            <div class="campaign_top_section">
                <div class="campaign_top_content_section">
                    <h1 class="header_main">Basic Details</h1>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="">Email Address</p>
                            <p class="viewagentemail"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">Business Mobile Number</p>
                            <p class="viewagentmob"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">DOB</p>
                            <p class="viewagentdob"></p>
                        </div>
                    </div>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="">Address</p>
                            <p class="viewagentaddress"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">City</p>
                            <p class="viewagentcity"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">State</p>
                            <p class="viewagentstate"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">Country</p>
                            <p class="viewagentcountry"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">Pincode</p>
                            <p class="viewagentpin"></p>
                        </div>
                    </div>
                </div>
                <div class="campaign_top_content_section">
                    <p>Banking Details</p>
                    <div class="details-top-section">
                        <div class="details-top-div date">
                            <p class="">Account Number</p>
                            <p class="viewagentacc"></p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">IFSC Code</p>
                            <p class="viewagentifsc"></p>
                        </div>
                        <!-- <div class="details-top-div date">
                            <p class="">Branch</p>
                            <p class="viewagentbranch">Velachery</p>
                        </div>
                        <div class="details-top-div date">
                            <p class="">City</p>
                            <p class="viewagentbankcity">Chennai</p>
                        </div> -->
                    </div>
                </div>
                <div class="campaign_top_content_section">
                    <p>Uploaded documents</p>
                    <div class="details-top-section">
                        <div class="uploaded-doc-container">
                            <div>
                              <div class="uploaded-doc addressdiv">
                                  <img class="agentaddressdoc" src="assets_new/main/Image 3@2x.png" alt="">
                                  <iframe class="agentaddressdoc_pdf" src="assets_new/main/Image 3@2x.png" frameborder="0"></iframe>
                              </div>
                              <p class="addressp">Address proof <img class="doc-download address-download" src="assets_new/download.svg" alt=""></p>
                            </div>
                            <div>
                              <div class="uploaded-doc pandiv">
                                  <img class="agentpan" src="assets_new/main/Image 3@2x.png" alt="">
                                  <iframe class="agentpan_pdf" src="assets_new/main/Image 3@2x.png" frameborder="0"></iframe>
                              </div>
                              <p class="panp">Pan Card <img class="doc-download pan-download" src="assets_new/download.svg" alt=""></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="campaign_top_content_section">
                    <div class="display-card-container">
                           <div class="display-card">
                               <img src="assets_new/main/total-booked@2x.png" alt="">
                               <div>
                                   <p>Total Booked</p>
                                   <p class="viewtotalbooked"></p>
                               </div>   
                           </div>
                           <div class="display-card">
                               <img src="assets_new/main/total-earned@2x.png" alt="">
                               <div>
                                   <p>Total Earned Miles</p>
                                   <p class="viewmilesearned"></p>
                               </div>   
                           </div>
                           <div class="display-card">
                               <img src="assets_new/main/encashment@2x.png" alt="">
                               <div>
                                   <p>Available Encashment</p>
                                   <p class="viewencashment"></p>
                               </div>   
                           </div>
                        </div>
                        <div class="btn-container">
                            <button class="primary-btn verifyagent">Verify Now</button>
                            <button class="sec-btn rejectagent">Reject</button>
                        </div>
                    </div>
                </div>


            <div class="distributor-details-container">
                <div class="over-all-tab">
                        <table class="custom-table agentbookingdetails" id="dataTables_filter4">
                            <thead>
                                <tr>
                                    <th>SL.No</th>
                                    <th>Booking Id</th>
                                    <th>Service Airport</th>
                                    <th>Miles Earned</th>
                                    <th>Miles Burned</th>
                                </tr>
                            </thead>
                            <tbody>
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
                            <select name="" id="" class="form__select">
                                <option value="Admin">Admin</option>
                                <option value="Provider">Provider</option>
                            </select>
                        </div> 
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="creat_modal_btn createdistributor">Create</button>
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
                            <input type="text" name="" placeholder="AIRPORTZO#98" id="edit_access-type" class="form__input">
                        </div> 
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="creat_modal_btn createdistributor">Create</button>
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
            // $("#dataTables_filter").DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         // {
            //         //     extend: 'csvHtml5',
            //         //     title: 'Project Management'
            //         // },
            //         // {
            //         //     extend: 'pdfHtml5',
            //         //     orientation: 'landscape',
            //         //     pageSize: 'LEGAL',
            //         //     title: 'Project Management'
            //         // }
            //     ],
            //     language: {
            //         search: '<img src="./assets_new/main/Search.png">', searchPlaceholder: "Search" ,
            //         paginate: {
            //             next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
            //             previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
            //         }
            //     }
            // });
    </script>
    <script>
         var apiPath = "<?php echo $apiPath; ?>";

        $(document).ready(() => {
            fetchagents();
            
        });

        function fetchagents(){
            let datas = {
                            "adminToken":adminToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/agentUserList.php",
                data: json1
            }).done(function(data1) {
                let agentListArray = data1.data;
                let agentslist = '';
                agentListArray.forEach((agents,index) => {
                    let action = '';
                    if(agents.isApproved == 0){
                        action = `<td><a href="#" data-token="${agents.token}" data-status="${agents.isApproved}" class="view_link agentdetails" onclick="showmodal()">View detail</a><a href="#" data-token="${agents.token}" class="view_link verifyagent">verify</a><a href="#" data-token="${agents.token}" class="view_link rejectagent">Reject</a></td>`;

                    }else{
                        if(agents.status == 1){

                            action = `<td><a href="#" data-token="${agents.token}" data-status="${agents.isApproved}" class="view_link agentdetails" onclick="showmodal()">View detail</a><a href="#" data-token="${agents.token}" class="view_link blockagent">Block</a></td>`;

                        }else{
                            action = `<td><a href="#" data-token="${agents.token}" data-status="${agents.isApproved}" class="view_link agentdetails" onclick="showmodal()">View detail</a><a href="#" data-token="${agents.token}" class="view_link unblockagent">Unblock</a></td>`;
                        }

                        

                    }

                    agentslist += `<tr>
                                        <td>${index + 1}</td>
                                        <td>${agents.name}</td>
                                        <td>${agents.email}</td>
                                        <td>${agents.mobileNumber}</td>
                                        ${action}
                                    </tr>`;

                    
                });
                $('.total').text(`Total agents- ${agentListArray.length}`)
                $('.agentlisttable tbody').html(agentslist);
                $(".agentlisttable").DataTable({
                        dom: 'Bfrtip',
                        initComplete: function() {
                            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
                        },
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'User Agents List'
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'User Agents List'
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
            })
        }

        

        $('body').on('click','.agentdetails',function(){
            let isApproved = $(this).attr('data-status');
            let userToken = $(this).attr('data-token');
            console.log(isApproved);
            let datas = {
                            "adminToken":adminToken,
                            "userToken":userToken
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/singleAgentUserDetails.php",
                data: json1
            }).done(function(data1) {
                let agentdetails = data1.userDetails;
                console.log(agentdetails);
                let agentbookingarray = data1.orderDetails;
                if(agentdetails.addressProof == '' || agentdetails.addressProof == undefined){
                    $('.addressp').hide();

                }else{
                    $('.addressp').show();
                }
                if(agentdetails.panCard == '' || agentdetails.panCard == undefined){
                    $('.panp').show();

                }else{
                    $('.panp').show();
                }
                $('.viewagentname').text(agentdetails.name);
                $('.viewagentemail').text(agentdetails.email);
                $('.viewagentmob').text(agentdetails.mobileNumber);
                $('.viewagentdob').text(agentdetails.dob);
                $('.viewagentaddress').text(agentdetails.address);
                $('.viewagentcity').text(agentdetails.city);
                $('.viewagentstate').text(agentdetails.state);
                $('.viewagentcountry').text(agentdetails.country);
                $('.viewagentpin').text(agentdetails.pincode);
                $('.viewagentacc').text(agentdetails.acNumber);
                $('.viewagentifsc').text(agentdetails.ifscCode);
                $('.viewagentbranch').text(agentdetails.name);
                $('.viewagentbankcity').text(agentdetails.name);
                let addressfileType = agentdetails.addressProof.split('.').pop();
                if(addressfileType == 'pdf' || addressfileType == 'PDF'){
                    $('.agentaddressdoc_pdf').attr('src',`${agentdetails.addressProof}`);
                    $('.agentaddressdoc_pdf').show();
                    $('.agentaddressdoc').hide();
                }else{
                    $('.agentaddressdoc').attr('src',`${agentdetails.addressProof}`);
                    $('.agentaddressdoc').show();
                    $('.agentaddressdoc_pdf').hide();
                }
                $('.address-download').attr('data-url',`${agentdetails.addressProof}`)
                let panfileType = agentdetails.panCard.split('.').pop();
                if(panfileType == 'pdf' || panfileType == 'PDF'){
                    $('.agentpan_pdf').attr('src',`${agentdetails.panCard}`);
                    $('.agentpan_pdf').show();
                    $('.agentpan').hide();
                }else{
                    $('.agentpan').attr('src',`${agentdetails.panCard}`);
                    $('.agentpan').show();
                    $('.agentpan_pdf').hide();
                }
                $('.pan-download').attr('data-url',`${agentdetails.panCard}`)
                
                if(isApproved == 0){

                    $('.btn-container').html(`<button data-token="${userToken}" class="primary-btn verifyagent">Verify Now</button>
                            <button data-token="${userToken}" class="sec-btn rejectagent">Reject</button>`)

                    $('.btn-container').show(); //show button div

                }else{
                    $('.btn-container').hide();
                }

                let bookingdetails = '';
                agentbookingarray.forEach((agentbooking,index) => {

                    bookingdetails += `<tr>
                                        <td>${index + 1}</td>
                                        <td><a data-token="${agentbooking.token}" href="#">${agentbooking.bookingNumber}</a></td>
                                        <td>${agentbooking.serviceAirport}</td>
                                        <td><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${agentbooking.MilesEarned}</td>
                                        <td><img class="mile-coin" src="assets_new/main/flight-coin.png" alt="coin">${agentbooking.MilesBurned}</td>
                                    </tr>`;
                    
                });
                $('.viewtotalbooked').text(agentbookingarray.length);
                $('.viewmilesearned').text(0);
                $('.viewencashment').text(`0 Miles`);
                $('.agentbookingdetails tbody').html(bookingdetails);
                $('.agentbookingdetails').DataTable().destroy();
                $('.agentbookingdetails tbody').html(bookingdetails);
                $(".agentbookingdetails").DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'csvHtml5',
                                title: 'User Agents booking'
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'User Agents booking'
                            }
                        ],
                        language: {
                            search: '<img src="./assets_new/main/Search.png">', searchPlaceholder: "Search" ,
                            paginate: {
                                next: '<img style="width:18px;" src="assets_new/arrow-right.png">', // or '→'
                                previous: '<img style="width:18px;" src="assets_new/arrow-left.png">' // or '←'  <img src="path/to/arrow.png">'
                            }
                        }
                }).draw();

            })
            

        })

        $('body').on('click','.blockagent',function(){
            let userToken = $(this).attr('data-token');
            let status = "2";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Block the agent?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willblock)=>{

                    if(willblock){

                        blockunblock(userToken,status);

                    }else{
                        swal('Block cancelled');
                    }

                })

        })

        $('body').on('click','.unblockagent',function(){
            let userToken = $(this).attr('data-token');
            let status = "1";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Unblock the agent?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willunblock)=>{

                    if(willunblock){

                        blockunblock(userToken,status);

                    }else{
                        swal('Unblock cancelled');
                    }

                })

        })

        $('body').on('click','.verifyagent',function(){

            let userToken = $(this).attr('data-token');
            let status = "1";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Verify the agent?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willapprove)=>{

                    if(willapprove){

                        approveReject(userToken,status);

                    }else{
                        swal('Verify cancelled');
                    }

                })

        })

        $('body').on('click','.rejectagent',function(){

            let userToken = $(this).attr('data-token');
            let status = "2";

            swal({
                    title: "Are you sure?",
                    text: "Do you want to Verify the agent?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willapprove)=>{

                    if(willapprove){

                        approveReject(userToken,status);

                    }else{
                        swal('Verify cancelled');
                    }

                })

        })

        
        function blockunblock(userToken,status){

            let datas = {
                            "adminToken":adminToken,
                            "userToken":userToken,
                            "status": status
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/blockUnblock.php",
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

            })

        }

        function approveReject(userToken,status){

            let datas = {
                            "adminToken":adminToken,
                            "userToken":userToken,
                            "status": status
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/users/approveRejectAgent.php",
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
            })
            

        }

        function downloaddoc(url){
                fetch(url)
                    .then(resp => resp.blob())
                    .then(blobobject => {
                        const blob = window.URL.createObjectURL(blobobject);
                        const anchor = document.createElement('a');
                        anchor.style.display = 'none';
                        anchor.href = blob;
                        anchor.download = url.replace(/^.*[\\\/]/, '');
                        document.body.appendChild(anchor);
                        anchor.click();
                        window.URL.revokeObjectURL(blob);
                    })
                    .catch(() => console.log('An error in downloadin gthe file sorry'));
            }

            $('body').on('click','.doc-download',function(){
                let url = $(this).attr('data-url');
                downloaddoc(url);

            })
    </script>

</body>
</html>
<?php
}
?>