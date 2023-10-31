
<?php
include "connection.php";

if (isset($_POST['wish_count'])) {
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM wishlist WHERE type='customer' AND userid='$userid'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        echo $row;
    } else {
        echo '0';
    }
}


if (isset($_POST['wishlist'])) {
    // Sanitize and validate input values (You should use prepared statements)
    $product_id = $_POST['product_id'];
    $userid = $_POST['userid'];
    $p_name = $_POST['p_name'];
    $file = $_POST['file'];
    $price = $_POST['price'];

    // Use prepared statements to insert data securely
    $sql = "INSERT INTO `wishlist`( `userid`,`product_id`,`p_name`,`file` ,`price`,`type`,`status`) VALUES ('$userid','" . $product_id . "','" . $p_name . "','" . $file . "','" . $price . "','Customer','1')";
    $query = mysqli_query($con,$sql);
    if($query){
        echo "success";
    }
    else{
        echo "failed";
    }
} 

?>


   
  

        
      
