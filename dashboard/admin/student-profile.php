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
					<li><a href="authentication/admin-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
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
									<label for="email" class="form-label">Email</label>
									<input disabled type="email" class="form-control" value="<?php echo $email ?>" autocapitalize="off" autocomplete="off" name="Email" id="email" placeholder="Ex. juan@email.com">
									<div class="invalid-feedback">
									Please provide a valid Email.
									</div>
								</div>

							</div>

							<div class="addBtn">
								<button type="button" onclick="location.href='students-data'" class="back">Back</button>
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