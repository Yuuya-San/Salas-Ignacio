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

// Fetch property data
$stmt = $user->runQuery("SELECT * FROM property WHERE id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_data = $stmt->fetch(PDO::FETCH_ASSOC);

// Convert the string of amenity IDs into an array
$selected_amenities = explode(',', $property_data['amenities']);

// Fetch amenities data
$stmt_all_amenities = $user->runQuery("SELECT * FROM amenities");
$stmt_all_amenities->execute();
$all_amenities = $stmt_all_amenities->fetchAll(PDO::FETCH_ASSOC);

//Fetch property image
$stmt_image = $user->runQuery("SELECT * FROM property_gallery WHERE property_id=:id");
$stmt_image->execute(array(":id" => $propertyId));
$property_image_data = $stmt_image->fetch(PDO::FETCH_ASSOC);

//Fetch property viewing time
$stmt_property_viewing_time = $user->runQuery("SELECT * FROM property_viewing_time WHERE property_id=:id");
$stmt_property_viewing_time->execute(array(":id" => $propertyId));
$property_viewing_time_data = $stmt_property_viewing_time->fetch(PDO::FETCH_ASSOC);

// Convert the string of days IDs into an array
$selected_days = explode(',', $property_viewing_time_data['visitation_days']);

// Fetch days data
$stmt_all_days = $user->runQuery("SELECT * FROM day");
$stmt_all_days->execute();
$all_days = $stmt_all_days->fetchAll(PDO::FETCH_ASSOC);

//property location
$stmt = $user->runQuery("SELECT * FROM property_location WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_location_data = $stmt->fetch(PDO::FETCH_ASSOC);

//property floor plan
$stmt = $user->runQuery("SELECT * FROM property_floor_plan WHERE property_id=:id");
$stmt->execute(array(":id" => $propertyId));
$property_floor_plan_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Edit Property Registration</title>
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
                                        <li class="dropdown"><a href="#"><span>Property</span></a>
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
                    <h1>Edit Property Details</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="property">Home</a></li>
                        <li><a href="property-details">Property Details</a></li>
                        <li>Edit</li>

                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-registration-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="title">
                    <h3>Edit Property Details</h3>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><span>1</span>Property Details</li>
                        <li class="tab-btn" data-tab="#tab-2"><span>2</span>Gallery</li>
                        <li class="tab-btn" data-tab="#tab-3"><span>3</span>Property Viewing</li>
                        <li class="tab-btn" data-tab="#tab-4"><span>4</span>Location</li>
                    </ul>
                    <form action="controller/property-controller.php?property_id=<?php echo $property_data['id'] ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="property-details">
                                    <h4><i class="icon-19"></i>Property Details:</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <?php
                                                    if ($property_data['status'] == "available") {
                                                        $status = "Available"

                                                    ?>
                                                        <label>Property Status : <span style="font-size:17px; margin-top: 2rem; color:green; opacity:0.8;">Available</span></label>
                                                        <div class="select-box">
                                                            <select class="wide" name="status" required>
                                                                <option selected value="<?php echo $property_data['status'] ?>"><?php echo $status ?></option>
                                                                <option value="available">Available</option>
                                                                <option value="not_available">Not Available</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select property Status.
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }else if ($property_data['status'] == "not_available"){
                                                        $status = "Not Available"
                                                    ?>
                                                        <label>Property Status : <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">Not Available</span></label>
                                                        <div class="select-box">
                                                            <select class="wide" name="status" required>
                                                                <option selected value="<?php echo $property_data['status'] ?>"><?php echo $status ?></option>
                                                                <option value="available">Available</option>
                                                                <option value="not_available">Not Available</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select property Status.
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Type <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <div class="select-box">
                                                        <select class="wide" required name="property_type">
                                                            <option selected value="<?php echo $property_data['property_type'] ?>">
                                                                <?php
                                                                if ($property_data['property_type'] == 1) {
                                                                    echo 'Apartment';
                                                                } elseif ($property_data['property_type'] == 2) {
                                                                    echo 'House';
                                                                } elseif ($property_data['property_type'] == 3) {
                                                                    echo 'Ladys Bed Space';
                                                                } elseif ($property_data['property_type'] == 4) {
                                                                    echo 'Mens Bed Space';
                                                                } elseif ($property_data['property_type'] == 5) {
                                                                    echo 'Dormitory';
                                                                } elseif ($property_data['property_type'] == 6) {
                                                                    echo 'Transient';
                                                                } else {
                                                                    echo 'Property Type';
                                                                }
                                                                ?>
                                                            </option>
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
                                            <?php
                                            if ($property_data['property_type'] == 1) {
                                            ?>
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="field-input">
                                                        <label>Unit's <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                        <div class="select-box">
                                                            <select class="wide" name="units" id="units">
                                                                <option value="<?php echo $property_data['units'] ?>"><?php echo $property_data['units'] ?></option>
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
                                            <?php
                                            }
                                            ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Name<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" value="<?php echo $property_data['property_name'] ?>" name="property_name" placeholder="Analyn Apartment" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Price <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" value="<?php echo $property_data['property_price'] ?>" name="property_price" inputmode="numeric" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property price .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Property Contact Details <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" name="property_contact" value="<?php echo $property_data['property_contact_details'] ?>" inputmode="numeric" minlength="10" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
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
                                                            <option value="<?php echo $property_data['bedrooms'] ?>"><?php echo $property_data['bedrooms'] ?></option>
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
                                                            <option value="<?php echo $property_data['bathrooms'] ?>"><?php echo $property_data['bathrooms'] ?></option>
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
                                                            <option selected value="<?php echo $property_data['parking'] ?>"><?php echo $property_data['parking'] ?></option>
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
                                                    <input type="text" class="form-control numbers" name="property_size" value="<?php echo $property_data['property_size'] ?>" inputmode="numeric" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an property size in SqFt.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Garage Size in SqFt</label>
                                                    <input type="text" class="form-control numbers" name="garage_size" value="<?php echo $property_data['garage_size'] ?>" inputmode="numeric">
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
                                                            <option value="<?php echo $property_data['allowed_pets'] ?>"><?php echo $property_data['allowed_pets'] ?></option>
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
                                                    <textarea class="form-control" autocapitalize="on" autocomplete="off" name="property_description" value="<?php echo $property_data['property_description'] ?>" rows="4" cols="40" required><?php echo $property_data['property_description'] ?></textarea>
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
                                        // Loop through all amenities and create checkboxes
                                        foreach ($all_amenities as $amenity) {
                                            $amenityId = $amenity['id'];
                                            $amenityName = $amenity['amenities'];
                                            $isChecked = in_array($amenityId, $selected_amenities) ? 'checked' : '';
                                        ?>
                                            <li>
                                                <div class="radio-box">
                                                    <input type="checkbox" name="amenities[]" value="<?php echo $amenityId; ?>" id="amenities<?php echo $amenityId; ?>" <?php echo $isChecked; ?>>
                                                    <label for="amenities<?php echo $amenityId; ?>"><?php echo $amenityName; ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <a class="theme-btn btn-one tab-buttons">
                                        <li type="submit" class="tab-btn active-btn" data-tab="#tab-2">Next</li>
                                    </a>
                                </div>
                            </div>
                            <div class="tab" id="tab-2">

                                <div class="gallery-box">
                                    <h4><i class="icon-16"></i>Property Gallery</h4>

                                    <h6>Picture 1 <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="picture1" id="check11" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-1', 'image-preview-1')">
                                            <label for="check11">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-1">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($property_image_data['picture_1'])) {
                                                    $imagePath = "../../src/images/property_gallery/" . $property_image_data['picture_1'];
                                                    echo "<img id='image-preview-1' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?>
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
                                            <input type="file" class="form-control" name="picture2" id="check12" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-2', 'image-preview-2')">
                                            <label for="check12">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-2">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($property_image_data['picture_2'])) {
                                                    $imagePath = "../../src/images/property_gallery/" . $property_image_data['picture_2'];
                                                    echo "<img id='image-preview-2' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?>
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
                                            <input type="file" class="form-control" name="picture3" id="check13" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-3', 'image-preview-3')">
                                            <label for="check13">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-3">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($property_image_data['picture_3'])) {
                                                    $imagePath = "../../src/images/property_gallery/" . $property_image_data['picture_3'];
                                                    echo "<img id='image-preview-3' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?>
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
                                            <input type="file" class="form-control" name="picture4" id="check14" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-4', 'image-preview-4')">
                                            <label for="check14">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-4">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($property_image_data['picture_4'])) {
                                                    $imagePath = "../../src/images/property_gallery/" . $property_image_data['picture_4'];
                                                    echo "<img id='image-preview-4' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?>
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
                                            <input type="file" class="form-control" name="picture5" id="check15" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-5', 'image-preview-5')">
                                            <label for="check15">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-5">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($property_image_data['picture_5'])) {
                                                    $imagePath = "../../src/images/property_gallery/" . $property_image_data['picture_5'];
                                                    echo "<img id='image-preview-5' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?>
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
                                                    <textarea class="form-control" autocapitalize="on" autocomplete="off" name="visiting_rules" value="<?php echo $property_viewing_time_data['visiting_rules'] ?>" rows="4" cols="40" required><?php echo $property_viewing_time_data['visiting_rules'] ?></textarea>
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
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_from" value="<?php echo $property_viewing_time_data['visitation_hours_from'] ?>" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time from.
                                                </div>

                                                </br>

                                                <label>To<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_to" value="<?php echo $property_viewing_time_data['visitation_hours_to'] ?>" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time to.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h6>What Day(s) is the property for viewing <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <ul class="other-option clearfix">
                                        <?php
                                        // Loop through all amenities and create checkboxes
                                        foreach ($all_days as $days) {
                                            $daysID = $days['id'];
                                            $days_names = $days['day'];
                                            $isChecked = in_array($daysID, $selected_days) ? 'checked' : '';
                                        ?>
                                            <li>
                                                <div class="radio-box">
                                                    <input type="checkbox" name="days[]" value="<?php echo $daysID; ?>" id="days<?php echo $daysID; ?>" <?php echo $isChecked; ?>>
                                                    <label for="days<?php echo $daysID; ?>"><?php echo $days_names; ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
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
                                                    <input type="text" class="form-control" id="map-search" name="address" value="<?php echo $property_location_data['address'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an address .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Latitude <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control latitude" name="latitude" value="<?php echo $property_location_data['latitude'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an latitude.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Longitude <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control longitude" name="longitude" value="<?php echo $property_location_data['longitude'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an longitude.
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" class="reg-input-city" placeholder="City" style="display: none;">

                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn btn-one" name="btn-edit-property" onclick="submitForm()">Update</button>

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
                zoom: 15,
                // Current Lat and Long position of the pin/
                center: new google.maps.LatLng(<?php echo $property_location_data['latitude'] ?>, <?php echo $property_location_data['longitude'] ?>),
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
    </script>
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>