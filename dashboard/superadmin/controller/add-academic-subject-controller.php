<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';


$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('');
}

$subject = $_GET['id'];


if(isset($_POST['btn-register'])) {

    $YLevel                      = trim($_POST['YLevel']);
    $SName                       = trim($_POST['SName']);
    $SCode                       = trim($_POST['SCode']);


    $pdoQuery = "INSERT INTO subjects_$subject (year_level, subject_name, subject_code) 
                    VALUES (:year_level, :subject_name, :subject_code)";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":subject_name"               =>$SName,
            ":subject_code"               =>$SCode,
            ":year_level"                 =>$YLevel,

        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Academic Program Subjects successfully added!";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header("Location: ../add-academic-subjects?id=$subject");
  
}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../add-academic-subjects?id=$subject");

}

?>