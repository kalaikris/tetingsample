let sidemenu_after_login ='';
let sidemenu_before_login = '';
sidemenu_after_login = `<div class="side_menu_inner_set">
                            <div class="main_content">
                                <div class="arirportzo_logo">
                                    <img src="./asset/images/logo.png" class="logo-icon">
                                </div>
                                <div class="sub_text">
                                    <p>Welcome,</p>
                                    <h1> We are happy and honored to onboard you as our service provider !</h1>
                                </div>
                            </div>
                            <ul class="sidebar_status">
                                <li class="side-menu-tab active" toggle-target="#business_info" id="business_sidemenu" data-target="true">Business Info <span class="completed_tick"></span><span class="active_pointer"></span></li>
                                <li class="side-menu-tab" toggle-target="#service_location_Details" id="service_sidemenu" data-target="true">Service Locations <span class="completed_tick"></span><span class="active_pointer"></span></li> 
                                <li class="side-menu-tab" toggle-target="#review" id="review_sidemenu" data-target="true">Review <span class="completed_tick"></span><span class="active_pointer"></span></li>
                            </ul>
                        </div>`;
sidemenu_before_login = `<div class="sidemenu-content-set">
                            <h2>Simplified yet powerful application to manage all your services !</h2>
                            <img src="./asset/images/side-menu-poster.svg" alt="poster img" class="sidemenu-img">
                        </div>`;
$('#after_login').html(sidemenu_after_login);
$('#before_login').html(sidemenu_before_login);

// Side menu active
// $('.side-menu-tab').on('click',function(){
//     let sidemenu_target = $(this).attr('toggle-target');
//     let sidemenu_status = $(this).attr('data-target');
//     if(sidemenu_status == "true"){
//         $(`.sec-tab,.side-menu-tab`).removeClass('active');
//         $(this).addClass('active');
//         $(`${sidemenu_target}`).addClass('active');
//     }
//     else{
//         return false;
//     }
// });




