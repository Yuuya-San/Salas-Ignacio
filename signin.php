<?php
include_once 'dashboard/user/authentication/user-signin.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'configuration/header.php'; ?>
    <title>MAGRENT | Sign In / Sign Up</title>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $config->getSKey() ?>"></script>
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
                            <a href="/CCSFP-MIDTERM/signin.php"><i class="fas fa-user"></i>Sign In</a>
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
                                        <li class=""><a href="partners"><span>Became A Partner</span></a></li>
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
                    <h1>Sign In / Sign Up</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="./">Home</a></li>
                        <li>Sign In / Sign Up</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- ragister-section -->
        <section class="ragister-section centred sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                        <div class="sec-title">
                        </div>
                        <div class="tabs-box">
                            <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Sign In</li>
                                    <li class="tab-btn" data-tab="#tab-2">Sign Up</li>
                                </ul>
                            </div>
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <h4>Sign in</h4>
                                        <form action="/CCSFP-MIDTERM/dashboard/user/authentication/user-signin.php" method="post" novalidate class="default-form needs-validation">
                                            <input type="hidden" id="g-token" name="g-token">    
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" name="email" required autofocus>
                                                <div class="invalid-feedback">
                                                        Please provide your Email.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" autocomplete="off" name="password" required data-eye>
                                                <div class="invalid-feedback">
                                                        Please provide your Password.
                                                </div>
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one" name="btn-signin" onclick="submitForm()">Sign in</button>
                                            </div>
                                        </form>
                                        <div class="othre-text">
                                            <p>Forgot your password? <a href="/CCSFP-MIDTERM/forgot-password.php">Reset it here</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="tab-2">
                                    <div class="inner-box">
                                        <h4>User Sign Up</h4>
                                        <form action="dashboard/user/authentication/user-signup.php" method="post" class="default-form needs-validation" novalidate>
                                            <div class="form-group">
                                                <label>First Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="first_name" required="">
                                                <div class="invalid-feedback">
                                                    Please provide a First Name.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Middle Name</label>
                                                <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="middle_name">
                                                <div class="invalid-feedback">
                                                    Please provide a Middle Name.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="last_name" required="">
                                                <div class="invalid-feedback">
                                                    Please provide a Last Name.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email address <span style="font-size:17px; margin-top: 2rem; color:red; opacity:0.8;">*</span></label>
                                                <input type="email" class="form-control" name="email" required="">
                                                <div class="invalid-feedback">
                                                    Please provide a Email Address
                                                </div>
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one" name="btn-signup" onclick="submitForm()">Sign Up</button>
                                            </div>
                                        </form>
                                        <div class="othre-text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ragister-section end -->

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

        // CAPTCHA
        grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo $config->getSKey() ?>', {action: 'submit'}).then(function(token) {
            document.getElementById("g-token").value = token;
        });
        });

    </script>
    <?php include_once 'configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>