<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$UId = $row['userId'];
$locationId = $_GET["Id"];

    $pdoQuery = "UPDATE admin SET adminLocation=:adminLocation WHERE userId = :userId";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":adminLocation"        =>$locationId,
    ":userId"               =>$UId
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Location successfully changed!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../scan-qrcode');

?>