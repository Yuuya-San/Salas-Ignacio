<?php
require_once 'agent-class.php';


class AgentController
{
    private $agent;
    private $main_url;
    private $smtp_email;
    private $smtp_password;
    private $system_name;
    private $conn;


    public function __construct()
    {
        $this->agent = new AGENT();
        $this->main_url = $this->agent->mainUrl();
        $this->smtp_email = $this->agent->smtpEmail();
        $this->smtp_password = $this->agent->smtpPassword();
        $this->system_name = $this->agent->systemName();

        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function agentRegistration($first_name, $middle_name, $last_name, $email, $user_type,  $valid_id, $tokencode, $hash_password, $package_type)
    {

            $folder = "../../../src/images/identification/" . basename($valid_id);

            if (move_uploaded_file($_FILES['valid_id']['tmp_name'], $folder)) {
                $this->agent->register($first_name, $middle_name, $last_name, $email, $valid_id, $hash_password, $tokencode, $user_type, $package_type);
                $id = $this->agent->lasdID();
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
                        <h1>Agent Account Verification Pending</h1>
                        <p>Hello, <strong>$email</strong></p>
                        <p>Welcome to $this->system_name</p>
                        <p>Your account is still pending verification. Please be patient as our admin reviews your account.</p>
                        <p>You will receive an email confirmation once your account is verified. Below are your credentials:</p>
                        <p>If you have any questions or concerns, please contact our support team.</p>
                        Email:<br />$email <br />
                        Password:<br />$hash_password
                        <p>If you did not sign up for an account, you can safely ignore this email.</p>
                        <p>Thank you!</p>
                    </div>
                </body>
                </html>
                ";
                $subject = "Welcome to MAGRENT";

                $this->agent->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
                $_SESSION['status_title'] = "Success!";
                $_SESSION['status'] = "Please check your Email";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_timer'] = 40000;
                header('Location: ../../../signin');
                exit();
            } else {
                // Handle file upload error here
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'File upload failed. Please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
                header('Location: ../../../agent-registration');

            }

    }
}
if (isset($_POST['btn-register-agent'])) {

    // Set the verified details in session
    $first_name         = trim($_POST['first_name']);
    $middle_name        = trim($_POST['middle_name']);
    $last_name          = trim($_POST['last_name']);
    $email              = trim($_POST['email']);
    $user_type          = 2;
    $valid_id           = $_FILES['valid_id']['name'];
    $tokencode          = md5(uniqid(rand()));
    $package_type       = 1;//default


    // Generate Password
    $varchar            = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle            = str_shuffle($varchar);
    $hash_password      = substr($shuffle, 0, 8);

    $register_agent = new AgentController();
    $register_agent->agentRegistration($first_name, $middle_name, $last_name, $email, $user_type, $valid_id, $tokencode, $hash_password, $package_type );
}
