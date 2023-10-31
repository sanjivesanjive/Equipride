<?php 
ini_set('session.gc_maxlifetime', 3600);
session_start();
include ('connection.php');

$id = $_GET['id'];
$product_id = $_GET['product_id'];
$userid = $_SESSION['admin_id'];
// setcookie("userid", $userid, time() + 3600, "/");
$orderid = $_GET['orderid'];
setcookie("orderid", $orderid, time() + 3600, "/");

$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
$paypal_id = 'sales@equipride.co.uk'; // Business email ID

// $product_id = $_GET['pro_id'];

$color1 = mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '0' group BY `id`") or die(mysqli_error($con));
$c1 = mysqli_fetch_array($color1);

$cleanedAmount = $c1['total_amount'];
// Remove the currency symbol and any non-numeric characters
$amount = preg_replace("/[^0-9.]/", "", $cleanedAmount);

// Other parameter (978)826 in your example
$otherParam = '826';


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
 
     <!-- Main Style -->
     <link rel="stylesheet" href="assets/css/style.css" />
     <link rel="stylesheet" href="assets/css/responsive.css" />
 
     <!-- Background css -->
     <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
 </head>

 <style>
    .ec-bill-wrap {
        margin-bottom: 20px;
    }

    .ec-input-button-wrap {
        display: flex;
        align-items: center;
    }

    .ec-input-button-wrap input[type="text"] {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .ec-input-button-wrap button.btn {
        padding: 8px 15px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        #email::placeholder{
            color: #6e6d6d;
        }
        #addShippingAddressCheckbox {
    width: 16px; /* Adjust the width as needed */
    height: 16px; /* Adjust the height as needed */
    margin-right: 5px; /* Optional: Add spacing to the right of the checkbox */
    vertical-align: sub;
}

 </style>
<body class="checkout_page">
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Header start  -->
    <?php include 'header_user.php' ?>

    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <?php include 'cart_box_user.php' ?>

    <!-- ekka Cart End -->

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Checkout</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="user_panal.php">Home</a></li>
                                <li class="ec-breadcrumb-item active">Checkout</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec checkout page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <!-- checkout content Start -->
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">
                            <!-- <div class="ec-checkout-wrap margin-bottom-30">
                                <div class="ec-checkout-block ec-check-new">
                                    <h3 class="ec-checkout-title">New Customer</h3>
                                    <div class="ec-check-block-content">
                                        <div class="ec-check-subtitle">Checkout Options</div>
                                        <form action="#">
                                            <span class="ec-new-option">
                                                <span>
                                                    <input type="radio" id="account1" name="radio-group" checked>
                                                    <label for="account1">Register Account</label>
                                                </span>
                                                <span>
                                                    <input type="radio" id="account2" name="radio-group">
                                                    <label for="account2">Guest Account</label>
                                                </span>
                                            </span>
                                        </form>
                                        <div class="ec-new-desc">By creating an account you will be able to shop faster,
                                            be up to date on an order's status, and keep track of the orders you have
                                            previously made.
                                        </div>
                                        <div class="ec-new-btn"><a href="#" class="btn btn-primary">Continue</a></div>

                                    </div>
                                </div>
                                <div class="ec-checkout-block ec-check-login">
                                    <h3 class="ec-checkout-title">Returning Customer</h3>
                                    <div class="ec-check-login-form">
                                        <form action="#" method="post">
                                            <span class="ec-check-login-wrap">
                                                <label>Email Address</label>
                                                <input type="text" name="name" placeholder="Enter your email address"
                                                    required />
                                            </span>
                                            <span class="ec-check-login-wrap">
                                                <label>Password</label>
                                                <input type="password" name="password" placeholder="Enter your password"
                                                    required />
                                            </span>

                                            <span class="ec-check-login-wrap ec-check-login-btn">
                                                <button class="btn btn-primary" type="submit">Login</button>
                                                <a class="ec-check-login-fp" href="#">Forgot Password?</a>
                                            </span>
                                        </form>
                                    </div>
                                </div>

                            </div> -->
                            <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Billing Details</h3>
                                    <div class="ec-bl-block-content">
                                        <div class="ec-check-subtitle">Checkout Options</div>
                                        <!-- <span class="ec-bill-option">
                                            <span>
                                                <input type="radio" id="bill1" name="radio-group">
                                                <label for="bill1">I want to use an existing address</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="bill2" name="radio-group" checked>
                                                <label for="bill2">I want to use new address</label>
                                            </span>
                                        </span> -->
                                        <div class="ec-check-bill-form">
                                            <?php 
                                             $color1 = mysqli_query($con, "SELECT * FROM `register` WHERE `userid` ='$userid'") or die(mysqli_error($con));
                                             $c1 = mysqli_fetch_array($color1);
                                             ?>
                                            
                                            <form action="#" method="post" id="shippingForm">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>E-mail Address*</label>
                                                    <input type="email" id="email" name="email" value="<?php echo $c1['email'] ?>" placeholder="Email Address" required>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Contact Number*</label>
                                                    <input type="number" id="phone" name="phone"
                                                        placeholder="Contact Number" value="<?php echo $c1['phone'] ?>"  required/>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label> House Number And Street*</label>
                                                    <input type="text" id="address" name="address"
                                                        placeholder="House Number And Street" value="<?php echo $c1['address'] ?>"  required/>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Town*</label>
                                                    <input type="text" id="localty" name="localty"
                                                        placeholder="Town" value="<?php echo $c1['localty'] ?>"  required/>
                                                </span>

                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Post Code*</label>
                                                    <input type="text" id="pincode" name="pincode" value="<?php echo $c1['pincode'] ?>" placeholder="Post Code" required/>
                                                </span>

                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Country*</label>
                                                    <input type="text" id="country" name="country" value="<?php echo $c1['country'] ?>" placeholder="Country" required/>
                                                </span>
                                                <!-- <span class="ec-bill-wrap ">
                                                    <label>Shipping Address*</label>
                                                    <textarea id="shipping_address" name="shipping_address" placeholder="Shipping Address" required></textarea>
                                                </span> -->
                                                <!-- <button class="btn btn-warning" type="button" id="addShippingAddressBtn">Add Shipping Details</button> -->

                                            </form>
                                        </div>

                                        <div class="ec-check-bill-form" style="display:inline;">
                                        <!-- Checkbox and Label for "Use Same Shipping Address" -->
                                            
                                            <span class="ec-bill-wrap ec-bill-half" style="line-height: 1;">
                                            <label class="checkbox-inline" style="color: #ffc107;line-height: 1;"> Use Same Shipping Address </label>
                                            <input type="checkbox" id="addShippingAddressCheckbox">
                                                </span>

                                    </div>



                                    <div class="ec-check-bill-form">
                                            <?php 
                                            //  $color1 = mysqli_query($con, "SELECT * FROM `register` WHERE `userid` ='$userid'") or die(mysqli_error($con));
                                            //  $c1 = mysqli_fetch_array($color1);
                                             ?>
                                            
                                            <form action="#" method="post" id="shippingForm">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>E-mail Address*</label>
                                                    <input type="email" id="email" name="email" value="<?php //echo $c1['email'] ?>" placeholder="Email Address" required>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Contact Number*</label>
                                                    <input type="number" id="phone" name="phone"
                                                        placeholder="Contact Number" value="<?php //echo $c1['phone'] ?>"  required/>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label> House Number And Street*</label>
                                                    <input type="text" id="address" name="address"
                                                        placeholder="House Number And Street" value="<?php //echo $c1['address'] ?>"  required/>
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Town*</label>
                                                    <input type="text" id="localty" name="localty"
                                                        placeholder="Town" value="<?php //echo $c1['localty'] ?>"  required/>
                                                </span>

                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Post Code*</label>
                                                    <input type="text" id="pincode" name="pincode" value="<?php //echo $c1['pincode'] ?>" placeholder="Post Code" required/>
                                                </span>

                                                <span class="ec-bill-wrap ec-bill-half">
    <label>Country*</label>
    <select id="country" name="country" required>
        <option value="dummy">Dummy Value</option>
        <!-- JavaScript will populate the options here -->
    </select>
</span>




                                                <!-- <span class="ec-bill-wrap ">
                                                    <label>Shipping Address*</label>
                                                    <textarea id="shipping_address" name="shipping_address" placeholder="Shipping Address" required></textarea>
                                                </span> -->
                                                <button class="btn btn-warning" type="button" id="addShippingAddressBtn">Add Shipping Details</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <h3 style="float: right;">Payment Method's</h3>
                            <br>
                            <br>                            

                            <form action="charge.php" method="post">
                            <input type="hidden" name="amount" value="<?php echo $amount ?>" />
                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                            <input type="hidden" name="orderid" value="<?php echo $orderid;?>">
                            <span class="ec-check-order-btn">
                            <img src="assets/images/icons/payment2.png" alt="Paypal">
                            <input type="submit" class="btn btn-primary" name="submit" id="secondFormSubmitBtn" value="Paypal">
                                <!-- <a class="btn btn-primary" href="#">Place Order</a> -->
                            </span>
                            </form>
                            <br>
                            <form method="post" action="https://www.ipg-online.com/connect/gateway/processing">
                                <fieldset>
                                <input type="hidden" name="storename" value="7250502827" readonly="readonly" />
                                <input type="hidden" name="timezone" value="Europe/London" readonly="readonly"/>
                                <input type="hidden" name="txntype" value="sale" readonly="readonly" />
                                <input type="hidden" name="chargetotal" value="<?php echo $amount ?>" readonly="readonly" />
                                <input type="hidden" name="currency" value="<?php echo $otherParam ?>" readonly="readonly" />
                                <input type="hidden" name="txndatetime" value="<?php echo getDateTime(); ?>"/>
                                <input type="hidden" name="hashExtended" value="<?php echo createExtendedHash($amount, $otherParam); ?>" readonly="readonly" />
                                <input type="hidden" name="hash_algorithm" value="HMACSHA256" readonly="readonly" />
                                <input type="hidden" name="checkoutoption" value="combinedpage" readonly="readonly" />
                                
                                <span class="ec-check-order-btn">
                                <img src="assets/images/icons/payment1.png" alt=""><img src="assets/images/icons/payment3.png" alt="">
                                <img src="assets/images/icons/payment4.png" alt=""><img src="assets/images/icons/payment5.png" alt="">
                                <input type="submit" class="btn btn-primary" id="submit" value="PayBy Card" />
                                </span>

                                </fieldset>
                                </form>

                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-summary">
                                <?php 
                                            $product_cart1 =  mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '0' ") or die(mysqli_error($con));
                                            $pc1 = mysqli_fetch_array($product_cart1);
                                                ?>
                                    <div>
                                        <span class="text-left">Sub-Total</span>
                                        <span class="text-right"><?php echo $pc1['total_amount'] ?></span>
                                    </div>
                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right"><?php echo $pc1['total_amount'] ?></span>
                                    </div>
                                </div>
                                <div class="ec-checkout-pro">
                                <?php
                                    $product_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '0' ORDER BY `timelog` DESC LIMIT 3") or die(mysqli_error($con));

                                    if (mysqli_num_rows($product_cart) > 0) {
                                        while ($pc = mysqli_fetch_array($product_cart)) {
                                            $product_id = $pc['pro_id'];
                                            $sql = "SELECT id FROM product WHERE product_id='$product_id'";
                                            $query = mysqli_query($con, $sql);
                                            $row = mysqli_fetch_assoc($query);
                                            ?>
                                            <div class="col-sm-12 mb-6">
                                                <div class="ec-product-inner">
                                                    <div class="ec-pro-image-outer">
                                                        <div class="ec-pro-image">
                                                            <a href="product_details_user.php?id=<?php echo $row['id'] ?>&&product_id=<?php echo $pc['pro_id'] ?>">
                                                                <img class="main-image" src="admin/file/<?php echo $pc['s_image'] ?>" alt="Product" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="ec-pro-content">
                                                        <h5 class="ec-pro-title"><a href="product_details_user.php?id=<?php echo $row['id'] ?>&&product_id=<?php echo $pc['pro_id'] ?>"><?php echo $pc['p_name'] ?></a></h5>

                                                        <span class="ec-price">
                                                            <span class="new-price">£<?php echo $pc['price'] ?></span>
                                                        </span>
                                                        <div class="ec-pro-option">
                                                            <!-- Add any additional content or options here -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Product Start -->
    <section class="section ec-new-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">New Arrivals</h2>
                        <h2 class="ec-title">New Arrivals</h2>
                        <p class="sub-title">Browse The Collection of Top Products</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- New Product Content -->
                <?php 
                                $product_category =  mysqli_query($con, "SELECT * FROM `product` WHERE `type_1`='Customer' ORDER BY `product`.`id` DESC LIMIT 4;") or die(mysqli_error($con));
                                if (mysqli_num_rows($product_category) > 0) {
                                while ($pc = mysqli_fetch_array($product_category)) {
                                    $product_id = $pc['product_id'];
                                    ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image" style="height: 300px !important;">
                                <a href="product_details_user.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>" >
                                    <img class="main-image"
                                        src="admin/file/<?php echo $pc['file'] ?>" alt="Product" />
                                    <!-- <img class="hover-image"
                                        src="admin/file/<?php echo $pc['file'] ?>" alt="Product" /> -->
                                </a>
                                <div class="ec-pro-actions">
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $pc['product_id'] ?>"><i class="fi-rr-eye"></i></a>
                                                    <!-- <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                        <a title="Add To Cart" href="product_details_user.php?id=<?php echo $pc['id']?>&product_id=<?php echo $pc['product_id']?>" class="add-to-cart" id="addToCartButton">
                                                                <i class="fi-rr-shopping-basket"></i> Add To Cart
                                            </a>
                                            <form method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="file" value="<?php echo $pc['file']; ?>">
                                                    <input type="hidden" name="product_id" value="<?php echo $pc['product_id']; ?>">
                                                    <input type="hidden" name="p_name" value="<?php echo $pc['name']; ?>">
                                                    <input type="hidden" name="price" value="<?php echo $pc['price']; ?>">
                                                    <button title="Wishlist" class="ec-btn-group wishlist" data-productid="<?php echo $pc['product_id']; ?>" data-userid="<?php echo $userid; ?>"><i class="fi-rr-heart"></i></button>

                                                </form>
                                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Round Neck T-Shirt</a></h5>

                            <div class="ec-pro-list-desc"><a href="product_details_user.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></div>
                            <span class="ec-price">
                                <span class="new-price">£<?php echo $pc['price'] ?></span>
                            </span>
                            <div class="ec-pro-option">
                                <!-- <div class="ec-pro-color">
                                    <span class="ec-pro-opt-label">Color</span>
                                    <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                data-src="assets/images/product-image/6_1.jpg"
                                                data-src-hover="assets/images/product-image/6_1.jpg"
                                                data-tooltip="Gray"><span
                                                    style="background-color:#e8c2ff;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                                data-src="assets/images/product-image/6_2.jpg"
                                                data-src-hover="assets/images/product-image/6_2.jpg"
                                                data-tooltip="Orange"><span
                                                    style="background-color:#9cfdd5;"></span></a></li>
                                    </ul>
                                </div> -->
                                <!-- <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz"
                                                data-old="$25.00" data-new="$20.00"
                                                data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$27.00"
                                                data-new="$22.00" data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$35.00"
                                                data-new="$30.00" data-tooltip="Extra Large">XL</a></li>
                                    </ul>
                                </div> -->
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
                                <h5 class="ec-quick-title"><a href="product_details_user.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></h5>


                                <div class="ec-quickview-desc"><?php echo $pc['description'] ?></div>
                                <div class="ec-quickview-price">
                                £<span class="new-price"><?php echo $pc['price'] ?></span>
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
                                    <a class="btn btn-primary" href="product_details_user.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>">View Product</a>
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
                <div class="col-sm-12 shop-all-btn"><a href="full_category.php">Shop All Collection</a></div>
            </div>
        </div>
    </section>
    <!-- New Product end -->

    <!-- Footer Start -->
    <?php include 'footer_user.php' ?>

    <!-- Footer Area End -->

   
    <!-- Footer navigation panel for responsive display -->
    <?php include 'mobilebar_user.php' ?>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Wishlist Actions -->

    <script>
    $(document).ready(function() {
        var userId = "<?php echo $userid; ?>"; // Declare userId in a higher scope
    
    // Define a function to get and update the wishlist count
    function updateWishlistCount(userId) {
        console.log("Updating wishlist count for user ID: " + userId);
        $.ajax({
            type: 'POST', // Change the request type to POST
            url: 'wishlist_user_action.php',
            data: {
                wish_count: true,
                userid: userId, // Pass the userId as a parameter
                nocache: new Date().getTime()
            },
            success: function(response) {
                // console.log("Response from server: " + response);
                // Update the placeholder element with the retrieved count
                $('#mySpan').text(response);
                $('#myspan2').text(response);
    
                // console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
        updateWishlistCount(userId);
    
        $(".wishlist").click(function(event) {
            event.preventDefault();
            console.log("Button clicked");
            // Extract the product data from the clicked button's data attribute
            var productId = $(this).data("productid");
            var file = $(this).siblings('input[name="file"]').val();
            var p_name = $(this).siblings('input[name="p_name"]').val();
            var price = $(this).siblings('input[name="price"]').val();
    
            // Create an object to store the data
            var data = {
                product_id: productId,
                userid: userId, // Use the userId from the outer scope
                file: file,
                p_name: p_name,
                price: price,
                wishlist: true
            };
    
            $.ajax({
                type: 'POST',
                url: 'wishlist_user_action.php',
                data: data,
                success: function(response) {
                    // alert(response); // Corrected 'aleret' to 'alert'
                    // Update the wishlist count only after the item has been added successfully
                    updateWishlistCount(userId);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
    </script>

    <!-- Wishlist End -->

     <!-- Searchbar -->

 <script src="js/searchbar_user.js"></script>

    <!-- Shipping Details Start -->

    <script>
$(document).ready(function() {
    // Replace this URL with the API endpoint you want to use
    const countriesApiUrl = 'https://restcountries.com/v2/all';

    // Select the "Country" select element
    const countrySelect = $('#country');

    // Make an AJAX request to fetch the list of countries
    $.ajax({
        url: countriesApiUrl,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Check if the API request was successful
            if (Array.isArray(data)) {
                // Loop through the array and add each country as an option
                data.forEach(country => {
                    const option = new Option(country.name, country.name);
                    countrySelect.append(option);
                });
                // Log the response in the console
                console.log(data);
            } else {
                console.error('Failed to fetch country data');
            }
        },
        error: function() {
            console.error('Failed to make the API request');
        }
    });
});
</script>



    <script>
$(document).ready(function() {
    // Function to check if the shipping form is filled
    function isShippingFormFilled() {
        var email = $('#email').val().trim();
        var phone = $('#phone').val().trim();
        var address = $('#address').val().trim();
        var localty = $('#localty').val().trim();
        var pincode = $('#pincode').val().trim();
        var country = $('#country').val().trim();
        var shippingAddress = $('#shipping_address').val().trim();
        return email !== '' && phone !== '' && address !== '' && localty !== '' && pincode !== '' && country !== '' && shippingAddress !== '';
    }

    // Handle the click event of the "Add Shipping Details" button
    $('#addShippingAddressBtn').click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Check if the shipping form is filled
        if (isShippingFormFilled()) {
            $('#payment_validation').val('valid');

            // Serialize the form data
            var formData = $('#shippingForm').serializeArray();
            var userid = <?php echo json_encode($userid); ?>;
            var orderid = <?php echo json_encode($orderid); ?>;

            // Filter out empty fields from formData
            formData = formData.filter(function(item) {
                return item.value.trim() !== '';
            });

            // Add userid and orderid to the formData array
            formData.push({ name: 'userid', value: userid });
            formData.push({ name: 'orderid', value: orderid });

            // Send an AJAX request only if formData is not empty
            if (formData.length > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'save_shipping_address_guest.php',
                    data: formData,
                    success: function(response) {
                        $('#addShippingAddressBtn').removeClass('btn-warning').addClass('btn-success');
                        alert("Shipping Details Added Successfully");
                        if (response.success) {
                            var data = response.data;
                            $('#email').val(data.email);
                            $('#phone').val(data.phone);
                            $('#address').val(data.address);
                            $('#localty').val(data.localty);
                            $('#pincode').val(data.pincode);
                            $('#country').val(data.country);
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        } else {
            alert('Please fill in all address details.');
        }
    });

    // Handle the click event of the PayPal button in the second form
    $('#secondFormSubmitBtn').click(function(e) {
        // Check if the first form is filled before allowing the submission
        if (!isShippingFormFilled()) {
            e.preventDefault(); // Prevent form submission
            alert('Please fill all Shipping details.');
        }
    });

    // Handle the click event of the PayBy Card button in the third form
    $('#submit').click(function(e) {
        // Check if the first form is filled before allowing the submission
        if (!isShippingFormFilled()) {
            e.preventDefault(); // Prevent form submission
            alert('Please fill all Shipping details.');
        }
    });
});
</script>


    <!-- NatWest -->
    <?php
function getDateTime() {
return date("Y:m:d-H:i:s");
}
function createExtendedHash($amount, $otherParam) {
// Please change the store Id to your individual Store ID
// NOTE: Please DO NOT hardcode the secret in that script. For example read it from a database.
$sharedSecret = "X8/I(Mf0Ka";
$separator = "|";
$storeId= "7250502827";
$timezone= "Europe/London";
$txntype= "sale";
$checkoutoption = "combinedpage";
$stringToHash = $amount . $separator . $checkoutoption . $separator . $otherParam . $separator
. "HMACSHA256" . $separator . $storeId . $separator . $timezone. $separator . date("Y:m:d-H:i:s")
. $separator . $txntype;
$hash = base64_encode(hash_hmac('sha256', $stringToHash, $sharedSecret, true));
return $hash;
}

?>
    <!-- NatWest End -->
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