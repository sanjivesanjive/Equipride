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
if (isset($_POST["save"])) {

	$name = $_POST['name'];
	$product_id = $_POST['product_id'];
	$type_1 = $_POST['type_1'];
	$fil = $_FILES["image"]["name"];
	$color = $_POST['color'];
	$size = $_POST['size'];
	$category = $_POST['category'];
	$sub_category = $_POST['sub_category'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$dealer_price = $_POST['dealer_price'];
	$specification = $_POST['specification'];
	$escapedSpecification = mysqli_real_escape_string($con, $specification);
	
	$description = mysqli_real_escape_string($con, $description);
	
  
	$reg = mysqli_query($con, "SELECT * FROM `category` ") or die(mysqli_error($con));
	if (mysqli_num_rows($reg) > 0) {
	  while ($i = mysqli_fetch_array($reg)) {
		$value = $i['id'];
		foreach ($i as $value) {
  
		  if($value == $category){
			$fetchedValue = mysqli_query($con, "SELECT * FROM `category` where id='".$value."' ") or die(mysqli_error($con));
			$ie = mysqli_fetch_array($fetchedValue);
			$cate = $ie['category'];
  
			}
		}
	  }
	}

	$reg = mysqli_query($con, "SELECT * FROM `sub_category` ") or die(mysqli_error($con));
	if (mysqli_num_rows($reg) > 0) {
	  while ($i = mysqli_fetch_array($reg)) {
		$value = $i['id'];
		foreach ($i as $value) {
  
		  if($value == $sub_category){
			$fetchedValue = mysqli_query($con, "SELECT * FROM `sub_category` where id='".$value."' ") or die(mysqli_error($con));
			$ie = mysqli_fetch_array($fetchedValue);
			$sub_cate = $ie['sub_category'];
  
			}
		}
	  }
	}
  
	// echo "INSERT INTO `product`(`name`,`product_id`,`type_1`,`file`,`color`, `category`, `sub_category`,`size`,`description`,`price`,
	// `dealer_price`,`status`) VALUES ('" . $name . "','" . $product_id . "','".$type_1."','" . $fil . "','" . $color . "','" . $cate . "',
	// '" . $sub_cate . "','" . $size . "','" . $description . "','" . $price . "','".$dealer_price."','1')";
	// die();
	$res = $con->query("INSERT INTO `product`(`name`,`product_id`,`type_1`,`file`,`color`, `category`, `sub_category`,`size`,`description`,`specification`,`price`,
	`dealer_price`,`status`) VALUES ('" . $name . "','" . $product_id . "','".$type_1."','" . $fil . "','" . $color . "','" . $cate . "',
	'" . $sub_cate . "','" . $size . "','" . $description . "','" . $escapedSpecification . "','" . $price . "','".$dealer_price."','1')");
	$count = mysqli_affected_rows($con);
	// echo $count;
	// die();
  
	if(isset($_FILES['image_1'])){
		$errors = array();
		foreach($_FILES['image_1']['tmp_name'] as $key => $tmp_name ){
			$file_name = $_FILES['image_1']['name'][$key];
			$file_size = $_FILES['image_1']['size'][$key];
			$file_tmp = $_FILES['image_1']['tmp_name'][$key];
			$file_type = $_FILES['image_1']['type'][$key];
			
			// echo "INSERT INTO `additional`(`product_id`,`type_1`,`file`,`color`,`status`) VALUES 
			// ('" . $product_id . "','" . $type_1 . "','" . $file_name . "','" . $color . "','1')";
			// die();
			$res1 = $con->query("INSERT INTO `additional`(`product_id`,`type_1`,`file`,`color`,`status`) VALUES 
		('" . $product_id . "','" . $type_1 . "','" . $file_name . "','" . $color . "','1')");    
			$count=mysqli_affected_rows($con);  
  
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"file/".$file_name);
				// echo "File uploaded successfully: ".$file_name."<br>";
			}else{
				print_r($errors);
			}
		}
	}
	// for ($i=0; $i < count($_FILES["image_1"]["name"]); $i++) 
    // {
     
	// 	$fil1 = $_FILES["image_1"]["name"][$i];
	 
	// 	echo "INSERT INTO `additional`(`product_id`,`type_1`,`file`,`color`,`status`) VALUES 
	// 	('" . $product_id . "','" . $type_1 . "','" . $fil1 . "','" . $color . "','1')";
	// 	die();
	// 	$res1 = $con->query("INSERT INTO `additional`(`product_id`,`type_1`,`file`,`color`,`status`) VALUES 
	// 	('" . $product_id . "','" . $type_1 . "','" . $fil1 . "','" . $color . "','1')");
	
	// 	$count1 = mysqli_affected_rows($con);

	if ($count > 0) {
	  move_uploaded_file($_FILES["image"]["tmp_name"], 'file/' . $fil);
	//   move_uploaded_file($_FILES["image_1"]["tmp_name"][$i], 'file/' . $fil1);
	  ?>
	  <script type="text/javascript">
		// alert("Vehicle Entry Detail has been added");
		window.location = "view_product.php";
	  </script>
  
	  <?php
	} else {
	  header("location:view_product.php");
	}
//   }
}


$query = "SELECT * FROM `product` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$maxProductId = intval($row['product_id']);
$nextProductId = $maxProductId + 1;

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
							<h1>Add Product</h1>
							<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Product</p>
						</div>
						<div>
							<a href="view_product.php" class="btn btn-primary"> View All
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Add Product</h2>
								</div>
								<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="POST">

								<div class="card-body">
									<div class="row ec-vendor-uploads">
										<div class="col-lg-4">
											<div class="ec-vendor-img-upload">
												<div class="ec-vendor-main-img">
												<input type="hidden" class="form-control" name="product_id" readonly
                           							 value="<?php echo $nextProductId ?>" id="jbc_id">
													<div class="avatar-upload">
														<div class="avatar-edit">
															<input type='file' id="imageUpload" class="ec-image-upload" name='image' required
																accept=".png, .jpg, .jpeg" />
															<label for="imageUpload"><img
																	src="assets/img/icons/edit.svg"
																	class="svg_img header_svg" alt="edit" /></label>
														</div>
														<div class="avatar-preview ec-preview">
															<div class="imagePreview ec-div-preview">
																<img class="ec-image-preview"
																	src="assets/img/products/vender-upload-preview.jpg"
																	alt="edit" />
															</div>
														</div>
													</div>
													<div class="table-responsive">
														<table class="table table-bordered table-hover"
															style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="table_id">
															<thead>
															<tr>
																<th>S No</th>
																<th>image</th>
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
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<div class="ec-vendor-upload-detail">
													<div class="col-md-12">
														<label for="inputEmail4" class="form-label">Customer/Dealer</label>
														<select type="text" name="type_1" class="form-control" required>
															<option value="Select">Select </option>
															<option value="Customer">Customer </option>
															<option value="Dealer">Dealer </option>
														</select>
													</div>
													<div class="col-md-12">
														<label class="form-label">Product Name</label>
														<input type="text" class="form-control slug-title" name="name" id="inputEmail4">
													</div>
													<div class="col-md-12">
														<label for="slug" class="col-12 col-form-label">Category</label> 
														<select class="form-control" name="category" 
															id="category-dropdown" required>
															<option value="">Select Category</option>
															<?php
															$result = mysqli_query($con, "SELECT * FROM `category`  where `status`='1'");
															while ($row = mysqli_fetch_array($result)) {
															?>
															<option value="<?php echo $row['id']; ?>"><?php echo $row["category"]; ?></option>
															<?php
															}
															?>
														</select>
													</div>
													<div class="col-md-12">
														<label class="form-label">Sub Category</label>
														<select class="form-control" name="sub_category" id="sub-category-dropdown">
                          								</select>
													</div>
													<div class="col-md-12">
														<label class="form-label">Product Colour</label>
														<select class="form-control" name="color" 
															id="" required>
															<option value="">Select Colour</option>
															<?php
															$result = mysqli_query($con, "SELECT * FROM `color`  where `status`='1'");
															while ($row = mysqli_fetch_array($result)) {
															?>
															<option value="<?php echo $row['color_name']; ?>"><?php echo $row["color_name"]; ?></option>
															<?php
															}
															?>
														</select>
													</div>
													<div class="col-md-8 mb-25">
														<label class="form-label">Size</label>
														<select class="form-control" name="size" id="size-dropdown">
                          								</select>
													</div>
													<div class="col-md-6">
														<label class="form-label">Customer Price </label>
														<input type="number" class="form-control" name="price" min="0" value="0" step="any" id="price1">
													</div>
													<div class="col-md-6">
														<label class="form-label">Dealer Price</label>
														<input type="number" class="form-control" name="dealer_price" min="0" value="0" step="any" id="quantity1">
													</div>
													<div class="col-md-12">
														<label class="form-label">Description</label>
														<textarea class="form-control" name="description" pattern="^[a-zA-Z0-9]+$" rows="4"></textarea>
													</div>
													<div class="col-md-12">
														<label class="form-label">Specification</label>
														<textarea class="form-control" name="specification" pattern="^[a-zA-Z0-9]+$" rows="4"></textarea>
													</div>
													<div class="col-md-12">
														<button type="submit" name="save" class="btn btn-primary">Submit</button>
													</div>
											</div>
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

	<script>
    $(document).ready(function () {
      $('#category-dropdown').on('change', function () {
        var category_id = this.value;
        $.ajax({
          url: "fetch-subcategory-by-category.php",
          type: "POST",
          data: {
            category_id: category_id
          },
          cache: false,
          success: function (result) {
            $("#sub-category-dropdown").html(result);
			$('#size-dropdown').html('<option value="">Select Size</option>');
          }
        });
      });
    });
  </script>

  	<script>
    $(document).ready(function () {
      $('#sub-category-dropdown').on('change', function () {
        var sub_category_id = this.value;
        $.ajax({
          url: "fetch-subcategory-by-size.php",
          type: "POST",
          data: {
            sub_category_id: sub_category_id
          },
          cache: false,
          success: function (result) {
            $("#size-dropdown").html(result);
          }
        });
      });
    });
  </script>
<script>
	document.getElementById("explicit-block-txt").onkeypress = function(e) {
    var chr = String.fromCharCode(e.which);
    if ("></\"".indexOf(chr) >= 0)
        return false;
};
</script>
<script type="text/javascript">   
   
    $(document).ready(function(){
            var i=0;


        //  $('#myForm').submit(function(e) {
        //     e.preventDefault();
        //     if(!$('#phonenumber').val().match('[0-9]{10}'))  {
        //         alert("Please put 10 digit mobile number");
        //         return;
        //     }  

        // });
            $(document).on('click','#add',function(){
                 
 
                var output=`
                <tr>
                    <td>
                        `+(i)+`
                    </td>
                    <td>

					<div class="thumb-upload-set colo-md-12">
						<div class="thumb-upload">
							<div class="thumb-edit">
								<input type='file' id="thumbUpload01" name="image_1[]"
									class="ec-image-upload"
									accept=".png, .jpg, .jpeg" />
								<label for="imageUpload"><img
										src="assets/img/icons/edit.svg"
										class="svg_img header_svg" alt="edit" /></label>
							</div>
							<div class="thumb-preview ec-preview">
								<div class="image-thumb-preview">
									<img class="image-thumb-preview ec-image-preview"
										src="assets/img/products/vender-upload-thumb-preview.jpg"
										alt="edit" />
								</div>
							</div>
						</div>
					</div>
 </td>
     <td>
	 <i class="fa fa-times remove text-danger"  >&#x2716;</i>
     </td>
                </tr>
                `;
                
                  i++;
                $("#tbody").append(output);
                
            });
             $(document).on('click','.remove',function(){
                $($(this).closest("tr")).remove();
                i--;
            })
        });
</script>
	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>