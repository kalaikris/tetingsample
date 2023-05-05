// Donor List

function back_to_DonorList() {
  $("#toggle1").hide();
  $("#toggle").show();
}

//    Order Management
function showmodal() {
  $("#toggle").hide();
  $("#toggle1").show();
}
function hideModal() {
  $("#toggle").show();
  $("#toggle1").hide();
}
function showmodal2() {
  $("#toggle3").hide();
  $("#toggle11").hide();
  $("#toggle4").show();
}
function showmodal3() {
  $("#toggle11").show();
  $("#toggle4").hide();
}
function showmodal4() {
  $("#toggle5").hide();
  $("#toggle7").show();
}
// completed campaign
function showmodal5() {
  $("#toggle7").hide();
  $("#toggle8").show();
}

// community management
function view_employee() {
  $("#employee").hide();
  $("#employee_view").show();
}

function hidemodal6() {
  $("#employee_view").hide();
  $("#employee").show();
}

// benificiaries

function benificiaries() {
  $("#beneficiaries").hide();
  $("#beneficiaries_view").show();
}

// Donation management
function campaign_donation_view() {
  $("#campaign_donation").hide();
  $("#campaign_donation_view").show();
}

function hidemodalDonation() {
  $("#campaign_donation_view").hide();
  $("#campaign_donation").show();
}

//Inverntry Managemant
function hidemodal() {
  $("#toggle4").hide();
  $("#toggle11").hide();
  $("#toggle3").show();
}
// function showmodal3() {
//   $("#toggle4").hide();
//   $("#toggle11").hide();
// }
function hidemodal1() {
  $("#toggle6").hide();
  $("#toggle5").show();
}

// Donation Managment
$("#pills-home-tabs").click(function () {
  $(".verify_btn").hide();
});
$("#pills-profile-tabs").click(function () {
  $(".verify_btn").show();
});

//Employees

function hidemodal2() {
  $("#daily_summary_view").hide();
  $("#daily_summary").show();
}
function showmodal6() {
  $("#daily_summary").hide();
  $("#daily_summary_view").show();
}

// Date
// $(function () {
//   $("#date_input").datepicker();
//   $("#some").click(function () {
//     $("#date_input").datepicker("show");
//     return false;
//   });
//   $("input:button").click(function () {
//     $("#date_input").datepicker("show");
//   });
// });

// OTP
let digitValidate = function (ele) {
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g, "");
};

let tabChange = function (val, ele) {
  let otpclass = ele.className;
  let otpElem = document.querySelectorAll(`.${otpclass}`);
  if (otpElem[val - 1].value != "") {
    if (val < otpElem.length) {
      // check if last box is currently in focus
      otpElem[val].focus();
    } else {
      otpElem[val - 1].focus();
    }
  } else if (otpElem[val - 1].value == "") {
    if (val - 1 > 0) {
      // change focus except on box 1
      otpElem[val - 2].focus();
    }
  }
};

// Timer
// var timeleft = 30;
// var downloadTimer = setInterval(function () {
//   timeleft--;
//   document.getElementById("countdowntimer").textContent = timeleft;
//   if (timeleft <= 0) clearInterval(downloadTimer);
// }, 1000);
// hide and show

function got_to_forgotPage() {
  $("#login_page").hide();
  $("#forgot_page").show();
  $("#otp_page").hide();
}
function go_to_otp() {
  $("#login_page").hide();
  $("#forgot_page").hide();
  $("#otp_page").show();
}
function go_to_newPass() {
  $("#login_page").hide();
  $("#forgot_page").hide();
  $("#otp_page").hide();
  $("#new_pass_page").show();
}
function go_to_save_pass() {
  $("#login_page").hide();
  $("#forgot_page").hide();
  $("#otp_page").hide();
  $("#new_pass_page").hide();
  $("#pass_changed").show();
}

function go_to_login() {
  $("#login_page").show();
  $("#forgot_page").hide();
  $("#otp_page").hide();
  $("#new_pass_page").hide();
  $("#pass_changed").hide();
}

// $(document).ready(function(){

//     $('.custom-table').DataTable({
//         scrollX: true,
//         dom: '<f<"table-container"t>lp>'
//     });

// })
