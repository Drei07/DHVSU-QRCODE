<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

$UId = $_GET["id"];

if(isset($_POST['btn-update-avatar'])){

    $folder = "../../../src/img/" . basename($_FILES['Logo']['name']);
    $Picture = $_FILES['Logo']['name'];

    $pdoQuery = 'UPDATE admin SET adminProfile=:profile WHERE userId= :userId';
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":profile"                =>$Picture,
    ":userId"                =>$UId
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Profile logo succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');

    if (move_uploaded_file($_FILES['Logo']['tmp_name'], $folder)) {
        header('Location: ../profile');
    }
}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../profile');
    
    
}


?>