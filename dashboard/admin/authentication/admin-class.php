<?php
session_start();
require_once __DIR__. '/../../../database/dbconfig.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../../../database/dbconfig2.php';
require_once __DIR__. '/../../vendor/autoload.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';


class ADMIN
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
 
 public function register($employeeId,$position,$first_name,$middle_name,$last_name,$email,$upass,$tokencode,$uniqueId)
 {
  try
  {       
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO admin(employeeId,adminPosition,adminFirst_Name,adminMiddle_Name,adminLast_Name,adminEmail,adminPassword,tokencode, uniqueId) 
                                        VALUES(:employeeId,:adminPosition,:adminFirst_Name,:adminMiddle_Name,:adminLast_Name,:adminEmail,:adminPassword,:tokencode, :uniqueId)");
   
   $stmt->bindparam(":employeeId",$employeeId);
   $stmt->bindparam(":adminPosition",$position);
   $stmt->bindparam(":adminFirst_Name",$first_name);
   $stmt->bindparam(":adminMiddle_Name",$middle_name);
   $stmt->bindparam(":adminLast_Name",$last_name);
   $stmt->bindparam(":adminEmail",$email);
   $stmt->bindparam(":adminPassword",$password);
   $stmt->bindparam(":tokencode",$tokencode);
   $stmt->bindparam(":uniqueId",$uniqueId);

    if($stmt)
    {
      $sql = "CREATE TABLE student_activity_$uniqueId(
        userId INT(145) AUTO_INCREMENT PRIMARY KEY,
        employee_name varchar(145) DEFAULT NULL,
        employee_ID varchar(145) DEFAULT NULL,
        studentId varchar(145) DEFAULT NULL,
        first_name varchar(145) DEFAULT NULL,
        middle_name varchar(145) DEFAULT NULL,
        last_name varchar(145) DEFAULT NULL,
        sex varchar(145) DEFAULT NULL,
        birth_date varchar(145) DEFAULT NULL,
        age varchar(145) DEFAULT NULL,
        place_of_birth varchar(145) DEFAULT NULL,
        civil_status varchar(145) DEFAULT NULL,
        nationality varchar(145) DEFAULT NULL,
        religion varchar(145) DEFAULT NULL,
        phone_number varchar(145) DEFAULT NULL,
        email varchar(145) DEFAULT NULL,
        province varchar(145) DEFAULT NULL,
        city varchar(145) DEFAULT NULL,
        barangay varchar(147) DEFAULT NULL,
        emergency_contact_person varchar(145) DEFAULT NULL,
        emergency_address varchar(145) DEFAULT NULL,
        emergency_mobile_number varchar(145) DEFAULT NULL,
        qrcode varchar(999) DEFAULT NULL,
        activity varchar(145) DEFAULT NULL,
        date varchar(145) DEFAULT NULL,
        created_at timestamp NULL DEFAULT current_timestamp(),
        updated_at timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
      }
      $this->conn->exec($sql);

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
   $stmt = $this->conn->prepare("SELECT * FROM admin WHERE adminEmail=:email_id AND account_status = :account_status");
   $stmt->execute(array(":email_id"=>$email , ":account_status" => "active"));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   $Uname = $userRow['adminEmail'];
   

   if($stmt->rowCount() == 1)
   {
    if($userRow['adminStatus']=="Y")
    {
     if($userRow['adminPassword']==md5($upass))
     {
      DATE_DEFAULT_TIMEZONE_SET('Asia/Manila');
      $activity = "Has successfully signed in";
      $date_now = date("Y-m-d h:i:s A");
      $user = "Customer $Uname";
  
      $stmt = $this->conn->prepare("INSERT INTO tb_logs (user, email, activity, date) VALUES (:user, :email, :activity, :date)");
      $stmt->execute(array(":user"=>$user,":email"=>$email,":activity"=>$activity,":date"=>$date_now));
      $_SESSION['adminSession'] = $userRow['userId'];
      return true;
     }
     else
     {
      echo "$email";
      $_SESSION['status_title'] = "Oops !";
      $_SESSION['status'] = "Email or Password is incorrect.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 1000000;
      header("Location: ../../../public/admin/signin");
      exit;
     }
    }
    else
    {
      $_SESSION['status_title'] = "Sorry !";
      $_SESSION['status'] = "Entered email is not verify, please go to your email and verify it. Thank you !";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 10000000;
     header("Location: ../../../public/admin/signin");
     exit;
    } 
   }
   else
   {
    $_SESSION['status_title'] = "Sorry !";
    $_SESSION['status'] = "No account found or your account has been remove!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 10000000;
   header("Location: ../../../public/admin/signin");
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
  if(isset($_SESSION['adminSession']))
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

  unset($_SESSION['adminSession']);
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