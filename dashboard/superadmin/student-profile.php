<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/superadmin-class.php';
include_once 'controller/select-settings-coniguration-controller.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../public/superadmin/signin');
}

$stmt = $superadmin_home->runQuery("SELECT * FROM superadmin WHERE superadminId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['superadminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$student_Id = $_GET["id"];

$pdoQuery = "SELECT * FROM student WHERE userId = :id";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":id"=>$student_Id));
$student = $pdoResult->fetch(PDO::FETCH_ASSOC);

$studentId                 = $student["studentId"];
$first_name                 = $student["first_name"];
$middle_name                = $student["middle_name"];
$last_name                  = $student["last_name"];
$email                      = $student["email"];
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

<!-- Loader -->
<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar" class="hide">
		<a href="#" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-user-pin icon' ></i> Students <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="enrolled-students-data">Data</a></li>
					<li><a href="add-students">Add Students</a></li>
				</ul>
			</li>
            <li>
				<a href="#"><i class='bx bxs-user icon' ></i> Admin <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="admin-data">Data</a></li>
					<li><a href="add-admin">Add Admin</a></li>
				</ul>
			</li>
			<li><a href="audit-trail"><i class='bx bxl-blogger icon'></i> Audit Trail</a></li>

			<li class="divider" data-text="room">room</li>
			<li>
				<a href="#"><i class='bx bx-current-location icon' ></i>Room<i class='bx bx-chevron-right icon-right' ></i></a>
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
				<span><?php echo $row['name']; ?></i></span>
			</div>	
			<div class="profile">
				<img src="../../src/img/<?php echo $profile ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/superadmin-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
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
						<a href="controller/delete-student-data-controller.php?id=<?php echo $student_Id ?>" class="delete"><i class='bx bxs-trash'></i></a>
                        <h5><?php echo $last_name?>, <?php echo $first_name?> <?php echo $middle_name?></h5>
                        <p><?php echo $studentId ?></p>
                        <h7>Student</h7>

						<button class="btn btn-primary change" onclick="information()">Student Information</button>
						<button class="btn btn-primary change" onclick="qr()">QR Code</button>

					</div>

					<div id="information"> 
						<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Information<p>Last update: <?php  echo $updated_at ?></p></label>

								<div class="col-md-6">
									<label for="student_id" class="form-label">Student ID<span> *</span></label>
									<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required >
									<div class="invalid-feedback">
									Please provide a Student ID.
									</div>
								</div>

								<div class="col-md-6">
									<label for="first_name" class="form-label">First Name<span> *</span></label>
									<input type="text" class="form-control" value="<?php echo $first_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="FName" id="first_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required>
									<div class="invalid-feedback">
									Please provide a First Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="middle_name" class="form-label">Middle Name</label>
									<input type="text" class="form-control" value="<?php echo $middle_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="MName" id="middle_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
									<div class="invalid-feedback">
									Please provide a Middle Name.
									</div>
								</div>

								<div class="col-md-6">
									<label for="last_name" class="form-label">Last Name<span> *</span></label>
									<input type="text" class="form-control" value="<?php echo $last_name ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="LName" id="last_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required >
									<div class="invalid-feedback">
									Please provide a Last Name.
									</div>
								</div>
								
								<div class="col-md-6">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
									<div class="invalid-feedback">
									Please provide a valid Email.
									</div>
								</div>

							</div>

							<div class="addBtn">
								<button type="button" onclick="location.href='enrolled-students-data'" class="back">Back</button>
								<button type="submit" class="btn-primary" name="btn-register" id="btn-register" onclick="return IsEmpty(); sexEmpty();">Submit</button>
							</div>
						</form>
					</div>

					<!-- Qrcode -->
					<div id="qr" style="display: none;">
					<form action="controller/update-student-data-controller.php?id=<?php echo $student_Id ?>" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
							<div class="row gx-5 needs-validation">
								<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bx-qr'></i> Qr Code<p>Last update: <?php  echo $updated_at  ?></p></label>
																							
								<div class="qrcodebody">
									<input type="text" class="form" id="text" value="<?php echo $qrcode ?>" style="display: none;">
									<div id="qr-code" class="qr-code"></div>
								</div>

								<div class="col-md-6" style="opacity:0;">
										<label for="student_id" class="form-label">Student ID<span> *</span></label>
										<input type="text" class="form-control" value="<?php echo $studentId ?>" autocapitalize="on" maxlength="15" autocomplete="off" name="StudentId" id="student_id" required >
										<div class="invalid-feedback">
										Please provide a Student ID.
										</div>
								</div>

								<div class="col-md-6" style="opacity:0;">
										<label for="student_id" class="form-label">Student ID<span> *</span></label>
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
    <script src="../../src/js/loader.js"></script>
	

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