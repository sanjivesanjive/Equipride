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
// $i_id = $_GET['id'];
$product_id = $_GET['product_id'];

if (isset($_POST["save"])) {

  for ($i = 0; $i < count($_POST['type_1']); $i++) {

    $fil = $_FILES["photo"]["name"][$i];
    $type_1 = $_POST['type_1'][$i];

    // echo "INSERT INTO `image`(`product_id`,`photo`,`color`,`status`) VALUES 
    // ('" . $product_id . "','" . $_FILES["photo"]["name"][$i] . "','" . $_POST["color"][$i] . "','1')";
    // die();

    $res = $con->query("INSERT INTO `additional`(`product_id`,`type_1`,`file`,`status`) VALUES 
    ('" . $product_id . "','" . $_POST["type_1"][$i] . "','" . $_FILES["photo"]["name"][$i] . "','1')");

    $count = mysqli_affected_rows($con);

    if ($count > 0) {
      move_uploaded_file($_FILES["photo"]["tmp_name"][$i], 'file/' . $fil);
      ?>
      <script type="text/javascript">
        // alert("Profile Upload Successfully");
        window.location = "view_additional_product.php";
      </script>

      <?php
    } else {
      header("location:view_additional_product.php");
    }

  }
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
							<h1>Additional Product</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Additional Product</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-body">
									<div class="table-responsive">
                                    <table id="responsive-data-table" class="table"
											style="width:100%">
											<thead>
												<tr>
													<th>S/No</th>
													<th>Product</th>
													<th>Customer/Dealer</th>
													<th>Color</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
                                            <?php
                                                $i = 1;
                                                $query = mysqli_query($con, "SELECT * FROM `image` WHERE `product_id` = '$product_id'");
                                                if (mysqli_num_rows($query) > 0) {
                                                while ($q = mysqli_fetch_array($query)) {
                                                    ?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td><img class="tbl-thumb" src="file/<?php echo $q['file'] ?>" alt="Product Image" /></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['color'] ?></td>
													<td>
														<div class="btn-group mb-1">
															<button type="button"
																class="btn btn-outline-success">Info</button>
															<button type="button"
																class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
																data-bs-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false" data-display="static">
																<span class="sr-only">Info</span>
															</button>

															<div class="dropdown-menu">
                                                                <a href="add_color_product.php?product_id=<?php echo $q['product_id'] ?>" class="dropdown-item">Additional Color Product Images</a>
																<!-- <a class="dropdown-item" href="#">Edit</a>
																<a class="dropdown-item" href="#">Delete</a> -->
															</div>
														</div>
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
            <?php include 'footer.php' ?>

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