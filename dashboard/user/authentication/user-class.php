<?php
session_start();
require_once __DIR__. '/../../../database/dbconfig.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../../../database/dbconfig2.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';
require_once __DIR__. '/../../vendor/autoload.php';

class USER
{ 

 private $conn;
 
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }
 
 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
 
 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
 
 public function register($studentId,$first_name,$middle_name,$last_name,$sex,$birth_date,$age,$place_of_birth,$civil_status,$nationality,$religion,$phone_number,$email,$upass,$province,$city,$barangay,$emergency_contact_person, $emergency_mobile_number,$emergency_address,$qrcode,$tokencode)
 {
  try
  {       
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO student(studentId, first_name, middle_name, last_name, sex, birth_date, age, place_of_birth, civil_status, nationality, religion, phone_number, email, password, province, city, barangay, emergency_contact_person, emergency_address, emergency_mobile_number, qrcode, tokencode) 
                                        VALUES(:studentId, :first_name, :middle_name, :last_name, :sex, :birth_date, :age, :place_of_birth, :civil_status, :nationality, :religion, :phone_number, :email, :password, :province, :city, :barangay, :emergency_contact_person, :emergency_address, :emergency_mobile_number, :qrcode, :tokencode)");
   
   $stmt->bindparam(":studentId",$studentId);
   $stmt->bindparam(":first_name",$first_name);
   $stmt->bindparam(":middle_name",$middle_name);
   $stmt->bindparam(":last_name",$last_name);
   $stmt->bindparam(":sex",$sex);
   $stmt->bindparam(":birth_date",$birth_date);
   $stmt->bindparam(":age",$age);
   $stmt->bindparam(":place_of_birth",$place_of_birth);
   $stmt->bindparam(":civil_status",$civil_status);
   $stmt->bindparam(":nationality",$nationality);
   $stmt->bindparam(":religion",$religion);
   $stmt->bindparam(":phone_number",$phone_number);
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":password",$password);
   $stmt->bindparam(":province",$province);
   $stmt->bindparam(":city",$city);
   $stmt->bindparam(":barangay",$barangay);
   $stmt->bindparam(":emergency_contact_person",$emergency_contact_person);
   $stmt->bindparam(":emergency_address",$emergency_address);
   $stmt->bindparam(":emergency_mobile_number",$emergency_mobile_number);
   $stmt->bindparam(":qrcode",$qrcode);
   $stmt->bindparam(":tokencode",$tokencode);

   $stmt->execute(); 
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM student WHERE email=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   $Uname = $userRow['email'];
   

   if($stmt->rowCount() == 1)
   {
    if($userRow['status']=="Y")
    {
     if($userRow['password']==md5($upass))
     {
      DATE_DEFAULT_TIMEZONE_SET('Asia/Manila');
      $activity = "Has successfully signed in";
      $date_now = date("Y-m-d h:i:s A");
      $user = "Student $Uname";
  
      $stmt = $this->conn->prepare("INSERT INTO tb_logs (user, email, activity, date) VALUES (:user, :email, :activity, :date)");
      $stmt->execute(array(":user"=>$user,":email"=>$email,":activity"=>$activity,":date"=>$date_now));
      $_SESSION['userSession'] = $userRow['userId'];
      return true;
     }
     else
     {
      echo "$email";
      $_SESSION['status_title'] = "Oops !";
      $_SESSION['status'] = "Email or Password is incorrect.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 1000000;
      header("Location: ../../../");
      exit;
     }
    }
    else
    {
      $_SESSION['status_title'] = "Sorry !";
      $_SESSION['status'] = "Entered email is not verify, please go to your email and verify it. Thank you !";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 10000000;
     header("Location: ../../..");
     exit;
    } 
   }
   else
   {
    $_SESSION['status_title'] = "Sorry !";
    $_SESSION['status'] = "Email or Password is incorrect.";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 10000000;
   header("Location: ../../..");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 
 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 public function logout()
 {

  session_destroy();
  $_SESSION['userSession'] = false;
 }
 
 function send_mail($email,$message,$subject,$smtp_email,$smtp_password,$system_name)
 {      
  $mail = new PHPMailer();
  $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = "tls";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 587;             
  $mail->AddAddress($email);
  $mail->Username = $smtp_email;  
  $mail->Password= $smtp_password;          
  $mail->SetFrom($smtp_email, $system_name);
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 } 
}
?>