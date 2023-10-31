<?php
include('../connection.php');
if(!isset($_SESSION['admin_id']))
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}

if (isset($_POST['stock'])) {
    $id = $_POST['product_id'];
    $product_name = $_POST['name'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $dealer_price = $_POST['dealer_price'];
    $type_1 = mysqli_real_escape_string($con, $_POST['type_1']);

    // Create a prepared statement with placeholders
    $query = "INSERT INTO `stock` (`product_id`, `product_name`, `category`, `sub_category`, `quantity`, `size`, `color`, `price`, `dealer_price`, `type_1`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1')";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        // Bind the parameters and set their data types
        mysqli_stmt_bind_param($stmt, "ssssssssss", $id, $product_name, $category, $sub_category, $quantity, $size, $color, $price, $dealer_price, $type_1);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Query executed successfully
        } else {
            // Handle the error, if any
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error, if any
        echo "Error: " . mysqli_error($con);
    }

    // Redirect after data insertion
    echo '<script type="text/javascript">window.location = "add_stock.php";</script>';
}

if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  // echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
  // die();
  mysqli_query($con, "DELETE FROM `stock` WHERE `id`='" . $id . "'");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title><?php echo $title ?></title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- No Extra plugin used -->

	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- ekka CSS -->
	<link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css" />

	<!-- FAVICON -->
	<link href="images/Logo editted.png" rel="shortcut icon" />
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">

	<!-- WRAPPER -->
	<div class="wrapper">

		<!-- LEFT MAIN SIDEBAR -->
        <?php include 'sidebar.php' ?>


		<!-- PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
            <?php include 'header.php' ?>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
						<h1>Add Stock's For Product</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Stock
						</p>
						</div>
						<div>
							<!-- <a href="add_stock.php" class="btn btn-primary"> Add Stock</a> -->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-body">
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
													<th>Color</th>
													<th>Size</th>
													<th>Quantity</th>
													<th>Action</th>
													<th>Add Stock For Color's</th>
												</tr>
											</thead>

											<tbody>
											<?php
												$i = 1;
												// echo "SELECT * FROM `product` INNER JOIN`image` ON `product`.`product_id` = `image`.`product_id` ";
												$query = mysqli_query($con, "SELECT * FROM `product` ");
												if (mysqli_num_rows($query) > 0) {
												while ($q = mysqli_fetch_array($query)) {
                                                    $id = $q['sub_category'];

													?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['name'] ?></td>
													<td> <?php echo $q['category'] ?></td>
													<td><?php echo $q['sub_category'] ?></td>
													<td><?php echo $q['price'] ?></td>
													<td><?php echo $q['dealer_price'] ?></td>
													<td><?php echo $q['color'] ?></td>
													<form method="POST">
													<td> 
								                        <select class="form-control" name="size"  required>
															<option value="all">Product Size</option>
															<?php
																$Product_Name=mysqli_query($con,"SELECT * FROM `size` where `sub_category`='$id' ") or die(mysqli_error($con));
																while($c=mysqli_fetch_array($Product_Name)){
																?>
																<option value="<?php echo $c['size'] ?>"><?php echo $c['size'] ?></option>
																<?php
																}
																?>
														</select>
												    </td>
                                                    <input type="hidden" class="form-control" name="product_id" value="<?php echo $q['product_id'] ?>" >
                                                    <input type="hidden" class="form-control" name="type_1" value="<?php echo $q['type_1'] ?>" >
                                                    <input type="hidden" class="form-control" name="name" value="<?php echo $q['name'] ?>">
                                                    <input type="hidden" class="form-control" name="category" value="<?php echo $q['category'] ?>">
                                                    <input type="hidden" class="form-control" name="sub_category" value="<?php echo $q['sub_category'] ?>">
                                                    <input type="hidden" class="form-control" name="price" value="<?php echo $q['price'] ?>">
                                                    <input type="hidden" class="form-control" name="dealer_price" value="<?php echo $q['dealer_price'] ?>">
                                                    <input type="hidden" class="form-control" name="color" value="<?php echo $q['color'] ?>">
													<td><input type="number" class="form-control" name="quantity" required ></td>
													<td><input type="submit" class="btn btn-success" name="stock" ></td>
													</form>
													<td>
														<a href="add_stock_color.php?product_id=<?php echo $q['product_id']?>" class="btn btn-primary btn-sm"  > Add Stock For Color</a>
													</td>
													
												</tr>
												<?php }} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->


			<!-- Footer -->
            <?php include ('footer.php') ?>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Datatables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>