<?php 
include "connection.php";
$userid = $_GET['userid'];
$product_id = $_GET['product_id'];
$sql = "DELETE FROM cart WHERE userid='$userid' AND pro_id='$product_id'";
$query = mysqli_query($con,$sql);
if($query){
    header("location:cart_box_user.php");
}
else{
    echo "error";
}

?>