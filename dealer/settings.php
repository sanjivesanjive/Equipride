<?php
include('../connection.php');
$userid = $_SESSION['admin_id'];

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $localty = $_POST['localty'];
    $country = $_POST['country'];
    $billing_address = $_POST['billing_address'];
    $shipping_address = $_POST['shipping_address'];
    $fil = $_FILES["image"]["name"];
  
    // echo "UPDATE `register_dealer` SET `name`='$name',`dob`='$dob',`email`='$email',`phone` = '$phone',
    // `billing_address`='$billing_address',`shipping_address`='$shipping_address',`image` = '$fil' WHERE `userid`='$userid'";
    // die();
    $res = $con->query("UPDATE `register_dealer` SET `name`='$name',`dob`='$dob',`email`='$email',`phone` = '$phone',`pincode` = '$pincode',`address` = '$address',
    `localty` = '$localty',`country` = '$country',`billing_address`='$billing_address',`shipping_address`='$shipping_address',`image` = '$fil' WHERE `userid`='$userid'");
    $count = mysqli_affected_rows($con);
    ?>
    <script type="text/javascript">
      // alert("Technician updated successsfully")
      window.location = "profile_dealer.php"
    </script>
    <?php
  
  if ($count > 0) {
    move_uploaded_file($_FILES["image"]["tmp_name"], 'admin/file/' . $fil);
    ?>
    <script type="text/javascript">
      // alert("Profile Upload Successfully");
      window.location = "profile_dealer.php";
    </script>

    <?php
  } else {
    header("location:profile_dealer.php");
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
                            <h2 class="ec-breadcrumb-title">Dealer Settings</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="dealer_panal.php">Home</a></li>
                                <li class="ec-breadcrumb-item active">Dealer Settings</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Vendor setting section -->
    <section class="ec-page-content ec-vendor-uploads section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap ec-border-box">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="profile_dealer.php">Dashboard</a></li>
                                        <li><a href="upload.php">Uploads</a></li>
                                        <li><a href="settings.php">Settings (Edit)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $dealer = mysqli_query($con,"SELECT * FROM `register_dealer` WHERE `userid` = '$userid'")or die(mysqli_error($dealer));
                    $d = mysqli_fetch_array($dealer);
                ?>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="ec-vendor-block-img space-bottom-30">
                                            <div class="ec-vendor-block-bg">
                                                <a href="#" class="btn btn-lg btn-primary"
                                                    data-link-action="editmodal" title="Edit Detail"
                                                    data-bs-toggle="modal" data-bs-target="#edit_modal<?php echo $d['id'] ?>">Edit Detail</a>
                                            </div>
                                            <div class="ec-vendor-block-detail">
                                            <?php 
									if($d['gender'] == 'Others'){
										echo '<img src="../images/others-01.png" class="v-img" alt="vendor image" ';
									}else
									
									if($d['gender']== 'Male')
										{
											echo '<img src="../images/male-01.png" class="v-img" alt="vendor image"  >';
										}
										elseif($d['gender'] == 'Female'){
											echo '<img src="../images/female-01.png" class="v-img" alt="vendor image" ';
										}
								  ?>
                                                <h5 class="name"><?php echo $d['name'] ?></h5>
                                                <p>( Retail Business )</p>
                                            </div>
                                        </div>
                                        <h5>Account Information</h5>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>E-mail address </h6>
                                                    <ul>
                                                        <li><strong>Email : </strong><?php echo $d['email'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Contact nubmer</h6>
                                                    <ul>
                                                        <li><strong>Phone Nubmer : </strong><?php echo $d['phone'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>House Number And Street</h6>
                                                    <ul>
                                                        <li><strong>Address : </strong><?php echo $d['address'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Localty</h6>
                                                    <ul>
                                                        <li><strong> Localty : </strong><?php echo $d['localty'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
</div><br>
                                            <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Post Code</h6>
                                                    <ul>
                                                        <li><strong> Post Code : </strong><?php echo $d['pincode'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Country</h6>
                                                    <ul>
                                                        <li><strong> Country : </strong><?php echo $d['country'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
<!-- </div> -->
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Billing Address</h6>
                                                    <ul>
                                                        <li><?php echo $d['billing_address'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact">
                                                    <h6>Shipping Address</h6>
                                                    <ul>
                                                        <li><?php echo $d['shipping_address'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Vendor setting section -->

    <!-- Footer Start -->
    <?php include 'footer_1.php' ?>
    <!-- Footer Area End -->

    <!-- Modal -->
    <div class="modal fade" id="edit_modal<?php echo $d['id'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="ec-vendor-block-img space-bottom-30">
                            <div class="ec-vendor-upload-detail">
                                <form class="row g-3" method="POST" enctype="multipart/form-data">
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Dealer</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $d['userid'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $d['name'] ?>">
                                    </div>

                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Date Of Birth</label>
                                        <input type="text" class="form-control" name="dob" value="<?php echo $d['dob'] ?>" >
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $d['email'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Phone number</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $d['phone'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control" name="pincode" value="<?php echo $d['pincode'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php echo $d['password'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">House Number and Street</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $d['address'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Localty</label>
                                        <input type="text" class="form-control" name="localty" value="<?php echo $d['localty'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" name="country" value="<?php echo $d['country'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Billing Address</label>
                                        <input type="text" class="form-control" name="billing_address" value="<?php echo $d['billing_address'] ?>">
                                    </div>
                                    <div class="col-md-6 space-t-15">
                                        <label class="form-label">Shipping Address</label>
                                        <input type="text" class="form-control" name="shipping_address" value="<?php echo $d['shipping_address'] ?>">
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="col-md-12 space-t-15">
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                        <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal"
                                            aria-label="Close">Close</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

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
        <div class="ec-right-bottom">
            <div class="ec-box">
                <div class="ec-button rotateBackward">
                    <img class="whatsapp" src="assets/images/common/whatsapp.png" alt="whatsapp icon" />
                </div>
            </div>
        </div>
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