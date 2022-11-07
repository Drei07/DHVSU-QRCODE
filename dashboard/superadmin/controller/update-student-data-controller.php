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
    $Email                          = trim($_POST['Email']);

    $pdoQuery = "UPDATE student SET studentId=:studentId, first_name=:first_name, middle_name=:middle_name, last_name=:last_name, email=:email WHERE userid=$student_Id";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":studentId"                =>$StudentId,
            ":first_name"               =>$FName,
            ":middle_name"              =>$MName,
            ":last_name"                =>$LName,
            ":email"                    =>$Email,
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