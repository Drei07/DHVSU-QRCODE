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
$pdoExec = $pdoResult->execute();
$admin_profile = $pdoResult->fetch(PDO::FETCH_ASSOC);

$profile_admin = $admin_profile['adminProfile'];
$admin_firstname = $admin_profile['adminFirst_Name'];
$admin_lastname = $admin_profile['adminLast_Name'];
$admin_employeeId = $admin_profile['employeeId'];
$admin_location = ("Entered in ").($admin_profile['adminLocation']);
$admin_ID = $admin_profile['uniqueId'];
$updated_at  = $admin_profile["updated_at"];

// ADMIN NAME
$admin_name = ($admin_lastname).(", ").($admin_firstname);

// SCAN QRCODE

if(isset($_POST['scan'])){
	
	$qrcode = $_POST['scan'];

	$pdoQuery = "SELECT * FROM student WHERE qrcode = :qrcode LIMIT 1";
	$pdoResult = $pdoConnect->prepare($pdoQuery);
	$pdoExec = $pdoResult->execute(array(":qrcode"=>$qrcode));

	if($result = $pdoResult->fetch()){

		$studentId                 	= $result["studentId"];
		$first_name                 = $result["first_name"];
		$middle_name                = $result["middle_name"];
		$last_name                  = $result["last_name"];
		$sex                        = $result["sex"];
		$birth_date                 = $result["birth_date"];
		$age                        = $result["age"];
		$place_of_birth             = $result["place_of_birth"];
		$civil_status               = $result["civil_status"];
		$nationality                = $result["nationality"];
		$religion                   = $result["religion"];
		$phone_number               = $result["phone_number"];
		$email                      = $result["email"];
		$province                   = $result["province"];
		$city                       = $result["city"];
		$barangay                   = $result["barangay"];
		$emergency_contact_person   = $result["emergency_contact_person"];
		$emergency_address          = $result["emergency_address"];
		$emergency_mobile_number    = $result["emergency_mobile_number"];
		$qrcode                   	= $result["qrcode"];

		if($pdoExec){

			$pdoQuery = "INSERT INTO student_activity (employee_name, employee_ID, studentId, first_name, middle_name, last_name, sex, birth_date, age, place_of_birth, civil_status, nationality, religion, phone_number, email, province, city, barangay, emergency_contact_person, emergency_address, emergency_mobile_number, qrcode, activity) 
						VALUES (:employee_name, :employee_ID, :studentId, :first_name, :middle_name, :last_name, :sex, :birth_date, :age, :place_of_birth, :civil_status, :nationality, :religion, :phone_number, :email, :province, :city, :barangay, :emergency_contact_person, :emergency_address, :emergency_mobile_number, :qrcode, :activity)";
			$pdoResult2 = $pdoConnect->prepare($pdoQuery);
			$pdoExec2 = $pdoResult2->execute
			(
			array
			( 
				":employee_name"            =>$admin_name,
				":employee_ID"              =>$admin_employeeId,
				":studentId"                =>$studentId,
				":first_name"               =>$first_name,
				":middle_name"              =>$middle_name,
				":last_name"                =>$last_name,
				":sex"                      =>$sex,
				":birth_date"               =>$birth_date,
				":age"                      =>$age,
				":place_of_birth"           =>$place_of_birth,
				":civil_status"             =>$civil_status,
				":nationality"              =>$nationality, 
				":religion"                 =>$religion,
				":phone_number"             =>$phone_number,
				":email"                    =>$email,
				":province"                 =>$province,
				":city"                     =>$city,
				":barangay"                 =>$barangay,
				":emergency_contact_person" =>$emergency_contact_person,
				":emergency_address"        =>$emergency_address,
				":emergency_mobile_number"  =>$emergency_mobile_number,
				":qrcode"                   =>$qrcode,
				":activity"                 =>$admin_location,
			)
			);
		}

		if($pdoExec2){

			$pdoQuery = "INSERT INTO student_activity_$admin_ID (employee_name, employee_ID, studentId, first_name, middle_name, last_name, sex, birth_date, age, place_of_birth, civil_status, nationality, religion, phone_number, email, province, city, barangay, emergency_contact_person, emergency_address, emergency_mobile_number, qrcode, activity) 
						VALUES (:employee_name, :employee_ID, :studentId, :first_name, :middle_name, :last_name, :sex, :birth_date, :age, :place_of_birth, :civil_status, :nationality, :religion, :phone_number, :email, :province, :city, :barangay, :emergency_contact_person, :emergency_address, :emergency_mobile_number, :qrcode, :activity)";
			$pdoResult3 = $pdoConnect->prepare($pdoQuery);
			$pdoExec3 = $pdoResult3->execute
			(
			array
			( 
				":employee_name"            =>$admin_name,
				":employee_ID"              =>$admin_employeeId,
				":studentId"                =>$studentId,
				":first_name"               =>$first_name,
				":middle_name"              =>$middle_name,
				":last_name"                =>$last_name,
				":sex"                      =>$sex,
				":birth_date"               =>$birth_date,
				":age"                      =>$age,
				":place_of_birth"           =>$place_of_birth,
				":civil_status"             =>$civil_status,
				":nationality"              =>$nationality, 
				":religion"                 =>$religion,
				":phone_number"             =>$phone_number,
				":email"                    =>$email,
				":province"                 =>$province,
				":city"                     =>$city,
				":barangay"                 =>$barangay,
				":emergency_contact_person" =>$emergency_contact_person,
				":emergency_address"        =>$emergency_address,
				":emergency_mobile_number"  =>$emergency_mobile_number,
				":qrcode"                   =>$qrcode,
				":activity"                 =>$admin_location,
			)
			);

			$_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Student can now enter the room";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: scan-qrcode');
            exit;
		}

	}
	else
	{
		$_SESSION['status_title'] = "Oops!";
		$_SESSION['status'] = "Invalid QR code";
		$_SESSION['status_code'] = "error";
		$_SESSION['status_timer'] = 100000;
		header('Location: scan-qrcode');
		exit;
	  }
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
	<title>Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="home" class="brand"><img src="../../src/img/<?php echo $logo ?>" alt="logo" class="brand-img"></i>&nbsp;&nbsp;DHVSU</a>
		<ul class="side-menu">
			<li><a href="home"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="" class="active"><i class='bx bx-qr-scan icon' ></i> Scan QR-Code</a></li>
			<li>
				<a href="#"><i class='bx bxs-user-pin icon' ></i> Students <i class='bx bx-chevron-right icon-right' ></i></a>
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
			<div class="form">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</div>
			<span class="divider"></span>
			<div class="profile">
				<img src="../../src/img/<?php echo $profile_admin ?>" alt="">
				<ul class="profile-link">
					<li><a href="profile"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="notifications"><i class='bx bxs-bell icon' ></i> Notification</a></li><span class="badge">5</span>
					<li><a href="settings"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="authentication/admin-signout.php" class="btn-signout"><i class='bx bxs-log-out-circle' ></i> Signout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Scan QR-Code</h1>
            <ul class="breadcrumbs">
				<li><a href="home" >Home</a></li>
				<li class="divider">|</li>
                <li><a href="" class="active">Scan QR-Code</a></li>

			</ul>

			<!-- PROFILE CONFIGURATION -->

            <section class="profile-form">
				<div class="header"></div>
				<div class="profile">
					<div class="profile-img">
						<div class="scan">
                            <video id="preview"></video>
                            <form method="POST">
                                <img src="../../src/img/QR-scan3.gif" alt="scan-qr" class="qrscan_icon">
                                <input type="text" name="scan" id="scanqr" readonly="" class="qrcode">  
                            </form>
                        </div>
					</div>
					
					<div class="student-profile">
						<div class="row gx-5 needs-validation">

							<label class="form-label" style="text-align: left; padding-top: .5rem; padding-bottom: 1rem; font-size: 1rem; font-weight: bold;"><i class='bx bxs-edit'></i> Student Profile</label>

							<?php

								$pdoQuery = "SELECT * FROM student_activity_$admin_ID ORDER by userId DESC";
								$pdoResult = $pdoConnect->prepare($pdoQuery);
								$pdoExec = $pdoResult->execute();

								if($studentProfile = $pdoResult->fetch(PDO::FETCH_ASSOC)){

								$studentName = ($studentProfile['last_name']).(", ").($studentProfile['first_name']).(" ").($studentProfile['middle_name']);
								$studentAddress = ($studentProfile['barangay']).(", ").($studentProfile['city']).(" ").($studentProfile['province']);

									echo 
									"
									<div>
									<p>Student ID:</p>
								 		<h1>$studentProfile[studentId]</h1>
										<p>Student Name:</p>
											<h1>$studentName</h1>
										<p>Student Address:</p>
											<h1>$studentAddress</h1>
										<p>Contact Number:</p>
											<h1>+63$studentProfile[phone_number]</h1>
									</div>

									";

								}
								else{

									echo 
									"
									<div>
									<p>Student ID:</p>
								 		<h1></h1>
										<p>Student Name:</p>
											<h1></h1>
										<p>Student Address:</p>
											<h1></h1>
										<p>Contact Number:</p>
											<h1></h1>
									</div>

									";
									
								}

							?>

							<div class="col-md-6" style="opacity: 0;">
								<label for="first_name" class="form-label">First Name<span> *</span></label>
								<input type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="" id="" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
								<div class="invalid-feedback">
								Please provide a First Name.
								</div>
							</div>

							<div class="col-md-6" style="opacity: 0;">
								<label for="middle_name" class="form-label">Middle Name</label>
								<input type="text" class="form-control" autocapitalize="on" maxlength="15" autocomplete="off" name="" id="" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" >
								<div class="invalid-feedback">
								Please provide a Middle Name.
								</div>
							</div>

						</div>

					</div>
                </div>
            </section>		
		</main>

		
		<!-- MAIN -->
	</section>
	<!-- END NAVBAR -->

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../src/node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../../src/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../src/js/dashboard.js"></script>


	<script>

        //QRCODE SCANNER

        var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                        
            scanner.addListener('scan',function(c){
                document.getElementById('scanqr').value=c;
                document.forms[0].submit();
            });

            Instascan.Camera.getCameras().then(function (cameras){

            if(cameras.length>0){

            scanner.start(cameras[0]);

            $('[name="options"]').on('change',function(){

            if($(this).val()==1){

                if(cameras[0]!=""){

                scanner.start(cameras[0]);

                }else{

                alert('No Front camera found!');

                }

            }else if($(this).val()==2){

                if(cameras[1]!=""){

                scanner.start(cameras[1]);

                }else{

                alert('No Back camera found!');

                }

            }

            });

            }else{

            console.error('No cameras found.');

            alert('No cameras found.');

            }

            }).catch(function(e){

            console.error(e);

            });


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