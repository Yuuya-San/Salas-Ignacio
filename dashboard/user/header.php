<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/user-class.php';
include_once '../../configuration/settings-configuration.php';

// instances of the classes
$config = new SystemConfig();
$user = new USER();

if (isset($_GET['index'])) {
    if ($_SESSION['user_session'] == NULL) {
        $_SESSION['property_details'] = 1;
        $_SESSION['status_title'] = 'Oops!';
        $_SESSION['status'] = 'Please sign in or create an account! to view property details!';
        $_SESSION['status_code'] = 'error';
        $_SESSION['status_timer'] = 100000;
        header('Location: ../../signin');
        exit();
    }
} else {
    if (!$user->isUserLoggedIn()) {
        header('Location: ../../signin');
        exit();
    }
}



// retrieve user data
$stmt = $user->runQuery("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// retrieve profile user and full name
$user_id                = $user_data['id'];
$user_profile           = $user_data['profile'];
$user_fname             = $user_data['first_name'];
$user_mname             = $user_data['middle_name'];
$user_lname             = $user_data['last_name'];
$user_fullname          = $user_data['last_name'] . ", " . $user_data['first_name'];
$user_sex               = $user_data['sex'];
$user_birth_date        = $user_data['date_of_birth'];
$user_age               = $user_data['age'];
$user_civil_status      = $user_data['civil_status'];
$user_phone_number      = $user_data['phone_number'];
$user_email             = $user_data['email'];
$user_last_update       = $user_data['updated_at'];

