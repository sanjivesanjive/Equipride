<?php
include ('connection.php');
// $id = $_GET['id'];
// $product_id = $_GET['product_id'];
// $sub_category_guest = $_GET['subcategory_guest'];

$userid = $_SESSION['admin_id'];

if (isset($_POST['wishlist'])) {
    //print_r($_POST);
  
    $product_id = $_POST['product_id'];
    $p_name = $_POST['p_name'];
    $file = $_POST['file'];
    $price = $_POST['price'];
  
    $query = "INSERT INTO `wishlist`( `userid`,`product_id`,`p_name`,`file` ,`price`,`type`,`status`) VALUES ('$userid','" . $product_id . "','" . $p_name . "','" . $file . "','" . $price . "','Customer','1')";
    mysqli_query($con, $query) or die(mysqli_error($con));
  
    ?>
    <script type="text/javascript">
      alert("You Have Add To Wishlist Successfully");
      window.location = "guest_panal.php";
    </script>
    <?php
  
  }
?>
 <!DOCTYPE html>
 <html lang="en">
 
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="x-ua-compatible" content="ie=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
 
     <title><?php echo $title ?></title>
     <meta name="keywords"
         content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
     <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
     <meta name="author" content="ashishmaraviya">
 
     <!-- site Favicon -->
     <link rel="icon" href="images/Logo editted.png" sizes="32x32" />
     <link rel="apple-touch-icon" href="images/Logo editted.png" />
     <meta name="msapplication-TileImage" content="images/Logo editted.png" />
 
     <!-- css Icon Font -->
     <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />
 
     <!-- css All Plugins Files -->
     <link rel="stylesheet" href="assets/css/plugins/animate.css" />
     <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
     <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
     <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
     <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
     <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />
     <link rel="stylesheet" href="assets/css/plugins/nouislider.css" />
 
     <!-- Main Style -->
     <link rel="stylesheet" href="assets/css/style.css" />
     <link rel="stylesheet" href="assets/css/responsive.css" />
 
     <!-- Background css -->
     <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
 </head>
<body class="shop_page">
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Header start  -->
    <?php include ('header_guest.php'); ?>

    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <?php include 'cart_box_guest.php' ?>

    <!-- ekka Cart End -->

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Clearance Sale</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="guest_panal.php">Home</a></li>
                                <li class="ec-breadcrumb-item active">Clearance</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Shop page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-12 col-md-12">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <!-- <button class="btn sidebar-toggle-icon"><i class="fi-rr-filter"></i></button> -->
                                <button class="btn btn-grid-50 active"><i class="fi-rr-apps"></i></button>
                                <button class="btn btn-list-50"><i class="fi-rr-list"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
                            <?php 
                                $product_category =  mysqli_query($con, "SELECT * FROM `product` WHERE `type_1`='Customer' AND `clearance_status`='salenow' ") or die(mysqli_error($con));
                                if (mysqli_num_rows($product_category) > 0) {
                                while ($pc = mysqli_fetch_array($product_category)) {
                                    $product_id = $pc['product_id'];
                                    ?>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image" style="height: 363px !important;">
                                                <a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>" >
                                                    <img class="main-image" src="admin/file/<?php echo $pc['file'] ?>"
                                                        alt="Product" />
                                                    <!-- <img class="hover-image" src="admin/file/<?php echo $pc['file'] ?>"
                                                        alt="Product" /> -->
                                                </a>
                                                <div class="ec-pro-actions">
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $pc['product_id'] ?>"><i class="fi-rr-eye"></i></a>
                                                    <!-- <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                    <button title="Add To Cart" class="add-to-cart"><i
                                                            class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                                            <form method="POST" enctype="multipart/form-data" >
                                                                        <input type="hidden" name="file" value="<?php echo $pc['file'] ?>">
                                                                        <input type="hidden" name="product_id" value="<?php echo $pc['product_id'] ?>">
                                                                        <input type="hidden" name="p_name" value="<?php echo $pc['name'] ?>">
                                                                        <input type="hidden" name="price" value="<?php echo $pc['price'] ?>">
                                                                        <button title="Wishlist" type="submit" name="wishlist" class="ec-btn-group wishlist"><i class="fi-rr-heart"></i> </button>
                                                                    <!-- <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a> -->
                                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></h5>
                                            <div class="ec-pro-list-desc"><?php echo $pc['description'] ?>
                                            </div>
                                            <span class="ec-price">
                                                <span class="new-price">£<?php echo $pc['clearance'] ?></span>
                                            </span>
                                            <div class="ec-pro-option">
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                  <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal<?php echo $pc['product_id'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $pc['file'] ?>" alt="">
                                </div>
                                <?php
                                            $image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $i['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <?php
                                            $image1 = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image1) > 0) {
                                                while ($i1 = mysqli_fetch_array($image1)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $i1['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <!-- <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div> -->
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $pc['file'] ?>" alt="">
                                </div>
                                <?php
                                            $image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $i['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <?php
                                            $image1 = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image1) > 0) {
                                                while ($i1 = mysqli_fetch_array($image1)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $i1['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <!-- <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></h5>


                                <div class="ec-quickview-desc"><?php echo $pc['description'] ?></div>
                                <div class="ec-quickview-price">
                                £<span class="new-price"><?php echo $pc['dealer_price'] ?></span>
                                </div>

                                <!-- <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-size">
                                        <span>Size</span>
                                        <div class="ec-pro-variation-content">
                                            <ul>
                                                <li><span>250 g</span></li>
                                                <li><span>500 g</span></li>
                                                <li><span>1 kg</span></li>
                                                <li><span>2 kg</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                    <a class="btn btn-primary" href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>">View Product</a>
                                        <!-- <button class="btn btn-primary">Add To Cart</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
                                <?php }} ?>
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <!-- <div class="ec-pro-pagination">
                            <span>Showing 1-12 of 21 item(s)</span>
                            <ul class="ec-pro-pagination-inner">
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a class="next" href="#">Next <i class="ecicon eci-angle-right"></i></a></li>
                            </ul>
                        </div> -->
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="filter-sidebar-overlay"></div>
                <div class="ec-shop-leftside filter-sidebar">
                    <div class="ec-sidebar-heading">
                        <h1>Filter Products By</h1>
                        <a class="filter-cls-btn" href="javascript:void(0)">×</a>
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Category</h3>
                            </div>
                            <?php
                                                    $category = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Customer'  GROUP BY `sub_category`") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($category) > 0) {
                                                    while ($c = mysqli_fetch_array($category)) {
                                                        $sub_category = $c['product_id'];
                                                        ?>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" checked /> <a href="category_guest.php?subcategory=<?php echo $c['sub_category'] ?>"><?php echo $c['sub_category'] ?></a><span></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php }} ?>
                        </div>
                        <!-- Sidebar Size Block -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Shop page -->

    <!-- Footer Start -->
    <?php include ('footer_guest.php'); ?>
    <!-- Footer Area End -->


    <!-- Footer navigation panel for responsive display -->
    <?php include 'mobilebar_guest.php' ?>

    <!-- Footer navigation panel for responsive display end -->

    <!-- Recent Purchase Popup  -->
    <!-- <div class="recent-purchase">
        <img src="assets/images/product-image/1.jpg" alt="payment image">
        <div class="detail">
            <p>Someone in new just bought</p>
            <h6>stylish baby shoes</h6>
            <p>10 Minutes ago</p>
        </div>
        <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
    </div> -->
    <!-- Recent Purchase Popup end -->

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
            <div class="header-icon"><i class="fi-rr-shopping-basket"></i>
            </div>
            <span class="ec-cart-count cart-count-lable">3</span>
        </a>
    </div>
    <!-- Cart Floating Button end -->

    <!-- Whatsapp -->
    <div class="ec-style ec-right-bottom">
        <!-- Start Floating Panel Container -->
        <div class="ec-panel">
            <!-- Panel Header -->
            <div class="ec-header">
                <strong>Need Help?</strong>
                <p>Chat with us on WhatsApp</p>
            </div>
            <!-- Panel Content -->
            <div class="ec-body">
                <ul>
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_01.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Sahar Darya</span>
                                    <p>Sahar left 7 mins ago</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_02.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-online"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Yolduz Rafi</span>
                                    <p>Yolduz is online</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_03.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-offline"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Nargis Hawa</span>
                                    <p>Nargis left 30 mins ago</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                    <!-- Start Single Contact List -->
                    <li>
                        <a class="ec-list" data-number="918866774266"
                            data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                            <div class="d-flex bd-highlight">
                                <!-- Profile Picture -->
                                <div class="ec-img-cont">
                                    <img src="assets/images/whatsapp/profile_04.jpg" class="ec-user-img"
                                        alt="Profile image">
                                    <span class="ec-status-icon ec-offline"></span>
                                </div>
                                <!-- Display Name & Last Seen -->
                                <div class="ec-user-info">
                                    <span>Khadija Mehr</span>
                                    <p>Khadija left 50 mins ago</p>
                                </div>
                                <!-- Chat iCon -->
                                <div class="ec-chat-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!--/ End Single Contact List -->
                </ul>
            </div>
        </div>
        <!--/ End Floating Panel Container -->
        <!-- Start Right Floating Button-->

        <!--/ End Right Floating Button-->
    </div>
    <!-- Whatsapp end -->

    <!-- Feature tools -->
    <?php include 'feature.php' ?>

    <!-- Feature tools end -->

    <!-- Vendor JS -->
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/countdownTimer.min.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/infiniteslidev2.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="assets/js/plugins/nouislider.js"></script>
    <!-- Google translate Js -->
    <script src="assets/js/vendor/google-translate.js"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
    </script>
    <!-- Main Js -->
    <script src="assets/js/vendor/index.js"></script>
    <script src="assets/js/main.js"></script>

</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>