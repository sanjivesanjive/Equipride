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
if (isset($_POST['banner'])) {
  
	$id = $_POST['rid'];

	$title_1 = $_POST["title_1"];
	$title_2 = $_POST["title_2"];
	$content_2 = $_POST["contant_2"];
	$title_3 = $_POST["title_3"];
	$content_3 = $_POST["contant_3"];
  
	$query = "UPDATE `home_page_config` SET `title_1`='$title_1',`title_2`='$title_2',`contant_2`='$content_2',
	`title_3`='$title_3',`contant_3`='$content_3' WHERE `id` = '$id' ";
	mysqli_query($con, $query) or die(mysqli_error($con));
  
  
	?>
	<script type="text/javascript">
	  // alert("Technician updated successsfully")
	  window.location = "setting.php"
	</script>
	<?php
  
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

	<!-- Data Tables -->
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
					<div class="breadcrumb-wrapper breadcrumb-contacts">
						<div>
							<h1>Home Setting</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Setting
							</p>
						</div>
						<div>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#addUser"> Add User
							</button>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="ec-vendor-list card card-default">
								<div class="card-body">
									<h3>Customer</h3>
									<div class="table-responsive">
										<table id="responsive-data-table" class="table">
											<thead>
												<tr>
													<th>S/No </th>
													<th>Customer/Dealer</th>
													<th>Banner Video</th>
													<th>Banner Title 1</th>
													<th>Banner Contant 1</th>
													<th>Banner Title 2</th>
													<th>Banner Contant 2</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											<?php
											$i = 1;
											$query = mysqli_query($con, "SELECT * FROM `home_page_config` WHERE `type`='Customer' ");
											if (mysqli_num_rows($query) > 0) {
											while ($q = mysqli_fetch_array($query)) {
												$id = $q['id'] ;
												?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['type'] ?></td>
													<td><?php echo $q['video'] ?></td>
													<td><?php echo $q['title_1b'] ?></td>
													<td><?php echo $q['contant_1b'] ?></td>
													<td><?php echo $q['title_2b'] ?></td>
													<td><?php echo $q['contant_2b'] ?></td>
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
					<div class="modal fade modal-add-contact" id="modal-add-contact<?php echo $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
                            <form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
									</div>
									<?php
									                    $query2=mysqli_query($con,"SELECT * FROM `home_page_config` WHERE `type`='Customer' AND `id` = '$id'  ") ;
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
													<label for="firstName">Banner Video</label>
													<input type="file" class="form-control" value=""  name='video' required >
												</div>
											</div>
											<h5>Banner 1</h5>

											<div class="col-lg-6">
											<div class="form-group">
												<label for="username">Title 1</label>
												<input type="text" class="form-control" value=""  name="title_1b" required >
											</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="username">Content 1</label>
                                  					<input type="text" class="form-control" value=""  name="contant_1b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="username">Title 2</label>
                                  					<input type="text" class="form-control" value=""  name="title_2b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="username">Content 2</label>
                                  					<input type="text" class="form-control" value=""  name="contant_2b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Title 3</label>
                                  <input type="text" class="form-control" value=""  name="title_3b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content 3</label>
                                  <input type="text" class="form-control" value=""  name="contant_3b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Title 4</label>
                                  <input type="text" class="form-control" value=""  name="title_4b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content 4</label>
                                  <input type="text" class="form-control" value=""  name="contant_4b" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image 1</label>
                                  <input type="file" class="form-control" value=""  name="file" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image Title 1</label>
                                  <input type="text" class="form-control" value=""  name="title_1" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image 2</label>
                                  <input type="file" class="form-control" value=""  name="image_2" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image Title 2</label>
                                  <input type="text" class="form-control" value=""  name="title_2" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image Content 2</label>
                                  <input type="text" class="form-control" value=""  name="contant_2" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image 3</label>
                                  <input type="file" class="form-control" value=""  name="image_3" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image Title 3</label>
                                  <input type="text" class="form-control" value=""  name="title_3" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image Conten 3</label>
                                  <input type="text" class="form-control" value=""  name="contant_3" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image 1</label>
                                  <input type="file" class="form-control" value=""  name="image_4" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Title 1</label>
                                  <input type="text" class="form-control" value=""  name="title_4" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Middle Title  1</label>
                                  <input type="text" class="form-control" value=""  name="middle_title_4" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">End Title 1</label>
                                  <input type="text" class="form-control" value=""  name="end_title_4" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Offer 1</label>
                                  <input type="text" class="form-control" value=""  name="offer_presentage_4" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content 1</label>
                                  <input type="text" class="form-control" value=""  name="contant_4" required >
												</div>
											</div>											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Mobile 1</label>
                                  <input type="phone" class="form-control" value=""  name="mobile_4" required >
												</div>
											</div>											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Image 1</label>
                                  <input type="file" class="form-control" value=""  name="image_5" required >
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content Lower 1</label>
                                  <input type="text" class="form-control" value=""  name="image_end_5" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username"> Title  1</label>
                                  <input type="text" class="form-control" value=""  name="title_5" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content 1</label>
                                  <input type="text" class="form-control" value=""  name="contant_5" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content image 1</label>
                                  <input type="file" class="form-control" value=""  name="image_51" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
												<label for="username">Content image 2</label>
                                  <input type="file" class="form-control" value=""  name="image_52" required >
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
					<hr>
					<div class="row">
						<div class="col-12">
							<div class="ec-vendor-list card card-default">
								<div class="card-body">
									<h3>Dealer</h3>
									<div class="table-responsive">
										<table id="responsive-data-tablre" class="table">
											<thead>
												<tr>
													<th>S/No </th>
													<th>Customer/Dealer</th>
													<th>Banner Title 1</th>
													<th>Banner Title 2</th>
													<th>Banner Contant 2</th>
													<th>Banner Title 3</th>
													<th>Banner Contant 2</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
											<?php
											$i = 1;
											$query = mysqli_query($con, "SELECT * FROM `home_page_config` WHERE `type`='Dealer' ");
											if (mysqli_num_rows($query) > 0) {
											while ($q = mysqli_fetch_array($query)) {
												$id = $q['id'];
												?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['type'] ?></td>
													<td><?php echo $q['title_1'] ?></td>
													<td><?php echo $q['title_2'] ?></td>
													<td><?php echo $q['contant_2'] ?></td>
													<td><?php echo $q['title_3'] ?></td>
													<td><?php echo $q['contant_3'] ?></td>
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
												<div class="modal fade modal-add-contact" id="modal-add-contact<?php echo $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
														<div class="modal-content">
														<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
																<div class="modal-header px-4">
																	<h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
																</div>
																<?php
																					$query2=mysqli_query($con,"SELECT * FROM `home_page_config` WHERE `id` = '$id' AND `type` ='Dealer'  ") ;
																					$q2=mysqli_fetch_array($query2);
																					?>
																<div class="modal-body px-4">
																	<div class="row mb-2">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="firstName">Tab Title 1</label>
																				<input type="text" class="form-control" name="title_1" value="<?php echo $q2['title_1'] ?>" required >
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="firstName">Tab Title 2</label>
																				<input type="text" class="form-control" name="title_2" value="<?php echo $q2['title_2'] ?>" required >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																				<label for="firstName">Tab Contant 2</label>
																				<input type="text" class="form-control" name="contant_2" value="<?php echo $q2['contant_2'] ?>" required >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																				<label for="firstName">Tab Title 3</label>
																				<input type="text" class="form-control" name="title_3" value="<?php echo $q2['title_3'] ?>" required >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																				<label for="firstName">Tab Contant 3</label>
																				<input type="text" class="form-control" name="contant_3" value="<?php echo $q2['contant_3'] ?>" required >
																			</div>
																		</div>
																	</div>
																</div>

																<div class="modal-footer px-4">
																	<button type="button" class="btn btn-secondary btn-pill"
																		data-bs-dismiss="modal">Cancel</button>
																		<input type="hidden" name="rid" value="<?php echo $q2['id'] ?>">

																	<button type="submit" name="banner" class="btn btn-primary btn-pill">Submit</button>
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
					<!-- Add User Modal  -->
					<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<form>
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Add New User</h5>
									</div>

									<div class="modal-body px-4">
										<div class="form-group row mb-6">
											<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
												Image</label>

											<div class="col-sm-8 col-lg-10">
												<div class="custom-file mb-1">
													<input type="file" class="custom-file-input" id="coverImage"
														required>
													<label class="custom-file-label" for="coverImage">Choose
														file...</label>
													<div class="invalid-feedback">Example invalid custom file feedback
													</div>
												</div>
											</div>
										</div>

										<div class="row mb-2">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">First name</label>
													<input type="text" class="form-control" id="firstName" value="John">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">Last name</label>
													<input type="text" class="form-control" id="lastName" value="Deo">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="userName">User name</label>
													<input type="text" class="form-control" id="userName"
														value="johndoe">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="email">Email</label>
													<input type="email" class="form-control" id="email"
														value="johnexample@gmail.com">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="Birthday">Birthday</label>
													<input type="text" class="form-control" id="Birthday"
														value="10-12-1991">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="event">Address</label>
													<input type="text" class="form-control" id="event"
														value="Address here">
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
											data-bs-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary btn-pill">Save Contact</button>
									</div>
								</form>
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

	<!-- Data Tables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>