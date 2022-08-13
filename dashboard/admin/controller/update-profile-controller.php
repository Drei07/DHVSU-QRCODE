<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

$UId            = $_GET["id"];

if(isset($_POST['btn-update-profile'])){

    $fname                      = trim($_POST['FName']);
    $mname                      = trim($_POST['MName']);
    $lname                      = trim($_POST['LName']);
    $position                     = trim($_POST['Position']);

    $pdoQuery = 'UPDATE admin SET adminFirst_Name=:adminFirst_Name, adminMiddle_Name=:adminMiddle_Name, adminLast_Name=:adminLast_Name, adminPosition=:adminPosition  WHERE userId= :userId';;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 

    ":adminFirst_Name"             =>$fname,
    ":adminMiddle_Name"            =>$mname,
    ":adminLast_Name"              =>$lname,
    ":adminPosition"               =>$position,
    ":userId"                      =>$UId,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../profile');
    
    
}

?>