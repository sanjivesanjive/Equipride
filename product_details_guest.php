<?php
session_start();
include ('connection.php');
$id = $_GET['id'];
$product_id = $_GET['product_id'];


$userid = $_SESSION['admin_id'];

if (isset($_POST["cart"])) {
    $p_name = $_POST["p_name"];
    $price = $_POST["price"];
    $quantity = $_POST["hidden_quantity"];
    $size = $_POST["selected_size"];
    $s_image = $_POST["selected_color_image"];
    $image_name = basename($s_image);
    
    // // Insert the selected product into the cart
    $insert_query = "INSERT INTO `cart` (`userid`, `pro_id`, `s_image`, `p_name`, `price`, `quantity`, `size`, `type_1`, `status`)
                     VALUES ('$userid', '$product_id', '$image_name', '$p_name', '$price', '$quantity', '$size', 'Customer', '1')";

    // Execute the query
    $result = mysqli_query($con, $insert_query);

    if ($result) {
        // Redirect the user to a success page or back to the product page
        header("Location: cart_guest.php?id=$id&product_id=$product_id&user_id=$userid"); // You can customize the success page URL
        exit(); // Ensure that no further code execution occurs after the redirect
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($con);
    // }
}
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
 
     <!-- Main Style -->
     <link rel="stylesheet" href="assets/css/style.css" />
     <link rel="stylesheet" href="assets/css/responsive.css" />
 
     <!-- Background css -->
     <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
     <style>
  /* Basic Styling */


/* .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 15px;
  display: flex;
} */
.note {
  font-size: 90%;
  text-transform: lowercase;
    
  color: red;
}
.draggable {
    width: 80% !important;
}
.containeri {
  max-width: 1200px;
  margin: 0 auto;
  padding: 15px;
  display: flex;
}
/* Columns */
.left-column {
  width: 50%;
  position: relative;
}

.right-column {
  width: 50%;
  /* margin-top: 60px; */
}


/* Left Column */
.left-column img {
  width: 90%;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  transition: all 0.3s ease;
}

.left-column img.active {
  opacity: 1;
}

label {
  text-transform: capitalize;
 
}
/* Right Column */

/* Product Description */
.product-description {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 0px !important;
}
.product-description span {
  font-size: 12px;
  color: #358ED7;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-decoration: none;
}
.product-description h1 {
  font-weight: 300;
  font-size: 52px;
  color: #43484D;
  letter-spacing: -2px;
}
.product-description p {
  font-size: 16px;
  font-weight: 300;
  color: #86939E;
  line-height: 24px;
}

/* Product Configuration */
.product-color span,
.cable-config span {
  font-size: 14px;
  font-weight: 400;
  color: #86939E;
  margin-bottom: 20px;
  display: inline-block;
}

/* Product Color */
.product-color {
  margin-bottom: 30px;
}

.color-choose div {
  display: inline-block;
}

.color-choose input[type="radio"] {
  display: none;
}

.color-choose input[type="radio"] + label span {
  display: inline-block;
  width: 30px;
  height: 30px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
}

.color-choose input[type="radio"] + label span {
  border: 4px solid #cccccc;
  box-shadow: 0 1px 5px 0 rgba(0,0,0,0.33);
} 

.color-choose input[type="radio"]#red + label span {
  background-color: #C91524;
}
.color-choose input[type="radio"]#blue + label span {
  background-color: #1524C9;
}
.color-choose input[type="radio"]#black + label span {
  background-color: #323232;
}

.color-choose input[type="radio"]#green + label span {
  background-color: #24c915;
}

.color-choose input[type="radio"]#yellow + label span {
  background-color: #FFFF00;
}

.color-choose input[type="radio"]#pink + label span {
  background-color: #ffc0cb;
}

.color-choose input[type="radio"]#pistachio + label span {
  background-color: #93c572;
}

.color-choose input[type="radio"]#violet + label span {
  background-color: #AD06F6;
}

.color-choose input[type="radio"]#white + label span {
  background-color: #FFFFFF;
}

.color-choose input[type="radio"]#brown + label span {
  background-color: #A52A2A;
}

.color-choose input[type="radio"]#orange + label span {
  background-color: #FFA500;
}

.color-choose input[type="radio"]#petrol + label span {
  background-color: #005F6A;
}

.color-choose input[type="radio"]:checked + label span {
  background-image: url(images/check-icn.svg);
  background-repeat: no-repeat;
  background-position: center;
} */

/* Cable Configuration */
.cable-choose {
  margin-bottom: 20px;
}

.cable-choose button {
  border: 2px solid #E1E8EE;
  border-radius: 6px;
  padding: 13px 20px;
  font-size: 14px;
  color: #5E6977;
  background-color: #fff;
  cursor: pointer;
  transition: all .5s;
}

.cable-choose button:hover,
.cable-choose button:active,
.cable-choose button:focus {
  border: 2px solid #86939E;
  outline: none;
}

.cable-config {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}

.cable-config a {
  color: #358ED7;
  text-decoration: none;
  font-size: 12px;
  position: relative;
  margin: 10px 0;
  display: inline-block;
}
/* .cable-config a:before {
  content: "?";
  height: 15px;
  width: 15px;
  border-radius: 50%;
  border: 2px solid rgba(53, 142, 215, 0.5);
  display: inline-block;
  text-align: center;
  line-height: 16px;
  opacity: 0.5;
  margin-right: 5px;
} */

/* Product Price */
.product-price {
  display: flex;
  align-items: center;
}

.product-price span {
  font-size: 26px;
  font-weight: 300;
  color: #43474D;
  margin-right: 20px;
}

/* .cart-btn {
  display: inline-block;
  background-color: #7DC855;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
} */
/* .cart-btn:hover {
  background-color: #64af3d;
} */

/* Responsive */
@media (max-width: 940px) {
  .container {
    flex-direction: column;
    margin-top: 60px;
  }

  .left-column,
  .right-column {
    width: 75%;
  }

  .left-column img {
    width: 300px;
    right: 0;
    top: -65px;
    left: initial;
  }
}

@media (max-width: 535px) {
  .left-column img {
    width: 220px;
    top: -85px;
  }
}


.single-nav-thumb .slick-list {
    margin: 0 auto !important;
    /* margin: 35px 10px 10px 46px !important; */
    /* width: 100% !important; */
  }
   
/* .slick-list {
    width: 100% !important; 
    position: relative;
    top: 21px;
    left: 65px;
} */
.color-choose input[type="radio"] + label span {
    margin: 10px 0px 0px 98px !important;
}


/* .single-nav-thumb .color-choose .slick-initialized .slick-slider{display: flex;} */

/* .slick-arrow:before{line-height: 7px !important;} */

/* .slick-slide .slick-active{ width: 100px !important;} */

s{
    padding: 0px 0px 89px 95px;
    line-height: 50px !important;
    font-size: 12px !important;
    text-decoration: none;
}
.single-pro-content .ec-single-qty .ec-single-cart .btn{
    line-height: 45px !important;
}
.single-pro-content .ec-single-qty .qty-plus-minus{
    margin-right: 10px;
}

</style>
<style>
      .color_select {
        padding: 0px;
        margin: 0px;
        list-style: none;
      }
      .color_select .selected_color {
        transition: all 0.3s ease-in-out;
        width: 30px;
        height: 30px;
        cursor: pointer;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0px;
        border: 0.5px solid #eeeeee;
        float: left;
        margin-right: 10px;
        border-radius: 50%;
      }

      .span_class {
        width: 80%;
        height: 80%;
        display: block;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .selected_color.active {
        border: 2px solid #444444;
      }
      #colorParagraph{
        color: #202020;
    font-weight: 500;
    font-size: 17px;
      }
    </style>
    
 </head>
<body class="product_page">
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Header start  -->
    <?php include ('header_guest.php') ?>

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
                            <h2 class="ec-breadcrumb-title">Single Products</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="guest_panal.php?user_id=<?php echo $userid; ?>">Home</a></li>
                                <li class="ec-breadcrumb-item active">Products</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <form method = "POST" enctype="multipart/form-data">
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
            <?php
                $product_details_user = mysqli_query($con, "SELECT * FROM `product` WHERE `id`='$id' AND `product_id`='$product_id' AND `type_1`='Customer'") or die("error");
                $pd = mysqli_fetch_array($product_details_user);
                $subcategoy = $pd['sub_category'];
                ?>
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="admin/file/<?php echo $pd['file']?>"
                                                    alt="" id="displayedImage">
                                                    <!-- Add this img element for the zoom-hover image -->
                                                    <!-- <img class="img-responsive" id="zoomHoverImage" src="" alt=""> -->

                                            </div>

                                            <?php
                                                    $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($image) > 0) {
                                                    while ($i = mysqli_fetch_array($image)) {
                                                        ?>
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="admin/file/<?php echo $i['file'] ?>"
                                                    alt="" >
                                            </div>
                                            <?php }} ?>

                                            <?php
                                            $additional_image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($additional_image) > 0) {
                                                while ($row = mysqli_fetch_array($additional_image)) {
                                                    ?>
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="admin/file/<?php echo $row['file'] ?>" alt="" >
                                            </div>
                                            <?php }} ?>
                            
                                            

                                            <!-- <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="assets/images/product-360/1_4.jpg"
                                                    alt="">
                                            </div>
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="assets/images/product-360/1_5.jpg"
                                                    alt="">
                                            </div> -->
                                        </div>
                                        <div class="single-nav-thumb">
                                        <div class="single-slide" onclick="onSlideClick('<?php echo $pd['file'] ?>')">
                                                <img class="img-responsive" src="admin/file/<?php echo $pd['file'] ?>" style="height: 115px;"
                                                    alt="" id="displayedImage2">
                                            </div>

                                            <?php
                                                    $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($image) > 0) {
                                                    while ($i = mysqli_fetch_array($image)) {
                                                        ?>
                                            <div class="single-slide" onclick="onSlideClick('<?php echo $i['file'] ?>')">
                                                <img class="img-responsive" src="admin/file/<?php echo $i['file'] ?>" style="height: 115px;"
                                                    alt="" >
                                            </div>
                                            <?php }} ?>

                                            <?php
                                            $additional_image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($additional_image) > 0) {
                                                while ($row = mysqli_fetch_array($additional_image)) {
                                                    ?>
                                            <div class="single-slide zoom-image-hover" onclick="onSlideClick('<?php echo $row['file'] ?>')">
                                                <img class="img-responsive" src="admin/file/<?php echo $row['file'] ?>" alt="" >
                                            </div>
                                            <?php }} ?>
                                        
                                            

                                            <!-- <div class="single-slide">
                                                <img class="img-responsive" src="assets/images/product-360/1_4.jpg"
                                                    alt="">
                                            </div>
                                            <div class="single-slide">
                                                <img class="img-responsive" src="assets/images/product-360/1_5.jpg"
                                                    alt="">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar">
                                    <div class="single-pro-content">
                                        <input type="hidden" name="p_name" value="<?php echo $pd['name'] ?>" >
                                        <input type="hidden" name="price" value="<?php echo $pd['price']; ?>" >
                                        <h5 class="ec-single-title"><?php echo $pd['name'] ?></h5>
                                        <div class="ec-single-desc"><?php echo $pd['description'] ?></div>
                                        <div class="ec-single-price-stoke" style="padding-top: 85px;">
                                            <div class="ec-single-price">
                                                <span class="ec-single-ps-title">As low as</span>
                                                <span class="new-price">£<?php echo $pd['price'] ?></span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-variation">
                                            <div class="">
                                                <span id="colorParagraph">Please Choose Colour</span><br>
                                                <span id="msg"></span><br>
                                                <ul class="color_select">
                                                <input type="hidden" name="selected_color_image" id="selectedColorImage" value="">
                                                <input type="hidden" name="selected_color" class="color_name_hidden" value="">
                                                <?php
                                                        $color = $pd['color'];
                                                        $file = $pd['file'];
                                                        $sql = "SELECT color_value FROM color WHERE color_name='$color'";
                                                        $query = mysqli_query($con,$sql);
                                                        $row = mysqli_fetch_assoc($query);
                                                        $color_value = $row['color_value'];
                                                        $imageSrc = "admin/file/" . $file . "";
                                                        ?>

                                                <li class="selected_color" name="s_image" value="<?php echo $color ?>" onclick="onColorChange('<?php echo $imageSrc; ?>')">
                                                <span class="span_class" style="background-color: <?php echo $color_value ?>"></span>
                                                </li>
                                                <?php
                                                        $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Customer'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($image) > 0) {
                                                        while ($i = mysqli_fetch_array($image)) {
                                                            $file = $i['file'];
                                                            $color = $i['color'];
                                                            $sql = "SELECT color_value FROM color WHERE color_name='$color'";
                                                            $query = mysqli_query($con,$sql);
                                                            $row = mysqli_fetch_assoc($query);
                                                            $color_value = $row['color_value'];
                                                            $imageSrc = "admin/file/" . $file . "";
                                                            // $color_name = $row['color_name'];

                                                    ?>

                                                    <li class="selected_color" value="<?php echo $color ?>" onclick="onColorChange('<?php echo $imageSrc; ?>')">
                                                <span class="span_class" style="background-color: <?php echo $color_value ?>"></span>
                                                <?php }} ?>
                                                </li>
                                                
                                            </ul>
                                            </div><br><br>
                                            <div class="ec-pro-variation-inner ec-pro-variation-size">
                                                <span id="msg1"></span>
                                                <input type="hidden" name="selected_size" id="selected_size" value="">
                                                <div class="ec-pro-variation-content">

                                                <select class="form-control" name="size" data-choices id="category-dropdown">
                                                    <option value="">Please Choose Size</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-single-qty">
                                        <span id="msg2"></span>
                                        <div class="qty-plus-minus">
                                            <input class="qty-input" id="qty-input-num" type="number" min="0" name="selected_quantity" value="1"/>
                                            <input type="hidden" name="hidden_quantity" id="hidden_quantity" value="1" />
                                        </div>
                                            Stock : <div id="sub-category-dropdown"></div>&nbsp;&nbsp;&nbsp;
                                            <div class="ec-single-cart ">
                                                <input type="submit" id="checked" class="btn btn-primary" name="cart" value="Add To Cart">

                                            </div>
                                            <div class="ec-single-quickview">
                                                <a href="#" class="ec-btn-group quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $product_id ?>"><i class="fi-rr-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                            role="tablist">Specification</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        <p><?php echo $pd['description'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                    <p><?php echo $pd['specification'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>

            </div>
        </div>
    </section>
    </form>
    <!-- End Single product -->

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related products</h2>
                        <h2 class="ec-title">Related products</h2>
                        <p class="sub-title">Browse The Collection of Top Products</p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                <?php
                                                    $product = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Customer' ORDER BY `product`.`id` ASC LIMIT 4; ") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($product) > 0) {
                                                    while ($p = mysqli_fetch_array($product)) {
                                                        $main_id = $p['product_id'];
                                                        ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image" style="height: 300px !important;">
                                <a href="product_details_guest.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>&&user_id=<?php echo $userid; ?>" >
                                    <img class="main-image"
                                        src="admin/file/<?php echo $p['file'] ?>" alt="Product" />
                                    <!-- <img class="hover-image"
                                        src="admin/file/<?php echo $p['file'] ?>" alt="Product" /> -->
                                </a>
                                <div class="ec-pro-actions">
                                                        <a href="#" class="quickview" data-link-action="quickview"
                                                            title="Quick view" data-bs-toggle="modal"
                                                            data-bs-target="#ec_quickview_modal<?php echo $main_id ?>"><i class="fi-rr-eye"></i></a>
                                                            <button title="Add To Cart" class="add-to-cart"><i
                                                                    class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                                                    <form method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="file" value="<?php echo $p['file']; ?>">
                                                    <input type="hidden" name="product_id" value="<?php echo $p['product_id']; ?>">
                                                    <input type="hidden" name="p_name" value="<?php echo $p['name']; ?>">
                                                    <input type="hidden" name="price" value="<?php echo $p['price']; ?>">
                                                    <button title="Wishlist" class="ec-btn-group wishlist" data-productid="<?php echo $p['product_id']; ?>" data-userid="<?php echo $userid; ?>"><i class="fi-rr-heart"></i></button>

                                                </form>
                                                        </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="product_details_guest.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>&&user_id=<?php echo $userid; ?>"><?php echo $p['name'] ?></a></h5>
                            <div class="ec-pro-list-desc"><?php echo $p['file'] ?></div>
                            <span class="ec-price">
                                <span class="new-price">£<?php echo $p['price'] ?></span>
                            </span>
                            <div class="ec-pro-option">
                                <div class="ec-pro-color">
                                    <!-- <span class="ec-pro-opt-label">Color</span> -->
                                    <!-- <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                data-src="admin/file/<?php echo $p['file'] ?>"
                                                data-src-hover="admin/file/<?php echo $p['file'] ?>"
                                                data-tooltip="Gray"><span
                                                    style="background-color:#e8c2ff;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                                data-src="assets/images/product-image/6_2.jpg"
                                                data-src-hover="assets/images/product-image/6_2.jpg"
                                                data-tooltip="Orange"><span
                                                    style="background-color:#9cfdd5;"></span></a></li>
                                    </ul> -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal<?php echo $main_id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $pd['file'] ?>" alt="">
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
                                    <img class="img-responsive" src="admin/file/<?php echo $pd['file'] ?>" alt="">
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
                                <h5 class="ec-quick-title"><a href="product_details_guest.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>&&user_id=<?php echo $userid; ?>"><?php echo $pd['name'] ?></a></h5>


                                <div class="ec-quickview-desc"><?php echo $pd['description'] ?></div>
                                <div class="ec-quickview-price">
                                £<span class="new-price"><?php echo $pd['price'] ?></span>
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
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="0" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                    <a class="btn btn-primary" href="product_details_guest.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>&&user_id=<?php echo $userid; ?>">View Product</a>
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
    </section>
    <!-- Related Product end -->

    <!-- Footer Start -->
    <?php include 'footer_guest.php'; ?>

    <!-- Footer Area End -->

    <!-- 360 Modal -->

    <!-- Modal end -->

    <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal<?php echo $product_id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="admin/file/<?php echo $pd['file'] ?>" alt="">
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
                                    <img class="img-responsive" src="admin/file/<?php echo $pd['file'] ?>" alt="">
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
                                <h5 class="ec-quick-title"><a href="product_details_guest.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>&&user_id=<?php echo $userid; ?>"><?php echo $pd['name'] ?></a></h5>


                                <div class="ec-quickview-desc"><?php echo $pd['description'] ?></div>
                                <div class="ec-quickview-price">
                                £<span class="new-price"><?php echo $pd['price'] ?></span>
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
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="0" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                    <a class="btn btn-primary" href="product_details_guest.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>&&user_id=<?php echo $userid; ?>">View Product</a>
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



    <!-- <script>
    $(document).ready(function () {
      $('#category-dropdown').on('change', function () {
        var id = this.value;
        var selectedColor = <?php //echo json_encode($color); ?>;
        $.ajax({
          url: "fetch-stock.php",
          type: "POST",
          data: {
            id: id,
            color: selectedColor
          },
          cache: false,
          success: function (result) {
            // $("#sub-category-dropdown").html(result);
            $("#qty-input-num").attr("max", $.trim(result));
            // alert($.trim(result));
            if($.trim(result) > 0) {
                // alert($.trim(result));
                $("#checked").attr("disabled", false);
            } else {
                $("#checked").attr("disabled", true);
            }
            // $("#sub-category-dropdown").val(result);
			// $('#size-dropdown').html('<option value="">Select Size</option>');
          }
        });
      });
    //   var options = "";
    //   debugger;
    //   var color;
    //     <?php
    //     $query_color =mysqli_query($con,"SELECT * FROM `stock`  where  `product_id` = '$product_id' AND `type_1`='Customer'  ");
    //     $qc = mysqli_fetch_array($query_color);
    //     $color = $qc['color'];
    //     ?>
    //     <?php
    //     $result = mysqli_query($con, "SELECT * FROM `stock`  where `product_id` = '$product_id' AND `color` = '$color' AND `type_1`='Customer'  ");
    //     while ($row = mysqli_fetch_array($result)) {
    //     ?>
    //     options = options + "<option value='<?php //echo $row['id'] ?>'><?php //echo $row['size']; ?></option>";
    //     <?php
    //     }
    //     ?>
    //   $('#category-dropdown').html(options);
    });

//     function onColorChange(color) {
//     //    alert(color);
//         var options = "<option value=''>Please Select Size</option>";
//         var selectedcolor = color;
//         var pageid =  "<?php //echo $product_id;?>";
//         $.ajax({
//             // url: "fatch-color.php?product_id='+pageid+'", // URL of your PHP script
//             // url: 'fatch-color.php', data: 'product_id='+pageid+',
//             url: 'fatch-color.php?product_id='+pageid+' ',
//             method: "GET", 
//             data: { selectedcolor: selectedcolor },
//             success: function(data) {
//                 // debugger
//                 // Handle the data retrieved from PHP
//                 // In this example, assuming the PHP script returns an array of objects
//                 var comment 
//                 for (var i = 0; i < data.length; i++) {
//                     comment = data[i];
//                     options = options + '<option value= '+ comment.id + '> '+ comment.size + ' </option>';
//                 }
//                 $('#category-dropdown').html(options);
//             },
//             error: function(xhr, status, error) {
//                 console.error("AJAX Error:", status, error);
//             }
//         });
//    }
  </script>

<script>
    // jQuery code to update hidden input when the visible input changes
    $(document).ready(function () {
        $("#qty-input-num").on("input", function () {
            var newValue = $(this).val();
            $("#hidden_quantity").val(newValue);
        });
    });
</script> -->

<script>

function onColorChange(imageSrc) {
    // console.log("color clicked");

    $('.slick-slide.slick-current.slick-active .img-responsive').attr("src", "");

    document.getElementById("displayedImage").src = imageSrc;
    $('.slick-slide.slick-current.slick-active .img-responsive').attr("src", imageSrc);

   
var elements = document.querySelectorAll(".zoomImg");

// Define the new image source
var newImageSrc = imageSrc;

// Iterate over the selected elements and update their src attribute
for (var i = 0; i < elements.length; i++) {
    elements[i].src = newImageSrc;
}

var filename = imageSrc.substring(imageSrc.lastIndexOf("/") + 1);
    
    // Set the selected image filename to the hidden input field
    $("#selected_color").val(filename);
    $("#selectedColorImage").val(imageSrc);
};


// Add a function to change the image when a slide is clicked
function onSlideClick(slideImageSrc) {
    $(".color_select .selected_color").removeClass("active");
    $('.zoomImg').attr("src", "");
   
    // Update the displayed image source
    // document.getElementById("displayedImage").src = "admin/file/" + slideImageSrc;
    document.getElementById("displayedImage2").src = "admin/file/" + slideImageSrc;
    // $('.slick-slide.slick-current.slick-active .img-responsive').attr("src", slideImageSrc);

    // console.log(slideImageSrc);

    $('.zoomImg').attr("src", "admin/file/" + slideImageSrc);
    // $('.slick-slide.slick-current.slick-active .img-responsive').attr("src", "");

}
</script>

<script>
$(document).ready(function () {
    $('.selected_color').on('click', function () {
        var selectedColor = $(this).attr('value'); // Get the value attribute of the clicked element
        $('.color_name_hidden').val(selectedColor); // Set the hidden input's value
    });
});
</script>

<script>
$(document).ready(function () {
    // Event listener for size dropdown changes
    $('#category-dropdown').on('change', function () {
        // Get the selected size value
        var selectedSize = $(this).val();
        
        // Set the selected size in the hidden input
        $('#selected_size').val(selectedSize);
    });

    $('.selected_color').on('click', function () {
        var pageid = "<?php echo $product_id; ?>";
        var color = $(".color_name_hidden").val();

        // Send the selected product ID and color to fetch-stock.php using POST
        $.ajax({
            url: 'fetch-stock.php',
            method: 'POST', 
            data: {
                product_id: pageid,
                color: color,
                size_query: true
            },
            success: function (data) {
                // Clear existing options in the dropdown
                $('#category-dropdown').empty();
                // Append the response data to the dropdown
                $('#category-dropdown').append(data);
                // console.log(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {
    $('#category-dropdown').on('change', function () {
        var selectedColor = $(".color_name_hidden").val();
        var selectedSize = $('#selected_size').val();
        var pageid = "<?php echo $product_id; ?>";

        // Send the selected color, size, and product ID to fetch-quantity.php
        $.ajax({
            url: 'fetch-stock.php',
            method: 'POST',
            data: {
                product_id: pageid,
                color: selectedColor,
                size: selectedSize,
                quantity_query: true

            },
            success: function (data) {
                // Clear existing options in the sub-category-dropdown
                $('#sub-category-dropdown').empty();
                // Append the response data to the dropdown
                $('#sub-category-dropdown').append(data);
                // console.log(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
</script>

<!-- <script>
$(document).ready(function () {
    $('#category-dropdown').on('change', function () {
        var selectedColor = $(".color_name_hidden").val();
        var selectedSize = $('#selected_size').val();
        var pageid = "<?php //echo $product_id; ?>";

        // Send the selected color, size, and product ID to fetch-stock.php
        $.ajax({
            url: 'fetch-stock.php',
            method: 'POST',
            data: {
                product_id: pageid,
                color: selectedColor,
                size: selectedSize
            },
            success: function (data) {
                if (selectedSize === "") {
                    // Clear the sub-category dropdown if no size is selected
                    $('#sub-category-dropdown').html('');
                } else {
                    // Display the stock quantity
                    $('#sub-category-dropdown').html("Stock: " + data);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    $('.selected_color').on('click', function () {
        var pageid = "<?php //echo $product_id; ?>";
        var color = $(".color_name_hidden").val();

        // Send the selected product ID and color to fetch-stock.php
        $.ajax({
            url: 'fetch-stock.php',
            method: 'POST',
            data: {
                product_id: pageid,
                color: color
            },
            success: function (data) {
                // Clear existing options in the dropdown
                $('#category-dropdown').empty();
                // Append the response data to the dropdown
                $('#category-dropdown').append(data);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
</script> -->



    <!-- <script>
     
     // On clicking submit do following
     $("input[type=submit]").click(function() {
          
         var atLeastOneChecked = false;
         $("input[type=radio]").each(function() {
          
             // If radio button not checked
             // display alert message
             if ($(this).attr("checked") != "checked") {
              
                 // Alert message by displaying
                 // error message
                 $("#msg").html(
     "<span class='note' id='error'>"
     + "Please Choose a Color</span>");

     $("#msg1").html(
     "<span class='note' id='error'>"
     + "Please Choose a Size</span>");
             }
         });
     }); -->
 </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
$(document).ready(function() {
    var userId = "<?php echo $userid; ?>"; // Declare userId in a higher scope

// Define a function to get and update the wishlist count
function updateWishlistCount(userId) {
    // console.log("Updating wishlist count for user ID: " + userId);
    $.ajax({
        type: 'POST', // Change the request type to POST
        url: 'wishlist_guest_action.php',
        data: {
            wish_count: true,
            userid: userId, // Pass the userId as a parameter
            nocache: new Date().getTime()
        },
        success: function(response) {
            // console.log("Response from server: " + response);
            // Update the placeholder element with the retrieved count
            $('#mySpan').text(response);
            $('#mySpan2').text(response);

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
        // console.log("Button clicked");
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
            url: 'wishlist_guest_action.php',
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





    <script>
      $(document).ready(function () {
        $(".color_select .selected_color").click(function () {
          $(".color_select .selected_color").removeClass("active");
          $(this).addClass("active");

          
          var colorValue = $(this).attr("value");
          $("#colorParagraph").text("Color: " + colorValue);

        // For Image Change

        //   if (colorValue === "<?php //echo $color?>") {
        //     $("#displayedImage").attr("src", "https://equipride.co.uk/admin/file/<?php //echo $file ?>");
        //    } 
        // else if (colorValue === "GreenYellow") {
        //     $("#displayedImage").attr("src", "assets\images\product-image\2.jpg");
        //   } else if (colorValue === "Blue") {
        //     $("#displayedImage").attr("src", "assets\images\product-image\3.jpg");
        //   }

        });
      });
    </script>


<script>
    // JavaScript to handle dynamic visibility of size and quantity based on color selection

    // Get references to elements
    var colorListItems = document.querySelectorAll('.selected_color');
    var sizeSelect = document.querySelector('#category-dropdown');
    var quantityInput = document.querySelector('#qty-input-num');

    // Initially hide size and quantity
    sizeSelect.style.display = 'none';
    quantityInput.style.display = 'none';

    // Add click event listeners to color LI elements
    colorListItems.forEach(function (colorListItem) {
        colorListItem.addEventListener('click', function () {
            // Show size select
            sizeSelect.style.display = 'block';
            // Simulate a click on the size select to show the quantity
            sizeSelect.click();
        });
    });

    // Add change event listener to size select
    sizeSelect.addEventListener('change', function () {
        // Show quantity input
        quantityInput.style.display = 'block';
    });
</script>


<script>
        $(document).ready(function () {

            
            $("#category-dropdown").on("change", function() {
                    // Retrieve the selected value and update the hidden input field
                    var selectedValue = $(this).val();
                    $("#selected_size").val(selectedValue);
                });
            // Function to reset color, size, and quantity inputs
            function resetFormInputs() {
                $('input[name="s_image"]').prop('checked', false);
                $('#category-dropdown').val('');
                $('#qty-input-num').val(0);
            }

            // Add an event listener to the submit button
            $("input[type=submit]").click(function (event) {
                var colorChecked = false;
                var sizeSelected = $("select[name='size']").val();
                var valSelected = $("#qty-input-num").val();

                if($(".selected_color").hasClass('active')) {
                    colorChecked = true;
                    
                }

                if (!colorChecked) {
                    // Display an error message for choosing color
                    $("#msg").html("<span class='note' id='error'>Please Choose a Color</span>");
                    // Clear the error message after a timeout (e.g., 3000 milliseconds = 3 seconds)
                    setTimeout(function () {
                        $("#msg").html("");
                    }, 3000);
                } else {
                    // Clear the error message for color
                    $("#msg").html("");
                }

                if (!sizeSelected) {
                    // Display an error message for choosing size
                    $("#msg1").html("<span class='note' id='error'>Please Choose a Size</span>");
                    // Clear the error message after a timeout (e.g., 3000 milliseconds = 3 seconds)
                    setTimeout(function () {
                        $("#msg1").html("");
                    }, 3000);
                } else {
                   
                    // Clear the error message for size
                    $("#msg1").html("");
                }

                if (valSelected <= 0) {
                    // Display an error message for quantity zero
                    $("#msg2").html("<span class='note' id='error'>Quantity Zero</span>");
                    // Clear the error message after a timeout (e.g., 3000 milliseconds = 3 seconds)
                    setTimeout(function () {
                        $("#msg2").html("");
                    }, 3000);
                } else {
                    // Clear the error message for quantity zero
                    $("#msg2").html("");
                }

                // Check if all validations passed
                if (!colorChecked || !sizeSelected || valSelected <= 0) {
                    // Prevent form submission
                    event.preventDefault();
                } else {
                    // Reset the form inputs
                    resetFormInputs();
                }
            });
        });
    </script>





</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>