<?php
require_once "connection.php";
$postData = $_GET['selectedcolor']; 
$post = $_GET['product_id']; 
// print_r($category_id);

$query = mysqli_query($con, "SELECT * FROM `stock`  where `product_id`= '$post' AND  `color` = '$postData' AND `type_1`='Customer'  ");

$result = mysqli_num_rows($query);
if ($result > 0) { 
while ($row = mysqli_fetch_array($query)){

    $size= $row['size'];
    $id= $row['id'];
    // $product_id= $row['product_id'];

    $results[] = array("size" => $size, "id" => $id );
}
}
header("Content-Type: application/json");
exit(json_encode($results)); 

?>
