<?php
include '../connection.php';
if(isset($_SESSION['admin_id']))
{
    ?>
    <script type="text/javascript">
        window.location="dashboard.php";
    </script>
    <?php
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    // echo "SELECT * FROM `login` where (`username`='$email' and `password`='$pass') AND `type`='admin'";
    // die();
    $v = mysqli_query($con, "SELECT * FROM `admin` where (`email`='$email' and `password`='$pass') AND `type`='admin'") or die(mysqli_error($con));
    $admin = mysqli_num_rows($v);
    if ($admin == '1') {
        $admin_l = mysqli_fetch_array($v);
        $admin_id = $admin_l['userid'];

        $_SESSION['admin_id'] = $admin_id;
        ?>
        <script type="text/javascript">
            // alert("Welcome <?php echo $admin_l['userid'] ?> ");
            window.location = "dashboard.php";
        </script>

        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
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
		
		<!-- Ekka CSS -->
		<link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css" />
		
		<!-- FAVICON -->
		<link href="images/Logo editted.png" rel="shortcut icon" />
	</head>
	
	<body class="sign-inup" id="body">
		<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-10">
					<div class="card">
						<div class="card-header bg-primary" style="background-color:#ffffff !important">
							<div class="ec-brand">
								<a href="index.php" title="Equipride">
									<img class="ec-brand-icon" src="images/Logo editted.png" alt="LOGO" style="width: 204px;max-width: 230px;" />
								</a>
							</div>
						</div>
						<div class="card-body p-5">
							<h4 class="text-dark mb-5">Sign In</h4>
							
							<form method="POST" class="signin-form">
								<div class="row">
									<div class="form-group col-md-12 mb-4">
										<input type="email" class="form-control" name="email" id="email" placeholder="Useremail">
									</div>
									
									<div class="form-group col-md-12 ">
										<input type="password" class="form-control" name="password" id="password" placeholder="Password">
									</div>
									
									<div class="col-md-12">
										<div class="d-flex my-2 justify-content-between">
											<!-- <div class="d-inline-block mr-3">
												<div class="control control-checkbox">Remember me
													<input type="checkbox" />
													<div class="control-indicator"></div>
												</div>
											</div> -->
											
											<!-- <p><a class="text-blue" href="forgotPassword.php">Forgot Password?</a></p> -->
										</div>
										
										<button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign In</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<!-- Javascript -->
		<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
		<script src="assets/plugins/slick/slick.min.js"></script>
	
		<!-- Ekka Custom -->	
		<script src="assets/js/ekka.js"></script>
	</body>
</html>