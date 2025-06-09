<?php
require_once '../authentication/user-class.php';


class PropertyController
{
    private $user;
    private $main_url;
    private $smtp_email;
    private $smtp_password;
    private $system_name;
    private $conn;


    public function __construct()
    {
        $this->user = new USER();
        $this->main_url = $this->user->mainUrl();
        $this->smtp_email = $this->user->smtpEmail();
        $this->smtp_password = $this->user->smtpPassword();
        $this->system_name = $this->user->systemName();

        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function reserveProperty($user_id, $property_id, $user_name, $user_phone_number, $booking_start_date, $booking_end_date, $message)
    {
        // Check if the user has already reserved the property with disallowed statuses
        $disallowed_statuses = ["waiting", "pending", "send_email", "active"];
        $stmt_check_reservation = $this->user->runQuery('SELECT * FROM property_reservation WHERE user_id=:user_id AND property_id=:property_id AND status IN (:statuses)');
        $stmt_check_reservation->execute(array(":user_id" => $user_id, ":property_id" => $property_id, ":statuses" => $disallowed_statuses));

        if ($stmt_check_reservation->rowCount() >= 1) {
            // User has already reserved this property with disallowed statuses
            $_SESSION['status_title'] = 'Error!';
            $_SESSION['status'] = 'You cannot make another reservation for this property.';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;

            header('Location: ../property-details');
            exit();
        }
        else{
                $stmt_users = $this->user->runQuery('SELECT * FROM users WHERE id=:id');
                $stmt_users->execute(array(":id" => $user_id));
                $user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);

                $user_email = $user_data['email'];

                $stmt_property = $this->user->runQuery('SELECT * FROM property WHERE id=:id');
                $stmt_property->execute(array(":id" => $property_id));
                $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);

                $property_name = $property_data['property_name'];
                $agent_id = $property_data['user_id'];

                $stmt = $this->user->runQuery('INSERT INTO property_reservation (user_id, agent_id, property_id, user_name, user_phone_number, booking_start_date, booking_end_date, message) VALUES (:user_id, :agent_id, :property_id, :user_name, :user_phone_number, :booking_start_date, :booking_end_date, :message)');
                $exec = $stmt->execute(array(
                    ":user_id" => $user_id,
                    ":agent_id" => $agent_id,
                    ":property_id" => $property_id,
                    ":user_name" => $user_name,
                    ":user_phone_number" => $user_phone_number,
                    ":booking_start_date" => $booking_start_date,
                    ":booking_end_date" => $booking_end_date,
                    ":message" => $message
                ));

                if ($exec) {
                    $message =
                        "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset='UTF-8'>
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
                            <h1>Property Reservation</h1>
                            <p>Hello, <strong>$user_email</strong></p>
                            <p>Confirmation for Property Reservation</p>
                            <p>Thank you for using $this->system_name, this email is to confirm the reservation for the $property_name property, currently your reservation status is pending please wait for the confirmation from the property owner. Reservation details is below, Thank you!</p>
                            <p>If you have any questions or concerns, please contact our support team.</p>
                            Property Name: $property_name <br />
                            Booking Start Date: $booking_start_date <br />
                            Booking End Date: $booking_end_date <br />

                            <p>If you did reserve any property, you can safely ignore this email.</p>
                            <p>Thank you!</p>
                        </div>
                    </body>
                    </html>
                ";
                $subject = "Reservation Confirmation";

                $this->user->send_mail($user_email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
                    $_SESSION['status_title'] = "Success!";
                    $_SESSION['status'] = "Property is now Reserve";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_timer'] = 40000;
                    header('Location: ../property-details');
                    exit();
                } else {
                    // Handle file upload error here
                    $_SESSION['status_title'] = 'Oops!';
                    $_SESSION['status'] = 'Something went wrong during property reservation. Please try again!';
                    $_SESSION['status_code'] = 'error';
                    $_SESSION['status_timer'] = 100000;
                    header('Location: ../property-details');
                }
            }
        }
    }

if (isset($_POST['btn-reserve-property'])) {
    $user_id = trim($_POST['user_id']);
    $property_id = trim($_POST['property_id']);
    $user_name = trim($_POST['user_name']);
    $user_phone_number = trim($_POST['user_phone_number']);
    $booking_start_date = trim($_POST['booking_start_date']);
    $booking_end_date = trim($_POST['booking_end_date']);
    $message = trim($_POST['message']);


    $reserveProperty = new PropertyController();
    $reserveProperty->reserveProperty($user_id, $property_id, $user_name, $user_phone_number, $booking_start_date, $booking_end_date, $message);
}
