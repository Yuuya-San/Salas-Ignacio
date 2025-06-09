<?php
require_once '../authentication/admin-class.php';


class AgentController
{
    private $admin;
    private $main_url;
    private $smtp_email;
    private $smtp_password;
    private $system_name;
    private $conn;


    public function __construct()
    {
        $this->admin = new ADMIN();
        $this->main_url = $this->admin->mainUrl();
        $this->smtp_email = $this->admin->smtpEmail();
        $this->smtp_password = $this->admin->smtpPassword();
        $this->system_name = $this->admin->systemName();

        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }


    public function acceptApplication($agent_id)
    {

        $stmt = $this->admin->runQuery('UPDATE users SET status=:status WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"        => $agent_id,
            ":status"   => "Y",
        ));

        if ($exec) {

            $stmt = $this->admin->runQuery('SELECT * FROM users WHERE id=:id');
            $stmt->execute(array(":id" => $agent_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $row['email'];

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
                <h1>Agent Account Verification Confirmation</h1>
                <p>Hello, <strong>$email</strong></p>
                <p>Welcome to $this->system_name</p>
                <p>Your account is verified please enjoy using MAGRENT, thankyou!</p>
                <p>If you have any questions or concerns, please contact our support team.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
        ";

            $subject = "Account Verification Confirmation";
            $this->admin->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);


            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Agent is now part of MAGRENT';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../pending-user');
    }

    public function deleteApplication($agent_id)
    {

        $stmt = $this->admin->runQuery('UPDATE users SET status=:status WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"        => $agent_id,
            ":status"   => "D",
        ));

        if ($exec) {

            $stmt = $this->admin->runQuery('SELECT * FROM users WHERE id=:id');
            $stmt->execute(array(":id" => $agent_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $row['email'];

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
                <h1>Agent Account Declined</h1>
                <p>Hello, <strong>$email</strong></p>
                <p>Welcome to $this->system_name</p>
                <p>Sorry your account is declined due to some reasons, sorry for inconvenience, thankyou!</p>
                <p>If you have any questions or concerns, please contact our support team.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
        ";

            $subject = "Account Declined";
            $this->admin->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);

            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Agent request successfully declined!';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../pending-user');
    }

        //activate agent
        public function activateAgent($agent_id){
    
            $active = "active";
            $stmt = $this->admin->runQuery('UPDATE users SET account_status=:account_status WHERE id=:id');
            $exec = $stmt->execute(array(
                ":id"                => $agent_id,
                ":account_status"   => $active,
            ));
    
            if ($exec) {
                $_SESSION['status_title'] = 'Success!';
                $_SESSION['status'] = 'Agent successfully activated!';
                $_SESSION['status_code'] = 'success';
                $_SESSION['status_timer'] = 40000;
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'Something went wrong, please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
            }
    
            header('Location: ../user');
            exit();
    
        }

        //disabled agent
        public function disabledAgent($agent_id){

            $disabled = "disabled";
            $stmt = $this->admin->runQuery('UPDATE users SET account_status=:account_status WHERE id=:id');
            $exec = $stmt->execute(array(
                ":id"               => $agent_id,
                ":account_status"   => $disabled,
            ));
    
            if ($exec) {
                $_SESSION['status_title'] = 'Success!';
                $_SESSION['status'] = 'Agent successfully disabled!';
                $_SESSION['status_code'] = 'success';
                $_SESSION['status_timer'] = 40000;
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'Something went wrong, please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
            }
    
            header('Location: ../user');
            exit();
    
        }
    

}

//activate agent
if (isset($_GET['activate_agent'])) {
    $agent_id = $_GET["agent_id"];

    $activate_agent = new AgentController();
    $activate_agent->activateAgent($agent_id);
}


//disabled agent
if (isset($_GET['disabled_agent'])) {
    $agent_id = $_GET["agent_id"];

    $disabled_agent = new AgentController();
    $disabled_agent->disabledAgent($agent_id);
}

//Accept agent application
if (isset($_GET['accept_application'])) {

    $agent_id =  $_GET['agent_id'];

    $acceptApplication = new AgentController();
    $acceptApplication->acceptApplication($agent_id);
}

//Decline agent application
if (isset($_GET['delete_application'])) {

    $agent_id =  $_GET['agent_id'];

    $deleteApplication = new AgentController();
    $deleteApplication->deleteApplication($agent_id);
}
