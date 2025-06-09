<?php
session_start();

require_once __DIR__. '/../../../database/dbconfig.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../../../configuration/settings-configuration.php';
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

 public function siteSecretKey() {
    $config = new SystemConfig();
    $SSkey = $config->getSSKey();
    return $SSkey;
 }

 public function smtpEmail(){
  $smtp = new SystemConfig();
  $smtp_email = $smtp->getSmtpEmail();
  return $smtp_email;
 }

 public function smtpPassword(){
  $smtp = new SystemConfig();
  $smtp_password = $smtp->getSmtpPassword();
  return $smtp_password;
 }

 public function systemName(){
  $systemname = new SystemConfig();
  $Sname = $systemname->getSystemName();
  return $Sname;
 }

 public function emailConfig(){
  return [
    'email' => $this->smtpEmail(),
    'password' => $this->smtpPassword(),
    'system_name' => $this->systemName()
  ];
 }

 public function mainUrl(){
  $URL = "http://localhost/CCSFP-MIDTERM";
  return $URL;
 }

 public function systemLogo(){
  $smtp = new SystemConfig();
  $systemLogo = $smtp->getSystemLogo();
  return $systemLogo;
 }

 public function lasdID()
 {
  return $this->conn->lastInsertId();
 }
 
 public function register($first_name, $middle_name, $last_name, $email, $hash_password, $tokencode, $user_type, $user_status)
 {
  try
  {       
   $password = md5($hash_password);
   $stmt = $this->conn->prepare("INSERT INTO users(first_name, middle_name, last_name, email, password, tokencode, user_type, status) 
                                 VALUES(:first_name, :middle_name, :last_name, :email, :password, :tokencode, :user_type, :status)");
   
   $stmt->bindparam(":first_name",$first_name);
   $stmt->bindparam(":middle_name",$middle_name);
   $stmt->bindparam(":last_name",$last_name);
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":password",$password);
   $stmt->bindparam(":tokencode",$tokencode);
   $stmt->bindparam(":user_type",$user_type);
   $stmt->bindparam(":status",$user_status);

   $stmt->execute(); 
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function login($email,$hash_password)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email_id AND account_status = :account_status AND user_type = :user_type");
   $stmt->execute(array(":email_id"=>$email , ":account_status" => "active", "user_type" => 9));
   $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

   if($stmt->rowCount() == 1)
   {
    if($userRow['status']=="Y")
    {
     if($userRow['password'] == md5($hash_password))
     {
      date_default_timezone_set('Asia/Manila');
      $activity = "Has successfully signed in";
      $date_now = date("Y-m-d h:i:s A");
      $user_id = $userRow['id'];

      $stmt = $this->conn->prepare("INSERT INTO logs (user_id, activity) VALUES (:user_id, :activity)");
      $stmt->execute(array(":user_id"=>$user_id, ":activity"=>$activity));
      $_SESSION['user_session'] = $userRow['id'];
      return true;
     }
     else
     {
      $_SESSION['status_title'] = "Oops !";
      $_SESSION['status'] = "Email or Password is incorrect.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 1000000;
      header("Location: ../../../signin");
      exit;
     }
    }
    else if($userRow['status']=="D"){
      $_SESSION['status_title'] = "Sorry !";
      $_SESSION['status'] = "Your application as an agent is declined. Sorry for the inconvenience.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 10000000;
      header("Location: ../../../signin");
      exit;
    }
    else
    {
      $_SESSION['status_title'] = "Sorry !";
      $_SESSION['status'] = "Entered email is not verified. Please go to your email and verify it. Thank you!";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 10000000;
      header("Location: ../../../signin");
      exit;
    } 
   }
   else
   {
    $_SESSION['status_title'] = "Sorry !";
    $_SESSION['status'] = "No account found or your account has been removed!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 10000000;
    header("Location: ../../../signin");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function isUserLoggedIn()
 {
  return isset($_SESSION['user_session']);
 }
 
 public function redirect($url)
 {
  header("Location: $url");
  exit;
 }
 
 public function logout()
 {
  unset($_SESSION['user_session']);

  $_SESSION['status_title'] = 'Logout!';
  $_SESSION['status'] = 'Thank you for using MAGRENT';
  $_SESSION['status_code'] = 'success';
  $_SESSION['status_timer'] = 40000;    
  header('Location: ../../../signin');
  exit;
 }

 public function send_mail($email, $message, $subject, $smtp_email, $smtp_password, $system_name)
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
  $mail->Password = $smtp_password;         
  $mail->SetFrom($smtp_email, $system_name);
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $imagePath = __DIR__ . '/../../../src/images/main_logo/logo.png';
  if (file_exists($imagePath)) {
    $mail->AddEmbeddedImage($imagePath, 'logo', 'logo.png');
  }
  $mail->Send();
 } 
}
?>
