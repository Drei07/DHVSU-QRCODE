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
	<link rel="stylesheet" href="../../src/css/admin.css?v=<?php echo time(); ?>">
	<title>List of Rooms</title>
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
					<li><a href="add-students">Add Students</a></li>
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
					<li><a href="">List</a></li>
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
			<h1 class="title">Room</h1>
			<ul class="breadcrumbs">
				<li><a href="home">Home</a></li>
				<li class="divider">|</li>
				<li><a href="" class="active">List of Rooms</a></li>
			</ul>
			<div class="level">
				<button type="button" data-bs-toggle="modal" data-bs-target="#classModal"><i class='bx bx-export'></i> Export</button>
			</div>
			<div class="manage">
				<button class="btn-primary" onclick="location.href='manage-room'"><i class='bx bx-edit'></i> Manage</button>
			</div>
			<section class="data-form">
				<div class="header"></div>
				<div class="academic">

					<?php

					$pdoQuery = "SELECT * FROM location";
					$pdoResult = $pdoConnect->prepare($pdoQuery);
					$pdoExec = $pdoResult->execute();
					while ($location = $pdoResult->fetch(PDO::FETCH_ASSOC)) {
						extract($location);

						echo
						'

                                <div class="row gx-5 needs-validation">
                                    <div class="col">
                                        <button type="button"><a href="room-records?Id=' . $location["Id"] . '">' . $location["location_name"] . '</a></button>
                                    </div>
                                </div>
                            
                            ';
					}
					?>
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
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=01" class="export">January</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=02" class="export">February</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=03" class="export">March</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=04" class="export">April</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=05" class="export">May</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=06" class="export">June</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=07" class="export">July</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=08" class="export">August</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=09" class="export">September</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=10" class="export">October</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=11" class="export">November</a></button>
							<button type="button" class="btn-month"><a href="../excel/export-room-all-records.php?date=12" class="export">December</a></button>
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