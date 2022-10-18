<?php
require_once '../../user/authentication/user-class.php';

//URL lIVE
// $main_url = "https://qsmartattendance.tech";

// localhost
//URL
$main_url = "http://localhost/DHVSU-QRCODE";

$reg_user = new USER();


if(isset($_POST['btn-register'])) {

    $studentId                  =       trim($_POST['StudentId']);
    $first_name                 =       trim($_POST['FName']);
    $middle_name                =       trim($_POST['MName']);
    $last_name                  =       trim($_POST['LName']);
    $sex                        =       trim($_POST['Sex']);
    $birth_date                 =       trim($_POST['BirthDate']);
    $age                        =       trim($_POST['Age']);
    $place_of_birth             =       trim($_POST['PBirth']);
    $civil_status               =       trim($_POST['CStatus']);
    $nationality                =       trim($_POST['Nationality']);
    $religion                   =       trim($_POST['Religion']);
    $phone_number               =       trim($_POST['PNumber']);
    $email                      =       trim($_POST['Email']);
    $province                   =       trim($_POST['Province']);
    $city                       =       trim($_POST['City']);
    $barangay                   =       trim($_POST['Barangay']);
    $emergency_contact_person   =       trim($_POST['Emergency_Contact_Person']);
    $emergency_address          =       trim($_POST['Emergency_Address']);
    $emergency_mobile_number    =       trim($_POST['Emergency_Mobile_No']);

    // Generate QRcode
    $qrcode                     =       md5(uniqid(rand()));
    

    // Generate Password
    $varchar                    =       "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle                    =       str_shuffle($varchar);
    $upass                      =       substr($shuffle,0,8);

    // Token Generator
    $tokencode                  =       md5(uniqid(rand()));


    $stmt = $reg_user->runQuery("SELECT * FROM student WHERE email=:email_id");
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Email Existed
    if($stmt->rowCount() > 0)
    {
      $_SESSION['status_title'] = "Oops!";
      $_SESSION['status'] = "Email already taken. Please try another one.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 100000;
      header('Location: ../add-admin');
    }
    else
    {
        if($reg_user->register($studentId,$first_name,$middle_name,$last_name,$sex,$birth_date,$age,$place_of_birth,$civil_status,$nationality,$religion,$phone_number,$email,$upass,$province,$city,$barangay,$emergency_contact_person,$emergency_mobile_number,$emergency_address,$qrcode,$tokencode))
        {   
        $id = $reg_user->lasdID();  
        $key = base64_encode($id);
        $id = $key;
        
        $message = "     
            Hello sir/maam $last_name,
            <br /><br />
            Welcome to DHVSU Harmonized Gender and Development Guidelines Monitoring Systems !
            <br /><br />
            Email:<br />$email
            Password:<br />$upass
            <br /><br />
            <a href='$main_url/public/user/verify?id=$id&code=$tokencode'>Click HERE to Verify your Account!</a>
            <br /><br />
            Thanks,";
            
        $subject = "Verify Email";
            
        $reg_user->send_mail($email,$message,$subject,$smtp_email,$smtp_password,$system_name);
        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Please check the Email to verify the account.";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;
        header('Location: ../add-students');
        }
        else
        {

            $_SESSION['status_title'] = "Sorry !";
            $_SESSION['status'] = "Something went wrong, please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 10000000;
            header('Location: ../add-students');

        }
    }
      

}

?>