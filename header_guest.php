<header class="ec-header">
        <!--Ec Header Top Start -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Top social Start -->
                    <div class="col text-left header-top-left d-none d-lg-block">
                        <div class="header-top-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item"><a class="hdr-facebook" href="https://www.facebook.com/equestrian.avenue.1"><i
                                            class="ecicon eci-facebook"></i></a></li>
                                <!-- <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                            class="ecicon eci-twitter"></i></a></li> -->
                                <li class="list-inline-item"><a class="hdr-instagram" href="https://www.instagram.com/equiprideltduk/"><i
                                            class="ecicon eci-instagram"></i></a></li>
                                <!-- <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                            class="ecicon eci-linkedin"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top social End -->
                    <!-- Header Top Message Start -->
                    <div class="col text-center header-top-center">
                        <div class="header-top-message text-upper">
                            <span>Free Shipping</span>Over all UK
                        </div>
                    </div>
                    <!-- Header Top Message End -->
                    <!-- Header Top Language Currency -->
                    <div class="col header-top-right d-none d-lg-block">
                        <div class="header-top-lan-curr d-flex justify-content-end">
                            <!-- Currency Start -->
                           <!-- Ec Header Search Start -->
                           <style>
                                #search-input {
                                    margin-bottom: 3px; /* Adjust the value as needed */
                                }

                                /* Add margin space above the dropdown div */
                                #search-results {
                                    margin-top: 3px; /* Adjust the value as needed */
                                    position: absolute;
                                    background-color: white;
                                    border: 1px solid #ccc;
                                    max-height: 200px; /* Set the maximum height for the dropdown */
                                    overflow-y: auto; /* Enable vertical scrolling if needed */
                                    display: none;
                                    z-index: 1;
                                }

                                /* Style each item in the dropdown */
                                .results-container div {
                                    padding: 5px;
                                    cursor: pointer;
                                }

                                /* Highlight the selected item */
                                .results-container div:hover {
                                    background-color: #f2f2f2;
                                }
                            </style>

                            
                            <div class="align-self-center ec-header-search">
                                <div class="header-search">
                                    <form class="ec-search-group-form" id="search-form">
                                        <input class="form-control" id="search-input" placeholder="Search Your Products..." type="text" style="border-radius: 37px; !important; position: relative;">
                                        <span style="position: absolute; top: 13px; right: 12px;"><i class="fi-rr-search"></i></span>

                                    </form>
                                    <div id="search-results" class="results-container"></div>
                                </div>
                            </div>
                        <!-- Ec Header Search End -->
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <div class="header-top-lan dropdown">
                            <div id="google_translate_guestmobile"></div>
                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_guestmobile');
                                }
                                </script>

                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div>
                            <!-- Language End -->

                        </div>
                    </div>
                    <!-- Header Top Language Currency -->
                    <!-- Header Top responsive Action -->
                    <div class="col d-lg-none ">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><i
                                        class="fi-rr-user"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                <?php 
                                        $userid = $_SESSION['admin_id'];
                                        $wishlist =mysqli_query($con,"SELECT * FROM `admin` WHERE `type` = 'user' AND `userid` = '$userid'") or die(mysqli_error($con));
                                        $w = mysqli_fetch_array($wishlist);
                                        $guest =mysqli_query($con,"SELECT * FROM `guest` WHERE `userid` = '$userid'") or die(mysqli_error($con));
                                        $g = mysqli_fetch_array($guest);
                                        ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $g['name'] ?></a></li>
                                        <li><a class="dropdown-item" href="profile_guest.php">Profile</a></li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                           
                            <a href="wishlist_guest.php" class="ec-header-btn ec-header-wishlist" id="wishlist-link">
                                <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                <span class="ec-header-count" id="myspan2"></span>
                            </a>
                            <!-- Header Cart End -->
                            <!-- Header Cart Start -->
                            <?php 
                                        $userid = $_SESSION['admin_id'];
                                        $cart =mysqli_query($con,"SELECT * FROM `cart` WHERE `userid` = '$userid' AND `status`= '1'") or die(mysqli_error($con));
                                        $c = mysqli_num_rows($cart);
                                        // print_r($w);
                                        ?>
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                                <span class="ec-header-count cart-count-lable"><?php echo $c ?></span>
                            </a>
                            <!-- Header Cart End -->
                            <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                                <i class="fi fi-rr-apps"></i>
                            </a>
                            <!-- Header menu Start -->
                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                                <i class="fi fi-rr-menu-burger"></i>
                            </a>
                            <!-- Header menu End -->
                                                            <!-- Header User Start -->
                                                            <div class="ec-header-user dropdown">
                                    <a class="dropdown-item" href="logout.php"><i class="fi fi-rr-sign-out-alt"></i></a>
                                </div>
                                <!-- Header User End -->
                        </div>
                    </div>
                    <!-- Header Top responsive Action -->
                </div>
            </div>
        </div>
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center">
                            <div class="header-logo">
                                <a href="guest_panal.php"><img src="images/Logo editted.png" alt="Site Logo" /><img
                                        class="dark-logo" src="images/Logo editted.png" alt="Site Logo"
                                        style="display: none;" /></a>
                            </div>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">
<!-- EC Main Menu Start -->
<div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="ec-main-menu">
                            <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                                <i class="fi fi-rr-apps"></i>
                            </a>
                            <ul>
                                <li><a href="guest_panal.php">Home</a></li>
                                <li class="dropdown position-static"><a href="javascript:void(0)">Rider</a>
                                    <ul class="mega-menu d-block" style="position: absolute;width: 305%;left: -100%;">
                                        <li class="d-flex">
                                        <?php
                                                $rider = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Rider' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($rider) > 0) {
                                                while ($r = mysqli_fetch_array($rider)) {
                                                    ?>
                                            <ul class="d-block">
                                                <li class="menu_title"><a href="javascript:void(0)"><?php echo $r['category'] ?></a></li>
                                                <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer' AND `type` ='Rider'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                                <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                                <?php }} ?>
                                            </ul>
                                            <?php }} ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown position-static"><a href="javascript:void(0)">Horse</a>
                                    <ul class="mega-menu d-block" style="position: absolute;width: 305%;left: -100%;">
                                        <li class="d-flex">
                                        <?php
                                                $horse = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Horse' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($horse) > 0) {
                                                while ($r = mysqli_fetch_array($horse)) {
                                                    ?>
                                            <ul class="d-block">
                                                <li class="menu_title"><a href="javascript:void(0)"><?php echo $r['category'] ?></a></li>
                                                <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer' AND `type`='Horse'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                                <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                                <?php }} ?>
                                            </ul>
                                            <?php }} ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown position-static"><a href="javascript:void(0)">DOG</a>
                                    <ul class="mega-menu d-block" style="position: absolute;width: 305%;left: -100%;">
                                        <li class="d-flex">
                                        <?php
                                                $rider = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Dog' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($rider) > 0) {
                                                while ($r = mysqli_fetch_array($rider)) {
                                                    ?>
                                            <ul class="d-block">
                                                <li class="menu_title"><a href="category_guest.php?subcategory=<?php echo $r['category'] ?>"><?php echo $r['category'] ?></a></li>
                                                <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                                <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                                <?php }} ?>
                                            </ul>
                                            <?php }} ?>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="clearance_guest.php">Clearance</a></li>
                                <li><a href="my_order_guest.php">My Orders</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Main Menu End -->
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                    <?php 
                                        $userid = $_SESSION['admin_id'];
                                        $wishlist =mysqli_query($con,"SELECT * FROM `admin` WHERE `type` = 'user' AND `userid` = '$userid'") or die(mysqli_error($con));
                                        $w = mysqli_fetch_array($wishlist);
                                        $guest =mysqli_query($con,"SELECT * FROM `guest` WHERE `userid` = '$userid'") or die(mysqli_error($con));
                                        $g = mysqli_fetch_array($guest);
                                        ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $g['name'] ?></a></li>
                                        <li><a class="dropdown-item" href="profile_guest.php">Profile</a></li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                                <!-- Header wishlist Start -->
                                
                                <a href="wishlist_guest.php" class="ec-header-btn ec-header-wishlist">
                                    <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                    <span class="ec-header-count" id="mySpan"></span>
                                </a>
                                <!-- Header wishlist End -->
                                <!-- Header Cart Start -->
                                <?php 
                                        $userid = $_SESSION['admin_id'];
                                        $cart =mysqli_query($con,"SELECT * FROM `cart` WHERE `userid` = '$userid' AND `status`= '1'") or die(mysqli_error($con));
                                        $c = mysqli_num_rows($cart);
                                        // print_r($w);
                                        ?>
                                <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                    <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
                                    <span class="ec-header-count cart-count-lable"><?php echo $c ?></span>
                                </a>
                                <!-- Header Cart End -->
                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <a class="dropdown-item" href="logout.php"><i class="fi fi-rr-sign-out-alt"></i></a>
                                </div>
                                <!-- Header User End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row ">

                    <!-- Ec Header Logo Start -->
                    <div class="col">
                        <div class="header-logo">
                            <a href="guest_panal.php"><img src="images/Logo editted.png" alt="Site Logo" /><img
                                    class="dark-logo" src="images/Logo editted.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    
                    <style>
                        #responsive-search-input {
                            margin-bottom: 3px;
                        }

                        #responsive-search-results {
                            margin-top: 3px;
                            position: absolute;
                            background-color: white;
                            border: 1px solid #ccc;
                            max-height: 200px;
                            overflow-y: auto;
                            display: none;
                            z-index: 1;
                        }

                        .results-container div {
                            padding: 5px;
                            cursor: pointer;
                        }

                        .results-container div:hover {
                            background-color: #f2f2f2;
                        }
                    </style>

                    <div class="align-self-center ec-header-search responsive-search-container">
                        <div class="header-search">
                            <form class="ec-search-group-form" id="responsive-search-form">
                                <input class="form-control" id="responsive-search-input" placeholder="Search for Products ..." type="text" style="border-radius: 37px; !important; position: relative;">
                                <span style="position: absolute; top: 13px; right: 12px;"><i class="fi-rr-search"></i></span>
                            </form>
                            <div id="responsive-search-results" class="results-container"></div>
                        </div>
                    </div>

                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->
        
        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">My Menu</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="user_panal.php">Home</a></li>
                        <li><a href="javascript:void(0)">Rider</a>
                        <?php
                                                $rider = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Rider' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($rider) > 0) {
                                                while ($r = mysqli_fetch_array($rider)) {
                                                    ?>
                            <ul class="sub-menu">
                                <li>
                                    <a href="javascript:void(0)"><?php echo $r['category'] ?></a>
                                    <ul class="sub-menu">
                                    <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer' AND `type` ='Rider'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                        <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                        <?php }} ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php }} ?>
                        </li>
                        <li><a href="javascript:void(0)">Horse</a>
                        <?php
                                                $horse = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Horse' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($horse) > 0) {
                                                while ($r = mysqli_fetch_array($horse)) {
                                                    ?>
                            <ul class="sub-menu">
                                <li><a href="javascript:void(0)"><?php echo $r['category'] ?></a>
                                    <ul class="sub-menu">
                                    <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer' AND `type`='Horse'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                        <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                        <?php }} ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php }} ?>
                        </li>
                        <li><a href="javascript:void(0)">DOG</a>
                        <?php
                                                $rider = mysqli_query($con, "SELECT * FROM `category` WHERE `type`='Dog' AND `type_1` = 'Customer' ") or die(mysqli_error($con));
                                                if (mysqli_num_rows($rider) > 0) {
                                                while ($r = mysqli_fetch_array($rider)) {
                                                    ?>
                            <ul class="sub-menu">
                                <li><a href="category_guest.php?subcategory=<?php echo $r['category'] ?>"><?php echo $r['category'] ?></a>
                                    <ul class="sub-menu">
                                    <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                        <li><a href="category_guest.php?subcategory=<?php echo $q1['sub_category'] ?>"><?php echo $q1['sub_category'] ?></a></li>
                                        <?php }} ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php }} ?>
                        </li>
                        
                        <li><a href="clearance_guest.php">Clearance</a></li>
                    </ul>
                </div>
                <div class="header-res-lan-curr">
                    <div class="header-top-lan-curr">
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                        <div id="google_translate_mobile"></div>
                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_mobile');
                                }
                                </script>

                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div>
                        </div>
                        <!-- Language End -->
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <!-- <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                                <li><a class="dropdown-item" href="#">EUR €</a></li>
                            </ul> -->
                        </div>
                        <!-- Currency End -->
                    </div>
                    <!-- Social Start -->
                    <div class="header-res-social">
                        <div class="header-top-social">
                            <!-- <ul class="mb-0">
                                <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                            class="ecicon eci-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                            class="ecicon eci-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                            class="ecicon eci-instagram"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                            class="ecicon eci-linkedin"></i></a></li>
                            </ul> -->
                        </div>
                    </div>
                    <!-- Social End -->
                </div>
            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>