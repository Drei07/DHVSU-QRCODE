<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/superadmin-class.php';
include_once 'controller/select-settings-coniguration-controller.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../public/superadmin/signin');
}

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
	<title>Settings</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
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
<!-- 
			<li class="divider" data-text="Academic Programs">Academic Programs</li>
			<li>
				<a href="#"><i class='bx bxs-notepad icon' ></i>Programs<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="programs-list">List</a></li>
                    <li><a href="add-programs">Add Programs</a></li>
				</ul>
			</li> -->
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<div class="form">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</div>
			<!-- <a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a> -->
			<span class="divider"></span>
			<div class="profile">
				<img src="../../src/img/<?php echo $profile ?>" alt="user">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="notifications"><i class='bx bxs-bell icon' ></i> Notifications</a></li><span class="badge">5</span>
					<li><a href=""><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/superadmin-signout" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Settings</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="" class="active">Settings</a></li>
			</ul>

			<!-- SYSTEM CONFIGURATION -->

            <section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/update-system-config.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

						<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> System Configuration <p>Last update: <?php  echo $system_config_last_update  ?></p></label>

							<div class="col-md-6">
								<label for="sname" class="form-label">System Name<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SName" id="sname" required value="<?php  echo $system_name  ?>">
								<div class="invalid-feedback">
								Please provide a System Name.
								</div>
							</div>

							<div class="col-md-6">
								<label for="cright" class="form-label">System Copyright<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="CRight" id="cright" required value="<?php  echo $system_copyright ?>">
								<div class="invalid-feedback">
								Please provide a System Copyright.
								</div>
							</div>

							<div class="col-md-6" >
								<label for="phone_number" class="form-label">Default Phone Number<span> *</span></label>
								<div class="input-group flex-nowrap">
								<span class="input-group-text" id="addon-wrapping">+63</span>
								<input type="text" class="form-control numbers"  autocapitalize="off" inputmode="numeric" autocomplete="off" name="PNumber" id="phone_number" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required value="<?php  echo $system_number  ?>">
								</div>
							</div>

							<div class="col-md-6">
								<label for="email" class="form-label">Default Email<span> *</span></label>
								<input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required value="<?php  echo $system_email  ?>">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-danger" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
                </div>
            </section>
			
			<!-- System Logo  -->

			<section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/update-logo-controller.php" method="POST" enctype="multipart/form-data" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Logo Configuration <p>Last update: <?php  echo $system_logo_last_update  ?></p></label>

							<div class="col-md-12">
								<label for="logo" class="form-label">Upload Logo<span> *</span></label>
								<input type="file" class="form-control" name="Logo" id="logo" style="height: 33px ;" required>
								<div class="invalid-feedback">
								Please provide a Logo.
								</div>
							</div>

						</div>

						<div class="addBtn" style="padding-top: 2rem;">
							<button type="submit" class="btn-danger" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
                </div>
            </section>

			<!-- SMTP MAILER -->

			<section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/update-smtp-email-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

						<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> SMTP Email Configuration <p>Last update: <?php  echo $email_config_last_update  ?></p></label>

							<div class="col-md-6">
								<label for="email" class="form-label">Email<span> *</span></label>
								<input type="email" class="form-control" autocapitalize="off" autocomplete="off" name="Email" id="email" required placeholder = "<?php  echo $smtp_email  ?>">
								<div class="invalid-feedback">
								Please provide a valid Email.
								</div>
							</div>

							<div class="col-md-6">
								<label for="Gpassword" class="form-label">Generated Password<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="GPassword" id="Gpassword" required placeholder ="<?php  echo $smtp_password  ?>">
								<div class="invalid-feedback">
								Please provide a Generated Password.
								</div>
							</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-danger" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
                </div>
            </section>

			<!-- Google reCAPTCHA V3  -->

			<section class="data-form">
				<div class="header"></div>
				<div class="registration">
					<form action="controller/update-google-recaptcha-controller.php" method="POST" class="row gx-5 needs-validation" name="form" onsubmit="return validate()"  novalidate style="overflow: hidden;">
						<div class="row gx-5 needs-validation">

						<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 2rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Google reCAPTCHA API Configuration <p>Last update: <?php  echo $google_recaptcha_api_last_update  ?></p></label>

						<div class="col-md-6">
								<label for="Skey" class="form-label">Site Key<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SKey" id="Skey" required placeholder ="<?php  echo $SKey  ?>">
								<div class="invalid-feedback">
								Please provide a Site Key.
								</div>
						</div>

						<div class="col-md-6">
							<label for="Sskey" class="form-label">Site Secret Key<span> *</span></label>
							<input type="text" class="form-control" autocapitalize="on" autocomplete="off" name="SSKey" id="Sskey" required placeholder ="<?php  echo $SSKey  ?>">
							<div class="invalid-feedback">
							Please provide a Site Secret Key.
							</div>
						</div>

						</div>

						<div class="addBtn">
							<button type="submit" class="btn-danger" name="btn-update" id="btn-update" onclick="return IsEmpty(); sexEmpty();">Update</button>
						</div>
					</form>
                </div>
            </section>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->


	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>

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

		//numbers only----------------------------------------------------------------------------------------------------->
		$('.numbers').keypress(function(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57) || x == 8 ||
			(x >= 35 && x <= 40) || x == 46)
			return true;
		else
			return false;
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