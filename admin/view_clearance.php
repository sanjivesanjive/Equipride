<?php 
include ('../connection.php');
if(!isset($_SESSION['admin_id']))
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $pid = $_POST['p_id'];
    // echo "DELETE FROM `product` WHERE `id`='$id' AND `product_id` = '$pid' ";
    // die();
    mysqli_query($con, "DELETE FROM `product` WHERE `id`='$id' AND `product_id` = '$pid'");
}

if (isset($_POST['clearanced'])) {
    $id = $_POST['id'];
    $pid = $_POST['p_id'];

    $clearance = $_POST['clearance'];

    $query = "UPDATE `product` SET `clearance`='$clearance',`clearance_status`='salenow' WHERE `id`='$id' AND `product_id` = '$pid'";
    mysqli_query($con, $query) or die(mysqli_error($con));

}

if (isset($_POST['clearance_end'])) {
    $id = $_POST['id'];
    $pid = $_POST['p_id'];

    $query = "UPDATE `product` SET `clearance_status`='saleend' , `clearance`='0' WHERE `id`='$id' AND `product_id` = '$pid'";
    mysqli_query($con, $query) or die(mysqli_error($con));

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
							<h1>Clearance</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Clearance</p>
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
													<th>Name</th>
													<th>Color</th>
													<th>Category</th>
													<th>Sub Category</th>
													<th>Customer Price</th>
													<th>Dealer Price</th>
													<th>Clearance Price</th>
													<th>Clearance </th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
                                            <?php
                                                $i = 1;
                                                $query = mysqli_query($con, "SELECT * FROM `product` ");
                                                if (mysqli_num_rows($query) > 0) {
                                                while ($q = mysqli_fetch_array($query)) {
                                                    ?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td><img class="tbl-thumb" src="file/<?php echo $q['file'] ?>" alt="Product Image" /></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['name'] ?></td>
													<td><?php echo $q['color'] ?></td>
													<td><?php echo $q['category'] ?></td>
													<td><?php echo $q['sub_category'] ?></td>
													<td><?php echo $q['price'] ?></td>
													<td><?php echo $q['dealer_price'] ?></td>
													<form method="POST">
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                name="clearance"
                                                                                value="<?php echo $q['clearance'] ?>">
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if ($q['clearance_status'] == "") {
                                                                                echo ' 
                                                                                <input type="hidden" name="id" value="' . $q['id'] . '">
                                                                                <input type="hidden" name="p_id" value="' . $q['product_id'] . ' ">
                                                                                <button type="submit" name="clearanced" class="btn btn-info btn-sm">Clearance</button>';
                                                                            } else {


                                                                                if ($q['clearance_status'] == "salenow") {
                                                                                    ?>
                                                                                    <input type="hidden" name="id" value="<?php echo $q['id'] ?>">
                                                                                    <input type="hidden" name="p_id" value="<?php echo $q['product_id'] ?>">
                                                                                    <button type="submit" name="clearance_end" class="btn btn-success btn-sm">Clearance End</button>
                                                                                    <?php
                                                                                } elseif ($q['clearance_status'] == "saleend") {
                                                                                    ?>
                                                                                    <input type="hidden" name="id" value="<?php echo $q['id'] ?>">
                                                                                    <input type="hidden" name="p_id" value="<?php echo $q['product_id'] ?>">
                                                                                    <button type="submit" name="clearanced" class="btn btn-info btn-sm">Clearance</button>
                                                                                    <?php
                                                                                }

                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </form>
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
                                                            <form method="POST">
                                                                            <input type="hidden" name="id"
                                                                                value="<?php echo $q['id'] ?>">
                                                                            <input type="hidden" name="p_id"
                                                                                value="<?php echo $q['product_id'] ?>">
                                                                            <button type="submit"
                                                                                onclick="if (! confirm('Do you want delete this data')) { return false; }"
                                                                                name="delete"
                                                                                class="dropdown-item">Delete</button>
                                                                        </form>
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