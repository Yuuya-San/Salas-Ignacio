<?php
include_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the POST request
    $packageId = isset($_POST['package_id']) ? $_POST['package_id'] : '';

    // Store the values in session variables
    $_SESSION['package_id'] = $packageId;
}

// Retrieve the values from session variables
$packageId = isset($_SESSION['package_id']) ? $_SESSION['package_id'] : '';

//property data
$stmt = $user->runQuery("SELECT * FROM package WHERE id=:id");
$stmt->execute(array(":id" => $packageId));
$packageData = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Payment</title>
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
                                        <li class="current"><a href="package"><span>Package</span></a></li>
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
                    <h1>Payment</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="property">Home</a></li>
                        <li><a href="package">Package</a></li>
                        <li>Payment</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- myprofile-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="tabs-box">
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="gallery-box">
                                <h4><i class='bx bxs-credit-card'></i>Payment Details</h4>
                                <form action="controller/payment-controller.php" method="POST" class="needs-validation" novalidate  enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                    <input type="hidden" name="package_id" value="<?php echo $packageId?>">
                                    <div class="upload-inner centred">
                                        <div class="upload-box">
                                            <label>You choose <strong><?php echo $packageData['package']?></strong> package, Scan this QR code to pay <strong>₱<?php echo $packageData['price']?></strong> with GCash</label>
                                            <!-- Image Preview Container -->
                                            <div >
                                                <img src="../../src/images/gcash_qrcode/frame.png" style="max-width: 40%; margin: 10px; border-radius: 20px;">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Reference Number <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control"  name="reference_number" required placeholder="">
                                                    <div class="invalid-feedback">
                                                        Please provide the Reference Number.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Proof of payment (screenshot) <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                    </div>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="proof_of_payment" id="check14" style="height: 33px;" required onchange="previewImage(event, 'image-preview-container-4', 'image-preview-4')">
                                            <label for="check14">Click here to upload your screenshot</label>
                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container-4">
                                                <img id="image-preview-4" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide an Proof of payment.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one" name="btn-add-payment" onclick="submitForm()">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- myprofile-section end -->

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