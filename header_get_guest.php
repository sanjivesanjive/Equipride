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
                            <div class="header-top-curr dropdown">
                                <!-- <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
                                        class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu">
                                    <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                                    <li><a class="dropdown-item" href="#">EUR €</a></li>
                                </ul> -->
                            </div>
                            <!-- Currency End -->
                            <!-- Language Start -->
                            <div class="header-top-lan dropdown">
                            <div id="google_translate_getguest"></div>
                                <script type="text/javascript">
                                function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_getguest');
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
                                        $userid = $_GET['guest_id'];
                                        $wishlist =mysqli_query($con,"SELECT * FROM `admin` WHERE `type` = 'guest' AND `userid` = '$userid'") or die(mysqli_error($con));
                                        $w = mysqli_fetch_array($wishlist);
                                        $guest =mysqli_query($con,"SELECT * FROM `guest` WHERE `userid` = '$userid'") or die(mysqli_error($con));
                                        $g = mysqli_fetch_array($guest);
                                        ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $g['name'] ?></a></li>
                                        <li><a class="dropdown-item" href="profile_get_guest.php?guest_id=<?php echo $userid; ?>">Profile</a></li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <?php 
                            $userid = $_GET['guest_id'];
                            $wishlist =mysqli_query($con,"SELECT * FROM `wishlist` WHERE `type` = 'Customer' AND `userid` = '$userid'") or die(mysqli_error($con));
                            $w = mysqli_num_rows($wishlist);
                            ?>
                            <a href="wishlist.php?guest_id=<?php echo $userid; ?>" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                <span class="ec-header-count"><?php echo $w ?></span>
                            </a>
                            <!-- Header Cart End -->
                            <!-- Header Cart Start -->
                            <?php 
                                        $userid = $_GET['guest_id'];
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
                                <a href="guest_get_panal.php?guest_id=<?php echo $userid; ?>"><img src="images/Logo editted.png" alt="Site Logo" /><img
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
                                <li><a href="guest_get_panal.php?guest_id=<?php echo $userid; ?>">Home</a></li>
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
                                                <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
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
                                                <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
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
                                                <li class="menu_title"><a href="category_get_guest.php?subcategory=<?php echo $r['category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $r['category'] ?></a></li>
                                                <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                                <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
                                                <?php }} ?>
                                            </ul>
                                            <?php }} ?>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="clearance_get_guest.php?guest_id=<?php echo $userid; ?>">Clearance</a></li>
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
                                        $userid = $_GET['guest_id'];
                                        $wishlist =mysqli_query($con,"SELECT * FROM `admin` WHERE `type` = 'guest' AND `userid` = '$userid'") or die(mysqli_error($con));
                                        $w = mysqli_fetch_array($wishlist);

                                        $guest =mysqli_query($con,"SELECT * FROM `guest` WHERE `userid` = '$userid'") or die(mysqli_error($con));
                                        $g = mysqli_fetch_array($guest);
                                        ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $g['name'] ?></a></li>
                                        <li><a class="dropdown-item" href="profile_get_guest.php?guest_id=<?php echo $userid; ?>">Profile</a></li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                                <!-- Header wishlist Start -->
                                <?php
                               $userid =$_SESSION['admin_id'];
                                $wishlist = mysqli_query($con,"SELECT * FROM `wishlist` WHERE `type` = 'Customer' AND `userid` = '$userid'") or die(mysqli_error($con));
                                $w=mysqli_num_rows($wishlist) ;
                                    ?>
                                <a href="wishlist_get_guest.php?guest_id=<?php echo $userid; ?>" class="ec-header-btn ec-header-wishlist">
                                    <div class="header-icon"><i class="fi-rr-heart"></i></div>
                                    <span class="ec-header-count"><?php echo $w ?></span>
                                </a>
                                <!-- Header wishlist End -->
                                <!-- Header Cart Start -->
                                <?php 
                                        $userid =$_SESSION['admin_id'];
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
                            <a href="guest_get_panal.php?guest_id=<?php echo $userid; ?>"><img src="images/Logo editted.png" alt="Site Logo" /><img
                                    class="dark-logo" src="images/Logo editted.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    <!-- Ec Header Search Start -->
                    <div class="col">
                        <!-- <div class="header-search">
                            <form class="ec-btn-group-form" action="#">
                                <input class="form-control ec-search-bar" placeholder="Search products..." type="text">
                                <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div> -->
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
                        <li><a href="guest_get_panal.php?guest_id=<?php echo $userid; ?>">Home</a></li>
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
                                        <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
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
                                        <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
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
                                <li><a href="category_get_guest.php?subcategory=<?php echo $r['category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $r['category'] ?></a>
                                    <ul class="sub-menu">
                                    <?php $category_id = $r['id'];
                                                $query1 = mysqli_query($con, "SELECT * FROM sub_category WHERE `category_id`='$category_id' AND `type_1` = 'Customer'");
                                                if (mysqli_num_rows($query1) > 0) {
                                                while ($q1 = mysqli_fetch_array($query1)) {
                                                    ?>
                                        <li><a href="category_get_guest.php?subcategory=<?php echo $q1['sub_category'] ?>&&guest_id=<?php echo $userid; ?>"><?php echo $q1['sub_category'] ?></a></li>
                                        <?php }} ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php }} ?>
                        </li>
                        
                        <li><a href="clearance_get_guest.php?guest_id=<?php echo $userid; ?>">Clearance</a></li>
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