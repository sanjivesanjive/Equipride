<?php
include "connection.php";
$shipping_address = $_POST['shipping_address'];
$orderid = $_POST['orderid'];
$userid = $_POST['userid'];

if(isset($orderid)){
    $sql = "UPDATE orders SET shipping_address='$shipping_address' WHERE orderid='$orderid' AND userid='$userid'";
    $query = mysqli_query($con,$sql);

    if ($query) {
        $get_query = "SELECT shipping_address FROM orders WHERE orderid='$orderid' AND userid='$userid'";
        $get_shipping_address = mysqli_query($con, $get_query);

        $order_shipping_address = mysqli_fetch_assoc($get_shipping_address);
        echo json_encode(['success' => true, 'shipping_address' => $order_shipping_address['shipping_address']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update shipping address.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Order ID not provided.']);
}
?>