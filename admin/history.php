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
if (isset($_POST['delete'])) {
  $id = $_POST['cno'];
  // echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
  // die();
  mysqli_query($con, "DELETE FROM `payments` WHERE `id`='" . $id . "'");
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

	<!-- Data-Tables -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Ekka CSS -->
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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2">
						<h1>Orders History</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Order History
						</p>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table" style="width:100%">	
										<thead>
											
												<th>S/No</th>
												<th>Customer/Dealer</th>
												<th>Order Id</th>
												<th>Payername</th>
												<th>Payer Email</th>
												<th>Phone</th>
												<th>Houseno</th>
												<th>Town</th>
												<th>Post Code</th>
												<th>Country</th>
												<th>Shipping Address</th>
												<th>Product Name</th>
												<th>Size</th>
												<th>Quantity</th>
												<th>Total Amount</th>
												<th>Payment Method</th>
												<th>Payment Status</th>
											
											</thead>
											<tbody>									
											<?php
											$i = 1;
											$query = mysqli_query($con, "SELECT * FROM `orders` ORDER BY id DESC");
											$previous_orderid = null;

											if (mysqli_num_rows($query) > 0) {
												while ($row = mysqli_fetch_array($query)) {
													$orderid = $row['orderid'];
													
													// Check if the order ID is different from the previous row
													if ($orderid != $previous_orderid) {
														// Display order details
														echo '<tr>';
														echo '<td>' . $i++ . '</td>';
														echo '<td>' . $row['type'] . '</td>';
														echo '<td>' . $orderid . '</td>';
														echo '<td>' . $row['username'] . '</td>';
														echo '<td>' . $row['email'] . '</td>';
														echo '<td>' . $row['phone'] . '</td>';
														echo '<td>' . $row['houseno'] . '</td>';
														echo '<td>' . $row['town'] . '</td>';
														echo '<td>' . $row['post_code'] . '</td>';
														echo '<td>' . $row['country'] . '</td>';
														echo '<td>' . $row['shipping_address'] . '</td>';
														echo '<td>' . $row['product_name'] . '</td>';
														echo '<td>' . $row['size'] . '</td>';
														echo '<td>' . $row['quantity'] . '</td>';
														echo '<td>' . $row['total'] . '</td>';
														echo '<td>' . $row['payment_method'] . '</td>';
														echo '<td>' . $row['payment_status'] . '</td>';
														echo '</tr>';
													} else {
														// If the order ID is the same as the previous row, print only product details
														echo '<tr>';
														echo '<td colspan="11"></td>'; // Empty columns for order details
														echo '<td>' . $row['product_name'] . '</td>';
														echo '<td>' . $row['size'] . '</td>';
														echo '<td>' . $row['quantity'] . '</td>';
														echo '<td>' . $row['total'] . '</td>';
														echo '<td>' . $row['payment_method'] . '</td>';
														echo '<td>' . $row['payment_status'] . '</td>';
														echo '</tr>';
													}
													
													$previous_orderid = $orderid; // Update the previous_orderid for the next iteration
												}
											}
											?>

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
			<?php include 'footer.php' ?>
		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->


	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Data-Tables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>