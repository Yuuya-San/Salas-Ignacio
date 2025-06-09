<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'configuration/header.php'; ?>
    <title>MAGRENT | Agent Registration</title>
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
                            <li><i class="far fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                            <li><i class="far fa-phone"></i><a href="tel:2512353256"><?php echo $config->getSystemNumber() ?></a></li>
                        </ul>
                    </div>
                    <div class="right-column pull-right">
                        <ul class="social-links clearfix">
                            <li><a href="<?php echo $config->getSystemFacebook() ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo $config->getSystemInstagram() ?>"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                        <div class="sign-box">
                            <a href="signin"><i class="fas fa-user"></i>Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-box">
                    <div class="main-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="./"><img src="src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
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
                                        <li class="current"><a href="partners"><span>Became A Partner</span></a></li>
                                        <li class=""><a href="about-us"><span>About Us</span></a></li>
                                        <li><a href="contact-us"><span>Contact Us</span></a></li>
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
                            <figure class="logo"><a href="./"><img src="src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt=""></a></figure>
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
                <div class="nav-logo"><a href=""><img src="src/images/main_logo/<?php echo $config->getSystemLogo() ?>" alt="" title=""></a></div>
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
                <div class="pattern-1" style="background-image: url(src/images/shape/shape-9.png);"></div>
                <div class="pattern-2" style="background-image: url(src/images/shape/shape-10.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Agent Registration</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="./">Home</a></li>
                        <li>Agent Registration</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- myprofile-section -->
        <section class="myprofile-section sec-pad">
            <div class="auto-container">
                <div class="tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><span>1</span>Agent Information</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="gallery-box">
                                <h4><i class="icon-42"></i>Agent Information:</h4>
                                <form action="dashboard/agent/authentication/agent-signup.php" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                    <div class="inner-box default-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>First Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="first_name" required placeholder="Jose">
                                                    <div class="invalid-feedback">
                                                        Please provide a First Name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="middle_name" placeholder="Manalo">
                                                    <div class="invalid-feedback">
                                                        Please provide a Middle Name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Last Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="last_name" required placeholder="Cruz">
                                                    <div class="invalid-feedback">
                                                        Please provide a Last Name.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="field-input">
                                                    <label>Email address <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                    <input type="email" class="form-control"  name="email" required placeholder="sample@gmail.com">
                                                    <div class="invalid-feedback">
                                                        Please provide an Email.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label>Valid ID <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                    </div>
                                    <div class="upload-inner centred">
                                        <i class="fal fa-cloud-upload"></i>
                                        <div class="upload-box">
                                            <input type="file" class="form-control" name="valid_id" id="check3" style="height: 33px;" required onchange="previewImage(event)">
                                            <label for="check3">Click here to upload your valid Id</label>

                                            <!-- Image Preview Container -->
                                            <div id="image-preview-container">
                                                <img id="image-preview" style="max-width: 50%; margin: 10px; border-radius: 10px;">
                                            </div>
                                            <div class="invalid-feedback">
                                                Please provide a Valid ID.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one" name="btn-register-agent" onclick="submitForm()">Register</button>
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
    <?php include_once 'configuration/footer.php'; ?>
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('image-preview');
            var container = document.getElementById('image-preview-container');

            // Ensure that a file was selected
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Update the source of the image and show the preview container
                    preview.src = e.target.result;
                    container.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
            } else {
                // If no file is selected, hide the preview container
                container.style.display = 'none';
            }
        }
    </script>
    <?php include_once 'configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>