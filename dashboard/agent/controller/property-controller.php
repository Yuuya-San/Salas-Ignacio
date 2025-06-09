<?php
require_once '../authentication/agent-class.php';


class PropertyController
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

    public function propertyRegistration($user_id, $property_name, $units, $property_price, $property_contact, $bedrooms, $bathrooms, $property_type, $parking, $property_size, $garage_size, $allowed_pets, $property_description, $selected_amenities, $picture1, $picture2, $picture3, $picture4, $picture5, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days, $address, $latitude, $longitude)
    {
        $stmt_users = $this->agent->runQuery('SELECT * FROM users WHERE id=:id');
        $stmt_users->execute(array(":id" => $user_id));
        $user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);

        $user_package_type = $user_data['package_id'];

        $stmt_package = $this->agent->runQuery('SELECT * FROM package WHERE id=:id');
        $stmt_package->execute(array(":id" => $user_package_type));
        $package_data = $stmt_package->fetch(PDO::FETCH_ASSOC);

        $number_of_post = $package_data['number_of_post'];


        $stmt_property_post = $this->agent->runQuery('SELECT * FROM property WHERE user_id=:id');
        $stmt_property_post->execute(array(":id" => $user_id));
        $stmt_property_post->fetch(PDO::FETCH_ASSOC);

        if ($stmt_property_post->rowCount() >= $number_of_post) {
            $_SESSION['status_title'] = "Oops!";
            $_SESSION['status'] = "All Credits have been used, Please choose a package to get more credits, Thank you";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 100000;
            header('Location: ../package');
            exit();
        } else {
            $stmt = $this->agent->runQuery('INSERT INTO property (user_id, property_name, units, property_price, property_contact_details, bedrooms, bathrooms, property_type, parking, property_size, garage_size, allowed_pets, property_description, amenities) VALUES (:user_id, :property_name, :units, :property_price, :property_contact_details, :bedrooms, :bathrooms, :property_type, :parking, :property_size, :garage_size, :allowed_pets, :property_description, :amenities)');
            $exec = $stmt->execute(array(
                ":user_id"                   => $user_id,
                ":units"                     => $units,
                ":property_name"             => $property_name,
                ":property_price"            => $property_price,
                ":property_contact_details"  => $property_contact,
                ":bedrooms"                  => $bedrooms,
                ":bathrooms"                 => $bathrooms,
                ":property_type"             => $property_type,
                ":parking"                   => $parking,
                ":property_size"             => $property_size,
                ":garage_size"               => $garage_size,
                ":allowed_pets"               => $allowed_pets,
                ":property_description"      => $property_description,
                ":amenities"                 => $selected_amenities
            ));

            if ($exec) {
                $propertyId = $this->agent->lasdID();
                $this->propertyGallery($propertyId, $picture1, $picture2, $picture3, $picture4, $picture5);
                $this->propertyViewingTime($propertyId, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days);
                $this->propertyLocation($propertyId, $address, $latitude, $longitude);

                //message to success
                $_SESSION['status_title'] = "Success!";
                $_SESSION['status'] = "Property is now registered";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_timer'] = 40000;
                header('Location: ../property');

                if ($exec) {
                    $propertyId = $this->agent->lasdID();

                    // Call propertyGallery function
                    if ($this->propertyGallery($propertyId, $picture1, $picture2, $picture3, $picture4, $picture5)) {
                        // Call propertyViewingTime function
                        if ($this->propertyViewingTime($propertyId, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days)) {
                            // Call propertyLocation function
                            if ($this->propertyLocation($propertyId, $address, $latitude, $longitude)) {
                                // Call propertyFloorPlan function
                                // Message to success if all functions are successful
                                $_SESSION['status_title'] = "Success!";
                                $_SESSION['status'] = "Property is now registered";
                                $_SESSION['status_code'] = "success";
                                $_SESSION['status_timer'] = 40000;
                                header('Location: ../property');
                            } else {
                                // Message if propertyLocation function fails
                                handleFailure();
                            }
                        } else {
                            // Message if propertyViewingTime function fails
                            handleFailure();
                        }
                    } else {
                        // Message if propertyGallery function fails
                        handleFailure();
                    }
                } else {
                    // Message to failure if property registration fails
                    $_SESSION['status_title'] = 'Oops!';
                    $_SESSION['status'] = 'Property registration failed, please try again!';
                    $_SESSION['status_code'] = 'error';
                    $_SESSION['status_timer'] = 100000;
                    header('Location: ../property_registration');
                }

                function handleFailure()
                {
                    // Handle the failure of a specific function
                    // You can show a message or perform any necessary actions
                    $_SESSION['status_title'] = 'Oops!';
                    $_SESSION['status'] = 'Something went wrong during property registration. Please try again!';
                    $_SESSION['status_code'] = 'error';
                    $_SESSION['status_timer'] = 100000;
                    header('Location: ../property_registration');
                }
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'Property registration failed, please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
                header('Location: ../property_registration');
            }
        }
    }


    private function propertyGallery($propertyId, $picture1, $picture2, $picture3, $picture4, $picture5)
    {
        $upload_picture1 = "../../../src/images/property_gallery/" . basename($picture1);
        $upload_picture2 = "../../../src/images/property_gallery/" . basename($picture2);
        $upload_picture3 = "../../../src/images/property_gallery/" . basename($picture3);
        $upload_picture4 = "../../../src/images/property_gallery/" . basename($picture4);
        $upload_picture5 = "../../../src/images/property_gallery/" . basename($picture5);

        if (
            move_uploaded_file($_FILES['picture1']['tmp_name'], $upload_picture1) &&
            move_uploaded_file($_FILES['picture2']['tmp_name'], $upload_picture2) &&
            move_uploaded_file($_FILES['picture3']['tmp_name'], $upload_picture3) &&
            move_uploaded_file($_FILES['picture4']['tmp_name'], $upload_picture4) &&
            move_uploaded_file($_FILES['picture5']['tmp_name'], $upload_picture5)
        ) {
            $stmt = $this->agent->runQuery('INSERT INTO property_gallery (property_id, picture_1, picture_2, picture_3, picture_4, picture_5) VALUES (:property_id, :picture_1, :picture_2, :picture_3, :picture_4, :picture_5 )');
            $stmt->execute(array(
                ":property_id" => $propertyId,
                ":picture_1"   => $picture1,
                ":picture_2"   => $picture2,
                ":picture_3"   => $picture3,
                ":picture_4"   => $picture4,
                ":picture_5"   => $picture5,
            ));
        }
    }

    private function propertyViewingTime($propertyId, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days)
    {
        $stmt = $this->agent->runQuery('INSERT INTO property_viewing_time (property_id, visiting_rules, visitation_hours_from, visitation_hours_to, visitation_days) VALUES (:property_id, :visiting_rules, :visitation_hours_from, :visitation_hours_to, :visitation_days )');
        $stmt->execute(array(
            ":property_id" => $propertyId,
            ":visiting_rules"   => $visiting_rules,
            ":visitation_hours_from"   => $visitation_hours_from,
            ":visitation_hours_to"   => $visitation_hours_to,
            ":visitation_days"   => $selected_days,
        ));
    }

    private function propertyLocation($propertyId, $address, $latitude, $longitude)
    {
        $stmt = $this->agent->runQuery('INSERT INTO property_location (property_id, address, latitude, longitude) VALUES (:property_id, :address, :latitude, :longitude )');
        $stmt->execute(array(
            ":property_id" => $propertyId,
            ":address"   => $address,
            ":latitude"   => $latitude,
            ":longitude"   => $longitude
        ));
    }

    public function editPropertyDetails($property_id, $status, $property_name, $units, $property_price, $property_contact, $bedrooms, $bathrooms, $property_type, $parking, $property_size, $garage_size, $allowed_pets, $property_description, $selected_amenities, $picture1, $picture2, $picture3, $picture4, $picture5, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days, $address, $latitude, $longitude)
    {
        $stmt = $this->agent->runQuery('SELECT * FROM property WHERE id=:id');
        $stmt->execute(array(":id" => $property_id));
        $property_data = $stmt->fetch(PDO::FETCH_ASSOC);

        $current_property_name = $property_data['property_name'];
        $current_property_status = $property_data['status'];
        $current_property_price = $property_data['property_price'];
        $curent_units = $property_data['units'];
        $current_property_contact = $property_data['property_contact_details'];
        $current_bedrooms = $property_data['bedrooms'];
        $current_bathrooms = $property_data['bathrooms'];
        $current_property_type = $property_data['property_type'];
        $current_parking = $property_data['parking'];
        $current_property_size = $property_data['property_size'];
        $current_garage_size = $property_data['garage_size'];
        $current_allowed_pets = $property_data['allowed_pets'];
        $current_property_description = $property_data['property_description'];
        $current_selected_amenities = $property_data['amenities'];

        $stmt2 = $this->agent->runQuery('SELECT * FROM property_viewing_time WHERE property_id=:id');
        $stmt2->execute(array(":id" => $property_id));
        $property_viewing_time_data = $stmt2->fetch(PDO::FETCH_ASSOC);

        $current_visitation_rules = $property_viewing_time_data['visiting_rules'];
        $current_visitation_hours_from = $property_viewing_time_data['visitation_hours_from'];
        $current_visitation_hours_to = $property_viewing_time_data['visitation_hours_to'];
        $current_visitation_days = $property_viewing_time_data['visitation_days'];



        $stmt3 = $this->agent->runQuery('SELECT * FROM property_location WHERE id=:id');
        $stmt3->execute(array(":id" => $property_id));
        $property_location_data = $stmt3->fetch(PDO::FETCH_ASSOC);

        $current_address = $property_location_data['address'];
        $current_latitude = $property_location_data['latitude'];
        $current_longitude = $property_location_data['longitude'];



        if (
            //property data
            $current_property_name != $property_name ||
            $current_property_status != $status ||
            $curent_units != $units ||
            $current_property_price != $property_price ||
            $current_property_contact != $property_contact ||
            $current_bedrooms != $bedrooms ||
            $current_bathrooms != $bathrooms ||
            $current_property_type != $property_type ||
            $current_parking != $parking ||
            $current_property_size != $property_size ||
            $current_garage_size != $garage_size ||
            $current_allowed_pets != $allowed_pets ||
            $current_property_description != $property_description ||
            $current_selected_amenities != $selected_amenities ||

            //gallery data
            !empty($_FILES['picture1']['tmp_name']) ||
            !empty($_FILES['picture2']['tmp_name']) ||
            !empty($_FILES['picture3']['tmp_name']) ||
            !empty($_FILES['picture4']['tmp_name']) ||
            !empty($_FILES['picture5']['tmp_name']) ||

            //viewing data
            $current_visitation_rules != $visiting_rules ||
            $current_visitation_hours_from != $visitation_hours_from ||
            $current_visitation_hours_to != $visitation_hours_to ||
            $current_visitation_days != $selected_days ||

            //location data
            $current_address != $address ||
            $current_latitude != $latitude ||
            $current_longitude != $longitude

        ) {
            $stmt = $this->agent->runQuery('UPDATE property SET status=:status, property_name=:property_name, units=:units, property_price=:property_price, property_contact_details=:property_contact_details, bedrooms=:bedrooms, bathrooms=:bathrooms, property_type=:property_type, parking=:parking, property_size=:property_size, garage_size=:garage_size, allowed_pets=:allowed_pets, property_description=:property_description, amenities=:amenities WHERE id=:id');
            $exec = $stmt->execute(array(
                ":id"                        => $property_id,
                ":units"                     => $units,
                ":status"                    => $status,
                ":property_name"             => $property_name,
                ":property_price"            => $property_price,
                ":property_contact_details"  => $property_contact,
                ":bedrooms"                  => $bedrooms,
                ":bathrooms"                 => $bathrooms,
                ":property_type"             => $property_type,
                ":parking"                   => $parking,
                ":property_size"             => $property_size,
                ":garage_size"               => $garage_size,
                ":allowed_pets"              => $allowed_pets,
                ":property_description"      => $property_description,
                ":amenities"                 => $selected_amenities
            ));

            if ($exec) {
                $this->updatePropertyGallery($property_id, $picture1, $picture2, $picture3, $picture4, $picture5);
                $this->updatePropertyViewingTime($property_id, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days);
                $this->updatePropertyLocation($property_id, $address, $latitude, $longitude);

                $_SESSION['status_title'] = 'Success!';
                $_SESSION['status'] = 'Property details successfully updated!';
                $_SESSION['status_code'] = 'success';
                $_SESSION['status_timer'] = 40000;
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'Something went wrong, please try again!';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
            }
        } else {
            $_SESSION['status_title'] = 'No Changes';
            $_SESSION['status'] = 'No changes were made.';
            $_SESSION['status_code'] = 'info';
            $_SESSION['status_timer'] = 40000;
        }

        header('Location: ../edit-property-details');
        exit();
    }

    private function updatePropertyGallery($property_id, $picture1, $picture2, $picture3, $picture4, $picture5)
    {
        $upload_picture1 = "../../../src/images/property_gallery/" . basename($picture1);
        $upload_picture2 = "../../../src/images/property_gallery/" . basename($picture2);
        $upload_picture3 = "../../../src/images/property_gallery/" . basename($picture3);
        $upload_picture4 = "../../../src/images/property_gallery/" . basename($picture4);
        $upload_picture5 = "../../../src/images/property_gallery/" . basename($picture5);

        if (move_uploaded_file($_FILES['picture1']['tmp_name'], $upload_picture1)) {
            $stmt = $this->agent->runQuery('UPDATE property_gallery SET picture_1=:picture_1 WHERE property_id=:id');
            $stmt->execute(array(
                ":id" => $property_id,
                ":picture_1"   => $picture1,
            ));
        }

        if (move_uploaded_file($_FILES['picture2']['tmp_name'], $upload_picture2)) {
            $stmt = $this->agent->runQuery('UPDATE property_gallery SET picture_2=:picture_2 WHERE property_id=:id');
            $stmt->execute(array(
                ":id" => $property_id,
                ":picture_2"   => $picture2,
            ));
        }

        if (move_uploaded_file($_FILES['picture3']['tmp_name'], $upload_picture3)) {
            $stmt = $this->agent->runQuery('UPDATE property_gallery SET picture_3=:picture_3 WHERE property_id=:id');
            $stmt->execute(array(
                ":id" => $property_id,
                ":picture_3"   => $picture3,
            ));
        }

        if (move_uploaded_file($_FILES['picture4']['tmp_name'], $upload_picture4)) {
            $stmt = $this->agent->runQuery('UPDATE property_gallery SET picture_4=:picture_4 WHERE property_id=:id');
            $stmt->execute(array(
                ":id" => $property_id,
                ":picture_4"   => $picture4,
            ));
        }

        if (move_uploaded_file($_FILES['picture5']['tmp_name'], $upload_picture5)) {
            $stmt = $this->agent->runQuery('UPDATE property_gallery SET picture_5=:picture_5 WHERE property_id=:id');
            $stmt->execute(array(
                ":id" => $property_id,
                ":picture_5"   => $picture5,
            ));
        }
    }

    private function updatePropertyViewingTime($property_id, $visiting_rules, $visitation_hours_from, $visitation_hours_to, $selected_days)
    {
        $stmt = $this->agent->runQuery('UPDATE property_viewing_time SET visiting_rules=:visiting_rules, visitation_hours_from=:visitation_hours_from, visitation_hours_to=:visitation_hours_to, visitation_days=:visitation_days WHERE property_id=:id');
        $stmt->execute(array(
            ":id" => $property_id,
            ":visiting_rules"   => $visiting_rules,
            ":visitation_hours_from"   => $visitation_hours_from,
            ":visitation_hours_to"   => $visitation_hours_to,
            ":visitation_days"   => $selected_days,
        ));
    }

    private function updatePropertyLocation($property_id, $address, $latitude, $longitude)
    {
        $stmt = $this->agent->runQuery('UPDATE property_location SET address=:address, latitude=:latitude, longitude=:longitude WHERE property_id=:id');
        $stmt->execute(array(
            ":id" => $property_id,
            ":address"   => $address,
            ":latitude"   => $latitude,
            ":longitude"   => $longitude
        ));
    }

    public function confirmAgentPaymentMethod($property_reservation_id)
    {

        $stmt_property = $this->agent->runQuery('SELECT * FROM property_reservation WHERE id=:id');
        $stmt_property->execute(array(":id" => $property_reservation_id));
        $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);
        $agent_id = $property_data['agent_id'];

        $stmt_agent_payment = $this->agent->runQuery('SELECT * FROM user_payment WHERE user_id=:user_id');
        $stmt_agent_payment->execute(array(":user_id" => $agent_id));

        if ($stmt_agent_payment->rowCount() >= 1) {
            $agent_paymen_details = $stmt_agent_payment->fetch(PDO::FETCH_ASSOC);
            $bank = $agent_paymen_details['bank'];
            $account_name = $agent_paymen_details['account_name'];
            $account_number = $agent_paymen_details['account_number'];

            if ($this->sendEmail($property_reservation_id, $bank, $account_name, $account_number)) {
            } else {
                $_SESSION['status_title'] = 'Oops!';
                $_SESSION['status'] = 'No payment details found.';
                $_SESSION['status_code'] = 'error';
                $_SESSION['status_timer'] = 100000;
                header('Location: ../property-reservation?status=?');
                exit();  // Make sure to exit after a header redirect  
            }
        } else {
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Please add payment details.';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
            header('Location: ../settings');
            exit();  // Make sure to exit after a header redirect
        }
    }

    private function sendEmail($property_reservation_id, $bank, $account_name, $account_number)
    {

        $stmt_property_reservation = $this->agent->runQuery('SELECT * FROM property_reservation WHERE id=:id');
        $stmt_property_reservation->execute(array(":id" => $property_reservation_id));
        $property_reservation_data = $stmt_property_reservation->fetch(PDO::FETCH_ASSOC);
        $user_id = $property_reservation_data['user_id'];
        $booking_start_date = $property_reservation_data['booking_start_date'];
        $booking_end_date = $property_reservation_data['booking_end_date'];
        $property_id = $property_reservation_data['property_id'];

        $stmt_property = $this->agent->runQuery('SELECT * FROM property WHERE id=:id');
        $stmt_property->execute(array(":id" => $property_id));
        $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);
        $property_name = $property_data['property_name'];

        $stmt_users = $this->agent->runQuery('SELECT * FROM users WHERE id=:id');
        $stmt_users->execute(array(":id" => $user_id));
        $user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);
        $user_email = $user_data['email'];

        $stmt = $this->agent->runQuery('UPDATE property_reservation SET status=:status WHERE id=:id');
        $update_property_reservation = $stmt->execute(array(
            ":id" => $property_reservation_id,
            ":status"   => "send_email"

        ));

        if ($update_property_reservation) {
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
                <p>Thank you for using $this->system_name. This email is to confirm the reservation for $property_name property. The agent has acknowledged your reservation, and we kindly request the settlement of the 500 PHP payment. Currently, your reservation status is pending payment. Details of your reservation and payment are provided below. Thank you!</p>
                <p>If you have any questions or concerns, please contact our support team.</p><br />
                
                RESERVATION DETAILS:<br />
                Property Name: $property_name <br />
                Booking Start Date: $booking_start_date <br />
                Booking End Date: $booking_end_date <br /><br /><br />

                PAYMENT DETAILS:<br />
                Bank : $bank <br />
                Account Name : $account_name <br />
                Account Number : $account_number <br /><br />

                <p>If you did reserve any property, you can safely ignore this email.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
    ";
            $subject = "Reservation Acknowledgement and Payment";

            $this->agent->send_mail($user_email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
            $this->updateNoSelectedReservation($property_id);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Successfully Send Email";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../property-reservation?status=waiting');
            exit();
        } else {
            // Handle file upload error here
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong during sending email. Please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
            header('Location: ../property-reservation?status=?');
        }
    }

    private function updateNoSelectedReservation($property_id)
    {
        // Update the status of other reservations with the same property_id to "waiting"
        $stmt_waiting = $this->agent->runQuery('UPDATE property_reservation SET status=:status WHERE property_id=:property_id AND status=:pending');
        $update_waiting = $stmt_waiting->execute(array(
            ":property_id" => $property_id,
            ":pending" => "pending",
            ":status" => "waiting"
        ));
    }

    public function confirmPayment($property_reservation_id)
    {
        $stmt_property_reservation = $this->agent->runQuery('SELECT * FROM property_reservation WHERE id=:id');
        $stmt_property_reservation->execute(array(":id" => $property_reservation_id));
        $property_data = $stmt_property_reservation->fetch(PDO::FETCH_ASSOC);
        $property_id = $property_data['property_id'];

        $stmt_property = $this->agent->runQuery('SELECT * FROM property WHERE id=:id');
        $stmt_property->execute(array(":id" => $property_id));
        $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);

        if ($property_data['property_type'] == 1 || $property_data['property_type'] == 5) {
            $number_of_units = $property_data['units'];
        
            $stmt_number_of_property = $this->agent->runQuery('SELECT * FROM property_reservation WHERE property_id=:property_id AND status=:status');
            $stmt_number_of_property->execute(array(":property_id" => $property_id, ":status" => "accept"));
        
            if ($stmt_number_of_property->rowCount() >= $number_of_units) {
                $stmt_update_status_of_property = $this->agent->runQuery('UPDATE property SET status=:status WHERE id=:id');
                $stmt_update_status_of_property->execute(array(
                    ":id" => $property_id,
                    ":status" => "not_available",
                ));
        
                if ($stmt_update_status_of_property->rowCount() > 0) {
                    $this->acceptPayment($property_reservation_id);
                }
            } else {
                $this->acceptPayment($property_reservation_id);
            }
        } else {
            $stmt_update_status_of_property = $this->agent->runQuery('UPDATE property SET status=:status WHERE id=:id');
            $stmt_update_status_of_property->execute(array(
                ":id" => $property_id,
                ":status" => "not_available",
            ));
        
            if ($stmt_update_status_of_property->rowCount() > 0) {
                $this->acceptPayment($property_reservation_id);
            }
        }
        
    }

    private function acceptPayment($property_reservation_id)
    {
        $stmt_property_reservation = $this->agent->runQuery('SELECT * FROM property_reservation WHERE id=:id');
        $stmt_property_reservation->execute(array(":id" => $property_reservation_id));
        $property_reservation_data = $stmt_property_reservation->fetch(PDO::FETCH_ASSOC);
        $user_id = $property_reservation_data['user_id'];
        $booking_start_date = $property_reservation_data['booking_start_date'];
        $booking_end_date = $property_reservation_data['booking_end_date'];
        $property_id = $property_reservation_data['property_id'];

        $stmt_property = $this->agent->runQuery('SELECT * FROM property WHERE id=:id');
        $stmt_property->execute(array(":id" => $property_id));
        $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);
        $property_name = $property_data['property_name'];

        $stmt_users = $this->agent->runQuery('SELECT * FROM users WHERE id=:id');
        $stmt_users->execute(array(":id" => $user_id));
        $user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);
        $user_email = $user_data['email'];

        $stmt = $this->agent->runQuery('UPDATE property_reservation SET status=:status, accept_date = NOW() WHERE id=:id');
        $update_property_reservation = $stmt->execute(array(
            ":id" => $property_reservation_id,
            ":status" => "accept"
        ));
        
        if ($update_property_reservation) {
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
                <h1>Property Reservation Payment</h1>
                <p>Hello, <strong>$user_email</strong></p>
                <p>Payment Confirmation</p>
                <p>Thank you for using $this->system_name. This email is to confirm the reservation for $property_name property. The agent has receive your payment for your reservation. Thank you!</p>
                <p>If you have any questions or concerns, please contact our support team.</p><br />
                
                RESERVATION DETAILS:<br />
                Property Name: $property_name <br />
                Booking Start Date: $booking_start_date <br />
                Booking End Date: $booking_end_date <br /><br /><br />

                <p>If you did reserve any property, you can safely ignore this email.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
    ";
            $subject = "Payment Confirmation";

            $this->agent->send_mail($user_email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
            $this->declineNoSelectedReservation($property_id);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Successfully accept payment";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../property-reservation?status=accept');
            exit();
        } else {
            // Handle file upload error here
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong during sending email. Please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
            header('Location: ../property-reservation?status=?');
        }
    }

    private function declineNoSelectedReservation($property_id)
    {
        // Update the status of other reservations with the same property_id to "waiting"
        $stmt_decline = $this->agent->runQuery('UPDATE property_reservation SET status=:status WHERE property_id=:property_id AND status=:waiting');
        $update_waiting = $stmt_decline->execute(array(
            ":property_id" => $property_id,
            ":waiting" => "waiting",
            ":status" => "decline"
        ));  
    }

    public function deleteRequest($property_reservation_id)
    {

        $stmt_property_reservation = $this->agent->runQuery('SELECT * FROM property_reservation WHERE id=:id');
        $stmt_property_reservation->execute(array(":id" => $property_reservation_id));
        $property_reservation_data = $stmt_property_reservation->fetch(PDO::FETCH_ASSOC);
        $user_id = $property_reservation_data['user_id'];
        $booking_start_date = $property_reservation_data['booking_start_date'];
        $booking_end_date = $property_reservation_data['booking_end_date'];
        $property_id = $property_reservation_data['property_id'];

        $stmt_property = $this->agent->runQuery('SELECT * FROM property WHERE id=:id');
        $stmt_property->execute(array(":id" => $property_id));
        $property_data = $stmt_property->fetch(PDO::FETCH_ASSOC);
        $property_name = $property_data['property_name'];

        $stmt_users = $this->agent->runQuery('SELECT * FROM users WHERE id=:id');
        $stmt_users->execute(array(":id" => $user_id));
        $user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);
        $user_email = $user_data['email'];

        $stmt = $this->agent->runQuery('UPDATE property_reservation SET status=:status WHERE id=:id');
        $update_property_reservation = $stmt->execute(array(
            ":id" => $property_reservation_id,
            ":status"   => "decline"

        ));

        if ($update_property_reservation) {
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
                <h1>Property Reservation Payment</h1>
                <p>Hello, <strong>$user_email</strong></p>
                <p>Payment Decline</p>
                <p>Thank you for using $this->system_name. This email is to notify you that your payment fot the $property_name property. The agent has not receive any payment for your reservation. Thank you!</p>
                <p>If you have any questions or concerns, please contact our support team.</p><br />
                
                RESERVATION DETAILS:<br />
                Property Name: $property_name <br />
                Booking Start Date: $booking_start_date <br />
                Booking End Date: $booking_end_date <br /><br /><br />

                <p>If you did reserve any property, you can safely ignore this email.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>
    ";
            $subject = "Decline Reservation";

            $this->agent->send_mail($user_email, $message, $subject, $this->smtp_email, $this->smtp_password, $this->system_name);
            $this->backToPending($property_id);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Successfully Send Email";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../property-reservation?status=waiting');
            exit();
        } else {
            // Handle file upload error here
            $_SESSION['status_title'] = 'Oops!';
            $_SESSION['status'] = 'Something went wrong during sending email. Please try again!';
            $_SESSION['status_code'] = 'error';
            $_SESSION['status_timer'] = 100000;
            header('Location: ../property-reservation?status=?');
        }
    }

    private function backToPending($property_id)
    {
        // Update the status of other reservations with the same property_id to "waiting"
        $stmt_waiting = $this->agent->runQuery('UPDATE property_reservation SET status=:status WHERE property_id=:property_id AND status=:waiting');
        $update_waiting = $stmt_waiting->execute(array(
            ":property_id" => $property_id,
            ":waiting" => "waiting",
            ":status" => "pending"
        ));
    }
}

if (isset($_POST['btn-register-property'])) {
    $user_id        = $_GET["id"];
    //property details
    $property_name = trim($_POST['property_name']);
    $units = trim($_POST['units']);
    $property_price = trim($_POST['property_price']);
    $property_contact = trim($_POST['property_contact']);
    $bedrooms = trim($_POST['bedrooms']);
    $bathrooms = trim($_POST['bathrooms']);
    $property_type = trim($_POST['property_type']);
    $parking = trim($_POST['parking']);
    $property_size = trim($_POST['property_size']);
    $garage_size = trim($_POST['garage_size']);
    $allowed_pets = trim($_POST['allowed_pets']);
    $property_description = trim($_POST['property_description']);

    //amenities
    if (isset($_POST['amenities']) && is_array($_POST['amenities'])) {
        $selected_amenities = implode(', ', $_POST['amenities']);
        // Now $selected_amenities contains a comma-separated string of selected amenities
    }

    //property gallery
    $picture1           = $_FILES['picture1']['name'];
    $picture2           = $_FILES['picture2']['name'];
    $picture3           = $_FILES['picture3']['name'];
    $picture4           = $_FILES['picture4']['name'];
    $picture5           = $_FILES['picture5']['name'];

    //property Viewing
    $visiting_rules = trim($_POST['visiting_rules']);
    $visitation_hours_from = trim($_POST['visitation_hours_from']);
    $visitation_hours_to = trim($_POST['visitation_hours_to']);

    //days
    if (isset($_POST['days']) && is_array($_POST['days'])) {
        $selected_days = implode(', ', $_POST['days']);
        // Now $selected_days contains a serialized string of selected days
    }

    //property Location
    $address = trim($_POST['address']);
    $latitude = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);

    $property_registration = new PropertyController();
    $property_registration->propertyRegistration(
        $user_id,
        $property_name,
        $units,
        $property_price,
        $property_contact,
        $bedrooms,
        $bathrooms,
        $property_type,
        $parking,
        $property_size,
        $garage_size,
        $allowed_pets,
        $property_description,
        $selected_amenities,
        $picture1,
        $picture2,
        $picture3,
        $picture4,
        $picture5,
        $visiting_rules,
        $visitation_hours_from,
        $visitation_hours_to,
        $selected_days,
        $address,
        $latitude,
        $longitude
    );
}


if (isset($_POST['btn-edit-property'])) {
    if (isset($_POST['units'])) {
        $units = trim($_POST['units']);
        // Process the $units value as needed
    } else {
        // The 'units' field is not set in the form
        // Handle this situation accordingly, e.g., set a default value or show an error message
    }

    $property_id        = $_GET["property_id"];
    //property details
    $status = trim($_POST['status']);
    $property_name = trim($_POST['property_name']);
    $property_price = trim($_POST['property_price']);
    $property_contact = trim($_POST['property_contact']);
    $bedrooms = trim($_POST['bedrooms']);
    $bathrooms = trim($_POST['bathrooms']);
    $property_type = trim($_POST['property_type']);
    $parking = trim($_POST['parking']);
    $property_size = trim($_POST['property_size']);
    $garage_size = trim($_POST['garage_size']);
    $allowed_pets = trim($_POST['allowed_pets']);
    $property_description = trim($_POST['property_description']);

    //amenities
    if (isset($_POST['amenities']) && is_array($_POST['amenities'])) {
        $selected_amenities = implode(', ', $_POST['amenities']);
        // Now $selected_amenities contains a comma-separated string of selected amenities
    }

    //property gallery
    $picture1           = $_FILES['picture1']['name'];
    $picture2           = $_FILES['picture2']['name'];
    $picture3           = $_FILES['picture3']['name'];
    $picture4           = $_FILES['picture4']['name'];
    $picture5           = $_FILES['picture5']['name'];

    //property Viewing
    $visiting_rules = trim($_POST['visiting_rules']);
    $visitation_hours_from = trim($_POST['visitation_hours_from']);
    $visitation_hours_to = trim($_POST['visitation_hours_to']);

    //days
    if (isset($_POST['days']) && is_array($_POST['days'])) {
        $selected_days = implode(', ', $_POST['days']);
        // Now $selected_days contains a serialized string of selected days
    }

    //property Location
    $address = trim($_POST['address']);
    $latitude = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);


    $edit_property_details = new PropertyController();
    $edit_property_details->editPropertyDetails(
        $property_id,
        $status,
        $property_name,
        $units,
        $property_price,
        $property_contact,
        $bedrooms,
        $bathrooms,
        $property_type,
        $parking,
        $property_size,
        $garage_size,
        $allowed_pets,
        $property_description,
        $selected_amenities,
        $picture1,
        $picture2,
        $picture3,
        $picture4,
        $picture5,
        $visiting_rules,
        $visitation_hours_from,
        $visitation_hours_to,
        $selected_days,
        $address,
        $latitude,
        $longitude
    );
}

if (isset($_GET['send_email'])) {
    $property_reservation_id = $_GET['property_reservation_id'];

    $send_email = new PropertyController();
    $send_email->confirmAgentPaymentMethod($property_reservation_id);
}

if (isset($_GET['confirm_payment'])) {
    $property_reservation_id = $_GET['property_reservation_id'];

    $confirm_payment = new PropertyController();
    $confirm_payment->confirmPayment($property_reservation_id);
}

if (isset($_GET['delete_request'])) {
    $property_reservation_id = $_GET['property_reservation_id'];

    $delete_request = new PropertyController();
    $delete_request->deleteRequest($property_reservation_id);
}
