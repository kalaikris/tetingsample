<?php
include 'php/site-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Airportzo | Agent Application</title>
	<link rel="shortcut icon" id="favicon-logo">
	<link rel="stylesheet" href="css/bootstrap.min.3.3.5.css">
	<link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/intlTelInput.css<?php echo $cache_str; ?>" />
	<link rel="stylesheet" href="css/fonts.css<?php echo $cache_str; ?>">
	<link rel="stylesheet" href="css/main.css<?php echo $cache_str; ?>">
	<link rel="stylesheet" href="css/custom.css<?php echo $cache_str; ?>">
	<link rel="stylesheet" href="css/index.css<?php echo $cache_str; ?>">
	<link rel="stylesheet" href="css/checkout-process.css<?php echo $cache_str; ?>">
	<link rel="stylesheet" href="css/agent.css<?php echo $cache_str; ?>">

    <script src="js/onloads.js<?php echo $cache_str; ?>"></script>
</head>

<body onload="loadDistributorDetail();">
	<main class="main become-agent-container">
		<div id="loading"></div>

		<header></header> <!-- HEADER -->
		<nav></nav> <!-- NAV MENU -->

		<section class="banner__section">
			<div class="container">
				<div class="col-md-6">
					<div class="banner-desc-box">
						<h1>Grow and earn smarter with AirportZo Agent!</h1>
						<p>Book tickets and earn commissions without investing anything out of your pocket</p>
					</div>
					<a href="#agent-form" class="become_agent-btn">Become an agent now</a>
				</div>
				<div class="col-md-6">
					<div class="landing__image-box text-center">
						<img src="asset/agent/landing_illustration.svg" alt="banner image">
					</div>
				</div>
			</div>
		</section>

		<section class="commission_card-sec">
			<div class="container">
				<div class="col-sm-12">
					<div class="commission_card">
						<div class="img-box">
							<img src="asset/agent/comm-illustration.svg" alt="illustration">
						</div>
						<div class="commission__desc">
							<h1>15%</h1>
							<p>commissions on each booking</p>
							<img src="asset/agent/bolt.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="why-az-sec">
			<div class="container">
				<div class="heading-set">
					<h2>Why AirportZo?</h2>
				</div>
				<div class="why-az-content">
					<div class="why-az-content-box">
						<img src="asset/agent/badge.svg" alt="icon">
						<div class="b-header-set">
							<h1>10+</h1>
							<p>year of exellence</p>
						</div>
					</div>
					<div class="why-az-content-box">
						<img src="asset/agent/agent.svg" alt="icon">
						<div class="b-header-set">
							<h1>25,000+</h1>
							<p>Registered Agents</p>
						</div>
					</div>
					<div class="why-az-content-box">
						<img src="asset/agent/support.svg" alt="icon">
						<div class="b-header-set">
							<h1>24/7</h1>
							<p>Agent Support</p>
						</div>
					</div>
					<div class="why-az-content-box">
						<img src="asset/agent/payment.svg" alt="icon">
						<div class="b-header-set">
							<h1>100%</h1>
							<p>Monthly Payments</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="how-it-works-sec">
			<div class="container">
				<div class="how-it-works-box">
					<div class="heading-set">
						<h2>How it Works?</h2>
					</div>
					<div class="steps_container">
						<ul class="steps">
							<li>
								<p>Step 1</p>
								<p>Join as AirportZo agent commissions on booking.</p>
							</li>
							<li>
								<p>Step 2</p>
								<p>Book services for others and earn 15% commission on each booking made.</p>
							</li>
							<li>
								<p>Step 3</p>
								<p>Get monthly payments on time from AirportZo</p>
							</li>
						</ul>
					</div>
					<div class="how-it-works-img text-center">
					    <img src="asset/agent/how-illustration.svg" alt="vector img">
					</div>
				</div>
			</div>
		</section>

		<section class="agent-story-sec">
			<div class="container-fluid">
				<div class="heading-set">
					<h2>Story of other AirportZo Agents</h2>
				</div>
				<div class="owl-carousel owl-theme aboutus-owl" id="aboutus">
					<div class="items">
						<div class="aboutus-set">
							<div class="aboutus-desc-set ">
								<h4>Mohita Verma</h4>
								<p>I would like to place my appreciationand very mant thanks to the excellent service I received recently at Delhi airport by Airportzo team. I was travelling with an infant and the Care and attention I received was commendable. I will always recommend Airportzo to any parent travelling with a child or to elderly parents as the value for money is exceptional. I commend your training and persons and personalities you employ. I look forward to returning in a few weeks tims and using Airportzo services once again.</p>
							</div>
						</div>
					</div>
					<div class="items">
						<div class="aboutus-set">
							<div class="aboutus-desc-set ">
								<h4>Mohita Verma</h4>
								<p>I would like to place my appreciationand very mant thanks to the excellent service I received recently at Delhi airport by Airportzo team. I was travelling with an infant and the Care and attention I received was commendable. I will always recommend Airportzo to any parent travelling with a child or to elderly parents as the value for money is exceptional. I commend your training and persons and personalities you employ. I look forward to returning in a few weeks tims and using Airportzo services once again.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="become-agent-form-section" id="agent-form">
			<div class="container">
				<input type="hidden" id="gtag_id">
				<div class="heading-set">
					<h2>Become an agent</h2>
					<p>Apply for AirportZo agent and earn a side income</p>
				</div>
				<!-- <div class="stepwizard">
					<div class="stepwizard-row setup-panel">
						<div class="stepwizard-step">
							<span type="button" class="btn step-btn btn-circle on-status"></span>
							<p>Agent Details</p>
						</div>
						<div class="stepwizard-step">
							<span type="button" class="btn step-btn btn-circle" disabled=""></span>
							<p>Other Details</p>
						</div>
					</div>
				</div> -->
				<div class="agent-details-form" id="step-1">
					<div class="upload__image-container text-center">
						<img src="asset/profile/user.jpg" class="profile-img profile-big" id="user-img" alt="icon" style="display: none;">
						<input type="file" name="" class="update-profile hidden" id="update-img" accept="image/png, image/jpg, image/jpeg" onchange="image_upload()">
						<svg class="user-svg user-svg-big" width="100" height="100" viewBox="0 0 86 86" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="user-icon"><g id="circles"><mask id="mask0_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="86" height="86"><g id="mask-2"><path id="Vector" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="white"/></g></mask><g mask="url(#mask0_104_13)"><path id="user-circle2" opacity="0.1" d="M43 86C66.7482 86 86 66.7482 86 43C86 19.2518 66.7482 0 43 0C19.2518 0 0 19.2518 0 43C0 66.7482 19.2518 86 43 86Z" fill="#F04F38"/></g><mask id="mask1_104_13" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="6" width="74" height="74"><g id="mask-4"><path id="Vector_2" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="white"/></g></mask><g mask="url(#mask1_104_13)"><path id="user-circle1" opacity="0.14" d="M43 80C63.4345 80 80 63.4345 80 43C80 22.5655 63.4345 6 43 6C22.5655 6 6 22.5655 6 43C6 63.4345 22.5655 80 43 80Z" fill="#F04F38"/></g></g><g id=""><path id="user-icon" fill-rule="evenodd" clip-rule="evenodd" d="M42.7472 43.7403C48.164 43.7403 52.5553 39.3213 52.5553 33.8701C52.5553 28.419 48.164 24 42.7472 24C37.3303 24 32.9391 28.419 32.9391 33.8701C32.9391 39.3213 37.3303 43.7403 42.7472 43.7403ZM26 51.9232C29.9016 58.6411 35.4839 62 42.7472 62C50.0104 62 55.7613 58.6411 60 51.9232C57.3035 46.9087 53.9351 44.4014 49.8946 44.4014C48.8343 44.4014 48.243 46.4057 43 46.4057C37.757 46.4057 36.7574 44.4014 35.9238 44.4014C31.8177 44.5735 28.5097 47.0808 26 51.9232Z" fill="#F04F38"/></g></g></svg>
						<label for="update-img">Update Image</label>
						<!-- <label for="upload-agent-img">
							<img src="asset/agent/addimg.png" alt="upload">
						</label>
						<input type="file" name="" id="upload-agent-img" class="hidden"> -->
					</div>
					<div class="add__passenger-form">
						<form action="" onsubmit="event.preventDefault();">
							<div class="input-form-group-item">
								<div class="select-group">
									<select class="select-box" id="user-title">
										<option value="NULL">NULL</option>
										<option value="Mr">Mr.</option>
										<option value="Mrs">Mrs.</option>
										<option value="Ms">Ms.</option>
									</select>
								</div>
								<div class="input-box-set border-right">
									<p>Agent Name</p>
									<input type="text" class="input-box" id="user-name" placeholder="Enter your name">
								</div>
							</div>
							<div class="login-input-group phone">
								<p>Mobile Number</p>
								<input type="tel" class="login-input-box" id="user-mobile_number" name="phone" />
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Contact Email Address</p>
									<input type="text" class="input-box" id="user-email" placeholder="example@gmail.com">
								</div>
							</div>
							<div class="dob-input input-group" id="arrive_date">
								<label for="agent-dob" class="input-group-addon bg-date"></label>
								<label for="agent-dob">Date of birth</label>
								<input type="text" class="b-input datepicker" id="user-dob" placeholder="DD-MMM-YYYY" readonly="">
							</div>

							<hr class="form-divider">

							<div class="side-header-set">
								<h3>Address</h3>
								<p>Tell us where you are residing</p>
							</div>

							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Address</p>
									<input type="text" class="input-box" id="address" placeholder="Enter address">
								</div>
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Country</p>
									<select name="" id="country" onchange="countryChange()">
										<option value="">Select the Country</option>
									</select>
								</div>
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>State</p>
									<select name="" id="region" onchange="regionChange()">
										<option value="">Select the State</option>
									</select>
								</div>
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>City</p>
									<select name="" id="city">
										<option value="">Select the City</option>
									</select>
								</div>
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Pincode</p>
									<input type="number" class="input-box" id="pincode" placeholder="Enter Pincode">
								</div>
							</div>

							<hr class="form-divider">
							<div class="side-header-set">
								<h3>Link your bank</h3>
								<p>This will help us to send payments on your bookings</p>
							</div>

							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Account Number</p>
									<input type="number" class="input-box" id="account_number" placeholder="Enter account number">
								</div>
							</div>
							<div class="input-form-group-item">
								<div class="input-box-set">
									<p>Re-enter Account Number</p>
									<input type="number" class="input-box" id="re_account_number" placeholder="Enter account number">
								</div>
							</div>
							<div class="input-form-group-item" id="ifsc-box">
								<div class="input-box-set">
									<p>IFSC Code</p>
									<input type="text" class="input-box" id="ifsc_code" oninput="checkIFSC()" placeholder="Enter IFSC code">
								</div>
							</div>
							<p class="bank-branch" id="branch_name">Madipakkam - Chennai</p>

							<hr class="form-divider">
							
							<div class="side-header-set">
								<h3>Upload documents</h3>
								<p>This is for verification purpose</p>
							</div>

							<div class="upload__docs-container">
								<div class="upload__doc-box">
									<h4 class="doc-name">PAN Card</h4>
									<input type="file" name="" class="update-profile hidden" id="pan_card" onchange="pan_upload()">
									<!-- accept="image/png, image/jpg, image/jpeg"  -->
									<label id="pan-uploader" for="pan_card">Upload</label>
									<div class="uploaded-box hidden" id="pan-uploaded">
										<span type="button" class="btn step-btn btn-circle status-completed"></span>
										<span>Uploaded</span>
										<img src="asset/close.svg" alt="x" onclick="clearDoc('pan')">
									</div>
								</div>
								<div class="upload__doc-box">
									<h4 class="doc-name">Address Proof</h4>
									<input type="file" name="" class="update-profile hidden" id="address_proof" onchange="address_upload()">
									<!-- accept="image/png, image/jpg, image/jpeg" -->
									<label id="address-uploader" for="address_proof">Upload</label>
									<div class="uploaded-box hidden" id="address-uploaded">
										<span type="button" class="btn step-btn btn-circle status-completed"></span>
										<span>Uploaded</span>
										<img src="asset/close.svg" alt="x" onclick="clearDoc('address')">
									</div>
								</div>
								<button class="become_agent-btn submit-btn" onclick="applyForAgent()">Submit</button>
						</form>
					</div>
					<!-- <div class="nex-arrow-set" data-current="#step-1" data-next="#step-2">
						<img src="asset/choose-service/next-arrow.svg" class="next-arrow" alt="next arrow">
					</div> -->
				</div>

			</div>
		</section>

		<footer></footer> <!-- FOOTER SECTION -->
	</main>

    <!-- SCRIPT -->
    <script src='js/jquery.min.js'></script>
    <script src='js/owl.carousel.min.js'></script>
    <script src="js/bootstrap.min.3.3.5.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src="js/intlTelInput.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src='js/sweetalert.all.min.js'></script>
    <script src="js/main.js<?php echo $cache_str; ?>"></script>
    <script src="js/cart.js<?php echo $cache_str; ?>"></script>
	<script>
		var branch_name = "";
		var pan_card = "";
		var address_proof = "";

		var agentPhoneInputField;
		var agentPhoneInput;
		var masking = "";
        $(document).ready(function() {
			if ($('body').attr('data-usr-token') == 0) {
				window.location.href = "index.php";
			}

			// Aboutus owl-carousel
			var owl = $('#aboutus');
			owl.owlCarousel({
				margin: 10,
				loop: true,
				center: true,
				nav: false,
				dots: true,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 1
					},
					1000: {
						items: 1
					},
				}
			});

			$.ajax({
				async: false,
				type: 'GET',
				url: 'php/users/read-detail.php',
				dataType: 'JSON',
				success: function(response) {
					if (response.status_code == 200) {
						var responseData = response.data;
						console.log(responseData);
						if ( !responseData.is_agent ) {
							var usrTitle = (responseData.title != '')? responseData.title: "NULL";
							var usrName = (responseData.name != '')? responseData.name: "";
							var mobileNumber = (responseData.mobile_number != '')? '+'+responseData.country_code+'-'+responseData.mobile_number: "";
							var usrEmail = (responseData.email != '')? responseData.email: "";
							var usrDob = (responseData.dob != '')? responseData.dob: "";
							
							$('#user-title').val(usrTitle);
							$('#user-name').val(usrName);
							$('#user-mobile_number').val(mobileNumber);
							$('#user-email').val(usrEmail);
							$('#user-dob').val(usrDob);

							if (responseData.image != '') {
								$('.profile-img').attr('src', responseData.image);

								$('.profile-img').css('display', 'block');
								$('.user-svg').css('display', 'none');
							} else {
								$('.profile-img').css('display', 'none');
								$('.user-svg').css('display', 'block');
							}

							$('#user-dob').datetimepicker({
								ignoreReadonly: true,
								format: 'DD-MMM-YYYY',
							});

							// -----Country Code Selection
							agentPhoneInputField = document.querySelector("#user-mobile_number");
							agentPhoneInput = window.intlTelInput(agentPhoneInputField, {
								separateDialCode: false,
								// preferredCountries:["in"],
								hiddenInput: "full",
								geoIpLookup: function (callback) {
									$.get('https://ipinfo.io', function () {
									}, "jsonp").always(function (resp) {
										var countryCode = (resp && resp.country) ? resp.country : "";
										callback(countryCode);
									});
								},
								utilsScript: "js/utils.js"
							});

							$(agentPhoneInputField).on("countrychange", function(event) {
								var selectedCountryData = agentPhoneInput.getSelectedCountryData();
								newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
								newPlaceholder = newPlaceholder.replace(/[()]/g, '');
								newPlaceholder = newPlaceholder.replace(/[-]/g, ' ');
								agentPhoneInput.setNumber("");

								$(this).val('');
								$(this).attr('placeholder',newPlaceholder);
								masking = newPlaceholder.replace(/[1-9]/g, "0");
								// Apply the new mask for the input
								$(this).mask(masking);
							});

							setTimeout(() => {
								masking = $(agentPhoneInputField).attr('placeholder').replace(/[0-9]/g, 0);
								$(agentPhoneInputField).mask(masking);
							}, "1000");
							
							
							//switch between become agent details and other details
							const nxtBtns = document.querySelectorAll('.nex-arrow-set');
							nxtBtns.forEach(btn => btn.addEventListener('click', function() {
								const currentId = document.querySelector(btn.getAttribute('data-current'));
								const nxtId = document.querySelector(btn.getAttribute('data-next'));
								currentId.classList.add('hidden');
								nxtId.classList.remove('hidden');
							}));

							$('#country').html(`<option value="">Select the Country</option>`);
							$('#region').html(`<option value="">Select the State</option>`);
							$('#city').html(`<option value="">Select the City</option>`);
							$.ajax({
								async: false,
								type: 'GET',
								url: 'php/become-agent/read-countries.php',
								dataType: 'JSON',
								success: function(response) {
									if (response.status_code == 200) {
										var responseData = response.data;
										$('#country').append(`<option value="">Select the country</option>`);
										responseData.forEach(function (responseObj) {
											$('#country').append(`<option value="${responseObj.id}">${responseObj.name}</option>`);
										});
									} else {
										swal(response.message);
									}
								}
							});
						} else if (responseData.is_approved == 'Pending') {
							$('#agent-form').html(`<div class="container">
									<div class="heading-set">
										<h2>Become an agent</h2>
										<p>Apply for AirportZo agent and earn a side income</p>
									</div>
									<div style="background-color: #ececec;padding: 20px;text-align: center;border: 1px solid #d6d6d6;border-radius: 10px;">
										<span type="button" class="btn step-btn btn-circle status-completed" style="margin-right:8px;"></span>
										Your details for Airportzo agent has been successfully submitted and it is under verification. Verification may take upto 2 days.
									</div>
								</div>`);
						} else if (responseData.is_approved == 'Approved') {
							$('#agent-form').html(`<div class="container">
									<div class="heading-set">
										<h2>Become an agent</h2>
										<p>Apply for AirportZo agent and earn a side income</p>
									</div>
									<div style="background-color: #ececec;padding: 20px;text-align: center;border: 1px solid #d6d6d6;border-radius: 10px;">
										<span type="button" class="btn step-btn btn-circle status-completed" style="margin-right:8px;"></span>
										Congratulations. You are an Airportzo agent. Please check your profile.
									</div>
								</div>`);
						} else if (responseData.is_approved == 'Rejected') {
							$('#agent-form').html(`<div class="container">
									<div class="heading-set">
										<h2>Become an agent</h2>
										<p>Apply for AirportZo agent and earn a side income</p>
									</div>
									<div style="background-color: #ececec;padding: 20px;text-align: center;border: 1px solid #d6d6d6;border-radius: 10px;">
										<span type="button" class="btn step-btn btn-circle status-completed" style="margin-right:8px;"></span>
										Airportzo has rejected your application. Please contact support to help you.. 
									</div>
								</div>`);
						}
					} else {
						swal("", response.message, "error");
					}
				}
			});
		});

		function countryChange() {
			$('#region').html(`<option value="">Select the State</option>`);
			$('#city').html(`<option value="">Select the City</option>`);

			var country_id = $('#country').val();
			var datas = { country_id: country_id };
			datas = JSON.stringify(datas);
			$.ajax({
				async: false,
				type: 'POST',
				url: 'php/become-agent/read-regions-for-country.php',
				data: datas,
				dataType: 'JSON',
				success: function(response) {
					if (response.status_code == 200) {
						var responseData = response.data;
						responseData.forEach(function (responseObj) {
							$('#region').append(`<option value="${responseObj.id}">${responseObj.name}</option>`);
						});
					} else {
						swal(response.message);
					}
				}
			});
		}

		function regionChange() {
			$('#city').html(`<option value="">Select the City</option>`);

			var country_id = $('#country').val();
			var region_id = $('#region').val();
			var datas = { country_id: country_id, region_id: region_id };
			datas = JSON.stringify(datas);
			$.ajax({
				async: false,
				type: 'POST',
				url: 'php/become-agent/read-cities-for-region.php',
				data: datas,
				dataType: 'JSON',
				success: function(response) {
					if (response.status_code == 200) {
						var responseData = response.data;
						responseData.forEach(function (responseObj) {
							$('#city').append(`<option value="${responseObj.id}">${responseObj.name}</option>`);
						});
					} else {
						swal(response.message);
					}
				}
			});
		}

		function checkIFSC() {
			$('#ifsc-box').css('border', '1px solid #e84b4b');
			$('#branch_name').text('');

			var ifsc_code = $('#ifsc_code').val().trim();
			if (ifsc_code.length == 11) {
				$.ajax({
					async: false,
					type: 'GET',
					url: 'https://ifsc.razorpay.com/' + ifsc_code,
					success: function(response) {
						$('#branch_name').text(response.BRANCH);
						$('#ifsc-box').css('border', '1px solid #EAEAEA');
					}
				});
			}
		}

		function applyForAgent() {
			var usrTitle = $('#user-title').val().trim();
			var usrName = $('#user-name').val().trim();
			var usrImage = $('#user-img').attr('src').trim();
			var full_number = agentPhoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
			var mobileNumber = $('#user-mobile_number').val().trim();
			var country_code = full_number.replace(mobileNumber, "");
			var usrEmail = $('#user-email').val().trim();
			var dob = $('#user-dob').val().trim();
			var address = $('#address').val().trim();
			var country_id = $('#country').val().trim();
			var state_id = $('#region').val().trim();
			var city_id = $('#city').val().trim();
			var pincode = $('#pincode').val().trim();
			var account_number = $('#account_number').val().trim();
			var re_account_number = $('#re_account_number').val().trim();
			var ifsc_code = $('#ifsc_code').val().trim();
			var branch_name = $('#branch_name').text();
			
			if(agentPhoneInput.isValidNumber()){
				if (account_number == re_account_number) {
					if (usrTitle != '' && usrName != '' && usrImage != '' && mobileNumber != '' && usrEmail != '' && dob != '' && address != '' && country_id != '' && state_id != '' && city_id != '' && pincode != '' && account_number != '' && ifsc_code != '' && branch_name != '' && pan_card != '' && address_proof != '') {
						var isEmail = String(usrEmail).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
						if (isEmail) {
							var datas = {
								title: usrTitle,
								name: usrName,
								image: usrImage,
								mobile_number: mobileNumber,
								country_code: country_code,
								email: usrEmail,
								dob: dob,
								address: address,
								country_id: country_id,
								state_id: state_id,
								city_id: city_id,
								pincode: pincode,
								account_number: account_number,
								ifsc_code: ifsc_code,
								branch_name: branch_name,
								pan_card: pan_card,
								address_proof: address_proof
							};
							datas = JSON.stringify(datas);
							$.ajax({
								async: false,
								type: 'POST',
								url: 'php/become-agent/apply.php',
								dataType: 'JSON',
								data: datas,
								success: function(response) {
									if (response.status_code == 200) {
										swal(response.message).then(() => {
											location.reload();
										});
									} else {
										swal("", response.message, "error");
									}
								},
								error: function() {
									swal("", "Something went wrong !", "warning");
								}
							});
						} else {
							swal("", "Please check email-id !", "warning");
						}
					} else {
						swal("", "Please fill all the fields !", "error");
					}
				} else {
					swal("Account numbers entered doesn't match !");
				}
		} else {
			var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
			var errorCode = agentPhoneInput.getValidationError();
			swal(errorMap[errorCode]);
		}
	}
</script>

	<script src="js/aws-sdk.min.js"></script>
	<script src="js/s3upload.js?v=<?php echo date('YmdHis'); ?>"></script>
	<script>
		function clearDoc( docId ) {
			if( $('#' + docId + '-uploader').hasClass('hidden') ) $('#' + docId + '-uploader').removeClass('hidden');
			if( !$('#' + docId + '-uploaded').hasClass('hidden') ) $('#' + docId + '-uploaded').addClass('hidden');
			if (docId == 'pan') {
				pan_card = "";
			} else if (docId == 'address') {
				address_proof = "";
			}
		}

		function pan_upload() {
			pan_card = "";
			var fileUpload = document.getElementById('pan_card');
			var file = fileUpload.files[0];
			s3_file_upload('agent_documents/', 'Document', 'pan', file);
		}

		function address_upload() {
			address_proof = "";
			var fileUpload = document.getElementById('address_proof');
			var file = fileUpload.files[0];
			s3_file_upload('agent_documents/', 'Document', 'address', file);
		}

		function image_upload() {
			var fileUpload = document.getElementById('update-img');
			var file = fileUpload.files[0];
			s3_file_upload('profile/', 'Image', '', file);
		}

		function s3_file_upload(docPath, docType, docId, file) {
			waitingDialog.show(docType + " is Uploading", { dialogSize: "sm", progressType: "warning" });
			let seconds = new Date().getTime();

			var extension = file.name.split('.').pop().toLowerCase();
			var filename = seconds + '.' + extension;
			var filePath = 'user/' + docPath + filename;
			var params = {
				Key: filePath,
				ContentType: file.type,
				Body: file
			};
			var result = false;
			bucket.putObject(params, function (err, data) {
				if (err) {
					alert('ERROR: ' + err);
				} else {
					var uploaded_file_url = aws_cloudfront_url + filePath;
					if (docType == 'Image') {
						$('.profile-img').attr('src', uploaded_file_url);
						$('.profile-img').css('display', 'block');
						$('.user-svg').css('display', 'none');
					} else {
						if (docId == "pan") {
							pan_card = uploaded_file_url;
						} else {
							address_proof = uploaded_file_url;
						}
						if( !$('#' + docId + '-uploader').hasClass('hidden') ) $('#' + docId + '-uploader').addClass('hidden');
						if( $('#' + docId + '-uploaded').hasClass('hidden') ) $('#' + docId + '-uploaded').removeClass('hidden');
					}
				}
				waitingDialog.hide();
			});
		}
	</script>
</body>

</html>