<?php
include_once '../../database/dbconfig2.php';
require_once 'authentication/agent-class.php';
include_once '../../configuration/settings-configuration.php';

// instances of the classes
$config = new SystemConfig();
$user = new AGENT();

if(!$user->isUserLoggedIn())
{
 $user->redirect('../../signin');
}

// retrieve user data
$stmt = $user->runQuery("SELECT * FROM users WHERE id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['agent_session']));
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

// retrieve user payment data
$stmt1 = $user->runQuery("SELECT * FROM user_payment WHERE user_id=:id");
$stmt1->execute(array(":id"=>$user_id));

if ($stmt1) {
    // Check if the query was successful
    $user_payment_data = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($user_payment_data) {
        // Continue processing if payment data is found
        $bank = $user_payment_data['bank'];
        $account_name = $user_payment_data['account_name'];
        $account_number = $user_payment_data['account_number'];
    } else {
        // Set default values or handle the case where no payment data is found.
        $bank = $account_name = $account_number = "";
    }
}

// Retrieve user business hours
$stmt2 = $user->runQuery("SELECT * FROM business_hours WHERE user_id=:user_id");
$stmt2->execute(array(":user_id" => $_SESSION['agent_session']));
$business_hours = $stmt2->fetch(PDO::FETCH_ASSOC);

// Check if business hours data is available
if ($business_hours) {
    $visitation_hours_to = $business_hours['visitation_hours_to'];
    $visitation_hours_from = $business_hours['visitation_hours_from'];

    // Convert the string of days IDs into an array
    $selected_days = explode(',', $business_hours['visitation_days']);
} else {
    // Handle case when there's no business hours data
    $visitation_hours_to = null;
    $visitation_hours_from = null;
    $selected_days = []; // Initialize as an empty array
}

    $stmt_all_days = $user->runQuery("SELECT * FROM day");
    $stmt_all_days->execute();
    $all_days = $stmt_all_days->fetchAll(PDO::FETCH_ASSOC);