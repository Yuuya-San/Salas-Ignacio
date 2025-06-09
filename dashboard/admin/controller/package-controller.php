<?php
require_once '../authentication/admin-class.php';


class PackageController
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

    public function addPackage($package_name, $price, $number_of_credits)
    {
        $stmt = $this->admin->runQuery('INSERT INTO package (package, price, number_of_post) VALUES (:package, :price, :number_of_post)');
        $exec = $stmt->execute(array(
            ":package"          => $package_name,
            ":price"            => $price,
            ":number_of_post"   => $number_of_credits,
        ));


        if ($exec) {
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Package added successfully!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
        }
        header('Location: ../package');
        exit(); // Exit after redirect
    }

    public function editPackage($package_id, $package_name, $price, $number_of_credits)
    {
        // Check if the course name and department have actually changed
        $old_data_stmt = $this->admin->runQuery('SELECT package, price, number_of_post FROM package WHERE id=:id');
        $old_data_stmt->execute(array(
            ":id" => $package_id,
        ));
        $old_data = $old_data_stmt->fetch(PDO::FETCH_ASSOC);
        $old_package_name = $old_data['package'];
        $old_package_price= $old_data['price'];
        $old_number_of_post= $old_data['number_of_post'];


        if ($old_package_name == $package_name && $old_package_price == $price && $old_number_of_post == $number_of_credits) {
            // Course name and department have not changed, don't need to update
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'No changes were made.';
            $_SESSION['status_code'] = 'info';
            $_SESSION['status_timer'] = 40000;

            header('Location: ../package');
            exit();
        }

        $stmt = $this->admin->runQuery('UPDATE package SET package=:package, price=:price, number_of_post=:number_of_post  WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"               => $package_id,
            ":package"          => $package_name,
            ":price"            => $price,
            ":number_of_post"   => $number_of_credits,
        ));

        if ($exec) {
            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Package successfully updated!';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../package');
        exit();
    }
}
if (isset($_POST['btn-add-package'])) {
    $package_name                = trim($_POST['package_name']);
    $price                       = trim($_POST['price']);
    $number_of_credits           = trim($_POST['number_of_credits']);


    $add_package = new PackageController();
    $add_package->addPackage($package_name, $price, $number_of_credits);
}

if (isset($_POST['btn-edit-package'])) {
    $package_id                  = $_GET['id'];
    $package_name                = trim($_POST['package_name']);
    $price                       = trim($_POST['price']);
    $number_of_credits           = trim($_POST['number_of_credits']);


    $edit_package = new PackageController();
    $edit_package->editPackage($package_id, $package_name, $price, $number_of_credits);
}
