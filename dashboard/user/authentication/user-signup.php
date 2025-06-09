<?php
include_once __DIR__ . '/../../../configuration/settings-configuration.php';
include_once __DIR__ . '/../../../database/dbconfig.php';
require_once 'user-class.php';

class UserController
{
    private $user;
    private $main_url;
    private $smtp_email;
    private $smtp_password;
    private $system_name;
    private $system_logo;
    private $conn;


    public function __construct()
    {
        $this->user = new USER();
        $this->main_url = $this->user->mainUrl();
        $this->smtp_email = $this->user->smtpEmail();
        $this->smtp_password = $this->user->smtpPassword();
        $this->system_name = $this->user->systemName();
        $this->system_logo = $this->user->systemLogo();
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function userSendOtp($otp, $email)
    {
        if ($email == NULL) {
            $_SESSION['status_title'] = "Ooops";
            $_SESSION['status'] = "No email found, Please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../../../signin');
            exit();
        } else {
            //check if the email already exist before sending OTP
            $stmt = $this->user->runQuery("SELECT * FROM users WHERE email=:email");
            $stmt->execute(array(":email"=>$email));
            $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                $_SESSION['status_title'] = "Oops!";
                $_SESSION['status'] = "Email already taken. Please try another one.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_timer'] = 100000;
                header('Location: ../../../signin');
                exit();
            }
            else{
            // Store OTP in session
            $_SESSION['OTP'] = $otp;

            $subject = "OTP Verification";
            $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>OTP Verification</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                }
                
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 30px;
                    background-color: #ffffff;
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                
                h1 {
                    color: #333333;
                    font-size: 24px;
                    margin-bottom: 20px;
                }
                
                p {
                    color: #666666;
                    font-size: 16px;
                    margin-bottom: 10px;
                }
                
                .button {
                    display: inline-block;
                    padding: 12px 24px;
                    background-color: #0088cc;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 4px;
                    font-size: 16px;
                    margin-top: 20px;
                }
                
                .logo {
                    display: block;
                    text-align: center;
                    margin-bottom: 30px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='logo'>
                    <img src='cid:logo' alt='Logo' width='150'>
                </div>
                <h1>OTP Verification</h1>
                <p>Hello, $email</p>
                <p>Your OTP is: $otp</p>
                <p>If you didn't request an OTP, please ignore this email.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>";

            $this->user->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name, $this->system_logo);

            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = "We've sent the OTP to $email";
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;

            header('Location: ../../../verify-otp');
            exit;
        }
    }
    }

    public function userVerifyOtp($first_name, $middle_name, $last_name, $email, $user_type, $user_status, $tokencode, $hash_password, $otp)
    {
        if ($otp == $_SESSION['OTP']) {

            // Destroy the OTP in session
            unset($_SESSION['OTP']);

            $this->user->register($first_name, $middle_name, $last_name, $email, $hash_password, $tokencode, $user_type, $user_status);
            $id = $this->user->lastID();
            $key = base64_encode($id);
            $id = $key;

            $message = 
            "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Email Verification</title>
                <style>
                    /* Define your CSS styles here */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        margin: 0;
                        padding: 0;
                    }
                    
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 30px;
                        background-color: #ffffff;
                        border-radius: 4px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    
                    h1 {
                        color: #333333;
                        font-size: 24px;
                        margin-bottom: 20px;
                    }
                    
                    p {
                        color: #666666;
                        font-size: 16px;
                        margin-bottom: 10px;
                    }
                    
                    .button {
                        display: inline-block;
                        padding: 12px 24px;
                        background-color: #0088cc;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 4px;
                        font-size: 16px;
                        margin-top: 20px;
                    }
                    
                    .logo {
                        display: block;
                        text-align: center;
                        margin-bottom: 30px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='logo'>
                    <img src='cid:logo' alt='Logo' width='150'>
                    </div>
                    <h1>Email Verification</h1>
                    <p>Hello, <strong>$email</strong></p>
                    <p>Welcome to $this->system_name</p>
                    Email:<br />$email <br />
                    Password:<br />$hash_password
                    <p>If you did not sign up for an account, you can safely ignore this email.</p>
                    <p>Thank you!</p>
                </div>
            </body>
            </html>
            ";
            $subject = "Welcome to MAGRENT";

            $this->user->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name, $this->system_logo);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Please check the Email to check the credentials.";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;

            // Unset the not verified details in session
            unset($_SESSION['not_verify_firstname']);
            unset($_SESSION['not_verify_middlename']);
            unset($_SESSION['not_verify_lastname']);
            unset($_SESSION['not_verify_email']);
            unset($_SESSION['user_type'] );

            header('Location: ../../../signin');
            exit();

        } else if ($otp == NULL) {
            $_SESSION['status_title'] = "OTP is not found";
            $_SESSION['status'] = "It appears that the OTP you entered is invalid. Please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../../../verify-otp');
            exit();
        } else {
            $_SESSION['status_title'] = "OTP is invalid";
            $_SESSION['status'] = "It appears that the OTP you entered is invalid. Please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../../../verify-otp');
            exit();
        }
    }
}

//pre register the details
if (isset($_POST['btn-signup'])) {
    $_SESSION['not_verify_firstname']       = trim($_POST['first_name']);
    $_SESSION['not_verify_middlename']      = trim($_POST['middle_name']);
    $_SESSION['not_verify_lastname']        = trim($_POST['last_name']);
    $_SESSION['not_verify_email']           = trim($_POST['email']);
    $_SESSION['user_type']                  = 3;
    $email                                  = $_SESSION['not_verify_email'];
    //generate OTP
    $otp = rand(100000, 999999);

    $send_otp = new UserController();
    $send_otp->userSendOtp($otp, $email);
}

//verify email through OTP
if (isset($_POST['btn-verify-otp'])) {

    // Set the verified details in session
    $first_name     = $_SESSION['not_verify_firstname'];
    $middle_name    = $_SESSION['not_verify_middlename'];
    $last_name      = $_SESSION['not_verify_lastname'];
    $email          = $_SESSION['not_verify_email'];
    $user_type      = $_SESSION['user_type'];
    $user_status    = 'Y';
    $tokencode      = md5(uniqid(rand()));


    // Generate Password
    $varchar            = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle            = str_shuffle($varchar);
    $hash_password      = substr($shuffle,0,8);

    $otp = trim($_POST['verify_otp']);

    $verify_otp = new UserController();
    $verify_otp->userVerifyOtp($first_name, $middle_name, $last_name, $email, $user_type, $user_status, $tokencode, $hash_password, $otp);
}

//resend OTP
if (isset($_GET['btn-resending-otp'])) {
    $email  = $_SESSION['not_verify_email'];
    //generate OTP
    $otp = rand(100000, 999999);

    $send_otp = new UserController();
    $send_otp->userSendOtp($otp, $email);
}
