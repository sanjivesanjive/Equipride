<?php
ini_set('session.gc_maxlifetime', 3600);

session_start();
include 'connection.php';
if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Perform user authentication
    $sql = mysqli_query($con, "SELECT * FROM `admin` WHERE (`email`='$email' and `password`='$pass') and `type`='user'") or die("error");
    $row = mysqli_num_rows($sql);

    if ($row == 1) {
        $user = mysqli_fetch_array($sql);
        $user_id = $user['userid'];
        $close = $user['status'];

        if ($close == '0') {
            ?>
            <script type="text/javascript"> 
                alert("Your Login Has Temporarily Closed! Contact Admin...!"); 
            </script>
            <?php
        } else {
            $_SESSION['admin_id'] = $user_id;

            // Check if the parameters indicating login from product_details.php are set
            if (isset($_GET['id']) && isset($_GET['product_id'])) {
                // User logged in via "Add To Cart" button, handle the cart addition and redirect
                $product_id = $_GET['product_id'];
                $image_name = $_GET['product_image'];
                $p_name = $_GET['product_name'];
                $price = $_GET['price'];
                $quantity = $_GET['quantity'];
                $size = $_GET['size'];  // Size with special characters

                $insert_query = "INSERT INTO `cart` (`userid`, `pro_id`, `s_image`, `p_name`, `price`, `quantity`, `size`, `type_1`, `status`)
                     VALUES ('$user_id', '$product_id', '$image_name', '$p_name', '$price', '$quantity', '$size', 'Customer', '1')";

                $cart_insert_query = mysqli_query($con, $insert_query);

                if ($cart_insert_query) {
                    header("Location: user_panal.php");
                    exit;
                } else {
                    // Handle the case where cart addition fails (you may want to display an error message)
                }
            } else {
                // Regular login behavior without adding to cart
                ?>
                <script type="text/javascript">
                    window.location = "user_panal.php"; // Redirect to the user panel
                </script>
                <?php
            }
        }
    }
}
        
    if (isset($_POST["guest"])) {
        $n = 10;
    
        // Function to generate a random string
        function generateRandomString($length) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
    
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
    
            return $randomString;
        }
    
        // Generate a random guest ID, email, and password
        $guest_id = generateRandomString($n);
        $email = 'guest_' . $guest_id . '@example.com'; // You can change the email format
        $password = generateRandomString(8); // Generate a random password
    
        // Insert the guest account information into the 'guest' and 'admin' tables
        $insertGuestQuery = "INSERT INTO `guest` (`userid`, `email`, `password`, `status`) VALUES ('$guest_id', '$email', '$password', '1')";
        $insertAdminQuery = "INSERT INTO `admin` (`userid`, `email`, `password`, `type`, `status`) VALUES ('$guest_id', '$email', '$password', 'guest', '1')";
    
        if (mysqli_query($con, $insertGuestQuery) && mysqli_query($con, $insertAdminQuery)) {
            // Successfully inserted, log in as the guest
            $_SESSION['admin_id'] = $guest_id;
    
            // Check for the presence of specific GET parameters in the URL
            if (isset($_GET['id']) && isset($_GET['product_id'])) {
                // Redirect to a different page when parameters are present
                // $redirectURL = "product_details_guest.php?id={$_GET['id']}&product_id={$_GET['product_id']}&from_product_details=1&guest_id=$guest_id";
                $product_id = $_GET['product_id'];
                $image_name = $_GET['product_image'];
                $p_name = $_GET['product_name'];
                $price = $_GET['price'];
                $quantity = $_GET['quantity'];
                $size = $_GET['size'];  // Size with special characters
            
                $insert_query = "INSERT INTO `cart` (`userid`, `pro_id`, `s_image`, `p_name`, `price`, `quantity`, `size`, `type_1`, `status`)
                     VALUES ('$guest_id', '$product_id', '$image_name', '$p_name', '$price', '$quantity', '$size', 'Customer', '1')";

                $cart_insert_query = mysqli_query($con,$insert_query);
                // Create a prepared statement with placeholders
                // $insert_query = "INSERT INTO `cart` (`userid`, `pro_id`, `s_image`, `p_name`, `price`, `quantity`, `size`, `type_1`, `status`)
                //                  VALUES (?, ?, ?, ?, ?, ?, ?, 'Customer', '1')";
            
                // Prepare the statement
                // $stmt = mysqli_prepare($con, $insert_query);
            
                // if ($stmt) {
                //     // Bind the parameters and set their data types
                //     mysqli_stmt_bind_param($stmt, "issddss", $guest_id, $product_id, $s_image, $p_name, $price, $quantity, $size);

            
                //     // Execute the prepared statement
                //     if (mysqli_stmt_execute($stmt)) {
                //         // Query executed successfully
                //     } else {
                //         // Handle the error, if any
                //         echo "Error: " . mysqli_stmt_error($stmt);
                //     }
            
                //     // Close the statement
                //     mysqli_stmt_close($stmt);
                // } else {
                //     // Handle the error, if any
                //     echo "Error: " . mysqli_error($con);
                // }
            
                // Redirect after data insertion
                header("location: guest_panal.php");  // Redirect to the desired page
            }
            else {
                // Normal guest login behavior
                $redirectURL = "guest_panal.php";
            }
            $redirectURL = "guest_panal.php";
            // Redirect to the desired page

            header("Location: $redirectURL");
            exit;
        } else {
            // Handle the case where insertion fails
            echo "Guest account creation failed.";
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

     <script>
        console.log(typeof <?php echo $size ?>);
     </script>


 </head>
<body>
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Header start  -->
    <?php include 'header.php' ?>
    <!-- Header End  -->

    <!-- ekka Cart Start -->
    <?php include 'cart_box.php' ?>
    <!-- ekka Cart End -->

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Login</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="ec-breadcrumb-item active">Login</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec login page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Log In</h2>
                        <h2 class="ec-title">Log In</h2>
                        <p class="sub-title mb-3">Best place to buy and sell digital products</p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form  method="POST">
                                <span class="ec-login-wrap">
                                    <label>Email Address*</label>
                                    <input type="email" name="email" placeholder="Enter your email add..." required />
                                </span>
                                <span class="ec-login-wrap">
                                    <label>Password*</label>
                                    <input type="password" name="password" placeholder="Enter your password" required />
                                </span>
                                <span class="ec-login-wrap ec-login-fp">
                                    <label><a href="forgotPassword.php">Forgot Password?</a></label>
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary"  name="login" type="submit">Login</button>
                                    <a href="register.php" class="btn btn-secondary">Register</a>
                                </span>
                            </form>
                            <form method="post">
                                    <p class="w-100 text-center">&mdash; Continue As Guest &mdash;</p>
                                    <input type="hidden" name="email" id="randomemail"/>
                                    <div class="social d-flex text-center">
                                    <button type="submit" name="guest" class="btn btn-secondary">Guest
                                            </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <?php include 'footer.php' ?>
    <!-- Footer Area End -->

    <!-- Footer navigation panel for responsive display -->
    <?php include 'mobilebar.php' ?>

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
    <script>
        var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
var string = '';
for(var ii=0; ii<15; ii++){
    string += chars[Math.floor(Math.random() * chars.length)];
}
$('#randomemail').val(string + '@equipride.com');
</script>
</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>