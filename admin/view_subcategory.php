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
$category_id=$_GET['id'];
$category=$_GET['category'];
if(isset($_POST['add']))
 {
    //print_r($_POST);
     

    $sub_category=$_POST['sub_category'];
    $type=$_POST['type'];
    $type_1=$_POST['type_1'];

     $query="INSERT INTO `sub_category`( `category_id`, `type_1`,`category`,`sub_category`,`type`, `status`) VALUES ('".$category_id."','".$type_1."','".$category."','".$sub_category."','".$type."','1')";
     mysqli_query($con,$query)or die(mysqli_error($con));     

      ?>
       <script type="text/javascript">
        // alert("Data Inserted Successfully");
        window.location="view_subcategory.php?id=<?php echo $category_id ?>&&category=<?php echo $category ?>";
    </script>
    <?php

}
if (isset($_POST['sub'])) {

	$id=$_POST['rid'];
	$sub_category = $_POST['sub_category'];
	$type = $_POST['type'];
	$type_1 = $_POST['type_1'];
	// echo "UPDATE `sub_category` SET `sub_category`='$sub_category',`type_1`='$type_1'  WHERE `id`='" . $_GET['id'] . "'";
	// die();
	$query1 = "UPDATE `sub_category` SET `sub_category`='$sub_category',`type`='$type',`type_1`='$type_1'  WHERE `id`='$id'";
	$qry1 = mysqli_query($con, $query1) or die(mysqli_error($con) . ' line no 17 ');
  
	?>
	<script type="text/javascript">
	  // alert("Technician updated successsfully")
	  window.location = "view_subcategory.php?id=<?php echo $category_id ?>&&category=<?php echo $category ?>"
	</script>
	<?php
  }
  if (isset($_POST['delete'])) {
	$id = $_POST['id'];
	// echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
	// die();
	mysqli_query($con, "DELETE FROM `sub_category` WHERE `id`='" . $id . "'");
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
					<div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
						<h1>Sub Category</h1>
						<p class="breadcrumbs"><span><a href="dashbord.php">Home</a></span>
							<span><i class="mdi mdi-chevron-right"></i></span>Sub Category</p>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-12">
							<div class="ec-cat-list card card-default mb-24px">
								<div class="card-body">
									<div class="ec-cat-form">
										<h4>Add Sub Category</h4>

										<form method="post">

											<div class="form-group row">
												<label for="text" class="col-12 col-form-label">Sub Category</label> 
												<div class="col-12">
													<input id="text" name="sub_category" class="form-control here slug-title"  type="text">
												</div>
											</div>

											<div class="form-group row">
                                                <label for="username">Type</label>
                                                <select type="text" name="type" class="form-control" required>
                                                    <option value="Select">Select </option>
                                                    <option value="Horse">Horse </option>
                                                    <option value="Rider">Rider </option>
                                                    <option value="Dog">Dog </option>
                                                </select>
											</div>

											<div class="form-group row">
                                            <label for="username">Customer/Dealer</label>
                                            <select type="text" name="type_1" class="form-control" required>
                                                <option value="Select">Select </option>
                                                <option value="Customer">Customer </option>
                                                <option value="Dealer">Dealer </option>
                                            </select>
											</div> 
											<div class="row">
												<div class="col-12">
													<button name="add" type="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-12">
							<div class="ec-cat-list card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table">
											<thead>
												<tr>
													<th>S/no</th>
													<th>Customer/Dealer</th>
													<th>Categories</th>
													<th>Sub Categories</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
                                            <?php
                                             $i = 1;
                                            $query = mysqli_query($con, "SELECT * FROM `sub_category` ");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
												$id = $q['id'];
                                                ?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['category'] ?></td>
													<td><?php echo $q['sub_category'] ?></td>
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
															<a class="dropdown-item" href="add_size.php?category=<?php echo urlencode($q['category']); ?>&sub_category=<?php echo urlencode($q['sub_category']); ?>&sub_category_id=<?php echo $q['id']; ?>">Add Size</a>

 
                                                            <button type="button" class="btn-edit-icon" data-bs-toggle="modal"
                                                                data-bs-target="#modal-add-contact<?php echo $id ?>">Edit
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
									                    $query2=mysqli_query($con,"SELECT * FROM `sub_category` WHERE `id` = '$id'  ") ;
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
													<label for="firstName">Sub_Category</label>
													<input type="text" class="form-control" name="sub_category" value="<?php echo $q2['sub_category'] ?>" required >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
                                                <label for="username">Type</label>
                                                    <select type="text" name="type" class="form-control" required>
                                                        <option value="Select">Select </option>
                                                        <option value="Horse">Horse </option>
                                                        <option value="Rider">Rider </option>
                                                        <option value="Dog">Dog </option>
                                                    </select>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
                                                <label for="username">Customer/Dealer</label>
                                                <select type="text" name="type_1" class="form-control" required>
                                                    <option value="Select">Select </option>
                                                    <option value="Customer">Customer </option>
                                                    <option value="Dealer">Dealer </option>
                                                </select>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
											data-bs-dismiss="modal">Cancel</button>
											<input type="hidden" name="rid" value="<?php echo $q2['id'] ?>">

										<button type="submit" name="sub" class="btn btn-primary btn-pill">Submit</button>
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
            <?php include 'footer.php' ?>

		</div> <!-- End Page Wrapper -->

	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
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