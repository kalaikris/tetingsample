let userToken = localStorage.getItem("userToken");
let distributorToken = localStorage.getItem("distributorToken");
let isAgent = localStorage.getItem("isAgent");
let onboarded = JSON.parse(localStorage.getItem("onboarded"));

function fieldsclear() {
  $("#current-pass").val("");
  $("#new-pass").val("");
  $("#confirm-pass").val("");
}

const header_sidebar = () => {
  let distributorImageDetails = "";
  let distributorName = "";
  let distributorType = "";
  let myAgents = "";
  let dashboard = "";
  let booking = "";
  let cancelled = "";
  let finance = "";
  let managebranding = "";
  let userrole = "";
  let staff = "";
  let reports = "";
  let help = "";

  let userDetails = "";
  let moduleToken = [];

  let datas = {
    distributorToken: distributorToken,
    userToken: userToken,
  };
  let json_data = JSON.stringify(datas);
  let result = $.ajax({
    dataType: "JSON",
    async: false,
    type: "POST",
    url: "API/Version1.0/distributor/distributorDetails.php",
    data: json_data,
  }).done(function (data) {
    // if (profiledetails.status_code == 201) {
    let profileDetails = data.userDetails[0];
    let userModuleArray = data.userModules;
    isAgent = profileDetails.isAgent;

    distributorName = profileDetails.distributorName;
    let distributorNameFirstLetter = distributorName.charAt(0);
    let userNameFirstLetter = profileDetails.userName.charAt(0);
    let userName = profileDetails.userName;
    distributorType = profileDetails.distributorType;

    if (
      profileDetails.headerLogo == "" ||
      profileDetails.headerLogo == undefined
    ) {
      distributorImageDetails = ` <img src="./asset/img/s.png" alt="" class="circule-img" style="display:none;">
        <div class="letterspell" style="display:flex;"><h3>${distributorNameFirstLetter}</h3></div>`;
    } else {
      distributorImageDetails = `<img src="${profileDetails.headerLogo}" alt="" class="circule-img" style="display:flex;">
        <div class="letterspell" style="display:none;"><h3>${distributorNameFirstLetter}</h3></div>`;
    }
    if (profileDetails.profileImage != "") {
      userDetails = `<img src="${profileDetails.profileImage}" alt="" class="user-icon" style="display:flex;"/> ${userName}`;
    } 
    else if( profileDetails.favicon_logo != "") {
      userDetails = `<img src="${profileDetails.favicon_logo}" alt="" class="user-icon" style="display:flex;" /> ${userName}`;
    }
    else {
      userDetails = `<div class="login_letter" style="display:flex;"><h3>${userNameFirstLetter}</h3></div> ${userName}`;
    }

    userModuleArray.forEach((module, index) => {
      moduleToken.push(module.moduleToken);
    });
  });

  if (moduleToken.includes("ST8QZLIUA9")) {
    dashboard = `<li id="dashboard" class="nav-item nav-li">
                     
                         <a href="dashboard.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/dashboard_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Dashboard</p>
                             
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("7PTSNNF8AF")) {
    booking = `<li id="booking_order" class="nav-item  nav-li">
                         <a href="booking.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/booking_orders_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Booking Orders</p>
                             
                             
                         </a>
                     </li>`;
  }
  if (moduleToken.includes("45TGDT0SDW")) {
    cancelled = `<li id="cancelled_order" class="nav-item  nav-li">
                         <a href="cancelled-order.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/close.png"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Cancelled Orders</p>
                         </a>
                     </li>`;
  }

  if (isAgent == 1 && moduleToken.includes("3JNTL7CGGP")) {
    myAgents = `<li id="my-agents" class="nav-item nav-li">
                      <a href="my-agents.php" class="nav-link">
                          <img
                              src="asset/menu_icons/myagent_enable.svg"
                              class="side-icon"
                              alt=""
                              />
                          <p class="icon-desc">My Agents</p>
                          
                      </a>
                  </li>`;
  }

  if (moduleToken.includes("JZT9YC5QSA")) {
    finance = `<li id="Manage-finance" class="nav-item nav-li">
                         <a href="manage-finance.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/manage_finance_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Manage Finance</p>
                             <div class="bule-line"></div>
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("S0DMDQ3QAP")) {
    managebranding = `<li id="manage-branding" class="nav-item nav-li">
                         <a href="manage-branding.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/manage_branding_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Manage Branding</p>
                             
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("6U5DNLJMDU")) {
    reports = `<li id="Reports-analytics" class="nav-item nav-li hidden">
                         <a href="under-construction.html" class="nav-link">
                             <img
                                 src="asset/menu_icons/reports_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Reports and Analytics</p>
                             
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("ST8QZLIUA5")) {
    userrole = `<li id="user-access" class="nav-item nav-li">
                         <a href="user_role.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/user_roles_enable.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">User roles and access</p>
                             
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("ST8QZLIUA8")) {
    staff = `<li id="my-staffs" class="nav-item nav-li">
                         <a href="my-staffs.php" class="nav-link">
                             <img
                                 src="asset/menu_icons/mystaff_enabled.svg"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">My staffs</p>
                             
                         </a>
                     </li>`;
  }

  if (moduleToken.includes("ST8QZLIUA7")) {
    help = `<li id="helpe" class="nav-item bottom-help">
                         <a href="#" class="nav-link">
                             <img
                                 src="asset/menu_icons/terms and conditions@2x.png"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Help</p>
                         </a>
                     </li>`;
  }

  let header = `
  <div class="nav-header">
     <div class="logo-set">
        <a href="dashboard.php" class="nav-link">
          <img src="./asset/img/logo.png" alt="logo" class="header-logo">
         </a>
        
     </div>
   <div class="profile-logout-set">
         <ul class="navbar-nav nav-list-set">
             <li class="nav-item relet-notif" hidden>
                 <a href="#" class="nav-link">
                     <img src="./asset/notification_icon.svg" alt=""class="home-icon" />
                 </a>
             </li>
             <li class="nav-item dropdown d-flex">
                 <a class="nav-link dropdown-toggle menu-user-profile" href="javascript:void(0)" id="navbarDropdownMenuLink">
                    ${userDetails}
                 </a>
                 <ul class="dropdown-menu cust-h-profile-items" aria-labelledby="navbarDropdownMenuLink">
                     <li hidden><a class="dropdown-item" href="#"><img src="asset/men_icon.png" class="menu-dd-icon" alt=""> Profile</a></li>
                     <li><a class="dropdown-item" href="reset-pass.php" ><img src="asset/resetpassword-icon.png" class="menu-dd-icon" alt=""> Change Password</a></li>
                     <li><a class="dropdown-item logout" href="#"><img src="asset/logout_icon.png" class="menu-dd-icon"  alt=""> Logout</a></li>
                 </ul>
             </li>
         </ul>
     </div>
 </div>
`;

  let sidebar = `
     <div class="siider-bg">
                 <div class="container-set">
                     <div class="profile-air">
                         <div class="red-circule">
                         ${distributorImageDetails}
                         </div>
                         <ul class="navbar-nav nav-list-set">
                             <li class="nav-item dropdown d-flex">
                             <span class="nav-link sidemenu-reg-product">
                             ${distributorName}
                                 <a  href="edit_onboard.php" id="navbarDropdownMenuLink">
                                 <img src="asset/images/edit.svg" alt="edit icon">
                                 </a>
                                 </span>
                                 <ul class="dropdown-menu sidemenu-reg-product-dropdown-menu" aria-labelledby="navbarDropdownMenuLink" hidden>
                                     <li>
                                         <h4 class="sidemenu-dd-title">Switch to</h4>
                                     </li>
                                     <li class="dropdown-submenu">
                                         <a class="dropdown-item dropdown-toggle cust-dropdown-item" href="http://google.com">
                                             <div class="Service-items">
                                                 <img src="./asset/plaza-logo.png" class="" alt="">
                                                 <div class="Service-items-desc">
                                                     <p>Plaza premium</p>
                                                     <span>Lounge</span>
                                                 </div>
                                             </div>
                                         </a>
                                         <ul class="dropdown-menu">
                                             <li><a class="dropdown-item" href="#">Chennai International Airport</a></li>
                                             <li><a class="dropdown-item" href="#">Bangalore International Airport</a></li>
                                         </ul>
                                     </li>
                                     <li class="dropdown-submenu">
                                         <a class="dropdown-item dropdown-toggle cust-dropdown-item" href="http://google.com">
                                             <div class="Service-items">
                                                 <img src="./asset/care.png" class="" alt="">
                                                 <div class="Service-items-desc">
                                                     <p>Plaza premium</p>
                                                     <span>Lounge</span>
                                                 </div>
                                             </div>
                                         </a>
                                         <ul class="dropdown-menu">
                                             <li><a class="dropdown-item" href="#">Chennai International Airport</a></li>
                                             <li><a class="dropdown-item" href="#">Bangalore International Airport</a></li>
                                             <li><a class="dropdown-item" href="#">New Delhi Airport</a></li>
                                             <li><a class="dropdown-item" href="#">Kerala Airport</a></li>
                                         </ul>
                                     </li>
                                     <li>
                                     <div class="sidemenu-new-business-btn-set">
                                             <button class="cust-btn cust-btn-sm cust-border-btn-primary">Add new business</button>
                                     </div>
                                     </li>
                                 </ul>
                             </li>
                         </ul>
                         <p class="meet-greet">${distributorType}</p>
                         
                     </div>
                 </div>
                 <ul class="side-nav-list">
                     ${dashboard}
                     ${booking}
                     ${cancelled}
                     ${myAgents}
                     ${finance}
                     ${managebranding}
                     ${reports}
                     ${userrole}
                     ${staff}
                 </ul>
                 <ul class="silder-set-help" hidden>
                     <li id="helpe" class="nav-item bottom-help">
                         <a href="#" class="nav-link">
                             <img
                                 src="asset/menu_icons/terms and conditions@2x.png"
                                 class="side-icon"
                                 alt=""
                                 />
                             <p class="icon-desc">Help</p>
                         </a>
                     </li>
                 </ul>
             
             </div>
`;

  $("#header").html(header);
  $("#sidebar").html(sidebar);
};

// .........loading...............
// .............//////////...........///

$(document).ready(function () {
  if (userToken == "" || userToken == undefined) {
    window.location.replace("login.php");
  } else {
    if (onboarded == true) {
      header_sidebar();
    } else {
      window.location.replace("onboard.php");
    }
  }

  $("body").on("click", ".logout", function () {
   // localStorage.clear();
   localStorgeItems  = ['onboarded','userToken','distributorToken','isAgent'];
   for(i=0; i<localStorgeItems.length; i++){
       localStorage.removeItem(localStorgeItems[i]);
   }
    window.location = "login.php";
  });
});

function onReady(callback) {
  var intervalID = window.setInterval(checkReady, 3200);
  function checkReady() {
    if (document.getElementsByTagName("body")[0] !== undefined) {
      window.clearInterval(intervalID);
      callback.call(this);
    }
  }
}
function show(id, value) {
  document.getElementById(id).style.display = value ? "block" : "none";
}
onReady(function () {
  show("page", true);
  show("loading", false);
});
