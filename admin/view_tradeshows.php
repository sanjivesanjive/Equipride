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
    $id = $_POST['id'];
    // echo "DELETE FROM `userregister` WHERE `cno`='".$id."'";
    // die();
    mysqli_query($con, "DELETE FROM `tradeshows` WHERE `id`='" . $id . "'");
  }
if (isset($_POST["add"])) {

    $fil = $_FILES["shows"]["name"];
  

    // echo "INSERT INTO `tradeshows`( `shows`,`status`) VALUES ('" . $fil . "','1')";
    // die();
    $res = $con->query("INSERT INTO `tradeshows`( `shows`,`status`) VALUES ('" . $fil . "','1')");
    $count = mysqli_affected_rows($con);

  
    if ($count > 0) {
      move_uploaded_file($_FILES["shows"]["tmp_name"], 'file/' . $fil);
      ?>
      <script type="text/javascript">
        // alert("Vehicle Entry Detail has been added");
        window.location = "view_tradeshows.php";
      </script>
  
      <?php
    } else {
      header("location:view_tradeshows.php");
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

	<!-- PLUGINS CSS STYLE -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Ekka CSS -->
	<link id="ekka-css" href="assets/css/ekka.css" rel="stylesheet" />

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
							<h1>Tradeshows</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span> Tradeshows</p>
						</div>
						<div>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#modal-add-member">Add Tradeshows
							</button>
						</div>
					</div>

					<div class="product-brand card card-default p-24px">
						<div class="row mb-m-24px">
                        <?php
                            $query = mysqli_query($con, "SELECT * FROM `tradeshows` ");
                            if (mysqli_num_rows($query) > 0) {
                              while ($q = mysqli_fetch_array($query)) {
                                ?>
							<div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6">
								<div class="card card-default">
									<div class="card-body text-center p-24px">
										<div class="image mb-3">
											<img src="file/<?php echo $q["shows"]; ?>" class="img-fluid rounded-circle" style="height: 150px;"
												alt="Avatar">
										</div>

										<h5 class="card-title text-dark">Tradeshow<?php echo $q['id'] ?></h5>
                                        <form method="POST">
                                      <input type="hidden" name="id" value="<?php echo $q['id'] ?>">
                                      <button type="submit"
                                        onclick="if (! confirm('Do you want delete this data')) { return false; }"
                                        name="delete"><span class="brand-delete mdi mdi-delete-outline"></span></button>
                                    </form>
									</div>
								</div>
							</div>
                            <?php }} ?>
						</div>
					</div>

					<!-- Add Contact Button  -->
					<div class="modal fade" id="modal-add-member" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
							<div class="modal-content">
								<form method="POST" enctype="multipart/form-data">								
								<div class="modal-body p-0" data-simplebar >
									<ul class="list-unstyled border-top mb-0">
										<li>
											<div class="media media-message">
												<div class="position-relative mr-3">
                                                <label for="username">Treadshows</label>
                                                    <input type="file" class="form-control" name="shows">
												</div>
											</div>
										</li>
									</ul>
								</div>

								<div class="modal-footer px-4">
									<button type="button" class="btn btn-secondary btn-pill"
										data-bs-dismiss="modal">Cancel</button>
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