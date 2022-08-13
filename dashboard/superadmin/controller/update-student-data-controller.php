<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$student_Id = $_GET["id"];

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

    $pdoQuery = "UPDATE student SET studentId=:studentId, first_name=:first_name, middle_name=:middle_name, last_name=:last_name, sex=:sex, birth_date=:birth_date, age=:age, place_of_birth=:place_of_birth, civil_status=:civil_status, nationality=:nationality, religion=:religion, phone_number=:phone_number, email=:email, province=:province, city=:city, barangay=:barangay, emergency_contact_person=:emergency_contact_person, emergency_address=:emergency_address, emergency_mobile_number=:emergency_mobile_number WHERE userid=$student_Id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
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
            ":emergency_mobile_number"  =>$Emergency_Mobile_No
        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Students profile successfully updated";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../student-profile?id=$student_Id");
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../student-profile?id=$student_Id");

}

?>