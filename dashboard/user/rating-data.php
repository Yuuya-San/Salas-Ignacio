<?php

//submit_rating.php

include '../../database/dbconfig2.php';
date_default_timezone_set('Asia/Manila');
session_start();



if (isset($_POST["rating_data"])) {
    // Check if the user has already rated the property
    $existingRatingQuery = "SELECT * FROM property_rating WHERE user_id = :user_id AND property_id = :property_id";
    $existingRatingStatement = $pdoConnect->prepare($existingRatingQuery);
    $existingRatingStatement->bindParam(':user_id', $_POST["user_id"]);
    $existingRatingStatement->bindParam(':property_id', $_POST["property_id"]);
    $existingRatingStatement->execute();

    if ($existingRatingStatement->rowCount() > 0) {
        // Update failed
        $_SESSION['status_title'] = 'Oops!';
        $_SESSION['status'] = 'You already rate this property';
        $_SESSION['status_code'] = 'error';
        $_SESSION['status_timer'] = 100000;
    } else {
        // User has not rated this property, proceed with inserting the new rating
        $data = array(
            ':user_id'      =>  $_POST["user_id"],
            ':property_id'  =>  $_POST["property_id"],
            ':user_rating'  =>  $_POST["rating_data"],
            ':user_review'  =>  $_POST["user_review"],
            ':datetime'     =>  time()
        );

        $insertRatingQuery = "
        INSERT INTO property_rating 
        (user_id, property_id, rating, review, datetime) 
        VALUES (:user_id, :property_id, :user_rating, :user_review, :datetime)
        ";

        $insertRatingStatement = $pdoConnect->prepare($insertRatingQuery);
        $insertRatingStatement->execute($data);

        if ($insertRatingStatement) {
            $_SESSION['status_title'] = 'Success!';
            $_SESSION['status'] = 'Succesfully rate this property';
            $_SESSION['status_code'] = 'success';
            $_SESSION['status_timer'] = 40000;
        }
    }
}


if (isset($_POST["action"])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "SELECT * FROM property_rating WHERE property_id = :property_id ORDER BY id DESC";

    $statement = $pdoConnect->prepare($query);
    $statement->execute(array(":property_id" => $_POST["property_id"]));

    foreach ($statement as $row) {
        $query = "SELECT * FROM users WHERE id = :user_id";
        $user_statement = $pdoConnect->prepare($query);
        $user_data = $user_statement->execute(array(":user_id" => $row["user_id"]));
        $user_data = $user_statement->fetch(PDO::FETCH_ASSOC); // Fetch the data

        $char_user_fullname = $user_data['last_name'] . ", " . $user_data['first_name'];

        if($row["user_id"] !=  $_POST["user_id"]){
            $user_fullname = $user_data['last_name'] . ", " . $user_data['first_name'];
        }
        else{
            $user_fullname = "You";
        }

        $review_content[] = array(
            'char_user_name' => $char_user_fullname,
            'user_name'     => $user_fullname,
            'user_review'   => $row["review"],
            'rating'        => $row["rating"],
            'datetime'      => date('l jS, F Y h:i:s A', $row["datetime"])
        );

        if ($row["rating"] == '5') {
            $five_star_review++;
        } elseif ($row["rating"] == '4') {
            $four_star_review++;
        } elseif ($row["rating"] == '3') {
            $three_star_review++;
        } elseif ($row["rating"] == '2') {
            $two_star_review++;
        } elseif ($row["rating"] == '1') {
            $one_star_review++;
        }

        $total_review++;
        $total_user_rating = $total_user_rating + $row["rating"];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    => number_format($average_rating, 1),
        'total_review'      => $total_review,
        'five_star_review'  => $five_star_review,
        'four_star_review'  => $four_star_review,
        'three_star_review' => $three_star_review,
        'two_star_review'   => $two_star_review,
        'one_star_review'   => $one_star_review,
        'review_data'       => $review_content
    );

    echo json_encode($output);
}
