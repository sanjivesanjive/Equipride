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
$category = $_GET['category'];
$sub_category_encoded = $_GET['sub_category'];
$sub_category = urldecode($sub_category_encoded);
$sub_category_id = $_GET['sub_category_id'];

echo "<script>console.log('Sub Category:', '" . $sub_category . "');</script>";

if (isset($_POST["save"])) {
    for ($i = 0; $i < count($_POST['size']); $i++) {
        $color = $_POST['size'][$i];
        $type_1 = $_POST['type_1'][$i];

        // Define the SQL query with placeholders
        $query = "INSERT INTO `size`(`sub_category_id`, `category`, `sub_category`, `type_1`, `size`, `status`) VALUES (?, ?, ?, ?, ?, '1')";

        // Create a prepared statement
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            // Bind the parameters and set their data types
            mysqli_stmt_bind_param($stmt, "sssss", $sub_category_id, $category, $sub_category, $type_1, $_POST["size"][$i]);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Query executed successfully
            } else {
                // Handle the error, if any
                echo "Error: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle the error, if any
            echo "Error: " . mysqli_error($con);
        }
    }
    
    // Redirect after data insertion
    echo '<script type="text/javascript">window.location = "view_size.php";</script>';
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
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
							<h1>Add Size</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Add Size</p>
						</div>
						<div>
							<a href="view_size.php" class="btn btn-primary"> View All
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Add Size</h2>
								</div>
								<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="POST">

								<div class="card-body">
									<div class="row ec-vendor-uploads">
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-hover"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table_id">
                                            <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Customer/Dealer</th>
                                                <th>Size</th>
                                                <div class="row">
                                                <hr>
                                                <input type="button" id="add" value="Add More" class="btn btn-info">
                                                </div>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="row">
                                            <span class="success">
                                                <?php if (isset($message)) {
                                                echo $message;
                                                } ?>
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <center><input type="submit" id="save" name="save" value="Save" class="btn btn-success">
                                            </center>
                                        </div>
									</div>
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
	<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

    <script type="text/javascript">
    <?php
    $i = 0;
    ?>

    $(document).ready(function () {
      $('#save').attr('disabled', true);
      var i = 1;
      $(document).on('click', '#add', function () {


        var output = `
                <tr class="tr">
                              
                <td>
                        `+ (i) + `
                    </td>
                    <td>
                    <select type="text" name="type_1[]" class="form-control" required>
                            <option value="Select">Select </option>
                            <option value="Customer">Customer </option>
                            <option value="Dealer">Dealer </option>
                          </select>
                    </td> 
                    <td>
                        <input type="text" class="form-control" name="size[]" id="size${i}"
                             required>
                    </td>
                     <td>
                      <i class="fa fa-times remove text-danger"  >&#x2716;</i>
                    </td>
                    </tr>
                                                          `;


        i++;
        if (i > 1) {
          $('#save').attr('disabled', false);
        }
        $("#tbody").append(output);

      });
      $(document).on('click', '.remove', function () {
        $($(this).closest("tr")).remove();
        i--;
        if (i == 1) {
          $('#save').attr('disabled', true);
        }
      })
    });
  </script>
	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>