<?php

include "connection.php";
$userid = $_GET['userid'];
$product_id = $_GET['product_id'];
    // $userid = $_POST['userid'];
    
    // Perform the deletion query
    $sql = "DELETE FROM wishlist WHERE userid = '$userid' AND product_id = '$product_id'";

    
    if (mysqli_query($con, $sql)) {
        // Deletion was successful
        echo "success"; // Send a success response
        header("location:wishlist_guest.php");
    } else {
        // Handle the case where deletion failed
        echo "error"; // Send an error response
    }

?>