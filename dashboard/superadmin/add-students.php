<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/superadmin-class.php';
include_once 'controller/select-settings-coniguration-controller.php';


$superadmin_home = new SUPERADMIN();

if (!$superadmin_home->is_logged_in()) {
	$superadmin_home->redirect('../../public/superadmin/signin');
}

$stmt = $superadmin_home->runQuery("SELECT * FROM superadmin WHERE superadminId=:uid");
$stmt->execute(array(":uid" => $_SESSION['superadminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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
	<title>Add Students</title>
</head>

<body>

	<!-- Loader -->
	<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-user-pin icon'></i> Students <i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="enrolled-students-data">Data</a></li>
					<li><a href="">Add Students</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-user icon'></i> Admin <i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="admin-data">Data</a></li>
					<li><a href="add-admin">Add Admin</a></li>
				</ul>
			</li>
			<li><a href="audit-trail"><i class='bx bxl-blogger icon'></i> Audit Trail</a></li>

			<li class="divider" data-text="room">room</li>
			<li>
				<a href="#"><i class='bx bx-current-location icon'></i>Room<i class='bx bx-chevron-right icon-right'></i></a>
				<ul class="side-dropdown">
					<li><a href="room-list">List</a></li>
					<li><a href="add-room">Add Room</a></li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar'></i>

			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon'></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon'></i>
				<span class="badge">8</span>
			</a>
			<span class="divider"></span>
			<div class="dropdown">
				<span><?php echo $row['name']; ?></i></span>
			</div>
			<div class="profile">
				<img src="../../src/img/<?php echo $profile ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog'></i> Settings</a></li>
					<li><a href="authentication/superadmin-signout" class="btn-signout"><i class='bx bxs-log-out-circle'></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Add Students</h1>
			<ul class="breadcrumbs">
				<li><a href="home">Home</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">Add Students</a></li>
			</ul>
			<section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/add-student-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()" novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<div class="col-md-6">
								<label for="student_id" class="form-label">Student ID<span> *</span></label>
								<input type="text" class="form-control numbers" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required>
								<div class="invalid-feedback">
									Please provide a Student ID.
								</div>
							</div>

							<div class="col-md-6">
								<label for="first_name" class="form-label">First Name<span> *</span></label>
								<input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
								<div class="invalid-feedback">
									Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="middle_name" class="form-label">Middle Name</label>
								<input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
								<div class="invalid-feedback">
									Please provide a Middle Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="last_name" class="form-label">Last Name<span> *</span></label>
								<input type="text"  onkeyup="this.value = this.value.toUpperCase();" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
								<div class="invalid-feedback">
									Please provide a Last Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
								<div class="invalid-feedback">
									Please provide a valid Email.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-primary" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Submit</button>
						</div>
					</form>
				</div>
			</section>
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
	<script src="../../src/js/countrySelect.min.js"></script>
	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>
	<script src="../../src/js/loader.js"></script>

	<script type="text/javascript">
		// Form
		(function() {
			'use strict'
			var forms = document.querySelectorAll('.needs-validation')
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})();

		// Country Selector
		$("#nationality").countrySelect({
			defaultCountry: "ph",
			defaultStyling: "inside",
			responsiveDropdown: true
		});


		// Signout
		$('.btn-signout').on('click', function(e) {
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

		//birthdate
		function formatDate(date) {
			var d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();

			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;

			return [year, month, day].join('-');

		}

		function getAge(dateString) {
			var birthdate = new Date().getTime();
			if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')) {
				birthdate = new Date().getTime();
			}
			birthdate = new Date(dateString).getTime();
			var now = new Date().getTime();
			var n = (now - birthdate) / 1000;
			if (n < 604800) {
				var day_n = Math.floor(n / 86400);
				if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')) {
					return '';
				} else {
					return day_n + '' + (day_n > 1 ? '' : '') + '';
				}
			} else if (n < 2629743) {
				var week_n = Math.floor(n / 604800);
				if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')) {
					return '';
				} else {
					return week_n + '' + (week_n > 1 ? '' : '') + '';
				}
			} else if (n < 31562417) {
				var month_n = Math.floor(n / 2629743);
				if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')) {
					return '';
				} else {
					return month_n + ' ' + (month_n > 1 ? '' : '') + '';
				}
			} else {
				var year_n = Math.floor(n / 31556926);
				if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')) {
					return year_n = '';
				} else {
					return year_n + '' + (year_n > 1 ? '' : '') + '';
				}
			}
		}

		function getAgeVal(pid) {
			var birthdate = formatDate(document.getElementById("birthdate").value);
			var count = document.getElementById("birthdate").value.length;
			if (count == '10') {
				var age = getAge(birthdate);
				var str = age;
				var res = str.substring(0, 1);
				if (res == '-' || res == '0') {
					document.getElementById("birthdate").value = "";
					document.getElementById("age").value = "";
					$('#birthdate').focus();
					return false;
				} else {
					document.getElementById("age").value = age;
				}
			} else {
				document.getElementById("age").value = "";
				return false;
			}
		};
	</script>

	<!-- SWEET ALERT -->
	<?php

	if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
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