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
if (isset($_POST['submit'])) {

    $id = $_POST['rid'];
	$product_name = $_POST['product_name'];
	$category = $_POST['category'];
	$sub_category = $_POST['sub_category'];
	$quantity = $_POST['quantity'];
	$size = $_POST['size'];
	$color = $_POST['color'];
	$price = $_POST['price'];
	$dealer_price = $_POST['dealer_price'];
	$type_1 = $_POST['type_1'];
  
	$query = "UPDATE `stock` SET `type_1`='$type_1',`product_name`='$product_name',`category`='$category',`sub_category`='$sub_category',
	  `size`='$size',`color`='$color',`quantity`='$quantity',`price`='$price',`dealer_price`='$dealer_price' WHERE `id`='$id'";
	//    echo $query;
    //  die;
	$qry = mysqli_query($con, $query) or die(mysqli_error($con) . ' line no 17 ');
  
	?>
	<script type="text/javascript">
	  // alert("Technician updated successsfully")
	  window.location = "view_stock.php"
	</script>
	<?php
  
  }
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  // echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
  // die();
  mysqli_query($con, "DELETE FROM `stock` WHERE `id`='" . $id . "'");
}

if (isset($_POST['update_stock'])) {
    $id = $_POST['id'];
    $pid = $_POST['p_id'];

    $u_date = $_POST['u_date'];

    $query = "UPDATE `stock` SET `u_date`='$u_date' ,`update_stock`='waitting' WHERE `id`='$id' AND `product_id` = '$pid'";
    mysqli_query($con, $query) or die(mysqli_error($con));

}

if (isset($_POST['update_1'])) {
    $uid = $_POST['uid'];
    $upid = $_POST['up_id'];

	$quantity = $_POST['quantity'];
    $query = "UPDATE `stock` SET `quantity`='$quantity' , `update_stock`='' WHERE `id`='$uid' AND `product_id` = '$upid'";
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
						<h1>Show Stock's</h1>
						<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Stock
						</p>
						</div>
						<div>
							<a href="add_stock.php" class="btn btn-primary"> Add Stock</a>
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
													<th>Size</th>
													<th>Colour</th>
													<th>Quantity</th>
													<th>Stock Date</th>
													<th>Quantity In</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											<?php
												$i = 1;
												$query = mysqli_query($con, "SELECT * FROM `stock` ");
												if (mysqli_num_rows($query) > 0) {
												while ($q = mysqli_fetch_array($query)) {
                                                    $id = $q['id'];

													?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['product_name'] ?></td>
													<td> <?php echo $q['category'] ?></td>
													<td><?php echo $q['sub_category'] ?></td>
													<td><?php echo $q['price'] ?></td>
													<td><?php echo $q['dealer_price'] ?></td>
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
																			<label for="username">Colour</label>
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