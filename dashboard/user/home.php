<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once '../superadmin/controller/select-settings-coniguration-controller.php';


$user_home = new USER();

if (!$user_home->is_logged_in()) {
	$user_home->redirect('../../');
}

$stmt = $user_home->runQuery("SELECT * FROM student WHERE userId=:uid");
$stmt->execute(array(":uid" => $_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId = $row['userId'];

$pdoQuery = "SELECT * FROM student WHERE userId=$UId";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array());
$user_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$studentId                 = $user_profile["studentId"];
$first_name                 = $user_profile["first_name"];
$middle_name                = $user_profile["middle_name"];
$last_name                  = $user_profile["last_name"];
$email                      = $user_profile["email"];
$qrcode                   	= $user_profile["qrcode"];
$created_at                 = $user_profile["created_at"];
$updated_at                 = $user_profile["updated_at"];

$profile_user = $user_profile['profile'];
$updated_at  = $user_profile["updated_at"];


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
	<link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Dashboard</title>
</head>

<body>

	<!-- Loader -->
	<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="history"><i class='bx bx-history icon'></i> History</a></li>
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
				<span><?php echo $row['last_name']; ?>, <?php echo $row['first_name']; ?></i></span>
			</div>
			<div class="profile">
				<img src="../../src/img/<?php echo $profile_user ?>" alt="">
				<ul class="profile-link">
					<li><a href="authentication/user-signout" class="btn-signout"><i class='bx bxs-log-out-circle'></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Profile</h1>
			<ul class="breadcrumbs">
				<li><a href="home">Home</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">Profile</a></li>
			</ul>
			<!-- PROFILE CONFIGURATION -->

			<section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<img src="../../src/img/profile-red.png" alt="logo">
						<h5><?php echo $last_name ?>, <?php echo $first_name ?> <?php echo $middle_name ?></h5>
						<p><?php echo $studentId ?></p>
						<h7>Student</h7>

						<button class="btn btn-primary change" onclick="information()">Student Information</button>
						<button class="btn btn-primary change" onclick="qr()">QR Code</button>

					</div>

					<div id="information">
						<form action="" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()" novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">

								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Information<p>Last update: <?php echo $updated_at ?></p></label>

								<div class="col-md-6">
									<label for="student_id" class="form-label">Student ID<span> *</span></label>
									<input disabled type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required>
									<div class="invalid-feedback">
										Please provide a Student ID.
									</div>
								</div>

								<div class="col-md-6">
									<label for="first_name" class="form-label">First Name<span> *</span></label>
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
									<label for="last_name" class="form-label">Last Name<span> *</span></label>
									<input disabled type="text" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
									<div class="invalid-feedback">
										Please provide a Last Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="email" class="form-label">Email</label>
									<input disabled type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
									<div class="invalid-feedback">
										Please provide a valid Email.
									</div>
								</div>

							</div>

						</form>
					</div>

					<!-- Qrcode -->
					<div id="qr" style="display: none;">
						<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()" novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">
								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bx-qr'></i> Qr Code<p>Last update: <?php echo $updated_at  ?></p></label>

								<div class="qrcodebody">
									<input type="text" class="form" id="text" value="<?php echo $qrcode ?>" style="display: none;">
									<div id="qr-code" class="qr-code"></div>
								</div>

								<div class="col-md-6" style="opacity:0;">
									<label for="student_id" class="form-label">Student ID<span> *</span></label>
									<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required>
									<div class="invalid-feedback">
										Please provide a Student ID.
									</div>
								</div>

								<div class="col-md-6" style="opacity:0;">
									<label for="student_id" class="form-label">Student ID<span> *</span></label>
									<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required>
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
    <script src="../../src/js/loader.js"></script>

	<script>
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


		// Buttons Students Profile

		window.onpageshow = function() {
		document.getElementById('qr').style.display = 'none';
		};

		function information(){
			document.getElementById('information').style.display = 'block';
			document.getElementById('qr').style.display = 'none';
		}

		function qr(){
			document.getElementById('qr').style.display = 'block';
			document.getElementById('information').style.display = 'none';
		}
		//Delete Profile

		$('.delete').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href')

			swal({
					title: "Delete?",
					text: "Are you sure do you want to delete?",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						document.location.href = href;
					}
				});
		})

		//qr code generator----------------------------------------------------------------------------------------------------->

		var qrcode = new QRCode("qr-code", {


			colorDark: "#000",

		});

		function makeCode() {
			var elText = document.getElementById("text");
			qrcode.makeCode(elText.value);
		}

		makeCode();

		$("#text").
		on("blur", function() {
			makeCode();
		}).
		on("keydown", function(e) {
			if (e.keyCode == 13) {
				makeCode();
			}
		});
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