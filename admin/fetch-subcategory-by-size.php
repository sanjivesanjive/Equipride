<?php
require_once "../connection.php";
$sub_category_id = $_POST["sub_category_id"];
$result = mysqli_query($con,"SELECT * FROM size where sub_category_id = $sub_category_id");
?>
<option value="">Select size</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["size"];?>"><?php echo $row["size"];?></option>
<?php
}
?>