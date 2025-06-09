<?php
include_once 'header.php';

$stmt_users = $user->runQuery('SELECT * FROM users WHERE id=:id');
$stmt_users->execute(array(":id" => $user_id));
$user_data = $stmt_users->fetch(PDO::FETCH_ASSOC);

$user_package_type = $user_data['package_id'];

$stmt_package = $user->runQuery('SELECT * FROM package WHERE id=:id');
$stmt_package->execute(array(":id" => $user_package_type));
$package_data = $stmt_package->fetch(PDO::FETCH_ASSOC);

$number_of_post = $package_data['number_of_post'];


$stmt_property_post = $user->runQuery('SELECT * FROM property WHERE user_id=:id');
$stmt_property_post->execute(array(":id" => $user_id));
$property_post_data = $stmt_property_post->fetch(PDO::FETCH_ASSOC);

if($stmt_property_post->rowCount() >= $number_of_post){
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "All Credits have been used, Please choose a package to get more credits, Thank you";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: package');
    exit();
}

// retrieve user business hours
$stmt2 = $user->runQuery("SELECT * FROM business_hours WHERE user_id=:user_id");
$stmt2->execute(array(":user_id" => $user_id));
$business_hours = $stmt2->fetch(PDO::FETCH_ASSOC);

// check if payment method also added
$stmt3 = $user->runQuery("SELECT * FROM user_payment WHERE user_id=:user_id");
$stmt3->execute(array(":user_id" => $user_id));
$payment = $stmt3->fetch(PDO::FETCH_ASSOC);


// Check if business hours data is available
if (empty($business_hours) || empty($payment)) {
    // No business hours found, trigger SweetAlert using JavaScript
    // Use $row instead of $row->rowCount()
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "You have a to add business hours or payment method to register a property";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: settings');
    exit();
}

// If business hours are available, continue processing
$visitation_hours_to = $business_hours['visitation_hours_to'];
$visitation_hours_from = $business_hours['visitation_hours_from'];

// Convert the string of days IDs into an array
$selected_days = explode(',', $business_hours['visitation_days']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Property Registration</title>
</head>
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
                            <a href="authentication/agent-signout" class="btn-signout"><i class="fa fa-sign-out"></i>Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="property"><img src="../../src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
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
                                        <li class="dropdown current"><a href="#"><span>Property</span></a>
                                            <ul>
                                                <li><a href="property">Property</a></li>
                                                <li><a href="property-registration">Property Registration</a></li>
                                                <li><a href="property-reservation?status=?">Property Reservation</a></li>
                                            </ul>
                                        </li> 
                                        <li class=""><a href="package"><span>Package</span></a></li>
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
                            <figure class="logo"><a href="property"><img src="../../src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
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
                    <h1>Registration</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="property">Home</a></li>
                        <li>Registration</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-registration-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="title">
                    <h3>Property Registration</h3>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><span>1</span>Property Details</li>
                        <li class="tab-btn" data-tab="#tab-2"><span>2</span>Gallery</li>
                        <li class="tab-btn" data-tab="#tab-3"><span>3</span>Property Viewing</li>
                        <li class="tab-btn" data-tab="#tab-4"><span>4</span>Location</li>
                    </ul>
                    <form action="controller/property-controller.php?id=<?php echo $user_id ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="property-details">
                                    <h4><i class="icon-19"></i>Property Details:</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                        <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Type <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box">
                                                        <select class="wide" required name="property_type" id="property_type" onchange="toggleUnitsField()">
                                                            <option value="">Property Type</option>
                                                            <option value="1">Apartment</option>
                                                            <option value="2">House</option>
                                                            <option value="3">Lady's Bed Space</option>
                                                            <option value="4">Men's Bed Space</option>
                                                            <option value="5">Dormitory</option>
                                                            <option value="6">Transient</option>
                                                        </select>
                                                        <div class="invalid-feedback">Example invalid select feedback</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column" id="units_field" style="display: none;">
                                                <div class="field-input" >
                                                    <label>Unit's <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box">
                                                        <select class="wide" name="units" id="units">
                                                            <option value="">How many units?</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide how many unit's.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Name<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="property_name" placeholder="Analyn Apartment" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Price <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" name="property_price" inputmode="numeric" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property price .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Contact Details <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" name="property_contact" inputmode="numeric" minlength="10" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property contact details.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Bedrooms <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box" required>
                                                        <select class="wide" name="bedrooms" required>
                                                            <option value="">How many bedrooms?</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide how many bedrooms.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Bathrooms <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bathrooms" required>
                                                            <option value="">How many bathrooms?</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide how many bathrooms.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Parking </label>
                                                    <div class="select-box">
                                                        <select class="wide" name="parking" required>
                                                            <option value="">How many parking?</option>
                                                            <option value="0">No Parking</option>
                                                            <option value="1">Parking 01</option>
                                                            <option value="2">Parking 02</option>
                                                            <option value="3">Parking 03</option>
                                                            <option value="4">Parking 04</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide how many parking.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Size in SqFt <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" name="property_size" inputmode="numeric" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property size in SqFt.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Garage Size in SqFt</label>
                                                    <input type="text" class="form-control numbers" name="garage_size" inputmode="numeric">
                                                    <div class="invalid-feedback">
                                                        Please provide an garage size in SqFt.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Allowed Pet's? <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box">
                                                        <select class="wide" name="allowed_pets" required>
                                                            <option value="">Select Option?</option>
                                                            <option value="YES">YES</option>
                                                            <option value="NO">NO</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select an option.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Description<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <textarea class="form-control" autocapitalize="on" autocomplete="off" name="property_description" rows="4" cols="40" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please provide an property description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Inclusives <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>

                                    <ul class="other-option clearfix">
                                        <?php
                                            $stmt_amenities = $user->runQuery("SELECT * FROM amenities");
                                            $stmt_amenities->execute();

                                            if($stmt_amenities->rowCount() >= 1){
                                                while($amenities_data = $stmt_amenities->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                        <li>
                                                            <div class="radio-box">
                                                                <input type="checkbox" name="amenities[]" value="<?php echo $amenities_data['id'] ?>" id="amenities<?php echo $amenities_data['id'] ?>">
                                                                <label for="amenities<?php echo $amenities_data['id'] ?>"><?php echo $amenities_data['amenities'] ?></label>
                                                            </div>
                                                        </li>
                                                    <?php

                                                }

                                            }
                 
                                        ?>
                                    </ul>
                                    <a class="theme-btn btn-one tab-buttons">
                                        <li type="submit" class="tab-btn active-btn" data-tab="#tab-2">Next</li>
                                    </a>
                                </div>
                            </div>
                            <div class="tab" id="tab-2">
                                <div class="gallery-box">
                                    <h4><i class="icon-16"></i>Propert Gallery</h4>

                                    <h6>Picture 1 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture1" id="check11" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-1', 'image-preview-1')">
                                            <label for="check11">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-1">
                                                <img id="image-preview-1" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an picture 1.
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Picture 2 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture2" id="check12" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-2', 'image-preview-2')">
                                            <label for="check12">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-2">
                                                <img id="image-preview-2" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an picture 2.
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Picture 3 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture3" id="check13" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-3', 'image-preview-3')">
                                            <label for="check13">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-3">
                                                <img id="image-preview-3" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an picture 3.
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Picture 4 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture4" id="check14" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-4', 'image-preview-4')">
                                            <label for="check14">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-4">
                                                <img id="image-preview-4" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an picture 4.
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Picture 5 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture5" id="check15" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-5', 'image-preview-5')">
                                            <label for="check15">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-5">
                                                <img id="image-preview-5" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an picture 5.
                                            </div>
                                        </div>
                                    </div>
                                    <a class="theme-btn btn-one tab-buttons">
                                        <li class="tab-btn" data-tab="#tab-3">Next</li>
                                    </a>
                                </div>
                            </div>
                            <div class="tab" id="tab-3">
                                <div class="property-details">
                                    <h4><i class="icon-19"></i>Property Viewing:</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Visiting Rules<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <textarea class="form-control" autocapitalize="on" autocomplete="off" name="visiting_rules" rows="4" cols="40" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please provide visiting rules.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>What are the visitation hours for viewing <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="field-input">

                                                <label>From<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_from" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time from.
                                                </div>

                                                </br>

                                                <label>To<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_to" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time to.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h6>What Day(s) is the property for viewing <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <ul class="other-option clearfix">
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="1" id="check16">
                                                <label for="check16">Monday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="2" id="check17">
                                                <label for="check17">Tuesday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="3" id="check18">
                                                <label for="check18">Wednesday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="4" id="check19">
                                                <label for="check19">Thursday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="5" id="check20">
                                                <label for="check20">Friday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="6" id="check21">
                                                <label for="check21">Saturday</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio-box">
                                                <input type="checkbox" name="days[]" value="7" id="check22">
                                                <label for="check22">Sunday</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="theme-btn btn-one tab-buttons">
                                        <li class="tab-btn" data-tab="#tab-4">Next</li>
                                    </a>
                                </div>
                            </div>
                            <div class="tab" id="tab-4">
                                <div class="gallery-box">
                                    <h4><i class="icon-34"></i>Location:</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">

                                            <div id="map-canvas"></div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Address <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" id="map-search" name="address" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an address .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Latitude <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control latitude" name="latitude" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an latitude.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Longitude <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control longitude" name="longitude" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an longitude.
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" class="reg-input-city" placeholder="City" style="display: none;">

                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn btn-one" name="btn-register-property" onclick="submitForm()">Register</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- property-registration-section end -->



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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config->getGoogleMapsAPI() ?>&libraries=places&callback=initialize"></script>

    <script>
        //google maps--------------------------------------------------------------
        function initialize() {

            var mapOptions, map, marker, searchBox, city,
                infoWindow = '',
                addressEl = document.querySelector('#map-search'),
                latEl = document.querySelector('.latitude'),
                longEl = document.querySelector('.longitude'),
                element = document.getElementById('map-canvas');
                city = document.querySelector('.reg-input-city');

            mapOptions = {
                // How far the maps zooms in.
                zoom: 12,
                // Current Lat and Long position of the pin/
                center: new google.maps.LatLng(8.5078063, 125.9708352),
                // center : {
                // 	lat: -34.397,
                // 	lng: 150.644
                // },
                streetViewControl: false,
                disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
                scrollWheel: true, // If set to false disables the scrolling on the map.
                draggable: true, // If set to false , you cannot move the map around.
                // mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
                // maxZoom: 11, // Wont allow you to zoom more than this
                minZoom: 8 // Wont allow you to go more up.

            };

            /**
             * Creates the map using google function google.maps.Map() by passing the id of canvas and
             * mapOptions object that we just created above as its parameters.
             *
             */
            // Create an object map with the constructor function Map()
            map = new google.maps.Map(element, mapOptions); // Till this like of code it loads up the map.

            /**
             * Creates the marker on the map
             *
             */
            marker = new google.maps.Marker({
                position: mapOptions.center,
                map: map,
                // icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
                draggable: true
            });

            /**
             * Creates a search box
             */
            searchBox = new google.maps.places.SearchBox(addressEl);

            /**
             * When the place is changed on search box, it takes the marker to the searched location.
             */
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces(),
                    bounds = new google.maps.LatLngBounds(),
                    i, place, lat, long, resultArray,
                    addresss = places[0].formatted_address;

                for (i = 0; place = places[i]; i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location); // Set marker position new.
                }

                map.fitBounds(bounds); // Fit to the bound
                map.setZoom(15); // This function sets the zoom to 15, meaning zooms to level 15.
                // console.log( map.getZoom() );

                lat = marker.getPosition().lat();
                long = marker.getPosition().lng();
                latEl.value = lat;
                longEl.value = long;

                resultArray = places[0].address_components;

                // Get the city and set the city input value to the one selected
                for (var i = 0; i < resultArray.length; i++) {
                    if (resultArray[i].types[0] && 'administrative_area_level_2' === resultArray[i].types[0]) {
                        citi = resultArray[i].long_name;
                        city.value = citi;
                    }
                }

                // Closes the previous info window if it already exists
                if (infoWindow) {
                    infoWindow.close();
                }
                /**
                 * Creates the info Window at the top of the marker
                 */
                infoWindow = new google.maps.InfoWindow({
                    content: addresss
                });

                infoWindow.open(map, marker);
            });


            /**
             * Finds the new position of the marker when the marker is dragged.
             */
            google.maps.event.addListener(marker, "dragend", function(event) {
                var lat, long, address, resultArray, citi;

                console.log('i am dragged');
                lat = marker.getPosition().lat();
                long = marker.getPosition().lng();

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    latLng: marker.getPosition()
                }, function(result, status) {
                    if ('OK' === status) { // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                        address = result[0].formatted_address;
                        resultArray = result[0].address_components;

                        // Get the city and set the city input value to the one selected
                        for (var i = 0; i < resultArray.length; i++) {
                            if (resultArray[i].types[0] && 'administrative_area_level_2' === resultArray[i].types[0]) {
                                citi = resultArray[i].long_name;
                                console.log(citi);
                                city.value = citi;
                            }
                        }
                        addressEl.value = address;
                        latEl.value = lat;
                        longEl.value = long;

                    } else {
                        console.log('Geocode was not successful for the following reason: ' + status);
                    }

                    // Closes the previous info window if it already exists
                    if (infoWindow) {
                        infoWindow.close();
                    }

                    /**
                     * Creates the info Window at the top of the marker
                     */
                    infoWindow = new google.maps.InfoWindow({
                        content: address
                    });

                    infoWindow.open(map, marker);
                });
            });


        }


    // Function to toggle the visibility of the Units field and set/remove the 'required' attribute
    function toggleUnitsField() {
        var propertyTypeSelect = document.getElementById('property_type');
        var unitsField = document.getElementById('units_field');
        var unitsSelect = document.getElementById('units');

        // Check if the selected property type is either "Dormitory" or "Apartment"
        if (propertyTypeSelect.value == 5 || propertyTypeSelect.value == 1) {
            unitsField.style.display = 'block';
            unitsSelect.setAttribute('required', 'required');
        } else {
            unitsField.style.display = 'none';
            unitsSelect.removeAttribute('required');
        }
    }
    </script>
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>