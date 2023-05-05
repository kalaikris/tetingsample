var global_companys;
let requiredCompanyToken;
let loginToken = localStorage.getItem("loginToken");
//clear password Fields
function fieldsclear() {
  $("#current-pass").val("");
  $("#new-pass").val("");
  $("#confirm-pass").val("");
}

//change password
function passwordchange() {
  let currentPassword = $("#current-pass").val();
  let newPassword = $("#new-pass").val();
  let confirmPassword = $("#confirm-pass").val();
  if (currentPassword == "" || newPassword == "") {
    swal("Current and new password fields cannot be empty");
  } else if (newPassword != confirmPassword) {
    swal("Entered new password and confirmed password field does not match");
  } else {
    let datas = {
      token: loginToken,
      currentPassword: currentPassword,
      newPassword: newPassword,
    };
    let json1 = JSON.stringify(datas);
    $.ajax({
      dataType: "JSON",
      type: "POST",
      url: apiPath + "/service-provider/providerUpdatePassword.php",
      data: json1,
    }).done(function (data1) {
      if (data1.status_code == 201) {
        swal({
          title: data1.title,
          text: data1.message,
          icon: "success",
        }).then(() => {
          logout_session();
        });
      } else {
        swal({
          title: data1.title,
          text: data1.message,
          icon: "warning",
        }).then(() => {
          $("#current-pass").val("");
          $("#new-pass").val("");
          $("#confirm-pass").val("");
        });
      }
    });
  }
}
const header_sidebar = () => {
  let header = `
            <div class="nav-header">
                <div class="logo-set">
                    <img src="./asset/img/logo.png" alt="logo" class="header-logo">
                </div>
                <div class="profile-logout-set">
                    <ul class="navbar-nav nav-list-set">`;
                        // <li class="nav-item relet-notif">
                        //     <a href="#" class="nav-link">
                        //         <img src="./asset/notification_icon.svg" alt=""class="home-icon" />
                        //     </a>
                        // </li>
              header +=`<li class="nav-item dropdown d-flex">
                            <a class="nav-link dropdown-toggle menu-user-profile" href="javascript:void(0)" id="navbarDropdownMenuLink">
                                <span class="user-name"><span id="username">Admin</span></span>
                                <img id="staff_imageicon" src="" alt="staff-image" class="user-icon"/>
                            </a>
                            <ul class="dropdown-menu cust-h-profile-items" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" onclick="fieldsclear();" href="reset-pass.php"><img src="asset/logout_icon.png" class="menu-dd-icon" alt="">Change password</a></li>
                                <li><a class="dropdown-item" onclick="logout_session()" href="logout.php"><img src="asset/logout_icon.png" class="menu-dd-icon" alt=""> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>`;

  let sidebar = `
            <div class="siider-bg">
                        <div class="container-set">
                            <div class="profile-air">
                                <div class="red-circule">
                                   <img src="./asset/img/sid-logo.png" alt="" class="circule-img" id="service_location_image" style="height:100px; width:100px;">
                                </div>
                                <ul class="navbar-nav nav-list-set">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle sidemenu-reg-product service_location_name" href="javascript:void(0)" id="navbarDropdownMenuLink">
                                        Pranaam
                                        </a>
                                        <a class="service_location_airportname" href="javascript:void(0)"></a>
                                        <ul class="dropdown-menu sidemenu-reg-product-dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <li>
                                                <h4 class="sidemenu-dd-title">Switch to</h4>
                                            </li>
                                            <li><div id="service_location_terminal"></div></li>
                                            <li>
                                                <div class="sidemenu-new-business-btn-set">
                                                    <a href="#" onclick="createbusiness();"><button class="cust-btn cust-btn-sm cust-border-btn-primary">Add new business</button></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <p class="meet-greet" id="service_location_businesstype">Meet and Greet</p>
                                
                            </div>
                        </div>
                        <ul class="side-nav-list">
                            <li id="dashboard" class="nav-item nav-li">
                                <a href="dashboard.php" class="nav-link">
                                    <img src="asset/plaza-img/home.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Dashboard</p>
                                </a>
                            </li>
                            <li id="booking_order" class="nav-item  nav-li">
                                <a href="booking.php" class="nav-link">
                                    <img src="./asset/plaza-img/list.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Booking Orders</p>
                                    <span class="notificotion-number"></span>
                                </a>
                            </li>
                              <li id="cancelled-orders" class="nav-item  nav-li">
                                <a href="cancelled-orders.php" class="nav-link">
                                    <img src="./asset/plaza-img/close.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Cancelled Orders</p>
                                </a>
                            </li>
                             </li>
                              <li id="problems-peported" class="nav-item  nav-li">
                                <a href="problem_report.php" class="nav-link">
                                    <img src="./asset/plaza-img/error.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Problems Reported</p>
                                    <span class="notificotion-number"></span>
                                </a>
                            </li>
                            <li id="my-staffs" class="nav-item nav-li">
                                <a href="my-staffs.php" class="nav-link">
                                    <img src="./asset/plaza-img/iacard.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">My Staffs</p>
                                </a>
                            </li>
                             <li id="service-policies" class="nav-item nav-li">
                                <a href="service-policy.php" class="nav-link">
                                    <img src="./asset/plaza-img/book.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Services and policies</p>  
                                </a>
                            </li>
                            <li id="Manage-finance" class="nav-item nav-li">
                                <a href="Managefinace.php" class="nav-link">
                                    <img src="./asset/plaza-img/parus.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">Manage Finance</p>
                                    <div class="bule-line"></div>
                                </a>
                            </li>
                            <li id="user-access" class="nav-item nav-li">
                                <a href="user_role.php" class="nav-link">
                                    <img src="./asset/plaza-img/locat.png" class="side-icon" alt=""/>
                                    <p class="icon-desc">User roles and access</p>
                                </a>
                            </li>
                        </ul>
                    </div>`;

  let resetPass = `<div class="modal" id="reset_pass">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="width:40%;height:unset;margin:0 auto;">
                            <!-- Modal Header -->
                            <div class="modal-header d-block">
                                <h4 class="modal-title text-center">Change Password</h4>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                               <div class="modal_input-container">
                                    <div class="input-form-group-item">
                                        <div class="input-box-set">
                                            <label for="password">Password</label>
                                            <input type="password" class="input-box" id="password" placeholder="Enter Password">
                                        </div>
                                        <div class="possword-group">
                                            <img src="asset/images/hide-eye.svg" alt="view eye" class="eye-icon" data-value="#password" data-toggle="false">
                                        </div>
                                     </div>
                               </div>
                            </div>
                            <!-- Modal footer -->
                            <div class=" ">
                                <button type="button" class="cust-btn cust-btn-primary" data-dismiss="modal">Cancel</button>
                                <button type="button" onclick="passwordchange()" class="cust-btn cust-btn-primary">Change</button>
                            </div>
                        </div>
                    </div>
                  </div>`;

  let loginCssLink = document.createElement("link");
  loginCssLink.rel = "stylesheet";
  loginCssLink.href = "css/onbord-css/login.css";
  document.head.prepend(loginCssLink);
  $("#header").html(header);
  $("#sidebar").html(sidebar);
  $("body").append(resetPass);

  // password eye script
  // $(".eye-icon").on("click", function () {
  //   let __changetoggle_state = $(this);
  //   __changetoggle_state.attr(
  //     "data-toggle",
  //     __changetoggle_state.attr("data-toggle") == "false" ? "true" : "false"
  //   );
  //   let __get_current_pass_id = $(this).attr("data-value");
  //   let __get_toggle_state = $(this).attr("data-toggle");

  //   if (__get_toggle_state == "true") {
  //     $(`${__get_current_pass_id}`).attr("type", "text");
  //     $(this).attr("src", "asset/images/password_open@2x.png");
  //   } else {
  //     $(`${__get_current_pass_id}`).attr("type", "password");
  //     $(this).attr("src", "asset/images/hide-eye.svg");
  //   }
  // });
};
header_sidebar();

// .........loading..............//

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

function serviceprovider_sidemenu(staff_token) {
  var datas = {
    userToken: staff_token,
  };
  var JsonData = JSON.stringify(datas);
  $.ajax({
    dataType: "JSON",
    type: "POST",
    url: apiPath + "/provider/providerCompanys.php",
    data: JsonData,
  }).done(function (data) {
    if (data.status_code == 201) {
      var service_companys = data.companys;
      global_companys = service_companys;
      var htmlText1 = "";
      requiredCompanyToken = service_companys[0].token;
      for (var key in service_companys) {
        var service_locationImage = localStorage.getItem(
          "ServiceLocationImage"
        );
        if (service_locationImage == null) {
          $("#service_location_image").attr("src", service_companys[0].logo);
        } else {
          $("#service_location_image").attr("src", service_locationImage);
        }
        $("#service_location_businesstype").text(
          service_companys[0].business_type
        );
        $(".service_location_name").text(service_companys[0].name);

        localStorage.setItem(
          "dummy_service_companytoken",
          service_companys[0].token
        );
        localStorage.setItem(
          "dummy_service_businesstype",
          service_companys[0].business_type
        );
        localStorage.setItem(
          "dummy_service_location_name",
          service_companys[0].name
        );
        if(service_companys[0].airports[0].status == '0'){
          localStorage.setItem(
            "dummy_service_provider_company_locationToken",
            service_companys[0].airports[0].service_provider_company_locationToken
          );
        }else{
          localStorage.setItem("dummy_service_provider_company_locationToken",'0');
        }
        
        htmlText1 += `<li class="sub-product">
                                <label for="sub-product-label${key}">
                                    <input type='checkbox' name="product_list" class="accodiant-radio" id="sub-product-label${key}">
                                    <div class="Service-items">
                                        <img src="${
                                          service_companys[key].logo
                                        }" class="" alt="">
                                        <div class="Service-items-desc">
                                            <p>${service_companys[key].name}</p>
                                            <span>${
                                              service_companys[key]
                                                .business_type
                                            }</span>
                                        </div>
                                        <div class="action-set"> 
                                            ${
                                              service_companys[key]
                                                .companystatus == "1"
                                                ? `<div class="review-widget under-review"><img src="asset/images/pending-icon.svg" alt="icon" class="status-sm-icon"></div>`
                                                : service_companys[key]
                                                    .companystatus == "2"
                                                ? `<div class="review-widget under-completed"><img src="asset/images/verified-tick.svg" alt="icon" class="status-sm-icon"></div>`
                                                : service_companys[key]
                                                    .companystatus == "3"
                                                ? `<div class="review-widget rejected"><img src="asset/img/rej.png" alt="icon" class="status-sm-icon"><p>Rejected</p></div>`
                                                : `<div><img style="cursor: pointer;"></div>`
                                            }
                                        </div>
                                    </div>`;
                                    // <span onclick='edit_services("${service_companys[key].token}")'>Edit</span>
        var companylocation_airport = service_companys[key].airports;
        for (var key1 in companylocation_airport) {
          localStorage.setItem(
            "dummy_service_airporttoken",
            service_companys[0].airports[0].airportToken
          );
          $(".service_location_airportname").text(
            service_companys[0].airports[0].airportName
          );
          localStorage.setItem(
            "dummy_service_location_airportname",
            service_companys[0].airports[0].airportName
          );

          var ServiceLocationAirportName = localStorage.getItem(
            "ServiceLocationAirportName"
          );
          if (ServiceLocationAirportName == null) {
            $("#airportname").val(
              localStorage.getItem("dummy_service_location_airportname")
            );
          } else {
            $("#airportname").val(
              localStorage.getItem("ServiceLocationAirportName")
            );
          }
          htmlText1 += `<ul class="Service-sub-items">`;
                           if(companylocation_airport[key1].status == "0"){
                            htmlText1 += `<li>
                                  <a class="Service-item" onclick='service_locationbased_airport("${service_companys[key].token}","${companylocation_airport[key1].airportToken}","${service_companys[key].logo}","${service_companys[key].name}","${service_companys[key].business_type}","${service_companys[key].airports[key1].service_provider_company_locationToken}","${key}","${key1}","${service_companys[key].companystatus}")'>${companylocation_airport[key1].airportName}</a>
                                  <a href="javascript:void(0)" onclick='editLocationWise("${service_companys[key].token}","${companylocation_airport[key1].airportToken}")' style="margin-left:4px;">
                                    <img src="asset/edit.png" alt="edit icon"> 
                                  </a>
                                </li>`;
                           }
                          //  else{
                          //   htmlText1 += `<li>
                          //         <p class="Service-item">${companylocation_airport[key1].airportName}</p>
                          //         <span class="rejected" style="margin-left:4px;">${companylocation_airport[key1].status =='1'?'Blocked':'Deleted'}
                          //           <img src="asset/img/rej.png" alt="icon"> 
                          //         </span>
                          //     </li>`;
                          // }
                          htmlText1 += `</ul>`;
//            htmlText1 += "<ul class='Service-sub-items'><li><a class='Service-item' onclick='service_locationbased_airport(\""+service_companys[key].token+"\",\""+companylocation_airport[key1].airportToken+"\",\""+companylocation_airport[key1].airportName+"\",\""+service_companys[key].logo+"\",\""+service_companys[key].name+"\",\""+service_companys[key].business_type+"\",\""+service_companys[key].airports[key1].service_provider_company_locationToken+"\",\""+key+"\",\""+key1+"\",\""+service_companys[key].companystatus+"\")'>"+companylocation_airport[key1].airportName+"</a></li></ul>";
        }
        htmlText1 += `</label>
                            </li>`;
      }
      $("#service_location_terminal").html(htmlText1);

      var companyKey = localStorage.getItem("Servicelocationkey");
      companyKey = companyKey == null ? 0 : companyKey;
      var airportKey = localStorage.getItem("Airportlocationkey");
      airportKey = airportKey == null ? 0 : airportKey;
      if (global_companys[companyKey].airports[airportKey].isFilled == "0") {
        if (!$(".main-tab-head").hasClass("hidden"))
          $(".main-tab-head").addClass("hidden");
        $(".comen-set-box").removeClass("hidden");
        $("#edit_service_btn").hide();
      } else {
        if (!$(".comen-set-box").hasClass("hidden"))
          $(".comen-set-box").addClass("hidden");
        $(".main-tab-head").removeClass("hidden");
        $("#edit_service_btn").show();

        var service_provider_companylocation_token = localStorage.getItem(
          "service_provider_company_locationToken"
        );
        if (service_provider_companylocation_token == null) {
          var companylocation_token = localStorage.getItem(
            "dummy_service_provider_company_locationToken"
          );
        } else {
          var companylocation_token = localStorage.getItem(
            "service_provider_company_locationToken"
          );
        }
        service_provider_list(companylocation_token);
      }

      var service_location_name = localStorage.getItem("ServiceLocationName");
      if (service_location_name == null) {
        $(".service_location_name").text(
          localStorage.getItem("dummy_service_location_name")
        );
      } else {
        $(".service_location_name").text(service_location_name);
      }

      var ServiceLocationBusinessType = localStorage.getItem(
        "ServiceLocationBusinessType"
      );
      if (ServiceLocationBusinessType == null) {
        $("#service_location_businesstype").text(
          localStorage.getItem("dummy_service_businesstype")
        );
      } else {
        $("#service_location_businesstype").text(ServiceLocationBusinessType);
      }

      var ServiceLocationAirportName = localStorage.getItem(
        "ServiceLocationAirportName"
      );
      if (ServiceLocationAirportName == null) {
        localStorage.getItem("dummy_service_location_airportname");
      } else {
        $(".service_location_airportname").text(ServiceLocationAirportName);
      }
    }
  });
}

function service_locationbased_airport(
  data1,
  data2,
  data4,
  data5,
  data6,
  data7,
  companyKey,
  airportKey,
  company_status
) {
  if (company_status == "2") {
    localStorage.setItem("service_provider_company_token", data1);
    localStorage.setItem("service_provider_airport_token", data2);
    var datas = {
        airportToken: data2,
      };
      var JsonData = JSON.stringify(datas);
      $.ajax({
        dataType: "JSON",
        type: "POST",
        url: apiPath + "/provider/get_airport_name.php",
        data: JsonData,
      }).done(function (data) {
         let name = data.names[0].airportName;
          $("#airportname").val(name);
          $(".service_location_airportname").text(name);
          localStorage.setItem("ServiceLocationAirportName", name);
      });

    document.getElementById("service_location_image").src = data4;
    $(".service_location_name").text(data5);
    $("#service_location_businesstype").text(data6);
    localStorage.setItem("service_provider_company_locationToken", data7);
    
    localStorage.setItem("ServiceLocationImage", data4);
    localStorage.setItem("ServiceLocationName", data5);
    localStorage.setItem("ServiceLocationBusinessType", data6);
    localStorage.setItem("Servicelocationkey", companyKey);
    localStorage.setItem("Airportlocationkey", airportKey);

    if (global_companys[companyKey].airports[airportKey].isFilled == "0") {
      if (!$(".main-tab-head").hasClass("hidden"))
        $(".main-tab-head").addClass("hidden");
      $(".comen-set-box").removeClass("hidden");
      $("#edit_service_btn").hide();
    } else {
      if (!$(".comen-set-box").hasClass("hidden"))
        $(".comen-set-box").addClass("hidden");
      $(".main-tab-head").removeClass("hidden");
      $("#edit_service_btn").show();
    }
    var service_provider_companylocation_token = localStorage.getItem(
      "service_provider_company_locationToken"
    );
    if (service_provider_companylocation_token == null) {
      var companylocation_token = localStorage.getItem(
        "dummy_service_provider_company_locationToken"
      );
    } else {
      var companylocation_token = localStorage.getItem(
        "service_provider_company_locationToken"
      );
    }
    service_provider_list(companylocation_token);
  }
}

onReady(function () {
  show("page", true);
  show("loading", false);
});

function logout_session() {
  //localStorage.clear();
  localStorgeItems  = ['BookingsToken','logged_name','logged_pic','loginToken','dummy_service_companytoken','dummy_service_businesstype','dummy_service_location_name','dummy_service_provider_company_locationToken','dummy_service_airporttoken','dummy_service_location_airportname','service_provider_company_token','service_provider_airport_token','ServiceLocationAirportName','service_provider_company_locationToken','ServiceLocationImage','ServiceLocationName','ServiceLocationBusinessType','Servicelocationkey','Airportlocationkey','serviceProviderCompanyToken','airportToken'];
    for(i=0; i<localStorgeItems.length; i++){
        localStorage.removeItem(localStorgeItems[i]);
    }
  window.location.href = "logout.php";
}

function createbusiness(){
  if(requiredCompanyToken == null || requiredCompanyToken == '' || requiredCompanyToken == undefined){
    window.location = "index";
  }else{
      let form = `<form id="tokenform" method="post" action="new-service.php">
                      <input hidden type="text" value=${requiredCompanyToken} name="firstCompanyToken">
                  </form>`
          $('body').append(form);
          $('#tokenform').submit();
  }
}
function edit_services(token){
  if(token == null || token == '' || token == undefined){
    window.location = "index";
  }else{
      let form = `<form id="tokenform" method="post" action="edit-service.php">
                      <input hidden type="text" value=${token} name="firstCompanyToken">
                  </form>`
          $('body').append(form);
          $('#tokenform').submit();
  }
}

var prof_name = localStorage.getItem("logged_name");
if (prof_name == "" || prof_name == null) {
  $("#username").text("Admin");
} else {
  $("#username").text(prof_name);
}
var loggedprofile = localStorage.getItem("logged_pic");
if (loggedprofile == "" || loggedprofile == null) {
  $("#staff_imageicon").css("display", "none");
} else {
  $("#staff_imageicon").attr("src", loggedprofile);
}

function editLocationWise(serviceProviderCompanyToken, airportToken){
  localStorage.setItem("serviceProviderCompanyToken", serviceProviderCompanyToken);
  localStorage.setItem("airportToken", airportToken);
    window.location = "edit-location.php";
}
