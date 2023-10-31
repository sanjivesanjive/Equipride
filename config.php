<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AUXfWN5Wlia95yIbMTkZLLI0yjfhyyN9Dwwz5aMQLtvK5N0NPKc6io3PBkNropkOCy18FojcoHL440Zx');
define('CLIENT_SECRET', 'EIu0WEXLxwXwgjodNYIb9q2LZpOB7jEjfgR2cNPPF94fQmUwIdsHpZgu11QL8uj-vtG5rv7Ey28_pyuM');

define('PAYPAL_RETURN_URL', 'https://equipride.co.uk/success.php');
define('PAYPAL_CANCEL_URL', 'https://equipride.co.uk/cancel.php');
define('PAYPAL_CURRENCY', 'GBP'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'db_equipride'); 

if ($db->connect_errno) {
    die("Connect failed: " . $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(false); // Set it to 'false' when going live

// Check if a PayPal payment is successful and insert payment details into the database
if (isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
    $paymentId = $_GET['paymentId'];
    $payerId = $_GET['PayerID'];

    try {
        // Execute the PayPal payment
        $response = $gateway->completePurchase(array(
            'payer_id' => $payerId,
            'transactionReference' => $paymentId,
        ))->send();

        if ($response->isSuccessful()) {
            // Payment was successful
            // Now, you can save additional payment details into your payment history table
            $productId = $_POST['product_id']; // Replace with your product ID retrieval logic
            $userId = $_POST['user_id'];       // Replace with your user ID retrieval logic

            // Insert the data into the payment history table
            $insertQuery = "INSERT INTO payment_history (product_id, user_id, payment_id) VALUES ('$productId', '$userId', '$paymentId')";
            $db->query($insertQuery);

            echo "Payment was successful!";
        } else {
            // Payment failed or in another state
            echo "Payment failed or in another state: " . $response->getMessage();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>