<?php
require_once 'user-class.php';
require_once __DIR__ . '/../../agent/authentication/agent-class.php';

$user = new USER();
$agent = new AGENT();

$site_secret_key = $user->siteSecretKey();

if ($user->isUserLoggedIn() != "" || $agent->isUserLoggedIn() != "") {
    $user->redirect('');
}

if (isset($_POST['btn-signin'])) {
    $response = $_POST['g-token'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$site_secret_key&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row =  json_decode($data, true);

    if ($row['success'] == "true") {
        $email = trim($_POST['email']);
        $upass = trim($_POST['password']);

        $stmt = $user->runQuery('SELECT * FROM users WHERE email = :email');
        $stmt->execute(array(
            ":email" => $email,
        ));

        $rowCount = $stmt->rowCount();

        if ($rowCount == 1) {
            $existingData = $stmt->fetch();

            if ($_SESSION['property_details'] == 1) {

                if ($existingData['user_type'] == 2) {
                    if ($agent->login($email, $upass)) {
                        $_SESSION['status_title'] = "Hey !";
                        $_SESSION['status'] = "Welcome back! ";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_timer'] = 10000;
                        header("Location: ../../agent/property");
                        exit();
                    }
                } elseif ($existingData['user_type'] == 3) {
                    if ($user->login($email, $upass)) {
                        $_SESSION['status_title'] = "Hey !";
                        $_SESSION['status'] = "Welcome back! ";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_timer'] = 10000;
                        unset($_SESSION['property_details']);
                        header("Location: ../property-details");
                        exit();
                    }
                } else {
                    $_SESSION['status_title'] = "Sorry !";
                    $_SESSION['status'] = "No account found";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_timer'] = 10000000;
                    header("Location: ../../../signin");
                    exit();
                }
            } else if ($_SESSION['property_details'] == NULL) {
                if ($existingData['user_type'] == 2) {
                    if ($agent->login($email, $upass)) {
                        $_SESSION['status_title'] = "Hey !";
                        $_SESSION['status'] = "Welcome back! ";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_timer'] = 10000;
                        header("Location: ../../agent/property");
                        exit();
                    }
                } elseif ($existingData['user_type'] == 3) {
                    if ($user->login($email, $upass)) {
                        $_SESSION['status_title'] = "Hey !";
                        $_SESSION['status'] = "Welcome back! ";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_timer'] = 10000;
                        header("Location: ../");
                        exit();
                    }
                } else {
                    $_SESSION['status_titlek'] = "Sorry !";
                    $_SESSION['status'] = "No account found";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_timer'] = 10000000;
                    header("Location: ../../../signin");
                    exit();
                }
            }
        } else {
            $_SESSION['status_title'] = "Sorry !";
            $_SESSION['status'] = "No account found or your account has been removed!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 10000000;
            header("Location: ../../../signin");
            exit();
        }
    } else {
        $_SESSION['status_title'] = "Error!";
        $_SESSION['status'] = "Invalid captcha, please try again!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_timer'] = 40000;
        header("Location: ../../../signin");
        exit;
    }
}
