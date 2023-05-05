let adminToken = localStorage.getItem("adminToken");
let adminName = localStorage.getItem("adminName");
adminName = adminName.charAt(0).toUpperCase() + adminName.slice(1);
function logout() {
  //localStorage.clear();
  localStorgeItems  = ['adminToken','adminName'];
   for(i=0; i<localStorgeItems.length; i++){
       localStorage.removeItem(localStorgeItems[i]);
   }
  window.location = "logout.php";
}

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
      adminToken: adminToken,
      currentPassword: currentPassword,
      newPassword: newPassword,
    };
    let json1 = JSON.stringify(datas);
    console.log(datas);
    $.ajax({
      dataType: "JSON",
      type: "POST",
      url: apiPath + "/admin/adminUpdatePassword.php",
      data: json1,
    }).done(function (data1) {
      console.log(data1);
      if (data1.status_code == 201) {
        swal({
          title: data1.title,
          text: data1.message,
          icon: "success",
        }).then(() => {
          logout();
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
$(document).ready(function () {
  if (adminToken == "" || adminToken == undefined) {
    window.location = "login.php";
  }
  var header1 = '<div class="head-logo">';
  header1 +=
    '<a href="home.php"><img class="logo" src="./assets_new/header/logo%202.png" alt="logo"></a>';
  header1 += "</div>";
  header1 += '<div class="back-drop hidden"></div>';
  header1 += '<div class="nav-menu">';
  header1 += '<ul class="nav-links">';
  header1 +=
    '<li id="home-btn" class="hidden"><a href="home.php"><img src="assets/icons/home_icon.svg" alt=""></a></li>';
  header1 +=
    '<li id="bell-btn" class="hidden"><a href="notification.php"><img src="assets/icons/notification_icon.svg" alt=""></a></li>';
  header1 += '<li id="profile">';
  header1 += '<div class="dropdown-logout">';
  header1 += `<a class="logout-toggle" href="#" role="button" id="logoutdropdownMenuLink" aria-expanded="false"><span class="hidden" id="profile-pic"><img src="assets_new/header/profile.png" alt=""></span><span class="profile-name">${adminName}</span>`;
  header1 += "</a>";
  header1 += '<div class="dropdown-menu">';
  // header1 += '<a class="dropdown-item" href="#">Action</a>';
  header1 +=
    '<a class="dropdown-item" href="javascript:void(0)" data-target="#resetPassword" onclick="fieldsclear()" data-toggle="modal">Change Password</a>';
  header1 += '<a class="dropdown-item" href="#" onclick="logout()">Logout</a>';
  header1 += "</div>";
  header1 += "</div>";
  header1 += "</li>";
  header1 += "</ul>";
  header1 += "</div>";
  let resetPass = `<div class="modal" id="resetPassword">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title text-center">Change Password</h4>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
             <div class="modal_input-container">
                  <div class="input__box">
                      <label class="form__label">Current Password</label>
                      <input type="password" name="" placeholder="Enter current password" id="current-pass" class="form__input">
                      <div class="eye_icon">
                          <p><i class="current-pass fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                      </div>
                  </div>
                  <div class="input__box">
                      <label class="form__label">New Password</label>
                      <input type="password" name="" placeholder="Enter new password" id="new-pass" class="form__input">
                      <div class="eye_icon">
                          <p><i class="new-pass fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                      </div>
                  </div> 
                  <div class="input__box">
                      <label class="form__label">Confirm Password</label>
                      <input type="password" name="" placeholder="Confirm new password" id="confirm-pass" class="form__input">
                      <div class="eye_icon">
                          <p><i class="confirm-pass fa fa-eye-slash toggle-password" aria-hidden="true"></i></p>
                      </div>
                  </div>
             </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="modal_btn cancel_modal_btn" data-dismiss="modal">Cancel</button>
              <button type="button" onclick="passwordchange()" class="modal_btn creat_modal_btn addcredits">Change</button>
          </div>
      </div>
  </div>
</div>`;

  let faLink = document.createElement("link");
  faLink.rel = "stylesheet";
  faLink.href =
    "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css";
  document.head.prepend(faLink);
  $("#main-dash-header").html(header1);
  $("body").append(resetPass);

  $(".toggle-password").click(function () {
    var id = this.classList[0];
    if ($("#" + id).attr("type") == "password") {
      $("#" + id).attr("type", "text");
      this.classList.remove('fa-eye-slash');
      this.classList.add('fa-eye');
    } else {
      $("#" + id).attr("type", "password");
      this.classList.add('fa-eye-slash');
      this.classList.remove('fa-eye');
    }
  });

  //update password

  // open logout

  const logoutToggle = document.querySelector(".logout-toggle");
  const backDrop = document.querySelector(".back-drop");
  let getAriaAtrr = Boolean(logoutToggle.getAttribute("aria-expanded"));
  logoutToggle.addEventListener("click", () => {
    if (getAriaAtrr) {
      backDrop.classList.remove("hidden");
      document.querySelector(".dropdown-logout").classList.add("open");

      getAriaAtrr = false;
    } else {
      backDrop.classList.add("hidden");
      document.querySelector(".dropdown-logout").classList.remove("open");
      getAriaAtrr = true;
    }
  });
  backDrop.addEventListener("click", () => {
    document.querySelector(".dropdown-logout").classList.remove("open");
    getAriaAtrr = true;
    backDrop.classList.add("hidden");
  });
});
