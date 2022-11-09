<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/admin-class.php';
include_once '../superadmin/controller/select-settings-coniguration-controller.php';

$admin_home = new ADMIN();

if (!$admin_home->is_logged_in()) {
	$admin_home->redirect('../../public/admin/signin');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid" => $_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId = $row['userId'];
$uniqueID = $row['uniqueId'];

$pdoQuery = "SELECT * FROM admin WHERE userId=$UId";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array());
$admin_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$profile_admin = $admin_profile['adminProfile'];
$updated_at  = $admin_profile["updated_at"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../src/img/<?php echo $logo ?>">
	<link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
	<link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css">
	<link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>Students Data</title>
</head>

<body>

	<!-- Loader -->
	<div class="loader"></div>

	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="scan-qrcode"><i class='bx bx-qr-scan icon'></i> Scan QR-Code</a></li>
			<li>
				<a href="#" class="active"><i class='bx bxs-user-pin icon'></i> Students <i class='bx bx-chevron-right icon-right'></i></a>
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
				<span><?php echo $row['adminLast_Name']; ?>, <?php echo $row['adminFirst_Name']; ?></i></span>
			</div>
			<div class="profile">
				<img src="../../src/img/<?php echo $profile_admin ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
					<li><a href="authentication/admin-signout" class="btn-signout"><i class='bx bxs-log-out-circle'></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Students Data</h1>
			<ul class="breadcrumbs">
				<li><a href="home">Home</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">Students Data</a></li>
			</ul>
			<div class="level">
				<button type="button" data-bs-toggle="modal" data-bs-target="#classModal"><i class='bx bx-export'></i> Export</button>
			</div>

			<section class="data-table">
				<div class="searchBx">
					<input type="input" placeholder="search student ID .." class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
				</div>

				<div class="table">
					<div id="dynamic_content">
					</div>

			</section>
		</main>
		<!-- MAIN -->
	</section>
	<!-- MODALS -->
	<div class="class-modal">
		<div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true" data-bs-backdrop="static">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content" style="height: 700px;">
					<div class="header"></div>
					<div class="modal-header">
						<h5 class="modal-title" id="classModalLabel">Please Select Month</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<section class="data-table">
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=01" class="export">January</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=02" class="export">February</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=03" class="export">March</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=04" class="export">April</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=05" class="export">May</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=06" class="export">June</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=07" class="export">July</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=08" class="export">August</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=09" class="export">September</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=10" class="export">October</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=11" class="export">November</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-student-data.php?id=<?php echo $uniqueID ?>&date=12" class="export">December</a></button>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END NAVBAR -->

	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>
	<script src="../../src/js/loader.js"></script>



	<script>
		// export
		$('.export').on('click', function(e) {
			e.preventDefault();
			const href = $(this).attr('href')

			swal({
					title: "Export?",
					text: "Export an excel file?",
					icon: "info",
					buttons: true,
					dangerMode: true,
				})
				.then((willSignout) => {
					if (willSignout) {
						document.location.href = href;
					}
				});
		})


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

		//live search---------------------------------------------------------------------------------------//
		$(document).ready(function() {

			load_data(1);

			function load_data(page, query = '') {
				$.ajax({
					url: "data-table/students-data-table.php?uniqueId=<?php echo $uniqueID ?>",
					method: "POST",
					data: {
						page: page,
						query: query
					},
					success: function(data) {
						$('#dynamic_content').html(data);
					}
				});
			}

			$(document).on('click', '.page-link', function() {
				var page = $(this).data('page_number');
				var query = $('#search_box').val();
				load_data(page, query);
			});

			$('#search_box').keyup(function() {
				var query = $('#search_box').val();
				load_data(1, query);
			});

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