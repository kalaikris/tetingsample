$(document).ready(function () {
  var sidebar1 = '<div class="sidebar-header">';
  sidebar1 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar1 += "</div>";

  sidebar1 += '<h2 class="project-head">User Management</h2>';
  sidebar1 += '<div class="sidebar-menu">';
  sidebar1 += "<ul>";
  sidebar1 += '<li class="project-menu">';
  sidebar1 += '<a class="donor_list sidebar-link" href="user-list">';
  sidebar1 +=
    '<img src="assets_new/svg/Donor List.svg" class="side-icon" alt="side icon">';
  sidebar1 += "<span>User List</span>";
  sidebar1 += "</a>";
  sidebar1 += "</li>";
  sidebar1 += '<li class="project-menu">';
  sidebar1 += '<a class="donor_list sidebar-link" href="agent-list">';
  sidebar1 +=
    '<img src="assets_new/sidebar/Agent List@2x.png" class="side-icon" alt="side icon">';
  sidebar1 += "<span>Agent List</span>";
  sidebar1 += "</a>";
  sidebar1 += "</li>";
  sidebar1 += '<li class="project-menu" hidden>';
  sidebar1 +=
    '<a class="blocked_userList sidebar-link" href="blocked_userList">';
  sidebar1 +=
    '<img src="assets_new/svg/Block Campaigns.svg" class="side-icon" alt="side icon">';
  sidebar1 += "<span>Blocked User</span>";
  sidebar1 += "</a>";
  sidebar1 += "</li>";
  sidebar1 += "</ul>";
  sidebar1 += "</div>";

  var sidebar2 = '<div class="sidebar-header">';
  sidebar2 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar2 += "</div>";

  sidebar2 += '<h2 class="project-head">Service Provider Management</h2>';
  sidebar2 += '<div class="sidebar-menu">';
  sidebar2 += "<ul>";
  sidebar2 += '<li class="project-menu">';
  sidebar2 += '<a class="manage_campgin sidebar-link" href="Service-Provider">';
  sidebar2 +=
    '<img src="assets_new/svg/Manage Campaign.svg" class="side-icon" alt="side icon">';
  sidebar2 += "<span>Service Provider</span>";
  sidebar2 += "</a>";
  sidebar2 += "</li>";
  sidebar2 += '<li class="project-menu">';
  sidebar2 +=  '<a class="campaign_request sidebar-link" href="Business-Request">';
  sidebar2 +=  '<img src="assets_new/svg/New Campaign Request.svg" class="side-icon" alt="side icon">';
  sidebar2 +=  "<span>Business Request List</span>";
  sidebar2 +=  "</a>";
  sidebar2 += "</li>";
  sidebar2 += '<li class="project-menu">';
  sidebar2 +=  '<a class="campaign_request sidebar-link" href="sp_dashboard">';
  sidebar2 +=  '<img src="assets_new/svg/New Campaign Request.svg" class="side-icon" alt="side icon">';
  sidebar2 +=  "<span>Dashboard</span>";
  sidebar2 +=  "</a>";
  sidebar2 += "</li>";
  sidebar2 += "</ul>";
  sidebar2 += "</div>";

  var sidebar3 = '<div class="sidebar-header">';
  sidebar3 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar3 += "</div>";

  sidebar3 += '<h2 class="project-head">Service Distributor Management</h2>';
  sidebar3 += '<div class="sidebar-menu">';
  sidebar3 += "<ul>";
  sidebar3 += '<li class="project-menu">';
  sidebar3 +=
    '<a class="manage_volunteer_list sidebar-link" href="Service-Distributor">';
  sidebar3 +=
    '<img src="assets_new/svg/Manage Volunteer List.svg" class="side-icon" alt="side icon">';
  sidebar3 += "<span>Service Distributor</span>";
  sidebar3 += "</a>";
  sidebar3 += "</li>";
  sidebar3 += '<li class="project-menu">';
  sidebar3 +=
    '<a class="manage_volunteer_list sidebar-link" href="membership">';
  sidebar3 +=
    '<img src="assets_new/svg/Manage Volunteer List.svg" class="side-icon" alt="side icon">';
  sidebar3 += "<span>Membership</span>";
  sidebar3 += "</a>";
  sidebar3 += "</li>";
  sidebar3 += '<li class="project-menu">';
  sidebar3 +=
    '<a class="manage_volunteer_list sidebar-link" href="sd_dashboard">';
  sidebar3 +=
    '<img src="assets_new/svg/Manage Volunteer List.svg" class="side-icon" alt="side icon">';
  sidebar3 += "<span>Dashboard</span>";
  sidebar3 += "</a>";
  sidebar3 += "</li>";
  sidebar3 += "</ul>";
  sidebar3 += "</div>";

  var sidebar4 = '<div class="sidebar-header">';
  sidebar4 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar4 += "</div>";

  sidebar4 += '<h2 class="project-head">Master Data Management</h2>';
  sidebar4 += '<div class="sidebar-menu">';
  sidebar4 += "<ul>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 +=
    '<a class="campaign_donation sidebar-link" href="service_list.php">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Service List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Services List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="pot_donation sidebar-link" href="amenities">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Amenities List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Amenities List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="pot_donation sidebar-link" href="partner">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Partners List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Partners List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="pot_donation sidebar-link" href="business_list">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Business Type List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Business List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="pot_donation sidebar-link" href="agent_type_list">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Agent Type List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Agent Type List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="pot_donation sidebar-link" href="who_can_use">';
  sidebar4 +=
    '<img src="assets_new/sidebar/Agent List@2x.png" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Who Can Use</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="sidebar-link" href="airport_list">';
  sidebar4 +=
    '<img src="assets_new/sidebar/airport-list.svg" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Airport List</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="sidebar-link" href="cancel-charge">';
  sidebar4 +=
    '<img src="assets_new/sidebar/cancel-charge.svg" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Cancellation Charge</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu" hidden>';
  sidebar4 += '<a class="sidebar-link" href="commission-charge">';
  sidebar4 +=
    '<img src="assets_new/sidebar/discount.svg" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Commission Charge</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="sidebar-link" href="miles">';
  sidebar4 +=
    '<img src="assets_new/sidebar/milestone.svg" class="side-icon" alt="side icon">';
  sidebar4 += "<span>Miles</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += '<li class="project-menu">';
  sidebar4 += '<a class="sidebar-link" href="gst_num_region">';
  sidebar4 +=
    '<img src="assets_new/sidebar/reports/provider.svg" class="side-icon" alt="side icon">';
  sidebar4 += "<span>GST Number</span>";
  sidebar4 += "</a>";
  sidebar4 += "</li>";
  sidebar4 += "</ul>";
  sidebar4 += "</div>";
  var sidebar5 = '<div class="sidebar-header">';
  sidebar5 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar5 += "</div>";

  sidebar5 += '<h2 class="project-head">Outstanding Management</h2>';
  sidebar5 += '<div class="sidebar-menu">';
  sidebar5 += "<ul>";
  sidebar5 += '<li class="project-menu">';
  sidebar5 += '<a class="sidebar-link" href="#">';
  sidebar5 +=
    '<img src="assets_new/banner.png" class="side-icon" alt="side icon">';
  sidebar5 += "<span>Data Management</span>";
  sidebar5 += "</a>";
  sidebar5 += "</li>";
  sidebar5 += "</ul>";
  sidebar5 += "</div>";

  var sidebar6 = '<div class="sidebar-header">';
  sidebar6 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar6 += "</div>";

  sidebar6 += '<h2 class="project-head">Shedule Management</h2>';
  sidebar6 += '<div class="sidebar-menu">';
  sidebar6 += "<ul>";
  sidebar6 += '<li class="project-menu">';
  sidebar6 += '<a class="sidebar-link" href="daily-shedule">';
  sidebar6 +=
    '<img src="assets_new/icons/daily_schedule_pink.svg" class="side-icon" alt="side icon">';
  sidebar6 += "<span>Daily Shedule</span>";
  sidebar6 += "</a>";
  sidebar6 += "</li>";
  sidebar6 += '<li class="project-menu">';
  sidebar6 += '<a class="sidebar-link" href="unit-grouping">';
  sidebar6 +=
    '<img src="assets_new/icons/unit_grouping_icon.svg" class="side-icon" alt="side icon">';
  sidebar6 += "<span>Unit Grouping</span>";
  sidebar6 += "</a>";
  sidebar6 += "</li>";
  sidebar6 += "</ul>";
  sidebar6 += "</div>";

  var sidebar7 = '<div class="sidebar-header">';
  sidebar7 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar7 += "</div>";

  sidebar7 += '<h2 class="project-head">Gift Management</h2>';
  sidebar7 += '<div class="sidebar-menu">';
  sidebar7 += "<ul>";
  sidebar7 += '<li class="project-menu">';
  sidebar7 += '<a class="sidebar-link" href="shop-list">';
  sidebar7 +=
    '<img src="assets_new/icons/offer_list_icon.svg" class="side-icon" alt="side icon">';
  sidebar7 += "<span>Shop List</span>";
  sidebar7 += "</a>";
  sidebar7 += "</li>";
  sidebar7 += '<li class="project-menu">';
  sidebar7 += '<a class="sidebar-link" href="slot">';
  sidebar7 +=
    '<img src="assets_new/icons/slots_icon.svg" class="side-icon" alt="side icon">';
  sidebar7 += "<span>Slots</span>";
  sidebar7 += "</a>";
  sidebar7 += "</li>";
  sidebar7 += "</ul>";
  sidebar7 += "</div>";

  var sidebar8 = '<div class="sidebar-header">';
  sidebar8 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar8 += "</div>";

  sidebar8 += '<h2 class="project-head">Offer Management</h2>';
  sidebar8 += '<div class="sidebar-menu">';
  sidebar8 += "<ul>";
  sidebar8 += '<li class="project-menu">';
  sidebar8 += '<a class="sidebar-link" href="offer">';
  sidebar8 +=
    '<img src="assets_new/icons/offer_list_icon.svg" class="side-icon" alt="side icon">';
  sidebar8 += "<span>Offer List</span>";
  sidebar8 += "</a>";
  sidebar8 += "</li>";
  sidebar8 += "</ul>";
  sidebar8 += "</div>";

  var sidebar9 = '<div class="sidebar-header">';
  sidebar9 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar9 += "</div>";

  sidebar9 += '<h2 class="project-head">User roles and Access</h2>';
  sidebar9 += '<div class="sidebar-menu">';
  sidebar9 += "<ul>";
  sidebar9 += '<li class="project-menu">';
  sidebar9 += '<a class="user_role-list sidebar-link" href="user-role-list">';
  sidebar9 +=
    '<img src="assets_new/svg/user-list.svg" class="side-icon" alt="side icon">';
  sidebar9 += "<span>User List</span>";
  sidebar9 += "</a>";
  sidebar9 += "</li>";
  sidebar9 += '<li class="project-menu">';
  sidebar9 += '<a class="sidebar-link" href="user-role">';
  sidebar9 +=
    '<img src="assets_new/svg/user-role.svg" class="side-icon" alt="side icon">';
  sidebar9 += "<span>User Roles</span>";
  sidebar9 += "</a>";
  sidebar9 += "</li>";
  sidebar9 += "</ul>";
  sidebar9 += "</div>";

  var sidebar10 = '<div class="sidebar-header">';
  sidebar10 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar10 += "</div>";

  sidebar10 += '<h2 class="project-head">Legal and settings</h2>';
  sidebar10 += '<div class="sidebar-menu">';
  sidebar10 += "<ul>";
  sidebar10 += '<li class="project-menu">';
  sidebar10 += '<a class="sidebar-link" href="privacy-policy">';
  sidebar10 +=
    '<img src="assets_new/icons/privacy_policy_icon.svg" class="side-icon" alt="side icon">';
  sidebar10 += "<span>Privacy Policy</span>";
  sidebar10 += "</a>";
  sidebar10 += "</li>";
  sidebar10 += '<li class="project-menu">';
  sidebar10 += '<a class="sidebar-link" href="terms-condition">';
  sidebar10 +=
    '<img src="assets_new/icons/terms_and_conditions_icon.svg" class="side-icon" alt="side icon">';
  sidebar10 += "<span>Terms and Conditions</span>";
  sidebar10 += "</a>";
  sidebar10 += "</li>";
  sidebar10 += "</ul>";
  sidebar10 += "</div>";

  var sidebar11 = '<div class="sidebar-header">';
  sidebar11 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar11 += "</div>";

  sidebar11 += '<h2 class="project-head">Notification Managenment</h2>';
  sidebar11 += '<div class="sidebar-menu">';
  sidebar11 += "<ul>";
  sidebar11 += '<li class="project-menu">';
  sidebar11 += '<a class="sidebar-link" href="notification">';
  sidebar11 +=
    '<img src="assets_new/icons/notification_list_icon.svg" class="side-icon" alt="side icon">';
  sidebar11 += "<span>Notification List</span>";
  sidebar11 += "</a>";
  sidebar11 += "</li>";
  sidebar11 += "</ul>";
  sidebar11 += "</div>";

  var sidebar12 = '<div class="sidebar-header">';
  sidebar12 +=
    '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
  sidebar12 += "</div>";

  sidebar12 += '<h2 class="project-head">Report Management</h2>';
  sidebar12 += '<div class="sidebar-menu">';
  sidebar12 += "<ul>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="reports">';
  sidebar12 +=
    '<img src="assets_new/sidebar/distributor-report.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Distributor Register</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="provider-reports">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/provider.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Provider Register</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="sales-dashboard">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/sales-dashboard.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Sales Dashboard</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="sample-transactions">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/transaction-report.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Transactions Report</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="credit-register-report.php">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/credit-note.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Credit Note Register</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="sales-register-report.php">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/sales.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Sales Register</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";

  sidebar12 += '<li class="project-menu">';
  sidebar12 += '<a class="sidebar-link" href="revenueprice-reports.php">';
  sidebar12 +=
    '<img src="assets_new/sidebar/reports/revenue.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>Price Master</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";
  sidebar12 += '<li class="project-menu hidden">';
  sidebar12 += '<a class="sidebar-link" href="sp-agreementprice-reports.php">';
  sidebar12 += '<img src="assets_new/sidebar/reports/agreement.svg" class="side-icon" alt="side icon">';
  sidebar12 += "<span>SP Agreement Price List</span>";
  sidebar12 += "</a>";
  sidebar12 += "</li>";

sidebar12 += '<li class="project-menu">';
sidebar12 += '<a class="sidebar-link" href="distributor-report.php">';
sidebar12 += '<img src="assets_new/sidebar/reports/sales.svg" class="side-icon" alt="side icon">';
sidebar12 += "<span>Distributor Commission Report</span>";
sidebar12 += "</a>";
sidebar12 += "</li>";
sidebar12 += '<li class="project-menu">';
sidebar12 += '<a class="sidebar-link" href="sp-report.php">';
sidebar12 += '<img src="assets_new/sidebar/reports/sales.svg" class="side-icon" alt="side icon">';
sidebar12 += "<span>Sp Reports</span>";
sidebar12 += "</a>";
sidebar12 += "</li>";
sidebar12 += '<li class="project-menu">';
sidebar12 += '<a class="sidebar-link" href="customer-journey.php">';
sidebar12 += '<img src="assets_new/sidebar/reports/sales.svg" class="side-icon" alt="side icon">';
sidebar12 += "<span>Customer Journey Reports</span>";
sidebar12 += "</a>";
sidebar12 += "</li>";
sidebar12 += '<li class="project-menu">';
sidebar12 += '<a class="sidebar-link" href="mis-reports.php">';
sidebar12 += '<img src="assets_new/sidebar/reports/sales.svg" class="side-icon" alt="side icon">';
sidebar12 += "<span>MIS Finance</span>";
sidebar12 += "</a>";
sidebar12 += "</li>";
sidebar12 += "</ul>";
sidebar12 += "</div>";

var sidebar13 = '<div class="sidebar-header">';
sidebar13 += '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
sidebar13 += "</div>";

sidebar13 += '<h2 class="project-head">Booking Management</h2>';
sidebar13 += '<div class="sidebar-menu">';
sidebar13 += "<ul>";
sidebar13 += '<li class="project-menu">';
sidebar13 += '<a class="sidebar-link" href="booking-management">';
sidebar13 += '<img src="assets_new/sidebar/booking.svg" class="side-icon" alt="side icon">';
sidebar13 += "<span>Booking Management</span>";
sidebar13 += "</a>";
sidebar13 += "</li>";
sidebar13 += '<li class="project-menu">';
sidebar13 += '<a class="sidebar-link" href="cancelled-bookings">';
sidebar13 += '<img src="assets_new/sidebar/booking.svg" class="side-icon" alt="side icon">';
sidebar13 += "<span>Cancelled Bookings</span>";
sidebar13 += "</a>";
sidebar13 += "</li>";
sidebar13 += '<li class="project-menu">';
sidebar13 += '<a class="sidebar-link" href="internal-booking">';
sidebar13 += '<img src="assets_new/sidebar/internal-booking.svg" class="side-icon" alt="side icon">';
sidebar13 += "<span>Internal Bookings</span>";
sidebar13 += "</a>";
sidebar13 += "</li>";
sidebar13 += '<li class="project-menu" hidden>';
sidebar13 += '<a class="sidebar-link" href="javascript:void(0)">';
sidebar13 += '<img src="assets_new/sidebar/cancelled.svg" class="side-icon" alt="side icon">';
sidebar13 += "<span>Cancelled Bookings</span>";
sidebar13 += "</a>";
sidebar13 += "</li>";
sidebar13 += "</ul>";
sidebar13 += "</div>";

var sidebar14 = '<div class="sidebar-header">';
sidebar14 += '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
sidebar14 += "</div>";

sidebar14 += '<h2 class="project-head">Coupon code Managenment</h2>';
sidebar14 += '<div class="sidebar-menu">';
sidebar14 += "<ul>";
sidebar14 += '<li class="project-menu">';
sidebar14 += '<a class="sidebar-link" href="coupon_list">';
sidebar14 += '<img src="assets_new/sidebar/coupon.svg" class="side-icon" alt="side icon">';
sidebar14 += "<span>Coupon List</span>";
sidebar14 += "</a>";
sidebar14 += "</li>";
sidebar14 += "</ul>";
sidebar14 += "</div>";

var sidebar15 = '<div class="sidebar-header">';
sidebar15 += '<label for="sidebar-toggle" class="side-togglebar"><img src="assets/svg/menu-arrw.svg" alt=""></label>';
sidebar15 += "</div>";
sidebar15 += '<h2 class="project-head hidden">Branch Management</h2>';
sidebar15 += '<div class="sidebar-menu">';
sidebar15 += "<ul>";
sidebar15 += '<li class="project-menu">';
sidebar15 += '<a class="campaign_donation sidebar-link" href="web-banner.php">';
sidebar15 += '<img src="assets_new/sidebar/Service List@2x.png" class="side-icon" alt="side icon">';
sidebar15 += "<span>Banner Page</span>";
sidebar15 += "</a>";
sidebar15 += "</li>";
sidebar15 += '<li class="project-menu hidden">';
sidebar15 += '<a class="pot_donation sidebar-link" href="web-terms.php">';
sidebar15 += '<img src="assets_new/sidebar/Amenities List@2x.png" class="side-icon" alt="side icon">';
sidebar15 += "<span>Terms and Condition</span>";
sidebar15 += "</a>";
sidebar15 += "</li>";
sidebar15 += '<li class="project-menu hidden">';
sidebar15 += '<a class="pot_donation sidebar-link" href="web-privacy.php">';
sidebar15 += '<img src="assets_new/sidebar/discount.svg" class="side-icon" alt="side icon">';
sidebar15 += "<span>Privacy Policy</span>";
sidebar15 += "</a>";
sidebar15 += "</li>";
sidebar15 += '<li class="project-menu hidden">';
sidebar15 += '<a class="pot_donation sidebar-link" href="web-reviews.php">';
sidebar15 += '<img src="assets_new/sidebar/milestone.svg" class="side-icon" alt="side icon">';
sidebar15 += "<span>Airpotzo Reviews</span>";
sidebar15 += "</a>";
sidebar15 += "</li>";
sidebar15 += "</ul>";
sidebar15 += "</div>";

$("#sidebar1").html(sidebar1);
$("#sidebar2").html(sidebar2);
$("#sidebar3").html(sidebar3);
$("#sidebar4").html(sidebar4);
$("#sidebar5").html(sidebar5);
$("#sidebar6").html(sidebar6);
$("#sidebar7").html(sidebar7);
$("#sidebar8").html(sidebar8);
$("#sidebar9").html(sidebar9);
$("#sidebar10").html(sidebar10);
$("#sidebar11").html(sidebar11);
$("#sidebar12").html(sidebar12);
$("#sidebar13").html(sidebar13);
$("#sidebar14").html(sidebar14);
$("#sidebar15").html(sidebar15);

// sidebar active
const currentLocation = location.href;
const menuItems = document.querySelectorAll(".sidebar-link");
const menuLength = menuItems.length;
for (let i = 0; i < menuLength; i++) {
  if (menuItems[i].href === currentLocation) {
    menuItems[i].classList.add("active-sidemenu");
  }
}
});