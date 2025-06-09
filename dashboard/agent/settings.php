<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Settings</title>
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
                                        <li class="dropdown current"><a href="settings"><span>Settings</span></a></li>
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
                    <h1>Settings</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="property">Home</a></li>
                        <li>Settings</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- property-registration-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="title">
                    <h3>Profile Management</h3>
                </div>
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><span>1</span>Profile Information</li>
                        <li class="tab-btn" data-tab="#tab-2"><span>2</span>Profile Picture</li>
                        <li class="tab-btn" data-tab="#tab-3"><span>3</span>Password</li>
                        <li class="tab-btn" data-tab="#tab-4"><span>4</span>Payment</li>
                        <li class="tab-btn" data-tab="#tab-5"><span>5</span>Credits</li>

                    </ul>
                    <div class="tabs-content">
                        <form action="controller/profile-controller.php?id=<?php echo $user_id ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="tab active-tab" id="tab-1">
                                <div class="property-details">
                                    <h4><i class='bx bxs-edit'></i>Edit Profile</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>First Name<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="first_name" value="<?php echo $user_fname  ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an First Name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Middle Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="middle_name" value="<?php echo $user_mname  ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Middle Name .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Last Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="last_name" value="<?php echo $user_lname  ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Last Name .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Sex</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="sex">
                                                            <option value="<?php echo $user_sex ?>"><?php echo $user_sex ?></option>
                                                            <option value="MALE">MALE</option>
                                                            <option value="FEMALE ">FEMALE</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide your Sex.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control" value="<?php echo $user_birth_date  ?>" autocapitalize="off" autocomplete="off" name="date_of_birth" id="date_of_birth" maxlength="10" pattern="^[a-zA-Z0-9]+@gmail\.com$" placeholder="Ex: mm/dd/yyyy" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);">
                                                    <div class="invalid-feedback">
                                                        Please provide an Birth Date.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column" style="display: none;">
                                                <div class="field-input">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" value="<?php echo $user_age ?>" autocapitalize="off" autocomplete="off" name="age" id="age">
                                                    <div class="invalid-feedback">
                                                        Please provide your Age.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Phone Number <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control numbers" value="<?php echo $user_phone_number ?>" name="phone_number" inputmode="numeric" minlength="10" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Phone Number.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>What's your business hours <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="field-input">

                                                <label>From<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_from" value="<?php echo $visitation_hours_from ?>" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time from.
                                                </div>

                                                </br>

                                                <label>To<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="time" class="form-control" autocomplete="off" name="visitation_hours_to" value="<?php echo $visitation_hours_to ?>" required>
                                                <div class="invalid-feedback">
                                                    Please provide visiting time to.
                                                </div>
                                            </div>
                                        </div>
                                        <h6>What's your availability Day's <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
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

                                    </div>
                                    <button type="submit" class="theme-btn btn-one" name="btn-update-profile" onclick="submitForm()">Update</button>
                                </div>
                            </div>
                        </form>

                        <form action="controller/profile-controller.php?id=<?php echo $user_id ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="tab" id="tab-2">
                                <div class="gallery-box">
                                    <h4><i class='bx bxs-edit'></i>Profile Management</h4>

                                    <h6>Profile Picture <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></h6>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="avatar" id="check11" style="height: 33px;" onchange="previewImage(event, 'image-preview-container-1', 'image-preview-1')">
                                            <label for="check11">Click here to upload your image</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-1">
                                                <?php
                                                // Display the existing image if available
                                                if (!empty($user_profile)) {
                                                    $imagePath = "../../src/images/profile/" . $user_profile;
                                                    echo "<img id='image-preview-1' src='$imagePath' style='max-width: 50%; margin: 10px; border-radius: 10px;'>";
                                                }
                                                ?> </div>
                                            <div class="invalid-feedback">
                                                Please provide an your profile picture.
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn btn-one" name="btn-update-avatar" onclick="submitForm()">Update</button>
                                </div>
                            </div>
                        </form>


                        <form action="controller/profile-controller.php?id=<?php echo $user_id ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="tab" id="tab-3">
                                <div class="property-details">
                                    <h4><i class='bx bxs-edit'></i>Password Manager</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Old Password<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="old_password" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Old Password.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>New Password<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="new_password" autocapitalize="on" autocorrect="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter your new password" required autofocus data-eye>
                                                    <div class="invalid-feedback">
                                                        Please provide an New Password.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Confirm Password<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="confirm_password" autocapitalize="on" autocorrect="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Re-enter your new password" required autofocus data-eye>
                                                    <div class="invalid-feedback">
                                                        Please provide an Confirm Password.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="theme-btn btn-one" name="btn-update-password" onclick="submitForm()">Update</button>
                                </div>
                            </div>
                        </form>

                        <form action="controller/profile-controller.php?id=<?php echo $user_id ?>" id="propertyForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="tab" id="tab-4">
                                <div class="property-details">
                                    <h4><i class='bx bxs-credit-card'></i>Payment Setup</h4>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Select Bank</label>
                                                    <div class="select-box">
                                                        <select class="wide" name="bank" required>
                                                            <option value="<?php echo $bank ?>"><?php echo $bank ?></option>
                                                            <option value="BDO (Banco de Oro)">BDO (Banco de Oro)</option>
                                                            <option value="BPI (Bank of the Philippine Islands)">BPI (Bank of the Philippine Islands)</option>
                                                            <option value="Metrobank">Metrobank</option>
                                                            <option value="LandBank">LandBank</option>
                                                            <option value="PNB (Philippine National Bank)">PNB (Philippine National Bank)</option>
                                                            <option value="Security Bank">Security Bank</option>
                                                            <option value="UnionBank">UnionBank</option>
                                                            <option value="RCBC (Rizal Commercial Banking Corporation)">RCBC (Rizal Commercial Banking Corporation)</option>
                                                            <option value="EastWest Bank">EastWest Bank</option>
                                                            <option value="Chinabank">Chinabank</option>
                                                            <option value="PSBank (Philippine Savings Bank)">PSBank (Philippine Savings Bank)</option>
                                                            <option value="UCPB (United Coconut Planters Bank)">UCPB (United Coconut Planters Bank)</option>
                                                            <option value="DBP (Development Bank of the Philippines)">DBP (Development Bank of the Philippines)</option>
                                                            <option value="Maybank">Maybank</option>
                                                            <option value="ING Bank">ING Bank</option>
                                                            <option value="HSBC">HSBC</option>
                                                            <option value="GCash">GCash</option>
                                                            <option value="PayMaya">PayMaya</option>
                                                            <option value="Paypal">Paypal</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a bank.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Account Name<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="account_name" value="<?php echo $account_name  ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Account Name .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Account Number<span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control" name="account_number" value="<?php echo $account_number  ?>" required>
                                                    <div class="invalid-feedback">
                                                        Please provide an Account Number .
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn btn-one" name="btn-update-payment" onclick="submitForm()">Update</button>
                                </div>
                            </div>
                        </form>

                        <div class="tab" id="tab-5">
                            <div class="property-details">
                                <h4><i class='bx bxs-coin'></i> Available Credits</h4>

                                <?php
                                // Assuming you have a User class with a method runQuery for database queries
                                // Replace User with your actual class name

                                // Get the user's package information
                                $stmt = $user->runQuery("SELECT * FROM users WHERE id=:user_id");
                                $stmt->execute(array(":user_id" => $user_id));
                                $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

                                $user_package_type = $user_data['package_id'];

                                $stmt_package = $user->runQuery('SELECT * FROM package WHERE id=:id');
                                $stmt_package->execute(array(":id" => $user_package_type));
                                $package_data = $stmt_package->fetch(PDO::FETCH_ASSOC);

                                $number_of_post_allowed = $package_data['number_of_post'];

                                // Get the count of already posted properties
                                $stmt_property_post = $user->runQuery('SELECT COUNT(*) as posted_count FROM property WHERE user_id=:user_id');
                                $stmt_property_post->execute(array(":user_id" => $user_id));
                                $property_post_data = $stmt_property_post->fetch(PDO::FETCH_ASSOC);

                                $remaining_credits = $number_of_post_allowed - $property_post_data['posted_count'];

                                // Now $remaining_credits contains the number of remaining credits for property posting
                                ?>
                                <h1 class="credits"><?php echo $remaining_credits; ?></h1>
                            </div>
                        </div>
                    </div>
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
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>