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
if(isset($_POST["save"])) {

    for ($i=0; $i < count($_POST['category']); $i++) 
{
  $category=$_POST['category'][$i];
  $sub_category=$_POST['sub_category'][$i];			 
  $product_name=$_POST['product_name'][$i];
  $size=$_POST['size'][$i];
  $color=$_POST['color'][$i];
  $quantity=$_POST['quantity'][$i];
  $price=$_POST['price'][$i];
  $dealer_price=$_POST['dealer_price'][$i];
  $type_1=$_POST['type_1'][$i];

  $query="INSERT INTO `stock`( `type_1`,`product_name`, `category`, `sub_category`,`size`,`color`, `quantity`, `price`,`dealer_price`, `status`)values
   ('".$type_1."','".$_POST["product_name"][$i]."','".$_POST["category"][$i]."','".$_POST["sub_category"][$i]."','".$_POST["size"][$i]."','".$_POST["color"][$i]."','".$_POST["quantity"][$i]."','".$_POST["price"][$i]."','".$_POST["dealer_price"][$i]."','1')";
  //  echo $query;
  //  die();
        $rs=mysqli_query($con,$query)or die(mysqli_error($con));
}
  
      if($rs)
      {
          ?>
          <script type="text/javascript">
          alert("Added Successfully");
        //   window.location="t_viewcar?snid=<?php echo $_GET['snid']?>";
          window.location="view_stock.php";
          </script>
      <?php
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
							<h1>Add Stock</h1>
							<p class="breadcrumbs"><span><a href="dashboard.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Add Stock</p>
						</div>
						<div>
							<a href="view_stock.php" class="btn btn-primary"> View All
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Add Stock</h2>
								</div>
								<form class="form-horizontal m-t-30" enctype="multipart/form-data" method="POST">

								<div class="card-body">
									<div class="row ec-vendor-uploads">
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-hover"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="responsive-data-table">
                                            <thead>
                                                <tr>
                                                    <th>S/No</th>
                                                    <th>Customer/Dealer</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>size</th>
                                                    <th>Color</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Dealer Price</th>
                                                    <!-- <div class="row">
                                                        <hr>
                                                        <input type="button" id="add" value="Add More" class="btn btn-info">
                                                    </div> -->
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
												$i = 1;
												$query = mysqli_query($con, "SELECT * FROM `stock` ");
												if (mysqli_num_rows($query) > 0) {
												while ($q = mysqli_fetch_array($query)) {
                                                    $id = $q['id'];

													?>
												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $q['type_1'] ?></td>
													<td><?php echo $q['product_name'] ?></td>
													<td> <?php echo $q['category'] ?></td>
													<td><?php echo $q['sub_category'] ?></td>
													<td><?php echo $q['price'] ?></td>
													<td><?php echo $q['dealer_price'] ?></td>
													<td><?php echo $q['size'] ?></td>
													<td><?php echo $q['color'] ?></td>
													<td><?php echo $q['quantity'] ?></td>
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
																	<h5 class="modal-title" id="exampleModalCenterTitle">Edit Stock</h5>
																</div>
																<?php
																					$query2=mysqli_query($con,"SELECT * FROM `stock` WHERE `id` = '$id'  ") ;
																					$q2=mysqli_fetch_array($query2);
																					?>
																<div class="modal-body px-4">

																	<div class="row mb-2">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="firstName">Customer/Dealer</label>
                                                                                <input type="text" name="type_1" class="form-control"  value="<?php echo $q2['type_1'] ?>">
                        													</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="form-group">
																			<label for="username">Product Name</label>
                                                                            <input type="text" class="form-control" name="product_name" value="<?php echo $q2['product_name'] ?>"
                                                                                >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Category</label>
																			<input type="text" class="form-control" name="category" value="<?php echo $q2['category'] ?>"
                                                                            >
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Sub Category</label>
																			<input type="text" class="form-control" name="sub_category" value="<?php echo $q2['sub_category'] ?>"
                                                                            >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Size</label>
																			<input type="text" class="form-control" name="size" value="<?php echo $q2['size'] ?>"
                                                                            >
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group mb-4">
																			<label for="username">Color</label>
																			<input type="text" class="form-control" name="color" value="<?php echo $q2['color'] ?>"
                                                                            >
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                            <label for="username">Quantity</label>
                                                                            <input type="text" class="form-control" name="quantity"
                                                                            value="<?php echo $q2['quantity'] ?>">
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                            <label for="username">Customer Price</label>
                                                                            <input type="text" class="form-control" name="price" value="<?php echo $q2['price'] ?>">
																			</div>
																		</div>

                                                                        <div class="col-lg-6">
																			<div class="form-group mb-4">
                                                                                <label for="username">Dealer Price</label>
                                                                                <input type="text" class="form-control" name="dealer_price" value="<?php echo $q2['dealer_price'] ?>">
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
        
        function calc(i)
         {
            var qoh =parseFloat($("#qoh"+i).val());
                var price =parseFloat($("#price"+i).val());
                var total=qoh*price;
                if(isNaN(total))
                {
                    total=0;
                }
        $("#total"+i).val(total)
         }


         let sub_category='<option>Select category</option>';
<?php
											$i=0;
$query=mysqli_query($con,"SELECT * FROM `category` GROUP BY `category`")or die(mysqli_error());
while ($row=mysqli_fetch_array($query))
{
	// $query1=mysql_query("SELECT * FROM `inventory` where`product_cat`='".$row['product_cat']."' GROUP BY `product_cat`")or die(mysql_error());
	?>	
	sub_category+='<option value="<?php echo $row['category'].'-'.$row['id']?>"><?php echo $row['category']?></option>';
	<?php
}
?>  
function get_category(i)
{
    var bra=$("#category"+i).val();
   if(bra != 'Select sub_category')
   {
       var data={
           type:'get_list',
           //type:'get_brand',
           sub_category:bra
       }
       $.ajax({
            url:'ajax/get_list.php',
            method:'POST',
            data:data,
            success:function(data){
             
                $("#sub_category"+i).html(data)
            }
       })
   }
   else{
       $("#sub_category"+i).html(` <option>select sub_category</option>`);
   }
}
         $(document).ready(function(){
            $('#save').attr('disabled',true);
            var i=1;
            $(document).on('click','#add',function(){
                 
               
                var output=`
                <tr class="tr">
														  
                <td>
                        `+(i)+`
                    </td>
                    <td>
                    <div class="form-group">
                          <select type="text" name="type_1[]" class="form-control" id="type_1${i}" / required>
                            <option value="Select">Select </option>
                            <option value="Customer">Customer </option>
                            <option value="Dealer">Dealer </option>
                          </select>
                        </div>
                        <br>
                      </td>
                    <td>
                      <select class="form-control" name="product_name[]" id="product_name${i}"  required>
                        <option value="all">Product Name</option>
                          <?php
                            $Product_Name=mysqli_query($con,"SELECT * FROM `product` where `status`='1'") or die(mysqli_error($con));
                              while($c=mysqli_fetch_array($Product_Name)){
                            ?>
                            <option value="<?php echo $c['name'] ?>"><?php echo $c['name'] ?></option>
                            <?php
                              }
                            ?>
                      </select>
                    </td>
                     <td>
                    <select name="category[]" onchange="get_category(`+i+`)" id="category${i}" class="form-control" required="" >`+sub_category+`   </select>                 
                    </td>
                   
                     <td>
                    <select name="sub_category[]" id="sub_category${i}" class="form-control">
                        <option>select sub_category</option>
                    </select>
                    </td>
                    <td>
                      <select class="form-control" name="size[]" id="size${i}"  required>
                        <option value="all">Product Size</option>
                          <?php
                            $Product_Name=mysqli_query($con,"SELECT * FROM `product` where `status`='1'") or die(mysqli_error($con));
                              while($c=mysqli_fetch_array($Product_Name)){
                            ?>
                            <option value="<?php echo $c['size'] ?>"><?php echo $c['size'] ?></option>
                            <?php
                              }
                            ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="color[]" id="color${i}"  required>
                        <option value="all">Product Color</option>
                          <?php
                            $Product_Name=mysqli_query($con,"SELECT * FROM `color` where `status`='1'") or die(mysqli_error($con));
                              while($c=mysqli_fetch_array($Product_Name)){
                            ?>
                            <option value="<?php echo $c['color'] ?>"><?php echo $c['color'] ?></option>
                            <?php
                              }
                            ?>
                      </select>
                    </td>
                    <td>
                    <input type="number"  class="form-control" min="0" name="quantity[]"  id="quantity${i}" />
                    </td>
                    <td>
                    <input type="number"  class="form-control" min="0" name="price[]"  id="price${i}" />
                    </td>
                    <td>
                    <input type="number"  class="form-control" min="0" name="dealer_price[]"  id="dealer_price${i}" />
                    </td>
                     <td>
                      <i class="fa fa-times remove text-danger"  >&#x2716;</i>
                    </td>
                     </tr>
                                                          `;
                
                
                  i++;
                  if(i>1){
                    $('#save').attr('disabled',false);
                }
                $("#tbody").append(output);
                
            });
            $(document).on('click','.remove',function(){
                $($(this).closest("tr")).remove();
                i--;
                if(i==1){
                    $('#save').attr('disabled',true);
                }
            })
        });
        </script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>