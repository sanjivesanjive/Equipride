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

if (isset($_POST['add'])) {
    $colorName = $_POST['colorName'];
    $colorValue = $_POST['colorValue'];

    // Check if both color name and value are not empty
    if (!empty($colorName) && !empty($colorValue)) {
        // Insert the color name and value into the database
        $query = "INSERT INTO `color`(`color_name`, `color_value`, `status`) VALUES ('$colorName', '$colorValue', '1')";
    
        mysqli_query($con, $query) or die(mysqli_error($con));

        // Redirect to the view_color.php page after successfully inserting the data
        header("Location: view_color.php");
        exit;
    } else {
        // Show an alert box with the error message
        echo "<script>alert('Both color name and value must be provided.');</script>";
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    // echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
    // die();
    mysqli_query($con, "DELETE FROM `color` WHERE `id`='" . $id . "'");
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

	<style>
    /* Style the custom color input */
    .custom-color-input {
        padding: 6px; /* Adjust the padding as needed */
        border: 1px solid #ccc; /* Add a border */
        border-radius: 4px; /* Add border-radius for rounded corners */
    
        width: 60px; /* Decrease the width as needed */
        height: 40px; /* Increase the height as needed */
    

    }
</style>


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
							<h1>Show Colour</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Colour
							</p>
						</div>
						<div>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#addUser"> Add Colour
							</button>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="ec-vendor-list card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table">
											<thead>
												<tr>
													<th>S/No</th>
													<th>Colour_Name</th>
													<th>Colour_Value</th>

													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $i=1;
                                                $color = mysqli_query($con,"SELECT * FROM `color` ");
                                                if (mysqli_num_rows($color) > 0) {
                                                    while ($c = mysqli_fetch_array($color)) {
                                                        $id = $c['id'];
                                                        ?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td><?php echo $c['color_name'] ?></td>
													<td><?php echo $c['color_value'] ?></td>

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
                                                                    <input type="hidden" name="id" value="<?php echo $c['id'] ?>">
                                                                    <button type="submit"
                                                                        onclick="if (! confirm('Do you want delete this data')) { return false; }"
                                                                        name="delete" class="dropdown-item">Delete</button>
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
					<!-- Add User Modal  -->
					<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
							<form method="POST">
								<div class="modal-header px-4">
									<h5 class="modal-title" id="exampleModalCenterTitle">Add Color</h5>
								</div>

								<div class="modal-body px-4">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="colorName">Colour Name:</label>
												<input type="text" name="colorName" class="form-control" id="colourName" />
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="colorValue">Select Colour:</label>
												<input type="color" name="colorValue" class="form-control custom-color-input" id="colourValue" />
											</div>
										</div>
									</div>
								</div>

								<div class="modal-footer px-4">
									<button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" name="add" class="btn btn-primary btn-pill">Submit</button>
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