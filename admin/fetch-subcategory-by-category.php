<?php
require_once "../connection.php";
$category_id = $_POST["category_id"];
$result = mysqli_query($con,"SELECT * FROM sub_category where category_id = $category_id");
?>
<option value="">Select sub_category</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["sub_category"];?></option>
<?php
}
?>