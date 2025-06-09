<?php
include_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the POST request
    $propertyId = isset($_POST['property_id']) ? $_POST['property_id'] : '';

    // Store the values in session variables
    $_SESSION['property_id'] = $propertyId;
}

// Retrieve the values from session variables
$propertyId = isset($_SESSION['property_id']) ? $_SESSION['property_id'] : '';

//property data
$stmt = $user->runQuery("SELECT * FROM property WHERE id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_data = $stmt->fetch(PDO::FETCH_ASSOC);

if($property_data['status'] == "not_available" || $property_data['status'] == "disabled"){
    header('Location: property');

}

$contact_number =  $property_data['property_contact_details'];

//user data
$stmt = $user->runQuery("SELECT * FROM users WHERE id=:id");
$stmt->execute(array(":id" => $property_data['user_id']));
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
$agent_user_fullname          = $user_data['last_name'] . ", " . $user_data['first_name'];
$agent_user_profile           = $user_data['profile'];

//property gallery data
$stmt = $user->runQuery("SELECT * FROM property_gallery WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_gallery_data = $stmt->fetch(PDO::FETCH_ASSOC);

//property location
$stmt = $user->runQuery("SELECT * FROM property_location WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_location_data = $stmt->fetch(PDO::FETCH_ASSOC);

//property floor plan
$stmt = $user->runQuery("SELECT * FROM property_floor_plan WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_floor_plan_data = $stmt->fetch(PDO::FETCH_ASSOC);

//property floor plan
$stmt = $user->runQuery("SELECT * FROM property_viewing_time WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_viewing_time_data = $stmt->fetch(PDO::FETCH_ASSOC);


// retrieve user business hours
$stmt2 = $user->runQuery("SELECT * FROM business_hours WHERE user_id=:user_id");
$stmt2->execute(array(":user_id"=> $property_data['user_id']));
$business_hours = $stmt2->fetch(PDO::FETCH_ASSOC);

$visitation_hours_to =  $business_hours['visitation_hours_to'];
$visitation_hours_from =  $business_hours['visitation_hours_from'];

// Convert the string of days IDs into an array
$selected_days = explode(',', $business_hours['visitation_days']);

// Fetch days data
$stmt_all_days = $user->runQuery("SELECT * FROM day");
$stmt_all_days->execute();
$all_days = $stmt_all_days->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Property Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<!-- page wrapper -->
<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
</style>
<!-- page wrapper -->

<body>
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="M" class="letters-loading">
                                M
                            </span>
                            <span data-text-preloader="A" class="letters-loading">
                                A
                            </span>
                            <span data-text-preloader="G" class="letters-loading">
                                G
                            </span>
                            <span data-text-preloader="R" class="letters-loading">
                                R
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                            <span data-text-preloader="N" class="letters-loading">
                                N
                            </span>
                            <span data-text-preloader="T" class="letters-loading">
                                T
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- preloader end -->
        <!-- main header -->
        <header class="main-header">
            <!-- header-top -->
            <div class="header-top">
                <div class="top-inner clearfix">
                    <div class="left-column pull-left">
                        <ul class="info clearfix">
                            <li><i class="far fa-phone"></i><a href="tel:2512353256"><?php echo $config->getSystemNumber() ?></a></li>
                        </ul>
                    </div>
                    <div class="right-column pull-right">
                        <ul class="social-links clearfix">
                            <li><a href="profile"><i class="fas fa-user"></i>&nbsp;&nbsp;<?php echo $user_email ?></a></li>
                        </ul>
                        <div class="sign-box">
                            <a href="authentication/user-signout" class="btn-signout"><i class="fa fa-sign-out"></i>Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="./"><img src="../../src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class=""><a href="./"><span>Home</span></a></li>
                                        <li class="current"><a href="find-home"><span>Find A Home</span></a></li>
                                        <li class=""><a href="about-us"><span>About Us</span></a></li>
                                        <li class=""><a href="contact-us"><span>Contact Us</span></a></li>
                                        <li class=""><a href="settings"><span>Settings</span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="./"><img src="../../src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href=""><img src="../../src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li><a href=""><?php echo $config->getSystemName() ?></a></li>
                        <li><a href="">/<?php echo $config->getSystemEmail() ?></a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href=""><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href=""><span class="fab fa-instagram"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End Mobile Menu -->

        <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(../../src/images/shape/shape-9.png);"></div>
                <div class="pattern-2" style="background-image: url(../../src/images/shape/shape-10.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Property Details</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="./">Home</a></li>
                        <li>Property Details</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-details -->
        <section class="property-details property-details-one">
            <div class="auto-container">
                <div class="top-details clearfix">
                    <div class="left-column pull-left clearfix">
                        <h3><?php echo $property_data['property_name'] ?></h3>
                        <?php
                            if ($property_data['units'] == !null) {
                                $stmt_property_reservation = $user->runQuery('SELECT COUNT(*) as available_units FROM property_reservation WHERE property_id=:property_id AND status=:status');
                                $stmt_property_reservation->execute(array(":property_id" => $propertyId, ":status" => "accept"));
                                $property_reservation_data = $stmt_property_reservation->fetch(PDO::FETCH_ASSOC);

                                $available_units = $property_data['units'] - $property_reservation_data['available_units'];

                            ?>
                                <div class="author-info clearfix">
                                    <div class="author-box pull-left">
                                        <h6>Available Unit's</h6>
                                    </div>
                                    <ul class="rating clearfix pull-left">
                                        <li><?php echo $available_units ?></li>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?>
                    </div>
                    <div class="right-column pull-right clearfix">
                        <div class="price-inner clearfix">
                            <div class="price-box pull-right">
                                <h3>₱ <?php echo number_format($property_data['property_price']); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-5 mb-5">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <h1 class="text-warning mt-4 mb-4">
                                        <b><span id="average_rating">0.0</span> / 5</b>
                                    </h1>
                                    <div class="mb-3">
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    </div>
                                    <h3><span id="total_review">0</span> Review</h3>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                    </div>
                                    </p>
                                    <p>
                                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                    </div>
                                    </p>
                                    <p>
                                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                    </div>
                                    </p>
                                    <p>
                                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                    </div>
                                    </p>
                                    <p>
                                    <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                    </div>
                                    </p>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <h3 class="mt-4 mb-3">Write Review Here</h3>
                                    <button type="submit" class="theme-btn btn-one" name="add_review" id="add_review">Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-details-content">
                            <div class="carousel-inner">
                                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                    <figure class="image-box"><img src="../../src/images/property_gallery/<?php echo $property_gallery_data['picture_1'] ?>" alt=""></figure>
                                    <figure class="image-box"><img src="../../src/images/property_gallery/<?php echo $property_gallery_data['picture_2'] ?>" alt=""></figure>
                                    <figure class="image-box"><img src="../../src/images/property_gallery/<?php echo $property_gallery_data['picture_3'] ?>" alt=""></figure>
                                    <figure class="image-box"><img src="../../src/images/property_gallery/<?php echo $property_gallery_data['picture_4'] ?>" alt=""></figure>
                                    <figure class="image-box"><img src="../../src/images/property_gallery/<?php echo $property_gallery_data['picture_5'] ?>" alt=""></figure>

                                </div>
                            </div>
                            <div class="discription-box content-widget">
                                <div class="title-box">
                                    <h4>Property Description</h4>
                                    <ul class="other-option pull-right clearfix">
                                </div>
                                <div class="text">
                                    <p><?php echo $property_data['property_description'] ?></p>
                                </div>
                            </div>
                            <div class="details-box content-widget">
                                <div class="title-box">
                                    <h4>Property Details</h4>
                                </div>
                                <ul class="list clearfix">
                                    <li>Property Type:<span>
                                            <?php
                                            if ($property_data['property_type'] == 1) {
                                                echo "Apartment";
                                            } elseif ($property_data['property_type'] == 2) {
                                                echo "House";
                                            } elseif ($property_data['property_type'] == 3) {
                                                echo "Lady's Bed Space";
                                            } elseif ($property_data['property_type'] == 4) {
                                                echo "Men's Bed Space";
                                            } elseif ($property_data['property_type'] == 5) {
                                                echo "Dormitory";
                                            } elseif ($property_data['property_type'] == 5) {
                                                echo "Transient";
                                            } else {
                                                echo "";
                                            }

                                            ?>
                                        </span>
                                    </li>
                                    <?php
                                    if ($property_data['units'] == !null) {
                                    ?>
                                        <li>Number of Unit's <span><?php echo $property_data['units'] ?></span></li>
                                    <?php
                                    }
                                    ?>
                                    <li>Bedrooms: <span><?php echo $property_data['bedrooms'] ?></span></li>
                                    <li>Bathrooms: <span><?php echo $property_data['bathrooms'] ?></span></li>
                                    <li>Parking: <span><?php echo $property_data['parking'] ?></span></li>
                                    <li>Garage Size: <span><?php echo $property_data['garage_size'] ?> Sq Ft</span></li>
                                    <li>Property Size: <span><?php echo $property_data['property_size'] ?> Sq Ft</span></li>
                                    <li> Pets:
                                        <span>
                                            <?php
                                            if ($property_data['allowed_pets'] == 'YES') {
                                                echo 'Pets are allowed';
                                            } else if ($property_data['allowed_pets'] == 'NO') {
                                                echo 'Pets are not allowed';
                                            }
                                            ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="amenities-box content-widget">
                                <div class="title-box">
                                    <h4>Inclusives</h4>
                                </div>
                                <ul class="list clearfix">
                                    <?php
                                    $stmt1 = $user->runQuery("SELECT * FROM property WHERE id=:id");
                                    $stmt1->execute(array(":id" => $property_data['id']));

                                    if ($stmt1->rowCount() >= 1) {
                                        while ($property_data = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                            // Explode the values from the amenities column
                                            $amenitiesArray = explode(',', $property_data['amenities']);

                                            // Iterate through the exploded values
                                            foreach ($amenitiesArray as $amenity) {
                                                // Use each amenity value as needed
                                                // echo "Amenity: " . trim($amenity) . "<br>";
                                                $stmt2 = $user->runQuery("SELECT * FROM amenities WHERE id=:id");
                                                $stmt2->execute(array(":id" => trim($amenity)));
                                                $amenities_data = $stmt2->fetch(PDO::FETCH_ASSOC);

                                    ?>
                                                <li><?php echo $amenities_data['amenities'] ?></li>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="location-box content-widget">
                                <div class="title-box">
                                    <h4>Location</h4>
                                </div>
                                <div class="google-map-area">
                                    <div id="map-canvas"></div>

                                </div>
                            </div>
                            <div class="schedule-box content-widget">
                                <div class="title-box">
                                    <h4>Property Viewing Schedule</h4>
                                </div>
                                <div class="form-inner">
                                    <h6>Visiting Rules:</h6>
                                    <p><?php echo $property_viewing_time_data['visiting_rules'] ?></p><br>
                                    <h6>Visitation Time From:</h6>
                                    <p><?php echo date("h:i A", strtotime($property_viewing_time_data['visitation_hours_from'])); ?></p><br>
                                    <h6>Visitation Time To:</h6>
                                    <p><?php echo date("h:i A", strtotime($property_viewing_time_data['visitation_hours_to'])); ?></p><br>
                                </div>
                                <div class="amenities-box">
                                    <ul class="list clearfix">
                                        <?php
                                        $stmt3 = $user->runQuery("SELECT * FROM property_viewing_time WHERE property_id=:id");
                                        $stmt3->execute(array(":id" => $propertyId));

                                        if ($stmt3->rowCount() >= 1) {
                                            while ($property_viewing_time_data = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                                // Explode the values from the amenities column
                                                $visitationDaysArray = explode(',', $property_viewing_time_data['visitation_days']);

                                                // Iterate through the exploded values
                                                foreach ($visitationDaysArray as $days) {
                                                    // Use each amenity value as needed
                                                    // echo "Amenity: " . trim($amenity) . "<br>";
                                                    $stmt5 = $user->runQuery("SELECT * FROM day WHERE id=:id");
                                                    $stmt5->execute(array(":id" => trim($days)));
                                                    $days_data = $stmt5->fetch(PDO::FETCH_ASSOC);

                                        ?>
                                                    <li><?php echo $days_data['day'] ?></li>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="property-sidebar default-sidebar">
                            <div class="author-widget sidebar-widget">
                                <div class="author-box">
                                    <figure class="author-thumb"><img src="../../src/images/profile/<?php echo $agent_user_profile ?>" alt=""></figure>
                                    <div class="inner">
                                        <h4><?php echo $agent_user_fullname ?></h4>
                                        <ul class="info clearfix">
                                            <li><i class="fas fa-map-marker-alt"></i><?php echo $property_location_data['address'] ?></li>
                                            <li><i class="fas fa-phone"></i><a href="tel:03030571965"><?php echo $contact_number ?></a></li>
                                        </ul>
                                        <h4>Business Hour's</h4>
                                        <ul class="info clearfix">
                                            <li><i class="far fa-calendar"></i>
                                                <?php
                                                $day_count = count($all_days);
                                                foreach ($all_days as $key => $day) {
                                                    // Extract the first three characters of the day name
                                                    $short_day_name = substr($day['day'], 0, 3);
                                                    echo $short_day_name;
                                                    // Add "-" if it's not the last day
                                                    if ($key < $day_count - 1) {
                                                        echo '-';
                                                    }
                                                }
                                                ?>
                                            </li>
                                            <li><i class="far fa-clock"></i><?php echo date("h:i A", strtotime($visitation_hours_from)); ?> - <?php echo date("h:i A", strtotime($visitation_hours_to)); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-inner">
                                    <form action="controller/property-controller" method="post" class="default-form">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                        <input type="hidden" name="property_id" value="<?php echo $propertyId ?>">
                                        <div class="form-group">
                                            <input type="text" name="user_name" value="<?php echo $user_fullname ?>" placeholder="Your name" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="user_phone_number" value="<?php echo $user_phone_number ?>" placeholder="Phone" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Booking Start Date :</label>
                                            <input type="date" id="start_date" name="booking_start_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Booking End Date :</label>
                                            <input type="date" id="end_date" name="booking_end_date" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Message" required></textarea>
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" name="btn-reserve-property" class="theme-btn btn-one">Reserve Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews">
                        <h1>Property Reviews</h1>
                        <div class="line"></div>
                    </div>

                    <div class="container mt-2 mb-2">
                        <div class="mt-5" id="review_content"></div>
                    </div>

                    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Submit Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center mt-2 mb-4">
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                    </h4>
                                    <div class="form-group">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ?>" class="form-control" />
                                        <input type="hidden" name="property_id" id="property_id" value="<?php echo $propertyId ?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                                    </div>
                                    <div class="form-group text-center mt-4">
                                        <!-- <button type="button" class="btn btn-primary" id="save_review">Submit</button> -->
                                        <button type="button" class="theme-btn btn-one" id="save_review">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- property-details end -->

        <!-- main-footer -->
        <footer class="main-footer">
            <div class="footer-top bg-color-2">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column mx-auto">
                            <div class="footer-widget about-widget">
                                <div class="widget-title">
                                    <h3>About</h3>
                                </div>
                                <div class="text">
                                    <p>Welcome to Magrent! Discover the perfect living space with our easy-to-use room rental finder.</p>
                                    <p>Find your next home is now a seamless experience – just a few clicks away.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column mx-auto">
                            <div class="footer-widget links-widget ml-70">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list class">
                                        <li><a href="about-us">About Us</a></li>
                                        <li><a href="find-home">Find Home</a></li>
                                        <li><a href="contact-us">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column mx-auto">
                            <div class="footer-widget contact-widget">
                                <div class="widget-title">
                                    <h3>Contacts</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info-list clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i><?php echo $config->getSystemAddress() ?></li>
                                        <li><i class="fas fa-phone"></i><a href=""><?php echo $config->getSystemNumber() ?></a></li>
                                        <li><i class="fas fa-envelope"></i><a href=""><?php echo $config->getSystemEmail() ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner-box clearfix">
                        <div class="copyright pull-left">
                            <p><?php echo $config->getSystemCopyright() ?></p>
                        </div>
                        <ul class="footer-nav pull-right clearfix">
                            <li><a href="terms">Terms of Service</a></li>
                            <li><a href="privacy_policy">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->

        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>

    <!-- script -->
    <?php include_once '../../configuration/footer2.php'; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzYdQJTyqPkzfTsVEwzJSSgQhe_Qg9OLI&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Replace the coordinates with the desired location
            var location = {
                lat: <?php echo $property_location_data['latitude'] ?>,
                lng: <?php echo $property_location_data['longitude'] ?>
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: location,
                zoom: 15
            });

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Your Location'
            });
        }

        //rating and review
        $(document).ready(function() {

            var rating_data = 0;

            $('#add_review').click(function() {

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('star-light');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('star-light');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {
                var user_id = $('#user_id').val();
                var property_id = $('#property_id').val();
                var user_review = $('#user_review').val();

                if (user_review == '') {
                    alert("Please Fill Both Field");
                    return false;
                } else {
                    $.ajax({
                        url: "rating-data.php",
                        method: "POST",
                        data: {
                            rating_data: rating_data,
                            user_id: user_id,
                            property_id: property_id,
                            user_review: user_review
                        },
                        success: function(data) {
                            $('#review_modal').modal('hide');
                            load_rating_data();

                            swal({
                                title: "<?php echo isset($_SESSION['status_title']); ?>",
                                text: "<?php echo isset($_SESSION['status']); ?>",
                                icon: "<?php echo isset($_SESSION['status_code']); ?>",
                                timer: <?php echo isset($_SESSION['status_timer']); ?>,
                            });
                            location.reload();

                        }
                    });
                }
            });


            load_rating_data();

            function load_rating_data() {

                var property_id = <?php echo $propertyId ?>; // Assuming $propertyId is defined in your PHP code
                var user_id = <?php  echo $user_id?>

                $.ajax({
                    url: "rating-data.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        property_id: property_id,
                        user_id: user_id

                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                html += '<div class="row mb-3">';

                                html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].char_user_name.charAt(0) + '</h3></div></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                                html += '<div class="card-body">';

                                for (var star = 1; star <= 5; star++) {
                                    var class_name = '';

                                    if (data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }

        });

        // Get the current date in the format YYYY-MM-DD
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Set the min attribute of the date inputs
        startDateInput.setAttribute('min', getCurrentDate());
        endDateInput.setAttribute('min', getCurrentDate());

        // Add event listener for the start date input
        startDateInput.addEventListener('input', function() {
            const selectedStartDate = this.value;

            // Set the min attribute of the end date input based on the selected start date
            endDateInput.setAttribute('min', selectedStartDate);

            // Disable the selected start date in the end date calendar
            endDateInput.addEventListener('input', function() {
                const selectedEndDate = this.value;

                if (selectedEndDate === selectedStartDate || new Date(selectedEndDate) < new Date(selectedStartDate)) {
                    // Reset the end date value to avoid selecting the same date or earlier dates
                    this.value = '';
                }
            });
        });
    </script>
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>