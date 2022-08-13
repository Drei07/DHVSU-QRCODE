<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}


    $UId                            = $_GET["id"];
    $profile                      = "profile-red.png";


    $pdoQuery = 'UPDATE admin SET adminProfile=:profile WHERE userId= :userId';
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":profile"                =>$profile,
    ":userId"                =>$UId
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Avatar successfully updated!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');
    $pdoConnect = null;


?>