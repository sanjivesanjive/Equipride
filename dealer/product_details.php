<?php
include('../connection.php');
$id = $_GET['id'];
$product_id = $_GET['product_id'];
$userid = $_SESSION['admin_id'];



if (isset($_POST["cart"])) {


    $p_name = $_POST["p_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $size = $_POST["size"];
    $s_image = $_POST["s_image"];

    mysqli_query($con, "INSERT INTO `cart`( `userid`, `pro_id`,`s_image`,`p_name`, `price`, `quantity`, `size`,`type_1`,`status`)  VALUES
   ('$userid','$id','$s_image','$p_name','$price','$quantity','$size','Dealer','1')") or die(mysqli_error($con));


    ?>
          <script type="text/javascript">
            window.location = "cart.php?id=<?php echo $id ?>&&product_id=<?php echo $product_id ?>";
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
 
     <!-- Main Style -->
     <link rel="stylesheet" href="assets/css/style.css" />
     <link rel="stylesheet" href="assets/css/responsive.css" />
 
     <!-- Background css -->
     <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
     <style>
  /* Basic Styling */
/* .slick-slide {
    width: 16px;
  } */
   /* .slick-active 
  {
  width: 162px !important;
  } */
  .draggable {
    width: 80% !important;
}
.note {
  font-size: 120%;
  color: red;
}
label {
  text-transform: capitalize;
}
/* .slick-slide
.slick-active
{
    width: 200%;
} */
/* .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 15px;
  display: flex;
} */
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


/* Right Column */

/* Product Description */
.product-description {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
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
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
}

.color-choose input[type="radio"] + label span {
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
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
}

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
    <?php include('header.php') ?>

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
                            <h2 class="ec-breadcrumb-title">Single Products</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="dealer_panal.php">Home</a></li>
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
            $product_details = mysqli_query($con, "SELECT * FROM `product` WHERE `id`='$id' AND `product_id`='$product_id' AND `type_1`='Dealer'") or die("error");
            $pd = mysqli_fetch_array($product_details);
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
                                                <img class="img-responsive" src="../admin/file/<?php echo $pd['file'] ?>"
                                                    alt="">
                                            </div>
                            
                                            <?php
                                            $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive" src="../admin/file/<?php echo $i['file'] ?>"
                                                            alt="">
                                                    </div>
                                                <?php }
                                            } ?>

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
                                        <div class="single-slide">
                                                <img class="img-responsive" src="../admin/file/<?php echo $pd['file'] ?>" style="height: 115px;"
                                                    alt="">
                                            </div>
                                        
                                            <?php
                                            $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="../admin/file/<?php echo $i['file'] ?>" style="height: 115px;"
                                                            alt="">
                                                    </div>
                                                <?php }
                                            } ?>

                                                    <!-- <div class="single-slide">
                                                        <img class="img-responsive" src=""
                                                            alt="">
                                                    </div>
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src=""
                                                            alt="">
                                                    </div> -->
                                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar">
                                    <div class="single-pro-content">
                              
                                        <h5 class="ec-single-title"><?php echo $pd['name'] ?></h5>
                                        <div class="ec-single-desc"><?php echo $pd['description'] ?></div>
                                        <div class="ec-single-price-stoke" style="padding-top: 85px;">
                                            <div class="ec-single-price">
                                                <span class="ec-single-ps-title">As low as</span>
                                                <span class="new-price">£<?php echo $pd['dealer_price'] ?></span>
                                            </div>
                                        </div>
                                        <div class="ec-pro-variation">
                                            <div class="ec-pro-variation-inner ec-pro-variation-size">
                                                <span>SIZE</span>
                                                <div class="ec-pro-variation-content">
                                                <select name="size" class="form-control" data-choices required >
                                                    <option value="">Please Select Size</option>
                                                    <?php
                                                    $Product_Name = mysqli_query($con, "SELECT * FROM `stock` where `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                                    while ($c = mysqli_fetch_array($Product_Name)) {
                                                        ?>
                                                            <option value="<?php echo $c['id'] ?>"><?php echo $c['size'] ?></option>
                                                            <?php
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="ec-pro-variation-inner ec-pro-variation-color">
                                                <span>Color</span>
                                                <div class="single-nav-thumb color-choose">
                                                    <div class="single-slide " style="width: 29px;" >
                                                        <input type="radio" required name="s_image" class="img-responsive"  value="<?php echo $pd['file']; ?>" id="<?php echo $pd['color']; ?>"  src="../admin/file/<?php echo $pd['file'] ?>"  width="100px">
                                                        <label for="<?php echo $pd['color']; ?>"><span></span><br><?php echo $pd['color']; ?></label>
                                                    </div>
                                                    <?php
                                                    $image = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($image) > 0) {
                                                        while ($i = mysqli_fetch_array($image)) {
                                                            ?>
                                                            <div class="single-slide" style="width: 29px;">
                                                                <input type="radio" required name="s_image" class="img-responsive"  value="<?php echo $i['file']; ?>" id="<?php echo $i['color']; ?>"  src="../admin/file/<?php echo $i['file'] ?>"  width="100px">
                                                                <label for="<?php echo $i['color']; ?>"><span></span><br><?php echo $i['color']; ?></label>
                                                            </div>
                                                        <?php }
                                                    } ?>
                                                    <!-- <div class="single-slide">
                                                        <img class="img-responsive" src=""
                                                            alt="">
                                                    </div>
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src=""
                                                            alt="">
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ec-single-qty">
                                            <div class="qty-plus-minus">
                                                <input class="qty-input" onClick="calc(<?php echo $pd['id'] ?>)"
                                                 type="text" id="input1<?php echo $pd['id'] ?>" name="quantity" value="1" />
                                            </div>
                                            <div class="ec-single-cart ">
                                            <!-- <input type="submit" class="btn btn-primary" name="cart" value="Add To Cart" > -->
                                                <!-- <button class="btn btn-primary">Add To Cart</button> -->
                                                <a href="#" class="btn btn-primary" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_modal<?php echo $product_id ?>">Add To Cart</a>
                                            </div>
                                            <!-- <div class="ec-single-wishlist">
                                                <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                            </div> -->
                                            <!-- <div class="ec-quickview-cart ">
                                                <button class="btn btn-primary"><i class="fi-rr-heart"></i> Add To Cart</button>
                                                <input type="submit" class="btn btn-white w-100 text-center mt-3" name="cart" value="Add To Cart">
                                            </div> -->
                                            <div class="ec-single-quickview">
                                                <a href="#" class="ec-btn-group quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $product_id ?>"><i class="fi-rr-eye"></i></a>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="ec_modal<?php echo $product_id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                            <div class="table-responsive">
                                    <table id="responsive-data-table" class="table" style="width:100%">
											<thead>
												<tr>
													<th>S/No</th>
													<th>Customer/Dealer</th>
													<th>Product Name</th>
													<th>Category</th>
													<th>Sub Category</th>
													<th>CustomerPrice</th>
													<th>DealerPrice</th>
													<th>Size</th>
													<th>Color</th>
													<th>Quantity</th>
													<th>Stock Date</th>
													<th>Quantity In</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											<?php
												$i = 1;
												$query = mysqli_query($con, "SELECT * FROM `stock` WHERE `product_id` = '$product_id' ");
												if (mysqli_num_rows($query) > 0) {
												while ($q = mysqli_fetch_array($query)) {
                                                    $id = $q['id'];

													?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['size'] ?></td>
													<td><?php echo $q['color'] ?></td>
													<td><?php echo $q['quantity'] ?></td>
													<form method="POST">
													<td>
                                                                            <?php
                                                                            if ($q['quantity'] == "0") {
                                                                                echo ' 
                                                                                <input type="hidden" name="id" value="' . $q['id'] . '">
                                                                                <input type="hidden" name="p_id" value="' . $q['product_id'] . ' ">
                                                                                <input type="date" name="u_date" class="form-control"><br>
                                                                                <button type="submit" name="update_stock" class="btn btn-info btn-sm">Next Update</button>';
                                                                            } else {


                                                                            }
                                                                            ?>
                                                                        </td>
																		<td>
																		<?php
                                                                     if($q['update_stock']=="waitting")
                                                                       {
                                                                        ?>
                                                                       <input type="hidden" name="uid" value="<?php echo $q['id'] ?>">
                                                                                    <input type="hidden" name="up_id" value="<?php echo $q['product_id'] ?>">
                                                                                    <input type="text" name="quantity" class="form-control"><br>
                                                                                    <button type="submit" name="update_1" class="btn btn-warning btn-sm">Out Of Stock</button>
                                                                     <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo'<h4><span class="badge badge-success">Stock IN</span></h4>';    
                                                                        }
                                                                        ?>
																				</td>
																		</form>

													<td>
                                                    <div class="btn-group">
															<button type="button"
																class="btn btn-outline-success">Info</button>
															<button type="button"
																class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
																data-bs-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false" data-display="static">
																<span class="sr-only">Info</span>
															</button>

															<div class="dropdown-menu">
                                                            <button type="button" class="btn-edit-icon" data-bs-toggle="modal"
                                                                data-bs-target="#modal-add-contact<?php echo $q['id'] ?>">Edit
                                                            </button>
                                                            &nbsp;&nbsp;&nbsp;   
                                                                <form method="POST">
                                                                    <input type="hidden" name="id" value="<?php echo $q['id'] ?>">
                                                                    <button type="submit"
                                                                        onclick="if (! confirm('Do you want delete this data')) { return false; }"
                                                                        name="delete" class="dropdown-item">Delete</button>
                                                                </form>
															</div>
														</div>
													</td>
												</tr>
												<!-- Add Contact Button  -->
												<div class="modal fade modal-add-contact" id="modal-add-contact<?php echo $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
														<div class="modal-content">
														<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
																<div class="modal-header px-4">
																	<h5 class="modal-title" id="exampleModalCenterTitle">Edit Stock</h5>
																</div>
																<?php
																					$query2=mysqli_query($con,"SELECT * FROM `stock` WHERE `id` = '$id'  ") ;
																					$q2=mysqli_fetch_array($query2);
																					?>
																<div class="modal-body px-4">

																	<div class="row mb-2">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="firstName">Customer/Dealer</label>
                                                                                <input type="text" name="type_1" class="form-control"  value="<?php echo $q2['type_1'] ?>">
                        													</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="form-group">
																			<label for="username">Product Name</label>
                                                                            <input type="text" class="form-control" name="product_name" value="<?php echo $q2['product_name'] ?>"
                                                                                >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Category</label>
																			<input type="text" class="form-control" name="category" value="<?php echo $q2['category'] ?>"
                                                                            >
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Sub Category</label>
																			<input type="text" class="form-control" name="sub_category" value="<?php echo $q2['sub_category'] ?>"
                                                                            >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Size</label>
																			<input type="text" class="form-control" name="size" value="<?php echo $q2['size'] ?>"
                                                                            >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Color</label>
																			<input type="text" class="form-control" name="color" value="<?php echo $q2['color'] ?>"
                                                                            >
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                            <label for="username">Quantity</label>
                                                                            <input type="text" class="form-control" name="quantity"
                                                                            value="<?php echo $q2['quantity'] ?>">
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                            <label for="username">Customer Price</label>
                                                                            <input type="text" class="form-control" name="price" value="<?php echo $q2['price'] ?>">
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                                <label for="username">Dealer Price</label>
                                                                                <input type="text" class="form-control" name="dealer_price" value="<?php echo $q2['dealer_price'] ?>">
                                                                            </div>
                                                                        </div>
																	</div>
																</div>

																<div class="modal-footer px-4">
																	<button type="button" class="btn btn-secondary btn-pill"
																		data-bs-dismiss="modal">Cancel</button>
																		<input type="hidden" name="rid" value="<?php echo $q2['id'] ?>">

																	<button type="submit" name="submit" class="btn btn-primary btn-pill">Submit</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<?php }} ?>
											</tbody>
										</table>
									</div>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="quantity" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <!-- <button class="btn btn-primary" type="submit" name="cart"><i class="fi-rr-heart"></i> Add To Cart</button> -->
                                        <input type="submit" class="btn btn-primary" name="cart" value="Add To Cart">
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
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                            role="tablist">More Information</a>
                                    </li> -->
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
                                        <ul>
                                            <li><span>Weight</span> 1000 g</li>
                                            <li><span>Dimensions</span> 35 × 30 × 7 cm</li>
                                            <li><span>Color</span> Black, Pink, Red, White</li>
                                        </ul>
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
                $product = mysqli_query($con, "SELECT * FROM `product` WHERE `type_1` = 'Dealer' ORDER BY `product`.`id` ASC LIMIT 4; ") or die(mysqli_error($con));
                if (mysqli_num_rows($product) > 0) {
                    while ($p = mysqli_fetch_array($product)) {
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                            <div class="ec-product-inner">
                                <div class="ec-pro-image-outer">
                                    <div class="ec-pro-image">
                                        <a href="product_details.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>" >
                                            <img class="main-image"
                                                src="../admin/file/<?php echo $p['file'] ?>" alt="Product" />
                                            <!-- <img class="hover-image"
                                                src="../admin/file/<?php echo $p['file'] ?>" alt="Product" /> -->
                                        </a>
                                        <div class="ec-pro-actions">
                                                        <a href="#" class="quickview" data-link-action="quickview"
                                                            title="Quick view" data-bs-toggle="modal"
                                                            data-bs-target="#ec_quickview_modal<?php echo $product_id ?>"><i class="fi-rr-eye"></i></a>
                                                            <button title="Add To Cart" class="add-to-cart"><i
                                                                    class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                                                    <form method="POST" enctype="multipart/form-data" >
                                                                        <input type="hidden" name="file" value="<?php echo $p['file'] ?>">
                                                                        <input type="hidden" name="product_id" value="<?php echo $p['product_id'] ?>">
                                                                        <input type="hidden" name="p_name" value="<?php echo $p['name'] ?>">
                                                                        <input type="hidden" name="price" value="<?php echo $p['price'] ?>">
                                                                        <button title="Wishlist" type="submit" name="wishlist" class="ec-btn-group wishlist"><i class="fi-rr-heart"></i> </button>
                                                                    <!-- <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a> -->
                                                                    </form>
                                                        </div>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="product_details.php?id=<?php echo $p['id'] ?>&&product_id=<?php echo $p['product_id'] ?>"><?php echo $p['name'] ?></a></h5>
                                    <div class="ec-pro-list-desc"><?php echo $p['file'] ?></div>
                                    <span class="ec-price">
                                        <span class="new-price">£<?php echo $p['dealer_price'] ?></span>
                                    </span>
                                    <div class="ec-pro-option">
                                        <div class="ec-pro-color">
                                            <!-- <span class="ec-pro-opt-label">Color</span> -->
                                            <!-- <ul class="ec-opt-swatch ec-change-img">
                                        <li class="active"><a href="#" class="ec-opt-clr-img"
                                                data-src="../admin/file/<?php echo $p['file'] ?>"
                                                data-src-hover="../admin/file/<?php echo $p['file'] ?>"
                                                data-tooltip="Gray"><span
                                                    style="background-color:#e8c2ff;"></span></a></li>
                                        <li><a href="#" class="ec-opt-clr-img"
                                                data-src="assets/images/product-image/6_2.jpg"
                                                data-src-hover="assets/images/product-image/6_2.jpg"
                                                data-tooltip="Orange"><span
                                                    style="background-color:#9cfdd5;"></span></a></li>
                                    </ul> -->
                                        </div>
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
                    <?php }
                } ?>
            </div>
        </div>
    </section>
    <!-- Related Product end -->

    <!-- Footer Start -->
    <?php include 'footer_1.php'; ?>

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
                                    <img class="img-responsive" src="../admin/file/<?php echo $pd['file'] ?>" alt="">
                                </div>
                                <?php
                                            $image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $i['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <?php
                                            $image1 = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image1) > 0) {
                                                while ($i1 = mysqli_fetch_array($image1)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $i1['file'] ?>" alt="">
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
                                    <img class="img-responsive" src="../admin/file/<?php echo $pd['file'] ?>" alt="">
                                </div>
                                <?php
                                            $image = mysqli_query($con, "SELECT * FROM `additional` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image) > 0) {
                                                while ($i = mysqli_fetch_array($image)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $i['file'] ?>" alt="">
                                </div>
                                <?php }} ?>
                                <?php
                                            $image1 = mysqli_query($con, "SELECT * FROM `image` WHERE  `product_id`='$product_id' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($image1) > 0) {
                                                while ($i1 = mysqli_fetch_array($image1)) {
                                                    ?>
                                <div class="qty-slide">
                                    <img class="img-responsive" src="../admin/file/<?php echo $i1['file'] ?>" alt="">
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
                                <h5 class="ec-quick-title"><a href="product_details.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>"><?php echo $pd['name'] ?></a></h5>


                                <div class="ec-quickview-desc"><?php echo $pd['description'] ?></div>
                                <div class="ec-quickview-price">
                                £<span class="new-price"><?php echo $pd['dealer_price'] ?></span>
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
                                    <a class="btn btn-primary" href="product_details.php?id=<?php echo $pd['id'] ?>&&product_id=<?php echo $pd['product_id'] ?>">View Product</a>
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

</body>
<script type="text/javascript"
  id="zsiqchat">var $zoho = $zoho || {}; $zoho.salesiq = $zoho.salesiq || { widgetcode: "a8be1c2bd3e72b72bd70d99f2cc3fc933de2be852ff73457ef608c555258f13ca81d6b547a35c109951d24f6be71d2d0", values: {}, ready: function () { } }; var d = document; s = d.createElement("script"); s.type = "text/javascript"; s.id = "zsiqscript"; s.defer = true; s.src = "https://salesiq.zoho.in/widget"; t = d.getElementsByTagName("script")[0]; t.parentNode.insertBefore(s, t);</script>
</html>