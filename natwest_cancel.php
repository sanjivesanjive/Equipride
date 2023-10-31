<?php


ini_set('session.gc_maxlifetime', 3600);
session_start();
include "connection.php";
require 'vendor/autoload.php';
echo "<center><h1>Payment Canceled</h1></center>";

$smtp_username = 'sales@equipride.co.uk';
$smtp_password = 'sales@123#';

$response = $_GET['response'];

$orderid = $_COOKIE['orderid'];
echo $orderid;


$user_type_sql = "SELECT type,userid FROM orders WHERE orderid='$orderid'";
$user_type_query = mysqli_query($con, $user_type_sql);
$user_type_value = mysqli_fetch_assoc($user_type_query);

$_SESSION['cancel_message'] = "Payment Cancelled!";

$userid = $user_type_value['userid'];
$_SESSION['admin_id'] = $userid; 

echo $userid;
$type = $user_type_value['type'];
echo $type;
// header("location:user_panal.php");

if ($type === "user") {
    // Check if the token is set
        $sql_payment = "UPDATE orders SET payment_status='Cancelled', payment_method='Natwest' WHERE userid='$userid' AND orderid='$orderid'";
        $payment_query = mysqli_query($con, $sql_payment);

        $sql_order_details = "SELECT * FROM orders WHERE orderid='$orderid'";
        $order_details_query = mysqli_query($con,$sql_order_details);
        $order_details = mysqli_fetch_array($order_details_query);

        $userid = $order_details['userid'];
        $username = $order_details['username'];
        $order_email = $order_details['email'];
        $phone = $order_details['phone'];
        $shipping_address = $order_details['shipping_address'];
        $payer_type = $order_details['type'];
        $payment_method = $order_details['payment_method'];

        $sql_order_items = "SELECT price, quantity FROM orders WHERE orderid='$orderid'";
        $order_items_query = mysqli_query($con, $sql_order_items);
        $total_order_amount = 0;

        while ($row = mysqli_fetch_array($order_items_query)) {
            $price = floatval($row['price']);
            $quantity = floatval($row['quantity']);
            $total_order_amount += $price * $quantity;
        }

        $payment_details_adminside = "INSERT INTO payments (type,payment_id,payer_id,payer_email,amount,currency,payment_method,payment_status) VALUES 
        ('$payer_type','$response','$userid','$order_email','$total_order_amount','GBP','$payment_method','Failed')";
        $payment_details_adminside_query = mysqli_query($con,$payment_details_adminside);


        // Check if the payment update was successful
        if ($payment_query) {
            // Create a new PHPMailer instance

            $email_body_for_user = '';

            $query = mysqli_query($con, "SELECT * FROM `orders` WHERE orderid='$orderid' ORDER BY id DESC");
            $previous_orderid = null;

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $orderid = $row['orderid'];
                    
                    // Check if the order ID is different from the previous row
                    if ($orderid != $previous_orderid) {
                        // Start a new section for this order
                        $email_body_for_user .= "Order #{$orderid} Details:\n";
                        $email_body_for_user .= "Customer Type: {$row['type']}\n";
                        $email_body_for_user .= "Username: {$row['username']}\n";
                        $email_body_for_user .= "Email: {$row['email']}\n";
                        $email_body_for_user .= "Phone: {$row['phone']}\n";
                        $email_body_for_user .= "Houseno: {$row['houseno']}\n";
                        $email_body_for_user .= "Town: {$row['town']}\n";
                        $email_body_for_user .= "Post Code: {$row['post_code']}\n";
                        $email_body_for_user .= "Country: {$row['country']}\n";
                        $email_body_for_user .= "Shipping Address: {$row['shipping_address']}\n";
                    }

                    // Add product details to the email body
                    $email_body_for_user .= "Product Name: {$row['product_name']}\n";
                    $email_body_for_user .= "Size: {$row['size']}\n";
                    $email_body_for_user .= "Quantity: {$row['quantity']}\n";
                    $email_body_for_user .= "Total Amount: {$row['total']}\n";
                    $email_body_for_user .= "Payment Method: {$row['payment_method']}\n";
                    $email_body_for_user .= "Payment Status: {$row['payment_status']}\n";
                    
                    $email_body_for_user .= "-----------------\n"; // Add a separator between orders
                    
                    $previous_orderid = $orderid; // Update the previous_orderid for the next iteration
                }
            }

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // Enable SMTP debugging (optional)
                // $mail->SMTPDebug = 2;

                // Set up SMTP (replace with your SMTP server details)
                $mail->isSMTP();
                $mail->Host = 'smtp.yandex.com'; // Your SMTP server
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = $smtp_username; // SMTP username
                $mail->Password = $smtp_password; // SMTP password
                $mail->SMTPSecure = 'tls'; // Encryption (tls or ssl)
                $mail->Port = 587; // SMTP port (tls: 587, ssl: 465)

                // Set email details
                $mail->setFrom($smtp_username, 'Equipride');
                $mail->addAddress($order_email, 'Recipient Name');
                $mail->Subject = 'Order Canceled - Order #' . $orderid;
                $email_body = $email_body_for_user;

                $mail->Body = $email_body;

                // Send the email
                $mail->send();

                $email_body_for_user = '';

            $query = mysqli_query($con, "SELECT * FROM `orders` WHERE orderid='$orderid' ORDER BY id DESC");
            $previous_orderid = null;

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
                    $orderid = $row['orderid'];
                    
                    // Check if the order ID is different from the previous row
                    if ($orderid != $previous_orderid) {
                        // Start a new section for this order
                        $email_body_for_user .= "Order #{$orderid} Details:\n";
                        $email_body_for_user .= "Customer Type: {$row['type']}\n";
                        $email_body_for_user .= "Username: {$row['username']}\n";
                        $email_body_for_user .= "Email: {$row['email']}\n";
                        $email_body_for_user .= "Phone: {$row['phone']}\n";
                        $email_body_for_user .= "Houseno: {$row['houseno']}\n";
                        $email_body_for_user .= "Town: {$row['town']}\n";
                        $email_body_for_user .= "Post Code: {$row['post_code']}\n";
                        $email_body_for_user .= "Country: {$row['country']}\n";
                        $email_body_for_user .= "Shipping Address: {$row['shipping_address']}\n";
                    }

                    // Add product details to the email body
                    $email_body_for_user .= "Product Name: {$row['product_name']}\n";
                    $email_body_for_user .= "Size: {$row['size']}\n";
                    $email_body_for_user .= "Quantity: {$row['quantity']}\n";
                    $email_body_for_user .= "Total Amount: {$row['total']}\n";
                    $email_body_for_user .= "Payment Method: {$row['payment_method']}\n";
                    $email_body_for_user .= "Payment Status: {$row['payment_status']}\n";
                    
                    $email_body_for_user .= "-----------------\n"; // Add a separator between orders
                    
                    $previous_orderid = $orderid; // Update the previous_orderid for the next iteration
                }
            }
                $mail2 = new PHPMailer\PHPMailer\PHPMailer(true);

                // Configure and send the second email
                $mail2->isSMTP();
                $mail2->Host = 'smtp.yandex.com'; // Your SMTP server for the second email
                $mail2->SMTPAuth = true; // Enable SMTP authentication for the second email
                $mail2->Username = $smtp_username; // SMTP username for the second email
                $mail2->Password = $smtp_password; // SMTP password for the second email
                $mail2->SMTPSecure = 'tls'; // Encryption (tls or ssl)
                $mail2->Port = 587; // SMTP port (tls: 587, ssl: 465)

                $mail2->setFrom($smtp_username, 'Admin');
                $mail2->addAddress($smtp_username, 'Recipient Name'); // Replace with recipient's email
                $mail2->Subject = 'Order Details For Admin';
                $mail2->Body = $email_body_for_user;

                // Send the second email
                $mail2->send();
                header("location:user_panal.php");
            } catch (Exception $e) {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            echo "Payment update failed.";
        }

    }

    else{
        if (isset($_GET['response'])) {

            $response = $_GET['response'];
            $orderid = $_COOKIE['orderid'];
            
            $sql_payment = "UPDATE orders SET payment_status='Canceled', payment_method='Natwest' WHERE userid='$userid' AND orderid='$orderid'";
            $payment_query = mysqli_query($con, $sql_payment);
    
            $sql_order_details = "SELECT * FROM orders WHERE orderid='$orderid'";
            $order_details_query = mysqli_query($con,$sql_order_details);
            $order_details = mysqli_fetch_array($order_details_query);
    
            $userid = $order_details['userid'];
            $username = $order_details['username'];
            $order_email = $order_details['email'];
            $phone = $order_details['phone'];
            $shipping_address = $order_details['shipping_address'];
            $payer_type = $order_details['type'];
            $payment_method = $order_details['payment_method'];
    
            $sql_order_items = "SELECT price, quantity FROM orders WHERE orderid='$orderid'";
            $order_items_query = mysqli_query($con, $sql_order_items);
            $total_order_amount = 0;
    
            while ($row = mysqli_fetch_array($order_items_query)) {
                $price = floatval($row['price']);
                $quantity = floatval($row['quantity']);
                $total_order_amount += $price * $quantity;
            }
    
            $payment_details_adminside = "INSERT INTO payments (type,payment_id,payer_id,payer_email,amount,currency,payment_method,payment_status) VALUES 
            ('$payer_type','$response','$userid','$order_email','$total_order_amount','GBP','$payment_method','Failed')";
            $payment_details_adminside_query = mysqli_query($con,$payment_details_adminside);
    
    
            // Check if the payment update was successful
            if ($payment_query) {
                // Create a new PHPMailer instance
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
                $email_body_for_guest = '';
    
                $query = mysqli_query($con, "SELECT * FROM `orders` WHERE orderid='$orderid' ORDER BY id DESC");
                $previous_orderid = null;
    
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        $orderid = $row['orderid'];
                        
                        // Check if the order ID is different from the previous row
                        if ($orderid != $previous_orderid) {
                            // Start a new section for this order
                            $email_body_for_guest .= "Order #{$orderid} Details:\n";
                            $email_body_for_guest .= "Customer Type: {$row['type']}\n";
                            $email_body_for_guest .= "Username: {$row['username']}\n";
                            $email_body_for_guest .= "Email: {$row['email']}\n";
                            $email_body_for_guest .= "Phone: {$row['phone']}\n";
                            $email_body_for_guest .= "Houseno: {$row['houseno']}\n";
                            $email_body_for_guest .= "Town: {$row['town']}\n";
                            $email_body_for_guest .= "Post Code: {$row['post_code']}\n";
                            $email_body_for_guest .= "Country: {$row['country']}\n";
                            $email_body_for_guest .= "Shipping Address: {$row['shipping_address']}\n";
                        }
    
                        // Add product details to the email body
                        $email_body_for_guest .= "Product Name: {$row['product_name']}\n";
                        $email_body_for_guest .= "Size: {$row['size']}\n";
                        $email_body_for_guest .= "Quantity: {$row['quantity']}\n";
                        $email_body_for_guest .= "Total Amount: {$row['total']}\n";
                        $email_body_for_guest .= "Payment Method: {$row['payment_method']}\n";
                        $email_body_for_guest .= "Payment Status: {$row['payment_status']}\n";
                        
                        $email_body_for_guest .= "-----------------\n"; // Add a separator between orders
                        
                        $previous_orderid = $orderid; // Update the previous_orderid for the next iteration
                    }
                }
    
    
    
                try {
                    // Enable SMTP debugging (optional)
                    // $mail->SMTPDebug = 2;
    
                    // Set up SMTP (replace with your SMTP server details)
                    $mail->isSMTP();
                    $mail->Host = 'smtp.yandex.com'; // Your SMTP server
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = $smtp_username; // SMTP username
                    $mail->Password = $smtp_password; // SMTP password
                    $mail->SMTPSecure = 'tls'; // Encryption (tls or ssl)
                    $mail->Port = 587; // SMTP port (tls: 587, ssl: 465)
    
                    // Set email details
                    $mail->setFrom($smtp_username, 'Equipride');
                    $mail->addAddress($order_email, 'Recipient Name');
                    $mail->Subject = 'Order Canceled - Order #' . $orderid;
                    $email_body = $email_body_for_guest;
    
                    $mail->Body = $email_body;// Customize the email content
    
                    // Send the email
                    $mail->send();
    
                    // Mail Body 
    
                    $email_body_for_guest = '';
    
                $query = mysqli_query($con, "SELECT * FROM `orders` WHERE orderid='$orderid' ORDER BY id DESC");
                $previous_orderid = null;
    
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        $orderid = $row['orderid'];
                        
                        // Check if the order ID is different from the previous row
                        if ($orderid != $previous_orderid) {
                            // Start a new section for this order
                            $email_body_for_guest .= "Order #{$orderid} Details:\n";
                            $email_body_for_guest .= "Customer Type: {$row['type']}\n";
                            $email_body_for_guest .= "Username: {$row['username']}\n";
                            $email_body_for_guest .= "Email: {$row['email']}\n";
                            $email_body_for_guest .= "Phone: {$row['phone']}\n";
                            $email_body_for_guest .= "Houseno: {$row['houseno']}\n";
                            $email_body_for_guest .= "Town: {$row['town']}\n";
                            $email_body_for_guest .= "Post Code: {$row['post_code']}\n";
                            $email_body_for_guest .= "Country: {$row['country']}\n";
                            $email_body_for_guest .= "Shipping Address: {$row['shipping_address']}\n";
                        }
    
                        // Add product details to the email body
                        $email_body_for_guest .= "Product Name: {$row['product_name']}\n";
                        $email_body_for_guest .= "Size: {$row['size']}\n";
                        $email_body_for_guest .= "Quantity: {$row['quantity']}\n";
                        $email_body_for_guest .= "Total Amount: {$row['total']}\n";
                        $email_body_for_guest .= "Payment Method: {$row['payment_method']}\n";
                        $email_body_for_guest .= "Payment Status: {$row['payment_status']}\n";
                        
                        $email_body_for_guest .= "-----------------\n"; // Add a separator between orders
                        
                        $previous_orderid = $orderid; // Update the previous_orderid for the next iteration
                    }
                }
    
                    $mail2 = new PHPMailer\PHPMailer\PHPMailer(true);
    
                    // Configure and send the second email
                    $mail2->isSMTP();
                    $mail2->Host = 'smtp.yandex.com'; // Your SMTP server for the second email
                    $mail2->SMTPAuth = true; // Enable SMTP authentication for the second email
                    $mail2->Username = $smtp_username; // SMTP username for the second email
                    $mail2->Password = $smtp_password; // SMTP password for the second email
                    $mail2->SMTPSecure = 'tls'; // Encryption (tls or ssl)
                    $mail2->Port = 587; // SMTP port (tls: 587, ssl: 465)
    
                    $mail2->setFrom($smtp_username, 'Admin');
                    $mail2->addAddress($smtp_username, 'Recipient Name'); // Replace with recipient's email
                    $mail2->Subject = 'Order Details For Admin';
                    $mail2->Body = $email_body_for_guest;
    
                    // Send the second email
                    $mail2->send();
                    header("location:guest_panal.php");
                } catch (Exception $e) {
                    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                }
            } else {
                echo "Payment update failed.";
            }
        }
    
    }

?>