<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/admin-class.php';
include_once '../superadmin/controller/select-settings-coniguration-controller.php';



$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('../../public/admin/signin');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId = $row['userId'];

$pdoQuery = "SELECT * FROM admin WHERE userId=$UId";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array());
$admin_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$profile_admin = $admin_profile['adminProfile'];
$updated_at  = $admin_profile["updated_at"];

// STUDENT

$student_Id = $_GET["id"];
$uniqueID = $row['uniqueId'];

$pdoQuery = "SELECT * FROM student_activity_$uniqueID WHERE userId = :id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":id"=>$student_Id));
$student = $pdoResult->fetch(PDO::FETCH_ASSOC);

$studentId                 	= $student["studentId"];
$first_name                 = $student["first_name"];
$middle_name                = $student["middle_name"];
$last_name                  = $student["last_name"];
$sex                        = $student["sex"];
$birth_date                 = $student["birth_date"];
$age                        = $student["age"];
$place_of_birth             = $student["place_of_birth"];
$civil_status               = $student["civil_status"];
$nationality                = $student["nationality"];
$religion                   = $student["religion"];
$phone_number               = $student["phone_number"];
$email                      = $student["email"];
$province                   = $student["province"];
$city                       = $student["city"];
$barangay                   = $student["barangay"];
$emergency_contact_person   = $student["emergency_contact_person"];
$emergency_address          = $student["emergency_address"];
$emergency_mobile_number    = $student["emergency_mobile_number"];
$qrcode                   	= $student["qrcode"];
$created_at                 = $student["created_at"];
$updated_at                 = $student["updated_at"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css" />
    <link rel="stylesheet" href="../../src/css/countrySelect.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Students Profile</title>
</head>
<body>


	<!-- SIDEBAR -->
    <section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="home" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="scan-qrcode" ><i class='bx bx-qr-scan icon' ></i> Scan QR-Code</a></li>
			<li>
				<a href="#" class="active"><i class='bx bxs-user-pin icon' ></i> Students <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="students-data">Data</a></li>
				</ul>
			</li>
		</ul>

	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>

			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="dropdown">
				<span><?php echo $row['adminLast_Name']; ?>, <?php echo $row['adminFirst_Name']; ?></i></span>
			</div>	
			<div class="profile">
				<img src="../../src/img/<?php echo $profile_admin ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/user-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Student Profile</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="enrolled-students-data" >Student Data</a></li>
                <li class="divider">|</li>
                <li><a href="" class="active">Profile</a></li>

			</ul>

			<!-- PROFILE CONFIGURATION -->

            <section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<img src="../../src/img/profile-red.png" alt="logo">
                        <h5><?php echo $last_name?>, <?php echo $first_name?> <?php echo $middle_name?></h5>
                        <p><?php echo $studentId ?></p>
                        <h7>Student</h7>

						<button class="btn btn-danger change" onclick="information()">Student Information</button>
						<button disabled class="btn btn-danger change" onclick="overview()">Overview</button>

					</div>

					<div id="information"> 
						<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Information<p>Last update: <?php  echo $updated_at ?></p></label>

								<div class="col-md-6">
									<label for="student_id" class="form-label">Student ID</label>
									<input disabled type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required >
									<div class="invalid-feedback">
									Please provide a Student ID.
									</div>
								</div>

								<div class="col-md-6">
									<label for="first_name" class="form-label">First Name</label>
									<input disabled type="text" class="form-control" value="<?php echo $first_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
									<div class="invalid-feedback">
									Please provide a First Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="middle_name" class="form-label">Middle Name</label>
									<input disabled type="text" class="form-control" value="<?php echo $middle_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
									<div class="invalid-feedback">
									Please provide a Middle Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="last_name" class="form-label">Last Name</label>
									<input disabled type="text" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required >
									<div class="invalid-feedback">
									Please provide a Last Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="sex" class="form-label">Sex</label>
									<select disabled class="form-select form-control"  name="Sex"  autocapitalize="on" maxlength="6" autocomplete="off" id="sex" required>
									<option selected value="<?php echo $sex ?>"><?php echo $sex ?></option>
									<option value="Male">Male</option>
									<option value="Female ">Female</option>
									</select>
									<div class="invalid-feedback">
										Please select a valid Sex.
									</div>
								</div>

								<div class="col-md-6">
									<label for="birthdate" class="form-label">Birth Date</label>
									<input disabled type="date" class="form-control" value="<?php echo $birth_date ?>" autocapitalize="off" autocomplete="off" name="BirthDate" id="birthdate" maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$"  required placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
									<div class="invalid-feedback">
									Please provide a Birth Date.
									</div>
								</div>

								<div class="col-md-6" style="display: none;">
									<label for="age" class="form-label">Age<span style="font-size:9px; color:red;">( auto-generated )</span></label>
									<input disabled type="number" class="form-control" value="<?php echo $age ?>" autocapitalize="off" autocomplete="off"  name="Age" id="age" required >
									<div class="invalid-feedback">
									Please provide your Age.
									</div>
								</div>

								<div class="col-md-6">
									<label for="Pbirth" class="form-label">Place Of Birth</label>
									<input disabled type="text" class="form-control" value="<?php echo $place_of_birth ?>" autocapitalize="on" maxlength="20" autocomplete="off" name="PBirth" id="Pbirth" >
									<div class="invalid-feedback">
									Please provide a Place of Birth.
									</div>
								</div>

								<div class="col-md-6">
									<label for="CivilStatus" class="form-label">Civil Status</label>
									<select disabled class="form-select form-control"  name="CStatus"  autocapitalize="on" maxlength="6" autocomplete="off" id="CivilStatus" required>
									<option selected value="<?php echo $civil_status ?>" ><?php echo $civil_status ?></option>
									<option value="Single">Single</option>
									<option value="Married">Married</option>
									<option value="Seperated">Seperated</option>
									<option value="Widow/Widower">Widow/Widower</option>
									<option value="Anulled">Anulled</option>
									<option value="Solo Parent">Solo Parent</option>
									</select>
									<div class="invalid-feedback">
										Please select a valid Civil Status.
									</div>
								</div>

								<div class="col-md-6">
									<label for="nationality" class="form-label">Nationality</label>
									<input disabled type="text" class="form-control country-select" value="<?php echo $nationality ?>" autocapitalize="on" maxlength="20" autocomplete="off" name="Nationality" id="nationality"  required>
									<div class="invalid-feedback">
									Please provide a Nationality.
									</div>
								</div>

								<div class="col-md-6">
									<label for="religion" class="form-label">Religion</label>
									<select disabled class="form-select form-control"  name="Religion"  autocapitalize="on" maxlength="6" autocomplete="off" id="religion" required>
									<option selected value="<?php echo $religion ?>"><?php echo $religion ?></option>
									<option value="Roman Catholic">Roman Catholic</option>
									<option value="INC">INC</option>
									<option value="Christian">Christian</option>
									<option value="Islam">Islam</option>
									<option value="Buddhism">Buddhism</option>
									<option value="Protestant">Protestant</option>
									<option value="Methodist">Methodist</option>
									<option value="Adventist">Adventist</option>
									<option value="independent">independent</option>
									<option value="Evangelical">Evangelical</option>
									<option value="Jehovah's-Witnesses">Jehovah's-Witnesses</option>
									<option value="JIL">JIL</option>
									<option value="Lutheran">Lutheran</option>
									<option value="Orthodox">Orthodox</option>
									<option value="Pentecostal">Pentecostal</option>
									<option value="Presbyterianism">Presbyterianism</option>
									<option value="Latter-Day">Latter-Day</option>
									<option value="UCCP">UCCP</option>
									<option value="KJC">KJC</option>
									<option value="Baptist">Baptist</option>
									<option value="Angelican-Episcopalian">Angelican-Episcopalian</option>
									<option value="Others">Others</option>
									</select>
									<div class="invalid-feedback">
										Please select a valid Religion.
									</div>
								</div>

								<div class="col-md-6" >
									<label for="phone_number" class="form-label">Phone Number</label>
									<div class="input-group flex-nowrap">
									<span class="input-group-text" id="addon-wrapping">+63</span>
									<input disabled type="text" class="form-control numbers" value="<?php echo $phone_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
									</div>
								</div>
								
								<div class="col-md-6">
									<label for="email" class="form-label">Email</label>
									<input disabled type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
									<div class="invalid-feedback">
									Please provide a valid Email.
									</div>
								</div>
								<!-- Residential Address -->
								<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Residential Address</label>
								
								<div class="col-md-6">
									<label for="province" class="form-label">Province</label>
									<input disabled type="text" class="form-control" value="<?php echo $province ?>" autocapitalize="on"  autocomplete="off" name="Province" id="province" required>
									<div class="invalid-feedback">
										Please select a valid Province.
									</div>
								</div>

								<div class="col-md-6">
									<label for="city" class="form-label">City/Municipality</label>
									<input disabled type="text" class="form-control" value="<?php echo $city ?>" autocapitalize="on"  autocomplete="off" name="City" id="city" required>
									<div class="invalid-feedback">
										Please select a valid City.
									</div>
								</div>

								<div class="col-md-6">
									<label for="barangay" class="form-label">Barangay</label>
									<input disabled type="text" class="form-control" value="<?php echo $barangay ?>" autocapitalize="on"  autocomplete="off" name="Barangay" id="barangay" required>
									<div class="invalid-feedback">
										Please select a valid Barangay.
									</div>
								</div>

								<!-- Emergency Information -->
								<label class="form-label" style="text-align: left; padding-top: 2rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;">Emergency Information</label>

								<div class="col-md-6">
									<label for="ECP" class="form-label">Emergency Contact Person</label>
									<input disabled type="text" class="form-control" value="<?php echo $emergency_contact_person ?>" autocapitalize="on"  autocomplete="off" name="Emergency_Contact_Person" id="ECP" >
									<div class="invalid-feedback">
									Please provide a Emergency Contact Person.
									</div>
								</div>

								<div class="col-md-6">
									<label for="EAddress" class="form-label">Emergency Address</label>
									<input disabled type="text" class="form-control" value="<?php echo $emergency_address ?>" autocapitalize="on"  autocomplete="off" name="Emergency_Address" id="EAddress" >
									<div class="invalid-feedback">
									Please provide a Emergency Address.
									</div>
								</div>

								<div class="col-md-6">
									<label for="EMN" class="form-label">Emergency Mobile No.</label>
									<div class="input-group flex-nowrap">
									<span class="input-group-text" id="addon-wrapping">+63</span>
									<input disabled type="text" class="form-control numbers" value="<?php echo $emergency_mobile_number ?>"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="Emergency_Mobile_No" id="EMN" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="10-digit number">
									</div>
								</div>
								


							</div>

							<div class="addBtn">
								<button type="button" onclick="location.href='students-data'" class="back">Back</button>
							</div>
						</form>
					</div>

					<!-- Overview -->
					<div id="overview" style="display: none;">
						<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">
								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Overview<p>Last update: <?php  echo $superadmin_profile_last_update  ?></p></label>
								
								<section class="data-table">
									<div class="searchBx">
										<input type="input" placeholder="search activity" class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
									</div>

									<div class="table">
									<div id="dynamic_content">
									</div>

								</section>
													
								<div class="col-md-6" style="opacity: 0;">
										<label for="student_id" class="form-label">Student ID</label>
										<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required >
										<div class="invalid-feedback">
										Please provide a Student ID.
										</div>
								</div>

								<div class="col-md-6" style="opacity: 0;">
										<label for="student_id" class="form-label">Student ID</label>
										<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required >
										<div class="invalid-feedback">
										Please provide a Student ID.
										</div>
								</div>


							</div>
						</form>
					</div>

                </div>
            </section>		
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../src/js/countrySelect.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>
	<script src="../../src/js/qrcode.js"></script>


<script>

		// Form
		(function () {
			'use strict'
			var forms = document.querySelectorAll('.needs-validation')
			Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}

				form.classList.add('was-validated')
				}, false)
			})
		})();

			//live search---------------------------------------------------------------------------------------//
		$(document).ready(function(){

		load_data(1);

		function load_data(page, query = '')
		{
		$.ajax({
			url:"data-table/student-activity-data-table.php?id=<?php echo $studentId ?>",
			method:"POST",
			data:{page:page, query:query},
			success:function(data)
			{
			$('#dynamic_content').html(data);
			}
		});
		}

		$(document).on('click', '.page-link', function(){
		var page = $(this).data('page_number');
		var query = $('#search_box').val();
		load_data(page, query);
		});

		$('#search_box').keyup(function(){
		var query = $('#search_box').val();
		load_data(1, query);
		});

		});


		// Buttons Students Profile

		window.onpageshow = function() {
		document.getElementById('overview').style.display = 'none';
		};

		function information(){
			document.getElementById('information').style.display = 'block';
			document.getElementById('overview').style.display = 'none';
		}

		function overview(){
			document.getElementById('overview').style.display = 'block';
			document.getElementById('information').style.display = 'none';
		}

        // Country Selector
        $("#nationality").countrySelect({
            defaultCountry:"ph",
            defaultStyling:"inside",
            responsiveDropdown:true
        });

        //Delete Profile

		$('.delete').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Delete?",
				text: "Are you sure do you want to delete?",
				icon: "info",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
				document.location.href = href;
				}
			});
		})

		// Signout
		$('.btn-signout').on('click', function(e){
		e.preventDefault();
		const href = $(this).attr('href')

				swal({
				title: "Signout?",
				text: "Are you sure do you want to signout?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willSignout) => {
				if (willSignout) {
				document.location.href = href;
				}
			});
		})

		//numbers only
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
		});

		//qr code generator----------------------------------------------------------------------------------------------------->

		var qrcode = new QRCode("qr-code", {


		colorDark : "#000",

		});

		function makeCode () {    
		var elText = document.getElementById("text");
		qrcode.makeCode(elText.value);
		}

		makeCode();

		$("#text").
		on("blur", function () {
		makeCode();
		}).
		on("keydown", function (e) {
		if (e.keyCode == 13) {
		makeCode();
		}
		});

        //birthdate
        function formatDate(date){
            var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');

        }

        function getAge(dateString){
            var birthdate = new Date().getTime();
            if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
            birthdate = new Date().getTime();
            }
            birthdate = new Date(dateString).getTime();
            var now = new Date().getTime();
            var n = (now - birthdate)/1000;
            if (n < 604800){
            var day_n = Math.floor(n/86400);
            if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
                return '';
            }else{
                return day_n + '' + (day_n > 1 ? '' : '') + '';
            }
            } else if (n < 2629743){
            var week_n = Math.floor(n/604800);
            if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
                return '';
            }else{
                return week_n + '' + (week_n > 1 ? '' : '') + '';
            }
            } else if (n < 31562417){
            var month_n = Math.floor(n/2629743);
            if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
                return '';
            }else{
                return month_n + ' ' + (month_n > 1 ? '' : '') + '';
            }
            }else{
            var year_n = Math.floor(n/31556926);
            if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                return year_n = '';
            }else{
                return year_n + '' + (year_n > 1 ? '' : '') + '';
            }
            }
        }
        function getAgeVal(pid){
            var birthdate = formatDate(document.getElementById("birthdate").value);
            var count = document.getElementById("birthdate").value.length;
            if (count=='10'){
            var age = getAge(birthdate);
            var str = age;
            var res = str.substring(0, 1);
            if (res =='-' || res =='0'){
                document.getElementById("birthdate").value = "";
                document.getElementById("age").value = "";
                $('#birthdate').focus();
                return false;
            }else{
                document.getElementById("age").value = age;
            }
            }else{
            document.getElementById("age").value = "";
            return false;
            }
        };

	</script>

	<!-- SWEET ALERT -->
	<?php

	if(isset($_SESSION['status']) && $_SESSION['status'] !='')
	{
		?>
		<script>
			swal({
			title: "<?php echo $_SESSION['status_title']; ?>",
			text: "<?php echo $_SESSION['status']; ?>",
			icon: "<?php echo $_SESSION['status_code']; ?>",
			button: false,
			timer: <?php echo $_SESSION['status_timer']; ?>,
			});
		</script>
		<?php
		unset($_SESSION['status']);
	}
	?>
</body>
</html>