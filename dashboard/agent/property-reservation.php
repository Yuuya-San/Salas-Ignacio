<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once '../../configuration/header2.php'; ?>
    <title>MAGRENT | Property Reservation</title>
    <link rel="stylesheet" href="../../src/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../src/node_modules/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../src/node_modules/aos/dist/aos.css">
    <link rel="stylesheet" href="../../src/css/reservation.css?v=<?php echo time(); ?>">
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
                    <h1>Property Reservation</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="property">Home</a></li>
                        <li>Property Reservation</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <div id="content">
            <main>
                <div class="table-data">
                    <!-- pending -->
                    <?php
                    if ($_GET['status'] == "pending" || $_GET['status'] == "?") {
                    ?>
                        <div class="order">
                            <div class="head">
                                <h3><i class='bx bxs-credit-card'></i> List of Pending Reservation</h3>
                            </div>
                            <button type="button" onclick="location.href='property-reservation?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
                            <button type="button" onclick="location.href='property-reservation?status=waiting'" class="archives btn-info"><i class='bx bxs-credit-card' ></i> Waiting</button>
                            <button type="button" onclick="location.href='property-reservation?status=accept'" class="archives btn-success"><i class='bx bxs-check-circle'></i> Accept</button>
                            <button type="button" onclick="location.href='property-reservation?status=decline'" class="archives btn-danger"><i class='bx bxs-shield-x'></i> Decline</button>

                            <!-- BODY -->
                            <section class="data-table">
                                <div class="searchBx">
                                    <input type="input" placeholder="Search . . . . . ." class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                                </div>

                                <div class="table">
                                    <div id="dynamic_content">
                                    </div>

                            </section>
                        </div>
                    <?php
                    } else if ($_GET['status'] == "waiting") {
                    ?>
                        <div class="order">
                            <div class="head">
                                <h3><i class='bx bxs-credit-card'></i> List of Waiting Payment</h3>
                            </div>
                            <button type="button" onclick="location.href='property-reservation?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
                            <button type="button" onclick="location.href='property-reservation?status=waiting'" class="archives btn-info"><i class='bx bxs-credit-card' ></i> Waiting</button>
                            <button type="button" onclick="location.href='property-reservation?status=accept'" class="archives btn-success"><i class='bx bxs-check-circle'></i> Accept</button>
                            <button type="button" onclick="location.href='property-reservation?status=decline'" class="archives btn-danger"><i class='bx bxs-shield-x'></i> Decline</button>

                            <!-- BODY -->
                            <section class="data-table">
                                <div class="searchBx">
                                    <input type="input" placeholder="Search . . . . . ." class="search" name="search_box1" id="search_box1"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                                </div>

                                <div class="table">
                                    <div id="dynamic_content1">
                                    </div>

                            </section>
                        </div>
                    <?php
                    } else if ($_GET['status'] == "accept") {
                    ?>
                        <div class="order">
                            <div class="head">
                                <h3><i class='bx bxs-credit-card'></i> List of Accept Reservation</h3>
                            </div>
                            <button type="button" onclick="location.href='property-reservation?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
                            <button type="button" onclick="location.href='property-reservation?status=waiting'" class="archives btn-info"><i class='bx bxs-credit-card' ></i> Waiting</button>
                            <button type="button" onclick="location.href='property-reservation?status=accept'" class="archives btn-success"><i class='bx bxs-check-circle'></i> Accept</button>
                            <button type="button" onclick="location.href='property-reservation?status=decline'" class="archives btn-danger"><i class='bx bxs-shield-x'></i> Decline</button>

                            <!-- BODY -->
                            <section class="data-table">
                                <div class="searchBx">
                                    <input type="input" placeholder="Search . . . . . ." class="search" name="search_box2" id="search_box2"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                                </div>

                                <div class="table">
                                    <div id="dynamic_content2">
                                    </div>

                            </section>
                        </div>
                    <?php
                    } else if ($_GET['status'] == "decline") {
                    ?>
                        <div class="order">
                            <div class="head">
                                <h3><i class='bx bxs-credit-card'></i> List of Decline Reservation</h3>
                            </div>
                            <button type="button" onclick="location.href='property-reservation?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
                            <button type="button" onclick="location.href='property-reservation?status=waiting'" class="archives btn-info"><i class='bx bxs-credit-card' ></i> Waiting</button>
                            <button type="button" onclick="location.href='property-reservation?status=accept'" class="archives btn-success"><i class='bx bxs-check-circle'></i> Accept</button>
                            <button type="button" onclick="location.href='property-reservation?status=decline'" class="archives btn-danger"><i class='bx bxs-shield-x'></i> Decline</button>

                            <!-- BODY -->
                            <section class="data-table">
                                <div class="searchBx">
                                    <input type="input" placeholder="Search . . . . . ." class="search" name="search_box3" id="search_box3"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
                                </div>

                                <div class="table">
                                    <div id="dynamic_content3">
                                    </div>

                            </section>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </main>
        </div>


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
    <script>
        //live search---------------------------------------------------------------------------------------//
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "tables/property-reservation-table.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function() {
                var query = $('#search_box').val();
                load_data(1, query);
            });

        });

        // //Waiting live search---------------------------------------------------------------------------------------//
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "tables/waiting-payment-table.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content1').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box1').val();
                load_data(page, query);
            });

            $('#search_box1').keyup(function() {
                var query = $('#search_box1').val();
                load_data(1, query);
            });

        });

        // //Accept live search---------------------------------------------------------------------------------------//
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "tables/accept-payment-table.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content2').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box2').val();
                load_data(page, query);
            });

            $('#search_box2').keyup(function() {
                var query = $('#search_box2').val();
                load_data(1, query);
            });

        });

        // //Decline live search---------------------------------------------------------------------------------------//
        $(document).ready(function() {

            load_data(1);

            function load_data(page, query = '') {
                $.ajax({
                    url: "tables/decline-payment-table.php",
                    method: "POST",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('#dynamic_content3').html(data);
                    }
                });
            }

            $(document).on('click', '.page-link', function() {
                var page = $(this).data('page_number');
                var query = $('#search_box3').val();
                load_data(page, query);
            });

            $('#search_box3').keyup(function() {
                var query = $('#search_box3').val();
                load_data(1, query);
            });

        });
    </script>

</body><!-- End of .page_wrapper -->

</html>