<?php
include_once '../../../configuration/settings-configuration.php';
include_once __DIR__ . '/../../../database/dbconfig.php';

class ProfileSettings
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // Update user profile
    public function updateProfile($user_id, $first_name, $middle_name, $last_name, $sex, $date_of_birth, $age, $phone_number, $visitation_hours_from, $visitation_hours_to, $selected_days)
    {
        // Retrieve current user profile data
        $stmt = $this->runQuery('SELECT * FROM users WHERE id=:id');
        $stmt->execute(array(":id" => $user_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retrieve current user business Hours
        $stmt2 = $this->runQuery('SELECT * FROM business_hours WHERE user_id=:user_id');
        $stmt2->execute(array(":user_id" => $user_id));
        $business_hours = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($business_hours) {
            // Update existing business hours
            $current_visitation_hours_from = $business_hours['visitation_hours_from'];
            $current_visitation_hours_to = $business_hours['visitation_hours_to'];
            $current_visitation_days = $business_hours['visitation_days'];

            if (
                $current_visitation_hours_from == $visitation_hours_from &&
                $current_visitation_hours_to == $visitation_hours_to &&
                $current_visitation_days == $selected_days
            ) {
                // No changes have been made
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'No changes have been made to your profile.';
                $_SESSION['status_code'] = 'info';
                $_SESSION['status_timer'] = 40000;

                header('Location: ../settings');
                exit;
            } else {
                // Update existing business hours
                $this->updateBusinessHours($user_id, $visitation_hours_from, $visitation_hours_to, $selected_days);
            }
        } else {
            // Insert new business hours
            $this->businessHours($user_id, $visitation_hours_from, $visitation_hours_to, $selected_days);
        }

        // Check if fields are empty and set them to null if they are
        // (omitted for brevity)

        // Update user profile data in the database
        $stmt = $this->runQuery('UPDATE users SET first_name=:first_name, middle_name=:middle_name, last_name=:last_name, sex=:sex, date_of_birth=:date_of_birth, age=:age, phone_number=:phone_number WHERE id=:id');
        $exec = $stmt->execute(array(
            ":id"            => $user_id,
            ":first_name"    => $first_name,
            ":middle_name"   => $middle_name,
            ":last_name"     => $last_name,
            ":sex"           => $sex,
            ":date_of_birth" => $date_of_birth,
            ":age"           => $age,
            ":phone_number"  => $phone_number
        ));

        // Set status message based on success or failure of the database update
        if ($exec) {
            // Update successful
            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Profile successfully updated';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            // Update failed
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        // Redirect to the user's profile page
        header('Location: ../settings');
        exit;
    }

    private function businessHours($user_id, $visitation_hours_from, $visitation_hours_to, $selected_days)
    {
        $stmt = $this->runQuery('INSERT INTO business_hours (user_id, visitation_hours_from, visitation_hours_to, visitation_days) VALUES (:user_id, :visitation_hours_from, :visitation_hours_to, :visitation_days)');
        $stmt->execute(array(
            ":user_id"              => $user_id,
            ":visitation_hours_from" => $visitation_hours_from,
            ":visitation_hours_to"   => $visitation_hours_to,
            ":visitation_days"       => $selected_days,
        ));
    }

    // Function to update existing business hours
    private function updateBusinessHours($user_id, $visitation_hours_from, $visitation_hours_to, $selected_days)
    {
        $stmt = $this->runQuery('UPDATE business_hours SET visitation_hours_from=:visitation_hours_from, visitation_hours_to=:visitation_hours_to, visitation_days=:visitation_days WHERE user_id=:user_id');
        $stmt->execute(array(
            ":user_id"              => $user_id,
            ":visitation_hours_from" => $visitation_hours_from,
            ":visitation_hours_to"   => $visitation_hours_to,
            ":visitation_days"       => $selected_days,
        ));
    }


    //update user avatar
    public function updateAvatar($user_id, $avatar)
    {
        if (!empty($_FILES['avatar']['tmp_name'])) {
            $folder = "../../../src/images/profile/" . basename($avatar);
            chmod($folder, 0755);
            $stmt = $this->runQuery('UPDATE users SET profile=:profile WHERE id=:id');
            $exec = $stmt->execute(array(
                ":id"        => $user_id,
                ":profile"  => $avatar,
            ));

            if ($exec && move_uploaded_file($_FILES['avatar']['tmp_name'], $folder)) {
                $_SESSION['status_title'] = 'Success!';
                $_SESSION['status'] = 'Avatar successfully updated';
                $_SESSION['status_code'] = 'success';
                $_SESSION['status_timer'] = 40000;
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'Something went wrong, please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
            }
        } else {
            // No changes have been made
            $_SESSION['status_title'] = 'Oopss!';
            $_SESSION['status'] = 'No changes have been made to your profile.';
            $_SESSION['status_code'] = 'info';
            $_SESSION['status_timer'] = 40000;
        }

        header('Location: ../settings');
    }
    //update user password
    public function updatePassword($user_id, $old_password, $new_password, $confirm_password)
    {
        $new = md5($new_password);
        $old = md5($old_password);

        // Check if old password is correct
        $stmt = $this->runQuery("SELECT * FROM users WHERE id=:id");
        $stmt->bindParam(":id", $user_id);
        $stmt->execute();
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $current_password = $user_data["password"];

        if ($current_password == $old) {

            // check if new password match with confirm pasword
            if ($new_password == $confirm_password) {
                $stmt = $this->runQuery('UPDATE users SET password=:password WHERE id=:id');
                $exec = $stmt->execute(array(
                    ":id"         => $user_id,
                    ":password"  => $new,
                ));

                if ($exec) {
                    $_SESSION['status_title'] = 'Success!';
                    $_SESSION['status'] = 'Password successfully changed';
                    $_SESSION['status_code'] = 'success';
                    $_SESSION['status_timer'] = 40000;
                } else {
                    $_SESSION['status_title'] = 'Oops!';
                    $_SESSION['status'] = 'Something went wrong, please try again!';
                    $_SESSION['status_code'] = 'error';
                    $_SESSION['status_timer'] = 100000;
                }
                header('Location: ../settings');
            } else {
                $_SESSION['status_title'] = 'Sorry!';
                $_SESSION['status'] = 'New password and Confirm password did not match, Please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 1000000;
                header('Location: ../settings');
            }
        } else {
            $_SESSION['status_title'] = 'Sorry!';
            $_SESSION['status'] = 'Incorrect old password, Please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 1000000;
            header('Location: ../settings');
        }
    }

    //update avatar to default
    public function updateAvatarToDefault($user_id)
    {
        $stmt = $this->runQuery('UPDATE users SET profile=:profile WHERE id=:id');
        $exec = $stmt->execute(array(
            ":profile"  => "profile.png",
            ":id"        => $user_id
        ));

        if ($exec) {
            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Avatar successfully updated to default';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong, please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
        }

        header('Location: ../profile');
    }

    public function updateUserPayment($user_id, $bank, $account_name, $account_number)
    {
        // Check if user payment data exists
        $stmt = $this->runQuery("SELECT * FROM user_payment WHERE user_id=:user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $user_payment_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {

            $stmt1 = $this->runQuery('UPDATE user_payment SET bank=:bank, account_name=:account_name, account_number=:account_number WHERE user_id=:user_id');
            $exec = $stmt1->execute(array(
                ":user_id"         => $user_id,
                ":bank"            => $bank,
                ":account_name"    => $account_name,
                ":account_number"  => $account_number
            ));

            if ($exec) {
                $_SESSION['status_title'] = "Success!";
                $_SESSION['status'] = "Successfully update payment method!";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_timer'] = 40000;
                header('Location: ../settings');
            }
        } else {
            // User payment data doesn't exist, insert a new record
            $stmt2 = $this->runQuery('INSERT INTO user_payment (user_id, bank, account_name, account_number) VALUES (:user_id, :bank, :account_name, :account_number)');
            $exec = $stmt2->execute(array(
                ":user_id"              => $user_id,
                ":bank"            => $bank,
                ":account_name"    => $account_name,
                ":account_number"  => $account_number
            ));

            if ($exec) {
                $_SESSION['status_title'] = "Success!";
                $_SESSION['status'] = "Successfully add payment method!";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_timer'] = 40000;
                header('Location: ../settings');
            }
        }
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}

// Check if the form has been submitted for updating the profile
if (isset($_POST['btn-update-profile'])) {
    $user_id        = $_GET["id"];
    $first_name     = trim($_POST['first_name']);
    $middle_name    = trim($_POST['middle_name']);
    $last_name      = trim($_POST['last_name']);
    $sex            = trim($_POST['sex']);
    $date_of_birth  = trim($_POST['date_of_birth']);
    $age  = trim($_POST['age']);
    $phone_number  = trim($_POST['phone_number']);

    //property Viewing
    $visitation_hours_from = trim($_POST['visitation_hours_from']);
    $visitation_hours_to = trim($_POST['visitation_hours_to']);

    //days
    if (isset($_POST['days']) && is_array($_POST['days'])) {
        $selected_days = implode(', ', $_POST['days']);
        // Now $selected_days contains a serialized string of selected days
    }

    $ProfileSettings = new ProfileSettings();
    $ProfileSettings->updateProfile($user_id, $first_name, $middle_name, $last_name, $sex, $date_of_birth, $age, $phone_number, $visitation_hours_from, $visitation_hours_to, $selected_days);
}

if (isset($_POST['btn-update-avatar'])) {
    $user_id    = $_GET["id"];
    $avatar     = $_FILES['avatar']['name'];

    $ProfileSettings = new ProfileSettings();
    $ProfileSettings->updateAvatar($user_id, $avatar);
}

if (isset($_POST['btn-update-password'])) {
    $user_id            = $_GET["id"];
    $old_password       = trim($_POST['old_password']);
    $new_password       = trim($_POST['new_password']);
    $confirm_password   = trim($_POST['confirm_password']);

    $ProfileSettings = new ProfileSettings();
    $ProfileSettings->updatePassword($user_id, $old_password, $new_password, $confirm_password);
}

if (isset($_GET['delete_avatar'])) {
    $user_id = $_GET["id"];

    $ProfileSettings = new ProfileSettings();
    $ProfileSettings->updateAvatarToDefault($user_id);
}

if (isset($_POST['btn-update-payment'])) {
    $user_id        = $_GET["id"];
    $bank           = trim($_POST['bank']);
    $account_name   = trim($_POST['account_name']);
    $account_number = trim($_POST['account_number']);

    $ProfileSettings = new ProfileSettings();
    $ProfileSettings->updateUserPayment($user_id, $bank, $account_name, $account_number);
}
