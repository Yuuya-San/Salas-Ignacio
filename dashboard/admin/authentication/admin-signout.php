<?php
require_once 'admin-class.php';

$superadmin = new ADMIN();

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Logout only if logged in
if ($superadmin->isUserLoggedIn()) {
    $superadmin->logout();
}

// Redirect to admin login page always
$superadmin->redirect('../../../private/admin/');
?>
