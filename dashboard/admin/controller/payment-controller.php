<?php
require_once '../authentication/admin-class.php';


class PaymentController
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

    public function acceptPayment($user_id, $package_id, $payment_id, $status, $start_date, $end_date)
    {
        $stmt = $this->admin->runQuery('UPDATE payment SET start_date=:start_date, end_date=:end_date, status=:status  WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"               => $payment_id,
            ":start_date"       => $start_date,
            ":end_date"         => $end_date,
            ":status"           => $status,
        ));
        if ($exec) {
            $this->updateUserPackage($user_id, $package_id);
            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Payment successfully accepted';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../payment?status=pending');
        exit();
    }

    private function updateUserPackage($user_id, $package_id)
    {
        $stmt = $this->admin->runQuery('UPDATE users SET package_id=:package_id WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"               => $user_id,
            ":package_id"       => $package_id,
        ));


        if ($exec) {

            $stmt = $this->admin->runQuery('SELECT * FROM users WHERE id=:id');
            $stmt->execute(array(":id" => $user_id));
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
                <h1>Payment Verification</h1>
                <p>Hello, <strong>$email</strong></p>
                <p>Welcome to $this->system_name</p>
                <p>Your payment is verified please enjoy using MAGRENT, thankyou!</p>
                <p>If you have any questions or concerns, please contact our support team.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
        ";

            $subject = "Payment Verification";
            $this->admin->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
        }
    }

    public function declinePayment($user_id, $payment_id, $status)
    {
        $stmt = $this->admin->runQuery('UPDATE payment SET status=:status  WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"               => $payment_id,
            ":status"           => $status,
        ));
        if ($exec) {

            $stmt = $this->admin->runQuery('SELECT * FROM users WHERE id=:id');
            $stmt->execute(array(":id" => $user_id));
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
                <h1>Payment Verification</h1>
                <p>Hello, <strong>$email</strong></p>
                <p>Welcome to $this->system_name</p>
                <p>Your payment is decline for some reason, thankyou!</p>
                <p>If you have any questions or concerns, please contact our support team.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
        ";

            $subject = "Payment Verification";
            $this->admin->send_mail($email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);

            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Payment successfully decline';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../payment?status=pending');
        exit();
    }
}
if (isset($_GET['accept_payment'])) {
    $user_id              = trim($_GET['user_id']);
    $package_id           = trim($_GET['package_id']);
    $payment_id           = trim($_GET['id']);
    $status               = "accept";
    // Set the start date to the current date
    $start_date = date("Y-m-d");

    // Calculate the end date by adding one year to the start date
    $end_date = date("Y-m-d", strtotime($start_date . " +1 year"));


    $accept_payment = new PaymentController();
    $accept_payment->acceptPayment($user_id, $package_id, $payment_id, $status, $start_date, $end_date);
}

if (isset($_GET['decline_payment'])) {
    $user_id              = trim($_GET['user_id']);
    $payment_id           = trim($_GET['id']);
    $status               = "decline";


    $decline_payment = new PaymentController();
    $decline_payment->declinePayment($user_id, $payment_id, $status);
}
