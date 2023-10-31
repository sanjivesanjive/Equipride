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
  mysqli_query($con, "DELETE FROM `register_dealer` WHERE `id`='" . $id . "'");
}

if (isset($_POST['dealer'])) {
  //print_r($_POST);
  $u_id = $_POST['u_id'];
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $pincode = $_POST['pincode'];

  $fil = $_FILES["image"]["name"];


//   echo "INSERT INTO `register_dealer`(`userid`,`name`, `dob`, `gender`,`image`, `email`, `phone`, `password`,`pincode`, `status`) VALUES 
//   ('$u_id','$name','$dob','$gender','$fil','$email','$phone','" . $password . "','$pincode','1')";
//   die();
  $res = $con->query("INSERT INTO `register_dealer`(`userid`,`name`, `dob`, `gender`,`image`, `email`, `phone`, `password`,`pincode`, `status`) VALUES 
        ('$u_id','$name','$dob','$gender','$fil','$email','$phone','" . $password . "','$pincode','1')");
  // echo $res;
  // die();
  $login = "INSERT INTO `admin`(`userid`,`email`, `password`,`type`,`status`) VALUES ('$u_id','$email','" . $password . "','dealer','1')";
  mysqli_query($con, $login) or die(mysqli_error($con));

  // echo $login;
  // die();
  $count = mysqli_affected_rows($con);
  // echo $count;
  // die();
  if ($count > 0) {
    move_uploaded_file($_FILES["image"]["tmp_name"], 'file/' . $fil);
    ?>
    <script type="text/javascript">
      window.location = "view_dealer.php";
    </script>
    <?php
  } else {
    header("location:view_dealer.php");
  }
}
if (isset($_POST['update'])) {
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$fil = $_FILES["image"]["name"];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$pincode = $_POST['pincode'];

	$password = $_POST['password'];
    $id = $_POST['rid'];

	$res = $con->query("UPDATE `register_dealer` SET `name`='$name',`dob`='$dob',`gender`='$gender',`image`='$fil',`email`='$email',`pincode` = '$pincode',
	  `phone`='$phone',`password`='$password' WHERE  `id`='$id'");
	$count = mysqli_affected_rows($con);
	// echo $count;
	// die();
	if ($count > 0) {
	  move_uploaded_file($_FILES["image"]["tmp_name"], 'file/' . $fil);
	  ?>
	  <script type="text/javascript">
		window.location = "view_dealer.php";
	  </script>
	  <?php
	} else {
	  header("location:view_dealer.php");
	}
  }
$qry = mysqli_query($con, "SELECT auto_increment as nextId from `information_schema`.`tables` where `table_name`='register_dealer' and `table_schema`='" . $mysql_db . "'") or die('error');
$_id1 = $_prefix_dealer . mysqli_fetch_array($qry)['nextId'];
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
			<div class="ec-content-wrapper ec-vendor-wrapper">
				<div class="content">
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
							<h1>Show Dealer's</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span><span><i class="mdi mdi-chevron-right"></i></span> Dealer</p>
						</div>
						<div>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#addVendor">Add Dealer
							</button>
						</div>
					</div>

					<div class="card card-default p-4 ec-card-space">
						<div class="ec-vendor-card mt-m-24px row">
						<?php
                                            $query = mysqli_query($con, "SELECT * FROM `register_dealer` ");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
												$id = $q['id'];
                                                ?>
							<div class="col-lg-6 col-xl-4 col-xxl-3">
								<div class="card card-default mt-24px">
									<a href="javascript:0" data-bs-toggle="modal" data-bs-target="#modal-contact<?php echo $q['id'] ?>"
											class="view-detail"><i class="mdi mdi-eye-plus-outline"></i>
									</a>
									<div class="vendor-info card-body text-center p-4">
										<a href="javascript:0" class="text-secondary d-inline-block mb-3">
											<div class="image mb-3">  
											<?php 
												if($q['gender'] == 'Others'){
													echo '<img src="../images/others-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
												}else
												
												if($q['gender']== 'Male')
													{
														echo '<img src="../images/male-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
													}
													elseif($q['gender'] == 'Female'){
														echo '<img src="../images/female-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
													}
											?>
											</div>

											<h5 class="card-title text-dark"><?php echo $q['name'] ?></h5>

											<ul class="list-unstyled">
												<li class="d-flex mb-1">
													<i class="mdi mdi-cellphone-basic mr-1"></i>
													<span><?php echo $q['phone'] ?></span>
												</li>
												<li class="d-flex">
													<i class="mdi mdi-email mr-1"></i>
													<span><?php echo $q['email'] ?></span>
												</li>
											</ul>
										</a>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-contact<?php echo $q['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header justify-content-end border-bottom-0">
											<button type="button" class="btn-edit-icon" data-bs-toggle="modal"
												data-bs-target="#addVendore<?php echo $q['id'] ?>"><i class="mdi mdi-pencil"></i>
											</button>
											&nbsp;&nbsp;&nbsp;
											<div class="dropdown">
												<button class="btn-dots-icon" type="button" id="dropdownMenuButton"
													data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="mdi mdi-dots-vertical"></i>
												</button>

												<div class="dropdown-menu dropdown-menu-right">
													<form method="POST">
														<input type="hidden" name="id" value="<?php echo $q['id'] ?>">
														<button type="submit"
															onclick="if (! confirm('Do you want delete this data')) { return false; }"
															name="delete" class="dropdown-item">Delete</button>
													</form>
												</div>
											</div>
											<button type="button" class="btn-close-icon" data-bs-dismiss="modal"
												aria-label="Close">
												<i class="mdi mdi-close"></i>
											</button>
										</div>

										<div class="modal-body pt-0">
											<div class="row no-gutters">
												<div class="col-md-6">
													<div class="profile-content-left px-4">
														<div class="text-center widget-profile px-0 border-0">
															<div class="card-img mx-auto rounded-circle">
															<?php 
																if($q['gender'] == 'Others'){
																	echo '<img src="../images/others-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
																}else
																
																if($q['gender']== 'Male')
																	{
																		echo '<img src="../images/male-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
																	}
																	elseif($q['gender'] == 'Female'){
																		echo '<img src="../images/female-01.png" class="mr-3 img-fluid" alt="Avatar" style="height: 100px;width: 100px;">';
																	}
															?>
															</div>

															<div class="card-body">
																<h4 class="py-2 text-dark"><?php echo $q['name'] ?></h4>
																<p><?php echo $q['email'] ?></p>
															</div>
														</div>

													</div>
												</div>

												<div class="col-md-6">
													<div class="contact-info px-4">
														<h4 class="text-dark mb-1">Contact Details</h4>
														<p class="text-dark font-weight-medium pt-3 mb-2">Email address</p>
														<p><?php echo $q['email'] ?></p>
														<p class="text-dark font-weight-medium pt-3 mb-2">Phone Number</p>
														<p><?php echo $q['phone'] ?></p>
														<p class="text-dark font-weight-medium pt-3 mb-2">Birthday</p>
														<p><?php echo $q['dob'] ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade modal-add-contact" id="addVendore<?php echo $q['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Edit Dealer</h5>
									</div>
									<?php
									                    $query2=mysqli_query($con,"SELECT * FROM `register_dealer` WHERE `id` = '$id'  ") ;
														$q2=mysqli_fetch_array($query2);
														?>
									<div class="modal-body px-4">
										<!-- <div class="form-group row mb-6">
											<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Dealer Image</label>
											
											<div class="col-sm-8 col-lg-10">
												<div class="custom-file mb-1">
													<input type="file" class="custom-file-input" name="image" id="uploadfile" required>
													<label class="custom-file-label" for="coverImage">Choose file...</label>
													<div class="invalid-feedback">Example invalid custom file feedback</div>
												</div>
											</div>
										</div> -->
										<div class="row mb-2">
										<!-- <div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">Dealer Image</label>
													<input type="file" class="form-control" name="image" id="uploadfile"required >
												</div>
											</div> -->
											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">Name</label>
													<input type="text" class="form-control" id="firstName" name="name" value="<?php echo $q2['name'] ?>" >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="username">Gender</label>
													<select type="text" name="gender" class="form-control" required >
														<option value="Select">Select </option>
														<option value="Male">Male</option>
														<option value="Female">Female </option>
														<option value="Others">Others </option>
													</select>
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="email">Email</label>
													<input type="email" class="form-control" name="email" id="email" value="<?php echo $q2['email'] ?>"  >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="Birthday">Date Of Birth</label>
													<input type="date" class="form-control" name="dob" id="Birthday" >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="event">Phone Number</label>
													<input type="phone" class="form-control" name="phone" id="event" value="<?php echo $q2['phone'] ?>"  >
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group mb-4">
													<label for="event">Pincode</label>
													<input type="number" class="form-control" name="pincode" id="event" value="<?php echo $q2['pincode'] ?>" >
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group mb-4">
													<label for="event">Password</label>
													<input type="password" class="form-control" name="password" id="event" value="<?php echo $q2['password'] ?>" >
												</div>
											</div>

										</div>
									</div>
									
									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
										<input type="hidden" name="rid" value="<?php echo $q2['id'] ?>">
										<button type="submit" name="update" class="btn btn-primary btn-pill">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
						  <?php }} ?>
						</div>
					</div>


					<!-- Contact Modal -->
					

					<!-- Add Vendor Modal  -->
					<div class="modal fade modal-add-contact" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Add New Dealer</h5>
									</div>
									
									<div class="modal-body px-4">
										<!-- <div class="form-group row mb-6">
											<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Dealer Image</label>
											
											<div class="col-sm-8 col-lg-10">
												<div class="custom-file mb-1">
													<input type="file" class="custom-file-input" name="image" id="uploadfile" required>
													<label class="custom-file-label" for="coverImage">Choose file...</label>
													<div class="invalid-feedback">Example invalid custom file feedback</div>
												</div>
											</div>
										</div> -->
										<div class="row mb-2">
										<!-- <div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">Dealer Image</label>
													<input type="file" class="form-control" name="image" id="uploadfile"name="name" >
												</div>
											</div> -->
											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">Name</label>
													<input type="text" class="form-control" id="firstName" name="name" >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">Dealer ID</label>
													<input type="text" class="form-control" id="lastName" name="u_id" value="<?php echo $_id1; ?>" readonly>
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="username">Gender</label>
													<select type="text" name="gender" class="form-control" >
														<option value="Select">Select </option>
														<option value="Male">Male</option>
														<option value="Female">Female </option>
														<option value="Others">Others </option>
													</select>
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="email">Email</label>
													<input type="email" class="form-control" name="email" id="email" >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="Birthday">Date Of Birth</label>
													<input type="date" class="form-control" name="dob" id="Birthday" >
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="event">Phone Number</label>
													<input type="phone" class="form-control" name="phone" id="event" >
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="event">Password</label>
													<input type="number" class="form-control" name="pincode" id="event"  >
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group mb-4">
													<label for="event">Password</label>
													<input type="password" class="form-control" name="password" id="event" >
												</div>
											</div>

										</div>
									</div>
									
									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" name="dealer" class="btn btn-primary btn-pill">Submit</button>
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

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script>
    $("#uploadfile").on("change", function () {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings("#file_name").addClass("selected").html(fileName);
    });


    document.getElementById('upload_btl').onclick = function () {
      var image = document.getElementById('uploadfile').value;
      if (image != '') {
        var checkimg = image.toLowerCase();
        if (!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.jpeg|\.JPEG)$/)) {
          alert("Please Select jpg,png File");
          document.getElementById('uploadfile').value = "";
          document.getElementById('file_name').innerHTML = "Choose file"; exit;
        }
        var image = document.getElementById('uploadfile');
        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2);
        if (size > 2) {
          alert("Please Select Size Less Than 2 MB");
          document.getElementById('uploadfile').value = "";
          document.getElementById('file_name').innerHTML = "Choose file"; exit;
        } else {
          alert("Valid Image File");
        }
      }

    }
  </script>
</body>

</html>