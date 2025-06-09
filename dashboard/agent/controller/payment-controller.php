<?php
require_once '../authentication/agent-class.php';


class PaymentController
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

    public function addPayment($user_id, $package_id, $reference_number, $proof_of_payment){

        $stmt = $this->agent->runQuery('SELECT * FROM payment WHERE user_id=:user_id AND status = :status');
        $stmt->execute(array(":user_id" => $user_id,  ":status" => "pending"));
    
        // Fetch a single row, not the whole result set
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if a row exists
        if($row){
            // Use $row instead of $row->rowCount()
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = "You have a pending payment verification, please wait until it's verified, Thank you!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
            header('Location: ../package');
            exit();
        }
        else{
            $upload_proof_of_payment = "../../../src/images/proof_of_payment/" . basename($proof_of_payment);
    
            if(move_uploaded_file($_FILES['proof_of_payment']['tmp_name'], $upload_proof_of_payment)){
                $stmt = $this->agent->runQuery('INSERT INTO payment (user_id, package_id, reference_number, proof_of_payment) VALUES (:user_id, :package_id, :reference_number, :proof_of_payment)');
                $exec = $stmt->execute(array(
                    ":user_id"            => $user_id, 
                    ":package_id"         => $package_id, 
                    ":reference_number"   => $reference_number, 
                    ":proof_of_payment"   => $proof_of_payment, 
                ));
    
                if($exec){
                    $_SESSION['status_title'] = "Success!";
                    $_SESSION['status'] = "Successfully Purchase, wait for the email confirmation if your payment is verified, thank you for using MAGRENT";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_timer'] = 40000;
                    header('Location: ../package');
                    exit(); // Exit after redirect
                }
                else{
                    $_SESSION['status_title'] = "Oops!";
                    $_SESSION['status'] = 'Something went wrong, please try again!';
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_timer'] = 100000;
                    header('Location: ../package');
                    exit();
                }
            }
        }
    }
    
}
if(isset($_POST['btn-add-payment'])){
    $user_id                = trim($_POST['user_id']);
    $package_id             = trim($_POST['package_id']);
    $reference_number       = trim($_POST['reference_number']);
    $proof_of_payment       = $_FILES['proof_of_payment']['name'];


    $add_payment = new PaymentController();
    $add_payment->addPayment($user_id, $package_id, $reference_number, $proof_of_payment);

}