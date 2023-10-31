<?php
include ('connection.php');
$id = $_GET['id'];
$product_id = $_GET['product_id'];
$userid = $_SESSION['admin_id'];

if (isset($_POST['submit'])) {
    $total_amount = $_POST["amount"];
    $quantity = $_POST["quantity"];
    $size = $_POST["size"];
    $cart_id = $_POST["cart_id"];
    

    function getNextOrderID($con) {
        $prefix = 'ORDER';
        
        // Query to get the latest order ID
        $latest_order_sql = "SELECT MAX(orderid) AS max_orderid FROM `orders`";
        $result = mysqli_query($con, $latest_order_sql);
        
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $latest_order_id = $row['max_orderid'];
            
            // Extract the numeric part and increment it
            $numeric_part = (int)substr($latest_order_id, strlen($prefix));
            $new_numeric_part = $numeric_part + 1;
            
            // Pad the numeric part with leading zeros to ensure it's three digits
            $new_numeric_part_padded = str_pad($new_numeric_part, 3, '0', STR_PAD_LEFT);
            
            // Construct the new order ID
            $new_order_id = $prefix . $new_numeric_part_padded;
            
            return $new_order_id;
        } else {
            // If there are no existing orders, start with ORDER001
            return $prefix . '001';
        }
    }
    
    $orderid = getNextOrderID($con);

    // Fetch user details
    $userid = mysqli_real_escape_string($con, $userid);
    $user_details_sql = "SELECT * FROM guest WHERE userid='$userid'";
    $user_details_query = mysqli_query($con, $user_details_sql);
    
    if ($user_details = mysqli_fetch_assoc($user_details_query)) {
        // Cart Items
        $cart_items_sql = "SELECT * FROM cart WHERE userid='$userid' AND status='1'";
        $cart_items_query = mysqli_query($con, $cart_items_sql);
    
        // Start a transaction
        mysqli_begin_transaction($con);
    
        try {
            // Loop through cart items and insert each item with the same orderid and user details
            while ($cart_item = mysqli_fetch_assoc($cart_items_query)) {
                $product_name = $cart_item['p_name'];
                $price = $cart_item['price'];
                $size = $cart_item['size'];
                $quantity = $cart_item['quantity'];
                $total = $price * $quantity;
    
                // Insert both user details and cart items into the same row of the orders table
                $order_insert_sql = "INSERT INTO `orders` (orderid, userid, username, email, phone, houseno, town, post_code, country, shipping_address, product_name, price, size, quantity, total, payment_method, payment_status, type)
                VALUES ('$orderid', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'shipping_address', '$product_name', '$price', '$size', '$quantity', '$total', 'null', 'processing', 'guest')";
                
    
                mysqli_query($con, $order_insert_sql);
            }
    
            // Commit the transaction
            mysqli_commit($con);
    
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            mysqli_rollback($con);
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "User not found.";
    }
  
//   echo "UPDATE `cart` SET `quantity`='$quantity',`total_amount`='$total_amount',`status` = '0' WHERE `id`='$cart_id'";
//   die();
    $query = "UPDATE `cart` SET `quantity`='$quantity',`total_amount`='$total_amount',`status` = '0' WHERE `userid` = '$userid'";
    mysqli_query($con, $query) or die(mysqli_error($con));
  
  
    //Reduce Qty in Inventory code starts
//     echo "UPDATE stock set quantity = quantity-$quantity WHERE size = '$size'";
//   die();
    $query1=mysqli_query($con,"UPDATE stock set quantity = quantity-$quantity WHERE size = '$size' ") 
    or die(mysqli_error($con).' line no 91 ');
  
    //Reduce Qty in Inventory code Ends
  
    // $to = "info@scratchsoftwaresolutions.com"; // this is your Email address
    // $from = $_POST['email']; // this is the sender's Email address
    // $subject = $_POST['name'];
    // $subject2 = $_POST["quantity"];
    // $message = 'Order
    // Product Id '.$product_id.'
    //  Product Name '.$_POST['name'].'
    //  Product Quantity '.$_POST["quantity"].'
    //   Price '.$_POST["amount"].'
    //   Order Placed ';
  
    //   $headers = "from:" . $from;
    //   $headers2 = "from:" . $to;
    //   mail($to,$subject,$message,$headers);
    //   mail($from,$subject2,$headers2); // sends a copy of the message to the sender
      // echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
      // header('Location: index.php');
      // You can also use header('Location: thank_you.php'); to redirect to another page.
      // You cannot use header and echo together. It's one or the other.

      

    ?>
        <script type="text/javascript">
          window.location = "checkout_guest.php?id=<?php echo $id ?>&&product_id=<?php echo $product_id ?>&&userid=<?php echo $userid ?>&&orderid=<?php echo $orderid; ?>";
        </script>
  
        <?php
  }



  if (isset($_POST['delete'])) {
    $id = $_POST['color'];
    // echo "DELETE FROM `cart` WHERE `id`='".$id."'";
    // die();
    mysqli_query($con, "DELETE FROM `cart` WHERE `id`='" . $id . "'");
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
 <style>
    .ec-cart-content .table-content table tbody > tr td .cart-qty-plus-minus .ec_cart_qtybtn{
        display: none !important;
    }
    .note {
  font-size: 160%;
  color: red;
}
.note_1 {
  font-size: 60%;
  color: green;
}
    </style>
     <!-- Background css -->
     <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
 </head>

<body class="cart_page">
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
                            <h2 class="ec-breadcrumb-title">Cart</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="guest_panal.php">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cart</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 " style="width: 100.666667%;">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form  method="POST">
                                    <div class="table-content cart-table-content">
                                    <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Size</th>
                                                    <th style="text-align: center;">Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $userid = $_SESSION['admin_id'];
                                            $email = mysqli_query($con, "SELECT * FROM `register` WHERE `userid` = '$userid'") or die(mysqli_error($con));
                                            $e = mysqli_fetch_array($email);
                                                ?>
                                            <input type="hidden" name="email" value="<?php echo $e['email'] ?>"> 
                                            <?php 
                                            $product_cart =  mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '1' ") or die(mysqli_error($con));
                                            if (mysqli_num_rows($product_cart) > 0) {
                                                $counter = 1; // Initialize a counter for unique IDs.
                                                while ($pc = mysqli_fetch_array($product_cart)) {
                                                    $size = $pc['size'];
                                                    $product_name = $pc['p_name'];
                                                    // Query the stock table to get the stock quantity based on product name and size
                                                    $stock_query = mysqli_query($con, "SELECT quantity FROM stock WHERE product_name = '$product_name' AND size = '$size'");
                                                    $stock_data = mysqli_fetch_array($stock_query);
                                        
                                                    // Get the stock quantity
                                                    $stock_quantity = $stock_data['quantity'];
                                                    ?>
                                                    <tr>
                                                        <input type="hidden" name="name" value="<?php echo $pc['p_name'] ?>">
                                                        <input type="hidden" name="stock_quantity" id="stock_quantity-<?php echo $counter; ?>" value="<?php echo $stock_quantity ?>">
                                                

                                                    <td data-label="Product" class="ec-cart-pro-name"><a
                                                            href="product_details_user.php?id=<?php echo $id ?>&&product_id=<?php echo $product_id ?>"><img
                                                                class="ec-cart-pro-img mr-4"
                                                                src="admin/file/<?php echo $pc['s_image'] ?>" alt="" /><?php echo $pc['p_name'] ?></a></td>
                                                    <td data-label="Price" class="ec-cart-pro-price">
                                                    £<span class="unitPrice-<?php echo $pc['pro_id'] ?>"><?php echo $pc['price'] ?></span></td>
                                                    <td>
                                                    <input type="hidden" name="size" value="<?php echo $pc['size'] ?>" >
                                                    <input type="hidden" name="cart_id" value="<?php echo $pc['id'] ?>" >    
                                                    <?php echo $pc['size'] ?></td>
                                                    <td data-label="Quantity" class="ec-cart-pro-qty"
                                                        style="text-align: center;">
                                                        <div class="error-message-<?php echo $pc['pro_id']; ?>" style="color: red;"></div>

                                                        <div class="cart-qty-plus-minus">

                                                       <input type="number" onClick="calc(<?php echo $pc['pro_id']; ?>, <?php echo $counter; ?>)" class="quantity-<?php echo $pc['pro_id']; ?> form-control" name="quantity" value="<?php echo $pc['quantity']; ?>"/>

                                                        </div>

                                                    </td>
                                                    <td data-label="Total" class="ec-cart-pro-subtotal">£<span class="totalPrice-<?php echo $pc['pro_id'] ?>"></span></td>
                                                    <td data-label="Remove" class="ec-cart-pro-remove">
                                                        <!-- <a href="#"><i class="ecicon eci-trash-o"></i></a> -->
                                                        <form method="post">
                                                        <input type="hidden" name="color" value="<?php echo $pc['id'] ?> ?>" />
                                                        <button type="submit" class="btn btn-primary" name="delete"><i class="ecicon eci-trash-o"></i></button>
                                                            <!-- <a class="btn btn-primary" href="#">Place Order</a> -->
                                                        </span>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <?php  $counter++; }} else{
																
																?>
																
																<tr> <h1 class="text-center">Your Cart Was empty</h1></tr>
																
																	<?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12"><br>
                                            <div class="ec-sidebar-block">
                                                <div class="ec-sb-title">
                                                    <h3 class="ec-sidebar-title">Summary</h3>
                                                </div>

                                                <div class="ec-sb-block-content">
                                                    <div class="ec-cart-summary-bottom">
                                                        <div class="ec-cart-summary">
                                                            <div class="ec-cart-summary-total">
                                                            <input type="hidden" name="amount" class="totalAmount" id="totalAmount" value="">
                                                                <span class="text-left">Total Amount</span>
                                                                <span class="text-right totalAmount"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-cart-update-bottom">
                                                <a href="full_category_guest.php">Continue Shopping</a>
                                                <button type="submit" class="btn btn-primary" name="submit" value="Check Out" style="">Check Out</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                
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
                                <a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>" >
                                    <img class="main-image" src="admin/file/<?php echo $pc['file'] ?>" alt="Product" />
                                    <!-- <img class="hover-image" src="admin/file/<?php echo $pc['file'] ?>" alt="Product" /> -->
                                </a>
                                <!-- <span class="percentage">20%</span> -->
                                <div class="ec-pro-actions">
                                                <a href="#" class="quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $pc['product_id'] ?>"><i class="fi-rr-eye"></i></a>
                                                    <!-- <a href="compare.html" class="ec-btn-group compare"
                                                        title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                        <a title="Add To Cart" href="product_details_guest.php?id=<?php echo $pc['id']?>&product_id=<?php echo $pc['product_id']?>" class="add-to-cart" id="addToCartButton">
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
                            <h5 class="ec-pro-title"><a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></h5>
                            <div class="ec-pro-list-desc"><?php echo $pc['description'] ?></div>
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
                                                data-tooltip="Gray"><span style="background-color:#e8c2ff;"></span></a>
                                        </li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                                data-src="assets/images/product-image/6_2.jpg"
                                                data-src-hover="assets/images/product-image/6_2.jpg"
                                                data-tooltip="Orange"><span
                                                    style="background-color:#9cfdd5;"></span></a></li>
                                    </ul>
                                </div>
                                <div class="ec-pro-size">
                                    <span class="ec-pro-opt-label">Size</span>
                                    <ul class="ec-opt-size">
                                        <li class="active"><a href="#" class="ec-opt-sz" data-old="$25.00"
                                                data-new="$20.00" data-tooltip="Small">S</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$27.00" data-new="$22.00"
                                                data-tooltip="Medium">M</a></li>
                                        <li><a href="#" class="ec-opt-sz" data-old="$35.00" data-new="$30.00"
                                                data-tooltip="Extra Large">XL</a></li>
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
                                <h5 class="ec-quick-title"><a href="product_details_guest.php?id=<?php echo $pc['id'] ?>&&product_id=<?php echo $pc['product_id'] ?>"><?php echo $pc['name'] ?></a></h5>


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
                <div class="col-sm-12 shop-all-btn"><a href="full_category_guest.php">Shop All Collection</a></div>
            </div>
        </div>
    </section>
    <!-- New Product end -->

    <!-- Footer Start -->
    <?php include ('footer_guest.php'); ?>
    <!-- Footer Area End -->

    <!-- Modal -->
    <div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <!-- Swiper -->
                            <div class="qty-product-cover">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                            <div class="qty-nav-thumb">
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_1.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_2.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_3.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_4.jpg" alt="">
                                </div>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="assets/images/product-image/3_5.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html">Handbag leather purse for
                                        women</a>
                                </h5>
                                <div class="ec-quickview-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>

                                <div class="ec-quickview-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s,</div>
                                <div class="ec-quickview-price">
                                    <span class="old-price">$100.00</span>
                                    <span class="new-price">$80.00</span>
                                </div>

                                <div class="ec-pro-variation">
                                    <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>Color</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <li><span style="background-color:#696d62;"></span></li>
                                                <li><span style="background-color:#d73808;"></span></li>
                                                <li><span style="background-color:#577023;"></span></li>
                                                <li><span style="background-color:#2ea1cd;"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <span>Size</span>
                                        <div class="ec-pro-variation-content">
                                            <ul class="ec-opt-size">
                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                        data-tooltip="Small">S</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Medium">M</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Large">X</a></li>
                                                <li><a href="#" class="ec-opt-sz" data-tooltip="Extra Large">XL</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-primary"><i class="fi-rr-shopping-basket"></i> Add To
                                            Cart</button>
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
            //  debugger
            var total = parseFloat($('.unitPrice-<?php echo $pp['pro_id'] ?>').html()) * parseFloat($('.quantity-<?php echo $pp['pro_id'] ?>').val());
            $('.totalPrice-<?php echo $pp['pro_id'] ?>').html(total);
            totalAmount = totalAmount + total;
            <?php }} ?>
            $('.totalAmount').html('£' +totalAmount);
            $('.totalAmount').val(totalAmount);   
           
        });
    </script>
<script>
function calc(id, counter) {
    var unitPrice = parseFloat($('.unitPrice-' + id).text());
    var quantityInput = $('.quantity-' + id);
    var stockQuantity = parseFloat($('#stock_quantity-' + counter).val());

    // Handle the input event (when the user types in the input).
    quantityInput.on('input', function() {
        var quantity = parseFloat($(this).val());

        // Check if the cart quantity is greater than the stock quantity.
        if (quantity > stockQuantity) {
            // Display an error message specific to the product.
            $('.error-message-' + id).html('Quantity exceeds').show();

            // Set the input value to the stock quantity.
            $(this).val(stockQuantity);
            quantity = stockQuantity; // Update the quantity variable.
        } else if (quantity < 0) {
            // Prevent negative values, reset to 0.
            $(this).val(0);
            quantity = 0;
        } else {
            // Hide the error message if the quantity is within the stock limit or greater than zero.
            $('.error-message-' + id).html('').hide();
        }

        var total = unitPrice * quantity;
        // Format the total to have two decimal places
        total = total.toFixed(2);
        $('.totalPrice-' + id).html(total);

        var totalAmount = 0;

        <?php 
        $product_price = mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` ='$userid' AND `status` = '1' ") or die(mysqli_error($con));
        if (mysqli_num_rows($product_price) > 0) {
            while ($pp = mysqli_fetch_array($product_price)) {
        ?>
        var currentQuantity = parseFloat($('.quantity-<?php echo $pp['pro_id'] ?>').val());
        var total = parseFloat($('.unitPrice-<?php echo $pp['pro_id'] ?>').html()) * currentQuantity;
        // Format the total to have two decimal places
        total = total.toFixed(2);
        $('.totalPrice-<?php echo $pp['pro_id'] ?>').html(total);
        totalAmount += parseFloat(total);

        <?php }} ?>

        // Format the total amount to have two decimal places
        totalAmount = totalAmount.toFixed(2);
        $('.totalAmount').html('£' + totalAmount);
    });

    // Handle the click event (when the user clicks the input).
    quantityInput.on('click', function() {
        // Select the input content for easy editing.
        $(this).select();
    });
}

</script>

</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>