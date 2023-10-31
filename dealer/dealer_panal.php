<?php 
include ('../connection.php');

$setting = mysqli_query($con, "SELECT * FROM `home_page_config` WHERE `type` = 'Dealer' ") or die(mysqli_error($con));
$s = mysqli_fetch_array($setting);

$saddle = mysqli_query($con, "SELECT * FROM `category` WHERE `type_1` = 'Customer' AND `id` = '39' ") or die(mysqli_error($con));
$sc = mysqli_fetch_array($saddle);

$userid = $_SESSION['admin_id'];

if (isset($_POST['wishlist'])) {
  //print_r($_POST);

  $product_id = $_POST['product_id'];
  $p_name = $_POST['p_name'];
  $file = $_POST['file'];
  $price = $_POST['price'];

  $query = "INSERT INTO `wishlist`( `userid`,`product_id`,`p_name`,`file` ,`price`,`type`,`status`) VALUES ('$userid','" . $product_id . "','" . $p_name . "','" . $file . "','" . $price . "','Dealer','1')";
  mysqli_query($con, $query) or die(mysqli_error($con));

  ?>
  <script type="text/javascript">
    alert("You Have Add To Wishlist Successfully");
    window.location = "dealer_panal.php";
  </script>
  <?php

}
$dealer = mysqli_query($con, "SELECT * FROM `register_dealer` WHERE `userid` = '$userid' ") or die(mysqli_error($con));
$d = mysqli_fetch_array($dealer);

if(isset($_POST['subscribe'])){
    $to = $_POST['email']; // this is your Email address
    $from = "info@scratchsoftwaresolutions.com"; // this is the sender's Email address
    $name = $d['userid'];
    $last_name = $d['name'];
    $subject = "hello";
    $subject2 = "hello";
    $message = $name . " " . $last_name . " wrote the following:" . "\n\n" . " Subscribe the equipride to get in touch and get the future update. ";
    $message2 = "hello1 " . $name . "\n\n" . " new news letter";

    $headers = "from:" . $from;
    $headers2 = "from:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    // echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    header('Location: dealer_panal.php');
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.
    }
?>
 <!DOCTYPE html>
 <html lang="en">
 
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <title><?php echo $title ?></title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">
    
   <!-- site Favicon -->
   <link rel="icon" href="images/Logo editted.png" sizes="32x32" />
   <link rel="apple-touch-icon" href="assets/images/favicon/favicon-8.png" />
   <meta name="msapplication-TileImage" content="assets/images/favicon/favicon-8.png" />

   <!-- css Icon Font -->
   <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

   <!-- css All Plugins Files -->
   <link rel="stylesheet" href="assets/css/plugins/animate.css" />
   <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
   <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
   <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
   <link rel="stylesheet" href="assets/css/plugins/nouislider.css" />
   <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
   <link rel="stylesheet" href="assets/css/plugins/owl.carousel.min.css" />
   <link rel="stylesheet" href="assets/css/plugins/owl.theme.default.min.css" />
   <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

   <!-- Main Style -->
   <link rel="stylesheet" href="assets/css/demo8.css" />
   
</head>
<body>
    <div id="ec-overlay">
        <div class="ec-ellipsis">
        <span><img class="logo" src="images/Logo editted.png"
          alt="logo-white" style="max-width: 232% !important;" /></span>
        </div>
    </div>

    <!-- Header start  -->
    <?php include ('header.php');?>
    <!-- Header End  -->

    <!-- Ekka Cart Start -->
    <?php include 'cart_box.php' ?>
    <!-- Ekka Cart End -->

    <!-- Main Slider Start -->
    <div class="ec-main-slider section section-space-pb">
        <div class="container">
            <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">
                <div class="ec-slide-item swiper-slide d-flex slide-1">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-sm-12 align-self-center">
                                <div class="ec-slide-content slider-animation">
                                    <h2 class="ec-slide-stitle">Sale offer</h2>
                                    <h1 class="ec-slide-title"><?php echo $s['title_1'] ?></h1>
                                    <div class="ec-slide-desc">
                                        <a href="category.php?subcategory=<?php echo $sc['category']?>" class="btn btn-lg btn-primary">Shop Now <i
                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex slide-2">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-sm-12 align-self-center">
                                <div class="ec-slide-content slider-animation">
                                    <h2 class="ec-slide-stitle"><?php echo $s['title_2'] ?></h2>
                                    <h1 class="ec-slide-title"><?php echo $s['contant_2'] ?></h1>
                                    <div class="ec-slide-desc">
                                        <a href="full_category.php" class="btn btn-lg btn-primary">Shop Now <i
                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex slide-3">
                    <div class="container align-self-center">
                        <div class="row">
                            <div class="col-sm-12 align-self-center">
                                <div class="ec-slide-content slider-animation">
                                    <h2 class="ec-slide-stitle"><?php echo $s['title_3'] ?></h2>
                                    <h1 class="ec-slide-title"><?php echo $s['contant_3'] ?></h1>
                                    <div class="ec-slide-desc">
                                        <a href="category.php?subcategory=<?php echo $sc['category']?>" class="btn btn-lg btn-primary">Shop Now <i
                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            </div>
    </div>
    </div>  
    <!-- Main Slider End -->

    <!--  category Section Start -->
    <!--category Section End -->
    
    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p">
        <div class="container">
            <div class="row">

                <!-- Sidebar area start -->
                <div class="ec-side-cat-overlay"></div>
                    <div class="col-lg-3 sidebar-dis-991" data-animation="fadeIn">
                        <div class="cat-sidebar">
                            <div class="cat-sidebar-box">
                                <div class="ec-sidebar-wrap">
                                    <!-- Sidebar Category Block -->
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Category<button class="ec-close">×</button></h3>
                                        </div>
                                        <?php
                                                    $category = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Dealer'  GROUP BY `category`") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($category) > 0) {
                                                    while ($c = mysqli_fetch_array($category)) {
                                                        $sub_category = $c['category'];
                                                        ?>
                                        <div class="ec-sb-block-content">
                                            <ul>
                                                <li>
                                                    <div class="ec-sidebar-block-item"><img src="assets/images/icons/dress-8.png" class="svg_img" alt="drink" /><?php echo $c['category'] ?></div>
                                                    <ul>
                                                    <?php
                                                    $scategory = mysqli_query($con, "SELECT * FROM `product` WHERE `category` = '$sub_category' AND `type_1` = 'Dealer' GROUP BY `sub_category`") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($scategory) > 0) {
                                                    while ($sc = mysqli_fetch_array($scategory)) {
                                                        ?>
                                                        <li>
                                                            <div class="ec-sidebar-sub-item"><a href="category.php?subcategory=<?php echo $sc['sub_category'] ?>"><?php echo $sc['sub_category'] ?> <span title="Available Stock"></span></a>
                                                            </div>
                                                        </li>
                                                        <?php }} ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php }} ?>

                                    </div>
                                    <!-- Sidebar Category Block -->
                                    <!-- Sidebar Price Block -->
                                </div>
                            </div>
                        </div>
                </div> 

                <!-- Product area start -->
                <div class="col-lg-9 col-md-12">
 
                    <!-- ec New Arrivals, ec Trending, ec Top Rated Start -->
                    <div class="row">
                        <!-- ec New Arrivals -->
                        <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title">New Arrivals</h2>
                                </div>
                            </div>
                        <?php
                                                    $product = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Dealer' ORDER BY `product`.`id` ASC LIMIT 21; ") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($product) > 0) {
                                                    while ($p = mysqli_fetch_array($product)) {
                                                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content margin-b-30" data-animation="fadeIn">

                            <div class="ec-new-slider">
                                <div class="col-sm-12 ec-all-product-block">
                                    <div class="ec-all-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="product_details.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>" class="image">
                                                    <img class="main-image" src="../admin/file/<?php echo $p['file'] ?> "
                                                        alt="Product" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <h5 class="ec-pro-title"><a href="product_details.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>"><?php echo $p['name'] ?></a></h5>
                                            <h6 class="ec-pro-stitle"><a href="product_details.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>"><?php echo $p['sub_category'] ?></a></h6>
                                            <div class="ec-pro-rat-price">
                                                <div class="ec-pro-rat-pri-inner">
                                                    <span class="ec-price">
                                                        <span class="new-price">£<?php echo $p['dealer_price'] ?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                        <!-- ec Trending -->
                    </div>
                    <!-- ec New Arrivals, ec Trending, ec Top Rated end -->

                    <!-- Deal of the day Start -->
                    <div class="row space-t-50" data-animation="fadeIn">
                        <!--  Special Section Start -->
                        <div class="ec-spe-section col-lg-12 col-md-12 col-sm-12 sectopn-spc-mb">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title">Clearance</h2>
                                </div>
                            </div>

                            <div class="ec-spe-products">
                            <?php
    $clearance = mysqli_query($con, "SELECT * FROM `product` WHERE `clearance_status` = 'salenow' ORDER BY `product`.`id` ASC LIMIT 4; ") or die(mysqli_error($con));
        if (mysqli_num_rows($clearance) > 0) {
            while ($cl = mysqli_fetch_array($clearance)) {
                ?>
                                <div class="ec-spe-product">
                                    <div class="ec-spe-pro-inner">
                                        <div class="ec-spe-pro-image-outer col-md-6 col-sm-12">
                                            <div class="ec-spe-pro-image">
                                                <img class="img-responsive" src="../admin/file/<?php echo $cl['file'] ?>" alt="clearance">                                                                              
                                            </div>
                                        </div>
                                        <div class="ec-spe-pro-content col-md-6 col-sm-12">
                                            <h5 class="ec-spe-pro-title"><a href="product_details.php?id=<?php echo $cl['id'] ?>&&product_id=<?php echo $cl['product_id'] ?>"><?php echo $cl['name'] ?></a></h5>
                                            <div class="ec-spe-pro-desc"><?php echo $cl['description'] ?></div>
                                            <div class="ec-spe-price">
                                                <span class="new-price">£<?php echo $cl['clearance'] ?></span>
                                            </div>
                                            <!-- <div class="ec-spe-pro-btn">
                                                <a href="#" class="btn btn-lg btn-primary">Add To Cart</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <?php }} ?>
                            </div>
                        </div>
                        <!--  Special Section End -->
                    </div>
                    <!-- Deal of the day end -->

                    <!-- Product tab area start -->
                    <div class="row space-t-50">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2 class="ec-title">New Products</h2>
                            </div>
                        </div>

                        <!-- Tab Start -->
                        <div class="col-md-12 ec-pro-tab">
                            <ul class="ec-pro-tab-nav nav justify-content-end">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                        href="#all">All</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#clothes">Outer Clothing</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                        href="#footwear">Horse Rugs</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#accessories">Accessories</a></li> -->
                            </ul>
                        </div>
                        <!-- Tab End -->
                    </div>
                    <div class="row margin-minus-b-15">
                        <div class="col">
                            <div class="tab-content">
                                <!-- 1st Product tab start -->
                                <div class="tab-pane fade show active" id="all">
                                    <div class="row">
                                    <?php
                                                    $product_grid = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Dealer' ORDER BY `product`.`id` DESC LIMIT 8; ") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($product_grid) > 0) {
                                                    while ($pg = mysqli_fetch_array($product_grid)) {
                                                        $model = $pg['product_id'];
                                                        ?>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image" style="height: 272px !important;">
                                                    <a href="product_details.php?id=<?php echo $pg['id'] ?>&&product_id=<?php echo $pg['product_id'] ?>" >
                                                            <img class="main-image"
                                                                src="../admin/file/<?php echo $pg['file'] ?>" alt="Product" />
                                                            <!-- <img class="hover-image"
                                                                src="../admin/file/<?php echo $pg['file'] ?>" alt="Product" /> -->
                                                        </a>
                                                        <div class="ec-pro-actions">
                                                        <form method="POST" enctype="multipart/form-data" >
                                                                        <input type="hidden" name="file" value="<?php echo $pg['file'] ?>">
                                                                        <input type="hidden" name="product_id" value="<?php echo $pg['product_id'] ?>">
                                                                        <input type="hidden" name="p_name" value="<?php echo $pg['name'] ?>">
                                                                        <input type="hidden" name="price" value="<?php echo $pg['price'] ?>">
                                                                        <button title="Wishlist" type="submit" name="wishlist" class="ec-btn-group wishlist"><i class="fi-rr-heart"></i> </button>
                                                                    <!-- <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a> -->
                                                                    </form>
                                                            <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="Quick view"
                                                                data-bs-toggle="modal" data-bs-target="#ec_quickview_modal<?php echo $model ?>"><i class="fi-rr-eye"></i></a>
                                                            <!-- <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                            <a href="javascript:void(0)"  title="Add To Cart" class="ec-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <a href="product_details.php?id=<?php echo $pg['id'] ?>&&product_id=<?php echo $pg['product_id'] ?>"><h6 class="ec-pro-stitle"><?php echo $pg['name'] ?></h6></a> 
                                                    <h5 class="ec-pro-title"><a href="product_details.php?id=<?php echo $pg['id'] ?>&&product_id=<?php echo $pg['product_id'] ?>"><?php echo $pg['sub_category'] ?></a></h5>
                                                    <div class="ec-pro-rat-price">
                                                        <span class="ec-price">
                                                            <span class="new-price">£<?php echo $pg['dealer_price'] ?></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal<?php echo $model ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $pg['file'] ?>" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $pg['file'] ?>" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/93_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/94_2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product_details.php?id=<?php echo $pg['id'] ?>&&product_id=<?php echo $pg['product_id'] ?>"><?php echo $pg['name'] ?></a></h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>

                                <div class="ec-quickview-desc"><?php echo $pg['description'] ?></div>
                                <div class="ec-quickview-price">
                                    <span class="new-price">£<?php echo $pg['dealer_price'] ?></span>
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
                                        <button class="btn btn-primary">Add To Cart</button>
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
                                <!-- ec 1st Product tab end -->
                                <!-- ec 2nd Product tab start -->
                                
                                <!-- ec 3rd Product tab end -->
                            </div>
                        </div>
                    </div>
                    <!-- Product tab area end -->

                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!--  Testimonial, Banner & Service Section Start -->
    <section class="section ec-ser-spe-section section-space-p">
        <div class="container" data-animation="fadeIn">
            <div class="row">
                <!-- ec Testimonial Start -->
                <div class="ec-test-section col-lg-3 col-md-6 col-sm-12 col-xs-6 sectopn-spc-mb" data-animation="slideInRight" style="padding-top : 76px;">
                    <div class="col-md-12">
                        <div class="section-title">
                            <!-- <h2 class="ec-title">Testimonial</h2> -->
                        </div>
                    </div>
                    <div class="ec-test-outer">
                        <ul id="ec-testimonial-slider">
                            <li class="ec-test-item">
                                <div class="ec-test-inner">
                                    <div class="ec-test-img">
                                        <!-- <img alt="testimonial" title="testimonial"
                                            src="assets/images/testimonial/1.jpg" /> -->
                                    </div>
                                    <div class="ec-test-content">
                                        <div class="ec-test-name">SHOEB KHAN</div>
                                        <div class="ec-test-designation">- Founder of Equipride</div>
                                        <div class="ec-test-divider">
                                            <i class="fi-rr-quote-right"></i>
                                        </div>
                                        <div class="ec-test-desc">Equipride Ltd specialises in quality equestrian products with both the horse and rider in mind.
                                            Based in Leeds,UK,we supply customers arround the world .We understand and appreciate the relationship between a horse
                                            and a rider and at Equipride we carry that understanding through in oru approach and business vision :"everything we create
                                            and design is to be loved by the horse and the rider"
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- ec Testimonial end -->
                <!-- ec Banner Start -->
                <div class="col-md-6 col-lg-9" data-animation="fadeIn">
                    <div class="row space-t-50" data-animation="fadeIn">
                        <!--  Special Section Start -->

                        <div class="ec-spe-section col-lg-12 col-md-12 col-sm-12 sectopn-spc-mb">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="ec-title">Coming Soon</h2>
                                </div>
                            </div>
                            <div class="ec-spe-products">
                            <?php
                                            $query = mysqli_query($con, "SELECT * FROM `comming_soon` ");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
												$id = $q['id'];
                                                ?>
                                <div class="ec-spe-product">
                                    <div class="ec-spe-pro-inner">
                                        <div class="ec-spe-pro-image-outer col-md-6 col-sm-12">
                                            <div class="ec-spe-pro-image">
                                                <img class="img-responsive"
                                                            src="../admin/file/<?php echo $q['file'] ?>" alt="Comming Soon">
                                            </div>
                                        </div>
                                        <div class="ec-spe-pro-content col-md-6 col-sm-12">
                                            <h5 class="ec-spe-pro-title"><a href="product_details.php?id=<?php echo $q['id'] ?>&&product_id=<?php echo $q['product_id'] ?>"><?php echo $q['name'] ?></a></h5>
                                            <div class="ec-spe-pro-desc"><?php echo $q['description'] ?></div>
                                            <div class="ec-spe-price">
                                                <span class="new-price">£<?php echo $q['price'] ?></span>
                                            </div>
                                            <!-- <div class="ec-spe-pro-btn">
                                                <a href="#" class="btn btn-lg btn-primary">Add To Cart</a>
                                            </div>
                                            <div class="ec-spe-pro-progress">
                                                <span class="ec-spe-pro-progress-desc"><span>Already Sold:
                                                        <b>20</b></span><span>Available: <b>40</b></span></span>
                                                <span class="ec-spe-pro-progressbar"></span>
                                            </div>
                                            <div class="countdowntimer">
                                                <span class="ec-spe-count-desc"> Hurry Up! Offer ends in:</span>
                                                <span id="ec-spe-count-2"></span>
                                            </div> -->

                                        </div>
                                    </div>
                                </div>
                                <?php }} ?>
                            </div>
                        </div>

                        <!--  Special Section End -->
                    </div>
                </div>
                <!-- ec Banner End -->
                <!--  Service Section Start -->
                <!-- ec Service End -->
            </div>
        </div>
    </section>
    <!--  End Testimonial, Banner & Service Section Start -->

    <!--  Blog Section Start -->
    
    <!--  Blog Section End -->

    <!-- Ec Instagram Start -->
    
    <!-- Ec Instagram End -->

    <!-- Footer Start -->
    <?php include ('footer.php') ?>
    <!-- Footer Area End -->

    
    <!-- Click To Call -->
    <div class="ec-cc-style cc-right-bottom">
        <!-- Start Floating Panel Container -->
        <div class="cc-panel">			
            <!-- Panel Content -->
            <div class="cc-header">
                <img src="assets/images/whatsapp/profile_01.jpg" alt="profile image"/>
                <h2>John Mark</h2>
                <p>Tachnical Manager</p>
            </div>
            <div class="cc-body">
                <p><b>Hey there &#128515;</b></p>
                <p>Need help ? just give me a call.</p>
            </div>
            <div class="cc-footer">
                <a href="tel:+919099153528" class="cc-call-button">
                    <span>Call me</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </a>
            </div>
        </div>
        <!--/ End Floating Panel Container -->

        <!-- Start Right Floating Button-->

        <!--/ End Right Floating Button-->

    </div>
    <!-- Click To Call end -->

    <!-- Newsletter Modal Start -->
    <div id="ec-popnews-bg"></div>
    <div id="ec-popnews-box">
        <div id="ec-popnews-close"><i class="ecicon eci-close"></i></div>
        <div class="row">
            <div class="col-md-7 disp-no-767">
                <img src="images/Equipride54.jpg" alt="newsletter" style="width: 400px;height: 340px;">
            </div>
            <div class="col-md-5">
                <div id="ec-popnews-box-content">
                    <h2>Subscribe Newsletter.</h2>
                    <p>Subscribe the equipride ecommerce to get in touch and get the future update. </p>
                    <form id="ec-popnews-form" method="POST">
                        <input type="email" name="email" placeholder="Email Address" required />
                        <button type="button" class="btn btn-primary" name="subscribe">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Modal end -->
    
    <!-- Footer navigation panel for responsive display -->
    <?php include 'mobilebar.php' ?>
    <!-- Footer navigation panel for responsive display end -->

    <!-- Recent Purchase Popup  -->
    <!-- <div class="recent-purchase">
        <img src="assets/images/product-image/111_1.jpg" alt="payment image">
        <div class="detail">
            <p>Someone in new just bought</p>
            <h6>Rose Gold Earrings</h6>
            <p>2 Minutes ago</p>
        </div>
        <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
    </div> -->
    <!-- Recent Purchase Popup end -->

    <!-- Add to Cart successfully toast Start -->
    <div id="addtocart_toast" class="addtocart_toast">
        <div class="desc">You Have Add To Cart Successfully</div>
    </div>
    <div id="wishlist_toast" class="wishlist_toast">
        <div class="desc">You Have Add To Wishlist Successfully</div>
    </div>
    <!-- Add to Cart successfully toast end -->

    <!-- Vendor JS -->
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

    <!--Plugins JS-->
    
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/countdownTimer.min.js"></script>
    <script src="assets/js/plugins/nouislider.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/plugins/infiniteslidev2.js"></script>
    <script src="assets/js/plugins/click-to-call.js"></script>

    <!-- Main Js -->
    <script src="assets/js/vendor/index.js"></script>
    <script src="assets/js/demo-8.js"></script>

    <script>
        $( document ).ready(function() {
            var totalAmount = 0;
            <?php 
                $product_price =  mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '1' ") or die(mysqli_error($con));
                if (mysqli_num_rows($product_price) > 0) {
                while ($pp = mysqli_fetch_array($product_price)) {
            ?>
            // debugger
            var total = parseInt($('.unitPrice-<?php echo $pp['pro_id'] ?>').text()) * parseInt($('.quantity-<?php echo $pp['pro_id'] ?>').val());
            $('.totalPrice-<?php echo $pp['pro_id'] ?>').html(total);
            totalAmount = totalAmount + total;
            <?php }} ?>
            $('.totalAmount').html(totalAmount);
            $('.totalAmount').val(totalAmount);   
           
        });
    </script>
  <script>
    function calc(id) {
      var unitPrice = parseInt($('.unitPrice-'+id).text());
      var quantity =  $('.quantity-'+id).val();
      var total =unitPrice *quantity;
      $('.totalPrice-'+id).html(total);
      var totalAmount = 0;
            <?php 
                $product_price =  mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '1' ") or die(mysqli_error($con));
                if (mysqli_num_rows($product_price) > 0) {
                while ($pp = mysqli_fetch_array($product_price)) {
            ?>
            // debugger
            var total = parseInt($('.unitPrice-<?php echo $pp['pro_id'] ?>').text()) * parseInt($('.quantity-<?php echo $pp['pro_id'] ?>').val());
            $('.totalPrice-<?php echo $pp['pro_id'] ?>').html(total);
            totalAmount = totalAmount + total;
            <?php }} ?>
            $('.totalAmount').html(totalAmount);
            $('.totalAmount').val(totalAmount);   
    }
  </script>
</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>