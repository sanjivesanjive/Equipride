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
	// echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
	// die();
	mysqli_query($con, "DELETE FROM `comming_soon` WHERE `id`='" . $id . "'");
  }


  if (isset($_POST["save"])) {

	$id = $_POST['rid'];
	$name = $_POST['name'];
	$type_1 = $_POST['type_1'];
	$fil = $_FILES["file"]["name"];
	$price = $_POST['price'];
	$dealer_price = $_POST['dealer_price'];
	$description = $_POST['description'];
	
// echo "UPDATE `comming_soon` SET `name`='$name',`type_1`='$type_1',`file`='$fil',`price`='$price',
// `dealer_price`='$dealer_price',`description`='$description' WHERE  `id`='" . $id . "'";
// die();
	$res = $con->query("UPDATE `comming_soon` SET `name`='$name',`type_1`='$type_1',`file`='$fil',`price`='$price',
    `dealer_price`='$dealer_price',`description`='$description' WHERE  `id`='" . $id . "'");
	$count = mysqli_affected_rows($con);
	// echo $count;
	// die();
  
	if ($count > 0) {
	  move_uploaded_file($_FILES["file"]["tmp_name"], 'file/' . $fil);
	  ?>
	  <script type="text/javascript">
		// alert("Vehicle Entry Detail has been added");
		window.location = "comming_soon.php";
	  </script>
  
	  <?php
	} else {
	  header("location:comming_soon.php");
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
							<h1>Comming Products's</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Comming Soon Product</p>
						</div>
						<div>
							<a href="add_comming.php" class="btn btn-primary"> Add Comming Soon Product</a>&nbsp;
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
													<th>Customer Price</th>
													<th>Dealer Price</th>
                                                    <th>description</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
                                            <?php
                                                $i = 1;
                                                $query = mysqli_query($con, "SELECT * FROM `comming_soon` ");
                                                if (mysqli_num_rows($query) > 0) {
                                                while ($q = mysqli_fetch_array($query)) {
													$id = $q['id'];
                                                    ?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td><img class="tbl-thumb" src="file/<?php echo $q['file'] ?>" alt="Product Image" /></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['name'] ?></td>
													<td><?php echo $q['price'] ?></td>
													<td><?php echo $q['dealer_price'] ?></td>
													<td><?php echo $q['description'] ?></td>
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
					<div class="modal fade modal-add-contact" id="modal-add-contact<?php echo $q['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
                            <form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Edit Comming Soon</h5>
									</div>
									<?php
									                    $query2=mysqli_query($con,"SELECT * FROM `comming_soon` WHERE `id` = '$id'  ") ;
														$q2=mysqli_fetch_array($query2);
														?>
									<div class="modal-body px-4">
										<!-- <div class="form-group row mb-6">
											<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
												Image</label>

											<div class="col-sm-8 col-lg-10">
												<div class="custom-file mb-1">
													<input type="file" class="custom-file-input" name="image" id="uploadfile"
														required>
													<label class="custom-file-label" for="coverImage">Choose
														file...</label>
													<div class="invalid-feedback">Example invalid custom file feedback
													</div>
												</div>
											</div>
										</div> -->

										<div class="row mb-2">
										<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">Customer/Dealer</label>
													<select type="text" name="type_1" class="form-control" required>
														<option value="Select">Select </option>
														<option value="Customer">Customer </option>
														<option value="Dealer">Dealer </option>
													</select>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Product Image</label>
                            					<input type="file" class="form-control" name="file" value="<?php echo $q2['file'] ?>">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Product Name</label>
                            					<input type="text" class="form-control" name="name" value="<?php echo $q2['name'] ?>">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="username">Customer Price</label>
                            						<input type="text" class="form-control" name="price" value="<?php echo $q2['price'] ?>">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
                                                <label for="username">Dealer Price</label>
													<input type="text" class="form-control" name="dealer_price"
													value="<?php echo $q2['dealer_price'] ?>">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
                                                <label for="username">Description</label>
													<textarea id="username" class="form-control" name="description" rows="4"
													cols="50"><?php echo $q2['description'] ?></textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
											data-bs-dismiss="modal">Cancel</button>
											<input type="hidden" name="rid" value="<?php echo $q2['id'] ?>">

										<button type="submit" name="save" class="btn btn-primary btn-pill">Submit</button>
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