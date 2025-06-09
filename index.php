<?php
include_once 'dashboard/user/authentication/user-forgot-password.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'configuration/header.php'; ?>
    <title>MAGRENT</title>
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
                            <a href="/CCSFP-MIDTERM/signin.php"><i class="fas fa-user"></i> Sign In</a>
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
                                        <li class="current"><a href=""><span>Home</span></a></li>
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
                        <li><a href=""><?php echo $config->getSystemEmail() ?></a></li>
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


        <!-- banner-section -->
        <section class="banner-section" style="background-image: url(src/images/banner/banner-1.jpeg);">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="content-box centred">
                        <h2>Find Your New Home Through Magrent</h2>
                        <p>In the heart of San Francisco Agusan Del Sur</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner-section end -->

        <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(src/images/shape/shape-9.png);"></div>
                <div class="pattern-2" style="background-image: url(src/images/shape/shape-10.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Find Home</h1>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <div class="auto-container" style="padding-top: 3rem;">
            <div class="inner-container">
                <div class="search-field">
                    <div class="tabs-box">
                        <div class="tabs-content info-group">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <div class="top-search">
                                        <form action="" method="post" class="search-form">
                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Search Property Name</label>
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input type="search" name="search-field" id="search-input-property" placeholder="Search Property Name..." required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Property Type</label>
                                                        <div class="select-box">
                                                            <select class="wide" name="property_type" id="property-type">
                                                                <option value="">All Property Type</option>
                                                                <option value="Apartment">Apartment</option>
                                                                <option value="House">House</option>
                                                                <option value="Lady's Bed Space">Lady's Bed Space</option>
                                                                <option value="Men's Bed Space">Men's Bed Space</option>
                                                                <option value="Dormitory">Dormitory</option>
                                                                <option value="Transient">Transient</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Bedrooms</label>
                                                        <div class="select-box">
                                                            <select class="wide" name="bedrooms" id="bedrooms">
                                                                <option value="">Max Rooms</option>
                                                                <option value="1">One Rooms</option>
                                                                <option value="2">Two Rooms</option>
                                                                <option value="3">Three Rooms</option>
                                                                <option value="4">Four Rooms</option>
                                                                <option value="5">Five Rooms</option>
                                                                <option value="6">Six Rooms</option>
                                                                <option value="7">Seven Rooms</option>
                                                                <option value="8">Eight Rooms</option>
                                                                <option value="9">Nine Rooms</option>
                                                                <option value="10">Ten Rooms</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="search-btn">
                                                <button type="button" onclick="searchProperties()"><i class="fas fa-search"></i>Search</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="switch_btn_one ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content clearfix">
                <!-- deals-style-two -->
                <section class="deals-style-two">
                    <div class="auto-container">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left" id="search-results-container">
                                <h5 id="search-results"><span>Showing 0 of 0 Listings</span></h5>
                            </div>
                        </div>
                        <div class="wrapper list">
                            <div class="deals-list-content list-item">
                                <?php
                                $stmt1 = $user->runQuery("SELECT * FROM property WHERE status=:status");
                                $stmt1->execute(array(":status" => "available"));
                                $propertyCount = $stmt1->rowCount();

                                if ($stmt1->rowCount() >= 1) {
                                    while ($property_data = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        extract($property_data);

                                        $stmt2 = $user->runQuery("SELECT * FROM property_gallery WHERE property_id=:property_id");
                                        $stmt2->execute(array(":property_id" => $property_data['id']));
                                        $property_gallery_data = $stmt2->fetch(PDO::FETCH_ASSOC);
                                ?>
                                        <div class="deals-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img src="src/images/property_gallery/<?php echo $property_gallery_data['picture_1'] ?>" style="height: 100%;" alt=""></figure>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text">
                                                        <h4><a id="property_name" onclick="setSessionValues(<?php echo $property_data['id'] ?>)"><?php echo $property_data['property_name'] ?></a></h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        <div class="price-info pull-left">
                                                            <h6>Start From</h6>
                                                            <h4>₱ <?php echo number_format($property_data['property_price']); ?></h4>
                                                        </div>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h6 id="property_type" style="display: none;">
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
                                                        </h6>
                                                        <h6>Property Type :
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
                                                        </h6>
                                                    </div>
                                                    <p><?php
                                                        $description = $property_data['property_description'];
                                                        $wordLimit = 20; // Set your desired word limit

                                                        // Explode the description into an array of words
                                                        $words = explode(' ', $description);

                                                        // Check if the number of words exceeds the limit
                                                        if (count($words) > $wordLimit) {
                                                            // Slice the array to get only the first $wordLimit words
                                                            $shortDescription = implode(' ', array_slice($words, 0, $wordLimit));

                                                            // Output the truncated description with "See more" link
                                                            echo '<p>' . $shortDescription . '... <a onclick="setSessionValues(' . $property_data['id'] . ')" style="color: #2dbe6c;">See more</a></p>';
                                                        } else {
                                                            // If the description is within the word limit, display the full description
                                                            echo '<p>' . $description . '</p>';
                                                        }
                                                        ?></p>

                                                    <ul class="more-details clearfix">
                                                        <li style="display: none;" id="bed_rooms"><?php echo $property_data['bedrooms'] ?></li>
                                                        <li><i class="icon-14"></i><?php echo $property_data['bedrooms'] ?> Beds</li>
                                                        <li><i class="icon-15"></i><?php echo $property_data['bathrooms'] ?> Baths</li>
                                                    </ul>
                                                    <div class="other-info-box clearfix" onclick="setSessionValues(<?php echo $property_data['id'] ?>)">
                                                        <div class="btn-box pull-left"><a onclick="setSessionValues(<?php echo $property_data['id'] ?>)" class="theme-btn btn-two">See Details</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                <?php
                                }

                                ?>
                            </div>

                        </div>
                        <div class="pagination-wrapper">
                            <ul id="pagination" class="pagination clearfix">
                                <li><a href="property-list.html" class="current">1</a></li>
                                <li><a href="property-list.html">2</a></li>
                                <li><a href="property-list.html">3</a></li>
                                <li><a href="property-list.html"><i class="fas fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- deals-style-two end -->
            </div>

        </div>
        <!-- page-content end -->

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
        function setSessionValues(propertyId) {
            fetch('dashboard/user/property-details.php?index=1', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'property_id=' + encodeURIComponent(propertyId),
                })
                .then(response => {
                    window.location.href = 'dashboard/user/property-details?index=1';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Function to handle property search
        function searchProperties() {
            var searchInput = document.getElementById('search-input-property').value.trim();
            var propertyType = document.getElementById('property-type').value;
            var bedRooms = document.getElementById('bedrooms').value;
            var propertyItems = document.querySelectorAll('.deals-block-one');

            propertyItems.forEach(function(item) {
                var propertyName = item.querySelector('#property_name').innerText.toLowerCase();
                var propertyTypeText = item.querySelector('#property_type').innerText.toLowerCase();
                var bedroomsTypeText = item.querySelector('#bed_rooms').innerText.toLowerCase();



                // Check if the property name and type match the search criteria
                var matchesSearch = propertyName.includes(searchInput.toLowerCase()) && (propertyType === '' || propertyTypeText.includes(propertyType.toLowerCase())) && (bedRooms === '' || bedroomsTypeText.includes(bedRooms.toLowerCase()));

                // Toggle the visibility of the property item based on the search result
                item.style.display = matchesSearch ? 'block' : 'none';
            });

            updateSearchResults();

        }

        function updateSearchResults() {
            var visibleListings = document.querySelectorAll('.deals-block-one:not([style*="display: none"])').length;
            var totalListings = document.querySelectorAll('.deals-block-one').length;

            var searchResultsContainer = document.getElementById('search-results-container');
            var searchResultsElement = document.getElementById('search-results');

            searchResultsElement.innerText = 'Showing ' + visibleListings + ' of ' + totalListings + ' Listings';
        }

        // Call the updateSearchResults function once the page loads and property list is displayed
        window.onload = function() {
            updateSearchResults();
        }
    </script>
    <?php include_once 'configuration/sweetalert.php'; ?>

</body><!-- End of .page_wrapper -->

</html>