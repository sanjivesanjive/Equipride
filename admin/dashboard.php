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
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard eCommerce HTML Template.">

	<title><?php echo $title ?></title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Ekka CSS -->
	<link id="ekka-css" href="assets/css/ekka.css" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="images/Logo editted.png" rel="shortcut icon" />

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
		
		<!-- LEFT MAIN SIDEBAR -->
        <?php include 'sidebar.php' ?>

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<?php include 'header.php' ?>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<!-- Top Statistics -->
					<div class="row">
                    <?php 
                    $query1=mysqli_query($con,"SELECT * FROM `register_dealer`  ") ;
                    $q1=mysqli_num_rows($query1);

                    $query2=mysqli_query($con,"SELECT * FROM `register`  ") ;
                    $q2=mysqli_num_rows($query2);

                    $query3=mysqli_query($con,"SELECT * FROM `product`  ") ;
                    $q3=mysqli_num_rows($query3);

                    $query4=mysqli_query($con,"SELECT * FROM `payments`  ") ;
                    $q4=mysqli_num_rows($query4);
                    ?>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-1">
								<div class="card-body">
									<h2 class="mb-1"><?php echo $q1 ?></h2>
									<p>Dealer's</p>
									<span class="mdi mdi-account-arrow-left"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-2">
								<div class="card-body">
									<h2 class="mb-1"><?php echo $q2 ?></h2>
									<p>Customer's</p>
									<span class="mdi mdi-account-clock"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-3">
								<div class="card-body">
									<h2 class="mb-1"><?php echo $q3 ?></h2>
									<p>Product's</p>
									<span class="mdi mdi-package-variant"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-4">
								<div class="card-body">
									<h2 class="mb-1"><?php echo $q4 ?></h2>
									<p>payment's</p>
									<span class="mdi mdi-currency-gbp"></span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 p-b-15">
							<!-- Recent Order Table -->
							<div class="card card-table-border-none card-default recent-orders" id="recent-orders">
								<div class="card-header justify-content-between">
									<h2>Stock Utilization</h2>
								</div>
								<div class="card-body pt-0 pb-5">
									<table class="table card-table table-responsive table-responsive-large"
										style="width:100%">
										<thead>
											<tr>
												<th>S/No</th>
												<th>Product Name</th>
												<th class="d-none d-lg-table-cell">Category</th>
												<th class="d-none d-lg-table-cell">Sub Category</th>
												<th class="d-none d-lg-table-cell">Remaining Quantity</th>
												<th class="d-none d-lg-table-cell">Utilized Quantity</th>
											</tr>
										</thead>
										<tbody>
                                        <?php
                                            $i = 1;
                                            $query_tid=mysqli_query($con,"SELECT * FROM `stock` "); 
                                                                    $q_tid_array=mysqli_fetch_array($query_tid);
                                                                    $q_tid=$q_tid_array['product_name'];

                                            $query = mysqli_query($con, "SELECT * FROM `cart` WHERE `p_name` ='".$q_tid."' ");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
                                                ?>
											<tr>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <td class="text-center"><?php echo $q_tid_array['product_name']; ?></td>
                                                <td class="text-center"><?php echo $q_tid_array['category']; ?></td>
                                                <td class="text-center"><?php echo $q_tid_array['sub_category']; ?></td>
                                                <td class="text-center"><?php echo $q_tid_array['quantity']; ?></td>
                                                <td class="text-center"><?php echo $q['quantity']; ?></td>
											</tr>
                                            <?php }} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<!-- New Customers -->
							<div class="card ec-cust-card card-table-border-none card-default">
								<div class="card-header justify-content-between ">
									<h2>New Customers</h2>
								</div>
								<div class="card-body pt-0 pb-15px">
									<table class="table ">
										<tbody>
                                        <?php
                                            $i = 1;
                                            $query = mysqli_query($con, "SELECT * FROM `register` ORDER BY `register`.`id` DESC LIMIT 6;                                            ");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
                                                ?>
											<tr>
												<td>
													<div class="media">
														<!-- <div class="media-image mr-3 rounded-circle">
															<img
																	class="profile-img rounded-circle w-45"
																	src="admin/file/<?php //echo $q['image'] ?>"
																	alt="customer">
														</div> -->
														<div class="media-body align-self-center">
																<h6 class="mt-0 text-dark font-weight-medium"><?php echo $q['name'] ?></h6>
															<small><?php echo $q['email'] ?></small>
														</div>
													</div>
												</td>
												<td><?php echo $q['phone'] ?></td>
											</tr>
                                            <?php }} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-xl-7">
							<!-- Top Products -->
							<div class="card card-default ec-card-top-prod">
								<div class="card-header justify-content-between">
									<h2>Recent Products</h2>
								</div>
								<div class="card-body mt-10px mb-10px py-0">
                                <?php
                                            $query = mysqli_query($con, "SELECT * FROM `product` WHERE `status` ='1' ORDER BY `product`.`id` DESC limit 3;");
                                            if (mysqli_num_rows($query) > 0) {
                                            while ($q = mysqli_fetch_array($query)) {
                                                ?>
									<div class="row media d-flex pt-15px pb-15px">
										<div
											class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
											<a href="#"><img src="file/<?php echo $q['file'] ?>" alt="product"></a>
										</div>
										<div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
											<a href="#">
												<h6 class="mb-10px text-dark font-weight-medium"><?php echo $q['name'] ?></h6>
											</a>
											<p class="d-none d-md-block"><?php echo $q['description'] ?>.</p>
											<p class="mb-0 ec-price">
												<span class="text-dark">£<?php echo $q['price'] ?></span>
											</p>
										</div>
									</div>
                                    <?php }} ?>

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

	<!-- Chart -->
	<script src="assets/plugins/charts/Chart.min.js"></script>
	<script src="assets/js/chart.js"></script>

	<!-- Google map chart -->
	<script src="assets/plugins/charts/google-map-loader.js"></script>
	<script src="assets/plugins/charts/google-map.js"></script>

	<!-- Date Range Picker -->
	<script src="assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="assets/js/date-range.js"></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>