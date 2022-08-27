<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}


if(isset($_POST['btn-register'])) {

    $StudentId                      = trim($_POST['StudentId']);
    $FName                          = trim($_POST['FName']);
    $MName                          = trim($_POST['MName']);
    $LName                          = trim($_POST['LName']);
    $Sex                            = trim($_POST['Sex']);
    $BirthDate                      = trim($_POST['BirthDate']);
    $Age                            = trim($_POST['Age']);
    $PBirth                         = trim($_POST['PBirth']);
    $CStatus                        = trim($_POST['CStatus']);
    $Nationality                    = trim($_POST['Nationality']);
    $Religion                       = trim($_POST['Religion']);
    $PNumber                        = trim($_POST['PNumber']);
    $Email                          = trim($_POST['Email']);
    $Province                       = trim($_POST['Province']);
    $City                           = trim($_POST['City']);
    $Barangay                       = trim($_POST['Barangay']);
    $Emergency_Contact_Person       = trim($_POST['Emergency_Contact_Person']);
    $Emergency_Address              = trim($_POST['Emergency_Address']);
    $Emergency_Mobile_No            = trim($_POST['Emergency_Mobile_No']);
    $qrcode                         = md5(uniqid(rand()));

    $pdoQuery = "SELECT * FROM student WHERE studentId = :studentId";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":studentId"=>$StudentId,));
    $row = $pdoResult->fetch(PDO::FETCH_ASSOC);

    $pdoQuery = "SELECT * FROM student WHERE email = :email";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec2 = $pdoResult2->execute(array(":email"=>$email,));
    $row2 = $pdoResult2->fetch(PDO::FETCH_ASSOC);

    if($pdoResult->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Student ID already registered. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../add-students');
    }
    else if($pdoResult2->rowCount() > 0){
        $_SESSION['status_title'] = "Oops!";
        $_SESSION['status'] = "Email is already registered. Please try another one.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 100000;
        header('Location: ../add-students');
    }
    else{

    $pdoQuery = "INSERT INTO student (studentId, first_name, middle_name, last_name, sex, birth_date, age, place_of_birth, civil_status, nationality, religion, phone_number, email, province, city, barangay, emergency_contact_person, emergency_address, emergency_mobile_number, qrcode) 
                    VALUES (:studentId, :first_name, :middle_name, :last_name, :sex, :birth_date, :age, :place_of_birth, :civil_status, :nationality, :religion, :phone_number, :email, :province, :city, :barangay, :emergency_contact_person, :emergency_address, :emergency_mobile_number, :qrcode)";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute
    (
        array
        ( 
            ":studentId"                =>$StudentId,
            ":first_name"               =>$FName,
            ":middle_name"              =>$MName,
            ":last_name"                =>$LName,
            ":sex"                      =>$Sex,
            ":birth_date"               =>$BirthDate,
            ":age"                      =>$Age,
            ":place_of_birth"           =>$PBirth,
            ":civil_status"             =>$CStatus,
            ":nationality"              =>$Nationality, 
            ":religion"                 =>$Religion,
            ":phone_number"             =>$PNumber,
            ":email"                    =>$Email,
            ":province"                 =>$Province,
            ":city"                     =>$City,
            ":barangay"                 =>$Barangay,
            ":emergency_contact_person" =>$Emergency_Contact_Person,
            ":emergency_address"        =>$Emergency_Address,
            ":emergency_mobile_number"  =>$Emergency_Mobile_No,
            ":qrcode"                   =>$qrcode,
        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Student is now Enrolled";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header('Location: ../add-students');
    }
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../add-students');

}

?>