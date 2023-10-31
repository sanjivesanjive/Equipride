<?php

include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipping_address = $_POST['shipping_address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $localty = $_POST['localty'];
    $pincode = $_POST['pincode'];
    $country = $_POST['country'];
    $orderid = $_POST['orderid'];
    $userid = $_POST['userid'];

    // Check if orderid and userid are not empty
    if (!empty($orderid) && !empty($userid)) {
        $sql = "UPDATE orders SET username='Guest', shipping_address='$shipping_address', userid='$userid', email='$email', phone='$phone', houseno='$address', town='$localty', post_code='$pincode', country='$country' WHERE orderid='$orderid'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            // Fetch all the values you need
            $select_query = "SELECT email, phone, houseno AS address, town AS localty, post_code AS pincode, country FROM orders WHERE orderid='$orderid' AND userid='$userid'";
            $result = mysqli_query($con, $select_query);
            $data = mysqli_fetch_assoc($result);

            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update shipping address.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Order ID or User ID is empty.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}


